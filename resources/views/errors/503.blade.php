<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calorize — {{ app()->getLocale() === 'uk' ? 'Коротка пауза' : 'We’ll be right back' }}</title>
    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-amber: rgba(245, 158, 11, 0.18);
            --bg-sky: rgba(14, 165, 233, 0.16);
            --text-main: #0c0a09;
            --text-muted: #57534e;
            --border: #e7e5e4;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(1200px circle at 18% -10%, var(--bg-amber), transparent 55%),
                radial-gradient(900px circle at 90% 10%, var(--bg-sky), transparent 50%),
                linear-gradient(to bottom, #fafaf9, #ffffff);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }
        .shell {
            width: 100%;
            max-width: 960px;
        }
        .card {
            position: relative;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(10px);
            border-radius: 28px;
            padding: 32px 28px;
            box-shadow:
                0 24px 70px rgba(12, 10, 9, 0.08),
                0 2px 10px rgba(12, 10, 9, 0.04);
            overflow: hidden;
        }
        .glow {
            position: absolute;
            inset: -80px -40px auto auto;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.18), transparent 50%);
            filter: blur(8px);
            z-index: 0;
        }
        .header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .logo {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: #fff;
            display: grid;
            place-items: center;
            padding: 10px;
        }
        h1 {
            margin: 0;
            font-size: clamp(26px, 3vw, 32px);
            line-height: 1.1;
            letter-spacing: -0.02em;
        }
        p.lead {
            margin: 12px 0 0;
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.55;
            max-width: 640px;
        }
        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 18px 0 8px;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.9);
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
        }
        .badge span {
            display: inline-flex;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
            box-shadow: 0 0 0 6px rgba(245, 158, 11, 0.12);
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }
        .btn {
            appearance: none;
            border: none;
            cursor: pointer;
            border-radius: 16px;
            padding: 12px 18px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: transform 0.12s ease, box-shadow 0.2s ease, background 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn.primary {
            background: #0c0a09;
            color: #fff;
            box-shadow: 0 12px 30px rgba(12, 10, 9, 0.18);
        }
        .btn.secondary {
            background: #fff;
            color: var(--text-main);
            border: 1px solid var(--border);
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .footnote {
            margin-top: 18px;
            font-size: 13px;
            color: var(--text-muted);
        }
        @media (max-width: 640px) {
            .card { padding: 26px 22px; }
            .actions { flex-direction: column; align-items: stretch; }
            .btn { justify-content: center; width: 100%; }
        }
    </style>
</head>
<body>
<div class="shell">
    <div class="card">
        <div class="glow" aria-hidden="true"></div>
        <div class="header">
            <div class="logo">
                <img src="{{ asset('favicon/favicon.svg') }}"
                     onerror="this.onerror=null;this.src='{{ asset('logo.png') }}';"
                     alt="Calorize" width="32" height="32">
            </div>
            <div>
                <h1>{{ app()->getLocale() === 'uk' ? 'Ми викочуємо оновлення' : 'We’re shipping an update' }}</h1>
                <p class="lead">
                    {{ app()->getLocale() === 'uk'
                        ? 'Сервіс на кілька хвилин у режимі обслуговування. Повернемося як тільки деплой завершиться.'
                        : 'Calorize is in maintenance mode for a few minutes while we deploy. We’ll be back as soon as it finishes.' }}
                </p>
            </div>
        </div>

        <div class="badges">
            <div class="badge"><span></span>{{ app()->getLocale() === 'uk' ? 'Зберігаємо ваші дані' : 'Keeping your data safe' }}</div>
            <div class="badge"><span></span>{{ app()->getLocale() === 'uk' ? 'Покращуємо щоденник' : 'Polishing the diary' }}</div>
            <div class="badge"><span></span>{{ app()->getLocale() === 'uk' ? 'AI пам’ятає контекст' : 'AI memory stays intact' }}</div>
        </div>

        <div class="actions">
            @auth
                <a class="btn primary" href="{{ route('diary') }}">
                    {{ app()->getLocale() === 'uk' ? 'Відкрити щоденник' : 'Go to diary' }}
                </a>
                <a class="btn secondary" href="{{ route('statistic') }}">
                    {{ app()->getLocale() === 'uk' ? 'Переглянути статистику' : 'View stats' }}
                </a>
            @else
                <a class="btn primary" href="{{ route('register') }}">
                    {{ app()->getLocale() === 'uk' ? 'Створити акаунт' : 'Create account' }}
                </a>
                <a class="btn secondary" href="{{ route('about') }}">
                    {{ app()->getLocale() === 'uk' ? 'Дізнатися більше' : 'Learn more' }}
                </a>
            @endauth
        </div>

        <div class="footnote">
            {{ app()->getLocale() === 'uk'
                ? 'Поверніться за кілька хвилин — новий Calorize вже майже готовий.'
                : 'Check back in a few minutes — the new Calorize is almost ready.' }}
        </div>
    </div>
</div>
</body>
</html>
