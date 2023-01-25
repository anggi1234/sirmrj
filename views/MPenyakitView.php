<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MPenyakitView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_penyakitview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fm_penyakitview = currentForm = new ew.Form("fm_penyakitview", "view");
    loadjs.done("fm_penyakitview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.m_penyakit) ew.vars.tables.m_penyakit = <?= JsonEncode(GetClientVar("tables", "m_penyakit")) ?>;
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
<form name="fm_penyakitview" id="fm_penyakitview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_penyakit">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
    <tr id="r_kd_penyakit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_penyakit_kd_penyakit"><?= $Page->kd_penyakit->caption() ?></span></td>
        <td data-name="kd_penyakit" <?= $Page->kd_penyakit->cellAttributes() ?>>
<span id="el_m_penyakit_kd_penyakit">
<span<?= $Page->kd_penyakit->viewAttributes() ?>>
<?= $Page->kd_penyakit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nm_penyakit->Visible) { // nm_penyakit ?>
    <tr id="r_nm_penyakit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_penyakit_nm_penyakit"><?= $Page->nm_penyakit->caption() ?></span></td>
        <td data-name="nm_penyakit" <?= $Page->nm_penyakit->cellAttributes() ?>>
<span id="el_m_penyakit_nm_penyakit">
<span<?= $Page->nm_penyakit->viewAttributes() ?>>
<?= $Page->nm_penyakit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ciri_ciri->Visible) { // ciri_ciri ?>
    <tr id="r_ciri_ciri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_penyakit_ciri_ciri"><?= $Page->ciri_ciri->caption() ?></span></td>
        <td data-name="ciri_ciri" <?= $Page->ciri_ciri->cellAttributes() ?>>
<span id="el_m_penyakit_ciri_ciri">
<span<?= $Page->ciri_ciri->viewAttributes() ?>>
<?= $Page->ciri_ciri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_penyakit_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan" <?= $Page->keterangan->cellAttributes() ?>>
<span id="el_m_penyakit_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_ktg->Visible) { // kd_ktg ?>
    <tr id="r_kd_ktg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_penyakit_kd_ktg"><?= $Page->kd_ktg->caption() ?></span></td>
        <td data-name="kd_ktg" <?= $Page->kd_ktg->cellAttributes() ?>>
<span id="el_m_penyakit_kd_ktg">
<span<?= $Page->kd_ktg->viewAttributes() ?>>
<?= $Page->kd_ktg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_penyakit_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_m_penyakit_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
