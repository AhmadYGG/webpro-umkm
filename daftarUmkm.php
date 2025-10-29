<?php
include 'db.php';
$result = $conn->query("SELECT * FROM umkm ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Daftar UMKM</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .add-btn {
      background: #cb997e;
      color: #fff;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: .2s;
    }

    .add-btn:hover {
      background: #b08968;
    }

    .action-btn {
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .edit-btn {
      background: #6b705c;
      color: #fff;
    }

    .delete-btn {
      background: #d62828;
      color: #fff;
    }

    table td {
      vertical-align: middle;
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
    <h2 style="text-align:center;">UMKM Terdaftar</h2>
    <div style="text-align:right;margin-right:45px;margin-bottom:15px;">
      <a href="tambahUmkm.php"><button class="add-btn">+ Tambah UMKM</button></a>
    </div>
    <table border="1" align="center">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama UMKM</th>
          <th>Deskripsi</th>
          <th>Lokasi</th>
          <th>Instagram</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
        while ($item = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($item['nama']) ?></td>
            <td><?= htmlspecialchars($item['deskripsi']) ?></td>
            <td style="text-align:center;">
              <iframe src="<?= htmlspecialchars($item['lokasi']) ?>" width="300" height="200" style="border:1px solid #ccc;"></iframe>
            </td>
            <td>
              <?php
              $ig = ltrim($item['instagram'], '@'); // hapus tanda @ di depan kalau ada
              $ig_url = "https://instagram.com/" . $ig;
              ?>
              <a href="<?= htmlspecialchars($ig_url) ?>" target="_blank" style="color:#E4405F; text-decoration:none;">
                @<?= htmlspecialchars($ig) ?>
              </a>
            </td>

            <td style="text-align:center;">
              <a href="editUmkm.php?id=<?= $item['id'] ?>"><button class="action-btn edit-btn">Edit</button></a>
              <form method="POST" action="delete_umkm.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" class="action-btn delete-btn" onclick="return confirm('Yakin hapus data ini?')">Delete</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
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