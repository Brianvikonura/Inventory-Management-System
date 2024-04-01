<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // index
    public function index(Request $request)
    {
        $customer = Customer::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->paginate(10);
        return view('pages.customer.index', compact('customer'));
    }

    // create
    public function create()
    {
        $customer = DB::table('tbl_customer')->get();
        return view('pages.customer.create');
    }

    // store the request
    public function store(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->customer_nama)));

        // validate the request
        $request->validate([
            'customer_nama' =>'required',
            'customer_slug' => $slug,
            'customer_alamat' =>'required',
            'customer_notelp' =>'required',
        ]);

        // store the request
        $customer = new customer;
        $customer->customer_nama = $request->customer_nama;
        $customer->customer_slug = $slug;
        $customer->customer_alamat = $request->customer_alamat;
        $customer->customer_notelp = $request->customer_notelp;

        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Data Customer Berhasil Dibuat');
    }

    // edit
    public function edit($id)
    {
        $customer = customer::findOrFail($id);

        return view('pages.customer.edit', compact('customer'));
    }

    // update the request
    public function update(Request $request, $id)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->customer_nama)));

        // validate the request
        $request->validate([
            'customer_nama' =>'nullable',
            'customer_slug' => $slug,
            'customer_alamat' =>'nullable',
            'customer_notelp' =>'nullable',
        ]);

        // store the request
        $customer = customer::findOrFail($id);
        $customer->customer_nama = $request->customer_nama;
        $customer->customer_slug = $slug;
        $customer->customer_alamat = $request->customer_alamat;
        $customer->customer_notelp = $request->customer_notelp;

        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Data Customer Berhasil Diupdate');
    }

    // destroy
    public function destroy($id)
    {
        $customer = customer::find($id);

        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Data Customer Berhasil Dihapus');
    }
}
