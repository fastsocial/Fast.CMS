<?php

class Module {
	private $name;
	
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function display_menu_item() {
		echo $this->name;
	}
}