<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("ResepDokterGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fresep_doktergrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fresep_doktergrid = new ew.Form("fresep_doktergrid", "grid");
    fresep_doktergrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "resep_dokter")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.resep_dokter)
        ew.vars.tables.resep_dokter = currentTable;
    fresep_doktergrid.addFields([
        ["id_resep_dokter", [fields.id_resep_dokter.visible && fields.id_resep_dokter.required ? ew.Validators.required(fields.id_resep_dokter.caption) : null], fields.id_resep_dokter.isInvalid],
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null, ew.Validators.integer], fields.no_reg.isInvalid],
        ["kode_brng", [fields.kode_brng.visible && fields.kode_brng.required ? ew.Validators.required(fields.kode_brng.caption) : null], fields.kode_brng.isInvalid],
        ["jml", [fields.jml.visible && fields.jml.required ? ew.Validators.required(fields.jml.caption) : null, ew.Validators.float], fields.jml.isInvalid],
        ["aturan_pakai", [fields.aturan_pakai.visible && fields.aturan_pakai.required ? ew.Validators.required(fields.aturan_pakai.caption) : null], fields.aturan_pakai.isInvalid],
        ["tgl_input", [fields.tgl_input.visible && fields.tgl_input.required ? ew.Validators.required(fields.tgl_input.caption) : null], fields.tgl_input.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fresep_doktergrid,
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
    fresep_doktergrid.validate = function () {
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
    fresep_doktergrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_reg", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kode_brng", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "jml", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "aturan_pakai", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fresep_doktergrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fresep_doktergrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fresep_doktergrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resep_dokter">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fresep_doktergrid" class="ew-form ew-list-form form-inline">
<div id="gmp_resep_dokter" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_resep_doktergrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->id_resep_dokter->Visible) { // id_resep_dokter ?>
        <th data-name="id_resep_dokter" class="<?= $Grid->id_resep_dokter->headerCellClass() ?>"><div id="elh_resep_dokter_id_resep_dokter" class="resep_dokter_id_resep_dokter"><?= $Grid->renderSort($Grid->id_resep_dokter) ?></div></th>
<?php } ?>
<?php if ($Grid->no_reg->Visible) { // no_reg ?>
        <th data-name="no_reg" class="<?= $Grid->no_reg->headerCellClass() ?>"><div id="elh_resep_dokter_no_reg" class="resep_dokter_no_reg"><?= $Grid->renderSort($Grid->no_reg) ?></div></th>
<?php } ?>
<?php if ($Grid->kode_brng->Visible) { // kode_brng ?>
        <th data-name="kode_brng" class="<?= $Grid->kode_brng->headerCellClass() ?>"><div id="elh_resep_dokter_kode_brng" class="resep_dokter_kode_brng"><?= $Grid->renderSort($Grid->kode_brng) ?></div></th>
<?php } ?>
<?php if ($Grid->jml->Visible) { // jml ?>
        <th data-name="jml" class="<?= $Grid->jml->headerCellClass() ?>"><div id="elh_resep_dokter_jml" class="resep_dokter_jml"><?= $Grid->renderSort($Grid->jml) ?></div></th>
<?php } ?>
<?php if ($Grid->aturan_pakai->Visible) { // aturan_pakai ?>
        <th data-name="aturan_pakai" class="<?= $Grid->aturan_pakai->headerCellClass() ?>"><div id="elh_resep_dokter_aturan_pakai" class="resep_dokter_aturan_pakai"><?= $Grid->renderSort($Grid->aturan_pakai) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_input->Visible) { // tgl_input ?>
        <th data-name="tgl_input" class="<?= $Grid->tgl_input->headerCellClass() ?>"><div id="elh_resep_dokter_tgl_input" class="resep_dokter_tgl_input"><?= $Grid->renderSort($Grid->tgl_input) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_resep_dokter", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->id_resep_dokter->Visible) { // id_resep_dokter ?>
        <td data-name="id_resep_dokter" <?= $Grid->id_resep_dokter->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_id_resep_dokter" class="form-group"></span>
<input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_resep_dokter" id="o<?= $Grid->RowIndex ?>_id_resep_dokter" value="<?= HtmlEncode($Grid->id_resep_dokter->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_id_resep_dokter" class="form-group">
<span<?= $Grid->id_resep_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_resep_dokter->getDisplayValue($Grid->id_resep_dokter->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_resep_dokter" id="x<?= $Grid->RowIndex ?>_id_resep_dokter" value="<?= HtmlEncode($Grid->id_resep_dokter->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_id_resep_dokter">
<span<?= $Grid->id_resep_dokter->viewAttributes() ?>>
<?= $Grid->id_resep_dokter->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="fresep_doktergrid$x<?= $Grid->RowIndex ?>_id_resep_dokter" id="fresep_doktergrid$x<?= $Grid->RowIndex ?>_id_resep_dokter" value="<?= HtmlEncode($Grid->id_resep_dokter->FormValue) ?>">
<input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="fresep_doktergrid$o<?= $Grid->RowIndex ?>_id_resep_dokter" id="fresep_doktergrid$o<?= $Grid->RowIndex ?>_id_resep_dokter" value="<?= HtmlEncode($Grid->id_resep_dokter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_resep_dokter" id="x<?= $Grid->RowIndex ?>_id_resep_dokter" value="<?= HtmlEncode($Grid->id_resep_dokter->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->no_reg->Visible) { // no_reg ?>
        <td data-name="no_reg" <?= $Grid->no_reg->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="resep_dokter" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="resep_dokter" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="resep_dokter" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<?= $Grid->no_reg->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="resep_dokter" data-field="x_no_reg" data-hidden="1" name="fresep_doktergrid$x<?= $Grid->RowIndex ?>_no_reg" id="fresep_doktergrid$x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<input type="hidden" data-table="resep_dokter" data-field="x_no_reg" data-hidden="1" name="fresep_doktergrid$o<?= $Grid->RowIndex ?>_no_reg" id="fresep_doktergrid$o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kode_brng->Visible) { // kode_brng ?>
        <td data-name="kode_brng" <?= $Grid->kode_brng->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_kode_brng" class="form-group">
<input type="<?= $Grid->kode_brng->getInputTextType() ?>" data-table="resep_dokter" data-field="x_kode_brng" name="x<?= $Grid->RowIndex ?>_kode_brng" id="x<?= $Grid->RowIndex ?>_kode_brng" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->kode_brng->getPlaceHolder()) ?>" value="<?= $Grid->kode_brng->EditValue ?>"<?= $Grid->kode_brng->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kode_brng->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_kode_brng" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kode_brng" id="o<?= $Grid->RowIndex ?>_kode_brng" value="<?= HtmlEncode($Grid->kode_brng->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_kode_brng" class="form-group">
<input type="<?= $Grid->kode_brng->getInputTextType() ?>" data-table="resep_dokter" data-field="x_kode_brng" name="x<?= $Grid->RowIndex ?>_kode_brng" id="x<?= $Grid->RowIndex ?>_kode_brng" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->kode_brng->getPlaceHolder()) ?>" value="<?= $Grid->kode_brng->EditValue ?>"<?= $Grid->kode_brng->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kode_brng->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_kode_brng">
<span<?= $Grid->kode_brng->viewAttributes() ?>>
<?= $Grid->kode_brng->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="resep_dokter" data-field="x_kode_brng" data-hidden="1" name="fresep_doktergrid$x<?= $Grid->RowIndex ?>_kode_brng" id="fresep_doktergrid$x<?= $Grid->RowIndex ?>_kode_brng" value="<?= HtmlEncode($Grid->kode_brng->FormValue) ?>">
<input type="hidden" data-table="resep_dokter" data-field="x_kode_brng" data-hidden="1" name="fresep_doktergrid$o<?= $Grid->RowIndex ?>_kode_brng" id="fresep_doktergrid$o<?= $Grid->RowIndex ?>_kode_brng" value="<?= HtmlEncode($Grid->kode_brng->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jml->Visible) { // jml ?>
        <td data-name="jml" <?= $Grid->jml->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_jml" class="form-group">
<input type="<?= $Grid->jml->getInputTextType() ?>" data-table="resep_dokter" data-field="x_jml" name="x<?= $Grid->RowIndex ?>_jml" id="x<?= $Grid->RowIndex ?>_jml" size="30" placeholder="<?= HtmlEncode($Grid->jml->getPlaceHolder()) ?>" value="<?= $Grid->jml->EditValue ?>"<?= $Grid->jml->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jml->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_jml" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jml" id="o<?= $Grid->RowIndex ?>_jml" value="<?= HtmlEncode($Grid->jml->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_jml" class="form-group">
<input type="<?= $Grid->jml->getInputTextType() ?>" data-table="resep_dokter" data-field="x_jml" name="x<?= $Grid->RowIndex ?>_jml" id="x<?= $Grid->RowIndex ?>_jml" size="30" placeholder="<?= HtmlEncode($Grid->jml->getPlaceHolder()) ?>" value="<?= $Grid->jml->EditValue ?>"<?= $Grid->jml->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jml->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_jml">
<span<?= $Grid->jml->viewAttributes() ?>>
<?= $Grid->jml->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="resep_dokter" data-field="x_jml" data-hidden="1" name="fresep_doktergrid$x<?= $Grid->RowIndex ?>_jml" id="fresep_doktergrid$x<?= $Grid->RowIndex ?>_jml" value="<?= HtmlEncode($Grid->jml->FormValue) ?>">
<input type="hidden" data-table="resep_dokter" data-field="x_jml" data-hidden="1" name="fresep_doktergrid$o<?= $Grid->RowIndex ?>_jml" id="fresep_doktergrid$o<?= $Grid->RowIndex ?>_jml" value="<?= HtmlEncode($Grid->jml->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->aturan_pakai->Visible) { // aturan_pakai ?>
        <td data-name="aturan_pakai" <?= $Grid->aturan_pakai->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_aturan_pakai" class="form-group">
<input type="<?= $Grid->aturan_pakai->getInputTextType() ?>" data-table="resep_dokter" data-field="x_aturan_pakai" name="x<?= $Grid->RowIndex ?>_aturan_pakai" id="x<?= $Grid->RowIndex ?>_aturan_pakai" size="30" maxlength="150" placeholder="<?= HtmlEncode($Grid->aturan_pakai->getPlaceHolder()) ?>" value="<?= $Grid->aturan_pakai->EditValue ?>"<?= $Grid->aturan_pakai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->aturan_pakai->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_aturan_pakai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_aturan_pakai" id="o<?= $Grid->RowIndex ?>_aturan_pakai" value="<?= HtmlEncode($Grid->aturan_pakai->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_aturan_pakai" class="form-group">
<input type="<?= $Grid->aturan_pakai->getInputTextType() ?>" data-table="resep_dokter" data-field="x_aturan_pakai" name="x<?= $Grid->RowIndex ?>_aturan_pakai" id="x<?= $Grid->RowIndex ?>_aturan_pakai" size="30" maxlength="150" placeholder="<?= HtmlEncode($Grid->aturan_pakai->getPlaceHolder()) ?>" value="<?= $Grid->aturan_pakai->EditValue ?>"<?= $Grid->aturan_pakai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->aturan_pakai->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_aturan_pakai">
<span<?= $Grid->aturan_pakai->viewAttributes() ?>>
<?= $Grid->aturan_pakai->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="resep_dokter" data-field="x_aturan_pakai" data-hidden="1" name="fresep_doktergrid$x<?= $Grid->RowIndex ?>_aturan_pakai" id="fresep_doktergrid$x<?= $Grid->RowIndex ?>_aturan_pakai" value="<?= HtmlEncode($Grid->aturan_pakai->FormValue) ?>">
<input type="hidden" data-table="resep_dokter" data-field="x_aturan_pakai" data-hidden="1" name="fresep_doktergrid$o<?= $Grid->RowIndex ?>_aturan_pakai" id="fresep_doktergrid$o<?= $Grid->RowIndex ?>_aturan_pakai" value="<?= HtmlEncode($Grid->aturan_pakai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_input->Visible) { // tgl_input ?>
        <td data-name="tgl_input" <?= $Grid->tgl_input->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="resep_dokter" data-field="x_tgl_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_input" id="o<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_resep_dokter_tgl_input">
<span<?= $Grid->tgl_input->viewAttributes() ?>>
<?= $Grid->tgl_input->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="resep_dokter" data-field="x_tgl_input" data-hidden="1" name="fresep_doktergrid$x<?= $Grid->RowIndex ?>_tgl_input" id="fresep_doktergrid$x<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->FormValue) ?>">
<input type="hidden" data-table="resep_dokter" data-field="x_tgl_input" data-hidden="1" name="fresep_doktergrid$o<?= $Grid->RowIndex ?>_tgl_input" id="fresep_doktergrid$o<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->OldValue) ?>">
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
loadjs.ready(["fresep_doktergrid","load"], function () {
    fresep_doktergrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_resep_dokter", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->id_resep_dokter->Visible) { // id_resep_dokter ?>
        <td data-name="id_resep_dokter">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_resep_dokter_id_resep_dokter" class="form-group resep_dokter_id_resep_dokter"></span>
<?php } else { ?>
<span id="el$rowindex$_resep_dokter_id_resep_dokter" class="form-group resep_dokter_id_resep_dokter">
<span<?= $Grid->id_resep_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_resep_dokter->getDisplayValue($Grid->id_resep_dokter->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_resep_dokter" id="x<?= $Grid->RowIndex ?>_id_resep_dokter" value="<?= HtmlEncode($Grid->id_resep_dokter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_resep_dokter" id="o<?= $Grid->RowIndex ?>_id_resep_dokter" value="<?= HtmlEncode($Grid->id_resep_dokter->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->no_reg->Visible) { // no_reg ?>
        <td data-name="no_reg">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el$rowindex$_resep_dokter_no_reg" class="form-group resep_dokter_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_resep_dokter_no_reg" class="form-group resep_dokter_no_reg">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="resep_dokter" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_resep_dokter_no_reg" class="form-group resep_dokter_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_no_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="resep_dokter" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kode_brng->Visible) { // kode_brng ?>
        <td data-name="kode_brng">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_resep_dokter_kode_brng" class="form-group resep_dokter_kode_brng">
<input type="<?= $Grid->kode_brng->getInputTextType() ?>" data-table="resep_dokter" data-field="x_kode_brng" name="x<?= $Grid->RowIndex ?>_kode_brng" id="x<?= $Grid->RowIndex ?>_kode_brng" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->kode_brng->getPlaceHolder()) ?>" value="<?= $Grid->kode_brng->EditValue ?>"<?= $Grid->kode_brng->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kode_brng->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_resep_dokter_kode_brng" class="form-group resep_dokter_kode_brng">
<span<?= $Grid->kode_brng->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kode_brng->getDisplayValue($Grid->kode_brng->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_kode_brng" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kode_brng" id="x<?= $Grid->RowIndex ?>_kode_brng" value="<?= HtmlEncode($Grid->kode_brng->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="resep_dokter" data-field="x_kode_brng" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kode_brng" id="o<?= $Grid->RowIndex ?>_kode_brng" value="<?= HtmlEncode($Grid->kode_brng->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jml->Visible) { // jml ?>
        <td data-name="jml">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_resep_dokter_jml" class="form-group resep_dokter_jml">
<input type="<?= $Grid->jml->getInputTextType() ?>" data-table="resep_dokter" data-field="x_jml" name="x<?= $Grid->RowIndex ?>_jml" id="x<?= $Grid->RowIndex ?>_jml" size="30" placeholder="<?= HtmlEncode($Grid->jml->getPlaceHolder()) ?>" value="<?= $Grid->jml->EditValue ?>"<?= $Grid->jml->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jml->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_resep_dokter_jml" class="form-group resep_dokter_jml">
<span<?= $Grid->jml->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jml->getDisplayValue($Grid->jml->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_jml" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jml" id="x<?= $Grid->RowIndex ?>_jml" value="<?= HtmlEncode($Grid->jml->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="resep_dokter" data-field="x_jml" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jml" id="o<?= $Grid->RowIndex ?>_jml" value="<?= HtmlEncode($Grid->jml->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->aturan_pakai->Visible) { // aturan_pakai ?>
        <td data-name="aturan_pakai">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_resep_dokter_aturan_pakai" class="form-group resep_dokter_aturan_pakai">
<input type="<?= $Grid->aturan_pakai->getInputTextType() ?>" data-table="resep_dokter" data-field="x_aturan_pakai" name="x<?= $Grid->RowIndex ?>_aturan_pakai" id="x<?= $Grid->RowIndex ?>_aturan_pakai" size="30" maxlength="150" placeholder="<?= HtmlEncode($Grid->aturan_pakai->getPlaceHolder()) ?>" value="<?= $Grid->aturan_pakai->EditValue ?>"<?= $Grid->aturan_pakai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->aturan_pakai->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_resep_dokter_aturan_pakai" class="form-group resep_dokter_aturan_pakai">
<span<?= $Grid->aturan_pakai->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->aturan_pakai->getDisplayValue($Grid->aturan_pakai->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_aturan_pakai" data-hidden="1" name="x<?= $Grid->RowIndex ?>_aturan_pakai" id="x<?= $Grid->RowIndex ?>_aturan_pakai" value="<?= HtmlEncode($Grid->aturan_pakai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="resep_dokter" data-field="x_aturan_pakai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_aturan_pakai" id="o<?= $Grid->RowIndex ?>_aturan_pakai" value="<?= HtmlEncode($Grid->aturan_pakai->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_input->Visible) { // tgl_input ?>
        <td data-name="tgl_input">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_resep_dokter_tgl_input" class="form-group resep_dokter_tgl_input">
<span<?= $Grid->tgl_input->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_input->getDisplayValue($Grid->tgl_input->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_tgl_input" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_input" id="x<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="resep_dokter" data-field="x_tgl_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_input" id="o<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fresep_doktergrid","load"], function() {
    fresep_doktergrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fresep_doktergrid">
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
    ew.addEventHandlers("resep_dokter");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
