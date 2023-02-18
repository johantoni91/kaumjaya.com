<?php

namespace App\Http\Livewire\Client;

use App\Models\Note;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class JajanCart extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $data, $cari, $Cemilan, $Snackbox, $totalSnackbox = 0, $jumlahSnackbox = 20, $waktuPesan, $status;
    public $besok;
    public $i = 1, $j = 1;
    public int $total = 0;
    public int $harga = 5000;
    public $crypt;
    public $pesenCemilan = [], $pesenSnackbox = [];

    public function mount()
    {
        $this->waktuPesan = Carbon::tomorrow()->format('Y-m-d');
        $this->crypt      = Carbon::tomorrow()->format('dmYiH');
        $this->besok      = Carbon::tomorrow()->format('Y-m-d');
    }
    
    public function render()
    {
        $this->Cemilan  = Order::where('user_id', auth()->user()->id)->where('tipe', 'cemilan')->where('status', 'Belum dibayar')->get();
        $this->Snackbox = Order::where('user_id', auth()->user()->id)->where('tipe', 'snackbox')->where('status', 'Belum dibayar')->get();
        $this->data = Order::where('user_id',auth()->user()->id)->where('status','Belum dibayar')->get();
        
        if(!($this->Snackbox->first() == null)){
            $this->ambilSnackbox($this->Snackbox->first());
        }
        if ($this->jumlahSnackbox < 20)
        {
            $this->jumlahSnackbox = 20;
        }
        if ($this->harga < 5000) {
            $this->harga = 5000;
        }

        return view('livewire.client.jajan-cart', [
            'ProductCemilan'    => Product::orderBy('produk')->where('produk', 'like', '%' . $this->cari . '%')->paginate(5),
            'ProductSnackbox'   => Product::orderBy('produk')->where('harga', '<=', $this->harga)->paginate(5)
        ]);
    }




    public function hapusCemilan($id)
    {
        $data = Order::where('id',$id)->first();
        $data->delete();
    }

    public function kurangCemilan($id)
    {
        $data   = Order::where('id',$id)->first();
        $produk = Product::where('id',$data->produk_id)->first();
        if($data->jumlah > 1)
        {
            $data->jumlah--;
        }
        $data->total = $produk->harga * $data->jumlah;
        $data->save();
    }

    public function tambahCemilan($id)
    {
        $data = Order::where('id',$id)->first();
        $produk = Product::where('id',$data->produk_id)->first();
        if($data->jumlah < 20)
        {
            $data->jumlah++;
        }
        $data->total = $produk->harga * $data->jumlah;
        $data->save();
    }





    // AMBIL DATA SNACKBOX
    public function ambilSnackbox($data)
    {
        $this->totalSnackbox = $data->jumlah * $data->total;
    }











    // ADD ORDER
    public function beliCemilan()
    {
        foreach ($this->pesenCemilan as $cemil) {
            foreach (Product::where('id', $cemil)->get() as $cemils) {
                $data = [
                    'user_id'   => auth()->user()->id,
                    'produk_id' => $cemil,
                    'total'     => $cemils->harga,
                    'tipe'      => 'cemilan'
                ];
                Order::updateOrCreate($data);
            }
        }
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
        if (($this->total <= $this->harga)) {
            foreach ($this->pesenSnackbox as $box) {
                $isian = [
                    'user_id'   => auth()->user()->id,
                    'produk_id' => $box,
                    'total'     => $this->total,
                    'jumlah'    => $this->jumlahSnackbox,
                    'tipe'      => 'snackbox'
                ];
                Order::updateOrCreate($isian);
            }
            session()->flash('sukses', 'Berhasil ditambahkan');
        } else {
            $this->total = 0;
            session()->flash('status', 'Isian box melebihi biaya yang anda pilih');
        }
    }

    public function hapusSnackbox($id)
    {
        $data = Order::where('id', $id)->first();
        $data->delete();
    }





    // PROSES BELI
    public function buy()
    {
        foreach($this->data as $item)
        {
            if($item->uid == null){
                $item->uid = hash('SHA512',$this->crypt);
                $item->take_order = $this->waktuPesan;
                $item->save();
            }
        }
        $take_order = Order::where('user_id',auth()->user()->id)->where('status','Belum dibayar')->first();
        if($this->Cemilan->sum('total') == null && !($this->totalSnackbox == null))
        {
            $data = [
                'num'        => rand(),
                'user_id'    => auth()->user()->id,
                'total'      => $this->totalSnackbox,
                'uid'        => $take_order->uid,
                'take_order' => $take_order->take_order
            ];
            if(Note::where('take_order',$take_order)->first() == null){
                Note::create($data);
            }
        } elseif(!($this->Cemilan->sum('total') == null) && $this->totalSnackbox == null)
        {
            $data = [
                'num'        => rand(),
                'user_id'    => auth()->user()->id,
                'total'      => $this->Cemilan->sum('total'),
                'uid'        => $take_order->uid,
                'take_order' => $take_order->take_order
            ];
            if(Note::where('take_order',$take_order)->first() == null){
                Note::create($data);
            }
        } else{
            $data = [
                'num'        => rand(),
                'user_id'    => auth()->user()->id,
                'total'      => $this->Cemilan->sum('total')+$this->totalSnackbox,
                'uid'        => $take_order->uid,
                'take_order' => $take_order->take_order
            ];
            if(Note::where('take_order',$take_order)->first() == null){
                Note::create($data);
            }
        }
        return redirect()->to('/order/checkout/'.$take_order->uid);
    }
}
