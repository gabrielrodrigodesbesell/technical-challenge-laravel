<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnderecoRequest;
use App\Http\Requests\StoreEnderecoRequest;
use App\Http\Requests\UpdateEnderecoRequest;
use App\Models\Endereco;
use App\Models\Pessoa;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnderecoController extends Controller
{
    public function create(Pessoa $pessoa)
    {
        return view('enderecos.create', compact('pessoa'));
    }

    public function store(StoreEnderecoRequest $request)
    {
        $endereco = Endereco::create($request->all());
        return redirect()->route('pessoas.show',$request->pessoa_id);
    }

    public function edit(Endereco $endereco)
    {
        $pessoas = Pessoa::pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');
        $endereco->load('pessoa');
        return view('enderecos.edit', compact('endereco', 'pessoas'));
    }

    public function update(UpdateEnderecoRequest $request, Endereco $endereco)
    {
        $endereco->update($request->all());
        return redirect()->route('pessoas.show',$endereco->pessoa_id);
    }

    public function destroy(Endereco $endereco)
    {
        $endereco->delete();
        return back();
    }
}
