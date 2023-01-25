<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$DiagnosaPasienPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid diagnosa_pasien"><!-- .card -->
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
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
    <?php if ($Page->SortUrl($Page->kd_penyakit) == "") { ?>
        <th class="<?= $Page->kd_penyakit->headerCellClass() ?>"><?= $Page->kd_penyakit->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kd_penyakit->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kd_penyakit->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kd_penyakit->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kd_penyakit->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kd_penyakit->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->prioritas->Visible) { // prioritas ?>
    <?php if ($Page->SortUrl($Page->prioritas) == "") { ?>
        <th class="<?= $Page->prioritas->headerCellClass() ?>"><?= $Page->prioritas->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->prioritas->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->prioritas->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->prioritas->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->prioritas->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->prioritas->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->status_penyakit->Visible) { // status_penyakit ?>
    <?php if ($Page->SortUrl($Page->status_penyakit) == "") { ?>
        <th class="<?= $Page->status_penyakit->headerCellClass() ?>"><?= $Page->status_penyakit->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->status_penyakit->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->status_penyakit->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->status_penyakit->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->status_penyakit->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->status_penyakit->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->kd_penyakit->Visible) { // kd_penyakit ?>
        <!-- kd_penyakit -->
        <td<?= $Page->kd_penyakit->cellAttributes() ?>>
<span<?= $Page->kd_penyakit->viewAttributes() ?>>
<?= $Page->kd_penyakit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <!-- status -->
        <td<?= $Page->status->cellAttributes() ?>>
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->prioritas->Visible) { // prioritas ?>
        <!-- prioritas -->
        <td<?= $Page->prioritas->cellAttributes() ?>>
<span<?= $Page->prioritas->viewAttributes() ?>>
<?= $Page->prioritas->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->status_penyakit->Visible) { // status_penyakit ?>
        <!-- status_penyakit -->
        <td<?= $Page->status_penyakit->cellAttributes() ?>>
<span<?= $Page->status_penyakit->viewAttributes() ?>>
<?= $Page->status_penyakit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kd_icd9->Visible) { // kd_icd9 ?>
        <!-- kd_icd9 -->
        <td<?= $Page->kd_icd9->cellAttributes() ?>>
<span<?= $Page->kd_icd9->viewAttributes() ?>>
<?= $Page->kd_icd9->getViewValue() ?></span>
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
