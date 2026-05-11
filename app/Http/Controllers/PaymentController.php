<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    // Shows the payment history dashboard
    // Joins payments with members and plans for display
    // Computes total revenue, today's revenue, and total transaction count
    public function index()
    {
        $payments = DB::table('payments as p')
            ->join('members as m',          'p.member_id', '=', 'm.member_id')
            ->join('membership_plans as pl', 'p.plan_id',   '=', 'pl.plan_id')
            ->select(
                'p.payment_id',
                'p.receipt_no',
                'p.amount',
                'p.payment_method',
                'p.payment_type',
                'p.payment_date',
                DB::raw("CONCAT(m.first_name, ' ', m.last_name) AS member_name"),
                'pl.plan_name'
            )
            ->orderByDesc('p.payment_date')
            ->orderByDesc('p.payment_id')
            ->paginate(15);

        $totalRevenue  = DB::table('payments')->sum('amount');
        $todayRevenue  = DB::table('payments')->whereDate('payment_date', today())->sum('amount');
        $totalPayments = DB::table('payments')->count();

        return view('payment.index', compact(
            'payments',
            'totalRevenue',
            'todayRevenue',
            'totalPayments'
        ));
    }
}