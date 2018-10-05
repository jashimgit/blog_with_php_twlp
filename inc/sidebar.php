<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
                        <?php

                        $query = "SELECT * FROM tbl_category";
                        $category = $db->select($query);
                        if ($category){
                            while ($result = $category->fetch_assoc()){   ?>

                                <li><a href="posts.php?category=<?php echo $result['id'];?>"><?php echo  $result['cat_name'];?> </a></li>

                        <?php
                            }
                        } else {
                            echo "<li> No Category created </li>";
                        }
                        ?>

					</ul>
			</div>

	    <div class="samesidebar clear">
				<h2>Latest articles</h2>
				<?php
				$query = "SELECT * FROM tbl_post LIMIT 4";
				$posts = $db->select($query);
				if($posts){
				    while ($result = $posts->fetch_assoc()){

				?>
                <div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
						<a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
						<p><?php echo $format->textShort($result['body'], 120); ?></p>
					</div>


        <?php } } else {	header('Location: 404.php'); } ?>
			</div>
			
		</div>