<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PoliklinikEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpoliklinikedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpoliklinikedit = currentForm = new ew.Form("fpoliklinikedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "poliklinik")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.poliklinik)
        ew.vars.tables.poliklinik = currentTable;
    fpoliklinikedit.addFields([
        ["kd_poli", [fields.kd_poli.visible && fields.kd_poli.required ? ew.Validators.required(fields.kd_poli.caption) : null], fields.kd_poli.isInvalid],
        ["nm_poli", [fields.nm_poli.visible && fields.nm_poli.required ? ew.Validators.required(fields.nm_poli.caption) : null], fields.nm_poli.isInvalid],
        ["registrasi", [fields.registrasi.visible && fields.registrasi.required ? ew.Validators.required(fields.registrasi.caption) : null, ew.Validators.float], fields.registrasi.isInvalid],
        ["registrasilama", [fields.registrasilama.visible && fields.registrasilama.required ? ew.Validators.required(fields.registrasilama.caption) : null, ew.Validators.float], fields.registrasilama.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpoliklinikedit,
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
    fpoliklinikedit.validate = function () {
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
    fpoliklinikedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpoliklinikedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpoliklinikedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fpoliklinikedit");
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
<form name="fpoliklinikedit" id="fpoliklinikedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="poliklinik">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <div id="r_kd_poli" class="form-group row">
        <label id="elh_poliklinik_kd_poli" for="x_kd_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_poli->caption() ?><?= $Page->kd_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_poli->cellAttributes() ?>>
<input type="<?= $Page->kd_poli->getInputTextType() ?>" data-table="poliklinik" data-field="x_kd_poli" name="x_kd_poli" id="x_kd_poli" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->kd_poli->getPlaceHolder()) ?>" value="<?= $Page->kd_poli->EditValue ?>"<?= $Page->kd_poli->editAttributes() ?> aria-describedby="x_kd_poli_help">
<?= $Page->kd_poli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_poli->getErrorMessage() ?></div>
<input type="hidden" data-table="poliklinik" data-field="x_kd_poli" data-hidden="1" name="o_kd_poli" id="o_kd_poli" value="<?= HtmlEncode($Page->kd_poli->OldValue ?? $Page->kd_poli->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nm_poli->Visible) { // nm_poli ?>
    <div id="r_nm_poli" class="form-group row">
        <label id="elh_poliklinik_nm_poli" for="x_nm_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_poli->caption() ?><?= $Page->nm_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_poli->cellAttributes() ?>>
<span id="el_poliklinik_nm_poli">
<input type="<?= $Page->nm_poli->getInputTextType() ?>" data-table="poliklinik" data-field="x_nm_poli" name="x_nm_poli" id="x_nm_poli" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nm_poli->getPlaceHolder()) ?>" value="<?= $Page->nm_poli->EditValue ?>"<?= $Page->nm_poli->editAttributes() ?> aria-describedby="x_nm_poli_help">
<?= $Page->nm_poli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_poli->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->registrasi->Visible) { // registrasi ?>
    <div id="r_registrasi" class="form-group row">
        <label id="elh_poliklinik_registrasi" for="x_registrasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->registrasi->caption() ?><?= $Page->registrasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->registrasi->cellAttributes() ?>>
<span id="el_poliklinik_registrasi">
<input type="<?= $Page->registrasi->getInputTextType() ?>" data-table="poliklinik" data-field="x_registrasi" name="x_registrasi" id="x_registrasi" size="30" placeholder="<?= HtmlEncode($Page->registrasi->getPlaceHolder()) ?>" value="<?= $Page->registrasi->EditValue ?>"<?= $Page->registrasi->editAttributes() ?> aria-describedby="x_registrasi_help">
<?= $Page->registrasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->registrasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->registrasilama->Visible) { // registrasilama ?>
    <div id="r_registrasilama" class="form-group row">
        <label id="elh_poliklinik_registrasilama" for="x_registrasilama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->registrasilama->caption() ?><?= $Page->registrasilama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->registrasilama->cellAttributes() ?>>
<span id="el_poliklinik_registrasilama">
<input type="<?= $Page->registrasilama->getInputTextType() ?>" data-table="poliklinik" data-field="x_registrasilama" name="x_registrasilama" id="x_registrasilama" size="30" placeholder="<?= HtmlEncode($Page->registrasilama->getPlaceHolder()) ?>" value="<?= $Page->registrasilama->EditValue ?>"<?= $Page->registrasilama->editAttributes() ?> aria-describedby="x_registrasilama_help">
<?= $Page->registrasilama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->registrasilama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_poliklinik_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_poliklinik_status">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->status->isInvalidClass() ?>" data-table="poliklinik" data-field="x_status" name="x_status[]" id="x_status_879183" value="1"<?= ConvertToBool($Page->status->CurrentValue) ? " checked" : "" ?><?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
    <label class="custom-control-label" for="x_status_879183"></label>
</div>
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
    ew.addEventHandlers("poliklinik");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
