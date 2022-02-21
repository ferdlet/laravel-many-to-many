<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    protected $validationRule = [
        "title" => "required|string|max:100",
        "content" => "required",
        "published" => "sometimes|accepted",
        'category_id' => 'nullable|exists:categories,id',
        "tags" => "nullable|exists:tags,id",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate($this->validationRule);
        
        $data = $request->all();

        $newPost = new Post();
        $newPost->fill($data);
        $newPost->published = isset($data['published']);
        
        $newPost->slug = $this->getSlug($newPost->title);

        $newPost->save();

        if (isset($data["tags"])) {
            $newPost->tags()->sync($data["tags"]);
        }

        return redirect()->route("posts.show", $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.edit", compact("post", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationRule);


        $data = $request->all();

        if($post->title != $data['title']) {
            $post->title = $data['title'];
            $slug = Str::of($post->title)->slug("-");
            if ($slug != $post->slug) {
                $post->slug = $this->getSlug($post->title);
            }
        }
        $post->fill($data);
        $post->published = isset($data["published"]);

        $post->save();

        if (isset($data["tags"])) {
            $post->tags()->sync($data["tags"]);
        }

        return redirect()->route("posts.show", $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route("posts.index");
    }
    
    /**
     * getSlug
     *
     * @param  mixed $title
     * @return void
     */
    private function getSlug($title) 
    {
        $slug = Str::of($title)->slug("-");
        $count = 1;
        while (Post::where("slug", $slug)->first()) {
            $slug = Str::of($title)->slug("-") . "-{$count}";
            $count++;
        }
        return $slug;
    }
}
