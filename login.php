<?php 

session_start();

require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }


}

if( isset($_SESSION["login"])) {
    header("location: index.php");
}



if( isset($_POST["login"]) ){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result)) {     
// // cek password
$row = mysqli_fetch_assoc($result);
// if(password_verify($password, $row["password"]) ) {

        $_SESSION["login"] = true;


            if( isset($_POST['remember']) ) {
                // buat cookie
                setcookie('id', $row['id'], time()+ 1000);
                setcookie('key', hash('sha256', $row['username']), time()+ 1000 );
            }


        header("location: index.php");
        exit;
    }

    $error = true;
}












?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if( isset($error)) : ?>
        <p>username / password salah</p> 
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
            <label for="username">username :</label>
            <input type="text" name="username" id="username" required>
            </li>
        <li>
            <label for="password">password :</label>
            <input type="password" name="password" id="password" required>
            </li>
        <li>
            <input type="checkbox" name="remember" id="remember" >
            <label for="remember">rememberme :</label>
            </li>
        <li>
            <button type="submit" name="login">Login</button>
         </li>
        </ul>

    </form>
</body>
</html>