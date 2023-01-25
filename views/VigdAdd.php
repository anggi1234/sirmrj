<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$VigdAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fvigdadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fvigdadd = currentForm = new ew.Form("fvigdadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "vigd")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.vigd)
        ew.vars.tables.vigd = currentTable;
    fvigdadd.addFields([
        ["tgl_registrasi", [fields.tgl_registrasi.visible && fields.tgl_registrasi.required ? ew.Validators.required(fields.tgl_registrasi.caption) : null], fields.tgl_registrasi.isInvalid],
        ["jam_reg", [fields.jam_reg.visible && fields.jam_reg.required ? ew.Validators.required(fields.jam_reg.caption) : null], fields.jam_reg.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["kd_poli", [fields.kd_poli.visible && fields.kd_poli.required ? ew.Validators.required(fields.kd_poli.caption) : null], fields.kd_poli.isInvalid],
        ["p_jawab", [fields.p_jawab.visible && fields.p_jawab.required ? ew.Validators.required(fields.p_jawab.caption) : null], fields.p_jawab.isInvalid],
        ["hubunganpj", [fields.hubunganpj.visible && fields.hubunganpj.required ? ew.Validators.required(fields.hubunganpj.caption) : null], fields.hubunganpj.isInvalid],
        ["stts", [fields.stts.visible && fields.stts.required ? ew.Validators.required(fields.stts.caption) : null], fields.stts.isInvalid],
        ["stts_daftar", [fields.stts_daftar.visible && fields.stts_daftar.required ? ew.Validators.required(fields.stts_daftar.caption) : null], fields.stts_daftar.isInvalid],
        ["status_lanjut", [fields.status_lanjut.visible && fields.status_lanjut.required ? ew.Validators.required(fields.status_lanjut.caption) : null], fields.status_lanjut.isInvalid],
        ["umurdaftar", [fields.umurdaftar.visible && fields.umurdaftar.required ? ew.Validators.required(fields.umurdaftar.caption) : null, ew.Validators.integer], fields.umurdaftar.isInvalid],
        ["sttsumur", [fields.sttsumur.visible && fields.sttsumur.required ? ew.Validators.required(fields.sttsumur.caption) : null], fields.sttsumur.isInvalid],
        ["cetak", [fields.cetak.visible && fields.cetak.required ? ew.Validators.required(fields.cetak.caption) : null], fields.cetak.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fvigdadd,
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
    fvigdadd.validate = function () {
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
    fvigdadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvigdadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fvigdadd.lists.kd_dokter = <?= $Page->kd_dokter->toClientList($Page) ?>;
    fvigdadd.lists.no_rkm_medis = <?= $Page->no_rkm_medis->toClientList($Page) ?>;
    fvigdadd.lists.kd_poli = <?= $Page->kd_poli->toClientList($Page) ?>;
    fvigdadd.lists.stts = <?= $Page->stts->toClientList($Page) ?>;
    fvigdadd.lists.stts_daftar = <?= $Page->stts_daftar->toClientList($Page) ?>;
    fvigdadd.lists.status_lanjut = <?= $Page->status_lanjut->toClientList($Page) ?>;
    fvigdadd.lists.sttsumur = <?= $Page->sttsumur->toClientList($Page) ?>;
    loadjs.done("fvigdadd");
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
<form name="fvigdadd" id="fvigdadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vigd">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <div id="r_kd_dokter" class="form-group row">
        <label id="elh_vigd_kd_dokter" for="x_kd_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dokter->caption() ?><?= $Page->kd_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_vigd_kd_dokter">
    <select
        id="x_kd_dokter"
        name="x_kd_dokter"
        class="form-control ew-select<?= $Page->kd_dokter->isInvalidClass() ?>"
        data-select2-id="vigd_x_kd_dokter"
        data-table="vigd"
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
    var el = document.querySelector("select[data-select2-id='vigd_x_kd_dokter']"),
        options = { name: "x_kd_dokter", selectId: "vigd_x_kd_dokter", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.vigd.fields.kd_dokter.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vigd.fields.kd_dokter.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <div id="r_no_rkm_medis" class="form-group row">
        <label id="elh_vigd_no_rkm_medis" for="x_no_rkm_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rkm_medis->caption() ?><?= $Page->no_rkm_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_vigd_no_rkm_medis">
<div class="input-group ew-lookup-list" aria-describedby="x_no_rkm_medis_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_no_rkm_medis"><?= EmptyValue(strval($Page->no_rkm_medis->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->no_rkm_medis->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->no_rkm_medis->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->no_rkm_medis->ReadOnly || $Page->no_rkm_medis->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_no_rkm_medis',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->no_rkm_medis->getErrorMessage() ?></div>
<?= $Page->no_rkm_medis->getCustomMessage() ?>
<?= $Page->no_rkm_medis->Lookup->getParamTag($Page, "p_x_no_rkm_medis") ?>
<input type="hidden" is="selection-list" data-table="vigd" data-field="x_no_rkm_medis" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->no_rkm_medis->displayValueSeparatorAttribute() ?>" name="x_no_rkm_medis" id="x_no_rkm_medis" value="<?= $Page->no_rkm_medis->CurrentValue ?>"<?= $Page->no_rkm_medis->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <div id="r_kd_poli" class="form-group row">
        <label id="elh_vigd_kd_poli" for="x_kd_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_poli->caption() ?><?= $Page->kd_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_vigd_kd_poli">
    <select
        id="x_kd_poli"
        name="x_kd_poli"
        class="form-control ew-select<?= $Page->kd_poli->isInvalidClass() ?>"
        data-select2-id="vigd_x_kd_poli"
        data-table="vigd"
        data-field="x_kd_poli"
        data-value-separator="<?= $Page->kd_poli->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_poli->getPlaceHolder()) ?>"
        <?= $Page->kd_poli->editAttributes() ?>>
        <?= $Page->kd_poli->selectOptionListHtml("x_kd_poli") ?>
    </select>
    <?= $Page->kd_poli->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_poli->getErrorMessage() ?></div>
<?= $Page->kd_poli->Lookup->getParamTag($Page, "p_x_kd_poli") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vigd_x_kd_poli']"),
        options = { name: "x_kd_poli", selectId: "vigd_x_kd_poli", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vigd.fields.kd_poli.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->p_jawab->Visible) { // p_jawab ?>
    <div id="r_p_jawab" class="form-group row">
        <label id="elh_vigd_p_jawab" for="x_p_jawab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->p_jawab->caption() ?><?= $Page->p_jawab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->p_jawab->cellAttributes() ?>>
<span id="el_vigd_p_jawab">
<input type="<?= $Page->p_jawab->getInputTextType() ?>" data-table="vigd" data-field="x_p_jawab" name="x_p_jawab" id="x_p_jawab" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->p_jawab->getPlaceHolder()) ?>" value="<?= $Page->p_jawab->EditValue ?>"<?= $Page->p_jawab->editAttributes() ?> aria-describedby="x_p_jawab_help">
<?= $Page->p_jawab->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->p_jawab->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hubunganpj->Visible) { // hubunganpj ?>
    <div id="r_hubunganpj" class="form-group row">
        <label id="elh_vigd_hubunganpj" for="x_hubunganpj" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hubunganpj->caption() ?><?= $Page->hubunganpj->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hubunganpj->cellAttributes() ?>>
<span id="el_vigd_hubunganpj">
<input type="<?= $Page->hubunganpj->getInputTextType() ?>" data-table="vigd" data-field="x_hubunganpj" name="x_hubunganpj" id="x_hubunganpj" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->hubunganpj->getPlaceHolder()) ?>" value="<?= $Page->hubunganpj->EditValue ?>"<?= $Page->hubunganpj->editAttributes() ?> aria-describedby="x_hubunganpj_help">
<?= $Page->hubunganpj->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hubunganpj->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stts->Visible) { // stts ?>
    <div id="r_stts" class="form-group row">
        <label id="elh_vigd_stts" for="x_stts" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stts->caption() ?><?= $Page->stts->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->stts->cellAttributes() ?>>
<span id="el_vigd_stts">
    <select
        id="x_stts"
        name="x_stts"
        class="form-control ew-select<?= $Page->stts->isInvalidClass() ?>"
        data-select2-id="vigd_x_stts"
        data-table="vigd"
        data-field="x_stts"
        data-value-separator="<?= $Page->stts->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->stts->getPlaceHolder()) ?>"
        <?= $Page->stts->editAttributes() ?>>
        <?= $Page->stts->selectOptionListHtml("x_stts") ?>
    </select>
    <?= $Page->stts->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->stts->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vigd_x_stts']"),
        options = { name: "x_stts", selectId: "vigd_x_stts", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.vigd.fields.stts.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vigd.fields.stts.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stts_daftar->Visible) { // stts_daftar ?>
    <div id="r_stts_daftar" class="form-group row">
        <label id="elh_vigd_stts_daftar" for="x_stts_daftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stts_daftar->caption() ?><?= $Page->stts_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->stts_daftar->cellAttributes() ?>>
<span id="el_vigd_stts_daftar">
    <select
        id="x_stts_daftar"
        name="x_stts_daftar"
        class="form-control ew-select<?= $Page->stts_daftar->isInvalidClass() ?>"
        data-select2-id="vigd_x_stts_daftar"
        data-table="vigd"
        data-field="x_stts_daftar"
        data-value-separator="<?= $Page->stts_daftar->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->stts_daftar->getPlaceHolder()) ?>"
        <?= $Page->stts_daftar->editAttributes() ?>>
        <?= $Page->stts_daftar->selectOptionListHtml("x_stts_daftar") ?>
    </select>
    <?= $Page->stts_daftar->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->stts_daftar->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vigd_x_stts_daftar']"),
        options = { name: "x_stts_daftar", selectId: "vigd_x_stts_daftar", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.vigd.fields.stts_daftar.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vigd.fields.stts_daftar.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_lanjut->Visible) { // status_lanjut ?>
    <div id="r_status_lanjut" class="form-group row">
        <label id="elh_vigd_status_lanjut" for="x_status_lanjut" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_lanjut->caption() ?><?= $Page->status_lanjut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_lanjut->cellAttributes() ?>>
<span id="el_vigd_status_lanjut">
    <select
        id="x_status_lanjut"
        name="x_status_lanjut"
        class="form-control ew-select<?= $Page->status_lanjut->isInvalidClass() ?>"
        data-select2-id="vigd_x_status_lanjut"
        data-table="vigd"
        data-field="x_status_lanjut"
        data-value-separator="<?= $Page->status_lanjut->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status_lanjut->getPlaceHolder()) ?>"
        <?= $Page->status_lanjut->editAttributes() ?>>
        <?= $Page->status_lanjut->selectOptionListHtml("x_status_lanjut") ?>
    </select>
    <?= $Page->status_lanjut->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status_lanjut->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vigd_x_status_lanjut']"),
        options = { name: "x_status_lanjut", selectId: "vigd_x_status_lanjut", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.vigd.fields.status_lanjut.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vigd.fields.status_lanjut.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->umurdaftar->Visible) { // umurdaftar ?>
    <div id="r_umurdaftar" class="form-group row">
        <label id="elh_vigd_umurdaftar" for="x_umurdaftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->umurdaftar->caption() ?><?= $Page->umurdaftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->umurdaftar->cellAttributes() ?>>
<span id="el_vigd_umurdaftar">
<input type="<?= $Page->umurdaftar->getInputTextType() ?>" data-table="vigd" data-field="x_umurdaftar" name="x_umurdaftar" id="x_umurdaftar" size="30" placeholder="<?= HtmlEncode($Page->umurdaftar->getPlaceHolder()) ?>" value="<?= $Page->umurdaftar->EditValue ?>"<?= $Page->umurdaftar->editAttributes() ?> aria-describedby="x_umurdaftar_help">
<?= $Page->umurdaftar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->umurdaftar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sttsumur->Visible) { // sttsumur ?>
    <div id="r_sttsumur" class="form-group row">
        <label id="elh_vigd_sttsumur" for="x_sttsumur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sttsumur->caption() ?><?= $Page->sttsumur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sttsumur->cellAttributes() ?>>
<span id="el_vigd_sttsumur">
    <select
        id="x_sttsumur"
        name="x_sttsumur"
        class="form-control ew-select<?= $Page->sttsumur->isInvalidClass() ?>"
        data-select2-id="vigd_x_sttsumur"
        data-table="vigd"
        data-field="x_sttsumur"
        data-value-separator="<?= $Page->sttsumur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->sttsumur->getPlaceHolder()) ?>"
        <?= $Page->sttsumur->editAttributes() ?>>
        <?= $Page->sttsumur->selectOptionListHtml("x_sttsumur") ?>
    </select>
    <?= $Page->sttsumur->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->sttsumur->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='vigd_x_sttsumur']"),
        options = { name: "x_sttsumur", selectId: "vigd_x_sttsumur", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.vigd.fields.sttsumur.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.vigd.fields.sttsumur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cetak->Visible) { // cetak ?>
    <div id="r_cetak" class="form-group row">
        <label id="elh_vigd_cetak" for="x_cetak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cetak->caption() ?><?= $Page->cetak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->cetak->cellAttributes() ?>>
<span id="el_vigd_cetak">
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
    if (in_array("penilaian_awal_keperawatan_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan") ?>" href="#tab_penilaian_awal_keperawatan_ralan" data-toggle="tab"><?= $Language->tablePhrase("penilaian_awal_keperawatan_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("catatan_medis", explode(",", $Page->getCurrentDetailTable())) && $catatan_medis->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "catatan_medis") {
            $firstActiveDetailTable = "catatan_medis";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("catatan_medis") ?>" href="#tab_catatan_medis" data-toggle="tab"><?= $Language->tablePhrase("catatan_medis", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_medis_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_medis_ralan->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_medis_ralan") {
            $firstActiveDetailTable = "penilaian_medis_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_medis_ralan") ?>" href="#tab_penilaian_medis_ralan" data-toggle="tab"><?= $Language->tablePhrase("penilaian_medis_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan_psikiatri", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan_psikiatri->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan_psikiatri") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan_psikiatri";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan_psikiatri") ?>" href="#tab_penilaian_awal_keperawatan_ralan_psikiatri" data-toggle="tab"><?= $Language->tablePhrase("penilaian_awal_keperawatan_ralan_psikiatri", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("penilaian_psikologi", explode(",", $Page->getCurrentDetailTable())) && $penilaian_psikologi->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_psikologi") {
            $firstActiveDetailTable = "penilaian_psikologi";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("penilaian_psikologi") ?>" href="#tab_penilaian_psikologi" data-toggle="tab"><?= $Language->tablePhrase("penilaian_psikologi", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("diagnosa_pasien", explode(",", $Page->getCurrentDetailTable())) && $diagnosa_pasien->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "diagnosa_pasien") {
            $firstActiveDetailTable = "diagnosa_pasien";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("diagnosa_pasien") ?>" href="#tab_diagnosa_pasien" data-toggle="tab"><?= $Language->tablePhrase("diagnosa_pasien", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("tindak_lanjut", explode(",", $Page->getCurrentDetailTable())) && $tindak_lanjut->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tindak_lanjut") {
            $firstActiveDetailTable = "tindak_lanjut";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("tindak_lanjut") ?>" href="#tab_tindak_lanjut" data-toggle="tab"><?= $Language->tablePhrase("tindak_lanjut", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("pemeriksaan_ralan", explode(",", $Page->getCurrentDetailTable())) && $pemeriksaan_ralan->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "pemeriksaan_ralan") {
            $firstActiveDetailTable = "pemeriksaan_ralan";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("pemeriksaan_ralan") ?>" href="#tab_pemeriksaan_ralan" data-toggle="tab"><?= $Language->tablePhrase("pemeriksaan_ralan", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("vhistory", explode(",", $Page->getCurrentDetailTable())) && $vhistory->DetailAdd) {
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
    if (in_array("penilaian_awal_keperawatan_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan") ?>" id="tab_penilaian_awal_keperawatan_ralan"><!-- page* -->
<?php include_once "PenilaianAwalKeperawatanRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("catatan_medis", explode(",", $Page->getCurrentDetailTable())) && $catatan_medis->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "catatan_medis") {
            $firstActiveDetailTable = "catatan_medis";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("catatan_medis") ?>" id="tab_catatan_medis"><!-- page* -->
<?php include_once "CatatanMedisGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_medis_ralan", explode(",", $Page->getCurrentDetailTable())) && $penilaian_medis_ralan->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_medis_ralan") {
            $firstActiveDetailTable = "penilaian_medis_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_medis_ralan") ?>" id="tab_penilaian_medis_ralan"><!-- page* -->
<?php include_once "PenilaianMedisRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_awal_keperawatan_ralan_psikiatri", explode(",", $Page->getCurrentDetailTable())) && $penilaian_awal_keperawatan_ralan_psikiatri->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_awal_keperawatan_ralan_psikiatri") {
            $firstActiveDetailTable = "penilaian_awal_keperawatan_ralan_psikiatri";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_awal_keperawatan_ralan_psikiatri") ?>" id="tab_penilaian_awal_keperawatan_ralan_psikiatri"><!-- page* -->
<?php include_once "PenilaianAwalKeperawatanRalanPsikiatriGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("penilaian_psikologi", explode(",", $Page->getCurrentDetailTable())) && $penilaian_psikologi->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "penilaian_psikologi") {
            $firstActiveDetailTable = "penilaian_psikologi";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("penilaian_psikologi") ?>" id="tab_penilaian_psikologi"><!-- page* -->
<?php include_once "PenilaianPsikologiGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("diagnosa_pasien", explode(",", $Page->getCurrentDetailTable())) && $diagnosa_pasien->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "diagnosa_pasien") {
            $firstActiveDetailTable = "diagnosa_pasien";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("diagnosa_pasien") ?>" id="tab_diagnosa_pasien"><!-- page* -->
<?php include_once "DiagnosaPasienGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("tindak_lanjut", explode(",", $Page->getCurrentDetailTable())) && $tindak_lanjut->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tindak_lanjut") {
            $firstActiveDetailTable = "tindak_lanjut";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("tindak_lanjut") ?>" id="tab_tindak_lanjut"><!-- page* -->
<?php include_once "TindakLanjutGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("pemeriksaan_ralan", explode(",", $Page->getCurrentDetailTable())) && $pemeriksaan_ralan->DetailAdd) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "pemeriksaan_ralan") {
            $firstActiveDetailTable = "pemeriksaan_ralan";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("pemeriksaan_ralan") ?>" id="tab_pemeriksaan_ralan"><!-- page* -->
<?php include_once "PemeriksaanRalanGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("vhistory", explode(",", $Page->getCurrentDetailTable())) && $vhistory->DetailAdd) {
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
    ew.addEventHandlers("vigd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
