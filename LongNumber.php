<?php

class LongNumber {
	private $a;
	private $b;

	function __construct( $a ,$b ){
		$this->a = $a;
		$this->b = $b;
	}

	function sum(){

		$this->b = str_pad($this->b,  strlen($this->b) + 1 , '0', STR_PAD_LEFT );
		$this->a = str_pad($this->a,  strlen($this->a) + 1 , '0', STR_PAD_LEFT );
		
		if (strlen($this->a) > strlen($this->b)) {
            
            $this->b =
			str_pad($this->b, strlen($this->b)+(strlen($this->a)-strlen($this->b)), '0', STR_PAD_LEFT);
           
		} else if ( strlen($this->b) > strlen($this->a) ){
			$this->a = 
			str_pad($this->a, strlen($this->a)+(strlen($this->b)-strlen($this->a)),'0',STR_PAD_LEFT);
		}
		
		$this->a = str_split(strrev($this->a));
		$this->b = str_split(strrev($this->b));
		
		for($i = 0; $i < count($this->a)-1; $i++){
            $this->a[$i] = (int)$this->a[$i];
            $this->b[$i] = (int)$this->b[$i];

            $this->a[$i+1] = (int)$this->a[$i+1];
            $this->b[$i+1] = (int)$this->b[$i+1];

            $sum = $this->a[$i] + $this->b[$i]; 

            /*echo 
			"Шаг ",$i," a= ",$this->a[$i]," b= ",$this->b[$i]," sum= ",$sum,' %10= ',$sum % 10,' /10 ',(int)($sum/10), PHP_EOL;*/

			$this->a[$i] = $sum % 10;
			
			$this->a[$i+1] = ($this->a[$i+1] + (int)($sum / 10));
		}
		
		if (0 == $this->a[count($this->a)-1]){
			array_pop($this->a);
		}
		
		return strrev(implode('', $this->a));
	}
} 