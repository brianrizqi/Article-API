<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryIndexResource;
use App\Http\Resources\CategoryShowResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $data = [
            'status' => true,
            'message' => 'All categories fetched successfully',
        ];
        return CategoryIndexResource::collection($categories)->additional($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $name = getAttribute($request, 'name');
        $slug = generate_slug($name);
        Category::create([
            'name' => $name,
            'slug' => $slug
        ]);
        return json_response(1, 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('slug', $id)->first();
        if (!$category) {
            return json_response(0, 'Category not found');
        }
        $data = [
            'status' => true,
            'message' => "$category->name fetched successfully",
        ];
        return CategoryShowResource::make($category)->additional($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return json_response(0, 'Category not found');
        }
        $name = getAttribute($request, "name");
        if (strtolower($category->name) != strtolower($name)) {
            $slug = generate_slug($name);
            $category->update([
                'name' => $name,
                'slug' => $slug
            ]);
        }
        return json_response(1, 'Category Updated Successfully', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('slug', $id)->first();
        if (!$category) {
            return json_response(0, 'Category not found');
        }
        $category->delete();
        return json_response(1, 'Category Deleted Successfully');
    }
}
