<?php

require 'vendor/autoload.php';
require 'testdata.php';//テストデータ
require 'excel_output.php';

use exceloutput\Foo;//

$line = $_POST['line'] ;

// データ
$headerData = [
    '見積書番号' => $tests[$line][1],
    '発行日' => $tests[$line][2],
    '発行者' => $tests[$line][3],
    '担当者' => $tests[$line][4],
    '顧客名' => $tests[$line][5],
    '顧客担当者' => $tests[$line][6],
    '顧客住所' => $tests[$line][7],
];

$detailheader = ['番号', '品名', '数量', '単位', '単価', '合計'];
$detailData = $tests[$line][8];

Foo::freeDetailExcelOutput($headerData,$detailheader,$detailData);