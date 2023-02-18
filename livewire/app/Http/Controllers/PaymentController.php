<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function handler(Request $request)
    {
        $get        = json_decode($request->json);
        $data       = Note::where('user_id',auth()->user()->id)->where('status','Belum dibayar')->first();
        $data_order = Order::where('uid',$data->uid)->get();
        $Hrisk      = $data->signature_key;
        if($get->signature_key != $Hrisk){
            $data->delete();
            return redirect()->to(route('jajanCart'), with('status', 'Mohon maaf transaksi gagal'));
        } else{
            $data->update([
                'status'        => 'Sudah dibayar',
                'time_payment'  => $get->transaction_time,
            ]);
            $data_order->update([
                'status'    => 'Sudah dibayar'
            ]);
            foreach($data_order as $order)
            {
                $order->save();
            }
            $data->save();
        }
    }
}
