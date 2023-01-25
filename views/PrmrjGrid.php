<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("PrmrjGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fprmrjgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fprmrjgrid = new ew.Form("fprmrjgrid", "grid");
    fprmrjgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "prmrj")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.prmrj)
        ew.vars.tables.prmrj = currentTable;
    fprmrjgrid.addFields([
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["tgl_registrasi", [fields.tgl_registrasi.visible && fields.tgl_registrasi.required ? ew.Validators.required(fields.tgl_registrasi.caption) : null], fields.tgl_registrasi.isInvalid],
        ["kd_poli", [fields.kd_poli.visible && fields.kd_poli.required ? ew.Validators.required(fields.kd_poli.caption) : null], fields.kd_poli.isInvalid],
        ["kd_penyakit", [fields.kd_penyakit.visible && fields.kd_penyakit.required ? ew.Validators.required(fields.kd_penyakit.caption) : null], fields.kd_penyakit.isInvalid],
        ["alergi", [fields.alergi.visible && fields.alergi.required ? ew.Validators.required(fields.alergi.caption) : null], fields.alergi.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["kd_icd9", [fields.kd_icd9.visible && fields.kd_icd9.required ? ew.Validators.required(fields.kd_icd9.caption) : null], fields.kd_icd9.isInvalid],
        ["cetak", [fields.cetak.visible && fields.cetak.required ? ew.Validators.required(fields.cetak.caption) : null], fields.cetak.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fprmrjgrid,
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
    fprmrjgrid.validate = function () {
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
    fprmrjgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_rkm_medis", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_poli", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_penyakit", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "alergi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_dokter", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kd_icd9", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "cetak", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fprmrjgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fprmrjgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fprmrjgrid.lists.no_rkm_medis = <?= $Grid->no_rkm_medis->toClientList($Grid) ?>;
    fprmrjgrid.lists.kd_poli = <?= $Grid->kd_poli->toClientList($Grid) ?>;
    fprmrjgrid.lists.kd_penyakit = <?= $Grid->kd_penyakit->toClientList($Grid) ?>;
    fprmrjgrid.lists.kd_dokter = <?= $Grid->kd_dokter->toClientList($Grid) ?>;
    fprmrjgrid.lists.kd_icd9 = <?= $Grid->kd_icd9->toClientList($Grid) ?>;
    loadjs.done("fprmrjgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> prmrj">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fprmrjgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_prmrj" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_prmrjgrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th data-name="no_rkm_medis" class="<?= $Grid->no_rkm_medis->headerCellClass() ?>"><div id="elh_prmrj_no_rkm_medis" class="prmrj_no_rkm_medis"><?= $Grid->renderSort($Grid->no_rkm_medis) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <th data-name="tgl_registrasi" class="<?= $Grid->tgl_registrasi->headerCellClass() ?>"><div id="elh_prmrj_tgl_registrasi" class="prmrj_tgl_registrasi"><?= $Grid->renderSort($Grid->tgl_registrasi) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_poli->Visible) { // kd_poli ?>
        <th data-name="kd_poli" class="<?= $Grid->kd_poli->headerCellClass() ?>"><div id="elh_prmrj_kd_poli" class="prmrj_kd_poli"><?= $Grid->renderSort($Grid->kd_poli) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_penyakit->Visible) { // kd_penyakit ?>
        <th data-name="kd_penyakit" class="<?= $Grid->kd_penyakit->headerCellClass() ?>"><div id="elh_prmrj_kd_penyakit" class="prmrj_kd_penyakit"><?= $Grid->renderSort($Grid->kd_penyakit) ?></div></th>
<?php } ?>
<?php if ($Grid->alergi->Visible) { // alergi ?>
        <th data-name="alergi" class="<?= $Grid->alergi->headerCellClass() ?>"><div id="elh_prmrj_alergi" class="prmrj_alergi"><?= $Grid->renderSort($Grid->alergi) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Grid->kd_dokter->headerCellClass() ?>"><div id="elh_prmrj_kd_dokter" class="prmrj_kd_dokter"><?= $Grid->renderSort($Grid->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Grid->kd_icd9->Visible) { // kd_icd9 ?>
        <th data-name="kd_icd9" class="<?= $Grid->kd_icd9->headerCellClass() ?>"><div id="elh_prmrj_kd_icd9" class="prmrj_kd_icd9"><?= $Grid->renderSort($Grid->kd_icd9) ?></div></th>
<?php } ?>
<?php if ($Grid->cetak->Visible) { // cetak ?>
        <th data-name="cetak" class="<?= $Grid->cetak->headerCellClass() ?>"><div id="elh_prmrj_cetak" class="prmrj_cetak"><?= $Grid->renderSort($Grid->cetak) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_prmrj", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis" <?= $Grid->no_rkm_medis->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->no_rkm_medis->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_no_rkm_medis" class="form-group">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_no_rkm_medis" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_no_rkm_medis"><?= EmptyValue(strval($Grid->no_rkm_medis->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->no_rkm_medis->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->no_rkm_medis->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->no_rkm_medis->ReadOnly || $Grid->no_rkm_medis->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_no_rkm_medis',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->no_rkm_medis->getErrorMessage() ?></div>
<?= $Grid->no_rkm_medis->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_no_rkm_medis") ?>
<input type="hidden" is="selection-list" data-table="prmrj" data-field="x_no_rkm_medis" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->no_rkm_medis->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= $Grid->no_rkm_medis->CurrentValue ?>"<?= $Grid->no_rkm_medis->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_no_rkm_medis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rkm_medis" id="o<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_no_rkm_medis" class="form-group">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_no_rkm_medis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_no_rkm_medis">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<?= $Grid->no_rkm_medis->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_no_rkm_medis" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_no_rkm_medis" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_no_rkm_medis" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_no_rkm_medis" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <td data-name="tgl_registrasi" <?= $Grid->tgl_registrasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="prmrj" data-field="x_tgl_registrasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_registrasi" id="o<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_tgl_registrasi">
<span<?= $Grid->tgl_registrasi->viewAttributes() ?>>
<?= $Grid->tgl_registrasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_tgl_registrasi" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_tgl_registrasi" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_tgl_registrasi" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_tgl_registrasi" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_poli->Visible) { // kd_poli ?>
        <td data-name="kd_poli" <?= $Grid->kd_poli->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_poli" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_poli"
        name="x<?= $Grid->RowIndex ?>_kd_poli"
        class="form-control ew-select<?= $Grid->kd_poli->isInvalidClass() ?>"
        data-select2-id="prmrj_x<?= $Grid->RowIndex ?>_kd_poli"
        data-table="prmrj"
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
    var el = document.querySelector("select[data-select2-id='prmrj_x<?= $Grid->RowIndex ?>_kd_poli']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_poli", selectId: "prmrj_x<?= $Grid->RowIndex ?>_kd_poli", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.prmrj.fields.kd_poli.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_poli" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_poli" id="o<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_poli" class="form-group">
<span<?= $Grid->kd_poli->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_poli->getDisplayValue($Grid->kd_poli->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_poli" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_poli" id="x<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_poli">
<span<?= $Grid->kd_poli->viewAttributes() ?>>
<?= $Grid->kd_poli->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_poli" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_poli" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_kd_poli" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_poli" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_penyakit->Visible) { // kd_penyakit ?>
        <td data-name="kd_penyakit" <?= $Grid->kd_penyakit->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_penyakit" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_penyakit"><?= EmptyValue(strval($Grid->kd_penyakit->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_penyakit->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_penyakit->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_penyakit->ReadOnly || $Grid->kd_penyakit->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_penyakit',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_penyakit->getErrorMessage() ?></div>
<?= $Grid->kd_penyakit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_penyakit") ?>
<input type="hidden" is="selection-list" data-table="prmrj" data-field="x_kd_penyakit" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_penyakit->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= $Grid->kd_penyakit->CurrentValue ?>"<?= $Grid->kd_penyakit->editAttributes() ?>>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_penyakit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_penyakit" id="o<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_penyakit" class="form-group">
<span<?= $Grid->kd_penyakit->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_penyakit->getDisplayValue($Grid->kd_penyakit->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_penyakit" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_penyakit">
<span<?= $Grid->kd_penyakit->viewAttributes() ?>>
<?= $Grid->kd_penyakit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_penyakit" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_penyakit" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_kd_penyakit" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_penyakit" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->alergi->Visible) { // alergi ?>
        <td data-name="alergi" <?= $Grid->alergi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_alergi" class="form-group">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="prmrj" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="prmrj" data-field="x_alergi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_alergi" id="o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_alergi" class="form-group">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="prmrj" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_alergi">
<span<?= $Grid->alergi->viewAttributes() ?>>
<?= $Grid->alergi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_alergi" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_alergi" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_alergi" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_alergi" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Grid->kd_dokter->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_dokter" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_dokter"
        name="x<?= $Grid->RowIndex ?>_kd_dokter"
        class="form-control ew-select<?= $Grid->kd_dokter->isInvalidClass() ?>"
        data-select2-id="prmrj_x<?= $Grid->RowIndex ?>_kd_dokter"
        data-table="prmrj"
        data-field="x_kd_dokter"
        data-value-separator="<?= $Grid->kd_dokter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kd_dokter->getPlaceHolder()) ?>"
        <?= $Grid->kd_dokter->editAttributes() ?>>
        <?= $Grid->kd_dokter->selectOptionListHtml("x{$Grid->RowIndex}_kd_dokter") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kd_dokter->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='prmrj_x<?= $Grid->RowIndex ?>_kd_dokter']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_dokter", selectId: "prmrj_x<?= $Grid->RowIndex ?>_kd_dokter", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.prmrj.fields.kd_dokter.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.prmrj.fields.kd_dokter.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_dokter" id="o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_dokter" class="form-group">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_dokter->getDisplayValue($Grid->kd_dokter->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_dokter">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<?= $Grid->kd_dokter->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_dokter" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_dokter" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_kd_dokter" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_dokter" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kd_icd9->Visible) { // kd_icd9 ?>
        <td data-name="kd_icd9" <?= $Grid->kd_icd9->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_icd9" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_icd9"><?= EmptyValue(strval($Grid->kd_icd9->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_icd9->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_icd9->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_icd9->ReadOnly || $Grid->kd_icd9->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_icd9',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_icd9->getErrorMessage() ?></div>
<?= $Grid->kd_icd9->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_icd9") ?>
<input type="hidden" is="selection-list" data-table="prmrj" data-field="x_kd_icd9" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_icd9->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= $Grid->kd_icd9->CurrentValue ?>"<?= $Grid->kd_icd9->editAttributes() ?>>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_icd9" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_icd9" id="o<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_icd9" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_icd9"><?= EmptyValue(strval($Grid->kd_icd9->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_icd9->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_icd9->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_icd9->ReadOnly || $Grid->kd_icd9->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_icd9',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_icd9->getErrorMessage() ?></div>
<?= $Grid->kd_icd9->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_icd9") ?>
<input type="hidden" is="selection-list" data-table="prmrj" data-field="x_kd_icd9" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_icd9->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= $Grid->kd_icd9->CurrentValue ?>"<?= $Grid->kd_icd9->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_kd_icd9">
<span<?= $Grid->kd_icd9->viewAttributes() ?>>
<?= $Grid->kd_icd9->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_icd9" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_icd9" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_kd_icd9" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_icd9" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->cetak->Visible) { // cetak ?>
        <td data-name="cetak" <?= $Grid->cetak->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_cetak" class="form-group">
<textarea data-table="prmrj" data-field="x_cetak" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->cetak->getPlaceHolder()) ?>"<?= $Grid->cetak->editAttributes() ?>><?= $Grid->cetak->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->cetak->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="prmrj" data-field="x_cetak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_cetak" id="o<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_cetak" class="form-group">
<textarea data-table="prmrj" data-field="x_cetak" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->cetak->getPlaceHolder()) ?>"<?= $Grid->cetak->editAttributes() ?>><?= $Grid->cetak->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->cetak->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_prmrj_cetak">
<span<?= $Grid->cetak->viewAttributes() ?>><!--<button type="button" class="btn btn-primary">Cetak</button>-->
<a class="btn btn-info btn-sm"
	href="../PrmrjList"
target="_blank">Cetak</a>
</span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prmrj" data-field="x_cetak" data-hidden="1" name="fprmrjgrid$x<?= $Grid->RowIndex ?>_cetak" id="fprmrjgrid$x<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->FormValue) ?>">
<input type="hidden" data-table="prmrj" data-field="x_cetak" data-hidden="1" name="fprmrjgrid$o<?= $Grid->RowIndex ?>_cetak" id="fprmrjgrid$o<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->OldValue) ?>">
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
loadjs.ready(["fprmrjgrid","load"], function () {
    fprmrjgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_prmrj", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->no_rkm_medis->getSessionValue() != "") { ?>
<span id="el$rowindex$_prmrj_no_rkm_medis" class="form-group prmrj_no_rkm_medis">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_prmrj_no_rkm_medis" class="form-group prmrj_no_rkm_medis">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_no_rkm_medis"><?= EmptyValue(strval($Grid->no_rkm_medis->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->no_rkm_medis->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->no_rkm_medis->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->no_rkm_medis->ReadOnly || $Grid->no_rkm_medis->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_no_rkm_medis',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->no_rkm_medis->getErrorMessage() ?></div>
<?= $Grid->no_rkm_medis->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_no_rkm_medis") ?>
<input type="hidden" is="selection-list" data-table="prmrj" data-field="x_no_rkm_medis" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->no_rkm_medis->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= $Grid->no_rkm_medis->CurrentValue ?>"<?= $Grid->no_rkm_medis->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_prmrj_no_rkm_medis" class="form-group prmrj_no_rkm_medis">
<span<?= $Grid->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rkm_medis->getDisplayValue($Grid->no_rkm_medis->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_no_rkm_medis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rkm_medis" id="x<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_no_rkm_medis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rkm_medis" id="o<?= $Grid->RowIndex ?>_no_rkm_medis" value="<?= HtmlEncode($Grid->no_rkm_medis->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <td data-name="tgl_registrasi">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_prmrj_tgl_registrasi" class="form-group prmrj_tgl_registrasi">
<span<?= $Grid->tgl_registrasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_registrasi->getDisplayValue($Grid->tgl_registrasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_tgl_registrasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_registrasi" id="x<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_tgl_registrasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_registrasi" id="o<?= $Grid->RowIndex ?>_tgl_registrasi" value="<?= HtmlEncode($Grid->tgl_registrasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_poli->Visible) { // kd_poli ?>
        <td data-name="kd_poli">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_prmrj_kd_poli" class="form-group prmrj_kd_poli">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_poli"
        name="x<?= $Grid->RowIndex ?>_kd_poli"
        class="form-control ew-select<?= $Grid->kd_poli->isInvalidClass() ?>"
        data-select2-id="prmrj_x<?= $Grid->RowIndex ?>_kd_poli"
        data-table="prmrj"
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
    var el = document.querySelector("select[data-select2-id='prmrj_x<?= $Grid->RowIndex ?>_kd_poli']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_poli", selectId: "prmrj_x<?= $Grid->RowIndex ?>_kd_poli", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.prmrj.fields.kd_poli.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_prmrj_kd_poli" class="form-group prmrj_kd_poli">
<span<?= $Grid->kd_poli->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_poli->getDisplayValue($Grid->kd_poli->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_poli" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_poli" id="x<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_poli" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_poli" id="o<?= $Grid->RowIndex ?>_kd_poli" value="<?= HtmlEncode($Grid->kd_poli->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_penyakit->Visible) { // kd_penyakit ?>
        <td data-name="kd_penyakit">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_prmrj_kd_penyakit" class="form-group prmrj_kd_penyakit">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_penyakit"><?= EmptyValue(strval($Grid->kd_penyakit->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_penyakit->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_penyakit->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_penyakit->ReadOnly || $Grid->kd_penyakit->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_penyakit',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_penyakit->getErrorMessage() ?></div>
<?= $Grid->kd_penyakit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_penyakit") ?>
<input type="hidden" is="selection-list" data-table="prmrj" data-field="x_kd_penyakit" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_penyakit->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= $Grid->kd_penyakit->CurrentValue ?>"<?= $Grid->kd_penyakit->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_prmrj_kd_penyakit" class="form-group prmrj_kd_penyakit">
<span<?= $Grid->kd_penyakit->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_penyakit->getDisplayValue($Grid->kd_penyakit->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_penyakit" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_penyakit" id="x<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_penyakit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_penyakit" id="o<?= $Grid->RowIndex ?>_kd_penyakit" value="<?= HtmlEncode($Grid->kd_penyakit->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->alergi->Visible) { // alergi ?>
        <td data-name="alergi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_prmrj_alergi" class="form-group prmrj_alergi">
<input type="<?= $Grid->alergi->getInputTextType() ?>" data-table="prmrj" data-field="x_alergi" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Grid->alergi->getPlaceHolder()) ?>" value="<?= $Grid->alergi->EditValue ?>"<?= $Grid->alergi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->alergi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_prmrj_alergi" class="form-group prmrj_alergi">
<span<?= $Grid->alergi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->alergi->getDisplayValue($Grid->alergi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_alergi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_alergi" id="x<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_alergi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_alergi" id="o<?= $Grid->RowIndex ?>_alergi" value="<?= HtmlEncode($Grid->alergi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_prmrj_kd_dokter" class="form-group prmrj_kd_dokter">
    <select
        id="x<?= $Grid->RowIndex ?>_kd_dokter"
        name="x<?= $Grid->RowIndex ?>_kd_dokter"
        class="form-control ew-select<?= $Grid->kd_dokter->isInvalidClass() ?>"
        data-select2-id="prmrj_x<?= $Grid->RowIndex ?>_kd_dokter"
        data-table="prmrj"
        data-field="x_kd_dokter"
        data-value-separator="<?= $Grid->kd_dokter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kd_dokter->getPlaceHolder()) ?>"
        <?= $Grid->kd_dokter->editAttributes() ?>>
        <?= $Grid->kd_dokter->selectOptionListHtml("x{$Grid->RowIndex}_kd_dokter") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kd_dokter->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='prmrj_x<?= $Grid->RowIndex ?>_kd_dokter']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kd_dokter", selectId: "prmrj_x<?= $Grid->RowIndex ?>_kd_dokter", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.prmrj.fields.kd_dokter.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.prmrj.fields.kd_dokter.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_prmrj_kd_dokter" class="form-group prmrj_kd_dokter">
<span<?= $Grid->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_dokter->getDisplayValue($Grid->kd_dokter->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_dokter" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_dokter" id="x<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_dokter" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_dokter" id="o<?= $Grid->RowIndex ?>_kd_dokter" value="<?= HtmlEncode($Grid->kd_dokter->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kd_icd9->Visible) { // kd_icd9 ?>
        <td data-name="kd_icd9">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_prmrj_kd_icd9" class="form-group prmrj_kd_icd9">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_kd_icd9"><?= EmptyValue(strval($Grid->kd_icd9->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->kd_icd9->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->kd_icd9->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->kd_icd9->ReadOnly || $Grid->kd_icd9->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_kd_icd9',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->kd_icd9->getErrorMessage() ?></div>
<?= $Grid->kd_icd9->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kd_icd9") ?>
<input type="hidden" is="selection-list" data-table="prmrj" data-field="x_kd_icd9" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->kd_icd9->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= $Grid->kd_icd9->CurrentValue ?>"<?= $Grid->kd_icd9->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_prmrj_kd_icd9" class="form-group prmrj_kd_icd9">
<span<?= $Grid->kd_icd9->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kd_icd9->getDisplayValue($Grid->kd_icd9->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_kd_icd9" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kd_icd9" id="x<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_kd_icd9" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kd_icd9" id="o<?= $Grid->RowIndex ?>_kd_icd9" value="<?= HtmlEncode($Grid->kd_icd9->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->cetak->Visible) { // cetak ?>
        <td data-name="cetak">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_prmrj_cetak" class="form-group prmrj_cetak">
<textarea data-table="prmrj" data-field="x_cetak" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->cetak->getPlaceHolder()) ?>"<?= $Grid->cetak->editAttributes() ?>><?= $Grid->cetak->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->cetak->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_prmrj_cetak" class="form-group prmrj_cetak">
<span<?= $Grid->cetak->viewAttributes() ?>>
<?= $Grid->cetak->ViewValue ?></span>
</span>
<input type="hidden" data-table="prmrj" data-field="x_cetak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_cetak" id="x<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="prmrj" data-field="x_cetak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_cetak" id="o<?= $Grid->RowIndex ?>_cetak" value="<?= HtmlEncode($Grid->cetak->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fprmrjgrid","load"], function() {
    fprmrjgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fprmrjgrid">
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
    ew.addEventHandlers("prmrj");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
