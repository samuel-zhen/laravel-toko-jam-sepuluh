<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;

class OmsetController extends Controller
{
    public function index()
    {
        if (request('tanggal')) {
            $servicesWithDownPayment = Service::where('down_payment', '>', 0)
                                        ->whereDate('created_at', request('tanggal'))
                                        ->orderBy('created_at', 'desc')
                                        ->get();

            $servicesWithPayment = Payment::with('service')
                                    ->whereDate('created_at', request('tanggal'))
                                    ->orderBy('created_at', 'desc')
                                    ->get();

            return view('omset.index', compact('servicesWithDownPayment', 'servicesWithPayment'));
        }

        return view('omset.index');
    }
}
