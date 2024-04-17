<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    // index
    public function index(Request $request)
    {
        $barang = Barang::with('jenis', 'satuan', 'users')->get();
        $barang = Barang::query()
            ->when($request->input('barang_nama'), function ($query, $barang_nama) {
                $query->where('barang_nama', 'like', '%' . $barang_nama . '%')
                    ->orWhere('barang_kode', 'like', '%' . $barang_nama . '%');
            })
            ->paginate(10);

        return view('pages.barang.index', compact('barang'));
    }

    // create
    public function create()
    {
        $jenisBarang = DB::table('tbl_jenisbarang')->get();
        $satuan = DB::table('tbl_satuan')->get();
        $users = DB::table('users')->get();
        return view('pages.barang.create', compact('jenisBarang', 'satuan', 'users'));
    }

    // store
    public function store(Request $request)
    {

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->satuan_nama)));

        // validate the request
        $request->validate([
            'jenisbarang_id' => 'required|exists:tbl_jenisbarang,jenisbarang_id',
            'satuan_id' => 'required|exists:tbl_satuan,satuan_id',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'barang_slug' => $slug,
            'barang_harga' => 'required|numeric',
            'barang_stok' => 'required',
        ]);

        // store the request
        $barang = new Barang;
        $barang->jenisbarang_id = $request->jenisbarang_id;
        $barang->satuan_id = $request->satuan_id;
        $barang->barang_kode = $request->barang_kode;
        $barang->barang_nama = $request->barang_nama;
        $barang->barang_slug = $slug;
        $barang->barang_harga = $request->barang_harga;
        $barang->barang_stok = $request->barang_stok;
        $barang->users_id = Auth::id();

        // save image
        if ($request->hasFile('barang_gambar')) {
            $image = $request->file('barang_gambar');
            $newImageName = $barang->barang_id . '_' . str_replace(' ', '_', $barang->barang_nama) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/barang', $newImageName);
            $barang->barang_gambar = 'storage/barang/' . $newImageName;
        } else {
            $barang->barang_gambar = null;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang Berhasil Ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $jenisBarang = DB::table('tbl_jenisbarang')->get();
        $satuan = DB::table('tbl_satuan')->get();
        $users = DB::table('users')->get();
        return view('pages.barang.edit', compact('barang', 'jenisBarang', 'satuan', 'users'));
    }

    // update
    public function update(Request $request, $id)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->satuan_nama)));

        $request->validate([
            'jenisbarang_id' => 'required|exists:tbl_jenisbarang,jenisbarang_id',
            'satuan_id' => 'required|exists:tbl_satuan,satuan_id',
            'barang_kode' => 'nullable',
            'barang_nama' => 'nullable',
            'barang_slug' => $slug,
            'barang_harga' => 'nullable',
            'barang_stok' => 'nullable',
            'barang_gambar' => 'nullable',
        ]);

        // update the request
        $barang = Barang::find($id);
        $barang->jenisbarang_id = $request->jenisbarang_id;
        $barang->satuan_id = $request->satuan_id;
        $barang->barang_kode = $request->barang_kode;
        $barang->barang_nama = $request->barang_nama;
        $barang->barang_slug = $slug;
        $barang->barang_harga = $request->barang_harga;
        $barang->barang_stok = $request->barang_stok;
        $barang->users_id = Auth::id();
        if ($request->hasFile('barang_gambar')) {
            $image = $request->file('barang_gambar');
            $newImageName = $barang->barang_id . '_' . str_replace(' ', '_', $barang->barang_nama) . '.' . $image->getClientOriginalExtension();
            if ($barang->barang_gambar) {
                unlink(($barang->barang_gambar));
            }
            $image->storeAs('public/barang', $newImageName);
            $barang->barang_gambar = 'storage/barang/' . $newImageName;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang Berhasil Diupdate');
    }

    // destroy
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if ($barang->barang_gambar) {
            $imagePath = public_path($barang->barang_gambar);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang Berhasil Dihapus');
    }
}
