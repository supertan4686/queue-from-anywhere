  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        รายงานการใช้คิวของลูกค้าและการให้บริการของพนักงาน
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
                    <th>เครื่องที่</th>
                    <th>รหัสผู้ให้บริการ</th>
                    <th>ชื่อผู้ให้บริการ</th>
                    <th>คิวที่</th>
                    <th>รหัสลูกค้า</th>
                    <th>เวลารับบัตรคิว</th>
                    <th>ระยะเวลารอคอย</th>
                    <th>เวลาเริ่มการบริการ</th>
                    <th>เวลาเสร็จสิ้นการบริการ</th>
                    <th>คะแนนความพึงพอใจ</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($queue_log as $index => $queue) { ?>
                    <tr>
                      <th><?php echo $queue['counter_id'];?></th>
                      <th><?php echo $queue['employee_id'];?></th>
                      <th><?php echo $queue['employee_name'];?></th>
                      <th><?php echo $queue['queue'];?></th>
                      <th><?php echo $queue['ca'];?></th>
                      <th><?php echo $queue['queue_create_time'];?></th>
                      <th><?php echo $queue['wait_service_time'];?></th>
                      <th><?php echo $queue['end_service_time'] == NULL ? 'พลาดการบริการ' : $queue['start_service_time'];?></th>
                      <th><?php echo $queue['end_service_time'] == NULL ? 'พลาดการบริการ' : $queue['end_service_time'];?></th>
                      <th><?php echo $queue['score'] == 0 ? 'ไม่มีการประเมินคะแนน' : $queue['score'];?></th>
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