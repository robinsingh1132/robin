<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShoppingController extends Controller
{
    public function index(){
        try{
            $products = Product::latest()->paginate(6);
                return view('shopping.list', compact('products'));
          }
          catch (\Exception $e) {
            dd($e->getMessage())->error();
            return redirect()->back();
          }
    }
    public function show($slug){
        try{
            $product = Product::where('slug', $slug)->firstOrFail();
                return view('shopping.show', compact('product'));
          }
          catch (\Exception $e) {
            dd($e->getMessage())->error();
            return redirect()->back();
          }
    }
    public function create(){
      try{
          $products = Product::all();
          return view('shopping.create', compact('products'));
      }
      catch (\Exception $e) {
          dd($e->getMessage())->error();
          return redirect()->back();
      }
  }
  public function save(Request $request){
      try{
          $products = new Product();

          $products->name = $request->input('name');
          $products->slug = $request->input('slug');
          $products->details = $request->input('details');
          $products->price = $request->input('price');
          $products->description = $request->input('description');
                        
            if($request->hasfile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/images', $filename);
                $products->image = $filename;
            }else {
                return $request;
                $products->image = '';
            }
            $products->save();
    
        return redirect()->route('create-product')->with('success','Product has created Successfully');
      }
      catch (\Exception $e) {
        dd($e->getMessage())->error();
        return redirect()->back();
      }
  }

    public function edit($id){
      try{
      $products = Product::find($id);
      return view('shopping.edit', compact('products', 'id'));
    }
    catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
    }
    }
    public function update(Request $request, $id)
    {
      try{
        $products = Product::find($id);

        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->details = $request->input('details');
        $products->price = $request->input('price');
        $products->description = $request->input('description');
                      
          if($request->hasfile('image')){
              $file = $request->file('image');
              $extension = $file->getClientOriginalExtension();
              $filename = time() . '.' . $extension;
              $file->move('uploads/images', $filename);
              $products->image = $filename;
          }

          $products->save();
          return redirect()->route('product-list')->with('success','Product has Updated Successfully');
      } 
      catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
      }
    } 
    public function view($id){
      try{
      $product = Product::find($id);
      return view('shopping.view', compact('product'));
      }
      catch (\Exception $e) {
        dd($e->getMessage())->error();
        return redirect()->back();
      }
    } 
    public function search(Request $request){
      try{
      $search = $request->get('search');
      $products =  Product::where('name' , 'like', '%'.$search.'%')->paginate(5);
      return view('shopping.list', compact('products'));
      }
      catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
      }
    }
    public function destroy($id)
    {   
      try{
        Product::where('id','=',$id)->delete();
        return redirect()->route('product-list')->with('success','Product has Deleted Successfully');
      }
      catch (\Exception $e) {
        dd($e->getMessage())->error();
        return redirect()->back();
      }
    }
}