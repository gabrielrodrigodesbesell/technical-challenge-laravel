@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans(isset($conta) ? 'global.update' : 'global.create') }} {{ trans('cruds.conta.title_singular') }}
        </div>
        <div class="card-body">
            @if (isset($conta))
                <form method="POST" action="{{ route('conta.update', [$conta->id]) }}">
                    @method('PUT')
                @else
                    <form method="POST" action="{{ route('conta.store') }}">
            @endif
            @csrf
            <div class="form-group">
                <label class="required" for="cpf_id">{{ trans('cruds.pessoa.fields.nome') }}</label>
                <select class="form-control select2 {{ $errors->has('cpf') ? 'is-invalid' : '' }}" name="cpf"
                    id="cpf">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach ($cpfs as $cpf => $nome)
                        <option value="{{ $cpf }}"
                            {{ old('cpf') == $cpf || (isset($conta) && $conta->cpf == $cpf) ? 'selected' : '' }}>
                            {{ $nome }} - {{ CPF2Mask($cpf) }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('cpf'))
                    <span class="text-danger">{{ $errors->first('cpf') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.conta.fields.cpf_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="conta">{{ trans('cruds.conta.fields.conta') }}</label>
                <input class="form-control {{ $errors->has('conta') ? 'is-invalid' : '' }}" type="text" name="conta"
                    id="conta" value="{{ old('conta', isset($conta) ? $conta->conta : null) }}" required>
                @if ($errors->has('conta'))
                    <span class="text-danger">{{ $errors->first('conta') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.conta.fields.conta_helper') }}</span>
            </div>

            @if (isset($conta))
            <div class="form-group">
                <label class="required" for="conta">Criação da conta</label>
                <input class="form-control {{ $errors->has('created_at') ? 'is-invalid' : '' }}" type="text" name="created_at"
                    id="created_at" value="{{ old('created_at', isset($conta) ? $conta->created_at : null) }}" required>
             
            </div>
            @endif
            <button class="btn btn-success" type="submit">
                <i class="fa fa-{{ trans(isset($conta) ? 'edit' : 'save') }}"></i>
                {{ trans(isset($conta) ? 'global.update' : 'global.save') }}
            </button>
            </form>
        </div>
    </div>
    @if (isset($contas))
        <div class="card">
            <div class="card-header">
                {{ trans('global.list') }} {{ trans('cruds.conta.title') }}
            </div>
            <div class="card-body">
                @if (!empty($contas))
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pessoa.fields.nome') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.conta.fields.cpf') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.conta.fields.conta') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.conta.fields.saldo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.conta.fields.criacao') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contas as $conta)
                                    <tr>
                                        <td>
                                            {{ $conta->nome!=="" ? $conta->nome : trans('global.not_exists') }}
                                        </td>
                                        <td>
                                            {{ CPF2Mask($conta->cpf) }}
                                        </td>
                                        <td>
                                            {{ $conta->conta ?? trans('global.not_informed') }}
                                        </td>
                                        <td class="{{ $conta->saldo < 0 ? 'text-danger': 'text-success' }}">
                                           R$ {{ $conta->saldo }}
                                        </td>
                                        <td>
                                            {{ $conta->dias ?? trans('global.not_informed') }}
                                            {{ trans('cruds.conta.fields.dias') }}
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('conta.edit', $conta->id) }}">
                                                <i class="fa fa-edit"></i>
                                                {{ trans('global.edit') }}
                                            </a>
                                            <form class="form-destroy" action="{{ route('conta.destroy', $conta->id) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="button" data-saldo="{{ $conta->saldo }}" class="btn btn-xs btn-danger btn-destroy">
                                                    <i class="fa fa-trash"></i>
                                                    {{ trans('global.delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">
                        {{ trans('global.no_results') }}
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    @parent
@endsection
