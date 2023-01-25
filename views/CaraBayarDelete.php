<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CaraBayarDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcara_bayardelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fcara_bayardelete = currentForm = new ew.Form("fcara_bayardelete", "delete");
    loadjs.done("fcara_bayardelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.cara_bayar) ew.vars.tables.cara_bayar = <?= JsonEncode(GetClientVar("tables", "cara_bayar")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcara_bayardelete" id="fcara_bayardelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cara_bayar">
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
<?php if ($Page->id_cara_bayar->Visible) { // id_cara_bayar ?>
        <th class="<?= $Page->id_cara_bayar->headerCellClass() ?>"><span id="elh_cara_bayar_id_cara_bayar" class="cara_bayar_id_cara_bayar"><?= $Page->id_cara_bayar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cara_bayar->Visible) { // cara_bayar ?>
        <th class="<?= $Page->cara_bayar->headerCellClass() ?>"><span id="elh_cara_bayar_cara_bayar" class="cara_bayar_cara_bayar"><?= $Page->cara_bayar->caption() ?></span></th>
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
<?php if ($Page->id_cara_bayar->Visible) { // id_cara_bayar ?>
        <td <?= $Page->id_cara_bayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cara_bayar_id_cara_bayar" class="cara_bayar_id_cara_bayar">
<span<?= $Page->id_cara_bayar->viewAttributes() ?>>
<?= $Page->id_cara_bayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cara_bayar->Visible) { // cara_bayar ?>
        <td <?= $Page->cara_bayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cara_bayar_cara_bayar" class="cara_bayar_cara_bayar">
<span<?= $Page->cara_bayar->viewAttributes() ?>>
<?= $Page->cara_bayar->getViewValue() ?></span>
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
