@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.endereco.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('enderecos.update', [$endereco->id]) }}">
                @method('PUT')
                @csrf
                @include('enderecos.partials.form')
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-edit"></i>
                        {{ trans('global.edit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
