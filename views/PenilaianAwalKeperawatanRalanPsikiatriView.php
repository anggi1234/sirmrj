<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanPsikiatriView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralan_psikiatriview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenilaian_awal_keperawatan_ralan_psikiatriview = currentForm = new ew.Form("fpenilaian_awal_keperawatan_ralan_psikiatriview", "view");
    loadjs.done("fpenilaian_awal_keperawatan_ralan_psikiatriview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri) ew.vars.tables.penilaian_awal_keperawatan_ralan_psikiatri = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan_psikiatri")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenilaian_awal_keperawatan_ralan_psikiatriview" id="fpenilaian_awal_keperawatan_ralan_psikiatriview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan_psikiatri">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_penilaian_awal_keperawatan_ralan_psikiatri->Visible) { // id_penilaian_awal_keperawatan_ralan_psikiatri ?>
    <tr id="r_id_penilaian_awal_keperawatan_ralan_psikiatri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_id_penilaian_awal_keperawatan_ralan_psikiatri"><?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->caption() ?></span></td>
        <td data-name="id_penilaian_awal_keperawatan_ralan_psikiatri" <?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_id_penilaian_awal_keperawatan_ralan_psikiatri">
<span<?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->viewAttributes() ?>>
<?= $Page->id_penilaian_awal_keperawatan_ralan_psikiatri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
    <tr id="r_informasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_informasi"><?= $Page->informasi->caption() ?></span></td>
        <td data-name="informasi" <?= $Page->informasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_informasi">
<span<?= $Page->informasi->viewAttributes() ?>>
<?= $Page->informasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <tr id="r_keluhan_utama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_keluhan_utama"><?= $Page->keluhan_utama->caption() ?></span></td>
        <td data-name="keluhan_utama" <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_keluhan_utama">
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
    <tr id="r_rkd_sakit_sejak">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak"><?= $Page->rkd_sakit_sejak->caption() ?></span></td>
        <td data-name="rkd_sakit_sejak" <?= $Page->rkd_sakit_sejak->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak">
<span<?= $Page->rkd_sakit_sejak->viewAttributes() ?>>
<?= $Page->rkd_sakit_sejak->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rkd_keluhan->Visible) { // rkd_keluhan ?>
    <tr id="r_rkd_keluhan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_keluhan"><?= $Page->rkd_keluhan->caption() ?></span></td>
        <td data-name="rkd_keluhan" <?= $Page->rkd_keluhan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_keluhan">
<span<?= $Page->rkd_keluhan->viewAttributes() ?>>
<?= $Page->rkd_keluhan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
    <tr id="r_rkd_berobat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat"><?= $Page->rkd_berobat->caption() ?></span></td>
        <td data-name="rkd_berobat" <?= $Page->rkd_berobat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat">
<span<?= $Page->rkd_berobat->viewAttributes() ?>>
<?= $Page->rkd_berobat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
    <tr id="r_rkd_hasil_pengobatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan"><?= $Page->rkd_hasil_pengobatan->caption() ?></span></td>
        <td data-name="rkd_hasil_pengobatan" <?= $Page->rkd_hasil_pengobatan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan">
<span<?= $Page->rkd_hasil_pengobatan->viewAttributes() ?>>
<?= $Page->rkd_hasil_pengobatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
    <tr id="r_fp_putus_obat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat"><?= $Page->fp_putus_obat->caption() ?></span></td>
        <td data-name="fp_putus_obat" <?= $Page->fp_putus_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat">
<span<?= $Page->fp_putus_obat->viewAttributes() ?>>
<?= $Page->fp_putus_obat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
    <tr id="r_ket_putus_obat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat"><?= $Page->ket_putus_obat->caption() ?></span></td>
        <td data-name="ket_putus_obat" <?= $Page->ket_putus_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat">
<span<?= $Page->ket_putus_obat->viewAttributes() ?>>
<?= $Page->ket_putus_obat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
    <tr id="r_fp_ekonomi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi"><?= $Page->fp_ekonomi->caption() ?></span></td>
        <td data-name="fp_ekonomi" <?= $Page->fp_ekonomi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi">
<span<?= $Page->fp_ekonomi->viewAttributes() ?>>
<?= $Page->fp_ekonomi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
    <tr id="r_ket_masalah_ekonomi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi"><?= $Page->ket_masalah_ekonomi->caption() ?></span></td>
        <td data-name="ket_masalah_ekonomi" <?= $Page->ket_masalah_ekonomi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi">
<span<?= $Page->ket_masalah_ekonomi->viewAttributes() ?>>
<?= $Page->ket_masalah_ekonomi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
    <tr id="r_fp_masalah_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik"><?= $Page->fp_masalah_fisik->caption() ?></span></td>
        <td data-name="fp_masalah_fisik" <?= $Page->fp_masalah_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik">
<span<?= $Page->fp_masalah_fisik->viewAttributes() ?>>
<?= $Page->fp_masalah_fisik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
    <tr id="r_ket_masalah_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik"><?= $Page->ket_masalah_fisik->caption() ?></span></td>
        <td data-name="ket_masalah_fisik" <?= $Page->ket_masalah_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik">
<span<?= $Page->ket_masalah_fisik->viewAttributes() ?>>
<?= $Page->ket_masalah_fisik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
    <tr id="r_fp_masalah_psikososial">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial"><?= $Page->fp_masalah_psikososial->caption() ?></span></td>
        <td data-name="fp_masalah_psikososial" <?= $Page->fp_masalah_psikososial->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial">
<span<?= $Page->fp_masalah_psikososial->viewAttributes() ?>>
<?= $Page->fp_masalah_psikososial->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
    <tr id="r_ket_masalah_psikososial">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial"><?= $Page->ket_masalah_psikososial->caption() ?></span></td>
        <td data-name="ket_masalah_psikososial" <?= $Page->ket_masalah_psikososial->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial">
<span<?= $Page->ket_masalah_psikososial->viewAttributes() ?>>
<?= $Page->ket_masalah_psikososial->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
    <tr id="r_rh_keluarga">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga"><?= $Page->rh_keluarga->caption() ?></span></td>
        <td data-name="rh_keluarga" <?= $Page->rh_keluarga->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga">
<span<?= $Page->rh_keluarga->viewAttributes() ?>>
<?= $Page->rh_keluarga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
    <tr id="r_ket_rh_keluarga">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga"><?= $Page->ket_rh_keluarga->caption() ?></span></td>
        <td data-name="ket_rh_keluarga" <?= $Page->ket_rh_keluarga->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga">
<span<?= $Page->ket_rh_keluarga->viewAttributes() ?>>
<?= $Page->ket_rh_keluarga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
    <tr id="r_resiko_bunuh_diri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri"><?= $Page->resiko_bunuh_diri->caption() ?></span></td>
        <td data-name="resiko_bunuh_diri" <?= $Page->resiko_bunuh_diri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri">
<span<?= $Page->resiko_bunuh_diri->viewAttributes() ?>>
<?= $Page->resiko_bunuh_diri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
    <tr id="r_rbd_ide">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide"><?= $Page->rbd_ide->caption() ?></span></td>
        <td data-name="rbd_ide" <?= $Page->rbd_ide->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide">
<span<?= $Page->rbd_ide->viewAttributes() ?>>
<?= $Page->rbd_ide->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
    <tr id="r_ket_rbd_ide">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide"><?= $Page->ket_rbd_ide->caption() ?></span></td>
        <td data-name="ket_rbd_ide" <?= $Page->ket_rbd_ide->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide">
<span<?= $Page->ket_rbd_ide->viewAttributes() ?>>
<?= $Page->ket_rbd_ide->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
    <tr id="r_rbd_rencana">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana"><?= $Page->rbd_rencana->caption() ?></span></td>
        <td data-name="rbd_rencana" <?= $Page->rbd_rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana">
<span<?= $Page->rbd_rencana->viewAttributes() ?>>
<?= $Page->rbd_rencana->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
    <tr id="r_ket_rbd_rencana">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana"><?= $Page->ket_rbd_rencana->caption() ?></span></td>
        <td data-name="ket_rbd_rencana" <?= $Page->ket_rbd_rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana">
<span<?= $Page->ket_rbd_rencana->viewAttributes() ?>>
<?= $Page->ket_rbd_rencana->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
    <tr id="r_rbd_alat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat"><?= $Page->rbd_alat->caption() ?></span></td>
        <td data-name="rbd_alat" <?= $Page->rbd_alat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat">
<span<?= $Page->rbd_alat->viewAttributes() ?>>
<?= $Page->rbd_alat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
    <tr id="r_ket_rbd_alat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat"><?= $Page->ket_rbd_alat->caption() ?></span></td>
        <td data-name="ket_rbd_alat" <?= $Page->ket_rbd_alat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat">
<span<?= $Page->ket_rbd_alat->viewAttributes() ?>>
<?= $Page->ket_rbd_alat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
    <tr id="r_rbd_percobaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan"><?= $Page->rbd_percobaan->caption() ?></span></td>
        <td data-name="rbd_percobaan" <?= $Page->rbd_percobaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan">
<span<?= $Page->rbd_percobaan->viewAttributes() ?>>
<?= $Page->rbd_percobaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
    <tr id="r_ket_rbd_percobaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan"><?= $Page->ket_rbd_percobaan->caption() ?></span></td>
        <td data-name="ket_rbd_percobaan" <?= $Page->ket_rbd_percobaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan">
<span<?= $Page->ket_rbd_percobaan->viewAttributes() ?>>
<?= $Page->ket_rbd_percobaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
    <tr id="r_rbd_keinginan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan"><?= $Page->rbd_keinginan->caption() ?></span></td>
        <td data-name="rbd_keinginan" <?= $Page->rbd_keinginan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan">
<span<?= $Page->rbd_keinginan->viewAttributes() ?>>
<?= $Page->rbd_keinginan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
    <tr id="r_ket_rbd_keinginan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan"><?= $Page->ket_rbd_keinginan->caption() ?></span></td>
        <td data-name="ket_rbd_keinginan" <?= $Page->ket_rbd_keinginan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan">
<span<?= $Page->ket_rbd_keinginan->viewAttributes() ?>>
<?= $Page->ket_rbd_keinginan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
    <tr id="r_rpo_penggunaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan"><?= $Page->rpo_penggunaan->caption() ?></span></td>
        <td data-name="rpo_penggunaan" <?= $Page->rpo_penggunaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan">
<span<?= $Page->rpo_penggunaan->viewAttributes() ?>>
<?= $Page->rpo_penggunaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
    <tr id="r_ket_rpo_penggunaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan"><?= $Page->ket_rpo_penggunaan->caption() ?></span></td>
        <td data-name="ket_rpo_penggunaan" <?= $Page->ket_rpo_penggunaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan">
<span<?= $Page->ket_rpo_penggunaan->viewAttributes() ?>>
<?= $Page->ket_rpo_penggunaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
    <tr id="r_rpo_efek_samping">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping"><?= $Page->rpo_efek_samping->caption() ?></span></td>
        <td data-name="rpo_efek_samping" <?= $Page->rpo_efek_samping->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping">
<span<?= $Page->rpo_efek_samping->viewAttributes() ?>>
<?= $Page->rpo_efek_samping->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
    <tr id="r_ket_rpo_efek_samping">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping"><?= $Page->ket_rpo_efek_samping->caption() ?></span></td>
        <td data-name="ket_rpo_efek_samping" <?= $Page->ket_rpo_efek_samping->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping">
<span<?= $Page->ket_rpo_efek_samping->viewAttributes() ?>>
<?= $Page->ket_rpo_efek_samping->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
    <tr id="r_rpo_napza">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza"><?= $Page->rpo_napza->caption() ?></span></td>
        <td data-name="rpo_napza" <?= $Page->rpo_napza->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza">
<span<?= $Page->rpo_napza->viewAttributes() ?>>
<?= $Page->rpo_napza->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
    <tr id="r_ket_rpo_napza">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza"><?= $Page->ket_rpo_napza->caption() ?></span></td>
        <td data-name="ket_rpo_napza" <?= $Page->ket_rpo_napza->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza">
<span<?= $Page->ket_rpo_napza->viewAttributes() ?>>
<?= $Page->ket_rpo_napza->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
    <tr id="r_ket_lama_pemakaian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian"><?= $Page->ket_lama_pemakaian->caption() ?></span></td>
        <td data-name="ket_lama_pemakaian" <?= $Page->ket_lama_pemakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian">
<span<?= $Page->ket_lama_pemakaian->viewAttributes() ?>>
<?= $Page->ket_lama_pemakaian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
    <tr id="r_ket_cara_pemakaian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian"><?= $Page->ket_cara_pemakaian->caption() ?></span></td>
        <td data-name="ket_cara_pemakaian" <?= $Page->ket_cara_pemakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian">
<span<?= $Page->ket_cara_pemakaian->viewAttributes() ?>>
<?= $Page->ket_cara_pemakaian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
    <tr id="r_ket_latar_belakang_pemakaian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian"><?= $Page->ket_latar_belakang_pemakaian->caption() ?></span></td>
        <td data-name="ket_latar_belakang_pemakaian" <?= $Page->ket_latar_belakang_pemakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian">
<span<?= $Page->ket_latar_belakang_pemakaian->viewAttributes() ?>>
<?= $Page->ket_latar_belakang_pemakaian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
    <tr id="r_rpo_penggunaan_obat_lainnya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya"><?= $Page->rpo_penggunaan_obat_lainnya->caption() ?></span></td>
        <td data-name="rpo_penggunaan_obat_lainnya" <?= $Page->rpo_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya">
<span<?= $Page->rpo_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->rpo_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
    <tr id="r_ket_penggunaan_obat_lainnya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya"><?= $Page->ket_penggunaan_obat_lainnya->caption() ?></span></td>
        <td data-name="ket_penggunaan_obat_lainnya" <?= $Page->ket_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya">
<span<?= $Page->ket_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->ket_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
    <tr id="r_ket_alasan_penggunaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan"><?= $Page->ket_alasan_penggunaan->caption() ?></span></td>
        <td data-name="ket_alasan_penggunaan" <?= $Page->ket_alasan_penggunaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan">
<span<?= $Page->ket_alasan_penggunaan->viewAttributes() ?>>
<?= $Page->ket_alasan_penggunaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
    <tr id="r_rpo_alergi_obat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat"><?= $Page->rpo_alergi_obat->caption() ?></span></td>
        <td data-name="rpo_alergi_obat" <?= $Page->rpo_alergi_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat">
<span<?= $Page->rpo_alergi_obat->viewAttributes() ?>>
<?= $Page->rpo_alergi_obat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
    <tr id="r_ket_alergi_obat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat"><?= $Page->ket_alergi_obat->caption() ?></span></td>
        <td data-name="ket_alergi_obat" <?= $Page->ket_alergi_obat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat">
<span<?= $Page->ket_alergi_obat->viewAttributes() ?>>
<?= $Page->ket_alergi_obat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
    <tr id="r_rpo_merokok">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok"><?= $Page->rpo_merokok->caption() ?></span></td>
        <td data-name="rpo_merokok" <?= $Page->rpo_merokok->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok">
<span<?= $Page->rpo_merokok->viewAttributes() ?>>
<?= $Page->rpo_merokok->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
    <tr id="r_ket_merokok">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok"><?= $Page->ket_merokok->caption() ?></span></td>
        <td data-name="ket_merokok" <?= $Page->ket_merokok->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok">
<span<?= $Page->ket_merokok->viewAttributes() ?>>
<?= $Page->ket_merokok->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
    <tr id="r_rpo_minum_kopi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi"><?= $Page->rpo_minum_kopi->caption() ?></span></td>
        <td data-name="rpo_minum_kopi" <?= $Page->rpo_minum_kopi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi">
<span<?= $Page->rpo_minum_kopi->viewAttributes() ?>>
<?= $Page->rpo_minum_kopi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
    <tr id="r_ket_minum_kopi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi"><?= $Page->ket_minum_kopi->caption() ?></span></td>
        <td data-name="ket_minum_kopi" <?= $Page->ket_minum_kopi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi">
<span<?= $Page->ket_minum_kopi->viewAttributes() ?>>
<?= $Page->ket_minum_kopi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <tr id="r_td">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_td"><?= $Page->td->caption() ?></span></td>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <tr id="r_nadi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nadi"><?= $Page->nadi->caption() ?></span></td>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <tr id="r_gcs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_gcs"><?= $Page->gcs->caption() ?></span></td>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <tr id="r_rr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rr"><?= $Page->rr->caption() ?></span></td>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <tr id="r_suhu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_suhu"><?= $Page->suhu->caption() ?></span></td>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
    <tr id="r_pf_keluhan_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik"><?= $Page->pf_keluhan_fisik->caption() ?></span></td>
        <td data-name="pf_keluhan_fisik" <?= $Page->pf_keluhan_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik">
<span<?= $Page->pf_keluhan_fisik->viewAttributes() ?>>
<?= $Page->pf_keluhan_fisik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
    <tr id="r_ket_keluhan_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik"><?= $Page->ket_keluhan_fisik->caption() ?></span></td>
        <td data-name="ket_keluhan_fisik" <?= $Page->ket_keluhan_fisik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik">
<span<?= $Page->ket_keluhan_fisik->viewAttributes() ?>>
<?= $Page->ket_keluhan_fisik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
    <tr id="r_skala_nyeri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri"><?= $Page->skala_nyeri->caption() ?></span></td>
        <td data-name="skala_nyeri" <?= $Page->skala_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri">
<span<?= $Page->skala_nyeri->viewAttributes() ?>>
<?= $Page->skala_nyeri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
    <tr id="r_durasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_durasi"><?= $Page->durasi->caption() ?></span></td>
        <td data-name="durasi" <?= $Page->durasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
    <tr id="r_nyeri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri"><?= $Page->nyeri->caption() ?></span></td>
        <td data-name="nyeri" <?= $Page->nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nyeri">
<span<?= $Page->nyeri->viewAttributes() ?>>
<?= $Page->nyeri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
    <tr id="r_provokes">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_provokes"><?= $Page->provokes->caption() ?></span></td>
        <td data-name="provokes" <?= $Page->provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_provokes">
<span<?= $Page->provokes->viewAttributes() ?>>
<?= $Page->provokes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
    <tr id="r_ket_provokes">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes"><?= $Page->ket_provokes->caption() ?></span></td>
        <td data-name="ket_provokes" <?= $Page->ket_provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes">
<span<?= $Page->ket_provokes->viewAttributes() ?>>
<?= $Page->ket_provokes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
    <tr id="r_quality">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_quality"><?= $Page->quality->caption() ?></span></td>
        <td data-name="quality" <?= $Page->quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_quality">
<span<?= $Page->quality->viewAttributes() ?>>
<?= $Page->quality->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
    <tr id="r_ket_quality">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality"><?= $Page->ket_quality->caption() ?></span></td>
        <td data-name="ket_quality" <?= $Page->ket_quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality">
<span<?= $Page->ket_quality->viewAttributes() ?>>
<?= $Page->ket_quality->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <tr id="r_lokasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lokasi"><?= $Page->lokasi->caption() ?></span></td>
        <td data-name="lokasi" <?= $Page->lokasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
    <tr id="r_menyebar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_menyebar"><?= $Page->menyebar->caption() ?></span></td>
        <td data-name="menyebar" <?= $Page->menyebar->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_menyebar">
<span<?= $Page->menyebar->viewAttributes() ?>>
<?= $Page->menyebar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
    <tr id="r_pada_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter"><?= $Page->pada_dokter->caption() ?></span></td>
        <td data-name="pada_dokter" <?= $Page->pada_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter">
<span<?= $Page->pada_dokter->viewAttributes() ?>>
<?= $Page->pada_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
    <tr id="r_ket_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter"><?= $Page->ket_dokter->caption() ?></span></td>
        <td data-name="ket_dokter" <?= $Page->ket_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter">
<span<?= $Page->ket_dokter->viewAttributes() ?>>
<?= $Page->ket_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
    <tr id="r_nyeri_hilang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang"><?= $Page->nyeri_hilang->caption() ?></span></td>
        <td data-name="nyeri_hilang" <?= $Page->nyeri_hilang->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang">
<span<?= $Page->nyeri_hilang->viewAttributes() ?>>
<?= $Page->nyeri_hilang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
    <tr id="r_ket_nyeri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri"><?= $Page->ket_nyeri->caption() ?></span></td>
        <td data-name="ket_nyeri" <?= $Page->ket_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri">
<span<?= $Page->ket_nyeri->viewAttributes() ?>>
<?= $Page->ket_nyeri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <tr id="r_bb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bb"><?= $Page->bb->caption() ?></span></td>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <tr id="r_tb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tb"><?= $Page->tb->caption() ?></span></td>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
    <tr id="r_bmi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bmi"><?= $Page->bmi->caption() ?></span></td>
        <td data-name="bmi" <?= $Page->bmi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_bmi">
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
    <tr id="r_lapor_status_nutrisi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi"><?= $Page->lapor_status_nutrisi->caption() ?></span></td>
        <td data-name="lapor_status_nutrisi" <?= $Page->lapor_status_nutrisi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi">
<span<?= $Page->lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->lapor_status_nutrisi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
    <tr id="r_ket_lapor_status_nutrisi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi"><?= $Page->ket_lapor_status_nutrisi->caption() ?></span></td>
        <td data-name="ket_lapor_status_nutrisi" <?= $Page->ket_lapor_status_nutrisi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi">
<span<?= $Page->ket_lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->ket_lapor_status_nutrisi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
    <tr id="r_sg1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg1"><?= $Page->sg1->caption() ?></span></td>
        <td data-name="sg1" <?= $Page->sg1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sg1">
<span<?= $Page->sg1->viewAttributes() ?>>
<?= $Page->sg1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
    <tr id="r_nilai1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai1"><?= $Page->nilai1->caption() ?></span></td>
        <td data-name="nilai1" <?= $Page->nilai1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nilai1">
<span<?= $Page->nilai1->viewAttributes() ?>>
<?= $Page->nilai1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
    <tr id="r_sg2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg2"><?= $Page->sg2->caption() ?></span></td>
        <td data-name="sg2" <?= $Page->sg2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sg2">
<span<?= $Page->sg2->viewAttributes() ?>>
<?= $Page->sg2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
    <tr id="r_nilai2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai2"><?= $Page->nilai2->caption() ?></span></td>
        <td data-name="nilai2" <?= $Page->nilai2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nilai2">
<span<?= $Page->nilai2->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_nilai2_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->nilai2->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->nilai2->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_nilai2_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
    <tr id="r_total_hasil">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil"><?= $Page->total_hasil->caption() ?></span></td>
        <td data-name="total_hasil" <?= $Page->total_hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil">
<span<?= $Page->total_hasil->viewAttributes() ?>>
<?= $Page->total_hasil->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
    <tr id="r_resikojatuh">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh"><?= $Page->resikojatuh->caption() ?></span></td>
        <td data-name="resikojatuh" <?= $Page->resikojatuh->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh">
<span<?= $Page->resikojatuh->viewAttributes() ?>>
<?= $Page->resikojatuh->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bjm->Visible) { // bjm ?>
    <tr id="r_bjm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bjm"><?= $Page->bjm->caption() ?></span></td>
        <td data-name="bjm" <?= $Page->bjm->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_bjm">
<span<?= $Page->bjm->viewAttributes() ?>>
<?= $Page->bjm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->msa->Visible) { // msa ?>
    <tr id="r_msa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_msa"><?= $Page->msa->caption() ?></span></td>
        <td data-name="msa" <?= $Page->msa->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_msa">
<span<?= $Page->msa->viewAttributes() ?>>
<?= $Page->msa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
    <tr id="r_hasil">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_hasil"><?= $Page->hasil->caption() ?></span></td>
        <td data-name="hasil" <?= $Page->hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_hasil">
<span<?= $Page->hasil->viewAttributes() ?>>
<?= $Page->hasil->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
    <tr id="r_lapor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor"><?= $Page->lapor->caption() ?></span></td>
        <td data-name="lapor" <?= $Page->lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_lapor">
<span<?= $Page->lapor->viewAttributes() ?>>
<?= $Page->lapor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
    <tr id="r_ket_lapor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor"><?= $Page->ket_lapor->caption() ?></span></td>
        <td data-name="ket_lapor" <?= $Page->ket_lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor">
<span<?= $Page->ket_lapor->viewAttributes() ?>>
<?= $Page->ket_lapor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
    <tr id="r_adl_mandi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi"><?= $Page->adl_mandi->caption() ?></span></td>
        <td data-name="adl_mandi" <?= $Page->adl_mandi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi">
<span<?= $Page->adl_mandi->viewAttributes() ?>>
<?= $Page->adl_mandi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
    <tr id="r_adl_berpakaian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian"><?= $Page->adl_berpakaian->caption() ?></span></td>
        <td data-name="adl_berpakaian" <?= $Page->adl_berpakaian->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian">
<span<?= $Page->adl_berpakaian->viewAttributes() ?>>
<?= $Page->adl_berpakaian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_makan->Visible) { // adl_makan ?>
    <tr id="r_adl_makan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan"><?= $Page->adl_makan->caption() ?></span></td>
        <td data-name="adl_makan" <?= $Page->adl_makan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan">
<span<?= $Page->adl_makan->viewAttributes() ?>>
<?= $Page->adl_makan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_bak->Visible) { // adl_bak ?>
    <tr id="r_adl_bak">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak"><?= $Page->adl_bak->caption() ?></span></td>
        <td data-name="adl_bak" <?= $Page->adl_bak->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak">
<span<?= $Page->adl_bak->viewAttributes() ?>>
<?= $Page->adl_bak->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_bab->Visible) { // adl_bab ?>
    <tr id="r_adl_bab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab"><?= $Page->adl_bab->caption() ?></span></td>
        <td data-name="adl_bab" <?= $Page->adl_bab->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab">
<span<?= $Page->adl_bab->viewAttributes() ?>>
<?= $Page->adl_bab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
    <tr id="r_adl_hobi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi"><?= $Page->adl_hobi->caption() ?></span></td>
        <td data-name="adl_hobi" <?= $Page->adl_hobi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi">
<span<?= $Page->adl_hobi->viewAttributes() ?>>
<?= $Page->adl_hobi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
    <tr id="r_ket_adl_hobi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi"><?= $Page->ket_adl_hobi->caption() ?></span></td>
        <td data-name="ket_adl_hobi" <?= $Page->ket_adl_hobi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi">
<span<?= $Page->ket_adl_hobi->viewAttributes() ?>>
<?= $Page->ket_adl_hobi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
    <tr id="r_adl_sosialisasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi"><?= $Page->adl_sosialisasi->caption() ?></span></td>
        <td data-name="adl_sosialisasi" <?= $Page->adl_sosialisasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi">
<span<?= $Page->adl_sosialisasi->viewAttributes() ?>>
<?= $Page->adl_sosialisasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
    <tr id="r_ket_adl_sosialisasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi"><?= $Page->ket_adl_sosialisasi->caption() ?></span></td>
        <td data-name="ket_adl_sosialisasi" <?= $Page->ket_adl_sosialisasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi">
<span<?= $Page->ket_adl_sosialisasi->viewAttributes() ?>>
<?= $Page->ket_adl_sosialisasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
    <tr id="r_adl_kegiatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan"><?= $Page->adl_kegiatan->caption() ?></span></td>
        <td data-name="adl_kegiatan" <?= $Page->adl_kegiatan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan">
<span<?= $Page->adl_kegiatan->viewAttributes() ?>>
<?= $Page->adl_kegiatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
    <tr id="r_ket_adl_kegiatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan"><?= $Page->ket_adl_kegiatan->caption() ?></span></td>
        <td data-name="ket_adl_kegiatan" <?= $Page->ket_adl_kegiatan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan">
<span<?= $Page->ket_adl_kegiatan->viewAttributes() ?>>
<?= $Page->ket_adl_kegiatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
    <tr id="r_sk_penampilan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan"><?= $Page->sk_penampilan->caption() ?></span></td>
        <td data-name="sk_penampilan" <?= $Page->sk_penampilan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan">
<span<?= $Page->sk_penampilan->viewAttributes() ?>>
<?= $Page->sk_penampilan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
    <tr id="r_sk_alam_perasaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan"><?= $Page->sk_alam_perasaan->caption() ?></span></td>
        <td data-name="sk_alam_perasaan" <?= $Page->sk_alam_perasaan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan">
<span<?= $Page->sk_alam_perasaan->viewAttributes() ?>>
<?= $Page->sk_alam_perasaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
    <tr id="r_sk_pembicaraan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan"><?= $Page->sk_pembicaraan->caption() ?></span></td>
        <td data-name="sk_pembicaraan" <?= $Page->sk_pembicaraan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan">
<span<?= $Page->sk_pembicaraan->viewAttributes() ?>>
<?= $Page->sk_pembicaraan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_afek->Visible) { // sk_afek ?>
    <tr id="r_sk_afek">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek"><?= $Page->sk_afek->caption() ?></span></td>
        <td data-name="sk_afek" <?= $Page->sk_afek->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek">
<span<?= $Page->sk_afek->viewAttributes() ?>>
<?= $Page->sk_afek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
    <tr id="r_sk_aktifitas_motorik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik"><?= $Page->sk_aktifitas_motorik->caption() ?></span></td>
        <td data-name="sk_aktifitas_motorik" <?= $Page->sk_aktifitas_motorik->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik">
<span<?= $Page->sk_aktifitas_motorik->viewAttributes() ?>>
<?= $Page->sk_aktifitas_motorik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
    <tr id="r_sk_gangguan_ringan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan"><?= $Page->sk_gangguan_ringan->caption() ?></span></td>
        <td data-name="sk_gangguan_ringan" <?= $Page->sk_gangguan_ringan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan">
<span<?= $Page->sk_gangguan_ringan->viewAttributes() ?>>
<?= $Page->sk_gangguan_ringan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
    <tr id="r_sk_proses_pikir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir"><?= $Page->sk_proses_pikir->caption() ?></span></td>
        <td data-name="sk_proses_pikir" <?= $Page->sk_proses_pikir->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir">
<span<?= $Page->sk_proses_pikir->viewAttributes() ?>>
<?= $Page->sk_proses_pikir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
    <tr id="r_sk_orientasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi"><?= $Page->sk_orientasi->caption() ?></span></td>
        <td data-name="sk_orientasi" <?= $Page->sk_orientasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi">
<span<?= $Page->sk_orientasi->viewAttributes() ?>>
<?= $Page->sk_orientasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
    <tr id="r_sk_tingkat_kesadaran_orientasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi"><?= $Page->sk_tingkat_kesadaran_orientasi->caption() ?></span></td>
        <td data-name="sk_tingkat_kesadaran_orientasi" <?= $Page->sk_tingkat_kesadaran_orientasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi">
<span<?= $Page->sk_tingkat_kesadaran_orientasi->viewAttributes() ?>>
<?= $Page->sk_tingkat_kesadaran_orientasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_memori->Visible) { // sk_memori ?>
    <tr id="r_sk_memori">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori"><?= $Page->sk_memori->caption() ?></span></td>
        <td data-name="sk_memori" <?= $Page->sk_memori->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori">
<span<?= $Page->sk_memori->viewAttributes() ?>>
<?= $Page->sk_memori->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
    <tr id="r_sk_interaksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi"><?= $Page->sk_interaksi->caption() ?></span></td>
        <td data-name="sk_interaksi" <?= $Page->sk_interaksi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi">
<span<?= $Page->sk_interaksi->viewAttributes() ?>>
<?= $Page->sk_interaksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
    <tr id="r_sk_konsentrasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi"><?= $Page->sk_konsentrasi->caption() ?></span></td>
        <td data-name="sk_konsentrasi" <?= $Page->sk_konsentrasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi">
<span<?= $Page->sk_konsentrasi->viewAttributes() ?>>
<?= $Page->sk_konsentrasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
    <tr id="r_sk_persepsi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi"><?= $Page->sk_persepsi->caption() ?></span></td>
        <td data-name="sk_persepsi" <?= $Page->sk_persepsi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi">
<span<?= $Page->sk_persepsi->viewAttributes() ?>>
<?= $Page->sk_persepsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
    <tr id="r_ket_sk_persepsi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi"><?= $Page->ket_sk_persepsi->caption() ?></span></td>
        <td data-name="ket_sk_persepsi" <?= $Page->ket_sk_persepsi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi">
<span<?= $Page->ket_sk_persepsi->viewAttributes() ?>>
<?= $Page->ket_sk_persepsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
    <tr id="r_sk_isi_pikir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir"><?= $Page->sk_isi_pikir->caption() ?></span></td>
        <td data-name="sk_isi_pikir" <?= $Page->sk_isi_pikir->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir">
<span<?= $Page->sk_isi_pikir->viewAttributes() ?>>
<?= $Page->sk_isi_pikir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_waham->Visible) { // sk_waham ?>
    <tr id="r_sk_waham">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham"><?= $Page->sk_waham->caption() ?></span></td>
        <td data-name="sk_waham" <?= $Page->sk_waham->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham">
<span<?= $Page->sk_waham->viewAttributes() ?>>
<?= $Page->sk_waham->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
    <tr id="r_ket_sk_waham">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham"><?= $Page->ket_sk_waham->caption() ?></span></td>
        <td data-name="ket_sk_waham" <?= $Page->ket_sk_waham->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham">
<span<?= $Page->ket_sk_waham->viewAttributes() ?>>
<?= $Page->ket_sk_waham->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
    <tr id="r_sk_daya_tilik_diri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri"><?= $Page->sk_daya_tilik_diri->caption() ?></span></td>
        <td data-name="sk_daya_tilik_diri" <?= $Page->sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri">
<span<?= $Page->sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->sk_daya_tilik_diri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
    <tr id="r_ket_sk_daya_tilik_diri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri"><?= $Page->ket_sk_daya_tilik_diri->caption() ?></span></td>
        <td data-name="ket_sk_daya_tilik_diri" <?= $Page->ket_sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri">
<span<?= $Page->ket_sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->ket_sk_daya_tilik_diri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
    <tr id="r_kk_pembelajaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran"><?= $Page->kk_pembelajaran->caption() ?></span></td>
        <td data-name="kk_pembelajaran" <?= $Page->kk_pembelajaran->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran">
<span<?= $Page->kk_pembelajaran->viewAttributes() ?>>
<?= $Page->kk_pembelajaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
    <tr id="r_ket_kk_pembelajaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran"><?= $Page->ket_kk_pembelajaran->caption() ?></span></td>
        <td data-name="ket_kk_pembelajaran" <?= $Page->ket_kk_pembelajaran->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran">
<span<?= $Page->ket_kk_pembelajaran->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
    <tr id="r_ket_kk_pembelajaran_lainnya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya"><?= $Page->ket_kk_pembelajaran_lainnya->caption() ?></span></td>
        <td data-name="ket_kk_pembelajaran_lainnya" <?= $Page->ket_kk_pembelajaran_lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya">
<span<?= $Page->ket_kk_pembelajaran_lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran_lainnya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
    <tr id="r_kk_Penerjamah">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah"><?= $Page->kk_Penerjamah->caption() ?></span></td>
        <td data-name="kk_Penerjamah" <?= $Page->kk_Penerjamah->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah">
<span<?= $Page->kk_Penerjamah->viewAttributes() ?>>
<?= $Page->kk_Penerjamah->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
    <tr id="r_ket_kk_penerjamah_Lainnya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya"><?= $Page->ket_kk_penerjamah_Lainnya->caption() ?></span></td>
        <td data-name="ket_kk_penerjamah_Lainnya" <?= $Page->ket_kk_penerjamah_Lainnya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya">
<span<?= $Page->ket_kk_penerjamah_Lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_penerjamah_Lainnya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
    <tr id="r_kk_bahasa_isyarat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat"><?= $Page->kk_bahasa_isyarat->caption() ?></span></td>
        <td data-name="kk_bahasa_isyarat" <?= $Page->kk_bahasa_isyarat->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat">
<span<?= $Page->kk_bahasa_isyarat->viewAttributes() ?>>
<?= $Page->kk_bahasa_isyarat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
    <tr id="r_kk_kebutuhan_edukasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi"><?= $Page->kk_kebutuhan_edukasi->caption() ?></span></td>
        <td data-name="kk_kebutuhan_edukasi" <?= $Page->kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi">
<span<?= $Page->kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
    <tr id="r_ket_kk_kebutuhan_edukasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi"><?= $Page->ket_kk_kebutuhan_edukasi->caption() ?></span></td>
        <td data-name="ket_kk_kebutuhan_edukasi" <?= $Page->ket_kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi">
<span<?= $Page->ket_kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->ket_kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
    <tr id="r_rencana">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rencana"><?= $Page->rencana->caption() ?></span></td>
        <td data-name="rencana" <?= $Page->rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_rencana">
<span<?= $Page->rencana->viewAttributes() ?>>
<?= $Page->rencana->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <tr id="r_nip">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nip"><?= $Page->nip->caption() ?></span></td>
        <td data-name="nip" <?= $Page->nip->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_psikiatri_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
