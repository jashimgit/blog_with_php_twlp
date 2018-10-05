<?php
    include_once  'inc/header.php';
    include_once  'inc/sidebar.php';

    $query = "SELECT * FROM tbl_category ORDER BY id DESC ";
    $data = $db->select($query);
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

<?php 
    if(isset($_GET['catid'])){
        $id = $_GET['catid'];
        $query = "DELETE FROM tbl_category WHERE id='$id'";
        $result = $db->delete($query);
        if ($result) {
            echo "<span class='success'>Categroy Deleted Successfully !!  </span>";
        } else {
            echo "<span class='error'> Error !! Category Is Not Deleted !! </span>";
        }
    }
?>        
        <div class="block">
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($data){
                $serial = 1;
                while ( $allData = $data->fetch_assoc()){ ?>

                <tr class="odd gradeX">
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $allData['cat_name']; ?></td>
                    <td>
                        <a href="editcat.php?catid=<?php echo $allData['id'];?>">Edit</a> ||
                        <a onclick="return confirm('are you sure to delete this category? ')" href="?catid=<?php echo $allData['id'];?>">Delete</a>
                    </td>
                </tr>

            <?php   $serial++; } } ?>

            </tbody>
        </table>
       </div>
    </div>
</div>



        <script type="text/javascript" src="js/table/table.js"></script>
        <script src="js/setup.js" type="text/javascript"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                setupLeftMenu();

                $('.datatable').dataTable();
                setSidebarHeight();


            });
        </script>


        <?php  include_once 'inc/footer.php'; ?>