<body class="admin-green-theme">

    <style>
    .fa-bars {
        color: #2d5f3f;
    }



    /* Style cho Sidebar màu xanh lá đậm */
    .sidebar {
        background: #1a2e23 !important;
    }

    .sidebar .navbar .navbar-nav .nav-link i {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border-radius: 40px;
    }

    .sidebar .navbar {
        background: #1a2e23 !important;
    }

    .sidebar .navbar-brand h3 {
        color: #5fad7d !important;
    }

    /* Style cho nav link */
    .sidebar .navbar .navbar-nav .nav-link,
    .sidebar .navbar .navbar-nav .dropdown-toggle {
        color: #e8f5e9 !important;
    }



    /* Style cho nav link active */
    .sidebar .navbar .navbar-nav .nav-link.active {
        color: #ffffffff !important;
        background: #2d5f3f !important;
        border-left: 3px solid #5fad7d;
    }

    .sidebar .navbar .navbar-nav .nav-link:hover i,
    .sidebar .navbar .navbar-nav .nav-link.active i {
        background: #2d5f3f !important;
    }

    /* Style hover */
    .sidebar .navbar .navbar-nav .nav-link:hover,
    .sidebar .navbar .navbar-nav .dropdown-toggle:hover {
        color: #a8e6b8 !important;
        background: #234432 !important;
    }

    /* Dropdown menu */
    .sidebar .dropdown-menu {
        background: #234432 !important;
    }

    .sidebar .dropdown-item {
        color: #c8e6c9 !important;
    }

    .sidebar .dropdown-item:hover,
    .sidebar .dropdown-item.active {
        color: #ffffff !important;
        background: #2d5f3f !important;
    }
    </style>


    <div class="container-xxl position-relative bg-white d-flex p-0">

        <style>
        .sidebar .navbar-brand h3 {
            color: #ffffff !important;
        }
        </style>

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3><i class="fa fa-glass-martini me-2"></i>Phúc Long
                    </h3>
                </a>





                <?php
                // Lấy tham số quanli từ URL
                $quanli = isset($_GET['quanli']) ? $_GET['quanli'] : '';

                // Hàm kiểm tra active cho menu
                function isActive($menuItems, $currentPage) {
                    if (empty($currentPage)) {
                        return in_array('', $menuItems);
                    }
                    return in_array($currentPage, $menuItems);
                }

                // Hàm kiểm tra active cho dropdown
                function isDropdownActive($menuItems, $currentPage) {
                    if (empty($currentPage)) return false;
                    return in_array($currentPage, $menuItems);
                }
                ?>

                <div class="navbar-nav w-100">
                    <!-- Dashboard -->
                    <a href="index.php"
                        class="nav-item nav-link <?php echo ($quanli == '' || $quanli == 'ho-so') ? 'active' : ''; ?>">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>

                    <!-- Đơn hàng -->
                    <?php 
                    $orderPages = ['danh-sach-don-hang', 'danh-sach-don-cho', 'cap-nhat-don-hang'];
                    $isOrderActive = isDropdownActive($orderPages, $quanli);
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php echo $isOrderActive ? 'active' : ''; ?>"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-shopping-basket me-2"></i>Đơn hàng
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=danh-sach-don-hang"
                                class="dropdown-item <?php echo $quanli == 'danh-sach-don-hang' ? 'active' : ''; ?>">
                                Tất cả đơn
                            </a>
                            <a href="index.php?quanli=danh-sach-don-cho"
                                class="dropdown-item <?php echo $quanli == 'danh-sach-don-cho' ? 'active' : ''; ?>">
                                Đơn chờ xác nhận
                            </a>
                        </div>
                    </div>

                    <!-- Danh mục -->
                    <?php 
                    $categoryPages = ['them-danh-muc', 'danh-sach-danh-muc', 'cap-nhat-danh-muc'];
                    $isCategoryActive = isDropdownActive($categoryPages, $quanli);
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php echo $isCategoryActive ? 'active' : ''; ?>"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-th me-2"></i>Danh mục
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=them-danh-muc"
                                class="dropdown-item <?php echo $quanli == 'them-danh-muc' ? 'active' : ''; ?>">
                                Thêm mới
                            </a>
                            <a href="index.php?quanli=danh-sach-danh-muc"
                                class="dropdown-item <?php echo $quanli == 'danh-sach-danh-muc' ? 'active' : ''; ?>">
                                Tất cả
                            </a>
                        </div>
                    </div>

                    <!-- Sản phẩm -->
                    <?php 
                    $productPages = ['them-san-pham', 'danh-sach-san-pham', 'cap-nhat-san-pham', 'thung-rac-san-pham'];
                    $isProductActive = isDropdownActive($productPages, $quanli);
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php echo $isProductActive ? 'active' : ''; ?>"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-box me-2"></i>Sản phẩm
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=them-san-pham"
                                class="dropdown-item <?php echo $quanli == 'them-san-pham' ? 'active' : ''; ?>">
                                Thêm mới
                            </a>
                            <a href="index.php?quanli=danh-sach-san-pham"
                                class="dropdown-item <?php echo $quanli == 'danh-sach-san-pham' ? 'active' : ''; ?>">
                                Tất cả
                            </a>
                        </div>
                    </div>

                    <!-- Bài viết -->
                    <?php 
                    $postPages = ['danh-sach-bai-viet', 'them-bai-viet', 'danh-muc-bai-viet', 'cap-nhat-bai-viet', 'cap-nhat-danh-muc-bai-viet'];
                    $isPostActive = isDropdownActive($postPages, $quanli);
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php echo $isPostActive ? 'active' : ''; ?>"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-book me-2"></i> Bài viết
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=danh-sach-bai-viet"
                                class="dropdown-item <?php echo $quanli == 'danh-sach-bai-viet' ? 'active' : ''; ?>">
                                Tất cả
                            </a>
                            <a href="index.php?quanli=them-bai-viet"
                                class="dropdown-item <?php echo $quanli == 'them-bai-viet' ? 'active' : ''; ?>">
                                Thêm bài viết
                            </a>
                            <a href="index.php?quanli=danh-muc-bai-viet"
                                class="dropdown-item <?php echo $quanli == 'danh-muc-bai-viet' ? 'active' : ''; ?>">
                                Chuyên mục
                            </a>
                        </div>
                    </div>

                    <!-- Thống kê -->
                    <?php 
                    $statsPages = ['thong-ke-san-pham', 'thong-ke-don-hang', 'bieu-do-luot-ban', 'top-luot-ban', 'luot-ban-theo-ngay'];
                    $isStatsActive = isDropdownActive($statsPages, $quanli);
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php echo $isStatsActive ? 'active' : ''; ?>"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-2"></i> Thống kê
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=thong-ke-san-pham"
                                class="dropdown-item <?php echo $quanli == 'thong-ke-san-pham' ? 'active' : ''; ?>">
                                Sản phẩm - danh mục
                            </a>
                            <a href="index.php?quanli=thong-ke-don-hang"
                                class="dropdown-item <?php echo $quanli == 'thong-ke-don-hang' ? 'active' : ''; ?>">
                                Đơn hàng
                            </a>
                        </div>
                    </div>

                    <!-- Quản lý kho -->
                    <?php 
                    $warehousePages = ['kho-hang', 'kho-hang2', 'them-hoa-don', 'sua-kho-hang'];
                    $isWarehouseActive = in_array($quanli, $warehousePages);
                    ?>
                    <a href="index.php?quanli=kho-hang"
                        class="nav-item nav-link <?php echo $isWarehouseActive ? 'active' : ''; ?>">
                        <i class="fas fa-warehouse me-2"></i>Quản lý kho
                    </a>

                    <!-- Thành viên -->
                    <?php 
                    $customerPages = ['danh-sach-khach-hang', 'them-tai-khoan', 'capnhat-tai-khoan'];
                    $isCustomerActive = in_array($quanli, $customerPages);
                    ?>
                    <a href="index.php?quanli=danh-sach-khach-hang"
                        class="nav-item nav-link <?php echo $isCustomerActive ? 'active' : ''; ?>">
                        <i class="fas fa-users me-2"></i>Thành viên
                    </a>

                    <!-- Bình luận -->
                    <?php 
                    $commentPages = ['binh-luan', 'chi-tiet-binh-luan'];
                    $isCommentActive = in_array($quanli, $commentPages);
                    ?>
                    <a href="index.php?quanli=binh-luan"
                        class="nav-item nav-link <?php echo $isCommentActive ? 'active' : ''; ?>">
                        <i class="fas fa-comment me-2"></i>Bình luận
                    </a>
                </div>

                <!-- <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-shopping-basket me-2"></i>Đơn hàng</a>
                        <div class="dropdown-menu bg-transparent border-0">

                            <a href="index.php?quanli=danh-sach-don-hang" class="dropdown-item">Tất cả đơn</a>
                            <a href="danh-sach-don-cho" class="dropdown-item">Đơn chờ xác nhận</a>

                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                                class="fa fa-th me-2"></i>Danh mục</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=them-danh-muc" class="dropdown-item">Thêm mới</a>
                            <a href="index.php?quanli=danh-sach-danh-muc" class="dropdown-item">Tất cả</a>

                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fas fa-box me-2"></i>Sản phẩm</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=them-san-pham" class="dropdown-item">Thêm mới</a>
                            <a href="index.php?quanli=danh-sach-san-pham" class="dropdown-item">Tất cả</a>

                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fas fa-book me-2"></i> Bài viết</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="index.php?quanli=danh-sach-bai-viet" class="dropdown-item">Tất cả</a>
                            <a href="index.php?quanli=them-bai-viet" class="dropdown-item">Thêm bài viết</a>
                            <a href="index.php?quanli=danh-muc-bai-viet" class="dropdown-item">Chuyên mục</a>

                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fas fa-chart-bar me-2"></i> Thống kê</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="thong-ke-san-pham" class="dropdown-item">Sản phẩm - danh mục</a>
                            <a href="thong-ke-don-hang" class="dropdown-item">Đơn hàng</a>

                        </div>
                    </div>

                    <a href="index.php?quanli=kho-hang" class="nav-item nav-link"><i
                            class="fas fa-warehouse me-2"></i>Quản
                        lý kho</a>

                    <a href="index.php?quanli=danh-sach-khach-hang" class="nav-item nav-link"><i
                            class="fas fa-users me-2"></i>Thành viên</a>
                    <a href="index.php?quanli=binh-luan" class="nav-item nav-link"><i
                            class="fas fa-comment me-2"></i>Bình luận</a>





                </div> -->
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Tìm kiếm">
                </form>
                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="public_admin/img/user-default.png" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">ADMIN</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-white border-1 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Hồ sơ</a>
                            <a href="index.php?quanli=dang-xuat" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Content start -->