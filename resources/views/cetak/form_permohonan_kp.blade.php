<!DOCTYPE html>
<head>
    <title>PERMOHONAN KERJA PRAKTEK</title>
    <meta charset="utf-8">
    <style>
        /** Define the margins of your page **/
        .border-collapse {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px
        }
    </style>

</head>

<body>
    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <div style="">
            <table class="border-collapse" width="100%">
                <tr>
                  <th class="border-collapse" width="50px">
                    <img class="img" src="{{ $img_logo }}" alt="" width="40px">
                  </th>
                  <th class="border-collapse">                      
                      <div style="text-align : center; font-size: 14px; font-weight: bold; text-transform: uppercase">
                          <p>LEMBAR/FORM PERMOHONAN KERJA PRAKTIK</p>
                      </div>
                  </th>
                </tr>
                <tr>
                    <th colspan="2">
                        <div style="font-weight: normal; text-align: left;">
                            Saya yang bertanda tangan dibawah ini:
                        </div>

                        <div style="padding-left: 100px">
                            <table style="font-weight: normal; border-collapse: unset" class="" width="100%">
                                <tr>
                                    <td class="">NIM</td>
                                    <td class="border-collapse">{{$pendaftaran->nim ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td class="">NAMA</td>
                                    <td class="border-collapse">{{$pendaftaran->nama ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td class="">PROGRAM STUDI</td>
                                    <td class="border-collapse">{{$pendaftaran->prodi ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td class="">SKS DITEMPUH </td>
                                    <td class="border-collapse">{{$pendaftaran->sks_ditempuh ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <td class="">IPK</td>
                                    <td class="border-collapse">{{$pendaftaran->ipk ?? "-"}}</td>
                                </tr> 
                                <tr>
                                    <td class="">JUDUL PRA PROPOSAL KP</td>
                                    <td class="border-collapse" style="max-width: 200px">{{$pendaftaran->judul_pra_proposal ?? "-"}}</td>
                                </tr>  
                            </table>
                        </div>

                        <div style="font-weight: normal; text-align: left; width: 400px">
                            <p>Mengajukan permohonan kepada Dekan Fakultas Teknik untuk dapat mengikuti KERJA PRAKTIK</p>
                        </div>

                        <table style="border-collapse: unset" class="" width="100%">
                            <tr>
                                <th class="" colspan="2"></th>
                                <th class="border-collapse" colspan="2">P.Studi</th>
                            </tr>
                            <tr>
                                <th class="border-collapse" width="10px">No.</th>
                                <th class="border-collapse">ITEM EVALUASI</th>
                                <th class="border-collapse" width="80px">Bagian Akademik</th>
                                <th class="border-collapse">P.Studi</th>
                            </tr>
                            <tr style="font-weight: normal">
                                <td class="border-collapse">1</td>
                                <td class="border-collapse">JumlahSKS(minimal 90 SKS dan IPK ( >=2.0 )</td>
                                <td class="border-collapse"></td>
                                <td class="border-collapse"></td>
                            </tr>
                            <tr style="font-weight: normal">
                                <td class="border-collapse">2</td>
                                <td class="border-collapse">KRS</td>
                                <td class="border-collapse"></td>
                                <td class="border-collapse"></td>
                            </tr>
                            <tr style="font-weight: normal">
                                <td class="border-collapse">3</td>
                                <td class="border-collapse">Surat diterima KP dari Perusahaan atau Instansi</td>
                                <td class="border-collapse"></td>
                                <td class="border-collapse"></td>
                            </tr>
                            <tr style="font-weight: normal">
                                <td class="border-collapse">3</td>
                                <td class="border-collapse">Praproposal 1 Eksemplar ( dalam 1 MAP Orange )</td>
                                <td class="border-collapse"></td>
                                <td class="border-collapse"></td>
                            </tr>
                            <tr style="font-weight: normal">
                                <td class="border-collapse">3</td>
                                <td class="border-collapse">KESIMPULAN</td>
                                <td class="border-collapse"></td>
                                <td class="border-collapse"></td>
                            </tr>
                        </table>

                        <table style="font-weight: normal" class="" width="100%">
                            <tr>
                              <td class="">
                                <div>Mengetahui,</div>
                                <div>Pembimbing Akademik</div>
                                <br><br><br><br>
                                <div>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
                              </td>
                              <td class="" width="100px">
                                <div>Tondano,</div>
                                <div>Pemohon Kerja Praktik</div>
                                <br><br><br><br>
                                <div>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
                              </td>
                            </tr>
                        </table>
                        <div style="font-weight: normal; text-align: left; padding: 5px">
                            <i>Catatan : *Untuk dapat diproses diisi oleh mahasiswa dengan lengkap</i>
                        </div>
                    </th>
                </tr>
            </table>
        </div>


        <p style="page-break-after: always;"></p>


        <div style="padding-left: 50px; padding-right: 50px">
            <div style="text-align: center; font-weight: bold">PERNYATAAN KONSULTASI PRA-KP</div>
    
            <br>

            <table style="" width="100%">
                <tr>
                    <td class="" width="200px">NIM</td>
                    <td class="">:</td>
                    <td class="">{{$pendaftaran->nim ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="">Nama</td>
                    <td class="">:</td>
                    <td class="">{{$pendaftaran->nama ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="">Tempat/InstansiKP </td>
                    <td class="" width="1px">:</td>
                    <td class="">{{$pendaftaran->instansi_kp ?? "-"}}</td>
                </tr>
            </table>
    
            <br>
            <div style="padding: 8px">Menyatakan dengan surat ini bahwa saya telah melaksanakan konsultasi Pra-Kerja Praktek kepada dosen pembimbing Kerja Praktek</div>
            <br>
    
            <table style="" width="100%">
                <tr>
                    <td class="" width="200px">NIP</td>
                    <td class="" width="1px">:</td>
                    <td class="">{{$pendaftaran->nip ?? "-"}}</td>
                </tr>
                <tr>
                    <td class="">Nama Dosen Pembimbing</td>
                    <td class="">:</td>
                    <td class="">{{$pendaftaran->dosen_pembimbing_kp ?? "-"}}</td>
                </tr>
            </table>

            <table style="font-weight: normal" class="" width="100%">
                <tr>
                  <td class="">
                  </td>
                  <td class="" width="200px">
                    <div>Tondano, {{date("d F Y")}}</div>
                    <div>Dosen Pembimbing</div>
                    <div>Kerja Praktek</div>
                    <br><br><br><br>
                    <div>(......................................)</div>
                  </td>
                </tr>
            </table>
        </div>


    </main>
</body>

</html>