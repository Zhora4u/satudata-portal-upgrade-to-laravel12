<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= base_url(); ?>assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin SDP</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url(); ?>assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('username'); ?></a>
        <a href="#" class="d-block"><?= $this->session->userdata('nama_user'); ?></a>
        <a href="#" class="d-block"> <?php if ($this->session->userdata('role') == 4) {
                                        echo "Pembina Data";
                                      } elseif ($this->session->userdata('role') == 1) {
                                        echo "Superadmin";
                                      } elseif ($this->session->userdata('role') == 2) {
                                        echo "Walidata";
                                      } elseif ($this->session->userdata('role') == 3) {
                                        echo "Admin Pusdatin";
                                      } elseif ($this->session->userdata('role') == 5) {
                                        echo "Produsen Data";
                                      }; ?></a>

      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <!-- QUERY MENU -->
        <?php
        $role = $this->session->userdata('role');
        $queryMenu = "SELECT `user_menu`.`id`, `menu`
                            FROM `user_menu` JOIN `user_access_menu`
                              ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                           WHERE `user_access_menu`.`role_id` = $role
                        ORDER BY `user_access_menu`.`menu_id` ASC
                        ";
        $menu = $this->db->query($queryMenu)->result_array();
        // var_dump($menu);
        ?>

        <li class="nav-item has-treeview menu-close">

          <?php foreach ($menu as $m) : ?>
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                <?= $m['menu']; ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <!-- SIAPKAN SUB-MENU SESUAI MENU -->
            <?php
            $menuId = $m['id'];
            $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";

            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

            <?php foreach ($subMenu as $sm) : ?>
              <?php if ($judul == $sm['title']) : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
          <i class="<?= $sm['icon']; ?>"></i>
          <span><?= $sm['title']; ?></span></a>
        </li>
      <?php endforeach; ?>
      <hr class="sidebar-divider mt-3">

    <?php endforeach; ?>

    <li class="nav-item">
      <a href="<?= base_url(); ?>login/logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
          Logout
          <span class="badge badge-info right"></span>
        </p>
      </a>
    </li>
      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>