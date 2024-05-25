<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @author Factoriels Sarl
 * @since 1.0
 **/

$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<script src="https://jsuites.net/v4/jsuites.js"></script>
  <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.css" type="text/css" />

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
  <!--begin::Theme mode setup on page load-->
  <script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if (localStorage.getItem("data-bs-theme") !== null) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
  <!--end::Theme mode setup on page load-->


  <?php $this->beginBody() ?>

  <?= $this->render('user_component/header.php', ['baseUrl' => $baseUrl]) ?>


  <?= $this->render('user_component/content.php', ['content' => $content]) ?>




  <?php
  //    Charger quelques elements de validation
  require_once(\Yii::$app->basePath . '/extensions/clientValidator/clientSideScript.php');
  require_once(\Yii::$app->basePath . '/extensions/msg/popupMsg.php');
  ?>
  
  <script>

    function message(msg, type) {

      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };

      if (type == 'attention') {
        toastr.warning(msg);

      } else if (type == 'success') {
        toastr.success(msg);

      } else if (type == 'error') {
        toastr.error(msg);

      } else if (type == 'info') {
        toastr.info(msg);

      }


      return toastr;
    }

  </script>

  <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
