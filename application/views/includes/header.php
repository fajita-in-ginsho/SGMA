<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>
<?php if(isset($title)){echo html_escape($title);} else { echo "untitled";} ?>
</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css"
    type="text/css" 
    media="screen" 
    charset="utf-8" />

<!-- uncompressed version for debugging -->
<!-- 
<script src="http://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js.uncompressed.js" djConfig="parseOnLoad:true"></script>
 -->
 <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js" djConfig="parseOnLoad:true"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dijit/themes/claro/claro.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dojox/grid/resources/Grid.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dojox/grid/resources/claroGrid.css" />      

<link rel="styleheet" href="dojox/widget/Toaster/Toaster.css" />
    
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/import_requirement.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/common.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/app/tournament.js"></script>

</head>
<body class="claro">


