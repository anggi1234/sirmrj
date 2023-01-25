<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$DiagnosaPasienEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdiagnosa_pasienedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fdiagnosa_pasienedit = currentForm = new ew.Form("fdiagnosa_pasienedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "diagnosa_pasien")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.diagnosa_pasien)
        ew.vars.tables.diagnosa_pasien = currentTable;
    fdiagnosa_pasienedit.addFields([
        ["kd_penyakit", [fields.kd_penyakit.visible && fields.kd_penyakit.required ? ew.Validators.required(fields.kd_penyakit.caption) : null], fields.kd_penyakit.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["prioritas", [fields.prioritas.visible && fields.prioritas.required ? ew.Validators.required(fields.prioritas.caption) : null, ew.Validators.integer], fields.prioritas.isInvalid],
        ["status_penyakit", [fields.status_penyakit.visible && fields.status_penyakit.required ? ew.Validators.required(fields.status_penyakit.caption) : null], fields.status_penyakit.isInvalid],
        ["kd_icd9", [fields.kd_icd9.visible && fields.kd_icd9.required ? ew.Validators.required(fields.kd_icd9.caption) : null], fields.kd_icd9.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdiagnosa_pasienedit,
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
    fdiagnosa_pasienedit.validate = function () {
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
    fdiagnosa_pasienedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdiagnosa_pasienedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdiagnosa_pasienedit.lists.kd_penyakit = <?= $Page->kd_penyakit->toClientList($Page) ?>;
    fdiagnosa_pasienedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fdiagnosa_pasienedit.lists.status_penyakit = <?= $Page->status_penyakit->toClientList($Page) ?>;
    fdiagnosa_pasienedit.lists.kd_icd9 = <?= $Page->kd_icd9->toClientList($Page) ?>;
    loadjs.done("fdiagnosa_pasienedit");
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
<form name="fdiagnosa_pasienedit" id="fdiagnosa_pasienedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="diagnosa_pasien">
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
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
    <div id="r_kd_penyakit" class="form-group row">
        <label id="elh_diagnosa_pasien_kd_penyakit" for="x_kd_penyakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_penyakit->caption() ?><?= $Page->kd_penyakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_penyakit->cellAttributes() ?>>
<span id="el_diagnosa_pasien_kd_penyakit">
<div class="input-group ew-lookup-list" aria-describedby="x_kd_penyakit_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_kd_penyakit"><?= EmptyValue(strval($Page->kd_penyakit->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->kd_penyakit->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->kd_penyakit->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->kd_penyakit->ReadOnly || $Page->kd_penyakit->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_kd_penyakit',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->kd_penyakit->getErrorMessage() ?></div>
<?= $Page->kd_penyakit->getCustomMessage() ?>
<?= $Page->kd_penyakit->Lookup->getParamTag($Page, "p_x_kd_penyakit") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_penyakit" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->kd_penyakit->displayValueSeparatorAttribute() ?>" name="x_kd_penyakit" id="x_kd_penyakit" value="<?= $Page->kd_penyakit->CurrentValue ?>"<?= $Page->kd_penyakit->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_diagnosa_pasien_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_diagnosa_pasien_status">
<template id="tp_x_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prioritas->Visible) { // prioritas ?>
    <div id="r_prioritas" class="form-group row">
        <label id="elh_diagnosa_pasien_prioritas" for="x_prioritas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prioritas->caption() ?><?= $Page->prioritas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->prioritas->cellAttributes() ?>>
<span id="el_diagnosa_pasien_prioritas">
<input type="<?= $Page->prioritas->getInputTextType() ?>" data-table="diagnosa_pasien" data-field="x_prioritas" name="x_prioritas" id="x_prioritas" size="30" placeholder="<?= HtmlEncode($Page->prioritas->getPlaceHolder()) ?>" value="<?= $Page->prioritas->EditValue ?>"<?= $Page->prioritas->editAttributes() ?> aria-describedby="x_prioritas_help">
<?= $Page->prioritas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prioritas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_penyakit->Visible) { // status_penyakit ?>
    <div id="r_status_penyakit" class="form-group row">
        <label id="elh_diagnosa_pasien_status_penyakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_penyakit->caption() ?><?= $Page->status_penyakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_penyakit->cellAttributes() ?>>
<span id="el_diagnosa_pasien_status_penyakit">
<template id="tp_x_status_penyakit">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="diagnosa_pasien" data-field="x_status_penyakit" name="x_status_penyakit" id="x_status_penyakit"<?= $Page->status_penyakit->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status_penyakit" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status_penyakit"
    name="x_status_penyakit"
    value="<?= HtmlEncode($Page->status_penyakit->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_penyakit"
    data-target="dsl_x_status_penyakit"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_penyakit->isInvalidClass() ?>"
    data-table="diagnosa_pasien"
    data-field="x_status_penyakit"
    data-value-separator="<?= $Page->status_penyakit->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_penyakit->editAttributes() ?>>
<?= $Page->status_penyakit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_penyakit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_icd9->Visible) { // kd_icd9 ?>
    <div id="r_kd_icd9" class="form-group row">
        <label id="elh_diagnosa_pasien_kd_icd9" for="x_kd_icd9" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_icd9->caption() ?><?= $Page->kd_icd9->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_icd9->cellAttributes() ?>>
<span id="el_diagnosa_pasien_kd_icd9">
<div class="input-group ew-lookup-list" aria-describedby="x_kd_icd9_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_kd_icd9"><?= EmptyValue(strval($Page->kd_icd9->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->kd_icd9->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->kd_icd9->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->kd_icd9->ReadOnly || $Page->kd_icd9->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_kd_icd9',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->kd_icd9->getErrorMessage() ?></div>
<?= $Page->kd_icd9->getCustomMessage() ?>
<?= $Page->kd_icd9->Lookup->getParamTag($Page, "p_x_kd_icd9") ?>
<input type="hidden" is="selection-list" data-table="diagnosa_pasien" data-field="x_kd_icd9" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->kd_icd9->displayValueSeparatorAttribute() ?>" name="x_kd_icd9" id="x_kd_icd9" value="<?= $Page->kd_icd9->CurrentValue ?>"<?= $Page->kd_icd9->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="diagnosa_pasien" data-field="x_id_diagnosa_pasien" data-hidden="1" name="x_id_diagnosa_pasien" id="x_id_diagnosa_pasien" value="<?= HtmlEncode($Page->id_diagnosa_pasien->CurrentValue) ?>">
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
    ew.addEventHandlers("diagnosa_pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
