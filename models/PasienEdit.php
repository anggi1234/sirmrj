<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienEdit extends Pasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pasien';

    // Page object name
    public $PageObjName = "PasienEdit";

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

        // Table object (pasien)
        if (!isset($GLOBALS["pasien"]) || get_class($GLOBALS["pasien"]) == PROJECT_NAMESPACE . "pasien") {
            $GLOBALS["pasien"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pasien');
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
                $doc = new $class(Container("pasien"));
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
                    if ($pageName == "PasienView") {
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
        $this->id_pasien->Visible = false;
        $this->no_rkm_medis->setVisibility();
        $this->nm_pasien->setVisibility();
        $this->no_ktp->setVisibility();
        $this->jk->setVisibility();
        $this->tmp_lahir->setVisibility();
        $this->tgl_lahir->setVisibility();
        $this->nm_ibu->setVisibility();
        $this->alamat->setVisibility();
        $this->gol_darah->setVisibility();
        $this->pekerjaan->setVisibility();
        $this->stts_nikah->setVisibility();
        $this->agama->setVisibility();
        $this->tgl_daftar->setVisibility();
        $this->no_tlp->Visible = false;
        $this->umur->Visible = false;
        $this->pnd->setVisibility();
        $this->keluarga->Visible = false;
        $this->namakeluarga->Visible = false;
        $this->kd_pj->setVisibility();
        $this->no_peserta->setVisibility();
        $this->kd_kel->setVisibility();
        $this->kd_kec->setVisibility();
        $this->kd_kab->setVisibility();
        $this->kd_prop->setVisibility();
        $this->pekerjaanpj->Visible = false;
        $this->alamatpj->Visible = false;
        $this->kelurahanpj->Visible = false;
        $this->kecamatanpj->Visible = false;
        $this->kabupatenpj->Visible = false;
        $this->perusahaan_pasien->Visible = false;
        $this->suku_bangsa->setVisibility();
        $this->bahasa_pasien->setVisibility();
        $this->cacat_fisik->setVisibility();
        $this->_email->Visible = false;
        $this->nip->Visible = false;
        $this->propinsipj->Visible = false;
        $this->hideFieldsForAddEdit();
        $this->kd_prop->Required = false;

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->agama);
        $this->setupLookupOptions($this->kd_pj);
        $this->setupLookupOptions($this->kd_kel);
        $this->setupLookupOptions($this->kd_kec);
        $this->setupLookupOptions($this->kd_kab);
        $this->setupLookupOptions($this->kd_prop);
        $this->setupLookupOptions($this->perusahaan_pasien);
        $this->setupLookupOptions($this->suku_bangsa);
        $this->setupLookupOptions($this->bahasa_pasien);
        $this->setupLookupOptions($this->cacat_fisik);

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
            if (($keyValue = Get("id_pasien") ?? Key(0) ?? Route(2)) !== null) {
                $this->id_pasien->setQueryStringValue($keyValue);
                $this->id_pasien->setOldValue($this->id_pasien->QueryStringValue);
            } elseif (Post("id_pasien") !== null) {
                $this->id_pasien->setFormValue(Post("id_pasien"));
                $this->id_pasien->setOldValue($this->id_pasien->FormValue);
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
                if (($keyValue = Get("id_pasien") ?? Route("id_pasien")) !== null) {
                    $this->id_pasien->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id_pasien->CurrentValue = null;
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
                    $this->terminate("PasienList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->GetViewUrl();
                if (GetPageName($returnUrl) == "PasienList") {
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

        // Check field name 'no_rkm_medis' first before field var 'x_no_rkm_medis'
        $val = $CurrentForm->hasValue("no_rkm_medis") ? $CurrentForm->getValue("no_rkm_medis") : $CurrentForm->getValue("x_no_rkm_medis");
        if (!$this->no_rkm_medis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rkm_medis->Visible = false; // Disable update for API request
            } else {
                $this->no_rkm_medis->setFormValue($val);
            }
        }

        // Check field name 'nm_pasien' first before field var 'x_nm_pasien'
        $val = $CurrentForm->hasValue("nm_pasien") ? $CurrentForm->getValue("nm_pasien") : $CurrentForm->getValue("x_nm_pasien");
        if (!$this->nm_pasien->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nm_pasien->Visible = false; // Disable update for API request
            } else {
                $this->nm_pasien->setFormValue($val);
            }
        }

        // Check field name 'no_ktp' first before field var 'x_no_ktp'
        $val = $CurrentForm->hasValue("no_ktp") ? $CurrentForm->getValue("no_ktp") : $CurrentForm->getValue("x_no_ktp");
        if (!$this->no_ktp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_ktp->Visible = false; // Disable update for API request
            } else {
                $this->no_ktp->setFormValue($val);
            }
        }

        // Check field name 'jk' first before field var 'x_jk'
        $val = $CurrentForm->hasValue("jk") ? $CurrentForm->getValue("jk") : $CurrentForm->getValue("x_jk");
        if (!$this->jk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jk->Visible = false; // Disable update for API request
            } else {
                $this->jk->setFormValue($val);
            }
        }

        // Check field name 'tmp_lahir' first before field var 'x_tmp_lahir'
        $val = $CurrentForm->hasValue("tmp_lahir") ? $CurrentForm->getValue("tmp_lahir") : $CurrentForm->getValue("x_tmp_lahir");
        if (!$this->tmp_lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tmp_lahir->Visible = false; // Disable update for API request
            } else {
                $this->tmp_lahir->setFormValue($val);
            }
        }

        // Check field name 'tgl_lahir' first before field var 'x_tgl_lahir'
        $val = $CurrentForm->hasValue("tgl_lahir") ? $CurrentForm->getValue("tgl_lahir") : $CurrentForm->getValue("x_tgl_lahir");
        if (!$this->tgl_lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_lahir->Visible = false; // Disable update for API request
            } else {
                $this->tgl_lahir->setFormValue($val);
            }
            $this->tgl_lahir->CurrentValue = UnFormatDateTime($this->tgl_lahir->CurrentValue, 7);
        }

        // Check field name 'nm_ibu' first before field var 'x_nm_ibu'
        $val = $CurrentForm->hasValue("nm_ibu") ? $CurrentForm->getValue("nm_ibu") : $CurrentForm->getValue("x_nm_ibu");
        if (!$this->nm_ibu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nm_ibu->Visible = false; // Disable update for API request
            } else {
                $this->nm_ibu->setFormValue($val);
            }
        }

        // Check field name 'alamat' first before field var 'x_alamat'
        $val = $CurrentForm->hasValue("alamat") ? $CurrentForm->getValue("alamat") : $CurrentForm->getValue("x_alamat");
        if (!$this->alamat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alamat->Visible = false; // Disable update for API request
            } else {
                $this->alamat->setFormValue($val);
            }
        }

        // Check field name 'gol_darah' first before field var 'x_gol_darah'
        $val = $CurrentForm->hasValue("gol_darah") ? $CurrentForm->getValue("gol_darah") : $CurrentForm->getValue("x_gol_darah");
        if (!$this->gol_darah->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gol_darah->Visible = false; // Disable update for API request
            } else {
                $this->gol_darah->setFormValue($val);
            }
        }

        // Check field name 'pekerjaan' first before field var 'x_pekerjaan'
        $val = $CurrentForm->hasValue("pekerjaan") ? $CurrentForm->getValue("pekerjaan") : $CurrentForm->getValue("x_pekerjaan");
        if (!$this->pekerjaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pekerjaan->Visible = false; // Disable update for API request
            } else {
                $this->pekerjaan->setFormValue($val);
            }
        }

        // Check field name 'stts_nikah' first before field var 'x_stts_nikah'
        $val = $CurrentForm->hasValue("stts_nikah") ? $CurrentForm->getValue("stts_nikah") : $CurrentForm->getValue("x_stts_nikah");
        if (!$this->stts_nikah->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stts_nikah->Visible = false; // Disable update for API request
            } else {
                $this->stts_nikah->setFormValue($val);
            }
        }

        // Check field name 'agama' first before field var 'x_agama'
        $val = $CurrentForm->hasValue("agama") ? $CurrentForm->getValue("agama") : $CurrentForm->getValue("x_agama");
        if (!$this->agama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->agama->Visible = false; // Disable update for API request
            } else {
                $this->agama->setFormValue($val);
            }
        }

        // Check field name 'tgl_daftar' first before field var 'x_tgl_daftar'
        $val = $CurrentForm->hasValue("tgl_daftar") ? $CurrentForm->getValue("tgl_daftar") : $CurrentForm->getValue("x_tgl_daftar");
        if (!$this->tgl_daftar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_daftar->Visible = false; // Disable update for API request
            } else {
                $this->tgl_daftar->setFormValue($val);
            }
            $this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
        }

        // Check field name 'pnd' first before field var 'x_pnd'
        $val = $CurrentForm->hasValue("pnd") ? $CurrentForm->getValue("pnd") : $CurrentForm->getValue("x_pnd");
        if (!$this->pnd->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pnd->Visible = false; // Disable update for API request
            } else {
                $this->pnd->setFormValue($val);
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

        // Check field name 'no_peserta' first before field var 'x_no_peserta'
        $val = $CurrentForm->hasValue("no_peserta") ? $CurrentForm->getValue("no_peserta") : $CurrentForm->getValue("x_no_peserta");
        if (!$this->no_peserta->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_peserta->Visible = false; // Disable update for API request
            } else {
                $this->no_peserta->setFormValue($val);
            }
        }

        // Check field name 'kd_kel' first before field var 'x_kd_kel'
        $val = $CurrentForm->hasValue("kd_kel") ? $CurrentForm->getValue("kd_kel") : $CurrentForm->getValue("x_kd_kel");
        if (!$this->kd_kel->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_kel->Visible = false; // Disable update for API request
            } else {
                $this->kd_kel->setFormValue($val);
            }
        }

        // Check field name 'kd_kec' first before field var 'x_kd_kec'
        $val = $CurrentForm->hasValue("kd_kec") ? $CurrentForm->getValue("kd_kec") : $CurrentForm->getValue("x_kd_kec");
        if (!$this->kd_kec->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_kec->Visible = false; // Disable update for API request
            } else {
                $this->kd_kec->setFormValue($val);
            }
        }

        // Check field name 'kd_kab' first before field var 'x_kd_kab'
        $val = $CurrentForm->hasValue("kd_kab") ? $CurrentForm->getValue("kd_kab") : $CurrentForm->getValue("x_kd_kab");
        if (!$this->kd_kab->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_kab->Visible = false; // Disable update for API request
            } else {
                $this->kd_kab->setFormValue($val);
            }
        }

        // Check field name 'kd_prop' first before field var 'x_kd_prop'
        $val = $CurrentForm->hasValue("kd_prop") ? $CurrentForm->getValue("kd_prop") : $CurrentForm->getValue("x_kd_prop");
        if (!$this->kd_prop->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_prop->Visible = false; // Disable update for API request
            } else {
                $this->kd_prop->setFormValue($val);
            }
        }

        // Check field name 'suku_bangsa' first before field var 'x_suku_bangsa'
        $val = $CurrentForm->hasValue("suku_bangsa") ? $CurrentForm->getValue("suku_bangsa") : $CurrentForm->getValue("x_suku_bangsa");
        if (!$this->suku_bangsa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->suku_bangsa->Visible = false; // Disable update for API request
            } else {
                $this->suku_bangsa->setFormValue($val);
            }
        }

        // Check field name 'bahasa_pasien' first before field var 'x_bahasa_pasien'
        $val = $CurrentForm->hasValue("bahasa_pasien") ? $CurrentForm->getValue("bahasa_pasien") : $CurrentForm->getValue("x_bahasa_pasien");
        if (!$this->bahasa_pasien->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bahasa_pasien->Visible = false; // Disable update for API request
            } else {
                $this->bahasa_pasien->setFormValue($val);
            }
        }

        // Check field name 'cacat_fisik' first before field var 'x_cacat_fisik'
        $val = $CurrentForm->hasValue("cacat_fisik") ? $CurrentForm->getValue("cacat_fisik") : $CurrentForm->getValue("x_cacat_fisik");
        if (!$this->cacat_fisik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->cacat_fisik->Visible = false; // Disable update for API request
            } else {
                $this->cacat_fisik->setFormValue($val);
            }
        }

        // Check field name 'id_pasien' first before field var 'x_id_pasien'
        $val = $CurrentForm->hasValue("id_pasien") ? $CurrentForm->getValue("id_pasien") : $CurrentForm->getValue("x_id_pasien");
        if (!$this->id_pasien->IsDetailKey) {
            $this->id_pasien->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id_pasien->CurrentValue = $this->id_pasien->FormValue;
        $this->no_rkm_medis->CurrentValue = $this->no_rkm_medis->FormValue;
        $this->nm_pasien->CurrentValue = $this->nm_pasien->FormValue;
        $this->no_ktp->CurrentValue = $this->no_ktp->FormValue;
        $this->jk->CurrentValue = $this->jk->FormValue;
        $this->tmp_lahir->CurrentValue = $this->tmp_lahir->FormValue;
        $this->tgl_lahir->CurrentValue = $this->tgl_lahir->FormValue;
        $this->tgl_lahir->CurrentValue = UnFormatDateTime($this->tgl_lahir->CurrentValue, 7);
        $this->nm_ibu->CurrentValue = $this->nm_ibu->FormValue;
        $this->alamat->CurrentValue = $this->alamat->FormValue;
        $this->gol_darah->CurrentValue = $this->gol_darah->FormValue;
        $this->pekerjaan->CurrentValue = $this->pekerjaan->FormValue;
        $this->stts_nikah->CurrentValue = $this->stts_nikah->FormValue;
        $this->agama->CurrentValue = $this->agama->FormValue;
        $this->tgl_daftar->CurrentValue = $this->tgl_daftar->FormValue;
        $this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
        $this->pnd->CurrentValue = $this->pnd->FormValue;
        $this->kd_pj->CurrentValue = $this->kd_pj->FormValue;
        $this->no_peserta->CurrentValue = $this->no_peserta->FormValue;
        $this->kd_kel->CurrentValue = $this->kd_kel->FormValue;
        $this->kd_kec->CurrentValue = $this->kd_kec->FormValue;
        $this->kd_kab->CurrentValue = $this->kd_kab->FormValue;
        $this->kd_prop->CurrentValue = $this->kd_prop->FormValue;
        $this->suku_bangsa->CurrentValue = $this->suku_bangsa->FormValue;
        $this->bahasa_pasien->CurrentValue = $this->bahasa_pasien->FormValue;
        $this->cacat_fisik->CurrentValue = $this->cacat_fisik->FormValue;
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id_pasien

        // no_rkm_medis

        // nm_pasien

        // no_ktp

        // jk

        // tmp_lahir

        // tgl_lahir

        // nm_ibu

        // alamat

        // gol_darah

        // pekerjaan

        // stts_nikah

        // agama

        // tgl_daftar

        // no_tlp

        // umur

        // pnd

        // keluarga

        // namakeluarga

        // kd_pj

        // no_peserta

        // kd_kel

        // kd_kec

        // kd_kab

        // kd_prop

        // pekerjaanpj

        // alamatpj

        // kelurahanpj

        // kecamatanpj

        // kabupatenpj

        // perusahaan_pasien

        // suku_bangsa

        // bahasa_pasien

        // cacat_fisik

        // email

        // nip

        // propinsipj
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
            $this->tgl_lahir->ViewValue = FormatDateTime($this->tgl_lahir->ViewValue, 7);
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
            $curVal = trim(strval($this->agama->CurrentValue));
            if ($curVal != "") {
                $this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
                if ($this->agama->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id_agama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->agama->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->agama->Lookup->renderViewRow($rswrk[0]);
                        $this->agama->ViewValue = $this->agama->displayValue($arwrk);
                    } else {
                        $this->agama->ViewValue = $this->agama->CurrentValue;
                    }
                }
            } else {
                $this->agama->ViewValue = null;
            }
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

            // nm_pasien
            $this->nm_pasien->LinkCustomAttributes = "";
            $this->nm_pasien->HrefValue = "";
            $this->nm_pasien->TooltipValue = "";

            // no_ktp
            $this->no_ktp->LinkCustomAttributes = "";
            $this->no_ktp->HrefValue = "";
            $this->no_ktp->TooltipValue = "";

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";
            $this->jk->TooltipValue = "";

            // tmp_lahir
            $this->tmp_lahir->LinkCustomAttributes = "";
            $this->tmp_lahir->HrefValue = "";
            $this->tmp_lahir->TooltipValue = "";

            // tgl_lahir
            $this->tgl_lahir->LinkCustomAttributes = "";
            $this->tgl_lahir->HrefValue = "";
            $this->tgl_lahir->TooltipValue = "";

            // nm_ibu
            $this->nm_ibu->LinkCustomAttributes = "";
            $this->nm_ibu->HrefValue = "";
            $this->nm_ibu->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // gol_darah
            $this->gol_darah->LinkCustomAttributes = "";
            $this->gol_darah->HrefValue = "";
            $this->gol_darah->TooltipValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";
            $this->pekerjaan->TooltipValue = "";

            // stts_nikah
            $this->stts_nikah->LinkCustomAttributes = "";
            $this->stts_nikah->HrefValue = "";
            $this->stts_nikah->TooltipValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";
            $this->agama->TooltipValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";

            // pnd
            $this->pnd->LinkCustomAttributes = "";
            $this->pnd->HrefValue = "";
            $this->pnd->TooltipValue = "";

            // kd_pj
            $this->kd_pj->LinkCustomAttributes = "";
            $this->kd_pj->HrefValue = "";
            $this->kd_pj->TooltipValue = "";

            // no_peserta
            $this->no_peserta->LinkCustomAttributes = "";
            $this->no_peserta->HrefValue = "";
            $this->no_peserta->TooltipValue = "";

            // kd_kel
            $this->kd_kel->LinkCustomAttributes = "";
            $this->kd_kel->HrefValue = "";
            $this->kd_kel->TooltipValue = "";

            // kd_kec
            $this->kd_kec->LinkCustomAttributes = "";
            $this->kd_kec->HrefValue = "";
            $this->kd_kec->TooltipValue = "";

            // kd_kab
            $this->kd_kab->LinkCustomAttributes = "";
            $this->kd_kab->HrefValue = "";
            $this->kd_kab->TooltipValue = "";

            // kd_prop
            $this->kd_prop->LinkCustomAttributes = "";
            $this->kd_prop->HrefValue = "";
            $this->kd_prop->TooltipValue = "";

            // suku_bangsa
            $this->suku_bangsa->LinkCustomAttributes = "";
            $this->suku_bangsa->HrefValue = "";
            $this->suku_bangsa->TooltipValue = "";

            // bahasa_pasien
            $this->bahasa_pasien->LinkCustomAttributes = "";
            $this->bahasa_pasien->HrefValue = "";
            $this->bahasa_pasien->TooltipValue = "";

            // cacat_fisik
            $this->cacat_fisik->LinkCustomAttributes = "";
            $this->cacat_fisik->HrefValue = "";
            $this->cacat_fisik->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // no_rkm_medis

            // nm_pasien
            $this->nm_pasien->EditAttrs["class"] = "form-control";
            $this->nm_pasien->EditCustomAttributes = "";
            if (!$this->nm_pasien->Raw) {
                $this->nm_pasien->CurrentValue = HtmlDecode($this->nm_pasien->CurrentValue);
            }
            $this->nm_pasien->EditValue = HtmlEncode($this->nm_pasien->CurrentValue);
            $this->nm_pasien->PlaceHolder = RemoveHtml($this->nm_pasien->caption());

            // no_ktp
            $this->no_ktp->EditAttrs["class"] = "form-control";
            $this->no_ktp->EditCustomAttributes = "";
            if (!$this->no_ktp->Raw) {
                $this->no_ktp->CurrentValue = HtmlDecode($this->no_ktp->CurrentValue);
            }
            $this->no_ktp->EditValue = HtmlEncode($this->no_ktp->CurrentValue);
            $this->no_ktp->PlaceHolder = RemoveHtml($this->no_ktp->caption());

            // jk
            $this->jk->EditCustomAttributes = "";
            $this->jk->EditValue = $this->jk->options(false);
            $this->jk->PlaceHolder = RemoveHtml($this->jk->caption());

            // tmp_lahir
            $this->tmp_lahir->EditAttrs["class"] = "form-control";
            $this->tmp_lahir->EditCustomAttributes = "";
            if (!$this->tmp_lahir->Raw) {
                $this->tmp_lahir->CurrentValue = HtmlDecode($this->tmp_lahir->CurrentValue);
            }
            $this->tmp_lahir->EditValue = HtmlEncode($this->tmp_lahir->CurrentValue);
            $this->tmp_lahir->PlaceHolder = RemoveHtml($this->tmp_lahir->caption());

            // tgl_lahir
            $this->tgl_lahir->EditAttrs["class"] = "form-control";
            $this->tgl_lahir->EditCustomAttributes = "";
            $this->tgl_lahir->EditValue = HtmlEncode(FormatDateTime($this->tgl_lahir->CurrentValue, 7));
            $this->tgl_lahir->PlaceHolder = RemoveHtml($this->tgl_lahir->caption());

            // nm_ibu
            $this->nm_ibu->EditAttrs["class"] = "form-control";
            $this->nm_ibu->EditCustomAttributes = "";
            if (!$this->nm_ibu->Raw) {
                $this->nm_ibu->CurrentValue = HtmlDecode($this->nm_ibu->CurrentValue);
            }
            $this->nm_ibu->EditValue = HtmlEncode($this->nm_ibu->CurrentValue);
            $this->nm_ibu->PlaceHolder = RemoveHtml($this->nm_ibu->caption());

            // alamat
            $this->alamat->EditAttrs["class"] = "form-control";
            $this->alamat->EditCustomAttributes = "";
            if (!$this->alamat->Raw) {
                $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
            }
            $this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
            $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

            // gol_darah
            $this->gol_darah->EditCustomAttributes = "";
            $this->gol_darah->EditValue = $this->gol_darah->options(false);
            $this->gol_darah->PlaceHolder = RemoveHtml($this->gol_darah->caption());

            // pekerjaan
            $this->pekerjaan->EditAttrs["class"] = "form-control";
            $this->pekerjaan->EditCustomAttributes = "";
            if (!$this->pekerjaan->Raw) {
                $this->pekerjaan->CurrentValue = HtmlDecode($this->pekerjaan->CurrentValue);
            }
            $this->pekerjaan->EditValue = HtmlEncode($this->pekerjaan->CurrentValue);
            $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

            // stts_nikah
            $this->stts_nikah->EditCustomAttributes = "";
            $this->stts_nikah->EditValue = $this->stts_nikah->options(false);
            $this->stts_nikah->PlaceHolder = RemoveHtml($this->stts_nikah->caption());

            // agama
            $this->agama->EditAttrs["class"] = "form-control";
            $this->agama->EditCustomAttributes = "";
            $curVal = trim(strval($this->agama->CurrentValue));
            if ($curVal != "") {
                $this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
            } else {
                $this->agama->ViewValue = $this->agama->Lookup !== null && is_array($this->agama->Lookup->Options) ? $curVal : null;
            }
            if ($this->agama->ViewValue !== null) { // Load from cache
                $this->agama->EditValue = array_values($this->agama->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id_agama`" . SearchString("=", $this->agama->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->agama->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->agama->EditValue = $arwrk;
            }
            $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

            // tgl_daftar

            // pnd
            $this->pnd->EditCustomAttributes = "";
            $this->pnd->EditValue = $this->pnd->options(false);
            $this->pnd->PlaceHolder = RemoveHtml($this->pnd->caption());

            // kd_pj
            $this->kd_pj->EditAttrs["class"] = "form-control";
            $this->kd_pj->EditCustomAttributes = "";
            $curVal = trim(strval($this->kd_pj->CurrentValue));
            if ($curVal != "") {
                $this->kd_pj->ViewValue = $this->kd_pj->lookupCacheOption($curVal);
            } else {
                $this->kd_pj->ViewValue = $this->kd_pj->Lookup !== null && is_array($this->kd_pj->Lookup->Options) ? $curVal : null;
            }
            if ($this->kd_pj->ViewValue !== null) { // Load from cache
                $this->kd_pj->EditValue = array_values($this->kd_pj->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kd_pj`" . SearchString("=", $this->kd_pj->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->kd_pj->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kd_pj->EditValue = $arwrk;
            }
            $this->kd_pj->PlaceHolder = RemoveHtml($this->kd_pj->caption());

            // no_peserta
            $this->no_peserta->EditAttrs["class"] = "form-control";
            $this->no_peserta->EditCustomAttributes = "";
            if (!$this->no_peserta->Raw) {
                $this->no_peserta->CurrentValue = HtmlDecode($this->no_peserta->CurrentValue);
            }
            $this->no_peserta->EditValue = HtmlEncode($this->no_peserta->CurrentValue);
            $this->no_peserta->PlaceHolder = RemoveHtml($this->no_peserta->caption());

            // kd_kel
            $this->kd_kel->EditAttrs["class"] = "form-control";
            $this->kd_kel->EditCustomAttributes = "";
            $curVal = trim(strval($this->kd_kel->CurrentValue));
            if ($curVal != "") {
                $this->kd_kel->ViewValue = $this->kd_kel->lookupCacheOption($curVal);
            } else {
                $this->kd_kel->ViewValue = $this->kd_kel->Lookup !== null && is_array($this->kd_kel->Lookup->Options) ? $curVal : null;
            }
            if ($this->kd_kel->ViewValue !== null) { // Load from cache
                $this->kd_kel->EditValue = array_values($this->kd_kel->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kd_kel`" . SearchString("=", $this->kd_kel->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->kd_kel->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kd_kel->EditValue = $arwrk;
            }
            $this->kd_kel->PlaceHolder = RemoveHtml($this->kd_kel->caption());

            // kd_kec
            $this->kd_kec->EditAttrs["class"] = "form-control";
            $this->kd_kec->EditCustomAttributes = "";
            $curVal = trim(strval($this->kd_kec->CurrentValue));
            if ($curVal != "") {
                $this->kd_kec->ViewValue = $this->kd_kec->lookupCacheOption($curVal);
            } else {
                $this->kd_kec->ViewValue = $this->kd_kec->Lookup !== null && is_array($this->kd_kec->Lookup->Options) ? $curVal : null;
            }
            if ($this->kd_kec->ViewValue !== null) { // Load from cache
                $this->kd_kec->EditValue = array_values($this->kd_kec->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kd_kec`" . SearchString("=", $this->kd_kec->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->kd_kec->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kd_kec->EditValue = $arwrk;
            }
            $this->kd_kec->PlaceHolder = RemoveHtml($this->kd_kec->caption());

            // kd_kab
            $this->kd_kab->EditAttrs["class"] = "form-control";
            $this->kd_kab->EditCustomAttributes = "";
            $curVal = trim(strval($this->kd_kab->CurrentValue));
            if ($curVal != "") {
                $this->kd_kab->ViewValue = $this->kd_kab->lookupCacheOption($curVal);
            } else {
                $this->kd_kab->ViewValue = $this->kd_kab->Lookup !== null && is_array($this->kd_kab->Lookup->Options) ? $curVal : null;
            }
            if ($this->kd_kab->ViewValue !== null) { // Load from cache
                $this->kd_kab->EditValue = array_values($this->kd_kab->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kd_kab`" . SearchString("=", $this->kd_kab->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->kd_kab->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kd_kab->EditValue = $arwrk;
            }
            $this->kd_kab->PlaceHolder = RemoveHtml($this->kd_kab->caption());

            // kd_prop
            $this->kd_prop->EditAttrs["class"] = "form-control";
            $this->kd_prop->EditCustomAttributes = "";
            $curVal = trim(strval($this->kd_prop->CurrentValue));
            if ($curVal != "") {
                $this->kd_prop->EditValue = $this->kd_prop->lookupCacheOption($curVal);
                if ($this->kd_prop->EditValue === null) { // Lookup from database
                    $filterWrk = "`kd_prop`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kd_prop->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kd_prop->Lookup->renderViewRow($rswrk[0]);
                        $this->kd_prop->EditValue = $this->kd_prop->displayValue($arwrk);
                    } else {
                        $this->kd_prop->EditValue = $this->kd_prop->CurrentValue;
                    }
                }
            } else {
                $this->kd_prop->EditValue = null;
            }
            $this->kd_prop->ViewCustomAttributes = "";

            // suku_bangsa
            $this->suku_bangsa->EditAttrs["class"] = "form-control";
            $this->suku_bangsa->EditCustomAttributes = "";
            $curVal = trim(strval($this->suku_bangsa->CurrentValue));
            if ($curVal != "") {
                $this->suku_bangsa->ViewValue = $this->suku_bangsa->lookupCacheOption($curVal);
            } else {
                $this->suku_bangsa->ViewValue = $this->suku_bangsa->Lookup !== null && is_array($this->suku_bangsa->Lookup->Options) ? $curVal : null;
            }
            if ($this->suku_bangsa->ViewValue !== null) { // Load from cache
                $this->suku_bangsa->EditValue = array_values($this->suku_bangsa->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->suku_bangsa->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->suku_bangsa->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->suku_bangsa->EditValue = $arwrk;
            }
            $this->suku_bangsa->PlaceHolder = RemoveHtml($this->suku_bangsa->caption());

            // bahasa_pasien
            $this->bahasa_pasien->EditAttrs["class"] = "form-control";
            $this->bahasa_pasien->EditCustomAttributes = "";
            $curVal = trim(strval($this->bahasa_pasien->CurrentValue));
            if ($curVal != "") {
                $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->lookupCacheOption($curVal);
            } else {
                $this->bahasa_pasien->ViewValue = $this->bahasa_pasien->Lookup !== null && is_array($this->bahasa_pasien->Lookup->Options) ? $curVal : null;
            }
            if ($this->bahasa_pasien->ViewValue !== null) { // Load from cache
                $this->bahasa_pasien->EditValue = array_values($this->bahasa_pasien->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->bahasa_pasien->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->bahasa_pasien->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->bahasa_pasien->EditValue = $arwrk;
            }
            $this->bahasa_pasien->PlaceHolder = RemoveHtml($this->bahasa_pasien->caption());

            // cacat_fisik
            $this->cacat_fisik->EditAttrs["class"] = "form-control";
            $this->cacat_fisik->EditCustomAttributes = "";
            $curVal = trim(strval($this->cacat_fisik->CurrentValue));
            if ($curVal != "") {
                $this->cacat_fisik->ViewValue = $this->cacat_fisik->lookupCacheOption($curVal);
            } else {
                $this->cacat_fisik->ViewValue = $this->cacat_fisik->Lookup !== null && is_array($this->cacat_fisik->Lookup->Options) ? $curVal : null;
            }
            if ($this->cacat_fisik->ViewValue !== null) { // Load from cache
                $this->cacat_fisik->EditValue = array_values($this->cacat_fisik->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->cacat_fisik->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->cacat_fisik->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->cacat_fisik->EditValue = $arwrk;
            }
            $this->cacat_fisik->PlaceHolder = RemoveHtml($this->cacat_fisik->caption());

            // Edit refer script

            // no_rkm_medis
            $this->no_rkm_medis->LinkCustomAttributes = "";
            $this->no_rkm_medis->HrefValue = "";
            $this->no_rkm_medis->TooltipValue = "";

            // nm_pasien
            $this->nm_pasien->LinkCustomAttributes = "";
            $this->nm_pasien->HrefValue = "";

            // no_ktp
            $this->no_ktp->LinkCustomAttributes = "";
            $this->no_ktp->HrefValue = "";

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";

            // tmp_lahir
            $this->tmp_lahir->LinkCustomAttributes = "";
            $this->tmp_lahir->HrefValue = "";

            // tgl_lahir
            $this->tgl_lahir->LinkCustomAttributes = "";
            $this->tgl_lahir->HrefValue = "";

            // nm_ibu
            $this->nm_ibu->LinkCustomAttributes = "";
            $this->nm_ibu->HrefValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";

            // gol_darah
            $this->gol_darah->LinkCustomAttributes = "";
            $this->gol_darah->HrefValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";

            // stts_nikah
            $this->stts_nikah->LinkCustomAttributes = "";
            $this->stts_nikah->HrefValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";

            // pnd
            $this->pnd->LinkCustomAttributes = "";
            $this->pnd->HrefValue = "";

            // kd_pj
            $this->kd_pj->LinkCustomAttributes = "";
            $this->kd_pj->HrefValue = "";

            // no_peserta
            $this->no_peserta->LinkCustomAttributes = "";
            $this->no_peserta->HrefValue = "";

            // kd_kel
            $this->kd_kel->LinkCustomAttributes = "";
            $this->kd_kel->HrefValue = "";

            // kd_kec
            $this->kd_kec->LinkCustomAttributes = "";
            $this->kd_kec->HrefValue = "";

            // kd_kab
            $this->kd_kab->LinkCustomAttributes = "";
            $this->kd_kab->HrefValue = "";

            // kd_prop
            $this->kd_prop->LinkCustomAttributes = "";
            $this->kd_prop->HrefValue = "";
            $this->kd_prop->TooltipValue = "";

            // suku_bangsa
            $this->suku_bangsa->LinkCustomAttributes = "";
            $this->suku_bangsa->HrefValue = "";

            // bahasa_pasien
            $this->bahasa_pasien->LinkCustomAttributes = "";
            $this->bahasa_pasien->HrefValue = "";

            // cacat_fisik
            $this->cacat_fisik->LinkCustomAttributes = "";
            $this->cacat_fisik->HrefValue = "";
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
        if ($this->nm_pasien->Required) {
            if (!$this->nm_pasien->IsDetailKey && EmptyValue($this->nm_pasien->FormValue)) {
                $this->nm_pasien->addErrorMessage(str_replace("%s", $this->nm_pasien->caption(), $this->nm_pasien->RequiredErrorMessage));
            }
        }
        if ($this->no_ktp->Required) {
            if (!$this->no_ktp->IsDetailKey && EmptyValue($this->no_ktp->FormValue)) {
                $this->no_ktp->addErrorMessage(str_replace("%s", $this->no_ktp->caption(), $this->no_ktp->RequiredErrorMessage));
            }
        }
        if ($this->jk->Required) {
            if ($this->jk->FormValue == "") {
                $this->jk->addErrorMessage(str_replace("%s", $this->jk->caption(), $this->jk->RequiredErrorMessage));
            }
        }
        if ($this->tmp_lahir->Required) {
            if (!$this->tmp_lahir->IsDetailKey && EmptyValue($this->tmp_lahir->FormValue)) {
                $this->tmp_lahir->addErrorMessage(str_replace("%s", $this->tmp_lahir->caption(), $this->tmp_lahir->RequiredErrorMessage));
            }
        }
        if ($this->tgl_lahir->Required) {
            if (!$this->tgl_lahir->IsDetailKey && EmptyValue($this->tgl_lahir->FormValue)) {
                $this->tgl_lahir->addErrorMessage(str_replace("%s", $this->tgl_lahir->caption(), $this->tgl_lahir->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->tgl_lahir->FormValue)) {
            $this->tgl_lahir->addErrorMessage($this->tgl_lahir->getErrorMessage(false));
        }
        if ($this->nm_ibu->Required) {
            if (!$this->nm_ibu->IsDetailKey && EmptyValue($this->nm_ibu->FormValue)) {
                $this->nm_ibu->addErrorMessage(str_replace("%s", $this->nm_ibu->caption(), $this->nm_ibu->RequiredErrorMessage));
            }
        }
        if ($this->alamat->Required) {
            if (!$this->alamat->IsDetailKey && EmptyValue($this->alamat->FormValue)) {
                $this->alamat->addErrorMessage(str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
            }
        }
        if ($this->gol_darah->Required) {
            if ($this->gol_darah->FormValue == "") {
                $this->gol_darah->addErrorMessage(str_replace("%s", $this->gol_darah->caption(), $this->gol_darah->RequiredErrorMessage));
            }
        }
        if ($this->pekerjaan->Required) {
            if (!$this->pekerjaan->IsDetailKey && EmptyValue($this->pekerjaan->FormValue)) {
                $this->pekerjaan->addErrorMessage(str_replace("%s", $this->pekerjaan->caption(), $this->pekerjaan->RequiredErrorMessage));
            }
        }
        if ($this->stts_nikah->Required) {
            if ($this->stts_nikah->FormValue == "") {
                $this->stts_nikah->addErrorMessage(str_replace("%s", $this->stts_nikah->caption(), $this->stts_nikah->RequiredErrorMessage));
            }
        }
        if ($this->agama->Required) {
            if (!$this->agama->IsDetailKey && EmptyValue($this->agama->FormValue)) {
                $this->agama->addErrorMessage(str_replace("%s", $this->agama->caption(), $this->agama->RequiredErrorMessage));
            }
        }
        if ($this->tgl_daftar->Required) {
            if (!$this->tgl_daftar->IsDetailKey && EmptyValue($this->tgl_daftar->FormValue)) {
                $this->tgl_daftar->addErrorMessage(str_replace("%s", $this->tgl_daftar->caption(), $this->tgl_daftar->RequiredErrorMessage));
            }
        }
        if ($this->pnd->Required) {
            if ($this->pnd->FormValue == "") {
                $this->pnd->addErrorMessage(str_replace("%s", $this->pnd->caption(), $this->pnd->RequiredErrorMessage));
            }
        }
        if ($this->kd_pj->Required) {
            if (!$this->kd_pj->IsDetailKey && EmptyValue($this->kd_pj->FormValue)) {
                $this->kd_pj->addErrorMessage(str_replace("%s", $this->kd_pj->caption(), $this->kd_pj->RequiredErrorMessage));
            }
        }
        if ($this->no_peserta->Required) {
            if (!$this->no_peserta->IsDetailKey && EmptyValue($this->no_peserta->FormValue)) {
                $this->no_peserta->addErrorMessage(str_replace("%s", $this->no_peserta->caption(), $this->no_peserta->RequiredErrorMessage));
            }
        }
        if ($this->kd_kel->Required) {
            if (!$this->kd_kel->IsDetailKey && EmptyValue($this->kd_kel->FormValue)) {
                $this->kd_kel->addErrorMessage(str_replace("%s", $this->kd_kel->caption(), $this->kd_kel->RequiredErrorMessage));
            }
        }
        if ($this->kd_kec->Required) {
            if (!$this->kd_kec->IsDetailKey && EmptyValue($this->kd_kec->FormValue)) {
                $this->kd_kec->addErrorMessage(str_replace("%s", $this->kd_kec->caption(), $this->kd_kec->RequiredErrorMessage));
            }
        }
        if ($this->kd_kab->Required) {
            if (!$this->kd_kab->IsDetailKey && EmptyValue($this->kd_kab->FormValue)) {
                $this->kd_kab->addErrorMessage(str_replace("%s", $this->kd_kab->caption(), $this->kd_kab->RequiredErrorMessage));
            }
        }
        if ($this->kd_prop->Required) {
            if (!$this->kd_prop->IsDetailKey && EmptyValue($this->kd_prop->FormValue)) {
                $this->kd_prop->addErrorMessage(str_replace("%s", $this->kd_prop->caption(), $this->kd_prop->RequiredErrorMessage));
            }
        }
        if ($this->suku_bangsa->Required) {
            if (!$this->suku_bangsa->IsDetailKey && EmptyValue($this->suku_bangsa->FormValue)) {
                $this->suku_bangsa->addErrorMessage(str_replace("%s", $this->suku_bangsa->caption(), $this->suku_bangsa->RequiredErrorMessage));
            }
        }
        if ($this->bahasa_pasien->Required) {
            if (!$this->bahasa_pasien->IsDetailKey && EmptyValue($this->bahasa_pasien->FormValue)) {
                $this->bahasa_pasien->addErrorMessage(str_replace("%s", $this->bahasa_pasien->caption(), $this->bahasa_pasien->RequiredErrorMessage));
            }
        }
        if ($this->cacat_fisik->Required) {
            if (!$this->cacat_fisik->IsDetailKey && EmptyValue($this->cacat_fisik->FormValue)) {
                $this->cacat_fisik->addErrorMessage(str_replace("%s", $this->cacat_fisik->caption(), $this->cacat_fisik->RequiredErrorMessage));
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

            // nm_pasien
            $this->nm_pasien->setDbValueDef($rsnew, $this->nm_pasien->CurrentValue, null, $this->nm_pasien->ReadOnly);

            // no_ktp
            $this->no_ktp->setDbValueDef($rsnew, $this->no_ktp->CurrentValue, null, $this->no_ktp->ReadOnly);

            // jk
            $this->jk->setDbValueDef($rsnew, $this->jk->CurrentValue, null, $this->jk->ReadOnly);

            // tmp_lahir
            $this->tmp_lahir->setDbValueDef($rsnew, $this->tmp_lahir->CurrentValue, null, $this->tmp_lahir->ReadOnly);

            // tgl_lahir
            $this->tgl_lahir->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_lahir->CurrentValue, 7), null, $this->tgl_lahir->ReadOnly);

            // nm_ibu
            $this->nm_ibu->setDbValueDef($rsnew, $this->nm_ibu->CurrentValue, null, $this->nm_ibu->ReadOnly);

            // alamat
            $this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, null, $this->alamat->ReadOnly);

            // gol_darah
            $this->gol_darah->setDbValueDef($rsnew, $this->gol_darah->CurrentValue, null, $this->gol_darah->ReadOnly);

            // pekerjaan
            $this->pekerjaan->setDbValueDef($rsnew, $this->pekerjaan->CurrentValue, null, $this->pekerjaan->ReadOnly);

            // stts_nikah
            $this->stts_nikah->setDbValueDef($rsnew, $this->stts_nikah->CurrentValue, null, $this->stts_nikah->ReadOnly);

            // agama
            $this->agama->setDbValueDef($rsnew, $this->agama->CurrentValue, null, $this->agama->ReadOnly);

            // pnd
            $this->pnd->setDbValueDef($rsnew, $this->pnd->CurrentValue, null, $this->pnd->ReadOnly);

            // kd_pj
            $this->kd_pj->setDbValueDef($rsnew, $this->kd_pj->CurrentValue, null, $this->kd_pj->ReadOnly);

            // no_peserta
            $this->no_peserta->setDbValueDef($rsnew, $this->no_peserta->CurrentValue, null, $this->no_peserta->ReadOnly);

            // kd_kel
            $this->kd_kel->setDbValueDef($rsnew, $this->kd_kel->CurrentValue, null, $this->kd_kel->ReadOnly);

            // kd_kec
            $this->kd_kec->setDbValueDef($rsnew, $this->kd_kec->CurrentValue, null, $this->kd_kec->ReadOnly);

            // kd_kab
            $this->kd_kab->setDbValueDef($rsnew, $this->kd_kab->CurrentValue, null, $this->kd_kab->ReadOnly);

            // suku_bangsa
            $this->suku_bangsa->setDbValueDef($rsnew, $this->suku_bangsa->CurrentValue, 0, $this->suku_bangsa->ReadOnly);

            // bahasa_pasien
            $this->bahasa_pasien->setDbValueDef($rsnew, $this->bahasa_pasien->CurrentValue, 0, $this->bahasa_pasien->ReadOnly);

            // cacat_fisik
            $this->cacat_fisik->setDbValueDef($rsnew, $this->cacat_fisik->CurrentValue, 0, $this->cacat_fisik->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PasienList"), "", $this->TableVar, true);
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
                case "x_jk":
                    break;
                case "x_gol_darah":
                    break;
                case "x_stts_nikah":
                    break;
                case "x_agama":
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
}
