<?php

namespace App\Http\Controllers;

use App\Models\SalesReport;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SalesReportController extends Controller
{
    // Show sales reports list
    public function index(Request $request)
    {
        $reports = SalesReport::orderBy('report_date', 'desc')->paginate(10);
        return view('sales_report.index', compact('reports'));
    }

    // Generate a new sales report for a given date range
    public function generate(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $from = Carbon::parse($request->from)->startOfDay();
        $to = Carbon::parse($request->to)->endOfDay();

        $invoices = Invoice::whereBetween('saleDate', [$from, $to])->get();
        $total_sales = $invoices->sum('amount');
        $total_orders = $invoices->count();
        $details = $invoices->map(function($invoice) {
            // Always decode books_sold JSON for the report
            $booksSold = $invoice->books_sold;
            if (is_string($booksSold)) {
                $decoded = json_decode($booksSold, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $booksSold = $decoded;
                }
            }
            return [
                'id' => $invoice->id,
                'customer' => $invoice->customer,
                'saleDate' => $invoice->saleDate,
                'amount' => $invoice->amount,
                'books_sold' => $booksSold,
            ];
        });

        $report = SalesReport::create([
            'report_date' => now(),
            'total_sales' => $total_sales, // store as float, not formatted string
            'total_orders' => $total_orders, // store as int, not formatted string
            'details' => $details,
        ]);

        return redirect()->route('sales_report.index')->with('success', 'Sales report generated!');
    }

    // Show a single sales report
    public function show($id)
    {
        $report = SalesReport::findOrFail($id);
        return view('sales_report.show', compact('report'));
    }
}
