<!DOCTYPE html>
<head>
    <title>Berita Acara Seminar Proposal Skripsi</title>
    <meta charset="utf-8">
    <style>
        #judul{
            text-align:center;
        }

        #halaman{
            margin: 30px;
            width: 650px; 
            height: auto; 
            position: absolute; 
        }

        #kop {
            line-height: 1px;
        }

        hr{
            border-top: 4px double #000000;
        }

        .img {
            position: absolute; 
            top: 20px; 
            right: 545px;
       }

       h4{
           margin-bottom: -8px;
       }

       h5{
           margin-bottom: -1px;
       }

       #kop p{
           margin-bottom: -3px;
       }
          
       .border-collapse {
           border: 1px solid black;
           border-collapse: collapse;
       }

       #isi{
           margin-left: 90px;
       }

       /* pengaturan posisi tanda tangan */
       .flex-container {
            display: flex;
            flex-wrap: nowrap;
        }

        .flex-container > div {
            width: 100%;
            text-align: center;
        }

    </style>

</head>

<body>

    {{-- @if ($data_mhs && $data_proposal && $jadwal_ujian)     --}}
        <div id=halaman>
            <img class="img" src="{{ $img_logo }}" alt="" width="90px">
            <div id="kop" style="text-align: center;">
                <h3>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h3>
                <h3>UNIVERSITAS NEGERI MANADO</h3>
                <h3>FAKULTAS TEKNIK</h3>
                <h4>PROGRAM STUDI S1 TEKNIK INFORMATIKA</h4>
                <h5>ALAMAT : KAMPUS UNIMA TONDANO 95618 TELP.(0431)7233580</h5>
                <p style="color : rgb(7, 116, 204)">Web: ti.unima.ac.id  E-mail : teknikinformatika@unima.ac.id</p>
                <hr>
            </div>

            <table>
                <tr>
                    <td style="width: 80px;">No</td>
                    <td style="width: 15px;">:</td>
                    <td>...../......../TI/2024</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>Permohonan Kesediaan Lokasi Kerja Praktek</td>
                </tr>
            </table>
            <br>
            <div style="margin-left: 3px">
                <div>Kepada Yth:</div>
                <div>Kepala {{$pendaftaran?->instansi_kp ?? "-"}}</div>
                <div>di</div>
                <div style="margin-left: 50px">Tempat</div>
            </div>

            <div>
                <p>Dengan hormat,</p>
                <p style="text-align: justify; line-height: 25px">Sehubungan dengan kegiatan Kerja Praktek bagi mahasiswa Program Studi S1 Teknik Informatika Fakultas Teknik Universitas Negeri Manado, 
                    maka Pimpinan Program Studi S1 Teknik Informatika Fakultas Teknik Universitas Negeri Manado, dengan ini mengajukan permohonan kepada 
                    Bapak/Ibu untuk dapat kiranya menerima mahasiswa/i kami untuk melakukan Kegiatan Kerja Praktek di Instansi/perusahaan yang Bapak/Ibu pimpin. 
                    Besar harapan kami untuk dapat diterima ditempat Bapak/Ibu pimpin. Bersama surat ini terlampir nama mahasiswa:</p>
            </div>

            <table class="border-collapse" width="100%">
                <tr style="text-align: center; font-weight: bold;">
                    <td class="border-collapse" style="width: 5%;">NO</td>
                    <td class="border-collapse" style="width: 30%;">NAMA</td>
                    <td class="border-collapse" style="width: 30%;">NIM</td>
                </tr>
                <tr class="border-collapse">
                    <td class="" style="width: 5%; vertical-align: top; text-align: center; padding: 4px; border-right: 1px solid black; padding: 10px">1</td>
                    <td class="" style="width: 10%; vertical-align: top; text-align: center; padding: 4px; border-right: 1px solid black; padding: 10px">
                        {{$pendaftaran?->nama ?? "-"}}
                    </td>
                    <td class="" style="vertical-align: top; padding: 4px; border-right: 1px solid black; padding: 10px">
                        <div style="text-align: center">{{$pendaftaran?->nim ?? "-"}}</div>
                    </td>
                </tr>
            </table>

            <div style="text-align: justify">
                <p>Demikian permohonan ini, atas perhatian dan kerjasamanya diucapkan terima kasih.</p>
            </div>

            <br>

            <div style="width: 50%; text-align: left; float: right;">
                Koordinator Program Studi,<br>

                <img style="z-index: -10" src="{{ $img_ttd }}" alt="" height="70px"><br>
    
                <u>Vivi Peggie Rantung, ST,MISD</u>
                <br>
                NIP. 198630416 208812 2 002
            </div>

        </div>
</body>

</html>