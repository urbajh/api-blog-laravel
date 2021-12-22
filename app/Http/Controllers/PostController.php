<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Valdidation\ValidationException;

class PostController extends Controller
{
    public function index()
    {
        //en vez de retornar el modelo, retornaremos el resource
        //return Post::all();
        return PostResource::collection(Post::all());
    }
    public function store(Request $request)
    {
        if($request->ajax()){
            try{
                //validations
                $this->validate($request,[
                    'title' => 'required|string|max:255',
                    'description' => 'required|string|max:255',
                    'content' => 'required|string',
                    'category' => 'required|integer',
                    'published' => 'required|boolean',
                    'tags' => 'required',
                ]);

                //slug
                $slug = preg_replace('/[^A-Za-z0-9]+/','-',$request->title);
                $slug = strtolower($slug);

                //Save fields
                $post = new Post;
                $post->user_id = 3;
                $post->title = $request->title;
                $post->slug = $slug;
                $post->description = $request->description;
                $post->content = $request->content;
                $post->category_id = $request->category;
                $post->published = $request-> published;
                $post->save();

                //save tags
                $tags = explode(',', $request->tags); 
                $post->tags()->sync($tags);// attach x sync 
                //$post->tags = $tags;
                return response()->json([
                    'message' => 'Ok',
                    'post' => new PostResource($post)
                ]);

            }catch(ValidationException $error){
                return response()->json(
                    $error->validator->errors()
                );
            }
        }
    }

    public function show(Post $post)
    {
         return new PostResource(Post::findOrFail($post->id));
    }

    public function update(Request $request, Post $post)
    {
        if($request->ajax()){
            try{
                //validations
                $this->validate($request,[
                    'title' => 'required|string|max:255',
                    'description' => 'required|string|max:255',
                    'content' => 'required|string',
                    'category' => 'required|integer',
                    'published' => 'required|boolean',
                    'tags' => 'required',
                ]);

                //slug
                $slug = preg_replace('/[^A-Za-z0-9]+/','-',$request->title);
                $slug = strtolower($slug);

                //Save fields
                $post->user_id = 3;
                $post->title = $request->title;
                $post->slug = $slug;
                $post->description = $request->description;
                $post->content = $request->content;
                $post->category_id = $request->category;
                $post->published = $request-> published;
                $post->save();
                
                //save tags
                $tags = explode(',', $request->tags); 
                //$post->tags()->attach($tags);
                $post->tags()->sync($tags);
                //$post->tags = $tags;
                return response()->json([
                    'message' => 'Ok',
                    'post' => new PostResource($post)
                ]);

            }catch(ValidationException $error){
                return response()->json(
                    $error->validator->errors()
                );
            }
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'Message'=>'Ok',
            'Post'=> new PostResource($post)
        ]);
    }
}
