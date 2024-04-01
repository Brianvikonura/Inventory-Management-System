<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    // index
    public function index()
    {
        $barang = Barang::with('jenis', 'satuan')->get();
        return view('pages.barang.index', compact('barang'));
    }

    // create
    public function create()
    {
        $jenisBarang = DB::table('tbl_jenisbarang')->get();
        $satuan = DB::table('tbl_satuan')->get();
        return view('pages.barang.create', compact('jenisBarang', 'satuan'));
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
            'barang_gambar' => 'nullable',
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

        // save image
        if ($request->hasFile('barang_gambar')) {
            $image = $request->file('barang_gambar');
            $newImageName = $barang->barang_id . '_' . str_replace(' ', '_', $barang->barang_nama) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/barang', $newImageName);
            $barang->barang_gambar = 'storage/barang/' . $newImageName;
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
        return view('pages.barang.edit', compact('barang', 'jenisBarang', 'satuan'));
    }

    // update
    public function update(Request $request, $id)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->satuan_nama)));

        $request->validate([
            'jenisbarang_id' => 'required|exists:tbl_jenisbarang,jenisbarang_id', // validation rule for jenisbarang_id
            'satuan_id' => 'required|exists:tbl_satuan,satuan_id', // validation rule for satuan_id
            'barang_kode' => 'nullable', // validation rule for barang_kode
            'barang_nama' => 'nullable', // validation rule for barang_nama
            'barang_slug' => $slug, // assuming $slug is properly defined
            'barang_harga' => 'nullable', // validation rule for barang_harga
            'barang_stok' => 'nullable', // validation rule for barang_stok
            'barang_gambar' => 'nullable', // validation rule for barang_gambar
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
            // Get the full image path
            $imagePath = public_path($barang->barang_gambar);

            // Check if the image file exists
            if (file_exists($imagePath)) {
                // Delete the image file
                unlink($imagePath);
            }
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang Berhasil Dihapus');
    }
}
