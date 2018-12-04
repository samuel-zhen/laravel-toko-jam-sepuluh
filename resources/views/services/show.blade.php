@extends('layouts.app')

@section('title', 'Data Servis')

@section('content')
    <div class="ui stackable grid">
        @include('services.partials.header')

        <div class="row">
            <div class="column">
                <h2 class="ui header">
                    <span class="sub header"># Servis</span>
                    {{ $service->number }}
                    {!! $service->status_label !!}
                </h2>
            </div>
        </div>

        <div class="row">
            {{-- Basic Information --}}
            <div class="eight wide column">
                <div class="ui grid">
                    <div class="row">
                        <div class="five wide column"><strong>Tanggal Terima</strong></div>
                        <div class="ten wide column">{{ $service->formatted_created_at }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Nama Pemilik</strong></div>
                        <div class="ten wide column">{{ $service->owner_name }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Nomor Handphone</strong></div>
                        <div class="ten wide column">{{ $service->phone_number }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Merk</strong></div>
                        <div class="ten wide column">{{ $service->merk }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Nomor Seri</strong></div>
                        <div class="ten wide column">{{ $service->serial_number }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Down Payment</strong></div>
                        <div class="ten wide column">{{ $service->formatted_down_payment }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Teknisi</strong></div>
                        <div class="ten wide column">{{ $service->technician }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Keterangan</strong></div>
                        <div class="ten wide column">{{ $service->note }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Staff Penerima</strong></div>
                        <div class="ten wide column">{{ $service->staff->name }}</div>
                    </div>
                    <div class="row">
                        <div class="five wide column"><strong>Perubahan Terakhir</strong></div>
                        <div class="ten wide column">{{ $service->formatted_updated_at }}</div>
                    </div>
                </div>
            </div>

            <div class="eight wide column">
                <div class="ui grid">
                    {{-- Fee Information --}}
                    <div class="row">
                        <div class="column">
                            <h4 class="ui dividing orange header">Biaya Servis</h4>
                        </div>
                    </div>
                    @if ($service->isDone() ||$service->isCompleted())
                        <div class="row">
                            <div class="five wide column"><strong>Biaya</strong></div>
                            <div class="ten wide column">{{ $service->formatted_fee ?? '---' }}</div>
                        </div>
                        <div class="row">
                            <div class="five wide column"><strong>Sisa Pembayaran</strong></div>
                            <div class="ten wide column">{{ $service->remaining_payment ?? '---' }}</div>
                        </div>
                    @else
                        <div class="row">
                            <div class="column">
                                <div class="ui message"><p>Nomor servis ini belum siap.</p></div>
                            </div>
                        </div>
                    @endif

                    {{-- Delivery Information --}}
                    <div class="row">
                        <div class="column">
                            <h4 class="ui dividing orange header">Pengiriman Servis</h4>
                        </div>
                    </div>
                    @if ($service->delivery)
                        <div class="row">
                            <div class="five wide column"><strong>Servis Agen</strong></div>
                            <div class="ten wide column">{{ $service->delivery->agent->name ?? '---' }}</div>
                        </div>
                        <div class="row">
                            <div class="five wide column"><strong>Tanggal Pengiriman</strong></div>
                            <div class="ten wide column">{{ $service->delivery->formatted_created_at ?? '---' }}</div>
                        </div>
                        <div class="row">
                            <div class="five wide column"><strong>Nomor Pengiriman</strong></div>
                            <div class="ten wide column">{{ $service->delivery->id ?? '---' }}</div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <p><a href="#" id="js--show-cancel-delivery-modal"><i class="close icon"></i> Batal Pengiriman</a></p>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="column">
                                <div class="ui message"><p>Tidak ada pengiriman untuk nomor servis ini.</p></div>
                            </div>
                        </div>
                    @endif

                    {{-- Payment Information --}}
                    <div class="row">
                        <div class="column">
                            <h4 class="ui dividing orange header">Pembayaran</h4>
                        </div>
                    </div>
                    @if ($service->isCompleted())
                        <div class="row">
                            <div class="five wide column"><strong>Tanggal Pengambilan</strong></div>
                            <div class="ten wide column">{{ $service->payment->formatted_created_at ?? '---' }}</div>
                        </div>
                        <div class="row">
                            <div class="five wide column"><strong>Pengambilan a.n.</strong></div>
                            <div class="ten wide column">{{ $service->payment->name ?? '---' }}</div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <p><a href="#" id="js--show-cancel-payment-modal"><i class="close icon"></i> Batal Pembayaran</a></p>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="column">
                                <div class="ui message"><p>Belum ada pembayaran untuk nomor servis ini.</p></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column">
                @if ($service->isProcess())
                    <button class="ui positive button js--show-complete-modal"><i class="checkmark icon"></i> Servis Siap</button>
                @endif
                @if ($service->isDone())
                    <button class="ui blue button" id="js--show-reservice-modal"><i class="wrench icon"></i> Servis Kembali</button>
                @endif
                @if (!$service->isCompleted())
                    <a class="ui yellow button" href="{{ route('services.edit', ['service' => $service->id]) }}"><i class="edit icon"></i> Edit</a>
                @endif
                <button class="ui red button" id="js--show-delete-service-modal"><i class="trash icon"></i> Hapus</button>
                <button class="ui button" id="js--show-print-service-modal"><i class="print icon"></i> Print Nota</button>
            </div>
        </div>
    </div>

    @if ($service->isDone())
        @include('services.modals.reservice')
    @endif
    
    @if ($service->isProcess())
        @component('services.modals.complete')
            @slot('action')
                {{ route('services.complete', ['service' => $service->id]) }}
            @endslot
            @slot('number')
                {{ $service->number }}
            @endslot
        @endcomponent
    @endif

    @component('services.modals.print')
        @slot('serviceNumber'){{ $service->number }}@endslot
        @slot('serviceDate'){{ $service->formatted_created_at }}@endslot
        @slot('serviceOwner'){{ $service->owner_name }}@endslot
        @slot('serviceMerk'){{ $service->merk }}@endslot
        @slot('serviceSerial'){{ $service->serial_number }}@endslot
        @slot('serviceDP'){{ $service->formatted_down_payment }}@endslot
        @slot('serviceTechnician'){{ $service->technician }}@endslot
        @slot('serviceNote'){{ $service->note }}@endslot
        @slot('servicePhone'){{ $service->phone_number }}@endslot
    @endcomponent

    @include('services.modals.delete')
    @include('services.modals.cancel-delivery')
    @include('services.modals.cancel-payment')

@endsection