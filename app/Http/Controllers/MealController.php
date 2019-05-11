<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Meal;
use App\Restaurant;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Expense::select('expenses.id','expenses.restaurant_id','expenses.meal_id','expenses.date','expenses.price','expenses.payment','expenses.remarks','expenses.created_at','meals.title','restaurants.restaurant_name')
        ->leftJoin('meals','meals.id','=','expenses.meal_id')
        ->leftJoin('restaurants','restaurants.id','=','expenses.restaurant_id') 
        ->orderBy('expenses.date', 'desc')->get();
        $meal_types = Meal::select('id','title')->get();
        $restaurants = Restaurant::select('id','restaurant_name')->get();
        return view('expenses.index',compact('meals','meal_types','restaurants'));
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
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'date' => 'required',
            'meal_id' =>'numeric|required',
            'restaurant_id'=>'numeric|required',
            'price' =>'numeric|required',
            'payment'=>'in:paid,pending',
            'remarks'=>'max:100'
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors(),
            ]);
        }
      $ok = Expense::create($request->all()); 
       return response()->json([
          'mData' => $ok,
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
        // $expense = Expense::all()->where('id',$id)->first();
        $expense = Expense::select('expenses.restaurant_id','expenses.meal_id','expenses.date','expenses.price','expenses.payment','expenses.remarks','expenses.created_at','meals.title','restaurants.restaurant_name')
            ->leftJoin('meals','meals.id','=','expenses.meal_id')
            ->leftJoin('restaurants','restaurants.id','=','expenses.restaurant_id') 
            ->first();
        return view('expenses.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::where('id',$id)->first();
        $meal = Meal::select('id','title')->where('id',$expense->meal_id)->first();
        $restaurant = Restaurant::select('id','restaurant_name')->where('id',$expense->restaurant_id)->first();
        return response()->json([
            'expense' => $expense,
            'meal' => $meal,
            'restaurant' => $restaurant
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
            'date' => 'required',
            'meal_id' =>'numeric|required',
            'restaurant_id'=>'numeric|required',
            'price' =>'numeric|required',
            'payment'=>'in:paid,pending',
            'remarks'=>'max:30'
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors(),
            ]);
        }
        $meal = Expense::findOrFail($id);
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
        $expense = Expense::findOrFail($id)->delete();
        return response()->json([
            'status' => 'Deleted Successfully !!'
            ]); 
    }
}
