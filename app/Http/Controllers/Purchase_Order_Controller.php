<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Purchase_Order;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class Purchase_Order_Controller extends Controller

{
    
    public function update_purchase(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Purchase_Order::findOrFail($id);
        $wasReceived = $order->status === 'Received';
        $order->status = $request->status;
        $order->save();

        // If status is changed to Received and wasn't received before, update stock
        if ($order->status === 'Received' && !$wasReceived) {
            $book = Books::find($order->book_id);
            if ($book) {
                $book->quantity += $order-> quantity;
                $book->save();
            }
        }

        return redirect()->route('orderslist')->with('success', 'Order updated successfully!');
    }
    public function purchase()
    {




        
        $library = Books::latest()->get();
        $suppliers = Suppliers::latest()->get();
        return view('purchaseOrder.purchase', compact('library', 'suppliers'));
    }
    public function Save_purchase(Request $request)
    {
        $request->validate([
            'booktitle' => 'required',
            'supplier' => 'required',
            'cost' => 'nullable|numeric',
            'quantity' => 'required|numeric',
            'ed_date' => 'date'
        ]);

        $po_table = new Purchase_Order();
        $po_table->supplier_id = $request->supplier;
        $po_table->book_id = $request->booktitle;
        // $po_table->unit_Price =  number_format( $request->cost,2);

        $po_table->quantity = number_format( $request->quantity,2);
        $po_table->status = $request->status;
        $po_table->expected_delivery = $request->ed_date;


        if ($po_table->save()) {
            return redirect()->route('orderslist')->with('success', "Order placed successfully");
        } else {
            echo "Unable to save orders";
        }
    }





    public function orderslist(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');     // Default to 'id'
        $order = $request->get('order', 'asc');       // Default to 'asc'
        $search = $request->get('search');

        // Allowed columns for sorting
        $allowedSorts = ['id', 'supplier_id', 'book_id', 'unit_Price', 'quantity', 'status', 'expected_delivery'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }

        $query = Purchase_Order::with(['book', 'supplier']);

        // Search by supplier name or book title
        if ($search) {
            $query->whereHas('supplier', function ($q) use ($search) {
                $q->where('supplier_name', 'like', "%{$search}%");
            })->orWhereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $orders = $query->orderBy($sortBy, $order)->paginate(10);

        $suppliers = Suppliers::latest()->get();

        return view('purchaseOrder.orderlist', compact('orders', 'suppliers'));
    }
}
