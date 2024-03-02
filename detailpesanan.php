<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Air</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
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
                        <a class="nav-link" href="index.html">Beranda</a>
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
    <main class="container mt-4">
        <!-- Isi utama halaman -->
        <div class="card">
            <div class="card-header">Detail Pesanan</div>
            <div class="card-body">
                <?php
                include 'koneksi.php';
                $PesananID = isset($_GET['PesananID']) ? $_GET['PesananID'] : die('ERROR: Pesanan ID tidak ditemukan.');
                $sql = "SELECT * FROM Pesanan WHERE PesananID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $PesananID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<h5 class="card-title">Pelanggan ID: '.$row['PelangganID'].'</h5>';
                    echo '<p class="card-text">Tanggal Pesanan: '.$row['TanggalPesanan'].'</p>';
                    echo '<p class="card-text">Status Pesanan: '.$row['StatusPesanan'].'</p>';
                    echo '<p class="card-text">Total Harga: Rp'.$row['TotalHarga'].'</p>';
                    // Tambahkan lebih banyak detail sesuai kebutuhan
                } else {
                    echo "<p>Detail pesanan tidak ditemukan.</p>";
                }
                ?>
            </div>
            <div class="card-footer">
                <!-- Tombol untuk menuju halaman pembayaran.php -->
                <a href="pembayaran.php" class="btn btn-primary">Lanjut ke Pembayaran</a>
            </div>
        </div>
    </main>
    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3">
            &copy; 2024 Penjualan Air
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
