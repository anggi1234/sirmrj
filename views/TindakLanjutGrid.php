<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("TindakLanjutGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftindak_lanjutgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    ftindak_lanjutgrid = new ew.Form("ftindak_lanjutgrid", "grid");
    ftindak_lanjutgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "tindak_lanjut")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.tindak_lanjut)
        ew.vars.tables.tindak_lanjut = currentTable;
    ftindak_lanjutgrid.addFields([
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null], fields.no_reg.isInvalid],
        ["tindak_lanjut", [fields.tindak_lanjut.visible && fields.tindak_lanjut.required ? ew.Validators.required(fields.tindak_lanjut.caption) : null], fields.tindak_lanjut.isInvalid],
        ["no_kontrol", [fields.no_kontrol.visible && fields.no_kontrol.required ? ew.Validators.required(fields.no_kontrol.caption) : null], fields.no_kontrol.isInvalid],
        ["tgl_input", [fields.tgl_input.visible && fields.tgl_input.required ? ew.Validators.required(fields.tgl_input.caption) : null], fields.tgl_input.isInvalid],
        ["tgl_kontrol", [fields.tgl_kontrol.visible && fields.tgl_kontrol.required ? ew.Validators.required(fields.tgl_kontrol.caption) : null, ew.Validators.datetime(7)], fields.tgl_kontrol.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftindak_lanjutgrid,
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
    ftindak_lanjutgrid.validate = function () {
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
    ftindak_lanjutgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_reg", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tindak_lanjut", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "no_kontrol", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tgl_kontrol", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    ftindak_lanjutgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftindak_lanjutgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    ftindak_lanjutgrid.lists.tindak_lanjut = <?= $Grid->tindak_lanjut->toClientList($Grid) ?>;
    loadjs.done("ftindak_lanjutgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tindak_lanjut">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftindak_lanjutgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tindak_lanjut" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_tindak_lanjutgrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_reg" class="<?= $Grid->no_reg->headerCellClass() ?>"><div id="elh_tindak_lanjut_no_reg" class="tindak_lanjut_no_reg"><?= $Grid->renderSort($Grid->no_reg) ?></div></th>
<?php } ?>
<?php if ($Grid->tindak_lanjut->Visible) { // tindak_lanjut ?>
        <th data-name="tindak_lanjut" class="<?= $Grid->tindak_lanjut->headerCellClass() ?>"><div id="elh_tindak_lanjut_tindak_lanjut" class="tindak_lanjut_tindak_lanjut"><?= $Grid->renderSort($Grid->tindak_lanjut) ?></div></th>
<?php } ?>
<?php if ($Grid->no_kontrol->Visible) { // no_kontrol ?>
        <th data-name="no_kontrol" class="<?= $Grid->no_kontrol->headerCellClass() ?>"><div id="elh_tindak_lanjut_no_kontrol" class="tindak_lanjut_no_kontrol"><?= $Grid->renderSort($Grid->no_kontrol) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_input->Visible) { // tgl_input ?>
        <th data-name="tgl_input" class="<?= $Grid->tgl_input->headerCellClass() ?>"><div id="elh_tindak_lanjut_tgl_input" class="tindak_lanjut_tgl_input"><?= $Grid->renderSort($Grid->tgl_input) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <th data-name="tgl_kontrol" class="<?= $Grid->tgl_kontrol->headerCellClass() ?>"><div id="elh_tindak_lanjut_tgl_kontrol" class="tindak_lanjut_tgl_kontrol"><?= $Grid->renderSort($Grid->tgl_kontrol) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_tindak_lanjut", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<?= $Grid->no_reg->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_reg" data-hidden="1" name="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_no_reg" id="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_reg" data-hidden="1" name="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_no_reg" id="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tindak_lanjut->Visible) { // tindak_lanjut ?>
        <td data-name="tindak_lanjut" <?= $Grid->tindak_lanjut->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_tindak_lanjut" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_tindak_lanjut">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="tindak_lanjut" data-field="x_tindak_lanjut" name="x<?= $Grid->RowIndex ?>_tindak_lanjut" id="x<?= $Grid->RowIndex ?>_tindak_lanjut"<?= $Grid->tindak_lanjut->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tindak_lanjut" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tindak_lanjut"
    name="x<?= $Grid->RowIndex ?>_tindak_lanjut"
    value="<?= HtmlEncode($Grid->tindak_lanjut->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tindak_lanjut"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tindak_lanjut"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tindak_lanjut->isInvalidClass() ?>"
    data-table="tindak_lanjut"
    data-field="x_tindak_lanjut"
    data-value-separator="<?= $Grid->tindak_lanjut->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tindak_lanjut->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tindak_lanjut->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tindak_lanjut" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tindak_lanjut" id="o<?= $Grid->RowIndex ?>_tindak_lanjut" value="<?= HtmlEncode($Grid->tindak_lanjut->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_tindak_lanjut" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_tindak_lanjut">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="tindak_lanjut" data-field="x_tindak_lanjut" name="x<?= $Grid->RowIndex ?>_tindak_lanjut" id="x<?= $Grid->RowIndex ?>_tindak_lanjut"<?= $Grid->tindak_lanjut->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tindak_lanjut" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tindak_lanjut"
    name="x<?= $Grid->RowIndex ?>_tindak_lanjut"
    value="<?= HtmlEncode($Grid->tindak_lanjut->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tindak_lanjut"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tindak_lanjut"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tindak_lanjut->isInvalidClass() ?>"
    data-table="tindak_lanjut"
    data-field="x_tindak_lanjut"
    data-value-separator="<?= $Grid->tindak_lanjut->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tindak_lanjut->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tindak_lanjut->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_tindak_lanjut">
<span<?= $Grid->tindak_lanjut->viewAttributes() ?>>
<?= $Grid->tindak_lanjut->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tindak_lanjut" data-hidden="1" name="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_tindak_lanjut" id="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_tindak_lanjut" value="<?= HtmlEncode($Grid->tindak_lanjut->FormValue) ?>">
<input type="hidden" data-table="tindak_lanjut" data-field="x_tindak_lanjut" data-hidden="1" name="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_tindak_lanjut" id="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_tindak_lanjut" value="<?= HtmlEncode($Grid->tindak_lanjut->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->no_kontrol->Visible) { // no_kontrol ?>
        <td data-name="no_kontrol" <?= $Grid->no_kontrol->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_kontrol" class="form-group">
<input type="<?= $Grid->no_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_no_kontrol" name="x<?= $Grid->RowIndex ?>_no_kontrol" id="x<?= $Grid->RowIndex ?>_no_kontrol" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->no_kontrol->getPlaceHolder()) ?>" value="<?= $Grid->no_kontrol->EditValue ?>"<?= $Grid->no_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_kontrol->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_kontrol" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_kontrol" id="o<?= $Grid->RowIndex ?>_no_kontrol" value="<?= HtmlEncode($Grid->no_kontrol->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_kontrol" class="form-group">
<input type="<?= $Grid->no_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_no_kontrol" name="x<?= $Grid->RowIndex ?>_no_kontrol" id="x<?= $Grid->RowIndex ?>_no_kontrol" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->no_kontrol->getPlaceHolder()) ?>" value="<?= $Grid->no_kontrol->EditValue ?>"<?= $Grid->no_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_kontrol->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_no_kontrol">
<span<?= $Grid->no_kontrol->viewAttributes() ?>>
<?= $Grid->no_kontrol->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_kontrol" data-hidden="1" name="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_no_kontrol" id="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_no_kontrol" value="<?= HtmlEncode($Grid->no_kontrol->FormValue) ?>">
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_kontrol" data-hidden="1" name="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_no_kontrol" id="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_no_kontrol" value="<?= HtmlEncode($Grid->no_kontrol->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_input->Visible) { // tgl_input ?>
        <td data-name="tgl_input" <?= $Grid->tgl_input->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_input" id="o<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_tgl_input">
<span<?= $Grid->tgl_input->viewAttributes() ?>>
<?= $Grid->tgl_input->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_input" data-hidden="1" name="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_tgl_input" id="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->FormValue) ?>">
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_input" data-hidden="1" name="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_tgl_input" id="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <td data-name="tgl_kontrol" <?= $Grid->tgl_kontrol->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_tgl_kontrol" class="form-group">
<input type="<?= $Grid->tgl_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-format="7" name="x<?= $Grid->RowIndex ?>_tgl_kontrol" id="x<?= $Grid->RowIndex ?>_tgl_kontrol" placeholder="<?= HtmlEncode($Grid->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Grid->tgl_kontrol->EditValue ?>"<?= $Grid->tgl_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_kontrol->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_kontrol->ReadOnly && !$Grid->tgl_kontrol->Disabled && !isset($Grid->tgl_kontrol->EditAttrs["readonly"]) && !isset($Grid->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftindak_lanjutgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("ftindak_lanjutgrid", "x<?= $Grid->RowIndex ?>_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_kontrol" id="o<?= $Grid->RowIndex ?>_tgl_kontrol" value="<?= HtmlEncode($Grid->tgl_kontrol->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_tgl_kontrol" class="form-group">
<input type="<?= $Grid->tgl_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-format="7" name="x<?= $Grid->RowIndex ?>_tgl_kontrol" id="x<?= $Grid->RowIndex ?>_tgl_kontrol" placeholder="<?= HtmlEncode($Grid->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Grid->tgl_kontrol->EditValue ?>"<?= $Grid->tgl_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_kontrol->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_kontrol->ReadOnly && !$Grid->tgl_kontrol->Disabled && !isset($Grid->tgl_kontrol->EditAttrs["readonly"]) && !isset($Grid->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftindak_lanjutgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("ftindak_lanjutgrid", "x<?= $Grid->RowIndex ?>_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tindak_lanjut_tgl_kontrol">
<span<?= $Grid->tgl_kontrol->viewAttributes() ?>>
<?= $Grid->tgl_kontrol->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-hidden="1" name="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_tgl_kontrol" id="ftindak_lanjutgrid$x<?= $Grid->RowIndex ?>_tgl_kontrol" value="<?= HtmlEncode($Grid->tgl_kontrol->FormValue) ?>">
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-hidden="1" name="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_tgl_kontrol" id="ftindak_lanjutgrid$o<?= $Grid->RowIndex ?>_tgl_kontrol" value="<?= HtmlEncode($Grid->tgl_kontrol->OldValue) ?>">
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
loadjs.ready(["ftindak_lanjutgrid","load"], function () {
    ftindak_lanjutgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_tindak_lanjut", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_tindak_lanjut_no_reg" class="form-group tindak_lanjut_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_tindak_lanjut_no_reg" class="form-group tindak_lanjut_no_reg">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_tindak_lanjut_no_reg" class="form-group tindak_lanjut_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tindak_lanjut->Visible) { // tindak_lanjut ?>
        <td data-name="tindak_lanjut">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tindak_lanjut_tindak_lanjut" class="form-group tindak_lanjut_tindak_lanjut">
<template id="tp_x<?= $Grid->RowIndex ?>_tindak_lanjut">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="tindak_lanjut" data-field="x_tindak_lanjut" name="x<?= $Grid->RowIndex ?>_tindak_lanjut" id="x<?= $Grid->RowIndex ?>_tindak_lanjut"<?= $Grid->tindak_lanjut->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tindak_lanjut" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tindak_lanjut"
    name="x<?= $Grid->RowIndex ?>_tindak_lanjut"
    value="<?= HtmlEncode($Grid->tindak_lanjut->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tindak_lanjut"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tindak_lanjut"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tindak_lanjut->isInvalidClass() ?>"
    data-table="tindak_lanjut"
    data-field="x_tindak_lanjut"
    data-value-separator="<?= $Grid->tindak_lanjut->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tindak_lanjut->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tindak_lanjut->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tindak_lanjut_tindak_lanjut" class="form-group tindak_lanjut_tindak_lanjut">
<span<?= $Grid->tindak_lanjut->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tindak_lanjut->getDisplayValue($Grid->tindak_lanjut->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tindak_lanjut" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tindak_lanjut" id="x<?= $Grid->RowIndex ?>_tindak_lanjut" value="<?= HtmlEncode($Grid->tindak_lanjut->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tindak_lanjut" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tindak_lanjut" id="o<?= $Grid->RowIndex ?>_tindak_lanjut" value="<?= HtmlEncode($Grid->tindak_lanjut->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->no_kontrol->Visible) { // no_kontrol ?>
        <td data-name="no_kontrol">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tindak_lanjut_no_kontrol" class="form-group tindak_lanjut_no_kontrol">
<input type="<?= $Grid->no_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_no_kontrol" name="x<?= $Grid->RowIndex ?>_no_kontrol" id="x<?= $Grid->RowIndex ?>_no_kontrol" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->no_kontrol->getPlaceHolder()) ?>" value="<?= $Grid->no_kontrol->EditValue ?>"<?= $Grid->no_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_kontrol->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tindak_lanjut_no_kontrol" class="form-group tindak_lanjut_no_kontrol">
<span<?= $Grid->no_kontrol->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_kontrol->getDisplayValue($Grid->no_kontrol->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_kontrol" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_kontrol" id="x<?= $Grid->RowIndex ?>_no_kontrol" value="<?= HtmlEncode($Grid->no_kontrol->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_no_kontrol" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_kontrol" id="o<?= $Grid->RowIndex ?>_no_kontrol" value="<?= HtmlEncode($Grid->no_kontrol->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_input->Visible) { // tgl_input ?>
        <td data-name="tgl_input">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tindak_lanjut_tgl_input" class="form-group tindak_lanjut_tgl_input">
<span<?= $Grid->tgl_input->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_input->getDisplayValue($Grid->tgl_input->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_input" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_input" id="x<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_input" id="o<?= $Grid->RowIndex ?>_tgl_input" value="<?= HtmlEncode($Grid->tgl_input->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <td data-name="tgl_kontrol">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tindak_lanjut_tgl_kontrol" class="form-group tindak_lanjut_tgl_kontrol">
<input type="<?= $Grid->tgl_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-format="7" name="x<?= $Grid->RowIndex ?>_tgl_kontrol" id="x<?= $Grid->RowIndex ?>_tgl_kontrol" placeholder="<?= HtmlEncode($Grid->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Grid->tgl_kontrol->EditValue ?>"<?= $Grid->tgl_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_kontrol->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_kontrol->ReadOnly && !$Grid->tgl_kontrol->Disabled && !isset($Grid->tgl_kontrol->EditAttrs["readonly"]) && !isset($Grid->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftindak_lanjutgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("ftindak_lanjutgrid", "x<?= $Grid->RowIndex ?>_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tindak_lanjut_tgl_kontrol" class="form-group tindak_lanjut_tgl_kontrol">
<span<?= $Grid->tgl_kontrol->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_kontrol->getDisplayValue($Grid->tgl_kontrol->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_kontrol" id="x<?= $Grid->RowIndex ?>_tgl_kontrol" value="<?= HtmlEncode($Grid->tgl_kontrol->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_kontrol" id="o<?= $Grid->RowIndex ?>_tgl_kontrol" value="<?= HtmlEncode($Grid->tgl_kontrol->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["ftindak_lanjutgrid","load"], function() {
    ftindak_lanjutgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="ftindak_lanjutgrid">
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
    ew.addEventHandlers("tindak_lanjut");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
