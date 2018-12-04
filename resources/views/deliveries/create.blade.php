@extends('layouts.app')

@section('title', 'Tambah Pengiriman Servis')

@section('content')
    <div class="ui grid">
        @include('deliveries.partials.header')

        <div class="row">
            <div class="column">
                <h3 class="ui header">Tambah Pengiriman Servis</h3>

                <form action="{{ route('deliveries.store') }}" method="post" class="ui form {{ $errors->any() ? 'error' : '' }}">
                    @csrf
                    <div class="inline field {{ $errors->has('nama_agen') ? 'error' : '' }}">
                        <label for="nama_agen">Nama Agen</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="nama_agen">
                            <i class="dropdown icon"></i>
                            <div class="default text">Pilih Agen</div>
                            <div class="menu">
                                @foreach ($agents as $agent)
                                    <div class="item" data-value="{{ $agent->id }}">{{ $agent->name }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <input type="hidden" name="servis" id="services">
                        <label>Nomor Servis: </label> 
                        <div class="ui message">
                            <p id="js--selected-services">Tidak ada servis yang terpilih.</p>
                        </div>
                    </div>
                    <div class="field">
                        <button type="submit" class="ui primary button"><i class="save icon"></i> Simpan</button>
                    </div>

                    @includeWhen($errors->any(), 'layouts.partials.error')
                </form>

                <div class="ui divider"></div>

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
                                    <td>
                                        <div class="inline field">
                                            <div class="ui checkbox js--select-service">
                                                <input type="checkbox" tabindex="0" class="hidden check" value="{{ $service->id }}" data-number="{{ $service->number }}">
                                                <label>Pilih</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection