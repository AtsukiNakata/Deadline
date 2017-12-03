<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style07.css">
		<?php
		error_reporting(E_ALL);
		ini_set( 'display_errors', 1 );

		$db['dbname'] = "homework.db";
		try {
		    $pdo = new PDO('sqlite:'.$db['dbname']);

		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		    $stmt = $pdo->prepare("SELECT * FROM homeworks");
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
					<li><a href="delete_07.php" class = "btn" id = "menu4">課題の削除</a></li>
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
				<p>以下に課題が表示されます。もし課題がない場合は何も表示されません。</p>
				<table id = "tbl">
					<?php
					for($count = 0; $count < count($r); $count++){
						$number = $count+1;
						echo "<tr>\n";
				    echo "\t\t\t\t\t\t<td>{$number}."."</td>\n";
				    echo "\t\t\t\t\t\t<td>{$r[$count]["homework"]}</td>\n";
				    echo "\t\t\t\t\t\t<td>{$r[$count]["deadline"]}</td>\n";
				    echo "\t\t\t\t\t</tr>\n";
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>