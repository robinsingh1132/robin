<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grocery;
use Response;

class GroceryController extends Controller
{
    public function index()
    {
        $grocery = Grocery::all();
        return view('grocery')->with(compact('grocery'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required', 
        ]);
        $grocery = Grocery::create($data);

        return Response::json($grocery);
    }

}