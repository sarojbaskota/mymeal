<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Supplier;
use Carbon\Carbon;
class ReportController extends Controller
{
    /**
     * Display a Report of monthly expenses.
     * For this month.
     * @return \Illuminate\Http\Response
     */
    public function monthlyExpenses(Request $request)
    {
        // return $request;
        $reports = Expense::select('expenses.id','expenses.user_id','expenses.supplier_id','expenses.expenses_category_id','expenses.date','expenses.amount','expenses.payment','expenses.remarks','expenses.created_at','expenses_categories.title','suppliers.supplier_name')
        ->leftJoin('expenses_categories','expenses_categories.id','=','expenses.expenses_category_id')
        ->leftJoin('suppliers','suppliers.id','=','expenses.supplier_id') 
        ->orderBy('expenses.date', 'desc')->where('expenses.user_id',\Auth::user()->id)->whereYear('date', '=', date($request->year))->whereMonth('date', '=', date($request->month))->get();
        $total_amount = Expense::userId()->whereYear('date', '=', date($request->year))->whereMonth('date', '=', date($request->month))->sum('amount');
        return view('reports.monthly_expenses',compact('reports','total_amount'));
    }
     /**
     * Display a Report of monthly expenses.
     * For this month.
     * @return \Illuminate\Http\Response
     */
    public function expensesWithSupplier(Request $request)
    {
        $reports = Expense::select('expenses.id','expenses.user_id','expenses.supplier_id','expenses.expenses_category_id','expenses.date','expenses.amount','expenses.payment','expenses.remarks','expenses.created_at','expenses_categories.title','suppliers.supplier_name')
        ->leftJoin('expenses_categories','expenses_categories.id','=','expenses.expenses_category_id')
        ->leftJoin('suppliers','suppliers.id','=','expenses.supplier_id') 
        ->orderBy('expenses.date', 'desc')->where('expenses.user_id',\Auth::user()->id)->whereYear('date', '=', date($request->year))->whereMonth('date', '=', date($request->month))->where('expenses.supplier_id',$request->supplier_id)->get();

        $suppliers = Supplier::userId()->get();

        $total_amount = Expense::userId()->whereYear('date', '=', date($request->year))->whereMonth('date', '=', date($request->month))->where('supplier_id',$request->supplier_id)->sum('amount');
        

        $pending = Expense::userId()->whereYear('date', '=', date($request->year))->whereMonth('date', '=', date($request->month))->where('supplier_id',$request->supplier_id)->where('payment','pending')->sum('amount');

        $paid = Expense::userId()->whereYear('date', '=', date($request->year))->whereMonth('date', '=', date($request->month))->where('supplier_id',$request->supplier_id)->where('payment','paid')->sum('amount');
        return view('reports.expenses_with_supplier',compact('reports','total_amount','suppliers','pending','paid'));
    }
}
