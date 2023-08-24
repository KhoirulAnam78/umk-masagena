<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produk.produk', [
            'title' => 'Dashboard',
            'produk' => Produk::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create_produk', [
            'title' => 'Dashboard'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:produks',
            'deskripsi' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'image' => 'image|file|max:10024',
        ]);

        if ($request->file('image')) {
            $validate['image'] = $request->file('image')->store('produk-images');
        }

        Produk::create($validate);

        return redirect('/produk')->with('Sukses', 'Data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('produk.update_produk', [
            'title' => 'Dashboard',
            'produk' => $produk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'image' => 'image|file|max:10024',
        ];

        if ($request->nama !== $produk->nama) {
            $rules['nama'] = 'required|unique:produks';
        }

        $validate = $request->validate($rules);


        if ($request->file('image')) {
            if ($produk->image) {
                Storage::delete($produk->image);
            }
            $validate['image'] = $request->file('image')->store('produk-images');
        } else {
            $validate['image'] = $produk->image;
        }

        Produk::where('id', $produk->id)->update($validate);

        return redirect('/produk')->with('Sukses', 'Data berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if ($produk->image) {
            Storage::delete($produk->image);
        }

        Produk::destroy($produk->id);
        return redirect('/produk')->with('Sukses', 'Data berhasil dihapus !');
    }
}
