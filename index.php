<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("location: login.php");
}

require "functions.php";

// pagination
// konfigurasi
// ceil=bulatkan keatas,floor= bulatkan ke bawah,round=bulatkan.
$jumlahdataperhalaman = 3;
$jumlahdata = count(query("SELECT * FROM waifu"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$hal_on = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $hal_on) - $jumlahdataperhalaman;


$waifu = query("SELECT * from waifu LIMIT $awaldata,$jumlahdataperhalaman");

if( isset($_POST["cari"]) ) {
    $waifu = cari($_POST["keyword"]);
}; 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Admin</title>
    <style>
        h1 {
            align-items: center;
            text-align: center;
        }
        table {
            align-items: center;
            text-align: center;
            margin: 0 auto;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<a href="logout.php">logout</a>

    <h1>Daftar Waifu</h1>

<center><a href="tambah.php">Tambah data waifu</a></center>
<br><br>

<center>
    <form action="" method="post">

        <input type="text" name="keyword" size="50px" autofocus
        placeholder="masukan:pencarian" autocomplete="off" 
        id="keyword">

        <button type="submit" name="cari" id="tombol-cari">Cari</button>

    </form>
</center><br>


<div id="container">
<!-- navigasi -->
<center>
    <?php if( $hal_on > 1) : ?>
        <a href="?halaman=<?= $hal_on - 1; ?>">&laquo;</a>
<?php endif; ?>


<?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
    
    <?php if( $i == $hal_on) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color:chartreuse;"><?=  $i; ?></a>
    <?php else : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold;"><?=  $i; ?></a>
    <?php endif; ?>

<?php endfor;?>

<?php if( $hal_on < $jumlahhalaman) : ?>
    <a href="?halaman=<?= $hal_on + 1; ?>">&raquo;</a>
<?php endif; ?>
</center>
<!-- navigation -->



<table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>age</th>
            <th>Hoby</th>
            <th>Fav</th>

        </tr>
        <?php $i = 1;?>
        <?php foreach( $waifu as $row) : ?>
        <tr>
            <td><?= $i?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a>
                <a href="hapus.php?id=<?= $row["id"]; ?>"
                 onclick="return confirm('yakin');">hapus</a>
            </td>
            <td><img src="img/<?= $row["gambar"] ;?>" width="50"></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["age"]; ?></td>
            <td><?= $row["hoby"]; ?></td>
            <td><?= $row["fav"]; ?></td>
        </tr>
        <?php $i++;?>
        <?php endforeach ;?>
</table>
</div>

<script src="js/script.js"></script>
</body>
</html>