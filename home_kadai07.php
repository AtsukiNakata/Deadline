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
			#menu1{
				color:orange;
			}
			.container-right{
				background-image: url("./deadline1.jpg");
				background-position: 95% 5px;
				background-repeat: no-repeat;
				-webkit-background-size: contain;
				background-size: contain;
			}
		</style>

			<div class="container-right">
        <div class = "main1">
          <p>
						これはホーム画面です。<br>
						<?php
							echo $_SESSION["NAME"]."さんこんにちは";
						 ?>
					</p>
        </div>
			</div>
	</body>

</html>
