<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCepRequest;
use App\Http\Requests\UpdateCepRequest;
use App\Http\Resources\CepResource;
use App\Models\Cep;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CepApiController extends Controller
{
    public function index()
    {
        return new CepResource(Cep::all());
    }

    public function store(StoreCepRequest $request)
    {

        $cep = Cep::create($request->all());
        
        return (new CepResource($cep))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cep $cep)
    {
        return new CepResource($cep);
    }

    public function update(UpdateCepRequest $request, Cep $cep)
    {
        $cep->update($request->all());

        return (new CepResource($cep))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cep $cep)
    {
        $cep->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
