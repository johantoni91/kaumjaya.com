<?php

namespace App\Http\Livewire\Client;

use App\Models\Order;
use App\Models\Note;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;

class History extends Component
{
    public $cari;
    
    public function render()
    {
        return view('livewire.client.history',[
            'data'  => Note::orderBy('take_order')->where('user_id',auth()->user()->id)->where('take_order', 'like', '%' . $this->cari . '%')->paginate(5)
        ]);
    }

    public function downloadPDF($time)
    {
        $data = Note::where('uid',$time)->get();
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice-'.Order::where('uid',$time)->first().'.pdf');
    }

    public function hapus($id)
    {
        $data = Note::where('id',$id)->first();
        $data->delete();
    }
}
