<?php

namespace App\Http\Controllers;
use App\Expense;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::select('expenses.id','expenses.restaurant_id','expenses.meal_id','expenses.date','expenses.price','expenses.payment','expenses.remarks','expenses.created_at','meals.title','restaurants.restaurant_name')
        ->leftJoin('meals','meals.id','=','expenses.meal_id')
        ->leftJoin('restaurants','restaurants.id','=','expenses.restaurant_id') 
        ->orderBy('expenses.date', 'desc')->get();

        // $expenses = Expense::latest()->get();
        return view('payment.index',compact('expenses'));
    }
    /**
     * payment paid record a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settled($id)
    {    
       $payment= Expense::findOrFail($id);
       if($payment->payment == "pending"){
        $payment->update(['payment' => "paid"]);
       }else{
        $payment->update(['payment' => "pending"]);
        return response()->json([
         'status' => 'Updated Successfully !!1',
         ]);
       }
      
    }
}    