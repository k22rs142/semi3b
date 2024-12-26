<!DOCTYPE html>
<?php
require 'vendor/autoload.php'; // 必要なオートローダを読み込む
use Symfony\Component\Yaml\Yaml;

$yamlFile = 'templates.yml'; // YAMLファイルのパスを指定
$config = Yaml::parseFile($yamlFile);

// テンプレートリストを取得
$templates = array_keys($config['templates']);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細データ</title>
</head>

<body>
    <?php
    require 'testdata.php'; // テストデータ
    $line = $_POST['line'];
    echo '<h3>詳細データ</h3>';
    echo "<table border='1'>";
    for ($i = 1; $i < 8; $i++) {
        echo "<tr><th>" . $detaitem[$i] . "</th><td>" . $tests[$line][$i] . "</td></tr>";
    }
    echo '</table>';

    echo "<h3>明細データ</h3>";
    echo "<table border='1'>";
    echo "<tr>
    <th>番号</th>
    <th>品名</th>
    <th>数量</th>
    <th>単位</th>
    <th>単価</th>
    <th>合計</th>
</tr>";

    echo "<tr>";

    if ($tests[$line][8] != null) {
        foreach ($tests[$line][8] as $key => $item) {

            if (isset($item['item_name'])) {
                echo "<td>{$item['no']}</td>
            <td>{$item['item_name']}</td>
            <td>{$item['quantity']}</td>
            <td>{$item['unit']}</td>
            <td>{$item['unit_price']}</td>
            <td>{$item['total_price']}</td>";
            }
            echo "</tr>";
        }
    } else {
    }

    //}
    echo "</table>";

    echo '<form action="freeoutput.php" method="post">';
    echo '<input type="hidden" name="line" value = ' . $line . '>';
    echo '<button type="submit">詳細Excel出力</button>';
    echo '</form>';

    echo '<form method="post" action="templates_output.php">
    <label for="template">テンプレートを選択:</label>
    <select name="template" id="template">';
    foreach ($templates as $template): ?>
        <option value="<?php echo htmlspecialchars($template); ?>"><?php echo htmlspecialchars($template); ?></option>
    <?php
    endforeach;
    echo '<form action="templates_output.php" method="post">';
    echo '<input type="hidden" name="line" value = ' . $line . '>';
    echo '<button type="submit">テンプレートExcel出力</button>';
    echo '</form>';
    ?>
    </select>
    </form>

</body>

</html>