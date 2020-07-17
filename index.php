<?php

include "function/functions.php";

$perpage = 3;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

$results = mysqli_query($koneksi, "SELECT * FROM siswa LIMIT $start, $perpage");

$hasil = mysqli_query($koneksi, "SELECT * FROM siswa");
$total = mysqli_num_rows($hasil);

$pages = ceil($total / $perpage);

//searching 

$keyword = "";
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $results = mysqli_query($koneksi, "SELECT * FROM siswa
                                        WHERE nama LIKE '%$keyword%' ");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <title>Admin</title>

</head>

<body>
    <nav class="navbar">
        <a href="" class="logo">Selamat Datang |<b><span> Smart School</span></b></a>
        <ul>
            <li><a href="#" title="admin"><i class="fa fa-user"></i> Hai Admin</a></li>
            <li><a href="#" title="log-out"><i class="fa fa-sign-out-alt"></i> log out</a></li>
        </ul>
    </nav>
    <div class="row">
        <div class="kiri">
            <ul class="isi-kiri">
                <li class="item-kiri"><a href="#" title="Dashboard"><i class="fa fa-poll"></i>home</a> </li>
                <li class="item-kiri"><a href="#" title="Data Siswa"><i class="fa fa-user-graduate"></i>siswa</a> </li>
                <li class="item-kiri"><a href="#" title="Data Guru"><i class="fa fa-chalkboard-teacher"></i>guru</a> </li>
                <li class="item-kiri"><a href="#" title="System Setting"><i class="fa fa-user-cog"></i>setting</a> </li>
            </ul>

        </div>
        <div class="kanan">
            <div class="header">Dashboard</div>
            <div class="row">
                <div class="column">
                    <div class="card">
                        <h3 class="judul-text"><a href="tambah.php">Tambah data</a></h3>
                        <p>-</p>
                        <p>190 User</p>
                    </div>
                </div>

                <div class="column">
                    <div class="card2">
                        <h3 class="judul-text"><a href="#">Visit</a></h3>
                        <p>-</p>
                        <p>100 Online</p>
                    </div>
                </div>

                <div class="column">
                    <div class="card3">
                        <h3 class="judul-text"><a href="#">Date</a></h3>
                        <p>-</p>
                        <p>Monday, 4 May 2020</p>
                    </div>
                </div>

                <div class="column">
                    <div class="card4">
                        <h3 class="judul-text"><a href="#">Message</a></h3>
                        <p>-</p>
                        <p>No Message Yet</p>
                    </div>
                </div>
            </div>
            <h2 style="margin-left: 10px;">Search</h2>

            <form action="" method="post">
                <input type="text" name="keyword" id="keyword" class="myInput" size="40" autocomplete="off" placeholder="masukan keyword nama">
                <button type="submit" name="cari" class="cari">Cari ! </button>
            </form>

            <table id="myTable">
                <tr class="header">
                    <th style="width:5%;">No</th>
                    <th style="width:15%;">Aksi</th>
                    <th>Gambar</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                </tr>
                <tr>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($results)) : ?>
                        <td><?= $i; ?></td>
                        <td><a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a>|
                            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('anda yakin');">Hapus</a>
                        </td>
                        <td><img src="<?= $row["gambar"]; ?>" alt="" width="50%"></td>
                        <td><?= $row["nis"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["email"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>

                </tr>
                <?php $i++; ?>
            <?php endwhile; ?>


            </table>
            <div class="paginate">
                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <?php if ($i == $page) : ?>
                        <a href="?halaman=<?= $i ?>" style="font-weight : bold; color: red;"><?= $i ?></a>
                    <?php else : ?>
                        <a href="?halaman=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

        </div>



    </div>

    </div>
</body>

</html>