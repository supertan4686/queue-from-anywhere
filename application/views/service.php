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
                    <th>การแก้ไข</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($a_service as $index => $service) { ?>
                    <tr>
                      <td><?php echo $service['queue_type_name'];?></td>
                      <td><?php echo $service['queue_type_id'];?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formServiceModal" onclick="get_service('<?php echo $service['queue_type_id'];?>');">แก้ไข</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" onclick="set_service_to_delete('<?php echo $service['queue_type_id'];?>')">ลบ</button>
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
                    <label for="queue_type_name" class="col-sm-3 control-label">ชื่อกลุ่มงานบริการ</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="queue_type_name" name="queue_type_name" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบชื่อกลุ่มงานบริการ -->
                  <!-- รหัสหน้ากลุ่มงานบริการ -->
                  <div class="form-group">
                    <label for="queue_type_id" class="col-sm-3 control-label">รหัสหน้ากลุ่มงานบริการ</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="queue_type_id" name="queue_type_id" placeholder="">
                    </div>
                  </div>
                  <!-- /.จบรหัสหน้ากลุ่มงานบริการ -->
                 
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
            <button type="button" class="btn btn-danger" onclick="delete_service('<?php echo $service['queue_type_id'];?>');">ลบ</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Modal Delete -->

    <!-- Value Hidden -->
      <input type="hidden" id="service_delete" name="service_delete" value="">
    <!-- /.Value Hidden -->

  </div>
  <!-- /.content-wrapper -->

    <script>
    var url = "<?php echo base_url();?>";

    function get_service(queue_type_id){
      //Get Employee data
      $.ajax({
        url: url +'admin/ajax_get_service_by_id?queue_type_id=' + queue_type_id,
        type:'GET',
        success: function (result) {
          data = JSON.parse(result);
          // console.log(data);
          if(data.data != []) {
            var service = data.data;
            $('#queue_type_name').val(service.queue_type_name);
            $('#queue_type_id').val(service.queue_type_id);
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
            window.location.replace(url + 'admin/service?act=insert&service=' + data.queue_type_id);
          } else if(data.type == 'update' && data.result == 'success'){
            window.location.replace(url + 'admin/service?act=update&service=' + data.queue_type_id);
          } else {
            window.location.replace(url + 'admin/service?act=fail&service=' + data.queue_type_id);
          }
        }
      });
    }

    function set_service_to_delete(queue_type_id){
      $('#service_delete').attr('value', queue_type_id);
    }

    function delete_service(){
      var queue_type_id = $('#service_delete').val();
      $.ajax({
        url: url +'admin/ajax_delete_service',
        type:'POST',
        data: {
          queue_type_id: queue_type_id
        },
        success: function (result) {
          data = JSON.parse(result).data;
          // console.log(data);
          if (data.type == 'delete' && data.result == 'success') {
            window.location.replace(url + 'admin/service?act=delete&service=' + data.queue_type_id);
          } else {
            window.location.replace(url + 'admin/service?act=fail&service=' + data.queue_type_id);
          }
        }
      });
    }

    function init_new_form(){
      // console.log('clear_form')
      $('#queue_type_name').val('');
      $('#queue_type_id').val('');
      // $('#service_start_queue').val('');
      // $('#service_end_queue').val('');
    }
  </script>