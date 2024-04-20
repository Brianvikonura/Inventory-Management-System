<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // index
    public function index(Request $request)
    {
        $customer = Customer::with('users')->get();
        $customer = Customer::query()
            ->when($request->input('customer_nama'), function ($query, $customer_nama) {
                $query->where('customer_nama', 'like', '%' . $customer_nama . '%')
                    ->orWhere('customer_alamat', 'like', '%' . $customer_nama . '%');
            })
            ->paginate(10);

        return view('pages.customer.index', compact('customer'));
    }

    // create
    public function create()
    {
        $users = DB::table('users')->get();
        return view('pages.customer.create', compact('users'));
    }

    // store the request
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'customer_nama' =>'required',
            'customer_alamat' =>'required',
            'customer_notelp' =>'required',
        ]);

        // store the request
        $customer = new customer;
        $customer->customer_nama = $request->customer_nama;
        $customer->customer_alamat = $request->customer_alamat;
        $customer->customer_notelp = $request->customer_notelp;
        $customer->users_id = Auth::id();

        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Data Customer Berhasil Dibuat');
    }

    // edit
    public function edit($id)
    {
        $customer = customer::findOrFail($id);
        $users = DB::table('users')->get();
        return view('pages.customer.edit', compact('customer', 'users'));
    }

    // update the request
    public function update(Request $request, $id)
    {
        // validate the request
        $request->validate([
            'customer_nama' =>'nullable',
            'customer_alamat' =>'nullable',
            'customer_notelp' =>'nullable',
        ]);

        // store the request
        $customer = customer::findOrFail($id);
        $customer->customer_nama = $request->customer_nama;
        $customer->customer_alamat = $request->customer_alamat;
        $customer->customer_notelp = $request->customer_notelp;
        $customer->users_id = Auth::id();

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
