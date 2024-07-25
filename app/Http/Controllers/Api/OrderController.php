<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Lead;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(Request $request){
        //new order
        $data = $request->all();
        $newOrder = new Order();
        $newOrder->name = ucwords(strtolower($data['name']));
        $newOrder->lastname = ucwords(strtolower($data['lastname']));
        $newOrder->phone_number = $data['phone_number'];
        $newOrder->email = strtolower($data['email']);
        $newOrder->address = ucwords(strtolower($data['address']));
        $newOrder->total_price = $data['total_price'];
        $newOrder->save();
        $orderId = $newOrder->id;

        //new lead for user email
        $lead = new Lead();
        $lead->name = ucwords(strtolower($data['name']));
        $lead->lastname = ucwords(strtolower($data['lastname']));
        $lead->email = strtolower($data['email']);
        $lead->price = $data['total_price'];
        $lead->order = $orderId;
        $lead->save();
        Mail::to($newOrder->email)->send(new NewContact($lead));

        // send result frontoffice
        $data = [
            'response' => 'success',
            'result'   =>  $orderId
        ];
        return response()->json($data);
    }
}
