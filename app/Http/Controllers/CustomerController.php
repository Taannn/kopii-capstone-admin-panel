<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Shipment;

class CustomerController extends Controller
{
    public function index()
    {
        $totalCount = Customer::count();
        $orders = CustomerOrder::latest()->whereIn('status', ['To Ship', 'To Receive'])->paginate(5);
        $completedOrders = CustomerOrder::where('status', 'Completed')->count();
        $cancelledOrders = CustomerOrder::where('status', 'Cancelled')->count();
        $totalSales = CustomerOrder::where('status', 'Completed')->sum('price');
        $orderDetail = false;
        $addressDetail = false;
        return view('dashboard.index', compact('totalCount', 'completedOrders', 'cancelledOrders', 'totalSales', 'orders', 'orderDetail', 'addressDetail'));
    }

    public function show($id) {
        $totalCount = Customer::count();
        $orders = CustomerOrder::latest()->whereIn('status', ['To Ship', 'To Receive'])->paginate(5);
        $completedOrders = CustomerOrder::where('status', 'Completed')->count();
        $cancelledOrders = CustomerOrder::where('status', 'Cancelled')->count();
        $totalSales = CustomerOrder::where('status', 'Completed')->sum('price');
        $orderDetail = CustomerOrder::findOrFail($id);
        $addressDetail = Shipment::findOrFail($id);
        return view('dashboard.index', compact('totalCount', 'completedOrders', 'cancelledOrders', 'totalSales', 'orders', 'orderDetail', 'addressDetail'));
    }

    public function shipOut($id)
    {
        $shipOut = CustomerOrder::findOrFail($id);
        $shipOut->update([
            'status' => 'To Receive',
            'status_message' => 'Your Order is out for Delivery'
        ]);
        return redirect()->route('dashboard')->with('success', 'Order KOPIIX100'. $shipOut->order_id . ' has been shipped out');
    }


}
