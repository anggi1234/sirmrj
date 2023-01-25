<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("KonsulGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkonsulgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fkonsulgrid = new ew.Form("fkonsulgrid", "grid");
    fkonsulgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "konsul")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.konsul)
        ew.vars.tables.konsul = currentTable;
    fkonsulgrid.addFields([
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null, ew.Validators.integer], fields.no_reg.isInvalid],
        ["jenis_konsul", [fields.jenis_konsul.visible && fields.jenis_konsul.required ? ew.Validators.required(fields.jenis_konsul.caption) : null], fields.jenis_konsul.isInvalid],
        ["konsultasi", [fields.konsultasi.visible && fields.konsultasi.required ? ew.Validators.required(fields.konsultasi.caption) : null], fields.konsultasi.isInvalid],
        ["hasil_konsul", [fields.hasil_konsul.visible && fields.hasil_konsul.required ? ew.Validators.required(fields.hasil_konsul.caption) : null], fields.hasil_konsul.isInvalid],
        ["status_konsul", [fields.status_konsul.visible && fields.status_konsul.required ? ew.Validators.required(fields.status_konsul.caption) : null], fields.status_konsul.isInvalid],
        ["tanggal_input", [fields.tanggal_input.visible && fields.tanggal_input.required ? ew.Validators.required(fields.tanggal_input.caption) : null], fields.tanggal_input.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkonsulgrid,
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
    fkonsulgrid.validate = function () {
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
    fkonsulgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_reg", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "jenis_konsul", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "konsultasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "hasil_konsul", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "status_konsul", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fkonsulgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkonsulgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fkonsulgrid.lists.jenis_konsul = <?= $Grid->jenis_konsul->toClientList($Grid) ?>;
    fkonsulgrid.lists.status_konsul = <?= $Grid->status_konsul->toClientList($Grid) ?>;
    loadjs.done("fkonsulgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> konsul">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fkonsulgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_konsul" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_konsulgrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->no_reg->Visible) { // no_reg ?>
        <th data-name="no_reg" class="<?= $Grid->no_reg->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_konsul_no_reg" class="konsul_no_reg"><?= $Grid->renderSort($Grid->no_reg) ?></div></th>
<?php } ?>
<?php if ($Grid->jenis_konsul->Visible) { // jenis_konsul ?>
        <th data-name="jenis_konsul" class="<?= $Grid->jenis_konsul->headerCellClass() ?>"><div id="elh_konsul_jenis_konsul" class="konsul_jenis_konsul"><?= $Grid->renderSort($Grid->jenis_konsul) ?></div></th>
<?php } ?>
<?php if ($Grid->konsultasi->Visible) { // konsultasi ?>
        <th data-name="konsultasi" class="<?= $Grid->konsultasi->headerCellClass() ?>"><div id="elh_konsul_konsultasi" class="konsul_konsultasi"><?= $Grid->renderSort($Grid->konsultasi) ?></div></th>
<?php } ?>
<?php if ($Grid->hasil_konsul->Visible) { // hasil_konsul ?>
        <th data-name="hasil_konsul" class="<?= $Grid->hasil_konsul->headerCellClass() ?>"><div id="elh_konsul_hasil_konsul" class="konsul_hasil_konsul"><?= $Grid->renderSort($Grid->hasil_konsul) ?></div></th>
<?php } ?>
<?php if ($Grid->status_konsul->Visible) { // status_konsul ?>
        <th data-name="status_konsul" class="<?= $Grid->status_konsul->headerCellClass() ?>"><div id="elh_konsul_status_konsul" class="konsul_status_konsul"><?= $Grid->renderSort($Grid->status_konsul) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggal_input->Visible) { // tanggal_input ?>
        <th data-name="tanggal_input" class="<?= $Grid->tanggal_input->headerCellClass() ?>"><div id="elh_konsul_tanggal_input" class="konsul_tanggal_input"><?= $Grid->renderSort($Grid->tanggal_input) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_konsul", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->no_reg->Visible) { // no_reg ?>
        <td data-name="no_reg" <?= $Grid->no_reg->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_konsul_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_konsul_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="konsul" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="konsul" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_konsul_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_konsul_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="konsul" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<?= $Grid->no_reg->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="konsul" data-field="x_no_reg" data-hidden="1" name="fkonsulgrid$x<?= $Grid->RowIndex ?>_no_reg" id="fkonsulgrid$x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<input type="hidden" data-table="konsul" data-field="x_no_reg" data-hidden="1" name="fkonsulgrid$o<?= $Grid->RowIndex ?>_no_reg" id="fkonsulgrid$o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jenis_konsul->Visible) { // jenis_konsul ?>
        <td data-name="jenis_konsul" <?= $Grid->jenis_konsul->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_jenis_konsul" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_jenis_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_jenis_konsul" name="x<?= $Grid->RowIndex ?>_jenis_konsul" id="x<?= $Grid->RowIndex ?>_jenis_konsul"<?= $Grid->jenis_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_jenis_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_jenis_konsul"
    name="x<?= $Grid->RowIndex ?>_jenis_konsul"
    value="<?= HtmlEncode($Grid->jenis_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_jenis_konsul"
    data-target="dsl_x<?= $Grid->RowIndex ?>_jenis_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->jenis_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_jenis_konsul"
    data-value-separator="<?= $Grid->jenis_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Grid->jenis_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jenis_konsul->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="konsul" data-field="x_jenis_konsul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jenis_konsul" id="o<?= $Grid->RowIndex ?>_jenis_konsul" value="<?= HtmlEncode($Grid->jenis_konsul->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_jenis_konsul" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_jenis_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_jenis_konsul" name="x<?= $Grid->RowIndex ?>_jenis_konsul" id="x<?= $Grid->RowIndex ?>_jenis_konsul"<?= $Grid->jenis_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_jenis_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_jenis_konsul"
    name="x<?= $Grid->RowIndex ?>_jenis_konsul"
    value="<?= HtmlEncode($Grid->jenis_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_jenis_konsul"
    data-target="dsl_x<?= $Grid->RowIndex ?>_jenis_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->jenis_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_jenis_konsul"
    data-value-separator="<?= $Grid->jenis_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Grid->jenis_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jenis_konsul->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_jenis_konsul">
<span<?= $Grid->jenis_konsul->viewAttributes() ?>>
<?= $Grid->jenis_konsul->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="konsul" data-field="x_jenis_konsul" data-hidden="1" name="fkonsulgrid$x<?= $Grid->RowIndex ?>_jenis_konsul" id="fkonsulgrid$x<?= $Grid->RowIndex ?>_jenis_konsul" value="<?= HtmlEncode($Grid->jenis_konsul->FormValue) ?>">
<input type="hidden" data-table="konsul" data-field="x_jenis_konsul" data-hidden="1" name="fkonsulgrid$o<?= $Grid->RowIndex ?>_jenis_konsul" id="fkonsulgrid$o<?= $Grid->RowIndex ?>_jenis_konsul" value="<?= HtmlEncode($Grid->jenis_konsul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->konsultasi->Visible) { // konsultasi ?>
        <td data-name="konsultasi" <?= $Grid->konsultasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_konsultasi" class="form-group">
<input type="<?= $Grid->konsultasi->getInputTextType() ?>" data-table="konsul" data-field="x_konsultasi" name="x<?= $Grid->RowIndex ?>_konsultasi" id="x<?= $Grid->RowIndex ?>_konsultasi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->konsultasi->getPlaceHolder()) ?>" value="<?= $Grid->konsultasi->EditValue ?>"<?= $Grid->konsultasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->konsultasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="konsul" data-field="x_konsultasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_konsultasi" id="o<?= $Grid->RowIndex ?>_konsultasi" value="<?= HtmlEncode($Grid->konsultasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_konsultasi" class="form-group">
<input type="<?= $Grid->konsultasi->getInputTextType() ?>" data-table="konsul" data-field="x_konsultasi" name="x<?= $Grid->RowIndex ?>_konsultasi" id="x<?= $Grid->RowIndex ?>_konsultasi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->konsultasi->getPlaceHolder()) ?>" value="<?= $Grid->konsultasi->EditValue ?>"<?= $Grid->konsultasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->konsultasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_konsultasi">
<span<?= $Grid->konsultasi->viewAttributes() ?>>
<?= $Grid->konsultasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="konsul" data-field="x_konsultasi" data-hidden="1" name="fkonsulgrid$x<?= $Grid->RowIndex ?>_konsultasi" id="fkonsulgrid$x<?= $Grid->RowIndex ?>_konsultasi" value="<?= HtmlEncode($Grid->konsultasi->FormValue) ?>">
<input type="hidden" data-table="konsul" data-field="x_konsultasi" data-hidden="1" name="fkonsulgrid$o<?= $Grid->RowIndex ?>_konsultasi" id="fkonsulgrid$o<?= $Grid->RowIndex ?>_konsultasi" value="<?= HtmlEncode($Grid->konsultasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->hasil_konsul->Visible) { // hasil_konsul ?>
        <td data-name="hasil_konsul" <?= $Grid->hasil_konsul->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_hasil_konsul" class="form-group">
<input type="<?= $Grid->hasil_konsul->getInputTextType() ?>" data-table="konsul" data-field="x_hasil_konsul" name="x<?= $Grid->RowIndex ?>_hasil_konsul" id="x<?= $Grid->RowIndex ?>_hasil_konsul" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->hasil_konsul->getPlaceHolder()) ?>" value="<?= $Grid->hasil_konsul->EditValue ?>"<?= $Grid->hasil_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil_konsul->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="konsul" data-field="x_hasil_konsul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hasil_konsul" id="o<?= $Grid->RowIndex ?>_hasil_konsul" value="<?= HtmlEncode($Grid->hasil_konsul->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_hasil_konsul" class="form-group">
<input type="<?= $Grid->hasil_konsul->getInputTextType() ?>" data-table="konsul" data-field="x_hasil_konsul" name="x<?= $Grid->RowIndex ?>_hasil_konsul" id="x<?= $Grid->RowIndex ?>_hasil_konsul" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->hasil_konsul->getPlaceHolder()) ?>" value="<?= $Grid->hasil_konsul->EditValue ?>"<?= $Grid->hasil_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil_konsul->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_hasil_konsul">
<span<?= $Grid->hasil_konsul->viewAttributes() ?>>
<?= $Grid->hasil_konsul->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="konsul" data-field="x_hasil_konsul" data-hidden="1" name="fkonsulgrid$x<?= $Grid->RowIndex ?>_hasil_konsul" id="fkonsulgrid$x<?= $Grid->RowIndex ?>_hasil_konsul" value="<?= HtmlEncode($Grid->hasil_konsul->FormValue) ?>">
<input type="hidden" data-table="konsul" data-field="x_hasil_konsul" data-hidden="1" name="fkonsulgrid$o<?= $Grid->RowIndex ?>_hasil_konsul" id="fkonsulgrid$o<?= $Grid->RowIndex ?>_hasil_konsul" value="<?= HtmlEncode($Grid->hasil_konsul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status_konsul->Visible) { // status_konsul ?>
        <td data-name="status_konsul" <?= $Grid->status_konsul->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_status_konsul" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_status_konsul" name="x<?= $Grid->RowIndex ?>_status_konsul" id="x<?= $Grid->RowIndex ?>_status_konsul"<?= $Grid->status_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status_konsul"
    name="x<?= $Grid->RowIndex ?>_status_konsul"
    value="<?= HtmlEncode($Grid->status_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status_konsul"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_status_konsul"
    data-value-separator="<?= $Grid->status_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status_konsul->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="konsul" data-field="x_status_konsul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status_konsul" id="o<?= $Grid->RowIndex ?>_status_konsul" value="<?= HtmlEncode($Grid->status_konsul->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_status_konsul" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_status_konsul" name="x<?= $Grid->RowIndex ?>_status_konsul" id="x<?= $Grid->RowIndex ?>_status_konsul"<?= $Grid->status_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status_konsul"
    name="x<?= $Grid->RowIndex ?>_status_konsul"
    value="<?= HtmlEncode($Grid->status_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status_konsul"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_status_konsul"
    data-value-separator="<?= $Grid->status_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status_konsul->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_status_konsul">
<span<?= $Grid->status_konsul->viewAttributes() ?>>
<?= $Grid->status_konsul->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="konsul" data-field="x_status_konsul" data-hidden="1" name="fkonsulgrid$x<?= $Grid->RowIndex ?>_status_konsul" id="fkonsulgrid$x<?= $Grid->RowIndex ?>_status_konsul" value="<?= HtmlEncode($Grid->status_konsul->FormValue) ?>">
<input type="hidden" data-table="konsul" data-field="x_status_konsul" data-hidden="1" name="fkonsulgrid$o<?= $Grid->RowIndex ?>_status_konsul" id="fkonsulgrid$o<?= $Grid->RowIndex ?>_status_konsul" value="<?= HtmlEncode($Grid->status_konsul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggal_input->Visible) { // tanggal_input ?>
        <td data-name="tanggal_input" <?= $Grid->tanggal_input->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="konsul" data-field="x_tanggal_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal_input" id="o<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_konsul_tanggal_input">
<span<?= $Grid->tanggal_input->viewAttributes() ?>>
<?= $Grid->tanggal_input->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="konsul" data-field="x_tanggal_input" data-hidden="1" name="fkonsulgrid$x<?= $Grid->RowIndex ?>_tanggal_input" id="fkonsulgrid$x<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->FormValue) ?>">
<input type="hidden" data-table="konsul" data-field="x_tanggal_input" data-hidden="1" name="fkonsulgrid$o<?= $Grid->RowIndex ?>_tanggal_input" id="fkonsulgrid$o<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->OldValue) ?>">
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
loadjs.ready(["fkonsulgrid","load"], function () {
    fkonsulgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_konsul", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->no_reg->Visible) { // no_reg ?>
        <td data-name="no_reg">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el$rowindex$_konsul_no_reg" class="form-group konsul_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_konsul_no_reg" class="form-group konsul_no_reg">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="konsul" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_konsul_no_reg" class="form-group konsul_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="konsul" data-field="x_no_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="konsul" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jenis_konsul->Visible) { // jenis_konsul ?>
        <td data-name="jenis_konsul">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_konsul_jenis_konsul" class="form-group konsul_jenis_konsul">
<template id="tp_x<?= $Grid->RowIndex ?>_jenis_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_jenis_konsul" name="x<?= $Grid->RowIndex ?>_jenis_konsul" id="x<?= $Grid->RowIndex ?>_jenis_konsul"<?= $Grid->jenis_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_jenis_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_jenis_konsul"
    name="x<?= $Grid->RowIndex ?>_jenis_konsul"
    value="<?= HtmlEncode($Grid->jenis_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_jenis_konsul"
    data-target="dsl_x<?= $Grid->RowIndex ?>_jenis_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->jenis_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_jenis_konsul"
    data-value-separator="<?= $Grid->jenis_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Grid->jenis_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jenis_konsul->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_konsul_jenis_konsul" class="form-group konsul_jenis_konsul">
<span<?= $Grid->jenis_konsul->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jenis_konsul->getDisplayValue($Grid->jenis_konsul->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="konsul" data-field="x_jenis_konsul" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jenis_konsul" id="x<?= $Grid->RowIndex ?>_jenis_konsul" value="<?= HtmlEncode($Grid->jenis_konsul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="konsul" data-field="x_jenis_konsul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jenis_konsul" id="o<?= $Grid->RowIndex ?>_jenis_konsul" value="<?= HtmlEncode($Grid->jenis_konsul->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->konsultasi->Visible) { // konsultasi ?>
        <td data-name="konsultasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_konsul_konsultasi" class="form-group konsul_konsultasi">
<input type="<?= $Grid->konsultasi->getInputTextType() ?>" data-table="konsul" data-field="x_konsultasi" name="x<?= $Grid->RowIndex ?>_konsultasi" id="x<?= $Grid->RowIndex ?>_konsultasi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->konsultasi->getPlaceHolder()) ?>" value="<?= $Grid->konsultasi->EditValue ?>"<?= $Grid->konsultasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->konsultasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_konsul_konsultasi" class="form-group konsul_konsultasi">
<span<?= $Grid->konsultasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->konsultasi->getDisplayValue($Grid->konsultasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="konsul" data-field="x_konsultasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_konsultasi" id="x<?= $Grid->RowIndex ?>_konsultasi" value="<?= HtmlEncode($Grid->konsultasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="konsul" data-field="x_konsultasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_konsultasi" id="o<?= $Grid->RowIndex ?>_konsultasi" value="<?= HtmlEncode($Grid->konsultasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->hasil_konsul->Visible) { // hasil_konsul ?>
        <td data-name="hasil_konsul">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_konsul_hasil_konsul" class="form-group konsul_hasil_konsul">
<input type="<?= $Grid->hasil_konsul->getInputTextType() ?>" data-table="konsul" data-field="x_hasil_konsul" name="x<?= $Grid->RowIndex ?>_hasil_konsul" id="x<?= $Grid->RowIndex ?>_hasil_konsul" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->hasil_konsul->getPlaceHolder()) ?>" value="<?= $Grid->hasil_konsul->EditValue ?>"<?= $Grid->hasil_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil_konsul->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_konsul_hasil_konsul" class="form-group konsul_hasil_konsul">
<span<?= $Grid->hasil_konsul->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->hasil_konsul->getDisplayValue($Grid->hasil_konsul->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="konsul" data-field="x_hasil_konsul" data-hidden="1" name="x<?= $Grid->RowIndex ?>_hasil_konsul" id="x<?= $Grid->RowIndex ?>_hasil_konsul" value="<?= HtmlEncode($Grid->hasil_konsul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="konsul" data-field="x_hasil_konsul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hasil_konsul" id="o<?= $Grid->RowIndex ?>_hasil_konsul" value="<?= HtmlEncode($Grid->hasil_konsul->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->status_konsul->Visible) { // status_konsul ?>
        <td data-name="status_konsul">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_konsul_status_konsul" class="form-group konsul_status_konsul">
<template id="tp_x<?= $Grid->RowIndex ?>_status_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_status_konsul" name="x<?= $Grid->RowIndex ?>_status_konsul" id="x<?= $Grid->RowIndex ?>_status_konsul"<?= $Grid->status_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_status_konsul"
    name="x<?= $Grid->RowIndex ?>_status_konsul"
    value="<?= HtmlEncode($Grid->status_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status_konsul"
    data-target="dsl_x<?= $Grid->RowIndex ?>_status_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_status_konsul"
    data-value-separator="<?= $Grid->status_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status_konsul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status_konsul->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_konsul_status_konsul" class="form-group konsul_status_konsul">
<span<?= $Grid->status_konsul->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->status_konsul->getDisplayValue($Grid->status_konsul->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="konsul" data-field="x_status_konsul" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status_konsul" id="x<?= $Grid->RowIndex ?>_status_konsul" value="<?= HtmlEncode($Grid->status_konsul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="konsul" data-field="x_status_konsul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status_konsul" id="o<?= $Grid->RowIndex ?>_status_konsul" value="<?= HtmlEncode($Grid->status_konsul->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggal_input->Visible) { // tanggal_input ?>
        <td data-name="tanggal_input">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_konsul_tanggal_input" class="form-group konsul_tanggal_input">
<span<?= $Grid->tanggal_input->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggal_input->getDisplayValue($Grid->tanggal_input->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="konsul" data-field="x_tanggal_input" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggal_input" id="x<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="konsul" data-field="x_tanggal_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal_input" id="o<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fkonsulgrid","load"], function() {
    fkonsulgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fkonsulgrid">
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
    ew.addEventHandlers("konsul");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
