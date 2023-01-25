<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CatatanMedisPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid catatan_medis"><!-- .card -->
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
<?php if ($Page->catatan_medis->Visible) { // catatan_medis ?>
    <?php if ($Page->SortUrl($Page->catatan_medis) == "") { ?>
        <th class="<?= $Page->catatan_medis->headerCellClass() ?>"><?= $Page->catatan_medis->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->catatan_medis->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->catatan_medis->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->catatan_medis->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->catatan_medis->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->catatan_medis->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
    <?php if ($Page->SortUrl($Page->tgl_input) == "") { ?>
        <th class="<?= $Page->tgl_input->headerCellClass() ?>"><?= $Page->tgl_input->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tgl_input->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->tgl_input->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->tgl_input->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->tgl_input->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->tgl_input->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->catatan_medis->Visible) { // catatan_medis ?>
        <!-- catatan_medis -->
        <td<?= $Page->catatan_medis->cellAttributes() ?>>
<span<?= $Page->catatan_medis->viewAttributes() ?>>
<?= $Page->catatan_medis->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tgl_input->Visible) { // tgl_input ?>
        <!-- tgl_input -->
        <td<?= $Page->tgl_input->cellAttributes() ?>>
<span<?= $Page->tgl_input->viewAttributes() ?>>
<?= $Page->tgl_input->getViewValue() ?></span>
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
