@extends('layouts.app')

@section('title', 'Edit Agen')

@section('content')
    <div class="ui grid">
        @include('agents.partials.header')

        <div class="row">
            <div class="six wide column">
                <h3 class="ui header">Edit Agen</h3>

                <form action="{{ route('agents.update', ['agent' => $agent->id]) }}" class="ui form {{ $errors->any() ? 'error' : '' }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="field {{ $errors->has('nama') ? 'error' : '' }}">
                        <label for="nama">Nama Agen</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') ?? $agent->name }}">
                    </div>
                    <div class="field">
                        <button class="ui primary button" type="submit"><i class="save icon"></i>Update</button>
                    </div>

                    @includeWhen($errors->any(), 'layouts.partials.error')
                </form>
            </div>
        </div>
    </div>
@endsection