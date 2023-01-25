<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$ResepDokterView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fresep_dokterview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fresep_dokterview = currentForm = new ew.Form("fresep_dokterview", "view");
    loadjs.done("fresep_dokterview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.resep_dokter) ew.vars.tables.resep_dokter = <?= JsonEncode(GetClientVar("tables", "resep_dokter")) ?>;
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
<form name="fresep_dokterview" id="fresep_dokterview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resep_dokter">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_resep_dokter->Visible) { // id_resep_dokter ?>
    <tr id="r_id_resep_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resep_dokter_id_resep_dokter"><?= $Page->id_resep_dokter->caption() ?></span></td>
        <td data-name="id_resep_dokter" <?= $Page->id_resep_dokter->cellAttributes() ?>>
<span id="el_resep_dokter_id_resep_dokter">
<span<?= $Page->id_resep_dokter->viewAttributes() ?>>
<?= $Page->id_resep_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <tr id="r_no_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resep_dokter_no_reg"><?= $Page->no_reg->caption() ?></span></td>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_resep_dokter_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_brng->Visible) { // kode_brng ?>
    <tr id="r_kode_brng">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resep_dokter_kode_brng"><?= $Page->kode_brng->caption() ?></span></td>
        <td data-name="kode_brng" <?= $Page->kode_brng->cellAttributes() ?>>
<span id="el_resep_dokter_kode_brng">
<span<?= $Page->kode_brng->viewAttributes() ?>>
<?= $Page->kode_brng->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jml->Visible) { // jml ?>
    <tr id="r_jml">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resep_dokter_jml"><?= $Page->jml->caption() ?></span></td>
        <td data-name="jml" <?= $Page->jml->cellAttributes() ?>>
<span id="el_resep_dokter_jml">
<span<?= $Page->jml->viewAttributes() ?>>
<?= $Page->jml->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->aturan_pakai->Visible) { // aturan_pakai ?>
    <tr id="r_aturan_pakai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resep_dokter_aturan_pakai"><?= $Page->aturan_pakai->caption() ?></span></td>
        <td data-name="aturan_pakai" <?= $Page->aturan_pakai->cellAttributes() ?>>
<span id="el_resep_dokter_aturan_pakai">
<span<?= $Page->aturan_pakai->viewAttributes() ?>>
<?= $Page->aturan_pakai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
    <tr id="r_tgl_input">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resep_dokter_tgl_input"><?= $Page->tgl_input->caption() ?></span></td>
        <td data-name="tgl_input" <?= $Page->tgl_input->cellAttributes() ?>>
<span id="el_resep_dokter_tgl_input">
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
