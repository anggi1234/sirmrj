<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");
$nomr = $_GET['no_rkm_medis'];
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($koneksi, "SELECT pasien_kunjungan.no_rkm_medis, pasien_kunjungan.kd_poli,
  pasien_kunjungan.kd_dokter, pasien_kunjungan.tgl_registrasi,
  pasien_kunjungan.jam_reg, pasien_kunjungan.id_reg,
  diagnosa_pasien.kd_penyakit, penilaian_awal_keperawatan_ralan.alergi,
  diagnosa_pasien.kd_icd9
FROM pasien_kunjungan INNER JOIN
  diagnosa_pasien ON pasien_kunjungan.id_reg = diagnosa_pasien.no_rawat
  INNER JOIN
  penilaian_awal_keperawatan_ralan ON pasien_kunjungan.id_reg =
    penilaian_awal_keperawatan_ralan.no_rawat");
$html = '<center><h3>Daftar Nama Siswa</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr>
 <th>No.Reg</th>
 <th>NOMR</th>
 <th>Nama</th>
 <th>Tanggal Registrasi</th>
 <th>Klinik</th>
 <th>Tanggal Registrasi</th>
 <th>Tanggal Registrasi</th>
 </tr>';
$no = 1;
while($row = mysqli_fetch_array($query))
{
 $html .= "<tr>
 <td>".$no."</td>
 <td>".$row['nama']."</td>
 <td>".$row['kelas']."</td>
 <td>".$row['alamat']."</td>
 </tr>";
 $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_siswa.pdf');
