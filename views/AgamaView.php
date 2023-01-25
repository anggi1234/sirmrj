<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$AgamaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fagamaview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fagamaview = currentForm = new ew.Form("fagamaview", "view");
    loadjs.done("fagamaview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.agama) ew.vars.tables.agama = <?= JsonEncode(GetClientVar("tables", "agama")) ?>;
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
<form name="fagamaview" id="fagamaview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="agama">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_agama->Visible) { // id_agama ?>
    <tr id="r_id_agama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_agama_id_agama"><?= $Page->id_agama->caption() ?></span></td>
        <td data-name="id_agama" <?= $Page->id_agama->cellAttributes() ?>>
<span id="el_agama_id_agama">
<span<?= $Page->id_agama->viewAttributes() ?>>
<?= $Page->id_agama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <tr id="r_agama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_agama_agama"><?= $Page->agama->caption() ?></span></td>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el_agama_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
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
