<?php

namespace PHPMaker2021\project4sikdec;

// Page object
$PenilaianAwalKeperawatanRalanPsikiatriPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid penilaian_awal_keperawatan_ralan_psikiatri"><!-- .card -->
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
<?php if ($Page->informasi->Visible) { // informasi ?>
    <?php if ($Page->SortUrl($Page->informasi) == "") { ?>
        <th class="<?= $Page->informasi->headerCellClass() ?>"><?= $Page->informasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->informasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->informasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->informasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->informasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->informasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
    <?php if ($Page->SortUrl($Page->rkd_sakit_sejak) == "") { ?>
        <th class="<?= $Page->rkd_sakit_sejak->headerCellClass() ?>"><?= $Page->rkd_sakit_sejak->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rkd_sakit_sejak->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rkd_sakit_sejak->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rkd_sakit_sejak->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rkd_sakit_sejak->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rkd_sakit_sejak->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
    <?php if ($Page->SortUrl($Page->rkd_berobat) == "") { ?>
        <th class="<?= $Page->rkd_berobat->headerCellClass() ?>"><?= $Page->rkd_berobat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rkd_berobat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rkd_berobat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rkd_berobat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rkd_berobat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rkd_berobat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
    <?php if ($Page->SortUrl($Page->rkd_hasil_pengobatan) == "") { ?>
        <th class="<?= $Page->rkd_hasil_pengobatan->headerCellClass() ?>"><?= $Page->rkd_hasil_pengobatan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rkd_hasil_pengobatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rkd_hasil_pengobatan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rkd_hasil_pengobatan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rkd_hasil_pengobatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rkd_hasil_pengobatan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
    <?php if ($Page->SortUrl($Page->fp_putus_obat) == "") { ?>
        <th class="<?= $Page->fp_putus_obat->headerCellClass() ?>"><?= $Page->fp_putus_obat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->fp_putus_obat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->fp_putus_obat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->fp_putus_obat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->fp_putus_obat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->fp_putus_obat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
    <?php if ($Page->SortUrl($Page->ket_putus_obat) == "") { ?>
        <th class="<?= $Page->ket_putus_obat->headerCellClass() ?>"><?= $Page->ket_putus_obat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_putus_obat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_putus_obat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_putus_obat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_putus_obat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_putus_obat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
    <?php if ($Page->SortUrl($Page->fp_ekonomi) == "") { ?>
        <th class="<?= $Page->fp_ekonomi->headerCellClass() ?>"><?= $Page->fp_ekonomi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->fp_ekonomi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->fp_ekonomi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->fp_ekonomi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->fp_ekonomi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->fp_ekonomi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
    <?php if ($Page->SortUrl($Page->ket_masalah_ekonomi) == "") { ?>
        <th class="<?= $Page->ket_masalah_ekonomi->headerCellClass() ?>"><?= $Page->ket_masalah_ekonomi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_masalah_ekonomi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_masalah_ekonomi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_masalah_ekonomi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_masalah_ekonomi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_masalah_ekonomi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
    <?php if ($Page->SortUrl($Page->fp_masalah_fisik) == "") { ?>
        <th class="<?= $Page->fp_masalah_fisik->headerCellClass() ?>"><?= $Page->fp_masalah_fisik->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->fp_masalah_fisik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->fp_masalah_fisik->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->fp_masalah_fisik->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->fp_masalah_fisik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->fp_masalah_fisik->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
    <?php if ($Page->SortUrl($Page->ket_masalah_fisik) == "") { ?>
        <th class="<?= $Page->ket_masalah_fisik->headerCellClass() ?>"><?= $Page->ket_masalah_fisik->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_masalah_fisik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_masalah_fisik->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_masalah_fisik->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_masalah_fisik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_masalah_fisik->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
    <?php if ($Page->SortUrl($Page->fp_masalah_psikososial) == "") { ?>
        <th class="<?= $Page->fp_masalah_psikososial->headerCellClass() ?>"><?= $Page->fp_masalah_psikososial->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->fp_masalah_psikososial->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->fp_masalah_psikososial->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->fp_masalah_psikososial->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->fp_masalah_psikososial->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->fp_masalah_psikososial->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
    <?php if ($Page->SortUrl($Page->ket_masalah_psikososial) == "") { ?>
        <th class="<?= $Page->ket_masalah_psikososial->headerCellClass() ?>"><?= $Page->ket_masalah_psikososial->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_masalah_psikososial->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_masalah_psikososial->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_masalah_psikososial->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_masalah_psikososial->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_masalah_psikososial->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
    <?php if ($Page->SortUrl($Page->rh_keluarga) == "") { ?>
        <th class="<?= $Page->rh_keluarga->headerCellClass() ?>"><?= $Page->rh_keluarga->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rh_keluarga->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rh_keluarga->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rh_keluarga->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rh_keluarga->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rh_keluarga->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
    <?php if ($Page->SortUrl($Page->ket_rh_keluarga) == "") { ?>
        <th class="<?= $Page->ket_rh_keluarga->headerCellClass() ?>"><?= $Page->ket_rh_keluarga->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rh_keluarga->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rh_keluarga->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rh_keluarga->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rh_keluarga->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rh_keluarga->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
    <?php if ($Page->SortUrl($Page->resiko_bunuh_diri) == "") { ?>
        <th class="<?= $Page->resiko_bunuh_diri->headerCellClass() ?>"><?= $Page->resiko_bunuh_diri->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->resiko_bunuh_diri->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->resiko_bunuh_diri->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->resiko_bunuh_diri->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->resiko_bunuh_diri->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->resiko_bunuh_diri->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
    <?php if ($Page->SortUrl($Page->rbd_ide) == "") { ?>
        <th class="<?= $Page->rbd_ide->headerCellClass() ?>"><?= $Page->rbd_ide->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rbd_ide->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rbd_ide->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rbd_ide->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rbd_ide->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rbd_ide->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
    <?php if ($Page->SortUrl($Page->ket_rbd_ide) == "") { ?>
        <th class="<?= $Page->ket_rbd_ide->headerCellClass() ?>"><?= $Page->ket_rbd_ide->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rbd_ide->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rbd_ide->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rbd_ide->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rbd_ide->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rbd_ide->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
    <?php if ($Page->SortUrl($Page->rbd_rencana) == "") { ?>
        <th class="<?= $Page->rbd_rencana->headerCellClass() ?>"><?= $Page->rbd_rencana->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rbd_rencana->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rbd_rencana->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rbd_rencana->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rbd_rencana->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rbd_rencana->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
    <?php if ($Page->SortUrl($Page->ket_rbd_rencana) == "") { ?>
        <th class="<?= $Page->ket_rbd_rencana->headerCellClass() ?>"><?= $Page->ket_rbd_rencana->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rbd_rencana->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rbd_rencana->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rbd_rencana->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rbd_rencana->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rbd_rencana->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
    <?php if ($Page->SortUrl($Page->rbd_alat) == "") { ?>
        <th class="<?= $Page->rbd_alat->headerCellClass() ?>"><?= $Page->rbd_alat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rbd_alat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rbd_alat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rbd_alat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rbd_alat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rbd_alat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
    <?php if ($Page->SortUrl($Page->ket_rbd_alat) == "") { ?>
        <th class="<?= $Page->ket_rbd_alat->headerCellClass() ?>"><?= $Page->ket_rbd_alat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rbd_alat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rbd_alat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rbd_alat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rbd_alat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rbd_alat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
    <?php if ($Page->SortUrl($Page->rbd_percobaan) == "") { ?>
        <th class="<?= $Page->rbd_percobaan->headerCellClass() ?>"><?= $Page->rbd_percobaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rbd_percobaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rbd_percobaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rbd_percobaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rbd_percobaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rbd_percobaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
    <?php if ($Page->SortUrl($Page->ket_rbd_percobaan) == "") { ?>
        <th class="<?= $Page->ket_rbd_percobaan->headerCellClass() ?>"><?= $Page->ket_rbd_percobaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rbd_percobaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rbd_percobaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rbd_percobaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rbd_percobaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rbd_percobaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
    <?php if ($Page->SortUrl($Page->rbd_keinginan) == "") { ?>
        <th class="<?= $Page->rbd_keinginan->headerCellClass() ?>"><?= $Page->rbd_keinginan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rbd_keinginan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rbd_keinginan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rbd_keinginan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rbd_keinginan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rbd_keinginan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
    <?php if ($Page->SortUrl($Page->ket_rbd_keinginan) == "") { ?>
        <th class="<?= $Page->ket_rbd_keinginan->headerCellClass() ?>"><?= $Page->ket_rbd_keinginan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rbd_keinginan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rbd_keinginan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rbd_keinginan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rbd_keinginan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rbd_keinginan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
    <?php if ($Page->SortUrl($Page->rpo_penggunaan) == "") { ?>
        <th class="<?= $Page->rpo_penggunaan->headerCellClass() ?>"><?= $Page->rpo_penggunaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rpo_penggunaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rpo_penggunaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rpo_penggunaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rpo_penggunaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rpo_penggunaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
    <?php if ($Page->SortUrl($Page->ket_rpo_penggunaan) == "") { ?>
        <th class="<?= $Page->ket_rpo_penggunaan->headerCellClass() ?>"><?= $Page->ket_rpo_penggunaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rpo_penggunaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rpo_penggunaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rpo_penggunaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rpo_penggunaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rpo_penggunaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
    <?php if ($Page->SortUrl($Page->rpo_efek_samping) == "") { ?>
        <th class="<?= $Page->rpo_efek_samping->headerCellClass() ?>"><?= $Page->rpo_efek_samping->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rpo_efek_samping->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rpo_efek_samping->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rpo_efek_samping->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rpo_efek_samping->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rpo_efek_samping->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
    <?php if ($Page->SortUrl($Page->ket_rpo_efek_samping) == "") { ?>
        <th class="<?= $Page->ket_rpo_efek_samping->headerCellClass() ?>"><?= $Page->ket_rpo_efek_samping->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rpo_efek_samping->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rpo_efek_samping->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rpo_efek_samping->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rpo_efek_samping->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rpo_efek_samping->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
    <?php if ($Page->SortUrl($Page->rpo_napza) == "") { ?>
        <th class="<?= $Page->rpo_napza->headerCellClass() ?>"><?= $Page->rpo_napza->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rpo_napza->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rpo_napza->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rpo_napza->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rpo_napza->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rpo_napza->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
    <?php if ($Page->SortUrl($Page->ket_rpo_napza) == "") { ?>
        <th class="<?= $Page->ket_rpo_napza->headerCellClass() ?>"><?= $Page->ket_rpo_napza->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_rpo_napza->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_rpo_napza->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_rpo_napza->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_rpo_napza->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_rpo_napza->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
    <?php if ($Page->SortUrl($Page->ket_lama_pemakaian) == "") { ?>
        <th class="<?= $Page->ket_lama_pemakaian->headerCellClass() ?>"><?= $Page->ket_lama_pemakaian->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_lama_pemakaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_lama_pemakaian->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_lama_pemakaian->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_lama_pemakaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_lama_pemakaian->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
    <?php if ($Page->SortUrl($Page->ket_cara_pemakaian) == "") { ?>
        <th class="<?= $Page->ket_cara_pemakaian->headerCellClass() ?>"><?= $Page->ket_cara_pemakaian->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_cara_pemakaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_cara_pemakaian->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_cara_pemakaian->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_cara_pemakaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_cara_pemakaian->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
    <?php if ($Page->SortUrl($Page->ket_latar_belakang_pemakaian) == "") { ?>
        <th class="<?= $Page->ket_latar_belakang_pemakaian->headerCellClass() ?>"><?= $Page->ket_latar_belakang_pemakaian->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_latar_belakang_pemakaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_latar_belakang_pemakaian->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_latar_belakang_pemakaian->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_latar_belakang_pemakaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_latar_belakang_pemakaian->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
    <?php if ($Page->SortUrl($Page->rpo_penggunaan_obat_lainnya) == "") { ?>
        <th class="<?= $Page->rpo_penggunaan_obat_lainnya->headerCellClass() ?>"><?= $Page->rpo_penggunaan_obat_lainnya->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rpo_penggunaan_obat_lainnya->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rpo_penggunaan_obat_lainnya->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rpo_penggunaan_obat_lainnya->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rpo_penggunaan_obat_lainnya->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rpo_penggunaan_obat_lainnya->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
    <?php if ($Page->SortUrl($Page->ket_penggunaan_obat_lainnya) == "") { ?>
        <th class="<?= $Page->ket_penggunaan_obat_lainnya->headerCellClass() ?>"><?= $Page->ket_penggunaan_obat_lainnya->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_penggunaan_obat_lainnya->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_penggunaan_obat_lainnya->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_penggunaan_obat_lainnya->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_penggunaan_obat_lainnya->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_penggunaan_obat_lainnya->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
    <?php if ($Page->SortUrl($Page->ket_alasan_penggunaan) == "") { ?>
        <th class="<?= $Page->ket_alasan_penggunaan->headerCellClass() ?>"><?= $Page->ket_alasan_penggunaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_alasan_penggunaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_alasan_penggunaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_alasan_penggunaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_alasan_penggunaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_alasan_penggunaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
    <?php if ($Page->SortUrl($Page->rpo_alergi_obat) == "") { ?>
        <th class="<?= $Page->rpo_alergi_obat->headerCellClass() ?>"><?= $Page->rpo_alergi_obat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rpo_alergi_obat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rpo_alergi_obat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rpo_alergi_obat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rpo_alergi_obat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rpo_alergi_obat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
    <?php if ($Page->SortUrl($Page->ket_alergi_obat) == "") { ?>
        <th class="<?= $Page->ket_alergi_obat->headerCellClass() ?>"><?= $Page->ket_alergi_obat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_alergi_obat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_alergi_obat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_alergi_obat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_alergi_obat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_alergi_obat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
    <?php if ($Page->SortUrl($Page->rpo_merokok) == "") { ?>
        <th class="<?= $Page->rpo_merokok->headerCellClass() ?>"><?= $Page->rpo_merokok->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rpo_merokok->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rpo_merokok->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rpo_merokok->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rpo_merokok->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rpo_merokok->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
    <?php if ($Page->SortUrl($Page->ket_merokok) == "") { ?>
        <th class="<?= $Page->ket_merokok->headerCellClass() ?>"><?= $Page->ket_merokok->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_merokok->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_merokok->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_merokok->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_merokok->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_merokok->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
    <?php if ($Page->SortUrl($Page->rpo_minum_kopi) == "") { ?>
        <th class="<?= $Page->rpo_minum_kopi->headerCellClass() ?>"><?= $Page->rpo_minum_kopi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rpo_minum_kopi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rpo_minum_kopi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rpo_minum_kopi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rpo_minum_kopi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rpo_minum_kopi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
    <?php if ($Page->SortUrl($Page->ket_minum_kopi) == "") { ?>
        <th class="<?= $Page->ket_minum_kopi->headerCellClass() ?>"><?= $Page->ket_minum_kopi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_minum_kopi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_minum_kopi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_minum_kopi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_minum_kopi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_minum_kopi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->gcs->Visible) { // gcs ?>
    <?php if ($Page->SortUrl($Page->gcs) == "") { ?>
        <th class="<?= $Page->gcs->headerCellClass() ?>"><?= $Page->gcs->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->gcs->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->gcs->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->gcs->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->gcs->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->gcs->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
    <?php if ($Page->SortUrl($Page->pf_keluhan_fisik) == "") { ?>
        <th class="<?= $Page->pf_keluhan_fisik->headerCellClass() ?>"><?= $Page->pf_keluhan_fisik->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->pf_keluhan_fisik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->pf_keluhan_fisik->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->pf_keluhan_fisik->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->pf_keluhan_fisik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->pf_keluhan_fisik->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
    <?php if ($Page->SortUrl($Page->ket_keluhan_fisik) == "") { ?>
        <th class="<?= $Page->ket_keluhan_fisik->headerCellClass() ?>"><?= $Page->ket_keluhan_fisik->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_keluhan_fisik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_keluhan_fisik->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_keluhan_fisik->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_keluhan_fisik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_keluhan_fisik->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
    <?php if ($Page->SortUrl($Page->skala_nyeri) == "") { ?>
        <th class="<?= $Page->skala_nyeri->headerCellClass() ?>"><?= $Page->skala_nyeri->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->skala_nyeri->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->skala_nyeri->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->skala_nyeri->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->skala_nyeri->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->skala_nyeri->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
    <?php if ($Page->SortUrl($Page->durasi) == "") { ?>
        <th class="<?= $Page->durasi->headerCellClass() ?>"><?= $Page->durasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->durasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->durasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->durasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->durasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->durasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
    <?php if ($Page->SortUrl($Page->nyeri) == "") { ?>
        <th class="<?= $Page->nyeri->headerCellClass() ?>"><?= $Page->nyeri->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nyeri->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nyeri->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nyeri->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nyeri->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nyeri->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
    <?php if ($Page->SortUrl($Page->provokes) == "") { ?>
        <th class="<?= $Page->provokes->headerCellClass() ?>"><?= $Page->provokes->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->provokes->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->provokes->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->provokes->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->provokes->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->provokes->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
    <?php if ($Page->SortUrl($Page->ket_provokes) == "") { ?>
        <th class="<?= $Page->ket_provokes->headerCellClass() ?>"><?= $Page->ket_provokes->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_provokes->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_provokes->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_provokes->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_provokes->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_provokes->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
    <?php if ($Page->SortUrl($Page->quality) == "") { ?>
        <th class="<?= $Page->quality->headerCellClass() ?>"><?= $Page->quality->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->quality->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->quality->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->quality->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->quality->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->quality->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
    <?php if ($Page->SortUrl($Page->ket_quality) == "") { ?>
        <th class="<?= $Page->ket_quality->headerCellClass() ?>"><?= $Page->ket_quality->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_quality->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_quality->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_quality->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_quality->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_quality->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <?php if ($Page->SortUrl($Page->lokasi) == "") { ?>
        <th class="<?= $Page->lokasi->headerCellClass() ?>"><?= $Page->lokasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->lokasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->lokasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->lokasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->lokasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->lokasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
    <?php if ($Page->SortUrl($Page->menyebar) == "") { ?>
        <th class="<?= $Page->menyebar->headerCellClass() ?>"><?= $Page->menyebar->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->menyebar->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->menyebar->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->menyebar->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->menyebar->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->menyebar->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
    <?php if ($Page->SortUrl($Page->pada_dokter) == "") { ?>
        <th class="<?= $Page->pada_dokter->headerCellClass() ?>"><?= $Page->pada_dokter->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->pada_dokter->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->pada_dokter->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->pada_dokter->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->pada_dokter->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->pada_dokter->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
    <?php if ($Page->SortUrl($Page->ket_dokter) == "") { ?>
        <th class="<?= $Page->ket_dokter->headerCellClass() ?>"><?= $Page->ket_dokter->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_dokter->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_dokter->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_dokter->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_dokter->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_dokter->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
    <?php if ($Page->SortUrl($Page->nyeri_hilang) == "") { ?>
        <th class="<?= $Page->nyeri_hilang->headerCellClass() ?>"><?= $Page->nyeri_hilang->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nyeri_hilang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nyeri_hilang->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nyeri_hilang->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nyeri_hilang->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nyeri_hilang->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
    <?php if ($Page->SortUrl($Page->ket_nyeri) == "") { ?>
        <th class="<?= $Page->ket_nyeri->headerCellClass() ?>"><?= $Page->ket_nyeri->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_nyeri->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_nyeri->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_nyeri->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_nyeri->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_nyeri->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->bmi->Visible) { // bmi ?>
    <?php if ($Page->SortUrl($Page->bmi) == "") { ?>
        <th class="<?= $Page->bmi->headerCellClass() ?>"><?= $Page->bmi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->bmi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->bmi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->bmi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->bmi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->bmi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
    <?php if ($Page->SortUrl($Page->lapor_status_nutrisi) == "") { ?>
        <th class="<?= $Page->lapor_status_nutrisi->headerCellClass() ?>"><?= $Page->lapor_status_nutrisi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->lapor_status_nutrisi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->lapor_status_nutrisi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->lapor_status_nutrisi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->lapor_status_nutrisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->lapor_status_nutrisi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
    <?php if ($Page->SortUrl($Page->ket_lapor_status_nutrisi) == "") { ?>
        <th class="<?= $Page->ket_lapor_status_nutrisi->headerCellClass() ?>"><?= $Page->ket_lapor_status_nutrisi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_lapor_status_nutrisi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_lapor_status_nutrisi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_lapor_status_nutrisi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_lapor_status_nutrisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_lapor_status_nutrisi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
    <?php if ($Page->SortUrl($Page->sg1) == "") { ?>
        <th class="<?= $Page->sg1->headerCellClass() ?>"><?= $Page->sg1->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sg1->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sg1->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sg1->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sg1->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sg1->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
    <?php if ($Page->SortUrl($Page->nilai1) == "") { ?>
        <th class="<?= $Page->nilai1->headerCellClass() ?>"><?= $Page->nilai1->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nilai1->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nilai1->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nilai1->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nilai1->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nilai1->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
    <?php if ($Page->SortUrl($Page->sg2) == "") { ?>
        <th class="<?= $Page->sg2->headerCellClass() ?>"><?= $Page->sg2->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sg2->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sg2->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sg2->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sg2->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sg2->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
    <?php if ($Page->SortUrl($Page->nilai2) == "") { ?>
        <th class="<?= $Page->nilai2->headerCellClass() ?>"><?= $Page->nilai2->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nilai2->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->nilai2->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->nilai2->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->nilai2->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->nilai2->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
    <?php if ($Page->SortUrl($Page->total_hasil) == "") { ?>
        <th class="<?= $Page->total_hasil->headerCellClass() ?>"><?= $Page->total_hasil->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->total_hasil->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->total_hasil->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->total_hasil->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->total_hasil->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->total_hasil->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
    <?php if ($Page->SortUrl($Page->resikojatuh) == "") { ?>
        <th class="<?= $Page->resikojatuh->headerCellClass() ?>"><?= $Page->resikojatuh->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->resikojatuh->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->resikojatuh->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->resikojatuh->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->resikojatuh->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->resikojatuh->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->bjm->Visible) { // bjm ?>
    <?php if ($Page->SortUrl($Page->bjm) == "") { ?>
        <th class="<?= $Page->bjm->headerCellClass() ?>"><?= $Page->bjm->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->bjm->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->bjm->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->bjm->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->bjm->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->bjm->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->msa->Visible) { // msa ?>
    <?php if ($Page->SortUrl($Page->msa) == "") { ?>
        <th class="<?= $Page->msa->headerCellClass() ?>"><?= $Page->msa->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->msa->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->msa->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->msa->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->msa->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->msa->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
    <?php if ($Page->SortUrl($Page->hasil) == "") { ?>
        <th class="<?= $Page->hasil->headerCellClass() ?>"><?= $Page->hasil->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->hasil->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->hasil->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->hasil->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->hasil->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->hasil->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
    <?php if ($Page->SortUrl($Page->lapor) == "") { ?>
        <th class="<?= $Page->lapor->headerCellClass() ?>"><?= $Page->lapor->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->lapor->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->lapor->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->lapor->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->lapor->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->lapor->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
    <?php if ($Page->SortUrl($Page->ket_lapor) == "") { ?>
        <th class="<?= $Page->ket_lapor->headerCellClass() ?>"><?= $Page->ket_lapor->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_lapor->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_lapor->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_lapor->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_lapor->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_lapor->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
    <?php if ($Page->SortUrl($Page->adl_mandi) == "") { ?>
        <th class="<?= $Page->adl_mandi->headerCellClass() ?>"><?= $Page->adl_mandi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_mandi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_mandi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_mandi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_mandi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_mandi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
    <?php if ($Page->SortUrl($Page->adl_berpakaian) == "") { ?>
        <th class="<?= $Page->adl_berpakaian->headerCellClass() ?>"><?= $Page->adl_berpakaian->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_berpakaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_berpakaian->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_berpakaian->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_berpakaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_berpakaian->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_makan->Visible) { // adl_makan ?>
    <?php if ($Page->SortUrl($Page->adl_makan) == "") { ?>
        <th class="<?= $Page->adl_makan->headerCellClass() ?>"><?= $Page->adl_makan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_makan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_makan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_makan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_makan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_makan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_bak->Visible) { // adl_bak ?>
    <?php if ($Page->SortUrl($Page->adl_bak) == "") { ?>
        <th class="<?= $Page->adl_bak->headerCellClass() ?>"><?= $Page->adl_bak->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_bak->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_bak->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_bak->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_bak->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_bak->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_bab->Visible) { // adl_bab ?>
    <?php if ($Page->SortUrl($Page->adl_bab) == "") { ?>
        <th class="<?= $Page->adl_bab->headerCellClass() ?>"><?= $Page->adl_bab->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_bab->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_bab->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_bab->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_bab->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_bab->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
    <?php if ($Page->SortUrl($Page->adl_hobi) == "") { ?>
        <th class="<?= $Page->adl_hobi->headerCellClass() ?>"><?= $Page->adl_hobi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_hobi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_hobi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_hobi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_hobi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_hobi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
    <?php if ($Page->SortUrl($Page->ket_adl_hobi) == "") { ?>
        <th class="<?= $Page->ket_adl_hobi->headerCellClass() ?>"><?= $Page->ket_adl_hobi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_adl_hobi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_adl_hobi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_adl_hobi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_adl_hobi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_adl_hobi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
    <?php if ($Page->SortUrl($Page->adl_sosialisasi) == "") { ?>
        <th class="<?= $Page->adl_sosialisasi->headerCellClass() ?>"><?= $Page->adl_sosialisasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_sosialisasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_sosialisasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_sosialisasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_sosialisasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_sosialisasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
    <?php if ($Page->SortUrl($Page->ket_adl_sosialisasi) == "") { ?>
        <th class="<?= $Page->ket_adl_sosialisasi->headerCellClass() ?>"><?= $Page->ket_adl_sosialisasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_adl_sosialisasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_adl_sosialisasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_adl_sosialisasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_adl_sosialisasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_adl_sosialisasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
    <?php if ($Page->SortUrl($Page->adl_kegiatan) == "") { ?>
        <th class="<?= $Page->adl_kegiatan->headerCellClass() ?>"><?= $Page->adl_kegiatan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->adl_kegiatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->adl_kegiatan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->adl_kegiatan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->adl_kegiatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->adl_kegiatan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
    <?php if ($Page->SortUrl($Page->ket_adl_kegiatan) == "") { ?>
        <th class="<?= $Page->ket_adl_kegiatan->headerCellClass() ?>"><?= $Page->ket_adl_kegiatan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_adl_kegiatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_adl_kegiatan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_adl_kegiatan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_adl_kegiatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_adl_kegiatan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
    <?php if ($Page->SortUrl($Page->sk_penampilan) == "") { ?>
        <th class="<?= $Page->sk_penampilan->headerCellClass() ?>"><?= $Page->sk_penampilan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_penampilan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_penampilan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_penampilan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_penampilan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_penampilan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
    <?php if ($Page->SortUrl($Page->sk_alam_perasaan) == "") { ?>
        <th class="<?= $Page->sk_alam_perasaan->headerCellClass() ?>"><?= $Page->sk_alam_perasaan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_alam_perasaan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_alam_perasaan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_alam_perasaan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_alam_perasaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_alam_perasaan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
    <?php if ($Page->SortUrl($Page->sk_pembicaraan) == "") { ?>
        <th class="<?= $Page->sk_pembicaraan->headerCellClass() ?>"><?= $Page->sk_pembicaraan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_pembicaraan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_pembicaraan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_pembicaraan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_pembicaraan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_pembicaraan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_afek->Visible) { // sk_afek ?>
    <?php if ($Page->SortUrl($Page->sk_afek) == "") { ?>
        <th class="<?= $Page->sk_afek->headerCellClass() ?>"><?= $Page->sk_afek->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_afek->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_afek->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_afek->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_afek->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_afek->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
    <?php if ($Page->SortUrl($Page->sk_aktifitas_motorik) == "") { ?>
        <th class="<?= $Page->sk_aktifitas_motorik->headerCellClass() ?>"><?= $Page->sk_aktifitas_motorik->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_aktifitas_motorik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_aktifitas_motorik->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_aktifitas_motorik->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_aktifitas_motorik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_aktifitas_motorik->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
    <?php if ($Page->SortUrl($Page->sk_gangguan_ringan) == "") { ?>
        <th class="<?= $Page->sk_gangguan_ringan->headerCellClass() ?>"><?= $Page->sk_gangguan_ringan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_gangguan_ringan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_gangguan_ringan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_gangguan_ringan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_gangguan_ringan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_gangguan_ringan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
    <?php if ($Page->SortUrl($Page->sk_proses_pikir) == "") { ?>
        <th class="<?= $Page->sk_proses_pikir->headerCellClass() ?>"><?= $Page->sk_proses_pikir->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_proses_pikir->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_proses_pikir->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_proses_pikir->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_proses_pikir->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_proses_pikir->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
    <?php if ($Page->SortUrl($Page->sk_orientasi) == "") { ?>
        <th class="<?= $Page->sk_orientasi->headerCellClass() ?>"><?= $Page->sk_orientasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_orientasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_orientasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_orientasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_orientasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_orientasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
    <?php if ($Page->SortUrl($Page->sk_tingkat_kesadaran_orientasi) == "") { ?>
        <th class="<?= $Page->sk_tingkat_kesadaran_orientasi->headerCellClass() ?>"><?= $Page->sk_tingkat_kesadaran_orientasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_tingkat_kesadaran_orientasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_tingkat_kesadaran_orientasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_tingkat_kesadaran_orientasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_tingkat_kesadaran_orientasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_tingkat_kesadaran_orientasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_memori->Visible) { // sk_memori ?>
    <?php if ($Page->SortUrl($Page->sk_memori) == "") { ?>
        <th class="<?= $Page->sk_memori->headerCellClass() ?>"><?= $Page->sk_memori->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_memori->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_memori->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_memori->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_memori->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_memori->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
    <?php if ($Page->SortUrl($Page->sk_interaksi) == "") { ?>
        <th class="<?= $Page->sk_interaksi->headerCellClass() ?>"><?= $Page->sk_interaksi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_interaksi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_interaksi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_interaksi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_interaksi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_interaksi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
    <?php if ($Page->SortUrl($Page->sk_konsentrasi) == "") { ?>
        <th class="<?= $Page->sk_konsentrasi->headerCellClass() ?>"><?= $Page->sk_konsentrasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_konsentrasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_konsentrasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_konsentrasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_konsentrasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_konsentrasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
    <?php if ($Page->SortUrl($Page->sk_persepsi) == "") { ?>
        <th class="<?= $Page->sk_persepsi->headerCellClass() ?>"><?= $Page->sk_persepsi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_persepsi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_persepsi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_persepsi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_persepsi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_persepsi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
    <?php if ($Page->SortUrl($Page->ket_sk_persepsi) == "") { ?>
        <th class="<?= $Page->ket_sk_persepsi->headerCellClass() ?>"><?= $Page->ket_sk_persepsi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_sk_persepsi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_sk_persepsi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_sk_persepsi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_sk_persepsi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_sk_persepsi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
    <?php if ($Page->SortUrl($Page->sk_isi_pikir) == "") { ?>
        <th class="<?= $Page->sk_isi_pikir->headerCellClass() ?>"><?= $Page->sk_isi_pikir->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_isi_pikir->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_isi_pikir->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_isi_pikir->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_isi_pikir->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_isi_pikir->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_waham->Visible) { // sk_waham ?>
    <?php if ($Page->SortUrl($Page->sk_waham) == "") { ?>
        <th class="<?= $Page->sk_waham->headerCellClass() ?>"><?= $Page->sk_waham->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_waham->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_waham->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_waham->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_waham->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_waham->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
    <?php if ($Page->SortUrl($Page->ket_sk_waham) == "") { ?>
        <th class="<?= $Page->ket_sk_waham->headerCellClass() ?>"><?= $Page->ket_sk_waham->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_sk_waham->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_sk_waham->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_sk_waham->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_sk_waham->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_sk_waham->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
    <?php if ($Page->SortUrl($Page->sk_daya_tilik_diri) == "") { ?>
        <th class="<?= $Page->sk_daya_tilik_diri->headerCellClass() ?>"><?= $Page->sk_daya_tilik_diri->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sk_daya_tilik_diri->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sk_daya_tilik_diri->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sk_daya_tilik_diri->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sk_daya_tilik_diri->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sk_daya_tilik_diri->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
    <?php if ($Page->SortUrl($Page->ket_sk_daya_tilik_diri) == "") { ?>
        <th class="<?= $Page->ket_sk_daya_tilik_diri->headerCellClass() ?>"><?= $Page->ket_sk_daya_tilik_diri->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_sk_daya_tilik_diri->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_sk_daya_tilik_diri->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_sk_daya_tilik_diri->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_sk_daya_tilik_diri->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_sk_daya_tilik_diri->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
    <?php if ($Page->SortUrl($Page->kk_pembelajaran) == "") { ?>
        <th class="<?= $Page->kk_pembelajaran->headerCellClass() ?>"><?= $Page->kk_pembelajaran->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kk_pembelajaran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kk_pembelajaran->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kk_pembelajaran->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kk_pembelajaran->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kk_pembelajaran->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
    <?php if ($Page->SortUrl($Page->ket_kk_pembelajaran) == "") { ?>
        <th class="<?= $Page->ket_kk_pembelajaran->headerCellClass() ?>"><?= $Page->ket_kk_pembelajaran->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_kk_pembelajaran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_kk_pembelajaran->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_kk_pembelajaran->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_kk_pembelajaran->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_kk_pembelajaran->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
    <?php if ($Page->SortUrl($Page->ket_kk_pembelajaran_lainnya) == "") { ?>
        <th class="<?= $Page->ket_kk_pembelajaran_lainnya->headerCellClass() ?>"><?= $Page->ket_kk_pembelajaran_lainnya->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_kk_pembelajaran_lainnya->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_kk_pembelajaran_lainnya->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_kk_pembelajaran_lainnya->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_kk_pembelajaran_lainnya->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_kk_pembelajaran_lainnya->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
    <?php if ($Page->SortUrl($Page->kk_Penerjamah) == "") { ?>
        <th class="<?= $Page->kk_Penerjamah->headerCellClass() ?>"><?= $Page->kk_Penerjamah->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kk_Penerjamah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kk_Penerjamah->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kk_Penerjamah->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kk_Penerjamah->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kk_Penerjamah->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
    <?php if ($Page->SortUrl($Page->ket_kk_penerjamah_Lainnya) == "") { ?>
        <th class="<?= $Page->ket_kk_penerjamah_Lainnya->headerCellClass() ?>"><?= $Page->ket_kk_penerjamah_Lainnya->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_kk_penerjamah_Lainnya->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_kk_penerjamah_Lainnya->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_kk_penerjamah_Lainnya->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_kk_penerjamah_Lainnya->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_kk_penerjamah_Lainnya->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
    <?php if ($Page->SortUrl($Page->kk_bahasa_isyarat) == "") { ?>
        <th class="<?= $Page->kk_bahasa_isyarat->headerCellClass() ?>"><?= $Page->kk_bahasa_isyarat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kk_bahasa_isyarat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kk_bahasa_isyarat->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kk_bahasa_isyarat->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kk_bahasa_isyarat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kk_bahasa_isyarat->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
    <?php if ($Page->SortUrl($Page->kk_kebutuhan_edukasi) == "") { ?>
        <th class="<?= $Page->kk_kebutuhan_edukasi->headerCellClass() ?>"><?= $Page->kk_kebutuhan_edukasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kk_kebutuhan_edukasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kk_kebutuhan_edukasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kk_kebutuhan_edukasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kk_kebutuhan_edukasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kk_kebutuhan_edukasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
    <?php if ($Page->SortUrl($Page->ket_kk_kebutuhan_edukasi) == "") { ?>
        <th class="<?= $Page->ket_kk_kebutuhan_edukasi->headerCellClass() ?>"><?= $Page->ket_kk_kebutuhan_edukasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ket_kk_kebutuhan_edukasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->ket_kk_kebutuhan_edukasi->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->ket_kk_kebutuhan_edukasi->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->ket_kk_kebutuhan_edukasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->ket_kk_kebutuhan_edukasi->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
    <?php if ($Page->SortUrl($Page->rencana) == "") { ?>
        <th class="<?= $Page->rencana->headerCellClass() ?>"><?= $Page->rencana->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rencana->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rencana->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rencana->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rencana->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rencana->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->informasi->Visible) { // informasi ?>
        <!-- informasi -->
        <td<?= $Page->informasi->cellAttributes() ?>>
<span<?= $Page->informasi->viewAttributes() ?>>
<?= $Page->informasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rkd_sakit_sejak->Visible) { // rkd_sakit_sejak ?>
        <!-- rkd_sakit_sejak -->
        <td<?= $Page->rkd_sakit_sejak->cellAttributes() ?>>
<span<?= $Page->rkd_sakit_sejak->viewAttributes() ?>>
<?= $Page->rkd_sakit_sejak->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rkd_berobat->Visible) { // rkd_berobat ?>
        <!-- rkd_berobat -->
        <td<?= $Page->rkd_berobat->cellAttributes() ?>>
<span<?= $Page->rkd_berobat->viewAttributes() ?>>
<?= $Page->rkd_berobat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rkd_hasil_pengobatan->Visible) { // rkd_hasil_pengobatan ?>
        <!-- rkd_hasil_pengobatan -->
        <td<?= $Page->rkd_hasil_pengobatan->cellAttributes() ?>>
<span<?= $Page->rkd_hasil_pengobatan->viewAttributes() ?>>
<?= $Page->rkd_hasil_pengobatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->fp_putus_obat->Visible) { // fp_putus_obat ?>
        <!-- fp_putus_obat -->
        <td<?= $Page->fp_putus_obat->cellAttributes() ?>>
<span<?= $Page->fp_putus_obat->viewAttributes() ?>>
<?= $Page->fp_putus_obat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_putus_obat->Visible) { // ket_putus_obat ?>
        <!-- ket_putus_obat -->
        <td<?= $Page->ket_putus_obat->cellAttributes() ?>>
<span<?= $Page->ket_putus_obat->viewAttributes() ?>>
<?= $Page->ket_putus_obat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->fp_ekonomi->Visible) { // fp_ekonomi ?>
        <!-- fp_ekonomi -->
        <td<?= $Page->fp_ekonomi->cellAttributes() ?>>
<span<?= $Page->fp_ekonomi->viewAttributes() ?>>
<?= $Page->fp_ekonomi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_masalah_ekonomi->Visible) { // ket_masalah_ekonomi ?>
        <!-- ket_masalah_ekonomi -->
        <td<?= $Page->ket_masalah_ekonomi->cellAttributes() ?>>
<span<?= $Page->ket_masalah_ekonomi->viewAttributes() ?>>
<?= $Page->ket_masalah_ekonomi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->fp_masalah_fisik->Visible) { // fp_masalah_fisik ?>
        <!-- fp_masalah_fisik -->
        <td<?= $Page->fp_masalah_fisik->cellAttributes() ?>>
<span<?= $Page->fp_masalah_fisik->viewAttributes() ?>>
<?= $Page->fp_masalah_fisik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_masalah_fisik->Visible) { // ket_masalah_fisik ?>
        <!-- ket_masalah_fisik -->
        <td<?= $Page->ket_masalah_fisik->cellAttributes() ?>>
<span<?= $Page->ket_masalah_fisik->viewAttributes() ?>>
<?= $Page->ket_masalah_fisik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->fp_masalah_psikososial->Visible) { // fp_masalah_psikososial ?>
        <!-- fp_masalah_psikososial -->
        <td<?= $Page->fp_masalah_psikososial->cellAttributes() ?>>
<span<?= $Page->fp_masalah_psikososial->viewAttributes() ?>>
<?= $Page->fp_masalah_psikososial->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_masalah_psikososial->Visible) { // ket_masalah_psikososial ?>
        <!-- ket_masalah_psikososial -->
        <td<?= $Page->ket_masalah_psikososial->cellAttributes() ?>>
<span<?= $Page->ket_masalah_psikososial->viewAttributes() ?>>
<?= $Page->ket_masalah_psikososial->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rh_keluarga->Visible) { // rh_keluarga ?>
        <!-- rh_keluarga -->
        <td<?= $Page->rh_keluarga->cellAttributes() ?>>
<span<?= $Page->rh_keluarga->viewAttributes() ?>>
<?= $Page->rh_keluarga->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rh_keluarga->Visible) { // ket_rh_keluarga ?>
        <!-- ket_rh_keluarga -->
        <td<?= $Page->ket_rh_keluarga->cellAttributes() ?>>
<span<?= $Page->ket_rh_keluarga->viewAttributes() ?>>
<?= $Page->ket_rh_keluarga->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->resiko_bunuh_diri->Visible) { // resiko_bunuh_diri ?>
        <!-- resiko_bunuh_diri -->
        <td<?= $Page->resiko_bunuh_diri->cellAttributes() ?>>
<span<?= $Page->resiko_bunuh_diri->viewAttributes() ?>>
<?= $Page->resiko_bunuh_diri->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rbd_ide->Visible) { // rbd_ide ?>
        <!-- rbd_ide -->
        <td<?= $Page->rbd_ide->cellAttributes() ?>>
<span<?= $Page->rbd_ide->viewAttributes() ?>>
<?= $Page->rbd_ide->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_ide->Visible) { // ket_rbd_ide ?>
        <!-- ket_rbd_ide -->
        <td<?= $Page->ket_rbd_ide->cellAttributes() ?>>
<span<?= $Page->ket_rbd_ide->viewAttributes() ?>>
<?= $Page->ket_rbd_ide->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rbd_rencana->Visible) { // rbd_rencana ?>
        <!-- rbd_rencana -->
        <td<?= $Page->rbd_rencana->cellAttributes() ?>>
<span<?= $Page->rbd_rencana->viewAttributes() ?>>
<?= $Page->rbd_rencana->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_rencana->Visible) { // ket_rbd_rencana ?>
        <!-- ket_rbd_rencana -->
        <td<?= $Page->ket_rbd_rencana->cellAttributes() ?>>
<span<?= $Page->ket_rbd_rencana->viewAttributes() ?>>
<?= $Page->ket_rbd_rencana->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rbd_alat->Visible) { // rbd_alat ?>
        <!-- rbd_alat -->
        <td<?= $Page->rbd_alat->cellAttributes() ?>>
<span<?= $Page->rbd_alat->viewAttributes() ?>>
<?= $Page->rbd_alat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_alat->Visible) { // ket_rbd_alat ?>
        <!-- ket_rbd_alat -->
        <td<?= $Page->ket_rbd_alat->cellAttributes() ?>>
<span<?= $Page->ket_rbd_alat->viewAttributes() ?>>
<?= $Page->ket_rbd_alat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rbd_percobaan->Visible) { // rbd_percobaan ?>
        <!-- rbd_percobaan -->
        <td<?= $Page->rbd_percobaan->cellAttributes() ?>>
<span<?= $Page->rbd_percobaan->viewAttributes() ?>>
<?= $Page->rbd_percobaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_percobaan->Visible) { // ket_rbd_percobaan ?>
        <!-- ket_rbd_percobaan -->
        <td<?= $Page->ket_rbd_percobaan->cellAttributes() ?>>
<span<?= $Page->ket_rbd_percobaan->viewAttributes() ?>>
<?= $Page->ket_rbd_percobaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rbd_keinginan->Visible) { // rbd_keinginan ?>
        <!-- rbd_keinginan -->
        <td<?= $Page->rbd_keinginan->cellAttributes() ?>>
<span<?= $Page->rbd_keinginan->viewAttributes() ?>>
<?= $Page->rbd_keinginan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rbd_keinginan->Visible) { // ket_rbd_keinginan ?>
        <!-- ket_rbd_keinginan -->
        <td<?= $Page->ket_rbd_keinginan->cellAttributes() ?>>
<span<?= $Page->ket_rbd_keinginan->viewAttributes() ?>>
<?= $Page->ket_rbd_keinginan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rpo_penggunaan->Visible) { // rpo_penggunaan ?>
        <!-- rpo_penggunaan -->
        <td<?= $Page->rpo_penggunaan->cellAttributes() ?>>
<span<?= $Page->rpo_penggunaan->viewAttributes() ?>>
<?= $Page->rpo_penggunaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rpo_penggunaan->Visible) { // ket_rpo_penggunaan ?>
        <!-- ket_rpo_penggunaan -->
        <td<?= $Page->ket_rpo_penggunaan->cellAttributes() ?>>
<span<?= $Page->ket_rpo_penggunaan->viewAttributes() ?>>
<?= $Page->ket_rpo_penggunaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rpo_efek_samping->Visible) { // rpo_efek_samping ?>
        <!-- rpo_efek_samping -->
        <td<?= $Page->rpo_efek_samping->cellAttributes() ?>>
<span<?= $Page->rpo_efek_samping->viewAttributes() ?>>
<?= $Page->rpo_efek_samping->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rpo_efek_samping->Visible) { // ket_rpo_efek_samping ?>
        <!-- ket_rpo_efek_samping -->
        <td<?= $Page->ket_rpo_efek_samping->cellAttributes() ?>>
<span<?= $Page->ket_rpo_efek_samping->viewAttributes() ?>>
<?= $Page->ket_rpo_efek_samping->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rpo_napza->Visible) { // rpo_napza ?>
        <!-- rpo_napza -->
        <td<?= $Page->rpo_napza->cellAttributes() ?>>
<span<?= $Page->rpo_napza->viewAttributes() ?>>
<?= $Page->rpo_napza->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_rpo_napza->Visible) { // ket_rpo_napza ?>
        <!-- ket_rpo_napza -->
        <td<?= $Page->ket_rpo_napza->cellAttributes() ?>>
<span<?= $Page->ket_rpo_napza->viewAttributes() ?>>
<?= $Page->ket_rpo_napza->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_lama_pemakaian->Visible) { // ket_lama_pemakaian ?>
        <!-- ket_lama_pemakaian -->
        <td<?= $Page->ket_lama_pemakaian->cellAttributes() ?>>
<span<?= $Page->ket_lama_pemakaian->viewAttributes() ?>>
<?= $Page->ket_lama_pemakaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_cara_pemakaian->Visible) { // ket_cara_pemakaian ?>
        <!-- ket_cara_pemakaian -->
        <td<?= $Page->ket_cara_pemakaian->cellAttributes() ?>>
<span<?= $Page->ket_cara_pemakaian->viewAttributes() ?>>
<?= $Page->ket_cara_pemakaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_latar_belakang_pemakaian->Visible) { // ket_latar_belakang_pemakaian ?>
        <!-- ket_latar_belakang_pemakaian -->
        <td<?= $Page->ket_latar_belakang_pemakaian->cellAttributes() ?>>
<span<?= $Page->ket_latar_belakang_pemakaian->viewAttributes() ?>>
<?= $Page->ket_latar_belakang_pemakaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rpo_penggunaan_obat_lainnya->Visible) { // rpo_penggunaan_obat_lainnya ?>
        <!-- rpo_penggunaan_obat_lainnya -->
        <td<?= $Page->rpo_penggunaan_obat_lainnya->cellAttributes() ?>>
<span<?= $Page->rpo_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->rpo_penggunaan_obat_lainnya->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_penggunaan_obat_lainnya->Visible) { // ket_penggunaan_obat_lainnya ?>
        <!-- ket_penggunaan_obat_lainnya -->
        <td<?= $Page->ket_penggunaan_obat_lainnya->cellAttributes() ?>>
<span<?= $Page->ket_penggunaan_obat_lainnya->viewAttributes() ?>>
<?= $Page->ket_penggunaan_obat_lainnya->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_alasan_penggunaan->Visible) { // ket_alasan_penggunaan ?>
        <!-- ket_alasan_penggunaan -->
        <td<?= $Page->ket_alasan_penggunaan->cellAttributes() ?>>
<span<?= $Page->ket_alasan_penggunaan->viewAttributes() ?>>
<?= $Page->ket_alasan_penggunaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rpo_alergi_obat->Visible) { // rpo_alergi_obat ?>
        <!-- rpo_alergi_obat -->
        <td<?= $Page->rpo_alergi_obat->cellAttributes() ?>>
<span<?= $Page->rpo_alergi_obat->viewAttributes() ?>>
<?= $Page->rpo_alergi_obat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_alergi_obat->Visible) { // ket_alergi_obat ?>
        <!-- ket_alergi_obat -->
        <td<?= $Page->ket_alergi_obat->cellAttributes() ?>>
<span<?= $Page->ket_alergi_obat->viewAttributes() ?>>
<?= $Page->ket_alergi_obat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rpo_merokok->Visible) { // rpo_merokok ?>
        <!-- rpo_merokok -->
        <td<?= $Page->rpo_merokok->cellAttributes() ?>>
<span<?= $Page->rpo_merokok->viewAttributes() ?>>
<?= $Page->rpo_merokok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_merokok->Visible) { // ket_merokok ?>
        <!-- ket_merokok -->
        <td<?= $Page->ket_merokok->cellAttributes() ?>>
<span<?= $Page->ket_merokok->viewAttributes() ?>>
<?= $Page->ket_merokok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rpo_minum_kopi->Visible) { // rpo_minum_kopi ?>
        <!-- rpo_minum_kopi -->
        <td<?= $Page->rpo_minum_kopi->cellAttributes() ?>>
<span<?= $Page->rpo_minum_kopi->viewAttributes() ?>>
<?= $Page->rpo_minum_kopi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_minum_kopi->Visible) { // ket_minum_kopi ?>
        <!-- ket_minum_kopi -->
        <td<?= $Page->ket_minum_kopi->cellAttributes() ?>>
<span<?= $Page->ket_minum_kopi->viewAttributes() ?>>
<?= $Page->ket_minum_kopi->getViewValue() ?></span>
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
<?php if ($Page->gcs->Visible) { // gcs ?>
        <!-- gcs -->
        <td<?= $Page->gcs->cellAttributes() ?>>
<span<?= $Page->gcs->viewAttributes() ?>>
<?= $Page->gcs->getViewValue() ?></span>
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
<?php if ($Page->pf_keluhan_fisik->Visible) { // pf_keluhan_fisik ?>
        <!-- pf_keluhan_fisik -->
        <td<?= $Page->pf_keluhan_fisik->cellAttributes() ?>>
<span<?= $Page->pf_keluhan_fisik->viewAttributes() ?>>
<?= $Page->pf_keluhan_fisik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_keluhan_fisik->Visible) { // ket_keluhan_fisik ?>
        <!-- ket_keluhan_fisik -->
        <td<?= $Page->ket_keluhan_fisik->cellAttributes() ?>>
<span<?= $Page->ket_keluhan_fisik->viewAttributes() ?>>
<?= $Page->ket_keluhan_fisik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->skala_nyeri->Visible) { // skala_nyeri ?>
        <!-- skala_nyeri -->
        <td<?= $Page->skala_nyeri->cellAttributes() ?>>
<span<?= $Page->skala_nyeri->viewAttributes() ?>>
<?= $Page->skala_nyeri->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->durasi->Visible) { // durasi ?>
        <!-- durasi -->
        <td<?= $Page->durasi->cellAttributes() ?>>
<span<?= $Page->durasi->viewAttributes() ?>>
<?= $Page->durasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nyeri->Visible) { // nyeri ?>
        <!-- nyeri -->
        <td<?= $Page->nyeri->cellAttributes() ?>>
<span<?= $Page->nyeri->viewAttributes() ?>>
<?= $Page->nyeri->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->provokes->Visible) { // provokes ?>
        <!-- provokes -->
        <td<?= $Page->provokes->cellAttributes() ?>>
<span<?= $Page->provokes->viewAttributes() ?>>
<?= $Page->provokes->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_provokes->Visible) { // ket_provokes ?>
        <!-- ket_provokes -->
        <td<?= $Page->ket_provokes->cellAttributes() ?>>
<span<?= $Page->ket_provokes->viewAttributes() ?>>
<?= $Page->ket_provokes->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->quality->Visible) { // quality ?>
        <!-- quality -->
        <td<?= $Page->quality->cellAttributes() ?>>
<span<?= $Page->quality->viewAttributes() ?>>
<?= $Page->quality->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_quality->Visible) { // ket_quality ?>
        <!-- ket_quality -->
        <td<?= $Page->ket_quality->cellAttributes() ?>>
<span<?= $Page->ket_quality->viewAttributes() ?>>
<?= $Page->ket_quality->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <!-- lokasi -->
        <td<?= $Page->lokasi->cellAttributes() ?>>
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->menyebar->Visible) { // menyebar ?>
        <!-- menyebar -->
        <td<?= $Page->menyebar->cellAttributes() ?>>
<span<?= $Page->menyebar->viewAttributes() ?>>
<?= $Page->menyebar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->pada_dokter->Visible) { // pada_dokter ?>
        <!-- pada_dokter -->
        <td<?= $Page->pada_dokter->cellAttributes() ?>>
<span<?= $Page->pada_dokter->viewAttributes() ?>>
<?= $Page->pada_dokter->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_dokter->Visible) { // ket_dokter ?>
        <!-- ket_dokter -->
        <td<?= $Page->ket_dokter->cellAttributes() ?>>
<span<?= $Page->ket_dokter->viewAttributes() ?>>
<?= $Page->ket_dokter->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nyeri_hilang->Visible) { // nyeri_hilang ?>
        <!-- nyeri_hilang -->
        <td<?= $Page->nyeri_hilang->cellAttributes() ?>>
<span<?= $Page->nyeri_hilang->viewAttributes() ?>>
<?= $Page->nyeri_hilang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_nyeri->Visible) { // ket_nyeri ?>
        <!-- ket_nyeri -->
        <td<?= $Page->ket_nyeri->cellAttributes() ?>>
<span<?= $Page->ket_nyeri->viewAttributes() ?>>
<?= $Page->ket_nyeri->getViewValue() ?></span>
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
<?php if ($Page->bmi->Visible) { // bmi ?>
        <!-- bmi -->
        <td<?= $Page->bmi->cellAttributes() ?>>
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->lapor_status_nutrisi->Visible) { // lapor_status_nutrisi ?>
        <!-- lapor_status_nutrisi -->
        <td<?= $Page->lapor_status_nutrisi->cellAttributes() ?>>
<span<?= $Page->lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->lapor_status_nutrisi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_lapor_status_nutrisi->Visible) { // ket_lapor_status_nutrisi ?>
        <!-- ket_lapor_status_nutrisi -->
        <td<?= $Page->ket_lapor_status_nutrisi->cellAttributes() ?>>
<span<?= $Page->ket_lapor_status_nutrisi->viewAttributes() ?>>
<?= $Page->ket_lapor_status_nutrisi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sg1->Visible) { // sg1 ?>
        <!-- sg1 -->
        <td<?= $Page->sg1->cellAttributes() ?>>
<span<?= $Page->sg1->viewAttributes() ?>>
<?= $Page->sg1->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nilai1->Visible) { // nilai1 ?>
        <!-- nilai1 -->
        <td<?= $Page->nilai1->cellAttributes() ?>>
<span<?= $Page->nilai1->viewAttributes() ?>>
<?= $Page->nilai1->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sg2->Visible) { // sg2 ?>
        <!-- sg2 -->
        <td<?= $Page->sg2->cellAttributes() ?>>
<span<?= $Page->sg2->viewAttributes() ?>>
<?= $Page->sg2->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nilai2->Visible) { // nilai2 ?>
        <!-- nilai2 -->
        <td<?= $Page->nilai2->cellAttributes() ?>>
<span<?= $Page->nilai2->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_nilai2_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->nilai2->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->nilai2->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_nilai2_<?= $Page->RowCount ?>"></label>
</div></span>
</td>
<?php } ?>
<?php if ($Page->total_hasil->Visible) { // total_hasil ?>
        <!-- total_hasil -->
        <td<?= $Page->total_hasil->cellAttributes() ?>>
<span<?= $Page->total_hasil->viewAttributes() ?>>
<?= $Page->total_hasil->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->resikojatuh->Visible) { // resikojatuh ?>
        <!-- resikojatuh -->
        <td<?= $Page->resikojatuh->cellAttributes() ?>>
<span<?= $Page->resikojatuh->viewAttributes() ?>>
<?= $Page->resikojatuh->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->bjm->Visible) { // bjm ?>
        <!-- bjm -->
        <td<?= $Page->bjm->cellAttributes() ?>>
<span<?= $Page->bjm->viewAttributes() ?>>
<?= $Page->bjm->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->msa->Visible) { // msa ?>
        <!-- msa -->
        <td<?= $Page->msa->cellAttributes() ?>>
<span<?= $Page->msa->viewAttributes() ?>>
<?= $Page->msa->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->hasil->Visible) { // hasil ?>
        <!-- hasil -->
        <td<?= $Page->hasil->cellAttributes() ?>>
<span<?= $Page->hasil->viewAttributes() ?>>
<?= $Page->hasil->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->lapor->Visible) { // lapor ?>
        <!-- lapor -->
        <td<?= $Page->lapor->cellAttributes() ?>>
<span<?= $Page->lapor->viewAttributes() ?>>
<?= $Page->lapor->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_lapor->Visible) { // ket_lapor ?>
        <!-- ket_lapor -->
        <td<?= $Page->ket_lapor->cellAttributes() ?>>
<span<?= $Page->ket_lapor->viewAttributes() ?>>
<?= $Page->ket_lapor->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_mandi->Visible) { // adl_mandi ?>
        <!-- adl_mandi -->
        <td<?= $Page->adl_mandi->cellAttributes() ?>>
<span<?= $Page->adl_mandi->viewAttributes() ?>>
<?= $Page->adl_mandi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_berpakaian->Visible) { // adl_berpakaian ?>
        <!-- adl_berpakaian -->
        <td<?= $Page->adl_berpakaian->cellAttributes() ?>>
<span<?= $Page->adl_berpakaian->viewAttributes() ?>>
<?= $Page->adl_berpakaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_makan->Visible) { // adl_makan ?>
        <!-- adl_makan -->
        <td<?= $Page->adl_makan->cellAttributes() ?>>
<span<?= $Page->adl_makan->viewAttributes() ?>>
<?= $Page->adl_makan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_bak->Visible) { // adl_bak ?>
        <!-- adl_bak -->
        <td<?= $Page->adl_bak->cellAttributes() ?>>
<span<?= $Page->adl_bak->viewAttributes() ?>>
<?= $Page->adl_bak->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_bab->Visible) { // adl_bab ?>
        <!-- adl_bab -->
        <td<?= $Page->adl_bab->cellAttributes() ?>>
<span<?= $Page->adl_bab->viewAttributes() ?>>
<?= $Page->adl_bab->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_hobi->Visible) { // adl_hobi ?>
        <!-- adl_hobi -->
        <td<?= $Page->adl_hobi->cellAttributes() ?>>
<span<?= $Page->adl_hobi->viewAttributes() ?>>
<?= $Page->adl_hobi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_adl_hobi->Visible) { // ket_adl_hobi ?>
        <!-- ket_adl_hobi -->
        <td<?= $Page->ket_adl_hobi->cellAttributes() ?>>
<span<?= $Page->ket_adl_hobi->viewAttributes() ?>>
<?= $Page->ket_adl_hobi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_sosialisasi->Visible) { // adl_sosialisasi ?>
        <!-- adl_sosialisasi -->
        <td<?= $Page->adl_sosialisasi->cellAttributes() ?>>
<span<?= $Page->adl_sosialisasi->viewAttributes() ?>>
<?= $Page->adl_sosialisasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_adl_sosialisasi->Visible) { // ket_adl_sosialisasi ?>
        <!-- ket_adl_sosialisasi -->
        <td<?= $Page->ket_adl_sosialisasi->cellAttributes() ?>>
<span<?= $Page->ket_adl_sosialisasi->viewAttributes() ?>>
<?= $Page->ket_adl_sosialisasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->adl_kegiatan->Visible) { // adl_kegiatan ?>
        <!-- adl_kegiatan -->
        <td<?= $Page->adl_kegiatan->cellAttributes() ?>>
<span<?= $Page->adl_kegiatan->viewAttributes() ?>>
<?= $Page->adl_kegiatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_adl_kegiatan->Visible) { // ket_adl_kegiatan ?>
        <!-- ket_adl_kegiatan -->
        <td<?= $Page->ket_adl_kegiatan->cellAttributes() ?>>
<span<?= $Page->ket_adl_kegiatan->viewAttributes() ?>>
<?= $Page->ket_adl_kegiatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_penampilan->Visible) { // sk_penampilan ?>
        <!-- sk_penampilan -->
        <td<?= $Page->sk_penampilan->cellAttributes() ?>>
<span<?= $Page->sk_penampilan->viewAttributes() ?>>
<?= $Page->sk_penampilan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_alam_perasaan->Visible) { // sk_alam_perasaan ?>
        <!-- sk_alam_perasaan -->
        <td<?= $Page->sk_alam_perasaan->cellAttributes() ?>>
<span<?= $Page->sk_alam_perasaan->viewAttributes() ?>>
<?= $Page->sk_alam_perasaan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_pembicaraan->Visible) { // sk_pembicaraan ?>
        <!-- sk_pembicaraan -->
        <td<?= $Page->sk_pembicaraan->cellAttributes() ?>>
<span<?= $Page->sk_pembicaraan->viewAttributes() ?>>
<?= $Page->sk_pembicaraan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_afek->Visible) { // sk_afek ?>
        <!-- sk_afek -->
        <td<?= $Page->sk_afek->cellAttributes() ?>>
<span<?= $Page->sk_afek->viewAttributes() ?>>
<?= $Page->sk_afek->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_aktifitas_motorik->Visible) { // sk_aktifitas_motorik ?>
        <!-- sk_aktifitas_motorik -->
        <td<?= $Page->sk_aktifitas_motorik->cellAttributes() ?>>
<span<?= $Page->sk_aktifitas_motorik->viewAttributes() ?>>
<?= $Page->sk_aktifitas_motorik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_gangguan_ringan->Visible) { // sk_gangguan_ringan ?>
        <!-- sk_gangguan_ringan -->
        <td<?= $Page->sk_gangguan_ringan->cellAttributes() ?>>
<span<?= $Page->sk_gangguan_ringan->viewAttributes() ?>>
<?= $Page->sk_gangguan_ringan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_proses_pikir->Visible) { // sk_proses_pikir ?>
        <!-- sk_proses_pikir -->
        <td<?= $Page->sk_proses_pikir->cellAttributes() ?>>
<span<?= $Page->sk_proses_pikir->viewAttributes() ?>>
<?= $Page->sk_proses_pikir->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_orientasi->Visible) { // sk_orientasi ?>
        <!-- sk_orientasi -->
        <td<?= $Page->sk_orientasi->cellAttributes() ?>>
<span<?= $Page->sk_orientasi->viewAttributes() ?>>
<?= $Page->sk_orientasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_tingkat_kesadaran_orientasi->Visible) { // sk_tingkat_kesadaran_orientasi ?>
        <!-- sk_tingkat_kesadaran_orientasi -->
        <td<?= $Page->sk_tingkat_kesadaran_orientasi->cellAttributes() ?>>
<span<?= $Page->sk_tingkat_kesadaran_orientasi->viewAttributes() ?>>
<?= $Page->sk_tingkat_kesadaran_orientasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_memori->Visible) { // sk_memori ?>
        <!-- sk_memori -->
        <td<?= $Page->sk_memori->cellAttributes() ?>>
<span<?= $Page->sk_memori->viewAttributes() ?>>
<?= $Page->sk_memori->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_interaksi->Visible) { // sk_interaksi ?>
        <!-- sk_interaksi -->
        <td<?= $Page->sk_interaksi->cellAttributes() ?>>
<span<?= $Page->sk_interaksi->viewAttributes() ?>>
<?= $Page->sk_interaksi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_konsentrasi->Visible) { // sk_konsentrasi ?>
        <!-- sk_konsentrasi -->
        <td<?= $Page->sk_konsentrasi->cellAttributes() ?>>
<span<?= $Page->sk_konsentrasi->viewAttributes() ?>>
<?= $Page->sk_konsentrasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_persepsi->Visible) { // sk_persepsi ?>
        <!-- sk_persepsi -->
        <td<?= $Page->sk_persepsi->cellAttributes() ?>>
<span<?= $Page->sk_persepsi->viewAttributes() ?>>
<?= $Page->sk_persepsi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_sk_persepsi->Visible) { // ket_sk_persepsi ?>
        <!-- ket_sk_persepsi -->
        <td<?= $Page->ket_sk_persepsi->cellAttributes() ?>>
<span<?= $Page->ket_sk_persepsi->viewAttributes() ?>>
<?= $Page->ket_sk_persepsi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_isi_pikir->Visible) { // sk_isi_pikir ?>
        <!-- sk_isi_pikir -->
        <td<?= $Page->sk_isi_pikir->cellAttributes() ?>>
<span<?= $Page->sk_isi_pikir->viewAttributes() ?>>
<?= $Page->sk_isi_pikir->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_waham->Visible) { // sk_waham ?>
        <!-- sk_waham -->
        <td<?= $Page->sk_waham->cellAttributes() ?>>
<span<?= $Page->sk_waham->viewAttributes() ?>>
<?= $Page->sk_waham->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_sk_waham->Visible) { // ket_sk_waham ?>
        <!-- ket_sk_waham -->
        <td<?= $Page->ket_sk_waham->cellAttributes() ?>>
<span<?= $Page->ket_sk_waham->viewAttributes() ?>>
<?= $Page->ket_sk_waham->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sk_daya_tilik_diri->Visible) { // sk_daya_tilik_diri ?>
        <!-- sk_daya_tilik_diri -->
        <td<?= $Page->sk_daya_tilik_diri->cellAttributes() ?>>
<span<?= $Page->sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->sk_daya_tilik_diri->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_sk_daya_tilik_diri->Visible) { // ket_sk_daya_tilik_diri ?>
        <!-- ket_sk_daya_tilik_diri -->
        <td<?= $Page->ket_sk_daya_tilik_diri->cellAttributes() ?>>
<span<?= $Page->ket_sk_daya_tilik_diri->viewAttributes() ?>>
<?= $Page->ket_sk_daya_tilik_diri->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kk_pembelajaran->Visible) { // kk_pembelajaran ?>
        <!-- kk_pembelajaran -->
        <td<?= $Page->kk_pembelajaran->cellAttributes() ?>>
<span<?= $Page->kk_pembelajaran->viewAttributes() ?>>
<?= $Page->kk_pembelajaran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran->Visible) { // ket_kk_pembelajaran ?>
        <!-- ket_kk_pembelajaran -->
        <td<?= $Page->ket_kk_pembelajaran->cellAttributes() ?>>
<span<?= $Page->ket_kk_pembelajaran->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_pembelajaran_lainnya->Visible) { // ket_kk_pembelajaran_lainnya ?>
        <!-- ket_kk_pembelajaran_lainnya -->
        <td<?= $Page->ket_kk_pembelajaran_lainnya->cellAttributes() ?>>
<span<?= $Page->ket_kk_pembelajaran_lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_pembelajaran_lainnya->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kk_Penerjamah->Visible) { // kk_Penerjamah ?>
        <!-- kk_Penerjamah -->
        <td<?= $Page->kk_Penerjamah->cellAttributes() ?>>
<span<?= $Page->kk_Penerjamah->viewAttributes() ?>>
<?= $Page->kk_Penerjamah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_penerjamah_Lainnya->Visible) { // ket_kk_penerjamah_Lainnya ?>
        <!-- ket_kk_penerjamah_Lainnya -->
        <td<?= $Page->ket_kk_penerjamah_Lainnya->cellAttributes() ?>>
<span<?= $Page->ket_kk_penerjamah_Lainnya->viewAttributes() ?>>
<?= $Page->ket_kk_penerjamah_Lainnya->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kk_bahasa_isyarat->Visible) { // kk_bahasa_isyarat ?>
        <!-- kk_bahasa_isyarat -->
        <td<?= $Page->kk_bahasa_isyarat->cellAttributes() ?>>
<span<?= $Page->kk_bahasa_isyarat->viewAttributes() ?>>
<?= $Page->kk_bahasa_isyarat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kk_kebutuhan_edukasi->Visible) { // kk_kebutuhan_edukasi ?>
        <!-- kk_kebutuhan_edukasi -->
        <td<?= $Page->kk_kebutuhan_edukasi->cellAttributes() ?>>
<span<?= $Page->kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->kk_kebutuhan_edukasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ket_kk_kebutuhan_edukasi->Visible) { // ket_kk_kebutuhan_edukasi ?>
        <!-- ket_kk_kebutuhan_edukasi -->
        <td<?= $Page->ket_kk_kebutuhan_edukasi->cellAttributes() ?>>
<span<?= $Page->ket_kk_kebutuhan_edukasi->viewAttributes() ?>>
<?= $Page->ket_kk_kebutuhan_edukasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->rencana->Visible) { // rencana ?>
        <!-- rencana -->
        <td<?= $Page->rencana->cellAttributes() ?>>
<span<?= $Page->rencana->viewAttributes() ?>>
<?= $Page->rencana->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <!-- nip -->
        <td<?= $Page->nip->cellAttributes() ?>>
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
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
