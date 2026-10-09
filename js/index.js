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

    function cargarIes() {
        var mpiosel = $('#mpio').val();
        $('#lies').empty();
        if (!mpiosel) {
            return;
        }
        $.ajax({
            url: 'modules/institutions/lista_ies.php',
            type: 'POST',
            dataType: 'json',
            data: {mpio: mpiosel},
            success: function(data){
                $('#lies').empty();
                data.forEach(function(ie) {
                    $('#lies').append($('<option>').val(ie.id).text(ie.nombre));
                });
            }
        });
    }

    $('#mpio').on('change', cargarIes);

    // el municipio preseleccionado no dispara "change", por eso se carga al abrir el modal
    document.getElementById('coord').addEventListener('shown.bs.modal', cargarIes);
    
    $('#bbuscar').click(function(){
        let doci = $('#busdoci').val();
        if (doci == '') {
            document.getElementById('busaviso').textContent = 'Debe ingresar el número de documento';
            return;
        }
        else {
        document.getElementById('busaviso').textContent = '';
        $.ajax({
            url: 'modules/certificates/buscarcert.php',
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
