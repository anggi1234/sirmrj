<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CpptAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcpptadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fcpptadd = currentForm = new ew.Form("fcpptadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "cppt")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.cppt)
        ew.vars.tables.cppt = currentTable;
    fcpptadd.addFields([
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null, ew.Validators.integer], fields.no_reg.isInvalid],
        ["profesi", [fields.profesi.visible && fields.profesi.required ? ew.Validators.required(fields.profesi.caption) : null], fields.profesi.isInvalid],
        ["hasil_soap", [fields.hasil_soap.visible && fields.hasil_soap.required ? ew.Validators.required(fields.hasil_soap.caption) : null], fields.hasil_soap.isInvalid],
        ["instruksi", [fields.instruksi.visible && fields.instruksi.required ? ew.Validators.required(fields.instruksi.caption) : null], fields.instruksi.isInvalid],
        ["verifikasi", [fields.verifikasi.visible && fields.verifikasi.required ? ew.Validators.required(fields.verifikasi.caption) : null], fields.verifikasi.isInvalid],
        ["tanggal_input", [fields.tanggal_input.visible && fields.tanggal_input.required ? ew.Validators.required(fields.tanggal_input.caption) : null, ew.Validators.datetime(0)], fields.tanggal_input.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcpptadd,
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
    fcpptadd.validate = function () {
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
    fcpptadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcpptadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fcpptadd.lists.profesi = <?= $Page->profesi->toClientList($Page) ?>;
    fcpptadd.lists.verifikasi = <?= $Page->verifikasi->toClientList($Page) ?>;
    loadjs.done("fcpptadd");
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
<form name="fcpptadd" id="fcpptadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cppt">
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
        <label id="elh_cppt_no_reg" for="x_no_reg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_reg->caption() ?><?= $Page->no_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_reg->cellAttributes() ?>>
<?php if ($Page->no_reg->getSessionValue() != "") { ?>
<span id="el_cppt_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_reg->getDisplayValue($Page->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_reg" name="x_no_reg" value="<?= HtmlEncode($Page->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_cppt_no_reg">
<input type="<?= $Page->no_reg->getInputTextType() ?>" data-table="cppt" data-field="x_no_reg" name="x_no_reg" id="x_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->no_reg->getPlaceHolder()) ?>" value="<?= $Page->no_reg->EditValue ?>"<?= $Page->no_reg->editAttributes() ?> aria-describedby="x_no_reg_help">
<?= $Page->no_reg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->profesi->Visible) { // profesi ?>
    <div id="r_profesi" class="form-group row">
        <label id="elh_cppt_profesi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->profesi->caption() ?><?= $Page->profesi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->profesi->cellAttributes() ?>>
<span id="el_cppt_profesi">
<template id="tp_x_profesi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_profesi" name="x_profesi" id="x_profesi"<?= $Page->profesi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_profesi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_profesi"
    name="x_profesi"
    value="<?= HtmlEncode($Page->profesi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_profesi"
    data-target="dsl_x_profesi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->profesi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_profesi"
    data-value-separator="<?= $Page->profesi->displayValueSeparatorAttribute() ?>"
    <?= $Page->profesi->editAttributes() ?>>
<?= $Page->profesi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->profesi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hasil_soap->Visible) { // hasil_soap ?>
    <div id="r_hasil_soap" class="form-group row">
        <label id="elh_cppt_hasil_soap" for="x_hasil_soap" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hasil_soap->caption() ?><?= $Page->hasil_soap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hasil_soap->cellAttributes() ?>>
<span id="el_cppt_hasil_soap">
<input type="<?= $Page->hasil_soap->getInputTextType() ?>" data-table="cppt" data-field="x_hasil_soap" name="x_hasil_soap" id="x_hasil_soap" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->hasil_soap->getPlaceHolder()) ?>" value="<?= $Page->hasil_soap->EditValue ?>"<?= $Page->hasil_soap->editAttributes() ?> aria-describedby="x_hasil_soap_help">
<?= $Page->hasil_soap->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hasil_soap->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->instruksi->Visible) { // instruksi ?>
    <div id="r_instruksi" class="form-group row">
        <label id="elh_cppt_instruksi" for="x_instruksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->instruksi->caption() ?><?= $Page->instruksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->instruksi->cellAttributes() ?>>
<span id="el_cppt_instruksi">
<input type="<?= $Page->instruksi->getInputTextType() ?>" data-table="cppt" data-field="x_instruksi" name="x_instruksi" id="x_instruksi" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->instruksi->getPlaceHolder()) ?>" value="<?= $Page->instruksi->EditValue ?>"<?= $Page->instruksi->editAttributes() ?> aria-describedby="x_instruksi_help">
<?= $Page->instruksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->instruksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->verifikasi->Visible) { // verifikasi ?>
    <div id="r_verifikasi" class="form-group row">
        <label id="elh_cppt_verifikasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->verifikasi->caption() ?><?= $Page->verifikasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->verifikasi->cellAttributes() ?>>
<span id="el_cppt_verifikasi">
<template id="tp_x_verifikasi">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="cppt" data-field="x_verifikasi" name="x_verifikasi" id="x_verifikasi"<?= $Page->verifikasi->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_verifikasi" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_verifikasi"
    name="x_verifikasi"
    value="<?= HtmlEncode($Page->verifikasi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_verifikasi"
    data-target="dsl_x_verifikasi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->verifikasi->isInvalidClass() ?>"
    data-table="cppt"
    data-field="x_verifikasi"
    data-value-separator="<?= $Page->verifikasi->displayValueSeparatorAttribute() ?>"
    <?= $Page->verifikasi->editAttributes() ?>>
<?= $Page->verifikasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->verifikasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_input->Visible) { // tanggal_input ?>
    <div id="r_tanggal_input" class="form-group row">
        <label id="elh_cppt_tanggal_input" for="x_tanggal_input" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_input->caption() ?><?= $Page->tanggal_input->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal_input->cellAttributes() ?>>
<span id="el_cppt_tanggal_input">
<input type="<?= $Page->tanggal_input->getInputTextType() ?>" data-table="cppt" data-field="x_tanggal_input" name="x_tanggal_input" id="x_tanggal_input" placeholder="<?= HtmlEncode($Page->tanggal_input->getPlaceHolder()) ?>" value="<?= $Page->tanggal_input->EditValue ?>"<?= $Page->tanggal_input->editAttributes() ?> aria-describedby="x_tanggal_input_help">
<?= $Page->tanggal_input->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_input->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_input->ReadOnly && !$Page->tanggal_input->Disabled && !isset($Page->tanggal_input->EditAttrs["readonly"]) && !isset($Page->tanggal_input->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcpptadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fcpptadd", "x_tanggal_input", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
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
    ew.addEventHandlers("cppt");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
