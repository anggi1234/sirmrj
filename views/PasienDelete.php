<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PasienDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpasiendelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpasiendelete = currentForm = new ew.Form("fpasiendelete", "delete");
    loadjs.done("fpasiendelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.pasien) ew.vars.tables.pasien = <?= JsonEncode(GetClientVar("tables", "pasien")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpasiendelete" id="fpasiendelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien">
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
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><span id="elh_pasien_no_rkm_medis" class="pasien_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
        <th class="<?= $Page->nm_pasien->headerCellClass() ?>"><span id="elh_pasien_nm_pasien" class="pasien_nm_pasien"><?= $Page->nm_pasien->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
        <th class="<?= $Page->jk->headerCellClass() ?>"><span id="elh_pasien_jk" class="pasien_jk"><?= $Page->jk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
        <th class="<?= $Page->nm_ibu->headerCellClass() ?>"><span id="elh_pasien_nm_ibu" class="pasien_nm_ibu"><?= $Page->nm_ibu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th class="<?= $Page->alamat->headerCellClass() ?>"><span id="elh_pasien_alamat" class="pasien_alamat"><?= $Page->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <th class="<?= $Page->tgl_daftar->headerCellClass() ?>"><span id="elh_pasien_tgl_daftar" class="pasien_tgl_daftar"><?= $Page->tgl_daftar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_peserta->Visible) { // no_peserta ?>
        <th class="<?= $Page->no_peserta->headerCellClass() ?>"><span id="elh_pasien_no_peserta" class="pasien_no_peserta"><?= $Page->no_peserta->caption() ?></span></th>
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
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_no_rkm_medis" class="pasien_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
        <td <?= $Page->nm_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_nm_pasien" class="pasien_nm_pasien">
<span<?= $Page->nm_pasien->viewAttributes() ?>>
<?= $Page->nm_pasien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
        <td <?= $Page->jk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_jk" class="pasien_jk">
<span<?= $Page->jk->viewAttributes() ?>>
<?= $Page->jk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
        <td <?= $Page->nm_ibu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_nm_ibu" class="pasien_nm_ibu">
<span<?= $Page->nm_ibu->viewAttributes() ?>>
<?= $Page->nm_ibu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <td <?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_alamat" class="pasien_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <td <?= $Page->tgl_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_tgl_daftar" class="pasien_tgl_daftar">
<span<?= $Page->tgl_daftar->viewAttributes() ?>>
<?= $Page->tgl_daftar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_peserta->Visible) { // no_peserta ?>
        <td <?= $Page->no_peserta->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_no_peserta" class="pasien_no_peserta">
<span<?= $Page->no_peserta->viewAttributes() ?>>
<?= $Page->no_peserta->getViewValue() ?></span>
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
