<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$BillingView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbillingview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbillingview = currentForm = new ew.Form("fbillingview", "view");
    loadjs.done("fbillingview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.billing) ew.vars.tables.billing = <?= JsonEncode(GetClientVar("tables", "billing")) ?>;
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
<form name="fbillingview" id="fbillingview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="billing">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <tr id="r_no_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_no_reg"><?= $Page->no_reg->caption() ?></span></td>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_billing_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_byr->Visible) { // tgl_byr ?>
    <tr id="r_tgl_byr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_tgl_byr"><?= $Page->tgl_byr->caption() ?></span></td>
        <td data-name="tgl_byr" <?= $Page->tgl_byr->cellAttributes() ?>>
<span id="el_billing_tgl_byr">
<span<?= $Page->tgl_byr->viewAttributes() ?>>
<?= $Page->tgl_byr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no->Visible) { // no ?>
    <tr id="r_no">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_no"><?= $Page->no->caption() ?></span></td>
        <td data-name="no" <?= $Page->no->cellAttributes() ?>>
<span id="el_billing_no">
<span<?= $Page->no->viewAttributes() ?>>
<?= $Page->no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nm_perawatan->Visible) { // nm_perawatan ?>
    <tr id="r_nm_perawatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_nm_perawatan"><?= $Page->nm_perawatan->caption() ?></span></td>
        <td data-name="nm_perawatan" <?= $Page->nm_perawatan->cellAttributes() ?>>
<span id="el_billing_nm_perawatan">
<span<?= $Page->nm_perawatan->viewAttributes() ?>>
<?= $Page->nm_perawatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pemisah->Visible) { // pemisah ?>
    <tr id="r_pemisah">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_pemisah"><?= $Page->pemisah->caption() ?></span></td>
        <td data-name="pemisah" <?= $Page->pemisah->cellAttributes() ?>>
<span id="el_billing_pemisah">
<span<?= $Page->pemisah->viewAttributes() ?>>
<?= $Page->pemisah->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
    <tr id="r_biaya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_biaya"><?= $Page->biaya->caption() ?></span></td>
        <td data-name="biaya" <?= $Page->biaya->cellAttributes() ?>>
<span id="el_billing_biaya">
<span<?= $Page->biaya->viewAttributes() ?>>
<?= $Page->biaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
    <tr id="r_jumlah">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_jumlah"><?= $Page->jumlah->caption() ?></span></td>
        <td data-name="jumlah" <?= $Page->jumlah->cellAttributes() ?>>
<span id="el_billing_jumlah">
<span<?= $Page->jumlah->viewAttributes() ?>>
<?= $Page->jumlah->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tambahan->Visible) { // tambahan ?>
    <tr id="r_tambahan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_tambahan"><?= $Page->tambahan->caption() ?></span></td>
        <td data-name="tambahan" <?= $Page->tambahan->cellAttributes() ?>>
<span id="el_billing_tambahan">
<span<?= $Page->tambahan->viewAttributes() ?>>
<?= $Page->tambahan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->totalbiaya->Visible) { // totalbiaya ?>
    <tr id="r_totalbiaya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_totalbiaya"><?= $Page->totalbiaya->caption() ?></span></td>
        <td data-name="totalbiaya" <?= $Page->totalbiaya->cellAttributes() ?>>
<span id="el_billing_totalbiaya">
<span<?= $Page->totalbiaya->viewAttributes() ?>>
<?= $Page->totalbiaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_billing_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_billing_status">
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
