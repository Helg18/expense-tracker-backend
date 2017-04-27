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
        $allCategories = $this->category->getAll();
        return response()->json($allCategories, 200);
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
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specificCategory =  $this->category->getById($id);
        return response()->json($specificCategory, 200);
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
        return response()->json(['msg'=>'Categoria actualizada exitosamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->delete($id);
        return response()->json(['msg'=>'Categoria eliminada exitosamente'], 200);
    }
}
