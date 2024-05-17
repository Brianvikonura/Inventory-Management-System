<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EkspedisiController extends Controller
{
    public function index(Request $request)
    {
        $ekspedisi = Ekspedisi::with('users')->get();
        $ekspedisi = Ekspedisi::query()
            ->when($request->input('ekspedisi_jenis'), function ($query, $ekspedisi_jenis) {
                $query->where('ekspedisi_jenis', 'like', '%' . $ekspedisi_jenis . '%')
                    ->orWhere('ekspedisi_keterangan', 'like', '%' . $ekspedisi_jenis . '%');
            })
            ->paginate(10);

        return view('pages.ekspedisi.index', compact('ekspedisi'));
    }

    public function create()
    {
        $users = DB::table('users')->get();
        return view('pages.ekspedisi.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ekspedisi_jenis' =>'required',
            'ekspedisi_keterangan' =>'nullable',
        ]);

        $ekspedisi = new Ekspedisi;
        $ekspedisi->ekspedisi_jenis = $request->ekspedisi_jenis;
        $ekspedisi->ekspedisi_keterangan = $request->ekspedisi_keterangan;
        $ekspedisi->users_id = Auth::id();

        $ekspedisi->save();

        return redirect()->route('ekspedisi.index')->with('success', 'Data Ekspedisi Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $users = DB::table('users')->get();
        return view('pages.ekspedisi.edit', compact('ekspedisi', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ekspedisi_jenis' =>'required|string|max:255',
        ]);

        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->ekspedisi_jenis = $request->ekspedisi_jenis;
        $ekspedisi->ekspedisi_keterangan = $request->ekspedisi_keterangan;
        $ekspedisi->users_id = Auth::id();

        $ekspedisi->save();

        return redirect()->route('ekspedisi.index')->with('success', 'Data Ekspedisi Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $ekspedisi = Ekspedisi::find($id);

        $ekspedisi->delete();

        return redirect()->route('ekspedisi.index')->with('success', 'Data Ekspedisi Berhasil Dihapus');
    }
}
