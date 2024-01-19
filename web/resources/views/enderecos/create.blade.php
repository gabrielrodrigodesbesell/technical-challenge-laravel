@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.endereco.title_singular') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('enderecos.store') }}">
                @csrf
                <input type="hidden" name="pessoa_id" value="{{$pessoa->id}}">
                @include('enderecos.partials.form')
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i>
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
