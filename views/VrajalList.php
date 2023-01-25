<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$VrajalList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fvrajallist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fvrajallist = currentForm = new ew.Form("fvrajallist", "list");
    fvrajallist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fvrajallist");
});
var fvrajallistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fvrajallistsrch = currentSearchForm = new ew.Form("fvrajallistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "vrajal")) ?>,
        fields = currentTable.fields;
    fvrajallistsrch.addFields([
        ["id_reg", [], fields.id_reg.isInvalid],
        ["no_rkm_medis", [], fields.no_rkm_medis.isInvalid],
        ["kd_poli", [], fields.kd_poli.isInvalid],
        ["kd_dokter", [], fields.kd_dokter.isInvalid],
        ["tgl_registrasi", [ew.Validators.datetime(7)], fields.tgl_registrasi.isInvalid],
        ["jam_reg", [], fields.jam_reg.isInvalid],
        ["stts", [], fields.stts.isInvalid],
        ["status_lanjut", [], fields.status_lanjut.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fvrajallistsrch.setInvalid();
    });

    // Validate form
    fvrajallistsrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fvrajallistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvrajallistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fvrajallistsrch.lists.kd_poli = <?= $Page->kd_poli->toClientList($Page) ?>;

    // Filters
    fvrajallistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fvrajallistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
    background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
    display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
    <div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
        <ul class="nav nav-tabs"></ul>
        <div class="tab-content"><!-- .tab-content -->
            <div class="tab-pane fade active show"></div>
        </div><!-- /.tab-content -->
    </div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
    ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
    ew.PREVIEW_SINGLE_ROW = false;
    ew.PREVIEW_OVERLAY = false;
    loadjs(ew.PATH_BASE + "js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fvrajallistsrch" id="fvrajallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fvrajallistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vrajal">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_kd_poli" class="ew-cell form-group">
        <label for="x_kd_poli" class="ew-search-caption ew-label"><?= $Page->kd_poli->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kd_poli" id="z_kd_poli" value="LIKE">
</span>
        <span id="el_vrajal_kd_poli" class="ew-search-field">
    <select
        id="x_kd_poli"
        name="x_kd_poli"
        class="form-control ew-select<?= $Page->kd_poli->isInvalidClass() ?>"
        data-select2-id="vrajal_x_kd_poli"
        data-table="vrajal"
        data-field="x_kd_poli"
        data-value-separator="<?= $Page->kd_poli->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_poli->getPlaceHolder()) ?>"
        <?= $Page->kd_poli->editAttributes() ?>>
        <?= $Page->kd_poli->selectOptionListHtml("x_kd_poli") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->kd_poli->getErrorMessage(false) ?></div>
<?= $Page->kd_poli->Lookup->getParamTag($Page, "p_x_kd_poli") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vrajal_x_kd_poli']"),
        options = { name: "x_kd_poli", selectId: "vrajal_x_kd_poli", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vrajal.fields.kd_poli.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_tgl_registrasi" class="ew-cell form-group">
        <label for="x_tgl_registrasi" class="ew-search-caption ew-label"><?= $Page->tgl_registrasi->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_registrasi" id="z_tgl_registrasi" value="=">
</span>
        <span id="el_vrajal_tgl_registrasi" class="ew-search-field">
<input type="<?= $Page->tgl_registrasi->getInputTextType() ?>" data-table="vrajal" data-field="x_tgl_registrasi" data-format="7" name="x_tgl_registrasi" id="x_tgl_registrasi" placeholder="<?= HtmlEncode($Page->tgl_registrasi->getPlaceHolder()) ?>" value="<?= $Page->tgl_registrasi->EditValue ?>"<?= $Page->tgl_registrasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->tgl_registrasi->getErrorMessage(false) ?></div>
<?php if (!$Page->tgl_registrasi->ReadOnly && !$Page->tgl_registrasi->Disabled && !isset($Page->tgl_registrasi->EditAttrs["readonly"]) && !isset($Page->tgl_registrasi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvrajallistsrch", "datetimepicker"], function() {
    ew.createDateTimePicker("fvrajallistsrch", "x_tgl_registrasi", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow > 0) { ?>
</div>
    <?php } ?>
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vrajal">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvrajallist" id="fvrajallist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vrajal">
<div id="gmp_vrajal" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_vrajallist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id_reg->Visible) { // id_reg ?>
        <th data-name="id_reg" class="<?= $Page->id_reg->headerCellClass() ?>"><div id="elh_vrajal_id_reg" class="vrajal_id_reg"><?= $Page->renderSort($Page->id_reg) ?></div></th>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th data-name="no_rkm_medis" class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><div id="elh_vrajal_no_rkm_medis" class="vrajal_no_rkm_medis"><?= $Page->renderSort($Page->no_rkm_medis) ?></div></th>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <th data-name="kd_poli" class="<?= $Page->kd_poli->headerCellClass() ?>"><div id="elh_vrajal_kd_poli" class="vrajal_kd_poli"><?= $Page->renderSort($Page->kd_poli) ?></div></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Page->kd_dokter->headerCellClass() ?>"><div id="elh_vrajal_kd_dokter" class="vrajal_kd_dokter"><?= $Page->renderSort($Page->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <th data-name="tgl_registrasi" class="<?= $Page->tgl_registrasi->headerCellClass() ?>"><div id="elh_vrajal_tgl_registrasi" class="vrajal_tgl_registrasi"><?= $Page->renderSort($Page->tgl_registrasi) ?></div></th>
<?php } ?>
<?php if ($Page->jam_reg->Visible) { // jam_reg ?>
        <th data-name="jam_reg" class="<?= $Page->jam_reg->headerCellClass() ?>"><div id="elh_vrajal_jam_reg" class="vrajal_jam_reg"><?= $Page->renderSort($Page->jam_reg) ?></div></th>
<?php } ?>
<?php if ($Page->stts->Visible) { // stts ?>
        <th data-name="stts" class="<?= $Page->stts->headerCellClass() ?>"><div id="elh_vrajal_stts" class="vrajal_stts"><?= $Page->renderSort($Page->stts) ?></div></th>
<?php } ?>
<?php if ($Page->status_lanjut->Visible) { // status_lanjut ?>
        <th data-name="status_lanjut" class="<?= $Page->status_lanjut->headerCellClass() ?>"><div id="elh_vrajal_status_lanjut" class="vrajal_status_lanjut"><?= $Page->renderSort($Page->status_lanjut) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_vrajal", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id_reg->Visible) { // id_reg ?>
        <td data-name="id_reg" <?= $Page->id_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_id_reg">
<span<?= $Page->id_reg->viewAttributes() ?>>
<?= $Page->id_reg->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <td data-name="kd_poli" <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <td data-name="tgl_registrasi" <?= $Page->tgl_registrasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_tgl_registrasi">
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jam_reg->Visible) { // jam_reg ?>
        <td data-name="jam_reg" <?= $Page->jam_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_jam_reg">
<span<?= $Page->jam_reg->viewAttributes() ?>>
<?= $Page->jam_reg->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->stts->Visible) { // stts ?>
        <td data-name="stts" <?= $Page->stts->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_stts">
<span<?= $Page->stts->viewAttributes() ?>>
<?= $Page->stts->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status_lanjut->Visible) { // status_lanjut ?>
        <td data-name="status_lanjut" <?= $Page->status_lanjut->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_vrajal_status_lanjut">
<span<?= $Page->status_lanjut->viewAttributes() ?>>
<?= $Page->status_lanjut->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("vrajal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
