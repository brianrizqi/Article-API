<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleIndexResource;
use App\Http\Resources\ArticleShowResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::query();
        if ($request->has('category')) {
            $category = $request->category;
            $articles = $articles->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }
        $articles = $articles->get();
        $data = [
            'status' => true,
            'message' => 'All article fetched successfully',
        ];
        return ArticleIndexResource::collection($articles)->additional($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleStoreRequest $request)
    {
        $title = getAttribute($request, 'title');
        $content = getAttribute($request, 'content');
        $description = getAttribute($request, 'description');
        $category_id = getAttribute($request, 'category_id');
        $slug = generate_slug($title, 'article');
        Article::create([
            'category_id' => $category_id,
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'content' => $content
        ]);
        return json_response(1, 'Article Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::where('slug', $id)->first();
        if (!$article) {
            return json_response(0, 'Article not found', [], 404);
        }
        $data = [
            'status' => true,
            'message' => "$article->name fetched successfully",
        ];
        return ArticleShowResource::make($article)->additional($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::where('slug', $id)->first();
        if (!$article) {
            return json_response(0, 'Article not found', [], 404);
        }
        $title = getAttribute($request, 'title');
        $content = getAttribute($request, 'content');
        $description = getAttribute($request, 'description');
        $category_id = getAttribute($request, 'category_id');
        $slug = generate_slug($title, 'article');
        if (strtolower($title) != strtolower($article->title)) {
            $article->update([
                'title' => $title,
                'slug' => $slug,
            ]);
        }
        $article->update([
            'category_id' => $category_id,
            'description' => $description,
            'content' => $content
        ]);
        return json_response(1, 'Article Updated Successfully', $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::where('slug', $id)->first();
        if (!$article) {
            return json_response(0, 'Article not found');
        }
        $article->delete();
        return json_response(1, 'Article Deleted Successfully');
    }
}
