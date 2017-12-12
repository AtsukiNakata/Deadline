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
          <li><a href="timetable.php" class = "btn" id = "menu_timetable">時間割(作成中)</a></li>
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
      .timetable a {
          display:block;
          width: 50px;
          height: 50px;
        }
      .timetable a:hover {
          background-color:#ffcccc;
        }
		</style>

			<div class="container-right">
        <div class = "main1">
          <p>
            時間割を設定できます。
					</p>
          <table border="1" width = "300" class = "timetable">
            <tr bgcolor = "white" style="font-size : 10px;">
              <td height = "5" width = "20"></td>
              <td>月</td>
              <td>火</td>
              <td>水</td>
              <td>木</td>
              <td>金</td>
            </tr>
            <tr>
              <td height = "50" bgcolor = "white">1</td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
            </tr>
            <tr>
              <td height = "50" bgcolor = "white">2</td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
            </tr>
            <tr>
              <td height = "50" bgcolor = "white">3</td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
            </tr>
            <tr>
              <td height = "50" bgcolor = "white">4</td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
            </tr>
            <tr>
              <td height = "50" bgcolor = "white">5</td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
              <td><a href="#">リンク</a></td>
            </tr>
          </table>
        </div>
			</div>
	</body>

</html>
