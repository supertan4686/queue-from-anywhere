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
                  <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#formServiceModal" onclick="init_new_form();"> <i class="fa fa-plus"></i> <span>เพิ่มข้อมูลกลุ่มงานบริการ</span></button>
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
                    <th>ชื่อกลุ่มงานบริการ</th>
                    <th>รหัสหน้ากลุ่มงานบริการ</th>
                    <th>คิวเริ่มต้น</th>
                    <th>คิวสุดท้าย</th>
                    <th>การแก้ไข</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($a_service as $index => $service) { ?>
                    <tr>
                      <td><?php echo $service['service_name'];?></td>
                      <td><?php echo $service['service_id'];?></td>
                      <td><?php echo $service['service_start_queue'];?></td>
                      <td><?php echo $service['service_end_queue'];?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formServiceModal" onclick="get_service('<?php echo $service['service_id'];?>');">แก้ไข</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" onclick="">ลบ</button>
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
    <div class="modal fade" id="formServiceModal" tabindex="-1" role="dialog" aria-labelledby="formServiceModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title" id="formServiceModalLabel">เพิ่มข้อมูลกลุ่มงานบริการ</h4>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <!-- form start -->
              <form class="form-horizontal" id="submitModal" name="submitModal">
                <div class="box-body">
                  <!-- ชื่อกลุ่มงานบริการ -->
                  <div class="form-group">
                    <label for="service_name" class="col-sm-3 control-label">ชื่อกลุ่มงานบริการ</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="service_name" name="service_name" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบชื่อกลุ่มงานบริการ -->
                  <!-- รหัสหน้ากลุ่มงานบริการ -->
                  <div class="form-group">
                    <label for="service_id" class="col-sm-3 control-label">รหัสหน้ากลุ่มงานบริการ</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="service_id" name="service_id" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบรหัสหน้ากลุ่มงานบริการ -->
                  <!-- คิวเริ่มต้น -->
                  <div class="form-group">
                    <label for="service_start_queue" class="col-sm-3 control-label">คิวเริ่มต้น</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="service_start_queue" name="service_start_queue" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบริวเริ่มต้น -->
                  <!-- คิวสุดท้าย -->
                  <div class="form-group">
                    <label for="service_end_queue" class="col-sm-3 control-label">คิวสุดท้าย</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="service_end_queue" name="service_end_queue" placeholder="">
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
            <button type="button" class="btn btn-primary" onclick="submit_service();">บันทึก</button>
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
            <button type="button" class="btn btn-danger" onclick="delete_service('<?php echo $service['service_id'];?>');">ลบ</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal Delete -->
  </div>
  <!-- /.content-wrapper -->

    <script>
    var url = "<?php echo base_url();?>";

    function get_service(service_id){
      //Get Employee data
      $.ajax({
        url: url +'admin/ajax_get_service_by_id?service_id=' + service_id,
        type:'GET',
        success: function (result) {
          data = JSON.parse(result);
          // console.log(data);
          if(data.data != []) {
            var service = data.data;
            $('#service_name').val(service.service_name);
            $('#service_id').val(service.service_id);
            $('#service_start_queue').val(service.service_start_queue);
            $('#service_end_queue').val(service.service_end_queue);
          } else {
            alert('ไม่พบข้อมูลผู้ใช้');
          }
        }
      });
    }

    function submit_service(){
      var data = $('#submitModal').serialize();
      $.ajax({
        url: url +'admin/ajax_submit_service',
        type:'POST',
        data: data,
        success: function (result) {
          data = JSON.parse(result).data;
          if (data.type == 'insert' && data.result == 'success') {
            window.location.replace(url + 'admin/service?act=insert&service=' + data.service_id);
          } else if(data.type == 'update' && data.result == 'success'){
            window.location.replace(url + 'admin/service?act=update&service=' + data.service_id);
          } else {
            window.location.replace(url + 'admin/service?act=fail&service=' + data.service_id);
          }
        }
      });
    }

    function delete_service(service_id){
      $.ajax({
        url: url +'admin/ajax_delete_service',
        type:'POST',
        data: {
          service_id: service_id
        },
        success: function (result) {
          data = JSON.parse(result).data;
          // console.log(data);
          if (data.type == 'delete' && data.result == 'success') {
            window.location.replace(url + 'admin/service?act=delete&service=' + data.service_id);
          } else {
            window.location.replace(url + 'admin/service?act=fail&service=' + data.service_id);
          }
        }
      });
    }

    function init_new_form(){
      // console.log('clear_form')
      $('#service_name').val('');
      $('#service_id').val('');
      $('#service_start_queue').val('');
      $('#service_end_queue').val('');
    }
  </script>