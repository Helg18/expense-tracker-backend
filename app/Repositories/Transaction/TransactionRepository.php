<?php 

namespace App\Repositories\Transaction;

/**
* interface de transactions
*/
interface TransactionRepository
{

	public function getAll();

	public function getById( $id );

	public function create( array $attributes );

	public function update( $id, array $attributes );

	public function delete( $id );

	public function lastdays( $days );

	public function depositTotal( );

	public function withdrawalTotal( );
}