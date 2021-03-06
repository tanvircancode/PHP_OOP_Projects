<?php


include_once 'config.php';
include_once 'functions.php';
include_once 'tasks.php';


if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['id'] = $_SESSION['id'] ?? '';
if ($_SESSION['id']) {
    header('location: words.php');
    return;
}


// new code start

$status = '';

$connection = new Connection();
$action = $_POST['submit'] ?? '';
// echo $action."adas";exit;
if ($action == 'register') {

    $register = new Reg();
    $result = $register->registration($_POST['email'], $_POST['password']);

    if ($result) {
        $status = $result;
    }
    header("location:index.php?status={$statusCode}");

} else if ($action == 'login') {
    $login = new Login();
    $result = $login->login($_POST['email'], $_POST['password']);
    if ($result) {
        $status = $result;
    }
}

// new code end


// $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if (!$connection) {
    throw new Exception("Not connected<br>");
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styling.css">
	<title>Vocabularies Builder</title>
</head>
<body class="home" style="background: #d5d8dc; ">

<div class="container" id="main">
	<h1 class="maintitle" align="center">
		<i class="fas fa-language"></i><br> My Vocabularies
	</h1>
	<div class="row navigation">
		<div class="column column-60 column-offset-20">
			<div class="formaction" align="center">
				<a href="#" id="login">Login</a> | <a href="#" id="register">Register</a>
			</div>
			<div class="formc" style="background-color: #fff;padding: 25px;box-shadow: 5px 5px 5px grey;">
				<form id="form01" method="post" action="">
                    <p>
                        <?php
if ($status) {
    echo getStatusCode($status);
}
?>
                    </p>

					<h3 id="logregheader">Login</h3>
					<fieldset>
						<label for="email">Email</label>
						<input type="text" name="email" id="email" placeholder="Enter Email">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" placeholder="Enter Password">
                       	<p>

                       	</p>
                        <input type="submit" class="button-primary" value="Submit">
                        <input type="hidden" name="submit" id="action" value="login">
					</fieldset>
				</form>
			</div>
		</div>

	</div>
</div>
</body>
<script src="//code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="assets/js/script.js"></script>
</html>

<script>
  $("#login").click(function(){
    let log = document.getElementById("logregheader");
    log.innerHTML = "Login";
    $("#action").val("login");
  })

  $("#register").click(function(){
    let reg = document.getElementById("logregheader");
    reg.innerHTML = "Register";
    $("#action").val("register");
  })
</script>