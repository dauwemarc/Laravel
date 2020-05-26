<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
    }


    public function index()
    {
        return view ('categories.index');
    }


    public function create()
    {
        return view ('categories.create');
    }


    public function store(CategoryRequest $request, CategoryRepository $repository)
    {
        $repository->store($request->all ());

        return redirect ()->route ('home')->with ('ok', __ ('La catégorie a bien été enregistrée'));
    }


    public function edit(Category $category)
    {
        return view ('categories.edit', compact ('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update ($request->all ());

        return redirect ()->route ('category.index')->with ('ok', __ ('La catégorie a bien été modifiée'));
    }


    public function destroy(Category $category)
    {
        $category->delete ();

        return response ()->json ();
    }
}
