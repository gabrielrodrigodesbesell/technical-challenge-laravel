<div class="row">
    <div class="col-lg-12 mb-3">
        <a class="btn btn-success" href="{{ route('enderecos.createPessoa', $pessoa->id) }}">
            {{ trans('global.add') }} {{ trans('cruds.endereco.title_singular') }}
        </a>
    </div>
</div>
<div class="table-responsive">
    @if ($enderecos->count())
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="6">
                        {{ trans('cruds.endereco.title') }}
                    </th>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.endereco.fields.cep') }}
                    </th>
                    <th>
                        {{ trans('cruds.endereco.fields.rua') }}
                    </th>
                    <th>
                        {{ trans('cruds.endereco.fields.numero') }}
                    </th>
                    <th>
                        {{ trans('cruds.endereco.fields.cidade') }}
                    </th>
                    <th>
                        {{ trans('cruds.endereco.fields.estado') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enderecos as $key => $endereco)
                    <tr>
                        <td>
                            {{ CEP2Mask($endereco->cep) ?? '' }}
                        </td>
                        <td>
                            {{ $endereco->rua ?? '' }}
                        </td>
                        <td>
                            {{ $endereco->numero ?? '' }}
                        </td>
                        <td>
                            {{ $endereco->cidade ?? '' }}
                        </td>
                        <td>
                            {{ $endereco->estado ?? '' }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-info" href="{{ route('enderecos.edit', $endereco->id) }}">
                                <i class="fa fa-edit"></i>
                                {{ trans('global.edit') }}
                            </a>
                            <form class="form-destroy" action="{{ route('enderecos.destroy', $endereco->id) }}"
                                method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="button" class="btn btn-xs btn-danger btn-destroy">
                                    <i class="fa fa-trash"></i>
                                    {{ trans('global.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
