<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisRalanAnakView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_ralan_anakview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenilaian_medis_ralan_anakview = currentForm = new ew.Form("fpenilaian_medis_ralan_anakview", "view");
    loadjs.done("fpenilaian_medis_ralan_anakview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penilaian_medis_ralan_anak) ew.vars.tables.penilaian_medis_ralan_anak = <?= JsonEncode(GetClientVar("tables", "penilaian_medis_ralan_anak")) ?>;
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
<form name="fpenilaian_medis_ralan_anakview" id="fpenilaian_medis_ralan_anakview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_ralan_anak">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_penilaian_medis_ralan_anak->Visible) { // id_penilaian_medis_ralan_anak ?>
    <tr id="r_id_penilaian_medis_ralan_anak">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_id_penilaian_medis_ralan_anak"><?= $Page->id_penilaian_medis_ralan_anak->caption() ?></span></td>
        <td data-name="id_penilaian_medis_ralan_anak" <?= $Page->id_penilaian_medis_ralan_anak->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_id_penilaian_medis_ralan_anak">
<span<?= $Page->id_penilaian_medis_ralan_anak->viewAttributes() ?>>
<?= $Page->id_penilaian_medis_ralan_anak->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <tr id="r_anamnesis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_anamnesis"><?= $Page->anamnesis->caption() ?></span></td>
        <td data-name="anamnesis" <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
    <tr id="r_hubungan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_hubungan"><?= $Page->hubungan->caption() ?></span></td>
        <td data-name="hubungan" <?= $Page->hubungan->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_hubungan">
<span<?= $Page->hubungan->viewAttributes() ?>>
<?= $Page->hubungan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <tr id="r_keluhan_utama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_keluhan_utama"><?= $Page->keluhan_utama->caption() ?></span></td>
        <td data-name="keluhan_utama" <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_keluhan_utama">
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rps->Visible) { // rps ?>
    <tr id="r_rps">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_rps"><?= $Page->rps->caption() ?></span></td>
        <td data-name="rps" <?= $Page->rps->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_rps">
<span<?= $Page->rps->viewAttributes() ?>>
<?= $Page->rps->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpd->Visible) { // rpd ?>
    <tr id="r_rpd">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_rpd"><?= $Page->rpd->caption() ?></span></td>
        <td data-name="rpd" <?= $Page->rpd->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_rpd">
<span<?= $Page->rpd->viewAttributes() ?>>
<?= $Page->rpd->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpk->Visible) { // rpk ?>
    <tr id="r_rpk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_rpk"><?= $Page->rpk->caption() ?></span></td>
        <td data-name="rpk" <?= $Page->rpk->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_rpk">
<span<?= $Page->rpk->viewAttributes() ?>>
<?= $Page->rpk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo->Visible) { // rpo ?>
    <tr id="r_rpo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_rpo"><?= $Page->rpo->caption() ?></span></td>
        <td data-name="rpo" <?= $Page->rpo->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_rpo">
<span<?= $Page->rpo->viewAttributes() ?>>
<?= $Page->rpo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <tr id="r_alergi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_alergi"><?= $Page->alergi->caption() ?></span></td>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <tr id="r_keadaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_keadaan"><?= $Page->keadaan->caption() ?></span></td>
        <td data-name="keadaan" <?= $Page->keadaan->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <tr id="r_gcs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_gcs"><?= $Page->gcs->caption() ?></span></td>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <tr id="r_kesadaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_kesadaran"><?= $Page->kesadaran->caption() ?></span></td>
        <td data-name="kesadaran" <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_kesadaran">
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <tr id="r_td">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_td"><?= $Page->td->caption() ?></span></td>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <tr id="r_nadi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_nadi"><?= $Page->nadi->caption() ?></span></td>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <tr id="r_rr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_rr"><?= $Page->rr->caption() ?></span></td>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <tr id="r_suhu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_suhu"><?= $Page->suhu->caption() ?></span></td>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->spo->Visible) { // spo ?>
    <tr id="r_spo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_spo"><?= $Page->spo->caption() ?></span></td>
        <td data-name="spo" <?= $Page->spo->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_spo">
<span<?= $Page->spo->viewAttributes() ?>>
<?= $Page->spo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <tr id="r_bb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_bb"><?= $Page->bb->caption() ?></span></td>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <tr id="r_tb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_tb"><?= $Page->tb->caption() ?></span></td>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kepala->Visible) { // kepala ?>
    <tr id="r_kepala">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_kepala"><?= $Page->kepala->caption() ?></span></td>
        <td data-name="kepala" <?= $Page->kepala->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_kepala">
<span<?= $Page->kepala->viewAttributes() ?>>
<?= $Page->kepala->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mata->Visible) { // mata ?>
    <tr id="r_mata">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_mata"><?= $Page->mata->caption() ?></span></td>
        <td data-name="mata" <?= $Page->mata->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_mata">
<span<?= $Page->mata->viewAttributes() ?>>
<?= $Page->mata->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gigi->Visible) { // gigi ?>
    <tr id="r_gigi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_gigi"><?= $Page->gigi->caption() ?></span></td>
        <td data-name="gigi" <?= $Page->gigi->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_gigi">
<span<?= $Page->gigi->viewAttributes() ?>>
<?= $Page->gigi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tht->Visible) { // tht ?>
    <tr id="r_tht">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_tht"><?= $Page->tht->caption() ?></span></td>
        <td data-name="tht" <?= $Page->tht->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_tht">
<span<?= $Page->tht->viewAttributes() ?>>
<?= $Page->tht->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thoraks->Visible) { // thoraks ?>
    <tr id="r_thoraks">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_thoraks"><?= $Page->thoraks->caption() ?></span></td>
        <td data-name="thoraks" <?= $Page->thoraks->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_thoraks">
<span<?= $Page->thoraks->viewAttributes() ?>>
<?= $Page->thoraks->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->abdomen->Visible) { // abdomen ?>
    <tr id="r_abdomen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_abdomen"><?= $Page->abdomen->caption() ?></span></td>
        <td data-name="abdomen" <?= $Page->abdomen->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_abdomen">
<span<?= $Page->abdomen->viewAttributes() ?>>
<?= $Page->abdomen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->genital->Visible) { // genital ?>
    <tr id="r_genital">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_genital"><?= $Page->genital->caption() ?></span></td>
        <td data-name="genital" <?= $Page->genital->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_genital">
<span<?= $Page->genital->viewAttributes() ?>>
<?= $Page->genital->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ekstremitas->Visible) { // ekstremitas ?>
    <tr id="r_ekstremitas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_ekstremitas"><?= $Page->ekstremitas->caption() ?></span></td>
        <td data-name="ekstremitas" <?= $Page->ekstremitas->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_ekstremitas">
<span<?= $Page->ekstremitas->viewAttributes() ?>>
<?= $Page->ekstremitas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kulit->Visible) { // kulit ?>
    <tr id="r_kulit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_kulit"><?= $Page->kulit->caption() ?></span></td>
        <td data-name="kulit" <?= $Page->kulit->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_kulit">
<span<?= $Page->kulit->viewAttributes() ?>>
<?= $Page->kulit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_fisik->Visible) { // ket_fisik ?>
    <tr id="r_ket_fisik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_ket_fisik"><?= $Page->ket_fisik->caption() ?></span></td>
        <td data-name="ket_fisik" <?= $Page->ket_fisik->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_ket_fisik">
<span<?= $Page->ket_fisik->viewAttributes() ?>>
<?= $Page->ket_fisik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_lokalis->Visible) { // ket_lokalis ?>
    <tr id="r_ket_lokalis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_ket_lokalis"><?= $Page->ket_lokalis->caption() ?></span></td>
        <td data-name="ket_lokalis" <?= $Page->ket_lokalis->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_ket_lokalis">
<span<?= $Page->ket_lokalis->viewAttributes() ?>>
<?= $Page->ket_lokalis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->penunjang->Visible) { // penunjang ?>
    <tr id="r_penunjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_penunjang"><?= $Page->penunjang->caption() ?></span></td>
        <td data-name="penunjang" <?= $Page->penunjang->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_penunjang">
<span<?= $Page->penunjang->viewAttributes() ?>>
<?= $Page->penunjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
    <tr id="r_diagnosis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_diagnosis"><?= $Page->diagnosis->caption() ?></span></td>
        <td data-name="diagnosis" <?= $Page->diagnosis->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_diagnosis">
<span<?= $Page->diagnosis->viewAttributes() ?>>
<?= $Page->diagnosis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tata->Visible) { // tata ?>
    <tr id="r_tata">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_tata"><?= $Page->tata->caption() ?></span></td>
        <td data-name="tata" <?= $Page->tata->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_tata">
<span<?= $Page->tata->viewAttributes() ?>>
<?= $Page->tata->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->konsul->Visible) { // konsul ?>
    <tr id="r_konsul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_medis_ralan_anak_konsul"><?= $Page->konsul->caption() ?></span></td>
        <td data-name="konsul" <?= $Page->konsul->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anak_konsul">
<span<?= $Page->konsul->viewAttributes() ?>>
<?= $Page->konsul->getViewValue() ?></span>
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
