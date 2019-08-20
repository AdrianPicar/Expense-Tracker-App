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
    $val = $entry->add_entry();

    if($val){
        $msg = "Add entry successful.";
    }else{
        $msg = "Sorry.";
    }
}
?>

<div class="pure-g">
    <div class="pure-u-1 pure-u-md-1">
        <a href="home.php">Welcome <?php echo $_SESSION["username"]?></a>
    </div>
</div>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="form-group">
        <label for="date">Date</label>
        <input type="text" name="date" class="form-control" id="entry_date" aria-describedby="emailHelp" placeholder="2019-01-15">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
        <input type="text" name="remarks" class="form-control" id="remarks" placeholder="0">
    </div>
    <div class="form-group">
        <?php echo $msg; ?>
    </div>
    <button type="submit" class="btn btn-primary">Add Entry</button>
</form>
<div class="pure-g" style="margin:20px 0;">
    <div class="pure-u-1 pure-u-md-1">
        <?php
            $user = new User($db);
            $user->username = $_SESSION['username'];
            echo "Remaining balance: " . $user->get_user_info();
        ?>
        <div class="progress">
            <div class="progress-bar" role="progressbar"  style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        Activity last 10 days
    </div>
    <?php
        $entry2 = new Entry($db);
        $results = $entry2->read_all_entries();
        
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='row' style='padding:5px;'>";
            echo "<div class='col'>" . $row["date_created"] . "</div>";
            echo "<div class='col'>" . $row["amount"] . "</div>";
            echo "<div class='col'>" . $row["category"] . "</div>";
            echo "<div class='col'>" . $row["remarks"] . "</div>";
            echo "</div>";
        }  
    ?>
</div>

<a href="logout.php">Logout</a>

<?php
include_once "footer.php";
?>