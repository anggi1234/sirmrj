<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PasienKunjunganPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid pasien_kunjungan"><!-- .card -->
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
    <thead><!-- Table header -->
        <tr class="ew-table-header">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id_reg->Visible) { // id_reg ?>
    <?php if ($Page->SortUrl($Page->id_reg) == "") { ?>
        <th class="<?= $Page->id_reg->headerCellClass() ?>"><?= $Page->id_reg->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->id_reg->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->id_reg->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->id_reg->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->id_reg->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->id_reg->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <?php if ($Page->SortUrl($Page->no_rkm_medis) == "") { ?>
        <th class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><?= $Page->no_rkm_medis->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->no_rkm_medis->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->no_rkm_medis->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->no_rkm_medis->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->no_rkm_medis->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <?php if ($Page->SortUrl($Page->kd_poli) == "") { ?>
        <th class="<?= $Page->kd_poli->headerCellClass() ?>"><?= $Page->kd_poli->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kd_poli->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kd_poli->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kd_poli->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kd_poli->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kd_poli->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <?php if ($Page->SortUrl($Page->kd_dokter) == "") { ?>
        <th class="<?= $Page->kd_dokter->headerCellClass() ?>"><?= $Page->kd_dokter->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kd_dokter->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kd_dokter->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kd_dokter->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kd_dokter->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kd_dokter->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
    <?php if ($Page->SortUrl($Page->tgl_registrasi) == "") { ?>
        <th class="<?= $Page->tgl_registrasi->headerCellClass() ?>"><?= $Page->tgl_registrasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tgl_registrasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tgl_registrasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tgl_registrasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tgl_registrasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tgl_registrasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jam_reg->Visible) { // jam_reg ?>
    <?php if ($Page->SortUrl($Page->jam_reg) == "") { ?>
        <th class="<?= $Page->jam_reg->headerCellClass() ?>"><?= $Page->jam_reg->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jam_reg->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->jam_reg->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->jam_reg->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->jam_reg->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->jam_reg->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
        </tr>
    </thead>
    <tbody><!-- Table body -->
<?php
$Page->RecCount = 0;
$Page->RowCount = 0;
while ($Page->Recordset && !$Page->Recordset->EOF) {
    // Init row class and style
    $Page->RecCount++;
    $Page->RowCount++;
    $Page->CssStyle = "";
    $Page->loadListRowValues($Page->Recordset);

    // Render row
    $Page->RowType = ROWTYPE_PREVIEW; // Preview record
    $Page->resetAttributes();
    $Page->renderListRow();

    // Render list options
    $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
<?php if ($Page->id_reg->Visible) { // id_reg ?>
        <!-- id_reg -->
        <td<?= $Page->id_reg->cellAttributes() ?>>
<span<?= $Page->id_reg->viewAttributes() ?>>
<?= $Page->id_reg->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <!-- no_rkm_medis -->
        <td<?= $Page->no_rkm_medis->cellAttributes() ?>>
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <!-- kd_poli -->
        <td<?= $Page->kd_poli->cellAttributes() ?>>
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <!-- kd_dokter -->
        <td<?= $Page->kd_dokter->cellAttributes() ?>>
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <!-- tgl_registrasi -->
        <td<?= $Page->tgl_registrasi->cellAttributes() ?>>
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jam_reg->Visible) { // jam_reg ?>
        <!-- jam_reg -->
        <td<?= $Page->jam_reg->cellAttributes() ?>>
<span<?= $Page->jam_reg->viewAttributes() ?>>
<?= $Page->jam_reg->getViewValue() ?></span>
</td>
<?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    $Page->Recordset->moveNext();
} // while
?>
    </tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?= $Page->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?= $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
    foreach ($Page->OtherOptions as $option)
        $option->render("body");
?>
</div>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
