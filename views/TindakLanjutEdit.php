<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$TindakLanjutEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftindak_lanjutedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftindak_lanjutedit = currentForm = new ew.Form("ftindak_lanjutedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "tindak_lanjut")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.tindak_lanjut)
        ew.vars.tables.tindak_lanjut = currentTable;
    ftindak_lanjutedit.addFields([
        ["tindak_lanjut", [fields.tindak_lanjut.visible && fields.tindak_lanjut.required ? ew.Validators.required(fields.tindak_lanjut.caption) : null], fields.tindak_lanjut.isInvalid],
        ["no_kontrol", [fields.no_kontrol.visible && fields.no_kontrol.required ? ew.Validators.required(fields.no_kontrol.caption) : null], fields.no_kontrol.isInvalid],
        ["tgl_input", [fields.tgl_input.visible && fields.tgl_input.required ? ew.Validators.required(fields.tgl_input.caption) : null], fields.tgl_input.isInvalid],
        ["tgl_kontrol", [fields.tgl_kontrol.visible && fields.tgl_kontrol.required ? ew.Validators.required(fields.tgl_kontrol.caption) : null, ew.Validators.datetime(7)], fields.tgl_kontrol.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftindak_lanjutedit,
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
    ftindak_lanjutedit.validate = function () {
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
    ftindak_lanjutedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftindak_lanjutedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    ftindak_lanjutedit.lists.tindak_lanjut = <?= $Page->tindak_lanjut->toClientList($Page) ?>;
    loadjs.done("ftindak_lanjutedit");
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
<form name="ftindak_lanjutedit" id="ftindak_lanjutedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tindak_lanjut">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "vigd") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vigd">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_reg->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "vrajal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_reg->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->tindak_lanjut->Visible) { // tindak_lanjut ?>
    <div id="r_tindak_lanjut" class="form-group row">
        <label id="elh_tindak_lanjut_tindak_lanjut" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tindak_lanjut->caption() ?><?= $Page->tindak_lanjut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tindak_lanjut->cellAttributes() ?>>
<span id="el_tindak_lanjut_tindak_lanjut">
<template id="tp_x_tindak_lanjut">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="tindak_lanjut" data-field="x_tindak_lanjut" name="x_tindak_lanjut" id="x_tindak_lanjut"<?= $Page->tindak_lanjut->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_tindak_lanjut" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_tindak_lanjut"
    name="x_tindak_lanjut"
    value="<?= HtmlEncode($Page->tindak_lanjut->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_tindak_lanjut"
    data-target="dsl_x_tindak_lanjut"
    data-repeatcolumn="5"
    class="form-control<?= $Page->tindak_lanjut->isInvalidClass() ?>"
    data-table="tindak_lanjut"
    data-field="x_tindak_lanjut"
    data-value-separator="<?= $Page->tindak_lanjut->displayValueSeparatorAttribute() ?>"
    <?= $Page->tindak_lanjut->editAttributes() ?>>
<?= $Page->tindak_lanjut->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tindak_lanjut->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_kontrol->Visible) { // no_kontrol ?>
    <div id="r_no_kontrol" class="form-group row">
        <label id="elh_tindak_lanjut_no_kontrol" for="x_no_kontrol" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_kontrol->caption() ?><?= $Page->no_kontrol->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_kontrol->cellAttributes() ?>>
<span id="el_tindak_lanjut_no_kontrol">
<input type="<?= $Page->no_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_no_kontrol" name="x_no_kontrol" id="x_no_kontrol" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->no_kontrol->getPlaceHolder()) ?>" value="<?= $Page->no_kontrol->EditValue ?>"<?= $Page->no_kontrol->editAttributes() ?> aria-describedby="x_no_kontrol_help">
<?= $Page->no_kontrol->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_kontrol->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <div id="r_tgl_kontrol" class="form-group row">
        <label id="elh_tindak_lanjut_tgl_kontrol" for="x_tgl_kontrol" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_kontrol->caption() ?><?= $Page->tgl_kontrol->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_kontrol->cellAttributes() ?>>
<span id="el_tindak_lanjut_tgl_kontrol">
<input type="<?= $Page->tgl_kontrol->getInputTextType() ?>" data-table="tindak_lanjut" data-field="x_tgl_kontrol" data-format="7" name="x_tgl_kontrol" id="x_tgl_kontrol" placeholder="<?= HtmlEncode($Page->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Page->tgl_kontrol->EditValue ?>"<?= $Page->tgl_kontrol->editAttributes() ?> aria-describedby="x_tgl_kontrol_help">
<?= $Page->tgl_kontrol->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_kontrol->getErrorMessage() ?></div>
<?php if (!$Page->tgl_kontrol->ReadOnly && !$Page->tgl_kontrol->Disabled && !isset($Page->tgl_kontrol->EditAttrs["readonly"]) && !isset($Page->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftindak_lanjutedit", "datetimepicker"], function() {
    ew.createDateTimePicker("ftindak_lanjutedit", "x_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="tindak_lanjut" data-field="x_id_tindak_lanjut" data-hidden="1" name="x_id_tindak_lanjut" id="x_id_tindak_lanjut" value="<?= HtmlEncode($Page->id_tindak_lanjut->CurrentValue) ?>">
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
    ew.addEventHandlers("tindak_lanjut");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
