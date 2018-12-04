<div class="ui tiny modal js--complete-service-modal">
    <i class="close icon"></i>
    <div class="header">Biaya Servis</div>
    <div class="content">
        <p>Masukkan biaya servis untuk mengganti status servis menjadi <strong>Siap</strong>.</p>
        <form action="{{ $action ?? '' }}" class="ui form" method="post">
            @csrf
            @method('PUT')

            <div class="three fields">
                <div class="field">
                    <label for="number"># Servis</label>
                    <input type="text" name="number" id="number" value="{{ $number ?? '' }}" readonly>
                </div>
                <div class="field">
                    <label for="biaya">Biaya Servis</label>
                    <input type="text" name="biaya" id="biaya" value="0">
                </div>
                <div class="field">
                    <label>&nbsp;</label>
                    <button type="submit" class="ui positive button"><i class="checkmark icon"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>