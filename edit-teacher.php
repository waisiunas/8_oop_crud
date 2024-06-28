<?php
require_once "./partials/database.php";

if (empty($_GET['id']) || !isset($_GET['id'])) {
    header('location: ./');
}

$id = htmlspecialchars($_GET['id']);

$teacher = $database->get_single("teachers", $id);

$name = $teacher['name'];
$department = $teacher['department'];
$experience = $teacher['experience'];
$errors = [];

if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name']);
    $department = htmlspecialchars($_POST['department']);
    $experience = htmlspecialchars($_POST['experience']);

    if (empty($name)) {
        $errors['name'] = "Provide teacher name!";
    }

    if (empty($department)) {
        $errors['department'] = "Provide teacher department!";
    }

    if (empty($experience)) {
        $errors['experience'] = "Provide teacher experience!";
    }

    if (count($errors) === 0) {
        $data = [
            "name" => $name,
            "department" => $department,
            "experience" => $experience,
        ];
        
        if ($database->update("teachers", $data, $id)) {
            $success = "Magic has been spelled!";
        } else {
            $failure = "Magic has become shopper!";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Teacher</title>
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
                                <h2 class="m-0">Edit Teacher</h2>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $id ?>" method="post">
                            <?php
                            if (isset($success)) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $success ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            }

                            if (isset($failure)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $failure ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" placeholder="Teacher name!" class="form-control <?php if (isset($errors['name'])) echo "is-invalid" ?>" value="<?php echo $name ?>">
                                <?php
                                if (isset($errors['name'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['name'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" id="department" name="department" placeholder="Teacher department!" class="form-control form-control <?php if (isset($errors['department'])) echo "is-invalid" ?>" value="<?php echo $department ?>">
                                <?php
                                if (isset($errors['department'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['department'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="experience" class="form-label">Experience</label>
                                <input type="text" id="experience" name="experience" placeholder="Teacher experience!" class="form-control form-control <?php if (isset($errors['experience'])) echo "is-invalid" ?>" value="<?php echo $experience ?>">
                                <?php
                                if (isset($errors['experience'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['experience'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div>
                                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>