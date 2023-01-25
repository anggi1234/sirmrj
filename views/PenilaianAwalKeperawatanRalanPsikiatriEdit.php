<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanPsikiatriEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralan_psikiatriedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpenilaian_awal_keperawatan_ralan_psikiatriedit = currentForm = new ew.Form("fpenilaian_awal_keperawatan_ralan_psikiatriedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan_psikiatri")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri)
        ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri = currentTable;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.addFields([
        ["id_penilaian_awal_keperawatan_ralan_psikiatri", [fields.id_penilaian_awal_keperawatan_ralan_psikiatri.visible && fields.id_penilaian_awal_keperawatan_ralan_psikiatri.required ? ew.Validators.required(fields.id_penilaian_awal_keperawatan_ralan_psikiatri.caption) : null], fields.id_penilaian_awal_keperawatan_ralan_psikiatri.isInvalid],
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(0)], fields.tanggal.isInvalid],
        ["informasi", [fields.informasi.visible && fields.informasi.required ? ew.Validators.required(fields.informasi.caption) : null], fields.informasi.isInvalid],
        ["keluhan_utama", [fields.keluhan_utama.visible && fields.keluhan_utama.required ? ew.Validators.required(fields.keluhan_utama.caption) : null], fields.keluhan_utama.isInvalid],
        ["rkd_sakit_sejak", [fields.rkd_sakit_sejak.visible && fields.rkd_sakit_sejak.required ? ew.Validators.required(fields.rkd_sakit_sejak.caption) : null], fields.rkd_sakit_sejak.isInvalid],
        ["rkd_keluhan", [fields.rkd_keluhan.visible && fields.rkd_keluhan.required ? ew.Validators.required(fields.rkd_keluhan.caption) : null], fields.rkd_keluhan.isInvalid],
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
        var f = fpenilaian_awal_keperawatan_ralan_psikiatriedit,
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
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.validate = function () {
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

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.informasi = <?= $Page->informasi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rkd_berobat = <?= $Page->rkd_berobat->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rkd_hasil_pengobatan = <?= $Page->rkd_hasil_pengobatan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.fp_putus_obat = <?= $Page->fp_putus_obat->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.fp_ekonomi = <?= $Page->fp_ekonomi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.fp_masalah_fisik = <?= $Page->fp_masalah_fisik->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.fp_masalah_psikososial = <?= $Page->fp_masalah_psikososial->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rh_keluarga = <?= $Page->rh_keluarga->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.resiko_bunuh_diri = <?= $Page->resiko_bunuh_diri->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rbd_ide = <?= $Page->rbd_ide->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rbd_rencana = <?= $Page->rbd_rencana->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rbd_alat = <?= $Page->rbd_alat->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rbd_percobaan = <?= $Page->rbd_percobaan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rbd_keinginan = <?= $Page->rbd_keinginan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rpo_penggunaan = <?= $Page->rpo_penggunaan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rpo_efek_samping = <?= $Page->rpo_efek_samping->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rpo_napza = <?= $Page->rpo_napza->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rpo_penggunaan_obat_lainnya = <?= $Page->rpo_penggunaan_obat_lainnya->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rpo_alergi_obat = <?= $Page->rpo_alergi_obat->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rpo_merokok = <?= $Page->rpo_merokok->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.rpo_minum_kopi = <?= $Page->rpo_minum_kopi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.pf_keluhan_fisik = <?= $Page->pf_keluhan_fisik->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.skala_nyeri = <?= $Page->skala_nyeri->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.nyeri = <?= $Page->nyeri->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.provokes = <?= $Page->provokes->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.quality = <?= $Page->quality->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.menyebar = <?= $Page->menyebar->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.pada_dokter = <?= $Page->pada_dokter->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.nyeri_hilang = <?= $Page->nyeri_hilang->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.lapor_status_nutrisi = <?= $Page->lapor_status_nutrisi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sg1 = <?= $Page->sg1->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.nilai1 = <?= $Page->nilai1->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sg2 = <?= $Page->sg2->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.nilai2 = <?= $Page->nilai2->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.resikojatuh = <?= $Page->resikojatuh->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.bjm = <?= $Page->bjm->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.msa = <?= $Page->msa->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.hasil = <?= $Page->hasil->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.lapor = <?= $Page->lapor->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_mandi = <?= $Page->adl_mandi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_berpakaian = <?= $Page->adl_berpakaian->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_makan = <?= $Page->adl_makan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_bak = <?= $Page->adl_bak->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_bab = <?= $Page->adl_bab->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_hobi = <?= $Page->adl_hobi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_sosialisasi = <?= $Page->adl_sosialisasi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.adl_kegiatan = <?= $Page->adl_kegiatan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_penampilan = <?= $Page->sk_penampilan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_alam_perasaan = <?= $Page->sk_alam_perasaan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_pembicaraan = <?= $Page->sk_pembicaraan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_afek = <?= $Page->sk_afek->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_aktifitas_motorik = <?= $Page->sk_aktifitas_motorik->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_gangguan_ringan = <?= $Page->sk_gangguan_ringan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_proses_pikir = <?= $Page->sk_proses_pikir->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_orientasi = <?= $Page->sk_orientasi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_tingkat_kesadaran_orientasi = <?= $Page->sk_tingkat_kesadaran_orientasi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_memori = <?= $Page->sk_memori->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_interaksi = <?= $Page->sk_interaksi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_konsentrasi = <?= $Page->sk_konsentrasi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_persepsi = <?= $Page->sk_persepsi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_isi_pikir = <?= $Page->sk_isi_pikir->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_waham = <?= $Page->sk_waham->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.sk_daya_tilik_diri = <?= $Page->sk_daya_tilik_diri->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.kk_pembelajaran = <?= $Page->kk_pembelajaran->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.ket_kk_pembelajaran = <?= $Page->ket_kk_pembelajaran->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.kk_Penerjamah = <?= $Page->kk_Penerjamah->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.kk_bahasa_isyarat = <?= $Page->kk_bahasa_isyarat->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralan_psikiatriedit.lists.kk_kebutuhan_edukasi = <?= $Page->kk_kebutuhan_edukasi->toClientList($Page) ?>;
    loadjs.done("fpenilaian_awal_keperawatan_ralan_psikiatriedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenilaian_awal_keperawatan_ralan_psikiatriedit" id="fpenilaian_awal_keperawatan_ralan_psikiatriedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan_psikiatri">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "vigd") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vigd">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "vrajal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_penilaian_awal_keperawatan_ralan_psikiatri->Visible) { // id_penilaian_awal_keperawatan_ralan_psikiatri ?>
    <div id="r_id_penilaian_awal_keperawatan_ralan_psikiatri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_id_penilaian_awal_keperawatan_ralan_psikiatri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->caption() ?><?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_id_penilaian_awal_keperawatan_ralan_psikiatri">
<span<?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_penilaian_awal_keperawatan_ralan_psikiatri->getDisplayValue($Page->id_penilaian_awal_keperawatan_ralan_psikiatri->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_id_penilaian_awal_keperawatan_ralan_psikiatri" data-hidden="1" name="x_id_penilaian_awal_keperawatan_ralan_psikiatri" id="x_id_penilaian_awal_keperawatan_ralan_psikiatri" value="<?= HtmlEncode($Page->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<?php if ($Page->no_rawat->getSessionValue() != "") { ?>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_rawat->getDisplayValue($Page->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_rawat" name="x_no_rawat" value="<?= HtmlEncode($Page->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <div id="r_tanggal" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" for="x_tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal->caption() ?><?= $Page->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_tanggal">
<input type="<?= $Page->tanggal->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" placeholder="<?= HtmlEncode($Page->tanggal->getPlaceHolder()) ?>" value="<?= $Page->tanggal->EditValue ?>"<?= $Page->tanggal->editAttributes() ?> aria-describedby="x_tanggal_help">
<?= $Page->tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal->getErrorMessage() ?></div>
<?php if (!$Page->tanggal->ReadOnly && !$Page->tanggal->Disabled && !isset($Page->tanggal->EditAttrs["readonly"]) && !isset($Page->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_awal_keperawatan_ralan_psikiatriedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_awal_keperawatan_ralan_psikiatriedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
    <div id="r_informasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->informasi->caption() ?><?= $Page->informasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->informasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_informasi">
<template id="tp_x_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_informasi" name="x_informasi" id="x_informasi"<?= $Page->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_informasi"
    name="x_informasi"
    value="<?= HtmlEncode($Page->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_informasi"
    data-target="dsl_x_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_informasi"
    data-value-separator="<?= $Page->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->informasi->editAttributes() ?>>
<?= $Page->informasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->informasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <div id="r_keluhan_utama" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_keluhan_utama" for="x_keluhan_utama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keluhan_utama->caption() ?><?= $Page->keluhan_utama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_keluhan_utama">
<textarea data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_keluhan_utama" name="x_keluhan_utama" id="x_keluhan_utama" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keluhan_utama->getPlaceHolder()) ?>"<?= $Page->keluhan_utama->editAttributes() ?> aria-describedby="x_keluhan_utama_help"><?= $Page->keluhan_utama->EditValue ?></textarea>
<?= $Page->keluhan_utama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keluhan_utama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
    <div id="r_rkd_sakit_sejak" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" for="x_rkd_sakit_sejak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rkd_sakit_sejak->caption() ?><?= $Page->rkd_sakit_sejak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rkd_sakit_sejak->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak">
<input type="<?= $Page->rkd_sakit_sejak->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_sakit_sejak" name="x_rkd_sakit_sejak" id="x_rkd_sakit_sejak" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->rkd_sakit_sejak->getPlaceHolder()) ?>" value="<?= $Page->rkd_sakit_sejak->EditValue ?>"<?= $Page->rkd_sakit_sejak->editAttributes() ?> aria-describedby="x_rkd_sakit_sejak_help">
<?= $Page->rkd_sakit_sejak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rkd_sakit_sejak->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rkd_keluhan->Visible) { // rkd_keluhan ?>
    <div id="r_rkd_keluhan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_keluhan" for="x_rkd_keluhan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rkd_keluhan->caption() ?><?= $Page->rkd_keluhan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rkd_keluhan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_keluhan">
<textarea data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_keluhan" name="x_rkd_keluhan" id="x_rkd_keluhan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rkd_keluhan->getPlaceHolder()) ?>"<?= $Page->rkd_keluhan->editAttributes() ?> aria-describedby="x_rkd_keluhan_help"><?= $Page->rkd_keluhan->EditValue ?></textarea>
<?= $Page->rkd_keluhan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rkd_keluhan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
    <div id="r_rkd_berobat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rkd_berobat->caption() ?><?= $Page->rkd_berobat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rkd_berobat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat">
<template id="tp_x_rkd_berobat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_berobat" name="x_rkd_berobat" id="x_rkd_berobat"<?= $Page->rkd_berobat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rkd_berobat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rkd_berobat"
    name="x_rkd_berobat"
    value="<?= HtmlEncode($Page->rkd_berobat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rkd_berobat"
    data-target="dsl_x_rkd_berobat"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rkd_berobat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_berobat"
    data-value-separator="<?= $Page->rkd_berobat->displayValueSeparatorAttribute() ?>"
    <?= $Page->rkd_berobat->editAttributes() ?>>
<?= $Page->rkd_berobat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rkd_berobat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
    <div id="r_rkd_hasil_pengobatan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rkd_hasil_pengobatan->caption() ?><?= $Page->rkd_hasil_pengobatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rkd_hasil_pengobatan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan">
<template id="tp_x_rkd_hasil_pengobatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rkd_hasil_pengobatan" name="x_rkd_hasil_pengobatan" id="x_rkd_hasil_pengobatan"<?= $Page->rkd_hasil_pengobatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rkd_hasil_pengobatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rkd_hasil_pengobatan"
    name="x_rkd_hasil_pengobatan"
    value="<?= HtmlEncode($Page->rkd_hasil_pengobatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rkd_hasil_pengobatan"
    data-target="dsl_x_rkd_hasil_pengobatan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rkd_hasil_pengobatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rkd_hasil_pengobatan"
    data-value-separator="<?= $Page->rkd_hasil_pengobatan->displayValueSeparatorAttribute() ?>"
    <?= $Page->rkd_hasil_pengobatan->editAttributes() ?>>
<?= $Page->rkd_hasil_pengobatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rkd_hasil_pengobatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
    <div id="r_fp_putus_obat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fp_putus_obat->caption() ?><?= $Page->fp_putus_obat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fp_putus_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat">
<template id="tp_x_fp_putus_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_putus_obat" name="x_fp_putus_obat" id="x_fp_putus_obat"<?= $Page->fp_putus_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_fp_putus_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_fp_putus_obat"
    name="x_fp_putus_obat"
    value="<?= HtmlEncode($Page->fp_putus_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_fp_putus_obat"
    data-target="dsl_x_fp_putus_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Page->fp_putus_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_putus_obat"
    data-value-separator="<?= $Page->fp_putus_obat->displayValueSeparatorAttribute() ?>"
    <?= $Page->fp_putus_obat->editAttributes() ?>>
<?= $Page->fp_putus_obat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fp_putus_obat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
    <div id="r_ket_putus_obat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" for="x_ket_putus_obat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_putus_obat->caption() ?><?= $Page->ket_putus_obat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_putus_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat">
<input type="<?= $Page->ket_putus_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_putus_obat" name="x_ket_putus_obat" id="x_ket_putus_obat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_putus_obat->getPlaceHolder()) ?>" value="<?= $Page->ket_putus_obat->EditValue ?>"<?= $Page->ket_putus_obat->editAttributes() ?> aria-describedby="x_ket_putus_obat_help">
<?= $Page->ket_putus_obat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_putus_obat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
    <div id="r_fp_ekonomi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fp_ekonomi->caption() ?><?= $Page->fp_ekonomi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fp_ekonomi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi">
<template id="tp_x_fp_ekonomi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_ekonomi" name="x_fp_ekonomi" id="x_fp_ekonomi"<?= $Page->fp_ekonomi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_fp_ekonomi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_fp_ekonomi"
    name="x_fp_ekonomi"
    value="<?= HtmlEncode($Page->fp_ekonomi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_fp_ekonomi"
    data-target="dsl_x_fp_ekonomi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->fp_ekonomi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_ekonomi"
    data-value-separator="<?= $Page->fp_ekonomi->displayValueSeparatorAttribute() ?>"
    <?= $Page->fp_ekonomi->editAttributes() ?>>
<?= $Page->fp_ekonomi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fp_ekonomi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
    <div id="r_ket_masalah_ekonomi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" for="x_ket_masalah_ekonomi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_masalah_ekonomi->caption() ?><?= $Page->ket_masalah_ekonomi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_masalah_ekonomi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi">
<input type="<?= $Page->ket_masalah_ekonomi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_ekonomi" name="x_ket_masalah_ekonomi" id="x_ket_masalah_ekonomi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_masalah_ekonomi->getPlaceHolder()) ?>" value="<?= $Page->ket_masalah_ekonomi->EditValue ?>"<?= $Page->ket_masalah_ekonomi->editAttributes() ?> aria-describedby="x_ket_masalah_ekonomi_help">
<?= $Page->ket_masalah_ekonomi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_masalah_ekonomi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
    <div id="r_fp_masalah_fisik" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fp_masalah_fisik->caption() ?><?= $Page->fp_masalah_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fp_masalah_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik">
<template id="tp_x_fp_masalah_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_fisik" name="x_fp_masalah_fisik" id="x_fp_masalah_fisik"<?= $Page->fp_masalah_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_fp_masalah_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_fp_masalah_fisik"
    name="x_fp_masalah_fisik"
    value="<?= HtmlEncode($Page->fp_masalah_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_fp_masalah_fisik"
    data-target="dsl_x_fp_masalah_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Page->fp_masalah_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_fisik"
    data-value-separator="<?= $Page->fp_masalah_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Page->fp_masalah_fisik->editAttributes() ?>>
<?= $Page->fp_masalah_fisik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fp_masalah_fisik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
    <div id="r_ket_masalah_fisik" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" for="x_ket_masalah_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_masalah_fisik->caption() ?><?= $Page->ket_masalah_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_masalah_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik">
<input type="<?= $Page->ket_masalah_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_fisik" name="x_ket_masalah_fisik" id="x_ket_masalah_fisik" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_masalah_fisik->getPlaceHolder()) ?>" value="<?= $Page->ket_masalah_fisik->EditValue ?>"<?= $Page->ket_masalah_fisik->editAttributes() ?> aria-describedby="x_ket_masalah_fisik_help">
<?= $Page->ket_masalah_fisik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_masalah_fisik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
    <div id="r_fp_masalah_psikososial" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fp_masalah_psikososial->caption() ?><?= $Page->fp_masalah_psikososial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fp_masalah_psikososial->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial">
<template id="tp_x_fp_masalah_psikososial">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_fp_masalah_psikososial" name="x_fp_masalah_psikososial" id="x_fp_masalah_psikososial"<?= $Page->fp_masalah_psikososial->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_fp_masalah_psikososial" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_fp_masalah_psikososial"
    name="x_fp_masalah_psikososial"
    value="<?= HtmlEncode($Page->fp_masalah_psikososial->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_fp_masalah_psikososial"
    data-target="dsl_x_fp_masalah_psikososial"
    data-repeatcolumn="5"
    class="form-control<?= $Page->fp_masalah_psikososial->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_fp_masalah_psikososial"
    data-value-separator="<?= $Page->fp_masalah_psikososial->displayValueSeparatorAttribute() ?>"
    <?= $Page->fp_masalah_psikososial->editAttributes() ?>>
<?= $Page->fp_masalah_psikososial->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fp_masalah_psikososial->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
    <div id="r_ket_masalah_psikososial" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" for="x_ket_masalah_psikososial" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_masalah_psikososial->caption() ?><?= $Page->ket_masalah_psikososial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_masalah_psikososial->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial">
<input type="<?= $Page->ket_masalah_psikososial->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_masalah_psikososial" name="x_ket_masalah_psikososial" id="x_ket_masalah_psikososial" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_masalah_psikososial->getPlaceHolder()) ?>" value="<?= $Page->ket_masalah_psikososial->EditValue ?>"<?= $Page->ket_masalah_psikososial->editAttributes() ?> aria-describedby="x_ket_masalah_psikososial_help">
<?= $Page->ket_masalah_psikososial->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_masalah_psikososial->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
    <div id="r_rh_keluarga" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rh_keluarga->caption() ?><?= $Page->rh_keluarga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rh_keluarga->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga">
<template id="tp_x_rh_keluarga">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rh_keluarga" name="x_rh_keluarga" id="x_rh_keluarga"<?= $Page->rh_keluarga->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rh_keluarga" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rh_keluarga"
    name="x_rh_keluarga"
    value="<?= HtmlEncode($Page->rh_keluarga->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rh_keluarga"
    data-target="dsl_x_rh_keluarga"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rh_keluarga->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rh_keluarga"
    data-value-separator="<?= $Page->rh_keluarga->displayValueSeparatorAttribute() ?>"
    <?= $Page->rh_keluarga->editAttributes() ?>>
<?= $Page->rh_keluarga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rh_keluarga->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
    <div id="r_ket_rh_keluarga" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" for="x_ket_rh_keluarga" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rh_keluarga->caption() ?><?= $Page->ket_rh_keluarga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rh_keluarga->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga">
<input type="<?= $Page->ket_rh_keluarga->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rh_keluarga" name="x_ket_rh_keluarga" id="x_ket_rh_keluarga" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_rh_keluarga->getPlaceHolder()) ?>" value="<?= $Page->ket_rh_keluarga->EditValue ?>"<?= $Page->ket_rh_keluarga->editAttributes() ?> aria-describedby="x_ket_rh_keluarga_help">
<?= $Page->ket_rh_keluarga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rh_keluarga->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
    <div id="r_resiko_bunuh_diri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resiko_bunuh_diri->caption() ?><?= $Page->resiko_bunuh_diri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resiko_bunuh_diri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri">
<template id="tp_x_resiko_bunuh_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resiko_bunuh_diri" name="x_resiko_bunuh_diri" id="x_resiko_bunuh_diri"<?= $Page->resiko_bunuh_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_resiko_bunuh_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_resiko_bunuh_diri"
    name="x_resiko_bunuh_diri"
    value="<?= HtmlEncode($Page->resiko_bunuh_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_resiko_bunuh_diri"
    data-target="dsl_x_resiko_bunuh_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Page->resiko_bunuh_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resiko_bunuh_diri"
    data-value-separator="<?= $Page->resiko_bunuh_diri->displayValueSeparatorAttribute() ?>"
    <?= $Page->resiko_bunuh_diri->editAttributes() ?>>
<?= $Page->resiko_bunuh_diri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resiko_bunuh_diri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
    <div id="r_rbd_ide" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rbd_ide->caption() ?><?= $Page->rbd_ide->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rbd_ide->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide">
<template id="tp_x_rbd_ide">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_ide" name="x_rbd_ide" id="x_rbd_ide"<?= $Page->rbd_ide->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rbd_ide" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rbd_ide"
    name="x_rbd_ide"
    value="<?= HtmlEncode($Page->rbd_ide->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rbd_ide"
    data-target="dsl_x_rbd_ide"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rbd_ide->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_ide"
    data-value-separator="<?= $Page->rbd_ide->displayValueSeparatorAttribute() ?>"
    <?= $Page->rbd_ide->editAttributes() ?>>
<?= $Page->rbd_ide->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rbd_ide->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
    <div id="r_ket_rbd_ide" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" for="x_ket_rbd_ide" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rbd_ide->caption() ?><?= $Page->ket_rbd_ide->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rbd_ide->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide">
<input type="<?= $Page->ket_rbd_ide->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_ide" name="x_ket_rbd_ide" id="x_ket_rbd_ide" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_rbd_ide->getPlaceHolder()) ?>" value="<?= $Page->ket_rbd_ide->EditValue ?>"<?= $Page->ket_rbd_ide->editAttributes() ?> aria-describedby="x_ket_rbd_ide_help">
<?= $Page->ket_rbd_ide->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rbd_ide->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
    <div id="r_rbd_rencana" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rbd_rencana->caption() ?><?= $Page->rbd_rencana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rbd_rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana">
<template id="tp_x_rbd_rencana">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_rencana" name="x_rbd_rencana" id="x_rbd_rencana"<?= $Page->rbd_rencana->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rbd_rencana" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rbd_rencana"
    name="x_rbd_rencana"
    value="<?= HtmlEncode($Page->rbd_rencana->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rbd_rencana"
    data-target="dsl_x_rbd_rencana"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rbd_rencana->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_rencana"
    data-value-separator="<?= $Page->rbd_rencana->displayValueSeparatorAttribute() ?>"
    <?= $Page->rbd_rencana->editAttributes() ?>>
<?= $Page->rbd_rencana->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rbd_rencana->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
    <div id="r_ket_rbd_rencana" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" for="x_ket_rbd_rencana" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rbd_rencana->caption() ?><?= $Page->ket_rbd_rencana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rbd_rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana">
<input type="<?= $Page->ket_rbd_rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_rencana" name="x_ket_rbd_rencana" id="x_ket_rbd_rencana" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_rbd_rencana->getPlaceHolder()) ?>" value="<?= $Page->ket_rbd_rencana->EditValue ?>"<?= $Page->ket_rbd_rencana->editAttributes() ?> aria-describedby="x_ket_rbd_rencana_help">
<?= $Page->ket_rbd_rencana->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rbd_rencana->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
    <div id="r_rbd_alat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rbd_alat->caption() ?><?= $Page->rbd_alat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rbd_alat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat">
<template id="tp_x_rbd_alat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_alat" name="x_rbd_alat" id="x_rbd_alat"<?= $Page->rbd_alat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rbd_alat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rbd_alat"
    name="x_rbd_alat"
    value="<?= HtmlEncode($Page->rbd_alat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rbd_alat"
    data-target="dsl_x_rbd_alat"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rbd_alat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_alat"
    data-value-separator="<?= $Page->rbd_alat->displayValueSeparatorAttribute() ?>"
    <?= $Page->rbd_alat->editAttributes() ?>>
<?= $Page->rbd_alat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rbd_alat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
    <div id="r_ket_rbd_alat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" for="x_ket_rbd_alat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rbd_alat->caption() ?><?= $Page->ket_rbd_alat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rbd_alat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat">
<input type="<?= $Page->ket_rbd_alat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_alat" name="x_ket_rbd_alat" id="x_ket_rbd_alat" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_rbd_alat->getPlaceHolder()) ?>" value="<?= $Page->ket_rbd_alat->EditValue ?>"<?= $Page->ket_rbd_alat->editAttributes() ?> aria-describedby="x_ket_rbd_alat_help">
<?= $Page->ket_rbd_alat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rbd_alat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
    <div id="r_rbd_percobaan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rbd_percobaan->caption() ?><?= $Page->rbd_percobaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rbd_percobaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan">
<template id="tp_x_rbd_percobaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_percobaan" name="x_rbd_percobaan" id="x_rbd_percobaan"<?= $Page->rbd_percobaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rbd_percobaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rbd_percobaan"
    name="x_rbd_percobaan"
    value="<?= HtmlEncode($Page->rbd_percobaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rbd_percobaan"
    data-target="dsl_x_rbd_percobaan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rbd_percobaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_percobaan"
    data-value-separator="<?= $Page->rbd_percobaan->displayValueSeparatorAttribute() ?>"
    <?= $Page->rbd_percobaan->editAttributes() ?>>
<?= $Page->rbd_percobaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rbd_percobaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
    <div id="r_ket_rbd_percobaan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" for="x_ket_rbd_percobaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rbd_percobaan->caption() ?><?= $Page->ket_rbd_percobaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rbd_percobaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan">
<input type="<?= $Page->ket_rbd_percobaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_percobaan" name="x_ket_rbd_percobaan" id="x_ket_rbd_percobaan" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ket_rbd_percobaan->getPlaceHolder()) ?>" value="<?= $Page->ket_rbd_percobaan->EditValue ?>"<?= $Page->ket_rbd_percobaan->editAttributes() ?> aria-describedby="x_ket_rbd_percobaan_help">
<?= $Page->ket_rbd_percobaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rbd_percobaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
    <div id="r_rbd_keinginan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rbd_keinginan->caption() ?><?= $Page->rbd_keinginan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rbd_keinginan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan">
<template id="tp_x_rbd_keinginan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rbd_keinginan" name="x_rbd_keinginan" id="x_rbd_keinginan"<?= $Page->rbd_keinginan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rbd_keinginan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rbd_keinginan"
    name="x_rbd_keinginan"
    value="<?= HtmlEncode($Page->rbd_keinginan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rbd_keinginan"
    data-target="dsl_x_rbd_keinginan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rbd_keinginan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rbd_keinginan"
    data-value-separator="<?= $Page->rbd_keinginan->displayValueSeparatorAttribute() ?>"
    <?= $Page->rbd_keinginan->editAttributes() ?>>
<?= $Page->rbd_keinginan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rbd_keinginan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
    <div id="r_ket_rbd_keinginan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" for="x_ket_rbd_keinginan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rbd_keinginan->caption() ?><?= $Page->ket_rbd_keinginan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rbd_keinginan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan">
<input type="<?= $Page->ket_rbd_keinginan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rbd_keinginan" name="x_ket_rbd_keinginan" id="x_ket_rbd_keinginan" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ket_rbd_keinginan->getPlaceHolder()) ?>" value="<?= $Page->ket_rbd_keinginan->EditValue ?>"<?= $Page->ket_rbd_keinginan->editAttributes() ?> aria-describedby="x_ket_rbd_keinginan_help">
<?= $Page->ket_rbd_keinginan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rbd_keinginan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
    <div id="r_rpo_penggunaan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo_penggunaan->caption() ?><?= $Page->rpo_penggunaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo_penggunaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan">
<template id="tp_x_rpo_penggunaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan" name="x_rpo_penggunaan" id="x_rpo_penggunaan"<?= $Page->rpo_penggunaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rpo_penggunaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rpo_penggunaan"
    name="x_rpo_penggunaan"
    value="<?= HtmlEncode($Page->rpo_penggunaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rpo_penggunaan"
    data-target="dsl_x_rpo_penggunaan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rpo_penggunaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan"
    data-value-separator="<?= $Page->rpo_penggunaan->displayValueSeparatorAttribute() ?>"
    <?= $Page->rpo_penggunaan->editAttributes() ?>>
<?= $Page->rpo_penggunaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo_penggunaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
    <div id="r_ket_rpo_penggunaan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" for="x_ket_rpo_penggunaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rpo_penggunaan->caption() ?><?= $Page->ket_rpo_penggunaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rpo_penggunaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan">
<input type="<?= $Page->ket_rpo_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_penggunaan" name="x_ket_rpo_penggunaan" id="x_ket_rpo_penggunaan" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->ket_rpo_penggunaan->getPlaceHolder()) ?>" value="<?= $Page->ket_rpo_penggunaan->EditValue ?>"<?= $Page->ket_rpo_penggunaan->editAttributes() ?> aria-describedby="x_ket_rpo_penggunaan_help">
<?= $Page->ket_rpo_penggunaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rpo_penggunaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
    <div id="r_rpo_efek_samping" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo_efek_samping->caption() ?><?= $Page->rpo_efek_samping->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo_efek_samping->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping">
<template id="tp_x_rpo_efek_samping">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_efek_samping" name="x_rpo_efek_samping" id="x_rpo_efek_samping"<?= $Page->rpo_efek_samping->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rpo_efek_samping" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rpo_efek_samping"
    name="x_rpo_efek_samping"
    value="<?= HtmlEncode($Page->rpo_efek_samping->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rpo_efek_samping"
    data-target="dsl_x_rpo_efek_samping"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rpo_efek_samping->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_efek_samping"
    data-value-separator="<?= $Page->rpo_efek_samping->displayValueSeparatorAttribute() ?>"
    <?= $Page->rpo_efek_samping->editAttributes() ?>>
<?= $Page->rpo_efek_samping->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo_efek_samping->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
    <div id="r_ket_rpo_efek_samping" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" for="x_ket_rpo_efek_samping" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rpo_efek_samping->caption() ?><?= $Page->ket_rpo_efek_samping->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rpo_efek_samping->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping">
<input type="<?= $Page->ket_rpo_efek_samping->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_efek_samping" name="x_ket_rpo_efek_samping" id="x_ket_rpo_efek_samping" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->ket_rpo_efek_samping->getPlaceHolder()) ?>" value="<?= $Page->ket_rpo_efek_samping->EditValue ?>"<?= $Page->ket_rpo_efek_samping->editAttributes() ?> aria-describedby="x_ket_rpo_efek_samping_help">
<?= $Page->ket_rpo_efek_samping->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rpo_efek_samping->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
    <div id="r_rpo_napza" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo_napza->caption() ?><?= $Page->rpo_napza->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo_napza->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza">
<template id="tp_x_rpo_napza">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_napza" name="x_rpo_napza" id="x_rpo_napza"<?= $Page->rpo_napza->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rpo_napza" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rpo_napza"
    name="x_rpo_napza"
    value="<?= HtmlEncode($Page->rpo_napza->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rpo_napza"
    data-target="dsl_x_rpo_napza"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rpo_napza->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_napza"
    data-value-separator="<?= $Page->rpo_napza->displayValueSeparatorAttribute() ?>"
    <?= $Page->rpo_napza->editAttributes() ?>>
<?= $Page->rpo_napza->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo_napza->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
    <div id="r_ket_rpo_napza" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" for="x_ket_rpo_napza" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_rpo_napza->caption() ?><?= $Page->ket_rpo_napza->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_rpo_napza->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza">
<input type="<?= $Page->ket_rpo_napza->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_rpo_napza" name="x_ket_rpo_napza" id="x_ket_rpo_napza" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->ket_rpo_napza->getPlaceHolder()) ?>" value="<?= $Page->ket_rpo_napza->EditValue ?>"<?= $Page->ket_rpo_napza->editAttributes() ?> aria-describedby="x_ket_rpo_napza_help">
<?= $Page->ket_rpo_napza->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_rpo_napza->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
    <div id="r_ket_lama_pemakaian" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" for="x_ket_lama_pemakaian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_lama_pemakaian->caption() ?><?= $Page->ket_lama_pemakaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_lama_pemakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian">
<input type="<?= $Page->ket_lama_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lama_pemakaian" name="x_ket_lama_pemakaian" id="x_ket_lama_pemakaian" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->ket_lama_pemakaian->getPlaceHolder()) ?>" value="<?= $Page->ket_lama_pemakaian->EditValue ?>"<?= $Page->ket_lama_pemakaian->editAttributes() ?> aria-describedby="x_ket_lama_pemakaian_help">
<?= $Page->ket_lama_pemakaian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_lama_pemakaian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
    <div id="r_ket_cara_pemakaian" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" for="x_ket_cara_pemakaian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_cara_pemakaian->caption() ?><?= $Page->ket_cara_pemakaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_cara_pemakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian">
<input type="<?= $Page->ket_cara_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_cara_pemakaian" name="x_ket_cara_pemakaian" id="x_ket_cara_pemakaian" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ket_cara_pemakaian->getPlaceHolder()) ?>" value="<?= $Page->ket_cara_pemakaian->EditValue ?>"<?= $Page->ket_cara_pemakaian->editAttributes() ?> aria-describedby="x_ket_cara_pemakaian_help">
<?= $Page->ket_cara_pemakaian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_cara_pemakaian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
    <div id="r_ket_latar_belakang_pemakaian" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" for="x_ket_latar_belakang_pemakaian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_latar_belakang_pemakaian->caption() ?><?= $Page->ket_latar_belakang_pemakaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_latar_belakang_pemakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian">
<input type="<?= $Page->ket_latar_belakang_pemakaian->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_latar_belakang_pemakaian" name="x_ket_latar_belakang_pemakaian" id="x_ket_latar_belakang_pemakaian" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->ket_latar_belakang_pemakaian->getPlaceHolder()) ?>" value="<?= $Page->ket_latar_belakang_pemakaian->EditValue ?>"<?= $Page->ket_latar_belakang_pemakaian->editAttributes() ?> aria-describedby="x_ket_latar_belakang_pemakaian_help">
<?= $Page->ket_latar_belakang_pemakaian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_latar_belakang_pemakaian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
    <div id="r_rpo_penggunaan_obat_lainnya" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo_penggunaan_obat_lainnya->caption() ?><?= $Page->rpo_penggunaan_obat_lainnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya">
<template id="tp_x_rpo_penggunaan_obat_lainnya">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_penggunaan_obat_lainnya" name="x_rpo_penggunaan_obat_lainnya" id="x_rpo_penggunaan_obat_lainnya"<?= $Page->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rpo_penggunaan_obat_lainnya" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rpo_penggunaan_obat_lainnya"
    name="x_rpo_penggunaan_obat_lainnya"
    value="<?= HtmlEncode($Page->rpo_penggunaan_obat_lainnya->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rpo_penggunaan_obat_lainnya"
    data-target="dsl_x_rpo_penggunaan_obat_lainnya"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rpo_penggunaan_obat_lainnya->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_penggunaan_obat_lainnya"
    data-value-separator="<?= $Page->rpo_penggunaan_obat_lainnya->displayValueSeparatorAttribute() ?>"
    <?= $Page->rpo_penggunaan_obat_lainnya->editAttributes() ?>>
<?= $Page->rpo_penggunaan_obat_lainnya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
    <div id="r_ket_penggunaan_obat_lainnya" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" for="x_ket_penggunaan_obat_lainnya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_penggunaan_obat_lainnya->caption() ?><?= $Page->ket_penggunaan_obat_lainnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya">
<input type="<?= $Page->ket_penggunaan_obat_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_penggunaan_obat_lainnya" name="x_ket_penggunaan_obat_lainnya" id="x_ket_penggunaan_obat_lainnya" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->ket_penggunaan_obat_lainnya->getPlaceHolder()) ?>" value="<?= $Page->ket_penggunaan_obat_lainnya->EditValue ?>"<?= $Page->ket_penggunaan_obat_lainnya->editAttributes() ?> aria-describedby="x_ket_penggunaan_obat_lainnya_help">
<?= $Page->ket_penggunaan_obat_lainnya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_penggunaan_obat_lainnya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
    <div id="r_ket_alasan_penggunaan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" for="x_ket_alasan_penggunaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_alasan_penggunaan->caption() ?><?= $Page->ket_alasan_penggunaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_alasan_penggunaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan">
<input type="<?= $Page->ket_alasan_penggunaan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alasan_penggunaan" name="x_ket_alasan_penggunaan" id="x_ket_alasan_penggunaan" size="30" maxlength="65" placeholder="<?= HtmlEncode($Page->ket_alasan_penggunaan->getPlaceHolder()) ?>" value="<?= $Page->ket_alasan_penggunaan->EditValue ?>"<?= $Page->ket_alasan_penggunaan->editAttributes() ?> aria-describedby="x_ket_alasan_penggunaan_help">
<?= $Page->ket_alasan_penggunaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_alasan_penggunaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
    <div id="r_rpo_alergi_obat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo_alergi_obat->caption() ?><?= $Page->rpo_alergi_obat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo_alergi_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat">
<template id="tp_x_rpo_alergi_obat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_alergi_obat" name="x_rpo_alergi_obat" id="x_rpo_alergi_obat"<?= $Page->rpo_alergi_obat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rpo_alergi_obat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rpo_alergi_obat"
    name="x_rpo_alergi_obat"
    value="<?= HtmlEncode($Page->rpo_alergi_obat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rpo_alergi_obat"
    data-target="dsl_x_rpo_alergi_obat"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rpo_alergi_obat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_alergi_obat"
    data-value-separator="<?= $Page->rpo_alergi_obat->displayValueSeparatorAttribute() ?>"
    <?= $Page->rpo_alergi_obat->editAttributes() ?>>
<?= $Page->rpo_alergi_obat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo_alergi_obat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
    <div id="r_ket_alergi_obat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" for="x_ket_alergi_obat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_alergi_obat->caption() ?><?= $Page->ket_alergi_obat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_alergi_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat">
<input type="<?= $Page->ket_alergi_obat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_alergi_obat" name="x_ket_alergi_obat" id="x_ket_alergi_obat" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->ket_alergi_obat->getPlaceHolder()) ?>" value="<?= $Page->ket_alergi_obat->EditValue ?>"<?= $Page->ket_alergi_obat->editAttributes() ?> aria-describedby="x_ket_alergi_obat_help">
<?= $Page->ket_alergi_obat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_alergi_obat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
    <div id="r_rpo_merokok" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo_merokok->caption() ?><?= $Page->rpo_merokok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo_merokok->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok">
<template id="tp_x_rpo_merokok">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_merokok" name="x_rpo_merokok" id="x_rpo_merokok"<?= $Page->rpo_merokok->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rpo_merokok" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rpo_merokok"
    name="x_rpo_merokok"
    value="<?= HtmlEncode($Page->rpo_merokok->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rpo_merokok"
    data-target="dsl_x_rpo_merokok"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rpo_merokok->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_merokok"
    data-value-separator="<?= $Page->rpo_merokok->displayValueSeparatorAttribute() ?>"
    <?= $Page->rpo_merokok->editAttributes() ?>>
<?= $Page->rpo_merokok->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo_merokok->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
    <div id="r_ket_merokok" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" for="x_ket_merokok" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_merokok->caption() ?><?= $Page->ket_merokok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_merokok->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok">
<input type="<?= $Page->ket_merokok->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_merokok" name="x_ket_merokok" id="x_ket_merokok" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->ket_merokok->getPlaceHolder()) ?>" value="<?= $Page->ket_merokok->EditValue ?>"<?= $Page->ket_merokok->editAttributes() ?> aria-describedby="x_ket_merokok_help">
<?= $Page->ket_merokok->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_merokok->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
    <div id="r_rpo_minum_kopi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo_minum_kopi->caption() ?><?= $Page->rpo_minum_kopi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo_minum_kopi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi">
<template id="tp_x_rpo_minum_kopi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rpo_minum_kopi" name="x_rpo_minum_kopi" id="x_rpo_minum_kopi"<?= $Page->rpo_minum_kopi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rpo_minum_kopi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rpo_minum_kopi"
    name="x_rpo_minum_kopi"
    value="<?= HtmlEncode($Page->rpo_minum_kopi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rpo_minum_kopi"
    data-target="dsl_x_rpo_minum_kopi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rpo_minum_kopi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_rpo_minum_kopi"
    data-value-separator="<?= $Page->rpo_minum_kopi->displayValueSeparatorAttribute() ?>"
    <?= $Page->rpo_minum_kopi->editAttributes() ?>>
<?= $Page->rpo_minum_kopi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo_minum_kopi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
    <div id="r_ket_minum_kopi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" for="x_ket_minum_kopi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_minum_kopi->caption() ?><?= $Page->ket_minum_kopi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_minum_kopi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi">
<input type="<?= $Page->ket_minum_kopi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_minum_kopi" name="x_ket_minum_kopi" id="x_ket_minum_kopi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->ket_minum_kopi->getPlaceHolder()) ?>" value="<?= $Page->ket_minum_kopi->EditValue ?>"<?= $Page->ket_minum_kopi->editAttributes() ?> aria-describedby="x_ket_minum_kopi_help">
<?= $Page->ket_minum_kopi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_minum_kopi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <div id="r_td" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_td" for="x_td" class="<?= $Page->LeftColumnClass ?>"><?= $Page->td->caption() ?><?= $Page->td->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_td">
<input type="<?= $Page->td->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_td" name="x_td" id="x_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->td->getPlaceHolder()) ?>" value="<?= $Page->td->EditValue ?>"<?= $Page->td->editAttributes() ?> aria-describedby="x_td_help">
<?= $Page->td->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->td->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <div id="r_nadi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nadi" for="x_nadi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nadi->caption() ?><?= $Page->nadi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nadi">
<input type="<?= $Page->nadi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nadi" name="x_nadi" id="x_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->nadi->getPlaceHolder()) ?>" value="<?= $Page->nadi->EditValue ?>"<?= $Page->nadi->editAttributes() ?> aria-describedby="x_nadi_help">
<?= $Page->nadi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nadi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <div id="r_gcs" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_gcs" for="x_gcs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gcs->caption() ?><?= $Page->gcs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_gcs">
<input type="<?= $Page->gcs->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_gcs" name="x_gcs" id="x_gcs" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->gcs->getPlaceHolder()) ?>" value="<?= $Page->gcs->EditValue ?>"<?= $Page->gcs->editAttributes() ?> aria-describedby="x_gcs_help">
<?= $Page->gcs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gcs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <div id="r_rr" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rr" for="x_rr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rr->caption() ?><?= $Page->rr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rr">
<input type="<?= $Page->rr->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rr" name="x_rr" id="x_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->rr->getPlaceHolder()) ?>" value="<?= $Page->rr->EditValue ?>"<?= $Page->rr->editAttributes() ?> aria-describedby="x_rr_help">
<?= $Page->rr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <div id="r_suhu" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_suhu" for="x_suhu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suhu->caption() ?><?= $Page->suhu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_suhu">
<input type="<?= $Page->suhu->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_suhu" name="x_suhu" id="x_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->suhu->getPlaceHolder()) ?>" value="<?= $Page->suhu->EditValue ?>"<?= $Page->suhu->editAttributes() ?> aria-describedby="x_suhu_help">
<?= $Page->suhu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->suhu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
    <div id="r_pf_keluhan_fisik" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pf_keluhan_fisik->caption() ?><?= $Page->pf_keluhan_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pf_keluhan_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik">
<template id="tp_x_pf_keluhan_fisik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pf_keluhan_fisik" name="x_pf_keluhan_fisik" id="x_pf_keluhan_fisik"<?= $Page->pf_keluhan_fisik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_pf_keluhan_fisik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_pf_keluhan_fisik"
    name="x_pf_keluhan_fisik"
    value="<?= HtmlEncode($Page->pf_keluhan_fisik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_pf_keluhan_fisik"
    data-target="dsl_x_pf_keluhan_fisik"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pf_keluhan_fisik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pf_keluhan_fisik"
    data-value-separator="<?= $Page->pf_keluhan_fisik->displayValueSeparatorAttribute() ?>"
    <?= $Page->pf_keluhan_fisik->editAttributes() ?>>
<?= $Page->pf_keluhan_fisik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pf_keluhan_fisik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
    <div id="r_ket_keluhan_fisik" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" for="x_ket_keluhan_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_keluhan_fisik->caption() ?><?= $Page->ket_keluhan_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_keluhan_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik">
<input type="<?= $Page->ket_keluhan_fisik->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_keluhan_fisik" name="x_ket_keluhan_fisik" id="x_ket_keluhan_fisik" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ket_keluhan_fisik->getPlaceHolder()) ?>" value="<?= $Page->ket_keluhan_fisik->EditValue ?>"<?= $Page->ket_keluhan_fisik->editAttributes() ?> aria-describedby="x_ket_keluhan_fisik_help">
<?= $Page->ket_keluhan_fisik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_keluhan_fisik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
    <div id="r_skala_nyeri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skala_nyeri->caption() ?><?= $Page->skala_nyeri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skala_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri">
<template id="tp_x_skala_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_skala_nyeri" name="x_skala_nyeri" id="x_skala_nyeri"<?= $Page->skala_nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_skala_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_skala_nyeri"
    name="x_skala_nyeri"
    value="<?= HtmlEncode($Page->skala_nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_skala_nyeri"
    data-target="dsl_x_skala_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Page->skala_nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_skala_nyeri"
    data-value-separator="<?= $Page->skala_nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Page->skala_nyeri->editAttributes() ?>>
<?= $Page->skala_nyeri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skala_nyeri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
    <div id="r_durasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_durasi" for="x_durasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->durasi->caption() ?><?= $Page->durasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->durasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_durasi">
<input type="<?= $Page->durasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_durasi" name="x_durasi" id="x_durasi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->durasi->getPlaceHolder()) ?>" value="<?= $Page->durasi->EditValue ?>"<?= $Page->durasi->editAttributes() ?> aria-describedby="x_durasi_help">
<?= $Page->durasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->durasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
    <div id="r_nyeri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nyeri->caption() ?><?= $Page->nyeri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nyeri">
<template id="tp_x_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri" name="x_nyeri" id="x_nyeri"<?= $Page->nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_nyeri"
    name="x_nyeri"
    value="<?= HtmlEncode($Page->nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_nyeri"
    data-target="dsl_x_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Page->nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri"
    data-value-separator="<?= $Page->nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Page->nyeri->editAttributes() ?>>
<?= $Page->nyeri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nyeri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
    <div id="r_provokes" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->provokes->caption() ?><?= $Page->provokes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_provokes">
<template id="tp_x_provokes">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_provokes" name="x_provokes" id="x_provokes"<?= $Page->provokes->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_provokes" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_provokes"
    name="x_provokes"
    value="<?= HtmlEncode($Page->provokes->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_provokes"
    data-target="dsl_x_provokes"
    data-repeatcolumn="5"
    class="form-control<?= $Page->provokes->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_provokes"
    data-value-separator="<?= $Page->provokes->displayValueSeparatorAttribute() ?>"
    <?= $Page->provokes->editAttributes() ?>>
<?= $Page->provokes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->provokes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
    <div id="r_ket_provokes" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" for="x_ket_provokes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_provokes->caption() ?><?= $Page->ket_provokes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes">
<input type="<?= $Page->ket_provokes->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_provokes" name="x_ket_provokes" id="x_ket_provokes" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->ket_provokes->getPlaceHolder()) ?>" value="<?= $Page->ket_provokes->EditValue ?>"<?= $Page->ket_provokes->editAttributes() ?> aria-describedby="x_ket_provokes_help">
<?= $Page->ket_provokes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_provokes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
    <div id="r_quality" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quality->caption() ?><?= $Page->quality->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_quality">
<template id="tp_x_quality">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_quality" name="x_quality" id="x_quality"<?= $Page->quality->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_quality" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_quality"
    name="x_quality"
    value="<?= HtmlEncode($Page->quality->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_quality"
    data-target="dsl_x_quality"
    data-repeatcolumn="5"
    class="form-control<?= $Page->quality->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_quality"
    data-value-separator="<?= $Page->quality->displayValueSeparatorAttribute() ?>"
    <?= $Page->quality->editAttributes() ?>>
<?= $Page->quality->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quality->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
    <div id="r_ket_quality" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" for="x_ket_quality" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_quality->caption() ?><?= $Page->ket_quality->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality">
<input type="<?= $Page->ket_quality->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_quality" name="x_ket_quality" id="x_ket_quality" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_quality->getPlaceHolder()) ?>" value="<?= $Page->ket_quality->EditValue ?>"<?= $Page->ket_quality->editAttributes() ?> aria-describedby="x_ket_quality_help">
<?= $Page->ket_quality->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_quality->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <div id="r_lokasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" for="x_lokasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lokasi->caption() ?><?= $Page->lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lokasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_lokasi">
<input type="<?= $Page->lokasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lokasi" name="x_lokasi" id="x_lokasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>" value="<?= $Page->lokasi->EditValue ?>"<?= $Page->lokasi->editAttributes() ?> aria-describedby="x_lokasi_help">
<?= $Page->lokasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
    <div id="r_menyebar" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menyebar->caption() ?><?= $Page->menyebar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menyebar->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_menyebar">
<template id="tp_x_menyebar">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_menyebar" name="x_menyebar" id="x_menyebar"<?= $Page->menyebar->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_menyebar" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_menyebar"
    name="x_menyebar"
    value="<?= HtmlEncode($Page->menyebar->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_menyebar"
    data-target="dsl_x_menyebar"
    data-repeatcolumn="5"
    class="form-control<?= $Page->menyebar->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_menyebar"
    data-value-separator="<?= $Page->menyebar->displayValueSeparatorAttribute() ?>"
    <?= $Page->menyebar->editAttributes() ?>>
<?= $Page->menyebar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menyebar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
    <div id="r_pada_dokter" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pada_dokter->caption() ?><?= $Page->pada_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pada_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter">
<template id="tp_x_pada_dokter">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_pada_dokter" name="x_pada_dokter" id="x_pada_dokter"<?= $Page->pada_dokter->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_pada_dokter" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_pada_dokter"
    name="x_pada_dokter"
    value="<?= HtmlEncode($Page->pada_dokter->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_pada_dokter"
    data-target="dsl_x_pada_dokter"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pada_dokter->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_pada_dokter"
    data-value-separator="<?= $Page->pada_dokter->displayValueSeparatorAttribute() ?>"
    <?= $Page->pada_dokter->editAttributes() ?>>
<?= $Page->pada_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pada_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
    <div id="r_ket_dokter" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" for="x_ket_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_dokter->caption() ?><?= $Page->ket_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter">
<input type="<?= $Page->ket_dokter->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_dokter" name="x_ket_dokter" id="x_ket_dokter" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ket_dokter->getPlaceHolder()) ?>" value="<?= $Page->ket_dokter->EditValue ?>"<?= $Page->ket_dokter->editAttributes() ?> aria-describedby="x_ket_dokter_help">
<?= $Page->ket_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
    <div id="r_nyeri_hilang" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nyeri_hilang->caption() ?><?= $Page->nyeri_hilang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nyeri_hilang->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang">
<template id="tp_x_nyeri_hilang">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nyeri_hilang" name="x_nyeri_hilang" id="x_nyeri_hilang"<?= $Page->nyeri_hilang->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_nyeri_hilang" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_nyeri_hilang"
    name="x_nyeri_hilang"
    value="<?= HtmlEncode($Page->nyeri_hilang->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_nyeri_hilang"
    data-target="dsl_x_nyeri_hilang"
    data-repeatcolumn="5"
    class="form-control<?= $Page->nyeri_hilang->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nyeri_hilang"
    data-value-separator="<?= $Page->nyeri_hilang->displayValueSeparatorAttribute() ?>"
    <?= $Page->nyeri_hilang->editAttributes() ?>>
<?= $Page->nyeri_hilang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nyeri_hilang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
    <div id="r_ket_nyeri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" for="x_ket_nyeri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_nyeri->caption() ?><?= $Page->ket_nyeri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri">
<input type="<?= $Page->ket_nyeri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_nyeri" name="x_ket_nyeri" id="x_ket_nyeri" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->ket_nyeri->getPlaceHolder()) ?>" value="<?= $Page->ket_nyeri->EditValue ?>"<?= $Page->ket_nyeri->editAttributes() ?> aria-describedby="x_ket_nyeri_help">
<?= $Page->ket_nyeri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_nyeri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <div id="r_bb" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bb" for="x_bb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bb->caption() ?><?= $Page->bb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_bb">
<input type="<?= $Page->bb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bb" name="x_bb" id="x_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->bb->getPlaceHolder()) ?>" value="<?= $Page->bb->EditValue ?>"<?= $Page->bb->editAttributes() ?> aria-describedby="x_bb_help">
<?= $Page->bb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <div id="r_tb" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tb" for="x_tb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tb->caption() ?><?= $Page->tb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_tb">
<input type="<?= $Page->tb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_tb" name="x_tb" id="x_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->tb->getPlaceHolder()) ?>" value="<?= $Page->tb->EditValue ?>"<?= $Page->tb->editAttributes() ?> aria-describedby="x_tb_help">
<?= $Page->tb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
    <div id="r_bmi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bmi" for="x_bmi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bmi->caption() ?><?= $Page->bmi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bmi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_bmi">
<input type="<?= $Page->bmi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bmi" name="x_bmi" id="x_bmi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->bmi->getPlaceHolder()) ?>" value="<?= $Page->bmi->EditValue ?>"<?= $Page->bmi->editAttributes() ?> aria-describedby="x_bmi_help">
<?= $Page->bmi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bmi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
    <div id="r_lapor_status_nutrisi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lapor_status_nutrisi->caption() ?><?= $Page->lapor_status_nutrisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lapor_status_nutrisi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi">
<template id="tp_x_lapor_status_nutrisi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor_status_nutrisi" name="x_lapor_status_nutrisi" id="x_lapor_status_nutrisi"<?= $Page->lapor_status_nutrisi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_lapor_status_nutrisi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_lapor_status_nutrisi"
    name="x_lapor_status_nutrisi"
    value="<?= HtmlEncode($Page->lapor_status_nutrisi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_lapor_status_nutrisi"
    data-target="dsl_x_lapor_status_nutrisi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->lapor_status_nutrisi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor_status_nutrisi"
    data-value-separator="<?= $Page->lapor_status_nutrisi->displayValueSeparatorAttribute() ?>"
    <?= $Page->lapor_status_nutrisi->editAttributes() ?>>
<?= $Page->lapor_status_nutrisi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
    <div id="r_ket_lapor_status_nutrisi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" for="x_ket_lapor_status_nutrisi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_lapor_status_nutrisi->caption() ?><?= $Page->ket_lapor_status_nutrisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_lapor_status_nutrisi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi">
<input type="<?= $Page->ket_lapor_status_nutrisi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor_status_nutrisi" name="x_ket_lapor_status_nutrisi" id="x_ket_lapor_status_nutrisi" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ket_lapor_status_nutrisi->getPlaceHolder()) ?>" value="<?= $Page->ket_lapor_status_nutrisi->EditValue ?>"<?= $Page->ket_lapor_status_nutrisi->editAttributes() ?> aria-describedby="x_ket_lapor_status_nutrisi_help">
<?= $Page->ket_lapor_status_nutrisi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_lapor_status_nutrisi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
    <div id="r_sg1" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sg1->caption() ?><?= $Page->sg1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sg1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sg1">
<template id="tp_x_sg1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg1" name="x_sg1" id="x_sg1"<?= $Page->sg1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sg1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sg1"
    name="x_sg1"
    value="<?= HtmlEncode($Page->sg1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sg1"
    data-target="dsl_x_sg1"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sg1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg1"
    data-value-separator="<?= $Page->sg1->displayValueSeparatorAttribute() ?>"
    <?= $Page->sg1->editAttributes() ?>>
<?= $Page->sg1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sg1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
    <div id="r_nilai1" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nilai1->caption() ?><?= $Page->nilai1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nilai1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nilai1">
<template id="tp_x_nilai1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai1" name="x_nilai1" id="x_nilai1"<?= $Page->nilai1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_nilai1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_nilai1"
    name="x_nilai1"
    value="<?= HtmlEncode($Page->nilai1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_nilai1"
    data-target="dsl_x_nilai1"
    data-repeatcolumn="5"
    class="form-control<?= $Page->nilai1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_nilai1"
    data-value-separator="<?= $Page->nilai1->displayValueSeparatorAttribute() ?>"
    <?= $Page->nilai1->editAttributes() ?>>
<?= $Page->nilai1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nilai1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
    <div id="r_sg2" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sg2->caption() ?><?= $Page->sg2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sg2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sg2">
<template id="tp_x_sg2">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sg2" name="x_sg2" id="x_sg2"<?= $Page->sg2->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sg2" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sg2"
    name="x_sg2"
    value="<?= HtmlEncode($Page->sg2->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sg2"
    data-target="dsl_x_sg2"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sg2->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sg2"
    data-value-separator="<?= $Page->sg2->displayValueSeparatorAttribute() ?>"
    <?= $Page->sg2->editAttributes() ?>>
<?= $Page->sg2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sg2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
    <div id="r_nilai2" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nilai2->caption() ?><?= $Page->nilai2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nilai2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nilai2">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->nilai2->isInvalidClass() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nilai2" name="x_nilai2[]" id="x_nilai2_607153" value="1"<?= ConvertToBool($Page->nilai2->CurrentValue) ? " checked" : "" ?><?= $Page->nilai2->editAttributes() ?> aria-describedby="x_nilai2_help">
    <label class="custom-control-label" for="x_nilai2_607153"></label>
</div>
<?= $Page->nilai2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nilai2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
    <div id="r_total_hasil" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" for="x_total_hasil" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_hasil->caption() ?><?= $Page->total_hasil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->total_hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil">
<input type="<?= $Page->total_hasil->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_total_hasil" name="x_total_hasil" id="x_total_hasil" size="30" placeholder="<?= HtmlEncode($Page->total_hasil->getPlaceHolder()) ?>" value="<?= $Page->total_hasil->EditValue ?>"<?= $Page->total_hasil->editAttributes() ?> aria-describedby="x_total_hasil_help">
<?= $Page->total_hasil->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_hasil->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
    <div id="r_resikojatuh" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resikojatuh->caption() ?><?= $Page->resikojatuh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resikojatuh->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh">
<template id="tp_x_resikojatuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_resikojatuh" name="x_resikojatuh" id="x_resikojatuh"<?= $Page->resikojatuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_resikojatuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_resikojatuh"
    name="x_resikojatuh"
    value="<?= HtmlEncode($Page->resikojatuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_resikojatuh"
    data-target="dsl_x_resikojatuh"
    data-repeatcolumn="5"
    class="form-control<?= $Page->resikojatuh->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_resikojatuh"
    data-value-separator="<?= $Page->resikojatuh->displayValueSeparatorAttribute() ?>"
    <?= $Page->resikojatuh->editAttributes() ?>>
<?= $Page->resikojatuh->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resikojatuh->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bjm->Visible) { // bjm ?>
    <div id="r_bjm" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bjm->caption() ?><?= $Page->bjm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bjm->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_bjm">
<template id="tp_x_bjm">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_bjm" name="x_bjm" id="x_bjm"<?= $Page->bjm->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_bjm" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_bjm"
    name="x_bjm"
    value="<?= HtmlEncode($Page->bjm->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_bjm"
    data-target="dsl_x_bjm"
    data-repeatcolumn="5"
    class="form-control<?= $Page->bjm->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_bjm"
    data-value-separator="<?= $Page->bjm->displayValueSeparatorAttribute() ?>"
    <?= $Page->bjm->editAttributes() ?>>
<?= $Page->bjm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bjm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->msa->Visible) { // msa ?>
    <div id="r_msa" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->msa->caption() ?><?= $Page->msa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->msa->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_msa">
<template id="tp_x_msa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_msa" name="x_msa" id="x_msa"<?= $Page->msa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_msa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_msa"
    name="x_msa"
    value="<?= HtmlEncode($Page->msa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_msa"
    data-target="dsl_x_msa"
    data-repeatcolumn="5"
    class="form-control<?= $Page->msa->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_msa"
    data-value-separator="<?= $Page->msa->displayValueSeparatorAttribute() ?>"
    <?= $Page->msa->editAttributes() ?>>
<?= $Page->msa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->msa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
    <div id="r_hasil" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hasil->caption() ?><?= $Page->hasil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_hasil">
<template id="tp_x_hasil">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_hasil" name="x_hasil" id="x_hasil"<?= $Page->hasil->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_hasil" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_hasil"
    name="x_hasil"
    value="<?= HtmlEncode($Page->hasil->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_hasil"
    data-target="dsl_x_hasil"
    data-repeatcolumn="5"
    class="form-control<?= $Page->hasil->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_hasil"
    data-value-separator="<?= $Page->hasil->displayValueSeparatorAttribute() ?>"
    <?= $Page->hasil->editAttributes() ?>>
<?= $Page->hasil->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hasil->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
    <div id="r_lapor" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lapor->caption() ?><?= $Page->lapor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_lapor">
<template id="tp_x_lapor">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_lapor" name="x_lapor" id="x_lapor"<?= $Page->lapor->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_lapor" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_lapor"
    name="x_lapor"
    value="<?= HtmlEncode($Page->lapor->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_lapor"
    data-target="dsl_x_lapor"
    data-repeatcolumn="5"
    class="form-control<?= $Page->lapor->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_lapor"
    data-value-separator="<?= $Page->lapor->displayValueSeparatorAttribute() ?>"
    <?= $Page->lapor->editAttributes() ?>>
<?= $Page->lapor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lapor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
    <div id="r_ket_lapor" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" for="x_ket_lapor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_lapor->caption() ?><?= $Page->ket_lapor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor">
<input type="<?= $Page->ket_lapor->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_lapor" name="x_ket_lapor" id="x_ket_lapor" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ket_lapor->getPlaceHolder()) ?>" value="<?= $Page->ket_lapor->EditValue ?>"<?= $Page->ket_lapor->editAttributes() ?> aria-describedby="x_ket_lapor_help">
<?= $Page->ket_lapor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_lapor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
    <div id="r_adl_mandi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_mandi->caption() ?><?= $Page->adl_mandi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_mandi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi">
<template id="tp_x_adl_mandi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_mandi" name="x_adl_mandi" id="x_adl_mandi"<?= $Page->adl_mandi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_mandi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_mandi"
    name="x_adl_mandi"
    value="<?= HtmlEncode($Page->adl_mandi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_mandi"
    data-target="dsl_x_adl_mandi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_mandi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_mandi"
    data-value-separator="<?= $Page->adl_mandi->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_mandi->editAttributes() ?>>
<?= $Page->adl_mandi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_mandi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
    <div id="r_adl_berpakaian" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_berpakaian->caption() ?><?= $Page->adl_berpakaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_berpakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian">
<template id="tp_x_adl_berpakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_berpakaian" name="x_adl_berpakaian" id="x_adl_berpakaian"<?= $Page->adl_berpakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_berpakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_berpakaian"
    name="x_adl_berpakaian"
    value="<?= HtmlEncode($Page->adl_berpakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_berpakaian"
    data-target="dsl_x_adl_berpakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_berpakaian->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_berpakaian"
    data-value-separator="<?= $Page->adl_berpakaian->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_berpakaian->editAttributes() ?>>
<?= $Page->adl_berpakaian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_berpakaian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_makan->Visible) { // adl_makan ?>
    <div id="r_adl_makan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_makan->caption() ?><?= $Page->adl_makan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_makan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan">
<template id="tp_x_adl_makan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_makan" name="x_adl_makan" id="x_adl_makan"<?= $Page->adl_makan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_makan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_makan"
    name="x_adl_makan"
    value="<?= HtmlEncode($Page->adl_makan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_makan"
    data-target="dsl_x_adl_makan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_makan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_makan"
    data-value-separator="<?= $Page->adl_makan->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_makan->editAttributes() ?>>
<?= $Page->adl_makan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_makan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_bak->Visible) { // adl_bak ?>
    <div id="r_adl_bak" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_bak->caption() ?><?= $Page->adl_bak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_bak->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak">
<template id="tp_x_adl_bak">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bak" name="x_adl_bak" id="x_adl_bak"<?= $Page->adl_bak->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_bak" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_bak"
    name="x_adl_bak"
    value="<?= HtmlEncode($Page->adl_bak->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_bak"
    data-target="dsl_x_adl_bak"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_bak->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bak"
    data-value-separator="<?= $Page->adl_bak->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_bak->editAttributes() ?>>
<?= $Page->adl_bak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_bak->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_bab->Visible) { // adl_bab ?>
    <div id="r_adl_bab" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_bab->caption() ?><?= $Page->adl_bab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_bab->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab">
<template id="tp_x_adl_bab">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_bab" name="x_adl_bab" id="x_adl_bab"<?= $Page->adl_bab->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_bab" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_bab"
    name="x_adl_bab"
    value="<?= HtmlEncode($Page->adl_bab->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_bab"
    data-target="dsl_x_adl_bab"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_bab->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_bab"
    data-value-separator="<?= $Page->adl_bab->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_bab->editAttributes() ?>>
<?= $Page->adl_bab->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_bab->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
    <div id="r_adl_hobi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_hobi->caption() ?><?= $Page->adl_hobi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_hobi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi">
<template id="tp_x_adl_hobi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_hobi" name="x_adl_hobi" id="x_adl_hobi"<?= $Page->adl_hobi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_hobi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_hobi"
    name="x_adl_hobi"
    value="<?= HtmlEncode($Page->adl_hobi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_hobi"
    data-target="dsl_x_adl_hobi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_hobi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_hobi"
    data-value-separator="<?= $Page->adl_hobi->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_hobi->editAttributes() ?>>
<?= $Page->adl_hobi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_hobi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
    <div id="r_ket_adl_hobi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" for="x_ket_adl_hobi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_adl_hobi->caption() ?><?= $Page->ket_adl_hobi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_adl_hobi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi">
<input type="<?= $Page->ket_adl_hobi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_hobi" name="x_ket_adl_hobi" id="x_ket_adl_hobi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_adl_hobi->getPlaceHolder()) ?>" value="<?= $Page->ket_adl_hobi->EditValue ?>"<?= $Page->ket_adl_hobi->editAttributes() ?> aria-describedby="x_ket_adl_hobi_help">
<?= $Page->ket_adl_hobi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_adl_hobi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
    <div id="r_adl_sosialisasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_sosialisasi->caption() ?><?= $Page->adl_sosialisasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_sosialisasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi">
<template id="tp_x_adl_sosialisasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_sosialisasi" name="x_adl_sosialisasi" id="x_adl_sosialisasi"<?= $Page->adl_sosialisasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_sosialisasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_sosialisasi"
    name="x_adl_sosialisasi"
    value="<?= HtmlEncode($Page->adl_sosialisasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_sosialisasi"
    data-target="dsl_x_adl_sosialisasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_sosialisasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_sosialisasi"
    data-value-separator="<?= $Page->adl_sosialisasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_sosialisasi->editAttributes() ?>>
<?= $Page->adl_sosialisasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_sosialisasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
    <div id="r_ket_adl_sosialisasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" for="x_ket_adl_sosialisasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_adl_sosialisasi->caption() ?><?= $Page->ket_adl_sosialisasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_adl_sosialisasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi">
<input type="<?= $Page->ket_adl_sosialisasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_sosialisasi" name="x_ket_adl_sosialisasi" id="x_ket_adl_sosialisasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_adl_sosialisasi->getPlaceHolder()) ?>" value="<?= $Page->ket_adl_sosialisasi->EditValue ?>"<?= $Page->ket_adl_sosialisasi->editAttributes() ?> aria-describedby="x_ket_adl_sosialisasi_help">
<?= $Page->ket_adl_sosialisasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_adl_sosialisasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
    <div id="r_adl_kegiatan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl_kegiatan->caption() ?><?= $Page->adl_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl_kegiatan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan">
<template id="tp_x_adl_kegiatan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_adl_kegiatan" name="x_adl_kegiatan" id="x_adl_kegiatan"<?= $Page->adl_kegiatan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl_kegiatan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl_kegiatan"
    name="x_adl_kegiatan"
    value="<?= HtmlEncode($Page->adl_kegiatan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl_kegiatan"
    data-target="dsl_x_adl_kegiatan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl_kegiatan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_adl_kegiatan"
    data-value-separator="<?= $Page->adl_kegiatan->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl_kegiatan->editAttributes() ?>>
<?= $Page->adl_kegiatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl_kegiatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
    <div id="r_ket_adl_kegiatan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" for="x_ket_adl_kegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_adl_kegiatan->caption() ?><?= $Page->ket_adl_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_adl_kegiatan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan">
<input type="<?= $Page->ket_adl_kegiatan->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_adl_kegiatan" name="x_ket_adl_kegiatan" id="x_ket_adl_kegiatan" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_adl_kegiatan->getPlaceHolder()) ?>" value="<?= $Page->ket_adl_kegiatan->EditValue ?>"<?= $Page->ket_adl_kegiatan->editAttributes() ?> aria-describedby="x_ket_adl_kegiatan_help">
<?= $Page->ket_adl_kegiatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_adl_kegiatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
    <div id="r_sk_penampilan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_penampilan->caption() ?><?= $Page->sk_penampilan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_penampilan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan">
<template id="tp_x_sk_penampilan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_penampilan" name="x_sk_penampilan" id="x_sk_penampilan"<?= $Page->sk_penampilan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_penampilan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_penampilan"
    name="x_sk_penampilan"
    value="<?= HtmlEncode($Page->sk_penampilan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_penampilan"
    data-target="dsl_x_sk_penampilan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_penampilan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_penampilan"
    data-value-separator="<?= $Page->sk_penampilan->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_penampilan->editAttributes() ?>>
<?= $Page->sk_penampilan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_penampilan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
    <div id="r_sk_alam_perasaan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_alam_perasaan->caption() ?><?= $Page->sk_alam_perasaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_alam_perasaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan">
<template id="tp_x_sk_alam_perasaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_alam_perasaan" name="x_sk_alam_perasaan" id="x_sk_alam_perasaan"<?= $Page->sk_alam_perasaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_alam_perasaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_alam_perasaan"
    name="x_sk_alam_perasaan"
    value="<?= HtmlEncode($Page->sk_alam_perasaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_alam_perasaan"
    data-target="dsl_x_sk_alam_perasaan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_alam_perasaan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_alam_perasaan"
    data-value-separator="<?= $Page->sk_alam_perasaan->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_alam_perasaan->editAttributes() ?>>
<?= $Page->sk_alam_perasaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_alam_perasaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
    <div id="r_sk_pembicaraan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_pembicaraan->caption() ?><?= $Page->sk_pembicaraan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_pembicaraan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan">
<template id="tp_x_sk_pembicaraan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_pembicaraan" name="x_sk_pembicaraan" id="x_sk_pembicaraan"<?= $Page->sk_pembicaraan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_pembicaraan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_pembicaraan"
    name="x_sk_pembicaraan"
    value="<?= HtmlEncode($Page->sk_pembicaraan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_pembicaraan"
    data-target="dsl_x_sk_pembicaraan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_pembicaraan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_pembicaraan"
    data-value-separator="<?= $Page->sk_pembicaraan->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_pembicaraan->editAttributes() ?>>
<?= $Page->sk_pembicaraan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_pembicaraan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_afek->Visible) { // sk_afek ?>
    <div id="r_sk_afek" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_afek->caption() ?><?= $Page->sk_afek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_afek->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek">
<template id="tp_x_sk_afek">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_afek" name="x_sk_afek" id="x_sk_afek"<?= $Page->sk_afek->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_afek" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_afek"
    name="x_sk_afek"
    value="<?= HtmlEncode($Page->sk_afek->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_afek"
    data-target="dsl_x_sk_afek"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_afek->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_afek"
    data-value-separator="<?= $Page->sk_afek->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_afek->editAttributes() ?>>
<?= $Page->sk_afek->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_afek->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
    <div id="r_sk_aktifitas_motorik" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_aktifitas_motorik->caption() ?><?= $Page->sk_aktifitas_motorik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_aktifitas_motorik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik">
<template id="tp_x_sk_aktifitas_motorik">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_aktifitas_motorik" name="x_sk_aktifitas_motorik" id="x_sk_aktifitas_motorik"<?= $Page->sk_aktifitas_motorik->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_aktifitas_motorik" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_aktifitas_motorik"
    name="x_sk_aktifitas_motorik"
    value="<?= HtmlEncode($Page->sk_aktifitas_motorik->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_aktifitas_motorik"
    data-target="dsl_x_sk_aktifitas_motorik"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_aktifitas_motorik->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_aktifitas_motorik"
    data-value-separator="<?= $Page->sk_aktifitas_motorik->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_aktifitas_motorik->editAttributes() ?>>
<?= $Page->sk_aktifitas_motorik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_aktifitas_motorik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
    <div id="r_sk_gangguan_ringan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_gangguan_ringan->caption() ?><?= $Page->sk_gangguan_ringan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_gangguan_ringan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan">
<template id="tp_x_sk_gangguan_ringan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_gangguan_ringan" name="x_sk_gangguan_ringan" id="x_sk_gangguan_ringan"<?= $Page->sk_gangguan_ringan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_gangguan_ringan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_gangguan_ringan"
    name="x_sk_gangguan_ringan"
    value="<?= HtmlEncode($Page->sk_gangguan_ringan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_gangguan_ringan"
    data-target="dsl_x_sk_gangguan_ringan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_gangguan_ringan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_gangguan_ringan"
    data-value-separator="<?= $Page->sk_gangguan_ringan->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_gangguan_ringan->editAttributes() ?>>
<?= $Page->sk_gangguan_ringan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_gangguan_ringan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
    <div id="r_sk_proses_pikir" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_proses_pikir->caption() ?><?= $Page->sk_proses_pikir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_proses_pikir->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir">
<template id="tp_x_sk_proses_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_proses_pikir" name="x_sk_proses_pikir" id="x_sk_proses_pikir"<?= $Page->sk_proses_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_proses_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_proses_pikir"
    name="x_sk_proses_pikir"
    value="<?= HtmlEncode($Page->sk_proses_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_proses_pikir"
    data-target="dsl_x_sk_proses_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_proses_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_proses_pikir"
    data-value-separator="<?= $Page->sk_proses_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_proses_pikir->editAttributes() ?>>
<?= $Page->sk_proses_pikir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_proses_pikir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
    <div id="r_sk_orientasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_orientasi->caption() ?><?= $Page->sk_orientasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_orientasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi">
<template id="tp_x_sk_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_orientasi" name="x_sk_orientasi" id="x_sk_orientasi"<?= $Page->sk_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_orientasi"
    name="x_sk_orientasi"
    value="<?= HtmlEncode($Page->sk_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_orientasi"
    data-target="dsl_x_sk_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_orientasi"
    data-value-separator="<?= $Page->sk_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_orientasi->editAttributes() ?>>
<?= $Page->sk_orientasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_orientasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
    <div id="r_sk_tingkat_kesadaran_orientasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_tingkat_kesadaran_orientasi->caption() ?><?= $Page->sk_tingkat_kesadaran_orientasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_tingkat_kesadaran_orientasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi">
<template id="tp_x_sk_tingkat_kesadaran_orientasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_tingkat_kesadaran_orientasi" name="x_sk_tingkat_kesadaran_orientasi" id="x_sk_tingkat_kesadaran_orientasi"<?= $Page->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_tingkat_kesadaran_orientasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_tingkat_kesadaran_orientasi"
    name="x_sk_tingkat_kesadaran_orientasi"
    value="<?= HtmlEncode($Page->sk_tingkat_kesadaran_orientasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_tingkat_kesadaran_orientasi"
    data-target="dsl_x_sk_tingkat_kesadaran_orientasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_tingkat_kesadaran_orientasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_tingkat_kesadaran_orientasi"
    data-value-separator="<?= $Page->sk_tingkat_kesadaran_orientasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_tingkat_kesadaran_orientasi->editAttributes() ?>>
<?= $Page->sk_tingkat_kesadaran_orientasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_tingkat_kesadaran_orientasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_memori->Visible) { // sk_memori ?>
    <div id="r_sk_memori" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_memori->caption() ?><?= $Page->sk_memori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_memori->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori">
<template id="tp_x_sk_memori">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_memori" name="x_sk_memori" id="x_sk_memori"<?= $Page->sk_memori->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_memori" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_memori"
    name="x_sk_memori"
    value="<?= HtmlEncode($Page->sk_memori->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_memori"
    data-target="dsl_x_sk_memori"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_memori->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_memori"
    data-value-separator="<?= $Page->sk_memori->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_memori->editAttributes() ?>>
<?= $Page->sk_memori->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_memori->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
    <div id="r_sk_interaksi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_interaksi->caption() ?><?= $Page->sk_interaksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_interaksi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi">
<template id="tp_x_sk_interaksi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_interaksi" name="x_sk_interaksi" id="x_sk_interaksi"<?= $Page->sk_interaksi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_interaksi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_interaksi"
    name="x_sk_interaksi"
    value="<?= HtmlEncode($Page->sk_interaksi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_interaksi"
    data-target="dsl_x_sk_interaksi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_interaksi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_interaksi"
    data-value-separator="<?= $Page->sk_interaksi->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_interaksi->editAttributes() ?>>
<?= $Page->sk_interaksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_interaksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
    <div id="r_sk_konsentrasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_konsentrasi->caption() ?><?= $Page->sk_konsentrasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_konsentrasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi">
<template id="tp_x_sk_konsentrasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_konsentrasi" name="x_sk_konsentrasi" id="x_sk_konsentrasi"<?= $Page->sk_konsentrasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_konsentrasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_konsentrasi"
    name="x_sk_konsentrasi"
    value="<?= HtmlEncode($Page->sk_konsentrasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_konsentrasi"
    data-target="dsl_x_sk_konsentrasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_konsentrasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_konsentrasi"
    data-value-separator="<?= $Page->sk_konsentrasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_konsentrasi->editAttributes() ?>>
<?= $Page->sk_konsentrasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_konsentrasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
    <div id="r_sk_persepsi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_persepsi->caption() ?><?= $Page->sk_persepsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_persepsi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi">
<template id="tp_x_sk_persepsi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_persepsi" name="x_sk_persepsi" id="x_sk_persepsi"<?= $Page->sk_persepsi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_persepsi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_persepsi"
    name="x_sk_persepsi"
    value="<?= HtmlEncode($Page->sk_persepsi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_persepsi"
    data-target="dsl_x_sk_persepsi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_persepsi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_persepsi"
    data-value-separator="<?= $Page->sk_persepsi->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_persepsi->editAttributes() ?>>
<?= $Page->sk_persepsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_persepsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
    <div id="r_ket_sk_persepsi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" for="x_ket_sk_persepsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_sk_persepsi->caption() ?><?= $Page->ket_sk_persepsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_sk_persepsi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi">
<input type="<?= $Page->ket_sk_persepsi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_persepsi" name="x_ket_sk_persepsi" id="x_ket_sk_persepsi" size="30" maxlength="70" placeholder="<?= HtmlEncode($Page->ket_sk_persepsi->getPlaceHolder()) ?>" value="<?= $Page->ket_sk_persepsi->EditValue ?>"<?= $Page->ket_sk_persepsi->editAttributes() ?> aria-describedby="x_ket_sk_persepsi_help">
<?= $Page->ket_sk_persepsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_sk_persepsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
    <div id="r_sk_isi_pikir" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_isi_pikir->caption() ?><?= $Page->sk_isi_pikir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_isi_pikir->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir">
<template id="tp_x_sk_isi_pikir">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_isi_pikir" name="x_sk_isi_pikir" id="x_sk_isi_pikir"<?= $Page->sk_isi_pikir->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_isi_pikir" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_isi_pikir"
    name="x_sk_isi_pikir"
    value="<?= HtmlEncode($Page->sk_isi_pikir->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_isi_pikir"
    data-target="dsl_x_sk_isi_pikir"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_isi_pikir->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_isi_pikir"
    data-value-separator="<?= $Page->sk_isi_pikir->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_isi_pikir->editAttributes() ?>>
<?= $Page->sk_isi_pikir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_isi_pikir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_waham->Visible) { // sk_waham ?>
    <div id="r_sk_waham" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_waham->caption() ?><?= $Page->sk_waham->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_waham->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham">
<template id="tp_x_sk_waham">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_waham" name="x_sk_waham" id="x_sk_waham"<?= $Page->sk_waham->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_waham" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_waham"
    name="x_sk_waham"
    value="<?= HtmlEncode($Page->sk_waham->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_waham"
    data-target="dsl_x_sk_waham"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_waham->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_waham"
    data-value-separator="<?= $Page->sk_waham->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_waham->editAttributes() ?>>
<?= $Page->sk_waham->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_waham->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
    <div id="r_ket_sk_waham" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" for="x_ket_sk_waham" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_sk_waham->caption() ?><?= $Page->ket_sk_waham->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_sk_waham->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham">
<input type="<?= $Page->ket_sk_waham->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_waham" name="x_ket_sk_waham" id="x_ket_sk_waham" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ket_sk_waham->getPlaceHolder()) ?>" value="<?= $Page->ket_sk_waham->EditValue ?>"<?= $Page->ket_sk_waham->editAttributes() ?> aria-describedby="x_ket_sk_waham_help">
<?= $Page->ket_sk_waham->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_sk_waham->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
    <div id="r_sk_daya_tilik_diri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sk_daya_tilik_diri->caption() ?><?= $Page->sk_daya_tilik_diri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri">
<template id="tp_x_sk_daya_tilik_diri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_sk_daya_tilik_diri" name="x_sk_daya_tilik_diri" id="x_sk_daya_tilik_diri"<?= $Page->sk_daya_tilik_diri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sk_daya_tilik_diri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sk_daya_tilik_diri"
    name="x_sk_daya_tilik_diri"
    value="<?= HtmlEncode($Page->sk_daya_tilik_diri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sk_daya_tilik_diri"
    data-target="dsl_x_sk_daya_tilik_diri"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sk_daya_tilik_diri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_sk_daya_tilik_diri"
    data-value-separator="<?= $Page->sk_daya_tilik_diri->displayValueSeparatorAttribute() ?>"
    <?= $Page->sk_daya_tilik_diri->editAttributes() ?>>
<?= $Page->sk_daya_tilik_diri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
    <div id="r_ket_sk_daya_tilik_diri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" for="x_ket_sk_daya_tilik_diri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_sk_daya_tilik_diri->caption() ?><?= $Page->ket_sk_daya_tilik_diri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri">
<input type="<?= $Page->ket_sk_daya_tilik_diri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_sk_daya_tilik_diri" name="x_ket_sk_daya_tilik_diri" id="x_ket_sk_daya_tilik_diri" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ket_sk_daya_tilik_diri->getPlaceHolder()) ?>" value="<?= $Page->ket_sk_daya_tilik_diri->EditValue ?>"<?= $Page->ket_sk_daya_tilik_diri->editAttributes() ?> aria-describedby="x_ket_sk_daya_tilik_diri_help">
<?= $Page->ket_sk_daya_tilik_diri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_sk_daya_tilik_diri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
    <div id="r_kk_pembelajaran" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kk_pembelajaran->caption() ?><?= $Page->kk_pembelajaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kk_pembelajaran->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran">
<template id="tp_x_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_pembelajaran" name="x_kk_pembelajaran" id="x_kk_pembelajaran"<?= $Page->kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_kk_pembelajaran"
    name="x_kk_pembelajaran"
    value="<?= HtmlEncode($Page->kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_kk_pembelajaran"
    data-target="dsl_x_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Page->kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_pembelajaran"
    data-value-separator="<?= $Page->kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Page->kk_pembelajaran->editAttributes() ?>>
<?= $Page->kk_pembelajaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kk_pembelajaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
    <div id="r_ket_kk_pembelajaran" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_kk_pembelajaran->caption() ?><?= $Page->ket_kk_pembelajaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_kk_pembelajaran->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran">
<template id="tp_x_ket_kk_pembelajaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran" name="x_ket_kk_pembelajaran" id="x_ket_kk_pembelajaran"<?= $Page->ket_kk_pembelajaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_ket_kk_pembelajaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_ket_kk_pembelajaran"
    name="x_ket_kk_pembelajaran"
    value="<?= HtmlEncode($Page->ket_kk_pembelajaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_ket_kk_pembelajaran"
    data-target="dsl_x_ket_kk_pembelajaran"
    data-repeatcolumn="5"
    class="form-control<?= $Page->ket_kk_pembelajaran->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_ket_kk_pembelajaran"
    data-value-separator="<?= $Page->ket_kk_pembelajaran->displayValueSeparatorAttribute() ?>"
    <?= $Page->ket_kk_pembelajaran->editAttributes() ?>>
<?= $Page->ket_kk_pembelajaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_kk_pembelajaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
    <div id="r_ket_kk_pembelajaran_lainnya" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" for="x_ket_kk_pembelajaran_lainnya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_kk_pembelajaran_lainnya->caption() ?><?= $Page->ket_kk_pembelajaran_lainnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_kk_pembelajaran_lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya">
<input type="<?= $Page->ket_kk_pembelajaran_lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_pembelajaran_lainnya" name="x_ket_kk_pembelajaran_lainnya" id="x_ket_kk_pembelajaran_lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_kk_pembelajaran_lainnya->getPlaceHolder()) ?>" value="<?= $Page->ket_kk_pembelajaran_lainnya->EditValue ?>"<?= $Page->ket_kk_pembelajaran_lainnya->editAttributes() ?> aria-describedby="x_ket_kk_pembelajaran_lainnya_help">
<?= $Page->ket_kk_pembelajaran_lainnya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_kk_pembelajaran_lainnya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
    <div id="r_kk_Penerjamah" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kk_Penerjamah->caption() ?><?= $Page->kk_Penerjamah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kk_Penerjamah->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah">
<template id="tp_x_kk_Penerjamah">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_Penerjamah" name="x_kk_Penerjamah" id="x_kk_Penerjamah"<?= $Page->kk_Penerjamah->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_kk_Penerjamah" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_kk_Penerjamah"
    name="x_kk_Penerjamah"
    value="<?= HtmlEncode($Page->kk_Penerjamah->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_kk_Penerjamah"
    data-target="dsl_x_kk_Penerjamah"
    data-repeatcolumn="5"
    class="form-control<?= $Page->kk_Penerjamah->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_Penerjamah"
    data-value-separator="<?= $Page->kk_Penerjamah->displayValueSeparatorAttribute() ?>"
    <?= $Page->kk_Penerjamah->editAttributes() ?>>
<?= $Page->kk_Penerjamah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kk_Penerjamah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
    <div id="r_ket_kk_penerjamah_Lainnya" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" for="x_ket_kk_penerjamah_Lainnya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_kk_penerjamah_Lainnya->caption() ?><?= $Page->ket_kk_penerjamah_Lainnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_kk_penerjamah_Lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya">
<input type="<?= $Page->ket_kk_penerjamah_Lainnya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_penerjamah_Lainnya" name="x_ket_kk_penerjamah_Lainnya" id="x_ket_kk_penerjamah_Lainnya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_kk_penerjamah_Lainnya->getPlaceHolder()) ?>" value="<?= $Page->ket_kk_penerjamah_Lainnya->EditValue ?>"<?= $Page->ket_kk_penerjamah_Lainnya->editAttributes() ?> aria-describedby="x_ket_kk_penerjamah_Lainnya_help">
<?= $Page->ket_kk_penerjamah_Lainnya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_kk_penerjamah_Lainnya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
    <div id="r_kk_bahasa_isyarat" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kk_bahasa_isyarat->caption() ?><?= $Page->kk_bahasa_isyarat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kk_bahasa_isyarat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat">
<template id="tp_x_kk_bahasa_isyarat">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_bahasa_isyarat" name="x_kk_bahasa_isyarat" id="x_kk_bahasa_isyarat"<?= $Page->kk_bahasa_isyarat->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_kk_bahasa_isyarat" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_kk_bahasa_isyarat"
    name="x_kk_bahasa_isyarat"
    value="<?= HtmlEncode($Page->kk_bahasa_isyarat->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_kk_bahasa_isyarat"
    data-target="dsl_x_kk_bahasa_isyarat"
    data-repeatcolumn="5"
    class="form-control<?= $Page->kk_bahasa_isyarat->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_bahasa_isyarat"
    data-value-separator="<?= $Page->kk_bahasa_isyarat->displayValueSeparatorAttribute() ?>"
    <?= $Page->kk_bahasa_isyarat->editAttributes() ?>>
<?= $Page->kk_bahasa_isyarat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kk_bahasa_isyarat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
    <div id="r_kk_kebutuhan_edukasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kk_kebutuhan_edukasi->caption() ?><?= $Page->kk_kebutuhan_edukasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi">
<template id="tp_x_kk_kebutuhan_edukasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_kk_kebutuhan_edukasi" name="x_kk_kebutuhan_edukasi" id="x_kk_kebutuhan_edukasi"<?= $Page->kk_kebutuhan_edukasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_kk_kebutuhan_edukasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_kk_kebutuhan_edukasi"
    name="x_kk_kebutuhan_edukasi"
    value="<?= HtmlEncode($Page->kk_kebutuhan_edukasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_kk_kebutuhan_edukasi"
    data-target="dsl_x_kk_kebutuhan_edukasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->kk_kebutuhan_edukasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan_psikiatri"
    data-field="x_kk_kebutuhan_edukasi"
    data-value-separator="<?= $Page->kk_kebutuhan_edukasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->kk_kebutuhan_edukasi->editAttributes() ?>>
<?= $Page->kk_kebutuhan_edukasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
    <div id="r_ket_kk_kebutuhan_edukasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" for="x_ket_kk_kebutuhan_edukasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_kk_kebutuhan_edukasi->caption() ?><?= $Page->ket_kk_kebutuhan_edukasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi">
<input type="<?= $Page->ket_kk_kebutuhan_edukasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_ket_kk_kebutuhan_edukasi" name="x_ket_kk_kebutuhan_edukasi" id="x_ket_kk_kebutuhan_edukasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_kk_kebutuhan_edukasi->getPlaceHolder()) ?>" value="<?= $Page->ket_kk_kebutuhan_edukasi->EditValue ?>"<?= $Page->ket_kk_kebutuhan_edukasi->editAttributes() ?> aria-describedby="x_ket_kk_kebutuhan_edukasi_help">
<?= $Page->ket_kk_kebutuhan_edukasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_kk_kebutuhan_edukasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
    <div id="r_rencana" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rencana" for="x_rencana" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rencana->caption() ?><?= $Page->rencana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rencana">
<input type="<?= $Page->rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_rencana" name="x_rencana" id="x_rencana" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->rencana->getPlaceHolder()) ?>" value="<?= $Page->rencana->EditValue ?>"<?= $Page->rencana->editAttributes() ?> aria-describedby="x_rencana_help">
<?= $Page->rencana->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rencana->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <div id="r_nip" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nip" for="x_nip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nip->caption() ?><?= $Page->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nip->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nip">
<input type="<?= $Page->nip->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan_psikiatri" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->nip->getPlaceHolder()) ?>" value="<?= $Page->nip->EditValue ?>"<?= $Page->nip->editAttributes() ?> aria-describedby="x_nip_help">
<?= $Page->nip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
