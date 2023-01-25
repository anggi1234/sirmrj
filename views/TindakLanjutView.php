<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$TindakLanjutView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftindak_lanjutview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftindak_lanjutview = currentForm = new ew.Form("ftindak_lanjutview", "view");
    loadjs.done("ftindak_lanjutview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.tindak_lanjut) ew.vars.tables.tindak_lanjut = <?= JsonEncode(GetClientVar("tables", "tindak_lanjut")) ?>;
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
<form name="ftindak_lanjutview" id="ftindak_lanjutview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tindak_lanjut">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <tr id="r_no_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tindak_lanjut_no_reg"><?= $Page->no_reg->caption() ?></span></td>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_tindak_lanjut_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tindak_lanjut->Visible) { // tindak_lanjut ?>
    <tr id="r_tindak_lanjut">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tindak_lanjut_tindak_lanjut"><?= $Page->tindak_lanjut->caption() ?></span></td>
        <td data-name="tindak_lanjut" <?= $Page->tindak_lanjut->cellAttributes() ?>>
<span id="el_tindak_lanjut_tindak_lanjut">
<span<?= $Page->tindak_lanjut->viewAttributes() ?>>
<?= $Page->tindak_lanjut->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_kontrol->Visible) { // no_kontrol ?>
    <tr id="r_no_kontrol">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tindak_lanjut_no_kontrol"><?= $Page->no_kontrol->caption() ?></span></td>
        <td data-name="no_kontrol" <?= $Page->no_kontrol->cellAttributes() ?>>
<span id="el_tindak_lanjut_no_kontrol">
<span<?= $Page->no_kontrol->viewAttributes() ?>>
<?= $Page->no_kontrol->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
    <tr id="r_tgl_input">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tindak_lanjut_tgl_input"><?= $Page->tgl_input->caption() ?></span></td>
        <td data-name="tgl_input" <?= $Page->tgl_input->cellAttributes() ?>>
<span id="el_tindak_lanjut_tgl_input">
<span<?= $Page->tgl_input->viewAttributes() ?>>
<?= $Page->tgl_input->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <tr id="r_tgl_kontrol">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tindak_lanjut_tgl_kontrol"><?= $Page->tgl_kontrol->caption() ?></span></td>
        <td data-name="tgl_kontrol" <?= $Page->tgl_kontrol->cellAttributes() ?>>
<span id="el_tindak_lanjut_tgl_kontrol">
<span<?= $Page->tgl_kontrol->viewAttributes() ?>>
<?= $Page->tgl_kontrol->getViewValue() ?></span>
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
