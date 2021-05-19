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

        // Retorna todos os endereços cadastrados
        $address = Address::all();

        if (sizeof($address) != 0) {
            return response(['status' => 'success', 'total' => sizeof($address), 'data' => $address], 200);
        } else {
            return response(['status' => 'info', 'message' => 'Nenhum endereço cadastrado!'], 200);
        }

    }

    /**
     * Método para retornar os endereços com o CEP informado
     */

    public function findByCep($cep) {
        $address = DB::select("SELECT * FROM address WHERE cep = $cep");

        if (sizeof($address) != 0) {
            return response(['status' => 'success', 'total' => sizeof($address), 'data' => $address], 200);
        } else {
            return response(['status' => 'info', 'message' => 'Nenhum endereço encontrado para esse CEP!'], 200);
        }
    }

    /**
     * Método para retornar os endereços com o CEP informado
     */

    public function find(Request $request) {
        $addressName = $request['endereco'];

        $address = DB::select("SELECT * FROM addresses WHERE endereco like '%$addressName%'");

        if (sizeof($address) != 0) {
            return response(['status' => 'success', 'total' => sizeof($address), 'data' => $address], 200);
        } else {
            return response(['status' => 'info', 'message' => 'Nenhum endereço encontrado!'], 200);
        }
    }

    /**
     * Método para cadastro de endereço
     */
    public function new(Request $request)
    {

        // Valida se é possível cadastrar o endereço
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

            // Valida se é possível atualizar o endereço
            try {
                $address->update($request);

                return response(['status' => 'success', 'message' => 'Endereço atualizado com sucesso!', 'data' => $address], 201);
            } catch (Exception $err) {
                return response(['status' => 'error', 'message' => $err->getMessage()], 500);
            }
        }
    }

    /**
     * Método para exclusão de endereço
     */
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
