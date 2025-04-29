<?php

namespace App\Http\Controllers;

use App\Http\Resources\orderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        $customers = Http::get('http://127.0.0.1:8000/api/users-api')->json()['data'];
        $products  = Http::get('http://127.0.0.1:8001/api/products-api')->json()['data'];

        foreach ($orders as $order) {
            $order->customer = collect($customers)->firstWhere('id', $order->customer_id);
            $order->product  = collect($products)->firstWhere('id', $order->product_id);
        }

        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $customerId = $request->query('customer_id');

        $customers = Http::get('http://127.0.0.1:8000/api/users-api')->json()['data'];
        $products  = Http::get('http://127.0.0.1:8001/api/products-api')->json()['data'];

        $selectedCustomer = Http::get("http://127.0.0.1:8000/api/users-api/{$customerId}")->json()['data'];


        return view('orders.create', compact('selectedCustomer', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat!');
    }
}