
<?php

require 'vendor/autoload.php';
require 'testdata.php';
require 'excel_output.php';

use exceloutput\Foo;//

// use PhpOffice\PhpSpreadsheet\IOFactory;
// use Symfony\Component\Yaml\Yaml;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


try {
    // YAML設定ファイルを読み込む
    $manager = 'templates.yml';//new ExcelTemplateManager('templates.yml');
    $selectedTemplate = $_POST['template'];
    $line = $_POST['line'];
    

    // 埋め込むデータ
    $data = [
        'estimate_number' => $tests[$line][1],
        'issue_date' => $tests[$line][2],
        'issuer'  => $tests[$line][3],
        'person_in_charge' => $tests[$line][4],
        'customer_name' => $tests[$line][5],
        'customer_representative' => $tests[$line][6],
        'customer_address' => $tests[$line][7],
        'detail_data' => $tests[$line][8]
    ];

    // テンプレートにデータを埋め込む
    //$manager->fillTemplate('estimate', $data);

    Foo::fillTemplate($manager,$selectedTemplate, $data);



} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>

