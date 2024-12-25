<?php
//テストデータ
$detaitem = [
    1 => '見積書番号',
    2 => '発行日',
    3 => '発行者',
    4 => '担当者',
    5 => '顧客名',
    6 => '顧客担当者',
    7 => '顧客住所',
    8 => '明細データ'
];

$tests = [
    [
        1 => 'a-001',
        2 => '2024年11月27日',
        3 => '株式会社サンプル商事',
        4 => '山田 太郎',
        5 => '株式会社クライアント',
        6 => '佐藤 花子',
        7 => '東京都千代田区1-2-3',
        8 => [ // 明細データ
            [
                'no' => 1,
                'item_name' => 'ノートパソコン',
                'quantity' => 10,
                'unit' => '台',
                'unit_price' => 150000,
                'total_price' => 1500000,
            ],
            [
                'no' => 2,
                'item_name' => 'マウス',
                'quantity' => 20,
                'unit' => '個',
                'unit_price' => 3000,
                'total_price' => 60000,
            ],
            [
                'no' => 3,
                'item_name' => 'キーボード',
                'quantity' => 20,
                'unit' => '個',
                'unit_price' => 5000,
                'total_price' => 100000,
            ],
            [
                'no' => 4,
                'item_name' => 'バッテリー',
                'quantity' => 15,
                'unit' => '個',
                'unit_price' => 2000,
                'total_price' => 30000,

            ]
        ],
    ],
    [
        1 => 'a-002',
        2 => '2024年12月4日',
        3 => '株式会社テスト商事',
        4 => '鈴木 一郎',
        5 => '株式会社エクセル',
        6 => '田中 二郎',
        7 => '福岡県糟屋郡1-2-3',
        8 => [ // 明細データ
            [
                'no' => 1,
                'item_name' => 'りんご',
                'quantity' => 10,
                'unit' => '個',
                'unit_price' => 150,
                'total_price' => 1500,
            ],
            [
                'no' => 2,
                'item_name' => 'みかん',
                'quantity' => 20,
                'unit' => '個',
                'unit_price' => 200,
                'total_price' => 4000,
            ],
            [
                'no' => 3,
                'item_name' => 'いちご',
                'quantity' => 15,
                'unit' => '個',
                'unit_price' => 200,
                'total_price' => 3000,
            ]
        ],
    ],
    [
        1 => 'a-003',
        2 => '2024年12月5日',
        3 => '株式会社アウトプット商事',
        4 => 'テスト 三郎',
        5 => '株式会社エクセル',
        6 => '田中 二郎',
        7 => '福岡県久留米市1-2-3',
        8 => [ // 明細データ
            [
                'no' => 1,
                'item_name' => 'ジュース',
                'quantity' => 10,
                'unit' => '本',
                'unit_price' => 120,
                'total_price' => 1200,
            ],
        ],

    ],

];


