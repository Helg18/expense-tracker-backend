<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\EloquentCategory;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    private $category;

    function __construct(EloquentCategory $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->category->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryUpdateRequest $request)
    {
        $attributes['category'] = $request->category;
        $this->category->create($attributes);
        return response()->json([
            'success' => true,
            'msg'=>'Categoria creada exitosamente',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->category->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryCreateRequest $request, $id)
    {
        $attributes['category'] = $request->category;
        $attributes['id'] = $request->id;
        $this->category->update($id, $attributes);
        return response()->json(['msg'=>'Categoria actualizada exitosamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->categoria->delete($id);
    }
}
