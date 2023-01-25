<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisRalanList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_ralanlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpenilaian_medis_ralanlist = currentForm = new ew.Form("fpenilaian_medis_ralanlist", "list");
    fpenilaian_medis_ralanlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpenilaian_medis_ralanlist");
});
var fpenilaian_medis_ralanlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpenilaian_medis_ralanlistsrch = currentSearchForm = new ew.Form("fpenilaian_medis_ralanlistsrch");

    // Dynamic selection lists

    // Filters
    fpenilaian_medis_ralanlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpenilaian_medis_ralanlistsrch");
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
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "vigd") {
    if ($Page->MasterRecordExists) {
        include_once "views/VigdMaster.php";
    }
}
?>
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
<form name="fpenilaian_medis_ralanlistsrch" id="fpenilaian_medis_ralanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpenilaian_medis_ralanlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penilaian_medis_ralan">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_medis_ralan">
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
<form name="fpenilaian_medis_ralanlist" id="fpenilaian_medis_ralanlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_ralan">
<?php if ($Page->getCurrentMasterTable() == "vigd" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vigd">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "vrajal" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_penilaian_medis_ralan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_penilaian_medis_ralanlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th data-name="no_rawat" class="<?= $Page->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_no_rawat" class="penilaian_medis_ralan_no_rawat"><?= $Page->renderSort($Page->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Page->tanggal->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_tanggal" class="penilaian_medis_ralan_tanggal"><?= $Page->renderSort($Page->tanggal) ?></div></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Page->kd_dokter->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_kd_dokter" class="penilaian_medis_ralan_kd_dokter"><?= $Page->renderSort($Page->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <th data-name="anamnesis" class="<?= $Page->anamnesis->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_anamnesis" class="penilaian_medis_ralan_anamnesis"><?= $Page->renderSort($Page->anamnesis) ?></div></th>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
        <th data-name="keluhan_utama" class="<?= $Page->keluhan_utama->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_keluhan_utama" class="penilaian_medis_ralan_keluhan_utama"><?= $Page->renderSort($Page->keluhan_utama) ?></div></th>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <th data-name="alergi" class="<?= $Page->alergi->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_alergi" class="penilaian_medis_ralan_alergi"><?= $Page->renderSort($Page->alergi) ?></div></th>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <th data-name="keadaan" class="<?= $Page->keadaan->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_keadaan" class="penilaian_medis_ralan_keadaan"><?= $Page->renderSort($Page->keadaan) ?></div></th>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <th data-name="td" class="<?= $Page->td->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_td" class="penilaian_medis_ralan_td"><?= $Page->renderSort($Page->td) ?></div></th>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <th data-name="nadi" class="<?= $Page->nadi->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_nadi" class="penilaian_medis_ralan_nadi"><?= $Page->renderSort($Page->nadi) ?></div></th>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <th data-name="rr" class="<?= $Page->rr->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_rr" class="penilaian_medis_ralan_rr"><?= $Page->renderSort($Page->rr) ?></div></th>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <th data-name="suhu" class="<?= $Page->suhu->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_suhu" class="penilaian_medis_ralan_suhu"><?= $Page->renderSort($Page->suhu) ?></div></th>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <th data-name="bb" class="<?= $Page->bb->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_bb" class="penilaian_medis_ralan_bb"><?= $Page->renderSort($Page->bb) ?></div></th>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <th data-name="tb" class="<?= $Page->tb->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_tb" class="penilaian_medis_ralan_tb"><?= $Page->renderSort($Page->tb) ?></div></th>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
        <th data-name="diagnosis" class="<?= $Page->diagnosis->headerCellClass() ?>"><div id="elh_penilaian_medis_ralan_diagnosis" class="penilaian_medis_ralan_diagnosis"><?= $Page->renderSort($Page->diagnosis) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_penilaian_medis_ralan", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <td data-name="anamnesis" <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
        <td data-name="keluhan_utama" <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_keluhan_utama">
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alergi->Visible) { // alergi ?>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keadaan->Visible) { // keadaan ?>
        <td data-name="keadaan" <?= $Page->keadaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->td->Visible) { // td ?>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nadi->Visible) { // nadi ?>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rr->Visible) { // rr ?>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->suhu->Visible) { // suhu ?>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bb->Visible) { // bb ?>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tb->Visible) { // tb ?>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->diagnosis->Visible) { // diagnosis ?>
        <td data-name="diagnosis" <?= $Page->diagnosis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_ralan_diagnosis">
<span<?= $Page->diagnosis->viewAttributes() ?>>
<?= $Page->diagnosis->getViewValue() ?></span>
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
    ew.addEventHandlers("penilaian_medis_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
