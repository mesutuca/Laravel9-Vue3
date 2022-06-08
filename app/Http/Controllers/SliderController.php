<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
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
            'language' => 'required',
            'file_name.*' => 'image|mimes:jpg,jpeg,png',
        ]);
        $store = '/storage/slider/' . $request->language . '/';
        $postImages = $this->uploadFiles($request->language, $request);
        $getAllData = [];
        foreach ($postImages as $postImage) {

            list($fileName, $title) = $postImage;
            $postImage = new Slider();
            $postImage->title = $title;
            $postImage->file_name = $fileName;
            $postImage->status = 'on';
            $postImage->language = $request->language;
            $postImage->save();
            $getAllData[] = [
                'id' => $postImage->id,
                'title' => $postImage->title,
                'status' => $postImage->status,
                'order' => $postImage->order,
                'language' => $postImage->language,
                'src' => $store . $postImage->file_name
            ];
        }
        return response()->json($getAllData);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($lang)
    {
        $data = Slider::where('language', $lang)->get();
        $store = '/storage/slider/' . $lang . '/';
        $getAllData = [];
        if ($data) {
            foreach ($data as $item) {
                $getAllData[] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'status' => $item->status,
                    'src' => $store . $item->file_name,
                    'language' => $item->language,
                    'order' => $item->order,
                ];
            }
            return response()->json($getAllData);
        }
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Slider::find($id);
        $store = '/storage/';
        if ($data->file_name !== $request->file_name) {
            $folder_path = public_path() . $data->file_name;
            $ee = unlink($folder_path);
            dd($ee);

            /*return Slider::where('id', $id)->update([
                'title' => $request->title,
                'file_name' => $request->file_name,
                'order' => $request->order,
                'language' => $request->language,
                'status' => $request->status,
                'image' => $store . $this->uploadFile($request->slug, $request->image),
            ]);*/

        }

        return Slider::where('id', $id)->update([
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
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $Image = Slider::find($id);
        $store = '/storage/slider/' . $Image->language . '/';
        $image_path = public_path() . $store . $Image->file_name;
        $deleteImage = unlink($image_path);
        if ($deleteImage) {
            Slider::destroy($id);
            return response()->json([
                'message' => 'Fotoğraf Silindi'
            ]);
        }
        return null;
        // if(Storage::delete($data->filename)) {
        //     $data->delete();
        //  }
    }

    protected function uploadFiles($slug, $request)
    {
        $uploadedImages = [];
        if ($request->hasFile('file_name')) {
            $images = $request->file('file_name');
            foreach ($images as $image) {
                $uploadedImages[] = $this->uploadFile($slug, $image);
            }
        }
        return $uploadedImages;
    }

    protected function uploadFile($lang, $image)
    {
        $originalFileName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
        $fileName = Str::slug($fileNameOnly) . "-" . time() . "." . $extension;

        $image->storeAs('slider/' . $lang . '/', $fileName, 'public');
//        $uploadedFileName = $image->storeAs('post/' . $slug . '/images/', $fileName, 'public');
        return [$fileName, $fileNameOnly];
    }
}
