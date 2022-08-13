<?php 
require 'functions.php';


if( isset($_POST["signup"]) ){
    if( signup($_POST) > 0 ){
        echo "
        <script>
            alert('user baru berhasil ditambahkan!');
            document.location.href = 'login.php';
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label {
            display: block;
        }
        ul {
            list-style: none;
        }
    </style>
</head>
<body>
    <center><h1>Halaman Registrasi</h1></center>
<center> <form action="" method="post">
    <ul>
        <li>
            <label for="username">username :</label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="username">password :</label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <label for="password2">konfirmasi password :</label>
            <input type="password" name="password2" id="password2 " required>
        </li>
        <li>
            <button type="submit" name="signup">Sign up</button>
        </li>
    </ul>

</form></center>  
<a href="login.php">login</a>
</body>
</html>