<footer class="main-footer">

    <div class="text-center"> <strong>Copyright &copy; 2019 <a href="#">DLH KAB.GORONTALO</a>.</strong> All rights reserved.</div>

</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('asset'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('asset'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>




<script src="<?= base_url('asset'); ?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('asset'); ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('asset'); ?>/dist/js/demo.js"></script>
<script src="<?= base_url('asset'); ?>/dist/js/alert/sweetalert2.all.min.js"></script>
<script src="<?= base_url('asset'); ?>/dist/js/alert/myscript.js"></script>
<script src="<?= base_url('asset'); ?>/plugins/summernote/summernote-bs4.js"></script>


<script src="<?= base_url('asset'); ?>/plugins/ckeditor/ckeditor.js"></script>
<script src="<?= base_url('asset'); ?>/plugins/ckeditor/styles.js"></script>
<script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor');
</script>
<script>
    $(".input-group.date").datepicker({
        autoclose: true,
        format: " yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
</script>

<script>
    $("#date1").datepicker({
        format: 'MM',
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
</script>
<script>
    $("#date2").datepicker({
        format: 'MM',
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
</script>
<script>
    $("#date3").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true

    });
</script>
<!--<script>
    $(document).ready(function() {
        $('#air').hide();
        $('.field').hide();

    });
</script>-->
<script>
    function tampil_box(param) {
        if (param == 2) {
            $('#air').show();
        } else {
            $('#air').hide();
        }
    }
</script>
<script>
    function tampil_field(param) {
        if (param == 1) {
            $('.field').show();
        } else {
            $('.field').hide();
        }
    }
</script>

<script>
    $(function() {

        $('#example1').DataTable({
            "responsive": true,
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": true

            /* dom: 'Bfrtip',*/
            /*  dom: 'Bfrtip',
              buttons: [{
                      extends: 'pdf',
                      oriented: 'potrait',
                      pageSize: 'Legal',
                      download: 'open'
                  },
                  'csv', 'excel', 'print', 'copy', 'pdf'
              ]*/
        });
    });
</script>

</body>

</html>