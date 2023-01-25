<?php

namespace PHPMaker2021\project4sik;

// Page object
$BayiLahirView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbayi_lahirview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbayi_lahirview = currentForm = new ew.Form("fbayi_lahirview", "view");
    loadjs.done("fbayi_lahirview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.bayi_lahir) ew.vars.tables.bayi_lahir = <?= JsonEncode(GetClientVar("tables", "bayi_lahir")) ?>;
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
<form name="fbayi_lahirview" id="fbayi_lahirview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bayi_lahir">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_bayi->Visible) { // id_bayi ?>
    <tr id="r_id_bayi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bayi_lahir_id_bayi"><?= $Page->id_bayi->caption() ?></span></td>
        <td data-name="id_bayi" <?= $Page->id_bayi->cellAttributes() ?>>
<span id="el_bayi_lahir_id_bayi">
<span<?= $Page->id_bayi->viewAttributes() ?>>
<?= $Page->id_bayi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nik_ibu_kandung->Visible) { // nik_ibu_kandung ?>
    <tr id="r_nik_ibu_kandung">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bayi_lahir_nik_ibu_kandung"><?= $Page->nik_ibu_kandung->caption() ?></span></td>
        <td data-name="nik_ibu_kandung" <?= $Page->nik_ibu_kandung->cellAttributes() ?>>
<span id="el_bayi_lahir_nik_ibu_kandung">
<span<?= $Page->nik_ibu_kandung->viewAttributes() ?>>
<?= $Page->nik_ibu_kandung->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
    <tr id="r_no_rekam_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bayi_lahir_no_rekam_medis"><?= $Page->no_rekam_medis->caption() ?></span></td>
        <td data-name="no_rekam_medis" <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el_bayi_lahir_no_rekam_medis">
<span<?= $Page->no_rekam_medis->viewAttributes() ?>>
<?= $Page->no_rekam_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <tr id="r_tanggal_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bayi_lahir_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></td>
        <td data-name="tanggal_lahir" <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el_bayi_lahir_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_lahir->Visible) { // jam_lahir ?>
    <tr id="r_jam_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bayi_lahir_jam_lahir"><?= $Page->jam_lahir->caption() ?></span></td>
        <td data-name="jam_lahir" <?= $Page->jam_lahir->cellAttributes() ?>>
<span id="el_bayi_lahir_jam_lahir">
<span<?= $Page->jam_lahir->viewAttributes() ?>>
<?= $Page->jam_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
    <tr id="r_jenis_kelamin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bayi_lahir_jenis_kelamin"><?= $Page->jenis_kelamin->caption() ?></span></td>
        <td data-name="jenis_kelamin" <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el_bayi_lahir_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
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
