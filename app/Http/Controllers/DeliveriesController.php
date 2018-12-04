<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Service;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{
    public function index()
    {
        if (request('q')) {
            $deliveries = Delivery::where('id', request('q'))->orderBy('created_at', 'desc')->get();
        } else {
            $deliveries = Delivery::orderBy('created_at', 'desc')->simplePaginate(20);
        }

        return view('deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        $agents = Agent::orderBy('name', 'desc')->get();
        $services = Service::where('status', 0)->where('delivery_id', null)->orderBy('created_at', 'desc')->get();

        return view('deliveries.create', compact('agents', 'services'));
    }

    public function store()
    {
        // Modify service numbers array
        $serviceNumbers = json_decode(request('servis'), true);
        request()->merge(['servis' => $serviceNumbers]);

        request()->validate([
            'nama_agen' => 'required',
            'servis' => 'required|array|min:1',
            'servis.*' => 'distinct',
        ]);

        $delivery = Delivery::create(['agent_id' => request('nama_agen')]);

        Service::whereIn('id', request('servis'))->update(['delivery_id' => $delivery->id]);

        session()->flash('success', 'Data pengiriman servis berhasil disimpan!');

        return redirect()->route('deliveries.index');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->services()->update(['delivery_id' => null]);

        $delivery->delete();
     
        session()->flash('success', 'Data pengiriman berhasil dihapus!');

        return redirect()->back();
    }
}
