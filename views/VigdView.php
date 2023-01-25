<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$VigdView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fvigdview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fvigdview = currentForm = new ew.Form("fvigdview", "view");
    loadjs.done("fvigdview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.vigd) ew.vars.tables.vigd = <?= JsonEncode(GetClientVar("tables", "vigd")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fvigdview" id="fvigdview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vigd">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_reg->Visible) { // id_reg ?>
    <tr id="r_id_reg">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_id_reg"><?= $Page->id_reg->caption() ?></span></td>
        <td data-name="id_reg" <?= $Page->id_reg->cellAttributes() ?>>
<span id="el_vigd_id_reg">
<span<?= $Page->id_reg->viewAttributes() ?>>
<?= $Page->id_reg->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
    <tr id="r_tgl_registrasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_tgl_registrasi"><?= $Page->tgl_registrasi->caption() ?></span></td>
        <td data-name="tgl_registrasi" <?= $Page->tgl_registrasi->cellAttributes() ?>>
<span id="el_vigd_tgl_registrasi">
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_vigd_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <tr id="r_no_rkm_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></td>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_vigd_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <tr id="r_kd_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_kd_poli"><?= $Page->kd_poli->caption() ?></span></td>
        <td data-name="kd_poli" <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_vigd_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stts->Visible) { // stts ?>
    <tr id="r_stts">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_stts"><?= $Page->stts->caption() ?></span></td>
        <td data-name="stts" <?= $Page->stts->cellAttributes() ?>>
<span id="el_vigd_stts">
<span<?= $Page->stts->viewAttributes() ?>>
<?= $Page->stts->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->umurdaftar->Visible) { // umurdaftar ?>
    <tr id="r_umurdaftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_umurdaftar"><?= $Page->umurdaftar->caption() ?></span></td>
        <td data-name="umurdaftar" <?= $Page->umurdaftar->cellAttributes() ?>>
<span id="el_vigd_umurdaftar">
<span<?= $Page->umurdaftar->viewAttributes() ?>>
<?= $Page->umurdaftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cetak->Visible) { // cetak ?>
    <tr id="r_cetak">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_vigd_cetak"><?= $Page->cetak->caption() ?></span></td>
        <td data-name="cetak" <?= $Page->cetak->cellAttributes() ?>>
<span id="el_vigd_cetak">
<span<?= $Page->cetak->viewAttributes() ?>><script>

function Buka(link="") {
	window.open(link, 'newwindow', 'width=800,height=400');
	return false;
}
</script>
<a class="btn btn-info btn-sm"href="print.html"
	onclick="Buka('../cetak/coba_cetak.php'); return false"
target="_blank">Clinical Pathway</a>
<a class="btn btn-info btn-sm" href="print.html"
	onclick="Buka('../cetak/coba_cetak.php'); return false"
target="_blank">Resume Medis</a>
</span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
    $firstActiveDetailTable = $Page->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="Page_details"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
    if (in_array("penilaian_awal_keperawatan_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan") ?>" href="#tab_penilaian_awal_keperawatan_ralan" data-toggle="tab"><?= $Language->tablePhrase("penilaian_awal_keperawatan_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("catatan_medis", explode(",", $Page->getCurrentDetailTable())) && $catatan_medis->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "catatan_medis") {
            $firstActiveDetailTable = "catatan_medis";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("catatan_medis") ?>" href="#tab_catatan_medis" data-toggle="tab"><?= $Language->tablePhrase("catatan_medis", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_medis_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_medis_ralan->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_medis_ralan") {
            $firstActiveDetailTable = "penilaian_medis_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_medis_ralan") ?>" href="#tab_penilaian_medis_ralan" data-toggle="tab"><?= $Language->tablePhrase("penilaian_medis_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan_psikiatri", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan_psikiatri->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan_psikiatri") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan_psikiatri";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan_psikiatri") ?>" href="#tab_penilaian_awal_keperawatan_ralan_psikiatri" data-toggle="tab"><?= $Language->tablePhrase("penilaian_awal_keperawatan_ralan_psikiatri", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_psikologi", explode(",", $Page->getCurrentDetailTable())) && $penilaian_psikologi->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_psikologi") {
            $firstActiveDetailTable = "penilaian_psikologi";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_psikologi") ?>" href="#tab_penilaian_psikologi" data-toggle="tab"><?= $Language->tablePhrase("penilaian_psikologi", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("diagnosa_pasien", explode(",", $Page->getCurrentDetailTable())) && $diagnosa_pasien->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "diagnosa_pasien") {
            $firstActiveDetailTable = "diagnosa_pasien";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("diagnosa_pasien") ?>" href="#tab_diagnosa_pasien" data-toggle="tab"><?= $Language->tablePhrase("diagnosa_pasien", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("tindak_lanjut", explode(",", $Page->getCurrentDetailTable())) && $tindak_lanjut->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tindak_lanjut") {
            $firstActiveDetailTable = "tindak_lanjut";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("tindak_lanjut") ?>" href="#tab_tindak_lanjut" data-toggle="tab"><?= $Language->tablePhrase("tindak_lanjut", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("pemeriksaan_ralan", explode(",", $Page->getCurrentDetailTable())) && $pemeriksaan_ralan->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "pemeriksaan_ralan") {
            $firstActiveDetailTable = "pemeriksaan_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("pemeriksaan_ralan") ?>" href="#tab_pemeriksaan_ralan" data-toggle="tab"><?= $Language->tablePhrase("pemeriksaan_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("vhistory", explode(",", $Page->getCurrentDetailTable())) && $vhistory->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vhistory") {
            $firstActiveDetailTable = "vhistory";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("vhistory") ?>" href="#tab_vhistory" data-toggle="tab"><?= $Language->tablePhrase("vhistory", "TblCaption") ?></a></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="tab-content"><!-- .tab-content -->
<?php
    if (in_array("penilaian_awal_keperawatan_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan") ?>" id="tab_penilaian_awal_keperawatan_ralan"><!-- page* -->
<?php include_once "PenilaianAwalKeperawatanRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("catatan_medis", explode(",", $Page->getCurrentDetailTable())) && $catatan_medis->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "catatan_medis") {
            $firstActiveDetailTable = "catatan_medis";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("catatan_medis") ?>" id="tab_catatan_medis"><!-- page* -->
<?php include_once "CatatanMedisGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_medis_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_medis_ralan->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_medis_ralan") {
            $firstActiveDetailTable = "penilaian_medis_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_medis_ralan") ?>" id="tab_penilaian_medis_ralan"><!-- page* -->
<?php include_once "PenilaianMedisRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan_psikiatri", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan_psikiatri->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan_psikiatri") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan_psikiatri";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan_psikiatri") ?>" id="tab_penilaian_awal_keperawatan_ralan_psikiatri"><!-- page* -->
<?php include_once "PenilaianAwalKeperawatanRalanPsikiatriGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_psikologi", explode(",", $Page->getCurrentDetailTable())) && $penilaian_psikologi->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_psikologi") {
            $firstActiveDetailTable = "penilaian_psikologi";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_psikologi") ?>" id="tab_penilaian_psikologi"><!-- page* -->
<?php include_once "PenilaianPsikologiGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("diagnosa_pasien", explode(",", $Page->getCurrentDetailTable())) && $diagnosa_pasien->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "diagnosa_pasien") {
            $firstActiveDetailTable = "diagnosa_pasien";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("diagnosa_pasien") ?>" id="tab_diagnosa_pasien"><!-- page* -->
<?php include_once "DiagnosaPasienGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("tindak_lanjut", explode(",", $Page->getCurrentDetailTable())) && $tindak_lanjut->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tindak_lanjut") {
            $firstActiveDetailTable = "tindak_lanjut";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("tindak_lanjut") ?>" id="tab_tindak_lanjut"><!-- page* -->
<?php include_once "TindakLanjutGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("pemeriksaan_ralan", explode(",", $Page->getCurrentDetailTable())) && $pemeriksaan_ralan->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "pemeriksaan_ralan") {
            $firstActiveDetailTable = "pemeriksaan_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("pemeriksaan_ralan") ?>" id="tab_pemeriksaan_ralan"><!-- page* -->
<?php include_once "PemeriksaanRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("vhistory", explode(",", $Page->getCurrentDetailTable())) && $vhistory->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vhistory") {
            $firstActiveDetailTable = "vhistory";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("vhistory") ?>" id="tab_vhistory"><!-- page* -->
<?php include_once "VhistoryGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
