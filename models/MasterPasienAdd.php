<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MasterPasienAdd extends MasterPasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'master_pasien';

    // Page object name
    public $PageObjName = "MasterPasienAdd";

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

        // Table object (master_pasien)
        if (!isset($GLOBALS["master_pasien"]) || get_class($GLOBALS["master_pasien"]) == PROJECT_NAMESPACE . "master_pasien") {
            $GLOBALS["master_pasien"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'master_pasien');
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
                $doc = new $class(Container("master_pasien"));
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
                    if ($pageName == "MasterPasienView") {
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
        $this->nama_pasien->setVisibility();
        $this->no_rekam_medis->setVisibility();
        $this->nik->setVisibility();
        $this->no_identitas_lain->setVisibility();
        $this->nama_ibu->setVisibility();
        $this->tempat_lahir->setVisibility();
        $this->tanggal_lahir->setVisibility();
        $this->jenis_kelamin->setVisibility();
        $this->agama->setVisibility();
        $this->suku->setVisibility();
        $this->bahasa->setVisibility();
        $this->alamat->setVisibility();
        $this->rt->setVisibility();
        $this->rw->setVisibility();
        $this->keluarahan_desa->setVisibility();
        $this->kecamatan->setVisibility();
        $this->kabupaten_kota->setVisibility();
        $this->kodepos->setVisibility();
        $this->provinsi->setVisibility();
        $this->negara->setVisibility();
        $this->alamat_domisili->setVisibility();
        $this->rt_domisili->setVisibility();
        $this->rw_domisili->setVisibility();
        $this->kel_desa_domisili->setVisibility();
        $this->kec_domisili->setVisibility();
        $this->kota_kab_domisili->setVisibility();
        $this->kodepos_domisili->setVisibility();
        $this->prov_domisili->setVisibility();
        $this->negara_domisili->setVisibility();
        $this->no_telp->setVisibility();
        $this->no_hp->setVisibility();
        $this->pendidikan->setVisibility();
        $this->pekerjaan->setVisibility();
        $this->status_kawin->setVisibility();
        $this->tgl_daftar->setVisibility();
        $this->_username->setVisibility();
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
            if (($keyValue = Get("id_pasien") ?? Route("id_pasien")) !== null) {
                $this->id_pasien->setQueryStringValue($keyValue);
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
                    $this->terminate("MasterPasienList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "MasterPasienList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "MasterPasienView") {
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
        $this->nama_pasien->CurrentValue = null;
        $this->nama_pasien->OldValue = $this->nama_pasien->CurrentValue;
        $this->no_rekam_medis->CurrentValue = null;
        $this->no_rekam_medis->OldValue = $this->no_rekam_medis->CurrentValue;
        $this->nik->CurrentValue = null;
        $this->nik->OldValue = $this->nik->CurrentValue;
        $this->no_identitas_lain->CurrentValue = null;
        $this->no_identitas_lain->OldValue = $this->no_identitas_lain->CurrentValue;
        $this->nama_ibu->CurrentValue = null;
        $this->nama_ibu->OldValue = $this->nama_ibu->CurrentValue;
        $this->tempat_lahir->CurrentValue = null;
        $this->tempat_lahir->OldValue = $this->tempat_lahir->CurrentValue;
        $this->tanggal_lahir->CurrentValue = null;
        $this->tanggal_lahir->OldValue = $this->tanggal_lahir->CurrentValue;
        $this->jenis_kelamin->CurrentValue = null;
        $this->jenis_kelamin->OldValue = $this->jenis_kelamin->CurrentValue;
        $this->agama->CurrentValue = null;
        $this->agama->OldValue = $this->agama->CurrentValue;
        $this->suku->CurrentValue = null;
        $this->suku->OldValue = $this->suku->CurrentValue;
        $this->bahasa->CurrentValue = null;
        $this->bahasa->OldValue = $this->bahasa->CurrentValue;
        $this->alamat->CurrentValue = null;
        $this->alamat->OldValue = $this->alamat->CurrentValue;
        $this->rt->CurrentValue = null;
        $this->rt->OldValue = $this->rt->CurrentValue;
        $this->rw->CurrentValue = null;
        $this->rw->OldValue = $this->rw->CurrentValue;
        $this->keluarahan_desa->CurrentValue = null;
        $this->keluarahan_desa->OldValue = $this->keluarahan_desa->CurrentValue;
        $this->kecamatan->CurrentValue = null;
        $this->kecamatan->OldValue = $this->kecamatan->CurrentValue;
        $this->kabupaten_kota->CurrentValue = null;
        $this->kabupaten_kota->OldValue = $this->kabupaten_kota->CurrentValue;
        $this->kodepos->CurrentValue = null;
        $this->kodepos->OldValue = $this->kodepos->CurrentValue;
        $this->provinsi->CurrentValue = null;
        $this->provinsi->OldValue = $this->provinsi->CurrentValue;
        $this->negara->CurrentValue = null;
        $this->negara->OldValue = $this->negara->CurrentValue;
        $this->alamat_domisili->CurrentValue = null;
        $this->alamat_domisili->OldValue = $this->alamat_domisili->CurrentValue;
        $this->rt_domisili->CurrentValue = null;
        $this->rt_domisili->OldValue = $this->rt_domisili->CurrentValue;
        $this->rw_domisili->CurrentValue = null;
        $this->rw_domisili->OldValue = $this->rw_domisili->CurrentValue;
        $this->kel_desa_domisili->CurrentValue = null;
        $this->kel_desa_domisili->OldValue = $this->kel_desa_domisili->CurrentValue;
        $this->kec_domisili->CurrentValue = null;
        $this->kec_domisili->OldValue = $this->kec_domisili->CurrentValue;
        $this->kota_kab_domisili->CurrentValue = null;
        $this->kota_kab_domisili->OldValue = $this->kota_kab_domisili->CurrentValue;
        $this->kodepos_domisili->CurrentValue = null;
        $this->kodepos_domisili->OldValue = $this->kodepos_domisili->CurrentValue;
        $this->prov_domisili->CurrentValue = null;
        $this->prov_domisili->OldValue = $this->prov_domisili->CurrentValue;
        $this->negara_domisili->CurrentValue = null;
        $this->negara_domisili->OldValue = $this->negara_domisili->CurrentValue;
        $this->no_telp->CurrentValue = null;
        $this->no_telp->OldValue = $this->no_telp->CurrentValue;
        $this->no_hp->CurrentValue = null;
        $this->no_hp->OldValue = $this->no_hp->CurrentValue;
        $this->pendidikan->CurrentValue = null;
        $this->pendidikan->OldValue = $this->pendidikan->CurrentValue;
        $this->pekerjaan->CurrentValue = null;
        $this->pekerjaan->OldValue = $this->pekerjaan->CurrentValue;
        $this->status_kawin->CurrentValue = null;
        $this->status_kawin->OldValue = $this->status_kawin->CurrentValue;
        $this->tgl_daftar->CurrentValue = null;
        $this->tgl_daftar->OldValue = $this->tgl_daftar->CurrentValue;
        $this->_username->CurrentValue = null;
        $this->_username->OldValue = $this->_username->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'nama_pasien' first before field var 'x_nama_pasien'
        $val = $CurrentForm->hasValue("nama_pasien") ? $CurrentForm->getValue("nama_pasien") : $CurrentForm->getValue("x_nama_pasien");
        if (!$this->nama_pasien->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_pasien->Visible = false; // Disable update for API request
            } else {
                $this->nama_pasien->setFormValue($val);
            }
        }

        // Check field name 'no_rekam_medis' first before field var 'x_no_rekam_medis'
        $val = $CurrentForm->hasValue("no_rekam_medis") ? $CurrentForm->getValue("no_rekam_medis") : $CurrentForm->getValue("x_no_rekam_medis");
        if (!$this->no_rekam_medis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rekam_medis->Visible = false; // Disable update for API request
            } else {
                $this->no_rekam_medis->setFormValue($val);
            }
        }

        // Check field name 'nik' first before field var 'x_nik'
        $val = $CurrentForm->hasValue("nik") ? $CurrentForm->getValue("nik") : $CurrentForm->getValue("x_nik");
        if (!$this->nik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nik->Visible = false; // Disable update for API request
            } else {
                $this->nik->setFormValue($val);
            }
        }

        // Check field name 'no_identitas_lain' first before field var 'x_no_identitas_lain'
        $val = $CurrentForm->hasValue("no_identitas_lain") ? $CurrentForm->getValue("no_identitas_lain") : $CurrentForm->getValue("x_no_identitas_lain");
        if (!$this->no_identitas_lain->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_identitas_lain->Visible = false; // Disable update for API request
            } else {
                $this->no_identitas_lain->setFormValue($val);
            }
        }

        // Check field name 'nama_ibu' first before field var 'x_nama_ibu'
        $val = $CurrentForm->hasValue("nama_ibu") ? $CurrentForm->getValue("nama_ibu") : $CurrentForm->getValue("x_nama_ibu");
        if (!$this->nama_ibu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_ibu->Visible = false; // Disable update for API request
            } else {
                $this->nama_ibu->setFormValue($val);
            }
        }

        // Check field name 'tempat_lahir' first before field var 'x_tempat_lahir'
        $val = $CurrentForm->hasValue("tempat_lahir") ? $CurrentForm->getValue("tempat_lahir") : $CurrentForm->getValue("x_tempat_lahir");
        if (!$this->tempat_lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tempat_lahir->Visible = false; // Disable update for API request
            } else {
                $this->tempat_lahir->setFormValue($val);
            }
        }

        // Check field name 'tanggal_lahir' first before field var 'x_tanggal_lahir'
        $val = $CurrentForm->hasValue("tanggal_lahir") ? $CurrentForm->getValue("tanggal_lahir") : $CurrentForm->getValue("x_tanggal_lahir");
        if (!$this->tanggal_lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_lahir->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_lahir->setFormValue($val);
            }
            $this->tanggal_lahir->CurrentValue = UnFormatDateTime($this->tanggal_lahir->CurrentValue, 0);
        }

        // Check field name 'jenis_kelamin' first before field var 'x_jenis_kelamin'
        $val = $CurrentForm->hasValue("jenis_kelamin") ? $CurrentForm->getValue("jenis_kelamin") : $CurrentForm->getValue("x_jenis_kelamin");
        if (!$this->jenis_kelamin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenis_kelamin->Visible = false; // Disable update for API request
            } else {
                $this->jenis_kelamin->setFormValue($val);
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

        // Check field name 'suku' first before field var 'x_suku'
        $val = $CurrentForm->hasValue("suku") ? $CurrentForm->getValue("suku") : $CurrentForm->getValue("x_suku");
        if (!$this->suku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->suku->Visible = false; // Disable update for API request
            } else {
                $this->suku->setFormValue($val);
            }
        }

        // Check field name 'bahasa' first before field var 'x_bahasa'
        $val = $CurrentForm->hasValue("bahasa") ? $CurrentForm->getValue("bahasa") : $CurrentForm->getValue("x_bahasa");
        if (!$this->bahasa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bahasa->Visible = false; // Disable update for API request
            } else {
                $this->bahasa->setFormValue($val);
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

        // Check field name 'rt' first before field var 'x_rt'
        $val = $CurrentForm->hasValue("rt") ? $CurrentForm->getValue("rt") : $CurrentForm->getValue("x_rt");
        if (!$this->rt->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rt->Visible = false; // Disable update for API request
            } else {
                $this->rt->setFormValue($val);
            }
        }

        // Check field name 'rw' first before field var 'x_rw'
        $val = $CurrentForm->hasValue("rw") ? $CurrentForm->getValue("rw") : $CurrentForm->getValue("x_rw");
        if (!$this->rw->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rw->Visible = false; // Disable update for API request
            } else {
                $this->rw->setFormValue($val);
            }
        }

        // Check field name 'keluarahan_desa' first before field var 'x_keluarahan_desa'
        $val = $CurrentForm->hasValue("keluarahan_desa") ? $CurrentForm->getValue("keluarahan_desa") : $CurrentForm->getValue("x_keluarahan_desa");
        if (!$this->keluarahan_desa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keluarahan_desa->Visible = false; // Disable update for API request
            } else {
                $this->keluarahan_desa->setFormValue($val);
            }
        }

        // Check field name 'kecamatan' first before field var 'x_kecamatan'
        $val = $CurrentForm->hasValue("kecamatan") ? $CurrentForm->getValue("kecamatan") : $CurrentForm->getValue("x_kecamatan");
        if (!$this->kecamatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kecamatan->Visible = false; // Disable update for API request
            } else {
                $this->kecamatan->setFormValue($val);
            }
        }

        // Check field name 'kabupaten_kota' first before field var 'x_kabupaten_kota'
        $val = $CurrentForm->hasValue("kabupaten_kota") ? $CurrentForm->getValue("kabupaten_kota") : $CurrentForm->getValue("x_kabupaten_kota");
        if (!$this->kabupaten_kota->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kabupaten_kota->Visible = false; // Disable update for API request
            } else {
                $this->kabupaten_kota->setFormValue($val);
            }
        }

        // Check field name 'kodepos' first before field var 'x_kodepos'
        $val = $CurrentForm->hasValue("kodepos") ? $CurrentForm->getValue("kodepos") : $CurrentForm->getValue("x_kodepos");
        if (!$this->kodepos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kodepos->Visible = false; // Disable update for API request
            } else {
                $this->kodepos->setFormValue($val);
            }
        }

        // Check field name 'provinsi' first before field var 'x_provinsi'
        $val = $CurrentForm->hasValue("provinsi") ? $CurrentForm->getValue("provinsi") : $CurrentForm->getValue("x_provinsi");
        if (!$this->provinsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->provinsi->Visible = false; // Disable update for API request
            } else {
                $this->provinsi->setFormValue($val);
            }
        }

        // Check field name 'negara' first before field var 'x_negara'
        $val = $CurrentForm->hasValue("negara") ? $CurrentForm->getValue("negara") : $CurrentForm->getValue("x_negara");
        if (!$this->negara->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->negara->Visible = false; // Disable update for API request
            } else {
                $this->negara->setFormValue($val);
            }
        }

        // Check field name 'alamat_domisili' first before field var 'x_alamat_domisili'
        $val = $CurrentForm->hasValue("alamat_domisili") ? $CurrentForm->getValue("alamat_domisili") : $CurrentForm->getValue("x_alamat_domisili");
        if (!$this->alamat_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alamat_domisili->Visible = false; // Disable update for API request
            } else {
                $this->alamat_domisili->setFormValue($val);
            }
        }

        // Check field name 'rt_domisili' first before field var 'x_rt_domisili'
        $val = $CurrentForm->hasValue("rt_domisili") ? $CurrentForm->getValue("rt_domisili") : $CurrentForm->getValue("x_rt_domisili");
        if (!$this->rt_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rt_domisili->Visible = false; // Disable update for API request
            } else {
                $this->rt_domisili->setFormValue($val);
            }
        }

        // Check field name 'rw_domisili' first before field var 'x_rw_domisili'
        $val = $CurrentForm->hasValue("rw_domisili") ? $CurrentForm->getValue("rw_domisili") : $CurrentForm->getValue("x_rw_domisili");
        if (!$this->rw_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rw_domisili->Visible = false; // Disable update for API request
            } else {
                $this->rw_domisili->setFormValue($val);
            }
        }

        // Check field name 'kel_desa_domisili' first before field var 'x_kel_desa_domisili'
        $val = $CurrentForm->hasValue("kel_desa_domisili") ? $CurrentForm->getValue("kel_desa_domisili") : $CurrentForm->getValue("x_kel_desa_domisili");
        if (!$this->kel_desa_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kel_desa_domisili->Visible = false; // Disable update for API request
            } else {
                $this->kel_desa_domisili->setFormValue($val);
            }
        }

        // Check field name 'kec_domisili' first before field var 'x_kec_domisili'
        $val = $CurrentForm->hasValue("kec_domisili") ? $CurrentForm->getValue("kec_domisili") : $CurrentForm->getValue("x_kec_domisili");
        if (!$this->kec_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kec_domisili->Visible = false; // Disable update for API request
            } else {
                $this->kec_domisili->setFormValue($val);
            }
        }

        // Check field name 'kota_kab_domisili' first before field var 'x_kota_kab_domisili'
        $val = $CurrentForm->hasValue("kota_kab_domisili") ? $CurrentForm->getValue("kota_kab_domisili") : $CurrentForm->getValue("x_kota_kab_domisili");
        if (!$this->kota_kab_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kota_kab_domisili->Visible = false; // Disable update for API request
            } else {
                $this->kota_kab_domisili->setFormValue($val);
            }
        }

        // Check field name 'kodepos_domisili' first before field var 'x_kodepos_domisili'
        $val = $CurrentForm->hasValue("kodepos_domisili") ? $CurrentForm->getValue("kodepos_domisili") : $CurrentForm->getValue("x_kodepos_domisili");
        if (!$this->kodepos_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kodepos_domisili->Visible = false; // Disable update for API request
            } else {
                $this->kodepos_domisili->setFormValue($val);
            }
        }

        // Check field name 'prov_domisili' first before field var 'x_prov_domisili'
        $val = $CurrentForm->hasValue("prov_domisili") ? $CurrentForm->getValue("prov_domisili") : $CurrentForm->getValue("x_prov_domisili");
        if (!$this->prov_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->prov_domisili->Visible = false; // Disable update for API request
            } else {
                $this->prov_domisili->setFormValue($val);
            }
        }

        // Check field name 'negara_domisili' first before field var 'x_negara_domisili'
        $val = $CurrentForm->hasValue("negara_domisili") ? $CurrentForm->getValue("negara_domisili") : $CurrentForm->getValue("x_negara_domisili");
        if (!$this->negara_domisili->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->negara_domisili->Visible = false; // Disable update for API request
            } else {
                $this->negara_domisili->setFormValue($val);
            }
        }

        // Check field name 'no_telp' first before field var 'x_no_telp'
        $val = $CurrentForm->hasValue("no_telp") ? $CurrentForm->getValue("no_telp") : $CurrentForm->getValue("x_no_telp");
        if (!$this->no_telp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_telp->Visible = false; // Disable update for API request
            } else {
                $this->no_telp->setFormValue($val);
            }
        }

        // Check field name 'no_hp' first before field var 'x_no_hp'
        $val = $CurrentForm->hasValue("no_hp") ? $CurrentForm->getValue("no_hp") : $CurrentForm->getValue("x_no_hp");
        if (!$this->no_hp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_hp->Visible = false; // Disable update for API request
            } else {
                $this->no_hp->setFormValue($val);
            }
        }

        // Check field name 'pendidikan' first before field var 'x_pendidikan'
        $val = $CurrentForm->hasValue("pendidikan") ? $CurrentForm->getValue("pendidikan") : $CurrentForm->getValue("x_pendidikan");
        if (!$this->pendidikan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pendidikan->Visible = false; // Disable update for API request
            } else {
                $this->pendidikan->setFormValue($val);
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

        // Check field name 'status_kawin' first before field var 'x_status_kawin'
        $val = $CurrentForm->hasValue("status_kawin") ? $CurrentForm->getValue("status_kawin") : $CurrentForm->getValue("x_status_kawin");
        if (!$this->status_kawin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_kawin->Visible = false; // Disable update for API request
            } else {
                $this->status_kawin->setFormValue($val);
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

        // Check field name 'username' first before field var 'x__username'
        $val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x__username");
        if (!$this->_username->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_username->Visible = false; // Disable update for API request
            } else {
                $this->_username->setFormValue($val);
            }
        }

        // Check field name 'id_pasien' first before field var 'x_id_pasien'
        $val = $CurrentForm->hasValue("id_pasien") ? $CurrentForm->getValue("id_pasien") : $CurrentForm->getValue("x_id_pasien");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nama_pasien->CurrentValue = $this->nama_pasien->FormValue;
        $this->no_rekam_medis->CurrentValue = $this->no_rekam_medis->FormValue;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->no_identitas_lain->CurrentValue = $this->no_identitas_lain->FormValue;
        $this->nama_ibu->CurrentValue = $this->nama_ibu->FormValue;
        $this->tempat_lahir->CurrentValue = $this->tempat_lahir->FormValue;
        $this->tanggal_lahir->CurrentValue = $this->tanggal_lahir->FormValue;
        $this->tanggal_lahir->CurrentValue = UnFormatDateTime($this->tanggal_lahir->CurrentValue, 0);
        $this->jenis_kelamin->CurrentValue = $this->jenis_kelamin->FormValue;
        $this->agama->CurrentValue = $this->agama->FormValue;
        $this->suku->CurrentValue = $this->suku->FormValue;
        $this->bahasa->CurrentValue = $this->bahasa->FormValue;
        $this->alamat->CurrentValue = $this->alamat->FormValue;
        $this->rt->CurrentValue = $this->rt->FormValue;
        $this->rw->CurrentValue = $this->rw->FormValue;
        $this->keluarahan_desa->CurrentValue = $this->keluarahan_desa->FormValue;
        $this->kecamatan->CurrentValue = $this->kecamatan->FormValue;
        $this->kabupaten_kota->CurrentValue = $this->kabupaten_kota->FormValue;
        $this->kodepos->CurrentValue = $this->kodepos->FormValue;
        $this->provinsi->CurrentValue = $this->provinsi->FormValue;
        $this->negara->CurrentValue = $this->negara->FormValue;
        $this->alamat_domisili->CurrentValue = $this->alamat_domisili->FormValue;
        $this->rt_domisili->CurrentValue = $this->rt_domisili->FormValue;
        $this->rw_domisili->CurrentValue = $this->rw_domisili->FormValue;
        $this->kel_desa_domisili->CurrentValue = $this->kel_desa_domisili->FormValue;
        $this->kec_domisili->CurrentValue = $this->kec_domisili->FormValue;
        $this->kota_kab_domisili->CurrentValue = $this->kota_kab_domisili->FormValue;
        $this->kodepos_domisili->CurrentValue = $this->kodepos_domisili->FormValue;
        $this->prov_domisili->CurrentValue = $this->prov_domisili->FormValue;
        $this->negara_domisili->CurrentValue = $this->negara_domisili->FormValue;
        $this->no_telp->CurrentValue = $this->no_telp->FormValue;
        $this->no_hp->CurrentValue = $this->no_hp->FormValue;
        $this->pendidikan->CurrentValue = $this->pendidikan->FormValue;
        $this->pekerjaan->CurrentValue = $this->pekerjaan->FormValue;
        $this->status_kawin->CurrentValue = $this->status_kawin->FormValue;
        $this->tgl_daftar->CurrentValue = $this->tgl_daftar->FormValue;
        $this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 0);
        $this->_username->CurrentValue = $this->_username->FormValue;
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
        $this->nama_pasien->setDbValue($row['nama_pasien']);
        $this->no_rekam_medis->setDbValue($row['no_rekam_medis']);
        $this->nik->setDbValue($row['nik']);
        $this->no_identitas_lain->setDbValue($row['no_identitas_lain']);
        $this->nama_ibu->setDbValue($row['nama_ibu']);
        $this->tempat_lahir->setDbValue($row['tempat_lahir']);
        $this->tanggal_lahir->setDbValue($row['tanggal_lahir']);
        $this->jenis_kelamin->setDbValue($row['jenis_kelamin']);
        $this->agama->setDbValue($row['agama']);
        $this->suku->setDbValue($row['suku']);
        $this->bahasa->setDbValue($row['bahasa']);
        $this->alamat->setDbValue($row['alamat']);
        $this->rt->setDbValue($row['rt']);
        $this->rw->setDbValue($row['rw']);
        $this->keluarahan_desa->setDbValue($row['keluarahan_desa']);
        $this->kecamatan->setDbValue($row['kecamatan']);
        $this->kabupaten_kota->setDbValue($row['kabupaten_kota']);
        $this->kodepos->setDbValue($row['kodepos']);
        $this->provinsi->setDbValue($row['provinsi']);
        $this->negara->setDbValue($row['negara']);
        $this->alamat_domisili->setDbValue($row['alamat_domisili']);
        $this->rt_domisili->setDbValue($row['rt_domisili']);
        $this->rw_domisili->setDbValue($row['rw_domisili']);
        $this->kel_desa_domisili->setDbValue($row['kel_desa_domisili']);
        $this->kec_domisili->setDbValue($row['kec_domisili']);
        $this->kota_kab_domisili->setDbValue($row['kota_kab_domisili']);
        $this->kodepos_domisili->setDbValue($row['kodepos_domisili']);
        $this->prov_domisili->setDbValue($row['prov_domisili']);
        $this->negara_domisili->setDbValue($row['negara_domisili']);
        $this->no_telp->setDbValue($row['no_telp']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->status_kawin->setDbValue($row['status_kawin']);
        $this->tgl_daftar->setDbValue($row['tgl_daftar']);
        $this->_username->setDbValue($row['username']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_pasien'] = $this->id_pasien->CurrentValue;
        $row['nama_pasien'] = $this->nama_pasien->CurrentValue;
        $row['no_rekam_medis'] = $this->no_rekam_medis->CurrentValue;
        $row['nik'] = $this->nik->CurrentValue;
        $row['no_identitas_lain'] = $this->no_identitas_lain->CurrentValue;
        $row['nama_ibu'] = $this->nama_ibu->CurrentValue;
        $row['tempat_lahir'] = $this->tempat_lahir->CurrentValue;
        $row['tanggal_lahir'] = $this->tanggal_lahir->CurrentValue;
        $row['jenis_kelamin'] = $this->jenis_kelamin->CurrentValue;
        $row['agama'] = $this->agama->CurrentValue;
        $row['suku'] = $this->suku->CurrentValue;
        $row['bahasa'] = $this->bahasa->CurrentValue;
        $row['alamat'] = $this->alamat->CurrentValue;
        $row['rt'] = $this->rt->CurrentValue;
        $row['rw'] = $this->rw->CurrentValue;
        $row['keluarahan_desa'] = $this->keluarahan_desa->CurrentValue;
        $row['kecamatan'] = $this->kecamatan->CurrentValue;
        $row['kabupaten_kota'] = $this->kabupaten_kota->CurrentValue;
        $row['kodepos'] = $this->kodepos->CurrentValue;
        $row['provinsi'] = $this->provinsi->CurrentValue;
        $row['negara'] = $this->negara->CurrentValue;
        $row['alamat_domisili'] = $this->alamat_domisili->CurrentValue;
        $row['rt_domisili'] = $this->rt_domisili->CurrentValue;
        $row['rw_domisili'] = $this->rw_domisili->CurrentValue;
        $row['kel_desa_domisili'] = $this->kel_desa_domisili->CurrentValue;
        $row['kec_domisili'] = $this->kec_domisili->CurrentValue;
        $row['kota_kab_domisili'] = $this->kota_kab_domisili->CurrentValue;
        $row['kodepos_domisili'] = $this->kodepos_domisili->CurrentValue;
        $row['prov_domisili'] = $this->prov_domisili->CurrentValue;
        $row['negara_domisili'] = $this->negara_domisili->CurrentValue;
        $row['no_telp'] = $this->no_telp->CurrentValue;
        $row['no_hp'] = $this->no_hp->CurrentValue;
        $row['pendidikan'] = $this->pendidikan->CurrentValue;
        $row['pekerjaan'] = $this->pekerjaan->CurrentValue;
        $row['status_kawin'] = $this->status_kawin->CurrentValue;
        $row['tgl_daftar'] = $this->tgl_daftar->CurrentValue;
        $row['username'] = $this->_username->CurrentValue;
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

        // nama_pasien

        // no_rekam_medis

        // nik

        // no_identitas_lain

        // nama_ibu

        // tempat_lahir

        // tanggal_lahir

        // jenis_kelamin

        // agama

        // suku

        // bahasa

        // alamat

        // rt

        // rw

        // keluarahan_desa

        // kecamatan

        // kabupaten_kota

        // kodepos

        // provinsi

        // negara

        // alamat_domisili

        // rt_domisili

        // rw_domisili

        // kel_desa_domisili

        // kec_domisili

        // kota_kab_domisili

        // kodepos_domisili

        // prov_domisili

        // negara_domisili

        // no_telp

        // no_hp

        // pendidikan

        // pekerjaan

        // status_kawin

        // tgl_daftar

        // username
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_pasien
            $this->id_pasien->ViewValue = $this->id_pasien->CurrentValue;
            $this->id_pasien->ViewCustomAttributes = "";

            // nama_pasien
            $this->nama_pasien->ViewValue = $this->nama_pasien->CurrentValue;
            $this->nama_pasien->ViewCustomAttributes = "";

            // no_rekam_medis
            $this->no_rekam_medis->ViewValue = $this->no_rekam_medis->CurrentValue;
            $this->no_rekam_medis->ViewCustomAttributes = "";

            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewValue = FormatNumber($this->nik->ViewValue, 0, -2, -2, -2);
            $this->nik->ViewCustomAttributes = "";

            // no_identitas_lain
            $this->no_identitas_lain->ViewValue = $this->no_identitas_lain->CurrentValue;
            $this->no_identitas_lain->ViewCustomAttributes = "";

            // nama_ibu
            $this->nama_ibu->ViewValue = $this->nama_ibu->CurrentValue;
            $this->nama_ibu->ViewCustomAttributes = "";

            // tempat_lahir
            $this->tempat_lahir->ViewValue = $this->tempat_lahir->CurrentValue;
            $this->tempat_lahir->ViewCustomAttributes = "";

            // tanggal_lahir
            $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
            $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
            $this->tanggal_lahir->ViewCustomAttributes = "";

            // jenis_kelamin
            $this->jenis_kelamin->ViewValue = $this->jenis_kelamin->CurrentValue;
            $this->jenis_kelamin->ViewValue = FormatNumber($this->jenis_kelamin->ViewValue, 0, -2, -2, -2);
            $this->jenis_kelamin->ViewCustomAttributes = "";

            // agama
            $this->agama->ViewValue = $this->agama->CurrentValue;
            $this->agama->ViewValue = FormatNumber($this->agama->ViewValue, 0, -2, -2, -2);
            $this->agama->ViewCustomAttributes = "";

            // suku
            $this->suku->ViewValue = $this->suku->CurrentValue;
            $this->suku->ViewCustomAttributes = "";

            // bahasa
            $this->bahasa->ViewValue = $this->bahasa->CurrentValue;
            $this->bahasa->ViewValue = FormatNumber($this->bahasa->ViewValue, 0, -2, -2, -2);
            $this->bahasa->ViewCustomAttributes = "";

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;
            $this->alamat->ViewCustomAttributes = "";

            // rt
            $this->rt->ViewValue = $this->rt->CurrentValue;
            $this->rt->ViewValue = FormatNumber($this->rt->ViewValue, 0, -2, -2, -2);
            $this->rt->ViewCustomAttributes = "";

            // rw
            $this->rw->ViewValue = $this->rw->CurrentValue;
            $this->rw->ViewValue = FormatNumber($this->rw->ViewValue, 0, -2, -2, -2);
            $this->rw->ViewCustomAttributes = "";

            // keluarahan_desa
            $this->keluarahan_desa->ViewValue = $this->keluarahan_desa->CurrentValue;
            $this->keluarahan_desa->ViewCustomAttributes = "";

            // kecamatan
            $this->kecamatan->ViewValue = $this->kecamatan->CurrentValue;
            $this->kecamatan->ViewCustomAttributes = "";

            // kabupaten_kota
            $this->kabupaten_kota->ViewValue = $this->kabupaten_kota->CurrentValue;
            $this->kabupaten_kota->ViewCustomAttributes = "";

            // kodepos
            $this->kodepos->ViewValue = $this->kodepos->CurrentValue;
            $this->kodepos->ViewValue = FormatNumber($this->kodepos->ViewValue, 0, -2, -2, -2);
            $this->kodepos->ViewCustomAttributes = "";

            // provinsi
            $this->provinsi->ViewValue = $this->provinsi->CurrentValue;
            $this->provinsi->ViewCustomAttributes = "";

            // negara
            $this->negara->ViewValue = $this->negara->CurrentValue;
            $this->negara->ViewCustomAttributes = "";

            // alamat_domisili
            $this->alamat_domisili->ViewValue = $this->alamat_domisili->CurrentValue;
            $this->alamat_domisili->ViewCustomAttributes = "";

            // rt_domisili
            $this->rt_domisili->ViewValue = $this->rt_domisili->CurrentValue;
            $this->rt_domisili->ViewCustomAttributes = "";

            // rw_domisili
            $this->rw_domisili->ViewValue = $this->rw_domisili->CurrentValue;
            $this->rw_domisili->ViewCustomAttributes = "";

            // kel_desa_domisili
            $this->kel_desa_domisili->ViewValue = $this->kel_desa_domisili->CurrentValue;
            $this->kel_desa_domisili->ViewCustomAttributes = "";

            // kec_domisili
            $this->kec_domisili->ViewValue = $this->kec_domisili->CurrentValue;
            $this->kec_domisili->ViewCustomAttributes = "";

            // kota_kab_domisili
            $this->kota_kab_domisili->ViewValue = $this->kota_kab_domisili->CurrentValue;
            $this->kota_kab_domisili->ViewCustomAttributes = "";

            // kodepos_domisili
            $this->kodepos_domisili->ViewValue = $this->kodepos_domisili->CurrentValue;
            $this->kodepos_domisili->ViewCustomAttributes = "";

            // prov_domisili
            $this->prov_domisili->ViewValue = $this->prov_domisili->CurrentValue;
            $this->prov_domisili->ViewCustomAttributes = "";

            // negara_domisili
            $this->negara_domisili->ViewValue = $this->negara_domisili->CurrentValue;
            $this->negara_domisili->ViewCustomAttributes = "";

            // no_telp
            $this->no_telp->ViewValue = $this->no_telp->CurrentValue;
            $this->no_telp->ViewValue = FormatNumber($this->no_telp->ViewValue, 0, -2, -2, -2);
            $this->no_telp->ViewCustomAttributes = "";

            // no_hp
            $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
            $this->no_hp->ViewValue = FormatNumber($this->no_hp->ViewValue, 0, -2, -2, -2);
            $this->no_hp->ViewCustomAttributes = "";

            // pendidikan
            $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
            $this->pendidikan->ViewValue = FormatNumber($this->pendidikan->ViewValue, 0, -2, -2, -2);
            $this->pendidikan->ViewCustomAttributes = "";

            // pekerjaan
            $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
            $this->pekerjaan->ViewValue = FormatNumber($this->pekerjaan->ViewValue, 0, -2, -2, -2);
            $this->pekerjaan->ViewCustomAttributes = "";

            // status_kawin
            $this->status_kawin->ViewValue = $this->status_kawin->CurrentValue;
            $this->status_kawin->ViewValue = FormatNumber($this->status_kawin->ViewValue, 0, -2, -2, -2);
            $this->status_kawin->ViewCustomAttributes = "";

            // tgl_daftar
            $this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
            $this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
            $this->tgl_daftar->ViewCustomAttributes = "";

            // username
            $this->_username->ViewValue = $this->_username->CurrentValue;
            $this->_username->ViewCustomAttributes = "";

            // nama_pasien
            $this->nama_pasien->LinkCustomAttributes = "";
            $this->nama_pasien->HrefValue = "";
            $this->nama_pasien->TooltipValue = "";

            // no_rekam_medis
            $this->no_rekam_medis->LinkCustomAttributes = "";
            $this->no_rekam_medis->HrefValue = "";
            $this->no_rekam_medis->TooltipValue = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // no_identitas_lain
            $this->no_identitas_lain->LinkCustomAttributes = "";
            $this->no_identitas_lain->HrefValue = "";
            $this->no_identitas_lain->TooltipValue = "";

            // nama_ibu
            $this->nama_ibu->LinkCustomAttributes = "";
            $this->nama_ibu->HrefValue = "";
            $this->nama_ibu->TooltipValue = "";

            // tempat_lahir
            $this->tempat_lahir->LinkCustomAttributes = "";
            $this->tempat_lahir->HrefValue = "";
            $this->tempat_lahir->TooltipValue = "";

            // tanggal_lahir
            $this->tanggal_lahir->LinkCustomAttributes = "";
            $this->tanggal_lahir->HrefValue = "";
            $this->tanggal_lahir->TooltipValue = "";

            // jenis_kelamin
            $this->jenis_kelamin->LinkCustomAttributes = "";
            $this->jenis_kelamin->HrefValue = "";
            $this->jenis_kelamin->TooltipValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";
            $this->agama->TooltipValue = "";

            // suku
            $this->suku->LinkCustomAttributes = "";
            $this->suku->HrefValue = "";
            $this->suku->TooltipValue = "";

            // bahasa
            $this->bahasa->LinkCustomAttributes = "";
            $this->bahasa->HrefValue = "";
            $this->bahasa->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // rt
            $this->rt->LinkCustomAttributes = "";
            $this->rt->HrefValue = "";
            $this->rt->TooltipValue = "";

            // rw
            $this->rw->LinkCustomAttributes = "";
            $this->rw->HrefValue = "";
            $this->rw->TooltipValue = "";

            // keluarahan_desa
            $this->keluarahan_desa->LinkCustomAttributes = "";
            $this->keluarahan_desa->HrefValue = "";
            $this->keluarahan_desa->TooltipValue = "";

            // kecamatan
            $this->kecamatan->LinkCustomAttributes = "";
            $this->kecamatan->HrefValue = "";
            $this->kecamatan->TooltipValue = "";

            // kabupaten_kota
            $this->kabupaten_kota->LinkCustomAttributes = "";
            $this->kabupaten_kota->HrefValue = "";
            $this->kabupaten_kota->TooltipValue = "";

            // kodepos
            $this->kodepos->LinkCustomAttributes = "";
            $this->kodepos->HrefValue = "";
            $this->kodepos->TooltipValue = "";

            // provinsi
            $this->provinsi->LinkCustomAttributes = "";
            $this->provinsi->HrefValue = "";
            $this->provinsi->TooltipValue = "";

            // negara
            $this->negara->LinkCustomAttributes = "";
            $this->negara->HrefValue = "";
            $this->negara->TooltipValue = "";

            // alamat_domisili
            $this->alamat_domisili->LinkCustomAttributes = "";
            $this->alamat_domisili->HrefValue = "";
            $this->alamat_domisili->TooltipValue = "";

            // rt_domisili
            $this->rt_domisili->LinkCustomAttributes = "";
            $this->rt_domisili->HrefValue = "";
            $this->rt_domisili->TooltipValue = "";

            // rw_domisili
            $this->rw_domisili->LinkCustomAttributes = "";
            $this->rw_domisili->HrefValue = "";
            $this->rw_domisili->TooltipValue = "";

            // kel_desa_domisili
            $this->kel_desa_domisili->LinkCustomAttributes = "";
            $this->kel_desa_domisili->HrefValue = "";
            $this->kel_desa_domisili->TooltipValue = "";

            // kec_domisili
            $this->kec_domisili->LinkCustomAttributes = "";
            $this->kec_domisili->HrefValue = "";
            $this->kec_domisili->TooltipValue = "";

            // kota_kab_domisili
            $this->kota_kab_domisili->LinkCustomAttributes = "";
            $this->kota_kab_domisili->HrefValue = "";
            $this->kota_kab_domisili->TooltipValue = "";

            // kodepos_domisili
            $this->kodepos_domisili->LinkCustomAttributes = "";
            $this->kodepos_domisili->HrefValue = "";
            $this->kodepos_domisili->TooltipValue = "";

            // prov_domisili
            $this->prov_domisili->LinkCustomAttributes = "";
            $this->prov_domisili->HrefValue = "";
            $this->prov_domisili->TooltipValue = "";

            // negara_domisili
            $this->negara_domisili->LinkCustomAttributes = "";
            $this->negara_domisili->HrefValue = "";
            $this->negara_domisili->TooltipValue = "";

            // no_telp
            $this->no_telp->LinkCustomAttributes = "";
            $this->no_telp->HrefValue = "";
            $this->no_telp->TooltipValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";
            $this->no_hp->TooltipValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";
            $this->pendidikan->TooltipValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";
            $this->pekerjaan->TooltipValue = "";

            // status_kawin
            $this->status_kawin->LinkCustomAttributes = "";
            $this->status_kawin->HrefValue = "";
            $this->status_kawin->TooltipValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";
            $this->_username->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nama_pasien
            $this->nama_pasien->EditAttrs["class"] = "form-control";
            $this->nama_pasien->EditCustomAttributes = "";
            if (!$this->nama_pasien->Raw) {
                $this->nama_pasien->CurrentValue = HtmlDecode($this->nama_pasien->CurrentValue);
            }
            $this->nama_pasien->EditValue = HtmlEncode($this->nama_pasien->CurrentValue);
            $this->nama_pasien->PlaceHolder = RemoveHtml($this->nama_pasien->caption());

            // no_rekam_medis
            $this->no_rekam_medis->EditAttrs["class"] = "form-control";
            $this->no_rekam_medis->EditCustomAttributes = "";
            if (!$this->no_rekam_medis->Raw) {
                $this->no_rekam_medis->CurrentValue = HtmlDecode($this->no_rekam_medis->CurrentValue);
            }
            $this->no_rekam_medis->EditValue = HtmlEncode($this->no_rekam_medis->CurrentValue);
            $this->no_rekam_medis->PlaceHolder = RemoveHtml($this->no_rekam_medis->caption());

            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // no_identitas_lain
            $this->no_identitas_lain->EditAttrs["class"] = "form-control";
            $this->no_identitas_lain->EditCustomAttributes = "";
            if (!$this->no_identitas_lain->Raw) {
                $this->no_identitas_lain->CurrentValue = HtmlDecode($this->no_identitas_lain->CurrentValue);
            }
            $this->no_identitas_lain->EditValue = HtmlEncode($this->no_identitas_lain->CurrentValue);
            $this->no_identitas_lain->PlaceHolder = RemoveHtml($this->no_identitas_lain->caption());

            // nama_ibu
            $this->nama_ibu->EditAttrs["class"] = "form-control";
            $this->nama_ibu->EditCustomAttributes = "";
            if (!$this->nama_ibu->Raw) {
                $this->nama_ibu->CurrentValue = HtmlDecode($this->nama_ibu->CurrentValue);
            }
            $this->nama_ibu->EditValue = HtmlEncode($this->nama_ibu->CurrentValue);
            $this->nama_ibu->PlaceHolder = RemoveHtml($this->nama_ibu->caption());

            // tempat_lahir
            $this->tempat_lahir->EditAttrs["class"] = "form-control";
            $this->tempat_lahir->EditCustomAttributes = "";
            if (!$this->tempat_lahir->Raw) {
                $this->tempat_lahir->CurrentValue = HtmlDecode($this->tempat_lahir->CurrentValue);
            }
            $this->tempat_lahir->EditValue = HtmlEncode($this->tempat_lahir->CurrentValue);
            $this->tempat_lahir->PlaceHolder = RemoveHtml($this->tempat_lahir->caption());

            // tanggal_lahir
            $this->tanggal_lahir->EditAttrs["class"] = "form-control";
            $this->tanggal_lahir->EditCustomAttributes = "";
            $this->tanggal_lahir->EditValue = HtmlEncode(FormatDateTime($this->tanggal_lahir->CurrentValue, 8));
            $this->tanggal_lahir->PlaceHolder = RemoveHtml($this->tanggal_lahir->caption());

            // jenis_kelamin
            $this->jenis_kelamin->EditAttrs["class"] = "form-control";
            $this->jenis_kelamin->EditCustomAttributes = "";
            $this->jenis_kelamin->EditValue = HtmlEncode($this->jenis_kelamin->CurrentValue);
            $this->jenis_kelamin->PlaceHolder = RemoveHtml($this->jenis_kelamin->caption());

            // agama
            $this->agama->EditAttrs["class"] = "form-control";
            $this->agama->EditCustomAttributes = "";
            $this->agama->EditValue = HtmlEncode($this->agama->CurrentValue);
            $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

            // suku
            $this->suku->EditAttrs["class"] = "form-control";
            $this->suku->EditCustomAttributes = "";
            if (!$this->suku->Raw) {
                $this->suku->CurrentValue = HtmlDecode($this->suku->CurrentValue);
            }
            $this->suku->EditValue = HtmlEncode($this->suku->CurrentValue);
            $this->suku->PlaceHolder = RemoveHtml($this->suku->caption());

            // bahasa
            $this->bahasa->EditAttrs["class"] = "form-control";
            $this->bahasa->EditCustomAttributes = "";
            $this->bahasa->EditValue = HtmlEncode($this->bahasa->CurrentValue);
            $this->bahasa->PlaceHolder = RemoveHtml($this->bahasa->caption());

            // alamat
            $this->alamat->EditAttrs["class"] = "form-control";
            $this->alamat->EditCustomAttributes = "";
            if (!$this->alamat->Raw) {
                $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
            }
            $this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
            $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

            // rt
            $this->rt->EditAttrs["class"] = "form-control";
            $this->rt->EditCustomAttributes = "";
            $this->rt->EditValue = HtmlEncode($this->rt->CurrentValue);
            $this->rt->PlaceHolder = RemoveHtml($this->rt->caption());

            // rw
            $this->rw->EditAttrs["class"] = "form-control";
            $this->rw->EditCustomAttributes = "";
            $this->rw->EditValue = HtmlEncode($this->rw->CurrentValue);
            $this->rw->PlaceHolder = RemoveHtml($this->rw->caption());

            // keluarahan_desa
            $this->keluarahan_desa->EditAttrs["class"] = "form-control";
            $this->keluarahan_desa->EditCustomAttributes = "";
            if (!$this->keluarahan_desa->Raw) {
                $this->keluarahan_desa->CurrentValue = HtmlDecode($this->keluarahan_desa->CurrentValue);
            }
            $this->keluarahan_desa->EditValue = HtmlEncode($this->keluarahan_desa->CurrentValue);
            $this->keluarahan_desa->PlaceHolder = RemoveHtml($this->keluarahan_desa->caption());

            // kecamatan
            $this->kecamatan->EditAttrs["class"] = "form-control";
            $this->kecamatan->EditCustomAttributes = "";
            if (!$this->kecamatan->Raw) {
                $this->kecamatan->CurrentValue = HtmlDecode($this->kecamatan->CurrentValue);
            }
            $this->kecamatan->EditValue = HtmlEncode($this->kecamatan->CurrentValue);
            $this->kecamatan->PlaceHolder = RemoveHtml($this->kecamatan->caption());

            // kabupaten_kota
            $this->kabupaten_kota->EditAttrs["class"] = "form-control";
            $this->kabupaten_kota->EditCustomAttributes = "";
            if (!$this->kabupaten_kota->Raw) {
                $this->kabupaten_kota->CurrentValue = HtmlDecode($this->kabupaten_kota->CurrentValue);
            }
            $this->kabupaten_kota->EditValue = HtmlEncode($this->kabupaten_kota->CurrentValue);
            $this->kabupaten_kota->PlaceHolder = RemoveHtml($this->kabupaten_kota->caption());

            // kodepos
            $this->kodepos->EditAttrs["class"] = "form-control";
            $this->kodepos->EditCustomAttributes = "";
            $this->kodepos->EditValue = HtmlEncode($this->kodepos->CurrentValue);
            $this->kodepos->PlaceHolder = RemoveHtml($this->kodepos->caption());

            // provinsi
            $this->provinsi->EditAttrs["class"] = "form-control";
            $this->provinsi->EditCustomAttributes = "";
            if (!$this->provinsi->Raw) {
                $this->provinsi->CurrentValue = HtmlDecode($this->provinsi->CurrentValue);
            }
            $this->provinsi->EditValue = HtmlEncode($this->provinsi->CurrentValue);
            $this->provinsi->PlaceHolder = RemoveHtml($this->provinsi->caption());

            // negara
            $this->negara->EditAttrs["class"] = "form-control";
            $this->negara->EditCustomAttributes = "";
            if (!$this->negara->Raw) {
                $this->negara->CurrentValue = HtmlDecode($this->negara->CurrentValue);
            }
            $this->negara->EditValue = HtmlEncode($this->negara->CurrentValue);
            $this->negara->PlaceHolder = RemoveHtml($this->negara->caption());

            // alamat_domisili
            $this->alamat_domisili->EditAttrs["class"] = "form-control";
            $this->alamat_domisili->EditCustomAttributes = "";
            if (!$this->alamat_domisili->Raw) {
                $this->alamat_domisili->CurrentValue = HtmlDecode($this->alamat_domisili->CurrentValue);
            }
            $this->alamat_domisili->EditValue = HtmlEncode($this->alamat_domisili->CurrentValue);
            $this->alamat_domisili->PlaceHolder = RemoveHtml($this->alamat_domisili->caption());

            // rt_domisili
            $this->rt_domisili->EditAttrs["class"] = "form-control";
            $this->rt_domisili->EditCustomAttributes = "";
            if (!$this->rt_domisili->Raw) {
                $this->rt_domisili->CurrentValue = HtmlDecode($this->rt_domisili->CurrentValue);
            }
            $this->rt_domisili->EditValue = HtmlEncode($this->rt_domisili->CurrentValue);
            $this->rt_domisili->PlaceHolder = RemoveHtml($this->rt_domisili->caption());

            // rw_domisili
            $this->rw_domisili->EditAttrs["class"] = "form-control";
            $this->rw_domisili->EditCustomAttributes = "";
            if (!$this->rw_domisili->Raw) {
                $this->rw_domisili->CurrentValue = HtmlDecode($this->rw_domisili->CurrentValue);
            }
            $this->rw_domisili->EditValue = HtmlEncode($this->rw_domisili->CurrentValue);
            $this->rw_domisili->PlaceHolder = RemoveHtml($this->rw_domisili->caption());

            // kel_desa_domisili
            $this->kel_desa_domisili->EditAttrs["class"] = "form-control";
            $this->kel_desa_domisili->EditCustomAttributes = "";
            if (!$this->kel_desa_domisili->Raw) {
                $this->kel_desa_domisili->CurrentValue = HtmlDecode($this->kel_desa_domisili->CurrentValue);
            }
            $this->kel_desa_domisili->EditValue = HtmlEncode($this->kel_desa_domisili->CurrentValue);
            $this->kel_desa_domisili->PlaceHolder = RemoveHtml($this->kel_desa_domisili->caption());

            // kec_domisili
            $this->kec_domisili->EditAttrs["class"] = "form-control";
            $this->kec_domisili->EditCustomAttributes = "";
            if (!$this->kec_domisili->Raw) {
                $this->kec_domisili->CurrentValue = HtmlDecode($this->kec_domisili->CurrentValue);
            }
            $this->kec_domisili->EditValue = HtmlEncode($this->kec_domisili->CurrentValue);
            $this->kec_domisili->PlaceHolder = RemoveHtml($this->kec_domisili->caption());

            // kota_kab_domisili
            $this->kota_kab_domisili->EditAttrs["class"] = "form-control";
            $this->kota_kab_domisili->EditCustomAttributes = "";
            if (!$this->kota_kab_domisili->Raw) {
                $this->kota_kab_domisili->CurrentValue = HtmlDecode($this->kota_kab_domisili->CurrentValue);
            }
            $this->kota_kab_domisili->EditValue = HtmlEncode($this->kota_kab_domisili->CurrentValue);
            $this->kota_kab_domisili->PlaceHolder = RemoveHtml($this->kota_kab_domisili->caption());

            // kodepos_domisili
            $this->kodepos_domisili->EditAttrs["class"] = "form-control";
            $this->kodepos_domisili->EditCustomAttributes = "";
            if (!$this->kodepos_domisili->Raw) {
                $this->kodepos_domisili->CurrentValue = HtmlDecode($this->kodepos_domisili->CurrentValue);
            }
            $this->kodepos_domisili->EditValue = HtmlEncode($this->kodepos_domisili->CurrentValue);
            $this->kodepos_domisili->PlaceHolder = RemoveHtml($this->kodepos_domisili->caption());

            // prov_domisili
            $this->prov_domisili->EditAttrs["class"] = "form-control";
            $this->prov_domisili->EditCustomAttributes = "";
            if (!$this->prov_domisili->Raw) {
                $this->prov_domisili->CurrentValue = HtmlDecode($this->prov_domisili->CurrentValue);
            }
            $this->prov_domisili->EditValue = HtmlEncode($this->prov_domisili->CurrentValue);
            $this->prov_domisili->PlaceHolder = RemoveHtml($this->prov_domisili->caption());

            // negara_domisili
            $this->negara_domisili->EditAttrs["class"] = "form-control";
            $this->negara_domisili->EditCustomAttributes = "";
            if (!$this->negara_domisili->Raw) {
                $this->negara_domisili->CurrentValue = HtmlDecode($this->negara_domisili->CurrentValue);
            }
            $this->negara_domisili->EditValue = HtmlEncode($this->negara_domisili->CurrentValue);
            $this->negara_domisili->PlaceHolder = RemoveHtml($this->negara_domisili->caption());

            // no_telp
            $this->no_telp->EditAttrs["class"] = "form-control";
            $this->no_telp->EditCustomAttributes = "";
            $this->no_telp->EditValue = HtmlEncode($this->no_telp->CurrentValue);
            $this->no_telp->PlaceHolder = RemoveHtml($this->no_telp->caption());

            // no_hp
            $this->no_hp->EditAttrs["class"] = "form-control";
            $this->no_hp->EditCustomAttributes = "";
            $this->no_hp->EditValue = HtmlEncode($this->no_hp->CurrentValue);
            $this->no_hp->PlaceHolder = RemoveHtml($this->no_hp->caption());

            // pendidikan
            $this->pendidikan->EditAttrs["class"] = "form-control";
            $this->pendidikan->EditCustomAttributes = "";
            $this->pendidikan->EditValue = HtmlEncode($this->pendidikan->CurrentValue);
            $this->pendidikan->PlaceHolder = RemoveHtml($this->pendidikan->caption());

            // pekerjaan
            $this->pekerjaan->EditAttrs["class"] = "form-control";
            $this->pekerjaan->EditCustomAttributes = "";
            $this->pekerjaan->EditValue = HtmlEncode($this->pekerjaan->CurrentValue);
            $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

            // status_kawin
            $this->status_kawin->EditAttrs["class"] = "form-control";
            $this->status_kawin->EditCustomAttributes = "";
            $this->status_kawin->EditValue = HtmlEncode($this->status_kawin->CurrentValue);
            $this->status_kawin->PlaceHolder = RemoveHtml($this->status_kawin->caption());

            // tgl_daftar
            $this->tgl_daftar->EditAttrs["class"] = "form-control";
            $this->tgl_daftar->EditCustomAttributes = "";
            $this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime($this->tgl_daftar->CurrentValue, 8));
            $this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

            // username
            $this->_username->EditAttrs["class"] = "form-control";
            $this->_username->EditCustomAttributes = "";
            if (!$this->_username->Raw) {
                $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
            }
            $this->_username->EditValue = HtmlEncode($this->_username->CurrentValue);
            $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());

            // Add refer script

            // nama_pasien
            $this->nama_pasien->LinkCustomAttributes = "";
            $this->nama_pasien->HrefValue = "";

            // no_rekam_medis
            $this->no_rekam_medis->LinkCustomAttributes = "";
            $this->no_rekam_medis->HrefValue = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // no_identitas_lain
            $this->no_identitas_lain->LinkCustomAttributes = "";
            $this->no_identitas_lain->HrefValue = "";

            // nama_ibu
            $this->nama_ibu->LinkCustomAttributes = "";
            $this->nama_ibu->HrefValue = "";

            // tempat_lahir
            $this->tempat_lahir->LinkCustomAttributes = "";
            $this->tempat_lahir->HrefValue = "";

            // tanggal_lahir
            $this->tanggal_lahir->LinkCustomAttributes = "";
            $this->tanggal_lahir->HrefValue = "";

            // jenis_kelamin
            $this->jenis_kelamin->LinkCustomAttributes = "";
            $this->jenis_kelamin->HrefValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";

            // suku
            $this->suku->LinkCustomAttributes = "";
            $this->suku->HrefValue = "";

            // bahasa
            $this->bahasa->LinkCustomAttributes = "";
            $this->bahasa->HrefValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";

            // rt
            $this->rt->LinkCustomAttributes = "";
            $this->rt->HrefValue = "";

            // rw
            $this->rw->LinkCustomAttributes = "";
            $this->rw->HrefValue = "";

            // keluarahan_desa
            $this->keluarahan_desa->LinkCustomAttributes = "";
            $this->keluarahan_desa->HrefValue = "";

            // kecamatan
            $this->kecamatan->LinkCustomAttributes = "";
            $this->kecamatan->HrefValue = "";

            // kabupaten_kota
            $this->kabupaten_kota->LinkCustomAttributes = "";
            $this->kabupaten_kota->HrefValue = "";

            // kodepos
            $this->kodepos->LinkCustomAttributes = "";
            $this->kodepos->HrefValue = "";

            // provinsi
            $this->provinsi->LinkCustomAttributes = "";
            $this->provinsi->HrefValue = "";

            // negara
            $this->negara->LinkCustomAttributes = "";
            $this->negara->HrefValue = "";

            // alamat_domisili
            $this->alamat_domisili->LinkCustomAttributes = "";
            $this->alamat_domisili->HrefValue = "";

            // rt_domisili
            $this->rt_domisili->LinkCustomAttributes = "";
            $this->rt_domisili->HrefValue = "";

            // rw_domisili
            $this->rw_domisili->LinkCustomAttributes = "";
            $this->rw_domisili->HrefValue = "";

            // kel_desa_domisili
            $this->kel_desa_domisili->LinkCustomAttributes = "";
            $this->kel_desa_domisili->HrefValue = "";

            // kec_domisili
            $this->kec_domisili->LinkCustomAttributes = "";
            $this->kec_domisili->HrefValue = "";

            // kota_kab_domisili
            $this->kota_kab_domisili->LinkCustomAttributes = "";
            $this->kota_kab_domisili->HrefValue = "";

            // kodepos_domisili
            $this->kodepos_domisili->LinkCustomAttributes = "";
            $this->kodepos_domisili->HrefValue = "";

            // prov_domisili
            $this->prov_domisili->LinkCustomAttributes = "";
            $this->prov_domisili->HrefValue = "";

            // negara_domisili
            $this->negara_domisili->LinkCustomAttributes = "";
            $this->negara_domisili->HrefValue = "";

            // no_telp
            $this->no_telp->LinkCustomAttributes = "";
            $this->no_telp->HrefValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";

            // status_kawin
            $this->status_kawin->LinkCustomAttributes = "";
            $this->status_kawin->HrefValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";
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
        if ($this->nama_pasien->Required) {
            if (!$this->nama_pasien->IsDetailKey && EmptyValue($this->nama_pasien->FormValue)) {
                $this->nama_pasien->addErrorMessage(str_replace("%s", $this->nama_pasien->caption(), $this->nama_pasien->RequiredErrorMessage));
            }
        }
        if ($this->no_rekam_medis->Required) {
            if (!$this->no_rekam_medis->IsDetailKey && EmptyValue($this->no_rekam_medis->FormValue)) {
                $this->no_rekam_medis->addErrorMessage(str_replace("%s", $this->no_rekam_medis->caption(), $this->no_rekam_medis->RequiredErrorMessage));
            }
        }
        if ($this->nik->Required) {
            if (!$this->nik->IsDetailKey && EmptyValue($this->nik->FormValue)) {
                $this->nik->addErrorMessage(str_replace("%s", $this->nik->caption(), $this->nik->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->nik->FormValue)) {
            $this->nik->addErrorMessage($this->nik->getErrorMessage(false));
        }
        if ($this->no_identitas_lain->Required) {
            if (!$this->no_identitas_lain->IsDetailKey && EmptyValue($this->no_identitas_lain->FormValue)) {
                $this->no_identitas_lain->addErrorMessage(str_replace("%s", $this->no_identitas_lain->caption(), $this->no_identitas_lain->RequiredErrorMessage));
            }
        }
        if ($this->nama_ibu->Required) {
            if (!$this->nama_ibu->IsDetailKey && EmptyValue($this->nama_ibu->FormValue)) {
                $this->nama_ibu->addErrorMessage(str_replace("%s", $this->nama_ibu->caption(), $this->nama_ibu->RequiredErrorMessage));
            }
        }
        if ($this->tempat_lahir->Required) {
            if (!$this->tempat_lahir->IsDetailKey && EmptyValue($this->tempat_lahir->FormValue)) {
                $this->tempat_lahir->addErrorMessage(str_replace("%s", $this->tempat_lahir->caption(), $this->tempat_lahir->RequiredErrorMessage));
            }
        }
        if ($this->tanggal_lahir->Required) {
            if (!$this->tanggal_lahir->IsDetailKey && EmptyValue($this->tanggal_lahir->FormValue)) {
                $this->tanggal_lahir->addErrorMessage(str_replace("%s", $this->tanggal_lahir->caption(), $this->tanggal_lahir->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal_lahir->FormValue)) {
            $this->tanggal_lahir->addErrorMessage($this->tanggal_lahir->getErrorMessage(false));
        }
        if ($this->jenis_kelamin->Required) {
            if (!$this->jenis_kelamin->IsDetailKey && EmptyValue($this->jenis_kelamin->FormValue)) {
                $this->jenis_kelamin->addErrorMessage(str_replace("%s", $this->jenis_kelamin->caption(), $this->jenis_kelamin->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jenis_kelamin->FormValue)) {
            $this->jenis_kelamin->addErrorMessage($this->jenis_kelamin->getErrorMessage(false));
        }
        if ($this->agama->Required) {
            if (!$this->agama->IsDetailKey && EmptyValue($this->agama->FormValue)) {
                $this->agama->addErrorMessage(str_replace("%s", $this->agama->caption(), $this->agama->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->agama->FormValue)) {
            $this->agama->addErrorMessage($this->agama->getErrorMessage(false));
        }
        if ($this->suku->Required) {
            if (!$this->suku->IsDetailKey && EmptyValue($this->suku->FormValue)) {
                $this->suku->addErrorMessage(str_replace("%s", $this->suku->caption(), $this->suku->RequiredErrorMessage));
            }
        }
        if ($this->bahasa->Required) {
            if (!$this->bahasa->IsDetailKey && EmptyValue($this->bahasa->FormValue)) {
                $this->bahasa->addErrorMessage(str_replace("%s", $this->bahasa->caption(), $this->bahasa->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->bahasa->FormValue)) {
            $this->bahasa->addErrorMessage($this->bahasa->getErrorMessage(false));
        }
        if ($this->alamat->Required) {
            if (!$this->alamat->IsDetailKey && EmptyValue($this->alamat->FormValue)) {
                $this->alamat->addErrorMessage(str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
            }
        }
        if ($this->rt->Required) {
            if (!$this->rt->IsDetailKey && EmptyValue($this->rt->FormValue)) {
                $this->rt->addErrorMessage(str_replace("%s", $this->rt->caption(), $this->rt->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->rt->FormValue)) {
            $this->rt->addErrorMessage($this->rt->getErrorMessage(false));
        }
        if ($this->rw->Required) {
            if (!$this->rw->IsDetailKey && EmptyValue($this->rw->FormValue)) {
                $this->rw->addErrorMessage(str_replace("%s", $this->rw->caption(), $this->rw->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->rw->FormValue)) {
            $this->rw->addErrorMessage($this->rw->getErrorMessage(false));
        }
        if ($this->keluarahan_desa->Required) {
            if (!$this->keluarahan_desa->IsDetailKey && EmptyValue($this->keluarahan_desa->FormValue)) {
                $this->keluarahan_desa->addErrorMessage(str_replace("%s", $this->keluarahan_desa->caption(), $this->keluarahan_desa->RequiredErrorMessage));
            }
        }
        if ($this->kecamatan->Required) {
            if (!$this->kecamatan->IsDetailKey && EmptyValue($this->kecamatan->FormValue)) {
                $this->kecamatan->addErrorMessage(str_replace("%s", $this->kecamatan->caption(), $this->kecamatan->RequiredErrorMessage));
            }
        }
        if ($this->kabupaten_kota->Required) {
            if (!$this->kabupaten_kota->IsDetailKey && EmptyValue($this->kabupaten_kota->FormValue)) {
                $this->kabupaten_kota->addErrorMessage(str_replace("%s", $this->kabupaten_kota->caption(), $this->kabupaten_kota->RequiredErrorMessage));
            }
        }
        if ($this->kodepos->Required) {
            if (!$this->kodepos->IsDetailKey && EmptyValue($this->kodepos->FormValue)) {
                $this->kodepos->addErrorMessage(str_replace("%s", $this->kodepos->caption(), $this->kodepos->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->kodepos->FormValue)) {
            $this->kodepos->addErrorMessage($this->kodepos->getErrorMessage(false));
        }
        if ($this->provinsi->Required) {
            if (!$this->provinsi->IsDetailKey && EmptyValue($this->provinsi->FormValue)) {
                $this->provinsi->addErrorMessage(str_replace("%s", $this->provinsi->caption(), $this->provinsi->RequiredErrorMessage));
            }
        }
        if ($this->negara->Required) {
            if (!$this->negara->IsDetailKey && EmptyValue($this->negara->FormValue)) {
                $this->negara->addErrorMessage(str_replace("%s", $this->negara->caption(), $this->negara->RequiredErrorMessage));
            }
        }
        if ($this->alamat_domisili->Required) {
            if (!$this->alamat_domisili->IsDetailKey && EmptyValue($this->alamat_domisili->FormValue)) {
                $this->alamat_domisili->addErrorMessage(str_replace("%s", $this->alamat_domisili->caption(), $this->alamat_domisili->RequiredErrorMessage));
            }
        }
        if ($this->rt_domisili->Required) {
            if (!$this->rt_domisili->IsDetailKey && EmptyValue($this->rt_domisili->FormValue)) {
                $this->rt_domisili->addErrorMessage(str_replace("%s", $this->rt_domisili->caption(), $this->rt_domisili->RequiredErrorMessage));
            }
        }
        if ($this->rw_domisili->Required) {
            if (!$this->rw_domisili->IsDetailKey && EmptyValue($this->rw_domisili->FormValue)) {
                $this->rw_domisili->addErrorMessage(str_replace("%s", $this->rw_domisili->caption(), $this->rw_domisili->RequiredErrorMessage));
            }
        }
        if ($this->kel_desa_domisili->Required) {
            if (!$this->kel_desa_domisili->IsDetailKey && EmptyValue($this->kel_desa_domisili->FormValue)) {
                $this->kel_desa_domisili->addErrorMessage(str_replace("%s", $this->kel_desa_domisili->caption(), $this->kel_desa_domisili->RequiredErrorMessage));
            }
        }
        if ($this->kec_domisili->Required) {
            if (!$this->kec_domisili->IsDetailKey && EmptyValue($this->kec_domisili->FormValue)) {
                $this->kec_domisili->addErrorMessage(str_replace("%s", $this->kec_domisili->caption(), $this->kec_domisili->RequiredErrorMessage));
            }
        }
        if ($this->kota_kab_domisili->Required) {
            if (!$this->kota_kab_domisili->IsDetailKey && EmptyValue($this->kota_kab_domisili->FormValue)) {
                $this->kota_kab_domisili->addErrorMessage(str_replace("%s", $this->kota_kab_domisili->caption(), $this->kota_kab_domisili->RequiredErrorMessage));
            }
        }
        if ($this->kodepos_domisili->Required) {
            if (!$this->kodepos_domisili->IsDetailKey && EmptyValue($this->kodepos_domisili->FormValue)) {
                $this->kodepos_domisili->addErrorMessage(str_replace("%s", $this->kodepos_domisili->caption(), $this->kodepos_domisili->RequiredErrorMessage));
            }
        }
        if ($this->prov_domisili->Required) {
            if (!$this->prov_domisili->IsDetailKey && EmptyValue($this->prov_domisili->FormValue)) {
                $this->prov_domisili->addErrorMessage(str_replace("%s", $this->prov_domisili->caption(), $this->prov_domisili->RequiredErrorMessage));
            }
        }
        if ($this->negara_domisili->Required) {
            if (!$this->negara_domisili->IsDetailKey && EmptyValue($this->negara_domisili->FormValue)) {
                $this->negara_domisili->addErrorMessage(str_replace("%s", $this->negara_domisili->caption(), $this->negara_domisili->RequiredErrorMessage));
            }
        }
        if ($this->no_telp->Required) {
            if (!$this->no_telp->IsDetailKey && EmptyValue($this->no_telp->FormValue)) {
                $this->no_telp->addErrorMessage(str_replace("%s", $this->no_telp->caption(), $this->no_telp->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->no_telp->FormValue)) {
            $this->no_telp->addErrorMessage($this->no_telp->getErrorMessage(false));
        }
        if ($this->no_hp->Required) {
            if (!$this->no_hp->IsDetailKey && EmptyValue($this->no_hp->FormValue)) {
                $this->no_hp->addErrorMessage(str_replace("%s", $this->no_hp->caption(), $this->no_hp->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->no_hp->FormValue)) {
            $this->no_hp->addErrorMessage($this->no_hp->getErrorMessage(false));
        }
        if ($this->pendidikan->Required) {
            if (!$this->pendidikan->IsDetailKey && EmptyValue($this->pendidikan->FormValue)) {
                $this->pendidikan->addErrorMessage(str_replace("%s", $this->pendidikan->caption(), $this->pendidikan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pendidikan->FormValue)) {
            $this->pendidikan->addErrorMessage($this->pendidikan->getErrorMessage(false));
        }
        if ($this->pekerjaan->Required) {
            if (!$this->pekerjaan->IsDetailKey && EmptyValue($this->pekerjaan->FormValue)) {
                $this->pekerjaan->addErrorMessage(str_replace("%s", $this->pekerjaan->caption(), $this->pekerjaan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pekerjaan->FormValue)) {
            $this->pekerjaan->addErrorMessage($this->pekerjaan->getErrorMessage(false));
        }
        if ($this->status_kawin->Required) {
            if (!$this->status_kawin->IsDetailKey && EmptyValue($this->status_kawin->FormValue)) {
                $this->status_kawin->addErrorMessage(str_replace("%s", $this->status_kawin->caption(), $this->status_kawin->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->status_kawin->FormValue)) {
            $this->status_kawin->addErrorMessage($this->status_kawin->getErrorMessage(false));
        }
        if ($this->tgl_daftar->Required) {
            if (!$this->tgl_daftar->IsDetailKey && EmptyValue($this->tgl_daftar->FormValue)) {
                $this->tgl_daftar->addErrorMessage(str_replace("%s", $this->tgl_daftar->caption(), $this->tgl_daftar->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_daftar->FormValue)) {
            $this->tgl_daftar->addErrorMessage($this->tgl_daftar->getErrorMessage(false));
        }
        if ($this->_username->Required) {
            if (!$this->_username->IsDetailKey && EmptyValue($this->_username->FormValue)) {
                $this->_username->addErrorMessage(str_replace("%s", $this->_username->caption(), $this->_username->RequiredErrorMessage));
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

        // nama_pasien
        $this->nama_pasien->setDbValueDef($rsnew, $this->nama_pasien->CurrentValue, null, false);

        // no_rekam_medis
        $this->no_rekam_medis->setDbValueDef($rsnew, $this->no_rekam_medis->CurrentValue, null, false);

        // nik
        $this->nik->setDbValueDef($rsnew, $this->nik->CurrentValue, null, false);

        // no_identitas_lain
        $this->no_identitas_lain->setDbValueDef($rsnew, $this->no_identitas_lain->CurrentValue, null, false);

        // nama_ibu
        $this->nama_ibu->setDbValueDef($rsnew, $this->nama_ibu->CurrentValue, null, false);

        // tempat_lahir
        $this->tempat_lahir->setDbValueDef($rsnew, $this->tempat_lahir->CurrentValue, null, false);

        // tanggal_lahir
        $this->tanggal_lahir->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_lahir->CurrentValue, 0), null, false);

        // jenis_kelamin
        $this->jenis_kelamin->setDbValueDef($rsnew, $this->jenis_kelamin->CurrentValue, null, false);

        // agama
        $this->agama->setDbValueDef($rsnew, $this->agama->CurrentValue, null, false);

        // suku
        $this->suku->setDbValueDef($rsnew, $this->suku->CurrentValue, null, false);

        // bahasa
        $this->bahasa->setDbValueDef($rsnew, $this->bahasa->CurrentValue, null, false);

        // alamat
        $this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, null, false);

        // rt
        $this->rt->setDbValueDef($rsnew, $this->rt->CurrentValue, null, false);

        // rw
        $this->rw->setDbValueDef($rsnew, $this->rw->CurrentValue, null, false);

        // keluarahan_desa
        $this->keluarahan_desa->setDbValueDef($rsnew, $this->keluarahan_desa->CurrentValue, null, false);

        // kecamatan
        $this->kecamatan->setDbValueDef($rsnew, $this->kecamatan->CurrentValue, null, false);

        // kabupaten_kota
        $this->kabupaten_kota->setDbValueDef($rsnew, $this->kabupaten_kota->CurrentValue, null, false);

        // kodepos
        $this->kodepos->setDbValueDef($rsnew, $this->kodepos->CurrentValue, null, false);

        // provinsi
        $this->provinsi->setDbValueDef($rsnew, $this->provinsi->CurrentValue, null, false);

        // negara
        $this->negara->setDbValueDef($rsnew, $this->negara->CurrentValue, null, false);

        // alamat_domisili
        $this->alamat_domisili->setDbValueDef($rsnew, $this->alamat_domisili->CurrentValue, null, false);

        // rt_domisili
        $this->rt_domisili->setDbValueDef($rsnew, $this->rt_domisili->CurrentValue, null, false);

        // rw_domisili
        $this->rw_domisili->setDbValueDef($rsnew, $this->rw_domisili->CurrentValue, null, false);

        // kel_desa_domisili
        $this->kel_desa_domisili->setDbValueDef($rsnew, $this->kel_desa_domisili->CurrentValue, null, false);

        // kec_domisili
        $this->kec_domisili->setDbValueDef($rsnew, $this->kec_domisili->CurrentValue, null, false);

        // kota_kab_domisili
        $this->kota_kab_domisili->setDbValueDef($rsnew, $this->kota_kab_domisili->CurrentValue, null, false);

        // kodepos_domisili
        $this->kodepos_domisili->setDbValueDef($rsnew, $this->kodepos_domisili->CurrentValue, null, false);

        // prov_domisili
        $this->prov_domisili->setDbValueDef($rsnew, $this->prov_domisili->CurrentValue, null, false);

        // negara_domisili
        $this->negara_domisili->setDbValueDef($rsnew, $this->negara_domisili->CurrentValue, null, false);

        // no_telp
        $this->no_telp->setDbValueDef($rsnew, $this->no_telp->CurrentValue, null, false);

        // no_hp
        $this->no_hp->setDbValueDef($rsnew, $this->no_hp->CurrentValue, null, false);

        // pendidikan
        $this->pendidikan->setDbValueDef($rsnew, $this->pendidikan->CurrentValue, null, false);

        // pekerjaan
        $this->pekerjaan->setDbValueDef($rsnew, $this->pekerjaan->CurrentValue, null, false);

        // status_kawin
        $this->status_kawin->setDbValueDef($rsnew, $this->status_kawin->CurrentValue, null, false);

        // tgl_daftar
        $this->tgl_daftar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_daftar->CurrentValue, 0), null, false);

        // username
        $this->_username->setDbValueDef($rsnew, $this->_username->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MasterPasienList"), "", $this->TableVar, true);
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
