<?php

namespace PHPMaker2021\project4sikdec;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(52, "mi_Dashboard2", $MenuLanguage->MenuPhrase("52", "MenuText"), $MenuRelativePath . "Dashboard2", -1, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}Dashboard'), false, false, "fas fa-tachometer-alt", "", false);
$sideMenu->addMenuItem(11, "mci_Pendaftaran", $MenuLanguage->MenuPhrase("11", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa fa-user-plus", "", false);
$sideMenu->addMenuItem(75, "mci_Pasien_Baru", $MenuLanguage->MenuPhrase("75", "MenuText"), $MenuRelativePath . "PasienAdd", 11, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(101, "mci_Rawat_Jalan", $MenuLanguage->MenuPhrase("101", "MenuText"), $MenuRelativePath . "VrajalAdd", 11, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(102, "mci_IGD", $MenuLanguage->MenuPhrase("102", "MenuText"), $MenuRelativePath . "VigdAdd", 11, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(57, "mi_pasien", $MenuLanguage->MenuPhrase("57", "MenuText"), $MenuRelativePath . "PasienList", 11, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}pasien'), false, false, "", "", false);
$sideMenu->addMenuItem(78, "mci_Kunjungan", $MenuLanguage->MenuPhrase("78", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa fa-stethoscope", "", false);
$sideMenu->addMenuItem(79, "mi_vrajal", $MenuLanguage->MenuPhrase("79", "MenuText"), $MenuRelativePath . "VrajalList", 78, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}vrajal'), false, false, "", "", false);
$sideMenu->addMenuItem(118, "mi_vigd", $MenuLanguage->MenuPhrase("118", "MenuText"), $MenuRelativePath . "VigdList", 78, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}vigd'), false, false, "", "", false);
$sideMenu->addMenuItem(104, "mi_vriwayat", $MenuLanguage->MenuPhrase("104", "MenuText"), $MenuRelativePath . "VriwayatList", 78, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}vriwayat'), false, false, "", "", false);
$sideMenu->addMenuItem(80, "mci_Laporan", $MenuLanguage->MenuPhrase("80", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fas fa-file-alt", "", false);
$sideMenu->addMenuItem(53, "mi_Jml_Pasien", $MenuLanguage->MenuPhrase("53", "MenuText"), $MenuRelativePath . "JmlPasienList", 80, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}Jml_Pasien'), false, false, "", "", false);
$sideMenu->addMenuItem(76, "mci_Master", $MenuLanguage->MenuPhrase("76", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa fa-folder-open", "", false);
$sideMenu->addMenuItem(56, "mi_m_penyakit", $MenuLanguage->MenuPhrase("56", "MenuText"), $MenuRelativePath . "MPenyakitList", 76, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}m_penyakit'), false, false, "", "", false);
$sideMenu->addMenuItem(38, "mci_Setting", $MenuLanguage->MenuPhrase("38", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa fa-cogs", "", false);
$sideMenu->addMenuItem(23, "mi_userlogin", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "UserloginList", 38, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}userlogin'), false, false, "", "", false);
$sideMenu->addMenuItem(24, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "UserlevelpermissionsList", 38, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}userlevelpermissions'), false, false, "", "", false);
$sideMenu->addMenuItem(25, "mi_userlevels", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "UserlevelsList", 38, "", AllowListMenu('{32D7105C-03CC-4C1F-9991-3D2A48D20516}userlevels'), false, false, "", "", false);
echo $sideMenu->toScript();
