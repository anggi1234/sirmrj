<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianPsikologiGrid extends PenilaianPsikologi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_psikologi';

    // Page object name
    public $PageObjName = "PenilaianPsikologiGrid";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpenilaian_psikologigrid";
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
        $this->FormActionName .= "_" . $this->FormName;
        $this->OldKeyName .= "_" . $this->FormName;
        $this->FormBlankRowName .= "_" . $this->FormName;
        $this->FormKeyCountName .= "_" . $this->FormName;
        $GLOBALS["Grid"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (penilaian_psikologi)
        if (!isset($GLOBALS["penilaian_psikologi"]) || get_class($GLOBALS["penilaian_psikologi"]) == PROJECT_NAMESPACE . "penilaian_psikologi") {
            $GLOBALS["penilaian_psikologi"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        $this->AddUrl = "PenilaianPsikologiAdd";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penilaian_psikologi');
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

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
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

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("penilaian_psikologi"));
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
        unset($GLOBALS["Grid"]);
        if ($url === "") {
            return;
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

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
            $key .= @$ar['id_penilaian_psikologi'];
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
            $this->id_penilaian_psikologi->Visible = false;
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
    public $ShowOtherOptions = false;
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

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->id_penilaian_psikologi->Visible = false;
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->nip->setVisibility();
        $this->anamnesis->setVisibility();
        $this->dikirim_dari->setVisibility();
        $this->tujuan_pemeriksaan->setVisibility();
        $this->ket_anamnesis->Visible = false;
        $this->rupa->setVisibility();
        $this->bentuk_tubuh->setVisibility();
        $this->tindakan->setVisibility();
        $this->pakaian->setVisibility();
        $this->ekspresi->setVisibility();
        $this->berbicara->setVisibility();
        $this->penggunaan_kata->setVisibility();
        $this->ciri_menyolok->Visible = false;
        $this->hasil_psikotes->Visible = false;
        $this->kepribadian->Visible = false;
        $this->psikodinamika->Visible = false;
        $this->kesimpulan_psikolog->Visible = false;
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

        // Set up lookup cache

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

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

            // Show grid delete link for grid add / grid edit
            if ($this->AllowAddDeleteRow) {
                if ($this->isGridAdd() || $this->isGridEdit()) {
                    $item = $this->ListOptions["griddelete"];
                    if ($item) {
                        $item->Visible = true;
                    }
                }
            }

            // Set up sorting order
            $this->setupSortOrder();
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
            if ($this->CurrentMode == "copy") {
                $this->TotalRecords = $this->listRecordCount();
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->TotalRecords;
                $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
            } else {
                $this->CurrentFilter = "0=1";
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->GridAddRowCount;
            }
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->TotalRecords; // Display all records
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
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

    // Exit inline mode
    protected function clearInlineMode()
    {
        $this->LastAction = $this->CurrentAction; // Save last action
        $this->CurrentAction = ""; // Clear action
        $_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
    }

    // Switch to Grid Add mode
    protected function gridAddMode()
    {
        $this->CurrentAction = "gridadd";
        $_SESSION[SESSION_INLINE_MODE] = "gridadd";
        $this->hideFieldsForAddEdit();
    }

    // Switch to Grid Edit mode
    protected function gridEditMode()
    {
        $this->CurrentAction = "gridedit";
        $_SESSION[SESSION_INLINE_MODE] = "gridedit";
        $this->hideFieldsForAddEdit();
    }

    // Perform update to grid
    public function gridUpdate()
    {
        global $Language, $CurrentForm;
        $gridUpdate = true;

        // Get old recordset
        $this->CurrentFilter = $this->buildKeyFilter();
        if ($this->CurrentFilter == "") {
            $this->CurrentFilter = "0=1";
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        if ($rs = $conn->executeQuery($sql)) {
            $rsold = $rs->fetchAll();
            $rs->closeCursor();
        }

        // Call Grid Updating event
        if (!$this->gridUpdating($rsold)) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
            }
            return false;
        }
        $key = "";

        // Update row index and get row key
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Update all rows based on key
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            $CurrentForm->Index = $rowindex;
            $this->setKey($CurrentForm->getValue($this->OldKeyName));
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));

            // Load all values and keys
            if ($rowaction != "insertdelete") { // Skip insert then deleted rows
                $this->loadFormValues(); // Get form values
                if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
                    $gridUpdate = $this->OldKey != ""; // Key must not be empty
                } else {
                    $gridUpdate = true;
                }

                // Skip empty row
                if ($rowaction == "insert" && $this->emptyRow()) {
                // Validate form and insert/update/delete record
                } elseif ($gridUpdate) {
                    if ($rowaction == "delete") {
                        $this->CurrentFilter = $this->getRecordFilter();
                        $gridUpdate = $this->deleteRows(); // Delete this row
                    //} elseif (!$this->validateForm()) { // Already done in validateGridForm
                    //    $gridUpdate = false; // Form error, reset action
                    } else {
                        if ($rowaction == "insert") {
                            $gridUpdate = $this->addRow(); // Insert this row
                        } else {
                            if ($this->OldKey != "") {
                                $this->SendEmail = false; // Do not send email on update success
                                $gridUpdate = $this->editRow(); // Update this row
                            }
                        } // End update
                    }
                }
                if ($gridUpdate) {
                    if ($key != "") {
                        $key .= ", ";
                    }
                    $key .= $this->OldKey;
                } else {
                    break;
                }
            }
        }
        if ($gridUpdate) {
            // Get new records
            $rsnew = $conn->fetchAll($sql);

            // Call Grid_Updated event
            $this->gridUpdated($rsold, $rsnew);
            $this->clearInlineMode(); // Clear inline edit mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
            }
        }
        return $gridUpdate;
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

    // Perform Grid Add
    public function gridInsert()
    {
        global $Language, $CurrentForm;
        $rowindex = 1;
        $gridInsert = false;
        $conn = $this->getConnection();

        // Call Grid Inserting event
        if (!$this->gridInserting()) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
            }
            return false;
        }

        // Init key filter
        $wrkfilter = "";
        $addcnt = 0;
        $key = "";

        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Insert all rows
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "" && $rowaction != "insert") {
                continue; // Skip
            }
            if ($rowaction == "insert") {
                $this->OldKey = strval($CurrentForm->getValue($this->OldKeyName));
                $this->loadOldRecord(); // Load old record
            }
            $this->loadFormValues(); // Get form values
            if (!$this->emptyRow()) {
                $addcnt++;
                $this->SendEmail = false; // Do not send email on insert success

                // Validate form // Already done in validateGridForm
                //if (!$this->validateForm()) {
                //    $gridInsert = false; // Form error, reset action
                //} else {
                    $gridInsert = $this->addRow($this->OldRecordset); // Insert this row
                //}
                if ($gridInsert) {
                    if ($key != "") {
                        $key .= Config("COMPOSITE_KEY_SEPARATOR");
                    }
                    $key .= $this->id_penilaian_psikologi->CurrentValue;

                    // Add filter for this record
                    $filter = $this->getRecordFilter();
                    if ($wrkfilter != "") {
                        $wrkfilter .= " OR ";
                    }
                    $wrkfilter .= $filter;
                } else {
                    break;
                }
            }
        }
        if ($addcnt == 0) { // No record inserted
            $this->clearInlineMode(); // Clear grid add mode and return
            return true;
        }
        if ($gridInsert) {
            // Get new records
            $this->CurrentFilter = $wrkfilter;
            $sql = $this->getCurrentSql();
            $rsnew = $conn->fetchAll($sql);

            // Call Grid_Inserted event
            $this->gridInserted($rsnew);
            $this->clearInlineMode(); // Clear grid add mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
            }
        }
        return $gridInsert;
    }

    // Check if empty row
    public function emptyRow()
    {
        global $CurrentForm;
        if ($CurrentForm->hasValue("x_no_rawat") && $CurrentForm->hasValue("o_no_rawat") && $this->no_rawat->CurrentValue != $this->no_rawat->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_tanggal") && $CurrentForm->hasValue("o_tanggal") && $this->tanggal->CurrentValue != $this->tanggal->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_nip") && $CurrentForm->hasValue("o_nip") && $this->nip->CurrentValue != $this->nip->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_anamnesis") && $CurrentForm->hasValue("o_anamnesis") && $this->anamnesis->CurrentValue != $this->anamnesis->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_dikirim_dari") && $CurrentForm->hasValue("o_dikirim_dari") && $this->dikirim_dari->CurrentValue != $this->dikirim_dari->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_tujuan_pemeriksaan") && $CurrentForm->hasValue("o_tujuan_pemeriksaan") && $this->tujuan_pemeriksaan->CurrentValue != $this->tujuan_pemeriksaan->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_rupa") && $CurrentForm->hasValue("o_rupa") && $this->rupa->CurrentValue != $this->rupa->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_bentuk_tubuh") && $CurrentForm->hasValue("o_bentuk_tubuh") && $this->bentuk_tubuh->CurrentValue != $this->bentuk_tubuh->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_tindakan") && $CurrentForm->hasValue("o_tindakan") && $this->tindakan->CurrentValue != $this->tindakan->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_pakaian") && $CurrentForm->hasValue("o_pakaian") && $this->pakaian->CurrentValue != $this->pakaian->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_ekspresi") && $CurrentForm->hasValue("o_ekspresi") && $this->ekspresi->CurrentValue != $this->ekspresi->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_berbicara") && $CurrentForm->hasValue("o_berbicara") && $this->berbicara->CurrentValue != $this->berbicara->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_penggunaan_kata") && $CurrentForm->hasValue("o_penggunaan_kata") && $this->penggunaan_kata->CurrentValue != $this->penggunaan_kata->OldValue) {
            return false;
        }
        return true;
    }

    // Validate grid form
    public function validateGridForm()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Validate all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } elseif (!$this->validateForm()) {
                    return false;
                }
            }
        }
        return true;
    }

    // Get all form values of the grid
    public function getGridFormValues()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }
        $rows = [];

        // Loop through all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } else {
                    $rows[] = $this->getFieldValues("FormValue"); // Return row as array
                }
            }
        }
        return $rows; // Return as array of array
    }

    // Restore form values for current row
    public function restoreCurrentRowFormValues($idx)
    {
        global $CurrentForm;

        // Get row based on current index
        $CurrentForm->Index = $idx;
        $rowaction = strval($CurrentForm->getValue($this->FormActionName));
        $this->loadFormValues(); // Load form values
        // Set up invalid status correctly
        $this->resetFormError();
        if ($rowaction == "insert" && $this->emptyRow()) {
            // Ignore
        } else {
            $this->validateForm();
        }
    }

    // Reset form status
    public function resetFormError()
    {
        $this->no_rawat->clearErrorMessage();
        $this->tanggal->clearErrorMessage();
        $this->nip->clearErrorMessage();
        $this->anamnesis->clearErrorMessage();
        $this->dikirim_dari->clearErrorMessage();
        $this->tujuan_pemeriksaan->clearErrorMessage();
        $this->rupa->clearErrorMessage();
        $this->bentuk_tubuh->clearErrorMessage();
        $this->tindakan->clearErrorMessage();
        $this->pakaian->clearErrorMessage();
        $this->ekspresi->clearErrorMessage();
        $this->berbicara->clearErrorMessage();
        $this->penggunaan_kata->clearErrorMessage();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
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

        // "griddelete"
        if ($this->AllowAddDeleteRow) {
            $item = &$this->ListOptions->add("griddelete");
            $item->CssClass = "text-nowrap";
            $item->OnLeft = false;
            $item->Visible = false; // Default hidden
        }

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

        // Set up row action and key
        if ($CurrentForm && is_numeric($this->RowIndex) && $this->RowType != "view") {
            $CurrentForm->Index = $this->RowIndex;
            $actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
            $oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->OldKeyName);
            $blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
            if ($this->RowAction != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
            }
            $oldKey = $this->getKey(false); // Get from OldValue
            if ($oldKeyName != "" && $oldKey != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($oldKey) . "\">";
            }
            if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow()) {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
            }
        }

        // "delete"
        if ($this->AllowAddDeleteRow) {
            if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
                $options = &$this->ListOptions;
                $options->UseButtonGroup = true; // Use button group for grid delete button
                $opt = $options["griddelete"];
                if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
                    $opt->Body = "&nbsp;";
                } else {
                    $opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
                }
            }
        }
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                if (IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"penilaian_psikologi\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->ViewUrl)) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
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
                    $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"penilaian_psikologi\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("EditLink") . "</a>";
                }
            } else {
                $opt->Body = "";
            }
        } // End View mode
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $option = $this->OtherOptions["addedit"];
        $option->UseDropDownButton = false;
        $option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $option->UseButtonGroup = true;
        //$option->ButtonClass = ""; // Class for button group
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Add
        if ($this->CurrentMode == "view") { // Check view mode
            $item = &$option->add("add");
            $addcaption = HtmlTitle($Language->phrase("AddLink"));
            $this->AddUrl = $this->getAddUrl();
            if (IsMobile()) {
                $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
            } else {
                $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"penilaian_psikologi\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("AddLink") . "</a>";
            }
            $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        }
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
            if ($this->AllowAddDeleteRow) {
                $option = $options["addedit"];
                $option->UseDropDownButton = false;
                $item = &$option->add("addblankrow");
                $item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
                $item->Visible = $Security->canAdd();
                $this->ShowOtherOptions = $item->Visible;
            }
        }
        if ($this->CurrentMode == "view") { // Check view mode
            $option = $options["addedit"];
            $item = $option["add"];
            $this->ShowOtherOptions = $item && $item->Visible;
        }
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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id_penilaian_psikologi->CurrentValue = null;
        $this->id_penilaian_psikologi->OldValue = $this->id_penilaian_psikologi->CurrentValue;
        $this->no_rawat->CurrentValue = null;
        $this->no_rawat->OldValue = $this->no_rawat->CurrentValue;
        $this->tanggal->CurrentValue = null;
        $this->tanggal->OldValue = $this->tanggal->CurrentValue;
        $this->nip->CurrentValue = null;
        $this->nip->OldValue = $this->nip->CurrentValue;
        $this->anamnesis->CurrentValue = null;
        $this->anamnesis->OldValue = $this->anamnesis->CurrentValue;
        $this->dikirim_dari->CurrentValue = null;
        $this->dikirim_dari->OldValue = $this->dikirim_dari->CurrentValue;
        $this->tujuan_pemeriksaan->CurrentValue = null;
        $this->tujuan_pemeriksaan->OldValue = $this->tujuan_pemeriksaan->CurrentValue;
        $this->ket_anamnesis->CurrentValue = null;
        $this->ket_anamnesis->OldValue = $this->ket_anamnesis->CurrentValue;
        $this->rupa->CurrentValue = null;
        $this->rupa->OldValue = $this->rupa->CurrentValue;
        $this->bentuk_tubuh->CurrentValue = null;
        $this->bentuk_tubuh->OldValue = $this->bentuk_tubuh->CurrentValue;
        $this->tindakan->CurrentValue = null;
        $this->tindakan->OldValue = $this->tindakan->CurrentValue;
        $this->pakaian->CurrentValue = null;
        $this->pakaian->OldValue = $this->pakaian->CurrentValue;
        $this->ekspresi->CurrentValue = null;
        $this->ekspresi->OldValue = $this->ekspresi->CurrentValue;
        $this->berbicara->CurrentValue = null;
        $this->berbicara->OldValue = $this->berbicara->CurrentValue;
        $this->penggunaan_kata->CurrentValue = null;
        $this->penggunaan_kata->OldValue = $this->penggunaan_kata->CurrentValue;
        $this->ciri_menyolok->CurrentValue = null;
        $this->ciri_menyolok->OldValue = $this->ciri_menyolok->CurrentValue;
        $this->hasil_psikotes->CurrentValue = null;
        $this->hasil_psikotes->OldValue = $this->hasil_psikotes->CurrentValue;
        $this->kepribadian->CurrentValue = null;
        $this->kepribadian->OldValue = $this->kepribadian->CurrentValue;
        $this->psikodinamika->CurrentValue = null;
        $this->psikodinamika->OldValue = $this->psikodinamika->CurrentValue;
        $this->kesimpulan_psikolog->CurrentValue = null;
        $this->kesimpulan_psikolog->OldValue = $this->kesimpulan_psikolog->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $CurrentForm->FormName = $this->FormName;

        // Check field name 'no_rawat' first before field var 'x_no_rawat'
        $val = $CurrentForm->hasValue("no_rawat") ? $CurrentForm->getValue("no_rawat") : $CurrentForm->getValue("x_no_rawat");
        if (!$this->no_rawat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rawat->Visible = false; // Disable update for API request
            } else {
                $this->no_rawat->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_no_rawat")) {
            $this->no_rawat->setOldValue($CurrentForm->getValue("o_no_rawat"));
        }

        // Check field name 'tanggal' first before field var 'x_tanggal'
        $val = $CurrentForm->hasValue("tanggal") ? $CurrentForm->getValue("tanggal") : $CurrentForm->getValue("x_tanggal");
        if (!$this->tanggal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal->Visible = false; // Disable update for API request
            } else {
                $this->tanggal->setFormValue($val);
            }
            $this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
        }
        if ($CurrentForm->hasValue("o_tanggal")) {
            $this->tanggal->setOldValue($CurrentForm->getValue("o_tanggal"));
        }

        // Check field name 'nip' first before field var 'x_nip'
        $val = $CurrentForm->hasValue("nip") ? $CurrentForm->getValue("nip") : $CurrentForm->getValue("x_nip");
        if (!$this->nip->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nip->Visible = false; // Disable update for API request
            } else {
                $this->nip->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_nip")) {
            $this->nip->setOldValue($CurrentForm->getValue("o_nip"));
        }

        // Check field name 'anamnesis' first before field var 'x_anamnesis'
        $val = $CurrentForm->hasValue("anamnesis") ? $CurrentForm->getValue("anamnesis") : $CurrentForm->getValue("x_anamnesis");
        if (!$this->anamnesis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->anamnesis->Visible = false; // Disable update for API request
            } else {
                $this->anamnesis->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_anamnesis")) {
            $this->anamnesis->setOldValue($CurrentForm->getValue("o_anamnesis"));
        }

        // Check field name 'dikirim_dari' first before field var 'x_dikirim_dari'
        $val = $CurrentForm->hasValue("dikirim_dari") ? $CurrentForm->getValue("dikirim_dari") : $CurrentForm->getValue("x_dikirim_dari");
        if (!$this->dikirim_dari->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dikirim_dari->Visible = false; // Disable update for API request
            } else {
                $this->dikirim_dari->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_dikirim_dari")) {
            $this->dikirim_dari->setOldValue($CurrentForm->getValue("o_dikirim_dari"));
        }

        // Check field name 'tujuan_pemeriksaan' first before field var 'x_tujuan_pemeriksaan'
        $val = $CurrentForm->hasValue("tujuan_pemeriksaan") ? $CurrentForm->getValue("tujuan_pemeriksaan") : $CurrentForm->getValue("x_tujuan_pemeriksaan");
        if (!$this->tujuan_pemeriksaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tujuan_pemeriksaan->Visible = false; // Disable update for API request
            } else {
                $this->tujuan_pemeriksaan->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_tujuan_pemeriksaan")) {
            $this->tujuan_pemeriksaan->setOldValue($CurrentForm->getValue("o_tujuan_pemeriksaan"));
        }

        // Check field name 'rupa' first before field var 'x_rupa'
        $val = $CurrentForm->hasValue("rupa") ? $CurrentForm->getValue("rupa") : $CurrentForm->getValue("x_rupa");
        if (!$this->rupa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rupa->Visible = false; // Disable update for API request
            } else {
                $this->rupa->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_rupa")) {
            $this->rupa->setOldValue($CurrentForm->getValue("o_rupa"));
        }

        // Check field name 'bentuk_tubuh' first before field var 'x_bentuk_tubuh'
        $val = $CurrentForm->hasValue("bentuk_tubuh") ? $CurrentForm->getValue("bentuk_tubuh") : $CurrentForm->getValue("x_bentuk_tubuh");
        if (!$this->bentuk_tubuh->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bentuk_tubuh->Visible = false; // Disable update for API request
            } else {
                $this->bentuk_tubuh->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_bentuk_tubuh")) {
            $this->bentuk_tubuh->setOldValue($CurrentForm->getValue("o_bentuk_tubuh"));
        }

        // Check field name 'tindakan' first before field var 'x_tindakan'
        $val = $CurrentForm->hasValue("tindakan") ? $CurrentForm->getValue("tindakan") : $CurrentForm->getValue("x_tindakan");
        if (!$this->tindakan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tindakan->Visible = false; // Disable update for API request
            } else {
                $this->tindakan->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_tindakan")) {
            $this->tindakan->setOldValue($CurrentForm->getValue("o_tindakan"));
        }

        // Check field name 'pakaian' first before field var 'x_pakaian'
        $val = $CurrentForm->hasValue("pakaian") ? $CurrentForm->getValue("pakaian") : $CurrentForm->getValue("x_pakaian");
        if (!$this->pakaian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pakaian->Visible = false; // Disable update for API request
            } else {
                $this->pakaian->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_pakaian")) {
            $this->pakaian->setOldValue($CurrentForm->getValue("o_pakaian"));
        }

        // Check field name 'ekspresi' first before field var 'x_ekspresi'
        $val = $CurrentForm->hasValue("ekspresi") ? $CurrentForm->getValue("ekspresi") : $CurrentForm->getValue("x_ekspresi");
        if (!$this->ekspresi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ekspresi->Visible = false; // Disable update for API request
            } else {
                $this->ekspresi->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_ekspresi")) {
            $this->ekspresi->setOldValue($CurrentForm->getValue("o_ekspresi"));
        }

        // Check field name 'berbicara' first before field var 'x_berbicara'
        $val = $CurrentForm->hasValue("berbicara") ? $CurrentForm->getValue("berbicara") : $CurrentForm->getValue("x_berbicara");
        if (!$this->berbicara->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berbicara->Visible = false; // Disable update for API request
            } else {
                $this->berbicara->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_berbicara")) {
            $this->berbicara->setOldValue($CurrentForm->getValue("o_berbicara"));
        }

        // Check field name 'penggunaan_kata' first before field var 'x_penggunaan_kata'
        $val = $CurrentForm->hasValue("penggunaan_kata") ? $CurrentForm->getValue("penggunaan_kata") : $CurrentForm->getValue("x_penggunaan_kata");
        if (!$this->penggunaan_kata->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->penggunaan_kata->Visible = false; // Disable update for API request
            } else {
                $this->penggunaan_kata->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_penggunaan_kata")) {
            $this->penggunaan_kata->setOldValue($CurrentForm->getValue("o_penggunaan_kata"));
        }

        // Check field name 'id_penilaian_psikologi' first before field var 'x_id_penilaian_psikologi'
        $val = $CurrentForm->hasValue("id_penilaian_psikologi") ? $CurrentForm->getValue("id_penilaian_psikologi") : $CurrentForm->getValue("x_id_penilaian_psikologi");
        if (!$this->id_penilaian_psikologi->IsDetailKey && !$this->isGridAdd() && !$this->isAdd()) {
            $this->id_penilaian_psikologi->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        if (!$this->isGridAdd() && !$this->isAdd()) {
            $this->id_penilaian_psikologi->CurrentValue = $this->id_penilaian_psikologi->FormValue;
        }
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->tanggal->CurrentValue = $this->tanggal->FormValue;
        $this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
        $this->nip->CurrentValue = $this->nip->FormValue;
        $this->anamnesis->CurrentValue = $this->anamnesis->FormValue;
        $this->dikirim_dari->CurrentValue = $this->dikirim_dari->FormValue;
        $this->tujuan_pemeriksaan->CurrentValue = $this->tujuan_pemeriksaan->FormValue;
        $this->rupa->CurrentValue = $this->rupa->FormValue;
        $this->bentuk_tubuh->CurrentValue = $this->bentuk_tubuh->FormValue;
        $this->tindakan->CurrentValue = $this->tindakan->FormValue;
        $this->pakaian->CurrentValue = $this->pakaian->FormValue;
        $this->ekspresi->CurrentValue = $this->ekspresi->FormValue;
        $this->berbicara->CurrentValue = $this->berbicara->FormValue;
        $this->penggunaan_kata->CurrentValue = $this->penggunaan_kata->FormValue;
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
        $this->id_penilaian_psikologi->setDbValue($row['id_penilaian_psikologi']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tanggal->setDbValue($row['tanggal']);
        $this->nip->setDbValue($row['nip']);
        $this->anamnesis->setDbValue($row['anamnesis']);
        $this->dikirim_dari->setDbValue($row['dikirim_dari']);
        $this->tujuan_pemeriksaan->setDbValue($row['tujuan_pemeriksaan']);
        $this->ket_anamnesis->setDbValue($row['ket_anamnesis']);
        $this->rupa->setDbValue($row['rupa']);
        $this->bentuk_tubuh->setDbValue($row['bentuk_tubuh']);
        $this->tindakan->setDbValue($row['tindakan']);
        $this->pakaian->setDbValue($row['pakaian']);
        $this->ekspresi->setDbValue($row['ekspresi']);
        $this->berbicara->setDbValue($row['berbicara']);
        $this->penggunaan_kata->setDbValue($row['penggunaan_kata']);
        $this->ciri_menyolok->setDbValue($row['ciri_menyolok']);
        $this->hasil_psikotes->setDbValue($row['hasil_psikotes']);
        $this->kepribadian->setDbValue($row['kepribadian']);
        $this->psikodinamika->setDbValue($row['psikodinamika']);
        $this->kesimpulan_psikolog->setDbValue($row['kesimpulan_psikolog']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_penilaian_psikologi'] = $this->id_penilaian_psikologi->CurrentValue;
        $row['no_rawat'] = $this->no_rawat->CurrentValue;
        $row['tanggal'] = $this->tanggal->CurrentValue;
        $row['nip'] = $this->nip->CurrentValue;
        $row['anamnesis'] = $this->anamnesis->CurrentValue;
        $row['dikirim_dari'] = $this->dikirim_dari->CurrentValue;
        $row['tujuan_pemeriksaan'] = $this->tujuan_pemeriksaan->CurrentValue;
        $row['ket_anamnesis'] = $this->ket_anamnesis->CurrentValue;
        $row['rupa'] = $this->rupa->CurrentValue;
        $row['bentuk_tubuh'] = $this->bentuk_tubuh->CurrentValue;
        $row['tindakan'] = $this->tindakan->CurrentValue;
        $row['pakaian'] = $this->pakaian->CurrentValue;
        $row['ekspresi'] = $this->ekspresi->CurrentValue;
        $row['berbicara'] = $this->berbicara->CurrentValue;
        $row['penggunaan_kata'] = $this->penggunaan_kata->CurrentValue;
        $row['ciri_menyolok'] = $this->ciri_menyolok->CurrentValue;
        $row['hasil_psikotes'] = $this->hasil_psikotes->CurrentValue;
        $row['kepribadian'] = $this->kepribadian->CurrentValue;
        $row['psikodinamika'] = $this->psikodinamika->CurrentValue;
        $row['kesimpulan_psikolog'] = $this->kesimpulan_psikolog->CurrentValue;
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
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id_penilaian_psikologi

        // no_rawat

        // tanggal

        // nip

        // anamnesis

        // dikirim_dari

        // tujuan_pemeriksaan

        // ket_anamnesis

        // rupa

        // bentuk_tubuh

        // tindakan

        // pakaian

        // ekspresi

        // berbicara

        // penggunaan_kata

        // ciri_menyolok

        // hasil_psikotes

        // kepribadian

        // psikodinamika

        // kesimpulan_psikolog
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_penilaian_psikologi
            $this->id_penilaian_psikologi->ViewValue = $this->id_penilaian_psikologi->CurrentValue;
            $this->id_penilaian_psikologi->ViewValue = FormatNumber($this->id_penilaian_psikologi->ViewValue, 0, -2, -2, -2);
            $this->id_penilaian_psikologi->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";

            // tanggal
            $this->tanggal->ViewValue = $this->tanggal->CurrentValue;
            $this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
            $this->tanggal->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // anamnesis
            if (strval($this->anamnesis->CurrentValue) != "") {
                $this->anamnesis->ViewValue = $this->anamnesis->optionCaption($this->anamnesis->CurrentValue);
            } else {
                $this->anamnesis->ViewValue = null;
            }
            $this->anamnesis->ViewCustomAttributes = "";

            // dikirim_dari
            if (strval($this->dikirim_dari->CurrentValue) != "") {
                $this->dikirim_dari->ViewValue = $this->dikirim_dari->optionCaption($this->dikirim_dari->CurrentValue);
            } else {
                $this->dikirim_dari->ViewValue = null;
            }
            $this->dikirim_dari->ViewCustomAttributes = "";

            // tujuan_pemeriksaan
            if (strval($this->tujuan_pemeriksaan->CurrentValue) != "") {
                $this->tujuan_pemeriksaan->ViewValue = $this->tujuan_pemeriksaan->optionCaption($this->tujuan_pemeriksaan->CurrentValue);
            } else {
                $this->tujuan_pemeriksaan->ViewValue = null;
            }
            $this->tujuan_pemeriksaan->ViewCustomAttributes = "";

            // rupa
            if (strval($this->rupa->CurrentValue) != "") {
                $this->rupa->ViewValue = $this->rupa->optionCaption($this->rupa->CurrentValue);
            } else {
                $this->rupa->ViewValue = null;
            }
            $this->rupa->ViewCustomAttributes = "";

            // bentuk_tubuh
            if (strval($this->bentuk_tubuh->CurrentValue) != "") {
                $this->bentuk_tubuh->ViewValue = $this->bentuk_tubuh->optionCaption($this->bentuk_tubuh->CurrentValue);
            } else {
                $this->bentuk_tubuh->ViewValue = null;
            }
            $this->bentuk_tubuh->ViewCustomAttributes = "";

            // tindakan
            if (strval($this->tindakan->CurrentValue) != "") {
                $this->tindakan->ViewValue = $this->tindakan->optionCaption($this->tindakan->CurrentValue);
            } else {
                $this->tindakan->ViewValue = null;
            }
            $this->tindakan->ViewCustomAttributes = "";

            // pakaian
            if (strval($this->pakaian->CurrentValue) != "") {
                $this->pakaian->ViewValue = $this->pakaian->optionCaption($this->pakaian->CurrentValue);
            } else {
                $this->pakaian->ViewValue = null;
            }
            $this->pakaian->ViewCustomAttributes = "";

            // ekspresi
            if (strval($this->ekspresi->CurrentValue) != "") {
                $this->ekspresi->ViewValue = $this->ekspresi->optionCaption($this->ekspresi->CurrentValue);
            } else {
                $this->ekspresi->ViewValue = null;
            }
            $this->ekspresi->ViewCustomAttributes = "";

            // berbicara
            if (strval($this->berbicara->CurrentValue) != "") {
                $this->berbicara->ViewValue = $this->berbicara->optionCaption($this->berbicara->CurrentValue);
            } else {
                $this->berbicara->ViewValue = null;
            }
            $this->berbicara->ViewCustomAttributes = "";

            // penggunaan_kata
            if (strval($this->penggunaan_kata->CurrentValue) != "") {
                $this->penggunaan_kata->ViewValue = $this->penggunaan_kata->optionCaption($this->penggunaan_kata->CurrentValue);
            } else {
                $this->penggunaan_kata->ViewValue = null;
            }
            $this->penggunaan_kata->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";
            $this->no_rawat->TooltipValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";
            $this->tanggal->TooltipValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";
            $this->nip->TooltipValue = "";

            // anamnesis
            $this->anamnesis->LinkCustomAttributes = "";
            $this->anamnesis->HrefValue = "";
            $this->anamnesis->TooltipValue = "";

            // dikirim_dari
            $this->dikirim_dari->LinkCustomAttributes = "";
            $this->dikirim_dari->HrefValue = "";
            $this->dikirim_dari->TooltipValue = "";

            // tujuan_pemeriksaan
            $this->tujuan_pemeriksaan->LinkCustomAttributes = "";
            $this->tujuan_pemeriksaan->HrefValue = "";
            $this->tujuan_pemeriksaan->TooltipValue = "";

            // rupa
            $this->rupa->LinkCustomAttributes = "";
            $this->rupa->HrefValue = "";
            $this->rupa->TooltipValue = "";

            // bentuk_tubuh
            $this->bentuk_tubuh->LinkCustomAttributes = "";
            $this->bentuk_tubuh->HrefValue = "";
            $this->bentuk_tubuh->TooltipValue = "";

            // tindakan
            $this->tindakan->LinkCustomAttributes = "";
            $this->tindakan->HrefValue = "";
            $this->tindakan->TooltipValue = "";

            // pakaian
            $this->pakaian->LinkCustomAttributes = "";
            $this->pakaian->HrefValue = "";
            $this->pakaian->TooltipValue = "";

            // ekspresi
            $this->ekspresi->LinkCustomAttributes = "";
            $this->ekspresi->HrefValue = "";
            $this->ekspresi->TooltipValue = "";

            // berbicara
            $this->berbicara->LinkCustomAttributes = "";
            $this->berbicara->HrefValue = "";
            $this->berbicara->TooltipValue = "";

            // penggunaan_kata
            $this->penggunaan_kata->LinkCustomAttributes = "";
            $this->penggunaan_kata->HrefValue = "";
            $this->penggunaan_kata->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // no_rawat
            $this->no_rawat->EditAttrs["class"] = "form-control";
            $this->no_rawat->EditCustomAttributes = "";
            if ($this->no_rawat->getSessionValue() != "") {
                $this->no_rawat->CurrentValue = GetForeignKeyValue($this->no_rawat->getSessionValue());
                $this->no_rawat->OldValue = $this->no_rawat->CurrentValue;
                $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
                $this->no_rawat->ViewCustomAttributes = "";
            } else {
                if (!$this->no_rawat->Raw) {
                    $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
                }
                $this->no_rawat->EditValue = HtmlEncode($this->no_rawat->CurrentValue);
                $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());
            }

            // tanggal
            $this->tanggal->EditAttrs["class"] = "form-control";
            $this->tanggal->EditCustomAttributes = "";
            $this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
            $this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

            // nip
            $this->nip->EditAttrs["class"] = "form-control";
            $this->nip->EditCustomAttributes = "";
            if (!$this->nip->Raw) {
                $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
            }
            $this->nip->EditValue = HtmlEncode($this->nip->CurrentValue);
            $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

            // anamnesis
            $this->anamnesis->EditCustomAttributes = "";
            $this->anamnesis->EditValue = $this->anamnesis->options(false);
            $this->anamnesis->PlaceHolder = RemoveHtml($this->anamnesis->caption());

            // dikirim_dari
            $this->dikirim_dari->EditCustomAttributes = "";
            $this->dikirim_dari->EditValue = $this->dikirim_dari->options(false);
            $this->dikirim_dari->PlaceHolder = RemoveHtml($this->dikirim_dari->caption());

            // tujuan_pemeriksaan
            $this->tujuan_pemeriksaan->EditCustomAttributes = "";
            $this->tujuan_pemeriksaan->EditValue = $this->tujuan_pemeriksaan->options(false);
            $this->tujuan_pemeriksaan->PlaceHolder = RemoveHtml($this->tujuan_pemeriksaan->caption());

            // rupa
            $this->rupa->EditCustomAttributes = "";
            $this->rupa->EditValue = $this->rupa->options(false);
            $this->rupa->PlaceHolder = RemoveHtml($this->rupa->caption());

            // bentuk_tubuh
            $this->bentuk_tubuh->EditCustomAttributes = "";
            $this->bentuk_tubuh->EditValue = $this->bentuk_tubuh->options(false);
            $this->bentuk_tubuh->PlaceHolder = RemoveHtml($this->bentuk_tubuh->caption());

            // tindakan
            $this->tindakan->EditCustomAttributes = "";
            $this->tindakan->EditValue = $this->tindakan->options(false);
            $this->tindakan->PlaceHolder = RemoveHtml($this->tindakan->caption());

            // pakaian
            $this->pakaian->EditCustomAttributes = "";
            $this->pakaian->EditValue = $this->pakaian->options(false);
            $this->pakaian->PlaceHolder = RemoveHtml($this->pakaian->caption());

            // ekspresi
            $this->ekspresi->EditCustomAttributes = "";
            $this->ekspresi->EditValue = $this->ekspresi->options(false);
            $this->ekspresi->PlaceHolder = RemoveHtml($this->ekspresi->caption());

            // berbicara
            $this->berbicara->EditCustomAttributes = "";
            $this->berbicara->EditValue = $this->berbicara->options(false);
            $this->berbicara->PlaceHolder = RemoveHtml($this->berbicara->caption());

            // penggunaan_kata
            $this->penggunaan_kata->EditCustomAttributes = "";
            $this->penggunaan_kata->EditValue = $this->penggunaan_kata->options(false);
            $this->penggunaan_kata->PlaceHolder = RemoveHtml($this->penggunaan_kata->caption());

            // Add refer script

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";

            // anamnesis
            $this->anamnesis->LinkCustomAttributes = "";
            $this->anamnesis->HrefValue = "";

            // dikirim_dari
            $this->dikirim_dari->LinkCustomAttributes = "";
            $this->dikirim_dari->HrefValue = "";

            // tujuan_pemeriksaan
            $this->tujuan_pemeriksaan->LinkCustomAttributes = "";
            $this->tujuan_pemeriksaan->HrefValue = "";

            // rupa
            $this->rupa->LinkCustomAttributes = "";
            $this->rupa->HrefValue = "";

            // bentuk_tubuh
            $this->bentuk_tubuh->LinkCustomAttributes = "";
            $this->bentuk_tubuh->HrefValue = "";

            // tindakan
            $this->tindakan->LinkCustomAttributes = "";
            $this->tindakan->HrefValue = "";

            // pakaian
            $this->pakaian->LinkCustomAttributes = "";
            $this->pakaian->HrefValue = "";

            // ekspresi
            $this->ekspresi->LinkCustomAttributes = "";
            $this->ekspresi->HrefValue = "";

            // berbicara
            $this->berbicara->LinkCustomAttributes = "";
            $this->berbicara->HrefValue = "";

            // penggunaan_kata
            $this->penggunaan_kata->LinkCustomAttributes = "";
            $this->penggunaan_kata->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // no_rawat
            $this->no_rawat->EditAttrs["class"] = "form-control";
            $this->no_rawat->EditCustomAttributes = "";
            if ($this->no_rawat->getSessionValue() != "") {
                $this->no_rawat->CurrentValue = GetForeignKeyValue($this->no_rawat->getSessionValue());
                $this->no_rawat->OldValue = $this->no_rawat->CurrentValue;
                $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
                $this->no_rawat->ViewCustomAttributes = "";
            } else {
                if (!$this->no_rawat->Raw) {
                    $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
                }
                $this->no_rawat->EditValue = HtmlEncode($this->no_rawat->CurrentValue);
                $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());
            }

            // tanggal
            $this->tanggal->EditAttrs["class"] = "form-control";
            $this->tanggal->EditCustomAttributes = "";
            $this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
            $this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

            // nip
            $this->nip->EditAttrs["class"] = "form-control";
            $this->nip->EditCustomAttributes = "";
            if (!$this->nip->Raw) {
                $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
            }
            $this->nip->EditValue = HtmlEncode($this->nip->CurrentValue);
            $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

            // anamnesis
            $this->anamnesis->EditCustomAttributes = "";
            $this->anamnesis->EditValue = $this->anamnesis->options(false);
            $this->anamnesis->PlaceHolder = RemoveHtml($this->anamnesis->caption());

            // dikirim_dari
            $this->dikirim_dari->EditCustomAttributes = "";
            $this->dikirim_dari->EditValue = $this->dikirim_dari->options(false);
            $this->dikirim_dari->PlaceHolder = RemoveHtml($this->dikirim_dari->caption());

            // tujuan_pemeriksaan
            $this->tujuan_pemeriksaan->EditCustomAttributes = "";
            $this->tujuan_pemeriksaan->EditValue = $this->tujuan_pemeriksaan->options(false);
            $this->tujuan_pemeriksaan->PlaceHolder = RemoveHtml($this->tujuan_pemeriksaan->caption());

            // rupa
            $this->rupa->EditCustomAttributes = "";
            $this->rupa->EditValue = $this->rupa->options(false);
            $this->rupa->PlaceHolder = RemoveHtml($this->rupa->caption());

            // bentuk_tubuh
            $this->bentuk_tubuh->EditCustomAttributes = "";
            $this->bentuk_tubuh->EditValue = $this->bentuk_tubuh->options(false);
            $this->bentuk_tubuh->PlaceHolder = RemoveHtml($this->bentuk_tubuh->caption());

            // tindakan
            $this->tindakan->EditCustomAttributes = "";
            $this->tindakan->EditValue = $this->tindakan->options(false);
            $this->tindakan->PlaceHolder = RemoveHtml($this->tindakan->caption());

            // pakaian
            $this->pakaian->EditCustomAttributes = "";
            $this->pakaian->EditValue = $this->pakaian->options(false);
            $this->pakaian->PlaceHolder = RemoveHtml($this->pakaian->caption());

            // ekspresi
            $this->ekspresi->EditCustomAttributes = "";
            $this->ekspresi->EditValue = $this->ekspresi->options(false);
            $this->ekspresi->PlaceHolder = RemoveHtml($this->ekspresi->caption());

            // berbicara
            $this->berbicara->EditCustomAttributes = "";
            $this->berbicara->EditValue = $this->berbicara->options(false);
            $this->berbicara->PlaceHolder = RemoveHtml($this->berbicara->caption());

            // penggunaan_kata
            $this->penggunaan_kata->EditCustomAttributes = "";
            $this->penggunaan_kata->EditValue = $this->penggunaan_kata->options(false);
            $this->penggunaan_kata->PlaceHolder = RemoveHtml($this->penggunaan_kata->caption());

            // Edit refer script

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";

            // anamnesis
            $this->anamnesis->LinkCustomAttributes = "";
            $this->anamnesis->HrefValue = "";

            // dikirim_dari
            $this->dikirim_dari->LinkCustomAttributes = "";
            $this->dikirim_dari->HrefValue = "";

            // tujuan_pemeriksaan
            $this->tujuan_pemeriksaan->LinkCustomAttributes = "";
            $this->tujuan_pemeriksaan->HrefValue = "";

            // rupa
            $this->rupa->LinkCustomAttributes = "";
            $this->rupa->HrefValue = "";

            // bentuk_tubuh
            $this->bentuk_tubuh->LinkCustomAttributes = "";
            $this->bentuk_tubuh->HrefValue = "";

            // tindakan
            $this->tindakan->LinkCustomAttributes = "";
            $this->tindakan->HrefValue = "";

            // pakaian
            $this->pakaian->LinkCustomAttributes = "";
            $this->pakaian->HrefValue = "";

            // ekspresi
            $this->ekspresi->LinkCustomAttributes = "";
            $this->ekspresi->HrefValue = "";

            // berbicara
            $this->berbicara->LinkCustomAttributes = "";
            $this->berbicara->HrefValue = "";

            // penggunaan_kata
            $this->penggunaan_kata->LinkCustomAttributes = "";
            $this->penggunaan_kata->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->no_rawat->Required) {
            if (!$this->no_rawat->IsDetailKey && EmptyValue($this->no_rawat->FormValue)) {
                $this->no_rawat->addErrorMessage(str_replace("%s", $this->no_rawat->caption(), $this->no_rawat->RequiredErrorMessage));
            }
        }
        if ($this->tanggal->Required) {
            if (!$this->tanggal->IsDetailKey && EmptyValue($this->tanggal->FormValue)) {
                $this->tanggal->addErrorMessage(str_replace("%s", $this->tanggal->caption(), $this->tanggal->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal->FormValue)) {
            $this->tanggal->addErrorMessage($this->tanggal->getErrorMessage(false));
        }
        if ($this->nip->Required) {
            if (!$this->nip->IsDetailKey && EmptyValue($this->nip->FormValue)) {
                $this->nip->addErrorMessage(str_replace("%s", $this->nip->caption(), $this->nip->RequiredErrorMessage));
            }
        }
        if ($this->anamnesis->Required) {
            if ($this->anamnesis->FormValue == "") {
                $this->anamnesis->addErrorMessage(str_replace("%s", $this->anamnesis->caption(), $this->anamnesis->RequiredErrorMessage));
            }
        }
        if ($this->dikirim_dari->Required) {
            if ($this->dikirim_dari->FormValue == "") {
                $this->dikirim_dari->addErrorMessage(str_replace("%s", $this->dikirim_dari->caption(), $this->dikirim_dari->RequiredErrorMessage));
            }
        }
        if ($this->tujuan_pemeriksaan->Required) {
            if ($this->tujuan_pemeriksaan->FormValue == "") {
                $this->tujuan_pemeriksaan->addErrorMessage(str_replace("%s", $this->tujuan_pemeriksaan->caption(), $this->tujuan_pemeriksaan->RequiredErrorMessage));
            }
        }
        if ($this->rupa->Required) {
            if ($this->rupa->FormValue == "") {
                $this->rupa->addErrorMessage(str_replace("%s", $this->rupa->caption(), $this->rupa->RequiredErrorMessage));
            }
        }
        if ($this->bentuk_tubuh->Required) {
            if ($this->bentuk_tubuh->FormValue == "") {
                $this->bentuk_tubuh->addErrorMessage(str_replace("%s", $this->bentuk_tubuh->caption(), $this->bentuk_tubuh->RequiredErrorMessage));
            }
        }
        if ($this->tindakan->Required) {
            if ($this->tindakan->FormValue == "") {
                $this->tindakan->addErrorMessage(str_replace("%s", $this->tindakan->caption(), $this->tindakan->RequiredErrorMessage));
            }
        }
        if ($this->pakaian->Required) {
            if ($this->pakaian->FormValue == "") {
                $this->pakaian->addErrorMessage(str_replace("%s", $this->pakaian->caption(), $this->pakaian->RequiredErrorMessage));
            }
        }
        if ($this->ekspresi->Required) {
            if ($this->ekspresi->FormValue == "") {
                $this->ekspresi->addErrorMessage(str_replace("%s", $this->ekspresi->caption(), $this->ekspresi->RequiredErrorMessage));
            }
        }
        if ($this->berbicara->Required) {
            if ($this->berbicara->FormValue == "") {
                $this->berbicara->addErrorMessage(str_replace("%s", $this->berbicara->caption(), $this->berbicara->RequiredErrorMessage));
            }
        }
        if ($this->penggunaan_kata->Required) {
            if ($this->penggunaan_kata->FormValue == "") {
                $this->penggunaan_kata->addErrorMessage(str_replace("%s", $this->penggunaan_kata->caption(), $this->penggunaan_kata->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $deleteRows = true;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAll($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }

        // Clone old rows
        $rsold = $rows;

        // Call row deleting event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $deleteRows = $this->rowDeleting($row);
                if (!$deleteRows) {
                    break;
                }
            }
        }
        if ($deleteRows) {
            $key = "";
            foreach ($rsold as $row) {
                $thisKey = "";
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['id_penilaian_psikologi'];
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }
                $deleteRows = $this->delete($row); // Delete
                if ($deleteRows === false) {
                    break;
                }
                if ($key != "") {
                    $key .= ", ";
                }
                $key .= $thisKey;
            }
        }
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }

        // Call Row Deleted event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $this->rowDeleted($row);
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssoc($sql);
        $editRow = false;
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // no_rawat
            if ($this->no_rawat->getSessionValue() != "") {
                $this->no_rawat->ReadOnly = true;
            }
            $this->no_rawat->setDbValueDef($rsnew, $this->no_rawat->CurrentValue, "", $this->no_rawat->ReadOnly);

            // tanggal
            $this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), CurrentDate(), $this->tanggal->ReadOnly);

            // nip
            $this->nip->setDbValueDef($rsnew, $this->nip->CurrentValue, "", $this->nip->ReadOnly);

            // anamnesis
            $this->anamnesis->setDbValueDef($rsnew, $this->anamnesis->CurrentValue, "", $this->anamnesis->ReadOnly);

            // dikirim_dari
            $this->dikirim_dari->setDbValueDef($rsnew, $this->dikirim_dari->CurrentValue, "", $this->dikirim_dari->ReadOnly);

            // tujuan_pemeriksaan
            $this->tujuan_pemeriksaan->setDbValueDef($rsnew, $this->tujuan_pemeriksaan->CurrentValue, "", $this->tujuan_pemeriksaan->ReadOnly);

            // rupa
            $this->rupa->setDbValueDef($rsnew, $this->rupa->CurrentValue, "", $this->rupa->ReadOnly);

            // bentuk_tubuh
            $this->bentuk_tubuh->setDbValueDef($rsnew, $this->bentuk_tubuh->CurrentValue, "", $this->bentuk_tubuh->ReadOnly);

            // tindakan
            $this->tindakan->setDbValueDef($rsnew, $this->tindakan->CurrentValue, "", $this->tindakan->ReadOnly);

            // pakaian
            $this->pakaian->setDbValueDef($rsnew, $this->pakaian->CurrentValue, "", $this->pakaian->ReadOnly);

            // ekspresi
            $this->ekspresi->setDbValueDef($rsnew, $this->ekspresi->CurrentValue, "", $this->ekspresi->ReadOnly);

            // berbicara
            $this->berbicara->setDbValueDef($rsnew, $this->berbicara->CurrentValue, "", $this->berbicara->ReadOnly);

            // penggunaan_kata
            $this->penggunaan_kata->setDbValueDef($rsnew, $this->penggunaan_kata->CurrentValue, "", $this->penggunaan_kata->ReadOnly);

            // Check referential integrity for master table 'vrajal'
            $validMasterRecord = true;
            $masterFilter = $this->sqlMasterFilter_vrajal();
            $keyValue = $rsnew['no_rawat'] ?? $rsold['no_rawat'];
            if (strval($keyValue) != "") {
                $masterFilter = str_replace("@id_reg@", AdjustSql($keyValue), $masterFilter);
            } else {
                $validMasterRecord = false;
            }
            if ($validMasterRecord) {
                $rsmaster = Container("vrajal")->loadRs($masterFilter)->fetch();
                $validMasterRecord = $rsmaster !== false;
            }
            if (!$validMasterRecord) {
                $relatedRecordMsg = str_replace("%t", "vrajal", $Language->phrase("RelatedRecordRequired"));
                $this->setFailureMessage($relatedRecordMsg);
                return false;
            }

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    try {
                        $editRow = $this->update($rsnew, "", $rsold);
                    } catch (\Exception $e) {
                        $this->setFailureMessage($e->getMessage());
                    }
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set up foreign key field value from Session
        if ($this->getCurrentMasterTable() == "vigd") {
            $this->no_rawat->CurrentValue = $this->no_rawat->getSessionValue();
        }
        if ($this->getCurrentMasterTable() == "vrajal") {
            $this->no_rawat->CurrentValue = $this->no_rawat->getSessionValue();
        }

        // Check referential integrity for master table 'penilaian_psikologi'
        $validMasterRecord = true;
        $masterFilter = $this->sqlMasterFilter_vrajal();
        if (strval($this->no_rawat->CurrentValue) != "") {
            $masterFilter = str_replace("@id_reg@", AdjustSql($this->no_rawat->CurrentValue, "DB"), $masterFilter);
        } else {
            $validMasterRecord = false;
        }
        if ($validMasterRecord) {
            $rsmaster = Container("vrajal")->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "vrajal", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // no_rawat
        $this->no_rawat->setDbValueDef($rsnew, $this->no_rawat->CurrentValue, "", false);

        // tanggal
        $this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), CurrentDate(), false);

        // nip
        $this->nip->setDbValueDef($rsnew, $this->nip->CurrentValue, "", false);

        // anamnesis
        $this->anamnesis->setDbValueDef($rsnew, $this->anamnesis->CurrentValue, "", false);

        // dikirim_dari
        $this->dikirim_dari->setDbValueDef($rsnew, $this->dikirim_dari->CurrentValue, "", false);

        // tujuan_pemeriksaan
        $this->tujuan_pemeriksaan->setDbValueDef($rsnew, $this->tujuan_pemeriksaan->CurrentValue, "", false);

        // rupa
        $this->rupa->setDbValueDef($rsnew, $this->rupa->CurrentValue, "", false);

        // bentuk_tubuh
        $this->bentuk_tubuh->setDbValueDef($rsnew, $this->bentuk_tubuh->CurrentValue, "", false);

        // tindakan
        $this->tindakan->setDbValueDef($rsnew, $this->tindakan->CurrentValue, "", false);

        // pakaian
        $this->pakaian->setDbValueDef($rsnew, $this->pakaian->CurrentValue, "", false);

        // ekspresi
        $this->ekspresi->setDbValueDef($rsnew, $this->ekspresi->CurrentValue, "", false);

        // berbicara
        $this->berbicara->setDbValueDef($rsnew, $this->berbicara->CurrentValue, "", false);

        // penggunaan_kata
        $this->penggunaan_kata->setDbValueDef($rsnew, $this->penggunaan_kata->CurrentValue, "", false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        // Hide foreign keys
        $masterTblVar = $this->getCurrentMasterTable();
        if ($masterTblVar == "vigd") {
            $masterTbl = Container("vigd");
            $this->no_rawat->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
        }
        if ($masterTblVar == "vrajal") {
            $masterTbl = Container("vrajal");
            $this->no_rawat->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
                case "x_dikirim_dari":
                    break;
                case "x_tujuan_pemeriksaan":
                    break;
                case "x_rupa":
                    break;
                case "x_bentuk_tubuh":
                    break;
                case "x_tindakan":
                    break;
                case "x_pakaian":
                    break;
                case "x_ekspresi":
                    break;
                case "x_berbicara":
                    break;
                case "x_penggunaan_kata":
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
}
