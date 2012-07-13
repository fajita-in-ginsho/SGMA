<html>
<title>SGMA</title>

<body>
<h1>First View <?php echo $title; ?></h1>
<h2>SGMA main body<?php echo $heading; ?></h2>

<ol>

<?php foreach($todo as $item){ ?>
<li><?php echo $item; ?></li>
<?php }?>

<?php
 
foreach($todo as $item){ 
	echo "<li>" . $item . "</li>";
}

?>



</ol>

</body>
</html>
