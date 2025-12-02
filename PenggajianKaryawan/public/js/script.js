// JavaScript for PenggajianKaryawan application

// Function to confirm deletion
function confirmDelete(url, message) {
    if (confirm(message || "Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = url;
    }
}

// Format currency function
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Initialize currency formatting on page load
document.addEventListener('DOMContentLoaded', function() {
    // Format all elements with class 'currency'
    const currencyElements = document.querySelectorAll('.currency');
    currencyElements.forEach(function(element) {
        const amount = parseInt(element.textContent.replace(/[^0-9]/g, ''));
        element.textContent = formatCurrency(amount);
    });
    
    // Add event listeners for form validation if needed
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            // Add any custom validation here if needed
        });
    });
});

// Function to calculate total salary
function calculateTotalSalary() {
    const gajiPokok = parseFloat(document.getElementById('gaji_pokok').value) || 0;
    const tunjangan = parseFloat(document.getElementById('tunjangan').value) || 0;
    const potongan = parseFloat(document.getElementById('potongan').value) || 0;
    
    const total = gajiPokok + tunjangan - potongan;
    
    document.getElementById('total_gaji').value = total;
    if (document.getElementById('total_gaji_display')) {
        document.getElementById('total_gaji_display').textContent = formatCurrency(total);
    }
}

// Auto-calculate when fields change
document.addEventListener('DOMContentLoaded', function() {
    const gajiPokok = document.getElementById('gaji_pokok');
    const tunjangan = document.getElementById('tunjangan');
    const potongan = document.getElementById('potongan');
    
    if (gajiPokok && tunjangan && potongan) {
        gajiPokok.addEventListener('input', calculateTotalSalary);
        tunjangan.addEventListener('input', calculateTotalSalary);
        potongan.addEventListener('input', calculateTotalSalary);
    }
});