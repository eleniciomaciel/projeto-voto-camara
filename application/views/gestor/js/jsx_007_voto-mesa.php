<script>
    $(document).ready(function() {

        /**abre modal individual */
        $(document).on('click', '.viewVotoVerador', function() {

            var id_do_vereador_individual = $(this).attr("id");
            let projetovotoindividual = $(this).data("projetovotoindividual");
            let nomevotoindividual = $(this).data("nomevotoindividual");
            let iddovereadorvoto = $(this).data("iddovereadorvoto");

            $('#id_do_vereador_individual').val(id_do_vereador_individual);
            $('#projetovotoindividual').val(projetovotoindividual);
            $('#nomevotoindividual').html(nomevotoindividual);

            //dados voto não
            $('#id_do_vereador_individual_nao').val(id_do_vereador_individual);
            $('#projetovotoindividual_nao').val(projetovotoindividual);

            $('#modal_voto_individual').modal('show');
        });

        /**voto mesa sim */
        $(document).on('submit', '#formSimIndividual', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Confirmar voto?',
                text: "Deseja confirmar voto como sim!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, confirmar!',
                cancelButtonText: 'Não, cancelar!',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: $(this).closest('form').attr('action'),
                        type: $(this).closest('form').attr('method'),
                        data: $(this).serialize(),

                        success: function(data) {
                            if (data == true) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Voto confirmado com sucesso!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire(
                                    'Ooops!',
                                    'Você esqueceu de lançar o tempo dele(a), faça isso antes de confirmar por gentileza!',
                                    'error'
                                )
                            }

                        }
                    });
                }
            });
        });

        /**voto mesa não */
        $(document).on('submit', '#formNaoIndividual', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Confirmar voto?',
                text: "Deseja confirmar voto como não!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, confirmar!',
                cancelButtonText: 'Não, cancelar!',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: $(this).closest('form').attr('action'),
                        type: $(this).closest('form').attr('method'),
                        data: $(this).serialize(),

                        success: function(data) {
                            if (data == true) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Voto confirmado com sucesso!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire(
                                    'Ooops!',
                                    'Você esqueceu de lançar o tempo dele(a), faça isso antes de confirmar por gentileza!',
                                    'error'
                                )
                            }

                        }
                    });
                }
            });
        });

    });
</script>