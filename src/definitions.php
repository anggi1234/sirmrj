<?php

namespace PHPMaker2021\project4sikdec;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        $loggers[] = $c->get("debugsqllogger");
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "bahasa_pasien" => \DI\create(BahasaPasien::class),
    "cacat_fisik" => \DI\create(CacatFisik::class),
    "detail_periksa_lab" => \DI\create(DetailPeriksaLab::class),
    "jns_perawatan" => \DI\create(JnsPerawatan::class),
    "jns_perawatan_lab" => \DI\create(JnsPerawatanLab::class),
    "jns_perawatan_radiologi" => \DI\create(JnsPerawatanRadiologi::class),
    "kabupaten" => \DI\create(Kabupaten::class),
    "kecamatan" => \DI\create(Kecamatan::class),
    "kelurahan" => \DI\create(Kelurahan::class),
    "m_dokter" => \DI\create(MDokter::class),
    "m_icd9" => \DI\create(MIcd9::class),
    "m_pasien" => \DI\create(MPasien::class),
    "m_penyakit" => \DI\create(MPenyakit::class),
    "m_tindakan" => \DI\create(MTindakan::class),
    "pemeriksaan_ginekologi_ralan" => \DI\create(PemeriksaanGinekologiRalan::class),
    "pemeriksaan_obstetri_ralan" => \DI\create(PemeriksaanObstetriRalan::class),
    "pemeriksaan_ralan" => \DI\create(PemeriksaanRalan::class),
    "penjab" => \DI\create(Penjab::class),
    "perusahaan_pasien" => \DI\create(PerusahaanPasien::class),
    "propinsi" => \DI\create(Propinsi::class),
    "suku_bangsa" => \DI\create(SukuBangsa::class),
    "userlogin" => \DI\create(Userlogin::class),
    "userlevels" => \DI\create(Userlevels::class),
    "userlevelpermissions" => \DI\create(Userlevelpermissions::class),
    "nota_jalan" => \DI\create(NotaJalan::class),
    "penilaian_awal_keperawatan_ralan" => \DI\create(PenilaianAwalKeperawatanRalan::class),
    "penilaian_medis_ralan" => \DI\create(PenilaianMedisRalan::class),
    "master_pasien" => \DI\create(MasterPasien::class),
    "agama" => \DI\create(Agama::class),
    "bayi_lahir" => \DI\create(BayiLahir::class),
    "cara_bayar" => \DI\create(CaraBayar::class),
    "jenis_kelamin" => \DI\create(JenisKelamin::class),
    "pekerjaan" => \DI\create(Pekerjaan::class),
    "pendidikan" => \DI\create(Pendidikan::class),
    "status_kawin" => \DI\create(StatusKawin::class),
    "catatan_medis" => \DI\create(CatatanMedis::class),
    "pasien_kunjungan" => \DI\create(PasienKunjungan::class),
    "pmeriksaan_fisik" => \DI\create(PmeriksaanFisik::class),
    "table_user" => \DI\create(TableUser::class),
    "user" => \DI\create(User::class),
    "Dashboard2" => \DI\create(Dashboard2::class),
    "Jml_Pasien" => \DI\create(JmlPasien::class),
    "Report1" => \DI\create(Report1::class),
    "reg_periksa" => \DI\create(RegPeriksa::class),
    "pasien" => \DI\create(Pasien::class),
    "vrajal" => \DI\create(Vrajal::class),
    "vriwayat" => \DI\create(Vriwayat::class),
    "asuhan_gizi" => \DI\create(AsuhanGizi::class),
    "catatan_pasien" => \DI\create(CatatanPasien::class),
    "catatan_perawatan" => \DI\create(CatatanPerawatan::class),
    "penilaian_medis_igd" => \DI\create(PenilaianMedisIgd::class),
    "penilaian_medis_ralan_anak" => \DI\create(PenilaianMedisRalanAnak::class),
    "poliklinik" => \DI\create(Poliklinik::class),
    "penilaian_awal_keperawatan_ralan_psikiatri" => \DI\create(PenilaianAwalKeperawatanRalanPsikiatri::class),
    "penilaian_psikologi" => \DI\create(PenilaianPsikologi::class),
    "diagnosa_pasien" => \DI\create(DiagnosaPasien::class),
    "penyakit" => \DI\create(Penyakit::class),
    "tindak_lanjut" => \DI\create(TindakLanjut::class),
    "vigd" => \DI\create(Vigd::class),
    "konsul" => \DI\create(Konsul::class),
    "cppt" => \DI\create(Cppt::class),
    "billing" => \DI\create(Billing::class),
    "resep_obat" => \DI\create(ResepObat::class),
    "resep_dokter" => \DI\create(ResepDokter::class),
    "prmrj" => \DI\create(Prmrj::class),
    "vhistory" => \DI\create(Vhistory::class),
    "laporan" => \DI\create(Laporan::class),

    // User table
    "usertable" => \DI\get("userlogin"),
];
