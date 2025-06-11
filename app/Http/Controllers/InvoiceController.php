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
        if (isset($invoice->books_sold)) {
            $cart = json_decode($invoice->books_sold, true) ?? [];
        } elseif (isset($invoice->book_sold)) {
            $cart = json_decode($invoice->book_sold, true) ?? [];
        }

        $pdf = Pdf::loadView('cart.invoicePDF', compact('invoice', 'cart'));
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }
}
