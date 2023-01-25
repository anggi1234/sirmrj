<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianAwalKeperawatanRalanPsikiatriEdit extends PenilaianAwalKeperawatanRalanPsikiatri
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_awal_keperawatan_ralan_psikiatri';

    // Page object name
    public $PageObjName = "PenilaianAwalKeperawatanRalanPsikiatriEdit";

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

        // Table object (penilaian_awal_keperawatan_ralan_psikiatri)
        if (!isset($GLOBALS["penilaian_awal_keperawatan_ralan_psikiatri"]) || get_class($GLOBALS["penilaian_awal_keperawatan_ralan_psikiatri"]) == PROJECT_NAMESPACE . "penilaian_awal_keperawatan_ralan_psikiatri") {
            $GLOBALS["penilaian_awal_keperawatan_ralan_psikiatri"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "PenilaianAwalKeperawatanRalanPsikiatriView") {
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
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setVisibility();
        $this->no_rawat->setVisibility();
        $this->tanggal->setVisibility();
        $this->informasi->setVisibility();
        $this->keluhan_utama->setVisibility();
        $this->rkd_sakit_sejak->setVisibility();
        $this->rkd_keluhan->setVisibility();
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
            if (($keyValue = Get("id_penilaian_awal_keperawatan_ralan_psikiatri") ?? Key(0) ?? Route(2)) !== null) {
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setQueryStringValue($keyValue);
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setOldValue($this->id_penilaian_awal_keperawatan_ralan_psikiatri->QueryStringValue);
            } elseif (Post("id_penilaian_awal_keperawatan_ralan_psikiatri") !== null) {
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setFormValue(Post("id_penilaian_awal_keperawatan_ralan_psikiatri"));
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setOldValue($this->id_penilaian_awal_keperawatan_ralan_psikiatri->FormValue);
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
                if (($keyValue = Get("id_penilaian_awal_keperawatan_ralan_psikiatri") ?? Route("id_penilaian_awal_keperawatan_ralan_psikiatri")) !== null) {
                    $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue = null;
                }
            }

            // Set up master detail parameters
            $this->setupMasterParms();

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
                    $this->terminate("PenilaianAwalKeperawatanRalanPsikiatriList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "PenilaianAwalKeperawatanRalanPsikiatriList") {
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

        // Check field name 'id_penilaian_awal_keperawatan_ralan_psikiatri' first before field var 'x_id_penilaian_awal_keperawatan_ralan_psikiatri'
        $val = $CurrentForm->hasValue("id_penilaian_awal_keperawatan_ralan_psikiatri") ? $CurrentForm->getValue("id_penilaian_awal_keperawatan_ralan_psikiatri") : $CurrentForm->getValue("x_id_penilaian_awal_keperawatan_ralan_psikiatri");
        if (!$this->id_penilaian_awal_keperawatan_ralan_psikiatri->IsDetailKey) {
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setFormValue($val);
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

        // Check field name 'informasi' first before field var 'x_informasi'
        $val = $CurrentForm->hasValue("informasi") ? $CurrentForm->getValue("informasi") : $CurrentForm->getValue("x_informasi");
        if (!$this->informasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->informasi->Visible = false; // Disable update for API request
            } else {
                $this->informasi->setFormValue($val);
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

        // Check field name 'rkd_sakit_sejak' first before field var 'x_rkd_sakit_sejak'
        $val = $CurrentForm->hasValue("rkd_sakit_sejak") ? $CurrentForm->getValue("rkd_sakit_sejak") : $CurrentForm->getValue("x_rkd_sakit_sejak");
        if (!$this->rkd_sakit_sejak->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rkd_sakit_sejak->Visible = false; // Disable update for API request
            } else {
                $this->rkd_sakit_sejak->setFormValue($val);
            }
        }

        // Check field name 'rkd_keluhan' first before field var 'x_rkd_keluhan'
        $val = $CurrentForm->hasValue("rkd_keluhan") ? $CurrentForm->getValue("rkd_keluhan") : $CurrentForm->getValue("x_rkd_keluhan");
        if (!$this->rkd_keluhan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rkd_keluhan->Visible = false; // Disable update for API request
            } else {
                $this->rkd_keluhan->setFormValue($val);
            }
        }

        // Check field name 'rkd_berobat' first before field var 'x_rkd_berobat'
        $val = $CurrentForm->hasValue("rkd_berobat") ? $CurrentForm->getValue("rkd_berobat") : $CurrentForm->getValue("x_rkd_berobat");
        if (!$this->rkd_berobat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rkd_berobat->Visible = false; // Disable update for API request
            } else {
                $this->rkd_berobat->setFormValue($val);
            }
        }

        // Check field name 'rkd_hasil_pengobatan' first before field var 'x_rkd_hasil_pengobatan'
        $val = $CurrentForm->hasValue("rkd_hasil_pengobatan") ? $CurrentForm->getValue("rkd_hasil_pengobatan") : $CurrentForm->getValue("x_rkd_hasil_pengobatan");
        if (!$this->rkd_hasil_pengobatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rkd_hasil_pengobatan->Visible = false; // Disable update for API request
            } else {
                $this->rkd_hasil_pengobatan->setFormValue($val);
            }
        }

        // Check field name 'fp_putus_obat' first before field var 'x_fp_putus_obat'
        $val = $CurrentForm->hasValue("fp_putus_obat") ? $CurrentForm->getValue("fp_putus_obat") : $CurrentForm->getValue("x_fp_putus_obat");
        if (!$this->fp_putus_obat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fp_putus_obat->Visible = false; // Disable update for API request
            } else {
                $this->fp_putus_obat->setFormValue($val);
            }
        }

        // Check field name 'ket_putus_obat' first before field var 'x_ket_putus_obat'
        $val = $CurrentForm->hasValue("ket_putus_obat") ? $CurrentForm->getValue("ket_putus_obat") : $CurrentForm->getValue("x_ket_putus_obat");
        if (!$this->ket_putus_obat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_putus_obat->Visible = false; // Disable update for API request
            } else {
                $this->ket_putus_obat->setFormValue($val);
            }
        }

        // Check field name 'fp_ekonomi' first before field var 'x_fp_ekonomi'
        $val = $CurrentForm->hasValue("fp_ekonomi") ? $CurrentForm->getValue("fp_ekonomi") : $CurrentForm->getValue("x_fp_ekonomi");
        if (!$this->fp_ekonomi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fp_ekonomi->Visible = false; // Disable update for API request
            } else {
                $this->fp_ekonomi->setFormValue($val);
            }
        }

        // Check field name 'ket_masalah_ekonomi' first before field var 'x_ket_masalah_ekonomi'
        $val = $CurrentForm->hasValue("ket_masalah_ekonomi") ? $CurrentForm->getValue("ket_masalah_ekonomi") : $CurrentForm->getValue("x_ket_masalah_ekonomi");
        if (!$this->ket_masalah_ekonomi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_masalah_ekonomi->Visible = false; // Disable update for API request
            } else {
                $this->ket_masalah_ekonomi->setFormValue($val);
            }
        }

        // Check field name 'fp_masalah_fisik' first before field var 'x_fp_masalah_fisik'
        $val = $CurrentForm->hasValue("fp_masalah_fisik") ? $CurrentForm->getValue("fp_masalah_fisik") : $CurrentForm->getValue("x_fp_masalah_fisik");
        if (!$this->fp_masalah_fisik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fp_masalah_fisik->Visible = false; // Disable update for API request
            } else {
                $this->fp_masalah_fisik->setFormValue($val);
            }
        }

        // Check field name 'ket_masalah_fisik' first before field var 'x_ket_masalah_fisik'
        $val = $CurrentForm->hasValue("ket_masalah_fisik") ? $CurrentForm->getValue("ket_masalah_fisik") : $CurrentForm->getValue("x_ket_masalah_fisik");
        if (!$this->ket_masalah_fisik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_masalah_fisik->Visible = false; // Disable update for API request
            } else {
                $this->ket_masalah_fisik->setFormValue($val);
            }
        }

        // Check field name 'fp_masalah_psikososial' first before field var 'x_fp_masalah_psikososial'
        $val = $CurrentForm->hasValue("fp_masalah_psikososial") ? $CurrentForm->getValue("fp_masalah_psikososial") : $CurrentForm->getValue("x_fp_masalah_psikososial");
        if (!$this->fp_masalah_psikososial->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fp_masalah_psikososial->Visible = false; // Disable update for API request
            } else {
                $this->fp_masalah_psikososial->setFormValue($val);
            }
        }

        // Check field name 'ket_masalah_psikososial' first before field var 'x_ket_masalah_psikososial'
        $val = $CurrentForm->hasValue("ket_masalah_psikososial") ? $CurrentForm->getValue("ket_masalah_psikososial") : $CurrentForm->getValue("x_ket_masalah_psikososial");
        if (!$this->ket_masalah_psikososial->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_masalah_psikososial->Visible = false; // Disable update for API request
            } else {
                $this->ket_masalah_psikososial->setFormValue($val);
            }
        }

        // Check field name 'rh_keluarga' first before field var 'x_rh_keluarga'
        $val = $CurrentForm->hasValue("rh_keluarga") ? $CurrentForm->getValue("rh_keluarga") : $CurrentForm->getValue("x_rh_keluarga");
        if (!$this->rh_keluarga->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rh_keluarga->Visible = false; // Disable update for API request
            } else {
                $this->rh_keluarga->setFormValue($val);
            }
        }

        // Check field name 'ket_rh_keluarga' first before field var 'x_ket_rh_keluarga'
        $val = $CurrentForm->hasValue("ket_rh_keluarga") ? $CurrentForm->getValue("ket_rh_keluarga") : $CurrentForm->getValue("x_ket_rh_keluarga");
        if (!$this->ket_rh_keluarga->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rh_keluarga->Visible = false; // Disable update for API request
            } else {
                $this->ket_rh_keluarga->setFormValue($val);
            }
        }

        // Check field name 'resiko_bunuh_diri' first before field var 'x_resiko_bunuh_diri'
        $val = $CurrentForm->hasValue("resiko_bunuh_diri") ? $CurrentForm->getValue("resiko_bunuh_diri") : $CurrentForm->getValue("x_resiko_bunuh_diri");
        if (!$this->resiko_bunuh_diri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->resiko_bunuh_diri->Visible = false; // Disable update for API request
            } else {
                $this->resiko_bunuh_diri->setFormValue($val);
            }
        }

        // Check field name 'rbd_ide' first before field var 'x_rbd_ide'
        $val = $CurrentForm->hasValue("rbd_ide") ? $CurrentForm->getValue("rbd_ide") : $CurrentForm->getValue("x_rbd_ide");
        if (!$this->rbd_ide->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rbd_ide->Visible = false; // Disable update for API request
            } else {
                $this->rbd_ide->setFormValue($val);
            }
        }

        // Check field name 'ket_rbd_ide' first before field var 'x_ket_rbd_ide'
        $val = $CurrentForm->hasValue("ket_rbd_ide") ? $CurrentForm->getValue("ket_rbd_ide") : $CurrentForm->getValue("x_ket_rbd_ide");
        if (!$this->ket_rbd_ide->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rbd_ide->Visible = false; // Disable update for API request
            } else {
                $this->ket_rbd_ide->setFormValue($val);
            }
        }

        // Check field name 'rbd_rencana' first before field var 'x_rbd_rencana'
        $val = $CurrentForm->hasValue("rbd_rencana") ? $CurrentForm->getValue("rbd_rencana") : $CurrentForm->getValue("x_rbd_rencana");
        if (!$this->rbd_rencana->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rbd_rencana->Visible = false; // Disable update for API request
            } else {
                $this->rbd_rencana->setFormValue($val);
            }
        }

        // Check field name 'ket_rbd_rencana' first before field var 'x_ket_rbd_rencana'
        $val = $CurrentForm->hasValue("ket_rbd_rencana") ? $CurrentForm->getValue("ket_rbd_rencana") : $CurrentForm->getValue("x_ket_rbd_rencana");
        if (!$this->ket_rbd_rencana->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rbd_rencana->Visible = false; // Disable update for API request
            } else {
                $this->ket_rbd_rencana->setFormValue($val);
            }
        }

        // Check field name 'rbd_alat' first before field var 'x_rbd_alat'
        $val = $CurrentForm->hasValue("rbd_alat") ? $CurrentForm->getValue("rbd_alat") : $CurrentForm->getValue("x_rbd_alat");
        if (!$this->rbd_alat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rbd_alat->Visible = false; // Disable update for API request
            } else {
                $this->rbd_alat->setFormValue($val);
            }
        }

        // Check field name 'ket_rbd_alat' first before field var 'x_ket_rbd_alat'
        $val = $CurrentForm->hasValue("ket_rbd_alat") ? $CurrentForm->getValue("ket_rbd_alat") : $CurrentForm->getValue("x_ket_rbd_alat");
        if (!$this->ket_rbd_alat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rbd_alat->Visible = false; // Disable update for API request
            } else {
                $this->ket_rbd_alat->setFormValue($val);
            }
        }

        // Check field name 'rbd_percobaan' first before field var 'x_rbd_percobaan'
        $val = $CurrentForm->hasValue("rbd_percobaan") ? $CurrentForm->getValue("rbd_percobaan") : $CurrentForm->getValue("x_rbd_percobaan");
        if (!$this->rbd_percobaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rbd_percobaan->Visible = false; // Disable update for API request
            } else {
                $this->rbd_percobaan->setFormValue($val);
            }
        }

        // Check field name 'ket_rbd_percobaan' first before field var 'x_ket_rbd_percobaan'
        $val = $CurrentForm->hasValue("ket_rbd_percobaan") ? $CurrentForm->getValue("ket_rbd_percobaan") : $CurrentForm->getValue("x_ket_rbd_percobaan");
        if (!$this->ket_rbd_percobaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rbd_percobaan->Visible = false; // Disable update for API request
            } else {
                $this->ket_rbd_percobaan->setFormValue($val);
            }
        }

        // Check field name 'rbd_keinginan' first before field var 'x_rbd_keinginan'
        $val = $CurrentForm->hasValue("rbd_keinginan") ? $CurrentForm->getValue("rbd_keinginan") : $CurrentForm->getValue("x_rbd_keinginan");
        if (!$this->rbd_keinginan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rbd_keinginan->Visible = false; // Disable update for API request
            } else {
                $this->rbd_keinginan->setFormValue($val);
            }
        }

        // Check field name 'ket_rbd_keinginan' first before field var 'x_ket_rbd_keinginan'
        $val = $CurrentForm->hasValue("ket_rbd_keinginan") ? $CurrentForm->getValue("ket_rbd_keinginan") : $CurrentForm->getValue("x_ket_rbd_keinginan");
        if (!$this->ket_rbd_keinginan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rbd_keinginan->Visible = false; // Disable update for API request
            } else {
                $this->ket_rbd_keinginan->setFormValue($val);
            }
        }

        // Check field name 'rpo_penggunaan' first before field var 'x_rpo_penggunaan'
        $val = $CurrentForm->hasValue("rpo_penggunaan") ? $CurrentForm->getValue("rpo_penggunaan") : $CurrentForm->getValue("x_rpo_penggunaan");
        if (!$this->rpo_penggunaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo_penggunaan->Visible = false; // Disable update for API request
            } else {
                $this->rpo_penggunaan->setFormValue($val);
            }
        }

        // Check field name 'ket_rpo_penggunaan' first before field var 'x_ket_rpo_penggunaan'
        $val = $CurrentForm->hasValue("ket_rpo_penggunaan") ? $CurrentForm->getValue("ket_rpo_penggunaan") : $CurrentForm->getValue("x_ket_rpo_penggunaan");
        if (!$this->ket_rpo_penggunaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rpo_penggunaan->Visible = false; // Disable update for API request
            } else {
                $this->ket_rpo_penggunaan->setFormValue($val);
            }
        }

        // Check field name 'rpo_efek_samping' first before field var 'x_rpo_efek_samping'
        $val = $CurrentForm->hasValue("rpo_efek_samping") ? $CurrentForm->getValue("rpo_efek_samping") : $CurrentForm->getValue("x_rpo_efek_samping");
        if (!$this->rpo_efek_samping->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo_efek_samping->Visible = false; // Disable update for API request
            } else {
                $this->rpo_efek_samping->setFormValue($val);
            }
        }

        // Check field name 'ket_rpo_efek_samping' first before field var 'x_ket_rpo_efek_samping'
        $val = $CurrentForm->hasValue("ket_rpo_efek_samping") ? $CurrentForm->getValue("ket_rpo_efek_samping") : $CurrentForm->getValue("x_ket_rpo_efek_samping");
        if (!$this->ket_rpo_efek_samping->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rpo_efek_samping->Visible = false; // Disable update for API request
            } else {
                $this->ket_rpo_efek_samping->setFormValue($val);
            }
        }

        // Check field name 'rpo_napza' first before field var 'x_rpo_napza'
        $val = $CurrentForm->hasValue("rpo_napza") ? $CurrentForm->getValue("rpo_napza") : $CurrentForm->getValue("x_rpo_napza");
        if (!$this->rpo_napza->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo_napza->Visible = false; // Disable update for API request
            } else {
                $this->rpo_napza->setFormValue($val);
            }
        }

        // Check field name 'ket_rpo_napza' first before field var 'x_ket_rpo_napza'
        $val = $CurrentForm->hasValue("ket_rpo_napza") ? $CurrentForm->getValue("ket_rpo_napza") : $CurrentForm->getValue("x_ket_rpo_napza");
        if (!$this->ket_rpo_napza->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_rpo_napza->Visible = false; // Disable update for API request
            } else {
                $this->ket_rpo_napza->setFormValue($val);
            }
        }

        // Check field name 'ket_lama_pemakaian' first before field var 'x_ket_lama_pemakaian'
        $val = $CurrentForm->hasValue("ket_lama_pemakaian") ? $CurrentForm->getValue("ket_lama_pemakaian") : $CurrentForm->getValue("x_ket_lama_pemakaian");
        if (!$this->ket_lama_pemakaian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_lama_pemakaian->Visible = false; // Disable update for API request
            } else {
                $this->ket_lama_pemakaian->setFormValue($val);
            }
        }

        // Check field name 'ket_cara_pemakaian' first before field var 'x_ket_cara_pemakaian'
        $val = $CurrentForm->hasValue("ket_cara_pemakaian") ? $CurrentForm->getValue("ket_cara_pemakaian") : $CurrentForm->getValue("x_ket_cara_pemakaian");
        if (!$this->ket_cara_pemakaian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_cara_pemakaian->Visible = false; // Disable update for API request
            } else {
                $this->ket_cara_pemakaian->setFormValue($val);
            }
        }

        // Check field name 'ket_latar_belakang_pemakaian' first before field var 'x_ket_latar_belakang_pemakaian'
        $val = $CurrentForm->hasValue("ket_latar_belakang_pemakaian") ? $CurrentForm->getValue("ket_latar_belakang_pemakaian") : $CurrentForm->getValue("x_ket_latar_belakang_pemakaian");
        if (!$this->ket_latar_belakang_pemakaian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_latar_belakang_pemakaian->Visible = false; // Disable update for API request
            } else {
                $this->ket_latar_belakang_pemakaian->setFormValue($val);
            }
        }

        // Check field name 'rpo_penggunaan_obat_lainnya' first before field var 'x_rpo_penggunaan_obat_lainnya'
        $val = $CurrentForm->hasValue("rpo_penggunaan_obat_lainnya") ? $CurrentForm->getValue("rpo_penggunaan_obat_lainnya") : $CurrentForm->getValue("x_rpo_penggunaan_obat_lainnya");
        if (!$this->rpo_penggunaan_obat_lainnya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo_penggunaan_obat_lainnya->Visible = false; // Disable update for API request
            } else {
                $this->rpo_penggunaan_obat_lainnya->setFormValue($val);
            }
        }

        // Check field name 'ket_penggunaan_obat_lainnya' first before field var 'x_ket_penggunaan_obat_lainnya'
        $val = $CurrentForm->hasValue("ket_penggunaan_obat_lainnya") ? $CurrentForm->getValue("ket_penggunaan_obat_lainnya") : $CurrentForm->getValue("x_ket_penggunaan_obat_lainnya");
        if (!$this->ket_penggunaan_obat_lainnya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_penggunaan_obat_lainnya->Visible = false; // Disable update for API request
            } else {
                $this->ket_penggunaan_obat_lainnya->setFormValue($val);
            }
        }

        // Check field name 'ket_alasan_penggunaan' first before field var 'x_ket_alasan_penggunaan'
        $val = $CurrentForm->hasValue("ket_alasan_penggunaan") ? $CurrentForm->getValue("ket_alasan_penggunaan") : $CurrentForm->getValue("x_ket_alasan_penggunaan");
        if (!$this->ket_alasan_penggunaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_alasan_penggunaan->Visible = false; // Disable update for API request
            } else {
                $this->ket_alasan_penggunaan->setFormValue($val);
            }
        }

        // Check field name 'rpo_alergi_obat' first before field var 'x_rpo_alergi_obat'
        $val = $CurrentForm->hasValue("rpo_alergi_obat") ? $CurrentForm->getValue("rpo_alergi_obat") : $CurrentForm->getValue("x_rpo_alergi_obat");
        if (!$this->rpo_alergi_obat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo_alergi_obat->Visible = false; // Disable update for API request
            } else {
                $this->rpo_alergi_obat->setFormValue($val);
            }
        }

        // Check field name 'ket_alergi_obat' first before field var 'x_ket_alergi_obat'
        $val = $CurrentForm->hasValue("ket_alergi_obat") ? $CurrentForm->getValue("ket_alergi_obat") : $CurrentForm->getValue("x_ket_alergi_obat");
        if (!$this->ket_alergi_obat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_alergi_obat->Visible = false; // Disable update for API request
            } else {
                $this->ket_alergi_obat->setFormValue($val);
            }
        }

        // Check field name 'rpo_merokok' first before field var 'x_rpo_merokok'
        $val = $CurrentForm->hasValue("rpo_merokok") ? $CurrentForm->getValue("rpo_merokok") : $CurrentForm->getValue("x_rpo_merokok");
        if (!$this->rpo_merokok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo_merokok->Visible = false; // Disable update for API request
            } else {
                $this->rpo_merokok->setFormValue($val);
            }
        }

        // Check field name 'ket_merokok' first before field var 'x_ket_merokok'
        $val = $CurrentForm->hasValue("ket_merokok") ? $CurrentForm->getValue("ket_merokok") : $CurrentForm->getValue("x_ket_merokok");
        if (!$this->ket_merokok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_merokok->Visible = false; // Disable update for API request
            } else {
                $this->ket_merokok->setFormValue($val);
            }
        }

        // Check field name 'rpo_minum_kopi' first before field var 'x_rpo_minum_kopi'
        $val = $CurrentForm->hasValue("rpo_minum_kopi") ? $CurrentForm->getValue("rpo_minum_kopi") : $CurrentForm->getValue("x_rpo_minum_kopi");
        if (!$this->rpo_minum_kopi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rpo_minum_kopi->Visible = false; // Disable update for API request
            } else {
                $this->rpo_minum_kopi->setFormValue($val);
            }
        }

        // Check field name 'ket_minum_kopi' first before field var 'x_ket_minum_kopi'
        $val = $CurrentForm->hasValue("ket_minum_kopi") ? $CurrentForm->getValue("ket_minum_kopi") : $CurrentForm->getValue("x_ket_minum_kopi");
        if (!$this->ket_minum_kopi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_minum_kopi->Visible = false; // Disable update for API request
            } else {
                $this->ket_minum_kopi->setFormValue($val);
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

        // Check field name 'gcs' first before field var 'x_gcs'
        $val = $CurrentForm->hasValue("gcs") ? $CurrentForm->getValue("gcs") : $CurrentForm->getValue("x_gcs");
        if (!$this->gcs->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gcs->Visible = false; // Disable update for API request
            } else {
                $this->gcs->setFormValue($val);
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

        // Check field name 'pf_keluhan_fisik' first before field var 'x_pf_keluhan_fisik'
        $val = $CurrentForm->hasValue("pf_keluhan_fisik") ? $CurrentForm->getValue("pf_keluhan_fisik") : $CurrentForm->getValue("x_pf_keluhan_fisik");
        if (!$this->pf_keluhan_fisik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pf_keluhan_fisik->Visible = false; // Disable update for API request
            } else {
                $this->pf_keluhan_fisik->setFormValue($val);
            }
        }

        // Check field name 'ket_keluhan_fisik' first before field var 'x_ket_keluhan_fisik'
        $val = $CurrentForm->hasValue("ket_keluhan_fisik") ? $CurrentForm->getValue("ket_keluhan_fisik") : $CurrentForm->getValue("x_ket_keluhan_fisik");
        if (!$this->ket_keluhan_fisik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_keluhan_fisik->Visible = false; // Disable update for API request
            } else {
                $this->ket_keluhan_fisik->setFormValue($val);
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

        // Check field name 'lapor_status_nutrisi' first before field var 'x_lapor_status_nutrisi'
        $val = $CurrentForm->hasValue("lapor_status_nutrisi") ? $CurrentForm->getValue("lapor_status_nutrisi") : $CurrentForm->getValue("x_lapor_status_nutrisi");
        if (!$this->lapor_status_nutrisi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lapor_status_nutrisi->Visible = false; // Disable update for API request
            } else {
                $this->lapor_status_nutrisi->setFormValue($val);
            }
        }

        // Check field name 'ket_lapor_status_nutrisi' first before field var 'x_ket_lapor_status_nutrisi'
        $val = $CurrentForm->hasValue("ket_lapor_status_nutrisi") ? $CurrentForm->getValue("ket_lapor_status_nutrisi") : $CurrentForm->getValue("x_ket_lapor_status_nutrisi");
        if (!$this->ket_lapor_status_nutrisi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_lapor_status_nutrisi->Visible = false; // Disable update for API request
            } else {
                $this->ket_lapor_status_nutrisi->setFormValue($val);
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

        // Check field name 'resikojatuh' first before field var 'x_resikojatuh'
        $val = $CurrentForm->hasValue("resikojatuh") ? $CurrentForm->getValue("resikojatuh") : $CurrentForm->getValue("x_resikojatuh");
        if (!$this->resikojatuh->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->resikojatuh->Visible = false; // Disable update for API request
            } else {
                $this->resikojatuh->setFormValue($val);
            }
        }

        // Check field name 'bjm' first before field var 'x_bjm'
        $val = $CurrentForm->hasValue("bjm") ? $CurrentForm->getValue("bjm") : $CurrentForm->getValue("x_bjm");
        if (!$this->bjm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bjm->Visible = false; // Disable update for API request
            } else {
                $this->bjm->setFormValue($val);
            }
        }

        // Check field name 'msa' first before field var 'x_msa'
        $val = $CurrentForm->hasValue("msa") ? $CurrentForm->getValue("msa") : $CurrentForm->getValue("x_msa");
        if (!$this->msa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->msa->Visible = false; // Disable update for API request
            } else {
                $this->msa->setFormValue($val);
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

        // Check field name 'adl_mandi' first before field var 'x_adl_mandi'
        $val = $CurrentForm->hasValue("adl_mandi") ? $CurrentForm->getValue("adl_mandi") : $CurrentForm->getValue("x_adl_mandi");
        if (!$this->adl_mandi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_mandi->Visible = false; // Disable update for API request
            } else {
                $this->adl_mandi->setFormValue($val);
            }
        }

        // Check field name 'adl_berpakaian' first before field var 'x_adl_berpakaian'
        $val = $CurrentForm->hasValue("adl_berpakaian") ? $CurrentForm->getValue("adl_berpakaian") : $CurrentForm->getValue("x_adl_berpakaian");
        if (!$this->adl_berpakaian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_berpakaian->Visible = false; // Disable update for API request
            } else {
                $this->adl_berpakaian->setFormValue($val);
            }
        }

        // Check field name 'adl_makan' first before field var 'x_adl_makan'
        $val = $CurrentForm->hasValue("adl_makan") ? $CurrentForm->getValue("adl_makan") : $CurrentForm->getValue("x_adl_makan");
        if (!$this->adl_makan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_makan->Visible = false; // Disable update for API request
            } else {
                $this->adl_makan->setFormValue($val);
            }
        }

        // Check field name 'adl_bak' first before field var 'x_adl_bak'
        $val = $CurrentForm->hasValue("adl_bak") ? $CurrentForm->getValue("adl_bak") : $CurrentForm->getValue("x_adl_bak");
        if (!$this->adl_bak->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_bak->Visible = false; // Disable update for API request
            } else {
                $this->adl_bak->setFormValue($val);
            }
        }

        // Check field name 'adl_bab' first before field var 'x_adl_bab'
        $val = $CurrentForm->hasValue("adl_bab") ? $CurrentForm->getValue("adl_bab") : $CurrentForm->getValue("x_adl_bab");
        if (!$this->adl_bab->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_bab->Visible = false; // Disable update for API request
            } else {
                $this->adl_bab->setFormValue($val);
            }
        }

        // Check field name 'adl_hobi' first before field var 'x_adl_hobi'
        $val = $CurrentForm->hasValue("adl_hobi") ? $CurrentForm->getValue("adl_hobi") : $CurrentForm->getValue("x_adl_hobi");
        if (!$this->adl_hobi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_hobi->Visible = false; // Disable update for API request
            } else {
                $this->adl_hobi->setFormValue($val);
            }
        }

        // Check field name 'ket_adl_hobi' first before field var 'x_ket_adl_hobi'
        $val = $CurrentForm->hasValue("ket_adl_hobi") ? $CurrentForm->getValue("ket_adl_hobi") : $CurrentForm->getValue("x_ket_adl_hobi");
        if (!$this->ket_adl_hobi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_adl_hobi->Visible = false; // Disable update for API request
            } else {
                $this->ket_adl_hobi->setFormValue($val);
            }
        }

        // Check field name 'adl_sosialisasi' first before field var 'x_adl_sosialisasi'
        $val = $CurrentForm->hasValue("adl_sosialisasi") ? $CurrentForm->getValue("adl_sosialisasi") : $CurrentForm->getValue("x_adl_sosialisasi");
        if (!$this->adl_sosialisasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_sosialisasi->Visible = false; // Disable update for API request
            } else {
                $this->adl_sosialisasi->setFormValue($val);
            }
        }

        // Check field name 'ket_adl_sosialisasi' first before field var 'x_ket_adl_sosialisasi'
        $val = $CurrentForm->hasValue("ket_adl_sosialisasi") ? $CurrentForm->getValue("ket_adl_sosialisasi") : $CurrentForm->getValue("x_ket_adl_sosialisasi");
        if (!$this->ket_adl_sosialisasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_adl_sosialisasi->Visible = false; // Disable update for API request
            } else {
                $this->ket_adl_sosialisasi->setFormValue($val);
            }
        }

        // Check field name 'adl_kegiatan' first before field var 'x_adl_kegiatan'
        $val = $CurrentForm->hasValue("adl_kegiatan") ? $CurrentForm->getValue("adl_kegiatan") : $CurrentForm->getValue("x_adl_kegiatan");
        if (!$this->adl_kegiatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->adl_kegiatan->Visible = false; // Disable update for API request
            } else {
                $this->adl_kegiatan->setFormValue($val);
            }
        }

        // Check field name 'ket_adl_kegiatan' first before field var 'x_ket_adl_kegiatan'
        $val = $CurrentForm->hasValue("ket_adl_kegiatan") ? $CurrentForm->getValue("ket_adl_kegiatan") : $CurrentForm->getValue("x_ket_adl_kegiatan");
        if (!$this->ket_adl_kegiatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_adl_kegiatan->Visible = false; // Disable update for API request
            } else {
                $this->ket_adl_kegiatan->setFormValue($val);
            }
        }

        // Check field name 'sk_penampilan' first before field var 'x_sk_penampilan'
        $val = $CurrentForm->hasValue("sk_penampilan") ? $CurrentForm->getValue("sk_penampilan") : $CurrentForm->getValue("x_sk_penampilan");
        if (!$this->sk_penampilan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_penampilan->Visible = false; // Disable update for API request
            } else {
                $this->sk_penampilan->setFormValue($val);
            }
        }

        // Check field name 'sk_alam_perasaan' first before field var 'x_sk_alam_perasaan'
        $val = $CurrentForm->hasValue("sk_alam_perasaan") ? $CurrentForm->getValue("sk_alam_perasaan") : $CurrentForm->getValue("x_sk_alam_perasaan");
        if (!$this->sk_alam_perasaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_alam_perasaan->Visible = false; // Disable update for API request
            } else {
                $this->sk_alam_perasaan->setFormValue($val);
            }
        }

        // Check field name 'sk_pembicaraan' first before field var 'x_sk_pembicaraan'
        $val = $CurrentForm->hasValue("sk_pembicaraan") ? $CurrentForm->getValue("sk_pembicaraan") : $CurrentForm->getValue("x_sk_pembicaraan");
        if (!$this->sk_pembicaraan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_pembicaraan->Visible = false; // Disable update for API request
            } else {
                $this->sk_pembicaraan->setFormValue($val);
            }
        }

        // Check field name 'sk_afek' first before field var 'x_sk_afek'
        $val = $CurrentForm->hasValue("sk_afek") ? $CurrentForm->getValue("sk_afek") : $CurrentForm->getValue("x_sk_afek");
        if (!$this->sk_afek->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_afek->Visible = false; // Disable update for API request
            } else {
                $this->sk_afek->setFormValue($val);
            }
        }

        // Check field name 'sk_aktifitas_motorik' first before field var 'x_sk_aktifitas_motorik'
        $val = $CurrentForm->hasValue("sk_aktifitas_motorik") ? $CurrentForm->getValue("sk_aktifitas_motorik") : $CurrentForm->getValue("x_sk_aktifitas_motorik");
        if (!$this->sk_aktifitas_motorik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_aktifitas_motorik->Visible = false; // Disable update for API request
            } else {
                $this->sk_aktifitas_motorik->setFormValue($val);
            }
        }

        // Check field name 'sk_gangguan_ringan' first before field var 'x_sk_gangguan_ringan'
        $val = $CurrentForm->hasValue("sk_gangguan_ringan") ? $CurrentForm->getValue("sk_gangguan_ringan") : $CurrentForm->getValue("x_sk_gangguan_ringan");
        if (!$this->sk_gangguan_ringan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_gangguan_ringan->Visible = false; // Disable update for API request
            } else {
                $this->sk_gangguan_ringan->setFormValue($val);
            }
        }

        // Check field name 'sk_proses_pikir' first before field var 'x_sk_proses_pikir'
        $val = $CurrentForm->hasValue("sk_proses_pikir") ? $CurrentForm->getValue("sk_proses_pikir") : $CurrentForm->getValue("x_sk_proses_pikir");
        if (!$this->sk_proses_pikir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_proses_pikir->Visible = false; // Disable update for API request
            } else {
                $this->sk_proses_pikir->setFormValue($val);
            }
        }

        // Check field name 'sk_orientasi' first before field var 'x_sk_orientasi'
        $val = $CurrentForm->hasValue("sk_orientasi") ? $CurrentForm->getValue("sk_orientasi") : $CurrentForm->getValue("x_sk_orientasi");
        if (!$this->sk_orientasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_orientasi->Visible = false; // Disable update for API request
            } else {
                $this->sk_orientasi->setFormValue($val);
            }
        }

        // Check field name 'sk_tingkat_kesadaran_orientasi' first before field var 'x_sk_tingkat_kesadaran_orientasi'
        $val = $CurrentForm->hasValue("sk_tingkat_kesadaran_orientasi") ? $CurrentForm->getValue("sk_tingkat_kesadaran_orientasi") : $CurrentForm->getValue("x_sk_tingkat_kesadaran_orientasi");
        if (!$this->sk_tingkat_kesadaran_orientasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_tingkat_kesadaran_orientasi->Visible = false; // Disable update for API request
            } else {
                $this->sk_tingkat_kesadaran_orientasi->setFormValue($val);
            }
        }

        // Check field name 'sk_memori' first before field var 'x_sk_memori'
        $val = $CurrentForm->hasValue("sk_memori") ? $CurrentForm->getValue("sk_memori") : $CurrentForm->getValue("x_sk_memori");
        if (!$this->sk_memori->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_memori->Visible = false; // Disable update for API request
            } else {
                $this->sk_memori->setFormValue($val);
            }
        }

        // Check field name 'sk_interaksi' first before field var 'x_sk_interaksi'
        $val = $CurrentForm->hasValue("sk_interaksi") ? $CurrentForm->getValue("sk_interaksi") : $CurrentForm->getValue("x_sk_interaksi");
        if (!$this->sk_interaksi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_interaksi->Visible = false; // Disable update for API request
            } else {
                $this->sk_interaksi->setFormValue($val);
            }
        }

        // Check field name 'sk_konsentrasi' first before field var 'x_sk_konsentrasi'
        $val = $CurrentForm->hasValue("sk_konsentrasi") ? $CurrentForm->getValue("sk_konsentrasi") : $CurrentForm->getValue("x_sk_konsentrasi");
        if (!$this->sk_konsentrasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_konsentrasi->Visible = false; // Disable update for API request
            } else {
                $this->sk_konsentrasi->setFormValue($val);
            }
        }

        // Check field name 'sk_persepsi' first before field var 'x_sk_persepsi'
        $val = $CurrentForm->hasValue("sk_persepsi") ? $CurrentForm->getValue("sk_persepsi") : $CurrentForm->getValue("x_sk_persepsi");
        if (!$this->sk_persepsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_persepsi->Visible = false; // Disable update for API request
            } else {
                $this->sk_persepsi->setFormValue($val);
            }
        }

        // Check field name 'ket_sk_persepsi' first before field var 'x_ket_sk_persepsi'
        $val = $CurrentForm->hasValue("ket_sk_persepsi") ? $CurrentForm->getValue("ket_sk_persepsi") : $CurrentForm->getValue("x_ket_sk_persepsi");
        if (!$this->ket_sk_persepsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_sk_persepsi->Visible = false; // Disable update for API request
            } else {
                $this->ket_sk_persepsi->setFormValue($val);
            }
        }

        // Check field name 'sk_isi_pikir' first before field var 'x_sk_isi_pikir'
        $val = $CurrentForm->hasValue("sk_isi_pikir") ? $CurrentForm->getValue("sk_isi_pikir") : $CurrentForm->getValue("x_sk_isi_pikir");
        if (!$this->sk_isi_pikir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_isi_pikir->Visible = false; // Disable update for API request
            } else {
                $this->sk_isi_pikir->setFormValue($val);
            }
        }

        // Check field name 'sk_waham' first before field var 'x_sk_waham'
        $val = $CurrentForm->hasValue("sk_waham") ? $CurrentForm->getValue("sk_waham") : $CurrentForm->getValue("x_sk_waham");
        if (!$this->sk_waham->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_waham->Visible = false; // Disable update for API request
            } else {
                $this->sk_waham->setFormValue($val);
            }
        }

        // Check field name 'ket_sk_waham' first before field var 'x_ket_sk_waham'
        $val = $CurrentForm->hasValue("ket_sk_waham") ? $CurrentForm->getValue("ket_sk_waham") : $CurrentForm->getValue("x_ket_sk_waham");
        if (!$this->ket_sk_waham->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_sk_waham->Visible = false; // Disable update for API request
            } else {
                $this->ket_sk_waham->setFormValue($val);
            }
        }

        // Check field name 'sk_daya_tilik_diri' first before field var 'x_sk_daya_tilik_diri'
        $val = $CurrentForm->hasValue("sk_daya_tilik_diri") ? $CurrentForm->getValue("sk_daya_tilik_diri") : $CurrentForm->getValue("x_sk_daya_tilik_diri");
        if (!$this->sk_daya_tilik_diri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sk_daya_tilik_diri->Visible = false; // Disable update for API request
            } else {
                $this->sk_daya_tilik_diri->setFormValue($val);
            }
        }

        // Check field name 'ket_sk_daya_tilik_diri' first before field var 'x_ket_sk_daya_tilik_diri'
        $val = $CurrentForm->hasValue("ket_sk_daya_tilik_diri") ? $CurrentForm->getValue("ket_sk_daya_tilik_diri") : $CurrentForm->getValue("x_ket_sk_daya_tilik_diri");
        if (!$this->ket_sk_daya_tilik_diri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_sk_daya_tilik_diri->Visible = false; // Disable update for API request
            } else {
                $this->ket_sk_daya_tilik_diri->setFormValue($val);
            }
        }

        // Check field name 'kk_pembelajaran' first before field var 'x_kk_pembelajaran'
        $val = $CurrentForm->hasValue("kk_pembelajaran") ? $CurrentForm->getValue("kk_pembelajaran") : $CurrentForm->getValue("x_kk_pembelajaran");
        if (!$this->kk_pembelajaran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kk_pembelajaran->Visible = false; // Disable update for API request
            } else {
                $this->kk_pembelajaran->setFormValue($val);
            }
        }

        // Check field name 'ket_kk_pembelajaran' first before field var 'x_ket_kk_pembelajaran'
        $val = $CurrentForm->hasValue("ket_kk_pembelajaran") ? $CurrentForm->getValue("ket_kk_pembelajaran") : $CurrentForm->getValue("x_ket_kk_pembelajaran");
        if (!$this->ket_kk_pembelajaran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_kk_pembelajaran->Visible = false; // Disable update for API request
            } else {
                $this->ket_kk_pembelajaran->setFormValue($val);
            }
        }

        // Check field name 'ket_kk_pembelajaran_lainnya' first before field var 'x_ket_kk_pembelajaran_lainnya'
        $val = $CurrentForm->hasValue("ket_kk_pembelajaran_lainnya") ? $CurrentForm->getValue("ket_kk_pembelajaran_lainnya") : $CurrentForm->getValue("x_ket_kk_pembelajaran_lainnya");
        if (!$this->ket_kk_pembelajaran_lainnya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_kk_pembelajaran_lainnya->Visible = false; // Disable update for API request
            } else {
                $this->ket_kk_pembelajaran_lainnya->setFormValue($val);
            }
        }

        // Check field name 'kk_Penerjamah' first before field var 'x_kk_Penerjamah'
        $val = $CurrentForm->hasValue("kk_Penerjamah") ? $CurrentForm->getValue("kk_Penerjamah") : $CurrentForm->getValue("x_kk_Penerjamah");
        if (!$this->kk_Penerjamah->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kk_Penerjamah->Visible = false; // Disable update for API request
            } else {
                $this->kk_Penerjamah->setFormValue($val);
            }
        }

        // Check field name 'ket_kk_penerjamah_Lainnya' first before field var 'x_ket_kk_penerjamah_Lainnya'
        $val = $CurrentForm->hasValue("ket_kk_penerjamah_Lainnya") ? $CurrentForm->getValue("ket_kk_penerjamah_Lainnya") : $CurrentForm->getValue("x_ket_kk_penerjamah_Lainnya");
        if (!$this->ket_kk_penerjamah_Lainnya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_kk_penerjamah_Lainnya->Visible = false; // Disable update for API request
            } else {
                $this->ket_kk_penerjamah_Lainnya->setFormValue($val);
            }
        }

        // Check field name 'kk_bahasa_isyarat' first before field var 'x_kk_bahasa_isyarat'
        $val = $CurrentForm->hasValue("kk_bahasa_isyarat") ? $CurrentForm->getValue("kk_bahasa_isyarat") : $CurrentForm->getValue("x_kk_bahasa_isyarat");
        if (!$this->kk_bahasa_isyarat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kk_bahasa_isyarat->Visible = false; // Disable update for API request
            } else {
                $this->kk_bahasa_isyarat->setFormValue($val);
            }
        }

        // Check field name 'kk_kebutuhan_edukasi' first before field var 'x_kk_kebutuhan_edukasi'
        $val = $CurrentForm->hasValue("kk_kebutuhan_edukasi") ? $CurrentForm->getValue("kk_kebutuhan_edukasi") : $CurrentForm->getValue("x_kk_kebutuhan_edukasi");
        if (!$this->kk_kebutuhan_edukasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kk_kebutuhan_edukasi->Visible = false; // Disable update for API request
            } else {
                $this->kk_kebutuhan_edukasi->setFormValue($val);
            }
        }

        // Check field name 'ket_kk_kebutuhan_edukasi' first before field var 'x_ket_kk_kebutuhan_edukasi'
        $val = $CurrentForm->hasValue("ket_kk_kebutuhan_edukasi") ? $CurrentForm->getValue("ket_kk_kebutuhan_edukasi") : $CurrentForm->getValue("x_ket_kk_kebutuhan_edukasi");
        if (!$this->ket_kk_kebutuhan_edukasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ket_kk_kebutuhan_edukasi->Visible = false; // Disable update for API request
            } else {
                $this->ket_kk_kebutuhan_edukasi->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue = $this->id_penilaian_awal_keperawatan_ralan_psikiatri->FormValue;
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->tanggal->CurrentValue = $this->tanggal->FormValue;
        $this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
        $this->informasi->CurrentValue = $this->informasi->FormValue;
        $this->keluhan_utama->CurrentValue = $this->keluhan_utama->FormValue;
        $this->rkd_sakit_sejak->CurrentValue = $this->rkd_sakit_sejak->FormValue;
        $this->rkd_keluhan->CurrentValue = $this->rkd_keluhan->FormValue;
        $this->rkd_berobat->CurrentValue = $this->rkd_berobat->FormValue;
        $this->rkd_hasil_pengobatan->CurrentValue = $this->rkd_hasil_pengobatan->FormValue;
        $this->fp_putus_obat->CurrentValue = $this->fp_putus_obat->FormValue;
        $this->ket_putus_obat->CurrentValue = $this->ket_putus_obat->FormValue;
        $this->fp_ekonomi->CurrentValue = $this->fp_ekonomi->FormValue;
        $this->ket_masalah_ekonomi->CurrentValue = $this->ket_masalah_ekonomi->FormValue;
        $this->fp_masalah_fisik->CurrentValue = $this->fp_masalah_fisik->FormValue;
        $this->ket_masalah_fisik->CurrentValue = $this->ket_masalah_fisik->FormValue;
        $this->fp_masalah_psikososial->CurrentValue = $this->fp_masalah_psikososial->FormValue;
        $this->ket_masalah_psikososial->CurrentValue = $this->ket_masalah_psikososial->FormValue;
        $this->rh_keluarga->CurrentValue = $this->rh_keluarga->FormValue;
        $this->ket_rh_keluarga->CurrentValue = $this->ket_rh_keluarga->FormValue;
        $this->resiko_bunuh_diri->CurrentValue = $this->resiko_bunuh_diri->FormValue;
        $this->rbd_ide->CurrentValue = $this->rbd_ide->FormValue;
        $this->ket_rbd_ide->CurrentValue = $this->ket_rbd_ide->FormValue;
        $this->rbd_rencana->CurrentValue = $this->rbd_rencana->FormValue;
        $this->ket_rbd_rencana->CurrentValue = $this->ket_rbd_rencana->FormValue;
        $this->rbd_alat->CurrentValue = $this->rbd_alat->FormValue;
        $this->ket_rbd_alat->CurrentValue = $this->ket_rbd_alat->FormValue;
        $this->rbd_percobaan->CurrentValue = $this->rbd_percobaan->FormValue;
        $this->ket_rbd_percobaan->CurrentValue = $this->ket_rbd_percobaan->FormValue;
        $this->rbd_keinginan->CurrentValue = $this->rbd_keinginan->FormValue;
        $this->ket_rbd_keinginan->CurrentValue = $this->ket_rbd_keinginan->FormValue;
        $this->rpo_penggunaan->CurrentValue = $this->rpo_penggunaan->FormValue;
        $this->ket_rpo_penggunaan->CurrentValue = $this->ket_rpo_penggunaan->FormValue;
        $this->rpo_efek_samping->CurrentValue = $this->rpo_efek_samping->FormValue;
        $this->ket_rpo_efek_samping->CurrentValue = $this->ket_rpo_efek_samping->FormValue;
        $this->rpo_napza->CurrentValue = $this->rpo_napza->FormValue;
        $this->ket_rpo_napza->CurrentValue = $this->ket_rpo_napza->FormValue;
        $this->ket_lama_pemakaian->CurrentValue = $this->ket_lama_pemakaian->FormValue;
        $this->ket_cara_pemakaian->CurrentValue = $this->ket_cara_pemakaian->FormValue;
        $this->ket_latar_belakang_pemakaian->CurrentValue = $this->ket_latar_belakang_pemakaian->FormValue;
        $this->rpo_penggunaan_obat_lainnya->CurrentValue = $this->rpo_penggunaan_obat_lainnya->FormValue;
        $this->ket_penggunaan_obat_lainnya->CurrentValue = $this->ket_penggunaan_obat_lainnya->FormValue;
        $this->ket_alasan_penggunaan->CurrentValue = $this->ket_alasan_penggunaan->FormValue;
        $this->rpo_alergi_obat->CurrentValue = $this->rpo_alergi_obat->FormValue;
        $this->ket_alergi_obat->CurrentValue = $this->ket_alergi_obat->FormValue;
        $this->rpo_merokok->CurrentValue = $this->rpo_merokok->FormValue;
        $this->ket_merokok->CurrentValue = $this->ket_merokok->FormValue;
        $this->rpo_minum_kopi->CurrentValue = $this->rpo_minum_kopi->FormValue;
        $this->ket_minum_kopi->CurrentValue = $this->ket_minum_kopi->FormValue;
        $this->td->CurrentValue = $this->td->FormValue;
        $this->nadi->CurrentValue = $this->nadi->FormValue;
        $this->gcs->CurrentValue = $this->gcs->FormValue;
        $this->rr->CurrentValue = $this->rr->FormValue;
        $this->suhu->CurrentValue = $this->suhu->FormValue;
        $this->pf_keluhan_fisik->CurrentValue = $this->pf_keluhan_fisik->FormValue;
        $this->ket_keluhan_fisik->CurrentValue = $this->ket_keluhan_fisik->FormValue;
        $this->skala_nyeri->CurrentValue = $this->skala_nyeri->FormValue;
        $this->durasi->CurrentValue = $this->durasi->FormValue;
        $this->nyeri->CurrentValue = $this->nyeri->FormValue;
        $this->provokes->CurrentValue = $this->provokes->FormValue;
        $this->ket_provokes->CurrentValue = $this->ket_provokes->FormValue;
        $this->quality->CurrentValue = $this->quality->FormValue;
        $this->ket_quality->CurrentValue = $this->ket_quality->FormValue;
        $this->lokasi->CurrentValue = $this->lokasi->FormValue;
        $this->menyebar->CurrentValue = $this->menyebar->FormValue;
        $this->pada_dokter->CurrentValue = $this->pada_dokter->FormValue;
        $this->ket_dokter->CurrentValue = $this->ket_dokter->FormValue;
        $this->nyeri_hilang->CurrentValue = $this->nyeri_hilang->FormValue;
        $this->ket_nyeri->CurrentValue = $this->ket_nyeri->FormValue;
        $this->bb->CurrentValue = $this->bb->FormValue;
        $this->tb->CurrentValue = $this->tb->FormValue;
        $this->bmi->CurrentValue = $this->bmi->FormValue;
        $this->lapor_status_nutrisi->CurrentValue = $this->lapor_status_nutrisi->FormValue;
        $this->ket_lapor_status_nutrisi->CurrentValue = $this->ket_lapor_status_nutrisi->FormValue;
        $this->sg1->CurrentValue = $this->sg1->FormValue;
        $this->nilai1->CurrentValue = $this->nilai1->FormValue;
        $this->sg2->CurrentValue = $this->sg2->FormValue;
        $this->nilai2->CurrentValue = $this->nilai2->FormValue;
        $this->total_hasil->CurrentValue = $this->total_hasil->FormValue;
        $this->resikojatuh->CurrentValue = $this->resikojatuh->FormValue;
        $this->bjm->CurrentValue = $this->bjm->FormValue;
        $this->msa->CurrentValue = $this->msa->FormValue;
        $this->hasil->CurrentValue = $this->hasil->FormValue;
        $this->lapor->CurrentValue = $this->lapor->FormValue;
        $this->ket_lapor->CurrentValue = $this->ket_lapor->FormValue;
        $this->adl_mandi->CurrentValue = $this->adl_mandi->FormValue;
        $this->adl_berpakaian->CurrentValue = $this->adl_berpakaian->FormValue;
        $this->adl_makan->CurrentValue = $this->adl_makan->FormValue;
        $this->adl_bak->CurrentValue = $this->adl_bak->FormValue;
        $this->adl_bab->CurrentValue = $this->adl_bab->FormValue;
        $this->adl_hobi->CurrentValue = $this->adl_hobi->FormValue;
        $this->ket_adl_hobi->CurrentValue = $this->ket_adl_hobi->FormValue;
        $this->adl_sosialisasi->CurrentValue = $this->adl_sosialisasi->FormValue;
        $this->ket_adl_sosialisasi->CurrentValue = $this->ket_adl_sosialisasi->FormValue;
        $this->adl_kegiatan->CurrentValue = $this->adl_kegiatan->FormValue;
        $this->ket_adl_kegiatan->CurrentValue = $this->ket_adl_kegiatan->FormValue;
        $this->sk_penampilan->CurrentValue = $this->sk_penampilan->FormValue;
        $this->sk_alam_perasaan->CurrentValue = $this->sk_alam_perasaan->FormValue;
        $this->sk_pembicaraan->CurrentValue = $this->sk_pembicaraan->FormValue;
        $this->sk_afek->CurrentValue = $this->sk_afek->FormValue;
        $this->sk_aktifitas_motorik->CurrentValue = $this->sk_aktifitas_motorik->FormValue;
        $this->sk_gangguan_ringan->CurrentValue = $this->sk_gangguan_ringan->FormValue;
        $this->sk_proses_pikir->CurrentValue = $this->sk_proses_pikir->FormValue;
        $this->sk_orientasi->CurrentValue = $this->sk_orientasi->FormValue;
        $this->sk_tingkat_kesadaran_orientasi->CurrentValue = $this->sk_tingkat_kesadaran_orientasi->FormValue;
        $this->sk_memori->CurrentValue = $this->sk_memori->FormValue;
        $this->sk_interaksi->CurrentValue = $this->sk_interaksi->FormValue;
        $this->sk_konsentrasi->CurrentValue = $this->sk_konsentrasi->FormValue;
        $this->sk_persepsi->CurrentValue = $this->sk_persepsi->FormValue;
        $this->ket_sk_persepsi->CurrentValue = $this->ket_sk_persepsi->FormValue;
        $this->sk_isi_pikir->CurrentValue = $this->sk_isi_pikir->FormValue;
        $this->sk_waham->CurrentValue = $this->sk_waham->FormValue;
        $this->ket_sk_waham->CurrentValue = $this->ket_sk_waham->FormValue;
        $this->sk_daya_tilik_diri->CurrentValue = $this->sk_daya_tilik_diri->FormValue;
        $this->ket_sk_daya_tilik_diri->CurrentValue = $this->ket_sk_daya_tilik_diri->FormValue;
        $this->kk_pembelajaran->CurrentValue = $this->kk_pembelajaran->FormValue;
        $this->ket_kk_pembelajaran->CurrentValue = $this->ket_kk_pembelajaran->FormValue;
        $this->ket_kk_pembelajaran_lainnya->CurrentValue = $this->ket_kk_pembelajaran_lainnya->FormValue;
        $this->kk_Penerjamah->CurrentValue = $this->kk_Penerjamah->FormValue;
        $this->ket_kk_penerjamah_Lainnya->CurrentValue = $this->ket_kk_penerjamah_Lainnya->FormValue;
        $this->kk_bahasa_isyarat->CurrentValue = $this->kk_bahasa_isyarat->FormValue;
        $this->kk_kebutuhan_edukasi->CurrentValue = $this->kk_kebutuhan_edukasi->FormValue;
        $this->ket_kk_kebutuhan_edukasi->CurrentValue = $this->ket_kk_kebutuhan_edukasi->FormValue;
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

            // keluhan_utama
            $this->keluhan_utama->ViewValue = $this->keluhan_utama->CurrentValue;
            $this->keluhan_utama->ViewCustomAttributes = "";

            // rkd_sakit_sejak
            $this->rkd_sakit_sejak->ViewValue = $this->rkd_sakit_sejak->CurrentValue;
            $this->rkd_sakit_sejak->ViewCustomAttributes = "";

            // rkd_keluhan
            $this->rkd_keluhan->ViewValue = $this->rkd_keluhan->CurrentValue;
            $this->rkd_keluhan->ViewCustomAttributes = "";

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

            // id_penilaian_awal_keperawatan_ralan_psikiatri
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->LinkCustomAttributes = "";
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->HrefValue = "";
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->TooltipValue = "";

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

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";
            $this->keluhan_utama->TooltipValue = "";

            // rkd_sakit_sejak
            $this->rkd_sakit_sejak->LinkCustomAttributes = "";
            $this->rkd_sakit_sejak->HrefValue = "";
            $this->rkd_sakit_sejak->TooltipValue = "";

            // rkd_keluhan
            $this->rkd_keluhan->LinkCustomAttributes = "";
            $this->rkd_keluhan->HrefValue = "";
            $this->rkd_keluhan->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id_penilaian_awal_keperawatan_ralan_psikiatri
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->EditAttrs["class"] = "form-control";
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->EditCustomAttributes = "";
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->EditValue = $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue;
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->EditAttrs["class"] = "form-control";
            $this->no_rawat->EditCustomAttributes = "";
            if ($this->no_rawat->getSessionValue() != "") {
                $this->no_rawat->CurrentValue = GetForeignKeyValue($this->no_rawat->getSessionValue());
                $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
                $this->no_rawat->ViewCustomAttributes = "";
            } else {
                if (!$this->no_rawat->Raw) {
                    $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
                }
                $this->no_rawat->EditValue = HtmlEncode($this->no_rawat->CurrentValue);
                $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());
            }

            // tanggal
            $this->tanggal->EditAttrs["class"] = "form-control";
            $this->tanggal->EditCustomAttributes = "";
            $this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
            $this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

            // informasi
            $this->informasi->EditCustomAttributes = "";
            $this->informasi->EditValue = $this->informasi->options(false);
            $this->informasi->PlaceHolder = RemoveHtml($this->informasi->caption());

            // keluhan_utama
            $this->keluhan_utama->EditAttrs["class"] = "form-control";
            $this->keluhan_utama->EditCustomAttributes = "";
            $this->keluhan_utama->EditValue = HtmlEncode($this->keluhan_utama->CurrentValue);
            $this->keluhan_utama->PlaceHolder = RemoveHtml($this->keluhan_utama->caption());

            // rkd_sakit_sejak
            $this->rkd_sakit_sejak->EditAttrs["class"] = "form-control";
            $this->rkd_sakit_sejak->EditCustomAttributes = "";
            if (!$this->rkd_sakit_sejak->Raw) {
                $this->rkd_sakit_sejak->CurrentValue = HtmlDecode($this->rkd_sakit_sejak->CurrentValue);
            }
            $this->rkd_sakit_sejak->EditValue = HtmlEncode($this->rkd_sakit_sejak->CurrentValue);
            $this->rkd_sakit_sejak->PlaceHolder = RemoveHtml($this->rkd_sakit_sejak->caption());

            // rkd_keluhan
            $this->rkd_keluhan->EditAttrs["class"] = "form-control";
            $this->rkd_keluhan->EditCustomAttributes = "";
            $this->rkd_keluhan->EditValue = HtmlEncode($this->rkd_keluhan->CurrentValue);
            $this->rkd_keluhan->PlaceHolder = RemoveHtml($this->rkd_keluhan->caption());

            // rkd_berobat
            $this->rkd_berobat->EditCustomAttributes = "";
            $this->rkd_berobat->EditValue = $this->rkd_berobat->options(false);
            $this->rkd_berobat->PlaceHolder = RemoveHtml($this->rkd_berobat->caption());

            // rkd_hasil_pengobatan
            $this->rkd_hasil_pengobatan->EditCustomAttributes = "";
            $this->rkd_hasil_pengobatan->EditValue = $this->rkd_hasil_pengobatan->options(false);
            $this->rkd_hasil_pengobatan->PlaceHolder = RemoveHtml($this->rkd_hasil_pengobatan->caption());

            // fp_putus_obat
            $this->fp_putus_obat->EditCustomAttributes = "";
            $this->fp_putus_obat->EditValue = $this->fp_putus_obat->options(false);
            $this->fp_putus_obat->PlaceHolder = RemoveHtml($this->fp_putus_obat->caption());

            // ket_putus_obat
            $this->ket_putus_obat->EditAttrs["class"] = "form-control";
            $this->ket_putus_obat->EditCustomAttributes = "";
            if (!$this->ket_putus_obat->Raw) {
                $this->ket_putus_obat->CurrentValue = HtmlDecode($this->ket_putus_obat->CurrentValue);
            }
            $this->ket_putus_obat->EditValue = HtmlEncode($this->ket_putus_obat->CurrentValue);
            $this->ket_putus_obat->PlaceHolder = RemoveHtml($this->ket_putus_obat->caption());

            // fp_ekonomi
            $this->fp_ekonomi->EditCustomAttributes = "";
            $this->fp_ekonomi->EditValue = $this->fp_ekonomi->options(false);
            $this->fp_ekonomi->PlaceHolder = RemoveHtml($this->fp_ekonomi->caption());

            // ket_masalah_ekonomi
            $this->ket_masalah_ekonomi->EditAttrs["class"] = "form-control";
            $this->ket_masalah_ekonomi->EditCustomAttributes = "";
            if (!$this->ket_masalah_ekonomi->Raw) {
                $this->ket_masalah_ekonomi->CurrentValue = HtmlDecode($this->ket_masalah_ekonomi->CurrentValue);
            }
            $this->ket_masalah_ekonomi->EditValue = HtmlEncode($this->ket_masalah_ekonomi->CurrentValue);
            $this->ket_masalah_ekonomi->PlaceHolder = RemoveHtml($this->ket_masalah_ekonomi->caption());

            // fp_masalah_fisik
            $this->fp_masalah_fisik->EditCustomAttributes = "";
            $this->fp_masalah_fisik->EditValue = $this->fp_masalah_fisik->options(false);
            $this->fp_masalah_fisik->PlaceHolder = RemoveHtml($this->fp_masalah_fisik->caption());

            // ket_masalah_fisik
            $this->ket_masalah_fisik->EditAttrs["class"] = "form-control";
            $this->ket_masalah_fisik->EditCustomAttributes = "";
            if (!$this->ket_masalah_fisik->Raw) {
                $this->ket_masalah_fisik->CurrentValue = HtmlDecode($this->ket_masalah_fisik->CurrentValue);
            }
            $this->ket_masalah_fisik->EditValue = HtmlEncode($this->ket_masalah_fisik->CurrentValue);
            $this->ket_masalah_fisik->PlaceHolder = RemoveHtml($this->ket_masalah_fisik->caption());

            // fp_masalah_psikososial
            $this->fp_masalah_psikososial->EditCustomAttributes = "";
            $this->fp_masalah_psikososial->EditValue = $this->fp_masalah_psikososial->options(false);
            $this->fp_masalah_psikososial->PlaceHolder = RemoveHtml($this->fp_masalah_psikososial->caption());

            // ket_masalah_psikososial
            $this->ket_masalah_psikososial->EditAttrs["class"] = "form-control";
            $this->ket_masalah_psikososial->EditCustomAttributes = "";
            if (!$this->ket_masalah_psikososial->Raw) {
                $this->ket_masalah_psikososial->CurrentValue = HtmlDecode($this->ket_masalah_psikososial->CurrentValue);
            }
            $this->ket_masalah_psikososial->EditValue = HtmlEncode($this->ket_masalah_psikososial->CurrentValue);
            $this->ket_masalah_psikososial->PlaceHolder = RemoveHtml($this->ket_masalah_psikososial->caption());

            // rh_keluarga
            $this->rh_keluarga->EditCustomAttributes = "";
            $this->rh_keluarga->EditValue = $this->rh_keluarga->options(false);
            $this->rh_keluarga->PlaceHolder = RemoveHtml($this->rh_keluarga->caption());

            // ket_rh_keluarga
            $this->ket_rh_keluarga->EditAttrs["class"] = "form-control";
            $this->ket_rh_keluarga->EditCustomAttributes = "";
            if (!$this->ket_rh_keluarga->Raw) {
                $this->ket_rh_keluarga->CurrentValue = HtmlDecode($this->ket_rh_keluarga->CurrentValue);
            }
            $this->ket_rh_keluarga->EditValue = HtmlEncode($this->ket_rh_keluarga->CurrentValue);
            $this->ket_rh_keluarga->PlaceHolder = RemoveHtml($this->ket_rh_keluarga->caption());

            // resiko_bunuh_diri
            $this->resiko_bunuh_diri->EditCustomAttributes = "";
            $this->resiko_bunuh_diri->EditValue = $this->resiko_bunuh_diri->options(false);
            $this->resiko_bunuh_diri->PlaceHolder = RemoveHtml($this->resiko_bunuh_diri->caption());

            // rbd_ide
            $this->rbd_ide->EditCustomAttributes = "";
            $this->rbd_ide->EditValue = $this->rbd_ide->options(false);
            $this->rbd_ide->PlaceHolder = RemoveHtml($this->rbd_ide->caption());

            // ket_rbd_ide
            $this->ket_rbd_ide->EditAttrs["class"] = "form-control";
            $this->ket_rbd_ide->EditCustomAttributes = "";
            if (!$this->ket_rbd_ide->Raw) {
                $this->ket_rbd_ide->CurrentValue = HtmlDecode($this->ket_rbd_ide->CurrentValue);
            }
            $this->ket_rbd_ide->EditValue = HtmlEncode($this->ket_rbd_ide->CurrentValue);
            $this->ket_rbd_ide->PlaceHolder = RemoveHtml($this->ket_rbd_ide->caption());

            // rbd_rencana
            $this->rbd_rencana->EditCustomAttributes = "";
            $this->rbd_rencana->EditValue = $this->rbd_rencana->options(false);
            $this->rbd_rencana->PlaceHolder = RemoveHtml($this->rbd_rencana->caption());

            // ket_rbd_rencana
            $this->ket_rbd_rencana->EditAttrs["class"] = "form-control";
            $this->ket_rbd_rencana->EditCustomAttributes = "";
            if (!$this->ket_rbd_rencana->Raw) {
                $this->ket_rbd_rencana->CurrentValue = HtmlDecode($this->ket_rbd_rencana->CurrentValue);
            }
            $this->ket_rbd_rencana->EditValue = HtmlEncode($this->ket_rbd_rencana->CurrentValue);
            $this->ket_rbd_rencana->PlaceHolder = RemoveHtml($this->ket_rbd_rencana->caption());

            // rbd_alat
            $this->rbd_alat->EditCustomAttributes = "";
            $this->rbd_alat->EditValue = $this->rbd_alat->options(false);
            $this->rbd_alat->PlaceHolder = RemoveHtml($this->rbd_alat->caption());

            // ket_rbd_alat
            $this->ket_rbd_alat->EditAttrs["class"] = "form-control";
            $this->ket_rbd_alat->EditCustomAttributes = "";
            if (!$this->ket_rbd_alat->Raw) {
                $this->ket_rbd_alat->CurrentValue = HtmlDecode($this->ket_rbd_alat->CurrentValue);
            }
            $this->ket_rbd_alat->EditValue = HtmlEncode($this->ket_rbd_alat->CurrentValue);
            $this->ket_rbd_alat->PlaceHolder = RemoveHtml($this->ket_rbd_alat->caption());

            // rbd_percobaan
            $this->rbd_percobaan->EditCustomAttributes = "";
            $this->rbd_percobaan->EditValue = $this->rbd_percobaan->options(false);
            $this->rbd_percobaan->PlaceHolder = RemoveHtml($this->rbd_percobaan->caption());

            // ket_rbd_percobaan
            $this->ket_rbd_percobaan->EditAttrs["class"] = "form-control";
            $this->ket_rbd_percobaan->EditCustomAttributes = "";
            if (!$this->ket_rbd_percobaan->Raw) {
                $this->ket_rbd_percobaan->CurrentValue = HtmlDecode($this->ket_rbd_percobaan->CurrentValue);
            }
            $this->ket_rbd_percobaan->EditValue = HtmlEncode($this->ket_rbd_percobaan->CurrentValue);
            $this->ket_rbd_percobaan->PlaceHolder = RemoveHtml($this->ket_rbd_percobaan->caption());

            // rbd_keinginan
            $this->rbd_keinginan->EditCustomAttributes = "";
            $this->rbd_keinginan->EditValue = $this->rbd_keinginan->options(false);
            $this->rbd_keinginan->PlaceHolder = RemoveHtml($this->rbd_keinginan->caption());

            // ket_rbd_keinginan
            $this->ket_rbd_keinginan->EditAttrs["class"] = "form-control";
            $this->ket_rbd_keinginan->EditCustomAttributes = "";
            if (!$this->ket_rbd_keinginan->Raw) {
                $this->ket_rbd_keinginan->CurrentValue = HtmlDecode($this->ket_rbd_keinginan->CurrentValue);
            }
            $this->ket_rbd_keinginan->EditValue = HtmlEncode($this->ket_rbd_keinginan->CurrentValue);
            $this->ket_rbd_keinginan->PlaceHolder = RemoveHtml($this->ket_rbd_keinginan->caption());

            // rpo_penggunaan
            $this->rpo_penggunaan->EditCustomAttributes = "";
            $this->rpo_penggunaan->EditValue = $this->rpo_penggunaan->options(false);
            $this->rpo_penggunaan->PlaceHolder = RemoveHtml($this->rpo_penggunaan->caption());

            // ket_rpo_penggunaan
            $this->ket_rpo_penggunaan->EditAttrs["class"] = "form-control";
            $this->ket_rpo_penggunaan->EditCustomAttributes = "";
            if (!$this->ket_rpo_penggunaan->Raw) {
                $this->ket_rpo_penggunaan->CurrentValue = HtmlDecode($this->ket_rpo_penggunaan->CurrentValue);
            }
            $this->ket_rpo_penggunaan->EditValue = HtmlEncode($this->ket_rpo_penggunaan->CurrentValue);
            $this->ket_rpo_penggunaan->PlaceHolder = RemoveHtml($this->ket_rpo_penggunaan->caption());

            // rpo_efek_samping
            $this->rpo_efek_samping->EditCustomAttributes = "";
            $this->rpo_efek_samping->EditValue = $this->rpo_efek_samping->options(false);
            $this->rpo_efek_samping->PlaceHolder = RemoveHtml($this->rpo_efek_samping->caption());

            // ket_rpo_efek_samping
            $this->ket_rpo_efek_samping->EditAttrs["class"] = "form-control";
            $this->ket_rpo_efek_samping->EditCustomAttributes = "";
            if (!$this->ket_rpo_efek_samping->Raw) {
                $this->ket_rpo_efek_samping->CurrentValue = HtmlDecode($this->ket_rpo_efek_samping->CurrentValue);
            }
            $this->ket_rpo_efek_samping->EditValue = HtmlEncode($this->ket_rpo_efek_samping->CurrentValue);
            $this->ket_rpo_efek_samping->PlaceHolder = RemoveHtml($this->ket_rpo_efek_samping->caption());

            // rpo_napza
            $this->rpo_napza->EditCustomAttributes = "";
            $this->rpo_napza->EditValue = $this->rpo_napza->options(false);
            $this->rpo_napza->PlaceHolder = RemoveHtml($this->rpo_napza->caption());

            // ket_rpo_napza
            $this->ket_rpo_napza->EditAttrs["class"] = "form-control";
            $this->ket_rpo_napza->EditCustomAttributes = "";
            if (!$this->ket_rpo_napza->Raw) {
                $this->ket_rpo_napza->CurrentValue = HtmlDecode($this->ket_rpo_napza->CurrentValue);
            }
            $this->ket_rpo_napza->EditValue = HtmlEncode($this->ket_rpo_napza->CurrentValue);
            $this->ket_rpo_napza->PlaceHolder = RemoveHtml($this->ket_rpo_napza->caption());

            // ket_lama_pemakaian
            $this->ket_lama_pemakaian->EditAttrs["class"] = "form-control";
            $this->ket_lama_pemakaian->EditCustomAttributes = "";
            if (!$this->ket_lama_pemakaian->Raw) {
                $this->ket_lama_pemakaian->CurrentValue = HtmlDecode($this->ket_lama_pemakaian->CurrentValue);
            }
            $this->ket_lama_pemakaian->EditValue = HtmlEncode($this->ket_lama_pemakaian->CurrentValue);
            $this->ket_lama_pemakaian->PlaceHolder = RemoveHtml($this->ket_lama_pemakaian->caption());

            // ket_cara_pemakaian
            $this->ket_cara_pemakaian->EditAttrs["class"] = "form-control";
            $this->ket_cara_pemakaian->EditCustomAttributes = "";
            if (!$this->ket_cara_pemakaian->Raw) {
                $this->ket_cara_pemakaian->CurrentValue = HtmlDecode($this->ket_cara_pemakaian->CurrentValue);
            }
            $this->ket_cara_pemakaian->EditValue = HtmlEncode($this->ket_cara_pemakaian->CurrentValue);
            $this->ket_cara_pemakaian->PlaceHolder = RemoveHtml($this->ket_cara_pemakaian->caption());

            // ket_latar_belakang_pemakaian
            $this->ket_latar_belakang_pemakaian->EditAttrs["class"] = "form-control";
            $this->ket_latar_belakang_pemakaian->EditCustomAttributes = "";
            if (!$this->ket_latar_belakang_pemakaian->Raw) {
                $this->ket_latar_belakang_pemakaian->CurrentValue = HtmlDecode($this->ket_latar_belakang_pemakaian->CurrentValue);
            }
            $this->ket_latar_belakang_pemakaian->EditValue = HtmlEncode($this->ket_latar_belakang_pemakaian->CurrentValue);
            $this->ket_latar_belakang_pemakaian->PlaceHolder = RemoveHtml($this->ket_latar_belakang_pemakaian->caption());

            // rpo_penggunaan_obat_lainnya
            $this->rpo_penggunaan_obat_lainnya->EditCustomAttributes = "";
            $this->rpo_penggunaan_obat_lainnya->EditValue = $this->rpo_penggunaan_obat_lainnya->options(false);
            $this->rpo_penggunaan_obat_lainnya->PlaceHolder = RemoveHtml($this->rpo_penggunaan_obat_lainnya->caption());

            // ket_penggunaan_obat_lainnya
            $this->ket_penggunaan_obat_lainnya->EditAttrs["class"] = "form-control";
            $this->ket_penggunaan_obat_lainnya->EditCustomAttributes = "";
            if (!$this->ket_penggunaan_obat_lainnya->Raw) {
                $this->ket_penggunaan_obat_lainnya->CurrentValue = HtmlDecode($this->ket_penggunaan_obat_lainnya->CurrentValue);
            }
            $this->ket_penggunaan_obat_lainnya->EditValue = HtmlEncode($this->ket_penggunaan_obat_lainnya->CurrentValue);
            $this->ket_penggunaan_obat_lainnya->PlaceHolder = RemoveHtml($this->ket_penggunaan_obat_lainnya->caption());

            // ket_alasan_penggunaan
            $this->ket_alasan_penggunaan->EditAttrs["class"] = "form-control";
            $this->ket_alasan_penggunaan->EditCustomAttributes = "";
            if (!$this->ket_alasan_penggunaan->Raw) {
                $this->ket_alasan_penggunaan->CurrentValue = HtmlDecode($this->ket_alasan_penggunaan->CurrentValue);
            }
            $this->ket_alasan_penggunaan->EditValue = HtmlEncode($this->ket_alasan_penggunaan->CurrentValue);
            $this->ket_alasan_penggunaan->PlaceHolder = RemoveHtml($this->ket_alasan_penggunaan->caption());

            // rpo_alergi_obat
            $this->rpo_alergi_obat->EditCustomAttributes = "";
            $this->rpo_alergi_obat->EditValue = $this->rpo_alergi_obat->options(false);
            $this->rpo_alergi_obat->PlaceHolder = RemoveHtml($this->rpo_alergi_obat->caption());

            // ket_alergi_obat
            $this->ket_alergi_obat->EditAttrs["class"] = "form-control";
            $this->ket_alergi_obat->EditCustomAttributes = "";
            if (!$this->ket_alergi_obat->Raw) {
                $this->ket_alergi_obat->CurrentValue = HtmlDecode($this->ket_alergi_obat->CurrentValue);
            }
            $this->ket_alergi_obat->EditValue = HtmlEncode($this->ket_alergi_obat->CurrentValue);
            $this->ket_alergi_obat->PlaceHolder = RemoveHtml($this->ket_alergi_obat->caption());

            // rpo_merokok
            $this->rpo_merokok->EditCustomAttributes = "";
            $this->rpo_merokok->EditValue = $this->rpo_merokok->options(false);
            $this->rpo_merokok->PlaceHolder = RemoveHtml($this->rpo_merokok->caption());

            // ket_merokok
            $this->ket_merokok->EditAttrs["class"] = "form-control";
            $this->ket_merokok->EditCustomAttributes = "";
            if (!$this->ket_merokok->Raw) {
                $this->ket_merokok->CurrentValue = HtmlDecode($this->ket_merokok->CurrentValue);
            }
            $this->ket_merokok->EditValue = HtmlEncode($this->ket_merokok->CurrentValue);
            $this->ket_merokok->PlaceHolder = RemoveHtml($this->ket_merokok->caption());

            // rpo_minum_kopi
            $this->rpo_minum_kopi->EditCustomAttributes = "";
            $this->rpo_minum_kopi->EditValue = $this->rpo_minum_kopi->options(false);
            $this->rpo_minum_kopi->PlaceHolder = RemoveHtml($this->rpo_minum_kopi->caption());

            // ket_minum_kopi
            $this->ket_minum_kopi->EditAttrs["class"] = "form-control";
            $this->ket_minum_kopi->EditCustomAttributes = "";
            if (!$this->ket_minum_kopi->Raw) {
                $this->ket_minum_kopi->CurrentValue = HtmlDecode($this->ket_minum_kopi->CurrentValue);
            }
            $this->ket_minum_kopi->EditValue = HtmlEncode($this->ket_minum_kopi->CurrentValue);
            $this->ket_minum_kopi->PlaceHolder = RemoveHtml($this->ket_minum_kopi->caption());

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

            // gcs
            $this->gcs->EditAttrs["class"] = "form-control";
            $this->gcs->EditCustomAttributes = "";
            if (!$this->gcs->Raw) {
                $this->gcs->CurrentValue = HtmlDecode($this->gcs->CurrentValue);
            }
            $this->gcs->EditValue = HtmlEncode($this->gcs->CurrentValue);
            $this->gcs->PlaceHolder = RemoveHtml($this->gcs->caption());

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

            // pf_keluhan_fisik
            $this->pf_keluhan_fisik->EditCustomAttributes = "";
            $this->pf_keluhan_fisik->EditValue = $this->pf_keluhan_fisik->options(false);
            $this->pf_keluhan_fisik->PlaceHolder = RemoveHtml($this->pf_keluhan_fisik->caption());

            // ket_keluhan_fisik
            $this->ket_keluhan_fisik->EditAttrs["class"] = "form-control";
            $this->ket_keluhan_fisik->EditCustomAttributes = "";
            if (!$this->ket_keluhan_fisik->Raw) {
                $this->ket_keluhan_fisik->CurrentValue = HtmlDecode($this->ket_keluhan_fisik->CurrentValue);
            }
            $this->ket_keluhan_fisik->EditValue = HtmlEncode($this->ket_keluhan_fisik->CurrentValue);
            $this->ket_keluhan_fisik->PlaceHolder = RemoveHtml($this->ket_keluhan_fisik->caption());

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

            // lapor_status_nutrisi
            $this->lapor_status_nutrisi->EditCustomAttributes = "";
            $this->lapor_status_nutrisi->EditValue = $this->lapor_status_nutrisi->options(false);
            $this->lapor_status_nutrisi->PlaceHolder = RemoveHtml($this->lapor_status_nutrisi->caption());

            // ket_lapor_status_nutrisi
            $this->ket_lapor_status_nutrisi->EditAttrs["class"] = "form-control";
            $this->ket_lapor_status_nutrisi->EditCustomAttributes = "";
            if (!$this->ket_lapor_status_nutrisi->Raw) {
                $this->ket_lapor_status_nutrisi->CurrentValue = HtmlDecode($this->ket_lapor_status_nutrisi->CurrentValue);
            }
            $this->ket_lapor_status_nutrisi->EditValue = HtmlEncode($this->ket_lapor_status_nutrisi->CurrentValue);
            $this->ket_lapor_status_nutrisi->PlaceHolder = RemoveHtml($this->ket_lapor_status_nutrisi->caption());

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

            // resikojatuh
            $this->resikojatuh->EditCustomAttributes = "";
            $this->resikojatuh->EditValue = $this->resikojatuh->options(false);
            $this->resikojatuh->PlaceHolder = RemoveHtml($this->resikojatuh->caption());

            // bjm
            $this->bjm->EditCustomAttributes = "";
            $this->bjm->EditValue = $this->bjm->options(false);
            $this->bjm->PlaceHolder = RemoveHtml($this->bjm->caption());

            // msa
            $this->msa->EditCustomAttributes = "";
            $this->msa->EditValue = $this->msa->options(false);
            $this->msa->PlaceHolder = RemoveHtml($this->msa->caption());

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

            // adl_mandi
            $this->adl_mandi->EditCustomAttributes = "";
            $this->adl_mandi->EditValue = $this->adl_mandi->options(false);
            $this->adl_mandi->PlaceHolder = RemoveHtml($this->adl_mandi->caption());

            // adl_berpakaian
            $this->adl_berpakaian->EditCustomAttributes = "";
            $this->adl_berpakaian->EditValue = $this->adl_berpakaian->options(false);
            $this->adl_berpakaian->PlaceHolder = RemoveHtml($this->adl_berpakaian->caption());

            // adl_makan
            $this->adl_makan->EditCustomAttributes = "";
            $this->adl_makan->EditValue = $this->adl_makan->options(false);
            $this->adl_makan->PlaceHolder = RemoveHtml($this->adl_makan->caption());

            // adl_bak
            $this->adl_bak->EditCustomAttributes = "";
            $this->adl_bak->EditValue = $this->adl_bak->options(false);
            $this->adl_bak->PlaceHolder = RemoveHtml($this->adl_bak->caption());

            // adl_bab
            $this->adl_bab->EditCustomAttributes = "";
            $this->adl_bab->EditValue = $this->adl_bab->options(false);
            $this->adl_bab->PlaceHolder = RemoveHtml($this->adl_bab->caption());

            // adl_hobi
            $this->adl_hobi->EditCustomAttributes = "";
            $this->adl_hobi->EditValue = $this->adl_hobi->options(false);
            $this->adl_hobi->PlaceHolder = RemoveHtml($this->adl_hobi->caption());

            // ket_adl_hobi
            $this->ket_adl_hobi->EditAttrs["class"] = "form-control";
            $this->ket_adl_hobi->EditCustomAttributes = "";
            if (!$this->ket_adl_hobi->Raw) {
                $this->ket_adl_hobi->CurrentValue = HtmlDecode($this->ket_adl_hobi->CurrentValue);
            }
            $this->ket_adl_hobi->EditValue = HtmlEncode($this->ket_adl_hobi->CurrentValue);
            $this->ket_adl_hobi->PlaceHolder = RemoveHtml($this->ket_adl_hobi->caption());

            // adl_sosialisasi
            $this->adl_sosialisasi->EditCustomAttributes = "";
            $this->adl_sosialisasi->EditValue = $this->adl_sosialisasi->options(false);
            $this->adl_sosialisasi->PlaceHolder = RemoveHtml($this->adl_sosialisasi->caption());

            // ket_adl_sosialisasi
            $this->ket_adl_sosialisasi->EditAttrs["class"] = "form-control";
            $this->ket_adl_sosialisasi->EditCustomAttributes = "";
            if (!$this->ket_adl_sosialisasi->Raw) {
                $this->ket_adl_sosialisasi->CurrentValue = HtmlDecode($this->ket_adl_sosialisasi->CurrentValue);
            }
            $this->ket_adl_sosialisasi->EditValue = HtmlEncode($this->ket_adl_sosialisasi->CurrentValue);
            $this->ket_adl_sosialisasi->PlaceHolder = RemoveHtml($this->ket_adl_sosialisasi->caption());

            // adl_kegiatan
            $this->adl_kegiatan->EditCustomAttributes = "";
            $this->adl_kegiatan->EditValue = $this->adl_kegiatan->options(false);
            $this->adl_kegiatan->PlaceHolder = RemoveHtml($this->adl_kegiatan->caption());

            // ket_adl_kegiatan
            $this->ket_adl_kegiatan->EditAttrs["class"] = "form-control";
            $this->ket_adl_kegiatan->EditCustomAttributes = "";
            if (!$this->ket_adl_kegiatan->Raw) {
                $this->ket_adl_kegiatan->CurrentValue = HtmlDecode($this->ket_adl_kegiatan->CurrentValue);
            }
            $this->ket_adl_kegiatan->EditValue = HtmlEncode($this->ket_adl_kegiatan->CurrentValue);
            $this->ket_adl_kegiatan->PlaceHolder = RemoveHtml($this->ket_adl_kegiatan->caption());

            // sk_penampilan
            $this->sk_penampilan->EditCustomAttributes = "";
            $this->sk_penampilan->EditValue = $this->sk_penampilan->options(false);
            $this->sk_penampilan->PlaceHolder = RemoveHtml($this->sk_penampilan->caption());

            // sk_alam_perasaan
            $this->sk_alam_perasaan->EditCustomAttributes = "";
            $this->sk_alam_perasaan->EditValue = $this->sk_alam_perasaan->options(false);
            $this->sk_alam_perasaan->PlaceHolder = RemoveHtml($this->sk_alam_perasaan->caption());

            // sk_pembicaraan
            $this->sk_pembicaraan->EditCustomAttributes = "";
            $this->sk_pembicaraan->EditValue = $this->sk_pembicaraan->options(false);
            $this->sk_pembicaraan->PlaceHolder = RemoveHtml($this->sk_pembicaraan->caption());

            // sk_afek
            $this->sk_afek->EditCustomAttributes = "";
            $this->sk_afek->EditValue = $this->sk_afek->options(false);
            $this->sk_afek->PlaceHolder = RemoveHtml($this->sk_afek->caption());

            // sk_aktifitas_motorik
            $this->sk_aktifitas_motorik->EditCustomAttributes = "";
            $this->sk_aktifitas_motorik->EditValue = $this->sk_aktifitas_motorik->options(false);
            $this->sk_aktifitas_motorik->PlaceHolder = RemoveHtml($this->sk_aktifitas_motorik->caption());

            // sk_gangguan_ringan
            $this->sk_gangguan_ringan->EditCustomAttributes = "";
            $this->sk_gangguan_ringan->EditValue = $this->sk_gangguan_ringan->options(false);
            $this->sk_gangguan_ringan->PlaceHolder = RemoveHtml($this->sk_gangguan_ringan->caption());

            // sk_proses_pikir
            $this->sk_proses_pikir->EditCustomAttributes = "";
            $this->sk_proses_pikir->EditValue = $this->sk_proses_pikir->options(false);
            $this->sk_proses_pikir->PlaceHolder = RemoveHtml($this->sk_proses_pikir->caption());

            // sk_orientasi
            $this->sk_orientasi->EditCustomAttributes = "";
            $this->sk_orientasi->EditValue = $this->sk_orientasi->options(false);
            $this->sk_orientasi->PlaceHolder = RemoveHtml($this->sk_orientasi->caption());

            // sk_tingkat_kesadaran_orientasi
            $this->sk_tingkat_kesadaran_orientasi->EditCustomAttributes = "";
            $this->sk_tingkat_kesadaran_orientasi->EditValue = $this->sk_tingkat_kesadaran_orientasi->options(false);
            $this->sk_tingkat_kesadaran_orientasi->PlaceHolder = RemoveHtml($this->sk_tingkat_kesadaran_orientasi->caption());

            // sk_memori
            $this->sk_memori->EditCustomAttributes = "";
            $this->sk_memori->EditValue = $this->sk_memori->options(false);
            $this->sk_memori->PlaceHolder = RemoveHtml($this->sk_memori->caption());

            // sk_interaksi
            $this->sk_interaksi->EditCustomAttributes = "";
            $this->sk_interaksi->EditValue = $this->sk_interaksi->options(false);
            $this->sk_interaksi->PlaceHolder = RemoveHtml($this->sk_interaksi->caption());

            // sk_konsentrasi
            $this->sk_konsentrasi->EditCustomAttributes = "";
            $this->sk_konsentrasi->EditValue = $this->sk_konsentrasi->options(false);
            $this->sk_konsentrasi->PlaceHolder = RemoveHtml($this->sk_konsentrasi->caption());

            // sk_persepsi
            $this->sk_persepsi->EditCustomAttributes = "";
            $this->sk_persepsi->EditValue = $this->sk_persepsi->options(false);
            $this->sk_persepsi->PlaceHolder = RemoveHtml($this->sk_persepsi->caption());

            // ket_sk_persepsi
            $this->ket_sk_persepsi->EditAttrs["class"] = "form-control";
            $this->ket_sk_persepsi->EditCustomAttributes = "";
            if (!$this->ket_sk_persepsi->Raw) {
                $this->ket_sk_persepsi->CurrentValue = HtmlDecode($this->ket_sk_persepsi->CurrentValue);
            }
            $this->ket_sk_persepsi->EditValue = HtmlEncode($this->ket_sk_persepsi->CurrentValue);
            $this->ket_sk_persepsi->PlaceHolder = RemoveHtml($this->ket_sk_persepsi->caption());

            // sk_isi_pikir
            $this->sk_isi_pikir->EditCustomAttributes = "";
            $this->sk_isi_pikir->EditValue = $this->sk_isi_pikir->options(false);
            $this->sk_isi_pikir->PlaceHolder = RemoveHtml($this->sk_isi_pikir->caption());

            // sk_waham
            $this->sk_waham->EditCustomAttributes = "";
            $this->sk_waham->EditValue = $this->sk_waham->options(false);
            $this->sk_waham->PlaceHolder = RemoveHtml($this->sk_waham->caption());

            // ket_sk_waham
            $this->ket_sk_waham->EditAttrs["class"] = "form-control";
            $this->ket_sk_waham->EditCustomAttributes = "";
            if (!$this->ket_sk_waham->Raw) {
                $this->ket_sk_waham->CurrentValue = HtmlDecode($this->ket_sk_waham->CurrentValue);
            }
            $this->ket_sk_waham->EditValue = HtmlEncode($this->ket_sk_waham->CurrentValue);
            $this->ket_sk_waham->PlaceHolder = RemoveHtml($this->ket_sk_waham->caption());

            // sk_daya_tilik_diri
            $this->sk_daya_tilik_diri->EditCustomAttributes = "";
            $this->sk_daya_tilik_diri->EditValue = $this->sk_daya_tilik_diri->options(false);
            $this->sk_daya_tilik_diri->PlaceHolder = RemoveHtml($this->sk_daya_tilik_diri->caption());

            // ket_sk_daya_tilik_diri
            $this->ket_sk_daya_tilik_diri->EditAttrs["class"] = "form-control";
            $this->ket_sk_daya_tilik_diri->EditCustomAttributes = "";
            if (!$this->ket_sk_daya_tilik_diri->Raw) {
                $this->ket_sk_daya_tilik_diri->CurrentValue = HtmlDecode($this->ket_sk_daya_tilik_diri->CurrentValue);
            }
            $this->ket_sk_daya_tilik_diri->EditValue = HtmlEncode($this->ket_sk_daya_tilik_diri->CurrentValue);
            $this->ket_sk_daya_tilik_diri->PlaceHolder = RemoveHtml($this->ket_sk_daya_tilik_diri->caption());

            // kk_pembelajaran
            $this->kk_pembelajaran->EditCustomAttributes = "";
            $this->kk_pembelajaran->EditValue = $this->kk_pembelajaran->options(false);
            $this->kk_pembelajaran->PlaceHolder = RemoveHtml($this->kk_pembelajaran->caption());

            // ket_kk_pembelajaran
            $this->ket_kk_pembelajaran->EditCustomAttributes = "";
            $this->ket_kk_pembelajaran->EditValue = $this->ket_kk_pembelajaran->options(false);
            $this->ket_kk_pembelajaran->PlaceHolder = RemoveHtml($this->ket_kk_pembelajaran->caption());

            // ket_kk_pembelajaran_lainnya
            $this->ket_kk_pembelajaran_lainnya->EditAttrs["class"] = "form-control";
            $this->ket_kk_pembelajaran_lainnya->EditCustomAttributes = "";
            if (!$this->ket_kk_pembelajaran_lainnya->Raw) {
                $this->ket_kk_pembelajaran_lainnya->CurrentValue = HtmlDecode($this->ket_kk_pembelajaran_lainnya->CurrentValue);
            }
            $this->ket_kk_pembelajaran_lainnya->EditValue = HtmlEncode($this->ket_kk_pembelajaran_lainnya->CurrentValue);
            $this->ket_kk_pembelajaran_lainnya->PlaceHolder = RemoveHtml($this->ket_kk_pembelajaran_lainnya->caption());

            // kk_Penerjamah
            $this->kk_Penerjamah->EditCustomAttributes = "";
            $this->kk_Penerjamah->EditValue = $this->kk_Penerjamah->options(false);
            $this->kk_Penerjamah->PlaceHolder = RemoveHtml($this->kk_Penerjamah->caption());

            // ket_kk_penerjamah_Lainnya
            $this->ket_kk_penerjamah_Lainnya->EditAttrs["class"] = "form-control";
            $this->ket_kk_penerjamah_Lainnya->EditCustomAttributes = "";
            if (!$this->ket_kk_penerjamah_Lainnya->Raw) {
                $this->ket_kk_penerjamah_Lainnya->CurrentValue = HtmlDecode($this->ket_kk_penerjamah_Lainnya->CurrentValue);
            }
            $this->ket_kk_penerjamah_Lainnya->EditValue = HtmlEncode($this->ket_kk_penerjamah_Lainnya->CurrentValue);
            $this->ket_kk_penerjamah_Lainnya->PlaceHolder = RemoveHtml($this->ket_kk_penerjamah_Lainnya->caption());

            // kk_bahasa_isyarat
            $this->kk_bahasa_isyarat->EditCustomAttributes = "";
            $this->kk_bahasa_isyarat->EditValue = $this->kk_bahasa_isyarat->options(false);
            $this->kk_bahasa_isyarat->PlaceHolder = RemoveHtml($this->kk_bahasa_isyarat->caption());

            // kk_kebutuhan_edukasi
            $this->kk_kebutuhan_edukasi->EditCustomAttributes = "";
            $this->kk_kebutuhan_edukasi->EditValue = $this->kk_kebutuhan_edukasi->options(false);
            $this->kk_kebutuhan_edukasi->PlaceHolder = RemoveHtml($this->kk_kebutuhan_edukasi->caption());

            // ket_kk_kebutuhan_edukasi
            $this->ket_kk_kebutuhan_edukasi->EditAttrs["class"] = "form-control";
            $this->ket_kk_kebutuhan_edukasi->EditCustomAttributes = "";
            if (!$this->ket_kk_kebutuhan_edukasi->Raw) {
                $this->ket_kk_kebutuhan_edukasi->CurrentValue = HtmlDecode($this->ket_kk_kebutuhan_edukasi->CurrentValue);
            }
            $this->ket_kk_kebutuhan_edukasi->EditValue = HtmlEncode($this->ket_kk_kebutuhan_edukasi->CurrentValue);
            $this->ket_kk_kebutuhan_edukasi->PlaceHolder = RemoveHtml($this->ket_kk_kebutuhan_edukasi->caption());

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

            // Edit refer script

            // id_penilaian_awal_keperawatan_ralan_psikiatri
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->LinkCustomAttributes = "";
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->HrefValue = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";

            // tanggal
            $this->tanggal->LinkCustomAttributes = "";
            $this->tanggal->HrefValue = "";

            // informasi
            $this->informasi->LinkCustomAttributes = "";
            $this->informasi->HrefValue = "";

            // keluhan_utama
            $this->keluhan_utama->LinkCustomAttributes = "";
            $this->keluhan_utama->HrefValue = "";

            // rkd_sakit_sejak
            $this->rkd_sakit_sejak->LinkCustomAttributes = "";
            $this->rkd_sakit_sejak->HrefValue = "";

            // rkd_keluhan
            $this->rkd_keluhan->LinkCustomAttributes = "";
            $this->rkd_keluhan->HrefValue = "";

            // rkd_berobat
            $this->rkd_berobat->LinkCustomAttributes = "";
            $this->rkd_berobat->HrefValue = "";

            // rkd_hasil_pengobatan
            $this->rkd_hasil_pengobatan->LinkCustomAttributes = "";
            $this->rkd_hasil_pengobatan->HrefValue = "";

            // fp_putus_obat
            $this->fp_putus_obat->LinkCustomAttributes = "";
            $this->fp_putus_obat->HrefValue = "";

            // ket_putus_obat
            $this->ket_putus_obat->LinkCustomAttributes = "";
            $this->ket_putus_obat->HrefValue = "";

            // fp_ekonomi
            $this->fp_ekonomi->LinkCustomAttributes = "";
            $this->fp_ekonomi->HrefValue = "";

            // ket_masalah_ekonomi
            $this->ket_masalah_ekonomi->LinkCustomAttributes = "";
            $this->ket_masalah_ekonomi->HrefValue = "";

            // fp_masalah_fisik
            $this->fp_masalah_fisik->LinkCustomAttributes = "";
            $this->fp_masalah_fisik->HrefValue = "";

            // ket_masalah_fisik
            $this->ket_masalah_fisik->LinkCustomAttributes = "";
            $this->ket_masalah_fisik->HrefValue = "";

            // fp_masalah_psikososial
            $this->fp_masalah_psikososial->LinkCustomAttributes = "";
            $this->fp_masalah_psikososial->HrefValue = "";

            // ket_masalah_psikososial
            $this->ket_masalah_psikososial->LinkCustomAttributes = "";
            $this->ket_masalah_psikososial->HrefValue = "";

            // rh_keluarga
            $this->rh_keluarga->LinkCustomAttributes = "";
            $this->rh_keluarga->HrefValue = "";

            // ket_rh_keluarga
            $this->ket_rh_keluarga->LinkCustomAttributes = "";
            $this->ket_rh_keluarga->HrefValue = "";

            // resiko_bunuh_diri
            $this->resiko_bunuh_diri->LinkCustomAttributes = "";
            $this->resiko_bunuh_diri->HrefValue = "";

            // rbd_ide
            $this->rbd_ide->LinkCustomAttributes = "";
            $this->rbd_ide->HrefValue = "";

            // ket_rbd_ide
            $this->ket_rbd_ide->LinkCustomAttributes = "";
            $this->ket_rbd_ide->HrefValue = "";

            // rbd_rencana
            $this->rbd_rencana->LinkCustomAttributes = "";
            $this->rbd_rencana->HrefValue = "";

            // ket_rbd_rencana
            $this->ket_rbd_rencana->LinkCustomAttributes = "";
            $this->ket_rbd_rencana->HrefValue = "";

            // rbd_alat
            $this->rbd_alat->LinkCustomAttributes = "";
            $this->rbd_alat->HrefValue = "";

            // ket_rbd_alat
            $this->ket_rbd_alat->LinkCustomAttributes = "";
            $this->ket_rbd_alat->HrefValue = "";

            // rbd_percobaan
            $this->rbd_percobaan->LinkCustomAttributes = "";
            $this->rbd_percobaan->HrefValue = "";

            // ket_rbd_percobaan
            $this->ket_rbd_percobaan->LinkCustomAttributes = "";
            $this->ket_rbd_percobaan->HrefValue = "";

            // rbd_keinginan
            $this->rbd_keinginan->LinkCustomAttributes = "";
            $this->rbd_keinginan->HrefValue = "";

            // ket_rbd_keinginan
            $this->ket_rbd_keinginan->LinkCustomAttributes = "";
            $this->ket_rbd_keinginan->HrefValue = "";

            // rpo_penggunaan
            $this->rpo_penggunaan->LinkCustomAttributes = "";
            $this->rpo_penggunaan->HrefValue = "";

            // ket_rpo_penggunaan
            $this->ket_rpo_penggunaan->LinkCustomAttributes = "";
            $this->ket_rpo_penggunaan->HrefValue = "";

            // rpo_efek_samping
            $this->rpo_efek_samping->LinkCustomAttributes = "";
            $this->rpo_efek_samping->HrefValue = "";

            // ket_rpo_efek_samping
            $this->ket_rpo_efek_samping->LinkCustomAttributes = "";
            $this->ket_rpo_efek_samping->HrefValue = "";

            // rpo_napza
            $this->rpo_napza->LinkCustomAttributes = "";
            $this->rpo_napza->HrefValue = "";

            // ket_rpo_napza
            $this->ket_rpo_napza->LinkCustomAttributes = "";
            $this->ket_rpo_napza->HrefValue = "";

            // ket_lama_pemakaian
            $this->ket_lama_pemakaian->LinkCustomAttributes = "";
            $this->ket_lama_pemakaian->HrefValue = "";

            // ket_cara_pemakaian
            $this->ket_cara_pemakaian->LinkCustomAttributes = "";
            $this->ket_cara_pemakaian->HrefValue = "";

            // ket_latar_belakang_pemakaian
            $this->ket_latar_belakang_pemakaian->LinkCustomAttributes = "";
            $this->ket_latar_belakang_pemakaian->HrefValue = "";

            // rpo_penggunaan_obat_lainnya
            $this->rpo_penggunaan_obat_lainnya->LinkCustomAttributes = "";
            $this->rpo_penggunaan_obat_lainnya->HrefValue = "";

            // ket_penggunaan_obat_lainnya
            $this->ket_penggunaan_obat_lainnya->LinkCustomAttributes = "";
            $this->ket_penggunaan_obat_lainnya->HrefValue = "";

            // ket_alasan_penggunaan
            $this->ket_alasan_penggunaan->LinkCustomAttributes = "";
            $this->ket_alasan_penggunaan->HrefValue = "";

            // rpo_alergi_obat
            $this->rpo_alergi_obat->LinkCustomAttributes = "";
            $this->rpo_alergi_obat->HrefValue = "";

            // ket_alergi_obat
            $this->ket_alergi_obat->LinkCustomAttributes = "";
            $this->ket_alergi_obat->HrefValue = "";

            // rpo_merokok
            $this->rpo_merokok->LinkCustomAttributes = "";
            $this->rpo_merokok->HrefValue = "";

            // ket_merokok
            $this->ket_merokok->LinkCustomAttributes = "";
            $this->ket_merokok->HrefValue = "";

            // rpo_minum_kopi
            $this->rpo_minum_kopi->LinkCustomAttributes = "";
            $this->rpo_minum_kopi->HrefValue = "";

            // ket_minum_kopi
            $this->ket_minum_kopi->LinkCustomAttributes = "";
            $this->ket_minum_kopi->HrefValue = "";

            // td
            $this->td->LinkCustomAttributes = "";
            $this->td->HrefValue = "";

            // nadi
            $this->nadi->LinkCustomAttributes = "";
            $this->nadi->HrefValue = "";

            // gcs
            $this->gcs->LinkCustomAttributes = "";
            $this->gcs->HrefValue = "";

            // rr
            $this->rr->LinkCustomAttributes = "";
            $this->rr->HrefValue = "";

            // suhu
            $this->suhu->LinkCustomAttributes = "";
            $this->suhu->HrefValue = "";

            // pf_keluhan_fisik
            $this->pf_keluhan_fisik->LinkCustomAttributes = "";
            $this->pf_keluhan_fisik->HrefValue = "";

            // ket_keluhan_fisik
            $this->ket_keluhan_fisik->LinkCustomAttributes = "";
            $this->ket_keluhan_fisik->HrefValue = "";

            // skala_nyeri
            $this->skala_nyeri->LinkCustomAttributes = "";
            $this->skala_nyeri->HrefValue = "";

            // durasi
            $this->durasi->LinkCustomAttributes = "";
            $this->durasi->HrefValue = "";

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

            // pada_dokter
            $this->pada_dokter->LinkCustomAttributes = "";
            $this->pada_dokter->HrefValue = "";

            // ket_dokter
            $this->ket_dokter->LinkCustomAttributes = "";
            $this->ket_dokter->HrefValue = "";

            // nyeri_hilang
            $this->nyeri_hilang->LinkCustomAttributes = "";
            $this->nyeri_hilang->HrefValue = "";

            // ket_nyeri
            $this->ket_nyeri->LinkCustomAttributes = "";
            $this->ket_nyeri->HrefValue = "";

            // bb
            $this->bb->LinkCustomAttributes = "";
            $this->bb->HrefValue = "";

            // tb
            $this->tb->LinkCustomAttributes = "";
            $this->tb->HrefValue = "";

            // bmi
            $this->bmi->LinkCustomAttributes = "";
            $this->bmi->HrefValue = "";

            // lapor_status_nutrisi
            $this->lapor_status_nutrisi->LinkCustomAttributes = "";
            $this->lapor_status_nutrisi->HrefValue = "";

            // ket_lapor_status_nutrisi
            $this->ket_lapor_status_nutrisi->LinkCustomAttributes = "";
            $this->ket_lapor_status_nutrisi->HrefValue = "";

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

            // resikojatuh
            $this->resikojatuh->LinkCustomAttributes = "";
            $this->resikojatuh->HrefValue = "";

            // bjm
            $this->bjm->LinkCustomAttributes = "";
            $this->bjm->HrefValue = "";

            // msa
            $this->msa->LinkCustomAttributes = "";
            $this->msa->HrefValue = "";

            // hasil
            $this->hasil->LinkCustomAttributes = "";
            $this->hasil->HrefValue = "";

            // lapor
            $this->lapor->LinkCustomAttributes = "";
            $this->lapor->HrefValue = "";

            // ket_lapor
            $this->ket_lapor->LinkCustomAttributes = "";
            $this->ket_lapor->HrefValue = "";

            // adl_mandi
            $this->adl_mandi->LinkCustomAttributes = "";
            $this->adl_mandi->HrefValue = "";

            // adl_berpakaian
            $this->adl_berpakaian->LinkCustomAttributes = "";
            $this->adl_berpakaian->HrefValue = "";

            // adl_makan
            $this->adl_makan->LinkCustomAttributes = "";
            $this->adl_makan->HrefValue = "";

            // adl_bak
            $this->adl_bak->LinkCustomAttributes = "";
            $this->adl_bak->HrefValue = "";

            // adl_bab
            $this->adl_bab->LinkCustomAttributes = "";
            $this->adl_bab->HrefValue = "";

            // adl_hobi
            $this->adl_hobi->LinkCustomAttributes = "";
            $this->adl_hobi->HrefValue = "";

            // ket_adl_hobi
            $this->ket_adl_hobi->LinkCustomAttributes = "";
            $this->ket_adl_hobi->HrefValue = "";

            // adl_sosialisasi
            $this->adl_sosialisasi->LinkCustomAttributes = "";
            $this->adl_sosialisasi->HrefValue = "";

            // ket_adl_sosialisasi
            $this->ket_adl_sosialisasi->LinkCustomAttributes = "";
            $this->ket_adl_sosialisasi->HrefValue = "";

            // adl_kegiatan
            $this->adl_kegiatan->LinkCustomAttributes = "";
            $this->adl_kegiatan->HrefValue = "";

            // ket_adl_kegiatan
            $this->ket_adl_kegiatan->LinkCustomAttributes = "";
            $this->ket_adl_kegiatan->HrefValue = "";

            // sk_penampilan
            $this->sk_penampilan->LinkCustomAttributes = "";
            $this->sk_penampilan->HrefValue = "";

            // sk_alam_perasaan
            $this->sk_alam_perasaan->LinkCustomAttributes = "";
            $this->sk_alam_perasaan->HrefValue = "";

            // sk_pembicaraan
            $this->sk_pembicaraan->LinkCustomAttributes = "";
            $this->sk_pembicaraan->HrefValue = "";

            // sk_afek
            $this->sk_afek->LinkCustomAttributes = "";
            $this->sk_afek->HrefValue = "";

            // sk_aktifitas_motorik
            $this->sk_aktifitas_motorik->LinkCustomAttributes = "";
            $this->sk_aktifitas_motorik->HrefValue = "";

            // sk_gangguan_ringan
            $this->sk_gangguan_ringan->LinkCustomAttributes = "";
            $this->sk_gangguan_ringan->HrefValue = "";

            // sk_proses_pikir
            $this->sk_proses_pikir->LinkCustomAttributes = "";
            $this->sk_proses_pikir->HrefValue = "";

            // sk_orientasi
            $this->sk_orientasi->LinkCustomAttributes = "";
            $this->sk_orientasi->HrefValue = "";

            // sk_tingkat_kesadaran_orientasi
            $this->sk_tingkat_kesadaran_orientasi->LinkCustomAttributes = "";
            $this->sk_tingkat_kesadaran_orientasi->HrefValue = "";

            // sk_memori
            $this->sk_memori->LinkCustomAttributes = "";
            $this->sk_memori->HrefValue = "";

            // sk_interaksi
            $this->sk_interaksi->LinkCustomAttributes = "";
            $this->sk_interaksi->HrefValue = "";

            // sk_konsentrasi
            $this->sk_konsentrasi->LinkCustomAttributes = "";
            $this->sk_konsentrasi->HrefValue = "";

            // sk_persepsi
            $this->sk_persepsi->LinkCustomAttributes = "";
            $this->sk_persepsi->HrefValue = "";

            // ket_sk_persepsi
            $this->ket_sk_persepsi->LinkCustomAttributes = "";
            $this->ket_sk_persepsi->HrefValue = "";

            // sk_isi_pikir
            $this->sk_isi_pikir->LinkCustomAttributes = "";
            $this->sk_isi_pikir->HrefValue = "";

            // sk_waham
            $this->sk_waham->LinkCustomAttributes = "";
            $this->sk_waham->HrefValue = "";

            // ket_sk_waham
            $this->ket_sk_waham->LinkCustomAttributes = "";
            $this->ket_sk_waham->HrefValue = "";

            // sk_daya_tilik_diri
            $this->sk_daya_tilik_diri->LinkCustomAttributes = "";
            $this->sk_daya_tilik_diri->HrefValue = "";

            // ket_sk_daya_tilik_diri
            $this->ket_sk_daya_tilik_diri->LinkCustomAttributes = "";
            $this->ket_sk_daya_tilik_diri->HrefValue = "";

            // kk_pembelajaran
            $this->kk_pembelajaran->LinkCustomAttributes = "";
            $this->kk_pembelajaran->HrefValue = "";

            // ket_kk_pembelajaran
            $this->ket_kk_pembelajaran->LinkCustomAttributes = "";
            $this->ket_kk_pembelajaran->HrefValue = "";

            // ket_kk_pembelajaran_lainnya
            $this->ket_kk_pembelajaran_lainnya->LinkCustomAttributes = "";
            $this->ket_kk_pembelajaran_lainnya->HrefValue = "";

            // kk_Penerjamah
            $this->kk_Penerjamah->LinkCustomAttributes = "";
            $this->kk_Penerjamah->HrefValue = "";

            // ket_kk_penerjamah_Lainnya
            $this->ket_kk_penerjamah_Lainnya->LinkCustomAttributes = "";
            $this->ket_kk_penerjamah_Lainnya->HrefValue = "";

            // kk_bahasa_isyarat
            $this->kk_bahasa_isyarat->LinkCustomAttributes = "";
            $this->kk_bahasa_isyarat->HrefValue = "";

            // kk_kebutuhan_edukasi
            $this->kk_kebutuhan_edukasi->LinkCustomAttributes = "";
            $this->kk_kebutuhan_edukasi->HrefValue = "";

            // ket_kk_kebutuhan_edukasi
            $this->ket_kk_kebutuhan_edukasi->LinkCustomAttributes = "";
            $this->ket_kk_kebutuhan_edukasi->HrefValue = "";

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
        if ($this->id_penilaian_awal_keperawatan_ralan_psikiatri->Required) {
            if (!$this->id_penilaian_awal_keperawatan_ralan_psikiatri->IsDetailKey && EmptyValue($this->id_penilaian_awal_keperawatan_ralan_psikiatri->FormValue)) {
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->addErrorMessage(str_replace("%s", $this->id_penilaian_awal_keperawatan_ralan_psikiatri->caption(), $this->id_penilaian_awal_keperawatan_ralan_psikiatri->RequiredErrorMessage));
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
        if ($this->informasi->Required) {
            if ($this->informasi->FormValue == "") {
                $this->informasi->addErrorMessage(str_replace("%s", $this->informasi->caption(), $this->informasi->RequiredErrorMessage));
            }
        }
        if ($this->keluhan_utama->Required) {
            if (!$this->keluhan_utama->IsDetailKey && EmptyValue($this->keluhan_utama->FormValue)) {
                $this->keluhan_utama->addErrorMessage(str_replace("%s", $this->keluhan_utama->caption(), $this->keluhan_utama->RequiredErrorMessage));
            }
        }
        if ($this->rkd_sakit_sejak->Required) {
            if (!$this->rkd_sakit_sejak->IsDetailKey && EmptyValue($this->rkd_sakit_sejak->FormValue)) {
                $this->rkd_sakit_sejak->addErrorMessage(str_replace("%s", $this->rkd_sakit_sejak->caption(), $this->rkd_sakit_sejak->RequiredErrorMessage));
            }
        }
        if ($this->rkd_keluhan->Required) {
            if (!$this->rkd_keluhan->IsDetailKey && EmptyValue($this->rkd_keluhan->FormValue)) {
                $this->rkd_keluhan->addErrorMessage(str_replace("%s", $this->rkd_keluhan->caption(), $this->rkd_keluhan->RequiredErrorMessage));
            }
        }
        if ($this->rkd_berobat->Required) {
            if ($this->rkd_berobat->FormValue == "") {
                $this->rkd_berobat->addErrorMessage(str_replace("%s", $this->rkd_berobat->caption(), $this->rkd_berobat->RequiredErrorMessage));
            }
        }
        if ($this->rkd_hasil_pengobatan->Required) {
            if ($this->rkd_hasil_pengobatan->FormValue == "") {
                $this->rkd_hasil_pengobatan->addErrorMessage(str_replace("%s", $this->rkd_hasil_pengobatan->caption(), $this->rkd_hasil_pengobatan->RequiredErrorMessage));
            }
        }
        if ($this->fp_putus_obat->Required) {
            if ($this->fp_putus_obat->FormValue == "") {
                $this->fp_putus_obat->addErrorMessage(str_replace("%s", $this->fp_putus_obat->caption(), $this->fp_putus_obat->RequiredErrorMessage));
            }
        }
        if ($this->ket_putus_obat->Required) {
            if (!$this->ket_putus_obat->IsDetailKey && EmptyValue($this->ket_putus_obat->FormValue)) {
                $this->ket_putus_obat->addErrorMessage(str_replace("%s", $this->ket_putus_obat->caption(), $this->ket_putus_obat->RequiredErrorMessage));
            }
        }
        if ($this->fp_ekonomi->Required) {
            if ($this->fp_ekonomi->FormValue == "") {
                $this->fp_ekonomi->addErrorMessage(str_replace("%s", $this->fp_ekonomi->caption(), $this->fp_ekonomi->RequiredErrorMessage));
            }
        }
        if ($this->ket_masalah_ekonomi->Required) {
            if (!$this->ket_masalah_ekonomi->IsDetailKey && EmptyValue($this->ket_masalah_ekonomi->FormValue)) {
                $this->ket_masalah_ekonomi->addErrorMessage(str_replace("%s", $this->ket_masalah_ekonomi->caption(), $this->ket_masalah_ekonomi->RequiredErrorMessage));
            }
        }
        if ($this->fp_masalah_fisik->Required) {
            if ($this->fp_masalah_fisik->FormValue == "") {
                $this->fp_masalah_fisik->addErrorMessage(str_replace("%s", $this->fp_masalah_fisik->caption(), $this->fp_masalah_fisik->RequiredErrorMessage));
            }
        }
        if ($this->ket_masalah_fisik->Required) {
            if (!$this->ket_masalah_fisik->IsDetailKey && EmptyValue($this->ket_masalah_fisik->FormValue)) {
                $this->ket_masalah_fisik->addErrorMessage(str_replace("%s", $this->ket_masalah_fisik->caption(), $this->ket_masalah_fisik->RequiredErrorMessage));
            }
        }
        if ($this->fp_masalah_psikososial->Required) {
            if ($this->fp_masalah_psikososial->FormValue == "") {
                $this->fp_masalah_psikososial->addErrorMessage(str_replace("%s", $this->fp_masalah_psikososial->caption(), $this->fp_masalah_psikososial->RequiredErrorMessage));
            }
        }
        if ($this->ket_masalah_psikososial->Required) {
            if (!$this->ket_masalah_psikososial->IsDetailKey && EmptyValue($this->ket_masalah_psikososial->FormValue)) {
                $this->ket_masalah_psikososial->addErrorMessage(str_replace("%s", $this->ket_masalah_psikososial->caption(), $this->ket_masalah_psikososial->RequiredErrorMessage));
            }
        }
        if ($this->rh_keluarga->Required) {
            if ($this->rh_keluarga->FormValue == "") {
                $this->rh_keluarga->addErrorMessage(str_replace("%s", $this->rh_keluarga->caption(), $this->rh_keluarga->RequiredErrorMessage));
            }
        }
        if ($this->ket_rh_keluarga->Required) {
            if (!$this->ket_rh_keluarga->IsDetailKey && EmptyValue($this->ket_rh_keluarga->FormValue)) {
                $this->ket_rh_keluarga->addErrorMessage(str_replace("%s", $this->ket_rh_keluarga->caption(), $this->ket_rh_keluarga->RequiredErrorMessage));
            }
        }
        if ($this->resiko_bunuh_diri->Required) {
            if ($this->resiko_bunuh_diri->FormValue == "") {
                $this->resiko_bunuh_diri->addErrorMessage(str_replace("%s", $this->resiko_bunuh_diri->caption(), $this->resiko_bunuh_diri->RequiredErrorMessage));
            }
        }
        if ($this->rbd_ide->Required) {
            if ($this->rbd_ide->FormValue == "") {
                $this->rbd_ide->addErrorMessage(str_replace("%s", $this->rbd_ide->caption(), $this->rbd_ide->RequiredErrorMessage));
            }
        }
        if ($this->ket_rbd_ide->Required) {
            if (!$this->ket_rbd_ide->IsDetailKey && EmptyValue($this->ket_rbd_ide->FormValue)) {
                $this->ket_rbd_ide->addErrorMessage(str_replace("%s", $this->ket_rbd_ide->caption(), $this->ket_rbd_ide->RequiredErrorMessage));
            }
        }
        if ($this->rbd_rencana->Required) {
            if ($this->rbd_rencana->FormValue == "") {
                $this->rbd_rencana->addErrorMessage(str_replace("%s", $this->rbd_rencana->caption(), $this->rbd_rencana->RequiredErrorMessage));
            }
        }
        if ($this->ket_rbd_rencana->Required) {
            if (!$this->ket_rbd_rencana->IsDetailKey && EmptyValue($this->ket_rbd_rencana->FormValue)) {
                $this->ket_rbd_rencana->addErrorMessage(str_replace("%s", $this->ket_rbd_rencana->caption(), $this->ket_rbd_rencana->RequiredErrorMessage));
            }
        }
        if ($this->rbd_alat->Required) {
            if ($this->rbd_alat->FormValue == "") {
                $this->rbd_alat->addErrorMessage(str_replace("%s", $this->rbd_alat->caption(), $this->rbd_alat->RequiredErrorMessage));
            }
        }
        if ($this->ket_rbd_alat->Required) {
            if (!$this->ket_rbd_alat->IsDetailKey && EmptyValue($this->ket_rbd_alat->FormValue)) {
                $this->ket_rbd_alat->addErrorMessage(str_replace("%s", $this->ket_rbd_alat->caption(), $this->ket_rbd_alat->RequiredErrorMessage));
            }
        }
        if ($this->rbd_percobaan->Required) {
            if ($this->rbd_percobaan->FormValue == "") {
                $this->rbd_percobaan->addErrorMessage(str_replace("%s", $this->rbd_percobaan->caption(), $this->rbd_percobaan->RequiredErrorMessage));
            }
        }
        if ($this->ket_rbd_percobaan->Required) {
            if (!$this->ket_rbd_percobaan->IsDetailKey && EmptyValue($this->ket_rbd_percobaan->FormValue)) {
                $this->ket_rbd_percobaan->addErrorMessage(str_replace("%s", $this->ket_rbd_percobaan->caption(), $this->ket_rbd_percobaan->RequiredErrorMessage));
            }
        }
        if ($this->rbd_keinginan->Required) {
            if ($this->rbd_keinginan->FormValue == "") {
                $this->rbd_keinginan->addErrorMessage(str_replace("%s", $this->rbd_keinginan->caption(), $this->rbd_keinginan->RequiredErrorMessage));
            }
        }
        if ($this->ket_rbd_keinginan->Required) {
            if (!$this->ket_rbd_keinginan->IsDetailKey && EmptyValue($this->ket_rbd_keinginan->FormValue)) {
                $this->ket_rbd_keinginan->addErrorMessage(str_replace("%s", $this->ket_rbd_keinginan->caption(), $this->ket_rbd_keinginan->RequiredErrorMessage));
            }
        }
        if ($this->rpo_penggunaan->Required) {
            if ($this->rpo_penggunaan->FormValue == "") {
                $this->rpo_penggunaan->addErrorMessage(str_replace("%s", $this->rpo_penggunaan->caption(), $this->rpo_penggunaan->RequiredErrorMessage));
            }
        }
        if ($this->ket_rpo_penggunaan->Required) {
            if (!$this->ket_rpo_penggunaan->IsDetailKey && EmptyValue($this->ket_rpo_penggunaan->FormValue)) {
                $this->ket_rpo_penggunaan->addErrorMessage(str_replace("%s", $this->ket_rpo_penggunaan->caption(), $this->ket_rpo_penggunaan->RequiredErrorMessage));
            }
        }
        if ($this->rpo_efek_samping->Required) {
            if ($this->rpo_efek_samping->FormValue == "") {
                $this->rpo_efek_samping->addErrorMessage(str_replace("%s", $this->rpo_efek_samping->caption(), $this->rpo_efek_samping->RequiredErrorMessage));
            }
        }
        if ($this->ket_rpo_efek_samping->Required) {
            if (!$this->ket_rpo_efek_samping->IsDetailKey && EmptyValue($this->ket_rpo_efek_samping->FormValue)) {
                $this->ket_rpo_efek_samping->addErrorMessage(str_replace("%s", $this->ket_rpo_efek_samping->caption(), $this->ket_rpo_efek_samping->RequiredErrorMessage));
            }
        }
        if ($this->rpo_napza->Required) {
            if ($this->rpo_napza->FormValue == "") {
                $this->rpo_napza->addErrorMessage(str_replace("%s", $this->rpo_napza->caption(), $this->rpo_napza->RequiredErrorMessage));
            }
        }
        if ($this->ket_rpo_napza->Required) {
            if (!$this->ket_rpo_napza->IsDetailKey && EmptyValue($this->ket_rpo_napza->FormValue)) {
                $this->ket_rpo_napza->addErrorMessage(str_replace("%s", $this->ket_rpo_napza->caption(), $this->ket_rpo_napza->RequiredErrorMessage));
            }
        }
        if ($this->ket_lama_pemakaian->Required) {
            if (!$this->ket_lama_pemakaian->IsDetailKey && EmptyValue($this->ket_lama_pemakaian->FormValue)) {
                $this->ket_lama_pemakaian->addErrorMessage(str_replace("%s", $this->ket_lama_pemakaian->caption(), $this->ket_lama_pemakaian->RequiredErrorMessage));
            }
        }
        if ($this->ket_cara_pemakaian->Required) {
            if (!$this->ket_cara_pemakaian->IsDetailKey && EmptyValue($this->ket_cara_pemakaian->FormValue)) {
                $this->ket_cara_pemakaian->addErrorMessage(str_replace("%s", $this->ket_cara_pemakaian->caption(), $this->ket_cara_pemakaian->RequiredErrorMessage));
            }
        }
        if ($this->ket_latar_belakang_pemakaian->Required) {
            if (!$this->ket_latar_belakang_pemakaian->IsDetailKey && EmptyValue($this->ket_latar_belakang_pemakaian->FormValue)) {
                $this->ket_latar_belakang_pemakaian->addErrorMessage(str_replace("%s", $this->ket_latar_belakang_pemakaian->caption(), $this->ket_latar_belakang_pemakaian->RequiredErrorMessage));
            }
        }
        if ($this->rpo_penggunaan_obat_lainnya->Required) {
            if ($this->rpo_penggunaan_obat_lainnya->FormValue == "") {
                $this->rpo_penggunaan_obat_lainnya->addErrorMessage(str_replace("%s", $this->rpo_penggunaan_obat_lainnya->caption(), $this->rpo_penggunaan_obat_lainnya->RequiredErrorMessage));
            }
        }
        if ($this->ket_penggunaan_obat_lainnya->Required) {
            if (!$this->ket_penggunaan_obat_lainnya->IsDetailKey && EmptyValue($this->ket_penggunaan_obat_lainnya->FormValue)) {
                $this->ket_penggunaan_obat_lainnya->addErrorMessage(str_replace("%s", $this->ket_penggunaan_obat_lainnya->caption(), $this->ket_penggunaan_obat_lainnya->RequiredErrorMessage));
            }
        }
        if ($this->ket_alasan_penggunaan->Required) {
            if (!$this->ket_alasan_penggunaan->IsDetailKey && EmptyValue($this->ket_alasan_penggunaan->FormValue)) {
                $this->ket_alasan_penggunaan->addErrorMessage(str_replace("%s", $this->ket_alasan_penggunaan->caption(), $this->ket_alasan_penggunaan->RequiredErrorMessage));
            }
        }
        if ($this->rpo_alergi_obat->Required) {
            if ($this->rpo_alergi_obat->FormValue == "") {
                $this->rpo_alergi_obat->addErrorMessage(str_replace("%s", $this->rpo_alergi_obat->caption(), $this->rpo_alergi_obat->RequiredErrorMessage));
            }
        }
        if ($this->ket_alergi_obat->Required) {
            if (!$this->ket_alergi_obat->IsDetailKey && EmptyValue($this->ket_alergi_obat->FormValue)) {
                $this->ket_alergi_obat->addErrorMessage(str_replace("%s", $this->ket_alergi_obat->caption(), $this->ket_alergi_obat->RequiredErrorMessage));
            }
        }
        if ($this->rpo_merokok->Required) {
            if ($this->rpo_merokok->FormValue == "") {
                $this->rpo_merokok->addErrorMessage(str_replace("%s", $this->rpo_merokok->caption(), $this->rpo_merokok->RequiredErrorMessage));
            }
        }
        if ($this->ket_merokok->Required) {
            if (!$this->ket_merokok->IsDetailKey && EmptyValue($this->ket_merokok->FormValue)) {
                $this->ket_merokok->addErrorMessage(str_replace("%s", $this->ket_merokok->caption(), $this->ket_merokok->RequiredErrorMessage));
            }
        }
        if ($this->rpo_minum_kopi->Required) {
            if ($this->rpo_minum_kopi->FormValue == "") {
                $this->rpo_minum_kopi->addErrorMessage(str_replace("%s", $this->rpo_minum_kopi->caption(), $this->rpo_minum_kopi->RequiredErrorMessage));
            }
        }
        if ($this->ket_minum_kopi->Required) {
            if (!$this->ket_minum_kopi->IsDetailKey && EmptyValue($this->ket_minum_kopi->FormValue)) {
                $this->ket_minum_kopi->addErrorMessage(str_replace("%s", $this->ket_minum_kopi->caption(), $this->ket_minum_kopi->RequiredErrorMessage));
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
        if ($this->gcs->Required) {
            if (!$this->gcs->IsDetailKey && EmptyValue($this->gcs->FormValue)) {
                $this->gcs->addErrorMessage(str_replace("%s", $this->gcs->caption(), $this->gcs->RequiredErrorMessage));
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
        if ($this->pf_keluhan_fisik->Required) {
            if ($this->pf_keluhan_fisik->FormValue == "") {
                $this->pf_keluhan_fisik->addErrorMessage(str_replace("%s", $this->pf_keluhan_fisik->caption(), $this->pf_keluhan_fisik->RequiredErrorMessage));
            }
        }
        if ($this->ket_keluhan_fisik->Required) {
            if (!$this->ket_keluhan_fisik->IsDetailKey && EmptyValue($this->ket_keluhan_fisik->FormValue)) {
                $this->ket_keluhan_fisik->addErrorMessage(str_replace("%s", $this->ket_keluhan_fisik->caption(), $this->ket_keluhan_fisik->RequiredErrorMessage));
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
        if ($this->lapor_status_nutrisi->Required) {
            if ($this->lapor_status_nutrisi->FormValue == "") {
                $this->lapor_status_nutrisi->addErrorMessage(str_replace("%s", $this->lapor_status_nutrisi->caption(), $this->lapor_status_nutrisi->RequiredErrorMessage));
            }
        }
        if ($this->ket_lapor_status_nutrisi->Required) {
            if (!$this->ket_lapor_status_nutrisi->IsDetailKey && EmptyValue($this->ket_lapor_status_nutrisi->FormValue)) {
                $this->ket_lapor_status_nutrisi->addErrorMessage(str_replace("%s", $this->ket_lapor_status_nutrisi->caption(), $this->ket_lapor_status_nutrisi->RequiredErrorMessage));
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
        if ($this->resikojatuh->Required) {
            if ($this->resikojatuh->FormValue == "") {
                $this->resikojatuh->addErrorMessage(str_replace("%s", $this->resikojatuh->caption(), $this->resikojatuh->RequiredErrorMessage));
            }
        }
        if ($this->bjm->Required) {
            if ($this->bjm->FormValue == "") {
                $this->bjm->addErrorMessage(str_replace("%s", $this->bjm->caption(), $this->bjm->RequiredErrorMessage));
            }
        }
        if ($this->msa->Required) {
            if ($this->msa->FormValue == "") {
                $this->msa->addErrorMessage(str_replace("%s", $this->msa->caption(), $this->msa->RequiredErrorMessage));
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
        if ($this->adl_mandi->Required) {
            if ($this->adl_mandi->FormValue == "") {
                $this->adl_mandi->addErrorMessage(str_replace("%s", $this->adl_mandi->caption(), $this->adl_mandi->RequiredErrorMessage));
            }
        }
        if ($this->adl_berpakaian->Required) {
            if ($this->adl_berpakaian->FormValue == "") {
                $this->adl_berpakaian->addErrorMessage(str_replace("%s", $this->adl_berpakaian->caption(), $this->adl_berpakaian->RequiredErrorMessage));
            }
        }
        if ($this->adl_makan->Required) {
            if ($this->adl_makan->FormValue == "") {
                $this->adl_makan->addErrorMessage(str_replace("%s", $this->adl_makan->caption(), $this->adl_makan->RequiredErrorMessage));
            }
        }
        if ($this->adl_bak->Required) {
            if ($this->adl_bak->FormValue == "") {
                $this->adl_bak->addErrorMessage(str_replace("%s", $this->adl_bak->caption(), $this->adl_bak->RequiredErrorMessage));
            }
        }
        if ($this->adl_bab->Required) {
            if ($this->adl_bab->FormValue == "") {
                $this->adl_bab->addErrorMessage(str_replace("%s", $this->adl_bab->caption(), $this->adl_bab->RequiredErrorMessage));
            }
        }
        if ($this->adl_hobi->Required) {
            if ($this->adl_hobi->FormValue == "") {
                $this->adl_hobi->addErrorMessage(str_replace("%s", $this->adl_hobi->caption(), $this->adl_hobi->RequiredErrorMessage));
            }
        }
        if ($this->ket_adl_hobi->Required) {
            if (!$this->ket_adl_hobi->IsDetailKey && EmptyValue($this->ket_adl_hobi->FormValue)) {
                $this->ket_adl_hobi->addErrorMessage(str_replace("%s", $this->ket_adl_hobi->caption(), $this->ket_adl_hobi->RequiredErrorMessage));
            }
        }
        if ($this->adl_sosialisasi->Required) {
            if ($this->adl_sosialisasi->FormValue == "") {
                $this->adl_sosialisasi->addErrorMessage(str_replace("%s", $this->adl_sosialisasi->caption(), $this->adl_sosialisasi->RequiredErrorMessage));
            }
        }
        if ($this->ket_adl_sosialisasi->Required) {
            if (!$this->ket_adl_sosialisasi->IsDetailKey && EmptyValue($this->ket_adl_sosialisasi->FormValue)) {
                $this->ket_adl_sosialisasi->addErrorMessage(str_replace("%s", $this->ket_adl_sosialisasi->caption(), $this->ket_adl_sosialisasi->RequiredErrorMessage));
            }
        }
        if ($this->adl_kegiatan->Required) {
            if ($this->adl_kegiatan->FormValue == "") {
                $this->adl_kegiatan->addErrorMessage(str_replace("%s", $this->adl_kegiatan->caption(), $this->adl_kegiatan->RequiredErrorMessage));
            }
        }
        if ($this->ket_adl_kegiatan->Required) {
            if (!$this->ket_adl_kegiatan->IsDetailKey && EmptyValue($this->ket_adl_kegiatan->FormValue)) {
                $this->ket_adl_kegiatan->addErrorMessage(str_replace("%s", $this->ket_adl_kegiatan->caption(), $this->ket_adl_kegiatan->RequiredErrorMessage));
            }
        }
        if ($this->sk_penampilan->Required) {
            if ($this->sk_penampilan->FormValue == "") {
                $this->sk_penampilan->addErrorMessage(str_replace("%s", $this->sk_penampilan->caption(), $this->sk_penampilan->RequiredErrorMessage));
            }
        }
        if ($this->sk_alam_perasaan->Required) {
            if ($this->sk_alam_perasaan->FormValue == "") {
                $this->sk_alam_perasaan->addErrorMessage(str_replace("%s", $this->sk_alam_perasaan->caption(), $this->sk_alam_perasaan->RequiredErrorMessage));
            }
        }
        if ($this->sk_pembicaraan->Required) {
            if ($this->sk_pembicaraan->FormValue == "") {
                $this->sk_pembicaraan->addErrorMessage(str_replace("%s", $this->sk_pembicaraan->caption(), $this->sk_pembicaraan->RequiredErrorMessage));
            }
        }
        if ($this->sk_afek->Required) {
            if ($this->sk_afek->FormValue == "") {
                $this->sk_afek->addErrorMessage(str_replace("%s", $this->sk_afek->caption(), $this->sk_afek->RequiredErrorMessage));
            }
        }
        if ($this->sk_aktifitas_motorik->Required) {
            if ($this->sk_aktifitas_motorik->FormValue == "") {
                $this->sk_aktifitas_motorik->addErrorMessage(str_replace("%s", $this->sk_aktifitas_motorik->caption(), $this->sk_aktifitas_motorik->RequiredErrorMessage));
            }
        }
        if ($this->sk_gangguan_ringan->Required) {
            if ($this->sk_gangguan_ringan->FormValue == "") {
                $this->sk_gangguan_ringan->addErrorMessage(str_replace("%s", $this->sk_gangguan_ringan->caption(), $this->sk_gangguan_ringan->RequiredErrorMessage));
            }
        }
        if ($this->sk_proses_pikir->Required) {
            if ($this->sk_proses_pikir->FormValue == "") {
                $this->sk_proses_pikir->addErrorMessage(str_replace("%s", $this->sk_proses_pikir->caption(), $this->sk_proses_pikir->RequiredErrorMessage));
            }
        }
        if ($this->sk_orientasi->Required) {
            if ($this->sk_orientasi->FormValue == "") {
                $this->sk_orientasi->addErrorMessage(str_replace("%s", $this->sk_orientasi->caption(), $this->sk_orientasi->RequiredErrorMessage));
            }
        }
        if ($this->sk_tingkat_kesadaran_orientasi->Required) {
            if ($this->sk_tingkat_kesadaran_orientasi->FormValue == "") {
                $this->sk_tingkat_kesadaran_orientasi->addErrorMessage(str_replace("%s", $this->sk_tingkat_kesadaran_orientasi->caption(), $this->sk_tingkat_kesadaran_orientasi->RequiredErrorMessage));
            }
        }
        if ($this->sk_memori->Required) {
            if ($this->sk_memori->FormValue == "") {
                $this->sk_memori->addErrorMessage(str_replace("%s", $this->sk_memori->caption(), $this->sk_memori->RequiredErrorMessage));
            }
        }
        if ($this->sk_interaksi->Required) {
            if ($this->sk_interaksi->FormValue == "") {
                $this->sk_interaksi->addErrorMessage(str_replace("%s", $this->sk_interaksi->caption(), $this->sk_interaksi->RequiredErrorMessage));
            }
        }
        if ($this->sk_konsentrasi->Required) {
            if ($this->sk_konsentrasi->FormValue == "") {
                $this->sk_konsentrasi->addErrorMessage(str_replace("%s", $this->sk_konsentrasi->caption(), $this->sk_konsentrasi->RequiredErrorMessage));
            }
        }
        if ($this->sk_persepsi->Required) {
            if ($this->sk_persepsi->FormValue == "") {
                $this->sk_persepsi->addErrorMessage(str_replace("%s", $this->sk_persepsi->caption(), $this->sk_persepsi->RequiredErrorMessage));
            }
        }
        if ($this->ket_sk_persepsi->Required) {
            if (!$this->ket_sk_persepsi->IsDetailKey && EmptyValue($this->ket_sk_persepsi->FormValue)) {
                $this->ket_sk_persepsi->addErrorMessage(str_replace("%s", $this->ket_sk_persepsi->caption(), $this->ket_sk_persepsi->RequiredErrorMessage));
            }
        }
        if ($this->sk_isi_pikir->Required) {
            if ($this->sk_isi_pikir->FormValue == "") {
                $this->sk_isi_pikir->addErrorMessage(str_replace("%s", $this->sk_isi_pikir->caption(), $this->sk_isi_pikir->RequiredErrorMessage));
            }
        }
        if ($this->sk_waham->Required) {
            if ($this->sk_waham->FormValue == "") {
                $this->sk_waham->addErrorMessage(str_replace("%s", $this->sk_waham->caption(), $this->sk_waham->RequiredErrorMessage));
            }
        }
        if ($this->ket_sk_waham->Required) {
            if (!$this->ket_sk_waham->IsDetailKey && EmptyValue($this->ket_sk_waham->FormValue)) {
                $this->ket_sk_waham->addErrorMessage(str_replace("%s", $this->ket_sk_waham->caption(), $this->ket_sk_waham->RequiredErrorMessage));
            }
        }
        if ($this->sk_daya_tilik_diri->Required) {
            if ($this->sk_daya_tilik_diri->FormValue == "") {
                $this->sk_daya_tilik_diri->addErrorMessage(str_replace("%s", $this->sk_daya_tilik_diri->caption(), $this->sk_daya_tilik_diri->RequiredErrorMessage));
            }
        }
        if ($this->ket_sk_daya_tilik_diri->Required) {
            if (!$this->ket_sk_daya_tilik_diri->IsDetailKey && EmptyValue($this->ket_sk_daya_tilik_diri->FormValue)) {
                $this->ket_sk_daya_tilik_diri->addErrorMessage(str_replace("%s", $this->ket_sk_daya_tilik_diri->caption(), $this->ket_sk_daya_tilik_diri->RequiredErrorMessage));
            }
        }
        if ($this->kk_pembelajaran->Required) {
            if ($this->kk_pembelajaran->FormValue == "") {
                $this->kk_pembelajaran->addErrorMessage(str_replace("%s", $this->kk_pembelajaran->caption(), $this->kk_pembelajaran->RequiredErrorMessage));
            }
        }
        if ($this->ket_kk_pembelajaran->Required) {
            if ($this->ket_kk_pembelajaran->FormValue == "") {
                $this->ket_kk_pembelajaran->addErrorMessage(str_replace("%s", $this->ket_kk_pembelajaran->caption(), $this->ket_kk_pembelajaran->RequiredErrorMessage));
            }
        }
        if ($this->ket_kk_pembelajaran_lainnya->Required) {
            if (!$this->ket_kk_pembelajaran_lainnya->IsDetailKey && EmptyValue($this->ket_kk_pembelajaran_lainnya->FormValue)) {
                $this->ket_kk_pembelajaran_lainnya->addErrorMessage(str_replace("%s", $this->ket_kk_pembelajaran_lainnya->caption(), $this->ket_kk_pembelajaran_lainnya->RequiredErrorMessage));
            }
        }
        if ($this->kk_Penerjamah->Required) {
            if ($this->kk_Penerjamah->FormValue == "") {
                $this->kk_Penerjamah->addErrorMessage(str_replace("%s", $this->kk_Penerjamah->caption(), $this->kk_Penerjamah->RequiredErrorMessage));
            }
        }
        if ($this->ket_kk_penerjamah_Lainnya->Required) {
            if (!$this->ket_kk_penerjamah_Lainnya->IsDetailKey && EmptyValue($this->ket_kk_penerjamah_Lainnya->FormValue)) {
                $this->ket_kk_penerjamah_Lainnya->addErrorMessage(str_replace("%s", $this->ket_kk_penerjamah_Lainnya->caption(), $this->ket_kk_penerjamah_Lainnya->RequiredErrorMessage));
            }
        }
        if ($this->kk_bahasa_isyarat->Required) {
            if ($this->kk_bahasa_isyarat->FormValue == "") {
                $this->kk_bahasa_isyarat->addErrorMessage(str_replace("%s", $this->kk_bahasa_isyarat->caption(), $this->kk_bahasa_isyarat->RequiredErrorMessage));
            }
        }
        if ($this->kk_kebutuhan_edukasi->Required) {
            if ($this->kk_kebutuhan_edukasi->FormValue == "") {
                $this->kk_kebutuhan_edukasi->addErrorMessage(str_replace("%s", $this->kk_kebutuhan_edukasi->caption(), $this->kk_kebutuhan_edukasi->RequiredErrorMessage));
            }
        }
        if ($this->ket_kk_kebutuhan_edukasi->Required) {
            if (!$this->ket_kk_kebutuhan_edukasi->IsDetailKey && EmptyValue($this->ket_kk_kebutuhan_edukasi->FormValue)) {
                $this->ket_kk_kebutuhan_edukasi->addErrorMessage(str_replace("%s", $this->ket_kk_kebutuhan_edukasi->caption(), $this->ket_kk_kebutuhan_edukasi->RequiredErrorMessage));
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
            if ($this->no_rawat->getSessionValue() != "") {
                $this->no_rawat->ReadOnly = true;
            }
            $this->no_rawat->setDbValueDef($rsnew, $this->no_rawat->CurrentValue, "", $this->no_rawat->ReadOnly);

            // tanggal
            $this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), CurrentDate(), $this->tanggal->ReadOnly);

            // informasi
            $this->informasi->setDbValueDef($rsnew, $this->informasi->CurrentValue, "", $this->informasi->ReadOnly);

            // keluhan_utama
            $this->keluhan_utama->setDbValueDef($rsnew, $this->keluhan_utama->CurrentValue, "", $this->keluhan_utama->ReadOnly);

            // rkd_sakit_sejak
            $this->rkd_sakit_sejak->setDbValueDef($rsnew, $this->rkd_sakit_sejak->CurrentValue, "", $this->rkd_sakit_sejak->ReadOnly);

            // rkd_keluhan
            $this->rkd_keluhan->setDbValueDef($rsnew, $this->rkd_keluhan->CurrentValue, "", $this->rkd_keluhan->ReadOnly);

            // rkd_berobat
            $this->rkd_berobat->setDbValueDef($rsnew, $this->rkd_berobat->CurrentValue, "", $this->rkd_berobat->ReadOnly);

            // rkd_hasil_pengobatan
            $this->rkd_hasil_pengobatan->setDbValueDef($rsnew, $this->rkd_hasil_pengobatan->CurrentValue, "", $this->rkd_hasil_pengobatan->ReadOnly);

            // fp_putus_obat
            $this->fp_putus_obat->setDbValueDef($rsnew, $this->fp_putus_obat->CurrentValue, "", $this->fp_putus_obat->ReadOnly);

            // ket_putus_obat
            $this->ket_putus_obat->setDbValueDef($rsnew, $this->ket_putus_obat->CurrentValue, "", $this->ket_putus_obat->ReadOnly);

            // fp_ekonomi
            $this->fp_ekonomi->setDbValueDef($rsnew, $this->fp_ekonomi->CurrentValue, "", $this->fp_ekonomi->ReadOnly);

            // ket_masalah_ekonomi
            $this->ket_masalah_ekonomi->setDbValueDef($rsnew, $this->ket_masalah_ekonomi->CurrentValue, "", $this->ket_masalah_ekonomi->ReadOnly);

            // fp_masalah_fisik
            $this->fp_masalah_fisik->setDbValueDef($rsnew, $this->fp_masalah_fisik->CurrentValue, "", $this->fp_masalah_fisik->ReadOnly);

            // ket_masalah_fisik
            $this->ket_masalah_fisik->setDbValueDef($rsnew, $this->ket_masalah_fisik->CurrentValue, "", $this->ket_masalah_fisik->ReadOnly);

            // fp_masalah_psikososial
            $this->fp_masalah_psikososial->setDbValueDef($rsnew, $this->fp_masalah_psikososial->CurrentValue, "", $this->fp_masalah_psikososial->ReadOnly);

            // ket_masalah_psikososial
            $this->ket_masalah_psikososial->setDbValueDef($rsnew, $this->ket_masalah_psikososial->CurrentValue, "", $this->ket_masalah_psikososial->ReadOnly);

            // rh_keluarga
            $this->rh_keluarga->setDbValueDef($rsnew, $this->rh_keluarga->CurrentValue, "", $this->rh_keluarga->ReadOnly);

            // ket_rh_keluarga
            $this->ket_rh_keluarga->setDbValueDef($rsnew, $this->ket_rh_keluarga->CurrentValue, "", $this->ket_rh_keluarga->ReadOnly);

            // resiko_bunuh_diri
            $this->resiko_bunuh_diri->setDbValueDef($rsnew, $this->resiko_bunuh_diri->CurrentValue, "", $this->resiko_bunuh_diri->ReadOnly);

            // rbd_ide
            $this->rbd_ide->setDbValueDef($rsnew, $this->rbd_ide->CurrentValue, "", $this->rbd_ide->ReadOnly);

            // ket_rbd_ide
            $this->ket_rbd_ide->setDbValueDef($rsnew, $this->ket_rbd_ide->CurrentValue, "", $this->ket_rbd_ide->ReadOnly);

            // rbd_rencana
            $this->rbd_rencana->setDbValueDef($rsnew, $this->rbd_rencana->CurrentValue, "", $this->rbd_rencana->ReadOnly);

            // ket_rbd_rencana
            $this->ket_rbd_rencana->setDbValueDef($rsnew, $this->ket_rbd_rencana->CurrentValue, "", $this->ket_rbd_rencana->ReadOnly);

            // rbd_alat
            $this->rbd_alat->setDbValueDef($rsnew, $this->rbd_alat->CurrentValue, "", $this->rbd_alat->ReadOnly);

            // ket_rbd_alat
            $this->ket_rbd_alat->setDbValueDef($rsnew, $this->ket_rbd_alat->CurrentValue, "", $this->ket_rbd_alat->ReadOnly);

            // rbd_percobaan
            $this->rbd_percobaan->setDbValueDef($rsnew, $this->rbd_percobaan->CurrentValue, "", $this->rbd_percobaan->ReadOnly);

            // ket_rbd_percobaan
            $this->ket_rbd_percobaan->setDbValueDef($rsnew, $this->ket_rbd_percobaan->CurrentValue, "", $this->ket_rbd_percobaan->ReadOnly);

            // rbd_keinginan
            $this->rbd_keinginan->setDbValueDef($rsnew, $this->rbd_keinginan->CurrentValue, "", $this->rbd_keinginan->ReadOnly);

            // ket_rbd_keinginan
            $this->ket_rbd_keinginan->setDbValueDef($rsnew, $this->ket_rbd_keinginan->CurrentValue, "", $this->ket_rbd_keinginan->ReadOnly);

            // rpo_penggunaan
            $this->rpo_penggunaan->setDbValueDef($rsnew, $this->rpo_penggunaan->CurrentValue, "", $this->rpo_penggunaan->ReadOnly);

            // ket_rpo_penggunaan
            $this->ket_rpo_penggunaan->setDbValueDef($rsnew, $this->ket_rpo_penggunaan->CurrentValue, "", $this->ket_rpo_penggunaan->ReadOnly);

            // rpo_efek_samping
            $this->rpo_efek_samping->setDbValueDef($rsnew, $this->rpo_efek_samping->CurrentValue, "", $this->rpo_efek_samping->ReadOnly);

            // ket_rpo_efek_samping
            $this->ket_rpo_efek_samping->setDbValueDef($rsnew, $this->ket_rpo_efek_samping->CurrentValue, "", $this->ket_rpo_efek_samping->ReadOnly);

            // rpo_napza
            $this->rpo_napza->setDbValueDef($rsnew, $this->rpo_napza->CurrentValue, "", $this->rpo_napza->ReadOnly);

            // ket_rpo_napza
            $this->ket_rpo_napza->setDbValueDef($rsnew, $this->ket_rpo_napza->CurrentValue, "", $this->ket_rpo_napza->ReadOnly);

            // ket_lama_pemakaian
            $this->ket_lama_pemakaian->setDbValueDef($rsnew, $this->ket_lama_pemakaian->CurrentValue, "", $this->ket_lama_pemakaian->ReadOnly);

            // ket_cara_pemakaian
            $this->ket_cara_pemakaian->setDbValueDef($rsnew, $this->ket_cara_pemakaian->CurrentValue, "", $this->ket_cara_pemakaian->ReadOnly);

            // ket_latar_belakang_pemakaian
            $this->ket_latar_belakang_pemakaian->setDbValueDef($rsnew, $this->ket_latar_belakang_pemakaian->CurrentValue, "", $this->ket_latar_belakang_pemakaian->ReadOnly);

            // rpo_penggunaan_obat_lainnya
            $this->rpo_penggunaan_obat_lainnya->setDbValueDef($rsnew, $this->rpo_penggunaan_obat_lainnya->CurrentValue, "", $this->rpo_penggunaan_obat_lainnya->ReadOnly);

            // ket_penggunaan_obat_lainnya
            $this->ket_penggunaan_obat_lainnya->setDbValueDef($rsnew, $this->ket_penggunaan_obat_lainnya->CurrentValue, "", $this->ket_penggunaan_obat_lainnya->ReadOnly);

            // ket_alasan_penggunaan
            $this->ket_alasan_penggunaan->setDbValueDef($rsnew, $this->ket_alasan_penggunaan->CurrentValue, "", $this->ket_alasan_penggunaan->ReadOnly);

            // rpo_alergi_obat
            $this->rpo_alergi_obat->setDbValueDef($rsnew, $this->rpo_alergi_obat->CurrentValue, "", $this->rpo_alergi_obat->ReadOnly);

            // ket_alergi_obat
            $this->ket_alergi_obat->setDbValueDef($rsnew, $this->ket_alergi_obat->CurrentValue, "", $this->ket_alergi_obat->ReadOnly);

            // rpo_merokok
            $this->rpo_merokok->setDbValueDef($rsnew, $this->rpo_merokok->CurrentValue, "", $this->rpo_merokok->ReadOnly);

            // ket_merokok
            $this->ket_merokok->setDbValueDef($rsnew, $this->ket_merokok->CurrentValue, "", $this->ket_merokok->ReadOnly);

            // rpo_minum_kopi
            $this->rpo_minum_kopi->setDbValueDef($rsnew, $this->rpo_minum_kopi->CurrentValue, "", $this->rpo_minum_kopi->ReadOnly);

            // ket_minum_kopi
            $this->ket_minum_kopi->setDbValueDef($rsnew, $this->ket_minum_kopi->CurrentValue, "", $this->ket_minum_kopi->ReadOnly);

            // td
            $this->td->setDbValueDef($rsnew, $this->td->CurrentValue, "", $this->td->ReadOnly);

            // nadi
            $this->nadi->setDbValueDef($rsnew, $this->nadi->CurrentValue, "", $this->nadi->ReadOnly);

            // gcs
            $this->gcs->setDbValueDef($rsnew, $this->gcs->CurrentValue, "", $this->gcs->ReadOnly);

            // rr
            $this->rr->setDbValueDef($rsnew, $this->rr->CurrentValue, "", $this->rr->ReadOnly);

            // suhu
            $this->suhu->setDbValueDef($rsnew, $this->suhu->CurrentValue, "", $this->suhu->ReadOnly);

            // pf_keluhan_fisik
            $this->pf_keluhan_fisik->setDbValueDef($rsnew, $this->pf_keluhan_fisik->CurrentValue, "", $this->pf_keluhan_fisik->ReadOnly);

            // ket_keluhan_fisik
            $this->ket_keluhan_fisik->setDbValueDef($rsnew, $this->ket_keluhan_fisik->CurrentValue, "", $this->ket_keluhan_fisik->ReadOnly);

            // skala_nyeri
            $this->skala_nyeri->setDbValueDef($rsnew, $this->skala_nyeri->CurrentValue, "", $this->skala_nyeri->ReadOnly);

            // durasi
            $this->durasi->setDbValueDef($rsnew, $this->durasi->CurrentValue, "", $this->durasi->ReadOnly);

            // nyeri
            $this->nyeri->setDbValueDef($rsnew, $this->nyeri->CurrentValue, "", $this->nyeri->ReadOnly);

            // provokes
            $this->provokes->setDbValueDef($rsnew, $this->provokes->CurrentValue, "", $this->provokes->ReadOnly);

            // ket_provokes
            $this->ket_provokes->setDbValueDef($rsnew, $this->ket_provokes->CurrentValue, "", $this->ket_provokes->ReadOnly);

            // quality
            $this->quality->setDbValueDef($rsnew, $this->quality->CurrentValue, "", $this->quality->ReadOnly);

            // ket_quality
            $this->ket_quality->setDbValueDef($rsnew, $this->ket_quality->CurrentValue, "", $this->ket_quality->ReadOnly);

            // lokasi
            $this->lokasi->setDbValueDef($rsnew, $this->lokasi->CurrentValue, "", $this->lokasi->ReadOnly);

            // menyebar
            $this->menyebar->setDbValueDef($rsnew, $this->menyebar->CurrentValue, "", $this->menyebar->ReadOnly);

            // pada_dokter
            $this->pada_dokter->setDbValueDef($rsnew, $this->pada_dokter->CurrentValue, "", $this->pada_dokter->ReadOnly);

            // ket_dokter
            $this->ket_dokter->setDbValueDef($rsnew, $this->ket_dokter->CurrentValue, "", $this->ket_dokter->ReadOnly);

            // nyeri_hilang
            $this->nyeri_hilang->setDbValueDef($rsnew, $this->nyeri_hilang->CurrentValue, "", $this->nyeri_hilang->ReadOnly);

            // ket_nyeri
            $this->ket_nyeri->setDbValueDef($rsnew, $this->ket_nyeri->CurrentValue, "", $this->ket_nyeri->ReadOnly);

            // bb
            $this->bb->setDbValueDef($rsnew, $this->bb->CurrentValue, "", $this->bb->ReadOnly);

            // tb
            $this->tb->setDbValueDef($rsnew, $this->tb->CurrentValue, "", $this->tb->ReadOnly);

            // bmi
            $this->bmi->setDbValueDef($rsnew, $this->bmi->CurrentValue, "", $this->bmi->ReadOnly);

            // lapor_status_nutrisi
            $this->lapor_status_nutrisi->setDbValueDef($rsnew, $this->lapor_status_nutrisi->CurrentValue, "", $this->lapor_status_nutrisi->ReadOnly);

            // ket_lapor_status_nutrisi
            $this->ket_lapor_status_nutrisi->setDbValueDef($rsnew, $this->ket_lapor_status_nutrisi->CurrentValue, "", $this->ket_lapor_status_nutrisi->ReadOnly);

            // sg1
            $this->sg1->setDbValueDef($rsnew, $this->sg1->CurrentValue, "", $this->sg1->ReadOnly);

            // nilai1
            $this->nilai1->setDbValueDef($rsnew, $this->nilai1->CurrentValue, "", $this->nilai1->ReadOnly);

            // sg2
            $this->sg2->setDbValueDef($rsnew, $this->sg2->CurrentValue, "", $this->sg2->ReadOnly);

            // nilai2
            $tmpBool = $this->nilai2->CurrentValue;
            if ($tmpBool != "1" && $tmpBool != "0") {
                $tmpBool = !empty($tmpBool) ? "1" : "0";
            }
            $this->nilai2->setDbValueDef($rsnew, $tmpBool, 0, $this->nilai2->ReadOnly);

            // total_hasil
            $this->total_hasil->setDbValueDef($rsnew, $this->total_hasil->CurrentValue, 0, $this->total_hasil->ReadOnly);

            // resikojatuh
            $this->resikojatuh->setDbValueDef($rsnew, $this->resikojatuh->CurrentValue, "", $this->resikojatuh->ReadOnly);

            // bjm
            $this->bjm->setDbValueDef($rsnew, $this->bjm->CurrentValue, "", $this->bjm->ReadOnly);

            // msa
            $this->msa->setDbValueDef($rsnew, $this->msa->CurrentValue, "", $this->msa->ReadOnly);

            // hasil
            $this->hasil->setDbValueDef($rsnew, $this->hasil->CurrentValue, "", $this->hasil->ReadOnly);

            // lapor
            $this->lapor->setDbValueDef($rsnew, $this->lapor->CurrentValue, "", $this->lapor->ReadOnly);

            // ket_lapor
            $this->ket_lapor->setDbValueDef($rsnew, $this->ket_lapor->CurrentValue, "", $this->ket_lapor->ReadOnly);

            // adl_mandi
            $this->adl_mandi->setDbValueDef($rsnew, $this->adl_mandi->CurrentValue, "", $this->adl_mandi->ReadOnly);

            // adl_berpakaian
            $this->adl_berpakaian->setDbValueDef($rsnew, $this->adl_berpakaian->CurrentValue, "", $this->adl_berpakaian->ReadOnly);

            // adl_makan
            $this->adl_makan->setDbValueDef($rsnew, $this->adl_makan->CurrentValue, "", $this->adl_makan->ReadOnly);

            // adl_bak
            $this->adl_bak->setDbValueDef($rsnew, $this->adl_bak->CurrentValue, "", $this->adl_bak->ReadOnly);

            // adl_bab
            $this->adl_bab->setDbValueDef($rsnew, $this->adl_bab->CurrentValue, "", $this->adl_bab->ReadOnly);

            // adl_hobi
            $this->adl_hobi->setDbValueDef($rsnew, $this->adl_hobi->CurrentValue, "", $this->adl_hobi->ReadOnly);

            // ket_adl_hobi
            $this->ket_adl_hobi->setDbValueDef($rsnew, $this->ket_adl_hobi->CurrentValue, "", $this->ket_adl_hobi->ReadOnly);

            // adl_sosialisasi
            $this->adl_sosialisasi->setDbValueDef($rsnew, $this->adl_sosialisasi->CurrentValue, "", $this->adl_sosialisasi->ReadOnly);

            // ket_adl_sosialisasi
            $this->ket_adl_sosialisasi->setDbValueDef($rsnew, $this->ket_adl_sosialisasi->CurrentValue, "", $this->ket_adl_sosialisasi->ReadOnly);

            // adl_kegiatan
            $this->adl_kegiatan->setDbValueDef($rsnew, $this->adl_kegiatan->CurrentValue, "", $this->adl_kegiatan->ReadOnly);

            // ket_adl_kegiatan
            $this->ket_adl_kegiatan->setDbValueDef($rsnew, $this->ket_adl_kegiatan->CurrentValue, "", $this->ket_adl_kegiatan->ReadOnly);

            // sk_penampilan
            $this->sk_penampilan->setDbValueDef($rsnew, $this->sk_penampilan->CurrentValue, "", $this->sk_penampilan->ReadOnly);

            // sk_alam_perasaan
            $this->sk_alam_perasaan->setDbValueDef($rsnew, $this->sk_alam_perasaan->CurrentValue, "", $this->sk_alam_perasaan->ReadOnly);

            // sk_pembicaraan
            $this->sk_pembicaraan->setDbValueDef($rsnew, $this->sk_pembicaraan->CurrentValue, "", $this->sk_pembicaraan->ReadOnly);

            // sk_afek
            $this->sk_afek->setDbValueDef($rsnew, $this->sk_afek->CurrentValue, "", $this->sk_afek->ReadOnly);

            // sk_aktifitas_motorik
            $this->sk_aktifitas_motorik->setDbValueDef($rsnew, $this->sk_aktifitas_motorik->CurrentValue, "", $this->sk_aktifitas_motorik->ReadOnly);

            // sk_gangguan_ringan
            $this->sk_gangguan_ringan->setDbValueDef($rsnew, $this->sk_gangguan_ringan->CurrentValue, "", $this->sk_gangguan_ringan->ReadOnly);

            // sk_proses_pikir
            $this->sk_proses_pikir->setDbValueDef($rsnew, $this->sk_proses_pikir->CurrentValue, "", $this->sk_proses_pikir->ReadOnly);

            // sk_orientasi
            $this->sk_orientasi->setDbValueDef($rsnew, $this->sk_orientasi->CurrentValue, "", $this->sk_orientasi->ReadOnly);

            // sk_tingkat_kesadaran_orientasi
            $this->sk_tingkat_kesadaran_orientasi->setDbValueDef($rsnew, $this->sk_tingkat_kesadaran_orientasi->CurrentValue, "", $this->sk_tingkat_kesadaran_orientasi->ReadOnly);

            // sk_memori
            $this->sk_memori->setDbValueDef($rsnew, $this->sk_memori->CurrentValue, "", $this->sk_memori->ReadOnly);

            // sk_interaksi
            $this->sk_interaksi->setDbValueDef($rsnew, $this->sk_interaksi->CurrentValue, "", $this->sk_interaksi->ReadOnly);

            // sk_konsentrasi
            $this->sk_konsentrasi->setDbValueDef($rsnew, $this->sk_konsentrasi->CurrentValue, "", $this->sk_konsentrasi->ReadOnly);

            // sk_persepsi
            $this->sk_persepsi->setDbValueDef($rsnew, $this->sk_persepsi->CurrentValue, "", $this->sk_persepsi->ReadOnly);

            // ket_sk_persepsi
            $this->ket_sk_persepsi->setDbValueDef($rsnew, $this->ket_sk_persepsi->CurrentValue, "", $this->ket_sk_persepsi->ReadOnly);

            // sk_isi_pikir
            $this->sk_isi_pikir->setDbValueDef($rsnew, $this->sk_isi_pikir->CurrentValue, "", $this->sk_isi_pikir->ReadOnly);

            // sk_waham
            $this->sk_waham->setDbValueDef($rsnew, $this->sk_waham->CurrentValue, "", $this->sk_waham->ReadOnly);

            // ket_sk_waham
            $this->ket_sk_waham->setDbValueDef($rsnew, $this->ket_sk_waham->CurrentValue, "", $this->ket_sk_waham->ReadOnly);

            // sk_daya_tilik_diri
            $this->sk_daya_tilik_diri->setDbValueDef($rsnew, $this->sk_daya_tilik_diri->CurrentValue, "", $this->sk_daya_tilik_diri->ReadOnly);

            // ket_sk_daya_tilik_diri
            $this->ket_sk_daya_tilik_diri->setDbValueDef($rsnew, $this->ket_sk_daya_tilik_diri->CurrentValue, "", $this->ket_sk_daya_tilik_diri->ReadOnly);

            // kk_pembelajaran
            $this->kk_pembelajaran->setDbValueDef($rsnew, $this->kk_pembelajaran->CurrentValue, "", $this->kk_pembelajaran->ReadOnly);

            // ket_kk_pembelajaran
            $this->ket_kk_pembelajaran->setDbValueDef($rsnew, $this->ket_kk_pembelajaran->CurrentValue, "", $this->ket_kk_pembelajaran->ReadOnly);

            // ket_kk_pembelajaran_lainnya
            $this->ket_kk_pembelajaran_lainnya->setDbValueDef($rsnew, $this->ket_kk_pembelajaran_lainnya->CurrentValue, "", $this->ket_kk_pembelajaran_lainnya->ReadOnly);

            // kk_Penerjamah
            $this->kk_Penerjamah->setDbValueDef($rsnew, $this->kk_Penerjamah->CurrentValue, "", $this->kk_Penerjamah->ReadOnly);

            // ket_kk_penerjamah_Lainnya
            $this->ket_kk_penerjamah_Lainnya->setDbValueDef($rsnew, $this->ket_kk_penerjamah_Lainnya->CurrentValue, "", $this->ket_kk_penerjamah_Lainnya->ReadOnly);

            // kk_bahasa_isyarat
            $this->kk_bahasa_isyarat->setDbValueDef($rsnew, $this->kk_bahasa_isyarat->CurrentValue, "", $this->kk_bahasa_isyarat->ReadOnly);

            // kk_kebutuhan_edukasi
            $this->kk_kebutuhan_edukasi->setDbValueDef($rsnew, $this->kk_kebutuhan_edukasi->CurrentValue, "", $this->kk_kebutuhan_edukasi->ReadOnly);

            // ket_kk_kebutuhan_edukasi
            $this->ket_kk_kebutuhan_edukasi->setDbValueDef($rsnew, $this->ket_kk_kebutuhan_edukasi->CurrentValue, "", $this->ket_kk_kebutuhan_edukasi->ReadOnly);

            // rencana
            $this->rencana->setDbValueDef($rsnew, $this->rencana->CurrentValue, "", $this->rencana->ReadOnly);

            // nip
            $this->nip->setDbValueDef($rsnew, $this->nip->CurrentValue, null, $this->nip->ReadOnly);

            // Check referential integrity for master table 'vrajal'
            $validMasterRecord = true;
            $masterFilter = $this->sqlMasterFilter_vrajal();
            $keyValue = $rsnew['no_rawat'] ?? $rsold['no_rawat'];
            if (strval($keyValue) != "") {
                $masterFilter = str_replace("@id_reg@", AdjustSql($keyValue), $masterFilter);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PenilaianAwalKeperawatanRalanPsikiatriList"), "", $this->TableVar, true);
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
}
