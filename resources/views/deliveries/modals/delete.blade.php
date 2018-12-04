<div class="ui tiny modal" id="js--delete-delivery-modal">
    <i class="close icon"></i>
    <div class="header">
        Batal Pengiriman
    </div>
    <div class="content">
        <p>Yakin untuk membatalkan pengiriman # <span id="js--delivery-number"></span> ?</p>
    </div>
    <div class="actions">
        <button class="ui black deny button">Batal</button>
        <form action="" method="post" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="ui positive button"><i class="checkmark icon"></i> Ya, hapus pengiriman</button>
        </form>
    </div>
</div>