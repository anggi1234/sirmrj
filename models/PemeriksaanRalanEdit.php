<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PemeriksaanRalanEdit extends PemeriksaanRalan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pemeriksaan_ralan';

    // Page object name
    public $PageObjName = "PemeriksaanRalanEdit";

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

        // Table object (pemeriksaan_ralan)
        if (!isset($GLOBALS["pemeriksaan_ralan"]) || get_class($GLOBALS["pemeriksaan_ralan"]) == PROJECT_NAMESPACE . "pemeriksaan_ralan") {
            $GLOBALS["pemeriksaan_ralan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pemeriksaan_ralan');
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
                $doc = new $class(Container("pemeriksaan_ralan"));
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
                    if ($pageName == "PemeriksaanRalanView") {
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
            $key .= @$ar['id_pemeriksaan_ralan'];
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
            $this->id_pemeriksaan_ralan->Visible = false;
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
    public $FormClassName = "ew-horizontal ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->no_rawat->setVisibility();
        $this->tgl_perawatan->setVisibility();
        $this->jam_rawat->setVisibility();
        $this->suhu_tubuh->setVisibility();
        $this->tensi->setVisibility();
        $this->nadi->setVisibility();
        $this->respirasi->setVisibility();
        $this->tinggi->setVisibility();
        $this->berat->setVisibility();
        $this->spo2->setVisibility();
        $this->gcs->setVisibility();
        $this->kesadaran->setVisibility();
        $this->keluhan->setVisibility();
        $this->pemeriksaan->setVisibility();
        $this->alergi->setVisibility();
        $this->lingkar_perut->setVisibility();
        $this->rtl->setVisibility();
        $this->penilaian->setVisibility();
        $this->instruksi->setVisibility();
        $this->evaluasi->setVisibility();
        $this->nip->setVisibility();
        $this->id_pemeriksaan_ralan->setVisibility();
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
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id_pemeriksaan_ralan") ?? Key(0) ?? Route(2)) !== null) {
                $this->id_pemeriksaan_ralan->setQueryStringValue($keyValue);
                $this->id_pemeriksaan_ralan->setOldValue($this->id_pemeriksaan_ralan->QueryStringValue);
            } elseif (Post("id_pemeriksaan_ralan") !== null) {
                $this->id_pemeriksaan_ralan->setFormValue(Post("id_pemeriksaan_ralan"));
                $this->id_pemeriksaan_ralan->setOldValue($this->id_pemeriksaan_ralan->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id_pemeriksaan_ralan") ?? Route("id_pemeriksaan_ralan")) !== null) {
                    $this->id_pemeriksaan_ralan->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id_pemeriksaan_ralan->CurrentValue = null;
                }
            }

            // Set up master detail parameters
            $this->setupMasterParms();

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("PemeriksaanRalanList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "PemeriksaanRalanList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'no_rawat' first before field var 'x_no_rawat'
        $val = $CurrentForm->hasValue("no_rawat") ? $CurrentForm->getValue("no_rawat") : $CurrentForm->getValue("x_no_rawat");
        if (!$this->no_rawat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rawat->Visible = false; // Disable update for API request
            } else {
                $this->no_rawat->setFormValue($val);
            }
        }

        // Check field name 'tgl_perawatan' first before field var 'x_tgl_perawatan'
        $val = $CurrentForm->hasValue("tgl_perawatan") ? $CurrentForm->getValue("tgl_perawatan") : $CurrentForm->getValue("x_tgl_perawatan");
        if (!$this->tgl_perawatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_perawatan->Visible = false; // Disable update for API request
            } else {
                $this->tgl_perawatan->setFormValue($val);
            }
            $this->tgl_perawatan->CurrentValue = UnFormatDateTime($this->tgl_perawatan->CurrentValue, 0);
        }

        // Check field name 'jam_rawat' first before field var 'x_jam_rawat'
        $val = $CurrentForm->hasValue("jam_rawat") ? $CurrentForm->getValue("jam_rawat") : $CurrentForm->getValue("x_jam_rawat");
        if (!$this->jam_rawat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jam_rawat->Visible = false; // Disable update for API request
            } else {
                $this->jam_rawat->setFormValue($val);
            }
            $this->jam_rawat->CurrentValue = UnFormatDateTime($this->jam_rawat->CurrentValue, 4);
        }

        // Check field name 'suhu_tubuh' first before field var 'x_suhu_tubuh'
        $val = $CurrentForm->hasValue("suhu_tubuh") ? $CurrentForm->getValue("suhu_tubuh") : $CurrentForm->getValue("x_suhu_tubuh");
        if (!$this->suhu_tubuh->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->suhu_tubuh->Visible = false; // Disable update for API request
            } else {
                $this->suhu_tubuh->setFormValue($val);
            }
        }

        // Check field name 'tensi' first before field var 'x_tensi'
        $val = $CurrentForm->hasValue("tensi") ? $CurrentForm->getValue("tensi") : $CurrentForm->getValue("x_tensi");
        if (!$this->tensi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tensi->Visible = false; // Disable update for API request
            } else {
                $this->tensi->setFormValue($val);
            }
        }

        // Check field name 'nadi' first before field var 'x_nadi'
        $val = $CurrentForm->hasValue("nadi") ? $CurrentForm->getValue("nadi") : $CurrentForm->getValue("x_nadi");
        if (!$this->nadi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nadi->Visible = false; // Disable update for API request
            } else {
                $this->nadi->setFormValue($val);
            }
        }

        // Check field name 'respirasi' first before field var 'x_respirasi'
        $val = $CurrentForm->hasValue("respirasi") ? $CurrentForm->getValue("respirasi") : $CurrentForm->getValue("x_respirasi");
        if (!$this->respirasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->respirasi->Visible = false; // Disable update for API request
            } else {
                $this->respirasi->setFormValue($val);
            }
        }

        // Check field name 'tinggi' first before field var 'x_tinggi'
        $val = $CurrentForm->hasValue("tinggi") ? $CurrentForm->getValue("tinggi") : $CurrentForm->getValue("x_tinggi");
        if (!$this->tinggi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tinggi->Visible = false; // Disable update for API request
            } else {
                $this->tinggi->setFormValue($val);
            }
        }

        // Check field name 'berat' first before field var 'x_berat'
        $val = $CurrentForm->hasValue("berat") ? $CurrentForm->getValue("berat") : $CurrentForm->getValue("x_berat");
        if (!$this->berat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berat->Visible = false; // Disable update for API request
            } else {
                $this->berat->setFormValue($val);
            }
        }

        // Check field name 'spo2' first before field var 'x_spo2'
        $val = $CurrentForm->hasValue("spo2") ? $CurrentForm->getValue("spo2") : $CurrentForm->getValue("x_spo2");
        if (!$this->spo2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->spo2->Visible = false; // Disable update for API request
            } else {
                $this->spo2->setFormValue($val);
            }
        }

        // Check field name 'gcs' first before field var 'x_gcs'
        $val = $CurrentForm->hasValue("gcs") ? $CurrentForm->getValue("gcs") : $CurrentForm->getValue("x_gcs");
        if (!$this->gcs->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gcs->Visible = false; // Disable update for API request
            } else {
                $this->gcs->setFormValue($val);
            }
        }

        // Check field name 'kesadaran' first before field var 'x_kesadaran'
        $val = $CurrentForm->hasValue("kesadaran") ? $CurrentForm->getValue("kesadaran") : $CurrentForm->getValue("x_kesadaran");
        if (!$this->kesadaran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kesadaran->Visible = false; // Disable update for API request
            } else {
                $this->kesadaran->setFormValue($val);
            }
        }

        // Check field name 'keluhan' first before field var 'x_keluhan'
        $val = $CurrentForm->hasValue("keluhan") ? $CurrentForm->getValue("keluhan") : $CurrentForm->getValue("x_keluhan");
        if (!$this->keluhan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keluhan->Visible = false; // Disable update for API request
            } else {
                $this->keluhan->setFormValue($val);
            }
        }

        // Check field name 'pemeriksaan' first before field var 'x_pemeriksaan'
        $val = $CurrentForm->hasValue("pemeriksaan") ? $CurrentForm->getValue("pemeriksaan") : $CurrentForm->getValue("x_pemeriksaan");
        if (!$this->pemeriksaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pemeriksaan->Visible = false; // Disable update for API request
            } else {
                $this->pemeriksaan->setFormValue($val);
            }
        }

        // Check field name 'alergi' first before field var 'x_alergi'
        $val = $CurrentForm->hasValue("alergi") ? $CurrentForm->getValue("alergi") : $CurrentForm->getValue("x_alergi");
        if (!$this->alergi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alergi->Visible = false; // Disable update for API request
            } else {
                $this->alergi->setFormValue($val);
            }
        }

        // Check field name 'lingkar_perut' first before field var 'x_lingkar_perut'
        $val = $CurrentForm->hasValue("lingkar_perut") ? $CurrentForm->getValue("lingkar_perut") : $CurrentForm->getValue("x_lingkar_perut");
        if (!$this->lingkar_perut->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lingkar_perut->Visible = false; // Disable update for API request
            } else {
                $this->lingkar_perut->setFormValue($val);
            }
        }

        // Check field name 'rtl' first before field var 'x_rtl'
        $val = $CurrentForm->hasValue("rtl") ? $CurrentForm->getValue("rtl") : $CurrentForm->getValue("x_rtl");
        if (!$this->rtl->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rtl->Visible = false; // Disable update for API request
            } else {
                $this->rtl->setFormValue($val);
            }
        }

        // Check field name 'penilaian' first before field var 'x_penilaian'
        $val = $CurrentForm->hasValue("penilaian") ? $CurrentForm->getValue("penilaian") : $CurrentForm->getValue("x_penilaian");
        if (!$this->penilaian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->penilaian->Visible = false; // Disable update for API request
            } else {
                $this->penilaian->setFormValue($val);
            }
        }

        // Check field name 'instruksi' first before field var 'x_instruksi'
        $val = $CurrentForm->hasValue("instruksi") ? $CurrentForm->getValue("instruksi") : $CurrentForm->getValue("x_instruksi");
        if (!$this->instruksi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->instruksi->Visible = false; // Disable update for API request
            } else {
                $this->instruksi->setFormValue($val);
            }
        }

        // Check field name 'evaluasi' first before field var 'x_evaluasi'
        $val = $CurrentForm->hasValue("evaluasi") ? $CurrentForm->getValue("evaluasi") : $CurrentForm->getValue("x_evaluasi");
        if (!$this->evaluasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->evaluasi->Visible = false; // Disable update for API request
            } else {
                $this->evaluasi->setFormValue($val);
            }
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

        // Check field name 'id_pemeriksaan_ralan' first before field var 'x_id_pemeriksaan_ralan'
        $val = $CurrentForm->hasValue("id_pemeriksaan_ralan") ? $CurrentForm->getValue("id_pemeriksaan_ralan") : $CurrentForm->getValue("x_id_pemeriksaan_ralan");
        if (!$this->id_pemeriksaan_ralan->IsDetailKey) {
            $this->id_pemeriksaan_ralan->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->tgl_perawatan->CurrentValue = $this->tgl_perawatan->FormValue;
        $this->tgl_perawatan->CurrentValue = UnFormatDateTime($this->tgl_perawatan->CurrentValue, 0);
        $this->jam_rawat->CurrentValue = $this->jam_rawat->FormValue;
        $this->jam_rawat->CurrentValue = UnFormatDateTime($this->jam_rawat->CurrentValue, 4);
        $this->suhu_tubuh->CurrentValue = $this->suhu_tubuh->FormValue;
        $this->tensi->CurrentValue = $this->tensi->FormValue;
        $this->nadi->CurrentValue = $this->nadi->FormValue;
        $this->respirasi->CurrentValue = $this->respirasi->FormValue;
        $this->tinggi->CurrentValue = $this->tinggi->FormValue;
        $this->berat->CurrentValue = $this->berat->FormValue;
        $this->spo2->CurrentValue = $this->spo2->FormValue;
        $this->gcs->CurrentValue = $this->gcs->FormValue;
        $this->kesadaran->CurrentValue = $this->kesadaran->FormValue;
        $this->keluhan->CurrentValue = $this->keluhan->FormValue;
        $this->pemeriksaan->CurrentValue = $this->pemeriksaan->FormValue;
        $this->alergi->CurrentValue = $this->alergi->FormValue;
        $this->lingkar_perut->CurrentValue = $this->lingkar_perut->FormValue;
        $this->rtl->CurrentValue = $this->rtl->FormValue;
        $this->penilaian->CurrentValue = $this->penilaian->FormValue;
        $this->instruksi->CurrentValue = $this->instruksi->FormValue;
        $this->evaluasi->CurrentValue = $this->evaluasi->FormValue;
        $this->nip->CurrentValue = $this->nip->FormValue;
        $this->id_pemeriksaan_ralan->CurrentValue = $this->id_pemeriksaan_ralan->FormValue;
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
        $this->tgl_perawatan->setDbValue($row['tgl_perawatan']);
        $this->jam_rawat->setDbValue($row['jam_rawat']);
        $this->suhu_tubuh->setDbValue($row['suhu_tubuh']);
        $this->tensi->setDbValue($row['tensi']);
        $this->nadi->setDbValue($row['nadi']);
        $this->respirasi->setDbValue($row['respirasi']);
        $this->tinggi->setDbValue($row['tinggi']);
        $this->berat->setDbValue($row['berat']);
        $this->spo2->setDbValue($row['spo2']);
        $this->gcs->setDbValue($row['gcs']);
        $this->kesadaran->setDbValue($row['kesadaran']);
        $this->keluhan->setDbValue($row['keluhan']);
        $this->pemeriksaan->setDbValue($row['pemeriksaan']);
        $this->alergi->setDbValue($row['alergi']);
        $this->lingkar_perut->setDbValue($row['lingkar_perut']);
        $this->rtl->setDbValue($row['rtl']);
        $this->penilaian->setDbValue($row['penilaian']);
        $this->instruksi->setDbValue($row['instruksi']);
        $this->evaluasi->setDbValue($row['evaluasi']);
        $this->nip->setDbValue($row['nip']);
        $this->id_pemeriksaan_ralan->setDbValue($row['id_pemeriksaan_ralan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['no_rawat'] = null;
        $row['tgl_perawatan'] = null;
        $row['jam_rawat'] = null;
        $row['suhu_tubuh'] = null;
        $row['tensi'] = null;
        $row['nadi'] = null;
        $row['respirasi'] = null;
        $row['tinggi'] = null;
        $row['berat'] = null;
        $row['spo2'] = null;
        $row['gcs'] = null;
        $row['kesadaran'] = null;
        $row['keluhan'] = null;
        $row['pemeriksaan'] = null;
        $row['alergi'] = null;
        $row['lingkar_perut'] = null;
        $row['rtl'] = null;
        $row['penilaian'] = null;
        $row['instruksi'] = null;
        $row['evaluasi'] = null;
        $row['nip'] = null;
        $row['id_pemeriksaan_ralan'] = null;
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // no_rawat

        // tgl_perawatan

        // jam_rawat

        // suhu_tubuh

        // tensi

        // nadi

        // respirasi

        // tinggi

        // berat

        // spo2

        // gcs

        // kesadaran

        // keluhan

        // pemeriksaan

        // alergi

        // lingkar_perut

        // rtl

        // penilaian

        // instruksi

        // evaluasi

        // nip

        // id_pemeriksaan_ralan
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_rawat
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";

            // tgl_perawatan
            $this->tgl_perawatan->ViewValue = $this->tgl_perawatan->CurrentValue;
            $this->tgl_perawatan->ViewValue = FormatDateTime($this->tgl_perawatan->ViewValue, 0);
            $this->tgl_perawatan->ViewCustomAttributes = "";

            // jam_rawat
            $this->jam_rawat->ViewValue = $this->jam_rawat->CurrentValue;
            $this->jam_rawat->ViewValue = FormatDateTime($this->jam_rawat->ViewValue, 4);
            $this->jam_rawat->ViewCustomAttributes = "";

            // suhu_tubuh
            $this->suhu_tubuh->ViewValue = $this->suhu_tubuh->CurrentValue;
            $this->suhu_tubuh->ViewCustomAttributes = "";

            // tensi
            $this->tensi->ViewValue = $this->tensi->CurrentValue;
            $this->tensi->ViewCustomAttributes = "";

            // nadi
            $this->nadi->ViewValue = $this->nadi->CurrentValue;
            $this->nadi->ViewCustomAttributes = "";

            // respirasi
            $this->respirasi->ViewValue = $this->respirasi->CurrentValue;
            $this->respirasi->ViewCustomAttributes = "";

            // tinggi
            $this->tinggi->ViewValue = $this->tinggi->CurrentValue;
            $this->tinggi->ViewCustomAttributes = "";

            // berat
            $this->berat->ViewValue = $this->berat->CurrentValue;
            $this->berat->ViewCustomAttributes = "";

            // spo2
            $this->spo2->ViewValue = $this->spo2->CurrentValue;
            $this->spo2->ViewCustomAttributes = "";

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

            // keluhan
            $this->keluhan->ViewValue = $this->keluhan->CurrentValue;
            $this->keluhan->ViewCustomAttributes = "";

            // pemeriksaan
            $this->pemeriksaan->ViewValue = $this->pemeriksaan->CurrentValue;
            $this->pemeriksaan->ViewCustomAttributes = "";

            // alergi
            $this->alergi->ViewValue = $this->alergi->CurrentValue;
            $this->alergi->ViewCustomAttributes = "";

            // lingkar_perut
            $this->lingkar_perut->ViewValue = $this->lingkar_perut->CurrentValue;
            $this->lingkar_perut->ViewCustomAttributes = "";

            // rtl
            $this->rtl->ViewValue = $this->rtl->CurrentValue;
            $this->rtl->ViewCustomAttributes = "";

            // penilaian
            $this->penilaian->ViewValue = $this->penilaian->CurrentValue;
            $this->penilaian->ViewCustomAttributes = "";

            // instruksi
            $this->instruksi->ViewValue = $this->instruksi->CurrentValue;
            $this->instruksi->ViewCustomAttributes = "";

            // evaluasi
            $this->evaluasi->ViewValue = $this->evaluasi->CurrentValue;
            $this->evaluasi->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // id_pemeriksaan_ralan
            $this->id_pemeriksaan_ralan->ViewValue = $this->id_pemeriksaan_ralan->CurrentValue;
            $this->id_pemeriksaan_ralan->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";
            $this->no_rawat->TooltipValue = "";

            // tgl_perawatan
            $this->tgl_perawatan->LinkCustomAttributes = "";
            $this->tgl_perawatan->HrefValue = "";
            $this->tgl_perawatan->TooltipValue = "";

            // jam_rawat
            $this->jam_rawat->LinkCustomAttributes = "";
            $this->jam_rawat->HrefValue = "";
            $this->jam_rawat->TooltipValue = "";

            // suhu_tubuh
            $this->suhu_tubuh->LinkCustomAttributes = "";
            $this->suhu_tubuh->HrefValue = "";
            $this->suhu_tubuh->TooltipValue = "";

            // tensi
            $this->tensi->LinkCustomAttributes = "";
            $this->tensi->HrefValue = "";
            $this->tensi->TooltipValue = "";

            // nadi
            $this->nadi->LinkCustomAttributes = "";
            $this->nadi->HrefValue = "";
            $this->nadi->TooltipValue = "";

            // respirasi
            $this->respirasi->LinkCustomAttributes = "";
            $this->respirasi->HrefValue = "";
            $this->respirasi->TooltipValue = "";

            // tinggi
            $this->tinggi->LinkCustomAttributes = "";
            $this->tinggi->HrefValue = "";
            $this->tinggi->TooltipValue = "";

            // berat
            $this->berat->LinkCustomAttributes = "";
            $this->berat->HrefValue = "";
            $this->berat->TooltipValue = "";

            // spo2
            $this->spo2->LinkCustomAttributes = "";
            $this->spo2->HrefValue = "";
            $this->spo2->TooltipValue = "";

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";
            $this->gcs->TooltipValue = "";

            // kesadaran
            $this->kesadaran->LinkCustomAttributes = "";
            $this->kesadaran->HrefValue = "";
            $this->kesadaran->TooltipValue = "";

            // keluhan
            $this->keluhan->LinkCustomAttributes = "";
            $this->keluhan->HrefValue = "";
            $this->keluhan->TooltipValue = "";

            // pemeriksaan
            $this->pemeriksaan->LinkCustomAttributes = "";
            $this->pemeriksaan->HrefValue = "";
            $this->pemeriksaan->TooltipValue = "";

            // alergi
            $this->alergi->LinkCustomAttributes = "";
            $this->alergi->HrefValue = "";
            $this->alergi->TooltipValue = "";

            // lingkar_perut
            $this->lingkar_perut->LinkCustomAttributes = "";
            $this->lingkar_perut->HrefValue = "";
            $this->lingkar_perut->TooltipValue = "";

            // rtl
            $this->rtl->LinkCustomAttributes = "";
            $this->rtl->HrefValue = "";
            $this->rtl->TooltipValue = "";

            // penilaian
            $this->penilaian->LinkCustomAttributes = "";
            $this->penilaian->HrefValue = "";
            $this->penilaian->TooltipValue = "";

            // instruksi
            $this->instruksi->LinkCustomAttributes = "";
            $this->instruksi->HrefValue = "";
            $this->instruksi->TooltipValue = "";

            // evaluasi
            $this->evaluasi->LinkCustomAttributes = "";
            $this->evaluasi->HrefValue = "";
            $this->evaluasi->TooltipValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";
            $this->nip->TooltipValue = "";

            // id_pemeriksaan_ralan
            $this->id_pemeriksaan_ralan->LinkCustomAttributes = "";
            $this->id_pemeriksaan_ralan->HrefValue = "";
            $this->id_pemeriksaan_ralan->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // no_rawat
            $this->no_rawat->EditAttrs["class"] = "form-control";
            $this->no_rawat->EditCustomAttributes = "";
            if ($this->no_rawat->getSessionValue() != "") {
                $this->no_rawat->CurrentValue = GetForeignKeyValue($this->no_rawat->getSessionValue());
                $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
                $this->no_rawat->ViewCustomAttributes = "";
            } else {
                if (!$this->no_rawat->Raw) {
                    $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
                }
                $this->no_rawat->EditValue = HtmlEncode($this->no_rawat->CurrentValue);
                $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());
            }

            // tgl_perawatan

            // jam_rawat

            // suhu_tubuh
            $this->suhu_tubuh->EditAttrs["class"] = "form-control";
            $this->suhu_tubuh->EditCustomAttributes = "";
            if (!$this->suhu_tubuh->Raw) {
                $this->suhu_tubuh->CurrentValue = HtmlDecode($this->suhu_tubuh->CurrentValue);
            }
            $this->suhu_tubuh->EditValue = HtmlEncode($this->suhu_tubuh->CurrentValue);
            $this->suhu_tubuh->PlaceHolder = RemoveHtml($this->suhu_tubuh->caption());

            // tensi
            $this->tensi->EditAttrs["class"] = "form-control";
            $this->tensi->EditCustomAttributes = "";
            if (!$this->tensi->Raw) {
                $this->tensi->CurrentValue = HtmlDecode($this->tensi->CurrentValue);
            }
            $this->tensi->EditValue = HtmlEncode($this->tensi->CurrentValue);
            $this->tensi->PlaceHolder = RemoveHtml($this->tensi->caption());

            // nadi
            $this->nadi->EditAttrs["class"] = "form-control";
            $this->nadi->EditCustomAttributes = "";
            if (!$this->nadi->Raw) {
                $this->nadi->CurrentValue = HtmlDecode($this->nadi->CurrentValue);
            }
            $this->nadi->EditValue = HtmlEncode($this->nadi->CurrentValue);
            $this->nadi->PlaceHolder = RemoveHtml($this->nadi->caption());

            // respirasi
            $this->respirasi->EditAttrs["class"] = "form-control";
            $this->respirasi->EditCustomAttributes = "";
            if (!$this->respirasi->Raw) {
                $this->respirasi->CurrentValue = HtmlDecode($this->respirasi->CurrentValue);
            }
            $this->respirasi->EditValue = HtmlEncode($this->respirasi->CurrentValue);
            $this->respirasi->PlaceHolder = RemoveHtml($this->respirasi->caption());

            // tinggi
            $this->tinggi->EditAttrs["class"] = "form-control";
            $this->tinggi->EditCustomAttributes = "";
            if (!$this->tinggi->Raw) {
                $this->tinggi->CurrentValue = HtmlDecode($this->tinggi->CurrentValue);
            }
            $this->tinggi->EditValue = HtmlEncode($this->tinggi->CurrentValue);
            $this->tinggi->PlaceHolder = RemoveHtml($this->tinggi->caption());

            // berat
            $this->berat->EditAttrs["class"] = "form-control";
            $this->berat->EditCustomAttributes = "";
            if (!$this->berat->Raw) {
                $this->berat->CurrentValue = HtmlDecode($this->berat->CurrentValue);
            }
            $this->berat->EditValue = HtmlEncode($this->berat->CurrentValue);
            $this->berat->PlaceHolder = RemoveHtml($this->berat->caption());

            // spo2
            $this->spo2->EditAttrs["class"] = "form-control";
            $this->spo2->EditCustomAttributes = "";
            if (!$this->spo2->Raw) {
                $this->spo2->CurrentValue = HtmlDecode($this->spo2->CurrentValue);
            }
            $this->spo2->EditValue = HtmlEncode($this->spo2->CurrentValue);
            $this->spo2->PlaceHolder = RemoveHtml($this->spo2->caption());

            // gcs
            $this->gcs->EditAttrs["class"] = "form-control";
            $this->gcs->EditCustomAttributes = "";
            if (!$this->gcs->Raw) {
                $this->gcs->CurrentValue = HtmlDecode($this->gcs->CurrentValue);
            }
            $this->gcs->EditValue = HtmlEncode($this->gcs->CurrentValue);
            $this->gcs->PlaceHolder = RemoveHtml($this->gcs->caption());

            // kesadaran
            $this->kesadaran->EditCustomAttributes = "";
            $this->kesadaran->EditValue = $this->kesadaran->options(false);
            $this->kesadaran->PlaceHolder = RemoveHtml($this->kesadaran->caption());

            // keluhan
            $this->keluhan->EditAttrs["class"] = "form-control";
            $this->keluhan->EditCustomAttributes = "";
            $this->keluhan->EditValue = HtmlEncode($this->keluhan->CurrentValue);
            $this->keluhan->PlaceHolder = RemoveHtml($this->keluhan->caption());

            // pemeriksaan
            $this->pemeriksaan->EditAttrs["class"] = "form-control";
            $this->pemeriksaan->EditCustomAttributes = "";
            $this->pemeriksaan->EditValue = HtmlEncode($this->pemeriksaan->CurrentValue);
            $this->pemeriksaan->PlaceHolder = RemoveHtml($this->pemeriksaan->caption());

            // alergi
            $this->alergi->EditAttrs["class"] = "form-control";
            $this->alergi->EditCustomAttributes = "";
            if (!$this->alergi->Raw) {
                $this->alergi->CurrentValue = HtmlDecode($this->alergi->CurrentValue);
            }
            $this->alergi->EditValue = HtmlEncode($this->alergi->CurrentValue);
            $this->alergi->PlaceHolder = RemoveHtml($this->alergi->caption());

            // lingkar_perut
            $this->lingkar_perut->EditAttrs["class"] = "form-control";
            $this->lingkar_perut->EditCustomAttributes = "";
            if (!$this->lingkar_perut->Raw) {
                $this->lingkar_perut->CurrentValue = HtmlDecode($this->lingkar_perut->CurrentValue);
            }
            $this->lingkar_perut->EditValue = HtmlEncode($this->lingkar_perut->CurrentValue);
            $this->lingkar_perut->PlaceHolder = RemoveHtml($this->lingkar_perut->caption());

            // rtl
            $this->rtl->EditAttrs["class"] = "form-control";
            $this->rtl->EditCustomAttributes = "";
            $this->rtl->EditValue = HtmlEncode($this->rtl->CurrentValue);
            $this->rtl->PlaceHolder = RemoveHtml($this->rtl->caption());

            // penilaian
            $this->penilaian->EditAttrs["class"] = "form-control";
            $this->penilaian->EditCustomAttributes = "";
            $this->penilaian->EditValue = HtmlEncode($this->penilaian->CurrentValue);
            $this->penilaian->PlaceHolder = RemoveHtml($this->penilaian->caption());

            // instruksi
            $this->instruksi->EditAttrs["class"] = "form-control";
            $this->instruksi->EditCustomAttributes = "";
            $this->instruksi->EditValue = HtmlEncode($this->instruksi->CurrentValue);
            $this->instruksi->PlaceHolder = RemoveHtml($this->instruksi->caption());

            // evaluasi
            $this->evaluasi->EditAttrs["class"] = "form-control";
            $this->evaluasi->EditCustomAttributes = "";
            $this->evaluasi->EditValue = HtmlEncode($this->evaluasi->CurrentValue);
            $this->evaluasi->PlaceHolder = RemoveHtml($this->evaluasi->caption());

            // nip
            $this->nip->EditAttrs["class"] = "form-control";
            $this->nip->EditCustomAttributes = "";
            if (!$this->nip->Raw) {
                $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
            }
            $this->nip->EditValue = HtmlEncode($this->nip->CurrentValue);
            $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

            // id_pemeriksaan_ralan
            $this->id_pemeriksaan_ralan->EditAttrs["class"] = "form-control";
            $this->id_pemeriksaan_ralan->EditCustomAttributes = "";
            $this->id_pemeriksaan_ralan->EditValue = $this->id_pemeriksaan_ralan->CurrentValue;
            $this->id_pemeriksaan_ralan->ViewCustomAttributes = "";

            // Edit refer script

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";

            // tgl_perawatan
            $this->tgl_perawatan->LinkCustomAttributes = "";
            $this->tgl_perawatan->HrefValue = "";

            // jam_rawat
            $this->jam_rawat->LinkCustomAttributes = "";
            $this->jam_rawat->HrefValue = "";

            // suhu_tubuh
            $this->suhu_tubuh->LinkCustomAttributes = "";
            $this->suhu_tubuh->HrefValue = "";

            // tensi
            $this->tensi->LinkCustomAttributes = "";
            $this->tensi->HrefValue = "";

            // nadi
            $this->nadi->LinkCustomAttributes = "";
            $this->nadi->HrefValue = "";

            // respirasi
            $this->respirasi->LinkCustomAttributes = "";
            $this->respirasi->HrefValue = "";

            // tinggi
            $this->tinggi->LinkCustomAttributes = "";
            $this->tinggi->HrefValue = "";

            // berat
            $this->berat->LinkCustomAttributes = "";
            $this->berat->HrefValue = "";

            // spo2
            $this->spo2->LinkCustomAttributes = "";
            $this->spo2->HrefValue = "";

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";

            // kesadaran
            $this->kesadaran->LinkCustomAttributes = "";
            $this->kesadaran->HrefValue = "";

            // keluhan
            $this->keluhan->LinkCustomAttributes = "";
            $this->keluhan->HrefValue = "";

            // pemeriksaan
            $this->pemeriksaan->LinkCustomAttributes = "";
            $this->pemeriksaan->HrefValue = "";

            // alergi
            $this->alergi->LinkCustomAttributes = "";
            $this->alergi->HrefValue = "";

            // lingkar_perut
            $this->lingkar_perut->LinkCustomAttributes = "";
            $this->lingkar_perut->HrefValue = "";

            // rtl
            $this->rtl->LinkCustomAttributes = "";
            $this->rtl->HrefValue = "";

            // penilaian
            $this->penilaian->LinkCustomAttributes = "";
            $this->penilaian->HrefValue = "";

            // instruksi
            $this->instruksi->LinkCustomAttributes = "";
            $this->instruksi->HrefValue = "";

            // evaluasi
            $this->evaluasi->LinkCustomAttributes = "";
            $this->evaluasi->HrefValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";

            // id_pemeriksaan_ralan
            $this->id_pemeriksaan_ralan->LinkCustomAttributes = "";
            $this->id_pemeriksaan_ralan->HrefValue = "";
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
        if ($this->tgl_perawatan->Required) {
            if (!$this->tgl_perawatan->IsDetailKey && EmptyValue($this->tgl_perawatan->FormValue)) {
                $this->tgl_perawatan->addErrorMessage(str_replace("%s", $this->tgl_perawatan->caption(), $this->tgl_perawatan->RequiredErrorMessage));
            }
        }
        if ($this->jam_rawat->Required) {
            if (!$this->jam_rawat->IsDetailKey && EmptyValue($this->jam_rawat->FormValue)) {
                $this->jam_rawat->addErrorMessage(str_replace("%s", $this->jam_rawat->caption(), $this->jam_rawat->RequiredErrorMessage));
            }
        }
        if ($this->suhu_tubuh->Required) {
            if (!$this->suhu_tubuh->IsDetailKey && EmptyValue($this->suhu_tubuh->FormValue)) {
                $this->suhu_tubuh->addErrorMessage(str_replace("%s", $this->suhu_tubuh->caption(), $this->suhu_tubuh->RequiredErrorMessage));
            }
        }
        if ($this->tensi->Required) {
            if (!$this->tensi->IsDetailKey && EmptyValue($this->tensi->FormValue)) {
                $this->tensi->addErrorMessage(str_replace("%s", $this->tensi->caption(), $this->tensi->RequiredErrorMessage));
            }
        }
        if ($this->nadi->Required) {
            if (!$this->nadi->IsDetailKey && EmptyValue($this->nadi->FormValue)) {
                $this->nadi->addErrorMessage(str_replace("%s", $this->nadi->caption(), $this->nadi->RequiredErrorMessage));
            }
        }
        if ($this->respirasi->Required) {
            if (!$this->respirasi->IsDetailKey && EmptyValue($this->respirasi->FormValue)) {
                $this->respirasi->addErrorMessage(str_replace("%s", $this->respirasi->caption(), $this->respirasi->RequiredErrorMessage));
            }
        }
        if ($this->tinggi->Required) {
            if (!$this->tinggi->IsDetailKey && EmptyValue($this->tinggi->FormValue)) {
                $this->tinggi->addErrorMessage(str_replace("%s", $this->tinggi->caption(), $this->tinggi->RequiredErrorMessage));
            }
        }
        if ($this->berat->Required) {
            if (!$this->berat->IsDetailKey && EmptyValue($this->berat->FormValue)) {
                $this->berat->addErrorMessage(str_replace("%s", $this->berat->caption(), $this->berat->RequiredErrorMessage));
            }
        }
        if ($this->spo2->Required) {
            if (!$this->spo2->IsDetailKey && EmptyValue($this->spo2->FormValue)) {
                $this->spo2->addErrorMessage(str_replace("%s", $this->spo2->caption(), $this->spo2->RequiredErrorMessage));
            }
        }
        if ($this->gcs->Required) {
            if (!$this->gcs->IsDetailKey && EmptyValue($this->gcs->FormValue)) {
                $this->gcs->addErrorMessage(str_replace("%s", $this->gcs->caption(), $this->gcs->RequiredErrorMessage));
            }
        }
        if ($this->kesadaran->Required) {
            if ($this->kesadaran->FormValue == "") {
                $this->kesadaran->addErrorMessage(str_replace("%s", $this->kesadaran->caption(), $this->kesadaran->RequiredErrorMessage));
            }
        }
        if ($this->keluhan->Required) {
            if (!$this->keluhan->IsDetailKey && EmptyValue($this->keluhan->FormValue)) {
                $this->keluhan->addErrorMessage(str_replace("%s", $this->keluhan->caption(), $this->keluhan->RequiredErrorMessage));
            }
        }
        if ($this->pemeriksaan->Required) {
            if (!$this->pemeriksaan->IsDetailKey && EmptyValue($this->pemeriksaan->FormValue)) {
                $this->pemeriksaan->addErrorMessage(str_replace("%s", $this->pemeriksaan->caption(), $this->pemeriksaan->RequiredErrorMessage));
            }
        }
        if ($this->alergi->Required) {
            if (!$this->alergi->IsDetailKey && EmptyValue($this->alergi->FormValue)) {
                $this->alergi->addErrorMessage(str_replace("%s", $this->alergi->caption(), $this->alergi->RequiredErrorMessage));
            }
        }
        if ($this->lingkar_perut->Required) {
            if (!$this->lingkar_perut->IsDetailKey && EmptyValue($this->lingkar_perut->FormValue)) {
                $this->lingkar_perut->addErrorMessage(str_replace("%s", $this->lingkar_perut->caption(), $this->lingkar_perut->RequiredErrorMessage));
            }
        }
        if ($this->rtl->Required) {
            if (!$this->rtl->IsDetailKey && EmptyValue($this->rtl->FormValue)) {
                $this->rtl->addErrorMessage(str_replace("%s", $this->rtl->caption(), $this->rtl->RequiredErrorMessage));
            }
        }
        if ($this->penilaian->Required) {
            if (!$this->penilaian->IsDetailKey && EmptyValue($this->penilaian->FormValue)) {
                $this->penilaian->addErrorMessage(str_replace("%s", $this->penilaian->caption(), $this->penilaian->RequiredErrorMessage));
            }
        }
        if ($this->instruksi->Required) {
            if (!$this->instruksi->IsDetailKey && EmptyValue($this->instruksi->FormValue)) {
                $this->instruksi->addErrorMessage(str_replace("%s", $this->instruksi->caption(), $this->instruksi->RequiredErrorMessage));
            }
        }
        if ($this->evaluasi->Required) {
            if (!$this->evaluasi->IsDetailKey && EmptyValue($this->evaluasi->FormValue)) {
                $this->evaluasi->addErrorMessage(str_replace("%s", $this->evaluasi->caption(), $this->evaluasi->RequiredErrorMessage));
            }
        }
        if ($this->nip->Required) {
            if (!$this->nip->IsDetailKey && EmptyValue($this->nip->FormValue)) {
                $this->nip->addErrorMessage(str_replace("%s", $this->nip->caption(), $this->nip->RequiredErrorMessage));
            }
        }
        if ($this->id_pemeriksaan_ralan->Required) {
            if (!$this->id_pemeriksaan_ralan->IsDetailKey && EmptyValue($this->id_pemeriksaan_ralan->FormValue)) {
                $this->id_pemeriksaan_ralan->addErrorMessage(str_replace("%s", $this->id_pemeriksaan_ralan->caption(), $this->id_pemeriksaan_ralan->RequiredErrorMessage));
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

            // tgl_perawatan
            $this->tgl_perawatan->CurrentValue = CurrentDate();
            $this->tgl_perawatan->setDbValueDef($rsnew, $this->tgl_perawatan->CurrentValue, CurrentDate());

            // jam_rawat
            $this->jam_rawat->CurrentValue = CurrentTime();
            $this->jam_rawat->setDbValueDef($rsnew, $this->jam_rawat->CurrentValue, CurrentTime());

            // suhu_tubuh
            $this->suhu_tubuh->setDbValueDef($rsnew, $this->suhu_tubuh->CurrentValue, null, $this->suhu_tubuh->ReadOnly);

            // tensi
            $this->tensi->setDbValueDef($rsnew, $this->tensi->CurrentValue, "", $this->tensi->ReadOnly);

            // nadi
            $this->nadi->setDbValueDef($rsnew, $this->nadi->CurrentValue, null, $this->nadi->ReadOnly);

            // respirasi
            $this->respirasi->setDbValueDef($rsnew, $this->respirasi->CurrentValue, null, $this->respirasi->ReadOnly);

            // tinggi
            $this->tinggi->setDbValueDef($rsnew, $this->tinggi->CurrentValue, null, $this->tinggi->ReadOnly);

            // berat
            $this->berat->setDbValueDef($rsnew, $this->berat->CurrentValue, null, $this->berat->ReadOnly);

            // spo2
            $this->spo2->setDbValueDef($rsnew, $this->spo2->CurrentValue, "", $this->spo2->ReadOnly);

            // gcs
            $this->gcs->setDbValueDef($rsnew, $this->gcs->CurrentValue, null, $this->gcs->ReadOnly);

            // kesadaran
            $this->kesadaran->setDbValueDef($rsnew, $this->kesadaran->CurrentValue, "", $this->kesadaran->ReadOnly);

            // keluhan
            $this->keluhan->setDbValueDef($rsnew, $this->keluhan->CurrentValue, null, $this->keluhan->ReadOnly);

            // pemeriksaan
            $this->pemeriksaan->setDbValueDef($rsnew, $this->pemeriksaan->CurrentValue, null, $this->pemeriksaan->ReadOnly);

            // alergi
            $this->alergi->setDbValueDef($rsnew, $this->alergi->CurrentValue, null, $this->alergi->ReadOnly);

            // lingkar_perut
            $this->lingkar_perut->setDbValueDef($rsnew, $this->lingkar_perut->CurrentValue, null, $this->lingkar_perut->ReadOnly);

            // rtl
            $this->rtl->setDbValueDef($rsnew, $this->rtl->CurrentValue, "", $this->rtl->ReadOnly);

            // penilaian
            $this->penilaian->setDbValueDef($rsnew, $this->penilaian->CurrentValue, "", $this->penilaian->ReadOnly);

            // instruksi
            $this->instruksi->setDbValueDef($rsnew, $this->instruksi->CurrentValue, "", $this->instruksi->ReadOnly);

            // evaluasi
            $this->evaluasi->setDbValueDef($rsnew, $this->evaluasi->CurrentValue, "", $this->evaluasi->ReadOnly);

            // nip
            $this->nip->setDbValueDef($rsnew, $this->nip->CurrentValue, "", $this->nip->ReadOnly);

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
            $this->setSessionWhere($this->getDetailFilter());

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PemeriksaanRalanList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
                case "x_kesadaran":
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
}
