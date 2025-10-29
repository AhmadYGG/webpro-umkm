<?php
include 'db.php';

$id = $_POST['id'] ?? null;
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$instagram = $_POST['instagram'];

// parse src
$map_src = '';
if (preg_match('/<iframe.*?src=["\'](.*?)["\'].*?>/i', $lokasi, $matches)) {
    $map_src = $matches[1];
}

if ($id) {
    $stmt = $conn->prepare("UPDATE umkm SET nama=?, deskripsi=?, lokasi=?, instagram=? WHERE id=?");
    $stmt->bind_param("ssssi", $nama, $deskripsi, $map_src, $instagram, $id);
} else {
    $stmt = $conn->prepare("INSERT INTO umkm (nama, deskripsi, lokasi, instagram) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $deskripsi, $map_src, $instagram);
}

$stmt->execute();
header('Location: daftarUmkm.php');
exit;
