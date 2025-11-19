<?php
require "config.php";

$msg = "";
$errors = [];
$usernameValue = "";

if (isset($_GET["registered"])) {
    $msg = "Đăng ký thành công, hãy đăng nhập.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameValue = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($usernameValue === "") $errors[] = "Vui lòng nhập tên đăng nhập.";
    if ($password === "") $errors[] = "Vui lòng nhập mật khẩu.";

    if (!$errors) {
        $stmt = $conn->prepare("SELECT id, fullname, password_hash FROM users WHERE username=?");
        $stmt->bind_param("s", $usernameValue);
        $stmt->execute();
        $stmt->bind_result($id, $fullname, $pwHash);
        if ($stmt->fetch() && password_verify($password, $pwHash)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["fullname"] = $fullname;
            header("Location: home.php");
            exit;
        } else {
            $errors[] = "Sai tên đăng nhập hoặc mật khẩu.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
      :root {
        --bg: #7c7971;
        --card: #dfcfcf;
        --accent: #2b7da3;
        --muted: #6b7280;
        --danger: #dc2626;
      }
      * {
        box-sizing: border-box;
      }
      body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: var(--bg);
        color: #0f172a;
        padding: 24px;
      }
      .wrap {
        max-width: 420px;
        margin: 36px auto;
        padding: 0 8px;
      }
      .card {
        background: var(--card);
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 6px 20px rgba(2, 6, 23, 0.08);
        border: 1px solid rgba(2, 6, 23, 0.04);
      }
      h2 {
        margin: 0 0 6px;
        font-size: 20px;
      }
      p.lead {
        margin: 0 0 14px;
        color: var(--muted);
        font-size: 14px;
      }
      label {
        display: block;
        font-weight: 600;
        margin-top: 12px;
        font-size: 13px;
      }
      input[type="text"],
      input[type="password"] {
        width: 100%;
        padding: 10px 12px;
        margin-top: 8px;
        border-radius: 8px;
        border: 2px solid #8c8d79;
        background: #dae3ec;
        font-size: 14px;
      }
      input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 8px 24px rgba(14, 165, 233, 0.08);
      }
      .error-list {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 12px;
        font-size: 14px;
      }
      .message {
        background: #dbeafe;
        border: 1px solid #bfdbfe;
        color: #1d4ed8;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 12px;
        font-size: 14px;
      }
      .row {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-top: 12px;
      }
      .show-pass {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--muted);
        font-size: 13px;
      }
      .actions {
        display: flex;
        gap: 10px;
        margin-top: 18px;
      }
      .btn {
        background: #4f6047;
        color: #fff;
        padding: 10px 14px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-weight: 600;
      }
      .btn.register {
        background: #e0e7ff;
        color: #34382f;
        border: 1px solid rgba(14, 165, 233, 0.14);
      }
      body.dark{
      background: rgba(50, 50, 50, 1);
      }
    </style>
  </head>
  <body>
    <div class="wrap">
      <div class="card">
        <h2>Đăng nhập</h2>
        <p class="lead">Nhập tên đăng nhập và mật khẩu của bạn.</p>

        <?php if ($msg): ?>
        <div class="message"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <?php if ($errors): ?>
        <div class="error-list">
          <?php foreach ($errors as $error): ?>
          <div><?php echo htmlspecialchars($error); ?></div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form id="loginForm" action="" method="post" novalidate>
          <label for="username">Tên đăng nhập</label>
          <input type="text" id="username" name="username" placeholder="NguyenVanA" autocomplete="username" value="<?php echo htmlspecialchars($usernameValue); ?>" />

          <label for="password">Mật khẩu</label>
          <input type="password" id="password" name="password" placeholder="••••••••" autocomplete="current-password" />

          <div class="actions">
            <button class="btn" type="submit">Đăng nhập</button>
            <button type="button" class="btn register" onclick="location.href='register.php'">Đăng ký</button>
              
            <label for="checkbg">Trans bg</label>
          <input type="checkbox" name="" id="checkbg"  onclick="document.body.classList.toggle('dark')">
          </div>
        </form>
      </div>
    </div>
    
  </body>
</html>