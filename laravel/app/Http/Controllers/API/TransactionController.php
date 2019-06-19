<?php

namespace App\Http\Controllers\API;


use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\Validator;

class TransactionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();
        return $this->sendResponse($transaction->toArray(), "Sucesso!");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'id_user' => 'required',
            'id_category' => 'required',
            'value' => 'required',
            'type' => 'required',
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validação Error.', $validator->errors());
        }


        $transaction = Transaction::create($input);


        return $this->sendResponse($transaction->toArray(), 'Transação criada com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (is_null($transaction)) {
            return $this->sendError('Transação não encontrada.');
        }


        return $this->sendResponse($transaction->toArray(), 'Transação entregue com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'id_user' => 'required',
            'id_category' => 'required',
            'value' => 'required',
            'type' => 'required',
            'date' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $transaction = Transaction::find($id);
        $transaction->id_user = $input['id_user'];
        $transaction->id_category = $input['id_category'];
        $transaction->value = $input['value'];
        $transaction->type = $input['type'];
        $transaction->date = $input['date'];
        $transaction->save();


        return $this->sendResponse($transaction->toArray(), 'Transação updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return $this->sendResponse($transaction->toArray(), 'transaction deleted successfully.');
    }
}
