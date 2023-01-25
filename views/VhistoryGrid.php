<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("VhistoryGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fvhistorygrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fvhistorygrid = new ew.Form("fvhistorygrid", "grid");
    fvhistorygrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "vhistory")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.vhistory)
        ew.vars.tables.vhistory = currentTable;
    fvhistorygrid.addFields([
        ["id_reg", [fields.id_reg.visible && fields.id_reg.required ? ew.Validators.required(fields.id_reg.caption) : null], fields.id_reg.isInvalid],
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["kd_poli", [fields.kd_poli.visible && fields.kd_poli.required ? ew.Validators.required(fields.kd_poli.caption) : null], fields.kd_poli.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["tgl_registrasi", [fields.tgl_registrasi.visible && fields.tgl_registrasi.required ? ew.Validators.required(fields.tgl_registrasi.caption) : null], fields.tgl_registrasi.isInvalid],
        ["jam_reg", [fields.jam_reg.visible && fields.jam_reg.required ? ew.Validators.required(fields.jam_reg.caption) : null], fields.jam_reg.isInvalid],
        ["cetak", [fields.cetak.visible && fields.cetak.required ? ew.Validators.required(fields.cetak.caption) : null], fields.cetak.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fvhistorygrid,
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
    fvhistorygrid.validate = function () {
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
    fvhistorygrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_rkm_medis", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_poli", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_dokter", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "cetak", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fvhistorygrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvhistorygrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fvhistorygrid.lists.no_rkm_medis = <?= $Grid->no_rkm_medis->toClientList($Grid) ?>;
    fvhistorygrid.lists.kd_poli = <?= $Grid->kd_poli->toClientList($Grid) ?>;
    fvhistorygrid.lists.kd_dokter = <?= $Grid->kd_dokter->toClientList($Grid) ?>;
    loadjs.done("fvhistorygrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vhistory">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvhistorygrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vhistory" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_vhistorygrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->id_reg->Visible) { // id_reg ?>
        <th data-name="id_reg" class="<?= $Grid->id_reg->headerCellClass() ?>"><div id="elh_vhistory_id_reg" class="vhistory_id_reg"><?= $Grid->renderSort($Grid->id_reg) ?></div></th>
<?php } ?>
<?php if ($Grid->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th data-name="no_rkm_medis" class="<?= $Grid->no_rkm_medis->headerCellClass() ?>"><div id="elh_vhistory_no_rkm_medis" class="vhistory_no_rkm_medis"><?= $Grid->renderSort($Grid->no_rkm_medis) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_poli->Visible) { // kd_poli ?>
        <th data-name="kd_poli" class="<?= $Grid->kd_poli->headerCellClass() ?>"><div id="elh_vhistory_kd_poli" class="vhistory_kd_poli"><?= $Grid->renderSort($Grid->kd_poli) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Grid->kd_dokter->headerCellClass() ?>"><div id="elh_vhistory_kd_dokter" class="vhistory_kd_dokter"><?= $Grid->renderSort($Grid->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <th data-name="tgl_registrasi" class="<?= $Grid->tgl_registrasi->headerCellClass() ?>"><div id="elh_vhistory_tgl_registrasi" class="vhistory_tgl_registrasi"><?= $Grid->renderSort($Grid->tgl_registrasi) ?></div></th>
<?php } ?>
<?php if ($Grid->jam_reg->Visible) { // jam_reg ?>
        <th data-name="jam_reg" class="<?= $Grid->jam_reg->headerCellClass() ?>"><div id="elh_vhistory_jam_reg" class="vhistory_jam_reg"><?= $Grid->renderSort($Grid->jam_reg) ?></div></th>
<?php } ?>
<?php if ($Grid->cetak->Visible) { // cetak ?>
        <th data-name="cetak" class="<?= $Grid->cetak->headerCellClass() ?>"><div id="elh_vhistory_cetak" class="vhistory_cetak"><?= $Grid->renderSort($Grid->cetak) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_vhistory", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->id_reg->Visible) { // id_reg ?>
        <td data-name="id_reg" <?= $Grid->id_reg->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_id_reg" class="form-group"></span>
<input type="hidden" data-table="vhistory" data-field="x_id_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_reg" id="o<?= $Grid->RowIndex ?>_id_reg" value="<?= HtmlEncode($Grid->id_reg->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_id_reg" class="form-group">
<span<?= $Grid->id_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_reg->getDisplayValue($Grid->id_reg->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_id_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_reg" id="x<?= $Grid->RowIndex ?>_id_reg" value="<?= HtmlEncode($Grid->id_reg->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_id_reg">
<span<?= $Grid->id_reg->viewAttributes() ?>>
<?= $Grid->id_reg->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="vhistory" data-field="x_id_reg" data-hidden="1" name="fvhistorygrid$x<?= $Grid->RowIndex ?>_id_reg" id="fvhistorygrid$x<?= $Grid->RowIndex ?>_id_reg" value="<?= HtmlEncode($Grid->id_reg->FormValue) ?>">
<input type="hidden" data-table="vhistory" data-field="x_id_reg" data-hidden="1" name="fvhistorygrid$o<?= $Grid->RowIndex ?>_id_reg" id="fvhistorygrid$o<?= $Grid->RowIndex ?>_id_reg" value="<?= HtmlEncode($Grid->id_reg->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis" <?= $Grid->no_rkm_medis->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->no_rkm_medis->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_no_rkm_medis" class="form-group">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_no_rkm_medis" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_no_rkm_medis"><?= EmptyValue(strval($Grid->no_rkm_medis->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->no_rkm_medis->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->no_rkm_medis->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->no_rkm_medis->ReadOnly || $Grid->no_rkm_medis->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_no_rkm_medis',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->no_rkm_medis->getErrorMessage() ?></div>
<?= $Grid->no_rkm_medis->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_no_rkm_medis") ?>
<input type="hidden" is="selection-list" data-table="vhistory" data-field="x_no_rkm_medis" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->no_rkm_medis->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= $Grid->no_rkm_medis->CurrentValue ?>"<?= $Grid->no_rkm_medis->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_no_rkm_medis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rkm_medis" id="o<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_no_rkm_medis" class="form-group">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_no_rkm_medis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_no_rkm_medis">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<?= $Grid->no_rkm_medis->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="vhistory" data-field="x_no_rkm_medis" data-hidden="1" name="fvhistorygrid$x<?= $Grid->RowIndex ?>_no_rkm_medis" id="fvhistorygrid$x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->FormValue) ?>">
<input type="hidden" data-table="vhistory" data-field="x_no_rkm_medis" data-hidden="1" name="fvhistorygrid$o<?= $Grid->RowIndex ?>_no_rkm_medis" id="fvhistorygrid$o<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_poli->Visible) { // kd_poli ?>
        <td data-name="kd_poli" <?= $Grid->kd_poli->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_kd_poli" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_poli"
        name="x<?= $Grid->RowIndex ?>_kd_poli"
        class="form-control ew-select<?= $Grid->kd_poli->isInvalidClass() ?>"
        data-select2-id="vhistory_x<?= $Grid->RowIndex ?>_kd_poli"
        data-table="vhistory"
        data-field="x_kd_poli"
        data-value-separator="<?= $Grid->kd_poli->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kd_poli->getPlaceHolder()) ?>"
        <?= $Grid->kd_poli->editAttributes() ?>>
        <?= $Grid->kd_poli->selectOptionListHtml("x{$Grid->RowIndex}_kd_poli") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kd_poli->getErrorMessage() ?></div>
<?= $Grid->kd_poli->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_poli") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vhistory_x<?= $Grid->RowIndex ?>_kd_poli']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_poli", selectId: "vhistory_x<?= $Grid->RowIndex ?>_kd_poli", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vhistory.fields.kd_poli.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="vhistory" data-field="x_kd_poli" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_poli" id="o<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_kd_poli" class="form-group">
<span<?= $Grid->kd_poli->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_poli->getDisplayValue($Grid->kd_poli->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_kd_poli" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_poli" id="x<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_kd_poli">
<span<?= $Grid->kd_poli->viewAttributes() ?>>
<?= $Grid->kd_poli->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="vhistory" data-field="x_kd_poli" data-hidden="1" name="fvhistorygrid$x<?= $Grid->RowIndex ?>_kd_poli" id="fvhistorygrid$x<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->FormValue) ?>">
<input type="hidden" data-table="vhistory" data-field="x_kd_poli" data-hidden="1" name="fvhistorygrid$o<?= $Grid->RowIndex ?>_kd_poli" id="fvhistorygrid$o<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Grid->kd_dokter->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_kd_dokter" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_dokter"
        name="x<?= $Grid->RowIndex ?>_kd_dokter"
        class="form-control ew-select<?= $Grid->kd_dokter->isInvalidClass() ?>"
        data-select2-id="vhistory_x<?= $Grid->RowIndex ?>_kd_dokter"
        data-table="vhistory"
        data-field="x_kd_dokter"
        data-value-separator="<?= $Grid->kd_dokter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kd_dokter->getPlaceHolder()) ?>"
        <?= $Grid->kd_dokter->editAttributes() ?>>
        <?= $Grid->kd_dokter->selectOptionListHtml("x{$Grid->RowIndex}_kd_dokter") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kd_dokter->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vhistory_x<?= $Grid->RowIndex ?>_kd_dokter']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_dokter", selectId: "vhistory_x<?= $Grid->RowIndex ?>_kd_dokter", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.vhistory.fields.kd_dokter.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vhistory.fields.kd_dokter.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="vhistory" data-field="x_kd_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_dokter" id="o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_kd_dokter" class="form-group">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_dokter->getDisplayValue($Grid->kd_dokter->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_kd_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_kd_dokter">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<?= $Grid->kd_dokter->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="vhistory" data-field="x_kd_dokter" data-hidden="1" name="fvhistorygrid$x<?= $Grid->RowIndex ?>_kd_dokter" id="fvhistorygrid$x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->FormValue) ?>">
<input type="hidden" data-table="vhistory" data-field="x_kd_dokter" data-hidden="1" name="fvhistorygrid$o<?= $Grid->RowIndex ?>_kd_dokter" id="fvhistorygrid$o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <td data-name="tgl_registrasi" <?= $Grid->tgl_registrasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vhistory" data-field="x_tgl_registrasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_registrasi" id="o<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_tgl_registrasi">
<span<?= $Grid->tgl_registrasi->viewAttributes() ?>>
<?= $Grid->tgl_registrasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="vhistory" data-field="x_tgl_registrasi" data-hidden="1" name="fvhistorygrid$x<?= $Grid->RowIndex ?>_tgl_registrasi" id="fvhistorygrid$x<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->FormValue) ?>">
<input type="hidden" data-table="vhistory" data-field="x_tgl_registrasi" data-hidden="1" name="fvhistorygrid$o<?= $Grid->RowIndex ?>_tgl_registrasi" id="fvhistorygrid$o<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jam_reg->Visible) { // jam_reg ?>
        <td data-name="jam_reg" <?= $Grid->jam_reg->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vhistory" data-field="x_jam_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_reg" id="o<?= $Grid->RowIndex ?>_jam_reg" value="<?= HtmlEncode($Grid->jam_reg->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_jam_reg">
<span<?= $Grid->jam_reg->viewAttributes() ?>>
<?= $Grid->jam_reg->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="vhistory" data-field="x_jam_reg" data-hidden="1" name="fvhistorygrid$x<?= $Grid->RowIndex ?>_jam_reg" id="fvhistorygrid$x<?= $Grid->RowIndex ?>_jam_reg" value="<?= HtmlEncode($Grid->jam_reg->FormValue) ?>">
<input type="hidden" data-table="vhistory" data-field="x_jam_reg" data-hidden="1" name="fvhistorygrid$o<?= $Grid->RowIndex ?>_jam_reg" id="fvhistorygrid$o<?= $Grid->RowIndex ?>_jam_reg" value="<?= HtmlEncode($Grid->jam_reg->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->cetak->Visible) { // cetak ?>
        <td data-name="cetak" <?= $Grid->cetak->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_cetak" class="form-group">
<textarea data-table="vhistory" data-field="x_cetak" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->cetak->getPlaceHolder()) ?>"<?= $Grid->cetak->editAttributes() ?>><?= $Grid->cetak->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->cetak->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="vhistory" data-field="x_cetak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_cetak" id="o<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_cetak" class="form-group">
<textarea data-table="vhistory" data-field="x_cetak" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->cetak->getPlaceHolder()) ?>"<?= $Grid->cetak->editAttributes() ?>><?= $Grid->cetak->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->cetak->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_vhistory_cetak">
<span<?= $Grid->cetak->viewAttributes() ?>><a class="btn btn-info btn-sm"
	href="../VhistoryList"
target="_blank">Cetak</a>
</span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="vhistory" data-field="x_cetak" data-hidden="1" name="fvhistorygrid$x<?= $Grid->RowIndex ?>_cetak" id="fvhistorygrid$x<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->FormValue) ?>">
<input type="hidden" data-table="vhistory" data-field="x_cetak" data-hidden="1" name="fvhistorygrid$o<?= $Grid->RowIndex ?>_cetak" id="fvhistorygrid$o<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->OldValue) ?>">
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
loadjs.ready(["fvhistorygrid","load"], function () {
    fvhistorygrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_vhistory", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->id_reg->Visible) { // id_reg ?>
        <td data-name="id_reg">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_vhistory_id_reg" class="form-group vhistory_id_reg"></span>
<?php } else { ?>
<span id="el$rowindex$_vhistory_id_reg" class="form-group vhistory_id_reg">
<span<?= $Grid->id_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_reg->getDisplayValue($Grid->id_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_id_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_reg" id="x<?= $Grid->RowIndex ?>_id_reg" value="<?= HtmlEncode($Grid->id_reg->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_id_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_reg" id="o<?= $Grid->RowIndex ?>_id_reg" value="<?= HtmlEncode($Grid->id_reg->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->no_rkm_medis->getSessionValue() != "") { ?>
<span id="el$rowindex$_vhistory_no_rkm_medis" class="form-group vhistory_no_rkm_medis">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_vhistory_no_rkm_medis" class="form-group vhistory_no_rkm_medis">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_no_rkm_medis"><?= EmptyValue(strval($Grid->no_rkm_medis->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->no_rkm_medis->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->no_rkm_medis->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->no_rkm_medis->ReadOnly || $Grid->no_rkm_medis->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_no_rkm_medis',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->no_rkm_medis->getErrorMessage() ?></div>
<?= $Grid->no_rkm_medis->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_no_rkm_medis") ?>
<input type="hidden" is="selection-list" data-table="vhistory" data-field="x_no_rkm_medis" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->no_rkm_medis->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= $Grid->no_rkm_medis->CurrentValue ?>"<?= $Grid->no_rkm_medis->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_vhistory_no_rkm_medis" class="form-group vhistory_no_rkm_medis">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_no_rkm_medis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_no_rkm_medis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rkm_medis" id="o<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_poli->Visible) { // kd_poli ?>
        <td data-name="kd_poli">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_vhistory_kd_poli" class="form-group vhistory_kd_poli">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_poli"
        name="x<?= $Grid->RowIndex ?>_kd_poli"
        class="form-control ew-select<?= $Grid->kd_poli->isInvalidClass() ?>"
        data-select2-id="vhistory_x<?= $Grid->RowIndex ?>_kd_poli"
        data-table="vhistory"
        data-field="x_kd_poli"
        data-value-separator="<?= $Grid->kd_poli->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kd_poli->getPlaceHolder()) ?>"
        <?= $Grid->kd_poli->editAttributes() ?>>
        <?= $Grid->kd_poli->selectOptionListHtml("x{$Grid->RowIndex}_kd_poli") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kd_poli->getErrorMessage() ?></div>
<?= $Grid->kd_poli->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_poli") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vhistory_x<?= $Grid->RowIndex ?>_kd_poli']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_poli", selectId: "vhistory_x<?= $Grid->RowIndex ?>_kd_poli", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vhistory.fields.kd_poli.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_vhistory_kd_poli" class="form-group vhistory_kd_poli">
<span<?= $Grid->kd_poli->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_poli->getDisplayValue($Grid->kd_poli->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_kd_poli" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_poli" id="x<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_kd_poli" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_poli" id="o<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_vhistory_kd_dokter" class="form-group vhistory_kd_dokter">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_dokter"
        name="x<?= $Grid->RowIndex ?>_kd_dokter"
        class="form-control ew-select<?= $Grid->kd_dokter->isInvalidClass() ?>"
        data-select2-id="vhistory_x<?= $Grid->RowIndex ?>_kd_dokter"
        data-table="vhistory"
        data-field="x_kd_dokter"
        data-value-separator="<?= $Grid->kd_dokter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kd_dokter->getPlaceHolder()) ?>"
        <?= $Grid->kd_dokter->editAttributes() ?>>
        <?= $Grid->kd_dokter->selectOptionListHtml("x{$Grid->RowIndex}_kd_dokter") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kd_dokter->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vhistory_x<?= $Grid->RowIndex ?>_kd_dokter']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_dokter", selectId: "vhistory_x<?= $Grid->RowIndex ?>_kd_dokter", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.vhistory.fields.kd_dokter.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vhistory.fields.kd_dokter.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_vhistory_kd_dokter" class="form-group vhistory_kd_dokter">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_dokter->getDisplayValue($Grid->kd_dokter->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_kd_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_kd_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_dokter" id="o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <td data-name="tgl_registrasi">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_vhistory_tgl_registrasi" class="form-group vhistory_tgl_registrasi">
<span<?= $Grid->tgl_registrasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_registrasi->getDisplayValue($Grid->tgl_registrasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_tgl_registrasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_registrasi" id="x<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_tgl_registrasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_registrasi" id="o<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jam_reg->Visible) { // jam_reg ?>
        <td data-name="jam_reg">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_vhistory_jam_reg" class="form-group vhistory_jam_reg">
<span<?= $Grid->jam_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jam_reg->getDisplayValue($Grid->jam_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_jam_reg" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jam_reg" id="x<?= $Grid->RowIndex ?>_jam_reg" value="<?= HtmlEncode($Grid->jam_reg->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_jam_reg" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_reg" id="o<?= $Grid->RowIndex ?>_jam_reg" value="<?= HtmlEncode($Grid->jam_reg->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->cetak->Visible) { // cetak ?>
        <td data-name="cetak">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_vhistory_cetak" class="form-group vhistory_cetak">
<textarea data-table="vhistory" data-field="x_cetak" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->cetak->getPlaceHolder()) ?>"<?= $Grid->cetak->editAttributes() ?>><?= $Grid->cetak->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->cetak->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_vhistory_cetak" class="form-group vhistory_cetak">
<span<?= $Grid->cetak->viewAttributes() ?>>
<?= $Grid->cetak->ViewValue ?></span>
</span>
<input type="hidden" data-table="vhistory" data-field="x_cetak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vhistory" data-field="x_cetak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_cetak" id="o<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fvhistorygrid","load"], function() {
    fvhistorygrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fvhistorygrid">
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
    ew.addEventHandlers("vhistory");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
