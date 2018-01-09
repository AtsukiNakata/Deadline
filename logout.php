<?php
session_start();

if (isset($_SESSION["NAME"])) {
	$errorMessage = "ログアウトしました。";
} else {
	$errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();

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
					<li><a href="introduction.php" class = "btn" id = "menu_intro">紹介ページ</a></li>
        </ul>
      </nav>
    </div>

			<div class="container-right">
        <div class = "main1">
          <P>
            <?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?>
          </p>
        </div>
			</div>
	</body>

</html>
