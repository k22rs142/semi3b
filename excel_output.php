<?php

namespace exceloutput;

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml; 
use PhpOffice\PhpSpreadsheet\IOFactory; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Foo
{

    public static function freeExcelOutput(array $detaitem, array $datas) //明細の無いデータをExcelで出力する(項目,データ)
    {
        // 新しいスプレッドシートオブジェクトを作成
        $spreadsheet = new Spreadsheet();

        // アクティブシートを取得
        $sheet = $spreadsheet->getActiveSheet();

        // 項目行の設定
        $columnIndex = 'A'; // 列の初期化 
        foreach ($detaitem as $value) {
            $sheet->setCellValue($columnIndex . '1', $value);
            $columnIndex++; // 次の列へ移動 
        }

        // データ行の設定
        $row = 2; // データの表示を2行目から開始 
            foreach ($datas as $data) {
                $columnIndex = 'A'; // 列の初期化 
                foreach ($data as $value) {
                    $sheet->setCellValue($columnIndex . $row, $value);
                    $columnIndex++; // 次の列へ移動 
                }
                $row++;
            }

        //一時ファイルに保存
        $temp_file = tempnam(sys_get_temp_dir(), '見積書_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($temp_file);

        // 出力バッファをクリアしてからダウンロードヘッダーの設定
        ob_end_clean(); // 重要

        // ダウンロード用ヘッダーの設定
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="見積書.xlsx"');
        header('Cache-Control: max-age=0');

        // ファイル内容を出力してダウンロード開始
        readfile($temp_file);

        // 一時ファイルの削除
        unlink($temp_file);

        exit;

    }
    //////////////////////////////////////////////////////////////
    public static function freeDetailExcelOutput(array $headerData, array $detailheader, array $detailData) //見積詳細データをexcelに出力する関数(項目を含めた詳細データ,明細データの項目,明細データ)
    {
        // スプレッドシート作成
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // // ヘッダー情報と詳細情報の出力
        $row = 1;
        foreach ($headerData as $key => $value) {
            $sheet->setCellValue("A{$row}", $key);
            $sheet->setCellValue("B{$row}", $value);
            $row++;
        }


        // 明細ヘッダー情報の出力
        $row += 1;
        $col = 'A';
        foreach ($detailheader as $headerValue) {
            $sheet->setCellValue("{$col}{$row}", $headerValue);
            $col++;  // 次の列に移動
        }

        // 明細情報の出力
        $row += 1; // 空行を追加
        foreach ($detailData as $detailRow) {
            $col = 'A';  // 各行の最初の列から開始
            foreach ($detailRow as $cellValue) {
                $sheet->setCellValue("{$col}{$row}", $cellValue);
                $col++;  // 次の列に移動
            }
            $row++;  // 次の行に移動
        }


        //一時ファイルに保存
        $temp_file = tempnam(sys_get_temp_dir(), '見積書_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($temp_file);

        // 出力バッファをクリアしてからダウンロードヘッダーの設定
        ob_end_clean(); // 重要

        // ダウンロード用ヘッダーの設定
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="見積書.xlsx"');
        header('Cache-Control: max-age=0');

        // ファイル内容を出力してダウンロード開始
        readfile($temp_file);

        // 一時ファイルの削除
        unlink($temp_file);

        exit;
    }

    //////////////////////////////////////////////////////////////
    public static function fillTemplateOutput($yamlFile, $templateName,array $data) //テンプレートファイルに出力する関数(使用するymlファイル,使用するテンプレートファイル,詳細明細データ)
    {

        // var_dump($yamlFile, $templateName, $data);//デバック
        //  exit;

        // YAMLファイルを読み込む
        if (!file_exists($yamlFile)) {
            throw new \Exception("YAML file '$yamlFile' not found.");
        }
        $config = Yaml::parseFile($yamlFile);

        if (!isset($config['templates'][$templateName])) {
            throw new \Exception("Template '$templateName' not found in configuration.");
        }

        $templateConfig = $config['templates'][$templateName];
        $templateFile = $templateConfig['file'];

        if (!file_exists($templateFile)) {
            throw new \Exception("Template file '$templateFile' not found.");
        }

        // テンプレートファイルを読み込む
        $spreadsheet = IOFactory::load($templateFile);

        // データをマッピング
        $fields = $templateConfig['fields'];//ymlファイルの詳細データを参照
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($fields as $key => $cellAddress) {
            if (isset($data[$key])) {
                $sheet->setCellValue($cellAddress, $data[$key]);
            }
        }

        // 明細データを挿入
        if (isset($data['detail_data']) && isset($templateConfig['detail'])) {
            $details = $data['detail_data'];
            $startRow = $templateConfig['detail']['start_row'];
            $columns = $templateConfig['detail']['columns'];

            foreach ($details as $detail) {
                foreach ($columns as $key => $columnLetter) {
                    if (isset($detail[$key])) {
                        $sheet->setCellValue($columnLetter . $startRow, $detail[$key]);
                    }
                }
                $startRow++; // 次の行に進む
            }
        }

        //一時ファイルに保存
        $temp_file = tempnam(sys_get_temp_dir(), '見積書_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($temp_file);

        // 出力バッファをクリアしてからダウンロードヘッダーの設定
        ob_end_clean();

        // ダウンロード用ヘッダーの設定
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="テンプレート見積書.xlsx"');
        header('Cache-Control: max-age=0');

        // ファイル内容を出力してダウンロード開始
        readfile($temp_file);

        // 一時ファイルの削除
        unlink($temp_file);

        exit;
    }

    //////////////////////////////////////////////////////////////
}
