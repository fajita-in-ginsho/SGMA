<html>
<title>Online Tournament Management System</title>

<body>
<h1>First View <?php echo html_escape($title); ?></h1>
<h2>OTMS main body<?php echo html_escape($heading); ?></h2>

<ol>

<?php foreach($todo as $item){ ?>
<li><?php echo html_escape($item); ?></li>
<?php }?>

<?php
 
foreach($todo as $item){ 
	echo "<li>" . html_escape($item) . "</li>";
}

?>



</ol>

</body>
</html>
