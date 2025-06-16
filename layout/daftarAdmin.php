<h2>Daftar Admin</h2>
<form method="GET" action="" id="sortForm">
    <label>Urutkan berdasarkan:</label>
    <select name="sort" id="sort" onchange="document.getElementById('sortForm').submit()">
        <option value="ASC" <?= isset($_GET['sort']) && $_GET['sort'] == 'ASC' ? 'selected' : '' ?>>A-Z</option>
        <option value="DESC" <?= isset($_GET['sort']) && $_GET['sort'] == 'DESC' ? 'selected' : '' ?>>Z-A</option>
    </select>
</form>
<?php
include 'database/koneksi.php';
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';
$sql = "SELECT * FROM users ORDER BY username $sortOrder";
$result = $db->query($sql);
$no = 1;
?>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">edit</th>
            <th scope="col">hapus</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <th scope="row"><?= $row['id'] ?></th>
                <td><?= $row['username'] ?></td>
                <td><a href="updateAdminDashboard.php?id=<?= $row['id'] ?>"><i class="bi bi-pencil-fill me-2"></i></a></td>
                <td>
                    <form action="database/hapusAdmin.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button><i class="bi bi-trash-fill text-danger"></i></button>
                    </form>
                </td>
            </tr>
        <?php }
        $db->close();
        ?>
    </tbody>
</table>