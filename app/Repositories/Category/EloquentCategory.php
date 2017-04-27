<?php 

namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepository;
use App\Category;


/**
* Implementacion de la interface para aplicar el patron de repositorios
*/
class EloquentCategory implements CategoryRepository
{
	private $category;

	function __construct(Category $category) {
		$this->category = $category;
	}

	public function getAll(){
		return $this->category->all();
	}

	public function getById($id){
		return $this->category->find($id);
	}

	public function create(array $attributes){
		return $this->category->create($attributes);
	}

	public function update($id, array $attributes){
		$categoria = $this->category->find($id);
		$categoria->update($attributes);
		$categoria->save();
		return $categoria;
	}

	public function delete($id){
		$this->category->findorfail($id)->delete();
		return true;
	}
}