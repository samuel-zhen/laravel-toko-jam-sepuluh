<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Delivery;
use Illuminate\Http\Request;

class AgentsController extends Controller
{
    public function index()
    {
        $agents = Agent::all();

        return view('agents.index', compact('agents'));
    }

    public function store()
    {
        request()->validate([
            'nama' => 'required|unique:agents,name',
        ]);

        Agent::create([
            'name' => request('nama'),
        ]);

        session()->flash('success', 'Data agen berhasil disimpan!');

        return redirect()->route('agents.index');
    }

    public function show(Agent $agent)
    {
        $deliveries = Delivery::where('agent_id', $agent->id)->orderBy('id', 'desc')->simplePaginate(20);

        return view('agents.show', compact('agent', 'deliveries'));
    }
    
    public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent'));
    }

    public function update(Agent $agent)
    {
        request()->validate([
            'nama' => 'required|unique:agents,name,' . $agent->id,
        ]);

        $agent->update(['name' => request('nama')]);

        session()->flash('success', 'Data agen berhasil diupdate!');

        return redirect()->route('agents.index');
    }

    public function destroy(Agent $agent)
    {
        foreach ($agent->deliveries as $delivery) {
            $delivery->services()->update(['delivery_id' => null]);
        }

        $agent->deliveries()->delete();

        $agent->delete();

        session()->flash('success', 'Data agen berhasil dihapus!');

        return redirect()->route('agents.index');
    }
}
