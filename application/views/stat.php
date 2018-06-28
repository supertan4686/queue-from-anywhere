  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        สถิติข้อมูลของพนักงาน
        <small>อัพเดตล่าสุดวันที่ XX เดือน XX พ.ศ. XXXX เวลา XX:XX น.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h2 class="box-title">ตารางสถิติข้อมูลพนักงาน</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th colspan="2">พนักงาน</th>
                    <th rowspan="2">เวลา Login</th>
                    <th rowspan="2">เวลา Logout</th>
                    <th rowspan="2">จำนวนลูกค้าที่บริการ (คน)</th>
                    <th colspan="6">จำนวนลูกค้าที่ประเมิน (คน)</th>
                    <th>ประเมินความพึงพอใจ</th>
                  </tr>
                  <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อพนักงาน</th>
                    <th>5 คะแนน</th>
                    <th>4 คะแนน</th>
                    <th>3 คะแนน</th>
                    <th>2 คะแนน</th>
                    <th>1 คะแนน</th>
                    <th>ไม่ประเมิน</th>
                    <th>คะแนน</th>
                    <th>ร้อยละ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($employee_group as $index => $employee) { ?>
                    <tr>
                      <th><?php echo $employee['employee_id'];?></th>
                      <th><?php echo $employee['employee_name'];?></th>
                      <th><?php echo $employee['login_time'];?></th>
                      <th><?php echo $employee['logout_time'];?></th>
                      <th><?php echo $employee['Amount customer'];?></th>
                      <th><?php echo $employee['score 5'];?></th>
                      <th><?php echo $employee['score 4'];?></th>
                      <th><?php echo $employee['score 3'];?></th>
                      <th><?php echo $employee['score 2'];?></th>
                      <th><?php echo $employee['score 1'];?></th>
                      <th><?php echo $employee['score 0'];?></th>
                      <th><?php echo $employee['Total Score'];?></th>
                      <th>XX.XX</th>
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