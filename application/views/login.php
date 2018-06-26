  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        เข้าสู่ระบบ Admin
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="login-box">
        <div class="login-box-body">
          <p class="login-box-msg">เข้าสู่ระบบ Admin</p>
          <form id="formlogin" method="post" action="#">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <br>
            <div class="row">
              <div class="col-xs-8">
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block" id="loginbtn">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    $("#formlogin").submit(function (e) {
      e.preventDefault();
      var data = $('#formlogin').serialize();
      var url = "<?php echo base_url();?>";
      $.ajax({
        url: url +'admin/ajax_login',
        type:'POST',
        data: data,
        success: function (msg) {
          console.log(msg);
          if(msg == "Success"){
            window.location = url + 'admin';
          }
        }
      }); 
    });
  </script>  