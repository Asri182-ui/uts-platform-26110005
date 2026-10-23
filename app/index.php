<?php
mysqli_report(MYSQLI_REPORT_OFF); for ($i=0;$i<30;$i++){ $db=new mysqli(getenv("DB_HOST"),getenv("DB_USER"), getenv("DB_PASSWORD"),getenv("DB_NAME")); if(!$db->connect_errno) break; sleep(2); }
if ($db->connect_errno) die("Gagal terhubung ke database");
$db->query("CREATE TABLE IF NOT EXISTS tamu (id INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(100), pesan TEXT)");
if (!empty($_POST["nama"])) { $s=$db->prepare("INSERT INTO tamu (nama,pesan) VALUES (?,?)"); $s->bind_param("ss",$_POST["nama"],$_POST["pesan"]); $s->execute(); header("Location: /"); exit; }
echo "<h1>Buku Tamu Digital</h1><p>Terhubung ke database</p>";
echo "<form method=post><input name=nama placeholder=Nama><br><textarea name=pesan></textarea><br><button>Kirim</button></form>";
foreach ($db->query("SELECT * FROM tamu ORDER BY id DESC") as $r) echo "<p><b>".htmlspecialchars($r["nama"])."</b>: ".htmlspecialchars($r["pesan"])."</p>";
