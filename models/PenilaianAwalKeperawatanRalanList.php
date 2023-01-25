<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianAwalKeperawatanRalanList extends PenilaianAwalKeperawatanRalan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_awal_keperawatan_ralan';

    // Page object name
    public $PageObjName = "PenilaianAwalKeperawatanRalanList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpenilaian_awal_keperawatan_ralanlist";
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

        // Table object (penilaian_awal_keperawatan_ralan)
        if (!isset($GLOBALS["penilaian_awal_keperawatan_ralan"]) || get_class($GLOBALS["penilaian_awal_keperawatan_ralan"]) == PROJECT_NAMESPACE . "penilaian_awal_keperawatan_ralan") {
            $GLOBALS["penilaian_awal_keperawatan_ralan"] = &$this;
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
        $this->AddUrl = "PenilaianAwalKeperawatanRalanAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "PenilaianAwalKeperawatanRalanDelete";
        $this->MultiUpdateUrl = "PenilaianAwalKeperawatanRalanUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penilaian_awal_keperawatan_ralan');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fpenilaian_awal_keperawatan_ralanlistsrch";

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
                $doc = new $class(Container("penilaian_awal_keperawatan_ralan"));
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
            $key .= @$ar['id_penilaian_awal_keperawatan'];
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
        if ($this->isAddOrEdit()) {
            $this->tanggal->Visible = false;
        }
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id_penilaian_awal_keperawatan->Visible = false;
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
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->informasi->setVisibility();
        $this->td->Visible = false;
        $this->nadi->Visible = false;
        $this->rr->Visible = false;
        $this->suhu->Visible = false;
        $this->gcs->Visible = false;
        $this->bb->Visible = false;
        $this->tb->Visible = false;
        $this->bmi->Visible = false;
        $this->keluhan_utama->Visible = false;
        $this->rpd->Visible = false;
        $this->rpk->Visible = false;
        $this->rpo->Visible = false;
        $this->alergi->Visible = false;
        $this->alat_bantu->Visible = false;
        $this->ket_bantu->Visible = false;
        $this->prothesa->Visible = false;
        $this->ket_pro->Visible = false;
        $this->adl->Visible = false;
        $this->status_psiko->Visible = false;
        $this->ket_psiko->Visible = false;
        $this->hub_keluarga->Visible = false;
        $this->tinggal_dengan->Visible = false;
        $this->ket_tinggal->Visible = false;
        $this->ekonomi->Visible = false;
        $this->budaya->Visible = false;
        $this->ket_budaya->Visible = false;
        $this->edukasi->Visible = false;
        $this->ket_edukasi->Visible = false;
        $this->berjalan_a->Visible = false;
        $this->berjalan_b->Visible = false;
        $this->berjalan_c->Visible = false;
        $this->hasil->Visible = false;
        $this->lapor->Visible = false;
        $this->ket_lapor->Visible = false;
        $this->sg1->Visible = false;
        $this->nilai1->Visible = false;
        $this->sg2->Visible = false;
        $this->nilai2->Visible = false;
        $this->total_hasil->Visible = false;
        $this->nyeri->Visible = false;
        $this->provokes->Visible = false;
        $this->ket_provokes->Visible = false;
        $this->quality->Visible = false;
        $this->ket_quality->Visible = false;
        $this->lokasi->Visible = false;
        $this->menyebar->Visible = false;
        $this->skala_nyeri->Visible = false;
        $this->durasi->Visible = false;
        $this->nyeri_hilang->Visible = false;
        $this->ket_nyeri->Visible = false;
        $this->pada_dokter->Visible = false;
        $this->ket_dokter->Visible = false;
        $this->rencana->Visible = false;
        $this->nip->Visible = false;
        $this->id_penilaian_awal_keperawatan->Visible = false;
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up master detail parameters
        $this->setupMasterParms();

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

        // Restore master/detail filter
        $this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Load master record
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "vigd") {
            $masterTbl = Container("vigd");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("VigdList"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Load master record
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "vrajal") {
            $masterTbl = Container("vrajal");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("VrajalList"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

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
        $filterList = Concat($filterList, $this->no_rawat->AdvancedSearch->toJson(), ","); // Field no_rawat
        $filterList = Concat($filterList, $this->tanggal->AdvancedSearch->toJson(), ","); // Field tanggal
        $filterList = Concat($filterList, $this->informasi->AdvancedSearch->toJson(), ","); // Field informasi
        $filterList = Concat($filterList, $this->td->AdvancedSearch->toJson(), ","); // Field td
        $filterList = Concat($filterList, $this->nadi->AdvancedSearch->toJson(), ","); // Field nadi
        $filterList = Concat($filterList, $this->rr->AdvancedSearch->toJson(), ","); // Field rr
        $filterList = Concat($filterList, $this->suhu->AdvancedSearch->toJson(), ","); // Field suhu
        $filterList = Concat($filterList, $this->gcs->AdvancedSearch->toJson(), ","); // Field gcs
        $filterList = Concat($filterList, $this->bb->AdvancedSearch->toJson(), ","); // Field bb
        $filterList = Concat($filterList, $this->tb->AdvancedSearch->toJson(), ","); // Field tb
        $filterList = Concat($filterList, $this->bmi->AdvancedSearch->toJson(), ","); // Field bmi
        $filterList = Concat($filterList, $this->keluhan_utama->AdvancedSearch->toJson(), ","); // Field keluhan_utama
        $filterList = Concat($filterList, $this->rpd->AdvancedSearch->toJson(), ","); // Field rpd
        $filterList = Concat($filterList, $this->rpk->AdvancedSearch->toJson(), ","); // Field rpk
        $filterList = Concat($filterList, $this->rpo->AdvancedSearch->toJson(), ","); // Field rpo
        $filterList = Concat($filterList, $this->alergi->AdvancedSearch->toJson(), ","); // Field alergi
        $filterList = Concat($filterList, $this->alat_bantu->AdvancedSearch->toJson(), ","); // Field alat_bantu
        $filterList = Concat($filterList, $this->ket_bantu->AdvancedSearch->toJson(), ","); // Field ket_bantu
        $filterList = Concat($filterList, $this->prothesa->AdvancedSearch->toJson(), ","); // Field prothesa
        $filterList = Concat($filterList, $this->ket_pro->AdvancedSearch->toJson(), ","); // Field ket_pro
        $filterList = Concat($filterList, $this->adl->AdvancedSearch->toJson(), ","); // Field adl
        $filterList = Concat($filterList, $this->status_psiko->AdvancedSearch->toJson(), ","); // Field status_psiko
        $filterList = Concat($filterList, $this->ket_psiko->AdvancedSearch->toJson(), ","); // Field ket_psiko
        $filterList = Concat($filterList, $this->hub_keluarga->AdvancedSearch->toJson(), ","); // Field hub_keluarga
        $filterList = Concat($filterList, $this->tinggal_dengan->AdvancedSearch->toJson(), ","); // Field tinggal_dengan
        $filterList = Concat($filterList, $this->ket_tinggal->AdvancedSearch->toJson(), ","); // Field ket_tinggal
        $filterList = Concat($filterList, $this->ekonomi->AdvancedSearch->toJson(), ","); // Field ekonomi
        $filterList = Concat($filterList, $this->budaya->AdvancedSearch->toJson(), ","); // Field budaya
        $filterList = Concat($filterList, $this->ket_budaya->AdvancedSearch->toJson(), ","); // Field ket_budaya
        $filterList = Concat($filterList, $this->edukasi->AdvancedSearch->toJson(), ","); // Field edukasi
        $filterList = Concat($filterList, $this->ket_edukasi->AdvancedSearch->toJson(), ","); // Field ket_edukasi
        $filterList = Concat($filterList, $this->berjalan_a->AdvancedSearch->toJson(), ","); // Field berjalan_a
        $filterList = Concat($filterList, $this->berjalan_b->AdvancedSearch->toJson(), ","); // Field berjalan_b
        $filterList = Concat($filterList, $this->berjalan_c->AdvancedSearch->toJson(), ","); // Field berjalan_c
        $filterList = Concat($filterList, $this->hasil->AdvancedSearch->toJson(), ","); // Field hasil
        $filterList = Concat($filterList, $this->lapor->AdvancedSearch->toJson(), ","); // Field lapor
        $filterList = Concat($filterList, $this->ket_lapor->AdvancedSearch->toJson(), ","); // Field ket_lapor
        $filterList = Concat($filterList, $this->sg1->AdvancedSearch->toJson(), ","); // Field sg1
        $filterList = Concat($filterList, $this->nilai1->AdvancedSearch->toJson(), ","); // Field nilai1
        $filterList = Concat($filterList, $this->sg2->AdvancedSearch->toJson(), ","); // Field sg2
        $filterList = Concat($filterList, $this->nilai2->AdvancedSearch->toJson(), ","); // Field nilai2
        $filterList = Concat($filterList, $this->total_hasil->AdvancedSearch->toJson(), ","); // Field total_hasil
        $filterList = Concat($filterList, $this->nyeri->AdvancedSearch->toJson(), ","); // Field nyeri
        $filterList = Concat($filterList, $this->provokes->AdvancedSearch->toJson(), ","); // Field provokes
        $filterList = Concat($filterList, $this->ket_provokes->AdvancedSearch->toJson(), ","); // Field ket_provokes
        $filterList = Concat($filterList, $this->quality->AdvancedSearch->toJson(), ","); // Field quality
        $filterList = Concat($filterList, $this->ket_quality->AdvancedSearch->toJson(), ","); // Field ket_quality
        $filterList = Concat($filterList, $this->lokasi->AdvancedSearch->toJson(), ","); // Field lokasi
        $filterList = Concat($filterList, $this->menyebar->AdvancedSearch->toJson(), ","); // Field menyebar
        $filterList = Concat($filterList, $this->skala_nyeri->AdvancedSearch->toJson(), ","); // Field skala_nyeri
        $filterList = Concat($filterList, $this->durasi->AdvancedSearch->toJson(), ","); // Field durasi
        $filterList = Concat($filterList, $this->nyeri_hilang->AdvancedSearch->toJson(), ","); // Field nyeri_hilang
        $filterList = Concat($filterList, $this->ket_nyeri->AdvancedSearch->toJson(), ","); // Field ket_nyeri
        $filterList = Concat($filterList, $this->pada_dokter->AdvancedSearch->toJson(), ","); // Field pada_dokter
        $filterList = Concat($filterList, $this->ket_dokter->AdvancedSearch->toJson(), ","); // Field ket_dokter
        $filterList = Concat($filterList, $this->rencana->AdvancedSearch->toJson(), ","); // Field rencana
        $filterList = Concat($filterList, $this->nip->AdvancedSearch->toJson(), ","); // Field nip
        $filterList = Concat($filterList, $this->id_penilaian_awal_keperawatan->AdvancedSearch->toJson(), ","); // Field id_penilaian_awal_keperawatan
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fpenilaian_awal_keperawatan_ralanlistsrch", $filters);
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

        // Field informasi
        $this->informasi->AdvancedSearch->SearchValue = @$filter["x_informasi"];
        $this->informasi->AdvancedSearch->SearchOperator = @$filter["z_informasi"];
        $this->informasi->AdvancedSearch->SearchCondition = @$filter["v_informasi"];
        $this->informasi->AdvancedSearch->SearchValue2 = @$filter["y_informasi"];
        $this->informasi->AdvancedSearch->SearchOperator2 = @$filter["w_informasi"];
        $this->informasi->AdvancedSearch->save();

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

        // Field gcs
        $this->gcs->AdvancedSearch->SearchValue = @$filter["x_gcs"];
        $this->gcs->AdvancedSearch->SearchOperator = @$filter["z_gcs"];
        $this->gcs->AdvancedSearch->SearchCondition = @$filter["v_gcs"];
        $this->gcs->AdvancedSearch->SearchValue2 = @$filter["y_gcs"];
        $this->gcs->AdvancedSearch->SearchOperator2 = @$filter["w_gcs"];
        $this->gcs->AdvancedSearch->save();

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

        // Field bmi
        $this->bmi->AdvancedSearch->SearchValue = @$filter["x_bmi"];
        $this->bmi->AdvancedSearch->SearchOperator = @$filter["z_bmi"];
        $this->bmi->AdvancedSearch->SearchCondition = @$filter["v_bmi"];
        $this->bmi->AdvancedSearch->SearchValue2 = @$filter["y_bmi"];
        $this->bmi->AdvancedSearch->SearchOperator2 = @$filter["w_bmi"];
        $this->bmi->AdvancedSearch->save();

        // Field keluhan_utama
        $this->keluhan_utama->AdvancedSearch->SearchValue = @$filter["x_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchOperator = @$filter["z_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchCondition = @$filter["v_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchValue2 = @$filter["y_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchOperator2 = @$filter["w_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->save();

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

        // Field alat_bantu
        $this->alat_bantu->AdvancedSearch->SearchValue = @$filter["x_alat_bantu"];
        $this->alat_bantu->AdvancedSearch->SearchOperator = @$filter["z_alat_bantu"];
        $this->alat_bantu->AdvancedSearch->SearchCondition = @$filter["v_alat_bantu"];
        $this->alat_bantu->AdvancedSearch->SearchValue2 = @$filter["y_alat_bantu"];
        $this->alat_bantu->AdvancedSearch->SearchOperator2 = @$filter["w_alat_bantu"];
        $this->alat_bantu->AdvancedSearch->save();

        // Field ket_bantu
        $this->ket_bantu->AdvancedSearch->SearchValue = @$filter["x_ket_bantu"];
        $this->ket_bantu->AdvancedSearch->SearchOperator = @$filter["z_ket_bantu"];
        $this->ket_bantu->AdvancedSearch->SearchCondition = @$filter["v_ket_bantu"];
        $this->ket_bantu->AdvancedSearch->SearchValue2 = @$filter["y_ket_bantu"];
        $this->ket_bantu->AdvancedSearch->SearchOperator2 = @$filter["w_ket_bantu"];
        $this->ket_bantu->AdvancedSearch->save();

        // Field prothesa
        $this->prothesa->AdvancedSearch->SearchValue = @$filter["x_prothesa"];
        $this->prothesa->AdvancedSearch->SearchOperator = @$filter["z_prothesa"];
        $this->prothesa->AdvancedSearch->SearchCondition = @$filter["v_prothesa"];
        $this->prothesa->AdvancedSearch->SearchValue2 = @$filter["y_prothesa"];
        $this->prothesa->AdvancedSearch->SearchOperator2 = @$filter["w_prothesa"];
        $this->prothesa->AdvancedSearch->save();

        // Field ket_pro
        $this->ket_pro->AdvancedSearch->SearchValue = @$filter["x_ket_pro"];
        $this->ket_pro->AdvancedSearch->SearchOperator = @$filter["z_ket_pro"];
        $this->ket_pro->AdvancedSearch->SearchCondition = @$filter["v_ket_pro"];
        $this->ket_pro->AdvancedSearch->SearchValue2 = @$filter["y_ket_pro"];
        $this->ket_pro->AdvancedSearch->SearchOperator2 = @$filter["w_ket_pro"];
        $this->ket_pro->AdvancedSearch->save();

        // Field adl
        $this->adl->AdvancedSearch->SearchValue = @$filter["x_adl"];
        $this->adl->AdvancedSearch->SearchOperator = @$filter["z_adl"];
        $this->adl->AdvancedSearch->SearchCondition = @$filter["v_adl"];
        $this->adl->AdvancedSearch->SearchValue2 = @$filter["y_adl"];
        $this->adl->AdvancedSearch->SearchOperator2 = @$filter["w_adl"];
        $this->adl->AdvancedSearch->save();

        // Field status_psiko
        $this->status_psiko->AdvancedSearch->SearchValue = @$filter["x_status_psiko"];
        $this->status_psiko->AdvancedSearch->SearchOperator = @$filter["z_status_psiko"];
        $this->status_psiko->AdvancedSearch->SearchCondition = @$filter["v_status_psiko"];
        $this->status_psiko->AdvancedSearch->SearchValue2 = @$filter["y_status_psiko"];
        $this->status_psiko->AdvancedSearch->SearchOperator2 = @$filter["w_status_psiko"];
        $this->status_psiko->AdvancedSearch->save();

        // Field ket_psiko
        $this->ket_psiko->AdvancedSearch->SearchValue = @$filter["x_ket_psiko"];
        $this->ket_psiko->AdvancedSearch->SearchOperator = @$filter["z_ket_psiko"];
        $this->ket_psiko->AdvancedSearch->SearchCondition = @$filter["v_ket_psiko"];
        $this->ket_psiko->AdvancedSearch->SearchValue2 = @$filter["y_ket_psiko"];
        $this->ket_psiko->AdvancedSearch->SearchOperator2 = @$filter["w_ket_psiko"];
        $this->ket_psiko->AdvancedSearch->save();

        // Field hub_keluarga
        $this->hub_keluarga->AdvancedSearch->SearchValue = @$filter["x_hub_keluarga"];
        $this->hub_keluarga->AdvancedSearch->SearchOperator = @$filter["z_hub_keluarga"];
        $this->hub_keluarga->AdvancedSearch->SearchCondition = @$filter["v_hub_keluarga"];
        $this->hub_keluarga->AdvancedSearch->SearchValue2 = @$filter["y_hub_keluarga"];
        $this->hub_keluarga->AdvancedSearch->SearchOperator2 = @$filter["w_hub_keluarga"];
        $this->hub_keluarga->AdvancedSearch->save();

        // Field tinggal_dengan
        $this->tinggal_dengan->AdvancedSearch->SearchValue = @$filter["x_tinggal_dengan"];
        $this->tinggal_dengan->AdvancedSearch->SearchOperator = @$filter["z_tinggal_dengan"];
        $this->tinggal_dengan->AdvancedSearch->SearchCondition = @$filter["v_tinggal_dengan"];
        $this->tinggal_dengan->AdvancedSearch->SearchValue2 = @$filter["y_tinggal_dengan"];
        $this->tinggal_dengan->AdvancedSearch->SearchOperator2 = @$filter["w_tinggal_dengan"];
        $this->tinggal_dengan->AdvancedSearch->save();

        // Field ket_tinggal
        $this->ket_tinggal->AdvancedSearch->SearchValue = @$filter["x_ket_tinggal"];
        $this->ket_tinggal->AdvancedSearch->SearchOperator = @$filter["z_ket_tinggal"];
        $this->ket_tinggal->AdvancedSearch->SearchCondition = @$filter["v_ket_tinggal"];
        $this->ket_tinggal->AdvancedSearch->SearchValue2 = @$filter["y_ket_tinggal"];
        $this->ket_tinggal->AdvancedSearch->SearchOperator2 = @$filter["w_ket_tinggal"];
        $this->ket_tinggal->AdvancedSearch->save();

        // Field ekonomi
        $this->ekonomi->AdvancedSearch->SearchValue = @$filter["x_ekonomi"];
        $this->ekonomi->AdvancedSearch->SearchOperator = @$filter["z_ekonomi"];
        $this->ekonomi->AdvancedSearch->SearchCondition = @$filter["v_ekonomi"];
        $this->ekonomi->AdvancedSearch->SearchValue2 = @$filter["y_ekonomi"];
        $this->ekonomi->AdvancedSearch->SearchOperator2 = @$filter["w_ekonomi"];
        $this->ekonomi->AdvancedSearch->save();

        // Field budaya
        $this->budaya->AdvancedSearch->SearchValue = @$filter["x_budaya"];
        $this->budaya->AdvancedSearch->SearchOperator = @$filter["z_budaya"];
        $this->budaya->AdvancedSearch->SearchCondition = @$filter["v_budaya"];
        $this->budaya->AdvancedSearch->SearchValue2 = @$filter["y_budaya"];
        $this->budaya->AdvancedSearch->SearchOperator2 = @$filter["w_budaya"];
        $this->budaya->AdvancedSearch->save();

        // Field ket_budaya
        $this->ket_budaya->AdvancedSearch->SearchValue = @$filter["x_ket_budaya"];
        $this->ket_budaya->AdvancedSearch->SearchOperator = @$filter["z_ket_budaya"];
        $this->ket_budaya->AdvancedSearch->SearchCondition = @$filter["v_ket_budaya"];
        $this->ket_budaya->AdvancedSearch->SearchValue2 = @$filter["y_ket_budaya"];
        $this->ket_budaya->AdvancedSearch->SearchOperator2 = @$filter["w_ket_budaya"];
        $this->ket_budaya->AdvancedSearch->save();

        // Field edukasi
        $this->edukasi->AdvancedSearch->SearchValue = @$filter["x_edukasi"];
        $this->edukasi->AdvancedSearch->SearchOperator = @$filter["z_edukasi"];
        $this->edukasi->AdvancedSearch->SearchCondition = @$filter["v_edukasi"];
        $this->edukasi->AdvancedSearch->SearchValue2 = @$filter["y_edukasi"];
        $this->edukasi->AdvancedSearch->SearchOperator2 = @$filter["w_edukasi"];
        $this->edukasi->AdvancedSearch->save();

        // Field ket_edukasi
        $this->ket_edukasi->AdvancedSearch->SearchValue = @$filter["x_ket_edukasi"];
        $this->ket_edukasi->AdvancedSearch->SearchOperator = @$filter["z_ket_edukasi"];
        $this->ket_edukasi->AdvancedSearch->SearchCondition = @$filter["v_ket_edukasi"];
        $this->ket_edukasi->AdvancedSearch->SearchValue2 = @$filter["y_ket_edukasi"];
        $this->ket_edukasi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_edukasi"];
        $this->ket_edukasi->AdvancedSearch->save();

        // Field berjalan_a
        $this->berjalan_a->AdvancedSearch->SearchValue = @$filter["x_berjalan_a"];
        $this->berjalan_a->AdvancedSearch->SearchOperator = @$filter["z_berjalan_a"];
        $this->berjalan_a->AdvancedSearch->SearchCondition = @$filter["v_berjalan_a"];
        $this->berjalan_a->AdvancedSearch->SearchValue2 = @$filter["y_berjalan_a"];
        $this->berjalan_a->AdvancedSearch->SearchOperator2 = @$filter["w_berjalan_a"];
        $this->berjalan_a->AdvancedSearch->save();

        // Field berjalan_b
        $this->berjalan_b->AdvancedSearch->SearchValue = @$filter["x_berjalan_b"];
        $this->berjalan_b->AdvancedSearch->SearchOperator = @$filter["z_berjalan_b"];
        $this->berjalan_b->AdvancedSearch->SearchCondition = @$filter["v_berjalan_b"];
        $this->berjalan_b->AdvancedSearch->SearchValue2 = @$filter["y_berjalan_b"];
        $this->berjalan_b->AdvancedSearch->SearchOperator2 = @$filter["w_berjalan_b"];
        $this->berjalan_b->AdvancedSearch->save();

        // Field berjalan_c
        $this->berjalan_c->AdvancedSearch->SearchValue = @$filter["x_berjalan_c"];
        $this->berjalan_c->AdvancedSearch->SearchOperator = @$filter["z_berjalan_c"];
        $this->berjalan_c->AdvancedSearch->SearchCondition = @$filter["v_berjalan_c"];
        $this->berjalan_c->AdvancedSearch->SearchValue2 = @$filter["y_berjalan_c"];
        $this->berjalan_c->AdvancedSearch->SearchOperator2 = @$filter["w_berjalan_c"];
        $this->berjalan_c->AdvancedSearch->save();

        // Field hasil
        $this->hasil->AdvancedSearch->SearchValue = @$filter["x_hasil"];
        $this->hasil->AdvancedSearch->SearchOperator = @$filter["z_hasil"];
        $this->hasil->AdvancedSearch->SearchCondition = @$filter["v_hasil"];
        $this->hasil->AdvancedSearch->SearchValue2 = @$filter["y_hasil"];
        $this->hasil->AdvancedSearch->SearchOperator2 = @$filter["w_hasil"];
        $this->hasil->AdvancedSearch->save();

        // Field lapor
        $this->lapor->AdvancedSearch->SearchValue = @$filter["x_lapor"];
        $this->lapor->AdvancedSearch->SearchOperator = @$filter["z_lapor"];
        $this->lapor->AdvancedSearch->SearchCondition = @$filter["v_lapor"];
        $this->lapor->AdvancedSearch->SearchValue2 = @$filter["y_lapor"];
        $this->lapor->AdvancedSearch->SearchOperator2 = @$filter["w_lapor"];
        $this->lapor->AdvancedSearch->save();

        // Field ket_lapor
        $this->ket_lapor->AdvancedSearch->SearchValue = @$filter["x_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchOperator = @$filter["z_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchCondition = @$filter["v_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchValue2 = @$filter["y_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchOperator2 = @$filter["w_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->save();

        // Field sg1
        $this->sg1->AdvancedSearch->SearchValue = @$filter["x_sg1"];
        $this->sg1->AdvancedSearch->SearchOperator = @$filter["z_sg1"];
        $this->sg1->AdvancedSearch->SearchCondition = @$filter["v_sg1"];
        $this->sg1->AdvancedSearch->SearchValue2 = @$filter["y_sg1"];
        $this->sg1->AdvancedSearch->SearchOperator2 = @$filter["w_sg1"];
        $this->sg1->AdvancedSearch->save();

        // Field nilai1
        $this->nilai1->AdvancedSearch->SearchValue = @$filter["x_nilai1"];
        $this->nilai1->AdvancedSearch->SearchOperator = @$filter["z_nilai1"];
        $this->nilai1->AdvancedSearch->SearchCondition = @$filter["v_nilai1"];
        $this->nilai1->AdvancedSearch->SearchValue2 = @$filter["y_nilai1"];
        $this->nilai1->AdvancedSearch->SearchOperator2 = @$filter["w_nilai1"];
        $this->nilai1->AdvancedSearch->save();

        // Field sg2
        $this->sg2->AdvancedSearch->SearchValue = @$filter["x_sg2"];
        $this->sg2->AdvancedSearch->SearchOperator = @$filter["z_sg2"];
        $this->sg2->AdvancedSearch->SearchCondition = @$filter["v_sg2"];
        $this->sg2->AdvancedSearch->SearchValue2 = @$filter["y_sg2"];
        $this->sg2->AdvancedSearch->SearchOperator2 = @$filter["w_sg2"];
        $this->sg2->AdvancedSearch->save();

        // Field nilai2
        $this->nilai2->AdvancedSearch->SearchValue = @$filter["x_nilai2"];
        $this->nilai2->AdvancedSearch->SearchOperator = @$filter["z_nilai2"];
        $this->nilai2->AdvancedSearch->SearchCondition = @$filter["v_nilai2"];
        $this->nilai2->AdvancedSearch->SearchValue2 = @$filter["y_nilai2"];
        $this->nilai2->AdvancedSearch->SearchOperator2 = @$filter["w_nilai2"];
        $this->nilai2->AdvancedSearch->save();

        // Field total_hasil
        $this->total_hasil->AdvancedSearch->SearchValue = @$filter["x_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchOperator = @$filter["z_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchCondition = @$filter["v_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchValue2 = @$filter["y_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchOperator2 = @$filter["w_total_hasil"];
        $this->total_hasil->AdvancedSearch->save();

        // Field nyeri
        $this->nyeri->AdvancedSearch->SearchValue = @$filter["x_nyeri"];
        $this->nyeri->AdvancedSearch->SearchOperator = @$filter["z_nyeri"];
        $this->nyeri->AdvancedSearch->SearchCondition = @$filter["v_nyeri"];
        $this->nyeri->AdvancedSearch->SearchValue2 = @$filter["y_nyeri"];
        $this->nyeri->AdvancedSearch->SearchOperator2 = @$filter["w_nyeri"];
        $this->nyeri->AdvancedSearch->save();

        // Field provokes
        $this->provokes->AdvancedSearch->SearchValue = @$filter["x_provokes"];
        $this->provokes->AdvancedSearch->SearchOperator = @$filter["z_provokes"];
        $this->provokes->AdvancedSearch->SearchCondition = @$filter["v_provokes"];
        $this->provokes->AdvancedSearch->SearchValue2 = @$filter["y_provokes"];
        $this->provokes->AdvancedSearch->SearchOperator2 = @$filter["w_provokes"];
        $this->provokes->AdvancedSearch->save();

        // Field ket_provokes
        $this->ket_provokes->AdvancedSearch->SearchValue = @$filter["x_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchOperator = @$filter["z_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchCondition = @$filter["v_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchValue2 = @$filter["y_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchOperator2 = @$filter["w_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->save();

        // Field quality
        $this->quality->AdvancedSearch->SearchValue = @$filter["x_quality"];
        $this->quality->AdvancedSearch->SearchOperator = @$filter["z_quality"];
        $this->quality->AdvancedSearch->SearchCondition = @$filter["v_quality"];
        $this->quality->AdvancedSearch->SearchValue2 = @$filter["y_quality"];
        $this->quality->AdvancedSearch->SearchOperator2 = @$filter["w_quality"];
        $this->quality->AdvancedSearch->save();

        // Field ket_quality
        $this->ket_quality->AdvancedSearch->SearchValue = @$filter["x_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchOperator = @$filter["z_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchCondition = @$filter["v_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchValue2 = @$filter["y_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchOperator2 = @$filter["w_ket_quality"];
        $this->ket_quality->AdvancedSearch->save();

        // Field lokasi
        $this->lokasi->AdvancedSearch->SearchValue = @$filter["x_lokasi"];
        $this->lokasi->AdvancedSearch->SearchOperator = @$filter["z_lokasi"];
        $this->lokasi->AdvancedSearch->SearchCondition = @$filter["v_lokasi"];
        $this->lokasi->AdvancedSearch->SearchValue2 = @$filter["y_lokasi"];
        $this->lokasi->AdvancedSearch->SearchOperator2 = @$filter["w_lokasi"];
        $this->lokasi->AdvancedSearch->save();

        // Field menyebar
        $this->menyebar->AdvancedSearch->SearchValue = @$filter["x_menyebar"];
        $this->menyebar->AdvancedSearch->SearchOperator = @$filter["z_menyebar"];
        $this->menyebar->AdvancedSearch->SearchCondition = @$filter["v_menyebar"];
        $this->menyebar->AdvancedSearch->SearchValue2 = @$filter["y_menyebar"];
        $this->menyebar->AdvancedSearch->SearchOperator2 = @$filter["w_menyebar"];
        $this->menyebar->AdvancedSearch->save();

        // Field skala_nyeri
        $this->skala_nyeri->AdvancedSearch->SearchValue = @$filter["x_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchOperator = @$filter["z_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchCondition = @$filter["v_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchValue2 = @$filter["y_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchOperator2 = @$filter["w_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->save();

        // Field durasi
        $this->durasi->AdvancedSearch->SearchValue = @$filter["x_durasi"];
        $this->durasi->AdvancedSearch->SearchOperator = @$filter["z_durasi"];
        $this->durasi->AdvancedSearch->SearchCondition = @$filter["v_durasi"];
        $this->durasi->AdvancedSearch->SearchValue2 = @$filter["y_durasi"];
        $this->durasi->AdvancedSearch->SearchOperator2 = @$filter["w_durasi"];
        $this->durasi->AdvancedSearch->save();

        // Field nyeri_hilang
        $this->nyeri_hilang->AdvancedSearch->SearchValue = @$filter["x_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchOperator = @$filter["z_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchCondition = @$filter["v_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchValue2 = @$filter["y_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchOperator2 = @$filter["w_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->save();

        // Field ket_nyeri
        $this->ket_nyeri->AdvancedSearch->SearchValue = @$filter["x_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchOperator = @$filter["z_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchCondition = @$filter["v_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchValue2 = @$filter["y_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchOperator2 = @$filter["w_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->save();

        // Field pada_dokter
        $this->pada_dokter->AdvancedSearch->SearchValue = @$filter["x_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchOperator = @$filter["z_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchCondition = @$filter["v_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchValue2 = @$filter["y_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchOperator2 = @$filter["w_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->save();

        // Field ket_dokter
        $this->ket_dokter->AdvancedSearch->SearchValue = @$filter["x_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchOperator = @$filter["z_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchCondition = @$filter["v_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchValue2 = @$filter["y_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchOperator2 = @$filter["w_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->save();

        // Field rencana
        $this->rencana->AdvancedSearch->SearchValue = @$filter["x_rencana"];
        $this->rencana->AdvancedSearch->SearchOperator = @$filter["z_rencana"];
        $this->rencana->AdvancedSearch->SearchCondition = @$filter["v_rencana"];
        $this->rencana->AdvancedSearch->SearchValue2 = @$filter["y_rencana"];
        $this->rencana->AdvancedSearch->SearchOperator2 = @$filter["w_rencana"];
        $this->rencana->AdvancedSearch->save();

        // Field nip
        $this->nip->AdvancedSearch->SearchValue = @$filter["x_nip"];
        $this->nip->AdvancedSearch->SearchOperator = @$filter["z_nip"];
        $this->nip->AdvancedSearch->SearchCondition = @$filter["v_nip"];
        $this->nip->AdvancedSearch->SearchValue2 = @$filter["y_nip"];
        $this->nip->AdvancedSearch->SearchOperator2 = @$filter["w_nip"];
        $this->nip->AdvancedSearch->save();

        // Field id_penilaian_awal_keperawatan
        $this->id_penilaian_awal_keperawatan->AdvancedSearch->SearchValue = @$filter["x_id_penilaian_awal_keperawatan"];
        $this->id_penilaian_awal_keperawatan->AdvancedSearch->SearchOperator = @$filter["z_id_penilaian_awal_keperawatan"];
        $this->id_penilaian_awal_keperawatan->AdvancedSearch->SearchCondition = @$filter["v_id_penilaian_awal_keperawatan"];
        $this->id_penilaian_awal_keperawatan->AdvancedSearch->SearchValue2 = @$filter["y_id_penilaian_awal_keperawatan"];
        $this->id_penilaian_awal_keperawatan->AdvancedSearch->SearchOperator2 = @$filter["w_id_penilaian_awal_keperawatan"];
        $this->id_penilaian_awal_keperawatan->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->no_rawat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->td, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nadi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rr, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->suhu, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->gcs, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->bb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->tb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->bmi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->keluhan_utama, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rpd, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rpk, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rpo, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->alergi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_bantu, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_pro, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_psiko, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_tinggal, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_budaya, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_edukasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_lapor, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_provokes, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_quality, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->lokasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->durasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_nyeri, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_dokter, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rencana, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nip, $arKeywords, $type);
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
            $this->updateSort($this->no_rawat); // no_rawat
            $this->updateSort($this->tanggal); // tanggal
            $this->updateSort($this->informasi); // informasi
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

            // Reset master/detail keys
            if ($this->Command == "resetall") {
                $this->setCurrentMasterTable(""); // Clear master table
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
                        $this->no_rawat->setSessionValue("");
                        $this->no_rawat->setSessionValue("");
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->no_rawat->setSort("");
                $this->tanggal->setSort("");
                $this->informasi->setSort("");
                $this->td->setSort("");
                $this->nadi->setSort("");
                $this->rr->setSort("");
                $this->suhu->setSort("");
                $this->gcs->setSort("");
                $this->bb->setSort("");
                $this->tb->setSort("");
                $this->bmi->setSort("");
                $this->keluhan_utama->setSort("");
                $this->rpd->setSort("");
                $this->rpk->setSort("");
                $this->rpo->setSort("");
                $this->alergi->setSort("");
                $this->alat_bantu->setSort("");
                $this->ket_bantu->setSort("");
                $this->prothesa->setSort("");
                $this->ket_pro->setSort("");
                $this->adl->setSort("");
                $this->status_psiko->setSort("");
                $this->ket_psiko->setSort("");
                $this->hub_keluarga->setSort("");
                $this->tinggal_dengan->setSort("");
                $this->ket_tinggal->setSort("");
                $this->ekonomi->setSort("");
                $this->budaya->setSort("");
                $this->ket_budaya->setSort("");
                $this->edukasi->setSort("");
                $this->ket_edukasi->setSort("");
                $this->berjalan_a->setSort("");
                $this->berjalan_b->setSort("");
                $this->berjalan_c->setSort("");
                $this->hasil->setSort("");
                $this->lapor->setSort("");
                $this->ket_lapor->setSort("");
                $this->sg1->setSort("");
                $this->nilai1->setSort("");
                $this->sg2->setSort("");
                $this->nilai2->setSort("");
                $this->total_hasil->setSort("");
                $this->nyeri->setSort("");
                $this->provokes->setSort("");
                $this->ket_provokes->setSort("");
                $this->quality->setSort("");
                $this->ket_quality->setSort("");
                $this->lokasi->setSort("");
                $this->menyebar->setSort("");
                $this->skala_nyeri->setSort("");
                $this->durasi->setSort("");
                $this->nyeri_hilang->setSort("");
                $this->ket_nyeri->setSort("");
                $this->pada_dokter->setSort("");
                $this->ket_dokter->setSort("");
                $this->rencana->setSort("");
                $this->nip->setSort("");
                $this->id_penilaian_awal_keperawatan->setSort("");
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
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"penilaian_awal_keperawatan_ralan\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->ViewUrl)) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
                }
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                if (IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"penilaian_awal_keperawatan_ralan\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("EditLink") . "</a>";
                }
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id_penilaian_awal_keperawatan->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        if (IsMobile()) {
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"penilaian_awal_keperawatan_ralan\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("AddLink") . "</a>";
        }
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fpenilaian_awal_keperawatan_ralanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpenilaian_awal_keperawatan_ralanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fpenilaian_awal_keperawatan_ralanlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tanggal->setDbValue($row['tanggal']);
        $this->informasi->setDbValue($row['informasi']);
        $this->td->setDbValue($row['td']);
        $this->nadi->setDbValue($row['nadi']);
        $this->rr->setDbValue($row['rr']);
        $this->suhu->setDbValue($row['suhu']);
        $this->gcs->setDbValue($row['gcs']);
        $this->bb->setDbValue($row['bb']);
        $this->tb->setDbValue($row['tb']);
        $this->bmi->setDbValue($row['bmi']);
        $this->keluhan_utama->setDbValue($row['keluhan_utama']);
        $this->rpd->setDbValue($row['rpd']);
        $this->rpk->setDbValue($row['rpk']);
        $this->rpo->setDbValue($row['rpo']);
        $this->alergi->setDbValue($row['alergi']);
        $this->alat_bantu->setDbValue($row['alat_bantu']);
        $this->ket_bantu->setDbValue($row['ket_bantu']);
        $this->prothesa->setDbValue($row['prothesa']);
        $this->ket_pro->setDbValue($row['ket_pro']);
        $this->adl->setDbValue($row['adl']);
        $this->status_psiko->setDbValue($row['status_psiko']);
        $this->ket_psiko->setDbValue($row['ket_psiko']);
        $this->hub_keluarga->setDbValue($row['hub_keluarga']);
        $this->tinggal_dengan->setDbValue($row['tinggal_dengan']);
        $this->ket_tinggal->setDbValue($row['ket_tinggal']);
        $this->ekonomi->setDbValue($row['ekonomi']);
        $this->budaya->setDbValue($row['budaya']);
        $this->ket_budaya->setDbValue($row['ket_budaya']);
        $this->edukasi->setDbValue($row['edukasi']);
        $this->ket_edukasi->setDbValue($row['ket_edukasi']);
        $this->berjalan_a->setDbValue($row['berjalan_a']);
        $this->berjalan_b->setDbValue($row['berjalan_b']);
        $this->berjalan_c->setDbValue($row['berjalan_c']);
        $this->hasil->setDbValue($row['hasil']);
        $this->lapor->setDbValue($row['lapor']);
        $this->ket_lapor->setDbValue($row['ket_lapor']);
        $this->sg1->setDbValue($row['sg1']);
        $this->nilai1->setDbValue($row['nilai1']);
        $this->sg2->setDbValue($row['sg2']);
        $this->nilai2->setDbValue($row['nilai2']);
        $this->total_hasil->setDbValue($row['total_hasil']);
        $this->nyeri->setDbValue($row['nyeri']);
        $this->provokes->setDbValue($row['provokes']);
        $this->ket_provokes->setDbValue($row['ket_provokes']);
        $this->quality->setDbValue($row['quality']);
        $this->ket_quality->setDbValue($row['ket_quality']);
        $this->lokasi->setDbValue($row['lokasi']);
        $this->menyebar->setDbValue($row['menyebar']);
        $this->skala_nyeri->setDbValue($row['skala_nyeri']);
        $this->durasi->setDbValue($row['durasi']);
        $this->nyeri_hilang->setDbValue($row['nyeri_hilang']);
        $this->ket_nyeri->setDbValue($row['ket_nyeri']);
        $this->pada_dokter->setDbValue($row['pada_dokter']);
        $this->ket_dokter->setDbValue($row['ket_dokter']);
        $this->rencana->setDbValue($row['rencana']);
        $this->nip->setDbValue($row['nip']);
        $this->id_penilaian_awal_keperawatan->setDbValue($row['id_penilaian_awal_keperawatan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['no_rawat'] = null;
        $row['tanggal'] = null;
        $row['informasi'] = null;
        $row['td'] = null;
        $row['nadi'] = null;
        $row['rr'] = null;
        $row['suhu'] = null;
        $row['gcs'] = null;
        $row['bb'] = null;
        $row['tb'] = null;
        $row['bmi'] = null;
        $row['keluhan_utama'] = null;
        $row['rpd'] = null;
        $row['rpk'] = null;
        $row['rpo'] = null;
        $row['alergi'] = null;
        $row['alat_bantu'] = null;
        $row['ket_bantu'] = null;
        $row['prothesa'] = null;
        $row['ket_pro'] = null;
        $row['adl'] = null;
        $row['status_psiko'] = null;
        $row['ket_psiko'] = null;
        $row['hub_keluarga'] = null;
        $row['tinggal_dengan'] = null;
        $row['ket_tinggal'] = null;
        $row['ekonomi'] = null;
        $row['budaya'] = null;
        $row['ket_budaya'] = null;
        $row['edukasi'] = null;
        $row['ket_edukasi'] = null;
        $row['berjalan_a'] = null;
        $row['berjalan_b'] = null;
        $row['berjalan_c'] = null;
        $row['hasil'] = null;
        $row['lapor'] = null;
        $row['ket_lapor'] = null;
        $row['sg1'] = null;
        $row['nilai1'] = null;
        $row['sg2'] = null;
        $row['nilai2'] = null;
        $row['total_hasil'] = null;
        $row['nyeri'] = null;
        $row['provokes'] = null;
        $row['ket_provokes'] = null;
        $row['quality'] = null;
        $row['ket_quality'] = null;
        $row['lokasi'] = null;
        $row['menyebar'] = null;
        $row['skala_nyeri'] = null;
        $row['durasi'] = null;
        $row['nyeri_hilang'] = null;
        $row['ket_nyeri'] = null;
        $row['pada_dokter'] = null;
        $row['ket_dokter'] = null;
        $row['rencana'] = null;
        $row['nip'] = null;
        $row['id_penilaian_awal_keperawatan'] = null;
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

        // no_rawat

        // tanggal

        // informasi

        // td

        // nadi

        // rr

        // suhu

        // gcs

        // bb

        // tb

        // bmi

        // keluhan_utama

        // rpd

        // rpk

        // rpo

        // alergi

        // alat_bantu

        // ket_bantu

        // prothesa

        // ket_pro

        // adl

        // status_psiko

        // ket_psiko

        // hub_keluarga

        // tinggal_dengan

        // ket_tinggal

        // ekonomi

        // budaya

        // ket_budaya

        // edukasi

        // ket_edukasi

        // berjalan_a

        // berjalan_b

        // berjalan_c

        // hasil

        // lapor

        // ket_lapor

        // sg1

        // nilai1

        // sg2

        // nilai2

        // total_hasil

        // nyeri

        // provokes

        // ket_provokes

        // quality

        // ket_quality

        // lokasi

        // menyebar

        // skala_nyeri

        // durasi

        // nyeri_hilang

        // ket_nyeri

        // pada_dokter

        // ket_dokter

        // rencana

        // nip

        // id_penilaian_awal_keperawatan
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_rawat
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";

            // tanggal
            $this->tanggal->ViewValue = $this->tanggal->CurrentValue;
            $this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
            $this->tanggal->ViewCustomAttributes = "";

            // informasi
            if (strval($this->informasi->CurrentValue) != "") {
                $this->informasi->ViewValue = $this->informasi->optionCaption($this->informasi->CurrentValue);
            } else {
                $this->informasi->ViewValue = null;
            }
            $this->informasi->ViewCustomAttributes = "";

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

            // gcs
            $this->gcs->ViewValue = $this->gcs->CurrentValue;
            $this->gcs->ViewCustomAttributes = "";

            // bb
            $this->bb->ViewValue = $this->bb->CurrentValue;
            $this->bb->ViewCustomAttributes = "";

            // tb
            $this->tb->ViewValue = $this->tb->CurrentValue;
            $this->tb->ViewCustomAttributes = "";

            // bmi
            $this->bmi->ViewValue = $this->bmi->CurrentValue;
            $this->bmi->ViewCustomAttributes = "";

            // keluhan_utama
            $this->keluhan_utama->ViewValue = $this->keluhan_utama->CurrentValue;
            $this->keluhan_utama->ViewCustomAttributes = "";

            // rpd
            $this->rpd->ViewValue = $this->rpd->CurrentValue;
            $this->rpd->ViewCustomAttributes = "";

            // rpk
            $this->rpk->ViewValue = $this->rpk->CurrentValue;
            $this->rpk->ViewCustomAttributes = "";

            // rpo
            $this->rpo->ViewValue = $this->rpo->CurrentValue;
            $this->rpo->ViewCustomAttributes = "";

            // alergi
            $this->alergi->ViewValue = $this->alergi->CurrentValue;
            $this->alergi->ViewCustomAttributes = "";

            // alat_bantu
            if (strval($this->alat_bantu->CurrentValue) != "") {
                $this->alat_bantu->ViewValue = $this->alat_bantu->optionCaption($this->alat_bantu->CurrentValue);
            } else {
                $this->alat_bantu->ViewValue = null;
            }
            $this->alat_bantu->ViewCustomAttributes = "";

            // ket_bantu
            $this->ket_bantu->ViewValue = $this->ket_bantu->CurrentValue;
            $this->ket_bantu->ViewCustomAttributes = "";

            // prothesa
            if (strval($this->prothesa->CurrentValue) != "") {
                $this->prothesa->ViewValue = $this->prothesa->optionCaption($this->prothesa->CurrentValue);
            } else {
                $this->prothesa->ViewValue = null;
            }
            $this->prothesa->ViewCustomAttributes = "";

            // ket_pro
            $this->ket_pro->ViewValue = $this->ket_pro->CurrentValue;
            $this->ket_pro->ViewCustomAttributes = "";

            // adl
            if (strval($this->adl->CurrentValue) != "") {
                $this->adl->ViewValue = $this->adl->optionCaption($this->adl->CurrentValue);
            } else {
                $this->adl->ViewValue = null;
            }
            $this->adl->ViewCustomAttributes = "";

            // status_psiko
            if (strval($this->status_psiko->CurrentValue) != "") {
                $this->status_psiko->ViewValue = $this->status_psiko->optionCaption($this->status_psiko->CurrentValue);
            } else {
                $this->status_psiko->ViewValue = null;
            }
            $this->status_psiko->ViewCustomAttributes = "";

            // ket_psiko
            $this->ket_psiko->ViewValue = $this->ket_psiko->CurrentValue;
            $this->ket_psiko->ViewCustomAttributes = "";

            // hub_keluarga
            if (strval($this->hub_keluarga->CurrentValue) != "") {
                $this->hub_keluarga->ViewValue = $this->hub_keluarga->optionCaption($this->hub_keluarga->CurrentValue);
            } else {
                $this->hub_keluarga->ViewValue = null;
            }
            $this->hub_keluarga->ViewCustomAttributes = "";

            // tinggal_dengan
            if (strval($this->tinggal_dengan->CurrentValue) != "") {
                $this->tinggal_dengan->ViewValue = $this->tinggal_dengan->optionCaption($this->tinggal_dengan->CurrentValue);
            } else {
                $this->tinggal_dengan->ViewValue = null;
            }
            $this->tinggal_dengan->ViewCustomAttributes = "";

            // ket_tinggal
            $this->ket_tinggal->ViewValue = $this->ket_tinggal->CurrentValue;
            $this->ket_tinggal->ViewCustomAttributes = "";

            // ekonomi
            if (strval($this->ekonomi->CurrentValue) != "") {
                $this->ekonomi->ViewValue = $this->ekonomi->optionCaption($this->ekonomi->CurrentValue);
            } else {
                $this->ekonomi->ViewValue = null;
            }
            $this->ekonomi->ViewCustomAttributes = "";

            // budaya
            if (strval($this->budaya->CurrentValue) != "") {
                $this->budaya->ViewValue = $this->budaya->optionCaption($this->budaya->CurrentValue);
            } else {
                $this->budaya->ViewValue = null;
            }
            $this->budaya->ViewCustomAttributes = "";

            // ket_budaya
            $this->ket_budaya->ViewValue = $this->ket_budaya->CurrentValue;
            $this->ket_budaya->ViewCustomAttributes = "";

            // edukasi
            if (strval($this->edukasi->CurrentValue) != "") {
                $this->edukasi->ViewValue = $this->edukasi->optionCaption($this->edukasi->CurrentValue);
            } else {
                $this->edukasi->ViewValue = null;
            }
            $this->edukasi->ViewCustomAttributes = "";

            // ket_edukasi
            $this->ket_edukasi->ViewValue = $this->ket_edukasi->CurrentValue;
            $this->ket_edukasi->ViewCustomAttributes = "";

            // berjalan_a
            if (strval($this->berjalan_a->CurrentValue) != "") {
                $this->berjalan_a->ViewValue = $this->berjalan_a->optionCaption($this->berjalan_a->CurrentValue);
            } else {
                $this->berjalan_a->ViewValue = null;
            }
            $this->berjalan_a->ViewCustomAttributes = "";

            // berjalan_b
            if (strval($this->berjalan_b->CurrentValue) != "") {
                $this->berjalan_b->ViewValue = $this->berjalan_b->optionCaption($this->berjalan_b->CurrentValue);
            } else {
                $this->berjalan_b->ViewValue = null;
            }
            $this->berjalan_b->ViewCustomAttributes = "";

            // berjalan_c
            if (strval($this->berjalan_c->CurrentValue) != "") {
                $this->berjalan_c->ViewValue = $this->berjalan_c->optionCaption($this->berjalan_c->CurrentValue);
            } else {
                $this->berjalan_c->ViewValue = null;
            }
            $this->berjalan_c->ViewCustomAttributes = "";

            // hasil
            if (strval($this->hasil->CurrentValue) != "") {
                $this->hasil->ViewValue = $this->hasil->optionCaption($this->hasil->CurrentValue);
            } else {
                $this->hasil->ViewValue = null;
            }
            $this->hasil->ViewCustomAttributes = "";

            // lapor
            if (strval($this->lapor->CurrentValue) != "") {
                $this->lapor->ViewValue = $this->lapor->optionCaption($this->lapor->CurrentValue);
            } else {
                $this->lapor->ViewValue = null;
            }
            $this->lapor->ViewCustomAttributes = "";

            // ket_lapor
            $this->ket_lapor->ViewValue = $this->ket_lapor->CurrentValue;
            $this->ket_lapor->ViewCustomAttributes = "";

            // sg1
            if (strval($this->sg1->CurrentValue) != "") {
                $this->sg1->ViewValue = $this->sg1->optionCaption($this->sg1->CurrentValue);
            } else {
                $this->sg1->ViewValue = null;
            }
            $this->sg1->ViewCustomAttributes = "";

            // nilai1
            if (strval($this->nilai1->CurrentValue) != "") {
                $this->nilai1->ViewValue = $this->nilai1->optionCaption($this->nilai1->CurrentValue);
            } else {
                $this->nilai1->ViewValue = null;
            }
            $this->nilai1->ViewCustomAttributes = "";

            // sg2
            if (strval($this->sg2->CurrentValue) != "") {
                $this->sg2->ViewValue = $this->sg2->optionCaption($this->sg2->CurrentValue);
            } else {
                $this->sg2->ViewValue = null;
            }
            $this->sg2->ViewCustomAttributes = "";

            // nilai2
            if (ConvertToBool($this->nilai2->CurrentValue)) {
                $this->nilai2->ViewValue = $this->nilai2->tagCaption(2) != "" ? $this->nilai2->tagCaption(2) : "1";
            } else {
                $this->nilai2->ViewValue = $this->nilai2->tagCaption(1) != "" ? $this->nilai2->tagCaption(1) : "0";
            }
            $this->nilai2->ViewCustomAttributes = "";

            // total_hasil
            $this->total_hasil->ViewValue = $this->total_hasil->CurrentValue;
            $this->total_hasil->ViewValue = FormatNumber($this->total_hasil->ViewValue, 0, -2, -2, -2);
            $this->total_hasil->ViewCustomAttributes = "";

            // nyeri
            if (strval($this->nyeri->CurrentValue) != "") {
                $this->nyeri->ViewValue = $this->nyeri->optionCaption($this->nyeri->CurrentValue);
            } else {
                $this->nyeri->ViewValue = null;
            }
            $this->nyeri->ViewCustomAttributes = "";

            // provokes
            if (strval($this->provokes->CurrentValue) != "") {
                $this->provokes->ViewValue = $this->provokes->optionCaption($this->provokes->CurrentValue);
            } else {
                $this->provokes->ViewValue = null;
            }
            $this->provokes->ViewCustomAttributes = "";

            // ket_provokes
            $this->ket_provokes->ViewValue = $this->ket_provokes->CurrentValue;
            $this->ket_provokes->ViewCustomAttributes = "";

            // quality
            if (strval($this->quality->CurrentValue) != "") {
                $this->quality->ViewValue = $this->quality->optionCaption($this->quality->CurrentValue);
            } else {
                $this->quality->ViewValue = null;
            }
            $this->quality->ViewCustomAttributes = "";

            // ket_quality
            $this->ket_quality->ViewValue = $this->ket_quality->CurrentValue;
            $this->ket_quality->ViewCustomAttributes = "";

            // lokasi
            $this->lokasi->ViewValue = $this->lokasi->CurrentValue;
            $this->lokasi->ViewCustomAttributes = "";

            // menyebar
            if (strval($this->menyebar->CurrentValue) != "") {
                $this->menyebar->ViewValue = $this->menyebar->optionCaption($this->menyebar->CurrentValue);
            } else {
                $this->menyebar->ViewValue = null;
            }
            $this->menyebar->ViewCustomAttributes = "";

            // skala_nyeri
            if (strval($this->skala_nyeri->CurrentValue) != "") {
                $this->skala_nyeri->ViewValue = $this->skala_nyeri->optionCaption($this->skala_nyeri->CurrentValue);
            } else {
                $this->skala_nyeri->ViewValue = null;
            }
            $this->skala_nyeri->ViewCustomAttributes = "";

            // durasi
            $this->durasi->ViewValue = $this->durasi->CurrentValue;
            $this->durasi->ViewCustomAttributes = "";

            // nyeri_hilang
            if (strval($this->nyeri_hilang->CurrentValue) != "") {
                $this->nyeri_hilang->ViewValue = $this->nyeri_hilang->optionCaption($this->nyeri_hilang->CurrentValue);
            } else {
                $this->nyeri_hilang->ViewValue = null;
            }
            $this->nyeri_hilang->ViewCustomAttributes = "";

            // ket_nyeri
            $this->ket_nyeri->ViewValue = $this->ket_nyeri->CurrentValue;
            $this->ket_nyeri->ViewCustomAttributes = "";

            // pada_dokter
            if (strval($this->pada_dokter->CurrentValue) != "") {
                $this->pada_dokter->ViewValue = $this->pada_dokter->optionCaption($this->pada_dokter->CurrentValue);
            } else {
                $this->pada_dokter->ViewValue = null;
            }
            $this->pada_dokter->ViewCustomAttributes = "";

            // ket_dokter
            $this->ket_dokter->ViewValue = $this->ket_dokter->CurrentValue;
            $this->ket_dokter->ViewCustomAttributes = "";

            // rencana
            $this->rencana->ViewValue = $this->rencana->CurrentValue;
            $this->rencana->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // id_penilaian_awal_keperawatan
            $this->id_penilaian_awal_keperawatan->ViewValue = $this->id_penilaian_awal_keperawatan->CurrentValue;
            $this->id_penilaian_awal_keperawatan->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";
            $this->no_rawat->TooltipValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";
            $this->tanggal->TooltipValue = "";

            // informasi
            $this->informasi->LinkCustomAttributes = "";
            $this->informasi->HrefValue = "";
            $this->informasi->TooltipValue = "";
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
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fpenilaian_awal_keperawatan_ralanlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fpenilaian_awal_keperawatan_ralanlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fpenilaian_awal_keperawatan_ralanlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_penilaian_awal_keperawatan_ralan" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_penilaian_awal_keperawatan_ralan\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fpenilaian_awal_keperawatan_ralanlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpenilaian_awal_keperawatan_ralanlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "vigd") {
                $validMaster = true;
                $masterTbl = Container("vigd");
                if (($parm = Get("fk_id_reg", Get("no_rawat"))) !== null) {
                    $masterTbl->id_reg->setQueryStringValue($parm);
                    $this->no_rawat->setQueryStringValue($masterTbl->id_reg->QueryStringValue);
                    $this->no_rawat->setSessionValue($this->no_rawat->QueryStringValue);
                    if (!is_numeric($masterTbl->id_reg->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "vrajal") {
                $validMaster = true;
                $masterTbl = Container("vrajal");
                if (($parm = Get("fk_id_reg", Get("no_rawat"))) !== null) {
                    $masterTbl->id_reg->setQueryStringValue($parm);
                    $this->no_rawat->setQueryStringValue($masterTbl->id_reg->QueryStringValue);
                    $this->no_rawat->setSessionValue($this->no_rawat->QueryStringValue);
                    if (!is_numeric($masterTbl->id_reg->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "vigd") {
                $validMaster = true;
                $masterTbl = Container("vigd");
                if (($parm = Post("fk_id_reg", Post("no_rawat"))) !== null) {
                    $masterTbl->id_reg->setFormValue($parm);
                    $this->no_rawat->setFormValue($masterTbl->id_reg->FormValue);
                    $this->no_rawat->setSessionValue($this->no_rawat->FormValue);
                    if (!is_numeric($masterTbl->id_reg->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "vrajal") {
                $validMaster = true;
                $masterTbl = Container("vrajal");
                if (($parm = Post("fk_id_reg", Post("no_rawat"))) !== null) {
                    $masterTbl->id_reg->setFormValue($parm);
                    $this->no_rawat->setFormValue($masterTbl->id_reg->FormValue);
                    $this->no_rawat->setSessionValue($this->no_rawat->FormValue);
                    if (!is_numeric($masterTbl->id_reg->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Update URL
            $this->AddUrl = $this->addMasterUrl($this->AddUrl);
            $this->InlineAddUrl = $this->addMasterUrl($this->InlineAddUrl);
            $this->GridAddUrl = $this->addMasterUrl($this->GridAddUrl);
            $this->GridEditUrl = $this->addMasterUrl($this->GridEditUrl);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "vigd") {
                if ($this->no_rawat->CurrentValue == "") {
                    $this->no_rawat->setSessionValue("");
                }
            }
            if ($masterTblVar != "vrajal") {
                if ($this->no_rawat->CurrentValue == "") {
                    $this->no_rawat->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
                case "x_informasi":
                    break;
                case "x_alat_bantu":
                    break;
                case "x_prothesa":
                    break;
                case "x_adl":
                    break;
                case "x_status_psiko":
                    break;
                case "x_hub_keluarga":
                    break;
                case "x_tinggal_dengan":
                    break;
                case "x_ekonomi":
                    break;
                case "x_budaya":
                    break;
                case "x_edukasi":
                    break;
                case "x_berjalan_a":
                    break;
                case "x_berjalan_b":
                    break;
                case "x_berjalan_c":
                    break;
                case "x_hasil":
                    break;
                case "x_lapor":
                    break;
                case "x_sg1":
                    break;
                case "x_nilai1":
                    break;
                case "x_sg2":
                    break;
                case "x_nilai2":
                    break;
                case "x_nyeri":
                    break;
                case "x_provokes":
                    break;
                case "x_quality":
                    break;
                case "x_menyebar":
                    break;
                case "x_skala_nyeri":
                    break;
                case "x_nyeri_hilang":
                    break;
                case "x_pada_dokter":
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
