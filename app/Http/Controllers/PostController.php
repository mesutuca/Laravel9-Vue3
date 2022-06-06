<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $store = '/storage/';
        /*
          $file_name = time() . '_' . $request->slug . '.' . $request->file('image')->getClientOriginalExtension();

                $type = $request->file('image')->move(public_path('uploads'), $file_name);
                print_r($type);
                exit();
         */
        if (!$postControll) {
            $post = new Post;
            if ($request->file()) {
                /*
                $file_name = time() . '_' . $request->slug . '.' . $request->file('image')->getClientOriginalExtension();
                $file_path = $request->file('image')->storeAs($request->slug, $file_name, 'public');
*/
                $post->title = $request->title;
                $post->slug = $request->slug;
                $post->categori_id = $request->cat_id;
                $post->status = 'on';
                $post->image = $store . $this->uploadFile($request->slug, $request->image);
                $post->save();

                return response()->json([
                    'data' => $post,
                    'success' => 'File uploaded successfully.']);
            }
        } else {
            return response()->json(['error' => 'slug record available'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::find($id);
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
        $data = Post::find($id);
        $store = '/storage/';

        if ($data->image !== $request->image) {
            $folder_path = public_path() . $data->image;
            unlink($folder_path);

            return Post::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'language' => $request->language,
                'image' => $store . $this->uploadFile($request->slug, $request->image),
                'status' => $request->status,
            ]);

        }
        if ($data->slug !== $request->slug) {
            $controller = Post::where('slug', '=', $request->slug)->first();
            if (!$controller) {
                Storage::move('public/post/' . $data->slug, 'public/post/' . $request->slug);
                $newImage = explode('/', $data->image);

                $newIm = $store . 'post/' . $request->slug . '/' . $newImage[4];
                return Post::where('id', $id)->update([
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'language' => $request->language,
                    'image' => $newIm,
                    'status' => $request->status,
                ]);
            } else {
                echo "bu kategori adında bir sayfa mevcut";
            }
        }

        return Post::where('id', $id)->update([
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
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $Image = Post::find($id);

        $folder_path = public_path() . '/storage/post/' . $Image->slug;
        $delete_folter = File::deleteDirectory($folder_path);

        if ($delete_folter) {
            Post::destroy($id);

            return response()->json([
                'message' => 'Fotoğraf Silindi'
            ]);
        }
        return null;
    }

    protected function uploadFile($slug, $image)
    {
        $originalFileName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
        $fileName = Str::slug($fileNameOnly) . "-" . time() . "." . $extension;

        return $image->storeAs('post/' . $slug, $fileName, 'public');
    }
}
