<?php

namespace PHPMaker2021\project4sikdec;

// Table
$vrajal = Container("vrajal");
?>
<?php if ($vrajal->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_vrajalmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($vrajal->id_reg->Visible) { // id_reg ?>
        <tr id="r_id_reg">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->id_reg->caption() ?></td>
            <td <?= $vrajal->id_reg->cellAttributes() ?>>
<span id="el_vrajal_id_reg">
<span<?= $vrajal->id_reg->viewAttributes() ?>>
<?= $vrajal->id_reg->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vrajal->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <tr id="r_no_rkm_medis">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->no_rkm_medis->caption() ?></td>
            <td <?= $vrajal->no_rkm_medis->cellAttributes() ?>>
<span id="el_vrajal_no_rkm_medis">
<span<?= $vrajal->no_rkm_medis->viewAttributes() ?>>
<?= $vrajal->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vrajal->kd_poli->Visible) { // kd_poli ?>
        <tr id="r_kd_poli">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->kd_poli->caption() ?></td>
            <td <?= $vrajal->kd_poli->cellAttributes() ?>>
<span id="el_vrajal_kd_poli">
<span<?= $vrajal->kd_poli->viewAttributes() ?>>
<?= $vrajal->kd_poli->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vrajal->kd_dokter->Visible) { // kd_dokter ?>
        <tr id="r_kd_dokter">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->kd_dokter->caption() ?></td>
            <td <?= $vrajal->kd_dokter->cellAttributes() ?>>
<span id="el_vrajal_kd_dokter">
<span<?= $vrajal->kd_dokter->viewAttributes() ?>>
<?= $vrajal->kd_dokter->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vrajal->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <tr id="r_tgl_registrasi">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->tgl_registrasi->caption() ?></td>
            <td <?= $vrajal->tgl_registrasi->cellAttributes() ?>>
<span id="el_vrajal_tgl_registrasi">
<span<?= $vrajal->tgl_registrasi->viewAttributes() ?>>
<?= $vrajal->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vrajal->jam_reg->Visible) { // jam_reg ?>
        <tr id="r_jam_reg">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->jam_reg->caption() ?></td>
            <td <?= $vrajal->jam_reg->cellAttributes() ?>>
<span id="el_vrajal_jam_reg">
<span<?= $vrajal->jam_reg->viewAttributes() ?>>
<?= $vrajal->jam_reg->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vrajal->stts->Visible) { // stts ?>
        <tr id="r_stts">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->stts->caption() ?></td>
            <td <?= $vrajal->stts->cellAttributes() ?>>
<span id="el_vrajal_stts">
<span<?= $vrajal->stts->viewAttributes() ?>>
<?= $vrajal->stts->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vrajal->status_lanjut->Visible) { // status_lanjut ?>
        <tr id="r_status_lanjut">
            <td class="<?= $vrajal->TableLeftColumnClass ?>"><?= $vrajal->status_lanjut->caption() ?></td>
            <td <?= $vrajal->status_lanjut->cellAttributes() ?>>
<span id="el_vrajal_status_lanjut">
<span<?= $vrajal->status_lanjut->viewAttributes() ?>>
<?= $vrajal->status_lanjut->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
