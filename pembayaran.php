<?php
include 'koneksi.php';

// Fungsi untuk mendapatkan pesanan berdasarkan ID
function getPesanan($pesananID, $conn) {
    $sql = "SELECT * FROM Pesanan WHERE PesananID = $pesananID";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Fungsi untuk menyimpan pembayaran ke database
function savePembayaran($pesananID, $tanggalPembayaran, $totalDibayar, $metodePembayaran, $statusPembayaran, $conn) {
    $sql = "INSERT INTO Pembayaran (PesananID, TanggalPembayaran, TotalDibayar, MetodePembayaran, status_pembayaran) VALUES ('$pesananID', '$tanggalPembayaran', '$totalDibayar', '$metodePembayaran', '$statusPembayaran')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Memeriksa apakah ada data yang dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesananID = $_POST['pesananID'];
    $tanggalPembayaran = $_POST['tanggalPembayaran'];
    $totalDibayar = $_POST['totalDibayar'];
    $metodePembayaran = $_POST['metodePembayaran'];
    $statusPembayaran = $_POST['statusPembayaran'];

    // Memastikan total pembayaran sesuai dengan pesanan ID
    $pesanan = getPesanan($pesananID, $conn);
    if ($pesanan) {
        if ($totalDibayar == $pesanan['TotalHarga']) {
            // Menyimpan pembayaran
            if (savePembayaran($pesananID, $tanggalPembayaran, $totalDibayar, $metodePembayaran, $statusPembayaran, $conn)) {
                echo '<script>alert("Pembayaran berhasil disimpan.");</script>';
            } else {
                echo '<script>alert("Terjadi kesalahan saat menyimpan pembayaran.");</script>';
            }
        } else {
            echo '<script>alert("Total pembayaran tidak sesuai dengan total harga pesanan.");</script>';
        }
    } else {
        echo '<script>alert("Pesanan tidak ditemukan.");</script>';
    }
}

// Mengambil data pembayaran
$sql_pembayaran = "SELECT * FROM Pembayaran";
$result_pembayaran = $conn->query($sql_pembayaran);
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
            <h2>Form Pembayaran</h2>
            <form method="post">
                <div class="form-group">
                    <label for="pesananID">ID Pesanan:</label>
                    <input type="number" class="form-control" id="pesananID" name="pesananID" required>
                </div>
                <div class="form-group">
                    <label for="tanggalPembayaran">Tanggal Pembayaran:</label>
                    <input type="date" class="form-control" id="tanggalPembayaran" name="tanggalPembayaran" required>
                </div>
                <div class="form-group">
                    <label for="totalDibayar">Total Dibayar:</label>
                    <input type="number" class="form-control" id="totalDibayar" name="totalDibayar" required>
                </div>
                <div class="form-group">
                    <label for="metodePembayaran">Metode Pembayaran:</label>
                    <select class="form-control" id="metodePembayaran" name="metodePembayaran" required>
                        <option value="qris">QRIS</option>
                        <option value="abc_cek_otomatis">ABC Cek Otomatis</option>
                        <option value="cod">COD</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="statusPembayaran">Status Pembayaran:</label>
                    <input type="text" class="form-control" id="statusPembayaran" name="statusPembayaran" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr>
            <h2>Riwayat Pembayran</h2>
            <div class="row">
                <?php
                if ($result_pembayaran->num_rows > 0) {
                    while($row_pembayaran = $result_pembayaran->fetch_assoc()) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="card">';
                        echo '<div class="card-header bg-success text-white">';
                        echo "Pembayaran #" . $row_pembayaran["PembayaranID"];
                        echo '</div>';
                        echo '<div class="card-body">';
                        echo "<h5 class='card-title'>Tanggal Pembayaran: " . $row_pembayaran["TanggalPembayaran"] . "</h5>";
                        echo "<p class='card-text'>Total Dibayar: Rp" . $row_pembayaran["TotalDibayar"] . "</p>";
                        echo "<p class='card-text'>Metode Pembayaran: " . $row_pembayaran["MetodePembayaran"] . "</p>";
                        echo "<p class='card-text'>Status Pembayaran: " . $row_pembayaran["status_pembayaran"] . "</p>";
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p class='col-md-12'>Tidak ada data pembayaran.</p>";
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
