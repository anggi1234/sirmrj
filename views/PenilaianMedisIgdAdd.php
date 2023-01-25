<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisIgdAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_igdadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpenilaian_medis_igdadd = currentForm = new ew.Form("fpenilaian_medis_igdadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_medis_igd")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_medis_igd)
        ew.vars.tables.penilaian_medis_igd = currentTable;
    fpenilaian_medis_igdadd.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null], fields.tanggal.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["anamnesis", [fields.anamnesis.visible && fields.anamnesis.required ? ew.Validators.required(fields.anamnesis.caption) : null], fields.anamnesis.isInvalid],
        ["hubungan", [fields.hubungan.visible && fields.hubungan.required ? ew.Validators.required(fields.hubungan.caption) : null], fields.hubungan.isInvalid],
        ["keluhan_utama", [fields.keluhan_utama.visible && fields.keluhan_utama.required ? ew.Validators.required(fields.keluhan_utama.caption) : null], fields.keluhan_utama.isInvalid],
        ["rps", [fields.rps.visible && fields.rps.required ? ew.Validators.required(fields.rps.caption) : null], fields.rps.isInvalid],
        ["rpd", [fields.rpd.visible && fields.rpd.required ? ew.Validators.required(fields.rpd.caption) : null], fields.rpd.isInvalid],
        ["rpk", [fields.rpk.visible && fields.rpk.required ? ew.Validators.required(fields.rpk.caption) : null], fields.rpk.isInvalid],
        ["rpo", [fields.rpo.visible && fields.rpo.required ? ew.Validators.required(fields.rpo.caption) : null], fields.rpo.isInvalid],
        ["alergi", [fields.alergi.visible && fields.alergi.required ? ew.Validators.required(fields.alergi.caption) : null], fields.alergi.isInvalid],
        ["keadaan", [fields.keadaan.visible && fields.keadaan.required ? ew.Validators.required(fields.keadaan.caption) : null], fields.keadaan.isInvalid],
        ["gcs", [fields.gcs.visible && fields.gcs.required ? ew.Validators.required(fields.gcs.caption) : null], fields.gcs.isInvalid],
        ["kesadaran", [fields.kesadaran.visible && fields.kesadaran.required ? ew.Validators.required(fields.kesadaran.caption) : null], fields.kesadaran.isInvalid],
        ["td", [fields.td.visible && fields.td.required ? ew.Validators.required(fields.td.caption) : null], fields.td.isInvalid],
        ["nadi", [fields.nadi.visible && fields.nadi.required ? ew.Validators.required(fields.nadi.caption) : null], fields.nadi.isInvalid],
        ["rr", [fields.rr.visible && fields.rr.required ? ew.Validators.required(fields.rr.caption) : null], fields.rr.isInvalid],
        ["suhu", [fields.suhu.visible && fields.suhu.required ? ew.Validators.required(fields.suhu.caption) : null], fields.suhu.isInvalid],
        ["spo", [fields.spo.visible && fields.spo.required ? ew.Validators.required(fields.spo.caption) : null], fields.spo.isInvalid],
        ["bb", [fields.bb.visible && fields.bb.required ? ew.Validators.required(fields.bb.caption) : null], fields.bb.isInvalid],
        ["tb", [fields.tb.visible && fields.tb.required ? ew.Validators.required(fields.tb.caption) : null], fields.tb.isInvalid],
        ["kepala", [fields.kepala.visible && fields.kepala.required ? ew.Validators.required(fields.kepala.caption) : null], fields.kepala.isInvalid],
        ["mata", [fields.mata.visible && fields.mata.required ? ew.Validators.required(fields.mata.caption) : null], fields.mata.isInvalid],
        ["gigi", [fields.gigi.visible && fields.gigi.required ? ew.Validators.required(fields.gigi.caption) : null], fields.gigi.isInvalid],
        ["leher", [fields.leher.visible && fields.leher.required ? ew.Validators.required(fields.leher.caption) : null], fields.leher.isInvalid],
        ["thoraks", [fields.thoraks.visible && fields.thoraks.required ? ew.Validators.required(fields.thoraks.caption) : null], fields.thoraks.isInvalid],
        ["abdomen", [fields.abdomen.visible && fields.abdomen.required ? ew.Validators.required(fields.abdomen.caption) : null], fields.abdomen.isInvalid],
        ["genital", [fields.genital.visible && fields.genital.required ? ew.Validators.required(fields.genital.caption) : null], fields.genital.isInvalid],
        ["ekstremitas", [fields.ekstremitas.visible && fields.ekstremitas.required ? ew.Validators.required(fields.ekstremitas.caption) : null], fields.ekstremitas.isInvalid],
        ["ket_fisik", [fields.ket_fisik.visible && fields.ket_fisik.required ? ew.Validators.required(fields.ket_fisik.caption) : null], fields.ket_fisik.isInvalid],
        ["ket_lokalis", [fields.ket_lokalis.visible && fields.ket_lokalis.required ? ew.Validators.required(fields.ket_lokalis.caption) : null], fields.ket_lokalis.isInvalid],
        ["ekg", [fields.ekg.visible && fields.ekg.required ? ew.Validators.required(fields.ekg.caption) : null], fields.ekg.isInvalid],
        ["rad", [fields.rad.visible && fields.rad.required ? ew.Validators.required(fields.rad.caption) : null], fields.rad.isInvalid],
        ["lab", [fields.lab.visible && fields.lab.required ? ew.Validators.required(fields.lab.caption) : null], fields.lab.isInvalid],
        ["diagnosis", [fields.diagnosis.visible && fields.diagnosis.required ? ew.Validators.required(fields.diagnosis.caption) : null], fields.diagnosis.isInvalid],
        ["tata", [fields.tata.visible && fields.tata.required ? ew.Validators.required(fields.tata.caption) : null], fields.tata.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_medis_igdadd,
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
    fpenilaian_medis_igdadd.validate = function () {
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
    fpenilaian_medis_igdadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_medis_igdadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_medis_igdadd.lists.anamnesis = <?= $Page->anamnesis->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.keadaan = <?= $Page->keadaan->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.kesadaran = <?= $Page->kesadaran->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.kepala = <?= $Page->kepala->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.mata = <?= $Page->mata->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.gigi = <?= $Page->gigi->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.leher = <?= $Page->leher->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.thoraks = <?= $Page->thoraks->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.abdomen = <?= $Page->abdomen->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.genital = <?= $Page->genital->toClientList($Page) ?>;
    fpenilaian_medis_igdadd.lists.ekstremitas = <?= $Page->ekstremitas->toClientList($Page) ?>;
    loadjs.done("fpenilaian_medis_igdadd");
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
<form name="fpenilaian_medis_igdadd" id="fpenilaian_medis_igdadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_igd">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_penilaian_medis_igd_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_no_rawat">
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <div id="r_kd_dokter" class="form-group row">
        <label id="elh_penilaian_medis_igd_kd_dokter" for="x_kd_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dokter->caption() ?><?= $Page->kd_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_kd_dokter">
<input type="<?= $Page->kd_dokter->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_kd_dokter" name="x_kd_dokter" id="x_kd_dokter" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kd_dokter->getPlaceHolder()) ?>" value="<?= $Page->kd_dokter->EditValue ?>"<?= $Page->kd_dokter->editAttributes() ?> aria-describedby="x_kd_dokter_help">
<?= $Page->kd_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <div id="r_anamnesis" class="form-group row">
        <label id="elh_penilaian_medis_igd_anamnesis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->anamnesis->caption() ?><?= $Page->anamnesis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_anamnesis">
<template id="tp_x_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_anamnesis" name="x_anamnesis" id="x_anamnesis"<?= $Page->anamnesis->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_anamnesis" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_anamnesis"
    name="x_anamnesis"
    value="<?= HtmlEncode($Page->anamnesis->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_anamnesis"
    data-target="dsl_x_anamnesis"
    data-repeatcolumn="5"
    class="form-control<?= $Page->anamnesis->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_anamnesis"
    data-value-separator="<?= $Page->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Page->anamnesis->editAttributes() ?>>
<?= $Page->anamnesis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->anamnesis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
    <div id="r_hubungan" class="form-group row">
        <label id="elh_penilaian_medis_igd_hubungan" for="x_hubungan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hubungan->caption() ?><?= $Page->hubungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hubungan->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_hubungan">
<input type="<?= $Page->hubungan->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_hubungan" name="x_hubungan" id="x_hubungan" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->hubungan->getPlaceHolder()) ?>" value="<?= $Page->hubungan->EditValue ?>"<?= $Page->hubungan->editAttributes() ?> aria-describedby="x_hubungan_help">
<?= $Page->hubungan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hubungan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <div id="r_keluhan_utama" class="form-group row">
        <label id="elh_penilaian_medis_igd_keluhan_utama" for="x_keluhan_utama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keluhan_utama->caption() ?><?= $Page->keluhan_utama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_keluhan_utama">
<textarea data-table="penilaian_medis_igd" data-field="x_keluhan_utama" name="x_keluhan_utama" id="x_keluhan_utama" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keluhan_utama->getPlaceHolder()) ?>"<?= $Page->keluhan_utama->editAttributes() ?> aria-describedby="x_keluhan_utama_help"><?= $Page->keluhan_utama->EditValue ?></textarea>
<?= $Page->keluhan_utama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keluhan_utama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rps->Visible) { // rps ?>
    <div id="r_rps" class="form-group row">
        <label id="elh_penilaian_medis_igd_rps" for="x_rps" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rps->caption() ?><?= $Page->rps->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rps->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rps">
<textarea data-table="penilaian_medis_igd" data-field="x_rps" name="x_rps" id="x_rps" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rps->getPlaceHolder()) ?>"<?= $Page->rps->editAttributes() ?> aria-describedby="x_rps_help"><?= $Page->rps->EditValue ?></textarea>
<?= $Page->rps->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rps->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpd->Visible) { // rpd ?>
    <div id="r_rpd" class="form-group row">
        <label id="elh_penilaian_medis_igd_rpd" for="x_rpd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpd->caption() ?><?= $Page->rpd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpd->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rpd">
<textarea data-table="penilaian_medis_igd" data-field="x_rpd" name="x_rpd" id="x_rpd" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rpd->getPlaceHolder()) ?>"<?= $Page->rpd->editAttributes() ?> aria-describedby="x_rpd_help"><?= $Page->rpd->EditValue ?></textarea>
<?= $Page->rpd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpd->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpk->Visible) { // rpk ?>
    <div id="r_rpk" class="form-group row">
        <label id="elh_penilaian_medis_igd_rpk" for="x_rpk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpk->caption() ?><?= $Page->rpk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpk->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rpk">
<textarea data-table="penilaian_medis_igd" data-field="x_rpk" name="x_rpk" id="x_rpk" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rpk->getPlaceHolder()) ?>"<?= $Page->rpk->editAttributes() ?> aria-describedby="x_rpk_help"><?= $Page->rpk->EditValue ?></textarea>
<?= $Page->rpk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rpo->Visible) { // rpo ?>
    <div id="r_rpo" class="form-group row">
        <label id="elh_penilaian_medis_igd_rpo" for="x_rpo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rpo->caption() ?><?= $Page->rpo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rpo->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rpo">
<textarea data-table="penilaian_medis_igd" data-field="x_rpo" name="x_rpo" id="x_rpo" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rpo->getPlaceHolder()) ?>"<?= $Page->rpo->editAttributes() ?> aria-describedby="x_rpo_help"><?= $Page->rpo->EditValue ?></textarea>
<?= $Page->rpo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rpo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <div id="r_alergi" class="form-group row">
        <label id="elh_penilaian_medis_igd_alergi" for="x_alergi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alergi->caption() ?><?= $Page->alergi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alergi->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_alergi">
<input type="<?= $Page->alergi->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_alergi" name="x_alergi" id="x_alergi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->alergi->getPlaceHolder()) ?>" value="<?= $Page->alergi->EditValue ?>"<?= $Page->alergi->editAttributes() ?> aria-describedby="x_alergi_help">
<?= $Page->alergi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alergi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <div id="r_keadaan" class="form-group row">
        <label id="elh_penilaian_medis_igd_keadaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keadaan->caption() ?><?= $Page->keadaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keadaan->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_keadaan">
<template id="tp_x_keadaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_keadaan" name="x_keadaan" id="x_keadaan"<?= $Page->keadaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_keadaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_keadaan"
    name="x_keadaan"
    value="<?= HtmlEncode($Page->keadaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_keadaan"
    data-target="dsl_x_keadaan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->keadaan->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_keadaan"
    data-value-separator="<?= $Page->keadaan->displayValueSeparatorAttribute() ?>"
    <?= $Page->keadaan->editAttributes() ?>>
<?= $Page->keadaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keadaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <div id="r_gcs" class="form-group row">
        <label id="elh_penilaian_medis_igd_gcs" for="x_gcs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gcs->caption() ?><?= $Page->gcs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_gcs">
<input type="<?= $Page->gcs->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_gcs" name="x_gcs" id="x_gcs" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->gcs->getPlaceHolder()) ?>" value="<?= $Page->gcs->EditValue ?>"<?= $Page->gcs->editAttributes() ?> aria-describedby="x_gcs_help">
<?= $Page->gcs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gcs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <div id="r_kesadaran" class="form-group row">
        <label id="elh_penilaian_medis_igd_kesadaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kesadaran->caption() ?><?= $Page->kesadaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_kesadaran">
<template id="tp_x_kesadaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_kesadaran" name="x_kesadaran" id="x_kesadaran"<?= $Page->kesadaran->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_kesadaran" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_kesadaran"
    name="x_kesadaran"
    value="<?= HtmlEncode($Page->kesadaran->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_kesadaran"
    data-target="dsl_x_kesadaran"
    data-repeatcolumn="5"
    class="form-control<?= $Page->kesadaran->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_kesadaran"
    data-value-separator="<?= $Page->kesadaran->displayValueSeparatorAttribute() ?>"
    <?= $Page->kesadaran->editAttributes() ?>>
<?= $Page->kesadaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kesadaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <div id="r_td" class="form-group row">
        <label id="elh_penilaian_medis_igd_td" for="x_td" class="<?= $Page->LeftColumnClass ?>"><?= $Page->td->caption() ?><?= $Page->td->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_td">
<input type="<?= $Page->td->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_td" name="x_td" id="x_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->td->getPlaceHolder()) ?>" value="<?= $Page->td->EditValue ?>"<?= $Page->td->editAttributes() ?> aria-describedby="x_td_help">
<?= $Page->td->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->td->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <div id="r_nadi" class="form-group row">
        <label id="elh_penilaian_medis_igd_nadi" for="x_nadi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nadi->caption() ?><?= $Page->nadi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_nadi">
<input type="<?= $Page->nadi->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_nadi" name="x_nadi" id="x_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->nadi->getPlaceHolder()) ?>" value="<?= $Page->nadi->EditValue ?>"<?= $Page->nadi->editAttributes() ?> aria-describedby="x_nadi_help">
<?= $Page->nadi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nadi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <div id="r_rr" class="form-group row">
        <label id="elh_penilaian_medis_igd_rr" for="x_rr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rr->caption() ?><?= $Page->rr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rr">
<input type="<?= $Page->rr->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_rr" name="x_rr" id="x_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->rr->getPlaceHolder()) ?>" value="<?= $Page->rr->EditValue ?>"<?= $Page->rr->editAttributes() ?> aria-describedby="x_rr_help">
<?= $Page->rr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <div id="r_suhu" class="form-group row">
        <label id="elh_penilaian_medis_igd_suhu" for="x_suhu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suhu->caption() ?><?= $Page->suhu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_suhu">
<input type="<?= $Page->suhu->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_suhu" name="x_suhu" id="x_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->suhu->getPlaceHolder()) ?>" value="<?= $Page->suhu->EditValue ?>"<?= $Page->suhu->editAttributes() ?> aria-describedby="x_suhu_help">
<?= $Page->suhu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->suhu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->spo->Visible) { // spo ?>
    <div id="r_spo" class="form-group row">
        <label id="elh_penilaian_medis_igd_spo" for="x_spo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->spo->caption() ?><?= $Page->spo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->spo->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_spo">
<input type="<?= $Page->spo->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_spo" name="x_spo" id="x_spo" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->spo->getPlaceHolder()) ?>" value="<?= $Page->spo->EditValue ?>"<?= $Page->spo->editAttributes() ?> aria-describedby="x_spo_help">
<?= $Page->spo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->spo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <div id="r_bb" class="form-group row">
        <label id="elh_penilaian_medis_igd_bb" for="x_bb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bb->caption() ?><?= $Page->bb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_bb">
<input type="<?= $Page->bb->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_bb" name="x_bb" id="x_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->bb->getPlaceHolder()) ?>" value="<?= $Page->bb->EditValue ?>"<?= $Page->bb->editAttributes() ?> aria-describedby="x_bb_help">
<?= $Page->bb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <div id="r_tb" class="form-group row">
        <label id="elh_penilaian_medis_igd_tb" for="x_tb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tb->caption() ?><?= $Page->tb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_tb">
<input type="<?= $Page->tb->getInputTextType() ?>" data-table="penilaian_medis_igd" data-field="x_tb" name="x_tb" id="x_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->tb->getPlaceHolder()) ?>" value="<?= $Page->tb->EditValue ?>"<?= $Page->tb->editAttributes() ?> aria-describedby="x_tb_help">
<?= $Page->tb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kepala->Visible) { // kepala ?>
    <div id="r_kepala" class="form-group row">
        <label id="elh_penilaian_medis_igd_kepala" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kepala->caption() ?><?= $Page->kepala->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kepala->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_kepala">
<template id="tp_x_kepala">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_kepala" name="x_kepala" id="x_kepala"<?= $Page->kepala->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_kepala" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_kepala"
    name="x_kepala"
    value="<?= HtmlEncode($Page->kepala->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_kepala"
    data-target="dsl_x_kepala"
    data-repeatcolumn="5"
    class="form-control<?= $Page->kepala->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_kepala"
    data-value-separator="<?= $Page->kepala->displayValueSeparatorAttribute() ?>"
    <?= $Page->kepala->editAttributes() ?>>
<?= $Page->kepala->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kepala->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mata->Visible) { // mata ?>
    <div id="r_mata" class="form-group row">
        <label id="elh_penilaian_medis_igd_mata" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mata->caption() ?><?= $Page->mata->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->mata->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_mata">
<template id="tp_x_mata">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_mata" name="x_mata" id="x_mata"<?= $Page->mata->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_mata" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_mata"
    name="x_mata"
    value="<?= HtmlEncode($Page->mata->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_mata"
    data-target="dsl_x_mata"
    data-repeatcolumn="5"
    class="form-control<?= $Page->mata->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_mata"
    data-value-separator="<?= $Page->mata->displayValueSeparatorAttribute() ?>"
    <?= $Page->mata->editAttributes() ?>>
<?= $Page->mata->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mata->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gigi->Visible) { // gigi ?>
    <div id="r_gigi" class="form-group row">
        <label id="elh_penilaian_medis_igd_gigi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gigi->caption() ?><?= $Page->gigi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gigi->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_gigi">
<template id="tp_x_gigi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_gigi" name="x_gigi" id="x_gigi"<?= $Page->gigi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_gigi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_gigi"
    name="x_gigi"
    value="<?= HtmlEncode($Page->gigi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_gigi"
    data-target="dsl_x_gigi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->gigi->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_gigi"
    data-value-separator="<?= $Page->gigi->displayValueSeparatorAttribute() ?>"
    <?= $Page->gigi->editAttributes() ?>>
<?= $Page->gigi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gigi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->leher->Visible) { // leher ?>
    <div id="r_leher" class="form-group row">
        <label id="elh_penilaian_medis_igd_leher" class="<?= $Page->LeftColumnClass ?>"><?= $Page->leher->caption() ?><?= $Page->leher->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->leher->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_leher">
<template id="tp_x_leher">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_leher" name="x_leher" id="x_leher"<?= $Page->leher->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_leher" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_leher"
    name="x_leher"
    value="<?= HtmlEncode($Page->leher->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_leher"
    data-target="dsl_x_leher"
    data-repeatcolumn="5"
    class="form-control<?= $Page->leher->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_leher"
    data-value-separator="<?= $Page->leher->displayValueSeparatorAttribute() ?>"
    <?= $Page->leher->editAttributes() ?>>
<?= $Page->leher->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->leher->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->thoraks->Visible) { // thoraks ?>
    <div id="r_thoraks" class="form-group row">
        <label id="elh_penilaian_medis_igd_thoraks" class="<?= $Page->LeftColumnClass ?>"><?= $Page->thoraks->caption() ?><?= $Page->thoraks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->thoraks->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_thoraks">
<template id="tp_x_thoraks">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_thoraks" name="x_thoraks" id="x_thoraks"<?= $Page->thoraks->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_thoraks" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_thoraks"
    name="x_thoraks"
    value="<?= HtmlEncode($Page->thoraks->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_thoraks"
    data-target="dsl_x_thoraks"
    data-repeatcolumn="5"
    class="form-control<?= $Page->thoraks->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_thoraks"
    data-value-separator="<?= $Page->thoraks->displayValueSeparatorAttribute() ?>"
    <?= $Page->thoraks->editAttributes() ?>>
<?= $Page->thoraks->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->thoraks->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->abdomen->Visible) { // abdomen ?>
    <div id="r_abdomen" class="form-group row">
        <label id="elh_penilaian_medis_igd_abdomen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->abdomen->caption() ?><?= $Page->abdomen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->abdomen->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_abdomen">
<template id="tp_x_abdomen">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_abdomen" name="x_abdomen" id="x_abdomen"<?= $Page->abdomen->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_abdomen" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_abdomen"
    name="x_abdomen"
    value="<?= HtmlEncode($Page->abdomen->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_abdomen"
    data-target="dsl_x_abdomen"
    data-repeatcolumn="5"
    class="form-control<?= $Page->abdomen->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_abdomen"
    data-value-separator="<?= $Page->abdomen->displayValueSeparatorAttribute() ?>"
    <?= $Page->abdomen->editAttributes() ?>>
<?= $Page->abdomen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->abdomen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->genital->Visible) { // genital ?>
    <div id="r_genital" class="form-group row">
        <label id="elh_penilaian_medis_igd_genital" class="<?= $Page->LeftColumnClass ?>"><?= $Page->genital->caption() ?><?= $Page->genital->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->genital->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_genital">
<template id="tp_x_genital">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_genital" name="x_genital" id="x_genital"<?= $Page->genital->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_genital" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_genital"
    name="x_genital"
    value="<?= HtmlEncode($Page->genital->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_genital"
    data-target="dsl_x_genital"
    data-repeatcolumn="5"
    class="form-control<?= $Page->genital->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_genital"
    data-value-separator="<?= $Page->genital->displayValueSeparatorAttribute() ?>"
    <?= $Page->genital->editAttributes() ?>>
<?= $Page->genital->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->genital->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ekstremitas->Visible) { // ekstremitas ?>
    <div id="r_ekstremitas" class="form-group row">
        <label id="elh_penilaian_medis_igd_ekstremitas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ekstremitas->caption() ?><?= $Page->ekstremitas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ekstremitas->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ekstremitas">
<template id="tp_x_ekstremitas">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_igd" data-field="x_ekstremitas" name="x_ekstremitas" id="x_ekstremitas"<?= $Page->ekstremitas->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_ekstremitas" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_ekstremitas"
    name="x_ekstremitas"
    value="<?= HtmlEncode($Page->ekstremitas->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_ekstremitas"
    data-target="dsl_x_ekstremitas"
    data-repeatcolumn="5"
    class="form-control<?= $Page->ekstremitas->isInvalidClass() ?>"
    data-table="penilaian_medis_igd"
    data-field="x_ekstremitas"
    data-value-separator="<?= $Page->ekstremitas->displayValueSeparatorAttribute() ?>"
    <?= $Page->ekstremitas->editAttributes() ?>>
<?= $Page->ekstremitas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ekstremitas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_fisik->Visible) { // ket_fisik ?>
    <div id="r_ket_fisik" class="form-group row">
        <label id="elh_penilaian_medis_igd_ket_fisik" for="x_ket_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_fisik->caption() ?><?= $Page->ket_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_fisik->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ket_fisik">
<textarea data-table="penilaian_medis_igd" data-field="x_ket_fisik" name="x_ket_fisik" id="x_ket_fisik" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ket_fisik->getPlaceHolder()) ?>"<?= $Page->ket_fisik->editAttributes() ?> aria-describedby="x_ket_fisik_help"><?= $Page->ket_fisik->EditValue ?></textarea>
<?= $Page->ket_fisik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_fisik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_lokalis->Visible) { // ket_lokalis ?>
    <div id="r_ket_lokalis" class="form-group row">
        <label id="elh_penilaian_medis_igd_ket_lokalis" for="x_ket_lokalis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_lokalis->caption() ?><?= $Page->ket_lokalis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_lokalis->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ket_lokalis">
<textarea data-table="penilaian_medis_igd" data-field="x_ket_lokalis" name="x_ket_lokalis" id="x_ket_lokalis" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ket_lokalis->getPlaceHolder()) ?>"<?= $Page->ket_lokalis->editAttributes() ?> aria-describedby="x_ket_lokalis_help"><?= $Page->ket_lokalis->EditValue ?></textarea>
<?= $Page->ket_lokalis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_lokalis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ekg->Visible) { // ekg ?>
    <div id="r_ekg" class="form-group row">
        <label id="elh_penilaian_medis_igd_ekg" for="x_ekg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ekg->caption() ?><?= $Page->ekg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ekg->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_ekg">
<textarea data-table="penilaian_medis_igd" data-field="x_ekg" name="x_ekg" id="x_ekg" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ekg->getPlaceHolder()) ?>"<?= $Page->ekg->editAttributes() ?> aria-describedby="x_ekg_help"><?= $Page->ekg->EditValue ?></textarea>
<?= $Page->ekg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ekg->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rad->Visible) { // rad ?>
    <div id="r_rad" class="form-group row">
        <label id="elh_penilaian_medis_igd_rad" for="x_rad" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rad->caption() ?><?= $Page->rad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rad->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_rad">
<textarea data-table="penilaian_medis_igd" data-field="x_rad" name="x_rad" id="x_rad" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rad->getPlaceHolder()) ?>"<?= $Page->rad->editAttributes() ?> aria-describedby="x_rad_help"><?= $Page->rad->EditValue ?></textarea>
<?= $Page->rad->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rad->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lab->Visible) { // lab ?>
    <div id="r_lab" class="form-group row">
        <label id="elh_penilaian_medis_igd_lab" for="x_lab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab->caption() ?><?= $Page->lab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lab->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_lab">
<textarea data-table="penilaian_medis_igd" data-field="x_lab" name="x_lab" id="x_lab" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->lab->getPlaceHolder()) ?>"<?= $Page->lab->editAttributes() ?> aria-describedby="x_lab_help"><?= $Page->lab->EditValue ?></textarea>
<?= $Page->lab->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lab->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
    <div id="r_diagnosis" class="form-group row">
        <label id="elh_penilaian_medis_igd_diagnosis" for="x_diagnosis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->diagnosis->caption() ?><?= $Page->diagnosis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->diagnosis->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_diagnosis">
<textarea data-table="penilaian_medis_igd" data-field="x_diagnosis" name="x_diagnosis" id="x_diagnosis" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->diagnosis->getPlaceHolder()) ?>"<?= $Page->diagnosis->editAttributes() ?> aria-describedby="x_diagnosis_help"><?= $Page->diagnosis->EditValue ?></textarea>
<?= $Page->diagnosis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->diagnosis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tata->Visible) { // tata ?>
    <div id="r_tata" class="form-group row">
        <label id="elh_penilaian_medis_igd_tata" for="x_tata" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tata->caption() ?><?= $Page->tata->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tata->cellAttributes() ?>>
<span id="el_penilaian_medis_igd_tata">
<textarea data-table="penilaian_medis_igd" data-field="x_tata" name="x_tata" id="x_tata" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->tata->getPlaceHolder()) ?>"<?= $Page->tata->editAttributes() ?> aria-describedby="x_tata_help"><?= $Page->tata->EditValue ?></textarea>
<?= $Page->tata->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tata->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("penilaian_medis_igd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
