$(document).ready(function(){
    
    $('#bmail').click(function(){
        $('#rmail').modal('hide');
        $('#rmail').modal('show');
    })
    
    $('#bcoord').click(function(){
        $('#rmail').modal('hide');
        $('#coord').modal('show');
    })

    // cargar las ies de acuerdo al mpio seleccionado usando ajax

    $('#mpio').change(function() {
        var mpiosel = $(this).val();
        $.ajax({
            url: 'lista_ies.php?mpio=' + mpiosel,
            type: 'GET',
            dataType: "json",
            success: function(data) {
                $("#lies").empty();
                $.each(data, function(index, ies){
                    $("#lies").append('<option value="' + ies.id + '">' + ies.nombre + '</option>');
                });
            },
            error: function(){
                alert("error");
            }
        });
    });
    
});
