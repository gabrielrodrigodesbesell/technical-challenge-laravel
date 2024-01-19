<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContaRequest;
use App\Http\Requests\StoreContaRequest;
use App\Http\Requests\UpdateContaRequest;
use App\Models\Conta;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;

class ContaController extends Controller
{
    
    public function index()
    {
        $cpfs = $this->cpfs();
        $contas = '';
        try {
            $client = new Client();
            $response = $client->get(env('API_URL') . 'contas', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);
            $contas = json_decode($response->getBody());
            foreach ($contas->data as $k => $conta) {
                $contas->data[$k]->nome = Pessoa::where('cpf', $conta->cpf)->pluck('nome')->implode(',');
            }
            $contas = $contas->data;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return redirect()->back()->with('error', trans('global.unknownerror'));
            } else {
                return redirect()->back()->with('error', trans('global.networkerror'));
            }
        }

        return view('conta.index', compact('cpfs', 'contas'));
    }

    public function store(Request $request)
    {
        try {
            $client = new Client();
            $client->post(env('API_URL') . 'contas', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'cpf' => $request->input('cpf'),
                    'conta' => $request->input('conta')
                ],
            ]);
            return redirect()->back()->with('success', trans('global.storewithsuccess'));
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $error = json_decode($e->getResponse()->getBody(), true);
                if (!empty($error)) {
                    return redirect()->back()->withErrors($error['errors'])->withInput();
                } else {
                    return redirect()->back()->with('error', trans('global.unknownerror'));
                }
            } else {
                return redirect()->back()->with('error', trans('global.networkerror'));
            }
        }
    }
    public function update($id, Request $request)
    {
        try {
            $client = new Client();
            $client->put(env('API_URL') . 'contas/' . $id,  [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'cpf' => $request->input('cpf'),
                    'conta' => $request->input('conta'),
                    'created_at' => $request->input('created_at')
                ],
            ]);
            return redirect()->route('conta.index')->with('success', trans('global.updatewithsuccess'));
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $error = json_decode($e->getResponse()->getBody(), true);
                if (!empty($error)) {
                    return redirect()->back()->withErrors($error['errors'])->withInput();
                } else {
                    return redirect()->back()->with('error', trans('global.unknownerror'));
                }
            } else {
                return redirect()->back()->with('error', trans('global.networkerror'));
            }
        }
    }

    public function edit($id)
    {
        try {
            $client = new Client();
            $response = $client->get(env('API_URL') . 'contas/' . $id,  [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);
            $conta = json_decode($response->getBody())->data;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return redirect()->back()->with('error', trans('global.unknownerror'));
            } else {
                return redirect()->back()->with('error', trans('global.networkerror'));
            }
        }
        $cpfs = $this->cpfs();
        return view('conta.index', compact('cpfs', 'conta'));
    }

    public function destroy($id)
    {
        try {
           $client = new Client();
            $client->delete(env('API_URL') . 'contas/' . $id, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);
            return redirect()->back()->with('success', trans('global.destroywithsuccess'));
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $error = json_decode($e->getResponse()->getBody(), true);
                if (!empty($error)) {
                    return redirect()->back()->withErrors($error['errors'])->withInput();
                } else {
                    return redirect()->back()->with('error', trans('global.unknownerror'));
                }
            } else {
                return redirect()->back()->with('error', trans('global.networkerror'));
            }
        }
    }

    public function cpfs()
    {
        return Pessoa::whereDate('data_nascimento', '<', now()->subYears(18))
            ->orWhereNull('data_nascimento')
            ->pluck('nome', 'cpf');
    }
}
