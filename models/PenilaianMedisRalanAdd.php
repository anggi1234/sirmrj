<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianMedisRalanAdd extends PenilaianMedisRalan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_medis_ralan';

    // Page object name
    public $PageObjName = "PenilaianMedisRalanAdd";

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

        // Table object (penilaian_medis_ralan)
        if (!isset($GLOBALS["penilaian_medis_ralan"]) || get_class($GLOBALS["penilaian_medis_ralan"]) == PROJECT_NAMESPACE . "penilaian_medis_ralan") {
            $GLOBALS["penilaian_medis_ralan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penilaian_medis_ralan');
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
                $doc = new $class(Container("penilaian_medis_ralan"));
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
                    if ($pageName == "PenilaianMedisRalanView") {
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
            $key .= @$ar['id_penilaian_medis_ralan'];
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
            $this->id_penilaian_medis_ralan->Visible = false;
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
        $this->id_penilaian_medis_ralan->Visible = false;
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->kd_dokter->setVisibility();
        $this->anamnesis->setVisibility();
        $this->hubungan->Visible = false;
        $this->keluhan_utama->setVisibility();
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
        $this->spo->Visible = false;
        $this->bb->setVisibility();
        $this->tb->setVisibility();
        $this->kepala->Visible = false;
        $this->gigi->Visible = false;
        $this->tht->Visible = false;
        $this->thoraks->Visible = false;
        $this->abdomen->Visible = false;
        $this->genital->Visible = false;
        $this->ekstremitas->Visible = false;
        $this->kulit->Visible = false;
        $this->ket_fisik->setVisibility();
        $this->ket_lokalis->Visible = false;
        $this->penunjang->setVisibility();
        $this->diagnosis->setVisibility();
        $this->tata->Visible = false;
        $this->konsulrujuk->Visible = false;
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
            if (($keyValue = Get("id_penilaian_medis_ralan") ?? Route("id_penilaian_medis_ralan")) !== null) {
                $this->id_penilaian_medis_ralan->setQueryStringValue($keyValue);
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
                    $this->terminate("PenilaianMedisRalanList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PenilaianMedisRalanList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PenilaianMedisRalanView") {
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
        $this->id_penilaian_medis_ralan->CurrentValue = null;
        $this->id_penilaian_medis_ralan->OldValue = $this->id_penilaian_medis_ralan->CurrentValue;
        $this->no_rawat->CurrentValue = null;
        $this->no_rawat->OldValue = $this->no_rawat->CurrentValue;
        $this->tanggal->CurrentValue = null;
        $this->tanggal->OldValue = $this->tanggal->CurrentValue;
        $this->kd_dokter->CurrentValue = null;
        $this->kd_dokter->OldValue = $this->kd_dokter->CurrentValue;
        $this->anamnesis->CurrentValue = null;
        $this->anamnesis->OldValue = $this->anamnesis->CurrentValue;
        $this->hubungan->CurrentValue = null;
        $this->hubungan->OldValue = $this->hubungan->CurrentValue;
        $this->keluhan_utama->CurrentValue = null;
        $this->keluhan_utama->OldValue = $this->keluhan_utama->CurrentValue;
        $this->rps->CurrentValue = null;
        $this->rps->OldValue = $this->rps->CurrentValue;
        $this->rpd->CurrentValue = null;
        $this->rpd->OldValue = $this->rpd->CurrentValue;
        $this->rpk->CurrentValue = null;
        $this->rpk->OldValue = $this->rpk->CurrentValue;
        $this->rpo->CurrentValue = null;
        $this->rpo->OldValue = $this->rpo->CurrentValue;
        $this->alergi->CurrentValue = null;
        $this->alergi->OldValue = $this->alergi->CurrentValue;
        $this->keadaan->CurrentValue = null;
        $this->keadaan->OldValue = $this->keadaan->CurrentValue;
        $this->gcs->CurrentValue = null;
        $this->gcs->OldValue = $this->gcs->CurrentValue;
        $this->kesadaran->CurrentValue = null;
        $this->kesadaran->OldValue = $this->kesadaran->CurrentValue;
        $this->td->CurrentValue = null;
        $this->td->OldValue = $this->td->CurrentValue;
        $this->nadi->CurrentValue = null;
        $this->nadi->OldValue = $this->nadi->CurrentValue;
        $this->rr->CurrentValue = null;
        $this->rr->OldValue = $this->rr->CurrentValue;
        $this->suhu->CurrentValue = null;
        $this->suhu->OldValue = $this->suhu->CurrentValue;
        $this->spo->CurrentValue = null;
        $this->spo->OldValue = $this->spo->CurrentValue;
        $this->bb->CurrentValue = null;
        $this->bb->OldValue = $this->bb->CurrentValue;
        $this->tb->CurrentValue = null;
        $this->tb->OldValue = $this->tb->CurrentValue;
        $this->kepala->CurrentValue = null;
        $this->kepala->OldValue = $this->kepala->CurrentValue;
        $this->gigi->CurrentValue = null;
        $this->gigi->OldValue = $this->gigi->CurrentValue;
        $this->tht->CurrentValue = null;
        $this->tht->OldValue = $this->tht->CurrentValue;
        $this->thoraks->CurrentValue = null;
        $this->thoraks->OldValue = $this->thoraks->CurrentValue;
        $this->abdomen->CurrentValue = null;
        $this->abdomen->OldValue = $this->abdomen->CurrentValue;
        $this->genital->CurrentValue = null;
        $this->genital->OldValue = $this->genital->CurrentValue;
        $this->ekstremitas->CurrentValue = null;
        $this->ekstremitas->OldValue = $this->ekstremitas->CurrentValue;
        $this->kulit->CurrentValue = null;
        $this->kulit->OldValue = $this->kulit->CurrentValue;
        $this->ket_fisik->CurrentValue = null;
        $this->ket_fisik->OldValue = $this->ket_fisik->CurrentValue;
        $this->ket_lokalis->CurrentValue = null;
        $this->ket_lokalis->OldValue = $this->ket_lokalis->CurrentValue;
        $this->penunjang->CurrentValue = null;
        $this->penunjang->OldValue = $this->penunjang->CurrentValue;
        $this->diagnosis->CurrentValue = null;
        $this->diagnosis->OldValue = $this->diagnosis->CurrentValue;
        $this->tata->CurrentValue = null;
        $this->tata->OldValue = $this->tata->CurrentValue;
        $this->konsulrujuk->CurrentValue = null;
        $this->konsulrujuk->OldValue = $this->konsulrujuk->CurrentValue;
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

        // Check field name 'kd_dokter' first before field var 'x_kd_dokter'
        $val = $CurrentForm->hasValue("kd_dokter") ? $CurrentForm->getValue("kd_dokter") : $CurrentForm->getValue("x_kd_dokter");
        if (!$this->kd_dokter->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_dokter->Visible = false; // Disable update for API request
            } else {
                $this->kd_dokter->setFormValue($val);
            }
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

        // Check field name 'keluhan_utama' first before field var 'x_keluhan_utama'
        $val = $CurrentForm->hasValue("keluhan_utama") ? $CurrentForm->getValue("keluhan_utama") : $CurrentForm->getValue("x_keluhan_utama");
        if (!$this->keluhan_utama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keluhan_utama->Visible = false; // Disable update for API request
            } else {
                $this->keluhan_utama->setFormValue($val);
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

        // Check field name 'keadaan' first before field var 'x_keadaan'
        $val = $CurrentForm->hasValue("keadaan") ? $CurrentForm->getValue("keadaan") : $CurrentForm->getValue("x_keadaan");
        if (!$this->keadaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keadaan->Visible = false; // Disable update for API request
            } else {
                $this->keadaan->setFormValue($val);
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

        // Check field name 'td' first before field var 'x_td'
        $val = $CurrentForm->hasValue("td") ? $CurrentForm->getValue("td") : $CurrentForm->getValue("x_td");
        if (!$this->td->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->td->Visible = false; // Disable update for API request
            } else {
                $this->td->setFormValue($val);
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

        // Check field name 'rr' first before field var 'x_rr'
        $val = $CurrentForm->hasValue("rr") ? $CurrentForm->getValue("rr") : $CurrentForm->getValue("x_rr");
        if (!$this->rr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rr->Visible = false; // Disable update for API request
            } else {
                $this->rr->setFormValue($val);
            }
        }

        // Check field name 'suhu' first before field var 'x_suhu'
        $val = $CurrentForm->hasValue("suhu") ? $CurrentForm->getValue("suhu") : $CurrentForm->getValue("x_suhu");
        if (!$this->suhu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->suhu->Visible = false; // Disable update for API request
            } else {
                $this->suhu->setFormValue($val);
            }
        }

        // Check field name 'bb' first before field var 'x_bb'
        $val = $CurrentForm->hasValue("bb") ? $CurrentForm->getValue("bb") : $CurrentForm->getValue("x_bb");
        if (!$this->bb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bb->Visible = false; // Disable update for API request
            } else {
                $this->bb->setFormValue($val);
            }
        }

        // Check field name 'tb' first before field var 'x_tb'
        $val = $CurrentForm->hasValue("tb") ? $CurrentForm->getValue("tb") : $CurrentForm->getValue("x_tb");
        if (!$this->tb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tb->Visible = false; // Disable update for API request
            } else {
                $this->tb->setFormValue($val);
            }
        }

        // Check field name 'ket_fisik' first before field var 'x_ket_fisik'
        $val = $CurrentForm->hasValue("ket_fisik") ? $CurrentForm->getValue("ket_fisik") : $CurrentForm->getValue("x_ket_fisik");
        if (!$this->ket_fisik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_fisik->Visible = false; // Disable update for API request
            } else {
                $this->ket_fisik->setFormValue($val);
            }
        }

        // Check field name 'penunjang' first before field var 'x_penunjang'
        $val = $CurrentForm->hasValue("penunjang") ? $CurrentForm->getValue("penunjang") : $CurrentForm->getValue("x_penunjang");
        if (!$this->penunjang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->penunjang->Visible = false; // Disable update for API request
            } else {
                $this->penunjang->setFormValue($val);
            }
        }

        // Check field name 'diagnosis' first before field var 'x_diagnosis'
        $val = $CurrentForm->hasValue("diagnosis") ? $CurrentForm->getValue("diagnosis") : $CurrentForm->getValue("x_diagnosis");
        if (!$this->diagnosis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->diagnosis->Visible = false; // Disable update for API request
            } else {
                $this->diagnosis->setFormValue($val);
            }
        }

        // Check field name 'id_penilaian_medis_ralan' first before field var 'x_id_penilaian_medis_ralan'
        $val = $CurrentForm->hasValue("id_penilaian_medis_ralan") ? $CurrentForm->getValue("id_penilaian_medis_ralan") : $CurrentForm->getValue("x_id_penilaian_medis_ralan");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->tanggal->CurrentValue = $this->tanggal->FormValue;
        $this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
        $this->kd_dokter->CurrentValue = $this->kd_dokter->FormValue;
        $this->anamnesis->CurrentValue = $this->anamnesis->FormValue;
        $this->keluhan_utama->CurrentValue = $this->keluhan_utama->FormValue;
        $this->alergi->CurrentValue = $this->alergi->FormValue;
        $this->keadaan->CurrentValue = $this->keadaan->FormValue;
        $this->gcs->CurrentValue = $this->gcs->FormValue;
        $this->kesadaran->CurrentValue = $this->kesadaran->FormValue;
        $this->td->CurrentValue = $this->td->FormValue;
        $this->nadi->CurrentValue = $this->nadi->FormValue;
        $this->rr->CurrentValue = $this->rr->FormValue;
        $this->suhu->CurrentValue = $this->suhu->FormValue;
        $this->bb->CurrentValue = $this->bb->FormValue;
        $this->tb->CurrentValue = $this->tb->FormValue;
        $this->ket_fisik->CurrentValue = $this->ket_fisik->FormValue;
        $this->penunjang->CurrentValue = $this->penunjang->FormValue;
        $this->diagnosis->CurrentValue = $this->diagnosis->FormValue;
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
        $this->id_penilaian_medis_ralan->setDbValue($row['id_penilaian_medis_ralan']);
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
        $this->konsulrujuk->setDbValue($row['konsulrujuk']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_penilaian_medis_ralan'] = $this->id_penilaian_medis_ralan->CurrentValue;
        $row['no_rawat'] = $this->no_rawat->CurrentValue;
        $row['tanggal'] = $this->tanggal->CurrentValue;
        $row['kd_dokter'] = $this->kd_dokter->CurrentValue;
        $row['anamnesis'] = $this->anamnesis->CurrentValue;
        $row['hubungan'] = $this->hubungan->CurrentValue;
        $row['keluhan_utama'] = $this->keluhan_utama->CurrentValue;
        $row['rps'] = $this->rps->CurrentValue;
        $row['rpd'] = $this->rpd->CurrentValue;
        $row['rpk'] = $this->rpk->CurrentValue;
        $row['rpo'] = $this->rpo->CurrentValue;
        $row['alergi'] = $this->alergi->CurrentValue;
        $row['keadaan'] = $this->keadaan->CurrentValue;
        $row['gcs'] = $this->gcs->CurrentValue;
        $row['kesadaran'] = $this->kesadaran->CurrentValue;
        $row['td'] = $this->td->CurrentValue;
        $row['nadi'] = $this->nadi->CurrentValue;
        $row['rr'] = $this->rr->CurrentValue;
        $row['suhu'] = $this->suhu->CurrentValue;
        $row['spo'] = $this->spo->CurrentValue;
        $row['bb'] = $this->bb->CurrentValue;
        $row['tb'] = $this->tb->CurrentValue;
        $row['kepala'] = $this->kepala->CurrentValue;
        $row['gigi'] = $this->gigi->CurrentValue;
        $row['tht'] = $this->tht->CurrentValue;
        $row['thoraks'] = $this->thoraks->CurrentValue;
        $row['abdomen'] = $this->abdomen->CurrentValue;
        $row['genital'] = $this->genital->CurrentValue;
        $row['ekstremitas'] = $this->ekstremitas->CurrentValue;
        $row['kulit'] = $this->kulit->CurrentValue;
        $row['ket_fisik'] = $this->ket_fisik->CurrentValue;
        $row['ket_lokalis'] = $this->ket_lokalis->CurrentValue;
        $row['penunjang'] = $this->penunjang->CurrentValue;
        $row['diagnosis'] = $this->diagnosis->CurrentValue;
        $row['tata'] = $this->tata->CurrentValue;
        $row['konsulrujuk'] = $this->konsulrujuk->CurrentValue;
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

        // id_penilaian_medis_ralan

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

        // konsulrujuk
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_penilaian_medis_ralan
            $this->id_penilaian_medis_ralan->ViewValue = $this->id_penilaian_medis_ralan->CurrentValue;
            $this->id_penilaian_medis_ralan->ViewCustomAttributes = "";

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

            // keluhan_utama
            $this->keluhan_utama->ViewValue = $this->keluhan_utama->CurrentValue;
            $this->keluhan_utama->ViewCustomAttributes = "";

            // rps
            $this->rps->ViewValue = $this->rps->CurrentValue;
            $this->rps->ViewCustomAttributes = "";

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

            // ket_fisik
            $this->ket_fisik->ViewValue = $this->ket_fisik->CurrentValue;
            $this->ket_fisik->ViewCustomAttributes = "";

            // ket_lokalis
            $this->ket_lokalis->ViewValue = $this->ket_lokalis->CurrentValue;
            $this->ket_lokalis->ViewCustomAttributes = "";

            // penunjang
            $this->penunjang->ViewValue = $this->penunjang->CurrentValue;
            $this->penunjang->ViewCustomAttributes = "";

            // diagnosis
            $this->diagnosis->ViewValue = $this->diagnosis->CurrentValue;
            $this->diagnosis->ViewCustomAttributes = "";

            // tata
            $this->tata->ViewValue = $this->tata->CurrentValue;
            $this->tata->ViewCustomAttributes = "";

            // konsulrujuk
            $this->konsulrujuk->ViewValue = $this->konsulrujuk->CurrentValue;
            $this->konsulrujuk->ViewCustomAttributes = "";

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

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";
            $this->keluhan_utama->TooltipValue = "";

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

            // bb
            $this->bb->LinkCustomAttributes = "";
            $this->bb->HrefValue = "";
            $this->bb->TooltipValue = "";

            // tb
            $this->tb->LinkCustomAttributes = "";
            $this->tb->HrefValue = "";
            $this->tb->TooltipValue = "";

            // ket_fisik
            $this->ket_fisik->LinkCustomAttributes = "";
            $this->ket_fisik->HrefValue = "";
            $this->ket_fisik->TooltipValue = "";

            // penunjang
            $this->penunjang->LinkCustomAttributes = "";
            $this->penunjang->HrefValue = "";
            $this->penunjang->TooltipValue = "";

            // diagnosis
            $this->diagnosis->LinkCustomAttributes = "";
            $this->diagnosis->HrefValue = "";
            $this->diagnosis->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
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

            // tanggal

            // kd_dokter
            $this->kd_dokter->EditAttrs["class"] = "form-control";
            $this->kd_dokter->EditCustomAttributes = "";
            if (!$this->kd_dokter->Raw) {
                $this->kd_dokter->CurrentValue = HtmlDecode($this->kd_dokter->CurrentValue);
            }
            $this->kd_dokter->EditValue = HtmlEncode($this->kd_dokter->CurrentValue);
            $this->kd_dokter->PlaceHolder = RemoveHtml($this->kd_dokter->caption());

            // anamnesis
            $this->anamnesis->EditCustomAttributes = "";
            $this->anamnesis->EditValue = $this->anamnesis->options(false);
            $this->anamnesis->PlaceHolder = RemoveHtml($this->anamnesis->caption());

            // keluhan_utama
            $this->keluhan_utama->EditAttrs["class"] = "form-control";
            $this->keluhan_utama->EditCustomAttributes = "";
            $this->keluhan_utama->EditValue = HtmlEncode($this->keluhan_utama->CurrentValue);
            $this->keluhan_utama->PlaceHolder = RemoveHtml($this->keluhan_utama->caption());

            // alergi
            $this->alergi->EditAttrs["class"] = "form-control";
            $this->alergi->EditCustomAttributes = "";
            if (!$this->alergi->Raw) {
                $this->alergi->CurrentValue = HtmlDecode($this->alergi->CurrentValue);
            }
            $this->alergi->EditValue = HtmlEncode($this->alergi->CurrentValue);
            $this->alergi->PlaceHolder = RemoveHtml($this->alergi->caption());

            // keadaan
            $this->keadaan->EditCustomAttributes = "";
            $this->keadaan->EditValue = $this->keadaan->options(false);
            $this->keadaan->PlaceHolder = RemoveHtml($this->keadaan->caption());

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

            // td
            $this->td->EditAttrs["class"] = "form-control";
            $this->td->EditCustomAttributes = "";
            if (!$this->td->Raw) {
                $this->td->CurrentValue = HtmlDecode($this->td->CurrentValue);
            }
            $this->td->EditValue = HtmlEncode($this->td->CurrentValue);
            $this->td->PlaceHolder = RemoveHtml($this->td->caption());

            // nadi
            $this->nadi->EditAttrs["class"] = "form-control";
            $this->nadi->EditCustomAttributes = "";
            if (!$this->nadi->Raw) {
                $this->nadi->CurrentValue = HtmlDecode($this->nadi->CurrentValue);
            }
            $this->nadi->EditValue = HtmlEncode($this->nadi->CurrentValue);
            $this->nadi->PlaceHolder = RemoveHtml($this->nadi->caption());

            // rr
            $this->rr->EditAttrs["class"] = "form-control";
            $this->rr->EditCustomAttributes = "";
            if (!$this->rr->Raw) {
                $this->rr->CurrentValue = HtmlDecode($this->rr->CurrentValue);
            }
            $this->rr->EditValue = HtmlEncode($this->rr->CurrentValue);
            $this->rr->PlaceHolder = RemoveHtml($this->rr->caption());

            // suhu
            $this->suhu->EditAttrs["class"] = "form-control";
            $this->suhu->EditCustomAttributes = "";
            if (!$this->suhu->Raw) {
                $this->suhu->CurrentValue = HtmlDecode($this->suhu->CurrentValue);
            }
            $this->suhu->EditValue = HtmlEncode($this->suhu->CurrentValue);
            $this->suhu->PlaceHolder = RemoveHtml($this->suhu->caption());

            // bb
            $this->bb->EditAttrs["class"] = "form-control";
            $this->bb->EditCustomAttributes = "";
            if (!$this->bb->Raw) {
                $this->bb->CurrentValue = HtmlDecode($this->bb->CurrentValue);
            }
            $this->bb->EditValue = HtmlEncode($this->bb->CurrentValue);
            $this->bb->PlaceHolder = RemoveHtml($this->bb->caption());

            // tb
            $this->tb->EditAttrs["class"] = "form-control";
            $this->tb->EditCustomAttributes = "";
            if (!$this->tb->Raw) {
                $this->tb->CurrentValue = HtmlDecode($this->tb->CurrentValue);
            }
            $this->tb->EditValue = HtmlEncode($this->tb->CurrentValue);
            $this->tb->PlaceHolder = RemoveHtml($this->tb->caption());

            // ket_fisik
            $this->ket_fisik->EditAttrs["class"] = "form-control";
            $this->ket_fisik->EditCustomAttributes = "";
            $this->ket_fisik->EditValue = HtmlEncode($this->ket_fisik->CurrentValue);
            $this->ket_fisik->PlaceHolder = RemoveHtml($this->ket_fisik->caption());

            // penunjang
            $this->penunjang->EditAttrs["class"] = "form-control";
            $this->penunjang->EditCustomAttributes = "";
            $this->penunjang->EditValue = HtmlEncode($this->penunjang->CurrentValue);
            $this->penunjang->PlaceHolder = RemoveHtml($this->penunjang->caption());

            // diagnosis
            $this->diagnosis->EditAttrs["class"] = "form-control";
            $this->diagnosis->EditCustomAttributes = "";
            $this->diagnosis->EditValue = HtmlEncode($this->diagnosis->CurrentValue);
            $this->diagnosis->PlaceHolder = RemoveHtml($this->diagnosis->caption());

            // Add refer script

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";

            // kd_dokter
            $this->kd_dokter->LinkCustomAttributes = "";
            $this->kd_dokter->HrefValue = "";

            // anamnesis
            $this->anamnesis->LinkCustomAttributes = "";
            $this->anamnesis->HrefValue = "";

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";

            // alergi
            $this->alergi->LinkCustomAttributes = "";
            $this->alergi->HrefValue = "";

            // keadaan
            $this->keadaan->LinkCustomAttributes = "";
            $this->keadaan->HrefValue = "";

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";

            // kesadaran
            $this->kesadaran->LinkCustomAttributes = "";
            $this->kesadaran->HrefValue = "";

            // td
            $this->td->LinkCustomAttributes = "";
            $this->td->HrefValue = "";

            // nadi
            $this->nadi->LinkCustomAttributes = "";
            $this->nadi->HrefValue = "";

            // rr
            $this->rr->LinkCustomAttributes = "";
            $this->rr->HrefValue = "";

            // suhu
            $this->suhu->LinkCustomAttributes = "";
            $this->suhu->HrefValue = "";

            // bb
            $this->bb->LinkCustomAttributes = "";
            $this->bb->HrefValue = "";

            // tb
            $this->tb->LinkCustomAttributes = "";
            $this->tb->HrefValue = "";

            // ket_fisik
            $this->ket_fisik->LinkCustomAttributes = "";
            $this->ket_fisik->HrefValue = "";

            // penunjang
            $this->penunjang->LinkCustomAttributes = "";
            $this->penunjang->HrefValue = "";

            // diagnosis
            $this->diagnosis->LinkCustomAttributes = "";
            $this->diagnosis->HrefValue = "";
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
        if ($this->kd_dokter->Required) {
            if (!$this->kd_dokter->IsDetailKey && EmptyValue($this->kd_dokter->FormValue)) {
                $this->kd_dokter->addErrorMessage(str_replace("%s", $this->kd_dokter->caption(), $this->kd_dokter->RequiredErrorMessage));
            }
        }
        if ($this->anamnesis->Required) {
            if ($this->anamnesis->FormValue == "") {
                $this->anamnesis->addErrorMessage(str_replace("%s", $this->anamnesis->caption(), $this->anamnesis->RequiredErrorMessage));
            }
        }
        if ($this->keluhan_utama->Required) {
            if (!$this->keluhan_utama->IsDetailKey && EmptyValue($this->keluhan_utama->FormValue)) {
                $this->keluhan_utama->addErrorMessage(str_replace("%s", $this->keluhan_utama->caption(), $this->keluhan_utama->RequiredErrorMessage));
            }
        }
        if ($this->alergi->Required) {
            if (!$this->alergi->IsDetailKey && EmptyValue($this->alergi->FormValue)) {
                $this->alergi->addErrorMessage(str_replace("%s", $this->alergi->caption(), $this->alergi->RequiredErrorMessage));
            }
        }
        if ($this->keadaan->Required) {
            if ($this->keadaan->FormValue == "") {
                $this->keadaan->addErrorMessage(str_replace("%s", $this->keadaan->caption(), $this->keadaan->RequiredErrorMessage));
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
        if ($this->td->Required) {
            if (!$this->td->IsDetailKey && EmptyValue($this->td->FormValue)) {
                $this->td->addErrorMessage(str_replace("%s", $this->td->caption(), $this->td->RequiredErrorMessage));
            }
        }
        if ($this->nadi->Required) {
            if (!$this->nadi->IsDetailKey && EmptyValue($this->nadi->FormValue)) {
                $this->nadi->addErrorMessage(str_replace("%s", $this->nadi->caption(), $this->nadi->RequiredErrorMessage));
            }
        }
        if ($this->rr->Required) {
            if (!$this->rr->IsDetailKey && EmptyValue($this->rr->FormValue)) {
                $this->rr->addErrorMessage(str_replace("%s", $this->rr->caption(), $this->rr->RequiredErrorMessage));
            }
        }
        if ($this->suhu->Required) {
            if (!$this->suhu->IsDetailKey && EmptyValue($this->suhu->FormValue)) {
                $this->suhu->addErrorMessage(str_replace("%s", $this->suhu->caption(), $this->suhu->RequiredErrorMessage));
            }
        }
        if ($this->bb->Required) {
            if (!$this->bb->IsDetailKey && EmptyValue($this->bb->FormValue)) {
                $this->bb->addErrorMessage(str_replace("%s", $this->bb->caption(), $this->bb->RequiredErrorMessage));
            }
        }
        if ($this->tb->Required) {
            if (!$this->tb->IsDetailKey && EmptyValue($this->tb->FormValue)) {
                $this->tb->addErrorMessage(str_replace("%s", $this->tb->caption(), $this->tb->RequiredErrorMessage));
            }
        }
        if ($this->ket_fisik->Required) {
            if (!$this->ket_fisik->IsDetailKey && EmptyValue($this->ket_fisik->FormValue)) {
                $this->ket_fisik->addErrorMessage(str_replace("%s", $this->ket_fisik->caption(), $this->ket_fisik->RequiredErrorMessage));
            }
        }
        if ($this->penunjang->Required) {
            if (!$this->penunjang->IsDetailKey && EmptyValue($this->penunjang->FormValue)) {
                $this->penunjang->addErrorMessage(str_replace("%s", $this->penunjang->caption(), $this->penunjang->RequiredErrorMessage));
            }
        }
        if ($this->diagnosis->Required) {
            if (!$this->diagnosis->IsDetailKey && EmptyValue($this->diagnosis->FormValue)) {
                $this->diagnosis->addErrorMessage(str_replace("%s", $this->diagnosis->caption(), $this->diagnosis->RequiredErrorMessage));
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

        // Check referential integrity for master table 'penilaian_medis_ralan'
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
        $this->tanggal->CurrentValue = CurrentDate();
        $this->tanggal->setDbValueDef($rsnew, $this->tanggal->CurrentValue, CurrentDate());

        // kd_dokter
        $this->kd_dokter->setDbValueDef($rsnew, $this->kd_dokter->CurrentValue, "", false);

        // anamnesis
        $this->anamnesis->setDbValueDef($rsnew, $this->anamnesis->CurrentValue, "", false);

        // keluhan_utama
        $this->keluhan_utama->setDbValueDef($rsnew, $this->keluhan_utama->CurrentValue, "", false);

        // alergi
        $this->alergi->setDbValueDef($rsnew, $this->alergi->CurrentValue, "", false);

        // keadaan
        $this->keadaan->setDbValueDef($rsnew, $this->keadaan->CurrentValue, "", false);

        // gcs
        $this->gcs->setDbValueDef($rsnew, $this->gcs->CurrentValue, "", false);

        // kesadaran
        $this->kesadaran->setDbValueDef($rsnew, $this->kesadaran->CurrentValue, "", false);

        // td
        $this->td->setDbValueDef($rsnew, $this->td->CurrentValue, "", false);

        // nadi
        $this->nadi->setDbValueDef($rsnew, $this->nadi->CurrentValue, "", false);

        // rr
        $this->rr->setDbValueDef($rsnew, $this->rr->CurrentValue, "", false);

        // suhu
        $this->suhu->setDbValueDef($rsnew, $this->suhu->CurrentValue, "", false);

        // bb
        $this->bb->setDbValueDef($rsnew, $this->bb->CurrentValue, "", false);

        // tb
        $this->tb->setDbValueDef($rsnew, $this->tb->CurrentValue, "", false);

        // ket_fisik
        $this->ket_fisik->setDbValueDef($rsnew, $this->ket_fisik->CurrentValue, "", false);

        // penunjang
        $this->penunjang->setDbValueDef($rsnew, $this->penunjang->CurrentValue, "", false);

        // diagnosis
        $this->diagnosis->setDbValueDef($rsnew, $this->diagnosis->CurrentValue, "", false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PenilaianMedisRalanList"), "", $this->TableVar, true);
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
                case "x_anamnesis":
                    break;
                case "x_keadaan":
                    break;
                case "x_kesadaran":
                    break;
                case "x_kepala":
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
