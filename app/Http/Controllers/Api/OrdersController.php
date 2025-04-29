<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\orderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return new orderResource($orders, "Success", "List Of Orders");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return new orderResource(null, 'Failed', $validator->errors());
        }

        $order = Order::create($request->all());
        return new orderResource($order, 'Success', 'Order Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update($request->all());
            return new orderResource($order, 'Success', 'Order Showed Successfully');
        } else {
            return new orderResource(null, 'Failed', 'Order Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return new orderResource(null, 'Failed', $validator->errors());
        }

        $order = Order::find($id);
        if ($order) {
            $order->update([
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);

            return new orderResource($order, "Success", "Order Edited Successfully");
        } else {
            return new orderResource(null, "Failed", "Order Not Found");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return new orderResource(true, "Success", "Order Deleted Successfully");
        } else {
            return new orderResource(null, "Failed", "Order Not Found");
        }
    }
}
