<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienKunjunganAdd extends PasienKunjungan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pasien_kunjungan';

    // Page object name
    public $PageObjName = "PasienKunjunganAdd";

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

        // Table object (pasien_kunjungan)
        if (!isset($GLOBALS["pasien_kunjungan"]) || get_class($GLOBALS["pasien_kunjungan"]) == PROJECT_NAMESPACE . "pasien_kunjungan") {
            $GLOBALS["pasien_kunjungan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pasien_kunjungan');
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
                $doc = new $class(Container("pasien_kunjungan"));
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
                    if ($pageName == "PasienKunjunganView") {
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
        $this->id_reg->Visible = false;
        $this->no_rkm_medis->setVisibility();
        $this->no_reg->setVisibility();
        $this->no_rawat->setVisibility();
        $this->tgl_registrasi->setVisibility();
        $this->jam_reg->setVisibility();
        $this->kd_dokter->setVisibility();
        $this->kd_poli->setVisibility();
        $this->p_jawab->setVisibility();
        $this->almt_pj->setVisibility();
        $this->hubunganpj->setVisibility();
        $this->biaya_reg->setVisibility();
        $this->stts->setVisibility();
        $this->stts_daftar->setVisibility();
        $this->status_lanjut->setVisibility();
        $this->kd_pj->setVisibility();
        $this->umurdaftar->setVisibility();
        $this->sttsumur->setVisibility();
        $this->status_bayar->setVisibility();
        $this->status_poli->setVisibility();
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
        $this->setupLookupOptions($this->no_rkm_medis);

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
            if (($keyValue = Get("id_reg") ?? Route("id_reg")) !== null) {
                $this->id_reg->setQueryStringValue($keyValue);
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
                    $this->terminate("PasienKunjunganList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PasienKunjunganList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PasienKunjunganView") {
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
        $this->id_reg->CurrentValue = null;
        $this->id_reg->OldValue = $this->id_reg->CurrentValue;
        $this->no_rkm_medis->CurrentValue = null;
        $this->no_rkm_medis->OldValue = $this->no_rkm_medis->CurrentValue;
        $this->no_reg->CurrentValue = GetNextNomr();
        $this->no_rawat->CurrentValue = null;
        $this->no_rawat->OldValue = $this->no_rawat->CurrentValue;
        $this->tgl_registrasi->CurrentValue = null;
        $this->tgl_registrasi->OldValue = $this->tgl_registrasi->CurrentValue;
        $this->jam_reg->CurrentValue = null;
        $this->jam_reg->OldValue = $this->jam_reg->CurrentValue;
        $this->kd_dokter->CurrentValue = null;
        $this->kd_dokter->OldValue = $this->kd_dokter->CurrentValue;
        $this->kd_poli->CurrentValue = null;
        $this->kd_poli->OldValue = $this->kd_poli->CurrentValue;
        $this->p_jawab->CurrentValue = null;
        $this->p_jawab->OldValue = $this->p_jawab->CurrentValue;
        $this->almt_pj->CurrentValue = null;
        $this->almt_pj->OldValue = $this->almt_pj->CurrentValue;
        $this->hubunganpj->CurrentValue = null;
        $this->hubunganpj->OldValue = $this->hubunganpj->CurrentValue;
        $this->biaya_reg->CurrentValue = null;
        $this->biaya_reg->OldValue = $this->biaya_reg->CurrentValue;
        $this->stts->CurrentValue = null;
        $this->stts->OldValue = $this->stts->CurrentValue;
        $this->stts_daftar->CurrentValue = null;
        $this->stts_daftar->OldValue = $this->stts_daftar->CurrentValue;
        $this->status_lanjut->CurrentValue = null;
        $this->status_lanjut->OldValue = $this->status_lanjut->CurrentValue;
        $this->kd_pj->CurrentValue = null;
        $this->kd_pj->OldValue = $this->kd_pj->CurrentValue;
        $this->umurdaftar->CurrentValue = null;
        $this->umurdaftar->OldValue = $this->umurdaftar->CurrentValue;
        $this->sttsumur->CurrentValue = null;
        $this->sttsumur->OldValue = $this->sttsumur->CurrentValue;
        $this->status_bayar->CurrentValue = null;
        $this->status_bayar->OldValue = $this->status_bayar->CurrentValue;
        $this->status_poli->CurrentValue = null;
        $this->status_poli->OldValue = $this->status_poli->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'no_rkm_medis' first before field var 'x_no_rkm_medis'
        $val = $CurrentForm->hasValue("no_rkm_medis") ? $CurrentForm->getValue("no_rkm_medis") : $CurrentForm->getValue("x_no_rkm_medis");
        if (!$this->no_rkm_medis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rkm_medis->Visible = false; // Disable update for API request
            } else {
                $this->no_rkm_medis->setFormValue($val);
            }
        }

        // Check field name 'no_reg' first before field var 'x_no_reg'
        $val = $CurrentForm->hasValue("no_reg") ? $CurrentForm->getValue("no_reg") : $CurrentForm->getValue("x_no_reg");
        if (!$this->no_reg->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_reg->Visible = false; // Disable update for API request
            } else {
                $this->no_reg->setFormValue($val);
            }
        }

        // Check field name 'no_rawat' first before field var 'x_no_rawat'
        $val = $CurrentForm->hasValue("no_rawat") ? $CurrentForm->getValue("no_rawat") : $CurrentForm->getValue("x_no_rawat");
        if (!$this->no_rawat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rawat->Visible = false; // Disable update for API request
            } else {
                $this->no_rawat->setFormValue($val);
            }
        }

        // Check field name 'tgl_registrasi' first before field var 'x_tgl_registrasi'
        $val = $CurrentForm->hasValue("tgl_registrasi") ? $CurrentForm->getValue("tgl_registrasi") : $CurrentForm->getValue("x_tgl_registrasi");
        if (!$this->tgl_registrasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_registrasi->Visible = false; // Disable update for API request
            } else {
                $this->tgl_registrasi->setFormValue($val);
            }
            $this->tgl_registrasi->CurrentValue = UnFormatDateTime($this->tgl_registrasi->CurrentValue, 7);
        }

        // Check field name 'jam_reg' first before field var 'x_jam_reg'
        $val = $CurrentForm->hasValue("jam_reg") ? $CurrentForm->getValue("jam_reg") : $CurrentForm->getValue("x_jam_reg");
        if (!$this->jam_reg->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jam_reg->Visible = false; // Disable update for API request
            } else {
                $this->jam_reg->setFormValue($val);
            }
            $this->jam_reg->CurrentValue = UnFormatDateTime($this->jam_reg->CurrentValue, 4);
        }

        // Check field name 'kd_dokter' first before field var 'x_kd_dokter'
        $val = $CurrentForm->hasValue("kd_dokter") ? $CurrentForm->getValue("kd_dokter") : $CurrentForm->getValue("x_kd_dokter");
        if (!$this->kd_dokter->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_dokter->Visible = false; // Disable update for API request
            } else {
                $this->kd_dokter->setFormValue($val);
            }
        }

        // Check field name 'kd_poli' first before field var 'x_kd_poli'
        $val = $CurrentForm->hasValue("kd_poli") ? $CurrentForm->getValue("kd_poli") : $CurrentForm->getValue("x_kd_poli");
        if (!$this->kd_poli->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_poli->Visible = false; // Disable update for API request
            } else {
                $this->kd_poli->setFormValue($val);
            }
        }

        // Check field name 'p_jawab' first before field var 'x_p_jawab'
        $val = $CurrentForm->hasValue("p_jawab") ? $CurrentForm->getValue("p_jawab") : $CurrentForm->getValue("x_p_jawab");
        if (!$this->p_jawab->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->p_jawab->Visible = false; // Disable update for API request
            } else {
                $this->p_jawab->setFormValue($val);
            }
        }

        // Check field name 'almt_pj' first before field var 'x_almt_pj'
        $val = $CurrentForm->hasValue("almt_pj") ? $CurrentForm->getValue("almt_pj") : $CurrentForm->getValue("x_almt_pj");
        if (!$this->almt_pj->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->almt_pj->Visible = false; // Disable update for API request
            } else {
                $this->almt_pj->setFormValue($val);
            }
        }

        // Check field name 'hubunganpj' first before field var 'x_hubunganpj'
        $val = $CurrentForm->hasValue("hubunganpj") ? $CurrentForm->getValue("hubunganpj") : $CurrentForm->getValue("x_hubunganpj");
        if (!$this->hubunganpj->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hubunganpj->Visible = false; // Disable update for API request
            } else {
                $this->hubunganpj->setFormValue($val);
            }
        }

        // Check field name 'biaya_reg' first before field var 'x_biaya_reg'
        $val = $CurrentForm->hasValue("biaya_reg") ? $CurrentForm->getValue("biaya_reg") : $CurrentForm->getValue("x_biaya_reg");
        if (!$this->biaya_reg->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->biaya_reg->Visible = false; // Disable update for API request
            } else {
                $this->biaya_reg->setFormValue($val);
            }
        }

        // Check field name 'stts' first before field var 'x_stts'
        $val = $CurrentForm->hasValue("stts") ? $CurrentForm->getValue("stts") : $CurrentForm->getValue("x_stts");
        if (!$this->stts->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stts->Visible = false; // Disable update for API request
            } else {
                $this->stts->setFormValue($val);
            }
        }

        // Check field name 'stts_daftar' first before field var 'x_stts_daftar'
        $val = $CurrentForm->hasValue("stts_daftar") ? $CurrentForm->getValue("stts_daftar") : $CurrentForm->getValue("x_stts_daftar");
        if (!$this->stts_daftar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stts_daftar->Visible = false; // Disable update for API request
            } else {
                $this->stts_daftar->setFormValue($val);
            }
        }

        // Check field name 'status_lanjut' first before field var 'x_status_lanjut'
        $val = $CurrentForm->hasValue("status_lanjut") ? $CurrentForm->getValue("status_lanjut") : $CurrentForm->getValue("x_status_lanjut");
        if (!$this->status_lanjut->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_lanjut->Visible = false; // Disable update for API request
            } else {
                $this->status_lanjut->setFormValue($val);
            }
        }

        // Check field name 'kd_pj' first before field var 'x_kd_pj'
        $val = $CurrentForm->hasValue("kd_pj") ? $CurrentForm->getValue("kd_pj") : $CurrentForm->getValue("x_kd_pj");
        if (!$this->kd_pj->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_pj->Visible = false; // Disable update for API request
            } else {
                $this->kd_pj->setFormValue($val);
            }
        }

        // Check field name 'umurdaftar' first before field var 'x_umurdaftar'
        $val = $CurrentForm->hasValue("umurdaftar") ? $CurrentForm->getValue("umurdaftar") : $CurrentForm->getValue("x_umurdaftar");
        if (!$this->umurdaftar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->umurdaftar->Visible = false; // Disable update for API request
            } else {
                $this->umurdaftar->setFormValue($val);
            }
        }

        // Check field name 'sttsumur' first before field var 'x_sttsumur'
        $val = $CurrentForm->hasValue("sttsumur") ? $CurrentForm->getValue("sttsumur") : $CurrentForm->getValue("x_sttsumur");
        if (!$this->sttsumur->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sttsumur->Visible = false; // Disable update for API request
            } else {
                $this->sttsumur->setFormValue($val);
            }
        }

        // Check field name 'status_bayar' first before field var 'x_status_bayar'
        $val = $CurrentForm->hasValue("status_bayar") ? $CurrentForm->getValue("status_bayar") : $CurrentForm->getValue("x_status_bayar");
        if (!$this->status_bayar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_bayar->Visible = false; // Disable update for API request
            } else {
                $this->status_bayar->setFormValue($val);
            }
        }

        // Check field name 'status_poli' first before field var 'x_status_poli'
        $val = $CurrentForm->hasValue("status_poli") ? $CurrentForm->getValue("status_poli") : $CurrentForm->getValue("x_status_poli");
        if (!$this->status_poli->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_poli->Visible = false; // Disable update for API request
            } else {
                $this->status_poli->setFormValue($val);
            }
        }

        // Check field name 'id_reg' first before field var 'x_id_reg'
        $val = $CurrentForm->hasValue("id_reg") ? $CurrentForm->getValue("id_reg") : $CurrentForm->getValue("x_id_reg");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->no_rkm_medis->CurrentValue = $this->no_rkm_medis->FormValue;
        $this->no_reg->CurrentValue = $this->no_reg->FormValue;
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->tgl_registrasi->CurrentValue = $this->tgl_registrasi->FormValue;
        $this->tgl_registrasi->CurrentValue = UnFormatDateTime($this->tgl_registrasi->CurrentValue, 7);
        $this->jam_reg->CurrentValue = $this->jam_reg->FormValue;
        $this->jam_reg->CurrentValue = UnFormatDateTime($this->jam_reg->CurrentValue, 4);
        $this->kd_dokter->CurrentValue = $this->kd_dokter->FormValue;
        $this->kd_poli->CurrentValue = $this->kd_poli->FormValue;
        $this->p_jawab->CurrentValue = $this->p_jawab->FormValue;
        $this->almt_pj->CurrentValue = $this->almt_pj->FormValue;
        $this->hubunganpj->CurrentValue = $this->hubunganpj->FormValue;
        $this->biaya_reg->CurrentValue = $this->biaya_reg->FormValue;
        $this->stts->CurrentValue = $this->stts->FormValue;
        $this->stts_daftar->CurrentValue = $this->stts_daftar->FormValue;
        $this->status_lanjut->CurrentValue = $this->status_lanjut->FormValue;
        $this->kd_pj->CurrentValue = $this->kd_pj->FormValue;
        $this->umurdaftar->CurrentValue = $this->umurdaftar->FormValue;
        $this->sttsumur->CurrentValue = $this->sttsumur->FormValue;
        $this->status_bayar->CurrentValue = $this->status_bayar->FormValue;
        $this->status_poli->CurrentValue = $this->status_poli->FormValue;
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
        $this->no_rkm_medis->setDbValue($row['no_rkm_medis']);
        $this->no_reg->setDbValue($row['no_reg']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tgl_registrasi->setDbValue($row['tgl_registrasi']);
        $this->jam_reg->setDbValue($row['jam_reg']);
        $this->kd_dokter->setDbValue($row['kd_dokter']);
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
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_reg'] = $this->id_reg->CurrentValue;
        $row['no_rkm_medis'] = $this->no_rkm_medis->CurrentValue;
        $row['no_reg'] = $this->no_reg->CurrentValue;
        $row['no_rawat'] = $this->no_rawat->CurrentValue;
        $row['tgl_registrasi'] = $this->tgl_registrasi->CurrentValue;
        $row['jam_reg'] = $this->jam_reg->CurrentValue;
        $row['kd_dokter'] = $this->kd_dokter->CurrentValue;
        $row['kd_poli'] = $this->kd_poli->CurrentValue;
        $row['p_jawab'] = $this->p_jawab->CurrentValue;
        $row['almt_pj'] = $this->almt_pj->CurrentValue;
        $row['hubunganpj'] = $this->hubunganpj->CurrentValue;
        $row['biaya_reg'] = $this->biaya_reg->CurrentValue;
        $row['stts'] = $this->stts->CurrentValue;
        $row['stts_daftar'] = $this->stts_daftar->CurrentValue;
        $row['status_lanjut'] = $this->status_lanjut->CurrentValue;
        $row['kd_pj'] = $this->kd_pj->CurrentValue;
        $row['umurdaftar'] = $this->umurdaftar->CurrentValue;
        $row['sttsumur'] = $this->sttsumur->CurrentValue;
        $row['status_bayar'] = $this->status_bayar->CurrentValue;
        $row['status_poli'] = $this->status_poli->CurrentValue;
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
        if ($this->biaya_reg->FormValue == $this->biaya_reg->CurrentValue && is_numeric(ConvertToFloatString($this->biaya_reg->CurrentValue))) {
            $this->biaya_reg->CurrentValue = ConvertToFloatString($this->biaya_reg->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id_reg

        // no_rkm_medis

        // no_reg

        // no_rawat

        // tgl_registrasi

        // jam_reg

        // kd_dokter

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
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_reg
            $this->id_reg->ViewValue = $this->id_reg->CurrentValue;
            $this->id_reg->ViewCustomAttributes = "";

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
            $this->kd_dokter->ViewCustomAttributes = "";

            // kd_poli
            $this->kd_poli->ViewValue = $this->kd_poli->CurrentValue;
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
            $this->kd_pj->ViewValue = $this->kd_pj->CurrentValue;
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

            // no_rkm_medis
            $this->no_rkm_medis->LinkCustomAttributes = "";
            $this->no_rkm_medis->HrefValue = "";
            $this->no_rkm_medis->TooltipValue = "";

            // no_reg
            $this->no_reg->LinkCustomAttributes = "";
            $this->no_reg->HrefValue = "";
            $this->no_reg->TooltipValue = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";
            $this->no_rawat->TooltipValue = "";

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

            // kd_poli
            $this->kd_poli->LinkCustomAttributes = "";
            $this->kd_poli->HrefValue = "";
            $this->kd_poli->TooltipValue = "";

            // p_jawab
            $this->p_jawab->LinkCustomAttributes = "";
            $this->p_jawab->HrefValue = "";
            $this->p_jawab->TooltipValue = "";

            // almt_pj
            $this->almt_pj->LinkCustomAttributes = "";
            $this->almt_pj->HrefValue = "";
            $this->almt_pj->TooltipValue = "";

            // hubunganpj
            $this->hubunganpj->LinkCustomAttributes = "";
            $this->hubunganpj->HrefValue = "";
            $this->hubunganpj->TooltipValue = "";

            // biaya_reg
            $this->biaya_reg->LinkCustomAttributes = "";
            $this->biaya_reg->HrefValue = "";
            $this->biaya_reg->TooltipValue = "";

            // stts
            $this->stts->LinkCustomAttributes = "";
            $this->stts->HrefValue = "";
            $this->stts->TooltipValue = "";

            // stts_daftar
            $this->stts_daftar->LinkCustomAttributes = "";
            $this->stts_daftar->HrefValue = "";
            $this->stts_daftar->TooltipValue = "";

            // status_lanjut
            $this->status_lanjut->LinkCustomAttributes = "";
            $this->status_lanjut->HrefValue = "";
            $this->status_lanjut->TooltipValue = "";

            // kd_pj
            $this->kd_pj->LinkCustomAttributes = "";
            $this->kd_pj->HrefValue = "";
            $this->kd_pj->TooltipValue = "";

            // umurdaftar
            $this->umurdaftar->LinkCustomAttributes = "";
            $this->umurdaftar->HrefValue = "";
            $this->umurdaftar->TooltipValue = "";

            // sttsumur
            $this->sttsumur->LinkCustomAttributes = "";
            $this->sttsumur->HrefValue = "";
            $this->sttsumur->TooltipValue = "";

            // status_bayar
            $this->status_bayar->LinkCustomAttributes = "";
            $this->status_bayar->HrefValue = "";
            $this->status_bayar->TooltipValue = "";

            // status_poli
            $this->status_poli->LinkCustomAttributes = "";
            $this->status_poli->HrefValue = "";
            $this->status_poli->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // no_rkm_medis
            $this->no_rkm_medis->EditCustomAttributes = "";
            if ($this->no_rkm_medis->getSessionValue() != "") {
                $this->no_rkm_medis->CurrentValue = GetForeignKeyValue($this->no_rkm_medis->getSessionValue());
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
            } else {
                $curVal = trim(strval($this->no_rkm_medis->CurrentValue));
                if ($curVal != "") {
                    $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->lookupCacheOption($curVal);
                } else {
                    $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->Lookup !== null && is_array($this->no_rkm_medis->Lookup->Options) ? $curVal : null;
                }
                if ($this->no_rkm_medis->ViewValue !== null) { // Load from cache
                    $this->no_rkm_medis->EditValue = array_values($this->no_rkm_medis->Lookup->Options);
                    if ($this->no_rkm_medis->ViewValue == "") {
                        $this->no_rkm_medis->ViewValue = $Language->phrase("PleaseSelect");
                    }
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = "`no_rkm_medis`" . SearchString("=", $this->no_rkm_medis->CurrentValue, DATATYPE_STRING, "");
                    }
                    $sqlWrk = $this->no_rkm_medis->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->no_rkm_medis->Lookup->renderViewRow($rswrk[0]);
                        $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->displayValue($arwrk);
                    } else {
                        $this->no_rkm_medis->ViewValue = $Language->phrase("PleaseSelect");
                    }
                    $arwrk = $rswrk;
                    $this->no_rkm_medis->EditValue = $arwrk;
                }
                $this->no_rkm_medis->PlaceHolder = RemoveHtml($this->no_rkm_medis->caption());
            }

            // no_reg
            $this->no_reg->EditAttrs["class"] = "form-control";
            $this->no_reg->EditCustomAttributes = "";
            if (!$this->no_reg->Raw) {
                $this->no_reg->CurrentValue = HtmlDecode($this->no_reg->CurrentValue);
            }
            $this->no_reg->EditValue = HtmlEncode($this->no_reg->CurrentValue);
            $this->no_reg->PlaceHolder = RemoveHtml($this->no_reg->caption());

            // no_rawat
            $this->no_rawat->EditAttrs["class"] = "form-control";
            $this->no_rawat->EditCustomAttributes = "";
            if (!$this->no_rawat->Raw) {
                $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
            }
            $this->no_rawat->EditValue = HtmlEncode($this->no_rawat->CurrentValue);
            $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());

            // tgl_registrasi

            // jam_reg

            // kd_dokter
            $this->kd_dokter->EditAttrs["class"] = "form-control";
            $this->kd_dokter->EditCustomAttributes = "";
            $this->kd_dokter->PlaceHolder = RemoveHtml($this->kd_dokter->caption());

            // kd_poli
            $this->kd_poli->EditAttrs["class"] = "form-control";
            $this->kd_poli->EditCustomAttributes = "";
            if (!$this->kd_poli->Raw) {
                $this->kd_poli->CurrentValue = HtmlDecode($this->kd_poli->CurrentValue);
            }
            $this->kd_poli->EditValue = HtmlEncode($this->kd_poli->CurrentValue);
            $this->kd_poli->PlaceHolder = RemoveHtml($this->kd_poli->caption());

            // p_jawab
            $this->p_jawab->EditAttrs["class"] = "form-control";
            $this->p_jawab->EditCustomAttributes = "";
            if (!$this->p_jawab->Raw) {
                $this->p_jawab->CurrentValue = HtmlDecode($this->p_jawab->CurrentValue);
            }
            $this->p_jawab->EditValue = HtmlEncode($this->p_jawab->CurrentValue);
            $this->p_jawab->PlaceHolder = RemoveHtml($this->p_jawab->caption());

            // almt_pj
            $this->almt_pj->EditAttrs["class"] = "form-control";
            $this->almt_pj->EditCustomAttributes = "";
            if (!$this->almt_pj->Raw) {
                $this->almt_pj->CurrentValue = HtmlDecode($this->almt_pj->CurrentValue);
            }
            $this->almt_pj->EditValue = HtmlEncode($this->almt_pj->CurrentValue);
            $this->almt_pj->PlaceHolder = RemoveHtml($this->almt_pj->caption());

            // hubunganpj
            $this->hubunganpj->EditAttrs["class"] = "form-control";
            $this->hubunganpj->EditCustomAttributes = "";
            if (!$this->hubunganpj->Raw) {
                $this->hubunganpj->CurrentValue = HtmlDecode($this->hubunganpj->CurrentValue);
            }
            $this->hubunganpj->EditValue = HtmlEncode($this->hubunganpj->CurrentValue);
            $this->hubunganpj->PlaceHolder = RemoveHtml($this->hubunganpj->caption());

            // biaya_reg
            $this->biaya_reg->EditAttrs["class"] = "form-control";
            $this->biaya_reg->EditCustomAttributes = "";
            $this->biaya_reg->EditValue = HtmlEncode($this->biaya_reg->CurrentValue);
            $this->biaya_reg->PlaceHolder = RemoveHtml($this->biaya_reg->caption());
            if (strval($this->biaya_reg->EditValue) != "" && is_numeric($this->biaya_reg->EditValue)) {
                $this->biaya_reg->EditValue = FormatNumber($this->biaya_reg->EditValue, -2, -2, -2, -2);
            }

            // stts
            $this->stts->EditCustomAttributes = "";
            $this->stts->EditValue = $this->stts->options(false);
            $this->stts->PlaceHolder = RemoveHtml($this->stts->caption());

            // stts_daftar
            $this->stts_daftar->EditCustomAttributes = "";
            $this->stts_daftar->EditValue = $this->stts_daftar->options(false);
            $this->stts_daftar->PlaceHolder = RemoveHtml($this->stts_daftar->caption());

            // status_lanjut
            $this->status_lanjut->EditCustomAttributes = "";
            $this->status_lanjut->EditValue = $this->status_lanjut->options(false);
            $this->status_lanjut->PlaceHolder = RemoveHtml($this->status_lanjut->caption());

            // kd_pj
            $this->kd_pj->EditAttrs["class"] = "form-control";
            $this->kd_pj->EditCustomAttributes = "";
            if (!$this->kd_pj->Raw) {
                $this->kd_pj->CurrentValue = HtmlDecode($this->kd_pj->CurrentValue);
            }
            $this->kd_pj->EditValue = HtmlEncode($this->kd_pj->CurrentValue);
            $this->kd_pj->PlaceHolder = RemoveHtml($this->kd_pj->caption());

            // umurdaftar
            $this->umurdaftar->EditAttrs["class"] = "form-control";
            $this->umurdaftar->EditCustomAttributes = "";
            $this->umurdaftar->EditValue = HtmlEncode($this->umurdaftar->CurrentValue);
            $this->umurdaftar->PlaceHolder = RemoveHtml($this->umurdaftar->caption());

            // sttsumur
            $this->sttsumur->EditCustomAttributes = "";
            $this->sttsumur->EditValue = $this->sttsumur->options(false);
            $this->sttsumur->PlaceHolder = RemoveHtml($this->sttsumur->caption());

            // status_bayar
            $this->status_bayar->EditCustomAttributes = "";
            $this->status_bayar->EditValue = $this->status_bayar->options(false);
            $this->status_bayar->PlaceHolder = RemoveHtml($this->status_bayar->caption());

            // status_poli
            $this->status_poli->EditCustomAttributes = "";
            $this->status_poli->EditValue = $this->status_poli->options(false);
            $this->status_poli->PlaceHolder = RemoveHtml($this->status_poli->caption());

            // Add refer script

            // no_rkm_medis
            $this->no_rkm_medis->LinkCustomAttributes = "";
            $this->no_rkm_medis->HrefValue = "";

            // no_reg
            $this->no_reg->LinkCustomAttributes = "";
            $this->no_reg->HrefValue = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";

            // tgl_registrasi
            $this->tgl_registrasi->LinkCustomAttributes = "";
            $this->tgl_registrasi->HrefValue = "";

            // jam_reg
            $this->jam_reg->LinkCustomAttributes = "";
            $this->jam_reg->HrefValue = "";

            // kd_dokter
            $this->kd_dokter->LinkCustomAttributes = "";
            $this->kd_dokter->HrefValue = "";

            // kd_poli
            $this->kd_poli->LinkCustomAttributes = "";
            $this->kd_poli->HrefValue = "";

            // p_jawab
            $this->p_jawab->LinkCustomAttributes = "";
            $this->p_jawab->HrefValue = "";

            // almt_pj
            $this->almt_pj->LinkCustomAttributes = "";
            $this->almt_pj->HrefValue = "";

            // hubunganpj
            $this->hubunganpj->LinkCustomAttributes = "";
            $this->hubunganpj->HrefValue = "";

            // biaya_reg
            $this->biaya_reg->LinkCustomAttributes = "";
            $this->biaya_reg->HrefValue = "";

            // stts
            $this->stts->LinkCustomAttributes = "";
            $this->stts->HrefValue = "";

            // stts_daftar
            $this->stts_daftar->LinkCustomAttributes = "";
            $this->stts_daftar->HrefValue = "";

            // status_lanjut
            $this->status_lanjut->LinkCustomAttributes = "";
            $this->status_lanjut->HrefValue = "";

            // kd_pj
            $this->kd_pj->LinkCustomAttributes = "";
            $this->kd_pj->HrefValue = "";

            // umurdaftar
            $this->umurdaftar->LinkCustomAttributes = "";
            $this->umurdaftar->HrefValue = "";

            // sttsumur
            $this->sttsumur->LinkCustomAttributes = "";
            $this->sttsumur->HrefValue = "";

            // status_bayar
            $this->status_bayar->LinkCustomAttributes = "";
            $this->status_bayar->HrefValue = "";

            // status_poli
            $this->status_poli->LinkCustomAttributes = "";
            $this->status_poli->HrefValue = "";
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
        if ($this->no_rkm_medis->Required) {
            if (!$this->no_rkm_medis->IsDetailKey && EmptyValue($this->no_rkm_medis->FormValue)) {
                $this->no_rkm_medis->addErrorMessage(str_replace("%s", $this->no_rkm_medis->caption(), $this->no_rkm_medis->RequiredErrorMessage));
            }
        }
        if ($this->no_reg->Required) {
            if (!$this->no_reg->IsDetailKey && EmptyValue($this->no_reg->FormValue)) {
                $this->no_reg->addErrorMessage(str_replace("%s", $this->no_reg->caption(), $this->no_reg->RequiredErrorMessage));
            }
        }
        if ($this->no_rawat->Required) {
            if (!$this->no_rawat->IsDetailKey && EmptyValue($this->no_rawat->FormValue)) {
                $this->no_rawat->addErrorMessage(str_replace("%s", $this->no_rawat->caption(), $this->no_rawat->RequiredErrorMessage));
            }
        }
        if ($this->tgl_registrasi->Required) {
            if (!$this->tgl_registrasi->IsDetailKey && EmptyValue($this->tgl_registrasi->FormValue)) {
                $this->tgl_registrasi->addErrorMessage(str_replace("%s", $this->tgl_registrasi->caption(), $this->tgl_registrasi->RequiredErrorMessage));
            }
        }
        if ($this->jam_reg->Required) {
            if (!$this->jam_reg->IsDetailKey && EmptyValue($this->jam_reg->FormValue)) {
                $this->jam_reg->addErrorMessage(str_replace("%s", $this->jam_reg->caption(), $this->jam_reg->RequiredErrorMessage));
            }
        }
        if ($this->kd_dokter->Required) {
            if (!$this->kd_dokter->IsDetailKey && EmptyValue($this->kd_dokter->FormValue)) {
                $this->kd_dokter->addErrorMessage(str_replace("%s", $this->kd_dokter->caption(), $this->kd_dokter->RequiredErrorMessage));
            }
        }
        if ($this->kd_poli->Required) {
            if (!$this->kd_poli->IsDetailKey && EmptyValue($this->kd_poli->FormValue)) {
                $this->kd_poli->addErrorMessage(str_replace("%s", $this->kd_poli->caption(), $this->kd_poli->RequiredErrorMessage));
            }
        }
        if ($this->p_jawab->Required) {
            if (!$this->p_jawab->IsDetailKey && EmptyValue($this->p_jawab->FormValue)) {
                $this->p_jawab->addErrorMessage(str_replace("%s", $this->p_jawab->caption(), $this->p_jawab->RequiredErrorMessage));
            }
        }
        if ($this->almt_pj->Required) {
            if (!$this->almt_pj->IsDetailKey && EmptyValue($this->almt_pj->FormValue)) {
                $this->almt_pj->addErrorMessage(str_replace("%s", $this->almt_pj->caption(), $this->almt_pj->RequiredErrorMessage));
            }
        }
        if ($this->hubunganpj->Required) {
            if (!$this->hubunganpj->IsDetailKey && EmptyValue($this->hubunganpj->FormValue)) {
                $this->hubunganpj->addErrorMessage(str_replace("%s", $this->hubunganpj->caption(), $this->hubunganpj->RequiredErrorMessage));
            }
        }
        if ($this->biaya_reg->Required) {
            if (!$this->biaya_reg->IsDetailKey && EmptyValue($this->biaya_reg->FormValue)) {
                $this->biaya_reg->addErrorMessage(str_replace("%s", $this->biaya_reg->caption(), $this->biaya_reg->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->biaya_reg->FormValue)) {
            $this->biaya_reg->addErrorMessage($this->biaya_reg->getErrorMessage(false));
        }
        if ($this->stts->Required) {
            if ($this->stts->FormValue == "") {
                $this->stts->addErrorMessage(str_replace("%s", $this->stts->caption(), $this->stts->RequiredErrorMessage));
            }
        }
        if ($this->stts_daftar->Required) {
            if ($this->stts_daftar->FormValue == "") {
                $this->stts_daftar->addErrorMessage(str_replace("%s", $this->stts_daftar->caption(), $this->stts_daftar->RequiredErrorMessage));
            }
        }
        if ($this->status_lanjut->Required) {
            if ($this->status_lanjut->FormValue == "") {
                $this->status_lanjut->addErrorMessage(str_replace("%s", $this->status_lanjut->caption(), $this->status_lanjut->RequiredErrorMessage));
            }
        }
        if ($this->kd_pj->Required) {
            if (!$this->kd_pj->IsDetailKey && EmptyValue($this->kd_pj->FormValue)) {
                $this->kd_pj->addErrorMessage(str_replace("%s", $this->kd_pj->caption(), $this->kd_pj->RequiredErrorMessage));
            }
        }
        if ($this->umurdaftar->Required) {
            if (!$this->umurdaftar->IsDetailKey && EmptyValue($this->umurdaftar->FormValue)) {
                $this->umurdaftar->addErrorMessage(str_replace("%s", $this->umurdaftar->caption(), $this->umurdaftar->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->umurdaftar->FormValue)) {
            $this->umurdaftar->addErrorMessage($this->umurdaftar->getErrorMessage(false));
        }
        if ($this->sttsumur->Required) {
            if ($this->sttsumur->FormValue == "") {
                $this->sttsumur->addErrorMessage(str_replace("%s", $this->sttsumur->caption(), $this->sttsumur->RequiredErrorMessage));
            }
        }
        if ($this->status_bayar->Required) {
            if ($this->status_bayar->FormValue == "") {
                $this->status_bayar->addErrorMessage(str_replace("%s", $this->status_bayar->caption(), $this->status_bayar->RequiredErrorMessage));
            }
        }
        if ($this->status_poli->Required) {
            if ($this->status_poli->FormValue == "") {
                $this->status_poli->addErrorMessage(str_replace("%s", $this->status_poli->caption(), $this->status_poli->RequiredErrorMessage));
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
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // no_rkm_medis
        $this->no_rkm_medis->setDbValueDef($rsnew, $this->no_rkm_medis->CurrentValue, null, false);

        // no_reg
        $this->no_reg->setDbValueDef($rsnew, $this->no_reg->CurrentValue, null, strval($this->no_reg->CurrentValue) == "");

        // no_rawat
        $this->no_rawat->setDbValueDef($rsnew, $this->no_rawat->CurrentValue, "", strval($this->no_rawat->CurrentValue) == "");

        // tgl_registrasi
        $this->tgl_registrasi->CurrentValue = CurrentDate();
        $this->tgl_registrasi->setDbValueDef($rsnew, $this->tgl_registrasi->CurrentValue, null);

        // jam_reg
        $this->jam_reg->CurrentValue = CurrentTime();
        $this->jam_reg->setDbValueDef($rsnew, $this->jam_reg->CurrentValue, null);

        // kd_dokter
        $this->kd_dokter->setDbValueDef($rsnew, $this->kd_dokter->CurrentValue, null, false);

        // kd_poli
        $this->kd_poli->setDbValueDef($rsnew, $this->kd_poli->CurrentValue, null, false);

        // p_jawab
        $this->p_jawab->setDbValueDef($rsnew, $this->p_jawab->CurrentValue, null, false);

        // almt_pj
        $this->almt_pj->setDbValueDef($rsnew, $this->almt_pj->CurrentValue, null, false);

        // hubunganpj
        $this->hubunganpj->setDbValueDef($rsnew, $this->hubunganpj->CurrentValue, null, false);

        // biaya_reg
        $this->biaya_reg->setDbValueDef($rsnew, $this->biaya_reg->CurrentValue, null, false);

        // stts
        $this->stts->setDbValueDef($rsnew, $this->stts->CurrentValue, null, false);

        // stts_daftar
        $this->stts_daftar->setDbValueDef($rsnew, $this->stts_daftar->CurrentValue, null, false);

        // status_lanjut
        $this->status_lanjut->setDbValueDef($rsnew, $this->status_lanjut->CurrentValue, null, false);

        // kd_pj
        $this->kd_pj->setDbValueDef($rsnew, $this->kd_pj->CurrentValue, null, false);

        // umurdaftar
        $this->umurdaftar->setDbValueDef($rsnew, $this->umurdaftar->CurrentValue, null, false);

        // sttsumur
        $this->sttsumur->setDbValueDef($rsnew, $this->sttsumur->CurrentValue, null, false);

        // status_bayar
        $this->status_bayar->setDbValueDef($rsnew, $this->status_bayar->CurrentValue, null, false);

        // status_poli
        $this->status_poli->setDbValueDef($rsnew, $this->status_poli->CurrentValue, null, false);

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
            if ($masterTblVar == "vriwayat") {
                $validMaster = true;
                $masterTbl = Container("vriwayat");
                if (($parm = Get("fk_no_rkm_medis", Get("no_rkm_medis"))) !== null) {
                    $masterTbl->no_rkm_medis->setQueryStringValue($parm);
                    $this->no_rkm_medis->setQueryStringValue($masterTbl->no_rkm_medis->QueryStringValue);
                    $this->no_rkm_medis->setSessionValue($this->no_rkm_medis->QueryStringValue);
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
            if ($masterTblVar == "vriwayat") {
                $validMaster = true;
                $masterTbl = Container("vriwayat");
                if (($parm = Post("fk_no_rkm_medis", Post("no_rkm_medis"))) !== null) {
                    $masterTbl->no_rkm_medis->setFormValue($parm);
                    $this->no_rkm_medis->setFormValue($masterTbl->no_rkm_medis->FormValue);
                    $this->no_rkm_medis->setSessionValue($this->no_rkm_medis->FormValue);
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
            if ($masterTblVar != "vriwayat") {
                if ($this->no_rkm_medis->CurrentValue == "") {
                    $this->no_rkm_medis->setSessionValue("");
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PasienKunjunganList"), "", $this->TableVar, true);
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
                case "x_no_rkm_medis":
                    break;
                case "x_stts":
                    break;
                case "x_stts_daftar":
                    break;
                case "x_status_lanjut":
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
