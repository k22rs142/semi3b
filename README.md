# 見積書Excel出力プログラム

## 1.仕様
* freeExcelOutput(array $detaitem, array $datas)関数<br>この関数では、データとその項目を自由形式のExcelファイルとして出力する。<br>初めに、引数として、出力するデータ項目の配列を＄detaitem、出力するデータの配列を＄datasとして受け取る。
  <br>次に生成したExcelファイルの1行目に、全ての項目のデータを入力する。その後、全てのデータを2行目に入力し、そのExcelファイルをダウンロードさせる。

* freedetailExcelOutput(array $headerData, array $detailheader, array $detailData)関数<br>この関数は、明細データを含めた見積詳細データを自由形式のExcelファイルとして出力する。<br>初めに、引数として、詳細データ項目を含めた詳細データの配列を＄headerData、明細データ項目の配列を＄detailheader、明細データを＄detailDataとして受け取る。<br>
次に、＄headerDataのデータを基に、項目を含めた詳細データを入力した後、一行空けて明細データの項目を入力する。その後、明細データを入力し、そのExcelファイルをダウンロードさせる。

* fillTemplate($yamlFile, $templateName, $data) 関数<br>
  この関数は、明細データを含めた見積詳細データをテンプレートのあるExcelファイルを利用して、出力する。<br>
  初めに、引数として、ymlファイルのデータを＄yamlFile、使用するテンプレートExcel名を＄templateName、使用する詳細データ及び明細データを＄dataとして受け取る。<br>次に、＄yamlFileを基に、ymlファイル及びテンプレートExcelファイルを読み込む。その後、読み込んだymlファイルを基に、詳細データ及び明細データをテンプレートExcelファイルの指定のセルに入力し、そのExcelファイルをダウンロードさせる。