<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {

        $address = Address::all();

        return response(['total' => sizeof($address), 'data' => $address], 200);
    }

    public function new(Request $request)
    {

        try {
            $address = Address::create([
                'cep' => $request->cep,
                'uf' => $request->uf,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'complemento' => $request->complemento
            ]);

            return response(['status' => 'success', 'message' => 'Endereço criado com sucesso!', 'data' => $address], 201);
        } catch (Exception $err) {
            return response(['status' => 'error', 'message' => $err->getMessage()], 500);
        }
    }

    /**
     * Método para atualização de endereços
     */
    public function update(Request $request, $id)
    {

        $request = $request->all();
        if (!$address = Address::find($id)) {

            return response(["status" => "error", "message" => "Endereço não encontrado!"], 500);
        } else {

            try {
                $address->update($request);

                return response(['status' => 'success', 'message' => 'Endereço atualizado com sucesso!', 'data' => $address], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }
        }
    }

    public function remove(Address $address, $id)
    {

        if (!$address = Address::find($id)) {

            return response(["status" => "error", "message" => "Endereço não encontrado!"], 500);
        } else {

            try {
                $address->delete();

                return response(["status" => "success", "message" => "Endereço removido com sucesso!"], 200);
            } catch (Exception $err) {
                return response(["error" => "error", "message" => $err->getMessage()], 500);
            }
        }
    }
}
