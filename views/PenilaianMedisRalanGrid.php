<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("PenilaianMedisRalanGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_ralangrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fpenilaian_medis_ralangrid = new ew.Form("fpenilaian_medis_ralangrid", "grid");
    fpenilaian_medis_ralangrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_medis_ralan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_medis_ralan)
        ew.vars.tables.penilaian_medis_ralan = currentTable;
    fpenilaian_medis_ralangrid.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null], fields.tanggal.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["anamnesis", [fields.anamnesis.visible && fields.anamnesis.required ? ew.Validators.required(fields.anamnesis.caption) : null], fields.anamnesis.isInvalid],
        ["keluhan_utama", [fields.keluhan_utama.visible && fields.keluhan_utama.required ? ew.Validators.required(fields.keluhan_utama.caption) : null], fields.keluhan_utama.isInvalid],
        ["alergi", [fields.alergi.visible && fields.alergi.required ? ew.Validators.required(fields.alergi.caption) : null], fields.alergi.isInvalid],
        ["keadaan", [fields.keadaan.visible && fields.keadaan.required ? ew.Validators.required(fields.keadaan.caption) : null], fields.keadaan.isInvalid],
        ["td", [fields.td.visible && fields.td.required ? ew.Validators.required(fields.td.caption) : null], fields.td.isInvalid],
        ["nadi", [fields.nadi.visible && fields.nadi.required ? ew.Validators.required(fields.nadi.caption) : null], fields.nadi.isInvalid],
        ["rr", [fields.rr.visible && fields.rr.required ? ew.Validators.required(fields.rr.caption) : null], fields.rr.isInvalid],
        ["suhu", [fields.suhu.visible && fields.suhu.required ? ew.Validators.required(fields.suhu.caption) : null], fields.suhu.isInvalid],
        ["bb", [fields.bb.visible && fields.bb.required ? ew.Validators.required(fields.bb.caption) : null], fields.bb.isInvalid],
        ["tb", [fields.tb.visible && fields.tb.required ? ew.Validators.required(fields.tb.caption) : null], fields.tb.isInvalid],
        ["diagnosis", [fields.diagnosis.visible && fields.diagnosis.required ? ew.Validators.required(fields.diagnosis.caption) : null], fields.diagnosis.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_medis_ralangrid,
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
    fpenilaian_medis_ralangrid.validate = function () {
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
    fpenilaian_medis_ralangrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_rawat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_dokter", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "anamnesis", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "keluhan_utama", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "alergi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "keadaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "td", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nadi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rr", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "suhu", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "bb", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tb", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "diagnosis", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpenilaian_medis_ralangrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_medis_ralangrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_medis_ralangrid.lists.anamnesis = <?= $Grid->anamnesis->toClientList($Grid) ?>;
    fpenilaian_medis_ralangrid.lists.keadaan = <?= $Grid->keadaan->toClientList($Grid) ?>;
    loadjs.done("fpenilaian_medis_ralangrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_medis_ralan">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpenilaian_medis_ralangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_penilaian_medis_ralan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_penilaian_medis_ralangrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_rawat" class="<?= $Grid->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_no_rawat" class="penilaian_medis_ralan_no_rawat"><?= $Grid->renderSort($Grid->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Grid->tanggal->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_tanggal" class="penilaian_medis_ralan_tanggal"><?= $Grid->renderSort($Grid->tanggal) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Grid->kd_dokter->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_kd_dokter" class="penilaian_medis_ralan_kd_dokter"><?= $Grid->renderSort($Grid->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Grid->anamnesis->Visible) { // anamnesis ?>
        <th data-name="anamnesis" class="<?= $Grid->anamnesis->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_anamnesis" class="penilaian_medis_ralan_anamnesis"><?= $Grid->renderSort($Grid->anamnesis) ?></div></th>
<?php } ?>
<?php if ($Grid->keluhan_utama->Visible) { // keluhan_utama ?>
        <th data-name="keluhan_utama" class="<?= $Grid->keluhan_utama->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_keluhan_utama" class="penilaian_medis_ralan_keluhan_utama"><?= $Grid->renderSort($Grid->keluhan_utama) ?></div></th>
<?php } ?>
<?php if ($Grid->alergi->Visible) { // alergi ?>
        <th data-name="alergi" class="<?= $Grid->alergi->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_alergi" class="penilaian_medis_ralan_alergi"><?= $Grid->renderSort($Grid->alergi) ?></div></th>
<?php } ?>
<?php if ($Grid->keadaan->Visible) { // keadaan ?>
        <th data-name="keadaan" class="<?= $Grid->keadaan->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_keadaan" class="penilaian_medis_ralan_keadaan"><?= $Grid->renderSort($Grid->keadaan) ?></div></th>
<?php } ?>
<?php if ($Grid->td->Visible) { // td ?>
        <th data-name="td" class="<?= $Grid->td->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_td" class="penilaian_medis_ralan_td"><?= $Grid->renderSort($Grid->td) ?></div></th>
<?php } ?>
<?php if ($Grid->nadi->Visible) { // nadi ?>
        <th data-name="nadi" class="<?= $Grid->nadi->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_nadi" class="penilaian_medis_ralan_nadi"><?= $Grid->renderSort($Grid->nadi) ?></div></th>
<?php } ?>
<?php if ($Grid->rr->Visible) { // rr ?>
        <th data-name="rr" class="<?= $Grid->rr->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_rr" class="penilaian_medis_ralan_rr"><?= $Grid->renderSort($Grid->rr) ?></div></th>
<?php } ?>
<?php if ($Grid->suhu->Visible) { // suhu ?>
        <th data-name="suhu" class="<?= $Grid->suhu->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_suhu" class="penilaian_medis_ralan_suhu"><?= $Grid->renderSort($Grid->suhu) ?></div></th>
<?php } ?>
<?php if ($Grid->bb->Visible) { // bb ?>
        <th data-name="bb" class="<?= $Grid->bb->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_bb" class="penilaian_medis_ralan_bb"><?= $Grid->renderSort($Grid->bb) ?></div></th>
<?php } ?>
<?php if ($Grid->tb->Visible) { // tb ?>
        <th data-name="tb" class="<?= $Grid->tb->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_tb" class="penilaian_medis_ralan_tb"><?= $Grid->renderSort($Grid->tb) ?></div></th>
<?php } ?>
<?php if ($Grid->diagnosis->Visible) { // diagnosis ?>
        <th data-name="diagnosis" class="<?= $Grid->diagnosis->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_diagnosis" class="penilaian_medis_ralan_diagnosis"><?= $Grid->renderSort($Grid->diagnosis) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_penilaian_medis_ralan", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_no_rawat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<?= $Grid->no_rawat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Grid->tanggal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<?= $Grid->tanggal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tanggal" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tanggal" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Grid->kd_dokter->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_kd_dokter" class="form-group">
<input type="<?= $Grid->kd_dokter->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->kd_dokter->getPlaceHolder()) ?>" value="<?= $Grid->kd_dokter->EditValue ?>"<?= $Grid->kd_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kd_dokter->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_dokter" id="o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_kd_dokter" class="form-group">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_dokter->getDisplayValue($Grid->kd_dokter->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_kd_dokter">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<?= $Grid->kd_dokter->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_kd_dokter" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_kd_dokter" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->anamnesis->Visible) { // anamnesis ?>
        <td data-name="anamnesis" <?= $Grid->anamnesis->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_anamnesis" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_anamnesis" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis"<?= $Grid->anamnesis->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_anamnesis" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_anamnesis"
    name="x<?= $Grid->RowIndex ?>_anamnesis"
    value="<?= HtmlEncode($Grid->anamnesis->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_anamnesis"
    data-target="dsl_x<?= $Grid->RowIndex ?>_anamnesis"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->anamnesis->isInvalidClass() ?>"
    data-table="penilaian_medis_ralan"
    data-field="x_anamnesis"
    data-value-separator="<?= $Grid->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Grid->anamnesis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->anamnesis->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_anamnesis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_anamnesis" id="o<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_anamnesis" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_anamnesis" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis"<?= $Grid->anamnesis->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_anamnesis" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_anamnesis"
    name="x<?= $Grid->RowIndex ?>_anamnesis"
    value="<?= HtmlEncode($Grid->anamnesis->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_anamnesis"
    data-target="dsl_x<?= $Grid->RowIndex ?>_anamnesis"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->anamnesis->isInvalidClass() ?>"
    data-table="penilaian_medis_ralan"
    data-field="x_anamnesis"
    data-value-separator="<?= $Grid->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Grid->anamnesis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->anamnesis->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_anamnesis">
<span<?= $Grid->anamnesis->viewAttributes() ?>>
<?= $Grid->anamnesis->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_anamnesis" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_anamnesis" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_anamnesis" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_anamnesis" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->keluhan_utama->Visible) { // keluhan_utama ?>
        <td data-name="keluhan_utama" <?= $Grid->keluhan_utama->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_keluhan_utama" class="form-group">
<textarea data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" name="x<?= $Grid->RowIndex ?>_keluhan_utama" id="x<?= $Grid->RowIndex ?>_keluhan_utama" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->keluhan_utama->getPlaceHolder()) ?>"<?= $Grid->keluhan_utama->editAttributes() ?>><?= $Grid->keluhan_utama->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->keluhan_utama->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keluhan_utama" id="o<?= $Grid->RowIndex ?>_keluhan_utama" value="<?= HtmlEncode($Grid->keluhan_utama->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_keluhan_utama" class="form-group">
<textarea data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" name="x<?= $Grid->RowIndex ?>_keluhan_utama" id="x<?= $Grid->RowIndex ?>_keluhan_utama" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->keluhan_utama->getPlaceHolder()) ?>"<?= $Grid->keluhan_utama->editAttributes() ?>><?= $Grid->keluhan_utama->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->keluhan_utama->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_keluhan_utama">
<span<?= $Grid->keluhan_utama->viewAttributes() ?>>
<?= $Grid->keluhan_utama->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_keluhan_utama" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_keluhan_utama" value="<?= HtmlEncode($Grid->keluhan_utama->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_keluhan_utama" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_keluhan_utama" value="<?= HtmlEncode($Grid->keluhan_utama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->alergi->Visible) { // alergi ?>
        <td data-name="alergi" <?= $Grid->alergi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_alergi" class="form-group">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_alergi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_alergi" id="o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_alergi" class="form-group">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_alergi">
<span<?= $Grid->alergi->viewAttributes() ?>>
<?= $Grid->alergi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_alergi" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_alergi" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_alergi" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_alergi" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->keadaan->Visible) { // keadaan ?>
        <td data-name="keadaan" <?= $Grid->keadaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_keadaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_keadaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_keadaan" name="x<?= $Grid->RowIndex ?>_keadaan" id="x<?= $Grid->RowIndex ?>_keadaan"<?= $Grid->keadaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_keadaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_keadaan"
    name="x<?= $Grid->RowIndex ?>_keadaan"
    value="<?= HtmlEncode($Grid->keadaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_keadaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_keadaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->keadaan->isInvalidClass() ?>"
    data-table="penilaian_medis_ralan"
    data-field="x_keadaan"
    data-value-separator="<?= $Grid->keadaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->keadaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keadaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keadaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keadaan" id="o<?= $Grid->RowIndex ?>_keadaan" value="<?= HtmlEncode($Grid->keadaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_keadaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_keadaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_keadaan" name="x<?= $Grid->RowIndex ?>_keadaan" id="x<?= $Grid->RowIndex ?>_keadaan"<?= $Grid->keadaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_keadaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_keadaan"
    name="x<?= $Grid->RowIndex ?>_keadaan"
    value="<?= HtmlEncode($Grid->keadaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_keadaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_keadaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->keadaan->isInvalidClass() ?>"
    data-table="penilaian_medis_ralan"
    data-field="x_keadaan"
    data-value-separator="<?= $Grid->keadaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->keadaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keadaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_keadaan">
<span<?= $Grid->keadaan->viewAttributes() ?>>
<?= $Grid->keadaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keadaan" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_keadaan" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_keadaan" value="<?= HtmlEncode($Grid->keadaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keadaan" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_keadaan" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_keadaan" value="<?= HtmlEncode($Grid->keadaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->td->Visible) { // td ?>
        <td data-name="td" <?= $Grid->td->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_td" class="form-group">
<input type="<?= $Grid->td->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_td" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->td->getPlaceHolder()) ?>" value="<?= $Grid->td->EditValue ?>"<?= $Grid->td->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->td->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_td" data-hidden="1" name="o<?= $Grid->RowIndex ?>_td" id="o<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_td" class="form-group">
<input type="<?= $Grid->td->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_td" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->td->getPlaceHolder()) ?>" value="<?= $Grid->td->EditValue ?>"<?= $Grid->td->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->td->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_td">
<span<?= $Grid->td->viewAttributes() ?>>
<?= $Grid->td->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_td" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_td" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_td" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_td" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nadi->Visible) { // nadi ?>
        <td data-name="nadi" <?= $Grid->nadi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_nadi" class="form-group">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_nadi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nadi" id="o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_nadi" class="form-group">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_nadi">
<span<?= $Grid->nadi->viewAttributes() ?>>
<?= $Grid->nadi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_nadi" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_nadi" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_nadi" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_nadi" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rr->Visible) { // rr ?>
        <td data-name="rr" <?= $Grid->rr->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_rr" class="form-group">
<input type="<?= $Grid->rr->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_rr" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->rr->getPlaceHolder()) ?>" value="<?= $Grid->rr->EditValue ?>"<?= $Grid->rr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rr->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_rr" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rr" id="o<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_rr" class="form-group">
<input type="<?= $Grid->rr->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_rr" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->rr->getPlaceHolder()) ?>" value="<?= $Grid->rr->EditValue ?>"<?= $Grid->rr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rr->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_rr">
<span<?= $Grid->rr->viewAttributes() ?>>
<?= $Grid->rr->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_rr" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_rr" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_rr" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_rr" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->suhu->Visible) { // suhu ?>
        <td data-name="suhu" <?= $Grid->suhu->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_suhu" class="form-group">
<input type="<?= $Grid->suhu->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_suhu" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu->getPlaceHolder()) ?>" value="<?= $Grid->suhu->EditValue ?>"<?= $Grid->suhu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_suhu" data-hidden="1" name="o<?= $Grid->RowIndex ?>_suhu" id="o<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_suhu" class="form-group">
<input type="<?= $Grid->suhu->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_suhu" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu->getPlaceHolder()) ?>" value="<?= $Grid->suhu->EditValue ?>"<?= $Grid->suhu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_suhu">
<span<?= $Grid->suhu->viewAttributes() ?>>
<?= $Grid->suhu->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_suhu" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_suhu" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_suhu" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_suhu" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bb->Visible) { // bb ?>
        <td data-name="bb" <?= $Grid->bb->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_bb" class="form-group">
<input type="<?= $Grid->bb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_bb" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bb->getPlaceHolder()) ?>" value="<?= $Grid->bb->EditValue ?>"<?= $Grid->bb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bb->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_bb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bb" id="o<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_bb" class="form-group">
<input type="<?= $Grid->bb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_bb" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bb->getPlaceHolder()) ?>" value="<?= $Grid->bb->EditValue ?>"<?= $Grid->bb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bb->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_bb">
<span<?= $Grid->bb->viewAttributes() ?>>
<?= $Grid->bb->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_bb" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_bb" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_bb" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_bb" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tb->Visible) { // tb ?>
        <td data-name="tb" <?= $Grid->tb->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_tb" class="form-group">
<input type="<?= $Grid->tb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_tb" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tb->getPlaceHolder()) ?>" value="<?= $Grid->tb->EditValue ?>"<?= $Grid->tb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tb->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tb" id="o<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_tb" class="form-group">
<input type="<?= $Grid->tb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_tb" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tb->getPlaceHolder()) ?>" value="<?= $Grid->tb->EditValue ?>"<?= $Grid->tb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tb->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_tb">
<span<?= $Grid->tb->viewAttributes() ?>>
<?= $Grid->tb->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tb" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_tb" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tb" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_tb" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->diagnosis->Visible) { // diagnosis ?>
        <td data-name="diagnosis" <?= $Grid->diagnosis->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_diagnosis" class="form-group">
<textarea data-table="penilaian_medis_ralan" data-field="x_diagnosis" name="x<?= $Grid->RowIndex ?>_diagnosis" id="x<?= $Grid->RowIndex ?>_diagnosis" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->diagnosis->getPlaceHolder()) ?>"<?= $Grid->diagnosis->editAttributes() ?>><?= $Grid->diagnosis->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->diagnosis->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_diagnosis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_diagnosis" id="o<?= $Grid->RowIndex ?>_diagnosis" value="<?= HtmlEncode($Grid->diagnosis->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_diagnosis" class="form-group">
<textarea data-table="penilaian_medis_ralan" data-field="x_diagnosis" name="x<?= $Grid->RowIndex ?>_diagnosis" id="x<?= $Grid->RowIndex ?>_diagnosis" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->diagnosis->getPlaceHolder()) ?>"<?= $Grid->diagnosis->editAttributes() ?>><?= $Grid->diagnosis->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->diagnosis->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_medis_ralan_diagnosis">
<span<?= $Grid->diagnosis->viewAttributes() ?>>
<?= $Grid->diagnosis->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_diagnosis" data-hidden="1" name="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_diagnosis" id="fpenilaian_medis_ralangrid$x<?= $Grid->RowIndex ?>_diagnosis" value="<?= HtmlEncode($Grid->diagnosis->FormValue) ?>">
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_diagnosis" data-hidden="1" name="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_diagnosis" id="fpenilaian_medis_ralangrid$o<?= $Grid->RowIndex ?>_diagnosis" value="<?= HtmlEncode($Grid->diagnosis->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpenilaian_medis_ralangrid","load"], function () {
    fpenilaian_medis_ralangrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_penilaian_medis_ralan", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_penilaian_medis_ralan_no_rawat" class="form-group penilaian_medis_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_no_rawat" class="form-group penilaian_medis_ralan_no_rawat">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_no_rawat" class="form-group penilaian_medis_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_no_rawat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_tanggal" class="form-group penilaian_medis_ralan_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggal->getDisplayValue($Grid->tanggal->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tanggal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_kd_dokter" class="form-group penilaian_medis_ralan_kd_dokter">
<input type="<?= $Grid->kd_dokter->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->kd_dokter->getPlaceHolder()) ?>" value="<?= $Grid->kd_dokter->EditValue ?>"<?= $Grid->kd_dokter->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kd_dokter->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_kd_dokter" class="form-group penilaian_medis_ralan_kd_dokter">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_dokter->getDisplayValue($Grid->kd_dokter->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_dokter" id="o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->anamnesis->Visible) { // anamnesis ?>
        <td data-name="anamnesis">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_anamnesis" class="form-group penilaian_medis_ralan_anamnesis">
<template id="tp_x<?= $Grid->RowIndex ?>_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_anamnesis" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis"<?= $Grid->anamnesis->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_anamnesis" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_anamnesis"
    name="x<?= $Grid->RowIndex ?>_anamnesis"
    value="<?= HtmlEncode($Grid->anamnesis->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_anamnesis"
    data-target="dsl_x<?= $Grid->RowIndex ?>_anamnesis"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->anamnesis->isInvalidClass() ?>"
    data-table="penilaian_medis_ralan"
    data-field="x_anamnesis"
    data-value-separator="<?= $Grid->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Grid->anamnesis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->anamnesis->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_anamnesis" class="form-group penilaian_medis_ralan_anamnesis">
<span<?= $Grid->anamnesis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->anamnesis->getDisplayValue($Grid->anamnesis->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_anamnesis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_anamnesis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_anamnesis" id="o<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->keluhan_utama->Visible) { // keluhan_utama ?>
        <td data-name="keluhan_utama">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_keluhan_utama" class="form-group penilaian_medis_ralan_keluhan_utama">
<textarea data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" name="x<?= $Grid->RowIndex ?>_keluhan_utama" id="x<?= $Grid->RowIndex ?>_keluhan_utama" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->keluhan_utama->getPlaceHolder()) ?>"<?= $Grid->keluhan_utama->editAttributes() ?>><?= $Grid->keluhan_utama->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->keluhan_utama->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_keluhan_utama" class="form-group penilaian_medis_ralan_keluhan_utama">
<span<?= $Grid->keluhan_utama->viewAttributes() ?>>
<?= $Grid->keluhan_utama->ViewValue ?></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" data-hidden="1" name="x<?= $Grid->RowIndex ?>_keluhan_utama" id="x<?= $Grid->RowIndex ?>_keluhan_utama" value="<?= HtmlEncode($Grid->keluhan_utama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keluhan_utama" id="o<?= $Grid->RowIndex ?>_keluhan_utama" value="<?= HtmlEncode($Grid->keluhan_utama->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->alergi->Visible) { // alergi ?>
        <td data-name="alergi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_alergi" class="form-group penilaian_medis_ralan_alergi">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_alergi" class="form-group penilaian_medis_ralan_alergi">
<span<?= $Grid->alergi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->alergi->getDisplayValue($Grid->alergi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_alergi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_alergi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_alergi" id="o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->keadaan->Visible) { // keadaan ?>
        <td data-name="keadaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_keadaan" class="form-group penilaian_medis_ralan_keadaan">
<template id="tp_x<?= $Grid->RowIndex ?>_keadaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_keadaan" name="x<?= $Grid->RowIndex ?>_keadaan" id="x<?= $Grid->RowIndex ?>_keadaan"<?= $Grid->keadaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_keadaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_keadaan"
    name="x<?= $Grid->RowIndex ?>_keadaan"
    value="<?= HtmlEncode($Grid->keadaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_keadaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_keadaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->keadaan->isInvalidClass() ?>"
    data-table="penilaian_medis_ralan"
    data-field="x_keadaan"
    data-value-separator="<?= $Grid->keadaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->keadaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keadaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_keadaan" class="form-group penilaian_medis_ralan_keadaan">
<span<?= $Grid->keadaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->keadaan->getDisplayValue($Grid->keadaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keadaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_keadaan" id="x<?= $Grid->RowIndex ?>_keadaan" value="<?= HtmlEncode($Grid->keadaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_keadaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keadaan" id="o<?= $Grid->RowIndex ?>_keadaan" value="<?= HtmlEncode($Grid->keadaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->td->Visible) { // td ?>
        <td data-name="td">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_td" class="form-group penilaian_medis_ralan_td">
<input type="<?= $Grid->td->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_td" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Grid->td->getPlaceHolder()) ?>" value="<?= $Grid->td->EditValue ?>"<?= $Grid->td->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->td->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_td" class="form-group penilaian_medis_ralan_td">
<span<?= $Grid->td->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->td->getDisplayValue($Grid->td->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_td" data-hidden="1" name="x<?= $Grid->RowIndex ?>_td" id="x<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_td" data-hidden="1" name="o<?= $Grid->RowIndex ?>_td" id="o<?= $Grid->RowIndex ?>_td" value="<?= HtmlEncode($Grid->td->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nadi->Visible) { // nadi ?>
        <td data-name="nadi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_nadi" class="form-group penilaian_medis_ralan_nadi">
<input type="<?= $Grid->nadi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_nadi" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->nadi->getPlaceHolder()) ?>" value="<?= $Grid->nadi->EditValue ?>"<?= $Grid->nadi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nadi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_nadi" class="form-group penilaian_medis_ralan_nadi">
<span<?= $Grid->nadi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nadi->getDisplayValue($Grid->nadi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_nadi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nadi" id="x<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_nadi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nadi" id="o<?= $Grid->RowIndex ?>_nadi" value="<?= HtmlEncode($Grid->nadi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rr->Visible) { // rr ?>
        <td data-name="rr">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_rr" class="form-group penilaian_medis_ralan_rr">
<input type="<?= $Grid->rr->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_rr" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->rr->getPlaceHolder()) ?>" value="<?= $Grid->rr->EditValue ?>"<?= $Grid->rr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rr->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_rr" class="form-group penilaian_medis_ralan_rr">
<span<?= $Grid->rr->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rr->getDisplayValue($Grid->rr->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_rr" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rr" id="x<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_rr" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rr" id="o<?= $Grid->RowIndex ?>_rr" value="<?= HtmlEncode($Grid->rr->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->suhu->Visible) { // suhu ?>
        <td data-name="suhu">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_suhu" class="form-group penilaian_medis_ralan_suhu">
<input type="<?= $Grid->suhu->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_suhu" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->suhu->getPlaceHolder()) ?>" value="<?= $Grid->suhu->EditValue ?>"<?= $Grid->suhu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->suhu->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_suhu" class="form-group penilaian_medis_ralan_suhu">
<span<?= $Grid->suhu->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->suhu->getDisplayValue($Grid->suhu->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_suhu" data-hidden="1" name="x<?= $Grid->RowIndex ?>_suhu" id="x<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_suhu" data-hidden="1" name="o<?= $Grid->RowIndex ?>_suhu" id="o<?= $Grid->RowIndex ?>_suhu" value="<?= HtmlEncode($Grid->suhu->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->bb->Visible) { // bb ?>
        <td data-name="bb">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_bb" class="form-group penilaian_medis_ralan_bb">
<input type="<?= $Grid->bb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_bb" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->bb->getPlaceHolder()) ?>" value="<?= $Grid->bb->EditValue ?>"<?= $Grid->bb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bb->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_bb" class="form-group penilaian_medis_ralan_bb">
<span<?= $Grid->bb->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->bb->getDisplayValue($Grid->bb->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_bb" data-hidden="1" name="x<?= $Grid->RowIndex ?>_bb" id="x<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_bb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bb" id="o<?= $Grid->RowIndex ?>_bb" value="<?= HtmlEncode($Grid->bb->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tb->Visible) { // tb ?>
        <td data-name="tb">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_tb" class="form-group penilaian_medis_ralan_tb">
<input type="<?= $Grid->tb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_tb" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->tb->getPlaceHolder()) ?>" value="<?= $Grid->tb->EditValue ?>"<?= $Grid->tb->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tb->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_tb" class="form-group penilaian_medis_ralan_tb">
<span<?= $Grid->tb->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tb->getDisplayValue($Grid->tb->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tb" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tb" id="x<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_tb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tb" id="o<?= $Grid->RowIndex ?>_tb" value="<?= HtmlEncode($Grid->tb->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->diagnosis->Visible) { // diagnosis ?>
        <td data-name="diagnosis">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_medis_ralan_diagnosis" class="form-group penilaian_medis_ralan_diagnosis">
<textarea data-table="penilaian_medis_ralan" data-field="x_diagnosis" name="x<?= $Grid->RowIndex ?>_diagnosis" id="x<?= $Grid->RowIndex ?>_diagnosis" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->diagnosis->getPlaceHolder()) ?>"<?= $Grid->diagnosis->editAttributes() ?>><?= $Grid->diagnosis->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->diagnosis->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_medis_ralan_diagnosis" class="form-group penilaian_medis_ralan_diagnosis">
<span<?= $Grid->diagnosis->viewAttributes() ?>>
<?= $Grid->diagnosis->ViewValue ?></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_diagnosis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_diagnosis" id="x<?= $Grid->RowIndex ?>_diagnosis" value="<?= HtmlEncode($Grid->diagnosis->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_diagnosis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_diagnosis" id="o<?= $Grid->RowIndex ?>_diagnosis" value="<?= HtmlEncode($Grid->diagnosis->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpenilaian_medis_ralangrid","load"], function() {
    fpenilaian_medis_ralangrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fpenilaian_medis_ralangrid">
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
    ew.addEventHandlers("penilaian_medis_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
