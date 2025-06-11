<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Show all suppliers
    public function SuppliersList()
    {
        $suppliers = Suppliers::latest()->get();
        return view('supplier_data.supplier', compact('suppliers'));
    }

    // Show form to add a new supplier
    public function newSupplierForm()
    {
        return view('supplier_data.supplier');
    }

    // Store a new supplier
    public function newSupplier(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $supplier = new Suppliers();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->save();

        return redirect()->route('suppliers')->with('success', 'Supplier added successfully!');
    }

    // Show form to edit a supplier
    public function editSupplier($id)
    {
        $supplier = Suppliers::findOrFail($id);
        return view('supplier_data.editsupplier', compact('supplier'));
    }

    // Update supplier
    public function updateSupplier(Request $request, $id)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $supplier = Suppliers::findOrFail($id);
        $supplier->supplier_name = $request->supplier_name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->save();

        return redirect()->route('suppliers')->with('success', 'Supplier updated successfully!');
    }

    // Delete supplier
    public function deleteSupplier($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers')->with('success', 'Supplier deleted successfully!');
    }
}
