<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianPsikologiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_psikologidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpenilaian_psikologidelete = currentForm = new ew.Form("fpenilaian_psikologidelete", "delete");
    loadjs.done("fpenilaian_psikologidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.penilaian_psikologi) ew.vars.tables.penilaian_psikologi = <?= JsonEncode(GetClientVar("tables", "penilaian_psikologi")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenilaian_psikologidelete" id="fpenilaian_psikologidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_psikologi">
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_penilaian_psikologi_no_rawat" class="penilaian_psikologi_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><span id="elh_penilaian_psikologi_tanggal" class="penilaian_psikologi_tanggal"><?= $Page->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><span id="elh_penilaian_psikologi_nip" class="penilaian_psikologi_nip"><?= $Page->nip->caption() ?></span></th>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <th class="<?= $Page->anamnesis->headerCellClass() ?>"><span id="elh_penilaian_psikologi_anamnesis" class="penilaian_psikologi_anamnesis"><?= $Page->anamnesis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
        <th class="<?= $Page->dikirim_dari->headerCellClass() ?>"><span id="elh_penilaian_psikologi_dikirim_dari" class="penilaian_psikologi_dikirim_dari"><?= $Page->dikirim_dari->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <th class="<?= $Page->tujuan_pemeriksaan->headerCellClass() ?>"><span id="elh_penilaian_psikologi_tujuan_pemeriksaan" class="penilaian_psikologi_tujuan_pemeriksaan"><?= $Page->tujuan_pemeriksaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rupa->Visible) { // rupa ?>
        <th class="<?= $Page->rupa->headerCellClass() ?>"><span id="elh_penilaian_psikologi_rupa" class="penilaian_psikologi_rupa"><?= $Page->rupa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <th class="<?= $Page->bentuk_tubuh->headerCellClass() ?>"><span id="elh_penilaian_psikologi_bentuk_tubuh" class="penilaian_psikologi_bentuk_tubuh"><?= $Page->bentuk_tubuh->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tindakan->Visible) { // tindakan ?>
        <th class="<?= $Page->tindakan->headerCellClass() ?>"><span id="elh_penilaian_psikologi_tindakan" class="penilaian_psikologi_tindakan"><?= $Page->tindakan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pakaian->Visible) { // pakaian ?>
        <th class="<?= $Page->pakaian->headerCellClass() ?>"><span id="elh_penilaian_psikologi_pakaian" class="penilaian_psikologi_pakaian"><?= $Page->pakaian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ekspresi->Visible) { // ekspresi ?>
        <th class="<?= $Page->ekspresi->headerCellClass() ?>"><span id="elh_penilaian_psikologi_ekspresi" class="penilaian_psikologi_ekspresi"><?= $Page->ekspresi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->berbicara->Visible) { // berbicara ?>
        <th class="<?= $Page->berbicara->headerCellClass() ?>"><span id="elh_penilaian_psikologi_berbicara" class="penilaian_psikologi_berbicara"><?= $Page->berbicara->caption() ?></span></th>
<?php } ?>
<?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <th class="<?= $Page->penggunaan_kata->headerCellClass() ?>"><span id="elh_penilaian_psikologi_penggunaan_kata" class="penilaian_psikologi_penggunaan_kata"><?= $Page->penggunaan_kata->caption() ?></span></th>
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_no_rawat" class="penilaian_psikologi_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_tanggal" class="penilaian_psikologi_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <td <?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_nip" class="penilaian_psikologi_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <td <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_anamnesis" class="penilaian_psikologi_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
        <td <?= $Page->dikirim_dari->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_dikirim_dari" class="penilaian_psikologi_dikirim_dari">
<span<?= $Page->dikirim_dari->viewAttributes() ?>>
<?= $Page->dikirim_dari->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <td <?= $Page->tujuan_pemeriksaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_tujuan_pemeriksaan" class="penilaian_psikologi_tujuan_pemeriksaan">
<span<?= $Page->tujuan_pemeriksaan->viewAttributes() ?>>
<?= $Page->tujuan_pemeriksaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rupa->Visible) { // rupa ?>
        <td <?= $Page->rupa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_rupa" class="penilaian_psikologi_rupa">
<span<?= $Page->rupa->viewAttributes() ?>>
<?= $Page->rupa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <td <?= $Page->bentuk_tubuh->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_bentuk_tubuh" class="penilaian_psikologi_bentuk_tubuh">
<span<?= $Page->bentuk_tubuh->viewAttributes() ?>>
<?= $Page->bentuk_tubuh->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tindakan->Visible) { // tindakan ?>
        <td <?= $Page->tindakan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_tindakan" class="penilaian_psikologi_tindakan">
<span<?= $Page->tindakan->viewAttributes() ?>>
<?= $Page->tindakan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pakaian->Visible) { // pakaian ?>
        <td <?= $Page->pakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_pakaian" class="penilaian_psikologi_pakaian">
<span<?= $Page->pakaian->viewAttributes() ?>>
<?= $Page->pakaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ekspresi->Visible) { // ekspresi ?>
        <td <?= $Page->ekspresi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_ekspresi" class="penilaian_psikologi_ekspresi">
<span<?= $Page->ekspresi->viewAttributes() ?>>
<?= $Page->ekspresi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->berbicara->Visible) { // berbicara ?>
        <td <?= $Page->berbicara->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_berbicara" class="penilaian_psikologi_berbicara">
<span<?= $Page->berbicara->viewAttributes() ?>>
<?= $Page->berbicara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <td <?= $Page->penggunaan_kata->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_penggunaan_kata" class="penilaian_psikologi_penggunaan_kata">
<span<?= $Page->penggunaan_kata->viewAttributes() ?>>
<?= $Page->penggunaan_kata->getViewValue() ?></span>
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
