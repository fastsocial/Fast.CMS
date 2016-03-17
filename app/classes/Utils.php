<?php
class Utils
{
	protected static $_instance;
	protected static $_texts;
 
    private function __construct() {
    }
    
	private function __clone() {
    }
	
    public static function getInstance() {
       
        if (null === self::$_instance) {
            self::$_instance = new self();
			$texts = Texts::find();
			self::$_texts = array();
			foreach ($texts as $text) {
				self::$_texts[$text->name] = $text;
			}
        }
        return self::$_instance;
    }
	
	
    public static function get_text($name) {
		if (isset(self::$_texts[$name])) {
			return self::$_texts[$name]->text;
		}
		return false;
	}

	 public static function mail($to, $html, $subject) {
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$sender_name = "Автосервис \"Интер-Авто\"";
		$sender_mail = "konsult@avz.ru";
		
		$headers .= 'To: <'.$to.'>' . "\r\n";
		$headers .= 'From: '.adopt($sender_name).' <'.$sender_mail.'>' . "\r\n";
		mail($to, adopt($subject), $html, $headers);
	}
}

function adopt($text) {
    return '=?UTF-8?B?'.base64_encode($text).'?=';
}