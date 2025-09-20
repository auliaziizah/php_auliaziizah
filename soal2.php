<?php
session_start();

$tampilan = isset($_POST['tampilan']) ? (int)$_POST['tampilan'] : 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($tampilan == 1 && !empty($_POST['nama'])) {
        $_SESSION['nama'] = $_POST['nama'];
        $tampilan = 2;
    } elseif ($tampilan == 2 && !empty($_POST['umur'])) {
        $_SESSION['umur'] = $_POST['umur'];
        $tampilan = 3;
    } elseif ($tampilan == 3 && !empty($_POST['hobi'])) {
        $_SESSION['hobi'] = $_POST['hobi'];
        $tampilan = 4;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .box {
            border: 1px solid black;
            width: 300px;
            padding: 15px;
            margin: 20px;
        }
        input[type=text], input[type=number] {
            border: 1px solid black;
        }
        button {
            display: block;
            background: white;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <?php if ($tampilan == 1): ?>
        <div class="box">
            <form method="post">
                <label>Nama Anda :</label>
                <input type="text" name="nama" required>
                <br><br>
                <input type="hidden" name="tampilan" value="1">
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    
    <?php elseif ($tampilan == 2): ?>
        <div class="box">
            <form method="post">
                <label>Umur Anda :</label>
                <input type="number" name="umur" required>
                <br><br>
                <input type="hidden" name="tampilan" value="2">
                <button type="submit">SUBMIT</button>
            </form>
        </div>

    <?php elseif ($tampilan == 3): ?>
        <div class="box">
            <form method="post">
                <label>Hobi Anda :</label>
                <input type="text" name="hobi" required>
                <br><br>
                <input type="hidden" name="tampilan" value="3">
                <button type="submit">SUBMIT</button>
            </form>
        </div>

    <?php elseif ($tampilan == 4): ?>
        <div class="box">
            <p>Nama: <?= htmlspecialchars($_SESSION['nama']); ?></p>
            <p>Umur: <?= htmlspecialchars($_SESSION['umur']); ?></p>
            <p>Hobi: <?= htmlspecialchars($_SESSION['hobi']); ?></p>
        </div>
    <?php endif; ?>

</body>
</html>
