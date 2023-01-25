<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for konsul
 */
class Konsul extends DbTable
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
    public $id_konsul;
    public $no_reg;
    public $jenis_konsul;
    public $konsultasi;
    public $hasil_konsul;
    public $status_konsul;
    public $tanggal_input;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'konsul';
        $this->TableName = 'konsul';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`konsul`";
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

        // id_konsul
        $this->id_konsul = new DbField('konsul', 'konsul', 'x_id_konsul', 'id_konsul', '`id_konsul`', '`id_konsul`', 3, 6, -1, false, '`id_konsul`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_konsul->IsAutoIncrement = true; // Autoincrement field
        $this->id_konsul->IsPrimaryKey = true; // Primary key field
        $this->id_konsul->Sortable = true; // Allow sort
        $this->id_konsul->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_konsul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_konsul->Param, "CustomMsg");
        $this->Fields['id_konsul'] = &$this->id_konsul;

        // no_reg
        $this->no_reg = new DbField('konsul', 'konsul', 'x_no_reg', 'no_reg', '`no_reg`', '`no_reg`', 3, 11, -1, false, '`no_reg`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_reg->IsForeignKey = true; // Foreign key field
        $this->no_reg->Sortable = true; // Allow sort
        $this->no_reg->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->no_reg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_reg->Param, "CustomMsg");
        $this->Fields['no_reg'] = &$this->no_reg;

        // jenis_konsul
        $this->jenis_konsul = new DbField('konsul', 'konsul', 'x_jenis_konsul', 'jenis_konsul', '`jenis_konsul`', '`jenis_konsul`', 202, 10, -1, false, '`jenis_konsul`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->jenis_konsul->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->jenis_konsul->Lookup = new Lookup('jenis_konsul', 'konsul', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->jenis_konsul->Lookup = new Lookup('jenis_konsul', 'konsul', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->jenis_konsul->OptionCount = 2;
        $this->jenis_konsul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jenis_konsul->Param, "CustomMsg");
        $this->Fields['jenis_konsul'] = &$this->jenis_konsul;

        // konsultasi
        $this->konsultasi = new DbField('konsul', 'konsul', 'x_konsultasi', 'konsultasi', '`konsultasi`', '`konsultasi`', 200, 100, -1, false, '`konsultasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->konsultasi->Sortable = true; // Allow sort
        $this->konsultasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->konsultasi->Param, "CustomMsg");
        $this->Fields['konsultasi'] = &$this->konsultasi;

        // hasil_konsul
        $this->hasil_konsul = new DbField('konsul', 'konsul', 'x_hasil_konsul', 'hasil_konsul', '`hasil_konsul`', '`hasil_konsul`', 200, 100, -1, false, '`hasil_konsul`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->hasil_konsul->Sortable = true; // Allow sort
        $this->hasil_konsul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hasil_konsul->Param, "CustomMsg");
        $this->Fields['hasil_konsul'] = &$this->hasil_konsul;

        // status_konsul
        $this->status_konsul = new DbField('konsul', 'konsul', 'x_status_konsul', 'status_konsul', '`status_konsul`', '`status_konsul`', 202, 7, -1, false, '`status_konsul`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status_konsul->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->status_konsul->Lookup = new Lookup('status_konsul', 'konsul', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->status_konsul->Lookup = new Lookup('status_konsul', 'konsul', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->status_konsul->OptionCount = 3;
        $this->status_konsul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_konsul->Param, "CustomMsg");
        $this->Fields['status_konsul'] = &$this->status_konsul;

        // tanggal_input
        $this->tanggal_input = new DbField('konsul', 'konsul', 'x_tanggal_input', 'tanggal_input', '`tanggal_input`', CastDateFieldForLike("`tanggal_input`", 14, "DB"), 135, 26, 14, false, '`tanggal_input`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_input->Sortable = true; // Allow sort
        $this->tanggal_input->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectShortDateDMY"));
        $this->tanggal_input->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_input->Param, "CustomMsg");
        $this->Fields['tanggal_input'] = &$this->tanggal_input;
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
                $detailFilter .= "" . GetForeignKeySql("`no_reg`", $this->no_reg->getSessionValue(), DATATYPE_NUMBER, "DB");
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
        return "`no_reg`=@no_reg@";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`konsul`";
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
            $this->id_konsul->setDbValue($conn->lastInsertId());
            $rs['id_konsul'] = $this->id_konsul->DbValue;
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
            if (array_key_exists('id_konsul', $rs)) {
                AddFilter($where, QuotedName('id_konsul', $this->Dbid) . '=' . QuotedValue($rs['id_konsul'], $this->id_konsul->DataType, $this->Dbid));
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
        $this->id_konsul->DbValue = $row['id_konsul'];
        $this->no_reg->DbValue = $row['no_reg'];
        $this->jenis_konsul->DbValue = $row['jenis_konsul'];
        $this->konsultasi->DbValue = $row['konsultasi'];
        $this->hasil_konsul->DbValue = $row['hasil_konsul'];
        $this->status_konsul->DbValue = $row['status_konsul'];
        $this->tanggal_input->DbValue = $row['tanggal_input'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_konsul` = @id_konsul@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_konsul->CurrentValue : $this->id_konsul->OldValue;
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
                $this->id_konsul->CurrentValue = $keys[0];
            } else {
                $this->id_konsul->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_konsul', $row) ? $row['id_konsul'] : null;
        } else {
            $val = $this->id_konsul->OldValue !== null ? $this->id_konsul->OldValue : $this->id_konsul->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_konsul@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("KonsulList");
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
        if ($pageName == "KonsulView") {
            return $Language->phrase("View");
        } elseif ($pageName == "KonsulEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "KonsulAdd") {
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
                return "KonsulView";
            case Config("API_ADD_ACTION"):
                return "KonsulAdd";
            case Config("API_EDIT_ACTION"):
                return "KonsulEdit";
            case Config("API_DELETE_ACTION"):
                return "KonsulDelete";
            case Config("API_LIST_ACTION"):
                return "KonsulList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "KonsulList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("KonsulView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("KonsulView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "KonsulAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "KonsulAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("KonsulEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("KonsulAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("KonsulDelete", $this->getUrlParm());
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
        $json .= "id_konsul:" . JsonEncode($this->id_konsul->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_konsul->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_konsul->CurrentValue);
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
            if (($keyValue = Param("id_konsul") ?? Route("id_konsul")) !== null) {
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
                $this->id_konsul->CurrentValue = $key;
            } else {
                $this->id_konsul->OldValue = $key;
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
        $this->id_konsul->setDbValue($row['id_konsul']);
        $this->no_reg->setDbValue($row['no_reg']);
        $this->jenis_konsul->setDbValue($row['jenis_konsul']);
        $this->konsultasi->setDbValue($row['konsultasi']);
        $this->hasil_konsul->setDbValue($row['hasil_konsul']);
        $this->status_konsul->setDbValue($row['status_konsul']);
        $this->tanggal_input->setDbValue($row['tanggal_input']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_konsul
        $this->id_konsul->CellCssStyle = "white-space: nowrap;";

        // no_reg
        $this->no_reg->CellCssStyle = "white-space: nowrap;";

        // jenis_konsul

        // konsultasi

        // hasil_konsul

        // status_konsul

        // tanggal_input

        // id_konsul
        $this->id_konsul->ViewValue = $this->id_konsul->CurrentValue;
        $this->id_konsul->ViewCustomAttributes = "";

        // no_reg
        $this->no_reg->ViewValue = $this->no_reg->CurrentValue;
        $this->no_reg->ViewValue = FormatNumber($this->no_reg->ViewValue, 0, -2, -2, 0);
        $this->no_reg->ViewCustomAttributes = "";

        // jenis_konsul
        if (strval($this->jenis_konsul->CurrentValue) != "") {
            $this->jenis_konsul->ViewValue = $this->jenis_konsul->optionCaption($this->jenis_konsul->CurrentValue);
        } else {
            $this->jenis_konsul->ViewValue = null;
        }
        $this->jenis_konsul->ViewCustomAttributes = "";

        // konsultasi
        $this->konsultasi->ViewValue = $this->konsultasi->CurrentValue;
        $this->konsultasi->ViewCustomAttributes = "";

        // hasil_konsul
        $this->hasil_konsul->ViewValue = $this->hasil_konsul->CurrentValue;
        $this->hasil_konsul->ViewCustomAttributes = "";

        // status_konsul
        if (strval($this->status_konsul->CurrentValue) != "") {
            $this->status_konsul->ViewValue = $this->status_konsul->optionCaption($this->status_konsul->CurrentValue);
        } else {
            $this->status_konsul->ViewValue = null;
        }
        $this->status_konsul->ViewCustomAttributes = "";

        // tanggal_input
        $this->tanggal_input->ViewValue = $this->tanggal_input->CurrentValue;
        $this->tanggal_input->ViewValue = FormatDateTime($this->tanggal_input->ViewValue, 14);
        $this->tanggal_input->ViewCustomAttributes = "";

        // id_konsul
        $this->id_konsul->LinkCustomAttributes = "";
        $this->id_konsul->HrefValue = "";
        $this->id_konsul->TooltipValue = "";

        // no_reg
        $this->no_reg->LinkCustomAttributes = "";
        $this->no_reg->HrefValue = "";
        $this->no_reg->TooltipValue = "";

        // jenis_konsul
        $this->jenis_konsul->LinkCustomAttributes = "";
        $this->jenis_konsul->HrefValue = "";
        $this->jenis_konsul->TooltipValue = "";

        // konsultasi
        $this->konsultasi->LinkCustomAttributes = "";
        $this->konsultasi->HrefValue = "";
        $this->konsultasi->TooltipValue = "";

        // hasil_konsul
        $this->hasil_konsul->LinkCustomAttributes = "";
        $this->hasil_konsul->HrefValue = "";
        $this->hasil_konsul->TooltipValue = "";

        // status_konsul
        $this->status_konsul->LinkCustomAttributes = "";
        $this->status_konsul->HrefValue = "";
        $this->status_konsul->TooltipValue = "";

        // tanggal_input
        $this->tanggal_input->LinkCustomAttributes = "";
        $this->tanggal_input->HrefValue = "";
        $this->tanggal_input->TooltipValue = "";

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

        // id_konsul
        $this->id_konsul->EditAttrs["class"] = "form-control";
        $this->id_konsul->EditCustomAttributes = "";
        $this->id_konsul->EditValue = $this->id_konsul->CurrentValue;
        $this->id_konsul->ViewCustomAttributes = "";

        // no_reg
        $this->no_reg->EditAttrs["class"] = "form-control";
        $this->no_reg->EditCustomAttributes = "";
        if ($this->no_reg->getSessionValue() != "") {
            $this->no_reg->CurrentValue = GetForeignKeyValue($this->no_reg->getSessionValue());
            $this->no_reg->ViewValue = $this->no_reg->CurrentValue;
            $this->no_reg->ViewValue = FormatNumber($this->no_reg->ViewValue, 0, -2, -2, 0);
            $this->no_reg->ViewCustomAttributes = "";
        } else {
            $this->no_reg->EditValue = $this->no_reg->CurrentValue;
            $this->no_reg->PlaceHolder = RemoveHtml($this->no_reg->caption());
        }

        // jenis_konsul
        $this->jenis_konsul->EditCustomAttributes = "";
        $this->jenis_konsul->EditValue = $this->jenis_konsul->options(false);
        $this->jenis_konsul->PlaceHolder = RemoveHtml($this->jenis_konsul->caption());

        // konsultasi
        $this->konsultasi->EditAttrs["class"] = "form-control";
        $this->konsultasi->EditCustomAttributes = "";
        if (!$this->konsultasi->Raw) {
            $this->konsultasi->CurrentValue = HtmlDecode($this->konsultasi->CurrentValue);
        }
        $this->konsultasi->EditValue = $this->konsultasi->CurrentValue;
        $this->konsultasi->PlaceHolder = RemoveHtml($this->konsultasi->caption());

        // hasil_konsul
        $this->hasil_konsul->EditAttrs["class"] = "form-control";
        $this->hasil_konsul->EditCustomAttributes = "";
        if (!$this->hasil_konsul->Raw) {
            $this->hasil_konsul->CurrentValue = HtmlDecode($this->hasil_konsul->CurrentValue);
        }
        $this->hasil_konsul->EditValue = $this->hasil_konsul->CurrentValue;
        $this->hasil_konsul->PlaceHolder = RemoveHtml($this->hasil_konsul->caption());

        // status_konsul
        $this->status_konsul->EditCustomAttributes = "";
        $this->status_konsul->EditValue = $this->status_konsul->options(false);
        $this->status_konsul->PlaceHolder = RemoveHtml($this->status_konsul->caption());

        // tanggal_input

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
                    $doc->exportCaption($this->id_konsul);
                    $doc->exportCaption($this->no_reg);
                    $doc->exportCaption($this->jenis_konsul);
                    $doc->exportCaption($this->konsultasi);
                    $doc->exportCaption($this->hasil_konsul);
                    $doc->exportCaption($this->status_konsul);
                    $doc->exportCaption($this->tanggal_input);
                } else {
                    $doc->exportCaption($this->id_konsul);
                    $doc->exportCaption($this->no_reg);
                    $doc->exportCaption($this->jenis_konsul);
                    $doc->exportCaption($this->konsultasi);
                    $doc->exportCaption($this->hasil_konsul);
                    $doc->exportCaption($this->status_konsul);
                    $doc->exportCaption($this->tanggal_input);
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
                        $doc->exportField($this->id_konsul);
                        $doc->exportField($this->no_reg);
                        $doc->exportField($this->jenis_konsul);
                        $doc->exportField($this->konsultasi);
                        $doc->exportField($this->hasil_konsul);
                        $doc->exportField($this->status_konsul);
                        $doc->exportField($this->tanggal_input);
                    } else {
                        $doc->exportField($this->id_konsul);
                        $doc->exportField($this->no_reg);
                        $doc->exportField($this->jenis_konsul);
                        $doc->exportField($this->konsultasi);
                        $doc->exportField($this->hasil_konsul);
                        $doc->exportField($this->status_konsul);
                        $doc->exportField($this->tanggal_input);
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
