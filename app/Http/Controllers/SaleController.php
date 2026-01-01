<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('car')->orderBy('sold_at', 'desc')->paginate(15);
        return view('admin.sales.index', compact('sales'));
    }
}
