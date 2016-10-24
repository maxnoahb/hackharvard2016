<!DOCTYPE html>
<link href="styles.css" rel="stylesheet"/>
<html>
	<div class="container">
	<div class="page-header">
        <h1><img src="logo.png" alt="KMKitchen" width=350 height=100></h1>
    </div>

	<h1>Search Results</h1>
	<?php require("robert.php"); ?>
		<style>
			ul {
    			margin: 0 auto;
    			text-align: center;
			}

			li {
				line-height: 14px;
    			padding: 14px;
    			display: inline-block;
    			vertical-align: top;
			}
		</style>
		<ul>
			
			<?php foreach($data["hits"] as $hit):?>
				<li>
				<div style = "word-wrap: break-word; width: 250px">
					<h1><font size="4"><?php echo "<a href='" .$hit["recipe"]["url"]."'> ".$hit["recipe"]["label"]." </a>" ?></font></h1>
				</div>
				<img src="<?php echo $hit["recipe"]["image"] ?>" width="256" height="256"></img>
				</li>
			<?php endforeach; ?>

		</ul>
	</div>
</html>