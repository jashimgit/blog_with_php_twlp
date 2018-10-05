<?php
include_once '../lib/Session.php';
include_once '../helpers/Login.php';
include '../lib/Database.php';
include '../config/config.php';
include '../helpers/Format.php';

Session::init();
$db = new Database();
$login = new Login();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $login->validation($_POST['username']);
        $password = $login->validation(md5($_POST['password']));

        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);


        $query = "SELECT * FROM tbl_users  WHERE username = '$username' AND password = '$password'";

        $result = $db->select($query);


        if ($result != false){
            $value = mysqli_fetch_array($result);
            $row = mysqli_num_rows($result);
            if ($row > 0 ){
                Session::setData("login", true);
                Session::setData("username", $value['username']);
                Session::setData("userId", $value['id']);
                header('Location:index.php');

            } else {
                echo "<span style='color:red; font-size:20px;' > No result found </span>";
            }
        }else {
            echo "<span style='color:red; font-size:20px;' > username or Password does not matched !!. </span>";
        }

    }


?>

		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>