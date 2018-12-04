@extends('layouts.app')

@section('title', 'Servis')

@section('content')
    <div class="ui grid">
        @include('services.partials.header')

        <div class="row">
            <div class="column">
                <div class="ui padded segment">
                    <p>Masukkan <strong>nomor servis</strong> / <strong>nama pemilik</strong> / <strong>nomor handphone</strong> untuk mencari data servis.</p>
                    <form method="get">
                        <div class="ui icon input">
                            <input type="text" name="q" placeholder="Cari nomor servis...">
                            <i class="search icon"></i>
                        </div>
                    </form>
    
                    @if (request('q'))
                        <div class="ui horizontal divider"></div>
                        <p>Kata kunci pencarian: <strong>{{ request('q') }}</strong>. <a href="{{ route('services.index') }}">Reset</a></p>
                    @endif
                </div>

                @if ($services->isEmpty())
                    @include('layouts.partials.empty', ['variable' => 'servis'])
                @else
                    @include('services.partials.table', ['services' => $services])

                    @if (!request('q'))
                        {{ $services->links() }}
                    @endif
                @endif
            </div>
        </div>
    </div>

    @include('services.modals.complete')
    @include('services.modals.print')
@endsection