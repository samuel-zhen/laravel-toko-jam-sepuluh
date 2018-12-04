@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
    <div class="ui grid">
        @include('payments.partials.header')

        <div class="row">
            <div class="column">
                <form method="get">
                    <div class="ui icon input">
                        <input type="text" name="q" placeholder="Cari nomor servis...">
                        <i class="search icon"></i>
                    </div>
                </form>

                @if (request('q'))
                    <div class="ui horizontal divider"></div>
                    <p>Kata kunci pencarian: <strong>{{ request('q') }}</strong>. <a href="{{ route('payments.index') }}">Reset</a></p>
                @endif

                @if ($services->isEmpty())
                    @include('layouts.partials.empty', ['variable' => 'servis'])
                @else
                    <table class="ui celled table">
                        <thead>
                            <tr>
                                <th class="three wide column">Nomor Servis</th>
                                <th class="two wide column">Tanggal</th>
                                <th>Nama Pemilik</th>
                                <th>Nomor HP</th>
                                <th>Merk</th>
                                <th colspan="2">Nomor Seri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td><a href="{{ route('services.show', ['service' => $service->id]) }}">{{ $service->number }}</a> {!! $service->status_label !!}</td>
                                    <td>{{ $service->created_at->timezone('Asia/Jakarta')->format('d M Y') }}</td>
                                    <td>{{ $service->owner_name }}</td>
                                    <td>{{ $service->phone_number }}</td>
                                    <td>{{ $service->merk }}</td>
                                    <td>{{ $service->serial_number }}</td>
                                    <td class="one wide column">
                                        <button class="ui icon positive small button js--show-payment-modal"
                                            data-action="{{ route('payments.store', ['service' => $service->id]) }}"
                                            data-number="{{ $service->number }}"
                                            data-down-payment="{{ $service->formatted_down_payment }}"
                                            data-fee="{{ $service->formatted_fee }}"
                                            data-remaining="{{ $service->remaining_payment }}"
                                            data-name="{{ $service->owner_name }}">
                                            <i class="credit card icon"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if (!request('q'))
                        {{ $services->links() }}
                    @endif
                @endif
            </div>
        </div>
    </div>

    @include('payments.create')
@endsection