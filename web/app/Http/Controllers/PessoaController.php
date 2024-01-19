<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPessoaRequest;
use App\Http\Requests\StoreEnderecoRequest;
use App\Http\Requests\StorePessoaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Models\Endereco;
use App\Models\Pessoa;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::with('pessoaEnderecos')->get();
        return view('pessoas.index', compact('pessoas'));
    }

    public function store(StorePessoaRequest $request, StoreEnderecoRequest $endereco)
    {
        $pessoa = Pessoa::create($request->all());
        if (is_numeric($pessoa->id) && !empty($endereco->cep)) {
            $endereco->merge(['pessoa_id' => $pessoa->id]);
            $endereco = Endereco::create($endereco->all());
        }
        return redirect()->route('pessoas.index')->with('success', trans('global.storewithsuccess'));
    }

    public function edit(Pessoa $pessoa)
    {
        $pessoas = Pessoa::all();
        return view('pessoas.index', compact('pessoa', 'pessoas'));
    }

    public function update(UpdatePessoaRequest $request, Pessoa $pessoa)
    {
        $pessoa->update($request->all());
        return redirect()->route('pessoas.index')->with('success', trans('global.updatewithsuccess'));
    }

    public function show(Pessoa $pessoa)
    {
        $pessoa->load('pessoaEnderecos');
        return view('pessoas.show', compact('pessoa'));
    }

    public function destroy(Pessoa $pessoa)
    {
        $pessoa->pessoaEnderecos()->delete();
        $pessoa->delete();
        return redirect()->route('pessoas.index')->with('success', trans('global.destroywithsuccess'));
    }

    public function massDestroy(MassDestroyPessoaRequest $request)
    {
        $pessoas = Pessoa::find(request('ids'));

        foreach ($pessoas as $pessoa) {
            $pessoa->pessoaEnderecos()->delete();
            $pessoa->delete();
        }
        return redirect()->route('pessoas.index')->with('success', trans('global.destroywithsuccess'));
    }
}
