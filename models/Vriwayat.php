<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for vriwayat
 */
class Vriwayat extends DbTable
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
    public $no_rkm_medis;
    public $nm_pasien;
    public $no_ktp;
    public $jk;
    public $tmp_lahir;
    public $tgl_lahir;
    public $nm_ibu;
    public $alamat;
    public $gol_darah;
    public $pekerjaan;
    public $stts_nikah;
    public $agama;
    public $tgl_daftar;
    public $no_tlp;
    public $umur;
    public $pnd;
    public $keluarga;
    public $namakeluarga;
    public $kd_pj;
    public $no_peserta;
    public $kd_kel;
    public $kd_kec;
    public $kd_kab;
    public $pekerjaanpj;
    public $alamatpj;
    public $kelurahanpj;
    public $kecamatanpj;
    public $kabupatenpj;
    public $perusahaan_pasien;
    public $suku_bangsa;
    public $bahasa_pasien;
    public $cacat_fisik;
    public $_email;
    public $nip;
    public $kd_prop;
    public $propinsipj;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'vriwayat';
        $this->TableName = 'vriwayat';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "pasien";
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
        $this->id_pasien = new DbField('vriwayat', 'vriwayat', 'x_id_pasien', 'id_pasien', '`id_pasien`', '`id_pasien`', 3, 255, -1, false, '`id_pasien`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_pasien->IsAutoIncrement = true; // Autoincrement field
        $this->id_pasien->Sortable = true; // Allow sort
        $this->id_pasien->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_pasien->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_pasien->Param, "CustomMsg");
        $this->Fields['id_pasien'] = &$this->id_pasien;

        // no_rkm_medis
        $this->no_rkm_medis = new DbField('vriwayat', 'vriwayat', 'x_no_rkm_medis', 'no_rkm_medis', '`no_rkm_medis`', '`no_rkm_medis`', 200, 15, -1, false, '`no_rkm_medis`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rkm_medis->IsForeignKey = true; // Foreign key field
        $this->no_rkm_medis->Required = true; // Required field
        $this->no_rkm_medis->Sortable = true; // Allow sort
        $this->no_rkm_medis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rkm_medis->Param, "CustomMsg");
        $this->Fields['no_rkm_medis'] = &$this->no_rkm_medis;

        // nm_pasien
        $this->nm_pasien = new DbField('vriwayat', 'vriwayat', 'x_nm_pasien', 'nm_pasien', '`nm_pasien`', '`nm_pasien`', 200, 40, -1, false, '`nm_pasien`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nm_pasien->Sortable = true; // Allow sort
        $this->nm_pasien->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nm_pasien->Param, "CustomMsg");
        $this->Fields['nm_pasien'] = &$this->nm_pasien;

        // no_ktp
        $this->no_ktp = new DbField('vriwayat', 'vriwayat', 'x_no_ktp', 'no_ktp', '`no_ktp`', '`no_ktp`', 200, 20, -1, false, '`no_ktp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_ktp->Required = true; // Required field
        $this->no_ktp->Sortable = true; // Allow sort
        $this->no_ktp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_ktp->Param, "CustomMsg");
        $this->Fields['no_ktp'] = &$this->no_ktp;

        // jk
        $this->jk = new DbField('vriwayat', 'vriwayat', 'x_jk', 'jk', '`jk`', '`jk`', 202, 1, -1, false, '`jk`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->jk->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->jk->Lookup = new Lookup('jk', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->jk->Lookup = new Lookup('jk', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->jk->OptionCount = 2;
        $this->jk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jk->Param, "CustomMsg");
        $this->Fields['jk'] = &$this->jk;

        // tmp_lahir
        $this->tmp_lahir = new DbField('vriwayat', 'vriwayat', 'x_tmp_lahir', 'tmp_lahir', '`tmp_lahir`', '`tmp_lahir`', 200, 15, -1, false, '`tmp_lahir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tmp_lahir->Sortable = true; // Allow sort
        $this->tmp_lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tmp_lahir->Param, "CustomMsg");
        $this->Fields['tmp_lahir'] = &$this->tmp_lahir;

        // tgl_lahir
        $this->tgl_lahir = new DbField('vriwayat', 'vriwayat', 'x_tgl_lahir', 'tgl_lahir', '`tgl_lahir`', CastDateFieldForLike("`tgl_lahir`", 0, "DB"), 133, 10, 0, false, '`tgl_lahir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_lahir->Sortable = true; // Allow sort
        $this->tgl_lahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_lahir->Param, "CustomMsg");
        $this->Fields['tgl_lahir'] = &$this->tgl_lahir;

        // nm_ibu
        $this->nm_ibu = new DbField('vriwayat', 'vriwayat', 'x_nm_ibu', 'nm_ibu', '`nm_ibu`', '`nm_ibu`', 200, 40, -1, false, '`nm_ibu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nm_ibu->Required = true; // Required field
        $this->nm_ibu->Sortable = true; // Allow sort
        $this->nm_ibu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nm_ibu->Param, "CustomMsg");
        $this->Fields['nm_ibu'] = &$this->nm_ibu;

        // alamat
        $this->alamat = new DbField('vriwayat', 'vriwayat', 'x_alamat', 'alamat', '`alamat`', '`alamat`', 200, 200, -1, false, '`alamat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat->Sortable = true; // Allow sort
        $this->alamat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat->Param, "CustomMsg");
        $this->Fields['alamat'] = &$this->alamat;

        // gol_darah
        $this->gol_darah = new DbField('vriwayat', 'vriwayat', 'x_gol_darah', 'gol_darah', '`gol_darah`', '`gol_darah`', 202, 2, -1, false, '`gol_darah`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->gol_darah->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->gol_darah->Lookup = new Lookup('gol_darah', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->gol_darah->Lookup = new Lookup('gol_darah', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->gol_darah->OptionCount = 5;
        $this->gol_darah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gol_darah->Param, "CustomMsg");
        $this->Fields['gol_darah'] = &$this->gol_darah;

        // pekerjaan
        $this->pekerjaan = new DbField('vriwayat', 'vriwayat', 'x_pekerjaan', 'pekerjaan', '`pekerjaan`', '`pekerjaan`', 200, 60, -1, false, '`pekerjaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pekerjaan->Sortable = true; // Allow sort
        $this->pekerjaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pekerjaan->Param, "CustomMsg");
        $this->Fields['pekerjaan'] = &$this->pekerjaan;

        // stts_nikah
        $this->stts_nikah = new DbField('vriwayat', 'vriwayat', 'x_stts_nikah', 'stts_nikah', '`stts_nikah`', '`stts_nikah`', 202, 13, -1, false, '`stts_nikah`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->stts_nikah->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->stts_nikah->Lookup = new Lookup('stts_nikah', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->stts_nikah->Lookup = new Lookup('stts_nikah', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->stts_nikah->OptionCount = 5;
        $this->stts_nikah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->stts_nikah->Param, "CustomMsg");
        $this->Fields['stts_nikah'] = &$this->stts_nikah;

        // agama
        $this->agama = new DbField('vriwayat', 'vriwayat', 'x_agama', 'agama', '`agama`', '`agama`', 3, 2, -1, false, '`agama`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->agama->Sortable = true; // Allow sort
        $this->agama->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->agama->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->agama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->agama->Param, "CustomMsg");
        $this->Fields['agama'] = &$this->agama;

        // tgl_daftar
        $this->tgl_daftar = new DbField('vriwayat', 'vriwayat', 'x_tgl_daftar', 'tgl_daftar', '`tgl_daftar`', CastDateFieldForLike("`tgl_daftar`", 0, "DB"), 133, 10, 0, false, '`tgl_daftar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_daftar->Sortable = true; // Allow sort
        $this->tgl_daftar->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_daftar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_daftar->Param, "CustomMsg");
        $this->Fields['tgl_daftar'] = &$this->tgl_daftar;

        // no_tlp
        $this->no_tlp = new DbField('vriwayat', 'vriwayat', 'x_no_tlp', 'no_tlp', '`no_tlp`', '`no_tlp`', 200, 40, -1, false, '`no_tlp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_tlp->Sortable = true; // Allow sort
        $this->no_tlp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_tlp->Param, "CustomMsg");
        $this->Fields['no_tlp'] = &$this->no_tlp;

        // umur
        $this->umur = new DbField('vriwayat', 'vriwayat', 'x_umur', 'umur', '`umur`', '`umur`', 200, 30, -1, false, '`umur`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->umur->Required = true; // Required field
        $this->umur->Sortable = true; // Allow sort
        $this->umur->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->umur->Param, "CustomMsg");
        $this->Fields['umur'] = &$this->umur;

        // pnd
        $this->pnd = new DbField('vriwayat', 'vriwayat', 'x_pnd', 'pnd', '`pnd`', '`pnd`', 202, 14, -1, false, '`pnd`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->pnd->Required = true; // Required field
        $this->pnd->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->pnd->Lookup = new Lookup('pnd', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->pnd->Lookup = new Lookup('pnd', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->pnd->OptionCount = 14;
        $this->pnd->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pnd->Param, "CustomMsg");
        $this->Fields['pnd'] = &$this->pnd;

        // keluarga
        $this->keluarga = new DbField('vriwayat', 'vriwayat', 'x_keluarga', 'keluarga', '`keluarga`', '`keluarga`', 202, 7, -1, false, '`keluarga`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->keluarga->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->keluarga->Lookup = new Lookup('keluarga', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->keluarga->Lookup = new Lookup('keluarga', 'vriwayat', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->keluarga->OptionCount = 6;
        $this->keluarga->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keluarga->Param, "CustomMsg");
        $this->Fields['keluarga'] = &$this->keluarga;

        // namakeluarga
        $this->namakeluarga = new DbField('vriwayat', 'vriwayat', 'x_namakeluarga', 'namakeluarga', '`namakeluarga`', '`namakeluarga`', 200, 50, -1, false, '`namakeluarga`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->namakeluarga->Required = true; // Required field
        $this->namakeluarga->Sortable = true; // Allow sort
        $this->namakeluarga->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->namakeluarga->Param, "CustomMsg");
        $this->Fields['namakeluarga'] = &$this->namakeluarga;

        // kd_pj
        $this->kd_pj = new DbField('vriwayat', 'vriwayat', 'x_kd_pj', 'kd_pj', '`kd_pj`', '`kd_pj`', 200, 3, -1, false, '`kd_pj`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_pj->Required = true; // Required field
        $this->kd_pj->Sortable = true; // Allow sort
        $this->kd_pj->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_pj->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_pj->Lookup = new Lookup('kd_pj', 'penjab', false, 'kd_pj', ["png_jawab","nama_perusahaan","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_pj->Lookup = new Lookup('kd_pj', 'penjab', false, 'kd_pj', ["png_jawab","nama_perusahaan","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_pj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_pj->Param, "CustomMsg");
        $this->Fields['kd_pj'] = &$this->kd_pj;

        // no_peserta
        $this->no_peserta = new DbField('vriwayat', 'vriwayat', 'x_no_peserta', 'no_peserta', '`no_peserta`', '`no_peserta`', 200, 25, -1, false, '`no_peserta`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_peserta->Sortable = true; // Allow sort
        $this->no_peserta->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_peserta->Param, "CustomMsg");
        $this->Fields['no_peserta'] = &$this->no_peserta;

        // kd_kel
        $this->kd_kel = new DbField('vriwayat', 'vriwayat', 'x_kd_kel', 'kd_kel', '`kd_kel`', '`kd_kel`', 3, 11, -1, false, '`kd_kel`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_kel->Required = true; // Required field
        $this->kd_kel->Sortable = true; // Allow sort
        $this->kd_kel->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_kel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_kel->Lookup = new Lookup('kd_kel', 'kelurahan', false, 'kd_kel', ["nm_kel","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_kel->Lookup = new Lookup('kd_kel', 'kelurahan', false, 'kd_kel', ["nm_kel","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_kel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kd_kel->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_kel->Param, "CustomMsg");
        $this->Fields['kd_kel'] = &$this->kd_kel;

        // kd_kec
        $this->kd_kec = new DbField('vriwayat', 'vriwayat', 'x_kd_kec', 'kd_kec', '`kd_kec`', '`kd_kec`', 3, 11, -1, false, '`kd_kec`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_kec->Required = true; // Required field
        $this->kd_kec->Sortable = true; // Allow sort
        $this->kd_kec->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_kec->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_kec->Lookup = new Lookup('kd_kec', 'kecamatan', false, 'kd_kec', ["nm_kec","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_kec->Lookup = new Lookup('kd_kec', 'kecamatan', false, 'kd_kec', ["nm_kec","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_kec->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kd_kec->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_kec->Param, "CustomMsg");
        $this->Fields['kd_kec'] = &$this->kd_kec;

        // kd_kab
        $this->kd_kab = new DbField('vriwayat', 'vriwayat', 'x_kd_kab', 'kd_kab', '`kd_kab`', '`kd_kab`', 3, 11, -1, false, '`kd_kab`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_kab->Required = true; // Required field
        $this->kd_kab->Sortable = true; // Allow sort
        $this->kd_kab->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_kab->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_kab->Lookup = new Lookup('kd_kab', 'kabupaten', false, 'kd_kab', ["nm_kab","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_kab->Lookup = new Lookup('kd_kab', 'kabupaten', false, 'kd_kab', ["nm_kab","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_kab->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kd_kab->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_kab->Param, "CustomMsg");
        $this->Fields['kd_kab'] = &$this->kd_kab;

        // pekerjaanpj
        $this->pekerjaanpj = new DbField('vriwayat', 'vriwayat', 'x_pekerjaanpj', 'pekerjaanpj', '`pekerjaanpj`', '`pekerjaanpj`', 200, 35, -1, false, '`pekerjaanpj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pekerjaanpj->Required = true; // Required field
        $this->pekerjaanpj->Sortable = true; // Allow sort
        $this->pekerjaanpj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pekerjaanpj->Param, "CustomMsg");
        $this->Fields['pekerjaanpj'] = &$this->pekerjaanpj;

        // alamatpj
        $this->alamatpj = new DbField('vriwayat', 'vriwayat', 'x_alamatpj', 'alamatpj', '`alamatpj`', '`alamatpj`', 200, 100, -1, false, '`alamatpj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamatpj->Required = true; // Required field
        $this->alamatpj->Sortable = true; // Allow sort
        $this->alamatpj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamatpj->Param, "CustomMsg");
        $this->Fields['alamatpj'] = &$this->alamatpj;

        // kelurahanpj
        $this->kelurahanpj = new DbField('vriwayat', 'vriwayat', 'x_kelurahanpj', 'kelurahanpj', '`kelurahanpj`', '`kelurahanpj`', 200, 60, -1, false, '`kelurahanpj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kelurahanpj->Required = true; // Required field
        $this->kelurahanpj->Sortable = true; // Allow sort
        $this->kelurahanpj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kelurahanpj->Param, "CustomMsg");
        $this->Fields['kelurahanpj'] = &$this->kelurahanpj;

        // kecamatanpj
        $this->kecamatanpj = new DbField('vriwayat', 'vriwayat', 'x_kecamatanpj', 'kecamatanpj', '`kecamatanpj`', '`kecamatanpj`', 200, 60, -1, false, '`kecamatanpj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kecamatanpj->Required = true; // Required field
        $this->kecamatanpj->Sortable = true; // Allow sort
        $this->kecamatanpj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kecamatanpj->Param, "CustomMsg");
        $this->Fields['kecamatanpj'] = &$this->kecamatanpj;

        // kabupatenpj
        $this->kabupatenpj = new DbField('vriwayat', 'vriwayat', 'x_kabupatenpj', 'kabupatenpj', '`kabupatenpj`', '`kabupatenpj`', 200, 60, -1, false, '`kabupatenpj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kabupatenpj->Required = true; // Required field
        $this->kabupatenpj->Sortable = true; // Allow sort
        $this->kabupatenpj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kabupatenpj->Param, "CustomMsg");
        $this->Fields['kabupatenpj'] = &$this->kabupatenpj;

        // perusahaan_pasien
        $this->perusahaan_pasien = new DbField('vriwayat', 'vriwayat', 'x_perusahaan_pasien', 'perusahaan_pasien', '`perusahaan_pasien`', '`perusahaan_pasien`', 200, 8, -1, false, '`perusahaan_pasien`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->perusahaan_pasien->Required = true; // Required field
        $this->perusahaan_pasien->Sortable = true; // Allow sort
        $this->perusahaan_pasien->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->perusahaan_pasien->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->perusahaan_pasien->Lookup = new Lookup('perusahaan_pasien', 'perusahaan_pasien', false, 'kode_perusahaan', ["nama_perusahaan","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->perusahaan_pasien->Lookup = new Lookup('perusahaan_pasien', 'perusahaan_pasien', false, 'kode_perusahaan', ["nama_perusahaan","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->perusahaan_pasien->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->perusahaan_pasien->Param, "CustomMsg");
        $this->Fields['perusahaan_pasien'] = &$this->perusahaan_pasien;

        // suku_bangsa
        $this->suku_bangsa = new DbField('vriwayat', 'vriwayat', 'x_suku_bangsa', 'suku_bangsa', '`suku_bangsa`', '`suku_bangsa`', 3, 11, -1, false, '`suku_bangsa`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->suku_bangsa->Nullable = false; // NOT NULL field
        $this->suku_bangsa->Required = true; // Required field
        $this->suku_bangsa->Sortable = true; // Allow sort
        $this->suku_bangsa->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->suku_bangsa->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->suku_bangsa->Lookup = new Lookup('suku_bangsa', 'suku_bangsa', false, 'id', ["nama_suku_bangsa","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->suku_bangsa->Lookup = new Lookup('suku_bangsa', 'suku_bangsa', false, 'id', ["nama_suku_bangsa","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->suku_bangsa->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->suku_bangsa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->suku_bangsa->Param, "CustomMsg");
        $this->Fields['suku_bangsa'] = &$this->suku_bangsa;

        // bahasa_pasien
        $this->bahasa_pasien = new DbField('vriwayat', 'vriwayat', 'x_bahasa_pasien', 'bahasa_pasien', '`bahasa_pasien`', '`bahasa_pasien`', 3, 11, -1, false, '`bahasa_pasien`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->bahasa_pasien->Nullable = false; // NOT NULL field
        $this->bahasa_pasien->Required = true; // Required field
        $this->bahasa_pasien->Sortable = true; // Allow sort
        $this->bahasa_pasien->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->bahasa_pasien->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->bahasa_pasien->Lookup = new Lookup('bahasa_pasien', 'bahasa_pasien', false, 'id', ["nama_bahasa","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->bahasa_pasien->Lookup = new Lookup('bahasa_pasien', 'bahasa_pasien', false, 'id', ["nama_bahasa","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->bahasa_pasien->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bahasa_pasien->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bahasa_pasien->Param, "CustomMsg");
        $this->Fields['bahasa_pasien'] = &$this->bahasa_pasien;

        // cacat_fisik
        $this->cacat_fisik = new DbField('vriwayat', 'vriwayat', 'x_cacat_fisik', 'cacat_fisik', '`cacat_fisik`', '`cacat_fisik`', 3, 11, -1, false, '`cacat_fisik`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->cacat_fisik->Nullable = false; // NOT NULL field
        $this->cacat_fisik->Required = true; // Required field
        $this->cacat_fisik->Sortable = true; // Allow sort
        $this->cacat_fisik->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->cacat_fisik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->cacat_fisik->Lookup = new Lookup('cacat_fisik', 'cacat_fisik', false, 'id', ["nama_cacat","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->cacat_fisik->Lookup = new Lookup('cacat_fisik', 'cacat_fisik', false, 'id', ["nama_cacat","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->cacat_fisik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->cacat_fisik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->cacat_fisik->Param, "CustomMsg");
        $this->Fields['cacat_fisik'] = &$this->cacat_fisik;

        // email
        $this->_email = new DbField('vriwayat', 'vriwayat', 'x__email', 'email', '`email`', '`email`', 200, 50, -1, false, '`email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_email->Nullable = false; // NOT NULL field
        $this->_email->Required = true; // Required field
        $this->_email->Sortable = true; // Allow sort
        $this->_email->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_email->Param, "CustomMsg");
        $this->Fields['email'] = &$this->_email;

        // nip
        $this->nip = new DbField('vriwayat', 'vriwayat', 'x_nip', 'nip', '`nip`', '`nip`', 200, 30, -1, false, '`nip`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nip->Nullable = false; // NOT NULL field
        $this->nip->Required = true; // Required field
        $this->nip->Sortable = true; // Allow sort
        $this->nip->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nip->Param, "CustomMsg");
        $this->Fields['nip'] = &$this->nip;

        // kd_prop
        $this->kd_prop = new DbField('vriwayat', 'vriwayat', 'x_kd_prop', 'kd_prop', '`kd_prop`', '`kd_prop`', 3, 11, -1, false, '`kd_prop`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_prop->Nullable = false; // NOT NULL field
        $this->kd_prop->Required = true; // Required field
        $this->kd_prop->Sortable = true; // Allow sort
        $this->kd_prop->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_prop->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_prop->Lookup = new Lookup('kd_prop', 'propinsi', false, 'kd_prop', ["nm_prop","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_prop->Lookup = new Lookup('kd_prop', 'propinsi', false, 'kd_prop', ["nm_prop","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_prop->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kd_prop->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_prop->Param, "CustomMsg");
        $this->Fields['kd_prop'] = &$this->kd_prop;

        // propinsipj
        $this->propinsipj = new DbField('vriwayat', 'vriwayat', 'x_propinsipj', 'propinsipj', '`propinsipj`', '`propinsipj`', 200, 30, -1, false, '`propinsipj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->propinsipj->Nullable = false; // NOT NULL field
        $this->propinsipj->Required = true; // Required field
        $this->propinsipj->Sortable = true; // Allow sort
        $this->propinsipj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->propinsipj->Param, "CustomMsg");
        $this->Fields['propinsipj'] = &$this->propinsipj;
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

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE"));
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "pasien_kunjungan") {
            $detailUrl = Container("pasien_kunjungan")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_no_rkm_medis", $this->no_rkm_medis->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "VriwayatList";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "pasien";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("pasien.*");
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
        // Cascade Update detail table 'pasien_kunjungan'
        $cascadeUpdate = false;
        $rscascade = [];
        if ($rsold && (isset($rs['no_rkm_medis']) && $rsold['no_rkm_medis'] != $rs['no_rkm_medis'])) { // Update detail field 'no_rkm_medis'
            $cascadeUpdate = true;
            $rscascade['no_rkm_medis'] = $rs['no_rkm_medis'];
        }
        if ($cascadeUpdate) {
            $rswrk = Container("pasien_kunjungan")->loadRs("`no_rkm_medis` = " . QuotedValue($rsold['no_rkm_medis'], DATATYPE_STRING, 'DB'))->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($rswrk as $rsdtlold) {
                $rskey = [];
                $fldname = 'id_reg';
                $rskey[$fldname] = $rsdtlold[$fldname];
                $rsdtlnew = array_merge($rsdtlold, $rscascade);
                // Call Row_Updating event
                $success = Container("pasien_kunjungan")->rowUpdating($rsdtlold, $rsdtlnew);
                if ($success) {
                    $success = Container("pasien_kunjungan")->update($rscascade, $rskey, $rsdtlold);
                }
                if (!$success) {
                    return false;
                }
                // Call Row_Updated event
                Container("pasien_kunjungan")->rowUpdated($rsdtlold, $rsdtlnew);
            }
        }

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
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;

        // Cascade delete detail table 'pasien_kunjungan'
        $dtlrows = Container("pasien_kunjungan")->loadRs("`no_rkm_medis` = " . QuotedValue($rs['no_rkm_medis'], DATATYPE_STRING, "DB"))->fetchAll(\PDO::FETCH_ASSOC);
        // Call Row Deleting event
        foreach ($dtlrows as $dtlrow) {
            $success = Container("pasien_kunjungan")->rowDeleting($dtlrow);
            if (!$success) {
                break;
            }
        }
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                $success = Container("pasien_kunjungan")->delete($dtlrow); // Delete
                if (!$success) {
                    break;
                }
            }
        }
        // Call Row Deleted event
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                Container("pasien_kunjungan")->rowDeleted($dtlrow);
            }
        }
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
        $this->no_rkm_medis->DbValue = $row['no_rkm_medis'];
        $this->nm_pasien->DbValue = $row['nm_pasien'];
        $this->no_ktp->DbValue = $row['no_ktp'];
        $this->jk->DbValue = $row['jk'];
        $this->tmp_lahir->DbValue = $row['tmp_lahir'];
        $this->tgl_lahir->DbValue = $row['tgl_lahir'];
        $this->nm_ibu->DbValue = $row['nm_ibu'];
        $this->alamat->DbValue = $row['alamat'];
        $this->gol_darah->DbValue = $row['gol_darah'];
        $this->pekerjaan->DbValue = $row['pekerjaan'];
        $this->stts_nikah->DbValue = $row['stts_nikah'];
        $this->agama->DbValue = $row['agama'];
        $this->tgl_daftar->DbValue = $row['tgl_daftar'];
        $this->no_tlp->DbValue = $row['no_tlp'];
        $this->umur->DbValue = $row['umur'];
        $this->pnd->DbValue = $row['pnd'];
        $this->keluarga->DbValue = $row['keluarga'];
        $this->namakeluarga->DbValue = $row['namakeluarga'];
        $this->kd_pj->DbValue = $row['kd_pj'];
        $this->no_peserta->DbValue = $row['no_peserta'];
        $this->kd_kel->DbValue = $row['kd_kel'];
        $this->kd_kec->DbValue = $row['kd_kec'];
        $this->kd_kab->DbValue = $row['kd_kab'];
        $this->pekerjaanpj->DbValue = $row['pekerjaanpj'];
        $this->alamatpj->DbValue = $row['alamatpj'];
        $this->kelurahanpj->DbValue = $row['kelurahanpj'];
        $this->kecamatanpj->DbValue = $row['kecamatanpj'];
        $this->kabupatenpj->DbValue = $row['kabupatenpj'];
        $this->perusahaan_pasien->DbValue = $row['perusahaan_pasien'];
        $this->suku_bangsa->DbValue = $row['suku_bangsa'];
        $this->bahasa_pasien->DbValue = $row['bahasa_pasien'];
        $this->cacat_fisik->DbValue = $row['cacat_fisik'];
        $this->_email->DbValue = $row['email'];
        $this->nip->DbValue = $row['nip'];
        $this->kd_prop->DbValue = $row['kd_prop'];
        $this->propinsipj->DbValue = $row['propinsipj'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("VriwayatList");
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
        if ($pageName == "VriwayatView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VriwayatEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VriwayatAdd") {
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
                return "VriwayatView";
            case Config("API_ADD_ACTION"):
                return "VriwayatAdd";
            case Config("API_EDIT_ACTION"):
                return "VriwayatEdit";
            case Config("API_DELETE_ACTION"):
                return "VriwayatDelete";
            case Config("API_LIST_ACTION"):
                return "VriwayatList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VriwayatList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VriwayatView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VriwayatView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VriwayatAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VriwayatAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("VriwayatEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("VriwayatAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("VriwayatDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
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
        $this->no_rkm_medis->setDbValue($row['no_rkm_medis']);
        $this->nm_pasien->setDbValue($row['nm_pasien']);
        $this->no_ktp->setDbValue($row['no_ktp']);
        $this->jk->setDbValue($row['jk']);
        $this->tmp_lahir->setDbValue($row['tmp_lahir']);
        $this->tgl_lahir->setDbValue($row['tgl_lahir']);
        $this->nm_ibu->setDbValue($row['nm_ibu']);
        $this->alamat->setDbValue($row['alamat']);
        $this->gol_darah->setDbValue($row['gol_darah']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->stts_nikah->setDbValue($row['stts_nikah']);
        $this->agama->setDbValue($row['agama']);
        $this->tgl_daftar->setDbValue($row['tgl_daftar']);
        $this->no_tlp->setDbValue($row['no_tlp']);
        $this->umur->setDbValue($row['umur']);
        $this->pnd->setDbValue($row['pnd']);
        $this->keluarga->setDbValue($row['keluarga']);
        $this->namakeluarga->setDbValue($row['namakeluarga']);
        $this->kd_pj->setDbValue($row['kd_pj']);
        $this->no_peserta->setDbValue($row['no_peserta']);
        $this->kd_kel->setDbValue($row['kd_kel']);
        $this->kd_kec->setDbValue($row['kd_kec']);
        $this->kd_kab->setDbValue($row['kd_kab']);
        $this->pekerjaanpj->setDbValue($row['pekerjaanpj']);
        $this->alamatpj->setDbValue($row['alamatpj']);
        $this->kelurahanpj->setDbValue($row['kelurahanpj']);
        $this->kecamatanpj->setDbValue($row['kecamatanpj']);
        $this->kabupatenpj->setDbValue($row['kabupatenpj']);
        $this->perusahaan_pasien->setDbValue($row['perusahaan_pasien']);
        $this->suku_bangsa->setDbValue($row['suku_bangsa']);
        $this->bahasa_pasien->setDbValue($row['bahasa_pasien']);
        $this->cacat_fisik->setDbValue($row['cacat_fisik']);
        $this->_email->setDbValue($row['email']);
        $this->nip->setDbValue($row['nip']);
        $this->kd_prop->setDbValue($row['kd_prop']);
        $this->propinsipj->setDbValue($row['propinsipj']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_pasien
        $this->id_pasien->CellCssStyle = "white-space: nowrap;";

        // no_rkm_medis
        $this->no_rkm_medis->CellCssStyle = "white-space: nowrap;";

        // nm_pasien
        $this->nm_pasien->CellCssStyle = "white-space: nowrap;";

        // no_ktp
        $this->no_ktp->CellCssStyle = "white-space: nowrap;";

        // jk
        $this->jk->CellCssStyle = "white-space: nowrap;";

        // tmp_lahir
        $this->tmp_lahir->CellCssStyle = "white-space: nowrap;";

        // tgl_lahir
        $this->tgl_lahir->CellCssStyle = "white-space: nowrap;";

        // nm_ibu
        $this->nm_ibu->CellCssStyle = "white-space: nowrap;";

        // alamat
        $this->alamat->CellCssStyle = "white-space: nowrap;";

        // gol_darah
        $this->gol_darah->CellCssStyle = "white-space: nowrap;";

        // pekerjaan
        $this->pekerjaan->CellCssStyle = "white-space: nowrap;";

        // stts_nikah
        $this->stts_nikah->CellCssStyle = "white-space: nowrap;";

        // agama
        $this->agama->CellCssStyle = "white-space: nowrap;";

        // tgl_daftar
        $this->tgl_daftar->CellCssStyle = "white-space: nowrap;";

        // no_tlp
        $this->no_tlp->CellCssStyle = "white-space: nowrap;";

        // umur
        $this->umur->CellCssStyle = "white-space: nowrap;";

        // pnd
        $this->pnd->CellCssStyle = "white-space: nowrap;";

        // keluarga
        $this->keluarga->CellCssStyle = "white-space: nowrap;";

        // namakeluarga
        $this->namakeluarga->CellCssStyle = "white-space: nowrap;";

        // kd_pj
        $this->kd_pj->CellCssStyle = "white-space: nowrap;";

        // no_peserta
        $this->no_peserta->CellCssStyle = "white-space: nowrap;";

        // kd_kel
        $this->kd_kel->CellCssStyle = "white-space: nowrap;";

        // kd_kec
        $this->kd_kec->CellCssStyle = "white-space: nowrap;";

        // kd_kab
        $this->kd_kab->CellCssStyle = "white-space: nowrap;";

        // pekerjaanpj
        $this->pekerjaanpj->CellCssStyle = "white-space: nowrap;";

        // alamatpj
        $this->alamatpj->CellCssStyle = "white-space: nowrap;";

        // kelurahanpj
        $this->kelurahanpj->CellCssStyle = "white-space: nowrap;";

        // kecamatanpj
        $this->kecamatanpj->CellCssStyle = "white-space: nowrap;";

        // kabupatenpj
        $this->kabupatenpj->CellCssStyle = "white-space: nowrap;";

        // perusahaan_pasien
        $this->perusahaan_pasien->CellCssStyle = "white-space: nowrap;";

        // suku_bangsa
        $this->suku_bangsa->CellCssStyle = "white-space: nowrap;";

        // bahasa_pasien
        $this->bahasa_pasien->CellCssStyle = "white-space: nowrap;";

        // cacat_fisik
        $this->cacat_fisik->CellCssStyle = "white-space: nowrap;";

        // email
        $this->_email->CellCssStyle = "white-space: nowrap;";

        // nip
        $this->nip->CellCssStyle = "white-space: nowrap;";

        // kd_prop
        $this->kd_prop->CellCssStyle = "white-space: nowrap;";

        // propinsipj
        $this->propinsipj->CellCssStyle = "white-space: nowrap;";

        // id_pasien
        $this->id_pasien->ViewValue = $this->id_pasien->CurrentValue;
        $this->id_pasien->ViewCustomAttributes = "";

        // no_rkm_medis
        $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->CurrentValue;
        $this->no_rkm_medis->ViewCustomAttributes = "";

        // nm_pasien
        $this->nm_pasien->ViewValue = $this->nm_pasien->CurrentValue;
        $this->nm_pasien->ViewCustomAttributes = "";

        // no_ktp
        $this->no_ktp->ViewValue = $this->no_ktp->CurrentValue;
        $this->no_ktp->ViewCustomAttributes = "";

        // jk
        if (strval($this->jk->CurrentValue) != "") {
            $this->jk->ViewValue = $this->jk->optionCaption($this->jk->CurrentValue);
        } else {
            $this->jk->ViewValue = null;
        }
        $this->jk->ViewCustomAttributes = "";

        // tmp_lahir
        $this->tmp_lahir->ViewValue = $this->tmp_lahir->CurrentValue;
        $this->tmp_lahir->ViewCustomAttributes = "";

        // tgl_lahir
        $this->tgl_lahir->ViewValue = $this->tgl_lahir->CurrentValue;
        $this->tgl_lahir->ViewValue = FormatDateTime($this->tgl_lahir->ViewValue, 0);
        $this->tgl_lahir->ViewCustomAttributes = "";

        // nm_ibu
        $this->nm_ibu->ViewValue = $this->nm_ibu->CurrentValue;
        $this->nm_ibu->ViewCustomAttributes = "";

        // alamat
        $this->alamat->ViewValue = $this->alamat->CurrentValue;
        $this->alamat->ViewCustomAttributes = "";

        // gol_darah
        if (strval($this->gol_darah->CurrentValue) != "") {
            $this->gol_darah->ViewValue = $this->gol_darah->optionCaption($this->gol_darah->CurrentValue);
        } else {
            $this->gol_darah->ViewValue = null;
        }
        $this->gol_darah->ViewCustomAttributes = "";

        // pekerjaan
        $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
        $this->pekerjaan->ViewCustomAttributes = "";

        // stts_nikah
        if (strval($this->stts_nikah->CurrentValue) != "") {
            $this->stts_nikah->ViewValue = $this->stts_nikah->optionCaption($this->stts_nikah->CurrentValue);
        } else {
            $this->stts_nikah->ViewValue = null;
        }
        $this->stts_nikah->ViewCustomAttributes = "";

        // agama
        $this->agama->ViewCustomAttributes = "";

        // tgl_daftar
        $this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
        $this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
        $this->tgl_daftar->ViewCustomAttributes = "";

        // no_tlp
        $this->no_tlp->ViewValue = $this->no_tlp->CurrentValue;
        $this->no_tlp->ViewCustomAttributes = "";

        // umur
        $this->umur->ViewValue = $this->umur->CurrentValue;
        $this->umur->ViewCustomAttributes = "";

        // pnd
        if (strval($this->pnd->CurrentValue) != "") {
            $this->pnd->ViewValue = $this->pnd->optionCaption($this->pnd->CurrentValue);
        } else {
            $this->pnd->ViewValue = null;
        }
        $this->pnd->ViewCustomAttributes = "";

        // keluarga
        if (strval($this->keluarga->CurrentValue) != "") {
            $this->keluarga->ViewValue = $this->keluarga->optionCaption($this->keluarga->CurrentValue);
        } else {
            $this->keluarga->ViewValue = null;
        }
        $this->keluarga->ViewCustomAttributes = "";

        // namakeluarga
        $this->namakeluarga->ViewValue = $this->namakeluarga->CurrentValue;
        $this->namakeluarga->ViewCustomAttributes = "";

        // kd_pj
        $curVal = trim(strval($this->kd_pj->CurrentValue));
        if ($curVal != "") {
            $this->kd_pj->ViewValue = $this->kd_pj->lookupCacheOption($curVal);
            if ($this->kd_pj->ViewValue === null) { // Lookup from database
                $filterWrk = "`kd_pj`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->kd_pj->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_pj->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_pj->ViewValue = $this->kd_pj->displayValue($arwrk);
                } else {
                    $this->kd_pj->ViewValue = $this->kd_pj->CurrentValue;
                }
            }
        } else {
            $this->kd_pj->ViewValue = null;
        }
        $this->kd_pj->ViewCustomAttributes = "";

        // no_peserta
        $this->no_peserta->ViewValue = $this->no_peserta->CurrentValue;
        $this->no_peserta->ViewCustomAttributes = "";

        // kd_kel
        $curVal = trim(strval($this->kd_kel->CurrentValue));
        if ($curVal != "") {
            $this->kd_kel->ViewValue = $this->kd_kel->lookupCacheOption($curVal);
            if ($this->kd_kel->ViewValue === null) { // Lookup from database
                $filterWrk = "`kd_kel`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_kel->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_kel->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_kel->ViewValue = $this->kd_kel->displayValue($arwrk);
                } else {
                    $this->kd_kel->ViewValue = $this->kd_kel->CurrentValue;
                }
            }
        } else {
            $this->kd_kel->ViewValue = null;
        }
        $this->kd_kel->ViewCustomAttributes = "";

        // kd_kec
        $curVal = trim(strval($this->kd_kec->CurrentValue));
        if ($curVal != "") {
            $this->kd_kec->ViewValue = $this->kd_kec->lookupCacheOption($curVal);
            if ($this->kd_kec->ViewValue === null) { // Lookup from database
                $filterWrk = "`kd_kec`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_kec->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_kec->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_kec->ViewValue = $this->kd_kec->displayValue($arwrk);
                } else {
                    $this->kd_kec->ViewValue = $this->kd_kec->CurrentValue;
                }
            }
        } else {
            $this->kd_kec->ViewValue = null;
        }
        $this->kd_kec->ViewCustomAttributes = "";

        // kd_kab
        $curVal = trim(strval($this->kd_kab->CurrentValue));
        if ($curVal != "") {
            $this->kd_kab->ViewValue = $this->kd_kab->lookupCacheOption($curVal);
            if ($this->kd_kab->ViewValue === null) { // Lookup from database
                $filterWrk = "`kd_kab`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_kab->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_kab->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_kab->ViewValue = $this->kd_kab->displayValue($arwrk);
                } else {
                    $this->kd_kab->ViewValue = $this->kd_kab->CurrentValue;
                }
            }
        } else {
            $this->kd_kab->ViewValue = null;
        }
        $this->kd_kab->ViewCustomAttributes = "";

        // pekerjaanpj
        $this->pekerjaanpj->ViewValue = $this->pekerjaanpj->CurrentValue;
        $this->pekerjaanpj->ViewCustomAttributes = "";

        // alamatpj
        $this->alamatpj->ViewValue = $this->alamatpj->CurrentValue;
        $this->alamatpj->ViewCustomAttributes = "";

        // kelurahanpj
        $this->kelurahanpj->ViewValue = $this->kelurahanpj->CurrentValue;
        $this->kelurahanpj->ViewCustomAttributes = "";

        // kecamatanpj
        $this->kecamatanpj->ViewValue = $this->kecamatanpj->CurrentValue;
        $this->kecamatanpj->ViewCustomAttributes = "";

        // kabupatenpj
        $this->kabupatenpj->ViewValue = $this->kabupatenpj->CurrentValue;
        $this->kabupatenpj->ViewCustomAttributes = "";

        // perusahaan_pasien
        $curVal = trim(strval($this->perusahaan_pasien->CurrentValue));
        if ($curVal != "") {
            $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->lookupCacheOption($curVal);
            if ($this->perusahaan_pasien->ViewValue === null) { // Lookup from database
                $filterWrk = "`kode_perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->perusahaan_pasien->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->perusahaan_pasien->Lookup->renderViewRow($rswrk[0]);
                    $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->displayValue($arwrk);
                } else {
                    $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->CurrentValue;
                }
            }
        } else {
            $this->perusahaan_pasien->ViewValue = null;
        }
        $this->perusahaan_pasien->ViewCustomAttributes = "";

        // suku_bangsa
        $curVal = trim(strval($this->suku_bangsa->CurrentValue));
        if ($curVal != "") {
            $this->suku_bangsa->ViewValue = $this->suku_bangsa->lookupCacheOption($curVal);
            if ($this->suku_bangsa->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->suku_bangsa->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->suku_bangsa->Lookup->renderViewRow($rswrk[0]);
                    $this->suku_bangsa->ViewValue = $this->suku_bangsa->displayValue($arwrk);
                } else {
                    $this->suku_bangsa->ViewValue = $this->suku_bangsa->CurrentValue;
                }
            }
        } else {
            $this->suku_bangsa->ViewValue = null;
        }
        $this->suku_bangsa->ViewCustomAttributes = "";

        // bahasa_pasien
        $curVal = trim(strval($this->bahasa_pasien->CurrentValue));
        if ($curVal != "") {
            $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->lookupCacheOption($curVal);
            if ($this->bahasa_pasien->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->bahasa_pasien->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->bahasa_pasien->Lookup->renderViewRow($rswrk[0]);
                    $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->displayValue($arwrk);
                } else {
                    $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->CurrentValue;
                }
            }
        } else {
            $this->bahasa_pasien->ViewValue = null;
        }
        $this->bahasa_pasien->ViewCustomAttributes = "";

        // cacat_fisik
        $curVal = trim(strval($this->cacat_fisik->CurrentValue));
        if ($curVal != "") {
            $this->cacat_fisik->ViewValue = $this->cacat_fisik->lookupCacheOption($curVal);
            if ($this->cacat_fisik->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->cacat_fisik->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->cacat_fisik->Lookup->renderViewRow($rswrk[0]);
                    $this->cacat_fisik->ViewValue = $this->cacat_fisik->displayValue($arwrk);
                } else {
                    $this->cacat_fisik->ViewValue = $this->cacat_fisik->CurrentValue;
                }
            }
        } else {
            $this->cacat_fisik->ViewValue = null;
        }
        $this->cacat_fisik->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // nip
        $this->nip->ViewValue = $this->nip->CurrentValue;
        $this->nip->ViewCustomAttributes = "";

        // kd_prop
        $curVal = trim(strval($this->kd_prop->CurrentValue));
        if ($curVal != "") {
            $this->kd_prop->ViewValue = $this->kd_prop->lookupCacheOption($curVal);
            if ($this->kd_prop->ViewValue === null) { // Lookup from database
                $filterWrk = "`kd_prop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_prop->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_prop->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_prop->ViewValue = $this->kd_prop->displayValue($arwrk);
                } else {
                    $this->kd_prop->ViewValue = $this->kd_prop->CurrentValue;
                }
            }
        } else {
            $this->kd_prop->ViewValue = null;
        }
        $this->kd_prop->ViewCustomAttributes = "";

        // propinsipj
        $this->propinsipj->ViewValue = $this->propinsipj->CurrentValue;
        $this->propinsipj->ViewCustomAttributes = "";

        // id_pasien
        $this->id_pasien->LinkCustomAttributes = "";
        $this->id_pasien->HrefValue = "";
        $this->id_pasien->TooltipValue = "";

        // no_rkm_medis
        $this->no_rkm_medis->LinkCustomAttributes = "";
        $this->no_rkm_medis->HrefValue = "";
        $this->no_rkm_medis->TooltipValue = "";

        // nm_pasien
        $this->nm_pasien->LinkCustomAttributes = "";
        $this->nm_pasien->HrefValue = "";
        $this->nm_pasien->TooltipValue = "";

        // no_ktp
        $this->no_ktp->LinkCustomAttributes = "";
        $this->no_ktp->HrefValue = "";
        $this->no_ktp->TooltipValue = "";

        // jk
        $this->jk->LinkCustomAttributes = "";
        $this->jk->HrefValue = "";
        $this->jk->TooltipValue = "";

        // tmp_lahir
        $this->tmp_lahir->LinkCustomAttributes = "";
        $this->tmp_lahir->HrefValue = "";
        $this->tmp_lahir->TooltipValue = "";

        // tgl_lahir
        $this->tgl_lahir->LinkCustomAttributes = "";
        $this->tgl_lahir->HrefValue = "";
        $this->tgl_lahir->TooltipValue = "";

        // nm_ibu
        $this->nm_ibu->LinkCustomAttributes = "";
        $this->nm_ibu->HrefValue = "";
        $this->nm_ibu->TooltipValue = "";

        // alamat
        $this->alamat->LinkCustomAttributes = "";
        $this->alamat->HrefValue = "";
        $this->alamat->TooltipValue = "";

        // gol_darah
        $this->gol_darah->LinkCustomAttributes = "";
        $this->gol_darah->HrefValue = "";
        $this->gol_darah->TooltipValue = "";

        // pekerjaan
        $this->pekerjaan->LinkCustomAttributes = "";
        $this->pekerjaan->HrefValue = "";
        $this->pekerjaan->TooltipValue = "";

        // stts_nikah
        $this->stts_nikah->LinkCustomAttributes = "";
        $this->stts_nikah->HrefValue = "";
        $this->stts_nikah->TooltipValue = "";

        // agama
        $this->agama->LinkCustomAttributes = "";
        $this->agama->HrefValue = "";
        $this->agama->TooltipValue = "";

        // tgl_daftar
        $this->tgl_daftar->LinkCustomAttributes = "";
        $this->tgl_daftar->HrefValue = "";
        $this->tgl_daftar->TooltipValue = "";

        // no_tlp
        $this->no_tlp->LinkCustomAttributes = "";
        $this->no_tlp->HrefValue = "";
        $this->no_tlp->TooltipValue = "";

        // umur
        $this->umur->LinkCustomAttributes = "";
        $this->umur->HrefValue = "";
        $this->umur->TooltipValue = "";

        // pnd
        $this->pnd->LinkCustomAttributes = "";
        $this->pnd->HrefValue = "";
        $this->pnd->TooltipValue = "";

        // keluarga
        $this->keluarga->LinkCustomAttributes = "";
        $this->keluarga->HrefValue = "";
        $this->keluarga->TooltipValue = "";

        // namakeluarga
        $this->namakeluarga->LinkCustomAttributes = "";
        $this->namakeluarga->HrefValue = "";
        $this->namakeluarga->TooltipValue = "";

        // kd_pj
        $this->kd_pj->LinkCustomAttributes = "";
        $this->kd_pj->HrefValue = "";
        $this->kd_pj->TooltipValue = "";

        // no_peserta
        $this->no_peserta->LinkCustomAttributes = "";
        $this->no_peserta->HrefValue = "";
        $this->no_peserta->TooltipValue = "";

        // kd_kel
        $this->kd_kel->LinkCustomAttributes = "";
        $this->kd_kel->HrefValue = "";
        $this->kd_kel->TooltipValue = "";

        // kd_kec
        $this->kd_kec->LinkCustomAttributes = "";
        $this->kd_kec->HrefValue = "";
        $this->kd_kec->TooltipValue = "";

        // kd_kab
        $this->kd_kab->LinkCustomAttributes = "";
        $this->kd_kab->HrefValue = "";
        $this->kd_kab->TooltipValue = "";

        // pekerjaanpj
        $this->pekerjaanpj->LinkCustomAttributes = "";
        $this->pekerjaanpj->HrefValue = "";
        $this->pekerjaanpj->TooltipValue = "";

        // alamatpj
        $this->alamatpj->LinkCustomAttributes = "";
        $this->alamatpj->HrefValue = "";
        $this->alamatpj->TooltipValue = "";

        // kelurahanpj
        $this->kelurahanpj->LinkCustomAttributes = "";
        $this->kelurahanpj->HrefValue = "";
        $this->kelurahanpj->TooltipValue = "";

        // kecamatanpj
        $this->kecamatanpj->LinkCustomAttributes = "";
        $this->kecamatanpj->HrefValue = "";
        $this->kecamatanpj->TooltipValue = "";

        // kabupatenpj
        $this->kabupatenpj->LinkCustomAttributes = "";
        $this->kabupatenpj->HrefValue = "";
        $this->kabupatenpj->TooltipValue = "";

        // perusahaan_pasien
        $this->perusahaan_pasien->LinkCustomAttributes = "";
        $this->perusahaan_pasien->HrefValue = "";
        $this->perusahaan_pasien->TooltipValue = "";

        // suku_bangsa
        $this->suku_bangsa->LinkCustomAttributes = "";
        $this->suku_bangsa->HrefValue = "";
        $this->suku_bangsa->TooltipValue = "";

        // bahasa_pasien
        $this->bahasa_pasien->LinkCustomAttributes = "";
        $this->bahasa_pasien->HrefValue = "";
        $this->bahasa_pasien->TooltipValue = "";

        // cacat_fisik
        $this->cacat_fisik->LinkCustomAttributes = "";
        $this->cacat_fisik->HrefValue = "";
        $this->cacat_fisik->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // nip
        $this->nip->LinkCustomAttributes = "";
        $this->nip->HrefValue = "";
        $this->nip->TooltipValue = "";

        // kd_prop
        $this->kd_prop->LinkCustomAttributes = "";
        $this->kd_prop->HrefValue = "";
        $this->kd_prop->TooltipValue = "";

        // propinsipj
        $this->propinsipj->LinkCustomAttributes = "";
        $this->propinsipj->HrefValue = "";
        $this->propinsipj->TooltipValue = "";

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
        $this->id_pasien->PlaceHolder = RemoveHtml($this->id_pasien->caption());

        // no_rkm_medis
        $this->no_rkm_medis->EditAttrs["class"] = "form-control";
        $this->no_rkm_medis->EditCustomAttributes = "";
        $this->no_rkm_medis->EditValue = $this->no_rkm_medis->CurrentValue;
        $this->no_rkm_medis->ViewCustomAttributes = "";

        // nm_pasien
        $this->nm_pasien->EditAttrs["class"] = "form-control";
        $this->nm_pasien->EditCustomAttributes = "";
        if (!$this->nm_pasien->Raw) {
            $this->nm_pasien->CurrentValue = HtmlDecode($this->nm_pasien->CurrentValue);
        }
        $this->nm_pasien->EditValue = $this->nm_pasien->CurrentValue;
        $this->nm_pasien->PlaceHolder = RemoveHtml($this->nm_pasien->caption());

        // no_ktp
        $this->no_ktp->EditAttrs["class"] = "form-control";
        $this->no_ktp->EditCustomAttributes = "";
        if (!$this->no_ktp->Raw) {
            $this->no_ktp->CurrentValue = HtmlDecode($this->no_ktp->CurrentValue);
        }
        $this->no_ktp->EditValue = $this->no_ktp->CurrentValue;
        $this->no_ktp->PlaceHolder = RemoveHtml($this->no_ktp->caption());

        // jk
        $this->jk->EditCustomAttributes = "";
        $this->jk->EditValue = $this->jk->options(false);
        $this->jk->PlaceHolder = RemoveHtml($this->jk->caption());

        // tmp_lahir
        $this->tmp_lahir->EditAttrs["class"] = "form-control";
        $this->tmp_lahir->EditCustomAttributes = "";
        if (!$this->tmp_lahir->Raw) {
            $this->tmp_lahir->CurrentValue = HtmlDecode($this->tmp_lahir->CurrentValue);
        }
        $this->tmp_lahir->EditValue = $this->tmp_lahir->CurrentValue;
        $this->tmp_lahir->PlaceHolder = RemoveHtml($this->tmp_lahir->caption());

        // tgl_lahir
        $this->tgl_lahir->EditAttrs["class"] = "form-control";
        $this->tgl_lahir->EditCustomAttributes = "";
        $this->tgl_lahir->EditValue = FormatDateTime($this->tgl_lahir->CurrentValue, 8);
        $this->tgl_lahir->PlaceHolder = RemoveHtml($this->tgl_lahir->caption());

        // nm_ibu
        $this->nm_ibu->EditAttrs["class"] = "form-control";
        $this->nm_ibu->EditCustomAttributes = "";
        if (!$this->nm_ibu->Raw) {
            $this->nm_ibu->CurrentValue = HtmlDecode($this->nm_ibu->CurrentValue);
        }
        $this->nm_ibu->EditValue = $this->nm_ibu->CurrentValue;
        $this->nm_ibu->PlaceHolder = RemoveHtml($this->nm_ibu->caption());

        // alamat
        $this->alamat->EditAttrs["class"] = "form-control";
        $this->alamat->EditCustomAttributes = "";
        if (!$this->alamat->Raw) {
            $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
        }
        $this->alamat->EditValue = $this->alamat->CurrentValue;
        $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

        // gol_darah
        $this->gol_darah->EditCustomAttributes = "";
        $this->gol_darah->EditValue = $this->gol_darah->options(false);
        $this->gol_darah->PlaceHolder = RemoveHtml($this->gol_darah->caption());

        // pekerjaan
        $this->pekerjaan->EditAttrs["class"] = "form-control";
        $this->pekerjaan->EditCustomAttributes = "";
        if (!$this->pekerjaan->Raw) {
            $this->pekerjaan->CurrentValue = HtmlDecode($this->pekerjaan->CurrentValue);
        }
        $this->pekerjaan->EditValue = $this->pekerjaan->CurrentValue;
        $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

        // stts_nikah
        $this->stts_nikah->EditCustomAttributes = "";
        $this->stts_nikah->EditValue = $this->stts_nikah->options(false);
        $this->stts_nikah->PlaceHolder = RemoveHtml($this->stts_nikah->caption());

        // agama
        $this->agama->EditAttrs["class"] = "form-control";
        $this->agama->EditCustomAttributes = "";
        $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

        // tgl_daftar

        // no_tlp
        $this->no_tlp->EditAttrs["class"] = "form-control";
        $this->no_tlp->EditCustomAttributes = "";
        if (!$this->no_tlp->Raw) {
            $this->no_tlp->CurrentValue = HtmlDecode($this->no_tlp->CurrentValue);
        }
        $this->no_tlp->EditValue = $this->no_tlp->CurrentValue;
        $this->no_tlp->PlaceHolder = RemoveHtml($this->no_tlp->caption());

        // umur
        $this->umur->EditAttrs["class"] = "form-control";
        $this->umur->EditCustomAttributes = "";
        if (!$this->umur->Raw) {
            $this->umur->CurrentValue = HtmlDecode($this->umur->CurrentValue);
        }
        $this->umur->EditValue = $this->umur->CurrentValue;
        $this->umur->PlaceHolder = RemoveHtml($this->umur->caption());

        // pnd
        $this->pnd->EditCustomAttributes = "";
        $this->pnd->EditValue = $this->pnd->options(false);
        $this->pnd->PlaceHolder = RemoveHtml($this->pnd->caption());

        // keluarga
        $this->keluarga->EditCustomAttributes = "";
        $this->keluarga->EditValue = $this->keluarga->options(false);
        $this->keluarga->PlaceHolder = RemoveHtml($this->keluarga->caption());

        // namakeluarga
        $this->namakeluarga->EditAttrs["class"] = "form-control";
        $this->namakeluarga->EditCustomAttributes = "";
        if (!$this->namakeluarga->Raw) {
            $this->namakeluarga->CurrentValue = HtmlDecode($this->namakeluarga->CurrentValue);
        }
        $this->namakeluarga->EditValue = $this->namakeluarga->CurrentValue;
        $this->namakeluarga->PlaceHolder = RemoveHtml($this->namakeluarga->caption());

        // kd_pj
        $this->kd_pj->EditAttrs["class"] = "form-control";
        $this->kd_pj->EditCustomAttributes = "";
        $this->kd_pj->PlaceHolder = RemoveHtml($this->kd_pj->caption());

        // no_peserta
        $this->no_peserta->EditAttrs["class"] = "form-control";
        $this->no_peserta->EditCustomAttributes = "";
        if (!$this->no_peserta->Raw) {
            $this->no_peserta->CurrentValue = HtmlDecode($this->no_peserta->CurrentValue);
        }
        $this->no_peserta->EditValue = $this->no_peserta->CurrentValue;
        $this->no_peserta->PlaceHolder = RemoveHtml($this->no_peserta->caption());

        // kd_kel
        $this->kd_kel->EditAttrs["class"] = "form-control";
        $this->kd_kel->EditCustomAttributes = "";
        $curVal = trim(strval($this->kd_kel->CurrentValue));
        if ($curVal != "") {
            $this->kd_kel->EditValue = $this->kd_kel->lookupCacheOption($curVal);
            if ($this->kd_kel->EditValue === null) { // Lookup from database
                $filterWrk = "`kd_kel`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_kel->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_kel->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_kel->EditValue = $this->kd_kel->displayValue($arwrk);
                } else {
                    $this->kd_kel->EditValue = $this->kd_kel->CurrentValue;
                }
            }
        } else {
            $this->kd_kel->EditValue = null;
        }
        $this->kd_kel->ViewCustomAttributes = "";

        // kd_kec
        $this->kd_kec->EditAttrs["class"] = "form-control";
        $this->kd_kec->EditCustomAttributes = "";
        $curVal = trim(strval($this->kd_kec->CurrentValue));
        if ($curVal != "") {
            $this->kd_kec->EditValue = $this->kd_kec->lookupCacheOption($curVal);
            if ($this->kd_kec->EditValue === null) { // Lookup from database
                $filterWrk = "`kd_kec`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_kec->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_kec->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_kec->EditValue = $this->kd_kec->displayValue($arwrk);
                } else {
                    $this->kd_kec->EditValue = $this->kd_kec->CurrentValue;
                }
            }
        } else {
            $this->kd_kec->EditValue = null;
        }
        $this->kd_kec->ViewCustomAttributes = "";

        // kd_kab
        $this->kd_kab->EditAttrs["class"] = "form-control";
        $this->kd_kab->EditCustomAttributes = "";
        $curVal = trim(strval($this->kd_kab->CurrentValue));
        if ($curVal != "") {
            $this->kd_kab->EditValue = $this->kd_kab->lookupCacheOption($curVal);
            if ($this->kd_kab->EditValue === null) { // Lookup from database
                $filterWrk = "`kd_kab`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_kab->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_kab->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_kab->EditValue = $this->kd_kab->displayValue($arwrk);
                } else {
                    $this->kd_kab->EditValue = $this->kd_kab->CurrentValue;
                }
            }
        } else {
            $this->kd_kab->EditValue = null;
        }
        $this->kd_kab->ViewCustomAttributes = "";

        // pekerjaanpj
        $this->pekerjaanpj->EditAttrs["class"] = "form-control";
        $this->pekerjaanpj->EditCustomAttributes = "";
        if (!$this->pekerjaanpj->Raw) {
            $this->pekerjaanpj->CurrentValue = HtmlDecode($this->pekerjaanpj->CurrentValue);
        }
        $this->pekerjaanpj->EditValue = $this->pekerjaanpj->CurrentValue;
        $this->pekerjaanpj->PlaceHolder = RemoveHtml($this->pekerjaanpj->caption());

        // alamatpj
        $this->alamatpj->EditAttrs["class"] = "form-control";
        $this->alamatpj->EditCustomAttributes = "";
        if (!$this->alamatpj->Raw) {
            $this->alamatpj->CurrentValue = HtmlDecode($this->alamatpj->CurrentValue);
        }
        $this->alamatpj->EditValue = $this->alamatpj->CurrentValue;
        $this->alamatpj->PlaceHolder = RemoveHtml($this->alamatpj->caption());

        // kelurahanpj
        $this->kelurahanpj->EditAttrs["class"] = "form-control";
        $this->kelurahanpj->EditCustomAttributes = "";
        if (!$this->kelurahanpj->Raw) {
            $this->kelurahanpj->CurrentValue = HtmlDecode($this->kelurahanpj->CurrentValue);
        }
        $this->kelurahanpj->EditValue = $this->kelurahanpj->CurrentValue;
        $this->kelurahanpj->PlaceHolder = RemoveHtml($this->kelurahanpj->caption());

        // kecamatanpj
        $this->kecamatanpj->EditAttrs["class"] = "form-control";
        $this->kecamatanpj->EditCustomAttributes = "";
        if (!$this->kecamatanpj->Raw) {
            $this->kecamatanpj->CurrentValue = HtmlDecode($this->kecamatanpj->CurrentValue);
        }
        $this->kecamatanpj->EditValue = $this->kecamatanpj->CurrentValue;
        $this->kecamatanpj->PlaceHolder = RemoveHtml($this->kecamatanpj->caption());

        // kabupatenpj
        $this->kabupatenpj->EditAttrs["class"] = "form-control";
        $this->kabupatenpj->EditCustomAttributes = "";
        if (!$this->kabupatenpj->Raw) {
            $this->kabupatenpj->CurrentValue = HtmlDecode($this->kabupatenpj->CurrentValue);
        }
        $this->kabupatenpj->EditValue = $this->kabupatenpj->CurrentValue;
        $this->kabupatenpj->PlaceHolder = RemoveHtml($this->kabupatenpj->caption());

        // perusahaan_pasien
        $this->perusahaan_pasien->EditAttrs["class"] = "form-control";
        $this->perusahaan_pasien->EditCustomAttributes = "";
        $curVal = trim(strval($this->perusahaan_pasien->CurrentValue));
        if ($curVal != "") {
            $this->perusahaan_pasien->EditValue = $this->perusahaan_pasien->lookupCacheOption($curVal);
            if ($this->perusahaan_pasien->EditValue === null) { // Lookup from database
                $filterWrk = "`kode_perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->perusahaan_pasien->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->perusahaan_pasien->Lookup->renderViewRow($rswrk[0]);
                    $this->perusahaan_pasien->EditValue = $this->perusahaan_pasien->displayValue($arwrk);
                } else {
                    $this->perusahaan_pasien->EditValue = $this->perusahaan_pasien->CurrentValue;
                }
            }
        } else {
            $this->perusahaan_pasien->EditValue = null;
        }
        $this->perusahaan_pasien->ViewCustomAttributes = "";

        // suku_bangsa
        $this->suku_bangsa->EditAttrs["class"] = "form-control";
        $this->suku_bangsa->EditCustomAttributes = "";
        $this->suku_bangsa->PlaceHolder = RemoveHtml($this->suku_bangsa->caption());

        // bahasa_pasien
        $this->bahasa_pasien->EditAttrs["class"] = "form-control";
        $this->bahasa_pasien->EditCustomAttributes = "";
        $this->bahasa_pasien->PlaceHolder = RemoveHtml($this->bahasa_pasien->caption());

        // cacat_fisik
        $this->cacat_fisik->EditAttrs["class"] = "form-control";
        $this->cacat_fisik->EditCustomAttributes = "";
        $this->cacat_fisik->PlaceHolder = RemoveHtml($this->cacat_fisik->caption());

        // email
        $this->_email->EditAttrs["class"] = "form-control";
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // nip
        $this->nip->EditAttrs["class"] = "form-control";
        $this->nip->EditCustomAttributes = "";
        if (!$this->nip->Raw) {
            $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
        }
        $this->nip->EditValue = $this->nip->CurrentValue;
        $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

        // kd_prop
        $this->kd_prop->EditAttrs["class"] = "form-control";
        $this->kd_prop->EditCustomAttributes = "";
        $curVal = trim(strval($this->kd_prop->CurrentValue));
        if ($curVal != "") {
            $this->kd_prop->EditValue = $this->kd_prop->lookupCacheOption($curVal);
            if ($this->kd_prop->EditValue === null) { // Lookup from database
                $filterWrk = "`kd_prop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->kd_prop->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_prop->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_prop->EditValue = $this->kd_prop->displayValue($arwrk);
                } else {
                    $this->kd_prop->EditValue = $this->kd_prop->CurrentValue;
                }
            }
        } else {
            $this->kd_prop->EditValue = null;
        }
        $this->kd_prop->ViewCustomAttributes = "";

        // propinsipj
        $this->propinsipj->EditAttrs["class"] = "form-control";
        $this->propinsipj->EditCustomAttributes = "";
        if (!$this->propinsipj->Raw) {
            $this->propinsipj->CurrentValue = HtmlDecode($this->propinsipj->CurrentValue);
        }
        $this->propinsipj->EditValue = $this->propinsipj->CurrentValue;
        $this->propinsipj->PlaceHolder = RemoveHtml($this->propinsipj->caption());

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
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->nm_pasien);
                    $doc->exportCaption($this->no_ktp);
                    $doc->exportCaption($this->jk);
                    $doc->exportCaption($this->tmp_lahir);
                    $doc->exportCaption($this->tgl_lahir);
                    $doc->exportCaption($this->nm_ibu);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->stts_nikah);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->tgl_daftar);
                    $doc->exportCaption($this->kd_pj);
                    $doc->exportCaption($this->kd_kel);
                    $doc->exportCaption($this->kd_kec);
                    $doc->exportCaption($this->kd_kab);
                    $doc->exportCaption($this->suku_bangsa);
                    $doc->exportCaption($this->bahasa_pasien);
                    $doc->exportCaption($this->cacat_fisik);
                    $doc->exportCaption($this->kd_prop);
                } else {
                    $doc->exportCaption($this->id_pasien);
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->nm_pasien);
                    $doc->exportCaption($this->no_ktp);
                    $doc->exportCaption($this->jk);
                    $doc->exportCaption($this->tmp_lahir);
                    $doc->exportCaption($this->tgl_lahir);
                    $doc->exportCaption($this->nm_ibu);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->gol_darah);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->stts_nikah);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->tgl_daftar);
                    $doc->exportCaption($this->no_tlp);
                    $doc->exportCaption($this->umur);
                    $doc->exportCaption($this->pnd);
                    $doc->exportCaption($this->keluarga);
                    $doc->exportCaption($this->namakeluarga);
                    $doc->exportCaption($this->kd_pj);
                    $doc->exportCaption($this->no_peserta);
                    $doc->exportCaption($this->kd_kel);
                    $doc->exportCaption($this->kd_kec);
                    $doc->exportCaption($this->kd_kab);
                    $doc->exportCaption($this->pekerjaanpj);
                    $doc->exportCaption($this->alamatpj);
                    $doc->exportCaption($this->kelurahanpj);
                    $doc->exportCaption($this->kecamatanpj);
                    $doc->exportCaption($this->kabupatenpj);
                    $doc->exportCaption($this->perusahaan_pasien);
                    $doc->exportCaption($this->suku_bangsa);
                    $doc->exportCaption($this->bahasa_pasien);
                    $doc->exportCaption($this->cacat_fisik);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->kd_prop);
                    $doc->exportCaption($this->propinsipj);
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
                        $doc->exportField($this->no_rkm_medis);
                        $doc->exportField($this->nm_pasien);
                        $doc->exportField($this->no_ktp);
                        $doc->exportField($this->jk);
                        $doc->exportField($this->tmp_lahir);
                        $doc->exportField($this->tgl_lahir);
                        $doc->exportField($this->nm_ibu);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->stts_nikah);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->tgl_daftar);
                        $doc->exportField($this->kd_pj);
                        $doc->exportField($this->kd_kel);
                        $doc->exportField($this->kd_kec);
                        $doc->exportField($this->kd_kab);
                        $doc->exportField($this->suku_bangsa);
                        $doc->exportField($this->bahasa_pasien);
                        $doc->exportField($this->cacat_fisik);
                        $doc->exportField($this->kd_prop);
                    } else {
                        $doc->exportField($this->id_pasien);
                        $doc->exportField($this->no_rkm_medis);
                        $doc->exportField($this->nm_pasien);
                        $doc->exportField($this->no_ktp);
                        $doc->exportField($this->jk);
                        $doc->exportField($this->tmp_lahir);
                        $doc->exportField($this->tgl_lahir);
                        $doc->exportField($this->nm_ibu);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->gol_darah);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->stts_nikah);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->tgl_daftar);
                        $doc->exportField($this->no_tlp);
                        $doc->exportField($this->umur);
                        $doc->exportField($this->pnd);
                        $doc->exportField($this->keluarga);
                        $doc->exportField($this->namakeluarga);
                        $doc->exportField($this->kd_pj);
                        $doc->exportField($this->no_peserta);
                        $doc->exportField($this->kd_kel);
                        $doc->exportField($this->kd_kec);
                        $doc->exportField($this->kd_kab);
                        $doc->exportField($this->pekerjaanpj);
                        $doc->exportField($this->alamatpj);
                        $doc->exportField($this->kelurahanpj);
                        $doc->exportField($this->kecamatanpj);
                        $doc->exportField($this->kabupatenpj);
                        $doc->exportField($this->perusahaan_pasien);
                        $doc->exportField($this->suku_bangsa);
                        $doc->exportField($this->bahasa_pasien);
                        $doc->exportField($this->cacat_fisik);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->kd_prop);
                        $doc->exportField($this->propinsipj);
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
