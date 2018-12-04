@extends('layouts.app')

@section('title', 'Edit Servis')

@section('content')
    <div class="ui grid">
        @include('services.partials.header')

        <div class="row">
            <div class="column">
                <h3 class="ui header">Edit Servis</h3>
                
                <form action="{{ route('services.update', ['service' => $service->id]) }}" class="ui form {{ $errors->any() ? 'error' : '' }}" method="post" style="max-width: 500px;">
                    @csrf
                    @method('PUT')

                    <div class="two fields">
                        <div class="field {{ $errors->has('nama_pemilik') ? 'error' : '' }}">
                            <label for="nama_pemilik">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ old('nama_pemilik') ?? $service->owner_name }}">
                        </div>
                        <div class="field {{ $errors->has('nomor_handphone') ? 'error' : '' }}">
                            <label for="nomor_handphone">Nomor Handphone</label>
                            <input type="text" name="nomor_handphone" id="nomor_handphone" value="{{ old('nomor_handphone') ?? $service->phone_number }}">
                        </div>
                    </div>

                    <div class="two fields">
                        <div class="field {{ $errors->has('merk') ? 'error' : '' }}">
                            <label for="merk">Merk</label>
                            <input type="text" name="merk" id="merk" value="{{ old('merk') ?? $service->merk }}">
                        </div>
                        <div class="field {{ $errors->has('nomor_seri') ? 'error' : '' }}">
                            <label for="nomor_seri">Nomor Seri</label>
                            <input type="text" name="nomor_seri" id="nomor_seri" value="{{ old('nomor_seri') ?? $service->serial_number }}">
                        </div>
                    </div>
                   
                    <div class="two fields">
                        <div class="field {{ $errors->has('teknisi') ? 'error' : '' }}">
                            <label for="teknisi">Teknisi</label>
                            <input type="text" name="teknisi" id="teknisi" value="{{ old('teknisi') ?? $service->technician }}">
                        </div>
                        <div class="field {{ $errors->has('down_payment') ? 'error' : '' }}">
                            <label for="down_payment">Down Payment</label>
                            <input type="text" name="down_payment" id="down_payment" value="{{ old('down_payment') ?? $service->down_payment }}">
                        </div>
                    </div>

                    @if ($service->status === 1)
                        <div class="field">
                            <div class="field {{ $errors->has('biaya') ? 'error' : '' }}">
                                <label for="biaya">Biaya Servis</label>
                                <input type="text" name="biaya" id="biaya" value="{{ old('biaya') ?? $service->fee }}">
                            </div>
                        </div>
                    @endif

                    <div class="field {{ $errors->has('keterangan') ? 'error' : '' }}">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="5">{{ old('keterangan') ?? $service->note }}</textarea>
                    </div>
                    
                    <div class="field">
                        <button type="submit" class="ui primary button"><i class="save icon"></i> Update Servis</button>
                    </div>

                    @includeWhen($errors->any(), 'layouts.partials.error')
                </form>
            </div>
        </div>
    </div>
@endsection