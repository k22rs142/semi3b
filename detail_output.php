<?php
require 'vendor/autoload.php';
require 'testdata.php';//テストデータ
require 'excel_output.php';

use exceloutput\Foo;

$line = $_POST['line'] ;

Foo::freeExcelOutput($detaitem,$tests[$line]);
