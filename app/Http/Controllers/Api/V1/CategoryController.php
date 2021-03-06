<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return new CategoryCollection(Category::paginate(10));
    }

    public function store(CategoryStoreRequest $request)
    {
        if ($request->user()->cannot('create')) {
            return response(['message' => 'not authorized'], 403);
        }

        $validated = $request->validated();

        return Category::create($validated);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($request->user()->cannot('update', $category)) {
            return response(['message' => 'not authorized'], 403);
        }

        $validated = $request->validated();

        return $category->update($validated);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if (auth()->user()->cannot('delete', $category)) {
            return response(['message' => 'not authorized'], 403);
        }

        return $category->delete();
    }
}
