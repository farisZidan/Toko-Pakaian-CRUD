<?php
include '../config/functions.php';

$keyword = '';
$keyword = $_GET['keyword'];
$produk = select("SELECT * FROM barang where Kode LIKE '%$keyword%' OR Nama LIKE '%$keyword%' OR Harga LIKE '%$keyword%' OR Deskripsi LIKE '%$keyword%'");
$counter = 1;
?>
<table class="table table-hover mb-0">
    <thead class="table-light">
        <tr>
        <th>No</th>
        <th width="120">Aksi</th>
        <th>Kode</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Ukuran</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($produk as $row) : ?>
        <tr>
        <td><?= $counter ?></td>
        <td class="action-buttons">
            <a href="ubah.php?Kode=<?= $row["Kode"]; ?>" class="btn btn-sm btn-warning" title="Ubah"><i class="fas fa-edit"></i></a>
            <a href="hapus.php?Kode=<?= urlencode($row["Kode"]); ?> &Gambar= <?= urlencode($row["Gambar"]); ?>)" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?');" title="Hapus"><i class="fas fa-trash-alt"></i></a>
        </td>
        <td><?= htmlspecialchars($row["Kode"]); ?></td>
        <td><img src="../img/<?= htmlspecialchars($row["Gambar"])?>" alt="<?= htmlspecialchars($row["Nama"]) ?>" class="product-img" onerror="this.src='../img/Null-Image.png'"></td>
        <td><?= htmlspecialchars($row["Nama"]); ?></td>
        <td>S: <?= htmlspecialchars($row["Ukuran_S"]); ?> ||
            M: <?= htmlspecialchars($row["Ukuran_M"]); ?> <br>
            L: <?= htmlspecialchars($row["Ukuran_L"]); ?> ||
            XL: <?= htmlspecialchars($row["Ukuran_XL"]); ?></td>
        <td><?= htmlspecialchars($row["Ukuran_S"] + $row["Ukuran_M"] + $row["Ukuran_L"] + $row["Ukuran_XL"]); ?></td>
        <td>Rp <?= htmlspecialchars(number_format($row["Harga"], 0, ',', '.')); ?></td>
        <td><?= htmlspecialchars(substr($row["Deskripsi"], 0, 50) . (strlen($row["Deskripsi"]) > 50 ? '...' : '')); ?></td>
        </tr>
    <?php $counter++; endforeach; ?>
    </tbody>
</table>