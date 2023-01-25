<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanPsikiatriDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralan_psikiatridelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpenilaian_awal_keperawatan_ralan_psikiatridelete = currentForm = new ew.Form("fpenilaian_awal_keperawatan_ralan_psikiatridelete", "delete");
    loadjs.done("fpenilaian_awal_keperawatan_ralan_psikiatridelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri) ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan_psikiatri")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenilaian_awal_keperawatan_ralan_psikiatridelete" id="fpenilaian_awal_keperawatan_ralan_psikiatridelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan_psikiatri">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="penilaian_awal_keperawatan_ralan_psikiatri_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="penilaian_awal_keperawatan_ralan_psikiatri_tanggal"><?= $Page->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
        <th class="<?= $Page->informasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="penilaian_awal_keperawatan_ralan_psikiatri_informasi"><?= $Page->informasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <th class="<?= $Page->rkd_sakit_sejak->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak"><?= $Page->rkd_sakit_sejak->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
        <th class="<?= $Page->rkd_berobat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat"><?= $Page->rkd_berobat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <th class="<?= $Page->rkd_hasil_pengobatan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan"><?= $Page->rkd_hasil_pengobatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <th class="<?= $Page->fp_putus_obat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat"><?= $Page->fp_putus_obat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <th class="<?= $Page->ket_putus_obat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat"><?= $Page->ket_putus_obat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <th class="<?= $Page->fp_ekonomi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi"><?= $Page->fp_ekonomi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <th class="<?= $Page->ket_masalah_ekonomi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi"><?= $Page->ket_masalah_ekonomi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <th class="<?= $Page->fp_masalah_fisik->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik"><?= $Page->fp_masalah_fisik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <th class="<?= $Page->ket_masalah_fisik->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik"><?= $Page->ket_masalah_fisik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <th class="<?= $Page->fp_masalah_psikososial->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial"><?= $Page->fp_masalah_psikososial->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <th class="<?= $Page->ket_masalah_psikososial->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial"><?= $Page->ket_masalah_psikososial->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
        <th class="<?= $Page->rh_keluarga->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga"><?= $Page->rh_keluarga->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <th class="<?= $Page->ket_rh_keluarga->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga"><?= $Page->ket_rh_keluarga->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <th class="<?= $Page->resiko_bunuh_diri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri"><?= $Page->resiko_bunuh_diri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
        <th class="<?= $Page->rbd_ide->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide"><?= $Page->rbd_ide->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <th class="<?= $Page->ket_rbd_ide->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide"><?= $Page->ket_rbd_ide->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
        <th class="<?= $Page->rbd_rencana->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana"><?= $Page->rbd_rencana->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <th class="<?= $Page->ket_rbd_rencana->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana"><?= $Page->ket_rbd_rencana->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
        <th class="<?= $Page->rbd_alat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat"><?= $Page->rbd_alat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <th class="<?= $Page->ket_rbd_alat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat"><?= $Page->ket_rbd_alat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <th class="<?= $Page->rbd_percobaan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan"><?= $Page->rbd_percobaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <th class="<?= $Page->ket_rbd_percobaan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan"><?= $Page->ket_rbd_percobaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <th class="<?= $Page->rbd_keinginan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan"><?= $Page->rbd_keinginan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <th class="<?= $Page->ket_rbd_keinginan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan"><?= $Page->ket_rbd_keinginan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <th class="<?= $Page->rpo_penggunaan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan"><?= $Page->rpo_penggunaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <th class="<?= $Page->ket_rpo_penggunaan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan"><?= $Page->ket_rpo_penggunaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <th class="<?= $Page->rpo_efek_samping->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping"><?= $Page->rpo_efek_samping->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <th class="<?= $Page->ket_rpo_efek_samping->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping"><?= $Page->ket_rpo_efek_samping->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
        <th class="<?= $Page->rpo_napza->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza"><?= $Page->rpo_napza->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <th class="<?= $Page->ket_rpo_napza->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza"><?= $Page->ket_rpo_napza->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <th class="<?= $Page->ket_lama_pemakaian->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian"><?= $Page->ket_lama_pemakaian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <th class="<?= $Page->ket_cara_pemakaian->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian"><?= $Page->ket_cara_pemakaian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <th class="<?= $Page->ket_latar_belakang_pemakaian->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian"><?= $Page->ket_latar_belakang_pemakaian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <th class="<?= $Page->rpo_penggunaan_obat_lainnya->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya"><?= $Page->rpo_penggunaan_obat_lainnya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <th class="<?= $Page->ket_penggunaan_obat_lainnya->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya"><?= $Page->ket_penggunaan_obat_lainnya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <th class="<?= $Page->ket_alasan_penggunaan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan"><?= $Page->ket_alasan_penggunaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <th class="<?= $Page->rpo_alergi_obat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat"><?= $Page->rpo_alergi_obat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <th class="<?= $Page->ket_alergi_obat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat"><?= $Page->ket_alergi_obat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
        <th class="<?= $Page->rpo_merokok->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok"><?= $Page->rpo_merokok->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
        <th class="<?= $Page->ket_merokok->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok"><?= $Page->ket_merokok->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <th class="<?= $Page->rpo_minum_kopi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi"><?= $Page->rpo_minum_kopi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <th class="<?= $Page->ket_minum_kopi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi"><?= $Page->ket_minum_kopi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <th class="<?= $Page->td->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_td" class="penilaian_awal_keperawatan_ralan_psikiatri_td"><?= $Page->td->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <th class="<?= $Page->nadi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="penilaian_awal_keperawatan_ralan_psikiatri_nadi"><?= $Page->nadi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <th class="<?= $Page->gcs->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="penilaian_awal_keperawatan_ralan_psikiatri_gcs"><?= $Page->gcs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <th class="<?= $Page->rr->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="penilaian_awal_keperawatan_ralan_psikiatri_rr"><?= $Page->rr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <th class="<?= $Page->suhu->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="penilaian_awal_keperawatan_ralan_psikiatri_suhu"><?= $Page->suhu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <th class="<?= $Page->pf_keluhan_fisik->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik"><?= $Page->pf_keluhan_fisik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <th class="<?= $Page->ket_keluhan_fisik->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik"><?= $Page->ket_keluhan_fisik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
        <th class="<?= $Page->skala_nyeri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri"><?= $Page->skala_nyeri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <th class="<?= $Page->durasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="penilaian_awal_keperawatan_ralan_psikiatri_durasi"><?= $Page->durasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
        <th class="<?= $Page->nyeri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri"><?= $Page->nyeri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
        <th class="<?= $Page->provokes->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_provokes"><?= $Page->provokes->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
        <th class="<?= $Page->ket_provokes->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes"><?= $Page->ket_provokes->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
        <th class="<?= $Page->quality->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_quality"><?= $Page->quality->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
        <th class="<?= $Page->ket_quality->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_quality"><?= $Page->ket_quality->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <th class="<?= $Page->lokasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="penilaian_awal_keperawatan_ralan_psikiatri_lokasi"><?= $Page->lokasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
        <th class="<?= $Page->menyebar->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="penilaian_awal_keperawatan_ralan_psikiatri_menyebar"><?= $Page->menyebar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
        <th class="<?= $Page->pada_dokter->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter"><?= $Page->pada_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
        <th class="<?= $Page->ket_dokter->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter"><?= $Page->ket_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <th class="<?= $Page->nyeri_hilang->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang"><?= $Page->nyeri_hilang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
        <th class="<?= $Page->ket_nyeri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri"><?= $Page->ket_nyeri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <th class="<?= $Page->bb->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="penilaian_awal_keperawatan_ralan_psikiatri_bb"><?= $Page->bb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <th class="<?= $Page->tb->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="penilaian_awal_keperawatan_ralan_psikiatri_tb"><?= $Page->tb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
        <th class="<?= $Page->bmi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="penilaian_awal_keperawatan_ralan_psikiatri_bmi"><?= $Page->bmi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <th class="<?= $Page->lapor_status_nutrisi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi"><?= $Page->lapor_status_nutrisi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <th class="<?= $Page->ket_lapor_status_nutrisi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi"><?= $Page->ket_lapor_status_nutrisi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
        <th class="<?= $Page->sg1->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="penilaian_awal_keperawatan_ralan_psikiatri_sg1"><?= $Page->sg1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
        <th class="<?= $Page->nilai1->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai1"><?= $Page->nilai1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
        <th class="<?= $Page->sg2->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="penilaian_awal_keperawatan_ralan_psikiatri_sg2"><?= $Page->sg2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
        <th class="<?= $Page->nilai2->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai2"><?= $Page->nilai2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
        <th class="<?= $Page->total_hasil->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_total_hasil"><?= $Page->total_hasil->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
        <th class="<?= $Page->resikojatuh->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh"><?= $Page->resikojatuh->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bjm->Visible) { // bjm ?>
        <th class="<?= $Page->bjm->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="penilaian_awal_keperawatan_ralan_psikiatri_bjm"><?= $Page->bjm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->msa->Visible) { // msa ?>
        <th class="<?= $Page->msa->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="penilaian_awal_keperawatan_ralan_psikiatri_msa"><?= $Page->msa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
        <th class="<?= $Page->hasil->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_hasil"><?= $Page->hasil->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
        <th class="<?= $Page->lapor->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor"><?= $Page->lapor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
        <th class="<?= $Page->ket_lapor->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor"><?= $Page->ket_lapor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
        <th class="<?= $Page->adl_mandi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi"><?= $Page->adl_mandi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <th class="<?= $Page->adl_berpakaian->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian"><?= $Page->adl_berpakaian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_makan->Visible) { // adl_makan ?>
        <th class="<?= $Page->adl_makan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_makan"><?= $Page->adl_makan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_bak->Visible) { // adl_bak ?>
        <th class="<?= $Page->adl_bak->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bak"><?= $Page->adl_bak->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_bab->Visible) { // adl_bab ?>
        <th class="<?= $Page->adl_bab->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bab"><?= $Page->adl_bab->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
        <th class="<?= $Page->adl_hobi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi"><?= $Page->adl_hobi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <th class="<?= $Page->ket_adl_hobi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi"><?= $Page->ket_adl_hobi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <th class="<?= $Page->adl_sosialisasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi"><?= $Page->adl_sosialisasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <th class="<?= $Page->ket_adl_sosialisasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi"><?= $Page->ket_adl_sosialisasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <th class="<?= $Page->adl_kegiatan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan"><?= $Page->adl_kegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <th class="<?= $Page->ket_adl_kegiatan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan"><?= $Page->ket_adl_kegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
        <th class="<?= $Page->sk_penampilan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan"><?= $Page->sk_penampilan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <th class="<?= $Page->sk_alam_perasaan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan"><?= $Page->sk_alam_perasaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <th class="<?= $Page->sk_pembicaraan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan"><?= $Page->sk_pembicaraan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_afek->Visible) { // sk_afek ?>
        <th class="<?= $Page->sk_afek->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_afek"><?= $Page->sk_afek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <th class="<?= $Page->sk_aktifitas_motorik->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik"><?= $Page->sk_aktifitas_motorik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <th class="<?= $Page->sk_gangguan_ringan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan"><?= $Page->sk_gangguan_ringan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <th class="<?= $Page->sk_proses_pikir->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir"><?= $Page->sk_proses_pikir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
        <th class="<?= $Page->sk_orientasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi"><?= $Page->sk_orientasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <th class="<?= $Page->sk_tingkat_kesadaran_orientasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi"><?= $Page->sk_tingkat_kesadaran_orientasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_memori->Visible) { // sk_memori ?>
        <th class="<?= $Page->sk_memori->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_memori"><?= $Page->sk_memori->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
        <th class="<?= $Page->sk_interaksi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi"><?= $Page->sk_interaksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <th class="<?= $Page->sk_konsentrasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi"><?= $Page->sk_konsentrasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
        <th class="<?= $Page->sk_persepsi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi"><?= $Page->sk_persepsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <th class="<?= $Page->ket_sk_persepsi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi"><?= $Page->ket_sk_persepsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <th class="<?= $Page->sk_isi_pikir->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir"><?= $Page->sk_isi_pikir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_waham->Visible) { // sk_waham ?>
        <th class="<?= $Page->sk_waham->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_waham"><?= $Page->sk_waham->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <th class="<?= $Page->ket_sk_waham->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham"><?= $Page->ket_sk_waham->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <th class="<?= $Page->sk_daya_tilik_diri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri"><?= $Page->sk_daya_tilik_diri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <th class="<?= $Page->ket_sk_daya_tilik_diri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri"><?= $Page->ket_sk_daya_tilik_diri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <th class="<?= $Page->kk_pembelajaran->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran"><?= $Page->kk_pembelajaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <th class="<?= $Page->ket_kk_pembelajaran->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran"><?= $Page->ket_kk_pembelajaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <th class="<?= $Page->ket_kk_pembelajaran_lainnya->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya"><?= $Page->ket_kk_pembelajaran_lainnya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <th class="<?= $Page->kk_Penerjamah->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah"><?= $Page->kk_Penerjamah->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <th class="<?= $Page->ket_kk_penerjamah_Lainnya->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya"><?= $Page->ket_kk_penerjamah_Lainnya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <th class="<?= $Page->kk_bahasa_isyarat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat"><?= $Page->kk_bahasa_isyarat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <th class="<?= $Page->kk_kebutuhan_edukasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi"><?= $Page->kk_kebutuhan_edukasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <th class="<?= $Page->ket_kk_kebutuhan_edukasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi"><?= $Page->ket_kk_kebutuhan_edukasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
        <th class="<?= $Page->rencana->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rencana"><?= $Page->rencana->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="penilaian_awal_keperawatan_ralan_psikiatri_nip"><?= $Page->nip->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="penilaian_awal_keperawatan_ralan_psikiatri_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
        <td <?= $Page->informasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="penilaian_awal_keperawatan_ralan_psikiatri_informasi">
<span<?= $Page->informasi->viewAttributes() ?>>
<?= $Page->informasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <td <?= $Page->rkd_sakit_sejak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak">
<span<?= $Page->rkd_sakit_sejak->viewAttributes() ?>>
<?= $Page->rkd_sakit_sejak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
        <td <?= $Page->rkd_berobat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat">
<span<?= $Page->rkd_berobat->viewAttributes() ?>>
<?= $Page->rkd_berobat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <td <?= $Page->rkd_hasil_pengobatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan">
<span<?= $Page->rkd_hasil_pengobatan->viewAttributes() ?>>
<?= $Page->rkd_hasil_pengobatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <td <?= $Page->fp_putus_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat">
<span<?= $Page->fp_putus_obat->viewAttributes() ?>>
<?= $Page->fp_putus_obat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <td <?= $Page->ket_putus_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat">
<span<?= $Page->ket_putus_obat->viewAttributes() ?>>
<?= $Page->ket_putus_obat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <td <?= $Page->fp_ekonomi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi">
<span<?= $Page->fp_ekonomi->viewAttributes() ?>>
<?= $Page->fp_ekonomi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <td <?= $Page->ket_masalah_ekonomi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi">
<span<?= $Page->ket_masalah_ekonomi->viewAttributes() ?>>
<?= $Page->ket_masalah_ekonomi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <td <?= $Page->fp_masalah_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik">
<span<?= $Page->fp_masalah_fisik->viewAttributes() ?>>
<?= $Page->fp_masalah_fisik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <td <?= $Page->ket_masalah_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik">
<span<?= $Page->ket_masalah_fisik->viewAttributes() ?>>
<?= $Page->ket_masalah_fisik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <td <?= $Page->fp_masalah_psikososial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial">
<span<?= $Page->fp_masalah_psikososial->viewAttributes() ?>>
<?= $Page->fp_masalah_psikososial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <td <?= $Page->ket_masalah_psikososial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial">
<span<?= $Page->ket_masalah_psikososial->viewAttributes() ?>>
<?= $Page->ket_masalah_psikososial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
        <td <?= $Page->rh_keluarga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga">
<span<?= $Page->rh_keluarga->viewAttributes() ?>>
<?= $Page->rh_keluarga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <td <?= $Page->ket_rh_keluarga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga">
<span<?= $Page->ket_rh_keluarga->viewAttributes() ?>>
<?= $Page->ket_rh_keluarga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <td <?= $Page->resiko_bunuh_diri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri">
<span<?= $Page->resiko_bunuh_diri->viewAttributes() ?>>
<?= $Page->resiko_bunuh_diri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
        <td <?= $Page->rbd_ide->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide">
<span<?= $Page->rbd_ide->viewAttributes() ?>>
<?= $Page->rbd_ide->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <td <?= $Page->ket_rbd_ide->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide">
<span<?= $Page->ket_rbd_ide->viewAttributes() ?>>
<?= $Page->ket_rbd_ide->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
        <td <?= $Page->rbd_rencana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana">
<span<?= $Page->rbd_rencana->viewAttributes() ?>>
<?= $Page->rbd_rencana->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <td <?= $Page->ket_rbd_rencana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana">
<span<?= $Page->ket_rbd_rencana->viewAttributes() ?>>
<?= $Page->ket_rbd_rencana->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
        <td <?= $Page->rbd_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat">
<span<?= $Page->rbd_alat->viewAttributes() ?>>
<?= $Page->rbd_alat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <td <?= $Page->ket_rbd_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat">
<span<?= $Page->ket_rbd_alat->viewAttributes() ?>>
<?= $Page->ket_rbd_alat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <td <?= $Page->rbd_percobaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan">
<span<?= $Page->rbd_percobaan->viewAttributes() ?>>
<?= $Page->rbd_percobaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <td <?= $Page->ket_rbd_percobaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan">
<span<?= $Page->ket_rbd_percobaan->viewAttributes() ?>>
<?= $Page->ket_rbd_percobaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <td <?= $Page->rbd_keinginan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan">
<span<?= $Page->rbd_keinginan->viewAttributes() ?>>
<?= $Page->rbd_keinginan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <td <?= $Page->ket_rbd_keinginan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan">
<span<?= $Page->ket_rbd_keinginan->viewAttributes() ?>>
<?= $Page->ket_rbd_keinginan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <td <?= $Page->rpo_penggunaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan">
<span<?= $Page->rpo_penggunaan->viewAttributes() ?>>
<?= $Page->rpo_penggunaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <td <?= $Page->ket_rpo_penggunaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan">
<span<?= $Page->ket_rpo_penggunaan->viewAttributes() ?>>
<?= $Page->ket_rpo_penggunaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <td <?= $Page->rpo_efek_samping->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping">
<span<?= $Page->rpo_efek_samping->viewAttributes() ?>>
<?= $Page->rpo_efek_samping->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <td <?= $Page->ket_rpo_efek_samping->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping">
<span<?= $Page->ket_rpo_efek_samping->viewAttributes() ?>>
<?= $Page->ket_rpo_efek_samping->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
        <td <?= $Page->rpo_napza->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza">
<span<?= $Page->rpo_napza->viewAttributes() ?>>
<?= $Page->rpo_napza->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <td <?= $Page->ket_rpo_napza->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza">
<span<?= $Page->ket_rpo_napza->viewAttributes() ?>>
<?= $Page->ket_rpo_napza->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <td <?= $Page->ket_lama_pemakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian">
<span<?= $Page->ket_lama_pemakaian->viewAttributes() ?>>
<?= $Page->ket_lama_pemakaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <td <?= $Page->ket_cara_pemakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian">
<span<?= $Page->ket_cara_pemakaian->viewAttributes() ?>>
<?= $Page->ket_cara_pemakaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <td <?= $Page->ket_latar_belakang_pemakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian">
<span<?= $Page->ket_latar_belakang_pemakaian->viewAttributes() ?>>
<?= $Page->ket_latar_belakang_pemakaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <td <?= $Page->rpo_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya">
<span<?= $Page->rpo_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->rpo_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <td <?= $Page->ket_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya">
<span<?= $Page->ket_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->ket_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <td <?= $Page->ket_alasan_penggunaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan">
<span<?= $Page->ket_alasan_penggunaan->viewAttributes() ?>>
<?= $Page->ket_alasan_penggunaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <td <?= $Page->rpo_alergi_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat">
<span<?= $Page->rpo_alergi_obat->viewAttributes() ?>>
<?= $Page->rpo_alergi_obat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <td <?= $Page->ket_alergi_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat">
<span<?= $Page->ket_alergi_obat->viewAttributes() ?>>
<?= $Page->ket_alergi_obat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
        <td <?= $Page->rpo_merokok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok">
<span<?= $Page->rpo_merokok->viewAttributes() ?>>
<?= $Page->rpo_merokok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
        <td <?= $Page->ket_merokok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok">
<span<?= $Page->ket_merokok->viewAttributes() ?>>
<?= $Page->ket_merokok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <td <?= $Page->rpo_minum_kopi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi">
<span<?= $Page->rpo_minum_kopi->viewAttributes() ?>>
<?= $Page->rpo_minum_kopi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <td <?= $Page->ket_minum_kopi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi">
<span<?= $Page->ket_minum_kopi->viewAttributes() ?>>
<?= $Page->ket_minum_kopi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <td <?= $Page->td->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_td" class="penilaian_awal_keperawatan_ralan_psikiatri_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <td <?= $Page->nadi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="penilaian_awal_keperawatan_ralan_psikiatri_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <td <?= $Page->gcs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="penilaian_awal_keperawatan_ralan_psikiatri_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <td <?= $Page->rr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="penilaian_awal_keperawatan_ralan_psikiatri_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <td <?= $Page->suhu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="penilaian_awal_keperawatan_ralan_psikiatri_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <td <?= $Page->pf_keluhan_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik">
<span<?= $Page->pf_keluhan_fisik->viewAttributes() ?>>
<?= $Page->pf_keluhan_fisik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <td <?= $Page->ket_keluhan_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik">
<span<?= $Page->ket_keluhan_fisik->viewAttributes() ?>>
<?= $Page->ket_keluhan_fisik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
        <td <?= $Page->skala_nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri">
<span<?= $Page->skala_nyeri->viewAttributes() ?>>
<?= $Page->skala_nyeri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <td <?= $Page->durasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="penilaian_awal_keperawatan_ralan_psikiatri_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
        <td <?= $Page->nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri">
<span<?= $Page->nyeri->viewAttributes() ?>>
<?= $Page->nyeri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
        <td <?= $Page->provokes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_provokes">
<span<?= $Page->provokes->viewAttributes() ?>>
<?= $Page->provokes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
        <td <?= $Page->ket_provokes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes">
<span<?= $Page->ket_provokes->viewAttributes() ?>>
<?= $Page->ket_provokes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
        <td <?= $Page->quality->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_quality">
<span<?= $Page->quality->viewAttributes() ?>>
<?= $Page->quality->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
        <td <?= $Page->ket_quality->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_quality">
<span<?= $Page->ket_quality->viewAttributes() ?>>
<?= $Page->ket_quality->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <td <?= $Page->lokasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="penilaian_awal_keperawatan_ralan_psikiatri_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
        <td <?= $Page->menyebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="penilaian_awal_keperawatan_ralan_psikiatri_menyebar">
<span<?= $Page->menyebar->viewAttributes() ?>>
<?= $Page->menyebar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
        <td <?= $Page->pada_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter">
<span<?= $Page->pada_dokter->viewAttributes() ?>>
<?= $Page->pada_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
        <td <?= $Page->ket_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter">
<span<?= $Page->ket_dokter->viewAttributes() ?>>
<?= $Page->ket_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <td <?= $Page->nyeri_hilang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang">
<span<?= $Page->nyeri_hilang->viewAttributes() ?>>
<?= $Page->nyeri_hilang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
        <td <?= $Page->ket_nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri">
<span<?= $Page->ket_nyeri->viewAttributes() ?>>
<?= $Page->ket_nyeri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <td <?= $Page->bb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="penilaian_awal_keperawatan_ralan_psikiatri_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <td <?= $Page->tb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="penilaian_awal_keperawatan_ralan_psikiatri_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
        <td <?= $Page->bmi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="penilaian_awal_keperawatan_ralan_psikiatri_bmi">
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <td <?= $Page->lapor_status_nutrisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi">
<span<?= $Page->lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->lapor_status_nutrisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <td <?= $Page->ket_lapor_status_nutrisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi">
<span<?= $Page->ket_lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->ket_lapor_status_nutrisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
        <td <?= $Page->sg1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="penilaian_awal_keperawatan_ralan_psikiatri_sg1">
<span<?= $Page->sg1->viewAttributes() ?>>
<?= $Page->sg1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
        <td <?= $Page->nilai1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai1">
<span<?= $Page->nilai1->viewAttributes() ?>>
<?= $Page->nilai1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
        <td <?= $Page->sg2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="penilaian_awal_keperawatan_ralan_psikiatri_sg2">
<span<?= $Page->sg2->viewAttributes() ?>>
<?= $Page->sg2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
        <td <?= $Page->nilai2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai2">
<span<?= $Page->nilai2->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_nilai2_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->nilai2->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->nilai2->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_nilai2_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
        <td <?= $Page->total_hasil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_total_hasil">
<span<?= $Page->total_hasil->viewAttributes() ?>>
<?= $Page->total_hasil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
        <td <?= $Page->resikojatuh->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh">
<span<?= $Page->resikojatuh->viewAttributes() ?>>
<?= $Page->resikojatuh->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bjm->Visible) { // bjm ?>
        <td <?= $Page->bjm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="penilaian_awal_keperawatan_ralan_psikiatri_bjm">
<span<?= $Page->bjm->viewAttributes() ?>>
<?= $Page->bjm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->msa->Visible) { // msa ?>
        <td <?= $Page->msa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="penilaian_awal_keperawatan_ralan_psikiatri_msa">
<span<?= $Page->msa->viewAttributes() ?>>
<?= $Page->msa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
        <td <?= $Page->hasil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_hasil">
<span<?= $Page->hasil->viewAttributes() ?>>
<?= $Page->hasil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
        <td <?= $Page->lapor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor">
<span<?= $Page->lapor->viewAttributes() ?>>
<?= $Page->lapor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
        <td <?= $Page->ket_lapor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor">
<span<?= $Page->ket_lapor->viewAttributes() ?>>
<?= $Page->ket_lapor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
        <td <?= $Page->adl_mandi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi">
<span<?= $Page->adl_mandi->viewAttributes() ?>>
<?= $Page->adl_mandi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <td <?= $Page->adl_berpakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian">
<span<?= $Page->adl_berpakaian->viewAttributes() ?>>
<?= $Page->adl_berpakaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_makan->Visible) { // adl_makan ?>
        <td <?= $Page->adl_makan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_makan">
<span<?= $Page->adl_makan->viewAttributes() ?>>
<?= $Page->adl_makan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_bak->Visible) { // adl_bak ?>
        <td <?= $Page->adl_bak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bak">
<span<?= $Page->adl_bak->viewAttributes() ?>>
<?= $Page->adl_bak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_bab->Visible) { // adl_bab ?>
        <td <?= $Page->adl_bab->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bab">
<span<?= $Page->adl_bab->viewAttributes() ?>>
<?= $Page->adl_bab->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
        <td <?= $Page->adl_hobi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi">
<span<?= $Page->adl_hobi->viewAttributes() ?>>
<?= $Page->adl_hobi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <td <?= $Page->ket_adl_hobi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi">
<span<?= $Page->ket_adl_hobi->viewAttributes() ?>>
<?= $Page->ket_adl_hobi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <td <?= $Page->adl_sosialisasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi">
<span<?= $Page->adl_sosialisasi->viewAttributes() ?>>
<?= $Page->adl_sosialisasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <td <?= $Page->ket_adl_sosialisasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi">
<span<?= $Page->ket_adl_sosialisasi->viewAttributes() ?>>
<?= $Page->ket_adl_sosialisasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <td <?= $Page->adl_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan">
<span<?= $Page->adl_kegiatan->viewAttributes() ?>>
<?= $Page->adl_kegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <td <?= $Page->ket_adl_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan">
<span<?= $Page->ket_adl_kegiatan->viewAttributes() ?>>
<?= $Page->ket_adl_kegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
        <td <?= $Page->sk_penampilan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan">
<span<?= $Page->sk_penampilan->viewAttributes() ?>>
<?= $Page->sk_penampilan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <td <?= $Page->sk_alam_perasaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan">
<span<?= $Page->sk_alam_perasaan->viewAttributes() ?>>
<?= $Page->sk_alam_perasaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <td <?= $Page->sk_pembicaraan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan">
<span<?= $Page->sk_pembicaraan->viewAttributes() ?>>
<?= $Page->sk_pembicaraan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_afek->Visible) { // sk_afek ?>
        <td <?= $Page->sk_afek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_afek">
<span<?= $Page->sk_afek->viewAttributes() ?>>
<?= $Page->sk_afek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <td <?= $Page->sk_aktifitas_motorik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik">
<span<?= $Page->sk_aktifitas_motorik->viewAttributes() ?>>
<?= $Page->sk_aktifitas_motorik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <td <?= $Page->sk_gangguan_ringan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan">
<span<?= $Page->sk_gangguan_ringan->viewAttributes() ?>>
<?= $Page->sk_gangguan_ringan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <td <?= $Page->sk_proses_pikir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir">
<span<?= $Page->sk_proses_pikir->viewAttributes() ?>>
<?= $Page->sk_proses_pikir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
        <td <?= $Page->sk_orientasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi">
<span<?= $Page->sk_orientasi->viewAttributes() ?>>
<?= $Page->sk_orientasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <td <?= $Page->sk_tingkat_kesadaran_orientasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi">
<span<?= $Page->sk_tingkat_kesadaran_orientasi->viewAttributes() ?>>
<?= $Page->sk_tingkat_kesadaran_orientasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_memori->Visible) { // sk_memori ?>
        <td <?= $Page->sk_memori->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_memori">
<span<?= $Page->sk_memori->viewAttributes() ?>>
<?= $Page->sk_memori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
        <td <?= $Page->sk_interaksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi">
<span<?= $Page->sk_interaksi->viewAttributes() ?>>
<?= $Page->sk_interaksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <td <?= $Page->sk_konsentrasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi">
<span<?= $Page->sk_konsentrasi->viewAttributes() ?>>
<?= $Page->sk_konsentrasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
        <td <?= $Page->sk_persepsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi">
<span<?= $Page->sk_persepsi->viewAttributes() ?>>
<?= $Page->sk_persepsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <td <?= $Page->ket_sk_persepsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi">
<span<?= $Page->ket_sk_persepsi->viewAttributes() ?>>
<?= $Page->ket_sk_persepsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <td <?= $Page->sk_isi_pikir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir">
<span<?= $Page->sk_isi_pikir->viewAttributes() ?>>
<?= $Page->sk_isi_pikir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_waham->Visible) { // sk_waham ?>
        <td <?= $Page->sk_waham->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_waham">
<span<?= $Page->sk_waham->viewAttributes() ?>>
<?= $Page->sk_waham->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <td <?= $Page->ket_sk_waham->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham">
<span<?= $Page->ket_sk_waham->viewAttributes() ?>>
<?= $Page->ket_sk_waham->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <td <?= $Page->sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri">
<span<?= $Page->sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->sk_daya_tilik_diri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <td <?= $Page->ket_sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri">
<span<?= $Page->ket_sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->ket_sk_daya_tilik_diri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <td <?= $Page->kk_pembelajaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran">
<span<?= $Page->kk_pembelajaran->viewAttributes() ?>>
<?= $Page->kk_pembelajaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <td <?= $Page->ket_kk_pembelajaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran">
<span<?= $Page->ket_kk_pembelajaran->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <td <?= $Page->ket_kk_pembelajaran_lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya">
<span<?= $Page->ket_kk_pembelajaran_lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran_lainnya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <td <?= $Page->kk_Penerjamah->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah">
<span<?= $Page->kk_Penerjamah->viewAttributes() ?>>
<?= $Page->kk_Penerjamah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <td <?= $Page->ket_kk_penerjamah_Lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya">
<span<?= $Page->ket_kk_penerjamah_Lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_penerjamah_Lainnya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <td <?= $Page->kk_bahasa_isyarat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat">
<span<?= $Page->kk_bahasa_isyarat->viewAttributes() ?>>
<?= $Page->kk_bahasa_isyarat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <td <?= $Page->kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi">
<span<?= $Page->kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <td <?= $Page->ket_kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi">
<span<?= $Page->ket_kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->ket_kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
        <td <?= $Page->rencana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rencana">
<span<?= $Page->rencana->viewAttributes() ?>>
<?= $Page->rencana->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <td <?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="penilaian_awal_keperawatan_ralan_psikiatri_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
