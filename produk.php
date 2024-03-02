<?php include 'koneksi.php'; ?>
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
    <main class="container mt-4">
        <h2 class="mb-4">Produk Kami</h2>
        <div class="row">
        <?php
        $sql = "SELECT * FROM Produk";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<i class="fas fa-glass-whiskey fa-2x"></i>';
                echo '<h5 class="card-title">'.$row["NamaProduk"].'</h5>';
                echo '<p class="card-text">'.$row["Deskripsi"].'</p>';
                echo '<p class="text-muted">Harga: Rp'.$row["Harga"].'</p>';
                echo '<a href="pesanan.php?id_produk='.$row['ProdukID'].'" class="btn btn-primary">Beli</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p class='col-md-12'>Tidak ada produk yang ditemukan.</p>";
        }
        ?>
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
