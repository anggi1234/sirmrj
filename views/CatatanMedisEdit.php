<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CatatanMedisEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcatatan_medisedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fcatatan_medisedit = currentForm = new ew.Form("fcatatan_medisedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "catatan_medis")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.catatan_medis)
        ew.vars.tables.catatan_medis = currentTable;
    fcatatan_medisedit.addFields([
        ["id_catatan_medis", [fields.id_catatan_medis.visible && fields.id_catatan_medis.required ? ew.Validators.required(fields.id_catatan_medis.caption) : null], fields.id_catatan_medis.isInvalid],
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null], fields.no_reg.isInvalid],
        ["catatan_medis", [fields.catatan_medis.visible && fields.catatan_medis.required ? ew.Validators.required(fields.catatan_medis.caption) : null], fields.catatan_medis.isInvalid],
        ["tgl_input", [fields.tgl_input.visible && fields.tgl_input.required ? ew.Validators.required(fields.tgl_input.caption) : null], fields.tgl_input.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcatatan_medisedit,
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
    fcatatan_medisedit.validate = function () {
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
    fcatatan_medisedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcatatan_medisedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fcatatan_medisedit");
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
<form name="fcatatan_medisedit" id="fcatatan_medisedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catatan_medis">
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
<?php if ($Page->id_catatan_medis->Visible) { // id_catatan_medis ?>
    <div id="r_id_catatan_medis" class="form-group row">
        <label id="elh_catatan_medis_id_catatan_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_catatan_medis->caption() ?><?= $Page->id_catatan_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_catatan_medis->cellAttributes() ?>>
<span id="el_catatan_medis_id_catatan_medis">
<span<?= $Page->id_catatan_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_catatan_medis->getDisplayValue($Page->id_catatan_medis->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="catatan_medis" data-field="x_id_catatan_medis" data-hidden="1" name="x_id_catatan_medis" id="x_id_catatan_medis" value="<?= HtmlEncode($Page->id_catatan_medis->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <div id="r_no_reg" class="form-group row">
        <label id="elh_catatan_medis_no_reg" for="x_no_reg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_reg->caption() ?><?= $Page->no_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_reg->cellAttributes() ?>>
<?php if ($Page->no_reg->getSessionValue() != "") { ?>
<span id="el_catatan_medis_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_reg->getDisplayValue($Page->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_reg" name="x_no_reg" value="<?= HtmlEncode($Page->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_catatan_medis_no_reg">
<input type="<?= $Page->no_reg->getInputTextType() ?>" data-table="catatan_medis" data-field="x_no_reg" name="x_no_reg" id="x_no_reg" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_reg->getPlaceHolder()) ?>" value="<?= $Page->no_reg->EditValue ?>"<?= $Page->no_reg->editAttributes() ?> aria-describedby="x_no_reg_help">
<?= $Page->no_reg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catatan_medis->Visible) { // catatan_medis ?>
    <div id="r_catatan_medis" class="form-group row">
        <label id="elh_catatan_medis_catatan_medis" for="x_catatan_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catatan_medis->caption() ?><?= $Page->catatan_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catatan_medis->cellAttributes() ?>>
<span id="el_catatan_medis_catatan_medis">
<input type="<?= $Page->catatan_medis->getInputTextType() ?>" data-table="catatan_medis" data-field="x_catatan_medis" name="x_catatan_medis" id="x_catatan_medis" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->catatan_medis->getPlaceHolder()) ?>" value="<?= $Page->catatan_medis->EditValue ?>"<?= $Page->catatan_medis->editAttributes() ?> aria-describedby="x_catatan_medis_help">
<?= $Page->catatan_medis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catatan_medis->getErrorMessage() ?></div>
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
    ew.addEventHandlers("catatan_medis");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
