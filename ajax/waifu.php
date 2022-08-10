<?php 
require'../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM waifu WHERE 
            nama LIKE '$keyword%' OR
            age LIKE '$keyword%' OR
            hoby LIKE '$keyword%' OR
            fav LIKE '$keyword%' 
                ";
$waifu = query($query);
?>


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
