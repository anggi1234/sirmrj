<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$DiagnosaPasienDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdiagnosa_pasiendelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fdiagnosa_pasiendelete = currentForm = new ew.Form("fdiagnosa_pasiendelete", "delete");
    loadjs.done("fdiagnosa_pasiendelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.diagnosa_pasien) ew.vars.tables.diagnosa_pasien = <?= JsonEncode(GetClientVar("tables", "diagnosa_pasien")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdiagnosa_pasiendelete" id="fdiagnosa_pasiendelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="diagnosa_pasien">
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
<?php if ($Page->id_diagnosa_pasien->Visible) { // id_diagnosa_pasien ?>
        <th class="<?= $Page->id_diagnosa_pasien->headerCellClass() ?>"><span id="elh_diagnosa_pasien_id_diagnosa_pasien" class="diagnosa_pasien_id_diagnosa_pasien"><?= $Page->id_diagnosa_pasien->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_diagnosa_pasien_no_rawat" class="diagnosa_pasien_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <th class="<?= $Page->kd_penyakit->headerCellClass() ?>"><span id="elh_diagnosa_pasien_kd_penyakit" class="diagnosa_pasien_kd_penyakit"><?= $Page->kd_penyakit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_diagnosa_pasien_status" class="diagnosa_pasien_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->prioritas->Visible) { // prioritas ?>
        <th class="<?= $Page->prioritas->headerCellClass() ?>"><span id="elh_diagnosa_pasien_prioritas" class="diagnosa_pasien_prioritas"><?= $Page->prioritas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_penyakit->Visible) { // status_penyakit ?>
        <th class="<?= $Page->status_penyakit->headerCellClass() ?>"><span id="elh_diagnosa_pasien_status_penyakit" class="diagnosa_pasien_status_penyakit"><?= $Page->status_penyakit->caption() ?></span></th>
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
<?php if ($Page->id_diagnosa_pasien->Visible) { // id_diagnosa_pasien ?>
        <td <?= $Page->id_diagnosa_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_diagnosa_pasien_id_diagnosa_pasien" class="diagnosa_pasien_id_diagnosa_pasien">
<span<?= $Page->id_diagnosa_pasien->viewAttributes() ?>>
<?= $Page->id_diagnosa_pasien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_diagnosa_pasien_no_rawat" class="diagnosa_pasien_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <td <?= $Page->kd_penyakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_diagnosa_pasien_kd_penyakit" class="diagnosa_pasien_kd_penyakit">
<span<?= $Page->kd_penyakit->viewAttributes() ?>>
<?= $Page->kd_penyakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_diagnosa_pasien_status" class="diagnosa_pasien_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->prioritas->Visible) { // prioritas ?>
        <td <?= $Page->prioritas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_diagnosa_pasien_prioritas" class="diagnosa_pasien_prioritas">
<span<?= $Page->prioritas->viewAttributes() ?>>
<?= $Page->prioritas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_penyakit->Visible) { // status_penyakit ?>
        <td <?= $Page->status_penyakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_diagnosa_pasien_status_penyakit" class="diagnosa_pasien_status_penyakit">
<span<?= $Page->status_penyakit->viewAttributes() ?>>
<?= $Page->status_penyakit->getViewValue() ?></span>
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
