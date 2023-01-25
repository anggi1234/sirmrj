<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PasienKunjunganAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpasien_kunjunganadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpasien_kunjunganadd = currentForm = new ew.Form("fpasien_kunjunganadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pasien_kunjungan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pasien_kunjungan)
        ew.vars.tables.pasien_kunjungan = currentTable;
    fpasien_kunjunganadd.addFields([
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null], fields.no_reg.isInvalid],
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tgl_registrasi", [fields.tgl_registrasi.visible && fields.tgl_registrasi.required ? ew.Validators.required(fields.tgl_registrasi.caption) : null], fields.tgl_registrasi.isInvalid],
        ["jam_reg", [fields.jam_reg.visible && fields.jam_reg.required ? ew.Validators.required(fields.jam_reg.caption) : null], fields.jam_reg.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["kd_poli", [fields.kd_poli.visible && fields.kd_poli.required ? ew.Validators.required(fields.kd_poli.caption) : null], fields.kd_poli.isInvalid],
        ["p_jawab", [fields.p_jawab.visible && fields.p_jawab.required ? ew.Validators.required(fields.p_jawab.caption) : null], fields.p_jawab.isInvalid],
        ["almt_pj", [fields.almt_pj.visible && fields.almt_pj.required ? ew.Validators.required(fields.almt_pj.caption) : null], fields.almt_pj.isInvalid],
        ["hubunganpj", [fields.hubunganpj.visible && fields.hubunganpj.required ? ew.Validators.required(fields.hubunganpj.caption) : null], fields.hubunganpj.isInvalid],
        ["biaya_reg", [fields.biaya_reg.visible && fields.biaya_reg.required ? ew.Validators.required(fields.biaya_reg.caption) : null, ew.Validators.float], fields.biaya_reg.isInvalid],
        ["stts", [fields.stts.visible && fields.stts.required ? ew.Validators.required(fields.stts.caption) : null], fields.stts.isInvalid],
        ["stts_daftar", [fields.stts_daftar.visible && fields.stts_daftar.required ? ew.Validators.required(fields.stts_daftar.caption) : null], fields.stts_daftar.isInvalid],
        ["status_lanjut", [fields.status_lanjut.visible && fields.status_lanjut.required ? ew.Validators.required(fields.status_lanjut.caption) : null], fields.status_lanjut.isInvalid],
        ["kd_pj", [fields.kd_pj.visible && fields.kd_pj.required ? ew.Validators.required(fields.kd_pj.caption) : null], fields.kd_pj.isInvalid],
        ["umurdaftar", [fields.umurdaftar.visible && fields.umurdaftar.required ? ew.Validators.required(fields.umurdaftar.caption) : null, ew.Validators.integer], fields.umurdaftar.isInvalid],
        ["sttsumur", [fields.sttsumur.visible && fields.sttsumur.required ? ew.Validators.required(fields.sttsumur.caption) : null], fields.sttsumur.isInvalid],
        ["status_bayar", [fields.status_bayar.visible && fields.status_bayar.required ? ew.Validators.required(fields.status_bayar.caption) : null], fields.status_bayar.isInvalid],
        ["status_poli", [fields.status_poli.visible && fields.status_poli.required ? ew.Validators.required(fields.status_poli.caption) : null], fields.status_poli.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpasien_kunjunganadd,
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
    fpasien_kunjunganadd.validate = function () {
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
    fpasien_kunjunganadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpasien_kunjunganadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpasien_kunjunganadd.lists.no_rkm_medis = <?= $Page->no_rkm_medis->toClientList($Page) ?>;
    fpasien_kunjunganadd.lists.stts = <?= $Page->stts->toClientList($Page) ?>;
    fpasien_kunjunganadd.lists.stts_daftar = <?= $Page->stts_daftar->toClientList($Page) ?>;
    fpasien_kunjunganadd.lists.status_lanjut = <?= $Page->status_lanjut->toClientList($Page) ?>;
    fpasien_kunjunganadd.lists.sttsumur = <?= $Page->sttsumur->toClientList($Page) ?>;
    fpasien_kunjunganadd.lists.status_bayar = <?= $Page->status_bayar->toClientList($Page) ?>;
    fpasien_kunjunganadd.lists.status_poli = <?= $Page->status_poli->toClientList($Page) ?>;
    loadjs.done("fpasien_kunjunganadd");
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
<form name="fpasien_kunjunganadd" id="fpasien_kunjunganadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien_kunjungan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "vriwayat") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vriwayat">
<input type="hidden" name="fk_no_rkm_medis" value="<?= HtmlEncode($Page->no_rkm_medis->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <div id="r_no_rkm_medis" class="form-group row">
        <label id="elh_pasien_kunjungan_no_rkm_medis" for="x_no_rkm_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rkm_medis->caption() ?><?= $Page->no_rkm_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rkm_medis->cellAttributes() ?>>
<?php if ($Page->no_rkm_medis->getSessionValue() != "") { ?>
<span id="el_pasien_kunjungan_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_rkm_medis->getDisplayValue($Page->no_rkm_medis->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_rkm_medis" name="x_no_rkm_medis" value="<?= HtmlEncode($Page->no_rkm_medis->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_pasien_kunjungan_no_rkm_medis">
<div class="input-group ew-lookup-list" aria-describedby="x_no_rkm_medis_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_no_rkm_medis"><?= EmptyValue(strval($Page->no_rkm_medis->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->no_rkm_medis->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->no_rkm_medis->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->no_rkm_medis->ReadOnly || $Page->no_rkm_medis->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_no_rkm_medis',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->no_rkm_medis->getErrorMessage() ?></div>
<?= $Page->no_rkm_medis->getCustomMessage() ?>
<?= $Page->no_rkm_medis->Lookup->getParamTag($Page, "p_x_no_rkm_medis") ?>
<input type="hidden" is="selection-list" data-table="pasien_kunjungan" data-field="x_no_rkm_medis" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->no_rkm_medis->displayValueSeparatorAttribute() ?>" name="x_no_rkm_medis" id="x_no_rkm_medis" value="<?= $Page->no_rkm_medis->CurrentValue ?>"<?= $Page->no_rkm_medis->editAttributes() ?>>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <div id="r_no_reg" class="form-group row">
        <label id="elh_pasien_kunjungan_no_reg" for="x_no_reg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_reg->caption() ?><?= $Page->no_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_reg->cellAttributes() ?>>
<span id="el_pasien_kunjungan_no_reg">
<input type="<?= $Page->no_reg->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_no_reg" name="x_no_reg" id="x_no_reg" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->no_reg->getPlaceHolder()) ?>" value="<?= $Page->no_reg->EditValue ?>"<?= $Page->no_reg->editAttributes() ?> aria-describedby="x_no_reg_help">
<?= $Page->no_reg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_reg->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_pasien_kunjungan_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_pasien_kunjungan_no_rawat">
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <div id="r_kd_dokter" class="form-group row">
        <label id="elh_pasien_kunjungan_kd_dokter" for="x_kd_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dokter->caption() ?><?= $Page->kd_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_pasien_kunjungan_kd_dokter">
    <select
        id="x_kd_dokter"
        name="x_kd_dokter"
        class="form-control ew-select<?= $Page->kd_dokter->isInvalidClass() ?>"
        data-select2-id="pasien_kunjungan_x_kd_dokter"
        data-table="pasien_kunjungan"
        data-field="x_kd_dokter"
        data-value-separator="<?= $Page->kd_dokter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_dokter->getPlaceHolder()) ?>"
        <?= $Page->kd_dokter->editAttributes() ?>>
        <?= $Page->kd_dokter->selectOptionListHtml("x_kd_dokter") ?>
    </select>
    <?= $Page->kd_dokter->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_dokter->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_kunjungan_x_kd_dokter']"),
        options = { name: "x_kd_dokter", selectId: "pasien_kunjungan_x_kd_dokter", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien_kunjungan.fields.kd_dokter.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <div id="r_kd_poli" class="form-group row">
        <label id="elh_pasien_kunjungan_kd_poli" for="x_kd_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_poli->caption() ?><?= $Page->kd_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_pasien_kunjungan_kd_poli">
<input type="<?= $Page->kd_poli->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_kd_poli" name="x_kd_poli" id="x_kd_poli" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->kd_poli->getPlaceHolder()) ?>" value="<?= $Page->kd_poli->EditValue ?>"<?= $Page->kd_poli->editAttributes() ?> aria-describedby="x_kd_poli_help">
<?= $Page->kd_poli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_poli->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->p_jawab->Visible) { // p_jawab ?>
    <div id="r_p_jawab" class="form-group row">
        <label id="elh_pasien_kunjungan_p_jawab" for="x_p_jawab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->p_jawab->caption() ?><?= $Page->p_jawab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->p_jawab->cellAttributes() ?>>
<span id="el_pasien_kunjungan_p_jawab">
<input type="<?= $Page->p_jawab->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_p_jawab" name="x_p_jawab" id="x_p_jawab" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->p_jawab->getPlaceHolder()) ?>" value="<?= $Page->p_jawab->EditValue ?>"<?= $Page->p_jawab->editAttributes() ?> aria-describedby="x_p_jawab_help">
<?= $Page->p_jawab->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->p_jawab->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->almt_pj->Visible) { // almt_pj ?>
    <div id="r_almt_pj" class="form-group row">
        <label id="elh_pasien_kunjungan_almt_pj" for="x_almt_pj" class="<?= $Page->LeftColumnClass ?>"><?= $Page->almt_pj->caption() ?><?= $Page->almt_pj->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->almt_pj->cellAttributes() ?>>
<span id="el_pasien_kunjungan_almt_pj">
<input type="<?= $Page->almt_pj->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_almt_pj" name="x_almt_pj" id="x_almt_pj" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->almt_pj->getPlaceHolder()) ?>" value="<?= $Page->almt_pj->EditValue ?>"<?= $Page->almt_pj->editAttributes() ?> aria-describedby="x_almt_pj_help">
<?= $Page->almt_pj->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->almt_pj->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hubunganpj->Visible) { // hubunganpj ?>
    <div id="r_hubunganpj" class="form-group row">
        <label id="elh_pasien_kunjungan_hubunganpj" for="x_hubunganpj" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hubunganpj->caption() ?><?= $Page->hubunganpj->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hubunganpj->cellAttributes() ?>>
<span id="el_pasien_kunjungan_hubunganpj">
<input type="<?= $Page->hubunganpj->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_hubunganpj" name="x_hubunganpj" id="x_hubunganpj" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->hubunganpj->getPlaceHolder()) ?>" value="<?= $Page->hubunganpj->EditValue ?>"<?= $Page->hubunganpj->editAttributes() ?> aria-describedby="x_hubunganpj_help">
<?= $Page->hubunganpj->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hubunganpj->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->biaya_reg->Visible) { // biaya_reg ?>
    <div id="r_biaya_reg" class="form-group row">
        <label id="elh_pasien_kunjungan_biaya_reg" for="x_biaya_reg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->biaya_reg->caption() ?><?= $Page->biaya_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->biaya_reg->cellAttributes() ?>>
<span id="el_pasien_kunjungan_biaya_reg">
<input type="<?= $Page->biaya_reg->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_biaya_reg" name="x_biaya_reg" id="x_biaya_reg" size="30" placeholder="<?= HtmlEncode($Page->biaya_reg->getPlaceHolder()) ?>" value="<?= $Page->biaya_reg->EditValue ?>"<?= $Page->biaya_reg->editAttributes() ?> aria-describedby="x_biaya_reg_help">
<?= $Page->biaya_reg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->biaya_reg->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stts->Visible) { // stts ?>
    <div id="r_stts" class="form-group row">
        <label id="elh_pasien_kunjungan_stts" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stts->caption() ?><?= $Page->stts->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->stts->cellAttributes() ?>>
<span id="el_pasien_kunjungan_stts">
<template id="tp_x_stts">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien_kunjungan" data-field="x_stts" name="x_stts" id="x_stts"<?= $Page->stts->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_stts" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_stts"
    name="x_stts"
    value="<?= HtmlEncode($Page->stts->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_stts"
    data-target="dsl_x_stts"
    data-repeatcolumn="5"
    class="form-control<?= $Page->stts->isInvalidClass() ?>"
    data-table="pasien_kunjungan"
    data-field="x_stts"
    data-value-separator="<?= $Page->stts->displayValueSeparatorAttribute() ?>"
    <?= $Page->stts->editAttributes() ?>>
<?= $Page->stts->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->stts->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stts_daftar->Visible) { // stts_daftar ?>
    <div id="r_stts_daftar" class="form-group row">
        <label id="elh_pasien_kunjungan_stts_daftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stts_daftar->caption() ?><?= $Page->stts_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->stts_daftar->cellAttributes() ?>>
<span id="el_pasien_kunjungan_stts_daftar">
<template id="tp_x_stts_daftar">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien_kunjungan" data-field="x_stts_daftar" name="x_stts_daftar" id="x_stts_daftar"<?= $Page->stts_daftar->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_stts_daftar" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_stts_daftar"
    name="x_stts_daftar"
    value="<?= HtmlEncode($Page->stts_daftar->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_stts_daftar"
    data-target="dsl_x_stts_daftar"
    data-repeatcolumn="5"
    class="form-control<?= $Page->stts_daftar->isInvalidClass() ?>"
    data-table="pasien_kunjungan"
    data-field="x_stts_daftar"
    data-value-separator="<?= $Page->stts_daftar->displayValueSeparatorAttribute() ?>"
    <?= $Page->stts_daftar->editAttributes() ?>>
<?= $Page->stts_daftar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->stts_daftar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_lanjut->Visible) { // status_lanjut ?>
    <div id="r_status_lanjut" class="form-group row">
        <label id="elh_pasien_kunjungan_status_lanjut" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_lanjut->caption() ?><?= $Page->status_lanjut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_lanjut->cellAttributes() ?>>
<span id="el_pasien_kunjungan_status_lanjut">
<template id="tp_x_status_lanjut">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien_kunjungan" data-field="x_status_lanjut" name="x_status_lanjut" id="x_status_lanjut"<?= $Page->status_lanjut->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status_lanjut" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status_lanjut"
    name="x_status_lanjut"
    value="<?= HtmlEncode($Page->status_lanjut->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_lanjut"
    data-target="dsl_x_status_lanjut"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_lanjut->isInvalidClass() ?>"
    data-table="pasien_kunjungan"
    data-field="x_status_lanjut"
    data-value-separator="<?= $Page->status_lanjut->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_lanjut->editAttributes() ?>>
<?= $Page->status_lanjut->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_lanjut->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_pj->Visible) { // kd_pj ?>
    <div id="r_kd_pj" class="form-group row">
        <label id="elh_pasien_kunjungan_kd_pj" for="x_kd_pj" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_pj->caption() ?><?= $Page->kd_pj->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_pj->cellAttributes() ?>>
<span id="el_pasien_kunjungan_kd_pj">
<input type="<?= $Page->kd_pj->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_kd_pj" name="x_kd_pj" id="x_kd_pj" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->kd_pj->getPlaceHolder()) ?>" value="<?= $Page->kd_pj->EditValue ?>"<?= $Page->kd_pj->editAttributes() ?> aria-describedby="x_kd_pj_help">
<?= $Page->kd_pj->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_pj->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->umurdaftar->Visible) { // umurdaftar ?>
    <div id="r_umurdaftar" class="form-group row">
        <label id="elh_pasien_kunjungan_umurdaftar" for="x_umurdaftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->umurdaftar->caption() ?><?= $Page->umurdaftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->umurdaftar->cellAttributes() ?>>
<span id="el_pasien_kunjungan_umurdaftar">
<input type="<?= $Page->umurdaftar->getInputTextType() ?>" data-table="pasien_kunjungan" data-field="x_umurdaftar" name="x_umurdaftar" id="x_umurdaftar" size="30" placeholder="<?= HtmlEncode($Page->umurdaftar->getPlaceHolder()) ?>" value="<?= $Page->umurdaftar->EditValue ?>"<?= $Page->umurdaftar->editAttributes() ?> aria-describedby="x_umurdaftar_help">
<?= $Page->umurdaftar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->umurdaftar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sttsumur->Visible) { // sttsumur ?>
    <div id="r_sttsumur" class="form-group row">
        <label id="elh_pasien_kunjungan_sttsumur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sttsumur->caption() ?><?= $Page->sttsumur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sttsumur->cellAttributes() ?>>
<span id="el_pasien_kunjungan_sttsumur">
<template id="tp_x_sttsumur">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien_kunjungan" data-field="x_sttsumur" name="x_sttsumur" id="x_sttsumur"<?= $Page->sttsumur->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_sttsumur" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_sttsumur"
    name="x_sttsumur"
    value="<?= HtmlEncode($Page->sttsumur->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_sttsumur"
    data-target="dsl_x_sttsumur"
    data-repeatcolumn="5"
    class="form-control<?= $Page->sttsumur->isInvalidClass() ?>"
    data-table="pasien_kunjungan"
    data-field="x_sttsumur"
    data-value-separator="<?= $Page->sttsumur->displayValueSeparatorAttribute() ?>"
    <?= $Page->sttsumur->editAttributes() ?>>
<?= $Page->sttsumur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sttsumur->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_bayar->Visible) { // status_bayar ?>
    <div id="r_status_bayar" class="form-group row">
        <label id="elh_pasien_kunjungan_status_bayar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_bayar->caption() ?><?= $Page->status_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_bayar->cellAttributes() ?>>
<span id="el_pasien_kunjungan_status_bayar">
<template id="tp_x_status_bayar">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien_kunjungan" data-field="x_status_bayar" name="x_status_bayar" id="x_status_bayar"<?= $Page->status_bayar->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status_bayar" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status_bayar"
    name="x_status_bayar"
    value="<?= HtmlEncode($Page->status_bayar->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_bayar"
    data-target="dsl_x_status_bayar"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_bayar->isInvalidClass() ?>"
    data-table="pasien_kunjungan"
    data-field="x_status_bayar"
    data-value-separator="<?= $Page->status_bayar->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_bayar->editAttributes() ?>>
<?= $Page->status_bayar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_bayar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_poli->Visible) { // status_poli ?>
    <div id="r_status_poli" class="form-group row">
        <label id="elh_pasien_kunjungan_status_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_poli->caption() ?><?= $Page->status_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_poli->cellAttributes() ?>>
<span id="el_pasien_kunjungan_status_poli">
<template id="tp_x_status_poli">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien_kunjungan" data-field="x_status_poli" name="x_status_poli" id="x_status_poli"<?= $Page->status_poli->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status_poli" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status_poli"
    name="x_status_poli"
    value="<?= HtmlEncode($Page->status_poli->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_poli"
    data-target="dsl_x_status_poli"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_poli->isInvalidClass() ?>"
    data-table="pasien_kunjungan"
    data-field="x_status_poli"
    data-value-separator="<?= $Page->status_poli->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_poli->editAttributes() ?>>
<?= $Page->status_poli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_poli->getErrorMessage() ?></div>
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
    ew.addEventHandlers("pasien_kunjungan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
