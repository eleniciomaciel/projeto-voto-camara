<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- jQuery -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url() ?>assets/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>assets/admin/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/admin/dist/js/beep.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.min.js" integrity="sha512-Vy4ftjkcjamOFPNSK7Osn8kYhF7XDcLWPiRvSmdimNscisyC8MkhDlAHSt+psegxRzd/q6wUC/VFhQZ6P2hBOw==" crossorigin="anonymous"></script>
<?php
$this->load->view('panelVereador/js/v_js_001-solicita_voto', $myuser);
$this->load->view('panelVereador/js/v_js_002-perfil', $myuser);
$this->load->view('panelVereador/modal/m_001-modal-tempo', $myuser);
$this->load->view('panelVereador/modal/m_002-dados-perfil', $myuser);

?>
</body>

</html>