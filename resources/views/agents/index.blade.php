@extends('layouts.app')

@section('title', 'Agen')

@section('content')
    <div class="ui stackable grid">
        @include('agents.partials.header')

        <div class="row">
            <div class="six wide column">
                <h3 class="ui header">Tambah Agen</h3>

                <form action="{{ route('agents.store') }}" class="ui form {{ $errors->any() ? 'error' : '' }}" method="POST">
                    @csrf

                    <div class="field {{ $errors->has('nama') ? 'error' : '' }}">
                        <label for="nama">Nama Agen</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}">
                    </div>
                    <div class="field">
                        <button class="ui primary button" type="submit"><i class="save icon"></i>Simpan</button>
                    </div>

                    @includeWhen($errors->any(), 'layouts.partials.error')
                </form>
            </div>

            <div class="one wide column"></div>

            <div class="nine wide column">
                <h3 class="ui header">Daftar Agen</h3>

                @if ($agents->isEmpty())
                    @include('layouts.partials.empty', ['variable' => 'agen'])
                @else
                    <table class="ui celled table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jumlah Pengiriman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('agents.show', ['agent' => $agent->id]) }}">{{ $agent->name }}</a></td>
                                    <td>{{ $agent->deliveries->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection