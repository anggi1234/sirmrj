<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MasterPasienList extends MasterPasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'master_pasien';

    // Page object name
    public $PageObjName = "MasterPasienList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fmaster_pasienlist";
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

        // Table object (master_pasien)
        if (!isset($GLOBALS["master_pasien"]) || get_class($GLOBALS["master_pasien"]) == PROJECT_NAMESPACE . "master_pasien") {
            $GLOBALS["master_pasien"] = &$this;
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
        $this->AddUrl = "MasterPasienAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "MasterPasienDelete";
        $this->MultiUpdateUrl = "MasterPasienUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'master_pasien');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fmaster_pasienlistsrch";

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
                $doc = new $class(Container("master_pasien"));
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
            $key .= @$ar['id_pasien'];
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
            $this->id_pasien->Visible = false;
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
        $this->id_pasien->setVisibility();
        $this->nama_pasien->setVisibility();
        $this->no_rekam_medis->setVisibility();
        $this->nik->setVisibility();
        $this->no_identitas_lain->setVisibility();
        $this->nama_ibu->setVisibility();
        $this->tempat_lahir->setVisibility();
        $this->tanggal_lahir->setVisibility();
        $this->jenis_kelamin->setVisibility();
        $this->agama->setVisibility();
        $this->suku->setVisibility();
        $this->bahasa->setVisibility();
        $this->alamat->setVisibility();
        $this->rt->setVisibility();
        $this->rw->setVisibility();
        $this->keluarahan_desa->setVisibility();
        $this->kecamatan->setVisibility();
        $this->kabupaten_kota->setVisibility();
        $this->kodepos->setVisibility();
        $this->provinsi->setVisibility();
        $this->negara->setVisibility();
        $this->alamat_domisili->setVisibility();
        $this->rt_domisili->setVisibility();
        $this->rw_domisili->setVisibility();
        $this->kel_desa_domisili->setVisibility();
        $this->kec_domisili->setVisibility();
        $this->kota_kab_domisili->setVisibility();
        $this->kodepos_domisili->setVisibility();
        $this->prov_domisili->setVisibility();
        $this->negara_domisili->setVisibility();
        $this->no_telp->setVisibility();
        $this->no_hp->setVisibility();
        $this->pendidikan->setVisibility();
        $this->pekerjaan->setVisibility();
        $this->status_kawin->setVisibility();
        $this->tgl_daftar->setVisibility();
        $this->_username->setVisibility();
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
        $filterList = Concat($filterList, $this->id_pasien->AdvancedSearch->toJson(), ","); // Field id_pasien
        $filterList = Concat($filterList, $this->nama_pasien->AdvancedSearch->toJson(), ","); // Field nama_pasien
        $filterList = Concat($filterList, $this->no_rekam_medis->AdvancedSearch->toJson(), ","); // Field no_rekam_medis
        $filterList = Concat($filterList, $this->nik->AdvancedSearch->toJson(), ","); // Field nik
        $filterList = Concat($filterList, $this->no_identitas_lain->AdvancedSearch->toJson(), ","); // Field no_identitas_lain
        $filterList = Concat($filterList, $this->nama_ibu->AdvancedSearch->toJson(), ","); // Field nama_ibu
        $filterList = Concat($filterList, $this->tempat_lahir->AdvancedSearch->toJson(), ","); // Field tempat_lahir
        $filterList = Concat($filterList, $this->tanggal_lahir->AdvancedSearch->toJson(), ","); // Field tanggal_lahir
        $filterList = Concat($filterList, $this->jenis_kelamin->AdvancedSearch->toJson(), ","); // Field jenis_kelamin
        $filterList = Concat($filterList, $this->agama->AdvancedSearch->toJson(), ","); // Field agama
        $filterList = Concat($filterList, $this->suku->AdvancedSearch->toJson(), ","); // Field suku
        $filterList = Concat($filterList, $this->bahasa->AdvancedSearch->toJson(), ","); // Field bahasa
        $filterList = Concat($filterList, $this->alamat->AdvancedSearch->toJson(), ","); // Field alamat
        $filterList = Concat($filterList, $this->rt->AdvancedSearch->toJson(), ","); // Field rt
        $filterList = Concat($filterList, $this->rw->AdvancedSearch->toJson(), ","); // Field rw
        $filterList = Concat($filterList, $this->keluarahan_desa->AdvancedSearch->toJson(), ","); // Field keluarahan_desa
        $filterList = Concat($filterList, $this->kecamatan->AdvancedSearch->toJson(), ","); // Field kecamatan
        $filterList = Concat($filterList, $this->kabupaten_kota->AdvancedSearch->toJson(), ","); // Field kabupaten_kota
        $filterList = Concat($filterList, $this->kodepos->AdvancedSearch->toJson(), ","); // Field kodepos
        $filterList = Concat($filterList, $this->provinsi->AdvancedSearch->toJson(), ","); // Field provinsi
        $filterList = Concat($filterList, $this->negara->AdvancedSearch->toJson(), ","); // Field negara
        $filterList = Concat($filterList, $this->alamat_domisili->AdvancedSearch->toJson(), ","); // Field alamat_domisili
        $filterList = Concat($filterList, $this->rt_domisili->AdvancedSearch->toJson(), ","); // Field rt_domisili
        $filterList = Concat($filterList, $this->rw_domisili->AdvancedSearch->toJson(), ","); // Field rw_domisili
        $filterList = Concat($filterList, $this->kel_desa_domisili->AdvancedSearch->toJson(), ","); // Field kel_desa_domisili
        $filterList = Concat($filterList, $this->kec_domisili->AdvancedSearch->toJson(), ","); // Field kec_domisili
        $filterList = Concat($filterList, $this->kota_kab_domisili->AdvancedSearch->toJson(), ","); // Field kota_kab_domisili
        $filterList = Concat($filterList, $this->kodepos_domisili->AdvancedSearch->toJson(), ","); // Field kodepos_domisili
        $filterList = Concat($filterList, $this->prov_domisili->AdvancedSearch->toJson(), ","); // Field prov_domisili
        $filterList = Concat($filterList, $this->negara_domisili->AdvancedSearch->toJson(), ","); // Field negara_domisili
        $filterList = Concat($filterList, $this->no_telp->AdvancedSearch->toJson(), ","); // Field no_telp
        $filterList = Concat($filterList, $this->no_hp->AdvancedSearch->toJson(), ","); // Field no_hp
        $filterList = Concat($filterList, $this->pendidikan->AdvancedSearch->toJson(), ","); // Field pendidikan
        $filterList = Concat($filterList, $this->pekerjaan->AdvancedSearch->toJson(), ","); // Field pekerjaan
        $filterList = Concat($filterList, $this->status_kawin->AdvancedSearch->toJson(), ","); // Field status_kawin
        $filterList = Concat($filterList, $this->tgl_daftar->AdvancedSearch->toJson(), ","); // Field tgl_daftar
        $filterList = Concat($filterList, $this->_username->AdvancedSearch->toJson(), ","); // Field username
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fmaster_pasienlistsrch", $filters);
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

        // Field id_pasien
        $this->id_pasien->AdvancedSearch->SearchValue = @$filter["x_id_pasien"];
        $this->id_pasien->AdvancedSearch->SearchOperator = @$filter["z_id_pasien"];
        $this->id_pasien->AdvancedSearch->SearchCondition = @$filter["v_id_pasien"];
        $this->id_pasien->AdvancedSearch->SearchValue2 = @$filter["y_id_pasien"];
        $this->id_pasien->AdvancedSearch->SearchOperator2 = @$filter["w_id_pasien"];
        $this->id_pasien->AdvancedSearch->save();

        // Field nama_pasien
        $this->nama_pasien->AdvancedSearch->SearchValue = @$filter["x_nama_pasien"];
        $this->nama_pasien->AdvancedSearch->SearchOperator = @$filter["z_nama_pasien"];
        $this->nama_pasien->AdvancedSearch->SearchCondition = @$filter["v_nama_pasien"];
        $this->nama_pasien->AdvancedSearch->SearchValue2 = @$filter["y_nama_pasien"];
        $this->nama_pasien->AdvancedSearch->SearchOperator2 = @$filter["w_nama_pasien"];
        $this->nama_pasien->AdvancedSearch->save();

        // Field no_rekam_medis
        $this->no_rekam_medis->AdvancedSearch->SearchValue = @$filter["x_no_rekam_medis"];
        $this->no_rekam_medis->AdvancedSearch->SearchOperator = @$filter["z_no_rekam_medis"];
        $this->no_rekam_medis->AdvancedSearch->SearchCondition = @$filter["v_no_rekam_medis"];
        $this->no_rekam_medis->AdvancedSearch->SearchValue2 = @$filter["y_no_rekam_medis"];
        $this->no_rekam_medis->AdvancedSearch->SearchOperator2 = @$filter["w_no_rekam_medis"];
        $this->no_rekam_medis->AdvancedSearch->save();

        // Field nik
        $this->nik->AdvancedSearch->SearchValue = @$filter["x_nik"];
        $this->nik->AdvancedSearch->SearchOperator = @$filter["z_nik"];
        $this->nik->AdvancedSearch->SearchCondition = @$filter["v_nik"];
        $this->nik->AdvancedSearch->SearchValue2 = @$filter["y_nik"];
        $this->nik->AdvancedSearch->SearchOperator2 = @$filter["w_nik"];
        $this->nik->AdvancedSearch->save();

        // Field no_identitas_lain
        $this->no_identitas_lain->AdvancedSearch->SearchValue = @$filter["x_no_identitas_lain"];
        $this->no_identitas_lain->AdvancedSearch->SearchOperator = @$filter["z_no_identitas_lain"];
        $this->no_identitas_lain->AdvancedSearch->SearchCondition = @$filter["v_no_identitas_lain"];
        $this->no_identitas_lain->AdvancedSearch->SearchValue2 = @$filter["y_no_identitas_lain"];
        $this->no_identitas_lain->AdvancedSearch->SearchOperator2 = @$filter["w_no_identitas_lain"];
        $this->no_identitas_lain->AdvancedSearch->save();

        // Field nama_ibu
        $this->nama_ibu->AdvancedSearch->SearchValue = @$filter["x_nama_ibu"];
        $this->nama_ibu->AdvancedSearch->SearchOperator = @$filter["z_nama_ibu"];
        $this->nama_ibu->AdvancedSearch->SearchCondition = @$filter["v_nama_ibu"];
        $this->nama_ibu->AdvancedSearch->SearchValue2 = @$filter["y_nama_ibu"];
        $this->nama_ibu->AdvancedSearch->SearchOperator2 = @$filter["w_nama_ibu"];
        $this->nama_ibu->AdvancedSearch->save();

        // Field tempat_lahir
        $this->tempat_lahir->AdvancedSearch->SearchValue = @$filter["x_tempat_lahir"];
        $this->tempat_lahir->AdvancedSearch->SearchOperator = @$filter["z_tempat_lahir"];
        $this->tempat_lahir->AdvancedSearch->SearchCondition = @$filter["v_tempat_lahir"];
        $this->tempat_lahir->AdvancedSearch->SearchValue2 = @$filter["y_tempat_lahir"];
        $this->tempat_lahir->AdvancedSearch->SearchOperator2 = @$filter["w_tempat_lahir"];
        $this->tempat_lahir->AdvancedSearch->save();

        // Field tanggal_lahir
        $this->tanggal_lahir->AdvancedSearch->SearchValue = @$filter["x_tanggal_lahir"];
        $this->tanggal_lahir->AdvancedSearch->SearchOperator = @$filter["z_tanggal_lahir"];
        $this->tanggal_lahir->AdvancedSearch->SearchCondition = @$filter["v_tanggal_lahir"];
        $this->tanggal_lahir->AdvancedSearch->SearchValue2 = @$filter["y_tanggal_lahir"];
        $this->tanggal_lahir->AdvancedSearch->SearchOperator2 = @$filter["w_tanggal_lahir"];
        $this->tanggal_lahir->AdvancedSearch->save();

        // Field jenis_kelamin
        $this->jenis_kelamin->AdvancedSearch->SearchValue = @$filter["x_jenis_kelamin"];
        $this->jenis_kelamin->AdvancedSearch->SearchOperator = @$filter["z_jenis_kelamin"];
        $this->jenis_kelamin->AdvancedSearch->SearchCondition = @$filter["v_jenis_kelamin"];
        $this->jenis_kelamin->AdvancedSearch->SearchValue2 = @$filter["y_jenis_kelamin"];
        $this->jenis_kelamin->AdvancedSearch->SearchOperator2 = @$filter["w_jenis_kelamin"];
        $this->jenis_kelamin->AdvancedSearch->save();

        // Field agama
        $this->agama->AdvancedSearch->SearchValue = @$filter["x_agama"];
        $this->agama->AdvancedSearch->SearchOperator = @$filter["z_agama"];
        $this->agama->AdvancedSearch->SearchCondition = @$filter["v_agama"];
        $this->agama->AdvancedSearch->SearchValue2 = @$filter["y_agama"];
        $this->agama->AdvancedSearch->SearchOperator2 = @$filter["w_agama"];
        $this->agama->AdvancedSearch->save();

        // Field suku
        $this->suku->AdvancedSearch->SearchValue = @$filter["x_suku"];
        $this->suku->AdvancedSearch->SearchOperator = @$filter["z_suku"];
        $this->suku->AdvancedSearch->SearchCondition = @$filter["v_suku"];
        $this->suku->AdvancedSearch->SearchValue2 = @$filter["y_suku"];
        $this->suku->AdvancedSearch->SearchOperator2 = @$filter["w_suku"];
        $this->suku->AdvancedSearch->save();

        // Field bahasa
        $this->bahasa->AdvancedSearch->SearchValue = @$filter["x_bahasa"];
        $this->bahasa->AdvancedSearch->SearchOperator = @$filter["z_bahasa"];
        $this->bahasa->AdvancedSearch->SearchCondition = @$filter["v_bahasa"];
        $this->bahasa->AdvancedSearch->SearchValue2 = @$filter["y_bahasa"];
        $this->bahasa->AdvancedSearch->SearchOperator2 = @$filter["w_bahasa"];
        $this->bahasa->AdvancedSearch->save();

        // Field alamat
        $this->alamat->AdvancedSearch->SearchValue = @$filter["x_alamat"];
        $this->alamat->AdvancedSearch->SearchOperator = @$filter["z_alamat"];
        $this->alamat->AdvancedSearch->SearchCondition = @$filter["v_alamat"];
        $this->alamat->AdvancedSearch->SearchValue2 = @$filter["y_alamat"];
        $this->alamat->AdvancedSearch->SearchOperator2 = @$filter["w_alamat"];
        $this->alamat->AdvancedSearch->save();

        // Field rt
        $this->rt->AdvancedSearch->SearchValue = @$filter["x_rt"];
        $this->rt->AdvancedSearch->SearchOperator = @$filter["z_rt"];
        $this->rt->AdvancedSearch->SearchCondition = @$filter["v_rt"];
        $this->rt->AdvancedSearch->SearchValue2 = @$filter["y_rt"];
        $this->rt->AdvancedSearch->SearchOperator2 = @$filter["w_rt"];
        $this->rt->AdvancedSearch->save();

        // Field rw
        $this->rw->AdvancedSearch->SearchValue = @$filter["x_rw"];
        $this->rw->AdvancedSearch->SearchOperator = @$filter["z_rw"];
        $this->rw->AdvancedSearch->SearchCondition = @$filter["v_rw"];
        $this->rw->AdvancedSearch->SearchValue2 = @$filter["y_rw"];
        $this->rw->AdvancedSearch->SearchOperator2 = @$filter["w_rw"];
        $this->rw->AdvancedSearch->save();

        // Field keluarahan_desa
        $this->keluarahan_desa->AdvancedSearch->SearchValue = @$filter["x_keluarahan_desa"];
        $this->keluarahan_desa->AdvancedSearch->SearchOperator = @$filter["z_keluarahan_desa"];
        $this->keluarahan_desa->AdvancedSearch->SearchCondition = @$filter["v_keluarahan_desa"];
        $this->keluarahan_desa->AdvancedSearch->SearchValue2 = @$filter["y_keluarahan_desa"];
        $this->keluarahan_desa->AdvancedSearch->SearchOperator2 = @$filter["w_keluarahan_desa"];
        $this->keluarahan_desa->AdvancedSearch->save();

        // Field kecamatan
        $this->kecamatan->AdvancedSearch->SearchValue = @$filter["x_kecamatan"];
        $this->kecamatan->AdvancedSearch->SearchOperator = @$filter["z_kecamatan"];
        $this->kecamatan->AdvancedSearch->SearchCondition = @$filter["v_kecamatan"];
        $this->kecamatan->AdvancedSearch->SearchValue2 = @$filter["y_kecamatan"];
        $this->kecamatan->AdvancedSearch->SearchOperator2 = @$filter["w_kecamatan"];
        $this->kecamatan->AdvancedSearch->save();

        // Field kabupaten_kota
        $this->kabupaten_kota->AdvancedSearch->SearchValue = @$filter["x_kabupaten_kota"];
        $this->kabupaten_kota->AdvancedSearch->SearchOperator = @$filter["z_kabupaten_kota"];
        $this->kabupaten_kota->AdvancedSearch->SearchCondition = @$filter["v_kabupaten_kota"];
        $this->kabupaten_kota->AdvancedSearch->SearchValue2 = @$filter["y_kabupaten_kota"];
        $this->kabupaten_kota->AdvancedSearch->SearchOperator2 = @$filter["w_kabupaten_kota"];
        $this->kabupaten_kota->AdvancedSearch->save();

        // Field kodepos
        $this->kodepos->AdvancedSearch->SearchValue = @$filter["x_kodepos"];
        $this->kodepos->AdvancedSearch->SearchOperator = @$filter["z_kodepos"];
        $this->kodepos->AdvancedSearch->SearchCondition = @$filter["v_kodepos"];
        $this->kodepos->AdvancedSearch->SearchValue2 = @$filter["y_kodepos"];
        $this->kodepos->AdvancedSearch->SearchOperator2 = @$filter["w_kodepos"];
        $this->kodepos->AdvancedSearch->save();

        // Field provinsi
        $this->provinsi->AdvancedSearch->SearchValue = @$filter["x_provinsi"];
        $this->provinsi->AdvancedSearch->SearchOperator = @$filter["z_provinsi"];
        $this->provinsi->AdvancedSearch->SearchCondition = @$filter["v_provinsi"];
        $this->provinsi->AdvancedSearch->SearchValue2 = @$filter["y_provinsi"];
        $this->provinsi->AdvancedSearch->SearchOperator2 = @$filter["w_provinsi"];
        $this->provinsi->AdvancedSearch->save();

        // Field negara
        $this->negara->AdvancedSearch->SearchValue = @$filter["x_negara"];
        $this->negara->AdvancedSearch->SearchOperator = @$filter["z_negara"];
        $this->negara->AdvancedSearch->SearchCondition = @$filter["v_negara"];
        $this->negara->AdvancedSearch->SearchValue2 = @$filter["y_negara"];
        $this->negara->AdvancedSearch->SearchOperator2 = @$filter["w_negara"];
        $this->negara->AdvancedSearch->save();

        // Field alamat_domisili
        $this->alamat_domisili->AdvancedSearch->SearchValue = @$filter["x_alamat_domisili"];
        $this->alamat_domisili->AdvancedSearch->SearchOperator = @$filter["z_alamat_domisili"];
        $this->alamat_domisili->AdvancedSearch->SearchCondition = @$filter["v_alamat_domisili"];
        $this->alamat_domisili->AdvancedSearch->SearchValue2 = @$filter["y_alamat_domisili"];
        $this->alamat_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_alamat_domisili"];
        $this->alamat_domisili->AdvancedSearch->save();

        // Field rt_domisili
        $this->rt_domisili->AdvancedSearch->SearchValue = @$filter["x_rt_domisili"];
        $this->rt_domisili->AdvancedSearch->SearchOperator = @$filter["z_rt_domisili"];
        $this->rt_domisili->AdvancedSearch->SearchCondition = @$filter["v_rt_domisili"];
        $this->rt_domisili->AdvancedSearch->SearchValue2 = @$filter["y_rt_domisili"];
        $this->rt_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_rt_domisili"];
        $this->rt_domisili->AdvancedSearch->save();

        // Field rw_domisili
        $this->rw_domisili->AdvancedSearch->SearchValue = @$filter["x_rw_domisili"];
        $this->rw_domisili->AdvancedSearch->SearchOperator = @$filter["z_rw_domisili"];
        $this->rw_domisili->AdvancedSearch->SearchCondition = @$filter["v_rw_domisili"];
        $this->rw_domisili->AdvancedSearch->SearchValue2 = @$filter["y_rw_domisili"];
        $this->rw_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_rw_domisili"];
        $this->rw_domisili->AdvancedSearch->save();

        // Field kel_desa_domisili
        $this->kel_desa_domisili->AdvancedSearch->SearchValue = @$filter["x_kel_desa_domisili"];
        $this->kel_desa_domisili->AdvancedSearch->SearchOperator = @$filter["z_kel_desa_domisili"];
        $this->kel_desa_domisili->AdvancedSearch->SearchCondition = @$filter["v_kel_desa_domisili"];
        $this->kel_desa_domisili->AdvancedSearch->SearchValue2 = @$filter["y_kel_desa_domisili"];
        $this->kel_desa_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_kel_desa_domisili"];
        $this->kel_desa_domisili->AdvancedSearch->save();

        // Field kec_domisili
        $this->kec_domisili->AdvancedSearch->SearchValue = @$filter["x_kec_domisili"];
        $this->kec_domisili->AdvancedSearch->SearchOperator = @$filter["z_kec_domisili"];
        $this->kec_domisili->AdvancedSearch->SearchCondition = @$filter["v_kec_domisili"];
        $this->kec_domisili->AdvancedSearch->SearchValue2 = @$filter["y_kec_domisili"];
        $this->kec_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_kec_domisili"];
        $this->kec_domisili->AdvancedSearch->save();

        // Field kota_kab_domisili
        $this->kota_kab_domisili->AdvancedSearch->SearchValue = @$filter["x_kota_kab_domisili"];
        $this->kota_kab_domisili->AdvancedSearch->SearchOperator = @$filter["z_kota_kab_domisili"];
        $this->kota_kab_domisili->AdvancedSearch->SearchCondition = @$filter["v_kota_kab_domisili"];
        $this->kota_kab_domisili->AdvancedSearch->SearchValue2 = @$filter["y_kota_kab_domisili"];
        $this->kota_kab_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_kota_kab_domisili"];
        $this->kota_kab_domisili->AdvancedSearch->save();

        // Field kodepos_domisili
        $this->kodepos_domisili->AdvancedSearch->SearchValue = @$filter["x_kodepos_domisili"];
        $this->kodepos_domisili->AdvancedSearch->SearchOperator = @$filter["z_kodepos_domisili"];
        $this->kodepos_domisili->AdvancedSearch->SearchCondition = @$filter["v_kodepos_domisili"];
        $this->kodepos_domisili->AdvancedSearch->SearchValue2 = @$filter["y_kodepos_domisili"];
        $this->kodepos_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_kodepos_domisili"];
        $this->kodepos_domisili->AdvancedSearch->save();

        // Field prov_domisili
        $this->prov_domisili->AdvancedSearch->SearchValue = @$filter["x_prov_domisili"];
        $this->prov_domisili->AdvancedSearch->SearchOperator = @$filter["z_prov_domisili"];
        $this->prov_domisili->AdvancedSearch->SearchCondition = @$filter["v_prov_domisili"];
        $this->prov_domisili->AdvancedSearch->SearchValue2 = @$filter["y_prov_domisili"];
        $this->prov_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_prov_domisili"];
        $this->prov_domisili->AdvancedSearch->save();

        // Field negara_domisili
        $this->negara_domisili->AdvancedSearch->SearchValue = @$filter["x_negara_domisili"];
        $this->negara_domisili->AdvancedSearch->SearchOperator = @$filter["z_negara_domisili"];
        $this->negara_domisili->AdvancedSearch->SearchCondition = @$filter["v_negara_domisili"];
        $this->negara_domisili->AdvancedSearch->SearchValue2 = @$filter["y_negara_domisili"];
        $this->negara_domisili->AdvancedSearch->SearchOperator2 = @$filter["w_negara_domisili"];
        $this->negara_domisili->AdvancedSearch->save();

        // Field no_telp
        $this->no_telp->AdvancedSearch->SearchValue = @$filter["x_no_telp"];
        $this->no_telp->AdvancedSearch->SearchOperator = @$filter["z_no_telp"];
        $this->no_telp->AdvancedSearch->SearchCondition = @$filter["v_no_telp"];
        $this->no_telp->AdvancedSearch->SearchValue2 = @$filter["y_no_telp"];
        $this->no_telp->AdvancedSearch->SearchOperator2 = @$filter["w_no_telp"];
        $this->no_telp->AdvancedSearch->save();

        // Field no_hp
        $this->no_hp->AdvancedSearch->SearchValue = @$filter["x_no_hp"];
        $this->no_hp->AdvancedSearch->SearchOperator = @$filter["z_no_hp"];
        $this->no_hp->AdvancedSearch->SearchCondition = @$filter["v_no_hp"];
        $this->no_hp->AdvancedSearch->SearchValue2 = @$filter["y_no_hp"];
        $this->no_hp->AdvancedSearch->SearchOperator2 = @$filter["w_no_hp"];
        $this->no_hp->AdvancedSearch->save();

        // Field pendidikan
        $this->pendidikan->AdvancedSearch->SearchValue = @$filter["x_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchOperator = @$filter["z_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchCondition = @$filter["v_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchValue2 = @$filter["y_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchOperator2 = @$filter["w_pendidikan"];
        $this->pendidikan->AdvancedSearch->save();

        // Field pekerjaan
        $this->pekerjaan->AdvancedSearch->SearchValue = @$filter["x_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchOperator = @$filter["z_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchCondition = @$filter["v_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchValue2 = @$filter["y_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchOperator2 = @$filter["w_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->save();

        // Field status_kawin
        $this->status_kawin->AdvancedSearch->SearchValue = @$filter["x_status_kawin"];
        $this->status_kawin->AdvancedSearch->SearchOperator = @$filter["z_status_kawin"];
        $this->status_kawin->AdvancedSearch->SearchCondition = @$filter["v_status_kawin"];
        $this->status_kawin->AdvancedSearch->SearchValue2 = @$filter["y_status_kawin"];
        $this->status_kawin->AdvancedSearch->SearchOperator2 = @$filter["w_status_kawin"];
        $this->status_kawin->AdvancedSearch->save();

        // Field tgl_daftar
        $this->tgl_daftar->AdvancedSearch->SearchValue = @$filter["x_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchOperator = @$filter["z_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchCondition = @$filter["v_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchValue2 = @$filter["y_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->save();

        // Field username
        $this->_username->AdvancedSearch->SearchValue = @$filter["x__username"];
        $this->_username->AdvancedSearch->SearchOperator = @$filter["z__username"];
        $this->_username->AdvancedSearch->SearchCondition = @$filter["v__username"];
        $this->_username->AdvancedSearch->SearchValue2 = @$filter["y__username"];
        $this->_username->AdvancedSearch->SearchOperator2 = @$filter["w__username"];
        $this->_username->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->nama_pasien, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->no_rekam_medis, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->no_identitas_lain, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nama_ibu, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->tempat_lahir, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->suku, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->alamat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->keluarahan_desa, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kecamatan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kabupaten_kota, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->provinsi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->negara, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->alamat_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rt_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rw_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kel_desa_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kec_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kota_kab_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kodepos_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->prov_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->negara_domisili, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->_username, $arKeywords, $type);
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
            $this->updateSort($this->id_pasien); // id_pasien
            $this->updateSort($this->nama_pasien); // nama_pasien
            $this->updateSort($this->no_rekam_medis); // no_rekam_medis
            $this->updateSort($this->nik); // nik
            $this->updateSort($this->no_identitas_lain); // no_identitas_lain
            $this->updateSort($this->nama_ibu); // nama_ibu
            $this->updateSort($this->tempat_lahir); // tempat_lahir
            $this->updateSort($this->tanggal_lahir); // tanggal_lahir
            $this->updateSort($this->jenis_kelamin); // jenis_kelamin
            $this->updateSort($this->agama); // agama
            $this->updateSort($this->suku); // suku
            $this->updateSort($this->bahasa); // bahasa
            $this->updateSort($this->alamat); // alamat
            $this->updateSort($this->rt); // rt
            $this->updateSort($this->rw); // rw
            $this->updateSort($this->keluarahan_desa); // keluarahan_desa
            $this->updateSort($this->kecamatan); // kecamatan
            $this->updateSort($this->kabupaten_kota); // kabupaten_kota
            $this->updateSort($this->kodepos); // kodepos
            $this->updateSort($this->provinsi); // provinsi
            $this->updateSort($this->negara); // negara
            $this->updateSort($this->alamat_domisili); // alamat_domisili
            $this->updateSort($this->rt_domisili); // rt_domisili
            $this->updateSort($this->rw_domisili); // rw_domisili
            $this->updateSort($this->kel_desa_domisili); // kel_desa_domisili
            $this->updateSort($this->kec_domisili); // kec_domisili
            $this->updateSort($this->kota_kab_domisili); // kota_kab_domisili
            $this->updateSort($this->kodepos_domisili); // kodepos_domisili
            $this->updateSort($this->prov_domisili); // prov_domisili
            $this->updateSort($this->negara_domisili); // negara_domisili
            $this->updateSort($this->no_telp); // no_telp
            $this->updateSort($this->no_hp); // no_hp
            $this->updateSort($this->pendidikan); // pendidikan
            $this->updateSort($this->pekerjaan); // pekerjaan
            $this->updateSort($this->status_kawin); // status_kawin
            $this->updateSort($this->tgl_daftar); // tgl_daftar
            $this->updateSort($this->_username); // username
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
                $this->id_pasien->setSort("");
                $this->nama_pasien->setSort("");
                $this->no_rekam_medis->setSort("");
                $this->nik->setSort("");
                $this->no_identitas_lain->setSort("");
                $this->nama_ibu->setSort("");
                $this->tempat_lahir->setSort("");
                $this->tanggal_lahir->setSort("");
                $this->jenis_kelamin->setSort("");
                $this->agama->setSort("");
                $this->suku->setSort("");
                $this->bahasa->setSort("");
                $this->alamat->setSort("");
                $this->rt->setSort("");
                $this->rw->setSort("");
                $this->keluarahan_desa->setSort("");
                $this->kecamatan->setSort("");
                $this->kabupaten_kota->setSort("");
                $this->kodepos->setSort("");
                $this->provinsi->setSort("");
                $this->negara->setSort("");
                $this->alamat_domisili->setSort("");
                $this->rt_domisili->setSort("");
                $this->rw_domisili->setSort("");
                $this->kel_desa_domisili->setSort("");
                $this->kec_domisili->setSort("");
                $this->kota_kab_domisili->setSort("");
                $this->kodepos_domisili->setSort("");
                $this->prov_domisili->setSort("");
                $this->negara_domisili->setSort("");
                $this->no_telp->setSort("");
                $this->no_hp->setSort("");
                $this->pendidikan->setSort("");
                $this->pekerjaan->setSort("");
                $this->status_kawin->setSort("");
                $this->tgl_daftar->setSort("");
                $this->_username->setSort("");
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id_pasien->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fmaster_pasienlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fmaster_pasienlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fmaster_pasienlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        $this->id_pasien->setDbValue($row['id_pasien']);
        $this->nama_pasien->setDbValue($row['nama_pasien']);
        $this->no_rekam_medis->setDbValue($row['no_rekam_medis']);
        $this->nik->setDbValue($row['nik']);
        $this->no_identitas_lain->setDbValue($row['no_identitas_lain']);
        $this->nama_ibu->setDbValue($row['nama_ibu']);
        $this->tempat_lahir->setDbValue($row['tempat_lahir']);
        $this->tanggal_lahir->setDbValue($row['tanggal_lahir']);
        $this->jenis_kelamin->setDbValue($row['jenis_kelamin']);
        $this->agama->setDbValue($row['agama']);
        $this->suku->setDbValue($row['suku']);
        $this->bahasa->setDbValue($row['bahasa']);
        $this->alamat->setDbValue($row['alamat']);
        $this->rt->setDbValue($row['rt']);
        $this->rw->setDbValue($row['rw']);
        $this->keluarahan_desa->setDbValue($row['keluarahan_desa']);
        $this->kecamatan->setDbValue($row['kecamatan']);
        $this->kabupaten_kota->setDbValue($row['kabupaten_kota']);
        $this->kodepos->setDbValue($row['kodepos']);
        $this->provinsi->setDbValue($row['provinsi']);
        $this->negara->setDbValue($row['negara']);
        $this->alamat_domisili->setDbValue($row['alamat_domisili']);
        $this->rt_domisili->setDbValue($row['rt_domisili']);
        $this->rw_domisili->setDbValue($row['rw_domisili']);
        $this->kel_desa_domisili->setDbValue($row['kel_desa_domisili']);
        $this->kec_domisili->setDbValue($row['kec_domisili']);
        $this->kota_kab_domisili->setDbValue($row['kota_kab_domisili']);
        $this->kodepos_domisili->setDbValue($row['kodepos_domisili']);
        $this->prov_domisili->setDbValue($row['prov_domisili']);
        $this->negara_domisili->setDbValue($row['negara_domisili']);
        $this->no_telp->setDbValue($row['no_telp']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->status_kawin->setDbValue($row['status_kawin']);
        $this->tgl_daftar->setDbValue($row['tgl_daftar']);
        $this->_username->setDbValue($row['username']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_pasien'] = null;
        $row['nama_pasien'] = null;
        $row['no_rekam_medis'] = null;
        $row['nik'] = null;
        $row['no_identitas_lain'] = null;
        $row['nama_ibu'] = null;
        $row['tempat_lahir'] = null;
        $row['tanggal_lahir'] = null;
        $row['jenis_kelamin'] = null;
        $row['agama'] = null;
        $row['suku'] = null;
        $row['bahasa'] = null;
        $row['alamat'] = null;
        $row['rt'] = null;
        $row['rw'] = null;
        $row['keluarahan_desa'] = null;
        $row['kecamatan'] = null;
        $row['kabupaten_kota'] = null;
        $row['kodepos'] = null;
        $row['provinsi'] = null;
        $row['negara'] = null;
        $row['alamat_domisili'] = null;
        $row['rt_domisili'] = null;
        $row['rw_domisili'] = null;
        $row['kel_desa_domisili'] = null;
        $row['kec_domisili'] = null;
        $row['kota_kab_domisili'] = null;
        $row['kodepos_domisili'] = null;
        $row['prov_domisili'] = null;
        $row['negara_domisili'] = null;
        $row['no_telp'] = null;
        $row['no_hp'] = null;
        $row['pendidikan'] = null;
        $row['pekerjaan'] = null;
        $row['status_kawin'] = null;
        $row['tgl_daftar'] = null;
        $row['username'] = null;
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

        // id_pasien

        // nama_pasien

        // no_rekam_medis

        // nik

        // no_identitas_lain

        // nama_ibu

        // tempat_lahir

        // tanggal_lahir

        // jenis_kelamin

        // agama

        // suku

        // bahasa

        // alamat

        // rt

        // rw

        // keluarahan_desa

        // kecamatan

        // kabupaten_kota

        // kodepos

        // provinsi

        // negara

        // alamat_domisili

        // rt_domisili

        // rw_domisili

        // kel_desa_domisili

        // kec_domisili

        // kota_kab_domisili

        // kodepos_domisili

        // prov_domisili

        // negara_domisili

        // no_telp

        // no_hp

        // pendidikan

        // pekerjaan

        // status_kawin

        // tgl_daftar

        // username
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_pasien
            $this->id_pasien->ViewValue = $this->id_pasien->CurrentValue;
            $this->id_pasien->ViewCustomAttributes = "";

            // nama_pasien
            $this->nama_pasien->ViewValue = $this->nama_pasien->CurrentValue;
            $this->nama_pasien->ViewCustomAttributes = "";

            // no_rekam_medis
            $this->no_rekam_medis->ViewValue = $this->no_rekam_medis->CurrentValue;
            $this->no_rekam_medis->ViewCustomAttributes = "";

            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewValue = FormatNumber($this->nik->ViewValue, 0, -2, -2, -2);
            $this->nik->ViewCustomAttributes = "";

            // no_identitas_lain
            $this->no_identitas_lain->ViewValue = $this->no_identitas_lain->CurrentValue;
            $this->no_identitas_lain->ViewCustomAttributes = "";

            // nama_ibu
            $this->nama_ibu->ViewValue = $this->nama_ibu->CurrentValue;
            $this->nama_ibu->ViewCustomAttributes = "";

            // tempat_lahir
            $this->tempat_lahir->ViewValue = $this->tempat_lahir->CurrentValue;
            $this->tempat_lahir->ViewCustomAttributes = "";

            // tanggal_lahir
            $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
            $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
            $this->tanggal_lahir->ViewCustomAttributes = "";

            // jenis_kelamin
            $this->jenis_kelamin->ViewValue = $this->jenis_kelamin->CurrentValue;
            $this->jenis_kelamin->ViewValue = FormatNumber($this->jenis_kelamin->ViewValue, 0, -2, -2, -2);
            $this->jenis_kelamin->ViewCustomAttributes = "";

            // agama
            $this->agama->ViewValue = $this->agama->CurrentValue;
            $this->agama->ViewValue = FormatNumber($this->agama->ViewValue, 0, -2, -2, -2);
            $this->agama->ViewCustomAttributes = "";

            // suku
            $this->suku->ViewValue = $this->suku->CurrentValue;
            $this->suku->ViewCustomAttributes = "";

            // bahasa
            $this->bahasa->ViewValue = $this->bahasa->CurrentValue;
            $this->bahasa->ViewValue = FormatNumber($this->bahasa->ViewValue, 0, -2, -2, -2);
            $this->bahasa->ViewCustomAttributes = "";

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;
            $this->alamat->ViewCustomAttributes = "";

            // rt
            $this->rt->ViewValue = $this->rt->CurrentValue;
            $this->rt->ViewValue = FormatNumber($this->rt->ViewValue, 0, -2, -2, -2);
            $this->rt->ViewCustomAttributes = "";

            // rw
            $this->rw->ViewValue = $this->rw->CurrentValue;
            $this->rw->ViewValue = FormatNumber($this->rw->ViewValue, 0, -2, -2, -2);
            $this->rw->ViewCustomAttributes = "";

            // keluarahan_desa
            $this->keluarahan_desa->ViewValue = $this->keluarahan_desa->CurrentValue;
            $this->keluarahan_desa->ViewCustomAttributes = "";

            // kecamatan
            $this->kecamatan->ViewValue = $this->kecamatan->CurrentValue;
            $this->kecamatan->ViewCustomAttributes = "";

            // kabupaten_kota
            $this->kabupaten_kota->ViewValue = $this->kabupaten_kota->CurrentValue;
            $this->kabupaten_kota->ViewCustomAttributes = "";

            // kodepos
            $this->kodepos->ViewValue = $this->kodepos->CurrentValue;
            $this->kodepos->ViewValue = FormatNumber($this->kodepos->ViewValue, 0, -2, -2, -2);
            $this->kodepos->ViewCustomAttributes = "";

            // provinsi
            $this->provinsi->ViewValue = $this->provinsi->CurrentValue;
            $this->provinsi->ViewCustomAttributes = "";

            // negara
            $this->negara->ViewValue = $this->negara->CurrentValue;
            $this->negara->ViewCustomAttributes = "";

            // alamat_domisili
            $this->alamat_domisili->ViewValue = $this->alamat_domisili->CurrentValue;
            $this->alamat_domisili->ViewCustomAttributes = "";

            // rt_domisili
            $this->rt_domisili->ViewValue = $this->rt_domisili->CurrentValue;
            $this->rt_domisili->ViewCustomAttributes = "";

            // rw_domisili
            $this->rw_domisili->ViewValue = $this->rw_domisili->CurrentValue;
            $this->rw_domisili->ViewCustomAttributes = "";

            // kel_desa_domisili
            $this->kel_desa_domisili->ViewValue = $this->kel_desa_domisili->CurrentValue;
            $this->kel_desa_domisili->ViewCustomAttributes = "";

            // kec_domisili
            $this->kec_domisili->ViewValue = $this->kec_domisili->CurrentValue;
            $this->kec_domisili->ViewCustomAttributes = "";

            // kota_kab_domisili
            $this->kota_kab_domisili->ViewValue = $this->kota_kab_domisili->CurrentValue;
            $this->kota_kab_domisili->ViewCustomAttributes = "";

            // kodepos_domisili
            $this->kodepos_domisili->ViewValue = $this->kodepos_domisili->CurrentValue;
            $this->kodepos_domisili->ViewCustomAttributes = "";

            // prov_domisili
            $this->prov_domisili->ViewValue = $this->prov_domisili->CurrentValue;
            $this->prov_domisili->ViewCustomAttributes = "";

            // negara_domisili
            $this->negara_domisili->ViewValue = $this->negara_domisili->CurrentValue;
            $this->negara_domisili->ViewCustomAttributes = "";

            // no_telp
            $this->no_telp->ViewValue = $this->no_telp->CurrentValue;
            $this->no_telp->ViewValue = FormatNumber($this->no_telp->ViewValue, 0, -2, -2, -2);
            $this->no_telp->ViewCustomAttributes = "";

            // no_hp
            $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
            $this->no_hp->ViewValue = FormatNumber($this->no_hp->ViewValue, 0, -2, -2, -2);
            $this->no_hp->ViewCustomAttributes = "";

            // pendidikan
            $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
            $this->pendidikan->ViewValue = FormatNumber($this->pendidikan->ViewValue, 0, -2, -2, -2);
            $this->pendidikan->ViewCustomAttributes = "";

            // pekerjaan
            $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
            $this->pekerjaan->ViewValue = FormatNumber($this->pekerjaan->ViewValue, 0, -2, -2, -2);
            $this->pekerjaan->ViewCustomAttributes = "";

            // status_kawin
            $this->status_kawin->ViewValue = $this->status_kawin->CurrentValue;
            $this->status_kawin->ViewValue = FormatNumber($this->status_kawin->ViewValue, 0, -2, -2, -2);
            $this->status_kawin->ViewCustomAttributes = "";

            // tgl_daftar
            $this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
            $this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
            $this->tgl_daftar->ViewCustomAttributes = "";

            // username
            $this->_username->ViewValue = $this->_username->CurrentValue;
            $this->_username->ViewCustomAttributes = "";

            // id_pasien
            $this->id_pasien->LinkCustomAttributes = "";
            $this->id_pasien->HrefValue = "";
            $this->id_pasien->TooltipValue = "";

            // nama_pasien
            $this->nama_pasien->LinkCustomAttributes = "";
            $this->nama_pasien->HrefValue = "";
            $this->nama_pasien->TooltipValue = "";

            // no_rekam_medis
            $this->no_rekam_medis->LinkCustomAttributes = "";
            $this->no_rekam_medis->HrefValue = "";
            $this->no_rekam_medis->TooltipValue = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // no_identitas_lain
            $this->no_identitas_lain->LinkCustomAttributes = "";
            $this->no_identitas_lain->HrefValue = "";
            $this->no_identitas_lain->TooltipValue = "";

            // nama_ibu
            $this->nama_ibu->LinkCustomAttributes = "";
            $this->nama_ibu->HrefValue = "";
            $this->nama_ibu->TooltipValue = "";

            // tempat_lahir
            $this->tempat_lahir->LinkCustomAttributes = "";
            $this->tempat_lahir->HrefValue = "";
            $this->tempat_lahir->TooltipValue = "";

            // tanggal_lahir
            $this->tanggal_lahir->LinkCustomAttributes = "";
            $this->tanggal_lahir->HrefValue = "";
            $this->tanggal_lahir->TooltipValue = "";

            // jenis_kelamin
            $this->jenis_kelamin->LinkCustomAttributes = "";
            $this->jenis_kelamin->HrefValue = "";
            $this->jenis_kelamin->TooltipValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";
            $this->agama->TooltipValue = "";

            // suku
            $this->suku->LinkCustomAttributes = "";
            $this->suku->HrefValue = "";
            $this->suku->TooltipValue = "";

            // bahasa
            $this->bahasa->LinkCustomAttributes = "";
            $this->bahasa->HrefValue = "";
            $this->bahasa->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // rt
            $this->rt->LinkCustomAttributes = "";
            $this->rt->HrefValue = "";
            $this->rt->TooltipValue = "";

            // rw
            $this->rw->LinkCustomAttributes = "";
            $this->rw->HrefValue = "";
            $this->rw->TooltipValue = "";

            // keluarahan_desa
            $this->keluarahan_desa->LinkCustomAttributes = "";
            $this->keluarahan_desa->HrefValue = "";
            $this->keluarahan_desa->TooltipValue = "";

            // kecamatan
            $this->kecamatan->LinkCustomAttributes = "";
            $this->kecamatan->HrefValue = "";
            $this->kecamatan->TooltipValue = "";

            // kabupaten_kota
            $this->kabupaten_kota->LinkCustomAttributes = "";
            $this->kabupaten_kota->HrefValue = "";
            $this->kabupaten_kota->TooltipValue = "";

            // kodepos
            $this->kodepos->LinkCustomAttributes = "";
            $this->kodepos->HrefValue = "";
            $this->kodepos->TooltipValue = "";

            // provinsi
            $this->provinsi->LinkCustomAttributes = "";
            $this->provinsi->HrefValue = "";
            $this->provinsi->TooltipValue = "";

            // negara
            $this->negara->LinkCustomAttributes = "";
            $this->negara->HrefValue = "";
            $this->negara->TooltipValue = "";

            // alamat_domisili
            $this->alamat_domisili->LinkCustomAttributes = "";
            $this->alamat_domisili->HrefValue = "";
            $this->alamat_domisili->TooltipValue = "";

            // rt_domisili
            $this->rt_domisili->LinkCustomAttributes = "";
            $this->rt_domisili->HrefValue = "";
            $this->rt_domisili->TooltipValue = "";

            // rw_domisili
            $this->rw_domisili->LinkCustomAttributes = "";
            $this->rw_domisili->HrefValue = "";
            $this->rw_domisili->TooltipValue = "";

            // kel_desa_domisili
            $this->kel_desa_domisili->LinkCustomAttributes = "";
            $this->kel_desa_domisili->HrefValue = "";
            $this->kel_desa_domisili->TooltipValue = "";

            // kec_domisili
            $this->kec_domisili->LinkCustomAttributes = "";
            $this->kec_domisili->HrefValue = "";
            $this->kec_domisili->TooltipValue = "";

            // kota_kab_domisili
            $this->kota_kab_domisili->LinkCustomAttributes = "";
            $this->kota_kab_domisili->HrefValue = "";
            $this->kota_kab_domisili->TooltipValue = "";

            // kodepos_domisili
            $this->kodepos_domisili->LinkCustomAttributes = "";
            $this->kodepos_domisili->HrefValue = "";
            $this->kodepos_domisili->TooltipValue = "";

            // prov_domisili
            $this->prov_domisili->LinkCustomAttributes = "";
            $this->prov_domisili->HrefValue = "";
            $this->prov_domisili->TooltipValue = "";

            // negara_domisili
            $this->negara_domisili->LinkCustomAttributes = "";
            $this->negara_domisili->HrefValue = "";
            $this->negara_domisili->TooltipValue = "";

            // no_telp
            $this->no_telp->LinkCustomAttributes = "";
            $this->no_telp->HrefValue = "";
            $this->no_telp->TooltipValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";
            $this->no_hp->TooltipValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";
            $this->pendidikan->TooltipValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";
            $this->pekerjaan->TooltipValue = "";

            // status_kawin
            $this->status_kawin->LinkCustomAttributes = "";
            $this->status_kawin->HrefValue = "";
            $this->status_kawin->TooltipValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";
            $this->_username->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fmaster_pasienlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fmaster_pasienlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fmaster_pasienlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_master_pasien" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_master_pasien\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fmaster_pasienlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
        $item->Visible = false;

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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fmaster_pasienlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
