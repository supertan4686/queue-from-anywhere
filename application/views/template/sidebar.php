<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <?php echo $pageactive;?>
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url() . "assets/pic/"?>PEA-logo.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo isset($admin) ? $admin : 'Guest';?></p>
    </div>
  </div>
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">เมนู</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="<?php echo ($pageactive == "stat") ? "active" : "";?>"><a href="<?php echo site_url('/');?>"><i class="fa fa-table"></i> <span>ตารางสถิติข้อมูลพนักงาน</span></a></li>
    <li class="<?php echo ($pageactive == "login") ? "active" : "";?>"><a href="<?php echo site_url('admin/login');?>"><i class="fa fa-user"></i> <span>เข้าสู่ระบบ Admin</span></a></li>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>