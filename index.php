<?php
	include'../header.php';
?>
	<div id="content">
		<?php 
		$sql = "SELECT * FROM categories ORDER BY category_title ASC";
		$res = mysql_query($sql) or die(mysql_error());
		$categories = "";

		if(mysql_num_rows($res) > 0){

			while($row = mysql_fetch_assoc($res)){
				$id = $row['id'];
				$title = $row['category_title'];
				$description = $row['category_description'];
				$categories .=  "<a href='view_category.php?cid=".$id."' class='cat_links'>".$title." - <font size='-1'>".$description."</font></a>";

			}
				echo $categories;
		}else{
			echo "<p>There are no categories available yet!</p>";
		}
		?>
	</div>
<?php
	include'../footer.php';
?>
