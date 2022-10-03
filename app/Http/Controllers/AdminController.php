<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminController extends Controller
{
    public function admincp()
    {
        if (Auth::check()) {
            return $this->dashboard();
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("/")->with('failure', 'Invalid Credentials');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect("/")->with('success', 'Session Closed');
    }

    public function dashboard()
    {
        $orders_count = Order::count();
        $orders = Order::all();
        $customers = Customer::all();
        $paid_amount = 0;
        $total_amount = 0;
        foreach ($orders as $order) {
            $paid_amount = $paid_amount + $order->paid_amount;
            $total_amount = $total_amount + $order->total_amount;
        }
        $pending_amount = $total_amount - $paid_amount;
        $recent_orders = Order::latest()->get();
        return view('home', compact('paid_amount', 'total_amount', 'pending_amount', 'recent_orders', 'orders_count', 'customers'));
    }
}
