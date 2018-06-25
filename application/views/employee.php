  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        รายการข้อมูลพนักงาน
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-xs-10">
                  <h2 class="box-title">ตารางรายการข้อมูลพนักงาน</h2>
                </div>
                <div class="col-xs-2">
                  <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#formEmployeeModal"> <i class="fa fa-plus"></i> <span>เพิ่มพนักงาน</span></button>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อพนักงาน</th>
                    <th>ตำแหน่ง</th>
                    <th>การแก้ไช</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>XXXX01</td>
                    <td>นาย ก จงรักภักดี</td>
                    <td>พนักงานงานประเภท A</td>
                    <td>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formEmployeeModal">แก้ไข</button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">ลบ</button>
                    </td>
                  </tr>
                  <tr>
                    <td>XXXX02</td>
                    <td>นาย ข อกตัญญู</td>
                    <td>พนักงานงานประเภท A</td>
                    <td>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formEmployeeModal">แก้ไข</button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">ลบ</button>
                    </td>
                  </tr>
                  <tr>
                    <td>XXXX03</td>
                    <td>นาย ค เฉยๆ</td>
                    <td>พนักงานงานประเภท B</td>
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
            <h4 class="modal-title" id="myModalLabel">เพิ่มหรือแก้ไขข้อมูลพนักงาน</h4>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <!-- form start -->
              <form class="form-horizontal">
                <div class="box-body">
                  <!-- รหัสพนักงาน -->
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">รหัสพนักงาน</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบรหัสพนักงาน -->
                  <!-- ชื่อพนักงาน -->
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">ชื่อพนักงาน</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputPassword3" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบชื่อพนักงาน -->
                  <!-- ตำแหน่ง -->
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">ตำแหน่ง</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">พนักงานชำระค่าไฟฟ้า</option>
                        <option>ช่างไฟฟ้า</option>
                        <option>สารสนเทศองค์กร</option>
                      </select>
                    </div>
                  </div>
                  <!-- /.จบตำแหน่ง -->
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
            <h4 class="modal-title" id="myModalLabel">ลบข้อมูลกลุ่มงานบริการ</h4>
          </div>
          <div class="modal-body">
            <p>คุณต้องการลบข้อมูลกลุ่มงานบริการนี้จริงๆหรือไม่ ?</p>
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
