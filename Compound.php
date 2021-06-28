<?php
class CompoundInterest
{
	private $initial_balance;
	private $interest_rate;
	private $time;
	public $returnvalue;
	function __construct($initial_balance, $interest_rate_per_month, $months,$year)
	{
		$this->initial_balance = $initial_balance;
		$this->interest_rate = $interest_rate_per_month / 100;
		$this->time = $months + ($year * 12);
		$this->returnvalue = number_format((float)$this->calculateInterest(), 2, '.', '');
	}
	function calculateInterest(){
		return $this->initial_balance *  pow(( 1 + ($this->interest_rate / 1)),$this->time);
	}
}
$a = new CompoundInterest(100,10,6,1);
echo $a->returnvalue;