<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$KonsulView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkonsulview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkonsulview = currentForm = new ew.Form("fkonsulview", "view");
    loadjs.done("fkonsulview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.konsul) ew.vars.tables.konsul = <?= JsonEncode(GetClientVar("tables", "konsul")) ?>;
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
<form name="fkonsulview" id="fkonsulview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="konsul">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_konsul->Visible) { // id_konsul ?>
    <tr id="r_id_konsul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_konsul_id_konsul"><?= $Page->id_konsul->caption() ?></span></td>
        <td data-name="id_konsul" <?= $Page->id_konsul->cellAttributes() ?>>
<span id="el_konsul_id_konsul">
<span<?= $Page->id_konsul->viewAttributes() ?>>
<?= $Page->id_konsul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <tr id="r_no_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_konsul_no_reg"><?= $Page->no_reg->caption() ?></span></td>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_konsul_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis_konsul->Visible) { // jenis_konsul ?>
    <tr id="r_jenis_konsul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_konsul_jenis_konsul"><?= $Page->jenis_konsul->caption() ?></span></td>
        <td data-name="jenis_konsul" <?= $Page->jenis_konsul->cellAttributes() ?>>
<span id="el_konsul_jenis_konsul">
<span<?= $Page->jenis_konsul->viewAttributes() ?>>
<?= $Page->jenis_konsul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->konsultasi->Visible) { // konsultasi ?>
    <tr id="r_konsultasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_konsul_konsultasi"><?= $Page->konsultasi->caption() ?></span></td>
        <td data-name="konsultasi" <?= $Page->konsultasi->cellAttributes() ?>>
<span id="el_konsul_konsultasi">
<span<?= $Page->konsultasi->viewAttributes() ?>>
<?= $Page->konsultasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hasil_konsul->Visible) { // hasil_konsul ?>
    <tr id="r_hasil_konsul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_konsul_hasil_konsul"><?= $Page->hasil_konsul->caption() ?></span></td>
        <td data-name="hasil_konsul" <?= $Page->hasil_konsul->cellAttributes() ?>>
<span id="el_konsul_hasil_konsul">
<span<?= $Page->hasil_konsul->viewAttributes() ?>>
<?= $Page->hasil_konsul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_konsul->Visible) { // status_konsul ?>
    <tr id="r_status_konsul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_konsul_status_konsul"><?= $Page->status_konsul->caption() ?></span></td>
        <td data-name="status_konsul" <?= $Page->status_konsul->cellAttributes() ?>>
<span id="el_konsul_status_konsul">
<span<?= $Page->status_konsul->viewAttributes() ?>>
<?= $Page->status_konsul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_input->Visible) { // tanggal_input ?>
    <tr id="r_tanggal_input">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_konsul_tanggal_input"><?= $Page->tanggal_input->caption() ?></span></td>
        <td data-name="tanggal_input" <?= $Page->tanggal_input->cellAttributes() ?>>
<span id="el_konsul_tanggal_input">
<span<?= $Page->tanggal_input->viewAttributes() ?>>
<?= $Page->tanggal_input->getViewValue() ?></span>
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
