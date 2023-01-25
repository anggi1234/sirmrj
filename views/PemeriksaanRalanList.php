<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PemeriksaanRalanList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpemeriksaan_ralanlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpemeriksaan_ralanlist = currentForm = new ew.Form("fpemeriksaan_ralanlist", "list");
    fpemeriksaan_ralanlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpemeriksaan_ralanlist");
});
var fpemeriksaan_ralanlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpemeriksaan_ralanlistsrch = currentSearchForm = new ew.Form("fpemeriksaan_ralanlistsrch");

    // Dynamic selection lists

    // Filters
    fpemeriksaan_ralanlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpemeriksaan_ralanlistsrch");
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
<form name="fpemeriksaan_ralanlistsrch" id="fpemeriksaan_ralanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpemeriksaan_ralanlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pemeriksaan_ralan">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pemeriksaan_ralan">
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
<form name="fpemeriksaan_ralanlist" id="fpemeriksaan_ralanlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pemeriksaan_ralan">
<?php if ($Page->getCurrentMasterTable() == "vigd" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vigd">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "vrajal" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_pemeriksaan_ralan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pemeriksaan_ralanlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_rawat" class="<?= $Page->no_rawat->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_no_rawat" class="pemeriksaan_ralan_no_rawat"><?= $Page->renderSort($Page->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_perawatan->Visible) { // tgl_perawatan ?>
        <th data-name="tgl_perawatan" class="<?= $Page->tgl_perawatan->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_tgl_perawatan" class="pemeriksaan_ralan_tgl_perawatan"><?= $Page->renderSort($Page->tgl_perawatan) ?></div></th>
<?php } ?>
<?php if ($Page->jam_rawat->Visible) { // jam_rawat ?>
        <th data-name="jam_rawat" class="<?= $Page->jam_rawat->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_jam_rawat" class="pemeriksaan_ralan_jam_rawat"><?= $Page->renderSort($Page->jam_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->suhu_tubuh->Visible) { // suhu_tubuh ?>
        <th data-name="suhu_tubuh" class="<?= $Page->suhu_tubuh->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_suhu_tubuh" class="pemeriksaan_ralan_suhu_tubuh"><?= $Page->renderSort($Page->suhu_tubuh) ?></div></th>
<?php } ?>
<?php if ($Page->tensi->Visible) { // tensi ?>
        <th data-name="tensi" class="<?= $Page->tensi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_tensi" class="pemeriksaan_ralan_tensi"><?= $Page->renderSort($Page->tensi) ?></div></th>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <th data-name="nadi" class="<?= $Page->nadi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_nadi" class="pemeriksaan_ralan_nadi"><?= $Page->renderSort($Page->nadi) ?></div></th>
<?php } ?>
<?php if ($Page->respirasi->Visible) { // respirasi ?>
        <th data-name="respirasi" class="<?= $Page->respirasi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_respirasi" class="pemeriksaan_ralan_respirasi"><?= $Page->renderSort($Page->respirasi) ?></div></th>
<?php } ?>
<?php if ($Page->tinggi->Visible) { // tinggi ?>
        <th data-name="tinggi" class="<?= $Page->tinggi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_tinggi" class="pemeriksaan_ralan_tinggi"><?= $Page->renderSort($Page->tinggi) ?></div></th>
<?php } ?>
<?php if ($Page->berat->Visible) { // berat ?>
        <th data-name="berat" class="<?= $Page->berat->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_berat" class="pemeriksaan_ralan_berat"><?= $Page->renderSort($Page->berat) ?></div></th>
<?php } ?>
<?php if ($Page->spo2->Visible) { // spo2 ?>
        <th data-name="spo2" class="<?= $Page->spo2->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_spo2" class="pemeriksaan_ralan_spo2"><?= $Page->renderSort($Page->spo2) ?></div></th>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <th data-name="gcs" class="<?= $Page->gcs->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_gcs" class="pemeriksaan_ralan_gcs"><?= $Page->renderSort($Page->gcs) ?></div></th>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
        <th data-name="kesadaran" class="<?= $Page->kesadaran->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_kesadaran" class="pemeriksaan_ralan_kesadaran"><?= $Page->renderSort($Page->kesadaran) ?></div></th>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <th data-name="alergi" class="<?= $Page->alergi->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_alergi" class="pemeriksaan_ralan_alergi"><?= $Page->renderSort($Page->alergi) ?></div></th>
<?php } ?>
<?php if ($Page->lingkar_perut->Visible) { // lingkar_perut ?>
        <th data-name="lingkar_perut" class="<?= $Page->lingkar_perut->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_lingkar_perut" class="pemeriksaan_ralan_lingkar_perut"><?= $Page->renderSort($Page->lingkar_perut) ?></div></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th data-name="nip" class="<?= $Page->nip->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_nip" class="pemeriksaan_ralan_nip"><?= $Page->renderSort($Page->nip) ?></div></th>
<?php } ?>
<?php if ($Page->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
        <th data-name="id_pemeriksaan_ralan" class="<?= $Page->id_pemeriksaan_ralan->headerCellClass() ?>"><div id="elh_pemeriksaan_ralan_id_pemeriksaan_ralan" class="pemeriksaan_ralan_id_pemeriksaan_ralan"><?= $Page->renderSort($Page->id_pemeriksaan_ralan) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_pemeriksaan_ralan", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_perawatan->Visible) { // tgl_perawatan ?>
        <td data-name="tgl_perawatan" <?= $Page->tgl_perawatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_tgl_perawatan">
<span<?= $Page->tgl_perawatan->viewAttributes() ?>>
<?= $Page->tgl_perawatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jam_rawat->Visible) { // jam_rawat ?>
        <td data-name="jam_rawat" <?= $Page->jam_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_jam_rawat">
<span<?= $Page->jam_rawat->viewAttributes() ?>>
<?= $Page->jam_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->suhu_tubuh->Visible) { // suhu_tubuh ?>
        <td data-name="suhu_tubuh" <?= $Page->suhu_tubuh->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_suhu_tubuh">
<span<?= $Page->suhu_tubuh->viewAttributes() ?>>
<?= $Page->suhu_tubuh->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tensi->Visible) { // tensi ?>
        <td data-name="tensi" <?= $Page->tensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_tensi">
<span<?= $Page->tensi->viewAttributes() ?>>
<?= $Page->tensi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nadi->Visible) { // nadi ?>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->respirasi->Visible) { // respirasi ?>
        <td data-name="respirasi" <?= $Page->respirasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_respirasi">
<span<?= $Page->respirasi->viewAttributes() ?>>
<?= $Page->respirasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tinggi->Visible) { // tinggi ?>
        <td data-name="tinggi" <?= $Page->tinggi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_tinggi">
<span<?= $Page->tinggi->viewAttributes() ?>>
<?= $Page->tinggi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->berat->Visible) { // berat ?>
        <td data-name="berat" <?= $Page->berat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_berat">
<span<?= $Page->berat->viewAttributes() ?>>
<?= $Page->berat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->spo2->Visible) { // spo2 ?>
        <td data-name="spo2" <?= $Page->spo2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_spo2">
<span<?= $Page->spo2->viewAttributes() ?>>
<?= $Page->spo2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gcs->Visible) { // gcs ?>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kesadaran->Visible) { // kesadaran ?>
        <td data-name="kesadaran" <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_kesadaran">
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alergi->Visible) { // alergi ?>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lingkar_perut->Visible) { // lingkar_perut ?>
        <td data-name="lingkar_perut" <?= $Page->lingkar_perut->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_lingkar_perut">
<span<?= $Page->lingkar_perut->viewAttributes() ?>>
<?= $Page->lingkar_perut->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nip->Visible) { // nip ?>
        <td data-name="nip" <?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
        <td data-name="id_pemeriksaan_ralan" <?= $Page->id_pemeriksaan_ralan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemeriksaan_ralan_id_pemeriksaan_ralan">
<span<?= $Page->id_pemeriksaan_ralan->viewAttributes() ?>>
<?= $Page->id_pemeriksaan_ralan->getViewValue() ?></span>
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
    ew.addEventHandlers("pemeriksaan_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
