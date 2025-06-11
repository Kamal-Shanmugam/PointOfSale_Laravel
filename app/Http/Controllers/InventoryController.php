<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function inventory(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');     // Default to 'id'
        $order = $request->get('order', 'asc');       // Default to 'asc'
        $search = $request->get('search');

        $allowedSorts = ['id', 'title', 'author', 'genre', 'stock', 'cost', 'price'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }

        $query = Books::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('genre', 'like', "%{$search}%");
            });
        }
        $library = $query->orderBy($sortBy, $order)->paginate(5);

        // return view('welcome', compact('library'));


        $suppliers = Suppliers::latest()->get();
        // $library = Books::latest()->get();
        return view('reports.inventory', compact('library', 'suppliers'));
    }




    public function editbook($id)
    {
        $books = Books::where('id', $id)->first();
        return view('book.update_book', ['books' => $books]);
    }

    public function delete($id)
    {
        $library = Books::where('id', $id)->first();
        $library->delete();
        return back()->withSuccess('Book removed from library');
    }
}
