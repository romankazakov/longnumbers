<?php

require_once 'LongNumber.php';

use PHPUnit\Framework\TestCase;

class LongNumberTest extends TestCase {
     /**
     * @dataProvider dataSum
     */
	function testSum($a,$b,$sum){
		$longNumber = new LongNumber($a,$b );
		//echo "Результат = ",$longNumber->sum();
		$this->assertEquals($longNumber->sum(),$sum);
	}

	function dataSum(){
		return [
			['1','1','2'],
			['10','1','11'],
			['2147483647','1','2147483648'],
			['9223372036854775807','1','9223372036854775808'],//за границей 64 бит.
			['9223372036854775899','1','9223372036854775900']
		];
	}
}