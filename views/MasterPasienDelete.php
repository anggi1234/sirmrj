<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MasterPasienDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fmaster_pasiendelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fmaster_pasiendelete = currentForm = new ew.Form("fmaster_pasiendelete", "delete");
    loadjs.done("fmaster_pasiendelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.master_pasien) ew.vars.tables.master_pasien = <?= JsonEncode(GetClientVar("tables", "master_pasien")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmaster_pasiendelete" id="fmaster_pasiendelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="master_pasien">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id_pasien->Visible) { // id_pasien ?>
        <th class="<?= $Page->id_pasien->headerCellClass() ?>"><span id="elh_master_pasien_id_pasien" class="master_pasien_id_pasien"><?= $Page->id_pasien->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
        <th class="<?= $Page->nama_pasien->headerCellClass() ?>"><span id="elh_master_pasien_nama_pasien" class="master_pasien_nama_pasien"><?= $Page->nama_pasien->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <th class="<?= $Page->no_rekam_medis->headerCellClass() ?>"><span id="elh_master_pasien_no_rekam_medis" class="master_pasien_no_rekam_medis"><?= $Page->no_rekam_medis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_master_pasien_nik" class="master_pasien_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_identitas_lain->Visible) { // no_identitas_lain ?>
        <th class="<?= $Page->no_identitas_lain->headerCellClass() ?>"><span id="elh_master_pasien_no_identitas_lain" class="master_pasien_no_identitas_lain"><?= $Page->no_identitas_lain->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <th class="<?= $Page->nama_ibu->headerCellClass() ?>"><span id="elh_master_pasien_nama_ibu" class="master_pasien_nama_ibu"><?= $Page->nama_ibu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <th class="<?= $Page->tempat_lahir->headerCellClass() ?>"><span id="elh_master_pasien_tempat_lahir" class="master_pasien_tempat_lahir"><?= $Page->tempat_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <th class="<?= $Page->tanggal_lahir->headerCellClass() ?>"><span id="elh_master_pasien_tanggal_lahir" class="master_pasien_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <th class="<?= $Page->jenis_kelamin->headerCellClass() ?>"><span id="elh_master_pasien_jenis_kelamin" class="master_pasien_jenis_kelamin"><?= $Page->jenis_kelamin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th class="<?= $Page->agama->headerCellClass() ?>"><span id="elh_master_pasien_agama" class="master_pasien_agama"><?= $Page->agama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->suku->Visible) { // suku ?>
        <th class="<?= $Page->suku->headerCellClass() ?>"><span id="elh_master_pasien_suku" class="master_pasien_suku"><?= $Page->suku->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bahasa->Visible) { // bahasa ?>
        <th class="<?= $Page->bahasa->headerCellClass() ?>"><span id="elh_master_pasien_bahasa" class="master_pasien_bahasa"><?= $Page->bahasa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th class="<?= $Page->alamat->headerCellClass() ?>"><span id="elh_master_pasien_alamat" class="master_pasien_alamat"><?= $Page->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rt->Visible) { // rt ?>
        <th class="<?= $Page->rt->headerCellClass() ?>"><span id="elh_master_pasien_rt" class="master_pasien_rt"><?= $Page->rt->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rw->Visible) { // rw ?>
        <th class="<?= $Page->rw->headerCellClass() ?>"><span id="elh_master_pasien_rw" class="master_pasien_rw"><?= $Page->rw->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keluarahan_desa->Visible) { // keluarahan_desa ?>
        <th class="<?= $Page->keluarahan_desa->headerCellClass() ?>"><span id="elh_master_pasien_keluarahan_desa" class="master_pasien_keluarahan_desa"><?= $Page->keluarahan_desa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kecamatan->Visible) { // kecamatan ?>
        <th class="<?= $Page->kecamatan->headerCellClass() ?>"><span id="elh_master_pasien_kecamatan" class="master_pasien_kecamatan"><?= $Page->kecamatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kabupaten_kota->Visible) { // kabupaten_kota ?>
        <th class="<?= $Page->kabupaten_kota->headerCellClass() ?>"><span id="elh_master_pasien_kabupaten_kota" class="master_pasien_kabupaten_kota"><?= $Page->kabupaten_kota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kodepos->Visible) { // kodepos ?>
        <th class="<?= $Page->kodepos->headerCellClass() ?>"><span id="elh_master_pasien_kodepos" class="master_pasien_kodepos"><?= $Page->kodepos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->provinsi->Visible) { // provinsi ?>
        <th class="<?= $Page->provinsi->headerCellClass() ?>"><span id="elh_master_pasien_provinsi" class="master_pasien_provinsi"><?= $Page->provinsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->negara->Visible) { // negara ?>
        <th class="<?= $Page->negara->headerCellClass() ?>"><span id="elh_master_pasien_negara" class="master_pasien_negara"><?= $Page->negara->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat_domisili->Visible) { // alamat_domisili ?>
        <th class="<?= $Page->alamat_domisili->headerCellClass() ?>"><span id="elh_master_pasien_alamat_domisili" class="master_pasien_alamat_domisili"><?= $Page->alamat_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rt_domisili->Visible) { // rt_domisili ?>
        <th class="<?= $Page->rt_domisili->headerCellClass() ?>"><span id="elh_master_pasien_rt_domisili" class="master_pasien_rt_domisili"><?= $Page->rt_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rw_domisili->Visible) { // rw_domisili ?>
        <th class="<?= $Page->rw_domisili->headerCellClass() ?>"><span id="elh_master_pasien_rw_domisili" class="master_pasien_rw_domisili"><?= $Page->rw_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kel_desa_domisili->Visible) { // kel_desa_domisili ?>
        <th class="<?= $Page->kel_desa_domisili->headerCellClass() ?>"><span id="elh_master_pasien_kel_desa_domisili" class="master_pasien_kel_desa_domisili"><?= $Page->kel_desa_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kec_domisili->Visible) { // kec_domisili ?>
        <th class="<?= $Page->kec_domisili->headerCellClass() ?>"><span id="elh_master_pasien_kec_domisili" class="master_pasien_kec_domisili"><?= $Page->kec_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kota_kab_domisili->Visible) { // kota_kab_domisili ?>
        <th class="<?= $Page->kota_kab_domisili->headerCellClass() ?>"><span id="elh_master_pasien_kota_kab_domisili" class="master_pasien_kota_kab_domisili"><?= $Page->kota_kab_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kodepos_domisili->Visible) { // kodepos_domisili ?>
        <th class="<?= $Page->kodepos_domisili->headerCellClass() ?>"><span id="elh_master_pasien_kodepos_domisili" class="master_pasien_kodepos_domisili"><?= $Page->kodepos_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->prov_domisili->Visible) { // prov_domisili ?>
        <th class="<?= $Page->prov_domisili->headerCellClass() ?>"><span id="elh_master_pasien_prov_domisili" class="master_pasien_prov_domisili"><?= $Page->prov_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->negara_domisili->Visible) { // negara_domisili ?>
        <th class="<?= $Page->negara_domisili->headerCellClass() ?>"><span id="elh_master_pasien_negara_domisili" class="master_pasien_negara_domisili"><?= $Page->negara_domisili->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
        <th class="<?= $Page->no_telp->headerCellClass() ?>"><span id="elh_master_pasien_no_telp" class="master_pasien_no_telp"><?= $Page->no_telp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th class="<?= $Page->no_hp->headerCellClass() ?>"><span id="elh_master_pasien_no_hp" class="master_pasien_no_hp"><?= $Page->no_hp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th class="<?= $Page->pendidikan->headerCellClass() ?>"><span id="elh_master_pasien_pendidikan" class="master_pasien_pendidikan"><?= $Page->pendidikan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <th class="<?= $Page->pekerjaan->headerCellClass() ?>"><span id="elh_master_pasien_pekerjaan" class="master_pasien_pekerjaan"><?= $Page->pekerjaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_kawin->Visible) { // status_kawin ?>
        <th class="<?= $Page->status_kawin->headerCellClass() ?>"><span id="elh_master_pasien_status_kawin" class="master_pasien_status_kawin"><?= $Page->status_kawin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <th class="<?= $Page->tgl_daftar->headerCellClass() ?>"><span id="elh_master_pasien_tgl_daftar" class="master_pasien_tgl_daftar"><?= $Page->tgl_daftar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_master_pasien__username" class="master_pasien__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id_pasien->Visible) { // id_pasien ?>
        <td <?= $Page->id_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_id_pasien" class="master_pasien_id_pasien">
<span<?= $Page->id_pasien->viewAttributes() ?>>
<?= $Page->id_pasien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
        <td <?= $Page->nama_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_nama_pasien" class="master_pasien_nama_pasien">
<span<?= $Page->nama_pasien->viewAttributes() ?>>
<?= $Page->nama_pasien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
        <td <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_rekam_medis" class="master_pasien_no_rekam_medis">
<span<?= $Page->no_rekam_medis->viewAttributes() ?>>
<?= $Page->no_rekam_medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <td <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_nik" class="master_pasien_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_identitas_lain->Visible) { // no_identitas_lain ?>
        <td <?= $Page->no_identitas_lain->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_identitas_lain" class="master_pasien_no_identitas_lain">
<span<?= $Page->no_identitas_lain->viewAttributes() ?>>
<?= $Page->no_identitas_lain->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <td <?= $Page->nama_ibu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_nama_ibu" class="master_pasien_nama_ibu">
<span<?= $Page->nama_ibu->viewAttributes() ?>>
<?= $Page->nama_ibu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <td <?= $Page->tempat_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_tempat_lahir" class="master_pasien_tempat_lahir">
<span<?= $Page->tempat_lahir->viewAttributes() ?>>
<?= $Page->tempat_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <td <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_tanggal_lahir" class="master_pasien_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <td <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_jenis_kelamin" class="master_pasien_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <td <?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_agama" class="master_pasien_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->suku->Visible) { // suku ?>
        <td <?= $Page->suku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_suku" class="master_pasien_suku">
<span<?= $Page->suku->viewAttributes() ?>>
<?= $Page->suku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bahasa->Visible) { // bahasa ?>
        <td <?= $Page->bahasa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_bahasa" class="master_pasien_bahasa">
<span<?= $Page->bahasa->viewAttributes() ?>>
<?= $Page->bahasa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <td <?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_alamat" class="master_pasien_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rt->Visible) { // rt ?>
        <td <?= $Page->rt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rt" class="master_pasien_rt">
<span<?= $Page->rt->viewAttributes() ?>>
<?= $Page->rt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rw->Visible) { // rw ?>
        <td <?= $Page->rw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rw" class="master_pasien_rw">
<span<?= $Page->rw->viewAttributes() ?>>
<?= $Page->rw->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keluarahan_desa->Visible) { // keluarahan_desa ?>
        <td <?= $Page->keluarahan_desa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_keluarahan_desa" class="master_pasien_keluarahan_desa">
<span<?= $Page->keluarahan_desa->viewAttributes() ?>>
<?= $Page->keluarahan_desa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kecamatan->Visible) { // kecamatan ?>
        <td <?= $Page->kecamatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kecamatan" class="master_pasien_kecamatan">
<span<?= $Page->kecamatan->viewAttributes() ?>>
<?= $Page->kecamatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kabupaten_kota->Visible) { // kabupaten_kota ?>
        <td <?= $Page->kabupaten_kota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kabupaten_kota" class="master_pasien_kabupaten_kota">
<span<?= $Page->kabupaten_kota->viewAttributes() ?>>
<?= $Page->kabupaten_kota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kodepos->Visible) { // kodepos ?>
        <td <?= $Page->kodepos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kodepos" class="master_pasien_kodepos">
<span<?= $Page->kodepos->viewAttributes() ?>>
<?= $Page->kodepos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->provinsi->Visible) { // provinsi ?>
        <td <?= $Page->provinsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_provinsi" class="master_pasien_provinsi">
<span<?= $Page->provinsi->viewAttributes() ?>>
<?= $Page->provinsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->negara->Visible) { // negara ?>
        <td <?= $Page->negara->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_negara" class="master_pasien_negara">
<span<?= $Page->negara->viewAttributes() ?>>
<?= $Page->negara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat_domisili->Visible) { // alamat_domisili ?>
        <td <?= $Page->alamat_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_alamat_domisili" class="master_pasien_alamat_domisili">
<span<?= $Page->alamat_domisili->viewAttributes() ?>>
<?= $Page->alamat_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rt_domisili->Visible) { // rt_domisili ?>
        <td <?= $Page->rt_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rt_domisili" class="master_pasien_rt_domisili">
<span<?= $Page->rt_domisili->viewAttributes() ?>>
<?= $Page->rt_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rw_domisili->Visible) { // rw_domisili ?>
        <td <?= $Page->rw_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_rw_domisili" class="master_pasien_rw_domisili">
<span<?= $Page->rw_domisili->viewAttributes() ?>>
<?= $Page->rw_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kel_desa_domisili->Visible) { // kel_desa_domisili ?>
        <td <?= $Page->kel_desa_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kel_desa_domisili" class="master_pasien_kel_desa_domisili">
<span<?= $Page->kel_desa_domisili->viewAttributes() ?>>
<?= $Page->kel_desa_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kec_domisili->Visible) { // kec_domisili ?>
        <td <?= $Page->kec_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kec_domisili" class="master_pasien_kec_domisili">
<span<?= $Page->kec_domisili->viewAttributes() ?>>
<?= $Page->kec_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kota_kab_domisili->Visible) { // kota_kab_domisili ?>
        <td <?= $Page->kota_kab_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kota_kab_domisili" class="master_pasien_kota_kab_domisili">
<span<?= $Page->kota_kab_domisili->viewAttributes() ?>>
<?= $Page->kota_kab_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kodepos_domisili->Visible) { // kodepos_domisili ?>
        <td <?= $Page->kodepos_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_kodepos_domisili" class="master_pasien_kodepos_domisili">
<span<?= $Page->kodepos_domisili->viewAttributes() ?>>
<?= $Page->kodepos_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->prov_domisili->Visible) { // prov_domisili ?>
        <td <?= $Page->prov_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_prov_domisili" class="master_pasien_prov_domisili">
<span<?= $Page->prov_domisili->viewAttributes() ?>>
<?= $Page->prov_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->negara_domisili->Visible) { // negara_domisili ?>
        <td <?= $Page->negara_domisili->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_negara_domisili" class="master_pasien_negara_domisili">
<span<?= $Page->negara_domisili->viewAttributes() ?>>
<?= $Page->negara_domisili->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
        <td <?= $Page->no_telp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_telp" class="master_pasien_no_telp">
<span<?= $Page->no_telp->viewAttributes() ?>>
<?= $Page->no_telp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td <?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_no_hp" class="master_pasien_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_pendidikan" class="master_pasien_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <td <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_pekerjaan" class="master_pasien_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_kawin->Visible) { // status_kawin ?>
        <td <?= $Page->status_kawin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_status_kawin" class="master_pasien_status_kawin">
<span<?= $Page->status_kawin->viewAttributes() ?>>
<?= $Page->status_kawin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <td <?= $Page->tgl_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien_tgl_daftar" class="master_pasien_tgl_daftar">
<span<?= $Page->tgl_daftar->viewAttributes() ?>>
<?= $Page->tgl_daftar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <td <?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_master_pasien__username" class="master_pasien__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
