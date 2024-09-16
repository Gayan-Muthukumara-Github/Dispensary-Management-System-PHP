<?php
include('config/dbcon.php');
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../admin/index.php" class="brand-link text-center">
    <div class="image">
      <img src="assets/dist/img/logo.png" class=" w-50 p-3" alt="User Image">
    </div>
    <span class="brand-text font-weight-light">DISPENSARY MANAGEMENT</span>
  </a>


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Tables
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php
              if ($_SESSION['auth']== "1") {
            ?>
              <li class="nav-item">
                <a href="./patient.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patient Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./pharmacist.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pharmacist Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./labadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lab Admin Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./doctor.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Doctors Table</p>
                </a>
              </li>
            <?php
              }elseif ($_SESSION['auth']== "3") {
            ?>
                <li class="nav-item">
                  <a href="./doctor.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Doctors Table</p>
                  </a>
                </li>
            <?php
              } elseif($_SESSION['auth']== "4"){
            ?>
              <li class="nav-item">
                <a href="./pharmacist.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pharmacist Table</p>
                </a>
              </li>
            <?php   
              } elseif($_SESSION['auth']== "5"){
                ?>
                <li class="nav-item">
                  <a href="./labadmin.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lab Admin Table</p>
                  </a>
                </li>
            <?php   
              }
            ?>
          </ul>
        </li>
        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="./users.php" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
            <p>
              Registered Users
            </p>
          </a>
        </li>
        <?php
          if ($_SESSION['auth']== "3" || $_SESSION['auth']== "1" ) {
        ?>
        <li class="nav-item">
          <a href="./patientdiagnosis.php" class="nav-link">
            <i class="nav-icon fa fa-comment"></i>
            <p>
              Patient Diagnosis 
            </p>
          </a>
        </li>
        <?php
          }
        ?>
        <?php
          if ($_SESSION['auth']== "3" || $_SESSION['auth']== "1" || $_SESSION['auth']== "5") {
        ?>
        <li class="nav-item">
          <a href="./patientmedicalreport.php" class="nav-link">
            <i class="nav-icon fa fa-file"></i>
            <p>
              Patient Medical Report 
            </p>
          </a>
        </li>
        <?php
          }
        ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>