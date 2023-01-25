<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PasienEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpasienedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpasienedit = currentForm = new ew.Form("fpasienedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pasien")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pasien)
        ew.vars.tables.pasien = currentTable;
    fpasienedit.addFields([
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["nm_pasien", [fields.nm_pasien.visible && fields.nm_pasien.required ? ew.Validators.required(fields.nm_pasien.caption) : null], fields.nm_pasien.isInvalid],
        ["no_ktp", [fields.no_ktp.visible && fields.no_ktp.required ? ew.Validators.required(fields.no_ktp.caption) : null], fields.no_ktp.isInvalid],
        ["jk", [fields.jk.visible && fields.jk.required ? ew.Validators.required(fields.jk.caption) : null], fields.jk.isInvalid],
        ["tmp_lahir", [fields.tmp_lahir.visible && fields.tmp_lahir.required ? ew.Validators.required(fields.tmp_lahir.caption) : null], fields.tmp_lahir.isInvalid],
        ["tgl_lahir", [fields.tgl_lahir.visible && fields.tgl_lahir.required ? ew.Validators.required(fields.tgl_lahir.caption) : null, ew.Validators.datetime(7)], fields.tgl_lahir.isInvalid],
        ["nm_ibu", [fields.nm_ibu.visible && fields.nm_ibu.required ? ew.Validators.required(fields.nm_ibu.caption) : null], fields.nm_ibu.isInvalid],
        ["alamat", [fields.alamat.visible && fields.alamat.required ? ew.Validators.required(fields.alamat.caption) : null], fields.alamat.isInvalid],
        ["gol_darah", [fields.gol_darah.visible && fields.gol_darah.required ? ew.Validators.required(fields.gol_darah.caption) : null], fields.gol_darah.isInvalid],
        ["pekerjaan", [fields.pekerjaan.visible && fields.pekerjaan.required ? ew.Validators.required(fields.pekerjaan.caption) : null], fields.pekerjaan.isInvalid],
        ["stts_nikah", [fields.stts_nikah.visible && fields.stts_nikah.required ? ew.Validators.required(fields.stts_nikah.caption) : null], fields.stts_nikah.isInvalid],
        ["agama", [fields.agama.visible && fields.agama.required ? ew.Validators.required(fields.agama.caption) : null], fields.agama.isInvalid],
        ["tgl_daftar", [fields.tgl_daftar.visible && fields.tgl_daftar.required ? ew.Validators.required(fields.tgl_daftar.caption) : null], fields.tgl_daftar.isInvalid],
        ["pnd", [fields.pnd.visible && fields.pnd.required ? ew.Validators.required(fields.pnd.caption) : null], fields.pnd.isInvalid],
        ["kd_pj", [fields.kd_pj.visible && fields.kd_pj.required ? ew.Validators.required(fields.kd_pj.caption) : null], fields.kd_pj.isInvalid],
        ["no_peserta", [fields.no_peserta.visible && fields.no_peserta.required ? ew.Validators.required(fields.no_peserta.caption) : null], fields.no_peserta.isInvalid],
        ["kd_kel", [fields.kd_kel.visible && fields.kd_kel.required ? ew.Validators.required(fields.kd_kel.caption) : null], fields.kd_kel.isInvalid],
        ["kd_kec", [fields.kd_kec.visible && fields.kd_kec.required ? ew.Validators.required(fields.kd_kec.caption) : null], fields.kd_kec.isInvalid],
        ["kd_kab", [fields.kd_kab.visible && fields.kd_kab.required ? ew.Validators.required(fields.kd_kab.caption) : null], fields.kd_kab.isInvalid],
        ["kd_prop", [fields.kd_prop.visible && fields.kd_prop.required ? ew.Validators.required(fields.kd_prop.caption) : null], fields.kd_prop.isInvalid],
        ["suku_bangsa", [fields.suku_bangsa.visible && fields.suku_bangsa.required ? ew.Validators.required(fields.suku_bangsa.caption) : null], fields.suku_bangsa.isInvalid],
        ["bahasa_pasien", [fields.bahasa_pasien.visible && fields.bahasa_pasien.required ? ew.Validators.required(fields.bahasa_pasien.caption) : null], fields.bahasa_pasien.isInvalid],
        ["cacat_fisik", [fields.cacat_fisik.visible && fields.cacat_fisik.required ? ew.Validators.required(fields.cacat_fisik.caption) : null], fields.cacat_fisik.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpasienedit,
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
    fpasienedit.validate = function () {
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
    fpasienedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpasienedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpasienedit.lists.jk = <?= $Page->jk->toClientList($Page) ?>;
    fpasienedit.lists.gol_darah = <?= $Page->gol_darah->toClientList($Page) ?>;
    fpasienedit.lists.stts_nikah = <?= $Page->stts_nikah->toClientList($Page) ?>;
    fpasienedit.lists.agama = <?= $Page->agama->toClientList($Page) ?>;
    fpasienedit.lists.pnd = <?= $Page->pnd->toClientList($Page) ?>;
    fpasienedit.lists.kd_pj = <?= $Page->kd_pj->toClientList($Page) ?>;
    fpasienedit.lists.kd_kel = <?= $Page->kd_kel->toClientList($Page) ?>;
    fpasienedit.lists.kd_kec = <?= $Page->kd_kec->toClientList($Page) ?>;
    fpasienedit.lists.kd_kab = <?= $Page->kd_kab->toClientList($Page) ?>;
    fpasienedit.lists.suku_bangsa = <?= $Page->suku_bangsa->toClientList($Page) ?>;
    fpasienedit.lists.bahasa_pasien = <?= $Page->bahasa_pasien->toClientList($Page) ?>;
    fpasienedit.lists.cacat_fisik = <?= $Page->cacat_fisik->toClientList($Page) ?>;
    loadjs.done("fpasienedit");
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
<form name="fpasienedit" id="fpasienedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
    <div id="r_nm_pasien" class="form-group row">
        <label id="elh_pasien_nm_pasien" for="x_nm_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_pasien->caption() ?><?= $Page->nm_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_pasien->cellAttributes() ?>>
<span id="el_pasien_nm_pasien">
<input type="<?= $Page->nm_pasien->getInputTextType() ?>" data-table="pasien" data-field="x_nm_pasien" name="x_nm_pasien" id="x_nm_pasien" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nm_pasien->getPlaceHolder()) ?>" value="<?= $Page->nm_pasien->EditValue ?>"<?= $Page->nm_pasien->editAttributes() ?> aria-describedby="x_nm_pasien_help">
<?= $Page->nm_pasien->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_pasien->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_ktp->Visible) { // no_ktp ?>
    <div id="r_no_ktp" class="form-group row">
        <label id="elh_pasien_no_ktp" for="x_no_ktp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_ktp->caption() ?><?= $Page->no_ktp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_ktp->cellAttributes() ?>>
<span id="el_pasien_no_ktp">
<input type="<?= $Page->no_ktp->getInputTextType() ?>" data-table="pasien" data-field="x_no_ktp" name="x_no_ktp" id="x_no_ktp" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->no_ktp->getPlaceHolder()) ?>" value="<?= $Page->no_ktp->EditValue ?>"<?= $Page->no_ktp->editAttributes() ?> aria-describedby="x_no_ktp_help">
<?= $Page->no_ktp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_ktp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
    <div id="r_jk" class="form-group row">
        <label id="elh_pasien_jk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jk->caption() ?><?= $Page->jk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jk->cellAttributes() ?>>
<span id="el_pasien_jk">
<template id="tp_x_jk">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_jk" name="x_jk" id="x_jk"<?= $Page->jk->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_jk" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_jk"
    name="x_jk"
    value="<?= HtmlEncode($Page->jk->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jk"
    data-target="dsl_x_jk"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jk->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_jk"
    data-value-separator="<?= $Page->jk->displayValueSeparatorAttribute() ?>"
    <?= $Page->jk->editAttributes() ?>>
<?= $Page->jk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tmp_lahir->Visible) { // tmp_lahir ?>
    <div id="r_tmp_lahir" class="form-group row">
        <label id="elh_pasien_tmp_lahir" for="x_tmp_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tmp_lahir->caption() ?><?= $Page->tmp_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tmp_lahir->cellAttributes() ?>>
<span id="el_pasien_tmp_lahir">
<input type="<?= $Page->tmp_lahir->getInputTextType() ?>" data-table="pasien" data-field="x_tmp_lahir" name="x_tmp_lahir" id="x_tmp_lahir" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->tmp_lahir->getPlaceHolder()) ?>" value="<?= $Page->tmp_lahir->EditValue ?>"<?= $Page->tmp_lahir->editAttributes() ?> aria-describedby="x_tmp_lahir_help">
<?= $Page->tmp_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tmp_lahir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
    <div id="r_tgl_lahir" class="form-group row">
        <label id="elh_pasien_tgl_lahir" for="x_tgl_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_lahir->caption() ?><?= $Page->tgl_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_lahir->cellAttributes() ?>>
<span id="el_pasien_tgl_lahir">
<input type="<?= $Page->tgl_lahir->getInputTextType() ?>" data-table="pasien" data-field="x_tgl_lahir" data-format="7" name="x_tgl_lahir" id="x_tgl_lahir" placeholder="<?= HtmlEncode($Page->tgl_lahir->getPlaceHolder()) ?>" value="<?= $Page->tgl_lahir->EditValue ?>"<?= $Page->tgl_lahir->editAttributes() ?> aria-describedby="x_tgl_lahir_help">
<?= $Page->tgl_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_lahir->getErrorMessage() ?></div>
<?php if (!$Page->tgl_lahir->ReadOnly && !$Page->tgl_lahir->Disabled && !isset($Page->tgl_lahir->EditAttrs["readonly"]) && !isset($Page->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpasienedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fpasienedit", "x_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
    <div id="r_nm_ibu" class="form-group row">
        <label id="elh_pasien_nm_ibu" for="x_nm_ibu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_ibu->caption() ?><?= $Page->nm_ibu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_ibu->cellAttributes() ?>>
<span id="el_pasien_nm_ibu">
<input type="<?= $Page->nm_ibu->getInputTextType() ?>" data-table="pasien" data-field="x_nm_ibu" name="x_nm_ibu" id="x_nm_ibu" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nm_ibu->getPlaceHolder()) ?>" value="<?= $Page->nm_ibu->EditValue ?>"<?= $Page->nm_ibu->editAttributes() ?> aria-describedby="x_nm_ibu_help">
<?= $Page->nm_ibu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_ibu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <div id="r_alamat" class="form-group row">
        <label id="elh_pasien_alamat" for="x_alamat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat->caption() ?><?= $Page->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alamat->cellAttributes() ?>>
<span id="el_pasien_alamat">
<input type="<?= $Page->alamat->getInputTextType() ?>" data-table="pasien" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>" value="<?= $Page->alamat->EditValue ?>"<?= $Page->alamat->editAttributes() ?> aria-describedby="x_alamat_help">
<?= $Page->alamat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gol_darah->Visible) { // gol_darah ?>
    <div id="r_gol_darah" class="form-group row">
        <label id="elh_pasien_gol_darah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gol_darah->caption() ?><?= $Page->gol_darah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gol_darah->cellAttributes() ?>>
<span id="el_pasien_gol_darah">
<template id="tp_x_gol_darah">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_gol_darah" name="x_gol_darah" id="x_gol_darah"<?= $Page->gol_darah->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_gol_darah" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_gol_darah"
    name="x_gol_darah"
    value="<?= HtmlEncode($Page->gol_darah->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_gol_darah"
    data-target="dsl_x_gol_darah"
    data-repeatcolumn="5"
    class="form-control<?= $Page->gol_darah->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_gol_darah"
    data-value-separator="<?= $Page->gol_darah->displayValueSeparatorAttribute() ?>"
    <?= $Page->gol_darah->editAttributes() ?>>
<?= $Page->gol_darah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gol_darah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <div id="r_pekerjaan" class="form-group row">
        <label id="elh_pasien_pekerjaan" for="x_pekerjaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pekerjaan->caption() ?><?= $Page->pekerjaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el_pasien_pekerjaan">
<input type="<?= $Page->pekerjaan->getInputTextType() ?>" data-table="pasien" data-field="x_pekerjaan" name="x_pekerjaan" id="x_pekerjaan" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->pekerjaan->getPlaceHolder()) ?>" value="<?= $Page->pekerjaan->EditValue ?>"<?= $Page->pekerjaan->editAttributes() ?> aria-describedby="x_pekerjaan_help">
<?= $Page->pekerjaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pekerjaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stts_nikah->Visible) { // stts_nikah ?>
    <div id="r_stts_nikah" class="form-group row">
        <label id="elh_pasien_stts_nikah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stts_nikah->caption() ?><?= $Page->stts_nikah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->stts_nikah->cellAttributes() ?>>
<span id="el_pasien_stts_nikah">
<template id="tp_x_stts_nikah">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_stts_nikah" name="x_stts_nikah" id="x_stts_nikah"<?= $Page->stts_nikah->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_stts_nikah" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_stts_nikah"
    name="x_stts_nikah"
    value="<?= HtmlEncode($Page->stts_nikah->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_stts_nikah"
    data-target="dsl_x_stts_nikah"
    data-repeatcolumn="5"
    class="form-control<?= $Page->stts_nikah->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_stts_nikah"
    data-value-separator="<?= $Page->stts_nikah->displayValueSeparatorAttribute() ?>"
    <?= $Page->stts_nikah->editAttributes() ?>>
<?= $Page->stts_nikah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->stts_nikah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <div id="r_agama" class="form-group row">
        <label id="elh_pasien_agama" for="x_agama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->agama->caption() ?><?= $Page->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->agama->cellAttributes() ?>>
<span id="el_pasien_agama">
    <select
        id="x_agama"
        name="x_agama"
        class="form-control ew-select<?= $Page->agama->isInvalidClass() ?>"
        data-select2-id="pasien_x_agama"
        data-table="pasien"
        data-field="x_agama"
        data-value-separator="<?= $Page->agama->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->agama->getPlaceHolder()) ?>"
        <?= $Page->agama->editAttributes() ?>>
        <?= $Page->agama->selectOptionListHtml("x_agama") ?>
    </select>
    <?= $Page->agama->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->agama->getErrorMessage() ?></div>
<?= $Page->agama->Lookup->getParamTag($Page, "p_x_agama") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_agama']"),
        options = { name: "x_agama", selectId: "pasien_x_agama", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.agama.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pnd->Visible) { // pnd ?>
    <div id="r_pnd" class="form-group row">
        <label id="elh_pasien_pnd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pnd->caption() ?><?= $Page->pnd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pnd->cellAttributes() ?>>
<span id="el_pasien_pnd">
<template id="tp_x_pnd">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_pnd" name="x_pnd" id="x_pnd"<?= $Page->pnd->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_pnd" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_pnd"
    name="x_pnd"
    value="<?= HtmlEncode($Page->pnd->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_pnd"
    data-target="dsl_x_pnd"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pnd->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_pnd"
    data-value-separator="<?= $Page->pnd->displayValueSeparatorAttribute() ?>"
    <?= $Page->pnd->editAttributes() ?>>
<?= $Page->pnd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pnd->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_pj->Visible) { // kd_pj ?>
    <div id="r_kd_pj" class="form-group row">
        <label id="elh_pasien_kd_pj" for="x_kd_pj" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_pj->caption() ?><?= $Page->kd_pj->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_pj->cellAttributes() ?>>
<span id="el_pasien_kd_pj">
    <select
        id="x_kd_pj"
        name="x_kd_pj"
        class="form-control ew-select<?= $Page->kd_pj->isInvalidClass() ?>"
        data-select2-id="pasien_x_kd_pj"
        data-table="pasien"
        data-field="x_kd_pj"
        data-value-separator="<?= $Page->kd_pj->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_pj->getPlaceHolder()) ?>"
        <?= $Page->kd_pj->editAttributes() ?>>
        <?= $Page->kd_pj->selectOptionListHtml("x_kd_pj") ?>
    </select>
    <?= $Page->kd_pj->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_pj->getErrorMessage() ?></div>
<?= $Page->kd_pj->Lookup->getParamTag($Page, "p_x_kd_pj") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_kd_pj']"),
        options = { name: "x_kd_pj", selectId: "pasien_x_kd_pj", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.kd_pj.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_peserta->Visible) { // no_peserta ?>
    <div id="r_no_peserta" class="form-group row">
        <label id="elh_pasien_no_peserta" for="x_no_peserta" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_peserta->caption() ?><?= $Page->no_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_peserta->cellAttributes() ?>>
<span id="el_pasien_no_peserta">
<input type="<?= $Page->no_peserta->getInputTextType() ?>" data-table="pasien" data-field="x_no_peserta" name="x_no_peserta" id="x_no_peserta" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->no_peserta->getPlaceHolder()) ?>" value="<?= $Page->no_peserta->EditValue ?>"<?= $Page->no_peserta->editAttributes() ?> aria-describedby="x_no_peserta_help">
<?= $Page->no_peserta->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_peserta->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kel->Visible) { // kd_kel ?>
    <div id="r_kd_kel" class="form-group row">
        <label id="elh_pasien_kd_kel" for="x_kd_kel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kel->caption() ?><?= $Page->kd_kel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kel->cellAttributes() ?>>
<span id="el_pasien_kd_kel">
    <select
        id="x_kd_kel"
        name="x_kd_kel"
        class="form-control ew-select<?= $Page->kd_kel->isInvalidClass() ?>"
        data-select2-id="pasien_x_kd_kel"
        data-table="pasien"
        data-field="x_kd_kel"
        data-value-separator="<?= $Page->kd_kel->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_kel->getPlaceHolder()) ?>"
        <?= $Page->kd_kel->editAttributes() ?>>
        <?= $Page->kd_kel->selectOptionListHtml("x_kd_kel") ?>
    </select>
    <?= $Page->kd_kel->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_kel->getErrorMessage() ?></div>
<?= $Page->kd_kel->Lookup->getParamTag($Page, "p_x_kd_kel") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_kd_kel']"),
        options = { name: "x_kd_kel", selectId: "pasien_x_kd_kel", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.kd_kel.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kec->Visible) { // kd_kec ?>
    <div id="r_kd_kec" class="form-group row">
        <label id="elh_pasien_kd_kec" for="x_kd_kec" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kec->caption() ?><?= $Page->kd_kec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kec->cellAttributes() ?>>
<span id="el_pasien_kd_kec">
    <select
        id="x_kd_kec"
        name="x_kd_kec"
        class="form-control ew-select<?= $Page->kd_kec->isInvalidClass() ?>"
        data-select2-id="pasien_x_kd_kec"
        data-table="pasien"
        data-field="x_kd_kec"
        data-value-separator="<?= $Page->kd_kec->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_kec->getPlaceHolder()) ?>"
        <?= $Page->kd_kec->editAttributes() ?>>
        <?= $Page->kd_kec->selectOptionListHtml("x_kd_kec") ?>
    </select>
    <?= $Page->kd_kec->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_kec->getErrorMessage() ?></div>
<?= $Page->kd_kec->Lookup->getParamTag($Page, "p_x_kd_kec") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_kd_kec']"),
        options = { name: "x_kd_kec", selectId: "pasien_x_kd_kec", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.kd_kec.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kab->Visible) { // kd_kab ?>
    <div id="r_kd_kab" class="form-group row">
        <label id="elh_pasien_kd_kab" for="x_kd_kab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kab->caption() ?><?= $Page->kd_kab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kab->cellAttributes() ?>>
<span id="el_pasien_kd_kab">
    <select
        id="x_kd_kab"
        name="x_kd_kab"
        class="form-control ew-select<?= $Page->kd_kab->isInvalidClass() ?>"
        data-select2-id="pasien_x_kd_kab"
        data-table="pasien"
        data-field="x_kd_kab"
        data-value-separator="<?= $Page->kd_kab->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_kab->getPlaceHolder()) ?>"
        <?= $Page->kd_kab->editAttributes() ?>>
        <?= $Page->kd_kab->selectOptionListHtml("x_kd_kab") ?>
    </select>
    <?= $Page->kd_kab->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_kab->getErrorMessage() ?></div>
<?= $Page->kd_kab->Lookup->getParamTag($Page, "p_x_kd_kab") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_kd_kab']"),
        options = { name: "x_kd_kab", selectId: "pasien_x_kd_kab", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.kd_kab.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_prop->Visible) { // kd_prop ?>
    <div id="r_kd_prop" class="form-group row">
        <label id="elh_pasien_kd_prop" for="x_kd_prop" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_prop->caption() ?><?= $Page->kd_prop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_prop->cellAttributes() ?>>
<span id="el_pasien_kd_prop">
<span<?= $Page->kd_prop->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_prop->getDisplayValue($Page->kd_prop->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="pasien" data-field="x_kd_prop" data-hidden="1" name="x_kd_prop" id="x_kd_prop" value="<?= HtmlEncode($Page->kd_prop->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suku_bangsa->Visible) { // suku_bangsa ?>
    <div id="r_suku_bangsa" class="form-group row">
        <label id="elh_pasien_suku_bangsa" for="x_suku_bangsa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suku_bangsa->caption() ?><?= $Page->suku_bangsa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suku_bangsa->cellAttributes() ?>>
<span id="el_pasien_suku_bangsa">
    <select
        id="x_suku_bangsa"
        name="x_suku_bangsa"
        class="form-control ew-select<?= $Page->suku_bangsa->isInvalidClass() ?>"
        data-select2-id="pasien_x_suku_bangsa"
        data-table="pasien"
        data-field="x_suku_bangsa"
        data-value-separator="<?= $Page->suku_bangsa->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->suku_bangsa->getPlaceHolder()) ?>"
        <?= $Page->suku_bangsa->editAttributes() ?>>
        <?= $Page->suku_bangsa->selectOptionListHtml("x_suku_bangsa") ?>
    </select>
    <?= $Page->suku_bangsa->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->suku_bangsa->getErrorMessage() ?></div>
<?= $Page->suku_bangsa->Lookup->getParamTag($Page, "p_x_suku_bangsa") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_suku_bangsa']"),
        options = { name: "x_suku_bangsa", selectId: "pasien_x_suku_bangsa", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.suku_bangsa.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bahasa_pasien->Visible) { // bahasa_pasien ?>
    <div id="r_bahasa_pasien" class="form-group row">
        <label id="elh_pasien_bahasa_pasien" for="x_bahasa_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bahasa_pasien->caption() ?><?= $Page->bahasa_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bahasa_pasien->cellAttributes() ?>>
<span id="el_pasien_bahasa_pasien">
    <select
        id="x_bahasa_pasien"
        name="x_bahasa_pasien"
        class="form-control ew-select<?= $Page->bahasa_pasien->isInvalidClass() ?>"
        data-select2-id="pasien_x_bahasa_pasien"
        data-table="pasien"
        data-field="x_bahasa_pasien"
        data-value-separator="<?= $Page->bahasa_pasien->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->bahasa_pasien->getPlaceHolder()) ?>"
        <?= $Page->bahasa_pasien->editAttributes() ?>>
        <?= $Page->bahasa_pasien->selectOptionListHtml("x_bahasa_pasien") ?>
    </select>
    <?= $Page->bahasa_pasien->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->bahasa_pasien->getErrorMessage() ?></div>
<?= $Page->bahasa_pasien->Lookup->getParamTag($Page, "p_x_bahasa_pasien") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_bahasa_pasien']"),
        options = { name: "x_bahasa_pasien", selectId: "pasien_x_bahasa_pasien", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.bahasa_pasien.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cacat_fisik->Visible) { // cacat_fisik ?>
    <div id="r_cacat_fisik" class="form-group row">
        <label id="elh_pasien_cacat_fisik" for="x_cacat_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cacat_fisik->caption() ?><?= $Page->cacat_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->cacat_fisik->cellAttributes() ?>>
<span id="el_pasien_cacat_fisik">
    <select
        id="x_cacat_fisik"
        name="x_cacat_fisik"
        class="form-control ew-select<?= $Page->cacat_fisik->isInvalidClass() ?>"
        data-select2-id="pasien_x_cacat_fisik"
        data-table="pasien"
        data-field="x_cacat_fisik"
        data-value-separator="<?= $Page->cacat_fisik->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->cacat_fisik->getPlaceHolder()) ?>"
        <?= $Page->cacat_fisik->editAttributes() ?>>
        <?= $Page->cacat_fisik->selectOptionListHtml("x_cacat_fisik") ?>
    </select>
    <?= $Page->cacat_fisik->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->cacat_fisik->getErrorMessage() ?></div>
<?= $Page->cacat_fisik->Lookup->getParamTag($Page, "p_x_cacat_fisik") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pasien_x_cacat_fisik']"),
        options = { name: "x_cacat_fisik", selectId: "pasien_x_cacat_fisik", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pasien.fields.cacat_fisik.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="pasien" data-field="x_id_pasien" data-hidden="1" name="x_id_pasien" id="x_id_pasien" value="<?= HtmlEncode($Page->id_pasien->CurrentValue) ?>">
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
    ew.addEventHandlers("pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
