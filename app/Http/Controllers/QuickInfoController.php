<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Expense;
class QuickInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mealExpense(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'year' => 'required',
            'month' => 'required',
            'restaurant_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }

         $data = Expense::select('restaurant_id','price')->whereYear('date',$request->year)->whereMonth('date',$request->month)->where('restaurant_id',$request->restaurant_id)->where('payment','pending')->where('meal_id', '!=', 59)->sum('price');
      return response()->json([
        'total' => $data, 
     ]);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'year' => 'required',
            'month' => 'required',
            'payment' => 'required',
            'meal_id' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }

         $data = Expense::select('restaurant_id','price')->where('payment','pending')->whereYear('date',$request->year)->whereMonth('date',$request->month)->where('restaurant_id',$request->restaurant_id)->where('payment',$request->payment)->where('meal_id',$request->meal_id)->sum('price');
      return response()->json([
        'total' => $data, 
     ]);
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
        // return $request->restaurant_name;
        $validator = \Validator::make($request->all(), [
            'restaurant_name' => 'regex:/^[a-zA-Z ]+$/u|unique:restaurants,restaurant_name|required|string',
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }
      $ok = Restaurant::create($request->all()); 
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
        $restaurant = Restaurant::select('restaurant_name','created_at')->where('id',$id)->get();
        return view('restaurant.show',compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::select('restaurant_name')->where('id',$id)->first();
        return response()->json([
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
            'restaurant_name' => 'regex:/^[a-zA-Z ]+$/u|required|string|unique:restaurants,restaurant_name,'.$id,
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }
        $meal = Restaurant::findOrFail($id);
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
        $meal = Restaurant::findOrFail($id)->delete();
        return response()->json([
            'status' => 'Deleted Successfully !!'
            ]); 
    }
}
