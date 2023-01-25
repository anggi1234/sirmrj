<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MasterPasienList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmaster_pasienlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fmaster_pasienlist = currentForm = new ew.Form("fmaster_pasienlist", "list");
    fmaster_pasienlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fmaster_pasienlist");
});
var fmaster_pasienlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fmaster_pasienlistsrch = currentSearchForm = new ew.Form("fmaster_pasienlistsrch");

    // Dynamic selection lists

    // Filters
    fmaster_pasienlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmaster_pasienlistsrch");
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
<form name="fmaster_pasienlistsrch" id="fmaster_pasienlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmaster_pasienlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="master_pasien">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> master_pasien">
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
<form name="fmaster_pasienlist" id="fmaster_pasienlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="master_pasien">
<div id="gmp_master_pasien" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_master_pasienlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id_pasien->Visible) { // id_pasien ?>
        <th data-name="id_pasien" class="<?= $Page->id_pasien->headerCellClass() ?>"><div id="elh_master_pasien_id_pasien" class="master_pasien_id_pasien"><?= $Page->renderSort($Page->id_pasien) ?></div></th>
<?php } ?>
<?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
        <th data-name="nama_pasien" class="<?= $Page->nama_pasien->headerCellClass() ?>"><div id="elh_master_pasien_nama_pasien" class="master_pasien_nama_pasien"><?= $Page->renderSort($Page->nama_pasien) ?></div></th>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <th data-name="no_rekam_medis" class="<?= $Page->no_rekam_medis->headerCellClass() ?>"><div id="elh_master_pasien_no_rekam_medis" class="master_pasien_no_rekam_medis"><?= $Page->renderSort($Page->no_rekam_medis) ?></div></th>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_master_pasien_nik" class="master_pasien_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->no_identitas_lain->Visible) { // no_identitas_lain ?>
        <th data-name="no_identitas_lain" class="<?= $Page->no_identitas_lain->headerCellClass() ?>"><div id="elh_master_pasien_no_identitas_lain" class="master_pasien_no_identitas_lain"><?= $Page->renderSort($Page->no_identitas_lain) ?></div></th>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <th data-name="nama_ibu" class="<?= $Page->nama_ibu->headerCellClass() ?>"><div id="elh_master_pasien_nama_ibu" class="master_pasien_nama_ibu"><?= $Page->renderSort($Page->nama_ibu) ?></div></th>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <th data-name="tempat_lahir" class="<?= $Page->tempat_lahir->headerCellClass() ?>"><div id="elh_master_pasien_tempat_lahir" class="master_pasien_tempat_lahir"><?= $Page->renderSort($Page->tempat_lahir) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <th data-name="tanggal_lahir" class="<?= $Page->tanggal_lahir->headerCellClass() ?>"><div id="elh_master_pasien_tanggal_lahir" class="master_pasien_tanggal_lahir"><?= $Page->renderSort($Page->tanggal_lahir) ?></div></th>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <th data-name="jenis_kelamin" class="<?= $Page->jenis_kelamin->headerCellClass() ?>"><div id="elh_master_pasien_jenis_kelamin" class="master_pasien_jenis_kelamin"><?= $Page->renderSort($Page->jenis_kelamin) ?></div></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th data-name="agama" class="<?= $Page->agama->headerCellClass() ?>"><div id="elh_master_pasien_agama" class="master_pasien_agama"><?= $Page->renderSort($Page->agama) ?></div></th>
<?php } ?>
<?php if ($Page->suku->Visible) { // suku ?>
        <th data-name="suku" class="<?= $Page->suku->headerCellClass() ?>"><div id="elh_master_pasien_suku" class="master_pasien_suku"><?= $Page->renderSort($Page->suku) ?></div></th>
<?php } ?>
<?php if ($Page->bahasa->Visible) { // bahasa ?>
        <th data-name="bahasa" class="<?= $Page->bahasa->headerCellClass() ?>"><div id="elh_master_pasien_bahasa" class="master_pasien_bahasa"><?= $Page->renderSort($Page->bahasa) ?></div></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th data-name="alamat" class="<?= $Page->alamat->headerCellClass() ?>"><div id="elh_master_pasien_alamat" class="master_pasien_alamat"><?= $Page->renderSort($Page->alamat) ?></div></th>
<?php } ?>
<?php if ($Page->rt->Visible) { // rt ?>
        <th data-name="rt" class="<?= $Page->rt->headerCellClass() ?>"><div id="elh_master_pasien_rt" class="master_pasien_rt"><?= $Page->renderSort($Page->rt) ?></div></th>
<?php } ?>
<?php if ($Page->rw->Visible) { // rw ?>
        <th data-name="rw" class="<?= $Page->rw->headerCellClass() ?>"><div id="elh_master_pasien_rw" class="master_pasien_rw"><?= $Page->renderSort($Page->rw) ?></div></th>
<?php } ?>
<?php if ($Page->keluarahan_desa->Visible) { // keluarahan_desa ?>
        <th data-name="keluarahan_desa" class="<?= $Page->keluarahan_desa->headerCellClass() ?>"><div id="elh_master_pasien_keluarahan_desa" class="master_pasien_keluarahan_desa"><?= $Page->renderSort($Page->keluarahan_desa) ?></div></th>
<?php } ?>
<?php if ($Page->kecamatan->Visible) { // kecamatan ?>
        <th data-name="kecamatan" class="<?= $Page->kecamatan->headerCellClass() ?>"><div id="elh_master_pasien_kecamatan" class="master_pasien_kecamatan"><?= $Page->renderSort($Page->kecamatan) ?></div></th>
<?php } ?>
<?php if ($Page->kabupaten_kota->Visible) { // kabupaten_kota ?>
        <th data-name="kabupaten_kota" class="<?= $Page->kabupaten_kota->headerCellClass() ?>"><div id="elh_master_pasien_kabupaten_kota" class="master_pasien_kabupaten_kota"><?= $Page->renderSort($Page->kabupaten_kota) ?></div></th>
<?php } ?>
<?php if ($Page->kodepos->Visible) { // kodepos ?>
        <th data-name="kodepos" class="<?= $Page->kodepos->headerCellClass() ?>"><div id="elh_master_pasien_kodepos" class="master_pasien_kodepos"><?= $Page->renderSort($Page->kodepos) ?></div></th>
<?php } ?>
<?php if ($Page->provinsi->Visible) { // provinsi ?>
        <th data-name="provinsi" class="<?= $Page->provinsi->headerCellClass() ?>"><div id="elh_master_pasien_provinsi" class="master_pasien_provinsi"><?= $Page->renderSort($Page->provinsi) ?></div></th>
<?php } ?>
<?php if ($Page->negara->Visible) { // negara ?>
        <th data-name="negara" class="<?= $Page->negara->headerCellClass() ?>"><div id="elh_master_pasien_negara" class="master_pasien_negara"><?= $Page->renderSort($Page->negara) ?></div></th>
<?php } ?>
<?php if ($Page->alamat_domisili->Visible) { // alamat_domisili ?>
        <th data-name="alamat_domisili" class="<?= $Page->alamat_domisili->headerCellClass() ?>"><div id="elh_master_pasien_alamat_domisili" class="master_pasien_alamat_domisili"><?= $Page->renderSort($Page->alamat_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->rt_domisili->Visible) { // rt_domisili ?>
        <th data-name="rt_domisili" class="<?= $Page->rt_domisili->headerCellClass() ?>"><div id="elh_master_pasien_rt_domisili" class="master_pasien_rt_domisili"><?= $Page->renderSort($Page->rt_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->rw_domisili->Visible) { // rw_domisili ?>
        <th data-name="rw_domisili" class="<?= $Page->rw_domisili->headerCellClass() ?>"><div id="elh_master_pasien_rw_domisili" class="master_pasien_rw_domisili"><?= $Page->renderSort($Page->rw_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->kel_desa_domisili->Visible) { // kel_desa_domisili ?>
        <th data-name="kel_desa_domisili" class="<?= $Page->kel_desa_domisili->headerCellClass() ?>"><div id="elh_master_pasien_kel_desa_domisili" class="master_pasien_kel_desa_domisili"><?= $Page->renderSort($Page->kel_desa_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->kec_domisili->Visible) { // kec_domisili ?>
        <th data-name="kec_domisili" class="<?= $Page->kec_domisili->headerCellClass() ?>"><div id="elh_master_pasien_kec_domisili" class="master_pasien_kec_domisili"><?= $Page->renderSort($Page->kec_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->kota_kab_domisili->Visible) { // kota_kab_domisili ?>
        <th data-name="kota_kab_domisili" class="<?= $Page->kota_kab_domisili->headerCellClass() ?>"><div id="elh_master_pasien_kota_kab_domisili" class="master_pasien_kota_kab_domisili"><?= $Page->renderSort($Page->kota_kab_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->kodepos_domisili->Visible) { // kodepos_domisili ?>
        <th data-name="kodepos_domisili" class="<?= $Page->kodepos_domisili->headerCellClass() ?>"><div id="elh_master_pasien_kodepos_domisili" class="master_pasien_kodepos_domisili"><?= $Page->renderSort($Page->kodepos_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->prov_domisili->Visible) { // prov_domisili ?>
        <th data-name="prov_domisili" class="<?= $Page->prov_domisili->headerCellClass() ?>"><div id="elh_master_pasien_prov_domisili" class="master_pasien_prov_domisili"><?= $Page->renderSort($Page->prov_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->negara_domisili->Visible) { // negara_domisili ?>
        <th data-name="negara_domisili" class="<?= $Page->negara_domisili->headerCellClass() ?>"><div id="elh_master_pasien_negara_domisili" class="master_pasien_negara_domisili"><?= $Page->renderSort($Page->negara_domisili) ?></div></th>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
        <th data-name="no_telp" class="<?= $Page->no_telp->headerCellClass() ?>"><div id="elh_master_pasien_no_telp" class="master_pasien_no_telp"><?= $Page->renderSort($Page->no_telp) ?></div></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th data-name="no_hp" class="<?= $Page->no_hp->headerCellClass() ?>"><div id="elh_master_pasien_no_hp" class="master_pasien_no_hp"><?= $Page->renderSort($Page->no_hp) ?></div></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th data-name="pendidikan" class="<?= $Page->pendidikan->headerCellClass() ?>"><div id="elh_master_pasien_pendidikan" class="master_pasien_pendidikan"><?= $Page->renderSort($Page->pendidikan) ?></div></th>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <th data-name="pekerjaan" class="<?= $Page->pekerjaan->headerCellClass() ?>"><div id="elh_master_pasien_pekerjaan" class="master_pasien_pekerjaan"><?= $Page->renderSort($Page->pekerjaan) ?></div></th>
<?php } ?>
<?php if ($Page->status_kawin->Visible) { // status_kawin ?>
        <th data-name="status_kawin" class="<?= $Page->status_kawin->headerCellClass() ?>"><div id="elh_master_pasien_status_kawin" class="master_pasien_status_kawin"><?= $Page->renderSort($Page->status_kawin) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <th data-name="tgl_daftar" class="<?= $Page->tgl_daftar->headerCellClass() ?>"><div id="elh_master_pasien_tgl_daftar" class="master_pasien_tgl_daftar"><?= $Page->renderSort($Page->tgl_daftar) ?></div></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th data-name="_username" class="<?= $Page->_username->headerCellClass() ?>"><div id="elh_master_pasien__username" class="master_pasien__username"><?= $Page->renderSort($Page->_username) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_master_pasien", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id_pasien->Visible) { // id_pasien ?>
        <td data-name="id_pasien" <?= $Page->id_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_id_pasien">
<span<?= $Page->id_pasien->viewAttributes() ?>>
<?= $Page->id_pasien->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
        <td data-name="nama_pasien" <?= $Page->nama_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_nama_pasien">
<span<?= $Page->nama_pasien->viewAttributes() ?>>
<?= $Page->nama_pasien->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <td data-name="no_rekam_medis" <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_rekam_medis">
<span<?= $Page->no_rekam_medis->viewAttributes() ?>>
<?= $Page->no_rekam_medis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nik->Visible) { // nik ?>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_identitas_lain->Visible) { // no_identitas_lain ?>
        <td data-name="no_identitas_lain" <?= $Page->no_identitas_lain->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_identitas_lain">
<span<?= $Page->no_identitas_lain->viewAttributes() ?>>
<?= $Page->no_identitas_lain->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <td data-name="nama_ibu" <?= $Page->nama_ibu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_nama_ibu">
<span<?= $Page->nama_ibu->viewAttributes() ?>>
<?= $Page->nama_ibu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <td data-name="tempat_lahir" <?= $Page->tempat_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_tempat_lahir">
<span<?= $Page->tempat_lahir->viewAttributes() ?>>
<?= $Page->tempat_lahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <td data-name="tanggal_lahir" <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <td data-name="jenis_kelamin" <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->agama->Visible) { // agama ?>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->suku->Visible) { // suku ?>
        <td data-name="suku" <?= $Page->suku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_suku">
<span<?= $Page->suku->viewAttributes() ?>>
<?= $Page->suku->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bahasa->Visible) { // bahasa ?>
        <td data-name="bahasa" <?= $Page->bahasa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_bahasa">
<span<?= $Page->bahasa->viewAttributes() ?>>
<?= $Page->bahasa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alamat->Visible) { // alamat ?>
        <td data-name="alamat" <?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rt->Visible) { // rt ?>
        <td data-name="rt" <?= $Page->rt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rt">
<span<?= $Page->rt->viewAttributes() ?>>
<?= $Page->rt->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rw->Visible) { // rw ?>
        <td data-name="rw" <?= $Page->rw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rw">
<span<?= $Page->rw->viewAttributes() ?>>
<?= $Page->rw->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keluarahan_desa->Visible) { // keluarahan_desa ?>
        <td data-name="keluarahan_desa" <?= $Page->keluarahan_desa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_keluarahan_desa">
<span<?= $Page->keluarahan_desa->viewAttributes() ?>>
<?= $Page->keluarahan_desa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kecamatan->Visible) { // kecamatan ?>
        <td data-name="kecamatan" <?= $Page->kecamatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kecamatan">
<span<?= $Page->kecamatan->viewAttributes() ?>>
<?= $Page->kecamatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kabupaten_kota->Visible) { // kabupaten_kota ?>
        <td data-name="kabupaten_kota" <?= $Page->kabupaten_kota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kabupaten_kota">
<span<?= $Page->kabupaten_kota->viewAttributes() ?>>
<?= $Page->kabupaten_kota->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kodepos->Visible) { // kodepos ?>
        <td data-name="kodepos" <?= $Page->kodepos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kodepos">
<span<?= $Page->kodepos->viewAttributes() ?>>
<?= $Page->kodepos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->provinsi->Visible) { // provinsi ?>
        <td data-name="provinsi" <?= $Page->provinsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_provinsi">
<span<?= $Page->provinsi->viewAttributes() ?>>
<?= $Page->provinsi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->negara->Visible) { // negara ?>
        <td data-name="negara" <?= $Page->negara->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_negara">
<span<?= $Page->negara->viewAttributes() ?>>
<?= $Page->negara->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alamat_domisili->Visible) { // alamat_domisili ?>
        <td data-name="alamat_domisili" <?= $Page->alamat_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_alamat_domisili">
<span<?= $Page->alamat_domisili->viewAttributes() ?>>
<?= $Page->alamat_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rt_domisili->Visible) { // rt_domisili ?>
        <td data-name="rt_domisili" <?= $Page->rt_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rt_domisili">
<span<?= $Page->rt_domisili->viewAttributes() ?>>
<?= $Page->rt_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rw_domisili->Visible) { // rw_domisili ?>
        <td data-name="rw_domisili" <?= $Page->rw_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rw_domisili">
<span<?= $Page->rw_domisili->viewAttributes() ?>>
<?= $Page->rw_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kel_desa_domisili->Visible) { // kel_desa_domisili ?>
        <td data-name="kel_desa_domisili" <?= $Page->kel_desa_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kel_desa_domisili">
<span<?= $Page->kel_desa_domisili->viewAttributes() ?>>
<?= $Page->kel_desa_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kec_domisili->Visible) { // kec_domisili ?>
        <td data-name="kec_domisili" <?= $Page->kec_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kec_domisili">
<span<?= $Page->kec_domisili->viewAttributes() ?>>
<?= $Page->kec_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kota_kab_domisili->Visible) { // kota_kab_domisili ?>
        <td data-name="kota_kab_domisili" <?= $Page->kota_kab_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kota_kab_domisili">
<span<?= $Page->kota_kab_domisili->viewAttributes() ?>>
<?= $Page->kota_kab_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kodepos_domisili->Visible) { // kodepos_domisili ?>
        <td data-name="kodepos_domisili" <?= $Page->kodepos_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kodepos_domisili">
<span<?= $Page->kodepos_domisili->viewAttributes() ?>>
<?= $Page->kodepos_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prov_domisili->Visible) { // prov_domisili ?>
        <td data-name="prov_domisili" <?= $Page->prov_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_prov_domisili">
<span<?= $Page->prov_domisili->viewAttributes() ?>>
<?= $Page->prov_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->negara_domisili->Visible) { // negara_domisili ?>
        <td data-name="negara_domisili" <?= $Page->negara_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_negara_domisili">
<span<?= $Page->negara_domisili->viewAttributes() ?>>
<?= $Page->negara_domisili->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_telp->Visible) { // no_telp ?>
        <td data-name="no_telp" <?= $Page->no_telp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_telp">
<span<?= $Page->no_telp->viewAttributes() ?>>
<?= $Page->no_telp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td data-name="no_hp" <?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td data-name="pendidikan" <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <td data-name="pekerjaan" <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status_kawin->Visible) { // status_kawin ?>
        <td data-name="status_kawin" <?= $Page->status_kawin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_status_kawin">
<span<?= $Page->status_kawin->viewAttributes() ?>>
<?= $Page->status_kawin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <td data-name="tgl_daftar" <?= $Page->tgl_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_tgl_daftar">
<span<?= $Page->tgl_daftar->viewAttributes() ?>>
<?= $Page->tgl_daftar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_username->Visible) { // username ?>
        <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
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
    ew.addEventHandlers("master_pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
