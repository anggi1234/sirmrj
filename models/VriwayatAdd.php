<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VriwayatAdd extends Vriwayat
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'vriwayat';

    // Page object name
    public $PageObjName = "VriwayatAdd";

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

        // Table object (vriwayat)
        if (!isset($GLOBALS["vriwayat"]) || get_class($GLOBALS["vriwayat"]) == PROJECT_NAMESPACE . "vriwayat") {
            $GLOBALS["vriwayat"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'vriwayat');
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
                $doc = new $class(Container("vriwayat"));
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
                    if ($pageName == "VriwayatView") {
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
        $this->id_pasien->Visible = false;
        $this->no_rkm_medis->Visible = false;
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
        $this->kd_pj->setVisibility();
        $this->no_peserta->Visible = false;
        $this->kd_kel->setVisibility();
        $this->kd_kec->setVisibility();
        $this->kd_kab->setVisibility();
        $this->pekerjaanpj->Visible = false;
        $this->alamatpj->Visible = false;
        $this->kelurahanpj->Visible = false;
        $this->kecamatanpj->Visible = false;
        $this->kabupatenpj->Visible = false;
        $this->perusahaan_pasien->setVisibility();
        $this->suku_bangsa->setVisibility();
        $this->bahasa_pasien->setVisibility();
        $this->cacat_fisik->setVisibility();
        $this->_email->Visible = false;
        $this->nip->Visible = false;
        $this->kd_prop->setVisibility();
        $this->propinsipj->Visible = false;
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
        $this->setupLookupOptions($this->kd_pj);
        $this->setupLookupOptions($this->kd_kel);
        $this->setupLookupOptions($this->kd_kec);
        $this->setupLookupOptions($this->kd_kab);
        $this->setupLookupOptions($this->perusahaan_pasien);
        $this->setupLookupOptions($this->suku_bangsa);
        $this->setupLookupOptions($this->bahasa_pasien);
        $this->setupLookupOptions($this->cacat_fisik);
        $this->setupLookupOptions($this->kd_prop);

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
        } else { // Not post back
            $this->CopyRecord = false;
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

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
                    $this->terminate("VriwayatList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->GetViewUrl();
                    if (GetPageName($returnUrl) == "VriwayatList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "VriwayatView") {
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
        $this->id_pasien->CurrentValue = null;
        $this->id_pasien->OldValue = $this->id_pasien->CurrentValue;
        $this->no_rkm_medis->CurrentValue = null;
        $this->no_rkm_medis->OldValue = $this->no_rkm_medis->CurrentValue;
        $this->nm_pasien->CurrentValue = null;
        $this->nm_pasien->OldValue = $this->nm_pasien->CurrentValue;
        $this->no_ktp->CurrentValue = null;
        $this->no_ktp->OldValue = $this->no_ktp->CurrentValue;
        $this->jk->CurrentValue = null;
        $this->jk->OldValue = $this->jk->CurrentValue;
        $this->tmp_lahir->CurrentValue = null;
        $this->tmp_lahir->OldValue = $this->tmp_lahir->CurrentValue;
        $this->tgl_lahir->CurrentValue = null;
        $this->tgl_lahir->OldValue = $this->tgl_lahir->CurrentValue;
        $this->nm_ibu->CurrentValue = null;
        $this->nm_ibu->OldValue = $this->nm_ibu->CurrentValue;
        $this->alamat->CurrentValue = null;
        $this->alamat->OldValue = $this->alamat->CurrentValue;
        $this->gol_darah->CurrentValue = null;
        $this->gol_darah->OldValue = $this->gol_darah->CurrentValue;
        $this->pekerjaan->CurrentValue = null;
        $this->pekerjaan->OldValue = $this->pekerjaan->CurrentValue;
        $this->stts_nikah->CurrentValue = null;
        $this->stts_nikah->OldValue = $this->stts_nikah->CurrentValue;
        $this->agama->CurrentValue = null;
        $this->agama->OldValue = $this->agama->CurrentValue;
        $this->tgl_daftar->CurrentValue = null;
        $this->tgl_daftar->OldValue = $this->tgl_daftar->CurrentValue;
        $this->no_tlp->CurrentValue = null;
        $this->no_tlp->OldValue = $this->no_tlp->CurrentValue;
        $this->umur->CurrentValue = null;
        $this->umur->OldValue = $this->umur->CurrentValue;
        $this->pnd->CurrentValue = null;
        $this->pnd->OldValue = $this->pnd->CurrentValue;
        $this->keluarga->CurrentValue = null;
        $this->keluarga->OldValue = $this->keluarga->CurrentValue;
        $this->namakeluarga->CurrentValue = null;
        $this->namakeluarga->OldValue = $this->namakeluarga->CurrentValue;
        $this->kd_pj->CurrentValue = null;
        $this->kd_pj->OldValue = $this->kd_pj->CurrentValue;
        $this->no_peserta->CurrentValue = null;
        $this->no_peserta->OldValue = $this->no_peserta->CurrentValue;
        $this->kd_kel->CurrentValue = null;
        $this->kd_kel->OldValue = $this->kd_kel->CurrentValue;
        $this->kd_kec->CurrentValue = null;
        $this->kd_kec->OldValue = $this->kd_kec->CurrentValue;
        $this->kd_kab->CurrentValue = null;
        $this->kd_kab->OldValue = $this->kd_kab->CurrentValue;
        $this->pekerjaanpj->CurrentValue = null;
        $this->pekerjaanpj->OldValue = $this->pekerjaanpj->CurrentValue;
        $this->alamatpj->CurrentValue = null;
        $this->alamatpj->OldValue = $this->alamatpj->CurrentValue;
        $this->kelurahanpj->CurrentValue = null;
        $this->kelurahanpj->OldValue = $this->kelurahanpj->CurrentValue;
        $this->kecamatanpj->CurrentValue = null;
        $this->kecamatanpj->OldValue = $this->kecamatanpj->CurrentValue;
        $this->kabupatenpj->CurrentValue = null;
        $this->kabupatenpj->OldValue = $this->kabupatenpj->CurrentValue;
        $this->perusahaan_pasien->CurrentValue = null;
        $this->perusahaan_pasien->OldValue = $this->perusahaan_pasien->CurrentValue;
        $this->suku_bangsa->CurrentValue = null;
        $this->suku_bangsa->OldValue = $this->suku_bangsa->CurrentValue;
        $this->bahasa_pasien->CurrentValue = null;
        $this->bahasa_pasien->OldValue = $this->bahasa_pasien->CurrentValue;
        $this->cacat_fisik->CurrentValue = null;
        $this->cacat_fisik->OldValue = $this->cacat_fisik->CurrentValue;
        $this->_email->CurrentValue = null;
        $this->_email->OldValue = $this->_email->CurrentValue;
        $this->nip->CurrentValue = null;
        $this->nip->OldValue = $this->nip->CurrentValue;
        $this->kd_prop->CurrentValue = null;
        $this->kd_prop->OldValue = $this->kd_prop->CurrentValue;
        $this->propinsipj->CurrentValue = null;
        $this->propinsipj->OldValue = $this->propinsipj->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'nm_pasien' first before field var 'x_nm_pasien'
        $val = $CurrentForm->hasValue("nm_pasien") ? $CurrentForm->getValue("nm_pasien") : $CurrentForm->getValue("x_nm_pasien");
        if (!$this->nm_pasien->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nm_pasien->Visible = false; // Disable update for API request
            } else {
                $this->nm_pasien->setFormValue($val);
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

        // Check field name 'kd_pj' first before field var 'x_kd_pj'
        $val = $CurrentForm->hasValue("kd_pj") ? $CurrentForm->getValue("kd_pj") : $CurrentForm->getValue("x_kd_pj");
        if (!$this->kd_pj->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_pj->Visible = false; // Disable update for API request
            } else {
                $this->kd_pj->setFormValue($val);
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

        // Check field name 'perusahaan_pasien' first before field var 'x_perusahaan_pasien'
        $val = $CurrentForm->hasValue("perusahaan_pasien") ? $CurrentForm->getValue("perusahaan_pasien") : $CurrentForm->getValue("x_perusahaan_pasien");
        if (!$this->perusahaan_pasien->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->perusahaan_pasien->Visible = false; // Disable update for API request
            } else {
                $this->perusahaan_pasien->setFormValue($val);
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

        // Check field name 'kd_prop' first before field var 'x_kd_prop'
        $val = $CurrentForm->hasValue("kd_prop") ? $CurrentForm->getValue("kd_prop") : $CurrentForm->getValue("x_kd_prop");
        if (!$this->kd_prop->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kd_prop->Visible = false; // Disable update for API request
            } else {
                $this->kd_prop->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nm_pasien->CurrentValue = $this->nm_pasien->FormValue;
        $this->jk->CurrentValue = $this->jk->FormValue;
        $this->nm_ibu->CurrentValue = $this->nm_ibu->FormValue;
        $this->alamat->CurrentValue = $this->alamat->FormValue;
        $this->tgl_daftar->CurrentValue = $this->tgl_daftar->FormValue;
        $this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
        $this->kd_pj->CurrentValue = $this->kd_pj->FormValue;
        $this->kd_kel->CurrentValue = $this->kd_kel->FormValue;
        $this->kd_kec->CurrentValue = $this->kd_kec->FormValue;
        $this->kd_kab->CurrentValue = $this->kd_kab->FormValue;
        $this->perusahaan_pasien->CurrentValue = $this->perusahaan_pasien->FormValue;
        $this->suku_bangsa->CurrentValue = $this->suku_bangsa->FormValue;
        $this->bahasa_pasien->CurrentValue = $this->bahasa_pasien->FormValue;
        $this->cacat_fisik->CurrentValue = $this->cacat_fisik->FormValue;
        $this->kd_prop->CurrentValue = $this->kd_prop->FormValue;
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
        $this->kd_prop->setDbValue($row['kd_prop']);
        $this->propinsipj->setDbValue($row['propinsipj']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_pasien'] = $this->id_pasien->CurrentValue;
        $row['no_rkm_medis'] = $this->no_rkm_medis->CurrentValue;
        $row['nm_pasien'] = $this->nm_pasien->CurrentValue;
        $row['no_ktp'] = $this->no_ktp->CurrentValue;
        $row['jk'] = $this->jk->CurrentValue;
        $row['tmp_lahir'] = $this->tmp_lahir->CurrentValue;
        $row['tgl_lahir'] = $this->tgl_lahir->CurrentValue;
        $row['nm_ibu'] = $this->nm_ibu->CurrentValue;
        $row['alamat'] = $this->alamat->CurrentValue;
        $row['gol_darah'] = $this->gol_darah->CurrentValue;
        $row['pekerjaan'] = $this->pekerjaan->CurrentValue;
        $row['stts_nikah'] = $this->stts_nikah->CurrentValue;
        $row['agama'] = $this->agama->CurrentValue;
        $row['tgl_daftar'] = $this->tgl_daftar->CurrentValue;
        $row['no_tlp'] = $this->no_tlp->CurrentValue;
        $row['umur'] = $this->umur->CurrentValue;
        $row['pnd'] = $this->pnd->CurrentValue;
        $row['keluarga'] = $this->keluarga->CurrentValue;
        $row['namakeluarga'] = $this->namakeluarga->CurrentValue;
        $row['kd_pj'] = $this->kd_pj->CurrentValue;
        $row['no_peserta'] = $this->no_peserta->CurrentValue;
        $row['kd_kel'] = $this->kd_kel->CurrentValue;
        $row['kd_kec'] = $this->kd_kec->CurrentValue;
        $row['kd_kab'] = $this->kd_kab->CurrentValue;
        $row['pekerjaanpj'] = $this->pekerjaanpj->CurrentValue;
        $row['alamatpj'] = $this->alamatpj->CurrentValue;
        $row['kelurahanpj'] = $this->kelurahanpj->CurrentValue;
        $row['kecamatanpj'] = $this->kecamatanpj->CurrentValue;
        $row['kabupatenpj'] = $this->kabupatenpj->CurrentValue;
        $row['perusahaan_pasien'] = $this->perusahaan_pasien->CurrentValue;
        $row['suku_bangsa'] = $this->suku_bangsa->CurrentValue;
        $row['bahasa_pasien'] = $this->bahasa_pasien->CurrentValue;
        $row['cacat_fisik'] = $this->cacat_fisik->CurrentValue;
        $row['email'] = $this->_email->CurrentValue;
        $row['nip'] = $this->nip->CurrentValue;
        $row['kd_prop'] = $this->kd_prop->CurrentValue;
        $row['propinsipj'] = $this->propinsipj->CurrentValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        return false;
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

        // kd_prop

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

            // propinsipj
            $this->propinsipj->ViewValue = $this->propinsipj->CurrentValue;
            $this->propinsipj->ViewCustomAttributes = "";

            // nm_pasien
            $this->nm_pasien->LinkCustomAttributes = "";
            $this->nm_pasien->HrefValue = "";
            $this->nm_pasien->TooltipValue = "";

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";
            $this->jk->TooltipValue = "";

            // nm_ibu
            $this->nm_ibu->LinkCustomAttributes = "";
            $this->nm_ibu->HrefValue = "";
            $this->nm_ibu->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";

            // kd_pj
            $this->kd_pj->LinkCustomAttributes = "";
            $this->kd_pj->HrefValue = "";
            $this->kd_pj->TooltipValue = "";

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

            // perusahaan_pasien
            $this->perusahaan_pasien->LinkCustomAttributes = "";
            $this->perusahaan_pasien->HrefValue = "";
            $this->perusahaan_pasien->TooltipValue = "";

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

            // kd_prop
            $this->kd_prop->LinkCustomAttributes = "";
            $this->kd_prop->HrefValue = "";
            $this->kd_prop->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nm_pasien
            $this->nm_pasien->EditAttrs["class"] = "form-control";
            $this->nm_pasien->EditCustomAttributes = "";
            if (!$this->nm_pasien->Raw) {
                $this->nm_pasien->CurrentValue = HtmlDecode($this->nm_pasien->CurrentValue);
            }
            $this->nm_pasien->EditValue = HtmlEncode($this->nm_pasien->CurrentValue);
            $this->nm_pasien->PlaceHolder = RemoveHtml($this->nm_pasien->caption());

            // jk
            $this->jk->EditCustomAttributes = "";
            $this->jk->EditValue = $this->jk->options(false);
            $this->jk->PlaceHolder = RemoveHtml($this->jk->caption());

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

            // tgl_daftar

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

            // perusahaan_pasien
            $this->perusahaan_pasien->EditAttrs["class"] = "form-control";
            $this->perusahaan_pasien->EditCustomAttributes = "";
            $curVal = trim(strval($this->perusahaan_pasien->CurrentValue));
            if ($curVal != "") {
                $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->lookupCacheOption($curVal);
            } else {
                $this->perusahaan_pasien->ViewValue = $this->perusahaan_pasien->Lookup !== null && is_array($this->perusahaan_pasien->Lookup->Options) ? $curVal : null;
            }
            if ($this->perusahaan_pasien->ViewValue !== null) { // Load from cache
                $this->perusahaan_pasien->EditValue = array_values($this->perusahaan_pasien->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kode_perusahaan`" . SearchString("=", $this->perusahaan_pasien->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->perusahaan_pasien->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->perusahaan_pasien->EditValue = $arwrk;
            }
            $this->perusahaan_pasien->PlaceHolder = RemoveHtml($this->perusahaan_pasien->caption());

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

            // kd_prop
            $this->kd_prop->EditAttrs["class"] = "form-control";
            $this->kd_prop->EditCustomAttributes = "";
            $curVal = trim(strval($this->kd_prop->CurrentValue));
            if ($curVal != "") {
                $this->kd_prop->ViewValue = $this->kd_prop->lookupCacheOption($curVal);
            } else {
                $this->kd_prop->ViewValue = $this->kd_prop->Lookup !== null && is_array($this->kd_prop->Lookup->Options) ? $curVal : null;
            }
            if ($this->kd_prop->ViewValue !== null) { // Load from cache
                $this->kd_prop->EditValue = array_values($this->kd_prop->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kd_prop`" . SearchString("=", $this->kd_prop->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->kd_prop->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kd_prop->EditValue = $arwrk;
            }
            $this->kd_prop->PlaceHolder = RemoveHtml($this->kd_prop->caption());

            // Add refer script

            // nm_pasien
            $this->nm_pasien->LinkCustomAttributes = "";
            $this->nm_pasien->HrefValue = "";

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";

            // nm_ibu
            $this->nm_ibu->LinkCustomAttributes = "";
            $this->nm_ibu->HrefValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";

            // kd_pj
            $this->kd_pj->LinkCustomAttributes = "";
            $this->kd_pj->HrefValue = "";

            // kd_kel
            $this->kd_kel->LinkCustomAttributes = "";
            $this->kd_kel->HrefValue = "";

            // kd_kec
            $this->kd_kec->LinkCustomAttributes = "";
            $this->kd_kec->HrefValue = "";

            // kd_kab
            $this->kd_kab->LinkCustomAttributes = "";
            $this->kd_kab->HrefValue = "";

            // perusahaan_pasien
            $this->perusahaan_pasien->LinkCustomAttributes = "";
            $this->perusahaan_pasien->HrefValue = "";

            // suku_bangsa
            $this->suku_bangsa->LinkCustomAttributes = "";
            $this->suku_bangsa->HrefValue = "";

            // bahasa_pasien
            $this->bahasa_pasien->LinkCustomAttributes = "";
            $this->bahasa_pasien->HrefValue = "";

            // cacat_fisik
            $this->cacat_fisik->LinkCustomAttributes = "";
            $this->cacat_fisik->HrefValue = "";

            // kd_prop
            $this->kd_prop->LinkCustomAttributes = "";
            $this->kd_prop->HrefValue = "";
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
        if ($this->nm_pasien->Required) {
            if (!$this->nm_pasien->IsDetailKey && EmptyValue($this->nm_pasien->FormValue)) {
                $this->nm_pasien->addErrorMessage(str_replace("%s", $this->nm_pasien->caption(), $this->nm_pasien->RequiredErrorMessage));
            }
        }
        if ($this->jk->Required) {
            if ($this->jk->FormValue == "") {
                $this->jk->addErrorMessage(str_replace("%s", $this->jk->caption(), $this->jk->RequiredErrorMessage));
            }
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
        if ($this->tgl_daftar->Required) {
            if (!$this->tgl_daftar->IsDetailKey && EmptyValue($this->tgl_daftar->FormValue)) {
                $this->tgl_daftar->addErrorMessage(str_replace("%s", $this->tgl_daftar->caption(), $this->tgl_daftar->RequiredErrorMessage));
            }
        }
        if ($this->kd_pj->Required) {
            if (!$this->kd_pj->IsDetailKey && EmptyValue($this->kd_pj->FormValue)) {
                $this->kd_pj->addErrorMessage(str_replace("%s", $this->kd_pj->caption(), $this->kd_pj->RequiredErrorMessage));
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
        if ($this->perusahaan_pasien->Required) {
            if (!$this->perusahaan_pasien->IsDetailKey && EmptyValue($this->perusahaan_pasien->FormValue)) {
                $this->perusahaan_pasien->addErrorMessage(str_replace("%s", $this->perusahaan_pasien->caption(), $this->perusahaan_pasien->RequiredErrorMessage));
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
        if ($this->kd_prop->Required) {
            if (!$this->kd_prop->IsDetailKey && EmptyValue($this->kd_prop->FormValue)) {
                $this->kd_prop->addErrorMessage(str_replace("%s", $this->kd_prop->caption(), $this->kd_prop->RequiredErrorMessage));
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

        // nm_pasien
        $this->nm_pasien->setDbValueDef($rsnew, $this->nm_pasien->CurrentValue, null, false);

        // jk
        $this->jk->setDbValueDef($rsnew, $this->jk->CurrentValue, null, false);

        // nm_ibu
        $this->nm_ibu->setDbValueDef($rsnew, $this->nm_ibu->CurrentValue, "", false);

        // alamat
        $this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, null, false);

        // tgl_daftar
        $this->tgl_daftar->CurrentValue = CurrentDateTime();
        $this->tgl_daftar->setDbValueDef($rsnew, $this->tgl_daftar->CurrentValue, null);

        // kd_pj
        $this->kd_pj->setDbValueDef($rsnew, $this->kd_pj->CurrentValue, "", false);

        // kd_kel
        $this->kd_kel->setDbValueDef($rsnew, $this->kd_kel->CurrentValue, 0, false);

        // kd_kec
        $this->kd_kec->setDbValueDef($rsnew, $this->kd_kec->CurrentValue, 0, false);

        // kd_kab
        $this->kd_kab->setDbValueDef($rsnew, $this->kd_kab->CurrentValue, 0, false);

        // perusahaan_pasien
        $this->perusahaan_pasien->setDbValueDef($rsnew, $this->perusahaan_pasien->CurrentValue, "", false);

        // suku_bangsa
        $this->suku_bangsa->setDbValueDef($rsnew, $this->suku_bangsa->CurrentValue, 0, false);

        // bahasa_pasien
        $this->bahasa_pasien->setDbValueDef($rsnew, $this->bahasa_pasien->CurrentValue, 0, false);

        // cacat_fisik
        $this->cacat_fisik->setDbValueDef($rsnew, $this->cacat_fisik->CurrentValue, 0, false);

        // kd_prop
        $this->kd_prop->setDbValueDef($rsnew, $this->kd_prop->CurrentValue, 0, false);

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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("VriwayatList"), "", $this->TableVar, true);
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
                case "x_perusahaan_pasien":
                    break;
                case "x_suku_bangsa":
                    break;
                case "x_bahasa_pasien":
                    break;
                case "x_cacat_fisik":
                    break;
                case "x_kd_prop":
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
