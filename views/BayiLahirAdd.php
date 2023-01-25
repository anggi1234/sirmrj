<?php

namespace PHPMaker2021\project4sik;

// Page object
$BayiLahirAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbayi_lahiradd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fbayi_lahiradd = currentForm = new ew.Form("fbayi_lahiradd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "bayi_lahir")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.bayi_lahir)
        ew.vars.tables.bayi_lahir = currentTable;
    fbayi_lahiradd.addFields([
        ["nik_ibu_kandung", [fields.nik_ibu_kandung.visible && fields.nik_ibu_kandung.required ? ew.Validators.required(fields.nik_ibu_kandung.caption) : null, ew.Validators.integer], fields.nik_ibu_kandung.isInvalid],
        ["no_rekam_medis", [fields.no_rekam_medis.visible && fields.no_rekam_medis.required ? ew.Validators.required(fields.no_rekam_medis.caption) : null], fields.no_rekam_medis.isInvalid],
        ["tanggal_lahir", [fields.tanggal_lahir.visible && fields.tanggal_lahir.required ? ew.Validators.required(fields.tanggal_lahir.caption) : null, ew.Validators.datetime(0)], fields.tanggal_lahir.isInvalid],
        ["jam_lahir", [fields.jam_lahir.visible && fields.jam_lahir.required ? ew.Validators.required(fields.jam_lahir.caption) : null, ew.Validators.time], fields.jam_lahir.isInvalid],
        ["jenis_kelamin", [fields.jenis_kelamin.visible && fields.jenis_kelamin.required ? ew.Validators.required(fields.jenis_kelamin.caption) : null, ew.Validators.integer], fields.jenis_kelamin.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbayi_lahiradd,
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
    fbayi_lahiradd.validate = function () {
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
    fbayi_lahiradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbayi_lahiradd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbayi_lahiradd");
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
<form name="fbayi_lahiradd" id="fbayi_lahiradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bayi_lahir">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nik_ibu_kandung->Visible) { // nik_ibu_kandung ?>
    <div id="r_nik_ibu_kandung" class="form-group row">
        <label id="elh_bayi_lahir_nik_ibu_kandung" for="x_nik_ibu_kandung" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik_ibu_kandung->caption() ?><?= $Page->nik_ibu_kandung->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik_ibu_kandung->cellAttributes() ?>>
<span id="el_bayi_lahir_nik_ibu_kandung">
<input type="<?= $Page->nik_ibu_kandung->getInputTextType() ?>" data-table="bayi_lahir" data-field="x_nik_ibu_kandung" name="x_nik_ibu_kandung" id="x_nik_ibu_kandung" size="30" placeholder="<?= HtmlEncode($Page->nik_ibu_kandung->getPlaceHolder()) ?>" value="<?= $Page->nik_ibu_kandung->EditValue ?>"<?= $Page->nik_ibu_kandung->editAttributes() ?> aria-describedby="x_nik_ibu_kandung_help">
<?= $Page->nik_ibu_kandung->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik_ibu_kandung->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
    <div id="r_no_rekam_medis" class="form-group row">
        <label id="elh_bayi_lahir_no_rekam_medis" for="x_no_rekam_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rekam_medis->caption() ?><?= $Page->no_rekam_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el_bayi_lahir_no_rekam_medis">
<input type="<?= $Page->no_rekam_medis->getInputTextType() ?>" data-table="bayi_lahir" data-field="x_no_rekam_medis" name="x_no_rekam_medis" id="x_no_rekam_medis" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_rekam_medis->getPlaceHolder()) ?>" value="<?= $Page->no_rekam_medis->EditValue ?>"<?= $Page->no_rekam_medis->editAttributes() ?> aria-describedby="x_no_rekam_medis_help">
<?= $Page->no_rekam_medis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rekam_medis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <div id="r_tanggal_lahir" class="form-group row">
        <label id="elh_bayi_lahir_tanggal_lahir" for="x_tanggal_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_lahir->caption() ?><?= $Page->tanggal_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el_bayi_lahir_tanggal_lahir">
<input type="<?= $Page->tanggal_lahir->getInputTextType() ?>" data-table="bayi_lahir" data-field="x_tanggal_lahir" name="x_tanggal_lahir" id="x_tanggal_lahir" placeholder="<?= HtmlEncode($Page->tanggal_lahir->getPlaceHolder()) ?>" value="<?= $Page->tanggal_lahir->EditValue ?>"<?= $Page->tanggal_lahir->editAttributes() ?> aria-describedby="x_tanggal_lahir_help">
<?= $Page->tanggal_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_lahir->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_lahir->ReadOnly && !$Page->tanggal_lahir->Disabled && !isset($Page->tanggal_lahir->EditAttrs["readonly"]) && !isset($Page->tanggal_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbayi_lahiradd", "datetimepicker"], function() {
    ew.createDateTimePicker("fbayi_lahiradd", "x_tanggal_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_lahir->Visible) { // jam_lahir ?>
    <div id="r_jam_lahir" class="form-group row">
        <label id="elh_bayi_lahir_jam_lahir" for="x_jam_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_lahir->caption() ?><?= $Page->jam_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_lahir->cellAttributes() ?>>
<span id="el_bayi_lahir_jam_lahir">
<input type="<?= $Page->jam_lahir->getInputTextType() ?>" data-table="bayi_lahir" data-field="x_jam_lahir" name="x_jam_lahir" id="x_jam_lahir" placeholder="<?= HtmlEncode($Page->jam_lahir->getPlaceHolder()) ?>" value="<?= $Page->jam_lahir->EditValue ?>"<?= $Page->jam_lahir->editAttributes() ?> aria-describedby="x_jam_lahir_help">
<?= $Page->jam_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_lahir->getErrorMessage() ?></div>
<?php if (!$Page->jam_lahir->ReadOnly && !$Page->jam_lahir->Disabled && !isset($Page->jam_lahir->EditAttrs["readonly"]) && !isset($Page->jam_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbayi_lahiradd", "timepicker"], function() {
    ew.createTimePicker("fbayi_lahiradd", "x_jam_lahir", {"timeFormat":"H:i:s","step":15});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
    <div id="r_jenis_kelamin" class="form-group row">
        <label id="elh_bayi_lahir_jenis_kelamin" for="x_jenis_kelamin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_kelamin->caption() ?><?= $Page->jenis_kelamin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el_bayi_lahir_jenis_kelamin">
<input type="<?= $Page->jenis_kelamin->getInputTextType() ?>" data-table="bayi_lahir" data-field="x_jenis_kelamin" name="x_jenis_kelamin" id="x_jenis_kelamin" size="30" placeholder="<?= HtmlEncode($Page->jenis_kelamin->getPlaceHolder()) ?>" value="<?= $Page->jenis_kelamin->EditValue ?>"<?= $Page->jenis_kelamin->editAttributes() ?> aria-describedby="x_jenis_kelamin_help">
<?= $Page->jenis_kelamin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_kelamin->getErrorMessage() ?></div>
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
    ew.addEventHandlers("bayi_lahir");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
