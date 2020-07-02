<?php
      include('security.php');
      include("includes/header.php"); 
      include("includes/navbar.php");  
?>



<!-- Modal -->
<div class="modal fade" id="facultymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Routine </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
         <div class="modal-body">

             <div class="form-group">
                 <label> Day </label>
                 <input type="text" name="Day" class="form-control" placeholder="Enter Day" required>
             </div>

             <div class="form-group">
                 <label> Class </label>
                 <input type="text" name="Class" class="form-control" placeholder="Enter Class" required>
             </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save_routine" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>




<div class="container-fluid">

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
   <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Routine 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#facultymodal">
            ADD
        </button>
     </h6>
   </div>

 <div class="card-body">
 
 <?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
   {
      echo '<h2 class="bg-primary text-white">' .$_SESSION['success']. '</h2>';
      unset($_SESSION['success']);
   }
if(isset($_SESSION['status']) && $_SESSION['status'] !='')
  {
       echo '<h2 class="bg-danger text-white">' .$_SESSION['status']. '</h2>';
       unset($_SESSION['status']);
  }
?>

    <div class="table-responsive">
    <?php

      $query = "SELECT *FROM routine ";
      $query_run = mysqli_query($connection,$query);

   ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Day </th>
            <th> Class </th>
            <th> Subject_Id </th>
            <th> Room_Id </th>
            <th> Time_slot </th>
            <th> Teacher_id </th>

          </tr>
        </thead>
        <tbody>     
        <?php
        if(mysqli_num_rows($query_run) > 0)
        {
          while($row = mysqli_fetch_assoc($query_run))
          {
        ?>
         
          <tr>
            <td> <?php echo $row['id']; ?> </td>
            <td> <?php echo $row['day']; ?> </td>
            <td> <?php echo $row['class']; ?> </td>

          </tr>
          <?php 
          }
        }
        else {
          echo "No Record Found";
        }
        ?>
        </tbody>
      </table>

    </div>
   </div>
  </div>
 </div>
<!-- /.container-fluid -->

<?php 
include("includes/scripts.php");
include("includes/footer.php");

?>
