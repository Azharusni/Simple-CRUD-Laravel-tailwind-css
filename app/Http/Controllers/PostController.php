<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');


    }
    public function index()
    {
        $posts = Post::latest()->when(request()->search, function($posts) {
            $posts = $posts->where('title', 'like', '%'. request()->search . '%');
        })->paginate(5);

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:png,jpg,jpeg',
            'title'     => 'required',
            'content'   => 'required'
         ]);

         //upload image
         $image = $request->file('image');
         $image->storeAs('public/posts', $image->hashName());

         $post = Post::create([
             'image'     => $image->hashName(),
             'title'     => $request->title,
             'content'   => $request->content
         ]);

         if($post){
           //redirect dengan pesan sukses
           return redirect()->route('post.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
           //redirect dengan pesan error
           return redirect()->route('post.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        dump($post);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required'
        ]);

        //get data post by ID
        $post = Post::findOrFail($id);

        if($request->file('image') == "") {

           $post->update([
               'title'     => $request->title,
               'content'   => $request->content
           ]);

        } else {

            //hapus old image
            Storage::disk('local')->delete('public/posts/'.$post->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $post->update([
               'image'     => $image->hashName(),
               'title'     => $request->title,
               'content'   => $request->content
            ]);

        }

        if($post){
           //redirect dengan pesan sukses
           return redirect()->route('post.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
           //redirect dengan pesan error
           return redirect()->route('post.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Storage::disk('local')->delete('public/posts/'.$post->image);
        $post->delete();

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('post.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('post.index')->with(['error' => 'Data Gagal Dihapus!']);
  }
    }
}
