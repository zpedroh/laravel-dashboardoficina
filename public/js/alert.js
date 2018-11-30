
$('.delete-confirm').on('click', function (e) {
    
    e.preventDefault();

    var url = $(this).val();

    var deletar = $(this).attr("href");
    
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
                window.location = deletar;
            }
            else {
                swal("Cancelado", "O registro não foi apagado", "error");
            }
        });
});

