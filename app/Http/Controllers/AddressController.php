<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{

    /**
     * Lista todos os endereços da base de dados local
     */
    public function index() {

        $address = Address::all();

        if (sizeof($address) != 0) {
            return response(['status' => 'success', 'data' => $address], 200);
        } else {
            return response(['status' => 'info', 'message' => 'Nenhum endereço cadastrado!'], 200);
        }
    }

    /**
     * Lista um endereço baseado no id
     */
    public function show($id) {
        $address = Address::find($id);

        if (sizeOf(array($address)) != 0) {
            return response(['status' => 'success', 'data' => $address], 200);
        } else {
            return response(['status' => 'info', 'message' => 'Nenhum endereço cadastrado!'], 200);
        }
    }

    /**
     * Método secundário para buscar o endereço pelo CEP
     */
    function viaCEP($cep) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "viacep.com.br/ws/$cep/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    /**
     * Método para retornar os endereços com o CEP informado
     */
    public function findByCep($cep) {

        if (strlen($cep) === 8) {

            $address = DB::select("SELECT * FROM addresses WHERE cep = $cep");

            if (sizeof($address) != 0) {
                return response(['status' => 'success', 'data' => $address], 200);
            } else {

                // Caso o endereço não esteja cadastrado localmente, procura no webservice da viaCEP
                $address = json_decode($this->viaCEP($cep));

                return response(['status' => 'success', 'data' => $address], 200);
            }
        } else {
            return response(["error" => "error", "message" => "CEP inválido! Por favor tente novamente."], 500);
        }
    }

    /**
     * Método para retornar os endereços com o CEP informado
     */

    public function find(Request $request) {
        $addressName = $request['endereco'];

        $address = DB::select("SELECT * FROM addresses WHERE endereco like '%$addressName%'");

        if (sizeof($address) != 0) {
            return response(['status' => 'success', 'data' => $address], 200);
        } else {
            return response(['status' => 'info', 'message' => 'Nenhum endereço encontrado!'], 200);
        }
    }

    /**
     * Método para cadastro de endereço
     */
    public function new(Request $request) {

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
    public function update(Request $request, $id) {

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
    public function remove(Address $address, $id) {

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
