<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$RegPeriksaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var freg_periksaview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    freg_periksaview = currentForm = new ew.Form("freg_periksaview", "view");
    loadjs.done("freg_periksaview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.reg_periksa) ew.vars.tables.reg_periksa = <?= JsonEncode(GetClientVar("tables", "reg_periksa")) ?>;
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
<form name="freg_periksaview" id="freg_periksaview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reg_periksa">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <tr id="r_no_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_no_reg"><?= $Page->no_reg->caption() ?></span></td>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_reg_periksa_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_reg_periksa_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
    <tr id="r_tgl_registrasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_tgl_registrasi"><?= $Page->tgl_registrasi->caption() ?></span></td>
        <td data-name="tgl_registrasi" <?= $Page->tgl_registrasi->cellAttributes() ?>>
<span id="el_reg_periksa_tgl_registrasi">
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_reg->Visible) { // jam_reg ?>
    <tr id="r_jam_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_jam_reg"><?= $Page->jam_reg->caption() ?></span></td>
        <td data-name="jam_reg" <?= $Page->jam_reg->cellAttributes() ?>>
<span id="el_reg_periksa_jam_reg">
<span<?= $Page->jam_reg->viewAttributes() ?>>
<?= $Page->jam_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_reg_periksa_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <tr id="r_no_rkm_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></td>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_reg_periksa_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <tr id="r_kd_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_kd_poli"><?= $Page->kd_poli->caption() ?></span></td>
        <td data-name="kd_poli" <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_reg_periksa_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->p_jawab->Visible) { // p_jawab ?>
    <tr id="r_p_jawab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_p_jawab"><?= $Page->p_jawab->caption() ?></span></td>
        <td data-name="p_jawab" <?= $Page->p_jawab->cellAttributes() ?>>
<span id="el_reg_periksa_p_jawab">
<span<?= $Page->p_jawab->viewAttributes() ?>>
<?= $Page->p_jawab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->almt_pj->Visible) { // almt_pj ?>
    <tr id="r_almt_pj">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_almt_pj"><?= $Page->almt_pj->caption() ?></span></td>
        <td data-name="almt_pj" <?= $Page->almt_pj->cellAttributes() ?>>
<span id="el_reg_periksa_almt_pj">
<span<?= $Page->almt_pj->viewAttributes() ?>>
<?= $Page->almt_pj->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hubunganpj->Visible) { // hubunganpj ?>
    <tr id="r_hubunganpj">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_hubunganpj"><?= $Page->hubunganpj->caption() ?></span></td>
        <td data-name="hubunganpj" <?= $Page->hubunganpj->cellAttributes() ?>>
<span id="el_reg_periksa_hubunganpj">
<span<?= $Page->hubunganpj->viewAttributes() ?>>
<?= $Page->hubunganpj->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->biaya_reg->Visible) { // biaya_reg ?>
    <tr id="r_biaya_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_biaya_reg"><?= $Page->biaya_reg->caption() ?></span></td>
        <td data-name="biaya_reg" <?= $Page->biaya_reg->cellAttributes() ?>>
<span id="el_reg_periksa_biaya_reg">
<span<?= $Page->biaya_reg->viewAttributes() ?>>
<?= $Page->biaya_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stts->Visible) { // stts ?>
    <tr id="r_stts">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_stts"><?= $Page->stts->caption() ?></span></td>
        <td data-name="stts" <?= $Page->stts->cellAttributes() ?>>
<span id="el_reg_periksa_stts">
<span<?= $Page->stts->viewAttributes() ?>>
<?= $Page->stts->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stts_daftar->Visible) { // stts_daftar ?>
    <tr id="r_stts_daftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_stts_daftar"><?= $Page->stts_daftar->caption() ?></span></td>
        <td data-name="stts_daftar" <?= $Page->stts_daftar->cellAttributes() ?>>
<span id="el_reg_periksa_stts_daftar">
<span<?= $Page->stts_daftar->viewAttributes() ?>>
<?= $Page->stts_daftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_lanjut->Visible) { // status_lanjut ?>
    <tr id="r_status_lanjut">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_status_lanjut"><?= $Page->status_lanjut->caption() ?></span></td>
        <td data-name="status_lanjut" <?= $Page->status_lanjut->cellAttributes() ?>>
<span id="el_reg_periksa_status_lanjut">
<span<?= $Page->status_lanjut->viewAttributes() ?>>
<?= $Page->status_lanjut->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_pj->Visible) { // kd_pj ?>
    <tr id="r_kd_pj">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_kd_pj"><?= $Page->kd_pj->caption() ?></span></td>
        <td data-name="kd_pj" <?= $Page->kd_pj->cellAttributes() ?>>
<span id="el_reg_periksa_kd_pj">
<span<?= $Page->kd_pj->viewAttributes() ?>>
<?= $Page->kd_pj->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->umurdaftar->Visible) { // umurdaftar ?>
    <tr id="r_umurdaftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_umurdaftar"><?= $Page->umurdaftar->caption() ?></span></td>
        <td data-name="umurdaftar" <?= $Page->umurdaftar->cellAttributes() ?>>
<span id="el_reg_periksa_umurdaftar">
<span<?= $Page->umurdaftar->viewAttributes() ?>>
<?= $Page->umurdaftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sttsumur->Visible) { // sttsumur ?>
    <tr id="r_sttsumur">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_sttsumur"><?= $Page->sttsumur->caption() ?></span></td>
        <td data-name="sttsumur" <?= $Page->sttsumur->cellAttributes() ?>>
<span id="el_reg_periksa_sttsumur">
<span<?= $Page->sttsumur->viewAttributes() ?>>
<?= $Page->sttsumur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_bayar->Visible) { // status_bayar ?>
    <tr id="r_status_bayar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_status_bayar"><?= $Page->status_bayar->caption() ?></span></td>
        <td data-name="status_bayar" <?= $Page->status_bayar->cellAttributes() ?>>
<span id="el_reg_periksa_status_bayar">
<span<?= $Page->status_bayar->viewAttributes() ?>>
<?= $Page->status_bayar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_poli->Visible) { // status_poli ?>
    <tr id="r_status_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_status_poli"><?= $Page->status_poli->caption() ?></span></td>
        <td data-name="status_poli" <?= $Page->status_poli->cellAttributes() ?>>
<span id="el_reg_periksa_status_poli">
<span<?= $Page->status_poli->viewAttributes() ?>>
<?= $Page->status_poli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_reg->Visible) { // id_reg ?>
    <tr id="r_id_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reg_periksa_id_reg"><?= $Page->id_reg->caption() ?></span></td>
        <td data-name="id_reg" <?= $Page->id_reg->cellAttributes() ?>>
<span id="el_reg_periksa_id_reg">
<span<?= $Page->id_reg->viewAttributes() ?>>
<?= $Page->id_reg->getViewValue() ?></span>
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
