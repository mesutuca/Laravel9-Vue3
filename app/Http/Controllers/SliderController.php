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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($lang)
    {
        $data = Slider::where('language', $lang)->orderBy('order','ASC')->get();
        $getAllData = [];
        if ($data) {
            foreach ($data as $item) {
                $getAllData[] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'status' => $item->status,
                    'src' => $item->file_name,
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
            $postImage->file_name = $store . $fileName;
            $postImage->status = 'on';
            $postImage->order = '0';
            $postImage->language = $request->language;
            $postImage->save();
            $getAllData[] = [
                'id' => $postImage->id,
                'title' => $postImage->title,
                'status' => $postImage->status,
                'order' => $postImage->order,
                'language' => $postImage->language,
                'src' => $postImage->file_name
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
    public function show($id)
    {

        $data = Slider::find($id);
        $store = '/storage/slider/' . $data->language . '/';
        if ($data) {
            $getAllData = [
                'id' => $data->id,
                'title' => $data->title,
                'status' => $data->status,
                'image' => $data->file_name,
                'language' => $data->language,
                'order' => $data->order,
            ];
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
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        $testimonials = Slider::all();

        foreach ($testimonials as $testimonial) {
            $testimonial->timestamps = false;
            $id = $testimonial->id;
            foreach ($request->testimonials as $testimonialFrontEnd) {
                if ($testimonialFrontEnd['id'] == $id) {
                    $testimonial->update(['order' => $testimonialFrontEnd['order']]);
                }
            }
        }

        return response('Update Successful.', 200);
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
        $store = '/storage/slider/' . $request->language . '/';
        echo $data->file_name;
        echo "<br>";
        echo $request->image;
        exit();
        if ($data->file_name !== $request->image) {
            $folder_path = public_path() . $data->file_name;
            unlink($folder_path);

            return Slider::where('id', $id)->update([
                'title' => $request->title,
                'order' => $request->order,
                'language' => $request->language,
                'status' => $request->status,
                'file_name' => $store . $this->uploadFile($request->language, $request->image)[0],
            ]);

        }

        return Slider::where('id', $id)->update([
            'title' => $request->title,
            'order' => $request->order,
            'language' => $request->language,
            'status' => $request->status,
            'file_name' => $request->image,
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
        $image_path = public_path() . $Image->file_name;
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

    protected function uploadFiles($lang, $request)
    {
        $uploadedImages = [];
        if ($request->hasFile('file_name')) {
            $images = $request->file('file_name');
            foreach ($images as $image) {
                $uploadedImages[] = $this->uploadFile($lang, $image);
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
