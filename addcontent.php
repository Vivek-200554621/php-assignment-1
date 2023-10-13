<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD in OOP PHP | Add Our Data</title>
    <meta name="description" content="This week we will be using OOP PHP to create and read with our CRUD application">
    <meta name="robots" content="noindex, nofollow">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="./Css/Styles.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
  </head>
  <body>
    <main>
    <?php
      // start by including our classes
     
      include_once ('ProcessContent.php');
      include_once ('database.php');
      // create our class objects
      $valid = new validate();
      
      if(!empty($_POST['Submit'])){
        // using our escape_string function
        $name = $_POST['name'];
        $EmployeeID = $_POST['EmployeeID'];
        $Profession = $_POST['Profession'];
        $Paypending = $_POST['Paypending'];
        // using our functions found in our validate class 
        // (checkEmpty validAge validEmail)
        $msg = $valid->checkEmpty($_POST, array('name', 'EmployeeID', 'Profession', 'Paypending'));
        $checkEmployeeID = $valid->validEmployeeID($_POST['EmployeeID']);
        $checkProfession = $valid->validProfession($_POST['Profession']);
        $checkPaypending = $valid->validPaypending($_POST['Paypending']);
        // now handle any empty fields
        if($msg != null){
          echo $msg;
          //link to the previous page
          echo "<a href='javascript:self.history.back();'>Go Back</a>";
        }elseif(!$checkEmployeeID){
          echo '<p>Please provide a valid employee id.</p>';
          echo "<a href='javascript:self.history.back();'>Go Back</a>";
        }elseif(!$checkProfession){
          echo '<p>Please provide a valid profession(job title).</p>';
          echo "<a href='javascript:self.history.back();'>Go Back</a>";
        }
        elseif(!$checkPaypending){
            echo '<p>Please provide a valid pay.</p>';
            echo "<a href='javascript:self.history.back();'>Go Back</a>";
        }else{
          // if all the fields are valid
          $result = $database->execute("INSERT INTO phpusers(name,EmployeeID,Profession,Paypending) VALUES('$name','$EmployeeID','$Profession','$Paypending')");
          // let the user know that the record has been added
          if($result){
            echo "<p>Data added successfully.</p>";
            echo "<a href='ViewContent.php'>View Result</a>";
          }
               
        }
      }
    ?>
    </main>
  </body>
</html>
