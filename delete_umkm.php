<?php
include 'db.php';

$id = $_POST['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM umkm WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header('Location: daftarUmkm.php');
exit;
