<?php
session_start();
error_reporting(E_ALL);
ini_set( 'display_errors', 1 );

if (isset($_SESSION["NAME"])) {
	$errorMessage = "ログアウトしました。";
} else {
	header("Location: logout.php");
}

$db['dbname'] = "homework.db";
if (isset($_POST["submit"])) {
    try {
      $delete_kadai = $_POST["homework_id"];
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
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style07.css">
		<?php
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
			#menu3{
				color:orange;
			}
			#tbl{
				color: black;
			}
		</style>

		<div class="container-right">
			<div class = "main1">
				<p>
          <?php
            $r_filter = array_filter($r);
            if(!empty($r_filter)){
              echo"以下に課題が表示されます。削除を押すと課題が削除されます。";
            }else{
              echo"課題は現在ありません。";
            }
          ?>
        </p>
				<table id = "tbl">
					<?php
          function sort_by_target_date($a, $b) {
           if ($a['deadline_date'] == $b['deadline_date']) {
               return 0;
           }
           return ($a['deadline_date'] < $b['deadline_date']) ? -1 : 1;
             }
           usort($r, "sort_by_target_date");

					for($count = 0; $count < count($r); $count++):
						  $number = $count+1; ?>
						<tr>
				    <td><?php echo $number ."." ?></td>
				    <td><?php echo $r[$count]["homework"] ?></td>
				    <td><?php echo $r[$count]["deadline_date"] ?></td>
            <td><?php echo $r[$count]["deadline_time"] ?></td>
            <td>
              <form action = "" method = "POST">
                <input type="hidden" name="homework_id" value="<?php echo $r[$count]["id"] ?>">
                <input type="submit" class = "btn" id = "btn_delete" name = "submit" value = "削除">
              </form>
            </td>
            </tr>
          <?php endfor; ?>
				</table>
			</div>
		</div>
	</body>
</html>
