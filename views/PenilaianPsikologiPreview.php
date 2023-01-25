<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianPsikologiPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid penilaian_psikologi"><!-- .card -->
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
<?php if ($Page->nip->Visible) { // nip ?>
    <?php if ($Page->SortUrl($Page->nip) == "") { ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><?= $Page->nip->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nip->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nip->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nip->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nip->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
    <?php if ($Page->SortUrl($Page->dikirim_dari) == "") { ?>
        <th class="<?= $Page->dikirim_dari->headerCellClass() ?>"><?= $Page->dikirim_dari->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->dikirim_dari->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->dikirim_dari->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->dikirim_dari->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->dikirim_dari->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->dikirim_dari->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
    <?php if ($Page->SortUrl($Page->tujuan_pemeriksaan) == "") { ?>
        <th class="<?= $Page->tujuan_pemeriksaan->headerCellClass() ?>"><?= $Page->tujuan_pemeriksaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tujuan_pemeriksaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tujuan_pemeriksaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tujuan_pemeriksaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tujuan_pemeriksaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tujuan_pemeriksaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rupa->Visible) { // rupa ?>
    <?php if ($Page->SortUrl($Page->rupa) == "") { ?>
        <th class="<?= $Page->rupa->headerCellClass() ?>"><?= $Page->rupa->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rupa->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rupa->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rupa->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rupa->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rupa->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
    <?php if ($Page->SortUrl($Page->bentuk_tubuh) == "") { ?>
        <th class="<?= $Page->bentuk_tubuh->headerCellClass() ?>"><?= $Page->bentuk_tubuh->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->bentuk_tubuh->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->bentuk_tubuh->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->bentuk_tubuh->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->bentuk_tubuh->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->bentuk_tubuh->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tindakan->Visible) { // tindakan ?>
    <?php if ($Page->SortUrl($Page->tindakan) == "") { ?>
        <th class="<?= $Page->tindakan->headerCellClass() ?>"><?= $Page->tindakan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tindakan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tindakan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tindakan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tindakan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tindakan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->pakaian->Visible) { // pakaian ?>
    <?php if ($Page->SortUrl($Page->pakaian) == "") { ?>
        <th class="<?= $Page->pakaian->headerCellClass() ?>"><?= $Page->pakaian->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->pakaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->pakaian->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->pakaian->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->pakaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->pakaian->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ekspresi->Visible) { // ekspresi ?>
    <?php if ($Page->SortUrl($Page->ekspresi) == "") { ?>
        <th class="<?= $Page->ekspresi->headerCellClass() ?>"><?= $Page->ekspresi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ekspresi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ekspresi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ekspresi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ekspresi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ekspresi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->berbicara->Visible) { // berbicara ?>
    <?php if ($Page->SortUrl($Page->berbicara) == "") { ?>
        <th class="<?= $Page->berbicara->headerCellClass() ?>"><?= $Page->berbicara->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->berbicara->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->berbicara->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->berbicara->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->berbicara->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->berbicara->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
    <?php if ($Page->SortUrl($Page->penggunaan_kata) == "") { ?>
        <th class="<?= $Page->penggunaan_kata->headerCellClass() ?>"><?= $Page->penggunaan_kata->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->penggunaan_kata->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->penggunaan_kata->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->penggunaan_kata->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->penggunaan_kata->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->penggunaan_kata->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->nip->Visible) { // nip ?>
        <!-- nip -->
        <td<?= $Page->nip->cellAttributes() ?>>
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->anamnesis->Visible) { // anamnesis ?>
        <!-- anamnesis -->
        <td<?= $Page->anamnesis->cellAttributes() ?>>
<span<?= $Page->anamnesis->viewAttributes() ?>>
<?= $Page->anamnesis->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->dikirim_dari->Visible) { // dikirim_dari ?>
        <!-- dikirim_dari -->
        <td<?= $Page->dikirim_dari->cellAttributes() ?>>
<span<?= $Page->dikirim_dari->viewAttributes() ?>>
<?= $Page->dikirim_dari->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tujuan_pemeriksaan->Visible) { // tujuan_pemeriksaan ?>
        <!-- tujuan_pemeriksaan -->
        <td<?= $Page->tujuan_pemeriksaan->cellAttributes() ?>>
<span<?= $Page->tujuan_pemeriksaan->viewAttributes() ?>>
<?= $Page->tujuan_pemeriksaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rupa->Visible) { // rupa ?>
        <!-- rupa -->
        <td<?= $Page->rupa->cellAttributes() ?>>
<span<?= $Page->rupa->viewAttributes() ?>>
<?= $Page->rupa->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->bentuk_tubuh->Visible) { // bentuk_tubuh ?>
        <!-- bentuk_tubuh -->
        <td<?= $Page->bentuk_tubuh->cellAttributes() ?>>
<span<?= $Page->bentuk_tubuh->viewAttributes() ?>>
<?= $Page->bentuk_tubuh->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tindakan->Visible) { // tindakan ?>
        <!-- tindakan -->
        <td<?= $Page->tindakan->cellAttributes() ?>>
<span<?= $Page->tindakan->viewAttributes() ?>>
<?= $Page->tindakan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->pakaian->Visible) { // pakaian ?>
        <!-- pakaian -->
        <td<?= $Page->pakaian->cellAttributes() ?>>
<span<?= $Page->pakaian->viewAttributes() ?>>
<?= $Page->pakaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ekspresi->Visible) { // ekspresi ?>
        <!-- ekspresi -->
        <td<?= $Page->ekspresi->cellAttributes() ?>>
<span<?= $Page->ekspresi->viewAttributes() ?>>
<?= $Page->ekspresi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->berbicara->Visible) { // berbicara ?>
        <!-- berbicara -->
        <td<?= $Page->berbicara->cellAttributes() ?>>
<span<?= $Page->berbicara->viewAttributes() ?>>
<?= $Page->berbicara->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->penggunaan_kata->Visible) { // penggunaan_kata ?>
        <!-- penggunaan_kata -->
        <td<?= $Page->penggunaan_kata->cellAttributes() ?>>
<span<?= $Page->penggunaan_kata->viewAttributes() ?>>
<?= $Page->penggunaan_kata->getViewValue() ?></span>
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
