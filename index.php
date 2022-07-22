<?php
require_once "connection.php";
$tasks = $dbconnect->query("SELECT * FROM `task` WHERE `status` = 0 ");
$ctasks = $dbconnect->query("SELECT * FROM `task` WHERE `status` = 1 ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
                if ($ctasks->num_rows == 0) {
                    echo "<h4>NO TASKS COMPLETE YET</h4>";
                } else{
            ?>
        <table class="table table-striped table-hover">
        <?php
            if (isset($_GET['deleted'])) {
                echo "<p class='text-success'>Task Deleted Succesfully</p>";
            }
            ?>
        <h3>COMPLETED TASKS</h3>
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">TASKS</th>
                <th scope="col">TASK DATE</th>
                <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <?php
                $x=1;
                while ($Cdata = $ctasks->fetch_assoc()) {
                    $dateformate = strtotime($Cdata['date']);
                    $date = date("jS M Y",$dateformate);
            ?>
            <tbody>
                <tr>
                    <th scope="row"><?=$x++?></th>
                    <td><?=$Cdata['task']?></td>
                    <td><?=$date?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="delete.php?dlt=<?=$Cdata['id']?>">DELETE</a>
                    </td>
                </tr>
            </tbody>
            <?php 
                }
            }
            ?>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h3>UPCOMING TASKS</h3>
            <?php
                if ($tasks->num_rows == 0) {
                    echo "<h4>NO TASKS FOUND</h4>";
                } else{
            ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">TASKS</th>
                <th scope="col">TASK DATE</th>
                <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <?php
                $x=1;
                while ($data = $tasks->fetch_assoc()) {
                    $dateformate = strtotime($data['date']);
                    $date = date("jS M Y",$dateformate);
            ?>
            <tbody>
                <tr>
                    <th scope="row"><?=$x++?></th>
                    <td><?=$data['task']?></td>
                    <td><?=$date?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="delete.php?dlt=<?=$data['id']?>">DELETE</a>
                        <a class="btn btn-primary btn-sm complete" href="" data-id="<?=$data['id']?>">COMLETE</a>
                    </td>
                </tr>
            </tbody>
            <?php 
                }
            }
            ?>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>   
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h3>ADD TASKS</h3>
            <?php
                if (isset($_GET['added'])) {
                    echo "<p class='text-success'>Task Added Succesfully</p>";
                }
            ?>
            <form action="task-add.php" method="post">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Tasks</label>
                    <input type="text" class="form-control" id="tsk" name="task" placeholder="Input Tasks">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Another label</label>
                    <input type="date" class="form-control" id="tskDate" name="date" placeholder="Another input placeholder">
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-dark" type="submit" name="submit">Add Task</button>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<!-- Bootstrap.JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.complete').on('click',function(){
            var id = $(this).data('id')
            // alert(id);
            $.ajax({
                url:'update.php',
                method:'POST',
                datatype:'html',
                data:{pushid:id}
                // success:function(data){

                // }
            })
        })
    })
</script>
</body>
</html>