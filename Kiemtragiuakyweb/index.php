<?php 
require_once 'db.php'; 

// Truy vấn đếm Tổng số giảng viên và Tổng số lớp (Luôn hiển thị tổng của toàn hệ thống)
$sql_stats = "SELECT COUNT(IDGV) as TotalGV, SUM(SumClass) as TotalClass FROM GiangVien";
$result_stats = $conn->query($sql_stats);
$stats = $result_stats->fetch_assoc();

$totalGV = $stats['TotalGV'] ? $stats['TotalGV'] : 0;
$totalClass = $stats['TotalClass'] ? $stats['TotalClass'] : 0;

// Xử lý từ khóa tìm kiếm (nếu có)
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Giảng Viên - VKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- THANH MENU (NAVBAR) -->
    <nav class="navbar navbar-expand-lg custom-navbar mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-school text-primary me-2"></i>TRường LAK
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php"><i class="fas fa-home me-1"></i> Bảng điều khiển</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php"><i class="fas fa-user-plus me-1"></i> Thêm mới</a>
                    </li>
                    
                    <!-- Menu Liên hệ dạng Dropdown -->
                    <li class="nav-item dropdown ms-lg-2 mt-2 mt-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" id="contactDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-headset me-1"></i> Liên hệ
                        </a>
                        <ul class="dropdown-menu shadow border-0 mt-2" aria-labelledby="contactDropdown" style="border-radius: 12px; min-width: 260px;">
                            <li class="px-3 py-2 text-center border-bottom bg-light" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                <div class="fw-bold text-primary mb-1"><i class="fas fa-info-circle me-1"></i> Thông Tin Hỗ Trợ</div>
                                <small class="text-muted">Khoa Công nghệ Thông tin - VKU</small>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 mt-1 d-flex align-items-center" href="tel:0901234567">
                                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <span class="fw-medium text-dark">090 123 4567</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 d-flex align-items-center" href="mailto:kietla.25it@vku.udn.vn">
                                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <span class="fw-medium text-dark">kietla.25it@vku.udn.vn</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 mb-1 d-flex align-items-center" href="https://vku.udn.vn" target="_blank">
                                    <div class="bg-info bg-opacity-10 text-info rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <span class="fw-medium text-dark">Website Trường</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Form Tìm kiếm trên Menu -->
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <form class="d-flex" method="GET" action="index.php">
                            <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0;">
                                <input type="text" class="form-control border-0 bg-light px-3" name="search" placeholder="Tìm tên, mã GV..." value="<?= htmlspecialchars($search) ?>">
                                <button class="btn btn-light border-0 text-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </li>

                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <span class="d-flex align-items-center bg-light rounded-pill px-3 py-2 border shadow-sm">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=667eea&color=fff" class="rounded-circle me-2" width="30">
                            <span class="fw-bold text-dark">Quản trị viên</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- VÙNG THỐNG KÊ (STAT CARDS) -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ms-4">
                        <h6 class="text-muted fw-bold text-uppercase mb-1">Tổng Số Giảng Viên</h6>
                        <h2 class="fw-bold mb-0 text-dark"><?= $totalGV ?> <span class="fs-6 text-muted fw-normal">người</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-success-gradient">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="ms-4">
                        <h6 class="text-muted fw-bold text-uppercase mb-1">Tổng Lớp Đảm Nhận</h6>
                        <h2 class="fw-bold mb-0 text-dark"><?= $totalClass ?> <span class="fs-6 text-muted fw-normal">lớp</span></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- BẢNG DANH SÁCH -->
        <div class="custom-card mt-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-primary" style="background: -webkit-linear-gradient(#667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    <i class="fas fa-graduation-cap me-2"></i>
                    <?= $search != '' ? 'Kết Quả Tìm Kiếm: "' . htmlspecialchars($search) . '"' : 'Hệ Thống Quản Lý Giảng Viên' ?>
                </h3>
                <a href="add.php" class="btn btn-gradient-primary">
                    <i class="fas fa-user-plus me-1"></i> Thêm Giảng Viên
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-custom text-center">
                    <thead>
                        <tr>
                            <th>Mã GV</th>
                            <th>Ảnh Đại Diện</th>
                            <th>Họ và Tên</th>
                            <th>Tổng Số Lớp</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Logic tìm kiếm
                        if ($search != '') {
                            $sql = "SELECT * FROM GiangVien WHERE Fullname LIKE '%$search%' OR IDGV LIKE '%$search%' ORDER BY IDGV ASC";
                        } else {
                            $sql = "SELECT * FROM GiangVien ORDER BY IDGV ASC";
                        }
                        
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td class='fw-bold text-secondary'>{$row['IDGV']}</td>
                                        <td><img src='uploads/{$row['Image']}' alt='avatar' class='avatar-img'></td>
                                        <td class='fw-bold text-dark'>{$row['Fullname']}</td>
                                        <td><span class='badge rounded-pill bg-info text-dark px-3 py-2 fs-6 shadow-sm'><i class='fas fa-chalkboard-user me-1'></i> {$row['SumClass']} Lớp</span></td>
                                        <td>
                                            <a href='edit.php?id={$row['IDGV']}' class='btn btn-sm btn-warning rounded-3 me-2 shadow-sm text-dark fw-bold'><i class='fas fa-edit'></i> Sửa</a>
                                            <a href='delete.php?id={$row['IDGV']}' class='btn btn-sm btn-danger rounded-3 shadow-sm fw-bold' onclick='return confirm(\"Bạn có chắc chắn muốn xóa giảng viên này?\")'><i class='fas fa-trash-alt'></i> Xóa</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr>
                                    <td colspan='5' class='text-center py-5 text-muted'>
                                        <i class='fas fa-search fa-3x mb-3 text-light'></i><br>
                                        Không tìm thấy giảng viên nào phù hợp với từ khóa.
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap cho Navbar responsive và Dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>