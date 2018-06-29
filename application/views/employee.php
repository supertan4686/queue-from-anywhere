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
                  <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#formEmployeeModal" onclick="init_new_form();"> <i class="fa fa-plus"></i> <span>เพิ่มพนักงาน</span></button>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-7">
                  <div class="alert alert-success alert-dismissible" style="<?php echo $act == 'insert' || $act == 'update' || $act == 'delete' ? '' : 'display:none'?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p><i class="icon fa fa-check"></i><?php echo $message_act;?></p>
                  </div>
                  <div class="alert alert-danger alert-dismissible" style="<?php echo $act == 'fail' ? '' : 'display:none'?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p><i class="icon fa fa-ban"></i><?php echo $message_act;?></p>
                  </div>
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
                  <?php
                  foreach ($a_employee as $index => $employee) { ?>
                    <tr>
                      <td><?php echo $employee['employee_id'];?></td>
                      <td><?php echo $employee['employee_name_title'] . ' ' . $employee['employee_firstname'] . ' ' . $employee['employee_lastname'] ?></td>  
                      <td><?php echo $employee['position'];?></td>
                      <td>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formEmployeeModal" onclick="get_employee('<?php echo $employee['employee_id'];?>');">แก้ไข</button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" >ลบ</button>
                    </td>
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

    <!-- Modal add Edit -->
    <div class="modal fade" id="formEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="formEmployeeModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title" id="formEmployeeModalLabel">เพิ่มหรือแก้ไขข้อมูลพนักงาน</h4>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <!-- form start -->
              <form class="form-horizontal" id="submitModal" name="submitModal">
                <div class="box-body">
                  <!-- รหัสพนักงาน -->
                  <div class="form-group">
                    <label for="employee_id" class="col-sm-3 control-label">รหัสพนักงาน</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบรหัสพนักงาน -->
                  <!-- คำนำหน้าพนักงาน -->
                  <div class="form-group">
                    <label for="employee_name" class="col-sm-3 control-label">คำนำหน้าชื่อพนักงาน</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="employee_name_title" name="employee_name_title" placeholder="">
                    </div>
                  </div>
                  <!-- /. จบคำนำหน้าพนักงาน -->
                  <!-- ชื่อพนักงาน -->
                  <div class="form-group">
                    <label for="employee_name" class="col-sm-3 control-label">ชื่อพนักงาน</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="employee_firstname" name="employee_firstname" placeholder="">
                    </div>
                  </div>
                  <!-- /. จบชื่อพนักงาน -->
                  <!-- นามสกุลพนักงาน -->
                  <div class="form-group">
                    <label for="employee_name" class="col-sm-3 control-label">นามสกุลพนักงาน</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="employee_lastname" name="employee_lastname" placeholder="">
                    </div>
                  </div>
                  <!-- /. จบนามสกุลพนักงาน -->
                  <!-- ตำแหน่งกรอก -->
                  <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">ตำแหน่ง</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="position" name="position" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบชื่อพนักงาน -->
                </div>
                <!-- /.box-body -->
              </form>
              <!-- /.form end -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" onclick="submit_employee();">บันทึก</button>
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
            <button type="button" class="btn btn-danger" onclick="delete_employee('<?php echo $employee['employee_id'];?>');">ลบ</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal Delete -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    var url = "<?php echo base_url();?>";

    function get_employee(employee_id){
      //Get Employee data
      $.ajax({
        url: url +'admin/ajax_get_employee_by_id?employee_id=' + employee_id,
        type:'GET',
        success: function (result) {
          data = JSON.parse(result);
          // console.log(data);
          if(data.data != []) {
            var employee = data.data;
            $('#employee_id').val(data.data.employee_id);
            $('#employee_name_title').val(data.data.employee_name_title);
            $('#employee_firstname').val(data.data.employee_firstname);
            $('#employee_lastname').val(data.data.employee_lastname);
            $('#position').val(data.data.position);
          } else {
            alert('ไม่พบข้อมูลผู้ใช้');
          }
        }
      });
    }

    function submit_employee(){
      var data = $('#submitModal').serialize();
      $.ajax({
        url: url +'admin/ajax_submit_employee',
        type:'POST',
        data: data,
        success: function (result) {
          data = JSON.parse(result).data;
          if (data.type == 'insert' && data.result == 'success') {
            window.location.replace(url + 'admin/employee?act=insert&employee=' + data.employee_id);
          } else if(data.type == 'update' && data.result == 'success'){
            window.location.replace(url + 'admin/employee?act=update&employee=' + data.employee_id);
          } else {
            window.location.replace(url + 'admin/employee?act=fail&employee=' + data.employee_id);
          }
        }
      });
    }

    function delete_employee(employee_id){
      $.ajax({
        url: url +'admin/ajax_delete_employee',
        type:'POST',
        data: {
          employee_id: employee_id
        },
        success: function (result) {
          data = JSON.parse(result).data;
          // console.log(data);
          if (data.type == 'delete' && data.result == 'success') {
            window.location.replace(url + 'admin/employee?act=delete&employee=' + data.employee_id);
          } else {
            window.location.replace(url + 'admin/employee?act=fail&employee=' + data.employee_id);
          }
        }
      });
    }

    function init_new_form(){
      // console.log('clear_form')
      $('#employee_id').val('');
      $('#employee_name_title').val('');
      $('#employee_firstname').val('');
      $('#employee_lastname').val('');
      $('#position').val('');
    }
  </script>
