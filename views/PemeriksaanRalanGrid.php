<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("PemeriksaanRalanGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpemeriksaan_ralangrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fpemeriksaan_ralangrid = new ew.Form("fpemeriksaan_ralangrid", "grid");
    fpemeriksaan_ralangrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pemeriksaan_ralan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pemeriksaan_ralan)
        ew.vars.tables.pemeriksaan_ralan = currentTable;
    fpemeriksaan_ralangrid.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tgl_perawatan", [fields.tgl_perawatan.visible && fields.tgl_perawatan.required ? ew.Validators.required(fields.tgl_perawatan.caption) : null], fields.tgl_perawatan.isInvalid],
        ["jam_rawat", [fields.jam_rawat.visible && fields.jam_rawat.required ? ew.Validators.required(fields.jam_rawat.caption) : null], fields.jam_rawat.isInvalid],
        ["suhu_tubuh", [fields.suhu_tubuh.visible && fields.suhu_tubuh.required ? ew.Validators.required(fields.suhu_tubuh.caption) : null], fields.suhu_tubuh.isInvalid],
        ["tensi", [fields.tensi.visible && fields.tensi.required ? ew.Validators.required(fields.tensi.caption) : null], fields.tensi.isInvalid],
        ["nadi", [fields.nadi.visible && fields.nadi.required ? ew.Validators.required(fields.nadi.caption) : null], fields.nadi.isInvalid],
        ["respirasi", [fields.respirasi.visible && fields.respirasi.required ? ew.Validators.required(fields.respirasi.caption) : null], fields.respirasi.isInvalid],
        ["tinggi", [fields.tinggi.visible && fields.tinggi.required ? ew.Validators.required(fields.tinggi.caption) : null], fields.tinggi.isInvalid],
        ["berat", [fields.berat.visible && fields.berat.required ? ew.Validators.required(fields.berat.caption) : null], fields.berat.isInvalid],
        ["spo2", [fields.spo2.visible && fields.spo2.required ? ew.Validators.required(fields.spo2.caption) : null], fields.spo2.isInvalid],
        ["gcs", [fields.gcs.visible && fields.gcs.required ? ew.Validators.required(fields.gcs.caption) : null], fields.gcs.isInvalid],
        ["kesadaran", [fields.kesadaran.visible && fields.kesadaran.required ? ew.Validators.required(fields.kesadaran.caption) : null], fields.kesadaran.isInvalid],
        ["alergi", [fields.alergi.visible && fields.alergi.required ? ew.Validators.required(fields.alergi.caption) : null], fields.alergi.isInvalid],
        ["lingkar_perut", [fields.lingkar_perut.visible && fields.lingkar_perut.required ? ew.Validators.required(fields.lingkar_perut.caption) : null], fields.lingkar_perut.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid],
        ["id_pemeriksaan_ralan", [fields.id_pemeriksaan_ralan.visible && fields.id_pemeriksaan_ralan.required ? ew.Validators.required(fields.id_pemeriksaan_ralan.caption) : null], fields.id_pemeriksaan_ralan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpemeriksaan_ralangrid,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fpemeriksaan_ralangrid.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    fpemeriksaan_ralangrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_rawat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "suhu_tubuh", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tensi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nadi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "respirasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tinggi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "berat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "spo2", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "gcs", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kesadaran", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "alergi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "lingkar_perut", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nip", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpemeriksaan_ralangrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpemeriksaan_ralangrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpemeriksaan_ralangrid.lists.kesadaran = <?= $Grid->kesadaran->toClientList($Grid) ?>;
    loadjs.done("fpemeriksaan_ralangrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pemeriksaan_ralan">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpemeriksaan_ralangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_pemeriksaan_ralan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_pemeriksaan_ralangrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->no_rawat->Visible) { // no_rawat ?>
        <th data-name="no_rawat" class="<?= $Grid->no_rawat->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_no_rawat" class="pemeriksaan_ralan_no_rawat"><?= $Grid->renderSort($Grid->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_perawatan->Visible) { // tgl_perawatan ?>
        <th data-name="tgl_perawatan" class="<?= $Grid->tgl_perawatan->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_tgl_perawatan" class="pemeriksaan_ralan_tgl_perawatan"><?= $Grid->renderSort($Grid->tgl_perawatan) ?></div></th>
<?php } ?>
<?php if ($Grid->jam_rawat->Visible) { // jam_rawat ?>
        <th data-name="jam_rawat" class="<?= $Grid->jam_rawat->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_jam_rawat" class="pemeriksaan_ralan_jam_rawat"><?= $Grid->renderSort($Grid->jam_rawat) ?></div></th>
<?php } ?>
<?php if ($Grid->suhu_tubuh->Visible) { // suhu_tubuh ?>
        <th data-name="suhu_tubuh" class="<?= $Grid->suhu_tubuh->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_suhu_tubuh" class="pemeriksaan_ralan_suhu_tubuh"><?= $Grid->renderSort($Grid->suhu_tubuh) ?></div></th>
<?php } ?>
<?php if ($Grid->tensi->Visible) { // tensi ?>
        <th data-name="tensi" class="<?= $Grid->tensi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_tensi" class="pemeriksaan_ralan_tensi"><?= $Grid->renderSort($Grid->tensi) ?></div></th>
<?php } ?>
<?php if ($Grid->nadi->Visible) { // nadi ?>
        <th data-name="nadi" class="<?= $Grid->nadi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_nadi" class="pemeriksaan_ralan_nadi"><?= $Grid->renderSort($Grid->nadi) ?></div></th>
<?php } ?>
<?php if ($Grid->respirasi->Visible) { // respirasi ?>
        <th data-name="respirasi" class="<?= $Grid->respirasi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_respirasi" class="pemeriksaan_ralan_respirasi"><?= $Grid->renderSort($Grid->respirasi) ?></div></th>
<?php } ?>
<?php if ($Grid->tinggi->Visible) { // tinggi ?>
        <th data-name="tinggi" class="<?= $Grid->tinggi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_tinggi" class="pemeriksaan_ralan_tinggi"><?= $Grid->renderSort($Grid->tinggi) ?></div></th>
<?php } ?>
<?php if ($Grid->berat->Visible) { // berat ?>
        <th data-name="berat" class="<?= $Grid->berat->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_berat" class="pemeriksaan_ralan_berat"><?= $Grid->renderSort($Grid->berat) ?></div></th>
<?php } ?>
<?php if ($Grid->spo2->Visible) { // spo2 ?>
        <th data-name="spo2" class="<?= $Grid->spo2->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_spo2" class="pemeriksaan_ralan_spo2"><?= $Grid->renderSort($Grid->spo2) ?></div></th>
<?php } ?>
<?php if ($Grid->gcs->Visible) { // gcs ?>
        <th data-name="gcs" class="<?= $Grid->gcs->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_gcs" class="pemeriksaan_ralan_gcs"><?= $Grid->renderSort($Grid->gcs) ?></div></th>
<?php } ?>
<?php if ($Grid->kesadaran->Visible) { // kesadaran ?>
        <th data-name="kesadaran" class="<?= $Grid->kesadaran->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_kesadaran" class="pemeriksaan_ralan_kesadaran"><?= $Grid->renderSort($Grid->kesadaran) ?></div></th>
<?php } ?>
<?php if ($Grid->alergi->Visible) { // alergi ?>
        <th data-name="alergi" class="<?= $Grid->alergi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_alergi" class="pemeriksaan_ralan_alergi"><?= $Grid->renderSort($Grid->alergi) ?></div></th>
<?php } ?>
<?php if ($Grid->lingkar_perut->Visible) { // lingkar_perut ?>
        <th data-name="lingkar_perut" class="<?= $Grid->lingkar_perut->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_lingkar_perut" class="pemeriksaan_ralan_lingkar_perut"><?= $Grid->renderSort($Grid->lingkar_perut) ?></div></th>
<?php } ?>
<?php if ($Grid->nip->Visible) { // nip ?>
        <th data-name="nip" class="<?= $Grid->nip->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_nip" class="pemeriksaan_ralan_nip"><?= $Grid->renderSort($Grid->nip) ?></div></th>
<?php } ?>
<?php if ($Grid->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
        <th data-name="id_pemeriksaan_ralan" class="<?= $Grid->id_pemeriksaan_ralan->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_id_pemeriksaan_ralan" class="pemeriksaan_ralan_id_pemeriksaan_ralan"><?= $Grid->renderSort($Grid->id_pemeriksaan_ralan) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_pemeriksaan_ralan", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->no_rawat->Visible) { // no_rawat ?>
        <td data-name="no_rawat" <?= $Grid->no_rawat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<?= $Grid->no_rawat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_no_rawat" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_no_rawat" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_no_rawat" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_no_rawat" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_perawatan->Visible) { // tgl_perawatan ?>
        <td data-name="tgl_perawatan" <?= $Grid->tgl_perawatan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tgl_perawatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_perawatan" id="o<?= $Grid->RowIndex ?>_tgl_perawatan" value="<?= HtmlEncode($Grid->tgl_perawatan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_tgl_perawatan">
<span<?= $Grid->tgl_perawatan->viewAttributes() ?>>
<?= $Grid->tgl_perawatan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tgl_perawatan" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_tgl_perawatan" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_tgl_perawatan" value="<?= HtmlEncode($Grid->tgl_perawatan->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tgl_perawatan" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_tgl_perawatan" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_tgl_perawatan" value="<?= HtmlEncode($Grid->tgl_perawatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jam_rawat->Visible) { // jam_rawat ?>
        <td data-name="jam_rawat" <?= $Grid->jam_rawat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_jam_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_rawat" id="o<?= $Grid->RowIndex ?>_jam_rawat" value="<?= HtmlEncode($Grid->jam_rawat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_jam_rawat">
<span<?= $Grid->jam_rawat->viewAttributes() ?>>
<?= $Grid->jam_rawat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_jam_rawat" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_jam_rawat" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_jam_rawat" value="<?= HtmlEncode($Grid->jam_rawat->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_jam_rawat" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_jam_rawat" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_jam_rawat" value="<?= HtmlEncode($Grid->jam_rawat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->suhu_tubuh->Visible) { // suhu_tubuh ?>
        <td data-name="suhu_tubuh" <?= $Grid->suhu_tubuh->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_suhu_tubuh" class="form-group">
<input type="<?= $Grid->suhu_tubuh->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" name="x<?= $Grid->RowIndex ?>_suhu_tubuh" id="x<?= $Grid->RowIndex ?>_suhu_tubuh" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu_tubuh->getPlaceHolder()) ?>" value="<?= $Grid->suhu_tubuh->EditValue ?>"<?= $Grid->suhu_tubuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu_tubuh->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" data-hidden="1" name="o<?= $Grid->RowIndex ?>_suhu_tubuh" id="o<?= $Grid->RowIndex ?>_suhu_tubuh" value="<?= HtmlEncode($Grid->suhu_tubuh->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_suhu_tubuh" class="form-group">
<input type="<?= $Grid->suhu_tubuh->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" name="x<?= $Grid->RowIndex ?>_suhu_tubuh" id="x<?= $Grid->RowIndex ?>_suhu_tubuh" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu_tubuh->getPlaceHolder()) ?>" value="<?= $Grid->suhu_tubuh->EditValue ?>"<?= $Grid->suhu_tubuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu_tubuh->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_suhu_tubuh">
<span<?= $Grid->suhu_tubuh->viewAttributes() ?>>
<?= $Grid->suhu_tubuh->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_suhu_tubuh" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_suhu_tubuh" value="<?= HtmlEncode($Grid->suhu_tubuh->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_suhu_tubuh" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_suhu_tubuh" value="<?= HtmlEncode($Grid->suhu_tubuh->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tensi->Visible) { // tensi ?>
        <td data-name="tensi" <?= $Grid->tensi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_tensi" class="form-group">
<input type="<?= $Grid->tensi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tensi" name="x<?= $Grid->RowIndex ?>_tensi" id="x<?= $Grid->RowIndex ?>_tensi" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->tensi->getPlaceHolder()) ?>" value="<?= $Grid->tensi->EditValue ?>"<?= $Grid->tensi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tensi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tensi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tensi" id="o<?= $Grid->RowIndex ?>_tensi" value="<?= HtmlEncode($Grid->tensi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_tensi" class="form-group">
<input type="<?= $Grid->tensi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tensi" name="x<?= $Grid->RowIndex ?>_tensi" id="x<?= $Grid->RowIndex ?>_tensi" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->tensi->getPlaceHolder()) ?>" value="<?= $Grid->tensi->EditValue ?>"<?= $Grid->tensi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tensi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_tensi">
<span<?= $Grid->tensi->viewAttributes() ?>>
<?= $Grid->tensi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tensi" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_tensi" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_tensi" value="<?= HtmlEncode($Grid->tensi->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tensi" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_tensi" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_tensi" value="<?= HtmlEncode($Grid->tensi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nadi->Visible) { // nadi ?>
        <td data-name="nadi" <?= $Grid->nadi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_nadi" class="form-group">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nadi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nadi" id="o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_nadi" class="form-group">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_nadi">
<span<?= $Grid->nadi->viewAttributes() ?>>
<?= $Grid->nadi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nadi" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_nadi" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nadi" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_nadi" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->respirasi->Visible) { // respirasi ?>
        <td data-name="respirasi" <?= $Grid->respirasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_respirasi" class="form-group">
<input type="<?= $Grid->respirasi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_respirasi" name="x<?= $Grid->RowIndex ?>_respirasi" id="x<?= $Grid->RowIndex ?>_respirasi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->respirasi->getPlaceHolder()) ?>" value="<?= $Grid->respirasi->EditValue ?>"<?= $Grid->respirasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->respirasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_respirasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_respirasi" id="o<?= $Grid->RowIndex ?>_respirasi" value="<?= HtmlEncode($Grid->respirasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_respirasi" class="form-group">
<input type="<?= $Grid->respirasi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_respirasi" name="x<?= $Grid->RowIndex ?>_respirasi" id="x<?= $Grid->RowIndex ?>_respirasi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->respirasi->getPlaceHolder()) ?>" value="<?= $Grid->respirasi->EditValue ?>"<?= $Grid->respirasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->respirasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_respirasi">
<span<?= $Grid->respirasi->viewAttributes() ?>>
<?= $Grid->respirasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_respirasi" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_respirasi" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_respirasi" value="<?= HtmlEncode($Grid->respirasi->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_respirasi" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_respirasi" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_respirasi" value="<?= HtmlEncode($Grid->respirasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tinggi->Visible) { // tinggi ?>
        <td data-name="tinggi" <?= $Grid->tinggi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_tinggi" class="form-group">
<input type="<?= $Grid->tinggi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tinggi" name="x<?= $Grid->RowIndex ?>_tinggi" id="x<?= $Grid->RowIndex ?>_tinggi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tinggi->getPlaceHolder()) ?>" value="<?= $Grid->tinggi->EditValue ?>"<?= $Grid->tinggi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tinggi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tinggi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tinggi" id="o<?= $Grid->RowIndex ?>_tinggi" value="<?= HtmlEncode($Grid->tinggi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_tinggi" class="form-group">
<input type="<?= $Grid->tinggi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tinggi" name="x<?= $Grid->RowIndex ?>_tinggi" id="x<?= $Grid->RowIndex ?>_tinggi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tinggi->getPlaceHolder()) ?>" value="<?= $Grid->tinggi->EditValue ?>"<?= $Grid->tinggi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tinggi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_tinggi">
<span<?= $Grid->tinggi->viewAttributes() ?>>
<?= $Grid->tinggi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tinggi" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_tinggi" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_tinggi" value="<?= HtmlEncode($Grid->tinggi->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tinggi" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_tinggi" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_tinggi" value="<?= HtmlEncode($Grid->tinggi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->berat->Visible) { // berat ?>
        <td data-name="berat" <?= $Grid->berat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_berat" class="form-group">
<input type="<?= $Grid->berat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_berat" name="x<?= $Grid->RowIndex ?>_berat" id="x<?= $Grid->RowIndex ?>_berat" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->berat->getPlaceHolder()) ?>" value="<?= $Grid->berat->EditValue ?>"<?= $Grid->berat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->berat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_berat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_berat" id="o<?= $Grid->RowIndex ?>_berat" value="<?= HtmlEncode($Grid->berat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_berat" class="form-group">
<input type="<?= $Grid->berat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_berat" name="x<?= $Grid->RowIndex ?>_berat" id="x<?= $Grid->RowIndex ?>_berat" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->berat->getPlaceHolder()) ?>" value="<?= $Grid->berat->EditValue ?>"<?= $Grid->berat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->berat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_berat">
<span<?= $Grid->berat->viewAttributes() ?>>
<?= $Grid->berat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_berat" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_berat" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_berat" value="<?= HtmlEncode($Grid->berat->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_berat" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_berat" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_berat" value="<?= HtmlEncode($Grid->berat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->spo2->Visible) { // spo2 ?>
        <td data-name="spo2" <?= $Grid->spo2->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_spo2" class="form-group">
<input type="<?= $Grid->spo2->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_spo2" name="x<?= $Grid->RowIndex ?>_spo2" id="x<?= $Grid->RowIndex ?>_spo2" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->spo2->getPlaceHolder()) ?>" value="<?= $Grid->spo2->EditValue ?>"<?= $Grid->spo2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->spo2->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_spo2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_spo2" id="o<?= $Grid->RowIndex ?>_spo2" value="<?= HtmlEncode($Grid->spo2->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_spo2" class="form-group">
<input type="<?= $Grid->spo2->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_spo2" name="x<?= $Grid->RowIndex ?>_spo2" id="x<?= $Grid->RowIndex ?>_spo2" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->spo2->getPlaceHolder()) ?>" value="<?= $Grid->spo2->EditValue ?>"<?= $Grid->spo2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->spo2->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_spo2">
<span<?= $Grid->spo2->viewAttributes() ?>>
<?= $Grid->spo2->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_spo2" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_spo2" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_spo2" value="<?= HtmlEncode($Grid->spo2->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_spo2" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_spo2" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_spo2" value="<?= HtmlEncode($Grid->spo2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->gcs->Visible) { // gcs ?>
        <td data-name="gcs" <?= $Grid->gcs->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_gcs" class="form-group">
<input type="<?= $Grid->gcs->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_gcs" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->gcs->getPlaceHolder()) ?>" value="<?= $Grid->gcs->EditValue ?>"<?= $Grid->gcs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gcs->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_gcs" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gcs" id="o<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_gcs" class="form-group">
<input type="<?= $Grid->gcs->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_gcs" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->gcs->getPlaceHolder()) ?>" value="<?= $Grid->gcs->EditValue ?>"<?= $Grid->gcs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gcs->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_gcs">
<span<?= $Grid->gcs->viewAttributes() ?>>
<?= $Grid->gcs->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_gcs" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_gcs" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_gcs" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_gcs" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kesadaran->Visible) { // kesadaran ?>
        <td data-name="kesadaran" <?= $Grid->kesadaran->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_kesadaran" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kesadaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pemeriksaan_ralan" data-field="x_kesadaran" name="x<?= $Grid->RowIndex ?>_kesadaran" id="x<?= $Grid->RowIndex ?>_kesadaran"<?= $Grid->kesadaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kesadaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kesadaran"
    name="x<?= $Grid->RowIndex ?>_kesadaran"
    value="<?= HtmlEncode($Grid->kesadaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kesadaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kesadaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kesadaran->isInvalidClass() ?>"
    data-table="pemeriksaan_ralan"
    data-field="x_kesadaran"
    data-value-separator="<?= $Grid->kesadaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kesadaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kesadaran->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_kesadaran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kesadaran" id="o<?= $Grid->RowIndex ?>_kesadaran" value="<?= HtmlEncode($Grid->kesadaran->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_kesadaran" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_kesadaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pemeriksaan_ralan" data-field="x_kesadaran" name="x<?= $Grid->RowIndex ?>_kesadaran" id="x<?= $Grid->RowIndex ?>_kesadaran"<?= $Grid->kesadaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kesadaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kesadaran"
    name="x<?= $Grid->RowIndex ?>_kesadaran"
    value="<?= HtmlEncode($Grid->kesadaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kesadaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kesadaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kesadaran->isInvalidClass() ?>"
    data-table="pemeriksaan_ralan"
    data-field="x_kesadaran"
    data-value-separator="<?= $Grid->kesadaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kesadaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kesadaran->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_kesadaran">
<span<?= $Grid->kesadaran->viewAttributes() ?>>
<?= $Grid->kesadaran->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_kesadaran" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_kesadaran" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_kesadaran" value="<?= HtmlEncode($Grid->kesadaran->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_kesadaran" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_kesadaran" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_kesadaran" value="<?= HtmlEncode($Grid->kesadaran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->alergi->Visible) { // alergi ?>
        <td data-name="alergi" <?= $Grid->alergi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_alergi" class="form-group">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_alergi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_alergi" id="o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_alergi" class="form-group">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_alergi">
<span<?= $Grid->alergi->viewAttributes() ?>>
<?= $Grid->alergi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_alergi" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_alergi" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_alergi" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_alergi" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->lingkar_perut->Visible) { // lingkar_perut ?>
        <td data-name="lingkar_perut" <?= $Grid->lingkar_perut->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_lingkar_perut" class="form-group">
<input type="<?= $Grid->lingkar_perut->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" name="x<?= $Grid->RowIndex ?>_lingkar_perut" id="x<?= $Grid->RowIndex ?>_lingkar_perut" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->lingkar_perut->getPlaceHolder()) ?>" value="<?= $Grid->lingkar_perut->EditValue ?>"<?= $Grid->lingkar_perut->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lingkar_perut->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lingkar_perut" id="o<?= $Grid->RowIndex ?>_lingkar_perut" value="<?= HtmlEncode($Grid->lingkar_perut->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_lingkar_perut" class="form-group">
<input type="<?= $Grid->lingkar_perut->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" name="x<?= $Grid->RowIndex ?>_lingkar_perut" id="x<?= $Grid->RowIndex ?>_lingkar_perut" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->lingkar_perut->getPlaceHolder()) ?>" value="<?= $Grid->lingkar_perut->EditValue ?>"<?= $Grid->lingkar_perut->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lingkar_perut->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_lingkar_perut">
<span<?= $Grid->lingkar_perut->viewAttributes() ?>>
<?= $Grid->lingkar_perut->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_lingkar_perut" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_lingkar_perut" value="<?= HtmlEncode($Grid->lingkar_perut->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_lingkar_perut" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_lingkar_perut" value="<?= HtmlEncode($Grid->lingkar_perut->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nip->Visible) { // nip ?>
        <td data-name="nip" <?= $Grid->nip->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_nip" class="form-group">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nip" id="o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_nip" class="form-group">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_nip">
<span<?= $Grid->nip->viewAttributes() ?>>
<?= $Grid->nip->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nip" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_nip" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nip" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_nip" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
        <td data-name="id_pemeriksaan_ralan" <?= $Grid->id_pemeriksaan_ralan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_id_pemeriksaan_ralan" class="form-group"></span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_id_pemeriksaan_ralan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" id="o<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" value="<?= HtmlEncode($Grid->id_pemeriksaan_ralan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_id_pemeriksaan_ralan" class="form-group">
<span<?= $Grid->id_pemeriksaan_ralan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_pemeriksaan_ralan->getDisplayValue($Grid->id_pemeriksaan_ralan->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_id_pemeriksaan_ralan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" id="x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" value="<?= HtmlEncode($Grid->id_pemeriksaan_ralan->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_pemeriksaan_ralan_id_pemeriksaan_ralan">
<span<?= $Grid->id_pemeriksaan_ralan->viewAttributes() ?>>
<?= $Grid->id_pemeriksaan_ralan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_id_pemeriksaan_ralan" data-hidden="1" name="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" id="fpemeriksaan_ralangrid$x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" value="<?= HtmlEncode($Grid->id_pemeriksaan_ralan->FormValue) ?>">
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_id_pemeriksaan_ralan" data-hidden="1" name="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" id="fpemeriksaan_ralangrid$o<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" value="<?= HtmlEncode($Grid->id_pemeriksaan_ralan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="pemeriksaan_ralan" data-field="x_id_pemeriksaan_ralan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" id="x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" value="<?= HtmlEncode($Grid->id_pemeriksaan_ralan->CurrentValue) ?>">
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpemeriksaan_ralangrid","load"], function () {
    fpemeriksaan_ralangrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_pemeriksaan_ralan", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->no_rawat->Visible) { // no_rawat ?>
        <td data-name="no_rawat">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el$rowindex$_pemeriksaan_ralan_no_rawat" class="form-group pemeriksaan_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_no_rawat" class="form-group pemeriksaan_ralan_no_rawat">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_no_rawat" class="form-group pemeriksaan_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_no_rawat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_perawatan->Visible) { // tgl_perawatan ?>
        <td data-name="tgl_perawatan">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_tgl_perawatan" class="form-group pemeriksaan_ralan_tgl_perawatan">
<span<?= $Grid->tgl_perawatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_perawatan->getDisplayValue($Grid->tgl_perawatan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tgl_perawatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_perawatan" id="x<?= $Grid->RowIndex ?>_tgl_perawatan" value="<?= HtmlEncode($Grid->tgl_perawatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tgl_perawatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_perawatan" id="o<?= $Grid->RowIndex ?>_tgl_perawatan" value="<?= HtmlEncode($Grid->tgl_perawatan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jam_rawat->Visible) { // jam_rawat ?>
        <td data-name="jam_rawat">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_jam_rawat" class="form-group pemeriksaan_ralan_jam_rawat">
<span<?= $Grid->jam_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jam_rawat->getDisplayValue($Grid->jam_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_jam_rawat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jam_rawat" id="x<?= $Grid->RowIndex ?>_jam_rawat" value="<?= HtmlEncode($Grid->jam_rawat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_jam_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_rawat" id="o<?= $Grid->RowIndex ?>_jam_rawat" value="<?= HtmlEncode($Grid->jam_rawat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->suhu_tubuh->Visible) { // suhu_tubuh ?>
        <td data-name="suhu_tubuh">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_suhu_tubuh" class="form-group pemeriksaan_ralan_suhu_tubuh">
<input type="<?= $Grid->suhu_tubuh->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" name="x<?= $Grid->RowIndex ?>_suhu_tubuh" id="x<?= $Grid->RowIndex ?>_suhu_tubuh" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu_tubuh->getPlaceHolder()) ?>" value="<?= $Grid->suhu_tubuh->EditValue ?>"<?= $Grid->suhu_tubuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu_tubuh->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_suhu_tubuh" class="form-group pemeriksaan_ralan_suhu_tubuh">
<span<?= $Grid->suhu_tubuh->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->suhu_tubuh->getDisplayValue($Grid->suhu_tubuh->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" data-hidden="1" name="x<?= $Grid->RowIndex ?>_suhu_tubuh" id="x<?= $Grid->RowIndex ?>_suhu_tubuh" value="<?= HtmlEncode($Grid->suhu_tubuh->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" data-hidden="1" name="o<?= $Grid->RowIndex ?>_suhu_tubuh" id="o<?= $Grid->RowIndex ?>_suhu_tubuh" value="<?= HtmlEncode($Grid->suhu_tubuh->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tensi->Visible) { // tensi ?>
        <td data-name="tensi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_tensi" class="form-group pemeriksaan_ralan_tensi">
<input type="<?= $Grid->tensi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tensi" name="x<?= $Grid->RowIndex ?>_tensi" id="x<?= $Grid->RowIndex ?>_tensi" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->tensi->getPlaceHolder()) ?>" value="<?= $Grid->tensi->EditValue ?>"<?= $Grid->tensi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tensi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_tensi" class="form-group pemeriksaan_ralan_tensi">
<span<?= $Grid->tensi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tensi->getDisplayValue($Grid->tensi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tensi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tensi" id="x<?= $Grid->RowIndex ?>_tensi" value="<?= HtmlEncode($Grid->tensi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tensi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tensi" id="o<?= $Grid->RowIndex ?>_tensi" value="<?= HtmlEncode($Grid->tensi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nadi->Visible) { // nadi ?>
        <td data-name="nadi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_nadi" class="form-group pemeriksaan_ralan_nadi">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_nadi" class="form-group pemeriksaan_ralan_nadi">
<span<?= $Grid->nadi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nadi->getDisplayValue($Grid->nadi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nadi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nadi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nadi" id="o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->respirasi->Visible) { // respirasi ?>
        <td data-name="respirasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_respirasi" class="form-group pemeriksaan_ralan_respirasi">
<input type="<?= $Grid->respirasi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_respirasi" name="x<?= $Grid->RowIndex ?>_respirasi" id="x<?= $Grid->RowIndex ?>_respirasi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->respirasi->getPlaceHolder()) ?>" value="<?= $Grid->respirasi->EditValue ?>"<?= $Grid->respirasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->respirasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_respirasi" class="form-group pemeriksaan_ralan_respirasi">
<span<?= $Grid->respirasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->respirasi->getDisplayValue($Grid->respirasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_respirasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_respirasi" id="x<?= $Grid->RowIndex ?>_respirasi" value="<?= HtmlEncode($Grid->respirasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_respirasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_respirasi" id="o<?= $Grid->RowIndex ?>_respirasi" value="<?= HtmlEncode($Grid->respirasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tinggi->Visible) { // tinggi ?>
        <td data-name="tinggi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_tinggi" class="form-group pemeriksaan_ralan_tinggi">
<input type="<?= $Grid->tinggi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tinggi" name="x<?= $Grid->RowIndex ?>_tinggi" id="x<?= $Grid->RowIndex ?>_tinggi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tinggi->getPlaceHolder()) ?>" value="<?= $Grid->tinggi->EditValue ?>"<?= $Grid->tinggi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tinggi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_tinggi" class="form-group pemeriksaan_ralan_tinggi">
<span<?= $Grid->tinggi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tinggi->getDisplayValue($Grid->tinggi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tinggi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tinggi" id="x<?= $Grid->RowIndex ?>_tinggi" value="<?= HtmlEncode($Grid->tinggi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_tinggi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tinggi" id="o<?= $Grid->RowIndex ?>_tinggi" value="<?= HtmlEncode($Grid->tinggi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->berat->Visible) { // berat ?>
        <td data-name="berat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_berat" class="form-group pemeriksaan_ralan_berat">
<input type="<?= $Grid->berat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_berat" name="x<?= $Grid->RowIndex ?>_berat" id="x<?= $Grid->RowIndex ?>_berat" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->berat->getPlaceHolder()) ?>" value="<?= $Grid->berat->EditValue ?>"<?= $Grid->berat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->berat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_berat" class="form-group pemeriksaan_ralan_berat">
<span<?= $Grid->berat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->berat->getDisplayValue($Grid->berat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_berat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_berat" id="x<?= $Grid->RowIndex ?>_berat" value="<?= HtmlEncode($Grid->berat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_berat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_berat" id="o<?= $Grid->RowIndex ?>_berat" value="<?= HtmlEncode($Grid->berat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->spo2->Visible) { // spo2 ?>
        <td data-name="spo2">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_spo2" class="form-group pemeriksaan_ralan_spo2">
<input type="<?= $Grid->spo2->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_spo2" name="x<?= $Grid->RowIndex ?>_spo2" id="x<?= $Grid->RowIndex ?>_spo2" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->spo2->getPlaceHolder()) ?>" value="<?= $Grid->spo2->EditValue ?>"<?= $Grid->spo2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->spo2->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_spo2" class="form-group pemeriksaan_ralan_spo2">
<span<?= $Grid->spo2->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->spo2->getDisplayValue($Grid->spo2->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_spo2" data-hidden="1" name="x<?= $Grid->RowIndex ?>_spo2" id="x<?= $Grid->RowIndex ?>_spo2" value="<?= HtmlEncode($Grid->spo2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_spo2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_spo2" id="o<?= $Grid->RowIndex ?>_spo2" value="<?= HtmlEncode($Grid->spo2->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->gcs->Visible) { // gcs ?>
        <td data-name="gcs">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_gcs" class="form-group pemeriksaan_ralan_gcs">
<input type="<?= $Grid->gcs->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_gcs" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->gcs->getPlaceHolder()) ?>" value="<?= $Grid->gcs->EditValue ?>"<?= $Grid->gcs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gcs->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_gcs" class="form-group pemeriksaan_ralan_gcs">
<span<?= $Grid->gcs->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->gcs->getDisplayValue($Grid->gcs->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_gcs" data-hidden="1" name="x<?= $Grid->RowIndex ?>_gcs" id="x<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_gcs" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gcs" id="o<?= $Grid->RowIndex ?>_gcs" value="<?= HtmlEncode($Grid->gcs->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kesadaran->Visible) { // kesadaran ?>
        <td data-name="kesadaran">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_kesadaran" class="form-group pemeriksaan_ralan_kesadaran">
<template id="tp_x<?= $Grid->RowIndex ?>_kesadaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pemeriksaan_ralan" data-field="x_kesadaran" name="x<?= $Grid->RowIndex ?>_kesadaran" id="x<?= $Grid->RowIndex ?>_kesadaran"<?= $Grid->kesadaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_kesadaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_kesadaran"
    name="x<?= $Grid->RowIndex ?>_kesadaran"
    value="<?= HtmlEncode($Grid->kesadaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_kesadaran"
    data-target="dsl_x<?= $Grid->RowIndex ?>_kesadaran"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->kesadaran->isInvalidClass() ?>"
    data-table="pemeriksaan_ralan"
    data-field="x_kesadaran"
    data-value-separator="<?= $Grid->kesadaran->displayValueSeparatorAttribute() ?>"
    <?= $Grid->kesadaran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kesadaran->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_kesadaran" class="form-group pemeriksaan_ralan_kesadaran">
<span<?= $Grid->kesadaran->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kesadaran->getDisplayValue($Grid->kesadaran->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_kesadaran" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kesadaran" id="x<?= $Grid->RowIndex ?>_kesadaran" value="<?= HtmlEncode($Grid->kesadaran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_kesadaran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kesadaran" id="o<?= $Grid->RowIndex ?>_kesadaran" value="<?= HtmlEncode($Grid->kesadaran->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->alergi->Visible) { // alergi ?>
        <td data-name="alergi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_alergi" class="form-group pemeriksaan_ralan_alergi">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_alergi" class="form-group pemeriksaan_ralan_alergi">
<span<?= $Grid->alergi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->alergi->getDisplayValue($Grid->alergi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_alergi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_alergi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_alergi" id="o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->lingkar_perut->Visible) { // lingkar_perut ?>
        <td data-name="lingkar_perut">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_lingkar_perut" class="form-group pemeriksaan_ralan_lingkar_perut">
<input type="<?= $Grid->lingkar_perut->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" name="x<?= $Grid->RowIndex ?>_lingkar_perut" id="x<?= $Grid->RowIndex ?>_lingkar_perut" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->lingkar_perut->getPlaceHolder()) ?>" value="<?= $Grid->lingkar_perut->EditValue ?>"<?= $Grid->lingkar_perut->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lingkar_perut->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_lingkar_perut" class="form-group pemeriksaan_ralan_lingkar_perut">
<span<?= $Grid->lingkar_perut->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lingkar_perut->getDisplayValue($Grid->lingkar_perut->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" data-hidden="1" name="x<?= $Grid->RowIndex ?>_lingkar_perut" id="x<?= $Grid->RowIndex ?>_lingkar_perut" value="<?= HtmlEncode($Grid->lingkar_perut->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lingkar_perut" id="o<?= $Grid->RowIndex ?>_lingkar_perut" value="<?= HtmlEncode($Grid->lingkar_perut->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nip->Visible) { // nip ?>
        <td data-name="nip">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_nip" class="form-group pemeriksaan_ralan_nip">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_nip" class="form-group pemeriksaan_ralan_nip">
<span<?= $Grid->nip->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nip->getDisplayValue($Grid->nip->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nip" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_nip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nip" id="o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
        <td data-name="id_pemeriksaan_ralan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_pemeriksaan_ralan_id_pemeriksaan_ralan" class="form-group pemeriksaan_ralan_id_pemeriksaan_ralan"></span>
<?php } else { ?>
<span id="el$rowindex$_pemeriksaan_ralan_id_pemeriksaan_ralan" class="form-group pemeriksaan_ralan_id_pemeriksaan_ralan">
<span<?= $Grid->id_pemeriksaan_ralan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_pemeriksaan_ralan->getDisplayValue($Grid->id_pemeriksaan_ralan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_id_pemeriksaan_ralan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" id="x<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" value="<?= HtmlEncode($Grid->id_pemeriksaan_ralan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pemeriksaan_ralan" data-field="x_id_pemeriksaan_ralan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" id="o<?= $Grid->RowIndex ?>_id_pemeriksaan_ralan" value="<?= HtmlEncode($Grid->id_pemeriksaan_ralan->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpemeriksaan_ralangrid","load"], function() {
    fpemeriksaan_ralangrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpemeriksaan_ralangrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("pemeriksaan_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
