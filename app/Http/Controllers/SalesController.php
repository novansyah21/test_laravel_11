<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AuditTrail;

class SalesController extends Controller
{
    public function index()
    {
        // Get the logged-in user's ID
        $userId = Auth::id();

        // Fetch the sales for the logged-in user
        $sales = Sale::where('user_id', $userId)->get();
        $menus = AuditTrail::where('user_id', $userId)
            ->select('menu_accessed')
            ->distinct()
            ->pluck('menu_accessed');

        // Return the sales data to the view
        return view('sales.index', compact('sales', 'menus'));
    }

    public function createOrEdit($id = null)
    {
        $userId = Auth::id();
        
        $sale = $id ? Sale::where('id', $id)->where('user_id', auth()->id())->firstOrFail() : new Sale(['user_id' => auth()->id()]);
        $menus = AuditTrail::where('user_id', $userId)
            ->select('menu_accessed')
            ->distinct()
            ->pluck('menu_accessed');

        // Pass the sale to the view for pre-filling the form if editing
        return view('sales.form', compact('sale', 'menus'));
    }


    public function storeOrUpdate(Request $request, $id = null)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensure user exists
            'amount' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        // If an ID is provided, we're updating the sale, otherwise creating a new one
        $sale = $id ? Sale::findOrFail($id) : new Sale();

        // Update or create the sale record
        $sale->user_id = $validated['user_id'];
        $sale->amount = $validated['amount'];
        $sale->sale_date = $validated['sale_date'];
        $sale->save();

        // Redirect to the sales page or any other page
        return redirect()->route('sales.index')->with('success', 'Sale record saved successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        Sale::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'sale_date' => $request->sale_date,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully!');
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        if (!$sale) {
            return redirect()->route('sales.index')->with('error', 'Sale not found.');
        }

        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        // print_r($validatedData);
        // die();

        $sale = Sale::findOrFail($id);
        $sale->update($validatedData);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

}
