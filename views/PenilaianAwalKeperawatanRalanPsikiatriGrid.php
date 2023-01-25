<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("PenilaianAwalKeperawatanRalanPsikiatriGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralan_psikiatrigrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid = new ew.Form("fpenilaian_awal_keperawatan_ralan_psikiatrigrid", "grid");
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan_psikiatri")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri)
        ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri = currentTable;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(0)], fields.tanggal.isInvalid],
        ["informasi", [fields.informasi.visible && fields.informasi.required ? ew.Validators.required(fields.informasi.caption) : null], fields.informasi.isInvalid],
        ["rkd_sakit_sejak", [fields.rkd_sakit_sejak.visible && fields.rkd_sakit_sejak.required ? ew.Validators.required(fields.rkd_sakit_sejak.caption) : null], fields.rkd_sakit_sejak.isInvalid],
        ["rkd_berobat", [fields.rkd_berobat.visible && fields.rkd_berobat.required ? ew.Validators.required(fields.rkd_berobat.caption) : null], fields.rkd_berobat.isInvalid],
        ["rkd_hasil_pengobatan", [fields.rkd_hasil_pengobatan.visible && fields.rkd_hasil_pengobatan.required ? ew.Validators.required(fields.rkd_hasil_pengobatan.caption) : null], fields.rkd_hasil_pengobatan.isInvalid],
        ["fp_putus_obat", [fields.fp_putus_obat.visible && fields.fp_putus_obat.required ? ew.Validators.required(fields.fp_putus_obat.caption) : null], fields.fp_putus_obat.isInvalid],
        ["ket_putus_obat", [fields.ket_putus_obat.visible && fields.ket_putus_obat.required ? ew.Validators.required(fields.ket_putus_obat.caption) : null], fields.ket_putus_obat.isInvalid],
        ["fp_ekonomi", [fields.fp_ekonomi.visible && fields.fp_ekonomi.required ? ew.Validators.required(fields.fp_ekonomi.caption) : null], fields.fp_ekonomi.isInvalid],
        ["ket_masalah_ekonomi", [fields.ket_masalah_ekonomi.visible && fields.ket_masalah_ekonomi.required ? ew.Validators.required(fields.ket_masalah_ekonomi.caption) : null], fields.ket_masalah_ekonomi.isInvalid],
        ["fp_masalah_fisik", [fields.fp_masalah_fisik.visible && fields.fp_masalah_fisik.required ? ew.Validators.required(fields.fp_masalah_fisik.caption) : null], fields.fp_masalah_fisik.isInvalid],
        ["ket_masalah_fisik", [fields.ket_masalah_fisik.visible && fields.ket_masalah_fisik.required ? ew.Validators.required(fields.ket_masalah_fisik.caption) : null], fields.ket_masalah_fisik.isInvalid],
        ["fp_masalah_psikososial", [fields.fp_masalah_psikososial.visible && fields.fp_masalah_psikososial.required ? ew.Validators.required(fields.fp_masalah_psikososial.caption) : null], fields.fp_masalah_psikososial.isInvalid],
        ["ket_masalah_psikososial", [fields.ket_masalah_psikososial.visible && fields.ket_masalah_psikososial.required ? ew.Validators.required(fields.ket_masalah_psikososial.caption) : null], fields.ket_masalah_psikososial.isInvalid],
        ["rh_keluarga", [fields.rh_keluarga.visible && fields.rh_keluarga.required ? ew.Validators.required(fields.rh_keluarga.caption) : null], fields.rh_keluarga.isInvalid],
        ["ket_rh_keluarga", [fields.ket_rh_keluarga.visible && fields.ket_rh_keluarga.required ? ew.Validators.required(fields.ket_rh_keluarga.caption) : null], fields.ket_rh_keluarga.isInvalid],
        ["resiko_bunuh_diri", [fields.resiko_bunuh_diri.visible && fields.resiko_bunuh_diri.required ? ew.Validators.required(fields.resiko_bunuh_diri.caption) : null], fields.resiko_bunuh_diri.isInvalid],
        ["rbd_ide", [fields.rbd_ide.visible && fields.rbd_ide.required ? ew.Validators.required(fields.rbd_ide.caption) : null], fields.rbd_ide.isInvalid],
        ["ket_rbd_ide", [fields.ket_rbd_ide.visible && fields.ket_rbd_ide.required ? ew.Validators.required(fields.ket_rbd_ide.caption) : null], fields.ket_rbd_ide.isInvalid],
        ["rbd_rencana", [fields.rbd_rencana.visible && fields.rbd_rencana.required ? ew.Validators.required(fields.rbd_rencana.caption) : null], fields.rbd_rencana.isInvalid],
        ["ket_rbd_rencana", [fields.ket_rbd_rencana.visible && fields.ket_rbd_rencana.required ? ew.Validators.required(fields.ket_rbd_rencana.caption) : null], fields.ket_rbd_rencana.isInvalid],
        ["rbd_alat", [fields.rbd_alat.visible && fields.rbd_alat.required ? ew.Validators.required(fields.rbd_alat.caption) : null], fields.rbd_alat.isInvalid],
        ["ket_rbd_alat", [fields.ket_rbd_alat.visible && fields.ket_rbd_alat.required ? ew.Validators.required(fields.ket_rbd_alat.caption) : null], fields.ket_rbd_alat.isInvalid],
        ["rbd_percobaan", [fields.rbd_percobaan.visible && fields.rbd_percobaan.required ? ew.Validators.required(fields.rbd_percobaan.caption) : null], fields.rbd_percobaan.isInvalid],
        ["ket_rbd_percobaan", [fields.ket_rbd_percobaan.visible && fields.ket_rbd_percobaan.required ? ew.Validators.required(fields.ket_rbd_percobaan.caption) : null], fields.ket_rbd_percobaan.isInvalid],
        ["rbd_keinginan", [fields.rbd_keinginan.visible && fields.rbd_keinginan.required ? ew.Validators.required(fields.rbd_keinginan.caption) : null], fields.rbd_keinginan.isInvalid],
        ["ket_rbd_keinginan", [fields.ket_rbd_keinginan.visible && fields.ket_rbd_keinginan.required ? ew.Validators.required(fields.ket_rbd_keinginan.caption) : null], fields.ket_rbd_keinginan.isInvalid],
        ["rpo_penggunaan", [fields.rpo_penggunaan.visible && fields.rpo_penggunaan.required ? ew.Validators.required(fields.rpo_penggunaan.caption) : null], fields.rpo_penggunaan.isInvalid],
        ["ket_rpo_penggunaan", [fields.ket_rpo_penggunaan.visible && fields.ket_rpo_penggunaan.required ? ew.Validators.required(fields.ket_rpo_penggunaan.caption) : null], fields.ket_rpo_penggunaan.isInvalid],
        ["rpo_efek_samping", [fields.rpo_efek_samping.visible && fields.rpo_efek_samping.required ? ew.Validators.required(fields.rpo_efek_samping.caption) : null], fields.rpo_efek_samping.isInvalid],
        ["ket_rpo_efek_samping", [fields.ket_rpo_efek_samping.visible && fields.ket_rpo_efek_samping.required ? ew.Validators.required(fields.ket_rpo_efek_samping.caption) : null], fields.ket_rpo_efek_samping.isInvalid],
        ["rpo_napza", [fields.rpo_napza.visible && fields.rpo_napza.required ? ew.Validators.required(fields.rpo_napza.caption) : null], fields.rpo_napza.isInvalid],
        ["ket_rpo_napza", [fields.ket_rpo_napza.visible && fields.ket_rpo_napza.required ? ew.Validators.required(fields.ket_rpo_napza.caption) : null], fields.ket_rpo_napza.isInvalid],
        ["ket_lama_pemakaian", [fields.ket_lama_pemakaian.visible && fields.ket_lama_pemakaian.required ? ew.Validators.required(fields.ket_lama_pemakaian.caption) : null], fields.ket_lama_pemakaian.isInvalid],
        ["ket_cara_pemakaian", [fields.ket_cara_pemakaian.visible && fields.ket_cara_pemakaian.required ? ew.Validators.required(fields.ket_cara_pemakaian.caption) : null], fields.ket_cara_pemakaian.isInvalid],
        ["ket_latar_belakang_pemakaian", [fields.ket_latar_belakang_pemakaian.visible && fields.ket_latar_belakang_pemakaian.required ? ew.Validators.required(fields.ket_latar_belakang_pemakaian.caption) : null], fields.ket_latar_belakang_pemakaian.isInvalid],
        ["rpo_penggunaan_obat_lainnya", [fields.rpo_penggunaan_obat_lainnya.visible && fields.rpo_penggunaan_obat_lainnya.required ? ew.Validators.required(fields.rpo_penggunaan_obat_lainnya.caption) : null], fields.rpo_penggunaan_obat_lainnya.isInvalid],
        ["ket_penggunaan_obat_lainnya", [fields.ket_penggunaan_obat_lainnya.visible && fields.ket_penggunaan_obat_lainnya.required ? ew.Validators.required(fields.ket_penggunaan_obat_lainnya.caption) : null], fields.ket_penggunaan_obat_lainnya.isInvalid],
        ["ket_alasan_penggunaan", [fields.ket_alasan_penggunaan.visible && fields.ket_alasan_penggunaan.required ? ew.Validators.required(fields.ket_alasan_penggunaan.caption) : null], fields.ket_alasan_penggunaan.isInvalid],
        ["rpo_alergi_obat", [fields.rpo_alergi_obat.visible && fields.rpo_alergi_obat.required ? ew.Validators.required(fields.rpo_alergi_obat.caption) : null], fields.rpo_alergi_obat.isInvalid],
        ["ket_alergi_obat", [fields.ket_alergi_obat.visible && fields.ket_alergi_obat.required ? ew.Validators.required(fields.ket_alergi_obat.caption) : null], fields.ket_alergi_obat.isInvalid],
        ["rpo_merokok", [fields.rpo_merokok.visible && fields.rpo_merokok.required ? ew.Validators.required(fields.rpo_merokok.caption) : null], fields.rpo_merokok.isInvalid],
        ["ket_merokok", [fields.ket_merokok.visible && fields.ket_merokok.required ? ew.Validators.required(fields.ket_merokok.caption) : null], fields.ket_merokok.isInvalid],
        ["rpo_minum_kopi", [fields.rpo_minum_kopi.visible && fields.rpo_minum_kopi.required ? ew.Validators.required(fields.rpo_minum_kopi.caption) : null], fields.rpo_minum_kopi.isInvalid],
        ["ket_minum_kopi", [fields.ket_minum_kopi.visible && fields.ket_minum_kopi.required ? ew.Validators.required(fields.ket_minum_kopi.caption) : null], fields.ket_minum_kopi.isInvalid],
        ["td", [fields.td.visible && fields.td.required ? ew.Validators.required(fields.td.caption) : null], fields.td.isInvalid],
        ["nadi", [fields.nadi.visible && fields.nadi.required ? ew.Validators.required(fields.nadi.caption) : null], fields.nadi.isInvalid],
        ["gcs", [fields.gcs.visible && fields.gcs.required ? ew.Validators.required(fields.gcs.caption) : null], fields.gcs.isInvalid],
        ["rr", [fields.rr.visible && fields.rr.required ? ew.Validators.required(fields.rr.caption) : null], fields.rr.isInvalid],
        ["suhu", [fields.suhu.visible && fields.suhu.required ? ew.Validators.required(fields.suhu.caption) : null], fields.suhu.isInvalid],
        ["pf_keluhan_fisik", [fields.pf_keluhan_fisik.visible && fields.pf_keluhan_fisik.required ? ew.Validators.required(fields.pf_keluhan_fisik.caption) : null], fields.pf_keluhan_fisik.isInvalid],
        ["ket_keluhan_fisik", [fields.ket_keluhan_fisik.visible && fields.ket_keluhan_fisik.required ? ew.Validators.required(fields.ket_keluhan_fisik.caption) : null], fields.ket_keluhan_fisik.isInvalid],
        ["skala_nyeri", [fields.skala_nyeri.visible && fields.skala_nyeri.required ? ew.Validators.required(fields.skala_nyeri.caption) : null], fields.skala_nyeri.isInvalid],
        ["durasi", [fields.durasi.visible && fields.durasi.required ? ew.Validators.required(fields.durasi.caption) : null], fields.durasi.isInvalid],
        ["nyeri", [fields.nyeri.visible && fields.nyeri.required ? ew.Validators.required(fields.nyeri.caption) : null], fields.nyeri.isInvalid],
        ["provokes", [fields.provokes.visible && fields.provokes.required ? ew.Validators.required(fields.provokes.caption) : null], fields.provokes.isInvalid],
        ["ket_provokes", [fields.ket_provokes.visible && fields.ket_provokes.required ? ew.Validators.required(fields.ket_provokes.caption) : null], fields.ket_provokes.isInvalid],
        ["quality", [fields.quality.visible && fields.quality.required ? ew.Validators.required(fields.quality.caption) : null], fields.quality.isInvalid],
        ["ket_quality", [fields.ket_quality.visible && fields.ket_quality.required ? ew.Validators.required(fields.ket_quality.caption) : null], fields.ket_quality.isInvalid],
        ["lokasi", [fields.lokasi.visible && fields.lokasi.required ? ew.Validators.required(fields.lokasi.caption) : null], fields.lokasi.isInvalid],
        ["menyebar", [fields.menyebar.visible && fields.menyebar.required ? ew.Validators.required(fields.menyebar.caption) : null], fields.menyebar.isInvalid],
        ["pada_dokter", [fields.pada_dokter.visible && fields.pada_dokter.required ? ew.Validators.required(fields.pada_dokter.caption) : null], fields.pada_dokter.isInvalid],
        ["ket_dokter", [fields.ket_dokter.visible && fields.ket_dokter.required ? ew.Validators.required(fields.ket_dokter.caption) : null], fields.ket_dokter.isInvalid],
        ["nyeri_hilang", [fields.nyeri_hilang.visible && fields.nyeri_hilang.required ? ew.Validators.required(fields.nyeri_hilang.caption) : null], fields.nyeri_hilang.isInvalid],
        ["ket_nyeri", [fields.ket_nyeri.visible && fields.ket_nyeri.required ? ew.Validators.required(fields.ket_nyeri.caption) : null], fields.ket_nyeri.isInvalid],
        ["bb", [fields.bb.visible && fields.bb.required ? ew.Validators.required(fields.bb.caption) : null], fields.bb.isInvalid],
        ["tb", [fields.tb.visible && fields.tb.required ? ew.Validators.required(fields.tb.caption) : null], fields.tb.isInvalid],
        ["bmi", [fields.bmi.visible && fields.bmi.required ? ew.Validators.required(fields.bmi.caption) : null], fields.bmi.isInvalid],
        ["lapor_status_nutrisi", [fields.lapor_status_nutrisi.visible && fields.lapor_status_nutrisi.required ? ew.Validators.required(fields.lapor_status_nutrisi.caption) : null], fields.lapor_status_nutrisi.isInvalid],
        ["ket_lapor_status_nutrisi", [fields.ket_lapor_status_nutrisi.visible && fields.ket_lapor_status_nutrisi.required ? ew.Validators.required(fields.ket_lapor_status_nutrisi.caption) : null], fields.ket_lapor_status_nutrisi.isInvalid],
        ["sg1", [fields.sg1.visible && fields.sg1.required ? ew.Validators.required(fields.sg1.caption) : null], fields.sg1.isInvalid],
        ["nilai1", [fields.nilai1.visible && fields.nilai1.required ? ew.Validators.required(fields.nilai1.caption) : null], fields.nilai1.isInvalid],
        ["sg2", [fields.sg2.visible && fields.sg2.required ? ew.Validators.required(fields.sg2.caption) : null], fields.sg2.isInvalid],
        ["nilai2", [fields.nilai2.visible && fields.nilai2.required ? ew.Validators.required(fields.nilai2.caption) : null], fields.nilai2.isInvalid],
        ["total_hasil", [fields.total_hasil.visible && fields.total_hasil.required ? ew.Validators.required(fields.total_hasil.caption) : null, ew.Validators.integer], fields.total_hasil.isInvalid],
        ["resikojatuh", [fields.resikojatuh.visible && fields.resikojatuh.required ? ew.Validators.required(fields.resikojatuh.caption) : null], fields.resikojatuh.isInvalid],
        ["bjm", [fields.bjm.visible && fields.bjm.required ? ew.Validators.required(fields.bjm.caption) : null], fields.bjm.isInvalid],
        ["msa", [fields.msa.visible && fields.msa.required ? ew.Validators.required(fields.msa.caption) : null], fields.msa.isInvalid],
        ["hasil", [fields.hasil.visible && fields.hasil.required ? ew.Validators.required(fields.hasil.caption) : null], fields.hasil.isInvalid],
        ["lapor", [fields.lapor.visible && fields.lapor.required ? ew.Validators.required(fields.lapor.caption) : null], fields.lapor.isInvalid],
        ["ket_lapor", [fields.ket_lapor.visible && fields.ket_lapor.required ? ew.Validators.required(fields.ket_lapor.caption) : null], fields.ket_lapor.isInvalid],
        ["adl_mandi", [fields.adl_mandi.visible && fields.adl_mandi.required ? ew.Validators.required(fields.adl_mandi.caption) : null], fields.adl_mandi.isInvalid],
        ["adl_berpakaian", [fields.adl_berpakaian.visible && fields.adl_berpakaian.required ? ew.Validators.required(fields.adl_berpakaian.caption) : null], fields.adl_berpakaian.isInvalid],
        ["adl_makan", [fields.adl_makan.visible && fields.adl_makan.required ? ew.Validators.required(fields.adl_makan.caption) : null], fields.adl_makan.isInvalid],
        ["adl_bak", [fields.adl_bak.visible && fields.adl_bak.required ? ew.Validators.required(fields.adl_bak.caption) : null], fields.adl_bak.isInvalid],
        ["adl_bab", [fields.adl_bab.visible && fields.adl_bab.required ? ew.Validators.required(fields.adl_bab.caption) : null], fields.adl_bab.isInvalid],
        ["adl_hobi", [fields.adl_hobi.visible && fields.adl_hobi.required ? ew.Validators.required(fields.adl_hobi.caption) : null], fields.adl_hobi.isInvalid],
        ["ket_adl_hobi", [fields.ket_adl_hobi.visible && fields.ket_adl_hobi.required ? ew.Validators.required(fields.ket_adl_hobi.caption) : null], fields.ket_adl_hobi.isInvalid],
        ["adl_sosialisasi", [fields.adl_sosialisasi.visible && fields.adl_sosialisasi.required ? ew.Validators.required(fields.adl_sosialisasi.caption) : null], fields.adl_sosialisasi.isInvalid],
        ["ket_adl_sosialisasi", [fields.ket_adl_sosialisasi.visible && fields.ket_adl_sosialisasi.required ? ew.Validators.required(fields.ket_adl_sosialisasi.caption) : null], fields.ket_adl_sosialisasi.isInvalid],
        ["adl_kegiatan", [fields.adl_kegiatan.visible && fields.adl_kegiatan.required ? ew.Validators.required(fields.adl_kegiatan.caption) : null], fields.adl_kegiatan.isInvalid],
        ["ket_adl_kegiatan", [fields.ket_adl_kegiatan.visible && fields.ket_adl_kegiatan.required ? ew.Validators.required(fields.ket_adl_kegiatan.caption) : null], fields.ket_adl_kegiatan.isInvalid],
        ["sk_penampilan", [fields.sk_penampilan.visible && fields.sk_penampilan.required ? ew.Validators.required(fields.sk_penampilan.caption) : null], fields.sk_penampilan.isInvalid],
        ["sk_alam_perasaan", [fields.sk_alam_perasaan.visible && fields.sk_alam_perasaan.required ? ew.Validators.required(fields.sk_alam_perasaan.caption) : null], fields.sk_alam_perasaan.isInvalid],
        ["sk_pembicaraan", [fields.sk_pembicaraan.visible && fields.sk_pembicaraan.required ? ew.Validators.required(fields.sk_pembicaraan.caption) : null], fields.sk_pembicaraan.isInvalid],
        ["sk_afek", [fields.sk_afek.visible && fields.sk_afek.required ? ew.Validators.required(fields.sk_afek.caption) : null], fields.sk_afek.isInvalid],
        ["sk_aktifitas_motorik", [fields.sk_aktifitas_motorik.visible && fields.sk_aktifitas_motorik.required ? ew.Validators.required(fields.sk_aktifitas_motorik.caption) : null], fields.sk_aktifitas_motorik.isInvalid],
        ["sk_gangguan_ringan", [fields.sk_gangguan_ringan.visible && fields.sk_gangguan_ringan.required ? ew.Validators.required(fields.sk_gangguan_ringan.caption) : null], fields.sk_gangguan_ringan.isInvalid],
        ["sk_proses_pikir", [fields.sk_proses_pikir.visible && fields.sk_proses_pikir.required ? ew.Validators.required(fields.sk_proses_pikir.caption) : null], fields.sk_proses_pikir.isInvalid],
        ["sk_orientasi", [fields.sk_orientasi.visible && fields.sk_orientasi.required ? ew.Validators.required(fields.sk_orientasi.caption) : null], fields.sk_orientasi.isInvalid],
        ["sk_tingkat_kesadaran_orientasi", [fields.sk_tingkat_kesadaran_orientasi.visible && fields.sk_tingkat_kesadaran_orientasi.required ? ew.Validators.required(fields.sk_tingkat_kesadaran_orientasi.caption) : null], fields.sk_tingkat_kesadaran_orientasi.isInvalid],
        ["sk_memori", [fields.sk_memori.visible && fields.sk_memori.required ? ew.Validators.required(fields.sk_memori.caption) : null], fields.sk_memori.isInvalid],
        ["sk_interaksi", [fields.sk_interaksi.visible && fields.sk_interaksi.required ? ew.Validators.required(fields.sk_interaksi.caption) : null], fields.sk_interaksi.isInvalid],
        ["sk_konsentrasi", [fields.sk_konsentrasi.visible && fields.sk_konsentrasi.required ? ew.Validators.required(fields.sk_konsentrasi.caption) : null], fields.sk_konsentrasi.isInvalid],
        ["sk_persepsi", [fields.sk_persepsi.visible && fields.sk_persepsi.required ? ew.Validators.required(fields.sk_persepsi.caption) : null], fields.sk_persepsi.isInvalid],
        ["ket_sk_persepsi", [fields.ket_sk_persepsi.visible && fields.ket_sk_persepsi.required ? ew.Validators.required(fields.ket_sk_persepsi.caption) : null], fields.ket_sk_persepsi.isInvalid],
        ["sk_isi_pikir", [fields.sk_isi_pikir.visible && fields.sk_isi_pikir.required ? ew.Validators.required(fields.sk_isi_pikir.caption) : null], fields.sk_isi_pikir.isInvalid],
        ["sk_waham", [fields.sk_waham.visible && fields.sk_waham.required ? ew.Validators.required(fields.sk_waham.caption) : null], fields.sk_waham.isInvalid],
        ["ket_sk_waham", [fields.ket_sk_waham.visible && fields.ket_sk_waham.required ? ew.Validators.required(fields.ket_sk_waham.caption) : null], fields.ket_sk_waham.isInvalid],
        ["sk_daya_tilik_diri", [fields.sk_daya_tilik_diri.visible && fields.sk_daya_tilik_diri.required ? ew.Validators.required(fields.sk_daya_tilik_diri.caption) : null], fields.sk_daya_tilik_diri.isInvalid],
        ["ket_sk_daya_tilik_diri", [fields.ket_sk_daya_tilik_diri.visible && fields.ket_sk_daya_tilik_diri.required ? ew.Validators.required(fields.ket_sk_daya_tilik_diri.caption) : null], fields.ket_sk_daya_tilik_diri.isInvalid],
        ["kk_pembelajaran", [fields.kk_pembelajaran.visible && fields.kk_pembelajaran.required ? ew.Validators.required(fields.kk_pembelajaran.caption) : null], fields.kk_pembelajaran.isInvalid],
        ["ket_kk_pembelajaran", [fields.ket_kk_pembelajaran.visible && fields.ket_kk_pembelajaran.required ? ew.Validators.required(fields.ket_kk_pembelajaran.caption) : null], fields.ket_kk_pembelajaran.isInvalid],
        ["ket_kk_pembelajaran_lainnya", [fields.ket_kk_pembelajaran_lainnya.visible && fields.ket_kk_pembelajaran_lainnya.required ? ew.Validators.required(fields.ket_kk_pembelajaran_lainnya.caption) : null], fields.ket_kk_pembelajaran_lainnya.isInvalid],
        ["kk_Penerjamah", [fields.kk_Penerjamah.visible && fields.kk_Penerjamah.required ? ew.Validators.required(fields.kk_Penerjamah.caption) : null], fields.kk_Penerjamah.isInvalid],
        ["ket_kk_penerjamah_Lainnya", [fields.ket_kk_penerjamah_Lainnya.visible && fields.ket_kk_penerjamah_Lainnya.required ? ew.Validators.required(fields.ket_kk_penerjamah_Lainnya.caption) : null], fields.ket_kk_penerjamah_Lainnya.isInvalid],
        ["kk_bahasa_isyarat", [fields.kk_bahasa_isyarat.visible && fields.kk_bahasa_isyarat.required ? ew.Validators.required(fields.kk_bahasa_isyarat.caption) : null], fields.kk_bahasa_isyarat.isInvalid],
        ["kk_kebutuhan_edukasi", [fields.kk_kebutuhan_edukasi.visible && fields.kk_kebutuhan_edukasi.required ? ew.Validators.required(fields.kk_kebutuhan_edukasi.caption) : null], fields.kk_kebutuhan_edukasi.isInvalid],
        ["ket_kk_kebutuhan_edukasi", [fields.ket_kk_kebutuhan_edukasi.visible && fields.ket_kk_kebutuhan_edukasi.required ? ew.Validators.required(fields.ket_kk_kebutuhan_edukasi.caption) : null], fields.ket_kk_kebutuhan_edukasi.isInvalid],
        ["rencana", [fields.rencana.visible && fields.rencana.required ? ew.Validators.required(fields.rencana.caption) : null], fields.rencana.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_awal_keperawatan_ralan_psikiatrigrid,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_rawat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tanggal", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "informasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rkd_sakit_sejak", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rkd_berobat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rkd_hasil_pengobatan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "fp_putus_obat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_putus_obat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "fp_ekonomi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_masalah_ekonomi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "fp_masalah_fisik", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_masalah_fisik", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "fp_masalah_psikososial", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_masalah_psikososial", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rh_keluarga", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rh_keluarga", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "resiko_bunuh_diri", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rbd_ide", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rbd_ide", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rbd_rencana", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rbd_rencana", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rbd_alat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rbd_alat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rbd_percobaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rbd_percobaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rbd_keinginan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rbd_keinginan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rpo_penggunaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rpo_penggunaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rpo_efek_samping", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rpo_efek_samping", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rpo_napza", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_rpo_napza", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_lama_pemakaian", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_cara_pemakaian", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_latar_belakang_pemakaian", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rpo_penggunaan_obat_lainnya", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_penggunaan_obat_lainnya", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_alasan_penggunaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rpo_alergi_obat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_alergi_obat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rpo_merokok", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_merokok", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rpo_minum_kopi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_minum_kopi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "td", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nadi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "gcs", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rr", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "suhu", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "pf_keluhan_fisik", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_keluhan_fisik", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "skala_nyeri", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "durasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nyeri", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "provokes", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_provokes", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "quality", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_quality", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "lokasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "menyebar", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "pada_dokter", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_dokter", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nyeri_hilang", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_nyeri", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "bb", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tb", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "bmi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "lapor_status_nutrisi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_lapor_status_nutrisi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sg1", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nilai1", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sg2", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nilai2[]", true))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "total_hasil", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "resikojatuh", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "bjm", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "msa", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "hasil", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "lapor", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_lapor", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_mandi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_berpakaian", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_makan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_bak", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_bab", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_hobi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_adl_hobi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_sosialisasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_adl_sosialisasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "adl_kegiatan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_adl_kegiatan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_penampilan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_alam_perasaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_pembicaraan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_afek", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_aktifitas_motorik", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_gangguan_ringan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_proses_pikir", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_orientasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_tingkat_kesadaran_orientasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_memori", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_interaksi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_konsentrasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_persepsi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_sk_persepsi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_isi_pikir", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_waham", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_sk_waham", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sk_daya_tilik_diri", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_sk_daya_tilik_diri", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kk_pembelajaran", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_kk_pembelajaran", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_kk_pembelajaran_lainnya", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kk_Penerjamah", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_kk_penerjamah_Lainnya", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kk_bahasa_isyarat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kk_kebutuhan_edukasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ket_kk_kebutuhan_edukasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rencana", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nip", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.informasi = <?= $Grid->informasi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rkd_berobat = <?= $Grid->rkd_berobat->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rkd_hasil_pengobatan = <?= $Grid->rkd_hasil_pengobatan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.fp_putus_obat = <?= $Grid->fp_putus_obat->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.fp_ekonomi = <?= $Grid->fp_ekonomi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.fp_masalah_fisik = <?= $Grid->fp_masalah_fisik->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.fp_masalah_psikososial = <?= $Grid->fp_masalah_psikososial->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rh_keluarga = <?= $Grid->rh_keluarga->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.resiko_bunuh_diri = <?= $Grid->resiko_bunuh_diri->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rbd_ide = <?= $Grid->rbd_ide->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rbd_rencana = <?= $Grid->rbd_rencana->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rbd_alat = <?= $Grid->rbd_alat->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rbd_percobaan = <?= $Grid->rbd_percobaan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rbd_keinginan = <?= $Grid->rbd_keinginan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rpo_penggunaan = <?= $Grid->rpo_penggunaan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rpo_efek_samping = <?= $Grid->rpo_efek_samping->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rpo_napza = <?= $Grid->rpo_napza->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rpo_penggunaan_obat_lainnya = <?= $Grid->rpo_penggunaan_obat_lainnya->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rpo_alergi_obat = <?= $Grid->rpo_alergi_obat->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rpo_merokok = <?= $Grid->rpo_merokok->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.rpo_minum_kopi = <?= $Grid->rpo_minum_kopi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.pf_keluhan_fisik = <?= $Grid->pf_keluhan_fisik->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.skala_nyeri = <?= $Grid->skala_nyeri->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.nyeri = <?= $Grid->nyeri->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.provokes = <?= $Grid->provokes->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.quality = <?= $Grid->quality->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.menyebar = <?= $Grid->menyebar->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.pada_dokter = <?= $Grid->pada_dokter->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.nyeri_hilang = <?= $Grid->nyeri_hilang->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.lapor_status_nutrisi = <?= $Grid->lapor_status_nutrisi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sg1 = <?= $Grid->sg1->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.nilai1 = <?= $Grid->nilai1->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sg2 = <?= $Grid->sg2->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.nilai2 = <?= $Grid->nilai2->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.resikojatuh = <?= $Grid->resikojatuh->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.bjm = <?= $Grid->bjm->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.msa = <?= $Grid->msa->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.hasil = <?= $Grid->hasil->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.lapor = <?= $Grid->lapor->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_mandi = <?= $Grid->adl_mandi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_berpakaian = <?= $Grid->adl_berpakaian->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_makan = <?= $Grid->adl_makan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_bak = <?= $Grid->adl_bak->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_bab = <?= $Grid->adl_bab->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_hobi = <?= $Grid->adl_hobi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_sosialisasi = <?= $Grid->adl_sosialisasi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.adl_kegiatan = <?= $Grid->adl_kegiatan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_penampilan = <?= $Grid->sk_penampilan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_alam_perasaan = <?= $Grid->sk_alam_perasaan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_pembicaraan = <?= $Grid->sk_pembicaraan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_afek = <?= $Grid->sk_afek->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_aktifitas_motorik = <?= $Grid->sk_aktifitas_motorik->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_gangguan_ringan = <?= $Grid->sk_gangguan_ringan->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_proses_pikir = <?= $Grid->sk_proses_pikir->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_orientasi = <?= $Grid->sk_orientasi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_tingkat_kesadaran_orientasi = <?= $Grid->sk_tingkat_kesadaran_orientasi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_memori = <?= $Grid->sk_memori->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_interaksi = <?= $Grid->sk_interaksi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_konsentrasi = <?= $Grid->sk_konsentrasi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_persepsi = <?= $Grid->sk_persepsi->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_isi_pikir = <?= $Grid->sk_isi_pikir->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_waham = <?= $Grid->sk_waham->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.sk_daya_tilik_diri = <?= $Grid->sk_daya_tilik_diri->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.kk_pembelajaran = <?= $Grid->kk_pembelajaran->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.ket_kk_pembelajaran = <?= $Grid->ket_kk_pembelajaran->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.kk_Penerjamah = <?= $Grid->kk_Penerjamah->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.kk_bahasa_isyarat = <?= $Grid->kk_bahasa_isyarat->toClientList($Grid) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.lists.kk_kebutuhan_edukasi = <?= $Grid->kk_kebutuhan_edukasi->toClientList($Grid) ?>;
    loadjs.done("fpenilaian_awal_keperawatan_ralan_psikiatrigrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_awal_keperawatan_ralan_psikiatri">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid" class="ew-form ew-list-form form-inline">
<div id="gmp_penilaian_awal_keperawatan_ralan_psikiatri" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_penilaian_awal_keperawatan_ralan_psikiatrigrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->no_rawat->Visible) { // no_rawat ?>
        <th data-name="no_rawat" class="<?= $Grid->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="penilaian_awal_keperawatan_ralan_psikiatri_no_rawat"><?= $Grid->renderSort($Grid->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Grid->tanggal->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="penilaian_awal_keperawatan_ralan_psikiatri_tanggal"><?= $Grid->renderSort($Grid->tanggal) ?></div></th>
<?php } ?>
<?php if ($Grid->informasi->Visible) { // informasi ?>
        <th data-name="informasi" class="<?= $Grid->informasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="penilaian_awal_keperawatan_ralan_psikiatri_informasi"><?= $Grid->renderSort($Grid->informasi) ?></div></th>
<?php } ?>
<?php if ($Grid->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <th data-name="rkd_sakit_sejak" class="<?= $Grid->rkd_sakit_sejak->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak"><?= $Grid->renderSort($Grid->rkd_sakit_sejak) ?></div></th>
<?php } ?>
<?php if ($Grid->rkd_berobat->Visible) { // rkd_berobat ?>
        <th data-name="rkd_berobat" class="<?= $Grid->rkd_berobat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat"><?= $Grid->renderSort($Grid->rkd_berobat) ?></div></th>
<?php } ?>
<?php if ($Grid->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <th data-name="rkd_hasil_pengobatan" class="<?= $Grid->rkd_hasil_pengobatan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan"><?= $Grid->renderSort($Grid->rkd_hasil_pengobatan) ?></div></th>
<?php } ?>
<?php if ($Grid->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <th data-name="fp_putus_obat" class="<?= $Grid->fp_putus_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat"><?= $Grid->renderSort($Grid->fp_putus_obat) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <th data-name="ket_putus_obat" class="<?= $Grid->ket_putus_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat"><?= $Grid->renderSort($Grid->ket_putus_obat) ?></div></th>
<?php } ?>
<?php if ($Grid->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <th data-name="fp_ekonomi" class="<?= $Grid->fp_ekonomi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi"><?= $Grid->renderSort($Grid->fp_ekonomi) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <th data-name="ket_masalah_ekonomi" class="<?= $Grid->ket_masalah_ekonomi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi"><?= $Grid->renderSort($Grid->ket_masalah_ekonomi) ?></div></th>
<?php } ?>
<?php if ($Grid->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <th data-name="fp_masalah_fisik" class="<?= $Grid->fp_masalah_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik"><?= $Grid->renderSort($Grid->fp_masalah_fisik) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <th data-name="ket_masalah_fisik" class="<?= $Grid->ket_masalah_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik"><?= $Grid->renderSort($Grid->ket_masalah_fisik) ?></div></th>
<?php } ?>
<?php if ($Grid->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <th data-name="fp_masalah_psikososial" class="<?= $Grid->fp_masalah_psikososial->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial"><?= $Grid->renderSort($Grid->fp_masalah_psikososial) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <th data-name="ket_masalah_psikososial" class="<?= $Grid->ket_masalah_psikososial->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial"><?= $Grid->renderSort($Grid->ket_masalah_psikososial) ?></div></th>
<?php } ?>
<?php if ($Grid->rh_keluarga->Visible) { // rh_keluarga ?>
        <th data-name="rh_keluarga" class="<?= $Grid->rh_keluarga->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga"><?= $Grid->renderSort($Grid->rh_keluarga) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <th data-name="ket_rh_keluarga" class="<?= $Grid->ket_rh_keluarga->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga"><?= $Grid->renderSort($Grid->ket_rh_keluarga) ?></div></th>
<?php } ?>
<?php if ($Grid->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <th data-name="resiko_bunuh_diri" class="<?= $Grid->resiko_bunuh_diri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri"><?= $Grid->renderSort($Grid->resiko_bunuh_diri) ?></div></th>
<?php } ?>
<?php if ($Grid->rbd_ide->Visible) { // rbd_ide ?>
        <th data-name="rbd_ide" class="<?= $Grid->rbd_ide->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide"><?= $Grid->renderSort($Grid->rbd_ide) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <th data-name="ket_rbd_ide" class="<?= $Grid->ket_rbd_ide->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide"><?= $Grid->renderSort($Grid->ket_rbd_ide) ?></div></th>
<?php } ?>
<?php if ($Grid->rbd_rencana->Visible) { // rbd_rencana ?>
        <th data-name="rbd_rencana" class="<?= $Grid->rbd_rencana->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana"><?= $Grid->renderSort($Grid->rbd_rencana) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <th data-name="ket_rbd_rencana" class="<?= $Grid->ket_rbd_rencana->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana"><?= $Grid->renderSort($Grid->ket_rbd_rencana) ?></div></th>
<?php } ?>
<?php if ($Grid->rbd_alat->Visible) { // rbd_alat ?>
        <th data-name="rbd_alat" class="<?= $Grid->rbd_alat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat"><?= $Grid->renderSort($Grid->rbd_alat) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <th data-name="ket_rbd_alat" class="<?= $Grid->ket_rbd_alat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat"><?= $Grid->renderSort($Grid->ket_rbd_alat) ?></div></th>
<?php } ?>
<?php if ($Grid->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <th data-name="rbd_percobaan" class="<?= $Grid->rbd_percobaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan"><?= $Grid->renderSort($Grid->rbd_percobaan) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <th data-name="ket_rbd_percobaan" class="<?= $Grid->ket_rbd_percobaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan"><?= $Grid->renderSort($Grid->ket_rbd_percobaan) ?></div></th>
<?php } ?>
<?php if ($Grid->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <th data-name="rbd_keinginan" class="<?= $Grid->rbd_keinginan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan"><?= $Grid->renderSort($Grid->rbd_keinginan) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <th data-name="ket_rbd_keinginan" class="<?= $Grid->ket_rbd_keinginan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan"><?= $Grid->renderSort($Grid->ket_rbd_keinginan) ?></div></th>
<?php } ?>
<?php if ($Grid->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <th data-name="rpo_penggunaan" class="<?= $Grid->rpo_penggunaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan"><?= $Grid->renderSort($Grid->rpo_penggunaan) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <th data-name="ket_rpo_penggunaan" class="<?= $Grid->ket_rpo_penggunaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan"><?= $Grid->renderSort($Grid->ket_rpo_penggunaan) ?></div></th>
<?php } ?>
<?php if ($Grid->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <th data-name="rpo_efek_samping" class="<?= $Grid->rpo_efek_samping->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping"><?= $Grid->renderSort($Grid->rpo_efek_samping) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <th data-name="ket_rpo_efek_samping" class="<?= $Grid->ket_rpo_efek_samping->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping"><?= $Grid->renderSort($Grid->ket_rpo_efek_samping) ?></div></th>
<?php } ?>
<?php if ($Grid->rpo_napza->Visible) { // rpo_napza ?>
        <th data-name="rpo_napza" class="<?= $Grid->rpo_napza->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza"><?= $Grid->renderSort($Grid->rpo_napza) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <th data-name="ket_rpo_napza" class="<?= $Grid->ket_rpo_napza->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza"><?= $Grid->renderSort($Grid->ket_rpo_napza) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <th data-name="ket_lama_pemakaian" class="<?= $Grid->ket_lama_pemakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian"><?= $Grid->renderSort($Grid->ket_lama_pemakaian) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <th data-name="ket_cara_pemakaian" class="<?= $Grid->ket_cara_pemakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian"><?= $Grid->renderSort($Grid->ket_cara_pemakaian) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <th data-name="ket_latar_belakang_pemakaian" class="<?= $Grid->ket_latar_belakang_pemakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian"><?= $Grid->renderSort($Grid->ket_latar_belakang_pemakaian) ?></div></th>
<?php } ?>
<?php if ($Grid->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <th data-name="rpo_penggunaan_obat_lainnya" class="<?= $Grid->rpo_penggunaan_obat_lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya"><?= $Grid->renderSort($Grid->rpo_penggunaan_obat_lainnya) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <th data-name="ket_penggunaan_obat_lainnya" class="<?= $Grid->ket_penggunaan_obat_lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya"><?= $Grid->renderSort($Grid->ket_penggunaan_obat_lainnya) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <th data-name="ket_alasan_penggunaan" class="<?= $Grid->ket_alasan_penggunaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan"><?= $Grid->renderSort($Grid->ket_alasan_penggunaan) ?></div></th>
<?php } ?>
<?php if ($Grid->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <th data-name="rpo_alergi_obat" class="<?= $Grid->rpo_alergi_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat"><?= $Grid->renderSort($Grid->rpo_alergi_obat) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <th data-name="ket_alergi_obat" class="<?= $Grid->ket_alergi_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat"><?= $Grid->renderSort($Grid->ket_alergi_obat) ?></div></th>
<?php } ?>
<?php if ($Grid->rpo_merokok->Visible) { // rpo_merokok ?>
        <th data-name="rpo_merokok" class="<?= $Grid->rpo_merokok->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok"><?= $Grid->renderSort($Grid->rpo_merokok) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_merokok->Visible) { // ket_merokok ?>
        <th data-name="ket_merokok" class="<?= $Grid->ket_merokok->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok"><?= $Grid->renderSort($Grid->ket_merokok) ?></div></th>
<?php } ?>
<?php if ($Grid->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <th data-name="rpo_minum_kopi" class="<?= $Grid->rpo_minum_kopi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi"><?= $Grid->renderSort($Grid->rpo_minum_kopi) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <th data-name="ket_minum_kopi" class="<?= $Grid->ket_minum_kopi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi"><?= $Grid->renderSort($Grid->ket_minum_kopi) ?></div></th>
<?php } ?>
<?php if ($Grid->td->Visible) { // td ?>
        <th data-name="td" class="<?= $Grid->td->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_td" class="penilaian_awal_keperawatan_ralan_psikiatri_td"><?= $Grid->renderSort($Grid->td) ?></div></th>
<?php } ?>
<?php if ($Grid->nadi->Visible) { // nadi ?>
        <th data-name="nadi" class="<?= $Grid->nadi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="penilaian_awal_keperawatan_ralan_psikiatri_nadi"><?= $Grid->renderSort($Grid->nadi) ?></div></th>
<?php } ?>
<?php if ($Grid->gcs->Visible) { // gcs ?>
        <th data-name="gcs" class="<?= $Grid->gcs->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="penilaian_awal_keperawatan_ralan_psikiatri_gcs"><?= $Grid->renderSort($Grid->gcs) ?></div></th>
<?php } ?>
<?php if ($Grid->rr->Visible) { // rr ?>
        <th data-name="rr" class="<?= $Grid->rr->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="penilaian_awal_keperawatan_ralan_psikiatri_rr"><?= $Grid->renderSort($Grid->rr) ?></div></th>
<?php } ?>
<?php if ($Grid->suhu->Visible) { // suhu ?>
        <th data-name="suhu" class="<?= $Grid->suhu->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="penilaian_awal_keperawatan_ralan_psikiatri_suhu"><?= $Grid->renderSort($Grid->suhu) ?></div></th>
<?php } ?>
<?php if ($Grid->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <th data-name="pf_keluhan_fisik" class="<?= $Grid->pf_keluhan_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik"><?= $Grid->renderSort($Grid->pf_keluhan_fisik) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <th data-name="ket_keluhan_fisik" class="<?= $Grid->ket_keluhan_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik"><?= $Grid->renderSort($Grid->ket_keluhan_fisik) ?></div></th>
<?php } ?>
<?php if ($Grid->skala_nyeri->Visible) { // skala_nyeri ?>
        <th data-name="skala_nyeri" class="<?= $Grid->skala_nyeri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri"><?= $Grid->renderSort($Grid->skala_nyeri) ?></div></th>
<?php } ?>
<?php if ($Grid->durasi->Visible) { // durasi ?>
        <th data-name="durasi" class="<?= $Grid->durasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="penilaian_awal_keperawatan_ralan_psikiatri_durasi"><?= $Grid->renderSort($Grid->durasi) ?></div></th>
<?php } ?>
<?php if ($Grid->nyeri->Visible) { // nyeri ?>
        <th data-name="nyeri" class="<?= $Grid->nyeri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri"><?= $Grid->renderSort($Grid->nyeri) ?></div></th>
<?php } ?>
<?php if ($Grid->provokes->Visible) { // provokes ?>
        <th data-name="provokes" class="<?= $Grid->provokes->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_provokes"><?= $Grid->renderSort($Grid->provokes) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_provokes->Visible) { // ket_provokes ?>
        <th data-name="ket_provokes" class="<?= $Grid->ket_provokes->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes"><?= $Grid->renderSort($Grid->ket_provokes) ?></div></th>
<?php } ?>
<?php if ($Grid->quality->Visible) { // quality ?>
        <th data-name="quality" class="<?= $Grid->quality->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_quality"><?= $Grid->renderSort($Grid->quality) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_quality->Visible) { // ket_quality ?>
        <th data-name="ket_quality" class="<?= $Grid->ket_quality->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_quality"><?= $Grid->renderSort($Grid->ket_quality) ?></div></th>
<?php } ?>
<?php if ($Grid->lokasi->Visible) { // lokasi ?>
        <th data-name="lokasi" class="<?= $Grid->lokasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="penilaian_awal_keperawatan_ralan_psikiatri_lokasi"><?= $Grid->renderSort($Grid->lokasi) ?></div></th>
<?php } ?>
<?php if ($Grid->menyebar->Visible) { // menyebar ?>
        <th data-name="menyebar" class="<?= $Grid->menyebar->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="penilaian_awal_keperawatan_ralan_psikiatri_menyebar"><?= $Grid->renderSort($Grid->menyebar) ?></div></th>
<?php } ?>
<?php if ($Grid->pada_dokter->Visible) { // pada_dokter ?>
        <th data-name="pada_dokter" class="<?= $Grid->pada_dokter->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter"><?= $Grid->renderSort($Grid->pada_dokter) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_dokter->Visible) { // ket_dokter ?>
        <th data-name="ket_dokter" class="<?= $Grid->ket_dokter->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter"><?= $Grid->renderSort($Grid->ket_dokter) ?></div></th>
<?php } ?>
<?php if ($Grid->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <th data-name="nyeri_hilang" class="<?= $Grid->nyeri_hilang->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang"><?= $Grid->renderSort($Grid->nyeri_hilang) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_nyeri->Visible) { // ket_nyeri ?>
        <th data-name="ket_nyeri" class="<?= $Grid->ket_nyeri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri"><?= $Grid->renderSort($Grid->ket_nyeri) ?></div></th>
<?php } ?>
<?php if ($Grid->bb->Visible) { // bb ?>
        <th data-name="bb" class="<?= $Grid->bb->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="penilaian_awal_keperawatan_ralan_psikiatri_bb"><?= $Grid->renderSort($Grid->bb) ?></div></th>
<?php } ?>
<?php if ($Grid->tb->Visible) { // tb ?>
        <th data-name="tb" class="<?= $Grid->tb->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="penilaian_awal_keperawatan_ralan_psikiatri_tb"><?= $Grid->renderSort($Grid->tb) ?></div></th>
<?php } ?>
<?php if ($Grid->bmi->Visible) { // bmi ?>
        <th data-name="bmi" class="<?= $Grid->bmi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="penilaian_awal_keperawatan_ralan_psikiatri_bmi"><?= $Grid->renderSort($Grid->bmi) ?></div></th>
<?php } ?>
<?php if ($Grid->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <th data-name="lapor_status_nutrisi" class="<?= $Grid->lapor_status_nutrisi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi"><?= $Grid->renderSort($Grid->lapor_status_nutrisi) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <th data-name="ket_lapor_status_nutrisi" class="<?= $Grid->ket_lapor_status_nutrisi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi"><?= $Grid->renderSort($Grid->ket_lapor_status_nutrisi) ?></div></th>
<?php } ?>
<?php if ($Grid->sg1->Visible) { // sg1 ?>
        <th data-name="sg1" class="<?= $Grid->sg1->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="penilaian_awal_keperawatan_ralan_psikiatri_sg1"><?= $Grid->renderSort($Grid->sg1) ?></div></th>
<?php } ?>
<?php if ($Grid->nilai1->Visible) { // nilai1 ?>
        <th data-name="nilai1" class="<?= $Grid->nilai1->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai1"><?= $Grid->renderSort($Grid->nilai1) ?></div></th>
<?php } ?>
<?php if ($Grid->sg2->Visible) { // sg2 ?>
        <th data-name="sg2" class="<?= $Grid->sg2->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="penilaian_awal_keperawatan_ralan_psikiatri_sg2"><?= $Grid->renderSort($Grid->sg2) ?></div></th>
<?php } ?>
<?php if ($Grid->nilai2->Visible) { // nilai2 ?>
        <th data-name="nilai2" class="<?= $Grid->nilai2->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai2"><?= $Grid->renderSort($Grid->nilai2) ?></div></th>
<?php } ?>
<?php if ($Grid->total_hasil->Visible) { // total_hasil ?>
        <th data-name="total_hasil" class="<?= $Grid->total_hasil->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_total_hasil"><?= $Grid->renderSort($Grid->total_hasil) ?></div></th>
<?php } ?>
<?php if ($Grid->resikojatuh->Visible) { // resikojatuh ?>
        <th data-name="resikojatuh" class="<?= $Grid->resikojatuh->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh"><?= $Grid->renderSort($Grid->resikojatuh) ?></div></th>
<?php } ?>
<?php if ($Grid->bjm->Visible) { // bjm ?>
        <th data-name="bjm" class="<?= $Grid->bjm->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="penilaian_awal_keperawatan_ralan_psikiatri_bjm"><?= $Grid->renderSort($Grid->bjm) ?></div></th>
<?php } ?>
<?php if ($Grid->msa->Visible) { // msa ?>
        <th data-name="msa" class="<?= $Grid->msa->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="penilaian_awal_keperawatan_ralan_psikiatri_msa"><?= $Grid->renderSort($Grid->msa) ?></div></th>
<?php } ?>
<?php if ($Grid->hasil->Visible) { // hasil ?>
        <th data-name="hasil" class="<?= $Grid->hasil->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_hasil"><?= $Grid->renderSort($Grid->hasil) ?></div></th>
<?php } ?>
<?php if ($Grid->lapor->Visible) { // lapor ?>
        <th data-name="lapor" class="<?= $Grid->lapor->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor"><?= $Grid->renderSort($Grid->lapor) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_lapor->Visible) { // ket_lapor ?>
        <th data-name="ket_lapor" class="<?= $Grid->ket_lapor->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor"><?= $Grid->renderSort($Grid->ket_lapor) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_mandi->Visible) { // adl_mandi ?>
        <th data-name="adl_mandi" class="<?= $Grid->adl_mandi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi"><?= $Grid->renderSort($Grid->adl_mandi) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <th data-name="adl_berpakaian" class="<?= $Grid->adl_berpakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian"><?= $Grid->renderSort($Grid->adl_berpakaian) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_makan->Visible) { // adl_makan ?>
        <th data-name="adl_makan" class="<?= $Grid->adl_makan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_makan"><?= $Grid->renderSort($Grid->adl_makan) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_bak->Visible) { // adl_bak ?>
        <th data-name="adl_bak" class="<?= $Grid->adl_bak->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bak"><?= $Grid->renderSort($Grid->adl_bak) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_bab->Visible) { // adl_bab ?>
        <th data-name="adl_bab" class="<?= $Grid->adl_bab->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bab"><?= $Grid->renderSort($Grid->adl_bab) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_hobi->Visible) { // adl_hobi ?>
        <th data-name="adl_hobi" class="<?= $Grid->adl_hobi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi"><?= $Grid->renderSort($Grid->adl_hobi) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <th data-name="ket_adl_hobi" class="<?= $Grid->ket_adl_hobi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi"><?= $Grid->renderSort($Grid->ket_adl_hobi) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <th data-name="adl_sosialisasi" class="<?= $Grid->adl_sosialisasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi"><?= $Grid->renderSort($Grid->adl_sosialisasi) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <th data-name="ket_adl_sosialisasi" class="<?= $Grid->ket_adl_sosialisasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi"><?= $Grid->renderSort($Grid->ket_adl_sosialisasi) ?></div></th>
<?php } ?>
<?php if ($Grid->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <th data-name="adl_kegiatan" class="<?= $Grid->adl_kegiatan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan"><?= $Grid->renderSort($Grid->adl_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <th data-name="ket_adl_kegiatan" class="<?= $Grid->ket_adl_kegiatan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan"><?= $Grid->renderSort($Grid->ket_adl_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_penampilan->Visible) { // sk_penampilan ?>
        <th data-name="sk_penampilan" class="<?= $Grid->sk_penampilan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan"><?= $Grid->renderSort($Grid->sk_penampilan) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <th data-name="sk_alam_perasaan" class="<?= $Grid->sk_alam_perasaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan"><?= $Grid->renderSort($Grid->sk_alam_perasaan) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <th data-name="sk_pembicaraan" class="<?= $Grid->sk_pembicaraan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan"><?= $Grid->renderSort($Grid->sk_pembicaraan) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_afek->Visible) { // sk_afek ?>
        <th data-name="sk_afek" class="<?= $Grid->sk_afek->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_afek"><?= $Grid->renderSort($Grid->sk_afek) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <th data-name="sk_aktifitas_motorik" class="<?= $Grid->sk_aktifitas_motorik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik"><?= $Grid->renderSort($Grid->sk_aktifitas_motorik) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <th data-name="sk_gangguan_ringan" class="<?= $Grid->sk_gangguan_ringan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan"><?= $Grid->renderSort($Grid->sk_gangguan_ringan) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <th data-name="sk_proses_pikir" class="<?= $Grid->sk_proses_pikir->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir"><?= $Grid->renderSort($Grid->sk_proses_pikir) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_orientasi->Visible) { // sk_orientasi ?>
        <th data-name="sk_orientasi" class="<?= $Grid->sk_orientasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi"><?= $Grid->renderSort($Grid->sk_orientasi) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <th data-name="sk_tingkat_kesadaran_orientasi" class="<?= $Grid->sk_tingkat_kesadaran_orientasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi"><?= $Grid->renderSort($Grid->sk_tingkat_kesadaran_orientasi) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_memori->Visible) { // sk_memori ?>
        <th data-name="sk_memori" class="<?= $Grid->sk_memori->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_memori"><?= $Grid->renderSort($Grid->sk_memori) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_interaksi->Visible) { // sk_interaksi ?>
        <th data-name="sk_interaksi" class="<?= $Grid->sk_interaksi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi"><?= $Grid->renderSort($Grid->sk_interaksi) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <th data-name="sk_konsentrasi" class="<?= $Grid->sk_konsentrasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi"><?= $Grid->renderSort($Grid->sk_konsentrasi) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_persepsi->Visible) { // sk_persepsi ?>
        <th data-name="sk_persepsi" class="<?= $Grid->sk_persepsi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi"><?= $Grid->renderSort($Grid->sk_persepsi) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <th data-name="ket_sk_persepsi" class="<?= $Grid->ket_sk_persepsi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi"><?= $Grid->renderSort($Grid->ket_sk_persepsi) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <th data-name="sk_isi_pikir" class="<?= $Grid->sk_isi_pikir->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir"><?= $Grid->renderSort($Grid->sk_isi_pikir) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_waham->Visible) { // sk_waham ?>
        <th data-name="sk_waham" class="<?= $Grid->sk_waham->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_waham"><?= $Grid->renderSort($Grid->sk_waham) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <th data-name="ket_sk_waham" class="<?= $Grid->ket_sk_waham->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham"><?= $Grid->renderSort($Grid->ket_sk_waham) ?></div></th>
<?php } ?>
<?php if ($Grid->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <th data-name="sk_daya_tilik_diri" class="<?= $Grid->sk_daya_tilik_diri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri"><?= $Grid->renderSort($Grid->sk_daya_tilik_diri) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <th data-name="ket_sk_daya_tilik_diri" class="<?= $Grid->ket_sk_daya_tilik_diri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri"><?= $Grid->renderSort($Grid->ket_sk_daya_tilik_diri) ?></div></th>
<?php } ?>
<?php if ($Grid->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <th data-name="kk_pembelajaran" class="<?= $Grid->kk_pembelajaran->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran"><?= $Grid->renderSort($Grid->kk_pembelajaran) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <th data-name="ket_kk_pembelajaran" class="<?= $Grid->ket_kk_pembelajaran->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran"><?= $Grid->renderSort($Grid->ket_kk_pembelajaran) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <th data-name="ket_kk_pembelajaran_lainnya" class="<?= $Grid->ket_kk_pembelajaran_lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya"><?= $Grid->renderSort($Grid->ket_kk_pembelajaran_lainnya) ?></div></th>
<?php } ?>
<?php if ($Grid->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <th data-name="kk_Penerjamah" class="<?= $Grid->kk_Penerjamah->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah"><?= $Grid->renderSort($Grid->kk_Penerjamah) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <th data-name="ket_kk_penerjamah_Lainnya" class="<?= $Grid->ket_kk_penerjamah_Lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya"><?= $Grid->renderSort($Grid->ket_kk_penerjamah_Lainnya) ?></div></th>
<?php } ?>
<?php if ($Grid->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <th data-name="kk_bahasa_isyarat" class="<?= $Grid->kk_bahasa_isyarat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat"><?= $Grid->renderSort($Grid->kk_bahasa_isyarat) ?></div></th>
<?php } ?>
<?php if ($Grid->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <th data-name="kk_kebutuhan_edukasi" class="<?= $Grid->kk_kebutuhan_edukasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi"><?= $Grid->renderSort($Grid->kk_kebutuhan_edukasi) ?></div></th>
<?php } ?>
<?php if ($Grid->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <th data-name="ket_kk_kebutuhan_edukasi" class="<?= $Grid->ket_kk_kebutuhan_edukasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi"><?= $Grid->renderSort($Grid->ket_kk_kebutuhan_edukasi) ?></div></th>
<?php } ?>
<?php if ($Grid->rencana->Visible) { // rencana ?>
        <th data-name="rencana" class="<?= $Grid->rencana->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rencana"><?= $Grid->renderSort($Grid->rencana) ?></div></th>
<?php } ?>
<?php if ($Grid->nip->Visible) { // nip ?>
        <th data-name="nip" class="<?= $Grid->nip->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="penilaian_awal_keperawatan_ralan_psikiatri_nip"><?= $Grid->renderSort($Grid->nip) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_penilaian_awal_keperawatan_ralan_psikiatri", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->no_rawat->Visible) { // no_rawat ?>
        <td data-name="no_rawat" <?= $Grid->no_rawat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<?= $Grid->no_rawat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Grid->tanggal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="form-group">
<input type="<?= $Grid->tanggal->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" placeholder="<?= HtmlEncode($Grid->tanggal->getPlaceHolder()) ?>" value="<?= $Grid->tanggal->EditValue ?>"<?= $Grid->tanggal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal->ReadOnly && !$Grid->tanggal->Disabled && !isset($Grid->tanggal->EditAttrs["readonly"]) && !isset($Grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_awal_keperawatan_ralan_psikiatrigrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_awal_keperawatan_ralan_psikiatrigrid", "x<?= $Grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="form-group">
<input type="<?= $Grid->tanggal->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" placeholder="<?= HtmlEncode($Grid->tanggal->getPlaceHolder()) ?>" value="<?= $Grid->tanggal->EditValue ?>"<?= $Grid->tanggal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal->ReadOnly && !$Grid->tanggal->Disabled && !isset($Grid->tanggal->EditAttrs["readonly"]) && !isset($Grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_awal_keperawatan_ralan_psikiatrigrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_awal_keperawatan_ralan_psikiatrigrid", "x<?= $Grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<?= $Grid->tanggal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->informasi->Visible) { // informasi ?>
        <td data-name="informasi" <?= $Grid->informasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi"<?= $Grid->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_informasi"
    name="x<?= $Grid->RowIndex ?>_informasi"
    value="<?= HtmlEncode($Grid->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_informasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_informasi"
    data-value-separator="<?= $Grid->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->informasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->informasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_informasi" id="o<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi"<?= $Grid->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_informasi"
    name="x<?= $Grid->RowIndex ?>_informasi"
    value="<?= HtmlEncode($Grid->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_informasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_informasi"
    data-value-separator="<?= $Grid->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->informasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->informasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_informasi">
<span<?= $Grid->informasi->viewAttributes() ?>>
<?= $Grid->informasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_informasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_informasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <td data-name="rkd_sakit_sejak" <?= $Grid->rkd_sakit_sejak->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="form-group">
<input type="<?= $Grid->rkd_sakit_sejak->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" name="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->rkd_sakit_sejak->getPlaceHolder()) ?>" value="<?= $Grid->rkd_sakit_sejak->EditValue ?>"<?= $Grid->rkd_sakit_sejak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_sakit_sejak->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="o<?= $Grid->RowIndex ?>_rkd_sakit_sejak" value="<?= HtmlEncode($Grid->rkd_sakit_sejak->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="form-group">
<input type="<?= $Grid->rkd_sakit_sejak->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" name="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->rkd_sakit_sejak->getPlaceHolder()) ?>" value="<?= $Grid->rkd_sakit_sejak->EditValue ?>"<?= $Grid->rkd_sakit_sejak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_sakit_sejak->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak">
<span<?= $Grid->rkd_sakit_sejak->viewAttributes() ?>>
<?= $Grid->rkd_sakit_sejak->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" value="<?= HtmlEncode($Grid->rkd_sakit_sejak->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rkd_sakit_sejak" value="<?= HtmlEncode($Grid->rkd_sakit_sejak->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rkd_berobat->Visible) { // rkd_berobat ?>
        <td data-name="rkd_berobat" <?= $Grid->rkd_berobat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rkd_berobat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" name="x<?= $Grid->RowIndex ?>_rkd_berobat" id="x<?= $Grid->RowIndex ?>_rkd_berobat"<?= $Grid->rkd_berobat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rkd_berobat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rkd_berobat"
    name="x<?= $Grid->RowIndex ?>_rkd_berobat"
    value="<?= HtmlEncode($Grid->rkd_berobat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rkd_berobat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rkd_berobat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rkd_berobat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_berobat"
    data-value-separator="<?= $Grid->rkd_berobat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rkd_berobat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_berobat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rkd_berobat" id="o<?= $Grid->RowIndex ?>_rkd_berobat" value="<?= HtmlEncode($Grid->rkd_berobat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rkd_berobat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" name="x<?= $Grid->RowIndex ?>_rkd_berobat" id="x<?= $Grid->RowIndex ?>_rkd_berobat"<?= $Grid->rkd_berobat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rkd_berobat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rkd_berobat"
    name="x<?= $Grid->RowIndex ?>_rkd_berobat"
    value="<?= HtmlEncode($Grid->rkd_berobat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rkd_berobat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rkd_berobat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rkd_berobat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_berobat"
    data-value-separator="<?= $Grid->rkd_berobat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rkd_berobat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_berobat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat">
<span<?= $Grid->rkd_berobat->viewAttributes() ?>>
<?= $Grid->rkd_berobat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rkd_berobat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rkd_berobat" value="<?= HtmlEncode($Grid->rkd_berobat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rkd_berobat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rkd_berobat" value="<?= HtmlEncode($Grid->rkd_berobat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <td data-name="rkd_hasil_pengobatan" <?= $Grid->rkd_hasil_pengobatan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" name="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"<?= $Grid->rkd_hasil_pengobatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    name="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rkd_hasil_pengobatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_hasil_pengobatan"
    data-value-separator="<?= $Grid->rkd_hasil_pengobatan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rkd_hasil_pengobatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_hasil_pengobatan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="o<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" name="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"<?= $Grid->rkd_hasil_pengobatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    name="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rkd_hasil_pengobatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_hasil_pengobatan"
    data-value-separator="<?= $Grid->rkd_hasil_pengobatan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rkd_hasil_pengobatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_hasil_pengobatan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan">
<span<?= $Grid->rkd_hasil_pengobatan->viewAttributes() ?>>
<?= $Grid->rkd_hasil_pengobatan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <td data-name="fp_putus_obat" <?= $Grid->fp_putus_obat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_putus_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" name="x<?= $Grid->RowIndex ?>_fp_putus_obat" id="x<?= $Grid->RowIndex ?>_fp_putus_obat"<?= $Grid->fp_putus_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_putus_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_putus_obat"
    name="x<?= $Grid->RowIndex ?>_fp_putus_obat"
    value="<?= HtmlEncode($Grid->fp_putus_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_putus_obat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_putus_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_putus_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_putus_obat"
    data-value-separator="<?= $Grid->fp_putus_obat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_putus_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_putus_obat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_putus_obat" id="o<?= $Grid->RowIndex ?>_fp_putus_obat" value="<?= HtmlEncode($Grid->fp_putus_obat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_putus_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" name="x<?= $Grid->RowIndex ?>_fp_putus_obat" id="x<?= $Grid->RowIndex ?>_fp_putus_obat"<?= $Grid->fp_putus_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_putus_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_putus_obat"
    name="x<?= $Grid->RowIndex ?>_fp_putus_obat"
    value="<?= HtmlEncode($Grid->fp_putus_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_putus_obat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_putus_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_putus_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_putus_obat"
    data-value-separator="<?= $Grid->fp_putus_obat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_putus_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_putus_obat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat">
<span<?= $Grid->fp_putus_obat->viewAttributes() ?>>
<?= $Grid->fp_putus_obat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_putus_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_putus_obat" value="<?= HtmlEncode($Grid->fp_putus_obat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_putus_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_putus_obat" value="<?= HtmlEncode($Grid->fp_putus_obat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <td data-name="ket_putus_obat" <?= $Grid->ket_putus_obat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="form-group">
<input type="<?= $Grid->ket_putus_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" name="x<?= $Grid->RowIndex ?>_ket_putus_obat" id="x<?= $Grid->RowIndex ?>_ket_putus_obat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_putus_obat->getPlaceHolder()) ?>" value="<?= $Grid->ket_putus_obat->EditValue ?>"<?= $Grid->ket_putus_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_putus_obat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_putus_obat" id="o<?= $Grid->RowIndex ?>_ket_putus_obat" value="<?= HtmlEncode($Grid->ket_putus_obat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="form-group">
<input type="<?= $Grid->ket_putus_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" name="x<?= $Grid->RowIndex ?>_ket_putus_obat" id="x<?= $Grid->RowIndex ?>_ket_putus_obat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_putus_obat->getPlaceHolder()) ?>" value="<?= $Grid->ket_putus_obat->EditValue ?>"<?= $Grid->ket_putus_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_putus_obat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat">
<span<?= $Grid->ket_putus_obat->viewAttributes() ?>>
<?= $Grid->ket_putus_obat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_putus_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_putus_obat" value="<?= HtmlEncode($Grid->ket_putus_obat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_putus_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_putus_obat" value="<?= HtmlEncode($Grid->ket_putus_obat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <td data-name="fp_ekonomi" <?= $Grid->fp_ekonomi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_ekonomi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" name="x<?= $Grid->RowIndex ?>_fp_ekonomi" id="x<?= $Grid->RowIndex ?>_fp_ekonomi"<?= $Grid->fp_ekonomi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_ekonomi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_ekonomi"
    name="x<?= $Grid->RowIndex ?>_fp_ekonomi"
    value="<?= HtmlEncode($Grid->fp_ekonomi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_ekonomi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_ekonomi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_ekonomi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_ekonomi"
    data-value-separator="<?= $Grid->fp_ekonomi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_ekonomi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_ekonomi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_ekonomi" id="o<?= $Grid->RowIndex ?>_fp_ekonomi" value="<?= HtmlEncode($Grid->fp_ekonomi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_ekonomi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" name="x<?= $Grid->RowIndex ?>_fp_ekonomi" id="x<?= $Grid->RowIndex ?>_fp_ekonomi"<?= $Grid->fp_ekonomi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_ekonomi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_ekonomi"
    name="x<?= $Grid->RowIndex ?>_fp_ekonomi"
    value="<?= HtmlEncode($Grid->fp_ekonomi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_ekonomi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_ekonomi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_ekonomi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_ekonomi"
    data-value-separator="<?= $Grid->fp_ekonomi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_ekonomi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_ekonomi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi">
<span<?= $Grid->fp_ekonomi->viewAttributes() ?>>
<?= $Grid->fp_ekonomi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_ekonomi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_ekonomi" value="<?= HtmlEncode($Grid->fp_ekonomi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_ekonomi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_ekonomi" value="<?= HtmlEncode($Grid->fp_ekonomi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <td data-name="ket_masalah_ekonomi" <?= $Grid->ket_masalah_ekonomi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="form-group">
<input type="<?= $Grid->ket_masalah_ekonomi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" name="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_ekonomi->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_ekonomi->EditValue ?>"<?= $Grid->ket_masalah_ekonomi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_ekonomi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="o<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" value="<?= HtmlEncode($Grid->ket_masalah_ekonomi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="form-group">
<input type="<?= $Grid->ket_masalah_ekonomi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" name="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_ekonomi->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_ekonomi->EditValue ?>"<?= $Grid->ket_masalah_ekonomi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_ekonomi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi">
<span<?= $Grid->ket_masalah_ekonomi->viewAttributes() ?>>
<?= $Grid->ket_masalah_ekonomi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" value="<?= HtmlEncode($Grid->ket_masalah_ekonomi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" value="<?= HtmlEncode($Grid->ket_masalah_ekonomi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <td data-name="fp_masalah_fisik" <?= $Grid->fp_masalah_fisik->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_masalah_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" name="x<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"<?= $Grid->fp_masalah_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    name="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    value="<?= HtmlEncode($Grid->fp_masalah_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_masalah_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_fisik"
    data-value-separator="<?= $Grid->fp_masalah_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_masalah_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_masalah_fisik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="o<?= $Grid->RowIndex ?>_fp_masalah_fisik" value="<?= HtmlEncode($Grid->fp_masalah_fisik->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_masalah_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" name="x<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"<?= $Grid->fp_masalah_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    name="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    value="<?= HtmlEncode($Grid->fp_masalah_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_masalah_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_fisik"
    data-value-separator="<?= $Grid->fp_masalah_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_masalah_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_masalah_fisik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik">
<span<?= $Grid->fp_masalah_fisik->viewAttributes() ?>>
<?= $Grid->fp_masalah_fisik->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_masalah_fisik" value="<?= HtmlEncode($Grid->fp_masalah_fisik->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_masalah_fisik" value="<?= HtmlEncode($Grid->fp_masalah_fisik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <td data-name="ket_masalah_fisik" <?= $Grid->ket_masalah_fisik->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="form-group">
<input type="<?= $Grid->ket_masalah_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" name="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_fisik->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_fisik->EditValue ?>"<?= $Grid->ket_masalah_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_fisik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="o<?= $Grid->RowIndex ?>_ket_masalah_fisik" value="<?= HtmlEncode($Grid->ket_masalah_fisik->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="form-group">
<input type="<?= $Grid->ket_masalah_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" name="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_fisik->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_fisik->EditValue ?>"<?= $Grid->ket_masalah_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_fisik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik">
<span<?= $Grid->ket_masalah_fisik->viewAttributes() ?>>
<?= $Grid->ket_masalah_fisik->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_masalah_fisik" value="<?= HtmlEncode($Grid->ket_masalah_fisik->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_masalah_fisik" value="<?= HtmlEncode($Grid->ket_masalah_fisik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <td data-name="fp_masalah_psikososial" <?= $Grid->fp_masalah_psikososial->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" name="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"<?= $Grid->fp_masalah_psikososial->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    name="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    value="<?= HtmlEncode($Grid->fp_masalah_psikososial->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_masalah_psikososial->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_psikososial"
    data-value-separator="<?= $Grid->fp_masalah_psikososial->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_masalah_psikososial->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_masalah_psikososial->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="o<?= $Grid->RowIndex ?>_fp_masalah_psikososial" value="<?= HtmlEncode($Grid->fp_masalah_psikososial->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" name="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"<?= $Grid->fp_masalah_psikososial->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    name="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    value="<?= HtmlEncode($Grid->fp_masalah_psikososial->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_masalah_psikososial->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_psikososial"
    data-value-separator="<?= $Grid->fp_masalah_psikososial->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_masalah_psikososial->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_masalah_psikososial->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial">
<span<?= $Grid->fp_masalah_psikososial->viewAttributes() ?>>
<?= $Grid->fp_masalah_psikososial->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" value="<?= HtmlEncode($Grid->fp_masalah_psikososial->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_fp_masalah_psikososial" value="<?= HtmlEncode($Grid->fp_masalah_psikososial->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <td data-name="ket_masalah_psikososial" <?= $Grid->ket_masalah_psikososial->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="form-group">
<input type="<?= $Grid->ket_masalah_psikososial->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" name="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_psikososial->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_psikososial->EditValue ?>"<?= $Grid->ket_masalah_psikososial->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_psikososial->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="o<?= $Grid->RowIndex ?>_ket_masalah_psikososial" value="<?= HtmlEncode($Grid->ket_masalah_psikososial->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="form-group">
<input type="<?= $Grid->ket_masalah_psikososial->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" name="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_psikososial->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_psikososial->EditValue ?>"<?= $Grid->ket_masalah_psikososial->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_psikososial->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial">
<span<?= $Grid->ket_masalah_psikososial->viewAttributes() ?>>
<?= $Grid->ket_masalah_psikososial->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" value="<?= HtmlEncode($Grid->ket_masalah_psikososial->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_masalah_psikososial" value="<?= HtmlEncode($Grid->ket_masalah_psikososial->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rh_keluarga->Visible) { // rh_keluarga ?>
        <td data-name="rh_keluarga" <?= $Grid->rh_keluarga->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rh_keluarga">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" name="x<?= $Grid->RowIndex ?>_rh_keluarga" id="x<?= $Grid->RowIndex ?>_rh_keluarga"<?= $Grid->rh_keluarga->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rh_keluarga" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rh_keluarga"
    name="x<?= $Grid->RowIndex ?>_rh_keluarga"
    value="<?= HtmlEncode($Grid->rh_keluarga->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rh_keluarga"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rh_keluarga"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rh_keluarga->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rh_keluarga"
    data-value-separator="<?= $Grid->rh_keluarga->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rh_keluarga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rh_keluarga->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rh_keluarga" id="o<?= $Grid->RowIndex ?>_rh_keluarga" value="<?= HtmlEncode($Grid->rh_keluarga->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rh_keluarga">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" name="x<?= $Grid->RowIndex ?>_rh_keluarga" id="x<?= $Grid->RowIndex ?>_rh_keluarga"<?= $Grid->rh_keluarga->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rh_keluarga" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rh_keluarga"
    name="x<?= $Grid->RowIndex ?>_rh_keluarga"
    value="<?= HtmlEncode($Grid->rh_keluarga->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rh_keluarga"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rh_keluarga"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rh_keluarga->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rh_keluarga"
    data-value-separator="<?= $Grid->rh_keluarga->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rh_keluarga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rh_keluarga->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga">
<span<?= $Grid->rh_keluarga->viewAttributes() ?>>
<?= $Grid->rh_keluarga->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rh_keluarga" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rh_keluarga" value="<?= HtmlEncode($Grid->rh_keluarga->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rh_keluarga" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rh_keluarga" value="<?= HtmlEncode($Grid->rh_keluarga->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <td data-name="ket_rh_keluarga" <?= $Grid->ket_rh_keluarga->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="form-group">
<input type="<?= $Grid->ket_rh_keluarga->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" name="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rh_keluarga->getPlaceHolder()) ?>" value="<?= $Grid->ket_rh_keluarga->EditValue ?>"<?= $Grid->ket_rh_keluarga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rh_keluarga->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="o<?= $Grid->RowIndex ?>_ket_rh_keluarga" value="<?= HtmlEncode($Grid->ket_rh_keluarga->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="form-group">
<input type="<?= $Grid->ket_rh_keluarga->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" name="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rh_keluarga->getPlaceHolder()) ?>" value="<?= $Grid->ket_rh_keluarga->EditValue ?>"<?= $Grid->ket_rh_keluarga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rh_keluarga->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga">
<span<?= $Grid->ket_rh_keluarga->viewAttributes() ?>>
<?= $Grid->ket_rh_keluarga->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rh_keluarga" value="<?= HtmlEncode($Grid->ket_rh_keluarga->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rh_keluarga" value="<?= HtmlEncode($Grid->ket_rh_keluarga->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <td data-name="resiko_bunuh_diri" <?= $Grid->resiko_bunuh_diri->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" name="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"<?= $Grid->resiko_bunuh_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    name="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    value="<?= HtmlEncode($Grid->resiko_bunuh_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->resiko_bunuh_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resiko_bunuh_diri"
    data-value-separator="<?= $Grid->resiko_bunuh_diri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->resiko_bunuh_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->resiko_bunuh_diri->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="o<?= $Grid->RowIndex ?>_resiko_bunuh_diri" value="<?= HtmlEncode($Grid->resiko_bunuh_diri->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" name="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"<?= $Grid->resiko_bunuh_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    name="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    value="<?= HtmlEncode($Grid->resiko_bunuh_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->resiko_bunuh_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resiko_bunuh_diri"
    data-value-separator="<?= $Grid->resiko_bunuh_diri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->resiko_bunuh_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->resiko_bunuh_diri->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri">
<span<?= $Grid->resiko_bunuh_diri->viewAttributes() ?>>
<?= $Grid->resiko_bunuh_diri->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" value="<?= HtmlEncode($Grid->resiko_bunuh_diri->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_resiko_bunuh_diri" value="<?= HtmlEncode($Grid->resiko_bunuh_diri->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rbd_ide->Visible) { // rbd_ide ?>
        <td data-name="rbd_ide" <?= $Grid->rbd_ide->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_ide">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" name="x<?= $Grid->RowIndex ?>_rbd_ide" id="x<?= $Grid->RowIndex ?>_rbd_ide"<?= $Grid->rbd_ide->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_ide" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_ide"
    name="x<?= $Grid->RowIndex ?>_rbd_ide"
    value="<?= HtmlEncode($Grid->rbd_ide->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_ide"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_ide"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_ide->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_ide"
    data-value-separator="<?= $Grid->rbd_ide->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_ide->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_ide->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_ide" id="o<?= $Grid->RowIndex ?>_rbd_ide" value="<?= HtmlEncode($Grid->rbd_ide->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_ide">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" name="x<?= $Grid->RowIndex ?>_rbd_ide" id="x<?= $Grid->RowIndex ?>_rbd_ide"<?= $Grid->rbd_ide->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_ide" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_ide"
    name="x<?= $Grid->RowIndex ?>_rbd_ide"
    value="<?= HtmlEncode($Grid->rbd_ide->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_ide"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_ide"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_ide->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_ide"
    data-value-separator="<?= $Grid->rbd_ide->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_ide->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_ide->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide">
<span<?= $Grid->rbd_ide->viewAttributes() ?>>
<?= $Grid->rbd_ide->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_ide" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_ide" value="<?= HtmlEncode($Grid->rbd_ide->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_ide" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_ide" value="<?= HtmlEncode($Grid->rbd_ide->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <td data-name="ket_rbd_ide" <?= $Grid->ket_rbd_ide->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="form-group">
<input type="<?= $Grid->ket_rbd_ide->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" name="x<?= $Grid->RowIndex ?>_ket_rbd_ide" id="x<?= $Grid->RowIndex ?>_ket_rbd_ide" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_ide->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_ide->EditValue ?>"<?= $Grid->ket_rbd_ide->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_ide->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_ide" id="o<?= $Grid->RowIndex ?>_ket_rbd_ide" value="<?= HtmlEncode($Grid->ket_rbd_ide->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="form-group">
<input type="<?= $Grid->ket_rbd_ide->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" name="x<?= $Grid->RowIndex ?>_ket_rbd_ide" id="x<?= $Grid->RowIndex ?>_ket_rbd_ide" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_ide->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_ide->EditValue ?>"<?= $Grid->ket_rbd_ide->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_ide->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide">
<span<?= $Grid->ket_rbd_ide->viewAttributes() ?>>
<?= $Grid->ket_rbd_ide->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_ide" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_ide" value="<?= HtmlEncode($Grid->ket_rbd_ide->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_ide" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_ide" value="<?= HtmlEncode($Grid->ket_rbd_ide->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rbd_rencana->Visible) { // rbd_rencana ?>
        <td data-name="rbd_rencana" <?= $Grid->rbd_rencana->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_rencana">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" name="x<?= $Grid->RowIndex ?>_rbd_rencana" id="x<?= $Grid->RowIndex ?>_rbd_rencana"<?= $Grid->rbd_rencana->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_rencana" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_rencana"
    name="x<?= $Grid->RowIndex ?>_rbd_rencana"
    value="<?= HtmlEncode($Grid->rbd_rencana->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_rencana"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_rencana"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_rencana->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_rencana"
    data-value-separator="<?= $Grid->rbd_rencana->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_rencana->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_rencana" id="o<?= $Grid->RowIndex ?>_rbd_rencana" value="<?= HtmlEncode($Grid->rbd_rencana->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_rencana">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" name="x<?= $Grid->RowIndex ?>_rbd_rencana" id="x<?= $Grid->RowIndex ?>_rbd_rencana"<?= $Grid->rbd_rencana->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_rencana" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_rencana"
    name="x<?= $Grid->RowIndex ?>_rbd_rencana"
    value="<?= HtmlEncode($Grid->rbd_rencana->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_rencana"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_rencana"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_rencana->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_rencana"
    data-value-separator="<?= $Grid->rbd_rencana->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_rencana->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana">
<span<?= $Grid->rbd_rencana->viewAttributes() ?>>
<?= $Grid->rbd_rencana->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_rencana" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_rencana" value="<?= HtmlEncode($Grid->rbd_rencana->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_rencana" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_rencana" value="<?= HtmlEncode($Grid->rbd_rencana->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <td data-name="ket_rbd_rencana" <?= $Grid->ket_rbd_rencana->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="form-group">
<input type="<?= $Grid->ket_rbd_rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" name="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_rencana->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_rencana->EditValue ?>"<?= $Grid->ket_rbd_rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_rencana->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="o<?= $Grid->RowIndex ?>_ket_rbd_rencana" value="<?= HtmlEncode($Grid->ket_rbd_rencana->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="form-group">
<input type="<?= $Grid->ket_rbd_rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" name="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_rencana->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_rencana->EditValue ?>"<?= $Grid->ket_rbd_rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_rencana->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana">
<span<?= $Grid->ket_rbd_rencana->viewAttributes() ?>>
<?= $Grid->ket_rbd_rencana->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_rencana" value="<?= HtmlEncode($Grid->ket_rbd_rencana->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_rencana" value="<?= HtmlEncode($Grid->ket_rbd_rencana->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rbd_alat->Visible) { // rbd_alat ?>
        <td data-name="rbd_alat" <?= $Grid->rbd_alat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_alat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" name="x<?= $Grid->RowIndex ?>_rbd_alat" id="x<?= $Grid->RowIndex ?>_rbd_alat"<?= $Grid->rbd_alat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_alat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_alat"
    name="x<?= $Grid->RowIndex ?>_rbd_alat"
    value="<?= HtmlEncode($Grid->rbd_alat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_alat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_alat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_alat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_alat"
    data-value-separator="<?= $Grid->rbd_alat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_alat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_alat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_alat" id="o<?= $Grid->RowIndex ?>_rbd_alat" value="<?= HtmlEncode($Grid->rbd_alat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_alat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" name="x<?= $Grid->RowIndex ?>_rbd_alat" id="x<?= $Grid->RowIndex ?>_rbd_alat"<?= $Grid->rbd_alat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_alat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_alat"
    name="x<?= $Grid->RowIndex ?>_rbd_alat"
    value="<?= HtmlEncode($Grid->rbd_alat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_alat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_alat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_alat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_alat"
    data-value-separator="<?= $Grid->rbd_alat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_alat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_alat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat">
<span<?= $Grid->rbd_alat->viewAttributes() ?>>
<?= $Grid->rbd_alat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_alat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_alat" value="<?= HtmlEncode($Grid->rbd_alat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_alat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_alat" value="<?= HtmlEncode($Grid->rbd_alat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <td data-name="ket_rbd_alat" <?= $Grid->ket_rbd_alat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="form-group">
<input type="<?= $Grid->ket_rbd_alat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" name="x<?= $Grid->RowIndex ?>_ket_rbd_alat" id="x<?= $Grid->RowIndex ?>_ket_rbd_alat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_alat->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_alat->EditValue ?>"<?= $Grid->ket_rbd_alat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_alat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_alat" id="o<?= $Grid->RowIndex ?>_ket_rbd_alat" value="<?= HtmlEncode($Grid->ket_rbd_alat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="form-group">
<input type="<?= $Grid->ket_rbd_alat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" name="x<?= $Grid->RowIndex ?>_ket_rbd_alat" id="x<?= $Grid->RowIndex ?>_ket_rbd_alat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_alat->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_alat->EditValue ?>"<?= $Grid->ket_rbd_alat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_alat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat">
<span<?= $Grid->ket_rbd_alat->viewAttributes() ?>>
<?= $Grid->ket_rbd_alat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_alat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_alat" value="<?= HtmlEncode($Grid->ket_rbd_alat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_alat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_alat" value="<?= HtmlEncode($Grid->ket_rbd_alat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <td data-name="rbd_percobaan" <?= $Grid->rbd_percobaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_percobaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" name="x<?= $Grid->RowIndex ?>_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_rbd_percobaan"<?= $Grid->rbd_percobaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_percobaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_percobaan"
    name="x<?= $Grid->RowIndex ?>_rbd_percobaan"
    value="<?= HtmlEncode($Grid->rbd_percobaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_percobaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_percobaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_percobaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_percobaan"
    data-value-separator="<?= $Grid->rbd_percobaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_percobaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_percobaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_percobaan" id="o<?= $Grid->RowIndex ?>_rbd_percobaan" value="<?= HtmlEncode($Grid->rbd_percobaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_percobaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" name="x<?= $Grid->RowIndex ?>_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_rbd_percobaan"<?= $Grid->rbd_percobaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_percobaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_percobaan"
    name="x<?= $Grid->RowIndex ?>_rbd_percobaan"
    value="<?= HtmlEncode($Grid->rbd_percobaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_percobaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_percobaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_percobaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_percobaan"
    data-value-separator="<?= $Grid->rbd_percobaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_percobaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_percobaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan">
<span<?= $Grid->rbd_percobaan->viewAttributes() ?>>
<?= $Grid->rbd_percobaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_percobaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_percobaan" value="<?= HtmlEncode($Grid->rbd_percobaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_percobaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_percobaan" value="<?= HtmlEncode($Grid->rbd_percobaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <td data-name="ket_rbd_percobaan" <?= $Grid->ket_rbd_percobaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="form-group">
<input type="<?= $Grid->ket_rbd_percobaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" name="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_rbd_percobaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_percobaan->EditValue ?>"<?= $Grid->ket_rbd_percobaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_percobaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="o<?= $Grid->RowIndex ?>_ket_rbd_percobaan" value="<?= HtmlEncode($Grid->ket_rbd_percobaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="form-group">
<input type="<?= $Grid->ket_rbd_percobaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" name="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_rbd_percobaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_percobaan->EditValue ?>"<?= $Grid->ket_rbd_percobaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_percobaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan">
<span<?= $Grid->ket_rbd_percobaan->viewAttributes() ?>>
<?= $Grid->ket_rbd_percobaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" value="<?= HtmlEncode($Grid->ket_rbd_percobaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_percobaan" value="<?= HtmlEncode($Grid->ket_rbd_percobaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <td data-name="rbd_keinginan" <?= $Grid->rbd_keinginan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_keinginan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" name="x<?= $Grid->RowIndex ?>_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_rbd_keinginan"<?= $Grid->rbd_keinginan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_keinginan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_keinginan"
    name="x<?= $Grid->RowIndex ?>_rbd_keinginan"
    value="<?= HtmlEncode($Grid->rbd_keinginan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_keinginan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_keinginan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_keinginan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_keinginan"
    data-value-separator="<?= $Grid->rbd_keinginan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_keinginan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_keinginan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_keinginan" id="o<?= $Grid->RowIndex ?>_rbd_keinginan" value="<?= HtmlEncode($Grid->rbd_keinginan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_keinginan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" name="x<?= $Grid->RowIndex ?>_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_rbd_keinginan"<?= $Grid->rbd_keinginan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_keinginan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_keinginan"
    name="x<?= $Grid->RowIndex ?>_rbd_keinginan"
    value="<?= HtmlEncode($Grid->rbd_keinginan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_keinginan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_keinginan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_keinginan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_keinginan"
    data-value-separator="<?= $Grid->rbd_keinginan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_keinginan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_keinginan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan">
<span<?= $Grid->rbd_keinginan->viewAttributes() ?>>
<?= $Grid->rbd_keinginan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_keinginan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rbd_keinginan" value="<?= HtmlEncode($Grid->rbd_keinginan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_keinginan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rbd_keinginan" value="<?= HtmlEncode($Grid->rbd_keinginan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <td data-name="ket_rbd_keinginan" <?= $Grid->ket_rbd_keinginan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="form-group">
<input type="<?= $Grid->ket_rbd_keinginan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" name="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_rbd_keinginan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_keinginan->EditValue ?>"<?= $Grid->ket_rbd_keinginan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_keinginan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="o<?= $Grid->RowIndex ?>_ket_rbd_keinginan" value="<?= HtmlEncode($Grid->ket_rbd_keinginan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="form-group">
<input type="<?= $Grid->ket_rbd_keinginan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" name="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_rbd_keinginan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_keinginan->EditValue ?>"<?= $Grid->ket_rbd_keinginan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_keinginan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan">
<span<?= $Grid->ket_rbd_keinginan->viewAttributes() ?>>
<?= $Grid->ket_rbd_keinginan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" value="<?= HtmlEncode($Grid->ket_rbd_keinginan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rbd_keinginan" value="<?= HtmlEncode($Grid->ket_rbd_keinginan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <td data-name="rpo_penggunaan" <?= $Grid->rpo_penggunaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan"<?= $Grid->rpo_penggunaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    name="x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    value="<?= HtmlEncode($Grid->rpo_penggunaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_penggunaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan"
    data-value-separator="<?= $Grid->rpo_penggunaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_penggunaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_penggunaan" id="o<?= $Grid->RowIndex ?>_rpo_penggunaan" value="<?= HtmlEncode($Grid->rpo_penggunaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan"<?= $Grid->rpo_penggunaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    name="x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    value="<?= HtmlEncode($Grid->rpo_penggunaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_penggunaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan"
    data-value-separator="<?= $Grid->rpo_penggunaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_penggunaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan">
<span<?= $Grid->rpo_penggunaan->viewAttributes() ?>>
<?= $Grid->rpo_penggunaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_penggunaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_penggunaan" value="<?= HtmlEncode($Grid->rpo_penggunaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_penggunaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_penggunaan" value="<?= HtmlEncode($Grid->rpo_penggunaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <td data-name="ket_rpo_penggunaan" <?= $Grid->ket_rpo_penggunaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="form-group">
<input type="<?= $Grid->ket_rpo_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" name="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_rpo_penggunaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_penggunaan->EditValue ?>"<?= $Grid->ket_rpo_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_penggunaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="o<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" value="<?= HtmlEncode($Grid->ket_rpo_penggunaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="form-group">
<input type="<?= $Grid->ket_rpo_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" name="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_rpo_penggunaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_penggunaan->EditValue ?>"<?= $Grid->ket_rpo_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_penggunaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan">
<span<?= $Grid->ket_rpo_penggunaan->viewAttributes() ?>>
<?= $Grid->ket_rpo_penggunaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" value="<?= HtmlEncode($Grid->ket_rpo_penggunaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" value="<?= HtmlEncode($Grid->ket_rpo_penggunaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <td data-name="rpo_efek_samping" <?= $Grid->rpo_efek_samping->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_efek_samping">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" name="x<?= $Grid->RowIndex ?>_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_rpo_efek_samping"<?= $Grid->rpo_efek_samping->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_efek_samping" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    name="x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    value="<?= HtmlEncode($Grid->rpo_efek_samping->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_efek_samping->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_efek_samping"
    data-value-separator="<?= $Grid->rpo_efek_samping->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_efek_samping->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_efek_samping->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_efek_samping" id="o<?= $Grid->RowIndex ?>_rpo_efek_samping" value="<?= HtmlEncode($Grid->rpo_efek_samping->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_efek_samping">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" name="x<?= $Grid->RowIndex ?>_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_rpo_efek_samping"<?= $Grid->rpo_efek_samping->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_efek_samping" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    name="x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    value="<?= HtmlEncode($Grid->rpo_efek_samping->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_efek_samping->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_efek_samping"
    data-value-separator="<?= $Grid->rpo_efek_samping->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_efek_samping->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_efek_samping->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping">
<span<?= $Grid->rpo_efek_samping->viewAttributes() ?>>
<?= $Grid->rpo_efek_samping->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_efek_samping" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_efek_samping" value="<?= HtmlEncode($Grid->rpo_efek_samping->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_efek_samping" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_efek_samping" value="<?= HtmlEncode($Grid->rpo_efek_samping->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <td data-name="ket_rpo_efek_samping" <?= $Grid->ket_rpo_efek_samping->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="form-group">
<input type="<?= $Grid->ket_rpo_efek_samping->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" name="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_rpo_efek_samping->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_efek_samping->EditValue ?>"<?= $Grid->ket_rpo_efek_samping->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_efek_samping->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="o<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" value="<?= HtmlEncode($Grid->ket_rpo_efek_samping->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="form-group">
<input type="<?= $Grid->ket_rpo_efek_samping->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" name="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_rpo_efek_samping->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_efek_samping->EditValue ?>"<?= $Grid->ket_rpo_efek_samping->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_efek_samping->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping">
<span<?= $Grid->ket_rpo_efek_samping->viewAttributes() ?>>
<?= $Grid->ket_rpo_efek_samping->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" value="<?= HtmlEncode($Grid->ket_rpo_efek_samping->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" value="<?= HtmlEncode($Grid->ket_rpo_efek_samping->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rpo_napza->Visible) { // rpo_napza ?>
        <td data-name="rpo_napza" <?= $Grid->rpo_napza->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_napza">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" name="x<?= $Grid->RowIndex ?>_rpo_napza" id="x<?= $Grid->RowIndex ?>_rpo_napza"<?= $Grid->rpo_napza->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_napza" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_napza"
    name="x<?= $Grid->RowIndex ?>_rpo_napza"
    value="<?= HtmlEncode($Grid->rpo_napza->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_napza"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_napza"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_napza->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_napza"
    data-value-separator="<?= $Grid->rpo_napza->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_napza->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_napza->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_napza" id="o<?= $Grid->RowIndex ?>_rpo_napza" value="<?= HtmlEncode($Grid->rpo_napza->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_napza">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" name="x<?= $Grid->RowIndex ?>_rpo_napza" id="x<?= $Grid->RowIndex ?>_rpo_napza"<?= $Grid->rpo_napza->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_napza" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_napza"
    name="x<?= $Grid->RowIndex ?>_rpo_napza"
    value="<?= HtmlEncode($Grid->rpo_napza->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_napza"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_napza"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_napza->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_napza"
    data-value-separator="<?= $Grid->rpo_napza->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_napza->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_napza->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza">
<span<?= $Grid->rpo_napza->viewAttributes() ?>>
<?= $Grid->rpo_napza->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_napza" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_napza" value="<?= HtmlEncode($Grid->rpo_napza->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_napza" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_napza" value="<?= HtmlEncode($Grid->rpo_napza->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <td data-name="ket_rpo_napza" <?= $Grid->ket_rpo_napza->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="form-group">
<input type="<?= $Grid->ket_rpo_napza->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" name="x<?= $Grid->RowIndex ?>_ket_rpo_napza" id="x<?= $Grid->RowIndex ?>_ket_rpo_napza" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_rpo_napza->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_napza->EditValue ?>"<?= $Grid->ket_rpo_napza->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_napza->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rpo_napza" id="o<?= $Grid->RowIndex ?>_ket_rpo_napza" value="<?= HtmlEncode($Grid->ket_rpo_napza->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="form-group">
<input type="<?= $Grid->ket_rpo_napza->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" name="x<?= $Grid->RowIndex ?>_ket_rpo_napza" id="x<?= $Grid->RowIndex ?>_ket_rpo_napza" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_rpo_napza->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_napza->EditValue ?>"<?= $Grid->ket_rpo_napza->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_napza->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza">
<span<?= $Grid->ket_rpo_napza->viewAttributes() ?>>
<?= $Grid->ket_rpo_napza->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rpo_napza" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_rpo_napza" value="<?= HtmlEncode($Grid->ket_rpo_napza->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rpo_napza" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_rpo_napza" value="<?= HtmlEncode($Grid->ket_rpo_napza->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <td data-name="ket_lama_pemakaian" <?= $Grid->ket_lama_pemakaian->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="form-group">
<input type="<?= $Grid->ket_lama_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->ket_lama_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_lama_pemakaian->EditValue ?>"<?= $Grid->ket_lama_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lama_pemakaian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="o<?= $Grid->RowIndex ?>_ket_lama_pemakaian" value="<?= HtmlEncode($Grid->ket_lama_pemakaian->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="form-group">
<input type="<?= $Grid->ket_lama_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->ket_lama_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_lama_pemakaian->EditValue ?>"<?= $Grid->ket_lama_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lama_pemakaian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian">
<span<?= $Grid->ket_lama_pemakaian->viewAttributes() ?>>
<?= $Grid->ket_lama_pemakaian->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" value="<?= HtmlEncode($Grid->ket_lama_pemakaian->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_lama_pemakaian" value="<?= HtmlEncode($Grid->ket_lama_pemakaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <td data-name="ket_cara_pemakaian" <?= $Grid->ket_cara_pemakaian->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="form-group">
<input type="<?= $Grid->ket_cara_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_cara_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_cara_pemakaian->EditValue ?>"<?= $Grid->ket_cara_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_cara_pemakaian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="o<?= $Grid->RowIndex ?>_ket_cara_pemakaian" value="<?= HtmlEncode($Grid->ket_cara_pemakaian->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="form-group">
<input type="<?= $Grid->ket_cara_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_cara_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_cara_pemakaian->EditValue ?>"<?= $Grid->ket_cara_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_cara_pemakaian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian">
<span<?= $Grid->ket_cara_pemakaian->viewAttributes() ?>>
<?= $Grid->ket_cara_pemakaian->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" value="<?= HtmlEncode($Grid->ket_cara_pemakaian->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_cara_pemakaian" value="<?= HtmlEncode($Grid->ket_cara_pemakaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <td data-name="ket_latar_belakang_pemakaian" <?= $Grid->ket_latar_belakang_pemakaian->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="form-group">
<input type="<?= $Grid->ket_latar_belakang_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" size="30" maxlength="60" placeholder="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_latar_belakang_pemakaian->EditValue ?>"<?= $Grid->ket_latar_belakang_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_latar_belakang_pemakaian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="o<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" value="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="form-group">
<input type="<?= $Grid->ket_latar_belakang_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" size="30" maxlength="60" placeholder="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_latar_belakang_pemakaian->EditValue ?>"<?= $Grid->ket_latar_belakang_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_latar_belakang_pemakaian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian">
<span<?= $Grid->ket_latar_belakang_pemakaian->viewAttributes() ?>>
<?= $Grid->ket_latar_belakang_pemakaian->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" value="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" value="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <td data-name="rpo_penggunaan_obat_lainnya" <?= $Grid->rpo_penggunaan_obat_lainnya->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"<?= $Grid->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    name="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_penggunaan_obat_lainnya->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan_obat_lainnya"
    data-value-separator="<?= $Grid->rpo_penggunaan_obat_lainnya->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="o<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"<?= $Grid->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    name="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_penggunaan_obat_lainnya->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan_obat_lainnya"
    data-value-separator="<?= $Grid->rpo_penggunaan_obat_lainnya->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya">
<span<?= $Grid->rpo_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Grid->rpo_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <td data-name="ket_penggunaan_obat_lainnya" <?= $Grid->ket_penggunaan_obat_lainnya->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="form-group">
<input type="<?= $Grid->ket_penggunaan_obat_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" name="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_penggunaan_obat_lainnya->EditValue ?>"<?= $Grid->ket_penggunaan_obat_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="o<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="form-group">
<input type="<?= $Grid->ket_penggunaan_obat_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" name="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_penggunaan_obat_lainnya->EditValue ?>"<?= $Grid->ket_penggunaan_obat_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya">
<span<?= $Grid->ket_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Grid->ket_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <td data-name="ket_alasan_penggunaan" <?= $Grid->ket_alasan_penggunaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="form-group">
<input type="<?= $Grid->ket_alasan_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" name="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" size="30" maxlength="65" placeholder="<?= HtmlEncode($Grid->ket_alasan_penggunaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_alasan_penggunaan->EditValue ?>"<?= $Grid->ket_alasan_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_alasan_penggunaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="o<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" value="<?= HtmlEncode($Grid->ket_alasan_penggunaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="form-group">
<input type="<?= $Grid->ket_alasan_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" name="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" size="30" maxlength="65" placeholder="<?= HtmlEncode($Grid->ket_alasan_penggunaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_alasan_penggunaan->EditValue ?>"<?= $Grid->ket_alasan_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_alasan_penggunaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan">
<span<?= $Grid->ket_alasan_penggunaan->viewAttributes() ?>>
<?= $Grid->ket_alasan_penggunaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" value="<?= HtmlEncode($Grid->ket_alasan_penggunaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" value="<?= HtmlEncode($Grid->ket_alasan_penggunaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <td data-name="rpo_alergi_obat" <?= $Grid->rpo_alergi_obat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_alergi_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" name="x<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"<?= $Grid->rpo_alergi_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_alergi_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    name="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    value="<?= HtmlEncode($Grid->rpo_alergi_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_alergi_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_alergi_obat"
    data-value-separator="<?= $Grid->rpo_alergi_obat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_alergi_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_alergi_obat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="o<?= $Grid->RowIndex ?>_rpo_alergi_obat" value="<?= HtmlEncode($Grid->rpo_alergi_obat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_alergi_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" name="x<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"<?= $Grid->rpo_alergi_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_alergi_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    name="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    value="<?= HtmlEncode($Grid->rpo_alergi_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_alergi_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_alergi_obat"
    data-value-separator="<?= $Grid->rpo_alergi_obat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_alergi_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_alergi_obat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat">
<span<?= $Grid->rpo_alergi_obat->viewAttributes() ?>>
<?= $Grid->rpo_alergi_obat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_alergi_obat" value="<?= HtmlEncode($Grid->rpo_alergi_obat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_alergi_obat" value="<?= HtmlEncode($Grid->rpo_alergi_obat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <td data-name="ket_alergi_obat" <?= $Grid->ket_alergi_obat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="form-group">
<input type="<?= $Grid->ket_alergi_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" name="x<?= $Grid->RowIndex ?>_ket_alergi_obat" id="x<?= $Grid->RowIndex ?>_ket_alergi_obat" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_alergi_obat->getPlaceHolder()) ?>" value="<?= $Grid->ket_alergi_obat->EditValue ?>"<?= $Grid->ket_alergi_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_alergi_obat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_alergi_obat" id="o<?= $Grid->RowIndex ?>_ket_alergi_obat" value="<?= HtmlEncode($Grid->ket_alergi_obat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="form-group">
<input type="<?= $Grid->ket_alergi_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" name="x<?= $Grid->RowIndex ?>_ket_alergi_obat" id="x<?= $Grid->RowIndex ?>_ket_alergi_obat" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_alergi_obat->getPlaceHolder()) ?>" value="<?= $Grid->ket_alergi_obat->EditValue ?>"<?= $Grid->ket_alergi_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_alergi_obat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat">
<span<?= $Grid->ket_alergi_obat->viewAttributes() ?>>
<?= $Grid->ket_alergi_obat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_alergi_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_alergi_obat" value="<?= HtmlEncode($Grid->ket_alergi_obat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_alergi_obat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_alergi_obat" value="<?= HtmlEncode($Grid->ket_alergi_obat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rpo_merokok->Visible) { // rpo_merokok ?>
        <td data-name="rpo_merokok" <?= $Grid->rpo_merokok->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_merokok">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" name="x<?= $Grid->RowIndex ?>_rpo_merokok" id="x<?= $Grid->RowIndex ?>_rpo_merokok"<?= $Grid->rpo_merokok->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_merokok" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_merokok"
    name="x<?= $Grid->RowIndex ?>_rpo_merokok"
    value="<?= HtmlEncode($Grid->rpo_merokok->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_merokok"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_merokok"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_merokok->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_merokok"
    data-value-separator="<?= $Grid->rpo_merokok->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_merokok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_merokok->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_merokok" id="o<?= $Grid->RowIndex ?>_rpo_merokok" value="<?= HtmlEncode($Grid->rpo_merokok->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_merokok">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" name="x<?= $Grid->RowIndex ?>_rpo_merokok" id="x<?= $Grid->RowIndex ?>_rpo_merokok"<?= $Grid->rpo_merokok->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_merokok" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_merokok"
    name="x<?= $Grid->RowIndex ?>_rpo_merokok"
    value="<?= HtmlEncode($Grid->rpo_merokok->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_merokok"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_merokok"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_merokok->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_merokok"
    data-value-separator="<?= $Grid->rpo_merokok->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_merokok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_merokok->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok">
<span<?= $Grid->rpo_merokok->viewAttributes() ?>>
<?= $Grid->rpo_merokok->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_merokok" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_merokok" value="<?= HtmlEncode($Grid->rpo_merokok->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_merokok" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_merokok" value="<?= HtmlEncode($Grid->rpo_merokok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_merokok->Visible) { // ket_merokok ?>
        <td data-name="ket_merokok" <?= $Grid->ket_merokok->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="form-group">
<input type="<?= $Grid->ket_merokok->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" name="x<?= $Grid->RowIndex ?>_ket_merokok" id="x<?= $Grid->RowIndex ?>_ket_merokok" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_merokok->getPlaceHolder()) ?>" value="<?= $Grid->ket_merokok->EditValue ?>"<?= $Grid->ket_merokok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_merokok->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_merokok" id="o<?= $Grid->RowIndex ?>_ket_merokok" value="<?= HtmlEncode($Grid->ket_merokok->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="form-group">
<input type="<?= $Grid->ket_merokok->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" name="x<?= $Grid->RowIndex ?>_ket_merokok" id="x<?= $Grid->RowIndex ?>_ket_merokok" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_merokok->getPlaceHolder()) ?>" value="<?= $Grid->ket_merokok->EditValue ?>"<?= $Grid->ket_merokok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_merokok->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok">
<span<?= $Grid->ket_merokok->viewAttributes() ?>>
<?= $Grid->ket_merokok->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_merokok" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_merokok" value="<?= HtmlEncode($Grid->ket_merokok->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_merokok" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_merokok" value="<?= HtmlEncode($Grid->ket_merokok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <td data-name="rpo_minum_kopi" <?= $Grid->rpo_minum_kopi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_minum_kopi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" name="x<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"<?= $Grid->rpo_minum_kopi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_minum_kopi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    name="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    value="<?= HtmlEncode($Grid->rpo_minum_kopi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_minum_kopi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_minum_kopi"
    data-value-separator="<?= $Grid->rpo_minum_kopi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_minum_kopi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_minum_kopi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="o<?= $Grid->RowIndex ?>_rpo_minum_kopi" value="<?= HtmlEncode($Grid->rpo_minum_kopi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_minum_kopi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" name="x<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"<?= $Grid->rpo_minum_kopi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_minum_kopi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    name="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    value="<?= HtmlEncode($Grid->rpo_minum_kopi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_minum_kopi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_minum_kopi"
    data-value-separator="<?= $Grid->rpo_minum_kopi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_minum_kopi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_minum_kopi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi">
<span<?= $Grid->rpo_minum_kopi->viewAttributes() ?>>
<?= $Grid->rpo_minum_kopi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rpo_minum_kopi" value="<?= HtmlEncode($Grid->rpo_minum_kopi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rpo_minum_kopi" value="<?= HtmlEncode($Grid->rpo_minum_kopi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <td data-name="ket_minum_kopi" <?= $Grid->ket_minum_kopi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="form-group">
<input type="<?= $Grid->ket_minum_kopi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" name="x<?= $Grid->RowIndex ?>_ket_minum_kopi" id="x<?= $Grid->RowIndex ?>_ket_minum_kopi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_minum_kopi->getPlaceHolder()) ?>" value="<?= $Grid->ket_minum_kopi->EditValue ?>"<?= $Grid->ket_minum_kopi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_minum_kopi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_minum_kopi" id="o<?= $Grid->RowIndex ?>_ket_minum_kopi" value="<?= HtmlEncode($Grid->ket_minum_kopi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="form-group">
<input type="<?= $Grid->ket_minum_kopi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" name="x<?= $Grid->RowIndex ?>_ket_minum_kopi" id="x<?= $Grid->RowIndex ?>_ket_minum_kopi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_minum_kopi->getPlaceHolder()) ?>" value="<?= $Grid->ket_minum_kopi->EditValue ?>"<?= $Grid->ket_minum_kopi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_minum_kopi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi">
<span<?= $Grid->ket_minum_kopi->viewAttributes() ?>>
<?= $Grid->ket_minum_kopi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_minum_kopi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_minum_kopi" value="<?= HtmlEncode($Grid->ket_minum_kopi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_minum_kopi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_minum_kopi" value="<?= HtmlEncode($Grid->ket_minum_kopi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->td->Visible) { // td ?>
        <td data-name="td" <?= $Grid->td->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_td" class="form-group">
<input type="<?= $Grid->td->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->td->getPlaceHolder()) ?>" value="<?= $Grid->td->EditValue ?>"<?= $Grid->td->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->td->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" data-hidden="1" name="o<?= $Grid->RowIndex ?>_td" id="o<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_td" class="form-group">
<input type="<?= $Grid->td->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->td->getPlaceHolder()) ?>" value="<?= $Grid->td->EditValue ?>"<?= $Grid->td->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->td->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_td">
<span<?= $Grid->td->viewAttributes() ?>>
<?= $Grid->td->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_td" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_td" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nadi->Visible) { // nadi ?>
        <td data-name="nadi" <?= $Grid->nadi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="form-group">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nadi" id="o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="form-group">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nadi">
<span<?= $Grid->nadi->viewAttributes() ?>>
<?= $Grid->nadi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nadi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nadi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->gcs->Visible) { // gcs ?>
        <td data-name="gcs" <?= $Grid->gcs->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="form-group">
<input type="<?= $Grid->gcs->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->gcs->getPlaceHolder()) ?>" value="<?= $Grid->gcs->EditValue ?>"<?= $Grid->gcs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gcs->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gcs" id="o<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="form-group">
<input type="<?= $Grid->gcs->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->gcs->getPlaceHolder()) ?>" value="<?= $Grid->gcs->EditValue ?>"<?= $Grid->gcs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gcs->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_gcs">
<span<?= $Grid->gcs->viewAttributes() ?>>
<?= $Grid->gcs->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_gcs" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_gcs" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rr->Visible) { // rr ?>
        <td data-name="rr" <?= $Grid->rr->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="form-group">
<input type="<?= $Grid->rr->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->rr->getPlaceHolder()) ?>" value="<?= $Grid->rr->EditValue ?>"<?= $Grid->rr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rr->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rr" id="o<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="form-group">
<input type="<?= $Grid->rr->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->rr->getPlaceHolder()) ?>" value="<?= $Grid->rr->EditValue ?>"<?= $Grid->rr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rr->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rr">
<span<?= $Grid->rr->viewAttributes() ?>>
<?= $Grid->rr->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rr" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rr" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->suhu->Visible) { // suhu ?>
        <td data-name="suhu" <?= $Grid->suhu->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="form-group">
<input type="<?= $Grid->suhu->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu->getPlaceHolder()) ?>" value="<?= $Grid->suhu->EditValue ?>"<?= $Grid->suhu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" data-hidden="1" name="o<?= $Grid->RowIndex ?>_suhu" id="o<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="form-group">
<input type="<?= $Grid->suhu->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu->getPlaceHolder()) ?>" value="<?= $Grid->suhu->EditValue ?>"<?= $Grid->suhu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_suhu">
<span<?= $Grid->suhu->viewAttributes() ?>>
<?= $Grid->suhu->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_suhu" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_suhu" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <td data-name="pf_keluhan_fisik" <?= $Grid->pf_keluhan_fisik->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" name="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"<?= $Grid->pf_keluhan_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    name="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    value="<?= HtmlEncode($Grid->pf_keluhan_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pf_keluhan_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pf_keluhan_fisik"
    data-value-separator="<?= $Grid->pf_keluhan_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pf_keluhan_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pf_keluhan_fisik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="o<?= $Grid->RowIndex ?>_pf_keluhan_fisik" value="<?= HtmlEncode($Grid->pf_keluhan_fisik->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" name="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"<?= $Grid->pf_keluhan_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    name="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    value="<?= HtmlEncode($Grid->pf_keluhan_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pf_keluhan_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pf_keluhan_fisik"
    data-value-separator="<?= $Grid->pf_keluhan_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pf_keluhan_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pf_keluhan_fisik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik">
<span<?= $Grid->pf_keluhan_fisik->viewAttributes() ?>>
<?= $Grid->pf_keluhan_fisik->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" value="<?= HtmlEncode($Grid->pf_keluhan_fisik->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_pf_keluhan_fisik" value="<?= HtmlEncode($Grid->pf_keluhan_fisik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <td data-name="ket_keluhan_fisik" <?= $Grid->ket_keluhan_fisik->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="form-group">
<input type="<?= $Grid->ket_keluhan_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" name="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_keluhan_fisik->getPlaceHolder()) ?>" value="<?= $Grid->ket_keluhan_fisik->EditValue ?>"<?= $Grid->ket_keluhan_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_keluhan_fisik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="o<?= $Grid->RowIndex ?>_ket_keluhan_fisik" value="<?= HtmlEncode($Grid->ket_keluhan_fisik->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="form-group">
<input type="<?= $Grid->ket_keluhan_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" name="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_keluhan_fisik->getPlaceHolder()) ?>" value="<?= $Grid->ket_keluhan_fisik->EditValue ?>"<?= $Grid->ket_keluhan_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_keluhan_fisik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik">
<span<?= $Grid->ket_keluhan_fisik->viewAttributes() ?>>
<?= $Grid->ket_keluhan_fisik->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" value="<?= HtmlEncode($Grid->ket_keluhan_fisik->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_keluhan_fisik" value="<?= HtmlEncode($Grid->ket_keluhan_fisik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->skala_nyeri->Visible) { // skala_nyeri ?>
        <td data-name="skala_nyeri" <?= $Grid->skala_nyeri->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_skala_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" name="x<?= $Grid->RowIndex ?>_skala_nyeri" id="x<?= $Grid->RowIndex ?>_skala_nyeri"<?= $Grid->skala_nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_skala_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_skala_nyeri"
    name="x<?= $Grid->RowIndex ?>_skala_nyeri"
    value="<?= HtmlEncode($Grid->skala_nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_skala_nyeri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_skala_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->skala_nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_skala_nyeri"
    data-value-separator="<?= $Grid->skala_nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->skala_nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->skala_nyeri->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_skala_nyeri" id="o<?= $Grid->RowIndex ?>_skala_nyeri" value="<?= HtmlEncode($Grid->skala_nyeri->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_skala_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" name="x<?= $Grid->RowIndex ?>_skala_nyeri" id="x<?= $Grid->RowIndex ?>_skala_nyeri"<?= $Grid->skala_nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_skala_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_skala_nyeri"
    name="x<?= $Grid->RowIndex ?>_skala_nyeri"
    value="<?= HtmlEncode($Grid->skala_nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_skala_nyeri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_skala_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->skala_nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_skala_nyeri"
    data-value-separator="<?= $Grid->skala_nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->skala_nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->skala_nyeri->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri">
<span<?= $Grid->skala_nyeri->viewAttributes() ?>>
<?= $Grid->skala_nyeri->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_skala_nyeri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_skala_nyeri" value="<?= HtmlEncode($Grid->skala_nyeri->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_skala_nyeri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_skala_nyeri" value="<?= HtmlEncode($Grid->skala_nyeri->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->durasi->Visible) { // durasi ?>
        <td data-name="durasi" <?= $Grid->durasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="form-group">
<input type="<?= $Grid->durasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" name="x<?= $Grid->RowIndex ?>_durasi" id="x<?= $Grid->RowIndex ?>_durasi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->durasi->getPlaceHolder()) ?>" value="<?= $Grid->durasi->EditValue ?>"<?= $Grid->durasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->durasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_durasi" id="o<?= $Grid->RowIndex ?>_durasi" value="<?= HtmlEncode($Grid->durasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="form-group">
<input type="<?= $Grid->durasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" name="x<?= $Grid->RowIndex ?>_durasi" id="x<?= $Grid->RowIndex ?>_durasi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->durasi->getPlaceHolder()) ?>" value="<?= $Grid->durasi->EditValue ?>"<?= $Grid->durasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->durasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_durasi">
<span<?= $Grid->durasi->viewAttributes() ?>>
<?= $Grid->durasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_durasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_durasi" value="<?= HtmlEncode($Grid->durasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_durasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_durasi" value="<?= HtmlEncode($Grid->durasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nyeri->Visible) { // nyeri ?>
        <td data-name="nyeri" <?= $Grid->nyeri->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" name="x<?= $Grid->RowIndex ?>_nyeri" id="x<?= $Grid->RowIndex ?>_nyeri"<?= $Grid->nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nyeri"
    name="x<?= $Grid->RowIndex ?>_nyeri"
    value="<?= HtmlEncode($Grid->nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nyeri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri"
    data-value-separator="<?= $Grid->nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nyeri->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nyeri" id="o<?= $Grid->RowIndex ?>_nyeri" value="<?= HtmlEncode($Grid->nyeri->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" name="x<?= $Grid->RowIndex ?>_nyeri" id="x<?= $Grid->RowIndex ?>_nyeri"<?= $Grid->nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nyeri"
    name="x<?= $Grid->RowIndex ?>_nyeri"
    value="<?= HtmlEncode($Grid->nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nyeri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri"
    data-value-separator="<?= $Grid->nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nyeri->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri">
<span<?= $Grid->nyeri->viewAttributes() ?>>
<?= $Grid->nyeri->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nyeri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nyeri" value="<?= HtmlEncode($Grid->nyeri->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nyeri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nyeri" value="<?= HtmlEncode($Grid->nyeri->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->provokes->Visible) { // provokes ?>
        <td data-name="provokes" <?= $Grid->provokes->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_provokes">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" name="x<?= $Grid->RowIndex ?>_provokes" id="x<?= $Grid->RowIndex ?>_provokes"<?= $Grid->provokes->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_provokes" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_provokes"
    name="x<?= $Grid->RowIndex ?>_provokes"
    value="<?= HtmlEncode($Grid->provokes->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_provokes"
    data-target="dsl_x<?= $Grid->RowIndex ?>_provokes"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->provokes->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_provokes"
    data-value-separator="<?= $Grid->provokes->displayValueSeparatorAttribute() ?>"
    <?= $Grid->provokes->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->provokes->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" data-hidden="1" name="o<?= $Grid->RowIndex ?>_provokes" id="o<?= $Grid->RowIndex ?>_provokes" value="<?= HtmlEncode($Grid->provokes->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_provokes">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" name="x<?= $Grid->RowIndex ?>_provokes" id="x<?= $Grid->RowIndex ?>_provokes"<?= $Grid->provokes->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_provokes" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_provokes"
    name="x<?= $Grid->RowIndex ?>_provokes"
    value="<?= HtmlEncode($Grid->provokes->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_provokes"
    data-target="dsl_x<?= $Grid->RowIndex ?>_provokes"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->provokes->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_provokes"
    data-value-separator="<?= $Grid->provokes->displayValueSeparatorAttribute() ?>"
    <?= $Grid->provokes->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->provokes->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_provokes">
<span<?= $Grid->provokes->viewAttributes() ?>>
<?= $Grid->provokes->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_provokes" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_provokes" value="<?= HtmlEncode($Grid->provokes->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_provokes" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_provokes" value="<?= HtmlEncode($Grid->provokes->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_provokes->Visible) { // ket_provokes ?>
        <td data-name="ket_provokes" <?= $Grid->ket_provokes->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="form-group">
<input type="<?= $Grid->ket_provokes->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" name="x<?= $Grid->RowIndex ?>_ket_provokes" id="x<?= $Grid->RowIndex ?>_ket_provokes" size="30" maxlength="40" placeholder="<?= HtmlEncode($Grid->ket_provokes->getPlaceHolder()) ?>" value="<?= $Grid->ket_provokes->EditValue ?>"<?= $Grid->ket_provokes->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_provokes->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_provokes" id="o<?= $Grid->RowIndex ?>_ket_provokes" value="<?= HtmlEncode($Grid->ket_provokes->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="form-group">
<input type="<?= $Grid->ket_provokes->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" name="x<?= $Grid->RowIndex ?>_ket_provokes" id="x<?= $Grid->RowIndex ?>_ket_provokes" size="30" maxlength="40" placeholder="<?= HtmlEncode($Grid->ket_provokes->getPlaceHolder()) ?>" value="<?= $Grid->ket_provokes->EditValue ?>"<?= $Grid->ket_provokes->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_provokes->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes">
<span<?= $Grid->ket_provokes->viewAttributes() ?>>
<?= $Grid->ket_provokes->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_provokes" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_provokes" value="<?= HtmlEncode($Grid->ket_provokes->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_provokes" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_provokes" value="<?= HtmlEncode($Grid->ket_provokes->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->quality->Visible) { // quality ?>
        <td data-name="quality" <?= $Grid->quality->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_quality">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" name="x<?= $Grid->RowIndex ?>_quality" id="x<?= $Grid->RowIndex ?>_quality"<?= $Grid->quality->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_quality" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_quality"
    name="x<?= $Grid->RowIndex ?>_quality"
    value="<?= HtmlEncode($Grid->quality->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_quality"
    data-target="dsl_x<?= $Grid->RowIndex ?>_quality"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->quality->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_quality"
    data-value-separator="<?= $Grid->quality->displayValueSeparatorAttribute() ?>"
    <?= $Grid->quality->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quality->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" data-hidden="1" name="o<?= $Grid->RowIndex ?>_quality" id="o<?= $Grid->RowIndex ?>_quality" value="<?= HtmlEncode($Grid->quality->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_quality">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" name="x<?= $Grid->RowIndex ?>_quality" id="x<?= $Grid->RowIndex ?>_quality"<?= $Grid->quality->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_quality" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_quality"
    name="x<?= $Grid->RowIndex ?>_quality"
    value="<?= HtmlEncode($Grid->quality->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_quality"
    data-target="dsl_x<?= $Grid->RowIndex ?>_quality"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->quality->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_quality"
    data-value-separator="<?= $Grid->quality->displayValueSeparatorAttribute() ?>"
    <?= $Grid->quality->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quality->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_quality">
<span<?= $Grid->quality->viewAttributes() ?>>
<?= $Grid->quality->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_quality" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_quality" value="<?= HtmlEncode($Grid->quality->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_quality" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_quality" value="<?= HtmlEncode($Grid->quality->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_quality->Visible) { // ket_quality ?>
        <td data-name="ket_quality" <?= $Grid->ket_quality->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="form-group">
<input type="<?= $Grid->ket_quality->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" name="x<?= $Grid->RowIndex ?>_ket_quality" id="x<?= $Grid->RowIndex ?>_ket_quality" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_quality->getPlaceHolder()) ?>" value="<?= $Grid->ket_quality->EditValue ?>"<?= $Grid->ket_quality->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_quality->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_quality" id="o<?= $Grid->RowIndex ?>_ket_quality" value="<?= HtmlEncode($Grid->ket_quality->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="form-group">
<input type="<?= $Grid->ket_quality->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" name="x<?= $Grid->RowIndex ?>_ket_quality" id="x<?= $Grid->RowIndex ?>_ket_quality" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_quality->getPlaceHolder()) ?>" value="<?= $Grid->ket_quality->EditValue ?>"<?= $Grid->ket_quality->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_quality->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality">
<span<?= $Grid->ket_quality->viewAttributes() ?>>
<?= $Grid->ket_quality->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_quality" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_quality" value="<?= HtmlEncode($Grid->ket_quality->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_quality" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_quality" value="<?= HtmlEncode($Grid->ket_quality->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->lokasi->Visible) { // lokasi ?>
        <td data-name="lokasi" <?= $Grid->lokasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="form-group">
<input type="<?= $Grid->lokasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" name="x<?= $Grid->RowIndex ?>_lokasi" id="x<?= $Grid->RowIndex ?>_lokasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->lokasi->getPlaceHolder()) ?>" value="<?= $Grid->lokasi->EditValue ?>"<?= $Grid->lokasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lokasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lokasi" id="o<?= $Grid->RowIndex ?>_lokasi" value="<?= HtmlEncode($Grid->lokasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="form-group">
<input type="<?= $Grid->lokasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" name="x<?= $Grid->RowIndex ?>_lokasi" id="x<?= $Grid->RowIndex ?>_lokasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->lokasi->getPlaceHolder()) ?>" value="<?= $Grid->lokasi->EditValue ?>"<?= $Grid->lokasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lokasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lokasi">
<span<?= $Grid->lokasi->viewAttributes() ?>>
<?= $Grid->lokasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_lokasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_lokasi" value="<?= HtmlEncode($Grid->lokasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_lokasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_lokasi" value="<?= HtmlEncode($Grid->lokasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->menyebar->Visible) { // menyebar ?>
        <td data-name="menyebar" <?= $Grid->menyebar->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_menyebar">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" name="x<?= $Grid->RowIndex ?>_menyebar" id="x<?= $Grid->RowIndex ?>_menyebar"<?= $Grid->menyebar->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_menyebar" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_menyebar"
    name="x<?= $Grid->RowIndex ?>_menyebar"
    value="<?= HtmlEncode($Grid->menyebar->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_menyebar"
    data-target="dsl_x<?= $Grid->RowIndex ?>_menyebar"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->menyebar->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_menyebar"
    data-value-separator="<?= $Grid->menyebar->displayValueSeparatorAttribute() ?>"
    <?= $Grid->menyebar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->menyebar->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_menyebar" id="o<?= $Grid->RowIndex ?>_menyebar" value="<?= HtmlEncode($Grid->menyebar->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_menyebar">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" name="x<?= $Grid->RowIndex ?>_menyebar" id="x<?= $Grid->RowIndex ?>_menyebar"<?= $Grid->menyebar->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_menyebar" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_menyebar"
    name="x<?= $Grid->RowIndex ?>_menyebar"
    value="<?= HtmlEncode($Grid->menyebar->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_menyebar"
    data-target="dsl_x<?= $Grid->RowIndex ?>_menyebar"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->menyebar->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_menyebar"
    data-value-separator="<?= $Grid->menyebar->displayValueSeparatorAttribute() ?>"
    <?= $Grid->menyebar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->menyebar->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_menyebar">
<span<?= $Grid->menyebar->viewAttributes() ?>>
<?= $Grid->menyebar->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_menyebar" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_menyebar" value="<?= HtmlEncode($Grid->menyebar->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_menyebar" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_menyebar" value="<?= HtmlEncode($Grid->menyebar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pada_dokter->Visible) { // pada_dokter ?>
        <td data-name="pada_dokter" <?= $Grid->pada_dokter->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_pada_dokter">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" name="x<?= $Grid->RowIndex ?>_pada_dokter" id="x<?= $Grid->RowIndex ?>_pada_dokter"<?= $Grid->pada_dokter->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pada_dokter" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pada_dokter"
    name="x<?= $Grid->RowIndex ?>_pada_dokter"
    value="<?= HtmlEncode($Grid->pada_dokter->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pada_dokter"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pada_dokter"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pada_dokter->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pada_dokter"
    data-value-separator="<?= $Grid->pada_dokter->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pada_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pada_dokter->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pada_dokter" id="o<?= $Grid->RowIndex ?>_pada_dokter" value="<?= HtmlEncode($Grid->pada_dokter->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_pada_dokter">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" name="x<?= $Grid->RowIndex ?>_pada_dokter" id="x<?= $Grid->RowIndex ?>_pada_dokter"<?= $Grid->pada_dokter->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pada_dokter" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pada_dokter"
    name="x<?= $Grid->RowIndex ?>_pada_dokter"
    value="<?= HtmlEncode($Grid->pada_dokter->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pada_dokter"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pada_dokter"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pada_dokter->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pada_dokter"
    data-value-separator="<?= $Grid->pada_dokter->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pada_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pada_dokter->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter">
<span<?= $Grid->pada_dokter->viewAttributes() ?>>
<?= $Grid->pada_dokter->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_pada_dokter" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_pada_dokter" value="<?= HtmlEncode($Grid->pada_dokter->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_pada_dokter" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_pada_dokter" value="<?= HtmlEncode($Grid->pada_dokter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_dokter->Visible) { // ket_dokter ?>
        <td data-name="ket_dokter" <?= $Grid->ket_dokter->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="form-group">
<input type="<?= $Grid->ket_dokter->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" name="x<?= $Grid->RowIndex ?>_ket_dokter" id="x<?= $Grid->RowIndex ?>_ket_dokter" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_dokter->getPlaceHolder()) ?>" value="<?= $Grid->ket_dokter->EditValue ?>"<?= $Grid->ket_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_dokter->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_dokter" id="o<?= $Grid->RowIndex ?>_ket_dokter" value="<?= HtmlEncode($Grid->ket_dokter->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="form-group">
<input type="<?= $Grid->ket_dokter->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" name="x<?= $Grid->RowIndex ?>_ket_dokter" id="x<?= $Grid->RowIndex ?>_ket_dokter" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_dokter->getPlaceHolder()) ?>" value="<?= $Grid->ket_dokter->EditValue ?>"<?= $Grid->ket_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_dokter->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter">
<span<?= $Grid->ket_dokter->viewAttributes() ?>>
<?= $Grid->ket_dokter->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_dokter" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_dokter" value="<?= HtmlEncode($Grid->ket_dokter->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_dokter" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_dokter" value="<?= HtmlEncode($Grid->ket_dokter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <td data-name="nyeri_hilang" <?= $Grid->nyeri_hilang->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_nyeri_hilang">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" name="x<?= $Grid->RowIndex ?>_nyeri_hilang" id="x<?= $Grid->RowIndex ?>_nyeri_hilang"<?= $Grid->nyeri_hilang->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nyeri_hilang" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nyeri_hilang"
    name="x<?= $Grid->RowIndex ?>_nyeri_hilang"
    value="<?= HtmlEncode($Grid->nyeri_hilang->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nyeri_hilang"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nyeri_hilang"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nyeri_hilang->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri_hilang"
    data-value-separator="<?= $Grid->nyeri_hilang->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nyeri_hilang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nyeri_hilang->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nyeri_hilang" id="o<?= $Grid->RowIndex ?>_nyeri_hilang" value="<?= HtmlEncode($Grid->nyeri_hilang->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_nyeri_hilang">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" name="x<?= $Grid->RowIndex ?>_nyeri_hilang" id="x<?= $Grid->RowIndex ?>_nyeri_hilang"<?= $Grid->nyeri_hilang->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nyeri_hilang" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nyeri_hilang"
    name="x<?= $Grid->RowIndex ?>_nyeri_hilang"
    value="<?= HtmlEncode($Grid->nyeri_hilang->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nyeri_hilang"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nyeri_hilang"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nyeri_hilang->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri_hilang"
    data-value-separator="<?= $Grid->nyeri_hilang->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nyeri_hilang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nyeri_hilang->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang">
<span<?= $Grid->nyeri_hilang->viewAttributes() ?>>
<?= $Grid->nyeri_hilang->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nyeri_hilang" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nyeri_hilang" value="<?= HtmlEncode($Grid->nyeri_hilang->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nyeri_hilang" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nyeri_hilang" value="<?= HtmlEncode($Grid->nyeri_hilang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_nyeri->Visible) { // ket_nyeri ?>
        <td data-name="ket_nyeri" <?= $Grid->ket_nyeri->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="form-group">
<input type="<?= $Grid->ket_nyeri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" name="x<?= $Grid->RowIndex ?>_ket_nyeri" id="x<?= $Grid->RowIndex ?>_ket_nyeri" size="30" maxlength="40" placeholder="<?= HtmlEncode($Grid->ket_nyeri->getPlaceHolder()) ?>" value="<?= $Grid->ket_nyeri->EditValue ?>"<?= $Grid->ket_nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_nyeri->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_nyeri" id="o<?= $Grid->RowIndex ?>_ket_nyeri" value="<?= HtmlEncode($Grid->ket_nyeri->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="form-group">
<input type="<?= $Grid->ket_nyeri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" name="x<?= $Grid->RowIndex ?>_ket_nyeri" id="x<?= $Grid->RowIndex ?>_ket_nyeri" size="30" maxlength="40" placeholder="<?= HtmlEncode($Grid->ket_nyeri->getPlaceHolder()) ?>" value="<?= $Grid->ket_nyeri->EditValue ?>"<?= $Grid->ket_nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_nyeri->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri">
<span<?= $Grid->ket_nyeri->viewAttributes() ?>>
<?= $Grid->ket_nyeri->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_nyeri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_nyeri" value="<?= HtmlEncode($Grid->ket_nyeri->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_nyeri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_nyeri" value="<?= HtmlEncode($Grid->ket_nyeri->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bb->Visible) { // bb ?>
        <td data-name="bb" <?= $Grid->bb->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="form-group">
<input type="<?= $Grid->bb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bb->getPlaceHolder()) ?>" value="<?= $Grid->bb->EditValue ?>"<?= $Grid->bb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bb->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bb" id="o<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="form-group">
<input type="<?= $Grid->bb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bb->getPlaceHolder()) ?>" value="<?= $Grid->bb->EditValue ?>"<?= $Grid->bb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bb->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bb">
<span<?= $Grid->bb->viewAttributes() ?>>
<?= $Grid->bb->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_bb" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_bb" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tb->Visible) { // tb ?>
        <td data-name="tb" <?= $Grid->tb->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="form-group">
<input type="<?= $Grid->tb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tb->getPlaceHolder()) ?>" value="<?= $Grid->tb->EditValue ?>"<?= $Grid->tb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tb->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tb" id="o<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="form-group">
<input type="<?= $Grid->tb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tb->getPlaceHolder()) ?>" value="<?= $Grid->tb->EditValue ?>"<?= $Grid->tb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tb->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tb">
<span<?= $Grid->tb->viewAttributes() ?>>
<?= $Grid->tb->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_tb" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_tb" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bmi->Visible) { // bmi ?>
        <td data-name="bmi" <?= $Grid->bmi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="form-group">
<input type="<?= $Grid->bmi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" name="x<?= $Grid->RowIndex ?>_bmi" id="x<?= $Grid->RowIndex ?>_bmi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bmi->getPlaceHolder()) ?>" value="<?= $Grid->bmi->EditValue ?>"<?= $Grid->bmi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bmi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bmi" id="o<?= $Grid->RowIndex ?>_bmi" value="<?= HtmlEncode($Grid->bmi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="form-group">
<input type="<?= $Grid->bmi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" name="x<?= $Grid->RowIndex ?>_bmi" id="x<?= $Grid->RowIndex ?>_bmi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bmi->getPlaceHolder()) ?>" value="<?= $Grid->bmi->EditValue ?>"<?= $Grid->bmi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bmi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bmi">
<span<?= $Grid->bmi->viewAttributes() ?>>
<?= $Grid->bmi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_bmi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_bmi" value="<?= HtmlEncode($Grid->bmi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_bmi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_bmi" value="<?= HtmlEncode($Grid->bmi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <td data-name="lapor_status_nutrisi" <?= $Grid->lapor_status_nutrisi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" name="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"<?= $Grid->lapor_status_nutrisi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    name="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    value="<?= HtmlEncode($Grid->lapor_status_nutrisi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->lapor_status_nutrisi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor_status_nutrisi"
    data-value-separator="<?= $Grid->lapor_status_nutrisi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->lapor_status_nutrisi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="o<?= $Grid->RowIndex ?>_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->lapor_status_nutrisi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" name="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"<?= $Grid->lapor_status_nutrisi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    name="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    value="<?= HtmlEncode($Grid->lapor_status_nutrisi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->lapor_status_nutrisi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor_status_nutrisi"
    data-value-separator="<?= $Grid->lapor_status_nutrisi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->lapor_status_nutrisi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi">
<span<?= $Grid->lapor_status_nutrisi->viewAttributes() ?>>
<?= $Grid->lapor_status_nutrisi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->lapor_status_nutrisi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->lapor_status_nutrisi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <td data-name="ket_lapor_status_nutrisi" <?= $Grid->ket_lapor_status_nutrisi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="form-group">
<input type="<?= $Grid->ket_lapor_status_nutrisi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" name="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->getPlaceHolder()) ?>" value="<?= $Grid->ket_lapor_status_nutrisi->EditValue ?>"<?= $Grid->ket_lapor_status_nutrisi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="o<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="form-group">
<input type="<?= $Grid->ket_lapor_status_nutrisi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" name="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->getPlaceHolder()) ?>" value="<?= $Grid->ket_lapor_status_nutrisi->EditValue ?>"<?= $Grid->ket_lapor_status_nutrisi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi">
<span<?= $Grid->ket_lapor_status_nutrisi->viewAttributes() ?>>
<?= $Grid->ket_lapor_status_nutrisi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sg1->Visible) { // sg1 ?>
        <td data-name="sg1" <?= $Grid->sg1->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sg1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" name="x<?= $Grid->RowIndex ?>_sg1" id="x<?= $Grid->RowIndex ?>_sg1"<?= $Grid->sg1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sg1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sg1"
    name="x<?= $Grid->RowIndex ?>_sg1"
    value="<?= HtmlEncode($Grid->sg1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sg1"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sg1"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sg1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg1"
    data-value-separator="<?= $Grid->sg1->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sg1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sg1->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sg1" id="o<?= $Grid->RowIndex ?>_sg1" value="<?= HtmlEncode($Grid->sg1->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sg1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" name="x<?= $Grid->RowIndex ?>_sg1" id="x<?= $Grid->RowIndex ?>_sg1"<?= $Grid->sg1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sg1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sg1"
    name="x<?= $Grid->RowIndex ?>_sg1"
    value="<?= HtmlEncode($Grid->sg1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sg1"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sg1"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sg1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg1"
    data-value-separator="<?= $Grid->sg1->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sg1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sg1->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg1">
<span<?= $Grid->sg1->viewAttributes() ?>>
<?= $Grid->sg1->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sg1" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sg1" value="<?= HtmlEncode($Grid->sg1->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sg1" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sg1" value="<?= HtmlEncode($Grid->sg1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nilai1->Visible) { // nilai1 ?>
        <td data-name="nilai1" <?= $Grid->nilai1->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_nilai1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" name="x<?= $Grid->RowIndex ?>_nilai1" id="x<?= $Grid->RowIndex ?>_nilai1"<?= $Grid->nilai1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nilai1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nilai1"
    name="x<?= $Grid->RowIndex ?>_nilai1"
    value="<?= HtmlEncode($Grid->nilai1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nilai1"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nilai1"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nilai1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nilai1"
    data-value-separator="<?= $Grid->nilai1->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nilai1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nilai1->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nilai1" id="o<?= $Grid->RowIndex ?>_nilai1" value="<?= HtmlEncode($Grid->nilai1->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_nilai1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" name="x<?= $Grid->RowIndex ?>_nilai1" id="x<?= $Grid->RowIndex ?>_nilai1"<?= $Grid->nilai1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nilai1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nilai1"
    name="x<?= $Grid->RowIndex ?>_nilai1"
    value="<?= HtmlEncode($Grid->nilai1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nilai1"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nilai1"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nilai1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nilai1"
    data-value-separator="<?= $Grid->nilai1->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nilai1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nilai1->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai1">
<span<?= $Grid->nilai1->viewAttributes() ?>>
<?= $Grid->nilai1->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nilai1" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nilai1" value="<?= HtmlEncode($Grid->nilai1->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nilai1" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nilai1" value="<?= HtmlEncode($Grid->nilai1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sg2->Visible) { // sg2 ?>
        <td data-name="sg2" <?= $Grid->sg2->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sg2">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" name="x<?= $Grid->RowIndex ?>_sg2" id="x<?= $Grid->RowIndex ?>_sg2"<?= $Grid->sg2->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sg2" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sg2"
    name="x<?= $Grid->RowIndex ?>_sg2"
    value="<?= HtmlEncode($Grid->sg2->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sg2"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sg2"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sg2->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg2"
    data-value-separator="<?= $Grid->sg2->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sg2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sg2->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sg2" id="o<?= $Grid->RowIndex ?>_sg2" value="<?= HtmlEncode($Grid->sg2->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sg2">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" name="x<?= $Grid->RowIndex ?>_sg2" id="x<?= $Grid->RowIndex ?>_sg2"<?= $Grid->sg2->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sg2" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sg2"
    name="x<?= $Grid->RowIndex ?>_sg2"
    value="<?= HtmlEncode($Grid->sg2->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sg2"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sg2"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sg2->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg2"
    data-value-separator="<?= $Grid->sg2->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sg2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sg2->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg2">
<span<?= $Grid->sg2->viewAttributes() ?>>
<?= $Grid->sg2->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sg2" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sg2" value="<?= HtmlEncode($Grid->sg2->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sg2" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sg2" value="<?= HtmlEncode($Grid->sg2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nilai2->Visible) { // nilai2 ?>
        <td data-name="nilai2" <?= $Grid->nilai2->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="form-group">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->nilai2->isInvalidClass() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" name="x<?= $Grid->RowIndex ?>_nilai2[]" id="x<?= $Grid->RowIndex ?>_nilai2_967021" value="1"<?= ConvertToBool($Grid->nilai2->CurrentValue) ? " checked" : "" ?><?= $Grid->nilai2->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_nilai2_967021"></label>
</div>
<div class="invalid-feedback"><?= $Grid->nilai2->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nilai2[]" id="o<?= $Grid->RowIndex ?>_nilai2[]" value="<?= HtmlEncode($Grid->nilai2->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="form-group">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->nilai2->isInvalidClass() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" name="x<?= $Grid->RowIndex ?>_nilai2[]" id="x<?= $Grid->RowIndex ?>_nilai2_329061" value="1"<?= ConvertToBool($Grid->nilai2->CurrentValue) ? " checked" : "" ?><?= $Grid->nilai2->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_nilai2_329061"></label>
</div>
<div class="invalid-feedback"><?= $Grid->nilai2->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai2">
<span<?= $Grid->nilai2->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_nilai2_<?= $Grid->RowCount ?>" class="custom-control-input" value="<?= $Grid->nilai2->getViewValue() ?>" disabled<?php if (ConvertToBool($Grid->nilai2->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_nilai2_<?= $Grid->RowCount ?>"></label>
</div></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nilai2" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nilai2" value="<?= HtmlEncode($Grid->nilai2->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nilai2[]" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nilai2[]" value="<?= HtmlEncode($Grid->nilai2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->total_hasil->Visible) { // total_hasil ?>
        <td data-name="total_hasil" <?= $Grid->total_hasil->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="form-group">
<input type="<?= $Grid->total_hasil->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" name="x<?= $Grid->RowIndex ?>_total_hasil" id="x<?= $Grid->RowIndex ?>_total_hasil" size="30" placeholder="<?= HtmlEncode($Grid->total_hasil->getPlaceHolder()) ?>" value="<?= $Grid->total_hasil->EditValue ?>"<?= $Grid->total_hasil->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_hasil->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" data-hidden="1" name="o<?= $Grid->RowIndex ?>_total_hasil" id="o<?= $Grid->RowIndex ?>_total_hasil" value="<?= HtmlEncode($Grid->total_hasil->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="form-group">
<input type="<?= $Grid->total_hasil->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" name="x<?= $Grid->RowIndex ?>_total_hasil" id="x<?= $Grid->RowIndex ?>_total_hasil" size="30" placeholder="<?= HtmlEncode($Grid->total_hasil->getPlaceHolder()) ?>" value="<?= $Grid->total_hasil->EditValue ?>"<?= $Grid->total_hasil->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_hasil->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil">
<span<?= $Grid->total_hasil->viewAttributes() ?>>
<?= $Grid->total_hasil->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_total_hasil" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_total_hasil" value="<?= HtmlEncode($Grid->total_hasil->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_total_hasil" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_total_hasil" value="<?= HtmlEncode($Grid->total_hasil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->resikojatuh->Visible) { // resikojatuh ?>
        <td data-name="resikojatuh" <?= $Grid->resikojatuh->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_resikojatuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" name="x<?= $Grid->RowIndex ?>_resikojatuh" id="x<?= $Grid->RowIndex ?>_resikojatuh"<?= $Grid->resikojatuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_resikojatuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_resikojatuh"
    name="x<?= $Grid->RowIndex ?>_resikojatuh"
    value="<?= HtmlEncode($Grid->resikojatuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_resikojatuh"
    data-target="dsl_x<?= $Grid->RowIndex ?>_resikojatuh"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->resikojatuh->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resikojatuh"
    data-value-separator="<?= $Grid->resikojatuh->displayValueSeparatorAttribute() ?>"
    <?= $Grid->resikojatuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->resikojatuh->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" data-hidden="1" name="o<?= $Grid->RowIndex ?>_resikojatuh" id="o<?= $Grid->RowIndex ?>_resikojatuh" value="<?= HtmlEncode($Grid->resikojatuh->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_resikojatuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" name="x<?= $Grid->RowIndex ?>_resikojatuh" id="x<?= $Grid->RowIndex ?>_resikojatuh"<?= $Grid->resikojatuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_resikojatuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_resikojatuh"
    name="x<?= $Grid->RowIndex ?>_resikojatuh"
    value="<?= HtmlEncode($Grid->resikojatuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_resikojatuh"
    data-target="dsl_x<?= $Grid->RowIndex ?>_resikojatuh"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->resikojatuh->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resikojatuh"
    data-value-separator="<?= $Grid->resikojatuh->displayValueSeparatorAttribute() ?>"
    <?= $Grid->resikojatuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->resikojatuh->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh">
<span<?= $Grid->resikojatuh->viewAttributes() ?>>
<?= $Grid->resikojatuh->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_resikojatuh" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_resikojatuh" value="<?= HtmlEncode($Grid->resikojatuh->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_resikojatuh" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_resikojatuh" value="<?= HtmlEncode($Grid->resikojatuh->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bjm->Visible) { // bjm ?>
        <td data-name="bjm" <?= $Grid->bjm->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_bjm">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" name="x<?= $Grid->RowIndex ?>_bjm" id="x<?= $Grid->RowIndex ?>_bjm"<?= $Grid->bjm->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_bjm" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_bjm"
    name="x<?= $Grid->RowIndex ?>_bjm"
    value="<?= HtmlEncode($Grid->bjm->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_bjm"
    data-target="dsl_x<?= $Grid->RowIndex ?>_bjm"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->bjm->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_bjm"
    data-value-separator="<?= $Grid->bjm->displayValueSeparatorAttribute() ?>"
    <?= $Grid->bjm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bjm->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bjm" id="o<?= $Grid->RowIndex ?>_bjm" value="<?= HtmlEncode($Grid->bjm->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_bjm">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" name="x<?= $Grid->RowIndex ?>_bjm" id="x<?= $Grid->RowIndex ?>_bjm"<?= $Grid->bjm->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_bjm" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_bjm"
    name="x<?= $Grid->RowIndex ?>_bjm"
    value="<?= HtmlEncode($Grid->bjm->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_bjm"
    data-target="dsl_x<?= $Grid->RowIndex ?>_bjm"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->bjm->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_bjm"
    data-value-separator="<?= $Grid->bjm->displayValueSeparatorAttribute() ?>"
    <?= $Grid->bjm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bjm->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bjm">
<span<?= $Grid->bjm->viewAttributes() ?>>
<?= $Grid->bjm->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_bjm" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_bjm" value="<?= HtmlEncode($Grid->bjm->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_bjm" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_bjm" value="<?= HtmlEncode($Grid->bjm->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->msa->Visible) { // msa ?>
        <td data-name="msa" <?= $Grid->msa->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_msa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" name="x<?= $Grid->RowIndex ?>_msa" id="x<?= $Grid->RowIndex ?>_msa"<?= $Grid->msa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_msa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_msa"
    name="x<?= $Grid->RowIndex ?>_msa"
    value="<?= HtmlEncode($Grid->msa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_msa"
    data-target="dsl_x<?= $Grid->RowIndex ?>_msa"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->msa->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_msa"
    data-value-separator="<?= $Grid->msa->displayValueSeparatorAttribute() ?>"
    <?= $Grid->msa->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->msa->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" data-hidden="1" name="o<?= $Grid->RowIndex ?>_msa" id="o<?= $Grid->RowIndex ?>_msa" value="<?= HtmlEncode($Grid->msa->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_msa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" name="x<?= $Grid->RowIndex ?>_msa" id="x<?= $Grid->RowIndex ?>_msa"<?= $Grid->msa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_msa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_msa"
    name="x<?= $Grid->RowIndex ?>_msa"
    value="<?= HtmlEncode($Grid->msa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_msa"
    data-target="dsl_x<?= $Grid->RowIndex ?>_msa"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->msa->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_msa"
    data-value-separator="<?= $Grid->msa->displayValueSeparatorAttribute() ?>"
    <?= $Grid->msa->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->msa->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_msa">
<span<?= $Grid->msa->viewAttributes() ?>>
<?= $Grid->msa->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_msa" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_msa" value="<?= HtmlEncode($Grid->msa->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_msa" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_msa" value="<?= HtmlEncode($Grid->msa->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->hasil->Visible) { // hasil ?>
        <td data-name="hasil" <?= $Grid->hasil->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_hasil">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" name="x<?= $Grid->RowIndex ?>_hasil" id="x<?= $Grid->RowIndex ?>_hasil"<?= $Grid->hasil->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_hasil" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_hasil"
    name="x<?= $Grid->RowIndex ?>_hasil"
    value="<?= HtmlEncode($Grid->hasil->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_hasil"
    data-target="dsl_x<?= $Grid->RowIndex ?>_hasil"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->hasil->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_hasil"
    data-value-separator="<?= $Grid->hasil->displayValueSeparatorAttribute() ?>"
    <?= $Grid->hasil->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hasil" id="o<?= $Grid->RowIndex ?>_hasil" value="<?= HtmlEncode($Grid->hasil->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_hasil">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" name="x<?= $Grid->RowIndex ?>_hasil" id="x<?= $Grid->RowIndex ?>_hasil"<?= $Grid->hasil->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_hasil" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_hasil"
    name="x<?= $Grid->RowIndex ?>_hasil"
    value="<?= HtmlEncode($Grid->hasil->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_hasil"
    data-target="dsl_x<?= $Grid->RowIndex ?>_hasil"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->hasil->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_hasil"
    data-value-separator="<?= $Grid->hasil->displayValueSeparatorAttribute() ?>"
    <?= $Grid->hasil->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_hasil">
<span<?= $Grid->hasil->viewAttributes() ?>>
<?= $Grid->hasil->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_hasil" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_hasil" value="<?= HtmlEncode($Grid->hasil->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_hasil" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_hasil" value="<?= HtmlEncode($Grid->hasil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->lapor->Visible) { // lapor ?>
        <td data-name="lapor" <?= $Grid->lapor->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_lapor">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" name="x<?= $Grid->RowIndex ?>_lapor" id="x<?= $Grid->RowIndex ?>_lapor"<?= $Grid->lapor->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_lapor" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_lapor"
    name="x<?= $Grid->RowIndex ?>_lapor"
    value="<?= HtmlEncode($Grid->lapor->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_lapor"
    data-target="dsl_x<?= $Grid->RowIndex ?>_lapor"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->lapor->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor"
    data-value-separator="<?= $Grid->lapor->displayValueSeparatorAttribute() ?>"
    <?= $Grid->lapor->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lapor->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lapor" id="o<?= $Grid->RowIndex ?>_lapor" value="<?= HtmlEncode($Grid->lapor->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_lapor">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" name="x<?= $Grid->RowIndex ?>_lapor" id="x<?= $Grid->RowIndex ?>_lapor"<?= $Grid->lapor->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_lapor" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_lapor"
    name="x<?= $Grid->RowIndex ?>_lapor"
    value="<?= HtmlEncode($Grid->lapor->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_lapor"
    data-target="dsl_x<?= $Grid->RowIndex ?>_lapor"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->lapor->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor"
    data-value-separator="<?= $Grid->lapor->displayValueSeparatorAttribute() ?>"
    <?= $Grid->lapor->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lapor->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor">
<span<?= $Grid->lapor->viewAttributes() ?>>
<?= $Grid->lapor->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_lapor" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_lapor" value="<?= HtmlEncode($Grid->lapor->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_lapor" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_lapor" value="<?= HtmlEncode($Grid->lapor->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_lapor->Visible) { // ket_lapor ?>
        <td data-name="ket_lapor" <?= $Grid->ket_lapor->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="form-group">
<input type="<?= $Grid->ket_lapor->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" name="x<?= $Grid->RowIndex ?>_ket_lapor" id="x<?= $Grid->RowIndex ?>_ket_lapor" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_lapor->getPlaceHolder()) ?>" value="<?= $Grid->ket_lapor->EditValue ?>"<?= $Grid->ket_lapor->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lapor->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_lapor" id="o<?= $Grid->RowIndex ?>_ket_lapor" value="<?= HtmlEncode($Grid->ket_lapor->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="form-group">
<input type="<?= $Grid->ket_lapor->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" name="x<?= $Grid->RowIndex ?>_ket_lapor" id="x<?= $Grid->RowIndex ?>_ket_lapor" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_lapor->getPlaceHolder()) ?>" value="<?= $Grid->ket_lapor->EditValue ?>"<?= $Grid->ket_lapor->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lapor->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor">
<span<?= $Grid->ket_lapor->viewAttributes() ?>>
<?= $Grid->ket_lapor->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_lapor" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_lapor" value="<?= HtmlEncode($Grid->ket_lapor->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_lapor" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_lapor" value="<?= HtmlEncode($Grid->ket_lapor->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_mandi->Visible) { // adl_mandi ?>
        <td data-name="adl_mandi" <?= $Grid->adl_mandi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_mandi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" name="x<?= $Grid->RowIndex ?>_adl_mandi" id="x<?= $Grid->RowIndex ?>_adl_mandi"<?= $Grid->adl_mandi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_mandi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_mandi"
    name="x<?= $Grid->RowIndex ?>_adl_mandi"
    value="<?= HtmlEncode($Grid->adl_mandi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_mandi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_mandi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_mandi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_mandi"
    data-value-separator="<?= $Grid->adl_mandi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_mandi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_mandi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_mandi" id="o<?= $Grid->RowIndex ?>_adl_mandi" value="<?= HtmlEncode($Grid->adl_mandi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_mandi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" name="x<?= $Grid->RowIndex ?>_adl_mandi" id="x<?= $Grid->RowIndex ?>_adl_mandi"<?= $Grid->adl_mandi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_mandi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_mandi"
    name="x<?= $Grid->RowIndex ?>_adl_mandi"
    value="<?= HtmlEncode($Grid->adl_mandi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_mandi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_mandi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_mandi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_mandi"
    data-value-separator="<?= $Grid->adl_mandi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_mandi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_mandi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi">
<span<?= $Grid->adl_mandi->viewAttributes() ?>>
<?= $Grid->adl_mandi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_mandi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_mandi" value="<?= HtmlEncode($Grid->adl_mandi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_mandi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_mandi" value="<?= HtmlEncode($Grid->adl_mandi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <td data-name="adl_berpakaian" <?= $Grid->adl_berpakaian->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_berpakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" name="x<?= $Grid->RowIndex ?>_adl_berpakaian" id="x<?= $Grid->RowIndex ?>_adl_berpakaian"<?= $Grid->adl_berpakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_berpakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_berpakaian"
    name="x<?= $Grid->RowIndex ?>_adl_berpakaian"
    value="<?= HtmlEncode($Grid->adl_berpakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_berpakaian"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_berpakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_berpakaian->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_berpakaian"
    data-value-separator="<?= $Grid->adl_berpakaian->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_berpakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_berpakaian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_berpakaian" id="o<?= $Grid->RowIndex ?>_adl_berpakaian" value="<?= HtmlEncode($Grid->adl_berpakaian->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_berpakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" name="x<?= $Grid->RowIndex ?>_adl_berpakaian" id="x<?= $Grid->RowIndex ?>_adl_berpakaian"<?= $Grid->adl_berpakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_berpakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_berpakaian"
    name="x<?= $Grid->RowIndex ?>_adl_berpakaian"
    value="<?= HtmlEncode($Grid->adl_berpakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_berpakaian"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_berpakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_berpakaian->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_berpakaian"
    data-value-separator="<?= $Grid->adl_berpakaian->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_berpakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_berpakaian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian">
<span<?= $Grid->adl_berpakaian->viewAttributes() ?>>
<?= $Grid->adl_berpakaian->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_berpakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_berpakaian" value="<?= HtmlEncode($Grid->adl_berpakaian->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_berpakaian" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_berpakaian" value="<?= HtmlEncode($Grid->adl_berpakaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_makan->Visible) { // adl_makan ?>
        <td data-name="adl_makan" <?= $Grid->adl_makan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_makan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" name="x<?= $Grid->RowIndex ?>_adl_makan" id="x<?= $Grid->RowIndex ?>_adl_makan"<?= $Grid->adl_makan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_makan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_makan"
    name="x<?= $Grid->RowIndex ?>_adl_makan"
    value="<?= HtmlEncode($Grid->adl_makan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_makan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_makan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_makan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_makan"
    data-value-separator="<?= $Grid->adl_makan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_makan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_makan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_makan" id="o<?= $Grid->RowIndex ?>_adl_makan" value="<?= HtmlEncode($Grid->adl_makan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_makan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" name="x<?= $Grid->RowIndex ?>_adl_makan" id="x<?= $Grid->RowIndex ?>_adl_makan"<?= $Grid->adl_makan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_makan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_makan"
    name="x<?= $Grid->RowIndex ?>_adl_makan"
    value="<?= HtmlEncode($Grid->adl_makan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_makan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_makan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_makan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_makan"
    data-value-separator="<?= $Grid->adl_makan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_makan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_makan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan">
<span<?= $Grid->adl_makan->viewAttributes() ?>>
<?= $Grid->adl_makan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_makan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_makan" value="<?= HtmlEncode($Grid->adl_makan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_makan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_makan" value="<?= HtmlEncode($Grid->adl_makan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_bak->Visible) { // adl_bak ?>
        <td data-name="adl_bak" <?= $Grid->adl_bak->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_bak">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" name="x<?= $Grid->RowIndex ?>_adl_bak" id="x<?= $Grid->RowIndex ?>_adl_bak"<?= $Grid->adl_bak->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_bak" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_bak"
    name="x<?= $Grid->RowIndex ?>_adl_bak"
    value="<?= HtmlEncode($Grid->adl_bak->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_bak"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_bak"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_bak->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bak"
    data-value-separator="<?= $Grid->adl_bak->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_bak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_bak->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_bak" id="o<?= $Grid->RowIndex ?>_adl_bak" value="<?= HtmlEncode($Grid->adl_bak->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_bak">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" name="x<?= $Grid->RowIndex ?>_adl_bak" id="x<?= $Grid->RowIndex ?>_adl_bak"<?= $Grid->adl_bak->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_bak" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_bak"
    name="x<?= $Grid->RowIndex ?>_adl_bak"
    value="<?= HtmlEncode($Grid->adl_bak->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_bak"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_bak"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_bak->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bak"
    data-value-separator="<?= $Grid->adl_bak->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_bak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_bak->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak">
<span<?= $Grid->adl_bak->viewAttributes() ?>>
<?= $Grid->adl_bak->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_bak" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_bak" value="<?= HtmlEncode($Grid->adl_bak->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_bak" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_bak" value="<?= HtmlEncode($Grid->adl_bak->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_bab->Visible) { // adl_bab ?>
        <td data-name="adl_bab" <?= $Grid->adl_bab->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_bab">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" name="x<?= $Grid->RowIndex ?>_adl_bab" id="x<?= $Grid->RowIndex ?>_adl_bab"<?= $Grid->adl_bab->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_bab" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_bab"
    name="x<?= $Grid->RowIndex ?>_adl_bab"
    value="<?= HtmlEncode($Grid->adl_bab->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_bab"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_bab"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_bab->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bab"
    data-value-separator="<?= $Grid->adl_bab->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_bab->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_bab->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_bab" id="o<?= $Grid->RowIndex ?>_adl_bab" value="<?= HtmlEncode($Grid->adl_bab->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_bab">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" name="x<?= $Grid->RowIndex ?>_adl_bab" id="x<?= $Grid->RowIndex ?>_adl_bab"<?= $Grid->adl_bab->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_bab" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_bab"
    name="x<?= $Grid->RowIndex ?>_adl_bab"
    value="<?= HtmlEncode($Grid->adl_bab->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_bab"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_bab"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_bab->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bab"
    data-value-separator="<?= $Grid->adl_bab->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_bab->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_bab->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab">
<span<?= $Grid->adl_bab->viewAttributes() ?>>
<?= $Grid->adl_bab->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_bab" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_bab" value="<?= HtmlEncode($Grid->adl_bab->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_bab" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_bab" value="<?= HtmlEncode($Grid->adl_bab->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_hobi->Visible) { // adl_hobi ?>
        <td data-name="adl_hobi" <?= $Grid->adl_hobi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_hobi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" name="x<?= $Grid->RowIndex ?>_adl_hobi" id="x<?= $Grid->RowIndex ?>_adl_hobi"<?= $Grid->adl_hobi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_hobi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_hobi"
    name="x<?= $Grid->RowIndex ?>_adl_hobi"
    value="<?= HtmlEncode($Grid->adl_hobi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_hobi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_hobi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_hobi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_hobi"
    data-value-separator="<?= $Grid->adl_hobi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_hobi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_hobi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_hobi" id="o<?= $Grid->RowIndex ?>_adl_hobi" value="<?= HtmlEncode($Grid->adl_hobi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_hobi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" name="x<?= $Grid->RowIndex ?>_adl_hobi" id="x<?= $Grid->RowIndex ?>_adl_hobi"<?= $Grid->adl_hobi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_hobi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_hobi"
    name="x<?= $Grid->RowIndex ?>_adl_hobi"
    value="<?= HtmlEncode($Grid->adl_hobi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_hobi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_hobi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_hobi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_hobi"
    data-value-separator="<?= $Grid->adl_hobi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_hobi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_hobi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi">
<span<?= $Grid->adl_hobi->viewAttributes() ?>>
<?= $Grid->adl_hobi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_hobi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_hobi" value="<?= HtmlEncode($Grid->adl_hobi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_hobi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_hobi" value="<?= HtmlEncode($Grid->adl_hobi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <td data-name="ket_adl_hobi" <?= $Grid->ket_adl_hobi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="form-group">
<input type="<?= $Grid->ket_adl_hobi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" name="x<?= $Grid->RowIndex ?>_ket_adl_hobi" id="x<?= $Grid->RowIndex ?>_ket_adl_hobi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_hobi->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_hobi->EditValue ?>"<?= $Grid->ket_adl_hobi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_hobi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_adl_hobi" id="o<?= $Grid->RowIndex ?>_ket_adl_hobi" value="<?= HtmlEncode($Grid->ket_adl_hobi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="form-group">
<input type="<?= $Grid->ket_adl_hobi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" name="x<?= $Grid->RowIndex ?>_ket_adl_hobi" id="x<?= $Grid->RowIndex ?>_ket_adl_hobi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_hobi->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_hobi->EditValue ?>"<?= $Grid->ket_adl_hobi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_hobi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi">
<span<?= $Grid->ket_adl_hobi->viewAttributes() ?>>
<?= $Grid->ket_adl_hobi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_adl_hobi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_adl_hobi" value="<?= HtmlEncode($Grid->ket_adl_hobi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_adl_hobi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_adl_hobi" value="<?= HtmlEncode($Grid->ket_adl_hobi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <td data-name="adl_sosialisasi" <?= $Grid->adl_sosialisasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_sosialisasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" name="x<?= $Grid->RowIndex ?>_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_adl_sosialisasi"<?= $Grid->adl_sosialisasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_sosialisasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    name="x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    value="<?= HtmlEncode($Grid->adl_sosialisasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_sosialisasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_sosialisasi"
    data-value-separator="<?= $Grid->adl_sosialisasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_sosialisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_sosialisasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_sosialisasi" id="o<?= $Grid->RowIndex ?>_adl_sosialisasi" value="<?= HtmlEncode($Grid->adl_sosialisasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_sosialisasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" name="x<?= $Grid->RowIndex ?>_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_adl_sosialisasi"<?= $Grid->adl_sosialisasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_sosialisasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    name="x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    value="<?= HtmlEncode($Grid->adl_sosialisasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_sosialisasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_sosialisasi"
    data-value-separator="<?= $Grid->adl_sosialisasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_sosialisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_sosialisasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi">
<span<?= $Grid->adl_sosialisasi->viewAttributes() ?>>
<?= $Grid->adl_sosialisasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_sosialisasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_sosialisasi" value="<?= HtmlEncode($Grid->adl_sosialisasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_sosialisasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_sosialisasi" value="<?= HtmlEncode($Grid->adl_sosialisasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <td data-name="ket_adl_sosialisasi" <?= $Grid->ket_adl_sosialisasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="form-group">
<input type="<?= $Grid->ket_adl_sosialisasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" name="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_sosialisasi->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_sosialisasi->EditValue ?>"<?= $Grid->ket_adl_sosialisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_sosialisasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="o<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" value="<?= HtmlEncode($Grid->ket_adl_sosialisasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="form-group">
<input type="<?= $Grid->ket_adl_sosialisasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" name="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_sosialisasi->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_sosialisasi->EditValue ?>"<?= $Grid->ket_adl_sosialisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_sosialisasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi">
<span<?= $Grid->ket_adl_sosialisasi->viewAttributes() ?>>
<?= $Grid->ket_adl_sosialisasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" value="<?= HtmlEncode($Grid->ket_adl_sosialisasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" value="<?= HtmlEncode($Grid->ket_adl_sosialisasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <td data-name="adl_kegiatan" <?= $Grid->adl_kegiatan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_kegiatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" name="x<?= $Grid->RowIndex ?>_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_adl_kegiatan"<?= $Grid->adl_kegiatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_kegiatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_kegiatan"
    name="x<?= $Grid->RowIndex ?>_adl_kegiatan"
    value="<?= HtmlEncode($Grid->adl_kegiatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_kegiatan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_kegiatan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_kegiatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_kegiatan"
    data-value-separator="<?= $Grid->adl_kegiatan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_kegiatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_kegiatan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_kegiatan" id="o<?= $Grid->RowIndex ?>_adl_kegiatan" value="<?= HtmlEncode($Grid->adl_kegiatan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_kegiatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" name="x<?= $Grid->RowIndex ?>_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_adl_kegiatan"<?= $Grid->adl_kegiatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_kegiatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_kegiatan"
    name="x<?= $Grid->RowIndex ?>_adl_kegiatan"
    value="<?= HtmlEncode($Grid->adl_kegiatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_kegiatan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_kegiatan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_kegiatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_kegiatan"
    data-value-separator="<?= $Grid->adl_kegiatan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_kegiatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_kegiatan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan">
<span<?= $Grid->adl_kegiatan->viewAttributes() ?>>
<?= $Grid->adl_kegiatan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_kegiatan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_adl_kegiatan" value="<?= HtmlEncode($Grid->adl_kegiatan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_kegiatan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_adl_kegiatan" value="<?= HtmlEncode($Grid->adl_kegiatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <td data-name="ket_adl_kegiatan" <?= $Grid->ket_adl_kegiatan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="form-group">
<input type="<?= $Grid->ket_adl_kegiatan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" name="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_kegiatan->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_kegiatan->EditValue ?>"<?= $Grid->ket_adl_kegiatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_kegiatan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="o<?= $Grid->RowIndex ?>_ket_adl_kegiatan" value="<?= HtmlEncode($Grid->ket_adl_kegiatan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="form-group">
<input type="<?= $Grid->ket_adl_kegiatan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" name="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_kegiatan->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_kegiatan->EditValue ?>"<?= $Grid->ket_adl_kegiatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_kegiatan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan">
<span<?= $Grid->ket_adl_kegiatan->viewAttributes() ?>>
<?= $Grid->ket_adl_kegiatan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" value="<?= HtmlEncode($Grid->ket_adl_kegiatan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_adl_kegiatan" value="<?= HtmlEncode($Grid->ket_adl_kegiatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_penampilan->Visible) { // sk_penampilan ?>
        <td data-name="sk_penampilan" <?= $Grid->sk_penampilan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_penampilan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" name="x<?= $Grid->RowIndex ?>_sk_penampilan" id="x<?= $Grid->RowIndex ?>_sk_penampilan"<?= $Grid->sk_penampilan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_penampilan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_penampilan"
    name="x<?= $Grid->RowIndex ?>_sk_penampilan"
    value="<?= HtmlEncode($Grid->sk_penampilan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_penampilan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_penampilan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_penampilan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_penampilan"
    data-value-separator="<?= $Grid->sk_penampilan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_penampilan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_penampilan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_penampilan" id="o<?= $Grid->RowIndex ?>_sk_penampilan" value="<?= HtmlEncode($Grid->sk_penampilan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_penampilan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" name="x<?= $Grid->RowIndex ?>_sk_penampilan" id="x<?= $Grid->RowIndex ?>_sk_penampilan"<?= $Grid->sk_penampilan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_penampilan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_penampilan"
    name="x<?= $Grid->RowIndex ?>_sk_penampilan"
    value="<?= HtmlEncode($Grid->sk_penampilan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_penampilan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_penampilan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_penampilan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_penampilan"
    data-value-separator="<?= $Grid->sk_penampilan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_penampilan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_penampilan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan">
<span<?= $Grid->sk_penampilan->viewAttributes() ?>>
<?= $Grid->sk_penampilan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_penampilan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_penampilan" value="<?= HtmlEncode($Grid->sk_penampilan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_penampilan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_penampilan" value="<?= HtmlEncode($Grid->sk_penampilan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <td data-name="sk_alam_perasaan" <?= $Grid->sk_alam_perasaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_alam_perasaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" name="x<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"<?= $Grid->sk_alam_perasaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_alam_perasaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    name="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    value="<?= HtmlEncode($Grid->sk_alam_perasaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_alam_perasaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_alam_perasaan"
    data-value-separator="<?= $Grid->sk_alam_perasaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_alam_perasaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_alam_perasaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="o<?= $Grid->RowIndex ?>_sk_alam_perasaan" value="<?= HtmlEncode($Grid->sk_alam_perasaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_alam_perasaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" name="x<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"<?= $Grid->sk_alam_perasaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_alam_perasaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    name="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    value="<?= HtmlEncode($Grid->sk_alam_perasaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_alam_perasaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_alam_perasaan"
    data-value-separator="<?= $Grid->sk_alam_perasaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_alam_perasaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_alam_perasaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan">
<span<?= $Grid->sk_alam_perasaan->viewAttributes() ?>>
<?= $Grid->sk_alam_perasaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_alam_perasaan" value="<?= HtmlEncode($Grid->sk_alam_perasaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_alam_perasaan" value="<?= HtmlEncode($Grid->sk_alam_perasaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <td data-name="sk_pembicaraan" <?= $Grid->sk_pembicaraan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_pembicaraan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" name="x<?= $Grid->RowIndex ?>_sk_pembicaraan" id="x<?= $Grid->RowIndex ?>_sk_pembicaraan"<?= $Grid->sk_pembicaraan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_pembicaraan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    name="x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    value="<?= HtmlEncode($Grid->sk_pembicaraan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_pembicaraan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_pembicaraan"
    data-value-separator="<?= $Grid->sk_pembicaraan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_pembicaraan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_pembicaraan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_pembicaraan" id="o<?= $Grid->RowIndex ?>_sk_pembicaraan" value="<?= HtmlEncode($Grid->sk_pembicaraan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_pembicaraan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" name="x<?= $Grid->RowIndex ?>_sk_pembicaraan" id="x<?= $Grid->RowIndex ?>_sk_pembicaraan"<?= $Grid->sk_pembicaraan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_pembicaraan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    name="x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    value="<?= HtmlEncode($Grid->sk_pembicaraan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_pembicaraan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_pembicaraan"
    data-value-separator="<?= $Grid->sk_pembicaraan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_pembicaraan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_pembicaraan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan">
<span<?= $Grid->sk_pembicaraan->viewAttributes() ?>>
<?= $Grid->sk_pembicaraan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_pembicaraan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_pembicaraan" value="<?= HtmlEncode($Grid->sk_pembicaraan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_pembicaraan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_pembicaraan" value="<?= HtmlEncode($Grid->sk_pembicaraan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_afek->Visible) { // sk_afek ?>
        <td data-name="sk_afek" <?= $Grid->sk_afek->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_afek">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" name="x<?= $Grid->RowIndex ?>_sk_afek" id="x<?= $Grid->RowIndex ?>_sk_afek"<?= $Grid->sk_afek->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_afek" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_afek"
    name="x<?= $Grid->RowIndex ?>_sk_afek"
    value="<?= HtmlEncode($Grid->sk_afek->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_afek"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_afek"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_afek->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_afek"
    data-value-separator="<?= $Grid->sk_afek->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_afek->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_afek->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_afek" id="o<?= $Grid->RowIndex ?>_sk_afek" value="<?= HtmlEncode($Grid->sk_afek->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_afek">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" name="x<?= $Grid->RowIndex ?>_sk_afek" id="x<?= $Grid->RowIndex ?>_sk_afek"<?= $Grid->sk_afek->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_afek" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_afek"
    name="x<?= $Grid->RowIndex ?>_sk_afek"
    value="<?= HtmlEncode($Grid->sk_afek->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_afek"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_afek"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_afek->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_afek"
    data-value-separator="<?= $Grid->sk_afek->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_afek->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_afek->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek">
<span<?= $Grid->sk_afek->viewAttributes() ?>>
<?= $Grid->sk_afek->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_afek" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_afek" value="<?= HtmlEncode($Grid->sk_afek->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_afek" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_afek" value="<?= HtmlEncode($Grid->sk_afek->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <td data-name="sk_aktifitas_motorik" <?= $Grid->sk_aktifitas_motorik->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" name="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"<?= $Grid->sk_aktifitas_motorik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    name="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_aktifitas_motorik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_aktifitas_motorik"
    data-value-separator="<?= $Grid->sk_aktifitas_motorik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_aktifitas_motorik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_aktifitas_motorik->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="o<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" name="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"<?= $Grid->sk_aktifitas_motorik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    name="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_aktifitas_motorik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_aktifitas_motorik"
    data-value-separator="<?= $Grid->sk_aktifitas_motorik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_aktifitas_motorik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_aktifitas_motorik->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik">
<span<?= $Grid->sk_aktifitas_motorik->viewAttributes() ?>>
<?= $Grid->sk_aktifitas_motorik->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <td data-name="sk_gangguan_ringan" <?= $Grid->sk_gangguan_ringan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" name="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"<?= $Grid->sk_gangguan_ringan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    name="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    value="<?= HtmlEncode($Grid->sk_gangguan_ringan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_gangguan_ringan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_gangguan_ringan"
    data-value-separator="<?= $Grid->sk_gangguan_ringan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_gangguan_ringan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_gangguan_ringan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="o<?= $Grid->RowIndex ?>_sk_gangguan_ringan" value="<?= HtmlEncode($Grid->sk_gangguan_ringan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" name="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"<?= $Grid->sk_gangguan_ringan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    name="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    value="<?= HtmlEncode($Grid->sk_gangguan_ringan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_gangguan_ringan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_gangguan_ringan"
    data-value-separator="<?= $Grid->sk_gangguan_ringan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_gangguan_ringan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_gangguan_ringan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan">
<span<?= $Grid->sk_gangguan_ringan->viewAttributes() ?>>
<?= $Grid->sk_gangguan_ringan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" value="<?= HtmlEncode($Grid->sk_gangguan_ringan->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_gangguan_ringan" value="<?= HtmlEncode($Grid->sk_gangguan_ringan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <td data-name="sk_proses_pikir" <?= $Grid->sk_proses_pikir->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_proses_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" name="x<?= $Grid->RowIndex ?>_sk_proses_pikir" id="x<?= $Grid->RowIndex ?>_sk_proses_pikir"<?= $Grid->sk_proses_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_proses_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    name="x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    value="<?= HtmlEncode($Grid->sk_proses_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_proses_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_proses_pikir"
    data-value-separator="<?= $Grid->sk_proses_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_proses_pikir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_proses_pikir->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_proses_pikir" id="o<?= $Grid->RowIndex ?>_sk_proses_pikir" value="<?= HtmlEncode($Grid->sk_proses_pikir->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_proses_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" name="x<?= $Grid->RowIndex ?>_sk_proses_pikir" id="x<?= $Grid->RowIndex ?>_sk_proses_pikir"<?= $Grid->sk_proses_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_proses_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    name="x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    value="<?= HtmlEncode($Grid->sk_proses_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_proses_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_proses_pikir"
    data-value-separator="<?= $Grid->sk_proses_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_proses_pikir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_proses_pikir->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir">
<span<?= $Grid->sk_proses_pikir->viewAttributes() ?>>
<?= $Grid->sk_proses_pikir->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_proses_pikir" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_proses_pikir" value="<?= HtmlEncode($Grid->sk_proses_pikir->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_proses_pikir" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_proses_pikir" value="<?= HtmlEncode($Grid->sk_proses_pikir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_orientasi->Visible) { // sk_orientasi ?>
        <td data-name="sk_orientasi" <?= $Grid->sk_orientasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" name="x<?= $Grid->RowIndex ?>_sk_orientasi" id="x<?= $Grid->RowIndex ?>_sk_orientasi"<?= $Grid->sk_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_orientasi"
    name="x<?= $Grid->RowIndex ?>_sk_orientasi"
    value="<?= HtmlEncode($Grid->sk_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_orientasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_orientasi"
    data-value-separator="<?= $Grid->sk_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_orientasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_orientasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_orientasi" id="o<?= $Grid->RowIndex ?>_sk_orientasi" value="<?= HtmlEncode($Grid->sk_orientasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" name="x<?= $Grid->RowIndex ?>_sk_orientasi" id="x<?= $Grid->RowIndex ?>_sk_orientasi"<?= $Grid->sk_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_orientasi"
    name="x<?= $Grid->RowIndex ?>_sk_orientasi"
    value="<?= HtmlEncode($Grid->sk_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_orientasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_orientasi"
    data-value-separator="<?= $Grid->sk_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_orientasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_orientasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi">
<span<?= $Grid->sk_orientasi->viewAttributes() ?>>
<?= $Grid->sk_orientasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_orientasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_orientasi" value="<?= HtmlEncode($Grid->sk_orientasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_orientasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_orientasi" value="<?= HtmlEncode($Grid->sk_orientasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <td data-name="sk_tingkat_kesadaran_orientasi" <?= $Grid->sk_tingkat_kesadaran_orientasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" name="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"<?= $Grid->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    name="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_tingkat_kesadaran_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_tingkat_kesadaran_orientasi"
    data-value-separator="<?= $Grid->sk_tingkat_kesadaran_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_tingkat_kesadaran_orientasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="o<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" name="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"<?= $Grid->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    name="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_tingkat_kesadaran_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_tingkat_kesadaran_orientasi"
    data-value-separator="<?= $Grid->sk_tingkat_kesadaran_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_tingkat_kesadaran_orientasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi">
<span<?= $Grid->sk_tingkat_kesadaran_orientasi->viewAttributes() ?>>
<?= $Grid->sk_tingkat_kesadaran_orientasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_memori->Visible) { // sk_memori ?>
        <td data-name="sk_memori" <?= $Grid->sk_memori->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_memori">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" name="x<?= $Grid->RowIndex ?>_sk_memori" id="x<?= $Grid->RowIndex ?>_sk_memori"<?= $Grid->sk_memori->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_memori" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_memori"
    name="x<?= $Grid->RowIndex ?>_sk_memori"
    value="<?= HtmlEncode($Grid->sk_memori->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_memori"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_memori"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_memori->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_memori"
    data-value-separator="<?= $Grid->sk_memori->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_memori->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_memori->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_memori" id="o<?= $Grid->RowIndex ?>_sk_memori" value="<?= HtmlEncode($Grid->sk_memori->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_memori">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" name="x<?= $Grid->RowIndex ?>_sk_memori" id="x<?= $Grid->RowIndex ?>_sk_memori"<?= $Grid->sk_memori->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_memori" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_memori"
    name="x<?= $Grid->RowIndex ?>_sk_memori"
    value="<?= HtmlEncode($Grid->sk_memori->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_memori"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_memori"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_memori->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_memori"
    data-value-separator="<?= $Grid->sk_memori->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_memori->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_memori->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori">
<span<?= $Grid->sk_memori->viewAttributes() ?>>
<?= $Grid->sk_memori->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_memori" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_memori" value="<?= HtmlEncode($Grid->sk_memori->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_memori" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_memori" value="<?= HtmlEncode($Grid->sk_memori->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_interaksi->Visible) { // sk_interaksi ?>
        <td data-name="sk_interaksi" <?= $Grid->sk_interaksi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_interaksi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" name="x<?= $Grid->RowIndex ?>_sk_interaksi" id="x<?= $Grid->RowIndex ?>_sk_interaksi"<?= $Grid->sk_interaksi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_interaksi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_interaksi"
    name="x<?= $Grid->RowIndex ?>_sk_interaksi"
    value="<?= HtmlEncode($Grid->sk_interaksi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_interaksi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_interaksi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_interaksi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_interaksi"
    data-value-separator="<?= $Grid->sk_interaksi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_interaksi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_interaksi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_interaksi" id="o<?= $Grid->RowIndex ?>_sk_interaksi" value="<?= HtmlEncode($Grid->sk_interaksi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_interaksi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" name="x<?= $Grid->RowIndex ?>_sk_interaksi" id="x<?= $Grid->RowIndex ?>_sk_interaksi"<?= $Grid->sk_interaksi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_interaksi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_interaksi"
    name="x<?= $Grid->RowIndex ?>_sk_interaksi"
    value="<?= HtmlEncode($Grid->sk_interaksi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_interaksi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_interaksi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_interaksi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_interaksi"
    data-value-separator="<?= $Grid->sk_interaksi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_interaksi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_interaksi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi">
<span<?= $Grid->sk_interaksi->viewAttributes() ?>>
<?= $Grid->sk_interaksi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_interaksi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_interaksi" value="<?= HtmlEncode($Grid->sk_interaksi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_interaksi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_interaksi" value="<?= HtmlEncode($Grid->sk_interaksi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <td data-name="sk_konsentrasi" <?= $Grid->sk_konsentrasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_konsentrasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" name="x<?= $Grid->RowIndex ?>_sk_konsentrasi" id="x<?= $Grid->RowIndex ?>_sk_konsentrasi"<?= $Grid->sk_konsentrasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_konsentrasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    name="x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    value="<?= HtmlEncode($Grid->sk_konsentrasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_konsentrasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_konsentrasi"
    data-value-separator="<?= $Grid->sk_konsentrasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_konsentrasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_konsentrasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_konsentrasi" id="o<?= $Grid->RowIndex ?>_sk_konsentrasi" value="<?= HtmlEncode($Grid->sk_konsentrasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_konsentrasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" name="x<?= $Grid->RowIndex ?>_sk_konsentrasi" id="x<?= $Grid->RowIndex ?>_sk_konsentrasi"<?= $Grid->sk_konsentrasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_konsentrasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    name="x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    value="<?= HtmlEncode($Grid->sk_konsentrasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_konsentrasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_konsentrasi"
    data-value-separator="<?= $Grid->sk_konsentrasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_konsentrasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_konsentrasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi">
<span<?= $Grid->sk_konsentrasi->viewAttributes() ?>>
<?= $Grid->sk_konsentrasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_konsentrasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_konsentrasi" value="<?= HtmlEncode($Grid->sk_konsentrasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_konsentrasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_konsentrasi" value="<?= HtmlEncode($Grid->sk_konsentrasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_persepsi->Visible) { // sk_persepsi ?>
        <td data-name="sk_persepsi" <?= $Grid->sk_persepsi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_persepsi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" name="x<?= $Grid->RowIndex ?>_sk_persepsi" id="x<?= $Grid->RowIndex ?>_sk_persepsi"<?= $Grid->sk_persepsi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_persepsi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_persepsi"
    name="x<?= $Grid->RowIndex ?>_sk_persepsi"
    value="<?= HtmlEncode($Grid->sk_persepsi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_persepsi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_persepsi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_persepsi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_persepsi"
    data-value-separator="<?= $Grid->sk_persepsi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_persepsi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_persepsi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_persepsi" id="o<?= $Grid->RowIndex ?>_sk_persepsi" value="<?= HtmlEncode($Grid->sk_persepsi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_persepsi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" name="x<?= $Grid->RowIndex ?>_sk_persepsi" id="x<?= $Grid->RowIndex ?>_sk_persepsi"<?= $Grid->sk_persepsi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_persepsi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_persepsi"
    name="x<?= $Grid->RowIndex ?>_sk_persepsi"
    value="<?= HtmlEncode($Grid->sk_persepsi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_persepsi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_persepsi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_persepsi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_persepsi"
    data-value-separator="<?= $Grid->sk_persepsi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_persepsi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_persepsi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi">
<span<?= $Grid->sk_persepsi->viewAttributes() ?>>
<?= $Grid->sk_persepsi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_persepsi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_persepsi" value="<?= HtmlEncode($Grid->sk_persepsi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_persepsi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_persepsi" value="<?= HtmlEncode($Grid->sk_persepsi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <td data-name="ket_sk_persepsi" <?= $Grid->ket_sk_persepsi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="form-group">
<input type="<?= $Grid->ket_sk_persepsi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" name="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" size="30" maxlength="70" placeholder="<?= HtmlEncode($Grid->ket_sk_persepsi->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_persepsi->EditValue ?>"<?= $Grid->ket_sk_persepsi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_persepsi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="o<?= $Grid->RowIndex ?>_ket_sk_persepsi" value="<?= HtmlEncode($Grid->ket_sk_persepsi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="form-group">
<input type="<?= $Grid->ket_sk_persepsi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" name="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" size="30" maxlength="70" placeholder="<?= HtmlEncode($Grid->ket_sk_persepsi->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_persepsi->EditValue ?>"<?= $Grid->ket_sk_persepsi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_persepsi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi">
<span<?= $Grid->ket_sk_persepsi->viewAttributes() ?>>
<?= $Grid->ket_sk_persepsi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_sk_persepsi" value="<?= HtmlEncode($Grid->ket_sk_persepsi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_sk_persepsi" value="<?= HtmlEncode($Grid->ket_sk_persepsi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <td data-name="sk_isi_pikir" <?= $Grid->sk_isi_pikir->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_isi_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" name="x<?= $Grid->RowIndex ?>_sk_isi_pikir" id="x<?= $Grid->RowIndex ?>_sk_isi_pikir"<?= $Grid->sk_isi_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_isi_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    name="x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    value="<?= HtmlEncode($Grid->sk_isi_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_isi_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_isi_pikir"
    data-value-separator="<?= $Grid->sk_isi_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_isi_pikir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_isi_pikir->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_isi_pikir" id="o<?= $Grid->RowIndex ?>_sk_isi_pikir" value="<?= HtmlEncode($Grid->sk_isi_pikir->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_isi_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" name="x<?= $Grid->RowIndex ?>_sk_isi_pikir" id="x<?= $Grid->RowIndex ?>_sk_isi_pikir"<?= $Grid->sk_isi_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_isi_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    name="x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    value="<?= HtmlEncode($Grid->sk_isi_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_isi_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_isi_pikir"
    data-value-separator="<?= $Grid->sk_isi_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_isi_pikir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_isi_pikir->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir">
<span<?= $Grid->sk_isi_pikir->viewAttributes() ?>>
<?= $Grid->sk_isi_pikir->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_isi_pikir" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_isi_pikir" value="<?= HtmlEncode($Grid->sk_isi_pikir->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_isi_pikir" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_isi_pikir" value="<?= HtmlEncode($Grid->sk_isi_pikir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_waham->Visible) { // sk_waham ?>
        <td data-name="sk_waham" <?= $Grid->sk_waham->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_waham">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" name="x<?= $Grid->RowIndex ?>_sk_waham" id="x<?= $Grid->RowIndex ?>_sk_waham"<?= $Grid->sk_waham->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_waham" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_waham"
    name="x<?= $Grid->RowIndex ?>_sk_waham"
    value="<?= HtmlEncode($Grid->sk_waham->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_waham"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_waham"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_waham->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_waham"
    data-value-separator="<?= $Grid->sk_waham->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_waham->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_waham->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_waham" id="o<?= $Grid->RowIndex ?>_sk_waham" value="<?= HtmlEncode($Grid->sk_waham->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_waham">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" name="x<?= $Grid->RowIndex ?>_sk_waham" id="x<?= $Grid->RowIndex ?>_sk_waham"<?= $Grid->sk_waham->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_waham" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_waham"
    name="x<?= $Grid->RowIndex ?>_sk_waham"
    value="<?= HtmlEncode($Grid->sk_waham->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_waham"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_waham"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_waham->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_waham"
    data-value-separator="<?= $Grid->sk_waham->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_waham->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_waham->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham">
<span<?= $Grid->sk_waham->viewAttributes() ?>>
<?= $Grid->sk_waham->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_waham" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_waham" value="<?= HtmlEncode($Grid->sk_waham->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_waham" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_waham" value="<?= HtmlEncode($Grid->sk_waham->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <td data-name="ket_sk_waham" <?= $Grid->ket_sk_waham->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="form-group">
<input type="<?= $Grid->ket_sk_waham->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" name="x<?= $Grid->RowIndex ?>_ket_sk_waham" id="x<?= $Grid->RowIndex ?>_ket_sk_waham" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_sk_waham->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_waham->EditValue ?>"<?= $Grid->ket_sk_waham->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_waham->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_sk_waham" id="o<?= $Grid->RowIndex ?>_ket_sk_waham" value="<?= HtmlEncode($Grid->ket_sk_waham->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="form-group">
<input type="<?= $Grid->ket_sk_waham->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" name="x<?= $Grid->RowIndex ?>_ket_sk_waham" id="x<?= $Grid->RowIndex ?>_ket_sk_waham" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_sk_waham->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_waham->EditValue ?>"<?= $Grid->ket_sk_waham->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_waham->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham">
<span<?= $Grid->ket_sk_waham->viewAttributes() ?>>
<?= $Grid->ket_sk_waham->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_sk_waham" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_sk_waham" value="<?= HtmlEncode($Grid->ket_sk_waham->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_sk_waham" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_sk_waham" value="<?= HtmlEncode($Grid->ket_sk_waham->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <td data-name="sk_daya_tilik_diri" <?= $Grid->sk_daya_tilik_diri->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" name="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"<?= $Grid->sk_daya_tilik_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    name="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_daya_tilik_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_daya_tilik_diri"
    data-value-separator="<?= $Grid->sk_daya_tilik_diri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_daya_tilik_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="o<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" name="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"<?= $Grid->sk_daya_tilik_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    name="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_daya_tilik_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_daya_tilik_diri"
    data-value-separator="<?= $Grid->sk_daya_tilik_diri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_daya_tilik_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri">
<span<?= $Grid->sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Grid->sk_daya_tilik_diri->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <td data-name="ket_sk_daya_tilik_diri" <?= $Grid->ket_sk_daya_tilik_diri->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="form-group">
<input type="<?= $Grid->ket_sk_daya_tilik_diri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" name="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_daya_tilik_diri->EditValue ?>"<?= $Grid->ket_sk_daya_tilik_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="o<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="form-group">
<input type="<?= $Grid->ket_sk_daya_tilik_diri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" name="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_daya_tilik_diri->EditValue ?>"<?= $Grid->ket_sk_daya_tilik_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri">
<span<?= $Grid->ket_sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Grid->ket_sk_daya_tilik_diri->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <td data-name="kk_pembelajaran" <?= $Grid->kk_pembelajaran->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" name="x<?= $Grid->RowIndex ?>_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_kk_pembelajaran"<?= $Grid->kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    name="x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    value="<?= HtmlEncode($Grid->kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_pembelajaran"
    data-value-separator="<?= $Grid->kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_pembelajaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_pembelajaran->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_pembelajaran" id="o<?= $Grid->RowIndex ?>_kk_pembelajaran" value="<?= HtmlEncode($Grid->kk_pembelajaran->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" name="x<?= $Grid->RowIndex ?>_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_kk_pembelajaran"<?= $Grid->kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    name="x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    value="<?= HtmlEncode($Grid->kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_pembelajaran"
    data-value-separator="<?= $Grid->kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_pembelajaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_pembelajaran->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran">
<span<?= $Grid->kk_pembelajaran->viewAttributes() ?>>
<?= $Grid->kk_pembelajaran->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_pembelajaran" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_pembelajaran" value="<?= HtmlEncode($Grid->kk_pembelajaran->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_pembelajaran" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_pembelajaran" value="<?= HtmlEncode($Grid->kk_pembelajaran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <td data-name="ket_kk_pembelajaran" <?= $Grid->ket_kk_pembelajaran->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"<?= $Grid->ket_kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->ket_kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_ket_kk_pembelajaran"
    data-value-separator="<?= $Grid->ket_kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->ket_kk_pembelajaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_pembelajaran->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"<?= $Grid->ket_kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->ket_kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_ket_kk_pembelajaran"
    data-value-separator="<?= $Grid->ket_kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->ket_kk_pembelajaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_pembelajaran->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran">
<span<?= $Grid->ket_kk_pembelajaran->viewAttributes() ?>>
<?= $Grid->ket_kk_pembelajaran->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <td data-name="ket_kk_pembelajaran_lainnya" <?= $Grid->ket_kk_pembelajaran_lainnya->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="form-group">
<input type="<?= $Grid->ket_kk_pembelajaran_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_pembelajaran_lainnya->EditValue ?>"<?= $Grid->ket_kk_pembelajaran_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_pembelajaran_lainnya->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="form-group">
<input type="<?= $Grid->ket_kk_pembelajaran_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_pembelajaran_lainnya->EditValue ?>"<?= $Grid->ket_kk_pembelajaran_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_pembelajaran_lainnya->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya">
<span<?= $Grid->ket_kk_pembelajaran_lainnya->viewAttributes() ?>>
<?= $Grid->ket_kk_pembelajaran_lainnya->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <td data-name="kk_Penerjamah" <?= $Grid->kk_Penerjamah->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_Penerjamah">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" name="x<?= $Grid->RowIndex ?>_kk_Penerjamah" id="x<?= $Grid->RowIndex ?>_kk_Penerjamah"<?= $Grid->kk_Penerjamah->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_Penerjamah" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    name="x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    value="<?= HtmlEncode($Grid->kk_Penerjamah->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_Penerjamah->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_Penerjamah"
    data-value-separator="<?= $Grid->kk_Penerjamah->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_Penerjamah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_Penerjamah->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_Penerjamah" id="o<?= $Grid->RowIndex ?>_kk_Penerjamah" value="<?= HtmlEncode($Grid->kk_Penerjamah->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_Penerjamah">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" name="x<?= $Grid->RowIndex ?>_kk_Penerjamah" id="x<?= $Grid->RowIndex ?>_kk_Penerjamah"<?= $Grid->kk_Penerjamah->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_Penerjamah" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    name="x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    value="<?= HtmlEncode($Grid->kk_Penerjamah->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_Penerjamah->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_Penerjamah"
    data-value-separator="<?= $Grid->kk_Penerjamah->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_Penerjamah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_Penerjamah->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah">
<span<?= $Grid->kk_Penerjamah->viewAttributes() ?>>
<?= $Grid->kk_Penerjamah->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_Penerjamah" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_Penerjamah" value="<?= HtmlEncode($Grid->kk_Penerjamah->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_Penerjamah" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_Penerjamah" value="<?= HtmlEncode($Grid->kk_Penerjamah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <td data-name="ket_kk_penerjamah_Lainnya" <?= $Grid->ket_kk_penerjamah_Lainnya->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="form-group">
<input type="<?= $Grid->ket_kk_penerjamah_Lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" name="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_penerjamah_Lainnya->EditValue ?>"<?= $Grid->ket_kk_penerjamah_Lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_penerjamah_Lainnya->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="o<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" value="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="form-group">
<input type="<?= $Grid->ket_kk_penerjamah_Lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" name="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_penerjamah_Lainnya->EditValue ?>"<?= $Grid->ket_kk_penerjamah_Lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_penerjamah_Lainnya->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya">
<span<?= $Grid->ket_kk_penerjamah_Lainnya->viewAttributes() ?>>
<?= $Grid->ket_kk_penerjamah_Lainnya->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" value="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" value="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <td data-name="kk_bahasa_isyarat" <?= $Grid->kk_bahasa_isyarat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" name="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"<?= $Grid->kk_bahasa_isyarat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    name="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_bahasa_isyarat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_bahasa_isyarat"
    data-value-separator="<?= $Grid->kk_bahasa_isyarat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_bahasa_isyarat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_bahasa_isyarat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="o<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" name="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"<?= $Grid->kk_bahasa_isyarat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    name="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_bahasa_isyarat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_bahasa_isyarat"
    data-value-separator="<?= $Grid->kk_bahasa_isyarat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_bahasa_isyarat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_bahasa_isyarat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat">
<span<?= $Grid->kk_bahasa_isyarat->viewAttributes() ?>>
<?= $Grid->kk_bahasa_isyarat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <td data-name="kk_kebutuhan_edukasi" <?= $Grid->kk_kebutuhan_edukasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" name="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"<?= $Grid->kk_kebutuhan_edukasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    name="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_kebutuhan_edukasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_kebutuhan_edukasi"
    data-value-separator="<?= $Grid->kk_kebutuhan_edukasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_kebutuhan_edukasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="o<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" name="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"<?= $Grid->kk_kebutuhan_edukasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    name="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_kebutuhan_edukasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_kebutuhan_edukasi"
    data-value-separator="<?= $Grid->kk_kebutuhan_edukasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_kebutuhan_edukasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi">
<span<?= $Grid->kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Grid->kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <td data-name="ket_kk_kebutuhan_edukasi" <?= $Grid->ket_kk_kebutuhan_edukasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="form-group">
<input type="<?= $Grid->ket_kk_kebutuhan_edukasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" name="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_kebutuhan_edukasi->EditValue ?>"<?= $Grid->ket_kk_kebutuhan_edukasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="o<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="form-group">
<input type="<?= $Grid->ket_kk_kebutuhan_edukasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" name="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_kebutuhan_edukasi->EditValue ?>"<?= $Grid->ket_kk_kebutuhan_edukasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi">
<span<?= $Grid->ket_kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Grid->ket_kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rencana->Visible) { // rencana ?>
        <td data-name="rencana" <?= $Grid->rencana->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="form-group">
<input type="<?= $Grid->rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" name="x<?= $Grid->RowIndex ?>_rencana" id="x<?= $Grid->RowIndex ?>_rencana" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->rencana->getPlaceHolder()) ?>" value="<?= $Grid->rencana->EditValue ?>"<?= $Grid->rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rencana->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rencana" id="o<?= $Grid->RowIndex ?>_rencana" value="<?= HtmlEncode($Grid->rencana->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="form-group">
<input type="<?= $Grid->rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" name="x<?= $Grid->RowIndex ?>_rencana" id="x<?= $Grid->RowIndex ?>_rencana" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->rencana->getPlaceHolder()) ?>" value="<?= $Grid->rencana->EditValue ?>"<?= $Grid->rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rencana->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rencana">
<span<?= $Grid->rencana->viewAttributes() ?>>
<?= $Grid->rencana->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rencana" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_rencana" value="<?= HtmlEncode($Grid->rencana->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rencana" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_rencana" value="<?= HtmlEncode($Grid->rencana->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nip->Visible) { // nip ?>
        <td data-name="nip" <?= $Grid->nip->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="form-group">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nip" id="o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="form-group">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nip">
<span<?= $Grid->nip->viewAttributes() ?>>
<?= $Grid->nip->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nip" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$x<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" data-hidden="1" name="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nip" id="fpenilaian_awal_keperawatan_ralan_psikiatrigrid$o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpenilaian_awal_keperawatan_ralan_psikiatrigrid","load"], function () {
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_penilaian_awal_keperawatan_ralan_psikiatri", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->no_rawat->Visible) { // no_rawat ?>
        <td data-name="no_rawat">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_tanggal">
<input type="<?= $Grid->tanggal->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" placeholder="<?= HtmlEncode($Grid->tanggal->getPlaceHolder()) ?>" value="<?= $Grid->tanggal->EditValue ?>"<?= $Grid->tanggal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal->ReadOnly && !$Grid->tanggal->Disabled && !isset($Grid->tanggal->EditAttrs["readonly"]) && !isset($Grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_awal_keperawatan_ralan_psikiatrigrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_awal_keperawatan_ralan_psikiatrigrid", "x<?= $Grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggal->getDisplayValue($Grid->tanggal->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->informasi->Visible) { // informasi ?>
        <td data-name="informasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_informasi">
<template id="tp_x<?= $Grid->RowIndex ?>_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi"<?= $Grid->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_informasi"
    name="x<?= $Grid->RowIndex ?>_informasi"
    value="<?= HtmlEncode($Grid->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_informasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_informasi"
    data-value-separator="<?= $Grid->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->informasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->informasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_informasi">
<span<?= $Grid->informasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->informasi->getDisplayValue($Grid->informasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_informasi" id="o<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <td data-name="rkd_sakit_sejak">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak">
<input type="<?= $Grid->rkd_sakit_sejak->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" name="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->rkd_sakit_sejak->getPlaceHolder()) ?>" value="<?= $Grid->rkd_sakit_sejak->EditValue ?>"<?= $Grid->rkd_sakit_sejak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_sakit_sejak->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak">
<span<?= $Grid->rkd_sakit_sejak->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rkd_sakit_sejak->getDisplayValue($Grid->rkd_sakit_sejak->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="x<?= $Grid->RowIndex ?>_rkd_sakit_sejak" value="<?= HtmlEncode($Grid->rkd_sakit_sejak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rkd_sakit_sejak" id="o<?= $Grid->RowIndex ?>_rkd_sakit_sejak" value="<?= HtmlEncode($Grid->rkd_sakit_sejak->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rkd_berobat->Visible) { // rkd_berobat ?>
        <td data-name="rkd_berobat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat">
<template id="tp_x<?= $Grid->RowIndex ?>_rkd_berobat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" name="x<?= $Grid->RowIndex ?>_rkd_berobat" id="x<?= $Grid->RowIndex ?>_rkd_berobat"<?= $Grid->rkd_berobat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rkd_berobat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rkd_berobat"
    name="x<?= $Grid->RowIndex ?>_rkd_berobat"
    value="<?= HtmlEncode($Grid->rkd_berobat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rkd_berobat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rkd_berobat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rkd_berobat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_berobat"
    data-value-separator="<?= $Grid->rkd_berobat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rkd_berobat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_berobat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat">
<span<?= $Grid->rkd_berobat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rkd_berobat->getDisplayValue($Grid->rkd_berobat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rkd_berobat" id="x<?= $Grid->RowIndex ?>_rkd_berobat" value="<?= HtmlEncode($Grid->rkd_berobat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rkd_berobat" id="o<?= $Grid->RowIndex ?>_rkd_berobat" value="<?= HtmlEncode($Grid->rkd_berobat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <td data-name="rkd_hasil_pengobatan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan">
<template id="tp_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" name="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"<?= $Grid->rkd_hasil_pengobatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    name="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rkd_hasil_pengobatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_hasil_pengobatan"
    data-value-separator="<?= $Grid->rkd_hasil_pengobatan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rkd_hasil_pengobatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rkd_hasil_pengobatan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan">
<span<?= $Grid->rkd_hasil_pengobatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rkd_hasil_pengobatan->getDisplayValue($Grid->rkd_hasil_pengobatan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="x<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" id="o<?= $Grid->RowIndex ?>_rkd_hasil_pengobatan" value="<?= HtmlEncode($Grid->rkd_hasil_pengobatan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <td data-name="fp_putus_obat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_putus_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" name="x<?= $Grid->RowIndex ?>_fp_putus_obat" id="x<?= $Grid->RowIndex ?>_fp_putus_obat"<?= $Grid->fp_putus_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_putus_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_putus_obat"
    name="x<?= $Grid->RowIndex ?>_fp_putus_obat"
    value="<?= HtmlEncode($Grid->fp_putus_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_putus_obat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_putus_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_putus_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_putus_obat"
    data-value-separator="<?= $Grid->fp_putus_obat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_putus_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_putus_obat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat">
<span<?= $Grid->fp_putus_obat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fp_putus_obat->getDisplayValue($Grid->fp_putus_obat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_fp_putus_obat" id="x<?= $Grid->RowIndex ?>_fp_putus_obat" value="<?= HtmlEncode($Grid->fp_putus_obat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_putus_obat" id="o<?= $Grid->RowIndex ?>_fp_putus_obat" value="<?= HtmlEncode($Grid->fp_putus_obat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <td data-name="ket_putus_obat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat">
<input type="<?= $Grid->ket_putus_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" name="x<?= $Grid->RowIndex ?>_ket_putus_obat" id="x<?= $Grid->RowIndex ?>_ket_putus_obat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_putus_obat->getPlaceHolder()) ?>" value="<?= $Grid->ket_putus_obat->EditValue ?>"<?= $Grid->ket_putus_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_putus_obat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat">
<span<?= $Grid->ket_putus_obat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_putus_obat->getDisplayValue($Grid->ket_putus_obat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_putus_obat" id="x<?= $Grid->RowIndex ?>_ket_putus_obat" value="<?= HtmlEncode($Grid->ket_putus_obat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_putus_obat" id="o<?= $Grid->RowIndex ?>_ket_putus_obat" value="<?= HtmlEncode($Grid->ket_putus_obat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <td data-name="fp_ekonomi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_ekonomi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" name="x<?= $Grid->RowIndex ?>_fp_ekonomi" id="x<?= $Grid->RowIndex ?>_fp_ekonomi"<?= $Grid->fp_ekonomi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_ekonomi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_ekonomi"
    name="x<?= $Grid->RowIndex ?>_fp_ekonomi"
    value="<?= HtmlEncode($Grid->fp_ekonomi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_ekonomi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_ekonomi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_ekonomi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_ekonomi"
    data-value-separator="<?= $Grid->fp_ekonomi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_ekonomi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_ekonomi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi">
<span<?= $Grid->fp_ekonomi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fp_ekonomi->getDisplayValue($Grid->fp_ekonomi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_fp_ekonomi" id="x<?= $Grid->RowIndex ?>_fp_ekonomi" value="<?= HtmlEncode($Grid->fp_ekonomi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_ekonomi" id="o<?= $Grid->RowIndex ?>_fp_ekonomi" value="<?= HtmlEncode($Grid->fp_ekonomi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <td data-name="ket_masalah_ekonomi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi">
<input type="<?= $Grid->ket_masalah_ekonomi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" name="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_ekonomi->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_ekonomi->EditValue ?>"<?= $Grid->ket_masalah_ekonomi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_ekonomi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi">
<span<?= $Grid->ket_masalah_ekonomi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_masalah_ekonomi->getDisplayValue($Grid->ket_masalah_ekonomi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="x<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" value="<?= HtmlEncode($Grid->ket_masalah_ekonomi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" id="o<?= $Grid->RowIndex ?>_ket_masalah_ekonomi" value="<?= HtmlEncode($Grid->ket_masalah_ekonomi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <td data-name="fp_masalah_fisik">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_masalah_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" name="x<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"<?= $Grid->fp_masalah_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    name="x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    value="<?= HtmlEncode($Grid->fp_masalah_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_masalah_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_fisik"
    data-value-separator="<?= $Grid->fp_masalah_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_masalah_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_masalah_fisik->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik">
<span<?= $Grid->fp_masalah_fisik->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fp_masalah_fisik->getDisplayValue($Grid->fp_masalah_fisik->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" data-hidden="1" name="x<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="x<?= $Grid->RowIndex ?>_fp_masalah_fisik" value="<?= HtmlEncode($Grid->fp_masalah_fisik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_masalah_fisik" id="o<?= $Grid->RowIndex ?>_fp_masalah_fisik" value="<?= HtmlEncode($Grid->fp_masalah_fisik->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <td data-name="ket_masalah_fisik">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik">
<input type="<?= $Grid->ket_masalah_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" name="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_fisik->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_fisik->EditValue ?>"<?= $Grid->ket_masalah_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_fisik->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik">
<span<?= $Grid->ket_masalah_fisik->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_masalah_fisik->getDisplayValue($Grid->ket_masalah_fisik->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="x<?= $Grid->RowIndex ?>_ket_masalah_fisik" value="<?= HtmlEncode($Grid->ket_masalah_fisik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_masalah_fisik" id="o<?= $Grid->RowIndex ?>_ket_masalah_fisik" value="<?= HtmlEncode($Grid->ket_masalah_fisik->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <td data-name="fp_masalah_psikososial">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial">
<template id="tp_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" name="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"<?= $Grid->fp_masalah_psikososial->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    name="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    value="<?= HtmlEncode($Grid->fp_masalah_psikososial->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    data-target="dsl_x<?= $Grid->RowIndex ?>_fp_masalah_psikososial"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->fp_masalah_psikososial->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_psikososial"
    data-value-separator="<?= $Grid->fp_masalah_psikososial->displayValueSeparatorAttribute() ?>"
    <?= $Grid->fp_masalah_psikososial->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->fp_masalah_psikososial->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial">
<span<?= $Grid->fp_masalah_psikososial->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->fp_masalah_psikososial->getDisplayValue($Grid->fp_masalah_psikososial->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" data-hidden="1" name="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_fp_masalah_psikososial" value="<?= HtmlEncode($Grid->fp_masalah_psikososial->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" data-hidden="1" name="o<?= $Grid->RowIndex ?>_fp_masalah_psikososial" id="o<?= $Grid->RowIndex ?>_fp_masalah_psikososial" value="<?= HtmlEncode($Grid->fp_masalah_psikososial->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <td data-name="ket_masalah_psikososial">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial">
<input type="<?= $Grid->ket_masalah_psikososial->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" name="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_masalah_psikososial->getPlaceHolder()) ?>" value="<?= $Grid->ket_masalah_psikososial->EditValue ?>"<?= $Grid->ket_masalah_psikososial->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_masalah_psikososial->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial">
<span<?= $Grid->ket_masalah_psikososial->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_masalah_psikososial->getDisplayValue($Grid->ket_masalah_psikososial->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="x<?= $Grid->RowIndex ?>_ket_masalah_psikososial" value="<?= HtmlEncode($Grid->ket_masalah_psikososial->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_masalah_psikososial" id="o<?= $Grid->RowIndex ?>_ket_masalah_psikososial" value="<?= HtmlEncode($Grid->ket_masalah_psikososial->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rh_keluarga->Visible) { // rh_keluarga ?>
        <td data-name="rh_keluarga">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga">
<template id="tp_x<?= $Grid->RowIndex ?>_rh_keluarga">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" name="x<?= $Grid->RowIndex ?>_rh_keluarga" id="x<?= $Grid->RowIndex ?>_rh_keluarga"<?= $Grid->rh_keluarga->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rh_keluarga" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rh_keluarga"
    name="x<?= $Grid->RowIndex ?>_rh_keluarga"
    value="<?= HtmlEncode($Grid->rh_keluarga->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rh_keluarga"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rh_keluarga"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rh_keluarga->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rh_keluarga"
    data-value-separator="<?= $Grid->rh_keluarga->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rh_keluarga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rh_keluarga->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga">
<span<?= $Grid->rh_keluarga->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rh_keluarga->getDisplayValue($Grid->rh_keluarga->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rh_keluarga" id="x<?= $Grid->RowIndex ?>_rh_keluarga" value="<?= HtmlEncode($Grid->rh_keluarga->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rh_keluarga" id="o<?= $Grid->RowIndex ?>_rh_keluarga" value="<?= HtmlEncode($Grid->rh_keluarga->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <td data-name="ket_rh_keluarga">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga">
<input type="<?= $Grid->ket_rh_keluarga->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" name="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rh_keluarga->getPlaceHolder()) ?>" value="<?= $Grid->ket_rh_keluarga->EditValue ?>"<?= $Grid->ket_rh_keluarga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rh_keluarga->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga">
<span<?= $Grid->ket_rh_keluarga->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rh_keluarga->getDisplayValue($Grid->ket_rh_keluarga->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="x<?= $Grid->RowIndex ?>_ket_rh_keluarga" value="<?= HtmlEncode($Grid->ket_rh_keluarga->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rh_keluarga" id="o<?= $Grid->RowIndex ?>_ket_rh_keluarga" value="<?= HtmlEncode($Grid->ket_rh_keluarga->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <td data-name="resiko_bunuh_diri">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri">
<template id="tp_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" name="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"<?= $Grid->resiko_bunuh_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    name="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    value="<?= HtmlEncode($Grid->resiko_bunuh_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_resiko_bunuh_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->resiko_bunuh_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resiko_bunuh_diri"
    data-value-separator="<?= $Grid->resiko_bunuh_diri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->resiko_bunuh_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->resiko_bunuh_diri->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri">
<span<?= $Grid->resiko_bunuh_diri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->resiko_bunuh_diri->getDisplayValue($Grid->resiko_bunuh_diri->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" data-hidden="1" name="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="x<?= $Grid->RowIndex ?>_resiko_bunuh_diri" value="<?= HtmlEncode($Grid->resiko_bunuh_diri->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_resiko_bunuh_diri" id="o<?= $Grid->RowIndex ?>_resiko_bunuh_diri" value="<?= HtmlEncode($Grid->resiko_bunuh_diri->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rbd_ide->Visible) { // rbd_ide ?>
        <td data-name="rbd_ide">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_ide">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" name="x<?= $Grid->RowIndex ?>_rbd_ide" id="x<?= $Grid->RowIndex ?>_rbd_ide"<?= $Grid->rbd_ide->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_ide" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_ide"
    name="x<?= $Grid->RowIndex ?>_rbd_ide"
    value="<?= HtmlEncode($Grid->rbd_ide->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_ide"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_ide"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_ide->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_ide"
    data-value-separator="<?= $Grid->rbd_ide->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_ide->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_ide->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide">
<span<?= $Grid->rbd_ide->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rbd_ide->getDisplayValue($Grid->rbd_ide->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rbd_ide" id="x<?= $Grid->RowIndex ?>_rbd_ide" value="<?= HtmlEncode($Grid->rbd_ide->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_ide" id="o<?= $Grid->RowIndex ?>_rbd_ide" value="<?= HtmlEncode($Grid->rbd_ide->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <td data-name="ket_rbd_ide">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide">
<input type="<?= $Grid->ket_rbd_ide->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" name="x<?= $Grid->RowIndex ?>_ket_rbd_ide" id="x<?= $Grid->RowIndex ?>_ket_rbd_ide" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_ide->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_ide->EditValue ?>"<?= $Grid->ket_rbd_ide->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_ide->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide">
<span<?= $Grid->ket_rbd_ide->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rbd_ide->getDisplayValue($Grid->ket_rbd_ide->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rbd_ide" id="x<?= $Grid->RowIndex ?>_ket_rbd_ide" value="<?= HtmlEncode($Grid->ket_rbd_ide->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_ide" id="o<?= $Grid->RowIndex ?>_ket_rbd_ide" value="<?= HtmlEncode($Grid->ket_rbd_ide->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rbd_rencana->Visible) { // rbd_rencana ?>
        <td data-name="rbd_rencana">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_rencana">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" name="x<?= $Grid->RowIndex ?>_rbd_rencana" id="x<?= $Grid->RowIndex ?>_rbd_rencana"<?= $Grid->rbd_rencana->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_rencana" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_rencana"
    name="x<?= $Grid->RowIndex ?>_rbd_rencana"
    value="<?= HtmlEncode($Grid->rbd_rencana->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_rencana"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_rencana"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_rencana->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_rencana"
    data-value-separator="<?= $Grid->rbd_rencana->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_rencana->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana">
<span<?= $Grid->rbd_rencana->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rbd_rencana->getDisplayValue($Grid->rbd_rencana->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rbd_rencana" id="x<?= $Grid->RowIndex ?>_rbd_rencana" value="<?= HtmlEncode($Grid->rbd_rencana->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_rencana" id="o<?= $Grid->RowIndex ?>_rbd_rencana" value="<?= HtmlEncode($Grid->rbd_rencana->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <td data-name="ket_rbd_rencana">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana">
<input type="<?= $Grid->ket_rbd_rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" name="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_rencana->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_rencana->EditValue ?>"<?= $Grid->ket_rbd_rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_rencana->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana">
<span<?= $Grid->ket_rbd_rencana->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rbd_rencana->getDisplayValue($Grid->ket_rbd_rencana->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="x<?= $Grid->RowIndex ?>_ket_rbd_rencana" value="<?= HtmlEncode($Grid->ket_rbd_rencana->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_rencana" id="o<?= $Grid->RowIndex ?>_ket_rbd_rencana" value="<?= HtmlEncode($Grid->ket_rbd_rencana->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rbd_alat->Visible) { // rbd_alat ?>
        <td data-name="rbd_alat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_alat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" name="x<?= $Grid->RowIndex ?>_rbd_alat" id="x<?= $Grid->RowIndex ?>_rbd_alat"<?= $Grid->rbd_alat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_alat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_alat"
    name="x<?= $Grid->RowIndex ?>_rbd_alat"
    value="<?= HtmlEncode($Grid->rbd_alat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_alat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_alat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_alat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_alat"
    data-value-separator="<?= $Grid->rbd_alat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_alat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_alat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat">
<span<?= $Grid->rbd_alat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rbd_alat->getDisplayValue($Grid->rbd_alat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rbd_alat" id="x<?= $Grid->RowIndex ?>_rbd_alat" value="<?= HtmlEncode($Grid->rbd_alat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_alat" id="o<?= $Grid->RowIndex ?>_rbd_alat" value="<?= HtmlEncode($Grid->rbd_alat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <td data-name="ket_rbd_alat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat">
<input type="<?= $Grid->ket_rbd_alat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" name="x<?= $Grid->RowIndex ?>_ket_rbd_alat" id="x<?= $Grid->RowIndex ?>_ket_rbd_alat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_rbd_alat->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_alat->EditValue ?>"<?= $Grid->ket_rbd_alat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_alat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat">
<span<?= $Grid->ket_rbd_alat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rbd_alat->getDisplayValue($Grid->ket_rbd_alat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rbd_alat" id="x<?= $Grid->RowIndex ?>_ket_rbd_alat" value="<?= HtmlEncode($Grid->ket_rbd_alat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_alat" id="o<?= $Grid->RowIndex ?>_ket_rbd_alat" value="<?= HtmlEncode($Grid->ket_rbd_alat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <td data-name="rbd_percobaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_percobaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" name="x<?= $Grid->RowIndex ?>_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_rbd_percobaan"<?= $Grid->rbd_percobaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_percobaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_percobaan"
    name="x<?= $Grid->RowIndex ?>_rbd_percobaan"
    value="<?= HtmlEncode($Grid->rbd_percobaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_percobaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_percobaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_percobaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_percobaan"
    data-value-separator="<?= $Grid->rbd_percobaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_percobaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_percobaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan">
<span<?= $Grid->rbd_percobaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rbd_percobaan->getDisplayValue($Grid->rbd_percobaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_rbd_percobaan" value="<?= HtmlEncode($Grid->rbd_percobaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_percobaan" id="o<?= $Grid->RowIndex ?>_rbd_percobaan" value="<?= HtmlEncode($Grid->rbd_percobaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <td data-name="ket_rbd_percobaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan">
<input type="<?= $Grid->ket_rbd_percobaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" name="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_rbd_percobaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_percobaan->EditValue ?>"<?= $Grid->ket_rbd_percobaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_percobaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan">
<span<?= $Grid->ket_rbd_percobaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rbd_percobaan->getDisplayValue($Grid->ket_rbd_percobaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="x<?= $Grid->RowIndex ?>_ket_rbd_percobaan" value="<?= HtmlEncode($Grid->ket_rbd_percobaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_percobaan" id="o<?= $Grid->RowIndex ?>_ket_rbd_percobaan" value="<?= HtmlEncode($Grid->ket_rbd_percobaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <td data-name="rbd_keinginan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan">
<template id="tp_x<?= $Grid->RowIndex ?>_rbd_keinginan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" name="x<?= $Grid->RowIndex ?>_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_rbd_keinginan"<?= $Grid->rbd_keinginan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rbd_keinginan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rbd_keinginan"
    name="x<?= $Grid->RowIndex ?>_rbd_keinginan"
    value="<?= HtmlEncode($Grid->rbd_keinginan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rbd_keinginan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rbd_keinginan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rbd_keinginan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_keinginan"
    data-value-separator="<?= $Grid->rbd_keinginan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rbd_keinginan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rbd_keinginan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan">
<span<?= $Grid->rbd_keinginan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rbd_keinginan->getDisplayValue($Grid->rbd_keinginan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_rbd_keinginan" value="<?= HtmlEncode($Grid->rbd_keinginan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rbd_keinginan" id="o<?= $Grid->RowIndex ?>_rbd_keinginan" value="<?= HtmlEncode($Grid->rbd_keinginan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <td data-name="ket_rbd_keinginan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan">
<input type="<?= $Grid->ket_rbd_keinginan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" name="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_rbd_keinginan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rbd_keinginan->EditValue ?>"<?= $Grid->ket_rbd_keinginan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rbd_keinginan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan">
<span<?= $Grid->ket_rbd_keinginan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rbd_keinginan->getDisplayValue($Grid->ket_rbd_keinginan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="x<?= $Grid->RowIndex ?>_ket_rbd_keinginan" value="<?= HtmlEncode($Grid->ket_rbd_keinginan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rbd_keinginan" id="o<?= $Grid->RowIndex ?>_ket_rbd_keinginan" value="<?= HtmlEncode($Grid->ket_rbd_keinginan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <td data-name="rpo_penggunaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan"<?= $Grid->rpo_penggunaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    name="x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    value="<?= HtmlEncode($Grid->rpo_penggunaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_penggunaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan"
    data-value-separator="<?= $Grid->rpo_penggunaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_penggunaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan">
<span<?= $Grid->rpo_penggunaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rpo_penggunaan->getDisplayValue($Grid->rpo_penggunaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan" value="<?= HtmlEncode($Grid->rpo_penggunaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_penggunaan" id="o<?= $Grid->RowIndex ?>_rpo_penggunaan" value="<?= HtmlEncode($Grid->rpo_penggunaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <td data-name="ket_rpo_penggunaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan">
<input type="<?= $Grid->ket_rpo_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" name="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_rpo_penggunaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_penggunaan->EditValue ?>"<?= $Grid->ket_rpo_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_penggunaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan">
<span<?= $Grid->ket_rpo_penggunaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rpo_penggunaan->getDisplayValue($Grid->ket_rpo_penggunaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" value="<?= HtmlEncode($Grid->ket_rpo_penggunaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" id="o<?= $Grid->RowIndex ?>_ket_rpo_penggunaan" value="<?= HtmlEncode($Grid->ket_rpo_penggunaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <td data-name="rpo_efek_samping">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_efek_samping">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" name="x<?= $Grid->RowIndex ?>_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_rpo_efek_samping"<?= $Grid->rpo_efek_samping->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_efek_samping" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    name="x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    value="<?= HtmlEncode($Grid->rpo_efek_samping->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_efek_samping"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_efek_samping->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_efek_samping"
    data-value-separator="<?= $Grid->rpo_efek_samping->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_efek_samping->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_efek_samping->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping">
<span<?= $Grid->rpo_efek_samping->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rpo_efek_samping->getDisplayValue($Grid->rpo_efek_samping->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_rpo_efek_samping" value="<?= HtmlEncode($Grid->rpo_efek_samping->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_efek_samping" id="o<?= $Grid->RowIndex ?>_rpo_efek_samping" value="<?= HtmlEncode($Grid->rpo_efek_samping->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <td data-name="ket_rpo_efek_samping">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping">
<input type="<?= $Grid->ket_rpo_efek_samping->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" name="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_rpo_efek_samping->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_efek_samping->EditValue ?>"<?= $Grid->ket_rpo_efek_samping->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_efek_samping->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping">
<span<?= $Grid->ket_rpo_efek_samping->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rpo_efek_samping->getDisplayValue($Grid->ket_rpo_efek_samping->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="x<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" value="<?= HtmlEncode($Grid->ket_rpo_efek_samping->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" id="o<?= $Grid->RowIndex ?>_ket_rpo_efek_samping" value="<?= HtmlEncode($Grid->ket_rpo_efek_samping->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rpo_napza->Visible) { // rpo_napza ?>
        <td data-name="rpo_napza">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_napza">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" name="x<?= $Grid->RowIndex ?>_rpo_napza" id="x<?= $Grid->RowIndex ?>_rpo_napza"<?= $Grid->rpo_napza->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_napza" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_napza"
    name="x<?= $Grid->RowIndex ?>_rpo_napza"
    value="<?= HtmlEncode($Grid->rpo_napza->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_napza"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_napza"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_napza->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_napza"
    data-value-separator="<?= $Grid->rpo_napza->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_napza->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_napza->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza">
<span<?= $Grid->rpo_napza->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rpo_napza->getDisplayValue($Grid->rpo_napza->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rpo_napza" id="x<?= $Grid->RowIndex ?>_rpo_napza" value="<?= HtmlEncode($Grid->rpo_napza->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_napza" id="o<?= $Grid->RowIndex ?>_rpo_napza" value="<?= HtmlEncode($Grid->rpo_napza->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <td data-name="ket_rpo_napza">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza">
<input type="<?= $Grid->ket_rpo_napza->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" name="x<?= $Grid->RowIndex ?>_ket_rpo_napza" id="x<?= $Grid->RowIndex ?>_ket_rpo_napza" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_rpo_napza->getPlaceHolder()) ?>" value="<?= $Grid->ket_rpo_napza->EditValue ?>"<?= $Grid->ket_rpo_napza->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_rpo_napza->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza">
<span<?= $Grid->ket_rpo_napza->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_rpo_napza->getDisplayValue($Grid->ket_rpo_napza->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_rpo_napza" id="x<?= $Grid->RowIndex ?>_ket_rpo_napza" value="<?= HtmlEncode($Grid->ket_rpo_napza->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_rpo_napza" id="o<?= $Grid->RowIndex ?>_ket_rpo_napza" value="<?= HtmlEncode($Grid->ket_rpo_napza->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <td data-name="ket_lama_pemakaian">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian">
<input type="<?= $Grid->ket_lama_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->ket_lama_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_lama_pemakaian->EditValue ?>"<?= $Grid->ket_lama_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lama_pemakaian->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian">
<span<?= $Grid->ket_lama_pemakaian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_lama_pemakaian->getDisplayValue($Grid->ket_lama_pemakaian->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_lama_pemakaian" value="<?= HtmlEncode($Grid->ket_lama_pemakaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_lama_pemakaian" id="o<?= $Grid->RowIndex ?>_ket_lama_pemakaian" value="<?= HtmlEncode($Grid->ket_lama_pemakaian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <td data-name="ket_cara_pemakaian">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian">
<input type="<?= $Grid->ket_cara_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_cara_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_cara_pemakaian->EditValue ?>"<?= $Grid->ket_cara_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_cara_pemakaian->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian">
<span<?= $Grid->ket_cara_pemakaian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_cara_pemakaian->getDisplayValue($Grid->ket_cara_pemakaian->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_cara_pemakaian" value="<?= HtmlEncode($Grid->ket_cara_pemakaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_cara_pemakaian" id="o<?= $Grid->RowIndex ?>_ket_cara_pemakaian" value="<?= HtmlEncode($Grid->ket_cara_pemakaian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <td data-name="ket_latar_belakang_pemakaian">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian">
<input type="<?= $Grid->ket_latar_belakang_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" name="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" size="30" maxlength="60" placeholder="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->getPlaceHolder()) ?>" value="<?= $Grid->ket_latar_belakang_pemakaian->EditValue ?>"<?= $Grid->ket_latar_belakang_pemakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_latar_belakang_pemakaian->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian">
<span<?= $Grid->ket_latar_belakang_pemakaian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_latar_belakang_pemakaian->getDisplayValue($Grid->ket_latar_belakang_pemakaian->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="x<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" value="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" id="o<?= $Grid->RowIndex ?>_ket_latar_belakang_pemakaian" value="<?= HtmlEncode($Grid->ket_latar_belakang_pemakaian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <td data-name="rpo_penggunaan_obat_lainnya">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"<?= $Grid->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    name="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_penggunaan_obat_lainnya->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan_obat_lainnya"
    data-value-separator="<?= $Grid->rpo_penggunaan_obat_lainnya->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya">
<span<?= $Grid->rpo_penggunaan_obat_lainnya->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rpo_penggunaan_obat_lainnya->getDisplayValue($Grid->rpo_penggunaan_obat_lainnya->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" id="o<?= $Grid->RowIndex ?>_rpo_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->rpo_penggunaan_obat_lainnya->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <td data-name="ket_penggunaan_obat_lainnya">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya">
<input type="<?= $Grid->ket_penggunaan_obat_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" name="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_penggunaan_obat_lainnya->EditValue ?>"<?= $Grid->ket_penggunaan_obat_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya">
<span<?= $Grid->ket_penggunaan_obat_lainnya->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_penggunaan_obat_lainnya->getDisplayValue($Grid->ket_penggunaan_obat_lainnya->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="x<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" id="o<?= $Grid->RowIndex ?>_ket_penggunaan_obat_lainnya" value="<?= HtmlEncode($Grid->ket_penggunaan_obat_lainnya->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <td data-name="ket_alasan_penggunaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan">
<input type="<?= $Grid->ket_alasan_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" name="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" size="30" maxlength="65" placeholder="<?= HtmlEncode($Grid->ket_alasan_penggunaan->getPlaceHolder()) ?>" value="<?= $Grid->ket_alasan_penggunaan->EditValue ?>"<?= $Grid->ket_alasan_penggunaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_alasan_penggunaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan">
<span<?= $Grid->ket_alasan_penggunaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_alasan_penggunaan->getDisplayValue($Grid->ket_alasan_penggunaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="x<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" value="<?= HtmlEncode($Grid->ket_alasan_penggunaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" id="o<?= $Grid->RowIndex ?>_ket_alasan_penggunaan" value="<?= HtmlEncode($Grid->ket_alasan_penggunaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <td data-name="rpo_alergi_obat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_alergi_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" name="x<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"<?= $Grid->rpo_alergi_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_alergi_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    name="x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    value="<?= HtmlEncode($Grid->rpo_alergi_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_alergi_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_alergi_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_alergi_obat"
    data-value-separator="<?= $Grid->rpo_alergi_obat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_alergi_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_alergi_obat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat">
<span<?= $Grid->rpo_alergi_obat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rpo_alergi_obat->getDisplayValue($Grid->rpo_alergi_obat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="x<?= $Grid->RowIndex ?>_rpo_alergi_obat" value="<?= HtmlEncode($Grid->rpo_alergi_obat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_alergi_obat" id="o<?= $Grid->RowIndex ?>_rpo_alergi_obat" value="<?= HtmlEncode($Grid->rpo_alergi_obat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <td data-name="ket_alergi_obat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat">
<input type="<?= $Grid->ket_alergi_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" name="x<?= $Grid->RowIndex ?>_ket_alergi_obat" id="x<?= $Grid->RowIndex ?>_ket_alergi_obat" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_alergi_obat->getPlaceHolder()) ?>" value="<?= $Grid->ket_alergi_obat->EditValue ?>"<?= $Grid->ket_alergi_obat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_alergi_obat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat">
<span<?= $Grid->ket_alergi_obat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_alergi_obat->getDisplayValue($Grid->ket_alergi_obat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_alergi_obat" id="x<?= $Grid->RowIndex ?>_ket_alergi_obat" value="<?= HtmlEncode($Grid->ket_alergi_obat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_alergi_obat" id="o<?= $Grid->RowIndex ?>_ket_alergi_obat" value="<?= HtmlEncode($Grid->ket_alergi_obat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rpo_merokok->Visible) { // rpo_merokok ?>
        <td data-name="rpo_merokok">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_merokok">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" name="x<?= $Grid->RowIndex ?>_rpo_merokok" id="x<?= $Grid->RowIndex ?>_rpo_merokok"<?= $Grid->rpo_merokok->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_merokok" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_merokok"
    name="x<?= $Grid->RowIndex ?>_rpo_merokok"
    value="<?= HtmlEncode($Grid->rpo_merokok->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_merokok"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_merokok"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_merokok->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_merokok"
    data-value-separator="<?= $Grid->rpo_merokok->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_merokok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_merokok->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok">
<span<?= $Grid->rpo_merokok->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rpo_merokok->getDisplayValue($Grid->rpo_merokok->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rpo_merokok" id="x<?= $Grid->RowIndex ?>_rpo_merokok" value="<?= HtmlEncode($Grid->rpo_merokok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_merokok" id="o<?= $Grid->RowIndex ?>_rpo_merokok" value="<?= HtmlEncode($Grid->rpo_merokok->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_merokok->Visible) { // ket_merokok ?>
        <td data-name="ket_merokok">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok">
<input type="<?= $Grid->ket_merokok->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" name="x<?= $Grid->RowIndex ?>_ket_merokok" id="x<?= $Grid->RowIndex ?>_ket_merokok" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_merokok->getPlaceHolder()) ?>" value="<?= $Grid->ket_merokok->EditValue ?>"<?= $Grid->ket_merokok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_merokok->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok">
<span<?= $Grid->ket_merokok->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_merokok->getDisplayValue($Grid->ket_merokok->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_merokok" id="x<?= $Grid->RowIndex ?>_ket_merokok" value="<?= HtmlEncode($Grid->ket_merokok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_merokok" id="o<?= $Grid->RowIndex ?>_ket_merokok" value="<?= HtmlEncode($Grid->ket_merokok->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <td data-name="rpo_minum_kopi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi">
<template id="tp_x<?= $Grid->RowIndex ?>_rpo_minum_kopi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" name="x<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"<?= $Grid->rpo_minum_kopi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rpo_minum_kopi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    name="x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    value="<?= HtmlEncode($Grid->rpo_minum_kopi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rpo_minum_kopi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rpo_minum_kopi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_minum_kopi"
    data-value-separator="<?= $Grid->rpo_minum_kopi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rpo_minum_kopi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rpo_minum_kopi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi">
<span<?= $Grid->rpo_minum_kopi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rpo_minum_kopi->getDisplayValue($Grid->rpo_minum_kopi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="x<?= $Grid->RowIndex ?>_rpo_minum_kopi" value="<?= HtmlEncode($Grid->rpo_minum_kopi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rpo_minum_kopi" id="o<?= $Grid->RowIndex ?>_rpo_minum_kopi" value="<?= HtmlEncode($Grid->rpo_minum_kopi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <td data-name="ket_minum_kopi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi">
<input type="<?= $Grid->ket_minum_kopi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" name="x<?= $Grid->RowIndex ?>_ket_minum_kopi" id="x<?= $Grid->RowIndex ?>_ket_minum_kopi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->ket_minum_kopi->getPlaceHolder()) ?>" value="<?= $Grid->ket_minum_kopi->EditValue ?>"<?= $Grid->ket_minum_kopi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_minum_kopi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi">
<span<?= $Grid->ket_minum_kopi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_minum_kopi->getDisplayValue($Grid->ket_minum_kopi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_minum_kopi" id="x<?= $Grid->RowIndex ?>_ket_minum_kopi" value="<?= HtmlEncode($Grid->ket_minum_kopi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_minum_kopi" id="o<?= $Grid->RowIndex ?>_ket_minum_kopi" value="<?= HtmlEncode($Grid->ket_minum_kopi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->td->Visible) { // td ?>
        <td data-name="td">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_td" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_td">
<input type="<?= $Grid->td->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->td->getPlaceHolder()) ?>" value="<?= $Grid->td->EditValue ?>"<?= $Grid->td->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->td->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_td" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_td">
<span<?= $Grid->td->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->td->getDisplayValue($Grid->td->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" data-hidden="1" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" data-hidden="1" name="o<?= $Grid->RowIndex ?>_td" id="o<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nadi->Visible) { // nadi ?>
        <td data-name="nadi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nadi">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nadi">
<span<?= $Grid->nadi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nadi->getDisplayValue($Grid->nadi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nadi" id="o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->gcs->Visible) { // gcs ?>
        <td data-name="gcs">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_gcs">
<input type="<?= $Grid->gcs->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->gcs->getPlaceHolder()) ?>" value="<?= $Grid->gcs->EditValue ?>"<?= $Grid->gcs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gcs->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_gcs">
<span<?= $Grid->gcs->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->gcs->getDisplayValue($Grid->gcs->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" data-hidden="1" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gcs" id="o<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rr->Visible) { // rr ?>
        <td data-name="rr">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rr">
<input type="<?= $Grid->rr->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->rr->getPlaceHolder()) ?>" value="<?= $Grid->rr->EditValue ?>"<?= $Grid->rr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rr->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rr">
<span<?= $Grid->rr->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rr->getDisplayValue($Grid->rr->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rr" id="o<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->suhu->Visible) { // suhu ?>
        <td data-name="suhu">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_suhu">
<input type="<?= $Grid->suhu->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu->getPlaceHolder()) ?>" value="<?= $Grid->suhu->EditValue ?>"<?= $Grid->suhu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_suhu">
<span<?= $Grid->suhu->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->suhu->getDisplayValue($Grid->suhu->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" data-hidden="1" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" data-hidden="1" name="o<?= $Grid->RowIndex ?>_suhu" id="o<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <td data-name="pf_keluhan_fisik">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik">
<template id="tp_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" name="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"<?= $Grid->pf_keluhan_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    name="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    value="<?= HtmlEncode($Grid->pf_keluhan_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pf_keluhan_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pf_keluhan_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pf_keluhan_fisik"
    data-value-separator="<?= $Grid->pf_keluhan_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pf_keluhan_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pf_keluhan_fisik->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik">
<span<?= $Grid->pf_keluhan_fisik->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pf_keluhan_fisik->getDisplayValue($Grid->pf_keluhan_fisik->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_pf_keluhan_fisik" value="<?= HtmlEncode($Grid->pf_keluhan_fisik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pf_keluhan_fisik" id="o<?= $Grid->RowIndex ?>_pf_keluhan_fisik" value="<?= HtmlEncode($Grid->pf_keluhan_fisik->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <td data-name="ket_keluhan_fisik">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik">
<input type="<?= $Grid->ket_keluhan_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" name="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_keluhan_fisik->getPlaceHolder()) ?>" value="<?= $Grid->ket_keluhan_fisik->EditValue ?>"<?= $Grid->ket_keluhan_fisik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_keluhan_fisik->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik">
<span<?= $Grid->ket_keluhan_fisik->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_keluhan_fisik->getDisplayValue($Grid->ket_keluhan_fisik->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="x<?= $Grid->RowIndex ?>_ket_keluhan_fisik" value="<?= HtmlEncode($Grid->ket_keluhan_fisik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_keluhan_fisik" id="o<?= $Grid->RowIndex ?>_ket_keluhan_fisik" value="<?= HtmlEncode($Grid->ket_keluhan_fisik->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->skala_nyeri->Visible) { // skala_nyeri ?>
        <td data-name="skala_nyeri">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri">
<template id="tp_x<?= $Grid->RowIndex ?>_skala_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" name="x<?= $Grid->RowIndex ?>_skala_nyeri" id="x<?= $Grid->RowIndex ?>_skala_nyeri"<?= $Grid->skala_nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_skala_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_skala_nyeri"
    name="x<?= $Grid->RowIndex ?>_skala_nyeri"
    value="<?= HtmlEncode($Grid->skala_nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_skala_nyeri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_skala_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->skala_nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_skala_nyeri"
    data-value-separator="<?= $Grid->skala_nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->skala_nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->skala_nyeri->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri">
<span<?= $Grid->skala_nyeri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->skala_nyeri->getDisplayValue($Grid->skala_nyeri->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" data-hidden="1" name="x<?= $Grid->RowIndex ?>_skala_nyeri" id="x<?= $Grid->RowIndex ?>_skala_nyeri" value="<?= HtmlEncode($Grid->skala_nyeri->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_skala_nyeri" id="o<?= $Grid->RowIndex ?>_skala_nyeri" value="<?= HtmlEncode($Grid->skala_nyeri->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->durasi->Visible) { // durasi ?>
        <td data-name="durasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_durasi">
<input type="<?= $Grid->durasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" name="x<?= $Grid->RowIndex ?>_durasi" id="x<?= $Grid->RowIndex ?>_durasi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->durasi->getPlaceHolder()) ?>" value="<?= $Grid->durasi->EditValue ?>"<?= $Grid->durasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->durasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_durasi">
<span<?= $Grid->durasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->durasi->getDisplayValue($Grid->durasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_durasi" id="x<?= $Grid->RowIndex ?>_durasi" value="<?= HtmlEncode($Grid->durasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_durasi" id="o<?= $Grid->RowIndex ?>_durasi" value="<?= HtmlEncode($Grid->durasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nyeri->Visible) { // nyeri ?>
        <td data-name="nyeri">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nyeri">
<template id="tp_x<?= $Grid->RowIndex ?>_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" name="x<?= $Grid->RowIndex ?>_nyeri" id="x<?= $Grid->RowIndex ?>_nyeri"<?= $Grid->nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nyeri"
    name="x<?= $Grid->RowIndex ?>_nyeri"
    value="<?= HtmlEncode($Grid->nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nyeri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri"
    data-value-separator="<?= $Grid->nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nyeri->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nyeri">
<span<?= $Grid->nyeri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nyeri->getDisplayValue($Grid->nyeri->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nyeri" id="x<?= $Grid->RowIndex ?>_nyeri" value="<?= HtmlEncode($Grid->nyeri->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nyeri" id="o<?= $Grid->RowIndex ?>_nyeri" value="<?= HtmlEncode($Grid->nyeri->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->provokes->Visible) { // provokes ?>
        <td data-name="provokes">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_provokes">
<template id="tp_x<?= $Grid->RowIndex ?>_provokes">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" name="x<?= $Grid->RowIndex ?>_provokes" id="x<?= $Grid->RowIndex ?>_provokes"<?= $Grid->provokes->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_provokes" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_provokes"
    name="x<?= $Grid->RowIndex ?>_provokes"
    value="<?= HtmlEncode($Grid->provokes->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_provokes"
    data-target="dsl_x<?= $Grid->RowIndex ?>_provokes"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->provokes->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_provokes"
    data-value-separator="<?= $Grid->provokes->displayValueSeparatorAttribute() ?>"
    <?= $Grid->provokes->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->provokes->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_provokes">
<span<?= $Grid->provokes->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->provokes->getDisplayValue($Grid->provokes->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" data-hidden="1" name="x<?= $Grid->RowIndex ?>_provokes" id="x<?= $Grid->RowIndex ?>_provokes" value="<?= HtmlEncode($Grid->provokes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" data-hidden="1" name="o<?= $Grid->RowIndex ?>_provokes" id="o<?= $Grid->RowIndex ?>_provokes" value="<?= HtmlEncode($Grid->provokes->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_provokes->Visible) { // ket_provokes ?>
        <td data-name="ket_provokes">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes">
<input type="<?= $Grid->ket_provokes->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" name="x<?= $Grid->RowIndex ?>_ket_provokes" id="x<?= $Grid->RowIndex ?>_ket_provokes" size="30" maxlength="40" placeholder="<?= HtmlEncode($Grid->ket_provokes->getPlaceHolder()) ?>" value="<?= $Grid->ket_provokes->EditValue ?>"<?= $Grid->ket_provokes->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_provokes->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes">
<span<?= $Grid->ket_provokes->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_provokes->getDisplayValue($Grid->ket_provokes->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_provokes" id="x<?= $Grid->RowIndex ?>_ket_provokes" value="<?= HtmlEncode($Grid->ket_provokes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_provokes" id="o<?= $Grid->RowIndex ?>_ket_provokes" value="<?= HtmlEncode($Grid->ket_provokes->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->quality->Visible) { // quality ?>
        <td data-name="quality">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_quality">
<template id="tp_x<?= $Grid->RowIndex ?>_quality">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" name="x<?= $Grid->RowIndex ?>_quality" id="x<?= $Grid->RowIndex ?>_quality"<?= $Grid->quality->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_quality" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_quality"
    name="x<?= $Grid->RowIndex ?>_quality"
    value="<?= HtmlEncode($Grid->quality->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_quality"
    data-target="dsl_x<?= $Grid->RowIndex ?>_quality"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->quality->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_quality"
    data-value-separator="<?= $Grid->quality->displayValueSeparatorAttribute() ?>"
    <?= $Grid->quality->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quality->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_quality">
<span<?= $Grid->quality->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->quality->getDisplayValue($Grid->quality->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" data-hidden="1" name="x<?= $Grid->RowIndex ?>_quality" id="x<?= $Grid->RowIndex ?>_quality" value="<?= HtmlEncode($Grid->quality->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" data-hidden="1" name="o<?= $Grid->RowIndex ?>_quality" id="o<?= $Grid->RowIndex ?>_quality" value="<?= HtmlEncode($Grid->quality->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_quality->Visible) { // ket_quality ?>
        <td data-name="ket_quality">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_quality">
<input type="<?= $Grid->ket_quality->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" name="x<?= $Grid->RowIndex ?>_ket_quality" id="x<?= $Grid->RowIndex ?>_ket_quality" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_quality->getPlaceHolder()) ?>" value="<?= $Grid->ket_quality->EditValue ?>"<?= $Grid->ket_quality->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_quality->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_quality">
<span<?= $Grid->ket_quality->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_quality->getDisplayValue($Grid->ket_quality->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_quality" id="x<?= $Grid->RowIndex ?>_ket_quality" value="<?= HtmlEncode($Grid->ket_quality->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_quality" id="o<?= $Grid->RowIndex ?>_ket_quality" value="<?= HtmlEncode($Grid->ket_quality->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->lokasi->Visible) { // lokasi ?>
        <td data-name="lokasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_lokasi">
<input type="<?= $Grid->lokasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" name="x<?= $Grid->RowIndex ?>_lokasi" id="x<?= $Grid->RowIndex ?>_lokasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->lokasi->getPlaceHolder()) ?>" value="<?= $Grid->lokasi->EditValue ?>"<?= $Grid->lokasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lokasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_lokasi">
<span<?= $Grid->lokasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lokasi->getDisplayValue($Grid->lokasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_lokasi" id="x<?= $Grid->RowIndex ?>_lokasi" value="<?= HtmlEncode($Grid->lokasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lokasi" id="o<?= $Grid->RowIndex ?>_lokasi" value="<?= HtmlEncode($Grid->lokasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->menyebar->Visible) { // menyebar ?>
        <td data-name="menyebar">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_menyebar">
<template id="tp_x<?= $Grid->RowIndex ?>_menyebar">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" name="x<?= $Grid->RowIndex ?>_menyebar" id="x<?= $Grid->RowIndex ?>_menyebar"<?= $Grid->menyebar->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_menyebar" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_menyebar"
    name="x<?= $Grid->RowIndex ?>_menyebar"
    value="<?= HtmlEncode($Grid->menyebar->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_menyebar"
    data-target="dsl_x<?= $Grid->RowIndex ?>_menyebar"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->menyebar->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_menyebar"
    data-value-separator="<?= $Grid->menyebar->displayValueSeparatorAttribute() ?>"
    <?= $Grid->menyebar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->menyebar->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_menyebar">
<span<?= $Grid->menyebar->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->menyebar->getDisplayValue($Grid->menyebar->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" data-hidden="1" name="x<?= $Grid->RowIndex ?>_menyebar" id="x<?= $Grid->RowIndex ?>_menyebar" value="<?= HtmlEncode($Grid->menyebar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_menyebar" id="o<?= $Grid->RowIndex ?>_menyebar" value="<?= HtmlEncode($Grid->menyebar->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->pada_dokter->Visible) { // pada_dokter ?>
        <td data-name="pada_dokter">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter">
<template id="tp_x<?= $Grid->RowIndex ?>_pada_dokter">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" name="x<?= $Grid->RowIndex ?>_pada_dokter" id="x<?= $Grid->RowIndex ?>_pada_dokter"<?= $Grid->pada_dokter->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pada_dokter" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pada_dokter"
    name="x<?= $Grid->RowIndex ?>_pada_dokter"
    value="<?= HtmlEncode($Grid->pada_dokter->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pada_dokter"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pada_dokter"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pada_dokter->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pada_dokter"
    data-value-separator="<?= $Grid->pada_dokter->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pada_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pada_dokter->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter">
<span<?= $Grid->pada_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pada_dokter->getDisplayValue($Grid->pada_dokter->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pada_dokter" id="x<?= $Grid->RowIndex ?>_pada_dokter" value="<?= HtmlEncode($Grid->pada_dokter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pada_dokter" id="o<?= $Grid->RowIndex ?>_pada_dokter" value="<?= HtmlEncode($Grid->pada_dokter->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_dokter->Visible) { // ket_dokter ?>
        <td data-name="ket_dokter">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter">
<input type="<?= $Grid->ket_dokter->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" name="x<?= $Grid->RowIndex ?>_ket_dokter" id="x<?= $Grid->RowIndex ?>_ket_dokter" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_dokter->getPlaceHolder()) ?>" value="<?= $Grid->ket_dokter->EditValue ?>"<?= $Grid->ket_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_dokter->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter">
<span<?= $Grid->ket_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_dokter->getDisplayValue($Grid->ket_dokter->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_dokter" id="x<?= $Grid->RowIndex ?>_ket_dokter" value="<?= HtmlEncode($Grid->ket_dokter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_dokter" id="o<?= $Grid->RowIndex ?>_ket_dokter" value="<?= HtmlEncode($Grid->ket_dokter->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <td data-name="nyeri_hilang">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang">
<template id="tp_x<?= $Grid->RowIndex ?>_nyeri_hilang">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" name="x<?= $Grid->RowIndex ?>_nyeri_hilang" id="x<?= $Grid->RowIndex ?>_nyeri_hilang"<?= $Grid->nyeri_hilang->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nyeri_hilang" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nyeri_hilang"
    name="x<?= $Grid->RowIndex ?>_nyeri_hilang"
    value="<?= HtmlEncode($Grid->nyeri_hilang->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nyeri_hilang"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nyeri_hilang"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nyeri_hilang->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri_hilang"
    data-value-separator="<?= $Grid->nyeri_hilang->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nyeri_hilang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nyeri_hilang->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang">
<span<?= $Grid->nyeri_hilang->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nyeri_hilang->getDisplayValue($Grid->nyeri_hilang->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nyeri_hilang" id="x<?= $Grid->RowIndex ?>_nyeri_hilang" value="<?= HtmlEncode($Grid->nyeri_hilang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nyeri_hilang" id="o<?= $Grid->RowIndex ?>_nyeri_hilang" value="<?= HtmlEncode($Grid->nyeri_hilang->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_nyeri->Visible) { // ket_nyeri ?>
        <td data-name="ket_nyeri">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri">
<input type="<?= $Grid->ket_nyeri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" name="x<?= $Grid->RowIndex ?>_ket_nyeri" id="x<?= $Grid->RowIndex ?>_ket_nyeri" size="30" maxlength="40" placeholder="<?= HtmlEncode($Grid->ket_nyeri->getPlaceHolder()) ?>" value="<?= $Grid->ket_nyeri->EditValue ?>"<?= $Grid->ket_nyeri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_nyeri->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri">
<span<?= $Grid->ket_nyeri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_nyeri->getDisplayValue($Grid->ket_nyeri->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_nyeri" id="x<?= $Grid->RowIndex ?>_ket_nyeri" value="<?= HtmlEncode($Grid->ket_nyeri->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_nyeri" id="o<?= $Grid->RowIndex ?>_ket_nyeri" value="<?= HtmlEncode($Grid->ket_nyeri->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->bb->Visible) { // bb ?>
        <td data-name="bb">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_bb">
<input type="<?= $Grid->bb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bb->getPlaceHolder()) ?>" value="<?= $Grid->bb->EditValue ?>"<?= $Grid->bb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bb->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_bb">
<span<?= $Grid->bb->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->bb->getDisplayValue($Grid->bb->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" data-hidden="1" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bb" id="o<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tb->Visible) { // tb ?>
        <td data-name="tb">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_tb">
<input type="<?= $Grid->tb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tb->getPlaceHolder()) ?>" value="<?= $Grid->tb->EditValue ?>"<?= $Grid->tb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tb->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_tb">
<span<?= $Grid->tb->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tb->getDisplayValue($Grid->tb->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tb" id="o<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->bmi->Visible) { // bmi ?>
        <td data-name="bmi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_bmi">
<input type="<?= $Grid->bmi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" name="x<?= $Grid->RowIndex ?>_bmi" id="x<?= $Grid->RowIndex ?>_bmi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bmi->getPlaceHolder()) ?>" value="<?= $Grid->bmi->EditValue ?>"<?= $Grid->bmi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bmi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_bmi">
<span<?= $Grid->bmi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->bmi->getDisplayValue($Grid->bmi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_bmi" id="x<?= $Grid->RowIndex ?>_bmi" value="<?= HtmlEncode($Grid->bmi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bmi" id="o<?= $Grid->RowIndex ?>_bmi" value="<?= HtmlEncode($Grid->bmi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <td data-name="lapor_status_nutrisi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi">
<template id="tp_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" name="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"<?= $Grid->lapor_status_nutrisi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    name="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    value="<?= HtmlEncode($Grid->lapor_status_nutrisi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_lapor_status_nutrisi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->lapor_status_nutrisi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor_status_nutrisi"
    data-value-separator="<?= $Grid->lapor_status_nutrisi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->lapor_status_nutrisi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi">
<span<?= $Grid->lapor_status_nutrisi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lapor_status_nutrisi->getDisplayValue($Grid->lapor_status_nutrisi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->lapor_status_nutrisi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lapor_status_nutrisi" id="o<?= $Grid->RowIndex ?>_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->lapor_status_nutrisi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <td data-name="ket_lapor_status_nutrisi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi">
<input type="<?= $Grid->ket_lapor_status_nutrisi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" name="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->getPlaceHolder()) ?>" value="<?= $Grid->ket_lapor_status_nutrisi->EditValue ?>"<?= $Grid->ket_lapor_status_nutrisi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi">
<span<?= $Grid->ket_lapor_status_nutrisi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_lapor_status_nutrisi->getDisplayValue($Grid->ket_lapor_status_nutrisi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="x<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" id="o<?= $Grid->RowIndex ?>_ket_lapor_status_nutrisi" value="<?= HtmlEncode($Grid->ket_lapor_status_nutrisi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sg1->Visible) { // sg1 ?>
        <td data-name="sg1">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sg1">
<template id="tp_x<?= $Grid->RowIndex ?>_sg1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" name="x<?= $Grid->RowIndex ?>_sg1" id="x<?= $Grid->RowIndex ?>_sg1"<?= $Grid->sg1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sg1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sg1"
    name="x<?= $Grid->RowIndex ?>_sg1"
    value="<?= HtmlEncode($Grid->sg1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sg1"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sg1"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sg1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg1"
    data-value-separator="<?= $Grid->sg1->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sg1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sg1->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sg1">
<span<?= $Grid->sg1->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sg1->getDisplayValue($Grid->sg1->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sg1" id="x<?= $Grid->RowIndex ?>_sg1" value="<?= HtmlEncode($Grid->sg1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sg1" id="o<?= $Grid->RowIndex ?>_sg1" value="<?= HtmlEncode($Grid->sg1->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nilai1->Visible) { // nilai1 ?>
        <td data-name="nilai1">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nilai1">
<template id="tp_x<?= $Grid->RowIndex ?>_nilai1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" name="x<?= $Grid->RowIndex ?>_nilai1" id="x<?= $Grid->RowIndex ?>_nilai1"<?= $Grid->nilai1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_nilai1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_nilai1"
    name="x<?= $Grid->RowIndex ?>_nilai1"
    value="<?= HtmlEncode($Grid->nilai1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_nilai1"
    data-target="dsl_x<?= $Grid->RowIndex ?>_nilai1"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->nilai1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nilai1"
    data-value-separator="<?= $Grid->nilai1->displayValueSeparatorAttribute() ?>"
    <?= $Grid->nilai1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nilai1->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nilai1">
<span<?= $Grid->nilai1->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nilai1->getDisplayValue($Grid->nilai1->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nilai1" id="x<?= $Grid->RowIndex ?>_nilai1" value="<?= HtmlEncode($Grid->nilai1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nilai1" id="o<?= $Grid->RowIndex ?>_nilai1" value="<?= HtmlEncode($Grid->nilai1->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sg2->Visible) { // sg2 ?>
        <td data-name="sg2">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sg2">
<template id="tp_x<?= $Grid->RowIndex ?>_sg2">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" name="x<?= $Grid->RowIndex ?>_sg2" id="x<?= $Grid->RowIndex ?>_sg2"<?= $Grid->sg2->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sg2" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sg2"
    name="x<?= $Grid->RowIndex ?>_sg2"
    value="<?= HtmlEncode($Grid->sg2->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sg2"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sg2"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sg2->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg2"
    data-value-separator="<?= $Grid->sg2->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sg2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sg2->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sg2">
<span<?= $Grid->sg2->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sg2->getDisplayValue($Grid->sg2->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sg2" id="x<?= $Grid->RowIndex ?>_sg2" value="<?= HtmlEncode($Grid->sg2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sg2" id="o<?= $Grid->RowIndex ?>_sg2" value="<?= HtmlEncode($Grid->sg2->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nilai2->Visible) { // nilai2 ?>
        <td data-name="nilai2">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nilai2">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->nilai2->isInvalidClass() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" name="x<?= $Grid->RowIndex ?>_nilai2[]" id="x<?= $Grid->RowIndex ?>_nilai2_669057" value="1"<?= ConvertToBool($Grid->nilai2->CurrentValue) ? " checked" : "" ?><?= $Grid->nilai2->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_nilai2_669057"></label>
</div>
<div class="invalid-feedback"><?= $Grid->nilai2->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nilai2">
<span<?= $Grid->nilai2->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_nilai2_<?= $Grid->RowCount ?>" class="custom-control-input" value="<?= $Grid->nilai2->ViewValue ?>" disabled<?php if (ConvertToBool($Grid->nilai2->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_nilai2_<?= $Grid->RowCount ?>"></label>
</div></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nilai2" id="x<?= $Grid->RowIndex ?>_nilai2" value="<?= HtmlEncode($Grid->nilai2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nilai2[]" id="o<?= $Grid->RowIndex ?>_nilai2[]" value="<?= HtmlEncode($Grid->nilai2->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->total_hasil->Visible) { // total_hasil ?>
        <td data-name="total_hasil">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_total_hasil">
<input type="<?= $Grid->total_hasil->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" name="x<?= $Grid->RowIndex ?>_total_hasil" id="x<?= $Grid->RowIndex ?>_total_hasil" size="30" placeholder="<?= HtmlEncode($Grid->total_hasil->getPlaceHolder()) ?>" value="<?= $Grid->total_hasil->EditValue ?>"<?= $Grid->total_hasil->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_hasil->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_total_hasil">
<span<?= $Grid->total_hasil->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->total_hasil->getDisplayValue($Grid->total_hasil->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" data-hidden="1" name="x<?= $Grid->RowIndex ?>_total_hasil" id="x<?= $Grid->RowIndex ?>_total_hasil" value="<?= HtmlEncode($Grid->total_hasil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" data-hidden="1" name="o<?= $Grid->RowIndex ?>_total_hasil" id="o<?= $Grid->RowIndex ?>_total_hasil" value="<?= HtmlEncode($Grid->total_hasil->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->resikojatuh->Visible) { // resikojatuh ?>
        <td data-name="resikojatuh">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh">
<template id="tp_x<?= $Grid->RowIndex ?>_resikojatuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" name="x<?= $Grid->RowIndex ?>_resikojatuh" id="x<?= $Grid->RowIndex ?>_resikojatuh"<?= $Grid->resikojatuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_resikojatuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_resikojatuh"
    name="x<?= $Grid->RowIndex ?>_resikojatuh"
    value="<?= HtmlEncode($Grid->resikojatuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_resikojatuh"
    data-target="dsl_x<?= $Grid->RowIndex ?>_resikojatuh"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->resikojatuh->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resikojatuh"
    data-value-separator="<?= $Grid->resikojatuh->displayValueSeparatorAttribute() ?>"
    <?= $Grid->resikojatuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->resikojatuh->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh">
<span<?= $Grid->resikojatuh->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->resikojatuh->getDisplayValue($Grid->resikojatuh->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" data-hidden="1" name="x<?= $Grid->RowIndex ?>_resikojatuh" id="x<?= $Grid->RowIndex ?>_resikojatuh" value="<?= HtmlEncode($Grid->resikojatuh->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" data-hidden="1" name="o<?= $Grid->RowIndex ?>_resikojatuh" id="o<?= $Grid->RowIndex ?>_resikojatuh" value="<?= HtmlEncode($Grid->resikojatuh->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->bjm->Visible) { // bjm ?>
        <td data-name="bjm">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_bjm">
<template id="tp_x<?= $Grid->RowIndex ?>_bjm">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" name="x<?= $Grid->RowIndex ?>_bjm" id="x<?= $Grid->RowIndex ?>_bjm"<?= $Grid->bjm->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_bjm" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_bjm"
    name="x<?= $Grid->RowIndex ?>_bjm"
    value="<?= HtmlEncode($Grid->bjm->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_bjm"
    data-target="dsl_x<?= $Grid->RowIndex ?>_bjm"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->bjm->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_bjm"
    data-value-separator="<?= $Grid->bjm->displayValueSeparatorAttribute() ?>"
    <?= $Grid->bjm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bjm->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_bjm">
<span<?= $Grid->bjm->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->bjm->getDisplayValue($Grid->bjm->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" data-hidden="1" name="x<?= $Grid->RowIndex ?>_bjm" id="x<?= $Grid->RowIndex ?>_bjm" value="<?= HtmlEncode($Grid->bjm->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bjm" id="o<?= $Grid->RowIndex ?>_bjm" value="<?= HtmlEncode($Grid->bjm->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->msa->Visible) { // msa ?>
        <td data-name="msa">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_msa">
<template id="tp_x<?= $Grid->RowIndex ?>_msa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" name="x<?= $Grid->RowIndex ?>_msa" id="x<?= $Grid->RowIndex ?>_msa"<?= $Grid->msa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_msa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_msa"
    name="x<?= $Grid->RowIndex ?>_msa"
    value="<?= HtmlEncode($Grid->msa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_msa"
    data-target="dsl_x<?= $Grid->RowIndex ?>_msa"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->msa->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_msa"
    data-value-separator="<?= $Grid->msa->displayValueSeparatorAttribute() ?>"
    <?= $Grid->msa->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->msa->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_msa">
<span<?= $Grid->msa->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->msa->getDisplayValue($Grid->msa->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" data-hidden="1" name="x<?= $Grid->RowIndex ?>_msa" id="x<?= $Grid->RowIndex ?>_msa" value="<?= HtmlEncode($Grid->msa->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" data-hidden="1" name="o<?= $Grid->RowIndex ?>_msa" id="o<?= $Grid->RowIndex ?>_msa" value="<?= HtmlEncode($Grid->msa->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->hasil->Visible) { // hasil ?>
        <td data-name="hasil">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_hasil">
<template id="tp_x<?= $Grid->RowIndex ?>_hasil">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" name="x<?= $Grid->RowIndex ?>_hasil" id="x<?= $Grid->RowIndex ?>_hasil"<?= $Grid->hasil->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_hasil" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_hasil"
    name="x<?= $Grid->RowIndex ?>_hasil"
    value="<?= HtmlEncode($Grid->hasil->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_hasil"
    data-target="dsl_x<?= $Grid->RowIndex ?>_hasil"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->hasil->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_hasil"
    data-value-separator="<?= $Grid->hasil->displayValueSeparatorAttribute() ?>"
    <?= $Grid->hasil->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_hasil">
<span<?= $Grid->hasil->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->hasil->getDisplayValue($Grid->hasil->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" data-hidden="1" name="x<?= $Grid->RowIndex ?>_hasil" id="x<?= $Grid->RowIndex ?>_hasil" value="<?= HtmlEncode($Grid->hasil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hasil" id="o<?= $Grid->RowIndex ?>_hasil" value="<?= HtmlEncode($Grid->hasil->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->lapor->Visible) { // lapor ?>
        <td data-name="lapor">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_lapor">
<template id="tp_x<?= $Grid->RowIndex ?>_lapor">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" name="x<?= $Grid->RowIndex ?>_lapor" id="x<?= $Grid->RowIndex ?>_lapor"<?= $Grid->lapor->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_lapor" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_lapor"
    name="x<?= $Grid->RowIndex ?>_lapor"
    value="<?= HtmlEncode($Grid->lapor->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_lapor"
    data-target="dsl_x<?= $Grid->RowIndex ?>_lapor"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->lapor->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor"
    data-value-separator="<?= $Grid->lapor->displayValueSeparatorAttribute() ?>"
    <?= $Grid->lapor->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lapor->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_lapor">
<span<?= $Grid->lapor->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lapor->getDisplayValue($Grid->lapor->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" data-hidden="1" name="x<?= $Grid->RowIndex ?>_lapor" id="x<?= $Grid->RowIndex ?>_lapor" value="<?= HtmlEncode($Grid->lapor->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lapor" id="o<?= $Grid->RowIndex ?>_lapor" value="<?= HtmlEncode($Grid->lapor->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_lapor->Visible) { // ket_lapor ?>
        <td data-name="ket_lapor">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor">
<input type="<?= $Grid->ket_lapor->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" name="x<?= $Grid->RowIndex ?>_ket_lapor" id="x<?= $Grid->RowIndex ?>_ket_lapor" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->ket_lapor->getPlaceHolder()) ?>" value="<?= $Grid->ket_lapor->EditValue ?>"<?= $Grid->ket_lapor->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_lapor->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor">
<span<?= $Grid->ket_lapor->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_lapor->getDisplayValue($Grid->ket_lapor->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_lapor" id="x<?= $Grid->RowIndex ?>_ket_lapor" value="<?= HtmlEncode($Grid->ket_lapor->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_lapor" id="o<?= $Grid->RowIndex ?>_ket_lapor" value="<?= HtmlEncode($Grid->ket_lapor->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_mandi->Visible) { // adl_mandi ?>
        <td data-name="adl_mandi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_mandi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" name="x<?= $Grid->RowIndex ?>_adl_mandi" id="x<?= $Grid->RowIndex ?>_adl_mandi"<?= $Grid->adl_mandi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_mandi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_mandi"
    name="x<?= $Grid->RowIndex ?>_adl_mandi"
    value="<?= HtmlEncode($Grid->adl_mandi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_mandi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_mandi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_mandi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_mandi"
    data-value-separator="<?= $Grid->adl_mandi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_mandi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_mandi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi">
<span<?= $Grid->adl_mandi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_mandi->getDisplayValue($Grid->adl_mandi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_mandi" id="x<?= $Grid->RowIndex ?>_adl_mandi" value="<?= HtmlEncode($Grid->adl_mandi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_mandi" id="o<?= $Grid->RowIndex ?>_adl_mandi" value="<?= HtmlEncode($Grid->adl_mandi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <td data-name="adl_berpakaian">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_berpakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" name="x<?= $Grid->RowIndex ?>_adl_berpakaian" id="x<?= $Grid->RowIndex ?>_adl_berpakaian"<?= $Grid->adl_berpakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_berpakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_berpakaian"
    name="x<?= $Grid->RowIndex ?>_adl_berpakaian"
    value="<?= HtmlEncode($Grid->adl_berpakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_berpakaian"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_berpakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_berpakaian->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_berpakaian"
    data-value-separator="<?= $Grid->adl_berpakaian->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_berpakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_berpakaian->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian">
<span<?= $Grid->adl_berpakaian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_berpakaian->getDisplayValue($Grid->adl_berpakaian->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_berpakaian" id="x<?= $Grid->RowIndex ?>_adl_berpakaian" value="<?= HtmlEncode($Grid->adl_berpakaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_berpakaian" id="o<?= $Grid->RowIndex ?>_adl_berpakaian" value="<?= HtmlEncode($Grid->adl_berpakaian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_makan->Visible) { // adl_makan ?>
        <td data-name="adl_makan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_makan">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_makan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" name="x<?= $Grid->RowIndex ?>_adl_makan" id="x<?= $Grid->RowIndex ?>_adl_makan"<?= $Grid->adl_makan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_makan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_makan"
    name="x<?= $Grid->RowIndex ?>_adl_makan"
    value="<?= HtmlEncode($Grid->adl_makan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_makan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_makan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_makan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_makan"
    data-value-separator="<?= $Grid->adl_makan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_makan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_makan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_makan">
<span<?= $Grid->adl_makan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_makan->getDisplayValue($Grid->adl_makan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_makan" id="x<?= $Grid->RowIndex ?>_adl_makan" value="<?= HtmlEncode($Grid->adl_makan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_makan" id="o<?= $Grid->RowIndex ?>_adl_makan" value="<?= HtmlEncode($Grid->adl_makan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_bak->Visible) { // adl_bak ?>
        <td data-name="adl_bak">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_bak">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_bak">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" name="x<?= $Grid->RowIndex ?>_adl_bak" id="x<?= $Grid->RowIndex ?>_adl_bak"<?= $Grid->adl_bak->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_bak" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_bak"
    name="x<?= $Grid->RowIndex ?>_adl_bak"
    value="<?= HtmlEncode($Grid->adl_bak->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_bak"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_bak"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_bak->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bak"
    data-value-separator="<?= $Grid->adl_bak->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_bak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_bak->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_bak">
<span<?= $Grid->adl_bak->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_bak->getDisplayValue($Grid->adl_bak->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_bak" id="x<?= $Grid->RowIndex ?>_adl_bak" value="<?= HtmlEncode($Grid->adl_bak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_bak" id="o<?= $Grid->RowIndex ?>_adl_bak" value="<?= HtmlEncode($Grid->adl_bak->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_bab->Visible) { // adl_bab ?>
        <td data-name="adl_bab">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_bab">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_bab">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" name="x<?= $Grid->RowIndex ?>_adl_bab" id="x<?= $Grid->RowIndex ?>_adl_bab"<?= $Grid->adl_bab->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_bab" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_bab"
    name="x<?= $Grid->RowIndex ?>_adl_bab"
    value="<?= HtmlEncode($Grid->adl_bab->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_bab"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_bab"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_bab->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bab"
    data-value-separator="<?= $Grid->adl_bab->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_bab->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_bab->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_bab">
<span<?= $Grid->adl_bab->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_bab->getDisplayValue($Grid->adl_bab->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_bab" id="x<?= $Grid->RowIndex ?>_adl_bab" value="<?= HtmlEncode($Grid->adl_bab->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_bab" id="o<?= $Grid->RowIndex ?>_adl_bab" value="<?= HtmlEncode($Grid->adl_bab->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_hobi->Visible) { // adl_hobi ?>
        <td data-name="adl_hobi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_hobi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" name="x<?= $Grid->RowIndex ?>_adl_hobi" id="x<?= $Grid->RowIndex ?>_adl_hobi"<?= $Grid->adl_hobi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_hobi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_hobi"
    name="x<?= $Grid->RowIndex ?>_adl_hobi"
    value="<?= HtmlEncode($Grid->adl_hobi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_hobi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_hobi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_hobi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_hobi"
    data-value-separator="<?= $Grid->adl_hobi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_hobi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_hobi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi">
<span<?= $Grid->adl_hobi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_hobi->getDisplayValue($Grid->adl_hobi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_hobi" id="x<?= $Grid->RowIndex ?>_adl_hobi" value="<?= HtmlEncode($Grid->adl_hobi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_hobi" id="o<?= $Grid->RowIndex ?>_adl_hobi" value="<?= HtmlEncode($Grid->adl_hobi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <td data-name="ket_adl_hobi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi">
<input type="<?= $Grid->ket_adl_hobi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" name="x<?= $Grid->RowIndex ?>_ket_adl_hobi" id="x<?= $Grid->RowIndex ?>_ket_adl_hobi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_hobi->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_hobi->EditValue ?>"<?= $Grid->ket_adl_hobi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_hobi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi">
<span<?= $Grid->ket_adl_hobi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_adl_hobi->getDisplayValue($Grid->ket_adl_hobi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_adl_hobi" id="x<?= $Grid->RowIndex ?>_ket_adl_hobi" value="<?= HtmlEncode($Grid->ket_adl_hobi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_adl_hobi" id="o<?= $Grid->RowIndex ?>_ket_adl_hobi" value="<?= HtmlEncode($Grid->ket_adl_hobi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <td data-name="adl_sosialisasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_sosialisasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" name="x<?= $Grid->RowIndex ?>_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_adl_sosialisasi"<?= $Grid->adl_sosialisasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_sosialisasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    name="x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    value="<?= HtmlEncode($Grid->adl_sosialisasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_sosialisasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_sosialisasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_sosialisasi"
    data-value-separator="<?= $Grid->adl_sosialisasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_sosialisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_sosialisasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi">
<span<?= $Grid->adl_sosialisasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_sosialisasi->getDisplayValue($Grid->adl_sosialisasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_adl_sosialisasi" value="<?= HtmlEncode($Grid->adl_sosialisasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_sosialisasi" id="o<?= $Grid->RowIndex ?>_adl_sosialisasi" value="<?= HtmlEncode($Grid->adl_sosialisasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <td data-name="ket_adl_sosialisasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi">
<input type="<?= $Grid->ket_adl_sosialisasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" name="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_sosialisasi->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_sosialisasi->EditValue ?>"<?= $Grid->ket_adl_sosialisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_sosialisasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi">
<span<?= $Grid->ket_adl_sosialisasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_adl_sosialisasi->getDisplayValue($Grid->ket_adl_sosialisasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="x<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" value="<?= HtmlEncode($Grid->ket_adl_sosialisasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" id="o<?= $Grid->RowIndex ?>_ket_adl_sosialisasi" value="<?= HtmlEncode($Grid->ket_adl_sosialisasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <td data-name="adl_kegiatan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan">
<template id="tp_x<?= $Grid->RowIndex ?>_adl_kegiatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" name="x<?= $Grid->RowIndex ?>_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_adl_kegiatan"<?= $Grid->adl_kegiatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_adl_kegiatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_adl_kegiatan"
    name="x<?= $Grid->RowIndex ?>_adl_kegiatan"
    value="<?= HtmlEncode($Grid->adl_kegiatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_adl_kegiatan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_adl_kegiatan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->adl_kegiatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_kegiatan"
    data-value-separator="<?= $Grid->adl_kegiatan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->adl_kegiatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->adl_kegiatan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan">
<span<?= $Grid->adl_kegiatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->adl_kegiatan->getDisplayValue($Grid->adl_kegiatan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_adl_kegiatan" value="<?= HtmlEncode($Grid->adl_kegiatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_adl_kegiatan" id="o<?= $Grid->RowIndex ?>_adl_kegiatan" value="<?= HtmlEncode($Grid->adl_kegiatan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <td data-name="ket_adl_kegiatan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan">
<input type="<?= $Grid->ket_adl_kegiatan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" name="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_adl_kegiatan->getPlaceHolder()) ?>" value="<?= $Grid->ket_adl_kegiatan->EditValue ?>"<?= $Grid->ket_adl_kegiatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_adl_kegiatan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan">
<span<?= $Grid->ket_adl_kegiatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_adl_kegiatan->getDisplayValue($Grid->ket_adl_kegiatan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="x<?= $Grid->RowIndex ?>_ket_adl_kegiatan" value="<?= HtmlEncode($Grid->ket_adl_kegiatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_adl_kegiatan" id="o<?= $Grid->RowIndex ?>_ket_adl_kegiatan" value="<?= HtmlEncode($Grid->ket_adl_kegiatan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_penampilan->Visible) { // sk_penampilan ?>
        <td data-name="sk_penampilan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_penampilan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" name="x<?= $Grid->RowIndex ?>_sk_penampilan" id="x<?= $Grid->RowIndex ?>_sk_penampilan"<?= $Grid->sk_penampilan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_penampilan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_penampilan"
    name="x<?= $Grid->RowIndex ?>_sk_penampilan"
    value="<?= HtmlEncode($Grid->sk_penampilan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_penampilan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_penampilan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_penampilan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_penampilan"
    data-value-separator="<?= $Grid->sk_penampilan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_penampilan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_penampilan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan">
<span<?= $Grid->sk_penampilan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_penampilan->getDisplayValue($Grid->sk_penampilan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_penampilan" id="x<?= $Grid->RowIndex ?>_sk_penampilan" value="<?= HtmlEncode($Grid->sk_penampilan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_penampilan" id="o<?= $Grid->RowIndex ?>_sk_penampilan" value="<?= HtmlEncode($Grid->sk_penampilan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <td data-name="sk_alam_perasaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_alam_perasaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" name="x<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"<?= $Grid->sk_alam_perasaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_alam_perasaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    name="x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    value="<?= HtmlEncode($Grid->sk_alam_perasaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_alam_perasaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_alam_perasaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_alam_perasaan"
    data-value-separator="<?= $Grid->sk_alam_perasaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_alam_perasaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_alam_perasaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan">
<span<?= $Grid->sk_alam_perasaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_alam_perasaan->getDisplayValue($Grid->sk_alam_perasaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="x<?= $Grid->RowIndex ?>_sk_alam_perasaan" value="<?= HtmlEncode($Grid->sk_alam_perasaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_alam_perasaan" id="o<?= $Grid->RowIndex ?>_sk_alam_perasaan" value="<?= HtmlEncode($Grid->sk_alam_perasaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <td data-name="sk_pembicaraan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_pembicaraan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" name="x<?= $Grid->RowIndex ?>_sk_pembicaraan" id="x<?= $Grid->RowIndex ?>_sk_pembicaraan"<?= $Grid->sk_pembicaraan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_pembicaraan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    name="x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    value="<?= HtmlEncode($Grid->sk_pembicaraan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_pembicaraan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_pembicaraan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_pembicaraan"
    data-value-separator="<?= $Grid->sk_pembicaraan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_pembicaraan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_pembicaraan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan">
<span<?= $Grid->sk_pembicaraan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_pembicaraan->getDisplayValue($Grid->sk_pembicaraan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_pembicaraan" id="x<?= $Grid->RowIndex ?>_sk_pembicaraan" value="<?= HtmlEncode($Grid->sk_pembicaraan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_pembicaraan" id="o<?= $Grid->RowIndex ?>_sk_pembicaraan" value="<?= HtmlEncode($Grid->sk_pembicaraan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_afek->Visible) { // sk_afek ?>
        <td data-name="sk_afek">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_afek">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_afek">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" name="x<?= $Grid->RowIndex ?>_sk_afek" id="x<?= $Grid->RowIndex ?>_sk_afek"<?= $Grid->sk_afek->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_afek" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_afek"
    name="x<?= $Grid->RowIndex ?>_sk_afek"
    value="<?= HtmlEncode($Grid->sk_afek->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_afek"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_afek"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_afek->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_afek"
    data-value-separator="<?= $Grid->sk_afek->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_afek->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_afek->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_afek">
<span<?= $Grid->sk_afek->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_afek->getDisplayValue($Grid->sk_afek->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_afek" id="x<?= $Grid->RowIndex ?>_sk_afek" value="<?= HtmlEncode($Grid->sk_afek->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_afek" id="o<?= $Grid->RowIndex ?>_sk_afek" value="<?= HtmlEncode($Grid->sk_afek->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <td data-name="sk_aktifitas_motorik">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" name="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"<?= $Grid->sk_aktifitas_motorik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    name="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_aktifitas_motorik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_aktifitas_motorik"
    data-value-separator="<?= $Grid->sk_aktifitas_motorik->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_aktifitas_motorik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_aktifitas_motorik->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik">
<span<?= $Grid->sk_aktifitas_motorik->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_aktifitas_motorik->getDisplayValue($Grid->sk_aktifitas_motorik->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="x<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" id="o<?= $Grid->RowIndex ?>_sk_aktifitas_motorik" value="<?= HtmlEncode($Grid->sk_aktifitas_motorik->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <td data-name="sk_gangguan_ringan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" name="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"<?= $Grid->sk_gangguan_ringan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    name="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    value="<?= HtmlEncode($Grid->sk_gangguan_ringan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_gangguan_ringan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_gangguan_ringan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_gangguan_ringan"
    data-value-separator="<?= $Grid->sk_gangguan_ringan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_gangguan_ringan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_gangguan_ringan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan">
<span<?= $Grid->sk_gangguan_ringan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_gangguan_ringan->getDisplayValue($Grid->sk_gangguan_ringan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="x<?= $Grid->RowIndex ?>_sk_gangguan_ringan" value="<?= HtmlEncode($Grid->sk_gangguan_ringan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_gangguan_ringan" id="o<?= $Grid->RowIndex ?>_sk_gangguan_ringan" value="<?= HtmlEncode($Grid->sk_gangguan_ringan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <td data-name="sk_proses_pikir">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_proses_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" name="x<?= $Grid->RowIndex ?>_sk_proses_pikir" id="x<?= $Grid->RowIndex ?>_sk_proses_pikir"<?= $Grid->sk_proses_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_proses_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    name="x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    value="<?= HtmlEncode($Grid->sk_proses_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_proses_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_proses_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_proses_pikir"
    data-value-separator="<?= $Grid->sk_proses_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_proses_pikir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_proses_pikir->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir">
<span<?= $Grid->sk_proses_pikir->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_proses_pikir->getDisplayValue($Grid->sk_proses_pikir->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_proses_pikir" id="x<?= $Grid->RowIndex ?>_sk_proses_pikir" value="<?= HtmlEncode($Grid->sk_proses_pikir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_proses_pikir" id="o<?= $Grid->RowIndex ?>_sk_proses_pikir" value="<?= HtmlEncode($Grid->sk_proses_pikir->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_orientasi->Visible) { // sk_orientasi ?>
        <td data-name="sk_orientasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" name="x<?= $Grid->RowIndex ?>_sk_orientasi" id="x<?= $Grid->RowIndex ?>_sk_orientasi"<?= $Grid->sk_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_orientasi"
    name="x<?= $Grid->RowIndex ?>_sk_orientasi"
    value="<?= HtmlEncode($Grid->sk_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_orientasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_orientasi"
    data-value-separator="<?= $Grid->sk_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_orientasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_orientasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi">
<span<?= $Grid->sk_orientasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_orientasi->getDisplayValue($Grid->sk_orientasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_orientasi" id="x<?= $Grid->RowIndex ?>_sk_orientasi" value="<?= HtmlEncode($Grid->sk_orientasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_orientasi" id="o<?= $Grid->RowIndex ?>_sk_orientasi" value="<?= HtmlEncode($Grid->sk_orientasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <td data-name="sk_tingkat_kesadaran_orientasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" name="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"<?= $Grid->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    name="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_tingkat_kesadaran_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_tingkat_kesadaran_orientasi"
    data-value-separator="<?= $Grid->sk_tingkat_kesadaran_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_tingkat_kesadaran_orientasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi">
<span<?= $Grid->sk_tingkat_kesadaran_orientasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_tingkat_kesadaran_orientasi->getDisplayValue($Grid->sk_tingkat_kesadaran_orientasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="x<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" id="o<?= $Grid->RowIndex ?>_sk_tingkat_kesadaran_orientasi" value="<?= HtmlEncode($Grid->sk_tingkat_kesadaran_orientasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_memori->Visible) { // sk_memori ?>
        <td data-name="sk_memori">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_memori">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_memori">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" name="x<?= $Grid->RowIndex ?>_sk_memori" id="x<?= $Grid->RowIndex ?>_sk_memori"<?= $Grid->sk_memori->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_memori" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_memori"
    name="x<?= $Grid->RowIndex ?>_sk_memori"
    value="<?= HtmlEncode($Grid->sk_memori->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_memori"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_memori"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_memori->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_memori"
    data-value-separator="<?= $Grid->sk_memori->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_memori->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_memori->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_memori">
<span<?= $Grid->sk_memori->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_memori->getDisplayValue($Grid->sk_memori->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_memori" id="x<?= $Grid->RowIndex ?>_sk_memori" value="<?= HtmlEncode($Grid->sk_memori->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_memori" id="o<?= $Grid->RowIndex ?>_sk_memori" value="<?= HtmlEncode($Grid->sk_memori->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_interaksi->Visible) { // sk_interaksi ?>
        <td data-name="sk_interaksi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_interaksi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" name="x<?= $Grid->RowIndex ?>_sk_interaksi" id="x<?= $Grid->RowIndex ?>_sk_interaksi"<?= $Grid->sk_interaksi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_interaksi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_interaksi"
    name="x<?= $Grid->RowIndex ?>_sk_interaksi"
    value="<?= HtmlEncode($Grid->sk_interaksi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_interaksi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_interaksi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_interaksi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_interaksi"
    data-value-separator="<?= $Grid->sk_interaksi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_interaksi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_interaksi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi">
<span<?= $Grid->sk_interaksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_interaksi->getDisplayValue($Grid->sk_interaksi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_interaksi" id="x<?= $Grid->RowIndex ?>_sk_interaksi" value="<?= HtmlEncode($Grid->sk_interaksi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_interaksi" id="o<?= $Grid->RowIndex ?>_sk_interaksi" value="<?= HtmlEncode($Grid->sk_interaksi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <td data-name="sk_konsentrasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_konsentrasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" name="x<?= $Grid->RowIndex ?>_sk_konsentrasi" id="x<?= $Grid->RowIndex ?>_sk_konsentrasi"<?= $Grid->sk_konsentrasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_konsentrasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    name="x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    value="<?= HtmlEncode($Grid->sk_konsentrasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_konsentrasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_konsentrasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_konsentrasi"
    data-value-separator="<?= $Grid->sk_konsentrasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_konsentrasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_konsentrasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi">
<span<?= $Grid->sk_konsentrasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_konsentrasi->getDisplayValue($Grid->sk_konsentrasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_konsentrasi" id="x<?= $Grid->RowIndex ?>_sk_konsentrasi" value="<?= HtmlEncode($Grid->sk_konsentrasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_konsentrasi" id="o<?= $Grid->RowIndex ?>_sk_konsentrasi" value="<?= HtmlEncode($Grid->sk_konsentrasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_persepsi->Visible) { // sk_persepsi ?>
        <td data-name="sk_persepsi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_persepsi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" name="x<?= $Grid->RowIndex ?>_sk_persepsi" id="x<?= $Grid->RowIndex ?>_sk_persepsi"<?= $Grid->sk_persepsi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_persepsi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_persepsi"
    name="x<?= $Grid->RowIndex ?>_sk_persepsi"
    value="<?= HtmlEncode($Grid->sk_persepsi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_persepsi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_persepsi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_persepsi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_persepsi"
    data-value-separator="<?= $Grid->sk_persepsi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_persepsi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_persepsi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi">
<span<?= $Grid->sk_persepsi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_persepsi->getDisplayValue($Grid->sk_persepsi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_persepsi" id="x<?= $Grid->RowIndex ?>_sk_persepsi" value="<?= HtmlEncode($Grid->sk_persepsi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_persepsi" id="o<?= $Grid->RowIndex ?>_sk_persepsi" value="<?= HtmlEncode($Grid->sk_persepsi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <td data-name="ket_sk_persepsi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi">
<input type="<?= $Grid->ket_sk_persepsi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" name="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" size="30" maxlength="70" placeholder="<?= HtmlEncode($Grid->ket_sk_persepsi->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_persepsi->EditValue ?>"<?= $Grid->ket_sk_persepsi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_persepsi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi">
<span<?= $Grid->ket_sk_persepsi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_sk_persepsi->getDisplayValue($Grid->ket_sk_persepsi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="x<?= $Grid->RowIndex ?>_ket_sk_persepsi" value="<?= HtmlEncode($Grid->ket_sk_persepsi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_sk_persepsi" id="o<?= $Grid->RowIndex ?>_ket_sk_persepsi" value="<?= HtmlEncode($Grid->ket_sk_persepsi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <td data-name="sk_isi_pikir">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_isi_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" name="x<?= $Grid->RowIndex ?>_sk_isi_pikir" id="x<?= $Grid->RowIndex ?>_sk_isi_pikir"<?= $Grid->sk_isi_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_isi_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    name="x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    value="<?= HtmlEncode($Grid->sk_isi_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_isi_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_isi_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_isi_pikir"
    data-value-separator="<?= $Grid->sk_isi_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_isi_pikir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_isi_pikir->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir">
<span<?= $Grid->sk_isi_pikir->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_isi_pikir->getDisplayValue($Grid->sk_isi_pikir->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_isi_pikir" id="x<?= $Grid->RowIndex ?>_sk_isi_pikir" value="<?= HtmlEncode($Grid->sk_isi_pikir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_isi_pikir" id="o<?= $Grid->RowIndex ?>_sk_isi_pikir" value="<?= HtmlEncode($Grid->sk_isi_pikir->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_waham->Visible) { // sk_waham ?>
        <td data-name="sk_waham">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_waham">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_waham">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" name="x<?= $Grid->RowIndex ?>_sk_waham" id="x<?= $Grid->RowIndex ?>_sk_waham"<?= $Grid->sk_waham->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_waham" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_waham"
    name="x<?= $Grid->RowIndex ?>_sk_waham"
    value="<?= HtmlEncode($Grid->sk_waham->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_waham"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_waham"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_waham->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_waham"
    data-value-separator="<?= $Grid->sk_waham->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_waham->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_waham->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_waham">
<span<?= $Grid->sk_waham->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_waham->getDisplayValue($Grid->sk_waham->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_waham" id="x<?= $Grid->RowIndex ?>_sk_waham" value="<?= HtmlEncode($Grid->sk_waham->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_waham" id="o<?= $Grid->RowIndex ?>_sk_waham" value="<?= HtmlEncode($Grid->sk_waham->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <td data-name="ket_sk_waham">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham">
<input type="<?= $Grid->ket_sk_waham->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" name="x<?= $Grid->RowIndex ?>_ket_sk_waham" id="x<?= $Grid->RowIndex ?>_ket_sk_waham" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_sk_waham->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_waham->EditValue ?>"<?= $Grid->ket_sk_waham->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_waham->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham">
<span<?= $Grid->ket_sk_waham->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_sk_waham->getDisplayValue($Grid->ket_sk_waham->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_sk_waham" id="x<?= $Grid->RowIndex ?>_ket_sk_waham" value="<?= HtmlEncode($Grid->ket_sk_waham->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_sk_waham" id="o<?= $Grid->RowIndex ?>_ket_sk_waham" value="<?= HtmlEncode($Grid->ket_sk_waham->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <td data-name="sk_daya_tilik_diri">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri">
<template id="tp_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" name="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"<?= $Grid->sk_daya_tilik_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    name="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    data-target="dsl_x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->sk_daya_tilik_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_daya_tilik_diri"
    data-value-separator="<?= $Grid->sk_daya_tilik_diri->displayValueSeparatorAttribute() ?>"
    <?= $Grid->sk_daya_tilik_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri">
<span<?= $Grid->sk_daya_tilik_diri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sk_daya_tilik_diri->getDisplayValue($Grid->sk_daya_tilik_diri->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" id="o<?= $Grid->RowIndex ?>_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->sk_daya_tilik_diri->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <td data-name="ket_sk_daya_tilik_diri">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri">
<input type="<?= $Grid->ket_sk_daya_tilik_diri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" name="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->getPlaceHolder()) ?>" value="<?= $Grid->ket_sk_daya_tilik_diri->EditValue ?>"<?= $Grid->ket_sk_daya_tilik_diri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri">
<span<?= $Grid->ket_sk_daya_tilik_diri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_sk_daya_tilik_diri->getDisplayValue($Grid->ket_sk_daya_tilik_diri->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="x<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" id="o<?= $Grid->RowIndex ?>_ket_sk_daya_tilik_diri" value="<?= HtmlEncode($Grid->ket_sk_daya_tilik_diri->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <td data-name="kk_pembelajaran">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" name="x<?= $Grid->RowIndex ?>_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_kk_pembelajaran"<?= $Grid->kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    name="x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    value="<?= HtmlEncode($Grid->kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_pembelajaran"
    data-value-separator="<?= $Grid->kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_pembelajaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_pembelajaran->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran">
<span<?= $Grid->kk_pembelajaran->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kk_pembelajaran->getDisplayValue($Grid->kk_pembelajaran->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_kk_pembelajaran" value="<?= HtmlEncode($Grid->kk_pembelajaran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_pembelajaran" id="o<?= $Grid->RowIndex ?>_kk_pembelajaran" value="<?= HtmlEncode($Grid->kk_pembelajaran->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <td data-name="ket_kk_pembelajaran">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran">
<template id="tp_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"<?= $Grid->ket_kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->ket_kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_ket_kk_pembelajaran"
    data-value-separator="<?= $Grid->ket_kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->ket_kk_pembelajaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_pembelajaran->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran">
<span<?= $Grid->ket_kk_pembelajaran->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_kk_pembelajaran->getDisplayValue($Grid->ket_kk_pembelajaran->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" id="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <td data-name="ket_kk_pembelajaran_lainnya">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya">
<input type="<?= $Grid->ket_kk_pembelajaran_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_pembelajaran_lainnya->EditValue ?>"<?= $Grid->ket_kk_pembelajaran_lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_pembelajaran_lainnya->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya">
<span<?= $Grid->ket_kk_pembelajaran_lainnya->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_kk_pembelajaran_lainnya->getDisplayValue($Grid->ket_kk_pembelajaran_lainnya->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" id="o<?= $Grid->RowIndex ?>_ket_kk_pembelajaran_lainnya" value="<?= HtmlEncode($Grid->ket_kk_pembelajaran_lainnya->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <td data-name="kk_Penerjamah">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_Penerjamah">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" name="x<?= $Grid->RowIndex ?>_kk_Penerjamah" id="x<?= $Grid->RowIndex ?>_kk_Penerjamah"<?= $Grid->kk_Penerjamah->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_Penerjamah" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    name="x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    value="<?= HtmlEncode($Grid->kk_Penerjamah->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_Penerjamah"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_Penerjamah->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_Penerjamah"
    data-value-separator="<?= $Grid->kk_Penerjamah->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_Penerjamah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_Penerjamah->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah">
<span<?= $Grid->kk_Penerjamah->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kk_Penerjamah->getDisplayValue($Grid->kk_Penerjamah->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kk_Penerjamah" id="x<?= $Grid->RowIndex ?>_kk_Penerjamah" value="<?= HtmlEncode($Grid->kk_Penerjamah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_Penerjamah" id="o<?= $Grid->RowIndex ?>_kk_Penerjamah" value="<?= HtmlEncode($Grid->kk_Penerjamah->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <td data-name="ket_kk_penerjamah_Lainnya">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya">
<input type="<?= $Grid->ket_kk_penerjamah_Lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" name="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_penerjamah_Lainnya->EditValue ?>"<?= $Grid->ket_kk_penerjamah_Lainnya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_penerjamah_Lainnya->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya">
<span<?= $Grid->ket_kk_penerjamah_Lainnya->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_kk_penerjamah_Lainnya->getDisplayValue($Grid->ket_kk_penerjamah_Lainnya->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="x<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" value="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" id="o<?= $Grid->RowIndex ?>_ket_kk_penerjamah_Lainnya" value="<?= HtmlEncode($Grid->ket_kk_penerjamah_Lainnya->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <td data-name="kk_bahasa_isyarat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" name="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"<?= $Grid->kk_bahasa_isyarat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    name="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_bahasa_isyarat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_bahasa_isyarat"
    data-value-separator="<?= $Grid->kk_bahasa_isyarat->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_bahasa_isyarat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_bahasa_isyarat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat">
<span<?= $Grid->kk_bahasa_isyarat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kk_bahasa_isyarat->getDisplayValue($Grid->kk_bahasa_isyarat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="x<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" id="o<?= $Grid->RowIndex ?>_kk_bahasa_isyarat" value="<?= HtmlEncode($Grid->kk_bahasa_isyarat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <td data-name="kk_kebutuhan_edukasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi">
<template id="tp_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" name="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"<?= $Grid->kk_kebutuhan_edukasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    name="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kk_kebutuhan_edukasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_kebutuhan_edukasi"
    data-value-separator="<?= $Grid->kk_kebutuhan_edukasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kk_kebutuhan_edukasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi">
<span<?= $Grid->kk_kebutuhan_edukasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kk_kebutuhan_edukasi->getDisplayValue($Grid->kk_kebutuhan_edukasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" id="o<?= $Grid->RowIndex ?>_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->kk_kebutuhan_edukasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <td data-name="ket_kk_kebutuhan_edukasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi">
<input type="<?= $Grid->ket_kk_kebutuhan_edukasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" name="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->getPlaceHolder()) ?>" value="<?= $Grid->ket_kk_kebutuhan_edukasi->EditValue ?>"<?= $Grid->ket_kk_kebutuhan_edukasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ket_kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi">
<span<?= $Grid->ket_kk_kebutuhan_edukasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ket_kk_kebutuhan_edukasi->getDisplayValue($Grid->ket_kk_kebutuhan_edukasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="x<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" id="o<?= $Grid->RowIndex ?>_ket_kk_kebutuhan_edukasi" value="<?= HtmlEncode($Grid->ket_kk_kebutuhan_edukasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rencana->Visible) { // rencana ?>
        <td data-name="rencana">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rencana">
<input type="<?= $Grid->rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" name="x<?= $Grid->RowIndex ?>_rencana" id="x<?= $Grid->RowIndex ?>_rencana" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->rencana->getPlaceHolder()) ?>" value="<?= $Grid->rencana->EditValue ?>"<?= $Grid->rencana->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rencana->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_rencana">
<span<?= $Grid->rencana->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rencana->getDisplayValue($Grid->rencana->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rencana" id="x<?= $Grid->RowIndex ?>_rencana" value="<?= HtmlEncode($Grid->rencana->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rencana" id="o<?= $Grid->RowIndex ?>_rencana" value="<?= HtmlEncode($Grid->rencana->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nip->Visible) { // nip ?>
        <td data-name="nip">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nip">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="form-group penilaian_awal_keperawatan_ralan_psikiatri_nip">
<span<?= $Grid->nip->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nip->getDisplayValue($Grid->nip->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nip" id="o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpenilaian_awal_keperawatan_ralan_psikiatrigrid","load"], function() {
    fpenilaian_awal_keperawatan_ralan_psikiatrigrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpenilaian_awal_keperawatan_ralan_psikiatrigrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("penilaian_awal_keperawatan_ralan_psikiatri");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
