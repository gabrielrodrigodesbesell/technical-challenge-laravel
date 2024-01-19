<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovimentacaoRequest;
use App\Http\Requests\UpdateMovimentacaoRequest;
use App\Http\Resources\ContaResource;
use App\Http\Resources\MovimentacaoResource;
use App\Models\Conta;
use App\Models\Movimentacao;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MovimentacaoApiController extends Controller
{
    protected $saldo = 0;
    protected $criacao = 0;

    public function store(StoreMovimentacaoRequest $request)
    {

        $conta = Conta::where('id', $request->conta_id)->get();
        $conta->transform(function ($conta) {
            $this->saldo = $conta->saldo = $conta->movimentacoes()->sum('valor');
            $this->criacao = $conta->dias = $conta->created_at->diffInDays();
            return $conta;
        });

        $saldo = $this->saldo + $request->valor;

        if ($this->criacao < 5 && $saldo < 0) {
            return $this->negativeBalance();
        }
        if (($this->criacao >= 5 && $this->criacao < 10) && $saldo < -500) {
            return $this->negativeBalance();
        }
        if (($this->criacao >= 10 && $this->criacao < 15) && $saldo < -1000) {
            return $this->negativeBalance();
        }
        if (($this->criacao >= 15) && $saldo < -5000) {
            return $this->negativeBalance();
        }

        $movimentacao = Movimentacao::create($request->all());
        $movimentacao->saldoConta = number_format($saldo,2,",",".");           
        
        return (new MovimentacaoResource($movimentacao))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function negativeBalance(){
        return response()->json(['message' => 'Conta sem permissão de ter saldo negativo desejado.'], 422);
    }
}
