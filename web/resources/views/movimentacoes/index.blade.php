@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.movimentacao.title') }}
                </div>
                <div class="card-body">
                    <form method="POST" id="operacoes" action="">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="required" for="cpf_id">{{ trans('cruds.pessoa.fields.nome') }}</label>
                                    <select
                                        class="form-control select2 get-accounts {{ $errors->has('cpf') ? 'is-invalid' : '' }}"
                                        name="cpf" id="cpf">
                                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                                        @foreach ($cpfs as $cpf => $nome)
                                            <option value="{{ $cpf }}">
                                                {{ $nome }} - {{ CPF2Mask($cpf) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="required"
                                        for="conta_id">{{ trans('cruds.movimentacao.fields.conta') }}</label>
                                    <select
                                        class="form-control accounts select2 {{ $errors->has('conta') ? 'is-invalid' : '' }}"
                                        name="conta_id" id="conta_id" required>
                                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                                    </select>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 d-none operation-type">
                                <div class="form-group">
                                    <label class="required">{{ trans('cruds.movimentacao.fields.acao') }}</label>
                                    @foreach (App\Models\Movimentacao::ACAO_RADIO as $key => $label)
                                        <div class="form-check {{ $errors->has('acao') ? 'is-invalid' : '' }}">
                                            <input class="form-check-input" type="radio" id="acao_{{ $key }}"
                                                name="acao" value="{{ $key }}"
                                                {{ old('acao', '') === (string) $key ? 'checked' : '' }} required>
                                            <label class="form-check-label"
                                                for="acao_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach                                   
                                </div>
                            </div>
                            <div class="col-4 operation d-none">
                                <div class="form-group">
                                    <label class="required"
                                        for="valor">{{ trans('cruds.movimentacao.fields.valor') }}</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="label-operation">
                                                R$
                                            </span>
                                        </div>
                                        <input class="form-control validate"
                                            type="text" name="valor" id="valor" 
                                        >
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-4 operation d-none">
                                <div class="form-group">
                                    <label class="required"
                                        for="data">{{ trans('cruds.movimentacao.fields.data') }}</label>
                                    <input class="form-control datetime validate"
                                        type="text" name="data" id="data">
                                </div>
                            </div>
                        </div>
                        <span id="error-response" class="text-danger"></span>
                        <div class="form-group operation d-none">
                            <button class="btn btn-success" type="button" id="store-movimentacao">
                                <i class="fa fa-save"></i>
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.movimentacao.extrato') }}
                </div>
                <div class="card-body" id="extrato">
                    <div class="alert alert-warning">
                        {{ trans('cruds.movimentacao.selectaccount') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
