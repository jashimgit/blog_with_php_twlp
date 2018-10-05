<?php
include_once  'inc/header.php';
include_once  'inc/sidebar.php';
?>

<?php
if (!isset($_GET['catid']) || $_GET['catid'] == null){
    header('Location:catlist.php');
} else {
    $id = $_GET['catid'];
}
?>
<div class="grid_10">

<div class="box round first grid">
    <h2>Update Category</h2>
   <div class="block copyblock"> 
     <form action="" method="post" >
        <table class="form">	

        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['cat_name'];   
            if(empty($name)){
                echo "<span class='error'> Field must not be empty !!  </span>";
            } else {
                $query = "UPDATE tbl_category 
                          SET 
                          cat_name = '$name' 
                          WHERE id ='$id'";

                $update_row = $db->update($query);

                if ($update_row) {
                    echo "<span class='success'>Data Updated Successfully !!  </span>";
                } else {
                    echo "<span class='error'> Error !! Data Not Updated !! </span>";
                }
            }
        }
        ?>

            <?php
            $query = "SELECT * FROM tbl_category WHERE id='$id'";
            $data = $db->select($query);
            while ($result = $data->fetch_assoc()){

            ?>
            <tr>
                <td>
                    <input type="text"  name="cat_name" value="<?php echo $result['cat_name']; ?>" class="medium" />
                </td>
            </tr>
			<tr> 
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
            <?php } ?>
        </table>
        </form>
    </div>
</div>
</div>
<?php include_once  'inc/footer.php'?>
