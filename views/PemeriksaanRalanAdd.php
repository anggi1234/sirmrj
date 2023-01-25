<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PemeriksaanRalanAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpemeriksaan_ralanadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpemeriksaan_ralanadd = currentForm = new ew.Form("fpemeriksaan_ralanadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pemeriksaan_ralan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pemeriksaan_ralan)
        ew.vars.tables.pemeriksaan_ralan = currentTable;
    fpemeriksaan_ralanadd.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tgl_perawatan", [fields.tgl_perawatan.visible && fields.tgl_perawatan.required ? ew.Validators.required(fields.tgl_perawatan.caption) : null], fields.tgl_perawatan.isInvalid],
        ["jam_rawat", [fields.jam_rawat.visible && fields.jam_rawat.required ? ew.Validators.required(fields.jam_rawat.caption) : null], fields.jam_rawat.isInvalid],
        ["suhu_tubuh", [fields.suhu_tubuh.visible && fields.suhu_tubuh.required ? ew.Validators.required(fields.suhu_tubuh.caption) : null], fields.suhu_tubuh.isInvalid],
        ["tensi", [fields.tensi.visible && fields.tensi.required ? ew.Validators.required(fields.tensi.caption) : null], fields.tensi.isInvalid],
        ["nadi", [fields.nadi.visible && fields.nadi.required ? ew.Validators.required(fields.nadi.caption) : null], fields.nadi.isInvalid],
        ["respirasi", [fields.respirasi.visible && fields.respirasi.required ? ew.Validators.required(fields.respirasi.caption) : null], fields.respirasi.isInvalid],
        ["tinggi", [fields.tinggi.visible && fields.tinggi.required ? ew.Validators.required(fields.tinggi.caption) : null], fields.tinggi.isInvalid],
        ["berat", [fields.berat.visible && fields.berat.required ? ew.Validators.required(fields.berat.caption) : null], fields.berat.isInvalid],
        ["spo2", [fields.spo2.visible && fields.spo2.required ? ew.Validators.required(fields.spo2.caption) : null], fields.spo2.isInvalid],
        ["gcs", [fields.gcs.visible && fields.gcs.required ? ew.Validators.required(fields.gcs.caption) : null], fields.gcs.isInvalid],
        ["kesadaran", [fields.kesadaran.visible && fields.kesadaran.required ? ew.Validators.required(fields.kesadaran.caption) : null], fields.kesadaran.isInvalid],
        ["keluhan", [fields.keluhan.visible && fields.keluhan.required ? ew.Validators.required(fields.keluhan.caption) : null], fields.keluhan.isInvalid],
        ["pemeriksaan", [fields.pemeriksaan.visible && fields.pemeriksaan.required ? ew.Validators.required(fields.pemeriksaan.caption) : null], fields.pemeriksaan.isInvalid],
        ["alergi", [fields.alergi.visible && fields.alergi.required ? ew.Validators.required(fields.alergi.caption) : null], fields.alergi.isInvalid],
        ["lingkar_perut", [fields.lingkar_perut.visible && fields.lingkar_perut.required ? ew.Validators.required(fields.lingkar_perut.caption) : null], fields.lingkar_perut.isInvalid],
        ["rtl", [fields.rtl.visible && fields.rtl.required ? ew.Validators.required(fields.rtl.caption) : null], fields.rtl.isInvalid],
        ["penilaian", [fields.penilaian.visible && fields.penilaian.required ? ew.Validators.required(fields.penilaian.caption) : null], fields.penilaian.isInvalid],
        ["instruksi", [fields.instruksi.visible && fields.instruksi.required ? ew.Validators.required(fields.instruksi.caption) : null], fields.instruksi.isInvalid],
        ["evaluasi", [fields.evaluasi.visible && fields.evaluasi.required ? ew.Validators.required(fields.evaluasi.caption) : null], fields.evaluasi.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpemeriksaan_ralanadd,
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
    fpemeriksaan_ralanadd.validate = function () {
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
    fpemeriksaan_ralanadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpemeriksaan_ralanadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpemeriksaan_ralanadd.lists.kesadaran = <?= $Page->kesadaran->toClientList($Page) ?>;
    loadjs.done("fpemeriksaan_ralanadd");
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
<form name="fpemeriksaan_ralanadd" id="fpemeriksaan_ralanadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pemeriksaan_ralan">
<input type="hidden" name="action" id="action" value="insert">
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
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_pemeriksaan_ralan_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<?php if ($Page->no_rawat->getSessionValue() != "") { ?>
<span id="el_pemeriksaan_ralan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_rawat->getDisplayValue($Page->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_rawat" name="x_no_rawat" value="<?= HtmlEncode($Page->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_pemeriksaan_ralan_no_rawat">
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suhu_tubuh->Visible) { // suhu_tubuh ?>
    <div id="r_suhu_tubuh" class="form-group row">
        <label id="elh_pemeriksaan_ralan_suhu_tubuh" for="x_suhu_tubuh" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suhu_tubuh->caption() ?><?= $Page->suhu_tubuh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suhu_tubuh->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_suhu_tubuh">
<input type="<?= $Page->suhu_tubuh->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_suhu_tubuh" name="x_suhu_tubuh" id="x_suhu_tubuh" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->suhu_tubuh->getPlaceHolder()) ?>" value="<?= $Page->suhu_tubuh->EditValue ?>"<?= $Page->suhu_tubuh->editAttributes() ?> aria-describedby="x_suhu_tubuh_help">
<?= $Page->suhu_tubuh->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->suhu_tubuh->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tensi->Visible) { // tensi ?>
    <div id="r_tensi" class="form-group row">
        <label id="elh_pemeriksaan_ralan_tensi" for="x_tensi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tensi->caption() ?><?= $Page->tensi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tensi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_tensi">
<input type="<?= $Page->tensi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tensi" name="x_tensi" id="x_tensi" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->tensi->getPlaceHolder()) ?>" value="<?= $Page->tensi->EditValue ?>"<?= $Page->tensi->editAttributes() ?> aria-describedby="x_tensi_help">
<?= $Page->tensi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tensi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <div id="r_nadi" class="form-group row">
        <label id="elh_pemeriksaan_ralan_nadi" for="x_nadi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nadi->caption() ?><?= $Page->nadi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nadi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_nadi">
<input type="<?= $Page->nadi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nadi" name="x_nadi" id="x_nadi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->nadi->getPlaceHolder()) ?>" value="<?= $Page->nadi->EditValue ?>"<?= $Page->nadi->editAttributes() ?> aria-describedby="x_nadi_help">
<?= $Page->nadi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nadi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->respirasi->Visible) { // respirasi ?>
    <div id="r_respirasi" class="form-group row">
        <label id="elh_pemeriksaan_ralan_respirasi" for="x_respirasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->respirasi->caption() ?><?= $Page->respirasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->respirasi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_respirasi">
<input type="<?= $Page->respirasi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_respirasi" name="x_respirasi" id="x_respirasi" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->respirasi->getPlaceHolder()) ?>" value="<?= $Page->respirasi->EditValue ?>"<?= $Page->respirasi->editAttributes() ?> aria-describedby="x_respirasi_help">
<?= $Page->respirasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->respirasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tinggi->Visible) { // tinggi ?>
    <div id="r_tinggi" class="form-group row">
        <label id="elh_pemeriksaan_ralan_tinggi" for="x_tinggi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tinggi->caption() ?><?= $Page->tinggi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tinggi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_tinggi">
<input type="<?= $Page->tinggi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_tinggi" name="x_tinggi" id="x_tinggi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->tinggi->getPlaceHolder()) ?>" value="<?= $Page->tinggi->EditValue ?>"<?= $Page->tinggi->editAttributes() ?> aria-describedby="x_tinggi_help">
<?= $Page->tinggi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tinggi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->berat->Visible) { // berat ?>
    <div id="r_berat" class="form-group row">
        <label id="elh_pemeriksaan_ralan_berat" for="x_berat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->berat->caption() ?><?= $Page->berat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->berat->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_berat">
<input type="<?= $Page->berat->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_berat" name="x_berat" id="x_berat" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->berat->getPlaceHolder()) ?>" value="<?= $Page->berat->EditValue ?>"<?= $Page->berat->editAttributes() ?> aria-describedby="x_berat_help">
<?= $Page->berat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->berat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->spo2->Visible) { // spo2 ?>
    <div id="r_spo2" class="form-group row">
        <label id="elh_pemeriksaan_ralan_spo2" for="x_spo2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->spo2->caption() ?><?= $Page->spo2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->spo2->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_spo2">
<input type="<?= $Page->spo2->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_spo2" name="x_spo2" id="x_spo2" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->spo2->getPlaceHolder()) ?>" value="<?= $Page->spo2->EditValue ?>"<?= $Page->spo2->editAttributes() ?> aria-describedby="x_spo2_help">
<?= $Page->spo2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->spo2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <div id="r_gcs" class="form-group row">
        <label id="elh_pemeriksaan_ralan_gcs" for="x_gcs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gcs->caption() ?><?= $Page->gcs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gcs->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_gcs">
<input type="<?= $Page->gcs->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_gcs" name="x_gcs" id="x_gcs" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->gcs->getPlaceHolder()) ?>" value="<?= $Page->gcs->EditValue ?>"<?= $Page->gcs->editAttributes() ?> aria-describedby="x_gcs_help">
<?= $Page->gcs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gcs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <div id="r_kesadaran" class="form-group row">
        <label id="elh_pemeriksaan_ralan_kesadaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kesadaran->caption() ?><?= $Page->kesadaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_kesadaran">
<template id="tp_x_kesadaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pemeriksaan_ralan" data-field="x_kesadaran" name="x_kesadaran" id="x_kesadaran"<?= $Page->kesadaran->editAttributes() ?>>
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
    data-table="pemeriksaan_ralan"
    data-field="x_kesadaran"
    data-value-separator="<?= $Page->kesadaran->displayValueSeparatorAttribute() ?>"
    <?= $Page->kesadaran->editAttributes() ?>>
<?= $Page->kesadaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kesadaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keluhan->Visible) { // keluhan ?>
    <div id="r_keluhan" class="form-group row">
        <label id="elh_pemeriksaan_ralan_keluhan" for="x_keluhan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keluhan->caption() ?><?= $Page->keluhan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluhan->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_keluhan">
<textarea data-table="pemeriksaan_ralan" data-field="x_keluhan" name="x_keluhan" id="x_keluhan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keluhan->getPlaceHolder()) ?>"<?= $Page->keluhan->editAttributes() ?> aria-describedby="x_keluhan_help"><?= $Page->keluhan->EditValue ?></textarea>
<?= $Page->keluhan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keluhan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pemeriksaan->Visible) { // pemeriksaan ?>
    <div id="r_pemeriksaan" class="form-group row">
        <label id="elh_pemeriksaan_ralan_pemeriksaan" for="x_pemeriksaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pemeriksaan->caption() ?><?= $Page->pemeriksaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pemeriksaan->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_pemeriksaan">
<textarea data-table="pemeriksaan_ralan" data-field="x_pemeriksaan" name="x_pemeriksaan" id="x_pemeriksaan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->pemeriksaan->getPlaceHolder()) ?>"<?= $Page->pemeriksaan->editAttributes() ?> aria-describedby="x_pemeriksaan_help"><?= $Page->pemeriksaan->EditValue ?></textarea>
<?= $Page->pemeriksaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pemeriksaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <div id="r_alergi" class="form-group row">
        <label id="elh_pemeriksaan_ralan_alergi" for="x_alergi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alergi->caption() ?><?= $Page->alergi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alergi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_alergi">
<input type="<?= $Page->alergi->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_alergi" name="x_alergi" id="x_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->alergi->getPlaceHolder()) ?>" value="<?= $Page->alergi->EditValue ?>"<?= $Page->alergi->editAttributes() ?> aria-describedby="x_alergi_help">
<?= $Page->alergi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alergi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lingkar_perut->Visible) { // lingkar_perut ?>
    <div id="r_lingkar_perut" class="form-group row">
        <label id="elh_pemeriksaan_ralan_lingkar_perut" for="x_lingkar_perut" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lingkar_perut->caption() ?><?= $Page->lingkar_perut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lingkar_perut->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_lingkar_perut">
<input type="<?= $Page->lingkar_perut->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_lingkar_perut" name="x_lingkar_perut" id="x_lingkar_perut" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->lingkar_perut->getPlaceHolder()) ?>" value="<?= $Page->lingkar_perut->EditValue ?>"<?= $Page->lingkar_perut->editAttributes() ?> aria-describedby="x_lingkar_perut_help">
<?= $Page->lingkar_perut->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lingkar_perut->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rtl->Visible) { // rtl ?>
    <div id="r_rtl" class="form-group row">
        <label id="elh_pemeriksaan_ralan_rtl" for="x_rtl" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rtl->caption() ?><?= $Page->rtl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rtl->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_rtl">
<textarea data-table="pemeriksaan_ralan" data-field="x_rtl" name="x_rtl" id="x_rtl" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rtl->getPlaceHolder()) ?>"<?= $Page->rtl->editAttributes() ?> aria-describedby="x_rtl_help"><?= $Page->rtl->EditValue ?></textarea>
<?= $Page->rtl->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rtl->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->penilaian->Visible) { // penilaian ?>
    <div id="r_penilaian" class="form-group row">
        <label id="elh_pemeriksaan_ralan_penilaian" for="x_penilaian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->penilaian->caption() ?><?= $Page->penilaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->penilaian->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_penilaian">
<textarea data-table="pemeriksaan_ralan" data-field="x_penilaian" name="x_penilaian" id="x_penilaian" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->penilaian->getPlaceHolder()) ?>"<?= $Page->penilaian->editAttributes() ?> aria-describedby="x_penilaian_help"><?= $Page->penilaian->EditValue ?></textarea>
<?= $Page->penilaian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->penilaian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->instruksi->Visible) { // instruksi ?>
    <div id="r_instruksi" class="form-group row">
        <label id="elh_pemeriksaan_ralan_instruksi" for="x_instruksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->instruksi->caption() ?><?= $Page->instruksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->instruksi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_instruksi">
<textarea data-table="pemeriksaan_ralan" data-field="x_instruksi" name="x_instruksi" id="x_instruksi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->instruksi->getPlaceHolder()) ?>"<?= $Page->instruksi->editAttributes() ?> aria-describedby="x_instruksi_help"><?= $Page->instruksi->EditValue ?></textarea>
<?= $Page->instruksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->instruksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->evaluasi->Visible) { // evaluasi ?>
    <div id="r_evaluasi" class="form-group row">
        <label id="elh_pemeriksaan_ralan_evaluasi" for="x_evaluasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->evaluasi->caption() ?><?= $Page->evaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->evaluasi->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_evaluasi">
<textarea data-table="pemeriksaan_ralan" data-field="x_evaluasi" name="x_evaluasi" id="x_evaluasi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->evaluasi->getPlaceHolder()) ?>"<?= $Page->evaluasi->editAttributes() ?> aria-describedby="x_evaluasi_help"><?= $Page->evaluasi->EditValue ?></textarea>
<?= $Page->evaluasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->evaluasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <div id="r_nip" class="form-group row">
        <label id="elh_pemeriksaan_ralan_nip" for="x_nip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nip->caption() ?><?= $Page->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nip->cellAttributes() ?>>
<span id="el_pemeriksaan_ralan_nip">
<input type="<?= $Page->nip->getInputTextType() ?>" data-table="pemeriksaan_ralan" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->nip->getPlaceHolder()) ?>" value="<?= $Page->nip->EditValue ?>"<?= $Page->nip->editAttributes() ?> aria-describedby="x_nip_help">
<?= $Page->nip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nip->getErrorMessage() ?></div>
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
    ew.addEventHandlers("pemeriksaan_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
