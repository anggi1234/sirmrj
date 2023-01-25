<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianAwalKeperawatanRalanAdd extends PenilaianAwalKeperawatanRalan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_awal_keperawatan_ralan';

    // Page object name
    public $PageObjName = "PenilaianAwalKeperawatanRalanAdd";

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

        // Table object (penilaian_awal_keperawatan_ralan)
        if (!isset($GLOBALS["penilaian_awal_keperawatan_ralan"]) || get_class($GLOBALS["penilaian_awal_keperawatan_ralan"]) == PROJECT_NAMESPACE . "penilaian_awal_keperawatan_ralan") {
            $GLOBALS["penilaian_awal_keperawatan_ralan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penilaian_awal_keperawatan_ralan');
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
                $doc = new $class(Container("penilaian_awal_keperawatan_ralan"));
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
                    if ($pageName == "PenilaianAwalKeperawatanRalanView") {
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
            $key .= @$ar['id_penilaian_awal_keperawatan'];
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
            $this->id_penilaian_awal_keperawatan->Visible = false;
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
        $this->no_rawat->Visible = false;
        $this->tanggal->setVisibility();
        $this->informasi->setVisibility();
        $this->td->setVisibility();
        $this->nadi->setVisibility();
        $this->rr->setVisibility();
        $this->suhu->setVisibility();
        $this->gcs->setVisibility();
        $this->bb->setVisibility();
        $this->tb->setVisibility();
        $this->bmi->setVisibility();
        $this->keluhan_utama->setVisibility();
        $this->rpd->setVisibility();
        $this->rpk->setVisibility();
        $this->rpo->setVisibility();
        $this->alergi->setVisibility();
        $this->alat_bantu->setVisibility();
        $this->ket_bantu->setVisibility();
        $this->prothesa->setVisibility();
        $this->ket_pro->setVisibility();
        $this->adl->setVisibility();
        $this->status_psiko->setVisibility();
        $this->ket_psiko->setVisibility();
        $this->hub_keluarga->setVisibility();
        $this->tinggal_dengan->setVisibility();
        $this->ket_tinggal->setVisibility();
        $this->ekonomi->setVisibility();
        $this->budaya->setVisibility();
        $this->ket_budaya->setVisibility();
        $this->edukasi->setVisibility();
        $this->ket_edukasi->setVisibility();
        $this->berjalan_a->setVisibility();
        $this->berjalan_b->setVisibility();
        $this->berjalan_c->setVisibility();
        $this->hasil->setVisibility();
        $this->lapor->setVisibility();
        $this->ket_lapor->setVisibility();
        $this->sg1->setVisibility();
        $this->nilai1->setVisibility();
        $this->sg2->setVisibility();
        $this->nilai2->setVisibility();
        $this->total_hasil->setVisibility();
        $this->nyeri->setVisibility();
        $this->provokes->setVisibility();
        $this->ket_provokes->setVisibility();
        $this->quality->setVisibility();
        $this->ket_quality->setVisibility();
        $this->lokasi->setVisibility();
        $this->menyebar->setVisibility();
        $this->skala_nyeri->setVisibility();
        $this->durasi->setVisibility();
        $this->nyeri_hilang->setVisibility();
        $this->ket_nyeri->setVisibility();
        $this->pada_dokter->setVisibility();
        $this->ket_dokter->setVisibility();
        $this->rencana->setVisibility();
        $this->nip->setVisibility();
        $this->id_penilaian_awal_keperawatan->Visible = false;
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
            if (($keyValue = Get("id_penilaian_awal_keperawatan") ?? Route("id_penilaian_awal_keperawatan")) !== null) {
                $this->id_penilaian_awal_keperawatan->setQueryStringValue($keyValue);
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
                    $this->terminate("PenilaianAwalKeperawatanRalanList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PenilaianAwalKeperawatanRalanList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PenilaianAwalKeperawatanRalanView") {
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
        $this->no_rawat->CurrentValue = null;
        $this->no_rawat->OldValue = $this->no_rawat->CurrentValue;
        $this->tanggal->CurrentValue = null;
        $this->tanggal->OldValue = $this->tanggal->CurrentValue;
        $this->informasi->CurrentValue = null;
        $this->informasi->OldValue = $this->informasi->CurrentValue;
        $this->td->CurrentValue = null;
        $this->td->OldValue = $this->td->CurrentValue;
        $this->nadi->CurrentValue = null;
        $this->nadi->OldValue = $this->nadi->CurrentValue;
        $this->rr->CurrentValue = null;
        $this->rr->OldValue = $this->rr->CurrentValue;
        $this->suhu->CurrentValue = null;
        $this->suhu->OldValue = $this->suhu->CurrentValue;
        $this->gcs->CurrentValue = null;
        $this->gcs->OldValue = $this->gcs->CurrentValue;
        $this->bb->CurrentValue = null;
        $this->bb->OldValue = $this->bb->CurrentValue;
        $this->tb->CurrentValue = null;
        $this->tb->OldValue = $this->tb->CurrentValue;
        $this->bmi->CurrentValue = null;
        $this->bmi->OldValue = $this->bmi->CurrentValue;
        $this->keluhan_utama->CurrentValue = null;
        $this->keluhan_utama->OldValue = $this->keluhan_utama->CurrentValue;
        $this->rpd->CurrentValue = null;
        $this->rpd->OldValue = $this->rpd->CurrentValue;
        $this->rpk->CurrentValue = null;
        $this->rpk->OldValue = $this->rpk->CurrentValue;
        $this->rpo->CurrentValue = null;
        $this->rpo->OldValue = $this->rpo->CurrentValue;
        $this->alergi->CurrentValue = null;
        $this->alergi->OldValue = $this->alergi->CurrentValue;
        $this->alat_bantu->CurrentValue = null;
        $this->alat_bantu->OldValue = $this->alat_bantu->CurrentValue;
        $this->ket_bantu->CurrentValue = null;
        $this->ket_bantu->OldValue = $this->ket_bantu->CurrentValue;
        $this->prothesa->CurrentValue = null;
        $this->prothesa->OldValue = $this->prothesa->CurrentValue;
        $this->ket_pro->CurrentValue = null;
        $this->ket_pro->OldValue = $this->ket_pro->CurrentValue;
        $this->adl->CurrentValue = null;
        $this->adl->OldValue = $this->adl->CurrentValue;
        $this->status_psiko->CurrentValue = null;
        $this->status_psiko->OldValue = $this->status_psiko->CurrentValue;
        $this->ket_psiko->CurrentValue = null;
        $this->ket_psiko->OldValue = $this->ket_psiko->CurrentValue;
        $this->hub_keluarga->CurrentValue = null;
        $this->hub_keluarga->OldValue = $this->hub_keluarga->CurrentValue;
        $this->tinggal_dengan->CurrentValue = null;
        $this->tinggal_dengan->OldValue = $this->tinggal_dengan->CurrentValue;
        $this->ket_tinggal->CurrentValue = null;
        $this->ket_tinggal->OldValue = $this->ket_tinggal->CurrentValue;
        $this->ekonomi->CurrentValue = null;
        $this->ekonomi->OldValue = $this->ekonomi->CurrentValue;
        $this->budaya->CurrentValue = null;
        $this->budaya->OldValue = $this->budaya->CurrentValue;
        $this->ket_budaya->CurrentValue = null;
        $this->ket_budaya->OldValue = $this->ket_budaya->CurrentValue;
        $this->edukasi->CurrentValue = null;
        $this->edukasi->OldValue = $this->edukasi->CurrentValue;
        $this->ket_edukasi->CurrentValue = null;
        $this->ket_edukasi->OldValue = $this->ket_edukasi->CurrentValue;
        $this->berjalan_a->CurrentValue = null;
        $this->berjalan_a->OldValue = $this->berjalan_a->CurrentValue;
        $this->berjalan_b->CurrentValue = null;
        $this->berjalan_b->OldValue = $this->berjalan_b->CurrentValue;
        $this->berjalan_c->CurrentValue = null;
        $this->berjalan_c->OldValue = $this->berjalan_c->CurrentValue;
        $this->hasil->CurrentValue = null;
        $this->hasil->OldValue = $this->hasil->CurrentValue;
        $this->lapor->CurrentValue = null;
        $this->lapor->OldValue = $this->lapor->CurrentValue;
        $this->ket_lapor->CurrentValue = null;
        $this->ket_lapor->OldValue = $this->ket_lapor->CurrentValue;
        $this->sg1->CurrentValue = null;
        $this->sg1->OldValue = $this->sg1->CurrentValue;
        $this->nilai1->CurrentValue = null;
        $this->nilai1->OldValue = $this->nilai1->CurrentValue;
        $this->sg2->CurrentValue = null;
        $this->sg2->OldValue = $this->sg2->CurrentValue;
        $this->nilai2->CurrentValue = null;
        $this->nilai2->OldValue = $this->nilai2->CurrentValue;
        $this->total_hasil->CurrentValue = null;
        $this->total_hasil->OldValue = $this->total_hasil->CurrentValue;
        $this->nyeri->CurrentValue = null;
        $this->nyeri->OldValue = $this->nyeri->CurrentValue;
        $this->provokes->CurrentValue = null;
        $this->provokes->OldValue = $this->provokes->CurrentValue;
        $this->ket_provokes->CurrentValue = null;
        $this->ket_provokes->OldValue = $this->ket_provokes->CurrentValue;
        $this->quality->CurrentValue = null;
        $this->quality->OldValue = $this->quality->CurrentValue;
        $this->ket_quality->CurrentValue = null;
        $this->ket_quality->OldValue = $this->ket_quality->CurrentValue;
        $this->lokasi->CurrentValue = null;
        $this->lokasi->OldValue = $this->lokasi->CurrentValue;
        $this->menyebar->CurrentValue = null;
        $this->menyebar->OldValue = $this->menyebar->CurrentValue;
        $this->skala_nyeri->CurrentValue = null;
        $this->skala_nyeri->OldValue = $this->skala_nyeri->CurrentValue;
        $this->durasi->CurrentValue = null;
        $this->durasi->OldValue = $this->durasi->CurrentValue;
        $this->nyeri_hilang->CurrentValue = null;
        $this->nyeri_hilang->OldValue = $this->nyeri_hilang->CurrentValue;
        $this->ket_nyeri->CurrentValue = null;
        $this->ket_nyeri->OldValue = $this->ket_nyeri->CurrentValue;
        $this->pada_dokter->CurrentValue = null;
        $this->pada_dokter->OldValue = $this->pada_dokter->CurrentValue;
        $this->ket_dokter->CurrentValue = null;
        $this->ket_dokter->OldValue = $this->ket_dokter->CurrentValue;
        $this->rencana->CurrentValue = null;
        $this->rencana->OldValue = $this->rencana->CurrentValue;
        $this->nip->CurrentValue = null;
        $this->nip->OldValue = $this->nip->CurrentValue;
        $this->id_penilaian_awal_keperawatan->CurrentValue = null;
        $this->id_penilaian_awal_keperawatan->OldValue = $this->id_penilaian_awal_keperawatan->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

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

        // Check field name 'informasi' first before field var 'x_informasi'
        $val = $CurrentForm->hasValue("informasi") ? $CurrentForm->getValue("informasi") : $CurrentForm->getValue("x_informasi");
        if (!$this->informasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->informasi->Visible = false; // Disable update for API request
            } else {
                $this->informasi->setFormValue($val);
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

        // Check field name 'gcs' first before field var 'x_gcs'
        $val = $CurrentForm->hasValue("gcs") ? $CurrentForm->getValue("gcs") : $CurrentForm->getValue("x_gcs");
        if (!$this->gcs->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gcs->Visible = false; // Disable update for API request
            } else {
                $this->gcs->setFormValue($val);
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

        // Check field name 'bmi' first before field var 'x_bmi'
        $val = $CurrentForm->hasValue("bmi") ? $CurrentForm->getValue("bmi") : $CurrentForm->getValue("x_bmi");
        if (!$this->bmi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bmi->Visible = false; // Disable update for API request
            } else {
                $this->bmi->setFormValue($val);
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

        // Check field name 'alat_bantu' first before field var 'x_alat_bantu'
        $val = $CurrentForm->hasValue("alat_bantu") ? $CurrentForm->getValue("alat_bantu") : $CurrentForm->getValue("x_alat_bantu");
        if (!$this->alat_bantu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alat_bantu->Visible = false; // Disable update for API request
            } else {
                $this->alat_bantu->setFormValue($val);
            }
        }

        // Check field name 'ket_bantu' first before field var 'x_ket_bantu'
        $val = $CurrentForm->hasValue("ket_bantu") ? $CurrentForm->getValue("ket_bantu") : $CurrentForm->getValue("x_ket_bantu");
        if (!$this->ket_bantu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_bantu->Visible = false; // Disable update for API request
            } else {
                $this->ket_bantu->setFormValue($val);
            }
        }

        // Check field name 'prothesa' first before field var 'x_prothesa'
        $val = $CurrentForm->hasValue("prothesa") ? $CurrentForm->getValue("prothesa") : $CurrentForm->getValue("x_prothesa");
        if (!$this->prothesa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->prothesa->Visible = false; // Disable update for API request
            } else {
                $this->prothesa->setFormValue($val);
            }
        }

        // Check field name 'ket_pro' first before field var 'x_ket_pro'
        $val = $CurrentForm->hasValue("ket_pro") ? $CurrentForm->getValue("ket_pro") : $CurrentForm->getValue("x_ket_pro");
        if (!$this->ket_pro->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_pro->Visible = false; // Disable update for API request
            } else {
                $this->ket_pro->setFormValue($val);
            }
        }

        // Check field name 'adl' first before field var 'x_adl'
        $val = $CurrentForm->hasValue("adl") ? $CurrentForm->getValue("adl") : $CurrentForm->getValue("x_adl");
        if (!$this->adl->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl->Visible = false; // Disable update for API request
            } else {
                $this->adl->setFormValue($val);
            }
        }

        // Check field name 'status_psiko' first before field var 'x_status_psiko'
        $val = $CurrentForm->hasValue("status_psiko") ? $CurrentForm->getValue("status_psiko") : $CurrentForm->getValue("x_status_psiko");
        if (!$this->status_psiko->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_psiko->Visible = false; // Disable update for API request
            } else {
                $this->status_psiko->setFormValue($val);
            }
        }

        // Check field name 'ket_psiko' first before field var 'x_ket_psiko'
        $val = $CurrentForm->hasValue("ket_psiko") ? $CurrentForm->getValue("ket_psiko") : $CurrentForm->getValue("x_ket_psiko");
        if (!$this->ket_psiko->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_psiko->Visible = false; // Disable update for API request
            } else {
                $this->ket_psiko->setFormValue($val);
            }
        }

        // Check field name 'hub_keluarga' first before field var 'x_hub_keluarga'
        $val = $CurrentForm->hasValue("hub_keluarga") ? $CurrentForm->getValue("hub_keluarga") : $CurrentForm->getValue("x_hub_keluarga");
        if (!$this->hub_keluarga->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hub_keluarga->Visible = false; // Disable update for API request
            } else {
                $this->hub_keluarga->setFormValue($val);
            }
        }

        // Check field name 'tinggal_dengan' first before field var 'x_tinggal_dengan'
        $val = $CurrentForm->hasValue("tinggal_dengan") ? $CurrentForm->getValue("tinggal_dengan") : $CurrentForm->getValue("x_tinggal_dengan");
        if (!$this->tinggal_dengan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tinggal_dengan->Visible = false; // Disable update for API request
            } else {
                $this->tinggal_dengan->setFormValue($val);
            }
        }

        // Check field name 'ket_tinggal' first before field var 'x_ket_tinggal'
        $val = $CurrentForm->hasValue("ket_tinggal") ? $CurrentForm->getValue("ket_tinggal") : $CurrentForm->getValue("x_ket_tinggal");
        if (!$this->ket_tinggal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_tinggal->Visible = false; // Disable update for API request
            } else {
                $this->ket_tinggal->setFormValue($val);
            }
        }

        // Check field name 'ekonomi' first before field var 'x_ekonomi'
        $val = $CurrentForm->hasValue("ekonomi") ? $CurrentForm->getValue("ekonomi") : $CurrentForm->getValue("x_ekonomi");
        if (!$this->ekonomi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ekonomi->Visible = false; // Disable update for API request
            } else {
                $this->ekonomi->setFormValue($val);
            }
        }

        // Check field name 'budaya' first before field var 'x_budaya'
        $val = $CurrentForm->hasValue("budaya") ? $CurrentForm->getValue("budaya") : $CurrentForm->getValue("x_budaya");
        if (!$this->budaya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->budaya->Visible = false; // Disable update for API request
            } else {
                $this->budaya->setFormValue($val);
            }
        }

        // Check field name 'ket_budaya' first before field var 'x_ket_budaya'
        $val = $CurrentForm->hasValue("ket_budaya") ? $CurrentForm->getValue("ket_budaya") : $CurrentForm->getValue("x_ket_budaya");
        if (!$this->ket_budaya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_budaya->Visible = false; // Disable update for API request
            } else {
                $this->ket_budaya->setFormValue($val);
            }
        }

        // Check field name 'edukasi' first before field var 'x_edukasi'
        $val = $CurrentForm->hasValue("edukasi") ? $CurrentForm->getValue("edukasi") : $CurrentForm->getValue("x_edukasi");
        if (!$this->edukasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->edukasi->Visible = false; // Disable update for API request
            } else {
                $this->edukasi->setFormValue($val);
            }
        }

        // Check field name 'ket_edukasi' first before field var 'x_ket_edukasi'
        $val = $CurrentForm->hasValue("ket_edukasi") ? $CurrentForm->getValue("ket_edukasi") : $CurrentForm->getValue("x_ket_edukasi");
        if (!$this->ket_edukasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_edukasi->Visible = false; // Disable update for API request
            } else {
                $this->ket_edukasi->setFormValue($val);
            }
        }

        // Check field name 'berjalan_a' first before field var 'x_berjalan_a'
        $val = $CurrentForm->hasValue("berjalan_a") ? $CurrentForm->getValue("berjalan_a") : $CurrentForm->getValue("x_berjalan_a");
        if (!$this->berjalan_a->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berjalan_a->Visible = false; // Disable update for API request
            } else {
                $this->berjalan_a->setFormValue($val);
            }
        }

        // Check field name 'berjalan_b' first before field var 'x_berjalan_b'
        $val = $CurrentForm->hasValue("berjalan_b") ? $CurrentForm->getValue("berjalan_b") : $CurrentForm->getValue("x_berjalan_b");
        if (!$this->berjalan_b->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berjalan_b->Visible = false; // Disable update for API request
            } else {
                $this->berjalan_b->setFormValue($val);
            }
        }

        // Check field name 'berjalan_c' first before field var 'x_berjalan_c'
        $val = $CurrentForm->hasValue("berjalan_c") ? $CurrentForm->getValue("berjalan_c") : $CurrentForm->getValue("x_berjalan_c");
        if (!$this->berjalan_c->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berjalan_c->Visible = false; // Disable update for API request
            } else {
                $this->berjalan_c->setFormValue($val);
            }
        }

        // Check field name 'hasil' first before field var 'x_hasil'
        $val = $CurrentForm->hasValue("hasil") ? $CurrentForm->getValue("hasil") : $CurrentForm->getValue("x_hasil");
        if (!$this->hasil->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hasil->Visible = false; // Disable update for API request
            } else {
                $this->hasil->setFormValue($val);
            }
        }

        // Check field name 'lapor' first before field var 'x_lapor'
        $val = $CurrentForm->hasValue("lapor") ? $CurrentForm->getValue("lapor") : $CurrentForm->getValue("x_lapor");
        if (!$this->lapor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lapor->Visible = false; // Disable update for API request
            } else {
                $this->lapor->setFormValue($val);
            }
        }

        // Check field name 'ket_lapor' first before field var 'x_ket_lapor'
        $val = $CurrentForm->hasValue("ket_lapor") ? $CurrentForm->getValue("ket_lapor") : $CurrentForm->getValue("x_ket_lapor");
        if (!$this->ket_lapor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_lapor->Visible = false; // Disable update for API request
            } else {
                $this->ket_lapor->setFormValue($val);
            }
        }

        // Check field name 'sg1' first before field var 'x_sg1'
        $val = $CurrentForm->hasValue("sg1") ? $CurrentForm->getValue("sg1") : $CurrentForm->getValue("x_sg1");
        if (!$this->sg1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sg1->Visible = false; // Disable update for API request
            } else {
                $this->sg1->setFormValue($val);
            }
        }

        // Check field name 'nilai1' first before field var 'x_nilai1'
        $val = $CurrentForm->hasValue("nilai1") ? $CurrentForm->getValue("nilai1") : $CurrentForm->getValue("x_nilai1");
        if (!$this->nilai1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nilai1->Visible = false; // Disable update for API request
            } else {
                $this->nilai1->setFormValue($val);
            }
        }

        // Check field name 'sg2' first before field var 'x_sg2'
        $val = $CurrentForm->hasValue("sg2") ? $CurrentForm->getValue("sg2") : $CurrentForm->getValue("x_sg2");
        if (!$this->sg2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sg2->Visible = false; // Disable update for API request
            } else {
                $this->sg2->setFormValue($val);
            }
        }

        // Check field name 'nilai2' first before field var 'x_nilai2'
        $val = $CurrentForm->hasValue("nilai2") ? $CurrentForm->getValue("nilai2") : $CurrentForm->getValue("x_nilai2");
        if (!$this->nilai2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nilai2->Visible = false; // Disable update for API request
            } else {
                $this->nilai2->setFormValue($val);
            }
        }

        // Check field name 'total_hasil' first before field var 'x_total_hasil'
        $val = $CurrentForm->hasValue("total_hasil") ? $CurrentForm->getValue("total_hasil") : $CurrentForm->getValue("x_total_hasil");
        if (!$this->total_hasil->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->total_hasil->Visible = false; // Disable update for API request
            } else {
                $this->total_hasil->setFormValue($val);
            }
        }

        // Check field name 'nyeri' first before field var 'x_nyeri'
        $val = $CurrentForm->hasValue("nyeri") ? $CurrentForm->getValue("nyeri") : $CurrentForm->getValue("x_nyeri");
        if (!$this->nyeri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nyeri->Visible = false; // Disable update for API request
            } else {
                $this->nyeri->setFormValue($val);
            }
        }

        // Check field name 'provokes' first before field var 'x_provokes'
        $val = $CurrentForm->hasValue("provokes") ? $CurrentForm->getValue("provokes") : $CurrentForm->getValue("x_provokes");
        if (!$this->provokes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->provokes->Visible = false; // Disable update for API request
            } else {
                $this->provokes->setFormValue($val);
            }
        }

        // Check field name 'ket_provokes' first before field var 'x_ket_provokes'
        $val = $CurrentForm->hasValue("ket_provokes") ? $CurrentForm->getValue("ket_provokes") : $CurrentForm->getValue("x_ket_provokes");
        if (!$this->ket_provokes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_provokes->Visible = false; // Disable update for API request
            } else {
                $this->ket_provokes->setFormValue($val);
            }
        }

        // Check field name 'quality' first before field var 'x_quality'
        $val = $CurrentForm->hasValue("quality") ? $CurrentForm->getValue("quality") : $CurrentForm->getValue("x_quality");
        if (!$this->quality->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->quality->Visible = false; // Disable update for API request
            } else {
                $this->quality->setFormValue($val);
            }
        }

        // Check field name 'ket_quality' first before field var 'x_ket_quality'
        $val = $CurrentForm->hasValue("ket_quality") ? $CurrentForm->getValue("ket_quality") : $CurrentForm->getValue("x_ket_quality");
        if (!$this->ket_quality->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_quality->Visible = false; // Disable update for API request
            } else {
                $this->ket_quality->setFormValue($val);
            }
        }

        // Check field name 'lokasi' first before field var 'x_lokasi'
        $val = $CurrentForm->hasValue("lokasi") ? $CurrentForm->getValue("lokasi") : $CurrentForm->getValue("x_lokasi");
        if (!$this->lokasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lokasi->Visible = false; // Disable update for API request
            } else {
                $this->lokasi->setFormValue($val);
            }
        }

        // Check field name 'menyebar' first before field var 'x_menyebar'
        $val = $CurrentForm->hasValue("menyebar") ? $CurrentForm->getValue("menyebar") : $CurrentForm->getValue("x_menyebar");
        if (!$this->menyebar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->menyebar->Visible = false; // Disable update for API request
            } else {
                $this->menyebar->setFormValue($val);
            }
        }

        // Check field name 'skala_nyeri' first before field var 'x_skala_nyeri'
        $val = $CurrentForm->hasValue("skala_nyeri") ? $CurrentForm->getValue("skala_nyeri") : $CurrentForm->getValue("x_skala_nyeri");
        if (!$this->skala_nyeri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skala_nyeri->Visible = false; // Disable update for API request
            } else {
                $this->skala_nyeri->setFormValue($val);
            }
        }

        // Check field name 'durasi' first before field var 'x_durasi'
        $val = $CurrentForm->hasValue("durasi") ? $CurrentForm->getValue("durasi") : $CurrentForm->getValue("x_durasi");
        if (!$this->durasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->durasi->Visible = false; // Disable update for API request
            } else {
                $this->durasi->setFormValue($val);
            }
        }

        // Check field name 'nyeri_hilang' first before field var 'x_nyeri_hilang'
        $val = $CurrentForm->hasValue("nyeri_hilang") ? $CurrentForm->getValue("nyeri_hilang") : $CurrentForm->getValue("x_nyeri_hilang");
        if (!$this->nyeri_hilang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nyeri_hilang->Visible = false; // Disable update for API request
            } else {
                $this->nyeri_hilang->setFormValue($val);
            }
        }

        // Check field name 'ket_nyeri' first before field var 'x_ket_nyeri'
        $val = $CurrentForm->hasValue("ket_nyeri") ? $CurrentForm->getValue("ket_nyeri") : $CurrentForm->getValue("x_ket_nyeri");
        if (!$this->ket_nyeri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_nyeri->Visible = false; // Disable update for API request
            } else {
                $this->ket_nyeri->setFormValue($val);
            }
        }

        // Check field name 'pada_dokter' first before field var 'x_pada_dokter'
        $val = $CurrentForm->hasValue("pada_dokter") ? $CurrentForm->getValue("pada_dokter") : $CurrentForm->getValue("x_pada_dokter");
        if (!$this->pada_dokter->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pada_dokter->Visible = false; // Disable update for API request
            } else {
                $this->pada_dokter->setFormValue($val);
            }
        }

        // Check field name 'ket_dokter' first before field var 'x_ket_dokter'
        $val = $CurrentForm->hasValue("ket_dokter") ? $CurrentForm->getValue("ket_dokter") : $CurrentForm->getValue("x_ket_dokter");
        if (!$this->ket_dokter->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_dokter->Visible = false; // Disable update for API request
            } else {
                $this->ket_dokter->setFormValue($val);
            }
        }

        // Check field name 'rencana' first before field var 'x_rencana'
        $val = $CurrentForm->hasValue("rencana") ? $CurrentForm->getValue("rencana") : $CurrentForm->getValue("x_rencana");
        if (!$this->rencana->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rencana->Visible = false; // Disable update for API request
            } else {
                $this->rencana->setFormValue($val);
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

        // Check field name 'id_penilaian_awal_keperawatan' first before field var 'x_id_penilaian_awal_keperawatan'
        $val = $CurrentForm->hasValue("id_penilaian_awal_keperawatan") ? $CurrentForm->getValue("id_penilaian_awal_keperawatan") : $CurrentForm->getValue("x_id_penilaian_awal_keperawatan");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->tanggal->CurrentValue = $this->tanggal->FormValue;
        $this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
        $this->informasi->CurrentValue = $this->informasi->FormValue;
        $this->td->CurrentValue = $this->td->FormValue;
        $this->nadi->CurrentValue = $this->nadi->FormValue;
        $this->rr->CurrentValue = $this->rr->FormValue;
        $this->suhu->CurrentValue = $this->suhu->FormValue;
        $this->gcs->CurrentValue = $this->gcs->FormValue;
        $this->bb->CurrentValue = $this->bb->FormValue;
        $this->tb->CurrentValue = $this->tb->FormValue;
        $this->bmi->CurrentValue = $this->bmi->FormValue;
        $this->keluhan_utama->CurrentValue = $this->keluhan_utama->FormValue;
        $this->rpd->CurrentValue = $this->rpd->FormValue;
        $this->rpk->CurrentValue = $this->rpk->FormValue;
        $this->rpo->CurrentValue = $this->rpo->FormValue;
        $this->alergi->CurrentValue = $this->alergi->FormValue;
        $this->alat_bantu->CurrentValue = $this->alat_bantu->FormValue;
        $this->ket_bantu->CurrentValue = $this->ket_bantu->FormValue;
        $this->prothesa->CurrentValue = $this->prothesa->FormValue;
        $this->ket_pro->CurrentValue = $this->ket_pro->FormValue;
        $this->adl->CurrentValue = $this->adl->FormValue;
        $this->status_psiko->CurrentValue = $this->status_psiko->FormValue;
        $this->ket_psiko->CurrentValue = $this->ket_psiko->FormValue;
        $this->hub_keluarga->CurrentValue = $this->hub_keluarga->FormValue;
        $this->tinggal_dengan->CurrentValue = $this->tinggal_dengan->FormValue;
        $this->ket_tinggal->CurrentValue = $this->ket_tinggal->FormValue;
        $this->ekonomi->CurrentValue = $this->ekonomi->FormValue;
        $this->budaya->CurrentValue = $this->budaya->FormValue;
        $this->ket_budaya->CurrentValue = $this->ket_budaya->FormValue;
        $this->edukasi->CurrentValue = $this->edukasi->FormValue;
        $this->ket_edukasi->CurrentValue = $this->ket_edukasi->FormValue;
        $this->berjalan_a->CurrentValue = $this->berjalan_a->FormValue;
        $this->berjalan_b->CurrentValue = $this->berjalan_b->FormValue;
        $this->berjalan_c->CurrentValue = $this->berjalan_c->FormValue;
        $this->hasil->CurrentValue = $this->hasil->FormValue;
        $this->lapor->CurrentValue = $this->lapor->FormValue;
        $this->ket_lapor->CurrentValue = $this->ket_lapor->FormValue;
        $this->sg1->CurrentValue = $this->sg1->FormValue;
        $this->nilai1->CurrentValue = $this->nilai1->FormValue;
        $this->sg2->CurrentValue = $this->sg2->FormValue;
        $this->nilai2->CurrentValue = $this->nilai2->FormValue;
        $this->total_hasil->CurrentValue = $this->total_hasil->FormValue;
        $this->nyeri->CurrentValue = $this->nyeri->FormValue;
        $this->provokes->CurrentValue = $this->provokes->FormValue;
        $this->ket_provokes->CurrentValue = $this->ket_provokes->FormValue;
        $this->quality->CurrentValue = $this->quality->FormValue;
        $this->ket_quality->CurrentValue = $this->ket_quality->FormValue;
        $this->lokasi->CurrentValue = $this->lokasi->FormValue;
        $this->menyebar->CurrentValue = $this->menyebar->FormValue;
        $this->skala_nyeri->CurrentValue = $this->skala_nyeri->FormValue;
        $this->durasi->CurrentValue = $this->durasi->FormValue;
        $this->nyeri_hilang->CurrentValue = $this->nyeri_hilang->FormValue;
        $this->ket_nyeri->CurrentValue = $this->ket_nyeri->FormValue;
        $this->pada_dokter->CurrentValue = $this->pada_dokter->FormValue;
        $this->ket_dokter->CurrentValue = $this->ket_dokter->FormValue;
        $this->rencana->CurrentValue = $this->rencana->FormValue;
        $this->nip->CurrentValue = $this->nip->FormValue;
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
        $this->tanggal->setDbValue($row['tanggal']);
        $this->informasi->setDbValue($row['informasi']);
        $this->td->setDbValue($row['td']);
        $this->nadi->setDbValue($row['nadi']);
        $this->rr->setDbValue($row['rr']);
        $this->suhu->setDbValue($row['suhu']);
        $this->gcs->setDbValue($row['gcs']);
        $this->bb->setDbValue($row['bb']);
        $this->tb->setDbValue($row['tb']);
        $this->bmi->setDbValue($row['bmi']);
        $this->keluhan_utama->setDbValue($row['keluhan_utama']);
        $this->rpd->setDbValue($row['rpd']);
        $this->rpk->setDbValue($row['rpk']);
        $this->rpo->setDbValue($row['rpo']);
        $this->alergi->setDbValue($row['alergi']);
        $this->alat_bantu->setDbValue($row['alat_bantu']);
        $this->ket_bantu->setDbValue($row['ket_bantu']);
        $this->prothesa->setDbValue($row['prothesa']);
        $this->ket_pro->setDbValue($row['ket_pro']);
        $this->adl->setDbValue($row['adl']);
        $this->status_psiko->setDbValue($row['status_psiko']);
        $this->ket_psiko->setDbValue($row['ket_psiko']);
        $this->hub_keluarga->setDbValue($row['hub_keluarga']);
        $this->tinggal_dengan->setDbValue($row['tinggal_dengan']);
        $this->ket_tinggal->setDbValue($row['ket_tinggal']);
        $this->ekonomi->setDbValue($row['ekonomi']);
        $this->budaya->setDbValue($row['budaya']);
        $this->ket_budaya->setDbValue($row['ket_budaya']);
        $this->edukasi->setDbValue($row['edukasi']);
        $this->ket_edukasi->setDbValue($row['ket_edukasi']);
        $this->berjalan_a->setDbValue($row['berjalan_a']);
        $this->berjalan_b->setDbValue($row['berjalan_b']);
        $this->berjalan_c->setDbValue($row['berjalan_c']);
        $this->hasil->setDbValue($row['hasil']);
        $this->lapor->setDbValue($row['lapor']);
        $this->ket_lapor->setDbValue($row['ket_lapor']);
        $this->sg1->setDbValue($row['sg1']);
        $this->nilai1->setDbValue($row['nilai1']);
        $this->sg2->setDbValue($row['sg2']);
        $this->nilai2->setDbValue($row['nilai2']);
        $this->total_hasil->setDbValue($row['total_hasil']);
        $this->nyeri->setDbValue($row['nyeri']);
        $this->provokes->setDbValue($row['provokes']);
        $this->ket_provokes->setDbValue($row['ket_provokes']);
        $this->quality->setDbValue($row['quality']);
        $this->ket_quality->setDbValue($row['ket_quality']);
        $this->lokasi->setDbValue($row['lokasi']);
        $this->menyebar->setDbValue($row['menyebar']);
        $this->skala_nyeri->setDbValue($row['skala_nyeri']);
        $this->durasi->setDbValue($row['durasi']);
        $this->nyeri_hilang->setDbValue($row['nyeri_hilang']);
        $this->ket_nyeri->setDbValue($row['ket_nyeri']);
        $this->pada_dokter->setDbValue($row['pada_dokter']);
        $this->ket_dokter->setDbValue($row['ket_dokter']);
        $this->rencana->setDbValue($row['rencana']);
        $this->nip->setDbValue($row['nip']);
        $this->id_penilaian_awal_keperawatan->setDbValue($row['id_penilaian_awal_keperawatan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['no_rawat'] = $this->no_rawat->CurrentValue;
        $row['tanggal'] = $this->tanggal->CurrentValue;
        $row['informasi'] = $this->informasi->CurrentValue;
        $row['td'] = $this->td->CurrentValue;
        $row['nadi'] = $this->nadi->CurrentValue;
        $row['rr'] = $this->rr->CurrentValue;
        $row['suhu'] = $this->suhu->CurrentValue;
        $row['gcs'] = $this->gcs->CurrentValue;
        $row['bb'] = $this->bb->CurrentValue;
        $row['tb'] = $this->tb->CurrentValue;
        $row['bmi'] = $this->bmi->CurrentValue;
        $row['keluhan_utama'] = $this->keluhan_utama->CurrentValue;
        $row['rpd'] = $this->rpd->CurrentValue;
        $row['rpk'] = $this->rpk->CurrentValue;
        $row['rpo'] = $this->rpo->CurrentValue;
        $row['alergi'] = $this->alergi->CurrentValue;
        $row['alat_bantu'] = $this->alat_bantu->CurrentValue;
        $row['ket_bantu'] = $this->ket_bantu->CurrentValue;
        $row['prothesa'] = $this->prothesa->CurrentValue;
        $row['ket_pro'] = $this->ket_pro->CurrentValue;
        $row['adl'] = $this->adl->CurrentValue;
        $row['status_psiko'] = $this->status_psiko->CurrentValue;
        $row['ket_psiko'] = $this->ket_psiko->CurrentValue;
        $row['hub_keluarga'] = $this->hub_keluarga->CurrentValue;
        $row['tinggal_dengan'] = $this->tinggal_dengan->CurrentValue;
        $row['ket_tinggal'] = $this->ket_tinggal->CurrentValue;
        $row['ekonomi'] = $this->ekonomi->CurrentValue;
        $row['budaya'] = $this->budaya->CurrentValue;
        $row['ket_budaya'] = $this->ket_budaya->CurrentValue;
        $row['edukasi'] = $this->edukasi->CurrentValue;
        $row['ket_edukasi'] = $this->ket_edukasi->CurrentValue;
        $row['berjalan_a'] = $this->berjalan_a->CurrentValue;
        $row['berjalan_b'] = $this->berjalan_b->CurrentValue;
        $row['berjalan_c'] = $this->berjalan_c->CurrentValue;
        $row['hasil'] = $this->hasil->CurrentValue;
        $row['lapor'] = $this->lapor->CurrentValue;
        $row['ket_lapor'] = $this->ket_lapor->CurrentValue;
        $row['sg1'] = $this->sg1->CurrentValue;
        $row['nilai1'] = $this->nilai1->CurrentValue;
        $row['sg2'] = $this->sg2->CurrentValue;
        $row['nilai2'] = $this->nilai2->CurrentValue;
        $row['total_hasil'] = $this->total_hasil->CurrentValue;
        $row['nyeri'] = $this->nyeri->CurrentValue;
        $row['provokes'] = $this->provokes->CurrentValue;
        $row['ket_provokes'] = $this->ket_provokes->CurrentValue;
        $row['quality'] = $this->quality->CurrentValue;
        $row['ket_quality'] = $this->ket_quality->CurrentValue;
        $row['lokasi'] = $this->lokasi->CurrentValue;
        $row['menyebar'] = $this->menyebar->CurrentValue;
        $row['skala_nyeri'] = $this->skala_nyeri->CurrentValue;
        $row['durasi'] = $this->durasi->CurrentValue;
        $row['nyeri_hilang'] = $this->nyeri_hilang->CurrentValue;
        $row['ket_nyeri'] = $this->ket_nyeri->CurrentValue;
        $row['pada_dokter'] = $this->pada_dokter->CurrentValue;
        $row['ket_dokter'] = $this->ket_dokter->CurrentValue;
        $row['rencana'] = $this->rencana->CurrentValue;
        $row['nip'] = $this->nip->CurrentValue;
        $row['id_penilaian_awal_keperawatan'] = $this->id_penilaian_awal_keperawatan->CurrentValue;
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

        // tanggal

        // informasi

        // td

        // nadi

        // rr

        // suhu

        // gcs

        // bb

        // tb

        // bmi

        // keluhan_utama

        // rpd

        // rpk

        // rpo

        // alergi

        // alat_bantu

        // ket_bantu

        // prothesa

        // ket_pro

        // adl

        // status_psiko

        // ket_psiko

        // hub_keluarga

        // tinggal_dengan

        // ket_tinggal

        // ekonomi

        // budaya

        // ket_budaya

        // edukasi

        // ket_edukasi

        // berjalan_a

        // berjalan_b

        // berjalan_c

        // hasil

        // lapor

        // ket_lapor

        // sg1

        // nilai1

        // sg2

        // nilai2

        // total_hasil

        // nyeri

        // provokes

        // ket_provokes

        // quality

        // ket_quality

        // lokasi

        // menyebar

        // skala_nyeri

        // durasi

        // nyeri_hilang

        // ket_nyeri

        // pada_dokter

        // ket_dokter

        // rencana

        // nip

        // id_penilaian_awal_keperawatan
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_rawat
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";

            // tanggal
            $this->tanggal->ViewValue = $this->tanggal->CurrentValue;
            $this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
            $this->tanggal->ViewCustomAttributes = "";

            // informasi
            if (strval($this->informasi->CurrentValue) != "") {
                $this->informasi->ViewValue = $this->informasi->optionCaption($this->informasi->CurrentValue);
            } else {
                $this->informasi->ViewValue = null;
            }
            $this->informasi->ViewCustomAttributes = "";

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

            // gcs
            $this->gcs->ViewValue = $this->gcs->CurrentValue;
            $this->gcs->ViewCustomAttributes = "";

            // bb
            $this->bb->ViewValue = $this->bb->CurrentValue;
            $this->bb->ViewCustomAttributes = "";

            // tb
            $this->tb->ViewValue = $this->tb->CurrentValue;
            $this->tb->ViewCustomAttributes = "";

            // bmi
            $this->bmi->ViewValue = $this->bmi->CurrentValue;
            $this->bmi->ViewCustomAttributes = "";

            // keluhan_utama
            $this->keluhan_utama->ViewValue = $this->keluhan_utama->CurrentValue;
            $this->keluhan_utama->ViewCustomAttributes = "";

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

            // alat_bantu
            if (strval($this->alat_bantu->CurrentValue) != "") {
                $this->alat_bantu->ViewValue = $this->alat_bantu->optionCaption($this->alat_bantu->CurrentValue);
            } else {
                $this->alat_bantu->ViewValue = null;
            }
            $this->alat_bantu->ViewCustomAttributes = "";

            // ket_bantu
            $this->ket_bantu->ViewValue = $this->ket_bantu->CurrentValue;
            $this->ket_bantu->ViewCustomAttributes = "";

            // prothesa
            if (strval($this->prothesa->CurrentValue) != "") {
                $this->prothesa->ViewValue = $this->prothesa->optionCaption($this->prothesa->CurrentValue);
            } else {
                $this->prothesa->ViewValue = null;
            }
            $this->prothesa->ViewCustomAttributes = "";

            // ket_pro
            $this->ket_pro->ViewValue = $this->ket_pro->CurrentValue;
            $this->ket_pro->ViewCustomAttributes = "";

            // adl
            if (strval($this->adl->CurrentValue) != "") {
                $this->adl->ViewValue = $this->adl->optionCaption($this->adl->CurrentValue);
            } else {
                $this->adl->ViewValue = null;
            }
            $this->adl->ViewCustomAttributes = "";

            // status_psiko
            if (strval($this->status_psiko->CurrentValue) != "") {
                $this->status_psiko->ViewValue = $this->status_psiko->optionCaption($this->status_psiko->CurrentValue);
            } else {
                $this->status_psiko->ViewValue = null;
            }
            $this->status_psiko->ViewCustomAttributes = "";

            // ket_psiko
            $this->ket_psiko->ViewValue = $this->ket_psiko->CurrentValue;
            $this->ket_psiko->ViewCustomAttributes = "";

            // hub_keluarga
            if (strval($this->hub_keluarga->CurrentValue) != "") {
                $this->hub_keluarga->ViewValue = $this->hub_keluarga->optionCaption($this->hub_keluarga->CurrentValue);
            } else {
                $this->hub_keluarga->ViewValue = null;
            }
            $this->hub_keluarga->ViewCustomAttributes = "";

            // tinggal_dengan
            if (strval($this->tinggal_dengan->CurrentValue) != "") {
                $this->tinggal_dengan->ViewValue = $this->tinggal_dengan->optionCaption($this->tinggal_dengan->CurrentValue);
            } else {
                $this->tinggal_dengan->ViewValue = null;
            }
            $this->tinggal_dengan->ViewCustomAttributes = "";

            // ket_tinggal
            $this->ket_tinggal->ViewValue = $this->ket_tinggal->CurrentValue;
            $this->ket_tinggal->ViewCustomAttributes = "";

            // ekonomi
            if (strval($this->ekonomi->CurrentValue) != "") {
                $this->ekonomi->ViewValue = $this->ekonomi->optionCaption($this->ekonomi->CurrentValue);
            } else {
                $this->ekonomi->ViewValue = null;
            }
            $this->ekonomi->ViewCustomAttributes = "";

            // budaya
            if (strval($this->budaya->CurrentValue) != "") {
                $this->budaya->ViewValue = $this->budaya->optionCaption($this->budaya->CurrentValue);
            } else {
                $this->budaya->ViewValue = null;
            }
            $this->budaya->ViewCustomAttributes = "";

            // ket_budaya
            $this->ket_budaya->ViewValue = $this->ket_budaya->CurrentValue;
            $this->ket_budaya->ViewCustomAttributes = "";

            // edukasi
            if (strval($this->edukasi->CurrentValue) != "") {
                $this->edukasi->ViewValue = $this->edukasi->optionCaption($this->edukasi->CurrentValue);
            } else {
                $this->edukasi->ViewValue = null;
            }
            $this->edukasi->ViewCustomAttributes = "";

            // ket_edukasi
            $this->ket_edukasi->ViewValue = $this->ket_edukasi->CurrentValue;
            $this->ket_edukasi->ViewCustomAttributes = "";

            // berjalan_a
            if (strval($this->berjalan_a->CurrentValue) != "") {
                $this->berjalan_a->ViewValue = $this->berjalan_a->optionCaption($this->berjalan_a->CurrentValue);
            } else {
                $this->berjalan_a->ViewValue = null;
            }
            $this->berjalan_a->ViewCustomAttributes = "";

            // berjalan_b
            if (strval($this->berjalan_b->CurrentValue) != "") {
                $this->berjalan_b->ViewValue = $this->berjalan_b->optionCaption($this->berjalan_b->CurrentValue);
            } else {
                $this->berjalan_b->ViewValue = null;
            }
            $this->berjalan_b->ViewCustomAttributes = "";

            // berjalan_c
            if (strval($this->berjalan_c->CurrentValue) != "") {
                $this->berjalan_c->ViewValue = $this->berjalan_c->optionCaption($this->berjalan_c->CurrentValue);
            } else {
                $this->berjalan_c->ViewValue = null;
            }
            $this->berjalan_c->ViewCustomAttributes = "";

            // hasil
            if (strval($this->hasil->CurrentValue) != "") {
                $this->hasil->ViewValue = $this->hasil->optionCaption($this->hasil->CurrentValue);
            } else {
                $this->hasil->ViewValue = null;
            }
            $this->hasil->ViewCustomAttributes = "";

            // lapor
            if (strval($this->lapor->CurrentValue) != "") {
                $this->lapor->ViewValue = $this->lapor->optionCaption($this->lapor->CurrentValue);
            } else {
                $this->lapor->ViewValue = null;
            }
            $this->lapor->ViewCustomAttributes = "";

            // ket_lapor
            $this->ket_lapor->ViewValue = $this->ket_lapor->CurrentValue;
            $this->ket_lapor->ViewCustomAttributes = "";

            // sg1
            if (strval($this->sg1->CurrentValue) != "") {
                $this->sg1->ViewValue = $this->sg1->optionCaption($this->sg1->CurrentValue);
            } else {
                $this->sg1->ViewValue = null;
            }
            $this->sg1->ViewCustomAttributes = "";

            // nilai1
            if (strval($this->nilai1->CurrentValue) != "") {
                $this->nilai1->ViewValue = $this->nilai1->optionCaption($this->nilai1->CurrentValue);
            } else {
                $this->nilai1->ViewValue = null;
            }
            $this->nilai1->ViewCustomAttributes = "";

            // sg2
            if (strval($this->sg2->CurrentValue) != "") {
                $this->sg2->ViewValue = $this->sg2->optionCaption($this->sg2->CurrentValue);
            } else {
                $this->sg2->ViewValue = null;
            }
            $this->sg2->ViewCustomAttributes = "";

            // nilai2
            if (ConvertToBool($this->nilai2->CurrentValue)) {
                $this->nilai2->ViewValue = $this->nilai2->tagCaption(2) != "" ? $this->nilai2->tagCaption(2) : "1";
            } else {
                $this->nilai2->ViewValue = $this->nilai2->tagCaption(1) != "" ? $this->nilai2->tagCaption(1) : "0";
            }
            $this->nilai2->ViewCustomAttributes = "";

            // total_hasil
            $this->total_hasil->ViewValue = $this->total_hasil->CurrentValue;
            $this->total_hasil->ViewValue = FormatNumber($this->total_hasil->ViewValue, 0, -2, -2, -2);
            $this->total_hasil->ViewCustomAttributes = "";

            // nyeri
            if (strval($this->nyeri->CurrentValue) != "") {
                $this->nyeri->ViewValue = $this->nyeri->optionCaption($this->nyeri->CurrentValue);
            } else {
                $this->nyeri->ViewValue = null;
            }
            $this->nyeri->ViewCustomAttributes = "";

            // provokes
            if (strval($this->provokes->CurrentValue) != "") {
                $this->provokes->ViewValue = $this->provokes->optionCaption($this->provokes->CurrentValue);
            } else {
                $this->provokes->ViewValue = null;
            }
            $this->provokes->ViewCustomAttributes = "";

            // ket_provokes
            $this->ket_provokes->ViewValue = $this->ket_provokes->CurrentValue;
            $this->ket_provokes->ViewCustomAttributes = "";

            // quality
            if (strval($this->quality->CurrentValue) != "") {
                $this->quality->ViewValue = $this->quality->optionCaption($this->quality->CurrentValue);
            } else {
                $this->quality->ViewValue = null;
            }
            $this->quality->ViewCustomAttributes = "";

            // ket_quality
            $this->ket_quality->ViewValue = $this->ket_quality->CurrentValue;
            $this->ket_quality->ViewCustomAttributes = "";

            // lokasi
            $this->lokasi->ViewValue = $this->lokasi->CurrentValue;
            $this->lokasi->ViewCustomAttributes = "";

            // menyebar
            if (strval($this->menyebar->CurrentValue) != "") {
                $this->menyebar->ViewValue = $this->menyebar->optionCaption($this->menyebar->CurrentValue);
            } else {
                $this->menyebar->ViewValue = null;
            }
            $this->menyebar->ViewCustomAttributes = "";

            // skala_nyeri
            if (strval($this->skala_nyeri->CurrentValue) != "") {
                $this->skala_nyeri->ViewValue = $this->skala_nyeri->optionCaption($this->skala_nyeri->CurrentValue);
            } else {
                $this->skala_nyeri->ViewValue = null;
            }
            $this->skala_nyeri->ViewCustomAttributes = "";

            // durasi
            $this->durasi->ViewValue = $this->durasi->CurrentValue;
            $this->durasi->ViewCustomAttributes = "";

            // nyeri_hilang
            if (strval($this->nyeri_hilang->CurrentValue) != "") {
                $this->nyeri_hilang->ViewValue = $this->nyeri_hilang->optionCaption($this->nyeri_hilang->CurrentValue);
            } else {
                $this->nyeri_hilang->ViewValue = null;
            }
            $this->nyeri_hilang->ViewCustomAttributes = "";

            // ket_nyeri
            $this->ket_nyeri->ViewValue = $this->ket_nyeri->CurrentValue;
            $this->ket_nyeri->ViewCustomAttributes = "";

            // pada_dokter
            if (strval($this->pada_dokter->CurrentValue) != "") {
                $this->pada_dokter->ViewValue = $this->pada_dokter->optionCaption($this->pada_dokter->CurrentValue);
            } else {
                $this->pada_dokter->ViewValue = null;
            }
            $this->pada_dokter->ViewCustomAttributes = "";

            // ket_dokter
            $this->ket_dokter->ViewValue = $this->ket_dokter->CurrentValue;
            $this->ket_dokter->ViewCustomAttributes = "";

            // rencana
            $this->rencana->ViewValue = $this->rencana->CurrentValue;
            $this->rencana->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // id_penilaian_awal_keperawatan
            $this->id_penilaian_awal_keperawatan->ViewValue = $this->id_penilaian_awal_keperawatan->CurrentValue;
            $this->id_penilaian_awal_keperawatan->ViewCustomAttributes = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";
            $this->tanggal->TooltipValue = "";

            // informasi
            $this->informasi->LinkCustomAttributes = "";
            $this->informasi->HrefValue = "";
            $this->informasi->TooltipValue = "";

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

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";
            $this->gcs->TooltipValue = "";

            // bb
            $this->bb->LinkCustomAttributes = "";
            $this->bb->HrefValue = "";
            $this->bb->TooltipValue = "";

            // tb
            $this->tb->LinkCustomAttributes = "";
            $this->tb->HrefValue = "";
            $this->tb->TooltipValue = "";

            // bmi
            $this->bmi->LinkCustomAttributes = "";
            $this->bmi->HrefValue = "";
            $this->bmi->TooltipValue = "";

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";
            $this->keluhan_utama->TooltipValue = "";

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

            // alat_bantu
            $this->alat_bantu->LinkCustomAttributes = "";
            $this->alat_bantu->HrefValue = "";
            $this->alat_bantu->TooltipValue = "";

            // ket_bantu
            $this->ket_bantu->LinkCustomAttributes = "";
            $this->ket_bantu->HrefValue = "";
            $this->ket_bantu->TooltipValue = "";

            // prothesa
            $this->prothesa->LinkCustomAttributes = "";
            $this->prothesa->HrefValue = "";
            $this->prothesa->TooltipValue = "";

            // ket_pro
            $this->ket_pro->LinkCustomAttributes = "";
            $this->ket_pro->HrefValue = "";
            $this->ket_pro->TooltipValue = "";

            // adl
            $this->adl->LinkCustomAttributes = "";
            $this->adl->HrefValue = "";
            $this->adl->TooltipValue = "";

            // status_psiko
            $this->status_psiko->LinkCustomAttributes = "";
            $this->status_psiko->HrefValue = "";
            $this->status_psiko->TooltipValue = "";

            // ket_psiko
            $this->ket_psiko->LinkCustomAttributes = "";
            $this->ket_psiko->HrefValue = "";
            $this->ket_psiko->TooltipValue = "";

            // hub_keluarga
            $this->hub_keluarga->LinkCustomAttributes = "";
            $this->hub_keluarga->HrefValue = "";
            $this->hub_keluarga->TooltipValue = "";

            // tinggal_dengan
            $this->tinggal_dengan->LinkCustomAttributes = "";
            $this->tinggal_dengan->HrefValue = "";
            $this->tinggal_dengan->TooltipValue = "";

            // ket_tinggal
            $this->ket_tinggal->LinkCustomAttributes = "";
            $this->ket_tinggal->HrefValue = "";
            $this->ket_tinggal->TooltipValue = "";

            // ekonomi
            $this->ekonomi->LinkCustomAttributes = "";
            $this->ekonomi->HrefValue = "";
            $this->ekonomi->TooltipValue = "";

            // budaya
            $this->budaya->LinkCustomAttributes = "";
            $this->budaya->HrefValue = "";
            $this->budaya->TooltipValue = "";

            // ket_budaya
            $this->ket_budaya->LinkCustomAttributes = "";
            $this->ket_budaya->HrefValue = "";
            $this->ket_budaya->TooltipValue = "";

            // edukasi
            $this->edukasi->LinkCustomAttributes = "";
            $this->edukasi->HrefValue = "";
            $this->edukasi->TooltipValue = "";

            // ket_edukasi
            $this->ket_edukasi->LinkCustomAttributes = "";
            $this->ket_edukasi->HrefValue = "";
            $this->ket_edukasi->TooltipValue = "";

            // berjalan_a
            $this->berjalan_a->LinkCustomAttributes = "";
            $this->berjalan_a->HrefValue = "";
            $this->berjalan_a->TooltipValue = "";

            // berjalan_b
            $this->berjalan_b->LinkCustomAttributes = "";
            $this->berjalan_b->HrefValue = "";
            $this->berjalan_b->TooltipValue = "";

            // berjalan_c
            $this->berjalan_c->LinkCustomAttributes = "";
            $this->berjalan_c->HrefValue = "";
            $this->berjalan_c->TooltipValue = "";

            // hasil
            $this->hasil->LinkCustomAttributes = "";
            $this->hasil->HrefValue = "";
            $this->hasil->TooltipValue = "";

            // lapor
            $this->lapor->LinkCustomAttributes = "";
            $this->lapor->HrefValue = "";
            $this->lapor->TooltipValue = "";

            // ket_lapor
            $this->ket_lapor->LinkCustomAttributes = "";
            $this->ket_lapor->HrefValue = "";
            $this->ket_lapor->TooltipValue = "";

            // sg1
            $this->sg1->LinkCustomAttributes = "";
            $this->sg1->HrefValue = "";
            $this->sg1->TooltipValue = "";

            // nilai1
            $this->nilai1->LinkCustomAttributes = "";
            $this->nilai1->HrefValue = "";
            $this->nilai1->TooltipValue = "";

            // sg2
            $this->sg2->LinkCustomAttributes = "";
            $this->sg2->HrefValue = "";
            $this->sg2->TooltipValue = "";

            // nilai2
            $this->nilai2->LinkCustomAttributes = "";
            $this->nilai2->HrefValue = "";
            $this->nilai2->TooltipValue = "";

            // total_hasil
            $this->total_hasil->LinkCustomAttributes = "";
            $this->total_hasil->HrefValue = "";
            $this->total_hasil->TooltipValue = "";

            // nyeri
            $this->nyeri->LinkCustomAttributes = "";
            $this->nyeri->HrefValue = "";
            $this->nyeri->TooltipValue = "";

            // provokes
            $this->provokes->LinkCustomAttributes = "";
            $this->provokes->HrefValue = "";
            $this->provokes->TooltipValue = "";

            // ket_provokes
            $this->ket_provokes->LinkCustomAttributes = "";
            $this->ket_provokes->HrefValue = "";
            $this->ket_provokes->TooltipValue = "";

            // quality
            $this->quality->LinkCustomAttributes = "";
            $this->quality->HrefValue = "";
            $this->quality->TooltipValue = "";

            // ket_quality
            $this->ket_quality->LinkCustomAttributes = "";
            $this->ket_quality->HrefValue = "";
            $this->ket_quality->TooltipValue = "";

            // lokasi
            $this->lokasi->LinkCustomAttributes = "";
            $this->lokasi->HrefValue = "";
            $this->lokasi->TooltipValue = "";

            // menyebar
            $this->menyebar->LinkCustomAttributes = "";
            $this->menyebar->HrefValue = "";
            $this->menyebar->TooltipValue = "";

            // skala_nyeri
            $this->skala_nyeri->LinkCustomAttributes = "";
            $this->skala_nyeri->HrefValue = "";
            $this->skala_nyeri->TooltipValue = "";

            // durasi
            $this->durasi->LinkCustomAttributes = "";
            $this->durasi->HrefValue = "";
            $this->durasi->TooltipValue = "";

            // nyeri_hilang
            $this->nyeri_hilang->LinkCustomAttributes = "";
            $this->nyeri_hilang->HrefValue = "";
            $this->nyeri_hilang->TooltipValue = "";

            // ket_nyeri
            $this->ket_nyeri->LinkCustomAttributes = "";
            $this->ket_nyeri->HrefValue = "";
            $this->ket_nyeri->TooltipValue = "";

            // pada_dokter
            $this->pada_dokter->LinkCustomAttributes = "";
            $this->pada_dokter->HrefValue = "";
            $this->pada_dokter->TooltipValue = "";

            // ket_dokter
            $this->ket_dokter->LinkCustomAttributes = "";
            $this->ket_dokter->HrefValue = "";
            $this->ket_dokter->TooltipValue = "";

            // rencana
            $this->rencana->LinkCustomAttributes = "";
            $this->rencana->HrefValue = "";
            $this->rencana->TooltipValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";
            $this->nip->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // tanggal

            // informasi
            $this->informasi->EditCustomAttributes = "";
            $this->informasi->EditValue = $this->informasi->options(false);
            $this->informasi->PlaceHolder = RemoveHtml($this->informasi->caption());

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

            // gcs
            $this->gcs->EditAttrs["class"] = "form-control";
            $this->gcs->EditCustomAttributes = "";
            if (!$this->gcs->Raw) {
                $this->gcs->CurrentValue = HtmlDecode($this->gcs->CurrentValue);
            }
            $this->gcs->EditValue = HtmlEncode($this->gcs->CurrentValue);
            $this->gcs->PlaceHolder = RemoveHtml($this->gcs->caption());

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

            // bmi
            $this->bmi->EditAttrs["class"] = "form-control";
            $this->bmi->EditCustomAttributes = "";
            if (!$this->bmi->Raw) {
                $this->bmi->CurrentValue = HtmlDecode($this->bmi->CurrentValue);
            }
            $this->bmi->EditValue = HtmlEncode($this->bmi->CurrentValue);
            $this->bmi->PlaceHolder = RemoveHtml($this->bmi->caption());

            // keluhan_utama
            $this->keluhan_utama->EditAttrs["class"] = "form-control";
            $this->keluhan_utama->EditCustomAttributes = "";
            if (!$this->keluhan_utama->Raw) {
                $this->keluhan_utama->CurrentValue = HtmlDecode($this->keluhan_utama->CurrentValue);
            }
            $this->keluhan_utama->EditValue = HtmlEncode($this->keluhan_utama->CurrentValue);
            $this->keluhan_utama->PlaceHolder = RemoveHtml($this->keluhan_utama->caption());

            // rpd
            $this->rpd->EditAttrs["class"] = "form-control";
            $this->rpd->EditCustomAttributes = "";
            if (!$this->rpd->Raw) {
                $this->rpd->CurrentValue = HtmlDecode($this->rpd->CurrentValue);
            }
            $this->rpd->EditValue = HtmlEncode($this->rpd->CurrentValue);
            $this->rpd->PlaceHolder = RemoveHtml($this->rpd->caption());

            // rpk
            $this->rpk->EditAttrs["class"] = "form-control";
            $this->rpk->EditCustomAttributes = "";
            if (!$this->rpk->Raw) {
                $this->rpk->CurrentValue = HtmlDecode($this->rpk->CurrentValue);
            }
            $this->rpk->EditValue = HtmlEncode($this->rpk->CurrentValue);
            $this->rpk->PlaceHolder = RemoveHtml($this->rpk->caption());

            // rpo
            $this->rpo->EditAttrs["class"] = "form-control";
            $this->rpo->EditCustomAttributes = "";
            if (!$this->rpo->Raw) {
                $this->rpo->CurrentValue = HtmlDecode($this->rpo->CurrentValue);
            }
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

            // alat_bantu
            $this->alat_bantu->EditCustomAttributes = "";
            $this->alat_bantu->EditValue = $this->alat_bantu->options(false);
            $this->alat_bantu->PlaceHolder = RemoveHtml($this->alat_bantu->caption());

            // ket_bantu
            $this->ket_bantu->EditAttrs["class"] = "form-control";
            $this->ket_bantu->EditCustomAttributes = "";
            if (!$this->ket_bantu->Raw) {
                $this->ket_bantu->CurrentValue = HtmlDecode($this->ket_bantu->CurrentValue);
            }
            $this->ket_bantu->EditValue = HtmlEncode($this->ket_bantu->CurrentValue);
            $this->ket_bantu->PlaceHolder = RemoveHtml($this->ket_bantu->caption());

            // prothesa
            $this->prothesa->EditCustomAttributes = "";
            $this->prothesa->EditValue = $this->prothesa->options(false);
            $this->prothesa->PlaceHolder = RemoveHtml($this->prothesa->caption());

            // ket_pro
            $this->ket_pro->EditAttrs["class"] = "form-control";
            $this->ket_pro->EditCustomAttributes = "";
            if (!$this->ket_pro->Raw) {
                $this->ket_pro->CurrentValue = HtmlDecode($this->ket_pro->CurrentValue);
            }
            $this->ket_pro->EditValue = HtmlEncode($this->ket_pro->CurrentValue);
            $this->ket_pro->PlaceHolder = RemoveHtml($this->ket_pro->caption());

            // adl
            $this->adl->EditCustomAttributes = "";
            $this->adl->EditValue = $this->adl->options(false);
            $this->adl->PlaceHolder = RemoveHtml($this->adl->caption());

            // status_psiko
            $this->status_psiko->EditCustomAttributes = "";
            $this->status_psiko->EditValue = $this->status_psiko->options(false);
            $this->status_psiko->PlaceHolder = RemoveHtml($this->status_psiko->caption());

            // ket_psiko
            $this->ket_psiko->EditAttrs["class"] = "form-control";
            $this->ket_psiko->EditCustomAttributes = "";
            if (!$this->ket_psiko->Raw) {
                $this->ket_psiko->CurrentValue = HtmlDecode($this->ket_psiko->CurrentValue);
            }
            $this->ket_psiko->EditValue = HtmlEncode($this->ket_psiko->CurrentValue);
            $this->ket_psiko->PlaceHolder = RemoveHtml($this->ket_psiko->caption());

            // hub_keluarga
            $this->hub_keluarga->EditCustomAttributes = "";
            $this->hub_keluarga->EditValue = $this->hub_keluarga->options(false);
            $this->hub_keluarga->PlaceHolder = RemoveHtml($this->hub_keluarga->caption());

            // tinggal_dengan
            $this->tinggal_dengan->EditCustomAttributes = "";
            $this->tinggal_dengan->EditValue = $this->tinggal_dengan->options(false);
            $this->tinggal_dengan->PlaceHolder = RemoveHtml($this->tinggal_dengan->caption());

            // ket_tinggal
            $this->ket_tinggal->EditAttrs["class"] = "form-control";
            $this->ket_tinggal->EditCustomAttributes = "";
            if (!$this->ket_tinggal->Raw) {
                $this->ket_tinggal->CurrentValue = HtmlDecode($this->ket_tinggal->CurrentValue);
            }
            $this->ket_tinggal->EditValue = HtmlEncode($this->ket_tinggal->CurrentValue);
            $this->ket_tinggal->PlaceHolder = RemoveHtml($this->ket_tinggal->caption());

            // ekonomi
            $this->ekonomi->EditCustomAttributes = "";
            $this->ekonomi->EditValue = $this->ekonomi->options(false);
            $this->ekonomi->PlaceHolder = RemoveHtml($this->ekonomi->caption());

            // budaya
            $this->budaya->EditCustomAttributes = "";
            $this->budaya->EditValue = $this->budaya->options(false);
            $this->budaya->PlaceHolder = RemoveHtml($this->budaya->caption());

            // ket_budaya
            $this->ket_budaya->EditAttrs["class"] = "form-control";
            $this->ket_budaya->EditCustomAttributes = "";
            if (!$this->ket_budaya->Raw) {
                $this->ket_budaya->CurrentValue = HtmlDecode($this->ket_budaya->CurrentValue);
            }
            $this->ket_budaya->EditValue = HtmlEncode($this->ket_budaya->CurrentValue);
            $this->ket_budaya->PlaceHolder = RemoveHtml($this->ket_budaya->caption());

            // edukasi
            $this->edukasi->EditCustomAttributes = "";
            $this->edukasi->EditValue = $this->edukasi->options(false);
            $this->edukasi->PlaceHolder = RemoveHtml($this->edukasi->caption());

            // ket_edukasi
            $this->ket_edukasi->EditAttrs["class"] = "form-control";
            $this->ket_edukasi->EditCustomAttributes = "";
            if (!$this->ket_edukasi->Raw) {
                $this->ket_edukasi->CurrentValue = HtmlDecode($this->ket_edukasi->CurrentValue);
            }
            $this->ket_edukasi->EditValue = HtmlEncode($this->ket_edukasi->CurrentValue);
            $this->ket_edukasi->PlaceHolder = RemoveHtml($this->ket_edukasi->caption());

            // berjalan_a
            $this->berjalan_a->EditCustomAttributes = "";
            $this->berjalan_a->EditValue = $this->berjalan_a->options(false);
            $this->berjalan_a->PlaceHolder = RemoveHtml($this->berjalan_a->caption());

            // berjalan_b
            $this->berjalan_b->EditCustomAttributes = "";
            $this->berjalan_b->EditValue = $this->berjalan_b->options(false);
            $this->berjalan_b->PlaceHolder = RemoveHtml($this->berjalan_b->caption());

            // berjalan_c
            $this->berjalan_c->EditCustomAttributes = "";
            $this->berjalan_c->EditValue = $this->berjalan_c->options(false);
            $this->berjalan_c->PlaceHolder = RemoveHtml($this->berjalan_c->caption());

            // hasil
            $this->hasil->EditCustomAttributes = "";
            $this->hasil->EditValue = $this->hasil->options(false);
            $this->hasil->PlaceHolder = RemoveHtml($this->hasil->caption());

            // lapor
            $this->lapor->EditCustomAttributes = "";
            $this->lapor->EditValue = $this->lapor->options(false);
            $this->lapor->PlaceHolder = RemoveHtml($this->lapor->caption());

            // ket_lapor
            $this->ket_lapor->EditAttrs["class"] = "form-control";
            $this->ket_lapor->EditCustomAttributes = "";
            if (!$this->ket_lapor->Raw) {
                $this->ket_lapor->CurrentValue = HtmlDecode($this->ket_lapor->CurrentValue);
            }
            $this->ket_lapor->EditValue = HtmlEncode($this->ket_lapor->CurrentValue);
            $this->ket_lapor->PlaceHolder = RemoveHtml($this->ket_lapor->caption());

            // sg1
            $this->sg1->EditCustomAttributes = "";
            $this->sg1->EditValue = $this->sg1->options(false);
            $this->sg1->PlaceHolder = RemoveHtml($this->sg1->caption());

            // nilai1
            $this->nilai1->EditCustomAttributes = "";
            $this->nilai1->EditValue = $this->nilai1->options(false);
            $this->nilai1->PlaceHolder = RemoveHtml($this->nilai1->caption());

            // sg2
            $this->sg2->EditCustomAttributes = "";
            $this->sg2->EditValue = $this->sg2->options(false);
            $this->sg2->PlaceHolder = RemoveHtml($this->sg2->caption());

            // nilai2
            $this->nilai2->EditCustomAttributes = "";
            $this->nilai2->EditValue = $this->nilai2->options(false);
            $this->nilai2->PlaceHolder = RemoveHtml($this->nilai2->caption());

            // total_hasil
            $this->total_hasil->EditAttrs["class"] = "form-control";
            $this->total_hasil->EditCustomAttributes = "";
            $this->total_hasil->EditValue = HtmlEncode($this->total_hasil->CurrentValue);
            $this->total_hasil->PlaceHolder = RemoveHtml($this->total_hasil->caption());

            // nyeri
            $this->nyeri->EditCustomAttributes = "";
            $this->nyeri->EditValue = $this->nyeri->options(false);
            $this->nyeri->PlaceHolder = RemoveHtml($this->nyeri->caption());

            // provokes
            $this->provokes->EditCustomAttributes = "";
            $this->provokes->EditValue = $this->provokes->options(false);
            $this->provokes->PlaceHolder = RemoveHtml($this->provokes->caption());

            // ket_provokes
            $this->ket_provokes->EditAttrs["class"] = "form-control";
            $this->ket_provokes->EditCustomAttributes = "";
            if (!$this->ket_provokes->Raw) {
                $this->ket_provokes->CurrentValue = HtmlDecode($this->ket_provokes->CurrentValue);
            }
            $this->ket_provokes->EditValue = HtmlEncode($this->ket_provokes->CurrentValue);
            $this->ket_provokes->PlaceHolder = RemoveHtml($this->ket_provokes->caption());

            // quality
            $this->quality->EditCustomAttributes = "";
            $this->quality->EditValue = $this->quality->options(false);
            $this->quality->PlaceHolder = RemoveHtml($this->quality->caption());

            // ket_quality
            $this->ket_quality->EditAttrs["class"] = "form-control";
            $this->ket_quality->EditCustomAttributes = "";
            if (!$this->ket_quality->Raw) {
                $this->ket_quality->CurrentValue = HtmlDecode($this->ket_quality->CurrentValue);
            }
            $this->ket_quality->EditValue = HtmlEncode($this->ket_quality->CurrentValue);
            $this->ket_quality->PlaceHolder = RemoveHtml($this->ket_quality->caption());

            // lokasi
            $this->lokasi->EditAttrs["class"] = "form-control";
            $this->lokasi->EditCustomAttributes = "";
            if (!$this->lokasi->Raw) {
                $this->lokasi->CurrentValue = HtmlDecode($this->lokasi->CurrentValue);
            }
            $this->lokasi->EditValue = HtmlEncode($this->lokasi->CurrentValue);
            $this->lokasi->PlaceHolder = RemoveHtml($this->lokasi->caption());

            // menyebar
            $this->menyebar->EditCustomAttributes = "";
            $this->menyebar->EditValue = $this->menyebar->options(false);
            $this->menyebar->PlaceHolder = RemoveHtml($this->menyebar->caption());

            // skala_nyeri
            $this->skala_nyeri->EditCustomAttributes = "";
            $this->skala_nyeri->EditValue = $this->skala_nyeri->options(false);
            $this->skala_nyeri->PlaceHolder = RemoveHtml($this->skala_nyeri->caption());

            // durasi
            $this->durasi->EditAttrs["class"] = "form-control";
            $this->durasi->EditCustomAttributes = "";
            if (!$this->durasi->Raw) {
                $this->durasi->CurrentValue = HtmlDecode($this->durasi->CurrentValue);
            }
            $this->durasi->EditValue = HtmlEncode($this->durasi->CurrentValue);
            $this->durasi->PlaceHolder = RemoveHtml($this->durasi->caption());

            // nyeri_hilang
            $this->nyeri_hilang->EditCustomAttributes = "";
            $this->nyeri_hilang->EditValue = $this->nyeri_hilang->options(false);
            $this->nyeri_hilang->PlaceHolder = RemoveHtml($this->nyeri_hilang->caption());

            // ket_nyeri
            $this->ket_nyeri->EditAttrs["class"] = "form-control";
            $this->ket_nyeri->EditCustomAttributes = "";
            if (!$this->ket_nyeri->Raw) {
                $this->ket_nyeri->CurrentValue = HtmlDecode($this->ket_nyeri->CurrentValue);
            }
            $this->ket_nyeri->EditValue = HtmlEncode($this->ket_nyeri->CurrentValue);
            $this->ket_nyeri->PlaceHolder = RemoveHtml($this->ket_nyeri->caption());

            // pada_dokter
            $this->pada_dokter->EditCustomAttributes = "";
            $this->pada_dokter->EditValue = $this->pada_dokter->options(false);
            $this->pada_dokter->PlaceHolder = RemoveHtml($this->pada_dokter->caption());

            // ket_dokter
            $this->ket_dokter->EditAttrs["class"] = "form-control";
            $this->ket_dokter->EditCustomAttributes = "";
            if (!$this->ket_dokter->Raw) {
                $this->ket_dokter->CurrentValue = HtmlDecode($this->ket_dokter->CurrentValue);
            }
            $this->ket_dokter->EditValue = HtmlEncode($this->ket_dokter->CurrentValue);
            $this->ket_dokter->PlaceHolder = RemoveHtml($this->ket_dokter->caption());

            // rencana
            $this->rencana->EditAttrs["class"] = "form-control";
            $this->rencana->EditCustomAttributes = "";
            if (!$this->rencana->Raw) {
                $this->rencana->CurrentValue = HtmlDecode($this->rencana->CurrentValue);
            }
            $this->rencana->EditValue = HtmlEncode($this->rencana->CurrentValue);
            $this->rencana->PlaceHolder = RemoveHtml($this->rencana->caption());

            // nip
            $this->nip->EditAttrs["class"] = "form-control";
            $this->nip->EditCustomAttributes = "";
            if (!$this->nip->Raw) {
                $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
            }
            $this->nip->EditValue = HtmlEncode($this->nip->CurrentValue);
            $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

            // Add refer script

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";

            // informasi
            $this->informasi->LinkCustomAttributes = "";
            $this->informasi->HrefValue = "";

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

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";

            // bb
            $this->bb->LinkCustomAttributes = "";
            $this->bb->HrefValue = "";

            // tb
            $this->tb->LinkCustomAttributes = "";
            $this->tb->HrefValue = "";

            // bmi
            $this->bmi->LinkCustomAttributes = "";
            $this->bmi->HrefValue = "";

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";

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

            // alat_bantu
            $this->alat_bantu->LinkCustomAttributes = "";
            $this->alat_bantu->HrefValue = "";

            // ket_bantu
            $this->ket_bantu->LinkCustomAttributes = "";
            $this->ket_bantu->HrefValue = "";

            // prothesa
            $this->prothesa->LinkCustomAttributes = "";
            $this->prothesa->HrefValue = "";

            // ket_pro
            $this->ket_pro->LinkCustomAttributes = "";
            $this->ket_pro->HrefValue = "";

            // adl
            $this->adl->LinkCustomAttributes = "";
            $this->adl->HrefValue = "";

            // status_psiko
            $this->status_psiko->LinkCustomAttributes = "";
            $this->status_psiko->HrefValue = "";

            // ket_psiko
            $this->ket_psiko->LinkCustomAttributes = "";
            $this->ket_psiko->HrefValue = "";

            // hub_keluarga
            $this->hub_keluarga->LinkCustomAttributes = "";
            $this->hub_keluarga->HrefValue = "";

            // tinggal_dengan
            $this->tinggal_dengan->LinkCustomAttributes = "";
            $this->tinggal_dengan->HrefValue = "";

            // ket_tinggal
            $this->ket_tinggal->LinkCustomAttributes = "";
            $this->ket_tinggal->HrefValue = "";

            // ekonomi
            $this->ekonomi->LinkCustomAttributes = "";
            $this->ekonomi->HrefValue = "";

            // budaya
            $this->budaya->LinkCustomAttributes = "";
            $this->budaya->HrefValue = "";

            // ket_budaya
            $this->ket_budaya->LinkCustomAttributes = "";
            $this->ket_budaya->HrefValue = "";

            // edukasi
            $this->edukasi->LinkCustomAttributes = "";
            $this->edukasi->HrefValue = "";

            // ket_edukasi
            $this->ket_edukasi->LinkCustomAttributes = "";
            $this->ket_edukasi->HrefValue = "";

            // berjalan_a
            $this->berjalan_a->LinkCustomAttributes = "";
            $this->berjalan_a->HrefValue = "";

            // berjalan_b
            $this->berjalan_b->LinkCustomAttributes = "";
            $this->berjalan_b->HrefValue = "";

            // berjalan_c
            $this->berjalan_c->LinkCustomAttributes = "";
            $this->berjalan_c->HrefValue = "";

            // hasil
            $this->hasil->LinkCustomAttributes = "";
            $this->hasil->HrefValue = "";

            // lapor
            $this->lapor->LinkCustomAttributes = "";
            $this->lapor->HrefValue = "";

            // ket_lapor
            $this->ket_lapor->LinkCustomAttributes = "";
            $this->ket_lapor->HrefValue = "";

            // sg1
            $this->sg1->LinkCustomAttributes = "";
            $this->sg1->HrefValue = "";

            // nilai1
            $this->nilai1->LinkCustomAttributes = "";
            $this->nilai1->HrefValue = "";

            // sg2
            $this->sg2->LinkCustomAttributes = "";
            $this->sg2->HrefValue = "";

            // nilai2
            $this->nilai2->LinkCustomAttributes = "";
            $this->nilai2->HrefValue = "";

            // total_hasil
            $this->total_hasil->LinkCustomAttributes = "";
            $this->total_hasil->HrefValue = "";

            // nyeri
            $this->nyeri->LinkCustomAttributes = "";
            $this->nyeri->HrefValue = "";

            // provokes
            $this->provokes->LinkCustomAttributes = "";
            $this->provokes->HrefValue = "";

            // ket_provokes
            $this->ket_provokes->LinkCustomAttributes = "";
            $this->ket_provokes->HrefValue = "";

            // quality
            $this->quality->LinkCustomAttributes = "";
            $this->quality->HrefValue = "";

            // ket_quality
            $this->ket_quality->LinkCustomAttributes = "";
            $this->ket_quality->HrefValue = "";

            // lokasi
            $this->lokasi->LinkCustomAttributes = "";
            $this->lokasi->HrefValue = "";

            // menyebar
            $this->menyebar->LinkCustomAttributes = "";
            $this->menyebar->HrefValue = "";

            // skala_nyeri
            $this->skala_nyeri->LinkCustomAttributes = "";
            $this->skala_nyeri->HrefValue = "";

            // durasi
            $this->durasi->LinkCustomAttributes = "";
            $this->durasi->HrefValue = "";

            // nyeri_hilang
            $this->nyeri_hilang->LinkCustomAttributes = "";
            $this->nyeri_hilang->HrefValue = "";

            // ket_nyeri
            $this->ket_nyeri->LinkCustomAttributes = "";
            $this->ket_nyeri->HrefValue = "";

            // pada_dokter
            $this->pada_dokter->LinkCustomAttributes = "";
            $this->pada_dokter->HrefValue = "";

            // ket_dokter
            $this->ket_dokter->LinkCustomAttributes = "";
            $this->ket_dokter->HrefValue = "";

            // rencana
            $this->rencana->LinkCustomAttributes = "";
            $this->rencana->HrefValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";
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
        if ($this->tanggal->Required) {
            if (!$this->tanggal->IsDetailKey && EmptyValue($this->tanggal->FormValue)) {
                $this->tanggal->addErrorMessage(str_replace("%s", $this->tanggal->caption(), $this->tanggal->RequiredErrorMessage));
            }
        }
        if ($this->informasi->Required) {
            if ($this->informasi->FormValue == "") {
                $this->informasi->addErrorMessage(str_replace("%s", $this->informasi->caption(), $this->informasi->RequiredErrorMessage));
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
        if ($this->gcs->Required) {
            if (!$this->gcs->IsDetailKey && EmptyValue($this->gcs->FormValue)) {
                $this->gcs->addErrorMessage(str_replace("%s", $this->gcs->caption(), $this->gcs->RequiredErrorMessage));
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
        if ($this->bmi->Required) {
            if (!$this->bmi->IsDetailKey && EmptyValue($this->bmi->FormValue)) {
                $this->bmi->addErrorMessage(str_replace("%s", $this->bmi->caption(), $this->bmi->RequiredErrorMessage));
            }
        }
        if ($this->keluhan_utama->Required) {
            if (!$this->keluhan_utama->IsDetailKey && EmptyValue($this->keluhan_utama->FormValue)) {
                $this->keluhan_utama->addErrorMessage(str_replace("%s", $this->keluhan_utama->caption(), $this->keluhan_utama->RequiredErrorMessage));
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
        if ($this->alat_bantu->Required) {
            if ($this->alat_bantu->FormValue == "") {
                $this->alat_bantu->addErrorMessage(str_replace("%s", $this->alat_bantu->caption(), $this->alat_bantu->RequiredErrorMessage));
            }
        }
        if ($this->ket_bantu->Required) {
            if (!$this->ket_bantu->IsDetailKey && EmptyValue($this->ket_bantu->FormValue)) {
                $this->ket_bantu->addErrorMessage(str_replace("%s", $this->ket_bantu->caption(), $this->ket_bantu->RequiredErrorMessage));
            }
        }
        if ($this->prothesa->Required) {
            if ($this->prothesa->FormValue == "") {
                $this->prothesa->addErrorMessage(str_replace("%s", $this->prothesa->caption(), $this->prothesa->RequiredErrorMessage));
            }
        }
        if ($this->ket_pro->Required) {
            if (!$this->ket_pro->IsDetailKey && EmptyValue($this->ket_pro->FormValue)) {
                $this->ket_pro->addErrorMessage(str_replace("%s", $this->ket_pro->caption(), $this->ket_pro->RequiredErrorMessage));
            }
        }
        if ($this->adl->Required) {
            if ($this->adl->FormValue == "") {
                $this->adl->addErrorMessage(str_replace("%s", $this->adl->caption(), $this->adl->RequiredErrorMessage));
            }
        }
        if ($this->status_psiko->Required) {
            if ($this->status_psiko->FormValue == "") {
                $this->status_psiko->addErrorMessage(str_replace("%s", $this->status_psiko->caption(), $this->status_psiko->RequiredErrorMessage));
            }
        }
        if ($this->ket_psiko->Required) {
            if (!$this->ket_psiko->IsDetailKey && EmptyValue($this->ket_psiko->FormValue)) {
                $this->ket_psiko->addErrorMessage(str_replace("%s", $this->ket_psiko->caption(), $this->ket_psiko->RequiredErrorMessage));
            }
        }
        if ($this->hub_keluarga->Required) {
            if ($this->hub_keluarga->FormValue == "") {
                $this->hub_keluarga->addErrorMessage(str_replace("%s", $this->hub_keluarga->caption(), $this->hub_keluarga->RequiredErrorMessage));
            }
        }
        if ($this->tinggal_dengan->Required) {
            if ($this->tinggal_dengan->FormValue == "") {
                $this->tinggal_dengan->addErrorMessage(str_replace("%s", $this->tinggal_dengan->caption(), $this->tinggal_dengan->RequiredErrorMessage));
            }
        }
        if ($this->ket_tinggal->Required) {
            if (!$this->ket_tinggal->IsDetailKey && EmptyValue($this->ket_tinggal->FormValue)) {
                $this->ket_tinggal->addErrorMessage(str_replace("%s", $this->ket_tinggal->caption(), $this->ket_tinggal->RequiredErrorMessage));
            }
        }
        if ($this->ekonomi->Required) {
            if ($this->ekonomi->FormValue == "") {
                $this->ekonomi->addErrorMessage(str_replace("%s", $this->ekonomi->caption(), $this->ekonomi->RequiredErrorMessage));
            }
        }
        if ($this->budaya->Required) {
            if ($this->budaya->FormValue == "") {
                $this->budaya->addErrorMessage(str_replace("%s", $this->budaya->caption(), $this->budaya->RequiredErrorMessage));
            }
        }
        if ($this->ket_budaya->Required) {
            if (!$this->ket_budaya->IsDetailKey && EmptyValue($this->ket_budaya->FormValue)) {
                $this->ket_budaya->addErrorMessage(str_replace("%s", $this->ket_budaya->caption(), $this->ket_budaya->RequiredErrorMessage));
            }
        }
        if ($this->edukasi->Required) {
            if ($this->edukasi->FormValue == "") {
                $this->edukasi->addErrorMessage(str_replace("%s", $this->edukasi->caption(), $this->edukasi->RequiredErrorMessage));
            }
        }
        if ($this->ket_edukasi->Required) {
            if (!$this->ket_edukasi->IsDetailKey && EmptyValue($this->ket_edukasi->FormValue)) {
                $this->ket_edukasi->addErrorMessage(str_replace("%s", $this->ket_edukasi->caption(), $this->ket_edukasi->RequiredErrorMessage));
            }
        }
        if ($this->berjalan_a->Required) {
            if ($this->berjalan_a->FormValue == "") {
                $this->berjalan_a->addErrorMessage(str_replace("%s", $this->berjalan_a->caption(), $this->berjalan_a->RequiredErrorMessage));
            }
        }
        if ($this->berjalan_b->Required) {
            if ($this->berjalan_b->FormValue == "") {
                $this->berjalan_b->addErrorMessage(str_replace("%s", $this->berjalan_b->caption(), $this->berjalan_b->RequiredErrorMessage));
            }
        }
        if ($this->berjalan_c->Required) {
            if ($this->berjalan_c->FormValue == "") {
                $this->berjalan_c->addErrorMessage(str_replace("%s", $this->berjalan_c->caption(), $this->berjalan_c->RequiredErrorMessage));
            }
        }
        if ($this->hasil->Required) {
            if ($this->hasil->FormValue == "") {
                $this->hasil->addErrorMessage(str_replace("%s", $this->hasil->caption(), $this->hasil->RequiredErrorMessage));
            }
        }
        if ($this->lapor->Required) {
            if ($this->lapor->FormValue == "") {
                $this->lapor->addErrorMessage(str_replace("%s", $this->lapor->caption(), $this->lapor->RequiredErrorMessage));
            }
        }
        if ($this->ket_lapor->Required) {
            if (!$this->ket_lapor->IsDetailKey && EmptyValue($this->ket_lapor->FormValue)) {
                $this->ket_lapor->addErrorMessage(str_replace("%s", $this->ket_lapor->caption(), $this->ket_lapor->RequiredErrorMessage));
            }
        }
        if ($this->sg1->Required) {
            if ($this->sg1->FormValue == "") {
                $this->sg1->addErrorMessage(str_replace("%s", $this->sg1->caption(), $this->sg1->RequiredErrorMessage));
            }
        }
        if ($this->nilai1->Required) {
            if ($this->nilai1->FormValue == "") {
                $this->nilai1->addErrorMessage(str_replace("%s", $this->nilai1->caption(), $this->nilai1->RequiredErrorMessage));
            }
        }
        if ($this->sg2->Required) {
            if ($this->sg2->FormValue == "") {
                $this->sg2->addErrorMessage(str_replace("%s", $this->sg2->caption(), $this->sg2->RequiredErrorMessage));
            }
        }
        if ($this->nilai2->Required) {
            if ($this->nilai2->FormValue == "") {
                $this->nilai2->addErrorMessage(str_replace("%s", $this->nilai2->caption(), $this->nilai2->RequiredErrorMessage));
            }
        }
        if ($this->total_hasil->Required) {
            if (!$this->total_hasil->IsDetailKey && EmptyValue($this->total_hasil->FormValue)) {
                $this->total_hasil->addErrorMessage(str_replace("%s", $this->total_hasil->caption(), $this->total_hasil->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->total_hasil->FormValue)) {
            $this->total_hasil->addErrorMessage($this->total_hasil->getErrorMessage(false));
        }
        if ($this->nyeri->Required) {
            if ($this->nyeri->FormValue == "") {
                $this->nyeri->addErrorMessage(str_replace("%s", $this->nyeri->caption(), $this->nyeri->RequiredErrorMessage));
            }
        }
        if ($this->provokes->Required) {
            if ($this->provokes->FormValue == "") {
                $this->provokes->addErrorMessage(str_replace("%s", $this->provokes->caption(), $this->provokes->RequiredErrorMessage));
            }
        }
        if ($this->ket_provokes->Required) {
            if (!$this->ket_provokes->IsDetailKey && EmptyValue($this->ket_provokes->FormValue)) {
                $this->ket_provokes->addErrorMessage(str_replace("%s", $this->ket_provokes->caption(), $this->ket_provokes->RequiredErrorMessage));
            }
        }
        if ($this->quality->Required) {
            if ($this->quality->FormValue == "") {
                $this->quality->addErrorMessage(str_replace("%s", $this->quality->caption(), $this->quality->RequiredErrorMessage));
            }
        }
        if ($this->ket_quality->Required) {
            if (!$this->ket_quality->IsDetailKey && EmptyValue($this->ket_quality->FormValue)) {
                $this->ket_quality->addErrorMessage(str_replace("%s", $this->ket_quality->caption(), $this->ket_quality->RequiredErrorMessage));
            }
        }
        if ($this->lokasi->Required) {
            if (!$this->lokasi->IsDetailKey && EmptyValue($this->lokasi->FormValue)) {
                $this->lokasi->addErrorMessage(str_replace("%s", $this->lokasi->caption(), $this->lokasi->RequiredErrorMessage));
            }
        }
        if ($this->menyebar->Required) {
            if ($this->menyebar->FormValue == "") {
                $this->menyebar->addErrorMessage(str_replace("%s", $this->menyebar->caption(), $this->menyebar->RequiredErrorMessage));
            }
        }
        if ($this->skala_nyeri->Required) {
            if ($this->skala_nyeri->FormValue == "") {
                $this->skala_nyeri->addErrorMessage(str_replace("%s", $this->skala_nyeri->caption(), $this->skala_nyeri->RequiredErrorMessage));
            }
        }
        if ($this->durasi->Required) {
            if (!$this->durasi->IsDetailKey && EmptyValue($this->durasi->FormValue)) {
                $this->durasi->addErrorMessage(str_replace("%s", $this->durasi->caption(), $this->durasi->RequiredErrorMessage));
            }
        }
        if ($this->nyeri_hilang->Required) {
            if ($this->nyeri_hilang->FormValue == "") {
                $this->nyeri_hilang->addErrorMessage(str_replace("%s", $this->nyeri_hilang->caption(), $this->nyeri_hilang->RequiredErrorMessage));
            }
        }
        if ($this->ket_nyeri->Required) {
            if (!$this->ket_nyeri->IsDetailKey && EmptyValue($this->ket_nyeri->FormValue)) {
                $this->ket_nyeri->addErrorMessage(str_replace("%s", $this->ket_nyeri->caption(), $this->ket_nyeri->RequiredErrorMessage));
            }
        }
        if ($this->pada_dokter->Required) {
            if ($this->pada_dokter->FormValue == "") {
                $this->pada_dokter->addErrorMessage(str_replace("%s", $this->pada_dokter->caption(), $this->pada_dokter->RequiredErrorMessage));
            }
        }
        if ($this->ket_dokter->Required) {
            if (!$this->ket_dokter->IsDetailKey && EmptyValue($this->ket_dokter->FormValue)) {
                $this->ket_dokter->addErrorMessage(str_replace("%s", $this->ket_dokter->caption(), $this->ket_dokter->RequiredErrorMessage));
            }
        }
        if ($this->rencana->Required) {
            if (!$this->rencana->IsDetailKey && EmptyValue($this->rencana->FormValue)) {
                $this->rencana->addErrorMessage(str_replace("%s", $this->rencana->caption(), $this->rencana->RequiredErrorMessage));
            }
        }
        if ($this->nip->Required) {
            if (!$this->nip->IsDetailKey && EmptyValue($this->nip->FormValue)) {
                $this->nip->addErrorMessage(str_replace("%s", $this->nip->caption(), $this->nip->RequiredErrorMessage));
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

        // Check referential integrity for master table 'penilaian_awal_keperawatan_ralan'
        $validMasterRecord = true;
        $masterFilter = $this->sqlMasterFilter_vrajal();
        if ($this->no_rawat->getSessionValue() != "") {
        $masterFilter = str_replace("@id_reg@", AdjustSql($this->no_rawat->getSessionValue(), "DB"), $masterFilter);
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

        // tanggal
        $this->tanggal->CurrentValue = CurrentDate();
        $this->tanggal->setDbValueDef($rsnew, $this->tanggal->CurrentValue, CurrentDate());

        // informasi
        $this->informasi->setDbValueDef($rsnew, $this->informasi->CurrentValue, "", false);

        // td
        $this->td->setDbValueDef($rsnew, $this->td->CurrentValue, "", false);

        // nadi
        $this->nadi->setDbValueDef($rsnew, $this->nadi->CurrentValue, "", false);

        // rr
        $this->rr->setDbValueDef($rsnew, $this->rr->CurrentValue, "", false);

        // suhu
        $this->suhu->setDbValueDef($rsnew, $this->suhu->CurrentValue, "", false);

        // gcs
        $this->gcs->setDbValueDef($rsnew, $this->gcs->CurrentValue, "", false);

        // bb
        $this->bb->setDbValueDef($rsnew, $this->bb->CurrentValue, "", false);

        // tb
        $this->tb->setDbValueDef($rsnew, $this->tb->CurrentValue, "", false);

        // bmi
        $this->bmi->setDbValueDef($rsnew, $this->bmi->CurrentValue, "", false);

        // keluhan_utama
        $this->keluhan_utama->setDbValueDef($rsnew, $this->keluhan_utama->CurrentValue, "", false);

        // rpd
        $this->rpd->setDbValueDef($rsnew, $this->rpd->CurrentValue, "", false);

        // rpk
        $this->rpk->setDbValueDef($rsnew, $this->rpk->CurrentValue, "", false);

        // rpo
        $this->rpo->setDbValueDef($rsnew, $this->rpo->CurrentValue, "", false);

        // alergi
        $this->alergi->setDbValueDef($rsnew, $this->alergi->CurrentValue, "", false);

        // alat_bantu
        $this->alat_bantu->setDbValueDef($rsnew, $this->alat_bantu->CurrentValue, "", false);

        // ket_bantu
        $this->ket_bantu->setDbValueDef($rsnew, $this->ket_bantu->CurrentValue, "", false);

        // prothesa
        $this->prothesa->setDbValueDef($rsnew, $this->prothesa->CurrentValue, "", false);

        // ket_pro
        $this->ket_pro->setDbValueDef($rsnew, $this->ket_pro->CurrentValue, "", false);

        // adl
        $this->adl->setDbValueDef($rsnew, $this->adl->CurrentValue, "", false);

        // status_psiko
        $this->status_psiko->setDbValueDef($rsnew, $this->status_psiko->CurrentValue, "", false);

        // ket_psiko
        $this->ket_psiko->setDbValueDef($rsnew, $this->ket_psiko->CurrentValue, "", false);

        // hub_keluarga
        $this->hub_keluarga->setDbValueDef($rsnew, $this->hub_keluarga->CurrentValue, "", false);

        // tinggal_dengan
        $this->tinggal_dengan->setDbValueDef($rsnew, $this->tinggal_dengan->CurrentValue, "", false);

        // ket_tinggal
        $this->ket_tinggal->setDbValueDef($rsnew, $this->ket_tinggal->CurrentValue, "", false);

        // ekonomi
        $this->ekonomi->setDbValueDef($rsnew, $this->ekonomi->CurrentValue, "", false);

        // budaya
        $this->budaya->setDbValueDef($rsnew, $this->budaya->CurrentValue, "", false);

        // ket_budaya
        $this->ket_budaya->setDbValueDef($rsnew, $this->ket_budaya->CurrentValue, "", false);

        // edukasi
        $this->edukasi->setDbValueDef($rsnew, $this->edukasi->CurrentValue, "", false);

        // ket_edukasi
        $this->ket_edukasi->setDbValueDef($rsnew, $this->ket_edukasi->CurrentValue, "", false);

        // berjalan_a
        $this->berjalan_a->setDbValueDef($rsnew, $this->berjalan_a->CurrentValue, "", false);

        // berjalan_b
        $this->berjalan_b->setDbValueDef($rsnew, $this->berjalan_b->CurrentValue, "", false);

        // berjalan_c
        $this->berjalan_c->setDbValueDef($rsnew, $this->berjalan_c->CurrentValue, "", false);

        // hasil
        $this->hasil->setDbValueDef($rsnew, $this->hasil->CurrentValue, "", false);

        // lapor
        $this->lapor->setDbValueDef($rsnew, $this->lapor->CurrentValue, "", false);

        // ket_lapor
        $this->ket_lapor->setDbValueDef($rsnew, $this->ket_lapor->CurrentValue, "", false);

        // sg1
        $this->sg1->setDbValueDef($rsnew, $this->sg1->CurrentValue, "", false);

        // nilai1
        $this->nilai1->setDbValueDef($rsnew, $this->nilai1->CurrentValue, "", false);

        // sg2
        $this->sg2->setDbValueDef($rsnew, $this->sg2->CurrentValue, "", false);

        // nilai2
        $tmpBool = $this->nilai2->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->nilai2->setDbValueDef($rsnew, $tmpBool, 0, false);

        // total_hasil
        $this->total_hasil->setDbValueDef($rsnew, $this->total_hasil->CurrentValue, 0, false);

        // nyeri
        $this->nyeri->setDbValueDef($rsnew, $this->nyeri->CurrentValue, "", false);

        // provokes
        $this->provokes->setDbValueDef($rsnew, $this->provokes->CurrentValue, "", false);

        // ket_provokes
        $this->ket_provokes->setDbValueDef($rsnew, $this->ket_provokes->CurrentValue, "", false);

        // quality
        $this->quality->setDbValueDef($rsnew, $this->quality->CurrentValue, "", false);

        // ket_quality
        $this->ket_quality->setDbValueDef($rsnew, $this->ket_quality->CurrentValue, "", false);

        // lokasi
        $this->lokasi->setDbValueDef($rsnew, $this->lokasi->CurrentValue, "", false);

        // menyebar
        $this->menyebar->setDbValueDef($rsnew, $this->menyebar->CurrentValue, "", false);

        // skala_nyeri
        $this->skala_nyeri->setDbValueDef($rsnew, $this->skala_nyeri->CurrentValue, "", false);

        // durasi
        $this->durasi->setDbValueDef($rsnew, $this->durasi->CurrentValue, "", false);

        // nyeri_hilang
        $this->nyeri_hilang->setDbValueDef($rsnew, $this->nyeri_hilang->CurrentValue, "", false);

        // ket_nyeri
        $this->ket_nyeri->setDbValueDef($rsnew, $this->ket_nyeri->CurrentValue, "", false);

        // pada_dokter
        $this->pada_dokter->setDbValueDef($rsnew, $this->pada_dokter->CurrentValue, "", false);

        // ket_dokter
        $this->ket_dokter->setDbValueDef($rsnew, $this->ket_dokter->CurrentValue, "", false);

        // rencana
        $this->rencana->setDbValueDef($rsnew, $this->rencana->CurrentValue, "", false);

        // nip
        $this->nip->setDbValueDef($rsnew, $this->nip->CurrentValue, null, false);

        // no_rawat
        if ($this->no_rawat->getSessionValue() != "") {
            $rsnew['no_rawat'] = $this->no_rawat->getSessionValue();
        }

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PenilaianAwalKeperawatanRalanList"), "", $this->TableVar, true);
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
                case "x_informasi":
                    break;
                case "x_alat_bantu":
                    break;
                case "x_prothesa":
                    break;
                case "x_adl":
                    break;
                case "x_status_psiko":
                    break;
                case "x_hub_keluarga":
                    break;
                case "x_tinggal_dengan":
                    break;
                case "x_ekonomi":
                    break;
                case "x_budaya":
                    break;
                case "x_edukasi":
                    break;
                case "x_berjalan_a":
                    break;
                case "x_berjalan_b":
                    break;
                case "x_berjalan_c":
                    break;
                case "x_hasil":
                    break;
                case "x_lapor":
                    break;
                case "x_sg1":
                    break;
                case "x_nilai1":
                    break;
                case "x_sg2":
                    break;
                case "x_nilai2":
                    break;
                case "x_nyeri":
                    break;
                case "x_provokes":
                    break;
                case "x_quality":
                    break;
                case "x_menyebar":
                    break;
                case "x_skala_nyeri":
                    break;
                case "x_nyeri_hilang":
                    break;
                case "x_pada_dokter":
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
