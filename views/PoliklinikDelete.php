<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PoliklinikDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpoliklinikdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpoliklinikdelete = currentForm = new ew.Form("fpoliklinikdelete", "delete");
    loadjs.done("fpoliklinikdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.poliklinik) ew.vars.tables.poliklinik = <?= JsonEncode(GetClientVar("tables", "poliklinik")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpoliklinikdelete" id="fpoliklinikdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poliklinik">
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
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <th class="<?= $Page->kd_poli->headerCellClass() ?>"><span id="elh_poliklinik_kd_poli" class="poliklinik_kd_poli"><?= $Page->kd_poli->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nm_poli->Visible) { // nm_poli ?>
        <th class="<?= $Page->nm_poli->headerCellClass() ?>"><span id="elh_poliklinik_nm_poli" class="poliklinik_nm_poli"><?= $Page->nm_poli->caption() ?></span></th>
<?php } ?>
<?php if ($Page->registrasi->Visible) { // registrasi ?>
        <th class="<?= $Page->registrasi->headerCellClass() ?>"><span id="elh_poliklinik_registrasi" class="poliklinik_registrasi"><?= $Page->registrasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->registrasilama->Visible) { // registrasilama ?>
        <th class="<?= $Page->registrasilama->headerCellClass() ?>"><span id="elh_poliklinik_registrasilama" class="poliklinik_registrasilama"><?= $Page->registrasilama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_poliklinik_status" class="poliklinik_status"><?= $Page->status->caption() ?></span></th>
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
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <td <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poliklinik_kd_poli" class="poliklinik_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nm_poli->Visible) { // nm_poli ?>
        <td <?= $Page->nm_poli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poliklinik_nm_poli" class="poliklinik_nm_poli">
<span<?= $Page->nm_poli->viewAttributes() ?>>
<?= $Page->nm_poli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->registrasi->Visible) { // registrasi ?>
        <td <?= $Page->registrasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poliklinik_registrasi" class="poliklinik_registrasi">
<span<?= $Page->registrasi->viewAttributes() ?>>
<?= $Page->registrasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->registrasilama->Visible) { // registrasilama ?>
        <td <?= $Page->registrasilama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poliklinik_registrasilama" class="poliklinik_registrasilama">
<span<?= $Page->registrasilama->viewAttributes() ?>>
<?= $Page->registrasilama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_poliklinik_status" class="poliklinik_status">
<span<?= $Page->status->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_status_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->status->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->status->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_status_<?= $Page->RowCount ?>"></label>
</div></span>
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
