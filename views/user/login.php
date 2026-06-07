<?php
    $username_tmp = '';
    $password_tmp = '';
    $error ='';

    if(isset($_SESSION['user_register'])) {
        $username_tmp = $_SESSION['user_register']['username'];
        $password_tmp = $_SESSION['user_register']['password'];
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {
        $username = trim($_POST["username_login"]);
        $password = trim($_POST["password_login"]);
        
        if (!empty($username) && !empty($password)) {
            $user = $CustomerModel->get_user_by_username($username);
            
    
            if ($user && isset($user[0]['password'])) { 

                if($user[0]['active'] != 1) {
                    $error = 'Tài khoản đã bị khóa';
                }else {
                    if (password_verify($password, $user[0]['password'])) {
                        session_regenerate_id(true);
                        // Lưu thông tin đăng nhập vào Sessison
                        $_SESSION['user']['id'] = $user[0]['user_id'];
                        $_SESSION['user']['username'] = $user[0]['username'];
                        $_SESSION['user']['full_name'] = $user[0]['full_name'];
                        $_SESSION['user']['image'] = $user[0]['image'];
                        $_SESSION['user']['email'] = $user[0]['email'];
                        $_SESSION['user']['phone'] = $user[0]['phone'];
                        $_SESSION['user']['address'] = $user[0]['address'];
                        $_SESSION['user']['password'] = $user[0]['password'];
                        
                        // Xóa session lưu trữ tạm
                        if(isset($_SESSION['user_register'])) unset($_SESSION['user_register']);

                        header("Location: index.php");
                        exit;
                    } else {
                        $error = 'Sai tên tài khoản hoặc mật khẩu';
                    }
                }
    
                
            } else {
                $error = 'Sai tên tài khoản hoặc mật khẩu';
                $username_tmp = $username;
                $password_tmp = $password;
            }
        } else {
            $error = 'Vui lòng nhập đầy đủ thông tin';
        }   

    }

    $html_alert = $BaseModel->alert_error_success($error, '');

?>
<style>

label {
    margin-top: 5px;
}
</style>
<section class="coffee-auth-section">
    <div class="container py-4">
        <div class="coffee-auth-shell">
            <div class="coffee-auth-panel">
                <span class="coffee-auth-kicker">Welcome back</span>
                <h1>Đăng nhập tài khoản</h1>
                <p>Theo dõi đơn hàng, lưu thông tin giao hàng và đặt món nhanh hơn trong lần mua tiếp theo.</p>
                <div class="coffee-auth-benefits">
                    <span><i class="fa fa-check"></i> Đặt món nhanh</span>
                    <span><i class="fa fa-check"></i> Theo dõi đơn hàng</span>
                    <span><i class="fa fa-check"></i> Lưu ưu đãi thành viên</span>
                </div>
            </div>
            <div class="coffee-auth-form-wrap">
                <div class="login_oueter w-100">
                    <form action="" method="post" id="login" autocomplete="off">
                        <h4 class="mb-4 text-center">ĐĂNG NHẬP</h4>
                        <?=$html_alert?>
                        <div class="form-group">
                            <label class="font-weight-bold" for="username">Tên đăng nhập</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="username_login" type="text" value="<?=$username_tmp?>" class="form-control" id="username" placeholder="Tên đăng nhập" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="password">Mật khẩu</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="password_login" type="password" value="<?=$password_tmp?>" class="form-control" id="password" placeholder="Mật khẩu" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="cursor:pointer;" onclick="password_show_hide();">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block py-2" type="submit" name="signin">Đăng nhập</button>
                        <p class="text-center mt-3 mb-0"><a href="index.php?url=quen-mat-khau">Quên mật khẩu?</a></p>
                        <div class="line my-4"></div>
                        <div class="text-center">
                            <a href="index.php?url=dang-ky" class="btn btn-success px-4">Tạo tài khoản</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>
