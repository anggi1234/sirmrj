<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenilaian_awal_keperawatan_ralandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpenilaian_awal_keperawatan_ralandelete = currentForm = new ew.Form("fpenilaian_awal_keperawatan_ralandelete", "delete");
    loadjs.done("fpenilaian_awal_keperawatan_ralandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.penilaian_awal_keperawatan_ralan) ew.vars.tables.penilaian_awal_keperawatan_ralan = <?= JsonEncode(GetClientVar("tables", "penilaian_awal_keperawatan_ralan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenilaian_awal_keperawatan_ralandelete" id="fpenilaian_awal_keperawatan_ralandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_awal_keperawatan_ralan">
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_no_rawat" class="penilaian_awal_keperawatan_ralan_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_tanggal" class="penilaian_awal_keperawatan_ralan_tanggal"><?= $Page->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
        <th class="<?= $Page->informasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_informasi" class="penilaian_awal_keperawatan_ralan_informasi"><?= $Page->informasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <th class="<?= $Page->td->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_td" class="penilaian_awal_keperawatan_ralan_td"><?= $Page->td->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <th class="<?= $Page->nadi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nadi" class="penilaian_awal_keperawatan_ralan_nadi"><?= $Page->nadi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <th class="<?= $Page->rr->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rr" class="penilaian_awal_keperawatan_ralan_rr"><?= $Page->rr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <th class="<?= $Page->suhu->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_suhu" class="penilaian_awal_keperawatan_ralan_suhu"><?= $Page->suhu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <th class="<?= $Page->gcs->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_gcs" class="penilaian_awal_keperawatan_ralan_gcs"><?= $Page->gcs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <th class="<?= $Page->bb->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_bb" class="penilaian_awal_keperawatan_ralan_bb"><?= $Page->bb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <th class="<?= $Page->tb->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_tb" class="penilaian_awal_keperawatan_ralan_tb"><?= $Page->tb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
        <th class="<?= $Page->bmi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_bmi" class="penilaian_awal_keperawatan_ralan_bmi"><?= $Page->bmi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
        <th class="<?= $Page->keluhan_utama->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_keluhan_utama" class="penilaian_awal_keperawatan_ralan_keluhan_utama"><?= $Page->keluhan_utama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpd->Visible) { // rpd ?>
        <th class="<?= $Page->rpd->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rpd" class="penilaian_awal_keperawatan_ralan_rpd"><?= $Page->rpd->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpk->Visible) { // rpk ?>
        <th class="<?= $Page->rpk->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rpk" class="penilaian_awal_keperawatan_ralan_rpk"><?= $Page->rpk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rpo->Visible) { // rpo ?>
        <th class="<?= $Page->rpo->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rpo" class="penilaian_awal_keperawatan_ralan_rpo"><?= $Page->rpo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <th class="<?= $Page->alergi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_alergi" class="penilaian_awal_keperawatan_ralan_alergi"><?= $Page->alergi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alat_bantu->Visible) { // alat_bantu ?>
        <th class="<?= $Page->alat_bantu->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_alat_bantu" class="penilaian_awal_keperawatan_ralan_alat_bantu"><?= $Page->alat_bantu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_bantu->Visible) { // ket_bantu ?>
        <th class="<?= $Page->ket_bantu->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_bantu" class="penilaian_awal_keperawatan_ralan_ket_bantu"><?= $Page->ket_bantu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->prothesa->Visible) { // prothesa ?>
        <th class="<?= $Page->prothesa->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_prothesa" class="penilaian_awal_keperawatan_ralan_prothesa"><?= $Page->prothesa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_pro->Visible) { // ket_pro ?>
        <th class="<?= $Page->ket_pro->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_pro" class="penilaian_awal_keperawatan_ralan_ket_pro"><?= $Page->ket_pro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->adl->Visible) { // adl ?>
        <th class="<?= $Page->adl->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_adl" class="penilaian_awal_keperawatan_ralan_adl"><?= $Page->adl->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_psiko->Visible) { // status_psiko ?>
        <th class="<?= $Page->status_psiko->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_status_psiko" class="penilaian_awal_keperawatan_ralan_status_psiko"><?= $Page->status_psiko->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_psiko->Visible) { // ket_psiko ?>
        <th class="<?= $Page->ket_psiko->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_psiko" class="penilaian_awal_keperawatan_ralan_ket_psiko"><?= $Page->ket_psiko->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hub_keluarga->Visible) { // hub_keluarga ?>
        <th class="<?= $Page->hub_keluarga->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_hub_keluarga" class="penilaian_awal_keperawatan_ralan_hub_keluarga"><?= $Page->hub_keluarga->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tinggal_dengan->Visible) { // tinggal_dengan ?>
        <th class="<?= $Page->tinggal_dengan->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_tinggal_dengan" class="penilaian_awal_keperawatan_ralan_tinggal_dengan"><?= $Page->tinggal_dengan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_tinggal->Visible) { // ket_tinggal ?>
        <th class="<?= $Page->ket_tinggal->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_tinggal" class="penilaian_awal_keperawatan_ralan_ket_tinggal"><?= $Page->ket_tinggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ekonomi->Visible) { // ekonomi ?>
        <th class="<?= $Page->ekonomi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ekonomi" class="penilaian_awal_keperawatan_ralan_ekonomi"><?= $Page->ekonomi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->budaya->Visible) { // budaya ?>
        <th class="<?= $Page->budaya->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_budaya" class="penilaian_awal_keperawatan_ralan_budaya"><?= $Page->budaya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_budaya->Visible) { // ket_budaya ?>
        <th class="<?= $Page->ket_budaya->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_budaya" class="penilaian_awal_keperawatan_ralan_ket_budaya"><?= $Page->ket_budaya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->edukasi->Visible) { // edukasi ?>
        <th class="<?= $Page->edukasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_edukasi" class="penilaian_awal_keperawatan_ralan_edukasi"><?= $Page->edukasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_edukasi->Visible) { // ket_edukasi ?>
        <th class="<?= $Page->ket_edukasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_edukasi" class="penilaian_awal_keperawatan_ralan_ket_edukasi"><?= $Page->ket_edukasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->berjalan_a->Visible) { // berjalan_a ?>
        <th class="<?= $Page->berjalan_a->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_berjalan_a" class="penilaian_awal_keperawatan_ralan_berjalan_a"><?= $Page->berjalan_a->caption() ?></span></th>
<?php } ?>
<?php if ($Page->berjalan_b->Visible) { // berjalan_b ?>
        <th class="<?= $Page->berjalan_b->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_berjalan_b" class="penilaian_awal_keperawatan_ralan_berjalan_b"><?= $Page->berjalan_b->caption() ?></span></th>
<?php } ?>
<?php if ($Page->berjalan_c->Visible) { // berjalan_c ?>
        <th class="<?= $Page->berjalan_c->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_berjalan_c" class="penilaian_awal_keperawatan_ralan_berjalan_c"><?= $Page->berjalan_c->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
        <th class="<?= $Page->hasil->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_hasil" class="penilaian_awal_keperawatan_ralan_hasil"><?= $Page->hasil->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
        <th class="<?= $Page->lapor->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_lapor" class="penilaian_awal_keperawatan_ralan_lapor"><?= $Page->lapor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
        <th class="<?= $Page->ket_lapor->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_lapor" class="penilaian_awal_keperawatan_ralan_ket_lapor"><?= $Page->ket_lapor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
        <th class="<?= $Page->sg1->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_sg1" class="penilaian_awal_keperawatan_ralan_sg1"><?= $Page->sg1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
        <th class="<?= $Page->nilai1->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nilai1" class="penilaian_awal_keperawatan_ralan_nilai1"><?= $Page->nilai1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
        <th class="<?= $Page->sg2->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_sg2" class="penilaian_awal_keperawatan_ralan_sg2"><?= $Page->sg2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
        <th class="<?= $Page->nilai2->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nilai2" class="penilaian_awal_keperawatan_ralan_nilai2"><?= $Page->nilai2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
        <th class="<?= $Page->total_hasil->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_total_hasil" class="penilaian_awal_keperawatan_ralan_total_hasil"><?= $Page->total_hasil->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
        <th class="<?= $Page->nyeri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nyeri" class="penilaian_awal_keperawatan_ralan_nyeri"><?= $Page->nyeri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
        <th class="<?= $Page->provokes->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_provokes" class="penilaian_awal_keperawatan_ralan_provokes"><?= $Page->provokes->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
        <th class="<?= $Page->ket_provokes->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_provokes" class="penilaian_awal_keperawatan_ralan_ket_provokes"><?= $Page->ket_provokes->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
        <th class="<?= $Page->quality->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_quality" class="penilaian_awal_keperawatan_ralan_quality"><?= $Page->quality->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
        <th class="<?= $Page->ket_quality->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_quality" class="penilaian_awal_keperawatan_ralan_ket_quality"><?= $Page->ket_quality->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <th class="<?= $Page->lokasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_lokasi" class="penilaian_awal_keperawatan_ralan_lokasi"><?= $Page->lokasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
        <th class="<?= $Page->menyebar->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_menyebar" class="penilaian_awal_keperawatan_ralan_menyebar"><?= $Page->menyebar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
        <th class="<?= $Page->skala_nyeri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_skala_nyeri" class="penilaian_awal_keperawatan_ralan_skala_nyeri"><?= $Page->skala_nyeri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <th class="<?= $Page->durasi->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_durasi" class="penilaian_awal_keperawatan_ralan_durasi"><?= $Page->durasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <th class="<?= $Page->nyeri_hilang->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nyeri_hilang" class="penilaian_awal_keperawatan_ralan_nyeri_hilang"><?= $Page->nyeri_hilang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
        <th class="<?= $Page->ket_nyeri->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_nyeri" class="penilaian_awal_keperawatan_ralan_ket_nyeri"><?= $Page->ket_nyeri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
        <th class="<?= $Page->pada_dokter->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_pada_dokter" class="penilaian_awal_keperawatan_ralan_pada_dokter"><?= $Page->pada_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
        <th class="<?= $Page->ket_dokter->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_ket_dokter" class="penilaian_awal_keperawatan_ralan_ket_dokter"><?= $Page->ket_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
        <th class="<?= $Page->rencana->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_rencana" class="penilaian_awal_keperawatan_ralan_rencana"><?= $Page->rencana->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><span id="elh_penilaian_awal_keperawatan_ralan_nip" class="penilaian_awal_keperawatan_ralan_nip"><?= $Page->nip->caption() ?></span></th>
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_no_rawat" class="penilaian_awal_keperawatan_ralan_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_tanggal" class="penilaian_awal_keperawatan_ralan_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->informasi->Visible) { // informasi ?>
        <td <?= $Page->informasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_informasi" class="penilaian_awal_keperawatan_ralan_informasi">
<span<?= $Page->informasi->viewAttributes() ?>>
<?= $Page->informasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <td <?= $Page->td->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_td" class="penilaian_awal_keperawatan_ralan_td">
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <td <?= $Page->nadi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_nadi" class="penilaian_awal_keperawatan_ralan_nadi">
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <td <?= $Page->rr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_rr" class="penilaian_awal_keperawatan_ralan_rr">
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <td <?= $Page->suhu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_suhu" class="penilaian_awal_keperawatan_ralan_suhu">
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <td <?= $Page->gcs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_gcs" class="penilaian_awal_keperawatan_ralan_gcs">
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <td <?= $Page->bb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_bb" class="penilaian_awal_keperawatan_ralan_bb">
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <td <?= $Page->tb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_tb" class="penilaian_awal_keperawatan_ralan_tb">
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
        <td <?= $Page->bmi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_bmi" class="penilaian_awal_keperawatan_ralan_bmi">
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
        <td <?= $Page->keluhan_utama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_keluhan_utama" class="penilaian_awal_keperawatan_ralan_keluhan_utama">
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpd->Visible) { // rpd ?>
        <td <?= $Page->rpd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_rpd" class="penilaian_awal_keperawatan_ralan_rpd">
<span<?= $Page->rpd->viewAttributes() ?>>
<?= $Page->rpd->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpk->Visible) { // rpk ?>
        <td <?= $Page->rpk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_rpk" class="penilaian_awal_keperawatan_ralan_rpk">
<span<?= $Page->rpk->viewAttributes() ?>>
<?= $Page->rpk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rpo->Visible) { // rpo ?>
        <td <?= $Page->rpo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_rpo" class="penilaian_awal_keperawatan_ralan_rpo">
<span<?= $Page->rpo->viewAttributes() ?>>
<?= $Page->rpo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <td <?= $Page->alergi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_alergi" class="penilaian_awal_keperawatan_ralan_alergi">
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alat_bantu->Visible) { // alat_bantu ?>
        <td <?= $Page->alat_bantu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_alat_bantu" class="penilaian_awal_keperawatan_ralan_alat_bantu">
<span<?= $Page->alat_bantu->viewAttributes() ?>>
<?= $Page->alat_bantu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_bantu->Visible) { // ket_bantu ?>
        <td <?= $Page->ket_bantu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_bantu" class="penilaian_awal_keperawatan_ralan_ket_bantu">
<span<?= $Page->ket_bantu->viewAttributes() ?>>
<?= $Page->ket_bantu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->prothesa->Visible) { // prothesa ?>
        <td <?= $Page->prothesa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_prothesa" class="penilaian_awal_keperawatan_ralan_prothesa">
<span<?= $Page->prothesa->viewAttributes() ?>>
<?= $Page->prothesa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_pro->Visible) { // ket_pro ?>
        <td <?= $Page->ket_pro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_pro" class="penilaian_awal_keperawatan_ralan_ket_pro">
<span<?= $Page->ket_pro->viewAttributes() ?>>
<?= $Page->ket_pro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->adl->Visible) { // adl ?>
        <td <?= $Page->adl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_adl" class="penilaian_awal_keperawatan_ralan_adl">
<span<?= $Page->adl->viewAttributes() ?>>
<?= $Page->adl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_psiko->Visible) { // status_psiko ?>
        <td <?= $Page->status_psiko->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_status_psiko" class="penilaian_awal_keperawatan_ralan_status_psiko">
<span<?= $Page->status_psiko->viewAttributes() ?>>
<?= $Page->status_psiko->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_psiko->Visible) { // ket_psiko ?>
        <td <?= $Page->ket_psiko->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_psiko" class="penilaian_awal_keperawatan_ralan_ket_psiko">
<span<?= $Page->ket_psiko->viewAttributes() ?>>
<?= $Page->ket_psiko->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hub_keluarga->Visible) { // hub_keluarga ?>
        <td <?= $Page->hub_keluarga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_hub_keluarga" class="penilaian_awal_keperawatan_ralan_hub_keluarga">
<span<?= $Page->hub_keluarga->viewAttributes() ?>>
<?= $Page->hub_keluarga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tinggal_dengan->Visible) { // tinggal_dengan ?>
        <td <?= $Page->tinggal_dengan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_tinggal_dengan" class="penilaian_awal_keperawatan_ralan_tinggal_dengan">
<span<?= $Page->tinggal_dengan->viewAttributes() ?>>
<?= $Page->tinggal_dengan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_tinggal->Visible) { // ket_tinggal ?>
        <td <?= $Page->ket_tinggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_tinggal" class="penilaian_awal_keperawatan_ralan_ket_tinggal">
<span<?= $Page->ket_tinggal->viewAttributes() ?>>
<?= $Page->ket_tinggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ekonomi->Visible) { // ekonomi ?>
        <td <?= $Page->ekonomi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ekonomi" class="penilaian_awal_keperawatan_ralan_ekonomi">
<span<?= $Page->ekonomi->viewAttributes() ?>>
<?= $Page->ekonomi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->budaya->Visible) { // budaya ?>
        <td <?= $Page->budaya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_budaya" class="penilaian_awal_keperawatan_ralan_budaya">
<span<?= $Page->budaya->viewAttributes() ?>>
<?= $Page->budaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_budaya->Visible) { // ket_budaya ?>
        <td <?= $Page->ket_budaya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_budaya" class="penilaian_awal_keperawatan_ralan_ket_budaya">
<span<?= $Page->ket_budaya->viewAttributes() ?>>
<?= $Page->ket_budaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->edukasi->Visible) { // edukasi ?>
        <td <?= $Page->edukasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_edukasi" class="penilaian_awal_keperawatan_ralan_edukasi">
<span<?= $Page->edukasi->viewAttributes() ?>>
<?= $Page->edukasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_edukasi->Visible) { // ket_edukasi ?>
        <td <?= $Page->ket_edukasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_edukasi" class="penilaian_awal_keperawatan_ralan_ket_edukasi">
<span<?= $Page->ket_edukasi->viewAttributes() ?>>
<?= $Page->ket_edukasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->berjalan_a->Visible) { // berjalan_a ?>
        <td <?= $Page->berjalan_a->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_berjalan_a" class="penilaian_awal_keperawatan_ralan_berjalan_a">
<span<?= $Page->berjalan_a->viewAttributes() ?>>
<?= $Page->berjalan_a->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->berjalan_b->Visible) { // berjalan_b ?>
        <td <?= $Page->berjalan_b->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_berjalan_b" class="penilaian_awal_keperawatan_ralan_berjalan_b">
<span<?= $Page->berjalan_b->viewAttributes() ?>>
<?= $Page->berjalan_b->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->berjalan_c->Visible) { // berjalan_c ?>
        <td <?= $Page->berjalan_c->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_berjalan_c" class="penilaian_awal_keperawatan_ralan_berjalan_c">
<span<?= $Page->berjalan_c->viewAttributes() ?>>
<?= $Page->berjalan_c->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
        <td <?= $Page->hasil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_hasil" class="penilaian_awal_keperawatan_ralan_hasil">
<span<?= $Page->hasil->viewAttributes() ?>>
<?= $Page->hasil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
        <td <?= $Page->lapor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_lapor" class="penilaian_awal_keperawatan_ralan_lapor">
<span<?= $Page->lapor->viewAttributes() ?>>
<?= $Page->lapor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
        <td <?= $Page->ket_lapor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_lapor" class="penilaian_awal_keperawatan_ralan_ket_lapor">
<span<?= $Page->ket_lapor->viewAttributes() ?>>
<?= $Page->ket_lapor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
        <td <?= $Page->sg1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_sg1" class="penilaian_awal_keperawatan_ralan_sg1">
<span<?= $Page->sg1->viewAttributes() ?>>
<?= $Page->sg1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
        <td <?= $Page->nilai1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_nilai1" class="penilaian_awal_keperawatan_ralan_nilai1">
<span<?= $Page->nilai1->viewAttributes() ?>>
<?= $Page->nilai1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
        <td <?= $Page->sg2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_sg2" class="penilaian_awal_keperawatan_ralan_sg2">
<span<?= $Page->sg2->viewAttributes() ?>>
<?= $Page->sg2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
        <td <?= $Page->nilai2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_nilai2" class="penilaian_awal_keperawatan_ralan_nilai2">
<span<?= $Page->nilai2->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_nilai2_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->nilai2->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->nilai2->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_nilai2_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
        <td <?= $Page->total_hasil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_total_hasil" class="penilaian_awal_keperawatan_ralan_total_hasil">
<span<?= $Page->total_hasil->viewAttributes() ?>>
<?= $Page->total_hasil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
        <td <?= $Page->nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_nyeri" class="penilaian_awal_keperawatan_ralan_nyeri">
<span<?= $Page->nyeri->viewAttributes() ?>>
<?= $Page->nyeri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
        <td <?= $Page->provokes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_provokes" class="penilaian_awal_keperawatan_ralan_provokes">
<span<?= $Page->provokes->viewAttributes() ?>>
<?= $Page->provokes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
        <td <?= $Page->ket_provokes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_provokes" class="penilaian_awal_keperawatan_ralan_ket_provokes">
<span<?= $Page->ket_provokes->viewAttributes() ?>>
<?= $Page->ket_provokes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
        <td <?= $Page->quality->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_quality" class="penilaian_awal_keperawatan_ralan_quality">
<span<?= $Page->quality->viewAttributes() ?>>
<?= $Page->quality->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
        <td <?= $Page->ket_quality->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_quality" class="penilaian_awal_keperawatan_ralan_ket_quality">
<span<?= $Page->ket_quality->viewAttributes() ?>>
<?= $Page->ket_quality->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <td <?= $Page->lokasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_lokasi" class="penilaian_awal_keperawatan_ralan_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
        <td <?= $Page->menyebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_menyebar" class="penilaian_awal_keperawatan_ralan_menyebar">
<span<?= $Page->menyebar->viewAttributes() ?>>
<?= $Page->menyebar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
        <td <?= $Page->skala_nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_skala_nyeri" class="penilaian_awal_keperawatan_ralan_skala_nyeri">
<span<?= $Page->skala_nyeri->viewAttributes() ?>>
<?= $Page->skala_nyeri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <td <?= $Page->durasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_durasi" class="penilaian_awal_keperawatan_ralan_durasi">
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <td <?= $Page->nyeri_hilang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_nyeri_hilang" class="penilaian_awal_keperawatan_ralan_nyeri_hilang">
<span<?= $Page->nyeri_hilang->viewAttributes() ?>>
<?= $Page->nyeri_hilang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
        <td <?= $Page->ket_nyeri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_nyeri" class="penilaian_awal_keperawatan_ralan_ket_nyeri">
<span<?= $Page->ket_nyeri->viewAttributes() ?>>
<?= $Page->ket_nyeri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
        <td <?= $Page->pada_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_pada_dokter" class="penilaian_awal_keperawatan_ralan_pada_dokter">
<span<?= $Page->pada_dokter->viewAttributes() ?>>
<?= $Page->pada_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
        <td <?= $Page->ket_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_ket_dokter" class="penilaian_awal_keperawatan_ralan_ket_dokter">
<span<?= $Page->ket_dokter->viewAttributes() ?>>
<?= $Page->ket_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
        <td <?= $Page->rencana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_rencana" class="penilaian_awal_keperawatan_ralan_rencana">
<span<?= $Page->rencana->viewAttributes() ?>>
<?= $Page->rencana->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <td <?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penilaian_awal_keperawatan_ralan_nip" class="penilaian_awal_keperawatan_ralan_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
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
