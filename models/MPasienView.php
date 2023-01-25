<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MPasienView extends MPasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'm_pasien';

    // Page object name
    public $PageObjName = "MPasienView";

    // Rendering View
    public $RenderingView = false;

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

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

        // Table object (m_pasien)
        if (!isset($GLOBALS["m_pasien"]) || get_class($GLOBALS["m_pasien"]) == PROJECT_NAMESPACE . "m_pasien") {
            $GLOBALS["m_pasien"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("id_pasien") ?? Route("id_pasien")) !== null) {
            $this->RecKey["id_pasien"] = $keyValue;
        }
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_pasien');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
                $doc = new $class(Container("m_pasien"));
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
                    if ($pageName == "MPasienView") {
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
    public $ExportOptions; // Export options
    public $OtherOptions; // Other options
    public $DisplayRecords = 1;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecKey = [];
    public $IsModal = false;

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
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id_pasien->setVisibility();
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
        $this->no_tlp->setVisibility();
        $this->umur->setVisibility();
        $this->pnd->setVisibility();
        $this->keluarga->setVisibility();
        $this->namakeluarga->setVisibility();
        $this->kd_pj->setVisibility();
        $this->no_peserta->setVisibility();
        $this->kd_kel->setVisibility();
        $this->kd_kec->setVisibility();
        $this->kd_kab->setVisibility();
        $this->kd_prop->setVisibility();
        $this->pekerjaanpj->setVisibility();
        $this->alamatpj->setVisibility();
        $this->kelurahanpj->setVisibility();
        $this->kecamatanpj->setVisibility();
        $this->kabupatenpj->setVisibility();
        $this->perusahaan_pasien->setVisibility();
        $this->suku_bangsa->setVisibility();
        $this->bahasa_pasien->setVisibility();
        $this->cacat_fisik->setVisibility();
        $this->_email->setVisibility();
        $this->nip->setVisibility();
        $this->propinsipj->setVisibility();
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
        $this->setupLookupOptions($this->kd_prop);
        $this->setupLookupOptions($this->perusahaan_pasien);
        $this->setupLookupOptions($this->suku_bangsa);
        $this->setupLookupOptions($this->bahasa_pasien);
        $this->setupLookupOptions($this->cacat_fisik);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("id_pasien") ?? Route("id_pasien")) !== null) {
                $this->id_pasien->setQueryStringValue($keyValue);
                $this->RecKey["id_pasien"] = $this->id_pasien->QueryStringValue;
            } elseif (Post("id_pasien") !== null) {
                $this->id_pasien->setFormValue(Post("id_pasien"));
                $this->RecKey["id_pasien"] = $this->id_pasien->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->id_pasien->setQueryStringValue($keyValue);
                $this->RecKey["id_pasien"] = $this->id_pasien->QueryStringValue;
            } else {
                $returnUrl = "MPasienList"; // Return to list
            }

            // Get action
            $this->CurrentAction = "show"; // Display
            switch ($this->CurrentAction) {
                case "show": // Get a record to display

                    // Load record based on key
                    if (IsApi()) {
                        $filter = $this->getRecordFilter();
                        $this->CurrentFilter = $filter;
                        $sql = $this->getCurrentSql();
                        $conn = $this->getConnection();
                        $this->Recordset = LoadRecordset($sql, $conn);
                        $res = $this->Recordset && !$this->Recordset->EOF;
                    } else {
                        $res = $this->loadRow();
                    }
                    if (!$res) { // Load record based on key
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $returnUrl = "MPasienList"; // No matching record, return to list
                    }
                    break;
            }
        } else {
            $returnUrl = "MPasienList"; // Not page request, return to list
        }
        if ($returnUrl != "") {
            $this->terminate($returnUrl);
            return;
        }

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Render row
        $this->RowType = ROWTYPE_VIEW;
        $this->resetAttributes();
        $this->renderRow();

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset, true); // Get current record only
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows]);
            $this->terminate(true);
            return;
        }

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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        }
        $item->Visible = ($this->AddUrl != "" && $Security->canAdd());

        // Edit
        $item = &$option->add("edit");
        $editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        }
        $item->Visible = ($this->EditUrl != "" && $Security->canEdit());

        // Delete
        $item = &$option->add("delete");
        if ($this->IsModal) { // Handle as inline delete
            $item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery(GetUrl($this->DeleteUrl), "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        }
        $item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());

        // Set up action default
        $option = $options["action"];
        $option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
        $option->UseDropDownButton = false;
        $option->UseButtonGroup = true;
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
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

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->AddUrl = $this->getAddUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();
        $this->ListUrl = $this->getListUrl();
        $this->setupOtherOptions();

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
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MPasienList"), "", $this->TableVar, true);
        $pageId = "view";
        $Breadcrumb->add("view", $pageId, $url);
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

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }
}
