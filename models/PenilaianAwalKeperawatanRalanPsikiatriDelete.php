<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianAwalKeperawatanRalanPsikiatriDelete extends PenilaianAwalKeperawatanRalanPsikiatri
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_awal_keperawatan_ralan_psikiatri';

    // Page object name
    public $PageObjName = "PenilaianAwalKeperawatanRalanPsikiatriDelete";

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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;
        $this->CurrentAction = Param("action"); // Set up current action
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

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Set up master/detail parameters
        $this->setupMasterParms();

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("PenilaianAwalKeperawatanRalanPsikiatriList"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("PenilaianAwalKeperawatanRalanPsikiatriList"); // Return to list
                return;
            }
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

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $deleteRows = true;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAll($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }
        $conn->beginTransaction();

        // Clone old rows
        $rsold = $rows;

        // Call row deleting event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $deleteRows = $this->rowDeleting($row);
                if (!$deleteRows) {
                    break;
                }
            }
        }
        if ($deleteRows) {
            $key = "";
            foreach ($rsold as $row) {
                $thisKey = "";
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['id_penilaian_awal_keperawatan_ralan_psikiatri'];
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }
                $deleteRows = $this->delete($row); // Delete
                if ($deleteRows === false) {
                    break;
                }
                if ($key != "") {
                    $key .= ", ";
                }
                $key .= $thisKey;
            }
        }
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }
        if ($deleteRows) {
            $conn->commit(); // Commit the changes
        } else {
            $conn->rollback(); // Rollback changes
        }

        // Call Row Deleted event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $this->rowDeleted($row);
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
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
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
}
