<?php

namespace PHPMaker2021\project4sikdec;

// Table
$vigd = Container("vigd");
?>
<?php if ($vigd->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_vigdmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($vigd->id_reg->Visible) { // id_reg ?>
        <tr id="r_id_reg">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->id_reg->caption() ?></td>
            <td <?= $vigd->id_reg->cellAttributes() ?>>
<span id="el_vigd_id_reg">
<span<?= $vigd->id_reg->viewAttributes() ?>>
<?= $vigd->id_reg->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vigd->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <tr id="r_tgl_registrasi">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->tgl_registrasi->caption() ?></td>
            <td <?= $vigd->tgl_registrasi->cellAttributes() ?>>
<span id="el_vigd_tgl_registrasi">
<span<?= $vigd->tgl_registrasi->viewAttributes() ?>>
<?= $vigd->tgl_registrasi->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vigd->jam_reg->Visible) { // jam_reg ?>
        <tr id="r_jam_reg">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->jam_reg->caption() ?></td>
            <td <?= $vigd->jam_reg->cellAttributes() ?>>
<span id="el_vigd_jam_reg">
<span<?= $vigd->jam_reg->viewAttributes() ?>>
<?= $vigd->jam_reg->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vigd->kd_dokter->Visible) { // kd_dokter ?>
        <tr id="r_kd_dokter">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->kd_dokter->caption() ?></td>
            <td <?= $vigd->kd_dokter->cellAttributes() ?>>
<span id="el_vigd_kd_dokter">
<span<?= $vigd->kd_dokter->viewAttributes() ?>>
<?= $vigd->kd_dokter->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vigd->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <tr id="r_no_rkm_medis">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->no_rkm_medis->caption() ?></td>
            <td <?= $vigd->no_rkm_medis->cellAttributes() ?>>
<span id="el_vigd_no_rkm_medis">
<span<?= $vigd->no_rkm_medis->viewAttributes() ?>>
<?= $vigd->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vigd->kd_poli->Visible) { // kd_poli ?>
        <tr id="r_kd_poli">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->kd_poli->caption() ?></td>
            <td <?= $vigd->kd_poli->cellAttributes() ?>>
<span id="el_vigd_kd_poli">
<span<?= $vigd->kd_poli->viewAttributes() ?>>
<?= $vigd->kd_poli->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vigd->stts->Visible) { // stts ?>
        <tr id="r_stts">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->stts->caption() ?></td>
            <td <?= $vigd->stts->cellAttributes() ?>>
<span id="el_vigd_stts">
<span<?= $vigd->stts->viewAttributes() ?>>
<?= $vigd->stts->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($vigd->status_lanjut->Visible) { // status_lanjut ?>
        <tr id="r_status_lanjut">
            <td class="<?= $vigd->TableLeftColumnClass ?>"><?= $vigd->status_lanjut->caption() ?></td>
            <td <?= $vigd->status_lanjut->cellAttributes() ?>>
<span id="el_vigd_status_lanjut">
<span<?= $vigd->status_lanjut->viewAttributes() ?>>
<?= $vigd->status_lanjut->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
