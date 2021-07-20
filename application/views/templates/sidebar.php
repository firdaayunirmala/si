  <!-- Sidebar -->
  <?php if ($user['role_id'] == 1 || $user['role_id'] == 2) :  ?>
      <ul class="navbar-nav bg-gradient-primary sidebar  sidebar-sticky  sidebar-dark accordion" id="accordionSidebar">
      <?php elseif ($user['role_id'] == 6) : ?>
          <ul class="navbar-nav  bg-gradient-dark sidebar sidebar-sticky sidebar-dark accordion shadow-sm" id="accordionSidebar">
          <?php elseif ($user['role_id'] == 4) : ?>
              <ul class="navbar-nav  bg-gradient-danger sidebar sidebar-sticky sidebar-dark accordion" id="accordionSidebar">
              <?php elseif ($user['role_id'] == 5) :  ?>
                  <ul class="navbar-nav  bg-gradient-success  sidebar-sticky sidebar sidebar-dark accordion shadow-sm" id="accordionSidebar">
                  <?php endif; ?>

                  <!-- Sidebar - Brand -->
                  <a class="sidebar-brand justify-content-center">
                      <div class="sidebar-brand-icon ">
                          <img class="img-profile" width="100" src="
                              <?php if ($user['role_id'] == 1 || $user['role_id'] == 2) : ?>
    
                              <?= base_url('assets/img/sibimta.png'); ?>
    
                              <?php elseif ($user['role_id'] == 6) : ?>
                              <?= base_url('assets/img/sibimta.png'); ?>
                              
                              <?php elseif ($user['role_id'] == 4) : ?>
                              <?= base_url('assets/img/sibimta.png'); ?>
    
                              <?php elseif ($user['role_id'] == 5) : ?>
                              <?= base_url('assets/img/sibimta.png'); ?> 
                              <?php endif; ?>
                              ">
                      </div>
                  </a>

                  <!-- Divider -->
                  <br>
                  <hr class=" sidebar-divider d-none d-md-block">
                  <br>

                  <!-- QUERY MENU -->
                  <?php
                    $role_id = $this->session->userdata('role_id');
                    $queryMenu = "SELECT user_menu.id, menu
                      FROM user_menu JOIN user_access_menu
                      ON user_menu.id = user_access_menu.menu_id
                      WHERE user_access_menu.role_id = $role_id
                      ORDER BY user_menu.urutan_menu ASC";
                    $menu = $this->db->query($queryMenu)->result_array();
                    ?>

                  <!-- LOOPING MENU -->
                  <?php foreach ($menu as $m) : ?>
                      <div class="sidebar-heading">
                          <?= $m['menu']; ?>
                      </div>

                      <!-- SIAPKAN SUB-MENU SESUAI MENU -->
                      <?php
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT *
                            FROM user_sub_menu JOIN user_menu
                            ON user_sub_menu.menu_id = user_menu.id
                            WHERE user_sub_menu.menu_id = $menuId
                            AND user_sub_menu.is_active = 1 
                            ";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>

                      <?php foreach ($subMenu as $sm) : ?>
                          <?php if ($title == $sm['title']) : ?>
                              <li class="nav-item active">
                              <?php else : ?>
                              <li class="nav-item">
                              <?php endif; ?>
                              <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                                  <i class="<?= $sm['icon']; ?>"></i>
                                  <span><?= $sm['title']; ?></span></a>
                              </li>
                          <?php endforeach; ?>
                          <hr class="sidebar-divider mt-1">
                      <?php endforeach; ?>

                      <!-- END LOOPING MENU -->

                      <li class="nav-item">
                          <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                              <i class=" fas fa-sign-out-alt"></i>
                              <span>Keluar</span></a>
                      </li>

                      <!-- Divider -->
                      <hr class="sidebar-divider d-none d-md-block">

                      <!-- Sidebar Toggler (Sidebar) -->
                      <div class="text-center d-none d-md-inline">
                          <button class="rounded-circle border-0" id="sidebarToggle"></button>
                      </div>

                  </ul>
                  <!-- End of Sidebar -->