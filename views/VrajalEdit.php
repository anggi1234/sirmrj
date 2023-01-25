<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$VrajalEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fvrajaledit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fvrajaledit = currentForm = new ew.Form("fvrajaledit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "vrajal")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.vrajal)
        ew.vars.tables.vrajal = currentTable;
    fvrajaledit.addFields([
        ["id_reg", [fields.id_reg.visible && fields.id_reg.required ? ew.Validators.required(fields.id_reg.caption) : null], fields.id_reg.isInvalid],
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["kd_poli", [fields.kd_poli.visible && fields.kd_poli.required ? ew.Validators.required(fields.kd_poli.caption) : null], fields.kd_poli.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["tgl_registrasi", [fields.tgl_registrasi.visible && fields.tgl_registrasi.required ? ew.Validators.required(fields.tgl_registrasi.caption) : null], fields.tgl_registrasi.isInvalid],
        ["stts", [fields.stts.visible && fields.stts.required ? ew.Validators.required(fields.stts.caption) : null], fields.stts.isInvalid],
        ["umurdaftar", [fields.umurdaftar.visible && fields.umurdaftar.required ? ew.Validators.required(fields.umurdaftar.caption) : null], fields.umurdaftar.isInvalid],
        ["cetak", [fields.cetak.visible && fields.cetak.required ? ew.Validators.required(fields.cetak.caption) : null], fields.cetak.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fvrajaledit,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fvrajaledit.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fvrajaledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvrajaledit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fvrajaledit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fvrajaledit" id="fvrajaledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vrajal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_reg->Visible) { // id_reg ?>
    <div id="r_id_reg" class="form-group row">
        <label id="elh_vrajal_id_reg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_reg->caption() ?><?= $Page->id_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_reg->cellAttributes() ?>>
<span id="el_vrajal_id_reg">
<span<?= $Page->id_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_reg->getDisplayValue($Page->id_reg->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vrajal" data-field="x_id_reg" data-hidden="1" name="x_id_reg" id="x_id_reg" value="<?= HtmlEncode($Page->id_reg->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <div id="r_no_rkm_medis" class="form-group row">
        <label id="elh_vrajal_no_rkm_medis" for="x_no_rkm_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rkm_medis->caption() ?><?= $Page->no_rkm_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_vrajal_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_rkm_medis->getDisplayValue($Page->no_rkm_medis->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vrajal" data-field="x_no_rkm_medis" data-hidden="1" name="x_no_rkm_medis" id="x_no_rkm_medis" value="<?= HtmlEncode($Page->no_rkm_medis->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <div id="r_kd_poli" class="form-group row">
        <label id="elh_vrajal_kd_poli" for="x_kd_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_poli->caption() ?><?= $Page->kd_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_vrajal_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_poli->getDisplayValue($Page->kd_poli->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vrajal" data-field="x_kd_poli" data-hidden="1" name="x_kd_poli" id="x_kd_poli" value="<?= HtmlEncode($Page->kd_poli->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <div id="r_kd_dokter" class="form-group row">
        <label id="elh_vrajal_kd_dokter" for="x_kd_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dokter->caption() ?><?= $Page->kd_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_vrajal_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_dokter->getDisplayValue($Page->kd_dokter->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vrajal" data-field="x_kd_dokter" data-hidden="1" name="x_kd_dokter" id="x_kd_dokter" value="<?= HtmlEncode($Page->kd_dokter->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stts->Visible) { // stts ?>
    <div id="r_stts" class="form-group row">
        <label id="elh_vrajal_stts" for="x_stts" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stts->caption() ?><?= $Page->stts->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->stts->cellAttributes() ?>>
<span id="el_vrajal_stts">
<span<?= $Page->stts->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->stts->getDisplayValue($Page->stts->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vrajal" data-field="x_stts" data-hidden="1" name="x_stts" id="x_stts" value="<?= HtmlEncode($Page->stts->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->umurdaftar->Visible) { // umurdaftar ?>
    <div id="r_umurdaftar" class="form-group row">
        <label id="elh_vrajal_umurdaftar" for="x_umurdaftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->umurdaftar->caption() ?><?= $Page->umurdaftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->umurdaftar->cellAttributes() ?>>
<span id="el_vrajal_umurdaftar">
<span<?= $Page->umurdaftar->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->umurdaftar->getDisplayValue($Page->umurdaftar->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="vrajal" data-field="x_umurdaftar" data-hidden="1" name="x_umurdaftar" id="x_umurdaftar" value="<?= HtmlEncode($Page->umurdaftar->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cetak->Visible) { // cetak ?>
    <div id="r_cetak" class="form-group row">
        <label id="elh_vrajal_cetak" for="x_cetak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cetak->caption() ?><?= $Page->cetak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->cetak->cellAttributes() ?>>
<span id="el_vrajal_cetak">
<script>

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
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
    $firstActiveDetailTable = $Page->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="Page_details"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
    if (in_array("catatan_medis", explode(",", $Page->getCurrentDetailTable())) && $catatan_medis->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "catatan_medis") {
            $firstActiveDetailTable = "catatan_medis";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("catatan_medis") ?>" href="#tab_catatan_medis" data-toggle="tab"><?= $Language->tablePhrase("catatan_medis", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan") ?>" href="#tab_penilaian_awal_keperawatan_ralan" data-toggle="tab"><?= $Language->tablePhrase("penilaian_awal_keperawatan_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_medis_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_medis_ralan->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_medis_ralan") {
            $firstActiveDetailTable = "penilaian_medis_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_medis_ralan") ?>" href="#tab_penilaian_medis_ralan" data-toggle="tab"><?= $Language->tablePhrase("penilaian_medis_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan_psikiatri", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan_psikiatri->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan_psikiatri") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan_psikiatri";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan_psikiatri") ?>" href="#tab_penilaian_awal_keperawatan_ralan_psikiatri" data-toggle="tab"><?= $Language->tablePhrase("penilaian_awal_keperawatan_ralan_psikiatri", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_psikologi", explode(",", $Page->getCurrentDetailTable())) && $penilaian_psikologi->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_psikologi") {
            $firstActiveDetailTable = "penilaian_psikologi";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_psikologi") ?>" href="#tab_penilaian_psikologi" data-toggle="tab"><?= $Language->tablePhrase("penilaian_psikologi", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("diagnosa_pasien", explode(",", $Page->getCurrentDetailTable())) && $diagnosa_pasien->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "diagnosa_pasien") {
            $firstActiveDetailTable = "diagnosa_pasien";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("diagnosa_pasien") ?>" href="#tab_diagnosa_pasien" data-toggle="tab"><?= $Language->tablePhrase("diagnosa_pasien", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("cppt", explode(",", $Page->getCurrentDetailTable())) && $cppt->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cppt") {
            $firstActiveDetailTable = "cppt";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("cppt") ?>" href="#tab_cppt" data-toggle="tab"><?= $Language->tablePhrase("cppt", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("billing", explode(",", $Page->getCurrentDetailTable())) && $billing->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "billing") {
            $firstActiveDetailTable = "billing";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("billing") ?>" href="#tab_billing" data-toggle="tab"><?= $Language->tablePhrase("billing", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("konsul", explode(",", $Page->getCurrentDetailTable())) && $konsul->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "konsul") {
            $firstActiveDetailTable = "konsul";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("konsul") ?>" href="#tab_konsul" data-toggle="tab"><?= $Language->tablePhrase("konsul", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("pemeriksaan_ralan", explode(",", $Page->getCurrentDetailTable())) && $pemeriksaan_ralan->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "pemeriksaan_ralan") {
            $firstActiveDetailTable = "pemeriksaan_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("pemeriksaan_ralan") ?>" href="#tab_pemeriksaan_ralan" data-toggle="tab"><?= $Language->tablePhrase("pemeriksaan_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("tindak_lanjut", explode(",", $Page->getCurrentDetailTable())) && $tindak_lanjut->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tindak_lanjut") {
            $firstActiveDetailTable = "tindak_lanjut";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("tindak_lanjut") ?>" href="#tab_tindak_lanjut" data-toggle="tab"><?= $Language->tablePhrase("tindak_lanjut", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("resep_dokter", explode(",", $Page->getCurrentDetailTable())) && $resep_dokter->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "resep_dokter") {
            $firstActiveDetailTable = "resep_dokter";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("resep_dokter") ?>" href="#tab_resep_dokter" data-toggle="tab"><?= $Language->tablePhrase("resep_dokter", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("prmrj", explode(",", $Page->getCurrentDetailTable())) && $prmrj->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "prmrj") {
            $firstActiveDetailTable = "prmrj";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("prmrj") ?>" href="#tab_prmrj" data-toggle="tab"><?= $Language->tablePhrase("prmrj", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("vhistory", explode(",", $Page->getCurrentDetailTable())) && $vhistory->DetailEdit) {
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
    if (in_array("catatan_medis", explode(",", $Page->getCurrentDetailTable())) && $catatan_medis->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "catatan_medis") {
            $firstActiveDetailTable = "catatan_medis";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("catatan_medis") ?>" id="tab_catatan_medis"><!-- page* -->
<?php include_once "CatatanMedisGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan") ?>" id="tab_penilaian_awal_keperawatan_ralan"><!-- page* -->
<?php include_once "PenilaianAwalKeperawatanRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_medis_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_medis_ralan->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_medis_ralan") {
            $firstActiveDetailTable = "penilaian_medis_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_medis_ralan") ?>" id="tab_penilaian_medis_ralan"><!-- page* -->
<?php include_once "PenilaianMedisRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan_psikiatri", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan_psikiatri->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan_psikiatri") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan_psikiatri";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan_psikiatri") ?>" id="tab_penilaian_awal_keperawatan_ralan_psikiatri"><!-- page* -->
<?php include_once "PenilaianAwalKeperawatanRalanPsikiatriGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_psikologi", explode(",", $Page->getCurrentDetailTable())) && $penilaian_psikologi->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_psikologi") {
            $firstActiveDetailTable = "penilaian_psikologi";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_psikologi") ?>" id="tab_penilaian_psikologi"><!-- page* -->
<?php include_once "PenilaianPsikologiGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("diagnosa_pasien", explode(",", $Page->getCurrentDetailTable())) && $diagnosa_pasien->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "diagnosa_pasien") {
            $firstActiveDetailTable = "diagnosa_pasien";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("diagnosa_pasien") ?>" id="tab_diagnosa_pasien"><!-- page* -->
<?php include_once "DiagnosaPasienGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("cppt", explode(",", $Page->getCurrentDetailTable())) && $cppt->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cppt") {
            $firstActiveDetailTable = "cppt";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("cppt") ?>" id="tab_cppt"><!-- page* -->
<?php include_once "CpptGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("billing", explode(",", $Page->getCurrentDetailTable())) && $billing->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "billing") {
            $firstActiveDetailTable = "billing";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("billing") ?>" id="tab_billing"><!-- page* -->
<?php include_once "BillingGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("konsul", explode(",", $Page->getCurrentDetailTable())) && $konsul->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "konsul") {
            $firstActiveDetailTable = "konsul";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("konsul") ?>" id="tab_konsul"><!-- page* -->
<?php include_once "KonsulGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("pemeriksaan_ralan", explode(",", $Page->getCurrentDetailTable())) && $pemeriksaan_ralan->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "pemeriksaan_ralan") {
            $firstActiveDetailTable = "pemeriksaan_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("pemeriksaan_ralan") ?>" id="tab_pemeriksaan_ralan"><!-- page* -->
<?php include_once "PemeriksaanRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("tindak_lanjut", explode(",", $Page->getCurrentDetailTable())) && $tindak_lanjut->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tindak_lanjut") {
            $firstActiveDetailTable = "tindak_lanjut";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("tindak_lanjut") ?>" id="tab_tindak_lanjut"><!-- page* -->
<?php include_once "TindakLanjutGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("resep_dokter", explode(",", $Page->getCurrentDetailTable())) && $resep_dokter->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "resep_dokter") {
            $firstActiveDetailTable = "resep_dokter";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("resep_dokter") ?>" id="tab_resep_dokter"><!-- page* -->
<?php include_once "ResepDokterGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("prmrj", explode(",", $Page->getCurrentDetailTable())) && $prmrj->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "prmrj") {
            $firstActiveDetailTable = "prmrj";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("prmrj") ?>" id="tab_prmrj"><!-- page* -->
<?php include_once "PrmrjGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("vhistory", explode(",", $Page->getCurrentDetailTable())) && $vhistory->DetailEdit) {
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
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("vrajal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
