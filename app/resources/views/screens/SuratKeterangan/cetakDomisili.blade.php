<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Surat Keteranga Usaha</title>
        <style>
            body {
                margin: 0%;
                padding: 0%;
                font-family: Arial, sans-serif;
            }
            .dataTable {
                width: 100%;
                border-collapse: collapse;
            }
            .dataTable, .head, .tdData {
                border-color: black;
            }
            .head {
                padding: 8px;
                text-align: center;
                font-size: 14px;
            }
            .tdData {
                padding: 8px;
                text-align: left;
                font-size: 12px;
            }
            .tabelKopSurat{
                /* border: 1px solid black; */
                width: 100%;
                border-collapse: collapse;
                align-items: center;
                text-align: center;
                border-bottom: 1px solid black;
            }
            .abc {
                width: 70px;
                margin-bottom: 10px;
                filter: grayscale(100%);
            }
            .pemkot{
                font-size: 30px;
                font-weight: bolder;
                text-align: center;
            }
            .kecamatan{
                font-size: 25px;
                font-weight: bolder;
                text-align: center;
            }
            .kelurahan{
                font-size: 20px;
                font-weight: bolder;
                text-align: center;
            }
            .desa {
                font-size: 12px;
                text-align: center;
            }
            .kanan{
                /* background-color: red; */
                text-align: center;
                align-items: center;
            }
            .kiri{
                line-height: 20px;
            }
            .tanggalLaporan{
                font-size: 15px;
            }

            .tab{
                text-align: justify;
                text-indent: 2em; /* Anda dapat mengubah nilai ini sesuai kebutuhan */
            }

            .kedua{
                margin-left: 100px;
            }

            .tanda_tangan {
                /* background-color: red; */
                max-width: 400px;
                margin-left: 60%;
                text-align: right;
                margin-right: 35px; /* Anda bisa menyesuaikan nilai ini sesuai kebutuhan */
                display: flex; /* Mengubah display menjadi flex */
                justify-content: flex-end; /* Menggeser konten ke kanan */
                align-items: center; /* Mengatur elemen ke tengah vertikal */
            }

            .tanda_tangan p {
                margin: 0; /* Menghapus margin default pada elemen <p> */
                text-align: center; /* Mengatur teks dalam elemen <p> menjadi center */
            }


            .nama_pembuat{
               /* background-color: red; */
                max-width: 400px;
                margin-left: 60%;
                text-align: right;
                margin-right: 35px; /* Anda bisa menyesuaikan nilai ini sesuai kebutuhan */
                display: flex; /* Mengubah display menjadi flex */
                justify-content: flex-end; /* Menggeser konten ke kanan */
                align-items: center; /* Mengatur elemen ke tengah vertikal */
            }
            .nama_pembuat p {
                margin: 0; /* Menghapus margin default pada elemen <p> */
                text-align: center; /* Mengatur teks dalam elemen <p> menjadi center */
            }

        </style>
    </head>

    <body>
        
        <table class="tabelKopSurat">
            <tr class="barisKop">
                <td class="kanan"><img class="abc" src="assets/images/kop-gray.jpg" alt=""></td>
                <td class="kiri">
                    <div class="pemkot">PEMERINTAH KOTA PALEMBANG</div>
                    <div class="kecamatan">KECAMATAN ILIR TIMUR TIGA</div>
                    <div  class="kelurahan">KELURAHAN SEMBILAN ILIR</div>
                    <div  class="desa">
                        <strong>Jalan Mayor Ruslan No.001 RT.28 RW.05 Palembang</strong>
                    </div>
                </td>
            </tr>
        </table>

        <div class="container">
            <center>
                <h3><u>SURAT KETERANGAN DOMISILI USAHA</u></h3>Nomor: 145/{{ $getData->id }}/18.1002/2024
            </center>
        </div>

        <div class="awal" style="text-align: justify">
            <p>1. Yang bertanda tangan dibawah ini:</p>
            <table>
                <tr>
                    <td width="30px">a. </td>
                    <td>Nama</td>
                    <td>:</td>
                    <td>BENI YULIANSYAH, SH</td>
                </tr>
                <tr>
                    <td>b. </td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>SEKRETARIS LURAH SEMBILAN ILIR</td>
                </tr>
            </table>
        </div>

        <div class="awal" style="text-align: justify">
            <P style="margin-left: 32px">Dengan ini menerangkan, bahwa:</P>
            <table>
                <tr>
                    <td width="30px">a. </td>
                    <td width="150px">Nama</td>
                    <td width="15px">:</td>
                    <td>{{ $getData->name }}</td>
                </tr>

                <tr>
                    <td width="30px">b. </td>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $getData->nik }}</td>
                </tr>

                <tr>
                    <td width="30px">c. </td>
                    <td>Tempat/Tgl Lahir</td>
                    <td>:</td>
                    <td>{{ $getData->getUser->tempat_lahir }}, {{ Carbon\Carbon::parse($getData->getUser->tgl_lahir)->format('d-m-Y') }}</td>
                </tr>

                <tr>
                    <td width="30px">d. </td>
                    <td>Kebangsaan</td>
                    <td>:</td>
                    <td>
                        @if ( $getData->getUser->kebangsaan == 'WNI') 
                            WNI
                        @else
                            WNA
                        @endif
                    </td>
                </tr>

                <tr>
                    <td width="30px">e. </td>
                    <td>Agama</td>
                    <td>:</td>
                    <td>
                        @if ( $getData->getUser->agama == 'Islam') 
                            Islam
                        @elseif ($getData->getUser->agama == 'Khatolik')
                            Khatolik
                        @elseif ($getData->getUser->agama == 'Kristen')
                            Kristen
                        @elseif ($getData->getUser->agama == 'Buddha')
                            Buddha
                        @elseif ($getData->getUser->agama == 'Hindu')
                            Hindu
                        @elseif ($getData->getUser->agama == 'Agama_Kepercayaan')
                            Agama Kepercayaan
                        @endif
                    </td>
                </tr>

                <tr>
                    <td width="30px">f. </td>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        @if ( $getData->getUser->jenis_kelamin == 'L') 
                            Laki-Laki
                        @else
                            Perempuan
                        @endif
                    </td>
                </tr>

                <tr>
                    <td width="30px">g. </td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $getData->getUser->alamat }}</td>
                </tr>
            
            </table>
        </div>

        <div class="ketiga tab" style="text-align: justify">
            <p>
                Sesuai dengan  Nomor Induk Kependudukan: {{ $getData->nik }} adalah penduduk dengan alamat tersebut diatas, dan 
                Berdasarkan Surat Pernyataan dan Keterangan dari Ketuan RT. {{ $getData->getRT->wilayah_rt }} tanggal {{ Carbon\Carbon::now()->format('d-m-Y') }}
                bahwa yang bersangkutan adalah Penanggung Jawab dan Pemilik Usaha dari:

            </p>
            <table style="margin-left: 18%">
                <tr>
                    <td width="150px">Nama Usaha</td>
                    <td width="15px">:</td>
                    <td>{{ $getData->nama_usaha }}</td>
                </tr>
                <tr>
                    <td width="150px">Jenis Usaha</td>
                    <td width="15px">:</td>
                    <td>{{ $getData->getKategori->nama_kategori }}</td>
                </tr>
                <tr>
                    <td width="150px">Alamat</td>
                    <td width="15px">:</td>
                    <td>{{ $getData->alamat_usaha }}</td>
                </tr>
            </table>
        </div>

        <div class="kelima" style="text-align: justify">
            <p>
                Demikian Surat Keterangan ini dibuat untuk izin usaha pada wilayah Kelurahan Sembilan Ilir
            </p>
        </div>

        <br><br>
        <div class="tanda_tangan">
            <p>
                <span>Palembang, {{ Carbon\Carbon::now()->format('d-m-Y') }}</span><br>
                <span>a.n. LURAH SEMBILAN ILIR</span>
                <span>Sekretaris</span>
            </p>
        </div>
        
<br><br>
<br><br><br>
        <div class="nama_pembuat">
            <p> 
                BENI YULIANSYAH, SH
                <strong>NIP:197707262007011003</strong>
            </p>
        </div>

    </body>
</html>
