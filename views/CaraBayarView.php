<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CaraBayarView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcara_bayarview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcara_bayarview = currentForm = new ew.Form("fcara_bayarview", "view");
    loadjs.done("fcara_bayarview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.cara_bayar) ew.vars.tables.cara_bayar = <?= JsonEncode(GetClientVar("tables", "cara_bayar")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcara_bayarview" id="fcara_bayarview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cara_bayar">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_cara_bayar->Visible) { // id_cara_bayar ?>
    <tr id="r_id_cara_bayar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cara_bayar_id_cara_bayar"><?= $Page->id_cara_bayar->caption() ?></span></td>
        <td data-name="id_cara_bayar" <?= $Page->id_cara_bayar->cellAttributes() ?>>
<span id="el_cara_bayar_id_cara_bayar">
<span<?= $Page->id_cara_bayar->viewAttributes() ?>>
<?= $Page->id_cara_bayar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cara_bayar->Visible) { // cara_bayar ?>
    <tr id="r_cara_bayar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cara_bayar_cara_bayar"><?= $Page->cara_bayar->caption() ?></span></td>
        <td data-name="cara_bayar" <?= $Page->cara_bayar->cellAttributes() ?>>
<span id="el_cara_bayar_cara_bayar">
<span<?= $Page->cara_bayar->viewAttributes() ?>>
<?= $Page->cara_bayar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
