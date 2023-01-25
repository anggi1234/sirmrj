<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("BillingGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbillinggrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fbillinggrid = new ew.Form("fbillinggrid", "grid");
    fbillinggrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "billing")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.billing)
        ew.vars.tables.billing = currentTable;
    fbillinggrid.addFields([
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null], fields.no_reg.isInvalid],
        ["tgl_byr", [fields.tgl_byr.visible && fields.tgl_byr.required ? ew.Validators.required(fields.tgl_byr.caption) : null, ew.Validators.datetime(0)], fields.tgl_byr.isInvalid],
        ["no", [fields.no.visible && fields.no.required ? ew.Validators.required(fields.no.caption) : null], fields.no.isInvalid],
        ["nm_perawatan", [fields.nm_perawatan.visible && fields.nm_perawatan.required ? ew.Validators.required(fields.nm_perawatan.caption) : null], fields.nm_perawatan.isInvalid],
        ["pemisah", [fields.pemisah.visible && fields.pemisah.required ? ew.Validators.required(fields.pemisah.caption) : null], fields.pemisah.isInvalid],
        ["biaya", [fields.biaya.visible && fields.biaya.required ? ew.Validators.required(fields.biaya.caption) : null, ew.Validators.float], fields.biaya.isInvalid],
        ["jumlah", [fields.jumlah.visible && fields.jumlah.required ? ew.Validators.required(fields.jumlah.caption) : null, ew.Validators.float], fields.jumlah.isInvalid],
        ["tambahan", [fields.tambahan.visible && fields.tambahan.required ? ew.Validators.required(fields.tambahan.caption) : null, ew.Validators.float], fields.tambahan.isInvalid],
        ["totalbiaya", [fields.totalbiaya.visible && fields.totalbiaya.required ? ew.Validators.required(fields.totalbiaya.caption) : null, ew.Validators.float], fields.totalbiaya.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbillinggrid,
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
    fbillinggrid.validate = function () {
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
    fbillinggrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_reg", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tgl_byr", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "no", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nm_perawatan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "pemisah", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "biaya", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "jumlah", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tambahan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "totalbiaya", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "status", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fbillinggrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbillinggrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fbillinggrid.lists.status = <?= $Grid->status->toClientList($Grid) ?>;
    loadjs.done("fbillinggrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> billing">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fbillinggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_billing" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_billinggrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_reg" class="<?= $Grid->no_reg->headerCellClass() ?>"><div id="elh_billing_no_reg" class="billing_no_reg"><?= $Grid->renderSort($Grid->no_reg) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_byr->Visible) { // tgl_byr ?>
        <th data-name="tgl_byr" class="<?= $Grid->tgl_byr->headerCellClass() ?>"><div id="elh_billing_tgl_byr" class="billing_tgl_byr"><?= $Grid->renderSort($Grid->tgl_byr) ?></div></th>
<?php } ?>
<?php if ($Grid->no->Visible) { // no ?>
        <th data-name="no" class="<?= $Grid->no->headerCellClass() ?>"><div id="elh_billing_no" class="billing_no"><?= $Grid->renderSort($Grid->no) ?></div></th>
<?php } ?>
<?php if ($Grid->nm_perawatan->Visible) { // nm_perawatan ?>
        <th data-name="nm_perawatan" class="<?= $Grid->nm_perawatan->headerCellClass() ?>"><div id="elh_billing_nm_perawatan" class="billing_nm_perawatan"><?= $Grid->renderSort($Grid->nm_perawatan) ?></div></th>
<?php } ?>
<?php if ($Grid->pemisah->Visible) { // pemisah ?>
        <th data-name="pemisah" class="<?= $Grid->pemisah->headerCellClass() ?>"><div id="elh_billing_pemisah" class="billing_pemisah"><?= $Grid->renderSort($Grid->pemisah) ?></div></th>
<?php } ?>
<?php if ($Grid->biaya->Visible) { // biaya ?>
        <th data-name="biaya" class="<?= $Grid->biaya->headerCellClass() ?>"><div id="elh_billing_biaya" class="billing_biaya"><?= $Grid->renderSort($Grid->biaya) ?></div></th>
<?php } ?>
<?php if ($Grid->jumlah->Visible) { // jumlah ?>
        <th data-name="jumlah" class="<?= $Grid->jumlah->headerCellClass() ?>"><div id="elh_billing_jumlah" class="billing_jumlah"><?= $Grid->renderSort($Grid->jumlah) ?></div></th>
<?php } ?>
<?php if ($Grid->tambahan->Visible) { // tambahan ?>
        <th data-name="tambahan" class="<?= $Grid->tambahan->headerCellClass() ?>"><div id="elh_billing_tambahan" class="billing_tambahan"><?= $Grid->renderSort($Grid->tambahan) ?></div></th>
<?php } ?>
<?php if ($Grid->totalbiaya->Visible) { // totalbiaya ?>
        <th data-name="totalbiaya" class="<?= $Grid->totalbiaya->headerCellClass() ?>"><div id="elh_billing_totalbiaya" class="billing_totalbiaya"><?= $Grid->renderSort($Grid->totalbiaya) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_billing_status" class="billing_status"><?= $Grid->renderSort($Grid->status) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_billing", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_billing_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_billing_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="billing" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_reg->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_billing_no_reg" class="form-group">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_billing_no_reg" class="form-group">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="billing" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<?= $Grid->no_reg->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_no_reg" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_no_reg" id="fbillinggrid$x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_no_reg" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_no_reg" id="fbillinggrid$o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_byr->Visible) { // tgl_byr ?>
        <td data-name="tgl_byr" <?= $Grid->tgl_byr->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_tgl_byr" class="form-group">
<input type="<?= $Grid->tgl_byr->getInputTextType() ?>" data-table="billing" data-field="x_tgl_byr" name="x<?= $Grid->RowIndex ?>_tgl_byr" id="x<?= $Grid->RowIndex ?>_tgl_byr" placeholder="<?= HtmlEncode($Grid->tgl_byr->getPlaceHolder()) ?>" value="<?= $Grid->tgl_byr->EditValue ?>"<?= $Grid->tgl_byr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_byr->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_byr->ReadOnly && !$Grid->tgl_byr->Disabled && !isset($Grid->tgl_byr->EditAttrs["readonly"]) && !isset($Grid->tgl_byr->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbillinggrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fbillinggrid", "x<?= $Grid->RowIndex ?>_tgl_byr", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="billing" data-field="x_tgl_byr" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_byr" id="o<?= $Grid->RowIndex ?>_tgl_byr" value="<?= HtmlEncode($Grid->tgl_byr->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_tgl_byr" class="form-group">
<input type="<?= $Grid->tgl_byr->getInputTextType() ?>" data-table="billing" data-field="x_tgl_byr" name="x<?= $Grid->RowIndex ?>_tgl_byr" id="x<?= $Grid->RowIndex ?>_tgl_byr" placeholder="<?= HtmlEncode($Grid->tgl_byr->getPlaceHolder()) ?>" value="<?= $Grid->tgl_byr->EditValue ?>"<?= $Grid->tgl_byr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_byr->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_byr->ReadOnly && !$Grid->tgl_byr->Disabled && !isset($Grid->tgl_byr->EditAttrs["readonly"]) && !isset($Grid->tgl_byr->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbillinggrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fbillinggrid", "x<?= $Grid->RowIndex ?>_tgl_byr", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_tgl_byr">
<span<?= $Grid->tgl_byr->viewAttributes() ?>>
<?= $Grid->tgl_byr->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_tgl_byr" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_tgl_byr" id="fbillinggrid$x<?= $Grid->RowIndex ?>_tgl_byr" value="<?= HtmlEncode($Grid->tgl_byr->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_tgl_byr" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_tgl_byr" id="fbillinggrid$o<?= $Grid->RowIndex ?>_tgl_byr" value="<?= HtmlEncode($Grid->tgl_byr->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->no->Visible) { // no ?>
        <td data-name="no" <?= $Grid->no->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_no" class="form-group">
<input type="<?= $Grid->no->getInputTextType() ?>" data-table="billing" data-field="x_no" name="x<?= $Grid->RowIndex ?>_no" id="x<?= $Grid->RowIndex ?>_no" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->no->getPlaceHolder()) ?>" value="<?= $Grid->no->EditValue ?>"<?= $Grid->no->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_no" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no" id="o<?= $Grid->RowIndex ?>_no" value="<?= HtmlEncode($Grid->no->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_no" class="form-group">
<input type="<?= $Grid->no->getInputTextType() ?>" data-table="billing" data-field="x_no" name="x<?= $Grid->RowIndex ?>_no" id="x<?= $Grid->RowIndex ?>_no" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->no->getPlaceHolder()) ?>" value="<?= $Grid->no->EditValue ?>"<?= $Grid->no->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_no">
<span<?= $Grid->no->viewAttributes() ?>>
<?= $Grid->no->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_no" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_no" id="fbillinggrid$x<?= $Grid->RowIndex ?>_no" value="<?= HtmlEncode($Grid->no->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_no" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_no" id="fbillinggrid$o<?= $Grid->RowIndex ?>_no" value="<?= HtmlEncode($Grid->no->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nm_perawatan->Visible) { // nm_perawatan ?>
        <td data-name="nm_perawatan" <?= $Grid->nm_perawatan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_nm_perawatan" class="form-group">
<input type="<?= $Grid->nm_perawatan->getInputTextType() ?>" data-table="billing" data-field="x_nm_perawatan" name="x<?= $Grid->RowIndex ?>_nm_perawatan" id="x<?= $Grid->RowIndex ?>_nm_perawatan" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->nm_perawatan->getPlaceHolder()) ?>" value="<?= $Grid->nm_perawatan->EditValue ?>"<?= $Grid->nm_perawatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nm_perawatan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_nm_perawatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nm_perawatan" id="o<?= $Grid->RowIndex ?>_nm_perawatan" value="<?= HtmlEncode($Grid->nm_perawatan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_nm_perawatan" class="form-group">
<input type="<?= $Grid->nm_perawatan->getInputTextType() ?>" data-table="billing" data-field="x_nm_perawatan" name="x<?= $Grid->RowIndex ?>_nm_perawatan" id="x<?= $Grid->RowIndex ?>_nm_perawatan" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->nm_perawatan->getPlaceHolder()) ?>" value="<?= $Grid->nm_perawatan->EditValue ?>"<?= $Grid->nm_perawatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nm_perawatan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_nm_perawatan">
<span<?= $Grid->nm_perawatan->viewAttributes() ?>>
<?= $Grid->nm_perawatan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_nm_perawatan" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_nm_perawatan" id="fbillinggrid$x<?= $Grid->RowIndex ?>_nm_perawatan" value="<?= HtmlEncode($Grid->nm_perawatan->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_nm_perawatan" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_nm_perawatan" id="fbillinggrid$o<?= $Grid->RowIndex ?>_nm_perawatan" value="<?= HtmlEncode($Grid->nm_perawatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pemisah->Visible) { // pemisah ?>
        <td data-name="pemisah" <?= $Grid->pemisah->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_pemisah" class="form-group">
<input type="<?= $Grid->pemisah->getInputTextType() ?>" data-table="billing" data-field="x_pemisah" name="x<?= $Grid->RowIndex ?>_pemisah" id="x<?= $Grid->RowIndex ?>_pemisah" size="30" maxlength="1" placeholder="<?= HtmlEncode($Grid->pemisah->getPlaceHolder()) ?>" value="<?= $Grid->pemisah->EditValue ?>"<?= $Grid->pemisah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pemisah->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_pemisah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pemisah" id="o<?= $Grid->RowIndex ?>_pemisah" value="<?= HtmlEncode($Grid->pemisah->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_pemisah" class="form-group">
<input type="<?= $Grid->pemisah->getInputTextType() ?>" data-table="billing" data-field="x_pemisah" name="x<?= $Grid->RowIndex ?>_pemisah" id="x<?= $Grid->RowIndex ?>_pemisah" size="30" maxlength="1" placeholder="<?= HtmlEncode($Grid->pemisah->getPlaceHolder()) ?>" value="<?= $Grid->pemisah->EditValue ?>"<?= $Grid->pemisah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pemisah->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_pemisah">
<span<?= $Grid->pemisah->viewAttributes() ?>>
<?= $Grid->pemisah->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_pemisah" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_pemisah" id="fbillinggrid$x<?= $Grid->RowIndex ?>_pemisah" value="<?= HtmlEncode($Grid->pemisah->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_pemisah" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_pemisah" id="fbillinggrid$o<?= $Grid->RowIndex ?>_pemisah" value="<?= HtmlEncode($Grid->pemisah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->biaya->Visible) { // biaya ?>
        <td data-name="biaya" <?= $Grid->biaya->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_biaya" class="form-group">
<input type="<?= $Grid->biaya->getInputTextType() ?>" data-table="billing" data-field="x_biaya" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" size="30" placeholder="<?= HtmlEncode($Grid->biaya->getPlaceHolder()) ?>" value="<?= $Grid->biaya->EditValue ?>"<?= $Grid->biaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biaya->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_biaya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_biaya" id="o<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_biaya" class="form-group">
<input type="<?= $Grid->biaya->getInputTextType() ?>" data-table="billing" data-field="x_biaya" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" size="30" placeholder="<?= HtmlEncode($Grid->biaya->getPlaceHolder()) ?>" value="<?= $Grid->biaya->EditValue ?>"<?= $Grid->biaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biaya->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_biaya">
<span<?= $Grid->biaya->viewAttributes() ?>>
<?= $Grid->biaya->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_biaya" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_biaya" id="fbillinggrid$x<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_biaya" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_biaya" id="fbillinggrid$o<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jumlah->Visible) { // jumlah ?>
        <td data-name="jumlah" <?= $Grid->jumlah->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_jumlah" class="form-group">
<input type="<?= $Grid->jumlah->getInputTextType() ?>" data-table="billing" data-field="x_jumlah" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" size="30" placeholder="<?= HtmlEncode($Grid->jumlah->getPlaceHolder()) ?>" value="<?= $Grid->jumlah->EditValue ?>"<?= $Grid->jumlah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlah->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_jumlah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlah" id="o<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_jumlah" class="form-group">
<input type="<?= $Grid->jumlah->getInputTextType() ?>" data-table="billing" data-field="x_jumlah" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" size="30" placeholder="<?= HtmlEncode($Grid->jumlah->getPlaceHolder()) ?>" value="<?= $Grid->jumlah->EditValue ?>"<?= $Grid->jumlah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlah->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_jumlah">
<span<?= $Grid->jumlah->viewAttributes() ?>>
<?= $Grid->jumlah->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_jumlah" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_jumlah" id="fbillinggrid$x<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_jumlah" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_jumlah" id="fbillinggrid$o<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tambahan->Visible) { // tambahan ?>
        <td data-name="tambahan" <?= $Grid->tambahan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_tambahan" class="form-group">
<input type="<?= $Grid->tambahan->getInputTextType() ?>" data-table="billing" data-field="x_tambahan" name="x<?= $Grid->RowIndex ?>_tambahan" id="x<?= $Grid->RowIndex ?>_tambahan" size="30" placeholder="<?= HtmlEncode($Grid->tambahan->getPlaceHolder()) ?>" value="<?= $Grid->tambahan->EditValue ?>"<?= $Grid->tambahan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tambahan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_tambahan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tambahan" id="o<?= $Grid->RowIndex ?>_tambahan" value="<?= HtmlEncode($Grid->tambahan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_tambahan" class="form-group">
<input type="<?= $Grid->tambahan->getInputTextType() ?>" data-table="billing" data-field="x_tambahan" name="x<?= $Grid->RowIndex ?>_tambahan" id="x<?= $Grid->RowIndex ?>_tambahan" size="30" placeholder="<?= HtmlEncode($Grid->tambahan->getPlaceHolder()) ?>" value="<?= $Grid->tambahan->EditValue ?>"<?= $Grid->tambahan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tambahan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_tambahan">
<span<?= $Grid->tambahan->viewAttributes() ?>>
<?= $Grid->tambahan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_tambahan" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_tambahan" id="fbillinggrid$x<?= $Grid->RowIndex ?>_tambahan" value="<?= HtmlEncode($Grid->tambahan->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_tambahan" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_tambahan" id="fbillinggrid$o<?= $Grid->RowIndex ?>_tambahan" value="<?= HtmlEncode($Grid->tambahan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->totalbiaya->Visible) { // totalbiaya ?>
        <td data-name="totalbiaya" <?= $Grid->totalbiaya->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_totalbiaya" class="form-group">
<input type="<?= $Grid->totalbiaya->getInputTextType() ?>" data-table="billing" data-field="x_totalbiaya" name="x<?= $Grid->RowIndex ?>_totalbiaya" id="x<?= $Grid->RowIndex ?>_totalbiaya" size="30" placeholder="<?= HtmlEncode($Grid->totalbiaya->getPlaceHolder()) ?>" value="<?= $Grid->totalbiaya->EditValue ?>"<?= $Grid->totalbiaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->totalbiaya->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_totalbiaya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_totalbiaya" id="o<?= $Grid->RowIndex ?>_totalbiaya" value="<?= HtmlEncode($Grid->totalbiaya->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_totalbiaya" class="form-group">
<input type="<?= $Grid->totalbiaya->getInputTextType() ?>" data-table="billing" data-field="x_totalbiaya" name="x<?= $Grid->RowIndex ?>_totalbiaya" id="x<?= $Grid->RowIndex ?>_totalbiaya" size="30" placeholder="<?= HtmlEncode($Grid->totalbiaya->getPlaceHolder()) ?>" value="<?= $Grid->totalbiaya->EditValue ?>"<?= $Grid->totalbiaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->totalbiaya->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_totalbiaya">
<span<?= $Grid->totalbiaya->viewAttributes() ?>>
<?= $Grid->totalbiaya->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_totalbiaya" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_totalbiaya" id="fbillinggrid$x<?= $Grid->RowIndex ?>_totalbiaya" value="<?= HtmlEncode($Grid->totalbiaya->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_totalbiaya" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_totalbiaya" id="fbillinggrid$o<?= $Grid->RowIndex ?>_totalbiaya" value="<?= HtmlEncode($Grid->totalbiaya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status" <?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_billing_status" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="billing" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="billing"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="billing" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_billing_status" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="billing" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="billing"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_billing_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="billing" data-field="x_status" data-hidden="1" name="fbillinggrid$x<?= $Grid->RowIndex ?>_status" id="fbillinggrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="billing" data-field="x_status" data-hidden="1" name="fbillinggrid$o<?= $Grid->RowIndex ?>_status" id="fbillinggrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
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
loadjs.ready(["fbillinggrid","load"], function () {
    fbillinggrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_billing", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_billing_no_reg" class="form-group billing_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_billing_no_reg" class="form-group billing_no_reg">
<input type="<?= $Grid->no_reg->getInputTextType() ?>" data-table="billing" data-field="x_no_reg" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_reg->getPlaceHolder()) ?>" value="<?= $Grid->no_reg->EditValue ?>"<?= $Grid->no_reg->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_billing_no_reg" class="form-group billing_no_reg">
<span<?= $Grid->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_reg->getDisplayValue($Grid->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_no_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_reg" id="x<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_no_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_reg" id="o<?= $Grid->RowIndex ?>_no_reg" value="<?= HtmlEncode($Grid->no_reg->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_byr->Visible) { // tgl_byr ?>
        <td data-name="tgl_byr">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_tgl_byr" class="form-group billing_tgl_byr">
<input type="<?= $Grid->tgl_byr->getInputTextType() ?>" data-table="billing" data-field="x_tgl_byr" name="x<?= $Grid->RowIndex ?>_tgl_byr" id="x<?= $Grid->RowIndex ?>_tgl_byr" placeholder="<?= HtmlEncode($Grid->tgl_byr->getPlaceHolder()) ?>" value="<?= $Grid->tgl_byr->EditValue ?>"<?= $Grid->tgl_byr->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_byr->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_byr->ReadOnly && !$Grid->tgl_byr->Disabled && !isset($Grid->tgl_byr->EditAttrs["readonly"]) && !isset($Grid->tgl_byr->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbillinggrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fbillinggrid", "x<?= $Grid->RowIndex ?>_tgl_byr", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_tgl_byr" class="form-group billing_tgl_byr">
<span<?= $Grid->tgl_byr->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_byr->getDisplayValue($Grid->tgl_byr->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_tgl_byr" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_byr" id="x<?= $Grid->RowIndex ?>_tgl_byr" value="<?= HtmlEncode($Grid->tgl_byr->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_tgl_byr" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_byr" id="o<?= $Grid->RowIndex ?>_tgl_byr" value="<?= HtmlEncode($Grid->tgl_byr->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->no->Visible) { // no ?>
        <td data-name="no">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_no" class="form-group billing_no">
<input type="<?= $Grid->no->getInputTextType() ?>" data-table="billing" data-field="x_no" name="x<?= $Grid->RowIndex ?>_no" id="x<?= $Grid->RowIndex ?>_no" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->no->getPlaceHolder()) ?>" value="<?= $Grid->no->EditValue ?>"<?= $Grid->no->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_no" class="form-group billing_no">
<span<?= $Grid->no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no->getDisplayValue($Grid->no->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_no" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no" id="x<?= $Grid->RowIndex ?>_no" value="<?= HtmlEncode($Grid->no->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_no" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no" id="o<?= $Grid->RowIndex ?>_no" value="<?= HtmlEncode($Grid->no->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nm_perawatan->Visible) { // nm_perawatan ?>
        <td data-name="nm_perawatan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_nm_perawatan" class="form-group billing_nm_perawatan">
<input type="<?= $Grid->nm_perawatan->getInputTextType() ?>" data-table="billing" data-field="x_nm_perawatan" name="x<?= $Grid->RowIndex ?>_nm_perawatan" id="x<?= $Grid->RowIndex ?>_nm_perawatan" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->nm_perawatan->getPlaceHolder()) ?>" value="<?= $Grid->nm_perawatan->EditValue ?>"<?= $Grid->nm_perawatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nm_perawatan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_nm_perawatan" class="form-group billing_nm_perawatan">
<span<?= $Grid->nm_perawatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nm_perawatan->getDisplayValue($Grid->nm_perawatan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_nm_perawatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nm_perawatan" id="x<?= $Grid->RowIndex ?>_nm_perawatan" value="<?= HtmlEncode($Grid->nm_perawatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_nm_perawatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nm_perawatan" id="o<?= $Grid->RowIndex ?>_nm_perawatan" value="<?= HtmlEncode($Grid->nm_perawatan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->pemisah->Visible) { // pemisah ?>
        <td data-name="pemisah">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_pemisah" class="form-group billing_pemisah">
<input type="<?= $Grid->pemisah->getInputTextType() ?>" data-table="billing" data-field="x_pemisah" name="x<?= $Grid->RowIndex ?>_pemisah" id="x<?= $Grid->RowIndex ?>_pemisah" size="30" maxlength="1" placeholder="<?= HtmlEncode($Grid->pemisah->getPlaceHolder()) ?>" value="<?= $Grid->pemisah->EditValue ?>"<?= $Grid->pemisah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pemisah->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_pemisah" class="form-group billing_pemisah">
<span<?= $Grid->pemisah->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pemisah->getDisplayValue($Grid->pemisah->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_pemisah" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pemisah" id="x<?= $Grid->RowIndex ?>_pemisah" value="<?= HtmlEncode($Grid->pemisah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_pemisah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pemisah" id="o<?= $Grid->RowIndex ?>_pemisah" value="<?= HtmlEncode($Grid->pemisah->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->biaya->Visible) { // biaya ?>
        <td data-name="biaya">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_biaya" class="form-group billing_biaya">
<input type="<?= $Grid->biaya->getInputTextType() ?>" data-table="billing" data-field="x_biaya" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" size="30" placeholder="<?= HtmlEncode($Grid->biaya->getPlaceHolder()) ?>" value="<?= $Grid->biaya->EditValue ?>"<?= $Grid->biaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biaya->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_biaya" class="form-group billing_biaya">
<span<?= $Grid->biaya->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->biaya->getDisplayValue($Grid->biaya->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_biaya" data-hidden="1" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_biaya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_biaya" id="o<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jumlah->Visible) { // jumlah ?>
        <td data-name="jumlah">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_jumlah" class="form-group billing_jumlah">
<input type="<?= $Grid->jumlah->getInputTextType() ?>" data-table="billing" data-field="x_jumlah" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" size="30" placeholder="<?= HtmlEncode($Grid->jumlah->getPlaceHolder()) ?>" value="<?= $Grid->jumlah->EditValue ?>"<?= $Grid->jumlah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlah->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_jumlah" class="form-group billing_jumlah">
<span<?= $Grid->jumlah->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jumlah->getDisplayValue($Grid->jumlah->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_jumlah" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_jumlah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlah" id="o<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tambahan->Visible) { // tambahan ?>
        <td data-name="tambahan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_tambahan" class="form-group billing_tambahan">
<input type="<?= $Grid->tambahan->getInputTextType() ?>" data-table="billing" data-field="x_tambahan" name="x<?= $Grid->RowIndex ?>_tambahan" id="x<?= $Grid->RowIndex ?>_tambahan" size="30" placeholder="<?= HtmlEncode($Grid->tambahan->getPlaceHolder()) ?>" value="<?= $Grid->tambahan->EditValue ?>"<?= $Grid->tambahan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tambahan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_tambahan" class="form-group billing_tambahan">
<span<?= $Grid->tambahan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tambahan->getDisplayValue($Grid->tambahan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_tambahan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tambahan" id="x<?= $Grid->RowIndex ?>_tambahan" value="<?= HtmlEncode($Grid->tambahan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_tambahan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tambahan" id="o<?= $Grid->RowIndex ?>_tambahan" value="<?= HtmlEncode($Grid->tambahan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->totalbiaya->Visible) { // totalbiaya ?>
        <td data-name="totalbiaya">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_totalbiaya" class="form-group billing_totalbiaya">
<input type="<?= $Grid->totalbiaya->getInputTextType() ?>" data-table="billing" data-field="x_totalbiaya" name="x<?= $Grid->RowIndex ?>_totalbiaya" id="x<?= $Grid->RowIndex ?>_totalbiaya" size="30" placeholder="<?= HtmlEncode($Grid->totalbiaya->getPlaceHolder()) ?>" value="<?= $Grid->totalbiaya->EditValue ?>"<?= $Grid->totalbiaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->totalbiaya->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_totalbiaya" class="form-group billing_totalbiaya">
<span<?= $Grid->totalbiaya->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->totalbiaya->getDisplayValue($Grid->totalbiaya->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_totalbiaya" data-hidden="1" name="x<?= $Grid->RowIndex ?>_totalbiaya" id="x<?= $Grid->RowIndex ?>_totalbiaya" value="<?= HtmlEncode($Grid->totalbiaya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_totalbiaya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_totalbiaya" id="o<?= $Grid->RowIndex ?>_totalbiaya" value="<?= HtmlEncode($Grid->totalbiaya->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_billing_status" class="form-group billing_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="billing" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="billing"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_billing_status" class="form-group billing_status">
<span<?= $Grid->status->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->status->getDisplayValue($Grid->status->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="billing" data-field="x_status" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="billing" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fbillinggrid","load"], function() {
    fbillinggrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fbillinggrid">
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
    ew.addEventHandlers("billing");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
