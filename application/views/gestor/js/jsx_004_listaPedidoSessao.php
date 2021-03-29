<script>
    var myIdentifyInstituto = '<?= $myuser['us_fk_instituicao'] ?>';

    listVeradorPedidoVoto(myIdentifyInstituto);
    

    setInterval(function() {
        listVeradorPedidoVoto(myIdentifyInstituto);
    }, 3000);

    function listVeradorPedidoVoto(myIdentifyInstituto) {
        //alert('ioooooo');

        $.ajax({
            type: 'ajax',
            url: "<?php echo site_url('solicita-status-solicitacao-dia_gestor/'); ?>" + myIdentifyInstituto,
            async: false,
            dataType: 'json',
            method:"GET",  
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {

                    var status_acc = data[i].sv_status_solicita == '1' ? '<span class="badge badge-success">Confirmado</span>' : '<span class="badge badge-danger">Aguardando</span>';
                    let data_sol = data[i].sv_data_solicita;
                    let foto = '<img src="<?= base_url() ?>assets/admin/upload/' + data[i].us_my_profile + '" class="img-circle elevation-2" width="34" height="34">';

                    html += '<tr>' +
                                '<td>#</td>' +
                                '<td>' + data[i].us_nome + '</td>' +
                                '<td>' + foto + '</td>' +
                                '<td>' + moment(data_sol).format('DD-MM-YYYY') + '</td>' +
                                '<td>' + status_acc + '</td>' +
                                '<td class="project-actions text-right">' +
                                    '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">' +
                                    '<button type="button" class="viewRecusar btn btn-danger" id="' + data[i].sv_id + '"><i class="fas fa-thumbs-down"></i> Recusar</button>' +
                                    '<button type="button" class="viewAceita btn btn-success" id="' + data[i].sv_fk_camera + '" data-idpedido="' + data[i].sv_id + '"  data-namevereador="' + data[i].us_nome + '"><i class="fas fa-thumbs-up"></i> Aceitar</button>' +
                                    '</div>' +
                                '</td>' +
                            '</tr>';
                }
                $('#listStatusSolicitaVotoGestor').html(html);
            }
        });
    }

    $(document).on('click', '.viewRecusar', function() {
        var rec_id = $(this).attr("id");

        Swal.fire({
            title: 'Recusar solicitação?',
            text: "Confirmar recusa de solicitação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, recusar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('recusa-solicitacao-gestor/'); ?>" + rec_id,
                    method: "GET",
                    success: function(data) {
                        Swal.fire(
                            'OK!',
                            data,
                            'success'
                        );
                    }
                });
            }
        });
    });

    /**adiciona sessão a solicitação */
    $(document).on('click', '.viewAceita', function(){  
           var id_ped_session = $(this).attr("id");  //id da camara
           var id_pedido_vpt = $(this).data("idpedido");//id do pedido

           var nameverdorpedido_ifelse = $(this).data("namevereador");
          
           $.ajax({  
                url:"<?php echo site_url('aceita-pedido-e-adiciona-sessao-ao-vereador/'); ?>" + id_ped_session,  
                method:"GET",    
                dataType:"json",  
                success:function(data)  
                {  
                     $('#modalPedidoAceitaSessao').modal('show');  
                     $('#ss_vsl_nome').val(data.ss_vsl_nome);  
                     $('#ss_vsl_id').val(data.ss_vsl_id); //id da sessão
                     $('#id_ped_session').val(id_ped_session);  //id da camara
                     $('#id_ped_voto_vr').val(id_pedido_vpt);  //id da camara
                     $('#nameverdorpedido_ifelse').val(nameverdorpedido_ifelse);  
                }  
           })  
      });  

      /**lista todas as sessoes da camara */



      
    /**aceitação */
        $(document).on('submit', '#viewAceitaConfirm', function(event){  
           event.preventDefault(); 

        var id_ped_voto_vr = $("input[name='id_ped_voto_vr']").val();

        Swal.fire({
            title: 'Aceitar solicitação?',
            text: "Confirmar aceitação de solicitação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, aceitar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('aceitacao-solicitacao-gestor/'); ?>" + id_ped_voto_vr,
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        Swal.fire(
                            'OK!',
                            data,
                            'success'
                        );
                    }
                });
            }
        });

    });
</script>