<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UchiMart — Mini Mart Online</title>
    <meta name="description" content="UchiMart - Mini Mart Online với sản phẩm tươi ngon, giá hợp lý và giao hàng nhanh chóng." />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/media/logos/download.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg: #ffffff;
            --bg-soft: #f7f8fa;
            --text: #0b0c10;
            --muted: #555555;
            --line: #e0e0e0;
            --radius: 12px;
            --shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        /* Header */
        header {
            position: sticky;
            top: 0;
            background: var(--bg-soft);
            border-bottom: 1px solid var(--line);
            z-index: 50;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .brand {
            font-weight: 700;
            font-size: 22px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: var(--radius);
            border: 1px solid var(--line);
            background: #ffffff;
            color: var(--text);
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .btn:hover {
            background: var(--bg-soft);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            padding: 80px 20px;
            text-align: center;
        }

        .hero-content img {
            width: 300px;
            margin-bottom: 30px;
        }

        .hero h1 {
            font-size: 40px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            color: var(--muted);
            max-width: 700px;
            margin: 0 auto 30px;
            line-height: 1.5;
        }

        .hero .btn-group {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 { font-size: 28px; }
            .hero p { font-size: 16px; }
            .hero-content img { width: 200px; }
        }
    </style>
</head>
<body>
    <header>
        <button class="btn" id="loginBtn">Đăng nhập</button>
    </header>
    <main class="container">
        <section class="hero">
            <div class="hero-content">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-uchimart.png') }}" />
                <h1>Quản lý cửa hàng dễ dàng</h1>
                <p>Hệ thống quản trị thông minh, giúp bạn kiểm soát sản phẩm, đơn hàng và khách hàng một cách hiệu quả và nhanh chóng.</p>
            </div>
        </section>
    </main>

    <script>
        const modeBtn = document.getElementById('modeBtn');

        const applyTheme = (t) => {
            document.documentElement.classList.toggle('light', t === 'light');
            localStorage.setItem('theme', t);
            modeBtn.innerHTML = t === 'light' ? '<i class="fas fa-sun"></i> Mode' : '<i class="fas fa-moon"></i> Mode';
        };

        const saved = localStorage.getItem('theme') || 'dark';
        applyTheme(saved);

        modeBtn.addEventListener('click', () => {
            const t = document.documentElement.classList.contains('light') ? 'dark' : 'light';
            applyTheme(t);
        });
    </script>
</body>
</html>
