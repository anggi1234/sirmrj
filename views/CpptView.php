<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CpptView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcpptview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcpptview = currentForm = new ew.Form("fcpptview", "view");
    loadjs.done("fcpptview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.cppt) ew.vars.tables.cppt = <?= JsonEncode(GetClientVar("tables", "cppt")) ?>;
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
<form name="fcpptview" id="fcpptview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cppt">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <tr id="r_no_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cppt_no_reg"><?= $Page->no_reg->caption() ?></span></td>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_cppt_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->profesi->Visible) { // profesi ?>
    <tr id="r_profesi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cppt_profesi"><?= $Page->profesi->caption() ?></span></td>
        <td data-name="profesi" <?= $Page->profesi->cellAttributes() ?>>
<span id="el_cppt_profesi">
<span<?= $Page->profesi->viewAttributes() ?>>
<?= $Page->profesi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hasil_soap->Visible) { // hasil_soap ?>
    <tr id="r_hasil_soap">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cppt_hasil_soap"><?= $Page->hasil_soap->caption() ?></span></td>
        <td data-name="hasil_soap" <?= $Page->hasil_soap->cellAttributes() ?>>
<span id="el_cppt_hasil_soap">
<span<?= $Page->hasil_soap->viewAttributes() ?>>
<?= $Page->hasil_soap->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->instruksi->Visible) { // instruksi ?>
    <tr id="r_instruksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cppt_instruksi"><?= $Page->instruksi->caption() ?></span></td>
        <td data-name="instruksi" <?= $Page->instruksi->cellAttributes() ?>>
<span id="el_cppt_instruksi">
<span<?= $Page->instruksi->viewAttributes() ?>>
<?= $Page->instruksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->verifikasi->Visible) { // verifikasi ?>
    <tr id="r_verifikasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cppt_verifikasi"><?= $Page->verifikasi->caption() ?></span></td>
        <td data-name="verifikasi" <?= $Page->verifikasi->cellAttributes() ?>>
<span id="el_cppt_verifikasi">
<span<?= $Page->verifikasi->viewAttributes() ?>>
<?= $Page->verifikasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_input->Visible) { // tanggal_input ?>
    <tr id="r_tanggal_input">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cppt_tanggal_input"><?= $Page->tanggal_input->caption() ?></span></td>
        <td data-name="tanggal_input" <?= $Page->tanggal_input->cellAttributes() ?>>
<span id="el_cppt_tanggal_input">
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
