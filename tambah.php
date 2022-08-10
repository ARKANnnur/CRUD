<?php 

session_start();

if( !isset($_SESSION["login"]) ){
    header("location: login.php");
}

require 'functions.php';

// cek tombol submit sudah di tekan/belum
if( isset($_POST["submit"]) ) {


    // cek data apakah berhasil di tambahkan atau tidak
    if( tambah($_POST)  > 0 ) {
        echo "<script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'index.php';
        </script>";
    }else {
        echo "<script>
        alert('data gagal ditambahkan!');
        document.location.href = 'index.php';
        </script>";
    }

}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data waifu</title>
</head>
<body>
    <h1>Tambah data waifu</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="age">Age : </label>
                <input type="text" name="age" id="age" required>
            </li>
            <li>
                <label for="hoby">Hoby : </label>
                <input type="text" name="hoby" id="hoby" required>
            </li>
            <li>
                <label for="fav">Fav : </label>
                <input type="text" name="fav" id="fav" required>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data!</button>
            </li>
        </ul>


    </form>
    <a href="index.php" type="submit">Kembali</a>



</body>
</html>