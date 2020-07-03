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
        <h5 class="modal-title" id="exampleModalLabel">Add teacher </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    

      <form action="code.php" method="POST">
         <div class="modal-body">
             <div class="form-group">
                 <label> Class </label>
                 <input type="text" name="class" class="form-control" placeholder="Enter Class" required>
             </div>

             <div class="form-group">
                 <label> Name </label>
                 <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
             </div>

             <div class="form-group">
                 <label> Subject_ID </label>
                 <input type="text" name="subject_id" class="form-control" placeholder="Enter Subject ID" required>
             </div>

             <div class="form-group">
                 <label> Teacher_ID </label>
                 <input type="text" name="teacher_id" class="form-control" placeholder="Enter Teacher ID" required>
             </div>

         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save_teacher" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="container-fluid">

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
   <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Teacher
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

      $query = "SELECT *FROM teacher_assigns ";
      $query_run = mysqli_query($connection,$query);

   ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th>Name</th>
            <th> Class </th>
            <th>Subject_ID</th>
            <th>Teacher_ID</th>

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
            <td> <?php echo $row['name']; ?> </td>
            <td> <?php echo $row['class']; ?> </td>
            <td> <?php echo $row['subject_id']; ?> </td>
            <td> <?php echo $row['teacher_id']; ?> </td>
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
