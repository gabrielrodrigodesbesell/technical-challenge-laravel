@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans(isset($pessoa) ? 'global.update' : 'global.create') }} {{ trans('cruds.pessoa.title_singular') }}
        </div>
        <div class="card-body">
            @if (isset($pessoa))
                <form method="POST" action="{{ route('pessoas.update', [$pessoa->id]) }}">
                    @method('PUT')
                @else
                    <form method="POST" action="{{ route('pessoas.store') }}">
            @endif
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="required" for="nome">{{ trans('cruds.pessoa.fields.nome') }}</label>
                        <input class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text"
                            name="nome" id="nome" value="{{ old('nome', isset($pessoa) ? $pessoa->nome : null) }}"
                            required>
                        @if ($errors->has('nome'))
                            <span class="text-danger">{{ $errors->first('nome') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.pessoa.fields.nome_helper') }}</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label class="required" for="cpf">{{ trans('cruds.pessoa.fields.cpf') }}</label>
                        <input class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="text"
                            name="cpf" id="cpf" value="{{ old('cpf', isset($pessoa) ? $pessoa->cpf : null) }}"
                            required>
                        @if ($errors->has('cpf'))
                            <span class="text-danger">{{ $errors->first('cpf') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.pessoa.fields.cpf_helper') }}</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="data_nascimento">{{ trans('cruds.pessoa.fields.data_nascimento') }}</label>
                        <input class="form-control date {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}"
                            type="text" name="data_nascimento" id="data_nascimento"
                            value="{{ old('data_nascimento', isset($pessoa) ? $pessoa->data_nascimento : null) }}">
                        @if ($errors->has('data_nascimento'))
                            <span class="text-danger">{{ $errors->first('data_nascimento') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.pessoa.fields.data_nascimento_helper') }}</span>
                    </div>
                </div>
            </div>
            @if (!isset($pessoa))
                @include('pessoas.partials.enderecoForm')
            @endif
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-{{ trans(isset($pessoa) ? 'edit' : 'save') }}"></i>
                    {{ trans(isset($pessoa) ? 'global.update' : 'global.save') }}
                </button>
            </div>
            </form>
        </div>
    </div>
    @if (!isset($pessoa))
        @include('pessoas.partials.pessoasList')
    @endif
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('pessoas.massDestroy') }}",
                className: 'btn-danger',
                action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).nodes(), function(entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }
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
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    })

                }
            }
            dtButtons.push(deleteButton)


            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Pessoa:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
