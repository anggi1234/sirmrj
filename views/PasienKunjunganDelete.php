<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PasienKunjunganDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpasien_kunjungandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpasien_kunjungandelete = currentForm = new ew.Form("fpasien_kunjungandelete", "delete");
    loadjs.done("fpasien_kunjungandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.pasien_kunjungan) ew.vars.tables.pasien_kunjungan = <?= JsonEncode(GetClientVar("tables", "pasien_kunjungan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpasien_kunjungandelete" id="fpasien_kunjungandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien_kunjungan">
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
<?php if ($Page->id_reg->Visible) { // id_reg ?>
        <th class="<?= $Page->id_reg->headerCellClass() ?>"><span id="elh_pasien_kunjungan_id_reg" class="pasien_kunjungan_id_reg"><?= $Page->id_reg->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><span id="elh_pasien_kunjungan_no_rkm_medis" class="pasien_kunjungan_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
        <th class="<?= $Page->no_reg->headerCellClass() ?>"><span id="elh_pasien_kunjungan_no_reg" class="pasien_kunjungan_no_reg"><?= $Page->no_reg->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_pasien_kunjungan_no_rawat" class="pasien_kunjungan_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <th class="<?= $Page->tgl_registrasi->headerCellClass() ?>"><span id="elh_pasien_kunjungan_tgl_registrasi" class="pasien_kunjungan_tgl_registrasi"><?= $Page->tgl_registrasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_reg->Visible) { // jam_reg ?>
        <th class="<?= $Page->jam_reg->headerCellClass() ?>"><span id="elh_pasien_kunjungan_jam_reg" class="pasien_kunjungan_jam_reg"><?= $Page->jam_reg->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th class="<?= $Page->kd_dokter->headerCellClass() ?>"><span id="elh_pasien_kunjungan_kd_dokter" class="pasien_kunjungan_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></th>
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
<?php if ($Page->id_reg->Visible) { // id_reg ?>
        <td <?= $Page->id_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_kunjungan_id_reg" class="pasien_kunjungan_id_reg">
<span<?= $Page->id_reg->viewAttributes() ?>>
<?= $Page->id_reg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_kunjungan_no_rkm_medis" class="pasien_kunjungan_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
        <td <?= $Page->no_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_kunjungan_no_reg" class="pasien_kunjungan_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_kunjungan_no_rawat" class="pasien_kunjungan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <td <?= $Page->tgl_registrasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_kunjungan_tgl_registrasi" class="pasien_kunjungan_tgl_registrasi">
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_reg->Visible) { // jam_reg ?>
        <td <?= $Page->jam_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_kunjungan_jam_reg" class="pasien_kunjungan_jam_reg">
<span<?= $Page->jam_reg->viewAttributes() ?>>
<?= $Page->jam_reg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_kunjungan_kd_dokter" class="pasien_kunjungan_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
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
