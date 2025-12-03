<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Karyawan</h2>
    <a href="/karyawan/create" class="btn btn-primary">Tambah Karyawan</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Departemen</th>
                <th>Gaji Pokok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($karyawans as $index => $karyawan): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo htmlspecialchars($karyawan['nama']); ?></td>
                <td><?php echo htmlspecialchars($karyawan['nip']); ?></td>
                <td><?php echo htmlspecialchars($karyawan['jabatan']); ?></td>
                <td><?php echo htmlspecialchars($karyawan['departemen']); ?></td>
                <td>Rp <?php echo number_format($karyawan['gaji_pokok'], 0, ',', '.'); ?></td>
                <td>
                    <a href="/karyawan/<?php echo $karyawan['id']; ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/karyawan/<?php echo $karyawan['id']; ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>