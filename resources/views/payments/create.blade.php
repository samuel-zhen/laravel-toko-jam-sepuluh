<div class="ui tiny modal" id="js--payment-modal">
    <i class="close icon"></i>
    <div class="header">
        Pembayaran Servis
    </div>
    <div class="content">
        <div class="ui equal width grid">
            <div class="column">
                <h3 class="ui header">
                    <span class="sub header"># Servis</span>
                    <span id="js--service-number"></span>
                </h3>
            </div>
            <div class="column">
                <h3 class="ui header">
                    <span class="sub header">Down Payment</span>
                    <span id="js--down-payment"></span>
                </h3>
            </div>
        </div>
        <div class="ui equal width grid">
            <div class="column">
                <h3 class="ui header">
                    <span class="sub header">Biaya Servis</span>
                    <span id="js--fee"></span>
                </h3>
            </div>
            <div class="column">
                <h3 class="ui header">
                    <span class="sub header">Sisa Pembayaran</span>
                    <span id="js--remaining"></span>
                </h3>
            </div>
        </div>

        <div class="ui horizontal divider"></div>

        <form action="" method="post" class="ui form">
            @csrf
            <div class="two fields">
                <div class="field">
                    <label for="nama">Pengambilan Atas Nama</label>
                    <input type="text" name="nama" id="nama" value="">
                </div>
                <div class="field">
                    <label>&nbsp;</label>
                    <button type="submit" class="ui primary button"><i class="credit card icon"></i> Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>