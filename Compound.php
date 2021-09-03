<?php
// main class
class CompoundInterest
{
	public $initial_balance;
	public $interest_rate;
	public $time;
	public $returnvalue;
	function __construct($initial_balance, $interest_rate_per_month, $months, $year) 
	{
		$this->initial_balance = $initial_balance;
		$this->interest_rate = $interest_rate_per_month / 100;
		$this->time = $months + ($year * 12);
		$this->returnvalue = number_format((float)$this->calculateInterest($this->initial_balance, $this->time), 3, '.', '');
	}
	function calculateInterest($inbal, $time) // calculates balance + total profit
	{
		// return $this->initial_balance *  pow((1 + ($this->interest_rate / 1)), $this->time);
		return $inbal *  pow((1 + ($this->interest_rate / 1)), $time);
	}
	function calculateOnlyInterestPerMonth($inbal) // calculates profit only for one month
	{ // returns only the interest per month | 100 | 10Inter > 10
		return $inbal * $this->interest_rate;
	}
	function drawTable() // draw the compound interest table
	{
		echo "
		<table>
		<tr>
			<th>Month</th>
			<th>Interest</th>
			<th>Total Interest</th>
			<th>Balance</th>
		</tr>";
		echo "<tr>";
		echo "<td>" . "0" . "</td>";
		echo "<td>" . "0" . "</td>";
		echo "<td>" . "0" . "</td>";
		echo "<td>" . $this->initial_balance . "</td>";
		echo "</tr>";
		$total_interest = 0;
		$total_balance = $this->initial_balance;
		echo $this->calculateOnlyInterestPerMonth($this->initial_balance);
		for ($i = 1; $i < $this->time + 1; $i++) {
			echo "<tr>";
			echo "<td>" . $i . "</td>"; // Month
			echo "<td>" . round($this->calculateOnlyInterestPerMonth($total_balance),3)  . "</td>"; // Interest
			$total_interest += round($this->calculateOnlyInterestPerMonth($total_balance),3);
			echo "<td>" . $total_interest . "</td>"; // total interest
			echo "<td>" . $this->initial_balance + $total_interest . "</td>"; // total balance
			echo "</tr>";
			$total_balance += round($this->calculateOnlyInterestPerMonth($total_balance),3); // changed floatdigitlimit function to built-in round function
		};
		echo "</table>";
	}
}
// functions
function floatDigitLimit($value, $digit_num = 2) // 12.541321674 > 12.54
{
	return number_format((float)$value, $digit_num, '.', '');
}
// start of php code
$a = new CompoundInterest(100, 10, 6, 1);
echo $a->returnvalue;
// start of html
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- stylesheet -->
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td,
		th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
	</style>
	<!-- end of stylesheet -->
</head>

<body>

	<h2>HTML Table</h2>
	<?php $a->drawTable(); ?>

</body>

</html>