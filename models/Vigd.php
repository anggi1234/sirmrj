<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for vigd
 */
class Vigd extends DbTable
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
    public $id_reg;
    public $no_reg;
    public $no_rawat;
    public $tgl_registrasi;
    public $jam_reg;
    public $kd_dokter;
    public $no_rkm_medis;
    public $kd_poli;
    public $p_jawab;
    public $almt_pj;
    public $hubunganpj;
    public $biaya_reg;
    public $stts;
    public $stts_daftar;
    public $status_lanjut;
    public $kd_pj;
    public $umurdaftar;
    public $sttsumur;
    public $status_bayar;
    public $status_poli;
    public $cetak;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'vigd';
        $this->TableName = 'vigd';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "pasien_kunjungan";
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
        $this->ShowMultipleDetails = true; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id_reg
        $this->id_reg = new DbField('vigd', 'vigd', 'x_id_reg', 'id_reg', '`id_reg`', '`id_reg`', 3, 11, -1, false, '`id_reg`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_reg->IsAutoIncrement = true; // Autoincrement field
        $this->id_reg->IsPrimaryKey = true; // Primary key field
        $this->id_reg->IsForeignKey = true; // Foreign key field
        $this->id_reg->Sortable = true; // Allow sort
        $this->id_reg->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_reg->Param, "CustomMsg");
        $this->Fields['id_reg'] = &$this->id_reg;

        // no_reg
        $this->no_reg = new DbField('vigd', 'vigd', 'x_no_reg', 'no_reg', '`no_reg`', '`no_reg`', 200, 8, -1, false, '`no_reg`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_reg->Sortable = true; // Allow sort
        $this->no_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_reg->Param, "CustomMsg");
        $this->Fields['no_reg'] = &$this->no_reg;

        // no_rawat
        $this->no_rawat = new DbField('vigd', 'vigd', 'x_no_rawat', 'no_rawat', '`no_rawat`', '`no_rawat`', 200, 17, -1, false, '`no_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->Nullable = false; // NOT NULL field
        $this->no_rawat->Required = true; // Required field
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // tgl_registrasi
        $this->tgl_registrasi = new DbField('vigd', 'vigd', 'x_tgl_registrasi', 'tgl_registrasi', '`tgl_registrasi`', CastDateFieldForLike("`tgl_registrasi`", 7, "DB"), 133, 10, 7, false, '`tgl_registrasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_registrasi->Sortable = true; // Allow sort
        $this->tgl_registrasi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->tgl_registrasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_registrasi->Param, "CustomMsg");
        $this->Fields['tgl_registrasi'] = &$this->tgl_registrasi;

        // jam_reg
        $this->jam_reg = new DbField('vigd', 'vigd', 'x_jam_reg', 'jam_reg', '`jam_reg`', CastDateFieldForLike("`jam_reg`", 4, "DB"), 134, 10, 4, false, '`jam_reg`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jam_reg->Sortable = true; // Allow sort
        $this->jam_reg->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
        $this->jam_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jam_reg->Param, "CustomMsg");
        $this->Fields['jam_reg'] = &$this->jam_reg;

        // kd_dokter
        $this->kd_dokter = new DbField('vigd', 'vigd', 'x_kd_dokter', 'kd_dokter', '`kd_dokter`', '`kd_dokter`', 200, 20, -1, false, '`kd_dokter`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_dokter->Sortable = true; // Allow sort
        $this->kd_dokter->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_dokter->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_dokter->Lookup = new Lookup('kd_dokter', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_dokter->Lookup = new Lookup('kd_dokter', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_dokter->OptionCount = 2;
        $this->kd_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_dokter->Param, "CustomMsg");
        $this->Fields['kd_dokter'] = &$this->kd_dokter;

        // no_rkm_medis
        $this->no_rkm_medis = new DbField('vigd', 'vigd', 'x_no_rkm_medis', 'no_rkm_medis', '`no_rkm_medis`', '`no_rkm_medis`', 200, 15, -1, false, '`no_rkm_medis`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->no_rkm_medis->IsForeignKey = true; // Foreign key field
        $this->no_rkm_medis->Sortable = true; // Allow sort
        $this->no_rkm_medis->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->no_rkm_medis->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->no_rkm_medis->Lookup = new Lookup('no_rkm_medis', 'pasien', false, 'no_rkm_medis', ["no_rkm_medis","nm_pasien","alamat","nm_ibu"], [], [], [], [], [], [], '`tgl_daftar` DESC', '');
                break;
            default:
                $this->no_rkm_medis->Lookup = new Lookup('no_rkm_medis', 'pasien', false, 'no_rkm_medis', ["no_rkm_medis","nm_pasien","alamat","nm_ibu"], [], [], [], [], [], [], '`tgl_daftar` DESC', '');
                break;
        }
        $this->no_rkm_medis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rkm_medis->Param, "CustomMsg");
        $this->Fields['no_rkm_medis'] = &$this->no_rkm_medis;

        // kd_poli
        $this->kd_poli = new DbField('vigd', 'vigd', 'x_kd_poli', 'kd_poli', 'pasien_kunjungan.kd_poli', 'pasien_kunjungan.kd_poli', 200, 5, -1, false, 'pasien_kunjungan.kd_poli', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_poli->Sortable = true; // Allow sort
        $this->kd_poli->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_poli->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_poli->Lookup = new Lookup('kd_poli', 'poliklinik', false, 'kd_poli', ["nm_poli","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_poli->Lookup = new Lookup('kd_poli', 'poliklinik', false, 'kd_poli', ["nm_poli","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_poli->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_poli->Param, "CustomMsg");
        $this->Fields['kd_poli'] = &$this->kd_poli;

        // p_jawab
        $this->p_jawab = new DbField('vigd', 'vigd', 'x_p_jawab', 'p_jawab', '`p_jawab`', '`p_jawab`', 200, 100, -1, false, '`p_jawab`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->p_jawab->Sortable = true; // Allow sort
        $this->p_jawab->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->p_jawab->Param, "CustomMsg");
        $this->Fields['p_jawab'] = &$this->p_jawab;

        // almt_pj
        $this->almt_pj = new DbField('vigd', 'vigd', 'x_almt_pj', 'almt_pj', '`almt_pj`', '`almt_pj`', 200, 200, -1, false, '`almt_pj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->almt_pj->Sortable = true; // Allow sort
        $this->almt_pj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->almt_pj->Param, "CustomMsg");
        $this->Fields['almt_pj'] = &$this->almt_pj;

        // hubunganpj
        $this->hubunganpj = new DbField('vigd', 'vigd', 'x_hubunganpj', 'hubunganpj', '`hubunganpj`', '`hubunganpj`', 200, 20, -1, false, '`hubunganpj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->hubunganpj->Sortable = true; // Allow sort
        $this->hubunganpj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hubunganpj->Param, "CustomMsg");
        $this->Fields['hubunganpj'] = &$this->hubunganpj;

        // biaya_reg
        $this->biaya_reg = new DbField('vigd', 'vigd', 'x_biaya_reg', 'biaya_reg', '`biaya_reg`', '`biaya_reg`', 5, 22, -1, false, '`biaya_reg`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->biaya_reg->Sortable = true; // Allow sort
        $this->biaya_reg->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->biaya_reg->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->biaya_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->biaya_reg->Param, "CustomMsg");
        $this->Fields['biaya_reg'] = &$this->biaya_reg;

        // stts
        $this->stts = new DbField('vigd', 'vigd', 'x_stts', 'stts', '`stts`', '`stts`', 202, 15, -1, false, '`stts`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->stts->Sortable = true; // Allow sort
        $this->stts->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->stts->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->stts->Lookup = new Lookup('stts', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->stts->Lookup = new Lookup('stts', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->stts->OptionCount = 8;
        $this->stts->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->stts->Param, "CustomMsg");
        $this->Fields['stts'] = &$this->stts;

        // stts_daftar
        $this->stts_daftar = new DbField('vigd', 'vigd', 'x_stts_daftar', 'stts_daftar', '`stts_daftar`', '`stts_daftar`', 202, 4, -1, false, '`stts_daftar`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->stts_daftar->Sortable = true; // Allow sort
        $this->stts_daftar->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->stts_daftar->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->stts_daftar->Lookup = new Lookup('stts_daftar', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->stts_daftar->Lookup = new Lookup('stts_daftar', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->stts_daftar->OptionCount = 3;
        $this->stts_daftar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->stts_daftar->Param, "CustomMsg");
        $this->Fields['stts_daftar'] = &$this->stts_daftar;

        // status_lanjut
        $this->status_lanjut = new DbField('vigd', 'vigd', 'x_status_lanjut', 'status_lanjut', '`status_lanjut`', '`status_lanjut`', 202, 5, -1, false, '`status_lanjut`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->status_lanjut->Sortable = true; // Allow sort
        $this->status_lanjut->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->status_lanjut->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->status_lanjut->Lookup = new Lookup('status_lanjut', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->status_lanjut->Lookup = new Lookup('status_lanjut', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->status_lanjut->OptionCount = 2;
        $this->status_lanjut->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_lanjut->Param, "CustomMsg");
        $this->Fields['status_lanjut'] = &$this->status_lanjut;

        // kd_pj
        $this->kd_pj = new DbField('vigd', 'vigd', 'x_kd_pj', 'kd_pj', '`kd_pj`', '`kd_pj`', 200, 3, -1, false, '`kd_pj`', false, false, false, 'FORMATTED TEXT', 'SELECT');
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

        // umurdaftar
        $this->umurdaftar = new DbField('vigd', 'vigd', 'x_umurdaftar', 'umurdaftar', '`umurdaftar`', '`umurdaftar`', 3, 11, -1, false, '`umurdaftar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->umurdaftar->Sortable = true; // Allow sort
        $this->umurdaftar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->umurdaftar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->umurdaftar->Param, "CustomMsg");
        $this->Fields['umurdaftar'] = &$this->umurdaftar;

        // sttsumur
        $this->sttsumur = new DbField('vigd', 'vigd', 'x_sttsumur', 'sttsumur', '`sttsumur`', '`sttsumur`', 202, 2, -1, false, '`sttsumur`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->sttsumur->Sortable = true; // Allow sort
        $this->sttsumur->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->sttsumur->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->sttsumur->Lookup = new Lookup('sttsumur', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sttsumur->Lookup = new Lookup('sttsumur', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sttsumur->OptionCount = 3;
        $this->sttsumur->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sttsumur->Param, "CustomMsg");
        $this->Fields['sttsumur'] = &$this->sttsumur;

        // status_bayar
        $this->status_bayar = new DbField('vigd', 'vigd', 'x_status_bayar', 'status_bayar', '`status_bayar`', '`status_bayar`', 202, 11, -1, false, '`status_bayar`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status_bayar->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->status_bayar->Lookup = new Lookup('status_bayar', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->status_bayar->Lookup = new Lookup('status_bayar', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->status_bayar->OptionCount = 2;
        $this->status_bayar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_bayar->Param, "CustomMsg");
        $this->Fields['status_bayar'] = &$this->status_bayar;

        // status_poli
        $this->status_poli = new DbField('vigd', 'vigd', 'x_status_poli', 'status_poli', '`status_poli`', '`status_poli`', 202, 11, -1, false, '`status_poli`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status_poli->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->status_poli->Lookup = new Lookup('status_poli', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->status_poli->Lookup = new Lookup('status_poli', 'vigd', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->status_poli->OptionCount = 2;
        $this->status_poli->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_poli->Param, "CustomMsg");
        $this->Fields['status_poli'] = &$this->status_poli;

        // cetak
        $this->cetak = new DbField('vigd', 'vigd', 'x_cetak', 'cetak', '\'\'', '\'\'', 201, 65530, -1, false, '\'\'', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->cetak->IsCustom = true; // Custom field
        $this->cetak->Sortable = true; // Allow sort
        $this->cetak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->cetak->Param, "CustomMsg");
        $this->Fields['cetak'] = &$this->cetak;
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
        if ($this->getCurrentDetailTable() == "penilaian_awal_keperawatan_ralan") {
            $detailUrl = Container("penilaian_awal_keperawatan_ralan")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "catatan_medis") {
            $detailUrl = Container("catatan_medis")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "penilaian_medis_ralan") {
            $detailUrl = Container("penilaian_medis_ralan")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "penilaian_awal_keperawatan_ralan_psikiatri") {
            $detailUrl = Container("penilaian_awal_keperawatan_ralan_psikiatri")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "penilaian_psikologi") {
            $detailUrl = Container("penilaian_psikologi")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "diagnosa_pasien") {
            $detailUrl = Container("diagnosa_pasien")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "tindak_lanjut") {
            $detailUrl = Container("tindak_lanjut")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "pemeriksaan_ralan") {
            $detailUrl = Container("pemeriksaan_ralan")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "vhistory") {
            $detailUrl = Container("vhistory")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_no_rkm_medis", $this->no_rkm_medis->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "VigdList";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "pasien_kunjungan";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("pasien_kunjungan.*, '' AS `cetak`");
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
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "pasien_kunjungan.kd_poli = 'IGDK'";
        $this->DefaultFilter = "`kd_poli`= 'IGDK'";
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
            $this->id_reg->setDbValue($conn->lastInsertId());
            $rs['id_reg'] = $this->id_reg->DbValue;
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
            if (array_key_exists('id_reg', $rs)) {
                AddFilter($where, QuotedName('id_reg', $this->Dbid) . '=' . QuotedValue($rs['id_reg'], $this->id_reg->DataType, $this->Dbid));
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
        $this->id_reg->DbValue = $row['id_reg'];
        $this->no_reg->DbValue = $row['no_reg'];
        $this->no_rawat->DbValue = $row['no_rawat'];
        $this->tgl_registrasi->DbValue = $row['tgl_registrasi'];
        $this->jam_reg->DbValue = $row['jam_reg'];
        $this->kd_dokter->DbValue = $row['kd_dokter'];
        $this->no_rkm_medis->DbValue = $row['no_rkm_medis'];
        $this->kd_poli->DbValue = $row['kd_poli'];
        $this->p_jawab->DbValue = $row['p_jawab'];
        $this->almt_pj->DbValue = $row['almt_pj'];
        $this->hubunganpj->DbValue = $row['hubunganpj'];
        $this->biaya_reg->DbValue = $row['biaya_reg'];
        $this->stts->DbValue = $row['stts'];
        $this->stts_daftar->DbValue = $row['stts_daftar'];
        $this->status_lanjut->DbValue = $row['status_lanjut'];
        $this->kd_pj->DbValue = $row['kd_pj'];
        $this->umurdaftar->DbValue = $row['umurdaftar'];
        $this->sttsumur->DbValue = $row['sttsumur'];
        $this->status_bayar->DbValue = $row['status_bayar'];
        $this->status_poli->DbValue = $row['status_poli'];
        $this->cetak->DbValue = $row['cetak'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_reg` = @id_reg@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_reg->CurrentValue : $this->id_reg->OldValue;
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
                $this->id_reg->CurrentValue = $keys[0];
            } else {
                $this->id_reg->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_reg', $row) ? $row['id_reg'] : null;
        } else {
            $val = $this->id_reg->OldValue !== null ? $this->id_reg->OldValue : $this->id_reg->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_reg@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("VigdList");
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
        if ($pageName == "VigdView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VigdEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VigdAdd") {
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
                return "VigdView";
            case Config("API_ADD_ACTION"):
                return "VigdAdd";
            case Config("API_EDIT_ACTION"):
                return "VigdEdit";
            case Config("API_DELETE_ACTION"):
                return "VigdDelete";
            case Config("API_LIST_ACTION"):
                return "VigdList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VigdList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VigdView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VigdView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VigdAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VigdAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VigdEdit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VigdEdit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        if ($parm != "") {
            $url = $this->keyUrl("VigdAdd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VigdAdd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        return $this->keyUrl("VigdDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_reg:" . JsonEncode($this->id_reg->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_reg->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_reg->CurrentValue);
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
            if (($keyValue = Param("id_reg") ?? Route("id_reg")) !== null) {
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
                $this->id_reg->CurrentValue = $key;
            } else {
                $this->id_reg->OldValue = $key;
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
        $this->id_reg->setDbValue($row['id_reg']);
        $this->no_reg->setDbValue($row['no_reg']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tgl_registrasi->setDbValue($row['tgl_registrasi']);
        $this->jam_reg->setDbValue($row['jam_reg']);
        $this->kd_dokter->setDbValue($row['kd_dokter']);
        $this->no_rkm_medis->setDbValue($row['no_rkm_medis']);
        $this->kd_poli->setDbValue($row['kd_poli']);
        $this->p_jawab->setDbValue($row['p_jawab']);
        $this->almt_pj->setDbValue($row['almt_pj']);
        $this->hubunganpj->setDbValue($row['hubunganpj']);
        $this->biaya_reg->setDbValue($row['biaya_reg']);
        $this->stts->setDbValue($row['stts']);
        $this->stts_daftar->setDbValue($row['stts_daftar']);
        $this->status_lanjut->setDbValue($row['status_lanjut']);
        $this->kd_pj->setDbValue($row['kd_pj']);
        $this->umurdaftar->setDbValue($row['umurdaftar']);
        $this->sttsumur->setDbValue($row['sttsumur']);
        $this->status_bayar->setDbValue($row['status_bayar']);
        $this->status_poli->setDbValue($row['status_poli']);
        $this->cetak->setDbValue($row['cetak']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_reg

        // no_reg

        // no_rawat

        // tgl_registrasi

        // jam_reg

        // kd_dokter

        // no_rkm_medis

        // kd_poli

        // p_jawab

        // almt_pj

        // hubunganpj

        // biaya_reg

        // stts

        // stts_daftar

        // status_lanjut

        // kd_pj

        // umurdaftar

        // sttsumur

        // status_bayar

        // status_poli

        // cetak

        // id_reg
        $this->id_reg->ViewValue = $this->id_reg->CurrentValue;
        $this->id_reg->ViewCustomAttributes = "";

        // no_reg
        $this->no_reg->ViewValue = $this->no_reg->CurrentValue;
        $this->no_reg->ViewCustomAttributes = "";

        // no_rawat
        $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->ViewCustomAttributes = "";

        // tgl_registrasi
        $this->tgl_registrasi->ViewValue = $this->tgl_registrasi->CurrentValue;
        $this->tgl_registrasi->ViewValue = FormatDateTime($this->tgl_registrasi->ViewValue, 7);
        $this->tgl_registrasi->ViewCustomAttributes = "";

        // jam_reg
        $this->jam_reg->ViewValue = $this->jam_reg->CurrentValue;
        $this->jam_reg->ViewValue = FormatDateTime($this->jam_reg->ViewValue, 4);
        $this->jam_reg->ViewCustomAttributes = "";

        // kd_dokter
        if (strval($this->kd_dokter->CurrentValue) != "") {
            $this->kd_dokter->ViewValue = $this->kd_dokter->optionCaption($this->kd_dokter->CurrentValue);
        } else {
            $this->kd_dokter->ViewValue = null;
        }
        $this->kd_dokter->ViewCustomAttributes = "";

        // no_rkm_medis
        $curVal = trim(strval($this->no_rkm_medis->CurrentValue));
        if ($curVal != "") {
            $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->lookupCacheOption($curVal);
            if ($this->no_rkm_medis->ViewValue === null) { // Lookup from database
                $filterWrk = "`no_rkm_medis`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->no_rkm_medis->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->no_rkm_medis->Lookup->renderViewRow($rswrk[0]);
                    $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->displayValue($arwrk);
                } else {
                    $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->CurrentValue;
                }
            }
        } else {
            $this->no_rkm_medis->ViewValue = null;
        }
        $this->no_rkm_medis->ViewCustomAttributes = "";

        // kd_poli
        $curVal = trim(strval($this->kd_poli->CurrentValue));
        if ($curVal != "") {
            $this->kd_poli->ViewValue = $this->kd_poli->lookupCacheOption($curVal);
            if ($this->kd_poli->ViewValue === null) { // Lookup from database
                $filterWrk = "`kd_poli`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "`status`='1'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->kd_poli->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_poli->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_poli->ViewValue = $this->kd_poli->displayValue($arwrk);
                } else {
                    $this->kd_poli->ViewValue = $this->kd_poli->CurrentValue;
                }
            }
        } else {
            $this->kd_poli->ViewValue = null;
        }
        $this->kd_poli->ViewCustomAttributes = "";

        // p_jawab
        $this->p_jawab->ViewValue = $this->p_jawab->CurrentValue;
        $this->p_jawab->ViewCustomAttributes = "";

        // almt_pj
        $this->almt_pj->ViewValue = $this->almt_pj->CurrentValue;
        $this->almt_pj->ViewCustomAttributes = "";

        // hubunganpj
        $this->hubunganpj->ViewValue = $this->hubunganpj->CurrentValue;
        $this->hubunganpj->ViewCustomAttributes = "";

        // biaya_reg
        $this->biaya_reg->ViewValue = $this->biaya_reg->CurrentValue;
        $this->biaya_reg->ViewValue = FormatNumber($this->biaya_reg->ViewValue, 2, -2, -2, -2);
        $this->biaya_reg->ViewCustomAttributes = "";

        // stts
        if (strval($this->stts->CurrentValue) != "") {
            $this->stts->ViewValue = $this->stts->optionCaption($this->stts->CurrentValue);
        } else {
            $this->stts->ViewValue = null;
        }
        $this->stts->ViewCustomAttributes = "";

        // stts_daftar
        if (strval($this->stts_daftar->CurrentValue) != "") {
            $this->stts_daftar->ViewValue = $this->stts_daftar->optionCaption($this->stts_daftar->CurrentValue);
        } else {
            $this->stts_daftar->ViewValue = null;
        }
        $this->stts_daftar->ViewCustomAttributes = "";

        // status_lanjut
        if (strval($this->status_lanjut->CurrentValue) != "") {
            $this->status_lanjut->ViewValue = $this->status_lanjut->optionCaption($this->status_lanjut->CurrentValue);
        } else {
            $this->status_lanjut->ViewValue = null;
        }
        $this->status_lanjut->ViewCustomAttributes = "";

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

        // umurdaftar
        $this->umurdaftar->ViewValue = $this->umurdaftar->CurrentValue;
        $this->umurdaftar->ViewValue = FormatNumber($this->umurdaftar->ViewValue, 0, -2, -2, -2);
        $this->umurdaftar->ViewCustomAttributes = "";

        // sttsumur
        if (strval($this->sttsumur->CurrentValue) != "") {
            $this->sttsumur->ViewValue = $this->sttsumur->optionCaption($this->sttsumur->CurrentValue);
        } else {
            $this->sttsumur->ViewValue = null;
        }
        $this->sttsumur->ViewCustomAttributes = "";

        // status_bayar
        if (strval($this->status_bayar->CurrentValue) != "") {
            $this->status_bayar->ViewValue = $this->status_bayar->optionCaption($this->status_bayar->CurrentValue);
        } else {
            $this->status_bayar->ViewValue = null;
        }
        $this->status_bayar->ViewCustomAttributes = "";

        // status_poli
        if (strval($this->status_poli->CurrentValue) != "") {
            $this->status_poli->ViewValue = $this->status_poli->optionCaption($this->status_poli->CurrentValue);
        } else {
            $this->status_poli->ViewValue = null;
        }
        $this->status_poli->ViewCustomAttributes = "";

        // cetak
        $this->cetak->ViewValue = $this->cetak->CurrentValue;
        $this->cetak->ViewCustomAttributes = "";

        // id_reg
        $this->id_reg->LinkCustomAttributes = "";
        $this->id_reg->HrefValue = "";
        $this->id_reg->TooltipValue = "";

        // no_reg
        $this->no_reg->LinkCustomAttributes = "";
        $this->no_reg->HrefValue = "";
        $this->no_reg->TooltipValue = "";

        // no_rawat
        $this->no_rawat->LinkCustomAttributes = "";
        $this->no_rawat->HrefValue = "";
        $this->no_rawat->TooltipValue = "";

        // tgl_registrasi
        $this->tgl_registrasi->LinkCustomAttributes = "";
        $this->tgl_registrasi->HrefValue = "";
        $this->tgl_registrasi->TooltipValue = "";

        // jam_reg
        $this->jam_reg->LinkCustomAttributes = "";
        $this->jam_reg->HrefValue = "";
        $this->jam_reg->TooltipValue = "";

        // kd_dokter
        $this->kd_dokter->LinkCustomAttributes = "";
        $this->kd_dokter->HrefValue = "";
        $this->kd_dokter->TooltipValue = "";

        // no_rkm_medis
        $this->no_rkm_medis->LinkCustomAttributes = "";
        $this->no_rkm_medis->HrefValue = "";
        $this->no_rkm_medis->TooltipValue = "";

        // kd_poli
        $this->kd_poli->LinkCustomAttributes = "";
        $this->kd_poli->HrefValue = "";
        $this->kd_poli->TooltipValue = "";

        // p_jawab
        $this->p_jawab->LinkCustomAttributes = "";
        $this->p_jawab->HrefValue = "";
        $this->p_jawab->TooltipValue = "";

        // almt_pj
        $this->almt_pj->LinkCustomAttributes = "";
        $this->almt_pj->HrefValue = "";
        $this->almt_pj->TooltipValue = "";

        // hubunganpj
        $this->hubunganpj->LinkCustomAttributes = "";
        $this->hubunganpj->HrefValue = "";
        $this->hubunganpj->TooltipValue = "";

        // biaya_reg
        $this->biaya_reg->LinkCustomAttributes = "";
        $this->biaya_reg->HrefValue = "";
        $this->biaya_reg->TooltipValue = "";

        // stts
        $this->stts->LinkCustomAttributes = "";
        $this->stts->HrefValue = "";
        $this->stts->TooltipValue = "";

        // stts_daftar
        $this->stts_daftar->LinkCustomAttributes = "";
        $this->stts_daftar->HrefValue = "";
        $this->stts_daftar->TooltipValue = "";

        // status_lanjut
        $this->status_lanjut->LinkCustomAttributes = "";
        $this->status_lanjut->HrefValue = "";
        $this->status_lanjut->TooltipValue = "";

        // kd_pj
        $this->kd_pj->LinkCustomAttributes = "";
        $this->kd_pj->HrefValue = "";
        $this->kd_pj->TooltipValue = "";

        // umurdaftar
        $this->umurdaftar->LinkCustomAttributes = "";
        $this->umurdaftar->HrefValue = "";
        $this->umurdaftar->TooltipValue = "";

        // sttsumur
        $this->sttsumur->LinkCustomAttributes = "";
        $this->sttsumur->HrefValue = "";
        $this->sttsumur->TooltipValue = "";

        // status_bayar
        $this->status_bayar->LinkCustomAttributes = "";
        $this->status_bayar->HrefValue = "";
        $this->status_bayar->TooltipValue = "";

        // status_poli
        $this->status_poli->LinkCustomAttributes = "";
        $this->status_poli->HrefValue = "";
        $this->status_poli->TooltipValue = "";

        // cetak
        $this->cetak->LinkCustomAttributes = "";
        $this->cetak->HrefValue = "";
        $this->cetak->TooltipValue = "";

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

        // id_reg
        $this->id_reg->EditAttrs["class"] = "form-control";
        $this->id_reg->EditCustomAttributes = "";
        $this->id_reg->EditValue = $this->id_reg->CurrentValue;
        $this->id_reg->ViewCustomAttributes = "";

        // no_reg
        $this->no_reg->EditAttrs["class"] = "form-control";
        $this->no_reg->EditCustomAttributes = "";
        if (!$this->no_reg->Raw) {
            $this->no_reg->CurrentValue = HtmlDecode($this->no_reg->CurrentValue);
        }
        $this->no_reg->EditValue = $this->no_reg->CurrentValue;
        $this->no_reg->PlaceHolder = RemoveHtml($this->no_reg->caption());

        // no_rawat
        $this->no_rawat->EditAttrs["class"] = "form-control";
        $this->no_rawat->EditCustomAttributes = "";
        if (!$this->no_rawat->Raw) {
            $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
        }
        $this->no_rawat->EditValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());

        // tgl_registrasi

        // jam_reg

        // kd_dokter
        $this->kd_dokter->EditAttrs["class"] = "form-control";
        $this->kd_dokter->EditCustomAttributes = "";
        if (strval($this->kd_dokter->CurrentValue) != "") {
            $this->kd_dokter->EditValue = $this->kd_dokter->optionCaption($this->kd_dokter->CurrentValue);
        } else {
            $this->kd_dokter->EditValue = null;
        }
        $this->kd_dokter->ViewCustomAttributes = "";

        // no_rkm_medis
        $this->no_rkm_medis->EditAttrs["class"] = "form-control";
        $this->no_rkm_medis->EditCustomAttributes = "";
        $curVal = trim(strval($this->no_rkm_medis->CurrentValue));
        if ($curVal != "") {
            $this->no_rkm_medis->EditValue = $this->no_rkm_medis->lookupCacheOption($curVal);
            if ($this->no_rkm_medis->EditValue === null) { // Lookup from database
                $filterWrk = "`no_rkm_medis`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->no_rkm_medis->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->no_rkm_medis->Lookup->renderViewRow($rswrk[0]);
                    $this->no_rkm_medis->EditValue = $this->no_rkm_medis->displayValue($arwrk);
                } else {
                    $this->no_rkm_medis->EditValue = $this->no_rkm_medis->CurrentValue;
                }
            }
        } else {
            $this->no_rkm_medis->EditValue = null;
        }
        $this->no_rkm_medis->ViewCustomAttributes = "";

        // kd_poli
        $this->kd_poli->EditAttrs["class"] = "form-control";
        $this->kd_poli->EditCustomAttributes = "";
        $curVal = trim(strval($this->kd_poli->CurrentValue));
        if ($curVal != "") {
            $this->kd_poli->EditValue = $this->kd_poli->lookupCacheOption($curVal);
            if ($this->kd_poli->EditValue === null) { // Lookup from database
                $filterWrk = "`kd_poli`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "`status`='1'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->kd_poli->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_poli->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_poli->EditValue = $this->kd_poli->displayValue($arwrk);
                } else {
                    $this->kd_poli->EditValue = $this->kd_poli->CurrentValue;
                }
            }
        } else {
            $this->kd_poli->EditValue = null;
        }
        $this->kd_poli->ViewCustomAttributes = "";

        // p_jawab
        $this->p_jawab->EditAttrs["class"] = "form-control";
        $this->p_jawab->EditCustomAttributes = "";
        if (!$this->p_jawab->Raw) {
            $this->p_jawab->CurrentValue = HtmlDecode($this->p_jawab->CurrentValue);
        }
        $this->p_jawab->EditValue = $this->p_jawab->CurrentValue;
        $this->p_jawab->PlaceHolder = RemoveHtml($this->p_jawab->caption());

        // almt_pj
        $this->almt_pj->EditAttrs["class"] = "form-control";
        $this->almt_pj->EditCustomAttributes = "";
        if (!$this->almt_pj->Raw) {
            $this->almt_pj->CurrentValue = HtmlDecode($this->almt_pj->CurrentValue);
        }
        $this->almt_pj->EditValue = $this->almt_pj->CurrentValue;
        $this->almt_pj->PlaceHolder = RemoveHtml($this->almt_pj->caption());

        // hubunganpj
        $this->hubunganpj->EditAttrs["class"] = "form-control";
        $this->hubunganpj->EditCustomAttributes = "";
        if (!$this->hubunganpj->Raw) {
            $this->hubunganpj->CurrentValue = HtmlDecode($this->hubunganpj->CurrentValue);
        }
        $this->hubunganpj->EditValue = $this->hubunganpj->CurrentValue;
        $this->hubunganpj->PlaceHolder = RemoveHtml($this->hubunganpj->caption());

        // biaya_reg
        $this->biaya_reg->EditAttrs["class"] = "form-control";
        $this->biaya_reg->EditCustomAttributes = "";
        $this->biaya_reg->EditValue = $this->biaya_reg->CurrentValue;
        $this->biaya_reg->PlaceHolder = RemoveHtml($this->biaya_reg->caption());
        if (strval($this->biaya_reg->EditValue) != "" && is_numeric($this->biaya_reg->EditValue)) {
            $this->biaya_reg->EditValue = FormatNumber($this->biaya_reg->EditValue, -2, -2, -2, -2);
        }

        // stts
        $this->stts->EditAttrs["class"] = "form-control";
        $this->stts->EditCustomAttributes = "";
        if (strval($this->stts->CurrentValue) != "") {
            $this->stts->EditValue = $this->stts->optionCaption($this->stts->CurrentValue);
        } else {
            $this->stts->EditValue = null;
        }
        $this->stts->ViewCustomAttributes = "";

        // stts_daftar
        $this->stts_daftar->EditAttrs["class"] = "form-control";
        $this->stts_daftar->EditCustomAttributes = "";
        $this->stts_daftar->EditValue = $this->stts_daftar->options(true);
        $this->stts_daftar->PlaceHolder = RemoveHtml($this->stts_daftar->caption());

        // status_lanjut
        $this->status_lanjut->EditAttrs["class"] = "form-control";
        $this->status_lanjut->EditCustomAttributes = "";
        $this->status_lanjut->EditValue = $this->status_lanjut->options(true);
        $this->status_lanjut->PlaceHolder = RemoveHtml($this->status_lanjut->caption());

        // kd_pj
        $this->kd_pj->EditAttrs["class"] = "form-control";
        $this->kd_pj->EditCustomAttributes = "";
        $this->kd_pj->PlaceHolder = RemoveHtml($this->kd_pj->caption());

        // umurdaftar
        $this->umurdaftar->EditAttrs["class"] = "form-control";
        $this->umurdaftar->EditCustomAttributes = "";
        $this->umurdaftar->EditValue = $this->umurdaftar->CurrentValue;
        $this->umurdaftar->EditValue = FormatNumber($this->umurdaftar->EditValue, 0, -2, -2, -2);
        $this->umurdaftar->ViewCustomAttributes = "";

        // sttsumur
        $this->sttsumur->EditAttrs["class"] = "form-control";
        $this->sttsumur->EditCustomAttributes = "";
        $this->sttsumur->EditValue = $this->sttsumur->options(true);
        $this->sttsumur->PlaceHolder = RemoveHtml($this->sttsumur->caption());

        // status_bayar
        $this->status_bayar->EditCustomAttributes = "";
        $this->status_bayar->EditValue = $this->status_bayar->options(false);
        $this->status_bayar->PlaceHolder = RemoveHtml($this->status_bayar->caption());

        // status_poli
        $this->status_poli->EditCustomAttributes = "";
        $this->status_poli->EditValue = $this->status_poli->options(false);
        $this->status_poli->PlaceHolder = RemoveHtml($this->status_poli->caption());

        // cetak
        $this->cetak->EditAttrs["class"] = "form-control";
        $this->cetak->EditCustomAttributes = "";
        $this->cetak->EditValue = $this->cetak->CurrentValue;
        $this->cetak->PlaceHolder = RemoveHtml($this->cetak->caption());

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
                    $doc->exportCaption($this->id_reg);
                    $doc->exportCaption($this->tgl_registrasi);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->kd_poli);
                    $doc->exportCaption($this->stts);
                    $doc->exportCaption($this->umurdaftar);
                    $doc->exportCaption($this->cetak);
                } else {
                    $doc->exportCaption($this->id_reg);
                    $doc->exportCaption($this->no_reg);
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tgl_registrasi);
                    $doc->exportCaption($this->jam_reg);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->kd_poli);
                    $doc->exportCaption($this->p_jawab);
                    $doc->exportCaption($this->almt_pj);
                    $doc->exportCaption($this->hubunganpj);
                    $doc->exportCaption($this->biaya_reg);
                    $doc->exportCaption($this->stts);
                    $doc->exportCaption($this->stts_daftar);
                    $doc->exportCaption($this->status_lanjut);
                    $doc->exportCaption($this->kd_pj);
                    $doc->exportCaption($this->umurdaftar);
                    $doc->exportCaption($this->sttsumur);
                    $doc->exportCaption($this->status_bayar);
                    $doc->exportCaption($this->status_poli);
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
                        $doc->exportField($this->id_reg);
                        $doc->exportField($this->tgl_registrasi);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->no_rkm_medis);
                        $doc->exportField($this->kd_poli);
                        $doc->exportField($this->stts);
                        $doc->exportField($this->umurdaftar);
                        $doc->exportField($this->cetak);
                    } else {
                        $doc->exportField($this->id_reg);
                        $doc->exportField($this->no_reg);
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tgl_registrasi);
                        $doc->exportField($this->jam_reg);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->no_rkm_medis);
                        $doc->exportField($this->kd_poli);
                        $doc->exportField($this->p_jawab);
                        $doc->exportField($this->almt_pj);
                        $doc->exportField($this->hubunganpj);
                        $doc->exportField($this->biaya_reg);
                        $doc->exportField($this->stts);
                        $doc->exportField($this->stts_daftar);
                        $doc->exportField($this->status_lanjut);
                        $doc->exportField($this->kd_pj);
                        $doc->exportField($this->umurdaftar);
                        $doc->exportField($this->sttsumur);
                        $doc->exportField($this->status_bayar);
                        $doc->exportField($this->status_poli);
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
