<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
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
                <a class="navbar-brand" href="#">Daftar Karyawan</a>
            </div>
        </nav>
    </header>
    <main class="container mt-4">
        <div class="row">
            <?php
            $sql = "SELECT * FROM karyawan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card">';
                    echo '<img src="'.$row["Foto"].'" class="card-img-top" alt="Foto Karyawan">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$row["Nama"].'</h5>';
                    echo '<p class="card-text">Posisi: '.$row["Posisi"].'</p>';
                    echo '<p class="card-text">Nomor Telepon: '.$row["NomorTelepon"].'</p>';
                    echo '<p class="card-text">Email: '.$row["Email"].'</p>';
                    echo '<p class="card-text">Alamat: '.$row["Alamat"].'</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Tidak ada karyawan yang ditemukan.</p>";
            }
            ?>
        </div>
    </main>
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3">
            &copy; 2024 Daftar Karyawan
        </div>
    </footer>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
