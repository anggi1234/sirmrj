<?php

namespace PHPMaker2021\project4sik;

// Page object
$BayiLahirDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbayi_lahirdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbayi_lahirdelete = currentForm = new ew.Form("fbayi_lahirdelete", "delete");
    loadjs.done("fbayi_lahirdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.bayi_lahir) ew.vars.tables.bayi_lahir = <?= JsonEncode(GetClientVar("tables", "bayi_lahir")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbayi_lahirdelete" id="fbayi_lahirdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bayi_lahir">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id_bayi->Visible) { // id_bayi ?>
        <th class="<?= $Page->id_bayi->headerCellClass() ?>"><span id="elh_bayi_lahir_id_bayi" class="bayi_lahir_id_bayi"><?= $Page->id_bayi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nik_ibu_kandung->Visible) { // nik_ibu_kandung ?>
        <th class="<?= $Page->nik_ibu_kandung->headerCellClass() ?>"><span id="elh_bayi_lahir_nik_ibu_kandung" class="bayi_lahir_nik_ibu_kandung"><?= $Page->nik_ibu_kandung->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <th class="<?= $Page->no_rekam_medis->headerCellClass() ?>"><span id="elh_bayi_lahir_no_rekam_medis" class="bayi_lahir_no_rekam_medis"><?= $Page->no_rekam_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <th class="<?= $Page->tanggal_lahir->headerCellClass() ?>"><span id="elh_bayi_lahir_tanggal_lahir" class="bayi_lahir_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_lahir->Visible) { // jam_lahir ?>
        <th class="<?= $Page->jam_lahir->headerCellClass() ?>"><span id="elh_bayi_lahir_jam_lahir" class="bayi_lahir_jam_lahir"><?= $Page->jam_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <th class="<?= $Page->jenis_kelamin->headerCellClass() ?>"><span id="elh_bayi_lahir_jenis_kelamin" class="bayi_lahir_jenis_kelamin"><?= $Page->jenis_kelamin->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id_bayi->Visible) { // id_bayi ?>
        <td <?= $Page->id_bayi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bayi_lahir_id_bayi" class="bayi_lahir_id_bayi">
<span<?= $Page->id_bayi->viewAttributes() ?>>
<?= $Page->id_bayi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nik_ibu_kandung->Visible) { // nik_ibu_kandung ?>
        <td <?= $Page->nik_ibu_kandung->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bayi_lahir_nik_ibu_kandung" class="bayi_lahir_nik_ibu_kandung">
<span<?= $Page->nik_ibu_kandung->viewAttributes() ?>>
<?= $Page->nik_ibu_kandung->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <td <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bayi_lahir_no_rekam_medis" class="bayi_lahir_no_rekam_medis">
<span<?= $Page->no_rekam_medis->viewAttributes() ?>>
<?= $Page->no_rekam_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <td <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bayi_lahir_tanggal_lahir" class="bayi_lahir_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_lahir->Visible) { // jam_lahir ?>
        <td <?= $Page->jam_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bayi_lahir_jam_lahir" class="bayi_lahir_jam_lahir">
<span<?= $Page->jam_lahir->viewAttributes() ?>>
<?= $Page->jam_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <td <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bayi_lahir_jenis_kelamin" class="bayi_lahir_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
