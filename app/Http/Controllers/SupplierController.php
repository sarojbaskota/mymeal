<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Expense;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $suppliers = Supplier::userId()->get();
        return view('supplier.index',compact('suppliers'));
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
        // return $request->supplier_name;
        $validator = \Validator::make($request->all(), [
            'supplier_name' => 'regex:/^[a-zA-Z ]+$/u|unique:suppliers,supplier_name|required|string',
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }
      $ok = Supplier::create($request->all()); 
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
        $supplier = Supplier::select('supplier_name','created_at')->where('id',$id)->userId()->get();
        return view('supplier.show',compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::select('supplier_name')->where('id',$id)->userId()->first();
        return response()->json([
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
            'supplier_name' => 'regex:/^[a-zA-Z ]+$/u|required|string',
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }
        $supplier = Supplier::findOrFail($id)->userId();
        $supplier->update($request->all());
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
        $supplier = Supplier::findOrFail($id)->userId()->delete();
        return response()->json([
            'status' => 'Deleted Successfully !!'
            ]); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaction($id){
        $transactions = Expense::select('expenses.id','expenses.user_id','expenses.supplier_id','expenses.expenses_category_id','expenses.date','expenses.amount',          'expenses.payment','expenses_categories.title')
        ->leftJoin('expenses_categories','expenses_categories.id','=','expenses.expenses_category_id')->where('supplier_id',$id)->where('expenses.user_id',\Auth::user()->id)->get();
        return view('supplier.transactions.index',compact('transactions'));
    }
}
