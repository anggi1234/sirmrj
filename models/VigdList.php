<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VigdList extends Vigd
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'vigd';

    // Page object name
    public $PageObjName = "VigdList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fvigdlist";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (vigd)
        if (!isset($GLOBALS["vigd"]) || get_class($GLOBALS["vigd"]) == PROJECT_NAMESPACE . "vigd") {
            $GLOBALS["vigd"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Initialize URLs
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->AddUrl = "VigdAdd?" . Config("TABLE_SHOW_DETAIL") . "=";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "VigdDelete";
        $this->MultiUpdateUrl = "VigdUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'vigd');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // List options
        $this->ListOptions = new ListOptions();
        $this->ListOptions->TableVar = $this->TableVar;

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Import options
        $this->ImportOptions = new ListOptions("div");
        $this->ImportOptions->TagClassName = "ew-import-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";

        // Filter options
        $this->FilterOptions = new ListOptions("div");
        $this->FilterOptions->TagClassName = "ew-filter-option fvigdlistsrch";

        // List actions
        $this->ListActions = new ListActions();
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("vigd"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id_reg'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id_reg->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->tgl_registrasi->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->jam_reg->Visible = false;
        }
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "5,10,20,50"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchRowCount = 0; // For extended search
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 2; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $RowAction = ""; // Row action
    public $MultiColumnClass = "col-sm";
    public $MultiColumnEditClass = "w-100";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header

        // Update Export URLs
        if (Config("USE_PHPEXCEL")) {
            $this->ExportExcelCustom = false;
        }
        if (Config("USE_PHPWORD")) {
            $this->ExportWordCustom = false;
        }
        if ($this->ExportExcelCustom) {
            $this->ExportExcelUrl .= "&amp;custom=1";
        }
        if ($this->ExportWordCustom) {
            $this->ExportWordUrl .= "&amp;custom=1";
        }
        if ($this->ExportPdfCustom) {
            $this->ExportPdfUrl .= "&amp;custom=1";
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();
        $this->id_reg->setVisibility();
        $this->no_reg->Visible = false;
        $this->no_rawat->Visible = false;
        $this->tgl_registrasi->setVisibility();
        $this->jam_reg->setVisibility();
        $this->kd_dokter->setVisibility();
        $this->no_rkm_medis->setVisibility();
        $this->kd_poli->setVisibility();
        $this->p_jawab->Visible = false;
        $this->almt_pj->Visible = false;
        $this->hubunganpj->Visible = false;
        $this->biaya_reg->Visible = false;
        $this->stts->setVisibility();
        $this->stts_daftar->Visible = false;
        $this->status_lanjut->setVisibility();
        $this->kd_pj->Visible = false;
        $this->umurdaftar->Visible = false;
        $this->sttsumur->Visible = false;
        $this->status_bayar->Visible = false;
        $this->status_poli->Visible = false;
        $this->cetak->Visible = false;
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Show checkbox column if multiple action
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
                $this->ListOptions["checkbox"]->Visible = true;
                break;
            }
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->no_rkm_medis);
        $this->setupLookupOptions($this->kd_poli);
        $this->setupLookupOptions($this->kd_pj);

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));
            AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Get and validate search values for advanced search
            $this->loadSearchValues(); // Get search values

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }
            if (!$this->validateSearch()) {
                // Nothing to do
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }

            // Get search criteria for advanced search
            if (!$this->hasInvalidFields()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }

            // Load advanced search from default
            if ($this->loadAdvancedSearchDefault()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }

        // Export data only
        if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
            $this->exportData();
            $this->terminate();
            return;
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->id_reg->AdvancedSearch->toJson(), ","); // Field id_reg
        $filterList = Concat($filterList, $this->no_reg->AdvancedSearch->toJson(), ","); // Field no_reg
        $filterList = Concat($filterList, $this->no_rawat->AdvancedSearch->toJson(), ","); // Field no_rawat
        $filterList = Concat($filterList, $this->tgl_registrasi->AdvancedSearch->toJson(), ","); // Field tgl_registrasi
        $filterList = Concat($filterList, $this->jam_reg->AdvancedSearch->toJson(), ","); // Field jam_reg
        $filterList = Concat($filterList, $this->kd_dokter->AdvancedSearch->toJson(), ","); // Field kd_dokter
        $filterList = Concat($filterList, $this->no_rkm_medis->AdvancedSearch->toJson(), ","); // Field no_rkm_medis
        $filterList = Concat($filterList, $this->kd_poli->AdvancedSearch->toJson(), ","); // Field kd_poli
        $filterList = Concat($filterList, $this->p_jawab->AdvancedSearch->toJson(), ","); // Field p_jawab
        $filterList = Concat($filterList, $this->almt_pj->AdvancedSearch->toJson(), ","); // Field almt_pj
        $filterList = Concat($filterList, $this->hubunganpj->AdvancedSearch->toJson(), ","); // Field hubunganpj
        $filterList = Concat($filterList, $this->biaya_reg->AdvancedSearch->toJson(), ","); // Field biaya_reg
        $filterList = Concat($filterList, $this->stts->AdvancedSearch->toJson(), ","); // Field stts
        $filterList = Concat($filterList, $this->stts_daftar->AdvancedSearch->toJson(), ","); // Field stts_daftar
        $filterList = Concat($filterList, $this->status_lanjut->AdvancedSearch->toJson(), ","); // Field status_lanjut
        $filterList = Concat($filterList, $this->kd_pj->AdvancedSearch->toJson(), ","); // Field kd_pj
        $filterList = Concat($filterList, $this->umurdaftar->AdvancedSearch->toJson(), ","); // Field umurdaftar
        $filterList = Concat($filterList, $this->sttsumur->AdvancedSearch->toJson(), ","); // Field sttsumur
        $filterList = Concat($filterList, $this->status_bayar->AdvancedSearch->toJson(), ","); // Field status_bayar
        $filterList = Concat($filterList, $this->status_poli->AdvancedSearch->toJson(), ","); // Field status_poli
        $filterList = Concat($filterList, $this->cetak->AdvancedSearch->toJson(), ","); // Field cetak
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fvigdlistsrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field id_reg
        $this->id_reg->AdvancedSearch->SearchValue = @$filter["x_id_reg"];
        $this->id_reg->AdvancedSearch->SearchOperator = @$filter["z_id_reg"];
        $this->id_reg->AdvancedSearch->SearchCondition = @$filter["v_id_reg"];
        $this->id_reg->AdvancedSearch->SearchValue2 = @$filter["y_id_reg"];
        $this->id_reg->AdvancedSearch->SearchOperator2 = @$filter["w_id_reg"];
        $this->id_reg->AdvancedSearch->save();

        // Field no_reg
        $this->no_reg->AdvancedSearch->SearchValue = @$filter["x_no_reg"];
        $this->no_reg->AdvancedSearch->SearchOperator = @$filter["z_no_reg"];
        $this->no_reg->AdvancedSearch->SearchCondition = @$filter["v_no_reg"];
        $this->no_reg->AdvancedSearch->SearchValue2 = @$filter["y_no_reg"];
        $this->no_reg->AdvancedSearch->SearchOperator2 = @$filter["w_no_reg"];
        $this->no_reg->AdvancedSearch->save();

        // Field no_rawat
        $this->no_rawat->AdvancedSearch->SearchValue = @$filter["x_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchOperator = @$filter["z_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchCondition = @$filter["v_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchValue2 = @$filter["y_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchOperator2 = @$filter["w_no_rawat"];
        $this->no_rawat->AdvancedSearch->save();

        // Field tgl_registrasi
        $this->tgl_registrasi->AdvancedSearch->SearchValue = @$filter["x_tgl_registrasi"];
        $this->tgl_registrasi->AdvancedSearch->SearchOperator = @$filter["z_tgl_registrasi"];
        $this->tgl_registrasi->AdvancedSearch->SearchCondition = @$filter["v_tgl_registrasi"];
        $this->tgl_registrasi->AdvancedSearch->SearchValue2 = @$filter["y_tgl_registrasi"];
        $this->tgl_registrasi->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_registrasi"];
        $this->tgl_registrasi->AdvancedSearch->save();

        // Field jam_reg
        $this->jam_reg->AdvancedSearch->SearchValue = @$filter["x_jam_reg"];
        $this->jam_reg->AdvancedSearch->SearchOperator = @$filter["z_jam_reg"];
        $this->jam_reg->AdvancedSearch->SearchCondition = @$filter["v_jam_reg"];
        $this->jam_reg->AdvancedSearch->SearchValue2 = @$filter["y_jam_reg"];
        $this->jam_reg->AdvancedSearch->SearchOperator2 = @$filter["w_jam_reg"];
        $this->jam_reg->AdvancedSearch->save();

        // Field kd_dokter
        $this->kd_dokter->AdvancedSearch->SearchValue = @$filter["x_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchOperator = @$filter["z_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchCondition = @$filter["v_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchValue2 = @$filter["y_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchOperator2 = @$filter["w_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->save();

        // Field no_rkm_medis
        $this->no_rkm_medis->AdvancedSearch->SearchValue = @$filter["x_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchOperator = @$filter["z_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchCondition = @$filter["v_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchValue2 = @$filter["y_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchOperator2 = @$filter["w_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->save();

        // Field kd_poli
        $this->kd_poli->AdvancedSearch->SearchValue = @$filter["x_kd_poli"];
        $this->kd_poli->AdvancedSearch->SearchOperator = @$filter["z_kd_poli"];
        $this->kd_poli->AdvancedSearch->SearchCondition = @$filter["v_kd_poli"];
        $this->kd_poli->AdvancedSearch->SearchValue2 = @$filter["y_kd_poli"];
        $this->kd_poli->AdvancedSearch->SearchOperator2 = @$filter["w_kd_poli"];
        $this->kd_poli->AdvancedSearch->save();

        // Field p_jawab
        $this->p_jawab->AdvancedSearch->SearchValue = @$filter["x_p_jawab"];
        $this->p_jawab->AdvancedSearch->SearchOperator = @$filter["z_p_jawab"];
        $this->p_jawab->AdvancedSearch->SearchCondition = @$filter["v_p_jawab"];
        $this->p_jawab->AdvancedSearch->SearchValue2 = @$filter["y_p_jawab"];
        $this->p_jawab->AdvancedSearch->SearchOperator2 = @$filter["w_p_jawab"];
        $this->p_jawab->AdvancedSearch->save();

        // Field almt_pj
        $this->almt_pj->AdvancedSearch->SearchValue = @$filter["x_almt_pj"];
        $this->almt_pj->AdvancedSearch->SearchOperator = @$filter["z_almt_pj"];
        $this->almt_pj->AdvancedSearch->SearchCondition = @$filter["v_almt_pj"];
        $this->almt_pj->AdvancedSearch->SearchValue2 = @$filter["y_almt_pj"];
        $this->almt_pj->AdvancedSearch->SearchOperator2 = @$filter["w_almt_pj"];
        $this->almt_pj->AdvancedSearch->save();

        // Field hubunganpj
        $this->hubunganpj->AdvancedSearch->SearchValue = @$filter["x_hubunganpj"];
        $this->hubunganpj->AdvancedSearch->SearchOperator = @$filter["z_hubunganpj"];
        $this->hubunganpj->AdvancedSearch->SearchCondition = @$filter["v_hubunganpj"];
        $this->hubunganpj->AdvancedSearch->SearchValue2 = @$filter["y_hubunganpj"];
        $this->hubunganpj->AdvancedSearch->SearchOperator2 = @$filter["w_hubunganpj"];
        $this->hubunganpj->AdvancedSearch->save();

        // Field biaya_reg
        $this->biaya_reg->AdvancedSearch->SearchValue = @$filter["x_biaya_reg"];
        $this->biaya_reg->AdvancedSearch->SearchOperator = @$filter["z_biaya_reg"];
        $this->biaya_reg->AdvancedSearch->SearchCondition = @$filter["v_biaya_reg"];
        $this->biaya_reg->AdvancedSearch->SearchValue2 = @$filter["y_biaya_reg"];
        $this->biaya_reg->AdvancedSearch->SearchOperator2 = @$filter["w_biaya_reg"];
        $this->biaya_reg->AdvancedSearch->save();

        // Field stts
        $this->stts->AdvancedSearch->SearchValue = @$filter["x_stts"];
        $this->stts->AdvancedSearch->SearchOperator = @$filter["z_stts"];
        $this->stts->AdvancedSearch->SearchCondition = @$filter["v_stts"];
        $this->stts->AdvancedSearch->SearchValue2 = @$filter["y_stts"];
        $this->stts->AdvancedSearch->SearchOperator2 = @$filter["w_stts"];
        $this->stts->AdvancedSearch->save();

        // Field stts_daftar
        $this->stts_daftar->AdvancedSearch->SearchValue = @$filter["x_stts_daftar"];
        $this->stts_daftar->AdvancedSearch->SearchOperator = @$filter["z_stts_daftar"];
        $this->stts_daftar->AdvancedSearch->SearchCondition = @$filter["v_stts_daftar"];
        $this->stts_daftar->AdvancedSearch->SearchValue2 = @$filter["y_stts_daftar"];
        $this->stts_daftar->AdvancedSearch->SearchOperator2 = @$filter["w_stts_daftar"];
        $this->stts_daftar->AdvancedSearch->save();

        // Field status_lanjut
        $this->status_lanjut->AdvancedSearch->SearchValue = @$filter["x_status_lanjut"];
        $this->status_lanjut->AdvancedSearch->SearchOperator = @$filter["z_status_lanjut"];
        $this->status_lanjut->AdvancedSearch->SearchCondition = @$filter["v_status_lanjut"];
        $this->status_lanjut->AdvancedSearch->SearchValue2 = @$filter["y_status_lanjut"];
        $this->status_lanjut->AdvancedSearch->SearchOperator2 = @$filter["w_status_lanjut"];
        $this->status_lanjut->AdvancedSearch->save();

        // Field kd_pj
        $this->kd_pj->AdvancedSearch->SearchValue = @$filter["x_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchOperator = @$filter["z_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchCondition = @$filter["v_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchValue2 = @$filter["y_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchOperator2 = @$filter["w_kd_pj"];
        $this->kd_pj->AdvancedSearch->save();

        // Field umurdaftar
        $this->umurdaftar->AdvancedSearch->SearchValue = @$filter["x_umurdaftar"];
        $this->umurdaftar->AdvancedSearch->SearchOperator = @$filter["z_umurdaftar"];
        $this->umurdaftar->AdvancedSearch->SearchCondition = @$filter["v_umurdaftar"];
        $this->umurdaftar->AdvancedSearch->SearchValue2 = @$filter["y_umurdaftar"];
        $this->umurdaftar->AdvancedSearch->SearchOperator2 = @$filter["w_umurdaftar"];
        $this->umurdaftar->AdvancedSearch->save();

        // Field sttsumur
        $this->sttsumur->AdvancedSearch->SearchValue = @$filter["x_sttsumur"];
        $this->sttsumur->AdvancedSearch->SearchOperator = @$filter["z_sttsumur"];
        $this->sttsumur->AdvancedSearch->SearchCondition = @$filter["v_sttsumur"];
        $this->sttsumur->AdvancedSearch->SearchValue2 = @$filter["y_sttsumur"];
        $this->sttsumur->AdvancedSearch->SearchOperator2 = @$filter["w_sttsumur"];
        $this->sttsumur->AdvancedSearch->save();

        // Field status_bayar
        $this->status_bayar->AdvancedSearch->SearchValue = @$filter["x_status_bayar"];
        $this->status_bayar->AdvancedSearch->SearchOperator = @$filter["z_status_bayar"];
        $this->status_bayar->AdvancedSearch->SearchCondition = @$filter["v_status_bayar"];
        $this->status_bayar->AdvancedSearch->SearchValue2 = @$filter["y_status_bayar"];
        $this->status_bayar->AdvancedSearch->SearchOperator2 = @$filter["w_status_bayar"];
        $this->status_bayar->AdvancedSearch->save();

        // Field status_poli
        $this->status_poli->AdvancedSearch->SearchValue = @$filter["x_status_poli"];
        $this->status_poli->AdvancedSearch->SearchOperator = @$filter["z_status_poli"];
        $this->status_poli->AdvancedSearch->SearchCondition = @$filter["v_status_poli"];
        $this->status_poli->AdvancedSearch->SearchValue2 = @$filter["y_status_poli"];
        $this->status_poli->AdvancedSearch->SearchOperator2 = @$filter["w_status_poli"];
        $this->status_poli->AdvancedSearch->save();

        // Field cetak
        $this->cetak->AdvancedSearch->SearchValue = @$filter["x_cetak"];
        $this->cetak->AdvancedSearch->SearchOperator = @$filter["z_cetak"];
        $this->cetak->AdvancedSearch->SearchCondition = @$filter["v_cetak"];
        $this->cetak->AdvancedSearch->SearchValue2 = @$filter["y_cetak"];
        $this->cetak->AdvancedSearch->SearchOperator2 = @$filter["w_cetak"];
        $this->cetak->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Advanced search WHERE clause based on QueryString
    protected function advancedSearchWhere($default = false)
    {
        global $Security;
        $where = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $this->buildSearchSql($where, $this->id_reg, $default, false); // id_reg
        $this->buildSearchSql($where, $this->no_reg, $default, false); // no_reg
        $this->buildSearchSql($where, $this->no_rawat, $default, false); // no_rawat
        $this->buildSearchSql($where, $this->tgl_registrasi, $default, false); // tgl_registrasi
        $this->buildSearchSql($where, $this->jam_reg, $default, false); // jam_reg
        $this->buildSearchSql($where, $this->kd_dokter, $default, false); // kd_dokter
        $this->buildSearchSql($where, $this->no_rkm_medis, $default, false); // no_rkm_medis
        $this->buildSearchSql($where, $this->kd_poli, $default, false); // kd_poli
        $this->buildSearchSql($where, $this->p_jawab, $default, false); // p_jawab
        $this->buildSearchSql($where, $this->almt_pj, $default, false); // almt_pj
        $this->buildSearchSql($where, $this->hubunganpj, $default, false); // hubunganpj
        $this->buildSearchSql($where, $this->biaya_reg, $default, false); // biaya_reg
        $this->buildSearchSql($where, $this->stts, $default, false); // stts
        $this->buildSearchSql($where, $this->stts_daftar, $default, false); // stts_daftar
        $this->buildSearchSql($where, $this->status_lanjut, $default, false); // status_lanjut
        $this->buildSearchSql($where, $this->kd_pj, $default, false); // kd_pj
        $this->buildSearchSql($where, $this->umurdaftar, $default, false); // umurdaftar
        $this->buildSearchSql($where, $this->sttsumur, $default, false); // sttsumur
        $this->buildSearchSql($where, $this->status_bayar, $default, false); // status_bayar
        $this->buildSearchSql($where, $this->status_poli, $default, false); // status_poli
        $this->buildSearchSql($where, $this->cetak, $default, false); // cetak

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->id_reg->AdvancedSearch->save(); // id_reg
            $this->no_reg->AdvancedSearch->save(); // no_reg
            $this->no_rawat->AdvancedSearch->save(); // no_rawat
            $this->tgl_registrasi->AdvancedSearch->save(); // tgl_registrasi
            $this->jam_reg->AdvancedSearch->save(); // jam_reg
            $this->kd_dokter->AdvancedSearch->save(); // kd_dokter
            $this->no_rkm_medis->AdvancedSearch->save(); // no_rkm_medis
            $this->kd_poli->AdvancedSearch->save(); // kd_poli
            $this->p_jawab->AdvancedSearch->save(); // p_jawab
            $this->almt_pj->AdvancedSearch->save(); // almt_pj
            $this->hubunganpj->AdvancedSearch->save(); // hubunganpj
            $this->biaya_reg->AdvancedSearch->save(); // biaya_reg
            $this->stts->AdvancedSearch->save(); // stts
            $this->stts_daftar->AdvancedSearch->save(); // stts_daftar
            $this->status_lanjut->AdvancedSearch->save(); // status_lanjut
            $this->kd_pj->AdvancedSearch->save(); // kd_pj
            $this->umurdaftar->AdvancedSearch->save(); // umurdaftar
            $this->sttsumur->AdvancedSearch->save(); // sttsumur
            $this->status_bayar->AdvancedSearch->save(); // status_bayar
            $this->status_poli->AdvancedSearch->save(); // status_poli
            $this->cetak->AdvancedSearch->save(); // cetak
        }
        return $where;
    }

    // Build search SQL
    protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
    {
        $fldParm = $fld->Param;
        $fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
        $fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        $fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
        $wrk = "";
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr));
        if ($fldOpr == "") {
            $fldOpr = "=";
        }
        $fldOpr2 = strtoupper(trim($fldOpr2));
        if ($fldOpr2 == "") {
            $fldOpr2 = "=";
        }
        if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr)) {
            $multiValue = false;
        }
        if ($multiValue) {
            $wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
            $wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
            $wrk = $wrk1; // Build final SQL
            if ($wrk2 != "") {
                $wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
            }
        } else {
            $fldVal = $this->convertSearchValue($fld, $fldVal);
            $fldVal2 = $this->convertSearchValue($fld, $fldVal2);
            $wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
        }
        AddFilter($where, $wrk);
    }

    // Convert search value
    protected function convertSearchValue(&$fld, $fldVal)
    {
        if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE")) {
            return $fldVal;
        }
        $value = $fldVal;
        if ($fld->isBoolean()) {
            if ($fldVal != "") {
                $value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
            }
        } elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
            if ($fldVal != "") {
                $value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
            }
        }
        return $value;
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->no_reg, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->no_rawat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kd_dokter, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->no_rkm_medis, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kd_poli, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->p_jawab, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->almt_pj, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->hubunganpj, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kd_pj, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->cetak, $arKeywords, $type);
        return $where;
    }

    // Build basic search SQL
    protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
    {
        $defCond = ($type == "OR") ? "OR" : "AND";
        $arSql = []; // Array for SQL parts
        $arCond = []; // Array for search conditions
        $cnt = count($arKeywords);
        $j = 0; // Number of SQL parts
        for ($i = 0; $i < $cnt; $i++) {
            $keyword = $arKeywords[$i];
            $keyword = trim($keyword);
            if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
                $keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
                $ar = explode("\\", $keyword);
            } else {
                $ar = [$keyword];
            }
            foreach ($ar as $keyword) {
                if ($keyword != "") {
                    $wrk = "";
                    if ($keyword == "OR" && $type == "") {
                        if ($j > 0) {
                            $arCond[$j - 1] = "OR";
                        }
                    } elseif ($keyword == Config("NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NULL";
                    } elseif ($keyword == Config("NOT_NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NOT NULL";
                    } elseif ($fld->IsVirtual && $fld->Visible) {
                        $wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    } elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
                        $wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    }
                    if ($wrk != "") {
                        $arSql[$j] = $wrk;
                        $arCond[$j] = $defCond;
                        $j += 1;
                    }
                }
            }
        }
        $cnt = count($arSql);
        $quoted = false;
        $sql = "";
        if ($cnt > 0) {
            for ($i = 0; $i < $cnt - 1; $i++) {
                if ($arCond[$i] == "OR") {
                    if (!$quoted) {
                        $sql .= "(";
                    }
                    $quoted = true;
                }
                $sql .= $arSql[$i];
                if ($quoted && $arCond[$i] != "OR") {
                    $sql .= ")";
                    $quoted = false;
                }
                $sql .= " " . $arCond[$i] . " ";
            }
            $sql .= $arSql[$cnt - 1];
            if ($quoted) {
                $sql .= ")";
            }
        }
        if ($sql != "") {
            if ($where != "") {
                $where .= " OR ";
            }
            $where .= "(" . $sql . ")";
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            // Search keyword in any fields
            if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
                foreach ($ar as $keyword) {
                    if ($keyword != "") {
                        if ($searchStr != "") {
                            $searchStr .= " " . $searchType . " ";
                        }
                        $searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
                    }
                }
            } else {
                $searchStr = $this->basicSearchSql($ar, $searchType);
            }
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        if ($this->id_reg->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_reg->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_rawat->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tgl_registrasi->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->jam_reg->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_dokter->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_rkm_medis->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_poli->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->p_jawab->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->almt_pj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->hubunganpj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->biaya_reg->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->stts->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->stts_daftar->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->status_lanjut->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_pj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->umurdaftar->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sttsumur->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->status_bayar->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->status_poli->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->cetak->AdvancedSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();

        // Clear advanced search parameters
        $this->resetAdvancedSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Clear all advanced search parameters
    protected function resetAdvancedSearchParms()
    {
                $this->id_reg->AdvancedSearch->unsetSession();
                $this->no_reg->AdvancedSearch->unsetSession();
                $this->no_rawat->AdvancedSearch->unsetSession();
                $this->tgl_registrasi->AdvancedSearch->unsetSession();
                $this->jam_reg->AdvancedSearch->unsetSession();
                $this->kd_dokter->AdvancedSearch->unsetSession();
                $this->no_rkm_medis->AdvancedSearch->unsetSession();
                $this->kd_poli->AdvancedSearch->unsetSession();
                $this->p_jawab->AdvancedSearch->unsetSession();
                $this->almt_pj->AdvancedSearch->unsetSession();
                $this->hubunganpj->AdvancedSearch->unsetSession();
                $this->biaya_reg->AdvancedSearch->unsetSession();
                $this->stts->AdvancedSearch->unsetSession();
                $this->stts_daftar->AdvancedSearch->unsetSession();
                $this->status_lanjut->AdvancedSearch->unsetSession();
                $this->kd_pj->AdvancedSearch->unsetSession();
                $this->umurdaftar->AdvancedSearch->unsetSession();
                $this->sttsumur->AdvancedSearch->unsetSession();
                $this->status_bayar->AdvancedSearch->unsetSession();
                $this->status_poli->AdvancedSearch->unsetSession();
                $this->cetak->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
                $this->id_reg->AdvancedSearch->load();
                $this->no_reg->AdvancedSearch->load();
                $this->no_rawat->AdvancedSearch->load();
                $this->tgl_registrasi->AdvancedSearch->load();
                $this->jam_reg->AdvancedSearch->load();
                $this->kd_dokter->AdvancedSearch->load();
                $this->no_rkm_medis->AdvancedSearch->load();
                $this->kd_poli->AdvancedSearch->load();
                $this->p_jawab->AdvancedSearch->load();
                $this->almt_pj->AdvancedSearch->load();
                $this->hubunganpj->AdvancedSearch->load();
                $this->biaya_reg->AdvancedSearch->load();
                $this->stts->AdvancedSearch->load();
                $this->stts_daftar->AdvancedSearch->load();
                $this->status_lanjut->AdvancedSearch->load();
                $this->kd_pj->AdvancedSearch->load();
                $this->umurdaftar->AdvancedSearch->load();
                $this->sttsumur->AdvancedSearch->load();
                $this->status_bayar->AdvancedSearch->load();
                $this->status_poli->AdvancedSearch->load();
                $this->cetak->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->id_reg); // id_reg
            $this->updateSort($this->tgl_registrasi); // tgl_registrasi
            $this->updateSort($this->jam_reg); // jam_reg
            $this->updateSort($this->kd_dokter); // kd_dokter
            $this->updateSort($this->no_rkm_medis); // no_rkm_medis
            $this->updateSort($this->kd_poli); // kd_poli
            $this->updateSort($this->stts); // stts
            $this->updateSort($this->status_lanjut); // status_lanjut
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
            }
        }
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->id_reg->setSort("");
                $this->no_reg->setSort("");
                $this->no_rawat->setSort("");
                $this->tgl_registrasi->setSort("");
                $this->jam_reg->setSort("");
                $this->kd_dokter->setSort("");
                $this->no_rkm_medis->setSort("");
                $this->kd_poli->setSort("");
                $this->p_jawab->setSort("");
                $this->almt_pj->setSort("");
                $this->hubunganpj->setSort("");
                $this->biaya_reg->setSort("");
                $this->stts->setSort("");
                $this->stts_daftar->setSort("");
                $this->status_lanjut->setSort("");
                $this->kd_pj->setSort("");
                $this->umurdaftar->setSort("");
                $this->sttsumur->setSort("");
                $this->status_bayar->setSort("");
                $this->status_poli->setSort("");
                $this->cetak->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item
        $item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
        $item->Body = "";
        $item->OnLeft = false;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = false;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = false;

        // "detail_penilaian_awal_keperawatan_ralan"
        $item = &$this->ListOptions->add("detail_penilaian_awal_keperawatan_ralan");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'penilaian_awal_keperawatan_ralan') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_catatan_medis"
        $item = &$this->ListOptions->add("detail_catatan_medis");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'catatan_medis') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_penilaian_medis_ralan"
        $item = &$this->ListOptions->add("detail_penilaian_medis_ralan");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'penilaian_medis_ralan') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_penilaian_awal_keperawatan_ralan_psikiatri"
        $item = &$this->ListOptions->add("detail_penilaian_awal_keperawatan_ralan_psikiatri");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'penilaian_awal_keperawatan_ralan_psikiatri') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_penilaian_psikologi"
        $item = &$this->ListOptions->add("detail_penilaian_psikologi");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'penilaian_psikologi') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_diagnosa_pasien"
        $item = &$this->ListOptions->add("detail_diagnosa_pasien");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'diagnosa_pasien') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_tindak_lanjut"
        $item = &$this->ListOptions->add("detail_tindak_lanjut");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'tindak_lanjut') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_pemeriksaan_ralan"
        $item = &$this->ListOptions->add("detail_pemeriksaan_ralan");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'pemeriksaan_ralan') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // "detail_vhistory"
        $item = &$this->ListOptions->add("detail_vhistory");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'vhistory') && !$this->ShowMultipleDetails;
        $item->OnLeft = false;
        $item->ShowInButtonGroup = false;

        // Multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$this->ListOptions->add("details");
            $item->CssClass = "text-nowrap";
            $item->Visible = $this->ShowMultipleDetails;
            $item->OnLeft = false;
            $item->ShowInButtonGroup = false;
        }

        // Set up detail pages
        $pages = new SubPages();
        $pages->add("penilaian_awal_keperawatan_ralan");
        $pages->add("catatan_medis");
        $pages->add("penilaian_medis_ralan");
        $pages->add("penilaian_awal_keperawatan_ralan_psikiatri");
        $pages->add("penilaian_psikologi");
        $pages->add("diagnosa_pasien");
        $pages->add("tindak_lanjut");
        $pages->add("pemeriksaan_ralan");
        $pages->add("vhistory");
        $this->DetailPages = $pages;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = false;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = false;
        $item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl();
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
                    $action = $listaction->Action;
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a></li>";
                    if (count($links) == 1) { // Single button
                        $body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a>";
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
                $opt->Visible = true;
            }
        }
        $detailViewTblVar = "";
        $detailCopyTblVar = "";
        $detailEditTblVar = "";

        // "detail_penilaian_awal_keperawatan_ralan"
        $opt = $this->ListOptions["detail_penilaian_awal_keperawatan_ralan"];
        if ($Security->allowList(CurrentProjectID() . 'penilaian_awal_keperawatan_ralan')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("penilaian_awal_keperawatan_ralan", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PenilaianAwalKeperawatanRalanList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PenilaianAwalKeperawatanRalanGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "penilaian_awal_keperawatan_ralan";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "penilaian_awal_keperawatan_ralan";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_catatan_medis"
        $opt = $this->ListOptions["detail_catatan_medis"];
        if ($Security->allowList(CurrentProjectID() . 'catatan_medis')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("catatan_medis", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("CatatanMedisList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("CatatanMedisGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=catatan_medis");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "catatan_medis";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=catatan_medis");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "catatan_medis";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_penilaian_medis_ralan"
        $opt = $this->ListOptions["detail_penilaian_medis_ralan"];
        if ($Security->allowList(CurrentProjectID() . 'penilaian_medis_ralan')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("penilaian_medis_ralan", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PenilaianMedisRalanList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PenilaianMedisRalanGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_medis_ralan");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "penilaian_medis_ralan";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_medis_ralan");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "penilaian_medis_ralan";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_penilaian_awal_keperawatan_ralan_psikiatri"
        $opt = $this->ListOptions["detail_penilaian_awal_keperawatan_ralan_psikiatri"];
        if ($Security->allowList(CurrentProjectID() . 'penilaian_awal_keperawatan_ralan_psikiatri')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("penilaian_awal_keperawatan_ralan_psikiatri", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PenilaianAwalKeperawatanRalanPsikiatriList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PenilaianAwalKeperawatanRalanPsikiatriGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan_psikiatri");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "penilaian_awal_keperawatan_ralan_psikiatri";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan_psikiatri");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "penilaian_awal_keperawatan_ralan_psikiatri";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_penilaian_psikologi"
        $opt = $this->ListOptions["detail_penilaian_psikologi"];
        if ($Security->allowList(CurrentProjectID() . 'penilaian_psikologi')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("penilaian_psikologi", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PenilaianPsikologiList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PenilaianPsikologiGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_psikologi");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "penilaian_psikologi";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_psikologi");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "penilaian_psikologi";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_diagnosa_pasien"
        $opt = $this->ListOptions["detail_diagnosa_pasien"];
        if ($Security->allowList(CurrentProjectID() . 'diagnosa_pasien')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("diagnosa_pasien", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("DiagnosaPasienList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("DiagnosaPasienGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=diagnosa_pasien");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "diagnosa_pasien";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=diagnosa_pasien");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "diagnosa_pasien";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_tindak_lanjut"
        $opt = $this->ListOptions["detail_tindak_lanjut"];
        if ($Security->allowList(CurrentProjectID() . 'tindak_lanjut')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("tindak_lanjut", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("TindakLanjutList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("TindakLanjutGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=tindak_lanjut");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "tindak_lanjut";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=tindak_lanjut");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "tindak_lanjut";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_pemeriksaan_ralan"
        $opt = $this->ListOptions["detail_pemeriksaan_ralan"];
        if ($Security->allowList(CurrentProjectID() . 'pemeriksaan_ralan')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("pemeriksaan_ralan", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PemeriksaanRalanList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PemeriksaanRalanGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=pemeriksaan_ralan");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "pemeriksaan_ralan";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=pemeriksaan_ralan");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "pemeriksaan_ralan";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_vhistory"
        $opt = $this->ListOptions["detail_vhistory"];
        if ($Security->allowList(CurrentProjectID() . 'vhistory')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("vhistory", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("VhistoryList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_no_rkm_medis", $this->no_rkm_medis->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("VhistoryGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=vhistory");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "vhistory";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=vhistory");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "vhistory";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }
        if ($this->ShowMultipleDetails) {
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
            $links = "";
            if ($detailViewTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
            }
            if ($detailEditTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
            }
            if ($detailCopyTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
                $body .= "<ul class=\"dropdown-menu ew-menu\">" . $links . "</ul>";
            }
            $body .= "</div>";
            // Multiple details
            $opt = $this->ListOptions["details"];
            $opt->Body = $body;
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id_reg->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["detail"];
        $detailTableLink = "";
                $item = &$option->add("detailadd_penilaian_awal_keperawatan_ralan");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan");
                $detailPage = Container("PenilaianAwalKeperawatanRalanGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "penilaian_awal_keperawatan_ralan";
                }
                $item = &$option->add("detailadd_catatan_medis");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=catatan_medis");
                $detailPage = Container("CatatanMedisGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "catatan_medis";
                }
                $item = &$option->add("detailadd_penilaian_medis_ralan");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_medis_ralan");
                $detailPage = Container("PenilaianMedisRalanGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "penilaian_medis_ralan";
                }
                $item = &$option->add("detailadd_penilaian_awal_keperawatan_ralan_psikiatri");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan_psikiatri");
                $detailPage = Container("PenilaianAwalKeperawatanRalanPsikiatriGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "penilaian_awal_keperawatan_ralan_psikiatri";
                }
                $item = &$option->add("detailadd_penilaian_psikologi");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_psikologi");
                $detailPage = Container("PenilaianPsikologiGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "penilaian_psikologi";
                }
                $item = &$option->add("detailadd_diagnosa_pasien");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=diagnosa_pasien");
                $detailPage = Container("DiagnosaPasienGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "diagnosa_pasien";
                }
                $item = &$option->add("detailadd_tindak_lanjut");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=tindak_lanjut");
                $detailPage = Container("TindakLanjutGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "tindak_lanjut";
                }
                $item = &$option->add("detailadd_pemeriksaan_ralan");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=pemeriksaan_ralan");
                $detailPage = Container("PemeriksaanRalanGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "pemeriksaan_ralan";
                }
                $item = &$option->add("detailadd_vhistory");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=vhistory");
                $detailPage = Container("VhistoryGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vigd') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "vhistory";
                }

        // Add multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$option->add("detailsadd");
            $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
            $caption = $Language->phrase("AddMasterDetailLink");
            $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
            $item->Visible = $detailTableLink != "" && $Security->canAdd();
            // Hide single master/detail items
            $ar = explode(",", $detailTableLink);
            $cnt = count($ar);
            for ($i = 0; $i < $cnt; $i++) {
                if ($item = $option["detailadd_" . $ar[$i]]) {
                    $item->Visible = false;
                }
            }
        }
        $option = $options["action"];

        // Set up options default
        foreach ($options as $option) {
            $option->UseDropDownButton = false;
            $option->UseButtonGroup = true;
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->add($option->GroupOptionName);
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fvigdlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fvigdlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fvigdlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn, \PDO::FETCH_ASSOC);
            $this->CurrentAction = $userAction;

            // Call row action event
            if ($rs) {
                $conn->beginTransaction();
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    $conn->commit(); // Commit the changes
                    if ($this->getSuccessMessage() == "" && !ob_get_length()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    $conn->rollback(); // Rollback changes

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            $this->CurrentAction = ""; // Clear action
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
        // Hide detail items for dropdown if necessary
        $this->ListOptions->hideDetailItemsForDropDown();
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
        global $Security, $Language;
        $links = "";
        $btngrps = "";
        $sqlwrk = "`no_rawat`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_penilaian_awal_keperawatan_ralan"
        if ($this->DetailPages && $this->DetailPages["penilaian_awal_keperawatan_ralan"] && $this->DetailPages["penilaian_awal_keperawatan_ralan"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_penilaian_awal_keperawatan_ralan"];
            $url = "PenilaianAwalKeperawatanRalanPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"penilaian_awal_keperawatan_ralan\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("penilaian_awal_keperawatan_ralan", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"penilaian_awal_keperawatan_ralan\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("PenilaianAwalKeperawatanRalanList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("penilaian_awal_keperawatan_ralan", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("PenilaianAwalKeperawatanRalanGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "`no_reg`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_catatan_medis"
        if ($this->DetailPages && $this->DetailPages["catatan_medis"] && $this->DetailPages["catatan_medis"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_catatan_medis"];
            $url = "CatatanMedisPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"catatan_medis\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("catatan_medis", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"catatan_medis\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("CatatanMedisList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("catatan_medis", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("CatatanMedisGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=catatan_medis");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=catatan_medis");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "`no_rawat`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_penilaian_medis_ralan"
        if ($this->DetailPages && $this->DetailPages["penilaian_medis_ralan"] && $this->DetailPages["penilaian_medis_ralan"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_penilaian_medis_ralan"];
            $url = "PenilaianMedisRalanPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"penilaian_medis_ralan\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("penilaian_medis_ralan", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"penilaian_medis_ralan\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("PenilaianMedisRalanList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("penilaian_medis_ralan", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("PenilaianMedisRalanGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_medis_ralan");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_medis_ralan");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "`no_rawat`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_penilaian_awal_keperawatan_ralan_psikiatri"
        if ($this->DetailPages && $this->DetailPages["penilaian_awal_keperawatan_ralan_psikiatri"] && $this->DetailPages["penilaian_awal_keperawatan_ralan_psikiatri"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_penilaian_awal_keperawatan_ralan_psikiatri"];
            $url = "PenilaianAwalKeperawatanRalanPsikiatriPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"penilaian_awal_keperawatan_ralan_psikiatri\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("penilaian_awal_keperawatan_ralan_psikiatri", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"penilaian_awal_keperawatan_ralan_psikiatri\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("PenilaianAwalKeperawatanRalanPsikiatriList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("penilaian_awal_keperawatan_ralan_psikiatri", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("PenilaianAwalKeperawatanRalanPsikiatriGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan_psikiatri");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_awal_keperawatan_ralan_psikiatri");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "`no_rawat`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_penilaian_psikologi"
        if ($this->DetailPages && $this->DetailPages["penilaian_psikologi"] && $this->DetailPages["penilaian_psikologi"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_penilaian_psikologi"];
            $url = "PenilaianPsikologiPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"penilaian_psikologi\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("penilaian_psikologi", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"penilaian_psikologi\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("PenilaianPsikologiList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("penilaian_psikologi", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("PenilaianPsikologiGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_psikologi");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=penilaian_psikologi");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "`no_rawat`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_diagnosa_pasien"
        if ($this->DetailPages && $this->DetailPages["diagnosa_pasien"] && $this->DetailPages["diagnosa_pasien"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_diagnosa_pasien"];
            $url = "DiagnosaPasienPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"diagnosa_pasien\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("diagnosa_pasien", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"diagnosa_pasien\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("DiagnosaPasienList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("diagnosa_pasien", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("DiagnosaPasienGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=diagnosa_pasien");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=diagnosa_pasien");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "`no_reg`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_tindak_lanjut"
        if ($this->DetailPages && $this->DetailPages["tindak_lanjut"] && $this->DetailPages["tindak_lanjut"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_tindak_lanjut"];
            $url = "TindakLanjutPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"tindak_lanjut\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("tindak_lanjut", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"tindak_lanjut\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("TindakLanjutList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("tindak_lanjut", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("TindakLanjutGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=tindak_lanjut");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=tindak_lanjut");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "`no_rawat`='" . AdjustSql($this->id_reg->CurrentValue, $this->Dbid) . "'";

        // Column "detail_pemeriksaan_ralan"
        if ($this->DetailPages && $this->DetailPages["pemeriksaan_ralan"] && $this->DetailPages["pemeriksaan_ralan"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_pemeriksaan_ralan"];
            $url = "PemeriksaanRalanPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"pemeriksaan_ralan\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("pemeriksaan_ralan", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"pemeriksaan_ralan\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("PemeriksaanRalanList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_id_reg", $this->id_reg->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("pemeriksaan_ralan", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("PemeriksaanRalanGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=pemeriksaan_ralan");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=pemeriksaan_ralan");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }
        $sqlwrk = "pasien_kunjungan.no_rkm_medis='" . AdjustSql($this->no_rkm_medis->CurrentValue, $this->Dbid) . "'";

        // Column "detail_vhistory"
        if ($this->DetailPages && $this->DetailPages["vhistory"] && $this->DetailPages["vhistory"]->Visible) {
            $link = "";
            $option = $this->ListOptions["detail_vhistory"];
            $url = "VhistoryPreview?t=vigd&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"vhistory\" data-url=\"" . $url . "\">";
            if ($Security->allowList(CurrentProjectID() . 'vigd')) {
                $label = $Language->TablePhrase("vhistory", "TblCaption");
                $link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"vhistory\" data-url=\"" . $url . "\">" . $label . "</a></li>";
                $links .= $link;
                $detaillnk = JsEncodeAttribute("VhistoryList?" . Config("TABLE_SHOW_MASTER") . "=vigd&" . GetForeignKeyUrl("fk_no_rkm_medis", $this->no_rkm_medis->CurrentValue) . "");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("vhistory", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
            }
            $detailPageObj = Container("VhistoryGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=vhistory");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vigd')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=vhistory");
                $btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $btngrps .= $btngrp;
                $option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
            }
        }

        // Hide detail items if necessary
        $this->ListOptions->hideDetailItemsForDropDown();

        // Column "preview"
        $option = $this->ListOptions["preview"];
        if (!$option) { // Add preview column
            $option = &$this->ListOptions->add("preview");
            $option->OnLeft = false;
            if ($option->OnLeft) {
                $option->moveTo($this->ListOptions->itemPos("checkbox") + 1);
            } else {
                $option->moveTo($this->ListOptions->itemPos("checkbox"));
            }
            $option->Visible = !($this->isExport() || $this->isGridAdd() || $this->isGridEdit());
            $option->ShowInDropDown = false;
            $option->ShowInButtonGroup = false;
        }
        if ($option) {
            $option->Body = "<i class=\"ew-preview-row-btn ew-icon icon-expand\"></i>";
            $option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
            if ($option->Visible) {
                $option->Visible = $links != "";
            }
        }

        // Column "details" (Multiple details)
        $option = $this->ListOptions["details"];
        if ($option) {
            $option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
            if ($option->Visible) {
                $option->Visible = $links != "";
            }
        }
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // id_reg
        if (!$this->isAddOrEdit() && $this->id_reg->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_reg->AdvancedSearch->SearchValue != "" || $this->id_reg->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // no_reg
        if (!$this->isAddOrEdit() && $this->no_reg->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_reg->AdvancedSearch->SearchValue != "" || $this->no_reg->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // no_rawat
        if (!$this->isAddOrEdit() && $this->no_rawat->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_rawat->AdvancedSearch->SearchValue != "" || $this->no_rawat->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tgl_registrasi
        if (!$this->isAddOrEdit() && $this->tgl_registrasi->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tgl_registrasi->AdvancedSearch->SearchValue != "" || $this->tgl_registrasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // jam_reg
        if (!$this->isAddOrEdit() && $this->jam_reg->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->jam_reg->AdvancedSearch->SearchValue != "" || $this->jam_reg->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kd_dokter
        if (!$this->isAddOrEdit() && $this->kd_dokter->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kd_dokter->AdvancedSearch->SearchValue != "" || $this->kd_dokter->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // no_rkm_medis
        if (!$this->isAddOrEdit() && $this->no_rkm_medis->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_rkm_medis->AdvancedSearch->SearchValue != "" || $this->no_rkm_medis->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kd_poli
        if (!$this->isAddOrEdit() && $this->kd_poli->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kd_poli->AdvancedSearch->SearchValue != "" || $this->kd_poli->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // p_jawab
        if (!$this->isAddOrEdit() && $this->p_jawab->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->p_jawab->AdvancedSearch->SearchValue != "" || $this->p_jawab->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // almt_pj
        if (!$this->isAddOrEdit() && $this->almt_pj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->almt_pj->AdvancedSearch->SearchValue != "" || $this->almt_pj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // hubunganpj
        if (!$this->isAddOrEdit() && $this->hubunganpj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->hubunganpj->AdvancedSearch->SearchValue != "" || $this->hubunganpj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // biaya_reg
        if (!$this->isAddOrEdit() && $this->biaya_reg->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->biaya_reg->AdvancedSearch->SearchValue != "" || $this->biaya_reg->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // stts
        if (!$this->isAddOrEdit() && $this->stts->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->stts->AdvancedSearch->SearchValue != "" || $this->stts->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // stts_daftar
        if (!$this->isAddOrEdit() && $this->stts_daftar->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->stts_daftar->AdvancedSearch->SearchValue != "" || $this->stts_daftar->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // status_lanjut
        if (!$this->isAddOrEdit() && $this->status_lanjut->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->status_lanjut->AdvancedSearch->SearchValue != "" || $this->status_lanjut->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kd_pj
        if (!$this->isAddOrEdit() && $this->kd_pj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kd_pj->AdvancedSearch->SearchValue != "" || $this->kd_pj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // umurdaftar
        if (!$this->isAddOrEdit() && $this->umurdaftar->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->umurdaftar->AdvancedSearch->SearchValue != "" || $this->umurdaftar->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sttsumur
        if (!$this->isAddOrEdit() && $this->sttsumur->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sttsumur->AdvancedSearch->SearchValue != "" || $this->sttsumur->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // status_bayar
        if (!$this->isAddOrEdit() && $this->status_bayar->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->status_bayar->AdvancedSearch->SearchValue != "" || $this->status_bayar->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // status_poli
        if (!$this->isAddOrEdit() && $this->status_poli->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->status_poli->AdvancedSearch->SearchValue != "" || $this->status_poli->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // cetak
        if (!$this->isAddOrEdit() && $this->cetak->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->cetak->AdvancedSearch->SearchValue != "" || $this->cetak->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        return $hasValue;
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $stmt = $sql->execute();
        $rs = new Recordset($stmt, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
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

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_reg'] = null;
        $row['no_reg'] = null;
        $row['no_rawat'] = null;
        $row['tgl_registrasi'] = null;
        $row['jam_reg'] = null;
        $row['kd_dokter'] = null;
        $row['no_rkm_medis'] = null;
        $row['kd_poli'] = null;
        $row['p_jawab'] = null;
        $row['almt_pj'] = null;
        $row['hubunganpj'] = null;
        $row['biaya_reg'] = null;
        $row['stts'] = null;
        $row['stts_daftar'] = null;
        $row['status_lanjut'] = null;
        $row['kd_pj'] = null;
        $row['umurdaftar'] = null;
        $row['sttsumur'] = null;
        $row['status_bayar'] = null;
        $row['status_poli'] = null;
        $row['cetak'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

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
        if ($this->RowType == ROWTYPE_VIEW) {
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

            // stts
            $this->stts->LinkCustomAttributes = "";
            $this->stts->HrefValue = "";
            $this->stts->TooltipValue = "";

            // status_lanjut
            $this->status_lanjut->LinkCustomAttributes = "";
            $this->status_lanjut->HrefValue = "";
            $this->status_lanjut->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // id_reg
            $this->id_reg->EditAttrs["class"] = "form-control";
            $this->id_reg->EditCustomAttributes = "";
            $this->id_reg->EditValue = HtmlEncode($this->id_reg->AdvancedSearch->SearchValue);
            $this->id_reg->PlaceHolder = RemoveHtml($this->id_reg->caption());

            // tgl_registrasi
            $this->tgl_registrasi->EditAttrs["class"] = "form-control";
            $this->tgl_registrasi->EditCustomAttributes = "";
            $this->tgl_registrasi->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_registrasi->AdvancedSearch->SearchValue, 7), 7));
            $this->tgl_registrasi->PlaceHolder = RemoveHtml($this->tgl_registrasi->caption());

            // jam_reg
            $this->jam_reg->EditAttrs["class"] = "form-control";
            $this->jam_reg->EditCustomAttributes = "";
            $this->jam_reg->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->jam_reg->AdvancedSearch->SearchValue, 4), 4));
            $this->jam_reg->PlaceHolder = RemoveHtml($this->jam_reg->caption());

            // kd_dokter
            $this->kd_dokter->EditAttrs["class"] = "form-control";
            $this->kd_dokter->EditCustomAttributes = "";
            $this->kd_dokter->EditValue = $this->kd_dokter->options(true);
            $this->kd_dokter->PlaceHolder = RemoveHtml($this->kd_dokter->caption());

            // no_rkm_medis
            $this->no_rkm_medis->EditAttrs["class"] = "form-control";
            $this->no_rkm_medis->EditCustomAttributes = "";
            $this->no_rkm_medis->PlaceHolder = RemoveHtml($this->no_rkm_medis->caption());

            // kd_poli
            $this->kd_poli->EditAttrs["class"] = "form-control";
            $this->kd_poli->EditCustomAttributes = "";
            $curVal = trim(strval($this->kd_poli->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->kd_poli->AdvancedSearch->ViewValue = $this->kd_poli->lookupCacheOption($curVal);
            } else {
                $this->kd_poli->AdvancedSearch->ViewValue = $this->kd_poli->Lookup !== null && is_array($this->kd_poli->Lookup->Options) ? $curVal : null;
            }
            if ($this->kd_poli->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->kd_poli->EditValue = array_values($this->kd_poli->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kd_poli`" . SearchString("=", $this->kd_poli->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "`status`='1'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->kd_poli->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kd_poli->EditValue = $arwrk;
            }
            $this->kd_poli->PlaceHolder = RemoveHtml($this->kd_poli->caption());

            // stts
            $this->stts->EditAttrs["class"] = "form-control";
            $this->stts->EditCustomAttributes = "";
            $this->stts->EditValue = $this->stts->options(true);
            $this->stts->PlaceHolder = RemoveHtml($this->stts->caption());

            // status_lanjut
            $this->status_lanjut->EditAttrs["class"] = "form-control";
            $this->status_lanjut->EditCustomAttributes = "";
            $this->status_lanjut->EditValue = $this->status_lanjut->options(true);
            $this->status_lanjut->PlaceHolder = RemoveHtml($this->status_lanjut->caption());
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if (!CheckEuroDate($this->tgl_registrasi->AdvancedSearch->SearchValue)) {
            $this->tgl_registrasi->addErrorMessage($this->tgl_registrasi->getErrorMessage(false));
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->id_reg->AdvancedSearch->load();
        $this->no_reg->AdvancedSearch->load();
        $this->no_rawat->AdvancedSearch->load();
        $this->tgl_registrasi->AdvancedSearch->load();
        $this->jam_reg->AdvancedSearch->load();
        $this->kd_dokter->AdvancedSearch->load();
        $this->no_rkm_medis->AdvancedSearch->load();
        $this->kd_poli->AdvancedSearch->load();
        $this->p_jawab->AdvancedSearch->load();
        $this->almt_pj->AdvancedSearch->load();
        $this->hubunganpj->AdvancedSearch->load();
        $this->biaya_reg->AdvancedSearch->load();
        $this->stts->AdvancedSearch->load();
        $this->stts_daftar->AdvancedSearch->load();
        $this->status_lanjut->AdvancedSearch->load();
        $this->kd_pj->AdvancedSearch->load();
        $this->umurdaftar->AdvancedSearch->load();
        $this->sttsumur->AdvancedSearch->load();
        $this->status_bayar->AdvancedSearch->load();
        $this->status_poli->AdvancedSearch->load();
        $this->cetak->AdvancedSearch->load();
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fvigdlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fvigdlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fvigdlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ",url:'" . $pageUrl . "export=email&amp;custom=1'" : "";
            return '<button id="emf_vigd" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_vigd\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fvigdlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = false;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to Html
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to Xml
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to Csv
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = false;

        // Export to Pdf
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = true;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = false;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions("div");
        $this->SearchOptions->TagClassName = "ew-search-option";

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fvigdlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    /**
    * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    *
    * @param bool $return Return the data rather than output it
    * @return mixed
    */
    public function exportData($return = false)
    {
        global $Language;
        $utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");

        // Load recordset
        $this->TotalRecords = $this->listRecordCount();
        $this->StartRecord = 1;

        // Export all
        if ($this->ExportAll) {
            if (Config("EXPORT_ALL_TIME_LIMIT") >= 0) {
                @set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
            }
            $this->DisplayRecords = $this->TotalRecords;
            $this->StopRecord = $this->TotalRecords;
        } else { // Export one page only
            $this->setupStartRecord(); // Set up start record position
            // Set the last record to display
            if ($this->DisplayRecords <= 0) {
                $this->StopRecord = $this->TotalRecords;
            } else {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            }
        }
        $rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
        $this->ExportDoc = GetExportDocument($this, "h");
        $doc = &$this->ExportDoc;
        if (!$doc) {
            $this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
        }
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $this->ExportDoc->ExportCustom = !$this->pageExporting();
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Close recordset
        $rs->close();

        // Call Page Exported server event
        $this->pageExported();

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Clean output buffer (without destroying output buffer)
        $buffer = ob_get_contents(); // Save the output buffer
        if (!Config("DEBUG") && $buffer) {
            ob_clean();
        }

        // Write debug message if enabled
        if (Config("DEBUG") && !$this->isExport("pdf")) {
            echo GetDebugMessage();
        }

        // Output data
        if ($this->isExport("email")) {
            // Export-to-email disabled
        } else {
            $doc->export();
            if ($return) {
                RemoveHeader("Content-Type"); // Remove header
                RemoveHeader("Content-Disposition");
                $content = ob_get_contents();
                if ($content) {
                    ob_clean();
                }
                if ($buffer) {
                    echo $buffer; // Resume the output buffer
                }
                return $content;
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_kd_dokter":
                    break;
                case "x_no_rkm_medis":
                    break;
                case "x_kd_poli":
                    $lookupFilter = function () {
                        return "`status`='1'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_stts":
                    break;
                case "x_stts_daftar":
                    break;
                case "x_status_lanjut":
                    break;
                case "x_kd_pj":
                    break;
                case "x_sttsumur":
                    break;
                case "x_status_bayar":
                    break;
                case "x_status_poli":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
