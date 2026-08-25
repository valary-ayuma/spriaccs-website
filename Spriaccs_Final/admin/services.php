<?php

require_once "includes/auth.php";
require_once "includes/connection.php";

$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Services | Spriaccs CMS</title>

<link rel="stylesheet" href="assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<div class="main-content">

<?php include "includes/topbar.php"; ?>

<div class="dashboard">

    <!-- ======================
            PAGE HEADER
    ======================= -->

    <div class="page-header">

        <div>

            <h1>Services</h1>

            <p>
                Manage the services displayed on your Spriaccs website.
            </p>

        </div>

        <a href="add-service.php" class="add-btn">

            <i class="fas fa-plus"></i>

            Add Service

        </a>

    </div>

    <!-- ======================
            SUCCESS MESSAGE
    ======================= -->

    <?php if(isset($_GET['success'])){ ?>

        <div class="success-message">

            <i class="fas fa-circle-check"></i>

            Service added successfully.

        </div>

    <?php } ?>

    <?php if(isset($_GET['deleted'])){ ?>

<div class="success-message">

    <i class="fas fa-circle-check"></i>

    Service deleted successfully.

</div>

<?php } ?>

<?php if(isset($_GET['error'])){ ?>

<div class="error-message">

    <i class="fas fa-circle-xmark"></i>

    Unable to delete the selected service.

</div>

<?php } ?>

    <!-- ======================
            SEARCH
    ======================= -->

    <div class="table-tools">

        <input
        type="text"
        id="serviceSearch"
        placeholder="Search services...">

    </div>

    <!-- ======================
            TABLE
    ======================= -->

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th width="90">Icon</th>

                    <th>Title</th>

                    <th>Description</th>

                    <th width="120">Status</th>

                    <th width="120">Actions</th>

                </tr>

            </thead>

            <tbody>

            <?php

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

            ?>

                <tr>

                    <td>

                        <i class="<?php echo $row['icon']; ?>"></i>

                    </td>

                    <td>

                        <?php echo htmlspecialchars($row['title']); ?>

                    </td>

                    <td>

                        <?php echo htmlspecialchars(substr($row['description'],0,90)); ?>...

                    </td>

                    <td>

                        <?php if($row['status']=="Active"){ ?>

                            <span class="badge-active">

                                Active

                            </span>

                        <?php }else{ ?>

                            <span class="badge-inactive">

                                Inactive

                            </span>

                        <?php } ?>

                    </td>

                    <td>

                        <a href="edit-service.php?id=<?php echo $row['service_id']; ?>" class="edit-btn">

                            <i class="fas fa-pen"></i>

                        </a>

                        <a href="delete-service.php?id=<?php echo $row['service_id']; ?>"
                        class="delete-btn"
                        onclick="return confirm('Delete this service?')">

                            <i class="fas fa-trash"></i>

                        </a>

                    </td>

                </tr>

            <?php

                }

            }else{

            ?>

                <tr>

                    <td colspan="5" class="empty-table">

                        <i class="fas fa-folder-open"></i>

                        <br><br>

                        No services have been added yet.

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</div>

<script src="assets/js/admin.js"></script>

</body>

</html>