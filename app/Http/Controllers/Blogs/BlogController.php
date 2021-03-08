<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use DB;

class BlogController extends Controller
{
  public function index(){
    try{
      return view('welcome');
    }
    catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
  }
  }
  public function dashboard(){
    try{
      return view('blogs.create');
    }
    catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
  }
  }
    public function create(){
        try{
            $blogs = Blog::all();
            return view('blogs.create', compact('blogs'));
        }
        catch (\Exception $e) {
            dd($e->getMessage())->error();
            return redirect()->back();
        }
    }
    public function save(Request $request){
        try{
            $blogs = Blog::create([
              'title' => $request->title,
              'description' => $request->description,
              'publication_date' => $request->publication_date,
          ]);
      
          return redirect()->route('create-blog')->with('success','Blog Created Successfully');
        }
        catch (\Exception $e) {
          dd($e->getMessage())->error();
          return redirect()->back();
        }

    }
    public function list(){
        try{
            $blogs = Blog::latest()->paginate(4);
                return view('blogs.list', compact('blogs'));
          }
          catch (\Exception $e) {
            dd($e->getMessage())->error();
            return redirect()->back();
          }
    }
    public function view($id){
        try{
        $blogs = Blog::find($id);
        return view('blogs.view', compact('blogs'));
      }
      catch (\Exception $e) {
        dd($e->getMessage())->error();
        return redirect()->back();
      }
    } 
    public function edit($id){
        try{
        $blogs = Blog::find($id);
        return view('blogs.edit', compact('blogs', 'id'));
      }
      catch (\Exception $e) {
        dd($e->getMessage())->error();
        return redirect()->back();
      }
    }
    public function update(Request $request, $id)
    {
      try{
      $blogs = Blog::find($id);

      $blogs->title = $request->get('title');
      $blogs->description = $request->get('description');
      $blogs->publication_date = $request->get('publication_date');
      $blogs->save();
      return redirect()->route('blog-list')->with('success','Blog Updated Successfully');
    } 
    catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
    }
  } 
  public function destroy($id)
    {
      try{
        Blog::find($id)->delete();
        return redirect()->route('blog-list')->with('success','Blog Deleted Successfully');
    }
    catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
    }
  } 
  public function search(Request $request){
    try{
      // $string = $request->get('search');
      // $field = ['title','description','publication_date'];
      // $name = DB::Table('blogs')->Where(function ($query) use($string, $field) {
      //        for ($i = 0; $i < count($field); $i++){
      //           $query->orwhere($field, 'like',  '%' . $string .'%');
      //        }      
      //   })->get();

    $search = $request->get('search');
    $blogs =  Blog::where('title' , 'like', '%'.$search.'%')->paginate(4);
    return view('blogs.list', compact('blogs'));
    }
    catch (\Exception $e) {
    dd($e->getMessage())->error();
    return redirect()->back();
    }
  }  
}
