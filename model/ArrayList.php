<?php

class ArrayList {
	
	var $arreglo;

	function ArrayList() {
		$this->arreglo = array();
	}

	function addItem($item){
		$this->arreglo[] = $item ;
	}

	function toString(){
		$cadena = "";
		foreach ($this->arreglo as $item) {
			$cadena .= $item;
		}
		return $cadena;
	}

	function delete($item){
		unset($this->arreglo[$item]);
	}

	function item($item){
		return $this->arreglo[$item];
	}

	function size(){
		$size = 0;
		foreach ($this->arreglo as $item) {
			$size++;
		}
		return $size;
	}
}

?>