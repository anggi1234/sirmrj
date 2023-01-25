<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CatatanMedisView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcatatan_medisview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcatatan_medisview = currentForm = new ew.Form("fcatatan_medisview", "view");
    loadjs.done("fcatatan_medisview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.catatan_medis) ew.vars.tables.catatan_medis = <?= JsonEncode(GetClientVar("tables", "catatan_medis")) ?>;
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
<form name="fcatatan_medisview" id="fcatatan_medisview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catatan_medis">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <tr id="r_no_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catatan_medis_no_reg"><?= $Page->no_reg->caption() ?></span></td>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_catatan_medis_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->catatan_medis->Visible) { // catatan_medis ?>
    <tr id="r_catatan_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catatan_medis_catatan_medis"><?= $Page->catatan_medis->caption() ?></span></td>
        <td data-name="catatan_medis" <?= $Page->catatan_medis->cellAttributes() ?>>
<span id="el_catatan_medis_catatan_medis">
<span<?= $Page->catatan_medis->viewAttributes() ?>>
<?= $Page->catatan_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
    <tr id="r_tgl_input">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catatan_medis_tgl_input"><?= $Page->tgl_input->caption() ?></span></td>
        <td data-name="tgl_input" <?= $Page->tgl_input->cellAttributes() ?>>
<span id="el_catatan_medis_tgl_input">
<span<?= $Page->tgl_input->viewAttributes() ?>>
<?= $Page->tgl_input->getViewValue() ?></span>
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
