<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContaRequest;
use App\Http\Requests\UpdateContaRequest;
use App\Http\Resources\ContaResource;
use App\Http\Resources\MovimentacaoResource;
use App\Models\Conta;
use App\Models\Movimentacao;
use Symfony\Component\HttpFoundation\Response;

class ContaApiController extends Controller
{
    public function index()
    {
        $contas = Conta::all();
        foreach ($contas as $conta) {
            $conta->saldo = $this->saldo($conta);
            $conta->dias = $conta->created_at->diffInDays();
        }
        return ContaResource::collection($contas);
    }

    public function store(StoreContaRequest $request)
    {
        $Conta = Conta::create($request->all());

        return (new ContaResource($Conta))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Conta $Conta)
    {
        $conta = $Conta;
        $conta->saldo = $this->saldo($conta);
        return new ContaResource($conta);
    }
    public function cpf($cpf)
    {
        $Conta = Conta::where('cpf',$cpf)->get();
        $Conta->transform(function ($conta) {
            $conta->saldo = $this->saldo($conta);
            return $conta;
        });
        return new ContaResource($Conta);
    }

    public function update(UpdateContaRequest $request, Conta $Conta)
    {
        $Conta->update($request->all());

        return (new ContaResource($Conta))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Conta $Conta)
    {
        
        $Conta->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function saldo(Conta $conta){
        return number_format($conta->movimentacoes()->sum('valor'),2,",",".");
    }

    public function extrato($conta)
    {
        $extrato = Movimentacao::where('conta_id',$conta)->latest()->get();
        return new MovimentacaoResource($extrato);
    }
}
