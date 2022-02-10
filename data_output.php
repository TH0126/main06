<?php

// DB接続
$dbn = 'mysql:dbname=fx_db10_07;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}



// SQL作成&実行
$sql = "SELECT * FROM terms_table";

$stmt = $pdo->prepare($sql);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>条件入力</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_out.css">
</head>

<body>
    <a href="index.php">条件入力画面</a>
    <p>条件履歴一覧</p>
    <table id="fav-table">
        <thead>
            <tr>
                <th>履歴No.</th>
                <th>トレンド</th>
                <th>トレンド（判断基準）</th>
                <th>基準MA</th>
                <th>基準MTF MA</th>
                <th>ボラリティ（判断基準）</th>
                <th>pips</th>
                <th>強弱</th>
            </tr>
        </thead>
        <tbody id="output">
            <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#fav-table').tablesorter();
        });

        const resultArray = <?= json_encode($result) ?>;

        $.each(resultArray, function(index, value) {

            let table_val = "<tr><td>" + ("0000" + value.terms_id).slice(-4) + "</td><td>"

            if (value.trend_no === "1") {
                table_val += "上昇トレンド</td><td>";
            } else if (value.trend_no === "2") {
                table_val += "下落トレンド</td><td>";
            } else if (value.trend_no === "3") {
                table_val += "レンジ</td><td>";
            }

            if (value.kizyun === "0") {
                table_val += "ローソク足</td><td>";
            } else if (value.kizyun === "1") {
                table_val += "ＭＡ</td><td>";
            } else if (value.kizyun === "2") {
                table_val += "ＭＴＦ　ＭＡ</td><td>";
            }

            if (value.ma_val === 0) {
                table_val += "</td><td>";
            } else {
                table_val += value.ma_val + "</td><td>";
            }

            if (value.mtf_val === 0) {
                table_val += "</td><td>";
            } else {
                table_val += value.mtf_val + "</td><td>";
            }

            if (value.volatility === "0") {
                table_val += "ＰＩＰＳ</td><td>";
            } else if (value.volatility === "1") {
                table_val += "強弱</td><td>";
            }

            if (value.pips_val === 0) {
                table_val += "</td><td>";
            } else {
                table_val += value.pips_val + "</td><td>";
            }

            if (value.strong === "") {
                table_val += "</td></tr>";
            } else if (value.strong === "1") {
                table_val += "大</td></tr>";
            } else if (value.strong === "0") {
                table_val += "中</td></tr>";
            } else if (value.strong === "-1") {
                table_val += "小</td></tr>";
            }


            $("#output").append(table_val);
        })
    </script>

</body>

</html>