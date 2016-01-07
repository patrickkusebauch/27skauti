<?php
namespace Models;
/**
 * Stezky model
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class Stezky extends Repository
{
    /** @var string */
    protected $table = "task_group";

    public function getTotalSigned() {
	    return $this->database->table('task_signatures')
		    ->select('member_nickname AS nickname, COUNT(task_signatures.signature) AS count')
		    ->group('task_signatures.member_nickname')
		    ->order('count DESC');
    }

    public function getMemberOverview($name) {
	    return $this->database->query("SELECT `G`.`name`, `G`.`level`, COUNT(  `S`.`signature` ) AS 'count'
		FROM  `task_group` AS  `G` 
		LEFT JOIN  `task_tasks` AS  `T` ON  `T`.`task_group_id` =  `G`.`id` 
		LEFT JOIN  `task_signatures` AS  `S` ON  `S`.`task_tasks_id` =  `T`.`id` 
		WHERE  `S`.`member_nickname` =  '$name'
		GROUP BY  `G`.`id` 
		ORDER BY  `G`.`id` ");
    }

    public function getAllGroups() {
	    return $this->findAll()
		    ->order('id ASC');
    }

    public function getPersonDetail($name) {
	    $firstLevel = $this->getAllGroups()
		    ->where('level', 1)
		    ->order('id ASC')
		    ->fetchAll();
	    $secondLevel = $this->getAllGroups()
		    ->where('level', 2)
		    ->order('id ASC')
		    ->fetchAll();
	    $allGroups = [
		    '1. stupeň' => $firstLevel,
		    '2. stupeň' => $secondLevel,
	    ];
	    foreach($allGroups as $levelName => $level){
		    foreach($level as $groupName => $group){
			    $tasks = $group->related('task_tasks')
				    ->order('order ASC')
				    ->fetchAll();
			    $allGroups[$levelName][$group->name] = [];
			    foreach($tasks as $taskName => $task){
			    	$task = $task->related('task_signatures')
					->where('member_nickname', $name)
					->fetch();
				$allGroups[$levelName][$group->name][$task->task_tasks->name] = $task;
			    	unset($allGroups[$levelName][$group->name][$taskName]);
			    }
			    unset($allGroups[$levelName][$groupName]);
		    }
	    }
	    return $allGroups;
    }
}
