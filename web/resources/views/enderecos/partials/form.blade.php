<div class="row">
    <div class="col-2">
        <div class="form-group">
            <label for="cep">{{ trans('cruds.endereco.fields.cep') }}</label>
            <div class="input-group mb-3">

                <input class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" type="text" name="cep"
                    id="cep" value="{{ old('cep', isset($endereco) ? $endereco->cep : null) }}"
                    {{ isset($pessoa) ? 'required' : null }}>
                <div class="input-group-append">
                    <span class="input-group-text">
                        <a href="#" id="cep-check-exists">
                            <i class="fa fa-search"></i>
                        </a>
                    </span>
                </div>
            </div>
            @if ($errors->has('cep'))
                <span class="text-danger">{{ $errors->first('cep') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.endereco.fields.cep_helper') }}</span>
        </div>
    </div>
    <div class="col-8">
        <div class="form-group">
            <label for="rua">{{ trans('cruds.endereco.fields.rua') }}</label>
            <input class="form-control {{ $errors->has('rua') ? 'is-invalid' : '' }}" type="text" name="rua"
                id="rua" value="{{ old('rua', isset($endereco) ? $endereco->rua : null) }}"
                {{ isset($pessoa) ? 'required' : null }}>
            @if ($errors->has('rua'))
                <span class="text-danger">{{ $errors->first('rua') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.endereco.fields.rua_helper') }}</span>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label for="numero">{{ trans('cruds.endereco.fields.numero') }}</label>
            <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="number" name="numero"
                id="numero" value="{{ old('numero', isset($endereco) ? $endereco->numero : null) }}"
                {{ isset($pessoa) ? 'required' : null }} step="1">
            @if ($errors->has('numero'))
                <span class="text-danger">{{ $errors->first('numero') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.endereco.fields.numero_helper') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="cidade">{{ trans('cruds.endereco.fields.cidade') }}</label>
            <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade"
                id="cidade" value="{{ old('cidade', isset($endereco) ? $endereco->cidade : null) }}"
                {{ isset($pessoa) ? 'required' : null }}>
            @if ($errors->has('cidade'))
                <span class="text-danger">{{ $errors->first('cidade') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.endereco.fields.cidade_helper') }}</span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="estado">{{ trans('cruds.endereco.fields.estado') }}</label>
            <input class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" type="text" name="estado"
                id="estado" value="{{ old('estado', isset($endereco) ? $endereco->estado : null) }}"
                {{ isset($pessoa) ? 'required' : null }}>
            @if ($errors->has('estado'))
                <span class="text-danger">{{ $errors->first('estado') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.endereco.fields.estado_helper') }}</span>
        </div>
    </div>
</div>
