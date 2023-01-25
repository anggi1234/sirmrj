<?php

namespace PHPMaker2021\project4sikdec;

// Dashboard Page object
$Dashboard2 = $Page;
?>
<script>
var currentForm, currentPageID;
var fdashboard;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "dashboard";
    fdashboard = currentForm = new ew.Form("fdashboard", "dashboard");
    loadjs.done("fdashboard");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar"></div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard ew-vertical">
<div class="row">
<div class="<?= $Page->ItemClassNames[0] ?>">
<div id="Item1" class="card">
<div class="card-header">
    <h3 class="card-title"><?= $Language->chartPhrase("Report1", "JumlahPasien", "ChartCaption") ?></h3>
    <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$Report1 = Container("Report1");
$Report1->JumlahPasien->Width = 0;
$Report1->JumlahPasien->Height = 0;
$Report1->JumlahPasien->setParameter("clickurl", "Report1"); // Add click URL
$Report1->JumlahPasien->DrillDownUrl = ""; // No drill down for dashboard
$Report1->JumlahPasien->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
