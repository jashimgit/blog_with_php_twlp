<?php include "inc/header.php";

if (!isset($_GET['id']) || $_GET['id'] == NULL){
    header('Location: 404.php');
} else {
    $id = $_GET['id'];
}

?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
            <?php
                $query = "select * from tbl_post where id=$id";
            $posts = $db->select($query);
            if($posts){
                while ($result = $posts->fetch_assoc()){
            ?>

			<h2> <?php echo $result['title']; ?></h2>
			<h4><?php echo $format->dateFormat($result['date']); ?>, By Delowar</h4>
                <img src="admin/<?php echo $result['image']; ?>" alt="post image"/>

			<?php echo $result['body'];?>
                    <div class="relatedpost clear">
                    <h2>Related articles</h2>
                    <?php
                        $catid = $result['cat'];
                        $catQuery = "select * from tbl_post WHERE  cat ='$catid' limit 6 ";
                        $relatedPost = $db->select($catQuery);

                    if ($relatedPost){
                        while ($rresult= $relatedPost->fetch_assoc()) {
                    ?>

                    <a href="post.php?id=<?php echo $rresult['id']; ?>">
                        <img src="admin/<?php echo $rresult['image']; ?>" alt="post image"/>
                    </a>
                   <?php } } else { echo "No related post !!"; } ?>

                </div>
			<?php } } else { header('Location: 404.php'); }?>
        </div>

    </div>
	<?php include 'inc/sidebar.php'?>
</div>

	<?php include "inc/footer.php";?>
