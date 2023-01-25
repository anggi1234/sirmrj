<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$DiagnosaPasienView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdiagnosa_pasienview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdiagnosa_pasienview = currentForm = new ew.Form("fdiagnosa_pasienview", "view");
    loadjs.done("fdiagnosa_pasienview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.diagnosa_pasien) ew.vars.tables.diagnosa_pasien = <?= JsonEncode(GetClientVar("tables", "diagnosa_pasien")) ?>;
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
<form name="fdiagnosa_pasienview" id="fdiagnosa_pasienview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="diagnosa_pasien">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
    <tr id="r_kd_penyakit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosa_pasien_kd_penyakit"><?= $Page->kd_penyakit->caption() ?></span></td>
        <td data-name="kd_penyakit" <?= $Page->kd_penyakit->cellAttributes() ?>>
<span id="el_diagnosa_pasien_kd_penyakit">
<span<?= $Page->kd_penyakit->viewAttributes() ?>>
<?= $Page->kd_penyakit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosa_pasien_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_diagnosa_pasien_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prioritas->Visible) { // prioritas ?>
    <tr id="r_prioritas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosa_pasien_prioritas"><?= $Page->prioritas->caption() ?></span></td>
        <td data-name="prioritas" <?= $Page->prioritas->cellAttributes() ?>>
<span id="el_diagnosa_pasien_prioritas">
<span<?= $Page->prioritas->viewAttributes() ?>>
<?= $Page->prioritas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_penyakit->Visible) { // status_penyakit ?>
    <tr id="r_status_penyakit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosa_pasien_status_penyakit"><?= $Page->status_penyakit->caption() ?></span></td>
        <td data-name="status_penyakit" <?= $Page->status_penyakit->cellAttributes() ?>>
<span id="el_diagnosa_pasien_status_penyakit">
<span<?= $Page->status_penyakit->viewAttributes() ?>>
<?= $Page->status_penyakit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_icd9->Visible) { // kd_icd9 ?>
    <tr id="r_kd_icd9">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosa_pasien_kd_icd9"><?= $Page->kd_icd9->caption() ?></span></td>
        <td data-name="kd_icd9" <?= $Page->kd_icd9->cellAttributes() ?>>
<span id="el_diagnosa_pasien_kd_icd9">
<span<?= $Page->kd_icd9->viewAttributes() ?>>
<?= $Page->kd_icd9->getViewValue() ?></span>
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
