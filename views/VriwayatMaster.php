<?php

namespace PHPMaker2021\project4sikdec;

// Table
$vriwayat = Container("vriwayat");
?>
<?php if ($vriwayat->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_vriwayatmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($vriwayat->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <tr id="r_no_rkm_medis">
            <td class="<?= $vriwayat->TableLeftColumnClass ?>"><?= $vriwayat->no_rkm_medis->caption() ?></td>
            <td <?= $vriwayat->no_rkm_medis->cellAttributes() ?>>
<span id="el_vriwayat_no_rkm_medis">
<span<?= $vriwayat->no_rkm_medis->viewAttributes() ?>>
<?= $vriwayat->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vriwayat->nm_pasien->Visible) { // nm_pasien ?>
        <tr id="r_nm_pasien">
            <td class="<?= $vriwayat->TableLeftColumnClass ?>"><?= $vriwayat->nm_pasien->caption() ?></td>
            <td <?= $vriwayat->nm_pasien->cellAttributes() ?>>
<span id="el_vriwayat_nm_pasien">
<span<?= $vriwayat->nm_pasien->viewAttributes() ?>>
<?= $vriwayat->nm_pasien->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vriwayat->jk->Visible) { // jk ?>
        <tr id="r_jk">
            <td class="<?= $vriwayat->TableLeftColumnClass ?>"><?= $vriwayat->jk->caption() ?></td>
            <td <?= $vriwayat->jk->cellAttributes() ?>>
<span id="el_vriwayat_jk">
<span<?= $vriwayat->jk->viewAttributes() ?>>
<?= $vriwayat->jk->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vriwayat->nm_ibu->Visible) { // nm_ibu ?>
        <tr id="r_nm_ibu">
            <td class="<?= $vriwayat->TableLeftColumnClass ?>"><?= $vriwayat->nm_ibu->caption() ?></td>
            <td <?= $vriwayat->nm_ibu->cellAttributes() ?>>
<span id="el_vriwayat_nm_ibu">
<span<?= $vriwayat->nm_ibu->viewAttributes() ?>>
<?= $vriwayat->nm_ibu->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vriwayat->alamat->Visible) { // alamat ?>
        <tr id="r_alamat">
            <td class="<?= $vriwayat->TableLeftColumnClass ?>"><?= $vriwayat->alamat->caption() ?></td>
            <td <?= $vriwayat->alamat->cellAttributes() ?>>
<span id="el_vriwayat_alamat">
<span<?= $vriwayat->alamat->viewAttributes() ?>>
<?= $vriwayat->alamat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vriwayat->tgl_daftar->Visible) { // tgl_daftar ?>
        <tr id="r_tgl_daftar">
            <td class="<?= $vriwayat->TableLeftColumnClass ?>"><?= $vriwayat->tgl_daftar->caption() ?></td>
            <td <?= $vriwayat->tgl_daftar->cellAttributes() ?>>
<span id="el_vriwayat_tgl_daftar">
<span<?= $vriwayat->tgl_daftar->viewAttributes() ?>>
<?= $vriwayat->tgl_daftar->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
