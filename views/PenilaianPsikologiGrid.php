<?php

namespace PHPMaker2021\project4sikdec;

// Set up and run Grid object
$Grid = Container("PenilaianPsikologiGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_psikologigrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fpenilaian_psikologigrid = new ew.Form("fpenilaian_psikologigrid", "grid");
    fpenilaian_psikologigrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_psikologi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_psikologi)
        ew.vars.tables.penilaian_psikologi = currentTable;
    fpenilaian_psikologigrid.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(0)], fields.tanggal.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid],
        ["anamnesis", [fields.anamnesis.visible && fields.anamnesis.required ? ew.Validators.required(fields.anamnesis.caption) : null], fields.anamnesis.isInvalid],
        ["dikirim_dari", [fields.dikirim_dari.visible && fields.dikirim_dari.required ? ew.Validators.required(fields.dikirim_dari.caption) : null], fields.dikirim_dari.isInvalid],
        ["tujuan_pemeriksaan", [fields.tujuan_pemeriksaan.visible && fields.tujuan_pemeriksaan.required ? ew.Validators.required(fields.tujuan_pemeriksaan.caption) : null], fields.tujuan_pemeriksaan.isInvalid],
        ["rupa", [fields.rupa.visible && fields.rupa.required ? ew.Validators.required(fields.rupa.caption) : null], fields.rupa.isInvalid],
        ["bentuk_tubuh", [fields.bentuk_tubuh.visible && fields.bentuk_tubuh.required ? ew.Validators.required(fields.bentuk_tubuh.caption) : null], fields.bentuk_tubuh.isInvalid],
        ["tindakan", [fields.tindakan.visible && fields.tindakan.required ? ew.Validators.required(fields.tindakan.caption) : null], fields.tindakan.isInvalid],
        ["pakaian", [fields.pakaian.visible && fields.pakaian.required ? ew.Validators.required(fields.pakaian.caption) : null], fields.pakaian.isInvalid],
        ["ekspresi", [fields.ekspresi.visible && fields.ekspresi.required ? ew.Validators.required(fields.ekspresi.caption) : null], fields.ekspresi.isInvalid],
        ["berbicara", [fields.berbicara.visible && fields.berbicara.required ? ew.Validators.required(fields.berbicara.caption) : null], fields.berbicara.isInvalid],
        ["penggunaan_kata", [fields.penggunaan_kata.visible && fields.penggunaan_kata.required ? ew.Validators.required(fields.penggunaan_kata.caption) : null], fields.penggunaan_kata.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_psikologigrid,
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
    fpenilaian_psikologigrid.validate = function () {
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
    fpenilaian_psikologigrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "no_rawat", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tanggal", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nip", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "anamnesis", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "dikirim_dari", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tujuan_pemeriksaan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "rupa", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "bentuk_tubuh", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "tindakan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "pakaian", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ekspresi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "berbicara", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "penggunaan_kata", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpenilaian_psikologigrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_psikologigrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_psikologigrid.lists.anamnesis = <?= $Grid->anamnesis->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.dikirim_dari = <?= $Grid->dikirim_dari->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.tujuan_pemeriksaan = <?= $Grid->tujuan_pemeriksaan->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.rupa = <?= $Grid->rupa->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.bentuk_tubuh = <?= $Grid->bentuk_tubuh->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.tindakan = <?= $Grid->tindakan->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.pakaian = <?= $Grid->pakaian->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.ekspresi = <?= $Grid->ekspresi->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.berbicara = <?= $Grid->berbicara->toClientList($Grid) ?>;
    fpenilaian_psikologigrid.lists.penggunaan_kata = <?= $Grid->penggunaan_kata->toClientList($Grid) ?>;
    loadjs.done("fpenilaian_psikologigrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_psikologi">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpenilaian_psikologigrid" class="ew-form ew-list-form form-inline">
<div id="gmp_penilaian_psikologi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_penilaian_psikologigrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_rawat" class="<?= $Grid->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_psikologi_no_rawat" class="penilaian_psikologi_no_rawat"><?= $Grid->renderSort($Grid->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Grid->tanggal->headerCellClass() ?>"><div id="elh_penilaian_psikologi_tanggal" class="penilaian_psikologi_tanggal"><?= $Grid->renderSort($Grid->tanggal) ?></div></th>
<?php } ?>
<?php if ($Grid->nip->Visible) { // nip ?>
        <th data-name="nip" class="<?= $Grid->nip->headerCellClass() ?>"><div id="elh_penilaian_psikologi_nip" class="penilaian_psikologi_nip"><?= $Grid->renderSort($Grid->nip) ?></div></th>
<?php } ?>
<?php if ($Grid->anamnesis->Visible) { // anamnesis ?>
        <th data-name="anamnesis" class="<?= $Grid->anamnesis->headerCellClass() ?>"><div id="elh_penilaian_psikologi_anamnesis" class="penilaian_psikologi_anamnesis"><?= $Grid->renderSort($Grid->anamnesis) ?></div></th>
<?php } ?>
<?php if ($Grid->dikirim_dari->Visible) { // dikirim_dari ?>
        <th data-name="dikirim_dari" class="<?= $Grid->dikirim_dari->headerCellClass() ?>"><div id="elh_penilaian_psikologi_dikirim_dari" class="penilaian_psikologi_dikirim_dari"><?= $Grid->renderSort($Grid->dikirim_dari) ?></div></th>
<?php } ?>
<?php if ($Grid->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <th data-name="tujuan_pemeriksaan" class="<?= $Grid->tujuan_pemeriksaan->headerCellClass() ?>"><div id="elh_penilaian_psikologi_tujuan_pemeriksaan" class="penilaian_psikologi_tujuan_pemeriksaan"><?= $Grid->renderSort($Grid->tujuan_pemeriksaan) ?></div></th>
<?php } ?>
<?php if ($Grid->rupa->Visible) { // rupa ?>
        <th data-name="rupa" class="<?= $Grid->rupa->headerCellClass() ?>"><div id="elh_penilaian_psikologi_rupa" class="penilaian_psikologi_rupa"><?= $Grid->renderSort($Grid->rupa) ?></div></th>
<?php } ?>
<?php if ($Grid->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <th data-name="bentuk_tubuh" class="<?= $Grid->bentuk_tubuh->headerCellClass() ?>"><div id="elh_penilaian_psikologi_bentuk_tubuh" class="penilaian_psikologi_bentuk_tubuh"><?= $Grid->renderSort($Grid->bentuk_tubuh) ?></div></th>
<?php } ?>
<?php if ($Grid->tindakan->Visible) { // tindakan ?>
        <th data-name="tindakan" class="<?= $Grid->tindakan->headerCellClass() ?>"><div id="elh_penilaian_psikologi_tindakan" class="penilaian_psikologi_tindakan"><?= $Grid->renderSort($Grid->tindakan) ?></div></th>
<?php } ?>
<?php if ($Grid->pakaian->Visible) { // pakaian ?>
        <th data-name="pakaian" class="<?= $Grid->pakaian->headerCellClass() ?>"><div id="elh_penilaian_psikologi_pakaian" class="penilaian_psikologi_pakaian"><?= $Grid->renderSort($Grid->pakaian) ?></div></th>
<?php } ?>
<?php if ($Grid->ekspresi->Visible) { // ekspresi ?>
        <th data-name="ekspresi" class="<?= $Grid->ekspresi->headerCellClass() ?>"><div id="elh_penilaian_psikologi_ekspresi" class="penilaian_psikologi_ekspresi"><?= $Grid->renderSort($Grid->ekspresi) ?></div></th>
<?php } ?>
<?php if ($Grid->berbicara->Visible) { // berbicara ?>
        <th data-name="berbicara" class="<?= $Grid->berbicara->headerCellClass() ?>"><div id="elh_penilaian_psikologi_berbicara" class="penilaian_psikologi_berbicara"><?= $Grid->renderSort($Grid->berbicara) ?></div></th>
<?php } ?>
<?php if ($Grid->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <th data-name="penggunaan_kata" class="<?= $Grid->penggunaan_kata->headerCellClass() ?>"><div id="elh_penilaian_psikologi_penggunaan_kata" class="penilaian_psikologi_penggunaan_kata"><?= $Grid->renderSort($Grid->penggunaan_kata) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_penilaian_psikologi", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->no_rawat->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_no_rawat" class="form-group">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_no_rawat" class="form-group">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<?= $Grid->no_rawat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_no_rawat" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_no_rawat" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Grid->tanggal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tanggal" class="form-group">
<input type="<?= $Grid->tanggal->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_tanggal" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" placeholder="<?= HtmlEncode($Grid->tanggal->getPlaceHolder()) ?>" value="<?= $Grid->tanggal->EditValue ?>"<?= $Grid->tanggal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal->ReadOnly && !$Grid->tanggal->Disabled && !isset($Grid->tanggal->EditAttrs["readonly"]) && !isset($Grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_psikologigrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_psikologigrid", "x<?= $Grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tanggal" class="form-group">
<input type="<?= $Grid->tanggal->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_tanggal" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" placeholder="<?= HtmlEncode($Grid->tanggal->getPlaceHolder()) ?>" value="<?= $Grid->tanggal->EditValue ?>"<?= $Grid->tanggal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal->ReadOnly && !$Grid->tanggal->Disabled && !isset($Grid->tanggal->EditAttrs["readonly"]) && !isset($Grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_psikologigrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_psikologigrid", "x<?= $Grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<?= $Grid->tanggal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tanggal" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tanggal" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_tanggal" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nip->Visible) { // nip ?>
        <td data-name="nip" <?= $Grid->nip->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_nip" class="form-group">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_nip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nip" id="o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_nip" class="form-group">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_nip">
<span<?= $Grid->nip->viewAttributes() ?>>
<?= $Grid->nip->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_nip" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_nip" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_nip" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_nip" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->anamnesis->Visible) { // anamnesis ?>
        <td data-name="anamnesis" <?= $Grid->anamnesis->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_anamnesis" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_anamnesis" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis"<?= $Grid->anamnesis->editAttributes() ?>>
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
    data-table="penilaian_psikologi"
    data-field="x_anamnesis"
    data-value-separator="<?= $Grid->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Grid->anamnesis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->anamnesis->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_anamnesis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_anamnesis" id="o<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_anamnesis" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_anamnesis" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis"<?= $Grid->anamnesis->editAttributes() ?>>
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
    data-table="penilaian_psikologi"
    data-field="x_anamnesis"
    data-value-separator="<?= $Grid->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Grid->anamnesis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->anamnesis->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_anamnesis">
<span<?= $Grid->anamnesis->viewAttributes() ?>>
<?= $Grid->anamnesis->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_anamnesis" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_anamnesis" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_anamnesis" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_anamnesis" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->dikirim_dari->Visible) { // dikirim_dari ?>
        <td data-name="dikirim_dari" <?= $Grid->dikirim_dari->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_dikirim_dari" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_dikirim_dari">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_dikirim_dari" name="x<?= $Grid->RowIndex ?>_dikirim_dari" id="x<?= $Grid->RowIndex ?>_dikirim_dari"<?= $Grid->dikirim_dari->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_dikirim_dari" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_dikirim_dari"
    name="x<?= $Grid->RowIndex ?>_dikirim_dari"
    value="<?= HtmlEncode($Grid->dikirim_dari->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_dikirim_dari"
    data-target="dsl_x<?= $Grid->RowIndex ?>_dikirim_dari"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->dikirim_dari->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_dikirim_dari"
    data-value-separator="<?= $Grid->dikirim_dari->displayValueSeparatorAttribute() ?>"
    <?= $Grid->dikirim_dari->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dikirim_dari->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_dikirim_dari" data-hidden="1" name="o<?= $Grid->RowIndex ?>_dikirim_dari" id="o<?= $Grid->RowIndex ?>_dikirim_dari" value="<?= HtmlEncode($Grid->dikirim_dari->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_dikirim_dari" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_dikirim_dari">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_dikirim_dari" name="x<?= $Grid->RowIndex ?>_dikirim_dari" id="x<?= $Grid->RowIndex ?>_dikirim_dari"<?= $Grid->dikirim_dari->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_dikirim_dari" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_dikirim_dari"
    name="x<?= $Grid->RowIndex ?>_dikirim_dari"
    value="<?= HtmlEncode($Grid->dikirim_dari->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_dikirim_dari"
    data-target="dsl_x<?= $Grid->RowIndex ?>_dikirim_dari"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->dikirim_dari->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_dikirim_dari"
    data-value-separator="<?= $Grid->dikirim_dari->displayValueSeparatorAttribute() ?>"
    <?= $Grid->dikirim_dari->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dikirim_dari->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_dikirim_dari">
<span<?= $Grid->dikirim_dari->viewAttributes() ?>>
<?= $Grid->dikirim_dari->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_dikirim_dari" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_dikirim_dari" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_dikirim_dari" value="<?= HtmlEncode($Grid->dikirim_dari->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_dikirim_dari" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_dikirim_dari" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_dikirim_dari" value="<?= HtmlEncode($Grid->dikirim_dari->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <td data-name="tujuan_pemeriksaan" <?= $Grid->tujuan_pemeriksaan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tujuan_pemeriksaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" name="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"<?= $Grid->tujuan_pemeriksaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    name="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tujuan_pemeriksaan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tujuan_pemeriksaan"
    data-value-separator="<?= $Grid->tujuan_pemeriksaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tujuan_pemeriksaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tujuan_pemeriksaan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="o<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tujuan_pemeriksaan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" name="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"<?= $Grid->tujuan_pemeriksaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    name="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tujuan_pemeriksaan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tujuan_pemeriksaan"
    data-value-separator="<?= $Grid->tujuan_pemeriksaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tujuan_pemeriksaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tujuan_pemeriksaan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tujuan_pemeriksaan">
<span<?= $Grid->tujuan_pemeriksaan->viewAttributes() ?>>
<?= $Grid->tujuan_pemeriksaan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rupa->Visible) { // rupa ?>
        <td data-name="rupa" <?= $Grid->rupa->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_rupa" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rupa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_rupa" name="x<?= $Grid->RowIndex ?>_rupa" id="x<?= $Grid->RowIndex ?>_rupa"<?= $Grid->rupa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rupa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rupa"
    name="x<?= $Grid->RowIndex ?>_rupa"
    value="<?= HtmlEncode($Grid->rupa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rupa"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rupa"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rupa->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_rupa"
    data-value-separator="<?= $Grid->rupa->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rupa->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rupa->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_rupa" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rupa" id="o<?= $Grid->RowIndex ?>_rupa" value="<?= HtmlEncode($Grid->rupa->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_rupa" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_rupa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_rupa" name="x<?= $Grid->RowIndex ?>_rupa" id="x<?= $Grid->RowIndex ?>_rupa"<?= $Grid->rupa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rupa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rupa"
    name="x<?= $Grid->RowIndex ?>_rupa"
    value="<?= HtmlEncode($Grid->rupa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rupa"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rupa"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rupa->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_rupa"
    data-value-separator="<?= $Grid->rupa->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rupa->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rupa->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_rupa">
<span<?= $Grid->rupa->viewAttributes() ?>>
<?= $Grid->rupa->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_rupa" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_rupa" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_rupa" value="<?= HtmlEncode($Grid->rupa->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_rupa" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_rupa" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_rupa" value="<?= HtmlEncode($Grid->rupa->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <td data-name="bentuk_tubuh" <?= $Grid->bentuk_tubuh->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_bentuk_tubuh" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_bentuk_tubuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" name="x<?= $Grid->RowIndex ?>_bentuk_tubuh" id="x<?= $Grid->RowIndex ?>_bentuk_tubuh"<?= $Grid->bentuk_tubuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_bentuk_tubuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    name="x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    value="<?= HtmlEncode($Grid->bentuk_tubuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    data-target="dsl_x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->bentuk_tubuh->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_bentuk_tubuh"
    data-value-separator="<?= $Grid->bentuk_tubuh->displayValueSeparatorAttribute() ?>"
    <?= $Grid->bentuk_tubuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bentuk_tubuh->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bentuk_tubuh" id="o<?= $Grid->RowIndex ?>_bentuk_tubuh" value="<?= HtmlEncode($Grid->bentuk_tubuh->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_bentuk_tubuh" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_bentuk_tubuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" name="x<?= $Grid->RowIndex ?>_bentuk_tubuh" id="x<?= $Grid->RowIndex ?>_bentuk_tubuh"<?= $Grid->bentuk_tubuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_bentuk_tubuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    name="x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    value="<?= HtmlEncode($Grid->bentuk_tubuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    data-target="dsl_x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->bentuk_tubuh->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_bentuk_tubuh"
    data-value-separator="<?= $Grid->bentuk_tubuh->displayValueSeparatorAttribute() ?>"
    <?= $Grid->bentuk_tubuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bentuk_tubuh->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_bentuk_tubuh">
<span<?= $Grid->bentuk_tubuh->viewAttributes() ?>>
<?= $Grid->bentuk_tubuh->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_bentuk_tubuh" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_bentuk_tubuh" value="<?= HtmlEncode($Grid->bentuk_tubuh->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_bentuk_tubuh" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_bentuk_tubuh" value="<?= HtmlEncode($Grid->bentuk_tubuh->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tindakan->Visible) { // tindakan ?>
        <td data-name="tindakan" <?= $Grid->tindakan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tindakan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_tindakan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tindakan" name="x<?= $Grid->RowIndex ?>_tindakan" id="x<?= $Grid->RowIndex ?>_tindakan"<?= $Grid->tindakan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tindakan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tindakan"
    name="x<?= $Grid->RowIndex ?>_tindakan"
    value="<?= HtmlEncode($Grid->tindakan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tindakan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tindakan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tindakan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tindakan"
    data-value-separator="<?= $Grid->tindakan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tindakan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tindakan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tindakan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tindakan" id="o<?= $Grid->RowIndex ?>_tindakan" value="<?= HtmlEncode($Grid->tindakan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tindakan" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_tindakan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tindakan" name="x<?= $Grid->RowIndex ?>_tindakan" id="x<?= $Grid->RowIndex ?>_tindakan"<?= $Grid->tindakan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tindakan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tindakan"
    name="x<?= $Grid->RowIndex ?>_tindakan"
    value="<?= HtmlEncode($Grid->tindakan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tindakan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tindakan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tindakan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tindakan"
    data-value-separator="<?= $Grid->tindakan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tindakan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tindakan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_tindakan">
<span<?= $Grid->tindakan->viewAttributes() ?>>
<?= $Grid->tindakan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tindakan" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_tindakan" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_tindakan" value="<?= HtmlEncode($Grid->tindakan->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tindakan" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_tindakan" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_tindakan" value="<?= HtmlEncode($Grid->tindakan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pakaian->Visible) { // pakaian ?>
        <td data-name="pakaian" <?= $Grid->pakaian->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_pakaian" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_pakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_pakaian" name="x<?= $Grid->RowIndex ?>_pakaian" id="x<?= $Grid->RowIndex ?>_pakaian"<?= $Grid->pakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pakaian"
    name="x<?= $Grid->RowIndex ?>_pakaian"
    value="<?= HtmlEncode($Grid->pakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pakaian"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pakaian->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_pakaian"
    data-value-separator="<?= $Grid->pakaian->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pakaian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_pakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pakaian" id="o<?= $Grid->RowIndex ?>_pakaian" value="<?= HtmlEncode($Grid->pakaian->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_pakaian" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_pakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_pakaian" name="x<?= $Grid->RowIndex ?>_pakaian" id="x<?= $Grid->RowIndex ?>_pakaian"<?= $Grid->pakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pakaian"
    name="x<?= $Grid->RowIndex ?>_pakaian"
    value="<?= HtmlEncode($Grid->pakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pakaian"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pakaian->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_pakaian"
    data-value-separator="<?= $Grid->pakaian->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pakaian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_pakaian">
<span<?= $Grid->pakaian->viewAttributes() ?>>
<?= $Grid->pakaian->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_pakaian" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_pakaian" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_pakaian" value="<?= HtmlEncode($Grid->pakaian->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_pakaian" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_pakaian" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_pakaian" value="<?= HtmlEncode($Grid->pakaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ekspresi->Visible) { // ekspresi ?>
        <td data-name="ekspresi" <?= $Grid->ekspresi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_ekspresi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_ekspresi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_ekspresi" name="x<?= $Grid->RowIndex ?>_ekspresi" id="x<?= $Grid->RowIndex ?>_ekspresi"<?= $Grid->ekspresi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_ekspresi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_ekspresi"
    name="x<?= $Grid->RowIndex ?>_ekspresi"
    value="<?= HtmlEncode($Grid->ekspresi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_ekspresi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_ekspresi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->ekspresi->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_ekspresi"
    data-value-separator="<?= $Grid->ekspresi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->ekspresi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ekspresi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_ekspresi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ekspresi" id="o<?= $Grid->RowIndex ?>_ekspresi" value="<?= HtmlEncode($Grid->ekspresi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_ekspresi" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_ekspresi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_ekspresi" name="x<?= $Grid->RowIndex ?>_ekspresi" id="x<?= $Grid->RowIndex ?>_ekspresi"<?= $Grid->ekspresi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_ekspresi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_ekspresi"
    name="x<?= $Grid->RowIndex ?>_ekspresi"
    value="<?= HtmlEncode($Grid->ekspresi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_ekspresi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_ekspresi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->ekspresi->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_ekspresi"
    data-value-separator="<?= $Grid->ekspresi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->ekspresi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ekspresi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_ekspresi">
<span<?= $Grid->ekspresi->viewAttributes() ?>>
<?= $Grid->ekspresi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_ekspresi" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_ekspresi" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_ekspresi" value="<?= HtmlEncode($Grid->ekspresi->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_ekspresi" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_ekspresi" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_ekspresi" value="<?= HtmlEncode($Grid->ekspresi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->berbicara->Visible) { // berbicara ?>
        <td data-name="berbicara" <?= $Grid->berbicara->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_berbicara" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_berbicara">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_berbicara" name="x<?= $Grid->RowIndex ?>_berbicara" id="x<?= $Grid->RowIndex ?>_berbicara"<?= $Grid->berbicara->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_berbicara" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_berbicara"
    name="x<?= $Grid->RowIndex ?>_berbicara"
    value="<?= HtmlEncode($Grid->berbicara->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_berbicara"
    data-target="dsl_x<?= $Grid->RowIndex ?>_berbicara"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->berbicara->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_berbicara"
    data-value-separator="<?= $Grid->berbicara->displayValueSeparatorAttribute() ?>"
    <?= $Grid->berbicara->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->berbicara->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_berbicara" data-hidden="1" name="o<?= $Grid->RowIndex ?>_berbicara" id="o<?= $Grid->RowIndex ?>_berbicara" value="<?= HtmlEncode($Grid->berbicara->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_berbicara" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_berbicara">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_berbicara" name="x<?= $Grid->RowIndex ?>_berbicara" id="x<?= $Grid->RowIndex ?>_berbicara"<?= $Grid->berbicara->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_berbicara" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_berbicara"
    name="x<?= $Grid->RowIndex ?>_berbicara"
    value="<?= HtmlEncode($Grid->berbicara->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_berbicara"
    data-target="dsl_x<?= $Grid->RowIndex ?>_berbicara"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->berbicara->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_berbicara"
    data-value-separator="<?= $Grid->berbicara->displayValueSeparatorAttribute() ?>"
    <?= $Grid->berbicara->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->berbicara->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_berbicara">
<span<?= $Grid->berbicara->viewAttributes() ?>>
<?= $Grid->berbicara->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_berbicara" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_berbicara" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_berbicara" value="<?= HtmlEncode($Grid->berbicara->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_berbicara" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_berbicara" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_berbicara" value="<?= HtmlEncode($Grid->berbicara->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <td data-name="penggunaan_kata" <?= $Grid->penggunaan_kata->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_penggunaan_kata" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_penggunaan_kata">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" name="x<?= $Grid->RowIndex ?>_penggunaan_kata" id="x<?= $Grid->RowIndex ?>_penggunaan_kata"<?= $Grid->penggunaan_kata->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_penggunaan_kata" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_penggunaan_kata"
    name="x<?= $Grid->RowIndex ?>_penggunaan_kata"
    value="<?= HtmlEncode($Grid->penggunaan_kata->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_penggunaan_kata"
    data-target="dsl_x<?= $Grid->RowIndex ?>_penggunaan_kata"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->penggunaan_kata->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_penggunaan_kata"
    data-value-separator="<?= $Grid->penggunaan_kata->displayValueSeparatorAttribute() ?>"
    <?= $Grid->penggunaan_kata->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->penggunaan_kata->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" data-hidden="1" name="o<?= $Grid->RowIndex ?>_penggunaan_kata" id="o<?= $Grid->RowIndex ?>_penggunaan_kata" value="<?= HtmlEncode($Grid->penggunaan_kata->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_penggunaan_kata" class="form-group">
<template id="tp_x<?= $Grid->RowIndex ?>_penggunaan_kata">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" name="x<?= $Grid->RowIndex ?>_penggunaan_kata" id="x<?= $Grid->RowIndex ?>_penggunaan_kata"<?= $Grid->penggunaan_kata->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_penggunaan_kata" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_penggunaan_kata"
    name="x<?= $Grid->RowIndex ?>_penggunaan_kata"
    value="<?= HtmlEncode($Grid->penggunaan_kata->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_penggunaan_kata"
    data-target="dsl_x<?= $Grid->RowIndex ?>_penggunaan_kata"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->penggunaan_kata->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_penggunaan_kata"
    data-value-separator="<?= $Grid->penggunaan_kata->displayValueSeparatorAttribute() ?>"
    <?= $Grid->penggunaan_kata->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->penggunaan_kata->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penilaian_psikologi_penggunaan_kata">
<span<?= $Grid->penggunaan_kata->viewAttributes() ?>>
<?= $Grid->penggunaan_kata->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" data-hidden="1" name="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_penggunaan_kata" id="fpenilaian_psikologigrid$x<?= $Grid->RowIndex ?>_penggunaan_kata" value="<?= HtmlEncode($Grid->penggunaan_kata->FormValue) ?>">
<input type="hidden" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" data-hidden="1" name="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_penggunaan_kata" id="fpenilaian_psikologigrid$o<?= $Grid->RowIndex ?>_penggunaan_kata" value="<?= HtmlEncode($Grid->penggunaan_kata->OldValue) ?>">
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
loadjs.ready(["fpenilaian_psikologigrid","load"], function () {
    fpenilaian_psikologigrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_penilaian_psikologi", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_penilaian_psikologi_no_rawat" class="form-group penilaian_psikologi_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_no_rawat" class="form-group penilaian_psikologi_no_rawat">
<input type="<?= $Grid->no_rawat->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_no_rawat" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Grid->no_rawat->getPlaceHolder()) ?>" value="<?= $Grid->no_rawat->EditValue ?>"<?= $Grid->no_rawat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_no_rawat" class="form-group penilaian_psikologi_no_rawat">
<span<?= $Grid->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_rawat->getDisplayValue($Grid->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_no_rawat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_rawat" id="x<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_no_rawat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_rawat" id="o<?= $Grid->RowIndex ?>_no_rawat" value="<?= HtmlEncode($Grid->no_rawat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_tanggal" class="form-group penilaian_psikologi_tanggal">
<input type="<?= $Grid->tanggal->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_tanggal" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" placeholder="<?= HtmlEncode($Grid->tanggal->getPlaceHolder()) ?>" value="<?= $Grid->tanggal->EditValue ?>"<?= $Grid->tanggal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggal->getErrorMessage() ?></div>
<?php if (!$Grid->tanggal->ReadOnly && !$Grid->tanggal->Disabled && !isset($Grid->tanggal->EditAttrs["readonly"]) && !isset($Grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_psikologigrid", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_psikologigrid", "x<?= $Grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_tanggal" class="form-group penilaian_psikologi_tanggal">
<span<?= $Grid->tanggal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggal->getDisplayValue($Grid->tanggal->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tanggal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggal" id="x<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tanggal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal" id="o<?= $Grid->RowIndex ?>_tanggal" value="<?= HtmlEncode($Grid->tanggal->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nip->Visible) { // nip ?>
        <td data-name="nip">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_nip" class="form-group penilaian_psikologi_nip">
<input type="<?= $Grid->nip->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_nip" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->nip->getPlaceHolder()) ?>" value="<?= $Grid->nip->EditValue ?>"<?= $Grid->nip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nip->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_nip" class="form-group penilaian_psikologi_nip">
<span<?= $Grid->nip->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nip->getDisplayValue($Grid->nip->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_nip" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nip" id="x<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_nip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nip" id="o<?= $Grid->RowIndex ?>_nip" value="<?= HtmlEncode($Grid->nip->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->anamnesis->Visible) { // anamnesis ?>
        <td data-name="anamnesis">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_anamnesis" class="form-group penilaian_psikologi_anamnesis">
<template id="tp_x<?= $Grid->RowIndex ?>_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_anamnesis" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis"<?= $Grid->anamnesis->editAttributes() ?>>
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
    data-table="penilaian_psikologi"
    data-field="x_anamnesis"
    data-value-separator="<?= $Grid->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Grid->anamnesis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->anamnesis->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_anamnesis" class="form-group penilaian_psikologi_anamnesis">
<span<?= $Grid->anamnesis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->anamnesis->getDisplayValue($Grid->anamnesis->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_anamnesis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_anamnesis" id="x<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_anamnesis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_anamnesis" id="o<?= $Grid->RowIndex ?>_anamnesis" value="<?= HtmlEncode($Grid->anamnesis->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->dikirim_dari->Visible) { // dikirim_dari ?>
        <td data-name="dikirim_dari">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_dikirim_dari" class="form-group penilaian_psikologi_dikirim_dari">
<template id="tp_x<?= $Grid->RowIndex ?>_dikirim_dari">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_dikirim_dari" name="x<?= $Grid->RowIndex ?>_dikirim_dari" id="x<?= $Grid->RowIndex ?>_dikirim_dari"<?= $Grid->dikirim_dari->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_dikirim_dari" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_dikirim_dari"
    name="x<?= $Grid->RowIndex ?>_dikirim_dari"
    value="<?= HtmlEncode($Grid->dikirim_dari->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_dikirim_dari"
    data-target="dsl_x<?= $Grid->RowIndex ?>_dikirim_dari"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->dikirim_dari->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_dikirim_dari"
    data-value-separator="<?= $Grid->dikirim_dari->displayValueSeparatorAttribute() ?>"
    <?= $Grid->dikirim_dari->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dikirim_dari->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_dikirim_dari" class="form-group penilaian_psikologi_dikirim_dari">
<span<?= $Grid->dikirim_dari->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->dikirim_dari->getDisplayValue($Grid->dikirim_dari->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_dikirim_dari" data-hidden="1" name="x<?= $Grid->RowIndex ?>_dikirim_dari" id="x<?= $Grid->RowIndex ?>_dikirim_dari" value="<?= HtmlEncode($Grid->dikirim_dari->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_dikirim_dari" data-hidden="1" name="o<?= $Grid->RowIndex ?>_dikirim_dari" id="o<?= $Grid->RowIndex ?>_dikirim_dari" value="<?= HtmlEncode($Grid->dikirim_dari->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <td data-name="tujuan_pemeriksaan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_tujuan_pemeriksaan" class="form-group penilaian_psikologi_tujuan_pemeriksaan">
<template id="tp_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" name="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"<?= $Grid->tujuan_pemeriksaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    name="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tujuan_pemeriksaan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tujuan_pemeriksaan"
    data-value-separator="<?= $Grid->tujuan_pemeriksaan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tujuan_pemeriksaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tujuan_pemeriksaan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_tujuan_pemeriksaan" class="form-group penilaian_psikologi_tujuan_pemeriksaan">
<span<?= $Grid->tujuan_pemeriksaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tujuan_pemeriksaan->getDisplayValue($Grid->tujuan_pemeriksaan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="x<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" id="o<?= $Grid->RowIndex ?>_tujuan_pemeriksaan" value="<?= HtmlEncode($Grid->tujuan_pemeriksaan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rupa->Visible) { // rupa ?>
        <td data-name="rupa">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_rupa" class="form-group penilaian_psikologi_rupa">
<template id="tp_x<?= $Grid->RowIndex ?>_rupa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_rupa" name="x<?= $Grid->RowIndex ?>_rupa" id="x<?= $Grid->RowIndex ?>_rupa"<?= $Grid->rupa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_rupa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_rupa"
    name="x<?= $Grid->RowIndex ?>_rupa"
    value="<?= HtmlEncode($Grid->rupa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_rupa"
    data-target="dsl_x<?= $Grid->RowIndex ?>_rupa"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->rupa->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_rupa"
    data-value-separator="<?= $Grid->rupa->displayValueSeparatorAttribute() ?>"
    <?= $Grid->rupa->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rupa->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_rupa" class="form-group penilaian_psikologi_rupa">
<span<?= $Grid->rupa->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rupa->getDisplayValue($Grid->rupa->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_rupa" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rupa" id="x<?= $Grid->RowIndex ?>_rupa" value="<?= HtmlEncode($Grid->rupa->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_rupa" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rupa" id="o<?= $Grid->RowIndex ?>_rupa" value="<?= HtmlEncode($Grid->rupa->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <td data-name="bentuk_tubuh">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_bentuk_tubuh" class="form-group penilaian_psikologi_bentuk_tubuh">
<template id="tp_x<?= $Grid->RowIndex ?>_bentuk_tubuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" name="x<?= $Grid->RowIndex ?>_bentuk_tubuh" id="x<?= $Grid->RowIndex ?>_bentuk_tubuh"<?= $Grid->bentuk_tubuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_bentuk_tubuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    name="x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    value="<?= HtmlEncode($Grid->bentuk_tubuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    data-target="dsl_x<?= $Grid->RowIndex ?>_bentuk_tubuh"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->bentuk_tubuh->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_bentuk_tubuh"
    data-value-separator="<?= $Grid->bentuk_tubuh->displayValueSeparatorAttribute() ?>"
    <?= $Grid->bentuk_tubuh->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bentuk_tubuh->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_bentuk_tubuh" class="form-group penilaian_psikologi_bentuk_tubuh">
<span<?= $Grid->bentuk_tubuh->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->bentuk_tubuh->getDisplayValue($Grid->bentuk_tubuh->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" data-hidden="1" name="x<?= $Grid->RowIndex ?>_bentuk_tubuh" id="x<?= $Grid->RowIndex ?>_bentuk_tubuh" value="<?= HtmlEncode($Grid->bentuk_tubuh->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bentuk_tubuh" id="o<?= $Grid->RowIndex ?>_bentuk_tubuh" value="<?= HtmlEncode($Grid->bentuk_tubuh->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tindakan->Visible) { // tindakan ?>
        <td data-name="tindakan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_tindakan" class="form-group penilaian_psikologi_tindakan">
<template id="tp_x<?= $Grid->RowIndex ?>_tindakan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tindakan" name="x<?= $Grid->RowIndex ?>_tindakan" id="x<?= $Grid->RowIndex ?>_tindakan"<?= $Grid->tindakan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_tindakan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_tindakan"
    name="x<?= $Grid->RowIndex ?>_tindakan"
    value="<?= HtmlEncode($Grid->tindakan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_tindakan"
    data-target="dsl_x<?= $Grid->RowIndex ?>_tindakan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->tindakan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tindakan"
    data-value-separator="<?= $Grid->tindakan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->tindakan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tindakan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_tindakan" class="form-group penilaian_psikologi_tindakan">
<span<?= $Grid->tindakan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tindakan->getDisplayValue($Grid->tindakan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tindakan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tindakan" id="x<?= $Grid->RowIndex ?>_tindakan" value="<?= HtmlEncode($Grid->tindakan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_tindakan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tindakan" id="o<?= $Grid->RowIndex ?>_tindakan" value="<?= HtmlEncode($Grid->tindakan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->pakaian->Visible) { // pakaian ?>
        <td data-name="pakaian">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_pakaian" class="form-group penilaian_psikologi_pakaian">
<template id="tp_x<?= $Grid->RowIndex ?>_pakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_pakaian" name="x<?= $Grid->RowIndex ?>_pakaian" id="x<?= $Grid->RowIndex ?>_pakaian"<?= $Grid->pakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_pakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_pakaian"
    name="x<?= $Grid->RowIndex ?>_pakaian"
    value="<?= HtmlEncode($Grid->pakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_pakaian"
    data-target="dsl_x<?= $Grid->RowIndex ?>_pakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->pakaian->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_pakaian"
    data-value-separator="<?= $Grid->pakaian->displayValueSeparatorAttribute() ?>"
    <?= $Grid->pakaian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pakaian->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_pakaian" class="form-group penilaian_psikologi_pakaian">
<span<?= $Grid->pakaian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pakaian->getDisplayValue($Grid->pakaian->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_pakaian" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pakaian" id="x<?= $Grid->RowIndex ?>_pakaian" value="<?= HtmlEncode($Grid->pakaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_pakaian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pakaian" id="o<?= $Grid->RowIndex ?>_pakaian" value="<?= HtmlEncode($Grid->pakaian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ekspresi->Visible) { // ekspresi ?>
        <td data-name="ekspresi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_ekspresi" class="form-group penilaian_psikologi_ekspresi">
<template id="tp_x<?= $Grid->RowIndex ?>_ekspresi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_ekspresi" name="x<?= $Grid->RowIndex ?>_ekspresi" id="x<?= $Grid->RowIndex ?>_ekspresi"<?= $Grid->ekspresi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_ekspresi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_ekspresi"
    name="x<?= $Grid->RowIndex ?>_ekspresi"
    value="<?= HtmlEncode($Grid->ekspresi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_ekspresi"
    data-target="dsl_x<?= $Grid->RowIndex ?>_ekspresi"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->ekspresi->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_ekspresi"
    data-value-separator="<?= $Grid->ekspresi->displayValueSeparatorAttribute() ?>"
    <?= $Grid->ekspresi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ekspresi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_ekspresi" class="form-group penilaian_psikologi_ekspresi">
<span<?= $Grid->ekspresi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ekspresi->getDisplayValue($Grid->ekspresi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_ekspresi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ekspresi" id="x<?= $Grid->RowIndex ?>_ekspresi" value="<?= HtmlEncode($Grid->ekspresi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_ekspresi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ekspresi" id="o<?= $Grid->RowIndex ?>_ekspresi" value="<?= HtmlEncode($Grid->ekspresi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->berbicara->Visible) { // berbicara ?>
        <td data-name="berbicara">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_berbicara" class="form-group penilaian_psikologi_berbicara">
<template id="tp_x<?= $Grid->RowIndex ?>_berbicara">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_berbicara" name="x<?= $Grid->RowIndex ?>_berbicara" id="x<?= $Grid->RowIndex ?>_berbicara"<?= $Grid->berbicara->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_berbicara" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_berbicara"
    name="x<?= $Grid->RowIndex ?>_berbicara"
    value="<?= HtmlEncode($Grid->berbicara->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_berbicara"
    data-target="dsl_x<?= $Grid->RowIndex ?>_berbicara"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->berbicara->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_berbicara"
    data-value-separator="<?= $Grid->berbicara->displayValueSeparatorAttribute() ?>"
    <?= $Grid->berbicara->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->berbicara->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_berbicara" class="form-group penilaian_psikologi_berbicara">
<span<?= $Grid->berbicara->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->berbicara->getDisplayValue($Grid->berbicara->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_berbicara" data-hidden="1" name="x<?= $Grid->RowIndex ?>_berbicara" id="x<?= $Grid->RowIndex ?>_berbicara" value="<?= HtmlEncode($Grid->berbicara->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_berbicara" data-hidden="1" name="o<?= $Grid->RowIndex ?>_berbicara" id="o<?= $Grid->RowIndex ?>_berbicara" value="<?= HtmlEncode($Grid->berbicara->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <td data-name="penggunaan_kata">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penilaian_psikologi_penggunaan_kata" class="form-group penilaian_psikologi_penggunaan_kata">
<template id="tp_x<?= $Grid->RowIndex ?>_penggunaan_kata">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" name="x<?= $Grid->RowIndex ?>_penggunaan_kata" id="x<?= $Grid->RowIndex ?>_penggunaan_kata"<?= $Grid->penggunaan_kata->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_penggunaan_kata" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x<?= $Grid->RowIndex ?>_penggunaan_kata"
    name="x<?= $Grid->RowIndex ?>_penggunaan_kata"
    value="<?= HtmlEncode($Grid->penggunaan_kata->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_penggunaan_kata"
    data-target="dsl_x<?= $Grid->RowIndex ?>_penggunaan_kata"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->penggunaan_kata->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_penggunaan_kata"
    data-value-separator="<?= $Grid->penggunaan_kata->displayValueSeparatorAttribute() ?>"
    <?= $Grid->penggunaan_kata->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->penggunaan_kata->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penilaian_psikologi_penggunaan_kata" class="form-group penilaian_psikologi_penggunaan_kata">
<span<?= $Grid->penggunaan_kata->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->penggunaan_kata->getDisplayValue($Grid->penggunaan_kata->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" data-hidden="1" name="x<?= $Grid->RowIndex ?>_penggunaan_kata" id="x<?= $Grid->RowIndex ?>_penggunaan_kata" value="<?= HtmlEncode($Grid->penggunaan_kata->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" data-hidden="1" name="o<?= $Grid->RowIndex ?>_penggunaan_kata" id="o<?= $Grid->RowIndex ?>_penggunaan_kata" value="<?= HtmlEncode($Grid->penggunaan_kata->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpenilaian_psikologigrid","load"], function() {
    fpenilaian_psikologigrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fpenilaian_psikologigrid">
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
    ew.addEventHandlers("penilaian_psikologi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
