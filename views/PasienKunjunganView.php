<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PasienKunjunganView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpasien_kunjunganview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpasien_kunjunganview = currentForm = new ew.Form("fpasien_kunjunganview", "view");
    loadjs.done("fpasien_kunjunganview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.pasien_kunjungan) ew.vars.tables.pasien_kunjungan = <?= JsonEncode(GetClientVar("tables", "pasien_kunjungan")) ?>;
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
<form name="fpasien_kunjunganview" id="fpasien_kunjunganview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien_kunjungan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_reg->Visible) { // id_reg ?>
    <tr id="r_id_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_id_reg"><?= $Page->id_reg->caption() ?></span></td>
        <td data-name="id_reg" <?= $Page->id_reg->cellAttributes() ?>>
<span id="el_pasien_kunjungan_id_reg">
<span<?= $Page->id_reg->viewAttributes() ?>>
<?= $Page->id_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <tr id="r_no_rkm_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></td>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_pasien_kunjungan_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <tr id="r_kd_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_kd_poli"><?= $Page->kd_poli->caption() ?></span></td>
        <td data-name="kd_poli" <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_pasien_kunjungan_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_pasien_kunjungan_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
    <tr id="r_tgl_registrasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_tgl_registrasi"><?= $Page->tgl_registrasi->caption() ?></span></td>
        <td data-name="tgl_registrasi" <?= $Page->tgl_registrasi->cellAttributes() ?>>
<span id="el_pasien_kunjungan_tgl_registrasi">
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->almt_pj->Visible) { // almt_pj ?>
    <tr id="r_almt_pj">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_almt_pj"><?= $Page->almt_pj->caption() ?></span></td>
        <td data-name="almt_pj" <?= $Page->almt_pj->cellAttributes() ?>>
<span id="el_pasien_kunjungan_almt_pj">
<span<?= $Page->almt_pj->viewAttributes() ?>>
<?= $Page->almt_pj->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stts->Visible) { // stts ?>
    <tr id="r_stts">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_stts"><?= $Page->stts->caption() ?></span></td>
        <td data-name="stts" <?= $Page->stts->cellAttributes() ?>>
<span id="el_pasien_kunjungan_stts">
<span<?= $Page->stts->viewAttributes() ?>>
<?= $Page->stts->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->umurdaftar->Visible) { // umurdaftar ?>
    <tr id="r_umurdaftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_kunjungan_umurdaftar"><?= $Page->umurdaftar->caption() ?></span></td>
        <td data-name="umurdaftar" <?= $Page->umurdaftar->cellAttributes() ?>>
<span id="el_pasien_kunjungan_umurdaftar">
<span<?= $Page->umurdaftar->viewAttributes() ?>>
<?= $Page->umurdaftar->getViewValue() ?></span>
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
