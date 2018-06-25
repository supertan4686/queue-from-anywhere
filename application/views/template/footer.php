    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/fastclick/lib/fastclick.js"></script>
    
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. -->

    <script>
      $(function () {
        $('#example1').DataTable({
          "scrollX": true
        })
      })
    </script>
  </body>
</html>