<?php
// セッション開始
session_start();

// 変数の設定
$db['dbname'] = "users.db";  // データベースファイル
$db['dbname2'] = "homeworks.db";
$username = $_POST["username"];
$password = $_POST["password"];
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {

	// ユーザ名、パスワードの入力チェック
	if (empty($username)) {
		$errorMessage = 'ユーザー名が未入力です。';
	} else if (empty($password)) {
		$errorMessage = 'パスワードが未入力です。';
	} else {

		// ユーザ名、パスワードがあった場合
		try {

			$pdo = new PDO('sqlite:'.$db['dbname']);

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			// ユーザ名からユーザーデータ 取得
			$stmt = $pdo->prepare('SELECT * FROM users WHERE name = ?');
			$stmt->execute(array($username));

			// ユーザ名がデータベースにあった場合
			if ($row = $stmt->fetch()) {

				// パスワードをハッシュ化して比較
				if (password_verify($password, $row['password'])) {

					session_regenerate_id(true);

					$_SESSION["NAME"] = $username;
					header("Location: home_kadai07.php");  // メイン画面へ遷移
					exit();  // 処理終了

				} else {

					// 認証失敗
					$errorMessage = 'ユーザー名あるいはパスワードに誤りがあります。';

				}

			} else {

				// 該当データなし
				$errorMessage = 'ユーザー名あるいはパスワードに誤りがあります。';

			}

		} catch (PDOException $e) {
			$errorMessage = $sql;
		}
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
    				<li><a href="register.php" class = "btn" id = "menu_register">新規登録</a></li>
  					<li><a href="login.php" class = "btn" id = "menu_login">ログイン</a></li>
  				</ul>
    		</nav>
    	</div>

      <style type = "text/css">
  			#menu_login{
  				color:orange;
  			}
				#login{
					width:60px;
				}
  		</style>

			<div class="container-right">
        <div class = "main1">
          <P>
            ここではログインができます。<br>
            アカウントがない方は新規登録でアカウントを作ってください。
          </p>

        <form id="loginForm" name="loginForm" action="" method="POST">
          <fieldset>
            <legend>ログインフォーム</legend>
            <div>
              <font color="#ff0000">
                <?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?>
              </font>
            </div>
            <label for="username">ユーザー名</label>
            <input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($username)) {echo htmlspecialchars($username, ENT_QUOTES);} ?>">
            <br>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
            <br>
            <input type="submit" id="login" class = "btn" name="login" value="ログイン">
          </fieldset>
        </form>
        </div>
			</div>
	</body>

</html>
