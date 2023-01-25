<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("PenilaianAwalKeperawatanRalanGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralangrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fpenilaian_awal_keperawatan_ralangrid = new ew.Form("fpenilaian_awal_keperawatan_ralangrid", "grid");
    fpenilaian_awal_keperawatan_ralangrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_awal_keperawatan_ralan)
        ew.vars.tables.penilaian_awal_keperawatan_ralan = currentTable;
    fpenilaian_awal_keperawatan_ralangrid.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null], fields.tanggal.isInvalid],
        ["informasi", [fields.informasi.visible && fields.informasi.required ? ew.Validators.required(fields.informasi.caption) : null], fields.informasi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_awal_keperawatan_ralangrid,
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
    fpenilaian_awal_keperawatan_ralangrid.validate = function () {
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
    fpenilaian_awal_keperawatan_ralangrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_rawat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "informasi", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpenilaian_awal_keperawatan_ralangrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_awal_keperawatan_ralangrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_awal_keperawatan_ralangrid.lists.informasi = <?= $Grid->informasi->toClientList($Grid) ?>;
    loadjs.done("fpenilaian_awal_keperawatan_ralangrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_awal_keperawatan_ralan">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpenilaian_awal_keperawatan_ralangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_penilaian_awal_keperawatan_ralan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_penilaian_awal_keperawatan_ralangrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_rawat" class="<?= $Grid->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_no_rawat" class="penilaian_awal_keperawatan_ralan_no_rawat"><?= $Grid->renderSort($Grid->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Grid->tanggal->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_tanggal" class="penilaian_awal_keperawatan_ralan_tanggal"><?= $Grid->renderSort($Grid->tanggal) ?></div></th>
<?php } ?>
<?php if ($Grid->informasi->Visible) { // informasi ?>
        <th data-name="informasi" class="<?= $Grid->informasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_informasi" class="penilaian_awal_keperawatan_ralan_informasi"><?= $Grid->renderSort($Grid->informasi) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_penilaian_awal_keperawatan_ralan", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<?= $Grid->no_rawat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralangrid$x<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_awal_keperawatan_ralangrid$x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_awal_keperawatan_ralangrid$o<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_awal_keperawatan_ralangrid$o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Grid->tanggal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<?= $Grid->tanggal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_tanggal" data-hidden="1" name="fpenilaian_awal_keperawatan_ralangrid$x<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_awal_keperawatan_ralangrid$x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_tanggal" data-hidden="1" name="fpenilaian_awal_keperawatan_ralangrid$o<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_awal_keperawatan_ralangrid$o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->informasi->Visible) { // informasi ?>
        <td data-name="informasi" <?= $Grid->informasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_informasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi"<?= $Grid->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_informasi"
    name="x<?= $Grid->RowIndex ?>_informasi"
    value="<?= HtmlEncode($Grid->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_informasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_informasi"
    data-value-separator="<?= $Grid->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->informasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->informasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_informasi" id="o<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_informasi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi"<?= $Grid->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_informasi"
    name="x<?= $Grid->RowIndex ?>_informasi"
    value="<?= HtmlEncode($Grid->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_informasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_informasi"
    data-value-separator="<?= $Grid->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->informasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->informasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_awal_keperawatan_ralan_informasi">
<span<?= $Grid->informasi->viewAttributes() ?>>
<?= $Grid->informasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralangrid$x<?= $Grid->RowIndex ?>_informasi" id="fpenilaian_awal_keperawatan_ralangrid$x<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->FormValue) ?>">
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" data-hidden="1" name="fpenilaian_awal_keperawatan_ralangrid$o<?= $Grid->RowIndex ?>_informasi" id="fpenilaian_awal_keperawatan_ralangrid$o<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->OldValue) ?>">
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
loadjs.ready(["fpenilaian_awal_keperawatan_ralangrid","load"], function () {
    fpenilaian_awal_keperawatan_ralangrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_penilaian_awal_keperawatan_ralan", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_no_rawat" class="form-group penilaian_awal_keperawatan_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_no_rawat" class="form-group penilaian_awal_keperawatan_ralan_no_rawat">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_no_rawat" class="form-group penilaian_awal_keperawatan_ralan_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_tanggal" class="form-group penilaian_awal_keperawatan_ralan_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggal->getDisplayValue($Grid->tanggal->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_tanggal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->informasi->Visible) { // informasi ?>
        <td data-name="informasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_informasi" class="form-group penilaian_awal_keperawatan_ralan_informasi">
<template id="tp_x<?= $Grid->RowIndex ?>_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi"<?= $Grid->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_informasi"
    name="x<?= $Grid->RowIndex ?>_informasi"
    value="<?= HtmlEncode($Grid->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_informasi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_informasi"
    data-value-separator="<?= $Grid->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->informasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->informasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_awal_keperawatan_ralan_informasi" class="form-group penilaian_awal_keperawatan_ralan_informasi">
<span<?= $Grid->informasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->informasi->getDisplayValue($Grid->informasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_informasi" id="x<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_informasi" id="o<?= $Grid->RowIndex ?>_informasi" value="<?= HtmlEncode($Grid->informasi->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpenilaian_awal_keperawatan_ralangrid","load"], function() {
    fpenilaian_awal_keperawatan_ralangrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fpenilaian_awal_keperawatan_ralangrid">
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
    ew.addEventHandlers("penilaian_awal_keperawatan_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
