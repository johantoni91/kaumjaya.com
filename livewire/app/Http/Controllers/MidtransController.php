<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function index($uid)
    {
        $nilai = Note::where('user_id', auth()->user()->id)->where('status', 'Belum dibayar')->where('uid', $uid)->first();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $nilai->total,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
                'phone' => '0' . auth()->user()->noWa,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('client.keranjang', [
            'snapToken' => $snapToken
        ]);
    }

    public function transaction(Request $request)
    {
        try {
            $get = json_decode($request->json);
            $key = hash('SHA512', $get->order_id . $get->status_code . $get->gross_amount . env('MIDTRANS_SERVER_KEY'));
            $update = [
                'snapToken'     => $key
            ];
            $data = Note::where('user_id', auth()->user()->id)->where('status', 'Belum dibayar')->first();
            $data->update($update);
            $data->save();
            return response(url('handler'), 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            return response('Error', 404)->header('Content-Type', 'text/plain');
        }
    }
}
