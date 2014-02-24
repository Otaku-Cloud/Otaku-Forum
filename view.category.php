<?php
	include'../header.php';
?>
	<div id="content">

		<?php

			$cid = $_GET['cid'];

			if(loggedin() == true && isset($_SESSION['cid'])){
				$logged = " | <a href='create_topic.php?cid=".$cid."'>Create Topic</a>";
			}else{
				$logged = " | Please log in to create forum topics!";
			}

			$sql = "SELECT id FROM categories WHERE id='".$cid."'LIMIT 1";
			$res = mysql_query($sql) or die(mysql_error());

			if(mysql_num_rows($res) == 1){

				$sql2 = "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC";
				$res2 = mysql_query($sql2) or die(mysql_error());

				if(mysql_num_rows($res2) > 0){

					$topics .= "<table width='100%' style='border-collapse: collapse;'>";
					$topics .= "<tr><td colspan='3'><a href='index.php'>Return</a>".$logged."<hr /></td></tr>";
					$topics .= "<tr style='background-color: #dddddd;'><td>Topic Title</td><td width='65' align='center'>Replies</td><td width='65' align='center'>Views</td></tr>";
					$topics .= "<tr><td colspan='3'><hr /></td></tr>";

					while($row = mysql_fetch_assoc($res2)){
						$tid = $row['id'];
						$title = $row['topic_title'];
						$views = $row['topic_views'];
						$date = $row['topic_date'];
						$creator = $row['topic_creator'];

						$topics .= "<tr><td><a href='view_topic.php?cid=".$cid."&tid=".$tid."'>".$title."</a><br><span class='post_info'>Posted by: ".$creator." on ".$date."</span></td><td> align='center'>0</td><td align='center'>".$views."</td></tr>";
						$topics .= "<tr><td colspan='3'><hr /></td></tr>";
					}

					$topics .= "</table>";

				}else{
					echo "<a href='index.php'>Return</a><hr />";
					echo "<p>There are currently no topics.".$logged."</p>";
				}

			}else{
				echo "<a href='index.php'>Return</a><hr />";
				echo "<p>You are trying to view something that doesn't exist!";
			}
		?>

	</div>

<?php
	include'../footer.php';
?>
