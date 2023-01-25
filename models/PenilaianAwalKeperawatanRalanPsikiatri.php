<?php

namespace PHPMaker2021\project4sikdec;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for penilaian_awal_keperawatan_ralan_psikiatri
 */
class PenilaianAwalKeperawatanRalanPsikiatri extends DbTable
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
    public $id_penilaian_awal_keperawatan_ralan_psikiatri;
    public $no_rawat;
    public $tanggal;
    public $informasi;
    public $keluhan_utama;
    public $rkd_sakit_sejak;
    public $rkd_keluhan;
    public $rkd_berobat;
    public $rkd_hasil_pengobatan;
    public $fp_putus_obat;
    public $ket_putus_obat;
    public $fp_ekonomi;
    public $ket_masalah_ekonomi;
    public $fp_masalah_fisik;
    public $ket_masalah_fisik;
    public $fp_masalah_psikososial;
    public $ket_masalah_psikososial;
    public $rh_keluarga;
    public $ket_rh_keluarga;
    public $resiko_bunuh_diri;
    public $rbd_ide;
    public $ket_rbd_ide;
    public $rbd_rencana;
    public $ket_rbd_rencana;
    public $rbd_alat;
    public $ket_rbd_alat;
    public $rbd_percobaan;
    public $ket_rbd_percobaan;
    public $rbd_keinginan;
    public $ket_rbd_keinginan;
    public $rpo_penggunaan;
    public $ket_rpo_penggunaan;
    public $rpo_efek_samping;
    public $ket_rpo_efek_samping;
    public $rpo_napza;
    public $ket_rpo_napza;
    public $ket_lama_pemakaian;
    public $ket_cara_pemakaian;
    public $ket_latar_belakang_pemakaian;
    public $rpo_penggunaan_obat_lainnya;
    public $ket_penggunaan_obat_lainnya;
    public $ket_alasan_penggunaan;
    public $rpo_alergi_obat;
    public $ket_alergi_obat;
    public $rpo_merokok;
    public $ket_merokok;
    public $rpo_minum_kopi;
    public $ket_minum_kopi;
    public $td;
    public $nadi;
    public $gcs;
    public $rr;
    public $suhu;
    public $pf_keluhan_fisik;
    public $ket_keluhan_fisik;
    public $skala_nyeri;
    public $durasi;
    public $nyeri;
    public $provokes;
    public $ket_provokes;
    public $quality;
    public $ket_quality;
    public $lokasi;
    public $menyebar;
    public $pada_dokter;
    public $ket_dokter;
    public $nyeri_hilang;
    public $ket_nyeri;
    public $bb;
    public $tb;
    public $bmi;
    public $lapor_status_nutrisi;
    public $ket_lapor_status_nutrisi;
    public $sg1;
    public $nilai1;
    public $sg2;
    public $nilai2;
    public $total_hasil;
    public $resikojatuh;
    public $bjm;
    public $msa;
    public $hasil;
    public $lapor;
    public $ket_lapor;
    public $adl_mandi;
    public $adl_berpakaian;
    public $adl_makan;
    public $adl_bak;
    public $adl_bab;
    public $adl_hobi;
    public $ket_adl_hobi;
    public $adl_sosialisasi;
    public $ket_adl_sosialisasi;
    public $adl_kegiatan;
    public $ket_adl_kegiatan;
    public $sk_penampilan;
    public $sk_alam_perasaan;
    public $sk_pembicaraan;
    public $sk_afek;
    public $sk_aktifitas_motorik;
    public $sk_gangguan_ringan;
    public $sk_proses_pikir;
    public $sk_orientasi;
    public $sk_tingkat_kesadaran_orientasi;
    public $sk_memori;
    public $sk_interaksi;
    public $sk_konsentrasi;
    public $sk_persepsi;
    public $ket_sk_persepsi;
    public $sk_isi_pikir;
    public $sk_waham;
    public $ket_sk_waham;
    public $sk_daya_tilik_diri;
    public $ket_sk_daya_tilik_diri;
    public $kk_pembelajaran;
    public $ket_kk_pembelajaran;
    public $ket_kk_pembelajaran_lainnya;
    public $kk_Penerjamah;
    public $ket_kk_penerjamah_Lainnya;
    public $kk_bahasa_isyarat;
    public $kk_kebutuhan_edukasi;
    public $ket_kk_kebutuhan_edukasi;
    public $rencana;
    public $nip;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'penilaian_awal_keperawatan_ralan_psikiatri';
        $this->TableName = 'penilaian_awal_keperawatan_ralan_psikiatri';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`penilaian_awal_keperawatan_ralan_psikiatri`";
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

        // id_penilaian_awal_keperawatan_ralan_psikiatri
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_id_penilaian_awal_keperawatan_ralan_psikiatri', 'id_penilaian_awal_keperawatan_ralan_psikiatri', '`id_penilaian_awal_keperawatan_ralan_psikiatri`', '`id_penilaian_awal_keperawatan_ralan_psikiatri`', 3, 6, -1, false, '`id_penilaian_awal_keperawatan_ralan_psikiatri`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->IsAutoIncrement = true; // Autoincrement field
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->IsPrimaryKey = true; // Primary key field
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->Sortable = true; // Allow sort
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_penilaian_awal_keperawatan_ralan_psikiatri->Param, "CustomMsg");
        $this->Fields['id_penilaian_awal_keperawatan_ralan_psikiatri'] = &$this->id_penilaian_awal_keperawatan_ralan_psikiatri;

        // no_rawat
        $this->no_rawat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_no_rawat', 'no_rawat', '`no_rawat`', '`no_rawat`', 200, 17, -1, false, '`no_rawat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->IsForeignKey = true; // Foreign key field
        $this->no_rawat->Nullable = false; // NOT NULL field
        $this->no_rawat->Required = true; // Required field
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // tanggal
        $this->tanggal = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 135, 19, 0, false, '`tanggal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal->Nullable = false; // NOT NULL field
        $this->tanggal->Required = true; // Required field
        $this->tanggal->Sortable = true; // Allow sort
        $this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal->Param, "CustomMsg");
        $this->Fields['tanggal'] = &$this->tanggal;

        // informasi
        $this->informasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_informasi', 'informasi', '`informasi`', '`informasi`', 202, 13, -1, false, '`informasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->informasi->Nullable = false; // NOT NULL field
        $this->informasi->Required = true; // Required field
        $this->informasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->informasi->Lookup = new Lookup('informasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->informasi->Lookup = new Lookup('informasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->informasi->OptionCount = 2;
        $this->informasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->informasi->Param, "CustomMsg");
        $this->Fields['informasi'] = &$this->informasi;

        // keluhan_utama
        $this->keluhan_utama = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_keluhan_utama', 'keluhan_utama', '`keluhan_utama`', '`keluhan_utama`', 201, 500, -1, false, '`keluhan_utama`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->keluhan_utama->Nullable = false; // NOT NULL field
        $this->keluhan_utama->Required = true; // Required field
        $this->keluhan_utama->Sortable = true; // Allow sort
        $this->keluhan_utama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keluhan_utama->Param, "CustomMsg");
        $this->Fields['keluhan_utama'] = &$this->keluhan_utama;

        // rkd_sakit_sejak
        $this->rkd_sakit_sejak = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rkd_sakit_sejak', 'rkd_sakit_sejak', '`rkd_sakit_sejak`', '`rkd_sakit_sejak`', 200, 8, -1, false, '`rkd_sakit_sejak`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rkd_sakit_sejak->Nullable = false; // NOT NULL field
        $this->rkd_sakit_sejak->Required = true; // Required field
        $this->rkd_sakit_sejak->Sortable = true; // Allow sort
        $this->rkd_sakit_sejak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rkd_sakit_sejak->Param, "CustomMsg");
        $this->Fields['rkd_sakit_sejak'] = &$this->rkd_sakit_sejak;

        // rkd_keluhan
        $this->rkd_keluhan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rkd_keluhan', 'rkd_keluhan', '`rkd_keluhan`', '`rkd_keluhan`', 201, 500, -1, false, '`rkd_keluhan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->rkd_keluhan->Nullable = false; // NOT NULL field
        $this->rkd_keluhan->Required = true; // Required field
        $this->rkd_keluhan->Sortable = true; // Allow sort
        $this->rkd_keluhan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rkd_keluhan->Param, "CustomMsg");
        $this->Fields['rkd_keluhan'] = &$this->rkd_keluhan;

        // rkd_berobat
        $this->rkd_berobat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rkd_berobat', 'rkd_berobat', '`rkd_berobat`', '`rkd_berobat`', 202, 14, -1, false, '`rkd_berobat`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rkd_berobat->Nullable = false; // NOT NULL field
        $this->rkd_berobat->Required = true; // Required field
        $this->rkd_berobat->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rkd_berobat->Lookup = new Lookup('rkd_berobat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rkd_berobat->Lookup = new Lookup('rkd_berobat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rkd_berobat->OptionCount = 4;
        $this->rkd_berobat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rkd_berobat->Param, "CustomMsg");
        $this->Fields['rkd_berobat'] = &$this->rkd_berobat;

        // rkd_hasil_pengobatan
        $this->rkd_hasil_pengobatan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rkd_hasil_pengobatan', 'rkd_hasil_pengobatan', '`rkd_hasil_pengobatan`', '`rkd_hasil_pengobatan`', 202, 14, -1, false, '`rkd_hasil_pengobatan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rkd_hasil_pengobatan->Nullable = false; // NOT NULL field
        $this->rkd_hasil_pengobatan->Required = true; // Required field
        $this->rkd_hasil_pengobatan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rkd_hasil_pengobatan->Lookup = new Lookup('rkd_hasil_pengobatan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rkd_hasil_pengobatan->Lookup = new Lookup('rkd_hasil_pengobatan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rkd_hasil_pengobatan->OptionCount = 2;
        $this->rkd_hasil_pengobatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rkd_hasil_pengobatan->Param, "CustomMsg");
        $this->Fields['rkd_hasil_pengobatan'] = &$this->rkd_hasil_pengobatan;

        // fp_putus_obat
        $this->fp_putus_obat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_fp_putus_obat', 'fp_putus_obat', '`fp_putus_obat`', '`fp_putus_obat`', 202, 5, -1, false, '`fp_putus_obat`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->fp_putus_obat->Nullable = false; // NOT NULL field
        $this->fp_putus_obat->Required = true; // Required field
        $this->fp_putus_obat->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->fp_putus_obat->Lookup = new Lookup('fp_putus_obat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->fp_putus_obat->Lookup = new Lookup('fp_putus_obat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->fp_putus_obat->OptionCount = 2;
        $this->fp_putus_obat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fp_putus_obat->Param, "CustomMsg");
        $this->Fields['fp_putus_obat'] = &$this->fp_putus_obat;

        // ket_putus_obat
        $this->ket_putus_obat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_putus_obat', 'ket_putus_obat', '`ket_putus_obat`', '`ket_putus_obat`', 200, 50, -1, false, '`ket_putus_obat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_putus_obat->Nullable = false; // NOT NULL field
        $this->ket_putus_obat->Required = true; // Required field
        $this->ket_putus_obat->Sortable = true; // Allow sort
        $this->ket_putus_obat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_putus_obat->Param, "CustomMsg");
        $this->Fields['ket_putus_obat'] = &$this->ket_putus_obat;

        // fp_ekonomi
        $this->fp_ekonomi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_fp_ekonomi', 'fp_ekonomi', '`fp_ekonomi`', '`fp_ekonomi`', 202, 5, -1, false, '`fp_ekonomi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->fp_ekonomi->Nullable = false; // NOT NULL field
        $this->fp_ekonomi->Required = true; // Required field
        $this->fp_ekonomi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->fp_ekonomi->Lookup = new Lookup('fp_ekonomi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->fp_ekonomi->Lookup = new Lookup('fp_ekonomi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->fp_ekonomi->OptionCount = 2;
        $this->fp_ekonomi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fp_ekonomi->Param, "CustomMsg");
        $this->Fields['fp_ekonomi'] = &$this->fp_ekonomi;

        // ket_masalah_ekonomi
        $this->ket_masalah_ekonomi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_masalah_ekonomi', 'ket_masalah_ekonomi', '`ket_masalah_ekonomi`', '`ket_masalah_ekonomi`', 200, 50, -1, false, '`ket_masalah_ekonomi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_masalah_ekonomi->Nullable = false; // NOT NULL field
        $this->ket_masalah_ekonomi->Required = true; // Required field
        $this->ket_masalah_ekonomi->Sortable = true; // Allow sort
        $this->ket_masalah_ekonomi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_masalah_ekonomi->Param, "CustomMsg");
        $this->Fields['ket_masalah_ekonomi'] = &$this->ket_masalah_ekonomi;

        // fp_masalah_fisik
        $this->fp_masalah_fisik = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_fp_masalah_fisik', 'fp_masalah_fisik', '`fp_masalah_fisik`', '`fp_masalah_fisik`', 202, 5, -1, false, '`fp_masalah_fisik`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->fp_masalah_fisik->Nullable = false; // NOT NULL field
        $this->fp_masalah_fisik->Required = true; // Required field
        $this->fp_masalah_fisik->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->fp_masalah_fisik->Lookup = new Lookup('fp_masalah_fisik', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->fp_masalah_fisik->Lookup = new Lookup('fp_masalah_fisik', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->fp_masalah_fisik->OptionCount = 2;
        $this->fp_masalah_fisik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fp_masalah_fisik->Param, "CustomMsg");
        $this->Fields['fp_masalah_fisik'] = &$this->fp_masalah_fisik;

        // ket_masalah_fisik
        $this->ket_masalah_fisik = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_masalah_fisik', 'ket_masalah_fisik', '`ket_masalah_fisik`', '`ket_masalah_fisik`', 200, 50, -1, false, '`ket_masalah_fisik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_masalah_fisik->Nullable = false; // NOT NULL field
        $this->ket_masalah_fisik->Required = true; // Required field
        $this->ket_masalah_fisik->Sortable = true; // Allow sort
        $this->ket_masalah_fisik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_masalah_fisik->Param, "CustomMsg");
        $this->Fields['ket_masalah_fisik'] = &$this->ket_masalah_fisik;

        // fp_masalah_psikososial
        $this->fp_masalah_psikososial = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_fp_masalah_psikososial', 'fp_masalah_psikososial', '`fp_masalah_psikososial`', '`fp_masalah_psikososial`', 202, 5, -1, false, '`fp_masalah_psikososial`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->fp_masalah_psikososial->Nullable = false; // NOT NULL field
        $this->fp_masalah_psikososial->Required = true; // Required field
        $this->fp_masalah_psikososial->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->fp_masalah_psikososial->Lookup = new Lookup('fp_masalah_psikososial', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->fp_masalah_psikososial->Lookup = new Lookup('fp_masalah_psikososial', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->fp_masalah_psikososial->OptionCount = 2;
        $this->fp_masalah_psikososial->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fp_masalah_psikososial->Param, "CustomMsg");
        $this->Fields['fp_masalah_psikososial'] = &$this->fp_masalah_psikososial;

        // ket_masalah_psikososial
        $this->ket_masalah_psikososial = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_masalah_psikososial', 'ket_masalah_psikososial', '`ket_masalah_psikososial`', '`ket_masalah_psikososial`', 200, 50, -1, false, '`ket_masalah_psikososial`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_masalah_psikososial->Nullable = false; // NOT NULL field
        $this->ket_masalah_psikososial->Required = true; // Required field
        $this->ket_masalah_psikososial->Sortable = true; // Allow sort
        $this->ket_masalah_psikososial->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_masalah_psikososial->Param, "CustomMsg");
        $this->Fields['ket_masalah_psikososial'] = &$this->ket_masalah_psikososial;

        // rh_keluarga
        $this->rh_keluarga = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rh_keluarga', 'rh_keluarga', '`rh_keluarga`', '`rh_keluarga`', 202, 5, -1, false, '`rh_keluarga`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rh_keluarga->Nullable = false; // NOT NULL field
        $this->rh_keluarga->Required = true; // Required field
        $this->rh_keluarga->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rh_keluarga->Lookup = new Lookup('rh_keluarga', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rh_keluarga->Lookup = new Lookup('rh_keluarga', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rh_keluarga->OptionCount = 2;
        $this->rh_keluarga->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rh_keluarga->Param, "CustomMsg");
        $this->Fields['rh_keluarga'] = &$this->rh_keluarga;

        // ket_rh_keluarga
        $this->ket_rh_keluarga = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rh_keluarga', 'ket_rh_keluarga', '`ket_rh_keluarga`', '`ket_rh_keluarga`', 200, 50, -1, false, '`ket_rh_keluarga`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rh_keluarga->Nullable = false; // NOT NULL field
        $this->ket_rh_keluarga->Required = true; // Required field
        $this->ket_rh_keluarga->Sortable = true; // Allow sort
        $this->ket_rh_keluarga->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rh_keluarga->Param, "CustomMsg");
        $this->Fields['ket_rh_keluarga'] = &$this->ket_rh_keluarga;

        // resiko_bunuh_diri
        $this->resiko_bunuh_diri = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_resiko_bunuh_diri', 'resiko_bunuh_diri', '`resiko_bunuh_diri`', '`resiko_bunuh_diri`', 202, 5, -1, false, '`resiko_bunuh_diri`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->resiko_bunuh_diri->Nullable = false; // NOT NULL field
        $this->resiko_bunuh_diri->Required = true; // Required field
        $this->resiko_bunuh_diri->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->resiko_bunuh_diri->Lookup = new Lookup('resiko_bunuh_diri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->resiko_bunuh_diri->Lookup = new Lookup('resiko_bunuh_diri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->resiko_bunuh_diri->OptionCount = 2;
        $this->resiko_bunuh_diri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->resiko_bunuh_diri->Param, "CustomMsg");
        $this->Fields['resiko_bunuh_diri'] = &$this->resiko_bunuh_diri;

        // rbd_ide
        $this->rbd_ide = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rbd_ide', 'rbd_ide', '`rbd_ide`', '`rbd_ide`', 202, 5, -1, false, '`rbd_ide`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rbd_ide->Nullable = false; // NOT NULL field
        $this->rbd_ide->Required = true; // Required field
        $this->rbd_ide->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rbd_ide->Lookup = new Lookup('rbd_ide', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rbd_ide->Lookup = new Lookup('rbd_ide', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rbd_ide->OptionCount = 2;
        $this->rbd_ide->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rbd_ide->Param, "CustomMsg");
        $this->Fields['rbd_ide'] = &$this->rbd_ide;

        // ket_rbd_ide
        $this->ket_rbd_ide = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rbd_ide', 'ket_rbd_ide', '`ket_rbd_ide`', '`ket_rbd_ide`', 200, 50, -1, false, '`ket_rbd_ide`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rbd_ide->Nullable = false; // NOT NULL field
        $this->ket_rbd_ide->Required = true; // Required field
        $this->ket_rbd_ide->Sortable = true; // Allow sort
        $this->ket_rbd_ide->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rbd_ide->Param, "CustomMsg");
        $this->Fields['ket_rbd_ide'] = &$this->ket_rbd_ide;

        // rbd_rencana
        $this->rbd_rencana = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rbd_rencana', 'rbd_rencana', '`rbd_rencana`', '`rbd_rencana`', 202, 5, -1, false, '`rbd_rencana`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rbd_rencana->Nullable = false; // NOT NULL field
        $this->rbd_rencana->Required = true; // Required field
        $this->rbd_rencana->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rbd_rencana->Lookup = new Lookup('rbd_rencana', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rbd_rencana->Lookup = new Lookup('rbd_rencana', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rbd_rencana->OptionCount = 2;
        $this->rbd_rencana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rbd_rencana->Param, "CustomMsg");
        $this->Fields['rbd_rencana'] = &$this->rbd_rencana;

        // ket_rbd_rencana
        $this->ket_rbd_rencana = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rbd_rencana', 'ket_rbd_rencana', '`ket_rbd_rencana`', '`ket_rbd_rencana`', 200, 50, -1, false, '`ket_rbd_rencana`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rbd_rencana->Nullable = false; // NOT NULL field
        $this->ket_rbd_rencana->Required = true; // Required field
        $this->ket_rbd_rencana->Sortable = true; // Allow sort
        $this->ket_rbd_rencana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rbd_rencana->Param, "CustomMsg");
        $this->Fields['ket_rbd_rencana'] = &$this->ket_rbd_rencana;

        // rbd_alat
        $this->rbd_alat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rbd_alat', 'rbd_alat', '`rbd_alat`', '`rbd_alat`', 202, 5, -1, false, '`rbd_alat`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rbd_alat->Nullable = false; // NOT NULL field
        $this->rbd_alat->Required = true; // Required field
        $this->rbd_alat->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rbd_alat->Lookup = new Lookup('rbd_alat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rbd_alat->Lookup = new Lookup('rbd_alat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rbd_alat->OptionCount = 2;
        $this->rbd_alat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rbd_alat->Param, "CustomMsg");
        $this->Fields['rbd_alat'] = &$this->rbd_alat;

        // ket_rbd_alat
        $this->ket_rbd_alat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rbd_alat', 'ket_rbd_alat', '`ket_rbd_alat`', '`ket_rbd_alat`', 200, 50, -1, false, '`ket_rbd_alat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rbd_alat->Nullable = false; // NOT NULL field
        $this->ket_rbd_alat->Required = true; // Required field
        $this->ket_rbd_alat->Sortable = true; // Allow sort
        $this->ket_rbd_alat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rbd_alat->Param, "CustomMsg");
        $this->Fields['ket_rbd_alat'] = &$this->ket_rbd_alat;

        // rbd_percobaan
        $this->rbd_percobaan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rbd_percobaan', 'rbd_percobaan', '`rbd_percobaan`', '`rbd_percobaan`', 202, 5, -1, false, '`rbd_percobaan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rbd_percobaan->Nullable = false; // NOT NULL field
        $this->rbd_percobaan->Required = true; // Required field
        $this->rbd_percobaan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rbd_percobaan->Lookup = new Lookup('rbd_percobaan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rbd_percobaan->Lookup = new Lookup('rbd_percobaan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rbd_percobaan->OptionCount = 2;
        $this->rbd_percobaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rbd_percobaan->Param, "CustomMsg");
        $this->Fields['rbd_percobaan'] = &$this->rbd_percobaan;

        // ket_rbd_percobaan
        $this->ket_rbd_percobaan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rbd_percobaan', 'ket_rbd_percobaan', '`ket_rbd_percobaan`', '`ket_rbd_percobaan`', 200, 15, -1, false, '`ket_rbd_percobaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rbd_percobaan->Nullable = false; // NOT NULL field
        $this->ket_rbd_percobaan->Required = true; // Required field
        $this->ket_rbd_percobaan->Sortable = true; // Allow sort
        $this->ket_rbd_percobaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rbd_percobaan->Param, "CustomMsg");
        $this->Fields['ket_rbd_percobaan'] = &$this->ket_rbd_percobaan;

        // rbd_keinginan
        $this->rbd_keinginan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rbd_keinginan', 'rbd_keinginan', '`rbd_keinginan`', '`rbd_keinginan`', 202, 5, -1, false, '`rbd_keinginan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rbd_keinginan->Nullable = false; // NOT NULL field
        $this->rbd_keinginan->Required = true; // Required field
        $this->rbd_keinginan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rbd_keinginan->Lookup = new Lookup('rbd_keinginan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rbd_keinginan->Lookup = new Lookup('rbd_keinginan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rbd_keinginan->OptionCount = 2;
        $this->rbd_keinginan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rbd_keinginan->Param, "CustomMsg");
        $this->Fields['rbd_keinginan'] = &$this->rbd_keinginan;

        // ket_rbd_keinginan
        $this->ket_rbd_keinginan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rbd_keinginan', 'ket_rbd_keinginan', '`ket_rbd_keinginan`', '`ket_rbd_keinginan`', 200, 100, -1, false, '`ket_rbd_keinginan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rbd_keinginan->Nullable = false; // NOT NULL field
        $this->ket_rbd_keinginan->Required = true; // Required field
        $this->ket_rbd_keinginan->Sortable = true; // Allow sort
        $this->ket_rbd_keinginan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rbd_keinginan->Param, "CustomMsg");
        $this->Fields['ket_rbd_keinginan'] = &$this->ket_rbd_keinginan;

        // rpo_penggunaan
        $this->rpo_penggunaan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rpo_penggunaan', 'rpo_penggunaan', '`rpo_penggunaan`', '`rpo_penggunaan`', 202, 5, -1, false, '`rpo_penggunaan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rpo_penggunaan->Nullable = false; // NOT NULL field
        $this->rpo_penggunaan->Required = true; // Required field
        $this->rpo_penggunaan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rpo_penggunaan->Lookup = new Lookup('rpo_penggunaan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rpo_penggunaan->Lookup = new Lookup('rpo_penggunaan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rpo_penggunaan->OptionCount = 2;
        $this->rpo_penggunaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo_penggunaan->Param, "CustomMsg");
        $this->Fields['rpo_penggunaan'] = &$this->rpo_penggunaan;

        // ket_rpo_penggunaan
        $this->ket_rpo_penggunaan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rpo_penggunaan', 'ket_rpo_penggunaan', '`ket_rpo_penggunaan`', '`ket_rpo_penggunaan`', 200, 20, -1, false, '`ket_rpo_penggunaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rpo_penggunaan->Nullable = false; // NOT NULL field
        $this->ket_rpo_penggunaan->Required = true; // Required field
        $this->ket_rpo_penggunaan->Sortable = true; // Allow sort
        $this->ket_rpo_penggunaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rpo_penggunaan->Param, "CustomMsg");
        $this->Fields['ket_rpo_penggunaan'] = &$this->ket_rpo_penggunaan;

        // rpo_efek_samping
        $this->rpo_efek_samping = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rpo_efek_samping', 'rpo_efek_samping', '`rpo_efek_samping`', '`rpo_efek_samping`', 202, 5, -1, false, '`rpo_efek_samping`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rpo_efek_samping->Nullable = false; // NOT NULL field
        $this->rpo_efek_samping->Required = true; // Required field
        $this->rpo_efek_samping->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rpo_efek_samping->Lookup = new Lookup('rpo_efek_samping', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rpo_efek_samping->Lookup = new Lookup('rpo_efek_samping', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rpo_efek_samping->OptionCount = 2;
        $this->rpo_efek_samping->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo_efek_samping->Param, "CustomMsg");
        $this->Fields['rpo_efek_samping'] = &$this->rpo_efek_samping;

        // ket_rpo_efek_samping
        $this->ket_rpo_efek_samping = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rpo_efek_samping', 'ket_rpo_efek_samping', '`ket_rpo_efek_samping`', '`ket_rpo_efek_samping`', 200, 20, -1, false, '`ket_rpo_efek_samping`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rpo_efek_samping->Nullable = false; // NOT NULL field
        $this->ket_rpo_efek_samping->Required = true; // Required field
        $this->ket_rpo_efek_samping->Sortable = true; // Allow sort
        $this->ket_rpo_efek_samping->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rpo_efek_samping->Param, "CustomMsg");
        $this->Fields['ket_rpo_efek_samping'] = &$this->ket_rpo_efek_samping;

        // rpo_napza
        $this->rpo_napza = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rpo_napza', 'rpo_napza', '`rpo_napza`', '`rpo_napza`', 202, 5, -1, false, '`rpo_napza`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rpo_napza->Nullable = false; // NOT NULL field
        $this->rpo_napza->Required = true; // Required field
        $this->rpo_napza->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rpo_napza->Lookup = new Lookup('rpo_napza', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rpo_napza->Lookup = new Lookup('rpo_napza', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rpo_napza->OptionCount = 2;
        $this->rpo_napza->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo_napza->Param, "CustomMsg");
        $this->Fields['rpo_napza'] = &$this->rpo_napza;

        // ket_rpo_napza
        $this->ket_rpo_napza = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_rpo_napza', 'ket_rpo_napza', '`ket_rpo_napza`', '`ket_rpo_napza`', 200, 25, -1, false, '`ket_rpo_napza`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_rpo_napza->Nullable = false; // NOT NULL field
        $this->ket_rpo_napza->Required = true; // Required field
        $this->ket_rpo_napza->Sortable = true; // Allow sort
        $this->ket_rpo_napza->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_rpo_napza->Param, "CustomMsg");
        $this->Fields['ket_rpo_napza'] = &$this->ket_rpo_napza;

        // ket_lama_pemakaian
        $this->ket_lama_pemakaian = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_lama_pemakaian', 'ket_lama_pemakaian', '`ket_lama_pemakaian`', '`ket_lama_pemakaian`', 200, 8, -1, false, '`ket_lama_pemakaian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_lama_pemakaian->Nullable = false; // NOT NULL field
        $this->ket_lama_pemakaian->Required = true; // Required field
        $this->ket_lama_pemakaian->Sortable = true; // Allow sort
        $this->ket_lama_pemakaian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_lama_pemakaian->Param, "CustomMsg");
        $this->Fields['ket_lama_pemakaian'] = &$this->ket_lama_pemakaian;

        // ket_cara_pemakaian
        $this->ket_cara_pemakaian = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_cara_pemakaian', 'ket_cara_pemakaian', '`ket_cara_pemakaian`', '`ket_cara_pemakaian`', 200, 15, -1, false, '`ket_cara_pemakaian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_cara_pemakaian->Nullable = false; // NOT NULL field
        $this->ket_cara_pemakaian->Required = true; // Required field
        $this->ket_cara_pemakaian->Sortable = true; // Allow sort
        $this->ket_cara_pemakaian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_cara_pemakaian->Param, "CustomMsg");
        $this->Fields['ket_cara_pemakaian'] = &$this->ket_cara_pemakaian;

        // ket_latar_belakang_pemakaian
        $this->ket_latar_belakang_pemakaian = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_latar_belakang_pemakaian', 'ket_latar_belakang_pemakaian', '`ket_latar_belakang_pemakaian`', '`ket_latar_belakang_pemakaian`', 200, 60, -1, false, '`ket_latar_belakang_pemakaian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_latar_belakang_pemakaian->Nullable = false; // NOT NULL field
        $this->ket_latar_belakang_pemakaian->Required = true; // Required field
        $this->ket_latar_belakang_pemakaian->Sortable = true; // Allow sort
        $this->ket_latar_belakang_pemakaian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_latar_belakang_pemakaian->Param, "CustomMsg");
        $this->Fields['ket_latar_belakang_pemakaian'] = &$this->ket_latar_belakang_pemakaian;

        // rpo_penggunaan_obat_lainnya
        $this->rpo_penggunaan_obat_lainnya = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rpo_penggunaan_obat_lainnya', 'rpo_penggunaan_obat_lainnya', '`rpo_penggunaan_obat_lainnya`', '`rpo_penggunaan_obat_lainnya`', 202, 5, -1, false, '`rpo_penggunaan_obat_lainnya`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rpo_penggunaan_obat_lainnya->Nullable = false; // NOT NULL field
        $this->rpo_penggunaan_obat_lainnya->Required = true; // Required field
        $this->rpo_penggunaan_obat_lainnya->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rpo_penggunaan_obat_lainnya->Lookup = new Lookup('rpo_penggunaan_obat_lainnya', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rpo_penggunaan_obat_lainnya->Lookup = new Lookup('rpo_penggunaan_obat_lainnya', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rpo_penggunaan_obat_lainnya->OptionCount = 2;
        $this->rpo_penggunaan_obat_lainnya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo_penggunaan_obat_lainnya->Param, "CustomMsg");
        $this->Fields['rpo_penggunaan_obat_lainnya'] = &$this->rpo_penggunaan_obat_lainnya;

        // ket_penggunaan_obat_lainnya
        $this->ket_penggunaan_obat_lainnya = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_penggunaan_obat_lainnya', 'ket_penggunaan_obat_lainnya', '`ket_penggunaan_obat_lainnya`', '`ket_penggunaan_obat_lainnya`', 200, 20, -1, false, '`ket_penggunaan_obat_lainnya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_penggunaan_obat_lainnya->Nullable = false; // NOT NULL field
        $this->ket_penggunaan_obat_lainnya->Required = true; // Required field
        $this->ket_penggunaan_obat_lainnya->Sortable = true; // Allow sort
        $this->ket_penggunaan_obat_lainnya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_penggunaan_obat_lainnya->Param, "CustomMsg");
        $this->Fields['ket_penggunaan_obat_lainnya'] = &$this->ket_penggunaan_obat_lainnya;

        // ket_alasan_penggunaan
        $this->ket_alasan_penggunaan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_alasan_penggunaan', 'ket_alasan_penggunaan', '`ket_alasan_penggunaan`', '`ket_alasan_penggunaan`', 200, 65, -1, false, '`ket_alasan_penggunaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_alasan_penggunaan->Nullable = false; // NOT NULL field
        $this->ket_alasan_penggunaan->Required = true; // Required field
        $this->ket_alasan_penggunaan->Sortable = true; // Allow sort
        $this->ket_alasan_penggunaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_alasan_penggunaan->Param, "CustomMsg");
        $this->Fields['ket_alasan_penggunaan'] = &$this->ket_alasan_penggunaan;

        // rpo_alergi_obat
        $this->rpo_alergi_obat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rpo_alergi_obat', 'rpo_alergi_obat', '`rpo_alergi_obat`', '`rpo_alergi_obat`', 202, 5, -1, false, '`rpo_alergi_obat`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rpo_alergi_obat->Nullable = false; // NOT NULL field
        $this->rpo_alergi_obat->Required = true; // Required field
        $this->rpo_alergi_obat->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rpo_alergi_obat->Lookup = new Lookup('rpo_alergi_obat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rpo_alergi_obat->Lookup = new Lookup('rpo_alergi_obat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rpo_alergi_obat->OptionCount = 2;
        $this->rpo_alergi_obat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo_alergi_obat->Param, "CustomMsg");
        $this->Fields['rpo_alergi_obat'] = &$this->rpo_alergi_obat;

        // ket_alergi_obat
        $this->ket_alergi_obat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_alergi_obat', 'ket_alergi_obat', '`ket_alergi_obat`', '`ket_alergi_obat`', 200, 25, -1, false, '`ket_alergi_obat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_alergi_obat->Nullable = false; // NOT NULL field
        $this->ket_alergi_obat->Required = true; // Required field
        $this->ket_alergi_obat->Sortable = true; // Allow sort
        $this->ket_alergi_obat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_alergi_obat->Param, "CustomMsg");
        $this->Fields['ket_alergi_obat'] = &$this->ket_alergi_obat;

        // rpo_merokok
        $this->rpo_merokok = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rpo_merokok', 'rpo_merokok', '`rpo_merokok`', '`rpo_merokok`', 202, 5, -1, false, '`rpo_merokok`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rpo_merokok->Nullable = false; // NOT NULL field
        $this->rpo_merokok->Required = true; // Required field
        $this->rpo_merokok->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rpo_merokok->Lookup = new Lookup('rpo_merokok', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rpo_merokok->Lookup = new Lookup('rpo_merokok', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rpo_merokok->OptionCount = 2;
        $this->rpo_merokok->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo_merokok->Param, "CustomMsg");
        $this->Fields['rpo_merokok'] = &$this->rpo_merokok;

        // ket_merokok
        $this->ket_merokok = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_merokok', 'ket_merokok', '`ket_merokok`', '`ket_merokok`', 200, 25, -1, false, '`ket_merokok`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_merokok->Nullable = false; // NOT NULL field
        $this->ket_merokok->Required = true; // Required field
        $this->ket_merokok->Sortable = true; // Allow sort
        $this->ket_merokok->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_merokok->Param, "CustomMsg");
        $this->Fields['ket_merokok'] = &$this->ket_merokok;

        // rpo_minum_kopi
        $this->rpo_minum_kopi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rpo_minum_kopi', 'rpo_minum_kopi', '`rpo_minum_kopi`', '`rpo_minum_kopi`', 202, 5, -1, false, '`rpo_minum_kopi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->rpo_minum_kopi->Nullable = false; // NOT NULL field
        $this->rpo_minum_kopi->Required = true; // Required field
        $this->rpo_minum_kopi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->rpo_minum_kopi->Lookup = new Lookup('rpo_minum_kopi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->rpo_minum_kopi->Lookup = new Lookup('rpo_minum_kopi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->rpo_minum_kopi->OptionCount = 2;
        $this->rpo_minum_kopi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rpo_minum_kopi->Param, "CustomMsg");
        $this->Fields['rpo_minum_kopi'] = &$this->rpo_minum_kopi;

        // ket_minum_kopi
        $this->ket_minum_kopi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_minum_kopi', 'ket_minum_kopi', '`ket_minum_kopi`', '`ket_minum_kopi`', 200, 25, -1, false, '`ket_minum_kopi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_minum_kopi->Nullable = false; // NOT NULL field
        $this->ket_minum_kopi->Required = true; // Required field
        $this->ket_minum_kopi->Sortable = true; // Allow sort
        $this->ket_minum_kopi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_minum_kopi->Param, "CustomMsg");
        $this->Fields['ket_minum_kopi'] = &$this->ket_minum_kopi;

        // td
        $this->td = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_td', 'td', '`td`', '`td`', 200, 8, -1, false, '`td`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->td->Nullable = false; // NOT NULL field
        $this->td->Required = true; // Required field
        $this->td->Sortable = true; // Allow sort
        $this->td->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->td->Param, "CustomMsg");
        $this->Fields['td'] = &$this->td;

        // nadi
        $this->nadi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_nadi', 'nadi', '`nadi`', '`nadi`', 200, 5, -1, false, '`nadi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nadi->Nullable = false; // NOT NULL field
        $this->nadi->Required = true; // Required field
        $this->nadi->Sortable = true; // Allow sort
        $this->nadi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nadi->Param, "CustomMsg");
        $this->Fields['nadi'] = &$this->nadi;

        // gcs
        $this->gcs = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_gcs', 'gcs', '`gcs`', '`gcs`', 200, 5, -1, false, '`gcs`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->gcs->Nullable = false; // NOT NULL field
        $this->gcs->Required = true; // Required field
        $this->gcs->Sortable = true; // Allow sort
        $this->gcs->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gcs->Param, "CustomMsg");
        $this->Fields['gcs'] = &$this->gcs;

        // rr
        $this->rr = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rr', 'rr', '`rr`', '`rr`', 200, 5, -1, false, '`rr`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rr->Nullable = false; // NOT NULL field
        $this->rr->Required = true; // Required field
        $this->rr->Sortable = true; // Allow sort
        $this->rr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rr->Param, "CustomMsg");
        $this->Fields['rr'] = &$this->rr;

        // suhu
        $this->suhu = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_suhu', 'suhu', '`suhu`', '`suhu`', 200, 5, -1, false, '`suhu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->suhu->Nullable = false; // NOT NULL field
        $this->suhu->Required = true; // Required field
        $this->suhu->Sortable = true; // Allow sort
        $this->suhu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->suhu->Param, "CustomMsg");
        $this->Fields['suhu'] = &$this->suhu;

        // pf_keluhan_fisik
        $this->pf_keluhan_fisik = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_pf_keluhan_fisik', 'pf_keluhan_fisik', '`pf_keluhan_fisik`', '`pf_keluhan_fisik`', 202, 5, -1, false, '`pf_keluhan_fisik`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->pf_keluhan_fisik->Nullable = false; // NOT NULL field
        $this->pf_keluhan_fisik->Required = true; // Required field
        $this->pf_keluhan_fisik->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->pf_keluhan_fisik->Lookup = new Lookup('pf_keluhan_fisik', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->pf_keluhan_fisik->Lookup = new Lookup('pf_keluhan_fisik', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->pf_keluhan_fisik->OptionCount = 2;
        $this->pf_keluhan_fisik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pf_keluhan_fisik->Param, "CustomMsg");
        $this->Fields['pf_keluhan_fisik'] = &$this->pf_keluhan_fisik;

        // ket_keluhan_fisik
        $this->ket_keluhan_fisik = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_keluhan_fisik', 'ket_keluhan_fisik', '`ket_keluhan_fisik`', '`ket_keluhan_fisik`', 200, 100, -1, false, '`ket_keluhan_fisik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_keluhan_fisik->Nullable = false; // NOT NULL field
        $this->ket_keluhan_fisik->Required = true; // Required field
        $this->ket_keluhan_fisik->Sortable = true; // Allow sort
        $this->ket_keluhan_fisik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_keluhan_fisik->Param, "CustomMsg");
        $this->Fields['ket_keluhan_fisik'] = &$this->ket_keluhan_fisik;

        // skala_nyeri
        $this->skala_nyeri = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_skala_nyeri', 'skala_nyeri', '`skala_nyeri`', '`skala_nyeri`', 202, 2, -1, false, '`skala_nyeri`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->skala_nyeri->Nullable = false; // NOT NULL field
        $this->skala_nyeri->Required = true; // Required field
        $this->skala_nyeri->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->skala_nyeri->Lookup = new Lookup('skala_nyeri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->skala_nyeri->Lookup = new Lookup('skala_nyeri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->skala_nyeri->OptionCount = 11;
        $this->skala_nyeri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skala_nyeri->Param, "CustomMsg");
        $this->Fields['skala_nyeri'] = &$this->skala_nyeri;

        // durasi
        $this->durasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_durasi', 'durasi', '`durasi`', '`durasi`', 200, 25, -1, false, '`durasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->durasi->Nullable = false; // NOT NULL field
        $this->durasi->Required = true; // Required field
        $this->durasi->Sortable = true; // Allow sort
        $this->durasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->durasi->Param, "CustomMsg");
        $this->Fields['durasi'] = &$this->durasi;

        // nyeri
        $this->nyeri = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_nyeri', 'nyeri', '`nyeri`', '`nyeri`', 202, 15, -1, false, '`nyeri`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->nyeri->Nullable = false; // NOT NULL field
        $this->nyeri->Required = true; // Required field
        $this->nyeri->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->nyeri->Lookup = new Lookup('nyeri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nyeri->Lookup = new Lookup('nyeri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nyeri->OptionCount = 3;
        $this->nyeri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nyeri->Param, "CustomMsg");
        $this->Fields['nyeri'] = &$this->nyeri;

        // provokes
        $this->provokes = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_provokes', 'provokes', '`provokes`', '`provokes`', 202, 15, -1, false, '`provokes`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->provokes->Nullable = false; // NOT NULL field
        $this->provokes->Required = true; // Required field
        $this->provokes->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->provokes->Lookup = new Lookup('provokes', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->provokes->Lookup = new Lookup('provokes', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->provokes->OptionCount = 3;
        $this->provokes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->provokes->Param, "CustomMsg");
        $this->Fields['provokes'] = &$this->provokes;

        // ket_provokes
        $this->ket_provokes = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_provokes', 'ket_provokes', '`ket_provokes`', '`ket_provokes`', 200, 40, -1, false, '`ket_provokes`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_provokes->Nullable = false; // NOT NULL field
        $this->ket_provokes->Required = true; // Required field
        $this->ket_provokes->Sortable = true; // Allow sort
        $this->ket_provokes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_provokes->Param, "CustomMsg");
        $this->Fields['ket_provokes'] = &$this->ket_provokes;

        // quality
        $this->quality = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_quality', 'quality', '`quality`', '`quality`', 202, 16, -1, false, '`quality`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->quality->Nullable = false; // NOT NULL field
        $this->quality->Required = true; // Required field
        $this->quality->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->quality->Lookup = new Lookup('quality', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->quality->Lookup = new Lookup('quality', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->quality->OptionCount = 6;
        $this->quality->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->quality->Param, "CustomMsg");
        $this->Fields['quality'] = &$this->quality;

        // ket_quality
        $this->ket_quality = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_quality', 'ket_quality', '`ket_quality`', '`ket_quality`', 200, 50, -1, false, '`ket_quality`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_quality->Nullable = false; // NOT NULL field
        $this->ket_quality->Required = true; // Required field
        $this->ket_quality->Sortable = true; // Allow sort
        $this->ket_quality->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_quality->Param, "CustomMsg");
        $this->Fields['ket_quality'] = &$this->ket_quality;

        // lokasi
        $this->lokasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_lokasi', 'lokasi', '`lokasi`', '`lokasi`', 200, 50, -1, false, '`lokasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lokasi->Nullable = false; // NOT NULL field
        $this->lokasi->Required = true; // Required field
        $this->lokasi->Sortable = true; // Allow sort
        $this->lokasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lokasi->Param, "CustomMsg");
        $this->Fields['lokasi'] = &$this->lokasi;

        // menyebar
        $this->menyebar = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_menyebar', 'menyebar', '`menyebar`', '`menyebar`', 202, 5, -1, false, '`menyebar`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->menyebar->Nullable = false; // NOT NULL field
        $this->menyebar->Required = true; // Required field
        $this->menyebar->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->menyebar->Lookup = new Lookup('menyebar', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->menyebar->Lookup = new Lookup('menyebar', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->menyebar->OptionCount = 2;
        $this->menyebar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->menyebar->Param, "CustomMsg");
        $this->Fields['menyebar'] = &$this->menyebar;

        // pada_dokter
        $this->pada_dokter = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_pada_dokter', 'pada_dokter', '`pada_dokter`', '`pada_dokter`', 202, 5, -1, false, '`pada_dokter`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->pada_dokter->Nullable = false; // NOT NULL field
        $this->pada_dokter->Required = true; // Required field
        $this->pada_dokter->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->pada_dokter->Lookup = new Lookup('pada_dokter', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->pada_dokter->Lookup = new Lookup('pada_dokter', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->pada_dokter->OptionCount = 2;
        $this->pada_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pada_dokter->Param, "CustomMsg");
        $this->Fields['pada_dokter'] = &$this->pada_dokter;

        // ket_dokter
        $this->ket_dokter = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_dokter', 'ket_dokter', '`ket_dokter`', '`ket_dokter`', 200, 15, -1, false, '`ket_dokter`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_dokter->Nullable = false; // NOT NULL field
        $this->ket_dokter->Required = true; // Required field
        $this->ket_dokter->Sortable = true; // Allow sort
        $this->ket_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_dokter->Param, "CustomMsg");
        $this->Fields['ket_dokter'] = &$this->ket_dokter;

        // nyeri_hilang
        $this->nyeri_hilang = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_nyeri_hilang', 'nyeri_hilang', '`nyeri_hilang`', '`nyeri_hilang`', 202, 14, -1, false, '`nyeri_hilang`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->nyeri_hilang->Nullable = false; // NOT NULL field
        $this->nyeri_hilang->Required = true; // Required field
        $this->nyeri_hilang->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->nyeri_hilang->Lookup = new Lookup('nyeri_hilang', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nyeri_hilang->Lookup = new Lookup('nyeri_hilang', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nyeri_hilang->OptionCount = 3;
        $this->nyeri_hilang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nyeri_hilang->Param, "CustomMsg");
        $this->Fields['nyeri_hilang'] = &$this->nyeri_hilang;

        // ket_nyeri
        $this->ket_nyeri = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_nyeri', 'ket_nyeri', '`ket_nyeri`', '`ket_nyeri`', 200, 40, -1, false, '`ket_nyeri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_nyeri->Nullable = false; // NOT NULL field
        $this->ket_nyeri->Required = true; // Required field
        $this->ket_nyeri->Sortable = true; // Allow sort
        $this->ket_nyeri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_nyeri->Param, "CustomMsg");
        $this->Fields['ket_nyeri'] = &$this->ket_nyeri;

        // bb
        $this->bb = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_bb', 'bb', '`bb`', '`bb`', 200, 5, -1, false, '`bb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bb->Nullable = false; // NOT NULL field
        $this->bb->Required = true; // Required field
        $this->bb->Sortable = true; // Allow sort
        $this->bb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bb->Param, "CustomMsg");
        $this->Fields['bb'] = &$this->bb;

        // tb
        $this->tb = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_tb', 'tb', '`tb`', '`tb`', 200, 5, -1, false, '`tb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tb->Nullable = false; // NOT NULL field
        $this->tb->Required = true; // Required field
        $this->tb->Sortable = true; // Allow sort
        $this->tb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tb->Param, "CustomMsg");
        $this->Fields['tb'] = &$this->tb;

        // bmi
        $this->bmi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_bmi', 'bmi', '`bmi`', '`bmi`', 200, 5, -1, false, '`bmi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bmi->Nullable = false; // NOT NULL field
        $this->bmi->Required = true; // Required field
        $this->bmi->Sortable = true; // Allow sort
        $this->bmi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bmi->Param, "CustomMsg");
        $this->Fields['bmi'] = &$this->bmi;

        // lapor_status_nutrisi
        $this->lapor_status_nutrisi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_lapor_status_nutrisi', 'lapor_status_nutrisi', '`lapor_status_nutrisi`', '`lapor_status_nutrisi`', 202, 5, -1, false, '`lapor_status_nutrisi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->lapor_status_nutrisi->Nullable = false; // NOT NULL field
        $this->lapor_status_nutrisi->Required = true; // Required field
        $this->lapor_status_nutrisi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->lapor_status_nutrisi->Lookup = new Lookup('lapor_status_nutrisi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->lapor_status_nutrisi->Lookup = new Lookup('lapor_status_nutrisi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->lapor_status_nutrisi->OptionCount = 2;
        $this->lapor_status_nutrisi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lapor_status_nutrisi->Param, "CustomMsg");
        $this->Fields['lapor_status_nutrisi'] = &$this->lapor_status_nutrisi;

        // ket_lapor_status_nutrisi
        $this->ket_lapor_status_nutrisi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_lapor_status_nutrisi', 'ket_lapor_status_nutrisi', '`ket_lapor_status_nutrisi`', '`ket_lapor_status_nutrisi`', 200, 15, -1, false, '`ket_lapor_status_nutrisi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_lapor_status_nutrisi->Nullable = false; // NOT NULL field
        $this->ket_lapor_status_nutrisi->Required = true; // Required field
        $this->ket_lapor_status_nutrisi->Sortable = true; // Allow sort
        $this->ket_lapor_status_nutrisi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_lapor_status_nutrisi->Param, "CustomMsg");
        $this->Fields['ket_lapor_status_nutrisi'] = &$this->ket_lapor_status_nutrisi;

        // sg1
        $this->sg1 = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sg1', 'sg1', '`sg1`', '`sg1`', 202, 12, -1, false, '`sg1`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sg1->Nullable = false; // NOT NULL field
        $this->sg1->Required = true; // Required field
        $this->sg1->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sg1->Lookup = new Lookup('sg1', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sg1->Lookup = new Lookup('sg1', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sg1->OptionCount = 6;
        $this->sg1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sg1->Param, "CustomMsg");
        $this->Fields['sg1'] = &$this->sg1;

        // nilai1
        $this->nilai1 = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_nilai1', 'nilai1', '`nilai1`', '`nilai1`', 202, 1, -1, false, '`nilai1`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->nilai1->Nullable = false; // NOT NULL field
        $this->nilai1->Required = true; // Required field
        $this->nilai1->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->nilai1->Lookup = new Lookup('nilai1', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nilai1->Lookup = new Lookup('nilai1', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nilai1->OptionCount = 5;
        $this->nilai1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nilai1->Param, "CustomMsg");
        $this->Fields['nilai1'] = &$this->nilai1;

        // sg2
        $this->sg2 = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sg2', 'sg2', '`sg2`', '`sg2`', 202, 5, -1, false, '`sg2`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sg2->Nullable = false; // NOT NULL field
        $this->sg2->Required = true; // Required field
        $this->sg2->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sg2->Lookup = new Lookup('sg2', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sg2->Lookup = new Lookup('sg2', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sg2->OptionCount = 2;
        $this->sg2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sg2->Param, "CustomMsg");
        $this->Fields['sg2'] = &$this->sg2;

        // nilai2
        $this->nilai2 = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_nilai2', 'nilai2', '`nilai2`', '`nilai2`', 202, 1, -1, false, '`nilai2`', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->nilai2->Nullable = false; // NOT NULL field
        $this->nilai2->Sortable = true; // Allow sort
        $this->nilai2->DataType = DATATYPE_BOOLEAN;
        switch ($CurrentLanguage) {
            case "en":
                $this->nilai2->Lookup = new Lookup('nilai2', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->nilai2->Lookup = new Lookup('nilai2', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->nilai2->OptionCount = 2;
        $this->nilai2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nilai2->Param, "CustomMsg");
        $this->Fields['nilai2'] = &$this->nilai2;

        // total_hasil
        $this->total_hasil = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_total_hasil', 'total_hasil', '`total_hasil`', '`total_hasil`', 16, 4, -1, false, '`total_hasil`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->total_hasil->Nullable = false; // NOT NULL field
        $this->total_hasil->Required = true; // Required field
        $this->total_hasil->Sortable = true; // Allow sort
        $this->total_hasil->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->total_hasil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->total_hasil->Param, "CustomMsg");
        $this->Fields['total_hasil'] = &$this->total_hasil;

        // resikojatuh
        $this->resikojatuh = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_resikojatuh', 'resikojatuh', '`resikojatuh`', '`resikojatuh`', 202, 5, -1, false, '`resikojatuh`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->resikojatuh->Nullable = false; // NOT NULL field
        $this->resikojatuh->Required = true; // Required field
        $this->resikojatuh->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->resikojatuh->Lookup = new Lookup('resikojatuh', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->resikojatuh->Lookup = new Lookup('resikojatuh', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->resikojatuh->OptionCount = 2;
        $this->resikojatuh->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->resikojatuh->Param, "CustomMsg");
        $this->Fields['resikojatuh'] = &$this->resikojatuh;

        // bjm
        $this->bjm = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_bjm', 'bjm', '`bjm`', '`bjm`', 202, 5, -1, false, '`bjm`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->bjm->Nullable = false; // NOT NULL field
        $this->bjm->Required = true; // Required field
        $this->bjm->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->bjm->Lookup = new Lookup('bjm', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->bjm->Lookup = new Lookup('bjm', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->bjm->OptionCount = 2;
        $this->bjm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bjm->Param, "CustomMsg");
        $this->Fields['bjm'] = &$this->bjm;

        // msa
        $this->msa = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_msa', 'msa', '`msa`', '`msa`', 202, 5, -1, false, '`msa`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->msa->Nullable = false; // NOT NULL field
        $this->msa->Required = true; // Required field
        $this->msa->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->msa->Lookup = new Lookup('msa', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->msa->Lookup = new Lookup('msa', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->msa->OptionCount = 2;
        $this->msa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->msa->Param, "CustomMsg");
        $this->Fields['msa'] = &$this->msa;

        // hasil
        $this->hasil = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_hasil', 'hasil', '`hasil`', '`hasil`', 202, 40, -1, false, '`hasil`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->hasil->Nullable = false; // NOT NULL field
        $this->hasil->Required = true; // Required field
        $this->hasil->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->hasil->Lookup = new Lookup('hasil', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->hasil->Lookup = new Lookup('hasil', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->hasil->OptionCount = 3;
        $this->hasil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hasil->Param, "CustomMsg");
        $this->Fields['hasil'] = &$this->hasil;

        // lapor
        $this->lapor = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_lapor', 'lapor', '`lapor`', '`lapor`', 202, 5, -1, false, '`lapor`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->lapor->Nullable = false; // NOT NULL field
        $this->lapor->Required = true; // Required field
        $this->lapor->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->lapor->Lookup = new Lookup('lapor', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->lapor->Lookup = new Lookup('lapor', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->lapor->OptionCount = 2;
        $this->lapor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lapor->Param, "CustomMsg");
        $this->Fields['lapor'] = &$this->lapor;

        // ket_lapor
        $this->ket_lapor = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_lapor', 'ket_lapor', '`ket_lapor`', '`ket_lapor`', 200, 15, -1, false, '`ket_lapor`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_lapor->Nullable = false; // NOT NULL field
        $this->ket_lapor->Required = true; // Required field
        $this->ket_lapor->Sortable = true; // Allow sort
        $this->ket_lapor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_lapor->Param, "CustomMsg");
        $this->Fields['ket_lapor'] = &$this->ket_lapor;

        // adl_mandi
        $this->adl_mandi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_mandi', 'adl_mandi', '`adl_mandi`', '`adl_mandi`', 202, 15, -1, false, '`adl_mandi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_mandi->Nullable = false; // NOT NULL field
        $this->adl_mandi->Required = true; // Required field
        $this->adl_mandi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_mandi->Lookup = new Lookup('adl_mandi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_mandi->Lookup = new Lookup('adl_mandi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_mandi->OptionCount = 3;
        $this->adl_mandi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_mandi->Param, "CustomMsg");
        $this->Fields['adl_mandi'] = &$this->adl_mandi;

        // adl_berpakaian
        $this->adl_berpakaian = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_berpakaian', 'adl_berpakaian', '`adl_berpakaian`', '`adl_berpakaian`', 202, 15, -1, false, '`adl_berpakaian`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_berpakaian->Nullable = false; // NOT NULL field
        $this->adl_berpakaian->Required = true; // Required field
        $this->adl_berpakaian->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_berpakaian->Lookup = new Lookup('adl_berpakaian', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_berpakaian->Lookup = new Lookup('adl_berpakaian', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_berpakaian->OptionCount = 3;
        $this->adl_berpakaian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_berpakaian->Param, "CustomMsg");
        $this->Fields['adl_berpakaian'] = &$this->adl_berpakaian;

        // adl_makan
        $this->adl_makan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_makan', 'adl_makan', '`adl_makan`', '`adl_makan`', 202, 15, -1, false, '`adl_makan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_makan->Nullable = false; // NOT NULL field
        $this->adl_makan->Required = true; // Required field
        $this->adl_makan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_makan->Lookup = new Lookup('adl_makan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_makan->Lookup = new Lookup('adl_makan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_makan->OptionCount = 3;
        $this->adl_makan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_makan->Param, "CustomMsg");
        $this->Fields['adl_makan'] = &$this->adl_makan;

        // adl_bak
        $this->adl_bak = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_bak', 'adl_bak', '`adl_bak`', '`adl_bak`', 202, 15, -1, false, '`adl_bak`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_bak->Nullable = false; // NOT NULL field
        $this->adl_bak->Required = true; // Required field
        $this->adl_bak->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_bak->Lookup = new Lookup('adl_bak', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_bak->Lookup = new Lookup('adl_bak', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_bak->OptionCount = 3;
        $this->adl_bak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_bak->Param, "CustomMsg");
        $this->Fields['adl_bak'] = &$this->adl_bak;

        // adl_bab
        $this->adl_bab = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_bab', 'adl_bab', '`adl_bab`', '`adl_bab`', 202, 15, -1, false, '`adl_bab`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_bab->Nullable = false; // NOT NULL field
        $this->adl_bab->Required = true; // Required field
        $this->adl_bab->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_bab->Lookup = new Lookup('adl_bab', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_bab->Lookup = new Lookup('adl_bab', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_bab->OptionCount = 3;
        $this->adl_bab->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_bab->Param, "CustomMsg");
        $this->Fields['adl_bab'] = &$this->adl_bab;

        // adl_hobi
        $this->adl_hobi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_hobi', 'adl_hobi', '`adl_hobi`', '`adl_hobi`', 202, 5, -1, false, '`adl_hobi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_hobi->Nullable = false; // NOT NULL field
        $this->adl_hobi->Required = true; // Required field
        $this->adl_hobi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_hobi->Lookup = new Lookup('adl_hobi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_hobi->Lookup = new Lookup('adl_hobi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_hobi->OptionCount = 2;
        $this->adl_hobi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_hobi->Param, "CustomMsg");
        $this->Fields['adl_hobi'] = &$this->adl_hobi;

        // ket_adl_hobi
        $this->ket_adl_hobi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_adl_hobi', 'ket_adl_hobi', '`ket_adl_hobi`', '`ket_adl_hobi`', 200, 50, -1, false, '`ket_adl_hobi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_adl_hobi->Nullable = false; // NOT NULL field
        $this->ket_adl_hobi->Required = true; // Required field
        $this->ket_adl_hobi->Sortable = true; // Allow sort
        $this->ket_adl_hobi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_adl_hobi->Param, "CustomMsg");
        $this->Fields['ket_adl_hobi'] = &$this->ket_adl_hobi;

        // adl_sosialisasi
        $this->adl_sosialisasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_sosialisasi', 'adl_sosialisasi', '`adl_sosialisasi`', '`adl_sosialisasi`', 202, 5, -1, false, '`adl_sosialisasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_sosialisasi->Nullable = false; // NOT NULL field
        $this->adl_sosialisasi->Required = true; // Required field
        $this->adl_sosialisasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_sosialisasi->Lookup = new Lookup('adl_sosialisasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_sosialisasi->Lookup = new Lookup('adl_sosialisasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_sosialisasi->OptionCount = 2;
        $this->adl_sosialisasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_sosialisasi->Param, "CustomMsg");
        $this->Fields['adl_sosialisasi'] = &$this->adl_sosialisasi;

        // ket_adl_sosialisasi
        $this->ket_adl_sosialisasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_adl_sosialisasi', 'ket_adl_sosialisasi', '`ket_adl_sosialisasi`', '`ket_adl_sosialisasi`', 200, 50, -1, false, '`ket_adl_sosialisasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_adl_sosialisasi->Nullable = false; // NOT NULL field
        $this->ket_adl_sosialisasi->Required = true; // Required field
        $this->ket_adl_sosialisasi->Sortable = true; // Allow sort
        $this->ket_adl_sosialisasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_adl_sosialisasi->Param, "CustomMsg");
        $this->Fields['ket_adl_sosialisasi'] = &$this->ket_adl_sosialisasi;

        // adl_kegiatan
        $this->adl_kegiatan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_adl_kegiatan', 'adl_kegiatan', '`adl_kegiatan`', '`adl_kegiatan`', 202, 5, -1, false, '`adl_kegiatan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->adl_kegiatan->Nullable = false; // NOT NULL field
        $this->adl_kegiatan->Required = true; // Required field
        $this->adl_kegiatan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->adl_kegiatan->Lookup = new Lookup('adl_kegiatan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->adl_kegiatan->Lookup = new Lookup('adl_kegiatan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->adl_kegiatan->OptionCount = 2;
        $this->adl_kegiatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->adl_kegiatan->Param, "CustomMsg");
        $this->Fields['adl_kegiatan'] = &$this->adl_kegiatan;

        // ket_adl_kegiatan
        $this->ket_adl_kegiatan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_adl_kegiatan', 'ket_adl_kegiatan', '`ket_adl_kegiatan`', '`ket_adl_kegiatan`', 200, 50, -1, false, '`ket_adl_kegiatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_adl_kegiatan->Nullable = false; // NOT NULL field
        $this->ket_adl_kegiatan->Required = true; // Required field
        $this->ket_adl_kegiatan->Sortable = true; // Allow sort
        $this->ket_adl_kegiatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_adl_kegiatan->Param, "CustomMsg");
        $this->Fields['ket_adl_kegiatan'] = &$this->ket_adl_kegiatan;

        // sk_penampilan
        $this->sk_penampilan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_penampilan', 'sk_penampilan', '`sk_penampilan`', '`sk_penampilan`', 202, 22, -1, false, '`sk_penampilan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_penampilan->Nullable = false; // NOT NULL field
        $this->sk_penampilan->Required = true; // Required field
        $this->sk_penampilan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_penampilan->Lookup = new Lookup('sk_penampilan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_penampilan->Lookup = new Lookup('sk_penampilan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_penampilan->OptionCount = 6;
        $this->sk_penampilan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_penampilan->Param, "CustomMsg");
        $this->Fields['sk_penampilan'] = &$this->sk_penampilan;

        // sk_alam_perasaan
        $this->sk_alam_perasaan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_alam_perasaan', 'sk_alam_perasaan', '`sk_alam_perasaan`', '`sk_alam_perasaan`', 202, 18, -1, false, '`sk_alam_perasaan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_alam_perasaan->Nullable = false; // NOT NULL field
        $this->sk_alam_perasaan->Required = true; // Required field
        $this->sk_alam_perasaan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_alam_perasaan->Lookup = new Lookup('sk_alam_perasaan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_alam_perasaan->Lookup = new Lookup('sk_alam_perasaan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_alam_perasaan->OptionCount = 12;
        $this->sk_alam_perasaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_alam_perasaan->Param, "CustomMsg");
        $this->Fields['sk_alam_perasaan'] = &$this->sk_alam_perasaan;

        // sk_pembicaraan
        $this->sk_pembicaraan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_pembicaraan', 'sk_pembicaraan', '`sk_pembicaraan`', '`sk_pembicaraan`', 202, 31, -1, false, '`sk_pembicaraan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_pembicaraan->Nullable = false; // NOT NULL field
        $this->sk_pembicaraan->Required = true; // Required field
        $this->sk_pembicaraan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_pembicaraan->Lookup = new Lookup('sk_pembicaraan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_pembicaraan->Lookup = new Lookup('sk_pembicaraan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_pembicaraan->OptionCount = 11;
        $this->sk_pembicaraan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_pembicaraan->Param, "CustomMsg");
        $this->Fields['sk_pembicaraan'] = &$this->sk_pembicaraan;

        // sk_afek
        $this->sk_afek = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_afek', 'sk_afek', '`sk_afek`', '`sk_afek`', 202, 12, -1, false, '`sk_afek`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_afek->Nullable = false; // NOT NULL field
        $this->sk_afek->Required = true; // Required field
        $this->sk_afek->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_afek->Lookup = new Lookup('sk_afek', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_afek->Lookup = new Lookup('sk_afek', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_afek->OptionCount = 5;
        $this->sk_afek->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_afek->Param, "CustomMsg");
        $this->Fields['sk_afek'] = &$this->sk_afek;

        // sk_aktifitas_motorik
        $this->sk_aktifitas_motorik = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_aktifitas_motorik', 'sk_aktifitas_motorik', '`sk_aktifitas_motorik`', '`sk_aktifitas_motorik`', 202, 15, -1, false, '`sk_aktifitas_motorik`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_aktifitas_motorik->Nullable = false; // NOT NULL field
        $this->sk_aktifitas_motorik->Required = true; // Required field
        $this->sk_aktifitas_motorik->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_aktifitas_motorik->Lookup = new Lookup('sk_aktifitas_motorik', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_aktifitas_motorik->Lookup = new Lookup('sk_aktifitas_motorik', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_aktifitas_motorik->OptionCount = 11;
        $this->sk_aktifitas_motorik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_aktifitas_motorik->Param, "CustomMsg");
        $this->Fields['sk_aktifitas_motorik'] = &$this->sk_aktifitas_motorik;

        // sk_gangguan_ringan
        $this->sk_gangguan_ringan = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_gangguan_ringan', 'sk_gangguan_ringan', '`sk_gangguan_ringan`', '`sk_gangguan_ringan`', 202, 17, -1, false, '`sk_gangguan_ringan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_gangguan_ringan->Nullable = false; // NOT NULL field
        $this->sk_gangguan_ringan->Required = true; // Required field
        $this->sk_gangguan_ringan->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_gangguan_ringan->Lookup = new Lookup('sk_gangguan_ringan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_gangguan_ringan->Lookup = new Lookup('sk_gangguan_ringan', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_gangguan_ringan->OptionCount = 2;
        $this->sk_gangguan_ringan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_gangguan_ringan->Param, "CustomMsg");
        $this->Fields['sk_gangguan_ringan'] = &$this->sk_gangguan_ringan;

        // sk_proses_pikir
        $this->sk_proses_pikir = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_proses_pikir', 'sk_proses_pikir', '`sk_proses_pikir`', '`sk_proses_pikir`', 202, 23, -1, false, '`sk_proses_pikir`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_proses_pikir->Nullable = false; // NOT NULL field
        $this->sk_proses_pikir->Required = true; // Required field
        $this->sk_proses_pikir->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_proses_pikir->Lookup = new Lookup('sk_proses_pikir', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_proses_pikir->Lookup = new Lookup('sk_proses_pikir', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_proses_pikir->OptionCount = 7;
        $this->sk_proses_pikir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_proses_pikir->Param, "CustomMsg");
        $this->Fields['sk_proses_pikir'] = &$this->sk_proses_pikir;

        // sk_orientasi
        $this->sk_orientasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_orientasi', 'sk_orientasi', '`sk_orientasi`', '`sk_orientasi`', 202, 5, -1, false, '`sk_orientasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_orientasi->Nullable = false; // NOT NULL field
        $this->sk_orientasi->Required = true; // Required field
        $this->sk_orientasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_orientasi->Lookup = new Lookup('sk_orientasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_orientasi->Lookup = new Lookup('sk_orientasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_orientasi->OptionCount = 2;
        $this->sk_orientasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_orientasi->Param, "CustomMsg");
        $this->Fields['sk_orientasi'] = &$this->sk_orientasi;

        // sk_tingkat_kesadaran_orientasi
        $this->sk_tingkat_kesadaran_orientasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_tingkat_kesadaran_orientasi', 'sk_tingkat_kesadaran_orientasi', '`sk_tingkat_kesadaran_orientasi`', '`sk_tingkat_kesadaran_orientasi`', 202, 7, -1, false, '`sk_tingkat_kesadaran_orientasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_tingkat_kesadaran_orientasi->Nullable = false; // NOT NULL field
        $this->sk_tingkat_kesadaran_orientasi->Required = true; // Required field
        $this->sk_tingkat_kesadaran_orientasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_tingkat_kesadaran_orientasi->Lookup = new Lookup('sk_tingkat_kesadaran_orientasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_tingkat_kesadaran_orientasi->Lookup = new Lookup('sk_tingkat_kesadaran_orientasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_tingkat_kesadaran_orientasi->OptionCount = 6;
        $this->sk_tingkat_kesadaran_orientasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_tingkat_kesadaran_orientasi->Param, "CustomMsg");
        $this->Fields['sk_tingkat_kesadaran_orientasi'] = &$this->sk_tingkat_kesadaran_orientasi;

        // sk_memori
        $this->sk_memori = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_memori', 'sk_memori', '`sk_memori`', '`sk_memori`', 202, 33, -1, false, '`sk_memori`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_memori->Nullable = false; // NOT NULL field
        $this->sk_memori->Required = true; // Required field
        $this->sk_memori->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_memori->Lookup = new Lookup('sk_memori', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_memori->Lookup = new Lookup('sk_memori', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_memori->OptionCount = 4;
        $this->sk_memori->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_memori->Param, "CustomMsg");
        $this->Fields['sk_memori'] = &$this->sk_memori;

        // sk_interaksi
        $this->sk_interaksi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_interaksi', 'sk_interaksi', '`sk_interaksi`', '`sk_interaksi`', 202, 18, -1, false, '`sk_interaksi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_interaksi->Nullable = false; // NOT NULL field
        $this->sk_interaksi->Required = true; // Required field
        $this->sk_interaksi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_interaksi->Lookup = new Lookup('sk_interaksi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_interaksi->Lookup = new Lookup('sk_interaksi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_interaksi->OptionCount = 7;
        $this->sk_interaksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_interaksi->Param, "CustomMsg");
        $this->Fields['sk_interaksi'] = &$this->sk_interaksi;

        // sk_konsentrasi
        $this->sk_konsentrasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_konsentrasi', 'sk_konsentrasi', '`sk_konsentrasi`', '`sk_konsentrasi`', 202, 31, -1, false, '`sk_konsentrasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_konsentrasi->Nullable = false; // NOT NULL field
        $this->sk_konsentrasi->Required = true; // Required field
        $this->sk_konsentrasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_konsentrasi->Lookup = new Lookup('sk_konsentrasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_konsentrasi->Lookup = new Lookup('sk_konsentrasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_konsentrasi->OptionCount = 4;
        $this->sk_konsentrasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_konsentrasi->Param, "CustomMsg");
        $this->Fields['sk_konsentrasi'] = &$this->sk_konsentrasi;

        // sk_persepsi
        $this->sk_persepsi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_persepsi', 'sk_persepsi', '`sk_persepsi`', '`sk_persepsi`', 202, 11, -1, false, '`sk_persepsi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_persepsi->Nullable = false; // NOT NULL field
        $this->sk_persepsi->Required = true; // Required field
        $this->sk_persepsi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_persepsi->Lookup = new Lookup('sk_persepsi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_persepsi->Lookup = new Lookup('sk_persepsi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_persepsi->OptionCount = 6;
        $this->sk_persepsi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_persepsi->Param, "CustomMsg");
        $this->Fields['sk_persepsi'] = &$this->sk_persepsi;

        // ket_sk_persepsi
        $this->ket_sk_persepsi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_sk_persepsi', 'ket_sk_persepsi', '`ket_sk_persepsi`', '`ket_sk_persepsi`', 200, 70, -1, false, '`ket_sk_persepsi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_sk_persepsi->Nullable = false; // NOT NULL field
        $this->ket_sk_persepsi->Required = true; // Required field
        $this->ket_sk_persepsi->Sortable = true; // Allow sort
        $this->ket_sk_persepsi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_sk_persepsi->Param, "CustomMsg");
        $this->Fields['ket_sk_persepsi'] = &$this->ket_sk_persepsi;

        // sk_isi_pikir
        $this->sk_isi_pikir = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_isi_pikir', 'sk_isi_pikir', '`sk_isi_pikir`', '`sk_isi_pikir`', 202, 16, -1, false, '`sk_isi_pikir`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_isi_pikir->Nullable = false; // NOT NULL field
        $this->sk_isi_pikir->Required = true; // Required field
        $this->sk_isi_pikir->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_isi_pikir->Lookup = new Lookup('sk_isi_pikir', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_isi_pikir->Lookup = new Lookup('sk_isi_pikir', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_isi_pikir->OptionCount = 8;
        $this->sk_isi_pikir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_isi_pikir->Param, "CustomMsg");
        $this->Fields['sk_isi_pikir'] = &$this->sk_isi_pikir;

        // sk_waham
        $this->sk_waham = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_waham', 'sk_waham', '`sk_waham`', '`sk_waham`', 202, 10, -1, false, '`sk_waham`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_waham->Nullable = false; // NOT NULL field
        $this->sk_waham->Required = true; // Required field
        $this->sk_waham->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_waham->Lookup = new Lookup('sk_waham', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_waham->Lookup = new Lookup('sk_waham', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_waham->OptionCount = 4;
        $this->sk_waham->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_waham->Param, "CustomMsg");
        $this->Fields['sk_waham'] = &$this->sk_waham;

        // ket_sk_waham
        $this->ket_sk_waham = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_sk_waham', 'ket_sk_waham', '`ket_sk_waham`', '`ket_sk_waham`', 200, 100, -1, false, '`ket_sk_waham`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_sk_waham->Nullable = false; // NOT NULL field
        $this->ket_sk_waham->Required = true; // Required field
        $this->ket_sk_waham->Sortable = true; // Allow sort
        $this->ket_sk_waham->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_sk_waham->Param, "CustomMsg");
        $this->Fields['ket_sk_waham'] = &$this->ket_sk_waham;

        // sk_daya_tilik_diri
        $this->sk_daya_tilik_diri = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_sk_daya_tilik_diri', 'sk_daya_tilik_diri', '`sk_daya_tilik_diri`', '`sk_daya_tilik_diri`', 202, 34, -1, false, '`sk_daya_tilik_diri`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->sk_daya_tilik_diri->Nullable = false; // NOT NULL field
        $this->sk_daya_tilik_diri->Required = true; // Required field
        $this->sk_daya_tilik_diri->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->sk_daya_tilik_diri->Lookup = new Lookup('sk_daya_tilik_diri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->sk_daya_tilik_diri->Lookup = new Lookup('sk_daya_tilik_diri', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->sk_daya_tilik_diri->OptionCount = 2;
        $this->sk_daya_tilik_diri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_daya_tilik_diri->Param, "CustomMsg");
        $this->Fields['sk_daya_tilik_diri'] = &$this->sk_daya_tilik_diri;

        // ket_sk_daya_tilik_diri
        $this->ket_sk_daya_tilik_diri = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_sk_daya_tilik_diri', 'ket_sk_daya_tilik_diri', '`ket_sk_daya_tilik_diri`', '`ket_sk_daya_tilik_diri`', 200, 100, -1, false, '`ket_sk_daya_tilik_diri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_sk_daya_tilik_diri->Nullable = false; // NOT NULL field
        $this->ket_sk_daya_tilik_diri->Required = true; // Required field
        $this->ket_sk_daya_tilik_diri->Sortable = true; // Allow sort
        $this->ket_sk_daya_tilik_diri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_sk_daya_tilik_diri->Param, "CustomMsg");
        $this->Fields['ket_sk_daya_tilik_diri'] = &$this->ket_sk_daya_tilik_diri;

        // kk_pembelajaran
        $this->kk_pembelajaran = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_kk_pembelajaran', 'kk_pembelajaran', '`kk_pembelajaran`', '`kk_pembelajaran`', 202, 5, -1, false, '`kk_pembelajaran`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kk_pembelajaran->Nullable = false; // NOT NULL field
        $this->kk_pembelajaran->Required = true; // Required field
        $this->kk_pembelajaran->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kk_pembelajaran->Lookup = new Lookup('kk_pembelajaran', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kk_pembelajaran->Lookup = new Lookup('kk_pembelajaran', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kk_pembelajaran->OptionCount = 2;
        $this->kk_pembelajaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kk_pembelajaran->Param, "CustomMsg");
        $this->Fields['kk_pembelajaran'] = &$this->kk_pembelajaran;

        // ket_kk_pembelajaran
        $this->ket_kk_pembelajaran = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_kk_pembelajaran', 'ket_kk_pembelajaran', '`ket_kk_pembelajaran`', '`ket_kk_pembelajaran`', 202, 11, -1, false, '`ket_kk_pembelajaran`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->ket_kk_pembelajaran->Nullable = false; // NOT NULL field
        $this->ket_kk_pembelajaran->Required = true; // Required field
        $this->ket_kk_pembelajaran->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->ket_kk_pembelajaran->Lookup = new Lookup('ket_kk_pembelajaran', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ket_kk_pembelajaran->Lookup = new Lookup('ket_kk_pembelajaran', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ket_kk_pembelajaran->OptionCount = 8;
        $this->ket_kk_pembelajaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_kk_pembelajaran->Param, "CustomMsg");
        $this->Fields['ket_kk_pembelajaran'] = &$this->ket_kk_pembelajaran;

        // ket_kk_pembelajaran_lainnya
        $this->ket_kk_pembelajaran_lainnya = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_kk_pembelajaran_lainnya', 'ket_kk_pembelajaran_lainnya', '`ket_kk_pembelajaran_lainnya`', '`ket_kk_pembelajaran_lainnya`', 200, 50, -1, false, '`ket_kk_pembelajaran_lainnya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_kk_pembelajaran_lainnya->Nullable = false; // NOT NULL field
        $this->ket_kk_pembelajaran_lainnya->Required = true; // Required field
        $this->ket_kk_pembelajaran_lainnya->Sortable = true; // Allow sort
        $this->ket_kk_pembelajaran_lainnya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_kk_pembelajaran_lainnya->Param, "CustomMsg");
        $this->Fields['ket_kk_pembelajaran_lainnya'] = &$this->ket_kk_pembelajaran_lainnya;

        // kk_Penerjamah
        $this->kk_Penerjamah = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_kk_Penerjamah', 'kk_Penerjamah', '`kk_Penerjamah`', '`kk_Penerjamah`', 202, 5, -1, false, '`kk_Penerjamah`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kk_Penerjamah->Nullable = false; // NOT NULL field
        $this->kk_Penerjamah->Required = true; // Required field
        $this->kk_Penerjamah->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kk_Penerjamah->Lookup = new Lookup('kk_Penerjamah', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kk_Penerjamah->Lookup = new Lookup('kk_Penerjamah', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kk_Penerjamah->OptionCount = 2;
        $this->kk_Penerjamah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kk_Penerjamah->Param, "CustomMsg");
        $this->Fields['kk_Penerjamah'] = &$this->kk_Penerjamah;

        // ket_kk_penerjamah_Lainnya
        $this->ket_kk_penerjamah_Lainnya = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_kk_penerjamah_Lainnya', 'ket_kk_penerjamah_Lainnya', '`ket_kk_penerjamah_Lainnya`', '`ket_kk_penerjamah_Lainnya`', 200, 50, -1, false, '`ket_kk_penerjamah_Lainnya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_kk_penerjamah_Lainnya->Nullable = false; // NOT NULL field
        $this->ket_kk_penerjamah_Lainnya->Required = true; // Required field
        $this->ket_kk_penerjamah_Lainnya->Sortable = true; // Allow sort
        $this->ket_kk_penerjamah_Lainnya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_kk_penerjamah_Lainnya->Param, "CustomMsg");
        $this->Fields['ket_kk_penerjamah_Lainnya'] = &$this->ket_kk_penerjamah_Lainnya;

        // kk_bahasa_isyarat
        $this->kk_bahasa_isyarat = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_kk_bahasa_isyarat', 'kk_bahasa_isyarat', '`kk_bahasa_isyarat`', '`kk_bahasa_isyarat`', 202, 5, -1, false, '`kk_bahasa_isyarat`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kk_bahasa_isyarat->Nullable = false; // NOT NULL field
        $this->kk_bahasa_isyarat->Required = true; // Required field
        $this->kk_bahasa_isyarat->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kk_bahasa_isyarat->Lookup = new Lookup('kk_bahasa_isyarat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kk_bahasa_isyarat->Lookup = new Lookup('kk_bahasa_isyarat', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kk_bahasa_isyarat->OptionCount = 2;
        $this->kk_bahasa_isyarat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kk_bahasa_isyarat->Param, "CustomMsg");
        $this->Fields['kk_bahasa_isyarat'] = &$this->kk_bahasa_isyarat;

        // kk_kebutuhan_edukasi
        $this->kk_kebutuhan_edukasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_kk_kebutuhan_edukasi', 'kk_kebutuhan_edukasi', '`kk_kebutuhan_edukasi`', '`kk_kebutuhan_edukasi`', 202, 31, -1, false, '`kk_kebutuhan_edukasi`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->kk_kebutuhan_edukasi->Nullable = false; // NOT NULL field
        $this->kk_kebutuhan_edukasi->Required = true; // Required field
        $this->kk_kebutuhan_edukasi->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->kk_kebutuhan_edukasi->Lookup = new Lookup('kk_kebutuhan_edukasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->kk_kebutuhan_edukasi->Lookup = new Lookup('kk_kebutuhan_edukasi', 'penilaian_awal_keperawatan_ralan_psikiatri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->kk_kebutuhan_edukasi->OptionCount = 7;
        $this->kk_kebutuhan_edukasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kk_kebutuhan_edukasi->Param, "CustomMsg");
        $this->Fields['kk_kebutuhan_edukasi'] = &$this->kk_kebutuhan_edukasi;

        // ket_kk_kebutuhan_edukasi
        $this->ket_kk_kebutuhan_edukasi = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_ket_kk_kebutuhan_edukasi', 'ket_kk_kebutuhan_edukasi', '`ket_kk_kebutuhan_edukasi`', '`ket_kk_kebutuhan_edukasi`', 200, 50, -1, false, '`ket_kk_kebutuhan_edukasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ket_kk_kebutuhan_edukasi->Nullable = false; // NOT NULL field
        $this->ket_kk_kebutuhan_edukasi->Required = true; // Required field
        $this->ket_kk_kebutuhan_edukasi->Sortable = true; // Allow sort
        $this->ket_kk_kebutuhan_edukasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ket_kk_kebutuhan_edukasi->Param, "CustomMsg");
        $this->Fields['ket_kk_kebutuhan_edukasi'] = &$this->ket_kk_kebutuhan_edukasi;

        // rencana
        $this->rencana = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_rencana', 'rencana', '`rencana`', '`rencana`', 200, 200, -1, false, '`rencana`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rencana->Nullable = false; // NOT NULL field
        $this->rencana->Required = true; // Required field
        $this->rencana->Sortable = true; // Allow sort
        $this->rencana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rencana->Param, "CustomMsg");
        $this->Fields['rencana'] = &$this->rencana;

        // nip
        $this->nip = new DbField('penilaian_awal_keperawatan_ralan_psikiatri', 'penilaian_awal_keperawatan_ralan_psikiatri', 'x_nip', 'nip', '`nip`', '`nip`', 200, 20, -1, false, '`nip`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nip->Sortable = true; // Allow sort
        $this->nip->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nip->Param, "CustomMsg");
        $this->Fields['nip'] = &$this->nip;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`penilaian_awal_keperawatan_ralan_psikiatri`";
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
            $this->id_penilaian_awal_keperawatan_ralan_psikiatri->setDbValue($conn->lastInsertId());
            $rs['id_penilaian_awal_keperawatan_ralan_psikiatri'] = $this->id_penilaian_awal_keperawatan_ralan_psikiatri->DbValue;
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
            if (array_key_exists('id_penilaian_awal_keperawatan_ralan_psikiatri', $rs)) {
                AddFilter($where, QuotedName('id_penilaian_awal_keperawatan_ralan_psikiatri', $this->Dbid) . '=' . QuotedValue($rs['id_penilaian_awal_keperawatan_ralan_psikiatri'], $this->id_penilaian_awal_keperawatan_ralan_psikiatri->DataType, $this->Dbid));
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
        $this->id_penilaian_awal_keperawatan_ralan_psikiatri->DbValue = $row['id_penilaian_awal_keperawatan_ralan_psikiatri'];
        $this->no_rawat->DbValue = $row['no_rawat'];
        $this->tanggal->DbValue = $row['tanggal'];
        $this->informasi->DbValue = $row['informasi'];
        $this->keluhan_utama->DbValue = $row['keluhan_utama'];
        $this->rkd_sakit_sejak->DbValue = $row['rkd_sakit_sejak'];
        $this->rkd_keluhan->DbValue = $row['rkd_keluhan'];
        $this->rkd_berobat->DbValue = $row['rkd_berobat'];
        $this->rkd_hasil_pengobatan->DbValue = $row['rkd_hasil_pengobatan'];
        $this->fp_putus_obat->DbValue = $row['fp_putus_obat'];
        $this->ket_putus_obat->DbValue = $row['ket_putus_obat'];
        $this->fp_ekonomi->DbValue = $row['fp_ekonomi'];
        $this->ket_masalah_ekonomi->DbValue = $row['ket_masalah_ekonomi'];
        $this->fp_masalah_fisik->DbValue = $row['fp_masalah_fisik'];
        $this->ket_masalah_fisik->DbValue = $row['ket_masalah_fisik'];
        $this->fp_masalah_psikososial->DbValue = $row['fp_masalah_psikososial'];
        $this->ket_masalah_psikososial->DbValue = $row['ket_masalah_psikososial'];
        $this->rh_keluarga->DbValue = $row['rh_keluarga'];
        $this->ket_rh_keluarga->DbValue = $row['ket_rh_keluarga'];
        $this->resiko_bunuh_diri->DbValue = $row['resiko_bunuh_diri'];
        $this->rbd_ide->DbValue = $row['rbd_ide'];
        $this->ket_rbd_ide->DbValue = $row['ket_rbd_ide'];
        $this->rbd_rencana->DbValue = $row['rbd_rencana'];
        $this->ket_rbd_rencana->DbValue = $row['ket_rbd_rencana'];
        $this->rbd_alat->DbValue = $row['rbd_alat'];
        $this->ket_rbd_alat->DbValue = $row['ket_rbd_alat'];
        $this->rbd_percobaan->DbValue = $row['rbd_percobaan'];
        $this->ket_rbd_percobaan->DbValue = $row['ket_rbd_percobaan'];
        $this->rbd_keinginan->DbValue = $row['rbd_keinginan'];
        $this->ket_rbd_keinginan->DbValue = $row['ket_rbd_keinginan'];
        $this->rpo_penggunaan->DbValue = $row['rpo_penggunaan'];
        $this->ket_rpo_penggunaan->DbValue = $row['ket_rpo_penggunaan'];
        $this->rpo_efek_samping->DbValue = $row['rpo_efek_samping'];
        $this->ket_rpo_efek_samping->DbValue = $row['ket_rpo_efek_samping'];
        $this->rpo_napza->DbValue = $row['rpo_napza'];
        $this->ket_rpo_napza->DbValue = $row['ket_rpo_napza'];
        $this->ket_lama_pemakaian->DbValue = $row['ket_lama_pemakaian'];
        $this->ket_cara_pemakaian->DbValue = $row['ket_cara_pemakaian'];
        $this->ket_latar_belakang_pemakaian->DbValue = $row['ket_latar_belakang_pemakaian'];
        $this->rpo_penggunaan_obat_lainnya->DbValue = $row['rpo_penggunaan_obat_lainnya'];
        $this->ket_penggunaan_obat_lainnya->DbValue = $row['ket_penggunaan_obat_lainnya'];
        $this->ket_alasan_penggunaan->DbValue = $row['ket_alasan_penggunaan'];
        $this->rpo_alergi_obat->DbValue = $row['rpo_alergi_obat'];
        $this->ket_alergi_obat->DbValue = $row['ket_alergi_obat'];
        $this->rpo_merokok->DbValue = $row['rpo_merokok'];
        $this->ket_merokok->DbValue = $row['ket_merokok'];
        $this->rpo_minum_kopi->DbValue = $row['rpo_minum_kopi'];
        $this->ket_minum_kopi->DbValue = $row['ket_minum_kopi'];
        $this->td->DbValue = $row['td'];
        $this->nadi->DbValue = $row['nadi'];
        $this->gcs->DbValue = $row['gcs'];
        $this->rr->DbValue = $row['rr'];
        $this->suhu->DbValue = $row['suhu'];
        $this->pf_keluhan_fisik->DbValue = $row['pf_keluhan_fisik'];
        $this->ket_keluhan_fisik->DbValue = $row['ket_keluhan_fisik'];
        $this->skala_nyeri->DbValue = $row['skala_nyeri'];
        $this->durasi->DbValue = $row['durasi'];
        $this->nyeri->DbValue = $row['nyeri'];
        $this->provokes->DbValue = $row['provokes'];
        $this->ket_provokes->DbValue = $row['ket_provokes'];
        $this->quality->DbValue = $row['quality'];
        $this->ket_quality->DbValue = $row['ket_quality'];
        $this->lokasi->DbValue = $row['lokasi'];
        $this->menyebar->DbValue = $row['menyebar'];
        $this->pada_dokter->DbValue = $row['pada_dokter'];
        $this->ket_dokter->DbValue = $row['ket_dokter'];
        $this->nyeri_hilang->DbValue = $row['nyeri_hilang'];
        $this->ket_nyeri->DbValue = $row['ket_nyeri'];
        $this->bb->DbValue = $row['bb'];
        $this->tb->DbValue = $row['tb'];
        $this->bmi->DbValue = $row['bmi'];
        $this->lapor_status_nutrisi->DbValue = $row['lapor_status_nutrisi'];
        $this->ket_lapor_status_nutrisi->DbValue = $row['ket_lapor_status_nutrisi'];
        $this->sg1->DbValue = $row['sg1'];
        $this->nilai1->DbValue = $row['nilai1'];
        $this->sg2->DbValue = $row['sg2'];
        $this->nilai2->DbValue = $row['nilai2'];
        $this->total_hasil->DbValue = $row['total_hasil'];
        $this->resikojatuh->DbValue = $row['resikojatuh'];
        $this->bjm->DbValue = $row['bjm'];
        $this->msa->DbValue = $row['msa'];
        $this->hasil->DbValue = $row['hasil'];
        $this->lapor->DbValue = $row['lapor'];
        $this->ket_lapor->DbValue = $row['ket_lapor'];
        $this->adl_mandi->DbValue = $row['adl_mandi'];
        $this->adl_berpakaian->DbValue = $row['adl_berpakaian'];
        $this->adl_makan->DbValue = $row['adl_makan'];
        $this->adl_bak->DbValue = $row['adl_bak'];
        $this->adl_bab->DbValue = $row['adl_bab'];
        $this->adl_hobi->DbValue = $row['adl_hobi'];
        $this->ket_adl_hobi->DbValue = $row['ket_adl_hobi'];
        $this->adl_sosialisasi->DbValue = $row['adl_sosialisasi'];
        $this->ket_adl_sosialisasi->DbValue = $row['ket_adl_sosialisasi'];
        $this->adl_kegiatan->DbValue = $row['adl_kegiatan'];
        $this->ket_adl_kegiatan->DbValue = $row['ket_adl_kegiatan'];
        $this->sk_penampilan->DbValue = $row['sk_penampilan'];
        $this->sk_alam_perasaan->DbValue = $row['sk_alam_perasaan'];
        $this->sk_pembicaraan->DbValue = $row['sk_pembicaraan'];
        $this->sk_afek->DbValue = $row['sk_afek'];
        $this->sk_aktifitas_motorik->DbValue = $row['sk_aktifitas_motorik'];
        $this->sk_gangguan_ringan->DbValue = $row['sk_gangguan_ringan'];
        $this->sk_proses_pikir->DbValue = $row['sk_proses_pikir'];
        $this->sk_orientasi->DbValue = $row['sk_orientasi'];
        $this->sk_tingkat_kesadaran_orientasi->DbValue = $row['sk_tingkat_kesadaran_orientasi'];
        $this->sk_memori->DbValue = $row['sk_memori'];
        $this->sk_interaksi->DbValue = $row['sk_interaksi'];
        $this->sk_konsentrasi->DbValue = $row['sk_konsentrasi'];
        $this->sk_persepsi->DbValue = $row['sk_persepsi'];
        $this->ket_sk_persepsi->DbValue = $row['ket_sk_persepsi'];
        $this->sk_isi_pikir->DbValue = $row['sk_isi_pikir'];
        $this->sk_waham->DbValue = $row['sk_waham'];
        $this->ket_sk_waham->DbValue = $row['ket_sk_waham'];
        $this->sk_daya_tilik_diri->DbValue = $row['sk_daya_tilik_diri'];
        $this->ket_sk_daya_tilik_diri->DbValue = $row['ket_sk_daya_tilik_diri'];
        $this->kk_pembelajaran->DbValue = $row['kk_pembelajaran'];
        $this->ket_kk_pembelajaran->DbValue = $row['ket_kk_pembelajaran'];
        $this->ket_kk_pembelajaran_lainnya->DbValue = $row['ket_kk_pembelajaran_lainnya'];
        $this->kk_Penerjamah->DbValue = $row['kk_Penerjamah'];
        $this->ket_kk_penerjamah_Lainnya->DbValue = $row['ket_kk_penerjamah_Lainnya'];
        $this->kk_bahasa_isyarat->DbValue = $row['kk_bahasa_isyarat'];
        $this->kk_kebutuhan_edukasi->DbValue = $row['kk_kebutuhan_edukasi'];
        $this->ket_kk_kebutuhan_edukasi->DbValue = $row['ket_kk_kebutuhan_edukasi'];
        $this->rencana->DbValue = $row['rencana'];
        $this->nip->DbValue = $row['nip'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_penilaian_awal_keperawatan_ralan_psikiatri` = @id_penilaian_awal_keperawatan_ralan_psikiatri@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue : $this->id_penilaian_awal_keperawatan_ralan_psikiatri->OldValue;
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
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue = $keys[0];
            } else {
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_penilaian_awal_keperawatan_ralan_psikiatri', $row) ? $row['id_penilaian_awal_keperawatan_ralan_psikiatri'] : null;
        } else {
            $val = $this->id_penilaian_awal_keperawatan_ralan_psikiatri->OldValue !== null ? $this->id_penilaian_awal_keperawatan_ralan_psikiatri->OldValue : $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_penilaian_awal_keperawatan_ralan_psikiatri@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PenilaianAwalKeperawatanRalanPsikiatriList");
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
        if ($pageName == "PenilaianAwalKeperawatanRalanPsikiatriView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PenilaianAwalKeperawatanRalanPsikiatriEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PenilaianAwalKeperawatanRalanPsikiatriAdd") {
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
                return "PenilaianAwalKeperawatanRalanPsikiatriView";
            case Config("API_ADD_ACTION"):
                return "PenilaianAwalKeperawatanRalanPsikiatriAdd";
            case Config("API_EDIT_ACTION"):
                return "PenilaianAwalKeperawatanRalanPsikiatriEdit";
            case Config("API_DELETE_ACTION"):
                return "PenilaianAwalKeperawatanRalanPsikiatriDelete";
            case Config("API_LIST_ACTION"):
                return "PenilaianAwalKeperawatanRalanPsikiatriList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PenilaianAwalKeperawatanRalanPsikiatriList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PenilaianAwalKeperawatanRalanPsikiatriView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PenilaianAwalKeperawatanRalanPsikiatriView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PenilaianAwalKeperawatanRalanPsikiatriAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PenilaianAwalKeperawatanRalanPsikiatriAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PenilaianAwalKeperawatanRalanPsikiatriEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PenilaianAwalKeperawatanRalanPsikiatriAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PenilaianAwalKeperawatanRalanPsikiatriDelete", $this->getUrlParm());
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
        $json .= "id_penilaian_awal_keperawatan_ralan_psikiatri:" . JsonEncode($this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue);
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
            if (($keyValue = Param("id_penilaian_awal_keperawatan_ralan_psikiatri") ?? Route("id_penilaian_awal_keperawatan_ralan_psikiatri")) !== null) {
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
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->CurrentValue = $key;
            } else {
                $this->id_penilaian_awal_keperawatan_ralan_psikiatri->OldValue = $key;
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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
            $this->no_rawat->EditValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());
        }

        // tanggal
        $this->tanggal->EditAttrs["class"] = "form-control";
        $this->tanggal->EditCustomAttributes = "";
        $this->tanggal->EditValue = FormatDateTime($this->tanggal->CurrentValue, 8);
        $this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

        // informasi
        $this->informasi->EditCustomAttributes = "";
        $this->informasi->EditValue = $this->informasi->options(false);
        $this->informasi->PlaceHolder = RemoveHtml($this->informasi->caption());

        // keluhan_utama
        $this->keluhan_utama->EditAttrs["class"] = "form-control";
        $this->keluhan_utama->EditCustomAttributes = "";
        $this->keluhan_utama->EditValue = $this->keluhan_utama->CurrentValue;
        $this->keluhan_utama->PlaceHolder = RemoveHtml($this->keluhan_utama->caption());

        // rkd_sakit_sejak
        $this->rkd_sakit_sejak->EditAttrs["class"] = "form-control";
        $this->rkd_sakit_sejak->EditCustomAttributes = "";
        if (!$this->rkd_sakit_sejak->Raw) {
            $this->rkd_sakit_sejak->CurrentValue = HtmlDecode($this->rkd_sakit_sejak->CurrentValue);
        }
        $this->rkd_sakit_sejak->EditValue = $this->rkd_sakit_sejak->CurrentValue;
        $this->rkd_sakit_sejak->PlaceHolder = RemoveHtml($this->rkd_sakit_sejak->caption());

        // rkd_keluhan
        $this->rkd_keluhan->EditAttrs["class"] = "form-control";
        $this->rkd_keluhan->EditCustomAttributes = "";
        $this->rkd_keluhan->EditValue = $this->rkd_keluhan->CurrentValue;
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
        $this->ket_putus_obat->EditValue = $this->ket_putus_obat->CurrentValue;
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
        $this->ket_masalah_ekonomi->EditValue = $this->ket_masalah_ekonomi->CurrentValue;
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
        $this->ket_masalah_fisik->EditValue = $this->ket_masalah_fisik->CurrentValue;
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
        $this->ket_masalah_psikososial->EditValue = $this->ket_masalah_psikososial->CurrentValue;
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
        $this->ket_rh_keluarga->EditValue = $this->ket_rh_keluarga->CurrentValue;
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
        $this->ket_rbd_ide->EditValue = $this->ket_rbd_ide->CurrentValue;
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
        $this->ket_rbd_rencana->EditValue = $this->ket_rbd_rencana->CurrentValue;
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
        $this->ket_rbd_alat->EditValue = $this->ket_rbd_alat->CurrentValue;
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
        $this->ket_rbd_percobaan->EditValue = $this->ket_rbd_percobaan->CurrentValue;
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
        $this->ket_rbd_keinginan->EditValue = $this->ket_rbd_keinginan->CurrentValue;
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
        $this->ket_rpo_penggunaan->EditValue = $this->ket_rpo_penggunaan->CurrentValue;
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
        $this->ket_rpo_efek_samping->EditValue = $this->ket_rpo_efek_samping->CurrentValue;
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
        $this->ket_rpo_napza->EditValue = $this->ket_rpo_napza->CurrentValue;
        $this->ket_rpo_napza->PlaceHolder = RemoveHtml($this->ket_rpo_napza->caption());

        // ket_lama_pemakaian
        $this->ket_lama_pemakaian->EditAttrs["class"] = "form-control";
        $this->ket_lama_pemakaian->EditCustomAttributes = "";
        if (!$this->ket_lama_pemakaian->Raw) {
            $this->ket_lama_pemakaian->CurrentValue = HtmlDecode($this->ket_lama_pemakaian->CurrentValue);
        }
        $this->ket_lama_pemakaian->EditValue = $this->ket_lama_pemakaian->CurrentValue;
        $this->ket_lama_pemakaian->PlaceHolder = RemoveHtml($this->ket_lama_pemakaian->caption());

        // ket_cara_pemakaian
        $this->ket_cara_pemakaian->EditAttrs["class"] = "form-control";
        $this->ket_cara_pemakaian->EditCustomAttributes = "";
        if (!$this->ket_cara_pemakaian->Raw) {
            $this->ket_cara_pemakaian->CurrentValue = HtmlDecode($this->ket_cara_pemakaian->CurrentValue);
        }
        $this->ket_cara_pemakaian->EditValue = $this->ket_cara_pemakaian->CurrentValue;
        $this->ket_cara_pemakaian->PlaceHolder = RemoveHtml($this->ket_cara_pemakaian->caption());

        // ket_latar_belakang_pemakaian
        $this->ket_latar_belakang_pemakaian->EditAttrs["class"] = "form-control";
        $this->ket_latar_belakang_pemakaian->EditCustomAttributes = "";
        if (!$this->ket_latar_belakang_pemakaian->Raw) {
            $this->ket_latar_belakang_pemakaian->CurrentValue = HtmlDecode($this->ket_latar_belakang_pemakaian->CurrentValue);
        }
        $this->ket_latar_belakang_pemakaian->EditValue = $this->ket_latar_belakang_pemakaian->CurrentValue;
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
        $this->ket_penggunaan_obat_lainnya->EditValue = $this->ket_penggunaan_obat_lainnya->CurrentValue;
        $this->ket_penggunaan_obat_lainnya->PlaceHolder = RemoveHtml($this->ket_penggunaan_obat_lainnya->caption());

        // ket_alasan_penggunaan
        $this->ket_alasan_penggunaan->EditAttrs["class"] = "form-control";
        $this->ket_alasan_penggunaan->EditCustomAttributes = "";
        if (!$this->ket_alasan_penggunaan->Raw) {
            $this->ket_alasan_penggunaan->CurrentValue = HtmlDecode($this->ket_alasan_penggunaan->CurrentValue);
        }
        $this->ket_alasan_penggunaan->EditValue = $this->ket_alasan_penggunaan->CurrentValue;
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
        $this->ket_alergi_obat->EditValue = $this->ket_alergi_obat->CurrentValue;
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
        $this->ket_merokok->EditValue = $this->ket_merokok->CurrentValue;
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
        $this->ket_minum_kopi->EditValue = $this->ket_minum_kopi->CurrentValue;
        $this->ket_minum_kopi->PlaceHolder = RemoveHtml($this->ket_minum_kopi->caption());

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

        // gcs
        $this->gcs->EditAttrs["class"] = "form-control";
        $this->gcs->EditCustomAttributes = "";
        if (!$this->gcs->Raw) {
            $this->gcs->CurrentValue = HtmlDecode($this->gcs->CurrentValue);
        }
        $this->gcs->EditValue = $this->gcs->CurrentValue;
        $this->gcs->PlaceHolder = RemoveHtml($this->gcs->caption());

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
        $this->ket_keluhan_fisik->EditValue = $this->ket_keluhan_fisik->CurrentValue;
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
        $this->durasi->EditValue = $this->durasi->CurrentValue;
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
        $this->ket_lapor_status_nutrisi->EditValue = $this->ket_lapor_status_nutrisi->CurrentValue;
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
        $this->total_hasil->EditValue = $this->total_hasil->CurrentValue;
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
        $this->ket_lapor->EditValue = $this->ket_lapor->CurrentValue;
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
        $this->ket_adl_hobi->EditValue = $this->ket_adl_hobi->CurrentValue;
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
        $this->ket_adl_sosialisasi->EditValue = $this->ket_adl_sosialisasi->CurrentValue;
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
        $this->ket_adl_kegiatan->EditValue = $this->ket_adl_kegiatan->CurrentValue;
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
        $this->ket_sk_persepsi->EditValue = $this->ket_sk_persepsi->CurrentValue;
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
        $this->ket_sk_waham->EditValue = $this->ket_sk_waham->CurrentValue;
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
        $this->ket_sk_daya_tilik_diri->EditValue = $this->ket_sk_daya_tilik_diri->CurrentValue;
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
        $this->ket_kk_pembelajaran_lainnya->EditValue = $this->ket_kk_pembelajaran_lainnya->CurrentValue;
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
        $this->ket_kk_penerjamah_Lainnya->EditValue = $this->ket_kk_penerjamah_Lainnya->CurrentValue;
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
        $this->ket_kk_kebutuhan_edukasi->EditValue = $this->ket_kk_kebutuhan_edukasi->CurrentValue;
        $this->ket_kk_kebutuhan_edukasi->PlaceHolder = RemoveHtml($this->ket_kk_kebutuhan_edukasi->caption());

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
                    $doc->exportCaption($this->id_penilaian_awal_keperawatan_ralan_psikiatri);
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->informasi);
                    $doc->exportCaption($this->keluhan_utama);
                    $doc->exportCaption($this->rkd_sakit_sejak);
                    $doc->exportCaption($this->rkd_keluhan);
                    $doc->exportCaption($this->rkd_berobat);
                    $doc->exportCaption($this->rkd_hasil_pengobatan);
                    $doc->exportCaption($this->fp_putus_obat);
                    $doc->exportCaption($this->ket_putus_obat);
                    $doc->exportCaption($this->fp_ekonomi);
                    $doc->exportCaption($this->ket_masalah_ekonomi);
                    $doc->exportCaption($this->fp_masalah_fisik);
                    $doc->exportCaption($this->ket_masalah_fisik);
                    $doc->exportCaption($this->fp_masalah_psikososial);
                    $doc->exportCaption($this->ket_masalah_psikososial);
                    $doc->exportCaption($this->rh_keluarga);
                    $doc->exportCaption($this->ket_rh_keluarga);
                    $doc->exportCaption($this->resiko_bunuh_diri);
                    $doc->exportCaption($this->rbd_ide);
                    $doc->exportCaption($this->ket_rbd_ide);
                    $doc->exportCaption($this->rbd_rencana);
                    $doc->exportCaption($this->ket_rbd_rencana);
                    $doc->exportCaption($this->rbd_alat);
                    $doc->exportCaption($this->ket_rbd_alat);
                    $doc->exportCaption($this->rbd_percobaan);
                    $doc->exportCaption($this->ket_rbd_percobaan);
                    $doc->exportCaption($this->rbd_keinginan);
                    $doc->exportCaption($this->ket_rbd_keinginan);
                    $doc->exportCaption($this->rpo_penggunaan);
                    $doc->exportCaption($this->ket_rpo_penggunaan);
                    $doc->exportCaption($this->rpo_efek_samping);
                    $doc->exportCaption($this->ket_rpo_efek_samping);
                    $doc->exportCaption($this->rpo_napza);
                    $doc->exportCaption($this->ket_rpo_napza);
                    $doc->exportCaption($this->ket_lama_pemakaian);
                    $doc->exportCaption($this->ket_cara_pemakaian);
                    $doc->exportCaption($this->ket_latar_belakang_pemakaian);
                    $doc->exportCaption($this->rpo_penggunaan_obat_lainnya);
                    $doc->exportCaption($this->ket_penggunaan_obat_lainnya);
                    $doc->exportCaption($this->ket_alasan_penggunaan);
                    $doc->exportCaption($this->rpo_alergi_obat);
                    $doc->exportCaption($this->ket_alergi_obat);
                    $doc->exportCaption($this->rpo_merokok);
                    $doc->exportCaption($this->ket_merokok);
                    $doc->exportCaption($this->rpo_minum_kopi);
                    $doc->exportCaption($this->ket_minum_kopi);
                    $doc->exportCaption($this->td);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->rr);
                    $doc->exportCaption($this->suhu);
                    $doc->exportCaption($this->pf_keluhan_fisik);
                    $doc->exportCaption($this->ket_keluhan_fisik);
                    $doc->exportCaption($this->skala_nyeri);
                    $doc->exportCaption($this->durasi);
                    $doc->exportCaption($this->nyeri);
                    $doc->exportCaption($this->provokes);
                    $doc->exportCaption($this->ket_provokes);
                    $doc->exportCaption($this->quality);
                    $doc->exportCaption($this->ket_quality);
                    $doc->exportCaption($this->lokasi);
                    $doc->exportCaption($this->menyebar);
                    $doc->exportCaption($this->pada_dokter);
                    $doc->exportCaption($this->ket_dokter);
                    $doc->exportCaption($this->nyeri_hilang);
                    $doc->exportCaption($this->ket_nyeri);
                    $doc->exportCaption($this->bb);
                    $doc->exportCaption($this->tb);
                    $doc->exportCaption($this->bmi);
                    $doc->exportCaption($this->lapor_status_nutrisi);
                    $doc->exportCaption($this->ket_lapor_status_nutrisi);
                    $doc->exportCaption($this->sg1);
                    $doc->exportCaption($this->nilai1);
                    $doc->exportCaption($this->sg2);
                    $doc->exportCaption($this->nilai2);
                    $doc->exportCaption($this->total_hasil);
                    $doc->exportCaption($this->resikojatuh);
                    $doc->exportCaption($this->bjm);
                    $doc->exportCaption($this->msa);
                    $doc->exportCaption($this->hasil);
                    $doc->exportCaption($this->lapor);
                    $doc->exportCaption($this->ket_lapor);
                    $doc->exportCaption($this->adl_mandi);
                    $doc->exportCaption($this->adl_berpakaian);
                    $doc->exportCaption($this->adl_makan);
                    $doc->exportCaption($this->adl_bak);
                    $doc->exportCaption($this->adl_bab);
                    $doc->exportCaption($this->adl_hobi);
                    $doc->exportCaption($this->ket_adl_hobi);
                    $doc->exportCaption($this->adl_sosialisasi);
                    $doc->exportCaption($this->ket_adl_sosialisasi);
                    $doc->exportCaption($this->adl_kegiatan);
                    $doc->exportCaption($this->ket_adl_kegiatan);
                    $doc->exportCaption($this->sk_penampilan);
                    $doc->exportCaption($this->sk_alam_perasaan);
                    $doc->exportCaption($this->sk_pembicaraan);
                    $doc->exportCaption($this->sk_afek);
                    $doc->exportCaption($this->sk_aktifitas_motorik);
                    $doc->exportCaption($this->sk_gangguan_ringan);
                    $doc->exportCaption($this->sk_proses_pikir);
                    $doc->exportCaption($this->sk_orientasi);
                    $doc->exportCaption($this->sk_tingkat_kesadaran_orientasi);
                    $doc->exportCaption($this->sk_memori);
                    $doc->exportCaption($this->sk_interaksi);
                    $doc->exportCaption($this->sk_konsentrasi);
                    $doc->exportCaption($this->sk_persepsi);
                    $doc->exportCaption($this->ket_sk_persepsi);
                    $doc->exportCaption($this->sk_isi_pikir);
                    $doc->exportCaption($this->sk_waham);
                    $doc->exportCaption($this->ket_sk_waham);
                    $doc->exportCaption($this->sk_daya_tilik_diri);
                    $doc->exportCaption($this->ket_sk_daya_tilik_diri);
                    $doc->exportCaption($this->kk_pembelajaran);
                    $doc->exportCaption($this->ket_kk_pembelajaran);
                    $doc->exportCaption($this->ket_kk_pembelajaran_lainnya);
                    $doc->exportCaption($this->kk_Penerjamah);
                    $doc->exportCaption($this->ket_kk_penerjamah_Lainnya);
                    $doc->exportCaption($this->kk_bahasa_isyarat);
                    $doc->exportCaption($this->kk_kebutuhan_edukasi);
                    $doc->exportCaption($this->ket_kk_kebutuhan_edukasi);
                    $doc->exportCaption($this->rencana);
                    $doc->exportCaption($this->nip);
                } else {
                    $doc->exportCaption($this->id_penilaian_awal_keperawatan_ralan_psikiatri);
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->tanggal);
                    $doc->exportCaption($this->informasi);
                    $doc->exportCaption($this->rkd_sakit_sejak);
                    $doc->exportCaption($this->rkd_berobat);
                    $doc->exportCaption($this->rkd_hasil_pengobatan);
                    $doc->exportCaption($this->fp_putus_obat);
                    $doc->exportCaption($this->ket_putus_obat);
                    $doc->exportCaption($this->fp_ekonomi);
                    $doc->exportCaption($this->ket_masalah_ekonomi);
                    $doc->exportCaption($this->fp_masalah_fisik);
                    $doc->exportCaption($this->ket_masalah_fisik);
                    $doc->exportCaption($this->fp_masalah_psikososial);
                    $doc->exportCaption($this->ket_masalah_psikososial);
                    $doc->exportCaption($this->rh_keluarga);
                    $doc->exportCaption($this->ket_rh_keluarga);
                    $doc->exportCaption($this->resiko_bunuh_diri);
                    $doc->exportCaption($this->rbd_ide);
                    $doc->exportCaption($this->ket_rbd_ide);
                    $doc->exportCaption($this->rbd_rencana);
                    $doc->exportCaption($this->ket_rbd_rencana);
                    $doc->exportCaption($this->rbd_alat);
                    $doc->exportCaption($this->ket_rbd_alat);
                    $doc->exportCaption($this->rbd_percobaan);
                    $doc->exportCaption($this->ket_rbd_percobaan);
                    $doc->exportCaption($this->rbd_keinginan);
                    $doc->exportCaption($this->ket_rbd_keinginan);
                    $doc->exportCaption($this->rpo_penggunaan);
                    $doc->exportCaption($this->ket_rpo_penggunaan);
                    $doc->exportCaption($this->rpo_efek_samping);
                    $doc->exportCaption($this->ket_rpo_efek_samping);
                    $doc->exportCaption($this->rpo_napza);
                    $doc->exportCaption($this->ket_rpo_napza);
                    $doc->exportCaption($this->ket_lama_pemakaian);
                    $doc->exportCaption($this->ket_cara_pemakaian);
                    $doc->exportCaption($this->ket_latar_belakang_pemakaian);
                    $doc->exportCaption($this->rpo_penggunaan_obat_lainnya);
                    $doc->exportCaption($this->ket_penggunaan_obat_lainnya);
                    $doc->exportCaption($this->ket_alasan_penggunaan);
                    $doc->exportCaption($this->rpo_alergi_obat);
                    $doc->exportCaption($this->ket_alergi_obat);
                    $doc->exportCaption($this->rpo_merokok);
                    $doc->exportCaption($this->ket_merokok);
                    $doc->exportCaption($this->rpo_minum_kopi);
                    $doc->exportCaption($this->ket_minum_kopi);
                    $doc->exportCaption($this->td);
                    $doc->exportCaption($this->nadi);
                    $doc->exportCaption($this->gcs);
                    $doc->exportCaption($this->rr);
                    $doc->exportCaption($this->suhu);
                    $doc->exportCaption($this->pf_keluhan_fisik);
                    $doc->exportCaption($this->ket_keluhan_fisik);
                    $doc->exportCaption($this->skala_nyeri);
                    $doc->exportCaption($this->durasi);
                    $doc->exportCaption($this->nyeri);
                    $doc->exportCaption($this->provokes);
                    $doc->exportCaption($this->ket_provokes);
                    $doc->exportCaption($this->quality);
                    $doc->exportCaption($this->ket_quality);
                    $doc->exportCaption($this->lokasi);
                    $doc->exportCaption($this->menyebar);
                    $doc->exportCaption($this->pada_dokter);
                    $doc->exportCaption($this->ket_dokter);
                    $doc->exportCaption($this->nyeri_hilang);
                    $doc->exportCaption($this->ket_nyeri);
                    $doc->exportCaption($this->bb);
                    $doc->exportCaption($this->tb);
                    $doc->exportCaption($this->bmi);
                    $doc->exportCaption($this->lapor_status_nutrisi);
                    $doc->exportCaption($this->ket_lapor_status_nutrisi);
                    $doc->exportCaption($this->sg1);
                    $doc->exportCaption($this->nilai1);
                    $doc->exportCaption($this->sg2);
                    $doc->exportCaption($this->nilai2);
                    $doc->exportCaption($this->total_hasil);
                    $doc->exportCaption($this->resikojatuh);
                    $doc->exportCaption($this->bjm);
                    $doc->exportCaption($this->msa);
                    $doc->exportCaption($this->hasil);
                    $doc->exportCaption($this->lapor);
                    $doc->exportCaption($this->ket_lapor);
                    $doc->exportCaption($this->adl_mandi);
                    $doc->exportCaption($this->adl_berpakaian);
                    $doc->exportCaption($this->adl_makan);
                    $doc->exportCaption($this->adl_bak);
                    $doc->exportCaption($this->adl_bab);
                    $doc->exportCaption($this->adl_hobi);
                    $doc->exportCaption($this->ket_adl_hobi);
                    $doc->exportCaption($this->adl_sosialisasi);
                    $doc->exportCaption($this->ket_adl_sosialisasi);
                    $doc->exportCaption($this->adl_kegiatan);
                    $doc->exportCaption($this->ket_adl_kegiatan);
                    $doc->exportCaption($this->sk_penampilan);
                    $doc->exportCaption($this->sk_alam_perasaan);
                    $doc->exportCaption($this->sk_pembicaraan);
                    $doc->exportCaption($this->sk_afek);
                    $doc->exportCaption($this->sk_aktifitas_motorik);
                    $doc->exportCaption($this->sk_gangguan_ringan);
                    $doc->exportCaption($this->sk_proses_pikir);
                    $doc->exportCaption($this->sk_orientasi);
                    $doc->exportCaption($this->sk_tingkat_kesadaran_orientasi);
                    $doc->exportCaption($this->sk_memori);
                    $doc->exportCaption($this->sk_interaksi);
                    $doc->exportCaption($this->sk_konsentrasi);
                    $doc->exportCaption($this->sk_persepsi);
                    $doc->exportCaption($this->ket_sk_persepsi);
                    $doc->exportCaption($this->sk_isi_pikir);
                    $doc->exportCaption($this->sk_waham);
                    $doc->exportCaption($this->ket_sk_waham);
                    $doc->exportCaption($this->sk_daya_tilik_diri);
                    $doc->exportCaption($this->ket_sk_daya_tilik_diri);
                    $doc->exportCaption($this->kk_pembelajaran);
                    $doc->exportCaption($this->ket_kk_pembelajaran);
                    $doc->exportCaption($this->ket_kk_pembelajaran_lainnya);
                    $doc->exportCaption($this->kk_Penerjamah);
                    $doc->exportCaption($this->ket_kk_penerjamah_Lainnya);
                    $doc->exportCaption($this->kk_bahasa_isyarat);
                    $doc->exportCaption($this->kk_kebutuhan_edukasi);
                    $doc->exportCaption($this->ket_kk_kebutuhan_edukasi);
                    $doc->exportCaption($this->rencana);
                    $doc->exportCaption($this->nip);
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
                        $doc->exportField($this->id_penilaian_awal_keperawatan_ralan_psikiatri);
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->informasi);
                        $doc->exportField($this->keluhan_utama);
                        $doc->exportField($this->rkd_sakit_sejak);
                        $doc->exportField($this->rkd_keluhan);
                        $doc->exportField($this->rkd_berobat);
                        $doc->exportField($this->rkd_hasil_pengobatan);
                        $doc->exportField($this->fp_putus_obat);
                        $doc->exportField($this->ket_putus_obat);
                        $doc->exportField($this->fp_ekonomi);
                        $doc->exportField($this->ket_masalah_ekonomi);
                        $doc->exportField($this->fp_masalah_fisik);
                        $doc->exportField($this->ket_masalah_fisik);
                        $doc->exportField($this->fp_masalah_psikososial);
                        $doc->exportField($this->ket_masalah_psikososial);
                        $doc->exportField($this->rh_keluarga);
                        $doc->exportField($this->ket_rh_keluarga);
                        $doc->exportField($this->resiko_bunuh_diri);
                        $doc->exportField($this->rbd_ide);
                        $doc->exportField($this->ket_rbd_ide);
                        $doc->exportField($this->rbd_rencana);
                        $doc->exportField($this->ket_rbd_rencana);
                        $doc->exportField($this->rbd_alat);
                        $doc->exportField($this->ket_rbd_alat);
                        $doc->exportField($this->rbd_percobaan);
                        $doc->exportField($this->ket_rbd_percobaan);
                        $doc->exportField($this->rbd_keinginan);
                        $doc->exportField($this->ket_rbd_keinginan);
                        $doc->exportField($this->rpo_penggunaan);
                        $doc->exportField($this->ket_rpo_penggunaan);
                        $doc->exportField($this->rpo_efek_samping);
                        $doc->exportField($this->ket_rpo_efek_samping);
                        $doc->exportField($this->rpo_napza);
                        $doc->exportField($this->ket_rpo_napza);
                        $doc->exportField($this->ket_lama_pemakaian);
                        $doc->exportField($this->ket_cara_pemakaian);
                        $doc->exportField($this->ket_latar_belakang_pemakaian);
                        $doc->exportField($this->rpo_penggunaan_obat_lainnya);
                        $doc->exportField($this->ket_penggunaan_obat_lainnya);
                        $doc->exportField($this->ket_alasan_penggunaan);
                        $doc->exportField($this->rpo_alergi_obat);
                        $doc->exportField($this->ket_alergi_obat);
                        $doc->exportField($this->rpo_merokok);
                        $doc->exportField($this->ket_merokok);
                        $doc->exportField($this->rpo_minum_kopi);
                        $doc->exportField($this->ket_minum_kopi);
                        $doc->exportField($this->td);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->rr);
                        $doc->exportField($this->suhu);
                        $doc->exportField($this->pf_keluhan_fisik);
                        $doc->exportField($this->ket_keluhan_fisik);
                        $doc->exportField($this->skala_nyeri);
                        $doc->exportField($this->durasi);
                        $doc->exportField($this->nyeri);
                        $doc->exportField($this->provokes);
                        $doc->exportField($this->ket_provokes);
                        $doc->exportField($this->quality);
                        $doc->exportField($this->ket_quality);
                        $doc->exportField($this->lokasi);
                        $doc->exportField($this->menyebar);
                        $doc->exportField($this->pada_dokter);
                        $doc->exportField($this->ket_dokter);
                        $doc->exportField($this->nyeri_hilang);
                        $doc->exportField($this->ket_nyeri);
                        $doc->exportField($this->bb);
                        $doc->exportField($this->tb);
                        $doc->exportField($this->bmi);
                        $doc->exportField($this->lapor_status_nutrisi);
                        $doc->exportField($this->ket_lapor_status_nutrisi);
                        $doc->exportField($this->sg1);
                        $doc->exportField($this->nilai1);
                        $doc->exportField($this->sg2);
                        $doc->exportField($this->nilai2);
                        $doc->exportField($this->total_hasil);
                        $doc->exportField($this->resikojatuh);
                        $doc->exportField($this->bjm);
                        $doc->exportField($this->msa);
                        $doc->exportField($this->hasil);
                        $doc->exportField($this->lapor);
                        $doc->exportField($this->ket_lapor);
                        $doc->exportField($this->adl_mandi);
                        $doc->exportField($this->adl_berpakaian);
                        $doc->exportField($this->adl_makan);
                        $doc->exportField($this->adl_bak);
                        $doc->exportField($this->adl_bab);
                        $doc->exportField($this->adl_hobi);
                        $doc->exportField($this->ket_adl_hobi);
                        $doc->exportField($this->adl_sosialisasi);
                        $doc->exportField($this->ket_adl_sosialisasi);
                        $doc->exportField($this->adl_kegiatan);
                        $doc->exportField($this->ket_adl_kegiatan);
                        $doc->exportField($this->sk_penampilan);
                        $doc->exportField($this->sk_alam_perasaan);
                        $doc->exportField($this->sk_pembicaraan);
                        $doc->exportField($this->sk_afek);
                        $doc->exportField($this->sk_aktifitas_motorik);
                        $doc->exportField($this->sk_gangguan_ringan);
                        $doc->exportField($this->sk_proses_pikir);
                        $doc->exportField($this->sk_orientasi);
                        $doc->exportField($this->sk_tingkat_kesadaran_orientasi);
                        $doc->exportField($this->sk_memori);
                        $doc->exportField($this->sk_interaksi);
                        $doc->exportField($this->sk_konsentrasi);
                        $doc->exportField($this->sk_persepsi);
                        $doc->exportField($this->ket_sk_persepsi);
                        $doc->exportField($this->sk_isi_pikir);
                        $doc->exportField($this->sk_waham);
                        $doc->exportField($this->ket_sk_waham);
                        $doc->exportField($this->sk_daya_tilik_diri);
                        $doc->exportField($this->ket_sk_daya_tilik_diri);
                        $doc->exportField($this->kk_pembelajaran);
                        $doc->exportField($this->ket_kk_pembelajaran);
                        $doc->exportField($this->ket_kk_pembelajaran_lainnya);
                        $doc->exportField($this->kk_Penerjamah);
                        $doc->exportField($this->ket_kk_penerjamah_Lainnya);
                        $doc->exportField($this->kk_bahasa_isyarat);
                        $doc->exportField($this->kk_kebutuhan_edukasi);
                        $doc->exportField($this->ket_kk_kebutuhan_edukasi);
                        $doc->exportField($this->rencana);
                        $doc->exportField($this->nip);
                    } else {
                        $doc->exportField($this->id_penilaian_awal_keperawatan_ralan_psikiatri);
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->tanggal);
                        $doc->exportField($this->informasi);
                        $doc->exportField($this->rkd_sakit_sejak);
                        $doc->exportField($this->rkd_berobat);
                        $doc->exportField($this->rkd_hasil_pengobatan);
                        $doc->exportField($this->fp_putus_obat);
                        $doc->exportField($this->ket_putus_obat);
                        $doc->exportField($this->fp_ekonomi);
                        $doc->exportField($this->ket_masalah_ekonomi);
                        $doc->exportField($this->fp_masalah_fisik);
                        $doc->exportField($this->ket_masalah_fisik);
                        $doc->exportField($this->fp_masalah_psikososial);
                        $doc->exportField($this->ket_masalah_psikososial);
                        $doc->exportField($this->rh_keluarga);
                        $doc->exportField($this->ket_rh_keluarga);
                        $doc->exportField($this->resiko_bunuh_diri);
                        $doc->exportField($this->rbd_ide);
                        $doc->exportField($this->ket_rbd_ide);
                        $doc->exportField($this->rbd_rencana);
                        $doc->exportField($this->ket_rbd_rencana);
                        $doc->exportField($this->rbd_alat);
                        $doc->exportField($this->ket_rbd_alat);
                        $doc->exportField($this->rbd_percobaan);
                        $doc->exportField($this->ket_rbd_percobaan);
                        $doc->exportField($this->rbd_keinginan);
                        $doc->exportField($this->ket_rbd_keinginan);
                        $doc->exportField($this->rpo_penggunaan);
                        $doc->exportField($this->ket_rpo_penggunaan);
                        $doc->exportField($this->rpo_efek_samping);
                        $doc->exportField($this->ket_rpo_efek_samping);
                        $doc->exportField($this->rpo_napza);
                        $doc->exportField($this->ket_rpo_napza);
                        $doc->exportField($this->ket_lama_pemakaian);
                        $doc->exportField($this->ket_cara_pemakaian);
                        $doc->exportField($this->ket_latar_belakang_pemakaian);
                        $doc->exportField($this->rpo_penggunaan_obat_lainnya);
                        $doc->exportField($this->ket_penggunaan_obat_lainnya);
                        $doc->exportField($this->ket_alasan_penggunaan);
                        $doc->exportField($this->rpo_alergi_obat);
                        $doc->exportField($this->ket_alergi_obat);
                        $doc->exportField($this->rpo_merokok);
                        $doc->exportField($this->ket_merokok);
                        $doc->exportField($this->rpo_minum_kopi);
                        $doc->exportField($this->ket_minum_kopi);
                        $doc->exportField($this->td);
                        $doc->exportField($this->nadi);
                        $doc->exportField($this->gcs);
                        $doc->exportField($this->rr);
                        $doc->exportField($this->suhu);
                        $doc->exportField($this->pf_keluhan_fisik);
                        $doc->exportField($this->ket_keluhan_fisik);
                        $doc->exportField($this->skala_nyeri);
                        $doc->exportField($this->durasi);
                        $doc->exportField($this->nyeri);
                        $doc->exportField($this->provokes);
                        $doc->exportField($this->ket_provokes);
                        $doc->exportField($this->quality);
                        $doc->exportField($this->ket_quality);
                        $doc->exportField($this->lokasi);
                        $doc->exportField($this->menyebar);
                        $doc->exportField($this->pada_dokter);
                        $doc->exportField($this->ket_dokter);
                        $doc->exportField($this->nyeri_hilang);
                        $doc->exportField($this->ket_nyeri);
                        $doc->exportField($this->bb);
                        $doc->exportField($this->tb);
                        $doc->exportField($this->bmi);
                        $doc->exportField($this->lapor_status_nutrisi);
                        $doc->exportField($this->ket_lapor_status_nutrisi);
                        $doc->exportField($this->sg1);
                        $doc->exportField($this->nilai1);
                        $doc->exportField($this->sg2);
                        $doc->exportField($this->nilai2);
                        $doc->exportField($this->total_hasil);
                        $doc->exportField($this->resikojatuh);
                        $doc->exportField($this->bjm);
                        $doc->exportField($this->msa);
                        $doc->exportField($this->hasil);
                        $doc->exportField($this->lapor);
                        $doc->exportField($this->ket_lapor);
                        $doc->exportField($this->adl_mandi);
                        $doc->exportField($this->adl_berpakaian);
                        $doc->exportField($this->adl_makan);
                        $doc->exportField($this->adl_bak);
                        $doc->exportField($this->adl_bab);
                        $doc->exportField($this->adl_hobi);
                        $doc->exportField($this->ket_adl_hobi);
                        $doc->exportField($this->adl_sosialisasi);
                        $doc->exportField($this->ket_adl_sosialisasi);
                        $doc->exportField($this->adl_kegiatan);
                        $doc->exportField($this->ket_adl_kegiatan);
                        $doc->exportField($this->sk_penampilan);
                        $doc->exportField($this->sk_alam_perasaan);
                        $doc->exportField($this->sk_pembicaraan);
                        $doc->exportField($this->sk_afek);
                        $doc->exportField($this->sk_aktifitas_motorik);
                        $doc->exportField($this->sk_gangguan_ringan);
                        $doc->exportField($this->sk_proses_pikir);
                        $doc->exportField($this->sk_orientasi);
                        $doc->exportField($this->sk_tingkat_kesadaran_orientasi);
                        $doc->exportField($this->sk_memori);
                        $doc->exportField($this->sk_interaksi);
                        $doc->exportField($this->sk_konsentrasi);
                        $doc->exportField($this->sk_persepsi);
                        $doc->exportField($this->ket_sk_persepsi);
                        $doc->exportField($this->sk_isi_pikir);
                        $doc->exportField($this->sk_waham);
                        $doc->exportField($this->ket_sk_waham);
                        $doc->exportField($this->sk_daya_tilik_diri);
                        $doc->exportField($this->ket_sk_daya_tilik_diri);
                        $doc->exportField($this->kk_pembelajaran);
                        $doc->exportField($this->ket_kk_pembelajaran);
                        $doc->exportField($this->ket_kk_pembelajaran_lainnya);
                        $doc->exportField($this->kk_Penerjamah);
                        $doc->exportField($this->ket_kk_penerjamah_Lainnya);
                        $doc->exportField($this->kk_bahasa_isyarat);
                        $doc->exportField($this->kk_kebutuhan_edukasi);
                        $doc->exportField($this->ket_kk_kebutuhan_edukasi);
                        $doc->exportField($this->rencana);
                        $doc->exportField($this->nip);
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
