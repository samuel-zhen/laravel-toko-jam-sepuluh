@extends('layouts.app')

@section('title', 'Staff')

@section('content')
    <div class="ui stackable grid">
        @include('staff.header')

        <div class="row">
            <div class="six wide column">
                <h3 class="ui header">Tambah Staff</h3>

                <form action="{{ route('staff.store') }}" class="ui form {{ $errors->any() ? 'error' : '' }}" method="POST">
                    @csrf

                    <div class="field {{ $errors->has('nama') ? 'error' : '' }}">
                        <label for="nama">Nama Staff</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}">
                    </div>
                    <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="field">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation">
                    </div>
                    <div class="field">
                        <button class="ui primary button" type="submit"><i class="save icon"></i>Simpan</button>
                    </div>

                    @includeWhen($errors->any(), 'layouts.partials.error')
                </form>
            </div>

            <div class="one wide column"></div>

            <div class="nine wide column">
                <h3 class="ui header">Daftar Staff</h3>

                @if ($staff->isEmpty())
                    @include('layouts.partials.empty', ['variable' => 'staff'])
                @else
                    <table class="ui celled table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jumlah Servis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff as $person)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td>{{ $person->services->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection