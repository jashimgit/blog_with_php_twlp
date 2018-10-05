
<?php include_once  'inc/header.php'?>
<?php include_once  'inc/sidebar.php'?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <form action="addpost.php" method="post" enctype="multipart/form-data">

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
        $tags == ""     ||
        $file_name == ""){
	    echo "<span class='error'>Field must not be empty !!  </span>";
    } elseif ($file_size > 1048567){
	    echo "<span class='error'>Image size should be less than 1 MB! </span>";
    } elseif (in_array($file_ext, $permited) == false){
	    echo "<span class='error'>File support only ".implode(',', $permited)." </span>";
    } else {
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_post
                                (cat, title, body, image, author, tags)
                VALUES (
                    '$cat' ,
                    '$title',
                    ' $body',
                    '$uploaded_image',
                    '$author',
                    '$tags')";

        $inserted_rows = $db->insert($query);

        if ($inserted_rows){
	        echo "<span class='error'>Data inserted successfully </span>";
        } else {
	        echo "<span class='error'>data not added successfully</span>";
        }
    }
 }
?>

        <table class="form">

            <tr>
                <td><label>Title</label></td>
                <td>
                    <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>

            <tr>
                <td><label>Category</label></td>
                <td>
                    <select id="select" name="cat">
                        <option>Select Category</option>
            <?php
            $query = "select * from tbl_category";
            $data = $db->select($query);
            while ($allCat= $data->fetch_assoc()) { ?>
                    <option value="<?php echo $allCat['id'];?>"><?php echo $allCat['cat_name'];?></option>
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
                <td> <input type="file" name="image" /></td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" name="body"></textarea>
                </td>
            </tr>
            <tr>
                <td><label>Tags</label></td>
                <td>
                    <input type="text" name="tags" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>
            <tr>
                <td><label>Author Name</label></td>
                <td>
                    <input type="text" name="author" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
            </form>
        </div>
    </div>
</div>


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

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium,
aliquid amet dolorem earum enim esse ex fuga harum ipsa ipsum laborum magnam minima nam nesciunt nostrum soluta unde voluptates?

<?php include_once  'inc/footer.php'; ?>
