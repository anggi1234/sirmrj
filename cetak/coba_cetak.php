<?php
ob_start();
session_start();
include 'koneksi.php';
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Clinical Pathway</title>
    <style type="text/css">
        @page {
            margin-top: 0.5 cm;
            margin-left: 0.5 cm;
            margin-right: 0.5 cm;
            margin-bottom: 0.5 cm;
            font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
            font-size: 10px
        }

        .tabel {
            border-collapse: collapse;
            font-size: 9px;
            text-align: right;
        }

        .header {
            font-size: 12px;
        }

        .footer {
            font-size: 12px;
        }

        .pagebreak {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <table width="100%" border="0" cellpadding="-3px" cellspacing="0px">
        <tr>
            <td width="10%" rowspan="3" align="right"><img src="http://localhost/sirmrj/cetak/gambar/hospital.png" height="70px" /></td>
            <td width="90%" align="center" style="font-size: 16px">CLINICAL PATHWAY</td>
        </tr>
        <tr>
            <td align="center"><strong style="font-size: 21px">RUMAH SAKIT</strong></td>
        </tr>
        <tr>
            <td align="center" style="font-size: 14px">Jalan Alamat<br>+62 345 321 123<br>Email:rumahsakit@mail.com</td>
        </tr>
    </table>
    <hr>
    <div align="center"><strong>HASIL BACAAN USG KEBIDANAN</strong></div>
    <div style="font-size: 10px">
        <table width="100%" border="0" cellspacing="2">
            <tbody style="font-size: 12px">
                <tr>
                    <td width="4%">&nbsp;</td>
                    <td width="30%">Dokter</td>
                    <td width="1%">:</td>
                    <td width="70%">dr.Kusno</td>
                    <td width="4%">&nbsp;</td>
                    <td width="25%">NO RM</td>
                    <td width="1%">:</td>
                    <td width="70%">000011</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Tgl Pemeriksaan</td>
                    <td>:</td>
                    <td>12 November 2022</td>
                    <td width="4%">&nbsp;</td>
                    <td>Nama</td>
                    <td>:</td>
                    <td>Titin Nurhardyanti</td>
                    <td align="left">Perempuan</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Ruang Rawat</td>
                    <td>:</td>
                    <td>Anggrek 1 </td>
                    <td width="4%">&nbsp;</td>
                    <td>Tgl lahir</td>
                    <td>:</td>
                    <td>12 November 1997</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td valign="top">Status Pembiayaan</td>
                    <td valign="top">:</td>
                    <td valign="top">Umum</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <table width="100%" border="0" cellspacing="2">
        <tbody style="font-size: 10px">
            <tr>
                <td width="4%">&nbsp;</td>
                <td width="25%">1. Janin</td>
                <td width="1%">:</td>
                <td width="70%"></td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>2. Letak/Presentasi</td>
                <td>:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>3. Denyut Jantung Janin</td>
                <td>:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>4. TBJ</td>
                <td>:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>5. Plasenta</td>
                <td>:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>6. Indexs Cairan Amnion</td>
                <td>:</td>
                <td>Amnion</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>7. Jenis Kelamin</td>
                <td>:</td>
                <td>Perempuan </td>
            </tr>

        </tbody>
    </table>
    <br>
    <table width="100%" border="0" style="font-size: 12px">
        <tbody>
            <tr>
                <td align="center" width="20%">Saran dan Kesimpulan</td>
                <td colspan="6" style="font-size: 12px" align="left" width="40%">: Jaga diri jauh disana</strong></td>
                <td align="center" class="footer" width="40%"><u>Dokter Pemeriksa</u></td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
                <td colspan="6" align="right">&nbsp;</td>
                <td align="center"><img height="100px" src=""></td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
                <td colspan="6" align="right">&nbsp;</td>
                <td align="center">(dr.Kusno)</td>
            </tr>

        </tbody>
    </table>
</body>

</html>
<?php
$html = ob_get_clean();
require_once "../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);
$paper_size = [0, 0, 8.66 * 72, 5.51 * 72];
$dompdf->set_paper($paper_size, 'portrait');
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('43_usg.pdf', ['Attachment' => 0]);
?>