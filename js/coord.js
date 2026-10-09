$(document).ready(function(){

    // mostrar el modal de nuevo coordinadores y ocultar el editar
    $('#bnuevocoord').click(function(){
        $('#editarcoord').modal('hide');
        $('#nuevocoord').modal('show');
    })

    // cargar las ies de acuerdo al mpio seleccionado usando ajax
    $('#mpio').change(function() {
        var mpiosel = $(this).val();
        $.ajax({
            url: 'modules/institutions/lista_ies.php',
            type: 'POST',
            data: {mpio: mpiosel},
            success: function(response){
                $('#lies').empty(); // Limpiar el select de opciones anteriores
                var data = JSON.parse(response);
                data.forEach(function(ie) {
                    $('#lies').append('<option value="' + ie.id + '">' + ie.nombre + '</option>');
                });
            }
        });        
    });
    
});