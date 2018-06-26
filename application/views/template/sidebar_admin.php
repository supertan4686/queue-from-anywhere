<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

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
    <li class="<?php echo ($pageactive == "stat") ? "active" : "";?>"><a href="<?php echo site_url('admin');?>"><i class="fa fa-table"></i> <span>ตารางสถิติข้อมูลพนักงาน</span></a></li>
    <li class="<?php echo ($pageactive == "employee") ? "active" : "";?>"><a href="<?php echo site_url('admin/employee');?>"><i class="fa fa-users"></i> <span>ข้อมูลพนักงาน</span></a></li>
    <li class="<?php echo ($pageactive == "service") ? "active" : "";?>"><a href="<?php echo site_url('admin/service');?>"><i class="fa fa-bolt"></i> <span>ข้อมูลงานบริการ</span></a></li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>