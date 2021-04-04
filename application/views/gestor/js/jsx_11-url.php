<script>
    $(document).ready(function() {

        var idMyUser = <?= $myuser['us_fk_instituicao'] ?>;

        var dataTableurl = $('#lista_all_url').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?php echo site_url('lista-url/') ?>" + idMyUser,
                type: 'GET'
            },
        });

        $(document).on('submit', '#form_add_url', function(event) {
            event.preventDefault();

            $('#btn_id_add_url').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');
            $(".btn_cls_add_url").prop("disabled", true);

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {

                        $('#btn_id_add_url').html('<i class="fa fa-save"></i> Gerar url');
                        $(".btn_cls_add_url").prop("disabled", false);

                        Swal.fire(
                            'OK',
                            data.success,
                            'success'
                        );
                        $(".print-error-msg_add_url").css('display', 'none');
                        $('#form_add_url')[0].reset();
                        dataTableurl.ajax.reload();
                    } else {

                        $('#btn_id_add_url').html('<i class="fa fa-save"></i> Gerar url');
                        $(".btn_cls_add_url").prop("disabled", false);

                        $(".print-error-msg_add_url").css('display', 'block');
                        $(".print-error-msg_add_url").html(data.error);
                    }
                }
            });
        });


        $(document).on('click', '.btnCopy', function() {
            var element = $(this).attr("id");
   
            aux.innerHTML = document.getElementById(element).innerHTML;
            aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)");
            document.body.appendChild(aux);
            aux.focus();
            document.execCommand("copy");
            document.body.removeChild(aux);
        });
    });
</script>
<script>
function myFunction(value) {
  var copyText = value;
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Url copiada com sucesso");
}
</script>