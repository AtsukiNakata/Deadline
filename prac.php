







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
					<li><a href="prac.php" class = "btn" id = "menu5">prac</a></li>
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
          width: 60px;
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
              <td height = "5" width = "20"></td>
              <td>月</td>
              <td>火</td>
              <td>水</td>
              <td>木</td>
              <td>金</td>
            </tr>

            <tr>
              <td height = "55px" bgcolor = "white">1</td>
              <td
							<?php
								$r_filter0 = array_filter($r[0]);
								if(!empty($r_filter0)){
									echo"bgcolor = '#ffcccc'";
								}
							?>
							>
								<form method="POST" action="timetable_input.php" name = "form_mon1">
								  <input type="hidden" name="subject_link" value="Mon1">
								  <a href="javascript:form_mon1.submit()">
										<?php if(!empty($r_filter0)):
												echo $r[0][0]["subject"];
										 ?><br><br>
										<?php echo $r[0][0]["room"]; ?><br>
										<?php
												echo $r[0][0]["teacher"];
											endif;
										 ?>
									</a>
								</form>
							</td>
              <td
							<?php
								$r_filter1 = array_filter($r[1]);
								if(!empty($r_filter1)){
									echo"bgcolor = '#ffcccc'";
								}
							?>
							>
								<form method="POST" action="timetable_input.php" name = "form_tue1">
								  <input type="hidden" name="subject_link" value="Tue1">
								  <a href="javascript:form_tue1.submit()">
										<?php if(!empty($r_filter1)):
												echo $r[1][0]["subject"];
										 ?><br><br>
										<?php echo $r[1][0]["room"]; ?><br>
										<?php
												echo $r[1][0]["teacher"];
											endif;
										 ?>
								  </a>
								</form>
              </td>
              <td
							<?php
								$r_filter2 = array_filter($r[2]);
								if(!empty($r_filter2)){
									echo"bgcolor = '#ffcccc'";
								}
							?>
							>
								<form method="POST" action="timetable_input.php" name = "form_wed1">
								  <input type="hidden" name="subject_link" value="Wed1">
								  <a href="javascript:form_wed1.submit()">
									<?php if(!empty($r_filter2)):
											echo $r[2][0]["subject"];
									 ?><br><br>
									<?php echo $r[2][0]["room"]; ?><br>
									<?php
											echo $r[2][0]["teacher"];
										else:
											echo"選択なし";
										endif;
									 ?>
									</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_thu1">
								  <input type="hidden" name="subject_link" value="Thu1">
								  <a href="javascript:form_thu1.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_fri1">
								  <input type="hidden" name="subject_link" value="Fri1">
								  <a href="javascript:form_fri1.submit()">リンク</a>
								</form>
              </td>
            </tr>
						<tr>
              <td height = "55px" bgcolor = "white">2</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_mon2">
								  <input type="hidden" name="subject_link" value="Mon2">
								  <a href="javascript:form_mon2.submit()">リンク</a>
								</form>
							</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_tue2">
								  <input type="hidden" name="subject_link" value="Tue2">
								  <a href="javascript:form_tue2.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_wed2">
								  <input type="hidden" name="subject_link" value="Wed2">
								  <a href="javascript:form_wed2.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_thu2">
								  <input type="hidden" name="subject_link" value="Thu2">
								  <a href="javascript:form_thu2.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_fri2">
								  <input type="hidden" name="subject_link" value="Fri2">
								  <a href="javascript:form_fri2.submit()">リンク</a>
								</form>
              </td>
            </tr>

						<tr>
              <td height = "55px" bgcolor = "white">3</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_mon3">
								  <input type="hidden" name="subject_link" value="Mon3">
								  <a href="javascript:form_mon3.submit()">リンク</a>
								</form>
							</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_tue3">
								  <input type="hidden" name="subject_link" value="Tue3">
								  <a href="javascript:form_tue3.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_wed3">
								  <input type="hidden" name="subject_link" value="Wed3">
								  <a href="javascript:form_wed3.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_thu3">
								  <input type="hidden" name="subject_link" value="Thu3">
								  <a href="javascript:form_thu3.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_fri3">
								  <input type="hidden" name="subject_link" value="Fri3">
								  <a href="javascript:form_fri3.submit()">リンク</a>
								</form>
              </td>
            </tr>

						<tr>
              <td height = "55px" bgcolor = "white">4</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_mon4">
								  <input type="hidden" name="subject_link" value="Mon4">
								  <a href="javascript:form_mon4.submit()">リンク</a>
								</form>
							</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_tue4">
								  <input type="hidden" name="subject_link" value="Tue4">
								  <a href="javascript:form_tue4.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_wed4">
								  <input type="hidden" name="subject_link" value="Wed4">
								  <a href="javascript:form_wed4.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_thu4">
								  <input type="hidden" name="subject_link" value="Thu4">
								  <a href="javascript:form_thu4.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_fri4">
								  <input type="hidden" name="subject_link" value="Fri4">
								  <a href="javascript:form_fri4.submit()">リンク</a>
								</form>
              </td>
            </tr>

						<tr>
              <td height = "55px" bgcolor = "white">5</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_mon5">
								  <input type="hidden" name="subject_link" value="Mon5">
								  <a href="javascript:form_mon5.submit()">リンク</a>
								</form>
							</td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_tue5">
								  <input type="hidden" name="subject_link" value="Tue5">
								  <a href="javascript:form_tue5.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_wed5">
								  <input type="hidden" name="subject_link" value="Wed5">
								  <a href="javascript:form_wed5.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_thu5">
								  <input type="hidden" name="subject_link" value="Thu5">
								  <a href="javascript:form_thu5.submit()">リンク</a>
								</form>
              </td>
              <td>
								<form method="POST" action="timetable_input.php" name = "form_fri5">
								  <input type="hidden" name="subject_link" value="Fri5">
								  <a href="javascript:form_fri5.submit()">リンク</a>
								</form>
              </td>
            </tr>

          </table>
        </div>
			</div>
	</body>

</html>
