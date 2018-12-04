<div class="row">
    <div class="column">
        <img src="{{ asset('images/logo.png') }}" class="ui centered tiny image">
        <div class="ui large secondary pointing menu" style="justify-content: center;">
            <a class="{{ Request::is('services*') ? 'active' : '' }} item" href="{{ route('services.index') }}">
                <i class="wrench icon"></i>
                Servis
            </a>
            <a class="{{ Request::is('deliveries*') ? 'active' : '' }} item" href="{{ route('deliveries.index') }}">
                <i class="truck icon"></i>
                Pengiriman
            </a>
            <a class="{{ Request::is('agents*') ? 'active' : '' }} item" href="{{ route('agents.index') }}">
                <i class="address card icon"></i>
                Agen
            </a>
            <a class="{{ Request::is('payments*') ? 'active' : '' }} item" href="{{ route('payments.index') }}">
                <i class="credit card icon"></i>
                Pembayaran
            </a>
            <a class="{{ Request::is('omset*') ? 'active' : '' }} item" href="{{ route('omset.index') }}">
                <i class="chart bar icon"></i>
                Omset
            </a>
            <a class="{{ Request::is('staff*') ? 'active' : '' }} item" href="{{ route('staff.index') }}">
                <i class="users icon"></i>
                Staff
            </a>
        </div>
    </div>
</div>