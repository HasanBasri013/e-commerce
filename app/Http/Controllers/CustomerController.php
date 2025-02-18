<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $customers = Customer::when($search, function ($query, $search) {
            return $query->where('NamaCustomer', 'like', "%$search%")
                         ->orWhere('KodeCustomer', 'like', "%$search%")
                         ->orWhere('Alamat', 'like', "%$search%");
        })->paginate(10);

        if ($request->ajax()) {
            $barang = Customer::paginate(10); // Paginate the updated data
            $output = view('component.customer_table', compact('customer'))->render(); // Render the table view
            return response()->json(['html' => $output]);
        }

        return view('component.customer', compact('customers'));
    }

    // Store a newly created Customer in storage
    public function store(Request $request)
    {
        $request->validate([
            'KodeCustomer' => 'required',
            'NamaCustomer' => 'required',
            'Alamat' => 'required',
            'NoTelp' => 'required',
            'Email' => 'nullable|email',
            'Kontak' => 'nullable',
        ]);

        Customer::create($request->all());

        return redirect()->route('component.customer')->with('success', 'Customer added successfully.');
    }

    // Update the specified Customer in storage
    public function update(Request $request, $IDCustomer)
    {
        $customer = Customer::findOrFail($IDCustomer);

        $request->validate([
            'KodeCustomer' => 'required',
            'NamaCustomer' => 'required',
            'Alamat' => 'required',
            'NoTelp' => 'required',
            'Email' => 'nullable|email',
            'Kontak' => 'nullable',
        ]);

        $customer->update($request->all());

        
        if ($request->ajax()) {
            $barang = Customer::paginate(10); // Paginate the updated data
            $output = view('component.customer_table', compact('customer'))->render(); // Render the table view
            return response()->json(['html' => $output]);
        }

        return redirect()->route('component.customer')->with('success', 'Customer updated successfully.');
    }

    // Remove the specified Customer from storage
    public function destroy($IDCustomer)
    {
        $customer = Customer::findOrFail($IDCustomer);
        $customer->delete();

        return redirect()->route('component.customer')->with('success', 'Customer deleted successfully.');
    }
}
