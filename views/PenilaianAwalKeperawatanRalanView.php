<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralanview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenilaian_awal_keperawatan_ralanview = currentForm = new ew.Form("fpenilaian_awal_keperawatan_ralanview", "view");
    loadjs.done("fpenilaian_awal_keperawatan_ralanview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penilaian_awal_keperawatan_ralan) ew.vars.tables.penilaian_awal_keperawatan_ralan = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan")) ?>;
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
<form name="fpenilaian_awal_keperawatan_ralanview" id="fpenilaian_awal_keperawatan_ralanview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
    <tr id="r_informasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_informasi"><?= $Page->informasi->caption() ?></span></td>
        <td data-name="informasi" <?= $Page->informasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_informasi">
<span<?= $Page->informasi->viewAttributes() ?>>
<?= $Page->informasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <tr id="r_td">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_td"><?= $Page->td->caption() ?></span></td>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <tr id="r_nadi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nadi"><?= $Page->nadi->caption() ?></span></td>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <tr id="r_rr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rr"><?= $Page->rr->caption() ?></span></td>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <tr id="r_suhu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_suhu"><?= $Page->suhu->caption() ?></span></td>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <tr id="r_gcs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_gcs"><?= $Page->gcs->caption() ?></span></td>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <tr id="r_bb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_bb"><?= $Page->bb->caption() ?></span></td>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <tr id="r_tb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_tb"><?= $Page->tb->caption() ?></span></td>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
    <tr id="r_bmi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_bmi"><?= $Page->bmi->caption() ?></span></td>
        <td data-name="bmi" <?= $Page->bmi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_bmi">
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <tr id="r_keluhan_utama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_keluhan_utama"><?= $Page->keluhan_utama->caption() ?></span></td>
        <td data-name="keluhan_utama" <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_keluhan_utama">
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpd->Visible) { // rpd ?>
    <tr id="r_rpd">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rpd"><?= $Page->rpd->caption() ?></span></td>
        <td data-name="rpd" <?= $Page->rpd->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rpd">
<span<?= $Page->rpd->viewAttributes() ?>>
<?= $Page->rpd->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpk->Visible) { // rpk ?>
    <tr id="r_rpk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rpk"><?= $Page->rpk->caption() ?></span></td>
        <td data-name="rpk" <?= $Page->rpk->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rpk">
<span<?= $Page->rpk->viewAttributes() ?>>
<?= $Page->rpk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rpo->Visible) { // rpo ?>
    <tr id="r_rpo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rpo"><?= $Page->rpo->caption() ?></span></td>
        <td data-name="rpo" <?= $Page->rpo->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rpo">
<span<?= $Page->rpo->viewAttributes() ?>>
<?= $Page->rpo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <tr id="r_alergi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_alergi"><?= $Page->alergi->caption() ?></span></td>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alat_bantu->Visible) { // alat_bantu ?>
    <tr id="r_alat_bantu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_alat_bantu"><?= $Page->alat_bantu->caption() ?></span></td>
        <td data-name="alat_bantu" <?= $Page->alat_bantu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_alat_bantu">
<span<?= $Page->alat_bantu->viewAttributes() ?>>
<?= $Page->alat_bantu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_bantu->Visible) { // ket_bantu ?>
    <tr id="r_ket_bantu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_bantu"><?= $Page->ket_bantu->caption() ?></span></td>
        <td data-name="ket_bantu" <?= $Page->ket_bantu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_bantu">
<span<?= $Page->ket_bantu->viewAttributes() ?>>
<?= $Page->ket_bantu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prothesa->Visible) { // prothesa ?>
    <tr id="r_prothesa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_prothesa"><?= $Page->prothesa->caption() ?></span></td>
        <td data-name="prothesa" <?= $Page->prothesa->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_prothesa">
<span<?= $Page->prothesa->viewAttributes() ?>>
<?= $Page->prothesa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_pro->Visible) { // ket_pro ?>
    <tr id="r_ket_pro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_pro"><?= $Page->ket_pro->caption() ?></span></td>
        <td data-name="ket_pro" <?= $Page->ket_pro->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_pro">
<span<?= $Page->ket_pro->viewAttributes() ?>>
<?= $Page->ket_pro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->adl->Visible) { // adl ?>
    <tr id="r_adl">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_adl"><?= $Page->adl->caption() ?></span></td>
        <td data-name="adl" <?= $Page->adl->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_adl">
<span<?= $Page->adl->viewAttributes() ?>>
<?= $Page->adl->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_psiko->Visible) { // status_psiko ?>
    <tr id="r_status_psiko">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_status_psiko"><?= $Page->status_psiko->caption() ?></span></td>
        <td data-name="status_psiko" <?= $Page->status_psiko->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_status_psiko">
<span<?= $Page->status_psiko->viewAttributes() ?>>
<?= $Page->status_psiko->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_psiko->Visible) { // ket_psiko ?>
    <tr id="r_ket_psiko">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_psiko"><?= $Page->ket_psiko->caption() ?></span></td>
        <td data-name="ket_psiko" <?= $Page->ket_psiko->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_psiko">
<span<?= $Page->ket_psiko->viewAttributes() ?>>
<?= $Page->ket_psiko->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hub_keluarga->Visible) { // hub_keluarga ?>
    <tr id="r_hub_keluarga">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_hub_keluarga"><?= $Page->hub_keluarga->caption() ?></span></td>
        <td data-name="hub_keluarga" <?= $Page->hub_keluarga->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_hub_keluarga">
<span<?= $Page->hub_keluarga->viewAttributes() ?>>
<?= $Page->hub_keluarga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tinggal_dengan->Visible) { // tinggal_dengan ?>
    <tr id="r_tinggal_dengan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_tinggal_dengan"><?= $Page->tinggal_dengan->caption() ?></span></td>
        <td data-name="tinggal_dengan" <?= $Page->tinggal_dengan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_tinggal_dengan">
<span<?= $Page->tinggal_dengan->viewAttributes() ?>>
<?= $Page->tinggal_dengan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_tinggal->Visible) { // ket_tinggal ?>
    <tr id="r_ket_tinggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_tinggal"><?= $Page->ket_tinggal->caption() ?></span></td>
        <td data-name="ket_tinggal" <?= $Page->ket_tinggal->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_tinggal">
<span<?= $Page->ket_tinggal->viewAttributes() ?>>
<?= $Page->ket_tinggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ekonomi->Visible) { // ekonomi ?>
    <tr id="r_ekonomi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ekonomi"><?= $Page->ekonomi->caption() ?></span></td>
        <td data-name="ekonomi" <?= $Page->ekonomi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ekonomi">
<span<?= $Page->ekonomi->viewAttributes() ?>>
<?= $Page->ekonomi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->budaya->Visible) { // budaya ?>
    <tr id="r_budaya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_budaya"><?= $Page->budaya->caption() ?></span></td>
        <td data-name="budaya" <?= $Page->budaya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_budaya">
<span<?= $Page->budaya->viewAttributes() ?>>
<?= $Page->budaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_budaya->Visible) { // ket_budaya ?>
    <tr id="r_ket_budaya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_budaya"><?= $Page->ket_budaya->caption() ?></span></td>
        <td data-name="ket_budaya" <?= $Page->ket_budaya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_budaya">
<span<?= $Page->ket_budaya->viewAttributes() ?>>
<?= $Page->ket_budaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->edukasi->Visible) { // edukasi ?>
    <tr id="r_edukasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_edukasi"><?= $Page->edukasi->caption() ?></span></td>
        <td data-name="edukasi" <?= $Page->edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_edukasi">
<span<?= $Page->edukasi->viewAttributes() ?>>
<?= $Page->edukasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_edukasi->Visible) { // ket_edukasi ?>
    <tr id="r_ket_edukasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_edukasi"><?= $Page->ket_edukasi->caption() ?></span></td>
        <td data-name="ket_edukasi" <?= $Page->ket_edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_edukasi">
<span<?= $Page->ket_edukasi->viewAttributes() ?>>
<?= $Page->ket_edukasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->berjalan_a->Visible) { // berjalan_a ?>
    <tr id="r_berjalan_a">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_berjalan_a"><?= $Page->berjalan_a->caption() ?></span></td>
        <td data-name="berjalan_a" <?= $Page->berjalan_a->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_berjalan_a">
<span<?= $Page->berjalan_a->viewAttributes() ?>>
<?= $Page->berjalan_a->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->berjalan_b->Visible) { // berjalan_b ?>
    <tr id="r_berjalan_b">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_berjalan_b"><?= $Page->berjalan_b->caption() ?></span></td>
        <td data-name="berjalan_b" <?= $Page->berjalan_b->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_berjalan_b">
<span<?= $Page->berjalan_b->viewAttributes() ?>>
<?= $Page->berjalan_b->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->berjalan_c->Visible) { // berjalan_c ?>
    <tr id="r_berjalan_c">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_berjalan_c"><?= $Page->berjalan_c->caption() ?></span></td>
        <td data-name="berjalan_c" <?= $Page->berjalan_c->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_berjalan_c">
<span<?= $Page->berjalan_c->viewAttributes() ?>>
<?= $Page->berjalan_c->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
    <tr id="r_hasil">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_hasil"><?= $Page->hasil->caption() ?></span></td>
        <td data-name="hasil" <?= $Page->hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_hasil">
<span<?= $Page->hasil->viewAttributes() ?>>
<?= $Page->hasil->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
    <tr id="r_lapor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_lapor"><?= $Page->lapor->caption() ?></span></td>
        <td data-name="lapor" <?= $Page->lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_lapor">
<span<?= $Page->lapor->viewAttributes() ?>>
<?= $Page->lapor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
    <tr id="r_ket_lapor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_lapor"><?= $Page->ket_lapor->caption() ?></span></td>
        <td data-name="ket_lapor" <?= $Page->ket_lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_lapor">
<span<?= $Page->ket_lapor->viewAttributes() ?>>
<?= $Page->ket_lapor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
    <tr id="r_sg1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_sg1"><?= $Page->sg1->caption() ?></span></td>
        <td data-name="sg1" <?= $Page->sg1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_sg1">
<span<?= $Page->sg1->viewAttributes() ?>>
<?= $Page->sg1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
    <tr id="r_nilai1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nilai1"><?= $Page->nilai1->caption() ?></span></td>
        <td data-name="nilai1" <?= $Page->nilai1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nilai1">
<span<?= $Page->nilai1->viewAttributes() ?>>
<?= $Page->nilai1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
    <tr id="r_sg2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_sg2"><?= $Page->sg2->caption() ?></span></td>
        <td data-name="sg2" <?= $Page->sg2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_sg2">
<span<?= $Page->sg2->viewAttributes() ?>>
<?= $Page->sg2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
    <tr id="r_nilai2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nilai2"><?= $Page->nilai2->caption() ?></span></td>
        <td data-name="nilai2" <?= $Page->nilai2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nilai2">
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
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_total_hasil"><?= $Page->total_hasil->caption() ?></span></td>
        <td data-name="total_hasil" <?= $Page->total_hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_total_hasil">
<span<?= $Page->total_hasil->viewAttributes() ?>>
<?= $Page->total_hasil->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
    <tr id="r_nyeri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nyeri"><?= $Page->nyeri->caption() ?></span></td>
        <td data-name="nyeri" <?= $Page->nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nyeri">
<span<?= $Page->nyeri->viewAttributes() ?>>
<?= $Page->nyeri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
    <tr id="r_provokes">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_provokes"><?= $Page->provokes->caption() ?></span></td>
        <td data-name="provokes" <?= $Page->provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_provokes">
<span<?= $Page->provokes->viewAttributes() ?>>
<?= $Page->provokes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
    <tr id="r_ket_provokes">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_provokes"><?= $Page->ket_provokes->caption() ?></span></td>
        <td data-name="ket_provokes" <?= $Page->ket_provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_provokes">
<span<?= $Page->ket_provokes->viewAttributes() ?>>
<?= $Page->ket_provokes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
    <tr id="r_quality">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_quality"><?= $Page->quality->caption() ?></span></td>
        <td data-name="quality" <?= $Page->quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_quality">
<span<?= $Page->quality->viewAttributes() ?>>
<?= $Page->quality->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
    <tr id="r_ket_quality">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_quality"><?= $Page->ket_quality->caption() ?></span></td>
        <td data-name="ket_quality" <?= $Page->ket_quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_quality">
<span<?= $Page->ket_quality->viewAttributes() ?>>
<?= $Page->ket_quality->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <tr id="r_lokasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_lokasi"><?= $Page->lokasi->caption() ?></span></td>
        <td data-name="lokasi" <?= $Page->lokasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
    <tr id="r_menyebar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_menyebar"><?= $Page->menyebar->caption() ?></span></td>
        <td data-name="menyebar" <?= $Page->menyebar->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_menyebar">
<span<?= $Page->menyebar->viewAttributes() ?>>
<?= $Page->menyebar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
    <tr id="r_skala_nyeri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_skala_nyeri"><?= $Page->skala_nyeri->caption() ?></span></td>
        <td data-name="skala_nyeri" <?= $Page->skala_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_skala_nyeri">
<span<?= $Page->skala_nyeri->viewAttributes() ?>>
<?= $Page->skala_nyeri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
    <tr id="r_durasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_durasi"><?= $Page->durasi->caption() ?></span></td>
        <td data-name="durasi" <?= $Page->durasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
    <tr id="r_nyeri_hilang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nyeri_hilang"><?= $Page->nyeri_hilang->caption() ?></span></td>
        <td data-name="nyeri_hilang" <?= $Page->nyeri_hilang->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nyeri_hilang">
<span<?= $Page->nyeri_hilang->viewAttributes() ?>>
<?= $Page->nyeri_hilang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
    <tr id="r_ket_nyeri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_nyeri"><?= $Page->ket_nyeri->caption() ?></span></td>
        <td data-name="ket_nyeri" <?= $Page->ket_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_nyeri">
<span<?= $Page->ket_nyeri->viewAttributes() ?>>
<?= $Page->ket_nyeri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
    <tr id="r_pada_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_pada_dokter"><?= $Page->pada_dokter->caption() ?></span></td>
        <td data-name="pada_dokter" <?= $Page->pada_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_pada_dokter">
<span<?= $Page->pada_dokter->viewAttributes() ?>>
<?= $Page->pada_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
    <tr id="r_ket_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_dokter"><?= $Page->ket_dokter->caption() ?></span></td>
        <td data-name="ket_dokter" <?= $Page->ket_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_dokter">
<span<?= $Page->ket_dokter->viewAttributes() ?>>
<?= $Page->ket_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
    <tr id="r_rencana">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rencana"><?= $Page->rencana->caption() ?></span></td>
        <td data-name="rencana" <?= $Page->rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rencana">
<span<?= $Page->rencana->viewAttributes() ?>>
<?= $Page->rencana->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <tr id="r_nip">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nip"><?= $Page->nip->caption() ?></span></td>
        <td data-name="nip" <?= $Page->nip->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nip">
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
