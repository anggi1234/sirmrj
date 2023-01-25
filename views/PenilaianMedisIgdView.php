<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisIgdView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_igdview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenilaian_medis_igdview = currentForm = new ew.Form("fpenilaian_medis_igdview", "view");
    loadjs.done("fpenilaian_medis_igdview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penilaian_medis_igd) ew.vars.tables.penilaian_medis_igd = <?= JsonEncode(GetClientVar("tables", "penilaian_medis_igd")) ?>;
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
<form name="fpenilaian_medis_igdview" id="fpenilaian_medis_igdview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_igd">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_penilaian_medis_igd->Visible) { // id_penilaian_medis_igd ?>
    <tr id="r_id_penilaian_medis_igd">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_id_penilaian_medis_igd"><?= $Page->id_penilaian_medis_igd->caption() ?></span></td>
        <td data-name="id_penilaian_medis_igd" <?= $Page->id_penilaian_medis_igd->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_id_penilaian_medis_igd">
<span<?= $Page->id_penilaian_medis_igd->viewAttributes() ?>>
<?= $Page->id_penilaian_medis_igd->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <tr id="r_anamnesis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_anamnesis"><?= $Page->anamnesis->caption() ?></span></td>
        <td data-name="anamnesis" <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
    <tr id="r_hubungan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_hubungan"><?= $Page->hubungan->caption() ?></span></td>
        <td data-name="hubungan" <?= $Page->hubungan->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_hubungan">
<span<?= $Page->hubungan->viewAttributes() ?>>
<?= $Page->hubungan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <tr id="r_keluhan_utama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_keluhan_utama"><?= $Page->keluhan_utama->caption() ?></span></td>
        <td data-name="keluhan_utama" <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_keluhan_utama">
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rps->Visible) { // rps ?>
    <tr id="r_rps">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_rps"><?= $Page->rps->caption() ?></span></td>
        <td data-name="rps" <?= $Page->rps->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rps">
<span<?= $Page->rps->viewAttributes() ?>>
<?= $Page->rps->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpd->Visible) { // rpd ?>
    <tr id="r_rpd">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_rpd"><?= $Page->rpd->caption() ?></span></td>
        <td data-name="rpd" <?= $Page->rpd->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rpd">
<span<?= $Page->rpd->viewAttributes() ?>>
<?= $Page->rpd->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpk->Visible) { // rpk ?>
    <tr id="r_rpk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_rpk"><?= $Page->rpk->caption() ?></span></td>
        <td data-name="rpk" <?= $Page->rpk->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rpk">
<span<?= $Page->rpk->viewAttributes() ?>>
<?= $Page->rpk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo->Visible) { // rpo ?>
    <tr id="r_rpo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_rpo"><?= $Page->rpo->caption() ?></span></td>
        <td data-name="rpo" <?= $Page->rpo->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rpo">
<span<?= $Page->rpo->viewAttributes() ?>>
<?= $Page->rpo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <tr id="r_alergi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_alergi"><?= $Page->alergi->caption() ?></span></td>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <tr id="r_keadaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_keadaan"><?= $Page->keadaan->caption() ?></span></td>
        <td data-name="keadaan" <?= $Page->keadaan->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <tr id="r_gcs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_gcs"><?= $Page->gcs->caption() ?></span></td>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <tr id="r_kesadaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_kesadaran"><?= $Page->kesadaran->caption() ?></span></td>
        <td data-name="kesadaran" <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_kesadaran">
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <tr id="r_td">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_td"><?= $Page->td->caption() ?></span></td>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <tr id="r_nadi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_nadi"><?= $Page->nadi->caption() ?></span></td>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <tr id="r_rr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_rr"><?= $Page->rr->caption() ?></span></td>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <tr id="r_suhu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_suhu"><?= $Page->suhu->caption() ?></span></td>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->spo->Visible) { // spo ?>
    <tr id="r_spo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_spo"><?= $Page->spo->caption() ?></span></td>
        <td data-name="spo" <?= $Page->spo->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_spo">
<span<?= $Page->spo->viewAttributes() ?>>
<?= $Page->spo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <tr id="r_bb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_bb"><?= $Page->bb->caption() ?></span></td>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <tr id="r_tb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_tb"><?= $Page->tb->caption() ?></span></td>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kepala->Visible) { // kepala ?>
    <tr id="r_kepala">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_kepala"><?= $Page->kepala->caption() ?></span></td>
        <td data-name="kepala" <?= $Page->kepala->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_kepala">
<span<?= $Page->kepala->viewAttributes() ?>>
<?= $Page->kepala->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mata->Visible) { // mata ?>
    <tr id="r_mata">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_mata"><?= $Page->mata->caption() ?></span></td>
        <td data-name="mata" <?= $Page->mata->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_mata">
<span<?= $Page->mata->viewAttributes() ?>>
<?= $Page->mata->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gigi->Visible) { // gigi ?>
    <tr id="r_gigi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_gigi"><?= $Page->gigi->caption() ?></span></td>
        <td data-name="gigi" <?= $Page->gigi->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_gigi">
<span<?= $Page->gigi->viewAttributes() ?>>
<?= $Page->gigi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->leher->Visible) { // leher ?>
    <tr id="r_leher">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_leher"><?= $Page->leher->caption() ?></span></td>
        <td data-name="leher" <?= $Page->leher->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_leher">
<span<?= $Page->leher->viewAttributes() ?>>
<?= $Page->leher->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thoraks->Visible) { // thoraks ?>
    <tr id="r_thoraks">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_thoraks"><?= $Page->thoraks->caption() ?></span></td>
        <td data-name="thoraks" <?= $Page->thoraks->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_thoraks">
<span<?= $Page->thoraks->viewAttributes() ?>>
<?= $Page->thoraks->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->abdomen->Visible) { // abdomen ?>
    <tr id="r_abdomen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_abdomen"><?= $Page->abdomen->caption() ?></span></td>
        <td data-name="abdomen" <?= $Page->abdomen->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_abdomen">
<span<?= $Page->abdomen->viewAttributes() ?>>
<?= $Page->abdomen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->genital->Visible) { // genital ?>
    <tr id="r_genital">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_genital"><?= $Page->genital->caption() ?></span></td>
        <td data-name="genital" <?= $Page->genital->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_genital">
<span<?= $Page->genital->viewAttributes() ?>>
<?= $Page->genital->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ekstremitas->Visible) { // ekstremitas ?>
    <tr id="r_ekstremitas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_ekstremitas"><?= $Page->ekstremitas->caption() ?></span></td>
        <td data-name="ekstremitas" <?= $Page->ekstremitas->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ekstremitas">
<span<?= $Page->ekstremitas->viewAttributes() ?>>
<?= $Page->ekstremitas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_fisik->Visible) { // ket_fisik ?>
    <tr id="r_ket_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_ket_fisik"><?= $Page->ket_fisik->caption() ?></span></td>
        <td data-name="ket_fisik" <?= $Page->ket_fisik->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ket_fisik">
<span<?= $Page->ket_fisik->viewAttributes() ?>>
<?= $Page->ket_fisik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_lokalis->Visible) { // ket_lokalis ?>
    <tr id="r_ket_lokalis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_ket_lokalis"><?= $Page->ket_lokalis->caption() ?></span></td>
        <td data-name="ket_lokalis" <?= $Page->ket_lokalis->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ket_lokalis">
<span<?= $Page->ket_lokalis->viewAttributes() ?>>
<?= $Page->ket_lokalis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ekg->Visible) { // ekg ?>
    <tr id="r_ekg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_ekg"><?= $Page->ekg->caption() ?></span></td>
        <td data-name="ekg" <?= $Page->ekg->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ekg">
<span<?= $Page->ekg->viewAttributes() ?>>
<?= $Page->ekg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rad->Visible) { // rad ?>
    <tr id="r_rad">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_rad"><?= $Page->rad->caption() ?></span></td>
        <td data-name="rad" <?= $Page->rad->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rad">
<span<?= $Page->rad->viewAttributes() ?>>
<?= $Page->rad->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lab->Visible) { // lab ?>
    <tr id="r_lab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_lab"><?= $Page->lab->caption() ?></span></td>
        <td data-name="lab" <?= $Page->lab->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_lab">
<span<?= $Page->lab->viewAttributes() ?>>
<?= $Page->lab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
    <tr id="r_diagnosis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_diagnosis"><?= $Page->diagnosis->caption() ?></span></td>
        <td data-name="diagnosis" <?= $Page->diagnosis->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_diagnosis">
<span<?= $Page->diagnosis->viewAttributes() ?>>
<?= $Page->diagnosis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tata->Visible) { // tata ?>
    <tr id="r_tata">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_igd_tata"><?= $Page->tata->caption() ?></span></td>
        <td data-name="tata" <?= $Page->tata->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_tata">
<span<?= $Page->tata->viewAttributes() ?>>
<?= $Page->tata->getViewValue() ?></span>
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
