<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MPenyakitDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_penyakitdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fm_penyakitdelete = currentForm = new ew.Form("fm_penyakitdelete", "delete");
    loadjs.done("fm_penyakitdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.m_penyakit) ew.vars.tables.m_penyakit = <?= JsonEncode(GetClientVar("tables", "m_penyakit")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fm_penyakitdelete" id="fm_penyakitdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_penyakit">
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
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <th class="<?= $Page->kd_penyakit->headerCellClass() ?>"><span id="elh_m_penyakit_kd_penyakit" class="m_penyakit_kd_penyakit"><?= $Page->kd_penyakit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nm_penyakit->Visible) { // nm_penyakit ?>
        <th class="<?= $Page->nm_penyakit->headerCellClass() ?>"><span id="elh_m_penyakit_nm_penyakit" class="m_penyakit_nm_penyakit"><?= $Page->nm_penyakit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_m_penyakit_keterangan" class="m_penyakit_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_ktg->Visible) { // kd_ktg ?>
        <th class="<?= $Page->kd_ktg->headerCellClass() ?>"><span id="elh_m_penyakit_kd_ktg" class="m_penyakit_kd_ktg"><?= $Page->kd_ktg->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_m_penyakit_status" class="m_penyakit_status"><?= $Page->status->caption() ?></span></th>
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
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <td <?= $Page->kd_penyakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_penyakit_kd_penyakit" class="m_penyakit_kd_penyakit">
<span<?= $Page->kd_penyakit->viewAttributes() ?>>
<?= $Page->kd_penyakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nm_penyakit->Visible) { // nm_penyakit ?>
        <td <?= $Page->nm_penyakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_penyakit_nm_penyakit" class="m_penyakit_nm_penyakit">
<span<?= $Page->nm_penyakit->viewAttributes() ?>>
<?= $Page->nm_penyakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td <?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_penyakit_keterangan" class="m_penyakit_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_ktg->Visible) { // kd_ktg ?>
        <td <?= $Page->kd_ktg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_penyakit_kd_ktg" class="m_penyakit_kd_ktg">
<span<?= $Page->kd_ktg->viewAttributes() ?>>
<?= $Page->kd_ktg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_penyakit_status" class="m_penyakit_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
