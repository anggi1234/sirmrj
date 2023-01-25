<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MPasienView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_pasienview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fm_pasienview = currentForm = new ew.Form("fm_pasienview", "view");
    loadjs.done("fm_pasienview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.m_pasien) ew.vars.tables.m_pasien = <?= JsonEncode(GetClientVar("tables", "m_pasien")) ?>;
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
<form name="fm_pasienview" id="fm_pasienview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_pasien">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <tr id="r_no_rkm_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></td>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_m_pasien_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
    <tr id="r_nm_pasien">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_nm_pasien"><?= $Page->nm_pasien->caption() ?></span></td>
        <td data-name="nm_pasien" <?= $Page->nm_pasien->cellAttributes() ?>>
<span id="el_m_pasien_nm_pasien">
<span<?= $Page->nm_pasien->viewAttributes() ?>>
<?= $Page->nm_pasien->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_ktp->Visible) { // no_ktp ?>
    <tr id="r_no_ktp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_no_ktp"><?= $Page->no_ktp->caption() ?></span></td>
        <td data-name="no_ktp" <?= $Page->no_ktp->cellAttributes() ?>>
<span id="el_m_pasien_no_ktp">
<span<?= $Page->no_ktp->viewAttributes() ?>>
<?= $Page->no_ktp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
    <tr id="r_jk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_jk"><?= $Page->jk->caption() ?></span></td>
        <td data-name="jk" <?= $Page->jk->cellAttributes() ?>>
<span id="el_m_pasien_jk">
<span<?= $Page->jk->viewAttributes() ?>>
<?= $Page->jk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tmp_lahir->Visible) { // tmp_lahir ?>
    <tr id="r_tmp_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_tmp_lahir"><?= $Page->tmp_lahir->caption() ?></span></td>
        <td data-name="tmp_lahir" <?= $Page->tmp_lahir->cellAttributes() ?>>
<span id="el_m_pasien_tmp_lahir">
<span<?= $Page->tmp_lahir->viewAttributes() ?>>
<?= $Page->tmp_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
    <tr id="r_tgl_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_tgl_lahir"><?= $Page->tgl_lahir->caption() ?></span></td>
        <td data-name="tgl_lahir" <?= $Page->tgl_lahir->cellAttributes() ?>>
<span id="el_m_pasien_tgl_lahir">
<span<?= $Page->tgl_lahir->viewAttributes() ?>>
<?= $Page->tgl_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
    <tr id="r_nm_ibu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_nm_ibu"><?= $Page->nm_ibu->caption() ?></span></td>
        <td data-name="nm_ibu" <?= $Page->nm_ibu->cellAttributes() ?>>
<span id="el_m_pasien_nm_ibu">
<span<?= $Page->nm_ibu->viewAttributes() ?>>
<?= $Page->nm_ibu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <tr id="r_alamat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_alamat"><?= $Page->alamat->caption() ?></span></td>
        <td data-name="alamat" <?= $Page->alamat->cellAttributes() ?>>
<span id="el_m_pasien_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <tr id="r_pekerjaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_pekerjaan"><?= $Page->pekerjaan->caption() ?></span></td>
        <td data-name="pekerjaan" <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el_m_pasien_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stts_nikah->Visible) { // stts_nikah ?>
    <tr id="r_stts_nikah">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_stts_nikah"><?= $Page->stts_nikah->caption() ?></span></td>
        <td data-name="stts_nikah" <?= $Page->stts_nikah->cellAttributes() ?>>
<span id="el_m_pasien_stts_nikah">
<span<?= $Page->stts_nikah->viewAttributes() ?>>
<?= $Page->stts_nikah->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <tr id="r_agama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_agama"><?= $Page->agama->caption() ?></span></td>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el_m_pasien_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
    <tr id="r_tgl_daftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_tgl_daftar"><?= $Page->tgl_daftar->caption() ?></span></td>
        <td data-name="tgl_daftar" <?= $Page->tgl_daftar->cellAttributes() ?>>
<span id="el_m_pasien_tgl_daftar">
<span<?= $Page->tgl_daftar->viewAttributes() ?>>
<?= $Page->tgl_daftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_pj->Visible) { // kd_pj ?>
    <tr id="r_kd_pj">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_kd_pj"><?= $Page->kd_pj->caption() ?></span></td>
        <td data-name="kd_pj" <?= $Page->kd_pj->cellAttributes() ?>>
<span id="el_m_pasien_kd_pj">
<span<?= $Page->kd_pj->viewAttributes() ?>>
<?= $Page->kd_pj->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_kel->Visible) { // kd_kel ?>
    <tr id="r_kd_kel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_kd_kel"><?= $Page->kd_kel->caption() ?></span></td>
        <td data-name="kd_kel" <?= $Page->kd_kel->cellAttributes() ?>>
<span id="el_m_pasien_kd_kel">
<span<?= $Page->kd_kel->viewAttributes() ?>>
<?= $Page->kd_kel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_kec->Visible) { // kd_kec ?>
    <tr id="r_kd_kec">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_kd_kec"><?= $Page->kd_kec->caption() ?></span></td>
        <td data-name="kd_kec" <?= $Page->kd_kec->cellAttributes() ?>>
<span id="el_m_pasien_kd_kec">
<span<?= $Page->kd_kec->viewAttributes() ?>>
<?= $Page->kd_kec->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_kab->Visible) { // kd_kab ?>
    <tr id="r_kd_kab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_kd_kab"><?= $Page->kd_kab->caption() ?></span></td>
        <td data-name="kd_kab" <?= $Page->kd_kab->cellAttributes() ?>>
<span id="el_m_pasien_kd_kab">
<span<?= $Page->kd_kab->viewAttributes() ?>>
<?= $Page->kd_kab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_prop->Visible) { // kd_prop ?>
    <tr id="r_kd_prop">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_kd_prop"><?= $Page->kd_prop->caption() ?></span></td>
        <td data-name="kd_prop" <?= $Page->kd_prop->cellAttributes() ?>>
<span id="el_m_pasien_kd_prop">
<span<?= $Page->kd_prop->viewAttributes() ?>>
<?= $Page->kd_prop->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suku_bangsa->Visible) { // suku_bangsa ?>
    <tr id="r_suku_bangsa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_suku_bangsa"><?= $Page->suku_bangsa->caption() ?></span></td>
        <td data-name="suku_bangsa" <?= $Page->suku_bangsa->cellAttributes() ?>>
<span id="el_m_pasien_suku_bangsa">
<span<?= $Page->suku_bangsa->viewAttributes() ?>>
<?= $Page->suku_bangsa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bahasa_pasien->Visible) { // bahasa_pasien ?>
    <tr id="r_bahasa_pasien">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_bahasa_pasien"><?= $Page->bahasa_pasien->caption() ?></span></td>
        <td data-name="bahasa_pasien" <?= $Page->bahasa_pasien->cellAttributes() ?>>
<span id="el_m_pasien_bahasa_pasien">
<span<?= $Page->bahasa_pasien->viewAttributes() ?>>
<?= $Page->bahasa_pasien->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cacat_fisik->Visible) { // cacat_fisik ?>
    <tr id="r_cacat_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_pasien_cacat_fisik"><?= $Page->cacat_fisik->caption() ?></span></td>
        <td data-name="cacat_fisik" <?= $Page->cacat_fisik->cellAttributes() ?>>
<span id="el_m_pasien_cacat_fisik">
<span<?= $Page->cacat_fisik->viewAttributes() ?>>
<?= $Page->cacat_fisik->getViewValue() ?></span>
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
