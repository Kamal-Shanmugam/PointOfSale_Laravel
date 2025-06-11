<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function newSupplier(Request $suppliers)
    {
        $suppliers->validate([
            'supplier' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);

        $supplier_table = new Suppliers();
        $supplier_table->supplier_name = $suppliers->supplier;
        $supplier_table->email = $suppliers->email;
        $supplier_table->phone = $suppliers->phone;
        $supplier_table->address = $suppliers->address;
        // table->column_name=  form.variable->variable.name 

        if ($supplier_table->save()) {
            return back();
        }
    }

    public function SuppliersList()
    {

        // $query = Suppliers::get();

        // if ($find_supplier) {
        //     $query->where(function ($q) use ($find_supplier) {
        //         $q->where('supplier_name', 'like', "%{$find_supplier}%")
        //             ->orWhere('phone', 'like', "%{$find_supplier}%");
        //     });
        // }
        // $query->get()->paginate(10);


        $suppliers = Suppliers::latest()->get();

        return view('supplier_data.supplier', compact('suppliers'));
    }
}
