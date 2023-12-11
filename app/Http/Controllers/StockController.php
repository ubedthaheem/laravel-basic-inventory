<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock = Stock::all();
        return view('admin.stock.index', compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Products::all();
        return view('admin.stock.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'added_at' => 'required|date'
        ]);

        Stock::create($request->all());

        return to_route('all.stock')->with('message', 'New Stock added');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suppliers = Supplier::all();
        $products = Products::all();
        $info = Stock::findOrFail($id);
        return view('admin.stock.edit', compact('info', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->has('added_at')){
            $request->validate([
                'supplier_id' => 'required|numeric',
                'product_id' => 'required|numeric',
                'quantity' => 'required|numeric',
                'added_at' => 'required|date'
            ]);
    
            Stock::create($request->all());
            return to_route('all.stock')->with('message', 'New Stock added');
        }else{
            return to_route('all.stock')->with('message', 'Stock remained same');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        $message = [
            'message' => 'Stock delete',
            'type' => 'success',
            'icon' => ''
        ];
        return response()->json($message);
    }

    /**
     * Stock Entry form - Ajax Call
     */
    public function stockEntryForm(Request $request)
    {
        $show_product = $request->product_show;
        $suppliers = Supplier::all();
        $products = Products::all();
        $html = view('admin.stock.form_fields', compact('show_product', 'suppliers', 'products'))->render();
        return response()->json($html);
    }
}
