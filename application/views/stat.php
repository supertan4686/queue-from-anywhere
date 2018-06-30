  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        รายงานสรุปผลคะแนนของพนักงานและความพึงใจของลูกค้า
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
                    <th rowspan="2">จำนวนลูกค้าที่บริการ (คน)</th>
                    <th colspan="6">จำนวนลูกค้าที่ประเมิน (คน)</th>
                    <th colspan="3">ประเมินความพึงพอใจ</th>
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
                    <th>คะแนนทั้งหมด</th>
                    <th>คะแนนเฉลี่ย</th>
                    <th>ร้อยละของความพึงพอใจ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($employee_group as $index => $employee) { ?>
                    <tr>
                      <th><?php echo $employee['employee_id'];?></th>
                      <th><?php echo $employee['employee_name'];?></th>
                      <th><?php echo $employee['amount_customer'];?></th>
                      <th><?php echo $employee['score_5'];?></th>
                      <th><?php echo $employee['score_4'];?></th>
                      <th><?php echo $employee['score_3'];?></th>
                      <th><?php echo $employee['score_2'];?></th>
                      <th><?php echo $employee['score_1'];?></th>
                      <th><?php echo $employee['score_0'];?></th>
                      <th><?php echo $employee['total_score'];?></th>
                      <th><?php echo $employee['score_averange'];?></th>
                      <th><?php echo $employee['satisfaction_percent'];?></th>
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