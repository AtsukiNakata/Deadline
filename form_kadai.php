<?php
// セッション開始
session_start();

if (isset($_SESSION["NAME"])) {
	$errorMessage = "ログアウトしました。";
} else {
	header("Location: logout.php");
}
// 変数の設定
$db['dbname'] = "homework.db";
$kadai = $_POST["kadai"];
$deadline_y = $_POST["deadline_y"];
$deadline_m = $_POST["deadline_m"];
$deadline_d = $_POST["deadline_d"];
$deadline_t = $_POST["deadline_t"];
$deadline = $deadline_y."-".$deadline_m."-".$deadline_d." ".$deadline_t;
$errorMessage = "";

// 送信ボタンが押された場合
if (isset($_POST[submit])) {

	// 課題、deadlineの入力チェック
	if (empty($kadai)) {
		$errorMessage = '課題が未入力です。';
	} else if (empty($deadline_y)) {
		$errorMessage = '年が未入力です。';
	} else if (empty($deadline_m)) {
		$errorMessage = '月が未入力です。';
	}	else if (empty($deadline_d)) {
		$errorMessage = '日が未入力です。';
	}	else if (empty($deadline_t)) {
		$errorMessage = '時が未入力です。';
	} else
		// 課題、deadlineがあった場合
		try {
			$pdo = new PDO('sqlite:'.$db['dbname']);

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$pdo->exec("CREATE TABLE IF NOT EXISTS homeworks_".$_SESSION["NAME"]."(
				id INTEGER PRIMARY KEY AUTOINCREMENT,
				homework text,
				deadline
			)");
			$stmt = $pdo->prepare("INSERT INTO homeworks_".$_SESSION["NAME"]."(homework, deadline) VALUES (?, ?)");
			$stmt->execute(array($kadai, $deadline));

			$message = '登録が成功しました';
		} catch (PDOException $e) {
			$message = $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style07.css">
		<title>課題の管理</title>
	</head>

	<body>
		<header>
			<h3>課題の管理</h3>
		</header>
		<div class = "container-left">
			<nav id = "g_navi">
				<ul id = "navi">
					<li><a href="home_kadai07.php" class = "btn" id = "menu1">ホーム画面</a></li>
					<li><a href="form_kadai.php" class = "btn" id = "menu2">課題の追加</a></li>
					<li><a href="sent_07.php" class = "btn" id = "menu3">課題一覧</a></li>
					<li><a href="delete_07.php" class = "btn" id = "menu4">課題の削除</a></li>
					<li><a href="logout.php" class = "btn" id = "menu5">ログアウト</a></li>
				</ul>
			</nav>
		</div>

		<style type = "text/css">
			#menu2{
				color:orange;
			}
		</style>


			<div class="container-right">
				<form method="POST" action="">
					<div class = "main1">
						<p>
						<label>課題:</label>
						<input class = "tarea" type="text" value="<?php if (!empty($kadai)) {echo htmlspecialchars($kadai, ENT_QUOTES);} ?>" name="kadai" ><br>
						<label><提出期限></label><br>
						<label>年: </label>
						<input class = "deadline" type="text" placeholder = "例)2017" value="<?php if (!empty($deadline_y)) {echo htmlspecialchars($deadline_y, ENT_QUOTES);} ?>" name="deadline_y" ><br>
						<label>月: </label>
						<input class = "deadline" type="text" placeholder = "例) 11" value="<?php if (!empty($deadline_m)) {echo htmlspecialchars($deadline_m, ENT_QUOTES);} ?>" name="deadline_m" ><br>
						<label>日: </label>
						<input class = "deadline" type="text" placeholder = "例) 21" value="<?php if (!empty($deadline_d)) {echo htmlspecialchars($deadline_d, ENT_QUOTES);} ?>" name="deadline_d" ><br>
						<label>時: </label>
						<input class = "deadline" type="text" placeholder = "例)23:59" value="<?php if (!empty($deadline_t)) {echo htmlspecialchars($deadline_t, ENT_QUOTES);} ?>" name="deadline_t" ><br>
						<div>
		          <font color="#ff0000">
		            <?php
									echo htmlspecialchars($errorMessage, ENT_QUOTES);
									echo htmlspecialchars($message, ENT_QUOTES);
								 ?>
		          </font>
		        </div>
						<br>
						<input type="submit" class = "btn" name = "submit">
					</p>
					</div>
				</form>
			</div>
	</body>

</html>
