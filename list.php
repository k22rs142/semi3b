<!DOCTYPE html>
<?php
require 'testdata.php'; //テストデータ

echo '<table class="table table-bordered table-hover">';

echo "<tr>";

for ($i = 1; $i < 5; $i++) {
    echo "<th>" . $detaitem[$i] . "</th>";
}

$count = 0;
foreach ($tests as $test) {
    echo '<tr align = "center">';
    echo '<td>' . $test[1] . '</td>';
    echo '<td>' . $test[2] . '</td>';
    echo '<td>' . $test[3] . '</td>';
    echo '<td>' . $test[4] . '</td>';
    echo '<td><form action="detail.php" method="post"> 
    <input type="hidden" name="line" value=' . $count . '>
    <button type="submit">詳細データ' . ($count + 1) . '</button></form></td></tr>';
    $count++;
}
$list_detaitem = [$detaitem[1], $detaitem[2], $detaitem[3], $detaitem[4]]; //担当者までを表示

$listout = [];
for ($i = 0; $i < $count; $i++) {
    $listout[] = [
        1 => $tests[$i][1],
        2 => $tests[$i][2],
        3 => $tests[$i][3],
        4 => $tests[$i][4]
    ];
}

?>
<!DOCTYPE html>
<html>

<body>
    <form action="listoutput.php" method="post">
        <button type="submit">一覧Excel出力</button>
    </form>

</body>

</html>