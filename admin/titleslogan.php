<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>

    <style>
        .leftside{
            float: left;
            width: 70%;
            
        }
        .rightside{
            float: left;
            width: 30%;
        }
        .rightside img{
            width: 160px;
            height: 160px;
        }
    </style>
        <div class="grid_10">
		
<?php
    $query = "SELECT * From tbl_slogan WHERE id='1'";
    $getResult = $db->select($query);
    if ($getResult){
        while ($result = $getResult->fetch_assoc()){

?>
        <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
            <div class="leftside">
                <div class="block sloginblock">
                    <?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title    = mysqli_real_escape_string($db->link, $_POST['title']);
    $slogan  = mysqli_real_escape_string($db->link,  $_POST['slogan']);
    

    $permited = array('png');

    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div            = explode('.', $file_name);
    $file_ext       = strtolower(end($div));
    $same_image     = 'logo'.'.'.$file_name;
    $uploaded_image = "upload/".$same_image;

    if ($title  == ""    ||
        $slogan == ""    
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
                    $query = "UPDATE  tbl_slogan SET     
                    title  = '$title',
                    slogan   = '$slogan',
                    logo  = '$uploaded_image'
                    
                    WHERE id = '1'
                    ";      
                
                    $updated_rows = $db->update($query);

                    if ($updated_rows){
                        echo "<span class='error'>Data Updated successfully </span>";
                    } else {
                        echo "<span class='error'>data not Updated successfully</span>";
                    }
                }
            } else {
                $query = "UPDATE tbl_slogan SET     
                title  = '$title',
                slogan   = '$slogan'
                
                
                WHERE id = '1'
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
                 <form action="" method="post" enctype="multipart/form-data" >
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td><label>Upload Image</label></td>
                            <td> <input type="file" name="logo" /></td>
                        </tr>
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
            <div class="rightside">

                <img src="<?php echo $result['logo'];?>" alt="">
            </div>
        </div>
            <?php  } } ?>

        </div>
<?php include_once 'inc/footer.php';?>