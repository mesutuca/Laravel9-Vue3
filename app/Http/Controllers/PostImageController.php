<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $getAllData = [];
        $images = PostImage::latest()->get();
        foreach ($images as $image) {
            $getAllData[] = [
                'id' => $image->id,
                'title' => $image->title,
                'status' => $image->status,
                'src' => $image->src
            ];
        }
        return response()->json($getAllData);
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
            'file_name.*' => 'image|mimes:jpg,jpeg,png',
        ]);

        $postImages = $this->uploadFiles($request);
        $getAllData = [];
        foreach ($postImages as $postImage) {

            list($fileName, $title) = $postImage;
            $postImage = new PostImage();
            $postImage->title = $title;
            $postImage->file_name = $fileName;
            $postImage->status = 'on';
            $postImage->save();
            $getAllData[] = [
                'id' => $postImage->id,
                'title' => $postImage->title,
                'status' => $postImage->status,
                'src' => $postImage->src
            ];

        }
        return response()->json($getAllData);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PostImage $postImage
     * @return \Illuminate\Http\Response
     */
    public function show(PostImage $postImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PostImage $postImage
     * @return \Illuminate\Http\Response
     */
    public function edit(PostImage $postImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PostImage $postImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = PostImage::find($id);

        return PostImage::where('id', $id)->update([
            'status' => $request->status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PostImage $postImage
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $Image = PostImage::find($id);
        $image_path = public_path() . '/' . $Image->src;
        $deleteImage = unlink($image_path);
        if ($deleteImage) {
            PostImage::destroy($id);
            return response()->json([
                'message' => 'Fotoğraf Silindi'
            ]);
        }
        return null;
        // if(Storage::delete($data->filename)) {
        //     $data->delete();
        //  }

    }

    protected function uploadFiles($request)
    {
        $uploadedImages = [];
        if ($request->hasFile('file_name')) {
            $images = $request->file('file_name');
            foreach ($images as $image) {
                $uploadedImages[] = $this->uploadFile($image);
            }
        }
        return $uploadedImages;
    }

    protected function uploadFile($image)
    {
        $originalFileName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
        $fileName = Str::slug($fileNameOnly) . "-" . time() . "." . $extension;

        $uploadedFileName = $image->storeAs('public', $fileName);
        return [$uploadedFileName, $fileNameOnly];
    }
}
