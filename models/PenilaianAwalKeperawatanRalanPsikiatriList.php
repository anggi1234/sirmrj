<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianAwalKeperawatanRalanPsikiatriList extends PenilaianAwalKeperawatanRalanPsikiatri
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_awal_keperawatan_ralan_psikiatri';

    // Page object name
    public $PageObjName = "PenilaianAwalKeperawatanRalanPsikiatriList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpenilaian_awal_keperawatan_ralan_psikiatrilist";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

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

        // Table object (penilaian_awal_keperawatan_ralan_psikiatri)
        if (!isset($GLOBALS["penilaian_awal_keperawatan_ralan_psikiatri"]) || get_class($GLOBALS["penilaian_awal_keperawatan_ralan_psikiatri"]) == PROJECT_NAMESPACE . "penilaian_awal_keperawatan_ralan_psikiatri") {
            $GLOBALS["penilaian_awal_keperawatan_ralan_psikiatri"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Initialize URLs
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->AddUrl = "PenilaianAwalKeperawatanRalanPsikiatriAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "PenilaianAwalKeperawatanRalanPsikiatriDelete";
        $this->MultiUpdateUrl = "PenilaianAwalKeperawatanRalanPsikiatriUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penilaian_awal_keperawatan_ralan_psikiatri');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // List options
        $this->ListOptions = new ListOptions();
        $this->ListOptions->TableVar = $this->TableVar;

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Import options
        $this->ImportOptions = new ListOptions("div");
        $this->ImportOptions->TagClassName = "ew-import-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";

        // Filter options
        $this->FilterOptions = new ListOptions("div");
        $this->FilterOptions->TagClassName = "ew-filter-option fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch";

        // List actions
        $this->ListActions = new ListActions();
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
                $doc = new $class(Container("penilaian_awal_keperawatan_ralan_psikiatri"));
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
            SaveDebugMessage();
            Redirect(GetUrl($url));
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
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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
            $key .= @$ar['id_penilaian_awal_keperawatan_ralan_psikiatri'];
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
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->Visible = false;
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

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "5,10,20,50"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchRowCount = 0; // For extended search
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $RowAction = ""; // Row action
    public $MultiColumnClass = "col-sm";
    public $MultiColumnEditClass = "w-100";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header

        // Update Export URLs
        if (Config("USE_PHPEXCEL")) {
            $this->ExportExcelCustom = false;
        }
        if (Config("USE_PHPWORD")) {
            $this->ExportWordCustom = false;
        }
        if ($this->ExportExcelCustom) {
            $this->ExportExcelUrl .= "&amp;custom=1";
        }
        if ($this->ExportWordCustom) {
            $this->ExportWordUrl .= "&amp;custom=1";
        }
        if ($this->ExportPdfCustom) {
            $this->ExportPdfUrl .= "&amp;custom=1";
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->Visible = false;
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->informasi->setVisibility();
        $this->keluhan_utama->Visible = false;
        $this->rkd_sakit_sejak->setVisibility();
        $this->rkd_keluhan->Visible = false;
        $this->rkd_berobat->setVisibility();
        $this->rkd_hasil_pengobatan->setVisibility();
        $this->fp_putus_obat->setVisibility();
        $this->ket_putus_obat->setVisibility();
        $this->fp_ekonomi->setVisibility();
        $this->ket_masalah_ekonomi->setVisibility();
        $this->fp_masalah_fisik->setVisibility();
        $this->ket_masalah_fisik->setVisibility();
        $this->fp_masalah_psikososial->setVisibility();
        $this->ket_masalah_psikososial->setVisibility();
        $this->rh_keluarga->setVisibility();
        $this->ket_rh_keluarga->setVisibility();
        $this->resiko_bunuh_diri->setVisibility();
        $this->rbd_ide->setVisibility();
        $this->ket_rbd_ide->setVisibility();
        $this->rbd_rencana->setVisibility();
        $this->ket_rbd_rencana->setVisibility();
        $this->rbd_alat->setVisibility();
        $this->ket_rbd_alat->setVisibility();
        $this->rbd_percobaan->setVisibility();
        $this->ket_rbd_percobaan->setVisibility();
        $this->rbd_keinginan->setVisibility();
        $this->ket_rbd_keinginan->setVisibility();
        $this->rpo_penggunaan->setVisibility();
        $this->ket_rpo_penggunaan->setVisibility();
        $this->rpo_efek_samping->setVisibility();
        $this->ket_rpo_efek_samping->setVisibility();
        $this->rpo_napza->setVisibility();
        $this->ket_rpo_napza->setVisibility();
        $this->ket_lama_pemakaian->setVisibility();
        $this->ket_cara_pemakaian->setVisibility();
        $this->ket_latar_belakang_pemakaian->setVisibility();
        $this->rpo_penggunaan_obat_lainnya->setVisibility();
        $this->ket_penggunaan_obat_lainnya->setVisibility();
        $this->ket_alasan_penggunaan->setVisibility();
        $this->rpo_alergi_obat->setVisibility();
        $this->ket_alergi_obat->setVisibility();
        $this->rpo_merokok->setVisibility();
        $this->ket_merokok->setVisibility();
        $this->rpo_minum_kopi->setVisibility();
        $this->ket_minum_kopi->setVisibility();
        $this->td->setVisibility();
        $this->nadi->setVisibility();
        $this->gcs->setVisibility();
        $this->rr->setVisibility();
        $this->suhu->setVisibility();
        $this->pf_keluhan_fisik->setVisibility();
        $this->ket_keluhan_fisik->setVisibility();
        $this->skala_nyeri->setVisibility();
        $this->durasi->setVisibility();
        $this->nyeri->setVisibility();
        $this->provokes->setVisibility();
        $this->ket_provokes->setVisibility();
        $this->quality->setVisibility();
        $this->ket_quality->setVisibility();
        $this->lokasi->setVisibility();
        $this->menyebar->setVisibility();
        $this->pada_dokter->setVisibility();
        $this->ket_dokter->setVisibility();
        $this->nyeri_hilang->setVisibility();
        $this->ket_nyeri->setVisibility();
        $this->bb->setVisibility();
        $this->tb->setVisibility();
        $this->bmi->setVisibility();
        $this->lapor_status_nutrisi->setVisibility();
        $this->ket_lapor_status_nutrisi->setVisibility();
        $this->sg1->setVisibility();
        $this->nilai1->setVisibility();
        $this->sg2->setVisibility();
        $this->nilai2->setVisibility();
        $this->total_hasil->setVisibility();
        $this->resikojatuh->setVisibility();
        $this->bjm->setVisibility();
        $this->msa->setVisibility();
        $this->hasil->setVisibility();
        $this->lapor->setVisibility();
        $this->ket_lapor->setVisibility();
        $this->adl_mandi->setVisibility();
        $this->adl_berpakaian->setVisibility();
        $this->adl_makan->setVisibility();
        $this->adl_bak->setVisibility();
        $this->adl_bab->setVisibility();
        $this->adl_hobi->setVisibility();
        $this->ket_adl_hobi->setVisibility();
        $this->adl_sosialisasi->setVisibility();
        $this->ket_adl_sosialisasi->setVisibility();
        $this->adl_kegiatan->setVisibility();
        $this->ket_adl_kegiatan->setVisibility();
        $this->sk_penampilan->setVisibility();
        $this->sk_alam_perasaan->setVisibility();
        $this->sk_pembicaraan->setVisibility();
        $this->sk_afek->setVisibility();
        $this->sk_aktifitas_motorik->setVisibility();
        $this->sk_gangguan_ringan->setVisibility();
        $this->sk_proses_pikir->setVisibility();
        $this->sk_orientasi->setVisibility();
        $this->sk_tingkat_kesadaran_orientasi->setVisibility();
        $this->sk_memori->setVisibility();
        $this->sk_interaksi->setVisibility();
        $this->sk_konsentrasi->setVisibility();
        $this->sk_persepsi->setVisibility();
        $this->ket_sk_persepsi->setVisibility();
        $this->sk_isi_pikir->setVisibility();
        $this->sk_waham->setVisibility();
        $this->ket_sk_waham->setVisibility();
        $this->sk_daya_tilik_diri->setVisibility();
        $this->ket_sk_daya_tilik_diri->setVisibility();
        $this->kk_pembelajaran->setVisibility();
        $this->ket_kk_pembelajaran->setVisibility();
        $this->ket_kk_pembelajaran_lainnya->setVisibility();
        $this->kk_Penerjamah->setVisibility();
        $this->ket_kk_penerjamah_Lainnya->setVisibility();
        $this->kk_bahasa_isyarat->setVisibility();
        $this->kk_kebutuhan_edukasi->setVisibility();
        $this->ket_kk_kebutuhan_edukasi->setVisibility();
        $this->rencana->setVisibility();
        $this->nip->setVisibility();
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up master detail parameters
        $this->setupMasterParms();

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Show checkbox column if multiple action
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
                $this->ListOptions["checkbox"]->Visible = true;
                break;
            }
        }

        // Set up lookup cache

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }

        // Restore master/detail filter
        $this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Load master record
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "vigd") {
            $masterTbl = Container("vigd");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("VigdList"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Load master record
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "vrajal") {
            $masterTbl = Container("vrajal");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("VrajalList"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->id_penilaian_awal_keperawatan_ralan_psikiatri->AdvancedSearch->toJson(), ","); // Field id_penilaian_awal_keperawatan_ralan_psikiatri
        $filterList = Concat($filterList, $this->no_rawat->AdvancedSearch->toJson(), ","); // Field no_rawat
        $filterList = Concat($filterList, $this->tanggal->AdvancedSearch->toJson(), ","); // Field tanggal
        $filterList = Concat($filterList, $this->informasi->AdvancedSearch->toJson(), ","); // Field informasi
        $filterList = Concat($filterList, $this->keluhan_utama->AdvancedSearch->toJson(), ","); // Field keluhan_utama
        $filterList = Concat($filterList, $this->rkd_sakit_sejak->AdvancedSearch->toJson(), ","); // Field rkd_sakit_sejak
        $filterList = Concat($filterList, $this->rkd_keluhan->AdvancedSearch->toJson(), ","); // Field rkd_keluhan
        $filterList = Concat($filterList, $this->rkd_berobat->AdvancedSearch->toJson(), ","); // Field rkd_berobat
        $filterList = Concat($filterList, $this->rkd_hasil_pengobatan->AdvancedSearch->toJson(), ","); // Field rkd_hasil_pengobatan
        $filterList = Concat($filterList, $this->fp_putus_obat->AdvancedSearch->toJson(), ","); // Field fp_putus_obat
        $filterList = Concat($filterList, $this->ket_putus_obat->AdvancedSearch->toJson(), ","); // Field ket_putus_obat
        $filterList = Concat($filterList, $this->fp_ekonomi->AdvancedSearch->toJson(), ","); // Field fp_ekonomi
        $filterList = Concat($filterList, $this->ket_masalah_ekonomi->AdvancedSearch->toJson(), ","); // Field ket_masalah_ekonomi
        $filterList = Concat($filterList, $this->fp_masalah_fisik->AdvancedSearch->toJson(), ","); // Field fp_masalah_fisik
        $filterList = Concat($filterList, $this->ket_masalah_fisik->AdvancedSearch->toJson(), ","); // Field ket_masalah_fisik
        $filterList = Concat($filterList, $this->fp_masalah_psikososial->AdvancedSearch->toJson(), ","); // Field fp_masalah_psikososial
        $filterList = Concat($filterList, $this->ket_masalah_psikososial->AdvancedSearch->toJson(), ","); // Field ket_masalah_psikososial
        $filterList = Concat($filterList, $this->rh_keluarga->AdvancedSearch->toJson(), ","); // Field rh_keluarga
        $filterList = Concat($filterList, $this->ket_rh_keluarga->AdvancedSearch->toJson(), ","); // Field ket_rh_keluarga
        $filterList = Concat($filterList, $this->resiko_bunuh_diri->AdvancedSearch->toJson(), ","); // Field resiko_bunuh_diri
        $filterList = Concat($filterList, $this->rbd_ide->AdvancedSearch->toJson(), ","); // Field rbd_ide
        $filterList = Concat($filterList, $this->ket_rbd_ide->AdvancedSearch->toJson(), ","); // Field ket_rbd_ide
        $filterList = Concat($filterList, $this->rbd_rencana->AdvancedSearch->toJson(), ","); // Field rbd_rencana
        $filterList = Concat($filterList, $this->ket_rbd_rencana->AdvancedSearch->toJson(), ","); // Field ket_rbd_rencana
        $filterList = Concat($filterList, $this->rbd_alat->AdvancedSearch->toJson(), ","); // Field rbd_alat
        $filterList = Concat($filterList, $this->ket_rbd_alat->AdvancedSearch->toJson(), ","); // Field ket_rbd_alat
        $filterList = Concat($filterList, $this->rbd_percobaan->AdvancedSearch->toJson(), ","); // Field rbd_percobaan
        $filterList = Concat($filterList, $this->ket_rbd_percobaan->AdvancedSearch->toJson(), ","); // Field ket_rbd_percobaan
        $filterList = Concat($filterList, $this->rbd_keinginan->AdvancedSearch->toJson(), ","); // Field rbd_keinginan
        $filterList = Concat($filterList, $this->ket_rbd_keinginan->AdvancedSearch->toJson(), ","); // Field ket_rbd_keinginan
        $filterList = Concat($filterList, $this->rpo_penggunaan->AdvancedSearch->toJson(), ","); // Field rpo_penggunaan
        $filterList = Concat($filterList, $this->ket_rpo_penggunaan->AdvancedSearch->toJson(), ","); // Field ket_rpo_penggunaan
        $filterList = Concat($filterList, $this->rpo_efek_samping->AdvancedSearch->toJson(), ","); // Field rpo_efek_samping
        $filterList = Concat($filterList, $this->ket_rpo_efek_samping->AdvancedSearch->toJson(), ","); // Field ket_rpo_efek_samping
        $filterList = Concat($filterList, $this->rpo_napza->AdvancedSearch->toJson(), ","); // Field rpo_napza
        $filterList = Concat($filterList, $this->ket_rpo_napza->AdvancedSearch->toJson(), ","); // Field ket_rpo_napza
        $filterList = Concat($filterList, $this->ket_lama_pemakaian->AdvancedSearch->toJson(), ","); // Field ket_lama_pemakaian
        $filterList = Concat($filterList, $this->ket_cara_pemakaian->AdvancedSearch->toJson(), ","); // Field ket_cara_pemakaian
        $filterList = Concat($filterList, $this->ket_latar_belakang_pemakaian->AdvancedSearch->toJson(), ","); // Field ket_latar_belakang_pemakaian
        $filterList = Concat($filterList, $this->rpo_penggunaan_obat_lainnya->AdvancedSearch->toJson(), ","); // Field rpo_penggunaan_obat_lainnya
        $filterList = Concat($filterList, $this->ket_penggunaan_obat_lainnya->AdvancedSearch->toJson(), ","); // Field ket_penggunaan_obat_lainnya
        $filterList = Concat($filterList, $this->ket_alasan_penggunaan->AdvancedSearch->toJson(), ","); // Field ket_alasan_penggunaan
        $filterList = Concat($filterList, $this->rpo_alergi_obat->AdvancedSearch->toJson(), ","); // Field rpo_alergi_obat
        $filterList = Concat($filterList, $this->ket_alergi_obat->AdvancedSearch->toJson(), ","); // Field ket_alergi_obat
        $filterList = Concat($filterList, $this->rpo_merokok->AdvancedSearch->toJson(), ","); // Field rpo_merokok
        $filterList = Concat($filterList, $this->ket_merokok->AdvancedSearch->toJson(), ","); // Field ket_merokok
        $filterList = Concat($filterList, $this->rpo_minum_kopi->AdvancedSearch->toJson(), ","); // Field rpo_minum_kopi
        $filterList = Concat($filterList, $this->ket_minum_kopi->AdvancedSearch->toJson(), ","); // Field ket_minum_kopi
        $filterList = Concat($filterList, $this->td->AdvancedSearch->toJson(), ","); // Field td
        $filterList = Concat($filterList, $this->nadi->AdvancedSearch->toJson(), ","); // Field nadi
        $filterList = Concat($filterList, $this->gcs->AdvancedSearch->toJson(), ","); // Field gcs
        $filterList = Concat($filterList, $this->rr->AdvancedSearch->toJson(), ","); // Field rr
        $filterList = Concat($filterList, $this->suhu->AdvancedSearch->toJson(), ","); // Field suhu
        $filterList = Concat($filterList, $this->pf_keluhan_fisik->AdvancedSearch->toJson(), ","); // Field pf_keluhan_fisik
        $filterList = Concat($filterList, $this->ket_keluhan_fisik->AdvancedSearch->toJson(), ","); // Field ket_keluhan_fisik
        $filterList = Concat($filterList, $this->skala_nyeri->AdvancedSearch->toJson(), ","); // Field skala_nyeri
        $filterList = Concat($filterList, $this->durasi->AdvancedSearch->toJson(), ","); // Field durasi
        $filterList = Concat($filterList, $this->nyeri->AdvancedSearch->toJson(), ","); // Field nyeri
        $filterList = Concat($filterList, $this->provokes->AdvancedSearch->toJson(), ","); // Field provokes
        $filterList = Concat($filterList, $this->ket_provokes->AdvancedSearch->toJson(), ","); // Field ket_provokes
        $filterList = Concat($filterList, $this->quality->AdvancedSearch->toJson(), ","); // Field quality
        $filterList = Concat($filterList, $this->ket_quality->AdvancedSearch->toJson(), ","); // Field ket_quality
        $filterList = Concat($filterList, $this->lokasi->AdvancedSearch->toJson(), ","); // Field lokasi
        $filterList = Concat($filterList, $this->menyebar->AdvancedSearch->toJson(), ","); // Field menyebar
        $filterList = Concat($filterList, $this->pada_dokter->AdvancedSearch->toJson(), ","); // Field pada_dokter
        $filterList = Concat($filterList, $this->ket_dokter->AdvancedSearch->toJson(), ","); // Field ket_dokter
        $filterList = Concat($filterList, $this->nyeri_hilang->AdvancedSearch->toJson(), ","); // Field nyeri_hilang
        $filterList = Concat($filterList, $this->ket_nyeri->AdvancedSearch->toJson(), ","); // Field ket_nyeri
        $filterList = Concat($filterList, $this->bb->AdvancedSearch->toJson(), ","); // Field bb
        $filterList = Concat($filterList, $this->tb->AdvancedSearch->toJson(), ","); // Field tb
        $filterList = Concat($filterList, $this->bmi->AdvancedSearch->toJson(), ","); // Field bmi
        $filterList = Concat($filterList, $this->lapor_status_nutrisi->AdvancedSearch->toJson(), ","); // Field lapor_status_nutrisi
        $filterList = Concat($filterList, $this->ket_lapor_status_nutrisi->AdvancedSearch->toJson(), ","); // Field ket_lapor_status_nutrisi
        $filterList = Concat($filterList, $this->sg1->AdvancedSearch->toJson(), ","); // Field sg1
        $filterList = Concat($filterList, $this->nilai1->AdvancedSearch->toJson(), ","); // Field nilai1
        $filterList = Concat($filterList, $this->sg2->AdvancedSearch->toJson(), ","); // Field sg2
        $filterList = Concat($filterList, $this->nilai2->AdvancedSearch->toJson(), ","); // Field nilai2
        $filterList = Concat($filterList, $this->total_hasil->AdvancedSearch->toJson(), ","); // Field total_hasil
        $filterList = Concat($filterList, $this->resikojatuh->AdvancedSearch->toJson(), ","); // Field resikojatuh
        $filterList = Concat($filterList, $this->bjm->AdvancedSearch->toJson(), ","); // Field bjm
        $filterList = Concat($filterList, $this->msa->AdvancedSearch->toJson(), ","); // Field msa
        $filterList = Concat($filterList, $this->hasil->AdvancedSearch->toJson(), ","); // Field hasil
        $filterList = Concat($filterList, $this->lapor->AdvancedSearch->toJson(), ","); // Field lapor
        $filterList = Concat($filterList, $this->ket_lapor->AdvancedSearch->toJson(), ","); // Field ket_lapor
        $filterList = Concat($filterList, $this->adl_mandi->AdvancedSearch->toJson(), ","); // Field adl_mandi
        $filterList = Concat($filterList, $this->adl_berpakaian->AdvancedSearch->toJson(), ","); // Field adl_berpakaian
        $filterList = Concat($filterList, $this->adl_makan->AdvancedSearch->toJson(), ","); // Field adl_makan
        $filterList = Concat($filterList, $this->adl_bak->AdvancedSearch->toJson(), ","); // Field adl_bak
        $filterList = Concat($filterList, $this->adl_bab->AdvancedSearch->toJson(), ","); // Field adl_bab
        $filterList = Concat($filterList, $this->adl_hobi->AdvancedSearch->toJson(), ","); // Field adl_hobi
        $filterList = Concat($filterList, $this->ket_adl_hobi->AdvancedSearch->toJson(), ","); // Field ket_adl_hobi
        $filterList = Concat($filterList, $this->adl_sosialisasi->AdvancedSearch->toJson(), ","); // Field adl_sosialisasi
        $filterList = Concat($filterList, $this->ket_adl_sosialisasi->AdvancedSearch->toJson(), ","); // Field ket_adl_sosialisasi
        $filterList = Concat($filterList, $this->adl_kegiatan->AdvancedSearch->toJson(), ","); // Field adl_kegiatan
        $filterList = Concat($filterList, $this->ket_adl_kegiatan->AdvancedSearch->toJson(), ","); // Field ket_adl_kegiatan
        $filterList = Concat($filterList, $this->sk_penampilan->AdvancedSearch->toJson(), ","); // Field sk_penampilan
        $filterList = Concat($filterList, $this->sk_alam_perasaan->AdvancedSearch->toJson(), ","); // Field sk_alam_perasaan
        $filterList = Concat($filterList, $this->sk_pembicaraan->AdvancedSearch->toJson(), ","); // Field sk_pembicaraan
        $filterList = Concat($filterList, $this->sk_afek->AdvancedSearch->toJson(), ","); // Field sk_afek
        $filterList = Concat($filterList, $this->sk_aktifitas_motorik->AdvancedSearch->toJson(), ","); // Field sk_aktifitas_motorik
        $filterList = Concat($filterList, $this->sk_gangguan_ringan->AdvancedSearch->toJson(), ","); // Field sk_gangguan_ringan
        $filterList = Concat($filterList, $this->sk_proses_pikir->AdvancedSearch->toJson(), ","); // Field sk_proses_pikir
        $filterList = Concat($filterList, $this->sk_orientasi->AdvancedSearch->toJson(), ","); // Field sk_orientasi
        $filterList = Concat($filterList, $this->sk_tingkat_kesadaran_orientasi->AdvancedSearch->toJson(), ","); // Field sk_tingkat_kesadaran_orientasi
        $filterList = Concat($filterList, $this->sk_memori->AdvancedSearch->toJson(), ","); // Field sk_memori
        $filterList = Concat($filterList, $this->sk_interaksi->AdvancedSearch->toJson(), ","); // Field sk_interaksi
        $filterList = Concat($filterList, $this->sk_konsentrasi->AdvancedSearch->toJson(), ","); // Field sk_konsentrasi
        $filterList = Concat($filterList, $this->sk_persepsi->AdvancedSearch->toJson(), ","); // Field sk_persepsi
        $filterList = Concat($filterList, $this->ket_sk_persepsi->AdvancedSearch->toJson(), ","); // Field ket_sk_persepsi
        $filterList = Concat($filterList, $this->sk_isi_pikir->AdvancedSearch->toJson(), ","); // Field sk_isi_pikir
        $filterList = Concat($filterList, $this->sk_waham->AdvancedSearch->toJson(), ","); // Field sk_waham
        $filterList = Concat($filterList, $this->ket_sk_waham->AdvancedSearch->toJson(), ","); // Field ket_sk_waham
        $filterList = Concat($filterList, $this->sk_daya_tilik_diri->AdvancedSearch->toJson(), ","); // Field sk_daya_tilik_diri
        $filterList = Concat($filterList, $this->ket_sk_daya_tilik_diri->AdvancedSearch->toJson(), ","); // Field ket_sk_daya_tilik_diri
        $filterList = Concat($filterList, $this->kk_pembelajaran->AdvancedSearch->toJson(), ","); // Field kk_pembelajaran
        $filterList = Concat($filterList, $this->ket_kk_pembelajaran->AdvancedSearch->toJson(), ","); // Field ket_kk_pembelajaran
        $filterList = Concat($filterList, $this->ket_kk_pembelajaran_lainnya->AdvancedSearch->toJson(), ","); // Field ket_kk_pembelajaran_lainnya
        $filterList = Concat($filterList, $this->kk_Penerjamah->AdvancedSearch->toJson(), ","); // Field kk_Penerjamah
        $filterList = Concat($filterList, $this->ket_kk_penerjamah_Lainnya->AdvancedSearch->toJson(), ","); // Field ket_kk_penerjamah_Lainnya
        $filterList = Concat($filterList, $this->kk_bahasa_isyarat->AdvancedSearch->toJson(), ","); // Field kk_bahasa_isyarat
        $filterList = Concat($filterList, $this->kk_kebutuhan_edukasi->AdvancedSearch->toJson(), ","); // Field kk_kebutuhan_edukasi
        $filterList = Concat($filterList, $this->ket_kk_kebutuhan_edukasi->AdvancedSearch->toJson(), ","); // Field ket_kk_kebutuhan_edukasi
        $filterList = Concat($filterList, $this->rencana->AdvancedSearch->toJson(), ","); // Field rencana
        $filterList = Concat($filterList, $this->nip->AdvancedSearch->toJson(), ","); // Field nip
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field id_penilaian_awal_keperawatan_ralan_psikiatri
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->AdvancedSearch->SearchValue = @$filter["x_id_penilaian_awal_keperawatan_ralan_psikiatri"];
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->AdvancedSearch->SearchOperator = @$filter["z_id_penilaian_awal_keperawatan_ralan_psikiatri"];
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->AdvancedSearch->SearchCondition = @$filter["v_id_penilaian_awal_keperawatan_ralan_psikiatri"];
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->AdvancedSearch->SearchValue2 = @$filter["y_id_penilaian_awal_keperawatan_ralan_psikiatri"];
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->AdvancedSearch->SearchOperator2 = @$filter["w_id_penilaian_awal_keperawatan_ralan_psikiatri"];
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->AdvancedSearch->save();

        // Field no_rawat
        $this->no_rawat->AdvancedSearch->SearchValue = @$filter["x_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchOperator = @$filter["z_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchCondition = @$filter["v_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchValue2 = @$filter["y_no_rawat"];
        $this->no_rawat->AdvancedSearch->SearchOperator2 = @$filter["w_no_rawat"];
        $this->no_rawat->AdvancedSearch->save();

        // Field tanggal
        $this->tanggal->AdvancedSearch->SearchValue = @$filter["x_tanggal"];
        $this->tanggal->AdvancedSearch->SearchOperator = @$filter["z_tanggal"];
        $this->tanggal->AdvancedSearch->SearchCondition = @$filter["v_tanggal"];
        $this->tanggal->AdvancedSearch->SearchValue2 = @$filter["y_tanggal"];
        $this->tanggal->AdvancedSearch->SearchOperator2 = @$filter["w_tanggal"];
        $this->tanggal->AdvancedSearch->save();

        // Field informasi
        $this->informasi->AdvancedSearch->SearchValue = @$filter["x_informasi"];
        $this->informasi->AdvancedSearch->SearchOperator = @$filter["z_informasi"];
        $this->informasi->AdvancedSearch->SearchCondition = @$filter["v_informasi"];
        $this->informasi->AdvancedSearch->SearchValue2 = @$filter["y_informasi"];
        $this->informasi->AdvancedSearch->SearchOperator2 = @$filter["w_informasi"];
        $this->informasi->AdvancedSearch->save();

        // Field keluhan_utama
        $this->keluhan_utama->AdvancedSearch->SearchValue = @$filter["x_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchOperator = @$filter["z_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchCondition = @$filter["v_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchValue2 = @$filter["y_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->SearchOperator2 = @$filter["w_keluhan_utama"];
        $this->keluhan_utama->AdvancedSearch->save();

        // Field rkd_sakit_sejak
        $this->rkd_sakit_sejak->AdvancedSearch->SearchValue = @$filter["x_rkd_sakit_sejak"];
        $this->rkd_sakit_sejak->AdvancedSearch->SearchOperator = @$filter["z_rkd_sakit_sejak"];
        $this->rkd_sakit_sejak->AdvancedSearch->SearchCondition = @$filter["v_rkd_sakit_sejak"];
        $this->rkd_sakit_sejak->AdvancedSearch->SearchValue2 = @$filter["y_rkd_sakit_sejak"];
        $this->rkd_sakit_sejak->AdvancedSearch->SearchOperator2 = @$filter["w_rkd_sakit_sejak"];
        $this->rkd_sakit_sejak->AdvancedSearch->save();

        // Field rkd_keluhan
        $this->rkd_keluhan->AdvancedSearch->SearchValue = @$filter["x_rkd_keluhan"];
        $this->rkd_keluhan->AdvancedSearch->SearchOperator = @$filter["z_rkd_keluhan"];
        $this->rkd_keluhan->AdvancedSearch->SearchCondition = @$filter["v_rkd_keluhan"];
        $this->rkd_keluhan->AdvancedSearch->SearchValue2 = @$filter["y_rkd_keluhan"];
        $this->rkd_keluhan->AdvancedSearch->SearchOperator2 = @$filter["w_rkd_keluhan"];
        $this->rkd_keluhan->AdvancedSearch->save();

        // Field rkd_berobat
        $this->rkd_berobat->AdvancedSearch->SearchValue = @$filter["x_rkd_berobat"];
        $this->rkd_berobat->AdvancedSearch->SearchOperator = @$filter["z_rkd_berobat"];
        $this->rkd_berobat->AdvancedSearch->SearchCondition = @$filter["v_rkd_berobat"];
        $this->rkd_berobat->AdvancedSearch->SearchValue2 = @$filter["y_rkd_berobat"];
        $this->rkd_berobat->AdvancedSearch->SearchOperator2 = @$filter["w_rkd_berobat"];
        $this->rkd_berobat->AdvancedSearch->save();

        // Field rkd_hasil_pengobatan
        $this->rkd_hasil_pengobatan->AdvancedSearch->SearchValue = @$filter["x_rkd_hasil_pengobatan"];
        $this->rkd_hasil_pengobatan->AdvancedSearch->SearchOperator = @$filter["z_rkd_hasil_pengobatan"];
        $this->rkd_hasil_pengobatan->AdvancedSearch->SearchCondition = @$filter["v_rkd_hasil_pengobatan"];
        $this->rkd_hasil_pengobatan->AdvancedSearch->SearchValue2 = @$filter["y_rkd_hasil_pengobatan"];
        $this->rkd_hasil_pengobatan->AdvancedSearch->SearchOperator2 = @$filter["w_rkd_hasil_pengobatan"];
        $this->rkd_hasil_pengobatan->AdvancedSearch->save();

        // Field fp_putus_obat
        $this->fp_putus_obat->AdvancedSearch->SearchValue = @$filter["x_fp_putus_obat"];
        $this->fp_putus_obat->AdvancedSearch->SearchOperator = @$filter["z_fp_putus_obat"];
        $this->fp_putus_obat->AdvancedSearch->SearchCondition = @$filter["v_fp_putus_obat"];
        $this->fp_putus_obat->AdvancedSearch->SearchValue2 = @$filter["y_fp_putus_obat"];
        $this->fp_putus_obat->AdvancedSearch->SearchOperator2 = @$filter["w_fp_putus_obat"];
        $this->fp_putus_obat->AdvancedSearch->save();

        // Field ket_putus_obat
        $this->ket_putus_obat->AdvancedSearch->SearchValue = @$filter["x_ket_putus_obat"];
        $this->ket_putus_obat->AdvancedSearch->SearchOperator = @$filter["z_ket_putus_obat"];
        $this->ket_putus_obat->AdvancedSearch->SearchCondition = @$filter["v_ket_putus_obat"];
        $this->ket_putus_obat->AdvancedSearch->SearchValue2 = @$filter["y_ket_putus_obat"];
        $this->ket_putus_obat->AdvancedSearch->SearchOperator2 = @$filter["w_ket_putus_obat"];
        $this->ket_putus_obat->AdvancedSearch->save();

        // Field fp_ekonomi
        $this->fp_ekonomi->AdvancedSearch->SearchValue = @$filter["x_fp_ekonomi"];
        $this->fp_ekonomi->AdvancedSearch->SearchOperator = @$filter["z_fp_ekonomi"];
        $this->fp_ekonomi->AdvancedSearch->SearchCondition = @$filter["v_fp_ekonomi"];
        $this->fp_ekonomi->AdvancedSearch->SearchValue2 = @$filter["y_fp_ekonomi"];
        $this->fp_ekonomi->AdvancedSearch->SearchOperator2 = @$filter["w_fp_ekonomi"];
        $this->fp_ekonomi->AdvancedSearch->save();

        // Field ket_masalah_ekonomi
        $this->ket_masalah_ekonomi->AdvancedSearch->SearchValue = @$filter["x_ket_masalah_ekonomi"];
        $this->ket_masalah_ekonomi->AdvancedSearch->SearchOperator = @$filter["z_ket_masalah_ekonomi"];
        $this->ket_masalah_ekonomi->AdvancedSearch->SearchCondition = @$filter["v_ket_masalah_ekonomi"];
        $this->ket_masalah_ekonomi->AdvancedSearch->SearchValue2 = @$filter["y_ket_masalah_ekonomi"];
        $this->ket_masalah_ekonomi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_masalah_ekonomi"];
        $this->ket_masalah_ekonomi->AdvancedSearch->save();

        // Field fp_masalah_fisik
        $this->fp_masalah_fisik->AdvancedSearch->SearchValue = @$filter["x_fp_masalah_fisik"];
        $this->fp_masalah_fisik->AdvancedSearch->SearchOperator = @$filter["z_fp_masalah_fisik"];
        $this->fp_masalah_fisik->AdvancedSearch->SearchCondition = @$filter["v_fp_masalah_fisik"];
        $this->fp_masalah_fisik->AdvancedSearch->SearchValue2 = @$filter["y_fp_masalah_fisik"];
        $this->fp_masalah_fisik->AdvancedSearch->SearchOperator2 = @$filter["w_fp_masalah_fisik"];
        $this->fp_masalah_fisik->AdvancedSearch->save();

        // Field ket_masalah_fisik
        $this->ket_masalah_fisik->AdvancedSearch->SearchValue = @$filter["x_ket_masalah_fisik"];
        $this->ket_masalah_fisik->AdvancedSearch->SearchOperator = @$filter["z_ket_masalah_fisik"];
        $this->ket_masalah_fisik->AdvancedSearch->SearchCondition = @$filter["v_ket_masalah_fisik"];
        $this->ket_masalah_fisik->AdvancedSearch->SearchValue2 = @$filter["y_ket_masalah_fisik"];
        $this->ket_masalah_fisik->AdvancedSearch->SearchOperator2 = @$filter["w_ket_masalah_fisik"];
        $this->ket_masalah_fisik->AdvancedSearch->save();

        // Field fp_masalah_psikososial
        $this->fp_masalah_psikososial->AdvancedSearch->SearchValue = @$filter["x_fp_masalah_psikososial"];
        $this->fp_masalah_psikososial->AdvancedSearch->SearchOperator = @$filter["z_fp_masalah_psikososial"];
        $this->fp_masalah_psikososial->AdvancedSearch->SearchCondition = @$filter["v_fp_masalah_psikososial"];
        $this->fp_masalah_psikososial->AdvancedSearch->SearchValue2 = @$filter["y_fp_masalah_psikososial"];
        $this->fp_masalah_psikososial->AdvancedSearch->SearchOperator2 = @$filter["w_fp_masalah_psikososial"];
        $this->fp_masalah_psikososial->AdvancedSearch->save();

        // Field ket_masalah_psikososial
        $this->ket_masalah_psikososial->AdvancedSearch->SearchValue = @$filter["x_ket_masalah_psikososial"];
        $this->ket_masalah_psikososial->AdvancedSearch->SearchOperator = @$filter["z_ket_masalah_psikososial"];
        $this->ket_masalah_psikososial->AdvancedSearch->SearchCondition = @$filter["v_ket_masalah_psikososial"];
        $this->ket_masalah_psikososial->AdvancedSearch->SearchValue2 = @$filter["y_ket_masalah_psikososial"];
        $this->ket_masalah_psikososial->AdvancedSearch->SearchOperator2 = @$filter["w_ket_masalah_psikososial"];
        $this->ket_masalah_psikososial->AdvancedSearch->save();

        // Field rh_keluarga
        $this->rh_keluarga->AdvancedSearch->SearchValue = @$filter["x_rh_keluarga"];
        $this->rh_keluarga->AdvancedSearch->SearchOperator = @$filter["z_rh_keluarga"];
        $this->rh_keluarga->AdvancedSearch->SearchCondition = @$filter["v_rh_keluarga"];
        $this->rh_keluarga->AdvancedSearch->SearchValue2 = @$filter["y_rh_keluarga"];
        $this->rh_keluarga->AdvancedSearch->SearchOperator2 = @$filter["w_rh_keluarga"];
        $this->rh_keluarga->AdvancedSearch->save();

        // Field ket_rh_keluarga
        $this->ket_rh_keluarga->AdvancedSearch->SearchValue = @$filter["x_ket_rh_keluarga"];
        $this->ket_rh_keluarga->AdvancedSearch->SearchOperator = @$filter["z_ket_rh_keluarga"];
        $this->ket_rh_keluarga->AdvancedSearch->SearchCondition = @$filter["v_ket_rh_keluarga"];
        $this->ket_rh_keluarga->AdvancedSearch->SearchValue2 = @$filter["y_ket_rh_keluarga"];
        $this->ket_rh_keluarga->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rh_keluarga"];
        $this->ket_rh_keluarga->AdvancedSearch->save();

        // Field resiko_bunuh_diri
        $this->resiko_bunuh_diri->AdvancedSearch->SearchValue = @$filter["x_resiko_bunuh_diri"];
        $this->resiko_bunuh_diri->AdvancedSearch->SearchOperator = @$filter["z_resiko_bunuh_diri"];
        $this->resiko_bunuh_diri->AdvancedSearch->SearchCondition = @$filter["v_resiko_bunuh_diri"];
        $this->resiko_bunuh_diri->AdvancedSearch->SearchValue2 = @$filter["y_resiko_bunuh_diri"];
        $this->resiko_bunuh_diri->AdvancedSearch->SearchOperator2 = @$filter["w_resiko_bunuh_diri"];
        $this->resiko_bunuh_diri->AdvancedSearch->save();

        // Field rbd_ide
        $this->rbd_ide->AdvancedSearch->SearchValue = @$filter["x_rbd_ide"];
        $this->rbd_ide->AdvancedSearch->SearchOperator = @$filter["z_rbd_ide"];
        $this->rbd_ide->AdvancedSearch->SearchCondition = @$filter["v_rbd_ide"];
        $this->rbd_ide->AdvancedSearch->SearchValue2 = @$filter["y_rbd_ide"];
        $this->rbd_ide->AdvancedSearch->SearchOperator2 = @$filter["w_rbd_ide"];
        $this->rbd_ide->AdvancedSearch->save();

        // Field ket_rbd_ide
        $this->ket_rbd_ide->AdvancedSearch->SearchValue = @$filter["x_ket_rbd_ide"];
        $this->ket_rbd_ide->AdvancedSearch->SearchOperator = @$filter["z_ket_rbd_ide"];
        $this->ket_rbd_ide->AdvancedSearch->SearchCondition = @$filter["v_ket_rbd_ide"];
        $this->ket_rbd_ide->AdvancedSearch->SearchValue2 = @$filter["y_ket_rbd_ide"];
        $this->ket_rbd_ide->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rbd_ide"];
        $this->ket_rbd_ide->AdvancedSearch->save();

        // Field rbd_rencana
        $this->rbd_rencana->AdvancedSearch->SearchValue = @$filter["x_rbd_rencana"];
        $this->rbd_rencana->AdvancedSearch->SearchOperator = @$filter["z_rbd_rencana"];
        $this->rbd_rencana->AdvancedSearch->SearchCondition = @$filter["v_rbd_rencana"];
        $this->rbd_rencana->AdvancedSearch->SearchValue2 = @$filter["y_rbd_rencana"];
        $this->rbd_rencana->AdvancedSearch->SearchOperator2 = @$filter["w_rbd_rencana"];
        $this->rbd_rencana->AdvancedSearch->save();

        // Field ket_rbd_rencana
        $this->ket_rbd_rencana->AdvancedSearch->SearchValue = @$filter["x_ket_rbd_rencana"];
        $this->ket_rbd_rencana->AdvancedSearch->SearchOperator = @$filter["z_ket_rbd_rencana"];
        $this->ket_rbd_rencana->AdvancedSearch->SearchCondition = @$filter["v_ket_rbd_rencana"];
        $this->ket_rbd_rencana->AdvancedSearch->SearchValue2 = @$filter["y_ket_rbd_rencana"];
        $this->ket_rbd_rencana->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rbd_rencana"];
        $this->ket_rbd_rencana->AdvancedSearch->save();

        // Field rbd_alat
        $this->rbd_alat->AdvancedSearch->SearchValue = @$filter["x_rbd_alat"];
        $this->rbd_alat->AdvancedSearch->SearchOperator = @$filter["z_rbd_alat"];
        $this->rbd_alat->AdvancedSearch->SearchCondition = @$filter["v_rbd_alat"];
        $this->rbd_alat->AdvancedSearch->SearchValue2 = @$filter["y_rbd_alat"];
        $this->rbd_alat->AdvancedSearch->SearchOperator2 = @$filter["w_rbd_alat"];
        $this->rbd_alat->AdvancedSearch->save();

        // Field ket_rbd_alat
        $this->ket_rbd_alat->AdvancedSearch->SearchValue = @$filter["x_ket_rbd_alat"];
        $this->ket_rbd_alat->AdvancedSearch->SearchOperator = @$filter["z_ket_rbd_alat"];
        $this->ket_rbd_alat->AdvancedSearch->SearchCondition = @$filter["v_ket_rbd_alat"];
        $this->ket_rbd_alat->AdvancedSearch->SearchValue2 = @$filter["y_ket_rbd_alat"];
        $this->ket_rbd_alat->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rbd_alat"];
        $this->ket_rbd_alat->AdvancedSearch->save();

        // Field rbd_percobaan
        $this->rbd_percobaan->AdvancedSearch->SearchValue = @$filter["x_rbd_percobaan"];
        $this->rbd_percobaan->AdvancedSearch->SearchOperator = @$filter["z_rbd_percobaan"];
        $this->rbd_percobaan->AdvancedSearch->SearchCondition = @$filter["v_rbd_percobaan"];
        $this->rbd_percobaan->AdvancedSearch->SearchValue2 = @$filter["y_rbd_percobaan"];
        $this->rbd_percobaan->AdvancedSearch->SearchOperator2 = @$filter["w_rbd_percobaan"];
        $this->rbd_percobaan->AdvancedSearch->save();

        // Field ket_rbd_percobaan
        $this->ket_rbd_percobaan->AdvancedSearch->SearchValue = @$filter["x_ket_rbd_percobaan"];
        $this->ket_rbd_percobaan->AdvancedSearch->SearchOperator = @$filter["z_ket_rbd_percobaan"];
        $this->ket_rbd_percobaan->AdvancedSearch->SearchCondition = @$filter["v_ket_rbd_percobaan"];
        $this->ket_rbd_percobaan->AdvancedSearch->SearchValue2 = @$filter["y_ket_rbd_percobaan"];
        $this->ket_rbd_percobaan->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rbd_percobaan"];
        $this->ket_rbd_percobaan->AdvancedSearch->save();

        // Field rbd_keinginan
        $this->rbd_keinginan->AdvancedSearch->SearchValue = @$filter["x_rbd_keinginan"];
        $this->rbd_keinginan->AdvancedSearch->SearchOperator = @$filter["z_rbd_keinginan"];
        $this->rbd_keinginan->AdvancedSearch->SearchCondition = @$filter["v_rbd_keinginan"];
        $this->rbd_keinginan->AdvancedSearch->SearchValue2 = @$filter["y_rbd_keinginan"];
        $this->rbd_keinginan->AdvancedSearch->SearchOperator2 = @$filter["w_rbd_keinginan"];
        $this->rbd_keinginan->AdvancedSearch->save();

        // Field ket_rbd_keinginan
        $this->ket_rbd_keinginan->AdvancedSearch->SearchValue = @$filter["x_ket_rbd_keinginan"];
        $this->ket_rbd_keinginan->AdvancedSearch->SearchOperator = @$filter["z_ket_rbd_keinginan"];
        $this->ket_rbd_keinginan->AdvancedSearch->SearchCondition = @$filter["v_ket_rbd_keinginan"];
        $this->ket_rbd_keinginan->AdvancedSearch->SearchValue2 = @$filter["y_ket_rbd_keinginan"];
        $this->ket_rbd_keinginan->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rbd_keinginan"];
        $this->ket_rbd_keinginan->AdvancedSearch->save();

        // Field rpo_penggunaan
        $this->rpo_penggunaan->AdvancedSearch->SearchValue = @$filter["x_rpo_penggunaan"];
        $this->rpo_penggunaan->AdvancedSearch->SearchOperator = @$filter["z_rpo_penggunaan"];
        $this->rpo_penggunaan->AdvancedSearch->SearchCondition = @$filter["v_rpo_penggunaan"];
        $this->rpo_penggunaan->AdvancedSearch->SearchValue2 = @$filter["y_rpo_penggunaan"];
        $this->rpo_penggunaan->AdvancedSearch->SearchOperator2 = @$filter["w_rpo_penggunaan"];
        $this->rpo_penggunaan->AdvancedSearch->save();

        // Field ket_rpo_penggunaan
        $this->ket_rpo_penggunaan->AdvancedSearch->SearchValue = @$filter["x_ket_rpo_penggunaan"];
        $this->ket_rpo_penggunaan->AdvancedSearch->SearchOperator = @$filter["z_ket_rpo_penggunaan"];
        $this->ket_rpo_penggunaan->AdvancedSearch->SearchCondition = @$filter["v_ket_rpo_penggunaan"];
        $this->ket_rpo_penggunaan->AdvancedSearch->SearchValue2 = @$filter["y_ket_rpo_penggunaan"];
        $this->ket_rpo_penggunaan->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rpo_penggunaan"];
        $this->ket_rpo_penggunaan->AdvancedSearch->save();

        // Field rpo_efek_samping
        $this->rpo_efek_samping->AdvancedSearch->SearchValue = @$filter["x_rpo_efek_samping"];
        $this->rpo_efek_samping->AdvancedSearch->SearchOperator = @$filter["z_rpo_efek_samping"];
        $this->rpo_efek_samping->AdvancedSearch->SearchCondition = @$filter["v_rpo_efek_samping"];
        $this->rpo_efek_samping->AdvancedSearch->SearchValue2 = @$filter["y_rpo_efek_samping"];
        $this->rpo_efek_samping->AdvancedSearch->SearchOperator2 = @$filter["w_rpo_efek_samping"];
        $this->rpo_efek_samping->AdvancedSearch->save();

        // Field ket_rpo_efek_samping
        $this->ket_rpo_efek_samping->AdvancedSearch->SearchValue = @$filter["x_ket_rpo_efek_samping"];
        $this->ket_rpo_efek_samping->AdvancedSearch->SearchOperator = @$filter["z_ket_rpo_efek_samping"];
        $this->ket_rpo_efek_samping->AdvancedSearch->SearchCondition = @$filter["v_ket_rpo_efek_samping"];
        $this->ket_rpo_efek_samping->AdvancedSearch->SearchValue2 = @$filter["y_ket_rpo_efek_samping"];
        $this->ket_rpo_efek_samping->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rpo_efek_samping"];
        $this->ket_rpo_efek_samping->AdvancedSearch->save();

        // Field rpo_napza
        $this->rpo_napza->AdvancedSearch->SearchValue = @$filter["x_rpo_napza"];
        $this->rpo_napza->AdvancedSearch->SearchOperator = @$filter["z_rpo_napza"];
        $this->rpo_napza->AdvancedSearch->SearchCondition = @$filter["v_rpo_napza"];
        $this->rpo_napza->AdvancedSearch->SearchValue2 = @$filter["y_rpo_napza"];
        $this->rpo_napza->AdvancedSearch->SearchOperator2 = @$filter["w_rpo_napza"];
        $this->rpo_napza->AdvancedSearch->save();

        // Field ket_rpo_napza
        $this->ket_rpo_napza->AdvancedSearch->SearchValue = @$filter["x_ket_rpo_napza"];
        $this->ket_rpo_napza->AdvancedSearch->SearchOperator = @$filter["z_ket_rpo_napza"];
        $this->ket_rpo_napza->AdvancedSearch->SearchCondition = @$filter["v_ket_rpo_napza"];
        $this->ket_rpo_napza->AdvancedSearch->SearchValue2 = @$filter["y_ket_rpo_napza"];
        $this->ket_rpo_napza->AdvancedSearch->SearchOperator2 = @$filter["w_ket_rpo_napza"];
        $this->ket_rpo_napza->AdvancedSearch->save();

        // Field ket_lama_pemakaian
        $this->ket_lama_pemakaian->AdvancedSearch->SearchValue = @$filter["x_ket_lama_pemakaian"];
        $this->ket_lama_pemakaian->AdvancedSearch->SearchOperator = @$filter["z_ket_lama_pemakaian"];
        $this->ket_lama_pemakaian->AdvancedSearch->SearchCondition = @$filter["v_ket_lama_pemakaian"];
        $this->ket_lama_pemakaian->AdvancedSearch->SearchValue2 = @$filter["y_ket_lama_pemakaian"];
        $this->ket_lama_pemakaian->AdvancedSearch->SearchOperator2 = @$filter["w_ket_lama_pemakaian"];
        $this->ket_lama_pemakaian->AdvancedSearch->save();

        // Field ket_cara_pemakaian
        $this->ket_cara_pemakaian->AdvancedSearch->SearchValue = @$filter["x_ket_cara_pemakaian"];
        $this->ket_cara_pemakaian->AdvancedSearch->SearchOperator = @$filter["z_ket_cara_pemakaian"];
        $this->ket_cara_pemakaian->AdvancedSearch->SearchCondition = @$filter["v_ket_cara_pemakaian"];
        $this->ket_cara_pemakaian->AdvancedSearch->SearchValue2 = @$filter["y_ket_cara_pemakaian"];
        $this->ket_cara_pemakaian->AdvancedSearch->SearchOperator2 = @$filter["w_ket_cara_pemakaian"];
        $this->ket_cara_pemakaian->AdvancedSearch->save();

        // Field ket_latar_belakang_pemakaian
        $this->ket_latar_belakang_pemakaian->AdvancedSearch->SearchValue = @$filter["x_ket_latar_belakang_pemakaian"];
        $this->ket_latar_belakang_pemakaian->AdvancedSearch->SearchOperator = @$filter["z_ket_latar_belakang_pemakaian"];
        $this->ket_latar_belakang_pemakaian->AdvancedSearch->SearchCondition = @$filter["v_ket_latar_belakang_pemakaian"];
        $this->ket_latar_belakang_pemakaian->AdvancedSearch->SearchValue2 = @$filter["y_ket_latar_belakang_pemakaian"];
        $this->ket_latar_belakang_pemakaian->AdvancedSearch->SearchOperator2 = @$filter["w_ket_latar_belakang_pemakaian"];
        $this->ket_latar_belakang_pemakaian->AdvancedSearch->save();

        // Field rpo_penggunaan_obat_lainnya
        $this->rpo_penggunaan_obat_lainnya->AdvancedSearch->SearchValue = @$filter["x_rpo_penggunaan_obat_lainnya"];
        $this->rpo_penggunaan_obat_lainnya->AdvancedSearch->SearchOperator = @$filter["z_rpo_penggunaan_obat_lainnya"];
        $this->rpo_penggunaan_obat_lainnya->AdvancedSearch->SearchCondition = @$filter["v_rpo_penggunaan_obat_lainnya"];
        $this->rpo_penggunaan_obat_lainnya->AdvancedSearch->SearchValue2 = @$filter["y_rpo_penggunaan_obat_lainnya"];
        $this->rpo_penggunaan_obat_lainnya->AdvancedSearch->SearchOperator2 = @$filter["w_rpo_penggunaan_obat_lainnya"];
        $this->rpo_penggunaan_obat_lainnya->AdvancedSearch->save();

        // Field ket_penggunaan_obat_lainnya
        $this->ket_penggunaan_obat_lainnya->AdvancedSearch->SearchValue = @$filter["x_ket_penggunaan_obat_lainnya"];
        $this->ket_penggunaan_obat_lainnya->AdvancedSearch->SearchOperator = @$filter["z_ket_penggunaan_obat_lainnya"];
        $this->ket_penggunaan_obat_lainnya->AdvancedSearch->SearchCondition = @$filter["v_ket_penggunaan_obat_lainnya"];
        $this->ket_penggunaan_obat_lainnya->AdvancedSearch->SearchValue2 = @$filter["y_ket_penggunaan_obat_lainnya"];
        $this->ket_penggunaan_obat_lainnya->AdvancedSearch->SearchOperator2 = @$filter["w_ket_penggunaan_obat_lainnya"];
        $this->ket_penggunaan_obat_lainnya->AdvancedSearch->save();

        // Field ket_alasan_penggunaan
        $this->ket_alasan_penggunaan->AdvancedSearch->SearchValue = @$filter["x_ket_alasan_penggunaan"];
        $this->ket_alasan_penggunaan->AdvancedSearch->SearchOperator = @$filter["z_ket_alasan_penggunaan"];
        $this->ket_alasan_penggunaan->AdvancedSearch->SearchCondition = @$filter["v_ket_alasan_penggunaan"];
        $this->ket_alasan_penggunaan->AdvancedSearch->SearchValue2 = @$filter["y_ket_alasan_penggunaan"];
        $this->ket_alasan_penggunaan->AdvancedSearch->SearchOperator2 = @$filter["w_ket_alasan_penggunaan"];
        $this->ket_alasan_penggunaan->AdvancedSearch->save();

        // Field rpo_alergi_obat
        $this->rpo_alergi_obat->AdvancedSearch->SearchValue = @$filter["x_rpo_alergi_obat"];
        $this->rpo_alergi_obat->AdvancedSearch->SearchOperator = @$filter["z_rpo_alergi_obat"];
        $this->rpo_alergi_obat->AdvancedSearch->SearchCondition = @$filter["v_rpo_alergi_obat"];
        $this->rpo_alergi_obat->AdvancedSearch->SearchValue2 = @$filter["y_rpo_alergi_obat"];
        $this->rpo_alergi_obat->AdvancedSearch->SearchOperator2 = @$filter["w_rpo_alergi_obat"];
        $this->rpo_alergi_obat->AdvancedSearch->save();

        // Field ket_alergi_obat
        $this->ket_alergi_obat->AdvancedSearch->SearchValue = @$filter["x_ket_alergi_obat"];
        $this->ket_alergi_obat->AdvancedSearch->SearchOperator = @$filter["z_ket_alergi_obat"];
        $this->ket_alergi_obat->AdvancedSearch->SearchCondition = @$filter["v_ket_alergi_obat"];
        $this->ket_alergi_obat->AdvancedSearch->SearchValue2 = @$filter["y_ket_alergi_obat"];
        $this->ket_alergi_obat->AdvancedSearch->SearchOperator2 = @$filter["w_ket_alergi_obat"];
        $this->ket_alergi_obat->AdvancedSearch->save();

        // Field rpo_merokok
        $this->rpo_merokok->AdvancedSearch->SearchValue = @$filter["x_rpo_merokok"];
        $this->rpo_merokok->AdvancedSearch->SearchOperator = @$filter["z_rpo_merokok"];
        $this->rpo_merokok->AdvancedSearch->SearchCondition = @$filter["v_rpo_merokok"];
        $this->rpo_merokok->AdvancedSearch->SearchValue2 = @$filter["y_rpo_merokok"];
        $this->rpo_merokok->AdvancedSearch->SearchOperator2 = @$filter["w_rpo_merokok"];
        $this->rpo_merokok->AdvancedSearch->save();

        // Field ket_merokok
        $this->ket_merokok->AdvancedSearch->SearchValue = @$filter["x_ket_merokok"];
        $this->ket_merokok->AdvancedSearch->SearchOperator = @$filter["z_ket_merokok"];
        $this->ket_merokok->AdvancedSearch->SearchCondition = @$filter["v_ket_merokok"];
        $this->ket_merokok->AdvancedSearch->SearchValue2 = @$filter["y_ket_merokok"];
        $this->ket_merokok->AdvancedSearch->SearchOperator2 = @$filter["w_ket_merokok"];
        $this->ket_merokok->AdvancedSearch->save();

        // Field rpo_minum_kopi
        $this->rpo_minum_kopi->AdvancedSearch->SearchValue = @$filter["x_rpo_minum_kopi"];
        $this->rpo_minum_kopi->AdvancedSearch->SearchOperator = @$filter["z_rpo_minum_kopi"];
        $this->rpo_minum_kopi->AdvancedSearch->SearchCondition = @$filter["v_rpo_minum_kopi"];
        $this->rpo_minum_kopi->AdvancedSearch->SearchValue2 = @$filter["y_rpo_minum_kopi"];
        $this->rpo_minum_kopi->AdvancedSearch->SearchOperator2 = @$filter["w_rpo_minum_kopi"];
        $this->rpo_minum_kopi->AdvancedSearch->save();

        // Field ket_minum_kopi
        $this->ket_minum_kopi->AdvancedSearch->SearchValue = @$filter["x_ket_minum_kopi"];
        $this->ket_minum_kopi->AdvancedSearch->SearchOperator = @$filter["z_ket_minum_kopi"];
        $this->ket_minum_kopi->AdvancedSearch->SearchCondition = @$filter["v_ket_minum_kopi"];
        $this->ket_minum_kopi->AdvancedSearch->SearchValue2 = @$filter["y_ket_minum_kopi"];
        $this->ket_minum_kopi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_minum_kopi"];
        $this->ket_minum_kopi->AdvancedSearch->save();

        // Field td
        $this->td->AdvancedSearch->SearchValue = @$filter["x_td"];
        $this->td->AdvancedSearch->SearchOperator = @$filter["z_td"];
        $this->td->AdvancedSearch->SearchCondition = @$filter["v_td"];
        $this->td->AdvancedSearch->SearchValue2 = @$filter["y_td"];
        $this->td->AdvancedSearch->SearchOperator2 = @$filter["w_td"];
        $this->td->AdvancedSearch->save();

        // Field nadi
        $this->nadi->AdvancedSearch->SearchValue = @$filter["x_nadi"];
        $this->nadi->AdvancedSearch->SearchOperator = @$filter["z_nadi"];
        $this->nadi->AdvancedSearch->SearchCondition = @$filter["v_nadi"];
        $this->nadi->AdvancedSearch->SearchValue2 = @$filter["y_nadi"];
        $this->nadi->AdvancedSearch->SearchOperator2 = @$filter["w_nadi"];
        $this->nadi->AdvancedSearch->save();

        // Field gcs
        $this->gcs->AdvancedSearch->SearchValue = @$filter["x_gcs"];
        $this->gcs->AdvancedSearch->SearchOperator = @$filter["z_gcs"];
        $this->gcs->AdvancedSearch->SearchCondition = @$filter["v_gcs"];
        $this->gcs->AdvancedSearch->SearchValue2 = @$filter["y_gcs"];
        $this->gcs->AdvancedSearch->SearchOperator2 = @$filter["w_gcs"];
        $this->gcs->AdvancedSearch->save();

        // Field rr
        $this->rr->AdvancedSearch->SearchValue = @$filter["x_rr"];
        $this->rr->AdvancedSearch->SearchOperator = @$filter["z_rr"];
        $this->rr->AdvancedSearch->SearchCondition = @$filter["v_rr"];
        $this->rr->AdvancedSearch->SearchValue2 = @$filter["y_rr"];
        $this->rr->AdvancedSearch->SearchOperator2 = @$filter["w_rr"];
        $this->rr->AdvancedSearch->save();

        // Field suhu
        $this->suhu->AdvancedSearch->SearchValue = @$filter["x_suhu"];
        $this->suhu->AdvancedSearch->SearchOperator = @$filter["z_suhu"];
        $this->suhu->AdvancedSearch->SearchCondition = @$filter["v_suhu"];
        $this->suhu->AdvancedSearch->SearchValue2 = @$filter["y_suhu"];
        $this->suhu->AdvancedSearch->SearchOperator2 = @$filter["w_suhu"];
        $this->suhu->AdvancedSearch->save();

        // Field pf_keluhan_fisik
        $this->pf_keluhan_fisik->AdvancedSearch->SearchValue = @$filter["x_pf_keluhan_fisik"];
        $this->pf_keluhan_fisik->AdvancedSearch->SearchOperator = @$filter["z_pf_keluhan_fisik"];
        $this->pf_keluhan_fisik->AdvancedSearch->SearchCondition = @$filter["v_pf_keluhan_fisik"];
        $this->pf_keluhan_fisik->AdvancedSearch->SearchValue2 = @$filter["y_pf_keluhan_fisik"];
        $this->pf_keluhan_fisik->AdvancedSearch->SearchOperator2 = @$filter["w_pf_keluhan_fisik"];
        $this->pf_keluhan_fisik->AdvancedSearch->save();

        // Field ket_keluhan_fisik
        $this->ket_keluhan_fisik->AdvancedSearch->SearchValue = @$filter["x_ket_keluhan_fisik"];
        $this->ket_keluhan_fisik->AdvancedSearch->SearchOperator = @$filter["z_ket_keluhan_fisik"];
        $this->ket_keluhan_fisik->AdvancedSearch->SearchCondition = @$filter["v_ket_keluhan_fisik"];
        $this->ket_keluhan_fisik->AdvancedSearch->SearchValue2 = @$filter["y_ket_keluhan_fisik"];
        $this->ket_keluhan_fisik->AdvancedSearch->SearchOperator2 = @$filter["w_ket_keluhan_fisik"];
        $this->ket_keluhan_fisik->AdvancedSearch->save();

        // Field skala_nyeri
        $this->skala_nyeri->AdvancedSearch->SearchValue = @$filter["x_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchOperator = @$filter["z_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchCondition = @$filter["v_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchValue2 = @$filter["y_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->SearchOperator2 = @$filter["w_skala_nyeri"];
        $this->skala_nyeri->AdvancedSearch->save();

        // Field durasi
        $this->durasi->AdvancedSearch->SearchValue = @$filter["x_durasi"];
        $this->durasi->AdvancedSearch->SearchOperator = @$filter["z_durasi"];
        $this->durasi->AdvancedSearch->SearchCondition = @$filter["v_durasi"];
        $this->durasi->AdvancedSearch->SearchValue2 = @$filter["y_durasi"];
        $this->durasi->AdvancedSearch->SearchOperator2 = @$filter["w_durasi"];
        $this->durasi->AdvancedSearch->save();

        // Field nyeri
        $this->nyeri->AdvancedSearch->SearchValue = @$filter["x_nyeri"];
        $this->nyeri->AdvancedSearch->SearchOperator = @$filter["z_nyeri"];
        $this->nyeri->AdvancedSearch->SearchCondition = @$filter["v_nyeri"];
        $this->nyeri->AdvancedSearch->SearchValue2 = @$filter["y_nyeri"];
        $this->nyeri->AdvancedSearch->SearchOperator2 = @$filter["w_nyeri"];
        $this->nyeri->AdvancedSearch->save();

        // Field provokes
        $this->provokes->AdvancedSearch->SearchValue = @$filter["x_provokes"];
        $this->provokes->AdvancedSearch->SearchOperator = @$filter["z_provokes"];
        $this->provokes->AdvancedSearch->SearchCondition = @$filter["v_provokes"];
        $this->provokes->AdvancedSearch->SearchValue2 = @$filter["y_provokes"];
        $this->provokes->AdvancedSearch->SearchOperator2 = @$filter["w_provokes"];
        $this->provokes->AdvancedSearch->save();

        // Field ket_provokes
        $this->ket_provokes->AdvancedSearch->SearchValue = @$filter["x_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchOperator = @$filter["z_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchCondition = @$filter["v_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchValue2 = @$filter["y_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->SearchOperator2 = @$filter["w_ket_provokes"];
        $this->ket_provokes->AdvancedSearch->save();

        // Field quality
        $this->quality->AdvancedSearch->SearchValue = @$filter["x_quality"];
        $this->quality->AdvancedSearch->SearchOperator = @$filter["z_quality"];
        $this->quality->AdvancedSearch->SearchCondition = @$filter["v_quality"];
        $this->quality->AdvancedSearch->SearchValue2 = @$filter["y_quality"];
        $this->quality->AdvancedSearch->SearchOperator2 = @$filter["w_quality"];
        $this->quality->AdvancedSearch->save();

        // Field ket_quality
        $this->ket_quality->AdvancedSearch->SearchValue = @$filter["x_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchOperator = @$filter["z_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchCondition = @$filter["v_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchValue2 = @$filter["y_ket_quality"];
        $this->ket_quality->AdvancedSearch->SearchOperator2 = @$filter["w_ket_quality"];
        $this->ket_quality->AdvancedSearch->save();

        // Field lokasi
        $this->lokasi->AdvancedSearch->SearchValue = @$filter["x_lokasi"];
        $this->lokasi->AdvancedSearch->SearchOperator = @$filter["z_lokasi"];
        $this->lokasi->AdvancedSearch->SearchCondition = @$filter["v_lokasi"];
        $this->lokasi->AdvancedSearch->SearchValue2 = @$filter["y_lokasi"];
        $this->lokasi->AdvancedSearch->SearchOperator2 = @$filter["w_lokasi"];
        $this->lokasi->AdvancedSearch->save();

        // Field menyebar
        $this->menyebar->AdvancedSearch->SearchValue = @$filter["x_menyebar"];
        $this->menyebar->AdvancedSearch->SearchOperator = @$filter["z_menyebar"];
        $this->menyebar->AdvancedSearch->SearchCondition = @$filter["v_menyebar"];
        $this->menyebar->AdvancedSearch->SearchValue2 = @$filter["y_menyebar"];
        $this->menyebar->AdvancedSearch->SearchOperator2 = @$filter["w_menyebar"];
        $this->menyebar->AdvancedSearch->save();

        // Field pada_dokter
        $this->pada_dokter->AdvancedSearch->SearchValue = @$filter["x_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchOperator = @$filter["z_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchCondition = @$filter["v_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchValue2 = @$filter["y_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->SearchOperator2 = @$filter["w_pada_dokter"];
        $this->pada_dokter->AdvancedSearch->save();

        // Field ket_dokter
        $this->ket_dokter->AdvancedSearch->SearchValue = @$filter["x_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchOperator = @$filter["z_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchCondition = @$filter["v_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchValue2 = @$filter["y_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->SearchOperator2 = @$filter["w_ket_dokter"];
        $this->ket_dokter->AdvancedSearch->save();

        // Field nyeri_hilang
        $this->nyeri_hilang->AdvancedSearch->SearchValue = @$filter["x_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchOperator = @$filter["z_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchCondition = @$filter["v_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchValue2 = @$filter["y_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->SearchOperator2 = @$filter["w_nyeri_hilang"];
        $this->nyeri_hilang->AdvancedSearch->save();

        // Field ket_nyeri
        $this->ket_nyeri->AdvancedSearch->SearchValue = @$filter["x_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchOperator = @$filter["z_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchCondition = @$filter["v_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchValue2 = @$filter["y_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->SearchOperator2 = @$filter["w_ket_nyeri"];
        $this->ket_nyeri->AdvancedSearch->save();

        // Field bb
        $this->bb->AdvancedSearch->SearchValue = @$filter["x_bb"];
        $this->bb->AdvancedSearch->SearchOperator = @$filter["z_bb"];
        $this->bb->AdvancedSearch->SearchCondition = @$filter["v_bb"];
        $this->bb->AdvancedSearch->SearchValue2 = @$filter["y_bb"];
        $this->bb->AdvancedSearch->SearchOperator2 = @$filter["w_bb"];
        $this->bb->AdvancedSearch->save();

        // Field tb
        $this->tb->AdvancedSearch->SearchValue = @$filter["x_tb"];
        $this->tb->AdvancedSearch->SearchOperator = @$filter["z_tb"];
        $this->tb->AdvancedSearch->SearchCondition = @$filter["v_tb"];
        $this->tb->AdvancedSearch->SearchValue2 = @$filter["y_tb"];
        $this->tb->AdvancedSearch->SearchOperator2 = @$filter["w_tb"];
        $this->tb->AdvancedSearch->save();

        // Field bmi
        $this->bmi->AdvancedSearch->SearchValue = @$filter["x_bmi"];
        $this->bmi->AdvancedSearch->SearchOperator = @$filter["z_bmi"];
        $this->bmi->AdvancedSearch->SearchCondition = @$filter["v_bmi"];
        $this->bmi->AdvancedSearch->SearchValue2 = @$filter["y_bmi"];
        $this->bmi->AdvancedSearch->SearchOperator2 = @$filter["w_bmi"];
        $this->bmi->AdvancedSearch->save();

        // Field lapor_status_nutrisi
        $this->lapor_status_nutrisi->AdvancedSearch->SearchValue = @$filter["x_lapor_status_nutrisi"];
        $this->lapor_status_nutrisi->AdvancedSearch->SearchOperator = @$filter["z_lapor_status_nutrisi"];
        $this->lapor_status_nutrisi->AdvancedSearch->SearchCondition = @$filter["v_lapor_status_nutrisi"];
        $this->lapor_status_nutrisi->AdvancedSearch->SearchValue2 = @$filter["y_lapor_status_nutrisi"];
        $this->lapor_status_nutrisi->AdvancedSearch->SearchOperator2 = @$filter["w_lapor_status_nutrisi"];
        $this->lapor_status_nutrisi->AdvancedSearch->save();

        // Field ket_lapor_status_nutrisi
        $this->ket_lapor_status_nutrisi->AdvancedSearch->SearchValue = @$filter["x_ket_lapor_status_nutrisi"];
        $this->ket_lapor_status_nutrisi->AdvancedSearch->SearchOperator = @$filter["z_ket_lapor_status_nutrisi"];
        $this->ket_lapor_status_nutrisi->AdvancedSearch->SearchCondition = @$filter["v_ket_lapor_status_nutrisi"];
        $this->ket_lapor_status_nutrisi->AdvancedSearch->SearchValue2 = @$filter["y_ket_lapor_status_nutrisi"];
        $this->ket_lapor_status_nutrisi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_lapor_status_nutrisi"];
        $this->ket_lapor_status_nutrisi->AdvancedSearch->save();

        // Field sg1
        $this->sg1->AdvancedSearch->SearchValue = @$filter["x_sg1"];
        $this->sg1->AdvancedSearch->SearchOperator = @$filter["z_sg1"];
        $this->sg1->AdvancedSearch->SearchCondition = @$filter["v_sg1"];
        $this->sg1->AdvancedSearch->SearchValue2 = @$filter["y_sg1"];
        $this->sg1->AdvancedSearch->SearchOperator2 = @$filter["w_sg1"];
        $this->sg1->AdvancedSearch->save();

        // Field nilai1
        $this->nilai1->AdvancedSearch->SearchValue = @$filter["x_nilai1"];
        $this->nilai1->AdvancedSearch->SearchOperator = @$filter["z_nilai1"];
        $this->nilai1->AdvancedSearch->SearchCondition = @$filter["v_nilai1"];
        $this->nilai1->AdvancedSearch->SearchValue2 = @$filter["y_nilai1"];
        $this->nilai1->AdvancedSearch->SearchOperator2 = @$filter["w_nilai1"];
        $this->nilai1->AdvancedSearch->save();

        // Field sg2
        $this->sg2->AdvancedSearch->SearchValue = @$filter["x_sg2"];
        $this->sg2->AdvancedSearch->SearchOperator = @$filter["z_sg2"];
        $this->sg2->AdvancedSearch->SearchCondition = @$filter["v_sg2"];
        $this->sg2->AdvancedSearch->SearchValue2 = @$filter["y_sg2"];
        $this->sg2->AdvancedSearch->SearchOperator2 = @$filter["w_sg2"];
        $this->sg2->AdvancedSearch->save();

        // Field nilai2
        $this->nilai2->AdvancedSearch->SearchValue = @$filter["x_nilai2"];
        $this->nilai2->AdvancedSearch->SearchOperator = @$filter["z_nilai2"];
        $this->nilai2->AdvancedSearch->SearchCondition = @$filter["v_nilai2"];
        $this->nilai2->AdvancedSearch->SearchValue2 = @$filter["y_nilai2"];
        $this->nilai2->AdvancedSearch->SearchOperator2 = @$filter["w_nilai2"];
        $this->nilai2->AdvancedSearch->save();

        // Field total_hasil
        $this->total_hasil->AdvancedSearch->SearchValue = @$filter["x_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchOperator = @$filter["z_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchCondition = @$filter["v_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchValue2 = @$filter["y_total_hasil"];
        $this->total_hasil->AdvancedSearch->SearchOperator2 = @$filter["w_total_hasil"];
        $this->total_hasil->AdvancedSearch->save();

        // Field resikojatuh
        $this->resikojatuh->AdvancedSearch->SearchValue = @$filter["x_resikojatuh"];
        $this->resikojatuh->AdvancedSearch->SearchOperator = @$filter["z_resikojatuh"];
        $this->resikojatuh->AdvancedSearch->SearchCondition = @$filter["v_resikojatuh"];
        $this->resikojatuh->AdvancedSearch->SearchValue2 = @$filter["y_resikojatuh"];
        $this->resikojatuh->AdvancedSearch->SearchOperator2 = @$filter["w_resikojatuh"];
        $this->resikojatuh->AdvancedSearch->save();

        // Field bjm
        $this->bjm->AdvancedSearch->SearchValue = @$filter["x_bjm"];
        $this->bjm->AdvancedSearch->SearchOperator = @$filter["z_bjm"];
        $this->bjm->AdvancedSearch->SearchCondition = @$filter["v_bjm"];
        $this->bjm->AdvancedSearch->SearchValue2 = @$filter["y_bjm"];
        $this->bjm->AdvancedSearch->SearchOperator2 = @$filter["w_bjm"];
        $this->bjm->AdvancedSearch->save();

        // Field msa
        $this->msa->AdvancedSearch->SearchValue = @$filter["x_msa"];
        $this->msa->AdvancedSearch->SearchOperator = @$filter["z_msa"];
        $this->msa->AdvancedSearch->SearchCondition = @$filter["v_msa"];
        $this->msa->AdvancedSearch->SearchValue2 = @$filter["y_msa"];
        $this->msa->AdvancedSearch->SearchOperator2 = @$filter["w_msa"];
        $this->msa->AdvancedSearch->save();

        // Field hasil
        $this->hasil->AdvancedSearch->SearchValue = @$filter["x_hasil"];
        $this->hasil->AdvancedSearch->SearchOperator = @$filter["z_hasil"];
        $this->hasil->AdvancedSearch->SearchCondition = @$filter["v_hasil"];
        $this->hasil->AdvancedSearch->SearchValue2 = @$filter["y_hasil"];
        $this->hasil->AdvancedSearch->SearchOperator2 = @$filter["w_hasil"];
        $this->hasil->AdvancedSearch->save();

        // Field lapor
        $this->lapor->AdvancedSearch->SearchValue = @$filter["x_lapor"];
        $this->lapor->AdvancedSearch->SearchOperator = @$filter["z_lapor"];
        $this->lapor->AdvancedSearch->SearchCondition = @$filter["v_lapor"];
        $this->lapor->AdvancedSearch->SearchValue2 = @$filter["y_lapor"];
        $this->lapor->AdvancedSearch->SearchOperator2 = @$filter["w_lapor"];
        $this->lapor->AdvancedSearch->save();

        // Field ket_lapor
        $this->ket_lapor->AdvancedSearch->SearchValue = @$filter["x_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchOperator = @$filter["z_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchCondition = @$filter["v_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchValue2 = @$filter["y_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->SearchOperator2 = @$filter["w_ket_lapor"];
        $this->ket_lapor->AdvancedSearch->save();

        // Field adl_mandi
        $this->adl_mandi->AdvancedSearch->SearchValue = @$filter["x_adl_mandi"];
        $this->adl_mandi->AdvancedSearch->SearchOperator = @$filter["z_adl_mandi"];
        $this->adl_mandi->AdvancedSearch->SearchCondition = @$filter["v_adl_mandi"];
        $this->adl_mandi->AdvancedSearch->SearchValue2 = @$filter["y_adl_mandi"];
        $this->adl_mandi->AdvancedSearch->SearchOperator2 = @$filter["w_adl_mandi"];
        $this->adl_mandi->AdvancedSearch->save();

        // Field adl_berpakaian
        $this->adl_berpakaian->AdvancedSearch->SearchValue = @$filter["x_adl_berpakaian"];
        $this->adl_berpakaian->AdvancedSearch->SearchOperator = @$filter["z_adl_berpakaian"];
        $this->adl_berpakaian->AdvancedSearch->SearchCondition = @$filter["v_adl_berpakaian"];
        $this->adl_berpakaian->AdvancedSearch->SearchValue2 = @$filter["y_adl_berpakaian"];
        $this->adl_berpakaian->AdvancedSearch->SearchOperator2 = @$filter["w_adl_berpakaian"];
        $this->adl_berpakaian->AdvancedSearch->save();

        // Field adl_makan
        $this->adl_makan->AdvancedSearch->SearchValue = @$filter["x_adl_makan"];
        $this->adl_makan->AdvancedSearch->SearchOperator = @$filter["z_adl_makan"];
        $this->adl_makan->AdvancedSearch->SearchCondition = @$filter["v_adl_makan"];
        $this->adl_makan->AdvancedSearch->SearchValue2 = @$filter["y_adl_makan"];
        $this->adl_makan->AdvancedSearch->SearchOperator2 = @$filter["w_adl_makan"];
        $this->adl_makan->AdvancedSearch->save();

        // Field adl_bak
        $this->adl_bak->AdvancedSearch->SearchValue = @$filter["x_adl_bak"];
        $this->adl_bak->AdvancedSearch->SearchOperator = @$filter["z_adl_bak"];
        $this->adl_bak->AdvancedSearch->SearchCondition = @$filter["v_adl_bak"];
        $this->adl_bak->AdvancedSearch->SearchValue2 = @$filter["y_adl_bak"];
        $this->adl_bak->AdvancedSearch->SearchOperator2 = @$filter["w_adl_bak"];
        $this->adl_bak->AdvancedSearch->save();

        // Field adl_bab
        $this->adl_bab->AdvancedSearch->SearchValue = @$filter["x_adl_bab"];
        $this->adl_bab->AdvancedSearch->SearchOperator = @$filter["z_adl_bab"];
        $this->adl_bab->AdvancedSearch->SearchCondition = @$filter["v_adl_bab"];
        $this->adl_bab->AdvancedSearch->SearchValue2 = @$filter["y_adl_bab"];
        $this->adl_bab->AdvancedSearch->SearchOperator2 = @$filter["w_adl_bab"];
        $this->adl_bab->AdvancedSearch->save();

        // Field adl_hobi
        $this->adl_hobi->AdvancedSearch->SearchValue = @$filter["x_adl_hobi"];
        $this->adl_hobi->AdvancedSearch->SearchOperator = @$filter["z_adl_hobi"];
        $this->adl_hobi->AdvancedSearch->SearchCondition = @$filter["v_adl_hobi"];
        $this->adl_hobi->AdvancedSearch->SearchValue2 = @$filter["y_adl_hobi"];
        $this->adl_hobi->AdvancedSearch->SearchOperator2 = @$filter["w_adl_hobi"];
        $this->adl_hobi->AdvancedSearch->save();

        // Field ket_adl_hobi
        $this->ket_adl_hobi->AdvancedSearch->SearchValue = @$filter["x_ket_adl_hobi"];
        $this->ket_adl_hobi->AdvancedSearch->SearchOperator = @$filter["z_ket_adl_hobi"];
        $this->ket_adl_hobi->AdvancedSearch->SearchCondition = @$filter["v_ket_adl_hobi"];
        $this->ket_adl_hobi->AdvancedSearch->SearchValue2 = @$filter["y_ket_adl_hobi"];
        $this->ket_adl_hobi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_adl_hobi"];
        $this->ket_adl_hobi->AdvancedSearch->save();

        // Field adl_sosialisasi
        $this->adl_sosialisasi->AdvancedSearch->SearchValue = @$filter["x_adl_sosialisasi"];
        $this->adl_sosialisasi->AdvancedSearch->SearchOperator = @$filter["z_adl_sosialisasi"];
        $this->adl_sosialisasi->AdvancedSearch->SearchCondition = @$filter["v_adl_sosialisasi"];
        $this->adl_sosialisasi->AdvancedSearch->SearchValue2 = @$filter["y_adl_sosialisasi"];
        $this->adl_sosialisasi->AdvancedSearch->SearchOperator2 = @$filter["w_adl_sosialisasi"];
        $this->adl_sosialisasi->AdvancedSearch->save();

        // Field ket_adl_sosialisasi
        $this->ket_adl_sosialisasi->AdvancedSearch->SearchValue = @$filter["x_ket_adl_sosialisasi"];
        $this->ket_adl_sosialisasi->AdvancedSearch->SearchOperator = @$filter["z_ket_adl_sosialisasi"];
        $this->ket_adl_sosialisasi->AdvancedSearch->SearchCondition = @$filter["v_ket_adl_sosialisasi"];
        $this->ket_adl_sosialisasi->AdvancedSearch->SearchValue2 = @$filter["y_ket_adl_sosialisasi"];
        $this->ket_adl_sosialisasi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_adl_sosialisasi"];
        $this->ket_adl_sosialisasi->AdvancedSearch->save();

        // Field adl_kegiatan
        $this->adl_kegiatan->AdvancedSearch->SearchValue = @$filter["x_adl_kegiatan"];
        $this->adl_kegiatan->AdvancedSearch->SearchOperator = @$filter["z_adl_kegiatan"];
        $this->adl_kegiatan->AdvancedSearch->SearchCondition = @$filter["v_adl_kegiatan"];
        $this->adl_kegiatan->AdvancedSearch->SearchValue2 = @$filter["y_adl_kegiatan"];
        $this->adl_kegiatan->AdvancedSearch->SearchOperator2 = @$filter["w_adl_kegiatan"];
        $this->adl_kegiatan->AdvancedSearch->save();

        // Field ket_adl_kegiatan
        $this->ket_adl_kegiatan->AdvancedSearch->SearchValue = @$filter["x_ket_adl_kegiatan"];
        $this->ket_adl_kegiatan->AdvancedSearch->SearchOperator = @$filter["z_ket_adl_kegiatan"];
        $this->ket_adl_kegiatan->AdvancedSearch->SearchCondition = @$filter["v_ket_adl_kegiatan"];
        $this->ket_adl_kegiatan->AdvancedSearch->SearchValue2 = @$filter["y_ket_adl_kegiatan"];
        $this->ket_adl_kegiatan->AdvancedSearch->SearchOperator2 = @$filter["w_ket_adl_kegiatan"];
        $this->ket_adl_kegiatan->AdvancedSearch->save();

        // Field sk_penampilan
        $this->sk_penampilan->AdvancedSearch->SearchValue = @$filter["x_sk_penampilan"];
        $this->sk_penampilan->AdvancedSearch->SearchOperator = @$filter["z_sk_penampilan"];
        $this->sk_penampilan->AdvancedSearch->SearchCondition = @$filter["v_sk_penampilan"];
        $this->sk_penampilan->AdvancedSearch->SearchValue2 = @$filter["y_sk_penampilan"];
        $this->sk_penampilan->AdvancedSearch->SearchOperator2 = @$filter["w_sk_penampilan"];
        $this->sk_penampilan->AdvancedSearch->save();

        // Field sk_alam_perasaan
        $this->sk_alam_perasaan->AdvancedSearch->SearchValue = @$filter["x_sk_alam_perasaan"];
        $this->sk_alam_perasaan->AdvancedSearch->SearchOperator = @$filter["z_sk_alam_perasaan"];
        $this->sk_alam_perasaan->AdvancedSearch->SearchCondition = @$filter["v_sk_alam_perasaan"];
        $this->sk_alam_perasaan->AdvancedSearch->SearchValue2 = @$filter["y_sk_alam_perasaan"];
        $this->sk_alam_perasaan->AdvancedSearch->SearchOperator2 = @$filter["w_sk_alam_perasaan"];
        $this->sk_alam_perasaan->AdvancedSearch->save();

        // Field sk_pembicaraan
        $this->sk_pembicaraan->AdvancedSearch->SearchValue = @$filter["x_sk_pembicaraan"];
        $this->sk_pembicaraan->AdvancedSearch->SearchOperator = @$filter["z_sk_pembicaraan"];
        $this->sk_pembicaraan->AdvancedSearch->SearchCondition = @$filter["v_sk_pembicaraan"];
        $this->sk_pembicaraan->AdvancedSearch->SearchValue2 = @$filter["y_sk_pembicaraan"];
        $this->sk_pembicaraan->AdvancedSearch->SearchOperator2 = @$filter["w_sk_pembicaraan"];
        $this->sk_pembicaraan->AdvancedSearch->save();

        // Field sk_afek
        $this->sk_afek->AdvancedSearch->SearchValue = @$filter["x_sk_afek"];
        $this->sk_afek->AdvancedSearch->SearchOperator = @$filter["z_sk_afek"];
        $this->sk_afek->AdvancedSearch->SearchCondition = @$filter["v_sk_afek"];
        $this->sk_afek->AdvancedSearch->SearchValue2 = @$filter["y_sk_afek"];
        $this->sk_afek->AdvancedSearch->SearchOperator2 = @$filter["w_sk_afek"];
        $this->sk_afek->AdvancedSearch->save();

        // Field sk_aktifitas_motorik
        $this->sk_aktifitas_motorik->AdvancedSearch->SearchValue = @$filter["x_sk_aktifitas_motorik"];
        $this->sk_aktifitas_motorik->AdvancedSearch->SearchOperator = @$filter["z_sk_aktifitas_motorik"];
        $this->sk_aktifitas_motorik->AdvancedSearch->SearchCondition = @$filter["v_sk_aktifitas_motorik"];
        $this->sk_aktifitas_motorik->AdvancedSearch->SearchValue2 = @$filter["y_sk_aktifitas_motorik"];
        $this->sk_aktifitas_motorik->AdvancedSearch->SearchOperator2 = @$filter["w_sk_aktifitas_motorik"];
        $this->sk_aktifitas_motorik->AdvancedSearch->save();

        // Field sk_gangguan_ringan
        $this->sk_gangguan_ringan->AdvancedSearch->SearchValue = @$filter["x_sk_gangguan_ringan"];
        $this->sk_gangguan_ringan->AdvancedSearch->SearchOperator = @$filter["z_sk_gangguan_ringan"];
        $this->sk_gangguan_ringan->AdvancedSearch->SearchCondition = @$filter["v_sk_gangguan_ringan"];
        $this->sk_gangguan_ringan->AdvancedSearch->SearchValue2 = @$filter["y_sk_gangguan_ringan"];
        $this->sk_gangguan_ringan->AdvancedSearch->SearchOperator2 = @$filter["w_sk_gangguan_ringan"];
        $this->sk_gangguan_ringan->AdvancedSearch->save();

        // Field sk_proses_pikir
        $this->sk_proses_pikir->AdvancedSearch->SearchValue = @$filter["x_sk_proses_pikir"];
        $this->sk_proses_pikir->AdvancedSearch->SearchOperator = @$filter["z_sk_proses_pikir"];
        $this->sk_proses_pikir->AdvancedSearch->SearchCondition = @$filter["v_sk_proses_pikir"];
        $this->sk_proses_pikir->AdvancedSearch->SearchValue2 = @$filter["y_sk_proses_pikir"];
        $this->sk_proses_pikir->AdvancedSearch->SearchOperator2 = @$filter["w_sk_proses_pikir"];
        $this->sk_proses_pikir->AdvancedSearch->save();

        // Field sk_orientasi
        $this->sk_orientasi->AdvancedSearch->SearchValue = @$filter["x_sk_orientasi"];
        $this->sk_orientasi->AdvancedSearch->SearchOperator = @$filter["z_sk_orientasi"];
        $this->sk_orientasi->AdvancedSearch->SearchCondition = @$filter["v_sk_orientasi"];
        $this->sk_orientasi->AdvancedSearch->SearchValue2 = @$filter["y_sk_orientasi"];
        $this->sk_orientasi->AdvancedSearch->SearchOperator2 = @$filter["w_sk_orientasi"];
        $this->sk_orientasi->AdvancedSearch->save();

        // Field sk_tingkat_kesadaran_orientasi
        $this->sk_tingkat_kesadaran_orientasi->AdvancedSearch->SearchValue = @$filter["x_sk_tingkat_kesadaran_orientasi"];
        $this->sk_tingkat_kesadaran_orientasi->AdvancedSearch->SearchOperator = @$filter["z_sk_tingkat_kesadaran_orientasi"];
        $this->sk_tingkat_kesadaran_orientasi->AdvancedSearch->SearchCondition = @$filter["v_sk_tingkat_kesadaran_orientasi"];
        $this->sk_tingkat_kesadaran_orientasi->AdvancedSearch->SearchValue2 = @$filter["y_sk_tingkat_kesadaran_orientasi"];
        $this->sk_tingkat_kesadaran_orientasi->AdvancedSearch->SearchOperator2 = @$filter["w_sk_tingkat_kesadaran_orientasi"];
        $this->sk_tingkat_kesadaran_orientasi->AdvancedSearch->save();

        // Field sk_memori
        $this->sk_memori->AdvancedSearch->SearchValue = @$filter["x_sk_memori"];
        $this->sk_memori->AdvancedSearch->SearchOperator = @$filter["z_sk_memori"];
        $this->sk_memori->AdvancedSearch->SearchCondition = @$filter["v_sk_memori"];
        $this->sk_memori->AdvancedSearch->SearchValue2 = @$filter["y_sk_memori"];
        $this->sk_memori->AdvancedSearch->SearchOperator2 = @$filter["w_sk_memori"];
        $this->sk_memori->AdvancedSearch->save();

        // Field sk_interaksi
        $this->sk_interaksi->AdvancedSearch->SearchValue = @$filter["x_sk_interaksi"];
        $this->sk_interaksi->AdvancedSearch->SearchOperator = @$filter["z_sk_interaksi"];
        $this->sk_interaksi->AdvancedSearch->SearchCondition = @$filter["v_sk_interaksi"];
        $this->sk_interaksi->AdvancedSearch->SearchValue2 = @$filter["y_sk_interaksi"];
        $this->sk_interaksi->AdvancedSearch->SearchOperator2 = @$filter["w_sk_interaksi"];
        $this->sk_interaksi->AdvancedSearch->save();

        // Field sk_konsentrasi
        $this->sk_konsentrasi->AdvancedSearch->SearchValue = @$filter["x_sk_konsentrasi"];
        $this->sk_konsentrasi->AdvancedSearch->SearchOperator = @$filter["z_sk_konsentrasi"];
        $this->sk_konsentrasi->AdvancedSearch->SearchCondition = @$filter["v_sk_konsentrasi"];
        $this->sk_konsentrasi->AdvancedSearch->SearchValue2 = @$filter["y_sk_konsentrasi"];
        $this->sk_konsentrasi->AdvancedSearch->SearchOperator2 = @$filter["w_sk_konsentrasi"];
        $this->sk_konsentrasi->AdvancedSearch->save();

        // Field sk_persepsi
        $this->sk_persepsi->AdvancedSearch->SearchValue = @$filter["x_sk_persepsi"];
        $this->sk_persepsi->AdvancedSearch->SearchOperator = @$filter["z_sk_persepsi"];
        $this->sk_persepsi->AdvancedSearch->SearchCondition = @$filter["v_sk_persepsi"];
        $this->sk_persepsi->AdvancedSearch->SearchValue2 = @$filter["y_sk_persepsi"];
        $this->sk_persepsi->AdvancedSearch->SearchOperator2 = @$filter["w_sk_persepsi"];
        $this->sk_persepsi->AdvancedSearch->save();

        // Field ket_sk_persepsi
        $this->ket_sk_persepsi->AdvancedSearch->SearchValue = @$filter["x_ket_sk_persepsi"];
        $this->ket_sk_persepsi->AdvancedSearch->SearchOperator = @$filter["z_ket_sk_persepsi"];
        $this->ket_sk_persepsi->AdvancedSearch->SearchCondition = @$filter["v_ket_sk_persepsi"];
        $this->ket_sk_persepsi->AdvancedSearch->SearchValue2 = @$filter["y_ket_sk_persepsi"];
        $this->ket_sk_persepsi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_sk_persepsi"];
        $this->ket_sk_persepsi->AdvancedSearch->save();

        // Field sk_isi_pikir
        $this->sk_isi_pikir->AdvancedSearch->SearchValue = @$filter["x_sk_isi_pikir"];
        $this->sk_isi_pikir->AdvancedSearch->SearchOperator = @$filter["z_sk_isi_pikir"];
        $this->sk_isi_pikir->AdvancedSearch->SearchCondition = @$filter["v_sk_isi_pikir"];
        $this->sk_isi_pikir->AdvancedSearch->SearchValue2 = @$filter["y_sk_isi_pikir"];
        $this->sk_isi_pikir->AdvancedSearch->SearchOperator2 = @$filter["w_sk_isi_pikir"];
        $this->sk_isi_pikir->AdvancedSearch->save();

        // Field sk_waham
        $this->sk_waham->AdvancedSearch->SearchValue = @$filter["x_sk_waham"];
        $this->sk_waham->AdvancedSearch->SearchOperator = @$filter["z_sk_waham"];
        $this->sk_waham->AdvancedSearch->SearchCondition = @$filter["v_sk_waham"];
        $this->sk_waham->AdvancedSearch->SearchValue2 = @$filter["y_sk_waham"];
        $this->sk_waham->AdvancedSearch->SearchOperator2 = @$filter["w_sk_waham"];
        $this->sk_waham->AdvancedSearch->save();

        // Field ket_sk_waham
        $this->ket_sk_waham->AdvancedSearch->SearchValue = @$filter["x_ket_sk_waham"];
        $this->ket_sk_waham->AdvancedSearch->SearchOperator = @$filter["z_ket_sk_waham"];
        $this->ket_sk_waham->AdvancedSearch->SearchCondition = @$filter["v_ket_sk_waham"];
        $this->ket_sk_waham->AdvancedSearch->SearchValue2 = @$filter["y_ket_sk_waham"];
        $this->ket_sk_waham->AdvancedSearch->SearchOperator2 = @$filter["w_ket_sk_waham"];
        $this->ket_sk_waham->AdvancedSearch->save();

        // Field sk_daya_tilik_diri
        $this->sk_daya_tilik_diri->AdvancedSearch->SearchValue = @$filter["x_sk_daya_tilik_diri"];
        $this->sk_daya_tilik_diri->AdvancedSearch->SearchOperator = @$filter["z_sk_daya_tilik_diri"];
        $this->sk_daya_tilik_diri->AdvancedSearch->SearchCondition = @$filter["v_sk_daya_tilik_diri"];
        $this->sk_daya_tilik_diri->AdvancedSearch->SearchValue2 = @$filter["y_sk_daya_tilik_diri"];
        $this->sk_daya_tilik_diri->AdvancedSearch->SearchOperator2 = @$filter["w_sk_daya_tilik_diri"];
        $this->sk_daya_tilik_diri->AdvancedSearch->save();

        // Field ket_sk_daya_tilik_diri
        $this->ket_sk_daya_tilik_diri->AdvancedSearch->SearchValue = @$filter["x_ket_sk_daya_tilik_diri"];
        $this->ket_sk_daya_tilik_diri->AdvancedSearch->SearchOperator = @$filter["z_ket_sk_daya_tilik_diri"];
        $this->ket_sk_daya_tilik_diri->AdvancedSearch->SearchCondition = @$filter["v_ket_sk_daya_tilik_diri"];
        $this->ket_sk_daya_tilik_diri->AdvancedSearch->SearchValue2 = @$filter["y_ket_sk_daya_tilik_diri"];
        $this->ket_sk_daya_tilik_diri->AdvancedSearch->SearchOperator2 = @$filter["w_ket_sk_daya_tilik_diri"];
        $this->ket_sk_daya_tilik_diri->AdvancedSearch->save();

        // Field kk_pembelajaran
        $this->kk_pembelajaran->AdvancedSearch->SearchValue = @$filter["x_kk_pembelajaran"];
        $this->kk_pembelajaran->AdvancedSearch->SearchOperator = @$filter["z_kk_pembelajaran"];
        $this->kk_pembelajaran->AdvancedSearch->SearchCondition = @$filter["v_kk_pembelajaran"];
        $this->kk_pembelajaran->AdvancedSearch->SearchValue2 = @$filter["y_kk_pembelajaran"];
        $this->kk_pembelajaran->AdvancedSearch->SearchOperator2 = @$filter["w_kk_pembelajaran"];
        $this->kk_pembelajaran->AdvancedSearch->save();

        // Field ket_kk_pembelajaran
        $this->ket_kk_pembelajaran->AdvancedSearch->SearchValue = @$filter["x_ket_kk_pembelajaran"];
        $this->ket_kk_pembelajaran->AdvancedSearch->SearchOperator = @$filter["z_ket_kk_pembelajaran"];
        $this->ket_kk_pembelajaran->AdvancedSearch->SearchCondition = @$filter["v_ket_kk_pembelajaran"];
        $this->ket_kk_pembelajaran->AdvancedSearch->SearchValue2 = @$filter["y_ket_kk_pembelajaran"];
        $this->ket_kk_pembelajaran->AdvancedSearch->SearchOperator2 = @$filter["w_ket_kk_pembelajaran"];
        $this->ket_kk_pembelajaran->AdvancedSearch->save();

        // Field ket_kk_pembelajaran_lainnya
        $this->ket_kk_pembelajaran_lainnya->AdvancedSearch->SearchValue = @$filter["x_ket_kk_pembelajaran_lainnya"];
        $this->ket_kk_pembelajaran_lainnya->AdvancedSearch->SearchOperator = @$filter["z_ket_kk_pembelajaran_lainnya"];
        $this->ket_kk_pembelajaran_lainnya->AdvancedSearch->SearchCondition = @$filter["v_ket_kk_pembelajaran_lainnya"];
        $this->ket_kk_pembelajaran_lainnya->AdvancedSearch->SearchValue2 = @$filter["y_ket_kk_pembelajaran_lainnya"];
        $this->ket_kk_pembelajaran_lainnya->AdvancedSearch->SearchOperator2 = @$filter["w_ket_kk_pembelajaran_lainnya"];
        $this->ket_kk_pembelajaran_lainnya->AdvancedSearch->save();

        // Field kk_Penerjamah
        $this->kk_Penerjamah->AdvancedSearch->SearchValue = @$filter["x_kk_Penerjamah"];
        $this->kk_Penerjamah->AdvancedSearch->SearchOperator = @$filter["z_kk_Penerjamah"];
        $this->kk_Penerjamah->AdvancedSearch->SearchCondition = @$filter["v_kk_Penerjamah"];
        $this->kk_Penerjamah->AdvancedSearch->SearchValue2 = @$filter["y_kk_Penerjamah"];
        $this->kk_Penerjamah->AdvancedSearch->SearchOperator2 = @$filter["w_kk_Penerjamah"];
        $this->kk_Penerjamah->AdvancedSearch->save();

        // Field ket_kk_penerjamah_Lainnya
        $this->ket_kk_penerjamah_Lainnya->AdvancedSearch->SearchValue = @$filter["x_ket_kk_penerjamah_Lainnya"];
        $this->ket_kk_penerjamah_Lainnya->AdvancedSearch->SearchOperator = @$filter["z_ket_kk_penerjamah_Lainnya"];
        $this->ket_kk_penerjamah_Lainnya->AdvancedSearch->SearchCondition = @$filter["v_ket_kk_penerjamah_Lainnya"];
        $this->ket_kk_penerjamah_Lainnya->AdvancedSearch->SearchValue2 = @$filter["y_ket_kk_penerjamah_Lainnya"];
        $this->ket_kk_penerjamah_Lainnya->AdvancedSearch->SearchOperator2 = @$filter["w_ket_kk_penerjamah_Lainnya"];
        $this->ket_kk_penerjamah_Lainnya->AdvancedSearch->save();

        // Field kk_bahasa_isyarat
        $this->kk_bahasa_isyarat->AdvancedSearch->SearchValue = @$filter["x_kk_bahasa_isyarat"];
        $this->kk_bahasa_isyarat->AdvancedSearch->SearchOperator = @$filter["z_kk_bahasa_isyarat"];
        $this->kk_bahasa_isyarat->AdvancedSearch->SearchCondition = @$filter["v_kk_bahasa_isyarat"];
        $this->kk_bahasa_isyarat->AdvancedSearch->SearchValue2 = @$filter["y_kk_bahasa_isyarat"];
        $this->kk_bahasa_isyarat->AdvancedSearch->SearchOperator2 = @$filter["w_kk_bahasa_isyarat"];
        $this->kk_bahasa_isyarat->AdvancedSearch->save();

        // Field kk_kebutuhan_edukasi
        $this->kk_kebutuhan_edukasi->AdvancedSearch->SearchValue = @$filter["x_kk_kebutuhan_edukasi"];
        $this->kk_kebutuhan_edukasi->AdvancedSearch->SearchOperator = @$filter["z_kk_kebutuhan_edukasi"];
        $this->kk_kebutuhan_edukasi->AdvancedSearch->SearchCondition = @$filter["v_kk_kebutuhan_edukasi"];
        $this->kk_kebutuhan_edukasi->AdvancedSearch->SearchValue2 = @$filter["y_kk_kebutuhan_edukasi"];
        $this->kk_kebutuhan_edukasi->AdvancedSearch->SearchOperator2 = @$filter["w_kk_kebutuhan_edukasi"];
        $this->kk_kebutuhan_edukasi->AdvancedSearch->save();

        // Field ket_kk_kebutuhan_edukasi
        $this->ket_kk_kebutuhan_edukasi->AdvancedSearch->SearchValue = @$filter["x_ket_kk_kebutuhan_edukasi"];
        $this->ket_kk_kebutuhan_edukasi->AdvancedSearch->SearchOperator = @$filter["z_ket_kk_kebutuhan_edukasi"];
        $this->ket_kk_kebutuhan_edukasi->AdvancedSearch->SearchCondition = @$filter["v_ket_kk_kebutuhan_edukasi"];
        $this->ket_kk_kebutuhan_edukasi->AdvancedSearch->SearchValue2 = @$filter["y_ket_kk_kebutuhan_edukasi"];
        $this->ket_kk_kebutuhan_edukasi->AdvancedSearch->SearchOperator2 = @$filter["w_ket_kk_kebutuhan_edukasi"];
        $this->ket_kk_kebutuhan_edukasi->AdvancedSearch->save();

        // Field rencana
        $this->rencana->AdvancedSearch->SearchValue = @$filter["x_rencana"];
        $this->rencana->AdvancedSearch->SearchOperator = @$filter["z_rencana"];
        $this->rencana->AdvancedSearch->SearchCondition = @$filter["v_rencana"];
        $this->rencana->AdvancedSearch->SearchValue2 = @$filter["y_rencana"];
        $this->rencana->AdvancedSearch->SearchOperator2 = @$filter["w_rencana"];
        $this->rencana->AdvancedSearch->save();

        // Field nip
        $this->nip->AdvancedSearch->SearchValue = @$filter["x_nip"];
        $this->nip->AdvancedSearch->SearchOperator = @$filter["z_nip"];
        $this->nip->AdvancedSearch->SearchCondition = @$filter["v_nip"];
        $this->nip->AdvancedSearch->SearchValue2 = @$filter["y_nip"];
        $this->nip->AdvancedSearch->SearchOperator2 = @$filter["w_nip"];
        $this->nip->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->no_rawat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->keluhan_utama, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rkd_sakit_sejak, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rkd_keluhan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_putus_obat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_masalah_ekonomi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_masalah_fisik, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_masalah_psikososial, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rh_keluarga, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rbd_ide, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rbd_rencana, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rbd_alat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rbd_percobaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rbd_keinginan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rpo_penggunaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rpo_efek_samping, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_rpo_napza, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_lama_pemakaian, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_cara_pemakaian, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_latar_belakang_pemakaian, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_penggunaan_obat_lainnya, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_alasan_penggunaan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_alergi_obat, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_merokok, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_minum_kopi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->td, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nadi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->gcs, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rr, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->suhu, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_keluhan_fisik, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->durasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_provokes, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_quality, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->lokasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_dokter, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_nyeri, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->bb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->tb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->bmi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_lapor_status_nutrisi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_lapor, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_adl_hobi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_adl_sosialisasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_adl_kegiatan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_sk_persepsi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_sk_waham, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_sk_daya_tilik_diri, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_kk_pembelajaran_lainnya, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_kk_penerjamah_Lainnya, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ket_kk_kebutuhan_edukasi, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->rencana, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nip, $arKeywords, $type);
        return $where;
    }

    // Build basic search SQL
    protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
    {
        $defCond = ($type == "OR") ? "OR" : "AND";
        $arSql = []; // Array for SQL parts
        $arCond = []; // Array for search conditions
        $cnt = count($arKeywords);
        $j = 0; // Number of SQL parts
        for ($i = 0; $i < $cnt; $i++) {
            $keyword = $arKeywords[$i];
            $keyword = trim($keyword);
            if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
                $keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
                $ar = explode("\\", $keyword);
            } else {
                $ar = [$keyword];
            }
            foreach ($ar as $keyword) {
                if ($keyword != "") {
                    $wrk = "";
                    if ($keyword == "OR" && $type == "") {
                        if ($j > 0) {
                            $arCond[$j - 1] = "OR";
                        }
                    } elseif ($keyword == Config("NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NULL";
                    } elseif ($keyword == Config("NOT_NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NOT NULL";
                    } elseif ($fld->IsVirtual && $fld->Visible) {
                        $wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    } elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
                        $wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    }
                    if ($wrk != "") {
                        $arSql[$j] = $wrk;
                        $arCond[$j] = $defCond;
                        $j += 1;
                    }
                }
            }
        }
        $cnt = count($arSql);
        $quoted = false;
        $sql = "";
        if ($cnt > 0) {
            for ($i = 0; $i < $cnt - 1; $i++) {
                if ($arCond[$i] == "OR") {
                    if (!$quoted) {
                        $sql .= "(";
                    }
                    $quoted = true;
                }
                $sql .= $arSql[$i];
                if ($quoted && $arCond[$i] != "OR") {
                    $sql .= ")";
                    $quoted = false;
                }
                $sql .= " " . $arCond[$i] . " ";
            }
            $sql .= $arSql[$cnt - 1];
            if ($quoted) {
                $sql .= ")";
            }
        }
        if ($sql != "") {
            if ($where != "") {
                $where .= " OR ";
            }
            $where .= "(" . $sql . ")";
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            // Search keyword in any fields
            if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
                foreach ($ar as $keyword) {
                    if ($keyword != "") {
                        if ($searchStr != "") {
                            $searchStr .= " " . $searchType . " ";
                        }
                        $searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
                    }
                }
            } else {
                $searchStr = $this->basicSearchSql($ar, $searchType);
            }
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->no_rawat); // no_rawat
            $this->updateSort($this->tanggal); // tanggal
            $this->updateSort($this->informasi); // informasi
            $this->updateSort($this->rkd_sakit_sejak); // rkd_sakit_sejak
            $this->updateSort($this->rkd_berobat); // rkd_berobat
            $this->updateSort($this->rkd_hasil_pengobatan); // rkd_hasil_pengobatan
            $this->updateSort($this->fp_putus_obat); // fp_putus_obat
            $this->updateSort($this->ket_putus_obat); // ket_putus_obat
            $this->updateSort($this->fp_ekonomi); // fp_ekonomi
            $this->updateSort($this->ket_masalah_ekonomi); // ket_masalah_ekonomi
            $this->updateSort($this->fp_masalah_fisik); // fp_masalah_fisik
            $this->updateSort($this->ket_masalah_fisik); // ket_masalah_fisik
            $this->updateSort($this->fp_masalah_psikososial); // fp_masalah_psikososial
            $this->updateSort($this->ket_masalah_psikososial); // ket_masalah_psikososial
            $this->updateSort($this->rh_keluarga); // rh_keluarga
            $this->updateSort($this->ket_rh_keluarga); // ket_rh_keluarga
            $this->updateSort($this->resiko_bunuh_diri); // resiko_bunuh_diri
            $this->updateSort($this->rbd_ide); // rbd_ide
            $this->updateSort($this->ket_rbd_ide); // ket_rbd_ide
            $this->updateSort($this->rbd_rencana); // rbd_rencana
            $this->updateSort($this->ket_rbd_rencana); // ket_rbd_rencana
            $this->updateSort($this->rbd_alat); // rbd_alat
            $this->updateSort($this->ket_rbd_alat); // ket_rbd_alat
            $this->updateSort($this->rbd_percobaan); // rbd_percobaan
            $this->updateSort($this->ket_rbd_percobaan); // ket_rbd_percobaan
            $this->updateSort($this->rbd_keinginan); // rbd_keinginan
            $this->updateSort($this->ket_rbd_keinginan); // ket_rbd_keinginan
            $this->updateSort($this->rpo_penggunaan); // rpo_penggunaan
            $this->updateSort($this->ket_rpo_penggunaan); // ket_rpo_penggunaan
            $this->updateSort($this->rpo_efek_samping); // rpo_efek_samping
            $this->updateSort($this->ket_rpo_efek_samping); // ket_rpo_efek_samping
            $this->updateSort($this->rpo_napza); // rpo_napza
            $this->updateSort($this->ket_rpo_napza); // ket_rpo_napza
            $this->updateSort($this->ket_lama_pemakaian); // ket_lama_pemakaian
            $this->updateSort($this->ket_cara_pemakaian); // ket_cara_pemakaian
            $this->updateSort($this->ket_latar_belakang_pemakaian); // ket_latar_belakang_pemakaian
            $this->updateSort($this->rpo_penggunaan_obat_lainnya); // rpo_penggunaan_obat_lainnya
            $this->updateSort($this->ket_penggunaan_obat_lainnya); // ket_penggunaan_obat_lainnya
            $this->updateSort($this->ket_alasan_penggunaan); // ket_alasan_penggunaan
            $this->updateSort($this->rpo_alergi_obat); // rpo_alergi_obat
            $this->updateSort($this->ket_alergi_obat); // ket_alergi_obat
            $this->updateSort($this->rpo_merokok); // rpo_merokok
            $this->updateSort($this->ket_merokok); // ket_merokok
            $this->updateSort($this->rpo_minum_kopi); // rpo_minum_kopi
            $this->updateSort($this->ket_minum_kopi); // ket_minum_kopi
            $this->updateSort($this->td); // td
            $this->updateSort($this->nadi); // nadi
            $this->updateSort($this->gcs); // gcs
            $this->updateSort($this->rr); // rr
            $this->updateSort($this->suhu); // suhu
            $this->updateSort($this->pf_keluhan_fisik); // pf_keluhan_fisik
            $this->updateSort($this->ket_keluhan_fisik); // ket_keluhan_fisik
            $this->updateSort($this->skala_nyeri); // skala_nyeri
            $this->updateSort($this->durasi); // durasi
            $this->updateSort($this->nyeri); // nyeri
            $this->updateSort($this->provokes); // provokes
            $this->updateSort($this->ket_provokes); // ket_provokes
            $this->updateSort($this->quality); // quality
            $this->updateSort($this->ket_quality); // ket_quality
            $this->updateSort($this->lokasi); // lokasi
            $this->updateSort($this->menyebar); // menyebar
            $this->updateSort($this->pada_dokter); // pada_dokter
            $this->updateSort($this->ket_dokter); // ket_dokter
            $this->updateSort($this->nyeri_hilang); // nyeri_hilang
            $this->updateSort($this->ket_nyeri); // ket_nyeri
            $this->updateSort($this->bb); // bb
            $this->updateSort($this->tb); // tb
            $this->updateSort($this->bmi); // bmi
            $this->updateSort($this->lapor_status_nutrisi); // lapor_status_nutrisi
            $this->updateSort($this->ket_lapor_status_nutrisi); // ket_lapor_status_nutrisi
            $this->updateSort($this->sg1); // sg1
            $this->updateSort($this->nilai1); // nilai1
            $this->updateSort($this->sg2); // sg2
            $this->updateSort($this->nilai2); // nilai2
            $this->updateSort($this->total_hasil); // total_hasil
            $this->updateSort($this->resikojatuh); // resikojatuh
            $this->updateSort($this->bjm); // bjm
            $this->updateSort($this->msa); // msa
            $this->updateSort($this->hasil); // hasil
            $this->updateSort($this->lapor); // lapor
            $this->updateSort($this->ket_lapor); // ket_lapor
            $this->updateSort($this->adl_mandi); // adl_mandi
            $this->updateSort($this->adl_berpakaian); // adl_berpakaian
            $this->updateSort($this->adl_makan); // adl_makan
            $this->updateSort($this->adl_bak); // adl_bak
            $this->updateSort($this->adl_bab); // adl_bab
            $this->updateSort($this->adl_hobi); // adl_hobi
            $this->updateSort($this->ket_adl_hobi); // ket_adl_hobi
            $this->updateSort($this->adl_sosialisasi); // adl_sosialisasi
            $this->updateSort($this->ket_adl_sosialisasi); // ket_adl_sosialisasi
            $this->updateSort($this->adl_kegiatan); // adl_kegiatan
            $this->updateSort($this->ket_adl_kegiatan); // ket_adl_kegiatan
            $this->updateSort($this->sk_penampilan); // sk_penampilan
            $this->updateSort($this->sk_alam_perasaan); // sk_alam_perasaan
            $this->updateSort($this->sk_pembicaraan); // sk_pembicaraan
            $this->updateSort($this->sk_afek); // sk_afek
            $this->updateSort($this->sk_aktifitas_motorik); // sk_aktifitas_motorik
            $this->updateSort($this->sk_gangguan_ringan); // sk_gangguan_ringan
            $this->updateSort($this->sk_proses_pikir); // sk_proses_pikir
            $this->updateSort($this->sk_orientasi); // sk_orientasi
            $this->updateSort($this->sk_tingkat_kesadaran_orientasi); // sk_tingkat_kesadaran_orientasi
            $this->updateSort($this->sk_memori); // sk_memori
            $this->updateSort($this->sk_interaksi); // sk_interaksi
            $this->updateSort($this->sk_konsentrasi); // sk_konsentrasi
            $this->updateSort($this->sk_persepsi); // sk_persepsi
            $this->updateSort($this->ket_sk_persepsi); // ket_sk_persepsi
            $this->updateSort($this->sk_isi_pikir); // sk_isi_pikir
            $this->updateSort($this->sk_waham); // sk_waham
            $this->updateSort($this->ket_sk_waham); // ket_sk_waham
            $this->updateSort($this->sk_daya_tilik_diri); // sk_daya_tilik_diri
            $this->updateSort($this->ket_sk_daya_tilik_diri); // ket_sk_daya_tilik_diri
            $this->updateSort($this->kk_pembelajaran); // kk_pembelajaran
            $this->updateSort($this->ket_kk_pembelajaran); // ket_kk_pembelajaran
            $this->updateSort($this->ket_kk_pembelajaran_lainnya); // ket_kk_pembelajaran_lainnya
            $this->updateSort($this->kk_Penerjamah); // kk_Penerjamah
            $this->updateSort($this->ket_kk_penerjamah_Lainnya); // ket_kk_penerjamah_Lainnya
            $this->updateSort($this->kk_bahasa_isyarat); // kk_bahasa_isyarat
            $this->updateSort($this->kk_kebutuhan_edukasi); // kk_kebutuhan_edukasi
            $this->updateSort($this->ket_kk_kebutuhan_edukasi); // ket_kk_kebutuhan_edukasi
            $this->updateSort($this->rencana); // rencana
            $this->updateSort($this->nip); // nip
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
            }
        }
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset master/detail keys
            if ($this->Command == "resetall") {
                $this->setCurrentMasterTable(""); // Clear master table
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
                        $this->no_rawat->setSessionValue("");
                        $this->no_rawat->setSessionValue("");
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setSort("");
                $this->no_rawat->setSort("");
                $this->tanggal->setSort("");
                $this->informasi->setSort("");
                $this->keluhan_utama->setSort("");
                $this->rkd_sakit_sejak->setSort("");
                $this->rkd_keluhan->setSort("");
                $this->rkd_berobat->setSort("");
                $this->rkd_hasil_pengobatan->setSort("");
                $this->fp_putus_obat->setSort("");
                $this->ket_putus_obat->setSort("");
                $this->fp_ekonomi->setSort("");
                $this->ket_masalah_ekonomi->setSort("");
                $this->fp_masalah_fisik->setSort("");
                $this->ket_masalah_fisik->setSort("");
                $this->fp_masalah_psikososial->setSort("");
                $this->ket_masalah_psikososial->setSort("");
                $this->rh_keluarga->setSort("");
                $this->ket_rh_keluarga->setSort("");
                $this->resiko_bunuh_diri->setSort("");
                $this->rbd_ide->setSort("");
                $this->ket_rbd_ide->setSort("");
                $this->rbd_rencana->setSort("");
                $this->ket_rbd_rencana->setSort("");
                $this->rbd_alat->setSort("");
                $this->ket_rbd_alat->setSort("");
                $this->rbd_percobaan->setSort("");
                $this->ket_rbd_percobaan->setSort("");
                $this->rbd_keinginan->setSort("");
                $this->ket_rbd_keinginan->setSort("");
                $this->rpo_penggunaan->setSort("");
                $this->ket_rpo_penggunaan->setSort("");
                $this->rpo_efek_samping->setSort("");
                $this->ket_rpo_efek_samping->setSort("");
                $this->rpo_napza->setSort("");
                $this->ket_rpo_napza->setSort("");
                $this->ket_lama_pemakaian->setSort("");
                $this->ket_cara_pemakaian->setSort("");
                $this->ket_latar_belakang_pemakaian->setSort("");
                $this->rpo_penggunaan_obat_lainnya->setSort("");
                $this->ket_penggunaan_obat_lainnya->setSort("");
                $this->ket_alasan_penggunaan->setSort("");
                $this->rpo_alergi_obat->setSort("");
                $this->ket_alergi_obat->setSort("");
                $this->rpo_merokok->setSort("");
                $this->ket_merokok->setSort("");
                $this->rpo_minum_kopi->setSort("");
                $this->ket_minum_kopi->setSort("");
                $this->td->setSort("");
                $this->nadi->setSort("");
                $this->gcs->setSort("");
                $this->rr->setSort("");
                $this->suhu->setSort("");
                $this->pf_keluhan_fisik->setSort("");
                $this->ket_keluhan_fisik->setSort("");
                $this->skala_nyeri->setSort("");
                $this->durasi->setSort("");
                $this->nyeri->setSort("");
                $this->provokes->setSort("");
                $this->ket_provokes->setSort("");
                $this->quality->setSort("");
                $this->ket_quality->setSort("");
                $this->lokasi->setSort("");
                $this->menyebar->setSort("");
                $this->pada_dokter->setSort("");
                $this->ket_dokter->setSort("");
                $this->nyeri_hilang->setSort("");
                $this->ket_nyeri->setSort("");
                $this->bb->setSort("");
                $this->tb->setSort("");
                $this->bmi->setSort("");
                $this->lapor_status_nutrisi->setSort("");
                $this->ket_lapor_status_nutrisi->setSort("");
                $this->sg1->setSort("");
                $this->nilai1->setSort("");
                $this->sg2->setSort("");
                $this->nilai2->setSort("");
                $this->total_hasil->setSort("");
                $this->resikojatuh->setSort("");
                $this->bjm->setSort("");
                $this->msa->setSort("");
                $this->hasil->setSort("");
                $this->lapor->setSort("");
                $this->ket_lapor->setSort("");
                $this->adl_mandi->setSort("");
                $this->adl_berpakaian->setSort("");
                $this->adl_makan->setSort("");
                $this->adl_bak->setSort("");
                $this->adl_bab->setSort("");
                $this->adl_hobi->setSort("");
                $this->ket_adl_hobi->setSort("");
                $this->adl_sosialisasi->setSort("");
                $this->ket_adl_sosialisasi->setSort("");
                $this->adl_kegiatan->setSort("");
                $this->ket_adl_kegiatan->setSort("");
                $this->sk_penampilan->setSort("");
                $this->sk_alam_perasaan->setSort("");
                $this->sk_pembicaraan->setSort("");
                $this->sk_afek->setSort("");
                $this->sk_aktifitas_motorik->setSort("");
                $this->sk_gangguan_ringan->setSort("");
                $this->sk_proses_pikir->setSort("");
                $this->sk_orientasi->setSort("");
                $this->sk_tingkat_kesadaran_orientasi->setSort("");
                $this->sk_memori->setSort("");
                $this->sk_interaksi->setSort("");
                $this->sk_konsentrasi->setSort("");
                $this->sk_persepsi->setSort("");
                $this->ket_sk_persepsi->setSort("");
                $this->sk_isi_pikir->setSort("");
                $this->sk_waham->setSort("");
                $this->ket_sk_waham->setSort("");
                $this->sk_daya_tilik_diri->setSort("");
                $this->ket_sk_daya_tilik_diri->setSort("");
                $this->kk_pembelajaran->setSort("");
                $this->ket_kk_pembelajaran->setSort("");
                $this->ket_kk_pembelajaran_lainnya->setSort("");
                $this->kk_Penerjamah->setSort("");
                $this->ket_kk_penerjamah_Lainnya->setSort("");
                $this->kk_bahasa_isyarat->setSort("");
                $this->kk_kebutuhan_edukasi->setSort("");
                $this->ket_kk_kebutuhan_edukasi->setSort("");
                $this->rencana->setSort("");
                $this->nip->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item
        $item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
        $item->Body = "";
        $item->OnLeft = false;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = false;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = false;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = false;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = false;
        $item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl();
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                if (IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"penilaian_awal_keperawatan_ralan_psikiatri\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->ViewUrl)) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
                }
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                if (IsMobile()) {
                    $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
                } else {
                    $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"penilaian_awal_keperawatan_ralan_psikiatri\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("EditLink") . "</a>";
                }
            } else {
                $opt->Body = "";
            }
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
                    $action = $listaction->Action;
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a></li>";
                    if (count($links) == 1) { // Single button
                        $body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a>";
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
                $opt->Visible = true;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        if (IsMobile()) {
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"penilaian_awal_keperawatan_ralan_psikiatri\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("AddLink") . "</a>";
        }
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["action"];

        // Set up options default
        foreach ($options as $option) {
            $option->UseDropDownButton = false;
            $option->UseButtonGroup = true;
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->add($option->GroupOptionName);
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fpenilaian_awal_keperawatan_ralan_psikiatrilist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn, \PDO::FETCH_ASSOC);
            $this->CurrentAction = $userAction;

            // Call row action event
            if ($rs) {
                $conn->beginTransaction();
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    $conn->commit(); // Commit the changes
                    if ($this->getSuccessMessage() == "" && !ob_get_length()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    $conn->rollback(); // Rollback changes

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            $this->CurrentAction = ""; // Clear action
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
        // Hide detail items for dropdown if necessary
        $this->ListOptions->hideDetailItemsForDropDown();
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
        global $Security, $Language;
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $stmt = $sql->execute();
        $rs = new Recordset($stmt, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
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
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setDbValue($row['id_penilaian_awal_keperawatan_ralan_psikiatri']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->tanggal->setDbValue($row['tanggal']);
        $this->informasi->setDbValue($row['informasi']);
        $this->keluhan_utama->setDbValue($row['keluhan_utama']);
        $this->rkd_sakit_sejak->setDbValue($row['rkd_sakit_sejak']);
        $this->rkd_keluhan->setDbValue($row['rkd_keluhan']);
        $this->rkd_berobat->setDbValue($row['rkd_berobat']);
        $this->rkd_hasil_pengobatan->setDbValue($row['rkd_hasil_pengobatan']);
        $this->fp_putus_obat->setDbValue($row['fp_putus_obat']);
        $this->ket_putus_obat->setDbValue($row['ket_putus_obat']);
        $this->fp_ekonomi->setDbValue($row['fp_ekonomi']);
        $this->ket_masalah_ekonomi->setDbValue($row['ket_masalah_ekonomi']);
        $this->fp_masalah_fisik->setDbValue($row['fp_masalah_fisik']);
        $this->ket_masalah_fisik->setDbValue($row['ket_masalah_fisik']);
        $this->fp_masalah_psikososial->setDbValue($row['fp_masalah_psikososial']);
        $this->ket_masalah_psikososial->setDbValue($row['ket_masalah_psikososial']);
        $this->rh_keluarga->setDbValue($row['rh_keluarga']);
        $this->ket_rh_keluarga->setDbValue($row['ket_rh_keluarga']);
        $this->resiko_bunuh_diri->setDbValue($row['resiko_bunuh_diri']);
        $this->rbd_ide->setDbValue($row['rbd_ide']);
        $this->ket_rbd_ide->setDbValue($row['ket_rbd_ide']);
        $this->rbd_rencana->setDbValue($row['rbd_rencana']);
        $this->ket_rbd_rencana->setDbValue($row['ket_rbd_rencana']);
        $this->rbd_alat->setDbValue($row['rbd_alat']);
        $this->ket_rbd_alat->setDbValue($row['ket_rbd_alat']);
        $this->rbd_percobaan->setDbValue($row['rbd_percobaan']);
        $this->ket_rbd_percobaan->setDbValue($row['ket_rbd_percobaan']);
        $this->rbd_keinginan->setDbValue($row['rbd_keinginan']);
        $this->ket_rbd_keinginan->setDbValue($row['ket_rbd_keinginan']);
        $this->rpo_penggunaan->setDbValue($row['rpo_penggunaan']);
        $this->ket_rpo_penggunaan->setDbValue($row['ket_rpo_penggunaan']);
        $this->rpo_efek_samping->setDbValue($row['rpo_efek_samping']);
        $this->ket_rpo_efek_samping->setDbValue($row['ket_rpo_efek_samping']);
        $this->rpo_napza->setDbValue($row['rpo_napza']);
        $this->ket_rpo_napza->setDbValue($row['ket_rpo_napza']);
        $this->ket_lama_pemakaian->setDbValue($row['ket_lama_pemakaian']);
        $this->ket_cara_pemakaian->setDbValue($row['ket_cara_pemakaian']);
        $this->ket_latar_belakang_pemakaian->setDbValue($row['ket_latar_belakang_pemakaian']);
        $this->rpo_penggunaan_obat_lainnya->setDbValue($row['rpo_penggunaan_obat_lainnya']);
        $this->ket_penggunaan_obat_lainnya->setDbValue($row['ket_penggunaan_obat_lainnya']);
        $this->ket_alasan_penggunaan->setDbValue($row['ket_alasan_penggunaan']);
        $this->rpo_alergi_obat->setDbValue($row['rpo_alergi_obat']);
        $this->ket_alergi_obat->setDbValue($row['ket_alergi_obat']);
        $this->rpo_merokok->setDbValue($row['rpo_merokok']);
        $this->ket_merokok->setDbValue($row['ket_merokok']);
        $this->rpo_minum_kopi->setDbValue($row['rpo_minum_kopi']);
        $this->ket_minum_kopi->setDbValue($row['ket_minum_kopi']);
        $this->td->setDbValue($row['td']);
        $this->nadi->setDbValue($row['nadi']);
        $this->gcs->setDbValue($row['gcs']);
        $this->rr->setDbValue($row['rr']);
        $this->suhu->setDbValue($row['suhu']);
        $this->pf_keluhan_fisik->setDbValue($row['pf_keluhan_fisik']);
        $this->ket_keluhan_fisik->setDbValue($row['ket_keluhan_fisik']);
        $this->skala_nyeri->setDbValue($row['skala_nyeri']);
        $this->durasi->setDbValue($row['durasi']);
        $this->nyeri->setDbValue($row['nyeri']);
        $this->provokes->setDbValue($row['provokes']);
        $this->ket_provokes->setDbValue($row['ket_provokes']);
        $this->quality->setDbValue($row['quality']);
        $this->ket_quality->setDbValue($row['ket_quality']);
        $this->lokasi->setDbValue($row['lokasi']);
        $this->menyebar->setDbValue($row['menyebar']);
        $this->pada_dokter->setDbValue($row['pada_dokter']);
        $this->ket_dokter->setDbValue($row['ket_dokter']);
        $this->nyeri_hilang->setDbValue($row['nyeri_hilang']);
        $this->ket_nyeri->setDbValue($row['ket_nyeri']);
        $this->bb->setDbValue($row['bb']);
        $this->tb->setDbValue($row['tb']);
        $this->bmi->setDbValue($row['bmi']);
        $this->lapor_status_nutrisi->setDbValue($row['lapor_status_nutrisi']);
        $this->ket_lapor_status_nutrisi->setDbValue($row['ket_lapor_status_nutrisi']);
        $this->sg1->setDbValue($row['sg1']);
        $this->nilai1->setDbValue($row['nilai1']);
        $this->sg2->setDbValue($row['sg2']);
        $this->nilai2->setDbValue($row['nilai2']);
        $this->total_hasil->setDbValue($row['total_hasil']);
        $this->resikojatuh->setDbValue($row['resikojatuh']);
        $this->bjm->setDbValue($row['bjm']);
        $this->msa->setDbValue($row['msa']);
        $this->hasil->setDbValue($row['hasil']);
        $this->lapor->setDbValue($row['lapor']);
        $this->ket_lapor->setDbValue($row['ket_lapor']);
        $this->adl_mandi->setDbValue($row['adl_mandi']);
        $this->adl_berpakaian->setDbValue($row['adl_berpakaian']);
        $this->adl_makan->setDbValue($row['adl_makan']);
        $this->adl_bak->setDbValue($row['adl_bak']);
        $this->adl_bab->setDbValue($row['adl_bab']);
        $this->adl_hobi->setDbValue($row['adl_hobi']);
        $this->ket_adl_hobi->setDbValue($row['ket_adl_hobi']);
        $this->adl_sosialisasi->setDbValue($row['adl_sosialisasi']);
        $this->ket_adl_sosialisasi->setDbValue($row['ket_adl_sosialisasi']);
        $this->adl_kegiatan->setDbValue($row['adl_kegiatan']);
        $this->ket_adl_kegiatan->setDbValue($row['ket_adl_kegiatan']);
        $this->sk_penampilan->setDbValue($row['sk_penampilan']);
        $this->sk_alam_perasaan->setDbValue($row['sk_alam_perasaan']);
        $this->sk_pembicaraan->setDbValue($row['sk_pembicaraan']);
        $this->sk_afek->setDbValue($row['sk_afek']);
        $this->sk_aktifitas_motorik->setDbValue($row['sk_aktifitas_motorik']);
        $this->sk_gangguan_ringan->setDbValue($row['sk_gangguan_ringan']);
        $this->sk_proses_pikir->setDbValue($row['sk_proses_pikir']);
        $this->sk_orientasi->setDbValue($row['sk_orientasi']);
        $this->sk_tingkat_kesadaran_orientasi->setDbValue($row['sk_tingkat_kesadaran_orientasi']);
        $this->sk_memori->setDbValue($row['sk_memori']);
        $this->sk_interaksi->setDbValue($row['sk_interaksi']);
        $this->sk_konsentrasi->setDbValue($row['sk_konsentrasi']);
        $this->sk_persepsi->setDbValue($row['sk_persepsi']);
        $this->ket_sk_persepsi->setDbValue($row['ket_sk_persepsi']);
        $this->sk_isi_pikir->setDbValue($row['sk_isi_pikir']);
        $this->sk_waham->setDbValue($row['sk_waham']);
        $this->ket_sk_waham->setDbValue($row['ket_sk_waham']);
        $this->sk_daya_tilik_diri->setDbValue($row['sk_daya_tilik_diri']);
        $this->ket_sk_daya_tilik_diri->setDbValue($row['ket_sk_daya_tilik_diri']);
        $this->kk_pembelajaran->setDbValue($row['kk_pembelajaran']);
        $this->ket_kk_pembelajaran->setDbValue($row['ket_kk_pembelajaran']);
        $this->ket_kk_pembelajaran_lainnya->setDbValue($row['ket_kk_pembelajaran_lainnya']);
        $this->kk_Penerjamah->setDbValue($row['kk_Penerjamah']);
        $this->ket_kk_penerjamah_Lainnya->setDbValue($row['ket_kk_penerjamah_Lainnya']);
        $this->kk_bahasa_isyarat->setDbValue($row['kk_bahasa_isyarat']);
        $this->kk_kebutuhan_edukasi->setDbValue($row['kk_kebutuhan_edukasi']);
        $this->ket_kk_kebutuhan_edukasi->setDbValue($row['ket_kk_kebutuhan_edukasi']);
        $this->rencana->setDbValue($row['rencana']);
        $this->nip->setDbValue($row['nip']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_penilaian_awal_keperawatan_ralan_psikiatri'] = null;
        $row['no_rawat'] = null;
        $row['tanggal'] = null;
        $row['informasi'] = null;
        $row['keluhan_utama'] = null;
        $row['rkd_sakit_sejak'] = null;
        $row['rkd_keluhan'] = null;
        $row['rkd_berobat'] = null;
        $row['rkd_hasil_pengobatan'] = null;
        $row['fp_putus_obat'] = null;
        $row['ket_putus_obat'] = null;
        $row['fp_ekonomi'] = null;
        $row['ket_masalah_ekonomi'] = null;
        $row['fp_masalah_fisik'] = null;
        $row['ket_masalah_fisik'] = null;
        $row['fp_masalah_psikososial'] = null;
        $row['ket_masalah_psikososial'] = null;
        $row['rh_keluarga'] = null;
        $row['ket_rh_keluarga'] = null;
        $row['resiko_bunuh_diri'] = null;
        $row['rbd_ide'] = null;
        $row['ket_rbd_ide'] = null;
        $row['rbd_rencana'] = null;
        $row['ket_rbd_rencana'] = null;
        $row['rbd_alat'] = null;
        $row['ket_rbd_alat'] = null;
        $row['rbd_percobaan'] = null;
        $row['ket_rbd_percobaan'] = null;
        $row['rbd_keinginan'] = null;
        $row['ket_rbd_keinginan'] = null;
        $row['rpo_penggunaan'] = null;
        $row['ket_rpo_penggunaan'] = null;
        $row['rpo_efek_samping'] = null;
        $row['ket_rpo_efek_samping'] = null;
        $row['rpo_napza'] = null;
        $row['ket_rpo_napza'] = null;
        $row['ket_lama_pemakaian'] = null;
        $row['ket_cara_pemakaian'] = null;
        $row['ket_latar_belakang_pemakaian'] = null;
        $row['rpo_penggunaan_obat_lainnya'] = null;
        $row['ket_penggunaan_obat_lainnya'] = null;
        $row['ket_alasan_penggunaan'] = null;
        $row['rpo_alergi_obat'] = null;
        $row['ket_alergi_obat'] = null;
        $row['rpo_merokok'] = null;
        $row['ket_merokok'] = null;
        $row['rpo_minum_kopi'] = null;
        $row['ket_minum_kopi'] = null;
        $row['td'] = null;
        $row['nadi'] = null;
        $row['gcs'] = null;
        $row['rr'] = null;
        $row['suhu'] = null;
        $row['pf_keluhan_fisik'] = null;
        $row['ket_keluhan_fisik'] = null;
        $row['skala_nyeri'] = null;
        $row['durasi'] = null;
        $row['nyeri'] = null;
        $row['provokes'] = null;
        $row['ket_provokes'] = null;
        $row['quality'] = null;
        $row['ket_quality'] = null;
        $row['lokasi'] = null;
        $row['menyebar'] = null;
        $row['pada_dokter'] = null;
        $row['ket_dokter'] = null;
        $row['nyeri_hilang'] = null;
        $row['ket_nyeri'] = null;
        $row['bb'] = null;
        $row['tb'] = null;
        $row['bmi'] = null;
        $row['lapor_status_nutrisi'] = null;
        $row['ket_lapor_status_nutrisi'] = null;
        $row['sg1'] = null;
        $row['nilai1'] = null;
        $row['sg2'] = null;
        $row['nilai2'] = null;
        $row['total_hasil'] = null;
        $row['resikojatuh'] = null;
        $row['bjm'] = null;
        $row['msa'] = null;
        $row['hasil'] = null;
        $row['lapor'] = null;
        $row['ket_lapor'] = null;
        $row['adl_mandi'] = null;
        $row['adl_berpakaian'] = null;
        $row['adl_makan'] = null;
        $row['adl_bak'] = null;
        $row['adl_bab'] = null;
        $row['adl_hobi'] = null;
        $row['ket_adl_hobi'] = null;
        $row['adl_sosialisasi'] = null;
        $row['ket_adl_sosialisasi'] = null;
        $row['adl_kegiatan'] = null;
        $row['ket_adl_kegiatan'] = null;
        $row['sk_penampilan'] = null;
        $row['sk_alam_perasaan'] = null;
        $row['sk_pembicaraan'] = null;
        $row['sk_afek'] = null;
        $row['sk_aktifitas_motorik'] = null;
        $row['sk_gangguan_ringan'] = null;
        $row['sk_proses_pikir'] = null;
        $row['sk_orientasi'] = null;
        $row['sk_tingkat_kesadaran_orientasi'] = null;
        $row['sk_memori'] = null;
        $row['sk_interaksi'] = null;
        $row['sk_konsentrasi'] = null;
        $row['sk_persepsi'] = null;
        $row['ket_sk_persepsi'] = null;
        $row['sk_isi_pikir'] = null;
        $row['sk_waham'] = null;
        $row['ket_sk_waham'] = null;
        $row['sk_daya_tilik_diri'] = null;
        $row['ket_sk_daya_tilik_diri'] = null;
        $row['kk_pembelajaran'] = null;
        $row['ket_kk_pembelajaran'] = null;
        $row['ket_kk_pembelajaran_lainnya'] = null;
        $row['kk_Penerjamah'] = null;
        $row['ket_kk_penerjamah_Lainnya'] = null;
        $row['kk_bahasa_isyarat'] = null;
        $row['kk_kebutuhan_edukasi'] = null;
        $row['ket_kk_kebutuhan_edukasi'] = null;
        $row['rencana'] = null;
        $row['nip'] = null;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id_penilaian_awal_keperawatan_ralan_psikiatri

        // no_rawat

        // tanggal

        // informasi

        // keluhan_utama

        // rkd_sakit_sejak

        // rkd_keluhan

        // rkd_berobat

        // rkd_hasil_pengobatan

        // fp_putus_obat

        // ket_putus_obat

        // fp_ekonomi

        // ket_masalah_ekonomi

        // fp_masalah_fisik

        // ket_masalah_fisik

        // fp_masalah_psikososial

        // ket_masalah_psikososial

        // rh_keluarga

        // ket_rh_keluarga

        // resiko_bunuh_diri

        // rbd_ide

        // ket_rbd_ide

        // rbd_rencana

        // ket_rbd_rencana

        // rbd_alat

        // ket_rbd_alat

        // rbd_percobaan

        // ket_rbd_percobaan

        // rbd_keinginan

        // ket_rbd_keinginan

        // rpo_penggunaan

        // ket_rpo_penggunaan

        // rpo_efek_samping

        // ket_rpo_efek_samping

        // rpo_napza

        // ket_rpo_napza

        // ket_lama_pemakaian

        // ket_cara_pemakaian

        // ket_latar_belakang_pemakaian

        // rpo_penggunaan_obat_lainnya

        // ket_penggunaan_obat_lainnya

        // ket_alasan_penggunaan

        // rpo_alergi_obat

        // ket_alergi_obat

        // rpo_merokok

        // ket_merokok

        // rpo_minum_kopi

        // ket_minum_kopi

        // td

        // nadi

        // gcs

        // rr

        // suhu

        // pf_keluhan_fisik

        // ket_keluhan_fisik

        // skala_nyeri

        // durasi

        // nyeri

        // provokes

        // ket_provokes

        // quality

        // ket_quality

        // lokasi

        // menyebar

        // pada_dokter

        // ket_dokter

        // nyeri_hilang

        // ket_nyeri

        // bb

        // tb

        // bmi

        // lapor_status_nutrisi

        // ket_lapor_status_nutrisi

        // sg1

        // nilai1

        // sg2

        // nilai2

        // total_hasil

        // resikojatuh

        // bjm

        // msa

        // hasil

        // lapor

        // ket_lapor

        // adl_mandi

        // adl_berpakaian

        // adl_makan

        // adl_bak

        // adl_bab

        // adl_hobi

        // ket_adl_hobi

        // adl_sosialisasi

        // ket_adl_sosialisasi

        // adl_kegiatan

        // ket_adl_kegiatan

        // sk_penampilan

        // sk_alam_perasaan

        // sk_pembicaraan

        // sk_afek

        // sk_aktifitas_motorik

        // sk_gangguan_ringan

        // sk_proses_pikir

        // sk_orientasi

        // sk_tingkat_kesadaran_orientasi

        // sk_memori

        // sk_interaksi

        // sk_konsentrasi

        // sk_persepsi

        // ket_sk_persepsi

        // sk_isi_pikir

        // sk_waham

        // ket_sk_waham

        // sk_daya_tilik_diri

        // ket_sk_daya_tilik_diri

        // kk_pembelajaran

        // ket_kk_pembelajaran

        // ket_kk_pembelajaran_lainnya

        // kk_Penerjamah

        // ket_kk_penerjamah_Lainnya

        // kk_bahasa_isyarat

        // kk_kebutuhan_edukasi

        // ket_kk_kebutuhan_edukasi

        // rencana

        // nip
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_penilaian_awal_keperawatan_ralan_psikiatri
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->ViewValue = $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue;
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->ViewCustomAttributes = "";

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

            // rkd_sakit_sejak
            $this->rkd_sakit_sejak->ViewValue = $this->rkd_sakit_sejak->CurrentValue;
            $this->rkd_sakit_sejak->ViewCustomAttributes = "";

            // rkd_berobat
            if (strval($this->rkd_berobat->CurrentValue) != "") {
                $this->rkd_berobat->ViewValue = $this->rkd_berobat->optionCaption($this->rkd_berobat->CurrentValue);
            } else {
                $this->rkd_berobat->ViewValue = null;
            }
            $this->rkd_berobat->ViewCustomAttributes = "";

            // rkd_hasil_pengobatan
            if (strval($this->rkd_hasil_pengobatan->CurrentValue) != "") {
                $this->rkd_hasil_pengobatan->ViewValue = $this->rkd_hasil_pengobatan->optionCaption($this->rkd_hasil_pengobatan->CurrentValue);
            } else {
                $this->rkd_hasil_pengobatan->ViewValue = null;
            }
            $this->rkd_hasil_pengobatan->ViewCustomAttributes = "";

            // fp_putus_obat
            if (strval($this->fp_putus_obat->CurrentValue) != "") {
                $this->fp_putus_obat->ViewValue = $this->fp_putus_obat->optionCaption($this->fp_putus_obat->CurrentValue);
            } else {
                $this->fp_putus_obat->ViewValue = null;
            }
            $this->fp_putus_obat->ViewCustomAttributes = "";

            // ket_putus_obat
            $this->ket_putus_obat->ViewValue = $this->ket_putus_obat->CurrentValue;
            $this->ket_putus_obat->ViewCustomAttributes = "";

            // fp_ekonomi
            if (strval($this->fp_ekonomi->CurrentValue) != "") {
                $this->fp_ekonomi->ViewValue = $this->fp_ekonomi->optionCaption($this->fp_ekonomi->CurrentValue);
            } else {
                $this->fp_ekonomi->ViewValue = null;
            }
            $this->fp_ekonomi->ViewCustomAttributes = "";

            // ket_masalah_ekonomi
            $this->ket_masalah_ekonomi->ViewValue = $this->ket_masalah_ekonomi->CurrentValue;
            $this->ket_masalah_ekonomi->ViewCustomAttributes = "";

            // fp_masalah_fisik
            if (strval($this->fp_masalah_fisik->CurrentValue) != "") {
                $this->fp_masalah_fisik->ViewValue = $this->fp_masalah_fisik->optionCaption($this->fp_masalah_fisik->CurrentValue);
            } else {
                $this->fp_masalah_fisik->ViewValue = null;
            }
            $this->fp_masalah_fisik->ViewCustomAttributes = "";

            // ket_masalah_fisik
            $this->ket_masalah_fisik->ViewValue = $this->ket_masalah_fisik->CurrentValue;
            $this->ket_masalah_fisik->ViewCustomAttributes = "";

            // fp_masalah_psikososial
            if (strval($this->fp_masalah_psikososial->CurrentValue) != "") {
                $this->fp_masalah_psikososial->ViewValue = $this->fp_masalah_psikososial->optionCaption($this->fp_masalah_psikososial->CurrentValue);
            } else {
                $this->fp_masalah_psikososial->ViewValue = null;
            }
            $this->fp_masalah_psikososial->ViewCustomAttributes = "";

            // ket_masalah_psikososial
            $this->ket_masalah_psikososial->ViewValue = $this->ket_masalah_psikososial->CurrentValue;
            $this->ket_masalah_psikososial->ViewCustomAttributes = "";

            // rh_keluarga
            if (strval($this->rh_keluarga->CurrentValue) != "") {
                $this->rh_keluarga->ViewValue = $this->rh_keluarga->optionCaption($this->rh_keluarga->CurrentValue);
            } else {
                $this->rh_keluarga->ViewValue = null;
            }
            $this->rh_keluarga->ViewCustomAttributes = "";

            // ket_rh_keluarga
            $this->ket_rh_keluarga->ViewValue = $this->ket_rh_keluarga->CurrentValue;
            $this->ket_rh_keluarga->ViewCustomAttributes = "";

            // resiko_bunuh_diri
            if (strval($this->resiko_bunuh_diri->CurrentValue) != "") {
                $this->resiko_bunuh_diri->ViewValue = $this->resiko_bunuh_diri->optionCaption($this->resiko_bunuh_diri->CurrentValue);
            } else {
                $this->resiko_bunuh_diri->ViewValue = null;
            }
            $this->resiko_bunuh_diri->ViewCustomAttributes = "";

            // rbd_ide
            if (strval($this->rbd_ide->CurrentValue) != "") {
                $this->rbd_ide->ViewValue = $this->rbd_ide->optionCaption($this->rbd_ide->CurrentValue);
            } else {
                $this->rbd_ide->ViewValue = null;
            }
            $this->rbd_ide->ViewCustomAttributes = "";

            // ket_rbd_ide
            $this->ket_rbd_ide->ViewValue = $this->ket_rbd_ide->CurrentValue;
            $this->ket_rbd_ide->ViewCustomAttributes = "";

            // rbd_rencana
            if (strval($this->rbd_rencana->CurrentValue) != "") {
                $this->rbd_rencana->ViewValue = $this->rbd_rencana->optionCaption($this->rbd_rencana->CurrentValue);
            } else {
                $this->rbd_rencana->ViewValue = null;
            }
            $this->rbd_rencana->ViewCustomAttributes = "";

            // ket_rbd_rencana
            $this->ket_rbd_rencana->ViewValue = $this->ket_rbd_rencana->CurrentValue;
            $this->ket_rbd_rencana->ViewCustomAttributes = "";

            // rbd_alat
            if (strval($this->rbd_alat->CurrentValue) != "") {
                $this->rbd_alat->ViewValue = $this->rbd_alat->optionCaption($this->rbd_alat->CurrentValue);
            } else {
                $this->rbd_alat->ViewValue = null;
            }
            $this->rbd_alat->ViewCustomAttributes = "";

            // ket_rbd_alat
            $this->ket_rbd_alat->ViewValue = $this->ket_rbd_alat->CurrentValue;
            $this->ket_rbd_alat->ViewCustomAttributes = "";

            // rbd_percobaan
            if (strval($this->rbd_percobaan->CurrentValue) != "") {
                $this->rbd_percobaan->ViewValue = $this->rbd_percobaan->optionCaption($this->rbd_percobaan->CurrentValue);
            } else {
                $this->rbd_percobaan->ViewValue = null;
            }
            $this->rbd_percobaan->ViewCustomAttributes = "";

            // ket_rbd_percobaan
            $this->ket_rbd_percobaan->ViewValue = $this->ket_rbd_percobaan->CurrentValue;
            $this->ket_rbd_percobaan->ViewCustomAttributes = "";

            // rbd_keinginan
            if (strval($this->rbd_keinginan->CurrentValue) != "") {
                $this->rbd_keinginan->ViewValue = $this->rbd_keinginan->optionCaption($this->rbd_keinginan->CurrentValue);
            } else {
                $this->rbd_keinginan->ViewValue = null;
            }
            $this->rbd_keinginan->ViewCustomAttributes = "";

            // ket_rbd_keinginan
            $this->ket_rbd_keinginan->ViewValue = $this->ket_rbd_keinginan->CurrentValue;
            $this->ket_rbd_keinginan->ViewCustomAttributes = "";

            // rpo_penggunaan
            if (strval($this->rpo_penggunaan->CurrentValue) != "") {
                $this->rpo_penggunaan->ViewValue = $this->rpo_penggunaan->optionCaption($this->rpo_penggunaan->CurrentValue);
            } else {
                $this->rpo_penggunaan->ViewValue = null;
            }
            $this->rpo_penggunaan->ViewCustomAttributes = "";

            // ket_rpo_penggunaan
            $this->ket_rpo_penggunaan->ViewValue = $this->ket_rpo_penggunaan->CurrentValue;
            $this->ket_rpo_penggunaan->ViewCustomAttributes = "";

            // rpo_efek_samping
            if (strval($this->rpo_efek_samping->CurrentValue) != "") {
                $this->rpo_efek_samping->ViewValue = $this->rpo_efek_samping->optionCaption($this->rpo_efek_samping->CurrentValue);
            } else {
                $this->rpo_efek_samping->ViewValue = null;
            }
            $this->rpo_efek_samping->ViewCustomAttributes = "";

            // ket_rpo_efek_samping
            $this->ket_rpo_efek_samping->ViewValue = $this->ket_rpo_efek_samping->CurrentValue;
            $this->ket_rpo_efek_samping->ViewCustomAttributes = "";

            // rpo_napza
            if (strval($this->rpo_napza->CurrentValue) != "") {
                $this->rpo_napza->ViewValue = $this->rpo_napza->optionCaption($this->rpo_napza->CurrentValue);
            } else {
                $this->rpo_napza->ViewValue = null;
            }
            $this->rpo_napza->ViewCustomAttributes = "";

            // ket_rpo_napza
            $this->ket_rpo_napza->ViewValue = $this->ket_rpo_napza->CurrentValue;
            $this->ket_rpo_napza->ViewCustomAttributes = "";

            // ket_lama_pemakaian
            $this->ket_lama_pemakaian->ViewValue = $this->ket_lama_pemakaian->CurrentValue;
            $this->ket_lama_pemakaian->ViewCustomAttributes = "";

            // ket_cara_pemakaian
            $this->ket_cara_pemakaian->ViewValue = $this->ket_cara_pemakaian->CurrentValue;
            $this->ket_cara_pemakaian->ViewCustomAttributes = "";

            // ket_latar_belakang_pemakaian
            $this->ket_latar_belakang_pemakaian->ViewValue = $this->ket_latar_belakang_pemakaian->CurrentValue;
            $this->ket_latar_belakang_pemakaian->ViewCustomAttributes = "";

            // rpo_penggunaan_obat_lainnya
            if (strval($this->rpo_penggunaan_obat_lainnya->CurrentValue) != "") {
                $this->rpo_penggunaan_obat_lainnya->ViewValue = $this->rpo_penggunaan_obat_lainnya->optionCaption($this->rpo_penggunaan_obat_lainnya->CurrentValue);
            } else {
                $this->rpo_penggunaan_obat_lainnya->ViewValue = null;
            }
            $this->rpo_penggunaan_obat_lainnya->ViewCustomAttributes = "";

            // ket_penggunaan_obat_lainnya
            $this->ket_penggunaan_obat_lainnya->ViewValue = $this->ket_penggunaan_obat_lainnya->CurrentValue;
            $this->ket_penggunaan_obat_lainnya->ViewCustomAttributes = "";

            // ket_alasan_penggunaan
            $this->ket_alasan_penggunaan->ViewValue = $this->ket_alasan_penggunaan->CurrentValue;
            $this->ket_alasan_penggunaan->ViewCustomAttributes = "";

            // rpo_alergi_obat
            if (strval($this->rpo_alergi_obat->CurrentValue) != "") {
                $this->rpo_alergi_obat->ViewValue = $this->rpo_alergi_obat->optionCaption($this->rpo_alergi_obat->CurrentValue);
            } else {
                $this->rpo_alergi_obat->ViewValue = null;
            }
            $this->rpo_alergi_obat->ViewCustomAttributes = "";

            // ket_alergi_obat
            $this->ket_alergi_obat->ViewValue = $this->ket_alergi_obat->CurrentValue;
            $this->ket_alergi_obat->ViewCustomAttributes = "";

            // rpo_merokok
            if (strval($this->rpo_merokok->CurrentValue) != "") {
                $this->rpo_merokok->ViewValue = $this->rpo_merokok->optionCaption($this->rpo_merokok->CurrentValue);
            } else {
                $this->rpo_merokok->ViewValue = null;
            }
            $this->rpo_merokok->ViewCustomAttributes = "";

            // ket_merokok
            $this->ket_merokok->ViewValue = $this->ket_merokok->CurrentValue;
            $this->ket_merokok->ViewCustomAttributes = "";

            // rpo_minum_kopi
            if (strval($this->rpo_minum_kopi->CurrentValue) != "") {
                $this->rpo_minum_kopi->ViewValue = $this->rpo_minum_kopi->optionCaption($this->rpo_minum_kopi->CurrentValue);
            } else {
                $this->rpo_minum_kopi->ViewValue = null;
            }
            $this->rpo_minum_kopi->ViewCustomAttributes = "";

            // ket_minum_kopi
            $this->ket_minum_kopi->ViewValue = $this->ket_minum_kopi->CurrentValue;
            $this->ket_minum_kopi->ViewCustomAttributes = "";

            // td
            $this->td->ViewValue = $this->td->CurrentValue;
            $this->td->ViewCustomAttributes = "";

            // nadi
            $this->nadi->ViewValue = $this->nadi->CurrentValue;
            $this->nadi->ViewCustomAttributes = "";

            // gcs
            $this->gcs->ViewValue = $this->gcs->CurrentValue;
            $this->gcs->ViewCustomAttributes = "";

            // rr
            $this->rr->ViewValue = $this->rr->CurrentValue;
            $this->rr->ViewCustomAttributes = "";

            // suhu
            $this->suhu->ViewValue = $this->suhu->CurrentValue;
            $this->suhu->ViewCustomAttributes = "";

            // pf_keluhan_fisik
            if (strval($this->pf_keluhan_fisik->CurrentValue) != "") {
                $this->pf_keluhan_fisik->ViewValue = $this->pf_keluhan_fisik->optionCaption($this->pf_keluhan_fisik->CurrentValue);
            } else {
                $this->pf_keluhan_fisik->ViewValue = null;
            }
            $this->pf_keluhan_fisik->ViewCustomAttributes = "";

            // ket_keluhan_fisik
            $this->ket_keluhan_fisik->ViewValue = $this->ket_keluhan_fisik->CurrentValue;
            $this->ket_keluhan_fisik->ViewCustomAttributes = "";

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

            // bb
            $this->bb->ViewValue = $this->bb->CurrentValue;
            $this->bb->ViewCustomAttributes = "";

            // tb
            $this->tb->ViewValue = $this->tb->CurrentValue;
            $this->tb->ViewCustomAttributes = "";

            // bmi
            $this->bmi->ViewValue = $this->bmi->CurrentValue;
            $this->bmi->ViewCustomAttributes = "";

            // lapor_status_nutrisi
            if (strval($this->lapor_status_nutrisi->CurrentValue) != "") {
                $this->lapor_status_nutrisi->ViewValue = $this->lapor_status_nutrisi->optionCaption($this->lapor_status_nutrisi->CurrentValue);
            } else {
                $this->lapor_status_nutrisi->ViewValue = null;
            }
            $this->lapor_status_nutrisi->ViewCustomAttributes = "";

            // ket_lapor_status_nutrisi
            $this->ket_lapor_status_nutrisi->ViewValue = $this->ket_lapor_status_nutrisi->CurrentValue;
            $this->ket_lapor_status_nutrisi->ViewCustomAttributes = "";

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

            // resikojatuh
            if (strval($this->resikojatuh->CurrentValue) != "") {
                $this->resikojatuh->ViewValue = $this->resikojatuh->optionCaption($this->resikojatuh->CurrentValue);
            } else {
                $this->resikojatuh->ViewValue = null;
            }
            $this->resikojatuh->ViewCustomAttributes = "";

            // bjm
            if (strval($this->bjm->CurrentValue) != "") {
                $this->bjm->ViewValue = $this->bjm->optionCaption($this->bjm->CurrentValue);
            } else {
                $this->bjm->ViewValue = null;
            }
            $this->bjm->ViewCustomAttributes = "";

            // msa
            if (strval($this->msa->CurrentValue) != "") {
                $this->msa->ViewValue = $this->msa->optionCaption($this->msa->CurrentValue);
            } else {
                $this->msa->ViewValue = null;
            }
            $this->msa->ViewCustomAttributes = "";

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

            // adl_mandi
            if (strval($this->adl_mandi->CurrentValue) != "") {
                $this->adl_mandi->ViewValue = $this->adl_mandi->optionCaption($this->adl_mandi->CurrentValue);
            } else {
                $this->adl_mandi->ViewValue = null;
            }
            $this->adl_mandi->ViewCustomAttributes = "";

            // adl_berpakaian
            if (strval($this->adl_berpakaian->CurrentValue) != "") {
                $this->adl_berpakaian->ViewValue = $this->adl_berpakaian->optionCaption($this->adl_berpakaian->CurrentValue);
            } else {
                $this->adl_berpakaian->ViewValue = null;
            }
            $this->adl_berpakaian->ViewCustomAttributes = "";

            // adl_makan
            if (strval($this->adl_makan->CurrentValue) != "") {
                $this->adl_makan->ViewValue = $this->adl_makan->optionCaption($this->adl_makan->CurrentValue);
            } else {
                $this->adl_makan->ViewValue = null;
            }
            $this->adl_makan->ViewCustomAttributes = "";

            // adl_bak
            if (strval($this->adl_bak->CurrentValue) != "") {
                $this->adl_bak->ViewValue = $this->adl_bak->optionCaption($this->adl_bak->CurrentValue);
            } else {
                $this->adl_bak->ViewValue = null;
            }
            $this->adl_bak->ViewCustomAttributes = "";

            // adl_bab
            if (strval($this->adl_bab->CurrentValue) != "") {
                $this->adl_bab->ViewValue = $this->adl_bab->optionCaption($this->adl_bab->CurrentValue);
            } else {
                $this->adl_bab->ViewValue = null;
            }
            $this->adl_bab->ViewCustomAttributes = "";

            // adl_hobi
            if (strval($this->adl_hobi->CurrentValue) != "") {
                $this->adl_hobi->ViewValue = $this->adl_hobi->optionCaption($this->adl_hobi->CurrentValue);
            } else {
                $this->adl_hobi->ViewValue = null;
            }
            $this->adl_hobi->ViewCustomAttributes = "";

            // ket_adl_hobi
            $this->ket_adl_hobi->ViewValue = $this->ket_adl_hobi->CurrentValue;
            $this->ket_adl_hobi->ViewCustomAttributes = "";

            // adl_sosialisasi
            if (strval($this->adl_sosialisasi->CurrentValue) != "") {
                $this->adl_sosialisasi->ViewValue = $this->adl_sosialisasi->optionCaption($this->adl_sosialisasi->CurrentValue);
            } else {
                $this->adl_sosialisasi->ViewValue = null;
            }
            $this->adl_sosialisasi->ViewCustomAttributes = "";

            // ket_adl_sosialisasi
            $this->ket_adl_sosialisasi->ViewValue = $this->ket_adl_sosialisasi->CurrentValue;
            $this->ket_adl_sosialisasi->ViewCustomAttributes = "";

            // adl_kegiatan
            if (strval($this->adl_kegiatan->CurrentValue) != "") {
                $this->adl_kegiatan->ViewValue = $this->adl_kegiatan->optionCaption($this->adl_kegiatan->CurrentValue);
            } else {
                $this->adl_kegiatan->ViewValue = null;
            }
            $this->adl_kegiatan->ViewCustomAttributes = "";

            // ket_adl_kegiatan
            $this->ket_adl_kegiatan->ViewValue = $this->ket_adl_kegiatan->CurrentValue;
            $this->ket_adl_kegiatan->ViewCustomAttributes = "";

            // sk_penampilan
            if (strval($this->sk_penampilan->CurrentValue) != "") {
                $this->sk_penampilan->ViewValue = $this->sk_penampilan->optionCaption($this->sk_penampilan->CurrentValue);
            } else {
                $this->sk_penampilan->ViewValue = null;
            }
            $this->sk_penampilan->ViewCustomAttributes = "";

            // sk_alam_perasaan
            if (strval($this->sk_alam_perasaan->CurrentValue) != "") {
                $this->sk_alam_perasaan->ViewValue = $this->sk_alam_perasaan->optionCaption($this->sk_alam_perasaan->CurrentValue);
            } else {
                $this->sk_alam_perasaan->ViewValue = null;
            }
            $this->sk_alam_perasaan->ViewCustomAttributes = "";

            // sk_pembicaraan
            if (strval($this->sk_pembicaraan->CurrentValue) != "") {
                $this->sk_pembicaraan->ViewValue = $this->sk_pembicaraan->optionCaption($this->sk_pembicaraan->CurrentValue);
            } else {
                $this->sk_pembicaraan->ViewValue = null;
            }
            $this->sk_pembicaraan->ViewCustomAttributes = "";

            // sk_afek
            if (strval($this->sk_afek->CurrentValue) != "") {
                $this->sk_afek->ViewValue = $this->sk_afek->optionCaption($this->sk_afek->CurrentValue);
            } else {
                $this->sk_afek->ViewValue = null;
            }
            $this->sk_afek->ViewCustomAttributes = "";

            // sk_aktifitas_motorik
            if (strval($this->sk_aktifitas_motorik->CurrentValue) != "") {
                $this->sk_aktifitas_motorik->ViewValue = $this->sk_aktifitas_motorik->optionCaption($this->sk_aktifitas_motorik->CurrentValue);
            } else {
                $this->sk_aktifitas_motorik->ViewValue = null;
            }
            $this->sk_aktifitas_motorik->ViewCustomAttributes = "";

            // sk_gangguan_ringan
            if (strval($this->sk_gangguan_ringan->CurrentValue) != "") {
                $this->sk_gangguan_ringan->ViewValue = $this->sk_gangguan_ringan->optionCaption($this->sk_gangguan_ringan->CurrentValue);
            } else {
                $this->sk_gangguan_ringan->ViewValue = null;
            }
            $this->sk_gangguan_ringan->ViewCustomAttributes = "";

            // sk_proses_pikir
            if (strval($this->sk_proses_pikir->CurrentValue) != "") {
                $this->sk_proses_pikir->ViewValue = $this->sk_proses_pikir->optionCaption($this->sk_proses_pikir->CurrentValue);
            } else {
                $this->sk_proses_pikir->ViewValue = null;
            }
            $this->sk_proses_pikir->ViewCustomAttributes = "";

            // sk_orientasi
            if (strval($this->sk_orientasi->CurrentValue) != "") {
                $this->sk_orientasi->ViewValue = $this->sk_orientasi->optionCaption($this->sk_orientasi->CurrentValue);
            } else {
                $this->sk_orientasi->ViewValue = null;
            }
            $this->sk_orientasi->ViewCustomAttributes = "";

            // sk_tingkat_kesadaran_orientasi
            if (strval($this->sk_tingkat_kesadaran_orientasi->CurrentValue) != "") {
                $this->sk_tingkat_kesadaran_orientasi->ViewValue = $this->sk_tingkat_kesadaran_orientasi->optionCaption($this->sk_tingkat_kesadaran_orientasi->CurrentValue);
            } else {
                $this->sk_tingkat_kesadaran_orientasi->ViewValue = null;
            }
            $this->sk_tingkat_kesadaran_orientasi->ViewCustomAttributes = "";

            // sk_memori
            if (strval($this->sk_memori->CurrentValue) != "") {
                $this->sk_memori->ViewValue = $this->sk_memori->optionCaption($this->sk_memori->CurrentValue);
            } else {
                $this->sk_memori->ViewValue = null;
            }
            $this->sk_memori->ViewCustomAttributes = "";

            // sk_interaksi
            if (strval($this->sk_interaksi->CurrentValue) != "") {
                $this->sk_interaksi->ViewValue = $this->sk_interaksi->optionCaption($this->sk_interaksi->CurrentValue);
            } else {
                $this->sk_interaksi->ViewValue = null;
            }
            $this->sk_interaksi->ViewCustomAttributes = "";

            // sk_konsentrasi
            if (strval($this->sk_konsentrasi->CurrentValue) != "") {
                $this->sk_konsentrasi->ViewValue = $this->sk_konsentrasi->optionCaption($this->sk_konsentrasi->CurrentValue);
            } else {
                $this->sk_konsentrasi->ViewValue = null;
            }
            $this->sk_konsentrasi->ViewCustomAttributes = "";

            // sk_persepsi
            if (strval($this->sk_persepsi->CurrentValue) != "") {
                $this->sk_persepsi->ViewValue = $this->sk_persepsi->optionCaption($this->sk_persepsi->CurrentValue);
            } else {
                $this->sk_persepsi->ViewValue = null;
            }
            $this->sk_persepsi->ViewCustomAttributes = "";

            // ket_sk_persepsi
            $this->ket_sk_persepsi->ViewValue = $this->ket_sk_persepsi->CurrentValue;
            $this->ket_sk_persepsi->ViewCustomAttributes = "";

            // sk_isi_pikir
            if (strval($this->sk_isi_pikir->CurrentValue) != "") {
                $this->sk_isi_pikir->ViewValue = $this->sk_isi_pikir->optionCaption($this->sk_isi_pikir->CurrentValue);
            } else {
                $this->sk_isi_pikir->ViewValue = null;
            }
            $this->sk_isi_pikir->ViewCustomAttributes = "";

            // sk_waham
            if (strval($this->sk_waham->CurrentValue) != "") {
                $this->sk_waham->ViewValue = $this->sk_waham->optionCaption($this->sk_waham->CurrentValue);
            } else {
                $this->sk_waham->ViewValue = null;
            }
            $this->sk_waham->ViewCustomAttributes = "";

            // ket_sk_waham
            $this->ket_sk_waham->ViewValue = $this->ket_sk_waham->CurrentValue;
            $this->ket_sk_waham->ViewCustomAttributes = "";

            // sk_daya_tilik_diri
            if (strval($this->sk_daya_tilik_diri->CurrentValue) != "") {
                $this->sk_daya_tilik_diri->ViewValue = $this->sk_daya_tilik_diri->optionCaption($this->sk_daya_tilik_diri->CurrentValue);
            } else {
                $this->sk_daya_tilik_diri->ViewValue = null;
            }
            $this->sk_daya_tilik_diri->ViewCustomAttributes = "";

            // ket_sk_daya_tilik_diri
            $this->ket_sk_daya_tilik_diri->ViewValue = $this->ket_sk_daya_tilik_diri->CurrentValue;
            $this->ket_sk_daya_tilik_diri->ViewCustomAttributes = "";

            // kk_pembelajaran
            if (strval($this->kk_pembelajaran->CurrentValue) != "") {
                $this->kk_pembelajaran->ViewValue = $this->kk_pembelajaran->optionCaption($this->kk_pembelajaran->CurrentValue);
            } else {
                $this->kk_pembelajaran->ViewValue = null;
            }
            $this->kk_pembelajaran->ViewCustomAttributes = "";

            // ket_kk_pembelajaran
            if (strval($this->ket_kk_pembelajaran->CurrentValue) != "") {
                $this->ket_kk_pembelajaran->ViewValue = $this->ket_kk_pembelajaran->optionCaption($this->ket_kk_pembelajaran->CurrentValue);
            } else {
                $this->ket_kk_pembelajaran->ViewValue = null;
            }
            $this->ket_kk_pembelajaran->ViewCustomAttributes = "";

            // ket_kk_pembelajaran_lainnya
            $this->ket_kk_pembelajaran_lainnya->ViewValue = $this->ket_kk_pembelajaran_lainnya->CurrentValue;
            $this->ket_kk_pembelajaran_lainnya->ViewCustomAttributes = "";

            // kk_Penerjamah
            if (strval($this->kk_Penerjamah->CurrentValue) != "") {
                $this->kk_Penerjamah->ViewValue = $this->kk_Penerjamah->optionCaption($this->kk_Penerjamah->CurrentValue);
            } else {
                $this->kk_Penerjamah->ViewValue = null;
            }
            $this->kk_Penerjamah->ViewCustomAttributes = "";

            // ket_kk_penerjamah_Lainnya
            $this->ket_kk_penerjamah_Lainnya->ViewValue = $this->ket_kk_penerjamah_Lainnya->CurrentValue;
            $this->ket_kk_penerjamah_Lainnya->ViewCustomAttributes = "";

            // kk_bahasa_isyarat
            if (strval($this->kk_bahasa_isyarat->CurrentValue) != "") {
                $this->kk_bahasa_isyarat->ViewValue = $this->kk_bahasa_isyarat->optionCaption($this->kk_bahasa_isyarat->CurrentValue);
            } else {
                $this->kk_bahasa_isyarat->ViewValue = null;
            }
            $this->kk_bahasa_isyarat->ViewCustomAttributes = "";

            // kk_kebutuhan_edukasi
            if (strval($this->kk_kebutuhan_edukasi->CurrentValue) != "") {
                $this->kk_kebutuhan_edukasi->ViewValue = $this->kk_kebutuhan_edukasi->optionCaption($this->kk_kebutuhan_edukasi->CurrentValue);
            } else {
                $this->kk_kebutuhan_edukasi->ViewValue = null;
            }
            $this->kk_kebutuhan_edukasi->ViewCustomAttributes = "";

            // ket_kk_kebutuhan_edukasi
            $this->ket_kk_kebutuhan_edukasi->ViewValue = $this->ket_kk_kebutuhan_edukasi->CurrentValue;
            $this->ket_kk_kebutuhan_edukasi->ViewCustomAttributes = "";

            // rencana
            $this->rencana->ViewValue = $this->rencana->CurrentValue;
            $this->rencana->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";
            $this->no_rawat->TooltipValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";
            $this->tanggal->TooltipValue = "";

            // informasi
            $this->informasi->LinkCustomAttributes = "";
            $this->informasi->HrefValue = "";
            $this->informasi->TooltipValue = "";

            // rkd_sakit_sejak
            $this->rkd_sakit_sejak->LinkCustomAttributes = "";
            $this->rkd_sakit_sejak->HrefValue = "";
            $this->rkd_sakit_sejak->TooltipValue = "";

            // rkd_berobat
            $this->rkd_berobat->LinkCustomAttributes = "";
            $this->rkd_berobat->HrefValue = "";
            $this->rkd_berobat->TooltipValue = "";

            // rkd_hasil_pengobatan
            $this->rkd_hasil_pengobatan->LinkCustomAttributes = "";
            $this->rkd_hasil_pengobatan->HrefValue = "";
            $this->rkd_hasil_pengobatan->TooltipValue = "";

            // fp_putus_obat
            $this->fp_putus_obat->LinkCustomAttributes = "";
            $this->fp_putus_obat->HrefValue = "";
            $this->fp_putus_obat->TooltipValue = "";

            // ket_putus_obat
            $this->ket_putus_obat->LinkCustomAttributes = "";
            $this->ket_putus_obat->HrefValue = "";
            $this->ket_putus_obat->TooltipValue = "";

            // fp_ekonomi
            $this->fp_ekonomi->LinkCustomAttributes = "";
            $this->fp_ekonomi->HrefValue = "";
            $this->fp_ekonomi->TooltipValue = "";

            // ket_masalah_ekonomi
            $this->ket_masalah_ekonomi->LinkCustomAttributes = "";
            $this->ket_masalah_ekonomi->HrefValue = "";
            $this->ket_masalah_ekonomi->TooltipValue = "";

            // fp_masalah_fisik
            $this->fp_masalah_fisik->LinkCustomAttributes = "";
            $this->fp_masalah_fisik->HrefValue = "";
            $this->fp_masalah_fisik->TooltipValue = "";

            // ket_masalah_fisik
            $this->ket_masalah_fisik->LinkCustomAttributes = "";
            $this->ket_masalah_fisik->HrefValue = "";
            $this->ket_masalah_fisik->TooltipValue = "";

            // fp_masalah_psikososial
            $this->fp_masalah_psikososial->LinkCustomAttributes = "";
            $this->fp_masalah_psikososial->HrefValue = "";
            $this->fp_masalah_psikososial->TooltipValue = "";

            // ket_masalah_psikososial
            $this->ket_masalah_psikososial->LinkCustomAttributes = "";
            $this->ket_masalah_psikososial->HrefValue = "";
            $this->ket_masalah_psikososial->TooltipValue = "";

            // rh_keluarga
            $this->rh_keluarga->LinkCustomAttributes = "";
            $this->rh_keluarga->HrefValue = "";
            $this->rh_keluarga->TooltipValue = "";

            // ket_rh_keluarga
            $this->ket_rh_keluarga->LinkCustomAttributes = "";
            $this->ket_rh_keluarga->HrefValue = "";
            $this->ket_rh_keluarga->TooltipValue = "";

            // resiko_bunuh_diri
            $this->resiko_bunuh_diri->LinkCustomAttributes = "";
            $this->resiko_bunuh_diri->HrefValue = "";
            $this->resiko_bunuh_diri->TooltipValue = "";

            // rbd_ide
            $this->rbd_ide->LinkCustomAttributes = "";
            $this->rbd_ide->HrefValue = "";
            $this->rbd_ide->TooltipValue = "";

            // ket_rbd_ide
            $this->ket_rbd_ide->LinkCustomAttributes = "";
            $this->ket_rbd_ide->HrefValue = "";
            $this->ket_rbd_ide->TooltipValue = "";

            // rbd_rencana
            $this->rbd_rencana->LinkCustomAttributes = "";
            $this->rbd_rencana->HrefValue = "";
            $this->rbd_rencana->TooltipValue = "";

            // ket_rbd_rencana
            $this->ket_rbd_rencana->LinkCustomAttributes = "";
            $this->ket_rbd_rencana->HrefValue = "";
            $this->ket_rbd_rencana->TooltipValue = "";

            // rbd_alat
            $this->rbd_alat->LinkCustomAttributes = "";
            $this->rbd_alat->HrefValue = "";
            $this->rbd_alat->TooltipValue = "";

            // ket_rbd_alat
            $this->ket_rbd_alat->LinkCustomAttributes = "";
            $this->ket_rbd_alat->HrefValue = "";
            $this->ket_rbd_alat->TooltipValue = "";

            // rbd_percobaan
            $this->rbd_percobaan->LinkCustomAttributes = "";
            $this->rbd_percobaan->HrefValue = "";
            $this->rbd_percobaan->TooltipValue = "";

            // ket_rbd_percobaan
            $this->ket_rbd_percobaan->LinkCustomAttributes = "";
            $this->ket_rbd_percobaan->HrefValue = "";
            $this->ket_rbd_percobaan->TooltipValue = "";

            // rbd_keinginan
            $this->rbd_keinginan->LinkCustomAttributes = "";
            $this->rbd_keinginan->HrefValue = "";
            $this->rbd_keinginan->TooltipValue = "";

            // ket_rbd_keinginan
            $this->ket_rbd_keinginan->LinkCustomAttributes = "";
            $this->ket_rbd_keinginan->HrefValue = "";
            $this->ket_rbd_keinginan->TooltipValue = "";

            // rpo_penggunaan
            $this->rpo_penggunaan->LinkCustomAttributes = "";
            $this->rpo_penggunaan->HrefValue = "";
            $this->rpo_penggunaan->TooltipValue = "";

            // ket_rpo_penggunaan
            $this->ket_rpo_penggunaan->LinkCustomAttributes = "";
            $this->ket_rpo_penggunaan->HrefValue = "";
            $this->ket_rpo_penggunaan->TooltipValue = "";

            // rpo_efek_samping
            $this->rpo_efek_samping->LinkCustomAttributes = "";
            $this->rpo_efek_samping->HrefValue = "";
            $this->rpo_efek_samping->TooltipValue = "";

            // ket_rpo_efek_samping
            $this->ket_rpo_efek_samping->LinkCustomAttributes = "";
            $this->ket_rpo_efek_samping->HrefValue = "";
            $this->ket_rpo_efek_samping->TooltipValue = "";

            // rpo_napza
            $this->rpo_napza->LinkCustomAttributes = "";
            $this->rpo_napza->HrefValue = "";
            $this->rpo_napza->TooltipValue = "";

            // ket_rpo_napza
            $this->ket_rpo_napza->LinkCustomAttributes = "";
            $this->ket_rpo_napza->HrefValue = "";
            $this->ket_rpo_napza->TooltipValue = "";

            // ket_lama_pemakaian
            $this->ket_lama_pemakaian->LinkCustomAttributes = "";
            $this->ket_lama_pemakaian->HrefValue = "";
            $this->ket_lama_pemakaian->TooltipValue = "";

            // ket_cara_pemakaian
            $this->ket_cara_pemakaian->LinkCustomAttributes = "";
            $this->ket_cara_pemakaian->HrefValue = "";
            $this->ket_cara_pemakaian->TooltipValue = "";

            // ket_latar_belakang_pemakaian
            $this->ket_latar_belakang_pemakaian->LinkCustomAttributes = "";
            $this->ket_latar_belakang_pemakaian->HrefValue = "";
            $this->ket_latar_belakang_pemakaian->TooltipValue = "";

            // rpo_penggunaan_obat_lainnya
            $this->rpo_penggunaan_obat_lainnya->LinkCustomAttributes = "";
            $this->rpo_penggunaan_obat_lainnya->HrefValue = "";
            $this->rpo_penggunaan_obat_lainnya->TooltipValue = "";

            // ket_penggunaan_obat_lainnya
            $this->ket_penggunaan_obat_lainnya->LinkCustomAttributes = "";
            $this->ket_penggunaan_obat_lainnya->HrefValue = "";
            $this->ket_penggunaan_obat_lainnya->TooltipValue = "";

            // ket_alasan_penggunaan
            $this->ket_alasan_penggunaan->LinkCustomAttributes = "";
            $this->ket_alasan_penggunaan->HrefValue = "";
            $this->ket_alasan_penggunaan->TooltipValue = "";

            // rpo_alergi_obat
            $this->rpo_alergi_obat->LinkCustomAttributes = "";
            $this->rpo_alergi_obat->HrefValue = "";
            $this->rpo_alergi_obat->TooltipValue = "";

            // ket_alergi_obat
            $this->ket_alergi_obat->LinkCustomAttributes = "";
            $this->ket_alergi_obat->HrefValue = "";
            $this->ket_alergi_obat->TooltipValue = "";

            // rpo_merokok
            $this->rpo_merokok->LinkCustomAttributes = "";
            $this->rpo_merokok->HrefValue = "";
            $this->rpo_merokok->TooltipValue = "";

            // ket_merokok
            $this->ket_merokok->LinkCustomAttributes = "";
            $this->ket_merokok->HrefValue = "";
            $this->ket_merokok->TooltipValue = "";

            // rpo_minum_kopi
            $this->rpo_minum_kopi->LinkCustomAttributes = "";
            $this->rpo_minum_kopi->HrefValue = "";
            $this->rpo_minum_kopi->TooltipValue = "";

            // ket_minum_kopi
            $this->ket_minum_kopi->LinkCustomAttributes = "";
            $this->ket_minum_kopi->HrefValue = "";
            $this->ket_minum_kopi->TooltipValue = "";

            // td
            $this->td->LinkCustomAttributes = "";
            $this->td->HrefValue = "";
            $this->td->TooltipValue = "";

            // nadi
            $this->nadi->LinkCustomAttributes = "";
            $this->nadi->HrefValue = "";
            $this->nadi->TooltipValue = "";

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";
            $this->gcs->TooltipValue = "";

            // rr
            $this->rr->LinkCustomAttributes = "";
            $this->rr->HrefValue = "";
            $this->rr->TooltipValue = "";

            // suhu
            $this->suhu->LinkCustomAttributes = "";
            $this->suhu->HrefValue = "";
            $this->suhu->TooltipValue = "";

            // pf_keluhan_fisik
            $this->pf_keluhan_fisik->LinkCustomAttributes = "";
            $this->pf_keluhan_fisik->HrefValue = "";
            $this->pf_keluhan_fisik->TooltipValue = "";

            // ket_keluhan_fisik
            $this->ket_keluhan_fisik->LinkCustomAttributes = "";
            $this->ket_keluhan_fisik->HrefValue = "";
            $this->ket_keluhan_fisik->TooltipValue = "";

            // skala_nyeri
            $this->skala_nyeri->LinkCustomAttributes = "";
            $this->skala_nyeri->HrefValue = "";
            $this->skala_nyeri->TooltipValue = "";

            // durasi
            $this->durasi->LinkCustomAttributes = "";
            $this->durasi->HrefValue = "";
            $this->durasi->TooltipValue = "";

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

            // pada_dokter
            $this->pada_dokter->LinkCustomAttributes = "";
            $this->pada_dokter->HrefValue = "";
            $this->pada_dokter->TooltipValue = "";

            // ket_dokter
            $this->ket_dokter->LinkCustomAttributes = "";
            $this->ket_dokter->HrefValue = "";
            $this->ket_dokter->TooltipValue = "";

            // nyeri_hilang
            $this->nyeri_hilang->LinkCustomAttributes = "";
            $this->nyeri_hilang->HrefValue = "";
            $this->nyeri_hilang->TooltipValue = "";

            // ket_nyeri
            $this->ket_nyeri->LinkCustomAttributes = "";
            $this->ket_nyeri->HrefValue = "";
            $this->ket_nyeri->TooltipValue = "";

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

            // lapor_status_nutrisi
            $this->lapor_status_nutrisi->LinkCustomAttributes = "";
            $this->lapor_status_nutrisi->HrefValue = "";
            $this->lapor_status_nutrisi->TooltipValue = "";

            // ket_lapor_status_nutrisi
            $this->ket_lapor_status_nutrisi->LinkCustomAttributes = "";
            $this->ket_lapor_status_nutrisi->HrefValue = "";
            $this->ket_lapor_status_nutrisi->TooltipValue = "";

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

            // resikojatuh
            $this->resikojatuh->LinkCustomAttributes = "";
            $this->resikojatuh->HrefValue = "";
            $this->resikojatuh->TooltipValue = "";

            // bjm
            $this->bjm->LinkCustomAttributes = "";
            $this->bjm->HrefValue = "";
            $this->bjm->TooltipValue = "";

            // msa
            $this->msa->LinkCustomAttributes = "";
            $this->msa->HrefValue = "";
            $this->msa->TooltipValue = "";

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

            // adl_mandi
            $this->adl_mandi->LinkCustomAttributes = "";
            $this->adl_mandi->HrefValue = "";
            $this->adl_mandi->TooltipValue = "";

            // adl_berpakaian
            $this->adl_berpakaian->LinkCustomAttributes = "";
            $this->adl_berpakaian->HrefValue = "";
            $this->adl_berpakaian->TooltipValue = "";

            // adl_makan
            $this->adl_makan->LinkCustomAttributes = "";
            $this->adl_makan->HrefValue = "";
            $this->adl_makan->TooltipValue = "";

            // adl_bak
            $this->adl_bak->LinkCustomAttributes = "";
            $this->adl_bak->HrefValue = "";
            $this->adl_bak->TooltipValue = "";

            // adl_bab
            $this->adl_bab->LinkCustomAttributes = "";
            $this->adl_bab->HrefValue = "";
            $this->adl_bab->TooltipValue = "";

            // adl_hobi
            $this->adl_hobi->LinkCustomAttributes = "";
            $this->adl_hobi->HrefValue = "";
            $this->adl_hobi->TooltipValue = "";

            // ket_adl_hobi
            $this->ket_adl_hobi->LinkCustomAttributes = "";
            $this->ket_adl_hobi->HrefValue = "";
            $this->ket_adl_hobi->TooltipValue = "";

            // adl_sosialisasi
            $this->adl_sosialisasi->LinkCustomAttributes = "";
            $this->adl_sosialisasi->HrefValue = "";
            $this->adl_sosialisasi->TooltipValue = "";

            // ket_adl_sosialisasi
            $this->ket_adl_sosialisasi->LinkCustomAttributes = "";
            $this->ket_adl_sosialisasi->HrefValue = "";
            $this->ket_adl_sosialisasi->TooltipValue = "";

            // adl_kegiatan
            $this->adl_kegiatan->LinkCustomAttributes = "";
            $this->adl_kegiatan->HrefValue = "";
            $this->adl_kegiatan->TooltipValue = "";

            // ket_adl_kegiatan
            $this->ket_adl_kegiatan->LinkCustomAttributes = "";
            $this->ket_adl_kegiatan->HrefValue = "";
            $this->ket_adl_kegiatan->TooltipValue = "";

            // sk_penampilan
            $this->sk_penampilan->LinkCustomAttributes = "";
            $this->sk_penampilan->HrefValue = "";
            $this->sk_penampilan->TooltipValue = "";

            // sk_alam_perasaan
            $this->sk_alam_perasaan->LinkCustomAttributes = "";
            $this->sk_alam_perasaan->HrefValue = "";
            $this->sk_alam_perasaan->TooltipValue = "";

            // sk_pembicaraan
            $this->sk_pembicaraan->LinkCustomAttributes = "";
            $this->sk_pembicaraan->HrefValue = "";
            $this->sk_pembicaraan->TooltipValue = "";

            // sk_afek
            $this->sk_afek->LinkCustomAttributes = "";
            $this->sk_afek->HrefValue = "";
            $this->sk_afek->TooltipValue = "";

            // sk_aktifitas_motorik
            $this->sk_aktifitas_motorik->LinkCustomAttributes = "";
            $this->sk_aktifitas_motorik->HrefValue = "";
            $this->sk_aktifitas_motorik->TooltipValue = "";

            // sk_gangguan_ringan
            $this->sk_gangguan_ringan->LinkCustomAttributes = "";
            $this->sk_gangguan_ringan->HrefValue = "";
            $this->sk_gangguan_ringan->TooltipValue = "";

            // sk_proses_pikir
            $this->sk_proses_pikir->LinkCustomAttributes = "";
            $this->sk_proses_pikir->HrefValue = "";
            $this->sk_proses_pikir->TooltipValue = "";

            // sk_orientasi
            $this->sk_orientasi->LinkCustomAttributes = "";
            $this->sk_orientasi->HrefValue = "";
            $this->sk_orientasi->TooltipValue = "";

            // sk_tingkat_kesadaran_orientasi
            $this->sk_tingkat_kesadaran_orientasi->LinkCustomAttributes = "";
            $this->sk_tingkat_kesadaran_orientasi->HrefValue = "";
            $this->sk_tingkat_kesadaran_orientasi->TooltipValue = "";

            // sk_memori
            $this->sk_memori->LinkCustomAttributes = "";
            $this->sk_memori->HrefValue = "";
            $this->sk_memori->TooltipValue = "";

            // sk_interaksi
            $this->sk_interaksi->LinkCustomAttributes = "";
            $this->sk_interaksi->HrefValue = "";
            $this->sk_interaksi->TooltipValue = "";

            // sk_konsentrasi
            $this->sk_konsentrasi->LinkCustomAttributes = "";
            $this->sk_konsentrasi->HrefValue = "";
            $this->sk_konsentrasi->TooltipValue = "";

            // sk_persepsi
            $this->sk_persepsi->LinkCustomAttributes = "";
            $this->sk_persepsi->HrefValue = "";
            $this->sk_persepsi->TooltipValue = "";

            // ket_sk_persepsi
            $this->ket_sk_persepsi->LinkCustomAttributes = "";
            $this->ket_sk_persepsi->HrefValue = "";
            $this->ket_sk_persepsi->TooltipValue = "";

            // sk_isi_pikir
            $this->sk_isi_pikir->LinkCustomAttributes = "";
            $this->sk_isi_pikir->HrefValue = "";
            $this->sk_isi_pikir->TooltipValue = "";

            // sk_waham
            $this->sk_waham->LinkCustomAttributes = "";
            $this->sk_waham->HrefValue = "";
            $this->sk_waham->TooltipValue = "";

            // ket_sk_waham
            $this->ket_sk_waham->LinkCustomAttributes = "";
            $this->ket_sk_waham->HrefValue = "";
            $this->ket_sk_waham->TooltipValue = "";

            // sk_daya_tilik_diri
            $this->sk_daya_tilik_diri->LinkCustomAttributes = "";
            $this->sk_daya_tilik_diri->HrefValue = "";
            $this->sk_daya_tilik_diri->TooltipValue = "";

            // ket_sk_daya_tilik_diri
            $this->ket_sk_daya_tilik_diri->LinkCustomAttributes = "";
            $this->ket_sk_daya_tilik_diri->HrefValue = "";
            $this->ket_sk_daya_tilik_diri->TooltipValue = "";

            // kk_pembelajaran
            $this->kk_pembelajaran->LinkCustomAttributes = "";
            $this->kk_pembelajaran->HrefValue = "";
            $this->kk_pembelajaran->TooltipValue = "";

            // ket_kk_pembelajaran
            $this->ket_kk_pembelajaran->LinkCustomAttributes = "";
            $this->ket_kk_pembelajaran->HrefValue = "";
            $this->ket_kk_pembelajaran->TooltipValue = "";

            // ket_kk_pembelajaran_lainnya
            $this->ket_kk_pembelajaran_lainnya->LinkCustomAttributes = "";
            $this->ket_kk_pembelajaran_lainnya->HrefValue = "";
            $this->ket_kk_pembelajaran_lainnya->TooltipValue = "";

            // kk_Penerjamah
            $this->kk_Penerjamah->LinkCustomAttributes = "";
            $this->kk_Penerjamah->HrefValue = "";
            $this->kk_Penerjamah->TooltipValue = "";

            // ket_kk_penerjamah_Lainnya
            $this->ket_kk_penerjamah_Lainnya->LinkCustomAttributes = "";
            $this->ket_kk_penerjamah_Lainnya->HrefValue = "";
            $this->ket_kk_penerjamah_Lainnya->TooltipValue = "";

            // kk_bahasa_isyarat
            $this->kk_bahasa_isyarat->LinkCustomAttributes = "";
            $this->kk_bahasa_isyarat->HrefValue = "";
            $this->kk_bahasa_isyarat->TooltipValue = "";

            // kk_kebutuhan_edukasi
            $this->kk_kebutuhan_edukasi->LinkCustomAttributes = "";
            $this->kk_kebutuhan_edukasi->HrefValue = "";
            $this->kk_kebutuhan_edukasi->TooltipValue = "";

            // ket_kk_kebutuhan_edukasi
            $this->ket_kk_kebutuhan_edukasi->LinkCustomAttributes = "";
            $this->ket_kk_kebutuhan_edukasi->HrefValue = "";
            $this->ket_kk_kebutuhan_edukasi->TooltipValue = "";

            // rencana
            $this->rencana->LinkCustomAttributes = "";
            $this->rencana->HrefValue = "";
            $this->rencana->TooltipValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";
            $this->nip->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fpenilaian_awal_keperawatan_ralan_psikiatrilist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fpenilaian_awal_keperawatan_ralan_psikiatrilist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fpenilaian_awal_keperawatan_ralan_psikiatrilist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ",url:'" . $pageUrl . "export=email&amp;custom=1'" : "";
            return '<button id="emf_penilaian_awal_keperawatan_ralan_psikiatri" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_penilaian_awal_keperawatan_ralan_psikiatri\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fpenilaian_awal_keperawatan_ralan_psikiatrilist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = false;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to Html
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to Xml
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to Csv
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = false;

        // Export to Pdf
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = false;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions("div");
        $this->SearchOptions->TagClassName = "ew-search-option";

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpenilaian_awal_keperawatan_ralan_psikiatrilistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
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

            // Update URL
            $this->AddUrl = $this->addMasterUrl($this->AddUrl);
            $this->InlineAddUrl = $this->addMasterUrl($this->InlineAddUrl);
            $this->GridAddUrl = $this->addMasterUrl($this->GridAddUrl);
            $this->GridEditUrl = $this->addMasterUrl($this->GridEditUrl);

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
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
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
                case "x_rkd_berobat":
                    break;
                case "x_rkd_hasil_pengobatan":
                    break;
                case "x_fp_putus_obat":
                    break;
                case "x_fp_ekonomi":
                    break;
                case "x_fp_masalah_fisik":
                    break;
                case "x_fp_masalah_psikososial":
                    break;
                case "x_rh_keluarga":
                    break;
                case "x_resiko_bunuh_diri":
                    break;
                case "x_rbd_ide":
                    break;
                case "x_rbd_rencana":
                    break;
                case "x_rbd_alat":
                    break;
                case "x_rbd_percobaan":
                    break;
                case "x_rbd_keinginan":
                    break;
                case "x_rpo_penggunaan":
                    break;
                case "x_rpo_efek_samping":
                    break;
                case "x_rpo_napza":
                    break;
                case "x_rpo_penggunaan_obat_lainnya":
                    break;
                case "x_rpo_alergi_obat":
                    break;
                case "x_rpo_merokok":
                    break;
                case "x_rpo_minum_kopi":
                    break;
                case "x_pf_keluhan_fisik":
                    break;
                case "x_skala_nyeri":
                    break;
                case "x_nyeri":
                    break;
                case "x_provokes":
                    break;
                case "x_quality":
                    break;
                case "x_menyebar":
                    break;
                case "x_pada_dokter":
                    break;
                case "x_nyeri_hilang":
                    break;
                case "x_lapor_status_nutrisi":
                    break;
                case "x_sg1":
                    break;
                case "x_nilai1":
                    break;
                case "x_sg2":
                    break;
                case "x_nilai2":
                    break;
                case "x_resikojatuh":
                    break;
                case "x_bjm":
                    break;
                case "x_msa":
                    break;
                case "x_hasil":
                    break;
                case "x_lapor":
                    break;
                case "x_adl_mandi":
                    break;
                case "x_adl_berpakaian":
                    break;
                case "x_adl_makan":
                    break;
                case "x_adl_bak":
                    break;
                case "x_adl_bab":
                    break;
                case "x_adl_hobi":
                    break;
                case "x_adl_sosialisasi":
                    break;
                case "x_adl_kegiatan":
                    break;
                case "x_sk_penampilan":
                    break;
                case "x_sk_alam_perasaan":
                    break;
                case "x_sk_pembicaraan":
                    break;
                case "x_sk_afek":
                    break;
                case "x_sk_aktifitas_motorik":
                    break;
                case "x_sk_gangguan_ringan":
                    break;
                case "x_sk_proses_pikir":
                    break;
                case "x_sk_orientasi":
                    break;
                case "x_sk_tingkat_kesadaran_orientasi":
                    break;
                case "x_sk_memori":
                    break;
                case "x_sk_interaksi":
                    break;
                case "x_sk_konsentrasi":
                    break;
                case "x_sk_persepsi":
                    break;
                case "x_sk_isi_pikir":
                    break;
                case "x_sk_waham":
                    break;
                case "x_sk_daya_tilik_diri":
                    break;
                case "x_kk_pembelajaran":
                    break;
                case "x_ket_kk_pembelajaran":
                    break;
                case "x_kk_Penerjamah":
                    break;
                case "x_kk_bahasa_isyarat":
                    break;
                case "x_kk_kebutuhan_edukasi":
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

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
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

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
