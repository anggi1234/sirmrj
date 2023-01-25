<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianPsikologiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_psikologilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpenilaian_psikologilist = currentForm = new ew.Form("fpenilaian_psikologilist", "list");
    fpenilaian_psikologilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpenilaian_psikologilist");
});
var fpenilaian_psikologilistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpenilaian_psikologilistsrch = currentSearchForm = new ew.Form("fpenilaian_psikologilistsrch");

    // Dynamic selection lists

    // Filters
    fpenilaian_psikologilistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpenilaian_psikologilistsrch");
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
<form name="fpenilaian_psikologilistsrch" id="fpenilaian_psikologilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpenilaian_psikologilistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penilaian_psikologi">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_psikologi">
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
<form name="fpenilaian_psikologilist" id="fpenilaian_psikologilist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_psikologi">
<?php if ($Page->getCurrentMasterTable() == "vigd" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vigd">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "vrajal" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_penilaian_psikologi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_penilaian_psikologilist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_rawat" class="<?= $Page->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_psikologi_no_rawat" class="penilaian_psikologi_no_rawat"><?= $Page->renderSort($Page->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Page->tanggal->headerCellClass() ?>"><div id="elh_penilaian_psikologi_tanggal" class="penilaian_psikologi_tanggal"><?= $Page->renderSort($Page->tanggal) ?></div></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th data-name="nip" class="<?= $Page->nip->headerCellClass() ?>"><div id="elh_penilaian_psikologi_nip" class="penilaian_psikologi_nip"><?= $Page->renderSort($Page->nip) ?></div></th>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <th data-name="anamnesis" class="<?= $Page->anamnesis->headerCellClass() ?>"><div id="elh_penilaian_psikologi_anamnesis" class="penilaian_psikologi_anamnesis"><?= $Page->renderSort($Page->anamnesis) ?></div></th>
<?php } ?>
<?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
        <th data-name="dikirim_dari" class="<?= $Page->dikirim_dari->headerCellClass() ?>"><div id="elh_penilaian_psikologi_dikirim_dari" class="penilaian_psikologi_dikirim_dari"><?= $Page->renderSort($Page->dikirim_dari) ?></div></th>
<?php } ?>
<?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <th data-name="tujuan_pemeriksaan" class="<?= $Page->tujuan_pemeriksaan->headerCellClass() ?>"><div id="elh_penilaian_psikologi_tujuan_pemeriksaan" class="penilaian_psikologi_tujuan_pemeriksaan"><?= $Page->renderSort($Page->tujuan_pemeriksaan) ?></div></th>
<?php } ?>
<?php if ($Page->rupa->Visible) { // rupa ?>
        <th data-name="rupa" class="<?= $Page->rupa->headerCellClass() ?>"><div id="elh_penilaian_psikologi_rupa" class="penilaian_psikologi_rupa"><?= $Page->renderSort($Page->rupa) ?></div></th>
<?php } ?>
<?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <th data-name="bentuk_tubuh" class="<?= $Page->bentuk_tubuh->headerCellClass() ?>"><div id="elh_penilaian_psikologi_bentuk_tubuh" class="penilaian_psikologi_bentuk_tubuh"><?= $Page->renderSort($Page->bentuk_tubuh) ?></div></th>
<?php } ?>
<?php if ($Page->tindakan->Visible) { // tindakan ?>
        <th data-name="tindakan" class="<?= $Page->tindakan->headerCellClass() ?>"><div id="elh_penilaian_psikologi_tindakan" class="penilaian_psikologi_tindakan"><?= $Page->renderSort($Page->tindakan) ?></div></th>
<?php } ?>
<?php if ($Page->pakaian->Visible) { // pakaian ?>
        <th data-name="pakaian" class="<?= $Page->pakaian->headerCellClass() ?>"><div id="elh_penilaian_psikologi_pakaian" class="penilaian_psikologi_pakaian"><?= $Page->renderSort($Page->pakaian) ?></div></th>
<?php } ?>
<?php if ($Page->ekspresi->Visible) { // ekspresi ?>
        <th data-name="ekspresi" class="<?= $Page->ekspresi->headerCellClass() ?>"><div id="elh_penilaian_psikologi_ekspresi" class="penilaian_psikologi_ekspresi"><?= $Page->renderSort($Page->ekspresi) ?></div></th>
<?php } ?>
<?php if ($Page->berbicara->Visible) { // berbicara ?>
        <th data-name="berbicara" class="<?= $Page->berbicara->headerCellClass() ?>"><div id="elh_penilaian_psikologi_berbicara" class="penilaian_psikologi_berbicara"><?= $Page->renderSort($Page->berbicara) ?></div></th>
<?php } ?>
<?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <th data-name="penggunaan_kata" class="<?= $Page->penggunaan_kata->headerCellClass() ?>"><div id="elh_penilaian_psikologi_penggunaan_kata" class="penilaian_psikologi_penggunaan_kata"><?= $Page->renderSort($Page->penggunaan_kata) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_penilaian_psikologi", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nip->Visible) { // nip ?>
        <td data-name="nip" <?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <td data-name="anamnesis" <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
        <td data-name="dikirim_dari" <?= $Page->dikirim_dari->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_dikirim_dari">
<span<?= $Page->dikirim_dari->viewAttributes() ?>>
<?= $Page->dikirim_dari->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <td data-name="tujuan_pemeriksaan" <?= $Page->tujuan_pemeriksaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_tujuan_pemeriksaan">
<span<?= $Page->tujuan_pemeriksaan->viewAttributes() ?>>
<?= $Page->tujuan_pemeriksaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rupa->Visible) { // rupa ?>
        <td data-name="rupa" <?= $Page->rupa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_rupa">
<span<?= $Page->rupa->viewAttributes() ?>>
<?= $Page->rupa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <td data-name="bentuk_tubuh" <?= $Page->bentuk_tubuh->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_bentuk_tubuh">
<span<?= $Page->bentuk_tubuh->viewAttributes() ?>>
<?= $Page->bentuk_tubuh->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tindakan->Visible) { // tindakan ?>
        <td data-name="tindakan" <?= $Page->tindakan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_tindakan">
<span<?= $Page->tindakan->viewAttributes() ?>>
<?= $Page->tindakan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pakaian->Visible) { // pakaian ?>
        <td data-name="pakaian" <?= $Page->pakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_pakaian">
<span<?= $Page->pakaian->viewAttributes() ?>>
<?= $Page->pakaian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ekspresi->Visible) { // ekspresi ?>
        <td data-name="ekspresi" <?= $Page->ekspresi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_ekspresi">
<span<?= $Page->ekspresi->viewAttributes() ?>>
<?= $Page->ekspresi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->berbicara->Visible) { // berbicara ?>
        <td data-name="berbicara" <?= $Page->berbicara->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_berbicara">
<span<?= $Page->berbicara->viewAttributes() ?>>
<?= $Page->berbicara->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <td data-name="penggunaan_kata" <?= $Page->penggunaan_kata->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_psikologi_penggunaan_kata">
<span<?= $Page->penggunaan_kata->viewAttributes() ?>>
<?= $Page->penggunaan_kata->getViewValue() ?></span>
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
    ew.addEventHandlers("penilaian_psikologi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
