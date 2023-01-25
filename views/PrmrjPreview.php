<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PrmrjPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid prmrj"><!-- .card -->
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
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <?php if ($Page->SortUrl($Page->no_rkm_medis) == "") { ?>
        <th class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><?= $Page->no_rkm_medis->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->no_rkm_medis->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->no_rkm_medis->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->no_rkm_medis->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->no_rkm_medis->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <?php if ($Page->SortUrl($Page->kd_poli) == "") { ?>
        <th class="<?= $Page->kd_poli->headerCellClass() ?>"><?= $Page->kd_poli->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kd_poli->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kd_poli->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kd_poli->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kd_poli->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kd_poli->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
    <?php if ($Page->SortUrl($Page->kd_penyakit) == "") { ?>
        <th class="<?= $Page->kd_penyakit->headerCellClass() ?>"><?= $Page->kd_penyakit->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kd_penyakit->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kd_penyakit->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kd_penyakit->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kd_penyakit->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kd_penyakit->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
    <?php if ($Page->SortUrl($Page->alergi) == "") { ?>
        <th class="<?= $Page->alergi->headerCellClass() ?>"><?= $Page->alergi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->alergi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->alergi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->alergi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->alergi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->alergi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->kd_icd9->Visible) { // kd_icd9 ?>
    <?php if ($Page->SortUrl($Page->kd_icd9) == "") { ?>
        <th class="<?= $Page->kd_icd9->headerCellClass() ?>"><?= $Page->kd_icd9->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kd_icd9->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kd_icd9->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kd_icd9->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kd_icd9->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kd_icd9->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->cetak->Visible) { // cetak ?>
    <?php if ($Page->SortUrl($Page->cetak) == "") { ?>
        <th class="<?= $Page->cetak->headerCellClass() ?>"><?= $Page->cetak->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->cetak->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->cetak->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->cetak->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->cetak->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->cetak->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <!-- no_rkm_medis -->
        <td<?= $Page->no_rkm_medis->cellAttributes() ?>>
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tgl_registrasi->Visible) { // tgl_registrasi ?>
        <!-- tgl_registrasi -->
        <td<?= $Page->tgl_registrasi->cellAttributes() ?>>
<span<?= $Page->tgl_registrasi->viewAttributes() ?>>
<?= $Page->tgl_registrasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <!-- kd_poli -->
        <td<?= $Page->kd_poli->cellAttributes() ?>>
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <!-- kd_penyakit -->
        <td<?= $Page->kd_penyakit->cellAttributes() ?>>
<span<?= $Page->kd_penyakit->viewAttributes() ?>>
<?= $Page->kd_penyakit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <!-- alergi -->
        <td<?= $Page->alergi->cellAttributes() ?>>
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <!-- kd_dokter -->
        <td<?= $Page->kd_dokter->cellAttributes() ?>>
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_icd9->Visible) { // kd_icd9 ?>
        <!-- kd_icd9 -->
        <td<?= $Page->kd_icd9->cellAttributes() ?>>
<span<?= $Page->kd_icd9->viewAttributes() ?>>
<?= $Page->kd_icd9->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->cetak->Visible) { // cetak ?>
        <!-- cetak -->
        <td<?= $Page->cetak->cellAttributes() ?>>
<span<?= $Page->cetak->viewAttributes() ?>><!--<button type="button" class="btn btn-primary">Cetak</button>-->
<a class="btn btn-info btn-sm"
	href="../PrmrjList"
target="_blank">Cetak</a>
</span>
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
