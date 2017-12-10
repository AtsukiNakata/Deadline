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
      <?php
			session_start();
      error_reporting(E_ALL);
      ini_set( 'display_errors', 1 );

      $db['dbname'] = "homework.db";
      try {
          $pdo = new PDO('sqlite:'.$db['dbname']);

          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

          $stmt = $pdo->prepare("SELECT * FROM homeworks_".$_SESSION["NAME"]);
          $stmt->execute();
          $r = $stmt->fetchAll();
        }catch (Exception $e) {
          echo $e->getMessage();
        }
        $errorMessage = "";

        // 送信ボタンが押された場合
        if (isset($_POST["submit"])) {
        		try {
              $delete_kadai = $_POST["kadai_name"];
        			$pdo = new PDO('sqlite:'.$db['dbname']);

        			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        			$stmt = $pdo->prepare("DELETE FROM homeworks_".$_SESSION["NAME"]." WHERE id = ?");
        			$stmt->execute(array($delete_kadai));
        			$message = '課題の削除に成功しました。';
							header("Location: delete_finish.php");
							exit();
        		} catch (PDOException $e) {
        			$message = $e->getMessage();
        	}
        }

        ?>

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
					<li><a href="logout.php" class = "btn" id = "menu5">ログアウト</a></li>
				</ul>
			</nav>
		</div>

		<style type = "text/css">
			#menu4{
				color:orange;
			}
		</style>

			<div class="container-right">
        <div class = "main1">
          <p>
          ここでは課題を削除できます。
          削除する課題を選んでください。
          </p>
          <form action = "" method = "POST">
            <div>
              <select name = "kadai_name">
                <?php
      					for($count = 0; $count < count($r); $count++){
      						$number = $count+1;
      				    echo "<option value = {$r[$count]["id"]}>";
      				    echo "{$r[$count]["homework"]}"." "."{$r[$count]["deadline_date"]}"." "."{$r[$count]["deadline_time"]}";
      				    echo "</option>";
      				    echo "\n";
      					}
      					?>
              </select>
            </div>
            <br>
            <input type="submit" class = "btn" name = "submit">
          </form>
        </div>
			</div>
	</body>

</html>
