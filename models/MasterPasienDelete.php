<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MasterPasienDelete extends MasterPasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'master_pasien';

    // Page object name
    public $PageObjName = "MasterPasienDelete";

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

        // Table object (master_pasien)
        if (!isset($GLOBALS["master_pasien"]) || get_class($GLOBALS["master_pasien"]) == PROJECT_NAMESPACE . "master_pasien") {
            $GLOBALS["master_pasien"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'master_pasien');
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
                $doc = new $class(Container("master_pasien"));
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
        $this->id_pasien->setVisibility();
        $this->nama_pasien->setVisibility();
        $this->no_rekam_medis->setVisibility();
        $this->nik->setVisibility();
        $this->no_identitas_lain->setVisibility();
        $this->nama_ibu->setVisibility();
        $this->tempat_lahir->setVisibility();
        $this->tanggal_lahir->setVisibility();
        $this->jenis_kelamin->setVisibility();
        $this->agama->setVisibility();
        $this->suku->setVisibility();
        $this->bahasa->setVisibility();
        $this->alamat->setVisibility();
        $this->rt->setVisibility();
        $this->rw->setVisibility();
        $this->keluarahan_desa->setVisibility();
        $this->kecamatan->setVisibility();
        $this->kabupaten_kota->setVisibility();
        $this->kodepos->setVisibility();
        $this->provinsi->setVisibility();
        $this->negara->setVisibility();
        $this->alamat_domisili->setVisibility();
        $this->rt_domisili->setVisibility();
        $this->rw_domisili->setVisibility();
        $this->kel_desa_domisili->setVisibility();
        $this->kec_domisili->setVisibility();
        $this->kota_kab_domisili->setVisibility();
        $this->kodepos_domisili->setVisibility();
        $this->prov_domisili->setVisibility();
        $this->negara_domisili->setVisibility();
        $this->no_telp->setVisibility();
        $this->no_hp->setVisibility();
        $this->pendidikan->setVisibility();
        $this->pekerjaan->setVisibility();
        $this->status_kawin->setVisibility();
        $this->tgl_daftar->setVisibility();
        $this->_username->setVisibility();
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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("MasterPasienList"); // Prevent SQL injection, return to list
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
                $this->terminate("MasterPasienList"); // Return to list
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
        $this->nama_pasien->setDbValue($row['nama_pasien']);
        $this->no_rekam_medis->setDbValue($row['no_rekam_medis']);
        $this->nik->setDbValue($row['nik']);
        $this->no_identitas_lain->setDbValue($row['no_identitas_lain']);
        $this->nama_ibu->setDbValue($row['nama_ibu']);
        $this->tempat_lahir->setDbValue($row['tempat_lahir']);
        $this->tanggal_lahir->setDbValue($row['tanggal_lahir']);
        $this->jenis_kelamin->setDbValue($row['jenis_kelamin']);
        $this->agama->setDbValue($row['agama']);
        $this->suku->setDbValue($row['suku']);
        $this->bahasa->setDbValue($row['bahasa']);
        $this->alamat->setDbValue($row['alamat']);
        $this->rt->setDbValue($row['rt']);
        $this->rw->setDbValue($row['rw']);
        $this->keluarahan_desa->setDbValue($row['keluarahan_desa']);
        $this->kecamatan->setDbValue($row['kecamatan']);
        $this->kabupaten_kota->setDbValue($row['kabupaten_kota']);
        $this->kodepos->setDbValue($row['kodepos']);
        $this->provinsi->setDbValue($row['provinsi']);
        $this->negara->setDbValue($row['negara']);
        $this->alamat_domisili->setDbValue($row['alamat_domisili']);
        $this->rt_domisili->setDbValue($row['rt_domisili']);
        $this->rw_domisili->setDbValue($row['rw_domisili']);
        $this->kel_desa_domisili->setDbValue($row['kel_desa_domisili']);
        $this->kec_domisili->setDbValue($row['kec_domisili']);
        $this->kota_kab_domisili->setDbValue($row['kota_kab_domisili']);
        $this->kodepos_domisili->setDbValue($row['kodepos_domisili']);
        $this->prov_domisili->setDbValue($row['prov_domisili']);
        $this->negara_domisili->setDbValue($row['negara_domisili']);
        $this->no_telp->setDbValue($row['no_telp']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->status_kawin->setDbValue($row['status_kawin']);
        $this->tgl_daftar->setDbValue($row['tgl_daftar']);
        $this->_username->setDbValue($row['username']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_pasien'] = null;
        $row['nama_pasien'] = null;
        $row['no_rekam_medis'] = null;
        $row['nik'] = null;
        $row['no_identitas_lain'] = null;
        $row['nama_ibu'] = null;
        $row['tempat_lahir'] = null;
        $row['tanggal_lahir'] = null;
        $row['jenis_kelamin'] = null;
        $row['agama'] = null;
        $row['suku'] = null;
        $row['bahasa'] = null;
        $row['alamat'] = null;
        $row['rt'] = null;
        $row['rw'] = null;
        $row['keluarahan_desa'] = null;
        $row['kecamatan'] = null;
        $row['kabupaten_kota'] = null;
        $row['kodepos'] = null;
        $row['provinsi'] = null;
        $row['negara'] = null;
        $row['alamat_domisili'] = null;
        $row['rt_domisili'] = null;
        $row['rw_domisili'] = null;
        $row['kel_desa_domisili'] = null;
        $row['kec_domisili'] = null;
        $row['kota_kab_domisili'] = null;
        $row['kodepos_domisili'] = null;
        $row['prov_domisili'] = null;
        $row['negara_domisili'] = null;
        $row['no_telp'] = null;
        $row['no_hp'] = null;
        $row['pendidikan'] = null;
        $row['pekerjaan'] = null;
        $row['status_kawin'] = null;
        $row['tgl_daftar'] = null;
        $row['username'] = null;
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

        // nama_pasien

        // no_rekam_medis

        // nik

        // no_identitas_lain

        // nama_ibu

        // tempat_lahir

        // tanggal_lahir

        // jenis_kelamin

        // agama

        // suku

        // bahasa

        // alamat

        // rt

        // rw

        // keluarahan_desa

        // kecamatan

        // kabupaten_kota

        // kodepos

        // provinsi

        // negara

        // alamat_domisili

        // rt_domisili

        // rw_domisili

        // kel_desa_domisili

        // kec_domisili

        // kota_kab_domisili

        // kodepos_domisili

        // prov_domisili

        // negara_domisili

        // no_telp

        // no_hp

        // pendidikan

        // pekerjaan

        // status_kawin

        // tgl_daftar

        // username
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_pasien
            $this->id_pasien->ViewValue = $this->id_pasien->CurrentValue;
            $this->id_pasien->ViewCustomAttributes = "";

            // nama_pasien
            $this->nama_pasien->ViewValue = $this->nama_pasien->CurrentValue;
            $this->nama_pasien->ViewCustomAttributes = "";

            // no_rekam_medis
            $this->no_rekam_medis->ViewValue = $this->no_rekam_medis->CurrentValue;
            $this->no_rekam_medis->ViewCustomAttributes = "";

            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewValue = FormatNumber($this->nik->ViewValue, 0, -2, -2, -2);
            $this->nik->ViewCustomAttributes = "";

            // no_identitas_lain
            $this->no_identitas_lain->ViewValue = $this->no_identitas_lain->CurrentValue;
            $this->no_identitas_lain->ViewCustomAttributes = "";

            // nama_ibu
            $this->nama_ibu->ViewValue = $this->nama_ibu->CurrentValue;
            $this->nama_ibu->ViewCustomAttributes = "";

            // tempat_lahir
            $this->tempat_lahir->ViewValue = $this->tempat_lahir->CurrentValue;
            $this->tempat_lahir->ViewCustomAttributes = "";

            // tanggal_lahir
            $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
            $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
            $this->tanggal_lahir->ViewCustomAttributes = "";

            // jenis_kelamin
            $this->jenis_kelamin->ViewValue = $this->jenis_kelamin->CurrentValue;
            $this->jenis_kelamin->ViewValue = FormatNumber($this->jenis_kelamin->ViewValue, 0, -2, -2, -2);
            $this->jenis_kelamin->ViewCustomAttributes = "";

            // agama
            $this->agama->ViewValue = $this->agama->CurrentValue;
            $this->agama->ViewValue = FormatNumber($this->agama->ViewValue, 0, -2, -2, -2);
            $this->agama->ViewCustomAttributes = "";

            // suku
            $this->suku->ViewValue = $this->suku->CurrentValue;
            $this->suku->ViewCustomAttributes = "";

            // bahasa
            $this->bahasa->ViewValue = $this->bahasa->CurrentValue;
            $this->bahasa->ViewValue = FormatNumber($this->bahasa->ViewValue, 0, -2, -2, -2);
            $this->bahasa->ViewCustomAttributes = "";

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;
            $this->alamat->ViewCustomAttributes = "";

            // rt
            $this->rt->ViewValue = $this->rt->CurrentValue;
            $this->rt->ViewValue = FormatNumber($this->rt->ViewValue, 0, -2, -2, -2);
            $this->rt->ViewCustomAttributes = "";

            // rw
            $this->rw->ViewValue = $this->rw->CurrentValue;
            $this->rw->ViewValue = FormatNumber($this->rw->ViewValue, 0, -2, -2, -2);
            $this->rw->ViewCustomAttributes = "";

            // keluarahan_desa
            $this->keluarahan_desa->ViewValue = $this->keluarahan_desa->CurrentValue;
            $this->keluarahan_desa->ViewCustomAttributes = "";

            // kecamatan
            $this->kecamatan->ViewValue = $this->kecamatan->CurrentValue;
            $this->kecamatan->ViewCustomAttributes = "";

            // kabupaten_kota
            $this->kabupaten_kota->ViewValue = $this->kabupaten_kota->CurrentValue;
            $this->kabupaten_kota->ViewCustomAttributes = "";

            // kodepos
            $this->kodepos->ViewValue = $this->kodepos->CurrentValue;
            $this->kodepos->ViewValue = FormatNumber($this->kodepos->ViewValue, 0, -2, -2, -2);
            $this->kodepos->ViewCustomAttributes = "";

            // provinsi
            $this->provinsi->ViewValue = $this->provinsi->CurrentValue;
            $this->provinsi->ViewCustomAttributes = "";

            // negara
            $this->negara->ViewValue = $this->negara->CurrentValue;
            $this->negara->ViewCustomAttributes = "";

            // alamat_domisili
            $this->alamat_domisili->ViewValue = $this->alamat_domisili->CurrentValue;
            $this->alamat_domisili->ViewCustomAttributes = "";

            // rt_domisili
            $this->rt_domisili->ViewValue = $this->rt_domisili->CurrentValue;
            $this->rt_domisili->ViewCustomAttributes = "";

            // rw_domisili
            $this->rw_domisili->ViewValue = $this->rw_domisili->CurrentValue;
            $this->rw_domisili->ViewCustomAttributes = "";

            // kel_desa_domisili
            $this->kel_desa_domisili->ViewValue = $this->kel_desa_domisili->CurrentValue;
            $this->kel_desa_domisili->ViewCustomAttributes = "";

            // kec_domisili
            $this->kec_domisili->ViewValue = $this->kec_domisili->CurrentValue;
            $this->kec_domisili->ViewCustomAttributes = "";

            // kota_kab_domisili
            $this->kota_kab_domisili->ViewValue = $this->kota_kab_domisili->CurrentValue;
            $this->kota_kab_domisili->ViewCustomAttributes = "";

            // kodepos_domisili
            $this->kodepos_domisili->ViewValue = $this->kodepos_domisili->CurrentValue;
            $this->kodepos_domisili->ViewCustomAttributes = "";

            // prov_domisili
            $this->prov_domisili->ViewValue = $this->prov_domisili->CurrentValue;
            $this->prov_domisili->ViewCustomAttributes = "";

            // negara_domisili
            $this->negara_domisili->ViewValue = $this->negara_domisili->CurrentValue;
            $this->negara_domisili->ViewCustomAttributes = "";

            // no_telp
            $this->no_telp->ViewValue = $this->no_telp->CurrentValue;
            $this->no_telp->ViewValue = FormatNumber($this->no_telp->ViewValue, 0, -2, -2, -2);
            $this->no_telp->ViewCustomAttributes = "";

            // no_hp
            $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
            $this->no_hp->ViewValue = FormatNumber($this->no_hp->ViewValue, 0, -2, -2, -2);
            $this->no_hp->ViewCustomAttributes = "";

            // pendidikan
            $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
            $this->pendidikan->ViewValue = FormatNumber($this->pendidikan->ViewValue, 0, -2, -2, -2);
            $this->pendidikan->ViewCustomAttributes = "";

            // pekerjaan
            $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
            $this->pekerjaan->ViewValue = FormatNumber($this->pekerjaan->ViewValue, 0, -2, -2, -2);
            $this->pekerjaan->ViewCustomAttributes = "";

            // status_kawin
            $this->status_kawin->ViewValue = $this->status_kawin->CurrentValue;
            $this->status_kawin->ViewValue = FormatNumber($this->status_kawin->ViewValue, 0, -2, -2, -2);
            $this->status_kawin->ViewCustomAttributes = "";

            // tgl_daftar
            $this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
            $this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 0);
            $this->tgl_daftar->ViewCustomAttributes = "";

            // username
            $this->_username->ViewValue = $this->_username->CurrentValue;
            $this->_username->ViewCustomAttributes = "";

            // id_pasien
            $this->id_pasien->LinkCustomAttributes = "";
            $this->id_pasien->HrefValue = "";
            $this->id_pasien->TooltipValue = "";

            // nama_pasien
            $this->nama_pasien->LinkCustomAttributes = "";
            $this->nama_pasien->HrefValue = "";
            $this->nama_pasien->TooltipValue = "";

            // no_rekam_medis
            $this->no_rekam_medis->LinkCustomAttributes = "";
            $this->no_rekam_medis->HrefValue = "";
            $this->no_rekam_medis->TooltipValue = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // no_identitas_lain
            $this->no_identitas_lain->LinkCustomAttributes = "";
            $this->no_identitas_lain->HrefValue = "";
            $this->no_identitas_lain->TooltipValue = "";

            // nama_ibu
            $this->nama_ibu->LinkCustomAttributes = "";
            $this->nama_ibu->HrefValue = "";
            $this->nama_ibu->TooltipValue = "";

            // tempat_lahir
            $this->tempat_lahir->LinkCustomAttributes = "";
            $this->tempat_lahir->HrefValue = "";
            $this->tempat_lahir->TooltipValue = "";

            // tanggal_lahir
            $this->tanggal_lahir->LinkCustomAttributes = "";
            $this->tanggal_lahir->HrefValue = "";
            $this->tanggal_lahir->TooltipValue = "";

            // jenis_kelamin
            $this->jenis_kelamin->LinkCustomAttributes = "";
            $this->jenis_kelamin->HrefValue = "";
            $this->jenis_kelamin->TooltipValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";
            $this->agama->TooltipValue = "";

            // suku
            $this->suku->LinkCustomAttributes = "";
            $this->suku->HrefValue = "";
            $this->suku->TooltipValue = "";

            // bahasa
            $this->bahasa->LinkCustomAttributes = "";
            $this->bahasa->HrefValue = "";
            $this->bahasa->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // rt
            $this->rt->LinkCustomAttributes = "";
            $this->rt->HrefValue = "";
            $this->rt->TooltipValue = "";

            // rw
            $this->rw->LinkCustomAttributes = "";
            $this->rw->HrefValue = "";
            $this->rw->TooltipValue = "";

            // keluarahan_desa
            $this->keluarahan_desa->LinkCustomAttributes = "";
            $this->keluarahan_desa->HrefValue = "";
            $this->keluarahan_desa->TooltipValue = "";

            // kecamatan
            $this->kecamatan->LinkCustomAttributes = "";
            $this->kecamatan->HrefValue = "";
            $this->kecamatan->TooltipValue = "";

            // kabupaten_kota
            $this->kabupaten_kota->LinkCustomAttributes = "";
            $this->kabupaten_kota->HrefValue = "";
            $this->kabupaten_kota->TooltipValue = "";

            // kodepos
            $this->kodepos->LinkCustomAttributes = "";
            $this->kodepos->HrefValue = "";
            $this->kodepos->TooltipValue = "";

            // provinsi
            $this->provinsi->LinkCustomAttributes = "";
            $this->provinsi->HrefValue = "";
            $this->provinsi->TooltipValue = "";

            // negara
            $this->negara->LinkCustomAttributes = "";
            $this->negara->HrefValue = "";
            $this->negara->TooltipValue = "";

            // alamat_domisili
            $this->alamat_domisili->LinkCustomAttributes = "";
            $this->alamat_domisili->HrefValue = "";
            $this->alamat_domisili->TooltipValue = "";

            // rt_domisili
            $this->rt_domisili->LinkCustomAttributes = "";
            $this->rt_domisili->HrefValue = "";
            $this->rt_domisili->TooltipValue = "";

            // rw_domisili
            $this->rw_domisili->LinkCustomAttributes = "";
            $this->rw_domisili->HrefValue = "";
            $this->rw_domisili->TooltipValue = "";

            // kel_desa_domisili
            $this->kel_desa_domisili->LinkCustomAttributes = "";
            $this->kel_desa_domisili->HrefValue = "";
            $this->kel_desa_domisili->TooltipValue = "";

            // kec_domisili
            $this->kec_domisili->LinkCustomAttributes = "";
            $this->kec_domisili->HrefValue = "";
            $this->kec_domisili->TooltipValue = "";

            // kota_kab_domisili
            $this->kota_kab_domisili->LinkCustomAttributes = "";
            $this->kota_kab_domisili->HrefValue = "";
            $this->kota_kab_domisili->TooltipValue = "";

            // kodepos_domisili
            $this->kodepos_domisili->LinkCustomAttributes = "";
            $this->kodepos_domisili->HrefValue = "";
            $this->kodepos_domisili->TooltipValue = "";

            // prov_domisili
            $this->prov_domisili->LinkCustomAttributes = "";
            $this->prov_domisili->HrefValue = "";
            $this->prov_domisili->TooltipValue = "";

            // negara_domisili
            $this->negara_domisili->LinkCustomAttributes = "";
            $this->negara_domisili->HrefValue = "";
            $this->negara_domisili->TooltipValue = "";

            // no_telp
            $this->no_telp->LinkCustomAttributes = "";
            $this->no_telp->HrefValue = "";
            $this->no_telp->TooltipValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";
            $this->no_hp->TooltipValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";
            $this->pendidikan->TooltipValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";
            $this->pekerjaan->TooltipValue = "";

            // status_kawin
            $this->status_kawin->LinkCustomAttributes = "";
            $this->status_kawin->HrefValue = "";
            $this->status_kawin->TooltipValue = "";

            // tgl_daftar
            $this->tgl_daftar->LinkCustomAttributes = "";
            $this->tgl_daftar->HrefValue = "";
            $this->tgl_daftar->TooltipValue = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";
            $this->_username->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MasterPasienList"), "", $this->TableVar, true);
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
