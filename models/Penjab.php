<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for penjab
 */
class Penjab extends DbTable
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
    public $kd_pj;
    public $png_jawab;
    public $nama_perusahaan;
    public $alamat_asuransi;
    public $no_telp;
    public $attn;
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
        $this->TableVar = 'penjab';
        $this->TableName = 'penjab';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`penjab`";
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

        // kd_pj
        $this->kd_pj = new DbField('penjab', 'penjab', 'x_kd_pj', 'kd_pj', '`kd_pj`', '`kd_pj`', 200, 3, -1, false, '`kd_pj`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kd_pj->IsPrimaryKey = true; // Primary key field
        $this->kd_pj->Nullable = false; // NOT NULL field
        $this->kd_pj->Required = true; // Required field
        $this->kd_pj->Sortable = true; // Allow sort
        $this->kd_pj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_pj->Param, "CustomMsg");
        $this->Fields['kd_pj'] = &$this->kd_pj;

        // png_jawab
        $this->png_jawab = new DbField('penjab', 'penjab', 'x_png_jawab', 'png_jawab', '`png_jawab`', '`png_jawab`', 200, 30, -1, false, '`png_jawab`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->png_jawab->Nullable = false; // NOT NULL field
        $this->png_jawab->Required = true; // Required field
        $this->png_jawab->Sortable = true; // Allow sort
        $this->png_jawab->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->png_jawab->Param, "CustomMsg");
        $this->Fields['png_jawab'] = &$this->png_jawab;

        // nama_perusahaan
        $this->nama_perusahaan = new DbField('penjab', 'penjab', 'x_nama_perusahaan', 'nama_perusahaan', '`nama_perusahaan`', '`nama_perusahaan`', 200, 60, -1, false, '`nama_perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_perusahaan->Nullable = false; // NOT NULL field
        $this->nama_perusahaan->Required = true; // Required field
        $this->nama_perusahaan->Sortable = true; // Allow sort
        $this->nama_perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_perusahaan->Param, "CustomMsg");
        $this->Fields['nama_perusahaan'] = &$this->nama_perusahaan;

        // alamat_asuransi
        $this->alamat_asuransi = new DbField('penjab', 'penjab', 'x_alamat_asuransi', 'alamat_asuransi', '`alamat_asuransi`', '`alamat_asuransi`', 200, 130, -1, false, '`alamat_asuransi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat_asuransi->Nullable = false; // NOT NULL field
        $this->alamat_asuransi->Required = true; // Required field
        $this->alamat_asuransi->Sortable = true; // Allow sort
        $this->alamat_asuransi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat_asuransi->Param, "CustomMsg");
        $this->Fields['alamat_asuransi'] = &$this->alamat_asuransi;

        // no_telp
        $this->no_telp = new DbField('penjab', 'penjab', 'x_no_telp', 'no_telp', '`no_telp`', '`no_telp`', 200, 40, -1, false, '`no_telp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_telp->Nullable = false; // NOT NULL field
        $this->no_telp->Required = true; // Required field
        $this->no_telp->Sortable = true; // Allow sort
        $this->no_telp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_telp->Param, "CustomMsg");
        $this->Fields['no_telp'] = &$this->no_telp;

        // attn
        $this->attn = new DbField('penjab', 'penjab', 'x_attn', 'attn', '`attn`', '`attn`', 200, 60, -1, false, '`attn`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->attn->Nullable = false; // NOT NULL field
        $this->attn->Required = true; // Required field
        $this->attn->Sortable = true; // Allow sort
        $this->attn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->attn->Param, "CustomMsg");
        $this->Fields['attn'] = &$this->attn;

        // status
        $this->status = new DbField('penjab', 'penjab', 'x_status', 'status', '`status`', '`status`', 202, 1, -1, false, '`status`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->status->Nullable = false; // NOT NULL field
        $this->status->Sortable = true; // Allow sort
        $this->status->DataType = DATATYPE_BOOLEAN;
        switch ($CurrentLanguage) {
            case "en":
                $this->status->Lookup = new Lookup('status', 'penjab', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'penjab', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->status->OptionCount = 2;
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

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`penjab`";
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
            if (array_key_exists('kd_pj', $rs)) {
                AddFilter($where, QuotedName('kd_pj', $this->Dbid) . '=' . QuotedValue($rs['kd_pj'], $this->kd_pj->DataType, $this->Dbid));
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
        $this->kd_pj->DbValue = $row['kd_pj'];
        $this->png_jawab->DbValue = $row['png_jawab'];
        $this->nama_perusahaan->DbValue = $row['nama_perusahaan'];
        $this->alamat_asuransi->DbValue = $row['alamat_asuransi'];
        $this->no_telp->DbValue = $row['no_telp'];
        $this->attn->DbValue = $row['attn'];
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
        return "`kd_pj` = '@kd_pj@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->kd_pj->CurrentValue : $this->kd_pj->OldValue;
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
                $this->kd_pj->CurrentValue = $keys[0];
            } else {
                $this->kd_pj->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('kd_pj', $row) ? $row['kd_pj'] : null;
        } else {
            $val = $this->kd_pj->OldValue !== null ? $this->kd_pj->OldValue : $this->kd_pj->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@kd_pj@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PenjabList");
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
        if ($pageName == "PenjabView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PenjabEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PenjabAdd") {
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
                return "PenjabView";
            case Config("API_ADD_ACTION"):
                return "PenjabAdd";
            case Config("API_EDIT_ACTION"):
                return "PenjabEdit";
            case Config("API_DELETE_ACTION"):
                return "PenjabDelete";
            case Config("API_LIST_ACTION"):
                return "PenjabList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PenjabList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PenjabView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PenjabView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PenjabAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PenjabAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PenjabEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PenjabAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PenjabDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "kd_pj:" . JsonEncode($this->kd_pj->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->kd_pj->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->kd_pj->CurrentValue);
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
            if (($keyValue = Param("kd_pj") ?? Route("kd_pj")) !== null) {
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
                $this->kd_pj->CurrentValue = $key;
            } else {
                $this->kd_pj->OldValue = $key;
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
        $this->kd_pj->setDbValue($row['kd_pj']);
        $this->png_jawab->setDbValue($row['png_jawab']);
        $this->nama_perusahaan->setDbValue($row['nama_perusahaan']);
        $this->alamat_asuransi->setDbValue($row['alamat_asuransi']);
        $this->no_telp->setDbValue($row['no_telp']);
        $this->attn->setDbValue($row['attn']);
        $this->status->setDbValue($row['status']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // kd_pj

        // png_jawab

        // nama_perusahaan

        // alamat_asuransi

        // no_telp

        // attn

        // status

        // kd_pj
        $this->kd_pj->ViewValue = $this->kd_pj->CurrentValue;
        $this->kd_pj->ViewCustomAttributes = "";

        // png_jawab
        $this->png_jawab->ViewValue = $this->png_jawab->CurrentValue;
        $this->png_jawab->ViewCustomAttributes = "";

        // nama_perusahaan
        $this->nama_perusahaan->ViewValue = $this->nama_perusahaan->CurrentValue;
        $this->nama_perusahaan->ViewCustomAttributes = "";

        // alamat_asuransi
        $this->alamat_asuransi->ViewValue = $this->alamat_asuransi->CurrentValue;
        $this->alamat_asuransi->ViewCustomAttributes = "";

        // no_telp
        $this->no_telp->ViewValue = $this->no_telp->CurrentValue;
        $this->no_telp->ViewCustomAttributes = "";

        // attn
        $this->attn->ViewValue = $this->attn->CurrentValue;
        $this->attn->ViewCustomAttributes = "";

        // status
        if (ConvertToBool($this->status->CurrentValue)) {
            $this->status->ViewValue = $this->status->tagCaption(2) != "" ? $this->status->tagCaption(2) : "1";
        } else {
            $this->status->ViewValue = $this->status->tagCaption(1) != "" ? $this->status->tagCaption(1) : "0";
        }
        $this->status->ViewCustomAttributes = "";

        // kd_pj
        $this->kd_pj->LinkCustomAttributes = "";
        $this->kd_pj->HrefValue = "";
        $this->kd_pj->TooltipValue = "";

        // png_jawab
        $this->png_jawab->LinkCustomAttributes = "";
        $this->png_jawab->HrefValue = "";
        $this->png_jawab->TooltipValue = "";

        // nama_perusahaan
        $this->nama_perusahaan->LinkCustomAttributes = "";
        $this->nama_perusahaan->HrefValue = "";
        $this->nama_perusahaan->TooltipValue = "";

        // alamat_asuransi
        $this->alamat_asuransi->LinkCustomAttributes = "";
        $this->alamat_asuransi->HrefValue = "";
        $this->alamat_asuransi->TooltipValue = "";

        // no_telp
        $this->no_telp->LinkCustomAttributes = "";
        $this->no_telp->HrefValue = "";
        $this->no_telp->TooltipValue = "";

        // attn
        $this->attn->LinkCustomAttributes = "";
        $this->attn->HrefValue = "";
        $this->attn->TooltipValue = "";

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

        // kd_pj
        $this->kd_pj->EditAttrs["class"] = "form-control";
        $this->kd_pj->EditCustomAttributes = "";
        if (!$this->kd_pj->Raw) {
            $this->kd_pj->CurrentValue = HtmlDecode($this->kd_pj->CurrentValue);
        }
        $this->kd_pj->EditValue = $this->kd_pj->CurrentValue;
        $this->kd_pj->PlaceHolder = RemoveHtml($this->kd_pj->caption());

        // png_jawab
        $this->png_jawab->EditAttrs["class"] = "form-control";
        $this->png_jawab->EditCustomAttributes = "";
        if (!$this->png_jawab->Raw) {
            $this->png_jawab->CurrentValue = HtmlDecode($this->png_jawab->CurrentValue);
        }
        $this->png_jawab->EditValue = $this->png_jawab->CurrentValue;
        $this->png_jawab->PlaceHolder = RemoveHtml($this->png_jawab->caption());

        // nama_perusahaan
        $this->nama_perusahaan->EditAttrs["class"] = "form-control";
        $this->nama_perusahaan->EditCustomAttributes = "";
        if (!$this->nama_perusahaan->Raw) {
            $this->nama_perusahaan->CurrentValue = HtmlDecode($this->nama_perusahaan->CurrentValue);
        }
        $this->nama_perusahaan->EditValue = $this->nama_perusahaan->CurrentValue;
        $this->nama_perusahaan->PlaceHolder = RemoveHtml($this->nama_perusahaan->caption());

        // alamat_asuransi
        $this->alamat_asuransi->EditAttrs["class"] = "form-control";
        $this->alamat_asuransi->EditCustomAttributes = "";
        if (!$this->alamat_asuransi->Raw) {
            $this->alamat_asuransi->CurrentValue = HtmlDecode($this->alamat_asuransi->CurrentValue);
        }
        $this->alamat_asuransi->EditValue = $this->alamat_asuransi->CurrentValue;
        $this->alamat_asuransi->PlaceHolder = RemoveHtml($this->alamat_asuransi->caption());

        // no_telp
        $this->no_telp->EditAttrs["class"] = "form-control";
        $this->no_telp->EditCustomAttributes = "";
        if (!$this->no_telp->Raw) {
            $this->no_telp->CurrentValue = HtmlDecode($this->no_telp->CurrentValue);
        }
        $this->no_telp->EditValue = $this->no_telp->CurrentValue;
        $this->no_telp->PlaceHolder = RemoveHtml($this->no_telp->caption());

        // attn
        $this->attn->EditAttrs["class"] = "form-control";
        $this->attn->EditCustomAttributes = "";
        if (!$this->attn->Raw) {
            $this->attn->CurrentValue = HtmlDecode($this->attn->CurrentValue);
        }
        $this->attn->EditValue = $this->attn->CurrentValue;
        $this->attn->PlaceHolder = RemoveHtml($this->attn->caption());

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
                    $doc->exportCaption($this->kd_pj);
                    $doc->exportCaption($this->png_jawab);
                    $doc->exportCaption($this->nama_perusahaan);
                    $doc->exportCaption($this->alamat_asuransi);
                    $doc->exportCaption($this->no_telp);
                    $doc->exportCaption($this->attn);
                    $doc->exportCaption($this->status);
                } else {
                    $doc->exportCaption($this->kd_pj);
                    $doc->exportCaption($this->png_jawab);
                    $doc->exportCaption($this->nama_perusahaan);
                    $doc->exportCaption($this->alamat_asuransi);
                    $doc->exportCaption($this->no_telp);
                    $doc->exportCaption($this->attn);
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
                        $doc->exportField($this->kd_pj);
                        $doc->exportField($this->png_jawab);
                        $doc->exportField($this->nama_perusahaan);
                        $doc->exportField($this->alamat_asuransi);
                        $doc->exportField($this->no_telp);
                        $doc->exportField($this->attn);
                        $doc->exportField($this->status);
                    } else {
                        $doc->exportField($this->kd_pj);
                        $doc->exportField($this->png_jawab);
                        $doc->exportField($this->nama_perusahaan);
                        $doc->exportField($this->alamat_asuransi);
                        $doc->exportField($this->no_telp);
                        $doc->exportField($this->attn);
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
