<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanPsikiatriList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralan_psikiatrilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpenilaian_awal_keperawatan_ralan_psikiatrilist = currentForm = new ew.Form("fpenilaian_awal_keperawatan_ralan_psikiatrilist", "list");
    fpenilaian_awal_keperawatan_ralan_psikiatrilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpenilaian_awal_keperawatan_ralan_psikiatrilist");
});
var fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch = currentSearchForm = new ew.Form("fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch");

    // Dynamic selection lists

    // Filters
    fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch");
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
<form name="fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch" id="fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan_psikiatri">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penilaian_awal_keperawatan_ralan_psikiatri">
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
<form name="fpenilaian_awal_keperawatan_ralan_psikiatrilist" id="fpenilaian_awal_keperawatan_ralan_psikiatrilist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan_psikiatri">
<?php if ($Page->getCurrentMasterTable() == "vigd" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vigd">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "vrajal" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_penilaian_awal_keperawatan_ralan_psikiatri" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_penilaian_awal_keperawatan_ralan_psikiatrilist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="no_rawat" class="<?= $Page->no_rawat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat" class="penilaian_awal_keperawatan_ralan_psikiatri_no_rawat"><?= $Page->renderSort($Page->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Page->tanggal->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tanggal" class="penilaian_awal_keperawatan_ralan_psikiatri_tanggal"><?= $Page->renderSort($Page->tanggal) ?></div></th>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
        <th data-name="informasi" class="<?= $Page->informasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_informasi" class="penilaian_awal_keperawatan_ralan_psikiatri_informasi"><?= $Page->renderSort($Page->informasi) ?></div></th>
<?php } ?>
<?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <th data-name="rkd_sakit_sejak" class="<?= $Page->rkd_sakit_sejak->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak"><?= $Page->renderSort($Page->rkd_sakit_sejak) ?></div></th>
<?php } ?>
<?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
        <th data-name="rkd_berobat" class="<?= $Page->rkd_berobat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat"><?= $Page->renderSort($Page->rkd_berobat) ?></div></th>
<?php } ?>
<?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <th data-name="rkd_hasil_pengobatan" class="<?= $Page->rkd_hasil_pengobatan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan" class="penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan"><?= $Page->renderSort($Page->rkd_hasil_pengobatan) ?></div></th>
<?php } ?>
<?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <th data-name="fp_putus_obat" class="<?= $Page->fp_putus_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat"><?= $Page->renderSort($Page->fp_putus_obat) ?></div></th>
<?php } ?>
<?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <th data-name="ket_putus_obat" class="<?= $Page->ket_putus_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat"><?= $Page->renderSort($Page->ket_putus_obat) ?></div></th>
<?php } ?>
<?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <th data-name="fp_ekonomi" class="<?= $Page->fp_ekonomi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi"><?= $Page->renderSort($Page->fp_ekonomi) ?></div></th>
<?php } ?>
<?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <th data-name="ket_masalah_ekonomi" class="<?= $Page->ket_masalah_ekonomi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi"><?= $Page->renderSort($Page->ket_masalah_ekonomi) ?></div></th>
<?php } ?>
<?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <th data-name="fp_masalah_fisik" class="<?= $Page->fp_masalah_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik"><?= $Page->renderSort($Page->fp_masalah_fisik) ?></div></th>
<?php } ?>
<?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <th data-name="ket_masalah_fisik" class="<?= $Page->ket_masalah_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik"><?= $Page->renderSort($Page->ket_masalah_fisik) ?></div></th>
<?php } ?>
<?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <th data-name="fp_masalah_psikososial" class="<?= $Page->fp_masalah_psikososial->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial"><?= $Page->renderSort($Page->fp_masalah_psikososial) ?></div></th>
<?php } ?>
<?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <th data-name="ket_masalah_psikososial" class="<?= $Page->ket_masalah_psikososial->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial"><?= $Page->renderSort($Page->ket_masalah_psikososial) ?></div></th>
<?php } ?>
<?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
        <th data-name="rh_keluarga" class="<?= $Page->rh_keluarga->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga"><?= $Page->renderSort($Page->rh_keluarga) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <th data-name="ket_rh_keluarga" class="<?= $Page->ket_rh_keluarga->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga"><?= $Page->renderSort($Page->ket_rh_keluarga) ?></div></th>
<?php } ?>
<?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <th data-name="resiko_bunuh_diri" class="<?= $Page->resiko_bunuh_diri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri"><?= $Page->renderSort($Page->resiko_bunuh_diri) ?></div></th>
<?php } ?>
<?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
        <th data-name="rbd_ide" class="<?= $Page->rbd_ide->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide"><?= $Page->renderSort($Page->rbd_ide) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <th data-name="ket_rbd_ide" class="<?= $Page->ket_rbd_ide->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide"><?= $Page->renderSort($Page->ket_rbd_ide) ?></div></th>
<?php } ?>
<?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
        <th data-name="rbd_rencana" class="<?= $Page->rbd_rencana->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana"><?= $Page->renderSort($Page->rbd_rencana) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <th data-name="ket_rbd_rencana" class="<?= $Page->ket_rbd_rencana->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana"><?= $Page->renderSort($Page->ket_rbd_rencana) ?></div></th>
<?php } ?>
<?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
        <th data-name="rbd_alat" class="<?= $Page->rbd_alat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat"><?= $Page->renderSort($Page->rbd_alat) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <th data-name="ket_rbd_alat" class="<?= $Page->ket_rbd_alat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat"><?= $Page->renderSort($Page->ket_rbd_alat) ?></div></th>
<?php } ?>
<?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <th data-name="rbd_percobaan" class="<?= $Page->rbd_percobaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan"><?= $Page->renderSort($Page->rbd_percobaan) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <th data-name="ket_rbd_percobaan" class="<?= $Page->ket_rbd_percobaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan"><?= $Page->renderSort($Page->ket_rbd_percobaan) ?></div></th>
<?php } ?>
<?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <th data-name="rbd_keinginan" class="<?= $Page->rbd_keinginan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan"><?= $Page->renderSort($Page->rbd_keinginan) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <th data-name="ket_rbd_keinginan" class="<?= $Page->ket_rbd_keinginan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan"><?= $Page->renderSort($Page->ket_rbd_keinginan) ?></div></th>
<?php } ?>
<?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <th data-name="rpo_penggunaan" class="<?= $Page->rpo_penggunaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan"><?= $Page->renderSort($Page->rpo_penggunaan) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <th data-name="ket_rpo_penggunaan" class="<?= $Page->ket_rpo_penggunaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan"><?= $Page->renderSort($Page->ket_rpo_penggunaan) ?></div></th>
<?php } ?>
<?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <th data-name="rpo_efek_samping" class="<?= $Page->rpo_efek_samping->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping"><?= $Page->renderSort($Page->rpo_efek_samping) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <th data-name="ket_rpo_efek_samping" class="<?= $Page->ket_rpo_efek_samping->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping"><?= $Page->renderSort($Page->ket_rpo_efek_samping) ?></div></th>
<?php } ?>
<?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
        <th data-name="rpo_napza" class="<?= $Page->rpo_napza->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza"><?= $Page->renderSort($Page->rpo_napza) ?></div></th>
<?php } ?>
<?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <th data-name="ket_rpo_napza" class="<?= $Page->ket_rpo_napza->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza"><?= $Page->renderSort($Page->ket_rpo_napza) ?></div></th>
<?php } ?>
<?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <th data-name="ket_lama_pemakaian" class="<?= $Page->ket_lama_pemakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian"><?= $Page->renderSort($Page->ket_lama_pemakaian) ?></div></th>
<?php } ?>
<?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <th data-name="ket_cara_pemakaian" class="<?= $Page->ket_cara_pemakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian"><?= $Page->renderSort($Page->ket_cara_pemakaian) ?></div></th>
<?php } ?>
<?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <th data-name="ket_latar_belakang_pemakaian" class="<?= $Page->ket_latar_belakang_pemakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian"><?= $Page->renderSort($Page->ket_latar_belakang_pemakaian) ?></div></th>
<?php } ?>
<?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <th data-name="rpo_penggunaan_obat_lainnya" class="<?= $Page->rpo_penggunaan_obat_lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya"><?= $Page->renderSort($Page->rpo_penggunaan_obat_lainnya) ?></div></th>
<?php } ?>
<?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <th data-name="ket_penggunaan_obat_lainnya" class="<?= $Page->ket_penggunaan_obat_lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya"><?= $Page->renderSort($Page->ket_penggunaan_obat_lainnya) ?></div></th>
<?php } ?>
<?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <th data-name="ket_alasan_penggunaan" class="<?= $Page->ket_alasan_penggunaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan"><?= $Page->renderSort($Page->ket_alasan_penggunaan) ?></div></th>
<?php } ?>
<?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <th data-name="rpo_alergi_obat" class="<?= $Page->rpo_alergi_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat"><?= $Page->renderSort($Page->rpo_alergi_obat) ?></div></th>
<?php } ?>
<?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <th data-name="ket_alergi_obat" class="<?= $Page->ket_alergi_obat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat"><?= $Page->renderSort($Page->ket_alergi_obat) ?></div></th>
<?php } ?>
<?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
        <th data-name="rpo_merokok" class="<?= $Page->rpo_merokok->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok"><?= $Page->renderSort($Page->rpo_merokok) ?></div></th>
<?php } ?>
<?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
        <th data-name="ket_merokok" class="<?= $Page->ket_merokok->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok"><?= $Page->renderSort($Page->ket_merokok) ?></div></th>
<?php } ?>
<?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <th data-name="rpo_minum_kopi" class="<?= $Page->rpo_minum_kopi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi"><?= $Page->renderSort($Page->rpo_minum_kopi) ?></div></th>
<?php } ?>
<?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <th data-name="ket_minum_kopi" class="<?= $Page->ket_minum_kopi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi"><?= $Page->renderSort($Page->ket_minum_kopi) ?></div></th>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <th data-name="td" class="<?= $Page->td->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_td" class="penilaian_awal_keperawatan_ralan_psikiatri_td"><?= $Page->renderSort($Page->td) ?></div></th>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <th data-name="nadi" class="<?= $Page->nadi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nadi" class="penilaian_awal_keperawatan_ralan_psikiatri_nadi"><?= $Page->renderSort($Page->nadi) ?></div></th>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <th data-name="gcs" class="<?= $Page->gcs->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_gcs" class="penilaian_awal_keperawatan_ralan_psikiatri_gcs"><?= $Page->renderSort($Page->gcs) ?></div></th>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <th data-name="rr" class="<?= $Page->rr->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rr" class="penilaian_awal_keperawatan_ralan_psikiatri_rr"><?= $Page->renderSort($Page->rr) ?></div></th>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <th data-name="suhu" class="<?= $Page->suhu->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_suhu" class="penilaian_awal_keperawatan_ralan_psikiatri_suhu"><?= $Page->renderSort($Page->suhu) ?></div></th>
<?php } ?>
<?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <th data-name="pf_keluhan_fisik" class="<?= $Page->pf_keluhan_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik"><?= $Page->renderSort($Page->pf_keluhan_fisik) ?></div></th>
<?php } ?>
<?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <th data-name="ket_keluhan_fisik" class="<?= $Page->ket_keluhan_fisik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik"><?= $Page->renderSort($Page->ket_keluhan_fisik) ?></div></th>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
        <th data-name="skala_nyeri" class="<?= $Page->skala_nyeri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri"><?= $Page->renderSort($Page->skala_nyeri) ?></div></th>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <th data-name="durasi" class="<?= $Page->durasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_durasi" class="penilaian_awal_keperawatan_ralan_psikiatri_durasi"><?= $Page->renderSort($Page->durasi) ?></div></th>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
        <th data-name="nyeri" class="<?= $Page->nyeri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri"><?= $Page->renderSort($Page->nyeri) ?></div></th>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
        <th data-name="provokes" class="<?= $Page->provokes->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_provokes"><?= $Page->renderSort($Page->provokes) ?></div></th>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
        <th data-name="ket_provokes" class="<?= $Page->ket_provokes->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes"><?= $Page->renderSort($Page->ket_provokes) ?></div></th>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
        <th data-name="quality" class="<?= $Page->quality->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_quality"><?= $Page->renderSort($Page->quality) ?></div></th>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
        <th data-name="ket_quality" class="<?= $Page->ket_quality->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_quality"><?= $Page->renderSort($Page->ket_quality) ?></div></th>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <th data-name="lokasi" class="<?= $Page->lokasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lokasi" class="penilaian_awal_keperawatan_ralan_psikiatri_lokasi"><?= $Page->renderSort($Page->lokasi) ?></div></th>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
        <th data-name="menyebar" class="<?= $Page->menyebar->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_menyebar" class="penilaian_awal_keperawatan_ralan_psikiatri_menyebar"><?= $Page->renderSort($Page->menyebar) ?></div></th>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
        <th data-name="pada_dokter" class="<?= $Page->pada_dokter->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter"><?= $Page->renderSort($Page->pada_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
        <th data-name="ket_dokter" class="<?= $Page->ket_dokter->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter"><?= $Page->renderSort($Page->ket_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <th data-name="nyeri_hilang" class="<?= $Page->nyeri_hilang->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang" class="penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang"><?= $Page->renderSort($Page->nyeri_hilang) ?></div></th>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
        <th data-name="ket_nyeri" class="<?= $Page->ket_nyeri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri"><?= $Page->renderSort($Page->ket_nyeri) ?></div></th>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <th data-name="bb" class="<?= $Page->bb->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bb" class="penilaian_awal_keperawatan_ralan_psikiatri_bb"><?= $Page->renderSort($Page->bb) ?></div></th>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <th data-name="tb" class="<?= $Page->tb->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_tb" class="penilaian_awal_keperawatan_ralan_psikiatri_tb"><?= $Page->renderSort($Page->tb) ?></div></th>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
        <th data-name="bmi" class="<?= $Page->bmi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bmi" class="penilaian_awal_keperawatan_ralan_psikiatri_bmi"><?= $Page->renderSort($Page->bmi) ?></div></th>
<?php } ?>
<?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <th data-name="lapor_status_nutrisi" class="<?= $Page->lapor_status_nutrisi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi"><?= $Page->renderSort($Page->lapor_status_nutrisi) ?></div></th>
<?php } ?>
<?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <th data-name="ket_lapor_status_nutrisi" class="<?= $Page->ket_lapor_status_nutrisi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi"><?= $Page->renderSort($Page->ket_lapor_status_nutrisi) ?></div></th>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
        <th data-name="sg1" class="<?= $Page->sg1->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg1" class="penilaian_awal_keperawatan_ralan_psikiatri_sg1"><?= $Page->renderSort($Page->sg1) ?></div></th>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
        <th data-name="nilai1" class="<?= $Page->nilai1->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai1" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai1"><?= $Page->renderSort($Page->nilai1) ?></div></th>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
        <th data-name="sg2" class="<?= $Page->sg2->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sg2" class="penilaian_awal_keperawatan_ralan_psikiatri_sg2"><?= $Page->renderSort($Page->sg2) ?></div></th>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
        <th data-name="nilai2" class="<?= $Page->nilai2->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nilai2" class="penilaian_awal_keperawatan_ralan_psikiatri_nilai2"><?= $Page->renderSort($Page->nilai2) ?></div></th>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
        <th data-name="total_hasil" class="<?= $Page->total_hasil->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_total_hasil"><?= $Page->renderSort($Page->total_hasil) ?></div></th>
<?php } ?>
<?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
        <th data-name="resikojatuh" class="<?= $Page->resikojatuh->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh" class="penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh"><?= $Page->renderSort($Page->resikojatuh) ?></div></th>
<?php } ?>
<?php if ($Page->bjm->Visible) { // bjm ?>
        <th data-name="bjm" class="<?= $Page->bjm->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_bjm" class="penilaian_awal_keperawatan_ralan_psikiatri_bjm"><?= $Page->renderSort($Page->bjm) ?></div></th>
<?php } ?>
<?php if ($Page->msa->Visible) { // msa ?>
        <th data-name="msa" class="<?= $Page->msa->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_msa" class="penilaian_awal_keperawatan_ralan_psikiatri_msa"><?= $Page->renderSort($Page->msa) ?></div></th>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
        <th data-name="hasil" class="<?= $Page->hasil->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_hasil" class="penilaian_awal_keperawatan_ralan_psikiatri_hasil"><?= $Page->renderSort($Page->hasil) ?></div></th>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
        <th data-name="lapor" class="<?= $Page->lapor->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_lapor"><?= $Page->renderSort($Page->lapor) ?></div></th>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
        <th data-name="ket_lapor" class="<?= $Page->ket_lapor->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor"><?= $Page->renderSort($Page->ket_lapor) ?></div></th>
<?php } ?>
<?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
        <th data-name="adl_mandi" class="<?= $Page->adl_mandi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi"><?= $Page->renderSort($Page->adl_mandi) ?></div></th>
<?php } ?>
<?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <th data-name="adl_berpakaian" class="<?= $Page->adl_berpakaian->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian"><?= $Page->renderSort($Page->adl_berpakaian) ?></div></th>
<?php } ?>
<?php if ($Page->adl_makan->Visible) { // adl_makan ?>
        <th data-name="adl_makan" class="<?= $Page->adl_makan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_makan"><?= $Page->renderSort($Page->adl_makan) ?></div></th>
<?php } ?>
<?php if ($Page->adl_bak->Visible) { // adl_bak ?>
        <th data-name="adl_bak" class="<?= $Page->adl_bak->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bak"><?= $Page->renderSort($Page->adl_bak) ?></div></th>
<?php } ?>
<?php if ($Page->adl_bab->Visible) { // adl_bab ?>
        <th data-name="adl_bab" class="<?= $Page->adl_bab->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_bab"><?= $Page->renderSort($Page->adl_bab) ?></div></th>
<?php } ?>
<?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
        <th data-name="adl_hobi" class="<?= $Page->adl_hobi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi"><?= $Page->renderSort($Page->adl_hobi) ?></div></th>
<?php } ?>
<?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <th data-name="ket_adl_hobi" class="<?= $Page->ket_adl_hobi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi"><?= $Page->renderSort($Page->ket_adl_hobi) ?></div></th>
<?php } ?>
<?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <th data-name="adl_sosialisasi" class="<?= $Page->adl_sosialisasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi"><?= $Page->renderSort($Page->adl_sosialisasi) ?></div></th>
<?php } ?>
<?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <th data-name="ket_adl_sosialisasi" class="<?= $Page->ket_adl_sosialisasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi"><?= $Page->renderSort($Page->ket_adl_sosialisasi) ?></div></th>
<?php } ?>
<?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <th data-name="adl_kegiatan" class="<?= $Page->adl_kegiatan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan"><?= $Page->renderSort($Page->adl_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <th data-name="ket_adl_kegiatan" class="<?= $Page->ket_adl_kegiatan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan"><?= $Page->renderSort($Page->ket_adl_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
        <th data-name="sk_penampilan" class="<?= $Page->sk_penampilan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan"><?= $Page->renderSort($Page->sk_penampilan) ?></div></th>
<?php } ?>
<?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <th data-name="sk_alam_perasaan" class="<?= $Page->sk_alam_perasaan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan"><?= $Page->renderSort($Page->sk_alam_perasaan) ?></div></th>
<?php } ?>
<?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <th data-name="sk_pembicaraan" class="<?= $Page->sk_pembicaraan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan"><?= $Page->renderSort($Page->sk_pembicaraan) ?></div></th>
<?php } ?>
<?php if ($Page->sk_afek->Visible) { // sk_afek ?>
        <th data-name="sk_afek" class="<?= $Page->sk_afek->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_afek"><?= $Page->renderSort($Page->sk_afek) ?></div></th>
<?php } ?>
<?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <th data-name="sk_aktifitas_motorik" class="<?= $Page->sk_aktifitas_motorik->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik"><?= $Page->renderSort($Page->sk_aktifitas_motorik) ?></div></th>
<?php } ?>
<?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <th data-name="sk_gangguan_ringan" class="<?= $Page->sk_gangguan_ringan->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan"><?= $Page->renderSort($Page->sk_gangguan_ringan) ?></div></th>
<?php } ?>
<?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <th data-name="sk_proses_pikir" class="<?= $Page->sk_proses_pikir->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir"><?= $Page->renderSort($Page->sk_proses_pikir) ?></div></th>
<?php } ?>
<?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
        <th data-name="sk_orientasi" class="<?= $Page->sk_orientasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi"><?= $Page->renderSort($Page->sk_orientasi) ?></div></th>
<?php } ?>
<?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <th data-name="sk_tingkat_kesadaran_orientasi" class="<?= $Page->sk_tingkat_kesadaran_orientasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi"><?= $Page->renderSort($Page->sk_tingkat_kesadaran_orientasi) ?></div></th>
<?php } ?>
<?php if ($Page->sk_memori->Visible) { // sk_memori ?>
        <th data-name="sk_memori" class="<?= $Page->sk_memori->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_memori"><?= $Page->renderSort($Page->sk_memori) ?></div></th>
<?php } ?>
<?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
        <th data-name="sk_interaksi" class="<?= $Page->sk_interaksi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi"><?= $Page->renderSort($Page->sk_interaksi) ?></div></th>
<?php } ?>
<?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <th data-name="sk_konsentrasi" class="<?= $Page->sk_konsentrasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi"><?= $Page->renderSort($Page->sk_konsentrasi) ?></div></th>
<?php } ?>
<?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
        <th data-name="sk_persepsi" class="<?= $Page->sk_persepsi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi"><?= $Page->renderSort($Page->sk_persepsi) ?></div></th>
<?php } ?>
<?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <th data-name="ket_sk_persepsi" class="<?= $Page->ket_sk_persepsi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi"><?= $Page->renderSort($Page->ket_sk_persepsi) ?></div></th>
<?php } ?>
<?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <th data-name="sk_isi_pikir" class="<?= $Page->sk_isi_pikir->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir"><?= $Page->renderSort($Page->sk_isi_pikir) ?></div></th>
<?php } ?>
<?php if ($Page->sk_waham->Visible) { // sk_waham ?>
        <th data-name="sk_waham" class="<?= $Page->sk_waham->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_waham"><?= $Page->renderSort($Page->sk_waham) ?></div></th>
<?php } ?>
<?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <th data-name="ket_sk_waham" class="<?= $Page->ket_sk_waham->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham"><?= $Page->renderSort($Page->ket_sk_waham) ?></div></th>
<?php } ?>
<?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <th data-name="sk_daya_tilik_diri" class="<?= $Page->sk_daya_tilik_diri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri"><?= $Page->renderSort($Page->sk_daya_tilik_diri) ?></div></th>
<?php } ?>
<?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <th data-name="ket_sk_daya_tilik_diri" class="<?= $Page->ket_sk_daya_tilik_diri->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri"><?= $Page->renderSort($Page->ket_sk_daya_tilik_diri) ?></div></th>
<?php } ?>
<?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <th data-name="kk_pembelajaran" class="<?= $Page->kk_pembelajaran->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran"><?= $Page->renderSort($Page->kk_pembelajaran) ?></div></th>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <th data-name="ket_kk_pembelajaran" class="<?= $Page->ket_kk_pembelajaran->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran"><?= $Page->renderSort($Page->ket_kk_pembelajaran) ?></div></th>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <th data-name="ket_kk_pembelajaran_lainnya" class="<?= $Page->ket_kk_pembelajaran_lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya"><?= $Page->renderSort($Page->ket_kk_pembelajaran_lainnya) ?></div></th>
<?php } ?>
<?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <th data-name="kk_Penerjamah" class="<?= $Page->kk_Penerjamah->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah"><?= $Page->renderSort($Page->kk_Penerjamah) ?></div></th>
<?php } ?>
<?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <th data-name="ket_kk_penerjamah_Lainnya" class="<?= $Page->ket_kk_penerjamah_Lainnya->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya"><?= $Page->renderSort($Page->ket_kk_penerjamah_Lainnya) ?></div></th>
<?php } ?>
<?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <th data-name="kk_bahasa_isyarat" class="<?= $Page->kk_bahasa_isyarat->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat"><?= $Page->renderSort($Page->kk_bahasa_isyarat) ?></div></th>
<?php } ?>
<?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <th data-name="kk_kebutuhan_edukasi" class="<?= $Page->kk_kebutuhan_edukasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi"><?= $Page->renderSort($Page->kk_kebutuhan_edukasi) ?></div></th>
<?php } ?>
<?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <th data-name="ket_kk_kebutuhan_edukasi" class="<?= $Page->ket_kk_kebutuhan_edukasi->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi" class="penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi"><?= $Page->renderSort($Page->ket_kk_kebutuhan_edukasi) ?></div></th>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
        <th data-name="rencana" class="<?= $Page->rencana->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_rencana" class="penilaian_awal_keperawatan_ralan_psikiatri_rencana"><?= $Page->renderSort($Page->rencana) ?></div></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th data-name="nip" class="<?= $Page->nip->headerCellClass() ?>"><div id="elh_penilaian_awal_keperawatan_ralan_psikiatri_nip" class="penilaian_awal_keperawatan_ralan_psikiatri_nip"><?= $Page->renderSort($Page->nip) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_penilaian_awal_keperawatan_ralan_psikiatri", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->informasi->Visible) { // informasi ?>
        <td data-name="informasi" <?= $Page->informasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_informasi">
<span<?= $Page->informasi->viewAttributes() ?>>
<?= $Page->informasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <td data-name="rkd_sakit_sejak" <?= $Page->rkd_sakit_sejak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_sakit_sejak">
<span<?= $Page->rkd_sakit_sejak->viewAttributes() ?>>
<?= $Page->rkd_sakit_sejak->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
        <td data-name="rkd_berobat" <?= $Page->rkd_berobat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_berobat">
<span<?= $Page->rkd_berobat->viewAttributes() ?>>
<?= $Page->rkd_berobat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <td data-name="rkd_hasil_pengobatan" <?= $Page->rkd_hasil_pengobatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rkd_hasil_pengobatan">
<span<?= $Page->rkd_hasil_pengobatan->viewAttributes() ?>>
<?= $Page->rkd_hasil_pengobatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <td data-name="fp_putus_obat" <?= $Page->fp_putus_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_putus_obat">
<span<?= $Page->fp_putus_obat->viewAttributes() ?>>
<?= $Page->fp_putus_obat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <td data-name="ket_putus_obat" <?= $Page->ket_putus_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_putus_obat">
<span<?= $Page->ket_putus_obat->viewAttributes() ?>>
<?= $Page->ket_putus_obat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <td data-name="fp_ekonomi" <?= $Page->fp_ekonomi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_ekonomi">
<span<?= $Page->fp_ekonomi->viewAttributes() ?>>
<?= $Page->fp_ekonomi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <td data-name="ket_masalah_ekonomi" <?= $Page->ket_masalah_ekonomi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_ekonomi">
<span<?= $Page->ket_masalah_ekonomi->viewAttributes() ?>>
<?= $Page->ket_masalah_ekonomi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <td data-name="fp_masalah_fisik" <?= $Page->fp_masalah_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_fisik">
<span<?= $Page->fp_masalah_fisik->viewAttributes() ?>>
<?= $Page->fp_masalah_fisik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <td data-name="ket_masalah_fisik" <?= $Page->ket_masalah_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_fisik">
<span<?= $Page->ket_masalah_fisik->viewAttributes() ?>>
<?= $Page->ket_masalah_fisik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <td data-name="fp_masalah_psikososial" <?= $Page->fp_masalah_psikososial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_fp_masalah_psikososial">
<span<?= $Page->fp_masalah_psikososial->viewAttributes() ?>>
<?= $Page->fp_masalah_psikososial->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <td data-name="ket_masalah_psikososial" <?= $Page->ket_masalah_psikososial->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_masalah_psikososial">
<span<?= $Page->ket_masalah_psikososial->viewAttributes() ?>>
<?= $Page->ket_masalah_psikososial->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
        <td data-name="rh_keluarga" <?= $Page->rh_keluarga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rh_keluarga">
<span<?= $Page->rh_keluarga->viewAttributes() ?>>
<?= $Page->rh_keluarga->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <td data-name="ket_rh_keluarga" <?= $Page->ket_rh_keluarga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rh_keluarga">
<span<?= $Page->ket_rh_keluarga->viewAttributes() ?>>
<?= $Page->ket_rh_keluarga->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <td data-name="resiko_bunuh_diri" <?= $Page->resiko_bunuh_diri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resiko_bunuh_diri">
<span<?= $Page->resiko_bunuh_diri->viewAttributes() ?>>
<?= $Page->resiko_bunuh_diri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
        <td data-name="rbd_ide" <?= $Page->rbd_ide->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_ide">
<span<?= $Page->rbd_ide->viewAttributes() ?>>
<?= $Page->rbd_ide->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <td data-name="ket_rbd_ide" <?= $Page->ket_rbd_ide->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_ide">
<span<?= $Page->ket_rbd_ide->viewAttributes() ?>>
<?= $Page->ket_rbd_ide->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
        <td data-name="rbd_rencana" <?= $Page->rbd_rencana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_rencana">
<span<?= $Page->rbd_rencana->viewAttributes() ?>>
<?= $Page->rbd_rencana->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <td data-name="ket_rbd_rencana" <?= $Page->ket_rbd_rencana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_rencana">
<span<?= $Page->ket_rbd_rencana->viewAttributes() ?>>
<?= $Page->ket_rbd_rencana->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
        <td data-name="rbd_alat" <?= $Page->rbd_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_alat">
<span<?= $Page->rbd_alat->viewAttributes() ?>>
<?= $Page->rbd_alat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <td data-name="ket_rbd_alat" <?= $Page->ket_rbd_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_alat">
<span<?= $Page->ket_rbd_alat->viewAttributes() ?>>
<?= $Page->ket_rbd_alat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <td data-name="rbd_percobaan" <?= $Page->rbd_percobaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_percobaan">
<span<?= $Page->rbd_percobaan->viewAttributes() ?>>
<?= $Page->rbd_percobaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <td data-name="ket_rbd_percobaan" <?= $Page->ket_rbd_percobaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_percobaan">
<span<?= $Page->ket_rbd_percobaan->viewAttributes() ?>>
<?= $Page->ket_rbd_percobaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <td data-name="rbd_keinginan" <?= $Page->rbd_keinginan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rbd_keinginan">
<span<?= $Page->rbd_keinginan->viewAttributes() ?>>
<?= $Page->rbd_keinginan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <td data-name="ket_rbd_keinginan" <?= $Page->ket_rbd_keinginan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rbd_keinginan">
<span<?= $Page->ket_rbd_keinginan->viewAttributes() ?>>
<?= $Page->ket_rbd_keinginan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <td data-name="rpo_penggunaan" <?= $Page->rpo_penggunaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan">
<span<?= $Page->rpo_penggunaan->viewAttributes() ?>>
<?= $Page->rpo_penggunaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <td data-name="ket_rpo_penggunaan" <?= $Page->ket_rpo_penggunaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_penggunaan">
<span<?= $Page->ket_rpo_penggunaan->viewAttributes() ?>>
<?= $Page->ket_rpo_penggunaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <td data-name="rpo_efek_samping" <?= $Page->rpo_efek_samping->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_efek_samping">
<span<?= $Page->rpo_efek_samping->viewAttributes() ?>>
<?= $Page->rpo_efek_samping->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <td data-name="ket_rpo_efek_samping" <?= $Page->ket_rpo_efek_samping->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_efek_samping">
<span<?= $Page->ket_rpo_efek_samping->viewAttributes() ?>>
<?= $Page->ket_rpo_efek_samping->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
        <td data-name="rpo_napza" <?= $Page->rpo_napza->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_napza">
<span<?= $Page->rpo_napza->viewAttributes() ?>>
<?= $Page->rpo_napza->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <td data-name="ket_rpo_napza" <?= $Page->ket_rpo_napza->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_rpo_napza">
<span<?= $Page->ket_rpo_napza->viewAttributes() ?>>
<?= $Page->ket_rpo_napza->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <td data-name="ket_lama_pemakaian" <?= $Page->ket_lama_pemakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lama_pemakaian">
<span<?= $Page->ket_lama_pemakaian->viewAttributes() ?>>
<?= $Page->ket_lama_pemakaian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <td data-name="ket_cara_pemakaian" <?= $Page->ket_cara_pemakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_cara_pemakaian">
<span<?= $Page->ket_cara_pemakaian->viewAttributes() ?>>
<?= $Page->ket_cara_pemakaian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <td data-name="ket_latar_belakang_pemakaian" <?= $Page->ket_latar_belakang_pemakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_latar_belakang_pemakaian">
<span<?= $Page->ket_latar_belakang_pemakaian->viewAttributes() ?>>
<?= $Page->ket_latar_belakang_pemakaian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <td data-name="rpo_penggunaan_obat_lainnya" <?= $Page->rpo_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_penggunaan_obat_lainnya">
<span<?= $Page->rpo_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->rpo_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <td data-name="ket_penggunaan_obat_lainnya" <?= $Page->ket_penggunaan_obat_lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_penggunaan_obat_lainnya">
<span<?= $Page->ket_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->ket_penggunaan_obat_lainnya->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <td data-name="ket_alasan_penggunaan" <?= $Page->ket_alasan_penggunaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alasan_penggunaan">
<span<?= $Page->ket_alasan_penggunaan->viewAttributes() ?>>
<?= $Page->ket_alasan_penggunaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <td data-name="rpo_alergi_obat" <?= $Page->rpo_alergi_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_alergi_obat">
<span<?= $Page->rpo_alergi_obat->viewAttributes() ?>>
<?= $Page->rpo_alergi_obat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <td data-name="ket_alergi_obat" <?= $Page->ket_alergi_obat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_alergi_obat">
<span<?= $Page->ket_alergi_obat->viewAttributes() ?>>
<?= $Page->ket_alergi_obat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
        <td data-name="rpo_merokok" <?= $Page->rpo_merokok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_merokok">
<span<?= $Page->rpo_merokok->viewAttributes() ?>>
<?= $Page->rpo_merokok->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
        <td data-name="ket_merokok" <?= $Page->ket_merokok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_merokok">
<span<?= $Page->ket_merokok->viewAttributes() ?>>
<?= $Page->ket_merokok->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <td data-name="rpo_minum_kopi" <?= $Page->rpo_minum_kopi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rpo_minum_kopi">
<span<?= $Page->rpo_minum_kopi->viewAttributes() ?>>
<?= $Page->rpo_minum_kopi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <td data-name="ket_minum_kopi" <?= $Page->ket_minum_kopi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_minum_kopi">
<span<?= $Page->ket_minum_kopi->viewAttributes() ?>>
<?= $Page->ket_minum_kopi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->td->Visible) { // td ?>
        <td data-name="td" <?= $Page->td->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nadi->Visible) { // nadi ?>
        <td data-name="nadi" <?= $Page->nadi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gcs->Visible) { // gcs ?>
        <td data-name="gcs" <?= $Page->gcs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rr->Visible) { // rr ?>
        <td data-name="rr" <?= $Page->rr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->suhu->Visible) { // suhu ?>
        <td data-name="suhu" <?= $Page->suhu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <td data-name="pf_keluhan_fisik" <?= $Page->pf_keluhan_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pf_keluhan_fisik">
<span<?= $Page->pf_keluhan_fisik->viewAttributes() ?>>
<?= $Page->pf_keluhan_fisik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <td data-name="ket_keluhan_fisik" <?= $Page->ket_keluhan_fisik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_keluhan_fisik">
<span<?= $Page->ket_keluhan_fisik->viewAttributes() ?>>
<?= $Page->ket_keluhan_fisik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
        <td data-name="skala_nyeri" <?= $Page->skala_nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_skala_nyeri">
<span<?= $Page->skala_nyeri->viewAttributes() ?>>
<?= $Page->skala_nyeri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->durasi->Visible) { // durasi ?>
        <td data-name="durasi" <?= $Page->durasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nyeri->Visible) { // nyeri ?>
        <td data-name="nyeri" <?= $Page->nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri">
<span<?= $Page->nyeri->viewAttributes() ?>>
<?= $Page->nyeri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->provokes->Visible) { // provokes ?>
        <td data-name="provokes" <?= $Page->provokes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_provokes">
<span<?= $Page->provokes->viewAttributes() ?>>
<?= $Page->provokes->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
        <td data-name="ket_provokes" <?= $Page->ket_provokes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_provokes">
<span<?= $Page->ket_provokes->viewAttributes() ?>>
<?= $Page->ket_provokes->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->quality->Visible) { // quality ?>
        <td data-name="quality" <?= $Page->quality->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_quality">
<span<?= $Page->quality->viewAttributes() ?>>
<?= $Page->quality->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_quality->Visible) { // ket_quality ?>
        <td data-name="ket_quality" <?= $Page->ket_quality->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_quality">
<span<?= $Page->ket_quality->viewAttributes() ?>>
<?= $Page->ket_quality->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lokasi->Visible) { // lokasi ?>
        <td data-name="lokasi" <?= $Page->lokasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->menyebar->Visible) { // menyebar ?>
        <td data-name="menyebar" <?= $Page->menyebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_menyebar">
<span<?= $Page->menyebar->viewAttributes() ?>>
<?= $Page->menyebar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
        <td data-name="pada_dokter" <?= $Page->pada_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_pada_dokter">
<span<?= $Page->pada_dokter->viewAttributes() ?>>
<?= $Page->pada_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
        <td data-name="ket_dokter" <?= $Page->ket_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_dokter">
<span<?= $Page->ket_dokter->viewAttributes() ?>>
<?= $Page->ket_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <td data-name="nyeri_hilang" <?= $Page->nyeri_hilang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nyeri_hilang">
<span<?= $Page->nyeri_hilang->viewAttributes() ?>>
<?= $Page->nyeri_hilang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
        <td data-name="ket_nyeri" <?= $Page->ket_nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_nyeri">
<span<?= $Page->ket_nyeri->viewAttributes() ?>>
<?= $Page->ket_nyeri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bb->Visible) { // bb ?>
        <td data-name="bb" <?= $Page->bb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tb->Visible) { // tb ?>
        <td data-name="tb" <?= $Page->tb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bmi->Visible) { // bmi ?>
        <td data-name="bmi" <?= $Page->bmi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bmi">
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <td data-name="lapor_status_nutrisi" <?= $Page->lapor_status_nutrisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor_status_nutrisi">
<span<?= $Page->lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->lapor_status_nutrisi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <td data-name="ket_lapor_status_nutrisi" <?= $Page->ket_lapor_status_nutrisi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor_status_nutrisi">
<span<?= $Page->ket_lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->ket_lapor_status_nutrisi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sg1->Visible) { // sg1 ?>
        <td data-name="sg1" <?= $Page->sg1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg1">
<span<?= $Page->sg1->viewAttributes() ?>>
<?= $Page->sg1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nilai1->Visible) { // nilai1 ?>
        <td data-name="nilai1" <?= $Page->nilai1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai1">
<span<?= $Page->nilai1->viewAttributes() ?>>
<?= $Page->nilai1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sg2->Visible) { // sg2 ?>
        <td data-name="sg2" <?= $Page->sg2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sg2">
<span<?= $Page->sg2->viewAttributes() ?>>
<?= $Page->sg2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nilai2->Visible) { // nilai2 ?>
        <td data-name="nilai2" <?= $Page->nilai2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nilai2">
<span<?= $Page->nilai2->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_nilai2_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->nilai2->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->nilai2->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_nilai2_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_hasil->Visible) { // total_hasil ?>
        <td data-name="total_hasil" <?= $Page->total_hasil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_total_hasil">
<span<?= $Page->total_hasil->viewAttributes() ?>>
<?= $Page->total_hasil->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
        <td data-name="resikojatuh" <?= $Page->resikojatuh->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_resikojatuh">
<span<?= $Page->resikojatuh->viewAttributes() ?>>
<?= $Page->resikojatuh->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bjm->Visible) { // bjm ?>
        <td data-name="bjm" <?= $Page->bjm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_bjm">
<span<?= $Page->bjm->viewAttributes() ?>>
<?= $Page->bjm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->msa->Visible) { // msa ?>
        <td data-name="msa" <?= $Page->msa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_msa">
<span<?= $Page->msa->viewAttributes() ?>>
<?= $Page->msa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->hasil->Visible) { // hasil ?>
        <td data-name="hasil" <?= $Page->hasil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_hasil">
<span<?= $Page->hasil->viewAttributes() ?>>
<?= $Page->hasil->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lapor->Visible) { // lapor ?>
        <td data-name="lapor" <?= $Page->lapor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_lapor">
<span<?= $Page->lapor->viewAttributes() ?>>
<?= $Page->lapor->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
        <td data-name="ket_lapor" <?= $Page->ket_lapor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_lapor">
<span<?= $Page->ket_lapor->viewAttributes() ?>>
<?= $Page->ket_lapor->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
        <td data-name="adl_mandi" <?= $Page->adl_mandi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_mandi">
<span<?= $Page->adl_mandi->viewAttributes() ?>>
<?= $Page->adl_mandi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <td data-name="adl_berpakaian" <?= $Page->adl_berpakaian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_berpakaian">
<span<?= $Page->adl_berpakaian->viewAttributes() ?>>
<?= $Page->adl_berpakaian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_makan->Visible) { // adl_makan ?>
        <td data-name="adl_makan" <?= $Page->adl_makan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_makan">
<span<?= $Page->adl_makan->viewAttributes() ?>>
<?= $Page->adl_makan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_bak->Visible) { // adl_bak ?>
        <td data-name="adl_bak" <?= $Page->adl_bak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bak">
<span<?= $Page->adl_bak->viewAttributes() ?>>
<?= $Page->adl_bak->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_bab->Visible) { // adl_bab ?>
        <td data-name="adl_bab" <?= $Page->adl_bab->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_bab">
<span<?= $Page->adl_bab->viewAttributes() ?>>
<?= $Page->adl_bab->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
        <td data-name="adl_hobi" <?= $Page->adl_hobi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_hobi">
<span<?= $Page->adl_hobi->viewAttributes() ?>>
<?= $Page->adl_hobi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <td data-name="ket_adl_hobi" <?= $Page->ket_adl_hobi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_hobi">
<span<?= $Page->ket_adl_hobi->viewAttributes() ?>>
<?= $Page->ket_adl_hobi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <td data-name="adl_sosialisasi" <?= $Page->adl_sosialisasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_sosialisasi">
<span<?= $Page->adl_sosialisasi->viewAttributes() ?>>
<?= $Page->adl_sosialisasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <td data-name="ket_adl_sosialisasi" <?= $Page->ket_adl_sosialisasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_sosialisasi">
<span<?= $Page->ket_adl_sosialisasi->viewAttributes() ?>>
<?= $Page->ket_adl_sosialisasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <td data-name="adl_kegiatan" <?= $Page->adl_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_adl_kegiatan">
<span<?= $Page->adl_kegiatan->viewAttributes() ?>>
<?= $Page->adl_kegiatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <td data-name="ket_adl_kegiatan" <?= $Page->ket_adl_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_adl_kegiatan">
<span<?= $Page->ket_adl_kegiatan->viewAttributes() ?>>
<?= $Page->ket_adl_kegiatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
        <td data-name="sk_penampilan" <?= $Page->sk_penampilan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_penampilan">
<span<?= $Page->sk_penampilan->viewAttributes() ?>>
<?= $Page->sk_penampilan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <td data-name="sk_alam_perasaan" <?= $Page->sk_alam_perasaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_alam_perasaan">
<span<?= $Page->sk_alam_perasaan->viewAttributes() ?>>
<?= $Page->sk_alam_perasaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <td data-name="sk_pembicaraan" <?= $Page->sk_pembicaraan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_pembicaraan">
<span<?= $Page->sk_pembicaraan->viewAttributes() ?>>
<?= $Page->sk_pembicaraan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_afek->Visible) { // sk_afek ?>
        <td data-name="sk_afek" <?= $Page->sk_afek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_afek">
<span<?= $Page->sk_afek->viewAttributes() ?>>
<?= $Page->sk_afek->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <td data-name="sk_aktifitas_motorik" <?= $Page->sk_aktifitas_motorik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_aktifitas_motorik">
<span<?= $Page->sk_aktifitas_motorik->viewAttributes() ?>>
<?= $Page->sk_aktifitas_motorik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <td data-name="sk_gangguan_ringan" <?= $Page->sk_gangguan_ringan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_gangguan_ringan">
<span<?= $Page->sk_gangguan_ringan->viewAttributes() ?>>
<?= $Page->sk_gangguan_ringan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <td data-name="sk_proses_pikir" <?= $Page->sk_proses_pikir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_proses_pikir">
<span<?= $Page->sk_proses_pikir->viewAttributes() ?>>
<?= $Page->sk_proses_pikir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
        <td data-name="sk_orientasi" <?= $Page->sk_orientasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_orientasi">
<span<?= $Page->sk_orientasi->viewAttributes() ?>>
<?= $Page->sk_orientasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <td data-name="sk_tingkat_kesadaran_orientasi" <?= $Page->sk_tingkat_kesadaran_orientasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_tingkat_kesadaran_orientasi">
<span<?= $Page->sk_tingkat_kesadaran_orientasi->viewAttributes() ?>>
<?= $Page->sk_tingkat_kesadaran_orientasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_memori->Visible) { // sk_memori ?>
        <td data-name="sk_memori" <?= $Page->sk_memori->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_memori">
<span<?= $Page->sk_memori->viewAttributes() ?>>
<?= $Page->sk_memori->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
        <td data-name="sk_interaksi" <?= $Page->sk_interaksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_interaksi">
<span<?= $Page->sk_interaksi->viewAttributes() ?>>
<?= $Page->sk_interaksi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <td data-name="sk_konsentrasi" <?= $Page->sk_konsentrasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_konsentrasi">
<span<?= $Page->sk_konsentrasi->viewAttributes() ?>>
<?= $Page->sk_konsentrasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
        <td data-name="sk_persepsi" <?= $Page->sk_persepsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_persepsi">
<span<?= $Page->sk_persepsi->viewAttributes() ?>>
<?= $Page->sk_persepsi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <td data-name="ket_sk_persepsi" <?= $Page->ket_sk_persepsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_persepsi">
<span<?= $Page->ket_sk_persepsi->viewAttributes() ?>>
<?= $Page->ket_sk_persepsi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <td data-name="sk_isi_pikir" <?= $Page->sk_isi_pikir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_isi_pikir">
<span<?= $Page->sk_isi_pikir->viewAttributes() ?>>
<?= $Page->sk_isi_pikir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_waham->Visible) { // sk_waham ?>
        <td data-name="sk_waham" <?= $Page->sk_waham->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_waham">
<span<?= $Page->sk_waham->viewAttributes() ?>>
<?= $Page->sk_waham->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <td data-name="ket_sk_waham" <?= $Page->ket_sk_waham->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_waham">
<span<?= $Page->ket_sk_waham->viewAttributes() ?>>
<?= $Page->ket_sk_waham->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <td data-name="sk_daya_tilik_diri" <?= $Page->sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_sk_daya_tilik_diri">
<span<?= $Page->sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->sk_daya_tilik_diri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <td data-name="ket_sk_daya_tilik_diri" <?= $Page->ket_sk_daya_tilik_diri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_sk_daya_tilik_diri">
<span<?= $Page->ket_sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->ket_sk_daya_tilik_diri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <td data-name="kk_pembelajaran" <?= $Page->kk_pembelajaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_pembelajaran">
<span<?= $Page->kk_pembelajaran->viewAttributes() ?>>
<?= $Page->kk_pembelajaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <td data-name="ket_kk_pembelajaran" <?= $Page->ket_kk_pembelajaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran">
<span<?= $Page->ket_kk_pembelajaran->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <td data-name="ket_kk_pembelajaran_lainnya" <?= $Page->ket_kk_pembelajaran_lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_pembelajaran_lainnya">
<span<?= $Page->ket_kk_pembelajaran_lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran_lainnya->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <td data-name="kk_Penerjamah" <?= $Page->kk_Penerjamah->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_Penerjamah">
<span<?= $Page->kk_Penerjamah->viewAttributes() ?>>
<?= $Page->kk_Penerjamah->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <td data-name="ket_kk_penerjamah_Lainnya" <?= $Page->ket_kk_penerjamah_Lainnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_penerjamah_Lainnya">
<span<?= $Page->ket_kk_penerjamah_Lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_penerjamah_Lainnya->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <td data-name="kk_bahasa_isyarat" <?= $Page->kk_bahasa_isyarat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_bahasa_isyarat">
<span<?= $Page->kk_bahasa_isyarat->viewAttributes() ?>>
<?= $Page->kk_bahasa_isyarat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <td data-name="kk_kebutuhan_edukasi" <?= $Page->kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_kk_kebutuhan_edukasi">
<span<?= $Page->kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <td data-name="ket_kk_kebutuhan_edukasi" <?= $Page->ket_kk_kebutuhan_edukasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_ket_kk_kebutuhan_edukasi">
<span<?= $Page->ket_kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->ket_kk_kebutuhan_edukasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rencana->Visible) { // rencana ?>
        <td data-name="rencana" <?= $Page->rencana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_rencana">
<span<?= $Page->rencana->viewAttributes() ?>>
<?= $Page->rencana->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nip->Visible) { // nip ?>
        <td data-name="nip" <?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_psikiatri_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
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
    ew.addEventHandlers("penilaian_awal_keperawatan_ralan_psikiatri");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
