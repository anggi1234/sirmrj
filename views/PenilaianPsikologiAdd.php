<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianPsikologiAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_psikologiadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpenilaian_psikologiadd = currentForm = new ew.Form("fpenilaian_psikologiadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penilaian_psikologi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penilaian_psikologi)
        ew.vars.tables.penilaian_psikologi = currentTable;
    fpenilaian_psikologiadd.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(0)], fields.tanggal.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid],
        ["anamnesis", [fields.anamnesis.visible && fields.anamnesis.required ? ew.Validators.required(fields.anamnesis.caption) : null], fields.anamnesis.isInvalid],
        ["dikirim_dari", [fields.dikirim_dari.visible && fields.dikirim_dari.required ? ew.Validators.required(fields.dikirim_dari.caption) : null], fields.dikirim_dari.isInvalid],
        ["tujuan_pemeriksaan", [fields.tujuan_pemeriksaan.visible && fields.tujuan_pemeriksaan.required ? ew.Validators.required(fields.tujuan_pemeriksaan.caption) : null], fields.tujuan_pemeriksaan.isInvalid],
        ["ket_anamnesis", [fields.ket_anamnesis.visible && fields.ket_anamnesis.required ? ew.Validators.required(fields.ket_anamnesis.caption) : null], fields.ket_anamnesis.isInvalid],
        ["rupa", [fields.rupa.visible && fields.rupa.required ? ew.Validators.required(fields.rupa.caption) : null], fields.rupa.isInvalid],
        ["bentuk_tubuh", [fields.bentuk_tubuh.visible && fields.bentuk_tubuh.required ? ew.Validators.required(fields.bentuk_tubuh.caption) : null], fields.bentuk_tubuh.isInvalid],
        ["tindakan", [fields.tindakan.visible && fields.tindakan.required ? ew.Validators.required(fields.tindakan.caption) : null], fields.tindakan.isInvalid],
        ["pakaian", [fields.pakaian.visible && fields.pakaian.required ? ew.Validators.required(fields.pakaian.caption) : null], fields.pakaian.isInvalid],
        ["ekspresi", [fields.ekspresi.visible && fields.ekspresi.required ? ew.Validators.required(fields.ekspresi.caption) : null], fields.ekspresi.isInvalid],
        ["berbicara", [fields.berbicara.visible && fields.berbicara.required ? ew.Validators.required(fields.berbicara.caption) : null], fields.berbicara.isInvalid],
        ["penggunaan_kata", [fields.penggunaan_kata.visible && fields.penggunaan_kata.required ? ew.Validators.required(fields.penggunaan_kata.caption) : null], fields.penggunaan_kata.isInvalid],
        ["ciri_menyolok", [fields.ciri_menyolok.visible && fields.ciri_menyolok.required ? ew.Validators.required(fields.ciri_menyolok.caption) : null], fields.ciri_menyolok.isInvalid],
        ["hasil_psikotes", [fields.hasil_psikotes.visible && fields.hasil_psikotes.required ? ew.Validators.required(fields.hasil_psikotes.caption) : null], fields.hasil_psikotes.isInvalid],
        ["kepribadian", [fields.kepribadian.visible && fields.kepribadian.required ? ew.Validators.required(fields.kepribadian.caption) : null], fields.kepribadian.isInvalid],
        ["psikodinamika", [fields.psikodinamika.visible && fields.psikodinamika.required ? ew.Validators.required(fields.psikodinamika.caption) : null], fields.psikodinamika.isInvalid],
        ["kesimpulan_psikolog", [fields.kesimpulan_psikolog.visible && fields.kesimpulan_psikolog.required ? ew.Validators.required(fields.kesimpulan_psikolog.caption) : null], fields.kesimpulan_psikolog.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenilaian_psikologiadd,
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
    fpenilaian_psikologiadd.validate = function () {
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
    fpenilaian_psikologiadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenilaian_psikologiadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenilaian_psikologiadd.lists.anamnesis = <?= $Page->anamnesis->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.dikirim_dari = <?= $Page->dikirim_dari->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.tujuan_pemeriksaan = <?= $Page->tujuan_pemeriksaan->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.rupa = <?= $Page->rupa->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.bentuk_tubuh = <?= $Page->bentuk_tubuh->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.tindakan = <?= $Page->tindakan->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.pakaian = <?= $Page->pakaian->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.ekspresi = <?= $Page->ekspresi->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.berbicara = <?= $Page->berbicara->toClientList($Page) ?>;
    fpenilaian_psikologiadd.lists.penggunaan_kata = <?= $Page->penggunaan_kata->toClientList($Page) ?>;
    loadjs.done("fpenilaian_psikologiadd");
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
<form name="fpenilaian_psikologiadd" id="fpenilaian_psikologiadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_psikologi">
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
        <label id="elh_penilaian_psikologi_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<?php if ($Page->no_rawat->getSessionValue() != "") { ?>
<span id="el_penilaian_psikologi_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_rawat->getDisplayValue($Page->no_rawat->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_rawat" name="x_no_rawat" value="<?= HtmlEncode($Page->no_rawat->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_penilaian_psikologi_no_rawat">
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <div id="r_tanggal" class="form-group row">
        <label id="elh_penilaian_psikologi_tanggal" for="x_tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal->caption() ?><?= $Page->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_psikologi_tanggal">
<input type="<?= $Page->tanggal->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" placeholder="<?= HtmlEncode($Page->tanggal->getPlaceHolder()) ?>" value="<?= $Page->tanggal->EditValue ?>"<?= $Page->tanggal->editAttributes() ?> aria-describedby="x_tanggal_help">
<?= $Page->tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal->getErrorMessage() ?></div>
<?php if (!$Page->tanggal->ReadOnly && !$Page->tanggal->Disabled && !isset($Page->tanggal->EditAttrs["readonly"]) && !isset($Page->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenilaian_psikologiadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fpenilaian_psikologiadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <div id="r_nip" class="form-group row">
        <label id="elh_penilaian_psikologi_nip" for="x_nip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nip->caption() ?><?= $Page->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nip->cellAttributes() ?>>
<span id="el_penilaian_psikologi_nip">
<input type="<?= $Page->nip->getInputTextType() ?>" data-table="penilaian_psikologi" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->nip->getPlaceHolder()) ?>" value="<?= $Page->nip->EditValue ?>"<?= $Page->nip->editAttributes() ?> aria-describedby="x_nip_help">
<?= $Page->nip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <div id="r_anamnesis" class="form-group row">
        <label id="elh_penilaian_psikologi_anamnesis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->anamnesis->caption() ?><?= $Page->anamnesis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el_penilaian_psikologi_anamnesis">
<template id="tp_x_anamnesis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_anamnesis" name="x_anamnesis" id="x_anamnesis"<?= $Page->anamnesis->editAttributes() ?>>
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
    data-table="penilaian_psikologi"
    data-field="x_anamnesis"
    data-value-separator="<?= $Page->anamnesis->displayValueSeparatorAttribute() ?>"
    <?= $Page->anamnesis->editAttributes() ?>>
<?= $Page->anamnesis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->anamnesis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
    <div id="r_dikirim_dari" class="form-group row">
        <label id="elh_penilaian_psikologi_dikirim_dari" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dikirim_dari->caption() ?><?= $Page->dikirim_dari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dikirim_dari->cellAttributes() ?>>
<span id="el_penilaian_psikologi_dikirim_dari">
<template id="tp_x_dikirim_dari">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_dikirim_dari" name="x_dikirim_dari" id="x_dikirim_dari"<?= $Page->dikirim_dari->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_dikirim_dari" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_dikirim_dari"
    name="x_dikirim_dari"
    value="<?= HtmlEncode($Page->dikirim_dari->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_dikirim_dari"
    data-target="dsl_x_dikirim_dari"
    data-repeatcolumn="5"
    class="form-control<?= $Page->dikirim_dari->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_dikirim_dari"
    data-value-separator="<?= $Page->dikirim_dari->displayValueSeparatorAttribute() ?>"
    <?= $Page->dikirim_dari->editAttributes() ?>>
<?= $Page->dikirim_dari->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dikirim_dari->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
    <div id="r_tujuan_pemeriksaan" class="form-group row">
        <label id="elh_penilaian_psikologi_tujuan_pemeriksaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tujuan_pemeriksaan->caption() ?><?= $Page->tujuan_pemeriksaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tujuan_pemeriksaan->cellAttributes() ?>>
<span id="el_penilaian_psikologi_tujuan_pemeriksaan">
<template id="tp_x_tujuan_pemeriksaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tujuan_pemeriksaan" name="x_tujuan_pemeriksaan" id="x_tujuan_pemeriksaan"<?= $Page->tujuan_pemeriksaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_tujuan_pemeriksaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_tujuan_pemeriksaan"
    name="x_tujuan_pemeriksaan"
    value="<?= HtmlEncode($Page->tujuan_pemeriksaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_tujuan_pemeriksaan"
    data-target="dsl_x_tujuan_pemeriksaan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->tujuan_pemeriksaan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tujuan_pemeriksaan"
    data-value-separator="<?= $Page->tujuan_pemeriksaan->displayValueSeparatorAttribute() ?>"
    <?= $Page->tujuan_pemeriksaan->editAttributes() ?>>
<?= $Page->tujuan_pemeriksaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tujuan_pemeriksaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ket_anamnesis->Visible) { // ket_anamnesis ?>
    <div id="r_ket_anamnesis" class="form-group row">
        <label id="elh_penilaian_psikologi_ket_anamnesis" for="x_ket_anamnesis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ket_anamnesis->caption() ?><?= $Page->ket_anamnesis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ket_anamnesis->cellAttributes() ?>>
<span id="el_penilaian_psikologi_ket_anamnesis">
<textarea data-table="penilaian_psikologi" data-field="x_ket_anamnesis" name="x_ket_anamnesis" id="x_ket_anamnesis" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ket_anamnesis->getPlaceHolder()) ?>"<?= $Page->ket_anamnesis->editAttributes() ?> aria-describedby="x_ket_anamnesis_help"><?= $Page->ket_anamnesis->EditValue ?></textarea>
<?= $Page->ket_anamnesis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ket_anamnesis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rupa->Visible) { // rupa ?>
    <div id="r_rupa" class="form-group row">
        <label id="elh_penilaian_psikologi_rupa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rupa->caption() ?><?= $Page->rupa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rupa->cellAttributes() ?>>
<span id="el_penilaian_psikologi_rupa">
<template id="tp_x_rupa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_rupa" name="x_rupa" id="x_rupa"<?= $Page->rupa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_rupa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_rupa"
    name="x_rupa"
    value="<?= HtmlEncode($Page->rupa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_rupa"
    data-target="dsl_x_rupa"
    data-repeatcolumn="5"
    class="form-control<?= $Page->rupa->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_rupa"
    data-value-separator="<?= $Page->rupa->displayValueSeparatorAttribute() ?>"
    <?= $Page->rupa->editAttributes() ?>>
<?= $Page->rupa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rupa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
    <div id="r_bentuk_tubuh" class="form-group row">
        <label id="elh_penilaian_psikologi_bentuk_tubuh" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bentuk_tubuh->caption() ?><?= $Page->bentuk_tubuh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bentuk_tubuh->cellAttributes() ?>>
<span id="el_penilaian_psikologi_bentuk_tubuh">
<template id="tp_x_bentuk_tubuh">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_bentuk_tubuh" name="x_bentuk_tubuh" id="x_bentuk_tubuh"<?= $Page->bentuk_tubuh->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_bentuk_tubuh" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_bentuk_tubuh"
    name="x_bentuk_tubuh"
    value="<?= HtmlEncode($Page->bentuk_tubuh->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_bentuk_tubuh"
    data-target="dsl_x_bentuk_tubuh"
    data-repeatcolumn="5"
    class="form-control<?= $Page->bentuk_tubuh->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_bentuk_tubuh"
    data-value-separator="<?= $Page->bentuk_tubuh->displayValueSeparatorAttribute() ?>"
    <?= $Page->bentuk_tubuh->editAttributes() ?>>
<?= $Page->bentuk_tubuh->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bentuk_tubuh->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tindakan->Visible) { // tindakan ?>
    <div id="r_tindakan" class="form-group row">
        <label id="elh_penilaian_psikologi_tindakan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tindakan->caption() ?><?= $Page->tindakan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tindakan->cellAttributes() ?>>
<span id="el_penilaian_psikologi_tindakan">
<template id="tp_x_tindakan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_tindakan" name="x_tindakan" id="x_tindakan"<?= $Page->tindakan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_tindakan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_tindakan"
    name="x_tindakan"
    value="<?= HtmlEncode($Page->tindakan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_tindakan"
    data-target="dsl_x_tindakan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->tindakan->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_tindakan"
    data-value-separator="<?= $Page->tindakan->displayValueSeparatorAttribute() ?>"
    <?= $Page->tindakan->editAttributes() ?>>
<?= $Page->tindakan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tindakan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pakaian->Visible) { // pakaian ?>
    <div id="r_pakaian" class="form-group row">
        <label id="elh_penilaian_psikologi_pakaian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pakaian->caption() ?><?= $Page->pakaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pakaian->cellAttributes() ?>>
<span id="el_penilaian_psikologi_pakaian">
<template id="tp_x_pakaian">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_pakaian" name="x_pakaian" id="x_pakaian"<?= $Page->pakaian->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_pakaian" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_pakaian"
    name="x_pakaian"
    value="<?= HtmlEncode($Page->pakaian->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_pakaian"
    data-target="dsl_x_pakaian"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pakaian->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_pakaian"
    data-value-separator="<?= $Page->pakaian->displayValueSeparatorAttribute() ?>"
    <?= $Page->pakaian->editAttributes() ?>>
<?= $Page->pakaian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pakaian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ekspresi->Visible) { // ekspresi ?>
    <div id="r_ekspresi" class="form-group row">
        <label id="elh_penilaian_psikologi_ekspresi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ekspresi->caption() ?><?= $Page->ekspresi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ekspresi->cellAttributes() ?>>
<span id="el_penilaian_psikologi_ekspresi">
<template id="tp_x_ekspresi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_ekspresi" name="x_ekspresi" id="x_ekspresi"<?= $Page->ekspresi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_ekspresi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_ekspresi"
    name="x_ekspresi"
    value="<?= HtmlEncode($Page->ekspresi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_ekspresi"
    data-target="dsl_x_ekspresi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->ekspresi->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_ekspresi"
    data-value-separator="<?= $Page->ekspresi->displayValueSeparatorAttribute() ?>"
    <?= $Page->ekspresi->editAttributes() ?>>
<?= $Page->ekspresi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ekspresi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->berbicara->Visible) { // berbicara ?>
    <div id="r_berbicara" class="form-group row">
        <label id="elh_penilaian_psikologi_berbicara" class="<?= $Page->LeftColumnClass ?>"><?= $Page->berbicara->caption() ?><?= $Page->berbicara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->berbicara->cellAttributes() ?>>
<span id="el_penilaian_psikologi_berbicara">
<template id="tp_x_berbicara">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_berbicara" name="x_berbicara" id="x_berbicara"<?= $Page->berbicara->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_berbicara" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_berbicara"
    name="x_berbicara"
    value="<?= HtmlEncode($Page->berbicara->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_berbicara"
    data-target="dsl_x_berbicara"
    data-repeatcolumn="5"
    class="form-control<?= $Page->berbicara->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_berbicara"
    data-value-separator="<?= $Page->berbicara->displayValueSeparatorAttribute() ?>"
    <?= $Page->berbicara->editAttributes() ?>>
<?= $Page->berbicara->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->berbicara->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
    <div id="r_penggunaan_kata" class="form-group row">
        <label id="elh_penilaian_psikologi_penggunaan_kata" class="<?= $Page->LeftColumnClass ?>"><?= $Page->penggunaan_kata->caption() ?><?= $Page->penggunaan_kata->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->penggunaan_kata->cellAttributes() ?>>
<span id="el_penilaian_psikologi_penggunaan_kata">
<template id="tp_x_penggunaan_kata">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="penilaian_psikologi" data-field="x_penggunaan_kata" name="x_penggunaan_kata" id="x_penggunaan_kata"<?= $Page->penggunaan_kata->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_penggunaan_kata" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_penggunaan_kata"
    name="x_penggunaan_kata"
    value="<?= HtmlEncode($Page->penggunaan_kata->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_penggunaan_kata"
    data-target="dsl_x_penggunaan_kata"
    data-repeatcolumn="5"
    class="form-control<?= $Page->penggunaan_kata->isInvalidClass() ?>"
    data-table="penilaian_psikologi"
    data-field="x_penggunaan_kata"
    data-value-separator="<?= $Page->penggunaan_kata->displayValueSeparatorAttribute() ?>"
    <?= $Page->penggunaan_kata->editAttributes() ?>>
<?= $Page->penggunaan_kata->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->penggunaan_kata->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ciri_menyolok->Visible) { // ciri_menyolok ?>
    <div id="r_ciri_menyolok" class="form-group row">
        <label id="elh_penilaian_psikologi_ciri_menyolok" for="x_ciri_menyolok" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ciri_menyolok->caption() ?><?= $Page->ciri_menyolok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ciri_menyolok->cellAttributes() ?>>
<span id="el_penilaian_psikologi_ciri_menyolok">
<textarea data-table="penilaian_psikologi" data-field="x_ciri_menyolok" name="x_ciri_menyolok" id="x_ciri_menyolok" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ciri_menyolok->getPlaceHolder()) ?>"<?= $Page->ciri_menyolok->editAttributes() ?> aria-describedby="x_ciri_menyolok_help"><?= $Page->ciri_menyolok->EditValue ?></textarea>
<?= $Page->ciri_menyolok->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ciri_menyolok->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hasil_psikotes->Visible) { // hasil_psikotes ?>
    <div id="r_hasil_psikotes" class="form-group row">
        <label id="elh_penilaian_psikologi_hasil_psikotes" for="x_hasil_psikotes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hasil_psikotes->caption() ?><?= $Page->hasil_psikotes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hasil_psikotes->cellAttributes() ?>>
<span id="el_penilaian_psikologi_hasil_psikotes">
<textarea data-table="penilaian_psikologi" data-field="x_hasil_psikotes" name="x_hasil_psikotes" id="x_hasil_psikotes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->hasil_psikotes->getPlaceHolder()) ?>"<?= $Page->hasil_psikotes->editAttributes() ?> aria-describedby="x_hasil_psikotes_help"><?= $Page->hasil_psikotes->EditValue ?></textarea>
<?= $Page->hasil_psikotes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hasil_psikotes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kepribadian->Visible) { // kepribadian ?>
    <div id="r_kepribadian" class="form-group row">
        <label id="elh_penilaian_psikologi_kepribadian" for="x_kepribadian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kepribadian->caption() ?><?= $Page->kepribadian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kepribadian->cellAttributes() ?>>
<span id="el_penilaian_psikologi_kepribadian">
<textarea data-table="penilaian_psikologi" data-field="x_kepribadian" name="x_kepribadian" id="x_kepribadian" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->kepribadian->getPlaceHolder()) ?>"<?= $Page->kepribadian->editAttributes() ?> aria-describedby="x_kepribadian_help"><?= $Page->kepribadian->EditValue ?></textarea>
<?= $Page->kepribadian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kepribadian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->psikodinamika->Visible) { // psikodinamika ?>
    <div id="r_psikodinamika" class="form-group row">
        <label id="elh_penilaian_psikologi_psikodinamika" for="x_psikodinamika" class="<?= $Page->LeftColumnClass ?>"><?= $Page->psikodinamika->caption() ?><?= $Page->psikodinamika->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->psikodinamika->cellAttributes() ?>>
<span id="el_penilaian_psikologi_psikodinamika">
<textarea data-table="penilaian_psikologi" data-field="x_psikodinamika" name="x_psikodinamika" id="x_psikodinamika" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->psikodinamika->getPlaceHolder()) ?>"<?= $Page->psikodinamika->editAttributes() ?> aria-describedby="x_psikodinamika_help"><?= $Page->psikodinamika->EditValue ?></textarea>
<?= $Page->psikodinamika->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->psikodinamika->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kesimpulan_psikolog->Visible) { // kesimpulan_psikolog ?>
    <div id="r_kesimpulan_psikolog" class="form-group row">
        <label id="elh_penilaian_psikologi_kesimpulan_psikolog" for="x_kesimpulan_psikolog" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kesimpulan_psikolog->caption() ?><?= $Page->kesimpulan_psikolog->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kesimpulan_psikolog->cellAttributes() ?>>
<span id="el_penilaian_psikologi_kesimpulan_psikolog">
<textarea data-table="penilaian_psikologi" data-field="x_kesimpulan_psikolog" name="x_kesimpulan_psikolog" id="x_kesimpulan_psikolog" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->kesimpulan_psikolog->getPlaceHolder()) ?>"<?= $Page->kesimpulan_psikolog->editAttributes() ?> aria-describedby="x_kesimpulan_psikolog_help"><?= $Page->kesimpulan_psikolog->EditValue ?></textarea>
<?= $Page->kesimpulan_psikolog->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kesimpulan_psikolog->getErrorMessage() ?></div>
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
    ew.addEventHandlers("penilaian_psikologi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
