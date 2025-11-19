<?php
require "config.php";

$errors = [];
$values = [
    "fullname" => "",
    "email" => "",
    "username" => "",
    "phone" => "",
    "gender" => "",
    "country" => "",
    "terms" => false,
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($values as $key => $default) {
        if ($key === "terms") {
            $values[$key] = isset($_POST[$key]);
        } else {
            $values[$key] = trim($_POST[$key] ?? "");
        }
    }

    $password = $_POST["password"] ?? "";
    $confirm = $_POST["confirm_password"] ?? "";

    if ($values["fullname"] === "") $errors[] = "Vui lòng nhập họ tên.";
    if (!filter_var($values["email"], FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ.";
    if ($values["username"] === "") $errors[] = "Vui lòng nhập tên đăng nhập.";
    if (strlen($password) < 6) $errors[] = "Mật khẩu tối thiểu 6 ký tự.";
    if ($password !== $confirm) $errors[] = "Mật khẩu xác nhận không khớp.";
    if (!$values["terms"]) $errors[] = "Bạn phải đồng ý với điều khoản.";

    if (!$errors) {
        $stmt = $conn->prepare(
            "INSERT INTO users(fullname,email,username,password_hash,phone,gender,country) VALUES (?,?,?,?,?,?,?)"
          );
          $hash = password_hash($password, PASSWORD_DEFAULT);
        $phone = $values["phone"] ?: null;
        $gender = $values["gender"] ?: null;
        $country = $values["country"] ?: null;
        $stmt->bind_param("sssssss", $values["fullname"], $values["email"], $values["username"], $hash, $phone, $gender, $country);

        if ($stmt->execute()) {
            header("Location: login.php?registered=1");
            exit;
        }

        if ($stmt->errno === 1062) {
            if (str_contains($stmt->error, "email")) {
                $errors[] = "Email đã tồn tại.";
            } elseif (str_contains($stmt->error, "username")) {
                $errors[] = "Tên đăng nhập đã có người sử dụng.";
            } else {
                $errors[] = "Thông tin đã tồn tại.";
            }
        } else {
            $errors[] = "Có lỗi xảy ra, vui lòng thử lại.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Ký</title>
    <style>
      :root {
        --card: #ffffff;
        --accent: #3f4248;
        --muted: #6b7280;
      }
      html,
      body {
        height: 100%;
      }
      body {
        font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        background: #423e69;
        padding: 28px 16px;
        color: #111827;
      }
      .container {
        max-width: 520px;
        margin: 28px auto;
        background: var(--card);
        padding: 22px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(15, 23, 42, 0.04);
      }
      .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 6px;
      }
      .logo {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--accent), #60a5fa);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
      }
      h1 {
        font-size: 20px;
        margin: 0;
      }
      p.lead {
        margin: 6px 0 14px;
        color: var(--muted);
        font-size: 14px;
      }

      label {
        display: block;
        margin-top: 12px;
        font-weight: 600;
        font-size: 13px;
      }
      input[type="text"],
      input[type="email"],
      input[type="password"],
      select {
        width: 100%;
        padding: 10px 12px;
        margin-top: 8px;
        box-sizing: border-box;
        border-radius: 8px;
        border: 1px solid #e6e9ef;
        background: #4fd1c2;
        transition: box-shadow 0.15s, border-color 0.15s;
        font-size: 14px;
        color: #0f172a;
      }
      input:focus,
      select:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.12);
      }

      .row {
        display: flex;
        gap: 12px;
      }
      .row .col {
        flex: 1;
      }
      .small {
        font-size: 13px;
        color: var(--muted);
      }

      .actions {
        margin-top: 18px;
        display: flex;
        gap: 10px;
        align-items: center;
      }
      .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #578038;
        color: #fff;
        padding: 10px 14px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        font-weight: 600;
      }
      .error-list {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 10px 14px;
        border-radius: 8px;
        margin: 12px 0 4px;
        font-size: 14px;
      }
      .success {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
        padding: 10px 14px;
        border-radius: 8px;
        margin-top: 12px;
        font-size: 14px;
      }
      @media (max-width: 520px) {
        .container {
          margin: 16px;
          padding: 16px;
          color: #578038;
          background-color: #cbcbb1;
        }
        .row {
          flex-direction: column;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="brand">
        <div class="logo">DK</div>
        <div>
          <h1>Đăng Ký Tài Khoản</h1>
          <p class="lead">Tạo tài khoản mới để sử dụng dịch vụ — nhanh và an toàn.</p>
        </div>
      </div>

      <?php if ($errors): ?>
      <div class="error-list">
        <?php foreach ($errors as $error): ?>
        <div><?php echo htmlspecialchars($error); ?></div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <form id="regForm" action="" method="post" novalidate>
        <label for="fullname">Họ và tên</label>
        <input type="text" id="fullname" name="fullname" placeholder="Nhập họ và tên" required value="<?php echo htmlspecialchars($values["fullname"]); ?>" />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required value="<?php echo htmlspecialchars($values["email"]); ?>" />

        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" placeholder="Ví dụ: nguyenvana" required value="<?php echo htmlspecialchars($values["username"]); ?>" />

        <div class="row">
          <div class="col">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Tối thiểu 6 ký tự" minlength="6" required />
          </div>
          <div class="col">
            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Gõ lại mật khẩu" required />
          </div>
        </div>

        <label for="phone">Số điện thoại</label>
        <input type="text" id="phone" name="phone" placeholder="(tuỳ chọn)" value="<?php echo htmlspecialchars($values["phone"]); ?>" />

        <label>Giới tính</label>
        <div class="small">
          <label>
            <input type="radio" name="gender" value="male" <?php echo $values["gender"] === "male" ? "checked" : ""; ?> />
            Nam
          </label>

          <label>
            <input type="radio" name="gender" value="female" <?php echo $values["gender"] === "female" ? "checked" : ""; ?> />
            Nữ
          </label>

          <label>
            <input type="radio" name="gender" value="other" <?php echo $values["gender"] === "other" ? "checked" : ""; ?> />
            Khác
          </label>
        </div>

        <label for="country">Quốc gia</label>
        <select id="country" name="country">
          <option value="">-- Chọn --</option>
          <option value="vn" <?php echo $values["country"] === "vn" ? "selected" : ""; ?>>Việt Nam</option>
          <option value="us" <?php echo $values["country"] === "us" ? "selected" : ""; ?>>Hoa Kỳ</option>
          <option value="jp" <?php echo $values["country"] === "jp" ? "selected" : ""; ?>>Nhật Bản</option>
        </select>

        <div style="margin-top: 12px">
          <label>
            <input type="checkbox" id="terms" name="terms" required <?php echo $values["terms"] ? "checked" : ""; ?> />
            Tôi đồng ý với điều khoản
          </label>
        </div>

        <div class="actions">
          <button class="btn" type="submit">Đăng Ký</button>
        </div>
      </form>
      <div class="small" style="margin-top: 12px">
        Đã có tài khoản?
        <a href="login.php">Đăng nhập</a>
      </div>
    </div>
  </body>
</html>