<table class="ui celled table">
    <thead>
        <tr>
            <th class="three wide column">Nomor Servis</th>
            <th class="two wide column">Tanggal</th>
            <th>Nama Pemilik</th>
            <th>Nomor HP</th>
            <th colspan="2">Nomor Seri</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
            <tr>
                <td><a href="{{ route('services.show', ['service' => $service->id]) }}">{{ $service->number }}</a> {!! $service->status_label !!}</td>
                <td>{{ $service->created_at->timezone('Asia/Jakarta')->format('d M Y') }}</td>
                <td>{{ $service->owner_name }}</td>
                <td>{{ $service->phone_number }}</td>
                <td>{{ $service->serial_number }}</td>
                <td class="two wide column">
                    <button class="ui icon positive tiny button js--show-complete-service-modal" {{ $service->status !== 0 ? 'disabled' : '' }} 
                        data-action="{{ route('services.complete', ['service' => $service->id]) }}" 
                        data-number="{{ $service->number }}">
                        <i class="checkmark icon"></i>
                    </button>
                    <button class="ui icon tiny button js--show-print-service-receipt-modal"
                        data-number="{{ $service->number }}"
                        data-date="{{ $service->formatted_created_at }}"
                        data-owner="{{ $service->owner_name }}"
                        data-merk="{{ $service->merk }}"
                        data-serial="{{ $service->serial_number }}"
                        data-dp="{{ $service->formatted_down_payment }}"
                        data-technician="{{ $service->technician }}"
                        data-note="{{ $service->note }}"
                        data-phone="{{ $service->phone_number }}">
                        <i class="print icon"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>