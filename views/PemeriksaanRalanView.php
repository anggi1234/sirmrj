<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PemeriksaanRalanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpemeriksaan_ralanview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpemeriksaan_ralanview = currentForm = new ew.Form("fpemeriksaan_ralanview", "view");
    loadjs.done("fpemeriksaan_ralanview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.pemeriksaan_ralan) ew.vars.tables.pemeriksaan_ralan = <?= JsonEncode(GetClientVar("tables", "pemeriksaan_ralan")) ?>;
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
<form name="fpemeriksaan_ralanview" id="fpemeriksaan_ralanview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pemeriksaan_ralan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_perawatan->Visible) { // tgl_perawatan ?>
    <tr id="r_tgl_perawatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_tgl_perawatan"><?= $Page->tgl_perawatan->caption() ?></span></td>
        <td data-name="tgl_perawatan" <?= $Page->tgl_perawatan->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_tgl_perawatan">
<span<?= $Page->tgl_perawatan->viewAttributes() ?>>
<?= $Page->tgl_perawatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_rawat->Visible) { // jam_rawat ?>
    <tr id="r_jam_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_jam_rawat"><?= $Page->jam_rawat->caption() ?></span></td>
        <td data-name="jam_rawat" <?= $Page->jam_rawat->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_jam_rawat">
<span<?= $Page->jam_rawat->viewAttributes() ?>>
<?= $Page->jam_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suhu_tubuh->Visible) { // suhu_tubuh ?>
    <tr id="r_suhu_tubuh">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_suhu_tubuh"><?= $Page->suhu_tubuh->caption() ?></span></td>
        <td data-name="suhu_tubuh" <?= $Page->suhu_tubuh->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_suhu_tubuh">
<span<?= $Page->suhu_tubuh->viewAttributes() ?>>
<?= $Page->suhu_tubuh->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tensi->Visible) { // tensi ?>
    <tr id="r_tensi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_tensi"><?= $Page->tensi->caption() ?></span></td>
        <td data-name="tensi" <?= $Page->tensi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_tensi">
<span<?= $Page->tensi->viewAttributes() ?>>
<?= $Page->tensi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <tr id="r_nadi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_nadi"><?= $Page->nadi->caption() ?></span></td>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->respirasi->Visible) { // respirasi ?>
    <tr id="r_respirasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_respirasi"><?= $Page->respirasi->caption() ?></span></td>
        <td data-name="respirasi" <?= $Page->respirasi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_respirasi">
<span<?= $Page->respirasi->viewAttributes() ?>>
<?= $Page->respirasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tinggi->Visible) { // tinggi ?>
    <tr id="r_tinggi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_tinggi"><?= $Page->tinggi->caption() ?></span></td>
        <td data-name="tinggi" <?= $Page->tinggi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_tinggi">
<span<?= $Page->tinggi->viewAttributes() ?>>
<?= $Page->tinggi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->berat->Visible) { // berat ?>
    <tr id="r_berat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_berat"><?= $Page->berat->caption() ?></span></td>
        <td data-name="berat" <?= $Page->berat->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_berat">
<span<?= $Page->berat->viewAttributes() ?>>
<?= $Page->berat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->spo2->Visible) { // spo2 ?>
    <tr id="r_spo2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_spo2"><?= $Page->spo2->caption() ?></span></td>
        <td data-name="spo2" <?= $Page->spo2->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_spo2">
<span<?= $Page->spo2->viewAttributes() ?>>
<?= $Page->spo2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <tr id="r_gcs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_gcs"><?= $Page->gcs->caption() ?></span></td>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <tr id="r_kesadaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_kesadaran"><?= $Page->kesadaran->caption() ?></span></td>
        <td data-name="kesadaran" <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_kesadaran">
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluhan->Visible) { // keluhan ?>
    <tr id="r_keluhan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_keluhan"><?= $Page->keluhan->caption() ?></span></td>
        <td data-name="keluhan" <?= $Page->keluhan->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_keluhan">
<span<?= $Page->keluhan->viewAttributes() ?>>
<?= $Page->keluhan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pemeriksaan->Visible) { // pemeriksaan ?>
    <tr id="r_pemeriksaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_pemeriksaan"><?= $Page->pemeriksaan->caption() ?></span></td>
        <td data-name="pemeriksaan" <?= $Page->pemeriksaan->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_pemeriksaan">
<span<?= $Page->pemeriksaan->viewAttributes() ?>>
<?= $Page->pemeriksaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <tr id="r_alergi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_alergi"><?= $Page->alergi->caption() ?></span></td>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lingkar_perut->Visible) { // lingkar_perut ?>
    <tr id="r_lingkar_perut">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_lingkar_perut"><?= $Page->lingkar_perut->caption() ?></span></td>
        <td data-name="lingkar_perut" <?= $Page->lingkar_perut->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_lingkar_perut">
<span<?= $Page->lingkar_perut->viewAttributes() ?>>
<?= $Page->lingkar_perut->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rtl->Visible) { // rtl ?>
    <tr id="r_rtl">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_rtl"><?= $Page->rtl->caption() ?></span></td>
        <td data-name="rtl" <?= $Page->rtl->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_rtl">
<span<?= $Page->rtl->viewAttributes() ?>>
<?= $Page->rtl->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->penilaian->Visible) { // penilaian ?>
    <tr id="r_penilaian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_penilaian"><?= $Page->penilaian->caption() ?></span></td>
        <td data-name="penilaian" <?= $Page->penilaian->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_penilaian">
<span<?= $Page->penilaian->viewAttributes() ?>>
<?= $Page->penilaian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->instruksi->Visible) { // instruksi ?>
    <tr id="r_instruksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_instruksi"><?= $Page->instruksi->caption() ?></span></td>
        <td data-name="instruksi" <?= $Page->instruksi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_instruksi">
<span<?= $Page->instruksi->viewAttributes() ?>>
<?= $Page->instruksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->evaluasi->Visible) { // evaluasi ?>
    <tr id="r_evaluasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_evaluasi"><?= $Page->evaluasi->caption() ?></span></td>
        <td data-name="evaluasi" <?= $Page->evaluasi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_evaluasi">
<span<?= $Page->evaluasi->viewAttributes() ?>>
<?= $Page->evaluasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <tr id="r_nip">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_nip"><?= $Page->nip->caption() ?></span></td>
        <td data-name="nip" <?= $Page->nip->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
    <tr id="r_id_pemeriksaan_ralan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemeriksaan_ralan_id_pemeriksaan_ralan"><?= $Page->id_pemeriksaan_ralan->caption() ?></span></td>
        <td data-name="id_pemeriksaan_ralan" <?= $Page->id_pemeriksaan_ralan->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_id_pemeriksaan_ralan">
<span<?= $Page->id_pemeriksaan_ralan->viewAttributes() ?>>
<?= $Page->id_pemeriksaan_ralan->getViewValue() ?></span>
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
