<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$NotaJalanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fnota_jalanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fnota_jalanedit = currentForm = new ew.Form("fnota_jalanedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "nota_jalan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.nota_jalan)
        ew.vars.tables.nota_jalan = currentTable;
    fnota_jalanedit.addFields([
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["no_nota", [fields.no_nota.visible && fields.no_nota.required ? ew.Validators.required(fields.no_nota.caption) : null], fields.no_nota.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(0)], fields.tanggal.isInvalid],
        ["jam", [fields.jam.visible && fields.jam.required ? ew.Validators.required(fields.jam.caption) : null, ew.Validators.time], fields.jam.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fnota_jalanedit,
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
    fnota_jalanedit.validate = function () {
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
    fnota_jalanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fnota_jalanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fnota_jalanedit");
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
<form name="fnota_jalanedit" id="fnota_jalanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="nota_jalan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_nota_jalan_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="nota_jalan" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
<input type="hidden" data-table="nota_jalan" data-field="x_no_rawat" data-hidden="1" name="o_no_rawat" id="o_no_rawat" value="<?= HtmlEncode($Page->no_rawat->OldValue ?? $Page->no_rawat->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_nota->Visible) { // no_nota ?>
    <div id="r_no_nota" class="form-group row">
        <label id="elh_nota_jalan_no_nota" for="x_no_nota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_nota->caption() ?><?= $Page->no_nota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_nota->cellAttributes() ?>>
<span id="el_nota_jalan_no_nota">
<input type="<?= $Page->no_nota->getInputTextType() ?>" data-table="nota_jalan" data-field="x_no_nota" name="x_no_nota" id="x_no_nota" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_nota->getPlaceHolder()) ?>" value="<?= $Page->no_nota->EditValue ?>"<?= $Page->no_nota->editAttributes() ?> aria-describedby="x_no_nota_help">
<?= $Page->no_nota->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_nota->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <div id="r_tanggal" class="form-group row">
        <label id="elh_nota_jalan_tanggal" for="x_tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal->caption() ?><?= $Page->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_nota_jalan_tanggal">
<input type="<?= $Page->tanggal->getInputTextType() ?>" data-table="nota_jalan" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" placeholder="<?= HtmlEncode($Page->tanggal->getPlaceHolder()) ?>" value="<?= $Page->tanggal->EditValue ?>"<?= $Page->tanggal->editAttributes() ?> aria-describedby="x_tanggal_help">
<?= $Page->tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal->getErrorMessage() ?></div>
<?php if (!$Page->tanggal->ReadOnly && !$Page->tanggal->Disabled && !isset($Page->tanggal->EditAttrs["readonly"]) && !isset($Page->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnota_jalanedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fnota_jalanedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam->Visible) { // jam ?>
    <div id="r_jam" class="form-group row">
        <label id="elh_nota_jalan_jam" for="x_jam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam->caption() ?><?= $Page->jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam->cellAttributes() ?>>
<span id="el_nota_jalan_jam">
<input type="<?= $Page->jam->getInputTextType() ?>" data-table="nota_jalan" data-field="x_jam" name="x_jam" id="x_jam" placeholder="<?= HtmlEncode($Page->jam->getPlaceHolder()) ?>" value="<?= $Page->jam->EditValue ?>"<?= $Page->jam->editAttributes() ?> aria-describedby="x_jam_help">
<?= $Page->jam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam->getErrorMessage() ?></div>
<?php if (!$Page->jam->ReadOnly && !$Page->jam->Disabled && !isset($Page->jam->EditAttrs["readonly"]) && !isset($Page->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnota_jalanedit", "timepicker"], function() {
    ew.createTimePicker("fnota_jalanedit", "x_jam", {"timeFormat":"H:i:s","step":15});
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
    ew.addEventHandlers("nota_jalan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
