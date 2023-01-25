<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for master_pasien
 */
class MasterPasien extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id_pasien;
    public $nama_pasien;
    public $no_rekam_medis;
    public $nik;
    public $no_identitas_lain;
    public $nama_ibu;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $agama;
    public $suku;
    public $bahasa;
    public $alamat;
    public $rt;
    public $rw;
    public $keluarahan_desa;
    public $kecamatan;
    public $kabupaten_kota;
    public $kodepos;
    public $provinsi;
    public $negara;
    public $alamat_domisili;
    public $rt_domisili;
    public $rw_domisili;
    public $kel_desa_domisili;
    public $kec_domisili;
    public $kota_kab_domisili;
    public $kodepos_domisili;
    public $prov_domisili;
    public $negara_domisili;
    public $no_telp;
    public $no_hp;
    public $pendidikan;
    public $pekerjaan;
    public $status_kawin;
    public $tgl_daftar;
    public $_username;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'master_pasien';
        $this->TableName = 'master_pasien';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`master_pasien`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id_pasien
        $this->id_pasien = new DbField('master_pasien', 'master_pasien', 'x_id_pasien', 'id_pasien', '`id_pasien`', '`id_pasien`', 3, 11, -1, false, '`id_pasien`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_pasien->IsAutoIncrement = true; // Autoincrement field
        $this->id_pasien->IsPrimaryKey = true; // Primary key field
        $this->id_pasien->Sortable = true; // Allow sort
        $this->id_pasien->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_pasien->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_pasien->Param, "CustomMsg");
        $this->Fields['id_pasien'] = &$this->id_pasien;

        // nama_pasien
        $this->nama_pasien = new DbField('master_pasien', 'master_pasien', 'x_nama_pasien', 'nama_pasien', '`nama_pasien`', '`nama_pasien`', 200, 100, -1, false, '`nama_pasien`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_pasien->Sortable = true; // Allow sort
        $this->nama_pasien->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_pasien->Param, "CustomMsg");
        $this->Fields['nama_pasien'] = &$this->nama_pasien;

        // no_rekam_medis
        $this->no_rekam_medis = new DbField('master_pasien', 'master_pasien', 'x_no_rekam_medis', 'no_rekam_medis', '`no_rekam_medis`', '`no_rekam_medis`', 200, 16, -1, false, '`no_rekam_medis`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rekam_medis->Sortable = true; // Allow sort
        $this->no_rekam_medis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rekam_medis->Param, "CustomMsg");
        $this->Fields['no_rekam_medis'] = &$this->no_rekam_medis;

        // nik
        $this->nik = new DbField('master_pasien', 'master_pasien', 'x_nik', 'nik', '`nik`', '`nik`', 3, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->Sortable = true; // Allow sort
        $this->nik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // no_identitas_lain
        $this->no_identitas_lain = new DbField('master_pasien', 'master_pasien', 'x_no_identitas_lain', 'no_identitas_lain', '`no_identitas_lain`', '`no_identitas_lain`', 200, 20, -1, false, '`no_identitas_lain`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_identitas_lain->Sortable = true; // Allow sort
        $this->no_identitas_lain->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_identitas_lain->Param, "CustomMsg");
        $this->Fields['no_identitas_lain'] = &$this->no_identitas_lain;

        // nama_ibu
        $this->nama_ibu = new DbField('master_pasien', 'master_pasien', 'x_nama_ibu', 'nama_ibu', '`nama_ibu`', '`nama_ibu`', 200, 100, -1, false, '`nama_ibu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_ibu->Sortable = true; // Allow sort
        $this->nama_ibu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_ibu->Param, "CustomMsg");
        $this->Fields['nama_ibu'] = &$this->nama_ibu;

        // tempat_lahir
        $this->tempat_lahir = new DbField('master_pasien', 'master_pasien', 'x_tempat_lahir', 'tempat_lahir', '`tempat_lahir`', '`tempat_lahir`', 200, 16, -1, false, '`tempat_lahir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tempat_lahir->Sortable = true; // Allow sort
        $this->tempat_lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tempat_lahir->Param, "CustomMsg");
        $this->Fields['tempat_lahir'] = &$this->tempat_lahir;

        // tanggal_lahir
        $this->tanggal_lahir = new DbField('master_pasien', 'master_pasien', 'x_tanggal_lahir', 'tanggal_lahir', '`tanggal_lahir`', CastDateFieldForLike("`tanggal_lahir`", 0, "DB"), 135, 19, 0, false, '`tanggal_lahir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_lahir->Sortable = true; // Allow sort
        $this->tanggal_lahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_lahir->Param, "CustomMsg");
        $this->Fields['tanggal_lahir'] = &$this->tanggal_lahir;

        // jenis_kelamin
        $this->jenis_kelamin = new DbField('master_pasien', 'master_pasien', 'x_jenis_kelamin', 'jenis_kelamin', '`jenis_kelamin`', '`jenis_kelamin`', 3, 1, -1, false, '`jenis_kelamin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jenis_kelamin->Sortable = true; // Allow sort
        $this->jenis_kelamin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jenis_kelamin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jenis_kelamin->Param, "CustomMsg");
        $this->Fields['jenis_kelamin'] = &$this->jenis_kelamin;

        // agama
        $this->agama = new DbField('master_pasien', 'master_pasien', 'x_agama', 'agama', '`agama`', '`agama`', 3, 1, -1, false, '`agama`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->agama->Sortable = true; // Allow sort
        $this->agama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->agama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->agama->Param, "CustomMsg");
        $this->Fields['agama'] = &$this->agama;

        // suku
        $this->suku = new DbField('master_pasien', 'master_pasien', 'x_suku', 'suku', '`suku`', '`suku`', 200, 1, -1, false, '`suku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->suku->Sortable = true; // Allow sort
        $this->suku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->suku->Param, "CustomMsg");
        $this->Fields['suku'] = &$this->suku;

        // bahasa
        $this->bahasa = new DbField('master_pasien', 'master_pasien', 'x_bahasa', 'bahasa', '`bahasa`', '`bahasa`', 3, 1, -1, false, '`bahasa`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bahasa->Sortable = true; // Allow sort
        $this->bahasa->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bahasa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bahasa->Param, "CustomMsg");
        $this->Fields['bahasa'] = &$this->bahasa;

        // alamat
        $this->alamat = new DbField('master_pasien', 'master_pasien', 'x_alamat', 'alamat', '`alamat`', '`alamat`', 200, 100, -1, false, '`alamat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat->Sortable = true; // Allow sort
        $this->alamat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat->Param, "CustomMsg");
        $this->Fields['alamat'] = &$this->alamat;

        // rt
        $this->rt = new DbField('master_pasien', 'master_pasien', 'x_rt', 'rt', '`rt`', '`rt`', 3, 3, -1, false, '`rt`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rt->Sortable = true; // Allow sort
        $this->rt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rt->Param, "CustomMsg");
        $this->Fields['rt'] = &$this->rt;

        // rw
        $this->rw = new DbField('master_pasien', 'master_pasien', 'x_rw', 'rw', '`rw`', '`rw`', 3, 3, -1, false, '`rw`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rw->Sortable = true; // Allow sort
        $this->rw->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rw->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rw->Param, "CustomMsg");
        $this->Fields['rw'] = &$this->rw;

        // keluarahan_desa
        $this->keluarahan_desa = new DbField('master_pasien', 'master_pasien', 'x_keluarahan_desa', 'keluarahan_desa', '`keluarahan_desa`', '`keluarahan_desa`', 200, 255, -1, false, '`keluarahan_desa`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->keluarahan_desa->Sortable = true; // Allow sort
        $this->keluarahan_desa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keluarahan_desa->Param, "CustomMsg");
        $this->Fields['keluarahan_desa'] = &$this->keluarahan_desa;

        // kecamatan
        $this->kecamatan = new DbField('master_pasien', 'master_pasien', 'x_kecamatan', 'kecamatan', '`kecamatan`', '`kecamatan`', 200, 255, -1, false, '`kecamatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kecamatan->Sortable = true; // Allow sort
        $this->kecamatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kecamatan->Param, "CustomMsg");
        $this->Fields['kecamatan'] = &$this->kecamatan;

        // kabupaten_kota
        $this->kabupaten_kota = new DbField('master_pasien', 'master_pasien', 'x_kabupaten_kota', 'kabupaten_kota', '`kabupaten_kota`', '`kabupaten_kota`', 200, 255, -1, false, '`kabupaten_kota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kabupaten_kota->Sortable = true; // Allow sort
        $this->kabupaten_kota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kabupaten_kota->Param, "CustomMsg");
        $this->Fields['kabupaten_kota'] = &$this->kabupaten_kota;

        // kodepos
        $this->kodepos = new DbField('master_pasien', 'master_pasien', 'x_kodepos', 'kodepos', '`kodepos`', '`kodepos`', 3, 7, -1, false, '`kodepos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kodepos->Sortable = true; // Allow sort
        $this->kodepos->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kodepos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kodepos->Param, "CustomMsg");
        $this->Fields['kodepos'] = &$this->kodepos;

        // provinsi
        $this->provinsi = new DbField('master_pasien', 'master_pasien', 'x_provinsi', 'provinsi', '`provinsi`', '`provinsi`', 200, 255, -1, false, '`provinsi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->provinsi->Sortable = true; // Allow sort
        $this->provinsi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->provinsi->Param, "CustomMsg");
        $this->Fields['provinsi'] = &$this->provinsi;

        // negara
        $this->negara = new DbField('master_pasien', 'master_pasien', 'x_negara', 'negara', '`negara`', '`negara`', 200, 255, -1, false, '`negara`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->negara->Sortable = true; // Allow sort
        $this->negara->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->negara->Param, "CustomMsg");
        $this->Fields['negara'] = &$this->negara;

        // alamat_domisili
        $this->alamat_domisili = new DbField('master_pasien', 'master_pasien', 'x_alamat_domisili', 'alamat_domisili', '`alamat_domisili`', '`alamat_domisili`', 200, 255, -1, false, '`alamat_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat_domisili->Sortable = true; // Allow sort
        $this->alamat_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat_domisili->Param, "CustomMsg");
        $this->Fields['alamat_domisili'] = &$this->alamat_domisili;

        // rt_domisili
        $this->rt_domisili = new DbField('master_pasien', 'master_pasien', 'x_rt_domisili', 'rt_domisili', '`rt_domisili`', '`rt_domisili`', 200, 255, -1, false, '`rt_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rt_domisili->Sortable = true; // Allow sort
        $this->rt_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rt_domisili->Param, "CustomMsg");
        $this->Fields['rt_domisili'] = &$this->rt_domisili;

        // rw_domisili
        $this->rw_domisili = new DbField('master_pasien', 'master_pasien', 'x_rw_domisili', 'rw_domisili', '`rw_domisili`', '`rw_domisili`', 200, 255, -1, false, '`rw_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rw_domisili->Sortable = true; // Allow sort
        $this->rw_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rw_domisili->Param, "CustomMsg");
        $this->Fields['rw_domisili'] = &$this->rw_domisili;

        // kel_desa_domisili
        $this->kel_desa_domisili = new DbField('master_pasien', 'master_pasien', 'x_kel_desa_domisili', 'kel_desa_domisili', '`kel_desa_domisili`', '`kel_desa_domisili`', 200, 255, -1, false, '`kel_desa_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kel_desa_domisili->Sortable = true; // Allow sort
        $this->kel_desa_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kel_desa_domisili->Param, "CustomMsg");
        $this->Fields['kel_desa_domisili'] = &$this->kel_desa_domisili;

        // kec_domisili
        $this->kec_domisili = new DbField('master_pasien', 'master_pasien', 'x_kec_domisili', 'kec_domisili', '`kec_domisili`', '`kec_domisili`', 200, 255, -1, false, '`kec_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kec_domisili->Sortable = true; // Allow sort
        $this->kec_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kec_domisili->Param, "CustomMsg");
        $this->Fields['kec_domisili'] = &$this->kec_domisili;

        // kota_kab_domisili
        $this->kota_kab_domisili = new DbField('master_pasien', 'master_pasien', 'x_kota_kab_domisili', 'kota_kab_domisili', '`kota_kab_domisili`', '`kota_kab_domisili`', 200, 255, -1, false, '`kota_kab_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kota_kab_domisili->Sortable = true; // Allow sort
        $this->kota_kab_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kota_kab_domisili->Param, "CustomMsg");
        $this->Fields['kota_kab_domisili'] = &$this->kota_kab_domisili;

        // kodepos_domisili
        $this->kodepos_domisili = new DbField('master_pasien', 'master_pasien', 'x_kodepos_domisili', 'kodepos_domisili', '`kodepos_domisili`', '`kodepos_domisili`', 200, 255, -1, false, '`kodepos_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kodepos_domisili->Sortable = true; // Allow sort
        $this->kodepos_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kodepos_domisili->Param, "CustomMsg");
        $this->Fields['kodepos_domisili'] = &$this->kodepos_domisili;

        // prov_domisili
        $this->prov_domisili = new DbField('master_pasien', 'master_pasien', 'x_prov_domisili', 'prov_domisili', '`prov_domisili`', '`prov_domisili`', 200, 255, -1, false, '`prov_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->prov_domisili->Sortable = true; // Allow sort
        $this->prov_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->prov_domisili->Param, "CustomMsg");
        $this->Fields['prov_domisili'] = &$this->prov_domisili;

        // negara_domisili
        $this->negara_domisili = new DbField('master_pasien', 'master_pasien', 'x_negara_domisili', 'negara_domisili', '`negara_domisili`', '`negara_domisili`', 200, 255, -1, false, '`negara_domisili`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->negara_domisili->Sortable = true; // Allow sort
        $this->negara_domisili->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->negara_domisili->Param, "CustomMsg");
        $this->Fields['negara_domisili'] = &$this->negara_domisili;

        // no_telp
        $this->no_telp = new DbField('master_pasien', 'master_pasien', 'x_no_telp', 'no_telp', '`no_telp`', '`no_telp`', 3, 16, -1, false, '`no_telp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_telp->Sortable = true; // Allow sort
        $this->no_telp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->no_telp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_telp->Param, "CustomMsg");
        $this->Fields['no_telp'] = &$this->no_telp;

        // no_hp
        $this->no_hp = new DbField('master_pasien', 'master_pasien', 'x_no_hp', 'no_hp', '`no_hp`', '`no_hp`', 3, 16, -1, false, '`no_hp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_hp->Sortable = true; // Allow sort
        $this->no_hp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->no_hp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_hp->Param, "CustomMsg");
        $this->Fields['no_hp'] = &$this->no_hp;

        // pendidikan
        $this->pendidikan = new DbField('master_pasien', 'master_pasien', 'x_pendidikan', 'pendidikan', '`pendidikan`', '`pendidikan`', 3, 5, -1, false, '`pendidikan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pendidikan->Sortable = true; // Allow sort
        $this->pendidikan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pendidikan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pendidikan->Param, "CustomMsg");
        $this->Fields['pendidikan'] = &$this->pendidikan;

        // pekerjaan
        $this->pekerjaan = new DbField('master_pasien', 'master_pasien', 'x_pekerjaan', 'pekerjaan', '`pekerjaan`', '`pekerjaan`', 3, 5, -1, false, '`pekerjaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pekerjaan->Sortable = true; // Allow sort
        $this->pekerjaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pekerjaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pekerjaan->Param, "CustomMsg");
        $this->Fields['pekerjaan'] = &$this->pekerjaan;

        // status_kawin
        $this->status_kawin = new DbField('master_pasien', 'master_pasien', 'x_status_kawin', 'status_kawin', '`status_kawin`', '`status_kawin`', 3, 5, -1, false, '`status_kawin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status_kawin->Sortable = true; // Allow sort
        $this->status_kawin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_kawin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_kawin->Param, "CustomMsg");
        $this->Fields['status_kawin'] = &$this->status_kawin;

        // tgl_daftar
        $this->tgl_daftar = new DbField('master_pasien', 'master_pasien', 'x_tgl_daftar', 'tgl_daftar', '`tgl_daftar`', CastDateFieldForLike("`tgl_daftar`", 0, "DB"), 135, 19, 0, false, '`tgl_daftar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_daftar->Sortable = true; // Allow sort
        $this->tgl_daftar->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_daftar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_daftar->Param, "CustomMsg");
        $this->Fields['tgl_daftar'] = &$this->tgl_daftar;

        // username
        $this->_username = new DbField('master_pasien', 'master_pasien', 'x__username', 'username', '`username`', '`username`', 200, 255, -1, false, '`username`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_username->Sortable = true; // Allow sort
        $this->_username->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_username->Param, "CustomMsg");
        $this->Fields['username'] = &$this->_username;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`master_pasien`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id_pasien->setDbValue($conn->lastInsertId());
            $rs['id_pasien'] = $this->id_pasien->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id_pasien', $rs)) {
                AddFilter($where, QuotedName('id_pasien', $this->Dbid) . '=' . QuotedValue($rs['id_pasien'], $this->id_pasien->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id_pasien->DbValue = $row['id_pasien'];
        $this->nama_pasien->DbValue = $row['nama_pasien'];
        $this->no_rekam_medis->DbValue = $row['no_rekam_medis'];
        $this->nik->DbValue = $row['nik'];
        $this->no_identitas_lain->DbValue = $row['no_identitas_lain'];
        $this->nama_ibu->DbValue = $row['nama_ibu'];
        $this->tempat_lahir->DbValue = $row['tempat_lahir'];
        $this->tanggal_lahir->DbValue = $row['tanggal_lahir'];
        $this->jenis_kelamin->DbValue = $row['jenis_kelamin'];
        $this->agama->DbValue = $row['agama'];
        $this->suku->DbValue = $row['suku'];
        $this->bahasa->DbValue = $row['bahasa'];
        $this->alamat->DbValue = $row['alamat'];
        $this->rt->DbValue = $row['rt'];
        $this->rw->DbValue = $row['rw'];
        $this->keluarahan_desa->DbValue = $row['keluarahan_desa'];
        $this->kecamatan->DbValue = $row['kecamatan'];
        $this->kabupaten_kota->DbValue = $row['kabupaten_kota'];
        $this->kodepos->DbValue = $row['kodepos'];
        $this->provinsi->DbValue = $row['provinsi'];
        $this->negara->DbValue = $row['negara'];
        $this->alamat_domisili->DbValue = $row['alamat_domisili'];
        $this->rt_domisili->DbValue = $row['rt_domisili'];
        $this->rw_domisili->DbValue = $row['rw_domisili'];
        $this->kel_desa_domisili->DbValue = $row['kel_desa_domisili'];
        $this->kec_domisili->DbValue = $row['kec_domisili'];
        $this->kota_kab_domisili->DbValue = $row['kota_kab_domisili'];
        $this->kodepos_domisili->DbValue = $row['kodepos_domisili'];
        $this->prov_domisili->DbValue = $row['prov_domisili'];
        $this->negara_domisili->DbValue = $row['negara_domisili'];
        $this->no_telp->DbValue = $row['no_telp'];
        $this->no_hp->DbValue = $row['no_hp'];
        $this->pendidikan->DbValue = $row['pendidikan'];
        $this->pekerjaan->DbValue = $row['pekerjaan'];
        $this->status_kawin->DbValue = $row['status_kawin'];
        $this->tgl_daftar->DbValue = $row['tgl_daftar'];
        $this->_username->DbValue = $row['username'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_pasien` = @id_pasien@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_pasien->CurrentValue : $this->id_pasien->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id_pasien->CurrentValue = $keys[0];
            } else {
                $this->id_pasien->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_pasien', $row) ? $row['id_pasien'] : null;
        } else {
            $val = $this->id_pasien->OldValue !== null ? $this->id_pasien->OldValue : $this->id_pasien->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_pasien@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("MasterPasienList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "MasterPasienView") {
            return $Language->phrase("View");
        } elseif ($pageName == "MasterPasienEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "MasterPasienAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "MasterPasienView";
            case Config("API_ADD_ACTION"):
                return "MasterPasienAdd";
            case Config("API_EDIT_ACTION"):
                return "MasterPasienEdit";
            case Config("API_DELETE_ACTION"):
                return "MasterPasienDelete";
            case Config("API_LIST_ACTION"):
                return "MasterPasienList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "MasterPasienList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("MasterPasienView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("MasterPasienView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "MasterPasienAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "MasterPasienAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("MasterPasienEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("MasterPasienAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("MasterPasienDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_pasien:" . JsonEncode($this->id_pasien->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_pasien->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_pasien->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id_pasien") ?? Route("id_pasien")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id_pasien->CurrentValue = $key;
            } else {
                $this->id_pasien->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id_pasien->setDbValue($row['id_pasien']);
        $this->nama_pasien->setDbValue($row['nama_pasien']);
        $this->no_rekam_medis->setDbValue($row['no_rekam_medis']);
        $this->nik->setDbValue($row['nik']);
        $this->no_identitas_lain->setDbValue($row['no_identitas_lain']);
        $this->nama_ibu->setDbValue($row['nama_ibu']);
        $this->tempat_lahir->setDbValue($row['tempat_lahir']);
        $this->tanggal_lahir->setDbValue($row['tanggal_lahir']);
        $this->jenis_kelamin->setDbValue($row['jenis_kelamin']);
        $this->agama->setDbValue($row['agama']);
        $this->suku->setDbValue($row['suku']);
        $this->bahasa->setDbValue($row['bahasa']);
        $this->alamat->setDbValue($row['alamat']);
        $this->rt->setDbValue($row['rt']);
        $this->rw->setDbValue($row['rw']);
        $this->keluarahan_desa->setDbValue($row['keluarahan_desa']);
        $this->kecamatan->setDbValue($row['kecamatan']);
        $this->kabupaten_kota->setDbValue($row['kabupaten_kota']);
        $this->kodepos->setDbValue($row['kodepos']);
        $this->provinsi->setDbValue($row['provinsi']);
        $this->negara->setDbValue($row['negara']);
        $this->alamat_domisili->setDbValue($row['alamat_domisili']);
        $this->rt_domisili->setDbValue($row['rt_domisili']);
        $this->rw_domisili->setDbValue($row['rw_domisili']);
        $this->kel_desa_domisili->setDbValue($row['kel_desa_domisili']);
        $this->kec_domisili->setDbValue($row['kec_domisili']);
        $this->kota_kab_domisili->setDbValue($row['kota_kab_domisili']);
        $this->kodepos_domisili->setDbValue($row['kodepos_domisili']);
        $this->prov_domisili->setDbValue($row['prov_domisili']);
        $this->negara_domisili->setDbValue($row['negara_domisili']);
        $this->no_telp->setDbValue($row['no_telp']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->status_kawin->setDbValue($row['status_kawin']);
        $this->tgl_daftar->setDbValue($row['tgl_daftar']);
        $this->_username->setDbValue($row['username']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_pasien

        // nama_pasien

        // no_rekam_medis

        // nik

        // no_identitas_lain

        // nama_ibu

        // tempat_lahir

        // tanggal_lahir

        // jenis_kelamin

        // agama

        // suku

        // bahasa

        // alamat

        // rt

        // rw

        // keluarahan_desa

        // kecamatan

        // kabupaten_kota

        // kodepos

        // provinsi

        // negara

        // alamat_domisili

        // rt_domisili

        // rw_domisili

        // kel_desa_domisili

        // kec_domisili

        // kota_kab_domisili

        // kodepos_domisili

        // prov_domisili

        // negara_domisili

        // no_telp

        // no_hp

        // pendidikan

        // pekerjaan

        // status_kawin

        // tgl_daftar

        // username

        // id_pasien
        $this->id_pasien->ViewValue = $this->id_pasien->CurrentValue;
        $this->id_pasien->ViewCustomAttributes = "";

        // nama_pasien
        $this->nama_pasien->ViewValue = $this->nama_pasien->CurrentValue;
        $this->nama_pasien->ViewCustomAttributes = "";

        // no_rekam_medis
        $this->no_rekam_medis->ViewValue = $this->no_rekam_medis->CurrentValue;
        $this->no_rekam_medis->ViewCustomAttributes = "";

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewValue = FormatNumber($this->nik->ViewValue, 0, -2, -2, -2);
        $this->nik->ViewCustomAttributes = "";

        // no_identitas_lain
        $this->no_identitas_lain->ViewValue = $this->no_identitas_lain->CurrentValue;
        $this->no_identitas_lain->ViewCustomAttributes = "";

        // nama_ibu
        $this->nama_ibu->ViewValue = $this->nama_ibu->CurrentValue;
        $this->nama_ibu->ViewCustomAttributes = "";

        // tempat_lahir
        $this->tempat_lahir->ViewValue = $this->tempat_lahir->CurrentValue;
        $this->tempat_lahir->ViewCustomAttributes = "";

        // tanggal_lahir
        $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
        $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
        $this->tanggal_lahir->ViewCustomAttributes = "";

        // jenis_kelamin
        $this->jenis_kelamin->ViewValue = $this->jenis_kelamin->CurrentValue;
        $this->jenis_kelamin->ViewValue = FormatNumber($this->jenis_kelamin->ViewValue, 0, -2, -2, -2);
        $this->jenis_kelamin->ViewCustomAttributes = "";

        // agama
        $this->agama->ViewValue = $this->agama->CurrentValue;
        $this->agama->ViewValue = FormatNumber($this->agama->ViewValue, 0, -2, -2, -2);
        $this->agama->ViewCustomAttributes = "";

        // suku
        $this->suku->ViewValue = $this->suku->CurrentValue;
        $this->suku->ViewCustomAttributes = "";

        // bahasa
        $this->bahasa->ViewValue = $this->bahasa->CurrentValue;
        $this->bahasa->ViewValue = FormatNumber($this->bahasa->ViewValue, 0, -2, -2, -2);
        $this->bahasa->ViewCustomAttributes = "";

        // alamat
        $this->alamat->ViewValue = $this->alamat->CurrentValue;
        $this->alamat->ViewCustomAttributes = "";

        // rt
        $this->rt->ViewValue = $this->rt->CurrentValue;
        $this->rt->ViewValue = FormatNumber($this->rt->ViewValue, 0, -2, -2, -2);
        $this->rt->ViewCustomAttributes = "";

        // rw
        $this->rw->ViewValue = $this->rw->CurrentValue;
        $this->rw->ViewValue = FormatNumber($this->rw->ViewValue, 0, -2, -2, -2);
        $this->rw->ViewCustomAttributes = "";

        // keluarahan_desa
        $this->keluarahan_desa->ViewValue = $this->keluarahan_desa->CurrentValue;
        $this->keluarahan_desa->ViewCustomAttributes = "";

        // kecamatan
        $this->kecamatan->ViewValue = $this->kecamatan->CurrentValue;
        $this->kecamatan->ViewCustomAttributes = "";

        // kabupaten_kota
        $this->kabupaten_kota->ViewValue = $this->kabupaten_kota->CurrentValue;
        $this->kabupaten_kota->ViewCustomAttributes = "";

        // kodepos
        $this->kodepos->ViewValue = $this->kodepos->CurrentValue;
        $this->kodepos->ViewValue = FormatNumber($this->kodepos->ViewValue, 0, -2, -2, -2);
        $this->kodepos->ViewCustomAttributes = "";

        // provinsi
        $this->provinsi->ViewValue = $this->provinsi->CurrentValue;
        $this->provinsi->ViewCustomAttributes = "";

        // negara
        $this->negara->ViewValue = $this->negara->CurrentValue;
        $this->negara->ViewCustomAttributes = "";

        // alamat_domisili
        $this->alamat_domisili->ViewValue = $this->alamat_domisili->CurrentValue;
        $this->alamat_domisili->ViewCustomAttributes = "";

        // rt_domisili
        $this->rt_domisili->ViewValue = $this->rt_domisili->CurrentValue;
        $this->rt_domisili->ViewCustomAttributes = "";

        // rw_domisili
        $this->rw_domisili->ViewValue = $this->rw_domisili->CurrentValue;
        $this->rw_domisili->ViewCustomAttributes = "";

        // kel_desa_domisili
        $this->kel_desa_domisili->ViewValue = $this->kel_desa_domisili->CurrentValue;
        $this->kel_desa_domisili->ViewCustomAttributes = "";

        // kec_domisili
        $this->kec_domisili->ViewValue = $this->kec_domisili->CurrentValue;
        $this->kec_domisili->ViewCustomAttributes = "";

        // kota_kab_domisili
        $this->kota_kab_domisili->ViewValue = $this->kota_kab_domisili->CurrentValue;
        $this->kota_kab_domisili->ViewCustomAttributes = "";

        // kodepos_domisili
        $this->kodepos_domisili->ViewValue = $this->kodepos_domisili->CurrentValue;
        $this->kodepos_domisili->ViewCustomAttributes = "";

        // prov_domisili
        $this->prov_domisili->ViewValue = $this->prov_domisili->CurrentValue;
        $this->prov_domisili->ViewCustomAttributes = "";

        // negara_domisili
        $this->negara_domisili->ViewValue = $this->negara_domisili->CurrentValue;
        $this->negara_domisili->ViewCustomAttributes = "";

        // no_telp
        $this->no_telp->ViewValue = $this->no_telp->CurrentValue;
        $this->no_telp->ViewValue = FormatNumber($this->no_telp->ViewValue, 0, -2, -2, -2);
        $this->no_telp->ViewCustomAttributes = "";

        // no_hp
        $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
        $this->no_hp->ViewValue = FormatNumber($this->no_hp->ViewValue, 0, -2, -2, -2);
        $this->no_hp->ViewCustomAttributes = "";

        // pendidikan
        $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
        $this->pendidikan->ViewValue = FormatNumber($this->pendidikan->ViewValue, 0, -2, -2, -2);
        $this->pendidikan->ViewCustomAttributes = "";

        // pekerjaan
        $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
        $this->pekerjaan->ViewValue = FormatNumber($this->pekerjaan->ViewValue, 0, -2, -2, -2);
        $this->pekerjaan->ViewCustomAttributes = "";

        // status_kawin
        $this->status_kawin->ViewValue = $this->status_kawin->CurrentValue;
        $this->status_kawin->ViewValue = FormatNumber($this->status_kawin->ViewValue, 0, -2, -2, -2);
        $this->status_kawin->ViewCustomAttributes = "";

        // tgl_daftar
        $this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
        $this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
        $this->tgl_daftar->ViewCustomAttributes = "";

        // username
        $this->_username->ViewValue = $this->_username->CurrentValue;
        $this->_username->ViewCustomAttributes = "";

        // id_pasien
        $this->id_pasien->LinkCustomAttributes = "";
        $this->id_pasien->HrefValue = "";
        $this->id_pasien->TooltipValue = "";

        // nama_pasien
        $this->nama_pasien->LinkCustomAttributes = "";
        $this->nama_pasien->HrefValue = "";
        $this->nama_pasien->TooltipValue = "";

        // no_rekam_medis
        $this->no_rekam_medis->LinkCustomAttributes = "";
        $this->no_rekam_medis->HrefValue = "";
        $this->no_rekam_medis->TooltipValue = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // no_identitas_lain
        $this->no_identitas_lain->LinkCustomAttributes = "";
        $this->no_identitas_lain->HrefValue = "";
        $this->no_identitas_lain->TooltipValue = "";

        // nama_ibu
        $this->nama_ibu->LinkCustomAttributes = "";
        $this->nama_ibu->HrefValue = "";
        $this->nama_ibu->TooltipValue = "";

        // tempat_lahir
        $this->tempat_lahir->LinkCustomAttributes = "";
        $this->tempat_lahir->HrefValue = "";
        $this->tempat_lahir->TooltipValue = "";

        // tanggal_lahir
        $this->tanggal_lahir->LinkCustomAttributes = "";
        $this->tanggal_lahir->HrefValue = "";
        $this->tanggal_lahir->TooltipValue = "";

        // jenis_kelamin
        $this->jenis_kelamin->LinkCustomAttributes = "";
        $this->jenis_kelamin->HrefValue = "";
        $this->jenis_kelamin->TooltipValue = "";

        // agama
        $this->agama->LinkCustomAttributes = "";
        $this->agama->HrefValue = "";
        $this->agama->TooltipValue = "";

        // suku
        $this->suku->LinkCustomAttributes = "";
        $this->suku->HrefValue = "";
        $this->suku->TooltipValue = "";

        // bahasa
        $this->bahasa->LinkCustomAttributes = "";
        $this->bahasa->HrefValue = "";
        $this->bahasa->TooltipValue = "";

        // alamat
        $this->alamat->LinkCustomAttributes = "";
        $this->alamat->HrefValue = "";
        $this->alamat->TooltipValue = "";

        // rt
        $this->rt->LinkCustomAttributes = "";
        $this->rt->HrefValue = "";
        $this->rt->TooltipValue = "";

        // rw
        $this->rw->LinkCustomAttributes = "";
        $this->rw->HrefValue = "";
        $this->rw->TooltipValue = "";

        // keluarahan_desa
        $this->keluarahan_desa->LinkCustomAttributes = "";
        $this->keluarahan_desa->HrefValue = "";
        $this->keluarahan_desa->TooltipValue = "";

        // kecamatan
        $this->kecamatan->LinkCustomAttributes = "";
        $this->kecamatan->HrefValue = "";
        $this->kecamatan->TooltipValue = "";

        // kabupaten_kota
        $this->kabupaten_kota->LinkCustomAttributes = "";
        $this->kabupaten_kota->HrefValue = "";
        $this->kabupaten_kota->TooltipValue = "";

        // kodepos
        $this->kodepos->LinkCustomAttributes = "";
        $this->kodepos->HrefValue = "";
        $this->kodepos->TooltipValue = "";

        // provinsi
        $this->provinsi->LinkCustomAttributes = "";
        $this->provinsi->HrefValue = "";
        $this->provinsi->TooltipValue = "";

        // negara
        $this->negara->LinkCustomAttributes = "";
        $this->negara->HrefValue = "";
        $this->negara->TooltipValue = "";

        // alamat_domisili
        $this->alamat_domisili->LinkCustomAttributes = "";
        $this->alamat_domisili->HrefValue = "";
        $this->alamat_domisili->TooltipValue = "";

        // rt_domisili
        $this->rt_domisili->LinkCustomAttributes = "";
        $this->rt_domisili->HrefValue = "";
        $this->rt_domisili->TooltipValue = "";

        // rw_domisili
        $this->rw_domisili->LinkCustomAttributes = "";
        $this->rw_domisili->HrefValue = "";
        $this->rw_domisili->TooltipValue = "";

        // kel_desa_domisili
        $this->kel_desa_domisili->LinkCustomAttributes = "";
        $this->kel_desa_domisili->HrefValue = "";
        $this->kel_desa_domisili->TooltipValue = "";

        // kec_domisili
        $this->kec_domisili->LinkCustomAttributes = "";
        $this->kec_domisili->HrefValue = "";
        $this->kec_domisili->TooltipValue = "";

        // kota_kab_domisili
        $this->kota_kab_domisili->LinkCustomAttributes = "";
        $this->kota_kab_domisili->HrefValue = "";
        $this->kota_kab_domisili->TooltipValue = "";

        // kodepos_domisili
        $this->kodepos_domisili->LinkCustomAttributes = "";
        $this->kodepos_domisili->HrefValue = "";
        $this->kodepos_domisili->TooltipValue = "";

        // prov_domisili
        $this->prov_domisili->LinkCustomAttributes = "";
        $this->prov_domisili->HrefValue = "";
        $this->prov_domisili->TooltipValue = "";

        // negara_domisili
        $this->negara_domisili->LinkCustomAttributes = "";
        $this->negara_domisili->HrefValue = "";
        $this->negara_domisili->TooltipValue = "";

        // no_telp
        $this->no_telp->LinkCustomAttributes = "";
        $this->no_telp->HrefValue = "";
        $this->no_telp->TooltipValue = "";

        // no_hp
        $this->no_hp->LinkCustomAttributes = "";
        $this->no_hp->HrefValue = "";
        $this->no_hp->TooltipValue = "";

        // pendidikan
        $this->pendidikan->LinkCustomAttributes = "";
        $this->pendidikan->HrefValue = "";
        $this->pendidikan->TooltipValue = "";

        // pekerjaan
        $this->pekerjaan->LinkCustomAttributes = "";
        $this->pekerjaan->HrefValue = "";
        $this->pekerjaan->TooltipValue = "";

        // status_kawin
        $this->status_kawin->LinkCustomAttributes = "";
        $this->status_kawin->HrefValue = "";
        $this->status_kawin->TooltipValue = "";

        // tgl_daftar
        $this->tgl_daftar->LinkCustomAttributes = "";
        $this->tgl_daftar->HrefValue = "";
        $this->tgl_daftar->TooltipValue = "";

        // username
        $this->_username->LinkCustomAttributes = "";
        $this->_username->HrefValue = "";
        $this->_username->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id_pasien
        $this->id_pasien->EditAttrs["class"] = "form-control";
        $this->id_pasien->EditCustomAttributes = "";
        $this->id_pasien->EditValue = $this->id_pasien->CurrentValue;
        $this->id_pasien->ViewCustomAttributes = "";

        // nama_pasien
        $this->nama_pasien->EditAttrs["class"] = "form-control";
        $this->nama_pasien->EditCustomAttributes = "";
        if (!$this->nama_pasien->Raw) {
            $this->nama_pasien->CurrentValue = HtmlDecode($this->nama_pasien->CurrentValue);
        }
        $this->nama_pasien->EditValue = $this->nama_pasien->CurrentValue;
        $this->nama_pasien->PlaceHolder = RemoveHtml($this->nama_pasien->caption());

        // no_rekam_medis
        $this->no_rekam_medis->EditAttrs["class"] = "form-control";
        $this->no_rekam_medis->EditCustomAttributes = "";
        if (!$this->no_rekam_medis->Raw) {
            $this->no_rekam_medis->CurrentValue = HtmlDecode($this->no_rekam_medis->CurrentValue);
        }
        $this->no_rekam_medis->EditValue = $this->no_rekam_medis->CurrentValue;
        $this->no_rekam_medis->PlaceHolder = RemoveHtml($this->no_rekam_medis->caption());

        // nik
        $this->nik->EditAttrs["class"] = "form-control";
        $this->nik->EditCustomAttributes = "";
        $this->nik->EditValue = $this->nik->CurrentValue;
        $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

        // no_identitas_lain
        $this->no_identitas_lain->EditAttrs["class"] = "form-control";
        $this->no_identitas_lain->EditCustomAttributes = "";
        if (!$this->no_identitas_lain->Raw) {
            $this->no_identitas_lain->CurrentValue = HtmlDecode($this->no_identitas_lain->CurrentValue);
        }
        $this->no_identitas_lain->EditValue = $this->no_identitas_lain->CurrentValue;
        $this->no_identitas_lain->PlaceHolder = RemoveHtml($this->no_identitas_lain->caption());

        // nama_ibu
        $this->nama_ibu->EditAttrs["class"] = "form-control";
        $this->nama_ibu->EditCustomAttributes = "";
        if (!$this->nama_ibu->Raw) {
            $this->nama_ibu->CurrentValue = HtmlDecode($this->nama_ibu->CurrentValue);
        }
        $this->nama_ibu->EditValue = $this->nama_ibu->CurrentValue;
        $this->nama_ibu->PlaceHolder = RemoveHtml($this->nama_ibu->caption());

        // tempat_lahir
        $this->tempat_lahir->EditAttrs["class"] = "form-control";
        $this->tempat_lahir->EditCustomAttributes = "";
        if (!$this->tempat_lahir->Raw) {
            $this->tempat_lahir->CurrentValue = HtmlDecode($this->tempat_lahir->CurrentValue);
        }
        $this->tempat_lahir->EditValue = $this->tempat_lahir->CurrentValue;
        $this->tempat_lahir->PlaceHolder = RemoveHtml($this->tempat_lahir->caption());

        // tanggal_lahir
        $this->tanggal_lahir->EditAttrs["class"] = "form-control";
        $this->tanggal_lahir->EditCustomAttributes = "";
        $this->tanggal_lahir->EditValue = FormatDateTime($this->tanggal_lahir->CurrentValue, 8);
        $this->tanggal_lahir->PlaceHolder = RemoveHtml($this->tanggal_lahir->caption());

        // jenis_kelamin
        $this->jenis_kelamin->EditAttrs["class"] = "form-control";
        $this->jenis_kelamin->EditCustomAttributes = "";
        $this->jenis_kelamin->EditValue = $this->jenis_kelamin->CurrentValue;
        $this->jenis_kelamin->PlaceHolder = RemoveHtml($this->jenis_kelamin->caption());

        // agama
        $this->agama->EditAttrs["class"] = "form-control";
        $this->agama->EditCustomAttributes = "";
        $this->agama->EditValue = $this->agama->CurrentValue;
        $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

        // suku
        $this->suku->EditAttrs["class"] = "form-control";
        $this->suku->EditCustomAttributes = "";
        if (!$this->suku->Raw) {
            $this->suku->CurrentValue = HtmlDecode($this->suku->CurrentValue);
        }
        $this->suku->EditValue = $this->suku->CurrentValue;
        $this->suku->PlaceHolder = RemoveHtml($this->suku->caption());

        // bahasa
        $this->bahasa->EditAttrs["class"] = "form-control";
        $this->bahasa->EditCustomAttributes = "";
        $this->bahasa->EditValue = $this->bahasa->CurrentValue;
        $this->bahasa->PlaceHolder = RemoveHtml($this->bahasa->caption());

        // alamat
        $this->alamat->EditAttrs["class"] = "form-control";
        $this->alamat->EditCustomAttributes = "";
        if (!$this->alamat->Raw) {
            $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
        }
        $this->alamat->EditValue = $this->alamat->CurrentValue;
        $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

        // rt
        $this->rt->EditAttrs["class"] = "form-control";
        $this->rt->EditCustomAttributes = "";
        $this->rt->EditValue = $this->rt->CurrentValue;
        $this->rt->PlaceHolder = RemoveHtml($this->rt->caption());

        // rw
        $this->rw->EditAttrs["class"] = "form-control";
        $this->rw->EditCustomAttributes = "";
        $this->rw->EditValue = $this->rw->CurrentValue;
        $this->rw->PlaceHolder = RemoveHtml($this->rw->caption());

        // keluarahan_desa
        $this->keluarahan_desa->EditAttrs["class"] = "form-control";
        $this->keluarahan_desa->EditCustomAttributes = "";
        if (!$this->keluarahan_desa->Raw) {
            $this->keluarahan_desa->CurrentValue = HtmlDecode($this->keluarahan_desa->CurrentValue);
        }
        $this->keluarahan_desa->EditValue = $this->keluarahan_desa->CurrentValue;
        $this->keluarahan_desa->PlaceHolder = RemoveHtml($this->keluarahan_desa->caption());

        // kecamatan
        $this->kecamatan->EditAttrs["class"] = "form-control";
        $this->kecamatan->EditCustomAttributes = "";
        if (!$this->kecamatan->Raw) {
            $this->kecamatan->CurrentValue = HtmlDecode($this->kecamatan->CurrentValue);
        }
        $this->kecamatan->EditValue = $this->kecamatan->CurrentValue;
        $this->kecamatan->PlaceHolder = RemoveHtml($this->kecamatan->caption());

        // kabupaten_kota
        $this->kabupaten_kota->EditAttrs["class"] = "form-control";
        $this->kabupaten_kota->EditCustomAttributes = "";
        if (!$this->kabupaten_kota->Raw) {
            $this->kabupaten_kota->CurrentValue = HtmlDecode($this->kabupaten_kota->CurrentValue);
        }
        $this->kabupaten_kota->EditValue = $this->kabupaten_kota->CurrentValue;
        $this->kabupaten_kota->PlaceHolder = RemoveHtml($this->kabupaten_kota->caption());

        // kodepos
        $this->kodepos->EditAttrs["class"] = "form-control";
        $this->kodepos->EditCustomAttributes = "";
        $this->kodepos->EditValue = $this->kodepos->CurrentValue;
        $this->kodepos->PlaceHolder = RemoveHtml($this->kodepos->caption());

        // provinsi
        $this->provinsi->EditAttrs["class"] = "form-control";
        $this->provinsi->EditCustomAttributes = "";
        if (!$this->provinsi->Raw) {
            $this->provinsi->CurrentValue = HtmlDecode($this->provinsi->CurrentValue);
        }
        $this->provinsi->EditValue = $this->provinsi->CurrentValue;
        $this->provinsi->PlaceHolder = RemoveHtml($this->provinsi->caption());

        // negara
        $this->negara->EditAttrs["class"] = "form-control";
        $this->negara->EditCustomAttributes = "";
        if (!$this->negara->Raw) {
            $this->negara->CurrentValue = HtmlDecode($this->negara->CurrentValue);
        }
        $this->negara->EditValue = $this->negara->CurrentValue;
        $this->negara->PlaceHolder = RemoveHtml($this->negara->caption());

        // alamat_domisili
        $this->alamat_domisili->EditAttrs["class"] = "form-control";
        $this->alamat_domisili->EditCustomAttributes = "";
        if (!$this->alamat_domisili->Raw) {
            $this->alamat_domisili->CurrentValue = HtmlDecode($this->alamat_domisili->CurrentValue);
        }
        $this->alamat_domisili->EditValue = $this->alamat_domisili->CurrentValue;
        $this->alamat_domisili->PlaceHolder = RemoveHtml($this->alamat_domisili->caption());

        // rt_domisili
        $this->rt_domisili->EditAttrs["class"] = "form-control";
        $this->rt_domisili->EditCustomAttributes = "";
        if (!$this->rt_domisili->Raw) {
            $this->rt_domisili->CurrentValue = HtmlDecode($this->rt_domisili->CurrentValue);
        }
        $this->rt_domisili->EditValue = $this->rt_domisili->CurrentValue;
        $this->rt_domisili->PlaceHolder = RemoveHtml($this->rt_domisili->caption());

        // rw_domisili
        $this->rw_domisili->EditAttrs["class"] = "form-control";
        $this->rw_domisili->EditCustomAttributes = "";
        if (!$this->rw_domisili->Raw) {
            $this->rw_domisili->CurrentValue = HtmlDecode($this->rw_domisili->CurrentValue);
        }
        $this->rw_domisili->EditValue = $this->rw_domisili->CurrentValue;
        $this->rw_domisili->PlaceHolder = RemoveHtml($this->rw_domisili->caption());

        // kel_desa_domisili
        $this->kel_desa_domisili->EditAttrs["class"] = "form-control";
        $this->kel_desa_domisili->EditCustomAttributes = "";
        if (!$this->kel_desa_domisili->Raw) {
            $this->kel_desa_domisili->CurrentValue = HtmlDecode($this->kel_desa_domisili->CurrentValue);
        }
        $this->kel_desa_domisili->EditValue = $this->kel_desa_domisili->CurrentValue;
        $this->kel_desa_domisili->PlaceHolder = RemoveHtml($this->kel_desa_domisili->caption());

        // kec_domisili
        $this->kec_domisili->EditAttrs["class"] = "form-control";
        $this->kec_domisili->EditCustomAttributes = "";
        if (!$this->kec_domisili->Raw) {
            $this->kec_domisili->CurrentValue = HtmlDecode($this->kec_domisili->CurrentValue);
        }
        $this->kec_domisili->EditValue = $this->kec_domisili->CurrentValue;
        $this->kec_domisili->PlaceHolder = RemoveHtml($this->kec_domisili->caption());

        // kota_kab_domisili
        $this->kota_kab_domisili->EditAttrs["class"] = "form-control";
        $this->kota_kab_domisili->EditCustomAttributes = "";
        if (!$this->kota_kab_domisili->Raw) {
            $this->kota_kab_domisili->CurrentValue = HtmlDecode($this->kota_kab_domisili->CurrentValue);
        }
        $this->kota_kab_domisili->EditValue = $this->kota_kab_domisili->CurrentValue;
        $this->kota_kab_domisili->PlaceHolder = RemoveHtml($this->kota_kab_domisili->caption());

        // kodepos_domisili
        $this->kodepos_domisili->EditAttrs["class"] = "form-control";
        $this->kodepos_domisili->EditCustomAttributes = "";
        if (!$this->kodepos_domisili->Raw) {
            $this->kodepos_domisili->CurrentValue = HtmlDecode($this->kodepos_domisili->CurrentValue);
        }
        $this->kodepos_domisili->EditValue = $this->kodepos_domisili->CurrentValue;
        $this->kodepos_domisili->PlaceHolder = RemoveHtml($this->kodepos_domisili->caption());

        // prov_domisili
        $this->prov_domisili->EditAttrs["class"] = "form-control";
        $this->prov_domisili->EditCustomAttributes = "";
        if (!$this->prov_domisili->Raw) {
            $this->prov_domisili->CurrentValue = HtmlDecode($this->prov_domisili->CurrentValue);
        }
        $this->prov_domisili->EditValue = $this->prov_domisili->CurrentValue;
        $this->prov_domisili->PlaceHolder = RemoveHtml($this->prov_domisili->caption());

        // negara_domisili
        $this->negara_domisili->EditAttrs["class"] = "form-control";
        $this->negara_domisili->EditCustomAttributes = "";
        if (!$this->negara_domisili->Raw) {
            $this->negara_domisili->CurrentValue = HtmlDecode($this->negara_domisili->CurrentValue);
        }
        $this->negara_domisili->EditValue = $this->negara_domisili->CurrentValue;
        $this->negara_domisili->PlaceHolder = RemoveHtml($this->negara_domisili->caption());

        // no_telp
        $this->no_telp->EditAttrs["class"] = "form-control";
        $this->no_telp->EditCustomAttributes = "";
        $this->no_telp->EditValue = $this->no_telp->CurrentValue;
        $this->no_telp->PlaceHolder = RemoveHtml($this->no_telp->caption());

        // no_hp
        $this->no_hp->EditAttrs["class"] = "form-control";
        $this->no_hp->EditCustomAttributes = "";
        $this->no_hp->EditValue = $this->no_hp->CurrentValue;
        $this->no_hp->PlaceHolder = RemoveHtml($this->no_hp->caption());

        // pendidikan
        $this->pendidikan->EditAttrs["class"] = "form-control";
        $this->pendidikan->EditCustomAttributes = "";
        $this->pendidikan->EditValue = $this->pendidikan->CurrentValue;
        $this->pendidikan->PlaceHolder = RemoveHtml($this->pendidikan->caption());

        // pekerjaan
        $this->pekerjaan->EditAttrs["class"] = "form-control";
        $this->pekerjaan->EditCustomAttributes = "";
        $this->pekerjaan->EditValue = $this->pekerjaan->CurrentValue;
        $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

        // status_kawin
        $this->status_kawin->EditAttrs["class"] = "form-control";
        $this->status_kawin->EditCustomAttributes = "";
        $this->status_kawin->EditValue = $this->status_kawin->CurrentValue;
        $this->status_kawin->PlaceHolder = RemoveHtml($this->status_kawin->caption());

        // tgl_daftar
        $this->tgl_daftar->EditAttrs["class"] = "form-control";
        $this->tgl_daftar->EditCustomAttributes = "";
        $this->tgl_daftar->EditValue = FormatDateTime($this->tgl_daftar->CurrentValue, 8);
        $this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

        // username
        $this->_username->EditAttrs["class"] = "form-control";
        $this->_username->EditCustomAttributes = "";
        if (!$this->_username->Raw) {
            $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
        }
        $this->_username->EditValue = $this->_username->CurrentValue;
        $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id_pasien);
                    $doc->exportCaption($this->nama_pasien);
                    $doc->exportCaption($this->no_rekam_medis);
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->no_identitas_lain);
                    $doc->exportCaption($this->nama_ibu);
                    $doc->exportCaption($this->tempat_lahir);
                    $doc->exportCaption($this->tanggal_lahir);
                    $doc->exportCaption($this->jenis_kelamin);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->suku);
                    $doc->exportCaption($this->bahasa);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->rt);
                    $doc->exportCaption($this->rw);
                    $doc->exportCaption($this->keluarahan_desa);
                    $doc->exportCaption($this->kecamatan);
                    $doc->exportCaption($this->kabupaten_kota);
                    $doc->exportCaption($this->kodepos);
                    $doc->exportCaption($this->provinsi);
                    $doc->exportCaption($this->negara);
                    $doc->exportCaption($this->alamat_domisili);
                    $doc->exportCaption($this->rt_domisili);
                    $doc->exportCaption($this->rw_domisili);
                    $doc->exportCaption($this->kel_desa_domisili);
                    $doc->exportCaption($this->kec_domisili);
                    $doc->exportCaption($this->kota_kab_domisili);
                    $doc->exportCaption($this->kodepos_domisili);
                    $doc->exportCaption($this->prov_domisili);
                    $doc->exportCaption($this->negara_domisili);
                    $doc->exportCaption($this->no_telp);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->status_kawin);
                    $doc->exportCaption($this->tgl_daftar);
                    $doc->exportCaption($this->_username);
                } else {
                    $doc->exportCaption($this->id_pasien);
                    $doc->exportCaption($this->nama_pasien);
                    $doc->exportCaption($this->no_rekam_medis);
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->no_identitas_lain);
                    $doc->exportCaption($this->nama_ibu);
                    $doc->exportCaption($this->tempat_lahir);
                    $doc->exportCaption($this->tanggal_lahir);
                    $doc->exportCaption($this->jenis_kelamin);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->suku);
                    $doc->exportCaption($this->bahasa);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->rt);
                    $doc->exportCaption($this->rw);
                    $doc->exportCaption($this->keluarahan_desa);
                    $doc->exportCaption($this->kecamatan);
                    $doc->exportCaption($this->kabupaten_kota);
                    $doc->exportCaption($this->kodepos);
                    $doc->exportCaption($this->provinsi);
                    $doc->exportCaption($this->negara);
                    $doc->exportCaption($this->alamat_domisili);
                    $doc->exportCaption($this->rt_domisili);
                    $doc->exportCaption($this->rw_domisili);
                    $doc->exportCaption($this->kel_desa_domisili);
                    $doc->exportCaption($this->kec_domisili);
                    $doc->exportCaption($this->kota_kab_domisili);
                    $doc->exportCaption($this->kodepos_domisili);
                    $doc->exportCaption($this->prov_domisili);
                    $doc->exportCaption($this->negara_domisili);
                    $doc->exportCaption($this->no_telp);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->status_kawin);
                    $doc->exportCaption($this->tgl_daftar);
                    $doc->exportCaption($this->_username);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id_pasien);
                        $doc->exportField($this->nama_pasien);
                        $doc->exportField($this->no_rekam_medis);
                        $doc->exportField($this->nik);
                        $doc->exportField($this->no_identitas_lain);
                        $doc->exportField($this->nama_ibu);
                        $doc->exportField($this->tempat_lahir);
                        $doc->exportField($this->tanggal_lahir);
                        $doc->exportField($this->jenis_kelamin);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->suku);
                        $doc->exportField($this->bahasa);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->rt);
                        $doc->exportField($this->rw);
                        $doc->exportField($this->keluarahan_desa);
                        $doc->exportField($this->kecamatan);
                        $doc->exportField($this->kabupaten_kota);
                        $doc->exportField($this->kodepos);
                        $doc->exportField($this->provinsi);
                        $doc->exportField($this->negara);
                        $doc->exportField($this->alamat_domisili);
                        $doc->exportField($this->rt_domisili);
                        $doc->exportField($this->rw_domisili);
                        $doc->exportField($this->kel_desa_domisili);
                        $doc->exportField($this->kec_domisili);
                        $doc->exportField($this->kota_kab_domisili);
                        $doc->exportField($this->kodepos_domisili);
                        $doc->exportField($this->prov_domisili);
                        $doc->exportField($this->negara_domisili);
                        $doc->exportField($this->no_telp);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->status_kawin);
                        $doc->exportField($this->tgl_daftar);
                        $doc->exportField($this->_username);
                    } else {
                        $doc->exportField($this->id_pasien);
                        $doc->exportField($this->nama_pasien);
                        $doc->exportField($this->no_rekam_medis);
                        $doc->exportField($this->nik);
                        $doc->exportField($this->no_identitas_lain);
                        $doc->exportField($this->nama_ibu);
                        $doc->exportField($this->tempat_lahir);
                        $doc->exportField($this->tanggal_lahir);
                        $doc->exportField($this->jenis_kelamin);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->suku);
                        $doc->exportField($this->bahasa);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->rt);
                        $doc->exportField($this->rw);
                        $doc->exportField($this->keluarahan_desa);
                        $doc->exportField($this->kecamatan);
                        $doc->exportField($this->kabupaten_kota);
                        $doc->exportField($this->kodepos);
                        $doc->exportField($this->provinsi);
                        $doc->exportField($this->negara);
                        $doc->exportField($this->alamat_domisili);
                        $doc->exportField($this->rt_domisili);
                        $doc->exportField($this->rw_domisili);
                        $doc->exportField($this->kel_desa_domisili);
                        $doc->exportField($this->kec_domisili);
                        $doc->exportField($this->kota_kab_domisili);
                        $doc->exportField($this->kodepos_domisili);
                        $doc->exportField($this->prov_domisili);
                        $doc->exportField($this->negara_domisili);
                        $doc->exportField($this->no_telp);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->status_kawin);
                        $doc->exportField($this->tgl_daftar);
                        $doc->exportField($this->_username);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
