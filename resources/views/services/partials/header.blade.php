<div class="row">
    <div class="column">
        <h1 class="ui orange dividing header">
            Servis
            <p class="sub header">Pengaturan data servis toko.</p>
        </h1>

        <div class="ui compact small menu">
            <a class="{{ Request::is('services') ? 'active' : '' }} item" href="{{ route('services.index') }}">
                <i class="list icon"></i> List
            </a>
            <a class="{{ Request::is('services/create') ? 'active' : '' }} item" href="{{ route('services.create') }}">
                <i class="plus icon"></i> Tambah
            </a>
        </div>
    </div>
</div>
