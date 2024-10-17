$(document).ready(function(){
    
    $('#bmail').click(function(){
        $('#rmail').modal('hide');
        $('#rmail').modal('show');
    })
    
    // mostrar el modal de coordinadores y ocultar el de remitentes
    $('#bcoord').click(function(){
        $('#rmail').modal('hide');
        $('#coord').modal('show');
    })

    // cargar las ies de acuerdo al mpio seleccionado usando ajax

    $('#mpio').change(function() {
        var mpiosel = $(this).val();
        $.ajax({
            url: 'lista_ies.php',
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
    
    $('#bbuscar').click(function(){
        let doci = $('#busdoci').val();
        if (doci == '') {
            document.getElementById('busaviso').textContent = 'Debe ingresar el número de documento';
            return;
        }
        else {
        document.getElementById('busaviso').textContent = '';
        $.ajax({
            url: 'buscarcert.php',
            type: 'GET',
            data: {doci: doci},
            success: function(response){
                $("#info").html(response);
            }
            });
        }
    });

    const Modal = document.getElementById('mcert')
    Modal.addEventListener('show.bs.modal', event => {
        $("#info").html('');
        $('#busdoci').val('');
    })

});
