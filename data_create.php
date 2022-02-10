<?php

// var_dump($_POST);
// POSTデータ確認
if (
    !isset($_POST["trend"]) || $_POST["trend"] === "" ||
    !isset($_POST["kizyun"]) || $_POST["kizyun"] === "" ||
    !isset($_POST["Vola"]) || $_POST["Vola"] === ""
) {
    exit("ParamError");
}

$trend = $_POST["trend"];
$kizyun = $_POST["kizyun"];
$Vola = $_POST["Vola"];

if (isset($_POST["input_ma"])) {
    $input_ma = $_POST["input_ma"];
}
if (isset($_POST["input_mtf"])) {
    $input_mtf = $_POST["input_mtf"];
}
if (isset($_POST["input_pips"])) {
    $input_pips = $_POST["input_pips"];
}
if (isset($_POST["strong"])) {
    $strong = $_POST["strong"];
}

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

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．



// SQL作成&実行
// data_create.php

// SQL作成&実行
$sql = "INSERT INTO terms_table (terms_id, trend_no, kizyun, volatility, ma_val, mtf_val, pips_val, strong) VALUES (NULL, :trend, :kizyun, :vola, :input_ma, :input_mtf, :input_pips, :strong)";

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':trend', $trend, PDO::PARAM_STR);
$stmt->bindValue(':kizyun', $kizyun, PDO::PARAM_STR);
$stmt->bindValue(':vola', $Vola, PDO::PARAM_STR);
if (isset($_POST["input_ma"])) {
    $stmt->bindValue(':input_ma', $input_ma, PDO::PARAM_STR);
} else {
    $stmt->bindValue(':input_ma', 0, PDO::PARAM_STR);
}
if (isset($_POST["input_mtf"])) {
    $stmt->bindValue(':input_mtf', $input_mtf, PDO::PARAM_STR);
} else {
    $stmt->bindValue(':input_mtf', 0, PDO::PARAM_STR);
}
if (isset($_POST["input_pips"])) {
    $stmt->bindValue(':input_pips', $input_pips, PDO::PARAM_STR);
} else {
    $stmt->bindValue(':input_pips', 0, PDO::PARAM_STR);
}
if (isset($_POST["strong"])) {
    $stmt->bindValue(':strong', $strong, PDO::PARAM_STR);
} else {
    $stmt->bindValue(':strong', NULL, PDO::PARAM_STR);
}

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:index.php");
exit();
