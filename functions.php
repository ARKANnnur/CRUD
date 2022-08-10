<?php 
// koneksi ke database
$conn =  mysqli_connect("localhost", "root", "", "db_waifu");



function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
    $nama = htmlspecialchars($data ["nama"]);
    $age = htmlspecialchars($data ["age"]);
    $hoby = htmlspecialchars($data ["hoby"]);
    $fav = htmlspecialchars($data ["fav"]);


// upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO waifu VALUES('', '$nama', '$age', '$hoby', '$fav', '$gambar') ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>
        alert('pilih gambar dulu!');
        </script>";
        return false;
    }
    $ekstensiGambarValid = ['jpg','jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
        <script>
        alert('pilih gambar TODDD!');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "
        <script>
        alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    // lolos pengecekan, gambar siap di upload
    // generate nama gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    // $format = pathinfo($namaFile,PATHINFO_EXTENSION);
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;


}


function ubah($data) {
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $age = htmlspecialchars($data["age"]);
    $hoby = htmlspecialchars($data["hoby"]);
    $fav = htmlspecialchars($data["fav"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);


// cek user apakah pilih gambar baru/tidak
if($_FILES["gambar"]["error"] === 4) {
    $gambar = $gambarlama;
} else {
    $gambar = upload();
}

    $query = "UPDATE waifu SET
    nama = '$nama',
    age = '$age',
    hoby = '$hoby',
    fav = '$fav',
    gambar = '$gambar'
    WHERE id = $id
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM waifu WHERE id = $id");
    return mysqli_affected_rows($conn);

    // $file = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM waifu WHERE id='$id'"));
    // unlink('img/' . $file["gambar"]);
    // $hapus = "DELETE FROM waifu WHERE id='$id'";
    // mysqli_query($koneksi,$hapus);
    // return mysqli_affected_rows($koneksi);
}

function cari($keyword) {
    $query = "SELECT * FROM waifu WHERE 
        nama LIKE '$keyword%' OR
        age LIKE '$keyword%' OR
        hoby LIKE '$keyword%' OR
        fav LIKE '$keyword%' 
            ";
    return query($query);
}


function signup($data) {
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if( mysqli_fetch_assoc($result) ) {
        echo
        "<script>
        alert('Username sudah terdaftar!');
        </script>";
        return false;
    }


    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo
        "<script>
            alert('konfirmasi password tidak sesuai!');
        </script>";
        return false;
    } 

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', 'password')");

    return mysqli_affected_rows($conn); 


}


?>
