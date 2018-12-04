<div class="ui tiny modal" id="js--print-service-modal">
    <i class="close icon"></i>
    <div class="header">
        Print Nota Servis
    </div>
    <div class="content">
        <div class="receipt" id="js--service-receipt">
            <div class="receipt__header">
                <div class="receipt__header__logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Toko Jam Sepuluh">
                </div>
                <div class="receipt__header__text">
                    Toko Jam Sepuluh
                </div>
            </div>
            
            <div class="receipt__body">
                <div class="service-receipt__number">
                    # Servis
                    <h3 class="number js--service-number">{{ $serviceNumber ?? '' }}</h3>
                </div>
                <table class="service-receipt__information">
                    <tr>
                        <td class="service-receipt__attribute">Tanggal</td>
                        <td>:</td>
                        <td class="service-receipt__value" id="js--service-date">{{ $serviceDate ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="service-receipt__attribute">Nama Pemilik</td>
                        <td>:</td>
                        <td class="service-receipt__value" id="js--service-owner">{{ $serviceOwner ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="service-receipt__attribute">Merk</td>
                        <td>:</td>
                        <td class="service-receipt__value" id="js--service-merk">{{ $serviceMerk ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="service-receipt__attribute">Nomor Seri</td>
                        <td>:</td>
                        <td class="service-receipt__value" id="js--service-serial">{{ $serviceSerial ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="service-receipt__attribute">DP</td>
                        <td>:</td>
                        <td class="service-receipt__value" id="js--service-dp">{{ $serviceDP ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="service-receipt__attribute">Teknisi</td>
                        <td>:</td>
                        <td class="service-receipt__value" id="js--service-technician">{{ $serviceTechnician ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="service-receipt__attribute">Keterangan</td>
                        <td>:</td>
                        <td class="service-receipt__value" id="js--service-note">{{ $serviceNote ?? '' }}</td>
                    </tr>
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
            
            <div class="service-receipt__tag">
                <h3 class="js--service-number">{{ $serviceNumber ?? '' }}</h3>
                <span id="js--service-phone">{{ $servicePhone ?? '' }}</span>
            </div>
        </div>
    </div>
    <div class="actions">
        <button class="ui black deny button">Batal</button>
        <button class="ui primary button" id="js--print-service-receipt-button"><i class="print icon"></i> Print</button>
    </div>
</div>