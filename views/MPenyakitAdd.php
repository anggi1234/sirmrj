<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MPenyakitAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_penyakitadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fm_penyakitadd = currentForm = new ew.Form("fm_penyakitadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "m_penyakit")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.m_penyakit)
        ew.vars.tables.m_penyakit = currentTable;
    fm_penyakitadd.addFields([
        ["kd_penyakit", [fields.kd_penyakit.visible && fields.kd_penyakit.required ? ew.Validators.required(fields.kd_penyakit.caption) : null], fields.kd_penyakit.isInvalid],
        ["nm_penyakit", [fields.nm_penyakit.visible && fields.nm_penyakit.required ? ew.Validators.required(fields.nm_penyakit.caption) : null], fields.nm_penyakit.isInvalid],
        ["ciri_ciri", [fields.ciri_ciri.visible && fields.ciri_ciri.required ? ew.Validators.required(fields.ciri_ciri.caption) : null], fields.ciri_ciri.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["kd_ktg", [fields.kd_ktg.visible && fields.kd_ktg.required ? ew.Validators.required(fields.kd_ktg.caption) : null], fields.kd_ktg.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fm_penyakitadd,
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
    fm_penyakitadd.validate = function () {
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
    fm_penyakitadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_penyakitadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fm_penyakitadd.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fm_penyakitadd");
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
<form name="fm_penyakitadd" id="fm_penyakitadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_penyakit">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
    <div id="r_kd_penyakit" class="form-group row">
        <label id="elh_m_penyakit_kd_penyakit" for="x_kd_penyakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_penyakit->caption() ?><?= $Page->kd_penyakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_penyakit->cellAttributes() ?>>
<span id="el_m_penyakit_kd_penyakit">
<input type="<?= $Page->kd_penyakit->getInputTextType() ?>" data-table="m_penyakit" data-field="x_kd_penyakit" name="x_kd_penyakit" id="x_kd_penyakit" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->kd_penyakit->getPlaceHolder()) ?>" value="<?= $Page->kd_penyakit->EditValue ?>"<?= $Page->kd_penyakit->editAttributes() ?> aria-describedby="x_kd_penyakit_help">
<?= $Page->kd_penyakit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_penyakit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nm_penyakit->Visible) { // nm_penyakit ?>
    <div id="r_nm_penyakit" class="form-group row">
        <label id="elh_m_penyakit_nm_penyakit" for="x_nm_penyakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_penyakit->caption() ?><?= $Page->nm_penyakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_penyakit->cellAttributes() ?>>
<span id="el_m_penyakit_nm_penyakit">
<input type="<?= $Page->nm_penyakit->getInputTextType() ?>" data-table="m_penyakit" data-field="x_nm_penyakit" name="x_nm_penyakit" id="x_nm_penyakit" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nm_penyakit->getPlaceHolder()) ?>" value="<?= $Page->nm_penyakit->EditValue ?>"<?= $Page->nm_penyakit->editAttributes() ?> aria-describedby="x_nm_penyakit_help">
<?= $Page->nm_penyakit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_penyakit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ciri_ciri->Visible) { // ciri_ciri ?>
    <div id="r_ciri_ciri" class="form-group row">
        <label id="elh_m_penyakit_ciri_ciri" for="x_ciri_ciri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ciri_ciri->caption() ?><?= $Page->ciri_ciri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ciri_ciri->cellAttributes() ?>>
<span id="el_m_penyakit_ciri_ciri">
<textarea data-table="m_penyakit" data-field="x_ciri_ciri" name="x_ciri_ciri" id="x_ciri_ciri" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ciri_ciri->getPlaceHolder()) ?>"<?= $Page->ciri_ciri->editAttributes() ?> aria-describedby="x_ciri_ciri_help"><?= $Page->ciri_ciri->EditValue ?></textarea>
<?= $Page->ciri_ciri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ciri_ciri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan" class="form-group row">
        <label id="elh_m_penyakit_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keterangan->cellAttributes() ?>>
<span id="el_m_penyakit_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" data-table="m_penyakit" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" value="<?= $Page->keterangan->EditValue ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_ktg->Visible) { // kd_ktg ?>
    <div id="r_kd_ktg" class="form-group row">
        <label id="elh_m_penyakit_kd_ktg" for="x_kd_ktg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_ktg->caption() ?><?= $Page->kd_ktg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_ktg->cellAttributes() ?>>
<span id="el_m_penyakit_kd_ktg">
<input type="<?= $Page->kd_ktg->getInputTextType() ?>" data-table="m_penyakit" data-field="x_kd_ktg" name="x_kd_ktg" id="x_kd_ktg" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->kd_ktg->getPlaceHolder()) ?>" value="<?= $Page->kd_ktg->EditValue ?>"<?= $Page->kd_ktg->editAttributes() ?> aria-describedby="x_kd_ktg_help">
<?= $Page->kd_ktg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_ktg->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_m_penyakit_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_m_penyakit_status">
<template id="tp_x_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="m_penyakit" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
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
    data-table="m_penyakit"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
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
    ew.addEventHandlers("m_penyakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
