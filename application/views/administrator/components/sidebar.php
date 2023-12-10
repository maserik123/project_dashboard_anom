<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 13px;">(ADMoni)</span>
        <small style="font-size: 11px;">Apps Dashboard Monitoring </small>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info text-white">
                <small>Hello, Administrator</small> <br>
                <small>[System Manager]</small>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="<?php echo base_url('administrator'); ?>" class="nav-link <?php if (isset($a_dashboard)) {
                                                                                            echo $a_dashboard;
                                                                                        } ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Project Transaction
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrator/projectHeader') ?>" class="nav-link <?php if (isset($a_projectHeader)) {
                                                                                                                echo $a_projectHeader;
                                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Header</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrator/projectDetails') ?>" class="nav-link <?php if (isset($a_projectDetails)) {
                                                                                                                    echo $a_projectDetails;
                                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Details</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Project Components
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="<?php echo base_url('administrator/projectMaster'); ?>" class="nav-link <?php if (isset($a_projectMaster)) {
                                                                                                                    echo $a_projectMaster;
                                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrator/projectCriteria') ?>" class="nav-link <?php if (isset($a_projectCriteria)) {
                                                                                                                    echo $a_projectCriteria;
                                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Criteria Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrator/projectPICHeader'); ?>" class="nav-link <?php if (isset($a_projectPICHeader)) {
                                                                                                                    echo $a_projectPICHeader;
                                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PIC Projects Header</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrator/projectPICDetails'); ?>" class="nav-link <?php if (isset($a_projectPICDetails)) {
                                                                                                                        echo $a_projectPICDetails;
                                                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PIC Projects Detail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('administrator/projectStatus'); ?>" class="nav-link <?php if (isset($a_projectStatus)) {
                                                                                                                    echo $a_projectStatus;
                                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Projects Status</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/riskMitigation'); ?>" class="nav-link <?php if (isset($a_riskMitigation)) {
                                                                                                            echo $a_riskMitigation;
                                                                                                        } ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Risk Mitigation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/projectInformation') ?>" class="nav-link <?php if (isset($a_projectInformation)) {
                                                                                                                echo $a_projectInformation;
                                                                                                            } ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Project Information
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/issueProblem') ?>" class="nav-link <?php if (isset($a_issueProblem)) {
                                                                                                        echo $a_issueProblem;
                                                                                                    } ?>">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Issue Problem
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" onclick="logout()" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>