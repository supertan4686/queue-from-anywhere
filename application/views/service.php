  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        รายการข้อมูลกลุ่มงานบริการ
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            <div class="row">
                <div class="col-xs-9">
                  <h2 class="box-title">ตารางรายการข้อมูลกลุ่มงานบริการ</h2>
                </div>
                <div class="col-xs-3">
                  <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#formEmployeeModal"> <i class="fa fa-plus"></i> <span>เพิ่มข้อมูลกลุ่มงานบริการ</span></button>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>ชื่อกลุ่มงานบริการ</th>
                    <th>รหัสหน้ากลุ่มงานบริการ</th>
                    <th>คิวเริ่มต้น</th>
                    <th>คิวสุดท้าย</th>
                    <th>การแก้ไข</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>ย้ายที่อยู่มิเตอร์</td>
                    <td>B</td>
                    <td>600</td>
                    <td>700</td>
                    <td>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formEmployeeModal">แก้ไข</button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">ลบ</button>
                    </td>
                  </tr>
                  <tr>
                    <td>ขอรับบริการอื่นๆ</td>
                    <td>C</td>
                    <td>701</td>
                    <td>999</td>
                    <td>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formEmployeeModal">แก้ไข</button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">ลบ</button>
                    </td>
                  </tr>
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

    <!-- Modal add Edit -->
    <div class="modal fade" id="formEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลกลุ่มงานบริการ</h4>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <!-- form start -->
              <form class="form-horizontal">
                <div class="box-body">
                  <!-- ชื่อกลุ่มงานบริการ -->
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">ชื่อกลุ่มงานบริการ</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบชื่อกลุ่มงานบริการ -->
                  <!-- รหัสหน้ากลุ่มงานบริการ -->
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">รหัสหน้ากลุ่มงานบริการ</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputPassword3" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบรหัสหน้ากลุ่มงานบริการ -->
                  <!-- คิวเริ่มต้น -->
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">คิวเริ่มต้น</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="inputPassword3" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบริวเริ่มต้น -->
                  <!-- คิวสุดท้าย -->
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">คิวสุดท้าย</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="inputPassword3" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบคิวสุดท้าย -->
                </div>
                <!-- /.box-body -->
              </form>
              <!-- /.form end -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary">บันทึก</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal add Edit -->

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title" id="myModalLabel">ลบข้อมูลพนักงาน</h4>
          </div>
          <div class="modal-body">
            <p>คุณต้องการลบข้อมูลพนักงานคนนี้จริงๆหรือไม่ ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-danger">ลบ</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal Delete -->
  </div>
  <!-- /.content-wrapper -->