<?php
    include_once '../db/db.php';

    session_start();

    if(isset($_POST["register"])){
        $name = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $insert = "INSERT INTO `user` (`user_name`, `email`, `password`) VALUES ('$name', '$email', '$password'); ";
        $query = mysqli_query($conn, $insert);
			if($query == true){
				header('Location: ../index.php?page_data='.$name.'');
			}else{
				echo "Not Inserted";
			}
    }
    // End signup insert
  
    
	// Start insert from project-form

	if(isset($_POST["project_submit"])){
        $project_name = $_POST["project_name"];
        $project_address = $_POST["project_address"];
        $project_date = $_POST["starting_date"];
        $project_sql = "INSERT INTO `project` (`project_name`, `address`, `starting_date`) VALUES ('$project_name', '$project_address', '$project_date'); ";
			if(mysqli_query($conn, $project_sql)){
				header('Location: ../project.php?page_data=Project Created');
			}else{
				header('Location: ../projeect.php?page_data=Can not make Project');
			}
    }
	// End insert from project-form

	// Start Deposit from project-form

	if(isset($_POST["deposit_submit"])){
        $deposit_name = $_POST["deposit_name"];
        $deposit_project_id = $_POST["project_id"];
        $deposit_amount = $_POST["deposit_amount"];
        $deposit_date = $_POST["deposit_date"];
        $deposit_sql = "INSERT INTO `deposit` (`deposit_name`, `project_id`, `amount`, `deposit_date`) VALUES ('$deposit_name', '$deposit_project_id', '$deposit_amount', '$deposit_date'); ";
			if(mysqli_query($conn, $deposit_sql)){
                header('Location: ../deposit.php?page_data=Deposit inserted');
			}else{
                header('Location: ../deposit.php?page_data=Deposit not inserted');
			}
    }
	// End Deposit from project-form

	// Start insert Vandor from Vandor-form

	if(isset($_POST["vandor_submit"])){
        $vandor_name    = $_POST["vandor_name"];
        $project_id     = $_POST["project_id"];
        $joining_date   = $_POST["joining_date"];
        $vandor_sql     = "INSERT INTO `vandor` (`vandor_name`, `project_id`, `joining_date`) VALUES ('$vandor_name', '$project_id', '$joining_date');";
			if(mysqli_query($conn, $vandor_sql)){
                header('Location: ../vandor.php?page_data=Vandor inserted');
			}else{
                header('Location: ../vandor.php?page_data=Vandor not inserted');
			}
    }
	// End insert Vandor from Vandor-form




    // Start Costing from Costing-form

    if(isset($_POST["costing_submit"])){
        $details = $_POST["details"];
        $vandor_id = $_POST["vandor_id"];
        $costing_amount = $_POST["costing_amount"];
        $costing_date = $_POST["costing_date"];
        $costing_sql = "INSERT INTO `costing` (`details`, `vandor_id`, `costing_amount`, `costing_date`) VALUES ('$details', '$vandor_id', '$costing_amount', '$costing_date'); ";
			if(mysqli_query($conn, $costing_sql)){
				header('Location: ../costing.php?page_data=Expense inserted');
			}else{
				header('Location: ../costing.php?page_data=Expense not inserted');
			}

    }
    // End Costing from Costing-form

    // Start office insert

    if(isset($_POST["office_submit"])){
        $details = $_POST["office_details"];
        echo $project_id = $_POST["project_id"];
        $office_amount = $_POST["office_amount"];
        $office_date = $_POST["office_date"];
        $office_sql = "INSERT INTO `office_cost` (`details`, `project_id`, `office_amount`, `office_date`) VALUES ('$details', '$project_id', '$office_amount', '$office_date'); ";
			if(mysqli_query($conn, $office_sql)){
                header('Location: ../office_cost.php?page_data=Oficce Cost inserted');
			}else{
				header('Location: ../office_cost.php?page_data=Oficce cost not inserted');
			}

    }
 

    // Materials insert

    if(isset($_POST["material_submit"])){
        $material_name = $_POST["material_name"];
        $material_Type = $_POST["material_Type"];
        $material_des = $_POST["material_des"];
        $project_id = $_POST["project_id"];
        $material_amount = $_POST["material_amount"];
        $purchase_date = $_POST["purchase_date"];

        $material_sql = "INSERT INTO `materials` (`material_name`, `type`, `description`, `project_id`, `m_amount`, `m_date`) VALUES ('$material_name', '$material_Type', '$material_des', '$project_id', '$material_amount', '$purchase_date'); ";

        if(mysqli_query($conn, $material_sql)){
            header('Location: ../materials.php?page_data=Material inserted');
        }else{
            header('Location: ../materials.php?page_data=Material not inserted');
        }
    }

?>