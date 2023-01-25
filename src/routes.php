<?php

namespace PHPMaker2021\project4sikdec;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // bahasa_pasien
    $app->any('/BahasaPasienList[/{id}]', BahasaPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('BahasaPasienList-bahasa_pasien-list'); // list
    $app->any('/BahasaPasienAdd[/{id}]', BahasaPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('BahasaPasienAdd-bahasa_pasien-add'); // add
    $app->any('/BahasaPasienView[/{id}]', BahasaPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('BahasaPasienView-bahasa_pasien-view'); // view
    $app->any('/BahasaPasienEdit[/{id}]', BahasaPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('BahasaPasienEdit-bahasa_pasien-edit'); // edit
    $app->any('/BahasaPasienDelete[/{id}]', BahasaPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('BahasaPasienDelete-bahasa_pasien-delete'); // delete
    $app->group(
        '/bahasa_pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BahasaPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('bahasa_pasien/list-bahasa_pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BahasaPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('bahasa_pasien/add-bahasa_pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BahasaPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('bahasa_pasien/view-bahasa_pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BahasaPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('bahasa_pasien/edit-bahasa_pasien-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BahasaPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('bahasa_pasien/delete-bahasa_pasien-delete-2'); // delete
        }
    );

    // cacat_fisik
    $app->any('/CacatFisikList[/{id}]', CacatFisikController::class . ':list')->add(PermissionMiddleware::class)->setName('CacatFisikList-cacat_fisik-list'); // list
    $app->any('/CacatFisikAdd[/{id}]', CacatFisikController::class . ':add')->add(PermissionMiddleware::class)->setName('CacatFisikAdd-cacat_fisik-add'); // add
    $app->any('/CacatFisikView[/{id}]', CacatFisikController::class . ':view')->add(PermissionMiddleware::class)->setName('CacatFisikView-cacat_fisik-view'); // view
    $app->any('/CacatFisikEdit[/{id}]', CacatFisikController::class . ':edit')->add(PermissionMiddleware::class)->setName('CacatFisikEdit-cacat_fisik-edit'); // edit
    $app->any('/CacatFisikDelete[/{id}]', CacatFisikController::class . ':delete')->add(PermissionMiddleware::class)->setName('CacatFisikDelete-cacat_fisik-delete'); // delete
    $app->group(
        '/cacat_fisik',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', CacatFisikController::class . ':list')->add(PermissionMiddleware::class)->setName('cacat_fisik/list-cacat_fisik-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', CacatFisikController::class . ':add')->add(PermissionMiddleware::class)->setName('cacat_fisik/add-cacat_fisik-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', CacatFisikController::class . ':view')->add(PermissionMiddleware::class)->setName('cacat_fisik/view-cacat_fisik-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', CacatFisikController::class . ':edit')->add(PermissionMiddleware::class)->setName('cacat_fisik/edit-cacat_fisik-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', CacatFisikController::class . ':delete')->add(PermissionMiddleware::class)->setName('cacat_fisik/delete-cacat_fisik-delete-2'); // delete
        }
    );

    // kabupaten
    $app->any('/KabupatenList[/{kd_kab}]', KabupatenController::class . ':list')->add(PermissionMiddleware::class)->setName('KabupatenList-kabupaten-list'); // list
    $app->any('/KabupatenAdd[/{kd_kab}]', KabupatenController::class . ':add')->add(PermissionMiddleware::class)->setName('KabupatenAdd-kabupaten-add'); // add
    $app->any('/KabupatenView[/{kd_kab}]', KabupatenController::class . ':view')->add(PermissionMiddleware::class)->setName('KabupatenView-kabupaten-view'); // view
    $app->any('/KabupatenEdit[/{kd_kab}]', KabupatenController::class . ':edit')->add(PermissionMiddleware::class)->setName('KabupatenEdit-kabupaten-edit'); // edit
    $app->any('/KabupatenDelete[/{kd_kab}]', KabupatenController::class . ':delete')->add(PermissionMiddleware::class)->setName('KabupatenDelete-kabupaten-delete'); // delete
    $app->group(
        '/kabupaten',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kd_kab}]', KabupatenController::class . ':list')->add(PermissionMiddleware::class)->setName('kabupaten/list-kabupaten-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kd_kab}]', KabupatenController::class . ':add')->add(PermissionMiddleware::class)->setName('kabupaten/add-kabupaten-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kd_kab}]', KabupatenController::class . ':view')->add(PermissionMiddleware::class)->setName('kabupaten/view-kabupaten-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kd_kab}]', KabupatenController::class . ':edit')->add(PermissionMiddleware::class)->setName('kabupaten/edit-kabupaten-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kd_kab}]', KabupatenController::class . ':delete')->add(PermissionMiddleware::class)->setName('kabupaten/delete-kabupaten-delete-2'); // delete
        }
    );

    // kecamatan
    $app->any('/KecamatanList[/{kd_kec}]', KecamatanController::class . ':list')->add(PermissionMiddleware::class)->setName('KecamatanList-kecamatan-list'); // list
    $app->any('/KecamatanAdd[/{kd_kec}]', KecamatanController::class . ':add')->add(PermissionMiddleware::class)->setName('KecamatanAdd-kecamatan-add'); // add
    $app->any('/KecamatanView[/{kd_kec}]', KecamatanController::class . ':view')->add(PermissionMiddleware::class)->setName('KecamatanView-kecamatan-view'); // view
    $app->any('/KecamatanEdit[/{kd_kec}]', KecamatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('KecamatanEdit-kecamatan-edit'); // edit
    $app->any('/KecamatanDelete[/{kd_kec}]', KecamatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('KecamatanDelete-kecamatan-delete'); // delete
    $app->group(
        '/kecamatan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kd_kec}]', KecamatanController::class . ':list')->add(PermissionMiddleware::class)->setName('kecamatan/list-kecamatan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kd_kec}]', KecamatanController::class . ':add')->add(PermissionMiddleware::class)->setName('kecamatan/add-kecamatan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kd_kec}]', KecamatanController::class . ':view')->add(PermissionMiddleware::class)->setName('kecamatan/view-kecamatan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kd_kec}]', KecamatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('kecamatan/edit-kecamatan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kd_kec}]', KecamatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('kecamatan/delete-kecamatan-delete-2'); // delete
        }
    );

    // kelurahan
    $app->any('/KelurahanList[/{kd_kel}]', KelurahanController::class . ':list')->add(PermissionMiddleware::class)->setName('KelurahanList-kelurahan-list'); // list
    $app->any('/KelurahanAdd[/{kd_kel}]', KelurahanController::class . ':add')->add(PermissionMiddleware::class)->setName('KelurahanAdd-kelurahan-add'); // add
    $app->any('/KelurahanView[/{kd_kel}]', KelurahanController::class . ':view')->add(PermissionMiddleware::class)->setName('KelurahanView-kelurahan-view'); // view
    $app->any('/KelurahanEdit[/{kd_kel}]', KelurahanController::class . ':edit')->add(PermissionMiddleware::class)->setName('KelurahanEdit-kelurahan-edit'); // edit
    $app->any('/KelurahanDelete[/{kd_kel}]', KelurahanController::class . ':delete')->add(PermissionMiddleware::class)->setName('KelurahanDelete-kelurahan-delete'); // delete
    $app->group(
        '/kelurahan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kd_kel}]', KelurahanController::class . ':list')->add(PermissionMiddleware::class)->setName('kelurahan/list-kelurahan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kd_kel}]', KelurahanController::class . ':add')->add(PermissionMiddleware::class)->setName('kelurahan/add-kelurahan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kd_kel}]', KelurahanController::class . ':view')->add(PermissionMiddleware::class)->setName('kelurahan/view-kelurahan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kd_kel}]', KelurahanController::class . ':edit')->add(PermissionMiddleware::class)->setName('kelurahan/edit-kelurahan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kd_kel}]', KelurahanController::class . ':delete')->add(PermissionMiddleware::class)->setName('kelurahan/delete-kelurahan-delete-2'); // delete
        }
    );

    // m_icd9
    $app->any('/MIcd9List[/{kode}]', MIcd9Controller::class . ':list')->add(PermissionMiddleware::class)->setName('MIcd9List-m_icd9-list'); // list
    $app->any('/MIcd9Add[/{kode}]', MIcd9Controller::class . ':add')->add(PermissionMiddleware::class)->setName('MIcd9Add-m_icd9-add'); // add
    $app->any('/MIcd9View[/{kode}]', MIcd9Controller::class . ':view')->add(PermissionMiddleware::class)->setName('MIcd9View-m_icd9-view'); // view
    $app->any('/MIcd9Edit[/{kode}]', MIcd9Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('MIcd9Edit-m_icd9-edit'); // edit
    $app->any('/MIcd9Delete[/{kode}]', MIcd9Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('MIcd9Delete-m_icd9-delete'); // delete
    $app->group(
        '/m_icd9',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kode}]', MIcd9Controller::class . ':list')->add(PermissionMiddleware::class)->setName('m_icd9/list-m_icd9-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kode}]', MIcd9Controller::class . ':add')->add(PermissionMiddleware::class)->setName('m_icd9/add-m_icd9-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kode}]', MIcd9Controller::class . ':view')->add(PermissionMiddleware::class)->setName('m_icd9/view-m_icd9-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kode}]', MIcd9Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('m_icd9/edit-m_icd9-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kode}]', MIcd9Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('m_icd9/delete-m_icd9-delete-2'); // delete
        }
    );

    // m_pasien
    $app->any('/MPasienList[/{id_pasien}]', MPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('MPasienList-m_pasien-list'); // list
    $app->any('/MPasienAdd[/{id_pasien}]', MPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('MPasienAdd-m_pasien-add'); // add
    $app->any('/MPasienView[/{id_pasien}]', MPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('MPasienView-m_pasien-view'); // view
    $app->any('/MPasienEdit[/{id_pasien}]', MPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('MPasienEdit-m_pasien-edit'); // edit
    $app->any('/MPasienDelete[/{id_pasien}]', MPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('MPasienDelete-m_pasien-delete'); // delete
    $app->group(
        '/m_pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pasien}]', MPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('m_pasien/list-m_pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pasien}]', MPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('m_pasien/add-m_pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pasien}]', MPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('m_pasien/view-m_pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pasien}]', MPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_pasien/edit-m_pasien-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_pasien}]', MPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_pasien/delete-m_pasien-delete-2'); // delete
        }
    );

    // m_penyakit
    $app->any('/MPenyakitList[/{kd_penyakit}]', MPenyakitController::class . ':list')->add(PermissionMiddleware::class)->setName('MPenyakitList-m_penyakit-list'); // list
    $app->any('/MPenyakitAdd[/{kd_penyakit}]', MPenyakitController::class . ':add')->add(PermissionMiddleware::class)->setName('MPenyakitAdd-m_penyakit-add'); // add
    $app->any('/MPenyakitView[/{kd_penyakit}]', MPenyakitController::class . ':view')->add(PermissionMiddleware::class)->setName('MPenyakitView-m_penyakit-view'); // view
    $app->any('/MPenyakitEdit[/{kd_penyakit}]', MPenyakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('MPenyakitEdit-m_penyakit-edit'); // edit
    $app->any('/MPenyakitDelete[/{kd_penyakit}]', MPenyakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('MPenyakitDelete-m_penyakit-delete'); // delete
    $app->group(
        '/m_penyakit',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kd_penyakit}]', MPenyakitController::class . ':list')->add(PermissionMiddleware::class)->setName('m_penyakit/list-m_penyakit-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kd_penyakit}]', MPenyakitController::class . ':add')->add(PermissionMiddleware::class)->setName('m_penyakit/add-m_penyakit-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kd_penyakit}]', MPenyakitController::class . ':view')->add(PermissionMiddleware::class)->setName('m_penyakit/view-m_penyakit-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kd_penyakit}]', MPenyakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_penyakit/edit-m_penyakit-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kd_penyakit}]', MPenyakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_penyakit/delete-m_penyakit-delete-2'); // delete
        }
    );

    // pemeriksaan_ralan
    $app->any('/PemeriksaanRalanList[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':list')->add(PermissionMiddleware::class)->setName('PemeriksaanRalanList-pemeriksaan_ralan-list'); // list
    $app->any('/PemeriksaanRalanAdd[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':add')->add(PermissionMiddleware::class)->setName('PemeriksaanRalanAdd-pemeriksaan_ralan-add'); // add
    $app->any('/PemeriksaanRalanView[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':view')->add(PermissionMiddleware::class)->setName('PemeriksaanRalanView-pemeriksaan_ralan-view'); // view
    $app->any('/PemeriksaanRalanEdit[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('PemeriksaanRalanEdit-pemeriksaan_ralan-edit'); // edit
    $app->any('/PemeriksaanRalanPreview', PemeriksaanRalanController::class . ':preview')->add(PermissionMiddleware::class)->setName('PemeriksaanRalanPreview-pemeriksaan_ralan-preview'); // preview
    $app->group(
        '/pemeriksaan_ralan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':list')->add(PermissionMiddleware::class)->setName('pemeriksaan_ralan/list-pemeriksaan_ralan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':add')->add(PermissionMiddleware::class)->setName('pemeriksaan_ralan/add-pemeriksaan_ralan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':view')->add(PermissionMiddleware::class)->setName('pemeriksaan_ralan/view-pemeriksaan_ralan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pemeriksaan_ralan}]', PemeriksaanRalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('pemeriksaan_ralan/edit-pemeriksaan_ralan-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', PemeriksaanRalanController::class . ':preview')->add(PermissionMiddleware::class)->setName('pemeriksaan_ralan/preview-pemeriksaan_ralan-preview-2'); // preview
        }
    );

    // penjab
    $app->any('/PenjabList[/{kd_pj}]', PenjabController::class . ':list')->add(PermissionMiddleware::class)->setName('PenjabList-penjab-list'); // list
    $app->any('/PenjabAdd[/{kd_pj}]', PenjabController::class . ':add')->add(PermissionMiddleware::class)->setName('PenjabAdd-penjab-add'); // add
    $app->any('/PenjabView[/{kd_pj}]', PenjabController::class . ':view')->add(PermissionMiddleware::class)->setName('PenjabView-penjab-view'); // view
    $app->any('/PenjabEdit[/{kd_pj}]', PenjabController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenjabEdit-penjab-edit'); // edit
    $app->any('/PenjabDelete[/{kd_pj}]', PenjabController::class . ':delete')->add(PermissionMiddleware::class)->setName('PenjabDelete-penjab-delete'); // delete
    $app->group(
        '/penjab',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kd_pj}]', PenjabController::class . ':list')->add(PermissionMiddleware::class)->setName('penjab/list-penjab-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kd_pj}]', PenjabController::class . ':add')->add(PermissionMiddleware::class)->setName('penjab/add-penjab-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kd_pj}]', PenjabController::class . ':view')->add(PermissionMiddleware::class)->setName('penjab/view-penjab-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kd_pj}]', PenjabController::class . ':edit')->add(PermissionMiddleware::class)->setName('penjab/edit-penjab-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kd_pj}]', PenjabController::class . ':delete')->add(PermissionMiddleware::class)->setName('penjab/delete-penjab-delete-2'); // delete
        }
    );

    // perusahaan_pasien
    $app->any('/PerusahaanPasienList[/{kode_perusahaan}]', PerusahaanPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('PerusahaanPasienList-perusahaan_pasien-list'); // list
    $app->any('/PerusahaanPasienAdd[/{kode_perusahaan}]', PerusahaanPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('PerusahaanPasienAdd-perusahaan_pasien-add'); // add
    $app->any('/PerusahaanPasienView[/{kode_perusahaan}]', PerusahaanPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('PerusahaanPasienView-perusahaan_pasien-view'); // view
    $app->any('/PerusahaanPasienEdit[/{kode_perusahaan}]', PerusahaanPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerusahaanPasienEdit-perusahaan_pasien-edit'); // edit
    $app->any('/PerusahaanPasienDelete[/{kode_perusahaan}]', PerusahaanPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerusahaanPasienDelete-perusahaan_pasien-delete'); // delete
    $app->group(
        '/perusahaan_pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kode_perusahaan}]', PerusahaanPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('perusahaan_pasien/list-perusahaan_pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kode_perusahaan}]', PerusahaanPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('perusahaan_pasien/add-perusahaan_pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kode_perusahaan}]', PerusahaanPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('perusahaan_pasien/view-perusahaan_pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kode_perusahaan}]', PerusahaanPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('perusahaan_pasien/edit-perusahaan_pasien-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kode_perusahaan}]', PerusahaanPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('perusahaan_pasien/delete-perusahaan_pasien-delete-2'); // delete
        }
    );

    // propinsi
    $app->any('/PropinsiList[/{kd_prop}]', PropinsiController::class . ':list')->add(PermissionMiddleware::class)->setName('PropinsiList-propinsi-list'); // list
    $app->any('/PropinsiAdd[/{kd_prop}]', PropinsiController::class . ':add')->add(PermissionMiddleware::class)->setName('PropinsiAdd-propinsi-add'); // add
    $app->any('/PropinsiView[/{kd_prop}]', PropinsiController::class . ':view')->add(PermissionMiddleware::class)->setName('PropinsiView-propinsi-view'); // view
    $app->any('/PropinsiEdit[/{kd_prop}]', PropinsiController::class . ':edit')->add(PermissionMiddleware::class)->setName('PropinsiEdit-propinsi-edit'); // edit
    $app->any('/PropinsiDelete[/{kd_prop}]', PropinsiController::class . ':delete')->add(PermissionMiddleware::class)->setName('PropinsiDelete-propinsi-delete'); // delete
    $app->group(
        '/propinsi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kd_prop}]', PropinsiController::class . ':list')->add(PermissionMiddleware::class)->setName('propinsi/list-propinsi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kd_prop}]', PropinsiController::class . ':add')->add(PermissionMiddleware::class)->setName('propinsi/add-propinsi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kd_prop}]', PropinsiController::class . ':view')->add(PermissionMiddleware::class)->setName('propinsi/view-propinsi-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kd_prop}]', PropinsiController::class . ':edit')->add(PermissionMiddleware::class)->setName('propinsi/edit-propinsi-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kd_prop}]', PropinsiController::class . ':delete')->add(PermissionMiddleware::class)->setName('propinsi/delete-propinsi-delete-2'); // delete
        }
    );

    // suku_bangsa
    $app->any('/SukuBangsaList[/{id}]', SukuBangsaController::class . ':list')->add(PermissionMiddleware::class)->setName('SukuBangsaList-suku_bangsa-list'); // list
    $app->any('/SukuBangsaAdd[/{id}]', SukuBangsaController::class . ':add')->add(PermissionMiddleware::class)->setName('SukuBangsaAdd-suku_bangsa-add'); // add
    $app->any('/SukuBangsaView[/{id}]', SukuBangsaController::class . ':view')->add(PermissionMiddleware::class)->setName('SukuBangsaView-suku_bangsa-view'); // view
    $app->any('/SukuBangsaEdit[/{id}]', SukuBangsaController::class . ':edit')->add(PermissionMiddleware::class)->setName('SukuBangsaEdit-suku_bangsa-edit'); // edit
    $app->any('/SukuBangsaDelete[/{id}]', SukuBangsaController::class . ':delete')->add(PermissionMiddleware::class)->setName('SukuBangsaDelete-suku_bangsa-delete'); // delete
    $app->group(
        '/suku_bangsa',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', SukuBangsaController::class . ':list')->add(PermissionMiddleware::class)->setName('suku_bangsa/list-suku_bangsa-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', SukuBangsaController::class . ':add')->add(PermissionMiddleware::class)->setName('suku_bangsa/add-suku_bangsa-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', SukuBangsaController::class . ':view')->add(PermissionMiddleware::class)->setName('suku_bangsa/view-suku_bangsa-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', SukuBangsaController::class . ':edit')->add(PermissionMiddleware::class)->setName('suku_bangsa/edit-suku_bangsa-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', SukuBangsaController::class . ':delete')->add(PermissionMiddleware::class)->setName('suku_bangsa/delete-suku_bangsa-delete-2'); // delete
        }
    );

    // userlogin
    $app->any('/UserloginList[/{id}]', UserloginController::class . ':list')->add(PermissionMiddleware::class)->setName('UserloginList-userlogin-list'); // list
    $app->any('/UserloginAdd[/{id}]', UserloginController::class . ':add')->add(PermissionMiddleware::class)->setName('UserloginAdd-userlogin-add'); // add
    $app->any('/UserloginView[/{id}]', UserloginController::class . ':view')->add(PermissionMiddleware::class)->setName('UserloginView-userlogin-view'); // view
    $app->any('/UserloginEdit[/{id}]', UserloginController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserloginEdit-userlogin-edit'); // edit
    $app->any('/UserloginDelete[/{id}]', UserloginController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserloginDelete-userlogin-delete'); // delete
    $app->group(
        '/userlogin',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', UserloginController::class . ':list')->add(PermissionMiddleware::class)->setName('userlogin/list-userlogin-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', UserloginController::class . ':add')->add(PermissionMiddleware::class)->setName('userlogin/add-userlogin-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', UserloginController::class . ':view')->add(PermissionMiddleware::class)->setName('userlogin/view-userlogin-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', UserloginController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlogin/edit-userlogin-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', UserloginController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlogin/delete-userlogin-delete-2'); // delete
        }
    );

    // userlevels
    $app->any('/UserlevelsList[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelsList-userlevels-list'); // list
    $app->any('/UserlevelsAdd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelsAdd-userlevels-add'); // add
    $app->any('/UserlevelsView[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelsView-userlevels-view'); // view
    $app->any('/UserlevelsEdit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelsEdit-userlevels-edit'); // edit
    $app->any('/UserlevelsDelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelsDelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->any('/UserlevelpermissionsList[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsList-userlevelpermissions-list'); // list
    $app->any('/UserlevelpermissionsAdd[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsAdd-userlevelpermissions-add'); // add
    $app->any('/UserlevelpermissionsView[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsView-userlevelpermissions-view'); // view
    $app->any('/UserlevelpermissionsEdit[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsEdit-userlevelpermissions-edit'); // edit
    $app->any('/UserlevelpermissionsDelete[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsDelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // nota_jalan
    $app->any('/NotaJalanList[/{no_rawat}]', NotaJalanController::class . ':list')->add(PermissionMiddleware::class)->setName('NotaJalanList-nota_jalan-list'); // list
    $app->any('/NotaJalanAdd[/{no_rawat}]', NotaJalanController::class . ':add')->add(PermissionMiddleware::class)->setName('NotaJalanAdd-nota_jalan-add'); // add
    $app->any('/NotaJalanView[/{no_rawat}]', NotaJalanController::class . ':view')->add(PermissionMiddleware::class)->setName('NotaJalanView-nota_jalan-view'); // view
    $app->any('/NotaJalanEdit[/{no_rawat}]', NotaJalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('NotaJalanEdit-nota_jalan-edit'); // edit
    $app->any('/NotaJalanDelete[/{no_rawat}]', NotaJalanController::class . ':delete')->add(PermissionMiddleware::class)->setName('NotaJalanDelete-nota_jalan-delete'); // delete
    $app->group(
        '/nota_jalan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{no_rawat}]', NotaJalanController::class . ':list')->add(PermissionMiddleware::class)->setName('nota_jalan/list-nota_jalan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{no_rawat}]', NotaJalanController::class . ':add')->add(PermissionMiddleware::class)->setName('nota_jalan/add-nota_jalan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{no_rawat}]', NotaJalanController::class . ':view')->add(PermissionMiddleware::class)->setName('nota_jalan/view-nota_jalan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{no_rawat}]', NotaJalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('nota_jalan/edit-nota_jalan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{no_rawat}]', NotaJalanController::class . ':delete')->add(PermissionMiddleware::class)->setName('nota_jalan/delete-nota_jalan-delete-2'); // delete
        }
    );

    // penilaian_awal_keperawatan_ralan
    $app->any('/PenilaianAwalKeperawatanRalanList[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':list')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanList-penilaian_awal_keperawatan_ralan-list'); // list
    $app->any('/PenilaianAwalKeperawatanRalanAdd[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':add')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanAdd-penilaian_awal_keperawatan_ralan-add'); // add
    $app->any('/PenilaianAwalKeperawatanRalanView[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':view')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanView-penilaian_awal_keperawatan_ralan-view'); // view
    $app->any('/PenilaianAwalKeperawatanRalanEdit[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanEdit-penilaian_awal_keperawatan_ralan-edit'); // edit
    $app->any('/PenilaianAwalKeperawatanRalanPreview', PenilaianAwalKeperawatanRalanController::class . ':preview')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanPreview-penilaian_awal_keperawatan_ralan-preview'); // preview
    $app->group(
        '/penilaian_awal_keperawatan_ralan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':list')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan/list-penilaian_awal_keperawatan_ralan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':add')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan/add-penilaian_awal_keperawatan_ralan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':view')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan/view-penilaian_awal_keperawatan_ralan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_penilaian_awal_keperawatan}]', PenilaianAwalKeperawatanRalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan/edit-penilaian_awal_keperawatan_ralan-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', PenilaianAwalKeperawatanRalanController::class . ':preview')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan/preview-penilaian_awal_keperawatan_ralan-preview-2'); // preview
        }
    );

    // penilaian_medis_ralan
    $app->any('/PenilaianMedisRalanList[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':list')->add(PermissionMiddleware::class)->setName('PenilaianMedisRalanList-penilaian_medis_ralan-list'); // list
    $app->any('/PenilaianMedisRalanAdd[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':add')->add(PermissionMiddleware::class)->setName('PenilaianMedisRalanAdd-penilaian_medis_ralan-add'); // add
    $app->any('/PenilaianMedisRalanView[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':view')->add(PermissionMiddleware::class)->setName('PenilaianMedisRalanView-penilaian_medis_ralan-view'); // view
    $app->any('/PenilaianMedisRalanEdit[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenilaianMedisRalanEdit-penilaian_medis_ralan-edit'); // edit
    $app->any('/PenilaianMedisRalanPreview', PenilaianMedisRalanController::class . ':preview')->add(PermissionMiddleware::class)->setName('PenilaianMedisRalanPreview-penilaian_medis_ralan-preview'); // preview
    $app->group(
        '/penilaian_medis_ralan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':list')->add(PermissionMiddleware::class)->setName('penilaian_medis_ralan/list-penilaian_medis_ralan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':add')->add(PermissionMiddleware::class)->setName('penilaian_medis_ralan/add-penilaian_medis_ralan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':view')->add(PermissionMiddleware::class)->setName('penilaian_medis_ralan/view-penilaian_medis_ralan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_penilaian_medis_ralan}]', PenilaianMedisRalanController::class . ':edit')->add(PermissionMiddleware::class)->setName('penilaian_medis_ralan/edit-penilaian_medis_ralan-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', PenilaianMedisRalanController::class . ':preview')->add(PermissionMiddleware::class)->setName('penilaian_medis_ralan/preview-penilaian_medis_ralan-preview-2'); // preview
        }
    );

    // master_pasien
    $app->any('/MasterPasienList[/{id_pasien}]', MasterPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('MasterPasienList-master_pasien-list'); // list
    $app->any('/MasterPasienAdd[/{id_pasien}]', MasterPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('MasterPasienAdd-master_pasien-add'); // add
    $app->any('/MasterPasienView[/{id_pasien}]', MasterPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('MasterPasienView-master_pasien-view'); // view
    $app->any('/MasterPasienEdit[/{id_pasien}]', MasterPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('MasterPasienEdit-master_pasien-edit'); // edit
    $app->any('/MasterPasienDelete[/{id_pasien}]', MasterPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('MasterPasienDelete-master_pasien-delete'); // delete
    $app->group(
        '/master_pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pasien}]', MasterPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('master_pasien/list-master_pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pasien}]', MasterPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('master_pasien/add-master_pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pasien}]', MasterPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('master_pasien/view-master_pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pasien}]', MasterPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('master_pasien/edit-master_pasien-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_pasien}]', MasterPasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('master_pasien/delete-master_pasien-delete-2'); // delete
        }
    );

    // agama
    $app->any('/AgamaList[/{id_agama}]', AgamaController::class . ':list')->add(PermissionMiddleware::class)->setName('AgamaList-agama-list'); // list
    $app->any('/AgamaAdd[/{id_agama}]', AgamaController::class . ':add')->add(PermissionMiddleware::class)->setName('AgamaAdd-agama-add'); // add
    $app->any('/AgamaView[/{id_agama}]', AgamaController::class . ':view')->add(PermissionMiddleware::class)->setName('AgamaView-agama-view'); // view
    $app->any('/AgamaEdit[/{id_agama}]', AgamaController::class . ':edit')->add(PermissionMiddleware::class)->setName('AgamaEdit-agama-edit'); // edit
    $app->any('/AgamaDelete[/{id_agama}]', AgamaController::class . ':delete')->add(PermissionMiddleware::class)->setName('AgamaDelete-agama-delete'); // delete
    $app->group(
        '/agama',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_agama}]', AgamaController::class . ':list')->add(PermissionMiddleware::class)->setName('agama/list-agama-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_agama}]', AgamaController::class . ':add')->add(PermissionMiddleware::class)->setName('agama/add-agama-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_agama}]', AgamaController::class . ':view')->add(PermissionMiddleware::class)->setName('agama/view-agama-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_agama}]', AgamaController::class . ':edit')->add(PermissionMiddleware::class)->setName('agama/edit-agama-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_agama}]', AgamaController::class . ':delete')->add(PermissionMiddleware::class)->setName('agama/delete-agama-delete-2'); // delete
        }
    );

    // catatan_medis
    $app->any('/CatatanMedisList[/{id_catatan_medis}]', CatatanMedisController::class . ':list')->add(PermissionMiddleware::class)->setName('CatatanMedisList-catatan_medis-list'); // list
    $app->any('/CatatanMedisAdd[/{id_catatan_medis}]', CatatanMedisController::class . ':add')->add(PermissionMiddleware::class)->setName('CatatanMedisAdd-catatan_medis-add'); // add
    $app->any('/CatatanMedisView[/{id_catatan_medis}]', CatatanMedisController::class . ':view')->add(PermissionMiddleware::class)->setName('CatatanMedisView-catatan_medis-view'); // view
    $app->any('/CatatanMedisEdit[/{id_catatan_medis}]', CatatanMedisController::class . ':edit')->add(PermissionMiddleware::class)->setName('CatatanMedisEdit-catatan_medis-edit'); // edit
    $app->any('/CatatanMedisPreview', CatatanMedisController::class . ':preview')->add(PermissionMiddleware::class)->setName('CatatanMedisPreview-catatan_medis-preview'); // preview
    $app->group(
        '/catatan_medis',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_catatan_medis}]', CatatanMedisController::class . ':list')->add(PermissionMiddleware::class)->setName('catatan_medis/list-catatan_medis-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_catatan_medis}]', CatatanMedisController::class . ':add')->add(PermissionMiddleware::class)->setName('catatan_medis/add-catatan_medis-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_catatan_medis}]', CatatanMedisController::class . ':view')->add(PermissionMiddleware::class)->setName('catatan_medis/view-catatan_medis-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_catatan_medis}]', CatatanMedisController::class . ':edit')->add(PermissionMiddleware::class)->setName('catatan_medis/edit-catatan_medis-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', CatatanMedisController::class . ':preview')->add(PermissionMiddleware::class)->setName('catatan_medis/preview-catatan_medis-preview-2'); // preview
        }
    );

    // pasien_kunjungan
    $app->any('/PasienKunjunganList[/{id_reg}]', PasienKunjunganController::class . ':list')->add(PermissionMiddleware::class)->setName('PasienKunjunganList-pasien_kunjungan-list'); // list
    $app->any('/PasienKunjunganView[/{id_reg}]', PasienKunjunganController::class . ':view')->add(PermissionMiddleware::class)->setName('PasienKunjunganView-pasien_kunjungan-view'); // view
    $app->any('/PasienKunjunganPreview', PasienKunjunganController::class . ':preview')->add(PermissionMiddleware::class)->setName('PasienKunjunganPreview-pasien_kunjungan-preview'); // preview
    $app->group(
        '/pasien_kunjungan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_reg}]', PasienKunjunganController::class . ':list')->add(PermissionMiddleware::class)->setName('pasien_kunjungan/list-pasien_kunjungan-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_reg}]', PasienKunjunganController::class . ':view')->add(PermissionMiddleware::class)->setName('pasien_kunjungan/view-pasien_kunjungan-view-2'); // view
            $group->any('/' . Config("PREVIEW_ACTION") . '', PasienKunjunganController::class . ':preview')->add(PermissionMiddleware::class)->setName('pasien_kunjungan/preview-pasien_kunjungan-preview-2'); // preview
        }
    );

    // Dashboard2
    $app->any('/Dashboard2', Dashboard2Controller::class)->add(PermissionMiddleware::class)->setName('Dashboard2-Dashboard2-dashboard'); // dashboard

    // Jml_Pasien
    $app->any('/JmlPasienList', JmlPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('JmlPasienList-Jml_Pasien-list'); // list
    $app->group(
        '/Jml_Pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', JmlPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('Jml_Pasien/list-Jml_Pasien-list-2'); // list
        }
    );

    // Report1
    $app->any('/Report1', Report1Controller::class)->add(PermissionMiddleware::class)->setName('Report1-Report1-summary'); // summary

    // reg_periksa
    $app->any('/RegPeriksaList[/{no_rawat}]', RegPeriksaController::class . ':list')->add(PermissionMiddleware::class)->setName('RegPeriksaList-reg_periksa-list'); // list
    $app->any('/RegPeriksaAdd[/{no_rawat}]', RegPeriksaController::class . ':add')->add(PermissionMiddleware::class)->setName('RegPeriksaAdd-reg_periksa-add'); // add
    $app->any('/RegPeriksaView[/{no_rawat}]', RegPeriksaController::class . ':view')->add(PermissionMiddleware::class)->setName('RegPeriksaView-reg_periksa-view'); // view
    $app->any('/RegPeriksaEdit[/{no_rawat}]', RegPeriksaController::class . ':edit')->add(PermissionMiddleware::class)->setName('RegPeriksaEdit-reg_periksa-edit'); // edit
    $app->any('/RegPeriksaDelete[/{no_rawat}]', RegPeriksaController::class . ':delete')->add(PermissionMiddleware::class)->setName('RegPeriksaDelete-reg_periksa-delete'); // delete
    $app->group(
        '/reg_periksa',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{no_rawat}]', RegPeriksaController::class . ':list')->add(PermissionMiddleware::class)->setName('reg_periksa/list-reg_periksa-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{no_rawat}]', RegPeriksaController::class . ':add')->add(PermissionMiddleware::class)->setName('reg_periksa/add-reg_periksa-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{no_rawat}]', RegPeriksaController::class . ':view')->add(PermissionMiddleware::class)->setName('reg_periksa/view-reg_periksa-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{no_rawat}]', RegPeriksaController::class . ':edit')->add(PermissionMiddleware::class)->setName('reg_periksa/edit-reg_periksa-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{no_rawat}]', RegPeriksaController::class . ':delete')->add(PermissionMiddleware::class)->setName('reg_periksa/delete-reg_periksa-delete-2'); // delete
        }
    );

    // pasien
    $app->any('/PasienList[/{id_pasien}]', PasienController::class . ':list')->add(PermissionMiddleware::class)->setName('PasienList-pasien-list'); // list
    $app->any('/PasienAdd[/{id_pasien}]', PasienController::class . ':add')->add(PermissionMiddleware::class)->setName('PasienAdd-pasien-add'); // add
    $app->any('/PasienView[/{id_pasien}]', PasienController::class . ':view')->add(PermissionMiddleware::class)->setName('PasienView-pasien-view'); // view
    $app->any('/PasienEdit[/{id_pasien}]', PasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('PasienEdit-pasien-edit'); // edit
    $app->any('/PasienDelete[/{id_pasien}]', PasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('PasienDelete-pasien-delete'); // delete
    $app->group(
        '/pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pasien}]', PasienController::class . ':list')->add(PermissionMiddleware::class)->setName('pasien/list-pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pasien}]', PasienController::class . ':add')->add(PermissionMiddleware::class)->setName('pasien/add-pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pasien}]', PasienController::class . ':view')->add(PermissionMiddleware::class)->setName('pasien/view-pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pasien}]', PasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('pasien/edit-pasien-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_pasien}]', PasienController::class . ':delete')->add(PermissionMiddleware::class)->setName('pasien/delete-pasien-delete-2'); // delete
        }
    );

    // vrajal
    $app->any('/VrajalList[/{id_reg}]', VrajalController::class . ':list')->add(PermissionMiddleware::class)->setName('VrajalList-vrajal-list'); // list
    $app->any('/VrajalAdd[/{id_reg}]', VrajalController::class . ':add')->add(PermissionMiddleware::class)->setName('VrajalAdd-vrajal-add'); // add
    $app->any('/VrajalView[/{id_reg}]', VrajalController::class . ':view')->add(PermissionMiddleware::class)->setName('VrajalView-vrajal-view'); // view
    $app->any('/VrajalEdit[/{id_reg}]', VrajalController::class . ':edit')->add(PermissionMiddleware::class)->setName('VrajalEdit-vrajal-edit'); // edit
    $app->group(
        '/vrajal',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_reg}]', VrajalController::class . ':list')->add(PermissionMiddleware::class)->setName('vrajal/list-vrajal-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_reg}]', VrajalController::class . ':add')->add(PermissionMiddleware::class)->setName('vrajal/add-vrajal-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_reg}]', VrajalController::class . ':view')->add(PermissionMiddleware::class)->setName('vrajal/view-vrajal-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_reg}]', VrajalController::class . ':edit')->add(PermissionMiddleware::class)->setName('vrajal/edit-vrajal-edit-2'); // edit
        }
    );

    // vriwayat
    $app->any('/VriwayatList', VriwayatController::class . ':list')->add(PermissionMiddleware::class)->setName('VriwayatList-vriwayat-list'); // list
    $app->group(
        '/vriwayat',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VriwayatController::class . ':list')->add(PermissionMiddleware::class)->setName('vriwayat/list-vriwayat-list-2'); // list
        }
    );

    // catatan_perawatan
    $app->any('/CatatanPerawatanList', CatatanPerawatanController::class . ':list')->add(PermissionMiddleware::class)->setName('CatatanPerawatanList-catatan_perawatan-list'); // list
    $app->any('/CatatanPerawatanAdd', CatatanPerawatanController::class . ':add')->add(PermissionMiddleware::class)->setName('CatatanPerawatanAdd-catatan_perawatan-add'); // add
    $app->group(
        '/catatan_perawatan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', CatatanPerawatanController::class . ':list')->add(PermissionMiddleware::class)->setName('catatan_perawatan/list-catatan_perawatan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '', CatatanPerawatanController::class . ':add')->add(PermissionMiddleware::class)->setName('catatan_perawatan/add-catatan_perawatan-add-2'); // add
        }
    );

    // penilaian_medis_igd
    $app->any('/PenilaianMedisIgdList[/{id_penilaian_medis_igd}]', PenilaianMedisIgdController::class . ':list')->add(PermissionMiddleware::class)->setName('PenilaianMedisIgdList-penilaian_medis_igd-list'); // list
    $app->any('/PenilaianMedisIgdAdd[/{id_penilaian_medis_igd}]', PenilaianMedisIgdController::class . ':add')->add(PermissionMiddleware::class)->setName('PenilaianMedisIgdAdd-penilaian_medis_igd-add'); // add
    $app->any('/PenilaianMedisIgdView[/{id_penilaian_medis_igd}]', PenilaianMedisIgdController::class . ':view')->add(PermissionMiddleware::class)->setName('PenilaianMedisIgdView-penilaian_medis_igd-view'); // view
    $app->group(
        '/penilaian_medis_igd',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_penilaian_medis_igd}]', PenilaianMedisIgdController::class . ':list')->add(PermissionMiddleware::class)->setName('penilaian_medis_igd/list-penilaian_medis_igd-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_penilaian_medis_igd}]', PenilaianMedisIgdController::class . ':add')->add(PermissionMiddleware::class)->setName('penilaian_medis_igd/add-penilaian_medis_igd-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_penilaian_medis_igd}]', PenilaianMedisIgdController::class . ':view')->add(PermissionMiddleware::class)->setName('penilaian_medis_igd/view-penilaian_medis_igd-view-2'); // view
        }
    );

    // poliklinik
    $app->any('/PoliklinikList[/{kd_poli}]', PoliklinikController::class . ':list')->add(PermissionMiddleware::class)->setName('PoliklinikList-poliklinik-list'); // list
    $app->any('/PoliklinikAdd[/{kd_poli}]', PoliklinikController::class . ':add')->add(PermissionMiddleware::class)->setName('PoliklinikAdd-poliklinik-add'); // add
    $app->any('/PoliklinikView[/{kd_poli}]', PoliklinikController::class . ':view')->add(PermissionMiddleware::class)->setName('PoliklinikView-poliklinik-view'); // view
    $app->any('/PoliklinikEdit[/{kd_poli}]', PoliklinikController::class . ':edit')->add(PermissionMiddleware::class)->setName('PoliklinikEdit-poliklinik-edit'); // edit
    $app->any('/PoliklinikDelete[/{kd_poli}]', PoliklinikController::class . ':delete')->add(PermissionMiddleware::class)->setName('PoliklinikDelete-poliklinik-delete'); // delete
    $app->group(
        '/poliklinik',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kd_poli}]', PoliklinikController::class . ':list')->add(PermissionMiddleware::class)->setName('poliklinik/list-poliklinik-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kd_poli}]', PoliklinikController::class . ':add')->add(PermissionMiddleware::class)->setName('poliklinik/add-poliklinik-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kd_poli}]', PoliklinikController::class . ':view')->add(PermissionMiddleware::class)->setName('poliklinik/view-poliklinik-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kd_poli}]', PoliklinikController::class . ':edit')->add(PermissionMiddleware::class)->setName('poliklinik/edit-poliklinik-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kd_poli}]', PoliklinikController::class . ':delete')->add(PermissionMiddleware::class)->setName('poliklinik/delete-poliklinik-delete-2'); // delete
        }
    );

    // penilaian_awal_keperawatan_ralan_psikiatri
    $app->any('/PenilaianAwalKeperawatanRalanPsikiatriList[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':list')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanPsikiatriList-penilaian_awal_keperawatan_ralan_psikiatri-list'); // list
    $app->any('/PenilaianAwalKeperawatanRalanPsikiatriAdd[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':add')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanPsikiatriAdd-penilaian_awal_keperawatan_ralan_psikiatri-add'); // add
    $app->any('/PenilaianAwalKeperawatanRalanPsikiatriView[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':view')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanPsikiatriView-penilaian_awal_keperawatan_ralan_psikiatri-view'); // view
    $app->any('/PenilaianAwalKeperawatanRalanPsikiatriEdit[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanPsikiatriEdit-penilaian_awal_keperawatan_ralan_psikiatri-edit'); // edit
    $app->any('/PenilaianAwalKeperawatanRalanPsikiatriPreview', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':preview')->add(PermissionMiddleware::class)->setName('PenilaianAwalKeperawatanRalanPsikiatriPreview-penilaian_awal_keperawatan_ralan_psikiatri-preview'); // preview
    $app->group(
        '/penilaian_awal_keperawatan_ralan_psikiatri',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':list')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan_psikiatri/list-penilaian_awal_keperawatan_ralan_psikiatri-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':add')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan_psikiatri/add-penilaian_awal_keperawatan_ralan_psikiatri-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':view')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan_psikiatri/view-penilaian_awal_keperawatan_ralan_psikiatri-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_penilaian_awal_keperawatan_ralan_psikiatri}]', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':edit')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan_psikiatri/edit-penilaian_awal_keperawatan_ralan_psikiatri-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', PenilaianAwalKeperawatanRalanPsikiatriController::class . ':preview')->add(PermissionMiddleware::class)->setName('penilaian_awal_keperawatan_ralan_psikiatri/preview-penilaian_awal_keperawatan_ralan_psikiatri-preview-2'); // preview
        }
    );

    // penilaian_psikologi
    $app->any('/PenilaianPsikologiList[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':list')->add(PermissionMiddleware::class)->setName('PenilaianPsikologiList-penilaian_psikologi-list'); // list
    $app->any('/PenilaianPsikologiAdd[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':add')->add(PermissionMiddleware::class)->setName('PenilaianPsikologiAdd-penilaian_psikologi-add'); // add
    $app->any('/PenilaianPsikologiView[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':view')->add(PermissionMiddleware::class)->setName('PenilaianPsikologiView-penilaian_psikologi-view'); // view
    $app->any('/PenilaianPsikologiEdit[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenilaianPsikologiEdit-penilaian_psikologi-edit'); // edit
    $app->any('/PenilaianPsikologiPreview', PenilaianPsikologiController::class . ':preview')->add(PermissionMiddleware::class)->setName('PenilaianPsikologiPreview-penilaian_psikologi-preview'); // preview
    $app->group(
        '/penilaian_psikologi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':list')->add(PermissionMiddleware::class)->setName('penilaian_psikologi/list-penilaian_psikologi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':add')->add(PermissionMiddleware::class)->setName('penilaian_psikologi/add-penilaian_psikologi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':view')->add(PermissionMiddleware::class)->setName('penilaian_psikologi/view-penilaian_psikologi-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_penilaian_psikologi}]', PenilaianPsikologiController::class . ':edit')->add(PermissionMiddleware::class)->setName('penilaian_psikologi/edit-penilaian_psikologi-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', PenilaianPsikologiController::class . ':preview')->add(PermissionMiddleware::class)->setName('penilaian_psikologi/preview-penilaian_psikologi-preview-2'); // preview
        }
    );

    // diagnosa_pasien
    $app->any('/DiagnosaPasienList[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('DiagnosaPasienList-diagnosa_pasien-list'); // list
    $app->any('/DiagnosaPasienAdd[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('DiagnosaPasienAdd-diagnosa_pasien-add'); // add
    $app->any('/DiagnosaPasienView[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('DiagnosaPasienView-diagnosa_pasien-view'); // view
    $app->any('/DiagnosaPasienEdit[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('DiagnosaPasienEdit-diagnosa_pasien-edit'); // edit
    $app->any('/DiagnosaPasienPreview', DiagnosaPasienController::class . ':preview')->add(PermissionMiddleware::class)->setName('DiagnosaPasienPreview-diagnosa_pasien-preview'); // preview
    $app->group(
        '/diagnosa_pasien',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':list')->add(PermissionMiddleware::class)->setName('diagnosa_pasien/list-diagnosa_pasien-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':add')->add(PermissionMiddleware::class)->setName('diagnosa_pasien/add-diagnosa_pasien-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':view')->add(PermissionMiddleware::class)->setName('diagnosa_pasien/view-diagnosa_pasien-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_diagnosa_pasien}]', DiagnosaPasienController::class . ':edit')->add(PermissionMiddleware::class)->setName('diagnosa_pasien/edit-diagnosa_pasien-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', DiagnosaPasienController::class . ':preview')->add(PermissionMiddleware::class)->setName('diagnosa_pasien/preview-diagnosa_pasien-preview-2'); // preview
        }
    );

    // tindak_lanjut
    $app->any('/TindakLanjutList[/{id_tindak_lanjut}]', TindakLanjutController::class . ':list')->add(PermissionMiddleware::class)->setName('TindakLanjutList-tindak_lanjut-list'); // list
    $app->any('/TindakLanjutAdd[/{id_tindak_lanjut}]', TindakLanjutController::class . ':add')->add(PermissionMiddleware::class)->setName('TindakLanjutAdd-tindak_lanjut-add'); // add
    $app->any('/TindakLanjutView[/{id_tindak_lanjut}]', TindakLanjutController::class . ':view')->add(PermissionMiddleware::class)->setName('TindakLanjutView-tindak_lanjut-view'); // view
    $app->any('/TindakLanjutEdit[/{id_tindak_lanjut}]', TindakLanjutController::class . ':edit')->add(PermissionMiddleware::class)->setName('TindakLanjutEdit-tindak_lanjut-edit'); // edit
    $app->any('/TindakLanjutPreview', TindakLanjutController::class . ':preview')->add(PermissionMiddleware::class)->setName('TindakLanjutPreview-tindak_lanjut-preview'); // preview
    $app->group(
        '/tindak_lanjut',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_tindak_lanjut}]', TindakLanjutController::class . ':list')->add(PermissionMiddleware::class)->setName('tindak_lanjut/list-tindak_lanjut-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_tindak_lanjut}]', TindakLanjutController::class . ':add')->add(PermissionMiddleware::class)->setName('tindak_lanjut/add-tindak_lanjut-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_tindak_lanjut}]', TindakLanjutController::class . ':view')->add(PermissionMiddleware::class)->setName('tindak_lanjut/view-tindak_lanjut-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_tindak_lanjut}]', TindakLanjutController::class . ':edit')->add(PermissionMiddleware::class)->setName('tindak_lanjut/edit-tindak_lanjut-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', TindakLanjutController::class . ':preview')->add(PermissionMiddleware::class)->setName('tindak_lanjut/preview-tindak_lanjut-preview-2'); // preview
        }
    );

    // vigd
    $app->any('/VigdList[/{id_reg}]', VigdController::class . ':list')->add(PermissionMiddleware::class)->setName('VigdList-vigd-list'); // list
    $app->any('/VigdAdd[/{id_reg}]', VigdController::class . ':add')->add(PermissionMiddleware::class)->setName('VigdAdd-vigd-add'); // add
    $app->any('/VigdView[/{id_reg}]', VigdController::class . ':view')->add(PermissionMiddleware::class)->setName('VigdView-vigd-view'); // view
    $app->any('/VigdEdit[/{id_reg}]', VigdController::class . ':edit')->add(PermissionMiddleware::class)->setName('VigdEdit-vigd-edit'); // edit
    $app->group(
        '/vigd',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_reg}]', VigdController::class . ':list')->add(PermissionMiddleware::class)->setName('vigd/list-vigd-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_reg}]', VigdController::class . ':add')->add(PermissionMiddleware::class)->setName('vigd/add-vigd-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_reg}]', VigdController::class . ':view')->add(PermissionMiddleware::class)->setName('vigd/view-vigd-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_reg}]', VigdController::class . ':edit')->add(PermissionMiddleware::class)->setName('vigd/edit-vigd-edit-2'); // edit
        }
    );

    // konsul
    $app->any('/KonsulList[/{id_konsul}]', KonsulController::class . ':list')->add(PermissionMiddleware::class)->setName('KonsulList-konsul-list'); // list
    $app->any('/KonsulAdd[/{id_konsul}]', KonsulController::class . ':add')->add(PermissionMiddleware::class)->setName('KonsulAdd-konsul-add'); // add
    $app->any('/KonsulView[/{id_konsul}]', KonsulController::class . ':view')->add(PermissionMiddleware::class)->setName('KonsulView-konsul-view'); // view
    $app->any('/KonsulEdit[/{id_konsul}]', KonsulController::class . ':edit')->add(PermissionMiddleware::class)->setName('KonsulEdit-konsul-edit'); // edit
    $app->any('/KonsulPreview', KonsulController::class . ':preview')->add(PermissionMiddleware::class)->setName('KonsulPreview-konsul-preview'); // preview
    $app->group(
        '/konsul',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_konsul}]', KonsulController::class . ':list')->add(PermissionMiddleware::class)->setName('konsul/list-konsul-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_konsul}]', KonsulController::class . ':add')->add(PermissionMiddleware::class)->setName('konsul/add-konsul-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_konsul}]', KonsulController::class . ':view')->add(PermissionMiddleware::class)->setName('konsul/view-konsul-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_konsul}]', KonsulController::class . ':edit')->add(PermissionMiddleware::class)->setName('konsul/edit-konsul-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', KonsulController::class . ':preview')->add(PermissionMiddleware::class)->setName('konsul/preview-konsul-preview-2'); // preview
        }
    );

    // cppt
    $app->any('/CpptList[/{id_cppt}]', CpptController::class . ':list')->add(PermissionMiddleware::class)->setName('CpptList-cppt-list'); // list
    $app->any('/CpptAdd[/{id_cppt}]', CpptController::class . ':add')->add(PermissionMiddleware::class)->setName('CpptAdd-cppt-add'); // add
    $app->any('/CpptView[/{id_cppt}]', CpptController::class . ':view')->add(PermissionMiddleware::class)->setName('CpptView-cppt-view'); // view
    $app->any('/CpptEdit[/{id_cppt}]', CpptController::class . ':edit')->add(PermissionMiddleware::class)->setName('CpptEdit-cppt-edit'); // edit
    $app->any('/CpptPreview', CpptController::class . ':preview')->add(PermissionMiddleware::class)->setName('CpptPreview-cppt-preview'); // preview
    $app->group(
        '/cppt',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_cppt}]', CpptController::class . ':list')->add(PermissionMiddleware::class)->setName('cppt/list-cppt-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_cppt}]', CpptController::class . ':add')->add(PermissionMiddleware::class)->setName('cppt/add-cppt-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_cppt}]', CpptController::class . ':view')->add(PermissionMiddleware::class)->setName('cppt/view-cppt-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_cppt}]', CpptController::class . ':edit')->add(PermissionMiddleware::class)->setName('cppt/edit-cppt-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', CpptController::class . ':preview')->add(PermissionMiddleware::class)->setName('cppt/preview-cppt-preview-2'); // preview
        }
    );

    // billing
    $app->any('/BillingList[/{id_billing}]', BillingController::class . ':list')->add(PermissionMiddleware::class)->setName('BillingList-billing-list'); // list
    $app->any('/BillingAdd[/{id_billing}]', BillingController::class . ':add')->add(PermissionMiddleware::class)->setName('BillingAdd-billing-add'); // add
    $app->any('/BillingView[/{id_billing}]', BillingController::class . ':view')->add(PermissionMiddleware::class)->setName('BillingView-billing-view'); // view
    $app->any('/BillingEdit[/{id_billing}]', BillingController::class . ':edit')->add(PermissionMiddleware::class)->setName('BillingEdit-billing-edit'); // edit
    $app->any('/BillingPreview', BillingController::class . ':preview')->add(PermissionMiddleware::class)->setName('BillingPreview-billing-preview'); // preview
    $app->group(
        '/billing',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_billing}]', BillingController::class . ':list')->add(PermissionMiddleware::class)->setName('billing/list-billing-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_billing}]', BillingController::class . ':add')->add(PermissionMiddleware::class)->setName('billing/add-billing-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_billing}]', BillingController::class . ':view')->add(PermissionMiddleware::class)->setName('billing/view-billing-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_billing}]', BillingController::class . ':edit')->add(PermissionMiddleware::class)->setName('billing/edit-billing-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', BillingController::class . ':preview')->add(PermissionMiddleware::class)->setName('billing/preview-billing-preview-2'); // preview
        }
    );

    // resep_dokter
    $app->any('/ResepDokterList[/{id_resep_dokter}]', ResepDokterController::class . ':list')->add(PermissionMiddleware::class)->setName('ResepDokterList-resep_dokter-list'); // list
    $app->any('/ResepDokterAdd[/{id_resep_dokter}]', ResepDokterController::class . ':add')->add(PermissionMiddleware::class)->setName('ResepDokterAdd-resep_dokter-add'); // add
    $app->any('/ResepDokterView[/{id_resep_dokter}]', ResepDokterController::class . ':view')->add(PermissionMiddleware::class)->setName('ResepDokterView-resep_dokter-view'); // view
    $app->any('/ResepDokterEdit[/{id_resep_dokter}]', ResepDokterController::class . ':edit')->add(PermissionMiddleware::class)->setName('ResepDokterEdit-resep_dokter-edit'); // edit
    $app->any('/ResepDokterPreview', ResepDokterController::class . ':preview')->add(PermissionMiddleware::class)->setName('ResepDokterPreview-resep_dokter-preview'); // preview
    $app->group(
        '/resep_dokter',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_resep_dokter}]', ResepDokterController::class . ':list')->add(PermissionMiddleware::class)->setName('resep_dokter/list-resep_dokter-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_resep_dokter}]', ResepDokterController::class . ':add')->add(PermissionMiddleware::class)->setName('resep_dokter/add-resep_dokter-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_resep_dokter}]', ResepDokterController::class . ':view')->add(PermissionMiddleware::class)->setName('resep_dokter/view-resep_dokter-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_resep_dokter}]', ResepDokterController::class . ':edit')->add(PermissionMiddleware::class)->setName('resep_dokter/edit-resep_dokter-edit-2'); // edit
            $group->any('/' . Config("PREVIEW_ACTION") . '', ResepDokterController::class . ':preview')->add(PermissionMiddleware::class)->setName('resep_dokter/preview-resep_dokter-preview-2'); // preview
        }
    );

    // prmrj
    $app->any('/PrmrjList', PrmrjController::class . ':list')->add(PermissionMiddleware::class)->setName('PrmrjList-prmrj-list'); // list
    $app->any('/PrmrjPreview', PrmrjController::class . ':preview')->add(PermissionMiddleware::class)->setName('PrmrjPreview-prmrj-preview'); // preview
    $app->group(
        '/prmrj',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', PrmrjController::class . ':list')->add(PermissionMiddleware::class)->setName('prmrj/list-prmrj-list-2'); // list
            $group->any('/' . Config("PREVIEW_ACTION") . '', PrmrjController::class . ':preview')->add(PermissionMiddleware::class)->setName('prmrj/preview-prmrj-preview-2'); // preview
        }
    );

    // vhistory
    $app->any('/VhistoryList', VhistoryController::class . ':list')->add(PermissionMiddleware::class)->setName('VhistoryList-vhistory-list'); // list
    $app->any('/VhistoryPreview', VhistoryController::class . ':preview')->add(PermissionMiddleware::class)->setName('VhistoryPreview-vhistory-preview'); // preview
    $app->group(
        '/vhistory',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VhistoryController::class . ':list')->add(PermissionMiddleware::class)->setName('vhistory/list-vhistory-list-2'); // list
            $group->any('/' . Config("PREVIEW_ACTION") . '', VhistoryController::class . ':preview')->add(PermissionMiddleware::class)->setName('vhistory/preview-vhistory-preview-2'); // preview
        }
    );

    // laporan
    $app->any('/Laporan[/{params:.*}]', LaporanController::class)->add(PermissionMiddleware::class)->setName('Laporan-laporan-custom'); // custom

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // change_password
    $app->any('/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
