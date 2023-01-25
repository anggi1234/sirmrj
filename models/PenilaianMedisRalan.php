<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for penilaian_medis_ralan
 */
class PenilaianMedisRalan extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id_penilaian_medis_ralan;
    public $no_rawat;
    public $tanggal;
    public $kd_dokter;
    public $anamnesis;
    public $hubungan;
    public $keluhan_utama;
    public $rps;
    public $rpd;
    public $rpk;
    public $rpo;
    public $alergi;
    public $keadaan;
    public $gcs;
    public $kesadaran;
    public $td;
    public $nadi;
    public $rr;
    public $suhu;
    public $spo;
    public $bb;
    public $tb;
    public $kepala;
    public $gigi;
    public $tht;
    public $thoraks;
    public $abdomen;
    public $genital;
    public $ekstremitas;
    public $kulit;
    public $ket_fisik;
    public $ket_lokalis;
    public $penunjang;
    public $diagnosis;
    public $tata;
    public $konsulrujuk;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'penilaian_medis_ralan';
        $this->TableName = 'penilaian_medis_ralan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`penilaian_medis_ralan`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id_penilaian_medis_ralan
        $this->id_penilaian_medis_ralan = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_id_penilaian_medis_ralan', 'id_penilaian_medis_ralan', '`id_penilaian_medis_ralan`', '`id_penilaian_medis_ralan`', 3, 11, -1, false, '`id_penilaian_medis_ralan`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_penilaian_medis_ralan->IsAutoIncrement = true; // Autoincrement field
        $this->id_penilaian_medis_ralan->IsPrimaryKey = true; // Primary key field
        $this->id_penilaian_medis_ralan->Sortable = true; // Allow sort
        $this->id_penilaian_medis_ralan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_penilaian_medis_ralan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_penilaian_medis_ralan->Param, "CustomMsg");
        $this->Fields['id_penilaian_medis_ralan'] = &$this->id_penilaian_medis_ralan;

        // no_rawat
        $this->no_rawat = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_no_rawat', 'no_rawat', '`no_rawat`', '`no_rawat`', 200, 17, -1, false, '`no_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->IsForeignKey = true; // Foreign key field
        $this->no_rawat->Nullable = false; // NOT NULL field
        $this->no_rawat->Required = true; // Required field
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // tanggal
        $this->tanggal = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 135, 19, 0, false, '`tanggal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal->Nullable = false; // NOT NULL field
        $this->tanggal->Sortable = true; // Allow sort
        $this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal->Param, "CustomMsg");
        $this->Fields['tanggal'] = &$this->tanggal;

        // kd_dokter
        $this->kd_dokter = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_kd_dokter', 'kd_dokter', '`kd_dokter`', '`kd_dokter`', 200, 20, -1, false, '`kd_dokter`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kd_dokter->Nullable = false; // NOT NULL field
        $this->kd_dokter->Required = true; // Required field
        $this->kd_dokter->Sortable = true; // Allow sort
        $this->kd_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_dokter->Param, "CustomMsg");
        $this->Fields['kd_dokter'] = &$this->kd_dokter;

        // anamnesis
        $this->anamnesis = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_anamnesis', 'anamnesis', '`anamnesis`', '`anamnesis`', 202, 13, -1, false, '`anamnesis`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->anamnesis->Nullable = false; // NOT NULL field
        $this->anamnesis->Required = true; // Required field
        $this->anamnesis->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->anamnesis->Lookup = new Lookup('anamnesis', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->anamnesis->Lookup = new Lookup('anamnesis', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->anamnesis->OptionCount = 2;
        $this->anamnesis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->anamnesis->Param, "CustomMsg");
        $this->Fields['anamnesis'] = &$this->anamnesis;

        // hubungan
        $this->hubungan = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_hubungan', 'hubungan', '`hubungan`', '`hubungan`', 200, 30, -1, false, '`hubungan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->hubungan->Nullable = false; // NOT NULL field
        $this->hubungan->Required = true; // Required field
        $this->hubungan->Sortable = true; // Allow sort
        $this->hubungan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hubungan->Param, "CustomMsg");
        $this->Fields['hubungan'] = &$this->hubungan;

        // keluhan_utama
        $this->keluhan_utama = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_keluhan_utama', 'keluhan_utama', '`keluhan_utama`', '`keluhan_utama`', 201, 65535, -1, false, '`keluhan_utama`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->keluhan_utama->Nullable = false; // NOT NULL field
        $this->keluhan_utama->Required = true; // Required field
        $this->keluhan_utama->Sortable = true; // Allow sort
        $this->keluhan_utama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keluhan_utama->Param, "CustomMsg");
        $this->Fields['keluhan_utama'] = &$this->keluhan_utama;

        // rps
        $this->rps = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_rps', 'rps', '`rps`', '`rps`', 201, 65535, -1, false, '`rps`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->rps->Nullable = false; // NOT NULL field
        $this->rps->Required = true; // Required field
        $this->rps->Sortable = true; // Allow sort
        $this->rps->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rps->Param, "CustomMsg");
        $this->Fields['rps'] = &$this->rps;

        // rpd
        $this->rpd = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_rpd', 'rpd', '`rpd`', '`rpd`', 201, 65535, -1, false, '`rpd`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->rpd->Nullable = false; // NOT NULL field
        $this->rpd->Required = true; // Required field
        $this->rpd->Sortable = true; // Allow sort
        $this->rpd->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpd->Param, "CustomMsg");
        $this->Fields['rpd'] = &$this->rpd;

        // rpk
        $this->rpk = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_rpk', 'rpk', '`rpk`', '`rpk`', 201, 65535, -1, false, '`rpk`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->rpk->Nullable = false; // NOT NULL field
        $this->rpk->Required = true; // Required field
        $this->rpk->Sortable = true; // Allow sort
        $this->rpk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpk->Param, "CustomMsg");
        $this->Fields['rpk'] = &$this->rpk;

        // rpo
        $this->rpo = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_rpo', 'rpo', '`rpo`', '`rpo`', 201, 65535, -1, false, '`rpo`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->rpo->Nullable = false; // NOT NULL field
        $this->rpo->Required = true; // Required field
        $this->rpo->Sortable = true; // Allow sort
        $this->rpo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo->Param, "CustomMsg");
        $this->Fields['rpo'] = &$this->rpo;

        // alergi
        $this->alergi = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_alergi', 'alergi', '`alergi`', '`alergi`', 200, 50, -1, false, '`alergi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alergi->Nullable = false; // NOT NULL field
        $this->alergi->Required = true; // Required field
        $this->alergi->Sortable = true; // Allow sort
        $this->alergi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alergi->Param, "CustomMsg");
        $this->Fields['alergi'] = &$this->alergi;

        // keadaan
        $this->keadaan = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_keadaan', 'keadaan', '`keadaan`', '`keadaan`', 202, 12, -1, false, '`keadaan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->keadaan->Nullable = false; // NOT NULL field
        $this->keadaan->Required = true; // Required field
        $this->keadaan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->keadaan->Lookup = new Lookup('keadaan', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->keadaan->Lookup = new Lookup('keadaan', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->keadaan->OptionCount = 4;
        $this->keadaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keadaan->Param, "CustomMsg");
        $this->Fields['keadaan'] = &$this->keadaan;

        // gcs
        $this->gcs = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_gcs', 'gcs', '`gcs`', '`gcs`', 200, 10, -1, false, '`gcs`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->gcs->Nullable = false; // NOT NULL field
        $this->gcs->Required = true; // Required field
        $this->gcs->Sortable = true; // Allow sort
        $this->gcs->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gcs->Param, "CustomMsg");
        $this->Fields['gcs'] = &$this->gcs;

        // kesadaran
        $this->kesadaran = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_kesadaran', 'kesadaran', '`kesadaran`', '`kesadaran`', 202, 13, -1, false, '`kesadaran`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kesadaran->Nullable = false; // NOT NULL field
        $this->kesadaran->Required = true; // Required field
        $this->kesadaran->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kesadaran->Lookup = new Lookup('kesadaran', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kesadaran->Lookup = new Lookup('kesadaran', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kesadaran->OptionCount = 5;
        $this->kesadaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kesadaran->Param, "CustomMsg");
        $this->Fields['kesadaran'] = &$this->kesadaran;

        // td
        $this->td = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_td', 'td', '`td`', '`td`', 200, 8, -1, false, '`td`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->td->Nullable = false; // NOT NULL field
        $this->td->Required = true; // Required field
        $this->td->Sortable = true; // Allow sort
        $this->td->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->td->Param, "CustomMsg");
        $this->Fields['td'] = &$this->td;

        // nadi
        $this->nadi = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_nadi', 'nadi', '`nadi`', '`nadi`', 200, 5, -1, false, '`nadi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nadi->Nullable = false; // NOT NULL field
        $this->nadi->Required = true; // Required field
        $this->nadi->Sortable = true; // Allow sort
        $this->nadi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nadi->Param, "CustomMsg");
        $this->Fields['nadi'] = &$this->nadi;

        // rr
        $this->rr = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_rr', 'rr', '`rr`', '`rr`', 200, 5, -1, false, '`rr`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rr->Nullable = false; // NOT NULL field
        $this->rr->Required = true; // Required field
        $this->rr->Sortable = true; // Allow sort
        $this->rr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rr->Param, "CustomMsg");
        $this->Fields['rr'] = &$this->rr;

        // suhu
        $this->suhu = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_suhu', 'suhu', '`suhu`', '`suhu`', 200, 5, -1, false, '`suhu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->suhu->Nullable = false; // NOT NULL field
        $this->suhu->Required = true; // Required field
        $this->suhu->Sortable = true; // Allow sort
        $this->suhu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->suhu->Param, "CustomMsg");
        $this->Fields['suhu'] = &$this->suhu;

        // spo
        $this->spo = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_spo', 'spo', '`spo`', '`spo`', 200, 5, -1, false, '`spo`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spo->Nullable = false; // NOT NULL field
        $this->spo->Required = true; // Required field
        $this->spo->Sortable = true; // Allow sort
        $this->spo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spo->Param, "CustomMsg");
        $this->Fields['spo'] = &$this->spo;

        // bb
        $this->bb = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_bb', 'bb', '`bb`', '`bb`', 200, 5, -1, false, '`bb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bb->Nullable = false; // NOT NULL field
        $this->bb->Required = true; // Required field
        $this->bb->Sortable = true; // Allow sort
        $this->bb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bb->Param, "CustomMsg");
        $this->Fields['bb'] = &$this->bb;

        // tb
        $this->tb = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_tb', 'tb', '`tb`', '`tb`', 200, 5, -1, false, '`tb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tb->Nullable = false; // NOT NULL field
        $this->tb->Required = true; // Required field
        $this->tb->Sortable = true; // Allow sort
        $this->tb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tb->Param, "CustomMsg");
        $this->Fields['tb'] = &$this->tb;

        // kepala
        $this->kepala = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_kepala', 'kepala', '`kepala`', '`kepala`', 202, 15, -1, false, '`kepala`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kepala->Nullable = false; // NOT NULL field
        $this->kepala->Required = true; // Required field
        $this->kepala->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kepala->Lookup = new Lookup('kepala', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kepala->Lookup = new Lookup('kepala', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kepala->OptionCount = 3;
        $this->kepala->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kepala->Param, "CustomMsg");
        $this->Fields['kepala'] = &$this->kepala;

        // gigi
        $this->gigi = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_gigi', 'gigi', '`gigi`', '`gigi`', 202, 15, -1, false, '`gigi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->gigi->Nullable = false; // NOT NULL field
        $this->gigi->Required = true; // Required field
        $this->gigi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->gigi->Lookup = new Lookup('gigi', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->gigi->Lookup = new Lookup('gigi', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->gigi->OptionCount = 3;
        $this->gigi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gigi->Param, "CustomMsg");
        $this->Fields['gigi'] = &$this->gigi;

        // tht
        $this->tht = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_tht', 'tht', '`tht`', '`tht`', 202, 15, -1, false, '`tht`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->tht->Nullable = false; // NOT NULL field
        $this->tht->Required = true; // Required field
        $this->tht->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->tht->Lookup = new Lookup('tht', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->tht->Lookup = new Lookup('tht', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->tht->OptionCount = 3;
        $this->tht->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tht->Param, "CustomMsg");
        $this->Fields['tht'] = &$this->tht;

        // thoraks
        $this->thoraks = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_thoraks', 'thoraks', '`thoraks`', '`thoraks`', 202, 15, -1, false, '`thoraks`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->thoraks->Nullable = false; // NOT NULL field
        $this->thoraks->Required = true; // Required field
        $this->thoraks->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->thoraks->Lookup = new Lookup('thoraks', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->thoraks->Lookup = new Lookup('thoraks', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->thoraks->OptionCount = 3;
        $this->thoraks->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->thoraks->Param, "CustomMsg");
        $this->Fields['thoraks'] = &$this->thoraks;

        // abdomen
        $this->abdomen = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_abdomen', 'abdomen', '`abdomen`', '`abdomen`', 202, 15, -1, false, '`abdomen`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->abdomen->Nullable = false; // NOT NULL field
        $this->abdomen->Required = true; // Required field
        $this->abdomen->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->abdomen->Lookup = new Lookup('abdomen', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->abdomen->Lookup = new Lookup('abdomen', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->abdomen->OptionCount = 3;
        $this->abdomen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->abdomen->Param, "CustomMsg");
        $this->Fields['abdomen'] = &$this->abdomen;

        // genital
        $this->genital = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_genital', 'genital', '`genital`', '`genital`', 202, 15, -1, false, '`genital`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->genital->Nullable = false; // NOT NULL field
        $this->genital->Required = true; // Required field
        $this->genital->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->genital->Lookup = new Lookup('genital', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->genital->Lookup = new Lookup('genital', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->genital->OptionCount = 3;
        $this->genital->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->genital->Param, "CustomMsg");
        $this->Fields['genital'] = &$this->genital;

        // ekstremitas
        $this->ekstremitas = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_ekstremitas', 'ekstremitas', '`ekstremitas`', '`ekstremitas`', 202, 15, -1, false, '`ekstremitas`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->ekstremitas->Nullable = false; // NOT NULL field
        $this->ekstremitas->Required = true; // Required field
        $this->ekstremitas->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->ekstremitas->Lookup = new Lookup('ekstremitas', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ekstremitas->Lookup = new Lookup('ekstremitas', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ekstremitas->OptionCount = 3;
        $this->ekstremitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ekstremitas->Param, "CustomMsg");
        $this->Fields['ekstremitas'] = &$this->ekstremitas;

        // kulit
        $this->kulit = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_kulit', 'kulit', '`kulit`', '`kulit`', 202, 15, -1, false, '`kulit`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kulit->Nullable = false; // NOT NULL field
        $this->kulit->Required = true; // Required field
        $this->kulit->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kulit->Lookup = new Lookup('kulit', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kulit->Lookup = new Lookup('kulit', 'penilaian_medis_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kulit->OptionCount = 3;
        $this->kulit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kulit->Param, "CustomMsg");
        $this->Fields['kulit'] = &$this->kulit;

        // ket_fisik
        $this->ket_fisik = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_ket_fisik', 'ket_fisik', '`ket_fisik`', '`ket_fisik`', 201, 65535, -1, false, '`ket_fisik`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ket_fisik->Nullable = false; // NOT NULL field
        $this->ket_fisik->Required = true; // Required field
        $this->ket_fisik->Sortable = true; // Allow sort
        $this->ket_fisik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_fisik->Param, "CustomMsg");
        $this->Fields['ket_fisik'] = &$this->ket_fisik;

        // ket_lokalis
        $this->ket_lokalis = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_ket_lokalis', 'ket_lokalis', '`ket_lokalis`', '`ket_lokalis`', 201, 65535, -1, false, '`ket_lokalis`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ket_lokalis->Nullable = false; // NOT NULL field
        $this->ket_lokalis->Required = true; // Required field
        $this->ket_lokalis->Sortable = true; // Allow sort
        $this->ket_lokalis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_lokalis->Param, "CustomMsg");
        $this->Fields['ket_lokalis'] = &$this->ket_lokalis;

        // penunjang
        $this->penunjang = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_penunjang', 'penunjang', '`penunjang`', '`penunjang`', 201, 65535, -1, false, '`penunjang`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->penunjang->Nullable = false; // NOT NULL field
        $this->penunjang->Required = true; // Required field
        $this->penunjang->Sortable = true; // Allow sort
        $this->penunjang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->penunjang->Param, "CustomMsg");
        $this->Fields['penunjang'] = &$this->penunjang;

        // diagnosis
        $this->diagnosis = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_diagnosis', 'diagnosis', '`diagnosis`', '`diagnosis`', 201, 500, -1, false, '`diagnosis`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->diagnosis->Nullable = false; // NOT NULL field
        $this->diagnosis->Required = true; // Required field
        $this->diagnosis->Sortable = true; // Allow sort
        $this->diagnosis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->diagnosis->Param, "CustomMsg");
        $this->Fields['diagnosis'] = &$this->diagnosis;

        // tata
        $this->tata = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_tata', 'tata', '`tata`', '`tata`', 201, 65535, -1, false, '`tata`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->tata->Nullable = false; // NOT NULL field
        $this->tata->Required = true; // Required field
        $this->tata->Sortable = true; // Allow sort
        $this->tata->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tata->Param, "CustomMsg");
        $this->Fields['tata'] = &$this->tata;

        // konsulrujuk
        $this->konsulrujuk = new DbField('penilaian_medis_ralan', 'penilaian_medis_ralan', 'x_konsulrujuk', 'konsulrujuk', '`konsulrujuk`', '`konsulrujuk`', 201, 1000, -1, false, '`konsulrujuk`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->konsulrujuk->Nullable = false; // NOT NULL field
        $this->konsulrujuk->Required = true; // Required field
        $this->konsulrujuk->Sortable = true; // Allow sort
        $this->konsulrujuk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->konsulrujuk->Param, "CustomMsg");
        $this->Fields['konsulrujuk'] = &$this->konsulrujuk;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Session master WHERE clause
    public function getMasterFilter()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "vigd") {
            if ($this->no_rawat->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`id_reg`", $this->no_rawat->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "vrajal") {
            if ($this->no_rawat->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`id_reg`", $this->no_rawat->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Session detail WHERE clause
    public function getDetailFilter()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "vigd") {
            if ($this->no_rawat->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`no_rawat`", $this->no_rawat->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "vrajal") {
            if ($this->no_rawat->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`no_rawat`", $this->no_rawat->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    // Master filter
    public function sqlMasterFilter_vigd()
    {
        return "`id_reg`=@id_reg@";
    }
    // Detail filter
    public function sqlDetailFilter_vigd()
    {
        return "`no_rawat`='@no_rawat@'";
    }

    // Master filter
    public function sqlMasterFilter_vrajal()
    {
        return "`id_reg`=@id_reg@";
    }
    // Detail filter
    public function sqlDetailFilter_vrajal()
    {
        return "`no_rawat`='@no_rawat@'";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`penilaian_medis_ralan`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id_penilaian_medis_ralan->setDbValue($conn->lastInsertId());
            $rs['id_penilaian_medis_ralan'] = $this->id_penilaian_medis_ralan->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id_penilaian_medis_ralan', $rs)) {
                AddFilter($where, QuotedName('id_penilaian_medis_ralan', $this->Dbid) . '=' . QuotedValue($rs['id_penilaian_medis_ralan'], $this->id_penilaian_medis_ralan->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id_penilaian_medis_ralan->DbValue = $row['id_penilaian_medis_ralan'];
        $this->no_rawat->DbValue = $row['no_rawat'];
        $this->tanggal->DbValue = $row['tanggal'];
        $this->kd_dokter->DbValue = $row['kd_dokter'];
        $this->anamnesis->DbValue = $row['anamnesis'];
        $this->hubungan->DbValue = $row['hubungan'];
        $this->keluhan_utama->DbValue = $row['keluhan_utama'];
        $this->rps->DbValue = $row['rps'];
        $this->rpd->DbValue = $row['rpd'];
        $this->rpk->DbValue = $row['rpk'];
        $this->rpo->DbValue = $row['rpo'];
        $this->alergi->DbValue = $row['alergi'];
        $this->keadaan->DbValue = $row['keadaan'];
        $this->gcs->DbValue = $row['gcs'];
        $this->kesadaran->DbValue = $row['kesadaran'];
        $this->td->DbValue = $row['td'];
        $this->nadi->DbValue = $row['nadi'];
        $this->rr->DbValue = $row['rr'];
        $this->suhu->DbValue = $row['suhu'];
        $this->spo->DbValue = $row['spo'];
        $this->bb->DbValue = $row['bb'];
        $this->tb->DbValue = $row['tb'];
        $this->kepala->DbValue = $row['kepala'];
        $this->gigi->DbValue = $row['gigi'];
        $this->tht->DbValue = $row['tht'];
        $this->thoraks->DbValue = $row['thoraks'];
        $this->abdomen->DbValue = $row['abdomen'];
        $this->genital->DbValue = $row['genital'];
        $this->ekstremitas->DbValue = $row['ekstremitas'];
        $this->kulit->DbValue = $row['kulit'];
        $this->ket_fisik->DbValue = $row['ket_fisik'];
        $this->ket_lokalis->DbValue = $row['ket_lokalis'];
        $this->penunjang->DbValue = $row['penunjang'];
        $this->diagnosis->DbValue = $row['diagnosis'];
        $this->tata->DbValue = $row['tata'];
        $this->konsulrujuk->DbValue = $row['konsulrujuk'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_penilaian_medis_ralan` = @id_penilaian_medis_ralan@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_penilaian_medis_ralan->CurrentValue : $this->id_penilaian_medis_ralan->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id_penilaian_medis_ralan->CurrentValue = $keys[0];
            } else {
                $this->id_penilaian_medis_ralan->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_penilaian_medis_ralan', $row) ? $row['id_penilaian_medis_ralan'] : null;
        } else {
            $val = $this->id_penilaian_medis_ralan->OldValue !== null ? $this->id_penilaian_medis_ralan->OldValue : $this->id_penilaian_medis_ralan->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_penilaian_medis_ralan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("PenilaianMedisRalanList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "PenilaianMedisRalanView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PenilaianMedisRalanEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PenilaianMedisRalanAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "PenilaianMedisRalanView";
            case Config("API_ADD_ACTION"):
                return "PenilaianMedisRalanAdd";
            case Config("API_EDIT_ACTION"):
                return "PenilaianMedisRalanEdit";
            case Config("API_DELETE_ACTION"):
                return "PenilaianMedisRalanDelete";
            case Config("API_LIST_ACTION"):
                return "PenilaianMedisRalanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PenilaianMedisRalanList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PenilaianMedisRalanView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PenilaianMedisRalanView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PenilaianMedisRalanAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PenilaianMedisRalanAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PenilaianMedisRalanEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("PenilaianMedisRalanAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("PenilaianMedisRalanDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "vigd" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id_reg", $this->no_rawat->CurrentValue ?? $this->no_rawat->getSessionValue());
        }
        if ($this->getCurrentMasterTable() == "vrajal" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id_reg", $this->no_rawat->CurrentValue ?? $this->no_rawat->getSessionValue());
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_penilaian_medis_ralan:" . JsonEncode($this->id_penilaian_medis_ralan->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_penilaian_medis_ralan->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_penilaian_medis_ralan->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id_penilaian_medis_ralan") ?? Route("id_penilaian_medis_ralan")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id_penilaian_medis_ralan->CurrentValue = $key;
            } else {
                $this->id_penilaian_medis_ralan->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id_penilaian_medis_ralan->setDbValue($row['id_penilaian_medis_ralan']);
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
        $this->gigi->setDbValue($row['gigi']);
        $this->tht->setDbValue($row['tht']);
        $this->thoraks->setDbValue($row['thoraks']);
        $this->abdomen->setDbValue($row['abdomen']);
        $this->genital->setDbValue($row['genital']);
        $this->ekstremitas->setDbValue($row['ekstremitas']);
        $this->kulit->setDbValue($row['kulit']);
        $this->ket_fisik->setDbValue($row['ket_fisik']);
        $this->ket_lokalis->setDbValue($row['ket_lokalis']);
        $this->penunjang->setDbValue($row['penunjang']);
        $this->diagnosis->setDbValue($row['diagnosis']);
        $this->tata->setDbValue($row['tata']);
        $this->konsulrujuk->setDbValue($row['konsulrujuk']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_penilaian_medis_ralan

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

        // gigi

        // tht

        // thoraks

        // abdomen

        // genital

        // ekstremitas

        // kulit

        // ket_fisik

        // ket_lokalis

        // penunjang

        // diagnosis

        // tata

        // konsulrujuk

        // id_penilaian_medis_ralan
        $this->id_penilaian_medis_ralan->ViewValue = $this->id_penilaian_medis_ralan->CurrentValue;
        $this->id_penilaian_medis_ralan->ViewCustomAttributes = "";

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

        // gigi
        if (strval($this->gigi->CurrentValue) != "") {
            $this->gigi->ViewValue = $this->gigi->optionCaption($this->gigi->CurrentValue);
        } else {
            $this->gigi->ViewValue = null;
        }
        $this->gigi->ViewCustomAttributes = "";

        // tht
        if (strval($this->tht->CurrentValue) != "") {
            $this->tht->ViewValue = $this->tht->optionCaption($this->tht->CurrentValue);
        } else {
            $this->tht->ViewValue = null;
        }
        $this->tht->ViewCustomAttributes = "";

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

        // kulit
        if (strval($this->kulit->CurrentValue) != "") {
            $this->kulit->ViewValue = $this->kulit->optionCaption($this->kulit->CurrentValue);
        } else {
            $this->kulit->ViewValue = null;
        }
        $this->kulit->ViewCustomAttributes = "";

        // ket_fisik
        $this->ket_fisik->ViewValue = $this->ket_fisik->CurrentValue;
        $this->ket_fisik->ViewCustomAttributes = "";

        // ket_lokalis
        $this->ket_lokalis->ViewValue = $this->ket_lokalis->CurrentValue;
        $this->ket_lokalis->ViewCustomAttributes = "";

        // penunjang
        $this->penunjang->ViewValue = $this->penunjang->CurrentValue;
        $this->penunjang->ViewCustomAttributes = "";

        // diagnosis
        $this->diagnosis->ViewValue = $this->diagnosis->CurrentValue;
        $this->diagnosis->ViewCustomAttributes = "";

        // tata
        $this->tata->ViewValue = $this->tata->CurrentValue;
        $this->tata->ViewCustomAttributes = "";

        // konsulrujuk
        $this->konsulrujuk->ViewValue = $this->konsulrujuk->CurrentValue;
        $this->konsulrujuk->ViewCustomAttributes = "";

        // id_penilaian_medis_ralan
        $this->id_penilaian_medis_ralan->LinkCustomAttributes = "";
        $this->id_penilaian_medis_ralan->HrefValue = "";
        $this->id_penilaian_medis_ralan->TooltipValue = "";

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

        // gigi
        $this->gigi->LinkCustomAttributes = "";
        $this->gigi->HrefValue = "";
        $this->gigi->TooltipValue = "";

        // tht
        $this->tht->LinkCustomAttributes = "";
        $this->tht->HrefValue = "";
        $this->tht->TooltipValue = "";

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

        // kulit
        $this->kulit->LinkCustomAttributes = "";
        $this->kulit->HrefValue = "";
        $this->kulit->TooltipValue = "";

        // ket_fisik
        $this->ket_fisik->LinkCustomAttributes = "";
        $this->ket_fisik->HrefValue = "";
        $this->ket_fisik->TooltipValue = "";

        // ket_lokalis
        $this->ket_lokalis->LinkCustomAttributes = "";
        $this->ket_lokalis->HrefValue = "";
        $this->ket_lokalis->TooltipValue = "";

        // penunjang
        $this->penunjang->LinkCustomAttributes = "";
        $this->penunjang->HrefValue = "";
        $this->penunjang->TooltipValue = "";

        // diagnosis
        $this->diagnosis->LinkCustomAttributes = "";
        $this->diagnosis->HrefValue = "";
        $this->diagnosis->TooltipValue = "";

        // tata
        $this->tata->LinkCustomAttributes = "";
        $this->tata->HrefValue = "";
        $this->tata->TooltipValue = "";

        // konsulrujuk
        $this->konsulrujuk->LinkCustomAttributes = "";
        $this->konsulrujuk->HrefValue = "";
        $this->konsulrujuk->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id_penilaian_medis_ralan
        $this->id_penilaian_medis_ralan->EditAttrs["class"] = "form-control";
        $this->id_penilaian_medis_ralan->EditCustomAttributes = "";
        $this->id_penilaian_medis_ralan->EditValue = $this->id_penilaian_medis_ralan->CurrentValue;
        $this->id_penilaian_medis_ralan->ViewCustomAttributes = "";

        // no_rawat
        $this->no_rawat->EditAttrs["class"] = "form-control";
        $this->no_rawat->EditCustomAttributes = "";
        $this->no_rawat->EditValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->ViewCustomAttributes = "";

        // tanggal

        // kd_dokter
        $this->kd_dokter->EditAttrs["class"] = "form-control";
        $this->kd_dokter->EditCustomAttributes = "";
        $this->kd_dokter->EditValue = $this->kd_dokter->CurrentValue;
        $this->kd_dokter->ViewCustomAttributes = "";

        // anamnesis
        $this->anamnesis->EditCustomAttributes = "";
        $this->anamnesis->EditValue = $this->anamnesis->options(false);
        $this->anamnesis->PlaceHolder = RemoveHtml($this->anamnesis->caption());

        // hubungan
        $this->hubungan->EditAttrs["class"] = "form-control";
        $this->hubungan->EditCustomAttributes = "";
        if (!$this->hubungan->Raw) {
            $this->hubungan->CurrentValue = HtmlDecode($this->hubungan->CurrentValue);
        }
        $this->hubungan->EditValue = $this->hubungan->CurrentValue;
        $this->hubungan->PlaceHolder = RemoveHtml($this->hubungan->caption());

        // keluhan_utama
        $this->keluhan_utama->EditAttrs["class"] = "form-control";
        $this->keluhan_utama->EditCustomAttributes = "";
        $this->keluhan_utama->EditValue = $this->keluhan_utama->CurrentValue;
        $this->keluhan_utama->PlaceHolder = RemoveHtml($this->keluhan_utama->caption());

        // rps
        $this->rps->EditAttrs["class"] = "form-control";
        $this->rps->EditCustomAttributes = "";
        $this->rps->EditValue = $this->rps->CurrentValue;
        $this->rps->PlaceHolder = RemoveHtml($this->rps->caption());

        // rpd
        $this->rpd->EditAttrs["class"] = "form-control";
        $this->rpd->EditCustomAttributes = "";
        $this->rpd->EditValue = $this->rpd->CurrentValue;
        $this->rpd->PlaceHolder = RemoveHtml($this->rpd->caption());

        // rpk
        $this->rpk->EditAttrs["class"] = "form-control";
        $this->rpk->EditCustomAttributes = "";
        $this->rpk->EditValue = $this->rpk->CurrentValue;
        $this->rpk->PlaceHolder = RemoveHtml($this->rpk->caption());

        // rpo
        $this->rpo->EditAttrs["class"] = "form-control";
        $this->rpo->EditCustomAttributes = "";
        $this->rpo->EditValue = $this->rpo->CurrentValue;
        $this->rpo->PlaceHolder = RemoveHtml($this->rpo->caption());

        // alergi
        $this->alergi->EditAttrs["class"] = "form-control";
        $this->alergi->EditCustomAttributes = "";
        if (!$this->alergi->Raw) {
            $this->alergi->CurrentValue = HtmlDecode($this->alergi->CurrentValue);
        }
        $this->alergi->EditValue = $this->alergi->CurrentValue;
        $this->alergi->PlaceHolder = RemoveHtml($this->alergi->caption());

        // keadaan
        $this->keadaan->EditCustomAttributes = "";
        $this->keadaan->EditValue = $this->keadaan->options(false);
        $this->keadaan->PlaceHolder = RemoveHtml($this->keadaan->caption());

        // gcs
        $this->gcs->EditAttrs["class"] = "form-control";
        $this->gcs->EditCustomAttributes = "";
        if (!$this->gcs->Raw) {
            $this->gcs->CurrentValue = HtmlDecode($this->gcs->CurrentValue);
        }
        $this->gcs->EditValue = $this->gcs->CurrentValue;
        $this->gcs->PlaceHolder = RemoveHtml($this->gcs->caption());

        // kesadaran
        $this->kesadaran->EditCustomAttributes = "";
        $this->kesadaran->EditValue = $this->kesadaran->options(false);
        $this->kesadaran->PlaceHolder = RemoveHtml($this->kesadaran->caption());

        // td
        $this->td->EditAttrs["class"] = "form-control";
        $this->td->EditCustomAttributes = "";
        if (!$this->td->Raw) {
            $this->td->CurrentValue = HtmlDecode($this->td->CurrentValue);
        }
        $this->td->EditValue = $this->td->CurrentValue;
        $this->td->PlaceHolder = RemoveHtml($this->td->caption());

        // nadi
        $this->nadi->EditAttrs["class"] = "form-control";
        $this->nadi->EditCustomAttributes = "";
        if (!$this->nadi->Raw) {
            $this->nadi->CurrentValue = HtmlDecode($this->nadi->CurrentValue);
        }
        $this->nadi->EditValue = $this->nadi->CurrentValue;
        $this->nadi->PlaceHolder = RemoveHtml($this->nadi->caption());

        // rr
        $this->rr->EditAttrs["class"] = "form-control";
        $this->rr->EditCustomAttributes = "";
        if (!$this->rr->Raw) {
            $this->rr->CurrentValue = HtmlDecode($this->rr->CurrentValue);
        }
        $this->rr->EditValue = $this->rr->CurrentValue;
        $this->rr->PlaceHolder = RemoveHtml($this->rr->caption());

        // suhu
        $this->suhu->EditAttrs["class"] = "form-control";
        $this->suhu->EditCustomAttributes = "";
        if (!$this->suhu->Raw) {
            $this->suhu->CurrentValue = HtmlDecode($this->suhu->CurrentValue);
        }
        $this->suhu->EditValue = $this->suhu->CurrentValue;
        $this->suhu->PlaceHolder = RemoveHtml($this->suhu->caption());

        // spo
        $this->spo->EditAttrs["class"] = "form-control";
        $this->spo->EditCustomAttributes = "";
        if (!$this->spo->Raw) {
            $this->spo->CurrentValue = HtmlDecode($this->spo->CurrentValue);
        }
        $this->spo->EditValue = $this->spo->CurrentValue;
        $this->spo->PlaceHolder = RemoveHtml($this->spo->caption());

        // bb
        $this->bb->EditAttrs["class"] = "form-control";
        $this->bb->EditCustomAttributes = "";
        if (!$this->bb->Raw) {
            $this->bb->CurrentValue = HtmlDecode($this->bb->CurrentValue);
        }
        $this->bb->EditValue = $this->bb->CurrentValue;
        $this->bb->PlaceHolder = RemoveHtml($this->bb->caption());

        // tb
        $this->tb->EditAttrs["class"] = "form-control";
        $this->tb->EditCustomAttributes = "";
        if (!$this->tb->Raw) {
            $this->tb->CurrentValue = HtmlDecode($this->tb->CurrentValue);
        }
        $this->tb->EditValue = $this->tb->CurrentValue;
        $this->tb->PlaceHolder = RemoveHtml($this->tb->caption());

        // kepala
        $this->kepala->EditCustomAttributes = "";
        $this->kepala->EditValue = $this->kepala->options(false);
        $this->kepala->PlaceHolder = RemoveHtml($this->kepala->caption());

        // gigi
        $this->gigi->EditCustomAttributes = "";
        $this->gigi->EditValue = $this->gigi->options(false);
        $this->gigi->PlaceHolder = RemoveHtml($this->gigi->caption());

        // tht
        $this->tht->EditCustomAttributes = "";
        $this->tht->EditValue = $this->tht->options(false);
        $this->tht->PlaceHolder = RemoveHtml($this->tht->caption());

        // thoraks
        $this->thoraks->EditCustomAttributes = "";
        $this->thoraks->EditValue = $this->thoraks->options(false);
        $this->thoraks->PlaceHolder = RemoveHtml($this->thoraks->caption());

        // abdomen
        $this->abdomen->EditCustomAttributes = "";
        $this->abdomen->EditValue = $this->abdomen->options(false);
        $this->abdomen->PlaceHolder = RemoveHtml($this->abdomen->caption());

        // genital
        $this->genital->EditCustomAttributes = "";
        $this->genital->EditValue = $this->genital->options(false);
        $this->genital->PlaceHolder = RemoveHtml($this->genital->caption());

        // ekstremitas
        $this->ekstremitas->EditCustomAttributes = "";
        $this->ekstremitas->EditValue = $this->ekstremitas->options(false);
        $this->ekstremitas->PlaceHolder = RemoveHtml($this->ekstremitas->caption());

        // kulit
        $this->kulit->EditCustomAttributes = "";
        $this->kulit->EditValue = $this->kulit->options(false);
        $this->kulit->PlaceHolder = RemoveHtml($this->kulit->caption());

        // ket_fisik
        $this->ket_fisik->EditAttrs["class"] = "form-control";
        $this->ket_fisik->EditCustomAttributes = "";
        $this->ket_fisik->EditValue = $this->ket_fisik->CurrentValue;
        $this->ket_fisik->PlaceHolder = RemoveHtml($this->ket_fisik->caption());

        // ket_lokalis
        $this->ket_lokalis->EditAttrs["class"] = "form-control";
        $this->ket_lokalis->EditCustomAttributes = "";
        $this->ket_lokalis->EditValue = $this->ket_lokalis->CurrentValue;
        $this->ket_lokalis->PlaceHolder = RemoveHtml($this->ket_lokalis->caption());

        // penunjang
        $this->penunjang->EditAttrs["class"] = "form-control";
        $this->penunjang->EditCustomAttributes = "";
        $this->penunjang->EditValue = $this->penunjang->CurrentValue;
        $this->penunjang->PlaceHolder = RemoveHtml($this->penunjang->caption());

        // diagnosis
        $this->diagnosis->EditAttrs["class"] = "form-control";
        $this->diagnosis->EditCustomAttributes = "";
        $this->diagnosis->EditValue = $this->diagnosis->CurrentValue;
        $this->diagnosis->PlaceHolder = RemoveHtml($this->diagnosis->caption());

        // tata
        $this->tata->EditAttrs["class"] = "form-control";
        $this->tata->EditCustomAttributes = "";
        $this->tata->EditValue = $this->tata->CurrentValue;
        $this->tata->PlaceHolder = RemoveHtml($this->tata->caption());

        // konsulrujuk
        $this->konsulrujuk->EditAttrs["class"] = "form-control";
        $this->konsulrujuk->EditCustomAttributes = "";
        $this->konsulrujuk->EditValue = $this->konsulrujuk->CurrentValue;
        $this->konsulrujuk->PlaceHolder = RemoveHtml($this->konsulrujuk->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->anamnesis);
                    $doc->exportCaption($this->keluhan_utama);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->keadaan);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->kesadaran);
                    $doc->exportCaption($this->td);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->rr);
                    $doc->exportCaption($this->suhu);
                    $doc->exportCaption($this->bb);
                    $doc->exportCaption($this->tb);
                    $doc->exportCaption($this->ket_fisik);
                    $doc->exportCaption($this->penunjang);
                    $doc->exportCaption($this->diagnosis);
                } else {
                    $doc->exportCaption($this->id_penilaian_medis_ralan);
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->anamnesis);
                    $doc->exportCaption($this->hubungan);
                    $doc->exportCaption($this->keluhan_utama);
                    $doc->exportCaption($this->rps);
                    $doc->exportCaption($this->rpd);
                    $doc->exportCaption($this->rpk);
                    $doc->exportCaption($this->rpo);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->keadaan);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->kesadaran);
                    $doc->exportCaption($this->td);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->rr);
                    $doc->exportCaption($this->suhu);
                    $doc->exportCaption($this->spo);
                    $doc->exportCaption($this->bb);
                    $doc->exportCaption($this->tb);
                    $doc->exportCaption($this->kepala);
                    $doc->exportCaption($this->gigi);
                    $doc->exportCaption($this->tht);
                    $doc->exportCaption($this->thoraks);
                    $doc->exportCaption($this->abdomen);
                    $doc->exportCaption($this->genital);
                    $doc->exportCaption($this->ekstremitas);
                    $doc->exportCaption($this->kulit);
                    $doc->exportCaption($this->ket_fisik);
                    $doc->exportCaption($this->ket_lokalis);
                    $doc->exportCaption($this->penunjang);
                    $doc->exportCaption($this->diagnosis);
                    $doc->exportCaption($this->tata);
                    $doc->exportCaption($this->konsulrujuk);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->anamnesis);
                        $doc->exportField($this->keluhan_utama);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->keadaan);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->kesadaran);
                        $doc->exportField($this->td);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->rr);
                        $doc->exportField($this->suhu);
                        $doc->exportField($this->bb);
                        $doc->exportField($this->tb);
                        $doc->exportField($this->ket_fisik);
                        $doc->exportField($this->penunjang);
                        $doc->exportField($this->diagnosis);
                    } else {
                        $doc->exportField($this->id_penilaian_medis_ralan);
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->anamnesis);
                        $doc->exportField($this->hubungan);
                        $doc->exportField($this->keluhan_utama);
                        $doc->exportField($this->rps);
                        $doc->exportField($this->rpd);
                        $doc->exportField($this->rpk);
                        $doc->exportField($this->rpo);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->keadaan);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->kesadaran);
                        $doc->exportField($this->td);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->rr);
                        $doc->exportField($this->suhu);
                        $doc->exportField($this->spo);
                        $doc->exportField($this->bb);
                        $doc->exportField($this->tb);
                        $doc->exportField($this->kepala);
                        $doc->exportField($this->gigi);
                        $doc->exportField($this->tht);
                        $doc->exportField($this->thoraks);
                        $doc->exportField($this->abdomen);
                        $doc->exportField($this->genital);
                        $doc->exportField($this->ekstremitas);
                        $doc->exportField($this->kulit);
                        $doc->exportField($this->ket_fisik);
                        $doc->exportField($this->ket_lokalis);
                        $doc->exportField($this->penunjang);
                        $doc->exportField($this->diagnosis);
                        $doc->exportField($this->tata);
                        $doc->exportField($this->konsulrujuk);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
