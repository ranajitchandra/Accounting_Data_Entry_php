<?php
    include_once 'db/db.php';
    session_start();

    if(isset($_POST["login"])) {
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']); 
        $password = md5($password);

        $sql = "SELECT id, user_role, user_name FROM user WHERE (user_name = '$username' or email = '$username') and password = '$password'";
        $query = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($query);


        if($count == 1) {
            $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
                $_SESSION["user_role"] = $result["user_role"];
                $_SESSION["user_name"] = $result["user_name"];

            if(!empty($_SESSION["user_role"] == "general")){
                header("location: dashboard.php");
                }elseif(!empty($_SESSION["user_role"] == "root_admin")){
				header("location: dashboard.php");
			    }else{
			        echo "You no access";
			    }
        }else {
            echo "<script>window.alert('Your Login Name or Password is invalid'); </script>";
            }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="box" style="height: 420px;">
            <span class="borderLine"></span>
            <form action="index.php" method="post">
                <h2>Sign in</h2>
                <div class="inputBox">
                    <input type="text" value="<?php if(isset($_GET['page_data'])){ echo $_GET['page_data']; } ?>" name="username" required="required">
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" name="password" required="required">
                    <span>Password</span>
                    <i></i>
                </div>
                <div class="links">
                    <a href="signup.php">Signup</a>
                </div>
                <input type="submit" name="login" value="Login">
            </form>
        </div>
    </body>
</html>
