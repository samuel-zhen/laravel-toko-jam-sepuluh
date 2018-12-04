<div class="ui tiny modal" id="js--cancel-payment-service-modal">
    <i class="close icon"></i>
    <div class="header">Batal Pembayaran</div>
    <div class="content">
        <p>Batalkan pembayaran untuk #<strong>{{ $service->number }}</strong> ?</p>
    </div>
    <div class="actions">
        <button class="ui black deny button">Batal</button>
        <form action="{{ route('services.cancelPayment', ['service' => $service->id]) }}" method="post" style="display: inline-block">
            @csrf
            @method('PUT')
            <button type="submit" class="ui positive button"><i class="checkmark icon"></i> Ya, lanjutkan</button>
        </form>
    </div>
</div>