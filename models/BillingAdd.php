<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class BillingAdd extends Billing
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'billing';

    // Page object name
    public $PageObjName = "BillingAdd";

    // Rendering View
    public $RenderingView = false;

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

        // Table object (billing)
        if (!isset($GLOBALS["billing"]) || get_class($GLOBALS["billing"]) == PROJECT_NAMESPACE . "billing") {
            $GLOBALS["billing"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'billing');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
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
                $doc = new $class(Container("billing"));
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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "BillingView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
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
            $key .= @$ar['id_billing'];
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
            $this->id_billing->Visible = false;
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id_billing->Visible = false;
        $this->no_reg->setVisibility();
        $this->tgl_byr->setVisibility();
        $this->no->setVisibility();
        $this->nm_perawatan->setVisibility();
        $this->pemisah->setVisibility();
        $this->biaya->setVisibility();
        $this->jumlah->setVisibility();
        $this->tambahan->setVisibility();
        $this->totalbiaya->setVisibility();
        $this->status->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id_billing") ?? Route("id_billing")) !== null) {
                $this->id_billing->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Set up master/detail parameters
        // NOTE: must be after loadOldRecord to prevent master key values overwritten
        $this->setupMasterParms();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("BillingList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "BillingList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "BillingView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id_billing->CurrentValue = null;
        $this->id_billing->OldValue = $this->id_billing->CurrentValue;
        $this->no_reg->CurrentValue = null;
        $this->no_reg->OldValue = $this->no_reg->CurrentValue;
        $this->tgl_byr->CurrentValue = null;
        $this->tgl_byr->OldValue = $this->tgl_byr->CurrentValue;
        $this->no->CurrentValue = null;
        $this->no->OldValue = $this->no->CurrentValue;
        $this->nm_perawatan->CurrentValue = null;
        $this->nm_perawatan->OldValue = $this->nm_perawatan->CurrentValue;
        $this->pemisah->CurrentValue = null;
        $this->pemisah->OldValue = $this->pemisah->CurrentValue;
        $this->biaya->CurrentValue = null;
        $this->biaya->OldValue = $this->biaya->CurrentValue;
        $this->jumlah->CurrentValue = null;
        $this->jumlah->OldValue = $this->jumlah->CurrentValue;
        $this->tambahan->CurrentValue = null;
        $this->tambahan->OldValue = $this->tambahan->CurrentValue;
        $this->totalbiaya->CurrentValue = null;
        $this->totalbiaya->OldValue = $this->totalbiaya->CurrentValue;
        $this->status->CurrentValue = null;
        $this->status->OldValue = $this->status->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'no_reg' first before field var 'x_no_reg'
        $val = $CurrentForm->hasValue("no_reg") ? $CurrentForm->getValue("no_reg") : $CurrentForm->getValue("x_no_reg");
        if (!$this->no_reg->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_reg->Visible = false; // Disable update for API request
            } else {
                $this->no_reg->setFormValue($val);
            }
        }

        // Check field name 'tgl_byr' first before field var 'x_tgl_byr'
        $val = $CurrentForm->hasValue("tgl_byr") ? $CurrentForm->getValue("tgl_byr") : $CurrentForm->getValue("x_tgl_byr");
        if (!$this->tgl_byr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_byr->Visible = false; // Disable update for API request
            } else {
                $this->tgl_byr->setFormValue($val);
            }
            $this->tgl_byr->CurrentValue = UnFormatDateTime($this->tgl_byr->CurrentValue, 0);
        }

        // Check field name 'no' first before field var 'x_no'
        $val = $CurrentForm->hasValue("no") ? $CurrentForm->getValue("no") : $CurrentForm->getValue("x_no");
        if (!$this->no->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no->Visible = false; // Disable update for API request
            } else {
                $this->no->setFormValue($val);
            }
        }

        // Check field name 'nm_perawatan' first before field var 'x_nm_perawatan'
        $val = $CurrentForm->hasValue("nm_perawatan") ? $CurrentForm->getValue("nm_perawatan") : $CurrentForm->getValue("x_nm_perawatan");
        if (!$this->nm_perawatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nm_perawatan->Visible = false; // Disable update for API request
            } else {
                $this->nm_perawatan->setFormValue($val);
            }
        }

        // Check field name 'pemisah' first before field var 'x_pemisah'
        $val = $CurrentForm->hasValue("pemisah") ? $CurrentForm->getValue("pemisah") : $CurrentForm->getValue("x_pemisah");
        if (!$this->pemisah->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pemisah->Visible = false; // Disable update for API request
            } else {
                $this->pemisah->setFormValue($val);
            }
        }

        // Check field name 'biaya' first before field var 'x_biaya'
        $val = $CurrentForm->hasValue("biaya") ? $CurrentForm->getValue("biaya") : $CurrentForm->getValue("x_biaya");
        if (!$this->biaya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->biaya->Visible = false; // Disable update for API request
            } else {
                $this->biaya->setFormValue($val);
            }
        }

        // Check field name 'jumlah' first before field var 'x_jumlah'
        $val = $CurrentForm->hasValue("jumlah") ? $CurrentForm->getValue("jumlah") : $CurrentForm->getValue("x_jumlah");
        if (!$this->jumlah->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlah->Visible = false; // Disable update for API request
            } else {
                $this->jumlah->setFormValue($val);
            }
        }

        // Check field name 'tambahan' first before field var 'x_tambahan'
        $val = $CurrentForm->hasValue("tambahan") ? $CurrentForm->getValue("tambahan") : $CurrentForm->getValue("x_tambahan");
        if (!$this->tambahan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tambahan->Visible = false; // Disable update for API request
            } else {
                $this->tambahan->setFormValue($val);
            }
        }

        // Check field name 'totalbiaya' first before field var 'x_totalbiaya'
        $val = $CurrentForm->hasValue("totalbiaya") ? $CurrentForm->getValue("totalbiaya") : $CurrentForm->getValue("x_totalbiaya");
        if (!$this->totalbiaya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->totalbiaya->Visible = false; // Disable update for API request
            } else {
                $this->totalbiaya->setFormValue($val);
            }
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'id_billing' first before field var 'x_id_billing'
        $val = $CurrentForm->hasValue("id_billing") ? $CurrentForm->getValue("id_billing") : $CurrentForm->getValue("x_id_billing");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->no_reg->CurrentValue = $this->no_reg->FormValue;
        $this->tgl_byr->CurrentValue = $this->tgl_byr->FormValue;
        $this->tgl_byr->CurrentValue = UnFormatDateTime($this->tgl_byr->CurrentValue, 0);
        $this->no->CurrentValue = $this->no->FormValue;
        $this->nm_perawatan->CurrentValue = $this->nm_perawatan->FormValue;
        $this->pemisah->CurrentValue = $this->pemisah->FormValue;
        $this->biaya->CurrentValue = $this->biaya->FormValue;
        $this->jumlah->CurrentValue = $this->jumlah->FormValue;
        $this->tambahan->CurrentValue = $this->tambahan->FormValue;
        $this->totalbiaya->CurrentValue = $this->totalbiaya->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
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

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_billing'] = $this->id_billing->CurrentValue;
        $row['no_reg'] = $this->no_reg->CurrentValue;
        $row['tgl_byr'] = $this->tgl_byr->CurrentValue;
        $row['no'] = $this->no->CurrentValue;
        $row['nm_perawatan'] = $this->nm_perawatan->CurrentValue;
        $row['pemisah'] = $this->pemisah->CurrentValue;
        $row['biaya'] = $this->biaya->CurrentValue;
        $row['jumlah'] = $this->jumlah->CurrentValue;
        $row['tambahan'] = $this->tambahan->CurrentValue;
        $row['totalbiaya'] = $this->totalbiaya->CurrentValue;
        $row['status'] = $this->status->CurrentValue;
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

        // Convert decimal values if posted back
        if ($this->biaya->FormValue == $this->biaya->CurrentValue && is_numeric(ConvertToFloatString($this->biaya->CurrentValue))) {
            $this->biaya->CurrentValue = ConvertToFloatString($this->biaya->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->jumlah->FormValue == $this->jumlah->CurrentValue && is_numeric(ConvertToFloatString($this->jumlah->CurrentValue))) {
            $this->jumlah->CurrentValue = ConvertToFloatString($this->jumlah->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->tambahan->FormValue == $this->tambahan->CurrentValue && is_numeric(ConvertToFloatString($this->tambahan->CurrentValue))) {
            $this->tambahan->CurrentValue = ConvertToFloatString($this->tambahan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->totalbiaya->FormValue == $this->totalbiaya->CurrentValue && is_numeric(ConvertToFloatString($this->totalbiaya->CurrentValue))) {
            $this->totalbiaya->CurrentValue = ConvertToFloatString($this->totalbiaya->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

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
        if ($this->RowType == ROWTYPE_VIEW) {
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
        } elseif ($this->RowType == ROWTYPE_ADD) {
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
                $this->no_reg->EditValue = HtmlEncode($this->no_reg->CurrentValue);
                $this->no_reg->PlaceHolder = RemoveHtml($this->no_reg->caption());
            }

            // tgl_byr
            $this->tgl_byr->EditAttrs["class"] = "form-control";
            $this->tgl_byr->EditCustomAttributes = "";
            $this->tgl_byr->EditValue = HtmlEncode(FormatDateTime($this->tgl_byr->CurrentValue, 8));
            $this->tgl_byr->PlaceHolder = RemoveHtml($this->tgl_byr->caption());

            // no
            $this->no->EditAttrs["class"] = "form-control";
            $this->no->EditCustomAttributes = "";
            if (!$this->no->Raw) {
                $this->no->CurrentValue = HtmlDecode($this->no->CurrentValue);
            }
            $this->no->EditValue = HtmlEncode($this->no->CurrentValue);
            $this->no->PlaceHolder = RemoveHtml($this->no->caption());

            // nm_perawatan
            $this->nm_perawatan->EditAttrs["class"] = "form-control";
            $this->nm_perawatan->EditCustomAttributes = "";
            if (!$this->nm_perawatan->Raw) {
                $this->nm_perawatan->CurrentValue = HtmlDecode($this->nm_perawatan->CurrentValue);
            }
            $this->nm_perawatan->EditValue = HtmlEncode($this->nm_perawatan->CurrentValue);
            $this->nm_perawatan->PlaceHolder = RemoveHtml($this->nm_perawatan->caption());

            // pemisah
            $this->pemisah->EditAttrs["class"] = "form-control";
            $this->pemisah->EditCustomAttributes = "";
            if (!$this->pemisah->Raw) {
                $this->pemisah->CurrentValue = HtmlDecode($this->pemisah->CurrentValue);
            }
            $this->pemisah->EditValue = HtmlEncode($this->pemisah->CurrentValue);
            $this->pemisah->PlaceHolder = RemoveHtml($this->pemisah->caption());

            // biaya
            $this->biaya->EditAttrs["class"] = "form-control";
            $this->biaya->EditCustomAttributes = "";
            $this->biaya->EditValue = HtmlEncode($this->biaya->CurrentValue);
            $this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
            if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue)) {
                $this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -2, -2, -2);
            }

            // jumlah
            $this->jumlah->EditAttrs["class"] = "form-control";
            $this->jumlah->EditCustomAttributes = "";
            $this->jumlah->EditValue = HtmlEncode($this->jumlah->CurrentValue);
            $this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());
            if (strval($this->jumlah->EditValue) != "" && is_numeric($this->jumlah->EditValue)) {
                $this->jumlah->EditValue = FormatNumber($this->jumlah->EditValue, -2, -2, -2, -2);
            }

            // tambahan
            $this->tambahan->EditAttrs["class"] = "form-control";
            $this->tambahan->EditCustomAttributes = "";
            $this->tambahan->EditValue = HtmlEncode($this->tambahan->CurrentValue);
            $this->tambahan->PlaceHolder = RemoveHtml($this->tambahan->caption());
            if (strval($this->tambahan->EditValue) != "" && is_numeric($this->tambahan->EditValue)) {
                $this->tambahan->EditValue = FormatNumber($this->tambahan->EditValue, -2, -2, -2, -2);
            }

            // totalbiaya
            $this->totalbiaya->EditAttrs["class"] = "form-control";
            $this->totalbiaya->EditCustomAttributes = "";
            $this->totalbiaya->EditValue = HtmlEncode($this->totalbiaya->CurrentValue);
            $this->totalbiaya->PlaceHolder = RemoveHtml($this->totalbiaya->caption());
            if (strval($this->totalbiaya->EditValue) != "" && is_numeric($this->totalbiaya->EditValue)) {
                $this->totalbiaya->EditValue = FormatNumber($this->totalbiaya->EditValue, -2, -2, -2, -2);
            }

            // status
            $this->status->EditCustomAttributes = "";
            $this->status->EditValue = $this->status->options(false);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // Add refer script

            // no_reg
            $this->no_reg->LinkCustomAttributes = "";
            $this->no_reg->HrefValue = "";

            // tgl_byr
            $this->tgl_byr->LinkCustomAttributes = "";
            $this->tgl_byr->HrefValue = "";

            // no
            $this->no->LinkCustomAttributes = "";
            $this->no->HrefValue = "";

            // nm_perawatan
            $this->nm_perawatan->LinkCustomAttributes = "";
            $this->nm_perawatan->HrefValue = "";

            // pemisah
            $this->pemisah->LinkCustomAttributes = "";
            $this->pemisah->HrefValue = "";

            // biaya
            $this->biaya->LinkCustomAttributes = "";
            $this->biaya->HrefValue = "";

            // jumlah
            $this->jumlah->LinkCustomAttributes = "";
            $this->jumlah->HrefValue = "";

            // tambahan
            $this->tambahan->LinkCustomAttributes = "";
            $this->tambahan->HrefValue = "";

            // totalbiaya
            $this->totalbiaya->LinkCustomAttributes = "";
            $this->totalbiaya->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
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
        if ($this->no_reg->Required) {
            if (!$this->no_reg->IsDetailKey && EmptyValue($this->no_reg->FormValue)) {
                $this->no_reg->addErrorMessage(str_replace("%s", $this->no_reg->caption(), $this->no_reg->RequiredErrorMessage));
            }
        }
        if ($this->tgl_byr->Required) {
            if (!$this->tgl_byr->IsDetailKey && EmptyValue($this->tgl_byr->FormValue)) {
                $this->tgl_byr->addErrorMessage(str_replace("%s", $this->tgl_byr->caption(), $this->tgl_byr->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_byr->FormValue)) {
            $this->tgl_byr->addErrorMessage($this->tgl_byr->getErrorMessage(false));
        }
        if ($this->no->Required) {
            if (!$this->no->IsDetailKey && EmptyValue($this->no->FormValue)) {
                $this->no->addErrorMessage(str_replace("%s", $this->no->caption(), $this->no->RequiredErrorMessage));
            }
        }
        if ($this->nm_perawatan->Required) {
            if (!$this->nm_perawatan->IsDetailKey && EmptyValue($this->nm_perawatan->FormValue)) {
                $this->nm_perawatan->addErrorMessage(str_replace("%s", $this->nm_perawatan->caption(), $this->nm_perawatan->RequiredErrorMessage));
            }
        }
        if ($this->pemisah->Required) {
            if (!$this->pemisah->IsDetailKey && EmptyValue($this->pemisah->FormValue)) {
                $this->pemisah->addErrorMessage(str_replace("%s", $this->pemisah->caption(), $this->pemisah->RequiredErrorMessage));
            }
        }
        if ($this->biaya->Required) {
            if (!$this->biaya->IsDetailKey && EmptyValue($this->biaya->FormValue)) {
                $this->biaya->addErrorMessage(str_replace("%s", $this->biaya->caption(), $this->biaya->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->biaya->FormValue)) {
            $this->biaya->addErrorMessage($this->biaya->getErrorMessage(false));
        }
        if ($this->jumlah->Required) {
            if (!$this->jumlah->IsDetailKey && EmptyValue($this->jumlah->FormValue)) {
                $this->jumlah->addErrorMessage(str_replace("%s", $this->jumlah->caption(), $this->jumlah->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->jumlah->FormValue)) {
            $this->jumlah->addErrorMessage($this->jumlah->getErrorMessage(false));
        }
        if ($this->tambahan->Required) {
            if (!$this->tambahan->IsDetailKey && EmptyValue($this->tambahan->FormValue)) {
                $this->tambahan->addErrorMessage(str_replace("%s", $this->tambahan->caption(), $this->tambahan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->tambahan->FormValue)) {
            $this->tambahan->addErrorMessage($this->tambahan->getErrorMessage(false));
        }
        if ($this->totalbiaya->Required) {
            if (!$this->totalbiaya->IsDetailKey && EmptyValue($this->totalbiaya->FormValue)) {
                $this->totalbiaya->addErrorMessage(str_replace("%s", $this->totalbiaya->caption(), $this->totalbiaya->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->totalbiaya->FormValue)) {
            $this->totalbiaya->addErrorMessage($this->totalbiaya->getErrorMessage(false));
        }
        if ($this->status->Required) {
            if ($this->status->FormValue == "") {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Check referential integrity for master table 'billing'
        $validMasterRecord = true;
        $masterFilter = $this->sqlMasterFilter_vrajal();
        if (strval($this->no_reg->CurrentValue) != "") {
            $masterFilter = str_replace("@id_reg@", AdjustSql($this->no_reg->CurrentValue, "DB"), $masterFilter);
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

        // no_reg
        $this->no_reg->setDbValueDef($rsnew, $this->no_reg->CurrentValue, "", false);

        // tgl_byr
        $this->tgl_byr->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_byr->CurrentValue, 0), null, false);

        // no
        $this->no->setDbValueDef($rsnew, $this->no->CurrentValue, "", false);

        // nm_perawatan
        $this->nm_perawatan->setDbValueDef($rsnew, $this->nm_perawatan->CurrentValue, "", false);

        // pemisah
        $this->pemisah->setDbValueDef($rsnew, $this->pemisah->CurrentValue, "", false);

        // biaya
        $this->biaya->setDbValueDef($rsnew, $this->biaya->CurrentValue, 0, false);

        // jumlah
        $this->jumlah->setDbValueDef($rsnew, $this->jumlah->CurrentValue, 0, false);

        // tambahan
        $this->tambahan->setDbValueDef($rsnew, $this->tambahan->CurrentValue, 0, false);

        // totalbiaya
        $this->totalbiaya->setDbValueDef($rsnew, $this->totalbiaya->CurrentValue, 0, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, false);

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
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "vrajal") {
                $validMaster = true;
                $masterTbl = Container("vrajal");
                if (($parm = Get("fk_id_reg", Get("no_reg"))) !== null) {
                    $masterTbl->id_reg->setQueryStringValue($parm);
                    $this->no_reg->setQueryStringValue($masterTbl->id_reg->QueryStringValue);
                    $this->no_reg->setSessionValue($this->no_reg->QueryStringValue);
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
            if ($masterTblVar == "vrajal") {
                $validMaster = true;
                $masterTbl = Container("vrajal");
                if (($parm = Post("fk_id_reg", Post("no_reg"))) !== null) {
                    $masterTbl->id_reg->setFormValue($parm);
                    $this->no_reg->setFormValue($masterTbl->id_reg->FormValue);
                    $this->no_reg->setSessionValue($this->no_reg->FormValue);
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

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "vrajal") {
                if ($this->no_reg->CurrentValue == "") {
                    $this->no_reg->setSessionValue("");
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("BillingList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_status":
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
}
