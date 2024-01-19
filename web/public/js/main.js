$(document).ready(function () {
  window._token = $('meta[name="csrf-token"]').attr('content')

  moment.updateLocale('en', {
    week: { dow: 1 } // Monday is the first day of the week
  })

  $('.date').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: 'en',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.datetime').datetimepicker({
    format: 'DD/MM/YYYY HH:mm:ss',
    locale: 'en',
    sideBySide: true,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.timepicker').datetimepicker({
    format: 'HH:mm:ss',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.select2').select2()



  $('a[data-widget^="pushmenu"]').click(function () {
    setTimeout(function () {
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    }, 350);
  });

  $('input[name="cpf"]').mask('000.000.000-00', { reverse: true });
  $('input[name="cep"]').mask('00.000-000', { reverse: true });
  $('input[name="conta"]').mask('000000-0', { reverse: true });
  
  $(document).on('click', '.btn-destroy', function (e) {
    e.preventDefault();
    var element = $(this);
    if (typeof element.attr('data-saldo') !== 'undefined') {
      var avisoSaldo = (element.data('saldo')!="0,00")?lang.avisoSaldo+element.data('saldo'):false; 
    }
    Swal.fire({
      title: lang.areUSure,
      html:avisoSaldo,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#cc3f44",
      confirmButtonText: lang.btnConfirm,
      cancelButtonText: lang.btnCancel,
      closeOnConfirm: true,
    }).then((result) => {
      if (result.isConfirmed) {
        element.parents('form').submit();
      }
    })
  });

  
})
