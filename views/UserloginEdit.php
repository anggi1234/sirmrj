<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$UserloginEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fuserloginedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fuserloginedit = currentForm = new ew.Form("fuserloginedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "userlogin")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.userlogin)
        ew.vars.tables.userlogin = currentTable;
    fuserloginedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["userlevels", [fields.userlevels.visible && fields.userlevels.required ? ew.Validators.required(fields.userlevels.caption) : null], fields.userlevels.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["id_akses", [fields.id_akses.visible && fields.id_akses.required ? ew.Validators.required(fields.id_akses.caption) : null], fields.id_akses.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["dihapus", [fields.dihapus.visible && fields.dihapus.required ? ew.Validators.required(fields.dihapus.caption) : null], fields.dihapus.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fuserloginedit,
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
    fuserloginedit.validate = function () {
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
    fuserloginedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuserloginedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fuserloginedit.lists.userlevels = <?= $Page->userlevels->toClientList($Page) ?>;
    fuserloginedit.lists.id_akses = <?= $Page->id_akses->toClientList($Page) ?>;
    fuserloginedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fuserloginedit.lists.dihapus = <?= $Page->dihapus->toClientList($Page) ?>;
    loadjs.done("fuserloginedit");
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
<form name="fuserloginedit" id="fuserloginedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="userlogin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_userlogin_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_userlogin_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="userlogin" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label id="elh_userlogin__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
<span id="el_userlogin__username">
<input type="<?= $Page->_username->getInputTextType() ?>" data-table="userlogin" data-field="x__username" name="x__username" id="x__username" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" value="<?= $Page->_username->EditValue ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label id="elh_userlogin__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
<span id="el_userlogin__password">
<input type="<?= $Page->_password->getInputTextType() ?>" data-table="userlogin" data-field="x__password" name="x__password" id="x__password" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" value="<?= $Page->_password->EditValue ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->userlevels->Visible) { // userlevels ?>
    <div id="r_userlevels" class="form-group row">
        <label id="elh_userlogin_userlevels" for="x_userlevels" class="<?= $Page->LeftColumnClass ?>"><?= $Page->userlevels->caption() ?><?= $Page->userlevels->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->userlevels->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_userlogin_userlevels">
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->userlevels->getDisplayValue($Page->userlevels->EditValue))) ?>">
</span>
<?php } else { ?>
<span id="el_userlogin_userlevels">
    <select
        id="x_userlevels"
        name="x_userlevels"
        class="form-control ew-select<?= $Page->userlevels->isInvalidClass() ?>"
        data-select2-id="userlogin_x_userlevels"
        data-table="userlogin"
        data-field="x_userlevels"
        data-value-separator="<?= $Page->userlevels->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->userlevels->getPlaceHolder()) ?>"
        <?= $Page->userlevels->editAttributes() ?>>
        <?= $Page->userlevels->selectOptionListHtml("x_userlevels") ?>
    </select>
    <?= $Page->userlevels->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->userlevels->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='userlogin_x_userlevels']"),
        options = { name: "x_userlevels", selectId: "userlogin_x_userlevels", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.userlogin.fields.userlevels.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.userlogin.fields.userlevels.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama" class="form-group row">
        <label id="elh_userlogin_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama->cellAttributes() ?>>
<span id="el_userlogin_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" data-table="userlogin" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" value="<?= $Page->nama->EditValue ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_akses->Visible) { // id_akses ?>
    <div id="r_id_akses" class="form-group row">
        <label id="elh_userlogin_id_akses" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_akses->caption() ?><?= $Page->id_akses->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_akses->cellAttributes() ?>>
<span id="el_userlogin_id_akses">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->id_akses->isInvalidClass() ?>" data-table="userlogin" data-field="x_id_akses" name="x_id_akses[]" id="x_id_akses_309013" value="1"<?= ConvertToBool($Page->id_akses->CurrentValue) ? " checked" : "" ?><?= $Page->id_akses->editAttributes() ?> aria-describedby="x_id_akses_help">
    <label class="custom-control-label" for="x_id_akses_309013"></label>
</div>
<?= $Page->id_akses->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_akses->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_userlogin_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_userlogin_status">
<template id="tp_x_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="userlogin" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="userlogin"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dihapus->Visible) { // dihapus ?>
    <div id="r_dihapus" class="form-group row">
        <label id="elh_userlogin_dihapus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dihapus->caption() ?><?= $Page->dihapus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dihapus->cellAttributes() ?>>
<span id="el_userlogin_dihapus">
<template id="tp_x_dihapus">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="userlogin" data-field="x_dihapus" name="x_dihapus" id="x_dihapus"<?= $Page->dihapus->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_dihapus" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_dihapus"
    name="x_dihapus"
    value="<?= HtmlEncode($Page->dihapus->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_dihapus"
    data-target="dsl_x_dihapus"
    data-repeatcolumn="5"
    class="form-control<?= $Page->dihapus->isInvalidClass() ?>"
    data-table="userlogin"
    data-field="x_dihapus"
    data-value-separator="<?= $Page->dihapus->displayValueSeparatorAttribute() ?>"
    <?= $Page->dihapus->editAttributes() ?>>
<?= $Page->dihapus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dihapus->getErrorMessage() ?></div>
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
    ew.addEventHandlers("userlogin");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
