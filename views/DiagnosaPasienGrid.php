<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("DiagnosaPasienGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdiagnosa_pasiengrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fdiagnosa_pasiengrid = new ew.Form("fdiagnosa_pasiengrid", "grid");
    fdiagnosa_pasiengrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "diagnosa_pasien")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.diagnosa_pasien)
        ew.vars.tables.diagnosa_pasien = currentTable;
    fdiagnosa_pasiengrid.addFields([
        ["kd_penyakit", [fields.kd_penyakit.visible && fields.kd_penyakit.required ? ew.Validators.required(fields.kd_penyakit.caption) : null], fields.kd_penyakit.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["prioritas", [fields.prioritas.visible && fields.prioritas.required ? ew.Validators.required(fields.prioritas.caption) : null, ew.Validators.integer], fields.prioritas.isInvalid],
        ["status_penyakit", [fields.status_penyakit.visible && fields.status_penyakit.required ? ew.Validators.required(fields.status_penyakit.caption) : null], fields.status_penyakit.isInvalid],
        ["kd_icd9", [fields.kd_icd9.visible && fields.kd_icd9.required ? ew.Validators.required(fields.kd_icd9.caption) : null], fields.kd_icd9.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdiagnosa_pasiengrid,
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
    fdiagnosa_pasiengrid.validate = function () {
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
    fdiagnosa_pasiengrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "kd_penyakit", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "status", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "prioritas", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "status_penyakit", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_icd9", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fdiagnosa_pasiengrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdiagnosa_pasiengrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdiagnosa_pasiengrid.lists.kd_penyakit = <?= $Grid->kd_penyakit->toClientList($Grid) ?>;
    fdiagnosa_pasiengrid.lists.status = <?= $Grid->status->toClientList($Grid) ?>;
    fdiagnosa_pasiengrid.lists.status_penyakit = <?= $Grid->status_penyakit->toClientList($Grid) ?>;
    fdiagnosa_pasiengrid.lists.kd_icd9 = <?= $Grid->kd_icd9->toClientList($Grid) ?>;
    loadjs.done("fdiagnosa_pasiengrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> diagnosa_pasien">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdiagnosa_pasiengrid" class="ew-form ew-list-form form-inline">
<div id="gmp_diagnosa_pasien" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_diagnosa_pasiengrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->kd_penyakit->Visible) { // kd_penyakit ?>
        <th data-name="kd_penyakit" class="<?= $Grid->kd_penyakit->headerCellClass() ?>"><div id="elh_diagnosa_pasien_kd_penyakit" class="diagnosa_pasien_kd_penyakit"><?= $Grid->renderSort($Grid->kd_penyakit) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_diagnosa_pasien_status" class="diagnosa_pasien_status"><?= $Grid->renderSort($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->prioritas->Visible) { // prioritas ?>
        <th data-name="prioritas" class="<?= $Grid->prioritas->headerCellClass() ?>"><div id="elh_diagnosa_pasien_prioritas" class="diagnosa_pasien_prioritas"><?= $Grid->renderSort($Grid->prioritas) ?></div></th>
<?php } ?>
<?php if ($Grid->status_penyakit->Visible) { // status_penyakit ?>
        <th data-name="status_penyakit" class="<?= $Grid->status_penyakit->headerCellClass() ?>"><div id="elh_diagnosa_pasien_status_penyakit" class="diagnosa_pasien_status_penyakit"><?= $Grid->renderSort($Grid->status_penyakit) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_icd9->Visible) { // kd_icd9 ?>
        <th data-name="kd_icd9" class="<?= $Grid->kd_icd9->headerCellClass() ?>"><div id="elh_diagnosa_pasien_kd_icd9" class="diagnosa_pasien_kd_icd9"><?= $Grid->renderSort($Grid->kd_icd9) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_diagnosa_pasien", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->kd_penyakit->Visible) { // kd_penyakit ?>
        <td data-name="kd_penyakit" <?= $Grid->kd_penyakit->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_kd_penyakit" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_penyakit"><?= EmptyValue(strval($Grid->kd_penyakit->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_penyakit->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_penyakit->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_penyakit->ReadOnly || $Grid->kd_penyakit->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_penyakit',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_penyakit->getErrorMessage() ?></div>
<?= $Grid->kd_penyakit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_penyakit") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_penyakit->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= $Grid->kd_penyakit->CurrentValue ?>"<?= $Grid->kd_penyakit->editAttributes() ?>>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_penyakit" id="o<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_kd_penyakit" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_penyakit"><?= EmptyValue(strval($Grid->kd_penyakit->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_penyakit->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_penyakit->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_penyakit->ReadOnly || $Grid->kd_penyakit->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_penyakit',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_penyakit->getErrorMessage() ?></div>
<?= $Grid->kd_penyakit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_penyakit") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_penyakit->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= $Grid->kd_penyakit->CurrentValue ?>"<?= $Grid->kd_penyakit->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_kd_penyakit">
<span<?= $Grid->kd_penyakit->viewAttributes() ?>>
<?= $Grid->kd_penyakit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-hidden="1" name="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_kd_penyakit" id="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->FormValue) ?>">
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-hidden="1" name="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_kd_penyakit" id="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status" <?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_status" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status"
    name="x<?= $Grid->RowIndex ?>_status"
    value="<?= HtmlEncode($Grid->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_status" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status"
    name="x<?= $Grid->RowIndex ?>_status"
    value="<?= HtmlEncode($Grid->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status" data-hidden="1" name="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_status" id="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status" data-hidden="1" name="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_status" id="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->prioritas->Visible) { // prioritas ?>
        <td data-name="prioritas" <?= $Grid->prioritas->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_prioritas" class="form-group">
<input type="<?= $Grid->prioritas->getInputTextType() ?>" data-table="diagnosa_pasien" data-field="x_prioritas" name="x<?= $Grid->RowIndex ?>_prioritas" id="x<?= $Grid->RowIndex ?>_prioritas" size="30" placeholder="<?= HtmlEncode($Grid->prioritas->getPlaceHolder()) ?>" value="<?= $Grid->prioritas->EditValue ?>"<?= $Grid->prioritas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prioritas->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_prioritas" data-hidden="1" name="o<?= $Grid->RowIndex ?>_prioritas" id="o<?= $Grid->RowIndex ?>_prioritas" value="<?= HtmlEncode($Grid->prioritas->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_prioritas" class="form-group">
<input type="<?= $Grid->prioritas->getInputTextType() ?>" data-table="diagnosa_pasien" data-field="x_prioritas" name="x<?= $Grid->RowIndex ?>_prioritas" id="x<?= $Grid->RowIndex ?>_prioritas" size="30" placeholder="<?= HtmlEncode($Grid->prioritas->getPlaceHolder()) ?>" value="<?= $Grid->prioritas->EditValue ?>"<?= $Grid->prioritas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prioritas->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_prioritas">
<span<?= $Grid->prioritas->viewAttributes() ?>>
<?= $Grid->prioritas->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_prioritas" data-hidden="1" name="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_prioritas" id="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_prioritas" value="<?= HtmlEncode($Grid->prioritas->FormValue) ?>">
<input type="hidden" data-table="diagnosa_pasien" data-field="x_prioritas" data-hidden="1" name="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_prioritas" id="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_prioritas" value="<?= HtmlEncode($Grid->prioritas->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status_penyakit->Visible) { // status_penyakit ?>
        <td data-name="status_penyakit" <?= $Grid->status_penyakit->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_status_penyakit" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status_penyakit">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status_penyakit" name="x<?= $Grid->RowIndex ?>_status_penyakit" id="x<?= $Grid->RowIndex ?>_status_penyakit"<?= $Grid->status_penyakit->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status_penyakit" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status_penyakit"
    name="x<?= $Grid->RowIndex ?>_status_penyakit"
    value="<?= HtmlEncode($Grid->status_penyakit->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status_penyakit"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status_penyakit"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status_penyakit->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status_penyakit"
    data-value-separator="<?= $Grid->status_penyakit->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status_penyakit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status_penyakit->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status_penyakit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status_penyakit" id="o<?= $Grid->RowIndex ?>_status_penyakit" value="<?= HtmlEncode($Grid->status_penyakit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_status_penyakit" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status_penyakit">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status_penyakit" name="x<?= $Grid->RowIndex ?>_status_penyakit" id="x<?= $Grid->RowIndex ?>_status_penyakit"<?= $Grid->status_penyakit->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status_penyakit" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status_penyakit"
    name="x<?= $Grid->RowIndex ?>_status_penyakit"
    value="<?= HtmlEncode($Grid->status_penyakit->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status_penyakit"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status_penyakit"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status_penyakit->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status_penyakit"
    data-value-separator="<?= $Grid->status_penyakit->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status_penyakit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status_penyakit->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_status_penyakit">
<span<?= $Grid->status_penyakit->viewAttributes() ?>>
<?= $Grid->status_penyakit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status_penyakit" data-hidden="1" name="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_status_penyakit" id="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_status_penyakit" value="<?= HtmlEncode($Grid->status_penyakit->FormValue) ?>">
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status_penyakit" data-hidden="1" name="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_status_penyakit" id="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_status_penyakit" value="<?= HtmlEncode($Grid->status_penyakit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_icd9->Visible) { // kd_icd9 ?>
        <td data-name="kd_icd9" <?= $Grid->kd_icd9->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_kd_icd9" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_icd9"><?= EmptyValue(strval($Grid->kd_icd9->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_icd9->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_icd9->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_icd9->ReadOnly || $Grid->kd_icd9->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_icd9',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_icd9->getErrorMessage() ?></div>
<?= $Grid->kd_icd9->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_icd9") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_icd9->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= $Grid->kd_icd9->CurrentValue ?>"<?= $Grid->kd_icd9->editAttributes() ?>>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_icd9" id="o<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_kd_icd9" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_icd9"><?= EmptyValue(strval($Grid->kd_icd9->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_icd9->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_icd9->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_icd9->ReadOnly || $Grid->kd_icd9->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_icd9',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_icd9->getErrorMessage() ?></div>
<?= $Grid->kd_icd9->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_icd9") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_icd9->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= $Grid->kd_icd9->CurrentValue ?>"<?= $Grid->kd_icd9->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_diagnosa_pasien_kd_icd9">
<span<?= $Grid->kd_icd9->viewAttributes() ?>>
<?= $Grid->kd_icd9->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-hidden="1" name="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_kd_icd9" id="fdiagnosa_pasiengrid$x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->FormValue) ?>">
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-hidden="1" name="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_kd_icd9" id="fdiagnosa_pasiengrid$o<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->OldValue) ?>">
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
loadjs.ready(["fdiagnosa_pasiengrid","load"], function () {
    fdiagnosa_pasiengrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_diagnosa_pasien", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->kd_penyakit->Visible) { // kd_penyakit ?>
        <td data-name="kd_penyakit">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_diagnosa_pasien_kd_penyakit" class="form-group diagnosa_pasien_kd_penyakit">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_penyakit"><?= EmptyValue(strval($Grid->kd_penyakit->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_penyakit->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_penyakit->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_penyakit->ReadOnly || $Grid->kd_penyakit->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_penyakit',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_penyakit->getErrorMessage() ?></div>
<?= $Grid->kd_penyakit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_penyakit") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_penyakit->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= $Grid->kd_penyakit->CurrentValue ?>"<?= $Grid->kd_penyakit->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_diagnosa_pasien_kd_penyakit" class="form-group diagnosa_pasien_kd_penyakit">
<span<?= $Grid->kd_penyakit->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_penyakit->getDisplayValue($Grid->kd_penyakit->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_penyakit" id="o<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_diagnosa_pasien_status" class="form-group diagnosa_pasien_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status"
    name="x<?= $Grid->RowIndex ?>_status"
    value="<?= HtmlEncode($Grid->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_diagnosa_pasien_status" class="form-group diagnosa_pasien_status">
<span<?= $Grid->status->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->status->getDisplayValue($Grid->status->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->prioritas->Visible) { // prioritas ?>
        <td data-name="prioritas">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_diagnosa_pasien_prioritas" class="form-group diagnosa_pasien_prioritas">
<input type="<?= $Grid->prioritas->getInputTextType() ?>" data-table="diagnosa_pasien" data-field="x_prioritas" name="x<?= $Grid->RowIndex ?>_prioritas" id="x<?= $Grid->RowIndex ?>_prioritas" size="30" placeholder="<?= HtmlEncode($Grid->prioritas->getPlaceHolder()) ?>" value="<?= $Grid->prioritas->EditValue ?>"<?= $Grid->prioritas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prioritas->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_diagnosa_pasien_prioritas" class="form-group diagnosa_pasien_prioritas">
<span<?= $Grid->prioritas->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->prioritas->getDisplayValue($Grid->prioritas->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_prioritas" data-hidden="1" name="x<?= $Grid->RowIndex ?>_prioritas" id="x<?= $Grid->RowIndex ?>_prioritas" value="<?= HtmlEncode($Grid->prioritas->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_prioritas" data-hidden="1" name="o<?= $Grid->RowIndex ?>_prioritas" id="o<?= $Grid->RowIndex ?>_prioritas" value="<?= HtmlEncode($Grid->prioritas->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->status_penyakit->Visible) { // status_penyakit ?>
        <td data-name="status_penyakit">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_diagnosa_pasien_status_penyakit" class="form-group diagnosa_pasien_status_penyakit">
<template id="tp_x<?= $Grid->RowIndex ?>_status_penyakit">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status_penyakit" name="x<?= $Grid->RowIndex ?>_status_penyakit" id="x<?= $Grid->RowIndex ?>_status_penyakit"<?= $Grid->status_penyakit->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status_penyakit" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status_penyakit"
    name="x<?= $Grid->RowIndex ?>_status_penyakit"
    value="<?= HtmlEncode($Grid->status_penyakit->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status_penyakit"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status_penyakit"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status_penyakit->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status_penyakit"
    data-value-separator="<?= $Grid->status_penyakit->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status_penyakit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status_penyakit->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_diagnosa_pasien_status_penyakit" class="form-group diagnosa_pasien_status_penyakit">
<span<?= $Grid->status_penyakit->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->status_penyakit->getDisplayValue($Grid->status_penyakit->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status_penyakit" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status_penyakit" id="x<?= $Grid->RowIndex ?>_status_penyakit" value="<?= HtmlEncode($Grid->status_penyakit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_status_penyakit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status_penyakit" id="o<?= $Grid->RowIndex ?>_status_penyakit" value="<?= HtmlEncode($Grid->status_penyakit->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_icd9->Visible) { // kd_icd9 ?>
        <td data-name="kd_icd9">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_diagnosa_pasien_kd_icd9" class="form-group diagnosa_pasien_kd_icd9">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_icd9"><?= EmptyValue(strval($Grid->kd_icd9->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_icd9->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_icd9->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_icd9->ReadOnly || $Grid->kd_icd9->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_icd9',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_icd9->getErrorMessage() ?></div>
<?= $Grid->kd_icd9->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_icd9") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_icd9->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= $Grid->kd_icd9->CurrentValue ?>"<?= $Grid->kd_icd9->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_diagnosa_pasien_kd_icd9" class="form-group diagnosa_pasien_kd_icd9">
<span<?= $Grid->kd_icd9->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_icd9->getDisplayValue($Grid->kd_icd9->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_icd9" id="o<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fdiagnosa_pasiengrid","load"], function() {
    fdiagnosa_pasiengrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fdiagnosa_pasiengrid">
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
    ew.addEventHandlers("diagnosa_pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
