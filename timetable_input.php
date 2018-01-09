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

if (isset($_POST[submit])) {
	$subject = $_POST["subject"];
	$room = $_POST["room"];
	$teacher = $_POST["teacher"];
	$subject_time = $_POST["subject_link"];

	if (empty($subject)) {
		$errorMessage = '科目が未入力です。';
	} else if (empty($room)) {
		$errorMessage = '教室が未入力です。';
	} else if (empty($teacher)) {
		$errorMessage = '教員が未入力です。';
	} else

try {
	$pdo = new PDO('sqlite:'.$db['dbname']);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$stmt = $pdo->prepare("INSERT INTO subject_".$_SESSION["NAME"]."(subject_time, subject, room, teacher) VALUES (?, ?, ?, ?)");
	$stmt->execute(array($subject_time, $subject, $room, $teacher));

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
          <form method="POST" action="">
  						<p>
								<科目の情報入力: <?php echo $subject_time ?> >
							</p>
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
							<input type="hidden" name="subject_link" value=<?php echo $subject_time ?>>
  						<input type="submit" class = "btn" name = "submit">
  				</form>
        </div>
			</div>
	</body>

</html>
