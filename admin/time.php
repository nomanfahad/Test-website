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
        <h5 class="modal-title" id="exampleModalLabel">Add Time Slot </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    

      <form action="code.php" method="POST">
         <div class="modal-body">
             <div class="form-group">
                 <label> Start </label>
                 <input type="text" name="start" class="form-control" placeholder="Enter Start time" required>
             </div>

             <div class="form-group">
                 <label> End </label>
                 <input type="text" name="end" class="form-control" placeholder="Enter End time" required>
             </div>

             <div class="form-group">
                 <label> Break </label>
                 <input type="text" name="break" class="form-control" placeholder="Enter 1 for break and 0 for no break" required>
             </div>

         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save_time" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="container-fluid">

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
   <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> TimeSlot
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

      $query = "SELECT *FROM time_slots ";
      $query_run = mysqli_query($connection,$query);

   ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th>Start</th>
            <th> End </th>
            <th>Break</th>

          </tr>
        </thead>
        <tbody>     
        <?php
        if(mysqli_num_rows($query_run) >0 )
        {
          while($row = mysqli_fetch_assoc($query_run))
          {
        ?>
         
          <tr>
            <td> <?php echo $row['id']; ?> </td>
            <td> <?php echo $row['start']; ?> </td>
            <td> <?php echo $row['end']; ?> </td>
            <td> <?php echo $row['break']; ?> </td>
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
