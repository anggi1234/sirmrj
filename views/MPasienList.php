<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$MPasienList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_pasienlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fm_pasienlist = currentForm = new ew.Form("fm_pasienlist", "list");
    fm_pasienlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fm_pasienlist");
});
var fm_pasienlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fm_pasienlistsrch = currentSearchForm = new ew.Form("fm_pasienlistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "m_pasien")) ?>,
        fields = currentTable.fields;
    fm_pasienlistsrch.addFields([
        ["no_rkm_medis", [], fields.no_rkm_medis.isInvalid],
        ["nm_pasien", [], fields.nm_pasien.isInvalid],
        ["jk", [], fields.jk.isInvalid],
        ["nm_ibu", [], fields.nm_ibu.isInvalid],
        ["alamat", [], fields.alamat.isInvalid],
        ["tgl_daftar", [], fields.tgl_daftar.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fm_pasienlistsrch.setInvalid();
    });

    // Validate form
    fm_pasienlistsrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fm_pasienlistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_pasienlistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists

    // Filters
    fm_pasienlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fm_pasienlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
    background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
    display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
    <div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
        <ul class="nav nav-tabs"></ul>
        <div class="tab-content"><!-- .tab-content -->
            <div class="tab-pane fade active show"></div>
        </div><!-- /.tab-content -->
    </div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
    ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
    ew.PREVIEW_SINGLE_ROW = false;
    ew.PREVIEW_OVERLAY = false;
    loadjs(ew.PATH_BASE + "js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fm_pasienlistsrch" id="fm_pasienlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fm_pasienlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_pasien">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_no_rkm_medis" class="ew-cell form-group">
        <label for="x_no_rkm_medis" class="ew-search-caption ew-label"><?= $Page->no_rkm_medis->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_no_rkm_medis" id="z_no_rkm_medis" value="LIKE">
</span>
        <span id="el_m_pasien_no_rkm_medis" class="ew-search-field">
<input type="<?= $Page->no_rkm_medis->getInputTextType() ?>" data-table="m_pasien" data-field="x_no_rkm_medis" name="x_no_rkm_medis" id="x_no_rkm_medis" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->no_rkm_medis->getPlaceHolder()) ?>" value="<?= $Page->no_rkm_medis->EditValue ?>"<?= $Page->no_rkm_medis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->no_rkm_medis->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_nm_pasien" class="ew-cell form-group">
        <label for="x_nm_pasien" class="ew-search-caption ew-label"><?= $Page->nm_pasien->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nm_pasien" id="z_nm_pasien" value="LIKE">
</span>
        <span id="el_m_pasien_nm_pasien" class="ew-search-field">
<input type="<?= $Page->nm_pasien->getInputTextType() ?>" data-table="m_pasien" data-field="x_nm_pasien" name="x_nm_pasien" id="x_nm_pasien" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nm_pasien->getPlaceHolder()) ?>" value="<?= $Page->nm_pasien->EditValue ?>"<?= $Page->nm_pasien->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nm_pasien->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_nm_ibu" class="ew-cell form-group">
        <label for="x_nm_ibu" class="ew-search-caption ew-label"><?= $Page->nm_ibu->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nm_ibu" id="z_nm_ibu" value="LIKE">
</span>
        <span id="el_m_pasien_nm_ibu" class="ew-search-field">
<input type="<?= $Page->nm_ibu->getInputTextType() ?>" data-table="m_pasien" data-field="x_nm_ibu" name="x_nm_ibu" id="x_nm_ibu" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nm_ibu->getPlaceHolder()) ?>" value="<?= $Page->nm_ibu->EditValue ?>"<?= $Page->nm_ibu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nm_ibu->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_alamat" class="ew-cell form-group">
        <label for="x_alamat" class="ew-search-caption ew-label"><?= $Page->alamat->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_alamat" id="z_alamat" value="LIKE">
</span>
        <span id="el_m_pasien_alamat" class="ew-search-field">
<input type="<?= $Page->alamat->getInputTextType() ?>" data-table="m_pasien" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>" value="<?= $Page->alamat->EditValue ?>"<?= $Page->alamat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow > 0) { ?>
</div>
    <?php } ?>
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_pasien">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_pasienlist" id="fm_pasienlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_pasien">
<div id="gmp_m_pasien" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_m_pasienlist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th data-name="no_rkm_medis" class="<?= $Page->no_rkm_medis->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_pasien_no_rkm_medis" class="m_pasien_no_rkm_medis"><?= $Page->renderSort($Page->no_rkm_medis) ?></div></th>
<?php } ?>
<?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
        <th data-name="nm_pasien" class="<?= $Page->nm_pasien->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_pasien_nm_pasien" class="m_pasien_nm_pasien"><?= $Page->renderSort($Page->nm_pasien) ?></div></th>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
        <th data-name="jk" class="<?= $Page->jk->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_pasien_jk" class="m_pasien_jk"><?= $Page->renderSort($Page->jk) ?></div></th>
<?php } ?>
<?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
        <th data-name="nm_ibu" class="<?= $Page->nm_ibu->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_pasien_nm_ibu" class="m_pasien_nm_ibu"><?= $Page->renderSort($Page->nm_ibu) ?></div></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th data-name="alamat" class="<?= $Page->alamat->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_pasien_alamat" class="m_pasien_alamat"><?= $Page->renderSort($Page->alamat) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <th data-name="tgl_daftar" class="<?= $Page->tgl_daftar->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_pasien_tgl_daftar" class="m_pasien_tgl_daftar"><?= $Page->renderSort($Page->tgl_daftar) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_m_pasien", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_pasien_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nm_pasien->Visible) { // nm_pasien ?>
        <td data-name="nm_pasien" <?= $Page->nm_pasien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_pasien_nm_pasien">
<span<?= $Page->nm_pasien->viewAttributes() ?>>
<?= $Page->nm_pasien->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jk->Visible) { // jk ?>
        <td data-name="jk" <?= $Page->jk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_pasien_jk">
<span<?= $Page->jk->viewAttributes() ?>>
<?= $Page->jk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nm_ibu->Visible) { // nm_ibu ?>
        <td data-name="nm_ibu" <?= $Page->nm_ibu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_pasien_nm_ibu">
<span<?= $Page->nm_ibu->viewAttributes() ?>>
<?= $Page->nm_ibu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alamat->Visible) { // alamat ?>
        <td data-name="alamat" <?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_pasien_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_daftar->Visible) { // tgl_daftar ?>
        <td data-name="tgl_daftar" <?= $Page->tgl_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_pasien_tgl_daftar">
<span<?= $Page->tgl_daftar->viewAttributes() ?>>
<?= $Page->tgl_daftar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("m_pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
