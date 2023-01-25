<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CaraBayarEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcara_bayaredit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fcara_bayaredit = currentForm = new ew.Form("fcara_bayaredit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "cara_bayar")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.cara_bayar)
        ew.vars.tables.cara_bayar = currentTable;
    fcara_bayaredit.addFields([
        ["id_cara_bayar", [fields.id_cara_bayar.visible && fields.id_cara_bayar.required ? ew.Validators.required(fields.id_cara_bayar.caption) : null], fields.id_cara_bayar.isInvalid],
        ["cara_bayar", [fields.cara_bayar.visible && fields.cara_bayar.required ? ew.Validators.required(fields.cara_bayar.caption) : null], fields.cara_bayar.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcara_bayaredit,
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
    fcara_bayaredit.validate = function () {
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
    fcara_bayaredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcara_bayaredit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fcara_bayaredit");
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
<form name="fcara_bayaredit" id="fcara_bayaredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cara_bayar">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_cara_bayar->Visible) { // id_cara_bayar ?>
    <div id="r_id_cara_bayar" class="form-group row">
        <label id="elh_cara_bayar_id_cara_bayar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_cara_bayar->caption() ?><?= $Page->id_cara_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_cara_bayar->cellAttributes() ?>>
<span id="el_cara_bayar_id_cara_bayar">
<span<?= $Page->id_cara_bayar->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_cara_bayar->getDisplayValue($Page->id_cara_bayar->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="cara_bayar" data-field="x_id_cara_bayar" data-hidden="1" name="x_id_cara_bayar" id="x_id_cara_bayar" value="<?= HtmlEncode($Page->id_cara_bayar->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cara_bayar->Visible) { // cara_bayar ?>
    <div id="r_cara_bayar" class="form-group row">
        <label id="elh_cara_bayar_cara_bayar" for="x_cara_bayar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cara_bayar->caption() ?><?= $Page->cara_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->cara_bayar->cellAttributes() ?>>
<span id="el_cara_bayar_cara_bayar">
<input type="<?= $Page->cara_bayar->getInputTextType() ?>" data-table="cara_bayar" data-field="x_cara_bayar" name="x_cara_bayar" id="x_cara_bayar" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->cara_bayar->getPlaceHolder()) ?>" value="<?= $Page->cara_bayar->EditValue ?>"<?= $Page->cara_bayar->editAttributes() ?> aria-describedby="x_cara_bayar_help">
<?= $Page->cara_bayar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cara_bayar->getErrorMessage() ?></div>
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
    ew.addEventHandlers("cara_bayar");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
