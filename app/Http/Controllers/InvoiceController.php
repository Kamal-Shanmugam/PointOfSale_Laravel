<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function downloadinvoice($id)
    {

        $invoice = Invoice::findOrFail($id);

        $cart = [];
        // if (isset($invoice->books_sold)) {
        //     $cart = $invoice->books_sold ?? [];
        // }
        
        // elseif 
        
        // (isset($invoice->book_sold)) {
        //     $cart = $invoice->book_sold ?? [];
        // }

        $pdf = Pdf::loadView('cart.invoicePDF', compact('invoice', 'cart'));
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }
}
