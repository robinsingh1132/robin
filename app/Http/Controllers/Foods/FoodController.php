<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;

class FoodController extends Controller
{
    public function create(){
        try{
            $foods = Food::all();
            return view('foods.create', compact('foods'));
        }
        catch (\Exception $e) {
            dd($e->getMessage())->error();
            return redirect()->back();
        }
    }
    public function save(Request $request){
        try{
            $foods = new Food();

            $foods->name = $request->input('name');
            $foods->price = $request->input('price');
            $foods->description = $request->input('description');
                          
              if($request->hasfile('image')){
                  $file = $request->file('image');
                  $extension = $file->getClientOriginalExtension();
                  $filename = time() . '.' . $extension;
                  $file->move('uploads/images', $filename);
                  $foods->image = $filename;
              }else {
                  return $request;
                  $foods->image = '';
              }
              $foods->save();
      
          return redirect()->route('create-food')->with('success','Food Item Inserted Successfully');
        }
        catch (\Exception $e) {
          dd($e->getMessage())->error();
          return redirect()->back();
        }
    }
    public function list(){
        try{
            $foods = Food::latest()->paginate(5);
                return view('foods.list', compact('foods'));
          }
          catch (\Exception $e) {
            dd($e->getMessage())->error();
            return redirect()->back();
          }
    }
    public function buy($id){
        try{
        $orders = Food::find($id);
        return view('foods.view', compact('orders', 'id'));
      }
      catch (\Exception $e) {
        dd($e->getMessage())->error();
        return redirect()->back();
      }
    } 
    public function order(Request $request){
        try{
          // dd($request->all());
            $orders = Order::create([
              'price' => $request->hdn_product_price,
              'quantity' => $request->quantity,
              'total' => $request->hdn_total_price,
              'f_id' => $request->f_id,
              'user_id' => \Auth::user()->id,         
          ]);
          
      
          return redirect()->back()->with('success','Order Created Successfully');
        }
        catch (\Exception $e) {
          dd($e->getMessage())->error();
          return redirect()->back();
        }

    }
    public function viewOrder(){
      try{
          $orders = Order::latest()->paginate(5);
              return view('foods.view-order', compact('orders'));
        }
        catch (\Exception $e) {
          dd($e->getMessage())->error();
          return redirect()->back();

        }
    }
    public function search(Request $request){
      try{
      $search = $request->get('search');
      $foods =  Food::where('name' , 'like', '%'.$search.'%')->paginate(5);
      return view('foods.list', compact('foods'));
      }
      catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
      }
    }
    public function destroy($id)
    {
      try{
        Food::find($id)->delete();
        return redirect()->route('food-list')->with('success','Food Item Deleted Successfully');
    }
    catch (\Exception $e) {
      dd($e->getMessage())->error();
      return redirect()->back();
    }
  } 
  public function edit($id){
    try{
    $foods = Food::find($id);
    return view('foods.edit', compact('foods', 'id'));
  }
  catch (\Exception $e) {
    dd($e->getMessage())->error();
    return redirect()->back();
  }
}
public function update(Request $request, $id)
{
  try{
    $foods = Food::find($id);

    $foods->name = $request->input('name');
    $foods->price = $request->input('price');
    $foods->description = $request->input('description');
                  
      if($request->hasfile('image')){
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . '.' . $extension;
          $file->move('uploads/images', $filename);
          $foods->image = $filename;
      }

      $foods->save();
      return redirect()->route('food-list')->with('success','Food Item Updated Successfully');
  } 
  catch (\Exception $e) {
  dd($e->getMessage())->error();
  return redirect()->back();
  }
} 
}
