<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianPsikologiAdd extends PenilaianPsikologi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_psikologi';

    // Page object name
    public $PageObjName = "PenilaianPsikologiAdd";

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

        // Table object (penilaian_psikologi)
        if (!isset($GLOBALS["penilaian_psikologi"]) || get_class($GLOBALS["penilaian_psikologi"]) == PROJECT_NAMESPACE . "penilaian_psikologi") {
            $GLOBALS["penilaian_psikologi"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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
                    if ($pageName == "PenilaianPsikologiView") {
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
        $this->id_penilaian_psikologi->Visible = false;
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->nip->setVisibility();
        $this->anamnesis->setVisibility();
        $this->dikirim_dari->setVisibility();
        $this->tujuan_pemeriksaan->setVisibility();
        $this->ket_anamnesis->setVisibility();
        $this->rupa->setVisibility();
        $this->bentuk_tubuh->setVisibility();
        $this->tindakan->setVisibility();
        $this->pakaian->setVisibility();
        $this->ekspresi->setVisibility();
        $this->berbicara->setVisibility();
        $this->penggunaan_kata->setVisibility();
        $this->ciri_menyolok->setVisibility();
        $this->hasil_psikotes->setVisibility();
        $this->kepribadian->setVisibility();
        $this->psikodinamika->setVisibility();
        $this->kesimpulan_psikolog->setVisibility();
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
            if (($keyValue = Get("id_penilaian_psikologi") ?? Route("id_penilaian_psikologi")) !== null) {
                $this->id_penilaian_psikologi->setQueryStringValue($keyValue);
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
                    $this->terminate("PenilaianPsikologiList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PenilaianPsikologiList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PenilaianPsikologiView") {
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

        // Check field name 'nip' first before field var 'x_nip'
        $val = $CurrentForm->hasValue("nip") ? $CurrentForm->getValue("nip") : $CurrentForm->getValue("x_nip");
        if (!$this->nip->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nip->Visible = false; // Disable update for API request
            } else {
                $this->nip->setFormValue($val);
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

        // Check field name 'dikirim_dari' first before field var 'x_dikirim_dari'
        $val = $CurrentForm->hasValue("dikirim_dari") ? $CurrentForm->getValue("dikirim_dari") : $CurrentForm->getValue("x_dikirim_dari");
        if (!$this->dikirim_dari->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dikirim_dari->Visible = false; // Disable update for API request
            } else {
                $this->dikirim_dari->setFormValue($val);
            }
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

        // Check field name 'ket_anamnesis' first before field var 'x_ket_anamnesis'
        $val = $CurrentForm->hasValue("ket_anamnesis") ? $CurrentForm->getValue("ket_anamnesis") : $CurrentForm->getValue("x_ket_anamnesis");
        if (!$this->ket_anamnesis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_anamnesis->Visible = false; // Disable update for API request
            } else {
                $this->ket_anamnesis->setFormValue($val);
            }
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

        // Check field name 'bentuk_tubuh' first before field var 'x_bentuk_tubuh'
        $val = $CurrentForm->hasValue("bentuk_tubuh") ? $CurrentForm->getValue("bentuk_tubuh") : $CurrentForm->getValue("x_bentuk_tubuh");
        if (!$this->bentuk_tubuh->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bentuk_tubuh->Visible = false; // Disable update for API request
            } else {
                $this->bentuk_tubuh->setFormValue($val);
            }
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

        // Check field name 'pakaian' first before field var 'x_pakaian'
        $val = $CurrentForm->hasValue("pakaian") ? $CurrentForm->getValue("pakaian") : $CurrentForm->getValue("x_pakaian");
        if (!$this->pakaian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pakaian->Visible = false; // Disable update for API request
            } else {
                $this->pakaian->setFormValue($val);
            }
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

        // Check field name 'berbicara' first before field var 'x_berbicara'
        $val = $CurrentForm->hasValue("berbicara") ? $CurrentForm->getValue("berbicara") : $CurrentForm->getValue("x_berbicara");
        if (!$this->berbicara->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berbicara->Visible = false; // Disable update for API request
            } else {
                $this->berbicara->setFormValue($val);
            }
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

        // Check field name 'ciri_menyolok' first before field var 'x_ciri_menyolok'
        $val = $CurrentForm->hasValue("ciri_menyolok") ? $CurrentForm->getValue("ciri_menyolok") : $CurrentForm->getValue("x_ciri_menyolok");
        if (!$this->ciri_menyolok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ciri_menyolok->Visible = false; // Disable update for API request
            } else {
                $this->ciri_menyolok->setFormValue($val);
            }
        }

        // Check field name 'hasil_psikotes' first before field var 'x_hasil_psikotes'
        $val = $CurrentForm->hasValue("hasil_psikotes") ? $CurrentForm->getValue("hasil_psikotes") : $CurrentForm->getValue("x_hasil_psikotes");
        if (!$this->hasil_psikotes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hasil_psikotes->Visible = false; // Disable update for API request
            } else {
                $this->hasil_psikotes->setFormValue($val);
            }
        }

        // Check field name 'kepribadian' first before field var 'x_kepribadian'
        $val = $CurrentForm->hasValue("kepribadian") ? $CurrentForm->getValue("kepribadian") : $CurrentForm->getValue("x_kepribadian");
        if (!$this->kepribadian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kepribadian->Visible = false; // Disable update for API request
            } else {
                $this->kepribadian->setFormValue($val);
            }
        }

        // Check field name 'psikodinamika' first before field var 'x_psikodinamika'
        $val = $CurrentForm->hasValue("psikodinamika") ? $CurrentForm->getValue("psikodinamika") : $CurrentForm->getValue("x_psikodinamika");
        if (!$this->psikodinamika->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->psikodinamika->Visible = false; // Disable update for API request
            } else {
                $this->psikodinamika->setFormValue($val);
            }
        }

        // Check field name 'kesimpulan_psikolog' first before field var 'x_kesimpulan_psikolog'
        $val = $CurrentForm->hasValue("kesimpulan_psikolog") ? $CurrentForm->getValue("kesimpulan_psikolog") : $CurrentForm->getValue("x_kesimpulan_psikolog");
        if (!$this->kesimpulan_psikolog->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kesimpulan_psikolog->Visible = false; // Disable update for API request
            } else {
                $this->kesimpulan_psikolog->setFormValue($val);
            }
        }

        // Check field name 'id_penilaian_psikologi' first before field var 'x_id_penilaian_psikologi'
        $val = $CurrentForm->hasValue("id_penilaian_psikologi") ? $CurrentForm->getValue("id_penilaian_psikologi") : $CurrentForm->getValue("x_id_penilaian_psikologi");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->tanggal->CurrentValue = $this->tanggal->FormValue;
        $this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
        $this->nip->CurrentValue = $this->nip->FormValue;
        $this->anamnesis->CurrentValue = $this->anamnesis->FormValue;
        $this->dikirim_dari->CurrentValue = $this->dikirim_dari->FormValue;
        $this->tujuan_pemeriksaan->CurrentValue = $this->tujuan_pemeriksaan->FormValue;
        $this->ket_anamnesis->CurrentValue = $this->ket_anamnesis->FormValue;
        $this->rupa->CurrentValue = $this->rupa->FormValue;
        $this->bentuk_tubuh->CurrentValue = $this->bentuk_tubuh->FormValue;
        $this->tindakan->CurrentValue = $this->tindakan->FormValue;
        $this->pakaian->CurrentValue = $this->pakaian->FormValue;
        $this->ekspresi->CurrentValue = $this->ekspresi->FormValue;
        $this->berbicara->CurrentValue = $this->berbicara->FormValue;
        $this->penggunaan_kata->CurrentValue = $this->penggunaan_kata->FormValue;
        $this->ciri_menyolok->CurrentValue = $this->ciri_menyolok->FormValue;
        $this->hasil_psikotes->CurrentValue = $this->hasil_psikotes->FormValue;
        $this->kepribadian->CurrentValue = $this->kepribadian->FormValue;
        $this->psikodinamika->CurrentValue = $this->psikodinamika->FormValue;
        $this->kesimpulan_psikolog->CurrentValue = $this->kesimpulan_psikolog->FormValue;
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

            // ket_anamnesis
            $this->ket_anamnesis->ViewValue = $this->ket_anamnesis->CurrentValue;
            $this->ket_anamnesis->ViewCustomAttributes = "";

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

            // ciri_menyolok
            $this->ciri_menyolok->ViewValue = $this->ciri_menyolok->CurrentValue;
            $this->ciri_menyolok->ViewCustomAttributes = "";

            // hasil_psikotes
            $this->hasil_psikotes->ViewValue = $this->hasil_psikotes->CurrentValue;
            $this->hasil_psikotes->ViewCustomAttributes = "";

            // kepribadian
            $this->kepribadian->ViewValue = $this->kepribadian->CurrentValue;
            $this->kepribadian->ViewCustomAttributes = "";

            // psikodinamika
            $this->psikodinamika->ViewValue = $this->psikodinamika->CurrentValue;
            $this->psikodinamika->ViewCustomAttributes = "";

            // kesimpulan_psikolog
            $this->kesimpulan_psikolog->ViewValue = $this->kesimpulan_psikolog->CurrentValue;
            $this->kesimpulan_psikolog->ViewCustomAttributes = "";

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

            // ket_anamnesis
            $this->ket_anamnesis->LinkCustomAttributes = "";
            $this->ket_anamnesis->HrefValue = "";
            $this->ket_anamnesis->TooltipValue = "";

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

            // ciri_menyolok
            $this->ciri_menyolok->LinkCustomAttributes = "";
            $this->ciri_menyolok->HrefValue = "";
            $this->ciri_menyolok->TooltipValue = "";

            // hasil_psikotes
            $this->hasil_psikotes->LinkCustomAttributes = "";
            $this->hasil_psikotes->HrefValue = "";
            $this->hasil_psikotes->TooltipValue = "";

            // kepribadian
            $this->kepribadian->LinkCustomAttributes = "";
            $this->kepribadian->HrefValue = "";
            $this->kepribadian->TooltipValue = "";

            // psikodinamika
            $this->psikodinamika->LinkCustomAttributes = "";
            $this->psikodinamika->HrefValue = "";
            $this->psikodinamika->TooltipValue = "";

            // kesimpulan_psikolog
            $this->kesimpulan_psikolog->LinkCustomAttributes = "";
            $this->kesimpulan_psikolog->HrefValue = "";
            $this->kesimpulan_psikolog->TooltipValue = "";
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

            // ket_anamnesis
            $this->ket_anamnesis->EditAttrs["class"] = "form-control";
            $this->ket_anamnesis->EditCustomAttributes = "";
            $this->ket_anamnesis->EditValue = HtmlEncode($this->ket_anamnesis->CurrentValue);
            $this->ket_anamnesis->PlaceHolder = RemoveHtml($this->ket_anamnesis->caption());

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

            // ciri_menyolok
            $this->ciri_menyolok->EditAttrs["class"] = "form-control";
            $this->ciri_menyolok->EditCustomAttributes = "";
            $this->ciri_menyolok->EditValue = HtmlEncode($this->ciri_menyolok->CurrentValue);
            $this->ciri_menyolok->PlaceHolder = RemoveHtml($this->ciri_menyolok->caption());

            // hasil_psikotes
            $this->hasil_psikotes->EditAttrs["class"] = "form-control";
            $this->hasil_psikotes->EditCustomAttributes = "";
            $this->hasil_psikotes->EditValue = HtmlEncode($this->hasil_psikotes->CurrentValue);
            $this->hasil_psikotes->PlaceHolder = RemoveHtml($this->hasil_psikotes->caption());

            // kepribadian
            $this->kepribadian->EditAttrs["class"] = "form-control";
            $this->kepribadian->EditCustomAttributes = "";
            $this->kepribadian->EditValue = HtmlEncode($this->kepribadian->CurrentValue);
            $this->kepribadian->PlaceHolder = RemoveHtml($this->kepribadian->caption());

            // psikodinamika
            $this->psikodinamika->EditAttrs["class"] = "form-control";
            $this->psikodinamika->EditCustomAttributes = "";
            $this->psikodinamika->EditValue = HtmlEncode($this->psikodinamika->CurrentValue);
            $this->psikodinamika->PlaceHolder = RemoveHtml($this->psikodinamika->caption());

            // kesimpulan_psikolog
            $this->kesimpulan_psikolog->EditAttrs["class"] = "form-control";
            $this->kesimpulan_psikolog->EditCustomAttributes = "";
            $this->kesimpulan_psikolog->EditValue = HtmlEncode($this->kesimpulan_psikolog->CurrentValue);
            $this->kesimpulan_psikolog->PlaceHolder = RemoveHtml($this->kesimpulan_psikolog->caption());

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

            // ket_anamnesis
            $this->ket_anamnesis->LinkCustomAttributes = "";
            $this->ket_anamnesis->HrefValue = "";

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

            // ciri_menyolok
            $this->ciri_menyolok->LinkCustomAttributes = "";
            $this->ciri_menyolok->HrefValue = "";

            // hasil_psikotes
            $this->hasil_psikotes->LinkCustomAttributes = "";
            $this->hasil_psikotes->HrefValue = "";

            // kepribadian
            $this->kepribadian->LinkCustomAttributes = "";
            $this->kepribadian->HrefValue = "";

            // psikodinamika
            $this->psikodinamika->LinkCustomAttributes = "";
            $this->psikodinamika->HrefValue = "";

            // kesimpulan_psikolog
            $this->kesimpulan_psikolog->LinkCustomAttributes = "";
            $this->kesimpulan_psikolog->HrefValue = "";
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
        if ($this->ket_anamnesis->Required) {
            if (!$this->ket_anamnesis->IsDetailKey && EmptyValue($this->ket_anamnesis->FormValue)) {
                $this->ket_anamnesis->addErrorMessage(str_replace("%s", $this->ket_anamnesis->caption(), $this->ket_anamnesis->RequiredErrorMessage));
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
        if ($this->ciri_menyolok->Required) {
            if (!$this->ciri_menyolok->IsDetailKey && EmptyValue($this->ciri_menyolok->FormValue)) {
                $this->ciri_menyolok->addErrorMessage(str_replace("%s", $this->ciri_menyolok->caption(), $this->ciri_menyolok->RequiredErrorMessage));
            }
        }
        if ($this->hasil_psikotes->Required) {
            if (!$this->hasil_psikotes->IsDetailKey && EmptyValue($this->hasil_psikotes->FormValue)) {
                $this->hasil_psikotes->addErrorMessage(str_replace("%s", $this->hasil_psikotes->caption(), $this->hasil_psikotes->RequiredErrorMessage));
            }
        }
        if ($this->kepribadian->Required) {
            if (!$this->kepribadian->IsDetailKey && EmptyValue($this->kepribadian->FormValue)) {
                $this->kepribadian->addErrorMessage(str_replace("%s", $this->kepribadian->caption(), $this->kepribadian->RequiredErrorMessage));
            }
        }
        if ($this->psikodinamika->Required) {
            if (!$this->psikodinamika->IsDetailKey && EmptyValue($this->psikodinamika->FormValue)) {
                $this->psikodinamika->addErrorMessage(str_replace("%s", $this->psikodinamika->caption(), $this->psikodinamika->RequiredErrorMessage));
            }
        }
        if ($this->kesimpulan_psikolog->Required) {
            if (!$this->kesimpulan_psikolog->IsDetailKey && EmptyValue($this->kesimpulan_psikolog->FormValue)) {
                $this->kesimpulan_psikolog->addErrorMessage(str_replace("%s", $this->kesimpulan_psikolog->caption(), $this->kesimpulan_psikolog->RequiredErrorMessage));
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

        // ket_anamnesis
        $this->ket_anamnesis->setDbValueDef($rsnew, $this->ket_anamnesis->CurrentValue, "", false);

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

        // ciri_menyolok
        $this->ciri_menyolok->setDbValueDef($rsnew, $this->ciri_menyolok->CurrentValue, "", false);

        // hasil_psikotes
        $this->hasil_psikotes->setDbValueDef($rsnew, $this->hasil_psikotes->CurrentValue, "", false);

        // kepribadian
        $this->kepribadian->setDbValueDef($rsnew, $this->kepribadian->CurrentValue, "", false);

        // psikodinamika
        $this->psikodinamika->setDbValueDef($rsnew, $this->psikodinamika->CurrentValue, "", false);

        // kesimpulan_psikolog
        $this->kesimpulan_psikolog->setDbValueDef($rsnew, $this->kesimpulan_psikolog->CurrentValue, "", false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PenilaianPsikologiList"), "", $this->TableVar, true);
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
}
