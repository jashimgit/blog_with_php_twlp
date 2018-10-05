<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<div class="grid_10">
<div class="box round first grid">
    <h2>Post List</h2>
    <div class="block">  
        <table class="data display datatable" id="example">
		<thead>
			<tr>
				<th width="5%">Serial</th>
				<th width="15%">Post Title</th>
				<th width="15%">Description</th>
				<th width="10%">Category</th>
				<th width="10%">Image</th>
				<th width="10%">Author</th>
				<th width="10%">Tags</th>
				<th width="10%">Date</th>
				<th width="10%">Action</th>
			</tr>
		</thead>
		<tbody>
        <?php
            $query = "SELECT tbl_post.*, tbl_category.cat_name FROM tbl_post 
                      INNER JOIN tbl_category 
                      ON tbl_post.cat = tbl_category.id 
                      ORDER BY tbl_post.title DESC ";
            $post = $db->select($query);
            if ($post){
                $i = 0;
                while ($result = $post->fetch_assoc()){
                    $i++;

        ?>
			<tr class="odd gradeX">
				<td class="center"><?php echo $i; ?></td>
				<td><?php echo $result['title'];?></td>
				<td><?php echo $fm->textShort($result['body'], 130);?></td>
				<td class="center"> <?php echo $result['cat_name'];?></td>
                <td><img src="<?php echo $result['image'];?>" height="60px" width="60px" /> </td>
                <td class="center"><?php echo $result['author'];?></td>
                <td class="center"><?php echo $result['tags'];?></td>
                <td class="center"> <?php echo $fm->dateFormat($result['date']);?></td>
				<td>
                    <a href="editpost.php?id=<?php echo $result['id'];?>">Edit</a>
                    ||
                    <a href="deletepost.php?id=<?php echo $result['id'];?>">Delete</a>

                </td>
			</tr>
        <?php  } } ?>
		</tbody>
	</table>

   </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

        <?php include_once 'inc/footer.php';?>