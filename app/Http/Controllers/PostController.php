<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
        $postControll = Post::where('slug', '=', $request->slug)->first();
        /*
          $file_name = time() . '_' . $request->slug . '.' . $request->file('image')->getClientOriginalExtension();

                $type = $request->file('image')->move(public_path('uploads'), $file_name);
                print_r($type);
                exit();
         */
        if (!$postControll) {
            $post = new Post;
            if ($request->file()) {

                $file_name = time() . '_' . $request->slug . '.' . $request->file('image')->getClientOriginalExtension();
                $file_path = $request->file('image')->storeAs($request->slug, $file_name, 'public');

                $post->title = $request->title;
                $post->slug = $request->slug;
                $post->categori_id = $request->cat_id;
                $post->image = '/storage/' . $file_path;
                $post->save();

                return response()->json(['success' => 'File uploaded successfully.']);
            }
        } else {
            return response()->json(['error' => 'slug record available'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public
    function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id;
//        $data = PostImage::find($id);
//
//        return PostImage::where('id', $id)->update([
//            'status' => $request->status
//        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Post $post)
    {
        //
    }
}
