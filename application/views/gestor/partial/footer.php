<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://c8sistemas.com.br/">C8-Sistemas</a>.</strong>
    Todos os direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.1.0-rc
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone.min.js" integrity="sha512-u3yRfU7FD5wGhxEMFZLZT/W/Y+C0vqUuQjPAhRWnQjBZ1LhUMnyTnZ6AfwxLSCxACT4eiyAnjFAMIt0qog67qg==" crossorigin="anonymous"></script>


<script src="<?= base_url() ?>assets/admin/dist/js/pages/dashboard.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
<!--
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
-->

<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


<?php
$this->load->view('gestor/modal/x001_perfil');
$this->load->view('gestor/modal/x002_cadastro-projetos');
$this->load->view('gestor/modal/x003_cadastro-vereadores');
$this->load->view('gestor/modal/x004_abrir-votacao');
$this->load->view('gestor/modal/x005_sessao-instituicao');
$this->load->view('gestor/modal/x005_projetos-votados');
$this->load->view('gestor/modal/x006_tela-votacao', $myuser);
$this->load->view('gestor/modal/x007_voto_mesa', $myuser);
$this->load->view('gestor/modal/x008-agenda-de-votacao', $myuser);
$this->load->view('gestor/modal/x009_historico-sessao');
$this->load->view('gestor/modal/x010_votos-projetos');
$this->load->view('gestor/modal/x011_url', $myuser);

/**js */
$this->load->view('gestor/js/jsx_001-perfil');
$this->load->view('gestor/js/jsx_002_cadastro-projetos', $myuser);
$this->load->view('gestor/js/jsx_003_cadastro-vereador', $myuser);
$this->load->view('gestor/js/jsx_004_listaPedidoSessao', $myuser);
$this->load->view('gestor/js/jsx_005-sessao', $myuser);
$this->load->view('gestor/js/jsx_007_voto-mesa', $myuser);
$this->load->view('gestor/js/jsx_008-fullcalendar', $myuser);
$this->load->view('gestor/js/jsx_010-historicos-projetos-votos', $myuser);
$this->load->view('gestor/js/jsx_11-url', $myuser);

?>

<script>
function blink_p(selector) {
    $(selector).fadeOut('slow', function() {
        $(this).fadeIn('slow', function() {
            blink_p(this);
        });
    });
}

blink_p('.piscar_btn');
</script>
<script>
$(document).ready(function(){
    //$("#showMeuTimeGrupo").hide();
});
</script>
</body>

</html>