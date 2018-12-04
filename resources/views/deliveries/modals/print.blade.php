<div class="ui tiny modal" id="js--print-delivery-modal">
    <i class="close icon"></i>
    <div class="header">
        Print Nota Pengiriman
    </div>
    <div class="content">
        <div class="receipt" id="js--delivery-receipt">
            <div class="receipt__header">
                <div class="receipt__header__logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Toko Jam Sepuluh">
                </div>
                <div class="receipt__header__text">
                    Toko Jam Sepuluh
                </div>
            </div>
            
            <div class="receipt__body">
                <p>
                    Tanjungpinang, <span id="js--delivery-date"></span><br>
                    Kepada Agen: <span id="js--delivery-agent"></span>
                </p>

                <table class="ui very compact celled table delivery-receipt">
                    <tr>
                        <td>Qty</td>
                        <td>Servis</td>
                        <td>Keterangan</td>
                    </tr>
                    <tbody id="js--delivery-services">
                        {{--  --}}
                    </tbody>
                </table>
            </div>
            
            <div class="receipt__footer">
                <p>
                    TokoJamSepuluh <br>
                    Komplek Plaza Bintan Center <br>
                    JL. D.I. Panjaitan KM.9 Blok Batang No.8 Tanjungpinang 29125 <br>
                    (Di Belakang Bank BNI 46 KM.9) <br>
                    Telp. 0771 7447110 || HP. 0853 6520 9643 <br>
                    Email. tokojamsepuluh@gmail.com <br>
                </p>
            </div>
        </div>
    </div>
    <div class="actions">
        <button class="ui black deny button">Batal</button>
        <button class="ui primary button" id="js--print-delivery-receipt-button"><i class="print icon"></i> Print</button>
    </div>
</div>