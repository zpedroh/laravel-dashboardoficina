$(function () {
//<script> setTimeout(function(){window.location=NEW_URL}, TIME_IN_MILLISECONDS); </script>
    $('.btn-success').on('click', function () {

        //var url = $(this).val();

        swal({
            type: 'success',
            title: 'Sucesso',
            showConfirmButton: false
            //timer: 1500
          });

          //setTimeout(function(){window.location=url}, 1500);
    });

    $('.delete-confirm').on('click', function () {

        var url = $(this).val();
        
        swal({
            title: "Você tem certeza que deseja apagar este registro?",
            text: "Após ser apagado o registro não poderá ser recuperado",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, apagar",
            cancelButtonText: "Não, cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    swal({
                        title: "Apagado",
                        text: "O registro foi apagado com sucesso",
                        type: "success"
                    },
                        function (isConfirm) {
                            window.location = url;
                        });
                }
                else {
                    swal("Cancelado", "O registro não foi apagado", "error");
                }
            });

    });

});