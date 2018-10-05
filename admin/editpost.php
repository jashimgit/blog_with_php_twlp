
<?php include_once  'inc/header.php'?>
<?php include_once  'inc/sidebar.php'?>
<?php
if (!isset($_GET['id']) || $_GET['id'] == null){
    header('Location:postlist.php');
} else {
    $id = $_GET['id'];
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">


<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cat    = mysqli_real_escape_string($db->link, $_POST['cat']);
    $title  = mysqli_real_escape_string($db->link,  $_POST['title']);
    $body   = mysqli_real_escape_string($db->link, $_POST['body']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);

    $permited = array('jpg', 'jpeg', 'png', 'gif');

    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div            = explode('.', $file_name);
    $file_ext       = strtolower(end($div));
    $unique_image   = substr(md5(time()), 0, 10).'.'.$file_name;
    $uploaded_image = "upload/".$unique_image;

    if ($cat == ""      ||
        $title == ""    ||
        $body == ""     ||
        $author == ""   ||
        $tags == ""     
        ){
	    echo "<span class='error'>Field must not be empty !!  </span>";
    } else {
        if(!empty($file_name)){
            if ($file_size > 1048567){
                echo "<span class='error'>Image size should be less than 1 MB! </span>";
            } elseif (in_array($file_ext, $permited) == false){
                echo "<span class='error'>File support only ".implode(',', $permited)." </span>";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_post SET 
                    cat    = '$cat',            
                    title  = '$title',
                    body   = '$body',
                    image  = '$uploaded_image',
                    author = '$author',
                    tags   = '$tags' 
                    
                    WHERE id = $id
                    ";      
                
                    $updated_rows = $db->update($query);

                    if ($updated_rows){
                        echo "<span class='error'>Data Updated successfully </span>";
                    } else {
                        echo "<span class='error'>data not Updated successfully</span>";
                    }
                }
            } else {
                $query = "UPDATE tbl_post SET 
                cat    = '$cat',            
                title  = '$title',
                body   = '$body',
                author = '$author',
                tags   = '$tags' 
                
                WHERE id = $id
                ";      
        

        $updated_rows = $db->update($query);

            if ($updated_rows){
                echo "<span class='error'>Data Updated successfully </span>";
            } else {
                echo "<span class='error'>data not Updated successfully</span>";
            }
        }
    }        
 }
?>
<?php
// Fetch post from Database to Update post

$query = "SELECT * FROM tbl_post WHERE id=$id";
$getpost = $db->select($query);
while($singlePost = $getpost->fetch_assoc()){ ?>
        <table class="form">

            <tr>
                <td><label>Title</label></td>
                <td>
                    <input type="text" name="title" value="<?php echo $singlePost['title']; ?>" class="medium" />
                </td>
            </tr>

            <tr>
                <td><label>Category</label></td>
                <td>
                    <select id="select" name="cat">
                        <option>Select Category</option>
            <?php
            $query = "SELECT * FROM tbl_category";
            $data = $db->select($query);
            while ($allCat= $data->fetch_assoc()) { ?>
            <option 
            <?php if ($singlePost['cat'] == $allCat['id']){ ?>
                selected="selected"
            <?php    }?>
            value="<?php echo $allCat['id'];?>"><?php echo $allCat['cat_name'];?>
            
                    
            </option>
            <?php } ?>

                    </select>

                </td>
            </tr>
            <tr>
                <td><label>Date Picker</label></td>
                <td><input type="text" id="date-picker" /></td>
            </tr>
            <tr>
                <td><label>Upload Image</label></td>
               
                <td> 
                <img src="<?php echo $singlePost['image']; ?>"  height='60px' width='60' /><br>
                <input type="file" name="image" />
                </td>
                
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" name="body"><?php echo $singlePost['body']; ?> </textarea>
                </td>
            </tr>
            <tr>
                <td><label>Tags</label></td>
                <td>
                    <input type="text" name="tags" value="<?php echo $singlePost['tags']; ?>" class="medium" />
                </td>
            </tr>
            <tr>
                <td><label>Author Name</label></td>
                <td>
                    <input type="text" name="author" value="<?php echo $singlePost['author']; ?>" class="medium" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="update" value="<?php echo $singlePost['id']; ?>" />
                    <input type="submit" name="update" value="Update" />
                </td>
            </tr>
        </table>
            </form>
        </div>
    </div>
</div>
<?php 

}


?>








        <!-- BEGIN: load jquery -->
        <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
        <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
        <!-- END: load jquery -->
        <!--jQuery Date Picker-->
        <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
        <!-- jQuery dialog related-->
        <script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
        <!-- jQuery dialog end here-->
        <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
        <!--Fancy Button-->
        <script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
        <script src="js/setup.js" type="text/javascript"></script>
        <!-- Load TinyMCE -->
        <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setupTinyMCE();
                setDatePicker('date-picker');
                $('input[type="checkbox"]').fancybutton();
                $('input[type="radio"]').fancybutton();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                setSidebarHeight();
            });
        </script>
        <!-- /TinyMCE -->



<?php include_once  'inc/footer.php'; ?>
