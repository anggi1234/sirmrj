<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisRalanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_medis_ralanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpenilaian_medis_ralanedit = currentForm = new ew.Form("fpenilaian_medis_ralanedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_medis_ralan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_medis_ralan)
        ew.vars.tables.penilaian_medis_ralan = currentTable;
    fpenilaian_medis_ralanedit.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null], fields.tanggal.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["anamnesis", [fields.anamnesis.visible && fields.anamnesis.required ? ew.Validators.required(fields.anamnesis.caption) : null], fields.anamnesis.isInvalid],
        ["keluhan_utama", [fields.keluhan_utama.visible && fields.keluhan_utama.required ? ew.Validators.required(fields.keluhan_utama.caption) : null], fields.keluhan_utama.isInvalid],
        ["alergi", [fields.alergi.visible && fields.alergi.required ? ew.Validators.required(fields.alergi.caption) : null], fields.alergi.isInvalid],
        ["keadaan", [fields.keadaan.visible && fields.keadaan.required ? ew.Validators.required(fields.keadaan.caption) : null], fields.keadaan.isInvalid],
        ["gcs", [fields.gcs.visible && fields.gcs.required ? ew.Validators.required(fields.gcs.caption) : null], fields.gcs.isInvalid],
        ["kesadaran", [fields.kesadaran.visible && fields.kesadaran.required ? ew.Validators.required(fields.kesadaran.caption) : null], fields.kesadaran.isInvalid],
        ["td", [fields.td.visible && fields.td.required ? ew.Validators.required(fields.td.caption) : null], fields.td.isInvalid],
        ["nadi", [fields.nadi.visible && fields.nadi.required ? ew.Validators.required(fields.nadi.caption) : null], fields.nadi.isInvalid],
        ["rr", [fields.rr.visible && fields.rr.required ? ew.Validators.required(fields.rr.caption) : null], fields.rr.isInvalid],
        ["suhu", [fields.suhu.visible && fields.suhu.required ? ew.Validators.required(fields.suhu.caption) : null], fields.suhu.isInvalid],
        ["bb", [fields.bb.visible && fields.bb.required ? ew.Validators.required(fields.bb.caption) : null], fields.bb.isInvalid],
        ["tb", [fields.tb.visible && fields.tb.required ? ew.Validators.required(fields.tb.caption) : null], fields.tb.isInvalid],
        ["ket_fisik", [fields.ket_fisik.visible && fields.ket_fisik.required ? ew.Validators.required(fields.ket_fisik.caption) : null], fields.ket_fisik.isInvalid],
        ["penunjang", [fields.penunjang.visible && fields.penunjang.required ? ew.Validators.required(fields.penunjang.caption) : null], fields.penunjang.isInvalid],
        ["diagnosis", [fields.diagnosis.visible && fields.diagnosis.required ? ew.Validators.required(fields.diagnosis.caption) : null], fields.diagnosis.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_medis_ralanedit,
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
    fpenilaian_medis_ralanedit.validate = function () {
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
    fpenilaian_medis_ralanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_medis_ralanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_medis_ralanedit.lists.anamnesis = <?= $Page->anamnesis->toClientList($Page) ?>;
    fpenilaian_medis_ralanedit.lists.keadaan = <?= $Page->keadaan->toClientList($Page) ?>;
    fpenilaian_medis_ralanedit.lists.kesadaran = <?= $Page->kesadaran->toClientList($Page) ?>;
    loadjs.done("fpenilaian_medis_ralanedit");
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
<form name="fpenilaian_medis_ralanedit" id="fpenilaian_medis_ralanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_medis_ralan">
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_penilaian_medis_ralan_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_rawat->getDisplayValue($Page->no_rawat->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_no_rawat" data-hidden="1" name="x_no_rawat" id="x_no_rawat" value="<?= HtmlEncode($Page->no_rawat->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <div id="r_kd_dokter" class="form-group row">
        <label id="elh_penilaian_medis_ralan_kd_dokter" for="x_kd_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dokter->caption() ?><?= $Page->kd_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_dokter->getDisplayValue($Page->kd_dokter->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="penilaian_medis_ralan" data-field="x_kd_dokter" data-hidden="1" name="x_kd_dokter" id="x_kd_dokter" value="<?= HtmlEncode($Page->kd_dokter->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <div id="r_anamnesis" class="form-group row">
        <label id="elh_penilaian_medis_ralan_anamnesis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->anamnesis->caption() ?><?= $Page->anamnesis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_anamnesis">
<template id="tp_x_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_anamnesis" name="x_anamnesis" id="x_anamnesis"<?= $Page->anamnesis->editAttributes() ?>>
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
    data-table="penilaian_medis_ralan"
    data-field="x_anamnesis"
    data-value-separator="<?= $Page->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Page->anamnesis->editAttributes() ?>>
<?= $Page->anamnesis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->anamnesis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <div id="r_keluhan_utama" class="form-group row">
        <label id="elh_penilaian_medis_ralan_keluhan_utama" for="x_keluhan_utama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keluhan_utama->caption() ?><?= $Page->keluhan_utama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_keluhan_utama">
<textarea data-table="penilaian_medis_ralan" data-field="x_keluhan_utama" name="x_keluhan_utama" id="x_keluhan_utama" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keluhan_utama->getPlaceHolder()) ?>"<?= $Page->keluhan_utama->editAttributes() ?> aria-describedby="x_keluhan_utama_help"><?= $Page->keluhan_utama->EditValue ?></textarea>
<?= $Page->keluhan_utama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keluhan_utama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <div id="r_alergi" class="form-group row">
        <label id="elh_penilaian_medis_ralan_alergi" for="x_alergi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alergi->caption() ?><?= $Page->alergi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alergi->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_alergi">
<input type="<?= $Page->alergi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_alergi" name="x_alergi" id="x_alergi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->alergi->getPlaceHolder()) ?>" value="<?= $Page->alergi->EditValue ?>"<?= $Page->alergi->editAttributes() ?> aria-describedby="x_alergi_help">
<?= $Page->alergi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alergi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <div id="r_keadaan" class="form-group row">
        <label id="elh_penilaian_medis_ralan_keadaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keadaan->caption() ?><?= $Page->keadaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keadaan->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_keadaan">
<template id="tp_x_keadaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_keadaan" name="x_keadaan" id="x_keadaan"<?= $Page->keadaan->editAttributes() ?>>
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
    data-table="penilaian_medis_ralan"
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
        <label id="elh_penilaian_medis_ralan_gcs" for="x_gcs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gcs->caption() ?><?= $Page->gcs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gcs->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_gcs">
<input type="<?= $Page->gcs->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_gcs" name="x_gcs" id="x_gcs" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->gcs->getPlaceHolder()) ?>" value="<?= $Page->gcs->EditValue ?>"<?= $Page->gcs->editAttributes() ?> aria-describedby="x_gcs_help">
<?= $Page->gcs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gcs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <div id="r_kesadaran" class="form-group row">
        <label id="elh_penilaian_medis_ralan_kesadaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kesadaran->caption() ?><?= $Page->kesadaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kesadaran->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_kesadaran">
<template id="tp_x_kesadaran">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_medis_ralan" data-field="x_kesadaran" name="x_kesadaran" id="x_kesadaran"<?= $Page->kesadaran->editAttributes() ?>>
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
    data-table="penilaian_medis_ralan"
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
        <label id="elh_penilaian_medis_ralan_td" for="x_td" class="<?= $Page->LeftColumnClass ?>"><?= $Page->td->caption() ?><?= $Page->td->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->td->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_td">
<input type="<?= $Page->td->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_td" name="x_td" id="x_td" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->td->getPlaceHolder()) ?>" value="<?= $Page->td->EditValue ?>"<?= $Page->td->editAttributes() ?> aria-describedby="x_td_help">
<?= $Page->td->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->td->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <div id="r_nadi" class="form-group row">
        <label id="elh_penilaian_medis_ralan_nadi" for="x_nadi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nadi->caption() ?><?= $Page->nadi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nadi->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_nadi">
<input type="<?= $Page->nadi->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_nadi" name="x_nadi" id="x_nadi" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->nadi->getPlaceHolder()) ?>" value="<?= $Page->nadi->EditValue ?>"<?= $Page->nadi->editAttributes() ?> aria-describedby="x_nadi_help">
<?= $Page->nadi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nadi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <div id="r_rr" class="form-group row">
        <label id="elh_penilaian_medis_ralan_rr" for="x_rr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rr->caption() ?><?= $Page->rr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rr->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_rr">
<input type="<?= $Page->rr->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_rr" name="x_rr" id="x_rr" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->rr->getPlaceHolder()) ?>" value="<?= $Page->rr->EditValue ?>"<?= $Page->rr->editAttributes() ?> aria-describedby="x_rr_help">
<?= $Page->rr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <div id="r_suhu" class="form-group row">
        <label id="elh_penilaian_medis_ralan_suhu" for="x_suhu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suhu->caption() ?><?= $Page->suhu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suhu->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_suhu">
<input type="<?= $Page->suhu->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_suhu" name="x_suhu" id="x_suhu" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->suhu->getPlaceHolder()) ?>" value="<?= $Page->suhu->EditValue ?>"<?= $Page->suhu->editAttributes() ?> aria-describedby="x_suhu_help">
<?= $Page->suhu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->suhu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <div id="r_bb" class="form-group row">
        <label id="elh_penilaian_medis_ralan_bb" for="x_bb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bb->caption() ?><?= $Page->bb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bb->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_bb">
<input type="<?= $Page->bb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_bb" name="x_bb" id="x_bb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->bb->getPlaceHolder()) ?>" value="<?= $Page->bb->EditValue ?>"<?= $Page->bb->editAttributes() ?> aria-describedby="x_bb_help">
<?= $Page->bb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <div id="r_tb" class="form-group row">
        <label id="elh_penilaian_medis_ralan_tb" for="x_tb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tb->caption() ?><?= $Page->tb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tb->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_tb">
<input type="<?= $Page->tb->getInputTextType() ?>" data-table="penilaian_medis_ralan" data-field="x_tb" name="x_tb" id="x_tb" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->tb->getPlaceHolder()) ?>" value="<?= $Page->tb->EditValue ?>"<?= $Page->tb->editAttributes() ?> aria-describedby="x_tb_help">
<?= $Page->tb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_fisik->Visible) { // ket_fisik ?>
    <div id="r_ket_fisik" class="form-group row">
        <label id="elh_penilaian_medis_ralan_ket_fisik" for="x_ket_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_fisik->caption() ?><?= $Page->ket_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_fisik->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_ket_fisik">
<textarea data-table="penilaian_medis_ralan" data-field="x_ket_fisik" name="x_ket_fisik" id="x_ket_fisik" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ket_fisik->getPlaceHolder()) ?>"<?= $Page->ket_fisik->editAttributes() ?> aria-describedby="x_ket_fisik_help"><?= $Page->ket_fisik->EditValue ?></textarea>
<?= $Page->ket_fisik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_fisik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->penunjang->Visible) { // penunjang ?>
    <div id="r_penunjang" class="form-group row">
        <label id="elh_penilaian_medis_ralan_penunjang" for="x_penunjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->penunjang->caption() ?><?= $Page->penunjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->penunjang->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_penunjang">
<textarea data-table="penilaian_medis_ralan" data-field="x_penunjang" name="x_penunjang" id="x_penunjang" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->penunjang->getPlaceHolder()) ?>"<?= $Page->penunjang->editAttributes() ?> aria-describedby="x_penunjang_help"><?= $Page->penunjang->EditValue ?></textarea>
<?= $Page->penunjang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->penunjang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
    <div id="r_diagnosis" class="form-group row">
        <label id="elh_penilaian_medis_ralan_diagnosis" for="x_diagnosis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->diagnosis->caption() ?><?= $Page->diagnosis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->diagnosis->cellAttributes() ?>>
<span id="el_penilaian_medis_ralan_diagnosis">
<textarea data-table="penilaian_medis_ralan" data-field="x_diagnosis" name="x_diagnosis" id="x_diagnosis" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->diagnosis->getPlaceHolder()) ?>"<?= $Page->diagnosis->editAttributes() ?> aria-describedby="x_diagnosis_help"><?= $Page->diagnosis->EditValue ?></textarea>
<?= $Page->diagnosis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->diagnosis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="penilaian_medis_ralan" data-field="x_id_penilaian_medis_ralan" data-hidden="1" name="x_id_penilaian_medis_ralan" id="x_id_penilaian_medis_ralan" value="<?= HtmlEncode($Page->id_penilaian_medis_ralan->CurrentValue) ?>">
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
    ew.addEventHandlers("penilaian_medis_ralan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
