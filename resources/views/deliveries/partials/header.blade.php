<div class="row">
    <div class="column">
        <h1 class="ui orange dividing header">
            Pengiriman Servis
            <p class="sub header">Pengaturan data pengiriman servis toko.</p>
        </h1>

        <div class="ui compact small menu">
            <a class="{{ Request::is('deliveries') ? 'active' : '' }} item" href="{{ route('deliveries.index') }}">
                <i class="list icon"></i> List
            </a>
            <a class="{{ Request::is('deliveries/create') ? 'active' : '' }} item" href="{{ route('deliveries.create') }}">
                <i class="plus icon"></i> Tambah
            </a>
        </div>
    </div>
</div>
