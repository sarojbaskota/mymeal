<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Rules;
use App\Meal;
class MealTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::select('id','title','created_at')->get();
        return view('meal-type.index',compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //    return "hello";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Rules $request)
    {
       Meal::create($request->all()); 
       return response()->json([
           'status' => 'Saved Successfully !!',
           ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal = Meal::select('title','created_at')->where('id',$id)->get();
        return view('meal-type.show',compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = Meal::select('title')->where('id',$id)->first();
        return response()->json([
            'meal' => $meal
            ]); 
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
        $validator = \Validator::make($request->all(), [
            'title' => 'regex:/^[a-zA-Z ]+$/u|required|string|unique:meals,title,'.$id,
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }
        $meal = Meal::findOrFail($id);
        $meal->update($request->all());
        return response()->json([
            'status' => 'Updated Successfully !!'
            ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal = Meal::findOrFail($id)->delete();
        return response()->json([
            'status' => 'Deleted Successfully !!'
            ]); 
    }
}
