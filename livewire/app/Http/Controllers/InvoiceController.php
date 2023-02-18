<?php

namespace App\Http\Controllers;

use App\Models\Order;

class InvoiceController extends Controller
{
    public function index($id)
    {
        $data = Order::where('user_id',auth()->user()->id)->where('tipe','snackbox')->where('status','paid')->where('updated_at',$id)->first();
        return view('layouts.invoice',[
            'cemilan'       => Order::where('user_id',auth()->user()->id)->where('tipe','cemilan')->where('status','paid')->where('updated_at',$id)->get(),
            'snackbox'      => Order::where('user_id',auth()->user()->id)->where('tipe','snackbox')->where('status','paid')->where('updated_at',$id)->get(),
            'totalCemilan'  => Order::where('user_id',auth()->user()->id)->where('tipe','cemilan')->where('status','paid')->where('updated_at',$id)->sum('total'),
            'totalSnackbox' => $data->jumlah*$data->total
        ]);
    }
}
