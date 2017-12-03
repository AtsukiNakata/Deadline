<?php

session_start();

$db['dbname'] = "users.db";
$username = $_POST["username"];
$password = $_POST["password"];
$password2 = $_POST["password2"];
$message = "";

if (isset($_POST["signUp"])) {

	if (empty($username)) {
		$message = 'ユーザー名が未入力です。';
	} else if (empty($password)) {
		$message = 'パスワードが未入力です。';
	} else if (empty($password2)) {
		$message = 'パスワードが未入力です。';
	} else if ($password !== $password2) {
		$message = '入力された2つのパスワードが一致していません。';
	} else {

		try {

			$pdo = new PDO('sqlite:'.$db['dbname']);

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      // テーブル作成
			$stmt = $pdo->prepare("INSERT INTO users(name, password) VALUES (?, ?)");

			$stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));

			$message = '登録が成功しました';

		} catch (PDOException $e) {
			$message = $e->getMessage();
			if (strpos($message,'name is not unique')){
				$message = '既にそのユーザー名は使われています';
			}
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
      #menu_register{
        color:orange;
      }
      #signUp{
        width:60px;
      }
    </style>


			<div class="container-right">
        <div class = "main1">
          <P>ここで新規登録ができます。</p>
            <form id="loginForm" name="loginForm" action="" method="POST">
              <fieldset>
                <legend>新規登録フォーム</legend>
                <div>
                  <font color="#ff0000">
                    <?php echo htmlspecialchars($message, ENT_QUOTES); ?>
                  </font>
                </div>
                <label for="username">ユーザー名</label>
                <input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($username)) {echo htmlspecialchars($username, ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password2">パスワード(確認用)</label>
                <input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                <br>
                <input type="submit" id="signUp" class = "btn" name="signUp" value="新規登録">
              </fieldset>
            </form>
        </div>
			</div>
	</body>

</html>
