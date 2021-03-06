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
            $post->status = 'on';
            $post->image = $store . $this->uploadFile($request->slug, $request->image);
            $post->save();

            return response()->json([
                'data' => $post,
                'success' => 'File uploaded successfully.']);
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
        $data = Categori::find($id);
        $store = '/storage/';

        if ($data->image !== $request->image) {
            $folder_path = public_path() . $data->image;
            unlink($folder_path);

            return Categori::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'language' => $request->language,
                'image' => $store . $this->uploadFile($request->slug, $request->image),
                'status' => $request->status,
            ]);

        }
        if ($data->slug !== $request->slug) {
            $controller = Categori::where('slug', '=', $request->slug)->first();
            if (!$controller) {
                Storage::move('public/categori/' . $data->slug, 'public/categori/' . $request->slug);
                $newImage = explode('/', $data->image);
                $newIm = $store . 'categori/' . $request->slug . '/' . $newImage[4];
                return Categori::where('id', $id)->update([
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'language' => $request->language,
                    'image' => $newIm,
                    'status' => $request->status,
                ]);
            } else {
                echo "bu kategori ad??nda bir sayfa mevcut";
            }
        }

        return Categori::where('id', $id)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'language' => $request->language,
            'image' => $request->image,
            'status' => $request->status,
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

        $folder_path = public_path() . '/storage/categori/' . $Image->slug;

        $delete_folter = File::deleteDirectory($folder_path);

        if ($delete_folter) {
            Categori::destroy($id);
            return response()->json([
                'message' => 'Foto??raf Silindi'
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

        return $image->storeAs('categori/' . $slug, $fileName, 'public');
    }
}
