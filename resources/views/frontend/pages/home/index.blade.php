<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UchiMart — Mini Mart Online</title>
    <meta name="description" content="UchiMart - Mini Mart Online với sản phẩm tươi ngon, giá hợp lý và giao hàng nhanh chóng." />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/media/logos/download.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="flaticon.css" />

    <style>
        :root {
            --bg: #0b0c10;
            --bg-soft: #111318;
            --main: #931373;
            --text: #e7e9ee;
            --muted: #a5adba;
            --brand: #7c5cff;
            --line: #232634;
            --ok: #10b981;
            --warn: #f59e0b;
            --bad: #ef4444;
            --radius: 18px;
            --shadow: 0 10px 30px rgba(0,0,0,.35);
        }

        .light {
            --bg: #f7f8fb;
            --bg-soft: #ffffff;
            --text: #0b0c10;
            --muted: #475069;
            --line: #e9edf2;
            --brand: #5b44ff;
            --shadow: 0 10px 30px rgba(12,15,32,.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        /* Header */
        header {
            position: sticky; top: 0; z-index: 50;
            backdrop-filter: saturate(160%) blur(8px);
            background: linear-gradient(to bottom, rgba(0,0,0,.45), transparent);
            transition: background 0.3s ease;
        }

        header.scrolled {
            background: var(--bg-soft);
            box-shadow: var(--shadow);
        }

        .nav {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 0; border-bottom: 1px solid var(--line);
        }

        .brand {
            display: flex; align-items: center; gap: 10px;
            font-weight: 800; font-size: 24px;
            animation: slideInLeft 0.8s ease-out;
        }

        .brand-badge {
            width: 32px; height: 32px; border-radius: 12px;
            background: conic-gradient(from 140deg, var(--brand), #00d0ff, #00ff88, #ffd400, var(--brand));
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .brand-badge:hover { transform: rotate(360deg) scale(1.1); }
        .spacer { flex: 1; }

        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            /* border: 1px solid var(--line); background: var(--bg-soft); */
            padding: 10px 100px; border-radius: 14px; cursor: pointer;
            transition: all 0.3s ease; position: relative; overflow: hidden;
        }

        .btn::before {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%; background: rgba(255,255,255,0.2);
            transition: left 0.3s ease;
        }

        .btn:hover::before { left: 0; }
        .btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow);
            background: var(--brand);
            color: white;
            border-color: transparent;
        }

        .btn.primary {
            background: linear-gradient(135deg, var(--brand), var(--ok));
            border-color: transparent;
            color: white;
        }

        .btn.primary:hover {
            background: linear-gradient(135deg, var(--ok), var(--brand));
            transform: translateY(-2px) scale(1.1);
        }

        /* Hero Section */
        .hero {
            padding: 100px 0 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            animation: fadeIn 1.2s ease-out;
        }

        .hero::before {
            content: ''; position: absolute; top: 0; left: 0;
            width: 100%; height: 100%; opacity: 0.2;
            background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.3), transparent 80%);
            animation: pulse 12s ease-in-out infinite;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 60px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
            animation: slideInUp 1s ease-out 0.2s both;
        }

        .hero p {
            color: var(--muted);
            max-width: 700px;
            margin: 0 auto 30px;
            font-size: 20px;
            line-height: 1.6;
            animation: slideInUp 1s ease-out 0.4s both;
        }

        .hero .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .full-screen {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .floating-icons {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .food-icon {
            position: absolute;
            top: var(--y);
            left: var(--x);
            width: 50px;
            height: 50px;
            opacity: 0.8;
            animation: floatIcon 6s ease-in-out infinite alternate;
        }

        .food-icon:nth-child(2) { animation-delay: 1s; }
        .food-icon:nth-child(3) { animation-delay: 2s; }
        .food-icon:nth-child(4) { animation-delay: 3s; }
        .food-icon:nth-child(5) { animation-delay: 4s; }

        @keyframes floatIcon {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
            100% { transform: translateY(0) rotate(-10deg); }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        /* Keyframes */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideInLeft { from { transform: translateX(-50px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes slideInUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes fadeInUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes pulse { 0%, 100% { transform: scale(1); opacity: 0.2; } 50% { transform: scale(1.15); opacity: 0.35; } }

        /* Responsive */
        @media (max-width: 768px) {
            .hero { padding: 60px 20px; }
            .hero h1 { font-size: 40px; }
            .hero p { font-size: 16px; }
            .feature-item { flex-direction: column !important; text-align: center; }
            .feature-image { max-width: 100%; }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="hero full-screen">
            <div class="floating-icons">
                <!-- Existing icons -->
                <img src="https://cdn-icons-png.flaticon.com/512/415/415734.png" class="food-icon" style="--x:20%;--y:25%;" />
                <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" class="food-icon" style="--x:80%;--y:30%;" />
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="food-icon" style="--x:20%;--y:70%;" />
                <img src="https://cdn-icons-png.flaticon.com/512/135/135620.png" class="food-icon" style="--x:70%;--y:75%;" />
                <img src="https://cdn-icons-png.flaticon.com/512/415/415733.png" class="food-icon" style="--x:50%;--y:10%;" />

                <!-- New icons -->
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046786.png" class="food-icon" style="--x:30%;--y:15%;" /> 
                <img src="https://cdn-icons-png.flaticon.com/512/415/415686.png" class="food-icon" style="--x:60%;--y:25%;" /> 
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046788.png" class="food-icon" style="--x:40%;--y:80%;" /> 
                <img src="https://cdn-icons-png.flaticon.com/512/135/135621.png" class="food-icon" style="--x:75%;--y:50%;" /> 
                <img src="https://cdn-icons-png.flaticon.com/512/415/415684.png" class="food-icon" style="--x:25%;--y:80%;" /> 
            </div>

            <div class="hero-content">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-uchimart.png') }}" 
                     style="width: 450px; animation: float 3s ease-in-out infinite;" />
                <h1>Quản lý cửa hàng dễ dàng</h1>
                <p>Hệ thống quản trị thông minh, giúp bạn kiểm soát sản phẩm, đơn hàng và khách hàng một cách hiệu quả và nhanh chóng.</p>
            </div>

            <div class="">
                <a style="text-decoration: none" class="btn" href="http://127.0.0.1:8000/backoffice/login">Bắt đầu ngay</a>
            </div>
        </section>
    </main>

    <script>
        const modeBtn = document.getElementById('modeBtn');
        const header = document.querySelector('header');

        const applyTheme = (t) => {
            document.documentElement.classList.toggle('light', t === 'light');
            localStorage.setItem('theme', t);
            modeBtn.textContent = t === 'light' ? '☀️ Mode' : '🌙 Mode';
        };

        const saved = localStorage.getItem('theme') || 'dark';
        applyTheme(saved);

        modeBtn.addEventListener('click', () => {
            const t = document.documentElement.classList.contains('light') ? 'dark' : 'light';
            applyTheme(t);
        });

        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>
