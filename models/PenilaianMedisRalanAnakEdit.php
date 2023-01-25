<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianMedisRalanAnakEdit extends PenilaianMedisRalanAnak
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_medis_ralan_anak';

    // Page object name
    public $PageObjName = "PenilaianMedisRalanAnakEdit";

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

        // Table object (penilaian_medis_ralan_anak)
        if (!isset($GLOBALS["penilaian_medis_ralan_anak"]) || get_class($GLOBALS["penilaian_medis_ralan_anak"]) == PROJECT_NAMESPACE . "penilaian_medis_ralan_anak") {
            $GLOBALS["penilaian_medis_ralan_anak"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "PenilaianMedisRalanAnakView") {
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
        $this->id_penilaian_medis_ralan_anak->setVisibility();
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->kd_dokter->setVisibility();
        $this->anamnesis->setVisibility();
        $this->hubungan->setVisibility();
        $this->keluhan_utama->setVisibility();
        $this->rps->setVisibility();
        $this->rpd->setVisibility();
        $this->rpk->setVisibility();
        $this->rpo->setVisibility();
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
        $this->ket_fisik->setVisibility();
        $this->ket_lokalis->setVisibility();
        $this->penunjang->setVisibility();
        $this->diagnosis->setVisibility();
        $this->tata->setVisibility();
        $this->konsul->setVisibility();
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
            if (($keyValue = Get("id_penilaian_medis_ralan_anak") ?? Key(0) ?? Route(2)) !== null) {
                $this->id_penilaian_medis_ralan_anak->setQueryStringValue($keyValue);
                $this->id_penilaian_medis_ralan_anak->setOldValue($this->id_penilaian_medis_ralan_anak->QueryStringValue);
            } elseif (Post("id_penilaian_medis_ralan_anak") !== null) {
                $this->id_penilaian_medis_ralan_anak->setFormValue(Post("id_penilaian_medis_ralan_anak"));
                $this->id_penilaian_medis_ralan_anak->setOldValue($this->id_penilaian_medis_ralan_anak->FormValue);
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
                if (($keyValue = Get("id_penilaian_medis_ralan_anak") ?? Route("id_penilaian_medis_ralan_anak")) !== null) {
                    $this->id_penilaian_medis_ralan_anak->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id_penilaian_medis_ralan_anak->CurrentValue = null;
                }
            }

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
                    $this->terminate("PenilaianMedisRalanAnakList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "PenilaianMedisRalanAnakList") {
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

        // Check field name 'id_penilaian_medis_ralan_anak' first before field var 'x_id_penilaian_medis_ralan_anak'
        $val = $CurrentForm->hasValue("id_penilaian_medis_ralan_anak") ? $CurrentForm->getValue("id_penilaian_medis_ralan_anak") : $CurrentForm->getValue("x_id_penilaian_medis_ralan_anak");
        if (!$this->id_penilaian_medis_ralan_anak->IsDetailKey) {
            $this->id_penilaian_medis_ralan_anak->setFormValue($val);
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

        // Check field name 'hubungan' first before field var 'x_hubungan'
        $val = $CurrentForm->hasValue("hubungan") ? $CurrentForm->getValue("hubungan") : $CurrentForm->getValue("x_hubungan");
        if (!$this->hubungan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hubungan->Visible = false; // Disable update for API request
            } else {
                $this->hubungan->setFormValue($val);
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

        // Check field name 'rps' first before field var 'x_rps'
        $val = $CurrentForm->hasValue("rps") ? $CurrentForm->getValue("rps") : $CurrentForm->getValue("x_rps");
        if (!$this->rps->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rps->Visible = false; // Disable update for API request
            } else {
                $this->rps->setFormValue($val);
            }
        }

        // Check field name 'rpd' first before field var 'x_rpd'
        $val = $CurrentForm->hasValue("rpd") ? $CurrentForm->getValue("rpd") : $CurrentForm->getValue("x_rpd");
        if (!$this->rpd->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpd->Visible = false; // Disable update for API request
            } else {
                $this->rpd->setFormValue($val);
            }
        }

        // Check field name 'rpk' first before field var 'x_rpk'
        $val = $CurrentForm->hasValue("rpk") ? $CurrentForm->getValue("rpk") : $CurrentForm->getValue("x_rpk");
        if (!$this->rpk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpk->Visible = false; // Disable update for API request
            } else {
                $this->rpk->setFormValue($val);
            }
        }

        // Check field name 'rpo' first before field var 'x_rpo'
        $val = $CurrentForm->hasValue("rpo") ? $CurrentForm->getValue("rpo") : $CurrentForm->getValue("x_rpo");
        if (!$this->rpo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo->Visible = false; // Disable update for API request
            } else {
                $this->rpo->setFormValue($val);
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

        // Check field name 'spo' first before field var 'x_spo'
        $val = $CurrentForm->hasValue("spo") ? $CurrentForm->getValue("spo") : $CurrentForm->getValue("x_spo");
        if (!$this->spo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->spo->Visible = false; // Disable update for API request
            } else {
                $this->spo->setFormValue($val);
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

        // Check field name 'kepala' first before field var 'x_kepala'
        $val = $CurrentForm->hasValue("kepala") ? $CurrentForm->getValue("kepala") : $CurrentForm->getValue("x_kepala");
        if (!$this->kepala->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kepala->Visible = false; // Disable update for API request
            } else {
                $this->kepala->setFormValue($val);
            }
        }

        // Check field name 'mata' first before field var 'x_mata'
        $val = $CurrentForm->hasValue("mata") ? $CurrentForm->getValue("mata") : $CurrentForm->getValue("x_mata");
        if (!$this->mata->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mata->Visible = false; // Disable update for API request
            } else {
                $this->mata->setFormValue($val);
            }
        }

        // Check field name 'gigi' first before field var 'x_gigi'
        $val = $CurrentForm->hasValue("gigi") ? $CurrentForm->getValue("gigi") : $CurrentForm->getValue("x_gigi");
        if (!$this->gigi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gigi->Visible = false; // Disable update for API request
            } else {
                $this->gigi->setFormValue($val);
            }
        }

        // Check field name 'tht' first before field var 'x_tht'
        $val = $CurrentForm->hasValue("tht") ? $CurrentForm->getValue("tht") : $CurrentForm->getValue("x_tht");
        if (!$this->tht->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tht->Visible = false; // Disable update for API request
            } else {
                $this->tht->setFormValue($val);
            }
        }

        // Check field name 'thoraks' first before field var 'x_thoraks'
        $val = $CurrentForm->hasValue("thoraks") ? $CurrentForm->getValue("thoraks") : $CurrentForm->getValue("x_thoraks");
        if (!$this->thoraks->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->thoraks->Visible = false; // Disable update for API request
            } else {
                $this->thoraks->setFormValue($val);
            }
        }

        // Check field name 'abdomen' first before field var 'x_abdomen'
        $val = $CurrentForm->hasValue("abdomen") ? $CurrentForm->getValue("abdomen") : $CurrentForm->getValue("x_abdomen");
        if (!$this->abdomen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->abdomen->Visible = false; // Disable update for API request
            } else {
                $this->abdomen->setFormValue($val);
            }
        }

        // Check field name 'genital' first before field var 'x_genital'
        $val = $CurrentForm->hasValue("genital") ? $CurrentForm->getValue("genital") : $CurrentForm->getValue("x_genital");
        if (!$this->genital->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->genital->Visible = false; // Disable update for API request
            } else {
                $this->genital->setFormValue($val);
            }
        }

        // Check field name 'ekstremitas' first before field var 'x_ekstremitas'
        $val = $CurrentForm->hasValue("ekstremitas") ? $CurrentForm->getValue("ekstremitas") : $CurrentForm->getValue("x_ekstremitas");
        if (!$this->ekstremitas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ekstremitas->Visible = false; // Disable update for API request
            } else {
                $this->ekstremitas->setFormValue($val);
            }
        }

        // Check field name 'kulit' first before field var 'x_kulit'
        $val = $CurrentForm->hasValue("kulit") ? $CurrentForm->getValue("kulit") : $CurrentForm->getValue("x_kulit");
        if (!$this->kulit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kulit->Visible = false; // Disable update for API request
            } else {
                $this->kulit->setFormValue($val);
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

        // Check field name 'ket_lokalis' first before field var 'x_ket_lokalis'
        $val = $CurrentForm->hasValue("ket_lokalis") ? $CurrentForm->getValue("ket_lokalis") : $CurrentForm->getValue("x_ket_lokalis");
        if (!$this->ket_lokalis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_lokalis->Visible = false; // Disable update for API request
            } else {
                $this->ket_lokalis->setFormValue($val);
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

        // Check field name 'tata' first before field var 'x_tata'
        $val = $CurrentForm->hasValue("tata") ? $CurrentForm->getValue("tata") : $CurrentForm->getValue("x_tata");
        if (!$this->tata->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tata->Visible = false; // Disable update for API request
            } else {
                $this->tata->setFormValue($val);
            }
        }

        // Check field name 'konsul' first before field var 'x_konsul'
        $val = $CurrentForm->hasValue("konsul") ? $CurrentForm->getValue("konsul") : $CurrentForm->getValue("x_konsul");
        if (!$this->konsul->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->konsul->Visible = false; // Disable update for API request
            } else {
                $this->konsul->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id_penilaian_medis_ralan_anak->CurrentValue = $this->id_penilaian_medis_ralan_anak->FormValue;
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->tanggal->CurrentValue = $this->tanggal->FormValue;
        $this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
        $this->kd_dokter->CurrentValue = $this->kd_dokter->FormValue;
        $this->anamnesis->CurrentValue = $this->anamnesis->FormValue;
        $this->hubungan->CurrentValue = $this->hubungan->FormValue;
        $this->keluhan_utama->CurrentValue = $this->keluhan_utama->FormValue;
        $this->rps->CurrentValue = $this->rps->FormValue;
        $this->rpd->CurrentValue = $this->rpd->FormValue;
        $this->rpk->CurrentValue = $this->rpk->FormValue;
        $this->rpo->CurrentValue = $this->rpo->FormValue;
        $this->alergi->CurrentValue = $this->alergi->FormValue;
        $this->keadaan->CurrentValue = $this->keadaan->FormValue;
        $this->gcs->CurrentValue = $this->gcs->FormValue;
        $this->kesadaran->CurrentValue = $this->kesadaran->FormValue;
        $this->td->CurrentValue = $this->td->FormValue;
        $this->nadi->CurrentValue = $this->nadi->FormValue;
        $this->rr->CurrentValue = $this->rr->FormValue;
        $this->suhu->CurrentValue = $this->suhu->FormValue;
        $this->spo->CurrentValue = $this->spo->FormValue;
        $this->bb->CurrentValue = $this->bb->FormValue;
        $this->tb->CurrentValue = $this->tb->FormValue;
        $this->kepala->CurrentValue = $this->kepala->FormValue;
        $this->mata->CurrentValue = $this->mata->FormValue;
        $this->gigi->CurrentValue = $this->gigi->FormValue;
        $this->tht->CurrentValue = $this->tht->FormValue;
        $this->thoraks->CurrentValue = $this->thoraks->FormValue;
        $this->abdomen->CurrentValue = $this->abdomen->FormValue;
        $this->genital->CurrentValue = $this->genital->FormValue;
        $this->ekstremitas->CurrentValue = $this->ekstremitas->FormValue;
        $this->kulit->CurrentValue = $this->kulit->FormValue;
        $this->ket_fisik->CurrentValue = $this->ket_fisik->FormValue;
        $this->ket_lokalis->CurrentValue = $this->ket_lokalis->FormValue;
        $this->penunjang->CurrentValue = $this->penunjang->FormValue;
        $this->diagnosis->CurrentValue = $this->diagnosis->FormValue;
        $this->tata->CurrentValue = $this->tata->FormValue;
        $this->konsul->CurrentValue = $this->konsul->FormValue;
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

            // konsul
            $this->konsul->ViewValue = $this->konsul->CurrentValue;
            $this->konsul->ViewCustomAttributes = "";

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

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";
            $this->keluhan_utama->TooltipValue = "";

            // rps
            $this->rps->LinkCustomAttributes = "";
            $this->rps->HrefValue = "";
            $this->rps->TooltipValue = "";

            // rpd
            $this->rpd->LinkCustomAttributes = "";
            $this->rpd->HrefValue = "";
            $this->rpd->TooltipValue = "";

            // rpk
            $this->rpk->LinkCustomAttributes = "";
            $this->rpk->HrefValue = "";
            $this->rpk->TooltipValue = "";

            // rpo
            $this->rpo->LinkCustomAttributes = "";
            $this->rpo->HrefValue = "";
            $this->rpo->TooltipValue = "";

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

            // ket_fisik
            $this->ket_fisik->LinkCustomAttributes = "";
            $this->ket_fisik->HrefValue = "";
            $this->ket_fisik->TooltipValue = "";

            // ket_lokalis
            $this->ket_lokalis->LinkCustomAttributes = "";
            $this->ket_lokalis->HrefValue = "";
            $this->ket_lokalis->TooltipValue = "";

            // penunjang
            $this->penunjang->LinkCustomAttributes = "";
            $this->penunjang->HrefValue = "";
            $this->penunjang->TooltipValue = "";

            // diagnosis
            $this->diagnosis->LinkCustomAttributes = "";
            $this->diagnosis->HrefValue = "";
            $this->diagnosis->TooltipValue = "";

            // tata
            $this->tata->LinkCustomAttributes = "";
            $this->tata->HrefValue = "";
            $this->tata->TooltipValue = "";

            // konsul
            $this->konsul->LinkCustomAttributes = "";
            $this->konsul->HrefValue = "";
            $this->konsul->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id_penilaian_medis_ralan_anak
            $this->id_penilaian_medis_ralan_anak->EditAttrs["class"] = "form-control";
            $this->id_penilaian_medis_ralan_anak->EditCustomAttributes = "";
            $this->id_penilaian_medis_ralan_anak->EditValue = $this->id_penilaian_medis_ralan_anak->CurrentValue;
            $this->id_penilaian_medis_ralan_anak->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->EditAttrs["class"] = "form-control";
            $this->no_rawat->EditCustomAttributes = "";
            if (!$this->no_rawat->Raw) {
                $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
            }
            $this->no_rawat->EditValue = HtmlEncode($this->no_rawat->CurrentValue);
            $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());

            // tanggal
            $this->tanggal->EditAttrs["class"] = "form-control";
            $this->tanggal->EditCustomAttributes = "";
            $this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
            $this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

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

            // hubungan
            $this->hubungan->EditAttrs["class"] = "form-control";
            $this->hubungan->EditCustomAttributes = "";
            if (!$this->hubungan->Raw) {
                $this->hubungan->CurrentValue = HtmlDecode($this->hubungan->CurrentValue);
            }
            $this->hubungan->EditValue = HtmlEncode($this->hubungan->CurrentValue);
            $this->hubungan->PlaceHolder = RemoveHtml($this->hubungan->caption());

            // keluhan_utama
            $this->keluhan_utama->EditAttrs["class"] = "form-control";
            $this->keluhan_utama->EditCustomAttributes = "";
            $this->keluhan_utama->EditValue = HtmlEncode($this->keluhan_utama->CurrentValue);
            $this->keluhan_utama->PlaceHolder = RemoveHtml($this->keluhan_utama->caption());

            // rps
            $this->rps->EditAttrs["class"] = "form-control";
            $this->rps->EditCustomAttributes = "";
            $this->rps->EditValue = HtmlEncode($this->rps->CurrentValue);
            $this->rps->PlaceHolder = RemoveHtml($this->rps->caption());

            // rpd
            $this->rpd->EditAttrs["class"] = "form-control";
            $this->rpd->EditCustomAttributes = "";
            $this->rpd->EditValue = HtmlEncode($this->rpd->CurrentValue);
            $this->rpd->PlaceHolder = RemoveHtml($this->rpd->caption());

            // rpk
            $this->rpk->EditAttrs["class"] = "form-control";
            $this->rpk->EditCustomAttributes = "";
            $this->rpk->EditValue = HtmlEncode($this->rpk->CurrentValue);
            $this->rpk->PlaceHolder = RemoveHtml($this->rpk->caption());

            // rpo
            $this->rpo->EditAttrs["class"] = "form-control";
            $this->rpo->EditCustomAttributes = "";
            $this->rpo->EditValue = HtmlEncode($this->rpo->CurrentValue);
            $this->rpo->PlaceHolder = RemoveHtml($this->rpo->caption());

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

            // spo
            $this->spo->EditAttrs["class"] = "form-control";
            $this->spo->EditCustomAttributes = "";
            if (!$this->spo->Raw) {
                $this->spo->CurrentValue = HtmlDecode($this->spo->CurrentValue);
            }
            $this->spo->EditValue = HtmlEncode($this->spo->CurrentValue);
            $this->spo->PlaceHolder = RemoveHtml($this->spo->caption());

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

            // kepala
            $this->kepala->EditCustomAttributes = "";
            $this->kepala->EditValue = $this->kepala->options(false);
            $this->kepala->PlaceHolder = RemoveHtml($this->kepala->caption());

            // mata
            $this->mata->EditCustomAttributes = "";
            $this->mata->EditValue = $this->mata->options(false);
            $this->mata->PlaceHolder = RemoveHtml($this->mata->caption());

            // gigi
            $this->gigi->EditCustomAttributes = "";
            $this->gigi->EditValue = $this->gigi->options(false);
            $this->gigi->PlaceHolder = RemoveHtml($this->gigi->caption());

            // tht
            $this->tht->EditCustomAttributes = "";
            $this->tht->EditValue = $this->tht->options(false);
            $this->tht->PlaceHolder = RemoveHtml($this->tht->caption());

            // thoraks
            $this->thoraks->EditCustomAttributes = "";
            $this->thoraks->EditValue = $this->thoraks->options(false);
            $this->thoraks->PlaceHolder = RemoveHtml($this->thoraks->caption());

            // abdomen
            $this->abdomen->EditCustomAttributes = "";
            $this->abdomen->EditValue = $this->abdomen->options(false);
            $this->abdomen->PlaceHolder = RemoveHtml($this->abdomen->caption());

            // genital
            $this->genital->EditCustomAttributes = "";
            $this->genital->EditValue = $this->genital->options(false);
            $this->genital->PlaceHolder = RemoveHtml($this->genital->caption());

            // ekstremitas
            $this->ekstremitas->EditCustomAttributes = "";
            $this->ekstremitas->EditValue = $this->ekstremitas->options(false);
            $this->ekstremitas->PlaceHolder = RemoveHtml($this->ekstremitas->caption());

            // kulit
            $this->kulit->EditCustomAttributes = "";
            $this->kulit->EditValue = $this->kulit->options(false);
            $this->kulit->PlaceHolder = RemoveHtml($this->kulit->caption());

            // ket_fisik
            $this->ket_fisik->EditAttrs["class"] = "form-control";
            $this->ket_fisik->EditCustomAttributes = "";
            $this->ket_fisik->EditValue = HtmlEncode($this->ket_fisik->CurrentValue);
            $this->ket_fisik->PlaceHolder = RemoveHtml($this->ket_fisik->caption());

            // ket_lokalis
            $this->ket_lokalis->EditAttrs["class"] = "form-control";
            $this->ket_lokalis->EditCustomAttributes = "";
            $this->ket_lokalis->EditValue = HtmlEncode($this->ket_lokalis->CurrentValue);
            $this->ket_lokalis->PlaceHolder = RemoveHtml($this->ket_lokalis->caption());

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

            // tata
            $this->tata->EditAttrs["class"] = "form-control";
            $this->tata->EditCustomAttributes = "";
            $this->tata->EditValue = HtmlEncode($this->tata->CurrentValue);
            $this->tata->PlaceHolder = RemoveHtml($this->tata->caption());

            // konsul
            $this->konsul->EditAttrs["class"] = "form-control";
            $this->konsul->EditCustomAttributes = "";
            $this->konsul->EditValue = HtmlEncode($this->konsul->CurrentValue);
            $this->konsul->PlaceHolder = RemoveHtml($this->konsul->caption());

            // Edit refer script

            // id_penilaian_medis_ralan_anak
            $this->id_penilaian_medis_ralan_anak->LinkCustomAttributes = "";
            $this->id_penilaian_medis_ralan_anak->HrefValue = "";

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

            // hubungan
            $this->hubungan->LinkCustomAttributes = "";
            $this->hubungan->HrefValue = "";

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";

            // rps
            $this->rps->LinkCustomAttributes = "";
            $this->rps->HrefValue = "";

            // rpd
            $this->rpd->LinkCustomAttributes = "";
            $this->rpd->HrefValue = "";

            // rpk
            $this->rpk->LinkCustomAttributes = "";
            $this->rpk->HrefValue = "";

            // rpo
            $this->rpo->LinkCustomAttributes = "";
            $this->rpo->HrefValue = "";

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

            // spo
            $this->spo->LinkCustomAttributes = "";
            $this->spo->HrefValue = "";

            // bb
            $this->bb->LinkCustomAttributes = "";
            $this->bb->HrefValue = "";

            // tb
            $this->tb->LinkCustomAttributes = "";
            $this->tb->HrefValue = "";

            // kepala
            $this->kepala->LinkCustomAttributes = "";
            $this->kepala->HrefValue = "";

            // mata
            $this->mata->LinkCustomAttributes = "";
            $this->mata->HrefValue = "";

            // gigi
            $this->gigi->LinkCustomAttributes = "";
            $this->gigi->HrefValue = "";

            // tht
            $this->tht->LinkCustomAttributes = "";
            $this->tht->HrefValue = "";

            // thoraks
            $this->thoraks->LinkCustomAttributes = "";
            $this->thoraks->HrefValue = "";

            // abdomen
            $this->abdomen->LinkCustomAttributes = "";
            $this->abdomen->HrefValue = "";

            // genital
            $this->genital->LinkCustomAttributes = "";
            $this->genital->HrefValue = "";

            // ekstremitas
            $this->ekstremitas->LinkCustomAttributes = "";
            $this->ekstremitas->HrefValue = "";

            // kulit
            $this->kulit->LinkCustomAttributes = "";
            $this->kulit->HrefValue = "";

            // ket_fisik
            $this->ket_fisik->LinkCustomAttributes = "";
            $this->ket_fisik->HrefValue = "";

            // ket_lokalis
            $this->ket_lokalis->LinkCustomAttributes = "";
            $this->ket_lokalis->HrefValue = "";

            // penunjang
            $this->penunjang->LinkCustomAttributes = "";
            $this->penunjang->HrefValue = "";

            // diagnosis
            $this->diagnosis->LinkCustomAttributes = "";
            $this->diagnosis->HrefValue = "";

            // tata
            $this->tata->LinkCustomAttributes = "";
            $this->tata->HrefValue = "";

            // konsul
            $this->konsul->LinkCustomAttributes = "";
            $this->konsul->HrefValue = "";
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
        if ($this->id_penilaian_medis_ralan_anak->Required) {
            if (!$this->id_penilaian_medis_ralan_anak->IsDetailKey && EmptyValue($this->id_penilaian_medis_ralan_anak->FormValue)) {
                $this->id_penilaian_medis_ralan_anak->addErrorMessage(str_replace("%s", $this->id_penilaian_medis_ralan_anak->caption(), $this->id_penilaian_medis_ralan_anak->RequiredErrorMessage));
            }
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
        if ($this->hubungan->Required) {
            if (!$this->hubungan->IsDetailKey && EmptyValue($this->hubungan->FormValue)) {
                $this->hubungan->addErrorMessage(str_replace("%s", $this->hubungan->caption(), $this->hubungan->RequiredErrorMessage));
            }
        }
        if ($this->keluhan_utama->Required) {
            if (!$this->keluhan_utama->IsDetailKey && EmptyValue($this->keluhan_utama->FormValue)) {
                $this->keluhan_utama->addErrorMessage(str_replace("%s", $this->keluhan_utama->caption(), $this->keluhan_utama->RequiredErrorMessage));
            }
        }
        if ($this->rps->Required) {
            if (!$this->rps->IsDetailKey && EmptyValue($this->rps->FormValue)) {
                $this->rps->addErrorMessage(str_replace("%s", $this->rps->caption(), $this->rps->RequiredErrorMessage));
            }
        }
        if ($this->rpd->Required) {
            if (!$this->rpd->IsDetailKey && EmptyValue($this->rpd->FormValue)) {
                $this->rpd->addErrorMessage(str_replace("%s", $this->rpd->caption(), $this->rpd->RequiredErrorMessage));
            }
        }
        if ($this->rpk->Required) {
            if (!$this->rpk->IsDetailKey && EmptyValue($this->rpk->FormValue)) {
                $this->rpk->addErrorMessage(str_replace("%s", $this->rpk->caption(), $this->rpk->RequiredErrorMessage));
            }
        }
        if ($this->rpo->Required) {
            if (!$this->rpo->IsDetailKey && EmptyValue($this->rpo->FormValue)) {
                $this->rpo->addErrorMessage(str_replace("%s", $this->rpo->caption(), $this->rpo->RequiredErrorMessage));
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
        if ($this->spo->Required) {
            if (!$this->spo->IsDetailKey && EmptyValue($this->spo->FormValue)) {
                $this->spo->addErrorMessage(str_replace("%s", $this->spo->caption(), $this->spo->RequiredErrorMessage));
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
        if ($this->kepala->Required) {
            if ($this->kepala->FormValue == "") {
                $this->kepala->addErrorMessage(str_replace("%s", $this->kepala->caption(), $this->kepala->RequiredErrorMessage));
            }
        }
        if ($this->mata->Required) {
            if ($this->mata->FormValue == "") {
                $this->mata->addErrorMessage(str_replace("%s", $this->mata->caption(), $this->mata->RequiredErrorMessage));
            }
        }
        if ($this->gigi->Required) {
            if ($this->gigi->FormValue == "") {
                $this->gigi->addErrorMessage(str_replace("%s", $this->gigi->caption(), $this->gigi->RequiredErrorMessage));
            }
        }
        if ($this->tht->Required) {
            if ($this->tht->FormValue == "") {
                $this->tht->addErrorMessage(str_replace("%s", $this->tht->caption(), $this->tht->RequiredErrorMessage));
            }
        }
        if ($this->thoraks->Required) {
            if ($this->thoraks->FormValue == "") {
                $this->thoraks->addErrorMessage(str_replace("%s", $this->thoraks->caption(), $this->thoraks->RequiredErrorMessage));
            }
        }
        if ($this->abdomen->Required) {
            if ($this->abdomen->FormValue == "") {
                $this->abdomen->addErrorMessage(str_replace("%s", $this->abdomen->caption(), $this->abdomen->RequiredErrorMessage));
            }
        }
        if ($this->genital->Required) {
            if ($this->genital->FormValue == "") {
                $this->genital->addErrorMessage(str_replace("%s", $this->genital->caption(), $this->genital->RequiredErrorMessage));
            }
        }
        if ($this->ekstremitas->Required) {
            if ($this->ekstremitas->FormValue == "") {
                $this->ekstremitas->addErrorMessage(str_replace("%s", $this->ekstremitas->caption(), $this->ekstremitas->RequiredErrorMessage));
            }
        }
        if ($this->kulit->Required) {
            if ($this->kulit->FormValue == "") {
                $this->kulit->addErrorMessage(str_replace("%s", $this->kulit->caption(), $this->kulit->RequiredErrorMessage));
            }
        }
        if ($this->ket_fisik->Required) {
            if (!$this->ket_fisik->IsDetailKey && EmptyValue($this->ket_fisik->FormValue)) {
                $this->ket_fisik->addErrorMessage(str_replace("%s", $this->ket_fisik->caption(), $this->ket_fisik->RequiredErrorMessage));
            }
        }
        if ($this->ket_lokalis->Required) {
            if (!$this->ket_lokalis->IsDetailKey && EmptyValue($this->ket_lokalis->FormValue)) {
                $this->ket_lokalis->addErrorMessage(str_replace("%s", $this->ket_lokalis->caption(), $this->ket_lokalis->RequiredErrorMessage));
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
        if ($this->tata->Required) {
            if (!$this->tata->IsDetailKey && EmptyValue($this->tata->FormValue)) {
                $this->tata->addErrorMessage(str_replace("%s", $this->tata->caption(), $this->tata->RequiredErrorMessage));
            }
        }
        if ($this->konsul->Required) {
            if (!$this->konsul->IsDetailKey && EmptyValue($this->konsul->FormValue)) {
                $this->konsul->addErrorMessage(str_replace("%s", $this->konsul->caption(), $this->konsul->RequiredErrorMessage));
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
            $this->no_rawat->setDbValueDef($rsnew, $this->no_rawat->CurrentValue, "", $this->no_rawat->ReadOnly);

            // tanggal
            $this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), CurrentDate(), $this->tanggal->ReadOnly);

            // kd_dokter
            $this->kd_dokter->setDbValueDef($rsnew, $this->kd_dokter->CurrentValue, "", $this->kd_dokter->ReadOnly);

            // anamnesis
            $this->anamnesis->setDbValueDef($rsnew, $this->anamnesis->CurrentValue, "", $this->anamnesis->ReadOnly);

            // hubungan
            $this->hubungan->setDbValueDef($rsnew, $this->hubungan->CurrentValue, "", $this->hubungan->ReadOnly);

            // keluhan_utama
            $this->keluhan_utama->setDbValueDef($rsnew, $this->keluhan_utama->CurrentValue, "", $this->keluhan_utama->ReadOnly);

            // rps
            $this->rps->setDbValueDef($rsnew, $this->rps->CurrentValue, "", $this->rps->ReadOnly);

            // rpd
            $this->rpd->setDbValueDef($rsnew, $this->rpd->CurrentValue, "", $this->rpd->ReadOnly);

            // rpk
            $this->rpk->setDbValueDef($rsnew, $this->rpk->CurrentValue, "", $this->rpk->ReadOnly);

            // rpo
            $this->rpo->setDbValueDef($rsnew, $this->rpo->CurrentValue, "", $this->rpo->ReadOnly);

            // alergi
            $this->alergi->setDbValueDef($rsnew, $this->alergi->CurrentValue, "", $this->alergi->ReadOnly);

            // keadaan
            $this->keadaan->setDbValueDef($rsnew, $this->keadaan->CurrentValue, "", $this->keadaan->ReadOnly);

            // gcs
            $this->gcs->setDbValueDef($rsnew, $this->gcs->CurrentValue, "", $this->gcs->ReadOnly);

            // kesadaran
            $this->kesadaran->setDbValueDef($rsnew, $this->kesadaran->CurrentValue, "", $this->kesadaran->ReadOnly);

            // td
            $this->td->setDbValueDef($rsnew, $this->td->CurrentValue, "", $this->td->ReadOnly);

            // nadi
            $this->nadi->setDbValueDef($rsnew, $this->nadi->CurrentValue, "", $this->nadi->ReadOnly);

            // rr
            $this->rr->setDbValueDef($rsnew, $this->rr->CurrentValue, "", $this->rr->ReadOnly);

            // suhu
            $this->suhu->setDbValueDef($rsnew, $this->suhu->CurrentValue, "", $this->suhu->ReadOnly);

            // spo
            $this->spo->setDbValueDef($rsnew, $this->spo->CurrentValue, "", $this->spo->ReadOnly);

            // bb
            $this->bb->setDbValueDef($rsnew, $this->bb->CurrentValue, "", $this->bb->ReadOnly);

            // tb
            $this->tb->setDbValueDef($rsnew, $this->tb->CurrentValue, "", $this->tb->ReadOnly);

            // kepala
            $this->kepala->setDbValueDef($rsnew, $this->kepala->CurrentValue, "", $this->kepala->ReadOnly);

            // mata
            $this->mata->setDbValueDef($rsnew, $this->mata->CurrentValue, "", $this->mata->ReadOnly);

            // gigi
            $this->gigi->setDbValueDef($rsnew, $this->gigi->CurrentValue, "", $this->gigi->ReadOnly);

            // tht
            $this->tht->setDbValueDef($rsnew, $this->tht->CurrentValue, "", $this->tht->ReadOnly);

            // thoraks
            $this->thoraks->setDbValueDef($rsnew, $this->thoraks->CurrentValue, "", $this->thoraks->ReadOnly);

            // abdomen
            $this->abdomen->setDbValueDef($rsnew, $this->abdomen->CurrentValue, "", $this->abdomen->ReadOnly);

            // genital
            $this->genital->setDbValueDef($rsnew, $this->genital->CurrentValue, "", $this->genital->ReadOnly);

            // ekstremitas
            $this->ekstremitas->setDbValueDef($rsnew, $this->ekstremitas->CurrentValue, "", $this->ekstremitas->ReadOnly);

            // kulit
            $this->kulit->setDbValueDef($rsnew, $this->kulit->CurrentValue, "", $this->kulit->ReadOnly);

            // ket_fisik
            $this->ket_fisik->setDbValueDef($rsnew, $this->ket_fisik->CurrentValue, "", $this->ket_fisik->ReadOnly);

            // ket_lokalis
            $this->ket_lokalis->setDbValueDef($rsnew, $this->ket_lokalis->CurrentValue, "", $this->ket_lokalis->ReadOnly);

            // penunjang
            $this->penunjang->setDbValueDef($rsnew, $this->penunjang->CurrentValue, "", $this->penunjang->ReadOnly);

            // diagnosis
            $this->diagnosis->setDbValueDef($rsnew, $this->diagnosis->CurrentValue, "", $this->diagnosis->ReadOnly);

            // tata
            $this->tata->setDbValueDef($rsnew, $this->tata->CurrentValue, "", $this->tata->ReadOnly);

            // konsul
            $this->konsul->setDbValueDef($rsnew, $this->konsul->CurrentValue, "", $this->konsul->ReadOnly);

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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PenilaianMedisRalanAnakList"), "", $this->TableVar, true);
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
}
