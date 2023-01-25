<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pemeriksaan_obstetri_ralan
 */
class PemeriksaanObstetriRalan extends DbTable
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
    public $no_rawat;
    public $tgl_perawatan;
    public $jam_rawat;
    public $tinggi_uteri;
    public $janin;
    public $letak;
    public $panggul;
    public $denyut;
    public $kontraksi;
    public $kualitas_mnt;
    public $kualitas_dtk;
    public $fluksus;
    public $albus;
    public $vulva;
    public $portio;
    public $dalam;
    public $tebal;
    public $arah;
    public $pembukaan;
    public $penurunan;
    public $denominator;
    public $ketuban;
    public $feto;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pemeriksaan_obstetri_ralan';
        $this->TableName = 'pemeriksaan_obstetri_ralan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`pemeriksaan_obstetri_ralan`";
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

        // no_rawat
        $this->no_rawat = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_no_rawat', 'no_rawat', '`no_rawat`', '`no_rawat`', 200, 17, -1, false, '`no_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->IsPrimaryKey = true; // Primary key field
        $this->no_rawat->Nullable = false; // NOT NULL field
        $this->no_rawat->Required = true; // Required field
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // tgl_perawatan
        $this->tgl_perawatan = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_tgl_perawatan', 'tgl_perawatan', '`tgl_perawatan`', CastDateFieldForLike("`tgl_perawatan`", 0, "DB"), 133, 10, 0, false, '`tgl_perawatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_perawatan->IsPrimaryKey = true; // Primary key field
        $this->tgl_perawatan->Nullable = false; // NOT NULL field
        $this->tgl_perawatan->Required = true; // Required field
        $this->tgl_perawatan->Sortable = true; // Allow sort
        $this->tgl_perawatan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_perawatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_perawatan->Param, "CustomMsg");
        $this->Fields['tgl_perawatan'] = &$this->tgl_perawatan;

        // jam_rawat
        $this->jam_rawat = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_jam_rawat', 'jam_rawat', '`jam_rawat`', CastDateFieldForLike("`jam_rawat`", 4, "DB"), 134, 10, 4, false, '`jam_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jam_rawat->IsPrimaryKey = true; // Primary key field
        $this->jam_rawat->Nullable = false; // NOT NULL field
        $this->jam_rawat->Required = true; // Required field
        $this->jam_rawat->Sortable = true; // Allow sort
        $this->jam_rawat->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
        $this->jam_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jam_rawat->Param, "CustomMsg");
        $this->Fields['jam_rawat'] = &$this->jam_rawat;

        // tinggi_uteri
        $this->tinggi_uteri = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_tinggi_uteri', 'tinggi_uteri', '`tinggi_uteri`', '`tinggi_uteri`', 200, 5, -1, false, '`tinggi_uteri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tinggi_uteri->Sortable = true; // Allow sort
        $this->tinggi_uteri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tinggi_uteri->Param, "CustomMsg");
        $this->Fields['tinggi_uteri'] = &$this->tinggi_uteri;

        // janin
        $this->janin = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_janin', 'janin', '`janin`', '`janin`', 202, 7, -1, false, '`janin`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->janin->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->janin->Lookup = new Lookup('janin', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->janin->Lookup = new Lookup('janin', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->janin->OptionCount = 3;
        $this->janin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->janin->Param, "CustomMsg");
        $this->Fields['janin'] = &$this->janin;

        // letak
        $this->letak = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_letak', 'letak', '`letak`', '`letak`', 200, 50, -1, false, '`letak`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->letak->Sortable = true; // Allow sort
        $this->letak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->letak->Param, "CustomMsg");
        $this->Fields['letak'] = &$this->letak;

        // panggul
        $this->panggul = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_panggul', 'panggul', '`panggul`', '`panggul`', 202, 3, -1, false, '`panggul`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->panggul->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->panggul->Lookup = new Lookup('panggul', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->panggul->Lookup = new Lookup('panggul', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->panggul->OptionCount = 6;
        $this->panggul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->panggul->Param, "CustomMsg");
        $this->Fields['panggul'] = &$this->panggul;

        // denyut
        $this->denyut = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_denyut', 'denyut', '`denyut`', '`denyut`', 200, 5, -1, false, '`denyut`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->denyut->Sortable = true; // Allow sort
        $this->denyut->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->denyut->Param, "CustomMsg");
        $this->Fields['denyut'] = &$this->denyut;

        // kontraksi
        $this->kontraksi = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_kontraksi', 'kontraksi', '`kontraksi`', '`kontraksi`', 202, 1, -1, false, '`kontraksi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kontraksi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kontraksi->Lookup = new Lookup('kontraksi', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kontraksi->Lookup = new Lookup('kontraksi', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kontraksi->OptionCount = 2;
        $this->kontraksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kontraksi->Param, "CustomMsg");
        $this->Fields['kontraksi'] = &$this->kontraksi;

        // kualitas_mnt
        $this->kualitas_mnt = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_kualitas_mnt', 'kualitas_mnt', '`kualitas_mnt`', '`kualitas_mnt`', 200, 5, -1, false, '`kualitas_mnt`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kualitas_mnt->Sortable = true; // Allow sort
        $this->kualitas_mnt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kualitas_mnt->Param, "CustomMsg");
        $this->Fields['kualitas_mnt'] = &$this->kualitas_mnt;

        // kualitas_dtk
        $this->kualitas_dtk = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_kualitas_dtk', 'kualitas_dtk', '`kualitas_dtk`', '`kualitas_dtk`', 200, 5, -1, false, '`kualitas_dtk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kualitas_dtk->Sortable = true; // Allow sort
        $this->kualitas_dtk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kualitas_dtk->Param, "CustomMsg");
        $this->Fields['kualitas_dtk'] = &$this->kualitas_dtk;

        // fluksus
        $this->fluksus = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_fluksus', 'fluksus', '`fluksus`', '`fluksus`', 202, 1, -1, false, '`fluksus`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->fluksus->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->fluksus->Lookup = new Lookup('fluksus', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->fluksus->Lookup = new Lookup('fluksus', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->fluksus->OptionCount = 2;
        $this->fluksus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fluksus->Param, "CustomMsg");
        $this->Fields['fluksus'] = &$this->fluksus;

        // albus
        $this->albus = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_albus', 'albus', '`albus`', '`albus`', 202, 1, -1, false, '`albus`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->albus->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->albus->Lookup = new Lookup('albus', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->albus->Lookup = new Lookup('albus', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->albus->OptionCount = 2;
        $this->albus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->albus->Param, "CustomMsg");
        $this->Fields['albus'] = &$this->albus;

        // vulva
        $this->vulva = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_vulva', 'vulva', '`vulva`', '`vulva`', 200, 50, -1, false, '`vulva`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vulva->Sortable = true; // Allow sort
        $this->vulva->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->vulva->Param, "CustomMsg");
        $this->Fields['vulva'] = &$this->vulva;

        // portio
        $this->portio = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_portio', 'portio', '`portio`', '`portio`', 200, 50, -1, false, '`portio`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->portio->Sortable = true; // Allow sort
        $this->portio->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->portio->Param, "CustomMsg");
        $this->Fields['portio'] = &$this->portio;

        // dalam
        $this->dalam = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_dalam', 'dalam', '`dalam`', '`dalam`', 202, 6, -1, false, '`dalam`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->dalam->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->dalam->Lookup = new Lookup('dalam', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->dalam->Lookup = new Lookup('dalam', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->dalam->OptionCount = 2;
        $this->dalam->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dalam->Param, "CustomMsg");
        $this->Fields['dalam'] = &$this->dalam;

        // tebal
        $this->tebal = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_tebal', 'tebal', '`tebal`', '`tebal`', 200, 5, -1, false, '`tebal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tebal->Sortable = true; // Allow sort
        $this->tebal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tebal->Param, "CustomMsg");
        $this->Fields['tebal'] = &$this->tebal;

        // arah
        $this->arah = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_arah', 'arah', '`arah`', '`arah`', 202, 8, -1, false, '`arah`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->arah->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->arah->Lookup = new Lookup('arah', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->arah->Lookup = new Lookup('arah', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->arah->OptionCount = 3;
        $this->arah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->arah->Param, "CustomMsg");
        $this->Fields['arah'] = &$this->arah;

        // pembukaan
        $this->pembukaan = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_pembukaan', 'pembukaan', '`pembukaan`', '`pembukaan`', 200, 50, -1, false, '`pembukaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pembukaan->Sortable = true; // Allow sort
        $this->pembukaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pembukaan->Param, "CustomMsg");
        $this->Fields['pembukaan'] = &$this->pembukaan;

        // penurunan
        $this->penurunan = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_penurunan', 'penurunan', '`penurunan`', '`penurunan`', 200, 50, -1, false, '`penurunan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->penurunan->Sortable = true; // Allow sort
        $this->penurunan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->penurunan->Param, "CustomMsg");
        $this->Fields['penurunan'] = &$this->penurunan;

        // denominator
        $this->denominator = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_denominator', 'denominator', '`denominator`', '`denominator`', 200, 50, -1, false, '`denominator`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->denominator->Nullable = false; // NOT NULL field
        $this->denominator->Required = true; // Required field
        $this->denominator->Sortable = true; // Allow sort
        $this->denominator->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->denominator->Param, "CustomMsg");
        $this->Fields['denominator'] = &$this->denominator;

        // ketuban
        $this->ketuban = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_ketuban', 'ketuban', '`ketuban`', '`ketuban`', 202, 1, -1, false, '`ketuban`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->ketuban->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->ketuban->Lookup = new Lookup('ketuban', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ketuban->Lookup = new Lookup('ketuban', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ketuban->OptionCount = 2;
        $this->ketuban->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ketuban->Param, "CustomMsg");
        $this->Fields['ketuban'] = &$this->ketuban;

        // feto
        $this->feto = new DbField('pemeriksaan_obstetri_ralan', 'pemeriksaan_obstetri_ralan', 'x_feto', 'feto', '`feto`', '`feto`', 202, 12, -1, false, '`feto`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->feto->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->feto->Lookup = new Lookup('feto', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->feto->Lookup = new Lookup('feto', 'pemeriksaan_obstetri_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->feto->OptionCount = 3;
        $this->feto->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->feto->Param, "CustomMsg");
        $this->Fields['feto'] = &$this->feto;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`pemeriksaan_obstetri_ralan`";
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
            if (array_key_exists('no_rawat', $rs)) {
                AddFilter($where, QuotedName('no_rawat', $this->Dbid) . '=' . QuotedValue($rs['no_rawat'], $this->no_rawat->DataType, $this->Dbid));
            }
            if (array_key_exists('tgl_perawatan', $rs)) {
                AddFilter($where, QuotedName('tgl_perawatan', $this->Dbid) . '=' . QuotedValue($rs['tgl_perawatan'], $this->tgl_perawatan->DataType, $this->Dbid));
            }
            if (array_key_exists('jam_rawat', $rs)) {
                AddFilter($where, QuotedName('jam_rawat', $this->Dbid) . '=' . QuotedValue($rs['jam_rawat'], $this->jam_rawat->DataType, $this->Dbid));
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
        $this->no_rawat->DbValue = $row['no_rawat'];
        $this->tgl_perawatan->DbValue = $row['tgl_perawatan'];
        $this->jam_rawat->DbValue = $row['jam_rawat'];
        $this->tinggi_uteri->DbValue = $row['tinggi_uteri'];
        $this->janin->DbValue = $row['janin'];
        $this->letak->DbValue = $row['letak'];
        $this->panggul->DbValue = $row['panggul'];
        $this->denyut->DbValue = $row['denyut'];
        $this->kontraksi->DbValue = $row['kontraksi'];
        $this->kualitas_mnt->DbValue = $row['kualitas_mnt'];
        $this->kualitas_dtk->DbValue = $row['kualitas_dtk'];
        $this->fluksus->DbValue = $row['fluksus'];
        $this->albus->DbValue = $row['albus'];
        $this->vulva->DbValue = $row['vulva'];
        $this->portio->DbValue = $row['portio'];
        $this->dalam->DbValue = $row['dalam'];
        $this->tebal->DbValue = $row['tebal'];
        $this->arah->DbValue = $row['arah'];
        $this->pembukaan->DbValue = $row['pembukaan'];
        $this->penurunan->DbValue = $row['penurunan'];
        $this->denominator->DbValue = $row['denominator'];
        $this->ketuban->DbValue = $row['ketuban'];
        $this->feto->DbValue = $row['feto'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`no_rawat` = '@no_rawat@' AND `tgl_perawatan` = '@tgl_perawatan@' AND `jam_rawat` = '@jam_rawat@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->no_rawat->CurrentValue : $this->no_rawat->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->tgl_perawatan->CurrentValue : $this->tgl_perawatan->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->jam_rawat->CurrentValue : $this->jam_rawat->OldValue;
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
        if (count($keys) == 3) {
            if ($current) {
                $this->no_rawat->CurrentValue = $keys[0];
            } else {
                $this->no_rawat->OldValue = $keys[0];
            }
            if ($current) {
                $this->tgl_perawatan->CurrentValue = $keys[1];
            } else {
                $this->tgl_perawatan->OldValue = $keys[1];
            }
            if ($current) {
                $this->jam_rawat->CurrentValue = $keys[2];
            } else {
                $this->jam_rawat->OldValue = $keys[2];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('no_rawat', $row) ? $row['no_rawat'] : null;
        } else {
            $val = $this->no_rawat->OldValue !== null ? $this->no_rawat->OldValue : $this->no_rawat->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@no_rawat@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('tgl_perawatan', $row) ? $row['tgl_perawatan'] : null;
        } else {
            $val = $this->tgl_perawatan->OldValue !== null ? $this->tgl_perawatan->OldValue : $this->tgl_perawatan->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@tgl_perawatan@", AdjustSql(UnFormatDateTime($val, 0), $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('jam_rawat', $row) ? $row['jam_rawat'] : null;
        } else {
            $val = $this->jam_rawat->OldValue !== null ? $this->jam_rawat->OldValue : $this->jam_rawat->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@jam_rawat@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PemeriksaanObstetriRalanList");
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
        if ($pageName == "PemeriksaanObstetriRalanView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PemeriksaanObstetriRalanEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PemeriksaanObstetriRalanAdd") {
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
                return "PemeriksaanObstetriRalanView";
            case Config("API_ADD_ACTION"):
                return "PemeriksaanObstetriRalanAdd";
            case Config("API_EDIT_ACTION"):
                return "PemeriksaanObstetriRalanEdit";
            case Config("API_DELETE_ACTION"):
                return "PemeriksaanObstetriRalanDelete";
            case Config("API_LIST_ACTION"):
                return "PemeriksaanObstetriRalanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PemeriksaanObstetriRalanList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PemeriksaanObstetriRalanView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PemeriksaanObstetriRalanView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PemeriksaanObstetriRalanAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PemeriksaanObstetriRalanAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PemeriksaanObstetriRalanEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PemeriksaanObstetriRalanAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PemeriksaanObstetriRalanDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "no_rawat:" . JsonEncode($this->no_rawat->CurrentValue, "string");
        $json .= ",tgl_perawatan:" . JsonEncode($this->tgl_perawatan->CurrentValue, "string");
        $json .= ",jam_rawat:" . JsonEncode($this->jam_rawat->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->no_rawat->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->no_rawat->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->tgl_perawatan->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->tgl_perawatan->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->jam_rawat->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->jam_rawat->CurrentValue);
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
            for ($i = 0; $i < $cnt; $i++) {
                $arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
            }
        } else {
            if (($keyValue = Param("no_rawat") ?? Route("no_rawat")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("tgl_perawatan") ?? Route("tgl_perawatan")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("jam_rawat") ?? Route("jam_rawat")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (is_array($arKeys)) {
                $arKeys[] = $arKey;
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_array($key) || count($key) != 3) {
                    continue; // Just skip so other keys will still work
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
                $this->no_rawat->CurrentValue = $key[0];
            } else {
                $this->no_rawat->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->tgl_perawatan->CurrentValue = $key[1];
            } else {
                $this->tgl_perawatan->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->jam_rawat->CurrentValue = $key[2];
            } else {
                $this->jam_rawat->OldValue = $key[2];
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
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tgl_perawatan->setDbValue($row['tgl_perawatan']);
        $this->jam_rawat->setDbValue($row['jam_rawat']);
        $this->tinggi_uteri->setDbValue($row['tinggi_uteri']);
        $this->janin->setDbValue($row['janin']);
        $this->letak->setDbValue($row['letak']);
        $this->panggul->setDbValue($row['panggul']);
        $this->denyut->setDbValue($row['denyut']);
        $this->kontraksi->setDbValue($row['kontraksi']);
        $this->kualitas_mnt->setDbValue($row['kualitas_mnt']);
        $this->kualitas_dtk->setDbValue($row['kualitas_dtk']);
        $this->fluksus->setDbValue($row['fluksus']);
        $this->albus->setDbValue($row['albus']);
        $this->vulva->setDbValue($row['vulva']);
        $this->portio->setDbValue($row['portio']);
        $this->dalam->setDbValue($row['dalam']);
        $this->tebal->setDbValue($row['tebal']);
        $this->arah->setDbValue($row['arah']);
        $this->pembukaan->setDbValue($row['pembukaan']);
        $this->penurunan->setDbValue($row['penurunan']);
        $this->denominator->setDbValue($row['denominator']);
        $this->ketuban->setDbValue($row['ketuban']);
        $this->feto->setDbValue($row['feto']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // no_rawat

        // tgl_perawatan

        // jam_rawat

        // tinggi_uteri

        // janin

        // letak

        // panggul

        // denyut

        // kontraksi

        // kualitas_mnt

        // kualitas_dtk

        // fluksus

        // albus

        // vulva

        // portio

        // dalam

        // tebal

        // arah

        // pembukaan

        // penurunan

        // denominator

        // ketuban

        // feto

        // no_rawat
        $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->ViewCustomAttributes = "";

        // tgl_perawatan
        $this->tgl_perawatan->ViewValue = $this->tgl_perawatan->CurrentValue;
        $this->tgl_perawatan->ViewValue = FormatDateTime($this->tgl_perawatan->ViewValue, 0);
        $this->tgl_perawatan->ViewCustomAttributes = "";

        // jam_rawat
        $this->jam_rawat->ViewValue = $this->jam_rawat->CurrentValue;
        $this->jam_rawat->ViewValue = FormatDateTime($this->jam_rawat->ViewValue, 4);
        $this->jam_rawat->ViewCustomAttributes = "";

        // tinggi_uteri
        $this->tinggi_uteri->ViewValue = $this->tinggi_uteri->CurrentValue;
        $this->tinggi_uteri->ViewCustomAttributes = "";

        // janin
        if (strval($this->janin->CurrentValue) != "") {
            $this->janin->ViewValue = $this->janin->optionCaption($this->janin->CurrentValue);
        } else {
            $this->janin->ViewValue = null;
        }
        $this->janin->ViewCustomAttributes = "";

        // letak
        $this->letak->ViewValue = $this->letak->CurrentValue;
        $this->letak->ViewCustomAttributes = "";

        // panggul
        if (strval($this->panggul->CurrentValue) != "") {
            $this->panggul->ViewValue = $this->panggul->optionCaption($this->panggul->CurrentValue);
        } else {
            $this->panggul->ViewValue = null;
        }
        $this->panggul->ViewCustomAttributes = "";

        // denyut
        $this->denyut->ViewValue = $this->denyut->CurrentValue;
        $this->denyut->ViewCustomAttributes = "";

        // kontraksi
        if (strval($this->kontraksi->CurrentValue) != "") {
            $this->kontraksi->ViewValue = $this->kontraksi->optionCaption($this->kontraksi->CurrentValue);
        } else {
            $this->kontraksi->ViewValue = null;
        }
        $this->kontraksi->ViewCustomAttributes = "";

        // kualitas_mnt
        $this->kualitas_mnt->ViewValue = $this->kualitas_mnt->CurrentValue;
        $this->kualitas_mnt->ViewCustomAttributes = "";

        // kualitas_dtk
        $this->kualitas_dtk->ViewValue = $this->kualitas_dtk->CurrentValue;
        $this->kualitas_dtk->ViewCustomAttributes = "";

        // fluksus
        if (strval($this->fluksus->CurrentValue) != "") {
            $this->fluksus->ViewValue = $this->fluksus->optionCaption($this->fluksus->CurrentValue);
        } else {
            $this->fluksus->ViewValue = null;
        }
        $this->fluksus->ViewCustomAttributes = "";

        // albus
        if (strval($this->albus->CurrentValue) != "") {
            $this->albus->ViewValue = $this->albus->optionCaption($this->albus->CurrentValue);
        } else {
            $this->albus->ViewValue = null;
        }
        $this->albus->ViewCustomAttributes = "";

        // vulva
        $this->vulva->ViewValue = $this->vulva->CurrentValue;
        $this->vulva->ViewCustomAttributes = "";

        // portio
        $this->portio->ViewValue = $this->portio->CurrentValue;
        $this->portio->ViewCustomAttributes = "";

        // dalam
        if (strval($this->dalam->CurrentValue) != "") {
            $this->dalam->ViewValue = $this->dalam->optionCaption($this->dalam->CurrentValue);
        } else {
            $this->dalam->ViewValue = null;
        }
        $this->dalam->ViewCustomAttributes = "";

        // tebal
        $this->tebal->ViewValue = $this->tebal->CurrentValue;
        $this->tebal->ViewCustomAttributes = "";

        // arah
        if (strval($this->arah->CurrentValue) != "") {
            $this->arah->ViewValue = $this->arah->optionCaption($this->arah->CurrentValue);
        } else {
            $this->arah->ViewValue = null;
        }
        $this->arah->ViewCustomAttributes = "";

        // pembukaan
        $this->pembukaan->ViewValue = $this->pembukaan->CurrentValue;
        $this->pembukaan->ViewCustomAttributes = "";

        // penurunan
        $this->penurunan->ViewValue = $this->penurunan->CurrentValue;
        $this->penurunan->ViewCustomAttributes = "";

        // denominator
        $this->denominator->ViewValue = $this->denominator->CurrentValue;
        $this->denominator->ViewCustomAttributes = "";

        // ketuban
        if (strval($this->ketuban->CurrentValue) != "") {
            $this->ketuban->ViewValue = $this->ketuban->optionCaption($this->ketuban->CurrentValue);
        } else {
            $this->ketuban->ViewValue = null;
        }
        $this->ketuban->ViewCustomAttributes = "";

        // feto
        if (strval($this->feto->CurrentValue) != "") {
            $this->feto->ViewValue = $this->feto->optionCaption($this->feto->CurrentValue);
        } else {
            $this->feto->ViewValue = null;
        }
        $this->feto->ViewCustomAttributes = "";

        // no_rawat
        $this->no_rawat->LinkCustomAttributes = "";
        $this->no_rawat->HrefValue = "";
        $this->no_rawat->TooltipValue = "";

        // tgl_perawatan
        $this->tgl_perawatan->LinkCustomAttributes = "";
        $this->tgl_perawatan->HrefValue = "";
        $this->tgl_perawatan->TooltipValue = "";

        // jam_rawat
        $this->jam_rawat->LinkCustomAttributes = "";
        $this->jam_rawat->HrefValue = "";
        $this->jam_rawat->TooltipValue = "";

        // tinggi_uteri
        $this->tinggi_uteri->LinkCustomAttributes = "";
        $this->tinggi_uteri->HrefValue = "";
        $this->tinggi_uteri->TooltipValue = "";

        // janin
        $this->janin->LinkCustomAttributes = "";
        $this->janin->HrefValue = "";
        $this->janin->TooltipValue = "";

        // letak
        $this->letak->LinkCustomAttributes = "";
        $this->letak->HrefValue = "";
        $this->letak->TooltipValue = "";

        // panggul
        $this->panggul->LinkCustomAttributes = "";
        $this->panggul->HrefValue = "";
        $this->panggul->TooltipValue = "";

        // denyut
        $this->denyut->LinkCustomAttributes = "";
        $this->denyut->HrefValue = "";
        $this->denyut->TooltipValue = "";

        // kontraksi
        $this->kontraksi->LinkCustomAttributes = "";
        $this->kontraksi->HrefValue = "";
        $this->kontraksi->TooltipValue = "";

        // kualitas_mnt
        $this->kualitas_mnt->LinkCustomAttributes = "";
        $this->kualitas_mnt->HrefValue = "";
        $this->kualitas_mnt->TooltipValue = "";

        // kualitas_dtk
        $this->kualitas_dtk->LinkCustomAttributes = "";
        $this->kualitas_dtk->HrefValue = "";
        $this->kualitas_dtk->TooltipValue = "";

        // fluksus
        $this->fluksus->LinkCustomAttributes = "";
        $this->fluksus->HrefValue = "";
        $this->fluksus->TooltipValue = "";

        // albus
        $this->albus->LinkCustomAttributes = "";
        $this->albus->HrefValue = "";
        $this->albus->TooltipValue = "";

        // vulva
        $this->vulva->LinkCustomAttributes = "";
        $this->vulva->HrefValue = "";
        $this->vulva->TooltipValue = "";

        // portio
        $this->portio->LinkCustomAttributes = "";
        $this->portio->HrefValue = "";
        $this->portio->TooltipValue = "";

        // dalam
        $this->dalam->LinkCustomAttributes = "";
        $this->dalam->HrefValue = "";
        $this->dalam->TooltipValue = "";

        // tebal
        $this->tebal->LinkCustomAttributes = "";
        $this->tebal->HrefValue = "";
        $this->tebal->TooltipValue = "";

        // arah
        $this->arah->LinkCustomAttributes = "";
        $this->arah->HrefValue = "";
        $this->arah->TooltipValue = "";

        // pembukaan
        $this->pembukaan->LinkCustomAttributes = "";
        $this->pembukaan->HrefValue = "";
        $this->pembukaan->TooltipValue = "";

        // penurunan
        $this->penurunan->LinkCustomAttributes = "";
        $this->penurunan->HrefValue = "";
        $this->penurunan->TooltipValue = "";

        // denominator
        $this->denominator->LinkCustomAttributes = "";
        $this->denominator->HrefValue = "";
        $this->denominator->TooltipValue = "";

        // ketuban
        $this->ketuban->LinkCustomAttributes = "";
        $this->ketuban->HrefValue = "";
        $this->ketuban->TooltipValue = "";

        // feto
        $this->feto->LinkCustomAttributes = "";
        $this->feto->HrefValue = "";
        $this->feto->TooltipValue = "";

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

        // no_rawat
        $this->no_rawat->EditAttrs["class"] = "form-control";
        $this->no_rawat->EditCustomAttributes = "";
        if (!$this->no_rawat->Raw) {
            $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
        }
        $this->no_rawat->EditValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());

        // tgl_perawatan
        $this->tgl_perawatan->EditAttrs["class"] = "form-control";
        $this->tgl_perawatan->EditCustomAttributes = "";
        $this->tgl_perawatan->EditValue = FormatDateTime($this->tgl_perawatan->CurrentValue, 8);
        $this->tgl_perawatan->PlaceHolder = RemoveHtml($this->tgl_perawatan->caption());

        // jam_rawat
        $this->jam_rawat->EditAttrs["class"] = "form-control";
        $this->jam_rawat->EditCustomAttributes = "";
        $this->jam_rawat->EditValue = FormatDateTime($this->jam_rawat->CurrentValue, 4);
        $this->jam_rawat->PlaceHolder = RemoveHtml($this->jam_rawat->caption());

        // tinggi_uteri
        $this->tinggi_uteri->EditAttrs["class"] = "form-control";
        $this->tinggi_uteri->EditCustomAttributes = "";
        if (!$this->tinggi_uteri->Raw) {
            $this->tinggi_uteri->CurrentValue = HtmlDecode($this->tinggi_uteri->CurrentValue);
        }
        $this->tinggi_uteri->EditValue = $this->tinggi_uteri->CurrentValue;
        $this->tinggi_uteri->PlaceHolder = RemoveHtml($this->tinggi_uteri->caption());

        // janin
        $this->janin->EditCustomAttributes = "";
        $this->janin->EditValue = $this->janin->options(false);
        $this->janin->PlaceHolder = RemoveHtml($this->janin->caption());

        // letak
        $this->letak->EditAttrs["class"] = "form-control";
        $this->letak->EditCustomAttributes = "";
        if (!$this->letak->Raw) {
            $this->letak->CurrentValue = HtmlDecode($this->letak->CurrentValue);
        }
        $this->letak->EditValue = $this->letak->CurrentValue;
        $this->letak->PlaceHolder = RemoveHtml($this->letak->caption());

        // panggul
        $this->panggul->EditCustomAttributes = "";
        $this->panggul->EditValue = $this->panggul->options(false);
        $this->panggul->PlaceHolder = RemoveHtml($this->panggul->caption());

        // denyut
        $this->denyut->EditAttrs["class"] = "form-control";
        $this->denyut->EditCustomAttributes = "";
        if (!$this->denyut->Raw) {
            $this->denyut->CurrentValue = HtmlDecode($this->denyut->CurrentValue);
        }
        $this->denyut->EditValue = $this->denyut->CurrentValue;
        $this->denyut->PlaceHolder = RemoveHtml($this->denyut->caption());

        // kontraksi
        $this->kontraksi->EditCustomAttributes = "";
        $this->kontraksi->EditValue = $this->kontraksi->options(false);
        $this->kontraksi->PlaceHolder = RemoveHtml($this->kontraksi->caption());

        // kualitas_mnt
        $this->kualitas_mnt->EditAttrs["class"] = "form-control";
        $this->kualitas_mnt->EditCustomAttributes = "";
        if (!$this->kualitas_mnt->Raw) {
            $this->kualitas_mnt->CurrentValue = HtmlDecode($this->kualitas_mnt->CurrentValue);
        }
        $this->kualitas_mnt->EditValue = $this->kualitas_mnt->CurrentValue;
        $this->kualitas_mnt->PlaceHolder = RemoveHtml($this->kualitas_mnt->caption());

        // kualitas_dtk
        $this->kualitas_dtk->EditAttrs["class"] = "form-control";
        $this->kualitas_dtk->EditCustomAttributes = "";
        if (!$this->kualitas_dtk->Raw) {
            $this->kualitas_dtk->CurrentValue = HtmlDecode($this->kualitas_dtk->CurrentValue);
        }
        $this->kualitas_dtk->EditValue = $this->kualitas_dtk->CurrentValue;
        $this->kualitas_dtk->PlaceHolder = RemoveHtml($this->kualitas_dtk->caption());

        // fluksus
        $this->fluksus->EditCustomAttributes = "";
        $this->fluksus->EditValue = $this->fluksus->options(false);
        $this->fluksus->PlaceHolder = RemoveHtml($this->fluksus->caption());

        // albus
        $this->albus->EditCustomAttributes = "";
        $this->albus->EditValue = $this->albus->options(false);
        $this->albus->PlaceHolder = RemoveHtml($this->albus->caption());

        // vulva
        $this->vulva->EditAttrs["class"] = "form-control";
        $this->vulva->EditCustomAttributes = "";
        if (!$this->vulva->Raw) {
            $this->vulva->CurrentValue = HtmlDecode($this->vulva->CurrentValue);
        }
        $this->vulva->EditValue = $this->vulva->CurrentValue;
        $this->vulva->PlaceHolder = RemoveHtml($this->vulva->caption());

        // portio
        $this->portio->EditAttrs["class"] = "form-control";
        $this->portio->EditCustomAttributes = "";
        if (!$this->portio->Raw) {
            $this->portio->CurrentValue = HtmlDecode($this->portio->CurrentValue);
        }
        $this->portio->EditValue = $this->portio->CurrentValue;
        $this->portio->PlaceHolder = RemoveHtml($this->portio->caption());

        // dalam
        $this->dalam->EditCustomAttributes = "";
        $this->dalam->EditValue = $this->dalam->options(false);
        $this->dalam->PlaceHolder = RemoveHtml($this->dalam->caption());

        // tebal
        $this->tebal->EditAttrs["class"] = "form-control";
        $this->tebal->EditCustomAttributes = "";
        if (!$this->tebal->Raw) {
            $this->tebal->CurrentValue = HtmlDecode($this->tebal->CurrentValue);
        }
        $this->tebal->EditValue = $this->tebal->CurrentValue;
        $this->tebal->PlaceHolder = RemoveHtml($this->tebal->caption());

        // arah
        $this->arah->EditCustomAttributes = "";
        $this->arah->EditValue = $this->arah->options(false);
        $this->arah->PlaceHolder = RemoveHtml($this->arah->caption());

        // pembukaan
        $this->pembukaan->EditAttrs["class"] = "form-control";
        $this->pembukaan->EditCustomAttributes = "";
        if (!$this->pembukaan->Raw) {
            $this->pembukaan->CurrentValue = HtmlDecode($this->pembukaan->CurrentValue);
        }
        $this->pembukaan->EditValue = $this->pembukaan->CurrentValue;
        $this->pembukaan->PlaceHolder = RemoveHtml($this->pembukaan->caption());

        // penurunan
        $this->penurunan->EditAttrs["class"] = "form-control";
        $this->penurunan->EditCustomAttributes = "";
        if (!$this->penurunan->Raw) {
            $this->penurunan->CurrentValue = HtmlDecode($this->penurunan->CurrentValue);
        }
        $this->penurunan->EditValue = $this->penurunan->CurrentValue;
        $this->penurunan->PlaceHolder = RemoveHtml($this->penurunan->caption());

        // denominator
        $this->denominator->EditAttrs["class"] = "form-control";
        $this->denominator->EditCustomAttributes = "";
        if (!$this->denominator->Raw) {
            $this->denominator->CurrentValue = HtmlDecode($this->denominator->CurrentValue);
        }
        $this->denominator->EditValue = $this->denominator->CurrentValue;
        $this->denominator->PlaceHolder = RemoveHtml($this->denominator->caption());

        // ketuban
        $this->ketuban->EditCustomAttributes = "";
        $this->ketuban->EditValue = $this->ketuban->options(false);
        $this->ketuban->PlaceHolder = RemoveHtml($this->ketuban->caption());

        // feto
        $this->feto->EditCustomAttributes = "";
        $this->feto->EditValue = $this->feto->options(false);
        $this->feto->PlaceHolder = RemoveHtml($this->feto->caption());

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
                    $doc->exportCaption($this->tgl_perawatan);
                    $doc->exportCaption($this->jam_rawat);
                    $doc->exportCaption($this->tinggi_uteri);
                    $doc->exportCaption($this->janin);
                    $doc->exportCaption($this->letak);
                    $doc->exportCaption($this->panggul);
                    $doc->exportCaption($this->denyut);
                    $doc->exportCaption($this->kontraksi);
                    $doc->exportCaption($this->kualitas_mnt);
                    $doc->exportCaption($this->kualitas_dtk);
                    $doc->exportCaption($this->fluksus);
                    $doc->exportCaption($this->albus);
                    $doc->exportCaption($this->vulva);
                    $doc->exportCaption($this->portio);
                    $doc->exportCaption($this->dalam);
                    $doc->exportCaption($this->tebal);
                    $doc->exportCaption($this->arah);
                    $doc->exportCaption($this->pembukaan);
                    $doc->exportCaption($this->penurunan);
                    $doc->exportCaption($this->denominator);
                    $doc->exportCaption($this->ketuban);
                    $doc->exportCaption($this->feto);
                } else {
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tgl_perawatan);
                    $doc->exportCaption($this->jam_rawat);
                    $doc->exportCaption($this->tinggi_uteri);
                    $doc->exportCaption($this->janin);
                    $doc->exportCaption($this->letak);
                    $doc->exportCaption($this->panggul);
                    $doc->exportCaption($this->denyut);
                    $doc->exportCaption($this->kontraksi);
                    $doc->exportCaption($this->kualitas_mnt);
                    $doc->exportCaption($this->kualitas_dtk);
                    $doc->exportCaption($this->fluksus);
                    $doc->exportCaption($this->albus);
                    $doc->exportCaption($this->vulva);
                    $doc->exportCaption($this->portio);
                    $doc->exportCaption($this->dalam);
                    $doc->exportCaption($this->tebal);
                    $doc->exportCaption($this->arah);
                    $doc->exportCaption($this->pembukaan);
                    $doc->exportCaption($this->penurunan);
                    $doc->exportCaption($this->denominator);
                    $doc->exportCaption($this->ketuban);
                    $doc->exportCaption($this->feto);
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
                        $doc->exportField($this->tgl_perawatan);
                        $doc->exportField($this->jam_rawat);
                        $doc->exportField($this->tinggi_uteri);
                        $doc->exportField($this->janin);
                        $doc->exportField($this->letak);
                        $doc->exportField($this->panggul);
                        $doc->exportField($this->denyut);
                        $doc->exportField($this->kontraksi);
                        $doc->exportField($this->kualitas_mnt);
                        $doc->exportField($this->kualitas_dtk);
                        $doc->exportField($this->fluksus);
                        $doc->exportField($this->albus);
                        $doc->exportField($this->vulva);
                        $doc->exportField($this->portio);
                        $doc->exportField($this->dalam);
                        $doc->exportField($this->tebal);
                        $doc->exportField($this->arah);
                        $doc->exportField($this->pembukaan);
                        $doc->exportField($this->penurunan);
                        $doc->exportField($this->denominator);
                        $doc->exportField($this->ketuban);
                        $doc->exportField($this->feto);
                    } else {
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tgl_perawatan);
                        $doc->exportField($this->jam_rawat);
                        $doc->exportField($this->tinggi_uteri);
                        $doc->exportField($this->janin);
                        $doc->exportField($this->letak);
                        $doc->exportField($this->panggul);
                        $doc->exportField($this->denyut);
                        $doc->exportField($this->kontraksi);
                        $doc->exportField($this->kualitas_mnt);
                        $doc->exportField($this->kualitas_dtk);
                        $doc->exportField($this->fluksus);
                        $doc->exportField($this->albus);
                        $doc->exportField($this->vulva);
                        $doc->exportField($this->portio);
                        $doc->exportField($this->dalam);
                        $doc->exportField($this->tebal);
                        $doc->exportField($this->arah);
                        $doc->exportField($this->pembukaan);
                        $doc->exportField($this->penurunan);
                        $doc->exportField($this->denominator);
                        $doc->exportField($this->ketuban);
                        $doc->exportField($this->feto);
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
