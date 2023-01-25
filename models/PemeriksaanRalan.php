<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pemeriksaan_ralan
 */
class PemeriksaanRalan extends DbTable
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
    public $suhu_tubuh;
    public $tensi;
    public $nadi;
    public $respirasi;
    public $tinggi;
    public $berat;
    public $spo2;
    public $gcs;
    public $kesadaran;
    public $keluhan;
    public $pemeriksaan;
    public $alergi;
    public $lingkar_perut;
    public $rtl;
    public $penilaian;
    public $instruksi;
    public $evaluasi;
    public $nip;
    public $id_pemeriksaan_ralan;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pemeriksaan_ralan';
        $this->TableName = 'pemeriksaan_ralan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`pemeriksaan_ralan`";
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

        // no_rawat
        $this->no_rawat = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_no_rawat', 'no_rawat', '`no_rawat`', '`no_rawat`', 200, 17, -1, false, '`no_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->IsForeignKey = true; // Foreign key field
        $this->no_rawat->Nullable = false; // NOT NULL field
        $this->no_rawat->Required = true; // Required field
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // tgl_perawatan
        $this->tgl_perawatan = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_tgl_perawatan', 'tgl_perawatan', '`tgl_perawatan`', CastDateFieldForLike("`tgl_perawatan`", 0, "DB"), 133, 10, 0, false, '`tgl_perawatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_perawatan->Nullable = false; // NOT NULL field
        $this->tgl_perawatan->Sortable = true; // Allow sort
        $this->tgl_perawatan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_perawatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_perawatan->Param, "CustomMsg");
        $this->Fields['tgl_perawatan'] = &$this->tgl_perawatan;

        // jam_rawat
        $this->jam_rawat = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_jam_rawat', 'jam_rawat', '`jam_rawat`', CastDateFieldForLike("`jam_rawat`", 4, "DB"), 134, 10, 4, false, '`jam_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jam_rawat->Nullable = false; // NOT NULL field
        $this->jam_rawat->Sortable = true; // Allow sort
        $this->jam_rawat->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
        $this->jam_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jam_rawat->Param, "CustomMsg");
        $this->Fields['jam_rawat'] = &$this->jam_rawat;

        // suhu_tubuh
        $this->suhu_tubuh = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_suhu_tubuh', 'suhu_tubuh', '`suhu_tubuh`', '`suhu_tubuh`', 200, 5, -1, false, '`suhu_tubuh`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->suhu_tubuh->Sortable = true; // Allow sort
        $this->suhu_tubuh->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->suhu_tubuh->Param, "CustomMsg");
        $this->Fields['suhu_tubuh'] = &$this->suhu_tubuh;

        // tensi
        $this->tensi = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_tensi', 'tensi', '`tensi`', '`tensi`', 200, 8, -1, false, '`tensi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tensi->Nullable = false; // NOT NULL field
        $this->tensi->Required = true; // Required field
        $this->tensi->Sortable = true; // Allow sort
        $this->tensi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tensi->Param, "CustomMsg");
        $this->Fields['tensi'] = &$this->tensi;

        // nadi
        $this->nadi = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_nadi', 'nadi', '`nadi`', '`nadi`', 200, 3, -1, false, '`nadi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nadi->Sortable = true; // Allow sort
        $this->nadi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nadi->Param, "CustomMsg");
        $this->Fields['nadi'] = &$this->nadi;

        // respirasi
        $this->respirasi = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_respirasi', 'respirasi', '`respirasi`', '`respirasi`', 200, 3, -1, false, '`respirasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->respirasi->Sortable = true; // Allow sort
        $this->respirasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->respirasi->Param, "CustomMsg");
        $this->Fields['respirasi'] = &$this->respirasi;

        // tinggi
        $this->tinggi = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_tinggi', 'tinggi', '`tinggi`', '`tinggi`', 200, 5, -1, false, '`tinggi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tinggi->Sortable = true; // Allow sort
        $this->tinggi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tinggi->Param, "CustomMsg");
        $this->Fields['tinggi'] = &$this->tinggi;

        // berat
        $this->berat = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_berat', 'berat', '`berat`', '`berat`', 200, 5, -1, false, '`berat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->berat->Sortable = true; // Allow sort
        $this->berat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->berat->Param, "CustomMsg");
        $this->Fields['berat'] = &$this->berat;

        // spo2
        $this->spo2 = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_spo2', 'spo2', '`spo2`', '`spo2`', 200, 3, -1, false, '`spo2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spo2->Nullable = false; // NOT NULL field
        $this->spo2->Required = true; // Required field
        $this->spo2->Sortable = true; // Allow sort
        $this->spo2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spo2->Param, "CustomMsg");
        $this->Fields['spo2'] = &$this->spo2;

        // gcs
        $this->gcs = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_gcs', 'gcs', '`gcs`', '`gcs`', 200, 10, -1, false, '`gcs`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->gcs->Sortable = true; // Allow sort
        $this->gcs->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gcs->Param, "CustomMsg");
        $this->Fields['gcs'] = &$this->gcs;

        // kesadaran
        $this->kesadaran = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_kesadaran', 'kesadaran', '`kesadaran`', '`kesadaran`', 202, 13, -1, false, '`kesadaran`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kesadaran->Nullable = false; // NOT NULL field
        $this->kesadaran->Required = true; // Required field
        $this->kesadaran->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kesadaran->Lookup = new Lookup('kesadaran', 'pemeriksaan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kesadaran->Lookup = new Lookup('kesadaran', 'pemeriksaan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kesadaran->OptionCount = 4;
        $this->kesadaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kesadaran->Param, "CustomMsg");
        $this->Fields['kesadaran'] = &$this->kesadaran;

        // keluhan
        $this->keluhan = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_keluhan', 'keluhan', '`keluhan`', '`keluhan`', 201, 400, -1, false, '`keluhan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->keluhan->Sortable = true; // Allow sort
        $this->keluhan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keluhan->Param, "CustomMsg");
        $this->Fields['keluhan'] = &$this->keluhan;

        // pemeriksaan
        $this->pemeriksaan = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_pemeriksaan', 'pemeriksaan', '`pemeriksaan`', '`pemeriksaan`', 201, 400, -1, false, '`pemeriksaan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->pemeriksaan->Sortable = true; // Allow sort
        $this->pemeriksaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pemeriksaan->Param, "CustomMsg");
        $this->Fields['pemeriksaan'] = &$this->pemeriksaan;

        // alergi
        $this->alergi = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_alergi', 'alergi', '`alergi`', '`alergi`', 200, 50, -1, false, '`alergi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alergi->Sortable = true; // Allow sort
        $this->alergi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alergi->Param, "CustomMsg");
        $this->Fields['alergi'] = &$this->alergi;

        // lingkar_perut
        $this->lingkar_perut = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_lingkar_perut', 'lingkar_perut', '`lingkar_perut`', '`lingkar_perut`', 200, 5, -1, false, '`lingkar_perut`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lingkar_perut->Sortable = true; // Allow sort
        $this->lingkar_perut->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lingkar_perut->Param, "CustomMsg");
        $this->Fields['lingkar_perut'] = &$this->lingkar_perut;

        // rtl
        $this->rtl = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_rtl', 'rtl', '`rtl`', '`rtl`', 201, 400, -1, false, '`rtl`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->rtl->Nullable = false; // NOT NULL field
        $this->rtl->Required = true; // Required field
        $this->rtl->Sortable = true; // Allow sort
        $this->rtl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rtl->Param, "CustomMsg");
        $this->Fields['rtl'] = &$this->rtl;

        // penilaian
        $this->penilaian = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_penilaian', 'penilaian', '`penilaian`', '`penilaian`', 201, 400, -1, false, '`penilaian`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->penilaian->Nullable = false; // NOT NULL field
        $this->penilaian->Required = true; // Required field
        $this->penilaian->Sortable = true; // Allow sort
        $this->penilaian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->penilaian->Param, "CustomMsg");
        $this->Fields['penilaian'] = &$this->penilaian;

        // instruksi
        $this->instruksi = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_instruksi', 'instruksi', '`instruksi`', '`instruksi`', 201, 400, -1, false, '`instruksi`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->instruksi->Nullable = false; // NOT NULL field
        $this->instruksi->Required = true; // Required field
        $this->instruksi->Sortable = true; // Allow sort
        $this->instruksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->instruksi->Param, "CustomMsg");
        $this->Fields['instruksi'] = &$this->instruksi;

        // evaluasi
        $this->evaluasi = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_evaluasi', 'evaluasi', '`evaluasi`', '`evaluasi`', 201, 400, -1, false, '`evaluasi`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->evaluasi->Nullable = false; // NOT NULL field
        $this->evaluasi->Required = true; // Required field
        $this->evaluasi->Sortable = true; // Allow sort
        $this->evaluasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->evaluasi->Param, "CustomMsg");
        $this->Fields['evaluasi'] = &$this->evaluasi;

        // nip
        $this->nip = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_nip', 'nip', '`nip`', '`nip`', 200, 20, -1, false, '`nip`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nip->Nullable = false; // NOT NULL field
        $this->nip->Required = true; // Required field
        $this->nip->Sortable = true; // Allow sort
        $this->nip->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nip->Param, "CustomMsg");
        $this->Fields['nip'] = &$this->nip;

        // id_pemeriksaan_ralan
        $this->id_pemeriksaan_ralan = new DbField('pemeriksaan_ralan', 'pemeriksaan_ralan', 'x_id_pemeriksaan_ralan', 'id_pemeriksaan_ralan', '`id_pemeriksaan_ralan`', '`id_pemeriksaan_ralan`', 3, 6, -1, false, '`id_pemeriksaan_ralan`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_pemeriksaan_ralan->IsAutoIncrement = true; // Autoincrement field
        $this->id_pemeriksaan_ralan->IsPrimaryKey = true; // Primary key field
        $this->id_pemeriksaan_ralan->Sortable = true; // Allow sort
        $this->id_pemeriksaan_ralan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_pemeriksaan_ralan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_pemeriksaan_ralan->Param, "CustomMsg");
        $this->Fields['id_pemeriksaan_ralan'] = &$this->id_pemeriksaan_ralan;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`pemeriksaan_ralan`";
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
            $this->id_pemeriksaan_ralan->setDbValue($conn->lastInsertId());
            $rs['id_pemeriksaan_ralan'] = $this->id_pemeriksaan_ralan->DbValue;
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
            if (array_key_exists('id_pemeriksaan_ralan', $rs)) {
                AddFilter($where, QuotedName('id_pemeriksaan_ralan', $this->Dbid) . '=' . QuotedValue($rs['id_pemeriksaan_ralan'], $this->id_pemeriksaan_ralan->DataType, $this->Dbid));
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
        $this->suhu_tubuh->DbValue = $row['suhu_tubuh'];
        $this->tensi->DbValue = $row['tensi'];
        $this->nadi->DbValue = $row['nadi'];
        $this->respirasi->DbValue = $row['respirasi'];
        $this->tinggi->DbValue = $row['tinggi'];
        $this->berat->DbValue = $row['berat'];
        $this->spo2->DbValue = $row['spo2'];
        $this->gcs->DbValue = $row['gcs'];
        $this->kesadaran->DbValue = $row['kesadaran'];
        $this->keluhan->DbValue = $row['keluhan'];
        $this->pemeriksaan->DbValue = $row['pemeriksaan'];
        $this->alergi->DbValue = $row['alergi'];
        $this->lingkar_perut->DbValue = $row['lingkar_perut'];
        $this->rtl->DbValue = $row['rtl'];
        $this->penilaian->DbValue = $row['penilaian'];
        $this->instruksi->DbValue = $row['instruksi'];
        $this->evaluasi->DbValue = $row['evaluasi'];
        $this->nip->DbValue = $row['nip'];
        $this->id_pemeriksaan_ralan->DbValue = $row['id_pemeriksaan_ralan'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_pemeriksaan_ralan` = @id_pemeriksaan_ralan@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_pemeriksaan_ralan->CurrentValue : $this->id_pemeriksaan_ralan->OldValue;
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
                $this->id_pemeriksaan_ralan->CurrentValue = $keys[0];
            } else {
                $this->id_pemeriksaan_ralan->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_pemeriksaan_ralan', $row) ? $row['id_pemeriksaan_ralan'] : null;
        } else {
            $val = $this->id_pemeriksaan_ralan->OldValue !== null ? $this->id_pemeriksaan_ralan->OldValue : $this->id_pemeriksaan_ralan->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_pemeriksaan_ralan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PemeriksaanRalanList");
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
        if ($pageName == "PemeriksaanRalanView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PemeriksaanRalanEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PemeriksaanRalanAdd") {
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
                return "PemeriksaanRalanView";
            case Config("API_ADD_ACTION"):
                return "PemeriksaanRalanAdd";
            case Config("API_EDIT_ACTION"):
                return "PemeriksaanRalanEdit";
            case Config("API_DELETE_ACTION"):
                return "PemeriksaanRalanDelete";
            case Config("API_LIST_ACTION"):
                return "PemeriksaanRalanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PemeriksaanRalanList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PemeriksaanRalanView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PemeriksaanRalanView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PemeriksaanRalanAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PemeriksaanRalanAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PemeriksaanRalanEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PemeriksaanRalanAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PemeriksaanRalanDelete", $this->getUrlParm());
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
        $json .= "id_pemeriksaan_ralan:" . JsonEncode($this->id_pemeriksaan_ralan->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_pemeriksaan_ralan->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_pemeriksaan_ralan->CurrentValue);
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
            if (($keyValue = Param("id_pemeriksaan_ralan") ?? Route("id_pemeriksaan_ralan")) !== null) {
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
                $this->id_pemeriksaan_ralan->CurrentValue = $key;
            } else {
                $this->id_pemeriksaan_ralan->OldValue = $key;
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
        $this->suhu_tubuh->setDbValue($row['suhu_tubuh']);
        $this->tensi->setDbValue($row['tensi']);
        $this->nadi->setDbValue($row['nadi']);
        $this->respirasi->setDbValue($row['respirasi']);
        $this->tinggi->setDbValue($row['tinggi']);
        $this->berat->setDbValue($row['berat']);
        $this->spo2->setDbValue($row['spo2']);
        $this->gcs->setDbValue($row['gcs']);
        $this->kesadaran->setDbValue($row['kesadaran']);
        $this->keluhan->setDbValue($row['keluhan']);
        $this->pemeriksaan->setDbValue($row['pemeriksaan']);
        $this->alergi->setDbValue($row['alergi']);
        $this->lingkar_perut->setDbValue($row['lingkar_perut']);
        $this->rtl->setDbValue($row['rtl']);
        $this->penilaian->setDbValue($row['penilaian']);
        $this->instruksi->setDbValue($row['instruksi']);
        $this->evaluasi->setDbValue($row['evaluasi']);
        $this->nip->setDbValue($row['nip']);
        $this->id_pemeriksaan_ralan->setDbValue($row['id_pemeriksaan_ralan']);
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

        // suhu_tubuh

        // tensi

        // nadi

        // respirasi

        // tinggi

        // berat

        // spo2

        // gcs

        // kesadaran

        // keluhan

        // pemeriksaan

        // alergi

        // lingkar_perut

        // rtl

        // penilaian

        // instruksi

        // evaluasi

        // nip

        // id_pemeriksaan_ralan

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

        // suhu_tubuh
        $this->suhu_tubuh->ViewValue = $this->suhu_tubuh->CurrentValue;
        $this->suhu_tubuh->ViewCustomAttributes = "";

        // tensi
        $this->tensi->ViewValue = $this->tensi->CurrentValue;
        $this->tensi->ViewCustomAttributes = "";

        // nadi
        $this->nadi->ViewValue = $this->nadi->CurrentValue;
        $this->nadi->ViewCustomAttributes = "";

        // respirasi
        $this->respirasi->ViewValue = $this->respirasi->CurrentValue;
        $this->respirasi->ViewCustomAttributes = "";

        // tinggi
        $this->tinggi->ViewValue = $this->tinggi->CurrentValue;
        $this->tinggi->ViewCustomAttributes = "";

        // berat
        $this->berat->ViewValue = $this->berat->CurrentValue;
        $this->berat->ViewCustomAttributes = "";

        // spo2
        $this->spo2->ViewValue = $this->spo2->CurrentValue;
        $this->spo2->ViewCustomAttributes = "";

        // gcs
        $this->gcs->ViewValue = $this->gcs->CurrentValue;
        $this->gcs->ViewCustomAttributes = "";

        // kesadaran
        if (strval($this->kesadaran->CurrentValue) != "") {
            $this->kesadaran->ViewValue = $this->kesadaran->optionCaption($this->kesadaran->CurrentValue);
        } else {
            $this->kesadaran->ViewValue = null;
        }
        $this->kesadaran->ViewCustomAttributes = "";

        // keluhan
        $this->keluhan->ViewValue = $this->keluhan->CurrentValue;
        $this->keluhan->ViewCustomAttributes = "";

        // pemeriksaan
        $this->pemeriksaan->ViewValue = $this->pemeriksaan->CurrentValue;
        $this->pemeriksaan->ViewCustomAttributes = "";

        // alergi
        $this->alergi->ViewValue = $this->alergi->CurrentValue;
        $this->alergi->ViewCustomAttributes = "";

        // lingkar_perut
        $this->lingkar_perut->ViewValue = $this->lingkar_perut->CurrentValue;
        $this->lingkar_perut->ViewCustomAttributes = "";

        // rtl
        $this->rtl->ViewValue = $this->rtl->CurrentValue;
        $this->rtl->ViewCustomAttributes = "";

        // penilaian
        $this->penilaian->ViewValue = $this->penilaian->CurrentValue;
        $this->penilaian->ViewCustomAttributes = "";

        // instruksi
        $this->instruksi->ViewValue = $this->instruksi->CurrentValue;
        $this->instruksi->ViewCustomAttributes = "";

        // evaluasi
        $this->evaluasi->ViewValue = $this->evaluasi->CurrentValue;
        $this->evaluasi->ViewCustomAttributes = "";

        // nip
        $this->nip->ViewValue = $this->nip->CurrentValue;
        $this->nip->ViewCustomAttributes = "";

        // id_pemeriksaan_ralan
        $this->id_pemeriksaan_ralan->ViewValue = $this->id_pemeriksaan_ralan->CurrentValue;
        $this->id_pemeriksaan_ralan->ViewCustomAttributes = "";

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

        // suhu_tubuh
        $this->suhu_tubuh->LinkCustomAttributes = "";
        $this->suhu_tubuh->HrefValue = "";
        $this->suhu_tubuh->TooltipValue = "";

        // tensi
        $this->tensi->LinkCustomAttributes = "";
        $this->tensi->HrefValue = "";
        $this->tensi->TooltipValue = "";

        // nadi
        $this->nadi->LinkCustomAttributes = "";
        $this->nadi->HrefValue = "";
        $this->nadi->TooltipValue = "";

        // respirasi
        $this->respirasi->LinkCustomAttributes = "";
        $this->respirasi->HrefValue = "";
        $this->respirasi->TooltipValue = "";

        // tinggi
        $this->tinggi->LinkCustomAttributes = "";
        $this->tinggi->HrefValue = "";
        $this->tinggi->TooltipValue = "";

        // berat
        $this->berat->LinkCustomAttributes = "";
        $this->berat->HrefValue = "";
        $this->berat->TooltipValue = "";

        // spo2
        $this->spo2->LinkCustomAttributes = "";
        $this->spo2->HrefValue = "";
        $this->spo2->TooltipValue = "";

        // gcs
        $this->gcs->LinkCustomAttributes = "";
        $this->gcs->HrefValue = "";
        $this->gcs->TooltipValue = "";

        // kesadaran
        $this->kesadaran->LinkCustomAttributes = "";
        $this->kesadaran->HrefValue = "";
        $this->kesadaran->TooltipValue = "";

        // keluhan
        $this->keluhan->LinkCustomAttributes = "";
        $this->keluhan->HrefValue = "";
        $this->keluhan->TooltipValue = "";

        // pemeriksaan
        $this->pemeriksaan->LinkCustomAttributes = "";
        $this->pemeriksaan->HrefValue = "";
        $this->pemeriksaan->TooltipValue = "";

        // alergi
        $this->alergi->LinkCustomAttributes = "";
        $this->alergi->HrefValue = "";
        $this->alergi->TooltipValue = "";

        // lingkar_perut
        $this->lingkar_perut->LinkCustomAttributes = "";
        $this->lingkar_perut->HrefValue = "";
        $this->lingkar_perut->TooltipValue = "";

        // rtl
        $this->rtl->LinkCustomAttributes = "";
        $this->rtl->HrefValue = "";
        $this->rtl->TooltipValue = "";

        // penilaian
        $this->penilaian->LinkCustomAttributes = "";
        $this->penilaian->HrefValue = "";
        $this->penilaian->TooltipValue = "";

        // instruksi
        $this->instruksi->LinkCustomAttributes = "";
        $this->instruksi->HrefValue = "";
        $this->instruksi->TooltipValue = "";

        // evaluasi
        $this->evaluasi->LinkCustomAttributes = "";
        $this->evaluasi->HrefValue = "";
        $this->evaluasi->TooltipValue = "";

        // nip
        $this->nip->LinkCustomAttributes = "";
        $this->nip->HrefValue = "";
        $this->nip->TooltipValue = "";

        // id_pemeriksaan_ralan
        $this->id_pemeriksaan_ralan->LinkCustomAttributes = "";
        $this->id_pemeriksaan_ralan->HrefValue = "";
        $this->id_pemeriksaan_ralan->TooltipValue = "";

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

        // tgl_perawatan

        // jam_rawat

        // suhu_tubuh
        $this->suhu_tubuh->EditAttrs["class"] = "form-control";
        $this->suhu_tubuh->EditCustomAttributes = "";
        if (!$this->suhu_tubuh->Raw) {
            $this->suhu_tubuh->CurrentValue = HtmlDecode($this->suhu_tubuh->CurrentValue);
        }
        $this->suhu_tubuh->EditValue = $this->suhu_tubuh->CurrentValue;
        $this->suhu_tubuh->PlaceHolder = RemoveHtml($this->suhu_tubuh->caption());

        // tensi
        $this->tensi->EditAttrs["class"] = "form-control";
        $this->tensi->EditCustomAttributes = "";
        if (!$this->tensi->Raw) {
            $this->tensi->CurrentValue = HtmlDecode($this->tensi->CurrentValue);
        }
        $this->tensi->EditValue = $this->tensi->CurrentValue;
        $this->tensi->PlaceHolder = RemoveHtml($this->tensi->caption());

        // nadi
        $this->nadi->EditAttrs["class"] = "form-control";
        $this->nadi->EditCustomAttributes = "";
        if (!$this->nadi->Raw) {
            $this->nadi->CurrentValue = HtmlDecode($this->nadi->CurrentValue);
        }
        $this->nadi->EditValue = $this->nadi->CurrentValue;
        $this->nadi->PlaceHolder = RemoveHtml($this->nadi->caption());

        // respirasi
        $this->respirasi->EditAttrs["class"] = "form-control";
        $this->respirasi->EditCustomAttributes = "";
        if (!$this->respirasi->Raw) {
            $this->respirasi->CurrentValue = HtmlDecode($this->respirasi->CurrentValue);
        }
        $this->respirasi->EditValue = $this->respirasi->CurrentValue;
        $this->respirasi->PlaceHolder = RemoveHtml($this->respirasi->caption());

        // tinggi
        $this->tinggi->EditAttrs["class"] = "form-control";
        $this->tinggi->EditCustomAttributes = "";
        if (!$this->tinggi->Raw) {
            $this->tinggi->CurrentValue = HtmlDecode($this->tinggi->CurrentValue);
        }
        $this->tinggi->EditValue = $this->tinggi->CurrentValue;
        $this->tinggi->PlaceHolder = RemoveHtml($this->tinggi->caption());

        // berat
        $this->berat->EditAttrs["class"] = "form-control";
        $this->berat->EditCustomAttributes = "";
        if (!$this->berat->Raw) {
            $this->berat->CurrentValue = HtmlDecode($this->berat->CurrentValue);
        }
        $this->berat->EditValue = $this->berat->CurrentValue;
        $this->berat->PlaceHolder = RemoveHtml($this->berat->caption());

        // spo2
        $this->spo2->EditAttrs["class"] = "form-control";
        $this->spo2->EditCustomAttributes = "";
        if (!$this->spo2->Raw) {
            $this->spo2->CurrentValue = HtmlDecode($this->spo2->CurrentValue);
        }
        $this->spo2->EditValue = $this->spo2->CurrentValue;
        $this->spo2->PlaceHolder = RemoveHtml($this->spo2->caption());

        // gcs
        $this->gcs->EditAttrs["class"] = "form-control";
        $this->gcs->EditCustomAttributes = "";
        if (!$this->gcs->Raw) {
            $this->gcs->CurrentValue = HtmlDecode($this->gcs->CurrentValue);
        }
        $this->gcs->EditValue = $this->gcs->CurrentValue;
        $this->gcs->PlaceHolder = RemoveHtml($this->gcs->caption());

        // kesadaran
        $this->kesadaran->EditCustomAttributes = "";
        $this->kesadaran->EditValue = $this->kesadaran->options(false);
        $this->kesadaran->PlaceHolder = RemoveHtml($this->kesadaran->caption());

        // keluhan
        $this->keluhan->EditAttrs["class"] = "form-control";
        $this->keluhan->EditCustomAttributes = "";
        $this->keluhan->EditValue = $this->keluhan->CurrentValue;
        $this->keluhan->PlaceHolder = RemoveHtml($this->keluhan->caption());

        // pemeriksaan
        $this->pemeriksaan->EditAttrs["class"] = "form-control";
        $this->pemeriksaan->EditCustomAttributes = "";
        $this->pemeriksaan->EditValue = $this->pemeriksaan->CurrentValue;
        $this->pemeriksaan->PlaceHolder = RemoveHtml($this->pemeriksaan->caption());

        // alergi
        $this->alergi->EditAttrs["class"] = "form-control";
        $this->alergi->EditCustomAttributes = "";
        if (!$this->alergi->Raw) {
            $this->alergi->CurrentValue = HtmlDecode($this->alergi->CurrentValue);
        }
        $this->alergi->EditValue = $this->alergi->CurrentValue;
        $this->alergi->PlaceHolder = RemoveHtml($this->alergi->caption());

        // lingkar_perut
        $this->lingkar_perut->EditAttrs["class"] = "form-control";
        $this->lingkar_perut->EditCustomAttributes = "";
        if (!$this->lingkar_perut->Raw) {
            $this->lingkar_perut->CurrentValue = HtmlDecode($this->lingkar_perut->CurrentValue);
        }
        $this->lingkar_perut->EditValue = $this->lingkar_perut->CurrentValue;
        $this->lingkar_perut->PlaceHolder = RemoveHtml($this->lingkar_perut->caption());

        // rtl
        $this->rtl->EditAttrs["class"] = "form-control";
        $this->rtl->EditCustomAttributes = "";
        $this->rtl->EditValue = $this->rtl->CurrentValue;
        $this->rtl->PlaceHolder = RemoveHtml($this->rtl->caption());

        // penilaian
        $this->penilaian->EditAttrs["class"] = "form-control";
        $this->penilaian->EditCustomAttributes = "";
        $this->penilaian->EditValue = $this->penilaian->CurrentValue;
        $this->penilaian->PlaceHolder = RemoveHtml($this->penilaian->caption());

        // instruksi
        $this->instruksi->EditAttrs["class"] = "form-control";
        $this->instruksi->EditCustomAttributes = "";
        $this->instruksi->EditValue = $this->instruksi->CurrentValue;
        $this->instruksi->PlaceHolder = RemoveHtml($this->instruksi->caption());

        // evaluasi
        $this->evaluasi->EditAttrs["class"] = "form-control";
        $this->evaluasi->EditCustomAttributes = "";
        $this->evaluasi->EditValue = $this->evaluasi->CurrentValue;
        $this->evaluasi->PlaceHolder = RemoveHtml($this->evaluasi->caption());

        // nip
        $this->nip->EditAttrs["class"] = "form-control";
        $this->nip->EditCustomAttributes = "";
        if (!$this->nip->Raw) {
            $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
        }
        $this->nip->EditValue = $this->nip->CurrentValue;
        $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

        // id_pemeriksaan_ralan
        $this->id_pemeriksaan_ralan->EditAttrs["class"] = "form-control";
        $this->id_pemeriksaan_ralan->EditCustomAttributes = "";
        $this->id_pemeriksaan_ralan->EditValue = $this->id_pemeriksaan_ralan->CurrentValue;
        $this->id_pemeriksaan_ralan->ViewCustomAttributes = "";

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
                    $doc->exportCaption($this->suhu_tubuh);
                    $doc->exportCaption($this->tensi);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->respirasi);
                    $doc->exportCaption($this->tinggi);
                    $doc->exportCaption($this->berat);
                    $doc->exportCaption($this->spo2);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->kesadaran);
                    $doc->exportCaption($this->keluhan);
                    $doc->exportCaption($this->pemeriksaan);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->lingkar_perut);
                    $doc->exportCaption($this->rtl);
                    $doc->exportCaption($this->penilaian);
                    $doc->exportCaption($this->instruksi);
                    $doc->exportCaption($this->evaluasi);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->id_pemeriksaan_ralan);
                } else {
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tgl_perawatan);
                    $doc->exportCaption($this->jam_rawat);
                    $doc->exportCaption($this->suhu_tubuh);
                    $doc->exportCaption($this->tensi);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->respirasi);
                    $doc->exportCaption($this->tinggi);
                    $doc->exportCaption($this->berat);
                    $doc->exportCaption($this->spo2);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->kesadaran);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->lingkar_perut);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->id_pemeriksaan_ralan);
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
                        $doc->exportField($this->suhu_tubuh);
                        $doc->exportField($this->tensi);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->respirasi);
                        $doc->exportField($this->tinggi);
                        $doc->exportField($this->berat);
                        $doc->exportField($this->spo2);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->kesadaran);
                        $doc->exportField($this->keluhan);
                        $doc->exportField($this->pemeriksaan);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->lingkar_perut);
                        $doc->exportField($this->rtl);
                        $doc->exportField($this->penilaian);
                        $doc->exportField($this->instruksi);
                        $doc->exportField($this->evaluasi);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->id_pemeriksaan_ralan);
                    } else {
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tgl_perawatan);
                        $doc->exportField($this->jam_rawat);
                        $doc->exportField($this->suhu_tubuh);
                        $doc->exportField($this->tensi);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->respirasi);
                        $doc->exportField($this->tinggi);
                        $doc->exportField($this->berat);
                        $doc->exportField($this->spo2);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->kesadaran);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->lingkar_perut);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->id_pemeriksaan_ralan);
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
