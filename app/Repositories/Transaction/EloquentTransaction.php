<?php 

namespace App\Repositories\Transaction;

use App\Repositories\Transaction\TransactionRepository;
use App\Transaction;


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
		return $this->transaction->all();
	}

	public function getById($id){
		return $this->transaction->find($id);
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
		//return false;
	}
}

