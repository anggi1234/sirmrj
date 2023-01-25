<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianMedisIgdView extends PenilaianMedisIgd
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_medis_igd';

    // Page object name
    public $PageObjName = "PenilaianMedisIgdView";

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

        // Table object (penilaian_medis_igd)
        if (!isset($GLOBALS["penilaian_medis_igd"]) || get_class($GLOBALS["penilaian_medis_igd"]) == PROJECT_NAMESPACE . "penilaian_medis_igd") {
            $GLOBALS["penilaian_medis_igd"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("id_penilaian_medis_igd") ?? Route("id_penilaian_medis_igd")) !== null) {
            $this->RecKey["id_penilaian_medis_igd"] = $keyValue;
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
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penilaian_medis_igd');
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
                $doc = new $class(Container("penilaian_medis_igd"));
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
                    if ($pageName == "PenilaianMedisIgdView") {
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
            $key .= @$ar['id_penilaian_medis_igd'];
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
            $this->id_penilaian_medis_igd->Visible = false;
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
        $this->id_penilaian_medis_igd->setVisibility();
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
        $this->leher->setVisibility();
        $this->thoraks->setVisibility();
        $this->abdomen->setVisibility();
        $this->genital->setVisibility();
        $this->ekstremitas->setVisibility();
        $this->ket_fisik->setVisibility();
        $this->ket_lokalis->setVisibility();
        $this->ekg->setVisibility();
        $this->rad->setVisibility();
        $this->lab->setVisibility();
        $this->diagnosis->setVisibility();
        $this->tata->setVisibility();
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
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("id_penilaian_medis_igd") ?? Route("id_penilaian_medis_igd")) !== null) {
                $this->id_penilaian_medis_igd->setQueryStringValue($keyValue);
                $this->RecKey["id_penilaian_medis_igd"] = $this->id_penilaian_medis_igd->QueryStringValue;
            } elseif (Post("id_penilaian_medis_igd") !== null) {
                $this->id_penilaian_medis_igd->setFormValue(Post("id_penilaian_medis_igd"));
                $this->RecKey["id_penilaian_medis_igd"] = $this->id_penilaian_medis_igd->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->id_penilaian_medis_igd->setQueryStringValue($keyValue);
                $this->RecKey["id_penilaian_medis_igd"] = $this->id_penilaian_medis_igd->QueryStringValue;
            } else {
                $returnUrl = "PenilaianMedisIgdList"; // Return to list
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
                        $returnUrl = "PenilaianMedisIgdList"; // No matching record, return to list
                    }
                    break;
            }
        } else {
            $returnUrl = "PenilaianMedisIgdList"; // Not page request, return to list
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
        $this->id_penilaian_medis_igd->setDbValue($row['id_penilaian_medis_igd']);
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
        $this->leher->setDbValue($row['leher']);
        $this->thoraks->setDbValue($row['thoraks']);
        $this->abdomen->setDbValue($row['abdomen']);
        $this->genital->setDbValue($row['genital']);
        $this->ekstremitas->setDbValue($row['ekstremitas']);
        $this->ket_fisik->setDbValue($row['ket_fisik']);
        $this->ket_lokalis->setDbValue($row['ket_lokalis']);
        $this->ekg->setDbValue($row['ekg']);
        $this->rad->setDbValue($row['rad']);
        $this->lab->setDbValue($row['lab']);
        $this->diagnosis->setDbValue($row['diagnosis']);
        $this->tata->setDbValue($row['tata']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_penilaian_medis_igd'] = null;
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
        $row['leher'] = null;
        $row['thoraks'] = null;
        $row['abdomen'] = null;
        $row['genital'] = null;
        $row['ekstremitas'] = null;
        $row['ket_fisik'] = null;
        $row['ket_lokalis'] = null;
        $row['ekg'] = null;
        $row['rad'] = null;
        $row['lab'] = null;
        $row['diagnosis'] = null;
        $row['tata'] = null;
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

        // id_penilaian_medis_igd

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

        // leher

        // thoraks

        // abdomen

        // genital

        // ekstremitas

        // ket_fisik

        // ket_lokalis

        // ekg

        // rad

        // lab

        // diagnosis

        // tata
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_penilaian_medis_igd
            $this->id_penilaian_medis_igd->ViewValue = $this->id_penilaian_medis_igd->CurrentValue;
            $this->id_penilaian_medis_igd->ViewCustomAttributes = "";

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

            // leher
            if (strval($this->leher->CurrentValue) != "") {
                $this->leher->ViewValue = $this->leher->optionCaption($this->leher->CurrentValue);
            } else {
                $this->leher->ViewValue = null;
            }
            $this->leher->ViewCustomAttributes = "";

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

            // ket_fisik
            $this->ket_fisik->ViewValue = $this->ket_fisik->CurrentValue;
            $this->ket_fisik->ViewCustomAttributes = "";

            // ket_lokalis
            $this->ket_lokalis->ViewValue = $this->ket_lokalis->CurrentValue;
            $this->ket_lokalis->ViewCustomAttributes = "";

            // ekg
            $this->ekg->ViewValue = $this->ekg->CurrentValue;
            $this->ekg->ViewCustomAttributes = "";

            // rad
            $this->rad->ViewValue = $this->rad->CurrentValue;
            $this->rad->ViewCustomAttributes = "";

            // lab
            $this->lab->ViewValue = $this->lab->CurrentValue;
            $this->lab->ViewCustomAttributes = "";

            // diagnosis
            $this->diagnosis->ViewValue = $this->diagnosis->CurrentValue;
            $this->diagnosis->ViewCustomAttributes = "";

            // tata
            $this->tata->ViewValue = $this->tata->CurrentValue;
            $this->tata->ViewCustomAttributes = "";

            // id_penilaian_medis_igd
            $this->id_penilaian_medis_igd->LinkCustomAttributes = "";
            $this->id_penilaian_medis_igd->HrefValue = "";
            $this->id_penilaian_medis_igd->TooltipValue = "";

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

            // leher
            $this->leher->LinkCustomAttributes = "";
            $this->leher->HrefValue = "";
            $this->leher->TooltipValue = "";

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

            // ket_fisik
            $this->ket_fisik->LinkCustomAttributes = "";
            $this->ket_fisik->HrefValue = "";
            $this->ket_fisik->TooltipValue = "";

            // ket_lokalis
            $this->ket_lokalis->LinkCustomAttributes = "";
            $this->ket_lokalis->HrefValue = "";
            $this->ket_lokalis->TooltipValue = "";

            // ekg
            $this->ekg->LinkCustomAttributes = "";
            $this->ekg->HrefValue = "";
            $this->ekg->TooltipValue = "";

            // rad
            $this->rad->LinkCustomAttributes = "";
            $this->rad->HrefValue = "";
            $this->rad->TooltipValue = "";

            // lab
            $this->lab->LinkCustomAttributes = "";
            $this->lab->HrefValue = "";
            $this->lab->TooltipValue = "";

            // diagnosis
            $this->diagnosis->LinkCustomAttributes = "";
            $this->diagnosis->HrefValue = "";
            $this->diagnosis->TooltipValue = "";

            // tata
            $this->tata->LinkCustomAttributes = "";
            $this->tata->HrefValue = "";
            $this->tata->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PenilaianMedisIgdList"), "", $this->TableVar, true);
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
                case "x_leher":
                    break;
                case "x_thoraks":
                    break;
                case "x_abdomen":
                    break;
                case "x_genital":
                    break;
                case "x_ekstremitas":
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
