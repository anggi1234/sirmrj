<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$KonsulPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid konsul"><!-- .card -->
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
<?php if ($Page->jenis_konsul->Visible) { // jenis_konsul ?>
    <?php if ($Page->SortUrl($Page->jenis_konsul) == "") { ?>
        <th class="<?= $Page->jenis_konsul->headerCellClass() ?>"><?= $Page->jenis_konsul->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jenis_konsul->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->jenis_konsul->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->jenis_konsul->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->jenis_konsul->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->jenis_konsul->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->konsultasi->Visible) { // konsultasi ?>
    <?php if ($Page->SortUrl($Page->konsultasi) == "") { ?>
        <th class="<?= $Page->konsultasi->headerCellClass() ?>"><?= $Page->konsultasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->konsultasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->konsultasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->konsultasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->konsultasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->konsultasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->hasil_konsul->Visible) { // hasil_konsul ?>
    <?php if ($Page->SortUrl($Page->hasil_konsul) == "") { ?>
        <th class="<?= $Page->hasil_konsul->headerCellClass() ?>"><?= $Page->hasil_konsul->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->hasil_konsul->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->hasil_konsul->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->hasil_konsul->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->hasil_konsul->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->hasil_konsul->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->status_konsul->Visible) { // status_konsul ?>
    <?php if ($Page->SortUrl($Page->status_konsul) == "") { ?>
        <th class="<?= $Page->status_konsul->headerCellClass() ?>"><?= $Page->status_konsul->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->status_konsul->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->status_konsul->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->status_konsul->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->status_konsul->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->status_konsul->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tanggal_input->Visible) { // tanggal_input ?>
    <?php if ($Page->SortUrl($Page->tanggal_input) == "") { ?>
        <th class="<?= $Page->tanggal_input->headerCellClass() ?>"><?= $Page->tanggal_input->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tanggal_input->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tanggal_input->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tanggal_input->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tanggal_input->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tanggal_input->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->jenis_konsul->Visible) { // jenis_konsul ?>
        <!-- jenis_konsul -->
        <td<?= $Page->jenis_konsul->cellAttributes() ?>>
<span<?= $Page->jenis_konsul->viewAttributes() ?>>
<?= $Page->jenis_konsul->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->konsultasi->Visible) { // konsultasi ?>
        <!-- konsultasi -->
        <td<?= $Page->konsultasi->cellAttributes() ?>>
<span<?= $Page->konsultasi->viewAttributes() ?>>
<?= $Page->konsultasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->hasil_konsul->Visible) { // hasil_konsul ?>
        <!-- hasil_konsul -->
        <td<?= $Page->hasil_konsul->cellAttributes() ?>>
<span<?= $Page->hasil_konsul->viewAttributes() ?>>
<?= $Page->hasil_konsul->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->status_konsul->Visible) { // status_konsul ?>
        <!-- status_konsul -->
        <td<?= $Page->status_konsul->cellAttributes() ?>>
<span<?= $Page->status_konsul->viewAttributes() ?>>
<?= $Page->status_konsul->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tanggal_input->Visible) { // tanggal_input ?>
        <!-- tanggal_input -->
        <td<?= $Page->tanggal_input->cellAttributes() ?>>
<span<?= $Page->tanggal_input->viewAttributes() ?>>
<?= $Page->tanggal_input->getViewValue() ?></span>
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
