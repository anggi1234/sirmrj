<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for prmrj
 */
class Prmrj extends DbTable
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
    public $no_rkm_medis;
    public $id_reg;
    public $tgl_registrasi;
    public $jam_reg;
    public $kd_poli;
    public $kd_penyakit;
    public $alergi;
    public $kd_dokter;
    public $kd_icd9;
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
        $this->TableVar = 'prmrj';
        $this->TableName = 'prmrj';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "pasien_kunjungan INNER JOIN diagnosa_pasien ON pasien_kunjungan.id_reg = diagnosa_pasien.no_rawat INNER JOIN penilaian_awal_keperawatan_ralan ON pasien_kunjungan.id_reg = penilaian_awal_keperawatan_ralan.no_rawat";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = true; // Allow detail add
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // no_rkm_medis
        $this->no_rkm_medis = new DbField('prmrj', 'prmrj', 'x_no_rkm_medis', 'no_rkm_medis', 'pasien_kunjungan.no_rkm_medis', 'pasien_kunjungan.no_rkm_medis', 200, 15, -1, false, 'pasien_kunjungan.no_rkm_medis', false, false, false, 'FORMATTED TEXT', 'SELECT');
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

        // id_reg
        $this->id_reg = new DbField('prmrj', 'prmrj', 'x_id_reg', 'id_reg', 'pasien_kunjungan.id_reg', 'pasien_kunjungan.id_reg', 3, 11, -1, false, 'pasien_kunjungan.id_reg', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_reg->IsAutoIncrement = true; // Autoincrement field
        $this->id_reg->Sortable = true; // Allow sort
        $this->id_reg->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_reg->Param, "CustomMsg");
        $this->Fields['id_reg'] = &$this->id_reg;

        // tgl_registrasi
        $this->tgl_registrasi = new DbField('prmrj', 'prmrj', 'x_tgl_registrasi', 'tgl_registrasi', 'pasien_kunjungan.tgl_registrasi', CastDateFieldForLike("pasien_kunjungan.tgl_registrasi", 6, "DB"), 133, 10, 6, false, 'pasien_kunjungan.tgl_registrasi', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_registrasi->Sortable = true; // Allow sort
        $this->tgl_registrasi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateMDY"));
        $this->tgl_registrasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_registrasi->Param, "CustomMsg");
        $this->Fields['tgl_registrasi'] = &$this->tgl_registrasi;

        // jam_reg
        $this->jam_reg = new DbField('prmrj', 'prmrj', 'x_jam_reg', 'jam_reg', 'pasien_kunjungan.jam_reg', CastDateFieldForLike("pasien_kunjungan.jam_reg", 4, "DB"), 134, 10, 4, false, 'pasien_kunjungan.jam_reg', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jam_reg->Sortable = true; // Allow sort
        $this->jam_reg->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
        $this->jam_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jam_reg->Param, "CustomMsg");
        $this->Fields['jam_reg'] = &$this->jam_reg;

        // kd_poli
        $this->kd_poli = new DbField('prmrj', 'prmrj', 'x_kd_poli', 'kd_poli', 'pasien_kunjungan.kd_poli', 'pasien_kunjungan.kd_poli', 200, 5, -1, false, 'pasien_kunjungan.kd_poli', false, false, false, 'FORMATTED TEXT', 'SELECT');
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

        // kd_penyakit
        $this->kd_penyakit = new DbField('prmrj', 'prmrj', 'x_kd_penyakit', 'kd_penyakit', 'diagnosa_pasien.kd_penyakit', 'diagnosa_pasien.kd_penyakit', 200, 10, -1, false, 'diagnosa_pasien.kd_penyakit', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_penyakit->Nullable = false; // NOT NULL field
        $this->kd_penyakit->Required = true; // Required field
        $this->kd_penyakit->Sortable = true; // Allow sort
        $this->kd_penyakit->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_penyakit->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_penyakit->Lookup = new Lookup('kd_penyakit', 'm_penyakit', false, 'kd_penyakit', ["kd_penyakit","nm_penyakit","",""], [], [], [], [], [], [], '`kd_penyakit` ASC', '');
                break;
            default:
                $this->kd_penyakit->Lookup = new Lookup('kd_penyakit', 'm_penyakit', false, 'kd_penyakit', ["kd_penyakit","nm_penyakit","",""], [], [], [], [], [], [], '`kd_penyakit` ASC', '');
                break;
        }
        $this->kd_penyakit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_penyakit->Param, "CustomMsg");
        $this->Fields['kd_penyakit'] = &$this->kd_penyakit;

        // alergi
        $this->alergi = new DbField('prmrj', 'prmrj', 'x_alergi', 'alergi', 'penilaian_awal_keperawatan_ralan.alergi', 'penilaian_awal_keperawatan_ralan.alergi', 200, 25, -1, false, 'penilaian_awal_keperawatan_ralan.alergi', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alergi->Nullable = false; // NOT NULL field
        $this->alergi->Required = true; // Required field
        $this->alergi->Sortable = true; // Allow sort
        $this->alergi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alergi->Param, "CustomMsg");
        $this->Fields['alergi'] = &$this->alergi;

        // kd_dokter
        $this->kd_dokter = new DbField('prmrj', 'prmrj', 'x_kd_dokter', 'kd_dokter', 'pasien_kunjungan.kd_dokter', 'pasien_kunjungan.kd_dokter', 200, 20, -1, false, 'pasien_kunjungan.kd_dokter', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_dokter->Sortable = true; // Allow sort
        $this->kd_dokter->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_dokter->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_dokter->Lookup = new Lookup('kd_dokter', 'prmrj', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_dokter->Lookup = new Lookup('kd_dokter', 'prmrj', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_dokter->OptionCount = 2;
        $this->kd_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_dokter->Param, "CustomMsg");
        $this->Fields['kd_dokter'] = &$this->kd_dokter;

        // kd_icd9
        $this->kd_icd9 = new DbField('prmrj', 'prmrj', 'x_kd_icd9', 'kd_icd9', 'diagnosa_pasien.kd_icd9', 'diagnosa_pasien.kd_icd9', 200, 10, -1, false, 'diagnosa_pasien.kd_icd9', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kd_icd9->Sortable = true; // Allow sort
        $this->kd_icd9->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kd_icd9->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->kd_icd9->Lookup = new Lookup('kd_icd9', 'm_icd9', false, 'kode', ["kode","deskripsi_panjang","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kd_icd9->Lookup = new Lookup('kd_icd9', 'm_icd9', false, 'kode', ["kode","deskripsi_panjang","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kd_icd9->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_icd9->Param, "CustomMsg");
        $this->Fields['kd_icd9'] = &$this->kd_icd9;

        // cetak
        $this->cetak = new DbField('prmrj', 'prmrj', 'x_cetak', 'cetak', '\'\'', '\'\'', 201, 65530, -1, false, '\'\'', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
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
        if ($this->getCurrentMasterTable() == "vrajal") {
            if ($this->no_rkm_medis->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`no_rkm_medis`", $this->no_rkm_medis->getSessionValue(), DATATYPE_STRING, "DB");
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
        if ($this->getCurrentMasterTable() == "vrajal") {
            if ($this->no_rkm_medis->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("pasien_kunjungan.no_rkm_medis", $this->no_rkm_medis->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    // Master filter
    public function sqlMasterFilter_vrajal()
    {
        return "`no_rkm_medis`='@no_rkm_medis@'";
    }
    // Detail filter
    public function sqlDetailFilter_vrajal()
    {
        return "pasien_kunjungan.no_rkm_medis='@no_rkm_medis@'";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "pasien_kunjungan INNER JOIN diagnosa_pasien ON pasien_kunjungan.id_reg = diagnosa_pasien.no_rawat INNER JOIN penilaian_awal_keperawatan_ralan ON pasien_kunjungan.id_reg = penilaian_awal_keperawatan_ralan.no_rawat";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("pasien_kunjungan.no_rkm_medis, pasien_kunjungan.kd_poli, pasien_kunjungan.kd_dokter, pasien_kunjungan.tgl_registrasi, pasien_kunjungan.jam_reg, pasien_kunjungan.id_reg, diagnosa_pasien.kd_penyakit, penilaian_awal_keperawatan_ralan.alergi, diagnosa_pasien.kd_icd9, '' AS `cetak`");
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
        $this->no_rkm_medis->DbValue = $row['no_rkm_medis'];
        $this->id_reg->DbValue = $row['id_reg'];
        $this->tgl_registrasi->DbValue = $row['tgl_registrasi'];
        $this->jam_reg->DbValue = $row['jam_reg'];
        $this->kd_poli->DbValue = $row['kd_poli'];
        $this->kd_penyakit->DbValue = $row['kd_penyakit'];
        $this->alergi->DbValue = $row['alergi'];
        $this->kd_dokter->DbValue = $row['kd_dokter'];
        $this->kd_icd9->DbValue = $row['kd_icd9'];
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
        return $_SESSION[$name] ?? GetUrl("PrmrjList");
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
        if ($pageName == "PrmrjView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PrmrjEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PrmrjAdd") {
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
                return "PrmrjView";
            case Config("API_ADD_ACTION"):
                return "PrmrjAdd";
            case Config("API_EDIT_ACTION"):
                return "PrmrjEdit";
            case Config("API_DELETE_ACTION"):
                return "PrmrjDelete";
            case Config("API_LIST_ACTION"):
                return "PrmrjList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PrmrjList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PrmrjView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PrmrjView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PrmrjAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PrmrjAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PrmrjEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PrmrjAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PrmrjDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "vrajal" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_no_rkm_medis", $this->no_rkm_medis->CurrentValue ?? $this->no_rkm_medis->getSessionValue());
        }
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
        $this->no_rkm_medis->setDbValue($row['no_rkm_medis']);
        $this->id_reg->setDbValue($row['id_reg']);
        $this->tgl_registrasi->setDbValue($row['tgl_registrasi']);
        $this->jam_reg->setDbValue($row['jam_reg']);
        $this->kd_poli->setDbValue($row['kd_poli']);
        $this->kd_penyakit->setDbValue($row['kd_penyakit']);
        $this->alergi->setDbValue($row['alergi']);
        $this->kd_dokter->setDbValue($row['kd_dokter']);
        $this->kd_icd9->setDbValue($row['kd_icd9']);
        $this->cetak->setDbValue($row['cetak']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // no_rkm_medis

        // id_reg

        // tgl_registrasi

        // jam_reg

        // kd_poli

        // kd_penyakit

        // alergi

        // kd_dokter

        // kd_icd9

        // cetak

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

        // id_reg
        $this->id_reg->ViewValue = $this->id_reg->CurrentValue;
        $this->id_reg->ViewCustomAttributes = "";

        // tgl_registrasi
        $this->tgl_registrasi->ViewValue = $this->tgl_registrasi->CurrentValue;
        $this->tgl_registrasi->ViewValue = FormatDateTime($this->tgl_registrasi->ViewValue, 6);
        $this->tgl_registrasi->ViewCustomAttributes = "";

        // jam_reg
        $this->jam_reg->ViewValue = $this->jam_reg->CurrentValue;
        $this->jam_reg->ViewValue = FormatDateTime($this->jam_reg->ViewValue, 4);
        $this->jam_reg->ViewCustomAttributes = "";

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

        // kd_penyakit
        $curVal = trim(strval($this->kd_penyakit->CurrentValue));
        if ($curVal != "") {
            $this->kd_penyakit->ViewValue = $this->kd_penyakit->lookupCacheOption($curVal);
            if ($this->kd_penyakit->ViewValue === null) { // Lookup from database
                $filterWrk = "`kd_penyakit`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->kd_penyakit->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_penyakit->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_penyakit->ViewValue = $this->kd_penyakit->displayValue($arwrk);
                } else {
                    $this->kd_penyakit->ViewValue = $this->kd_penyakit->CurrentValue;
                }
            }
        } else {
            $this->kd_penyakit->ViewValue = null;
        }
        $this->kd_penyakit->ViewCustomAttributes = "";

        // alergi
        $this->alergi->ViewValue = $this->alergi->CurrentValue;
        $this->alergi->ViewCustomAttributes = "";

        // kd_dokter
        if (strval($this->kd_dokter->CurrentValue) != "") {
            $this->kd_dokter->ViewValue = $this->kd_dokter->optionCaption($this->kd_dokter->CurrentValue);
        } else {
            $this->kd_dokter->ViewValue = null;
        }
        $this->kd_dokter->ViewCustomAttributes = "";

        // kd_icd9
        $curVal = trim(strval($this->kd_icd9->CurrentValue));
        if ($curVal != "") {
            $this->kd_icd9->ViewValue = $this->kd_icd9->lookupCacheOption($curVal);
            if ($this->kd_icd9->ViewValue === null) { // Lookup from database
                $filterWrk = "`kode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->kd_icd9->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_icd9->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_icd9->ViewValue = $this->kd_icd9->displayValue($arwrk);
                } else {
                    $this->kd_icd9->ViewValue = $this->kd_icd9->CurrentValue;
                }
            }
        } else {
            $this->kd_icd9->ViewValue = null;
        }
        $this->kd_icd9->ViewCustomAttributes = "";

        // cetak
        $this->cetak->ViewValue = $this->cetak->CurrentValue;
        $this->cetak->ViewCustomAttributes = "";

        // no_rkm_medis
        $this->no_rkm_medis->LinkCustomAttributes = "";
        $this->no_rkm_medis->HrefValue = "";
        $this->no_rkm_medis->TooltipValue = "";

        // id_reg
        $this->id_reg->LinkCustomAttributes = "";
        $this->id_reg->HrefValue = "";
        $this->id_reg->TooltipValue = "";

        // tgl_registrasi
        $this->tgl_registrasi->LinkCustomAttributes = "";
        $this->tgl_registrasi->HrefValue = "";
        $this->tgl_registrasi->TooltipValue = "";

        // jam_reg
        $this->jam_reg->LinkCustomAttributes = "";
        $this->jam_reg->HrefValue = "";
        $this->jam_reg->TooltipValue = "";

        // kd_poli
        $this->kd_poli->LinkCustomAttributes = "";
        $this->kd_poli->HrefValue = "";
        $this->kd_poli->TooltipValue = "";

        // kd_penyakit
        $this->kd_penyakit->LinkCustomAttributes = "";
        $this->kd_penyakit->HrefValue = "";
        $this->kd_penyakit->TooltipValue = "";

        // alergi
        $this->alergi->LinkCustomAttributes = "";
        $this->alergi->HrefValue = "";
        $this->alergi->TooltipValue = "";

        // kd_dokter
        $this->kd_dokter->LinkCustomAttributes = "";
        $this->kd_dokter->HrefValue = "";
        $this->kd_dokter->TooltipValue = "";

        // kd_icd9
        $this->kd_icd9->LinkCustomAttributes = "";
        $this->kd_icd9->HrefValue = "";
        $this->kd_icd9->TooltipValue = "";

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

        // id_reg
        $this->id_reg->EditAttrs["class"] = "form-control";
        $this->id_reg->EditCustomAttributes = "";
        $this->id_reg->EditValue = $this->id_reg->CurrentValue;
        $this->id_reg->ViewCustomAttributes = "";

        // tgl_registrasi

        // jam_reg

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

        // kd_penyakit
        $this->kd_penyakit->EditAttrs["class"] = "form-control";
        $this->kd_penyakit->EditCustomAttributes = "";
        $curVal = trim(strval($this->kd_penyakit->CurrentValue));
        if ($curVal != "") {
            $this->kd_penyakit->EditValue = $this->kd_penyakit->lookupCacheOption($curVal);
            if ($this->kd_penyakit->EditValue === null) { // Lookup from database
                $filterWrk = "`kd_penyakit`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->kd_penyakit->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kd_penyakit->Lookup->renderViewRow($rswrk[0]);
                    $this->kd_penyakit->EditValue = $this->kd_penyakit->displayValue($arwrk);
                } else {
                    $this->kd_penyakit->EditValue = $this->kd_penyakit->CurrentValue;
                }
            }
        } else {
            $this->kd_penyakit->EditValue = null;
        }
        $this->kd_penyakit->ViewCustomAttributes = "";

        // alergi
        $this->alergi->EditAttrs["class"] = "form-control";
        $this->alergi->EditCustomAttributes = "";
        if (!$this->alergi->Raw) {
            $this->alergi->CurrentValue = HtmlDecode($this->alergi->CurrentValue);
        }
        $this->alergi->EditValue = $this->alergi->CurrentValue;
        $this->alergi->PlaceHolder = RemoveHtml($this->alergi->caption());

        // kd_dokter
        $this->kd_dokter->EditAttrs["class"] = "form-control";
        $this->kd_dokter->EditCustomAttributes = "";
        if (strval($this->kd_dokter->CurrentValue) != "") {
            $this->kd_dokter->EditValue = $this->kd_dokter->optionCaption($this->kd_dokter->CurrentValue);
        } else {
            $this->kd_dokter->EditValue = null;
        }
        $this->kd_dokter->ViewCustomAttributes = "";

        // kd_icd9
        $this->kd_icd9->EditAttrs["class"] = "form-control";
        $this->kd_icd9->EditCustomAttributes = "";
        $this->kd_icd9->PlaceHolder = RemoveHtml($this->kd_icd9->caption());

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
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->id_reg);
                    $doc->exportCaption($this->tgl_registrasi);
                    $doc->exportCaption($this->kd_poli);
                    $doc->exportCaption($this->kd_penyakit);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->kd_icd9);
                    $doc->exportCaption($this->cetak);
                } else {
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->id_reg);
                    $doc->exportCaption($this->tgl_registrasi);
                    $doc->exportCaption($this->jam_reg);
                    $doc->exportCaption($this->kd_poli);
                    $doc->exportCaption($this->kd_penyakit);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->kd_icd9);
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
                        $doc->exportField($this->id_reg);
                        $doc->exportField($this->tgl_registrasi);
                        $doc->exportField($this->kd_poli);
                        $doc->exportField($this->kd_penyakit);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->kd_icd9);
                        $doc->exportField($this->cetak);
                    } else {
                        $doc->exportField($this->no_rkm_medis);
                        $doc->exportField($this->id_reg);
                        $doc->exportField($this->tgl_registrasi);
                        $doc->exportField($this->jam_reg);
                        $doc->exportField($this->kd_poli);
                        $doc->exportField($this->kd_penyakit);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->kd_icd9);
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
