@extends('layouts.app')

@section('title', 'Pengiriman Servis')

@section('content')
    <div class="ui grid">
        @include('deliveries.partials.header')

        <div class="row">
            <div class="column">
                <form method="get">
                    <div class="ui icon input">
                        <input type="text" name="q" placeholder="Cari nomor pengiriman...">
                        <i class="search icon"></i>
                    </div>
                </form>

                @if (request('q'))
                    <div class="ui horizontal divider"></div>
                    <p>Pencarian: <strong>{{ request('q') }}</strong>. <a href="{{ route('deliveries.index') }}">Reset</a></p>
                @endif

                <div class="ui horizontal divider"></div>

                @if ($deliveries->isEmpty())
                    @include('layouts.partials.empty', ['variable' => 'pengiriman'])
                @else
                    @foreach ($deliveries as $delivery)
                        <div class="ui horizontal divider"></div>

                        <div class="ui stackable grid">
                            <div class="row">
                                <div class="two wide column">
                                    <h4 class="ui header">
                                        <span class="sub header"># Pengiriman</span>
                                        {{ $delivery->id }}
                                    </h4>
                                </div>
                                <div class="three wide column">
                                    <h4 class="ui header">
                                        <span class="sub header">Tanggal Pengiriman</span>
                                        {{ $delivery->formatted_created_at }}
                                    </h4>
                                </div>
                                <div class="eleven wide column">
                                    <h4 class="ui header">
                                        <span class="sub header">Nama Agen</span>
                                        <a href="{{ route('agents.show', ['agent' => $delivery->agent->id]) }}">{{ $delivery->agent->name }}</a>
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

                    @if (!request('q'))
                        {{ $deliveries->links() }}
                    @endif
                @endif
            </div>
        </div>
    </div>

    @include('services.modals.complete')
    @include('services.modals.print')

    @include('deliveries.modals.delete')
    @include('deliveries.modals.print')

@endsection