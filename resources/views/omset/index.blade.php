@extends('layouts.app')

@section('title', 'Omset')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="column">
                <h1 class="ui orange dividing header">
                    Omset
                    <p class="sub header">Lihat omset servis toko.</p>
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="column">
                <p>Masukkan tanggal dan tekan tombol <strong>Tampilkan</strong> untuk melihat omset.</p>
                <form method="get" class="ui form" style="max-width: 400px">
                    <div class="inline field">
                        <input type="text" name="tanggal" id="tanggal" placeholder="yyyy-mm-dd">
                        <button class="ui primary button" type="submit"><i class="chart bar icon"></i> Tampilkan</button>
                    </div>
                </form>

                @if (request('tanggal'))
                    <div class="ui divider"></div>
                    <p>Menampilkan omset pada tanggal <strong>{{ request('tanggal') }}</strong>.</p>

                    <h4 class="ui dividing header">Down Payment</h4>
                    @php
                        $totalDownPayment = 0   
                    @endphp
                    @if ($servicesWithDownPayment->isEmpty())
                        <div class="ui message">
                            <p>Tidak ada omset dari down payment servis.</p>
                        </div>
                    @else
                        <table class="ui compact celled table">
                            <thead>
                                <tr>
                                    <th>Nomor Servis</th>
                                    <th>Nama Pemilik</th>
                                    <th>Merk</th>
                                    <th>Nomor Seri</th>
                                    <th>Down Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicesWithDownPayment as $service)
                                    <tr>
                                        <td><a href="{{ route('services.show', ['service' => $service->id]) }}">{{ $service->number }}</a></td>
                                        <td>{{ $service->owner_name }}</td>
                                        <td>{{ $service->merk }}</td>
                                        <td>{{ $service->serial_number }}</td>
                                        <td>{{ $service->formatted_down_payment }}</td>
                                    </tr>
                                    @php $totalDownPayment += $service->down_payment @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4"><strong>Total Down Payment</strong></th>
                                    <th>{{ 'Rp ' . number_format($totalDownPayment, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @endif

                    <h4 class="ui dividing header">Pembayaran</h4>
                    @php
                        $totalPayment = 0   
                    @endphp
                    @if ($servicesWithPayment->isEmpty())
                        <div class="ui message">
                            <p>Tidak ada omset dari pembayaran servis.</p>
                        </div>
                    @else
                        <table class="ui compact celled table">
                            <thead>
                                <tr>
                                    <th>Nomor Servis</th>
                                    <th>Nama Pemilik</th>
                                    <th>Down Payment</th>
                                    <th>Biaya Servis</th>
                                    <th>Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicesWithPayment as $payment)
                                    <tr>
                                        <td><a href="{{ route('services.show', ['service' => $payment->service->id]) }}">{{ $payment->service->number }}</a></td>
                                        <td>{{ $payment->service->owner_name }}</td>
                                        <td>{{ $payment->service->formatted_down_payment }}</td>
                                        <td>{{ $payment->service->formatted_fee }}</td>
                                        <td>{{ $payment->service->remaining_payment }}</td>
                                    </tr>
                                    @php $totalPayment += $payment->service->fee - $payment->service->down_payment @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4"><strong>Total Pembayaran</strong></th>
                                    <th>{{ 'Rp ' . number_format($totalPayment, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @endif

                    <h2 class="ui orange header">
                        <span class="sub header">Total Omset</span>
                        {{ 'Rp ' . number_format($totalDownPayment + $totalPayment, 0, ',', '.')}}
                    </h2>
                @endif
            </div>
        </div>
    </div>
@endsection