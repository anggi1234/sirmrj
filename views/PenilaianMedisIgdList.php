<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisIgdList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_igdlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpenilaian_medis_igdlist = currentForm = new ew.Form("fpenilaian_medis_igdlist", "list");
    fpenilaian_medis_igdlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpenilaian_medis_igdlist");
});
var fpenilaian_medis_igdlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpenilaian_medis_igdlistsrch = currentSearchForm = new ew.Form("fpenilaian_medis_igdlistsrch");

    // Dynamic selection lists

    // Filters
    fpenilaian_medis_igdlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpenilaian_medis_igdlistsrch");
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
<form name="fpenilaian_medis_igdlistsrch" id="fpenilaian_medis_igdlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpenilaian_medis_igdlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penilaian_medis_igd">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_medis_igd">
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
<form name="fpenilaian_medis_igdlist" id="fpenilaian_medis_igdlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_igd">
<div id="gmp_penilaian_medis_igd" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_penilaian_medis_igdlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_rawat" class="<?= $Page->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_no_rawat" class="penilaian_medis_igd_no_rawat"><?= $Page->renderSort($Page->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Page->tanggal->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_tanggal" class="penilaian_medis_igd_tanggal"><?= $Page->renderSort($Page->tanggal) ?></div></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Page->kd_dokter->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_kd_dokter" class="penilaian_medis_igd_kd_dokter"><?= $Page->renderSort($Page->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <th data-name="anamnesis" class="<?= $Page->anamnesis->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_anamnesis" class="penilaian_medis_igd_anamnesis"><?= $Page->renderSort($Page->anamnesis) ?></div></th>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
        <th data-name="hubungan" class="<?= $Page->hubungan->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_hubungan" class="penilaian_medis_igd_hubungan"><?= $Page->renderSort($Page->hubungan) ?></div></th>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <th data-name="alergi" class="<?= $Page->alergi->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_alergi" class="penilaian_medis_igd_alergi"><?= $Page->renderSort($Page->alergi) ?></div></th>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <th data-name="keadaan" class="<?= $Page->keadaan->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_keadaan" class="penilaian_medis_igd_keadaan"><?= $Page->renderSort($Page->keadaan) ?></div></th>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <th data-name="gcs" class="<?= $Page->gcs->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_gcs" class="penilaian_medis_igd_gcs"><?= $Page->renderSort($Page->gcs) ?></div></th>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
        <th data-name="kesadaran" class="<?= $Page->kesadaran->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_kesadaran" class="penilaian_medis_igd_kesadaran"><?= $Page->renderSort($Page->kesadaran) ?></div></th>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <th data-name="td" class="<?= $Page->td->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_td" class="penilaian_medis_igd_td"><?= $Page->renderSort($Page->td) ?></div></th>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <th data-name="nadi" class="<?= $Page->nadi->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_nadi" class="penilaian_medis_igd_nadi"><?= $Page->renderSort($Page->nadi) ?></div></th>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <th data-name="rr" class="<?= $Page->rr->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_rr" class="penilaian_medis_igd_rr"><?= $Page->renderSort($Page->rr) ?></div></th>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <th data-name="suhu" class="<?= $Page->suhu->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_suhu" class="penilaian_medis_igd_suhu"><?= $Page->renderSort($Page->suhu) ?></div></th>
<?php } ?>
<?php if ($Page->spo->Visible) { // spo ?>
        <th data-name="spo" class="<?= $Page->spo->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_spo" class="penilaian_medis_igd_spo"><?= $Page->renderSort($Page->spo) ?></div></th>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <th data-name="bb" class="<?= $Page->bb->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_bb" class="penilaian_medis_igd_bb"><?= $Page->renderSort($Page->bb) ?></div></th>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <th data-name="tb" class="<?= $Page->tb->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_tb" class="penilaian_medis_igd_tb"><?= $Page->renderSort($Page->tb) ?></div></th>
<?php } ?>
<?php if ($Page->kepala->Visible) { // kepala ?>
        <th data-name="kepala" class="<?= $Page->kepala->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_kepala" class="penilaian_medis_igd_kepala"><?= $Page->renderSort($Page->kepala) ?></div></th>
<?php } ?>
<?php if ($Page->mata->Visible) { // mata ?>
        <th data-name="mata" class="<?= $Page->mata->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_mata" class="penilaian_medis_igd_mata"><?= $Page->renderSort($Page->mata) ?></div></th>
<?php } ?>
<?php if ($Page->gigi->Visible) { // gigi ?>
        <th data-name="gigi" class="<?= $Page->gigi->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_gigi" class="penilaian_medis_igd_gigi"><?= $Page->renderSort($Page->gigi) ?></div></th>
<?php } ?>
<?php if ($Page->leher->Visible) { // leher ?>
        <th data-name="leher" class="<?= $Page->leher->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_leher" class="penilaian_medis_igd_leher"><?= $Page->renderSort($Page->leher) ?></div></th>
<?php } ?>
<?php if ($Page->thoraks->Visible) { // thoraks ?>
        <th data-name="thoraks" class="<?= $Page->thoraks->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_thoraks" class="penilaian_medis_igd_thoraks"><?= $Page->renderSort($Page->thoraks) ?></div></th>
<?php } ?>
<?php if ($Page->abdomen->Visible) { // abdomen ?>
        <th data-name="abdomen" class="<?= $Page->abdomen->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_abdomen" class="penilaian_medis_igd_abdomen"><?= $Page->renderSort($Page->abdomen) ?></div></th>
<?php } ?>
<?php if ($Page->genital->Visible) { // genital ?>
        <th data-name="genital" class="<?= $Page->genital->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_genital" class="penilaian_medis_igd_genital"><?= $Page->renderSort($Page->genital) ?></div></th>
<?php } ?>
<?php if ($Page->ekstremitas->Visible) { // ekstremitas ?>
        <th data-name="ekstremitas" class="<?= $Page->ekstremitas->headerCellClass() ?>"><div id="elh_penilaian_medis_igd_ekstremitas" class="penilaian_medis_igd_ekstremitas"><?= $Page->renderSort($Page->ekstremitas) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_penilaian_medis_igd", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <td data-name="anamnesis" <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->hubungan->Visible) { // hubungan ?>
        <td data-name="hubungan" <?= $Page->hubungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_hubungan">
<span<?= $Page->hubungan->viewAttributes() ?>>
<?= $Page->hubungan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alergi->Visible) { // alergi ?>
        <td data-name="alergi" <?= $Page->alergi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keadaan->Visible) { // keadaan ?>
        <td data-name="keadaan" <?= $Page->keadaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gcs->Visible) { // gcs ?>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kesadaran->Visible) { // kesadaran ?>
        <td data-name="kesadaran" <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_kesadaran">
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->td->Visible) { // td ?>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nadi->Visible) { // nadi ?>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rr->Visible) { // rr ?>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->suhu->Visible) { // suhu ?>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->spo->Visible) { // spo ?>
        <td data-name="spo" <?= $Page->spo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_spo">
<span<?= $Page->spo->viewAttributes() ?>>
<?= $Page->spo->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bb->Visible) { // bb ?>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tb->Visible) { // tb ?>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kepala->Visible) { // kepala ?>
        <td data-name="kepala" <?= $Page->kepala->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_kepala">
<span<?= $Page->kepala->viewAttributes() ?>>
<?= $Page->kepala->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mata->Visible) { // mata ?>
        <td data-name="mata" <?= $Page->mata->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_mata">
<span<?= $Page->mata->viewAttributes() ?>>
<?= $Page->mata->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gigi->Visible) { // gigi ?>
        <td data-name="gigi" <?= $Page->gigi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_gigi">
<span<?= $Page->gigi->viewAttributes() ?>>
<?= $Page->gigi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->leher->Visible) { // leher ?>
        <td data-name="leher" <?= $Page->leher->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_leher">
<span<?= $Page->leher->viewAttributes() ?>>
<?= $Page->leher->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thoraks->Visible) { // thoraks ?>
        <td data-name="thoraks" <?= $Page->thoraks->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_thoraks">
<span<?= $Page->thoraks->viewAttributes() ?>>
<?= $Page->thoraks->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->abdomen->Visible) { // abdomen ?>
        <td data-name="abdomen" <?= $Page->abdomen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_abdomen">
<span<?= $Page->abdomen->viewAttributes() ?>>
<?= $Page->abdomen->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->genital->Visible) { // genital ?>
        <td data-name="genital" <?= $Page->genital->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_genital">
<span<?= $Page->genital->viewAttributes() ?>>
<?= $Page->genital->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ekstremitas->Visible) { // ekstremitas ?>
        <td data-name="ekstremitas" <?= $Page->ekstremitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_medis_igd_ekstremitas">
<span<?= $Page->ekstremitas->viewAttributes() ?>>
<?= $Page->ekstremitas->getViewValue() ?></span>
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
    ew.addEventHandlers("penilaian_medis_igd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
