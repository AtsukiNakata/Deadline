<?php
session_start();
if (isset($_SESSION["NAME"])) {
	$errorMessage = "ログアウトしました。";
} else {
	header("Location: logout.php");
}

$db['dbname'] = "subject.db";
$errorMessage = "";
$subject_time = $_POST["subject_link"];

if (isset($_POST["submit"])) {
	$subject_time = $_POST["subject_link"];
    try {
    	$pdo = new PDO('sqlite:'.$db['dbname']);
    	$stmt = $pdo->prepare("DELETE FROM subject_".$_SESSION["NAME"]." WHERE id = ?");
      $stmt->execute(array($subject_time));

    	$message = '削除が成功しました';
      header("Location: timetable.php");
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
					<li><a href="timetable.php" class = "btn" id = "menu_timetable">時間割</a></li>
					<li><a href="form_kadai.php" class = "btn" id = "menu2">課題の追加</a></li>
					<li><a href="sent_07.php" class = "btn" id = "menu3">課題一覧</a></li>
					<li><a href="logout.php" class = "btn" id = "menu5">ログアウト</a></li>
				</ul>
			</nav>
		</div>

		<style type = "text/css">
		#menu_timetable{
			color:orange;
		}
		</style>

			<div class="container-right">
        <div class = "main1">
          <p>科目の情報を削除する場合は下のボタンを押してください。</p>
          <form action = "" method = "POST">
            <input type="hidden" name="subject_link" value="<?php echo $subject_time ?>">
            <input type="submit" class = "btn" id = "btn_delete" name = "submit" value = "削除">
          </form>
        </div>
			</div>
	</body>

</html>
