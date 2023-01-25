<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisIgdDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_igddelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpenilaian_medis_igddelete = currentForm = new ew.Form("fpenilaian_medis_igddelete", "delete");
    loadjs.done("fpenilaian_medis_igddelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.penilaian_medis_igd) ew.vars.tables.penilaian_medis_igd = <?= JsonEncode(GetClientVar("tables", "penilaian_medis_igd")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenilaian_medis_igddelete" id="fpenilaian_medis_igddelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_igd">
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
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_no_rawat" class="penilaian_medis_igd_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_tanggal" class="penilaian_medis_igd_tanggal"><?= $Page->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th class="<?= $Page->kd_dokter->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_kd_dokter" class="penilaian_medis_igd_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <th class="<?= $Page->anamnesis->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_anamnesis" class="penilaian_medis_igd_anamnesis"><?= $Page->anamnesis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
        <th class="<?= $Page->hubungan->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_hubungan" class="penilaian_medis_igd_hubungan"><?= $Page->hubungan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <th class="<?= $Page->alergi->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_alergi" class="penilaian_medis_igd_alergi"><?= $Page->alergi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <th class="<?= $Page->keadaan->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_keadaan" class="penilaian_medis_igd_keadaan"><?= $Page->keadaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <th class="<?= $Page->gcs->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_gcs" class="penilaian_medis_igd_gcs"><?= $Page->gcs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
        <th class="<?= $Page->kesadaran->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_kesadaran" class="penilaian_medis_igd_kesadaran"><?= $Page->kesadaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <th class="<?= $Page->td->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_td" class="penilaian_medis_igd_td"><?= $Page->td->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <th class="<?= $Page->nadi->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_nadi" class="penilaian_medis_igd_nadi"><?= $Page->nadi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <th class="<?= $Page->rr->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_rr" class="penilaian_medis_igd_rr"><?= $Page->rr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <th class="<?= $Page->suhu->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_suhu" class="penilaian_medis_igd_suhu"><?= $Page->suhu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->spo->Visible) { // spo ?>
        <th class="<?= $Page->spo->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_spo" class="penilaian_medis_igd_spo"><?= $Page->spo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <th class="<?= $Page->bb->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_bb" class="penilaian_medis_igd_bb"><?= $Page->bb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <th class="<?= $Page->tb->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_tb" class="penilaian_medis_igd_tb"><?= $Page->tb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kepala->Visible) { // kepala ?>
        <th class="<?= $Page->kepala->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_kepala" class="penilaian_medis_igd_kepala"><?= $Page->kepala->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mata->Visible) { // mata ?>
        <th class="<?= $Page->mata->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_mata" class="penilaian_medis_igd_mata"><?= $Page->mata->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gigi->Visible) { // gigi ?>
        <th class="<?= $Page->gigi->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_gigi" class="penilaian_medis_igd_gigi"><?= $Page->gigi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->leher->Visible) { // leher ?>
        <th class="<?= $Page->leher->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_leher" class="penilaian_medis_igd_leher"><?= $Page->leher->caption() ?></span></th>
<?php } ?>
<?php if ($Page->thoraks->Visible) { // thoraks ?>
        <th class="<?= $Page->thoraks->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_thoraks" class="penilaian_medis_igd_thoraks"><?= $Page->thoraks->caption() ?></span></th>
<?php } ?>
<?php if ($Page->abdomen->Visible) { // abdomen ?>
        <th class="<?= $Page->abdomen->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_abdomen" class="penilaian_medis_igd_abdomen"><?= $Page->abdomen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->genital->Visible) { // genital ?>
        <th class="<?= $Page->genital->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_genital" class="penilaian_medis_igd_genital"><?= $Page->genital->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ekstremitas->Visible) { // ekstremitas ?>
        <th class="<?= $Page->ekstremitas->headerCellClass() ?>"><span id="elh_penilaian_medis_igd_ekstremitas" class="penilaian_medis_igd_ekstremitas"><?= $Page->ekstremitas->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_no_rawat" class="penilaian_medis_igd_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_tanggal" class="penilaian_medis_igd_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_kd_dokter" class="penilaian_medis_igd_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <td <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_anamnesis" class="penilaian_medis_igd_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
        <td <?= $Page->hubungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_hubungan" class="penilaian_medis_igd_hubungan">
<span<?= $Page->hubungan->viewAttributes() ?>>
<?= $Page->hubungan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <td <?= $Page->alergi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_alergi" class="penilaian_medis_igd_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <td <?= $Page->keadaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_keadaan" class="penilaian_medis_igd_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <td <?= $Page->gcs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_gcs" class="penilaian_medis_igd_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
        <td <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_kesadaran" class="penilaian_medis_igd_kesadaran">
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <td <?= $Page->td->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_td" class="penilaian_medis_igd_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <td <?= $Page->nadi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_nadi" class="penilaian_medis_igd_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <td <?= $Page->rr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_rr" class="penilaian_medis_igd_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <td <?= $Page->suhu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_suhu" class="penilaian_medis_igd_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->spo->Visible) { // spo ?>
        <td <?= $Page->spo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_spo" class="penilaian_medis_igd_spo">
<span<?= $Page->spo->viewAttributes() ?>>
<?= $Page->spo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <td <?= $Page->bb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_bb" class="penilaian_medis_igd_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <td <?= $Page->tb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_tb" class="penilaian_medis_igd_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kepala->Visible) { // kepala ?>
        <td <?= $Page->kepala->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_kepala" class="penilaian_medis_igd_kepala">
<span<?= $Page->kepala->viewAttributes() ?>>
<?= $Page->kepala->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mata->Visible) { // mata ?>
        <td <?= $Page->mata->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_mata" class="penilaian_medis_igd_mata">
<span<?= $Page->mata->viewAttributes() ?>>
<?= $Page->mata->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gigi->Visible) { // gigi ?>
        <td <?= $Page->gigi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_gigi" class="penilaian_medis_igd_gigi">
<span<?= $Page->gigi->viewAttributes() ?>>
<?= $Page->gigi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->leher->Visible) { // leher ?>
        <td <?= $Page->leher->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_leher" class="penilaian_medis_igd_leher">
<span<?= $Page->leher->viewAttributes() ?>>
<?= $Page->leher->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->thoraks->Visible) { // thoraks ?>
        <td <?= $Page->thoraks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_thoraks" class="penilaian_medis_igd_thoraks">
<span<?= $Page->thoraks->viewAttributes() ?>>
<?= $Page->thoraks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->abdomen->Visible) { // abdomen ?>
        <td <?= $Page->abdomen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_abdomen" class="penilaian_medis_igd_abdomen">
<span<?= $Page->abdomen->viewAttributes() ?>>
<?= $Page->abdomen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->genital->Visible) { // genital ?>
        <td <?= $Page->genital->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_genital" class="penilaian_medis_igd_genital">
<span<?= $Page->genital->viewAttributes() ?>>
<?= $Page->genital->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ekstremitas->Visible) { // ekstremitas ?>
        <td <?= $Page->ekstremitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_ekstremitas" class="penilaian_medis_igd_ekstremitas">
<span<?= $Page->ekstremitas->viewAttributes() ?>>
<?= $Page->ekstremitas->getViewValue() ?></span>
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
