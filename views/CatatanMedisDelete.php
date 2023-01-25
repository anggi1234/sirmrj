<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CatatanMedisDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcatatan_medisdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fcatatan_medisdelete = currentForm = new ew.Form("fcatatan_medisdelete", "delete");
    loadjs.done("fcatatan_medisdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.catatan_medis) ew.vars.tables.catatan_medis = <?= JsonEncode(GetClientVar("tables", "catatan_medis")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcatatan_medisdelete" id="fcatatan_medisdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catatan_medis">
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
<?php if ($Page->id_catatan_medis->Visible) { // id_catatan_medis ?>
        <th class="<?= $Page->id_catatan_medis->headerCellClass() ?>"><span id="elh_catatan_medis_id_catatan_medis" class="catatan_medis_id_catatan_medis"><?= $Page->id_catatan_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
        <th class="<?= $Page->no_reg->headerCellClass() ?>"><span id="elh_catatan_medis_no_reg" class="catatan_medis_no_reg"><?= $Page->no_reg->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <th class="<?= $Page->no_rekam_medis->headerCellClass() ?>"><span id="elh_catatan_medis_no_rekam_medis" class="catatan_medis_no_rekam_medis"><?= $Page->no_rekam_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
        <th class="<?= $Page->nama_pasien->headerCellClass() ?>"><span id="elh_catatan_medis_nama_pasien" class="catatan_medis_nama_pasien"><?= $Page->nama_pasien->caption() ?></span></th>
<?php } ?>
<?php if ($Page->catatan_medis->Visible) { // catatan_medis ?>
        <th class="<?= $Page->catatan_medis->headerCellClass() ?>"><span id="elh_catatan_medis_catatan_medis" class="catatan_medis_catatan_medis"><?= $Page->catatan_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
        <th class="<?= $Page->tgl_input->headerCellClass() ?>"><span id="elh_catatan_medis_tgl_input" class="catatan_medis_tgl_input"><?= $Page->tgl_input->caption() ?></span></th>
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
<?php if ($Page->id_catatan_medis->Visible) { // id_catatan_medis ?>
        <td <?= $Page->id_catatan_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catatan_medis_id_catatan_medis" class="catatan_medis_id_catatan_medis">
<span<?= $Page->id_catatan_medis->viewAttributes() ?>>
<?= $Page->id_catatan_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
        <td <?= $Page->no_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catatan_medis_no_reg" class="catatan_medis_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <td <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catatan_medis_no_rekam_medis" class="catatan_medis_no_rekam_medis">
<span<?= $Page->no_rekam_medis->viewAttributes() ?>>
<?= $Page->no_rekam_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
        <td <?= $Page->nama_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catatan_medis_nama_pasien" class="catatan_medis_nama_pasien">
<span<?= $Page->nama_pasien->viewAttributes() ?>>
<?= $Page->nama_pasien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->catatan_medis->Visible) { // catatan_medis ?>
        <td <?= $Page->catatan_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catatan_medis_catatan_medis" class="catatan_medis_catatan_medis">
<span<?= $Page->catatan_medis->viewAttributes() ?>>
<?= $Page->catatan_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
        <td <?= $Page->tgl_input->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catatan_medis_tgl_input" class="catatan_medis_tgl_input">
<span<?= $Page->tgl_input->viewAttributes() ?>>
<?= $Page->tgl_input->getViewValue() ?></span>
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
