<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $store = '/storage/';
        /*
          $file_name = time() . '_' . $request->slug . '.' . $request->file('image')->getClientOriginalExtension();

                $type = $request->file('image')->move(public_path('uploads'), $file_name);
                print_r($type);
                exit();
         */
        if (!$categoryControll) {
            $post = new Categori();

            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->language = $request->language;
            $post->image = $store . $this->uploadFile($request->slug, $request->image);
            $post->save();

            return response()->json(['success' => 'File uploaded successfully.']);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Categori $categori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
        $data = Categori::find($id);

        return Categori::where('id', $id)->update([
            'status' => $request->status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Categori $categori
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $Image = Categori::find($id);

        $folder_path = public_path() . '/storage/' . $Image->slug;
        $delete_folter = File::deleteDirectory($folder_path);

        if ($delete_folter) {
            Categori::destroy($id);
            return response()->json([
                'message' => 'Fotoğraf Silindi'
            ]);
        }
        return null;
//        if (Storage::delete($data->filename)) {
//            $data->delete();
//        }
    }

    protected function uploadFile($slug, $image)
    {
        $originalFileName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
        $fileName = Str::slug($fileNameOnly) . "-" . time() . "." . $extension;

        $uploadedFileName = $image->storeAs($slug, $fileName, 'public');
        return $uploadedFileName;
    }
}
