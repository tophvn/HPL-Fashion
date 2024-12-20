<?php
include('../config/database.php');
$successMessage = "";
$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    if (Database::query($sql) === TRUE) {
        $successMessage = "Tin nhắn của bạn đã được gửi thành công!";
    } else {
        $errorMessage = "Đã xảy ra lỗi: Không thể thực hiện.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Liên Hệ - HPL FASHION</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/logo/HPL-logo.png" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        
    </style>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Liên Hệ Chúng Tôi</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Trang Chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Liên Hệ</p>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">LIÊN HỆ</span></h2>
        </div>
        <div class="row justify-content-center px-xl-5">
            <div class="col-lg-10 mb-5"> 
                <div class="row">
                    <div class="col-lg-7 mb-5">
                        <div class="contact-form">
                            <div id="success"></div>
                            <form name="sentMessage" id="contactForm" method="post" action="">
                                <div class="control-group">
                                    <input type="text" class="form-control" name="name" placeholder="Họ và Tên"
                                        required="required" data-validation-required-message="Vui lòng nhập tên của bạn" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email của bạn"
                                        required="required" data-validation-required-message="Vui lòng nhập email của bạn" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <input type="text" class="form-control" name="subject" placeholder="Chủ đề"
                                        required="required" data-validation-required-message="Vui lòng nhập chủ đề" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <textarea class="form-control" rows="6" name="message" placeholder="Tin nhắn"
                                        required="required" data-validation-required-message="Vui lòng nhập tin nhắn của bạn"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div>
                                    <button class="btn btn-primary py-2 px-4 rounded shadow" type="submit" id="sendMessageButton">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Gửi Tin Nhắn
                                    </button>
                                </div>
                            </form>
                            <div class="container mt-3">
                                <?php if (!empty($successMessage)) : ?>
                                    <div class="alert alert-success"><?php echo $successMessage; ?></div>
                                <?php endif; ?>
                                <?php if (!empty($errorMessage)) : ?>
                                    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-5">
                        <h5 class="font-weight-semi-bold mb-3">Liên Hệ Với Chúng Tôi</h5>
                        <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn với bất kỳ câu hỏi nào. Hãy liên hệ với chúng tôi để biết thêm thông tin.</p>
                        <div class="d-flex flex-column mb-3">
                            <h5 class="font-weight-semi-bold mb-3">Cửa Hàng 1</h5>
                            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>140 Lê Trọng Tấn, Tân Phú, HCM</p>
                            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>hplfashionvn@gmail.com</p>
                            <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+84 123 456789</p>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="font-weight-semi-bold mb-3">Cửa Hàng 2</h5>
                            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>61 Tân Hương, Tân Phú, HCM</p>
                            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>hplfashionvn@gmail.com</p>
                            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+84 123 456789</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>