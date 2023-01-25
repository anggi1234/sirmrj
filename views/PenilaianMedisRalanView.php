<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisRalanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_ralanview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenilaian_medis_ralanview = currentForm = new ew.Form("fpenilaian_medis_ralanview", "view");
    loadjs.done("fpenilaian_medis_ralanview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penilaian_medis_ralan) ew.vars.tables.penilaian_medis_ralan = <?= JsonEncode(GetClientVar("tables", "penilaian_medis_ralan")) ?>;
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
<form name="fpenilaian_medis_ralanview" id="fpenilaian_medis_ralanview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_ralan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <tr id="r_anamnesis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anamnesis"><?= $Page->anamnesis->caption() ?></span></td>
        <td data-name="anamnesis" <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <tr id="r_keluhan_utama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_keluhan_utama"><?= $Page->keluhan_utama->caption() ?></span></td>
        <td data-name="keluhan_utama" <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_keluhan_utama">
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <tr id="r_alergi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_alergi"><?= $Page->alergi->caption() ?></span></td>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <tr id="r_keadaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_keadaan"><?= $Page->keadaan->caption() ?></span></td>
        <td data-name="keadaan" <?= $Page->keadaan->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <tr id="r_gcs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_gcs"><?= $Page->gcs->caption() ?></span></td>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <tr id="r_kesadaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_kesadaran"><?= $Page->kesadaran->caption() ?></span></td>
        <td data-name="kesadaran" <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_kesadaran">
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <tr id="r_td">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_td"><?= $Page->td->caption() ?></span></td>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <tr id="r_nadi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_nadi"><?= $Page->nadi->caption() ?></span></td>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <tr id="r_rr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_rr"><?= $Page->rr->caption() ?></span></td>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <tr id="r_suhu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_suhu"><?= $Page->suhu->caption() ?></span></td>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <tr id="r_bb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_bb"><?= $Page->bb->caption() ?></span></td>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <tr id="r_tb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_tb"><?= $Page->tb->caption() ?></span></td>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_fisik->Visible) { // ket_fisik ?>
    <tr id="r_ket_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_ket_fisik"><?= $Page->ket_fisik->caption() ?></span></td>
        <td data-name="ket_fisik" <?= $Page->ket_fisik->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_ket_fisik">
<span<?= $Page->ket_fisik->viewAttributes() ?>>
<?= $Page->ket_fisik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->penunjang->Visible) { // penunjang ?>
    <tr id="r_penunjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_penunjang"><?= $Page->penunjang->caption() ?></span></td>
        <td data-name="penunjang" <?= $Page->penunjang->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_penunjang">
<span<?= $Page->penunjang->viewAttributes() ?>>
<?= $Page->penunjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
    <tr id="r_diagnosis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_diagnosis"><?= $Page->diagnosis->caption() ?></span></td>
        <td data-name="diagnosis" <?= $Page->diagnosis->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_diagnosis">
<span<?= $Page->diagnosis->viewAttributes() ?>>
<?= $Page->diagnosis->getViewValue() ?></span>
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
