<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMovimentacaoRequest;
use App\Http\Requests\StoreMovimentacaoRequest;
use App\Http\Requests\UpdateMovimentacaoRequest;
use App\Models\Conta;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MovimentacaoController extends Controller
{
    public function index()
    {
        $cpfs = Pessoa::pluck('nome', 'cpf');
        return view('movimentacoes.index',compact('cpfs'));
    }

    public function store(StoreMovimentacaoRequest $request)
    {
        $movimentacao = Movimentacao::create($request->all());

        return redirect()->route('movimentacoes.index');
    }

    public function edit(Movimentacao $movimentacao)
    {
    
        $contas = Conta::pluck('cpf', 'id')->prepend(trans('global.pleaseSelect'), '');

        $movimentacao->load('conta');

        return view('movimentacoes.edit', compact('contas', 'movimentacao'));
    }

    public function update(UpdateMovimentacaoRequest $request, Movimentacao $movimentacao)
    {
        $movimentacao->update($request->all());

        return redirect()->route('movimentacoes.index');
    }

    public function show(Movimentacao $movimentacao)
    {
    
        $movimentacao->load('conta');

        return view('movimentacoes.show', compact('movimentacao'));
    }

    public function destroy(Movimentacao $movimentacao)
    {

        $movimentacao->delete();

        return back();
    }


}