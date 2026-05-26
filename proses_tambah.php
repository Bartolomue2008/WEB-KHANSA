<?php
include 'koneksi.php';

$nama   = $_POST['nama'];
$email  = $_POST['email'];
$alamat = $_POST['alamat'];

$query = mysqli_query($koneksi,
"INSERT INTO identitas VALUES(
NULL,
'$nama',
'$email',
'$alamat'
)");

if ($query) {

    echo "
    <script>
        alert('Data berhasil ditambah');
        window.location='index.php';
    </script>
    ";

} else {

    echo "Data gagal ditambah";

}
?>