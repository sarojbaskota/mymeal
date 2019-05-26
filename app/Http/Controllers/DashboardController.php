<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\ExpensesCategory;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application expense board.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $suppliers = Supplier::all();
        $expenses_categories = ExpensesCategory::all();
        return view('dashboard',compact('suppliers','expenses_categories'));
    }
}
