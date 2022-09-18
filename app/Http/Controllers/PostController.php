<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        //create a vvariabole and store all the post from the database
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        //return a view pass in the above variabole
        return view('posts.index')->withPosts( $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate THe data
        $this->validate($request, array(
            'title' => 'required|max:250',
            'slug' => 'required|alpha_dash|min:5|max:250|unique:posts,slug',
            'category_id' => 'required|integer',  
            'body' => 'required',
            'featured_image' => 'sometimes|image'
        ));
        // store in database
        $post = new Post;
        
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;

        if($request->hasFile('featured_image')) {
            $image = $request-> file('featured_image');
            $filename = time().".".$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The Blog Post Was Succesfully Saved');
        //redirect to other page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        $categories = Category::all();

        return view('posts.show')->with('post', $post)->withCategories($categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the db and make a var
        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        

        foreach($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2= array();

        foreach($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        //return the view and pass in the var
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
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
        //validate the form 
        $post = Post::find($id);

            $this->validate($request, array(
                'title' => 'required|max:250',
                'slug' => "required|alpha_dash|min:5|max:250|unique:posts,slug,$id",
                'category_id' => 'required|integer',
                'body' => 'required',
                'featured_image' => 'image'
            ));
        
        
        //save the data to db
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');

        if($request->hasFile('featured_image')) {
            $image = $request-> file('featured_image');
            $filename = time().".".$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $oldFileName = $post->image;

            $post->image = $filename;

            Storage::delete($oldFileName);
        }

        $post->save();


        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }
        
        //set success message with falsh data
        Session::flash('success', 'This Post Was Successfuly Saved.');
        //redirect data with flash
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted');
        return redirect()->route('posts.index');
    }
}
