<?php
include_once "header.php";
include_once "authenticate.php";

$_SESSION["budget"] = 20000;

function format_number($num){
    return number_format($num, 2, ".", ",");
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="form-group" id="sandbox-container">
        <label for="from_date">From</label>
        <input type="text" name="from_date" class="form-control" value="" placeholder="YYYY-MM-DD">

        <label for="to_date">To</label>
        <input type="text" name="to_date" class="form-control" value="" placeholder="YYYY-MM-DD">
        <!--input type="text" name="date" class="form-control" id="entry_date" aria-describedby="emailHelp" placeholder="2019-01-15">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
    </div>
    <button type="submit" class="btn btn-primary">Go</button>
</form>

<div class="container">
    <div class="row">
        Activity last 10 days
    </div>
    <?php
        if($_POST){
            $entry = new Entry($db);
            $results = $entry->get_all_entries_within_range($_POST["from_date"], $_POST["to_date"]);
            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                echo "<div class='row' style='padding:5px;'>";
                echo "<div class='col'>" . $row["date_created"] . "</div>";
                echo "<div class='col'>" . format_number($row["amount"]) . "</div>";
                echo "<div class='col'>" . $row["category"] . "</div>";
                echo "<div class='col'>" . $row["remarks"] . "</div>";
                echo "<div class='col'><a href = 'update_entry.php?id={$row["entry_id"]}'>Update" . "</a>" . "</div>";
                echo "<div class='col'><a href = 'delete_entry.php?id={$row["entry_id"]}'>Delete" . "</a>" . "</div>";
                echo "</div>";
            } 
        }
    ?>
</div>

<?php
include_once "footer.php";
?>