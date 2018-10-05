<?php 
include 'inc/header.php'; 

// pagination code 

$per_page = 3;

if(isset($_GET['page'])){
	$page = $_GET['page'];
} else {
	$page = 1 ;
}

$start_from = ($page-1) * $per_page;

?>

<?php include 'inc/slider.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		<?php 
			$query = "SELECT * FROM tbl_post LIMIT $start_from, $per_page";
			$posts = $db->select($query);
			if($posts){
				while ($result = $posts->fetch_assoc()){

		?>			
	<div class="samepost clear">
		<h2><a href="post.php?id=<?php echo $result['id'];?>"> <?php echo $result['title']; ?></a></h2>
		<h4><?php echo $format->dateFormat($result['date']); ?>, By <a href="#"><?php echo $result['author'];?></a></h4>
		<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
		<p> <?php echo $format->textShort($result['body']); ?>	</p>
		<div class="readmore clear">
			<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
		</div>
	</div>
	<?php
	
	} // end of while loop 
	?>
<!-- pagination -->
<?php
    $query = "SELECT * FROM tbl_post";
    $result = $db->select($query);
    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil( $total_rows / $per_page );

    echo "<span class='pagination'> <a href='index.php?page=1'> First page </a>" ;

    for ($i= 1 ; $i<=$total_pages; $i++ ){
        echo "<a href='index.php?page=".$i. "'> ".$i."</a>";
    }
    echo "<a href='index.php?page=$total_pages'> Last page </a></span>"

?>
<!-- pagination -->

		</div>
		<?php include 'inc/sidebar.php' ; ?>
<?php 	
	} else{
	echo "<h3 class='error'>No Post available</h3>";
}

?>
	</div>

<?php include 'inc/footer.php'; ?>

