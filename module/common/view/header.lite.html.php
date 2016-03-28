<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$webRoot      = $this->app->getWebRoot();
$jsRoot       = $webRoot . "js/";
$themeRoot    = $webRoot . "theme/";
$defaultTheme = $webRoot . 'theme/default/';
$langTheme    = $themeRoot . 'lang/' . $app->getClientLang() . '.css';
$clientTheme  = $this->app->getClientTheme();
?>
<!DOCTYPE html>
<html lang='<?php echo $app->getClientLang();?>'>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name="renderer" content="webkit"> 
  <?php
  echo html::title($title . ' - ' . $lang->zentaoPMS);

  js::exportConfigVars();
  if($config->debug)
  {
      js::import($jsRoot . 'jquery/lib.js');
      js::import($jsRoot . 'zui/min.js');
      js::import($jsRoot . 'my.min.js');

      css::import($themeRoot . 'zui/css/min.css');
      css::import($defaultTheme . 'style.css');

      css::import($langTheme);
      if(strpos($clientTheme, 'default') === false) css::import($clientTheme . 'style.css');
  }
  else
  {
      js::import($jsRoot . 'all.js');
      css::import($defaultTheme . $this->cookie->lang . '.' . $this->cookie->theme . '.css');
  }

  if(isset($pageCSS)) css::internal($pageCSS);

  echo html::favicon($webRoot . 'favicon.ico');
  ?>
<!--[if lt IE 9]>
<?php
js::import($jsRoot . 'html5shiv/min.js');
js::import($jsRoot . 'respond/min.js');
?>
<![endif]-->
<!--[if lt IE 10]>
<?php js::import($jsRoot . 'jquery/placeholder/min.js'); ?>
<![endif]-->
</head>
<body>
