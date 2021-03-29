<script>
$(document).ready(function(){
    $(document).on('click', '.viewVotosProjetos', function(){  
           var id_hst_voto = $(this).attr("id");  
           $.ajax({  
                url:"<?php echo site_url('lista-historicos-votos-gestor/'); ?>" + id_hst_voto,  
                method:"GET",    
                success:function(data)  
                {  
                     $('#listaHistoricosVotosModal').modal('show');  
                     $('#result_tabela_historico_votacao').html(data);
                }  
           })  
      }); 
});
</script>