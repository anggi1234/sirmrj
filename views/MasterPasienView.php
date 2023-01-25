<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MasterPasienView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmaster_pasienview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fmaster_pasienview = currentForm = new ew.Form("fmaster_pasienview", "view");
    loadjs.done("fmaster_pasienview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.master_pasien) ew.vars.tables.master_pasien = <?= JsonEncode(GetClientVar("tables", "master_pasien")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmaster_pasienview" id="fmaster_pasienview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="master_pasien">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_pasien->Visible) { // id_pasien ?>
    <tr id="r_id_pasien">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_id_pasien"><?= $Page->id_pasien->caption() ?></span></td>
        <td data-name="id_pasien" <?= $Page->id_pasien->cellAttributes() ?>>
<span id="el_master_pasien_id_pasien">
<span<?= $Page->id_pasien->viewAttributes() ?>>
<?= $Page->id_pasien->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_pasien->Visible) { // nama_pasien ?>
    <tr id="r_nama_pasien">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_nama_pasien"><?= $Page->nama_pasien->caption() ?></span></td>
        <td data-name="nama_pasien" <?= $Page->nama_pasien->cellAttributes() ?>>
<span id="el_master_pasien_nama_pasien">
<span<?= $Page->nama_pasien->viewAttributes() ?>>
<?= $Page->nama_pasien->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rekam_medis->Visible) { // no_rekam_medis ?>
    <tr id="r_no_rekam_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_no_rekam_medis"><?= $Page->no_rekam_medis->caption() ?></span></td>
        <td data-name="no_rekam_medis" <?= $Page->no_rekam_medis->cellAttributes() ?>>
<span id="el_master_pasien_no_rekam_medis">
<span<?= $Page->no_rekam_medis->viewAttributes() ?>>
<?= $Page->no_rekam_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_master_pasien_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_identitas_lain->Visible) { // no_identitas_lain ?>
    <tr id="r_no_identitas_lain">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_no_identitas_lain"><?= $Page->no_identitas_lain->caption() ?></span></td>
        <td data-name="no_identitas_lain" <?= $Page->no_identitas_lain->cellAttributes() ?>>
<span id="el_master_pasien_no_identitas_lain">
<span<?= $Page->no_identitas_lain->viewAttributes() ?>>
<?= $Page->no_identitas_lain->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
    <tr id="r_nama_ibu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_nama_ibu"><?= $Page->nama_ibu->caption() ?></span></td>
        <td data-name="nama_ibu" <?= $Page->nama_ibu->cellAttributes() ?>>
<span id="el_master_pasien_nama_ibu">
<span<?= $Page->nama_ibu->viewAttributes() ?>>
<?= $Page->nama_ibu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
    <tr id="r_tempat_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_tempat_lahir"><?= $Page->tempat_lahir->caption() ?></span></td>
        <td data-name="tempat_lahir" <?= $Page->tempat_lahir->cellAttributes() ?>>
<span id="el_master_pasien_tempat_lahir">
<span<?= $Page->tempat_lahir->viewAttributes() ?>>
<?= $Page->tempat_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <tr id="r_tanggal_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></td>
        <td data-name="tanggal_lahir" <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el_master_pasien_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
    <tr id="r_jenis_kelamin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_jenis_kelamin"><?= $Page->jenis_kelamin->caption() ?></span></td>
        <td data-name="jenis_kelamin" <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el_master_pasien_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <tr id="r_agama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_agama"><?= $Page->agama->caption() ?></span></td>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el_master_pasien_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->suku->Visible) { // suku ?>
    <tr id="r_suku">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_suku"><?= $Page->suku->caption() ?></span></td>
        <td data-name="suku" <?= $Page->suku->cellAttributes() ?>>
<span id="el_master_pasien_suku">
<span<?= $Page->suku->viewAttributes() ?>>
<?= $Page->suku->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bahasa->Visible) { // bahasa ?>
    <tr id="r_bahasa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_bahasa"><?= $Page->bahasa->caption() ?></span></td>
        <td data-name="bahasa" <?= $Page->bahasa->cellAttributes() ?>>
<span id="el_master_pasien_bahasa">
<span<?= $Page->bahasa->viewAttributes() ?>>
<?= $Page->bahasa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <tr id="r_alamat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_alamat"><?= $Page->alamat->caption() ?></span></td>
        <td data-name="alamat" <?= $Page->alamat->cellAttributes() ?>>
<span id="el_master_pasien_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rt->Visible) { // rt ?>
    <tr id="r_rt">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_rt"><?= $Page->rt->caption() ?></span></td>
        <td data-name="rt" <?= $Page->rt->cellAttributes() ?>>
<span id="el_master_pasien_rt">
<span<?= $Page->rt->viewAttributes() ?>>
<?= $Page->rt->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rw->Visible) { // rw ?>
    <tr id="r_rw">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_rw"><?= $Page->rw->caption() ?></span></td>
        <td data-name="rw" <?= $Page->rw->cellAttributes() ?>>
<span id="el_master_pasien_rw">
<span<?= $Page->rw->viewAttributes() ?>>
<?= $Page->rw->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keluarahan_desa->Visible) { // keluarahan_desa ?>
    <tr id="r_keluarahan_desa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_keluarahan_desa"><?= $Page->keluarahan_desa->caption() ?></span></td>
        <td data-name="keluarahan_desa" <?= $Page->keluarahan_desa->cellAttributes() ?>>
<span id="el_master_pasien_keluarahan_desa">
<span<?= $Page->keluarahan_desa->viewAttributes() ?>>
<?= $Page->keluarahan_desa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kecamatan->Visible) { // kecamatan ?>
    <tr id="r_kecamatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_kecamatan"><?= $Page->kecamatan->caption() ?></span></td>
        <td data-name="kecamatan" <?= $Page->kecamatan->cellAttributes() ?>>
<span id="el_master_pasien_kecamatan">
<span<?= $Page->kecamatan->viewAttributes() ?>>
<?= $Page->kecamatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kabupaten_kota->Visible) { // kabupaten_kota ?>
    <tr id="r_kabupaten_kota">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_kabupaten_kota"><?= $Page->kabupaten_kota->caption() ?></span></td>
        <td data-name="kabupaten_kota" <?= $Page->kabupaten_kota->cellAttributes() ?>>
<span id="el_master_pasien_kabupaten_kota">
<span<?= $Page->kabupaten_kota->viewAttributes() ?>>
<?= $Page->kabupaten_kota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kodepos->Visible) { // kodepos ?>
    <tr id="r_kodepos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_kodepos"><?= $Page->kodepos->caption() ?></span></td>
        <td data-name="kodepos" <?= $Page->kodepos->cellAttributes() ?>>
<span id="el_master_pasien_kodepos">
<span<?= $Page->kodepos->viewAttributes() ?>>
<?= $Page->kodepos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->provinsi->Visible) { // provinsi ?>
    <tr id="r_provinsi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_provinsi"><?= $Page->provinsi->caption() ?></span></td>
        <td data-name="provinsi" <?= $Page->provinsi->cellAttributes() ?>>
<span id="el_master_pasien_provinsi">
<span<?= $Page->provinsi->viewAttributes() ?>>
<?= $Page->provinsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->negara->Visible) { // negara ?>
    <tr id="r_negara">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_negara"><?= $Page->negara->caption() ?></span></td>
        <td data-name="negara" <?= $Page->negara->cellAttributes() ?>>
<span id="el_master_pasien_negara">
<span<?= $Page->negara->viewAttributes() ?>>
<?= $Page->negara->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat_domisili->Visible) { // alamat_domisili ?>
    <tr id="r_alamat_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_alamat_domisili"><?= $Page->alamat_domisili->caption() ?></span></td>
        <td data-name="alamat_domisili" <?= $Page->alamat_domisili->cellAttributes() ?>>
<span id="el_master_pasien_alamat_domisili">
<span<?= $Page->alamat_domisili->viewAttributes() ?>>
<?= $Page->alamat_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rt_domisili->Visible) { // rt_domisili ?>
    <tr id="r_rt_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_rt_domisili"><?= $Page->rt_domisili->caption() ?></span></td>
        <td data-name="rt_domisili" <?= $Page->rt_domisili->cellAttributes() ?>>
<span id="el_master_pasien_rt_domisili">
<span<?= $Page->rt_domisili->viewAttributes() ?>>
<?= $Page->rt_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rw_domisili->Visible) { // rw_domisili ?>
    <tr id="r_rw_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_rw_domisili"><?= $Page->rw_domisili->caption() ?></span></td>
        <td data-name="rw_domisili" <?= $Page->rw_domisili->cellAttributes() ?>>
<span id="el_master_pasien_rw_domisili">
<span<?= $Page->rw_domisili->viewAttributes() ?>>
<?= $Page->rw_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kel_desa_domisili->Visible) { // kel_desa_domisili ?>
    <tr id="r_kel_desa_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_kel_desa_domisili"><?= $Page->kel_desa_domisili->caption() ?></span></td>
        <td data-name="kel_desa_domisili" <?= $Page->kel_desa_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kel_desa_domisili">
<span<?= $Page->kel_desa_domisili->viewAttributes() ?>>
<?= $Page->kel_desa_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kec_domisili->Visible) { // kec_domisili ?>
    <tr id="r_kec_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_kec_domisili"><?= $Page->kec_domisili->caption() ?></span></td>
        <td data-name="kec_domisili" <?= $Page->kec_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kec_domisili">
<span<?= $Page->kec_domisili->viewAttributes() ?>>
<?= $Page->kec_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kota_kab_domisili->Visible) { // kota_kab_domisili ?>
    <tr id="r_kota_kab_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_kota_kab_domisili"><?= $Page->kota_kab_domisili->caption() ?></span></td>
        <td data-name="kota_kab_domisili" <?= $Page->kota_kab_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kota_kab_domisili">
<span<?= $Page->kota_kab_domisili->viewAttributes() ?>>
<?= $Page->kota_kab_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kodepos_domisili->Visible) { // kodepos_domisili ?>
    <tr id="r_kodepos_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_kodepos_domisili"><?= $Page->kodepos_domisili->caption() ?></span></td>
        <td data-name="kodepos_domisili" <?= $Page->kodepos_domisili->cellAttributes() ?>>
<span id="el_master_pasien_kodepos_domisili">
<span<?= $Page->kodepos_domisili->viewAttributes() ?>>
<?= $Page->kodepos_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prov_domisili->Visible) { // prov_domisili ?>
    <tr id="r_prov_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_prov_domisili"><?= $Page->prov_domisili->caption() ?></span></td>
        <td data-name="prov_domisili" <?= $Page->prov_domisili->cellAttributes() ?>>
<span id="el_master_pasien_prov_domisili">
<span<?= $Page->prov_domisili->viewAttributes() ?>>
<?= $Page->prov_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->negara_domisili->Visible) { // negara_domisili ?>
    <tr id="r_negara_domisili">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_negara_domisili"><?= $Page->negara_domisili->caption() ?></span></td>
        <td data-name="negara_domisili" <?= $Page->negara_domisili->cellAttributes() ?>>
<span id="el_master_pasien_negara_domisili">
<span<?= $Page->negara_domisili->viewAttributes() ?>>
<?= $Page->negara_domisili->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
    <tr id="r_no_telp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_no_telp"><?= $Page->no_telp->caption() ?></span></td>
        <td data-name="no_telp" <?= $Page->no_telp->cellAttributes() ?>>
<span id="el_master_pasien_no_telp">
<span<?= $Page->no_telp->viewAttributes() ?>>
<?= $Page->no_telp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <tr id="r_no_hp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_no_hp"><?= $Page->no_hp->caption() ?></span></td>
        <td data-name="no_hp" <?= $Page->no_hp->cellAttributes() ?>>
<span id="el_master_pasien_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
    <tr id="r_pendidikan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_pendidikan"><?= $Page->pendidikan->caption() ?></span></td>
        <td data-name="pendidikan" <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el_master_pasien_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <tr id="r_pekerjaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_pekerjaan"><?= $Page->pekerjaan->caption() ?></span></td>
        <td data-name="pekerjaan" <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el_master_pasien_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_kawin->Visible) { // status_kawin ?>
    <tr id="r_status_kawin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_status_kawin"><?= $Page->status_kawin->caption() ?></span></td>
        <td data-name="status_kawin" <?= $Page->status_kawin->cellAttributes() ?>>
<span id="el_master_pasien_status_kawin">
<span<?= $Page->status_kawin->viewAttributes() ?>>
<?= $Page->status_kawin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
    <tr id="r_tgl_daftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien_tgl_daftar"><?= $Page->tgl_daftar->caption() ?></span></td>
        <td data-name="tgl_daftar" <?= $Page->tgl_daftar->cellAttributes() ?>>
<span id="el_master_pasien_tgl_daftar">
<span<?= $Page->tgl_daftar->viewAttributes() ?>>
<?= $Page->tgl_daftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <tr id="r__username">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_master_pasien__username"><?= $Page->_username->caption() ?></span></td>
        <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
<span id="el_master_pasien__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
