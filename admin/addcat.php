<?php
include_once  'inc/header.php';
include_once  'inc/sidebar.php';
?>
<div class="grid_10">

<div class="box round first grid">
    <h2>Add New Category</h2>
   <div class="block copyblock"> 
     <form action="addcat.php" method="post" >
        <table class="form">	

        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['cat_name'];   
            if(empty($name)){
                echo "<span class='error'> Field must not be empty !!  </span>";
            } else {
                $query = "INSERT INTO tbl_category (cat_name) VALUES ('$name')";
                $catInsert = $db->insert($query);
                if ($catInsert) {
                    echo "<span class='success'>Data Inserted Successfully !!  </span>";
                } else {
                    echo "<span class='error'> Data not insserted </span>";
                }
            }
        }
        ?>				
            <tr>
                <td>
                    <input type="text"  name="cat_name" placeholder="Enter Category Name..." class="medium" />
                </td>
            </tr>
			<tr> 
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>
</div>
<?php include_once  'inc/footer.php'?>
