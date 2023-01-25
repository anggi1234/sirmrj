<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienDelete extends Pasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pasien';

    // Page object name
    public $PageObjName = "PasienDelete";

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

        // Table object (pasien)
        if (!isset($GLOBALS["pasien"]) || get_class($GLOBALS["pasien"]) == PROJECT_NAMESPACE . "pasien") {
            $GLOBALS["pasien"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pasien');
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
                $doc = new $class(Container("pasien"));
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
        $this->id_pasien->Visible = false;
        $this->no_rkm_medis->setVisibility();
        $this->nm_pasien->setVisibility();
        $this->no_ktp->Visible = false;
        $this->jk->setVisibility();
        $this->tmp_lahir->Visible = false;
        $this->tgl_lahir->Visible = false;
        $this->nm_ibu->setVisibility();
        $this->alamat->setVisibility();
        $this->gol_darah->Visible = false;
        $this->pekerjaan->Visible = false;
        $this->stts_nikah->Visible = false;
        $this->agama->Visible = false;
        $this->tgl_daftar->setVisibility();
        $this->no_tlp->Visible = false;
        $this->umur->Visible = false;
        $this->pnd->Visible = false;
        $this->keluarga->Visible = false;
        $this->namakeluarga->Visible = false;
        $this->kd_pj->Visible = false;
        $this->no_peserta->setVisibility();
        $this->kd_kel->Visible = false;
        $this->kd_kec->Visible = false;
        $this->kd_kab->Visible = false;
        $this->kd_prop->Visible = false;
        $this->pekerjaanpj->Visible = false;
        $this->alamatpj->Visible = false;
        $this->kelurahanpj->Visible = false;
        $this->kecamatanpj->Visible = false;
        $this->kabupatenpj->Visible = false;
        $this->perusahaan_pasien->Visible = false;
        $this->suku_bangsa->Visible = false;
        $this->bahasa_pasien->Visible = false;
        $this->cacat_fisik->Visible = false;
        $this->_email->Visible = false;
        $this->nip->Visible = false;
        $this->propinsipj->Visible = false;
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
        $this->setupLookupOptions($this->agama);
        $this->setupLookupOptions($this->kd_pj);
        $this->setupLookupOptions($this->kd_kel);
        $this->setupLookupOptions($this->kd_kec);
        $this->setupLookupOptions($this->kd_kab);
        $this->setupLookupOptions($this->kd_prop);
        $this->setupLookupOptions($this->perusahaan_pasien);
        $this->setupLookupOptions($this->suku_bangsa);
        $this->setupLookupOptions($this->bahasa_pasien);
        $this->setupLookupOptions($this->cacat_fisik);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("PasienList"); // Prevent SQL injection, return to list
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
                $this->terminate("PasienList"); // Return to list
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id_pasien
        $this->id_pasien->CellCssStyle = "white-space: nowrap;";

        // no_rkm_medis
        $this->no_rkm_medis->CellCssStyle = "white-space: nowrap;";

        // nm_pasien
        $this->nm_pasien->CellCssStyle = "white-space: nowrap;";

        // no_ktp
        $this->no_ktp->CellCssStyle = "white-space: nowrap;";

        // jk
        $this->jk->CellCssStyle = "white-space: nowrap;";

        // tmp_lahir
        $this->tmp_lahir->CellCssStyle = "white-space: nowrap;";

        // tgl_lahir
        $this->tgl_lahir->CellCssStyle = "white-space: nowrap;";

        // nm_ibu
        $this->nm_ibu->CellCssStyle = "white-space: nowrap;";

        // alamat
        $this->alamat->CellCssStyle = "white-space: nowrap;";

        // gol_darah
        $this->gol_darah->CellCssStyle = "white-space: nowrap;";

        // pekerjaan
        $this->pekerjaan->CellCssStyle = "white-space: nowrap;";

        // stts_nikah
        $this->stts_nikah->CellCssStyle = "white-space: nowrap;";

        // agama
        $this->agama->CellCssStyle = "white-space: nowrap;";

        // tgl_daftar
        $this->tgl_daftar->CellCssStyle = "white-space: nowrap;";

        // no_tlp
        $this->no_tlp->CellCssStyle = "white-space: nowrap;";

        // umur
        $this->umur->CellCssStyle = "white-space: nowrap;";

        // pnd
        $this->pnd->CellCssStyle = "white-space: nowrap;";

        // keluarga
        $this->keluarga->CellCssStyle = "white-space: nowrap;";

        // namakeluarga
        $this->namakeluarga->CellCssStyle = "white-space: nowrap;";

        // kd_pj
        $this->kd_pj->CellCssStyle = "white-space: nowrap;";

        // no_peserta
        $this->no_peserta->CellCssStyle = "white-space: nowrap;";

        // kd_kel
        $this->kd_kel->CellCssStyle = "white-space: nowrap;";

        // kd_kec
        $this->kd_kec->CellCssStyle = "white-space: nowrap;";

        // kd_kab
        $this->kd_kab->CellCssStyle = "white-space: nowrap;";

        // kd_prop
        $this->kd_prop->CellCssStyle = "white-space: nowrap;";

        // pekerjaanpj
        $this->pekerjaanpj->CellCssStyle = "white-space: nowrap;";

        // alamatpj
        $this->alamatpj->CellCssStyle = "white-space: nowrap;";

        // kelurahanpj
        $this->kelurahanpj->CellCssStyle = "white-space: nowrap;";

        // kecamatanpj
        $this->kecamatanpj->CellCssStyle = "white-space: nowrap;";

        // kabupatenpj
        $this->kabupatenpj->CellCssStyle = "white-space: nowrap;";

        // perusahaan_pasien
        $this->perusahaan_pasien->CellCssStyle = "white-space: nowrap;";

        // suku_bangsa
        $this->suku_bangsa->CellCssStyle = "white-space: nowrap;";

        // bahasa_pasien
        $this->bahasa_pasien->CellCssStyle = "white-space: nowrap;";

        // cacat_fisik
        $this->cacat_fisik->CellCssStyle = "white-space: nowrap;";

        // email
        $this->_email->CellCssStyle = "white-space: nowrap;";

        // nip
        $this->nip->CellCssStyle = "white-space: nowrap;";

        // propinsipj
        $this->propinsipj->CellCssStyle = "white-space: nowrap;";
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
            $this->tgl_lahir->ViewValue = FormatDateTime($this->tgl_lahir->ViewValue, 7);
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
            $curVal = trim(strval($this->agama->CurrentValue));
            if ($curVal != "") {
                $this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
                if ($this->agama->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id_agama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->agama->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->agama->Lookup->renderViewRow($rswrk[0]);
                        $this->agama->ViewValue = $this->agama->displayValue($arwrk);
                    } else {
                        $this->agama->ViewValue = $this->agama->CurrentValue;
                    }
                }
            } else {
                $this->agama->ViewValue = null;
            }
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

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";
            $this->jk->TooltipValue = "";

            // nm_ibu
            $this->nm_ibu->LinkCustomAttributes = "";
            $this->nm_ibu->HrefValue = "";
            $this->nm_ibu->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";

            // no_peserta
            $this->no_peserta->LinkCustomAttributes = "";
            $this->no_peserta->HrefValue = "";
            $this->no_peserta->TooltipValue = "";
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
                $thisKey .= $row['id_pasien'];
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PasienList"), "", $this->TableVar, true);
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
                case "x_jk":
                    break;
                case "x_gol_darah":
                    break;
                case "x_stts_nikah":
                    break;
                case "x_agama":
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
