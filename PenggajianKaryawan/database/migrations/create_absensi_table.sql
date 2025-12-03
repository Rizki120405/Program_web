CREATE TABLE absensi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    karyawan_id INT NOT NULL,
    tanggal DATE NOT NULL,
    jam_masuk TIME NOT NULL,
    jam_keluar TIME,
    status ENUM('hadir', 'izin', 'sakit', 'alpha') DEFAULT 'hadir',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (karyawan_id) REFERENCES karyawan(id) ON DELETE CASCADE
);