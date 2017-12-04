<?php
session_start();

if (isset($_SESSION["NAME"])) {
	$errorMessage = "ログアウトしました。";
} else {
	header("Location: logout.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style07.css">
		<script src="jquery-3.2.1.min.js"></script>
		<script src="kadai_07.js"></script>
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
			<div class="container-right">
        <div class = "main1">
          <p>課題の削除に成功しました。</p>
        </div>
			</div>
	</body>

</html>
