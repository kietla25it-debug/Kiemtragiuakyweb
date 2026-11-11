<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Xóa file ảnh trong folder uploads trước khi xóa data
    $result = $conn->query("SELECT Image FROM GiangVien WHERE IDGV = '$id'");
    if ($row = $result->fetch_assoc()) {
        $imgPath = "uploads/" . $row['Image'];
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }
    }
    
    // Xóa record trong DB
    $sql = "DELETE FROM GiangVien WHERE IDGV = '$id'";
    $conn->query($sql);
    
    header("Location: index.php");
    exit();
}
?>