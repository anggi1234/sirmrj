<?php

namespace PHPMaker2021\project4sikdec;

// Table
$pasien = Container("pasien");
?>
<?php if ($pasien->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_pasienmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($pasien->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <tr id="r_no_rkm_medis">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->no_rkm_medis->caption() ?></td>
            <td <?= $pasien->no_rkm_medis->cellAttributes() ?>>
<span id="el_pasien_no_rkm_medis">
<span<?= $pasien->no_rkm_medis->viewAttributes() ?>>
<?= $pasien->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->nm_pasien->Visible) { // nm_pasien ?>
        <tr id="r_nm_pasien">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->nm_pasien->caption() ?></td>
            <td <?= $pasien->nm_pasien->cellAttributes() ?>>
<span id="el_pasien_nm_pasien">
<span<?= $pasien->nm_pasien->viewAttributes() ?>>
<?= $pasien->nm_pasien->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->jk->Visible) { // jk ?>
        <tr id="r_jk">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->jk->caption() ?></td>
            <td <?= $pasien->jk->cellAttributes() ?>>
<span id="el_pasien_jk">
<span<?= $pasien->jk->viewAttributes() ?>>
<?= $pasien->jk->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->nm_ibu->Visible) { // nm_ibu ?>
        <tr id="r_nm_ibu">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->nm_ibu->caption() ?></td>
            <td <?= $pasien->nm_ibu->cellAttributes() ?>>
<span id="el_pasien_nm_ibu">
<span<?= $pasien->nm_ibu->viewAttributes() ?>>
<?= $pasien->nm_ibu->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->alamat->Visible) { // alamat ?>
        <tr id="r_alamat">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->alamat->caption() ?></td>
            <td <?= $pasien->alamat->cellAttributes() ?>>
<span id="el_pasien_alamat">
<span<?= $pasien->alamat->viewAttributes() ?>>
<?= $pasien->alamat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->tgl_daftar->Visible) { // tgl_daftar ?>
        <tr id="r_tgl_daftar">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->tgl_daftar->caption() ?></td>
            <td <?= $pasien->tgl_daftar->cellAttributes() ?>>
<span id="el_pasien_tgl_daftar">
<span<?= $pasien->tgl_daftar->viewAttributes() ?>>
<?= $pasien->tgl_daftar->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
