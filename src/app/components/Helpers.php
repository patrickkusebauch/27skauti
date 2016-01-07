<?php
/**
 * @author Patrick Kusebauch
 * @version 1.05, 03. 11. 2014
 */

use Nette\Utils\Html;

/**
 * Adds helpers to Latte 
 */
class Helpers
{
	/**
	 * Translation table for czech numbers
	 * Used if kids don't know numbers in morse code
	 */
	private static $NUMBERS = [
		'0' => ' nula ',
		'1' => ' jedna ',	
		'2' => ' dva ',
		'3' => ' tri ',
		'4' => ' ctyri ',
		'5' => ' pet ',
		'6' => ' sest ',
		'7' => ' sedm ',
		'8' => ' osm ',
		'9' => ' devet '
	];
	
	/**
	 * Translation table to morse code
	 * Simplified version
     *
     * Always end the translation with separator '/'
	 */
	private static $TRANSLATOR = [
		'.' => '', //special character (translate first)
		'-' => '', //special character (translate first)
		'/' => '', //special character (translate first)
		',' => '', //XXX missing translation
		'!' => '', //XXX missing translation
		'?' => '', //XXX missing translation
		'ch' => '----/', //translate ch first (not as 'c' and 'h')
		'a' => '.-/',
		'b' => '-.../',
		'c' => '-.-./',
		'd' => '-../',
		'e' => './',
		'f' => '..-./',
		'g' => '--./',
		'h' => '..../',
		'i' => '../',
		'j' => '.---/',
		'k' => '-.-/',
		'l' => '.-../',
		'm' => '--/',
		'n' => '-./',
		'o' => '---/',
		'p' => '.--./',
		'q' => '--.-/',
		'r' => '.-./',
		's' => '.../',
		't' => '-/',
		'u' => '..-/',
		'v' => '...-/',
		'w' => '.--/',
		'x' => '-..-/',
		'y' => '-.--/',
		'z' => '--../',
		' ' => '/',
		'0' => '.----/',
		'1' => '..---/',
		'2' => '...--/',
		'3' => '....-/',
		'4' => '...../',
		'5' => '-..../',
		'6' => '--.../',
		'7' => '---../',
		'8' => '----./',
		'9' => '-----/'
	];

	public static function loader($helper)
	{
		if (method_exists(__CLASS__, $helper)) {
			return array(__CLASS__, $helper);
		}
	}
	
	/**
	 * Czech helper translate to morse code.
     *
	 * @param string            Message to be translated
     * @param bool              Do you want to change numbers to words
	 * @return string           Encoded message
	 */
	public static function morse($text, $number = TRUE)
	{
		//prepare text for translation
		$morseText = \Nette\Utils\Strings::normalize($text);
		$morseText = \Nette\Utils\Strings::toAscii($morseText);
		$morseText = \Nette\Utils\Strings::lower($morseText);

		if($number){
			foreach(self::$NUMBERS as $original => $translation){ //translate numbers to text
				$morseText = str_replace($original, $translation, $morseText);
			}
			//remove double spaces
			$morseText = \Nette\Utils\Strings::replace($morseText, '/ {2,}/', ' ');
			$morseText = \Nette\Utils\Strings::normalize($morseText);
		}

		foreach(self::$TRANSLATOR as $original => $translation){ //translate text to morse code
			$morseText = str_replace($original, $translation, $morseText);
		}

		$morseText = '///' . $morseText . '//'; //start & end of text
		return $morseText;
	}

	public static function diff($original, $replacement)
	{
		$original = \Nette\Utils\Strings::normalize($original);
		$replacement = \Nette\Utils\Strings::normalize($replacement);
		if ($original == $replacement) { //no change
			return Html::el('span', ['style' => 'color:blue;'])->setHtml($original);
		} elseif($original == '') {//no original text
			return Html::el('span', ['style' => 'color:green;'])->setHtml($replacement);
		} elseif ($replacement == '') { //no replacement text
			return Html::el('span', ['style' => 'color:red;'])->setHtml($original);
		} else { //text is different
			return HTML::el('span')
				->add(Html::el('span', ['style' => 'color:red;'])->setHtml($original))
				->add(Html::el('br'))
				->add(Html::el('span', ['style' => 'color:green;'])->setHtml($replacement));
		}
	}

}
