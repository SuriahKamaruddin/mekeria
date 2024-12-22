<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Yajra\DataTables\Facades\DataTables;

class ReportingController extends Controller
{
    public function index()
    {

        $month = request('month') ?? date('m');
        $year = request('year') ?? date('Y');

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


        return view('pages/report-management', compact('listOfMonth', 'listOfYear', 'month', 'year'));
    }


    public function reporting_datatable(Request $request)
    {   $month = request('month') ?? date('m');
        $year = request('year') ?? date('Y');
        $status = request('status');
        if ($request->ajax()) {
            $orders = Order::with(['users', 'menus', 'addOn.menusAddon'])
            ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
                if($status !='All'){
                    $orders->where('status',$status);
                }

                $orders =  $orders->get();


            return Datatables::of($orders)
                ->addIndexColumn()
                ->addColumn('addon_names', function ($order) {
                    return $order->addOn && $order->addOn->isNotEmpty()
                        ? $order->addOn->map(fn($addon) => $addon->menusAddon->name)->join(', ')
                        : '';
                })
                ->addColumn('status_label', function ($order) {
                    $statuses = [
                        0 => 'Cart',
                        1 => 'New Order',
                        2 => 'Preparing',
                        3 => 'Delivered',
                        4 => 'Pickup',
                    ];

                    return $statuses[$order->status] ?? 'Unknown';
                })
                ->addColumn('price_formatted', function ($order) {
                    return number_format($order->price, 2); // Format unit price to 2 decimal places
                })
                ->addColumn('subtotal_formatted', function ($order) {
                    return number_format($order->subtotal, 2); // Format subtotal to 2 decimal places
                })
                ->addColumn('created_at_formatted', function ($order) {
                    return $order->created_at->format('d-M-Y');
                })
                ->addColumn('updated_at_formatted', function ($order) {
                    return $order->updated_at->format('d-M-Y');
                })
                ->rawColumns(['addon_names', 'status_label'])
                ->make(true);
        }

        return view('reporting.index');
    }
}
