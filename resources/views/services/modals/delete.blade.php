<div class="ui tiny modal" id="js--delete-service-modal">
    <i class="close icon"></i>
    <div class="header">
        Hapus Servis
    </div>
    <div class="content">
        <p>Yakin untuk menghapus servis # {{ $service->number }} ?</p>
    </div>
    <div class="actions">
        <button class="ui black deny button">Batal</button>
        <form action="{{ route('services.destroy', ['service' => $service->id]) }}" method="post" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="ui positive button"><i class="checkmark icon"></i> Ya, hapus servis</button>
        </form>
    </div>
</div>