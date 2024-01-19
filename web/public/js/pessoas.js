$(document).on('keyup', '#cep', function (e) {
    $('#cep').removeClass('is-invalid');
});
$(document).on('click', '#cep-check-exists', function (e) {
    e.preventDefault();
    let cep = $('#cep');
    if (cep.val() == "") {
        cep.addClass('is-invalid')
    } else {
        $.ajax(apiurl + 'ceps/' + cep.val().replace(/\D/g, ""),
            {
                dataType: 'json', // type of response data
                timeout: 500,     // timeout milliseconds
                success: function (data, status, xhr) {   // success callback function
                    $('input[name="rua"]').val(data.data.rua);
                    $('input[name="cidade"]').val(data.data.cidade);
                    $('input[name="estado"]').val(data.data.estado);
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback 
                    console.log(errorMessage)
                }
            });
    }
});