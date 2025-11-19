<?php
require "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang chủ</title>
    <style>
      body {
        font-family: "Segoe UI", Arial, sans-serif;
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #5f72bd, #9b23ea);
        color: #0f172a;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 24px;
      }
      .card {
        background: #ffffff;
        width: min(720px, 100%);
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.2);
        padding: 32px;
      }
      h1 {
        margin: 0;
        font-size: 28px;
        color: #111827;
      }
      p {
        color: #4b5563;
        line-height: 1.6;
      }
      .widgets {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 16px;
        margin-top: 20px;
      }
      .widget {
        border-radius: 12px;
        padding: 16px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
      }
      .widget h3 {
        margin: 0;
        font-size: 16px;
        color: #1f2937;
      }
      .widget span {
        display: block;
        margin-top: 6px;
        font-size: 26px;
        font-weight: 600;
        color: #0ea5e9;
      }
      .actions {
        margin-top: 26px;
        display: flex;
        gap: 12px;
      }
      .btn {
        padding: 10px 16px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        cursor: pointer;
      }
      .btn.primary {
        background: #2563eb;
        color: #fff;
      }
      .btn.secondary {
        background: #fee2e2;
        color: #b91c1c;
      }
      form {
        margin: 0;
      }
      @media (max-width: 600px) {
        .card {
          padding: 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="card">
      <h1>Xin chào, <?php echo htmlspecialchars($_SESSION["fullname"]); ?> 👋</h1>
      <p>
        Đây là trang chủ giả lập. Bạn có thể thêm các module quản lý bài viết, danh sách sản phẩm, ghi chú… để luyện tập thêm với PHP/MySQL.
      </p>

      <div class="widgets">
        <div class="widget">
          <h3>Bài viết nháp</h3>
          <span>12</span>
        </div>
        <div class="widget">
          <h3>Tin nhắn mới</h3>
          <span>5</span>
        </div>
        <div class="widget">
          <h3>Lượt truy cập</h3>
          <span>1.2K</span>
        </div>
      </div>

      <div class="actions">
        <button class="btn primary" type="button">Tạo bài viết</button>
        <form action="logout.php" method="post">
          <button class="btn secondary" type="submit">Đăng xuất</button>
        </form>
      </div>
    </div>
  </body>
</html>