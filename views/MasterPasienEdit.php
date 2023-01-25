<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MasterPasienEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fmaster_pasienedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fmaster_pasienedit = currentForm = new ew.Form("fmaster_pasienedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "master_pasien")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.master_pasien)
        ew.vars.tables.master_pasien = currentTable;
    fmaster_pasienedit.addFields([
        ["id_pasien", [fields.id_pasien.visible && fields.id_pasien.required ? ew.Validators.required(fields.id_pasien.caption) : null], fields.id_pasien.isInvalid],
        ["nama_pasien", [fields.nama_pasien.visible && fields.nama_pasien.required ? ew.Validators.required(fields.nama_pasien.caption) : null], fields.nama_pasien.isInvalid],
        ["no_rekam_medis", [fields.no_rekam_medis.visible && fields.no_rekam_medis.required ? ew.Validators.required(fields.no_rekam_medis.caption) : null], fields.no_rekam_medis.isInvalid],
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null, ew.Validators.integer], fields.nik.isInvalid],
        ["no_identitas_lain", [fields.no_identitas_lain.visible && fields.no_identitas_lain.required ? ew.Validators.required(fields.no_identitas_lain.caption) : null], fields.no_identitas_lain.isInvalid],
        ["nama_ibu", [fields.nama_ibu.visible && fields.nama_ibu.required ? ew.Validators.required(fields.nama_ibu.caption) : null], fields.nama_ibu.isInvalid],
        ["tempat_lahir", [fields.tempat_lahir.visible && fields.tempat_lahir.required ? ew.Validators.required(fields.tempat_lahir.caption) : null], fields.tempat_lahir.isInvalid],
        ["tanggal_lahir", [fields.tanggal_lahir.visible && fields.tanggal_lahir.required ? ew.Validators.required(fields.tanggal_lahir.caption) : null, ew.Validators.datetime(0)], fields.tanggal_lahir.isInvalid],
        ["jenis_kelamin", [fields.jenis_kelamin.visible && fields.jenis_kelamin.required ? ew.Validators.required(fields.jenis_kelamin.caption) : null, ew.Validators.integer], fields.jenis_kelamin.isInvalid],
        ["agama", [fields.agama.visible && fields.agama.required ? ew.Validators.required(fields.agama.caption) : null, ew.Validators.integer], fields.agama.isInvalid],
        ["suku", [fields.suku.visible && fields.suku.required ? ew.Validators.required(fields.suku.caption) : null], fields.suku.isInvalid],
        ["bahasa", [fields.bahasa.visible && fields.bahasa.required ? ew.Validators.required(fields.bahasa.caption) : null, ew.Validators.integer], fields.bahasa.isInvalid],
        ["alamat", [fields.alamat.visible && fields.alamat.required ? ew.Validators.required(fields.alamat.caption) : null], fields.alamat.isInvalid],
        ["rt", [fields.rt.visible && fields.rt.required ? ew.Validators.required(fields.rt.caption) : null, ew.Validators.integer], fields.rt.isInvalid],
        ["rw", [fields.rw.visible && fields.rw.required ? ew.Validators.required(fields.rw.caption) : null, ew.Validators.integer], fields.rw.isInvalid],
        ["keluarahan_desa", [fields.keluarahan_desa.visible && fields.keluarahan_desa.required ? ew.Validators.required(fields.keluarahan_desa.caption) : null], fields.keluarahan_desa.isInvalid],
        ["kecamatan", [fields.kecamatan.visible && fields.kecamatan.required ? ew.Validators.required(fields.kecamatan.caption) : null], fields.kecamatan.isInvalid],
        ["kabupaten_kota", [fields.kabupaten_kota.visible && fields.kabupaten_kota.required ? ew.Validators.required(fields.kabupaten_kota.caption) : null], fields.kabupaten_kota.isInvalid],
        ["kodepos", [fields.kodepos.visible && fields.kodepos.required ? ew.Validators.required(fields.kodepos.caption) : null, ew.Validators.integer], fields.kodepos.isInvalid],
        ["provinsi", [fields.provinsi.visible && fields.provinsi.required ? ew.Validators.required(fields.provinsi.caption) : null], fields.provinsi.isInvalid],
        ["negara", [fields.negara.visible && fields.negara.required ? ew.Validators.required(fields.negara.caption) : null], fields.negara.isInvalid],
        ["alamat_domisili", [fields.alamat_domisili.visible && fields.alamat_domisili.required ? ew.Validators.required(fields.alamat_domisili.caption) : null], fields.alamat_domisili.isInvalid],
        ["rt_domisili", [fields.rt_domisili.visible && fields.rt_domisili.required ? ew.Validators.required(fields.rt_domisili.caption) : null], fields.rt_domisili.isInvalid],
        ["rw_domisili", [fields.rw_domisili.visible && fields.rw_domisili.required ? ew.Validators.required(fields.rw_domisili.caption) : null], fields.rw_domisili.isInvalid],
        ["kel_desa_domisili", [fields.kel_desa_domisili.visible && fields.kel_desa_domisili.required ? ew.Validators.required(fields.kel_desa_domisili.caption) : null], fields.kel_desa_domisili.isInvalid],
        ["kec_domisili", [fields.kec_domisili.visible && fields.kec_domisili.required ? ew.Validators.required(fields.kec_domisili.caption) : null], fields.kec_domisili.isInvalid],
        ["kota_kab_domisili", [fields.kota_kab_domisili.visible && fields.kota_kab_domisili.required ? ew.Validators.required(fields.kota_kab_domisili.caption) : null], fields.kota_kab_domisili.isInvalid],
        ["kodepos_domisili", [fields.kodepos_domisili.visible && fields.kodepos_domisili.required ? ew.Validators.required(fields.kodepos_domisili.caption) : null], fields.kodepos_domisili.isInvalid],
        ["prov_domisili", [fields.prov_domisili.visible && fields.prov_domisili.required ? ew.Validators.required(fields.prov_domisili.caption) : null], fields.prov_domisili.isInvalid],
        ["negara_domisili", [fields.negara_domisili.visible && fields.negara_domisili.required ? ew.Validators.required(fields.negara_domisili.caption) : null], fields.negara_domisili.isInvalid],
        ["no_telp", [fields.no_telp.visible && fields.no_telp.required ? ew.Validators.required(fields.no_telp.caption) : null, ew.Validators.integer], fields.no_telp.isInvalid],
        ["no_hp", [fields.no_hp.visible && fields.no_hp.required ? ew.Validators.required(fields.no_hp.caption) : null, ew.Validators.integer], fields.no_hp.isInvalid],
        ["pendidikan", [fields.pendidikan.visible && fields.pendidikan.required ? ew.Validators.required(fields.pendidikan.caption) : null, ew.Validators.integer], fields.pendidikan.isInvalid],
        ["pekerjaan", [fields.pekerjaan.visible && fields.pekerjaan.required ? ew.Validators.required(fields.pekerjaan.caption) : null, ew.Validators.integer], fields.pekerjaan.isInvalid],
        ["status_kawin", [fields.status_kawin.visible && fields.status_kawin.required ? ew.Validators.required(fields.status_kawin.caption) : null, ew.Validators.integer], fields.status_kawin.isInvalid],
        ["tgl_daftar", [fields.tgl_daftar.visible && fields.tgl_daftar.required ? ew.Validators.required(fields.tgl_daftar.caption) : null, ew.Validators.datetime(0)], fields.tgl_daftar.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fmaster_pasienedit,
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
    fmaster_pasienedit.validate = function () {
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
    fmaster_pasienedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmaster_pasienedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fmaster_pasienedit");
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
<form name="fmaster_pasienedit" id="fmaster_pasienedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="master_pasien">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_pasien->Visible) { // id_pasien ?>
    <div id="r_id_pasien" class="form-group row">
        <label id="elh_master_pasien_id_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pasien->caption() ?><?= $Page->id_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pasien->cellAttributes() ?>>
<span id="el_master_pasien_id_pasien">
<span<?= $Page->id_pasien->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_pasien->getDisplayValue($Page->id_pasien->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="master_pasien" data-field="x_id_pasien" data-hidden="1" name="x_id_pasien" id="x_id_pasien" value="<?= HtmlEncode($Page->id_pasien->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
    <div id="r_nama_pasien" class="form-group row">
        <label id="elh_master_pasien_nama_pasien" for="x_nama_pasien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_pasien->caption() ?><?= $Page->nama_pasien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_pasien->cellAttributes() ?>>
<span id="el_master_pasien_nama_pasien">
<input type="<?= $Page->nama_pasien->getInputTextType() ?>" data-table="master_pasien" data-field="x_nama_pasien" name="x_nama_pasien" id="x_nama_pasien" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_pasien->getPlaceHolder()) ?>" value="<?= $Page->nama_pasien->EditValue ?>"<?= $Page->nama_pasien->editAttributes() ?> aria-describedby="x_nama_pasien_help">
<?= $Page->nama_pasien->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_pasien->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
    <div id="r_no_rekam_medis" class="form-group row">
        <label id="elh_master_pasien_no_rekam_medis" for="x_no_rekam_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rekam_medis->caption() ?><?= $Page->no_rekam_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el_master_pasien_no_rekam_medis">
<input type="<?= $Page->no_rekam_medis->getInputTextType() ?>" data-table="master_pasien" data-field="x_no_rekam_medis" name="x_no_rekam_medis" id="x_no_rekam_medis" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->no_rekam_medis->getPlaceHolder()) ?>" value="<?= $Page->no_rekam_medis->EditValue ?>"<?= $Page->no_rekam_medis->editAttributes() ?> aria-describedby="x_no_rekam_medis_help">
<?= $Page->no_rekam_medis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rekam_medis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_master_pasien_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_master_pasien_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="master_pasien" data-field="x_nik" name="x_nik" id="x_nik" size="30" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_identitas_lain->Visible) { // no_identitas_lain ?>
    <div id="r_no_identitas_lain" class="form-group row">
        <label id="elh_master_pasien_no_identitas_lain" for="x_no_identitas_lain" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_identitas_lain->caption() ?><?= $Page->no_identitas_lain->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_identitas_lain->cellAttributes() ?>>
<span id="el_master_pasien_no_identitas_lain">
<input type="<?= $Page->no_identitas_lain->getInputTextType() ?>" data-table="master_pasien" data-field="x_no_identitas_lain" name="x_no_identitas_lain" id="x_no_identitas_lain" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->no_identitas_lain->getPlaceHolder()) ?>" value="<?= $Page->no_identitas_lain->EditValue ?>"<?= $Page->no_identitas_lain->editAttributes() ?> aria-describedby="x_no_identitas_lain_help">
<?= $Page->no_identitas_lain->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_identitas_lain->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
    <div id="r_nama_ibu" class="form-group row">
        <label id="elh_master_pasien_nama_ibu" for="x_nama_ibu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_ibu->caption() ?><?= $Page->nama_ibu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_ibu->cellAttributes() ?>>
<span id="el_master_pasien_nama_ibu">
<input type="<?= $Page->nama_ibu->getInputTextType() ?>" data-table="master_pasien" data-field="x_nama_ibu" name="x_nama_ibu" id="x_nama_ibu" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_ibu->getPlaceHolder()) ?>" value="<?= $Page->nama_ibu->EditValue ?>"<?= $Page->nama_ibu->editAttributes() ?> aria-describedby="x_nama_ibu_help">
<?= $Page->nama_ibu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_ibu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
    <div id="r_tempat_lahir" class="form-group row">
        <label id="elh_master_pasien_tempat_lahir" for="x_tempat_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tempat_lahir->caption() ?><?= $Page->tempat_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tempat_lahir->cellAttributes() ?>>
<span id="el_master_pasien_tempat_lahir">
<input type="<?= $Page->tempat_lahir->getInputTextType() ?>" data-table="master_pasien" data-field="x_tempat_lahir" name="x_tempat_lahir" id="x_tempat_lahir" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->tempat_lahir->getPlaceHolder()) ?>" value="<?= $Page->tempat_lahir->EditValue ?>"<?= $Page->tempat_lahir->editAttributes() ?> aria-describedby="x_tempat_lahir_help">
<?= $Page->tempat_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tempat_lahir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <div id="r_tanggal_lahir" class="form-group row">
        <label id="elh_master_pasien_tanggal_lahir" for="x_tanggal_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_lahir->caption() ?><?= $Page->tanggal_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el_master_pasien_tanggal_lahir">
<input type="<?= $Page->tanggal_lahir->getInputTextType() ?>" data-table="master_pasien" data-field="x_tanggal_lahir" name="x_tanggal_lahir" id="x_tanggal_lahir" placeholder="<?= HtmlEncode($Page->tanggal_lahir->getPlaceHolder()) ?>" value="<?= $Page->tanggal_lahir->EditValue ?>"<?= $Page->tanggal_lahir->editAttributes() ?> aria-describedby="x_tanggal_lahir_help">
<?= $Page->tanggal_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_lahir->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_lahir->ReadOnly && !$Page->tanggal_lahir->Disabled && !isset($Page->tanggal_lahir->EditAttrs["readonly"]) && !isset($Page->tanggal_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaster_pasienedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fmaster_pasienedit", "x_tanggal_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
    <div id="r_jenis_kelamin" class="form-group row">
        <label id="elh_master_pasien_jenis_kelamin" for="x_jenis_kelamin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_kelamin->caption() ?><?= $Page->jenis_kelamin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el_master_pasien_jenis_kelamin">
<input type="<?= $Page->jenis_kelamin->getInputTextType() ?>" data-table="master_pasien" data-field="x_jenis_kelamin" name="x_jenis_kelamin" id="x_jenis_kelamin" size="30" placeholder="<?= HtmlEncode($Page->jenis_kelamin->getPlaceHolder()) ?>" value="<?= $Page->jenis_kelamin->EditValue ?>"<?= $Page->jenis_kelamin->editAttributes() ?> aria-describedby="x_jenis_kelamin_help">
<?= $Page->jenis_kelamin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_kelamin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <div id="r_agama" class="form-group row">
        <label id="elh_master_pasien_agama" for="x_agama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->agama->caption() ?><?= $Page->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->agama->cellAttributes() ?>>
<span id="el_master_pasien_agama">
<input type="<?= $Page->agama->getInputTextType() ?>" data-table="master_pasien" data-field="x_agama" name="x_agama" id="x_agama" size="30" placeholder="<?= HtmlEncode($Page->agama->getPlaceHolder()) ?>" value="<?= $Page->agama->EditValue ?>"<?= $Page->agama->editAttributes() ?> aria-describedby="x_agama_help">
<?= $Page->agama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->agama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->suku->Visible) { // suku ?>
    <div id="r_suku" class="form-group row">
        <label id="elh_master_pasien_suku" for="x_suku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->suku->caption() ?><?= $Page->suku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->suku->cellAttributes() ?>>
<span id="el_master_pasien_suku">
<input type="<?= $Page->suku->getInputTextType() ?>" data-table="master_pasien" data-field="x_suku" name="x_suku" id="x_suku" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->suku->getPlaceHolder()) ?>" value="<?= $Page->suku->EditValue ?>"<?= $Page->suku->editAttributes() ?> aria-describedby="x_suku_help">
<?= $Page->suku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->suku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bahasa->Visible) { // bahasa ?>
    <div id="r_bahasa" class="form-group row">
        <label id="elh_master_pasien_bahasa" for="x_bahasa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bahasa->caption() ?><?= $Page->bahasa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bahasa->cellAttributes() ?>>
<span id="el_master_pasien_bahasa">
<input type="<?= $Page->bahasa->getInputTextType() ?>" data-table="master_pasien" data-field="x_bahasa" name="x_bahasa" id="x_bahasa" size="30" placeholder="<?= HtmlEncode($Page->bahasa->getPlaceHolder()) ?>" value="<?= $Page->bahasa->EditValue ?>"<?= $Page->bahasa->editAttributes() ?> aria-describedby="x_bahasa_help">
<?= $Page->bahasa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bahasa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <div id="r_alamat" class="form-group row">
        <label id="elh_master_pasien_alamat" for="x_alamat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat->caption() ?><?= $Page->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alamat->cellAttributes() ?>>
<span id="el_master_pasien_alamat">
<input type="<?= $Page->alamat->getInputTextType() ?>" data-table="master_pasien" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>" value="<?= $Page->alamat->EditValue ?>"<?= $Page->alamat->editAttributes() ?> aria-describedby="x_alamat_help">
<?= $Page->alamat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rt->Visible) { // rt ?>
    <div id="r_rt" class="form-group row">
        <label id="elh_master_pasien_rt" for="x_rt" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rt->caption() ?><?= $Page->rt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rt->cellAttributes() ?>>
<span id="el_master_pasien_rt">
<input type="<?= $Page->rt->getInputTextType() ?>" data-table="master_pasien" data-field="x_rt" name="x_rt" id="x_rt" size="30" placeholder="<?= HtmlEncode($Page->rt->getPlaceHolder()) ?>" value="<?= $Page->rt->EditValue ?>"<?= $Page->rt->editAttributes() ?> aria-describedby="x_rt_help">
<?= $Page->rt->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rt->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rw->Visible) { // rw ?>
    <div id="r_rw" class="form-group row">
        <label id="elh_master_pasien_rw" for="x_rw" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rw->caption() ?><?= $Page->rw->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rw->cellAttributes() ?>>
<span id="el_master_pasien_rw">
<input type="<?= $Page->rw->getInputTextType() ?>" data-table="master_pasien" data-field="x_rw" name="x_rw" id="x_rw" size="30" placeholder="<?= HtmlEncode($Page->rw->getPlaceHolder()) ?>" value="<?= $Page->rw->EditValue ?>"<?= $Page->rw->editAttributes() ?> aria-describedby="x_rw_help">
<?= $Page->rw->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rw->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keluarahan_desa->Visible) { // keluarahan_desa ?>
    <div id="r_keluarahan_desa" class="form-group row">
        <label id="elh_master_pasien_keluarahan_desa" for="x_keluarahan_desa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keluarahan_desa->caption() ?><?= $Page->keluarahan_desa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keluarahan_desa->cellAttributes() ?>>
<span id="el_master_pasien_keluarahan_desa">
<input type="<?= $Page->keluarahan_desa->getInputTextType() ?>" data-table="master_pasien" data-field="x_keluarahan_desa" name="x_keluarahan_desa" id="x_keluarahan_desa" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keluarahan_desa->getPlaceHolder()) ?>" value="<?= $Page->keluarahan_desa->EditValue ?>"<?= $Page->keluarahan_desa->editAttributes() ?> aria-describedby="x_keluarahan_desa_help">
<?= $Page->keluarahan_desa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keluarahan_desa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kecamatan->Visible) { // kecamatan ?>
    <div id="r_kecamatan" class="form-group row">
        <label id="elh_master_pasien_kecamatan" for="x_kecamatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kecamatan->caption() ?><?= $Page->kecamatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kecamatan->cellAttributes() ?>>
<span id="el_master_pasien_kecamatan">
<input type="<?= $Page->kecamatan->getInputTextType() ?>" data-table="master_pasien" data-field="x_kecamatan" name="x_kecamatan" id="x_kecamatan" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->kecamatan->getPlaceHolder()) ?>" value="<?= $Page->kecamatan->EditValue ?>"<?= $Page->kecamatan->editAttributes() ?> aria-describedby="x_kecamatan_help">
<?= $Page->kecamatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kecamatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kabupaten_kota->Visible) { // kabupaten_kota ?>
    <div id="r_kabupaten_kota" class="form-group row">
        <label id="elh_master_pasien_kabupaten_kota" for="x_kabupaten_kota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kabupaten_kota->caption() ?><?= $Page->kabupaten_kota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kabupaten_kota->cellAttributes() ?>>
<span id="el_master_pasien_kabupaten_kota">
<input type="<?= $Page->kabupaten_kota->getInputTextType() ?>" data-table="master_pasien" data-field="x_kabupaten_kota" name="x_kabupaten_kota" id="x_kabupaten_kota" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->kabupaten_kota->getPlaceHolder()) ?>" value="<?= $Page->kabupaten_kota->EditValue ?>"<?= $Page->kabupaten_kota->editAttributes() ?> aria-describedby="x_kabupaten_kota_help">
<?= $Page->kabupaten_kota->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kabupaten_kota->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kodepos->Visible) { // kodepos ?>
    <div id="r_kodepos" class="form-group row">
        <label id="elh_master_pasien_kodepos" for="x_kodepos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kodepos->caption() ?><?= $Page->kodepos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kodepos->cellAttributes() ?>>
<span id="el_master_pasien_kodepos">
<input type="<?= $Page->kodepos->getInputTextType() ?>" data-table="master_pasien" data-field="x_kodepos" name="x_kodepos" id="x_kodepos" size="30" placeholder="<?= HtmlEncode($Page->kodepos->getPlaceHolder()) ?>" value="<?= $Page->kodepos->EditValue ?>"<?= $Page->kodepos->editAttributes() ?> aria-describedby="x_kodepos_help">
<?= $Page->kodepos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kodepos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->provinsi->Visible) { // provinsi ?>
    <div id="r_provinsi" class="form-group row">
        <label id="elh_master_pasien_provinsi" for="x_provinsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->provinsi->caption() ?><?= $Page->provinsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->provinsi->cellAttributes() ?>>
<span id="el_master_pasien_provinsi">
<input type="<?= $Page->provinsi->getInputTextType() ?>" data-table="master_pasien" data-field="x_provinsi" name="x_provinsi" id="x_provinsi" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->provinsi->getPlaceHolder()) ?>" value="<?= $Page->provinsi->EditValue ?>"<?= $Page->provinsi->editAttributes() ?> aria-describedby="x_provinsi_help">
<?= $Page->provinsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->provinsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->negara->Visible) { // negara ?>
    <div id="r_negara" class="form-group row">
        <label id="elh_master_pasien_negara" for="x_negara" class="<?= $Page->LeftColumnClass ?>"><?= $Page->negara->caption() ?><?= $Page->negara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->negara->cellAttributes() ?>>
<span id="el_master_pasien_negara">
<input type="<?= $Page->negara->getInputTextType() ?>" data-table="master_pasien" data-field="x_negara" name="x_negara" id="x_negara" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->negara->getPlaceHolder()) ?>" value="<?= $Page->negara->EditValue ?>"<?= $Page->negara->editAttributes() ?> aria-describedby="x_negara_help">
<?= $Page->negara->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->negara->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat_domisili->Visible) { // alamat_domisili ?>
    <div id="r_alamat_domisili" class="form-group row">
        <label id="elh_master_pasien_alamat_domisili" for="x_alamat_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat_domisili->caption() ?><?= $Page->alamat_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alamat_domisili->cellAttributes() ?>>
<span id="el_master_pasien_alamat_domisili">
<input type="<?= $Page->alamat_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_alamat_domisili" name="x_alamat_domisili" id="x_alamat_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->alamat_domisili->getPlaceHolder()) ?>" value="<?= $Page->alamat_domisili->EditValue ?>"<?= $Page->alamat_domisili->editAttributes() ?> aria-describedby="x_alamat_domisili_help">
<?= $Page->alamat_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rt_domisili->Visible) { // rt_domisili ?>
    <div id="r_rt_domisili" class="form-group row">
        <label id="elh_master_pasien_rt_domisili" for="x_rt_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rt_domisili->caption() ?><?= $Page->rt_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rt_domisili->cellAttributes() ?>>
<span id="el_master_pasien_rt_domisili">
<input type="<?= $Page->rt_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_rt_domisili" name="x_rt_domisili" id="x_rt_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->rt_domisili->getPlaceHolder()) ?>" value="<?= $Page->rt_domisili->EditValue ?>"<?= $Page->rt_domisili->editAttributes() ?> aria-describedby="x_rt_domisili_help">
<?= $Page->rt_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rt_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rw_domisili->Visible) { // rw_domisili ?>
    <div id="r_rw_domisili" class="form-group row">
        <label id="elh_master_pasien_rw_domisili" for="x_rw_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rw_domisili->caption() ?><?= $Page->rw_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rw_domisili->cellAttributes() ?>>
<span id="el_master_pasien_rw_domisili">
<input type="<?= $Page->rw_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_rw_domisili" name="x_rw_domisili" id="x_rw_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->rw_domisili->getPlaceHolder()) ?>" value="<?= $Page->rw_domisili->EditValue ?>"<?= $Page->rw_domisili->editAttributes() ?> aria-describedby="x_rw_domisili_help">
<?= $Page->rw_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rw_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kel_desa_domisili->Visible) { // kel_desa_domisili ?>
    <div id="r_kel_desa_domisili" class="form-group row">
        <label id="elh_master_pasien_kel_desa_domisili" for="x_kel_desa_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kel_desa_domisili->caption() ?><?= $Page->kel_desa_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kel_desa_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kel_desa_domisili">
<input type="<?= $Page->kel_desa_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_kel_desa_domisili" name="x_kel_desa_domisili" id="x_kel_desa_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->kel_desa_domisili->getPlaceHolder()) ?>" value="<?= $Page->kel_desa_domisili->EditValue ?>"<?= $Page->kel_desa_domisili->editAttributes() ?> aria-describedby="x_kel_desa_domisili_help">
<?= $Page->kel_desa_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kel_desa_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kec_domisili->Visible) { // kec_domisili ?>
    <div id="r_kec_domisili" class="form-group row">
        <label id="elh_master_pasien_kec_domisili" for="x_kec_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kec_domisili->caption() ?><?= $Page->kec_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kec_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kec_domisili">
<input type="<?= $Page->kec_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_kec_domisili" name="x_kec_domisili" id="x_kec_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->kec_domisili->getPlaceHolder()) ?>" value="<?= $Page->kec_domisili->EditValue ?>"<?= $Page->kec_domisili->editAttributes() ?> aria-describedby="x_kec_domisili_help">
<?= $Page->kec_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kec_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kota_kab_domisili->Visible) { // kota_kab_domisili ?>
    <div id="r_kota_kab_domisili" class="form-group row">
        <label id="elh_master_pasien_kota_kab_domisili" for="x_kota_kab_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kota_kab_domisili->caption() ?><?= $Page->kota_kab_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kota_kab_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kota_kab_domisili">
<input type="<?= $Page->kota_kab_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_kota_kab_domisili" name="x_kota_kab_domisili" id="x_kota_kab_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->kota_kab_domisili->getPlaceHolder()) ?>" value="<?= $Page->kota_kab_domisili->EditValue ?>"<?= $Page->kota_kab_domisili->editAttributes() ?> aria-describedby="x_kota_kab_domisili_help">
<?= $Page->kota_kab_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kota_kab_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kodepos_domisili->Visible) { // kodepos_domisili ?>
    <div id="r_kodepos_domisili" class="form-group row">
        <label id="elh_master_pasien_kodepos_domisili" for="x_kodepos_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kodepos_domisili->caption() ?><?= $Page->kodepos_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kodepos_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kodepos_domisili">
<input type="<?= $Page->kodepos_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_kodepos_domisili" name="x_kodepos_domisili" id="x_kodepos_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->kodepos_domisili->getPlaceHolder()) ?>" value="<?= $Page->kodepos_domisili->EditValue ?>"<?= $Page->kodepos_domisili->editAttributes() ?> aria-describedby="x_kodepos_domisili_help">
<?= $Page->kodepos_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kodepos_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prov_domisili->Visible) { // prov_domisili ?>
    <div id="r_prov_domisili" class="form-group row">
        <label id="elh_master_pasien_prov_domisili" for="x_prov_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prov_domisili->caption() ?><?= $Page->prov_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->prov_domisili->cellAttributes() ?>>
<span id="el_master_pasien_prov_domisili">
<input type="<?= $Page->prov_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_prov_domisili" name="x_prov_domisili" id="x_prov_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->prov_domisili->getPlaceHolder()) ?>" value="<?= $Page->prov_domisili->EditValue ?>"<?= $Page->prov_domisili->editAttributes() ?> aria-describedby="x_prov_domisili_help">
<?= $Page->prov_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prov_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->negara_domisili->Visible) { // negara_domisili ?>
    <div id="r_negara_domisili" class="form-group row">
        <label id="elh_master_pasien_negara_domisili" for="x_negara_domisili" class="<?= $Page->LeftColumnClass ?>"><?= $Page->negara_domisili->caption() ?><?= $Page->negara_domisili->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->negara_domisili->cellAttributes() ?>>
<span id="el_master_pasien_negara_domisili">
<input type="<?= $Page->negara_domisili->getInputTextType() ?>" data-table="master_pasien" data-field="x_negara_domisili" name="x_negara_domisili" id="x_negara_domisili" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->negara_domisili->getPlaceHolder()) ?>" value="<?= $Page->negara_domisili->EditValue ?>"<?= $Page->negara_domisili->editAttributes() ?> aria-describedby="x_negara_domisili_help">
<?= $Page->negara_domisili->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->negara_domisili->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
    <div id="r_no_telp" class="form-group row">
        <label id="elh_master_pasien_no_telp" for="x_no_telp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_telp->caption() ?><?= $Page->no_telp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_telp->cellAttributes() ?>>
<span id="el_master_pasien_no_telp">
<input type="<?= $Page->no_telp->getInputTextType() ?>" data-table="master_pasien" data-field="x_no_telp" name="x_no_telp" id="x_no_telp" size="30" placeholder="<?= HtmlEncode($Page->no_telp->getPlaceHolder()) ?>" value="<?= $Page->no_telp->EditValue ?>"<?= $Page->no_telp->editAttributes() ?> aria-describedby="x_no_telp_help">
<?= $Page->no_telp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_telp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <div id="r_no_hp" class="form-group row">
        <label id="elh_master_pasien_no_hp" for="x_no_hp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_hp->caption() ?><?= $Page->no_hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_hp->cellAttributes() ?>>
<span id="el_master_pasien_no_hp">
<input type="<?= $Page->no_hp->getInputTextType() ?>" data-table="master_pasien" data-field="x_no_hp" name="x_no_hp" id="x_no_hp" size="30" placeholder="<?= HtmlEncode($Page->no_hp->getPlaceHolder()) ?>" value="<?= $Page->no_hp->EditValue ?>"<?= $Page->no_hp->editAttributes() ?> aria-describedby="x_no_hp_help">
<?= $Page->no_hp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_hp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
    <div id="r_pendidikan" class="form-group row">
        <label id="elh_master_pasien_pendidikan" for="x_pendidikan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pendidikan->caption() ?><?= $Page->pendidikan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el_master_pasien_pendidikan">
<input type="<?= $Page->pendidikan->getInputTextType() ?>" data-table="master_pasien" data-field="x_pendidikan" name="x_pendidikan" id="x_pendidikan" size="30" placeholder="<?= HtmlEncode($Page->pendidikan->getPlaceHolder()) ?>" value="<?= $Page->pendidikan->EditValue ?>"<?= $Page->pendidikan->editAttributes() ?> aria-describedby="x_pendidikan_help">
<?= $Page->pendidikan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pendidikan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <div id="r_pekerjaan" class="form-group row">
        <label id="elh_master_pasien_pekerjaan" for="x_pekerjaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pekerjaan->caption() ?><?= $Page->pekerjaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el_master_pasien_pekerjaan">
<input type="<?= $Page->pekerjaan->getInputTextType() ?>" data-table="master_pasien" data-field="x_pekerjaan" name="x_pekerjaan" id="x_pekerjaan" size="30" placeholder="<?= HtmlEncode($Page->pekerjaan->getPlaceHolder()) ?>" value="<?= $Page->pekerjaan->EditValue ?>"<?= $Page->pekerjaan->editAttributes() ?> aria-describedby="x_pekerjaan_help">
<?= $Page->pekerjaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pekerjaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_kawin->Visible) { // status_kawin ?>
    <div id="r_status_kawin" class="form-group row">
        <label id="elh_master_pasien_status_kawin" for="x_status_kawin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_kawin->caption() ?><?= $Page->status_kawin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_kawin->cellAttributes() ?>>
<span id="el_master_pasien_status_kawin">
<input type="<?= $Page->status_kawin->getInputTextType() ?>" data-table="master_pasien" data-field="x_status_kawin" name="x_status_kawin" id="x_status_kawin" size="30" placeholder="<?= HtmlEncode($Page->status_kawin->getPlaceHolder()) ?>" value="<?= $Page->status_kawin->EditValue ?>"<?= $Page->status_kawin->editAttributes() ?> aria-describedby="x_status_kawin_help">
<?= $Page->status_kawin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_kawin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
    <div id="r_tgl_daftar" class="form-group row">
        <label id="elh_master_pasien_tgl_daftar" for="x_tgl_daftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_daftar->caption() ?><?= $Page->tgl_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_daftar->cellAttributes() ?>>
<span id="el_master_pasien_tgl_daftar">
<input type="<?= $Page->tgl_daftar->getInputTextType() ?>" data-table="master_pasien" data-field="x_tgl_daftar" name="x_tgl_daftar" id="x_tgl_daftar" placeholder="<?= HtmlEncode($Page->tgl_daftar->getPlaceHolder()) ?>" value="<?= $Page->tgl_daftar->EditValue ?>"<?= $Page->tgl_daftar->editAttributes() ?> aria-describedby="x_tgl_daftar_help">
<?= $Page->tgl_daftar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_daftar->getErrorMessage() ?></div>
<?php if (!$Page->tgl_daftar->ReadOnly && !$Page->tgl_daftar->Disabled && !isset($Page->tgl_daftar->EditAttrs["readonly"]) && !isset($Page->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaster_pasienedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fmaster_pasienedit", "x_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label id="elh_master_pasien__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
<span id="el_master_pasien__username">
<input type="<?= $Page->_username->getInputTextType() ?>" data-table="master_pasien" data-field="x__username" name="x__username" id="x__username" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" value="<?= $Page->_username->EditValue ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
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
    ew.addEventHandlers("master_pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
