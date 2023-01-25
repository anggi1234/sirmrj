<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$KonsulAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkonsuladd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fkonsuladd = currentForm = new ew.Form("fkonsuladd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "konsul")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.konsul)
        ew.vars.tables.konsul = currentTable;
    fkonsuladd.addFields([
        ["jenis_konsul", [fields.jenis_konsul.visible && fields.jenis_konsul.required ? ew.Validators.required(fields.jenis_konsul.caption) : null], fields.jenis_konsul.isInvalid],
        ["konsultasi", [fields.konsultasi.visible && fields.konsultasi.required ? ew.Validators.required(fields.konsultasi.caption) : null], fields.konsultasi.isInvalid],
        ["hasil_konsul", [fields.hasil_konsul.visible && fields.hasil_konsul.required ? ew.Validators.required(fields.hasil_konsul.caption) : null], fields.hasil_konsul.isInvalid],
        ["status_konsul", [fields.status_konsul.visible && fields.status_konsul.required ? ew.Validators.required(fields.status_konsul.caption) : null], fields.status_konsul.isInvalid],
        ["tanggal_input", [fields.tanggal_input.visible && fields.tanggal_input.required ? ew.Validators.required(fields.tanggal_input.caption) : null], fields.tanggal_input.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkonsuladd,
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
    fkonsuladd.validate = function () {
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
    fkonsuladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkonsuladd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fkonsuladd.lists.jenis_konsul = <?= $Page->jenis_konsul->toClientList($Page) ?>;
    fkonsuladd.lists.status_konsul = <?= $Page->status_konsul->toClientList($Page) ?>;
    loadjs.done("fkonsuladd");
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
<form name="fkonsuladd" id="fkonsuladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="konsul">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "vrajal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_reg->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->jenis_konsul->Visible) { // jenis_konsul ?>
    <div id="r_jenis_konsul" class="form-group row">
        <label id="elh_konsul_jenis_konsul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_konsul->caption() ?><?= $Page->jenis_konsul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis_konsul->cellAttributes() ?>>
<span id="el_konsul_jenis_konsul">
<template id="tp_x_jenis_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_jenis_konsul" name="x_jenis_konsul" id="x_jenis_konsul"<?= $Page->jenis_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_jenis_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_jenis_konsul"
    name="x_jenis_konsul"
    value="<?= HtmlEncode($Page->jenis_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis_konsul"
    data-target="dsl_x_jenis_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_jenis_konsul"
    data-value-separator="<?= $Page->jenis_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis_konsul->editAttributes() ?>>
<?= $Page->jenis_konsul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_konsul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->konsultasi->Visible) { // konsultasi ?>
    <div id="r_konsultasi" class="form-group row">
        <label id="elh_konsul_konsultasi" for="x_konsultasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->konsultasi->caption() ?><?= $Page->konsultasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->konsultasi->cellAttributes() ?>>
<span id="el_konsul_konsultasi">
<input type="<?= $Page->konsultasi->getInputTextType() ?>" data-table="konsul" data-field="x_konsultasi" name="x_konsultasi" id="x_konsultasi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->konsultasi->getPlaceHolder()) ?>" value="<?= $Page->konsultasi->EditValue ?>"<?= $Page->konsultasi->editAttributes() ?> aria-describedby="x_konsultasi_help">
<?= $Page->konsultasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->konsultasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hasil_konsul->Visible) { // hasil_konsul ?>
    <div id="r_hasil_konsul" class="form-group row">
        <label id="elh_konsul_hasil_konsul" for="x_hasil_konsul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hasil_konsul->caption() ?><?= $Page->hasil_konsul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hasil_konsul->cellAttributes() ?>>
<span id="el_konsul_hasil_konsul">
<input type="<?= $Page->hasil_konsul->getInputTextType() ?>" data-table="konsul" data-field="x_hasil_konsul" name="x_hasil_konsul" id="x_hasil_konsul" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->hasil_konsul->getPlaceHolder()) ?>" value="<?= $Page->hasil_konsul->EditValue ?>"<?= $Page->hasil_konsul->editAttributes() ?> aria-describedby="x_hasil_konsul_help">
<?= $Page->hasil_konsul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hasil_konsul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_konsul->Visible) { // status_konsul ?>
    <div id="r_status_konsul" class="form-group row">
        <label id="elh_konsul_status_konsul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_konsul->caption() ?><?= $Page->status_konsul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_konsul->cellAttributes() ?>>
<span id="el_konsul_status_konsul">
<template id="tp_x_status_konsul">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="konsul" data-field="x_status_konsul" name="x_status_konsul" id="x_status_konsul"<?= $Page->status_konsul->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status_konsul" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status_konsul"
    name="x_status_konsul"
    value="<?= HtmlEncode($Page->status_konsul->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_konsul"
    data-target="dsl_x_status_konsul"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_konsul->isInvalidClass() ?>"
    data-table="konsul"
    data-field="x_status_konsul"
    data-value-separator="<?= $Page->status_konsul->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_konsul->editAttributes() ?>>
<?= $Page->status_konsul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_konsul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->no_reg->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_no_reg" id="x_no_reg" value="<?= HtmlEncode(strval($Page->no_reg->getSessionValue())) ?>">
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
    ew.addEventHandlers("konsul");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
