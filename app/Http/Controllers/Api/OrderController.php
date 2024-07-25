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
        $data = $request->all();
        $newOrder = new Order();
        $newOrder->name = $data['name'];
        $newOrder->lastname = $data['lastname'];
        $newOrder->phone_number = $data['phone_number'];
        $newOrder->email = $data['email'];
        $newOrder->address = $data['address'];
        $newOrder->total_price = $data['total_price'];
        $newOrder->save();
        $orderId = $newOrder->id;

        $lead = new Lead();
        $lead->name = $data['name'];
        $lead->lastname = $data['lastname'];
        $lead->email = $data['email'];
        $lead->save();
        Mail::to($data['email'])->send(new NewContact($lead));

        $data = [
            'response' => 'success',
            'result'   =>  $orderId
        ];
        return response()->json($data);
    }
}
