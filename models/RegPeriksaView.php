<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RegPeriksaView extends RegPeriksa
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'reg_periksa';

    // Page object name
    public $PageObjName = "RegPeriksaView";

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

        // Table object (reg_periksa)
        if (!isset($GLOBALS["reg_periksa"]) || get_class($GLOBALS["reg_periksa"]) == PROJECT_NAMESPACE . "reg_periksa") {
            $GLOBALS["reg_periksa"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("no_rawat") ?? Route("no_rawat")) !== null) {
            $this->RecKey["no_rawat"] = $keyValue;
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
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'reg_periksa');
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
                $doc = new $class(Container("reg_periksa"));
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
                    if ($pageName == "RegPeriksaView") {
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
            $key .= @$ar['no_rawat'];
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
        $this->no_reg->setVisibility();
        $this->no_rawat->setVisibility();
        $this->tgl_registrasi->setVisibility();
        $this->jam_reg->setVisibility();
        $this->kd_dokter->setVisibility();
        $this->no_rkm_medis->setVisibility();
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
        $this->id_reg->setVisibility();
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

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("no_rawat") ?? Route("no_rawat")) !== null) {
                $this->no_rawat->setQueryStringValue($keyValue);
                $this->RecKey["no_rawat"] = $this->no_rawat->QueryStringValue;
            } elseif (Post("no_rawat") !== null) {
                $this->no_rawat->setFormValue(Post("no_rawat"));
                $this->RecKey["no_rawat"] = $this->no_rawat->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->no_rawat->setQueryStringValue($keyValue);
                $this->RecKey["no_rawat"] = $this->no_rawat->QueryStringValue;
            } else {
                $returnUrl = "RegPeriksaList"; // Return to list
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
                        $returnUrl = "RegPeriksaList"; // No matching record, return to list
                    }
                    break;
            }
        } else {
            $returnUrl = "RegPeriksaList"; // Not page request, return to list
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

        // Copy
        $item = &$option->add("copy");
        $copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode(GetUrl($this->CopyUrl)) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        }
        $item->Visible = ($this->CopyUrl != "" && $Security->canAdd());

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
        $this->no_reg->setDbValue($row['no_reg']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tgl_registrasi->setDbValue($row['tgl_registrasi']);
        $this->jam_reg->setDbValue($row['jam_reg']);
        $this->kd_dokter->setDbValue($row['kd_dokter']);
        $this->no_rkm_medis->setDbValue($row['no_rkm_medis']);
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
        $this->id_reg->setDbValue($row['id_reg']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['no_reg'] = null;
        $row['no_rawat'] = null;
        $row['tgl_registrasi'] = null;
        $row['jam_reg'] = null;
        $row['kd_dokter'] = null;
        $row['no_rkm_medis'] = null;
        $row['kd_poli'] = null;
        $row['p_jawab'] = null;
        $row['almt_pj'] = null;
        $row['hubunganpj'] = null;
        $row['biaya_reg'] = null;
        $row['stts'] = null;
        $row['stts_daftar'] = null;
        $row['status_lanjut'] = null;
        $row['kd_pj'] = null;
        $row['umurdaftar'] = null;
        $row['sttsumur'] = null;
        $row['status_bayar'] = null;
        $row['status_poli'] = null;
        $row['id_reg'] = null;
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

        // Convert decimal values if posted back
        if ($this->biaya_reg->FormValue == $this->biaya_reg->CurrentValue && is_numeric(ConvertToFloatString($this->biaya_reg->CurrentValue))) {
            $this->biaya_reg->CurrentValue = ConvertToFloatString($this->biaya_reg->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // no_reg

        // no_rawat

        // tgl_registrasi

        // jam_reg

        // kd_dokter

        // no_rkm_medis

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

        // id_reg
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_reg
            $this->no_reg->ViewValue = $this->no_reg->CurrentValue;
            $this->no_reg->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";

            // tgl_registrasi
            $this->tgl_registrasi->ViewValue = $this->tgl_registrasi->CurrentValue;
            $this->tgl_registrasi->ViewValue = FormatDateTime($this->tgl_registrasi->ViewValue, 0);
            $this->tgl_registrasi->ViewCustomAttributes = "";

            // jam_reg
            $this->jam_reg->ViewValue = $this->jam_reg->CurrentValue;
            $this->jam_reg->ViewValue = FormatDateTime($this->jam_reg->ViewValue, 4);
            $this->jam_reg->ViewCustomAttributes = "";

            // kd_dokter
            $this->kd_dokter->ViewValue = $this->kd_dokter->CurrentValue;
            $this->kd_dokter->ViewCustomAttributes = "";

            // no_rkm_medis
            $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->CurrentValue;
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

            // id_reg
            $this->id_reg->ViewValue = $this->id_reg->CurrentValue;
            $this->id_reg->ViewValue = FormatNumber($this->id_reg->ViewValue, 0, -2, -2, -2);
            $this->id_reg->ViewCustomAttributes = "";

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

            // no_rkm_medis
            $this->no_rkm_medis->LinkCustomAttributes = "";
            $this->no_rkm_medis->HrefValue = "";
            $this->no_rkm_medis->TooltipValue = "";

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

            // id_reg
            $this->id_reg->LinkCustomAttributes = "";
            $this->id_reg->HrefValue = "";
            $this->id_reg->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("RegPeriksaList"), "", $this->TableVar, true);
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
