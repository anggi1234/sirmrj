<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$KonsulList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkonsullist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fkonsullist = currentForm = new ew.Form("fkonsullist", "list");
    fkonsullist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fkonsullist");
});
var fkonsullistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fkonsullistsrch = currentSearchForm = new ew.Form("fkonsullistsrch");

    // Dynamic selection lists

    // Filters
    fkonsullistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fkonsullistsrch");
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
<form name="fkonsullistsrch" id="fkonsullistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fkonsullistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="konsul">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> konsul">
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
<form name="fkonsullist" id="fkonsullist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="konsul">
<?php if ($Page->getCurrentMasterTable() == "vrajal" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_reg->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_konsul" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_konsullist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->no_reg->Visible) { // no_reg ?>
        <th data-name="no_reg" class="<?= $Page->no_reg->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_konsul_no_reg" class="konsul_no_reg"><?= $Page->renderSort($Page->no_reg) ?></div></th>
<?php } ?>
<?php if ($Page->jenis_konsul->Visible) { // jenis_konsul ?>
        <th data-name="jenis_konsul" class="<?= $Page->jenis_konsul->headerCellClass() ?>"><div id="elh_konsul_jenis_konsul" class="konsul_jenis_konsul"><?= $Page->renderSort($Page->jenis_konsul) ?></div></th>
<?php } ?>
<?php if ($Page->konsultasi->Visible) { // konsultasi ?>
        <th data-name="konsultasi" class="<?= $Page->konsultasi->headerCellClass() ?>"><div id="elh_konsul_konsultasi" class="konsul_konsultasi"><?= $Page->renderSort($Page->konsultasi) ?></div></th>
<?php } ?>
<?php if ($Page->hasil_konsul->Visible) { // hasil_konsul ?>
        <th data-name="hasil_konsul" class="<?= $Page->hasil_konsul->headerCellClass() ?>"><div id="elh_konsul_hasil_konsul" class="konsul_hasil_konsul"><?= $Page->renderSort($Page->hasil_konsul) ?></div></th>
<?php } ?>
<?php if ($Page->status_konsul->Visible) { // status_konsul ?>
        <th data-name="status_konsul" class="<?= $Page->status_konsul->headerCellClass() ?>"><div id="elh_konsul_status_konsul" class="konsul_status_konsul"><?= $Page->renderSort($Page->status_konsul) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal_input->Visible) { // tanggal_input ?>
        <th data-name="tanggal_input" class="<?= $Page->tanggal_input->headerCellClass() ?>"><div id="elh_konsul_tanggal_input" class="konsul_tanggal_input"><?= $Page->renderSort($Page->tanggal_input) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_konsul", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->no_reg->Visible) { // no_reg ?>
        <td data-name="no_reg" <?= $Page->no_reg->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_konsul_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis_konsul->Visible) { // jenis_konsul ?>
        <td data-name="jenis_konsul" <?= $Page->jenis_konsul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_konsul_jenis_konsul">
<span<?= $Page->jenis_konsul->viewAttributes() ?>>
<?= $Page->jenis_konsul->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->konsultasi->Visible) { // konsultasi ?>
        <td data-name="konsultasi" <?= $Page->konsultasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_konsul_konsultasi">
<span<?= $Page->konsultasi->viewAttributes() ?>>
<?= $Page->konsultasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->hasil_konsul->Visible) { // hasil_konsul ?>
        <td data-name="hasil_konsul" <?= $Page->hasil_konsul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_konsul_hasil_konsul">
<span<?= $Page->hasil_konsul->viewAttributes() ?>>
<?= $Page->hasil_konsul->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status_konsul->Visible) { // status_konsul ?>
        <td data-name="status_konsul" <?= $Page->status_konsul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_konsul_status_konsul">
<span<?= $Page->status_konsul->viewAttributes() ?>>
<?= $Page->status_konsul->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal_input->Visible) { // tanggal_input ?>
        <td data-name="tanggal_input" <?= $Page->tanggal_input->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_konsul_tanggal_input">
<span<?= $Page->tanggal_input->viewAttributes() ?>>
<?= $Page->tanggal_input->getViewValue() ?></span>
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
    ew.addEventHandlers("konsul");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
