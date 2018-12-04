<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Service;
use App\Rules\Registered;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        if (request('q')) {
            $services = Service::where('id', ltrim(preg_replace('/[^0-9]/', '', request('q')), '0'))
                        ->orWhere('owner_name', 'like', '%' . request('q') . '%')
                        ->orWhere('phone_number', request('q'))
                        ->orderBy('created_at', 'desc')
                        ->get();
        } else {
            $services = Service::orderBy('created_at', 'desc')->simplePaginate(25);
        }

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store()
    {
        request()->merge(['down_payment' => str_replace('.', '', request('down_payment'))]);

        request()->validate([
            'nama_pemilik' => 'required',
            'nomor_handphone' => 'required',
            'merk' => 'required',
            'nomor_seri' => 'required',
            'down_payment' => 'nullable|numeric',
            'keterangan' => 'required',
            'password' => ['required', new Registered],
        ]);

        $staff = Staff::where('password', request('password'))->first();

        $service = $staff->services()->create([
            'owner_name' => request('nama_pemilik'),
            'phone_number' => request('nomor_handphone'),
            'merk' => request('merk'),
            'serial_number' => request('nomor_seri'),
            'technician' => request('teknisi'),
            'down_payment' => request('down_payment') === '' ? 0 : request('down_payment'),
            'note' => request('keterangan'),
        ]);

        session()->flash('success', 'Data servis berhasil disimpan!');

        return redirect()->route('services.show', ['service' => $service->id]);
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        if ($service->isCompleted()) {
            return redirect()->back();
        }

        return view('services.edit', compact('service'));
    }

    public function update(Service $service)
    {
        if ($service->isCompleted()) {
            return redirect()->back();
        }

        request()->merge(['down_payment' => str_replace('.', '', request('down_payment'))]);
        request()->merge(['biaya' => str_replace('.', '', request('biaya'))]);

        request()->validate([
            'nama_pemilik' => 'required',
            'nomor_handphone' => 'required',
            'merk' => 'required',
            'nomor_seri' => 'required',
            'down_payment' => 'nullable|numeric',
            'biaya' => 'nullable|numeric',
            'keterangan' => 'required',
        ]);

        $service->update([
            'owner_name' => request('nama_pemilik'),
            'phone_number' => request('nomor_handphone'),
            'merk' => request('merk'),
            'serial_number' => request('nomor_seri'),
            'technician' => request('teknisi'),
            'down_payment' => request('down_payment') === '' ? 0 : request('down_payment'),
            'fee' => request('biaya') === '' ? 0 : request('biaya'),
            'note' => request('keterangan'),
        ]);

        session()->flash('success', 'Data servis #' . $service->number . ' berhasil diupdate!');

        return redirect()->route('services.show', ['service' => $service->id]);
    }

    public function destroy(Service $service)
    {
        $number = $service->number;

        if ($service->payment) {
            $service->payment->delete();
        }
        $service->delete();
     
        session()->flash('success', 'Data servis #' . $number . ' berhasil dihapus!');

        return redirect()->route('services.index');
    }

    public function reservice(Service $service)
    {
        if ($service->isCompleted()) {
            return redirect()->back();
        }

        $service->reservice();

        session()->flash('success', 'Status servis #' . $service->number . ' berhasil diganti!');

        return redirect()->route('services.show', compact('service'));
    }

    public function complete(Service $service)
    {
        if ($service->isCompleted()) {
            return redirect()->back();
        }

        request()->merge(['biaya' => str_replace('.', '', request('biaya'))]);

        $service->complete(request('biaya'));

        session()->flash('success', 'Biaya servis #' . $service->number . ' berhasil disimpan!');

        return redirect()->back();
    }

    public function cancelDelivery(Service $service)
    {
        if ($service->isCompleted()) {
            return redirect()->back();
        }

        $service->cancelDelivery();

        session()->flash('success', 'Pengiriman servis #' . $service->number . ' berhasil dibatalkan!');

        return redirect()->back();
    }
   
    public function cancelPayment(Service $service)
    {
        $service->cancelPayment();

        session()->flash('success', 'Pembayaran servis #' . $service->number . ' berhasil dibatalkan!');

        return redirect()->back();
    }
}
