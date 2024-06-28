<?php
require_once "./partials/database.php";
$teachers = $database->get_all("teachers");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="m-0">Teachers</h2>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./add-teacher.php" class="btn btn-outline-primary">Add Teacher</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($teachers) { ?>
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Experience</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sr = 1;
                                    foreach ($teachers as $teacher) { ?>
                                        <tr>
                                            <td><?php echo $sr++ ?></td>
                                            <td><?php echo $teacher['name'] ?></td>
                                            <td><?php echo $teacher['department'] ?></td>
                                            <td><?php echo $teacher['experience'] ?></td>
                                            <td>
                                                <a href="./edit-teacher.php?id=<?php echo $teacher['id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="./delete-teacher.php?id=<?php echo $teacher['id'] ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        } else { ?>
                            <div class="alert alert-info m-0">No record found!</div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>