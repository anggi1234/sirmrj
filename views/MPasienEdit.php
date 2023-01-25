<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MPasienEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_pasienedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fm_pasienedit = currentForm = new ew.Form("fm_pasienedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "m_pasien")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.m_pasien)
        ew.vars.tables.m_pasien = currentTable;
    fm_pasienedit.addFields([
        ["id_pasien", [fields.id_pasien.visible && fields.id_pasien.required ? ew.Validators.required(fields.id_pasien.caption) : null], fields.id_pasien.isInvalid],
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["nm_pasien", [fields.nm_pasien.visible && fields.nm_pasien.required ? ew.Validators.required(fields.nm_pasien.caption) : null], fields.nm_pasien.isInvalid],
        ["kd_pj", [fields.kd_pj.visible && fields.kd_pj.required ? ew.Validators.required(fields.kd_pj.caption) : null], fields.kd_pj.isInvalid],
        ["kd_kel", [fields.kd_kel.visible && fields.kd_kel.required ? ew.Validators.required(fields.kd_kel.caption) : null], fields.kd_kel.isInvalid],
        ["kd_kec", [fields.kd_kec.visible && fields.kd_kec.required ? ew.Validators.required(fields.kd_kec.caption) : null], fields.kd_kec.isInvalid],
        ["kd_kab", [fields.kd_kab.visible && fields.kd_kab.required ? ew.Validators.required(fields.kd_kab.caption) : null], fields.kd_kab.isInvalid],
        ["kd_prop", [fields.kd_prop.visible && fields.kd_prop.required ? ew.Validators.required(fields.kd_prop.caption) : null], fields.kd_prop.isInvalid],
        ["suku_bangsa", [fields.suku_bangsa.visible && fields.suku_bangsa.required ? ew.Validators.required(fields.suku_bangsa.caption) : null], fields.suku_bangsa.isInvalid],
        ["bahasa_pasien", [fields.bahasa_pasien.visible && fields.bahasa_pasien.required ? ew.Validators.required(fields.bahasa_pasien.caption) : null], fields.bahasa_pasien.isInvalid],
        ["cacat_fisik", [fields.cacat_fisik.visible && fields.cacat_fisik.required ? ew.Validators.required(fields.cacat_fisik.caption) : null], fields.cacat_fisik.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fm_pasienedit,
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
    fm_pasienedit.validate = function () {
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
    fm_pasienedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_pasienedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fm_pasienedit.lists.kd_pj = <?= $Page->kd_pj->toClientList($Page) ?>;
    fm_pasienedit.lists.suku_bangsa = <?= $Page->suku_bangsa->toClientList($Page) ?>;
    fm_pasienedit.lists.bahasa_pasien = <?= $Page->bahasa_pasien->toClientList($Page) ?>;
    fm_pasienedit.lists.cacat_fisik = <?= $Page->cacat_fisik->toClientList($Page) ?>;
    loadjs.done("fm_pasienedit");
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
<form name="fm_pasienedit" id="fm_pasienedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_pasien">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_pasien->Visible) { // id_pasien ?>
    <div id="r_id_pasien" class="form-group row">
        <label id="elh_m_pasien_id_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pasien->caption() ?><?= $Page->id_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pasien->cellAttributes() ?>>
<span id="el_m_pasien_id_pasien">
<span<?= $Page->id_pasien->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_pasien->getDisplayValue($Page->id_pasien->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_pasien" data-field="x_id_pasien" data-hidden="1" name="x_id_pasien" id="x_id_pasien" value="<?= HtmlEncode($Page->id_pasien->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <div id="r_no_rkm_medis" class="form-group row">
        <label id="elh_m_pasien_no_rkm_medis" for="x_no_rkm_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rkm_medis->caption() ?><?= $Page->no_rkm_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_m_pasien_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->no_rkm_medis->getDisplayValue($Page->no_rkm_medis->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_pasien" data-field="x_no_rkm_medis" data-hidden="1" name="x_no_rkm_medis" id="x_no_rkm_medis" value="<?= HtmlEncode($Page->no_rkm_medis->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
    <div id="r_nm_pasien" class="form-group row">
        <label id="elh_m_pasien_nm_pasien" for="x_nm_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nm_pasien->caption() ?><?= $Page->nm_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nm_pasien->cellAttributes() ?>>
<span id="el_m_pasien_nm_pasien">
<input type="<?= $Page->nm_pasien->getInputTextType() ?>" data-table="m_pasien" data-field="x_nm_pasien" name="x_nm_pasien" id="x_nm_pasien" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nm_pasien->getPlaceHolder()) ?>" value="<?= $Page->nm_pasien->EditValue ?>"<?= $Page->nm_pasien->editAttributes() ?> aria-describedby="x_nm_pasien_help">
<?= $Page->nm_pasien->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nm_pasien->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_pj->Visible) { // kd_pj ?>
    <div id="r_kd_pj" class="form-group row">
        <label id="elh_m_pasien_kd_pj" for="x_kd_pj" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_pj->caption() ?><?= $Page->kd_pj->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_pj->cellAttributes() ?>>
<span id="el_m_pasien_kd_pj">
    <select
        id="x_kd_pj"
        name="x_kd_pj"
        class="form-control ew-select<?= $Page->kd_pj->isInvalidClass() ?>"
        data-select2-id="m_pasien_x_kd_pj"
        data-table="m_pasien"
        data-field="x_kd_pj"
        data-value-separator="<?= $Page->kd_pj->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kd_pj->getPlaceHolder()) ?>"
        <?= $Page->kd_pj->editAttributes() ?>>
        <?= $Page->kd_pj->selectOptionListHtml("x_kd_pj") ?>
    </select>
    <?= $Page->kd_pj->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kd_pj->getErrorMessage() ?></div>
<?= $Page->kd_pj->Lookup->getParamTag($Page, "p_x_kd_pj") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='m_pasien_x_kd_pj']"),
        options = { name: "x_kd_pj", selectId: "m_pasien_x_kd_pj", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.m_pasien.fields.kd_pj.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kel->Visible) { // kd_kel ?>
    <div id="r_kd_kel" class="form-group row">
        <label id="elh_m_pasien_kd_kel" for="x_kd_kel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kel->caption() ?><?= $Page->kd_kel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kel->cellAttributes() ?>>
<span id="el_m_pasien_kd_kel">
<span<?= $Page->kd_kel->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_kel->getDisplayValue($Page->kd_kel->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_pasien" data-field="x_kd_kel" data-hidden="1" name="x_kd_kel" id="x_kd_kel" value="<?= HtmlEncode($Page->kd_kel->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kec->Visible) { // kd_kec ?>
    <div id="r_kd_kec" class="form-group row">
        <label id="elh_m_pasien_kd_kec" for="x_kd_kec" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kec->caption() ?><?= $Page->kd_kec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kec->cellAttributes() ?>>
<span id="el_m_pasien_kd_kec">
<span<?= $Page->kd_kec->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_kec->getDisplayValue($Page->kd_kec->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_pasien" data-field="x_kd_kec" data-hidden="1" name="x_kd_kec" id="x_kd_kec" value="<?= HtmlEncode($Page->kd_kec->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_kab->Visible) { // kd_kab ?>
    <div id="r_kd_kab" class="form-group row">
        <label id="elh_m_pasien_kd_kab" for="x_kd_kab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_kab->caption() ?><?= $Page->kd_kab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_kab->cellAttributes() ?>>
<span id="el_m_pasien_kd_kab">
<span<?= $Page->kd_kab->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_kab->getDisplayValue($Page->kd_kab->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_pasien" data-field="x_kd_kab" data-hidden="1" name="x_kd_kab" id="x_kd_kab" value="<?= HtmlEncode($Page->kd_kab->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_prop->Visible) { // kd_prop ?>
    <div id="r_kd_prop" class="form-group row">
        <label id="elh_m_pasien_kd_prop" for="x_kd_prop" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_prop->caption() ?><?= $Page->kd_prop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_prop->cellAttributes() ?>>
<span id="el_m_pasien_kd_prop">
<span<?= $Page->kd_prop->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->kd_prop->getDisplayValue($Page->kd_prop->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_pasien" data-field="x_kd_prop" data-hidden="1" name="x_kd_prop" id="x_kd_prop" value="<?= HtmlEncode($Page->kd_prop->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suku_bangsa->Visible) { // suku_bangsa ?>
    <div id="r_suku_bangsa" class="form-group row">
        <label id="elh_m_pasien_suku_bangsa" for="x_suku_bangsa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suku_bangsa->caption() ?><?= $Page->suku_bangsa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suku_bangsa->cellAttributes() ?>>
<span id="el_m_pasien_suku_bangsa">
    <select
        id="x_suku_bangsa"
        name="x_suku_bangsa"
        class="form-control ew-select<?= $Page->suku_bangsa->isInvalidClass() ?>"
        data-select2-id="m_pasien_x_suku_bangsa"
        data-table="m_pasien"
        data-field="x_suku_bangsa"
        data-value-separator="<?= $Page->suku_bangsa->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->suku_bangsa->getPlaceHolder()) ?>"
        <?= $Page->suku_bangsa->editAttributes() ?>>
        <?= $Page->suku_bangsa->selectOptionListHtml("x_suku_bangsa") ?>
    </select>
    <?= $Page->suku_bangsa->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->suku_bangsa->getErrorMessage() ?></div>
<?= $Page->suku_bangsa->Lookup->getParamTag($Page, "p_x_suku_bangsa") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='m_pasien_x_suku_bangsa']"),
        options = { name: "x_suku_bangsa", selectId: "m_pasien_x_suku_bangsa", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.m_pasien.fields.suku_bangsa.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bahasa_pasien->Visible) { // bahasa_pasien ?>
    <div id="r_bahasa_pasien" class="form-group row">
        <label id="elh_m_pasien_bahasa_pasien" for="x_bahasa_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bahasa_pasien->caption() ?><?= $Page->bahasa_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bahasa_pasien->cellAttributes() ?>>
<span id="el_m_pasien_bahasa_pasien">
    <select
        id="x_bahasa_pasien"
        name="x_bahasa_pasien"
        class="form-control ew-select<?= $Page->bahasa_pasien->isInvalidClass() ?>"
        data-select2-id="m_pasien_x_bahasa_pasien"
        data-table="m_pasien"
        data-field="x_bahasa_pasien"
        data-value-separator="<?= $Page->bahasa_pasien->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->bahasa_pasien->getPlaceHolder()) ?>"
        <?= $Page->bahasa_pasien->editAttributes() ?>>
        <?= $Page->bahasa_pasien->selectOptionListHtml("x_bahasa_pasien") ?>
    </select>
    <?= $Page->bahasa_pasien->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->bahasa_pasien->getErrorMessage() ?></div>
<?= $Page->bahasa_pasien->Lookup->getParamTag($Page, "p_x_bahasa_pasien") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='m_pasien_x_bahasa_pasien']"),
        options = { name: "x_bahasa_pasien", selectId: "m_pasien_x_bahasa_pasien", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.m_pasien.fields.bahasa_pasien.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cacat_fisik->Visible) { // cacat_fisik ?>
    <div id="r_cacat_fisik" class="form-group row">
        <label id="elh_m_pasien_cacat_fisik" for="x_cacat_fisik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cacat_fisik->caption() ?><?= $Page->cacat_fisik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->cacat_fisik->cellAttributes() ?>>
<span id="el_m_pasien_cacat_fisik">
    <select
        id="x_cacat_fisik"
        name="x_cacat_fisik"
        class="form-control ew-select<?= $Page->cacat_fisik->isInvalidClass() ?>"
        data-select2-id="m_pasien_x_cacat_fisik"
        data-table="m_pasien"
        data-field="x_cacat_fisik"
        data-value-separator="<?= $Page->cacat_fisik->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->cacat_fisik->getPlaceHolder()) ?>"
        <?= $Page->cacat_fisik->editAttributes() ?>>
        <?= $Page->cacat_fisik->selectOptionListHtml("x_cacat_fisik") ?>
    </select>
    <?= $Page->cacat_fisik->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->cacat_fisik->getErrorMessage() ?></div>
<?= $Page->cacat_fisik->Lookup->getParamTag($Page, "p_x_cacat_fisik") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='m_pasien_x_cacat_fisik']"),
        options = { name: "x_cacat_fisik", selectId: "m_pasien_x_cacat_fisik", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.m_pasien.fields.cacat_fisik.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("m_pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
