<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$ResepDokterEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fresep_dokteredit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fresep_dokteredit = currentForm = new ew.Form("fresep_dokteredit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "resep_dokter")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.resep_dokter)
        ew.vars.tables.resep_dokter = currentTable;
    fresep_dokteredit.addFields([
        ["id_resep_dokter", [fields.id_resep_dokter.visible && fields.id_resep_dokter.required ? ew.Validators.required(fields.id_resep_dokter.caption) : null], fields.id_resep_dokter.isInvalid],
        ["no_reg", [fields.no_reg.visible && fields.no_reg.required ? ew.Validators.required(fields.no_reg.caption) : null, ew.Validators.integer], fields.no_reg.isInvalid],
        ["kode_brng", [fields.kode_brng.visible && fields.kode_brng.required ? ew.Validators.required(fields.kode_brng.caption) : null], fields.kode_brng.isInvalid],
        ["jml", [fields.jml.visible && fields.jml.required ? ew.Validators.required(fields.jml.caption) : null, ew.Validators.float], fields.jml.isInvalid],
        ["aturan_pakai", [fields.aturan_pakai.visible && fields.aturan_pakai.required ? ew.Validators.required(fields.aturan_pakai.caption) : null], fields.aturan_pakai.isInvalid],
        ["tgl_input", [fields.tgl_input.visible && fields.tgl_input.required ? ew.Validators.required(fields.tgl_input.caption) : null], fields.tgl_input.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fresep_dokteredit,
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
    fresep_dokteredit.validate = function () {
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
    fresep_dokteredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fresep_dokteredit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fresep_dokteredit");
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
<form name="fresep_dokteredit" id="fresep_dokteredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resep_dokter">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "vrajal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="vrajal">
<input type="hidden" name="fk_id_reg" value="<?= HtmlEncode($Page->no_reg->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_resep_dokter->Visible) { // id_resep_dokter ?>
    <div id="r_id_resep_dokter" class="form-group row">
        <label id="elh_resep_dokter_id_resep_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_resep_dokter->caption() ?><?= $Page->id_resep_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_resep_dokter->cellAttributes() ?>>
<span id="el_resep_dokter_id_resep_dokter">
<span<?= $Page->id_resep_dokter->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_resep_dokter->getDisplayValue($Page->id_resep_dokter->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="resep_dokter" data-field="x_id_resep_dokter" data-hidden="1" name="x_id_resep_dokter" id="x_id_resep_dokter" value="<?= HtmlEncode($Page->id_resep_dokter->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <div id="r_no_reg" class="form-group row">
        <label id="elh_resep_dokter_no_reg" for="x_no_reg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_reg->caption() ?><?= $Page->no_reg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_reg->cellAttributes() ?>>
<?php if ($Page->no_reg->getSessionValue() != "") { ?>
<span id="el_resep_dokter_no_reg">
<span<?= $Page->no_reg->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_reg->getDisplayValue($Page->no_reg->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_no_reg" name="x_no_reg" value="<?= HtmlEncode($Page->no_reg->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_resep_dokter_no_reg">
<input type="<?= $Page->no_reg->getInputTextType() ?>" data-table="resep_dokter" data-field="x_no_reg" name="x_no_reg" id="x_no_reg" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->no_reg->getPlaceHolder()) ?>" value="<?= $Page->no_reg->EditValue ?>"<?= $Page->no_reg->editAttributes() ?> aria-describedby="x_no_reg_help">
<?= $Page->no_reg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_reg->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_brng->Visible) { // kode_brng ?>
    <div id="r_kode_brng" class="form-group row">
        <label id="elh_resep_dokter_kode_brng" for="x_kode_brng" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_brng->caption() ?><?= $Page->kode_brng->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_brng->cellAttributes() ?>>
<span id="el_resep_dokter_kode_brng">
<input type="<?= $Page->kode_brng->getInputTextType() ?>" data-table="resep_dokter" data-field="x_kode_brng" name="x_kode_brng" id="x_kode_brng" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->kode_brng->getPlaceHolder()) ?>" value="<?= $Page->kode_brng->EditValue ?>"<?= $Page->kode_brng->editAttributes() ?> aria-describedby="x_kode_brng_help">
<?= $Page->kode_brng->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_brng->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jml->Visible) { // jml ?>
    <div id="r_jml" class="form-group row">
        <label id="elh_resep_dokter_jml" for="x_jml" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jml->caption() ?><?= $Page->jml->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jml->cellAttributes() ?>>
<span id="el_resep_dokter_jml">
<input type="<?= $Page->jml->getInputTextType() ?>" data-table="resep_dokter" data-field="x_jml" name="x_jml" id="x_jml" size="30" placeholder="<?= HtmlEncode($Page->jml->getPlaceHolder()) ?>" value="<?= $Page->jml->EditValue ?>"<?= $Page->jml->editAttributes() ?> aria-describedby="x_jml_help">
<?= $Page->jml->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jml->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aturan_pakai->Visible) { // aturan_pakai ?>
    <div id="r_aturan_pakai" class="form-group row">
        <label id="elh_resep_dokter_aturan_pakai" for="x_aturan_pakai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aturan_pakai->caption() ?><?= $Page->aturan_pakai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->aturan_pakai->cellAttributes() ?>>
<span id="el_resep_dokter_aturan_pakai">
<input type="<?= $Page->aturan_pakai->getInputTextType() ?>" data-table="resep_dokter" data-field="x_aturan_pakai" name="x_aturan_pakai" id="x_aturan_pakai" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->aturan_pakai->getPlaceHolder()) ?>" value="<?= $Page->aturan_pakai->EditValue ?>"<?= $Page->aturan_pakai->editAttributes() ?> aria-describedby="x_aturan_pakai_help">
<?= $Page->aturan_pakai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aturan_pakai->getErrorMessage() ?></div>
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
    ew.addEventHandlers("resep_dokter");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
