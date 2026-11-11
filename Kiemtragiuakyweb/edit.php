<?php
require_once 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM GiangVien WHERE IDGV = '$id'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['Fullname'];
    $sumclass = $_POST['SumClass'];
    $image = $_FILES['Image']['name'];
    
    if (!empty($image)) {
        // Có upload ảnh mới
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['Image']['tmp_name'], $target);
        $sql = "UPDATE GiangVien SET Fullname='$fullname', SumClass='$sumclass', Image='$image' WHERE IDGV='$id'";
    } else {
        // Giữ nguyên ảnh cũ
        $sql = "UPDATE GiangVien SET Fullname='$fullname', SumClass='$sumclass' WHERE IDGV='$id'";
    }
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập Nhật Giảng Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="custom-card col-md-6 mt-5">
            <h4 class="fw-bold mb-4 text-center">Cập Nhật Thông Tin</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mã Giảng Viên</label>
                    <input type="text" class="form-control rounded-3" value="<?= $row['IDGV'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Họ và Tên</label>
                    <input type="text" class="form-control rounded-3" name="Fullname" value="<?= $row['Fullname'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hình Ảnh (Để trống nếu không đổi)</label><br>
                    <img src="uploads/<?= $row['Image'] ?>" class="avatar-img mb-2">
                    <input type="file" class="form-control rounded-3" name="Image" accept="image/*">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tổng Số Lớp</label>
                    <input type="number" class="form-control rounded-3" name="SumClass" value="<?= $row['SumClass'] ?>" required min="0">
                </div>
                <button type="submit" class="btn btn-warning w-100 mb-2 fw-bold rounded-3 text-white">Cập Nhật</button>
                <a href="index.php" class="btn btn-light w-100 rounded-3">Hủy</a>
            </form>
        </div>
    </div>
</body>
</html>