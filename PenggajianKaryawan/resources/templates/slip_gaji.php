<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .company-info h2 {
            margin: 0;
            color: #333;
        }
        .company-info p {
            margin: 5px 0;
            color: #666;
        }
        .employee-info {
            margin: 20px 0;
        }
        .salary-details {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .salary-details th, .salary-details td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        .salary-details th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
            background-color: #e6f3ff;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h2>SLIP GAJI</h2>
            <p><?php echo $karyawan['nama']; ?></p>
            <p>Bulan: <?php echo $penggajian['bulan']; ?>/<?php echo $penggajian['tahun']; ?></p>
        </div>
    </div>

    <div class="employee-info">
        <p><strong>Nama:</strong> <?php echo $karyawan['nama']; ?></p>
        <p><strong>NIP:</strong> <?php echo $karyawan['nip']; ?></p>
        <p><strong>Jabatan:</strong> <?php echo $karyawan['jabatan']; ?></p>
        <p><strong>Departemen:</strong> <?php echo $karyawan['departemen']; ?></p>
    </div>

    <table class="salary-details">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td>Rp <?php echo number_format($penggajian['gaji_pokok'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td>Rp <?php echo number_format($penggajian['tunjangan'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td>Rp <?php echo number_format($penggajian['potongan'], 0, ',', '.'); ?></td>
            </tr>
            <tr class="total-row">
                <td><strong>Total Gaji</strong></td>
                <td><strong>Rp <?php echo number_format($penggajian['total_gaji'], 0, ',', '.'); ?></strong></td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p>Diterima oleh,</p>
        <br><br>
        <p><strong><?php echo $karyawan['nama']; ?></strong></p>
    </div>

    <div class="footer">
        <p>Dicetak pada: <?php echo date('d-m-Y H:i:s'); ?></p>
    </div>
</body>
</html>