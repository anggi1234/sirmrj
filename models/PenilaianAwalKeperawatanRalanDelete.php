<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PenilaianAwalKeperawatanRalanDelete extends PenilaianAwalKeperawatanRalan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penilaian_awal_keperawatan_ralan';

    // Page object name
    public $PageObjName = "PenilaianAwalKeperawatanRalanDelete";

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
        $this->no_rawat->setVisibility();
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
            $this->terminate("PenilaianAwalKeperawatanRalanList"); // Prevent SQL injection, return to list
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
                $this->terminate("PenilaianAwalKeperawatanRalanList"); // Return to list
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
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['no_rawat'] = null;
        $row['tanggal'] = null;
        $row['informasi'] = null;
        $row['td'] = null;
        $row['nadi'] = null;
        $row['rr'] = null;
        $row['suhu'] = null;
        $row['gcs'] = null;
        $row['bb'] = null;
        $row['tb'] = null;
        $row['bmi'] = null;
        $row['keluhan_utama'] = null;
        $row['rpd'] = null;
        $row['rpk'] = null;
        $row['rpo'] = null;
        $row['alergi'] = null;
        $row['alat_bantu'] = null;
        $row['ket_bantu'] = null;
        $row['prothesa'] = null;
        $row['ket_pro'] = null;
        $row['adl'] = null;
        $row['status_psiko'] = null;
        $row['ket_psiko'] = null;
        $row['hub_keluarga'] = null;
        $row['tinggal_dengan'] = null;
        $row['ket_tinggal'] = null;
        $row['ekonomi'] = null;
        $row['budaya'] = null;
        $row['ket_budaya'] = null;
        $row['edukasi'] = null;
        $row['ket_edukasi'] = null;
        $row['berjalan_a'] = null;
        $row['berjalan_b'] = null;
        $row['berjalan_c'] = null;
        $row['hasil'] = null;
        $row['lapor'] = null;
        $row['ket_lapor'] = null;
        $row['sg1'] = null;
        $row['nilai1'] = null;
        $row['sg2'] = null;
        $row['nilai2'] = null;
        $row['total_hasil'] = null;
        $row['nyeri'] = null;
        $row['provokes'] = null;
        $row['ket_provokes'] = null;
        $row['quality'] = null;
        $row['ket_quality'] = null;
        $row['lokasi'] = null;
        $row['menyebar'] = null;
        $row['skala_nyeri'] = null;
        $row['durasi'] = null;
        $row['nyeri_hilang'] = null;
        $row['ket_nyeri'] = null;
        $row['pada_dokter'] = null;
        $row['ket_dokter'] = null;
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
                $thisKey .= $row['no_rawat'];
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PenilaianAwalKeperawatanRalanList"), "", $this->TableVar, true);
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
}
