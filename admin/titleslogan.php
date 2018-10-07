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
                 <form>
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