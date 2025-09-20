<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "testdb";

$conn = new mysqli($host, $user, $pass, $db);

$nama   = isset($_GET['nama']) ? $_GET['nama'] : '';
$alamat = isset($_GET['alamat']) ? $_GET['alamat'] : '';
$hobi   = isset($_GET['hobi']) ? $_GET['hobi'] : '';

$sql = "
SELECT p.nama, p.alamat, COALESCE(GROUP_CONCAT(h.hobi SEPARATOR ', '), '-') AS hobi
FROM person p
LEFT JOIN hobi h ON p.id = h.person_id
WHERE 1=1
";

if (!empty($nama)) {
    $sql .= " AND p.nama LIKE '%" . $conn->real_escape_string($nama) . "%'";
}
if (!empty($alamat)) {
    $sql .= " AND p.alamat LIKE '%" . $conn->real_escape_string($alamat) . "%'";
}
if (!empty($hobi)) {
    $sql .= " AND h.hobi LIKE '%" . $conn->real_escape_string($hobi) . "%'";
}

$sql .= " GROUP BY p.id, p.nama, p.alamat";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table { border-collapse: collapse;}
        th, td { border: 1px solid black; }
        .box {
            border: 1px solid black;
            width: 300px;
            padding: 10px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Hobi</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td><?= htmlspecialchars($row['hobi']); ?></td>
            </tr>
            <?php } ?>
        <?php endif; ?>
    </table>

    <div class="box">
        <form method="get" action="">
            Nama: <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>"><br><br>
            Alamat: <input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>"><br><br>
            Hobi: <input type="text" name="hobi" value="<?= htmlspecialchars($hobi) ?>"><br><br>
            <input type="submit" value="SEARCH">
        </form>
    </div>

</body>
</html>

<?php $conn->close(); ?>
