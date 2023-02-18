<?php

namespace App\Http\Livewire\Client;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class JajanPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public int $i = 1;
    public int $num = 20;
    public int $harga = 5000;
    public $cemilan, $snackbox, $cari, $pesenCemilan = [], $pesenSnackbox = [], $total = 0;
    public $tipeCemilan = false, $tipeSnackbox = false;

    public function mount()
    {
        $this->cemilan  = Order::where('user_id', auth()->user()->id)->where('tipe', 'cemilan')->where('status', 'Belum dibayar')->get();
        $this->snackbox = Order::where('user_id', auth()->user()->id)->where('tipe', 'snackbox')->where('status', 'Belum dibayar')->get();
    }

    public function render()
    {
        if ($this->num < 20) {
            $this->num = 20;
        }
        if ($this->harga < 5000) {
            $this->harga = 5000;
        }

        return view('livewire.client.jajan-page', [
            'Product'           => Product::orderBy('produk')->where('produk', 'like', '%' . $this->cari . '%')->paginate(5),
            'ProductSnackbox'   => Product::orderBy('produk')->where('harga', '<=', $this->harga)->paginate(5)
        ]);
    }

    public function Snacks()
    {
        foreach ($this->pesenCemilan as $cemil) {
            foreach (Product::where('id', $cemil)->get() as $cemils) {
                $data = [
                    'user_id'   => auth()->user()->id,
                    'produk_id' => $cemil,
                    'total'     => $cemils->harga,
                    'tipe'      => 'cemilan',
                    'take_order'     => Carbon::tomorrow()->format('d-m-Y')
                ];
                Order::updateOrCreate($data);
            }
        }
        return redirect()->to(route('jajanCart'));
    }
    public function Snackboxes()
    {
        foreach ($this->pesenSnackbox as $box) {
            $data = Product::select('harga')->where('id', $box)->get();
            foreach($data as $var)
            {
                $this->total += $var->harga;
            }
        }
        if (($this->total <= $this->harga) || ($this->total == $this->harga)) {
            foreach ($this->pesenSnackbox as $box) {
                $isian = [
                    'user_id'   => auth()->user()->id,
                    'produk_id' => $box,
                    'total'     => $this->total,
                    'jumlah'    => $this->num,
                    'tipe'      => 'snackbox',
                    'take_order'     => Carbon::tomorrow()->format('d-m-Y')
                ];
                Order::updateOrCreate($isian);
            }
            return redirect()->to(route('jajanCart'));
        } else {
            $this->total = 0;
            session()->flash('status', 'Mohon maaf isian box melebihi biaya yang anda tentukan.');
        }
    }



    // ACTION BUTTON
    public function tipeCemilan()
    {
        $this->tipeCemilan = true;
    }

    public function tipeSnackbox()
    {
        $this->tipeSnackbox = true;
    }

    public function backSnackbox()
    {
        $this->tipeSnackbox = false;
    }

    public function backCemilan()
    {
        $this->tipeCemilan = false;
    }
}
