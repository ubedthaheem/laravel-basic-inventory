<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9+]{5,}$/'],
        ]);

        Supplier::create($request->all());
        return to_route('all.suppliers')->with('message', 'Successfully Added new supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $info = Supplier::findOrFail($id);
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9+]{5,}$/'],
        ]);

        $info->update($request->all());
        return to_route('all.suppliers')->with('message', 'Successfully Added new supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        $message = [
            'message' => 'Supplier information moved to trash',
            'type' => 'success',
            'icon' => ''
        ];
        return response()->json($message);
    }
}
