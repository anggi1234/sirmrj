<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianPsikologiView extends PenilaianPsikologi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_psikologi';

    // Page object name
    public $PageObjName = "PenilaianPsikologiView";

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

        // Table object (penilaian_psikologi)
        if (!isset($GLOBALS["penilaian_psikologi"]) || get_class($GLOBALS["penilaian_psikologi"]) == PROJECT_NAMESPACE . "penilaian_psikologi") {
            $GLOBALS["penilaian_psikologi"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("id_penilaian_psikologi") ?? Route("id_penilaian_psikologi")) !== null) {
            $this->RecKey["id_penilaian_psikologi"] = $keyValue;
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
        $this->id_penilaian_psikologi->setVisibility();
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

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;

        // Set up master/detail parameters
        $this->setupMasterParms();
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("id_penilaian_psikologi") ?? Route("id_penilaian_psikologi")) !== null) {
                $this->id_penilaian_psikologi->setQueryStringValue($keyValue);
                $this->RecKey["id_penilaian_psikologi"] = $this->id_penilaian_psikologi->QueryStringValue;
            } elseif (Post("id_penilaian_psikologi") !== null) {
                $this->id_penilaian_psikologi->setFormValue(Post("id_penilaian_psikologi"));
                $this->RecKey["id_penilaian_psikologi"] = $this->id_penilaian_psikologi->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->id_penilaian_psikologi->setQueryStringValue($keyValue);
                $this->RecKey["id_penilaian_psikologi"] = $this->id_penilaian_psikologi->QueryStringValue;
            } else {
                $returnUrl = "PenilaianPsikologiList"; // Return to list
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
                        $returnUrl = "PenilaianPsikologiList"; // No matching record, return to list
                    }
                    break;
            }
        } else {
            $returnUrl = "PenilaianPsikologiList"; // Not page request, return to list
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
        $row = [];
        $row['id_penilaian_psikologi'] = null;
        $row['no_rawat'] = null;
        $row['tanggal'] = null;
        $row['nip'] = null;
        $row['anamnesis'] = null;
        $row['dikirim_dari'] = null;
        $row['tujuan_pemeriksaan'] = null;
        $row['ket_anamnesis'] = null;
        $row['rupa'] = null;
        $row['bentuk_tubuh'] = null;
        $row['tindakan'] = null;
        $row['pakaian'] = null;
        $row['ekspresi'] = null;
        $row['berbicara'] = null;
        $row['penggunaan_kata'] = null;
        $row['ciri_menyolok'] = null;
        $row['hasil_psikotes'] = null;
        $row['kepribadian'] = null;
        $row['psikodinamika'] = null;
        $row['kesimpulan_psikolog'] = null;
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
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
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
            $this->setSessionWhere($this->getDetailFilter());

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
