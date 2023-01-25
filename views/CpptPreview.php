<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$CpptPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid cppt"><!-- .card -->
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
<?php if ($Page->profesi->Visible) { // profesi ?>
    <?php if ($Page->SortUrl($Page->profesi) == "") { ?>
        <th class="<?= $Page->profesi->headerCellClass() ?>"><?= $Page->profesi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->profesi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->profesi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->profesi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->profesi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->profesi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->hasil_soap->Visible) { // hasil_soap ?>
    <?php if ($Page->SortUrl($Page->hasil_soap) == "") { ?>
        <th class="<?= $Page->hasil_soap->headerCellClass() ?>"><?= $Page->hasil_soap->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->hasil_soap->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->hasil_soap->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->hasil_soap->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->hasil_soap->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->hasil_soap->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->instruksi->Visible) { // instruksi ?>
    <?php if ($Page->SortUrl($Page->instruksi) == "") { ?>
        <th class="<?= $Page->instruksi->headerCellClass() ?>"><?= $Page->instruksi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->instruksi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->instruksi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->instruksi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->instruksi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->instruksi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->verifikasi->Visible) { // verifikasi ?>
    <?php if ($Page->SortUrl($Page->verifikasi) == "") { ?>
        <th class="<?= $Page->verifikasi->headerCellClass() ?>"><?= $Page->verifikasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->verifikasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->verifikasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->verifikasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->verifikasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->verifikasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->profesi->Visible) { // profesi ?>
        <!-- profesi -->
        <td<?= $Page->profesi->cellAttributes() ?>>
<span<?= $Page->profesi->viewAttributes() ?>>
<?= $Page->profesi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->hasil_soap->Visible) { // hasil_soap ?>
        <!-- hasil_soap -->
        <td<?= $Page->hasil_soap->cellAttributes() ?>>
<span<?= $Page->hasil_soap->viewAttributes() ?>>
<?= $Page->hasil_soap->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->instruksi->Visible) { // instruksi ?>
        <!-- instruksi -->
        <td<?= $Page->instruksi->cellAttributes() ?>>
<span<?= $Page->instruksi->viewAttributes() ?>>
<?= $Page->instruksi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->verifikasi->Visible) { // verifikasi ?>
        <!-- verifikasi -->
        <td<?= $Page->verifikasi->cellAttributes() ?>>
<span<?= $Page->verifikasi->viewAttributes() ?>>
<?= $Page->verifikasi->getViewValue() ?></span>
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
