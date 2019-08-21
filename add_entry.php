<?php
include_once "header.php";
include_once "authenticate.php";

$msg = "";

if($_POST){
    $entry = new Entry($db);
    $entry->date = $_POST["date"];
    $entry->amount = $_POST["amount"];
    $entry->category = $_POST["category"];
    $entry->remarks = $_POST["remarks"];
    $success = $entry->add_entry();

    if($success){
        $_SESSION["msg"] = "Add entry successful.";
        
    }else{
        $_SESSION["msg"] = "Sorry. Add entry unsuccessful.";
    }

    header("Location: home.php", true, 301);
    exit();
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="form-group" id="sandbox-container">
        <label for="date">Date</label>
        <input type="text" name="date" class="form-control" value="" placeholder="YYYY-MM-DD">
        <!--input type="text" name="date" class="form-control" id="entry_date" aria-describedby="emailHelp" placeholder="2019-01-15">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" name="amount" class="form-control" id="amount" placeholder="0">
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
        <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Remarks">
    </div>
    <div class="form-group">
        <?php echo $msg; ?>
    </div>
    <button type="submit" class="btn btn-primary">Add Entry</button>
</form>

<a href="home.php">Back</a>

<?php
include_once "footer.php";
?>