<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PoliklinikView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpoliklinikview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpoliklinikview = currentForm = new ew.Form("fpoliklinikview", "view");
    loadjs.done("fpoliklinikview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.poliklinik) ew.vars.tables.poliklinik = <?= JsonEncode(GetClientVar("tables", "poliklinik")) ?>;
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
<form name="fpoliklinikview" id="fpoliklinikview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poliklinik">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <tr id="r_kd_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poliklinik_kd_poli"><?= $Page->kd_poli->caption() ?></span></td>
        <td data-name="kd_poli" <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_poliklinik_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nm_poli->Visible) { // nm_poli ?>
    <tr id="r_nm_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poliklinik_nm_poli"><?= $Page->nm_poli->caption() ?></span></td>
        <td data-name="nm_poli" <?= $Page->nm_poli->cellAttributes() ?>>
<span id="el_poliklinik_nm_poli">
<span<?= $Page->nm_poli->viewAttributes() ?>>
<?= $Page->nm_poli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->registrasi->Visible) { // registrasi ?>
    <tr id="r_registrasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poliklinik_registrasi"><?= $Page->registrasi->caption() ?></span></td>
        <td data-name="registrasi" <?= $Page->registrasi->cellAttributes() ?>>
<span id="el_poliklinik_registrasi">
<span<?= $Page->registrasi->viewAttributes() ?>>
<?= $Page->registrasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->registrasilama->Visible) { // registrasilama ?>
    <tr id="r_registrasilama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poliklinik_registrasilama"><?= $Page->registrasilama->caption() ?></span></td>
        <td data-name="registrasilama" <?= $Page->registrasilama->cellAttributes() ?>>
<span id="el_poliklinik_registrasilama">
<span<?= $Page->registrasilama->viewAttributes() ?>>
<?= $Page->registrasilama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_poliklinik_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_poliklinik_status">
<span<?= $Page->status->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_status_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->status->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->status->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_status_<?= $Page->RowCount ?>"></label>
</div></span>
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
