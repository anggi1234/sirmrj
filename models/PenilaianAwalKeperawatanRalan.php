<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for penilaian_awal_keperawatan_ralan
 */
class PenilaianAwalKeperawatanRalan extends DbTable
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
    public $no_rawat;
    public $tanggal;
    public $informasi;
    public $td;
    public $nadi;
    public $rr;
    public $suhu;
    public $gcs;
    public $bb;
    public $tb;
    public $bmi;
    public $keluhan_utama;
    public $rpd;
    public $rpk;
    public $rpo;
    public $alergi;
    public $alat_bantu;
    public $ket_bantu;
    public $prothesa;
    public $ket_pro;
    public $adl;
    public $status_psiko;
    public $ket_psiko;
    public $hub_keluarga;
    public $tinggal_dengan;
    public $ket_tinggal;
    public $ekonomi;
    public $budaya;
    public $ket_budaya;
    public $edukasi;
    public $ket_edukasi;
    public $berjalan_a;
    public $berjalan_b;
    public $berjalan_c;
    public $hasil;
    public $lapor;
    public $ket_lapor;
    public $sg1;
    public $nilai1;
    public $sg2;
    public $nilai2;
    public $total_hasil;
    public $nyeri;
    public $provokes;
    public $ket_provokes;
    public $quality;
    public $ket_quality;
    public $lokasi;
    public $menyebar;
    public $skala_nyeri;
    public $durasi;
    public $nyeri_hilang;
    public $ket_nyeri;
    public $pada_dokter;
    public $ket_dokter;
    public $rencana;
    public $nip;
    public $id_penilaian_awal_keperawatan;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'penilaian_awal_keperawatan_ralan';
        $this->TableName = 'penilaian_awal_keperawatan_ralan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`penilaian_awal_keperawatan_ralan`";
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

        // no_rawat
        $this->no_rawat = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_no_rawat', 'no_rawat', '`no_rawat`', '`no_rawat`', 200, 17, -1, false, '`no_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->IsForeignKey = true; // Foreign key field
        $this->no_rawat->Nullable = false; // NOT NULL field
        $this->no_rawat->Required = true; // Required field
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // tanggal
        $this->tanggal = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 135, 19, 0, false, '`tanggal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal->Nullable = false; // NOT NULL field
        $this->tanggal->Sortable = true; // Allow sort
        $this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal->Param, "CustomMsg");
        $this->Fields['tanggal'] = &$this->tanggal;

        // informasi
        $this->informasi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_informasi', 'informasi', '`informasi`', '`informasi`', 202, 13, -1, false, '`informasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->informasi->Nullable = false; // NOT NULL field
        $this->informasi->Required = true; // Required field
        $this->informasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->informasi->Lookup = new Lookup('informasi', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->informasi->Lookup = new Lookup('informasi', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->informasi->OptionCount = 2;
        $this->informasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->informasi->Param, "CustomMsg");
        $this->Fields['informasi'] = &$this->informasi;

        // td
        $this->td = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_td', 'td', '`td`', '`td`', 200, 8, -1, false, '`td`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->td->Nullable = false; // NOT NULL field
        $this->td->Required = true; // Required field
        $this->td->Sortable = true; // Allow sort
        $this->td->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->td->Param, "CustomMsg");
        $this->Fields['td'] = &$this->td;

        // nadi
        $this->nadi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_nadi', 'nadi', '`nadi`', '`nadi`', 200, 5, -1, false, '`nadi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nadi->Nullable = false; // NOT NULL field
        $this->nadi->Required = true; // Required field
        $this->nadi->Sortable = true; // Allow sort
        $this->nadi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nadi->Param, "CustomMsg");
        $this->Fields['nadi'] = &$this->nadi;

        // rr
        $this->rr = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_rr', 'rr', '`rr`', '`rr`', 200, 5, -1, false, '`rr`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rr->Nullable = false; // NOT NULL field
        $this->rr->Required = true; // Required field
        $this->rr->Sortable = true; // Allow sort
        $this->rr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rr->Param, "CustomMsg");
        $this->Fields['rr'] = &$this->rr;

        // suhu
        $this->suhu = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_suhu', 'suhu', '`suhu`', '`suhu`', 200, 5, -1, false, '`suhu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->suhu->Nullable = false; // NOT NULL field
        $this->suhu->Required = true; // Required field
        $this->suhu->Sortable = true; // Allow sort
        $this->suhu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->suhu->Param, "CustomMsg");
        $this->Fields['suhu'] = &$this->suhu;

        // gcs
        $this->gcs = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_gcs', 'gcs', '`gcs`', '`gcs`', 200, 5, -1, false, '`gcs`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->gcs->Nullable = false; // NOT NULL field
        $this->gcs->Required = true; // Required field
        $this->gcs->Sortable = true; // Allow sort
        $this->gcs->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gcs->Param, "CustomMsg");
        $this->Fields['gcs'] = &$this->gcs;

        // bb
        $this->bb = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_bb', 'bb', '`bb`', '`bb`', 200, 5, -1, false, '`bb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bb->Nullable = false; // NOT NULL field
        $this->bb->Required = true; // Required field
        $this->bb->Sortable = true; // Allow sort
        $this->bb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bb->Param, "CustomMsg");
        $this->Fields['bb'] = &$this->bb;

        // tb
        $this->tb = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_tb', 'tb', '`tb`', '`tb`', 200, 5, -1, false, '`tb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tb->Nullable = false; // NOT NULL field
        $this->tb->Required = true; // Required field
        $this->tb->Sortable = true; // Allow sort
        $this->tb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tb->Param, "CustomMsg");
        $this->Fields['tb'] = &$this->tb;

        // bmi
        $this->bmi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_bmi', 'bmi', '`bmi`', '`bmi`', 200, 10, -1, false, '`bmi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bmi->Nullable = false; // NOT NULL field
        $this->bmi->Required = true; // Required field
        $this->bmi->Sortable = true; // Allow sort
        $this->bmi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bmi->Param, "CustomMsg");
        $this->Fields['bmi'] = &$this->bmi;

        // keluhan_utama
        $this->keluhan_utama = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_keluhan_utama', 'keluhan_utama', '`keluhan_utama`', '`keluhan_utama`', 200, 150, -1, false, '`keluhan_utama`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->keluhan_utama->Nullable = false; // NOT NULL field
        $this->keluhan_utama->Required = true; // Required field
        $this->keluhan_utama->Sortable = true; // Allow sort
        $this->keluhan_utama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keluhan_utama->Param, "CustomMsg");
        $this->Fields['keluhan_utama'] = &$this->keluhan_utama;

        // rpd
        $this->rpd = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_rpd', 'rpd', '`rpd`', '`rpd`', 200, 100, -1, false, '`rpd`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rpd->Nullable = false; // NOT NULL field
        $this->rpd->Required = true; // Required field
        $this->rpd->Sortable = true; // Allow sort
        $this->rpd->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpd->Param, "CustomMsg");
        $this->Fields['rpd'] = &$this->rpd;

        // rpk
        $this->rpk = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_rpk', 'rpk', '`rpk`', '`rpk`', 200, 100, -1, false, '`rpk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rpk->Nullable = false; // NOT NULL field
        $this->rpk->Required = true; // Required field
        $this->rpk->Sortable = true; // Allow sort
        $this->rpk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpk->Param, "CustomMsg");
        $this->Fields['rpk'] = &$this->rpk;

        // rpo
        $this->rpo = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_rpo', 'rpo', '`rpo`', '`rpo`', 200, 100, -1, false, '`rpo`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rpo->Nullable = false; // NOT NULL field
        $this->rpo->Required = true; // Required field
        $this->rpo->Sortable = true; // Allow sort
        $this->rpo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo->Param, "CustomMsg");
        $this->Fields['rpo'] = &$this->rpo;

        // alergi
        $this->alergi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_alergi', 'alergi', '`alergi`', '`alergi`', 200, 25, -1, false, '`alergi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alergi->Nullable = false; // NOT NULL field
        $this->alergi->Required = true; // Required field
        $this->alergi->Sortable = true; // Allow sort
        $this->alergi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alergi->Param, "CustomMsg");
        $this->Fields['alergi'] = &$this->alergi;

        // alat_bantu
        $this->alat_bantu = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_alat_bantu', 'alat_bantu', '`alat_bantu`', '`alat_bantu`', 202, 5, -1, false, '`alat_bantu`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->alat_bantu->Nullable = false; // NOT NULL field
        $this->alat_bantu->Required = true; // Required field
        $this->alat_bantu->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->alat_bantu->Lookup = new Lookup('alat_bantu', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->alat_bantu->Lookup = new Lookup('alat_bantu', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->alat_bantu->OptionCount = 2;
        $this->alat_bantu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alat_bantu->Param, "CustomMsg");
        $this->Fields['alat_bantu'] = &$this->alat_bantu;

        // ket_bantu
        $this->ket_bantu = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_bantu', 'ket_bantu', '`ket_bantu`', '`ket_bantu`', 200, 50, -1, false, '`ket_bantu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_bantu->Nullable = false; // NOT NULL field
        $this->ket_bantu->Required = true; // Required field
        $this->ket_bantu->Sortable = true; // Allow sort
        $this->ket_bantu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_bantu->Param, "CustomMsg");
        $this->Fields['ket_bantu'] = &$this->ket_bantu;

        // prothesa
        $this->prothesa = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_prothesa', 'prothesa', '`prothesa`', '`prothesa`', 202, 5, -1, false, '`prothesa`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->prothesa->Nullable = false; // NOT NULL field
        $this->prothesa->Required = true; // Required field
        $this->prothesa->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->prothesa->Lookup = new Lookup('prothesa', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->prothesa->Lookup = new Lookup('prothesa', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->prothesa->OptionCount = 2;
        $this->prothesa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->prothesa->Param, "CustomMsg");
        $this->Fields['prothesa'] = &$this->prothesa;

        // ket_pro
        $this->ket_pro = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_pro', 'ket_pro', '`ket_pro`', '`ket_pro`', 200, 50, -1, false, '`ket_pro`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_pro->Nullable = false; // NOT NULL field
        $this->ket_pro->Required = true; // Required field
        $this->ket_pro->Sortable = true; // Allow sort
        $this->ket_pro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_pro->Param, "CustomMsg");
        $this->Fields['ket_pro'] = &$this->ket_pro;

        // adl
        $this->adl = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_adl', 'adl', '`adl`', '`adl`', 202, 7, -1, false, '`adl`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl->Nullable = false; // NOT NULL field
        $this->adl->Required = true; // Required field
        $this->adl->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl->Lookup = new Lookup('adl', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl->Lookup = new Lookup('adl', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl->OptionCount = 2;
        $this->adl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl->Param, "CustomMsg");
        $this->Fields['adl'] = &$this->adl;

        // status_psiko
        $this->status_psiko = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_status_psiko', 'status_psiko', '`status_psiko`', '`status_psiko`', 202, 9, -1, false, '`status_psiko`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status_psiko->Nullable = false; // NOT NULL field
        $this->status_psiko->Required = true; // Required field
        $this->status_psiko->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->status_psiko->Lookup = new Lookup('status_psiko', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->status_psiko->Lookup = new Lookup('status_psiko', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->status_psiko->OptionCount = 5;
        $this->status_psiko->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_psiko->Param, "CustomMsg");
        $this->Fields['status_psiko'] = &$this->status_psiko;

        // ket_psiko
        $this->ket_psiko = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_psiko', 'ket_psiko', '`ket_psiko`', '`ket_psiko`', 200, 70, -1, false, '`ket_psiko`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_psiko->Nullable = false; // NOT NULL field
        $this->ket_psiko->Required = true; // Required field
        $this->ket_psiko->Sortable = true; // Allow sort
        $this->ket_psiko->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_psiko->Param, "CustomMsg");
        $this->Fields['ket_psiko'] = &$this->ket_psiko;

        // hub_keluarga
        $this->hub_keluarga = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_hub_keluarga', 'hub_keluarga', '`hub_keluarga`', '`hub_keluarga`', 202, 10, -1, false, '`hub_keluarga`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->hub_keluarga->Nullable = false; // NOT NULL field
        $this->hub_keluarga->Required = true; // Required field
        $this->hub_keluarga->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->hub_keluarga->Lookup = new Lookup('hub_keluarga', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->hub_keluarga->Lookup = new Lookup('hub_keluarga', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->hub_keluarga->OptionCount = 2;
        $this->hub_keluarga->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hub_keluarga->Param, "CustomMsg");
        $this->Fields['hub_keluarga'] = &$this->hub_keluarga;

        // tinggal_dengan
        $this->tinggal_dengan = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_tinggal_dengan', 'tinggal_dengan', '`tinggal_dengan`', '`tinggal_dengan`', 202, 13, -1, false, '`tinggal_dengan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->tinggal_dengan->Nullable = false; // NOT NULL field
        $this->tinggal_dengan->Required = true; // Required field
        $this->tinggal_dengan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->tinggal_dengan->Lookup = new Lookup('tinggal_dengan', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->tinggal_dengan->Lookup = new Lookup('tinggal_dengan', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->tinggal_dengan->OptionCount = 4;
        $this->tinggal_dengan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tinggal_dengan->Param, "CustomMsg");
        $this->Fields['tinggal_dengan'] = &$this->tinggal_dengan;

        // ket_tinggal
        $this->ket_tinggal = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_tinggal', 'ket_tinggal', '`ket_tinggal`', '`ket_tinggal`', 200, 40, -1, false, '`ket_tinggal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_tinggal->Nullable = false; // NOT NULL field
        $this->ket_tinggal->Required = true; // Required field
        $this->ket_tinggal->Sortable = true; // Allow sort
        $this->ket_tinggal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_tinggal->Param, "CustomMsg");
        $this->Fields['ket_tinggal'] = &$this->ket_tinggal;

        // ekonomi
        $this->ekonomi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ekonomi', 'ekonomi', '`ekonomi`', '`ekonomi`', 202, 6, -1, false, '`ekonomi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->ekonomi->Nullable = false; // NOT NULL field
        $this->ekonomi->Required = true; // Required field
        $this->ekonomi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->ekonomi->Lookup = new Lookup('ekonomi', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ekonomi->Lookup = new Lookup('ekonomi', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ekonomi->OptionCount = 3;
        $this->ekonomi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ekonomi->Param, "CustomMsg");
        $this->Fields['ekonomi'] = &$this->ekonomi;

        // budaya
        $this->budaya = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_budaya', 'budaya', '`budaya`', '`budaya`', 202, 9, -1, false, '`budaya`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->budaya->Nullable = false; // NOT NULL field
        $this->budaya->Required = true; // Required field
        $this->budaya->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->budaya->Lookup = new Lookup('budaya', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->budaya->Lookup = new Lookup('budaya', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->budaya->OptionCount = 2;
        $this->budaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->budaya->Param, "CustomMsg");
        $this->Fields['budaya'] = &$this->budaya;

        // ket_budaya
        $this->ket_budaya = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_budaya', 'ket_budaya', '`ket_budaya`', '`ket_budaya`', 200, 50, -1, false, '`ket_budaya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_budaya->Nullable = false; // NOT NULL field
        $this->ket_budaya->Required = true; // Required field
        $this->ket_budaya->Sortable = true; // Allow sort
        $this->ket_budaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_budaya->Param, "CustomMsg");
        $this->Fields['ket_budaya'] = &$this->ket_budaya;

        // edukasi
        $this->edukasi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_edukasi', 'edukasi', '`edukasi`', '`edukasi`', 202, 8, -1, false, '`edukasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->edukasi->Nullable = false; // NOT NULL field
        $this->edukasi->Required = true; // Required field
        $this->edukasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->edukasi->Lookup = new Lookup('edukasi', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->edukasi->Lookup = new Lookup('edukasi', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->edukasi->OptionCount = 2;
        $this->edukasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->edukasi->Param, "CustomMsg");
        $this->Fields['edukasi'] = &$this->edukasi;

        // ket_edukasi
        $this->ket_edukasi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_edukasi', 'ket_edukasi', '`ket_edukasi`', '`ket_edukasi`', 200, 50, -1, false, '`ket_edukasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_edukasi->Nullable = false; // NOT NULL field
        $this->ket_edukasi->Required = true; // Required field
        $this->ket_edukasi->Sortable = true; // Allow sort
        $this->ket_edukasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_edukasi->Param, "CustomMsg");
        $this->Fields['ket_edukasi'] = &$this->ket_edukasi;

        // berjalan_a
        $this->berjalan_a = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_berjalan_a', 'berjalan_a', '`berjalan_a`', '`berjalan_a`', 202, 5, -1, false, '`berjalan_a`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->berjalan_a->Nullable = false; // NOT NULL field
        $this->berjalan_a->Required = true; // Required field
        $this->berjalan_a->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->berjalan_a->Lookup = new Lookup('berjalan_a', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->berjalan_a->Lookup = new Lookup('berjalan_a', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->berjalan_a->OptionCount = 2;
        $this->berjalan_a->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->berjalan_a->Param, "CustomMsg");
        $this->Fields['berjalan_a'] = &$this->berjalan_a;

        // berjalan_b
        $this->berjalan_b = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_berjalan_b', 'berjalan_b', '`berjalan_b`', '`berjalan_b`', 202, 5, -1, false, '`berjalan_b`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->berjalan_b->Nullable = false; // NOT NULL field
        $this->berjalan_b->Required = true; // Required field
        $this->berjalan_b->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->berjalan_b->Lookup = new Lookup('berjalan_b', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->berjalan_b->Lookup = new Lookup('berjalan_b', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->berjalan_b->OptionCount = 2;
        $this->berjalan_b->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->berjalan_b->Param, "CustomMsg");
        $this->Fields['berjalan_b'] = &$this->berjalan_b;

        // berjalan_c
        $this->berjalan_c = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_berjalan_c', 'berjalan_c', '`berjalan_c`', '`berjalan_c`', 202, 5, -1, false, '`berjalan_c`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->berjalan_c->Nullable = false; // NOT NULL field
        $this->berjalan_c->Required = true; // Required field
        $this->berjalan_c->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->berjalan_c->Lookup = new Lookup('berjalan_c', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->berjalan_c->Lookup = new Lookup('berjalan_c', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->berjalan_c->OptionCount = 2;
        $this->berjalan_c->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->berjalan_c->Param, "CustomMsg");
        $this->Fields['berjalan_c'] = &$this->berjalan_c;

        // hasil
        $this->hasil = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_hasil', 'hasil', '`hasil`', '`hasil`', 202, 40, -1, false, '`hasil`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->hasil->Nullable = false; // NOT NULL field
        $this->hasil->Required = true; // Required field
        $this->hasil->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->hasil->Lookup = new Lookup('hasil', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->hasil->Lookup = new Lookup('hasil', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->hasil->OptionCount = 3;
        $this->hasil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hasil->Param, "CustomMsg");
        $this->Fields['hasil'] = &$this->hasil;

        // lapor
        $this->lapor = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_lapor', 'lapor', '`lapor`', '`lapor`', 202, 5, -1, false, '`lapor`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->lapor->Nullable = false; // NOT NULL field
        $this->lapor->Required = true; // Required field
        $this->lapor->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->lapor->Lookup = new Lookup('lapor', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->lapor->Lookup = new Lookup('lapor', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->lapor->OptionCount = 2;
        $this->lapor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lapor->Param, "CustomMsg");
        $this->Fields['lapor'] = &$this->lapor;

        // ket_lapor
        $this->ket_lapor = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_lapor', 'ket_lapor', '`ket_lapor`', '`ket_lapor`', 200, 15, -1, false, '`ket_lapor`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_lapor->Nullable = false; // NOT NULL field
        $this->ket_lapor->Required = true; // Required field
        $this->ket_lapor->Sortable = true; // Allow sort
        $this->ket_lapor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_lapor->Param, "CustomMsg");
        $this->Fields['ket_lapor'] = &$this->ket_lapor;

        // sg1
        $this->sg1 = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_sg1', 'sg1', '`sg1`', '`sg1`', 202, 12, -1, false, '`sg1`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sg1->Nullable = false; // NOT NULL field
        $this->sg1->Required = true; // Required field
        $this->sg1->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sg1->Lookup = new Lookup('sg1', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sg1->Lookup = new Lookup('sg1', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sg1->OptionCount = 6;
        $this->sg1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sg1->Param, "CustomMsg");
        $this->Fields['sg1'] = &$this->sg1;

        // nilai1
        $this->nilai1 = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_nilai1', 'nilai1', '`nilai1`', '`nilai1`', 202, 1, -1, false, '`nilai1`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->nilai1->Nullable = false; // NOT NULL field
        $this->nilai1->Required = true; // Required field
        $this->nilai1->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->nilai1->Lookup = new Lookup('nilai1', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nilai1->Lookup = new Lookup('nilai1', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nilai1->OptionCount = 5;
        $this->nilai1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nilai1->Param, "CustomMsg");
        $this->Fields['nilai1'] = &$this->nilai1;

        // sg2
        $this->sg2 = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_sg2', 'sg2', '`sg2`', '`sg2`', 202, 5, -1, false, '`sg2`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sg2->Nullable = false; // NOT NULL field
        $this->sg2->Required = true; // Required field
        $this->sg2->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sg2->Lookup = new Lookup('sg2', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sg2->Lookup = new Lookup('sg2', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sg2->OptionCount = 2;
        $this->sg2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sg2->Param, "CustomMsg");
        $this->Fields['sg2'] = &$this->sg2;

        // nilai2
        $this->nilai2 = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_nilai2', 'nilai2', '`nilai2`', '`nilai2`', 202, 1, -1, false, '`nilai2`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->nilai2->Nullable = false; // NOT NULL field
        $this->nilai2->Sortable = true; // Allow sort
        $this->nilai2->DataType = DATATYPE_BOOLEAN;
        switch ($CurrentLanguage) {
            case "en":
                $this->nilai2->Lookup = new Lookup('nilai2', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nilai2->Lookup = new Lookup('nilai2', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nilai2->OptionCount = 2;
        $this->nilai2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nilai2->Param, "CustomMsg");
        $this->Fields['nilai2'] = &$this->nilai2;

        // total_hasil
        $this->total_hasil = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_total_hasil', 'total_hasil', '`total_hasil`', '`total_hasil`', 16, 4, -1, false, '`total_hasil`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->total_hasil->Nullable = false; // NOT NULL field
        $this->total_hasil->Required = true; // Required field
        $this->total_hasil->Sortable = true; // Allow sort
        $this->total_hasil->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->total_hasil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->total_hasil->Param, "CustomMsg");
        $this->Fields['total_hasil'] = &$this->total_hasil;

        // nyeri
        $this->nyeri = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_nyeri', 'nyeri', '`nyeri`', '`nyeri`', 202, 15, -1, false, '`nyeri`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->nyeri->Nullable = false; // NOT NULL field
        $this->nyeri->Required = true; // Required field
        $this->nyeri->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->nyeri->Lookup = new Lookup('nyeri', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nyeri->Lookup = new Lookup('nyeri', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nyeri->OptionCount = 3;
        $this->nyeri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nyeri->Param, "CustomMsg");
        $this->Fields['nyeri'] = &$this->nyeri;

        // provokes
        $this->provokes = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_provokes', 'provokes', '`provokes`', '`provokes`', 202, 15, -1, false, '`provokes`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->provokes->Nullable = false; // NOT NULL field
        $this->provokes->Required = true; // Required field
        $this->provokes->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->provokes->Lookup = new Lookup('provokes', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->provokes->Lookup = new Lookup('provokes', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->provokes->OptionCount = 3;
        $this->provokes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->provokes->Param, "CustomMsg");
        $this->Fields['provokes'] = &$this->provokes;

        // ket_provokes
        $this->ket_provokes = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_provokes', 'ket_provokes', '`ket_provokes`', '`ket_provokes`', 200, 40, -1, false, '`ket_provokes`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_provokes->Nullable = false; // NOT NULL field
        $this->ket_provokes->Required = true; // Required field
        $this->ket_provokes->Sortable = true; // Allow sort
        $this->ket_provokes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_provokes->Param, "CustomMsg");
        $this->Fields['ket_provokes'] = &$this->ket_provokes;

        // quality
        $this->quality = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_quality', 'quality', '`quality`', '`quality`', 202, 16, -1, false, '`quality`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->quality->Nullable = false; // NOT NULL field
        $this->quality->Required = true; // Required field
        $this->quality->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->quality->Lookup = new Lookup('quality', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->quality->Lookup = new Lookup('quality', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->quality->OptionCount = 6;
        $this->quality->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->quality->Param, "CustomMsg");
        $this->Fields['quality'] = &$this->quality;

        // ket_quality
        $this->ket_quality = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_quality', 'ket_quality', '`ket_quality`', '`ket_quality`', 200, 50, -1, false, '`ket_quality`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_quality->Nullable = false; // NOT NULL field
        $this->ket_quality->Required = true; // Required field
        $this->ket_quality->Sortable = true; // Allow sort
        $this->ket_quality->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_quality->Param, "CustomMsg");
        $this->Fields['ket_quality'] = &$this->ket_quality;

        // lokasi
        $this->lokasi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_lokasi', 'lokasi', '`lokasi`', '`lokasi`', 200, 50, -1, false, '`lokasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lokasi->Nullable = false; // NOT NULL field
        $this->lokasi->Required = true; // Required field
        $this->lokasi->Sortable = true; // Allow sort
        $this->lokasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lokasi->Param, "CustomMsg");
        $this->Fields['lokasi'] = &$this->lokasi;

        // menyebar
        $this->menyebar = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_menyebar', 'menyebar', '`menyebar`', '`menyebar`', 202, 5, -1, false, '`menyebar`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->menyebar->Nullable = false; // NOT NULL field
        $this->menyebar->Required = true; // Required field
        $this->menyebar->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->menyebar->Lookup = new Lookup('menyebar', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->menyebar->Lookup = new Lookup('menyebar', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->menyebar->OptionCount = 2;
        $this->menyebar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->menyebar->Param, "CustomMsg");
        $this->Fields['menyebar'] = &$this->menyebar;

        // skala_nyeri
        $this->skala_nyeri = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_skala_nyeri', 'skala_nyeri', '`skala_nyeri`', '`skala_nyeri`', 202, 2, -1, false, '`skala_nyeri`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->skala_nyeri->Nullable = false; // NOT NULL field
        $this->skala_nyeri->Required = true; // Required field
        $this->skala_nyeri->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->skala_nyeri->Lookup = new Lookup('skala_nyeri', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->skala_nyeri->Lookup = new Lookup('skala_nyeri', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->skala_nyeri->OptionCount = 11;
        $this->skala_nyeri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skala_nyeri->Param, "CustomMsg");
        $this->Fields['skala_nyeri'] = &$this->skala_nyeri;

        // durasi
        $this->durasi = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_durasi', 'durasi', '`durasi`', '`durasi`', 200, 25, -1, false, '`durasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->durasi->Nullable = false; // NOT NULL field
        $this->durasi->Required = true; // Required field
        $this->durasi->Sortable = true; // Allow sort
        $this->durasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->durasi->Param, "CustomMsg");
        $this->Fields['durasi'] = &$this->durasi;

        // nyeri_hilang
        $this->nyeri_hilang = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_nyeri_hilang', 'nyeri_hilang', '`nyeri_hilang`', '`nyeri_hilang`', 202, 14, -1, false, '`nyeri_hilang`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->nyeri_hilang->Nullable = false; // NOT NULL field
        $this->nyeri_hilang->Required = true; // Required field
        $this->nyeri_hilang->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->nyeri_hilang->Lookup = new Lookup('nyeri_hilang', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nyeri_hilang->Lookup = new Lookup('nyeri_hilang', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nyeri_hilang->OptionCount = 3;
        $this->nyeri_hilang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nyeri_hilang->Param, "CustomMsg");
        $this->Fields['nyeri_hilang'] = &$this->nyeri_hilang;

        // ket_nyeri
        $this->ket_nyeri = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_nyeri', 'ket_nyeri', '`ket_nyeri`', '`ket_nyeri`', 200, 40, -1, false, '`ket_nyeri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_nyeri->Nullable = false; // NOT NULL field
        $this->ket_nyeri->Required = true; // Required field
        $this->ket_nyeri->Sortable = true; // Allow sort
        $this->ket_nyeri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_nyeri->Param, "CustomMsg");
        $this->Fields['ket_nyeri'] = &$this->ket_nyeri;

        // pada_dokter
        $this->pada_dokter = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_pada_dokter', 'pada_dokter', '`pada_dokter`', '`pada_dokter`', 202, 5, -1, false, '`pada_dokter`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->pada_dokter->Nullable = false; // NOT NULL field
        $this->pada_dokter->Required = true; // Required field
        $this->pada_dokter->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->pada_dokter->Lookup = new Lookup('pada_dokter', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->pada_dokter->Lookup = new Lookup('pada_dokter', 'penilaian_awal_keperawatan_ralan', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->pada_dokter->OptionCount = 2;
        $this->pada_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pada_dokter->Param, "CustomMsg");
        $this->Fields['pada_dokter'] = &$this->pada_dokter;

        // ket_dokter
        $this->ket_dokter = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_ket_dokter', 'ket_dokter', '`ket_dokter`', '`ket_dokter`', 200, 15, -1, false, '`ket_dokter`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_dokter->Nullable = false; // NOT NULL field
        $this->ket_dokter->Required = true; // Required field
        $this->ket_dokter->Sortable = true; // Allow sort
        $this->ket_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_dokter->Param, "CustomMsg");
        $this->Fields['ket_dokter'] = &$this->ket_dokter;

        // rencana
        $this->rencana = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_rencana', 'rencana', '`rencana`', '`rencana`', 200, 200, -1, false, '`rencana`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rencana->Nullable = false; // NOT NULL field
        $this->rencana->Required = true; // Required field
        $this->rencana->Sortable = true; // Allow sort
        $this->rencana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rencana->Param, "CustomMsg");
        $this->Fields['rencana'] = &$this->rencana;

        // nip
        $this->nip = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_nip', 'nip', '`nip`', '`nip`', 200, 20, -1, false, '`nip`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nip->Required = true; // Required field
        $this->nip->Sortable = true; // Allow sort
        $this->nip->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nip->Param, "CustomMsg");
        $this->Fields['nip'] = &$this->nip;

        // id_penilaian_awal_keperawatan
        $this->id_penilaian_awal_keperawatan = new DbField('penilaian_awal_keperawatan_ralan', 'penilaian_awal_keperawatan_ralan', 'x_id_penilaian_awal_keperawatan', 'id_penilaian_awal_keperawatan', '`id_penilaian_awal_keperawatan`', '`id_penilaian_awal_keperawatan`', 3, 6, -1, false, '`id_penilaian_awal_keperawatan`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_penilaian_awal_keperawatan->IsAutoIncrement = true; // Autoincrement field
        $this->id_penilaian_awal_keperawatan->IsPrimaryKey = true; // Primary key field
        $this->id_penilaian_awal_keperawatan->Sortable = true; // Allow sort
        $this->id_penilaian_awal_keperawatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_penilaian_awal_keperawatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_penilaian_awal_keperawatan->Param, "CustomMsg");
        $this->Fields['id_penilaian_awal_keperawatan'] = &$this->id_penilaian_awal_keperawatan;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`penilaian_awal_keperawatan_ralan`";
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
            $this->id_penilaian_awal_keperawatan->setDbValue($conn->lastInsertId());
            $rs['id_penilaian_awal_keperawatan'] = $this->id_penilaian_awal_keperawatan->DbValue;
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
            if (array_key_exists('id_penilaian_awal_keperawatan', $rs)) {
                AddFilter($where, QuotedName('id_penilaian_awal_keperawatan', $this->Dbid) . '=' . QuotedValue($rs['id_penilaian_awal_keperawatan'], $this->id_penilaian_awal_keperawatan->DataType, $this->Dbid));
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
        $this->no_rawat->DbValue = $row['no_rawat'];
        $this->tanggal->DbValue = $row['tanggal'];
        $this->informasi->DbValue = $row['informasi'];
        $this->td->DbValue = $row['td'];
        $this->nadi->DbValue = $row['nadi'];
        $this->rr->DbValue = $row['rr'];
        $this->suhu->DbValue = $row['suhu'];
        $this->gcs->DbValue = $row['gcs'];
        $this->bb->DbValue = $row['bb'];
        $this->tb->DbValue = $row['tb'];
        $this->bmi->DbValue = $row['bmi'];
        $this->keluhan_utama->DbValue = $row['keluhan_utama'];
        $this->rpd->DbValue = $row['rpd'];
        $this->rpk->DbValue = $row['rpk'];
        $this->rpo->DbValue = $row['rpo'];
        $this->alergi->DbValue = $row['alergi'];
        $this->alat_bantu->DbValue = $row['alat_bantu'];
        $this->ket_bantu->DbValue = $row['ket_bantu'];
        $this->prothesa->DbValue = $row['prothesa'];
        $this->ket_pro->DbValue = $row['ket_pro'];
        $this->adl->DbValue = $row['adl'];
        $this->status_psiko->DbValue = $row['status_psiko'];
        $this->ket_psiko->DbValue = $row['ket_psiko'];
        $this->hub_keluarga->DbValue = $row['hub_keluarga'];
        $this->tinggal_dengan->DbValue = $row['tinggal_dengan'];
        $this->ket_tinggal->DbValue = $row['ket_tinggal'];
        $this->ekonomi->DbValue = $row['ekonomi'];
        $this->budaya->DbValue = $row['budaya'];
        $this->ket_budaya->DbValue = $row['ket_budaya'];
        $this->edukasi->DbValue = $row['edukasi'];
        $this->ket_edukasi->DbValue = $row['ket_edukasi'];
        $this->berjalan_a->DbValue = $row['berjalan_a'];
        $this->berjalan_b->DbValue = $row['berjalan_b'];
        $this->berjalan_c->DbValue = $row['berjalan_c'];
        $this->hasil->DbValue = $row['hasil'];
        $this->lapor->DbValue = $row['lapor'];
        $this->ket_lapor->DbValue = $row['ket_lapor'];
        $this->sg1->DbValue = $row['sg1'];
        $this->nilai1->DbValue = $row['nilai1'];
        $this->sg2->DbValue = $row['sg2'];
        $this->nilai2->DbValue = $row['nilai2'];
        $this->total_hasil->DbValue = $row['total_hasil'];
        $this->nyeri->DbValue = $row['nyeri'];
        $this->provokes->DbValue = $row['provokes'];
        $this->ket_provokes->DbValue = $row['ket_provokes'];
        $this->quality->DbValue = $row['quality'];
        $this->ket_quality->DbValue = $row['ket_quality'];
        $this->lokasi->DbValue = $row['lokasi'];
        $this->menyebar->DbValue = $row['menyebar'];
        $this->skala_nyeri->DbValue = $row['skala_nyeri'];
        $this->durasi->DbValue = $row['durasi'];
        $this->nyeri_hilang->DbValue = $row['nyeri_hilang'];
        $this->ket_nyeri->DbValue = $row['ket_nyeri'];
        $this->pada_dokter->DbValue = $row['pada_dokter'];
        $this->ket_dokter->DbValue = $row['ket_dokter'];
        $this->rencana->DbValue = $row['rencana'];
        $this->nip->DbValue = $row['nip'];
        $this->id_penilaian_awal_keperawatan->DbValue = $row['id_penilaian_awal_keperawatan'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_penilaian_awal_keperawatan` = @id_penilaian_awal_keperawatan@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_penilaian_awal_keperawatan->CurrentValue : $this->id_penilaian_awal_keperawatan->OldValue;
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
                $this->id_penilaian_awal_keperawatan->CurrentValue = $keys[0];
            } else {
                $this->id_penilaian_awal_keperawatan->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_penilaian_awal_keperawatan', $row) ? $row['id_penilaian_awal_keperawatan'] : null;
        } else {
            $val = $this->id_penilaian_awal_keperawatan->OldValue !== null ? $this->id_penilaian_awal_keperawatan->OldValue : $this->id_penilaian_awal_keperawatan->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_penilaian_awal_keperawatan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PenilaianAwalKeperawatanRalanList");
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
        if ($pageName == "PenilaianAwalKeperawatanRalanView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PenilaianAwalKeperawatanRalanEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PenilaianAwalKeperawatanRalanAdd") {
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
                return "PenilaianAwalKeperawatanRalanView";
            case Config("API_ADD_ACTION"):
                return "PenilaianAwalKeperawatanRalanAdd";
            case Config("API_EDIT_ACTION"):
                return "PenilaianAwalKeperawatanRalanEdit";
            case Config("API_DELETE_ACTION"):
                return "PenilaianAwalKeperawatanRalanDelete";
            case Config("API_LIST_ACTION"):
                return "PenilaianAwalKeperawatanRalanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PenilaianAwalKeperawatanRalanList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PenilaianAwalKeperawatanRalanView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PenilaianAwalKeperawatanRalanView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PenilaianAwalKeperawatanRalanAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PenilaianAwalKeperawatanRalanAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PenilaianAwalKeperawatanRalanEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PenilaianAwalKeperawatanRalanAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PenilaianAwalKeperawatanRalanDelete", $this->getUrlParm());
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
        $json .= "id_penilaian_awal_keperawatan:" . JsonEncode($this->id_penilaian_awal_keperawatan->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_penilaian_awal_keperawatan->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_penilaian_awal_keperawatan->CurrentValue);
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
            if (($keyValue = Param("id_penilaian_awal_keperawatan") ?? Route("id_penilaian_awal_keperawatan")) !== null) {
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
                $this->id_penilaian_awal_keperawatan->CurrentValue = $key;
            } else {
                $this->id_penilaian_awal_keperawatan->OldValue = $key;
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
        $this->id_penilaian_awal_keperawatan->setDbValue($row['id_penilaian_awal_keperawatan']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // id_penilaian_awal_keperawatan

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

        // id_penilaian_awal_keperawatan
        $this->id_penilaian_awal_keperawatan->ViewValue = $this->id_penilaian_awal_keperawatan->CurrentValue;
        $this->id_penilaian_awal_keperawatan->ViewCustomAttributes = "";

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

        // id_penilaian_awal_keperawatan
        $this->id_penilaian_awal_keperawatan->LinkCustomAttributes = "";
        $this->id_penilaian_awal_keperawatan->HrefValue = "";
        $this->id_penilaian_awal_keperawatan->TooltipValue = "";

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
            $this->no_rawat->EditValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());
        }

        // tanggal

        // informasi
        $this->informasi->EditCustomAttributes = "";
        $this->informasi->EditValue = $this->informasi->options(false);
        $this->informasi->PlaceHolder = RemoveHtml($this->informasi->caption());

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

        // gcs
        $this->gcs->EditAttrs["class"] = "form-control";
        $this->gcs->EditCustomAttributes = "";
        if (!$this->gcs->Raw) {
            $this->gcs->CurrentValue = HtmlDecode($this->gcs->CurrentValue);
        }
        $this->gcs->EditValue = $this->gcs->CurrentValue;
        $this->gcs->PlaceHolder = RemoveHtml($this->gcs->caption());

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

        // bmi
        $this->bmi->EditAttrs["class"] = "form-control";
        $this->bmi->EditCustomAttributes = "";
        if (!$this->bmi->Raw) {
            $this->bmi->CurrentValue = HtmlDecode($this->bmi->CurrentValue);
        }
        $this->bmi->EditValue = $this->bmi->CurrentValue;
        $this->bmi->PlaceHolder = RemoveHtml($this->bmi->caption());

        // keluhan_utama
        $this->keluhan_utama->EditAttrs["class"] = "form-control";
        $this->keluhan_utama->EditCustomAttributes = "";
        if (!$this->keluhan_utama->Raw) {
            $this->keluhan_utama->CurrentValue = HtmlDecode($this->keluhan_utama->CurrentValue);
        }
        $this->keluhan_utama->EditValue = $this->keluhan_utama->CurrentValue;
        $this->keluhan_utama->PlaceHolder = RemoveHtml($this->keluhan_utama->caption());

        // rpd
        $this->rpd->EditAttrs["class"] = "form-control";
        $this->rpd->EditCustomAttributes = "";
        if (!$this->rpd->Raw) {
            $this->rpd->CurrentValue = HtmlDecode($this->rpd->CurrentValue);
        }
        $this->rpd->EditValue = $this->rpd->CurrentValue;
        $this->rpd->PlaceHolder = RemoveHtml($this->rpd->caption());

        // rpk
        $this->rpk->EditAttrs["class"] = "form-control";
        $this->rpk->EditCustomAttributes = "";
        if (!$this->rpk->Raw) {
            $this->rpk->CurrentValue = HtmlDecode($this->rpk->CurrentValue);
        }
        $this->rpk->EditValue = $this->rpk->CurrentValue;
        $this->rpk->PlaceHolder = RemoveHtml($this->rpk->caption());

        // rpo
        $this->rpo->EditAttrs["class"] = "form-control";
        $this->rpo->EditCustomAttributes = "";
        if (!$this->rpo->Raw) {
            $this->rpo->CurrentValue = HtmlDecode($this->rpo->CurrentValue);
        }
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

        // alat_bantu
        $this->alat_bantu->EditCustomAttributes = "";
        $this->alat_bantu->EditValue = $this->alat_bantu->options(false);
        $this->alat_bantu->PlaceHolder = RemoveHtml($this->alat_bantu->caption());

        // ket_bantu
        $this->ket_bantu->EditAttrs["class"] = "form-control";
        $this->ket_bantu->EditCustomAttributes = "";
        if (!$this->ket_bantu->Raw) {
            $this->ket_bantu->CurrentValue = HtmlDecode($this->ket_bantu->CurrentValue);
        }
        $this->ket_bantu->EditValue = $this->ket_bantu->CurrentValue;
        $this->ket_bantu->PlaceHolder = RemoveHtml($this->ket_bantu->caption());

        // prothesa
        $this->prothesa->EditCustomAttributes = "";
        $this->prothesa->EditValue = $this->prothesa->options(false);
        $this->prothesa->PlaceHolder = RemoveHtml($this->prothesa->caption());

        // ket_pro
        $this->ket_pro->EditAttrs["class"] = "form-control";
        $this->ket_pro->EditCustomAttributes = "";
        if (!$this->ket_pro->Raw) {
            $this->ket_pro->CurrentValue = HtmlDecode($this->ket_pro->CurrentValue);
        }
        $this->ket_pro->EditValue = $this->ket_pro->CurrentValue;
        $this->ket_pro->PlaceHolder = RemoveHtml($this->ket_pro->caption());

        // adl
        $this->adl->EditCustomAttributes = "";
        $this->adl->EditValue = $this->adl->options(false);
        $this->adl->PlaceHolder = RemoveHtml($this->adl->caption());

        // status_psiko
        $this->status_psiko->EditCustomAttributes = "";
        $this->status_psiko->EditValue = $this->status_psiko->options(false);
        $this->status_psiko->PlaceHolder = RemoveHtml($this->status_psiko->caption());

        // ket_psiko
        $this->ket_psiko->EditAttrs["class"] = "form-control";
        $this->ket_psiko->EditCustomAttributes = "";
        if (!$this->ket_psiko->Raw) {
            $this->ket_psiko->CurrentValue = HtmlDecode($this->ket_psiko->CurrentValue);
        }
        $this->ket_psiko->EditValue = $this->ket_psiko->CurrentValue;
        $this->ket_psiko->PlaceHolder = RemoveHtml($this->ket_psiko->caption());

        // hub_keluarga
        $this->hub_keluarga->EditCustomAttributes = "";
        $this->hub_keluarga->EditValue = $this->hub_keluarga->options(false);
        $this->hub_keluarga->PlaceHolder = RemoveHtml($this->hub_keluarga->caption());

        // tinggal_dengan
        $this->tinggal_dengan->EditCustomAttributes = "";
        $this->tinggal_dengan->EditValue = $this->tinggal_dengan->options(false);
        $this->tinggal_dengan->PlaceHolder = RemoveHtml($this->tinggal_dengan->caption());

        // ket_tinggal
        $this->ket_tinggal->EditAttrs["class"] = "form-control";
        $this->ket_tinggal->EditCustomAttributes = "";
        if (!$this->ket_tinggal->Raw) {
            $this->ket_tinggal->CurrentValue = HtmlDecode($this->ket_tinggal->CurrentValue);
        }
        $this->ket_tinggal->EditValue = $this->ket_tinggal->CurrentValue;
        $this->ket_tinggal->PlaceHolder = RemoveHtml($this->ket_tinggal->caption());

        // ekonomi
        $this->ekonomi->EditCustomAttributes = "";
        $this->ekonomi->EditValue = $this->ekonomi->options(false);
        $this->ekonomi->PlaceHolder = RemoveHtml($this->ekonomi->caption());

        // budaya
        $this->budaya->EditCustomAttributes = "";
        $this->budaya->EditValue = $this->budaya->options(false);
        $this->budaya->PlaceHolder = RemoveHtml($this->budaya->caption());

        // ket_budaya
        $this->ket_budaya->EditAttrs["class"] = "form-control";
        $this->ket_budaya->EditCustomAttributes = "";
        if (!$this->ket_budaya->Raw) {
            $this->ket_budaya->CurrentValue = HtmlDecode($this->ket_budaya->CurrentValue);
        }
        $this->ket_budaya->EditValue = $this->ket_budaya->CurrentValue;
        $this->ket_budaya->PlaceHolder = RemoveHtml($this->ket_budaya->caption());

        // edukasi
        $this->edukasi->EditCustomAttributes = "";
        $this->edukasi->EditValue = $this->edukasi->options(false);
        $this->edukasi->PlaceHolder = RemoveHtml($this->edukasi->caption());

        // ket_edukasi
        $this->ket_edukasi->EditAttrs["class"] = "form-control";
        $this->ket_edukasi->EditCustomAttributes = "";
        if (!$this->ket_edukasi->Raw) {
            $this->ket_edukasi->CurrentValue = HtmlDecode($this->ket_edukasi->CurrentValue);
        }
        $this->ket_edukasi->EditValue = $this->ket_edukasi->CurrentValue;
        $this->ket_edukasi->PlaceHolder = RemoveHtml($this->ket_edukasi->caption());

        // berjalan_a
        $this->berjalan_a->EditCustomAttributes = "";
        $this->berjalan_a->EditValue = $this->berjalan_a->options(false);
        $this->berjalan_a->PlaceHolder = RemoveHtml($this->berjalan_a->caption());

        // berjalan_b
        $this->berjalan_b->EditCustomAttributes = "";
        $this->berjalan_b->EditValue = $this->berjalan_b->options(false);
        $this->berjalan_b->PlaceHolder = RemoveHtml($this->berjalan_b->caption());

        // berjalan_c
        $this->berjalan_c->EditCustomAttributes = "";
        $this->berjalan_c->EditValue = $this->berjalan_c->options(false);
        $this->berjalan_c->PlaceHolder = RemoveHtml($this->berjalan_c->caption());

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
        $this->ket_lapor->EditValue = $this->ket_lapor->CurrentValue;
        $this->ket_lapor->PlaceHolder = RemoveHtml($this->ket_lapor->caption());

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
        $this->total_hasil->EditValue = $this->total_hasil->CurrentValue;
        $this->total_hasil->PlaceHolder = RemoveHtml($this->total_hasil->caption());

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
        $this->ket_provokes->EditValue = $this->ket_provokes->CurrentValue;
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
        $this->ket_quality->EditValue = $this->ket_quality->CurrentValue;
        $this->ket_quality->PlaceHolder = RemoveHtml($this->ket_quality->caption());

        // lokasi
        $this->lokasi->EditAttrs["class"] = "form-control";
        $this->lokasi->EditCustomAttributes = "";
        if (!$this->lokasi->Raw) {
            $this->lokasi->CurrentValue = HtmlDecode($this->lokasi->CurrentValue);
        }
        $this->lokasi->EditValue = $this->lokasi->CurrentValue;
        $this->lokasi->PlaceHolder = RemoveHtml($this->lokasi->caption());

        // menyebar
        $this->menyebar->EditCustomAttributes = "";
        $this->menyebar->EditValue = $this->menyebar->options(false);
        $this->menyebar->PlaceHolder = RemoveHtml($this->menyebar->caption());

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
        $this->durasi->EditValue = $this->durasi->CurrentValue;
        $this->durasi->PlaceHolder = RemoveHtml($this->durasi->caption());

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
        $this->ket_nyeri->EditValue = $this->ket_nyeri->CurrentValue;
        $this->ket_nyeri->PlaceHolder = RemoveHtml($this->ket_nyeri->caption());

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
        $this->ket_dokter->EditValue = $this->ket_dokter->CurrentValue;
        $this->ket_dokter->PlaceHolder = RemoveHtml($this->ket_dokter->caption());

        // rencana
        $this->rencana->EditAttrs["class"] = "form-control";
        $this->rencana->EditCustomAttributes = "";
        if (!$this->rencana->Raw) {
            $this->rencana->CurrentValue = HtmlDecode($this->rencana->CurrentValue);
        }
        $this->rencana->EditValue = $this->rencana->CurrentValue;
        $this->rencana->PlaceHolder = RemoveHtml($this->rencana->caption());

        // nip
        $this->nip->EditAttrs["class"] = "form-control";
        $this->nip->EditCustomAttributes = "";
        if (!$this->nip->Raw) {
            $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
        }
        $this->nip->EditValue = $this->nip->CurrentValue;
        $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

        // id_penilaian_awal_keperawatan
        $this->id_penilaian_awal_keperawatan->EditAttrs["class"] = "form-control";
        $this->id_penilaian_awal_keperawatan->EditCustomAttributes = "";
        $this->id_penilaian_awal_keperawatan->EditValue = $this->id_penilaian_awal_keperawatan->CurrentValue;
        $this->id_penilaian_awal_keperawatan->ViewCustomAttributes = "";

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
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->informasi);
                    $doc->exportCaption($this->td);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->rr);
                    $doc->exportCaption($this->suhu);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->bb);
                    $doc->exportCaption($this->tb);
                    $doc->exportCaption($this->bmi);
                    $doc->exportCaption($this->keluhan_utama);
                    $doc->exportCaption($this->rpd);
                    $doc->exportCaption($this->rpk);
                    $doc->exportCaption($this->rpo);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->alat_bantu);
                    $doc->exportCaption($this->ket_bantu);
                    $doc->exportCaption($this->prothesa);
                    $doc->exportCaption($this->ket_pro);
                    $doc->exportCaption($this->adl);
                    $doc->exportCaption($this->status_psiko);
                    $doc->exportCaption($this->ket_psiko);
                    $doc->exportCaption($this->hub_keluarga);
                    $doc->exportCaption($this->tinggal_dengan);
                    $doc->exportCaption($this->ket_tinggal);
                    $doc->exportCaption($this->ekonomi);
                    $doc->exportCaption($this->budaya);
                    $doc->exportCaption($this->ket_budaya);
                    $doc->exportCaption($this->edukasi);
                    $doc->exportCaption($this->ket_edukasi);
                    $doc->exportCaption($this->berjalan_a);
                    $doc->exportCaption($this->berjalan_b);
                    $doc->exportCaption($this->berjalan_c);
                    $doc->exportCaption($this->hasil);
                    $doc->exportCaption($this->lapor);
                    $doc->exportCaption($this->ket_lapor);
                    $doc->exportCaption($this->sg1);
                    $doc->exportCaption($this->nilai1);
                    $doc->exportCaption($this->sg2);
                    $doc->exportCaption($this->nilai2);
                    $doc->exportCaption($this->total_hasil);
                    $doc->exportCaption($this->nyeri);
                    $doc->exportCaption($this->provokes);
                    $doc->exportCaption($this->ket_provokes);
                    $doc->exportCaption($this->quality);
                    $doc->exportCaption($this->ket_quality);
                    $doc->exportCaption($this->lokasi);
                    $doc->exportCaption($this->menyebar);
                    $doc->exportCaption($this->skala_nyeri);
                    $doc->exportCaption($this->durasi);
                    $doc->exportCaption($this->nyeri_hilang);
                    $doc->exportCaption($this->ket_nyeri);
                    $doc->exportCaption($this->pada_dokter);
                    $doc->exportCaption($this->ket_dokter);
                    $doc->exportCaption($this->rencana);
                    $doc->exportCaption($this->nip);
                } else {
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->informasi);
                    $doc->exportCaption($this->td);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->rr);
                    $doc->exportCaption($this->suhu);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->bb);
                    $doc->exportCaption($this->tb);
                    $doc->exportCaption($this->bmi);
                    $doc->exportCaption($this->keluhan_utama);
                    $doc->exportCaption($this->rpd);
                    $doc->exportCaption($this->rpk);
                    $doc->exportCaption($this->rpo);
                    $doc->exportCaption($this->alergi);
                    $doc->exportCaption($this->alat_bantu);
                    $doc->exportCaption($this->ket_bantu);
                    $doc->exportCaption($this->prothesa);
                    $doc->exportCaption($this->ket_pro);
                    $doc->exportCaption($this->adl);
                    $doc->exportCaption($this->status_psiko);
                    $doc->exportCaption($this->ket_psiko);
                    $doc->exportCaption($this->hub_keluarga);
                    $doc->exportCaption($this->tinggal_dengan);
                    $doc->exportCaption($this->ket_tinggal);
                    $doc->exportCaption($this->ekonomi);
                    $doc->exportCaption($this->budaya);
                    $doc->exportCaption($this->ket_budaya);
                    $doc->exportCaption($this->edukasi);
                    $doc->exportCaption($this->ket_edukasi);
                    $doc->exportCaption($this->berjalan_a);
                    $doc->exportCaption($this->berjalan_b);
                    $doc->exportCaption($this->berjalan_c);
                    $doc->exportCaption($this->hasil);
                    $doc->exportCaption($this->lapor);
                    $doc->exportCaption($this->ket_lapor);
                    $doc->exportCaption($this->sg1);
                    $doc->exportCaption($this->nilai1);
                    $doc->exportCaption($this->sg2);
                    $doc->exportCaption($this->nilai2);
                    $doc->exportCaption($this->total_hasil);
                    $doc->exportCaption($this->nyeri);
                    $doc->exportCaption($this->provokes);
                    $doc->exportCaption($this->ket_provokes);
                    $doc->exportCaption($this->quality);
                    $doc->exportCaption($this->ket_quality);
                    $doc->exportCaption($this->lokasi);
                    $doc->exportCaption($this->menyebar);
                    $doc->exportCaption($this->skala_nyeri);
                    $doc->exportCaption($this->durasi);
                    $doc->exportCaption($this->nyeri_hilang);
                    $doc->exportCaption($this->ket_nyeri);
                    $doc->exportCaption($this->pada_dokter);
                    $doc->exportCaption($this->ket_dokter);
                    $doc->exportCaption($this->rencana);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->id_penilaian_awal_keperawatan);
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
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->informasi);
                        $doc->exportField($this->td);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->rr);
                        $doc->exportField($this->suhu);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->bb);
                        $doc->exportField($this->tb);
                        $doc->exportField($this->bmi);
                        $doc->exportField($this->keluhan_utama);
                        $doc->exportField($this->rpd);
                        $doc->exportField($this->rpk);
                        $doc->exportField($this->rpo);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->alat_bantu);
                        $doc->exportField($this->ket_bantu);
                        $doc->exportField($this->prothesa);
                        $doc->exportField($this->ket_pro);
                        $doc->exportField($this->adl);
                        $doc->exportField($this->status_psiko);
                        $doc->exportField($this->ket_psiko);
                        $doc->exportField($this->hub_keluarga);
                        $doc->exportField($this->tinggal_dengan);
                        $doc->exportField($this->ket_tinggal);
                        $doc->exportField($this->ekonomi);
                        $doc->exportField($this->budaya);
                        $doc->exportField($this->ket_budaya);
                        $doc->exportField($this->edukasi);
                        $doc->exportField($this->ket_edukasi);
                        $doc->exportField($this->berjalan_a);
                        $doc->exportField($this->berjalan_b);
                        $doc->exportField($this->berjalan_c);
                        $doc->exportField($this->hasil);
                        $doc->exportField($this->lapor);
                        $doc->exportField($this->ket_lapor);
                        $doc->exportField($this->sg1);
                        $doc->exportField($this->nilai1);
                        $doc->exportField($this->sg2);
                        $doc->exportField($this->nilai2);
                        $doc->exportField($this->total_hasil);
                        $doc->exportField($this->nyeri);
                        $doc->exportField($this->provokes);
                        $doc->exportField($this->ket_provokes);
                        $doc->exportField($this->quality);
                        $doc->exportField($this->ket_quality);
                        $doc->exportField($this->lokasi);
                        $doc->exportField($this->menyebar);
                        $doc->exportField($this->skala_nyeri);
                        $doc->exportField($this->durasi);
                        $doc->exportField($this->nyeri_hilang);
                        $doc->exportField($this->ket_nyeri);
                        $doc->exportField($this->pada_dokter);
                        $doc->exportField($this->ket_dokter);
                        $doc->exportField($this->rencana);
                        $doc->exportField($this->nip);
                    } else {
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->informasi);
                        $doc->exportField($this->td);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->rr);
                        $doc->exportField($this->suhu);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->bb);
                        $doc->exportField($this->tb);
                        $doc->exportField($this->bmi);
                        $doc->exportField($this->keluhan_utama);
                        $doc->exportField($this->rpd);
                        $doc->exportField($this->rpk);
                        $doc->exportField($this->rpo);
                        $doc->exportField($this->alergi);
                        $doc->exportField($this->alat_bantu);
                        $doc->exportField($this->ket_bantu);
                        $doc->exportField($this->prothesa);
                        $doc->exportField($this->ket_pro);
                        $doc->exportField($this->adl);
                        $doc->exportField($this->status_psiko);
                        $doc->exportField($this->ket_psiko);
                        $doc->exportField($this->hub_keluarga);
                        $doc->exportField($this->tinggal_dengan);
                        $doc->exportField($this->ket_tinggal);
                        $doc->exportField($this->ekonomi);
                        $doc->exportField($this->budaya);
                        $doc->exportField($this->ket_budaya);
                        $doc->exportField($this->edukasi);
                        $doc->exportField($this->ket_edukasi);
                        $doc->exportField($this->berjalan_a);
                        $doc->exportField($this->berjalan_b);
                        $doc->exportField($this->berjalan_c);
                        $doc->exportField($this->hasil);
                        $doc->exportField($this->lapor);
                        $doc->exportField($this->ket_lapor);
                        $doc->exportField($this->sg1);
                        $doc->exportField($this->nilai1);
                        $doc->exportField($this->sg2);
                        $doc->exportField($this->nilai2);
                        $doc->exportField($this->total_hasil);
                        $doc->exportField($this->nyeri);
                        $doc->exportField($this->provokes);
                        $doc->exportField($this->ket_provokes);
                        $doc->exportField($this->quality);
                        $doc->exportField($this->ket_quality);
                        $doc->exportField($this->lokasi);
                        $doc->exportField($this->menyebar);
                        $doc->exportField($this->skala_nyeri);
                        $doc->exportField($this->durasi);
                        $doc->exportField($this->nyeri_hilang);
                        $doc->exportField($this->ket_nyeri);
                        $doc->exportField($this->pada_dokter);
                        $doc->exportField($this->ket_dokter);
                        $doc->exportField($this->rencana);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->id_penilaian_awal_keperawatan);
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
