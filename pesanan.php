<?php
include 'koneksi.php';
$sql = "SELECT * FROM Pesanan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Air</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
</head>
<style>
    footer {
  position: fixed;
  bottom: 0;
  width: 100%;
}
</style>
<body>
    <header>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">Nama Toko Anda</a>
            </div>
        </nav>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pesanan.php">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pembayaran.php">Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentangkami.php">Tentang Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-4">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="card">';
                        echo '<div class="card-header bg-primary text-white">';
                        echo "Pesanan #" . $row["PesananID"];
                        echo '</div>';
                        echo '<div class="card-body">';
                        echo "<h5 class='card-title'>Tanggal Pesanan: " . $row["TanggalPesanan"] . "</h5>";
                        echo "<p class='card-text'>Status Pesanan: " . $row["StatusPesanan"] . "</p>";
                        echo "<p class='card-text'>Total Harga: Rp" . $row["TotalHarga"] . "</p>";
                        echo "<a href='detailpesanan.php?PesananID=" . $row["PesananID"] . "' class='btn btn-primary'>Detail Pesanan</a>";
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p class='col-md-12'>Tidak ada pesanan.</p>";
                }
                ?>
            </div>
        </div>
    </main>
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3">
            &copy; 2024 Penjualan Air
        </div>
    </footer>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
