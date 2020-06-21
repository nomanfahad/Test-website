
<?php
include('security.php');
$connection = mysqli_connect("localhost","root","","adminpanel");


if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

if($password === $cpassword)
   {
    $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
    $query_run = mysqli_query($connection, $query);
            
     if($query_run)
            {
                //echo "Saved";
                $_SESSION['success'] = "Admin Profile Added";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                header('Location: register.php');  
            }
   }
   else
   {
    $_SESSION['status'] = "Password does not match";
    header('Location: register.php'); 
   }
}


if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username= $_POST['edit_username'];
    $email= $_POST['edit_email'];
    $password= $_POST['edit_password'];
    $usertypeupdate= $_POST['update_usertype'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$usertypeupdate' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your data is updated";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your data is not updated";
        header('Location: register.php');

    }
}




if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
       $_SESSION['success'] = "Your Data is Deleted";
       header('Location:register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is Not Deleted";
        header('Location:register.php');
    }
}



if(isset($_POST['about_save']))
{
    $title= $_POST['title'];
    $subtitle= $_POST['subtitle'];
    $description= $_POST['description'];
    $links= $_POST['links'];

    $query = "INSERT INTO abouts (title,subtitle,description,links) VALUES ('$title','$subtitle','$description','$links')";
    $query_run = mysqli_query($connection, $query);
    
    if($query_run)
    {
        $_SESSION['success'] = "About Us Added";
        header("Location: aboutus.php");
    }
    else
    {
        $_SESSION['status'] = "About Us Not Added";
        header("Location: aboutus.php");

    }




}



if(isset($_POST['update_btn']))
{
    $id = $_POST['edit_id'];
    $title= $_POST['edit_title'];
    $subtitle= $_POST['edit_subtitle'];
    $description= mysqli_real_escape_string($connection, $_POST['edit_description']); 
    $links= $_POST['edit_links'];

    $query = "UPDATE abouts SET title='$title', subtitle='$subtitle', description='$description', links='$links' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your data is updated";
        header('Location: aboutus.php');
    }
    else
    {
        $_SESSION['status'] = "Your data is not updated";
        header('Location: aboutus.php');

    }
}


if(isset($_POST['deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM abouts WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
       $_SESSION['success'] = "Your Data is Deleted";
       header('Location:aboutus.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is Not Deleted";
        header('Location:aboutus.php');
    }
}



if(isset($_POST['save_faculty']))
{
    $name= $_POST['faculty_name'];
    $designation= $_POST['faculty_designation'];
    $description= mysqli_real_escape_string($connection, $_POST['faculty_description']); 
    $images= $_FILES["faculty_image"]['name'];

    if(file_exists("upload/" .$_FILES["faculty_image"]["name"]))
    {
        $store =$_FILES["faculty_image"]["name"];
        $_SESSION['status'] = "Image already exists, '.$store'";
        header('Location: faculty.php'); 
    }
    else
    {
        $query = "INSERT INTO faculty (name,designation,description,images) VALUES ('$name','$designation','$description','$images')";
        $query_run = mysqli_query($connection, $query);
    
    if($query_run)
    {
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"],"upload/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Added";
        header("Location: faculty.php");
    }
    else
    {
        $_SESSION['status'] = "Faculty is Not Added";
        header("Location: faculty.php");

    }

    }


}



if(isset($_POST['faculty_update_btn']))
{
    $edit_id= $_POST['edit_id'];
    $edit_name= $_POST['edit_name'];
    $edit_designation= $_POST['edit_designation'];
    $edit_description= mysqli_real_escape_string($connection, $_POST['edit_description']); 

    $edit_faculty_image= $_FILES["faculty_image"]['name'];

    $facul_query = "SELECT * FROM faculty where id='$edit_id'";
    $facul_query_run = mysqli_query($connection, $facul_query);

    foreach($facul_query_run as $fa_row)
    {
       // echo $fa_row['images'];

       if($edit_faculty_image == NULL)
       {
           //update with existing image
           $image_data = $fa_row['images'];
       }
       else
       {
           //update with new image and delete with old image
           if($img_path ="upload/".$fa_row['images'])
           {
               unlink($img_path);
               $image_data = $edit_faculty_image;
           }


       }
    }

    $query = "UPDATE faculty SET name='$edit_name', designation='$edit_designation', description='$edit_description', images='$image_data' WHERE id='$edit_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        if($edit_faculty_image == NULL)
        {
            //update with existing image
            $_SESSION['success'] = "Faculty updated with existing image";
            header('Location: faculty.php');        }
        else
        {
            //update with new image and delete with old image
            move_uploaded_file($_FILES["faculty_image"]["tmp_name"],"upload/".$_FILES["faculty_image"]["name"]);
            $_SESSION['success'] = "Faculty is updated";
            header('Location: faculty.php');
      
 
        }

    }
    else
    {
        $_SESSION['status'] = "Faculty is not updated";
        header('Location: faculty.php');

    }
}



if(isset($_POST['faculty_delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM faculty WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
       $_SESSION['success'] = "Faculty Data is Deleted";
       header('Location:faculty.php');
    }
    else
    {
        $_SESSION['status'] = "Faculty Data is Not Deleted";
        header('Location:faculty.php');
    }
}




?>
