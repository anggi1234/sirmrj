<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for billing
 */
class Billing extends DbTable
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
    public $id_billing;
    public $no_reg;
    public $tgl_byr;
    public $no;
    public $nm_perawatan;
    public $pemisah;
    public $biaya;
    public $jumlah;
    public $tambahan;
    public $totalbiaya;
    public $status;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'billing';
        $this->TableName = 'billing';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`billing`";
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

        // id_billing
        $this->id_billing = new DbField('billing', 'billing', 'x_id_billing', 'id_billing', '`id_billing`', '`id_billing`', 3, 6, -1, false, '`id_billing`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_billing->IsAutoIncrement = true; // Autoincrement field
        $this->id_billing->IsPrimaryKey = true; // Primary key field
        $this->id_billing->Sortable = true; // Allow sort
        $this->id_billing->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_billing->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_billing->Param, "CustomMsg");
        $this->Fields['id_billing'] = &$this->id_billing;

        // no_reg
        $this->no_reg = new DbField('billing', 'billing', 'x_no_reg', 'no_reg', '`no_reg`', '`no_reg`', 200, 17, -1, false, '`no_reg`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_reg->IsForeignKey = true; // Foreign key field
        $this->no_reg->Nullable = false; // NOT NULL field
        $this->no_reg->Required = true; // Required field
        $this->no_reg->Sortable = true; // Allow sort
        $this->no_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_reg->Param, "CustomMsg");
        $this->Fields['no_reg'] = &$this->no_reg;

        // tgl_byr
        $this->tgl_byr = new DbField('billing', 'billing', 'x_tgl_byr', 'tgl_byr', '`tgl_byr`', CastDateFieldForLike("`tgl_byr`", 0, "DB"), 133, 10, 0, false, '`tgl_byr`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_byr->Sortable = true; // Allow sort
        $this->tgl_byr->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_byr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_byr->Param, "CustomMsg");
        $this->Fields['tgl_byr'] = &$this->tgl_byr;

        // no
        $this->no = new DbField('billing', 'billing', 'x_no', 'no', '`no`', '`no`', 200, 50, -1, false, '`no`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no->Nullable = false; // NOT NULL field
        $this->no->Required = true; // Required field
        $this->no->Sortable = true; // Allow sort
        $this->no->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no->Param, "CustomMsg");
        $this->Fields['no'] = &$this->no;

        // nm_perawatan
        $this->nm_perawatan = new DbField('billing', 'billing', 'x_nm_perawatan', 'nm_perawatan', '`nm_perawatan`', '`nm_perawatan`', 200, 200, -1, false, '`nm_perawatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nm_perawatan->Nullable = false; // NOT NULL field
        $this->nm_perawatan->Required = true; // Required field
        $this->nm_perawatan->Sortable = true; // Allow sort
        $this->nm_perawatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nm_perawatan->Param, "CustomMsg");
        $this->Fields['nm_perawatan'] = &$this->nm_perawatan;

        // pemisah
        $this->pemisah = new DbField('billing', 'billing', 'x_pemisah', 'pemisah', '`pemisah`', '`pemisah`', 200, 1, -1, false, '`pemisah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pemisah->Nullable = false; // NOT NULL field
        $this->pemisah->Required = true; // Required field
        $this->pemisah->Sortable = true; // Allow sort
        $this->pemisah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pemisah->Param, "CustomMsg");
        $this->Fields['pemisah'] = &$this->pemisah;

        // biaya
        $this->biaya = new DbField('billing', 'billing', 'x_biaya', 'biaya', '`biaya`', '`biaya`', 5, 22, -1, false, '`biaya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->biaya->Nullable = false; // NOT NULL field
        $this->biaya->Required = true; // Required field
        $this->biaya->Sortable = true; // Allow sort
        $this->biaya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->biaya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->biaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->biaya->Param, "CustomMsg");
        $this->Fields['biaya'] = &$this->biaya;

        // jumlah
        $this->jumlah = new DbField('billing', 'billing', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 5, 22, -1, false, '`jumlah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah->Nullable = false; // NOT NULL field
        $this->jumlah->Required = true; // Required field
        $this->jumlah->Sortable = true; // Allow sort
        $this->jumlah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jumlah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah->Param, "CustomMsg");
        $this->Fields['jumlah'] = &$this->jumlah;

        // tambahan
        $this->tambahan = new DbField('billing', 'billing', 'x_tambahan', 'tambahan', '`tambahan`', '`tambahan`', 5, 22, -1, false, '`tambahan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tambahan->Nullable = false; // NOT NULL field
        $this->tambahan->Required = true; // Required field
        $this->tambahan->Sortable = true; // Allow sort
        $this->tambahan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->tambahan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->tambahan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tambahan->Param, "CustomMsg");
        $this->Fields['tambahan'] = &$this->tambahan;

        // totalbiaya
        $this->totalbiaya = new DbField('billing', 'billing', 'x_totalbiaya', 'totalbiaya', '`totalbiaya`', '`totalbiaya`', 5, 22, -1, false, '`totalbiaya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->totalbiaya->Nullable = false; // NOT NULL field
        $this->totalbiaya->Required = true; // Required field
        $this->totalbiaya->Sortable = true; // Allow sort
        $this->totalbiaya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->totalbiaya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->totalbiaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->totalbiaya->Param, "CustomMsg");
        $this->Fields['totalbiaya'] = &$this->totalbiaya;

        // status
        $this->status = new DbField('billing', 'billing', 'x_status', 'status', '`status`', '`status`', 202, 22, -1, false, '`status`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->status->Lookup = new Lookup('status', 'billing', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'billing', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->status->OptionCount = 36;
        $this->status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status->Param, "CustomMsg");
        $this->Fields['status'] = &$this->status;
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
            if ($this->no_reg->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`id_reg`", $this->no_reg->getSessionValue(), DATATYPE_NUMBER, "DB");
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
            if ($this->no_reg->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`no_reg`", $this->no_reg->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    // Master filter
    public function sqlMasterFilter_vrajal()
    {
        return "`id_reg`=@id_reg@";
    }
    // Detail filter
    public function sqlDetailFilter_vrajal()
    {
        return "`no_reg`='@no_reg@'";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`billing`";
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
            $this->id_billing->setDbValue($conn->lastInsertId());
            $rs['id_billing'] = $this->id_billing->DbValue;
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
            if (array_key_exists('id_billing', $rs)) {
                AddFilter($where, QuotedName('id_billing', $this->Dbid) . '=' . QuotedValue($rs['id_billing'], $this->id_billing->DataType, $this->Dbid));
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
        $this->id_billing->DbValue = $row['id_billing'];
        $this->no_reg->DbValue = $row['no_reg'];
        $this->tgl_byr->DbValue = $row['tgl_byr'];
        $this->no->DbValue = $row['no'];
        $this->nm_perawatan->DbValue = $row['nm_perawatan'];
        $this->pemisah->DbValue = $row['pemisah'];
        $this->biaya->DbValue = $row['biaya'];
        $this->jumlah->DbValue = $row['jumlah'];
        $this->tambahan->DbValue = $row['tambahan'];
        $this->totalbiaya->DbValue = $row['totalbiaya'];
        $this->status->DbValue = $row['status'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_billing` = @id_billing@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_billing->CurrentValue : $this->id_billing->OldValue;
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
                $this->id_billing->CurrentValue = $keys[0];
            } else {
                $this->id_billing->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_billing', $row) ? $row['id_billing'] : null;
        } else {
            $val = $this->id_billing->OldValue !== null ? $this->id_billing->OldValue : $this->id_billing->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_billing@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("BillingList");
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
        if ($pageName == "BillingView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BillingEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BillingAdd") {
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
                return "BillingView";
            case Config("API_ADD_ACTION"):
                return "BillingAdd";
            case Config("API_EDIT_ACTION"):
                return "BillingEdit";
            case Config("API_DELETE_ACTION"):
                return "BillingDelete";
            case Config("API_LIST_ACTION"):
                return "BillingList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BillingList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BillingView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BillingView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BillingAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BillingAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BillingEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("BillingAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("BillingDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "vrajal" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id_reg", $this->no_reg->CurrentValue ?? $this->no_reg->getSessionValue());
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_billing:" . JsonEncode($this->id_billing->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_billing->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_billing->CurrentValue);
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
            if (($keyValue = Param("id_billing") ?? Route("id_billing")) !== null) {
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
                $this->id_billing->CurrentValue = $key;
            } else {
                $this->id_billing->OldValue = $key;
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
        $this->id_billing->setDbValue($row['id_billing']);
        $this->no_reg->setDbValue($row['no_reg']);
        $this->tgl_byr->setDbValue($row['tgl_byr']);
        $this->no->setDbValue($row['no']);
        $this->nm_perawatan->setDbValue($row['nm_perawatan']);
        $this->pemisah->setDbValue($row['pemisah']);
        $this->biaya->setDbValue($row['biaya']);
        $this->jumlah->setDbValue($row['jumlah']);
        $this->tambahan->setDbValue($row['tambahan']);
        $this->totalbiaya->setDbValue($row['totalbiaya']);
        $this->status->setDbValue($row['status']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_billing

        // no_reg

        // tgl_byr

        // no

        // nm_perawatan

        // pemisah

        // biaya

        // jumlah

        // tambahan

        // totalbiaya

        // status

        // id_billing
        $this->id_billing->ViewValue = $this->id_billing->CurrentValue;
        $this->id_billing->ViewCustomAttributes = "";

        // no_reg
        $this->no_reg->ViewValue = $this->no_reg->CurrentValue;
        $this->no_reg->ViewCustomAttributes = "";

        // tgl_byr
        $this->tgl_byr->ViewValue = $this->tgl_byr->CurrentValue;
        $this->tgl_byr->ViewValue = FormatDateTime($this->tgl_byr->ViewValue, 0);
        $this->tgl_byr->ViewCustomAttributes = "";

        // no
        $this->no->ViewValue = $this->no->CurrentValue;
        $this->no->ViewCustomAttributes = "";

        // nm_perawatan
        $this->nm_perawatan->ViewValue = $this->nm_perawatan->CurrentValue;
        $this->nm_perawatan->ViewCustomAttributes = "";

        // pemisah
        $this->pemisah->ViewValue = $this->pemisah->CurrentValue;
        $this->pemisah->ViewCustomAttributes = "";

        // biaya
        $this->biaya->ViewValue = $this->biaya->CurrentValue;
        $this->biaya->ViewValue = FormatNumber($this->biaya->ViewValue, 2, -2, -2, -2);
        $this->biaya->ViewCustomAttributes = "";

        // jumlah
        $this->jumlah->ViewValue = $this->jumlah->CurrentValue;
        $this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 2, -2, -2, -2);
        $this->jumlah->ViewCustomAttributes = "";

        // tambahan
        $this->tambahan->ViewValue = $this->tambahan->CurrentValue;
        $this->tambahan->ViewValue = FormatNumber($this->tambahan->ViewValue, 2, -2, -2, -2);
        $this->tambahan->ViewCustomAttributes = "";

        // totalbiaya
        $this->totalbiaya->ViewValue = $this->totalbiaya->CurrentValue;
        $this->totalbiaya->ViewValue = FormatNumber($this->totalbiaya->ViewValue, 2, -2, -2, -2);
        $this->totalbiaya->ViewCustomAttributes = "";

        // status
        if (strval($this->status->CurrentValue) != "") {
            $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
        } else {
            $this->status->ViewValue = null;
        }
        $this->status->ViewCustomAttributes = "";

        // id_billing
        $this->id_billing->LinkCustomAttributes = "";
        $this->id_billing->HrefValue = "";
        $this->id_billing->TooltipValue = "";

        // no_reg
        $this->no_reg->LinkCustomAttributes = "";
        $this->no_reg->HrefValue = "";
        $this->no_reg->TooltipValue = "";

        // tgl_byr
        $this->tgl_byr->LinkCustomAttributes = "";
        $this->tgl_byr->HrefValue = "";
        $this->tgl_byr->TooltipValue = "";

        // no
        $this->no->LinkCustomAttributes = "";
        $this->no->HrefValue = "";
        $this->no->TooltipValue = "";

        // nm_perawatan
        $this->nm_perawatan->LinkCustomAttributes = "";
        $this->nm_perawatan->HrefValue = "";
        $this->nm_perawatan->TooltipValue = "";

        // pemisah
        $this->pemisah->LinkCustomAttributes = "";
        $this->pemisah->HrefValue = "";
        $this->pemisah->TooltipValue = "";

        // biaya
        $this->biaya->LinkCustomAttributes = "";
        $this->biaya->HrefValue = "";
        $this->biaya->TooltipValue = "";

        // jumlah
        $this->jumlah->LinkCustomAttributes = "";
        $this->jumlah->HrefValue = "";
        $this->jumlah->TooltipValue = "";

        // tambahan
        $this->tambahan->LinkCustomAttributes = "";
        $this->tambahan->HrefValue = "";
        $this->tambahan->TooltipValue = "";

        // totalbiaya
        $this->totalbiaya->LinkCustomAttributes = "";
        $this->totalbiaya->HrefValue = "";
        $this->totalbiaya->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

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

        // id_billing
        $this->id_billing->EditAttrs["class"] = "form-control";
        $this->id_billing->EditCustomAttributes = "";
        $this->id_billing->EditValue = $this->id_billing->CurrentValue;
        $this->id_billing->ViewCustomAttributes = "";

        // no_reg
        $this->no_reg->EditAttrs["class"] = "form-control";
        $this->no_reg->EditCustomAttributes = "";
        if ($this->no_reg->getSessionValue() != "") {
            $this->no_reg->CurrentValue = GetForeignKeyValue($this->no_reg->getSessionValue());
            $this->no_reg->ViewValue = $this->no_reg->CurrentValue;
            $this->no_reg->ViewCustomAttributes = "";
        } else {
            if (!$this->no_reg->Raw) {
                $this->no_reg->CurrentValue = HtmlDecode($this->no_reg->CurrentValue);
            }
            $this->no_reg->EditValue = $this->no_reg->CurrentValue;
            $this->no_reg->PlaceHolder = RemoveHtml($this->no_reg->caption());
        }

        // tgl_byr
        $this->tgl_byr->EditAttrs["class"] = "form-control";
        $this->tgl_byr->EditCustomAttributes = "";
        $this->tgl_byr->EditValue = FormatDateTime($this->tgl_byr->CurrentValue, 8);
        $this->tgl_byr->PlaceHolder = RemoveHtml($this->tgl_byr->caption());

        // no
        $this->no->EditAttrs["class"] = "form-control";
        $this->no->EditCustomAttributes = "";
        if (!$this->no->Raw) {
            $this->no->CurrentValue = HtmlDecode($this->no->CurrentValue);
        }
        $this->no->EditValue = $this->no->CurrentValue;
        $this->no->PlaceHolder = RemoveHtml($this->no->caption());

        // nm_perawatan
        $this->nm_perawatan->EditAttrs["class"] = "form-control";
        $this->nm_perawatan->EditCustomAttributes = "";
        if (!$this->nm_perawatan->Raw) {
            $this->nm_perawatan->CurrentValue = HtmlDecode($this->nm_perawatan->CurrentValue);
        }
        $this->nm_perawatan->EditValue = $this->nm_perawatan->CurrentValue;
        $this->nm_perawatan->PlaceHolder = RemoveHtml($this->nm_perawatan->caption());

        // pemisah
        $this->pemisah->EditAttrs["class"] = "form-control";
        $this->pemisah->EditCustomAttributes = "";
        if (!$this->pemisah->Raw) {
            $this->pemisah->CurrentValue = HtmlDecode($this->pemisah->CurrentValue);
        }
        $this->pemisah->EditValue = $this->pemisah->CurrentValue;
        $this->pemisah->PlaceHolder = RemoveHtml($this->pemisah->caption());

        // biaya
        $this->biaya->EditAttrs["class"] = "form-control";
        $this->biaya->EditCustomAttributes = "";
        $this->biaya->EditValue = $this->biaya->CurrentValue;
        $this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
        if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue)) {
            $this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -2, -2, -2);
        }

        // jumlah
        $this->jumlah->EditAttrs["class"] = "form-control";
        $this->jumlah->EditCustomAttributes = "";
        $this->jumlah->EditValue = $this->jumlah->CurrentValue;
        $this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());
        if (strval($this->jumlah->EditValue) != "" && is_numeric($this->jumlah->EditValue)) {
            $this->jumlah->EditValue = FormatNumber($this->jumlah->EditValue, -2, -2, -2, -2);
        }

        // tambahan
        $this->tambahan->EditAttrs["class"] = "form-control";
        $this->tambahan->EditCustomAttributes = "";
        $this->tambahan->EditValue = $this->tambahan->CurrentValue;
        $this->tambahan->PlaceHolder = RemoveHtml($this->tambahan->caption());
        if (strval($this->tambahan->EditValue) != "" && is_numeric($this->tambahan->EditValue)) {
            $this->tambahan->EditValue = FormatNumber($this->tambahan->EditValue, -2, -2, -2, -2);
        }

        // totalbiaya
        $this->totalbiaya->EditAttrs["class"] = "form-control";
        $this->totalbiaya->EditCustomAttributes = "";
        $this->totalbiaya->EditValue = $this->totalbiaya->CurrentValue;
        $this->totalbiaya->PlaceHolder = RemoveHtml($this->totalbiaya->caption());
        if (strval($this->totalbiaya->EditValue) != "" && is_numeric($this->totalbiaya->EditValue)) {
            $this->totalbiaya->EditValue = FormatNumber($this->totalbiaya->EditValue, -2, -2, -2, -2);
        }

        // status
        $this->status->EditCustomAttributes = "";
        $this->status->EditValue = $this->status->options(false);
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

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
                    $doc->exportCaption($this->no_reg);
                    $doc->exportCaption($this->tgl_byr);
                    $doc->exportCaption($this->no);
                    $doc->exportCaption($this->nm_perawatan);
                    $doc->exportCaption($this->pemisah);
                    $doc->exportCaption($this->biaya);
                    $doc->exportCaption($this->jumlah);
                    $doc->exportCaption($this->tambahan);
                    $doc->exportCaption($this->totalbiaya);
                    $doc->exportCaption($this->status);
                } else {
                    $doc->exportCaption($this->id_billing);
                    $doc->exportCaption($this->no_reg);
                    $doc->exportCaption($this->tgl_byr);
                    $doc->exportCaption($this->no);
                    $doc->exportCaption($this->nm_perawatan);
                    $doc->exportCaption($this->pemisah);
                    $doc->exportCaption($this->biaya);
                    $doc->exportCaption($this->jumlah);
                    $doc->exportCaption($this->tambahan);
                    $doc->exportCaption($this->totalbiaya);
                    $doc->exportCaption($this->status);
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
                        $doc->exportField($this->no_reg);
                        $doc->exportField($this->tgl_byr);
                        $doc->exportField($this->no);
                        $doc->exportField($this->nm_perawatan);
                        $doc->exportField($this->pemisah);
                        $doc->exportField($this->biaya);
                        $doc->exportField($this->jumlah);
                        $doc->exportField($this->tambahan);
                        $doc->exportField($this->totalbiaya);
                        $doc->exportField($this->status);
                    } else {
                        $doc->exportField($this->id_billing);
                        $doc->exportField($this->no_reg);
                        $doc->exportField($this->tgl_byr);
                        $doc->exportField($this->no);
                        $doc->exportField($this->nm_perawatan);
                        $doc->exportField($this->pemisah);
                        $doc->exportField($this->biaya);
                        $doc->exportField($this->jumlah);
                        $doc->exportField($this->tambahan);
                        $doc->exportField($this->totalbiaya);
                        $doc->exportField($this->status);
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
