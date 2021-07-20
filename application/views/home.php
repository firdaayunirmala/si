<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.ico'); ?>" />
    <title> Sistem Informasi Bimbingan Tugas Akhir </title>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url(); ?>assets/frontend/assets/frontend/assets/img/favicon.png" rel="icon">
    <link href="<?php echo base_url(); ?>assets/frontend/assets/frontend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?php echo base_url(); ?>assets/frontend/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Rapid - v2.2.0
  * Template URL: https://bootstrapmade.com/rapid-multipurpose-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-none d-lg-flex align-items-end fixed-top topbar-transparent">
        <div class="container d-flex justify-content-end">
            <div class="social-links">
                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center">

            <a class="navbar-brand page-scroll"> <img id="logo" alt="Logo" src="<?= base_url('assets/img/logostikom.png') ?>" width="75" height="75"> <span> SIBIMTA<br>Sistem Informasi Bimbingan Tugas Akhir</br></span> </a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo mr-auto"><img src="assets/frontend/assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav class="main-nav d-none d-lg-block">
                <ul>
                    <li><a></a></li>
                    <li class="active"><a href="<?= base_url('home'); ?>">Beranda</a></li>
                    <li><a></a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Informasi</a></li>
                    <!-- <li><a href="#team">Kaprodi</a></li> -->
                    <li class="drop-down"><a href="">Login</a>
                        <ul>
                            <li><a href="<?= base_url('auth'); ?>">Admin</a></li>
                            <li><a href="<?= base_url('auth/dosen'); ?>">Dosen Pembimbing</a></li>
                            <li><a href="<?= base_url('auth/mahasiswa'); ?>">Mahasiswa</a></li>
                            <li><a href="<?= base_url('auth/pimpinan'); ?>">Pimpinan</a></li>
                        </ul>
                    </li>

                </ul>
            </nav><!-- .main-nav-->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="clearfix">
        <div class="container d-flex h-100">
            <div class="row justify-content-center align-self-center" data-aos="fade-up">
                <div class="col-md-6 intro-info order-md-first order-last" data-aos="zoom-in" data-aos-delay="100">
                    <br>
                    <h2>SIBIMTA<br><span>Stikom Yos Sudarso Purwokerto</span></h2>
                    <div>
                        <a href="#about" class="btn-get-started scrollto">Mulai</a>
                    </div>
                </div>

                <div class="col-md-6 intro-img order-md-last order-first" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets/frontend/assets/img/intro-img.svg" alt="" class="img-fluid">
                </div>
            </div>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h3>Tentang Visi & Misi </h3>
                </header>
                <div class="row">

                    <div class="col-lg-5 col-md-6">
                        <div class="about-img" data-aos="fade-right" data-aos-delay="100">
                            <img src="assets/img/bgstikom.jpg" alt="">
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-6">
                        <div class="about-content" data-aos="fade-left" data-aos-delay="100">
                            <h2>Visi</h2>
                            <p> Tahun 2025 menjadi Cyber Academic Community yang humanis, professional, serta unggul dalam pengembangan Teknologi Informasi yang berwawasan lingkungan.</p>
                            <h2>Misi</h2>
                            <ul>
                                <li> 1. Membangun Komunitas Akademik yang profesional dan unggul dalam bidang Teknologi Informasi.</li>
                                <li> 2.Menyelenggarakan pendidikan dan pendampingan bagi para mahasiswa untuk menumbuhkan pribadi yang berintegritas, humanis, berjiwa Pancasila, dan berwawasan lingkungan.</li>
                                <li> 3.Menyelenggarakan penelitian dan pengabdian masyarakat untuk mengembangkan Teknologi Informasi yang relevan dengan kebutuhan masyarakat.</li>
                                <li>4.Menyebarkan hasil penelitian dan pengabdian masyarakat melalui publikasi, kaji tindak dan penerapan teknologi informasi pada masyarakat, terutama dalam mengembangan sumber daya manusia secara berkelanjutan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= Features Section ======= -->
            <section id="services" class="featured">
                <div class="container " data-aos="fade-up">
                    <div class="row ">
                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                            <div class="icon-box " data-aos="fade-up" data-aos-delay="100">
                                <div class="icon">
                                    <i class="bx bxl-dribbble">
                                    </i>
                                </div>
                                <h4 class="title">
                                    <a href="">Online Access</a>
                                </h4>
                                <p class="description">Inovasi baru dalam melakukan Bimbingan Skripsi</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                            <div class="icon-box " data-aos="fade-up" data-aos-delay="200">
                                <div class="icon"><i class="bx bx-file"></i></div>
                                <h4 class="title"><a href="">Paper Less</a></h4>
                                <p class="description">Mengurangi penggunaan hardcopy untuk setiap Bimbingan Skripsi</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                            <div class="icon-box " data-aos="fade-up" data-aos-delay="300">
                                <div class="icon"><i class="bx bx-tachometer"></i></div>
                                <h4 class="title"><a href="">Measurable</a></h4>
                                <p class="description">Aktivitas bimbingan skripsi lebih terukur dan sistematis</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon"><i class="bx bx-world"></i></div>
                                <h4 class="title"><a href="">Presentable</a></h4>
                                <p class="description">Tampilan data lebih presentatif</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section><!-- End Features Section -->

            <!-- ======= Services Section ======= -->
            <section id="services" class="services section-bg">
                <div class="container" data-aos="fade-up">

                    <header class="section-header">
                        <h3>Informasi Tugas Akhir</h3>
                        <center>
                            <p>Unduh Pedoman Sistematika Penulisan
                                <a href="PEDOMAN_TUGAS_AKHIR_2020.docx" target="_blank">di sini </a>
                            </p>
                        </center>
                    </header>

                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <img src="flowchart.png">
                            </center>
                        </div>

                    </div>
            </section><!-- End Services Section -->

            <!-- ======= Team Section ======= -->
            <!-- <section id="team" class="team section-bg">
                <div class="container" data-aos="fade-up">
                    <div class="section-header">
                        <h3>Ketua Prodi</h3>
                    </div> -->

                    <!-- <div class="row">

                        <div class="member">
                            <div class="card" style="width: 16rem;">
                                <img src="assets/img/endangSetyawati.png" class="card-img-top" alt="...">
                                <div class="member-info">
                                    <div class="member-info-content mb-3">
                                        <h4>ENDANG SETYAWATI S.Kom., M.Kom.</h4>
                                        <span>Sistem Informasi</span>
                                        <div class="social">
                                            <a href=""><i class="fa fa-twitter"></i></a>
                                            <a href=""><i class="fa fa-facebook"></i></a>
                                            <a href=""><i class="fa fa-google-plus"></i></a>
                                            <a href=""><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="member">
                            <div class="card" style="width: 16rem;">
                                <img src="assets/img/oskar.png" class="card-img-top" alt="...">
                                <div class="member-info">
                                    <div class="member-info-content mb-3">
                                        <h4>Oskar Ika Adi Nugroho S.T., M.T.</h4>
                                        <span>Teknik Informatika</span>
                                        <div class="social">
                                            <a href=""><i class="fa fa-twitter"></i></a>
                                            <a href=""><i class="fa fa-facebook"></i></a>
                                            <a href=""><i class="fa fa-google-plus"></i></a>
                                            <a href=""><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="member">
                            <div class="card" style="width: 16rem;">
                                <img src="assets/img/davidktistian.png" class="card-img-top" alt="...">
                                <div class="member-info">
                                    <div class="member-info-content mb-3">
                                        <h4>David Kristian Paath S.Ds., M.Ds.</h4>
                                        <span>Desain Komunikasi Visual</span>
                                        <div class="social">
                                            <a href=""><i class="fa fa-twitter"></i></a>
                                            <a href=""><i class="fa fa-facebook"></i></a>
                                            <a href=""><i class="fa fa-google-plus"></i></a>
                                            <a href=""><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="member">
                            <div class="card" style="width: 16rem;">
                                <img src="assets/img/adiwibowo.png" class="card-img-top" alt="...">
                                <div class="member-info">
                                    <div class="member-info-content mb-3">
                                        <h4>Adhi Wibowo S.Kom., M.M., M.T.I.</h4>
                                        <span>Komputerisasi Akuntansi</span>
                                        <div class="social">
                                            <a href=""><i class="fa fa-twitter"></i></a>
                                            <a href=""><i class="fa fa-facebook"></i></a>
                                            <a href=""><i class="fa fa-google-plus"></i></a>
                                            <a href=""><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
<!-- 
                </div>
            </section>End Team Section -->

            </footer>
            <footer>
                <div class="container text-center ">
                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; STIKOM Yos Sudarso Purwokerto <?= date('Y'); ?></span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Sistem Informasi Bimbingan Tugas Akhir</p>
                        </div>
                    </div>
                </div>
            </footer>

            <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

            <!-- Vendor JS Files -->
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/jquery/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/php-email-form/validate.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/counterup/counterup.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/venobox/venobox.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/frontend/assets/vendor/aos/aos.js"></script>

            <!-- Template Main JS File -->
            <script src="<?php echo base_url(); ?>assets/frontend/assets/js/main.js"></script>

</body>


</html>