@extends('layouts.app')

@section('title', 'Data Agen')

@section('content')
    <div class="ui grid">
        @include('agents.partials.header')

        <div class="row">
            <div class="column">
                <h3 class="ui header">Data Agen</h3>

                <div class="ui grid">
                    <div class="row">
                        <div class="eight wide mobile six wide tablet three wide computer column"><strong>Nama</strong></div>
                        <div class="eight wide mobile ten wide tablet thirteen wide computer column">{{ $agent->name }}</div>
                    </div>
                    <div class="row">
                        <div class="eight wide mobile six wide tablet three wide computer column"><strong>Jumlah Pengiriman</strong></div>
                        <div class="eight wide mobile ten wide tablet thirteen wide computer column">{{ $agent->deliveries->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <a href="{{ route('agents.edit', ['agent' => $agent->id]) }}" class="ui yellow button"><i class="edit icon"></i> Edit</a>
                <button class="ui red button" id="js--show-delete-agent-modal"><i class="trash icon"></i> Hapus</button></a>

                <h3>Daftar Pengiriman</h3>

                @if ($deliveries->isEmpty())
                    @include('layouts.partials.empty', ['variable' => 'pengiriman'])
                @else
                    @foreach ($deliveries as $delivery)
                        <div class="ui horizontal divider"></div>

                        <div class="ui grid">
                            <div class="row">
                                <div class="eight wide mobile four wide tablet two wide computer column">
                                    <h4 class="ui header">
                                        <span class="sub header"># Pengiriman</span>
                                        {{ $delivery->id }}
                                    </h4>
                                </div>
                                <div class="eight wide mobile twelve wide tablet fourteen wide computer column">
                                    <h4 class="ui header">
                                        <span class="sub header">Tanggal Pengiriman</span>
                                        {{ $delivery->formatted_created_at }}
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                    @php
                                        $serviceNumbers = $delivery->services->map(function ($service) {
                                            return $service->number;
                                        });
                                    @endphp

                                    <button class="ui basic primary button js--show-print-delivery-modal"
                                        data-date="{{ $delivery->created_at->timezone('Asia/Jakarta')->format('d M Y') }}"
                                        data-agent="{{ $delivery->agent->name }}"
                                        data-numbers='@json($serviceNumbers)'
                                        data-services='@json($delivery->services)'>
                                        <i class="print icon"></i> Print Nota Pengiriman
                                    </button>

                                    <button class="ui basic negative button js--show-delete-delivery-modal" 
                                        data-action="{{ route('deliveries.destroy', ['destroy' => $delivery->id]) }}" 
                                        data-number="{{ $delivery->id }}">
                                        <i class="cancel icon"></i>Batal Pengiriman
                                    </button>
                                </div>
                            </div>
                        </div>

                        @include('services.partials.table', ['services' => $delivery->services])

                        <div class="ui horizontal divider"></div>
                        <div class="ui divider"></div>
                        <div class="ui horizontal divider"></div>
                    @endforeach

                    {{ $deliveries->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('agents.modals.delete')

    @include('services.modals.complete')
    @include('services.modals.print')
    
    @include('deliveries.modals.delete')
    @include('deliveries.modals.print')

@endsection