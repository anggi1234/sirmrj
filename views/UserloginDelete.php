<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$UserloginDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fuserlogindelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fuserlogindelete = currentForm = new ew.Form("fuserlogindelete", "delete");
    loadjs.done("fuserlogindelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.userlogin) ew.vars.tables.userlogin = <?= JsonEncode(GetClientVar("tables", "userlogin")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fuserlogindelete" id="fuserlogindelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="userlogin">
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
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_userlogin__username" class="userlogin__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_userlogin__password" class="userlogin__password"><?= $Page->_password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->userlevels->Visible) { // userlevels ?>
        <th class="<?= $Page->userlevels->headerCellClass() ?>"><span id="elh_userlogin_userlevels" class="userlogin_userlevels"><?= $Page->userlevels->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_userlogin_nama" class="userlogin_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_akses->Visible) { // id_akses ?>
        <th class="<?= $Page->id_akses->headerCellClass() ?>"><span id="elh_userlogin_id_akses" class="userlogin_id_akses"><?= $Page->id_akses->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_userlogin_status" class="userlogin_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dihapus->Visible) { // dihapus ?>
        <th class="<?= $Page->dihapus->headerCellClass() ?>"><span id="elh_userlogin_dihapus" class="userlogin_dihapus"><?= $Page->dihapus->caption() ?></span></th>
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
<?php if ($Page->_username->Visible) { // username ?>
        <td <?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlogin__username" class="userlogin__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <td <?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlogin__password" class="userlogin__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->userlevels->Visible) { // userlevels ?>
        <td <?= $Page->userlevels->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlogin_userlevels" class="userlogin_userlevels">
<span<?= $Page->userlevels->viewAttributes() ?>>
<?= $Page->userlevels->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td <?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlogin_nama" class="userlogin_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_akses->Visible) { // id_akses ?>
        <td <?= $Page->id_akses->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlogin_id_akses" class="userlogin_id_akses">
<span<?= $Page->id_akses->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_id_akses_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->id_akses->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->id_akses->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_id_akses_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlogin_status" class="userlogin_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dihapus->Visible) { // dihapus ?>
        <td <?= $Page->dihapus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_userlogin_dihapus" class="userlogin_dihapus">
<span<?= $Page->dihapus->viewAttributes() ?>>
<?= $Page->dihapus->getViewValue() ?></span>
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
