<?php
// Veritabanı bağlantısı
$host = '172.17.0.3';     // PostgreSQL konteynerinin IP adresi
$db   = 'postgres';        // Veritabanı adı
$user = 'postgres';        // Kullanıcı adı
$pass = 'postgres';        // Şifre
$charset = 'utf8';         // Karakter seti

// PDO bağlantı cümlesi
$dsn = "pgsql:host=$host;dbname=$db";

try {
    // PDO ile veritabanına bağlan
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Eğer formdan veri gönderildiyse (POST metodu ile)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
            $name1 = htmlspecialchars($_POST["name"]);
            $comment = htmlspecialchars($_POST["comment"]);

            // Eğer id varsa, bu bir düzenleme işlemi
            if (isset($_POST['id'])) {
                $sql = "UPDATE post SET created_by = :created_by, comment = :comment WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':created_by' => $name1,
                    ':comment'    => $comment,
                    ':id'         => $_POST['id']
                ]);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                // Yeni veri ekleme
                $sql = "INSERT INTO post (created_by, comment) VALUES (:created_by, :comment)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':created_by' => $name1,
                    ':comment'    => $comment
                ]);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        }
    }

    // Silme işlemi
    if (isset($_GET['delete'])) {
        $deleteId = $_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM post WHERE id = :id");
        $stmt->execute([':id' => $deleteId]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Veritabanındaki tüm verileri çek
    $stmt = $pdo->query("SELECT * FROM post ORDER BY id DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Veritabanındaki tüm verileri ekranda listele
    echo "<h2>Comments</h2>";
    foreach ($users as $user) {
        echo "<strong>ID:</strong> {$user['id']}<br>";
        echo "<strong>Name:</strong> {$user['created_by']}<br>";
        echo "<strong>Comment:</strong> " . nl2br($user['comment']) . "<br>";
        echo "<a href=\"?edit={$user['id']}\">Edit</a> | <a href=\"?delete={$user['id']}\">Delete</a><br><hr>";
    }

    // Düzenleme işlemi
    if (isset($_GET['edit'])) {
        $editId = $_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM post WHERE id = :id");
        $stmt->execute([':id' => $editId]);
        $editData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Formu düzenleme için doldur
        $name1 = $editData['created_by'];
        $comment = $editData['comment'];
        $id = $editData['id'];
    }

} catch (PDOException $e) {
    // Hata mesajını ekrana yazdır
    echo "Error: " . $e->getMessage();
}
?>

<!-- Form kısmı -->
<form method="post">
    Name: <input type="text" name="name" value="<?php echo isset($name1) ? $name1 : ''; ?>"><br><br>
    Comment: <textarea name="comment" rows="4" cols="40"><?php echo isset($comment) ? $comment : ''; ?></textarea><br><br>
    <button type="submit">Send comment</button>
    <?php if (isset($id)): ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    <?php endif; ?>
</form>
