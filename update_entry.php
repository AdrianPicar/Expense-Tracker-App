<?php
include_once "header.php";
include_once "authenticate.php";

$msg = "";

$_SESSION["id"] = $_GET["id"];

if($_POST){
    $entry = new Entry($db);
    $entry->id = $_SESSION["id"];
    $entry->date = $_POST["date"];
    $entry->amount = $_POST["amount"];
    $entry->category = $_POST["category"];
    $entry->remarks = $_POST["remarks"];
    $success = $entry->update_entry();

    if($success){
        $_SESSION["msg"] = "Update entry successful.";
        
    }else{
        $_SESSION["msg"] = "Sorry. Update entry unsuccessful.";
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
        <input type="text" name="date" value="<?php echo $date;?>" class="form-control" id="entry_date" aria-describedby="emailHelp" placeholder="<?php echo $date;?>">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" name="amount" value="<?php echo $amount;?>" class="form-control" id="amount" placeholder="<?php echo $amount;?>">
    </div>
    <div class="form-group">
        <label for="category">Example select</label>
        <select class="form-control" name="category" id="category">
            <option value="Food">Food</option>
            <option value="Utilities">Utilities</option>
            <option value="Fun">Fun</option>
        </select>
    </div>
    <div class="form-group">
        <label for="remarks">Remarks</label>
        <input type="text" name="remarks" value="<?php echo $remarks;?>" class="form-control" id="remarks" placeholder="<?php echo $remarks;?>">
    </div>
    <div class="form-group">
        <?php echo $msg;?>
    </div>
    <button type="submit" class="btn btn-primary">Update Entry</button>
</form>