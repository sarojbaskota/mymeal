<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Rules;
use App\ExpensesCategory;
class ExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = ExpensesCategory::select('id','title','created_at')->userId()->get();
        return view('expenses-category.index',compact('expenses'));
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
        ExpensesCategory::create($request->all()); 
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
        $meal = ExpensesCategory::select('title','created_at')->where('id',$id)->userId()->get();
        return view('expenses-category.show',compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = ExpensesCategory::select('title')->where('id',$id)->userId()->first();
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
            'title' => 'regex:/^[a-zA-Z ]+$/u|required|string',
        ]);
        if ($validator->fails())
        {
            return response()->json([
               'errors' => $validator->errors()->all()
            ]);
        }
       $expenses_category = ExpensesCategory::where('id',$id)->userId();
        $expenses_category->update($request->all());
        return response()->json([
            'status' => 'Updated Successfully !!',
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
        $expenses_category = ExpensesCategory::findOrFail($id)->userId()->delete();
        return response()->json([
            'status' => 'Deleted Successfully !!'
            ]); 
    }
}
