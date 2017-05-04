<?php 

namespace App\Repositories\Transaction;

use App\Repositories\Transaction\TransactionRepository;
use App\Transaction;
use Carbon\Carbon;

/**
* Implementacion de la interface para fungir como repositorio
*/
class EloquentTransaction implements TransactionRepository
{
	private $transaction;

	function __construct(Transaction $transaction){
		$this->transaction = $transaction;
	}

	public function getAll(){
		$res = $this->transaction->all();
		$data = [];
		foreach($res as $c){
			$item["id"]           = $c->id;
			$item["subject"]      = $c->subject;
			$item["amount"]       = $c->amount;
			$item["tot"]          = $c->tot;
			$item["category_id"]  = $c->category_id;
			$item["category"]     = $c->category->category;
			$item["fecha_creado"] = $c->fecha_creado;
			$item["created_at"]   = $c->created_at->toDateTimeString();
			$item["updated_at"]   = $c->created_at->toDateTimeString();
			$data[]               = $item;
		}
		return response()->json($data); 
	}

	public function getById($id){
		$res = $this->transaction->find($id);
		$data = [];
		$item["id"]           = $res->id;
		$item["subject"]      = $res->subject;
		$item["amount"]       = $res->amount;
		$item["tot"]          = $res->tot;
		$item["category_id"]  = $res->category_id;
		$item["category"]     = $res->category->category;
		$item["fecha_creado"] = $res->fecha_creado;
		$item["created_at"]   = $res->created_at->toDateTimeString();
		$item["updated_at"]   = $res->created_at->toDateTimeString();
		$data[] = $item;
		return response()->json($data);
	}

	public function create( array $attributes ){
		return $this->transaction->create($attributes);
	}

	public function update($id, array $attributes){
		$trans = $this->transaction->find($id);
		$trans->update($attributes);
		$trans->save();
		return $trans;
	}

	public function delete($id){
		$this->transaction->findorfail($id)->delete();
		return true;
	}

	public function lastdays( $days ){
		$date = Carbon::now();
		$date->subDays($days);
		$res = Transaction::where('fecha_creado', '>', $date->toDateTimeString() )->get();

		$data = [];
		foreach($res as $c){
			$item["id"] = $c->id;
			$item["subject"] = $c->subject;
			$item["amount"] = $c->amount;
			$item["tot"] = $c->tot;
			$item["category_id"] = $c->category_id;
			$item["category"] = $c->category->category;
			$item["fecha_creado"] = $c->fecha_creado;
			$item["created_at"] = $c->created_at->toDateTimeString();
			$item["updated_at"] = $c->created_at->toDateTimeString();
			$data[] = $item;
		}
		return response()->json($data);
	}

	public function depositTotal()
	{
		$deposits = $this->transaction->where('tot', '=', 'deposit')->get();
		return $deposits->sum('amount');
	}


	public function withdrawalTotal(){
		$withdrawal = $this->transaction->where('tot', '=', 'withdrawal')->get();
		return $withdrawal->sum('amount');
	}

}

