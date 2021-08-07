<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>
      <div class="pull-left">
        <?php
        $tanggal = date('D d F Y');
        $hari = date('D', strtotime($tanggal));
        $bulan = date('F', strtotime($tanggal));
        $hariIndo = array(
          'Mon' => 'Senin',
          'Tue' => 'Selasa',
          'Wed' => 'Rabu',
          'Thu' => 'Kamis',
          'Fri' => 'Jumat',
          'Sat' => 'Sabtu',
          'Sun' => 'Minggu',
        );
        $bulanIndo = array(
          'January' => 'Januari',
          'February' => 'Februari',
          'March' => 'Maret',
          'April' => 'April',
          'May' => 'Mei',
          'June' => 'Juni',
          'July' => 'Juli',
          'August' => 'Agustus',
          'September' => 'September',
          'October' => 'Oktober',
          'November' => 'November',
          'December' => 'Desember'
        );
        echo $hariIndo[$hari] . ', ' . date('d ') . $bulanIndo[$bulan] . date(' Y');

        ?>
        <br>
        <?php
        date_default_timezone_set('Asia/Jakarta');
        echo " Waktu : ";
        echo date('H:i:s');
        echo " WIB";
        ?>
      </div>

      <?php
      if ($this->session->userdata('user_data')['role_id'] == 1 || $this->session->userdata('user_data')['role_id'] == 2) {
        $img_url = base_url('assets/img/profile/') . $this->session->userdata('user_data')['image'];
      } elseif ($this->session->userdata('user_data')['role_id'] == 6 || $this->session->userdata('user_data')['role_id'] == 9) {
        $img_url = base_url('assets/img/profile/pimpinan/') . $this->session->userdata('user_data')['image'];
      } elseif ($this->session->userdata('user_data')['role_id'] == 4 || $this->session->userdata('user_data')['role_id'] == 8) {
        $img_url = base_url('assets/img/profile/dosen/') . $this->session->userdata('user_data')['image'];
      } elseif ($this->session->userdata('user_data')['role_id'] == 5) {
        $img_url = base_url('assets/img/profile/mahasiswa/') . $this->session->userdata('user_data')['image'];
      } else {
        $img_url = base_url() . "assets/img/profile/mahasiswa/default.jpg";
      }
      ?>


      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('user_data')['user_name']; ?></span>
            <img class="img-profile rounded-circle" src="<?= $img_url ?>">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Keluar
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->