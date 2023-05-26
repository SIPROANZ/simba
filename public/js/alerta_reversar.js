$('.show-alert-reversar-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Estas seguro que deseas reversar este registro?",
        text: "Una vez hecha la modificacion proceda a aprobar su registro nuevamente para asi aceptar los cambios realizados",
        icon: "warning",
        type: "warning",
        buttons: ["Cancelar","Si!"],
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si eliminar'
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});