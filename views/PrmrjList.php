<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PrmrjList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fprmrjlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fprmrjlist = currentForm = new ew.Form("fprmrjlist", "list");
    fprmrjlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fprmrjlist");
});
var fprmrjlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fprmrjlistsrch = currentSearchForm = new ew.Form("fprmrjlistsrch");

    // Dynamic selection lists

    // Filters
    fprmrjlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fprmrjlistsrch");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "vrajal") {
    if ($Page->MasterRecordExists) {
        include_once "views/VrajalMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fprmrjlistsrch" id="fprmrjlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fprmrjlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="prmrj">
    <div class="ew-extended-search">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> prmrj">
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
<form name="fprmrjlist" id="fprmrjlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="prmrj">
<?php if ($Page->getCurrentMasterTable() == "vrajal" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_no_rkm_medis" value="<?= HtmlEncode($Page->no_rkm_medis->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_prmrj" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_prmrjlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th data-name="no_rkm_medis" class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><div id="elh_prmrj_no_rkm_medis" class="prmrj_no_rkm_medis"><?= $Page->renderSort($Page->no_rkm_medis) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <th data-name="tgl_registrasi" class="<?= $Page->tgl_registrasi->headerCellClass() ?>"><div id="elh_prmrj_tgl_registrasi" class="prmrj_tgl_registrasi"><?= $Page->renderSort($Page->tgl_registrasi) ?></div></th>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <th data-name="kd_poli" class="<?= $Page->kd_poli->headerCellClass() ?>"><div id="elh_prmrj_kd_poli" class="prmrj_kd_poli"><?= $Page->renderSort($Page->kd_poli) ?></div></th>
<?php } ?>
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <th data-name="kd_penyakit" class="<?= $Page->kd_penyakit->headerCellClass() ?>"><div id="elh_prmrj_kd_penyakit" class="prmrj_kd_penyakit"><?= $Page->renderSort($Page->kd_penyakit) ?></div></th>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <th data-name="alergi" class="<?= $Page->alergi->headerCellClass() ?>"><div id="elh_prmrj_alergi" class="prmrj_alergi"><?= $Page->renderSort($Page->alergi) ?></div></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Page->kd_dokter->headerCellClass() ?>"><div id="elh_prmrj_kd_dokter" class="prmrj_kd_dokter"><?= $Page->renderSort($Page->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->kd_icd9->Visible) { // kd_icd9 ?>
        <th data-name="kd_icd9" class="<?= $Page->kd_icd9->headerCellClass() ?>"><div id="elh_prmrj_kd_icd9" class="prmrj_kd_icd9"><?= $Page->renderSort($Page->kd_icd9) ?></div></th>
<?php } ?>
<?php if ($Page->cetak->Visible) { // cetak ?>
        <th data-name="cetak" class="<?= $Page->cetak->headerCellClass() ?>"><div id="elh_prmrj_cetak" class="prmrj_cetak"><?= $Page->renderSort($Page->cetak) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_prmrj", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <td data-name="tgl_registrasi" <?= $Page->tgl_registrasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_tgl_registrasi">
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <td data-name="kd_poli" <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <td data-name="kd_penyakit" <?= $Page->kd_penyakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_kd_penyakit">
<span<?= $Page->kd_penyakit->viewAttributes() ?>>
<?= $Page->kd_penyakit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alergi->Visible) { // alergi ?>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_icd9->Visible) { // kd_icd9 ?>
        <td data-name="kd_icd9" <?= $Page->kd_icd9->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_kd_icd9">
<span<?= $Page->kd_icd9->viewAttributes() ?>>
<?= $Page->kd_icd9->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->cetak->Visible) { // cetak ?>
        <td data-name="cetak" <?= $Page->cetak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_prmrj_cetak">
<span<?= $Page->cetak->viewAttributes() ?>><!--<button type="button" class="btn btn-primary">Cetak</button>-->
<a class="btn btn-info btn-sm"
	href="../PrmrjList"
target="_blank">Cetak</a>
</span>
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
    ew.addEventHandlers("prmrj");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
