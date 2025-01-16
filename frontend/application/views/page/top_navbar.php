   <!--  Header Start -->
   <header class="app-header">
       <nav class="navbar navbar-expand-lg navbar-light">
           <!-- <ul class="navbar-nav">
               <li class="nav-item d-block d-xl-none">
                   <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                       <i class="ti ti-menu-2"></i>
                   </a>
               </li>
               <li class="nav-item">
                   <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                       <i class="ti ti-bell-ringing"></i>
                       <div class="notification bg-primary rounded-circle"></div>
                   </a>
               </li>
           </ul> -->
           <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
               <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-between w-100">
                   <input type="hidden" value="<?php echo $this->session->userdata('sessUsrId'); ?>" id="suID">
                   <input type="hidden" value="<?php echo $this->session->userdata('sessUsr'); ?>" id="sessUsr">
                   <li class="nav-item dropdown">
                       <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="ti ti-bell-ringing"></i>
                           <div class="notification bg-primary rounded-circle"></div>
                       </a>
                       <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1" style="right: -320px !important;">
                           <div class="profile-dropdown position-relative" data-simplebar>
                               <div class="d-flex align-items-center justify-content-between py-3 px-7 border-bottom">
                                   <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                   <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm" id="notificationCount"></span>
                               </div>
                               <div class="message-body px-1" data-simplebar style="max-height: 360px; overflow-y: auto;" id="notificationBody">
                                   <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item bg-info-subtle mb-1">
                                       <span class="me-3">
                                           <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/profile/user-2.jpg" alt="user" class="rounded-circle" width="48" height="48">
                                       </span>
                                       <div class="w-100">
                                           <h6 class="mb-1 fw-semibold lh-base">You have a new RFQ!</h6>
                                           <span class="fs-2 d-block text-body-secondary">Please check the documents.</span>
                                       </div>
                                   </a>
                                   <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item bg-info-subtle mb-1">
                                       <span class="me-3">
                                           <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/profile/user-2.jpg" alt="user" class="rounded-circle" width="48" height="48">
                                       </span>
                                       <div class="w-100">
                                           <h6 class="mb-1 fw-semibold lh-base">You have a new RFQ!</h6>
                                           <span class="fs-2 d-block text-body-secondary">Please check the documents.</span>
                                       </div>
                                   </a>
                                   <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item mb-1">
                                       <span class="me-3">
                                           <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/profile/user-2.jpg" alt="user" class="rounded-circle" width="48" height="48">
                                       </span>
                                       <div class="w-100">
                                           <h6 class="mb-1 fw-semibold lh-base">You have a new RFQ!</h6>
                                           <span class="fs-2 d-block text-body-secondary">Please check the documents.</span>
                                       </div>
                                   </a>
                                   <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item mb-1">
                                       <span class="me-3">
                                           <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/profile/user-2.jpg" alt="user" class="rounded-circle" width="48" height="48">
                                       </span>
                                       <div class="w-100">
                                           <h6 class="mb-1 fw-semibold lh-base">You have a new RFQ!</h6>
                                           <span class="fs-2 d-block text-body-secondary">Please check the documents.</span>
                                       </div>
                                   </a>
                                   <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item mb-1">
                                       <span class="me-3">
                                           <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/profile/user-2.jpg" alt="user" class="rounded-circle" width="48" height="48">
                                       </span>
                                       <div class="w-100">
                                           <h6 class="mb-1 fw-semibold lh-base">You have a new RFQ!</h6>
                                           <span class="fs-2 d-block text-body-secondary">Please check the documents.</span>
                                       </div>
                                   </a>
                                   <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item mb-1">
                                       <span class="me-3">
                                           <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/profile/user-2.jpg" alt="user" class="rounded-circle" width="48" height="48">
                                       </span>
                                       <div class="w-100">
                                           <h6 class="mb-1 fw-semibold lh-base">You have a new RFQ!</h6>
                                           <span class="fs-2 d-block text-body-secondary">Please check the documents.</span>
                                       </div>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </li>

                   <li class="nav-item dropdown">
                       <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                           <div class="d-flex align-items-center">
                               <div class="user-profile-img d-flex mx-auto">
                                   <?php
                                    $sessUsr = $this->session->userdata('sessUsr');
                                    $firstPart = substr($sessUsr, 2, 7);
                                    ?>
                                   <img class="rounded-circle" width="35" height="35" alt="" src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/<?php echo $firstPart ?>.jpg" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png'">
                               </div>
                               <span class="material-symbols-outlined" style="font-size: 30px;">arrow_drop_down</span>
                           </div>
                       </a>
                       <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                           <div class="profile-dropdown position-relative" data-simplebar>
                               <div class="py-3 px-7 pb-0">
                                   <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                               </div>
                               <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                   <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/<?php echo $firstPart ?>.jpg" class="rounded-circle" width="80" height="80" alt="" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png'">
                                   <div class="ms-3">
                                       <h5 class="mb-1 fs-3"><?php echo $this->session->userdata('sessFname') . ' ' . $this->session->userdata('sessLname') ?></h5>
                                       <span class="mb-1 d-block"><?php echo $this->session->userdata('sessDeptName') ?></span>
                                       <p class="mb-0 d-flex align-items-center gap-2">
                                           <i class="ti ti-mail fs-4"></i> <?php echo $this->session->userdata('sessEmail') ?>
                                       </p>
                                   </div>
                               </div>
                               <div class="message-body">
                                   <a href="<?php echo base_url() ?>AccountSetting" class="py-8 px-7 mt-8 d-flex align-items-center">
                                       <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                           <img src="<?php echo base_url() ?>assets/images/svgs/icon-account.svg" alt="" width="24" height="24" />
                                       </span>
                                       <div class="w-75 d-inline-block v-middle ps-3">
                                           <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                                           <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                                       </div>
                                   </a>
                                   <a href="<?php echo base_url() ?>AccountSetting" class="py-8 px-7 d-flex align-items-center">
                                       <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                           <img src="<?php echo base_url() ?>assets/images/svgs/icon-inbox.svg" alt="" width="24" height="24" />
                                       </span>
                                       <div class="w-75 d-inline-block v-middle ps-3">
                                           <h6 class="mb-1 fs-3 fw-semibold lh-base">Change Password</h6>
                                           <span class="fs-2 d-block text-body-secondary">Change your password</span>
                                       </div>
                                   </a>
                                   <!-- <a href="ain/app-notes.html" class="py-8 px-7 d-flex align-items-center">
                                       <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                           <img src="assets/images/svgs/icon-tasks.svg" alt="" width="24" height="24" />
                                       </span>
                                       <div class="w-75 d-inline-block v-middle ps-3">
                                           <h6 class="mb-1 fs-3 fw-semibold lh-base">My Task</h6>
                                           <span class="fs-2 d-block text-body-secondary">To-do and Daily Tasks</span>
                                       </div>
                                   </a> -->
                               </div>
                               <div class="d-grid py-4 px-7 pt-8">
                                   <a href="<?php echo base_url() ?>dashboard/logout" class="btn btn-outline-primary">Log Out</a>
                               </div>
                           </div>
                       </div>
                   </li>
               </ul>
           </div>
       </nav>
   </header>
   <!--  Header End -->