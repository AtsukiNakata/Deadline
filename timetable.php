<?php
session_start();
error_reporting(E_ALL);
ini_set( 'display_errors', 1 );

if (isset($_SESSION["NAME"])) {
	$errorMessage = "ログアウトしました。";
} else {
	header("Location: logout.php");
}
$db['dbname'] = "subject.db";
try {
		$pdo = new PDO('sqlite:'.$db['dbname']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$day_times = ["Mon1", "Tue1", "Wed1", "Thu1", "Fri1", "Mon2", "Tue2", "Wed2", "Thu2", "Fri2", "Mon3", "Tue3", "Wed3", "Thu3", "Fri3", "Mon4", "Tue4", "Wed4", "Thu4", "Fri4", "Mon5", "Tue5", "Wed5", "Thu5", "Fri5"];
		for ($i=0; $i<count($day_times); $i++){
			$day_time = $day_times[$i];
			$stmt = $pdo->prepare("SELECT * FROM subject_".$_SESSION["NAME"]." WHERE subject_time = ?");
			$stmt->execute(array($day_time));
			$r[$i] = $stmt->fetchAll();
		}
	}catch (Exception $e) {
		echo $e->getMessage();
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
      .timetable{
					text-align: center;
			}
      .timetable a {
          display:block;
					font-size: 10px;
          width: 65px;
          height: 60px;
          text-decoration: none;
				  white-space: nowrap;
				  overflow: hidden;
				  text-overflow: ellipsis;
				  -o-text-overflow: ellipsis;
        }
			.timetable a:hover{
				background-color:#ffcccc;
			}

		</style>

			<div class="container-right">
        <div class = "main1">
          <p>
            時間割を設定できます。
					</p>
          <table border="1" class = "timetable">
            <tr bgcolor = "white" style="font-size : 10px;">
              <td height = "5" ></td>
              <td>月</td>
              <td>火</td>
              <td>水</td>
              <td>木</td>
              <td>金</td>
            </tr>


            <?php
              $count = 0;
              $day_times_new = [1, "Mon1", "Tue1", "Wed1", "Thu1", "Fri1", 2, "Mon2", "Tue2", "Wed2", "Thu2", "Fri2", 3, "Mon3", "Tue3", "Wed3", "Thu3", "Fri3", 4, "Mon4", "Tue4", "Wed4", "Thu4", "Fri4", 5, "Mon5", "Tue5", "Wed5", "Thu5", "Fri5"];
              for($i=0; $i<count($day_times_new); $i++):
            ?>
            <?php
                if($day_times_new[$i] == 1):
            ?>
            <tr>
              <td height = "55px" bgcolor = "white">
                <?php echo $day_times_new[$i] ?>
              </td>
            <?php elseif($day_times_new[$i] == 2 || $day_times_new[$i] == 3 || $day_times_new[$i] == 4 || $day_times_new[$i] == 5 ): ?>
            </tr>

            <tr>
              <td height = "55px" bgcolor = "white">
                <?php echo $day_times_new[$i] ?>
              </td>
            <?php else: ?>
              <td
              <?php
								${"r_filter".$count} = array_filter($r[$count]);
								if(!empty(${"r_filter".$count})){
									echo"bgcolor = '#ffcccc'";
								}
							?>
              >
								<form method="POST" action=
								<?php
									if(!empty(${"r_filter".$count})){
										echo "timetable_delete.php";
									}else{
										echo "timetable_input.php";
									}
								?>

								 name = "form_<?php echo $day_times_new[$i] ?>">
								  <input type="hidden" name="subject_link" value=
									<?php
									if(!empty(${"r_filter".$count})){
										print_r ($r[$count][0]["id"]);
									}else{
									  echo $day_times_new[$i];
									}
 								 	?>
									>
								  <a href="javascript:form_<?php echo $day_times_new[$i] ?>.submit()">
                    <?php
                      if(!empty(${"r_filter".$count})):
												echo $r[$count][0]["subject"];
										 ?><br><br>
										<?php
                      echo $r[$count][0]["room"];
                    ?><br>
										<?php
												echo $r[$count][0]["teacher"];
                      else:
                        echo "選択なし";
											endif;
										 ?>
                </td>
								</form>
              <?php
                  $count++ ;
                endif;
              endfor;
              ?>

            </tr>

          </table>
        </div>
			</div>
	</body>

</html>
