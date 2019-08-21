<?php
include_once "header.php";
include_once "authenticate.php";

$_SESSION["budget"] = 20000;

function format_number($num){
    return number_format($num, 2, ".", ",");
}
?>

<?php echo $_SESSION["msg"];?>


<div class="pure-g" style="margin:20px 0;">
    <div class="pure-u-1 pure-u-md-1">
        <?php
            $user = new User($db);
            $user->username = $_SESSION['username'];
            $total = $user->get_user_info();
            $remaining_budget = $_SESSION["budget"] - $total;
            $pct_remaining = $total / $_SESSION["budget"] * 100;
            echo "Remaining balance: " . format_number($remaining_budget);
        ?>
        <div class="progress">
            <div class="progress-bar" role="progressbar"  style="width: <?php echo $pct_remaining;?>%" aria-valuenow="<?php echo $pct_remaining;?>" aria-valuemin="0" aria-valuemax="100">
                <?php echo $pct_remaining . "%";?>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        Activity last 10 days
    </div>
    <?php
        $entry = new Entry($db);
        $results = $entry->get_all_entries();
        
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
    ?>
</div>

<?php
include_once "footer.php";
?>