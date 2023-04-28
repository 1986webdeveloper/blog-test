<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {        
        // Retrieve all blog posts from the database, ordered by most recent first
        $blogs = Blog::where('user_id', \Auth::id())->latest()->paginate(10);  
        
        // Render the blog post index view, passing the retrieved blog posts as a variable
        return view('blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Render the blog post create view
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
         // Validate the request data
        $request->validate([
            'title' => 'required|max:255|unique:blogs,title',
            'body' => 'required',
            'file' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        // Store the uploaded image, if any
        if ($request->hasFile('file')) {
            $name = now()->timestamp.".{$request->file->getClientOriginalName()}";
            $path = $request->file->storeAs('blogs', $name, 'public');
            $request['image'] = $path;
        }

        // Save the new blog post to the database
        $blogs = Blog::create($request->all());
        if ($blogs) {
            session()->flash('success', 'Blog created successfully.');
            return response()->json(['status' => 'success', 'message' => 'Blog created successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog): View
    {
        // Render the blog post show view, passing the retrieved blog post as a variable
        return view('blogs.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog): View
    {
        // Render the blog post edit view, passing the retrieved blog post as a variable
        return view('blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): JsonResponse
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'file' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        
        // Store the uploaded image, if any
        if ($request->hasFile('file')) {
            $name = now()->timestamp.".{$request->file->getClientOriginalName()}";
            $path = $request->file->storeAs('blogs', $name, 'public');
            $request['image'] = $path;
        }
        
         // Update the blog post to the database
        $blogs = $blog->update($request->all());
        if ($blogs) {
            session()->flash('success', 'Blog updated successfully.');
            return response()->json(['status' => 'success', 'message' => 'Blog created successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();
         
        return redirect()->route('blogs.index')
                        ->with('success','Blog deleted successfully');
    }

    /**
     * Show the form for blog single page.
     */
    public function singlePage($id): View
    {
        $id = base64_decode($id);
        $blog = Blog::where('id',$id)->first();
        if(!$blog){
            abort(404);
        }
        
        return view('blog-single',compact('blog'));
    }

    /**
     * Check duplicate blog title.
     */
    public function hasDuplicateBlogTitle(Request $request): bool
    {
        $id = $request->id;
        $blog = Blog::where('title', $request->title);
        if($id != ''){
            $blog = $blog->where('id','!=',$id);
        }
        $blog = $blog->first();
        if($blog){
            return true;
        }else{
            return false;
        }
    }
}
