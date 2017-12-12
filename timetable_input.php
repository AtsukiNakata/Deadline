<?php
session_start();

if (isset($_SESSION["NAME"])) {
	$errorMessage = "ログアウトしました。";
} else {
	header("Location: logout.php");
}

$db['dbname'] = "homework.db";
$subject = $_POST["subject"];
$room = $_POST["room"];
$teacher = $_POST["teacher"];
$errorMessage = "";
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
					<li><a href="timetable.php" class = "btn" id = "menu_timetable">時間割(作成中)</a></li>
					<li><a href="form_kadai.php" class = "btn" id = "menu2">課題の追加</a></li>
					<li><a href="sent_07.php" class = "btn" id = "menu3">課題一覧</a></li>
					<li><a href="logout.php" class = "btn" id = "menu5">ログアウト</a></li>
				</ul>
			</nav>
		</div>

		<style type = "text/css">

		</style>

			<div class="container-right">
        <div class = "main1">
          <form method="POST" action="">
  					<div class = "main1">
  						<p>
  						<label>科目:</label>
  						<input class = "tarea" type="text" value="<?php if (!empty($subject)) {echo htmlspecialchars($subject, ENT_QUOTES);} ?>" name="subject" ><br>
              <label>教室: </label>
  						<input class = "deadline" type="text" value="<?php if (!empty($room)) {echo htmlspecialchars($room, ENT_QUOTES);} ?>" name="room" ><br>
  						<label>教員: </label>
  						<input class = "deadline" type="text" value="<?php if (!empty($teacher)) {echo htmlspecialchars($teacher, ENT_QUOTES);} ?>" name="teacher" ><br>
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
			</div>
	</body>

</html>
