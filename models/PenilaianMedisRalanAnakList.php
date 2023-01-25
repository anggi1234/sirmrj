<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianMedisRalanAnakList extends PenilaianMedisRalanAnak
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_medis_ralan_anak';

    // Page object name
    public $PageObjName = "PenilaianMedisRalanAnakList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpenilaian_medis_ralan_anaklist";
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

        // Table object (penilaian_medis_ralan_anak)
        if (!isset($GLOBALS["penilaian_medis_ralan_anak"]) || get_class($GLOBALS["penilaian_medis_ralan_anak"]) == PROJECT_NAMESPACE . "penilaian_medis_ralan_anak") {
            $GLOBALS["penilaian_medis_ralan_anak"] = &$this;
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
        $this->AddUrl = "PenilaianMedisRalanAnakAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "PenilaianMedisRalanAnakDelete";
        $this->MultiUpdateUrl = "PenilaianMedisRalanAnakUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penilaian_medis_ralan_anak');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fpenilaian_medis_ralan_anaklistsrch";

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
                $doc = new $class(Container("penilaian_medis_ralan_anak"));
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
            $key .= @$ar['id_penilaian_medis_ralan_anak'];
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
            $this->id_penilaian_medis_ralan_anak->Visible = false;
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
    public $SearchFieldsPerRow = 1; // For extended search
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
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->id_penilaian_medis_ralan_anak->setVisibility();
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->kd_dokter->setVisibility();
        $this->anamnesis->setVisibility();
        $this->hubungan->setVisibility();
        $this->keluhan_utama->Visible = false;
        $this->rps->Visible = false;
        $this->rpd->Visible = false;
        $this->rpk->Visible = false;
        $this->rpo->Visible = false;
        $this->alergi->setVisibility();
        $this->keadaan->setVisibility();
        $this->gcs->setVisibility();
        $this->kesadaran->setVisibility();
        $this->td->setVisibility();
        $this->nadi->setVisibility();
        $this->rr->setVisibility();
        $this->suhu->setVisibility();
        $this->spo->setVisibility();
        $this->bb->setVisibility();
        $this->tb->setVisibility();
        $this->kepala->setVisibility();
        $this->mata->setVisibility();
        $this->gigi->setVisibility();
        $this->tht->setVisibility();
        $this->thoraks->setVisibility();
        $this->abdomen->setVisibility();
        $this->genital->setVisibility();
        $this->ekstremitas->setVisibility();
        $this->kulit->setVisibility();
        $this->ket_fisik->Visible = false;
        $this->ket_lokalis->Visible = false;
        $this->penunjang->Visible = false;
        $this->diagnosis->Visible = false;
        $this->tata->Visible = false;
        $this->konsul->Visible = false;
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

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
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
        $filterList = Concat($filterList, $this->id_penilaian_medis_ralan_anak->AdvancedSearch->toJson(), ","); // Field id_penilaian_medis_ralan_anak
        $filterList = Concat($filterList, $this->no_rawat->AdvancedSearch->toJson(), ","); // Field no_rawat
        $filterList = Concat($filterList, $this->tanggal->AdvancedSearch->toJson(), ","); // Field tanggal
        $filterList = Concat($filterList, $this->kd_dokter->AdvancedSearch->toJson(), ","); // Field kd_dokter
        $filterList = Concat($filterList, $this->anamnesis->AdvancedSearch->toJson(), ","); // Field anamnesis
        $filterList = Concat($filterList, $this->hubungan->AdvancedSearch->toJson(), ","); // Field hubungan
        $filterList = Concat($filterList, $this->keluhan_utama->AdvancedSearch->toJson(), ","); // Field keluhan_utama
        $filterList = Concat($filterList, $this->rps->AdvancedSearch->toJson(), ","); // Field rps
        $filterList = Concat($filterList, $this->rpd->AdvancedSearch->toJson(), ","); // Field rpd
        $filterList = Concat($filterList, $this->rpk->AdvancedSearch->toJson(), ","); // Field rpk
        $filterList = Concat($filterList, $this->rpo->AdvancedSearch->toJson(), ","); // Field rpo
        $filterList = Concat($filterList, $this->alergi->AdvancedSearch->toJson(), ","); // Field alergi
        $filterList = Concat($filterList, $this->keadaan->AdvancedSearch->toJson(), ","); // Field keadaan
        $filterList = Concat($filterList, $this->gcs->AdvancedSearch->toJson(), ","); // Field gcs
        $filterList = Concat($filterList, $this->kesadaran->AdvancedSearch->toJson(), ","); // Field kesadaran
        $filterList = Concat($filterList, $this->td->AdvancedSearch->toJson(), ","); // Field td
        $filterList = Concat($filterList, $this->nadi->AdvancedSearch->toJson(), ","); // Field nadi
        $filterList = Concat($filterList, $this->rr->AdvancedSearch->toJson(), ","); // Field rr
        $filterList = Concat($filterList, $this->suhu->AdvancedSearch->toJson(), ","); // Field suhu
        $filterList = Concat($filterList, $this->spo->AdvancedSearch->toJson(), ","); // Field spo
        $filterList = Concat($filterList, $this->bb->AdvancedSearch->toJson(), ","); // Field bb
        $filterList = Concat($filterList, $this->tb->AdvancedSearch->toJson(), ","); // Field tb
        $filterList = Concat($filterList, $this->kepala->AdvancedSearch->toJson(), ","); // Field kepala
        $filterList = Concat($filterList, $this->mata->AdvancedSearch->toJson(), ","); // Field mata
        $filterList = Concat($filterList, $this->gigi->AdvancedSearch->toJson(), ","); // Field gigi
        $filterList = Concat($filterList, $this->tht->AdvancedSearch->toJson(), ","); // Field tht
        $filterList = Concat($filterList, $this->thoraks->AdvancedSearch->toJson(), ","); // Field thoraks
        $filterList = Concat($filterList, $this->abdomen->AdvancedSearch->toJson(), ","); // Field abdomen
        $filterList = Concat($filterList, $this->genital->AdvancedSearch->toJson(), ","); // Field genital
        $filterList = Concat($filterList, $this->ekstremitas->AdvancedSearch->toJson(), ","); // Field ekstremitas
        $filterList = Concat($filterList, $this->kulit->AdvancedSearch->toJson(), ","); // Field kulit
        $filterList = Concat($filterList, $this->ket_fisik->AdvancedSearch->toJson(), ","); // Field ket_fisik
        $filterList = Concat($filterList, $this->ket_lokalis->AdvancedSearch->toJson(), ","); // Field ket_lokalis
        $filterList = Concat($filterList, $this->penunjang->AdvancedSearch->toJson(), ","); // Field penunjang
        $filterList = Concat($filterList, $this->diagnosis->AdvancedSearch->toJson(), ","); // Field diagnosis
        $filterList = Concat($filterList, $this->tata->AdvancedSearch->toJson(), ","); // Field tata
        $filterList = Concat($filterList, $this->konsul->AdvancedSearch->toJson(), ","); // Field konsul
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fpenilaian_medis_ralan_anaklistsrch", $filters);
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

        // Field id_penilaian_medis_ralan_anak
        $this->id_penilaian_medis_ralan_anak->AdvancedSearch->SearchValue = @$filter["x_id_penilaian_medis_ralan_anak"];
        $this->id_penilaian_medis_ralan_anak->AdvancedSearch->SearchOperator = @$filter["z_id_penilaian_medis_ralan_anak"];
        $this->id_penilaian_medis_ralan_anak->AdvancedSearch->SearchCondition = @$filter["v_id_penilaian_medis_ralan_anak"];
        $this->id_penilaian_medis_ralan_anak->AdvancedSearch->SearchValue2 = @$filter["y_id_penilaian_medis_ralan_anak"];
        $this->id_penilaian_medis_ralan_anak->AdvancedSearch->SearchOperator2 = @$filter["w_id_penilaian_medis_ralan_anak"];
        $this->id_penilaian_medis_ralan_anak->AdvancedSearch->save();

        // Field no_rawat
        $this->no_rawat->AdvancedSearch->SearchValue = @$filter["x_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchOperator = @$filter["z_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchCondition = @$filter["v_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchValue2 = @$filter["y_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchOperator2 = @$filter["w_no_rawat"];
        $this->no_rawat->AdvancedSearch->save();

        // Field tanggal
        $this->tanggal->AdvancedSearch->SearchValue = @$filter["x_tanggal"];
        $this->tanggal->AdvancedSearch->SearchOperator = @$filter["z_tanggal"];
        $this->tanggal->AdvancedSearch->SearchCondition = @$filter["v_tanggal"];
        $this->tanggal->AdvancedSearch->SearchValue2 = @$filter["y_tanggal"];
        $this->tanggal->AdvancedSearch->SearchOperator2 = @$filter["w_tanggal"];
        $this->tanggal->AdvancedSearch->save();

        // Field kd_dokter
        $this->kd_dokter->AdvancedSearch->SearchValue = @$filter["x_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchOperator = @$filter["z_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchCondition = @$filter["v_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchValue2 = @$filter["y_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->SearchOperator2 = @$filter["w_kd_dokter"];
        $this->kd_dokter->AdvancedSearch->save();

        // Field anamnesis
        $this->anamnesis->AdvancedSearch->SearchValue = @$filter["x_anamnesis"];
        $this->anamnesis->AdvancedSearch->SearchOperator = @$filter["z_anamnesis"];
        $this->anamnesis->AdvancedSearch->SearchCondition = @$filter["v_anamnesis"];
        $this->anamnesis->AdvancedSearch->SearchValue2 = @$filter["y_anamnesis"];
        $this->anamnesis->AdvancedSearch->SearchOperator2 = @$filter["w_anamnesis"];
        $this->anamnesis->AdvancedSearch->save();

        // Field hubungan
        $this->hubungan->AdvancedSearch->SearchValue = @$filter["x_hubungan"];
        $this->hubungan->AdvancedSearch->SearchOperator = @$filter["z_hubungan"];
        $this->hubungan->AdvancedSearch->SearchCondition = @$filter["v_hubungan"];
        $this->hubungan->AdvancedSearch->SearchValue2 = @$filter["y_hubungan"];
        $this->hubungan->AdvancedSearch->SearchOperator2 = @$filter["w_hubungan"];
        $this->hubungan->AdvancedSearch->save();

        // Field keluhan_utama
        $this->keluhan_utama->AdvancedSearch->SearchValue = @$filter["x_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchOperator = @$filter["z_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchCondition = @$filter["v_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchValue2 = @$filter["y_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchOperator2 = @$filter["w_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->save();

        // Field rps
        $this->rps->AdvancedSearch->SearchValue = @$filter["x_rps"];
        $this->rps->AdvancedSearch->SearchOperator = @$filter["z_rps"];
        $this->rps->AdvancedSearch->SearchCondition = @$filter["v_rps"];
        $this->rps->AdvancedSearch->SearchValue2 = @$filter["y_rps"];
        $this->rps->AdvancedSearch->SearchOperator2 = @$filter["w_rps"];
        $this->rps->AdvancedSearch->save();

        // Field rpd
        $this->rpd->AdvancedSearch->SearchValue = @$filter["x_rpd"];
        $this->rpd->AdvancedSearch->SearchOperator = @$filter["z_rpd"];
        $this->rpd->AdvancedSearch->SearchCondition = @$filter["v_rpd"];
        $this->rpd->AdvancedSearch->SearchValue2 = @$filter["y_rpd"];
        $this->rpd->AdvancedSearch->SearchOperator2 = @$filter["w_rpd"];
        $this->rpd->AdvancedSearch->save();

        // Field rpk
        $this->rpk->AdvancedSearch->SearchValue = @$filter["x_rpk"];
        $this->rpk->AdvancedSearch->SearchOperator = @$filter["z_rpk"];
        $this->rpk->AdvancedSearch->SearchCondition = @$filter["v_rpk"];
        $this->rpk->AdvancedSearch->SearchValue2 = @$filter["y_rpk"];
        $this->rpk->AdvancedSearch->SearchOperator2 = @$filter["w_rpk"];
        $this->rpk->AdvancedSearch->save();

        // Field rpo
        $this->rpo->AdvancedSearch->SearchValue = @$filter["x_rpo"];
        $this->rpo->AdvancedSearch->SearchOperator = @$filter["z_rpo"];
        $this->rpo->AdvancedSearch->SearchCondition = @$filter["v_rpo"];
        $this->rpo->AdvancedSearch->SearchValue2 = @$filter["y_rpo"];
        $this->rpo->AdvancedSearch->SearchOperator2 = @$filter["w_rpo"];
        $this->rpo->AdvancedSearch->save();

        // Field alergi
        $this->alergi->AdvancedSearch->SearchValue = @$filter["x_alergi"];
        $this->alergi->AdvancedSearch->SearchOperator = @$filter["z_alergi"];
        $this->alergi->AdvancedSearch->SearchCondition = @$filter["v_alergi"];
        $this->alergi->AdvancedSearch->SearchValue2 = @$filter["y_alergi"];
        $this->alergi->AdvancedSearch->SearchOperator2 = @$filter["w_alergi"];
        $this->alergi->AdvancedSearch->save();

        // Field keadaan
        $this->keadaan->AdvancedSearch->SearchValue = @$filter["x_keadaan"];
        $this->keadaan->AdvancedSearch->SearchOperator = @$filter["z_keadaan"];
        $this->keadaan->AdvancedSearch->SearchCondition = @$filter["v_keadaan"];
        $this->keadaan->AdvancedSearch->SearchValue2 = @$filter["y_keadaan"];
        $this->keadaan->AdvancedSearch->SearchOperator2 = @$filter["w_keadaan"];
        $this->keadaan->AdvancedSearch->save();

        // Field gcs
        $this->gcs->AdvancedSearch->SearchValue = @$filter["x_gcs"];
        $this->gcs->AdvancedSearch->SearchOperator = @$filter["z_gcs"];
        $this->gcs->AdvancedSearch->SearchCondition = @$filter["v_gcs"];
        $this->gcs->AdvancedSearch->SearchValue2 = @$filter["y_gcs"];
        $this->gcs->AdvancedSearch->SearchOperator2 = @$filter["w_gcs"];
        $this->gcs->AdvancedSearch->save();

        // Field kesadaran
        $this->kesadaran->AdvancedSearch->SearchValue = @$filter["x_kesadaran"];
        $this->kesadaran->AdvancedSearch->SearchOperator = @$filter["z_kesadaran"];
        $this->kesadaran->AdvancedSearch->SearchCondition = @$filter["v_kesadaran"];
        $this->kesadaran->AdvancedSearch->SearchValue2 = @$filter["y_kesadaran"];
        $this->kesadaran->AdvancedSearch->SearchOperator2 = @$filter["w_kesadaran"];
        $this->kesadaran->AdvancedSearch->save();

        // Field td
        $this->td->AdvancedSearch->SearchValue = @$filter["x_td"];
        $this->td->AdvancedSearch->SearchOperator = @$filter["z_td"];
        $this->td->AdvancedSearch->SearchCondition = @$filter["v_td"];
        $this->td->AdvancedSearch->SearchValue2 = @$filter["y_td"];
        $this->td->AdvancedSearch->SearchOperator2 = @$filter["w_td"];
        $this->td->AdvancedSearch->save();

        // Field nadi
        $this->nadi->AdvancedSearch->SearchValue = @$filter["x_nadi"];
        $this->nadi->AdvancedSearch->SearchOperator = @$filter["z_nadi"];
        $this->nadi->AdvancedSearch->SearchCondition = @$filter["v_nadi"];
        $this->nadi->AdvancedSearch->SearchValue2 = @$filter["y_nadi"];
        $this->nadi->AdvancedSearch->SearchOperator2 = @$filter["w_nadi"];
        $this->nadi->AdvancedSearch->save();

        // Field rr
        $this->rr->AdvancedSearch->SearchValue = @$filter["x_rr"];
        $this->rr->AdvancedSearch->SearchOperator = @$filter["z_rr"];
        $this->rr->AdvancedSearch->SearchCondition = @$filter["v_rr"];
        $this->rr->AdvancedSearch->SearchValue2 = @$filter["y_rr"];
        $this->rr->AdvancedSearch->SearchOperator2 = @$filter["w_rr"];
        $this->rr->AdvancedSearch->save();

        // Field suhu
        $this->suhu->AdvancedSearch->SearchValue = @$filter["x_suhu"];
        $this->suhu->AdvancedSearch->SearchOperator = @$filter["z_suhu"];
        $this->suhu->AdvancedSearch->SearchCondition = @$filter["v_suhu"];
        $this->suhu->AdvancedSearch->SearchValue2 = @$filter["y_suhu"];
        $this->suhu->AdvancedSearch->SearchOperator2 = @$filter["w_suhu"];
        $this->suhu->AdvancedSearch->save();

        // Field spo
        $this->spo->AdvancedSearch->SearchValue = @$filter["x_spo"];
        $this->spo->AdvancedSearch->SearchOperator = @$filter["z_spo"];
        $this->spo->AdvancedSearch->SearchCondition = @$filter["v_spo"];
        $this->spo->AdvancedSearch->SearchValue2 = @$filter["y_spo"];
        $this->spo->AdvancedSearch->SearchOperator2 = @$filter["w_spo"];
        $this->spo->AdvancedSearch->save();

        // Field bb
        $this->bb->AdvancedSearch->SearchValue = @$filter["x_bb"];
        $this->bb->AdvancedSearch->SearchOperator = @$filter["z_bb"];
        $this->bb->AdvancedSearch->SearchCondition = @$filter["v_bb"];
        $this->bb->AdvancedSearch->SearchValue2 = @$filter["y_bb"];
        $this->bb->AdvancedSearch->SearchOperator2 = @$filter["w_bb"];
        $this->bb->AdvancedSearch->save();

        // Field tb
        $this->tb->AdvancedSearch->SearchValue = @$filter["x_tb"];
        $this->tb->AdvancedSearch->SearchOperator = @$filter["z_tb"];
        $this->tb->AdvancedSearch->SearchCondition = @$filter["v_tb"];
        $this->tb->AdvancedSearch->SearchValue2 = @$filter["y_tb"];
        $this->tb->AdvancedSearch->SearchOperator2 = @$filter["w_tb"];
        $this->tb->AdvancedSearch->save();

        // Field kepala
        $this->kepala->AdvancedSearch->SearchValue = @$filter["x_kepala"];
        $this->kepala->AdvancedSearch->SearchOperator = @$filter["z_kepala"];
        $this->kepala->AdvancedSearch->SearchCondition = @$filter["v_kepala"];
        $this->kepala->AdvancedSearch->SearchValue2 = @$filter["y_kepala"];
        $this->kepala->AdvancedSearch->SearchOperator2 = @$filter["w_kepala"];
        $this->kepala->AdvancedSearch->save();

        // Field mata
        $this->mata->AdvancedSearch->SearchValue = @$filter["x_mata"];
        $this->mata->AdvancedSearch->SearchOperator = @$filter["z_mata"];
        $this->mata->AdvancedSearch->SearchCondition = @$filter["v_mata"];
        $this->mata->AdvancedSearch->SearchValue2 = @$filter["y_mata"];
        $this->mata->AdvancedSearch->SearchOperator2 = @$filter["w_mata"];
        $this->mata->AdvancedSearch->save();

        // Field gigi
        $this->gigi->AdvancedSearch->SearchValue = @$filter["x_gigi"];
        $this->gigi->AdvancedSearch->SearchOperator = @$filter["z_gigi"];
        $this->gigi->AdvancedSearch->SearchCondition = @$filter["v_gigi"];
        $this->gigi->AdvancedSearch->SearchValue2 = @$filter["y_gigi"];
        $this->gigi->AdvancedSearch->SearchOperator2 = @$filter["w_gigi"];
        $this->gigi->AdvancedSearch->save();

        // Field tht
        $this->tht->AdvancedSearch->SearchValue = @$filter["x_tht"];
        $this->tht->AdvancedSearch->SearchOperator = @$filter["z_tht"];
        $this->tht->AdvancedSearch->SearchCondition = @$filter["v_tht"];
        $this->tht->AdvancedSearch->SearchValue2 = @$filter["y_tht"];
        $this->tht->AdvancedSearch->SearchOperator2 = @$filter["w_tht"];
        $this->tht->AdvancedSearch->save();

        // Field thoraks
        $this->thoraks->AdvancedSearch->SearchValue = @$filter["x_thoraks"];
        $this->thoraks->AdvancedSearch->SearchOperator = @$filter["z_thoraks"];
        $this->thoraks->AdvancedSearch->SearchCondition = @$filter["v_thoraks"];
        $this->thoraks->AdvancedSearch->SearchValue2 = @$filter["y_thoraks"];
        $this->thoraks->AdvancedSearch->SearchOperator2 = @$filter["w_thoraks"];
        $this->thoraks->AdvancedSearch->save();

        // Field abdomen
        $this->abdomen->AdvancedSearch->SearchValue = @$filter["x_abdomen"];
        $this->abdomen->AdvancedSearch->SearchOperator = @$filter["z_abdomen"];
        $this->abdomen->AdvancedSearch->SearchCondition = @$filter["v_abdomen"];
        $this->abdomen->AdvancedSearch->SearchValue2 = @$filter["y_abdomen"];
        $this->abdomen->AdvancedSearch->SearchOperator2 = @$filter["w_abdomen"];
        $this->abdomen->AdvancedSearch->save();

        // Field genital
        $this->genital->AdvancedSearch->SearchValue = @$filter["x_genital"];
        $this->genital->AdvancedSearch->SearchOperator = @$filter["z_genital"];
        $this->genital->AdvancedSearch->SearchCondition = @$filter["v_genital"];
        $this->genital->AdvancedSearch->SearchValue2 = @$filter["y_genital"];
        $this->genital->AdvancedSearch->SearchOperator2 = @$filter["w_genital"];
        $this->genital->AdvancedSearch->save();

        // Field ekstremitas
        $this->ekstremitas->AdvancedSearch->SearchValue = @$filter["x_ekstremitas"];
        $this->ekstremitas->AdvancedSearch->SearchOperator = @$filter["z_ekstremitas"];
        $this->ekstremitas->AdvancedSearch->SearchCondition = @$filter["v_ekstremitas"];
        $this->ekstremitas->AdvancedSearch->SearchValue2 = @$filter["y_ekstremitas"];
        $this->ekstremitas->AdvancedSearch->SearchOperator2 = @$filter["w_ekstremitas"];
        $this->ekstremitas->AdvancedSearch->save();

        // Field kulit
        $this->kulit->AdvancedSearch->SearchValue = @$filter["x_kulit"];
        $this->kulit->AdvancedSearch->SearchOperator = @$filter["z_kulit"];
        $this->kulit->AdvancedSearch->SearchCondition = @$filter["v_kulit"];
        $this->kulit->AdvancedSearch->SearchValue2 = @$filter["y_kulit"];
        $this->kulit->AdvancedSearch->SearchOperator2 = @$filter["w_kulit"];
        $this->kulit->AdvancedSearch->save();

        // Field ket_fisik
        $this->ket_fisik->AdvancedSearch->SearchValue = @$filter["x_ket_fisik"];
        $this->ket_fisik->AdvancedSearch->SearchOperator = @$filter["z_ket_fisik"];
        $this->ket_fisik->AdvancedSearch->SearchCondition = @$filter["v_ket_fisik"];
        $this->ket_fisik->AdvancedSearch->SearchValue2 = @$filter["y_ket_fisik"];
        $this->ket_fisik->AdvancedSearch->SearchOperator2 = @$filter["w_ket_fisik"];
        $this->ket_fisik->AdvancedSearch->save();

        // Field ket_lokalis
        $this->ket_lokalis->AdvancedSearch->SearchValue = @$filter["x_ket_lokalis"];
        $this->ket_lokalis->AdvancedSearch->SearchOperator = @$filter["z_ket_lokalis"];
        $this->ket_lokalis->AdvancedSearch->SearchCondition = @$filter["v_ket_lokalis"];
        $this->ket_lokalis->AdvancedSearch->SearchValue2 = @$filter["y_ket_lokalis"];
        $this->ket_lokalis->AdvancedSearch->SearchOperator2 = @$filter["w_ket_lokalis"];
        $this->ket_lokalis->AdvancedSearch->save();

        // Field penunjang
        $this->penunjang->AdvancedSearch->SearchValue = @$filter["x_penunjang"];
        $this->penunjang->AdvancedSearch->SearchOperator = @$filter["z_penunjang"];
        $this->penunjang->AdvancedSearch->SearchCondition = @$filter["v_penunjang"];
        $this->penunjang->AdvancedSearch->SearchValue2 = @$filter["y_penunjang"];
        $this->penunjang->AdvancedSearch->SearchOperator2 = @$filter["w_penunjang"];
        $this->penunjang->AdvancedSearch->save();

        // Field diagnosis
        $this->diagnosis->AdvancedSearch->SearchValue = @$filter["x_diagnosis"];
        $this->diagnosis->AdvancedSearch->SearchOperator = @$filter["z_diagnosis"];
        $this->diagnosis->AdvancedSearch->SearchCondition = @$filter["v_diagnosis"];
        $this->diagnosis->AdvancedSearch->SearchValue2 = @$filter["y_diagnosis"];
        $this->diagnosis->AdvancedSearch->SearchOperator2 = @$filter["w_diagnosis"];
        $this->diagnosis->AdvancedSearch->save();

        // Field tata
        $this->tata->AdvancedSearch->SearchValue = @$filter["x_tata"];
        $this->tata->AdvancedSearch->SearchOperator = @$filter["z_tata"];
        $this->tata->AdvancedSearch->SearchCondition = @$filter["v_tata"];
        $this->tata->AdvancedSearch->SearchValue2 = @$filter["y_tata"];
        $this->tata->AdvancedSearch->SearchOperator2 = @$filter["w_tata"];
        $this->tata->AdvancedSearch->save();

        // Field konsul
        $this->konsul->AdvancedSearch->SearchValue = @$filter["x_konsul"];
        $this->konsul->AdvancedSearch->SearchOperator = @$filter["z_konsul"];
        $this->konsul->AdvancedSearch->SearchCondition = @$filter["v_konsul"];
        $this->konsul->AdvancedSearch->SearchValue2 = @$filter["y_konsul"];
        $this->konsul->AdvancedSearch->SearchOperator2 = @$filter["w_konsul"];
        $this->konsul->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->no_rawat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kd_dokter, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->hubungan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->keluhan_utama, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rps, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rpd, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rpk, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rpo, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->alergi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->gcs, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->td, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nadi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rr, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->suhu, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->spo, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->bb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->tb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_fisik, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_lokalis, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->penunjang, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->diagnosis, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->tata, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->konsul, $arKeywords, $type);
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

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->id_penilaian_medis_ralan_anak); // id_penilaian_medis_ralan_anak
            $this->updateSort($this->no_rawat); // no_rawat
            $this->updateSort($this->tanggal); // tanggal
            $this->updateSort($this->kd_dokter); // kd_dokter
            $this->updateSort($this->anamnesis); // anamnesis
            $this->updateSort($this->hubungan); // hubungan
            $this->updateSort($this->alergi); // alergi
            $this->updateSort($this->keadaan); // keadaan
            $this->updateSort($this->gcs); // gcs
            $this->updateSort($this->kesadaran); // kesadaran
            $this->updateSort($this->td); // td
            $this->updateSort($this->nadi); // nadi
            $this->updateSort($this->rr); // rr
            $this->updateSort($this->suhu); // suhu
            $this->updateSort($this->spo); // spo
            $this->updateSort($this->bb); // bb
            $this->updateSort($this->tb); // tb
            $this->updateSort($this->kepala); // kepala
            $this->updateSort($this->mata); // mata
            $this->updateSort($this->gigi); // gigi
            $this->updateSort($this->tht); // tht
            $this->updateSort($this->thoraks); // thoraks
            $this->updateSort($this->abdomen); // abdomen
            $this->updateSort($this->genital); // genital
            $this->updateSort($this->ekstremitas); // ekstremitas
            $this->updateSort($this->kulit); // kulit
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
                $this->id_penilaian_medis_ralan_anak->setSort("");
                $this->no_rawat->setSort("");
                $this->tanggal->setSort("");
                $this->kd_dokter->setSort("");
                $this->anamnesis->setSort("");
                $this->hubungan->setSort("");
                $this->keluhan_utama->setSort("");
                $this->rps->setSort("");
                $this->rpd->setSort("");
                $this->rpk->setSort("");
                $this->rpo->setSort("");
                $this->alergi->setSort("");
                $this->keadaan->setSort("");
                $this->gcs->setSort("");
                $this->kesadaran->setSort("");
                $this->td->setSort("");
                $this->nadi->setSort("");
                $this->rr->setSort("");
                $this->suhu->setSort("");
                $this->spo->setSort("");
                $this->bb->setSort("");
                $this->tb->setSort("");
                $this->kepala->setSort("");
                $this->mata->setSort("");
                $this->gigi->setSort("");
                $this->tht->setSort("");
                $this->thoraks->setSort("");
                $this->abdomen->setSort("");
                $this->genital->setSort("");
                $this->ekstremitas->setSort("");
                $this->kulit->setSort("");
                $this->ket_fisik->setSort("");
                $this->ket_lokalis->setSort("");
                $this->penunjang->setSort("");
                $this->diagnosis->setSort("");
                $this->tata->setSort("");
                $this->konsul->setSort("");
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

        // "copy"
        $item = &$this->ListOptions->add("copy");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canAdd();
        $item->OnLeft = false;

        // "delete"
        $item = &$this->ListOptions->add("delete");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canDelete();
        $item->OnLeft = false;

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

            // "copy"
            $opt = $this->ListOptions["copy"];
            $copycaption = HtmlTitle($Language->phrase("CopyLink"));
            if ($Security->canAdd()) {
                $opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("CopyLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "delete"
            $opt = $this->ListOptions["delete"];
            if ($Security->canDelete()) {
            $opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("DeleteLink") . "</a>";
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

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id_penilaian_medis_ralan_anak->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fpenilaian_medis_ralan_anaklistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpenilaian_medis_ralan_anaklistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fpenilaian_medis_ralan_anaklist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        $this->id_penilaian_medis_ralan_anak->setDbValue($row['id_penilaian_medis_ralan_anak']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tanggal->setDbValue($row['tanggal']);
        $this->kd_dokter->setDbValue($row['kd_dokter']);
        $this->anamnesis->setDbValue($row['anamnesis']);
        $this->hubungan->setDbValue($row['hubungan']);
        $this->keluhan_utama->setDbValue($row['keluhan_utama']);
        $this->rps->setDbValue($row['rps']);
        $this->rpd->setDbValue($row['rpd']);
        $this->rpk->setDbValue($row['rpk']);
        $this->rpo->setDbValue($row['rpo']);
        $this->alergi->setDbValue($row['alergi']);
        $this->keadaan->setDbValue($row['keadaan']);
        $this->gcs->setDbValue($row['gcs']);
        $this->kesadaran->setDbValue($row['kesadaran']);
        $this->td->setDbValue($row['td']);
        $this->nadi->setDbValue($row['nadi']);
        $this->rr->setDbValue($row['rr']);
        $this->suhu->setDbValue($row['suhu']);
        $this->spo->setDbValue($row['spo']);
        $this->bb->setDbValue($row['bb']);
        $this->tb->setDbValue($row['tb']);
        $this->kepala->setDbValue($row['kepala']);
        $this->mata->setDbValue($row['mata']);
        $this->gigi->setDbValue($row['gigi']);
        $this->tht->setDbValue($row['tht']);
        $this->thoraks->setDbValue($row['thoraks']);
        $this->abdomen->setDbValue($row['abdomen']);
        $this->genital->setDbValue($row['genital']);
        $this->ekstremitas->setDbValue($row['ekstremitas']);
        $this->kulit->setDbValue($row['kulit']);
        $this->ket_fisik->setDbValue($row['ket_fisik']);
        $this->ket_lokalis->setDbValue($row['ket_lokalis']);
        $this->penunjang->setDbValue($row['penunjang']);
        $this->diagnosis->setDbValue($row['diagnosis']);
        $this->tata->setDbValue($row['tata']);
        $this->konsul->setDbValue($row['konsul']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_penilaian_medis_ralan_anak'] = null;
        $row['no_rawat'] = null;
        $row['tanggal'] = null;
        $row['kd_dokter'] = null;
        $row['anamnesis'] = null;
        $row['hubungan'] = null;
        $row['keluhan_utama'] = null;
        $row['rps'] = null;
        $row['rpd'] = null;
        $row['rpk'] = null;
        $row['rpo'] = null;
        $row['alergi'] = null;
        $row['keadaan'] = null;
        $row['gcs'] = null;
        $row['kesadaran'] = null;
        $row['td'] = null;
        $row['nadi'] = null;
        $row['rr'] = null;
        $row['suhu'] = null;
        $row['spo'] = null;
        $row['bb'] = null;
        $row['tb'] = null;
        $row['kepala'] = null;
        $row['mata'] = null;
        $row['gigi'] = null;
        $row['tht'] = null;
        $row['thoraks'] = null;
        $row['abdomen'] = null;
        $row['genital'] = null;
        $row['ekstremitas'] = null;
        $row['kulit'] = null;
        $row['ket_fisik'] = null;
        $row['ket_lokalis'] = null;
        $row['penunjang'] = null;
        $row['diagnosis'] = null;
        $row['tata'] = null;
        $row['konsul'] = null;
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

        // id_penilaian_medis_ralan_anak

        // no_rawat

        // tanggal

        // kd_dokter

        // anamnesis

        // hubungan

        // keluhan_utama

        // rps

        // rpd

        // rpk

        // rpo

        // alergi

        // keadaan

        // gcs

        // kesadaran

        // td

        // nadi

        // rr

        // suhu

        // spo

        // bb

        // tb

        // kepala

        // mata

        // gigi

        // tht

        // thoraks

        // abdomen

        // genital

        // ekstremitas

        // kulit

        // ket_fisik

        // ket_lokalis

        // penunjang

        // diagnosis

        // tata

        // konsul
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_penilaian_medis_ralan_anak
            $this->id_penilaian_medis_ralan_anak->ViewValue = $this->id_penilaian_medis_ralan_anak->CurrentValue;
            $this->id_penilaian_medis_ralan_anak->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";

            // tanggal
            $this->tanggal->ViewValue = $this->tanggal->CurrentValue;
            $this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
            $this->tanggal->ViewCustomAttributes = "";

            // kd_dokter
            $this->kd_dokter->ViewValue = $this->kd_dokter->CurrentValue;
            $this->kd_dokter->ViewCustomAttributes = "";

            // anamnesis
            if (strval($this->anamnesis->CurrentValue) != "") {
                $this->anamnesis->ViewValue = $this->anamnesis->optionCaption($this->anamnesis->CurrentValue);
            } else {
                $this->anamnesis->ViewValue = null;
            }
            $this->anamnesis->ViewCustomAttributes = "";

            // hubungan
            $this->hubungan->ViewValue = $this->hubungan->CurrentValue;
            $this->hubungan->ViewCustomAttributes = "";

            // alergi
            $this->alergi->ViewValue = $this->alergi->CurrentValue;
            $this->alergi->ViewCustomAttributes = "";

            // keadaan
            if (strval($this->keadaan->CurrentValue) != "") {
                $this->keadaan->ViewValue = $this->keadaan->optionCaption($this->keadaan->CurrentValue);
            } else {
                $this->keadaan->ViewValue = null;
            }
            $this->keadaan->ViewCustomAttributes = "";

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

            // td
            $this->td->ViewValue = $this->td->CurrentValue;
            $this->td->ViewCustomAttributes = "";

            // nadi
            $this->nadi->ViewValue = $this->nadi->CurrentValue;
            $this->nadi->ViewCustomAttributes = "";

            // rr
            $this->rr->ViewValue = $this->rr->CurrentValue;
            $this->rr->ViewCustomAttributes = "";

            // suhu
            $this->suhu->ViewValue = $this->suhu->CurrentValue;
            $this->suhu->ViewCustomAttributes = "";

            // spo
            $this->spo->ViewValue = $this->spo->CurrentValue;
            $this->spo->ViewCustomAttributes = "";

            // bb
            $this->bb->ViewValue = $this->bb->CurrentValue;
            $this->bb->ViewCustomAttributes = "";

            // tb
            $this->tb->ViewValue = $this->tb->CurrentValue;
            $this->tb->ViewCustomAttributes = "";

            // kepala
            if (strval($this->kepala->CurrentValue) != "") {
                $this->kepala->ViewValue = $this->kepala->optionCaption($this->kepala->CurrentValue);
            } else {
                $this->kepala->ViewValue = null;
            }
            $this->kepala->ViewCustomAttributes = "";

            // mata
            if (strval($this->mata->CurrentValue) != "") {
                $this->mata->ViewValue = $this->mata->optionCaption($this->mata->CurrentValue);
            } else {
                $this->mata->ViewValue = null;
            }
            $this->mata->ViewCustomAttributes = "";

            // gigi
            if (strval($this->gigi->CurrentValue) != "") {
                $this->gigi->ViewValue = $this->gigi->optionCaption($this->gigi->CurrentValue);
            } else {
                $this->gigi->ViewValue = null;
            }
            $this->gigi->ViewCustomAttributes = "";

            // tht
            if (strval($this->tht->CurrentValue) != "") {
                $this->tht->ViewValue = $this->tht->optionCaption($this->tht->CurrentValue);
            } else {
                $this->tht->ViewValue = null;
            }
            $this->tht->ViewCustomAttributes = "";

            // thoraks
            if (strval($this->thoraks->CurrentValue) != "") {
                $this->thoraks->ViewValue = $this->thoraks->optionCaption($this->thoraks->CurrentValue);
            } else {
                $this->thoraks->ViewValue = null;
            }
            $this->thoraks->ViewCustomAttributes = "";

            // abdomen
            if (strval($this->abdomen->CurrentValue) != "") {
                $this->abdomen->ViewValue = $this->abdomen->optionCaption($this->abdomen->CurrentValue);
            } else {
                $this->abdomen->ViewValue = null;
            }
            $this->abdomen->ViewCustomAttributes = "";

            // genital
            if (strval($this->genital->CurrentValue) != "") {
                $this->genital->ViewValue = $this->genital->optionCaption($this->genital->CurrentValue);
            } else {
                $this->genital->ViewValue = null;
            }
            $this->genital->ViewCustomAttributes = "";

            // ekstremitas
            if (strval($this->ekstremitas->CurrentValue) != "") {
                $this->ekstremitas->ViewValue = $this->ekstremitas->optionCaption($this->ekstremitas->CurrentValue);
            } else {
                $this->ekstremitas->ViewValue = null;
            }
            $this->ekstremitas->ViewCustomAttributes = "";

            // kulit
            if (strval($this->kulit->CurrentValue) != "") {
                $this->kulit->ViewValue = $this->kulit->optionCaption($this->kulit->CurrentValue);
            } else {
                $this->kulit->ViewValue = null;
            }
            $this->kulit->ViewCustomAttributes = "";

            // id_penilaian_medis_ralan_anak
            $this->id_penilaian_medis_ralan_anak->LinkCustomAttributes = "";
            $this->id_penilaian_medis_ralan_anak->HrefValue = "";
            $this->id_penilaian_medis_ralan_anak->TooltipValue = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";
            $this->no_rawat->TooltipValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";
            $this->tanggal->TooltipValue = "";

            // kd_dokter
            $this->kd_dokter->LinkCustomAttributes = "";
            $this->kd_dokter->HrefValue = "";
            $this->kd_dokter->TooltipValue = "";

            // anamnesis
            $this->anamnesis->LinkCustomAttributes = "";
            $this->anamnesis->HrefValue = "";
            $this->anamnesis->TooltipValue = "";

            // hubungan
            $this->hubungan->LinkCustomAttributes = "";
            $this->hubungan->HrefValue = "";
            $this->hubungan->TooltipValue = "";

            // alergi
            $this->alergi->LinkCustomAttributes = "";
            $this->alergi->HrefValue = "";
            $this->alergi->TooltipValue = "";

            // keadaan
            $this->keadaan->LinkCustomAttributes = "";
            $this->keadaan->HrefValue = "";
            $this->keadaan->TooltipValue = "";

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";
            $this->gcs->TooltipValue = "";

            // kesadaran
            $this->kesadaran->LinkCustomAttributes = "";
            $this->kesadaran->HrefValue = "";
            $this->kesadaran->TooltipValue = "";

            // td
            $this->td->LinkCustomAttributes = "";
            $this->td->HrefValue = "";
            $this->td->TooltipValue = "";

            // nadi
            $this->nadi->LinkCustomAttributes = "";
            $this->nadi->HrefValue = "";
            $this->nadi->TooltipValue = "";

            // rr
            $this->rr->LinkCustomAttributes = "";
            $this->rr->HrefValue = "";
            $this->rr->TooltipValue = "";

            // suhu
            $this->suhu->LinkCustomAttributes = "";
            $this->suhu->HrefValue = "";
            $this->suhu->TooltipValue = "";

            // spo
            $this->spo->LinkCustomAttributes = "";
            $this->spo->HrefValue = "";
            $this->spo->TooltipValue = "";

            // bb
            $this->bb->LinkCustomAttributes = "";
            $this->bb->HrefValue = "";
            $this->bb->TooltipValue = "";

            // tb
            $this->tb->LinkCustomAttributes = "";
            $this->tb->HrefValue = "";
            $this->tb->TooltipValue = "";

            // kepala
            $this->kepala->LinkCustomAttributes = "";
            $this->kepala->HrefValue = "";
            $this->kepala->TooltipValue = "";

            // mata
            $this->mata->LinkCustomAttributes = "";
            $this->mata->HrefValue = "";
            $this->mata->TooltipValue = "";

            // gigi
            $this->gigi->LinkCustomAttributes = "";
            $this->gigi->HrefValue = "";
            $this->gigi->TooltipValue = "";

            // tht
            $this->tht->LinkCustomAttributes = "";
            $this->tht->HrefValue = "";
            $this->tht->TooltipValue = "";

            // thoraks
            $this->thoraks->LinkCustomAttributes = "";
            $this->thoraks->HrefValue = "";
            $this->thoraks->TooltipValue = "";

            // abdomen
            $this->abdomen->LinkCustomAttributes = "";
            $this->abdomen->HrefValue = "";
            $this->abdomen->TooltipValue = "";

            // genital
            $this->genital->LinkCustomAttributes = "";
            $this->genital->HrefValue = "";
            $this->genital->TooltipValue = "";

            // ekstremitas
            $this->ekstremitas->LinkCustomAttributes = "";
            $this->ekstremitas->HrefValue = "";
            $this->ekstremitas->TooltipValue = "";

            // kulit
            $this->kulit->LinkCustomAttributes = "";
            $this->kulit->HrefValue = "";
            $this->kulit->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpenilaian_medis_ralan_anaklistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
                case "x_anamnesis":
                    break;
                case "x_keadaan":
                    break;
                case "x_kesadaran":
                    break;
                case "x_kepala":
                    break;
                case "x_mata":
                    break;
                case "x_gigi":
                    break;
                case "x_tht":
                    break;
                case "x_thoraks":
                    break;
                case "x_abdomen":
                    break;
                case "x_genital":
                    break;
                case "x_ekstremitas":
                    break;
                case "x_kulit":
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
