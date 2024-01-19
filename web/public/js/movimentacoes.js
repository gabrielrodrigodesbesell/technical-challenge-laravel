$(document).ready(function () {

    $('input[name="valor"]').mask('000.000.000.000.000,00', { reverse: true });

    $(document).on('change', '.get-accounts', function (e) {
        e.preventDefault();
        $('#extrato').html('<div class="alert alert-warning">' + lang.movimentacaoSelectaccount + '</div>')
        let cpf = $(this);
        let accounts = $('#conta_id');
        if (cpf.val() !== "") {
            accounts.html('<option value="">' + lang.movimentacaoSearchAccounts + '</option>');
            $.ajax(apiurl + 'contas/' + cpf.val().replace(/\D/g, "") + '/cpf',
                {
                    dataType: 'json',
                    timeout: 500,
                    success: function (data, status, xhr) {
                        var accounts = '<option value="">selecione uma conta...</option>';
                        if (data.data.length) {
                            $.each(data.data, function (index, value) {
                                accounts += '<option value="' + value.id + '">' + value.conta + ' - Saldo R$ ' + value.saldo + '</option>';
                            });
                        } else {
                            var accounts = '<option value="">' + lang.movimentacaoNoaccounts + '</option>';
                        }
                        $('#conta_id').html(accounts);
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        alert(errorMessage)
                    }
                }
            );
        }
    });

    $(document).on('change', '.accounts', function (e) {
        e.preventDefault();
        var conta = $(this);
        var extrato = $('#extrato');
        $('.operation-type').removeClass('d-none');
        $.ajax(apiurl + 'contas/' + conta.val().replace(/\D/g, "") + '/extrato',
            {
                dataType: 'json',
                timeout: 500,
                success: function (data, status, xhr) {
                    if (data.data.length) {
                        var table = '<table class="table table-bordered table-stripped">';
                        table += '<thead><tr><th>' + lang.movimentacaoValor + '</th><th>' + lang.movimentacaoData + '</th></tr></thead></tbody>';
                        $.each(data.data, function (index, value) {
                            table += '<tr>';
                            table += '<td class="text-' + ((value.valor < 0) ? 'danger' : 'success') + '">';
                            table += 'R$ ' + formatarMoeda(value.valor)
                            table += '</td>';
                            table += '<td>' + value.data + '</td>';
                            table += '</tr>';
                        });
                        table += '</tbody></table>';
                        extrato.html(table);
                    } else {
                        extrato.html('<div class="alert alert-info">' + lang.movimentacaoNofinancialoperations + '</div>');
                    }

                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert(errorMessage)
                }
            }
        );
    });

    $(document).on('click', '#store-movimentacao', function (e) {
        e.preventDefault();
        $('#error-response').html('');
        var btn = $(this);
        var conta = $('select[name="conta_id"]');
        var valor = $('input[name="valor"]');
        var data = $('input[name="data"]');

        valor.removeClass('is-invalid');
        if (valor.val() == '') {
            valor.addClass('is-invalid');
            return;
        }
        data.removeClass('is-invalid');
        if (data.val() == '') {
            data.addClass('is-invalid');
            return
        }

        valorInserido = valor.val().replace(/\./g, '').replace(',', '.');

        var operationCheckbox = $('#operacoes input[name="acao"]:checked');
        
        var operation = operationCheckbox.val();

        if (operation === '0') {
            valorInserido = valorInserido * -1;
        }
        btn.attr('disabled', true);
        $.ajax({
            type: "POST",
            url: apiurl + 'movimentacoes',
            dataType: "json",
            data: { conta_id: conta.val(), data: data.val(), valor:valorInserido },
            success: function (response) {
                $('#extrato').prepend('<div class="alert alert-success">'+lang.movimentacaoInsertSuccess+'</div>');
                if ($('#extrato tbody').length > 0) {
                    tr = '<tr>';
                    tr += '<td class="text-' + ((response.valor < 0) ? 'danger' : 'success') + '">';
                    tr += 'R$ ' + formatarMoeda(response.valor)
                    tr += '</td>';
                    tr += '<td>' + response.data + '</td>';
                    tr += '</tr>';
                    $('#extrato tbody').prepend(tr);
                } else {
                    $('.accounts').trigger('change');
                }

                $conta = $('#conta_id option:selected').text();

                $conta = $conta.split(' - ');
                $conta = $conta[0]+' - Saldo R$ '+response.saldoConta;
                $('#conta_id option:selected').text($conta);
                $('#conta_id').select2()

                operationCheckbox.prop('checked', false);
                valor.val('');
                valor.removeClass('is-valid');
                data.val('');
                $('.operation').addClass('d-none');      
                btn.attr('disabled', false);
               
            },
            error: function (jqXhr, textStatus, errorMessage) {
                btn.attr('disabled', false);
              $('#error-response').html('<div class="alert alert-danger">'+jqXhr.responseJSON.message+'</div>');
            }
        });
        
    });
    $(document).on('click', '#operacoes input[name="acao"]', function () {
        var operation = $(this).val();
        $('.operation').removeClass('d-none');
        $('#extrato .alert-success').remove();
        if (operation === '0') {
            $('#label-operation').html('- R$');
        } else {
            $('#label-operation').html('+ R$');
        }
    });

    $(document).on('keyup', 'input.validate', function () {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');
    })
    $(document).on('change', 'input.validate', function () {
        if ($(this).val() === "") {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
    });
    
})