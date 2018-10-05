<?php
include 'inc/header.php';


if (!isset($_GET['category']) || $_GET['category'] == NULL){
	header('Location: 404.php');
} else {
	$id = $_GET['category'];
}

?>

<?php include 'inc/slider.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		<?php
			$query = "SELECT * FROM tbl_post WHERE cat=$id";
			$category = $db->select($query);
			if($category){
				while ($result = $category->fetch_assoc()){ ?>
            <div class="samepost clear">
                <h2><a href="post.php?id=<?php echo $result['id'];?>"> <?php echo $result['title']; ?></a></h2>
                <h4><?php echo $format->dateFormat($result['date']); ?>, By <a href="#">Delowar</a></h4>
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
		<?php } else { ?>
			
			 <h3> No post available in this category</h3>
		<?php } 
			?>
	</div>

<?php include 'inc/footer.php'; ?>

