<div class="card">
    <div class="card-header">
        {{ trans('cruds.pessoa.title') }}
    </div>
    <div class="card-body">
        @if ($pessoas->count())
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Pessoa">
                    <thead>
                        <tr>
                            <th width="10">
                            </th>
                            <th>
                                {{ trans('cruds.pessoa.fields.nome') }}
                            </th>
                            <th>
                                {{ trans('cruds.pessoa.fields.cpf') }}
                            </th>
                            <th>
                                {{ trans('cruds.pessoa.fields.data_nascimento') }}
                            </th>
                            <th>
                                {{ trans('cruds.endereco.title') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pessoas as $key => $pessoa)
                            <tr data-entry-id="{{ $pessoa->id }}">
                                <td>
                                </td>
                                <td>
                                    {{ $pessoa->nome ?? '' }}
                                </td>
                                <td>
                                    {{ CPF2Mask($pessoa->cpf) }}
                                </td>
                                <td>
                                    {{ $pessoa->data_nascimento ?? trans('global.not_informed') }}
                                    @if($pessoa->data_nascimento && 
                                        ((\Carbon\Carbon::parse(\Carbon\Carbon::createFromFormat('d/m/Y', $pessoa->data_nascimento))->age)<18)
                                    )
                                        <span class="badge badge-warning">
                                            <i class="fa fa-child"></i>
                                            menor
                                        </span>
                                    @endif

                                </td>
                                <td>
                                    @foreach ($pessoa->pessoaEnderecos as $endereco)
                                        {{ $endereco->cidade }}/{{ $endereco->estado }}.&nbsp;
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('pessoas.show', $pessoa->id) }}">
                                        <i class="fa fa-eye"></i>
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('pessoas.edit', $pessoa->id) }}">
                                        <i class="fa fa-edit"></i>
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form class="form-destroy" action="{{ route('pessoas.destroy', $pessoa->id) }}"
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
            </div>
        @else
            <div class="alert alert-warning">
                {{trans('global.no_results')}}
            </div>
        @endif
    </div>
</div>
