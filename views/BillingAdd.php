<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$BillingAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbillingadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fbillingadd = currentForm = new ew.Form("fbillingadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "billing")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.billing)
        ew.vars.tables.billing = currentTable;
    fbillingadd.addFields([
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null], fields.no_reg.isInvalid],
        ["tgl_byr", [fields.tgl_byr.visible && fields.tgl_byr.required ? ew.Validators.required(fields.tgl_byr.caption) : null, ew.Validators.datetime(0)], fields.tgl_byr.isInvalid],
        ["no", [fields.no.visible && fields.no.required ? ew.Validators.required(fields.no.caption) : null], fields.no.isInvalid],
        ["nm_perawatan", [fields.nm_perawatan.visible && fields.nm_perawatan.required ? ew.Validators.required(fields.nm_perawatan.caption) : null], fields.nm_perawatan.isInvalid],
        ["pemisah", [fields.pemisah.visible && fields.pemisah.required ? ew.Validators.required(fields.pemisah.caption) : null], fields.pemisah.isInvalid],
        ["biaya", [fields.biaya.visible && fields.biaya.required ? ew.Validators.required(fields.biaya.caption) : null, ew.Validators.float], fields.biaya.isInvalid],
        ["jumlah", [fields.jumlah.visible && fields.jumlah.required ? ew.Validators.required(fields.jumlah.caption) : null, ew.Validators.float], fields.jumlah.isInvalid],
        ["tambahan", [fields.tambahan.visible && fields.tambahan.required ? ew.Validators.required(fields.tambahan.caption) : null, ew.Validators.float], fields.tambahan.isInvalid],
        ["totalbiaya", [fields.totalbiaya.visible && fields.totalbiaya.required ? ew.Validators.required(fields.totalbiaya.caption) : null, ew.Validators.float], fields.totalbiaya.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbillingadd,
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
    fbillingadd.validate = function () {
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
    fbillingadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbillingadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fbillingadd.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fbillingadd");
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
<form name="fbillingadd" id="fbillingadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="billing">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "vrajal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_reg->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <div id="r_no_reg" class="form-group row">
        <label id="elh_billing_no_reg" for="x_no_reg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_reg->caption() ?><?= $Page->no_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_reg->cellAttributes() ?>>
<?php if ($Page->no_reg->getSessionValue() != "") { ?>
<span id="el_billing_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_reg->getDisplayValue($Page->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_reg" name="x_no_reg" value="<?= HtmlEncode($Page->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_billing_no_reg">
<input type="<?= $Page->no_reg->getInputTextType() ?>" data-table="billing" data-field="x_no_reg" name="x_no_reg" id="x_no_reg" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_reg->getPlaceHolder()) ?>" value="<?= $Page->no_reg->EditValue ?>"<?= $Page->no_reg->editAttributes() ?> aria-describedby="x_no_reg_help">
<?= $Page->no_reg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_byr->Visible) { // tgl_byr ?>
    <div id="r_tgl_byr" class="form-group row">
        <label id="elh_billing_tgl_byr" for="x_tgl_byr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_byr->caption() ?><?= $Page->tgl_byr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_byr->cellAttributes() ?>>
<span id="el_billing_tgl_byr">
<input type="<?= $Page->tgl_byr->getInputTextType() ?>" data-table="billing" data-field="x_tgl_byr" name="x_tgl_byr" id="x_tgl_byr" placeholder="<?= HtmlEncode($Page->tgl_byr->getPlaceHolder()) ?>" value="<?= $Page->tgl_byr->EditValue ?>"<?= $Page->tgl_byr->editAttributes() ?> aria-describedby="x_tgl_byr_help">
<?= $Page->tgl_byr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_byr->getErrorMessage() ?></div>
<?php if (!$Page->tgl_byr->ReadOnly && !$Page->tgl_byr->Disabled && !isset($Page->tgl_byr->EditAttrs["readonly"]) && !isset($Page->tgl_byr->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbillingadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fbillingadd", "x_tgl_byr", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no->Visible) { // no ?>
    <div id="r_no" class="form-group row">
        <label id="elh_billing_no" for="x_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no->caption() ?><?= $Page->no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no->cellAttributes() ?>>
<span id="el_billing_no">
<input type="<?= $Page->no->getInputTextType() ?>" data-table="billing" data-field="x_no" name="x_no" id="x_no" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->no->getPlaceHolder()) ?>" value="<?= $Page->no->EditValue ?>"<?= $Page->no->editAttributes() ?> aria-describedby="x_no_help">
<?= $Page->no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nm_perawatan->Visible) { // nm_perawatan ?>
    <div id="r_nm_perawatan" class="form-group row">
        <label id="elh_billing_nm_perawatan" for="x_nm_perawatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_perawatan->caption() ?><?= $Page->nm_perawatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_perawatan->cellAttributes() ?>>
<span id="el_billing_nm_perawatan">
<input type="<?= $Page->nm_perawatan->getInputTextType() ?>" data-table="billing" data-field="x_nm_perawatan" name="x_nm_perawatan" id="x_nm_perawatan" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->nm_perawatan->getPlaceHolder()) ?>" value="<?= $Page->nm_perawatan->EditValue ?>"<?= $Page->nm_perawatan->editAttributes() ?> aria-describedby="x_nm_perawatan_help">
<?= $Page->nm_perawatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_perawatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pemisah->Visible) { // pemisah ?>
    <div id="r_pemisah" class="form-group row">
        <label id="elh_billing_pemisah" for="x_pemisah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pemisah->caption() ?><?= $Page->pemisah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pemisah->cellAttributes() ?>>
<span id="el_billing_pemisah">
<input type="<?= $Page->pemisah->getInputTextType() ?>" data-table="billing" data-field="x_pemisah" name="x_pemisah" id="x_pemisah" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->pemisah->getPlaceHolder()) ?>" value="<?= $Page->pemisah->EditValue ?>"<?= $Page->pemisah->editAttributes() ?> aria-describedby="x_pemisah_help">
<?= $Page->pemisah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pemisah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
    <div id="r_biaya" class="form-group row">
        <label id="elh_billing_biaya" for="x_biaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->biaya->caption() ?><?= $Page->biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->biaya->cellAttributes() ?>>
<span id="el_billing_biaya">
<input type="<?= $Page->biaya->getInputTextType() ?>" data-table="billing" data-field="x_biaya" name="x_biaya" id="x_biaya" size="30" placeholder="<?= HtmlEncode($Page->biaya->getPlaceHolder()) ?>" value="<?= $Page->biaya->EditValue ?>"<?= $Page->biaya->editAttributes() ?> aria-describedby="x_biaya_help">
<?= $Page->biaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->biaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
    <div id="r_jumlah" class="form-group row">
        <label id="elh_billing_jumlah" for="x_jumlah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah->caption() ?><?= $Page->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jumlah->cellAttributes() ?>>
<span id="el_billing_jumlah">
<input type="<?= $Page->jumlah->getInputTextType() ?>" data-table="billing" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" placeholder="<?= HtmlEncode($Page->jumlah->getPlaceHolder()) ?>" value="<?= $Page->jumlah->EditValue ?>"<?= $Page->jumlah->editAttributes() ?> aria-describedby="x_jumlah_help">
<?= $Page->jumlah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tambahan->Visible) { // tambahan ?>
    <div id="r_tambahan" class="form-group row">
        <label id="elh_billing_tambahan" for="x_tambahan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tambahan->caption() ?><?= $Page->tambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tambahan->cellAttributes() ?>>
<span id="el_billing_tambahan">
<input type="<?= $Page->tambahan->getInputTextType() ?>" data-table="billing" data-field="x_tambahan" name="x_tambahan" id="x_tambahan" size="30" placeholder="<?= HtmlEncode($Page->tambahan->getPlaceHolder()) ?>" value="<?= $Page->tambahan->EditValue ?>"<?= $Page->tambahan->editAttributes() ?> aria-describedby="x_tambahan_help">
<?= $Page->tambahan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tambahan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->totalbiaya->Visible) { // totalbiaya ?>
    <div id="r_totalbiaya" class="form-group row">
        <label id="elh_billing_totalbiaya" for="x_totalbiaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->totalbiaya->caption() ?><?= $Page->totalbiaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->totalbiaya->cellAttributes() ?>>
<span id="el_billing_totalbiaya">
<input type="<?= $Page->totalbiaya->getInputTextType() ?>" data-table="billing" data-field="x_totalbiaya" name="x_totalbiaya" id="x_totalbiaya" size="30" placeholder="<?= HtmlEncode($Page->totalbiaya->getPlaceHolder()) ?>" value="<?= $Page->totalbiaya->EditValue ?>"<?= $Page->totalbiaya->editAttributes() ?> aria-describedby="x_totalbiaya_help">
<?= $Page->totalbiaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->totalbiaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_billing_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_billing_status">
<template id="tp_x_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="billing" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
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
    data-table="billing"
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
    ew.addEventHandlers("billing");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
