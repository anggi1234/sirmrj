<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$ResepDokterList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fresep_dokterlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fresep_dokterlist = currentForm = new ew.Form("fresep_dokterlist", "list");
    fresep_dokterlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fresep_dokterlist");
});
var fresep_dokterlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fresep_dokterlistsrch = currentSearchForm = new ew.Form("fresep_dokterlistsrch");

    // Dynamic selection lists

    // Filters
    fresep_dokterlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fresep_dokterlistsrch");
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
<form name="fresep_dokterlistsrch" id="fresep_dokterlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fresep_dokterlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="resep_dokter">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resep_dokter">
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
<form name="fresep_dokterlist" id="fresep_dokterlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resep_dokter">
<?php if ($Page->getCurrentMasterTable() == "vrajal" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_reg->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_resep_dokter" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_resep_dokterlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id_resep_dokter->Visible) { // id_resep_dokter ?>
        <th data-name="id_resep_dokter" class="<?= $Page->id_resep_dokter->headerCellClass() ?>"><div id="elh_resep_dokter_id_resep_dokter" class="resep_dokter_id_resep_dokter"><?= $Page->renderSort($Page->id_resep_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
        <th data-name="no_reg" class="<?= $Page->no_reg->headerCellClass() ?>"><div id="elh_resep_dokter_no_reg" class="resep_dokter_no_reg"><?= $Page->renderSort($Page->no_reg) ?></div></th>
<?php } ?>
<?php if ($Page->kode_brng->Visible) { // kode_brng ?>
        <th data-name="kode_brng" class="<?= $Page->kode_brng->headerCellClass() ?>"><div id="elh_resep_dokter_kode_brng" class="resep_dokter_kode_brng"><?= $Page->renderSort($Page->kode_brng) ?></div></th>
<?php } ?>
<?php if ($Page->jml->Visible) { // jml ?>
        <th data-name="jml" class="<?= $Page->jml->headerCellClass() ?>"><div id="elh_resep_dokter_jml" class="resep_dokter_jml"><?= $Page->renderSort($Page->jml) ?></div></th>
<?php } ?>
<?php if ($Page->aturan_pakai->Visible) { // aturan_pakai ?>
        <th data-name="aturan_pakai" class="<?= $Page->aturan_pakai->headerCellClass() ?>"><div id="elh_resep_dokter_aturan_pakai" class="resep_dokter_aturan_pakai"><?= $Page->renderSort($Page->aturan_pakai) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
        <th data-name="tgl_input" class="<?= $Page->tgl_input->headerCellClass() ?>"><div id="elh_resep_dokter_tgl_input" class="resep_dokter_tgl_input"><?= $Page->renderSort($Page->tgl_input) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_resep_dokter", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id_resep_dokter->Visible) { // id_resep_dokter ?>
        <td data-name="id_resep_dokter" <?= $Page->id_resep_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resep_dokter_id_resep_dokter">
<span<?= $Page->id_resep_dokter->viewAttributes() ?>>
<?= $Page->id_resep_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_reg->Visible) { // no_reg ?>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resep_dokter_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode_brng->Visible) { // kode_brng ?>
        <td data-name="kode_brng" <?= $Page->kode_brng->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resep_dokter_kode_brng">
<span<?= $Page->kode_brng->viewAttributes() ?>>
<?= $Page->kode_brng->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jml->Visible) { // jml ?>
        <td data-name="jml" <?= $Page->jml->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resep_dokter_jml">
<span<?= $Page->jml->viewAttributes() ?>>
<?= $Page->jml->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aturan_pakai->Visible) { // aturan_pakai ?>
        <td data-name="aturan_pakai" <?= $Page->aturan_pakai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resep_dokter_aturan_pakai">
<span<?= $Page->aturan_pakai->viewAttributes() ?>>
<?= $Page->aturan_pakai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_input->Visible) { // tgl_input ?>
        <td data-name="tgl_input" <?= $Page->tgl_input->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resep_dokter_tgl_input">
<span<?= $Page->tgl_input->viewAttributes() ?>>
<?= $Page->tgl_input->getViewValue() ?></span>
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
    ew.addEventHandlers("resep_dokter");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
