<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MPasienList extends MPasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'm_pasien';

    // Page object name
    public $PageObjName = "MPasienList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fm_pasienlist";
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

        // Table object (m_pasien)
        if (!isset($GLOBALS["m_pasien"]) || get_class($GLOBALS["m_pasien"]) == PROJECT_NAMESPACE . "m_pasien") {
            $GLOBALS["m_pasien"] = &$this;
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
        $this->AddUrl = "MPasienAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "MPasienDelete";
        $this->MultiUpdateUrl = "MPasienUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_pasien');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fm_pasienlistsrch";

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
                $doc = new $class(Container("m_pasien"));
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
        if ($this->isAddOrEdit()) {
            $this->tgl_daftar->Visible = false;
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
        $this->id_pasien->Visible = false;
        $this->no_rkm_medis->setVisibility();
        $this->nm_pasien->setVisibility();
        $this->no_ktp->Visible = false;
        $this->jk->setVisibility();
        $this->tmp_lahir->Visible = false;
        $this->tgl_lahir->Visible = false;
        $this->nm_ibu->setVisibility();
        $this->alamat->setVisibility();
        $this->gol_darah->Visible = false;
        $this->pekerjaan->Visible = false;
        $this->stts_nikah->Visible = false;
        $this->agama->Visible = false;
        $this->tgl_daftar->setVisibility();
        $this->no_tlp->Visible = false;
        $this->umur->Visible = false;
        $this->pnd->Visible = false;
        $this->keluarga->Visible = false;
        $this->namakeluarga->Visible = false;
        $this->kd_pj->Visible = false;
        $this->no_peserta->Visible = false;
        $this->kd_kel->Visible = false;
        $this->kd_kec->Visible = false;
        $this->kd_kab->Visible = false;
        $this->kd_prop->Visible = false;
        $this->pekerjaanpj->Visible = false;
        $this->alamatpj->Visible = false;
        $this->kelurahanpj->Visible = false;
        $this->kecamatanpj->Visible = false;
        $this->kabupatenpj->Visible = false;
        $this->perusahaan_pasien->Visible = false;
        $this->suku_bangsa->Visible = false;
        $this->bahasa_pasien->Visible = false;
        $this->cacat_fisik->Visible = false;
        $this->_email->Visible = false;
        $this->nip->Visible = false;
        $this->propinsipj->Visible = false;
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
        $this->setupLookupOptions($this->kd_pj);
        $this->setupLookupOptions($this->kd_kel);
        $this->setupLookupOptions($this->kd_kec);
        $this->setupLookupOptions($this->kd_kab);
        $this->setupLookupOptions($this->kd_prop);
        $this->setupLookupOptions($this->perusahaan_pasien);
        $this->setupLookupOptions($this->suku_bangsa);
        $this->setupLookupOptions($this->bahasa_pasien);
        $this->setupLookupOptions($this->cacat_fisik);

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
            AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(true));

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
        $filterList = Concat($filterList, $this->no_rkm_medis->AdvancedSearch->toJson(), ","); // Field no_rkm_medis
        $filterList = Concat($filterList, $this->nm_pasien->AdvancedSearch->toJson(), ","); // Field nm_pasien
        $filterList = Concat($filterList, $this->no_ktp->AdvancedSearch->toJson(), ","); // Field no_ktp
        $filterList = Concat($filterList, $this->jk->AdvancedSearch->toJson(), ","); // Field jk
        $filterList = Concat($filterList, $this->tmp_lahir->AdvancedSearch->toJson(), ","); // Field tmp_lahir
        $filterList = Concat($filterList, $this->tgl_lahir->AdvancedSearch->toJson(), ","); // Field tgl_lahir
        $filterList = Concat($filterList, $this->nm_ibu->AdvancedSearch->toJson(), ","); // Field nm_ibu
        $filterList = Concat($filterList, $this->alamat->AdvancedSearch->toJson(), ","); // Field alamat
        $filterList = Concat($filterList, $this->gol_darah->AdvancedSearch->toJson(), ","); // Field gol_darah
        $filterList = Concat($filterList, $this->pekerjaan->AdvancedSearch->toJson(), ","); // Field pekerjaan
        $filterList = Concat($filterList, $this->stts_nikah->AdvancedSearch->toJson(), ","); // Field stts_nikah
        $filterList = Concat($filterList, $this->agama->AdvancedSearch->toJson(), ","); // Field agama
        $filterList = Concat($filterList, $this->tgl_daftar->AdvancedSearch->toJson(), ","); // Field tgl_daftar
        $filterList = Concat($filterList, $this->no_tlp->AdvancedSearch->toJson(), ","); // Field no_tlp
        $filterList = Concat($filterList, $this->umur->AdvancedSearch->toJson(), ","); // Field umur
        $filterList = Concat($filterList, $this->pnd->AdvancedSearch->toJson(), ","); // Field pnd
        $filterList = Concat($filterList, $this->keluarga->AdvancedSearch->toJson(), ","); // Field keluarga
        $filterList = Concat($filterList, $this->namakeluarga->AdvancedSearch->toJson(), ","); // Field namakeluarga
        $filterList = Concat($filterList, $this->kd_pj->AdvancedSearch->toJson(), ","); // Field kd_pj
        $filterList = Concat($filterList, $this->no_peserta->AdvancedSearch->toJson(), ","); // Field no_peserta
        $filterList = Concat($filterList, $this->kd_kel->AdvancedSearch->toJson(), ","); // Field kd_kel
        $filterList = Concat($filterList, $this->kd_kec->AdvancedSearch->toJson(), ","); // Field kd_kec
        $filterList = Concat($filterList, $this->kd_kab->AdvancedSearch->toJson(), ","); // Field kd_kab
        $filterList = Concat($filterList, $this->kd_prop->AdvancedSearch->toJson(), ","); // Field kd_prop
        $filterList = Concat($filterList, $this->pekerjaanpj->AdvancedSearch->toJson(), ","); // Field pekerjaanpj
        $filterList = Concat($filterList, $this->alamatpj->AdvancedSearch->toJson(), ","); // Field alamatpj
        $filterList = Concat($filterList, $this->kelurahanpj->AdvancedSearch->toJson(), ","); // Field kelurahanpj
        $filterList = Concat($filterList, $this->kecamatanpj->AdvancedSearch->toJson(), ","); // Field kecamatanpj
        $filterList = Concat($filterList, $this->kabupatenpj->AdvancedSearch->toJson(), ","); // Field kabupatenpj
        $filterList = Concat($filterList, $this->perusahaan_pasien->AdvancedSearch->toJson(), ","); // Field perusahaan_pasien
        $filterList = Concat($filterList, $this->suku_bangsa->AdvancedSearch->toJson(), ","); // Field suku_bangsa
        $filterList = Concat($filterList, $this->bahasa_pasien->AdvancedSearch->toJson(), ","); // Field bahasa_pasien
        $filterList = Concat($filterList, $this->cacat_fisik->AdvancedSearch->toJson(), ","); // Field cacat_fisik
        $filterList = Concat($filterList, $this->_email->AdvancedSearch->toJson(), ","); // Field email
        $filterList = Concat($filterList, $this->nip->AdvancedSearch->toJson(), ","); // Field nip
        $filterList = Concat($filterList, $this->propinsipj->AdvancedSearch->toJson(), ","); // Field propinsipj

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
            $UserProfile->setSearchFilters(CurrentUserName(), "fm_pasienlistsrch", $filters);
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

        // Field no_rkm_medis
        $this->no_rkm_medis->AdvancedSearch->SearchValue = @$filter["x_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchOperator = @$filter["z_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchCondition = @$filter["v_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchValue2 = @$filter["y_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->SearchOperator2 = @$filter["w_no_rkm_medis"];
        $this->no_rkm_medis->AdvancedSearch->save();

        // Field nm_pasien
        $this->nm_pasien->AdvancedSearch->SearchValue = @$filter["x_nm_pasien"];
        $this->nm_pasien->AdvancedSearch->SearchOperator = @$filter["z_nm_pasien"];
        $this->nm_pasien->AdvancedSearch->SearchCondition = @$filter["v_nm_pasien"];
        $this->nm_pasien->AdvancedSearch->SearchValue2 = @$filter["y_nm_pasien"];
        $this->nm_pasien->AdvancedSearch->SearchOperator2 = @$filter["w_nm_pasien"];
        $this->nm_pasien->AdvancedSearch->save();

        // Field no_ktp
        $this->no_ktp->AdvancedSearch->SearchValue = @$filter["x_no_ktp"];
        $this->no_ktp->AdvancedSearch->SearchOperator = @$filter["z_no_ktp"];
        $this->no_ktp->AdvancedSearch->SearchCondition = @$filter["v_no_ktp"];
        $this->no_ktp->AdvancedSearch->SearchValue2 = @$filter["y_no_ktp"];
        $this->no_ktp->AdvancedSearch->SearchOperator2 = @$filter["w_no_ktp"];
        $this->no_ktp->AdvancedSearch->save();

        // Field jk
        $this->jk->AdvancedSearch->SearchValue = @$filter["x_jk"];
        $this->jk->AdvancedSearch->SearchOperator = @$filter["z_jk"];
        $this->jk->AdvancedSearch->SearchCondition = @$filter["v_jk"];
        $this->jk->AdvancedSearch->SearchValue2 = @$filter["y_jk"];
        $this->jk->AdvancedSearch->SearchOperator2 = @$filter["w_jk"];
        $this->jk->AdvancedSearch->save();

        // Field tmp_lahir
        $this->tmp_lahir->AdvancedSearch->SearchValue = @$filter["x_tmp_lahir"];
        $this->tmp_lahir->AdvancedSearch->SearchOperator = @$filter["z_tmp_lahir"];
        $this->tmp_lahir->AdvancedSearch->SearchCondition = @$filter["v_tmp_lahir"];
        $this->tmp_lahir->AdvancedSearch->SearchValue2 = @$filter["y_tmp_lahir"];
        $this->tmp_lahir->AdvancedSearch->SearchOperator2 = @$filter["w_tmp_lahir"];
        $this->tmp_lahir->AdvancedSearch->save();

        // Field tgl_lahir
        $this->tgl_lahir->AdvancedSearch->SearchValue = @$filter["x_tgl_lahir"];
        $this->tgl_lahir->AdvancedSearch->SearchOperator = @$filter["z_tgl_lahir"];
        $this->tgl_lahir->AdvancedSearch->SearchCondition = @$filter["v_tgl_lahir"];
        $this->tgl_lahir->AdvancedSearch->SearchValue2 = @$filter["y_tgl_lahir"];
        $this->tgl_lahir->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_lahir"];
        $this->tgl_lahir->AdvancedSearch->save();

        // Field nm_ibu
        $this->nm_ibu->AdvancedSearch->SearchValue = @$filter["x_nm_ibu"];
        $this->nm_ibu->AdvancedSearch->SearchOperator = @$filter["z_nm_ibu"];
        $this->nm_ibu->AdvancedSearch->SearchCondition = @$filter["v_nm_ibu"];
        $this->nm_ibu->AdvancedSearch->SearchValue2 = @$filter["y_nm_ibu"];
        $this->nm_ibu->AdvancedSearch->SearchOperator2 = @$filter["w_nm_ibu"];
        $this->nm_ibu->AdvancedSearch->save();

        // Field alamat
        $this->alamat->AdvancedSearch->SearchValue = @$filter["x_alamat"];
        $this->alamat->AdvancedSearch->SearchOperator = @$filter["z_alamat"];
        $this->alamat->AdvancedSearch->SearchCondition = @$filter["v_alamat"];
        $this->alamat->AdvancedSearch->SearchValue2 = @$filter["y_alamat"];
        $this->alamat->AdvancedSearch->SearchOperator2 = @$filter["w_alamat"];
        $this->alamat->AdvancedSearch->save();

        // Field gol_darah
        $this->gol_darah->AdvancedSearch->SearchValue = @$filter["x_gol_darah"];
        $this->gol_darah->AdvancedSearch->SearchOperator = @$filter["z_gol_darah"];
        $this->gol_darah->AdvancedSearch->SearchCondition = @$filter["v_gol_darah"];
        $this->gol_darah->AdvancedSearch->SearchValue2 = @$filter["y_gol_darah"];
        $this->gol_darah->AdvancedSearch->SearchOperator2 = @$filter["w_gol_darah"];
        $this->gol_darah->AdvancedSearch->save();

        // Field pekerjaan
        $this->pekerjaan->AdvancedSearch->SearchValue = @$filter["x_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchOperator = @$filter["z_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchCondition = @$filter["v_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchValue2 = @$filter["y_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->SearchOperator2 = @$filter["w_pekerjaan"];
        $this->pekerjaan->AdvancedSearch->save();

        // Field stts_nikah
        $this->stts_nikah->AdvancedSearch->SearchValue = @$filter["x_stts_nikah"];
        $this->stts_nikah->AdvancedSearch->SearchOperator = @$filter["z_stts_nikah"];
        $this->stts_nikah->AdvancedSearch->SearchCondition = @$filter["v_stts_nikah"];
        $this->stts_nikah->AdvancedSearch->SearchValue2 = @$filter["y_stts_nikah"];
        $this->stts_nikah->AdvancedSearch->SearchOperator2 = @$filter["w_stts_nikah"];
        $this->stts_nikah->AdvancedSearch->save();

        // Field agama
        $this->agama->AdvancedSearch->SearchValue = @$filter["x_agama"];
        $this->agama->AdvancedSearch->SearchOperator = @$filter["z_agama"];
        $this->agama->AdvancedSearch->SearchCondition = @$filter["v_agama"];
        $this->agama->AdvancedSearch->SearchValue2 = @$filter["y_agama"];
        $this->agama->AdvancedSearch->SearchOperator2 = @$filter["w_agama"];
        $this->agama->AdvancedSearch->save();

        // Field tgl_daftar
        $this->tgl_daftar->AdvancedSearch->SearchValue = @$filter["x_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchOperator = @$filter["z_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchCondition = @$filter["v_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchValue2 = @$filter["y_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_daftar"];
        $this->tgl_daftar->AdvancedSearch->save();

        // Field no_tlp
        $this->no_tlp->AdvancedSearch->SearchValue = @$filter["x_no_tlp"];
        $this->no_tlp->AdvancedSearch->SearchOperator = @$filter["z_no_tlp"];
        $this->no_tlp->AdvancedSearch->SearchCondition = @$filter["v_no_tlp"];
        $this->no_tlp->AdvancedSearch->SearchValue2 = @$filter["y_no_tlp"];
        $this->no_tlp->AdvancedSearch->SearchOperator2 = @$filter["w_no_tlp"];
        $this->no_tlp->AdvancedSearch->save();

        // Field umur
        $this->umur->AdvancedSearch->SearchValue = @$filter["x_umur"];
        $this->umur->AdvancedSearch->SearchOperator = @$filter["z_umur"];
        $this->umur->AdvancedSearch->SearchCondition = @$filter["v_umur"];
        $this->umur->AdvancedSearch->SearchValue2 = @$filter["y_umur"];
        $this->umur->AdvancedSearch->SearchOperator2 = @$filter["w_umur"];
        $this->umur->AdvancedSearch->save();

        // Field pnd
        $this->pnd->AdvancedSearch->SearchValue = @$filter["x_pnd"];
        $this->pnd->AdvancedSearch->SearchOperator = @$filter["z_pnd"];
        $this->pnd->AdvancedSearch->SearchCondition = @$filter["v_pnd"];
        $this->pnd->AdvancedSearch->SearchValue2 = @$filter["y_pnd"];
        $this->pnd->AdvancedSearch->SearchOperator2 = @$filter["w_pnd"];
        $this->pnd->AdvancedSearch->save();

        // Field keluarga
        $this->keluarga->AdvancedSearch->SearchValue = @$filter["x_keluarga"];
        $this->keluarga->AdvancedSearch->SearchOperator = @$filter["z_keluarga"];
        $this->keluarga->AdvancedSearch->SearchCondition = @$filter["v_keluarga"];
        $this->keluarga->AdvancedSearch->SearchValue2 = @$filter["y_keluarga"];
        $this->keluarga->AdvancedSearch->SearchOperator2 = @$filter["w_keluarga"];
        $this->keluarga->AdvancedSearch->save();

        // Field namakeluarga
        $this->namakeluarga->AdvancedSearch->SearchValue = @$filter["x_namakeluarga"];
        $this->namakeluarga->AdvancedSearch->SearchOperator = @$filter["z_namakeluarga"];
        $this->namakeluarga->AdvancedSearch->SearchCondition = @$filter["v_namakeluarga"];
        $this->namakeluarga->AdvancedSearch->SearchValue2 = @$filter["y_namakeluarga"];
        $this->namakeluarga->AdvancedSearch->SearchOperator2 = @$filter["w_namakeluarga"];
        $this->namakeluarga->AdvancedSearch->save();

        // Field kd_pj
        $this->kd_pj->AdvancedSearch->SearchValue = @$filter["x_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchOperator = @$filter["z_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchCondition = @$filter["v_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchValue2 = @$filter["y_kd_pj"];
        $this->kd_pj->AdvancedSearch->SearchOperator2 = @$filter["w_kd_pj"];
        $this->kd_pj->AdvancedSearch->save();

        // Field no_peserta
        $this->no_peserta->AdvancedSearch->SearchValue = @$filter["x_no_peserta"];
        $this->no_peserta->AdvancedSearch->SearchOperator = @$filter["z_no_peserta"];
        $this->no_peserta->AdvancedSearch->SearchCondition = @$filter["v_no_peserta"];
        $this->no_peserta->AdvancedSearch->SearchValue2 = @$filter["y_no_peserta"];
        $this->no_peserta->AdvancedSearch->SearchOperator2 = @$filter["w_no_peserta"];
        $this->no_peserta->AdvancedSearch->save();

        // Field kd_kel
        $this->kd_kel->AdvancedSearch->SearchValue = @$filter["x_kd_kel"];
        $this->kd_kel->AdvancedSearch->SearchOperator = @$filter["z_kd_kel"];
        $this->kd_kel->AdvancedSearch->SearchCondition = @$filter["v_kd_kel"];
        $this->kd_kel->AdvancedSearch->SearchValue2 = @$filter["y_kd_kel"];
        $this->kd_kel->AdvancedSearch->SearchOperator2 = @$filter["w_kd_kel"];
        $this->kd_kel->AdvancedSearch->save();

        // Field kd_kec
        $this->kd_kec->AdvancedSearch->SearchValue = @$filter["x_kd_kec"];
        $this->kd_kec->AdvancedSearch->SearchOperator = @$filter["z_kd_kec"];
        $this->kd_kec->AdvancedSearch->SearchCondition = @$filter["v_kd_kec"];
        $this->kd_kec->AdvancedSearch->SearchValue2 = @$filter["y_kd_kec"];
        $this->kd_kec->AdvancedSearch->SearchOperator2 = @$filter["w_kd_kec"];
        $this->kd_kec->AdvancedSearch->save();

        // Field kd_kab
        $this->kd_kab->AdvancedSearch->SearchValue = @$filter["x_kd_kab"];
        $this->kd_kab->AdvancedSearch->SearchOperator = @$filter["z_kd_kab"];
        $this->kd_kab->AdvancedSearch->SearchCondition = @$filter["v_kd_kab"];
        $this->kd_kab->AdvancedSearch->SearchValue2 = @$filter["y_kd_kab"];
        $this->kd_kab->AdvancedSearch->SearchOperator2 = @$filter["w_kd_kab"];
        $this->kd_kab->AdvancedSearch->save();

        // Field kd_prop
        $this->kd_prop->AdvancedSearch->SearchValue = @$filter["x_kd_prop"];
        $this->kd_prop->AdvancedSearch->SearchOperator = @$filter["z_kd_prop"];
        $this->kd_prop->AdvancedSearch->SearchCondition = @$filter["v_kd_prop"];
        $this->kd_prop->AdvancedSearch->SearchValue2 = @$filter["y_kd_prop"];
        $this->kd_prop->AdvancedSearch->SearchOperator2 = @$filter["w_kd_prop"];
        $this->kd_prop->AdvancedSearch->save();

        // Field pekerjaanpj
        $this->pekerjaanpj->AdvancedSearch->SearchValue = @$filter["x_pekerjaanpj"];
        $this->pekerjaanpj->AdvancedSearch->SearchOperator = @$filter["z_pekerjaanpj"];
        $this->pekerjaanpj->AdvancedSearch->SearchCondition = @$filter["v_pekerjaanpj"];
        $this->pekerjaanpj->AdvancedSearch->SearchValue2 = @$filter["y_pekerjaanpj"];
        $this->pekerjaanpj->AdvancedSearch->SearchOperator2 = @$filter["w_pekerjaanpj"];
        $this->pekerjaanpj->AdvancedSearch->save();

        // Field alamatpj
        $this->alamatpj->AdvancedSearch->SearchValue = @$filter["x_alamatpj"];
        $this->alamatpj->AdvancedSearch->SearchOperator = @$filter["z_alamatpj"];
        $this->alamatpj->AdvancedSearch->SearchCondition = @$filter["v_alamatpj"];
        $this->alamatpj->AdvancedSearch->SearchValue2 = @$filter["y_alamatpj"];
        $this->alamatpj->AdvancedSearch->SearchOperator2 = @$filter["w_alamatpj"];
        $this->alamatpj->AdvancedSearch->save();

        // Field kelurahanpj
        $this->kelurahanpj->AdvancedSearch->SearchValue = @$filter["x_kelurahanpj"];
        $this->kelurahanpj->AdvancedSearch->SearchOperator = @$filter["z_kelurahanpj"];
        $this->kelurahanpj->AdvancedSearch->SearchCondition = @$filter["v_kelurahanpj"];
        $this->kelurahanpj->AdvancedSearch->SearchValue2 = @$filter["y_kelurahanpj"];
        $this->kelurahanpj->AdvancedSearch->SearchOperator2 = @$filter["w_kelurahanpj"];
        $this->kelurahanpj->AdvancedSearch->save();

        // Field kecamatanpj
        $this->kecamatanpj->AdvancedSearch->SearchValue = @$filter["x_kecamatanpj"];
        $this->kecamatanpj->AdvancedSearch->SearchOperator = @$filter["z_kecamatanpj"];
        $this->kecamatanpj->AdvancedSearch->SearchCondition = @$filter["v_kecamatanpj"];
        $this->kecamatanpj->AdvancedSearch->SearchValue2 = @$filter["y_kecamatanpj"];
        $this->kecamatanpj->AdvancedSearch->SearchOperator2 = @$filter["w_kecamatanpj"];
        $this->kecamatanpj->AdvancedSearch->save();

        // Field kabupatenpj
        $this->kabupatenpj->AdvancedSearch->SearchValue = @$filter["x_kabupatenpj"];
        $this->kabupatenpj->AdvancedSearch->SearchOperator = @$filter["z_kabupatenpj"];
        $this->kabupatenpj->AdvancedSearch->SearchCondition = @$filter["v_kabupatenpj"];
        $this->kabupatenpj->AdvancedSearch->SearchValue2 = @$filter["y_kabupatenpj"];
        $this->kabupatenpj->AdvancedSearch->SearchOperator2 = @$filter["w_kabupatenpj"];
        $this->kabupatenpj->AdvancedSearch->save();

        // Field perusahaan_pasien
        $this->perusahaan_pasien->AdvancedSearch->SearchValue = @$filter["x_perusahaan_pasien"];
        $this->perusahaan_pasien->AdvancedSearch->SearchOperator = @$filter["z_perusahaan_pasien"];
        $this->perusahaan_pasien->AdvancedSearch->SearchCondition = @$filter["v_perusahaan_pasien"];
        $this->perusahaan_pasien->AdvancedSearch->SearchValue2 = @$filter["y_perusahaan_pasien"];
        $this->perusahaan_pasien->AdvancedSearch->SearchOperator2 = @$filter["w_perusahaan_pasien"];
        $this->perusahaan_pasien->AdvancedSearch->save();

        // Field suku_bangsa
        $this->suku_bangsa->AdvancedSearch->SearchValue = @$filter["x_suku_bangsa"];
        $this->suku_bangsa->AdvancedSearch->SearchOperator = @$filter["z_suku_bangsa"];
        $this->suku_bangsa->AdvancedSearch->SearchCondition = @$filter["v_suku_bangsa"];
        $this->suku_bangsa->AdvancedSearch->SearchValue2 = @$filter["y_suku_bangsa"];
        $this->suku_bangsa->AdvancedSearch->SearchOperator2 = @$filter["w_suku_bangsa"];
        $this->suku_bangsa->AdvancedSearch->save();

        // Field bahasa_pasien
        $this->bahasa_pasien->AdvancedSearch->SearchValue = @$filter["x_bahasa_pasien"];
        $this->bahasa_pasien->AdvancedSearch->SearchOperator = @$filter["z_bahasa_pasien"];
        $this->bahasa_pasien->AdvancedSearch->SearchCondition = @$filter["v_bahasa_pasien"];
        $this->bahasa_pasien->AdvancedSearch->SearchValue2 = @$filter["y_bahasa_pasien"];
        $this->bahasa_pasien->AdvancedSearch->SearchOperator2 = @$filter["w_bahasa_pasien"];
        $this->bahasa_pasien->AdvancedSearch->save();

        // Field cacat_fisik
        $this->cacat_fisik->AdvancedSearch->SearchValue = @$filter["x_cacat_fisik"];
        $this->cacat_fisik->AdvancedSearch->SearchOperator = @$filter["z_cacat_fisik"];
        $this->cacat_fisik->AdvancedSearch->SearchCondition = @$filter["v_cacat_fisik"];
        $this->cacat_fisik->AdvancedSearch->SearchValue2 = @$filter["y_cacat_fisik"];
        $this->cacat_fisik->AdvancedSearch->SearchOperator2 = @$filter["w_cacat_fisik"];
        $this->cacat_fisik->AdvancedSearch->save();

        // Field email
        $this->_email->AdvancedSearch->SearchValue = @$filter["x__email"];
        $this->_email->AdvancedSearch->SearchOperator = @$filter["z__email"];
        $this->_email->AdvancedSearch->SearchCondition = @$filter["v__email"];
        $this->_email->AdvancedSearch->SearchValue2 = @$filter["y__email"];
        $this->_email->AdvancedSearch->SearchOperator2 = @$filter["w__email"];
        $this->_email->AdvancedSearch->save();

        // Field nip
        $this->nip->AdvancedSearch->SearchValue = @$filter["x_nip"];
        $this->nip->AdvancedSearch->SearchOperator = @$filter["z_nip"];
        $this->nip->AdvancedSearch->SearchCondition = @$filter["v_nip"];
        $this->nip->AdvancedSearch->SearchValue2 = @$filter["y_nip"];
        $this->nip->AdvancedSearch->SearchOperator2 = @$filter["w_nip"];
        $this->nip->AdvancedSearch->save();

        // Field propinsipj
        $this->propinsipj->AdvancedSearch->SearchValue = @$filter["x_propinsipj"];
        $this->propinsipj->AdvancedSearch->SearchOperator = @$filter["z_propinsipj"];
        $this->propinsipj->AdvancedSearch->SearchCondition = @$filter["v_propinsipj"];
        $this->propinsipj->AdvancedSearch->SearchValue2 = @$filter["y_propinsipj"];
        $this->propinsipj->AdvancedSearch->SearchOperator2 = @$filter["w_propinsipj"];
        $this->propinsipj->AdvancedSearch->save();
    }

    // Advanced search WHERE clause based on QueryString
    protected function advancedSearchWhere($default = false)
    {
        global $Security;
        $where = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $this->buildSearchSql($where, $this->id_pasien, $default, false); // id_pasien
        $this->buildSearchSql($where, $this->no_rkm_medis, $default, false); // no_rkm_medis
        $this->buildSearchSql($where, $this->nm_pasien, $default, false); // nm_pasien
        $this->buildSearchSql($where, $this->no_ktp, $default, false); // no_ktp
        $this->buildSearchSql($where, $this->jk, $default, false); // jk
        $this->buildSearchSql($where, $this->tmp_lahir, $default, false); // tmp_lahir
        $this->buildSearchSql($where, $this->tgl_lahir, $default, false); // tgl_lahir
        $this->buildSearchSql($where, $this->nm_ibu, $default, false); // nm_ibu
        $this->buildSearchSql($where, $this->alamat, $default, false); // alamat
        $this->buildSearchSql($where, $this->gol_darah, $default, false); // gol_darah
        $this->buildSearchSql($where, $this->pekerjaan, $default, false); // pekerjaan
        $this->buildSearchSql($where, $this->stts_nikah, $default, false); // stts_nikah
        $this->buildSearchSql($where, $this->agama, $default, false); // agama
        $this->buildSearchSql($where, $this->tgl_daftar, $default, false); // tgl_daftar
        $this->buildSearchSql($where, $this->no_tlp, $default, false); // no_tlp
        $this->buildSearchSql($where, $this->umur, $default, false); // umur
        $this->buildSearchSql($where, $this->pnd, $default, false); // pnd
        $this->buildSearchSql($where, $this->keluarga, $default, false); // keluarga
        $this->buildSearchSql($where, $this->namakeluarga, $default, false); // namakeluarga
        $this->buildSearchSql($where, $this->kd_pj, $default, false); // kd_pj
        $this->buildSearchSql($where, $this->no_peserta, $default, false); // no_peserta
        $this->buildSearchSql($where, $this->kd_kel, $default, false); // kd_kel
        $this->buildSearchSql($where, $this->kd_kec, $default, false); // kd_kec
        $this->buildSearchSql($where, $this->kd_kab, $default, false); // kd_kab
        $this->buildSearchSql($where, $this->kd_prop, $default, false); // kd_prop
        $this->buildSearchSql($where, $this->pekerjaanpj, $default, false); // pekerjaanpj
        $this->buildSearchSql($where, $this->alamatpj, $default, false); // alamatpj
        $this->buildSearchSql($where, $this->kelurahanpj, $default, false); // kelurahanpj
        $this->buildSearchSql($where, $this->kecamatanpj, $default, false); // kecamatanpj
        $this->buildSearchSql($where, $this->kabupatenpj, $default, false); // kabupatenpj
        $this->buildSearchSql($where, $this->perusahaan_pasien, $default, false); // perusahaan_pasien
        $this->buildSearchSql($where, $this->suku_bangsa, $default, false); // suku_bangsa
        $this->buildSearchSql($where, $this->bahasa_pasien, $default, false); // bahasa_pasien
        $this->buildSearchSql($where, $this->cacat_fisik, $default, false); // cacat_fisik
        $this->buildSearchSql($where, $this->_email, $default, false); // email
        $this->buildSearchSql($where, $this->nip, $default, false); // nip
        $this->buildSearchSql($where, $this->propinsipj, $default, false); // propinsipj

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->id_pasien->AdvancedSearch->save(); // id_pasien
            $this->no_rkm_medis->AdvancedSearch->save(); // no_rkm_medis
            $this->nm_pasien->AdvancedSearch->save(); // nm_pasien
            $this->no_ktp->AdvancedSearch->save(); // no_ktp
            $this->jk->AdvancedSearch->save(); // jk
            $this->tmp_lahir->AdvancedSearch->save(); // tmp_lahir
            $this->tgl_lahir->AdvancedSearch->save(); // tgl_lahir
            $this->nm_ibu->AdvancedSearch->save(); // nm_ibu
            $this->alamat->AdvancedSearch->save(); // alamat
            $this->gol_darah->AdvancedSearch->save(); // gol_darah
            $this->pekerjaan->AdvancedSearch->save(); // pekerjaan
            $this->stts_nikah->AdvancedSearch->save(); // stts_nikah
            $this->agama->AdvancedSearch->save(); // agama
            $this->tgl_daftar->AdvancedSearch->save(); // tgl_daftar
            $this->no_tlp->AdvancedSearch->save(); // no_tlp
            $this->umur->AdvancedSearch->save(); // umur
            $this->pnd->AdvancedSearch->save(); // pnd
            $this->keluarga->AdvancedSearch->save(); // keluarga
            $this->namakeluarga->AdvancedSearch->save(); // namakeluarga
            $this->kd_pj->AdvancedSearch->save(); // kd_pj
            $this->no_peserta->AdvancedSearch->save(); // no_peserta
            $this->kd_kel->AdvancedSearch->save(); // kd_kel
            $this->kd_kec->AdvancedSearch->save(); // kd_kec
            $this->kd_kab->AdvancedSearch->save(); // kd_kab
            $this->kd_prop->AdvancedSearch->save(); // kd_prop
            $this->pekerjaanpj->AdvancedSearch->save(); // pekerjaanpj
            $this->alamatpj->AdvancedSearch->save(); // alamatpj
            $this->kelurahanpj->AdvancedSearch->save(); // kelurahanpj
            $this->kecamatanpj->AdvancedSearch->save(); // kecamatanpj
            $this->kabupatenpj->AdvancedSearch->save(); // kabupatenpj
            $this->perusahaan_pasien->AdvancedSearch->save(); // perusahaan_pasien
            $this->suku_bangsa->AdvancedSearch->save(); // suku_bangsa
            $this->bahasa_pasien->AdvancedSearch->save(); // bahasa_pasien
            $this->cacat_fisik->AdvancedSearch->save(); // cacat_fisik
            $this->_email->AdvancedSearch->save(); // email
            $this->nip->AdvancedSearch->save(); // nip
            $this->propinsipj->AdvancedSearch->save(); // propinsipj
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

    // Check if search parm exists
    protected function checkSearchParms()
    {
        if ($this->id_pasien->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_rkm_medis->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->nm_pasien->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_ktp->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->jk->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tmp_lahir->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tgl_lahir->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->nm_ibu->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->alamat->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->gol_darah->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->pekerjaan->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->stts_nikah->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->agama->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tgl_daftar->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_tlp->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->umur->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->pnd->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->keluarga->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->namakeluarga->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_pj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_peserta->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_kel->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_kec->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_kab->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kd_prop->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->pekerjaanpj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->alamatpj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kelurahanpj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kecamatanpj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kabupatenpj->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->perusahaan_pasien->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->suku_bangsa->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->bahasa_pasien->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->cacat_fisik->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->_email->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->nip->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->propinsipj->AdvancedSearch->issetSession()) {
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

        // Clear advanced search parameters
        $this->resetAdvancedSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all advanced search parameters
    protected function resetAdvancedSearchParms()
    {
                $this->id_pasien->AdvancedSearch->unsetSession();
                $this->no_rkm_medis->AdvancedSearch->unsetSession();
                $this->nm_pasien->AdvancedSearch->unsetSession();
                $this->no_ktp->AdvancedSearch->unsetSession();
                $this->jk->AdvancedSearch->unsetSession();
                $this->tmp_lahir->AdvancedSearch->unsetSession();
                $this->tgl_lahir->AdvancedSearch->unsetSession();
                $this->nm_ibu->AdvancedSearch->unsetSession();
                $this->alamat->AdvancedSearch->unsetSession();
                $this->gol_darah->AdvancedSearch->unsetSession();
                $this->pekerjaan->AdvancedSearch->unsetSession();
                $this->stts_nikah->AdvancedSearch->unsetSession();
                $this->agama->AdvancedSearch->unsetSession();
                $this->tgl_daftar->AdvancedSearch->unsetSession();
                $this->no_tlp->AdvancedSearch->unsetSession();
                $this->umur->AdvancedSearch->unsetSession();
                $this->pnd->AdvancedSearch->unsetSession();
                $this->keluarga->AdvancedSearch->unsetSession();
                $this->namakeluarga->AdvancedSearch->unsetSession();
                $this->kd_pj->AdvancedSearch->unsetSession();
                $this->no_peserta->AdvancedSearch->unsetSession();
                $this->kd_kel->AdvancedSearch->unsetSession();
                $this->kd_kec->AdvancedSearch->unsetSession();
                $this->kd_kab->AdvancedSearch->unsetSession();
                $this->kd_prop->AdvancedSearch->unsetSession();
                $this->pekerjaanpj->AdvancedSearch->unsetSession();
                $this->alamatpj->AdvancedSearch->unsetSession();
                $this->kelurahanpj->AdvancedSearch->unsetSession();
                $this->kecamatanpj->AdvancedSearch->unsetSession();
                $this->kabupatenpj->AdvancedSearch->unsetSession();
                $this->perusahaan_pasien->AdvancedSearch->unsetSession();
                $this->suku_bangsa->AdvancedSearch->unsetSession();
                $this->bahasa_pasien->AdvancedSearch->unsetSession();
                $this->cacat_fisik->AdvancedSearch->unsetSession();
                $this->_email->AdvancedSearch->unsetSession();
                $this->nip->AdvancedSearch->unsetSession();
                $this->propinsipj->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore advanced search values
                $this->id_pasien->AdvancedSearch->load();
                $this->no_rkm_medis->AdvancedSearch->load();
                $this->nm_pasien->AdvancedSearch->load();
                $this->no_ktp->AdvancedSearch->load();
                $this->jk->AdvancedSearch->load();
                $this->tmp_lahir->AdvancedSearch->load();
                $this->tgl_lahir->AdvancedSearch->load();
                $this->nm_ibu->AdvancedSearch->load();
                $this->alamat->AdvancedSearch->load();
                $this->gol_darah->AdvancedSearch->load();
                $this->pekerjaan->AdvancedSearch->load();
                $this->stts_nikah->AdvancedSearch->load();
                $this->agama->AdvancedSearch->load();
                $this->tgl_daftar->AdvancedSearch->load();
                $this->no_tlp->AdvancedSearch->load();
                $this->umur->AdvancedSearch->load();
                $this->pnd->AdvancedSearch->load();
                $this->keluarga->AdvancedSearch->load();
                $this->namakeluarga->AdvancedSearch->load();
                $this->kd_pj->AdvancedSearch->load();
                $this->no_peserta->AdvancedSearch->load();
                $this->kd_kel->AdvancedSearch->load();
                $this->kd_kec->AdvancedSearch->load();
                $this->kd_kab->AdvancedSearch->load();
                $this->kd_prop->AdvancedSearch->load();
                $this->pekerjaanpj->AdvancedSearch->load();
                $this->alamatpj->AdvancedSearch->load();
                $this->kelurahanpj->AdvancedSearch->load();
                $this->kecamatanpj->AdvancedSearch->load();
                $this->kabupatenpj->AdvancedSearch->load();
                $this->perusahaan_pasien->AdvancedSearch->load();
                $this->suku_bangsa->AdvancedSearch->load();
                $this->bahasa_pasien->AdvancedSearch->load();
                $this->cacat_fisik->AdvancedSearch->load();
                $this->_email->AdvancedSearch->load();
                $this->nip->AdvancedSearch->load();
                $this->propinsipj->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->no_rkm_medis); // no_rkm_medis
            $this->updateSort($this->nm_pasien); // nm_pasien
            $this->updateSort($this->jk); // jk
            $this->updateSort($this->nm_ibu); // nm_ibu
            $this->updateSort($this->alamat); // alamat
            $this->updateSort($this->tgl_daftar); // tgl_daftar
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "`tgl_daftar` DESC";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($this->tgl_daftar->getSort() != "") {
                    $useDefaultSort = false;
                }
                if ($useDefaultSort) {
                    $this->tgl_daftar->setSort("DESC");
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
                $this->no_rkm_medis->setSort("");
                $this->nm_pasien->setSort("");
                $this->no_ktp->setSort("");
                $this->jk->setSort("");
                $this->tmp_lahir->setSort("");
                $this->tgl_lahir->setSort("");
                $this->nm_ibu->setSort("");
                $this->alamat->setSort("");
                $this->gol_darah->setSort("");
                $this->pekerjaan->setSort("");
                $this->stts_nikah->setSort("");
                $this->agama->setSort("");
                $this->tgl_daftar->setSort("");
                $this->no_tlp->setSort("");
                $this->umur->setSort("");
                $this->pnd->setSort("");
                $this->keluarga->setSort("");
                $this->namakeluarga->setSort("");
                $this->kd_pj->setSort("");
                $this->no_peserta->setSort("");
                $this->kd_kel->setSort("");
                $this->kd_kec->setSort("");
                $this->kd_kab->setSort("");
                $this->kd_prop->setSort("");
                $this->pekerjaanpj->setSort("");
                $this->alamatpj->setSort("");
                $this->kelurahanpj->setSort("");
                $this->kecamatanpj->setSort("");
                $this->kabupatenpj->setSort("");
                $this->perusahaan_pasien->setSort("");
                $this->suku_bangsa->setSort("");
                $this->bahasa_pasien->setSort("");
                $this->cacat_fisik->setSort("");
                $this->_email->setSort("");
                $this->nip->setSort("");
                $this->propinsipj->setSort("");
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
                if (IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"m_pasien\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->ViewUrl)) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
                }
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fm_pasienlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fm_pasienlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fm_pasienlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // id_pasien
        if (!$this->isAddOrEdit() && $this->id_pasien->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_pasien->AdvancedSearch->SearchValue != "" || $this->id_pasien->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // nm_pasien
        if (!$this->isAddOrEdit() && $this->nm_pasien->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->nm_pasien->AdvancedSearch->SearchValue != "" || $this->nm_pasien->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // no_ktp
        if (!$this->isAddOrEdit() && $this->no_ktp->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_ktp->AdvancedSearch->SearchValue != "" || $this->no_ktp->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // jk
        if (!$this->isAddOrEdit() && $this->jk->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->jk->AdvancedSearch->SearchValue != "" || $this->jk->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tmp_lahir
        if (!$this->isAddOrEdit() && $this->tmp_lahir->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tmp_lahir->AdvancedSearch->SearchValue != "" || $this->tmp_lahir->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tgl_lahir
        if (!$this->isAddOrEdit() && $this->tgl_lahir->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tgl_lahir->AdvancedSearch->SearchValue != "" || $this->tgl_lahir->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // nm_ibu
        if (!$this->isAddOrEdit() && $this->nm_ibu->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->nm_ibu->AdvancedSearch->SearchValue != "" || $this->nm_ibu->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // alamat
        if (!$this->isAddOrEdit() && $this->alamat->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->alamat->AdvancedSearch->SearchValue != "" || $this->alamat->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // gol_darah
        if (!$this->isAddOrEdit() && $this->gol_darah->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->gol_darah->AdvancedSearch->SearchValue != "" || $this->gol_darah->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // pekerjaan
        if (!$this->isAddOrEdit() && $this->pekerjaan->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->pekerjaan->AdvancedSearch->SearchValue != "" || $this->pekerjaan->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // stts_nikah
        if (!$this->isAddOrEdit() && $this->stts_nikah->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->stts_nikah->AdvancedSearch->SearchValue != "" || $this->stts_nikah->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // agama
        if (!$this->isAddOrEdit() && $this->agama->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->agama->AdvancedSearch->SearchValue != "" || $this->agama->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tgl_daftar
        if (!$this->isAddOrEdit() && $this->tgl_daftar->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tgl_daftar->AdvancedSearch->SearchValue != "" || $this->tgl_daftar->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // no_tlp
        if (!$this->isAddOrEdit() && $this->no_tlp->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_tlp->AdvancedSearch->SearchValue != "" || $this->no_tlp->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // umur
        if (!$this->isAddOrEdit() && $this->umur->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->umur->AdvancedSearch->SearchValue != "" || $this->umur->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // pnd
        if (!$this->isAddOrEdit() && $this->pnd->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->pnd->AdvancedSearch->SearchValue != "" || $this->pnd->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // keluarga
        if (!$this->isAddOrEdit() && $this->keluarga->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->keluarga->AdvancedSearch->SearchValue != "" || $this->keluarga->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // namakeluarga
        if (!$this->isAddOrEdit() && $this->namakeluarga->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->namakeluarga->AdvancedSearch->SearchValue != "" || $this->namakeluarga->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // no_peserta
        if (!$this->isAddOrEdit() && $this->no_peserta->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_peserta->AdvancedSearch->SearchValue != "" || $this->no_peserta->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kd_kel
        if (!$this->isAddOrEdit() && $this->kd_kel->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kd_kel->AdvancedSearch->SearchValue != "" || $this->kd_kel->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kd_kec
        if (!$this->isAddOrEdit() && $this->kd_kec->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kd_kec->AdvancedSearch->SearchValue != "" || $this->kd_kec->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kd_kab
        if (!$this->isAddOrEdit() && $this->kd_kab->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kd_kab->AdvancedSearch->SearchValue != "" || $this->kd_kab->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kd_prop
        if (!$this->isAddOrEdit() && $this->kd_prop->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kd_prop->AdvancedSearch->SearchValue != "" || $this->kd_prop->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // pekerjaanpj
        if (!$this->isAddOrEdit() && $this->pekerjaanpj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->pekerjaanpj->AdvancedSearch->SearchValue != "" || $this->pekerjaanpj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // alamatpj
        if (!$this->isAddOrEdit() && $this->alamatpj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->alamatpj->AdvancedSearch->SearchValue != "" || $this->alamatpj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kelurahanpj
        if (!$this->isAddOrEdit() && $this->kelurahanpj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kelurahanpj->AdvancedSearch->SearchValue != "" || $this->kelurahanpj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kecamatanpj
        if (!$this->isAddOrEdit() && $this->kecamatanpj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kecamatanpj->AdvancedSearch->SearchValue != "" || $this->kecamatanpj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kabupatenpj
        if (!$this->isAddOrEdit() && $this->kabupatenpj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kabupatenpj->AdvancedSearch->SearchValue != "" || $this->kabupatenpj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // perusahaan_pasien
        if (!$this->isAddOrEdit() && $this->perusahaan_pasien->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->perusahaan_pasien->AdvancedSearch->SearchValue != "" || $this->perusahaan_pasien->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // suku_bangsa
        if (!$this->isAddOrEdit() && $this->suku_bangsa->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->suku_bangsa->AdvancedSearch->SearchValue != "" || $this->suku_bangsa->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // bahasa_pasien
        if (!$this->isAddOrEdit() && $this->bahasa_pasien->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->bahasa_pasien->AdvancedSearch->SearchValue != "" || $this->bahasa_pasien->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // cacat_fisik
        if (!$this->isAddOrEdit() && $this->cacat_fisik->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->cacat_fisik->AdvancedSearch->SearchValue != "" || $this->cacat_fisik->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // email
        if (!$this->isAddOrEdit() && $this->_email->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->_email->AdvancedSearch->SearchValue != "" || $this->_email->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // nip
        if (!$this->isAddOrEdit() && $this->nip->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->nip->AdvancedSearch->SearchValue != "" || $this->nip->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // propinsipj
        if (!$this->isAddOrEdit() && $this->propinsipj->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->propinsipj->AdvancedSearch->SearchValue != "" || $this->propinsipj->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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
        $this->id_pasien->setDbValue($row['id_pasien']);
        $this->no_rkm_medis->setDbValue($row['no_rkm_medis']);
        $this->nm_pasien->setDbValue($row['nm_pasien']);
        $this->no_ktp->setDbValue($row['no_ktp']);
        $this->jk->setDbValue($row['jk']);
        $this->tmp_lahir->setDbValue($row['tmp_lahir']);
        $this->tgl_lahir->setDbValue($row['tgl_lahir']);
        $this->nm_ibu->setDbValue($row['nm_ibu']);
        $this->alamat->setDbValue($row['alamat']);
        $this->gol_darah->setDbValue($row['gol_darah']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->stts_nikah->setDbValue($row['stts_nikah']);
        $this->agama->setDbValue($row['agama']);
        $this->tgl_daftar->setDbValue($row['tgl_daftar']);
        $this->no_tlp->setDbValue($row['no_tlp']);
        $this->umur->setDbValue($row['umur']);
        $this->pnd->setDbValue($row['pnd']);
        $this->keluarga->setDbValue($row['keluarga']);
        $this->namakeluarga->setDbValue($row['namakeluarga']);
        $this->kd_pj->setDbValue($row['kd_pj']);
        $this->no_peserta->setDbValue($row['no_peserta']);
        $this->kd_kel->setDbValue($row['kd_kel']);
        $this->kd_kec->setDbValue($row['kd_kec']);
        $this->kd_kab->setDbValue($row['kd_kab']);
        $this->kd_prop->setDbValue($row['kd_prop']);
        $this->pekerjaanpj->setDbValue($row['pekerjaanpj']);
        $this->alamatpj->setDbValue($row['alamatpj']);
        $this->kelurahanpj->setDbValue($row['kelurahanpj']);
        $this->kecamatanpj->setDbValue($row['kecamatanpj']);
        $this->kabupatenpj->setDbValue($row['kabupatenpj']);
        $this->perusahaan_pasien->setDbValue($row['perusahaan_pasien']);
        $this->suku_bangsa->setDbValue($row['suku_bangsa']);
        $this->bahasa_pasien->setDbValue($row['bahasa_pasien']);
        $this->cacat_fisik->setDbValue($row['cacat_fisik']);
        $this->_email->setDbValue($row['email']);
        $this->nip->setDbValue($row['nip']);
        $this->propinsipj->setDbValue($row['propinsipj']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_pasien'] = null;
        $row['no_rkm_medis'] = null;
        $row['nm_pasien'] = null;
        $row['no_ktp'] = null;
        $row['jk'] = null;
        $row['tmp_lahir'] = null;
        $row['tgl_lahir'] = null;
        $row['nm_ibu'] = null;
        $row['alamat'] = null;
        $row['gol_darah'] = null;
        $row['pekerjaan'] = null;
        $row['stts_nikah'] = null;
        $row['agama'] = null;
        $row['tgl_daftar'] = null;
        $row['no_tlp'] = null;
        $row['umur'] = null;
        $row['pnd'] = null;
        $row['keluarga'] = null;
        $row['namakeluarga'] = null;
        $row['kd_pj'] = null;
        $row['no_peserta'] = null;
        $row['kd_kel'] = null;
        $row['kd_kec'] = null;
        $row['kd_kab'] = null;
        $row['kd_prop'] = null;
        $row['pekerjaanpj'] = null;
        $row['alamatpj'] = null;
        $row['kelurahanpj'] = null;
        $row['kecamatanpj'] = null;
        $row['kabupatenpj'] = null;
        $row['perusahaan_pasien'] = null;
        $row['suku_bangsa'] = null;
        $row['bahasa_pasien'] = null;
        $row['cacat_fisik'] = null;
        $row['email'] = null;
        $row['nip'] = null;
        $row['propinsipj'] = null;
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
        $this->id_pasien->CellCssStyle = "white-space: nowrap;";

        // no_rkm_medis
        $this->no_rkm_medis->CellCssStyle = "white-space: nowrap;";

        // nm_pasien
        $this->nm_pasien->CellCssStyle = "white-space: nowrap;";

        // no_ktp
        $this->no_ktp->CellCssStyle = "white-space: nowrap;";

        // jk
        $this->jk->CellCssStyle = "white-space: nowrap;";

        // tmp_lahir
        $this->tmp_lahir->CellCssStyle = "white-space: nowrap;";

        // tgl_lahir
        $this->tgl_lahir->CellCssStyle = "white-space: nowrap;";

        // nm_ibu
        $this->nm_ibu->CellCssStyle = "white-space: nowrap;";

        // alamat
        $this->alamat->CellCssStyle = "white-space: nowrap;";

        // gol_darah
        $this->gol_darah->CellCssStyle = "white-space: nowrap;";

        // pekerjaan
        $this->pekerjaan->CellCssStyle = "white-space: nowrap;";

        // stts_nikah
        $this->stts_nikah->CellCssStyle = "white-space: nowrap;";

        // agama
        $this->agama->CellCssStyle = "white-space: nowrap;";

        // tgl_daftar
        $this->tgl_daftar->CellCssStyle = "white-space: nowrap;";

        // no_tlp
        $this->no_tlp->CellCssStyle = "white-space: nowrap;";

        // umur
        $this->umur->CellCssStyle = "white-space: nowrap;";

        // pnd
        $this->pnd->CellCssStyle = "white-space: nowrap;";

        // keluarga
        $this->keluarga->CellCssStyle = "white-space: nowrap;";

        // namakeluarga
        $this->namakeluarga->CellCssStyle = "white-space: nowrap;";

        // kd_pj
        $this->kd_pj->CellCssStyle = "white-space: nowrap;";

        // no_peserta
        $this->no_peserta->CellCssStyle = "white-space: nowrap;";

        // kd_kel
        $this->kd_kel->CellCssStyle = "white-space: nowrap;";

        // kd_kec
        $this->kd_kec->CellCssStyle = "white-space: nowrap;";

        // kd_kab
        $this->kd_kab->CellCssStyle = "white-space: nowrap;";

        // kd_prop
        $this->kd_prop->CellCssStyle = "white-space: nowrap;";

        // pekerjaanpj
        $this->pekerjaanpj->CellCssStyle = "white-space: nowrap;";

        // alamatpj
        $this->alamatpj->CellCssStyle = "white-space: nowrap;";

        // kelurahanpj
        $this->kelurahanpj->CellCssStyle = "white-space: nowrap;";

        // kecamatanpj
        $this->kecamatanpj->CellCssStyle = "white-space: nowrap;";

        // kabupatenpj
        $this->kabupatenpj->CellCssStyle = "white-space: nowrap;";

        // perusahaan_pasien
        $this->perusahaan_pasien->CellCssStyle = "white-space: nowrap;";

        // suku_bangsa
        $this->suku_bangsa->CellCssStyle = "white-space: nowrap;";

        // bahasa_pasien
        $this->bahasa_pasien->CellCssStyle = "white-space: nowrap;";

        // cacat_fisik
        $this->cacat_fisik->CellCssStyle = "white-space: nowrap;";

        // email
        $this->_email->CellCssStyle = "white-space: nowrap;";

        // nip
        $this->nip->CellCssStyle = "white-space: nowrap;";

        // propinsipj
        $this->propinsipj->CellCssStyle = "white-space: nowrap;";
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_pasien
            $this->id_pasien->ViewValue = $this->id_pasien->CurrentValue;
            $this->id_pasien->ViewCustomAttributes = "";

            // no_rkm_medis
            $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->CurrentValue;
            $this->no_rkm_medis->ViewCustomAttributes = "";

            // nm_pasien
            $this->nm_pasien->ViewValue = $this->nm_pasien->CurrentValue;
            $this->nm_pasien->ViewCustomAttributes = "";

            // no_ktp
            $this->no_ktp->ViewValue = $this->no_ktp->CurrentValue;
            $this->no_ktp->ViewCustomAttributes = "";

            // jk
            if (strval($this->jk->CurrentValue) != "") {
                $this->jk->ViewValue = $this->jk->optionCaption($this->jk->CurrentValue);
            } else {
                $this->jk->ViewValue = null;
            }
            $this->jk->ViewCustomAttributes = "";

            // tmp_lahir
            $this->tmp_lahir->ViewValue = $this->tmp_lahir->CurrentValue;
            $this->tmp_lahir->ViewCustomAttributes = "";

            // tgl_lahir
            $this->tgl_lahir->ViewValue = $this->tgl_lahir->CurrentValue;
            $this->tgl_lahir->ViewValue = FormatDateTime($this->tgl_lahir->ViewValue, 0);
            $this->tgl_lahir->ViewCustomAttributes = "";

            // nm_ibu
            $this->nm_ibu->ViewValue = $this->nm_ibu->CurrentValue;
            $this->nm_ibu->ViewCustomAttributes = "";

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;
            $this->alamat->ViewCustomAttributes = "";

            // gol_darah
            if (strval($this->gol_darah->CurrentValue) != "") {
                $this->gol_darah->ViewValue = $this->gol_darah->optionCaption($this->gol_darah->CurrentValue);
            } else {
                $this->gol_darah->ViewValue = null;
            }
            $this->gol_darah->ViewCustomAttributes = "";

            // pekerjaan
            $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
            $this->pekerjaan->ViewCustomAttributes = "";

            // stts_nikah
            if (strval($this->stts_nikah->CurrentValue) != "") {
                $this->stts_nikah->ViewValue = $this->stts_nikah->optionCaption($this->stts_nikah->CurrentValue);
            } else {
                $this->stts_nikah->ViewValue = null;
            }
            $this->stts_nikah->ViewCustomAttributes = "";

            // agama
            $this->agama->ViewCustomAttributes = "";

            // tgl_daftar
            $this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
            $this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
            $this->tgl_daftar->ViewCustomAttributes = "";

            // no_tlp
            $this->no_tlp->ViewValue = $this->no_tlp->CurrentValue;
            $this->no_tlp->ViewCustomAttributes = "";

            // umur
            $this->umur->ViewValue = $this->umur->CurrentValue;
            $this->umur->ViewCustomAttributes = "";

            // pnd
            if (strval($this->pnd->CurrentValue) != "") {
                $this->pnd->ViewValue = $this->pnd->optionCaption($this->pnd->CurrentValue);
            } else {
                $this->pnd->ViewValue = null;
            }
            $this->pnd->ViewCustomAttributes = "";

            // keluarga
            if (strval($this->keluarga->CurrentValue) != "") {
                $this->keluarga->ViewValue = $this->keluarga->optionCaption($this->keluarga->CurrentValue);
            } else {
                $this->keluarga->ViewValue = null;
            }
            $this->keluarga->ViewCustomAttributes = "";

            // namakeluarga
            $this->namakeluarga->ViewValue = $this->namakeluarga->CurrentValue;
            $this->namakeluarga->ViewCustomAttributes = "";

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

            // no_peserta
            $this->no_peserta->ViewValue = $this->no_peserta->CurrentValue;
            $this->no_peserta->ViewCustomAttributes = "";

            // kd_kel
            $curVal = trim(strval($this->kd_kel->CurrentValue));
            if ($curVal != "") {
                $this->kd_kel->ViewValue = $this->kd_kel->lookupCacheOption($curVal);
                if ($this->kd_kel->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kd_kel`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kd_kel->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kd_kel->Lookup->renderViewRow($rswrk[0]);
                        $this->kd_kel->ViewValue = $this->kd_kel->displayValue($arwrk);
                    } else {
                        $this->kd_kel->ViewValue = $this->kd_kel->CurrentValue;
                    }
                }
            } else {
                $this->kd_kel->ViewValue = null;
            }
            $this->kd_kel->ViewCustomAttributes = "";

            // kd_kec
            $curVal = trim(strval($this->kd_kec->CurrentValue));
            if ($curVal != "") {
                $this->kd_kec->ViewValue = $this->kd_kec->lookupCacheOption($curVal);
                if ($this->kd_kec->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kd_kec`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kd_kec->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kd_kec->Lookup->renderViewRow($rswrk[0]);
                        $this->kd_kec->ViewValue = $this->kd_kec->displayValue($arwrk);
                    } else {
                        $this->kd_kec->ViewValue = $this->kd_kec->CurrentValue;
                    }
                }
            } else {
                $this->kd_kec->ViewValue = null;
            }
            $this->kd_kec->ViewCustomAttributes = "";

            // kd_kab
            $curVal = trim(strval($this->kd_kab->CurrentValue));
            if ($curVal != "") {
                $this->kd_kab->ViewValue = $this->kd_kab->lookupCacheOption($curVal);
                if ($this->kd_kab->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kd_kab`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kd_kab->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kd_kab->Lookup->renderViewRow($rswrk[0]);
                        $this->kd_kab->ViewValue = $this->kd_kab->displayValue($arwrk);
                    } else {
                        $this->kd_kab->ViewValue = $this->kd_kab->CurrentValue;
                    }
                }
            } else {
                $this->kd_kab->ViewValue = null;
            }
            $this->kd_kab->ViewCustomAttributes = "";

            // kd_prop
            $curVal = trim(strval($this->kd_prop->CurrentValue));
            if ($curVal != "") {
                $this->kd_prop->ViewValue = $this->kd_prop->lookupCacheOption($curVal);
                if ($this->kd_prop->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kd_prop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kd_prop->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kd_prop->Lookup->renderViewRow($rswrk[0]);
                        $this->kd_prop->ViewValue = $this->kd_prop->displayValue($arwrk);
                    } else {
                        $this->kd_prop->ViewValue = $this->kd_prop->CurrentValue;
                    }
                }
            } else {
                $this->kd_prop->ViewValue = null;
            }
            $this->kd_prop->ViewCustomAttributes = "";

            // pekerjaanpj
            $this->pekerjaanpj->ViewValue = $this->pekerjaanpj->CurrentValue;
            $this->pekerjaanpj->ViewCustomAttributes = "";

            // alamatpj
            $this->alamatpj->ViewValue = $this->alamatpj->CurrentValue;
            $this->alamatpj->ViewCustomAttributes = "";

            // kelurahanpj
            $this->kelurahanpj->ViewValue = $this->kelurahanpj->CurrentValue;
            $this->kelurahanpj->ViewCustomAttributes = "";

            // kecamatanpj
            $this->kecamatanpj->ViewValue = $this->kecamatanpj->CurrentValue;
            $this->kecamatanpj->ViewCustomAttributes = "";

            // kabupatenpj
            $this->kabupatenpj->ViewValue = $this->kabupatenpj->CurrentValue;
            $this->kabupatenpj->ViewCustomAttributes = "";

            // perusahaan_pasien
            $curVal = trim(strval($this->perusahaan_pasien->CurrentValue));
            if ($curVal != "") {
                $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->lookupCacheOption($curVal);
                if ($this->perusahaan_pasien->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kode_perusahaan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->perusahaan_pasien->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->perusahaan_pasien->Lookup->renderViewRow($rswrk[0]);
                        $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->displayValue($arwrk);
                    } else {
                        $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->CurrentValue;
                    }
                }
            } else {
                $this->perusahaan_pasien->ViewValue = null;
            }
            $this->perusahaan_pasien->ViewCustomAttributes = "";

            // suku_bangsa
            $curVal = trim(strval($this->suku_bangsa->CurrentValue));
            if ($curVal != "") {
                $this->suku_bangsa->ViewValue = $this->suku_bangsa->lookupCacheOption($curVal);
                if ($this->suku_bangsa->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->suku_bangsa->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->suku_bangsa->Lookup->renderViewRow($rswrk[0]);
                        $this->suku_bangsa->ViewValue = $this->suku_bangsa->displayValue($arwrk);
                    } else {
                        $this->suku_bangsa->ViewValue = $this->suku_bangsa->CurrentValue;
                    }
                }
            } else {
                $this->suku_bangsa->ViewValue = null;
            }
            $this->suku_bangsa->ViewCustomAttributes = "";

            // bahasa_pasien
            $curVal = trim(strval($this->bahasa_pasien->CurrentValue));
            if ($curVal != "") {
                $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->lookupCacheOption($curVal);
                if ($this->bahasa_pasien->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->bahasa_pasien->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->bahasa_pasien->Lookup->renderViewRow($rswrk[0]);
                        $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->displayValue($arwrk);
                    } else {
                        $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->CurrentValue;
                    }
                }
            } else {
                $this->bahasa_pasien->ViewValue = null;
            }
            $this->bahasa_pasien->ViewCustomAttributes = "";

            // cacat_fisik
            $curVal = trim(strval($this->cacat_fisik->CurrentValue));
            if ($curVal != "") {
                $this->cacat_fisik->ViewValue = $this->cacat_fisik->lookupCacheOption($curVal);
                if ($this->cacat_fisik->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->cacat_fisik->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->cacat_fisik->Lookup->renderViewRow($rswrk[0]);
                        $this->cacat_fisik->ViewValue = $this->cacat_fisik->displayValue($arwrk);
                    } else {
                        $this->cacat_fisik->ViewValue = $this->cacat_fisik->CurrentValue;
                    }
                }
            } else {
                $this->cacat_fisik->ViewValue = null;
            }
            $this->cacat_fisik->ViewCustomAttributes = "";

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;
            $this->_email->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // propinsipj
            $this->propinsipj->ViewValue = $this->propinsipj->CurrentValue;
            $this->propinsipj->ViewCustomAttributes = "";

            // no_rkm_medis
            $this->no_rkm_medis->LinkCustomAttributes = "";
            $this->no_rkm_medis->HrefValue = "";
            $this->no_rkm_medis->TooltipValue = "";
            if (!$this->isExport()) {
                $this->no_rkm_medis->ViewValue = $this->highlightValue($this->no_rkm_medis);
            }

            // nm_pasien
            $this->nm_pasien->LinkCustomAttributes = "";
            $this->nm_pasien->HrefValue = "";
            $this->nm_pasien->TooltipValue = "";
            if (!$this->isExport()) {
                $this->nm_pasien->ViewValue = $this->highlightValue($this->nm_pasien);
            }

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";
            $this->jk->TooltipValue = "";

            // nm_ibu
            $this->nm_ibu->LinkCustomAttributes = "";
            $this->nm_ibu->HrefValue = "";
            $this->nm_ibu->TooltipValue = "";
            if (!$this->isExport()) {
                $this->nm_ibu->ViewValue = $this->highlightValue($this->nm_ibu);
            }

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";
            if (!$this->isExport()) {
                $this->alamat->ViewValue = $this->highlightValue($this->alamat);
            }

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // no_rkm_medis
            $this->no_rkm_medis->EditAttrs["class"] = "form-control";
            $this->no_rkm_medis->EditCustomAttributes = "";
            if (!$this->no_rkm_medis->Raw) {
                $this->no_rkm_medis->AdvancedSearch->SearchValue = HtmlDecode($this->no_rkm_medis->AdvancedSearch->SearchValue);
            }
            $this->no_rkm_medis->EditValue = HtmlEncode($this->no_rkm_medis->AdvancedSearch->SearchValue);
            $this->no_rkm_medis->PlaceHolder = RemoveHtml($this->no_rkm_medis->caption());

            // nm_pasien
            $this->nm_pasien->EditAttrs["class"] = "form-control";
            $this->nm_pasien->EditCustomAttributes = "";
            if (!$this->nm_pasien->Raw) {
                $this->nm_pasien->AdvancedSearch->SearchValue = HtmlDecode($this->nm_pasien->AdvancedSearch->SearchValue);
            }
            $this->nm_pasien->EditValue = HtmlEncode($this->nm_pasien->AdvancedSearch->SearchValue);
            $this->nm_pasien->PlaceHolder = RemoveHtml($this->nm_pasien->caption());

            // jk
            $this->jk->EditCustomAttributes = "";
            $this->jk->EditValue = $this->jk->options(false);
            $this->jk->PlaceHolder = RemoveHtml($this->jk->caption());

            // nm_ibu
            $this->nm_ibu->EditAttrs["class"] = "form-control";
            $this->nm_ibu->EditCustomAttributes = "";
            if (!$this->nm_ibu->Raw) {
                $this->nm_ibu->AdvancedSearch->SearchValue = HtmlDecode($this->nm_ibu->AdvancedSearch->SearchValue);
            }
            $this->nm_ibu->EditValue = HtmlEncode($this->nm_ibu->AdvancedSearch->SearchValue);
            $this->nm_ibu->PlaceHolder = RemoveHtml($this->nm_ibu->caption());

            // alamat
            $this->alamat->EditAttrs["class"] = "form-control";
            $this->alamat->EditCustomAttributes = "";
            if (!$this->alamat->Raw) {
                $this->alamat->AdvancedSearch->SearchValue = HtmlDecode($this->alamat->AdvancedSearch->SearchValue);
            }
            $this->alamat->EditValue = HtmlEncode($this->alamat->AdvancedSearch->SearchValue);
            $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

            // tgl_daftar
            $this->tgl_daftar->EditAttrs["class"] = "form-control";
            $this->tgl_daftar->EditCustomAttributes = "";
            $this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_daftar->AdvancedSearch->SearchValue, 0), 8));
            $this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());
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
        $this->id_pasien->AdvancedSearch->load();
        $this->no_rkm_medis->AdvancedSearch->load();
        $this->nm_pasien->AdvancedSearch->load();
        $this->no_ktp->AdvancedSearch->load();
        $this->jk->AdvancedSearch->load();
        $this->tmp_lahir->AdvancedSearch->load();
        $this->tgl_lahir->AdvancedSearch->load();
        $this->nm_ibu->AdvancedSearch->load();
        $this->alamat->AdvancedSearch->load();
        $this->gol_darah->AdvancedSearch->load();
        $this->pekerjaan->AdvancedSearch->load();
        $this->stts_nikah->AdvancedSearch->load();
        $this->agama->AdvancedSearch->load();
        $this->tgl_daftar->AdvancedSearch->load();
        $this->no_tlp->AdvancedSearch->load();
        $this->umur->AdvancedSearch->load();
        $this->pnd->AdvancedSearch->load();
        $this->keluarga->AdvancedSearch->load();
        $this->namakeluarga->AdvancedSearch->load();
        $this->kd_pj->AdvancedSearch->load();
        $this->no_peserta->AdvancedSearch->load();
        $this->kd_kel->AdvancedSearch->load();
        $this->kd_kec->AdvancedSearch->load();
        $this->kd_kab->AdvancedSearch->load();
        $this->kd_prop->AdvancedSearch->load();
        $this->pekerjaanpj->AdvancedSearch->load();
        $this->alamatpj->AdvancedSearch->load();
        $this->kelurahanpj->AdvancedSearch->load();
        $this->kecamatanpj->AdvancedSearch->load();
        $this->kabupatenpj->AdvancedSearch->load();
        $this->perusahaan_pasien->AdvancedSearch->load();
        $this->suku_bangsa->AdvancedSearch->load();
        $this->bahasa_pasien->AdvancedSearch->load();
        $this->cacat_fisik->AdvancedSearch->load();
        $this->_email->AdvancedSearch->load();
        $this->nip->AdvancedSearch->load();
        $this->propinsipj->AdvancedSearch->load();
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fm_pasienlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fm_pasienlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fm_pasienlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_m_pasien" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_m_pasien\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fm_pasienlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fm_pasienlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Search highlight button
        $item = &$this->SearchOptions->add("searchhighlight");
        $item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fm_pasienlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != "" && $this->TotalRecords > 0);

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
                case "x_jk":
                    break;
                case "x_gol_darah":
                    break;
                case "x_stts_nikah":
                    break;
                case "x_pnd":
                    break;
                case "x_keluarga":
                    break;
                case "x_kd_pj":
                    break;
                case "x_kd_kel":
                    break;
                case "x_kd_kec":
                    break;
                case "x_kd_kab":
                    break;
                case "x_kd_prop":
                    break;
                case "x_perusahaan_pasien":
                    break;
                case "x_suku_bangsa":
                    break;
                case "x_bahasa_pasien":
                    break;
                case "x_cacat_fisik":
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
