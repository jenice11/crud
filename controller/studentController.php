<?php
require_once '../model/studentModel.php';

class studentController{

    function add(){;
        $student = new studentModel();
        $student->studName = $_POST['studName'];
        $student->studIC = $_POST['studIC'];
        $student->studPhone = $_POST['studPhone'];
        $student->studGender = $_POST['studGender'];
        $student->studClass = $_POST['studClass'];
        $student->pFatherName = $_POST['pFatherName'];
        $student->pFatherIC = $_POST['pFatherIC'];
        $student->pMotherName = $_POST['pMotherName'];
        $student->pMotherIC = $_POST['pMotherIC'];
        $student->eName = $_POST['eName'];
        $student->eRelation = $_POST['eRelation'];
        $student->eTel = $_POST['eTel'];

        $fileinfo=PATHINFO($_FILES['studPhoto']['name']);

        if(empty($fileinfo['filename'])){
            $student->studPhoto="";
        }
        else{
          $newFilename=$fileinfo['filename'] . "." . $fileinfo['extension'];
          move_uploaded_file($_FILES["studPhoto"]["tmp_name"],"../images/studentPicture/" . $newFilename);
          $student->studPhoto="../images/studentPicture/" . $newFilename;
        }


        if($student->addStud() > 0){
            $message = "Success Insert!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'index.php';</script>";
        }
        else if($student->addStud() == -999){
            $message = "Duplicate IC!";
            echo "<script type='text/javascript'>alert('$message');
            </script>";
        }
    }
    
    function viewAll(){
        $student = new studentModel();
        return $student->viewallStud();
    }
    
    function viewUser($studIC){
        $student = new studentModel();
        $student->studIC = $studIC;
        return $student->viewStud();
    }
    
    function editUser(){
        $student = new studentModel();
        $student->studIC = $_POST['studIC'];
        $student->studPhone = $_POST['studPhone'];
        $student->studClass = $_POST['studClass'];
        $student->eName = $_POST['eName'];
        $student->eRelation = $_POST['eRelation'];
        $student->eTel = $_POST['eTel'];
        $ic = base64_encode($_POST['studIC']);
        
        $fileinfo=PATHINFO($_FILES['studPhoto']['name']);

        if(empty($fileinfo['filename'])){
           $student->studPhoto= $_POST['studPhoto2'];
        }
        else{
          $newFilename=$fileinfo['filename'] . "." . $fileinfo['extension'];
          move_uploaded_file($_FILES["studPhoto"]["tmp_name"],"../images/studentPicture/" . $newFilename);
          $student->studPhoto="../images/studentPicture/" . $newFilename;
        }

        if($student->modifyStud()){
            $message = "Success Update!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '../view/viewStud.php?studIC=".$ic."';</script>";
        }
    }
    
    function delete(){
        $student = new studentModel();
        $student->studIC = $_POST['studIC'];
        if($student->deleteStud()){
            $message = "Success Delete!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '../view';</script>";
        }
    }
}
?>
