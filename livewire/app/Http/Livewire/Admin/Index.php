<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $produk, $harga, $gambar, $status, $prodId, $cari;
    public $produkEdit, $hargaEdit, $gambarEdit, $order;

    public function render()
    {
        $this->order = Order::first();
        return view('livewire.admin.index', [
            'Product' => Product::where('produk', 'like', '%' . $this->cari . '%')->orWhere('harga', 'like', '%' . $this->cari . '%')->latest()->paginate(5)
        ]);
    }

    public function store()
    {
        $gatau = '';
        if($this->gambar != null)
        {
            $gatau = $this->gambar->store('image','public');
        }
        Product::create([
            'produk' => $this->produk,
            'harga'  => $this->harga,
            'gambar' => $gatau
        ]);

        session()->flash('status', 'Produk ' . $this->produk . ' berhasil ditambahkan!');
        $this->resetInput();
    }

    public function edit($id)
    {
        $getData = Product::find($id);
        $this->prodId     = $getData->id;
        $this->produkEdit = $getData->produk;
        $this->hargaEdit  = $getData->harga;
        $this->status     = $getData->status;
        $this->gambarEdit = $getData->gambar;
    }

    public function submitEdit($id)
    {
        $ambilData = Product::find($id);
        if($this->gambarEdit == null)
        {
            Product::where('id', $this->prodId)->update([
                'produk' => $this->produkEdit,
                'harga'  => $this->hargaEdit,
                'status' => $this->status,
                'gambar' => null
            ]);
        }
        elseif($this->gambarEdit == $ambilData->gambar)
        {
            Product::where('id', $this->prodId)->update([
                'produk' => $this->produkEdit,
                'harga'  => $this->hargaEdit,
                'status' => $this->status,
                'gambar' => $this->gambarEdit
            ]);
        }
        else
        {
            Product::where('id', $this->prodId)->update([
                'produk' => $this->produkEdit,
                'harga'  => $this->hargaEdit,
                'status' => $this->status,
                'gambar' => $this->gambarEdit->store('image','public')
            ]);
        }

        session()->flash('status', 'Produk ' . $this->produkEdit . ' berhasil diubah!');
    }


    public function delete($id)
    {
        $data = Product::find($id);
        $data->delete();
        session()->flash('status', $data->produk.' berhasil dihapus');
    }


    public function resetInput()
    {
        $this->produk = null;
        $this->harga = null;
        $this->gambar = null;
    }

    public function resetHistory()
    {
        Order::truncate();
        session()->flash('status', 'Data pelanggan berhasil direset');
    }
}
