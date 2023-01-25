<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PemeriksaanRalanPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid pemeriksaan_ralan"><!-- .card -->
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
<?php if ($Page->tgl_perawatan->Visible) { // tgl_perawatan ?>
    <?php if ($Page->SortUrl($Page->tgl_perawatan) == "") { ?>
        <th class="<?= $Page->tgl_perawatan->headerCellClass() ?>"><?= $Page->tgl_perawatan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tgl_perawatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tgl_perawatan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tgl_perawatan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tgl_perawatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tgl_perawatan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jam_rawat->Visible) { // jam_rawat ?>
    <?php if ($Page->SortUrl($Page->jam_rawat) == "") { ?>
        <th class="<?= $Page->jam_rawat->headerCellClass() ?>"><?= $Page->jam_rawat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jam_rawat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->jam_rawat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->jam_rawat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->jam_rawat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->jam_rawat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->suhu_tubuh->Visible) { // suhu_tubuh ?>
    <?php if ($Page->SortUrl($Page->suhu_tubuh) == "") { ?>
        <th class="<?= $Page->suhu_tubuh->headerCellClass() ?>"><?= $Page->suhu_tubuh->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->suhu_tubuh->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->suhu_tubuh->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->suhu_tubuh->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->suhu_tubuh->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->suhu_tubuh->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tensi->Visible) { // tensi ?>
    <?php if ($Page->SortUrl($Page->tensi) == "") { ?>
        <th class="<?= $Page->tensi->headerCellClass() ?>"><?= $Page->tensi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tensi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tensi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tensi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tensi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tensi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->respirasi->Visible) { // respirasi ?>
    <?php if ($Page->SortUrl($Page->respirasi) == "") { ?>
        <th class="<?= $Page->respirasi->headerCellClass() ?>"><?= $Page->respirasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->respirasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->respirasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->respirasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->respirasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->respirasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tinggi->Visible) { // tinggi ?>
    <?php if ($Page->SortUrl($Page->tinggi) == "") { ?>
        <th class="<?= $Page->tinggi->headerCellClass() ?>"><?= $Page->tinggi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tinggi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tinggi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tinggi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tinggi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tinggi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->berat->Visible) { // berat ?>
    <?php if ($Page->SortUrl($Page->berat) == "") { ?>
        <th class="<?= $Page->berat->headerCellClass() ?>"><?= $Page->berat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->berat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->berat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->berat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->berat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->berat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->spo2->Visible) { // spo2 ?>
    <?php if ($Page->SortUrl($Page->spo2) == "") { ?>
        <th class="<?= $Page->spo2->headerCellClass() ?>"><?= $Page->spo2->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->spo2->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->spo2->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->spo2->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->spo2->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->spo2->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
    <?php if ($Page->SortUrl($Page->gcs) == "") { ?>
        <th class="<?= $Page->gcs->headerCellClass() ?>"><?= $Page->gcs->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->gcs->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->gcs->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->gcs->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->gcs->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->gcs->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
    <?php if ($Page->SortUrl($Page->kesadaran) == "") { ?>
        <th class="<?= $Page->kesadaran->headerCellClass() ?>"><?= $Page->kesadaran->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kesadaran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kesadaran->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kesadaran->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kesadaran->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kesadaran->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->lingkar_perut->Visible) { // lingkar_perut ?>
    <?php if ($Page->SortUrl($Page->lingkar_perut) == "") { ?>
        <th class="<?= $Page->lingkar_perut->headerCellClass() ?>"><?= $Page->lingkar_perut->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->lingkar_perut->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->lingkar_perut->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->lingkar_perut->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->lingkar_perut->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->lingkar_perut->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <?php if ($Page->SortUrl($Page->nip) == "") { ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><?= $Page->nip->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nip->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nip->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nip->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nip->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
    <?php if ($Page->SortUrl($Page->id_pemeriksaan_ralan) == "") { ?>
        <th class="<?= $Page->id_pemeriksaan_ralan->headerCellClass() ?>"><?= $Page->id_pemeriksaan_ralan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->id_pemeriksaan_ralan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->id_pemeriksaan_ralan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->id_pemeriksaan_ralan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->id_pemeriksaan_ralan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->id_pemeriksaan_ralan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->tgl_perawatan->Visible) { // tgl_perawatan ?>
        <!-- tgl_perawatan -->
        <td<?= $Page->tgl_perawatan->cellAttributes() ?>>
<span<?= $Page->tgl_perawatan->viewAttributes() ?>>
<?= $Page->tgl_perawatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jam_rawat->Visible) { // jam_rawat ?>
        <!-- jam_rawat -->
        <td<?= $Page->jam_rawat->cellAttributes() ?>>
<span<?= $Page->jam_rawat->viewAttributes() ?>>
<?= $Page->jam_rawat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->suhu_tubuh->Visible) { // suhu_tubuh ?>
        <!-- suhu_tubuh -->
        <td<?= $Page->suhu_tubuh->cellAttributes() ?>>
<span<?= $Page->suhu_tubuh->viewAttributes() ?>>
<?= $Page->suhu_tubuh->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tensi->Visible) { // tensi ?>
        <!-- tensi -->
        <td<?= $Page->tensi->cellAttributes() ?>>
<span<?= $Page->tensi->viewAttributes() ?>>
<?= $Page->tensi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nadi->Visible) { // nadi ?>
        <!-- nadi -->
        <td<?= $Page->nadi->cellAttributes() ?>>
<span<?= $Page->nadi->viewAttributes() ?>>
<?= $Page->nadi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->respirasi->Visible) { // respirasi ?>
        <!-- respirasi -->
        <td<?= $Page->respirasi->cellAttributes() ?>>
<span<?= $Page->respirasi->viewAttributes() ?>>
<?= $Page->respirasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tinggi->Visible) { // tinggi ?>
        <!-- tinggi -->
        <td<?= $Page->tinggi->cellAttributes() ?>>
<span<?= $Page->tinggi->viewAttributes() ?>>
<?= $Page->tinggi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->berat->Visible) { // berat ?>
        <!-- berat -->
        <td<?= $Page->berat->cellAttributes() ?>>
<span<?= $Page->berat->viewAttributes() ?>>
<?= $Page->berat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->spo2->Visible) { // spo2 ?>
        <!-- spo2 -->
        <td<?= $Page->spo2->cellAttributes() ?>>
<span<?= $Page->spo2->viewAttributes() ?>>
<?= $Page->spo2->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->gcs->Visible) { // gcs ?>
        <!-- gcs -->
        <td<?= $Page->gcs->cellAttributes() ?>>
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kesadaran->Visible) { // kesadaran ?>
        <!-- kesadaran -->
        <td<?= $Page->kesadaran->cellAttributes() ?>>
<span<?= $Page->kesadaran->viewAttributes() ?>>
<?= $Page->kesadaran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->alergi->Visible) { // alergi ?>
        <!-- alergi -->
        <td<?= $Page->alergi->cellAttributes() ?>>
<span<?= $Page->alergi->viewAttributes() ?>>
<?= $Page->alergi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->lingkar_perut->Visible) { // lingkar_perut ?>
        <!-- lingkar_perut -->
        <td<?= $Page->lingkar_perut->cellAttributes() ?>>
<span<?= $Page->lingkar_perut->viewAttributes() ?>>
<?= $Page->lingkar_perut->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <!-- nip -->
        <td<?= $Page->nip->cellAttributes() ?>>
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->id_pemeriksaan_ralan->Visible) { // id_pemeriksaan_ralan ?>
        <!-- id_pemeriksaan_ralan -->
        <td<?= $Page->id_pemeriksaan_ralan->cellAttributes() ?>>
<span<?= $Page->id_pemeriksaan_ralan->viewAttributes() ?>>
<?= $Page->id_pemeriksaan_ralan->getViewValue() ?></span>
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
