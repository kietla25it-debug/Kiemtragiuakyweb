<?php
require_once 'db.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idgv = $_POST['IDGV'];
    $fullname = $_POST['Fullname'];
    $sumclass = $_POST['SumClass'];
    $image = $_FILES['Image']['name'];
    $target = "uploads/" . basename($image);
    
    $check = $conn->query("SELECT * FROM GiangVien WHERE IDGV = '$idgv'");
    if($check->num_rows > 0) {
        $msg = "<div class='alert alert-danger shadow-sm border-0'><i class='fas fa-exclamation-triangle me-2'></i> Mã giảng viên đã tồn tại!</div>";
    } else {
        if (move_uploaded_file($_FILES['Image']['tmp_name'], $target)) {
            $sql = "INSERT INTO GiangVien (IDGV, Fullname, Image, SumClass) VALUES ('$idgv', '$fullname', '$image', '$sumclass')";
            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
                exit();
            } else {
                $msg = "<div class='alert alert-danger shadow-sm border-0'>Lỗi: " . $conn->error . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger shadow-sm border-0'><i class='fas fa-times-circle me-2'></i> Lỗi upload ảnh! Đảm bảo thư mục 'uploads' đã được tạo.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Giảng Viên Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="custom-card col-md-6 col-lg-5" style="margin-top: 0;">
            <div class="text-center mb-4">
                <div class="d-inline-block bg-primary bg-opacity-10 p-3 rounded-circle mb-3">
                    <i class="fas fa-user-tie fa-2x text-primary"></i>
                </div>
                <h3 class="fw-bold">Thêm Mới Giảng Viên</h3>
                <p class="text-muted">Nhập thông tin chi tiết của giảng viên vào form bên dưới</p>
            </div>
            
            <?= $msg ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Mã Giảng Viên (IDGV)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" name="IDGV" placeholder="Ví dụ: GV01" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Họ và Tên</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                        <input type="text" class="form-control" name="Fullname" placeholder="Nhập họ và tên..." required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Hình Ảnh Đại Diện</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                        <input type="file" class="form-control" name="Image" accept="image/*" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Tổng Số Lớp Đảm Nhận</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                        <input type="number" class="form-control" name="SumClass" placeholder="Nhập số lớp..." required min="0">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-gradient-primary w-100 mb-3 py-2 fs-5">
                    <i class="fas fa-save me-2"></i>Lưu Giảng Viên
                </button>
                <a href="index.php" class="btn btn-light w-100 rounded-3 py-2 fw-semibold border">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                </a>
            </form>
        </div>
    </div>
</body>
</html>