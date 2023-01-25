<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$BillingPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid billing"><!-- .card -->
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
<?php if ($Page->no_reg->Visible) { // no_reg ?>
    <?php if ($Page->SortUrl($Page->no_reg) == "") { ?>
        <th class="<?= $Page->no_reg->headerCellClass() ?>"><?= $Page->no_reg->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->no_reg->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->no_reg->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->no_reg->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->no_reg->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->no_reg->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tgl_byr->Visible) { // tgl_byr ?>
    <?php if ($Page->SortUrl($Page->tgl_byr) == "") { ?>
        <th class="<?= $Page->tgl_byr->headerCellClass() ?>"><?= $Page->tgl_byr->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tgl_byr->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tgl_byr->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tgl_byr->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tgl_byr->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tgl_byr->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->no->Visible) { // no ?>
    <?php if ($Page->SortUrl($Page->no) == "") { ?>
        <th class="<?= $Page->no->headerCellClass() ?>"><?= $Page->no->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->no->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->no->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->no->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->no->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->no->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nm_perawatan->Visible) { // nm_perawatan ?>
    <?php if ($Page->SortUrl($Page->nm_perawatan) == "") { ?>
        <th class="<?= $Page->nm_perawatan->headerCellClass() ?>"><?= $Page->nm_perawatan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nm_perawatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nm_perawatan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nm_perawatan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nm_perawatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nm_perawatan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->pemisah->Visible) { // pemisah ?>
    <?php if ($Page->SortUrl($Page->pemisah) == "") { ?>
        <th class="<?= $Page->pemisah->headerCellClass() ?>"><?= $Page->pemisah->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->pemisah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->pemisah->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->pemisah->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->pemisah->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->pemisah->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
    <?php if ($Page->SortUrl($Page->biaya) == "") { ?>
        <th class="<?= $Page->biaya->headerCellClass() ?>"><?= $Page->biaya->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->biaya->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->biaya->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->biaya->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->biaya->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
    <?php if ($Page->SortUrl($Page->jumlah) == "") { ?>
        <th class="<?= $Page->jumlah->headerCellClass() ?>"><?= $Page->jumlah->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->jumlah->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->jumlah->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->jumlah->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tambahan->Visible) { // tambahan ?>
    <?php if ($Page->SortUrl($Page->tambahan) == "") { ?>
        <th class="<?= $Page->tambahan->headerCellClass() ?>"><?= $Page->tambahan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tambahan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tambahan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tambahan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tambahan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->totalbiaya->Visible) { // totalbiaya ?>
    <?php if ($Page->SortUrl($Page->totalbiaya) == "") { ?>
        <th class="<?= $Page->totalbiaya->headerCellClass() ?>"><?= $Page->totalbiaya->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->totalbiaya->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->totalbiaya->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->totalbiaya->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->totalbiaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->totalbiaya->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <?php if ($Page->SortUrl($Page->status) == "") { ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><?= $Page->status->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->status->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->status->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->status->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->no_reg->Visible) { // no_reg ?>
        <!-- no_reg -->
        <td<?= $Page->no_reg->cellAttributes() ?>>
<span<?= $Page->no_reg->viewAttributes() ?>>
<?= $Page->no_reg->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tgl_byr->Visible) { // tgl_byr ?>
        <!-- tgl_byr -->
        <td<?= $Page->tgl_byr->cellAttributes() ?>>
<span<?= $Page->tgl_byr->viewAttributes() ?>>
<?= $Page->tgl_byr->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->no->Visible) { // no ?>
        <!-- no -->
        <td<?= $Page->no->cellAttributes() ?>>
<span<?= $Page->no->viewAttributes() ?>>
<?= $Page->no->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nm_perawatan->Visible) { // nm_perawatan ?>
        <!-- nm_perawatan -->
        <td<?= $Page->nm_perawatan->cellAttributes() ?>>
<span<?= $Page->nm_perawatan->viewAttributes() ?>>
<?= $Page->nm_perawatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->pemisah->Visible) { // pemisah ?>
        <!-- pemisah -->
        <td<?= $Page->pemisah->cellAttributes() ?>>
<span<?= $Page->pemisah->viewAttributes() ?>>
<?= $Page->pemisah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
        <!-- biaya -->
        <td<?= $Page->biaya->cellAttributes() ?>>
<span<?= $Page->biaya->viewAttributes() ?>>
<?= $Page->biaya->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
        <!-- jumlah -->
        <td<?= $Page->jumlah->cellAttributes() ?>>
<span<?= $Page->jumlah->viewAttributes() ?>>
<?= $Page->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tambahan->Visible) { // tambahan ?>
        <!-- tambahan -->
        <td<?= $Page->tambahan->cellAttributes() ?>>
<span<?= $Page->tambahan->viewAttributes() ?>>
<?= $Page->tambahan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->totalbiaya->Visible) { // totalbiaya ?>
        <!-- totalbiaya -->
        <td<?= $Page->totalbiaya->cellAttributes() ?>>
<span<?= $Page->totalbiaya->viewAttributes() ?>>
<?= $Page->totalbiaya->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <!-- status -->
        <td<?= $Page->status->cellAttributes() ?>>
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
