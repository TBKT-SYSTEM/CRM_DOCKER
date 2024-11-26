<aside class="left-sidebar with-vertical">
    <div>
        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="<?php echo base_url() ?>Dashboard" class="text-nowrap logo-img">
                <img src="<?php echo base_url() ?>assets/images/logos/crm_icon.png" width="190" style=" margin-left: 16px;margin-top: 10px;" class="dark-logo" alt="Logo-Dark" />
                <!-- <img src="<?php echo base_url() ?>assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" /> -->
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>


        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?php echo base_url() ?>Dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <!-- Apps -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Apps</span>
                </li>
                <?php
                $spg_id = $this->session->userdata('sessPgId');
                // $spg_id = 2;
                $menu_group = $this->ManageBackend->menu_array($spg_id, "side_menu/side_menuGroup/");
                $menu_detail = $this->ManageBackend->menu_array($spg_id, "side_menu/side_menuDetail/");
                foreach ($menu_group as $mg) {
                    echo '<li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="' . $mg['smg_icon'] . '"></i>
                                </span>
                                <span class="hide-menu">' . $mg['smg_name'] . '</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">';
                    foreach ($menu_detail as $md) {
                        if ($md['smg_id'] == $mg['smg_id']) {
                            echo '<li class="sidebar-item">
                                    <a href="' . base_url() . $md['smd_link'] . '" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">' . $md['smd_name'] . '</span>
                                    </a>
                                </li>';
                        }
                    }
                    echo '</ul></li>';
                }
                ?>
                <!-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Admin Control</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() ?>ManageUsers" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Manage Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() ?>PermissionInfo" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Manage Permission Info</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url() ?>MenuInfo" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Manage Menu Info</span>
                            </a>
                        </li>

                    </ul>
                </li> -->

                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?php echo base_url() ?>AccountSetting" aria-expanded="false">
                        <span>
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Account Setting</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="<?php echo base_url() ?>assets/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="" />
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                    <span class="fs-2">Designer</span>
                </div>
                <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </button>
            </div>
        </div>

    </div>
</aside>