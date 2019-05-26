<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
        $expenses = Expense::select('expenses.id','expenses.user_id','expenses.supplier_id','expenses.expenses_category_id','expenses.date','expenses.amount','expenses.payment','expenses.remarks','expenses.created_at','expenses_categories.title','suppliers.supplier_name')
        ->leftJoin('expenses_categories','expenses_categories.id','=','expenses.expenses_category_id')
        ->leftJoin('suppliers','suppliers.id','=','expenses.supplier_id') 
        ->orderBy('expenses.date', 'desc')->where('expenses.user_id',\Auth::user()->id)->get();

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
      $payments = Expense::findOrFail($id);
       if($payments->payment == "pending"){
        $payments->update([
             'payment' => "paid",
        ]);
        return response()->json([
            'status' => 'Pending Cleared Successfully !!',
            ]);
       }else{
        $payments->update([
            'payment' => "pending",
            ]);
        return response()->json([
         'status' => 'Pending Your Expenses !!',
         ]);
       }
      
    }
}    