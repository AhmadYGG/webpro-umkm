<?php
include 'db.php';

$id = $_GET['id'] ?? null;
$nama = $deskripsi = $lokasi = $instagram = '';

if ($id) {
  $stmt = $conn->prepare("SELECT * FROM umkm WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_assoc();
  $nama = $result['nama'];
  $deskripsi = $result['deskripsi'];
  $lokasi = $result['lokasi'];
  $instagram = $result['instagram'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title><?= $id ? 'Edit' : 'Tambah' ?> UMKM</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .form-container {
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      margin-top: 12px;
      font-size: 14px;
      font-weight: bold;
    }

    input,
    textarea {
      width: 100%;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-top: 5px;
    }

    .save-btn {
      margin-top: 15px;
      background-color: #cb997e;
      color: #fff;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }

    .save-btn:hover {
      background-color: #b08968;
    }
  </style>
</head>

<body>
  <header>
    <h1>Wadah UMKM Blitar</h1>
    <p>Menumbuhkan Ekonomi Lokal, Satu Produk Satu Cerita</p>
  </header>
  <div class="navbar">
    <ul>
      <li><a href="index.html">Beranda</a></li>
      <li><a href="daftarUmkm.php">Daftar UMKM</a></li>
      <li><a href="artikel.html">Artikel</a></li>
      <li><a href="berita.html">Berita</a></li>
      <li><a href="tentangKami.html">Tentang Kami</a></li>
      <li><a href="biodata.html">Biodata</a></li>
      <li><a href="kontakKami.html">Kontak</a></li>
      <li><a href="kisahSukses.html">Kisah Sukses</a></li>
    </ul>
  </div>
  <div class="main-content fade-in visible">
    <h2>Tambah UMKM</h2>
    <div class="form-container">
      <form method="POST" action="proses_umkm.php">
        <input type="hidden" name="id" value="<?= $id ?>" required>

        <label>Nama UMKM:</label><br>
        <input placeholder="Nama umkm yang ingin ditambahkan" type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required><br>

        <label>Deskripsi:</label><br>
        <textarea placeholder="Deksripsi tentang umkm yang ingin ditambahkan" name="deskripsi" required><?= htmlspecialchars($deskripsi) ?></textarea><br>

        <label>Lokasi (paste iframe Google Maps):</label><br>
        <textarea placeholder="Link lokasi dari google maps" name="lokasi" required><?= htmlspecialchars($lokasi) ?></textarea><br>
        <small style="
          display:block;
          color:#888;
          font-style:italic;
          margin-top:-5px;
          margin-bottom:15px;
        ">
          <b>Catatan:</b> Pergi ke Google Maps → klik <b>Bagikan</b> → pilih <b>Sematkan peta</b> → lalu klik <b>Salin HTML</b>, dan tempelkan ke kolom diatas.
        </small>

        <label>Instagram:</label><br>
        <input type="text" name="instagram"
          value="<?= htmlspecialchars($instagram) ?>"
          placeholder="@username"
          required><br><br>

        <button type="submit" class="save-btn">Update</button>
        <button type="button" class="save-btn" style="background-color:#6c757d; margin-left:10px" onclick="window.location.href='daftarUmkm.php'">Kembali</button>
      </form>

    </div>
  </div>
  <footer class="footer">
    <div class="footer-container">
        <p>
          <center>“Blitar Berdaya, UMKM Berkembang — Satu Produk, Satu Cerita, Satu Kebanggaan.”</center>
        </p>
    </div>

    <div class="footer-bottom">
      &copy; 2025 Wadah UMKM Blitar.  All Rights Reserved.
    </div>
  </footer>
</body>

</html>