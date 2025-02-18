<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    // Display a listing of suppliers with pagination and search functionality
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Paginate the filtered data if there's a search term, otherwise get all data
        $suppliers = Supplier::when($search, function ($query, $search) {
            return $query->where('NamaSupplier', 'like', "%$search%")
                         ->orWhere('KodeSupplier', 'like', "%$search%")
                         ->orWhere('Alamat', 'like', "%$search%");
        })->paginate(10);  // Paginate the result
        
        if ($request->ajax()) {
            $suppliers = Supplier::paginate(10);  // Paginate the updated data
            $output = view('component.supplier_table', compact('suppliers'))->render();
            return response()->json(['html' => $output]);
        }


        // Return the regular view with the data
        return view('component.supplier', compact('suppliers'));
    }

    // SupplierController.php

// Method for fetching suppliers for the modal (AJAX)
public function getSuppliersForModal(Request $request)
{
    $search = $request->input('search');

    // Retrieve suppliers based on the search term, no pagination required
    $suppliers = Supplier::when($search, function ($query, $search) {
        return $query->where('NamaSupplier', 'like', "%$search%")
                     ->orWhere('KodeSupplier', 'like', "%$search%");
    })->get();  // No pagination, just a collection of suppliers

    // Return a JSON response with the suppliers data
    return response()->json(['suppliers' => $suppliers]);
}


    // Store a newly created supplier in storage
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'KodeSupplier' => 'required',
            'NamaSupplier' => 'required',
            'Alamat' => 'required',
            'NoTelp' => 'required',
            'Email' => 'nullable|email',
            'Kontak' => 'nullable',
        ]);

        // Create a new Supplier record and save it
        Supplier::create($request->all());

        // If the request is an AJAX request, return the updated table HTML
        if ($request->ajax()) {
            $suppliers = Supplier::paginate(10);  // Paginate the updated data
            $output = view('component.supplier_table', compact('suppliers'))->render();
            return response()->json(['html' => $output]);
        }

        // If it's a regular request, redirect back to the suppliers page with success message
        return redirect()->route('component.supplier')->with('success', 'Supplier added successfully.');
    }

    // Update the specified supplier in storage
    public function update(Request $request, $IDSupplier)
    {
        // Validate the input data
        $validated = $request->validate([
            'KodeSupplier' => 'required',
            'NamaSupplier' => 'required',
            'Alamat' => 'required',
            'NoTelp' => 'required',
            'Email' => 'nullable|email',
            'Kontak' => 'nullable',
        ]);

        // Update the Supplier record
        $supplier = Supplier::findOrFail($IDSupplier);
        $supplier->update($request->all());

        // Return response with a success message
        return redirect()->route('component.supplier')->with('success', 'Supplier updated successfully.');
    }

    // Remove the specified supplier from storage
    public function destroy($IDSupplier)
    {
        $supplier = Supplier::findOrFail($IDSupplier);
        $supplier->delete();

        // Redirect back to the suppliers page with success message
        return redirect()->route('component.supplier')->with('success', 'Supplier deleted successfully.');
    }
}
