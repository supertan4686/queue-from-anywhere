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
                <div class="col-xs-12">
                  <h2 class="box-title">ตารางรายการข้อมูลพนักงาน</h2>
                </div>
              </div>
              <div class="row">
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Form</h4>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              
            </div>
          </>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Delete</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal add Edit -->

  </div>
  <!-- /.content-wrapper -->
