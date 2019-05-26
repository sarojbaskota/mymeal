<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\ExpensesCategory;
use App\Supplier;

class ExpensesController extends Controller
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
        $expenses_categories = ExpensesCategory::select('id','title')->userId()->get();
        $suppliers = Supplier::select('id','supplier_name')->userId()->get();
        return view('expenses.index',compact('expenses','expenses_categories','suppliers'));
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
            'expenses_category_id' =>'numeric|required',
            'supplier_id'=>'numeric|required',
            'amount' =>'numeric|required',
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
        // $expense = Expense::findOrFail($id);
        $expense = Expense::select('expenses.supplier_id','expenses.expenses_category_id','expenses.date','expenses.amount','expenses.payment','expenses.remarks','expenses.created_at','expenses_categories.title','suppliers.supplier_name')
            ->leftJoin('expenses_categories','expenses_categories.id','=','expenses.expenses_category_id')
            ->leftJoin('suppliers','suppliers.id','=','expenses.supplier_id') 
            ->where('expenses.id',$id)->where('expenses.user_id',\Auth::user()->id)->first();
            // return $expense;
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
        $expenses = Expense::where('id',$id)->first();
        $expenses_category = ExpensesCategory::select('id','title')->where('id',$expenses->expenses_category_id)->first();
        $supplier = Supplier::select('id','supplier_name')->where('id',$expenses->supplier_id)->first();
        return response()->json([
            'expenses' => $expenses,
            'expenses_category' => $expenses_category,
            'supplier' => $supplier
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
            'date' => '',
            'expenses_category_id' =>'numeric|required',
            'supplier_id'=>'numeric|required',
            'amount' =>'numeric|required',
            'payment'=>'in:paid,pending',
            'remarks'=>'max:100'
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors(),
            ]);
        }
        if($request->date){
            $expenses = Expense::findOrFail($id)->userId();
            $expenses->update($request->all());
            return response()->json([
            'status' => 'Updated Successfully !!'
            ]);
        }
            $expenses = Expense::findOrFail($id);
            $expenses->update($request->except('date'));
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
        $expense = Expense::findOrFail($id)->userId()->delete();
        return response()->json([
            'status' => 'Deleted Successfully !!'
            ]); 
    }
}
