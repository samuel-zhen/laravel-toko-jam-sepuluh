<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        if (request('q')) {
            $services = Service::where('status', 1)
                        ->where('id', ltrim(preg_replace('/[^0-9]/', '', request('q')), '0'))
                        ->get();
        } else {
            $services = Service::where('status', 1)->orderBy('created_at', 'desc')->simplePaginate(25);
        }

        return view('payments.index', compact('services'));
    }

    public function store(Service $service)
    {
        $service->payment()->create([
            'name' => request('nama') ?? $service->owner_name,
        ]);

        $service->done();

        session()->flash('success', 'Pembayaran servis #' . $service->number . ' berhasil!');

        return redirect()->back();
    }
}
