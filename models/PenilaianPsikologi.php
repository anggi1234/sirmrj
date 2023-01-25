<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for penilaian_psikologi
 */
class PenilaianPsikologi extends DbTable
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
    public $id_penilaian_psikologi;
    public $no_rawat;
    public $tanggal;
    public $nip;
    public $anamnesis;
    public $dikirim_dari;
    public $tujuan_pemeriksaan;
    public $ket_anamnesis;
    public $rupa;
    public $bentuk_tubuh;
    public $tindakan;
    public $pakaian;
    public $ekspresi;
    public $berbicara;
    public $penggunaan_kata;
    public $ciri_menyolok;
    public $hasil_psikotes;
    public $kepribadian;
    public $psikodinamika;
    public $kesimpulan_psikolog;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'penilaian_psikologi';
        $this->TableName = 'penilaian_psikologi';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`penilaian_psikologi`";
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
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id_penilaian_psikologi
        $this->id_penilaian_psikologi = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_id_penilaian_psikologi', 'id_penilaian_psikologi', '`id_penilaian_psikologi`', '`id_penilaian_psikologi`', 3, 6, -1, false, '`id_penilaian_psikologi`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_penilaian_psikologi->IsAutoIncrement = true; // Autoincrement field
        $this->id_penilaian_psikologi->IsPrimaryKey = true; // Primary key field
        $this->id_penilaian_psikologi->Sortable = true; // Allow sort
        $this->id_penilaian_psikologi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_penilaian_psikologi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_penilaian_psikologi->Param, "CustomMsg");
        $this->Fields['id_penilaian_psikologi'] = &$this->id_penilaian_psikologi;

        // no_rawat
        $this->no_rawat = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_no_rawat', 'no_rawat', '`no_rawat`', '`no_rawat`', 200, 17, -1, false, '`no_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->IsForeignKey = true; // Foreign key field
        $this->no_rawat->Nullable = false; // NOT NULL field
        $this->no_rawat->Required = true; // Required field
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // tanggal
        $this->tanggal = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 135, 19, 0, false, '`tanggal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal->Nullable = false; // NOT NULL field
        $this->tanggal->Required = true; // Required field
        $this->tanggal->Sortable = true; // Allow sort
        $this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal->Param, "CustomMsg");
        $this->Fields['tanggal'] = &$this->tanggal;

        // nip
        $this->nip = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_nip', 'nip', '`nip`', '`nip`', 200, 20, -1, false, '`nip`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nip->Nullable = false; // NOT NULL field
        $this->nip->Required = true; // Required field
        $this->nip->Sortable = true; // Allow sort
        $this->nip->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nip->Param, "CustomMsg");
        $this->Fields['nip'] = &$this->nip;

        // anamnesis
        $this->anamnesis = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_anamnesis', 'anamnesis', '`anamnesis`', '`anamnesis`', 202, 13, -1, false, '`anamnesis`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->anamnesis->Nullable = false; // NOT NULL field
        $this->anamnesis->Required = true; // Required field
        $this->anamnesis->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->anamnesis->Lookup = new Lookup('anamnesis', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->anamnesis->Lookup = new Lookup('anamnesis', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->anamnesis->OptionCount = 2;
        $this->anamnesis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->anamnesis->Param, "CustomMsg");
        $this->Fields['anamnesis'] = &$this->anamnesis;

        // dikirim_dari
        $this->dikirim_dari = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_dikirim_dari', 'dikirim_dari', '`dikirim_dari`', '`dikirim_dari`', 202, 12, -1, false, '`dikirim_dari`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->dikirim_dari->Nullable = false; // NOT NULL field
        $this->dikirim_dari->Required = true; // Required field
        $this->dikirim_dari->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->dikirim_dari->Lookup = new Lookup('dikirim_dari', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->dikirim_dari->Lookup = new Lookup('dikirim_dari', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->dikirim_dari->OptionCount = 5;
        $this->dikirim_dari->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dikirim_dari->Param, "CustomMsg");
        $this->Fields['dikirim_dari'] = &$this->dikirim_dari;

        // tujuan_pemeriksaan
        $this->tujuan_pemeriksaan = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_tujuan_pemeriksaan', 'tujuan_pemeriksaan', '`tujuan_pemeriksaan`', '`tujuan_pemeriksaan`', 202, 9, -1, false, '`tujuan_pemeriksaan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->tujuan_pemeriksaan->Nullable = false; // NOT NULL field
        $this->tujuan_pemeriksaan->Required = true; // Required field
        $this->tujuan_pemeriksaan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->tujuan_pemeriksaan->Lookup = new Lookup('tujuan_pemeriksaan', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->tujuan_pemeriksaan->Lookup = new Lookup('tujuan_pemeriksaan', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->tujuan_pemeriksaan->OptionCount = 3;
        $this->tujuan_pemeriksaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tujuan_pemeriksaan->Param, "CustomMsg");
        $this->Fields['tujuan_pemeriksaan'] = &$this->tujuan_pemeriksaan;

        // ket_anamnesis
        $this->ket_anamnesis = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_ket_anamnesis', 'ket_anamnesis', '`ket_anamnesis`', '`ket_anamnesis`', 201, 65535, -1, false, '`ket_anamnesis`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ket_anamnesis->Nullable = false; // NOT NULL field
        $this->ket_anamnesis->Required = true; // Required field
        $this->ket_anamnesis->Sortable = true; // Allow sort
        $this->ket_anamnesis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_anamnesis->Param, "CustomMsg");
        $this->Fields['ket_anamnesis'] = &$this->ket_anamnesis;

        // rupa
        $this->rupa = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_rupa', 'rupa', '`rupa`', '`rupa`', 202, 9, -1, false, '`rupa`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rupa->Nullable = false; // NOT NULL field
        $this->rupa->Required = true; // Required field
        $this->rupa->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rupa->Lookup = new Lookup('rupa', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rupa->Lookup = new Lookup('rupa', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rupa->OptionCount = 5;
        $this->rupa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rupa->Param, "CustomMsg");
        $this->Fields['rupa'] = &$this->rupa;

        // bentuk_tubuh
        $this->bentuk_tubuh = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_bentuk_tubuh', 'bentuk_tubuh', '`bentuk_tubuh`', '`bentuk_tubuh`', 202, 13, -1, false, '`bentuk_tubuh`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->bentuk_tubuh->Nullable = false; // NOT NULL field
        $this->bentuk_tubuh->Required = true; // Required field
        $this->bentuk_tubuh->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->bentuk_tubuh->Lookup = new Lookup('bentuk_tubuh', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->bentuk_tubuh->Lookup = new Lookup('bentuk_tubuh', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->bentuk_tubuh->OptionCount = 10;
        $this->bentuk_tubuh->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bentuk_tubuh->Param, "CustomMsg");
        $this->Fields['bentuk_tubuh'] = &$this->bentuk_tubuh;

        // tindakan
        $this->tindakan = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_tindakan', 'tindakan', '`tindakan`', '`tindakan`', 202, 18, -1, false, '`tindakan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->tindakan->Nullable = false; // NOT NULL field
        $this->tindakan->Required = true; // Required field
        $this->tindakan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->tindakan->Lookup = new Lookup('tindakan', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->tindakan->Lookup = new Lookup('tindakan', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->tindakan->OptionCount = 15;
        $this->tindakan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tindakan->Param, "CustomMsg");
        $this->Fields['tindakan'] = &$this->tindakan;

        // pakaian
        $this->pakaian = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_pakaian', 'pakaian', '`pakaian`', '`pakaian`', 202, 17, -1, false, '`pakaian`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->pakaian->Nullable = false; // NOT NULL field
        $this->pakaian->Required = true; // Required field
        $this->pakaian->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->pakaian->Lookup = new Lookup('pakaian', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->pakaian->Lookup = new Lookup('pakaian', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->pakaian->OptionCount = 10;
        $this->pakaian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pakaian->Param, "CustomMsg");
        $this->Fields['pakaian'] = &$this->pakaian;

        // ekspresi
        $this->ekspresi = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_ekspresi', 'ekspresi', '`ekspresi`', '`ekspresi`', 202, 28, -1, false, '`ekspresi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->ekspresi->Nullable = false; // NOT NULL field
        $this->ekspresi->Required = true; // Required field
        $this->ekspresi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->ekspresi->Lookup = new Lookup('ekspresi', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ekspresi->Lookup = new Lookup('ekspresi', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ekspresi->OptionCount = 5;
        $this->ekspresi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ekspresi->Param, "CustomMsg");
        $this->Fields['ekspresi'] = &$this->ekspresi;

        // berbicara
        $this->berbicara = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_berbicara', 'berbicara', '`berbicara`', '`berbicara`', 202, 37, -1, false, '`berbicara`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->berbicara->Nullable = false; // NOT NULL field
        $this->berbicara->Required = true; // Required field
        $this->berbicara->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->berbicara->Lookup = new Lookup('berbicara', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->berbicara->Lookup = new Lookup('berbicara', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->berbicara->OptionCount = 5;
        $this->berbicara->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->berbicara->Param, "CustomMsg");
        $this->Fields['berbicara'] = &$this->berbicara;

        // penggunaan_kata
        $this->penggunaan_kata = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_penggunaan_kata', 'penggunaan_kata', '`penggunaan_kata`', '`penggunaan_kata`', 202, 36, -1, false, '`penggunaan_kata`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->penggunaan_kata->Nullable = false; // NOT NULL field
        $this->penggunaan_kata->Required = true; // Required field
        $this->penggunaan_kata->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->penggunaan_kata->Lookup = new Lookup('penggunaan_kata', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->penggunaan_kata->Lookup = new Lookup('penggunaan_kata', 'penilaian_psikologi', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->penggunaan_kata->OptionCount = 5;
        $this->penggunaan_kata->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->penggunaan_kata->Param, "CustomMsg");
        $this->Fields['penggunaan_kata'] = &$this->penggunaan_kata;

        // ciri_menyolok
        $this->ciri_menyolok = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_ciri_menyolok', 'ciri_menyolok', '`ciri_menyolok`', '`ciri_menyolok`', 201, 500, -1, false, '`ciri_menyolok`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ciri_menyolok->Nullable = false; // NOT NULL field
        $this->ciri_menyolok->Required = true; // Required field
        $this->ciri_menyolok->Sortable = true; // Allow sort
        $this->ciri_menyolok->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ciri_menyolok->Param, "CustomMsg");
        $this->Fields['ciri_menyolok'] = &$this->ciri_menyolok;

        // hasil_psikotes
        $this->hasil_psikotes = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_hasil_psikotes', 'hasil_psikotes', '`hasil_psikotes`', '`hasil_psikotes`', 201, 65535, -1, false, '`hasil_psikotes`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->hasil_psikotes->Nullable = false; // NOT NULL field
        $this->hasil_psikotes->Required = true; // Required field
        $this->hasil_psikotes->Sortable = true; // Allow sort
        $this->hasil_psikotes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hasil_psikotes->Param, "CustomMsg");
        $this->Fields['hasil_psikotes'] = &$this->hasil_psikotes;

        // kepribadian
        $this->kepribadian = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_kepribadian', 'kepribadian', '`kepribadian`', '`kepribadian`', 201, 65535, -1, false, '`kepribadian`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->kepribadian->Nullable = false; // NOT NULL field
        $this->kepribadian->Required = true; // Required field
        $this->kepribadian->Sortable = true; // Allow sort
        $this->kepribadian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kepribadian->Param, "CustomMsg");
        $this->Fields['kepribadian'] = &$this->kepribadian;

        // psikodinamika
        $this->psikodinamika = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_psikodinamika', 'psikodinamika', '`psikodinamika`', '`psikodinamika`', 201, 65535, -1, false, '`psikodinamika`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->psikodinamika->Nullable = false; // NOT NULL field
        $this->psikodinamika->Required = true; // Required field
        $this->psikodinamika->Sortable = true; // Allow sort
        $this->psikodinamika->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->psikodinamika->Param, "CustomMsg");
        $this->Fields['psikodinamika'] = &$this->psikodinamika;

        // kesimpulan_psikolog
        $this->kesimpulan_psikolog = new DbField('penilaian_psikologi', 'penilaian_psikologi', 'x_kesimpulan_psikolog', 'kesimpulan_psikolog', '`kesimpulan_psikolog`', '`kesimpulan_psikolog`', 201, 65535, -1, false, '`kesimpulan_psikolog`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->kesimpulan_psikolog->Nullable = false; // NOT NULL field
        $this->kesimpulan_psikolog->Required = true; // Required field
        $this->kesimpulan_psikolog->Sortable = true; // Allow sort
        $this->kesimpulan_psikolog->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kesimpulan_psikolog->Param, "CustomMsg");
        $this->Fields['kesimpulan_psikolog'] = &$this->kesimpulan_psikolog;
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

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Session master WHERE clause
    public function getMasterFilter()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "vigd") {
            if ($this->no_rawat->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`id_reg`", $this->no_rawat->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "vrajal") {
            if ($this->no_rawat->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`id_reg`", $this->no_rawat->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Session detail WHERE clause
    public function getDetailFilter()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "vigd") {
            if ($this->no_rawat->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`no_rawat`", $this->no_rawat->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "vrajal") {
            if ($this->no_rawat->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`no_rawat`", $this->no_rawat->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    // Master filter
    public function sqlMasterFilter_vigd()
    {
        return "`id_reg`=@id_reg@";
    }
    // Detail filter
    public function sqlDetailFilter_vigd()
    {
        return "`no_rawat`='@no_rawat@'";
    }

    // Master filter
    public function sqlMasterFilter_vrajal()
    {
        return "`id_reg`=@id_reg@";
    }
    // Detail filter
    public function sqlDetailFilter_vrajal()
    {
        return "`no_rawat`='@no_rawat@'";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`penilaian_psikologi`";
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
            $this->id_penilaian_psikologi->setDbValue($conn->lastInsertId());
            $rs['id_penilaian_psikologi'] = $this->id_penilaian_psikologi->DbValue;
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
            if (array_key_exists('id_penilaian_psikologi', $rs)) {
                AddFilter($where, QuotedName('id_penilaian_psikologi', $this->Dbid) . '=' . QuotedValue($rs['id_penilaian_psikologi'], $this->id_penilaian_psikologi->DataType, $this->Dbid));
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
        $this->id_penilaian_psikologi->DbValue = $row['id_penilaian_psikologi'];
        $this->no_rawat->DbValue = $row['no_rawat'];
        $this->tanggal->DbValue = $row['tanggal'];
        $this->nip->DbValue = $row['nip'];
        $this->anamnesis->DbValue = $row['anamnesis'];
        $this->dikirim_dari->DbValue = $row['dikirim_dari'];
        $this->tujuan_pemeriksaan->DbValue = $row['tujuan_pemeriksaan'];
        $this->ket_anamnesis->DbValue = $row['ket_anamnesis'];
        $this->rupa->DbValue = $row['rupa'];
        $this->bentuk_tubuh->DbValue = $row['bentuk_tubuh'];
        $this->tindakan->DbValue = $row['tindakan'];
        $this->pakaian->DbValue = $row['pakaian'];
        $this->ekspresi->DbValue = $row['ekspresi'];
        $this->berbicara->DbValue = $row['berbicara'];
        $this->penggunaan_kata->DbValue = $row['penggunaan_kata'];
        $this->ciri_menyolok->DbValue = $row['ciri_menyolok'];
        $this->hasil_psikotes->DbValue = $row['hasil_psikotes'];
        $this->kepribadian->DbValue = $row['kepribadian'];
        $this->psikodinamika->DbValue = $row['psikodinamika'];
        $this->kesimpulan_psikolog->DbValue = $row['kesimpulan_psikolog'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_penilaian_psikologi` = @id_penilaian_psikologi@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_penilaian_psikologi->CurrentValue : $this->id_penilaian_psikologi->OldValue;
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
                $this->id_penilaian_psikologi->CurrentValue = $keys[0];
            } else {
                $this->id_penilaian_psikologi->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_penilaian_psikologi', $row) ? $row['id_penilaian_psikologi'] : null;
        } else {
            $val = $this->id_penilaian_psikologi->OldValue !== null ? $this->id_penilaian_psikologi->OldValue : $this->id_penilaian_psikologi->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_penilaian_psikologi@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PenilaianPsikologiList");
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
        if ($pageName == "PenilaianPsikologiView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PenilaianPsikologiEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PenilaianPsikologiAdd") {
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
                return "PenilaianPsikologiView";
            case Config("API_ADD_ACTION"):
                return "PenilaianPsikologiAdd";
            case Config("API_EDIT_ACTION"):
                return "PenilaianPsikologiEdit";
            case Config("API_DELETE_ACTION"):
                return "PenilaianPsikologiDelete";
            case Config("API_LIST_ACTION"):
                return "PenilaianPsikologiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PenilaianPsikologiList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PenilaianPsikologiView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PenilaianPsikologiView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PenilaianPsikologiAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PenilaianPsikologiAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PenilaianPsikologiEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PenilaianPsikologiAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PenilaianPsikologiDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "vigd" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id_reg", $this->no_rawat->CurrentValue ?? $this->no_rawat->getSessionValue());
        }
        if ($this->getCurrentMasterTable() == "vrajal" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id_reg", $this->no_rawat->CurrentValue ?? $this->no_rawat->getSessionValue());
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_penilaian_psikologi:" . JsonEncode($this->id_penilaian_psikologi->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_penilaian_psikologi->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_penilaian_psikologi->CurrentValue);
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
            if (($keyValue = Param("id_penilaian_psikologi") ?? Route("id_penilaian_psikologi")) !== null) {
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
                $this->id_penilaian_psikologi->CurrentValue = $key;
            } else {
                $this->id_penilaian_psikologi->OldValue = $key;
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
        $this->id_penilaian_psikologi->setDbValue($row['id_penilaian_psikologi']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tanggal->setDbValue($row['tanggal']);
        $this->nip->setDbValue($row['nip']);
        $this->anamnesis->setDbValue($row['anamnesis']);
        $this->dikirim_dari->setDbValue($row['dikirim_dari']);
        $this->tujuan_pemeriksaan->setDbValue($row['tujuan_pemeriksaan']);
        $this->ket_anamnesis->setDbValue($row['ket_anamnesis']);
        $this->rupa->setDbValue($row['rupa']);
        $this->bentuk_tubuh->setDbValue($row['bentuk_tubuh']);
        $this->tindakan->setDbValue($row['tindakan']);
        $this->pakaian->setDbValue($row['pakaian']);
        $this->ekspresi->setDbValue($row['ekspresi']);
        $this->berbicara->setDbValue($row['berbicara']);
        $this->penggunaan_kata->setDbValue($row['penggunaan_kata']);
        $this->ciri_menyolok->setDbValue($row['ciri_menyolok']);
        $this->hasil_psikotes->setDbValue($row['hasil_psikotes']);
        $this->kepribadian->setDbValue($row['kepribadian']);
        $this->psikodinamika->setDbValue($row['psikodinamika']);
        $this->kesimpulan_psikolog->setDbValue($row['kesimpulan_psikolog']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_penilaian_psikologi

        // no_rawat

        // tanggal

        // nip

        // anamnesis

        // dikirim_dari

        // tujuan_pemeriksaan

        // ket_anamnesis

        // rupa

        // bentuk_tubuh

        // tindakan

        // pakaian

        // ekspresi

        // berbicara

        // penggunaan_kata

        // ciri_menyolok

        // hasil_psikotes

        // kepribadian

        // psikodinamika

        // kesimpulan_psikolog

        // id_penilaian_psikologi
        $this->id_penilaian_psikologi->ViewValue = $this->id_penilaian_psikologi->CurrentValue;
        $this->id_penilaian_psikologi->ViewValue = FormatNumber($this->id_penilaian_psikologi->ViewValue, 0, -2, -2, -2);
        $this->id_penilaian_psikologi->ViewCustomAttributes = "";

        // no_rawat
        $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->ViewCustomAttributes = "";

        // tanggal
        $this->tanggal->ViewValue = $this->tanggal->CurrentValue;
        $this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
        $this->tanggal->ViewCustomAttributes = "";

        // nip
        $this->nip->ViewValue = $this->nip->CurrentValue;
        $this->nip->ViewCustomAttributes = "";

        // anamnesis
        if (strval($this->anamnesis->CurrentValue) != "") {
            $this->anamnesis->ViewValue = $this->anamnesis->optionCaption($this->anamnesis->CurrentValue);
        } else {
            $this->anamnesis->ViewValue = null;
        }
        $this->anamnesis->ViewCustomAttributes = "";

        // dikirim_dari
        if (strval($this->dikirim_dari->CurrentValue) != "") {
            $this->dikirim_dari->ViewValue = $this->dikirim_dari->optionCaption($this->dikirim_dari->CurrentValue);
        } else {
            $this->dikirim_dari->ViewValue = null;
        }
        $this->dikirim_dari->ViewCustomAttributes = "";

        // tujuan_pemeriksaan
        if (strval($this->tujuan_pemeriksaan->CurrentValue) != "") {
            $this->tujuan_pemeriksaan->ViewValue = $this->tujuan_pemeriksaan->optionCaption($this->tujuan_pemeriksaan->CurrentValue);
        } else {
            $this->tujuan_pemeriksaan->ViewValue = null;
        }
        $this->tujuan_pemeriksaan->ViewCustomAttributes = "";

        // ket_anamnesis
        $this->ket_anamnesis->ViewValue = $this->ket_anamnesis->CurrentValue;
        $this->ket_anamnesis->ViewCustomAttributes = "";

        // rupa
        if (strval($this->rupa->CurrentValue) != "") {
            $this->rupa->ViewValue = $this->rupa->optionCaption($this->rupa->CurrentValue);
        } else {
            $this->rupa->ViewValue = null;
        }
        $this->rupa->ViewCustomAttributes = "";

        // bentuk_tubuh
        if (strval($this->bentuk_tubuh->CurrentValue) != "") {
            $this->bentuk_tubuh->ViewValue = $this->bentuk_tubuh->optionCaption($this->bentuk_tubuh->CurrentValue);
        } else {
            $this->bentuk_tubuh->ViewValue = null;
        }
        $this->bentuk_tubuh->ViewCustomAttributes = "";

        // tindakan
        if (strval($this->tindakan->CurrentValue) != "") {
            $this->tindakan->ViewValue = $this->tindakan->optionCaption($this->tindakan->CurrentValue);
        } else {
            $this->tindakan->ViewValue = null;
        }
        $this->tindakan->ViewCustomAttributes = "";

        // pakaian
        if (strval($this->pakaian->CurrentValue) != "") {
            $this->pakaian->ViewValue = $this->pakaian->optionCaption($this->pakaian->CurrentValue);
        } else {
            $this->pakaian->ViewValue = null;
        }
        $this->pakaian->ViewCustomAttributes = "";

        // ekspresi
        if (strval($this->ekspresi->CurrentValue) != "") {
            $this->ekspresi->ViewValue = $this->ekspresi->optionCaption($this->ekspresi->CurrentValue);
        } else {
            $this->ekspresi->ViewValue = null;
        }
        $this->ekspresi->ViewCustomAttributes = "";

        // berbicara
        if (strval($this->berbicara->CurrentValue) != "") {
            $this->berbicara->ViewValue = $this->berbicara->optionCaption($this->berbicara->CurrentValue);
        } else {
            $this->berbicara->ViewValue = null;
        }
        $this->berbicara->ViewCustomAttributes = "";

        // penggunaan_kata
        if (strval($this->penggunaan_kata->CurrentValue) != "") {
            $this->penggunaan_kata->ViewValue = $this->penggunaan_kata->optionCaption($this->penggunaan_kata->CurrentValue);
        } else {
            $this->penggunaan_kata->ViewValue = null;
        }
        $this->penggunaan_kata->ViewCustomAttributes = "";

        // ciri_menyolok
        $this->ciri_menyolok->ViewValue = $this->ciri_menyolok->CurrentValue;
        $this->ciri_menyolok->ViewCustomAttributes = "";

        // hasil_psikotes
        $this->hasil_psikotes->ViewValue = $this->hasil_psikotes->CurrentValue;
        $this->hasil_psikotes->ViewCustomAttributes = "";

        // kepribadian
        $this->kepribadian->ViewValue = $this->kepribadian->CurrentValue;
        $this->kepribadian->ViewCustomAttributes = "";

        // psikodinamika
        $this->psikodinamika->ViewValue = $this->psikodinamika->CurrentValue;
        $this->psikodinamika->ViewCustomAttributes = "";

        // kesimpulan_psikolog
        $this->kesimpulan_psikolog->ViewValue = $this->kesimpulan_psikolog->CurrentValue;
        $this->kesimpulan_psikolog->ViewCustomAttributes = "";

        // id_penilaian_psikologi
        $this->id_penilaian_psikologi->LinkCustomAttributes = "";
        $this->id_penilaian_psikologi->HrefValue = "";
        $this->id_penilaian_psikologi->TooltipValue = "";

        // no_rawat
        $this->no_rawat->LinkCustomAttributes = "";
        $this->no_rawat->HrefValue = "";
        $this->no_rawat->TooltipValue = "";

        // tanggal
        $this->tanggal->LinkCustomAttributes = "";
        $this->tanggal->HrefValue = "";
        $this->tanggal->TooltipValue = "";

        // nip
        $this->nip->LinkCustomAttributes = "";
        $this->nip->HrefValue = "";
        $this->nip->TooltipValue = "";

        // anamnesis
        $this->anamnesis->LinkCustomAttributes = "";
        $this->anamnesis->HrefValue = "";
        $this->anamnesis->TooltipValue = "";

        // dikirim_dari
        $this->dikirim_dari->LinkCustomAttributes = "";
        $this->dikirim_dari->HrefValue = "";
        $this->dikirim_dari->TooltipValue = "";

        // tujuan_pemeriksaan
        $this->tujuan_pemeriksaan->LinkCustomAttributes = "";
        $this->tujuan_pemeriksaan->HrefValue = "";
        $this->tujuan_pemeriksaan->TooltipValue = "";

        // ket_anamnesis
        $this->ket_anamnesis->LinkCustomAttributes = "";
        $this->ket_anamnesis->HrefValue = "";
        $this->ket_anamnesis->TooltipValue = "";

        // rupa
        $this->rupa->LinkCustomAttributes = "";
        $this->rupa->HrefValue = "";
        $this->rupa->TooltipValue = "";

        // bentuk_tubuh
        $this->bentuk_tubuh->LinkCustomAttributes = "";
        $this->bentuk_tubuh->HrefValue = "";
        $this->bentuk_tubuh->TooltipValue = "";

        // tindakan
        $this->tindakan->LinkCustomAttributes = "";
        $this->tindakan->HrefValue = "";
        $this->tindakan->TooltipValue = "";

        // pakaian
        $this->pakaian->LinkCustomAttributes = "";
        $this->pakaian->HrefValue = "";
        $this->pakaian->TooltipValue = "";

        // ekspresi
        $this->ekspresi->LinkCustomAttributes = "";
        $this->ekspresi->HrefValue = "";
        $this->ekspresi->TooltipValue = "";

        // berbicara
        $this->berbicara->LinkCustomAttributes = "";
        $this->berbicara->HrefValue = "";
        $this->berbicara->TooltipValue = "";

        // penggunaan_kata
        $this->penggunaan_kata->LinkCustomAttributes = "";
        $this->penggunaan_kata->HrefValue = "";
        $this->penggunaan_kata->TooltipValue = "";

        // ciri_menyolok
        $this->ciri_menyolok->LinkCustomAttributes = "";
        $this->ciri_menyolok->HrefValue = "";
        $this->ciri_menyolok->TooltipValue = "";

        // hasil_psikotes
        $this->hasil_psikotes->LinkCustomAttributes = "";
        $this->hasil_psikotes->HrefValue = "";
        $this->hasil_psikotes->TooltipValue = "";

        // kepribadian
        $this->kepribadian->LinkCustomAttributes = "";
        $this->kepribadian->HrefValue = "";
        $this->kepribadian->TooltipValue = "";

        // psikodinamika
        $this->psikodinamika->LinkCustomAttributes = "";
        $this->psikodinamika->HrefValue = "";
        $this->psikodinamika->TooltipValue = "";

        // kesimpulan_psikolog
        $this->kesimpulan_psikolog->LinkCustomAttributes = "";
        $this->kesimpulan_psikolog->HrefValue = "";
        $this->kesimpulan_psikolog->TooltipValue = "";

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

        // id_penilaian_psikologi
        $this->id_penilaian_psikologi->EditAttrs["class"] = "form-control";
        $this->id_penilaian_psikologi->EditCustomAttributes = "";
        $this->id_penilaian_psikologi->EditValue = $this->id_penilaian_psikologi->CurrentValue;
        $this->id_penilaian_psikologi->EditValue = FormatNumber($this->id_penilaian_psikologi->EditValue, 0, -2, -2, -2);
        $this->id_penilaian_psikologi->ViewCustomAttributes = "";

        // no_rawat
        $this->no_rawat->EditAttrs["class"] = "form-control";
        $this->no_rawat->EditCustomAttributes = "";
        if ($this->no_rawat->getSessionValue() != "") {
            $this->no_rawat->CurrentValue = GetForeignKeyValue($this->no_rawat->getSessionValue());
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";
        } else {
            if (!$this->no_rawat->Raw) {
                $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
            }
            $this->no_rawat->EditValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());
        }

        // tanggal
        $this->tanggal->EditAttrs["class"] = "form-control";
        $this->tanggal->EditCustomAttributes = "";
        $this->tanggal->EditValue = FormatDateTime($this->tanggal->CurrentValue, 8);
        $this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

        // nip
        $this->nip->EditAttrs["class"] = "form-control";
        $this->nip->EditCustomAttributes = "";
        if (!$this->nip->Raw) {
            $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
        }
        $this->nip->EditValue = $this->nip->CurrentValue;
        $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

        // anamnesis
        $this->anamnesis->EditCustomAttributes = "";
        $this->anamnesis->EditValue = $this->anamnesis->options(false);
        $this->anamnesis->PlaceHolder = RemoveHtml($this->anamnesis->caption());

        // dikirim_dari
        $this->dikirim_dari->EditCustomAttributes = "";
        $this->dikirim_dari->EditValue = $this->dikirim_dari->options(false);
        $this->dikirim_dari->PlaceHolder = RemoveHtml($this->dikirim_dari->caption());

        // tujuan_pemeriksaan
        $this->tujuan_pemeriksaan->EditCustomAttributes = "";
        $this->tujuan_pemeriksaan->EditValue = $this->tujuan_pemeriksaan->options(false);
        $this->tujuan_pemeriksaan->PlaceHolder = RemoveHtml($this->tujuan_pemeriksaan->caption());

        // ket_anamnesis
        $this->ket_anamnesis->EditAttrs["class"] = "form-control";
        $this->ket_anamnesis->EditCustomAttributes = "";
        $this->ket_anamnesis->EditValue = $this->ket_anamnesis->CurrentValue;
        $this->ket_anamnesis->PlaceHolder = RemoveHtml($this->ket_anamnesis->caption());

        // rupa
        $this->rupa->EditCustomAttributes = "";
        $this->rupa->EditValue = $this->rupa->options(false);
        $this->rupa->PlaceHolder = RemoveHtml($this->rupa->caption());

        // bentuk_tubuh
        $this->bentuk_tubuh->EditCustomAttributes = "";
        $this->bentuk_tubuh->EditValue = $this->bentuk_tubuh->options(false);
        $this->bentuk_tubuh->PlaceHolder = RemoveHtml($this->bentuk_tubuh->caption());

        // tindakan
        $this->tindakan->EditCustomAttributes = "";
        $this->tindakan->EditValue = $this->tindakan->options(false);
        $this->tindakan->PlaceHolder = RemoveHtml($this->tindakan->caption());

        // pakaian
        $this->pakaian->EditCustomAttributes = "";
        $this->pakaian->EditValue = $this->pakaian->options(false);
        $this->pakaian->PlaceHolder = RemoveHtml($this->pakaian->caption());

        // ekspresi
        $this->ekspresi->EditCustomAttributes = "";
        $this->ekspresi->EditValue = $this->ekspresi->options(false);
        $this->ekspresi->PlaceHolder = RemoveHtml($this->ekspresi->caption());

        // berbicara
        $this->berbicara->EditCustomAttributes = "";
        $this->berbicara->EditValue = $this->berbicara->options(false);
        $this->berbicara->PlaceHolder = RemoveHtml($this->berbicara->caption());

        // penggunaan_kata
        $this->penggunaan_kata->EditCustomAttributes = "";
        $this->penggunaan_kata->EditValue = $this->penggunaan_kata->options(false);
        $this->penggunaan_kata->PlaceHolder = RemoveHtml($this->penggunaan_kata->caption());

        // ciri_menyolok
        $this->ciri_menyolok->EditAttrs["class"] = "form-control";
        $this->ciri_menyolok->EditCustomAttributes = "";
        $this->ciri_menyolok->EditValue = $this->ciri_menyolok->CurrentValue;
        $this->ciri_menyolok->PlaceHolder = RemoveHtml($this->ciri_menyolok->caption());

        // hasil_psikotes
        $this->hasil_psikotes->EditAttrs["class"] = "form-control";
        $this->hasil_psikotes->EditCustomAttributes = "";
        $this->hasil_psikotes->EditValue = $this->hasil_psikotes->CurrentValue;
        $this->hasil_psikotes->PlaceHolder = RemoveHtml($this->hasil_psikotes->caption());

        // kepribadian
        $this->kepribadian->EditAttrs["class"] = "form-control";
        $this->kepribadian->EditCustomAttributes = "";
        $this->kepribadian->EditValue = $this->kepribadian->CurrentValue;
        $this->kepribadian->PlaceHolder = RemoveHtml($this->kepribadian->caption());

        // psikodinamika
        $this->psikodinamika->EditAttrs["class"] = "form-control";
        $this->psikodinamika->EditCustomAttributes = "";
        $this->psikodinamika->EditValue = $this->psikodinamika->CurrentValue;
        $this->psikodinamika->PlaceHolder = RemoveHtml($this->psikodinamika->caption());

        // kesimpulan_psikolog
        $this->kesimpulan_psikolog->EditAttrs["class"] = "form-control";
        $this->kesimpulan_psikolog->EditCustomAttributes = "";
        $this->kesimpulan_psikolog->EditValue = $this->kesimpulan_psikolog->CurrentValue;
        $this->kesimpulan_psikolog->PlaceHolder = RemoveHtml($this->kesimpulan_psikolog->caption());

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
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->anamnesis);
                    $doc->exportCaption($this->dikirim_dari);
                    $doc->exportCaption($this->tujuan_pemeriksaan);
                    $doc->exportCaption($this->ket_anamnesis);
                    $doc->exportCaption($this->rupa);
                    $doc->exportCaption($this->bentuk_tubuh);
                    $doc->exportCaption($this->tindakan);
                    $doc->exportCaption($this->pakaian);
                    $doc->exportCaption($this->ekspresi);
                    $doc->exportCaption($this->berbicara);
                    $doc->exportCaption($this->penggunaan_kata);
                    $doc->exportCaption($this->ciri_menyolok);
                    $doc->exportCaption($this->hasil_psikotes);
                    $doc->exportCaption($this->kepribadian);
                    $doc->exportCaption($this->psikodinamika);
                    $doc->exportCaption($this->kesimpulan_psikolog);
                } else {
                    $doc->exportCaption($this->id_penilaian_psikologi);
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->anamnesis);
                    $doc->exportCaption($this->dikirim_dari);
                    $doc->exportCaption($this->tujuan_pemeriksaan);
                    $doc->exportCaption($this->rupa);
                    $doc->exportCaption($this->bentuk_tubuh);
                    $doc->exportCaption($this->tindakan);
                    $doc->exportCaption($this->pakaian);
                    $doc->exportCaption($this->ekspresi);
                    $doc->exportCaption($this->berbicara);
                    $doc->exportCaption($this->penggunaan_kata);
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
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->anamnesis);
                        $doc->exportField($this->dikirim_dari);
                        $doc->exportField($this->tujuan_pemeriksaan);
                        $doc->exportField($this->ket_anamnesis);
                        $doc->exportField($this->rupa);
                        $doc->exportField($this->bentuk_tubuh);
                        $doc->exportField($this->tindakan);
                        $doc->exportField($this->pakaian);
                        $doc->exportField($this->ekspresi);
                        $doc->exportField($this->berbicara);
                        $doc->exportField($this->penggunaan_kata);
                        $doc->exportField($this->ciri_menyolok);
                        $doc->exportField($this->hasil_psikotes);
                        $doc->exportField($this->kepribadian);
                        $doc->exportField($this->psikodinamika);
                        $doc->exportField($this->kesimpulan_psikolog);
                    } else {
                        $doc->exportField($this->id_penilaian_psikologi);
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->anamnesis);
                        $doc->exportField($this->dikirim_dari);
                        $doc->exportField($this->tujuan_pemeriksaan);
                        $doc->exportField($this->rupa);
                        $doc->exportField($this->bentuk_tubuh);
                        $doc->exportField($this->tindakan);
                        $doc->exportField($this->pakaian);
                        $doc->exportField($this->ekspresi);
                        $doc->exportField($this->berbicara);
                        $doc->exportField($this->penggunaan_kata);
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
