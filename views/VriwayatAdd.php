<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$VriwayatAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fvriwayatadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fvriwayatadd = currentForm = new ew.Form("fvriwayatadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "vriwayat")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.vriwayat)
        ew.vars.tables.vriwayat = currentTable;
    fvriwayatadd.addFields([
        ["nm_pasien", [fields.nm_pasien.visible && fields.nm_pasien.required ? ew.Validators.required(fields.nm_pasien.caption) : null], fields.nm_pasien.isInvalid],
        ["jk", [fields.jk.visible && fields.jk.required ? ew.Validators.required(fields.jk.caption) : null], fields.jk.isInvalid],
        ["nm_ibu", [fields.nm_ibu.visible && fields.nm_ibu.required ? ew.Validators.required(fields.nm_ibu.caption) : null], fields.nm_ibu.isInvalid],
        ["alamat", [fields.alamat.visible && fields.alamat.required ? ew.Validators.required(fields.alamat.caption) : null], fields.alamat.isInvalid],
        ["tgl_daftar", [fields.tgl_daftar.visible && fields.tgl_daftar.required ? ew.Validators.required(fields.tgl_daftar.caption) : null], fields.tgl_daftar.isInvalid],
        ["kd_pj", [fields.kd_pj.visible && fields.kd_pj.required ? ew.Validators.required(fields.kd_pj.caption) : null], fields.kd_pj.isInvalid],
        ["kd_kel", [fields.kd_kel.visible && fields.kd_kel.required ? ew.Validators.required(fields.kd_kel.caption) : null], fields.kd_kel.isInvalid],
        ["kd_kec", [fields.kd_kec.visible && fields.kd_kec.required ? ew.Validators.required(fields.kd_kec.caption) : null], fields.kd_kec.isInvalid],
        ["kd_kab", [fields.kd_kab.visible && fields.kd_kab.required ? ew.Validators.required(fields.kd_kab.caption) : null], fields.kd_kab.isInvalid],
        ["perusahaan_pasien", [fields.perusahaan_pasien.visible && fields.perusahaan_pasien.required ? ew.Validators.required(fields.perusahaan_pasien.caption) : null], fields.perusahaan_pasien.isInvalid],
        ["suku_bangsa", [fields.suku_bangsa.visible && fields.suku_bangsa.required ? ew.Validators.required(fields.suku_bangsa.caption) : null], fields.suku_bangsa.isInvalid],
        ["bahasa_pasien", [fields.bahasa_pasien.visible && fields.bahasa_pasien.required ? ew.Validators.required(fields.bahasa_pasien.caption) : null], fields.bahasa_pasien.isInvalid],
        ["cacat_fisik", [fields.cacat_fisik.visible && fields.cacat_fisik.required ? ew.Validators.required(fields.cacat_fisik.caption) : null], fields.cacat_fisik.isInvalid],
        ["kd_prop", [fields.kd_prop.visible && fields.kd_prop.required ? ew.Validators.required(fields.kd_prop.caption) : null], fields.kd_prop.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fvriwayatadd,
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
    fvriwayatadd.validate = function () {
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
    fvriwayatadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvriwayatadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fvriwayatadd.lists.jk = <?= $Page->jk->toClientList($Page) ?>;
    fvriwayatadd.lists.kd_pj = <?= $Page->kd_pj->toClientList($Page) ?>;
    fvriwayatadd.lists.kd_kel = <?= $Page->kd_kel->toClientList($Page) ?>;
    fvriwayatadd.lists.kd_kec = <?= $Page->kd_kec->toClientList($Page) ?>;
    fvriwayatadd.lists.kd_kab = <?= $Page->kd_kab->toClientList($Page) ?>;
    fvriwayatadd.lists.perusahaan_pasien = <?= $Page->perusahaan_pasien->toClientList($Page) ?>;
    fvriwayatadd.lists.suku_bangsa = <?= $Page->suku_bangsa->toClientList($Page) ?>;
    fvriwayatadd.lists.bahasa_pasien = <?= $Page->bahasa_pasien->toClientList($Page) ?>;
    fvriwayatadd.lists.cacat_fisik = <?= $Page->cacat_fisik->toClientList($Page) ?>;
    fvriwayatadd.lists.kd_prop = <?= $Page->kd_prop->toClientList($Page) ?>;
    loadjs.done("fvriwayatadd");
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
<form name="fvriwayatadd" id="fvriwayatadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vriwayat">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
    <div id="r_nm_pasien" class="form-group row">
        <label id="elh_vriwayat_nm_pasien" for="x_nm_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_pasien->caption() ?><?= $Page->nm_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_pasien->cellAttributes() ?>>
<span id="el_vriwayat_nm_pasien">
<input type="<?= $Page->nm_pasien->getInputTextType() ?>" data-table="vriwayat" data-field="x_nm_pasien" name="x_nm_pasien" id="x_nm_pasien" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nm_pasien->getPlaceHolder()) ?>" value="<?= $Page->nm_pasien->EditValue ?>"<?= $Page->nm_pasien->editAttributes() ?> aria-describedby="x_nm_pasien_help">
<?= $Page->nm_pasien->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_pasien->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
    <div id="r_jk" class="form-group row">
        <label id="elh_vriwayat_jk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jk->caption() ?><?= $Page->jk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jk->cellAttributes() ?>>
<span id="el_vriwayat_jk">
<template id="tp_x_jk">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="vriwayat" data-field="x_jk" name="x_jk" id="x_jk"<?= $Page->jk->editAttributes() ?>>
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
    data-table="vriwayat"
    data-field="x_jk"
    data-value-separator="<?= $Page->jk->displayValueSeparatorAttribute() ?>"
    <?= $Page->jk->editAttributes() ?>>
<?= $Page->jk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
    <div id="r_nm_ibu" class="form-group row">
        <label id="elh_vriwayat_nm_ibu" for="x_nm_ibu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_ibu->caption() ?><?= $Page->nm_ibu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_ibu->cellAttributes() ?>>
<span id="el_vriwayat_nm_ibu">
<input type="<?= $Page->nm_ibu->getInputTextType() ?>" data-table="vriwayat" data-field="x_nm_ibu" name="x_nm_ibu" id="x_nm_ibu" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nm_ibu->getPlaceHolder()) ?>" value="<?= $Page->nm_ibu->EditValue ?>"<?= $Page->nm_ibu->editAttributes() ?> aria-describedby="x_nm_ibu_help">
<?= $Page->nm_ibu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_ibu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <div id="r_alamat" class="form-group row">
        <label id="elh_vriwayat_alamat" for="x_alamat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat->caption() ?><?= $Page->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alamat->cellAttributes() ?>>
<span id="el_vriwayat_alamat">
<input type="<?= $Page->alamat->getInputTextType() ?>" data-table="vriwayat" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>" value="<?= $Page->alamat->EditValue ?>"<?= $Page->alamat->editAttributes() ?> aria-describedby="x_alamat_help">
<?= $Page->alamat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_pj->Visible) { // kd_pj ?>
    <div id="r_kd_pj" class="form-group row">
        <label id="elh_vriwayat_kd_pj" for="x_kd_pj" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_pj->caption() ?><?= $Page->kd_pj->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_pj->cellAttributes() ?>>
<span id="el_vriwayat_kd_pj">
    <select
        id="x_kd_pj"
        name="x_kd_pj"
        class="form-control ew-select<?= $Page->kd_pj->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_kd_pj"
        data-table="vriwayat"
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
    var el = document.querySelector("select[data-select2-id='vriwayat_x_kd_pj']"),
        options = { name: "x_kd_pj", selectId: "vriwayat_x_kd_pj", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.kd_pj.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kel->Visible) { // kd_kel ?>
    <div id="r_kd_kel" class="form-group row">
        <label id="elh_vriwayat_kd_kel" for="x_kd_kel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kel->caption() ?><?= $Page->kd_kel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kel->cellAttributes() ?>>
<span id="el_vriwayat_kd_kel">
    <select
        id="x_kd_kel"
        name="x_kd_kel"
        class="form-control ew-select<?= $Page->kd_kel->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_kd_kel"
        data-table="vriwayat"
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
    var el = document.querySelector("select[data-select2-id='vriwayat_x_kd_kel']"),
        options = { name: "x_kd_kel", selectId: "vriwayat_x_kd_kel", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.kd_kel.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kec->Visible) { // kd_kec ?>
    <div id="r_kd_kec" class="form-group row">
        <label id="elh_vriwayat_kd_kec" for="x_kd_kec" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kec->caption() ?><?= $Page->kd_kec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kec->cellAttributes() ?>>
<span id="el_vriwayat_kd_kec">
    <select
        id="x_kd_kec"
        name="x_kd_kec"
        class="form-control ew-select<?= $Page->kd_kec->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_kd_kec"
        data-table="vriwayat"
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
    var el = document.querySelector("select[data-select2-id='vriwayat_x_kd_kec']"),
        options = { name: "x_kd_kec", selectId: "vriwayat_x_kd_kec", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.kd_kec.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kab->Visible) { // kd_kab ?>
    <div id="r_kd_kab" class="form-group row">
        <label id="elh_vriwayat_kd_kab" for="x_kd_kab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kab->caption() ?><?= $Page->kd_kab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kab->cellAttributes() ?>>
<span id="el_vriwayat_kd_kab">
    <select
        id="x_kd_kab"
        name="x_kd_kab"
        class="form-control ew-select<?= $Page->kd_kab->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_kd_kab"
        data-table="vriwayat"
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
    var el = document.querySelector("select[data-select2-id='vriwayat_x_kd_kab']"),
        options = { name: "x_kd_kab", selectId: "vriwayat_x_kd_kab", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.kd_kab.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->perusahaan_pasien->Visible) { // perusahaan_pasien ?>
    <div id="r_perusahaan_pasien" class="form-group row">
        <label id="elh_vriwayat_perusahaan_pasien" for="x_perusahaan_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->perusahaan_pasien->caption() ?><?= $Page->perusahaan_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->perusahaan_pasien->cellAttributes() ?>>
<span id="el_vriwayat_perusahaan_pasien">
    <select
        id="x_perusahaan_pasien"
        name="x_perusahaan_pasien"
        class="form-control ew-select<?= $Page->perusahaan_pasien->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_perusahaan_pasien"
        data-table="vriwayat"
        data-field="x_perusahaan_pasien"
        data-value-separator="<?= $Page->perusahaan_pasien->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->perusahaan_pasien->getPlaceHolder()) ?>"
        <?= $Page->perusahaan_pasien->editAttributes() ?>>
        <?= $Page->perusahaan_pasien->selectOptionListHtml("x_perusahaan_pasien") ?>
    </select>
    <?= $Page->perusahaan_pasien->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->perusahaan_pasien->getErrorMessage() ?></div>
<?= $Page->perusahaan_pasien->Lookup->getParamTag($Page, "p_x_perusahaan_pasien") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vriwayat_x_perusahaan_pasien']"),
        options = { name: "x_perusahaan_pasien", selectId: "vriwayat_x_perusahaan_pasien", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.perusahaan_pasien.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suku_bangsa->Visible) { // suku_bangsa ?>
    <div id="r_suku_bangsa" class="form-group row">
        <label id="elh_vriwayat_suku_bangsa" for="x_suku_bangsa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suku_bangsa->caption() ?><?= $Page->suku_bangsa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suku_bangsa->cellAttributes() ?>>
<span id="el_vriwayat_suku_bangsa">
    <select
        id="x_suku_bangsa"
        name="x_suku_bangsa"
        class="form-control ew-select<?= $Page->suku_bangsa->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_suku_bangsa"
        data-table="vriwayat"
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
    var el = document.querySelector("select[data-select2-id='vriwayat_x_suku_bangsa']"),
        options = { name: "x_suku_bangsa", selectId: "vriwayat_x_suku_bangsa", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.suku_bangsa.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bahasa_pasien->Visible) { // bahasa_pasien ?>
    <div id="r_bahasa_pasien" class="form-group row">
        <label id="elh_vriwayat_bahasa_pasien" for="x_bahasa_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bahasa_pasien->caption() ?><?= $Page->bahasa_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bahasa_pasien->cellAttributes() ?>>
<span id="el_vriwayat_bahasa_pasien">
    <select
        id="x_bahasa_pasien"
        name="x_bahasa_pasien"
        class="form-control ew-select<?= $Page->bahasa_pasien->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_bahasa_pasien"
        data-table="vriwayat"
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
    var el = document.querySelector("select[data-select2-id='vriwayat_x_bahasa_pasien']"),
        options = { name: "x_bahasa_pasien", selectId: "vriwayat_x_bahasa_pasien", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.bahasa_pasien.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cacat_fisik->Visible) { // cacat_fisik ?>
    <div id="r_cacat_fisik" class="form-group row">
        <label id="elh_vriwayat_cacat_fisik" for="x_cacat_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cacat_fisik->caption() ?><?= $Page->cacat_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->cacat_fisik->cellAttributes() ?>>
<span id="el_vriwayat_cacat_fisik">
    <select
        id="x_cacat_fisik"
        name="x_cacat_fisik"
        class="form-control ew-select<?= $Page->cacat_fisik->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_cacat_fisik"
        data-table="vriwayat"
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
    var el = document.querySelector("select[data-select2-id='vriwayat_x_cacat_fisik']"),
        options = { name: "x_cacat_fisik", selectId: "vriwayat_x_cacat_fisik", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.cacat_fisik.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_prop->Visible) { // kd_prop ?>
    <div id="r_kd_prop" class="form-group row">
        <label id="elh_vriwayat_kd_prop" for="x_kd_prop" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_prop->caption() ?><?= $Page->kd_prop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_prop->cellAttributes() ?>>
<span id="el_vriwayat_kd_prop">
    <select
        id="x_kd_prop"
        name="x_kd_prop"
        class="form-control ew-select<?= $Page->kd_prop->isInvalidClass() ?>"
        data-select2-id="vriwayat_x_kd_prop"
        data-table="vriwayat"
        data-field="x_kd_prop"
        data-value-separator="<?= $Page->kd_prop->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_prop->getPlaceHolder()) ?>"
        <?= $Page->kd_prop->editAttributes() ?>>
        <?= $Page->kd_prop->selectOptionListHtml("x_kd_prop") ?>
    </select>
    <?= $Page->kd_prop->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_prop->getErrorMessage() ?></div>
<?= $Page->kd_prop->Lookup->getParamTag($Page, "p_x_kd_prop") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vriwayat_x_kd_prop']"),
        options = { name: "x_kd_prop", selectId: "vriwayat_x_kd_prop", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vriwayat.fields.kd_prop.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("vriwayat");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
