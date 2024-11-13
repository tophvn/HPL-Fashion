<?php
include('../config/Database.php');
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$conn = Database::getConnection();
$user_id = $_SESSION['user']['user_id'];

// Xử lý khi người dùng cập nhật địa chỉ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_address'])) {
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    // Cập nhật địa chỉ
    $query = "UPDATE users SET address1 = '$address1', address2 = '$address2' WHERE user_id = $user_id";
    $conn->query($query);

    // Cập nhật session để lưu trạng thái tab
    $_SESSION['active_tab'] = 'address';
    header("Location: account.php");
    exit();
}

// Lấy thông tin người dùng
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($query);
$user = $result->fetch_assoc();

// Lấy tab đang mở từ session (mặc định là 'dashboard')
$active_tab = $_SESSION['active_tab'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tài Khoản - HPL FASHION</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../css/css-2.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <h2 class="text-center">TÀI KHOẢN</h2>
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><a href="#" id="dashboard-tab">Bảng điều khiển</a></li>
                    <li class="list-group-item"><a href="#" id="address-tab">Địa chỉ</a></li>
                    <li class="list-group-item"><a href="favorites.php">Danh sách yêu thích</a></li>
                </ul>
            </div>

            <!-- Bảng điều khiển -->
            <div class="col-md-9" id="dashboard-content" <?php echo $active_tab === 'dashboard' ? '' : 'style="display:none;"'; ?>>
                <!-- <p><strong>Lịch sử đặt hàng:</strong> Bạn vẫn chưa đặt hàng nào.</p> -->
                <div class="account-details">
                    <h4>Thông tin tài khoản</h4>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Tên:</strong></td>
                                <td><?php echo htmlspecialchars($user['name'] ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td><strong>E-mail:</strong></td>
                                <td><?php echo htmlspecialchars($user['email'] ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Số Điện Thoại:</strong></td>
                                <td><?php echo htmlspecialchars($user['phonenumber'] ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Địa chỉ 1:</strong></td>
                                <td><?php echo htmlspecialchars($user['address1'] ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Địa chỉ 2:</strong></td>
                                <td><?php echo htmlspecialchars($user['address2'] ?? ''); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Địa Chỉ -->
            <div class="col-md-9" id="address-content" <?php echo $active_tab === 'address' ? '' : 'style="display:none;"'; ?>>
                <h4>Địa Chỉ</h4>
                <form method="POST" action="account.php">
                    <input type="hidden" name="update_address" value="1">
                    <div class="form-group">
                        <label>Địa chỉ 1</label>
                        <input type="text" class="form-control" name="address1" value="<?php echo htmlspecialchars($user['address1'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ 2</label>
                        <input type="text" class="form-control" name="address2" value="<?php echo htmlspecialchars($user['address2'] ?? ''); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật địa chỉ</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ẩn hiện nội dung khi người dùng chọn Địa Chỉ hoặc Bảng điều khiển
        $('#address-tab').click(function() {
            $('#dashboard-content').hide();
            $('#address-content').show();
            // Lưu trạng thái tab trong session khi chọn Địa chỉ
            <?php $_SESSION['active_tab'] = 'address'; ?>
        });

        $('#dashboard-tab').click(function() {
            $('#address-content').hide();
            $('#dashboard-content').show();
            // Lưu trạng thái tab trong session khi chọn Bảng điều khiển
            <?php $_SESSION['active_tab'] = 'dashboard'; ?>
        });
    </script>
</body>
</html>
