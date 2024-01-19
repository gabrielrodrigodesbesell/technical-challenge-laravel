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

  $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', 'selected')
    $select2.trigger('change')
  })
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', '')
    $select2.trigger('change')
  })

  $('.select2').select2()

  $('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
      if ($(this).hasClass('active')) {
        shouldExpand = true
      }
    })
    if (shouldExpand) {
      $(this).addClass('active')
    }
  })

  $('a[data-widget^="pushmenu"]').click(function () {
    setTimeout(function () {
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    }, 350);
  });

  $('input[name="cpf"]').mask('000.000.000-00', { reverse: true });
  $('input[name="cep"]').mask('00.000-000', { reverse: true });

  $(document).on('click', '.btn-destroy', function (e) {
    e.preventDefault();
    var element = $(this);
    Swal.fire({
      title: lang.areUSure,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#cc3f44",
      confirmButtonText: lang.btnConfirm,
      cancelButtonText: lang.btnCancel,
      closeOnConfirm: true,
      html: false
    }).then((result) => {
      if (result.isConfirmed) {
        element.parents('form').submit();
      }
    })
  });

  $(document).on('keyup', '#cep', function (e) {
    $('#cep').removeClass('is-invalid');
  });
  $(document).on('click', '#cep-check-exists', function (e) {
    e.preventDefault();
    let cep = $('#cep');
    if (cep.val() == "") {
      cep.addClass('is-invalid')
    } else {
      $.ajax(apiurl+'ceps/'+cep.val().replace(/\D/g, ""),
        {
          dataType: 'json', // type of response data
          timeout: 500,     // timeout milliseconds
          success: function (data, status, xhr) {   // success callback function
            $('input[name="rua"]').val(data.data.rua);
            $('input[name="cidade"]').val(data.data.cidade);
            $('input[name="estado"]').val(data.data.estado);
          },
          error: function (jqXhr, textStatus, errorMessage) { // error callback 
            
          }
        });
    }
  });
})
