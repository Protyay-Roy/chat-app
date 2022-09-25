<?php
include "db.php";

if (isset($_POST["userEmail"])) {

    $userEmail = $_POST["userEmail"];
    $sql = "SELECT * FROM users WHERE email != '$userEmail'";
    $q = $con->query($sql);

    if (mysqli_num_rows($q) > 0) {

        while ($row = mysqli_fetch_array($q)) {
?>
            <li>
                <label for="<?= $row["user_id"] ?>">

                    <?php if ($row["status"] == 1) {  ?>
                        <a href="chat.php?id=<?= $row["user_id"] ?> ">
                            <img src="images/<?= $row["img"] ?>" alt="<?= $row["user_id"] ?>" style="border: 4px solid #28d50ee2;">
                        </a>
                        <span class="ms-3" style="font-size:18px;font-weight:bold; color:#888;"><?= ucwords($row["name"]); ?></span>
                        <span class="ms-3" style="color:#28d50ee2;font-weight:bold">Online</span>

                    <?php } else { ?>

                        <a href="chat.php?id=<?= $row["user_id"] ?> ">
                            <img src="images/<?= $row["img"] ?>" alt="<?= $row["user_id"] ?>" style="border: 4px solid #e2cb00;">
                        </a>
                        <span class="ms-3" style="font-size:18px;font-weight:bold; color:#888;"><?= $row["name"] ?></span>
                        <span class="ms-3" style="color:#e2cb00;font-weight:bold">Offline</span>

                    <?php } ?>

                </label>
            </li>

<?php }
    } else {
        echo "No user available on chat";
    }
} else {
    echo "something wrong in ajax";
}
?>