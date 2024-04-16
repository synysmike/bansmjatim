<?php
require('excel_reader2.php');
require('SpreadsheetReader.php');
$Reader = new SpreadsheetReader('16112021223949FPMP.xlsx');
$Sheets = $Reader -> Sheets();

foreach ($Sheets as $Index => $Name)
{
	echo 'Sheet #'.$Index.': '.$Name;

	$Reader -> ChangeSheet($Index);

	foreach ($Reader as $Row)
	{
		print_r($Row);
	}
}
// foreach ($Reader as $Row)
// 	{
// 		print_r($Row);
// 	}
?>