<?php
$perusahaan = [
    [
        "nama" => "Apple Inc.",
        "pendiri" => "Steve Jobs, Steve Wozniak, Ronald Wayne",
        "tahun" => 1976,
        "produk" => "iPhone, iPad, Mac",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg"
    ],
    [
        "nama" => "Microsoft Corporation",
        "pendiri" => "Bill Gates, Paul Allen",
        "tahun" => 1975,
        "produk" => "Windows, Office, Azure",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/9/96/Microsoft_logo_%282012%29.svg"
    ],
    [
        "nama" => "Google LLC",
        "pendiri" => "Larry Page, Sergey Brin",
        "tahun" => 1998,
        "produk" => "Search, Android, YouTube",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
    ],
    [
        "nama" => "Amazon.com Inc.",
        "pendiri" => "Jeff Bezos",
        "tahun" => 1994,
        "produk" => "AWS, Kindle, Alexa",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg"
    ],
    [
        "nama" => "Facebook (Meta Platforms)",
        "pendiri" => "Mark Zuckerberg",
        "tahun" => 2004,
        "produk" => "Facebook, Instagram, WhatsApp",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
    ],
    [
        "nama" => "Tesla, Inc.",
        "pendiri" => "Elon Musk, JB Straubel, Martin Eberhard",
        "tahun" => 2003,
        "produk" => "Electric vehicles, Solar panels",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/b/bd/Tesla_Motors.svg"
    ],
    [
        "nama" => "Samsung Electronics",
        "pendiri" => "Lee Byung-chul",
        "tahun" => 1969,
        "produk" => "Galaxy smartphones, TVs",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg"
    ],
    [
        "nama" => "Intel Corporation",
        "pendiri" => "Gordon Moore, Robert Noyce",
        "tahun" => 1968,
        "produk" => "Processors, Chipsets",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/7/7d/Intel_logo_%282006-2020%29.svg"
    ],
    [
        "nama" => "IBM",
        "pendiri" => "Charles Ranlett Flint",
        "tahun" => 1911,
        "produk" => "Watson, Mainframes",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/5/51/IBM_logo.svg"
    ],
    [
        "nama" => "Netflix, Inc.",
        "pendiri" => "Reed Hastings, Marc Randolph",
        "tahun" => 1997,
        "produk" => "Streaming service",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg"
    ]
];

echo "<h2>Daftar Perusahaan Teknologi Terkenal</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>
        <th>No</th>
        <th>Logo</th>
        <th>Nama Perusahaan</th>
        <th>Pendiri</th>
        <th>Tahun Berdiri</th>
        <th>Produk Utama</th>
      </tr>";

foreach($perusahaan as $index => $p) {
    echo "<tr>";
    echo "<td>".($index+1)."</td>";
    echo "<td><img src='".$p['logo']."' width='100'></td>";
    echo "<td>".$p['nama']."</td>";
    echo "<td>".$p['pendiri']."</td>";
    echo "<td>".$p['tahun']."</td>";
    echo "<td>".$p['produk']."</td>";
    echo "</tr>";
}

echo "</table>";
?>