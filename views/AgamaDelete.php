<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$AgamaDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fagamadelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fagamadelete = currentForm = new ew.Form("fagamadelete", "delete");
    loadjs.done("fagamadelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.agama) ew.vars.tables.agama = <?= JsonEncode(GetClientVar("tables", "agama")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fagamadelete" id="fagamadelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="agama">
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
<?php if ($Page->id_agama->Visible) { // id_agama ?>
        <th class="<?= $Page->id_agama->headerCellClass() ?>"><span id="elh_agama_id_agama" class="agama_id_agama"><?= $Page->id_agama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th class="<?= $Page->agama->headerCellClass() ?>"><span id="elh_agama_agama" class="agama_agama"><?= $Page->agama->caption() ?></span></th>
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
<?php if ($Page->id_agama->Visible) { // id_agama ?>
        <td <?= $Page->id_agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_agama_id_agama" class="agama_id_agama">
<span<?= $Page->id_agama->viewAttributes() ?>>
<?= $Page->id_agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <td <?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_agama_agama" class="agama_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
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
