<?php
include_once "header.php";
include_once "authenticate.php";

$msg = "";

$_SESSION["id"] = $_GET["id"];

if($_POST){
    $entry = new Entry($db);
    $entry->id = $_SESSION["id"];
    $success = $entry->delete_entry();

    if($success){
        $_SESSION["msg"] = "Delete entry successful.";
    }else{
        $_SESSION["msg"] = "Sorry. Delete entry unsuccessful.";
    }
    header("Location: home.php", true, 301);
    exit();
}

$entry = new Entry($db);
$entry->id = $_SESSION["id"];
$results = $entry->get_one_entry();
while($row = $results->fetch(PDO::FETCH_ASSOC)){
    $date = $row["date_created"];
    $amount = $row["amount"];
    $category = $row["category"];
    $remarks = $row["remarks"];
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']."?id=".$_SESSION["id"];?>" method="post">
    <div class="form-group">
        <label for="date">Date</label>
        <input type="text" name="date" class="form-control" id="entry_date" aria-describedby="emailHelp" placeholder="<?php echo $date;?>" disabled>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" name="amount" class="form-control" id="amount" placeholder="<?php echo $amount;?>" disabled>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" name="category" id="category" disabled>
            <option value="Food">Food</option>
            <option value="Utilities">Utilities</option>
            <option value="Fun">Fun</option>
        </select>
    </div>
    <div class="form-group">
        <label for="remarks">Remarks</label>
        <input type="text" name="remarks" class="form-control" id="remarks" placeholder="<?php echo $remarks;?>" disabled>
    </div>
    <div class="form-group">
        <?php echo $msg;?>
    </div>
    <button type="submit" class="btn btn-primary">Delete Entry</button>
</form>

<a href="home.php">Back</a>