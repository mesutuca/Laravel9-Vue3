<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $controll = Post::find($request->post_id);
        $store = '/storage/post/' . $controll->slug . '/';
        $postImages = $this->uploadFiles($controll->slug, $request);
        $getAllData = [];
        foreach ($postImages as $postImage) {

            list($fileName, $title) = $postImage;
            $postImage = new PostImage();
            $postImage->title = $title;
            $postImage->file_name = $fileName;
            $postImage->status = 'on';
            $postImage->post_id = $request->post_id;
            $postImage->save();
            $getAllData[] = [
                'id' => $postImage->id,
                'title' => $postImage->title,
                'status' => $postImage->status,
                'src' => $store . $postImage->file_name
            ];

        }
        return response()->json($getAllData);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PostImage $postImage
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = PostImage::where('post_id', $id)->get();
        $controll = Post::find($id);
        $store = '/storage/post/' . $controll->slug . '/images/';

        $getAllData = [];
        if ($data) {
            foreach ($data as $item) {
                $getAllData[] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'status' => $item->status,
                    'src' => $store . $item->file_name
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
        $Post_id = Post::find($Image->post_id);
        $store = '/storage/post/' . $Post_id->slug . '/images/';
        $image_path = public_path() . $store . $Image->file_name;
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

    protected function uploadFile($slug, $image)
    {
        $originalFileName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
        $fileName = Str::slug($fileNameOnly) . "-" . time() . "." . $extension;

        $image->storeAs('post/' . $slug . '/images/', $fileName, 'public');
//        $uploadedFileName = $image->storeAs('post/' . $slug . '/images/', $fileName, 'public');
        return [$fileName, $fileNameOnly];
    }
}
