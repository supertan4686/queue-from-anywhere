    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url() . "assets/AdminLTE-2.4.3/"?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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
         //Date range picker
        $('#daterange').daterangepicker({
          locale: {
            format: 'YYYY-MM-DD'
          }
        })
      })
      var base_url = "<?php echo base_url()?>";
      function export_satisfication(){
        var daterange = $("#daterange").val();
        console.log(daterange);
        var url = base_url + "admin/ajax_export_satisfication";
        $.ajax({
          method: "POST",
          url: url,
          data: { 
            daterange: daterange
          }
        })
          .done(function( link ) {
            window.open(link , '_blank');
        });
      }

       function export_analyze(){
        var daterange = $("#daterange").val();
        console.log(daterange);
        var url = base_url + "admin/ajax_export_analyze";
        $.ajax({
          method: "POST",
          url: url,
          data: { 
            daterange: daterange
          }
        })
          .done(function( link ) {
            window.open(link , '_blank');
        });

      }

       function export_queue_log(){
        var daterange = $("#daterange").val();
        console.log(daterange);
        var url = base_url + "admin/ajax_export_queue_log";
        $.ajax({
          method: "POST",
          url: url,
          data: { 
            daterange: daterange
          }
        })
          .done(function( link ) {
            window.open(link , '_blank');
        });

      }
    </script>
  </body>
</html>