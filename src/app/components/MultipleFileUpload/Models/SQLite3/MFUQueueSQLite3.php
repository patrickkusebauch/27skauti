<?php

class MFUQueueSQLite3 extends MFUBaseQueueModel {

	/**
	 * Execute query
	 * @param string $sql
	 * @return SQLite3Result
	 */
	function query($sql) {
		return $this->getQueuesModel()->query($sql);
	}
	
    
    /**
	 * Prepare query
	 * @param string $sql
	 * @return SQLite3Stmt
	 */
	function prepare($sql) {
		return $this->getQueuesModel()->prepare($sql);
	}

    
	/**
	 * Add file to queue
	 * @param \Nette\Http\FileUpload $file
	 */
	function addFile(\Nette\Http\FileUpload $file) {
		$file->move($this->getUniqueFilePath());
		$this->query("
                INSERT INTO files (queueID, created, data, name) VALUES (
                '" . Sqlite3::escapeString($this->getQueueID()) . "'," . 
                time() . "," . 
                "'" . Sqlite3::escapeString(serialize($file)) . "'," . 
                "'" . Sqlite3::escapeString($file->getName()) . "')
            ");
	}

    
    /**
	 * Add file to queue manually
	 * @param \Nette\Http\FileUpload $file
     * @param int $chunk
     * @param int $chunks
	 */
	function addFileManually($name, $chunk, $chunks) {
		$this->query("
            INSERT INTO files (queueID, created, name, chunk, chunks) VALUES (
            '" . Sqlite3::escapeString($this->getQueueID()) . "'," .
            time() . "," . 
            "'" . Sqlite3::escapeString($name) . "'," .
            Sqlite3::escapeString($chunk) . "," .
            Sqlite3::escapeString($chunks) . ")
        ");
	}

    
    /**
     * Update file
     * @param string $name
     * @param int $chunk
     * @param \Nette\Http\FileUpload $file
     */
	function updateFile($name, $chunk, \Nette\Http\FileUpload $file = null) {
		$this->query("BEGIN TRANSACTION");
		$where = "queueID = '" . Sqlite3::escapeString($this->getQueueID()) . "' AND name = '" . Sqlite3::escapeString($name) . "'";
		$this->query("UPDATE files SET chunk = " . Sqlite3::escapeString($chunk) . " WHERE " . $where);
		if($file) {
            // use blob for storing serialized object, see https://bugs.php.net/bug.php?id=63419 and https://bugs.php.net/bug.php?id=62361
            $stmt = $this->prepare("UPDATE files SET data = :data WHERE " . $where);
            $stmt->bindValue(':data', serialize($file), SQLITE3_BLOB);
            $stmt->execute();
		}
		$this->query("END TRANSACTION");
	}

    
	/**
	 * Get upload directory path
	 * @return string
	 */
	function getUploadedFilesTemporaryPath() {
		if(!MFUQueuesSQLite3::$uploadsTempDir) {
			MFUQueuesSQLite3::$uploadsTempDir = \Nette\Environment::expand("%tempDir%" . DIRECTORY_SEPARATOR . "uploads-MFU");
		}

		if(!file_exists(MFUQueuesSQLite3::$uploadsTempDir)) {
			mkdir(MFUQueuesSQLite3::$uploadsTempDir, 0777, true);
		}

		if(!is_writable(MFUQueuesSQLite3::$uploadsTempDir)) {
			MFUQueuesSQLite3::$uploadsTempDir = \Nette\Environment::expand("%tempDir%");
		}

		if(!is_writable(MFUQueuesSQLite3::$uploadsTempDir)) {
			throw new \Nette\InvalidStateException("Directory for temp files is not writable!");
		}

		return MFUQueuesSQLite3::$uploadsTempDir;
	}

    
	/**
	 * Get files
	 * @return array of \Nette\Http\FileUpload
	 */
	function getFiles() {
		$files = array();

        $result = $this->query("SELECT * FROM files WHERE queueID = '" . Sqlite3::escapeString($this->getQueueID()) . "'");
        while (($row = $result->fetchArray(SQLITE3_ASSOC)) !== FALSE) {
			$f = unserialize($row["data"]);
			if(!$f instanceof \Nette\Http\FileUpload) continue;
			$files[] = $f;
		}
		return $files;
	}

    
    /**
     * Delete temporary files
     */
	function delete() {
		$dir = realpath($this->getUploadedFilesTemporaryPath());
		foreach($this->getFiles() AS $file) {
			$fileDir = dirname($file->getTemporaryFile());
			if(realpath($fileDir) == $dir and file_exists($file->getTemporaryFile())) {
				// Soubor smažeme poze pokud zůstal ve složce s tempy.
				// Pokud ho už uživatel přesunul, tak mu ho mazat nebudeme.
				@unlink($file->getTemporaryFile()); // intentionally @
			}
		}

		$this->query("DELETE FROM files  WHERE queueID = '" . Sqlite3::escapeString($this->getQueueID()) . "'");
	}

    
	/**
	 * When was queue last accessed?
	 * @return int timestamp
	 */
	function getLastAccess() {
		$lastAccess = (int)$this->getQueuesModel()->getConnection()->querySingle("
            SELECT created
			FROM files
			WHERE queueID = '" . Sqlite3::escapeString($this->getQueueID()) . "'
			ORDER BY created DESC
        ");
		return $lastAccess;
	}

}