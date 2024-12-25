<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Yajra\DataTables\Facades\DataTables;

class ReportingController extends Controller
{
    public function index()
    {

        $month = request('month') ?? date('m');
        $year = request('year') ?? date('Y');
        $status = request('status') ?? 'All';

        $listOfMonth = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        $listOfYear = [];
        for ($i = 2023; $i <= date('Y'); $i++) {
            $listOfYear[$i] = $i;
        }


        $orders = Payment::with('paymentorder.order.menus','users')
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year);
        if($status !='All'){
            $orders = $orders->where('status',$status);
        }
        $orders =  $orders->orderBy('id', 'desc')->get();

        return view('pages/report-management', compact('orders','listOfMonth','listOfYear','month','year','status'));
    }


    public function reporting_receipt(Request $request)
    {  
        $order = Payment::with('paymentorder.order.menus','paymentorder.order.addOn.menusAddon','users')->where('id', $request->id)->first();
       
        return view('pages.report-details',compact('order'));
    }
}
