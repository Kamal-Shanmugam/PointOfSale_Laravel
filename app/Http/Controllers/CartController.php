<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Invoice;
use Illuminate\Http\Request;

class CartController extends Controller

{
    public function cancelorder()
    {
        session()->forget('cart');
        $library = Books::latest()->get();
        return view('welcome', compact('library'));
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.viewCart', compact('cart'));
    }

    public function addtoCart(Request $cartForm)
    {
        $cartBook = $cartForm->only(['id', 'title', 'price']);

        $cart = session()->get('cart', []);
        if (isset($cart[$cartBook['id']])) {
            $cart[$cartBook['id']]['quantity']++;
        } else {
            $cart[$cartBook['id']] = [
                'title' => $cartBook['title'],
                'price' => (float) $cartBook['price'],
                'quantity' => 1
            ];
        }
        session(['cart' => $cart]);
        return back()->with('success', 'Item added to cart!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['msg' => 'Cart is empty!']);
        }

        $totalAmount = 0;

        $books_sold = [];
        foreach ($cart as $bookId => $item) {
            $book = Books::find($bookId);
            if ($book && $book->quantity >= $item['quantity']) {
                $book->quantity -= $item['quantity'];
                $book->save();

                $totalAmount += $item['price'] * $item['quantity'];
                // Store all details for each book
                $books_sold[] = [
                    'id' => $bookId,
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ];
            } else {
                return redirect()->route('viewCart')->with(['err-msg' => "Insufficient stock: {$item['title']}."]);
            }
        }

        // Create invoice with full book details
        $invoice = Invoice::create([
            'customer' => $request->input('customer', 'Walk-in'),
            'saleDate' => now(),
            'books_sold' => json_encode($books_sold),
            'amount' => number_format($totalAmount, 2),
        ]);

        session()->forget('cart');
        return view('cart.invoice', compact('invoice', 'cart'));
    }
}
