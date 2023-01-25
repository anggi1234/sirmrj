<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianMedisRalanPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid penilaian_medis_ralan"><!-- .card -->
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <?php if ($Page->SortUrl($Page->no_rawat) == "") { ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><?= $Page->no_rawat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->no_rawat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->no_rawat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->no_rawat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->no_rawat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <?php if ($Page->SortUrl($Page->tanggal) == "") { ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><?= $Page->tanggal->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tanggal->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tanggal->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tanggal->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
    <?php if ($Page->SortUrl($Page->anamnesis) == "") { ?>
        <th class="<?= $Page->anamnesis->headerCellClass() ?>"><?= $Page->anamnesis->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->anamnesis->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->anamnesis->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->anamnesis->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->anamnesis->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->anamnesis->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
    <?php if ($Page->SortUrl($Page->keluhan_utama) == "") { ?>
        <th class="<?= $Page->keluhan_utama->headerCellClass() ?>"><?= $Page->keluhan_utama->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->keluhan_utama->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->keluhan_utama->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->keluhan_utama->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->keluhan_utama->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->keluhan_utama->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <?php if ($Page->SortUrl($Page->keadaan) == "") { ?>
        <th class="<?= $Page->keadaan->headerCellClass() ?>"><?= $Page->keadaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->keadaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->keadaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->keadaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->keadaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->keadaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
    <?php if ($Page->SortUrl($Page->td) == "") { ?>
        <th class="<?= $Page->td->headerCellClass() ?>"><?= $Page->td->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->td->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->td->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->td->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->td->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->td->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
    <?php if ($Page->SortUrl($Page->nadi) == "") { ?>
        <th class="<?= $Page->nadi->headerCellClass() ?>"><?= $Page->nadi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nadi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nadi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nadi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nadi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nadi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
    <?php if ($Page->SortUrl($Page->rr) == "") { ?>
        <th class="<?= $Page->rr->headerCellClass() ?>"><?= $Page->rr->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rr->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rr->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rr->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rr->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rr->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
    <?php if ($Page->SortUrl($Page->suhu) == "") { ?>
        <th class="<?= $Page->suhu->headerCellClass() ?>"><?= $Page->suhu->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->suhu->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->suhu->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->suhu->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->suhu->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->suhu->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
    <?php if ($Page->SortUrl($Page->bb) == "") { ?>
        <th class="<?= $Page->bb->headerCellClass() ?>"><?= $Page->bb->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->bb->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->bb->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->bb->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->bb->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->bb->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
    <?php if ($Page->SortUrl($Page->tb) == "") { ?>
        <th class="<?= $Page->tb->headerCellClass() ?>"><?= $Page->tb->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tb->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tb->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tb->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tb->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tb->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
    <?php if ($Page->SortUrl($Page->diagnosis) == "") { ?>
        <th class="<?= $Page->diagnosis->headerCellClass() ?>"><?= $Page->diagnosis->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->diagnosis->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->diagnosis->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->diagnosis->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->diagnosis->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->diagnosis->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <!-- no_rawat -->
        <td<?= $Page->no_rawat->cellAttributes() ?>>
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <!-- tanggal -->
        <td<?= $Page->tanggal->cellAttributes() ?>>
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <!-- kd_dokter -->
        <td<?= $Page->kd_dokter->cellAttributes() ?>>
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <!-- anamnesis -->
        <td<?= $Page->anamnesis->cellAttributes() ?>>
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->keluhan_utama->Visible) { // keluhan_utama ?>
        <!-- keluhan_utama -->
        <td<?= $Page->keluhan_utama->cellAttributes() ?>>
<span<?= $Page->keluhan_utama->viewAttributes() ?>>
<?= $Page->keluhan_utama->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <!-- alergi -->
        <td<?= $Page->alergi->cellAttributes() ?>>
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <!-- keadaan -->
        <td<?= $Page->keadaan->cellAttributes() ?>>
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->td->Visible) { // td ?>
        <!-- td -->
        <td<?= $Page->td->cellAttributes() ?>>
<span<?= $Page->td->viewAttributes() ?>>
<?= $Page->td->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <!-- nadi -->
        <td<?= $Page->nadi->cellAttributes() ?>>
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rr->Visible) { // rr ?>
        <!-- rr -->
        <td<?= $Page->rr->cellAttributes() ?>>
<span<?= $Page->rr->viewAttributes() ?>>
<?= $Page->rr->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->suhu->Visible) { // suhu ?>
        <!-- suhu -->
        <td<?= $Page->suhu->cellAttributes() ?>>
<span<?= $Page->suhu->viewAttributes() ?>>
<?= $Page->suhu->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->bb->Visible) { // bb ?>
        <!-- bb -->
        <td<?= $Page->bb->cellAttributes() ?>>
<span<?= $Page->bb->viewAttributes() ?>>
<?= $Page->bb->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tb->Visible) { // tb ?>
        <!-- tb -->
        <td<?= $Page->tb->cellAttributes() ?>>
<span<?= $Page->tb->viewAttributes() ?>>
<?= $Page->tb->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->diagnosis->Visible) { // diagnosis ?>
        <!-- diagnosis -->
        <td<?= $Page->diagnosis->cellAttributes() ?>>
<span<?= $Page->diagnosis->viewAttributes() ?>>
<?= $Page->diagnosis->getViewValue() ?></span>
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
