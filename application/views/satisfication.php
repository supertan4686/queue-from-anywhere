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
      <form action="<?php echo isset($admin_id) ? site_url('admin/satisfication') : site_url('main/satisfication');?>" method="get">
        <div class="row">
          <div class="col-xs-1" style="margin-top:8px;">
            <label>ข้อมูลวันที่</label>
          </div>
          <div class="col-xs-7">
            <!-- Date range -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="daterange" id="daterange" value="<?php echo $dateselected != "" ?  $dateselected : ""?>">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>
          <div class="col-xs-2">
            <button class="btn btn-primary btn-block"><i class="fa fa-search"></i> &nbsp; &nbsp;ค้นหา</button>
          </div>
          <div class="col-xs-2">
            <button class="btn btn-success btn-block" type="button" onclick="export_satisfication()"><i class="fa fa-table"></i> &nbsp; &nbsp;Export Excel</button>
          </div>
        </div>
      </form>
      
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
                      <th><?php echo $employee['amount_customer'] != "" ? $employee['amount_customer'] : "0";?></th>
                      <th><?php echo $employee['score_5'] != "" ? $employee['score_5'] : "0";?></th>
                      <th><?php echo $employee['score_4'] != "" ? $employee['score_4'] : "0";?></th>
                      <th><?php echo $employee['score_3'] != "" ? $employee['score_3'] : "0";?></th>
                      <th><?php echo $employee['score_2'] != "" ? $employee['score_2'] : "0";?></th>
                      <th><?php echo $employee['score_1'] != "" ? $employee['score_1'] : "0";?></th>
                      <th><?php echo $employee['score_0'] != "" ? $employee['score_0'] : "0";?></th>
                      <th><?php echo $employee['total_score'] != "" ? $employee['total_score'] : "0";?></th>
                      <th><?php echo $employee['score_averange'] != "" ? $employee['score_averange'] : "0";?></th>
                      <th><?php echo $employee['satisfaction_percent'] != "" ? $employee['satisfaction_percent'] : "0";?></th>
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