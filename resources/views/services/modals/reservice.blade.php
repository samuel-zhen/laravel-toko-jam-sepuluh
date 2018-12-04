<div class="ui tiny modal" id="js--reservice-service-modal">
    <i class="close icon"></i>
    <div class="header">Servis Kembali</div>
    <div class="content">
        <p>Hapus biaya servis dan mengganti status servis #<strong>{{ $service->number }}</strong> menjadi <strong>Servis</strong> ?</p>
    </div>
    <div class="actions">
        <button class="ui black deny button">Batal</button>
        <form action="{{ route('services.reservice', ['service' => $service->id]) }}" method="post" style="display: inline-block">
            @csrf
            @method('PUT')
            <button type="submit" class="ui positive button"><i class="checkmark icon"></i> Ya, lanjutkan</button>
        </form>
    </div>
</div>