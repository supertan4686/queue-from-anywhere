  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        รายงานวิเคราะห์การให้บริการของพนักงาน
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- <div class="box-header">
              <h2 class="box-title">ตารางสถิติข้อมูลพนักงาน</h2>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th colspan=2>พนักงาน</th>
                    <th colspan=3>เวลาการทำงาน</th>
                    <th colspan=3>จำนวนลูกค้า (คน)</th>
                    <th colspan=3>เวลาการให้บริการ</th>
                  </tr>
                  <tr>
                    <th>รหัสผู้ให้บริการ</th>
                    <th>ชื่อผู้ให้บริการ</th>
                    <th>เวลา Login</th>
                    <th>เวลา Logout</th>
                    <th>ระยะเวลาการทำงานทั้งหมด</th>
                    <th>จำนวนลูกค้าที่เรียกบริการ</th>
                    <th>จำนวนลูกค้าที่บริการ</th>
                    <th>จำนวนลูกค้าที่พลาดการบริการ</th>
                    <th>ระยะเวลาการให้บริการทั้งหมด</th>
                    <th>ระยะเวลาการให้บริการเฉลี่ย</th>
                    <th>ระยะเวลาการให้บริการมากที่สุด</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($a_analyze as $index => $employee) { ?>
                    <tr>
                      <th><?php echo $employee['employee_id']?></th>
                      <th><?php echo $employee['employee_name']?></th>
                      <th><?php echo $employee['login_time']?></th>
                      <th><?php echo $employee['logout_time']?></th>
                      <th><?php echo $employee['work_all_time_by_login']?></th>
                      <th><?php echo $employee['amount_customer']?></th>
                      <th><?php echo $employee['success_service']?></th>
                      <th><?php echo $employee['fail_service']?></th>
                      <th><?php echo $employee['work_all_time_by_employee']?></th>
                      <th><?php echo $employee['averange_work_time']?></th>
                      <th><?php echo $employee['max_work_time']?></th>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->