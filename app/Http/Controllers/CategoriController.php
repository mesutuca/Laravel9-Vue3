<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Categori::all();
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
            'image' => 'required|mimes:jpg,jpeg,png|max:8192',
            'language' => 'required'
        ]);
        $categoryControll = Categori::where('slug', '=', $request->slug)->first();
        /*
          $file_name = time() . '_' . $request->slug . '.' . $request->file('image')->getClientOriginalExtension();

                $type = $request->file('image')->move(public_path('uploads'), $file_name);
                print_r($type);
                exit();
         */
        if (!$categoryControll) {
            $post = new Categori();
            if ($request->file()) {

                $file_name = time() . '_' . $request->slug . '.' . $request->file('image')->getClientOriginalExtension();
                $file_path = $request->file('image')->storeAs($request->slug, $file_name, 'public');

                $post->title = $request->title;
                $post->slug = $request->slug;
                $post->language = $request->language;
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
     * @param \App\Models\Categori $categori
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = Categori::find($id);
        if ($data) {
            return response()->json($data);
        }
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Categori $categori
     * @return \Illuminate\Http\Response
     */
    public function edit(Categori $categori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Categori $categori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categori $categori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Categori $categori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categori $categori)
    {
        //
    }
}
