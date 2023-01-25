<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$NotaJalanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fnota_jalandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fnota_jalandelete = currentForm = new ew.Form("fnota_jalandelete", "delete");
    loadjs.done("fnota_jalandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.nota_jalan) ew.vars.tables.nota_jalan = <?= JsonEncode(GetClientVar("tables", "nota_jalan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fnota_jalandelete" id="fnota_jalandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="nota_jalan">
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
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_nota_jalan_no_rawat" class="nota_jalan_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_nota->Visible) { // no_nota ?>
        <th class="<?= $Page->no_nota->headerCellClass() ?>"><span id="elh_nota_jalan_no_nota" class="nota_jalan_no_nota"><?= $Page->no_nota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><span id="elh_nota_jalan_tanggal" class="nota_jalan_tanggal"><?= $Page->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam->Visible) { // jam ?>
        <th class="<?= $Page->jam->headerCellClass() ?>"><span id="elh_nota_jalan_jam" class="nota_jalan_jam"><?= $Page->jam->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_nota_jalan_no_rawat" class="nota_jalan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_nota->Visible) { // no_nota ?>
        <td <?= $Page->no_nota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nota_jalan_no_nota" class="nota_jalan_no_nota">
<span<?= $Page->no_nota->viewAttributes() ?>>
<?= $Page->no_nota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nota_jalan_tanggal" class="nota_jalan_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam->Visible) { // jam ?>
        <td <?= $Page->jam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nota_jalan_jam" class="nota_jalan_jam">
<span<?= $Page->jam->viewAttributes() ?>>
<?= $Page->jam->getViewValue() ?></span>
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
