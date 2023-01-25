<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianPsikologiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenilaian_psikologiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenilaian_psikologiview = currentForm = new ew.Form("fpenilaian_psikologiview", "view");
    loadjs.done("fpenilaian_psikologiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penilaian_psikologi) ew.vars.tables.penilaian_psikologi = <?= JsonEncode(GetClientVar("tables", "penilaian_psikologi")) ?>;
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
<form name="fpenilaian_psikologiview" id="fpenilaian_psikologiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penilaian_psikologi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_penilaian_psikologi_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_penilaian_psikologi_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <tr id="r_nip">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_nip"><?= $Page->nip->caption() ?></span></td>
        <td data-name="nip" <?= $Page->nip->cellAttributes() ?>>
<span id="el_penilaian_psikologi_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <tr id="r_anamnesis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_anamnesis"><?= $Page->anamnesis->caption() ?></span></td>
        <td data-name="anamnesis" <?= $Page->anamnesis->cellAttributes() ?>>
<span id="el_penilaian_psikologi_anamnesis">
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
    <tr id="r_dikirim_dari">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_dikirim_dari"><?= $Page->dikirim_dari->caption() ?></span></td>
        <td data-name="dikirim_dari" <?= $Page->dikirim_dari->cellAttributes() ?>>
<span id="el_penilaian_psikologi_dikirim_dari">
<span<?= $Page->dikirim_dari->viewAttributes() ?>>
<?= $Page->dikirim_dari->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
    <tr id="r_tujuan_pemeriksaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_tujuan_pemeriksaan"><?= $Page->tujuan_pemeriksaan->caption() ?></span></td>
        <td data-name="tujuan_pemeriksaan" <?= $Page->tujuan_pemeriksaan->cellAttributes() ?>>
<span id="el_penilaian_psikologi_tujuan_pemeriksaan">
<span<?= $Page->tujuan_pemeriksaan->viewAttributes() ?>>
<?= $Page->tujuan_pemeriksaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ket_anamnesis->Visible) { // ket_anamnesis ?>
    <tr id="r_ket_anamnesis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_ket_anamnesis"><?= $Page->ket_anamnesis->caption() ?></span></td>
        <td data-name="ket_anamnesis" <?= $Page->ket_anamnesis->cellAttributes() ?>>
<span id="el_penilaian_psikologi_ket_anamnesis">
<span<?= $Page->ket_anamnesis->viewAttributes() ?>>
<?= $Page->ket_anamnesis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rupa->Visible) { // rupa ?>
    <tr id="r_rupa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_rupa"><?= $Page->rupa->caption() ?></span></td>
        <td data-name="rupa" <?= $Page->rupa->cellAttributes() ?>>
<span id="el_penilaian_psikologi_rupa">
<span<?= $Page->rupa->viewAttributes() ?>>
<?= $Page->rupa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
    <tr id="r_bentuk_tubuh">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_bentuk_tubuh"><?= $Page->bentuk_tubuh->caption() ?></span></td>
        <td data-name="bentuk_tubuh" <?= $Page->bentuk_tubuh->cellAttributes() ?>>
<span id="el_penilaian_psikologi_bentuk_tubuh">
<span<?= $Page->bentuk_tubuh->viewAttributes() ?>>
<?= $Page->bentuk_tubuh->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tindakan->Visible) { // tindakan ?>
    <tr id="r_tindakan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_tindakan"><?= $Page->tindakan->caption() ?></span></td>
        <td data-name="tindakan" <?= $Page->tindakan->cellAttributes() ?>>
<span id="el_penilaian_psikologi_tindakan">
<span<?= $Page->tindakan->viewAttributes() ?>>
<?= $Page->tindakan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pakaian->Visible) { // pakaian ?>
    <tr id="r_pakaian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_pakaian"><?= $Page->pakaian->caption() ?></span></td>
        <td data-name="pakaian" <?= $Page->pakaian->cellAttributes() ?>>
<span id="el_penilaian_psikologi_pakaian">
<span<?= $Page->pakaian->viewAttributes() ?>>
<?= $Page->pakaian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ekspresi->Visible) { // ekspresi ?>
    <tr id="r_ekspresi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_ekspresi"><?= $Page->ekspresi->caption() ?></span></td>
        <td data-name="ekspresi" <?= $Page->ekspresi->cellAttributes() ?>>
<span id="el_penilaian_psikologi_ekspresi">
<span<?= $Page->ekspresi->viewAttributes() ?>>
<?= $Page->ekspresi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->berbicara->Visible) { // berbicara ?>
    <tr id="r_berbicara">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_berbicara"><?= $Page->berbicara->caption() ?></span></td>
        <td data-name="berbicara" <?= $Page->berbicara->cellAttributes() ?>>
<span id="el_penilaian_psikologi_berbicara">
<span<?= $Page->berbicara->viewAttributes() ?>>
<?= $Page->berbicara->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
    <tr id="r_penggunaan_kata">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_penggunaan_kata"><?= $Page->penggunaan_kata->caption() ?></span></td>
        <td data-name="penggunaan_kata" <?= $Page->penggunaan_kata->cellAttributes() ?>>
<span id="el_penilaian_psikologi_penggunaan_kata">
<span<?= $Page->penggunaan_kata->viewAttributes() ?>>
<?= $Page->penggunaan_kata->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ciri_menyolok->Visible) { // ciri_menyolok ?>
    <tr id="r_ciri_menyolok">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_ciri_menyolok"><?= $Page->ciri_menyolok->caption() ?></span></td>
        <td data-name="ciri_menyolok" <?= $Page->ciri_menyolok->cellAttributes() ?>>
<span id="el_penilaian_psikologi_ciri_menyolok">
<span<?= $Page->ciri_menyolok->viewAttributes() ?>>
<?= $Page->ciri_menyolok->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hasil_psikotes->Visible) { // hasil_psikotes ?>
    <tr id="r_hasil_psikotes">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_hasil_psikotes"><?= $Page->hasil_psikotes->caption() ?></span></td>
        <td data-name="hasil_psikotes" <?= $Page->hasil_psikotes->cellAttributes() ?>>
<span id="el_penilaian_psikologi_hasil_psikotes">
<span<?= $Page->hasil_psikotes->viewAttributes() ?>>
<?= $Page->hasil_psikotes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kepribadian->Visible) { // kepribadian ?>
    <tr id="r_kepribadian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_kepribadian"><?= $Page->kepribadian->caption() ?></span></td>
        <td data-name="kepribadian" <?= $Page->kepribadian->cellAttributes() ?>>
<span id="el_penilaian_psikologi_kepribadian">
<span<?= $Page->kepribadian->viewAttributes() ?>>
<?= $Page->kepribadian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->psikodinamika->Visible) { // psikodinamika ?>
    <tr id="r_psikodinamika">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_psikodinamika"><?= $Page->psikodinamika->caption() ?></span></td>
        <td data-name="psikodinamika" <?= $Page->psikodinamika->cellAttributes() ?>>
<span id="el_penilaian_psikologi_psikodinamika">
<span<?= $Page->psikodinamika->viewAttributes() ?>>
<?= $Page->psikodinamika->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kesimpulan_psikolog->Visible) { // kesimpulan_psikolog ?>
    <tr id="r_kesimpulan_psikolog">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penilaian_psikologi_kesimpulan_psikolog"><?= $Page->kesimpulan_psikolog->caption() ?></span></td>
        <td data-name="kesimpulan_psikolog" <?= $Page->kesimpulan_psikolog->cellAttributes() ?>>
<span id="el_penilaian_psikologi_kesimpulan_psikolog">
<span<?= $Page->kesimpulan_psikolog->viewAttributes() ?>>
<?= $Page->kesimpulan_psikolog->getViewValue() ?></span>
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
