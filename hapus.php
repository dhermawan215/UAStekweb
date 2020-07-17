<?php

include "function/functions.php";
$id = $_GET["id"];

mysqli_query($koneksi, "DELETE FROM siswa WHERE id = $id");



if (mysqli_affected_rows($koneksi) > 0) {
    echo "
    <script>
        alert('data berhasil dihapus!');
        document.location.href = 'index.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('data gagal di hapus!');
    </script>
    ";
}
