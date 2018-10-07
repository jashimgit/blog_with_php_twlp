<?php
include 'inc/header.php';


if (!isset($_POST['search']) || $_POST['search'] == NULL){
	header('Location: 404.php');
} else {
	$searchKeyword = $_POST['search'];
}

?>



	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		<?php
			$query = "SELECT * FROM tbl_post 
					  WHERE title 
					  LIKE '%$searchKeyword%' 
					  OR body 
					  LIKE '%$searchKeyword%' ";

			$post = $db->select($query);
			
			if($post){
				while ($result = $post->fetch_assoc()){ ?>
            <div class="samepost clear">
                <h2><a href="post.php?id=<?php echo $result['id'];?>"> <?php echo $result['title']; ?></a></h2>
                <h4><?php echo $format->dateFormat($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
                <a href="post.php?id=<?php echo $result['id']; ?>">
                    <img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
                </a>
                <p> <?php echo $format->textShort($result['body']); ?>	</p>
                <div class="readmore clear">
                    <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                </div>
            </div>
	            <?php 	} // end of while loop 	?>
        </div>
		<?php include 'inc/sidebar.php' ; ?>
		<?php } else { echo " No post found !! "; } ?>
	</div>

<?php include 'inc/footer.php'; ?>

