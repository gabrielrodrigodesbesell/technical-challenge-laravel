@extends('layouts.template')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ trans('cruds.pessoa.title_singular') }}
    </div>
    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pessoa.fields.nome') }}
                        </th>
                        <td>
                            {{ $pessoa->nome }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pessoa.fields.cpf') }}
                        </th>
                        <td>
                            {{ CPF2Mask($pessoa->cpf) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pessoa.fields.data_nascimento') }}
                        </th>
                        <td>
                            {{ $pessoa->data_nascimento ?? trans('global.not_informed') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            @includeIf('pessoas.relationships.pessoaEnderecos', ['enderecos' => $pessoa->pessoaEnderecos])
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('pessoas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection