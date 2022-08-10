<?php 

session_start();

if( !isset($_SESSION["login"]) ){
    header("location: login.php");
}

require 'functions.php';

// ambil data di url
$id = $_GET["id"];
// quey data waifu
$wf = query("SELECT * from waifu WHERE id = $id")[0] ; 

// cek tombol submit sudah di tekan/belum
if( isset($_POST["submit"]) ) {

    // cek data apakah berhasil di ubah atau tidak
    if( ubah($_POST)  > 0 ) {
        echo "<script>
        alert('data berhasil ubah!');
        document.location.href = 'index.php';
        </script>";
    }else {
        echo "<script>
        alert('data gagal ubah!');
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
    <title>Ubah data waifu</title>
</head>
<body>
    <h1>Ubah data waifu</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $wf["id"]; ?>">
        <input type="hidden" name="gambarlama" value="<?= $wf["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required
                value="<?= $wf["nama"]; ?>">
            </li>
            <li>
                <label for="age">Age : </label>
                <input type="text" name="age" id="age" required
                value="<?= $wf["age"]; ?>">
            </li>
            <li>
                <label for="hoby">Hoby : </label>
                <input type="text" name="hoby" id="hoby" required
                value="<?= $wf["hoby"]; ?>">
            </li>
            <li>
                <label for="fav">Fav : </label>
                <input type="text" name="fav" id="fav" required
                value="<?= $wf["fav"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <img src="img/<?= $wf["gambar"]; ?>" width="100px" height="100px">
                <input type="file" name="gambar" id="gambar" accept="image/*">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>


    </form>
    <a href="index.php" type="submit">Kembali</a>



</body>
</html>
