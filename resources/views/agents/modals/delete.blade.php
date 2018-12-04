<div class="ui tiny modal" id="js--delete-agent-modal">
    <i class="close icon"></i>
    <div class="header">
        Hapus Agen
    </div>
    <div class="content">
        <p>Yakin untuk menghapus agen <strong>{{ $agent->name }}</strong> ?</p>
    </div>
    <div class="actions">
        <button class="ui black deny button">Batal</button>
        <form action="{{ route('agents.destroy', ['agent' => $agent->id]) }}" method="post" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="ui positive button"><i class="checkmark icon"></i> Ya, hapus agen</button>
        </form>
    </div>
</div>