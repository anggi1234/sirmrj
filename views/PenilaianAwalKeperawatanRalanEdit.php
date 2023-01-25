<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpenilaian_awal_keperawatan_ralanedit = currentForm = new ew.Form("fpenilaian_awal_keperawatan_ralanedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_awal_keperawatan_ralan)
        ew.vars.tables.penilaian_awal_keperawatan_ralan = currentTable;
    fpenilaian_awal_keperawatan_ralanedit.addFields([
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null], fields.tanggal.isInvalid],
        ["informasi", [fields.informasi.visible && fields.informasi.required ? ew.Validators.required(fields.informasi.caption) : null], fields.informasi.isInvalid],
        ["td", [fields.td.visible && fields.td.required ? ew.Validators.required(fields.td.caption) : null], fields.td.isInvalid],
        ["nadi", [fields.nadi.visible && fields.nadi.required ? ew.Validators.required(fields.nadi.caption) : null], fields.nadi.isInvalid],
        ["rr", [fields.rr.visible && fields.rr.required ? ew.Validators.required(fields.rr.caption) : null], fields.rr.isInvalid],
        ["suhu", [fields.suhu.visible && fields.suhu.required ? ew.Validators.required(fields.suhu.caption) : null], fields.suhu.isInvalid],
        ["gcs", [fields.gcs.visible && fields.gcs.required ? ew.Validators.required(fields.gcs.caption) : null], fields.gcs.isInvalid],
        ["bb", [fields.bb.visible && fields.bb.required ? ew.Validators.required(fields.bb.caption) : null], fields.bb.isInvalid],
        ["tb", [fields.tb.visible && fields.tb.required ? ew.Validators.required(fields.tb.caption) : null], fields.tb.isInvalid],
        ["bmi", [fields.bmi.visible && fields.bmi.required ? ew.Validators.required(fields.bmi.caption) : null], fields.bmi.isInvalid],
        ["keluhan_utama", [fields.keluhan_utama.visible && fields.keluhan_utama.required ? ew.Validators.required(fields.keluhan_utama.caption) : null], fields.keluhan_utama.isInvalid],
        ["rpd", [fields.rpd.visible && fields.rpd.required ? ew.Validators.required(fields.rpd.caption) : null], fields.rpd.isInvalid],
        ["rpk", [fields.rpk.visible && fields.rpk.required ? ew.Validators.required(fields.rpk.caption) : null], fields.rpk.isInvalid],
        ["rpo", [fields.rpo.visible && fields.rpo.required ? ew.Validators.required(fields.rpo.caption) : null], fields.rpo.isInvalid],
        ["alergi", [fields.alergi.visible && fields.alergi.required ? ew.Validators.required(fields.alergi.caption) : null], fields.alergi.isInvalid],
        ["alat_bantu", [fields.alat_bantu.visible && fields.alat_bantu.required ? ew.Validators.required(fields.alat_bantu.caption) : null], fields.alat_bantu.isInvalid],
        ["ket_bantu", [fields.ket_bantu.visible && fields.ket_bantu.required ? ew.Validators.required(fields.ket_bantu.caption) : null], fields.ket_bantu.isInvalid],
        ["prothesa", [fields.prothesa.visible && fields.prothesa.required ? ew.Validators.required(fields.prothesa.caption) : null], fields.prothesa.isInvalid],
        ["ket_pro", [fields.ket_pro.visible && fields.ket_pro.required ? ew.Validators.required(fields.ket_pro.caption) : null], fields.ket_pro.isInvalid],
        ["adl", [fields.adl.visible && fields.adl.required ? ew.Validators.required(fields.adl.caption) : null], fields.adl.isInvalid],
        ["status_psiko", [fields.status_psiko.visible && fields.status_psiko.required ? ew.Validators.required(fields.status_psiko.caption) : null], fields.status_psiko.isInvalid],
        ["ket_psiko", [fields.ket_psiko.visible && fields.ket_psiko.required ? ew.Validators.required(fields.ket_psiko.caption) : null], fields.ket_psiko.isInvalid],
        ["hub_keluarga", [fields.hub_keluarga.visible && fields.hub_keluarga.required ? ew.Validators.required(fields.hub_keluarga.caption) : null], fields.hub_keluarga.isInvalid],
        ["tinggal_dengan", [fields.tinggal_dengan.visible && fields.tinggal_dengan.required ? ew.Validators.required(fields.tinggal_dengan.caption) : null], fields.tinggal_dengan.isInvalid],
        ["ket_tinggal", [fields.ket_tinggal.visible && fields.ket_tinggal.required ? ew.Validators.required(fields.ket_tinggal.caption) : null], fields.ket_tinggal.isInvalid],
        ["ekonomi", [fields.ekonomi.visible && fields.ekonomi.required ? ew.Validators.required(fields.ekonomi.caption) : null], fields.ekonomi.isInvalid],
        ["budaya", [fields.budaya.visible && fields.budaya.required ? ew.Validators.required(fields.budaya.caption) : null], fields.budaya.isInvalid],
        ["ket_budaya", [fields.ket_budaya.visible && fields.ket_budaya.required ? ew.Validators.required(fields.ket_budaya.caption) : null], fields.ket_budaya.isInvalid],
        ["edukasi", [fields.edukasi.visible && fields.edukasi.required ? ew.Validators.required(fields.edukasi.caption) : null], fields.edukasi.isInvalid],
        ["ket_edukasi", [fields.ket_edukasi.visible && fields.ket_edukasi.required ? ew.Validators.required(fields.ket_edukasi.caption) : null], fields.ket_edukasi.isInvalid],
        ["berjalan_a", [fields.berjalan_a.visible && fields.berjalan_a.required ? ew.Validators.required(fields.berjalan_a.caption) : null], fields.berjalan_a.isInvalid],
        ["berjalan_b", [fields.berjalan_b.visible && fields.berjalan_b.required ? ew.Validators.required(fields.berjalan_b.caption) : null], fields.berjalan_b.isInvalid],
        ["berjalan_c", [fields.berjalan_c.visible && fields.berjalan_c.required ? ew.Validators.required(fields.berjalan_c.caption) : null], fields.berjalan_c.isInvalid],
        ["hasil", [fields.hasil.visible && fields.hasil.required ? ew.Validators.required(fields.hasil.caption) : null], fields.hasil.isInvalid],
        ["lapor", [fields.lapor.visible && fields.lapor.required ? ew.Validators.required(fields.lapor.caption) : null], fields.lapor.isInvalid],
        ["ket_lapor", [fields.ket_lapor.visible && fields.ket_lapor.required ? ew.Validators.required(fields.ket_lapor.caption) : null], fields.ket_lapor.isInvalid],
        ["sg1", [fields.sg1.visible && fields.sg1.required ? ew.Validators.required(fields.sg1.caption) : null], fields.sg1.isInvalid],
        ["nilai1", [fields.nilai1.visible && fields.nilai1.required ? ew.Validators.required(fields.nilai1.caption) : null], fields.nilai1.isInvalid],
        ["sg2", [fields.sg2.visible && fields.sg2.required ? ew.Validators.required(fields.sg2.caption) : null], fields.sg2.isInvalid],
        ["nilai2", [fields.nilai2.visible && fields.nilai2.required ? ew.Validators.required(fields.nilai2.caption) : null], fields.nilai2.isInvalid],
        ["total_hasil", [fields.total_hasil.visible && fields.total_hasil.required ? ew.Validators.required(fields.total_hasil.caption) : null, ew.Validators.integer], fields.total_hasil.isInvalid],
        ["nyeri", [fields.nyeri.visible && fields.nyeri.required ? ew.Validators.required(fields.nyeri.caption) : null], fields.nyeri.isInvalid],
        ["provokes", [fields.provokes.visible && fields.provokes.required ? ew.Validators.required(fields.provokes.caption) : null], fields.provokes.isInvalid],
        ["ket_provokes", [fields.ket_provokes.visible && fields.ket_provokes.required ? ew.Validators.required(fields.ket_provokes.caption) : null], fields.ket_provokes.isInvalid],
        ["quality", [fields.quality.visible && fields.quality.required ? ew.Validators.required(fields.quality.caption) : null], fields.quality.isInvalid],
        ["ket_quality", [fields.ket_quality.visible && fields.ket_quality.required ? ew.Validators.required(fields.ket_quality.caption) : null], fields.ket_quality.isInvalid],
        ["lokasi", [fields.lokasi.visible && fields.lokasi.required ? ew.Validators.required(fields.lokasi.caption) : null], fields.lokasi.isInvalid],
        ["menyebar", [fields.menyebar.visible && fields.menyebar.required ? ew.Validators.required(fields.menyebar.caption) : null], fields.menyebar.isInvalid],
        ["skala_nyeri", [fields.skala_nyeri.visible && fields.skala_nyeri.required ? ew.Validators.required(fields.skala_nyeri.caption) : null], fields.skala_nyeri.isInvalid],
        ["durasi", [fields.durasi.visible && fields.durasi.required ? ew.Validators.required(fields.durasi.caption) : null], fields.durasi.isInvalid],
        ["nyeri_hilang", [fields.nyeri_hilang.visible && fields.nyeri_hilang.required ? ew.Validators.required(fields.nyeri_hilang.caption) : null], fields.nyeri_hilang.isInvalid],
        ["ket_nyeri", [fields.ket_nyeri.visible && fields.ket_nyeri.required ? ew.Validators.required(fields.ket_nyeri.caption) : null], fields.ket_nyeri.isInvalid],
        ["pada_dokter", [fields.pada_dokter.visible && fields.pada_dokter.required ? ew.Validators.required(fields.pada_dokter.caption) : null], fields.pada_dokter.isInvalid],
        ["ket_dokter", [fields.ket_dokter.visible && fields.ket_dokter.required ? ew.Validators.required(fields.ket_dokter.caption) : null], fields.ket_dokter.isInvalid],
        ["rencana", [fields.rencana.visible && fields.rencana.required ? ew.Validators.required(fields.rencana.caption) : null], fields.rencana.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_awal_keperawatan_ralanedit,
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
    fpenilaian_awal_keperawatan_ralanedit.validate = function () {
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
    fpenilaian_awal_keperawatan_ralanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_awal_keperawatan_ralanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_awal_keperawatan_ralanedit.lists.informasi = <?= $Page->informasi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.alat_bantu = <?= $Page->alat_bantu->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.prothesa = <?= $Page->prothesa->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.adl = <?= $Page->adl->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.status_psiko = <?= $Page->status_psiko->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.hub_keluarga = <?= $Page->hub_keluarga->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.tinggal_dengan = <?= $Page->tinggal_dengan->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.ekonomi = <?= $Page->ekonomi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.budaya = <?= $Page->budaya->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.edukasi = <?= $Page->edukasi->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.berjalan_a = <?= $Page->berjalan_a->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.berjalan_b = <?= $Page->berjalan_b->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.berjalan_c = <?= $Page->berjalan_c->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.hasil = <?= $Page->hasil->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.lapor = <?= $Page->lapor->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.sg1 = <?= $Page->sg1->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.nilai1 = <?= $Page->nilai1->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.sg2 = <?= $Page->sg2->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.nilai2 = <?= $Page->nilai2->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.nyeri = <?= $Page->nyeri->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.provokes = <?= $Page->provokes->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.quality = <?= $Page->quality->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.menyebar = <?= $Page->menyebar->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.skala_nyeri = <?= $Page->skala_nyeri->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.nyeri_hilang = <?= $Page->nyeri_hilang->toClientList($Page) ?>;
    fpenilaian_awal_keperawatan_ralanedit.lists.pada_dokter = <?= $Page->pada_dokter->toClientList($Page) ?>;
    loadjs.done("fpenilaian_awal_keperawatan_ralanedit");
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
<form name="fpenilaian_awal_keperawatan_ralanedit" id="fpenilaian_awal_keperawatan_ralanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "vigd") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vigd">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "vrajal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_rawat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->informasi->Visible) { // informasi ?>
    <div id="r_informasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_informasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->informasi->caption() ?><?= $Page->informasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->informasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_informasi">
<template id="tp_x_informasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_informasi" name="x_informasi" id="x_informasi"<?= $Page->informasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_informasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_informasi"
    name="x_informasi"
    value="<?= HtmlEncode($Page->informasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_informasi"
    data-target="dsl_x_informasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->informasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_informasi"
    data-value-separator="<?= $Page->informasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->informasi->editAttributes() ?>>
<?= $Page->informasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->informasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <div id="r_td" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_td" for="x_td" class="<?= $Page->LeftColumnClass ?>"><?= $Page->td->caption() ?><?= $Page->td->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_td">
<input type="<?= $Page->td->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_td" name="x_td" id="x_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->td->getPlaceHolder()) ?>" value="<?= $Page->td->EditValue ?>"<?= $Page->td->editAttributes() ?> aria-describedby="x_td_help">
<?= $Page->td->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->td->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <div id="r_nadi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_nadi" for="x_nadi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nadi->caption() ?><?= $Page->nadi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nadi">
<input type="<?= $Page->nadi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_nadi" name="x_nadi" id="x_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->nadi->getPlaceHolder()) ?>" value="<?= $Page->nadi->EditValue ?>"<?= $Page->nadi->editAttributes() ?> aria-describedby="x_nadi_help">
<?= $Page->nadi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nadi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <div id="r_rr" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_rr" for="x_rr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rr->caption() ?><?= $Page->rr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rr">
<input type="<?= $Page->rr->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_rr" name="x_rr" id="x_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->rr->getPlaceHolder()) ?>" value="<?= $Page->rr->EditValue ?>"<?= $Page->rr->editAttributes() ?> aria-describedby="x_rr_help">
<?= $Page->rr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <div id="r_suhu" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_suhu" for="x_suhu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suhu->caption() ?><?= $Page->suhu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_suhu">
<input type="<?= $Page->suhu->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_suhu" name="x_suhu" id="x_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->suhu->getPlaceHolder()) ?>" value="<?= $Page->suhu->EditValue ?>"<?= $Page->suhu->editAttributes() ?> aria-describedby="x_suhu_help">
<?= $Page->suhu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->suhu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <div id="r_gcs" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_gcs" for="x_gcs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gcs->caption() ?><?= $Page->gcs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_gcs">
<input type="<?= $Page->gcs->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_gcs" name="x_gcs" id="x_gcs" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->gcs->getPlaceHolder()) ?>" value="<?= $Page->gcs->EditValue ?>"<?= $Page->gcs->editAttributes() ?> aria-describedby="x_gcs_help">
<?= $Page->gcs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gcs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <div id="r_bb" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_bb" for="x_bb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bb->caption() ?><?= $Page->bb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_bb">
<input type="<?= $Page->bb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_bb" name="x_bb" id="x_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->bb->getPlaceHolder()) ?>" value="<?= $Page->bb->EditValue ?>"<?= $Page->bb->editAttributes() ?> aria-describedby="x_bb_help">
<?= $Page->bb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <div id="r_tb" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_tb" for="x_tb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tb->caption() ?><?= $Page->tb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_tb">
<input type="<?= $Page->tb->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_tb" name="x_tb" id="x_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->tb->getPlaceHolder()) ?>" value="<?= $Page->tb->EditValue ?>"<?= $Page->tb->editAttributes() ?> aria-describedby="x_tb_help">
<?= $Page->tb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
    <div id="r_bmi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_bmi" for="x_bmi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bmi->caption() ?><?= $Page->bmi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bmi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_bmi">
<input type="<?= $Page->bmi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_bmi" name="x_bmi" id="x_bmi" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->bmi->getPlaceHolder()) ?>" value="<?= $Page->bmi->EditValue ?>"<?= $Page->bmi->editAttributes() ?> aria-describedby="x_bmi_help">
<?= $Page->bmi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bmi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <div id="r_keluhan_utama" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_keluhan_utama" for="x_keluhan_utama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keluhan_utama->caption() ?><?= $Page->keluhan_utama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_keluhan_utama">
<input type="<?= $Page->keluhan_utama->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_keluhan_utama" name="x_keluhan_utama" id="x_keluhan_utama" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->keluhan_utama->getPlaceHolder()) ?>" value="<?= $Page->keluhan_utama->EditValue ?>"<?= $Page->keluhan_utama->editAttributes() ?> aria-describedby="x_keluhan_utama_help">
<?= $Page->keluhan_utama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keluhan_utama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpd->Visible) { // rpd ?>
    <div id="r_rpd" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_rpd" for="x_rpd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpd->caption() ?><?= $Page->rpd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpd->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rpd">
<input type="<?= $Page->rpd->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_rpd" name="x_rpd" id="x_rpd" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->rpd->getPlaceHolder()) ?>" value="<?= $Page->rpd->EditValue ?>"<?= $Page->rpd->editAttributes() ?> aria-describedby="x_rpd_help">
<?= $Page->rpd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpd->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpk->Visible) { // rpk ?>
    <div id="r_rpk" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_rpk" for="x_rpk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpk->caption() ?><?= $Page->rpk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpk->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rpk">
<input type="<?= $Page->rpk->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_rpk" name="x_rpk" id="x_rpk" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->rpk->getPlaceHolder()) ?>" value="<?= $Page->rpk->EditValue ?>"<?= $Page->rpk->editAttributes() ?> aria-describedby="x_rpk_help">
<?= $Page->rpk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo->Visible) { // rpo ?>
    <div id="r_rpo" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_rpo" for="x_rpo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo->caption() ?><?= $Page->rpo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rpo">
<input type="<?= $Page->rpo->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_rpo" name="x_rpo" id="x_rpo" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->rpo->getPlaceHolder()) ?>" value="<?= $Page->rpo->EditValue ?>"<?= $Page->rpo->editAttributes() ?> aria-describedby="x_rpo_help">
<?= $Page->rpo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <div id="r_alergi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_alergi" for="x_alergi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alergi->caption() ?><?= $Page->alergi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alergi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_alergi">
<input type="<?= $Page->alergi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_alergi" name="x_alergi" id="x_alergi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->alergi->getPlaceHolder()) ?>" value="<?= $Page->alergi->EditValue ?>"<?= $Page->alergi->editAttributes() ?> aria-describedby="x_alergi_help">
<?= $Page->alergi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alergi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alat_bantu->Visible) { // alat_bantu ?>
    <div id="r_alat_bantu" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_alat_bantu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alat_bantu->caption() ?><?= $Page->alat_bantu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alat_bantu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_alat_bantu">
<template id="tp_x_alat_bantu">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_alat_bantu" name="x_alat_bantu" id="x_alat_bantu"<?= $Page->alat_bantu->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_alat_bantu" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_alat_bantu"
    name="x_alat_bantu"
    value="<?= HtmlEncode($Page->alat_bantu->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_alat_bantu"
    data-target="dsl_x_alat_bantu"
    data-repeatcolumn="5"
    class="form-control<?= $Page->alat_bantu->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_alat_bantu"
    data-value-separator="<?= $Page->alat_bantu->displayValueSeparatorAttribute() ?>"
    <?= $Page->alat_bantu->editAttributes() ?>>
<?= $Page->alat_bantu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alat_bantu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_bantu->Visible) { // ket_bantu ?>
    <div id="r_ket_bantu" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_bantu" for="x_ket_bantu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_bantu->caption() ?><?= $Page->ket_bantu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_bantu->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_bantu">
<input type="<?= $Page->ket_bantu->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_bantu" name="x_ket_bantu" id="x_ket_bantu" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_bantu->getPlaceHolder()) ?>" value="<?= $Page->ket_bantu->EditValue ?>"<?= $Page->ket_bantu->editAttributes() ?> aria-describedby="x_ket_bantu_help">
<?= $Page->ket_bantu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_bantu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prothesa->Visible) { // prothesa ?>
    <div id="r_prothesa" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_prothesa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prothesa->caption() ?><?= $Page->prothesa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->prothesa->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_prothesa">
<template id="tp_x_prothesa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_prothesa" name="x_prothesa" id="x_prothesa"<?= $Page->prothesa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_prothesa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_prothesa"
    name="x_prothesa"
    value="<?= HtmlEncode($Page->prothesa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_prothesa"
    data-target="dsl_x_prothesa"
    data-repeatcolumn="5"
    class="form-control<?= $Page->prothesa->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_prothesa"
    data-value-separator="<?= $Page->prothesa->displayValueSeparatorAttribute() ?>"
    <?= $Page->prothesa->editAttributes() ?>>
<?= $Page->prothesa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prothesa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_pro->Visible) { // ket_pro ?>
    <div id="r_ket_pro" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_pro" for="x_ket_pro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_pro->caption() ?><?= $Page->ket_pro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_pro->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_pro">
<input type="<?= $Page->ket_pro->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_pro" name="x_ket_pro" id="x_ket_pro" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_pro->getPlaceHolder()) ?>" value="<?= $Page->ket_pro->EditValue ?>"<?= $Page->ket_pro->editAttributes() ?> aria-describedby="x_ket_pro_help">
<?= $Page->ket_pro->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_pro->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->adl->Visible) { // adl ?>
    <div id="r_adl" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_adl" class="<?= $Page->LeftColumnClass ?>"><?= $Page->adl->caption() ?><?= $Page->adl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->adl->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_adl">
<template id="tp_x_adl">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_adl" name="x_adl" id="x_adl"<?= $Page->adl->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_adl" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_adl"
    name="x_adl"
    value="<?= HtmlEncode($Page->adl->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_adl"
    data-target="dsl_x_adl"
    data-repeatcolumn="5"
    class="form-control<?= $Page->adl->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_adl"
    data-value-separator="<?= $Page->adl->displayValueSeparatorAttribute() ?>"
    <?= $Page->adl->editAttributes() ?>>
<?= $Page->adl->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->adl->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_psiko->Visible) { // status_psiko ?>
    <div id="r_status_psiko" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_status_psiko" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_psiko->caption() ?><?= $Page->status_psiko->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_psiko->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_status_psiko">
<template id="tp_x_status_psiko">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_status_psiko" name="x_status_psiko" id="x_status_psiko"<?= $Page->status_psiko->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status_psiko" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status_psiko"
    name="x_status_psiko"
    value="<?= HtmlEncode($Page->status_psiko->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_psiko"
    data-target="dsl_x_status_psiko"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_psiko->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_status_psiko"
    data-value-separator="<?= $Page->status_psiko->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_psiko->editAttributes() ?>>
<?= $Page->status_psiko->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_psiko->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_psiko->Visible) { // ket_psiko ?>
    <div id="r_ket_psiko" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_psiko" for="x_ket_psiko" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_psiko->caption() ?><?= $Page->ket_psiko->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_psiko->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_psiko">
<input type="<?= $Page->ket_psiko->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_psiko" name="x_ket_psiko" id="x_ket_psiko" size="30" maxlength="70" placeholder="<?= HtmlEncode($Page->ket_psiko->getPlaceHolder()) ?>" value="<?= $Page->ket_psiko->EditValue ?>"<?= $Page->ket_psiko->editAttributes() ?> aria-describedby="x_ket_psiko_help">
<?= $Page->ket_psiko->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_psiko->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hub_keluarga->Visible) { // hub_keluarga ?>
    <div id="r_hub_keluarga" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_hub_keluarga" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hub_keluarga->caption() ?><?= $Page->hub_keluarga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hub_keluarga->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_hub_keluarga">
<template id="tp_x_hub_keluarga">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_hub_keluarga" name="x_hub_keluarga" id="x_hub_keluarga"<?= $Page->hub_keluarga->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_hub_keluarga" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_hub_keluarga"
    name="x_hub_keluarga"
    value="<?= HtmlEncode($Page->hub_keluarga->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_hub_keluarga"
    data-target="dsl_x_hub_keluarga"
    data-repeatcolumn="5"
    class="form-control<?= $Page->hub_keluarga->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_hub_keluarga"
    data-value-separator="<?= $Page->hub_keluarga->displayValueSeparatorAttribute() ?>"
    <?= $Page->hub_keluarga->editAttributes() ?>>
<?= $Page->hub_keluarga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hub_keluarga->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tinggal_dengan->Visible) { // tinggal_dengan ?>
    <div id="r_tinggal_dengan" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_tinggal_dengan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tinggal_dengan->caption() ?><?= $Page->tinggal_dengan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tinggal_dengan->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_tinggal_dengan">
<template id="tp_x_tinggal_dengan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_tinggal_dengan" name="x_tinggal_dengan" id="x_tinggal_dengan"<?= $Page->tinggal_dengan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_tinggal_dengan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_tinggal_dengan"
    name="x_tinggal_dengan"
    value="<?= HtmlEncode($Page->tinggal_dengan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_tinggal_dengan"
    data-target="dsl_x_tinggal_dengan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->tinggal_dengan->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_tinggal_dengan"
    data-value-separator="<?= $Page->tinggal_dengan->displayValueSeparatorAttribute() ?>"
    <?= $Page->tinggal_dengan->editAttributes() ?>>
<?= $Page->tinggal_dengan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tinggal_dengan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_tinggal->Visible) { // ket_tinggal ?>
    <div id="r_ket_tinggal" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_tinggal" for="x_ket_tinggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_tinggal->caption() ?><?= $Page->ket_tinggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_tinggal->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_tinggal">
<input type="<?= $Page->ket_tinggal->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_tinggal" name="x_ket_tinggal" id="x_ket_tinggal" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->ket_tinggal->getPlaceHolder()) ?>" value="<?= $Page->ket_tinggal->EditValue ?>"<?= $Page->ket_tinggal->editAttributes() ?> aria-describedby="x_ket_tinggal_help">
<?= $Page->ket_tinggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_tinggal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ekonomi->Visible) { // ekonomi ?>
    <div id="r_ekonomi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ekonomi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ekonomi->caption() ?><?= $Page->ekonomi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ekonomi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ekonomi">
<template id="tp_x_ekonomi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ekonomi" name="x_ekonomi" id="x_ekonomi"<?= $Page->ekonomi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_ekonomi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_ekonomi"
    name="x_ekonomi"
    value="<?= HtmlEncode($Page->ekonomi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_ekonomi"
    data-target="dsl_x_ekonomi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->ekonomi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_ekonomi"
    data-value-separator="<?= $Page->ekonomi->displayValueSeparatorAttribute() ?>"
    <?= $Page->ekonomi->editAttributes() ?>>
<?= $Page->ekonomi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ekonomi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->budaya->Visible) { // budaya ?>
    <div id="r_budaya" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_budaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->budaya->caption() ?><?= $Page->budaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->budaya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_budaya">
<template id="tp_x_budaya">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_budaya" name="x_budaya" id="x_budaya"<?= $Page->budaya->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_budaya" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_budaya"
    name="x_budaya"
    value="<?= HtmlEncode($Page->budaya->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_budaya"
    data-target="dsl_x_budaya"
    data-repeatcolumn="5"
    class="form-control<?= $Page->budaya->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_budaya"
    data-value-separator="<?= $Page->budaya->displayValueSeparatorAttribute() ?>"
    <?= $Page->budaya->editAttributes() ?>>
<?= $Page->budaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->budaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_budaya->Visible) { // ket_budaya ?>
    <div id="r_ket_budaya" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_budaya" for="x_ket_budaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_budaya->caption() ?><?= $Page->ket_budaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_budaya->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_budaya">
<input type="<?= $Page->ket_budaya->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_budaya" name="x_ket_budaya" id="x_ket_budaya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_budaya->getPlaceHolder()) ?>" value="<?= $Page->ket_budaya->EditValue ?>"<?= $Page->ket_budaya->editAttributes() ?> aria-describedby="x_ket_budaya_help">
<?= $Page->ket_budaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_budaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->edukasi->Visible) { // edukasi ?>
    <div id="r_edukasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_edukasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->edukasi->caption() ?><?= $Page->edukasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_edukasi">
<template id="tp_x_edukasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_edukasi" name="x_edukasi" id="x_edukasi"<?= $Page->edukasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_edukasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_edukasi"
    name="x_edukasi"
    value="<?= HtmlEncode($Page->edukasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_edukasi"
    data-target="dsl_x_edukasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->edukasi->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_edukasi"
    data-value-separator="<?= $Page->edukasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->edukasi->editAttributes() ?>>
<?= $Page->edukasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->edukasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_edukasi->Visible) { // ket_edukasi ?>
    <div id="r_ket_edukasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_edukasi" for="x_ket_edukasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_edukasi->caption() ?><?= $Page->ket_edukasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_edukasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_edukasi">
<input type="<?= $Page->ket_edukasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_edukasi" name="x_ket_edukasi" id="x_ket_edukasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_edukasi->getPlaceHolder()) ?>" value="<?= $Page->ket_edukasi->EditValue ?>"<?= $Page->ket_edukasi->editAttributes() ?> aria-describedby="x_ket_edukasi_help">
<?= $Page->ket_edukasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_edukasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->berjalan_a->Visible) { // berjalan_a ?>
    <div id="r_berjalan_a" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_berjalan_a" class="<?= $Page->LeftColumnClass ?>"><?= $Page->berjalan_a->caption() ?><?= $Page->berjalan_a->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->berjalan_a->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_berjalan_a">
<template id="tp_x_berjalan_a">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_berjalan_a" name="x_berjalan_a" id="x_berjalan_a"<?= $Page->berjalan_a->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_berjalan_a" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_berjalan_a"
    name="x_berjalan_a"
    value="<?= HtmlEncode($Page->berjalan_a->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_berjalan_a"
    data-target="dsl_x_berjalan_a"
    data-repeatcolumn="5"
    class="form-control<?= $Page->berjalan_a->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_berjalan_a"
    data-value-separator="<?= $Page->berjalan_a->displayValueSeparatorAttribute() ?>"
    <?= $Page->berjalan_a->editAttributes() ?>>
<?= $Page->berjalan_a->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->berjalan_a->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->berjalan_b->Visible) { // berjalan_b ?>
    <div id="r_berjalan_b" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_berjalan_b" class="<?= $Page->LeftColumnClass ?>"><?= $Page->berjalan_b->caption() ?><?= $Page->berjalan_b->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->berjalan_b->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_berjalan_b">
<template id="tp_x_berjalan_b">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_berjalan_b" name="x_berjalan_b" id="x_berjalan_b"<?= $Page->berjalan_b->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_berjalan_b" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_berjalan_b"
    name="x_berjalan_b"
    value="<?= HtmlEncode($Page->berjalan_b->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_berjalan_b"
    data-target="dsl_x_berjalan_b"
    data-repeatcolumn="5"
    class="form-control<?= $Page->berjalan_b->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_berjalan_b"
    data-value-separator="<?= $Page->berjalan_b->displayValueSeparatorAttribute() ?>"
    <?= $Page->berjalan_b->editAttributes() ?>>
<?= $Page->berjalan_b->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->berjalan_b->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->berjalan_c->Visible) { // berjalan_c ?>
    <div id="r_berjalan_c" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_berjalan_c" class="<?= $Page->LeftColumnClass ?>"><?= $Page->berjalan_c->caption() ?><?= $Page->berjalan_c->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->berjalan_c->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_berjalan_c">
<template id="tp_x_berjalan_c">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_berjalan_c" name="x_berjalan_c" id="x_berjalan_c"<?= $Page->berjalan_c->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_berjalan_c" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_berjalan_c"
    name="x_berjalan_c"
    value="<?= HtmlEncode($Page->berjalan_c->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_berjalan_c"
    data-target="dsl_x_berjalan_c"
    data-repeatcolumn="5"
    class="form-control<?= $Page->berjalan_c->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_berjalan_c"
    data-value-separator="<?= $Page->berjalan_c->displayValueSeparatorAttribute() ?>"
    <?= $Page->berjalan_c->editAttributes() ?>>
<?= $Page->berjalan_c->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->berjalan_c->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
    <div id="r_hasil" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_hasil" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hasil->caption() ?><?= $Page->hasil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_hasil">
<template id="tp_x_hasil">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_hasil" name="x_hasil" id="x_hasil"<?= $Page->hasil->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_hasil" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_hasil"
    name="x_hasil"
    value="<?= HtmlEncode($Page->hasil->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_hasil"
    data-target="dsl_x_hasil"
    data-repeatcolumn="5"
    class="form-control<?= $Page->hasil->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_hasil"
    data-value-separator="<?= $Page->hasil->displayValueSeparatorAttribute() ?>"
    <?= $Page->hasil->editAttributes() ?>>
<?= $Page->hasil->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hasil->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
    <div id="r_lapor" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_lapor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lapor->caption() ?><?= $Page->lapor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_lapor">
<template id="tp_x_lapor">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_lapor" name="x_lapor" id="x_lapor"<?= $Page->lapor->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_lapor" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_lapor"
    name="x_lapor"
    value="<?= HtmlEncode($Page->lapor->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_lapor"
    data-target="dsl_x_lapor"
    data-repeatcolumn="5"
    class="form-control<?= $Page->lapor->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_lapor"
    data-value-separator="<?= $Page->lapor->displayValueSeparatorAttribute() ?>"
    <?= $Page->lapor->editAttributes() ?>>
<?= $Page->lapor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lapor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
    <div id="r_ket_lapor" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_lapor" for="x_ket_lapor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_lapor->caption() ?><?= $Page->ket_lapor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_lapor->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_lapor">
<input type="<?= $Page->ket_lapor->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_lapor" name="x_ket_lapor" id="x_ket_lapor" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ket_lapor->getPlaceHolder()) ?>" value="<?= $Page->ket_lapor->EditValue ?>"<?= $Page->ket_lapor->editAttributes() ?> aria-describedby="x_ket_lapor_help">
<?= $Page->ket_lapor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_lapor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
    <div id="r_sg1" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_sg1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sg1->caption() ?><?= $Page->sg1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sg1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_sg1">
<template id="tp_x_sg1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_sg1" name="x_sg1" id="x_sg1"<?= $Page->sg1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sg1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sg1"
    name="x_sg1"
    value="<?= HtmlEncode($Page->sg1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sg1"
    data-target="dsl_x_sg1"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sg1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_sg1"
    data-value-separator="<?= $Page->sg1->displayValueSeparatorAttribute() ?>"
    <?= $Page->sg1->editAttributes() ?>>
<?= $Page->sg1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sg1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
    <div id="r_nilai1" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_nilai1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nilai1->caption() ?><?= $Page->nilai1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nilai1->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nilai1">
<template id="tp_x_nilai1">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_nilai1" name="x_nilai1" id="x_nilai1"<?= $Page->nilai1->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_nilai1" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_nilai1"
    name="x_nilai1"
    value="<?= HtmlEncode($Page->nilai1->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_nilai1"
    data-target="dsl_x_nilai1"
    data-repeatcolumn="5"
    class="form-control<?= $Page->nilai1->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_nilai1"
    data-value-separator="<?= $Page->nilai1->displayValueSeparatorAttribute() ?>"
    <?= $Page->nilai1->editAttributes() ?>>
<?= $Page->nilai1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nilai1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
    <div id="r_sg2" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_sg2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sg2->caption() ?><?= $Page->sg2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sg2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_sg2">
<template id="tp_x_sg2">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_sg2" name="x_sg2" id="x_sg2"<?= $Page->sg2->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sg2" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sg2"
    name="x_sg2"
    value="<?= HtmlEncode($Page->sg2->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sg2"
    data-target="dsl_x_sg2"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sg2->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_sg2"
    data-value-separator="<?= $Page->sg2->displayValueSeparatorAttribute() ?>"
    <?= $Page->sg2->editAttributes() ?>>
<?= $Page->sg2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sg2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
    <div id="r_nilai2" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_nilai2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nilai2->caption() ?><?= $Page->nilai2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nilai2->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nilai2">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->nilai2->isInvalidClass() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_nilai2" name="x_nilai2[]" id="x_nilai2_135995" value="1"<?= ConvertToBool($Page->nilai2->CurrentValue) ? " checked" : "" ?><?= $Page->nilai2->editAttributes() ?> aria-describedby="x_nilai2_help">
    <label class="custom-control-label" for="x_nilai2_135995"></label>
</div>
<?= $Page->nilai2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nilai2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
    <div id="r_total_hasil" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_total_hasil" for="x_total_hasil" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_hasil->caption() ?><?= $Page->total_hasil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->total_hasil->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_total_hasil">
<input type="<?= $Page->total_hasil->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_total_hasil" name="x_total_hasil" id="x_total_hasil" size="30" placeholder="<?= HtmlEncode($Page->total_hasil->getPlaceHolder()) ?>" value="<?= $Page->total_hasil->EditValue ?>"<?= $Page->total_hasil->editAttributes() ?> aria-describedby="x_total_hasil_help">
<?= $Page->total_hasil->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_hasil->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
    <div id="r_nyeri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_nyeri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nyeri->caption() ?><?= $Page->nyeri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nyeri">
<template id="tp_x_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_nyeri" name="x_nyeri" id="x_nyeri"<?= $Page->nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_nyeri"
    name="x_nyeri"
    value="<?= HtmlEncode($Page->nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_nyeri"
    data-target="dsl_x_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Page->nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_nyeri"
    data-value-separator="<?= $Page->nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Page->nyeri->editAttributes() ?>>
<?= $Page->nyeri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nyeri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
    <div id="r_provokes" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_provokes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->provokes->caption() ?><?= $Page->provokes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_provokes">
<template id="tp_x_provokes">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_provokes" name="x_provokes" id="x_provokes"<?= $Page->provokes->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_provokes" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_provokes"
    name="x_provokes"
    value="<?= HtmlEncode($Page->provokes->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_provokes"
    data-target="dsl_x_provokes"
    data-repeatcolumn="5"
    class="form-control<?= $Page->provokes->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_provokes"
    data-value-separator="<?= $Page->provokes->displayValueSeparatorAttribute() ?>"
    <?= $Page->provokes->editAttributes() ?>>
<?= $Page->provokes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->provokes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
    <div id="r_ket_provokes" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_provokes" for="x_ket_provokes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_provokes->caption() ?><?= $Page->ket_provokes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_provokes->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_provokes">
<input type="<?= $Page->ket_provokes->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_provokes" name="x_ket_provokes" id="x_ket_provokes" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->ket_provokes->getPlaceHolder()) ?>" value="<?= $Page->ket_provokes->EditValue ?>"<?= $Page->ket_provokes->editAttributes() ?> aria-describedby="x_ket_provokes_help">
<?= $Page->ket_provokes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_provokes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
    <div id="r_quality" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_quality" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quality->caption() ?><?= $Page->quality->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_quality">
<template id="tp_x_quality">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_quality" name="x_quality" id="x_quality"<?= $Page->quality->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_quality" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_quality"
    name="x_quality"
    value="<?= HtmlEncode($Page->quality->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_quality"
    data-target="dsl_x_quality"
    data-repeatcolumn="5"
    class="form-control<?= $Page->quality->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_quality"
    data-value-separator="<?= $Page->quality->displayValueSeparatorAttribute() ?>"
    <?= $Page->quality->editAttributes() ?>>
<?= $Page->quality->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quality->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
    <div id="r_ket_quality" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_quality" for="x_ket_quality" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_quality->caption() ?><?= $Page->ket_quality->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_quality->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_quality">
<input type="<?= $Page->ket_quality->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_quality" name="x_ket_quality" id="x_ket_quality" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ket_quality->getPlaceHolder()) ?>" value="<?= $Page->ket_quality->EditValue ?>"<?= $Page->ket_quality->editAttributes() ?> aria-describedby="x_ket_quality_help">
<?= $Page->ket_quality->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_quality->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <div id="r_lokasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_lokasi" for="x_lokasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lokasi->caption() ?><?= $Page->lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lokasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_lokasi">
<input type="<?= $Page->lokasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_lokasi" name="x_lokasi" id="x_lokasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>" value="<?= $Page->lokasi->EditValue ?>"<?= $Page->lokasi->editAttributes() ?> aria-describedby="x_lokasi_help">
<?= $Page->lokasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
    <div id="r_menyebar" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_menyebar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menyebar->caption() ?><?= $Page->menyebar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menyebar->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_menyebar">
<template id="tp_x_menyebar">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_menyebar" name="x_menyebar" id="x_menyebar"<?= $Page->menyebar->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_menyebar" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_menyebar"
    name="x_menyebar"
    value="<?= HtmlEncode($Page->menyebar->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_menyebar"
    data-target="dsl_x_menyebar"
    data-repeatcolumn="5"
    class="form-control<?= $Page->menyebar->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_menyebar"
    data-value-separator="<?= $Page->menyebar->displayValueSeparatorAttribute() ?>"
    <?= $Page->menyebar->editAttributes() ?>>
<?= $Page->menyebar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menyebar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
    <div id="r_skala_nyeri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_skala_nyeri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skala_nyeri->caption() ?><?= $Page->skala_nyeri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skala_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_skala_nyeri">
<template id="tp_x_skala_nyeri">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_skala_nyeri" name="x_skala_nyeri" id="x_skala_nyeri"<?= $Page->skala_nyeri->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_skala_nyeri" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_skala_nyeri"
    name="x_skala_nyeri"
    value="<?= HtmlEncode($Page->skala_nyeri->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_skala_nyeri"
    data-target="dsl_x_skala_nyeri"
    data-repeatcolumn="5"
    class="form-control<?= $Page->skala_nyeri->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_skala_nyeri"
    data-value-separator="<?= $Page->skala_nyeri->displayValueSeparatorAttribute() ?>"
    <?= $Page->skala_nyeri->editAttributes() ?>>
<?= $Page->skala_nyeri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skala_nyeri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
    <div id="r_durasi" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_durasi" for="x_durasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->durasi->caption() ?><?= $Page->durasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->durasi->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_durasi">
<input type="<?= $Page->durasi->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_durasi" name="x_durasi" id="x_durasi" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->durasi->getPlaceHolder()) ?>" value="<?= $Page->durasi->EditValue ?>"<?= $Page->durasi->editAttributes() ?> aria-describedby="x_durasi_help">
<?= $Page->durasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->durasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
    <div id="r_nyeri_hilang" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_nyeri_hilang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nyeri_hilang->caption() ?><?= $Page->nyeri_hilang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nyeri_hilang->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nyeri_hilang">
<template id="tp_x_nyeri_hilang">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_nyeri_hilang" name="x_nyeri_hilang" id="x_nyeri_hilang"<?= $Page->nyeri_hilang->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_nyeri_hilang" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_nyeri_hilang"
    name="x_nyeri_hilang"
    value="<?= HtmlEncode($Page->nyeri_hilang->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_nyeri_hilang"
    data-target="dsl_x_nyeri_hilang"
    data-repeatcolumn="5"
    class="form-control<?= $Page->nyeri_hilang->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_nyeri_hilang"
    data-value-separator="<?= $Page->nyeri_hilang->displayValueSeparatorAttribute() ?>"
    <?= $Page->nyeri_hilang->editAttributes() ?>>
<?= $Page->nyeri_hilang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nyeri_hilang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
    <div id="r_ket_nyeri" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_nyeri" for="x_ket_nyeri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_nyeri->caption() ?><?= $Page->ket_nyeri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_nyeri->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_nyeri">
<input type="<?= $Page->ket_nyeri->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_nyeri" name="x_ket_nyeri" id="x_ket_nyeri" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->ket_nyeri->getPlaceHolder()) ?>" value="<?= $Page->ket_nyeri->EditValue ?>"<?= $Page->ket_nyeri->editAttributes() ?> aria-describedby="x_ket_nyeri_help">
<?= $Page->ket_nyeri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_nyeri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
    <div id="r_pada_dokter" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_pada_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pada_dokter->caption() ?><?= $Page->pada_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pada_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_pada_dokter">
<template id="tp_x_pada_dokter">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_awal_keperawatan_ralan" data-field="x_pada_dokter" name="x_pada_dokter" id="x_pada_dokter"<?= $Page->pada_dokter->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_pada_dokter" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_pada_dokter"
    name="x_pada_dokter"
    value="<?= HtmlEncode($Page->pada_dokter->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_pada_dokter"
    data-target="dsl_x_pada_dokter"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pada_dokter->isInvalidClass() ?>"
    data-table="penilaian_awal_keperawatan_ralan"
    data-field="x_pada_dokter"
    data-value-separator="<?= $Page->pada_dokter->displayValueSeparatorAttribute() ?>"
    <?= $Page->pada_dokter->editAttributes() ?>>
<?= $Page->pada_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pada_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
    <div id="r_ket_dokter" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_ket_dokter" for="x_ket_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_dokter->caption() ?><?= $Page->ket_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_dokter->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_ket_dokter">
<input type="<?= $Page->ket_dokter->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_ket_dokter" name="x_ket_dokter" id="x_ket_dokter" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ket_dokter->getPlaceHolder()) ?>" value="<?= $Page->ket_dokter->EditValue ?>"<?= $Page->ket_dokter->editAttributes() ?> aria-describedby="x_ket_dokter_help">
<?= $Page->ket_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
    <div id="r_rencana" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_rencana" for="x_rencana" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rencana->caption() ?><?= $Page->rencana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rencana->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_rencana">
<input type="<?= $Page->rencana->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_rencana" name="x_rencana" id="x_rencana" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->rencana->getPlaceHolder()) ?>" value="<?= $Page->rencana->EditValue ?>"<?= $Page->rencana->editAttributes() ?> aria-describedby="x_rencana_help">
<?= $Page->rencana->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rencana->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <div id="r_nip" class="form-group row">
        <label id="elh_penilaian_awal_keperawatan_ralan_nip" for="x_nip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nip->caption() ?><?= $Page->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nip->cellAttributes() ?>>
<span id="el_penilaian_awal_keperawatan_ralan_nip">
<input type="<?= $Page->nip->getInputTextType() ?>" data-table="penilaian_awal_keperawatan_ralan" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->nip->getPlaceHolder()) ?>" value="<?= $Page->nip->EditValue ?>"<?= $Page->nip->editAttributes() ?> aria-describedby="x_nip_help">
<?= $Page->nip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="penilaian_awal_keperawatan_ralan" data-field="x_id_penilaian_awal_keperawatan" data-hidden="1" name="x_id_penilaian_awal_keperawatan" id="x_id_penilaian_awal_keperawatan" value="<?= HtmlEncode($Page->id_penilaian_awal_keperawatan->CurrentValue) ?>">
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
    ew.addEventHandlers("penilaian_awal_keperawatan_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
