<?php
require 'vendor/autoload.php';
require 'testdata.php';//テストデータ
require 'list.php';
require 'excel_output.php';

use exceloutput\Foo;

Foo::freeExcelOutput($list_detaitem,$listout);
