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
    //
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
      'name' => 'required|max:255',
      'image' => 'required|mimes:jpg,jpeg,png|max:2048'
    ]);
    $post = new Post;

    if ($request->file()) {

      $file_name = time() . '_' . $request->file('image')->getClientOriginalName();
      $file_path = $request->file('image')->storeAs('avatars', $file_name, 'public');

      $post->name = $request->name;
      $post->image = '/storage/' . $file_path;
      $post->save();

      return response()->json(['success' => 'File uploaded successfully.']);
    }

  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Post $post
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Post $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
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
  public function update(Request $request, Post $post)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Post $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    //
  }
}
