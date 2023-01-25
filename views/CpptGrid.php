<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("CpptGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcpptgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fcpptgrid = new ew.Form("fcpptgrid", "grid");
    fcpptgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "cppt")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.cppt)
        ew.vars.tables.cppt = currentTable;
    fcpptgrid.addFields([
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null, ew.Validators.integer], fields.no_reg.isInvalid],
        ["profesi", [fields.profesi.visible && fields.profesi.required ? ew.Validators.required(fields.profesi.caption) : null], fields.profesi.isInvalid],
        ["hasil_soap", [fields.hasil_soap.visible && fields.hasil_soap.required ? ew.Validators.required(fields.hasil_soap.caption) : null], fields.hasil_soap.isInvalid],
        ["instruksi", [fields.instruksi.visible && fields.instruksi.required ? ew.Validators.required(fields.instruksi.caption) : null], fields.instruksi.isInvalid],
        ["verifikasi", [fields.verifikasi.visible && fields.verifikasi.required ? ew.Validators.required(fields.verifikasi.caption) : null], fields.verifikasi.isInvalid],
        ["tanggal_input", [fields.tanggal_input.visible && fields.tanggal_input.required ? ew.Validators.required(fields.tanggal_input.caption) : null, ew.Validators.datetime(0)], fields.tanggal_input.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcpptgrid,
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
    fcpptgrid.validate = function () {
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
    fcpptgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_reg", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "profesi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "hasil_soap", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "instruksi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "verifikasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tanggal_input", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fcpptgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcpptgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fcpptgrid.lists.profesi = <?= $Grid->profesi->toClientList($Grid) ?>;
    fcpptgrid.lists.verifikasi = <?= $Grid->verifikasi->toClientList($Grid) ?>;
    loadjs.done("fcpptgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cppt">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcpptgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_cppt" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_cpptgrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_reg" class="<?= $Grid->no_reg->headerCellClass() ?>"><div id="elh_cppt_no_reg" class="cppt_no_reg"><?= $Grid->renderSort($Grid->no_reg) ?></div></th>
<?php } ?>
<?php if ($Grid->profesi->Visible) { // profesi ?>
        <th data-name="profesi" class="<?= $Grid->profesi->headerCellClass() ?>"><div id="elh_cppt_profesi" class="cppt_profesi"><?= $Grid->renderSort($Grid->profesi) ?></div></th>
<?php } ?>
<?php if ($Grid->hasil_soap->Visible) { // hasil_soap ?>
        <th data-name="hasil_soap" class="<?= $Grid->hasil_soap->headerCellClass() ?>"><div id="elh_cppt_hasil_soap" class="cppt_hasil_soap"><?= $Grid->renderSort($Grid->hasil_soap) ?></div></th>
<?php } ?>
<?php if ($Grid->instruksi->Visible) { // instruksi ?>
        <th data-name="instruksi" class="<?= $Grid->instruksi->headerCellClass() ?>"><div id="elh_cppt_instruksi" class="cppt_instruksi"><?= $Grid->renderSort($Grid->instruksi) ?></div></th>
<?php } ?>
<?php if ($Grid->verifikasi->Visible) { // verifikasi ?>
        <th data-name="verifikasi" class="<?= $Grid->verifikasi->headerCellClass() ?>"><div id="elh_cppt_verifikasi" class="cppt_verifikasi"><?= $Grid->renderSort($Grid->verifikasi) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggal_input->Visible) { // tanggal_input ?>
        <th data-name="tanggal_input" class="<?= $Grid->tanggal_input->headerCellClass() ?>"><div id="elh_cppt_tanggal_input" class="cppt_tanggal_input"><?= $Grid->renderSort($Grid->tanggal_input) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_cppt", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_cppt_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_cppt_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="cppt" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="cppt" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_cppt_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_cppt_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="cppt" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<?= $Grid->no_reg->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="cppt" data-field="x_no_reg" data-hidden="1" name="fcpptgrid$x<?= $Grid->RowIndex ?>_no_reg" id="fcpptgrid$x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<input type="hidden" data-table="cppt" data-field="x_no_reg" data-hidden="1" name="fcpptgrid$o<?= $Grid->RowIndex ?>_no_reg" id="fcpptgrid$o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->profesi->Visible) { // profesi ?>
        <td data-name="profesi" <?= $Grid->profesi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_profesi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_profesi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_profesi" name="x<?= $Grid->RowIndex ?>_profesi" id="x<?= $Grid->RowIndex ?>_profesi"<?= $Grid->profesi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_profesi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_profesi"
    name="x<?= $Grid->RowIndex ?>_profesi"
    value="<?= HtmlEncode($Grid->profesi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_profesi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_profesi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->profesi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_profesi"
    data-value-separator="<?= $Grid->profesi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->profesi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->profesi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="cppt" data-field="x_profesi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_profesi" id="o<?= $Grid->RowIndex ?>_profesi" value="<?= HtmlEncode($Grid->profesi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_profesi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_profesi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_profesi" name="x<?= $Grid->RowIndex ?>_profesi" id="x<?= $Grid->RowIndex ?>_profesi"<?= $Grid->profesi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_profesi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_profesi"
    name="x<?= $Grid->RowIndex ?>_profesi"
    value="<?= HtmlEncode($Grid->profesi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_profesi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_profesi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->profesi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_profesi"
    data-value-separator="<?= $Grid->profesi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->profesi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->profesi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_profesi">
<span<?= $Grid->profesi->viewAttributes() ?>>
<?= $Grid->profesi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="cppt" data-field="x_profesi" data-hidden="1" name="fcpptgrid$x<?= $Grid->RowIndex ?>_profesi" id="fcpptgrid$x<?= $Grid->RowIndex ?>_profesi" value="<?= HtmlEncode($Grid->profesi->FormValue) ?>">
<input type="hidden" data-table="cppt" data-field="x_profesi" data-hidden="1" name="fcpptgrid$o<?= $Grid->RowIndex ?>_profesi" id="fcpptgrid$o<?= $Grid->RowIndex ?>_profesi" value="<?= HtmlEncode($Grid->profesi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->hasil_soap->Visible) { // hasil_soap ?>
        <td data-name="hasil_soap" <?= $Grid->hasil_soap->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_hasil_soap" class="form-group">
<input type="<?= $Grid->hasil_soap->getInputTextType() ?>" data-table="cppt" data-field="x_hasil_soap" name="x<?= $Grid->RowIndex ?>_hasil_soap" id="x<?= $Grid->RowIndex ?>_hasil_soap" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->hasil_soap->getPlaceHolder()) ?>" value="<?= $Grid->hasil_soap->EditValue ?>"<?= $Grid->hasil_soap->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil_soap->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="cppt" data-field="x_hasil_soap" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hasil_soap" id="o<?= $Grid->RowIndex ?>_hasil_soap" value="<?= HtmlEncode($Grid->hasil_soap->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_hasil_soap" class="form-group">
<input type="<?= $Grid->hasil_soap->getInputTextType() ?>" data-table="cppt" data-field="x_hasil_soap" name="x<?= $Grid->RowIndex ?>_hasil_soap" id="x<?= $Grid->RowIndex ?>_hasil_soap" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->hasil_soap->getPlaceHolder()) ?>" value="<?= $Grid->hasil_soap->EditValue ?>"<?= $Grid->hasil_soap->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil_soap->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_hasil_soap">
<span<?= $Grid->hasil_soap->viewAttributes() ?>>
<?= $Grid->hasil_soap->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="cppt" data-field="x_hasil_soap" data-hidden="1" name="fcpptgrid$x<?= $Grid->RowIndex ?>_hasil_soap" id="fcpptgrid$x<?= $Grid->RowIndex ?>_hasil_soap" value="<?= HtmlEncode($Grid->hasil_soap->FormValue) ?>">
<input type="hidden" data-table="cppt" data-field="x_hasil_soap" data-hidden="1" name="fcpptgrid$o<?= $Grid->RowIndex ?>_hasil_soap" id="fcpptgrid$o<?= $Grid->RowIndex ?>_hasil_soap" value="<?= HtmlEncode($Grid->hasil_soap->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->instruksi->Visible) { // instruksi ?>
        <td data-name="instruksi" <?= $Grid->instruksi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_instruksi" class="form-group">
<input type="<?= $Grid->instruksi->getInputTextType() ?>" data-table="cppt" data-field="x_instruksi" name="x<?= $Grid->RowIndex ?>_instruksi" id="x<?= $Grid->RowIndex ?>_instruksi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->instruksi->getPlaceHolder()) ?>" value="<?= $Grid->instruksi->EditValue ?>"<?= $Grid->instruksi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->instruksi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="cppt" data-field="x_instruksi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_instruksi" id="o<?= $Grid->RowIndex ?>_instruksi" value="<?= HtmlEncode($Grid->instruksi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_instruksi" class="form-group">
<input type="<?= $Grid->instruksi->getInputTextType() ?>" data-table="cppt" data-field="x_instruksi" name="x<?= $Grid->RowIndex ?>_instruksi" id="x<?= $Grid->RowIndex ?>_instruksi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->instruksi->getPlaceHolder()) ?>" value="<?= $Grid->instruksi->EditValue ?>"<?= $Grid->instruksi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->instruksi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_instruksi">
<span<?= $Grid->instruksi->viewAttributes() ?>>
<?= $Grid->instruksi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="cppt" data-field="x_instruksi" data-hidden="1" name="fcpptgrid$x<?= $Grid->RowIndex ?>_instruksi" id="fcpptgrid$x<?= $Grid->RowIndex ?>_instruksi" value="<?= HtmlEncode($Grid->instruksi->FormValue) ?>">
<input type="hidden" data-table="cppt" data-field="x_instruksi" data-hidden="1" name="fcpptgrid$o<?= $Grid->RowIndex ?>_instruksi" id="fcpptgrid$o<?= $Grid->RowIndex ?>_instruksi" value="<?= HtmlEncode($Grid->instruksi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->verifikasi->Visible) { // verifikasi ?>
        <td data-name="verifikasi" <?= $Grid->verifikasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_verifikasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_verifikasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_verifikasi" name="x<?= $Grid->RowIndex ?>_verifikasi" id="x<?= $Grid->RowIndex ?>_verifikasi"<?= $Grid->verifikasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_verifikasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_verifikasi"
    name="x<?= $Grid->RowIndex ?>_verifikasi"
    value="<?= HtmlEncode($Grid->verifikasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_verifikasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_verifikasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->verifikasi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_verifikasi"
    data-value-separator="<?= $Grid->verifikasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->verifikasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->verifikasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="cppt" data-field="x_verifikasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_verifikasi" id="o<?= $Grid->RowIndex ?>_verifikasi" value="<?= HtmlEncode($Grid->verifikasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_verifikasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_verifikasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_verifikasi" name="x<?= $Grid->RowIndex ?>_verifikasi" id="x<?= $Grid->RowIndex ?>_verifikasi"<?= $Grid->verifikasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_verifikasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_verifikasi"
    name="x<?= $Grid->RowIndex ?>_verifikasi"
    value="<?= HtmlEncode($Grid->verifikasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_verifikasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_verifikasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->verifikasi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_verifikasi"
    data-value-separator="<?= $Grid->verifikasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->verifikasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->verifikasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_verifikasi">
<span<?= $Grid->verifikasi->viewAttributes() ?>>
<?= $Grid->verifikasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="cppt" data-field="x_verifikasi" data-hidden="1" name="fcpptgrid$x<?= $Grid->RowIndex ?>_verifikasi" id="fcpptgrid$x<?= $Grid->RowIndex ?>_verifikasi" value="<?= HtmlEncode($Grid->verifikasi->FormValue) ?>">
<input type="hidden" data-table="cppt" data-field="x_verifikasi" data-hidden="1" name="fcpptgrid$o<?= $Grid->RowIndex ?>_verifikasi" id="fcpptgrid$o<?= $Grid->RowIndex ?>_verifikasi" value="<?= HtmlEncode($Grid->verifikasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggal_input->Visible) { // tanggal_input ?>
        <td data-name="tanggal_input" <?= $Grid->tanggal_input->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_tanggal_input" class="form-group">
<input type="<?= $Grid->tanggal_input->getInputTextType() ?>" data-table="cppt" data-field="x_tanggal_input" name="x<?= $Grid->RowIndex ?>_tanggal_input" id="x<?= $Grid->RowIndex ?>_tanggal_input" placeholder="<?= HtmlEncode($Grid->tanggal_input->getPlaceHolder()) ?>" value="<?= $Grid->tanggal_input->EditValue ?>"<?= $Grid->tanggal_input->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal_input->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal_input->ReadOnly && !$Grid->tanggal_input->Disabled && !isset($Grid->tanggal_input->EditAttrs["readonly"]) && !isset($Grid->tanggal_input->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcpptgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fcpptgrid", "x<?= $Grid->RowIndex ?>_tanggal_input", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="cppt" data-field="x_tanggal_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal_input" id="o<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_tanggal_input" class="form-group">
<input type="<?= $Grid->tanggal_input->getInputTextType() ?>" data-table="cppt" data-field="x_tanggal_input" name="x<?= $Grid->RowIndex ?>_tanggal_input" id="x<?= $Grid->RowIndex ?>_tanggal_input" placeholder="<?= HtmlEncode($Grid->tanggal_input->getPlaceHolder()) ?>" value="<?= $Grid->tanggal_input->EditValue ?>"<?= $Grid->tanggal_input->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal_input->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal_input->ReadOnly && !$Grid->tanggal_input->Disabled && !isset($Grid->tanggal_input->EditAttrs["readonly"]) && !isset($Grid->tanggal_input->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcpptgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fcpptgrid", "x<?= $Grid->RowIndex ?>_tanggal_input", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_cppt_tanggal_input">
<span<?= $Grid->tanggal_input->viewAttributes() ?>>
<?= $Grid->tanggal_input->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="cppt" data-field="x_tanggal_input" data-hidden="1" name="fcpptgrid$x<?= $Grid->RowIndex ?>_tanggal_input" id="fcpptgrid$x<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->FormValue) ?>">
<input type="hidden" data-table="cppt" data-field="x_tanggal_input" data-hidden="1" name="fcpptgrid$o<?= $Grid->RowIndex ?>_tanggal_input" id="fcpptgrid$o<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->OldValue) ?>">
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
loadjs.ready(["fcpptgrid","load"], function () {
    fcpptgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_cppt", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_cppt_no_reg" class="form-group cppt_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_cppt_no_reg" class="form-group cppt_no_reg">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="cppt" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cppt_no_reg" class="form-group cppt_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="cppt" data-field="x_no_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cppt" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->profesi->Visible) { // profesi ?>
        <td data-name="profesi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_cppt_profesi" class="form-group cppt_profesi">
<template id="tp_x<?= $Grid->RowIndex ?>_profesi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_profesi" name="x<?= $Grid->RowIndex ?>_profesi" id="x<?= $Grid->RowIndex ?>_profesi"<?= $Grid->profesi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_profesi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_profesi"
    name="x<?= $Grid->RowIndex ?>_profesi"
    value="<?= HtmlEncode($Grid->profesi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_profesi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_profesi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->profesi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_profesi"
    data-value-separator="<?= $Grid->profesi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->profesi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->profesi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_cppt_profesi" class="form-group cppt_profesi">
<span<?= $Grid->profesi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->profesi->getDisplayValue($Grid->profesi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="cppt" data-field="x_profesi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_profesi" id="x<?= $Grid->RowIndex ?>_profesi" value="<?= HtmlEncode($Grid->profesi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cppt" data-field="x_profesi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_profesi" id="o<?= $Grid->RowIndex ?>_profesi" value="<?= HtmlEncode($Grid->profesi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->hasil_soap->Visible) { // hasil_soap ?>
        <td data-name="hasil_soap">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_cppt_hasil_soap" class="form-group cppt_hasil_soap">
<input type="<?= $Grid->hasil_soap->getInputTextType() ?>" data-table="cppt" data-field="x_hasil_soap" name="x<?= $Grid->RowIndex ?>_hasil_soap" id="x<?= $Grid->RowIndex ?>_hasil_soap" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->hasil_soap->getPlaceHolder()) ?>" value="<?= $Grid->hasil_soap->EditValue ?>"<?= $Grid->hasil_soap->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hasil_soap->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_cppt_hasil_soap" class="form-group cppt_hasil_soap">
<span<?= $Grid->hasil_soap->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->hasil_soap->getDisplayValue($Grid->hasil_soap->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="cppt" data-field="x_hasil_soap" data-hidden="1" name="x<?= $Grid->RowIndex ?>_hasil_soap" id="x<?= $Grid->RowIndex ?>_hasil_soap" value="<?= HtmlEncode($Grid->hasil_soap->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cppt" data-field="x_hasil_soap" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hasil_soap" id="o<?= $Grid->RowIndex ?>_hasil_soap" value="<?= HtmlEncode($Grid->hasil_soap->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->instruksi->Visible) { // instruksi ?>
        <td data-name="instruksi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_cppt_instruksi" class="form-group cppt_instruksi">
<input type="<?= $Grid->instruksi->getInputTextType() ?>" data-table="cppt" data-field="x_instruksi" name="x<?= $Grid->RowIndex ?>_instruksi" id="x<?= $Grid->RowIndex ?>_instruksi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->instruksi->getPlaceHolder()) ?>" value="<?= $Grid->instruksi->EditValue ?>"<?= $Grid->instruksi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->instruksi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_cppt_instruksi" class="form-group cppt_instruksi">
<span<?= $Grid->instruksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->instruksi->getDisplayValue($Grid->instruksi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="cppt" data-field="x_instruksi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_instruksi" id="x<?= $Grid->RowIndex ?>_instruksi" value="<?= HtmlEncode($Grid->instruksi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cppt" data-field="x_instruksi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_instruksi" id="o<?= $Grid->RowIndex ?>_instruksi" value="<?= HtmlEncode($Grid->instruksi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->verifikasi->Visible) { // verifikasi ?>
        <td data-name="verifikasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_cppt_verifikasi" class="form-group cppt_verifikasi">
<template id="tp_x<?= $Grid->RowIndex ?>_verifikasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_verifikasi" name="x<?= $Grid->RowIndex ?>_verifikasi" id="x<?= $Grid->RowIndex ?>_verifikasi"<?= $Grid->verifikasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_verifikasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_verifikasi"
    name="x<?= $Grid->RowIndex ?>_verifikasi"
    value="<?= HtmlEncode($Grid->verifikasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_verifikasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_verifikasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->verifikasi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_verifikasi"
    data-value-separator="<?= $Grid->verifikasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->verifikasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->verifikasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_cppt_verifikasi" class="form-group cppt_verifikasi">
<span<?= $Grid->verifikasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->verifikasi->getDisplayValue($Grid->verifikasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="cppt" data-field="x_verifikasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_verifikasi" id="x<?= $Grid->RowIndex ?>_verifikasi" value="<?= HtmlEncode($Grid->verifikasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cppt" data-field="x_verifikasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_verifikasi" id="o<?= $Grid->RowIndex ?>_verifikasi" value="<?= HtmlEncode($Grid->verifikasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggal_input->Visible) { // tanggal_input ?>
        <td data-name="tanggal_input">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_cppt_tanggal_input" class="form-group cppt_tanggal_input">
<input type="<?= $Grid->tanggal_input->getInputTextType() ?>" data-table="cppt" data-field="x_tanggal_input" name="x<?= $Grid->RowIndex ?>_tanggal_input" id="x<?= $Grid->RowIndex ?>_tanggal_input" placeholder="<?= HtmlEncode($Grid->tanggal_input->getPlaceHolder()) ?>" value="<?= $Grid->tanggal_input->EditValue ?>"<?= $Grid->tanggal_input->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal_input->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal_input->ReadOnly && !$Grid->tanggal_input->Disabled && !isset($Grid->tanggal_input->EditAttrs["readonly"]) && !isset($Grid->tanggal_input->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcpptgrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fcpptgrid", "x<?= $Grid->RowIndex ?>_tanggal_input", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cppt_tanggal_input" class="form-group cppt_tanggal_input">
<span<?= $Grid->tanggal_input->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggal_input->getDisplayValue($Grid->tanggal_input->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="cppt" data-field="x_tanggal_input" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggal_input" id="x<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cppt" data-field="x_tanggal_input" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal_input" id="o<?= $Grid->RowIndex ?>_tanggal_input" value="<?= HtmlEncode($Grid->tanggal_input->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fcpptgrid","load"], function() {
    fcpptgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fcpptgrid">
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
    ew.addEventHandlers("cppt");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
