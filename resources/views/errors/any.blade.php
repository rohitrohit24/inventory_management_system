<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Something Went Wrong' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
            color: #1e293b;
            min-height: 100vh;
            overflow-x: hidden;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Outer Container */
        .error-wrapper {
            position: relative;
            width: 100%;
            max-width: 800px;
            text-align: center;
            padding: 20px;
        }

        /* 1. Behind/Background: Fishing Animation Scene */
        .animation-container {
            position: relative;
            width: 100%;
            height: 350px;
            margin-bottom: -30px;
            /* Text ke sath overlap karne ke liye */
            z-index: 1;
            /* Piche rahega */
        }

        /* Sea/Water Base */
        .sea {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(180deg, #3b82f6, #1d4ed8);
            border-radius: 20px 20px 0 0;
            overflow: hidden;
        }

        /* Wave Animation */
        .wave {
            position: absolute;
            width: 200%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            top: -10px;
            left: 0;
            border-radius: 40%;
            animation: waveMotion 12s infinite linear;
        }

        @keyframes waveMotion {
            0% {
                transform: translateX(0) rotate(0deg);
            }

            100% {
                transform: translateX(-50%) rotate(360deg);
            }
        }

        /* Fisher in Boat */
        .boat-man {
            position: absolute;
            bottom: 60px;
            left: 50%;
            transform: translateX(-50%);
            width: 180px;
            height: auto;
            animation: boatRock 4s ease-in-out infinite;
            transform-origin: center bottom;
        }

        @keyframes boatRock {

            0%,
            100% {
                transform: translateX(-50%) translateY(0) rotate(-2deg);
            }

            50% {
                transform: translateX(-50%) translateY(-6px) rotate(3deg);
            }
        }

        /* Rod and Fishing Line */
        .fishing-rod {
            stroke: #475569;
            stroke-width: 3;
            fill: none;
        }

        .fishing-line {
            stroke: #94a3b8;
            stroke-width: 1.5;
            fill: none;
            stroke-dasharray: 4, 4;
        }

        /* Fish Hooked on the line */
        .fish {
            animation: fishWiggle 1.5s ease-in-out infinite alternate;
            transform-origin: center;
        }

        @keyframes fishWiggle {
            0% {
                transform: rotate(-5deg) translateY(0);
            }

            100% {
                transform: rotate(10deg) translateY(5px);
            }
        }

        /* Floating status badge on hook */
        .status-bubble {
            position: absolute;
            bottom: 40px;
            left: calc(50% + 40px);
            /* Hook ke exact upar aligned */
            background-color: #ef4444;
            color: white;
            font-weight: 800;
            font-size: 1.1rem;
            padding: 4px 12px;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.4);
            z-index: 2;
            animation: bubbleFloat 2s ease-in-out infinite alternate;
        }

        @keyframes bubbleFloat {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-8px);
            }
        }

        /* 2. Foreground Content (Overlapping) */

        .error-code {
            font-size: 6rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: 10px;
            letter-spacing: -2px;
        }

        /* 2. Foreground Content (Overlapping) */
        .content-card {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.7);
            z-index: 10;
            /* Sabse upar dikhega */

            /* Add these 2 lines for safety */
            overflow: hidden;
            word-wrap: break-word;
        }

        .error-text {
            color: #64748b;
            font-size: 1.1rem;
            max-width: 450px;
            margin: 0 auto 30px auto;
            line-height: 1.6;

            /* Add these 3 lines to force text wrap */
            word-break: break-word;
            /* Lambe single words ko split karega */
            overflow-wrap: break-word;
            /* Normal sentences ko automatic wrap karega */
            white-space: normal;
            /* Extra spaces ko default standard flow mein rakhega */
        }


        .btn-home {
            background-color: #2563eb;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 12px;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
        }

        .btn-home:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.3);
            color: white;
        }
    </style>
</head>

<body>

    <div class="error-wrapper">

        <!-- 1. Fishing Animation Scene (Behind) -->
        <div class="animation-container">

            <!-- Live status bubble representing current error -->
            <div class="status-bubble">Error {{ $status ?? 500 }}</div>

            <!-- SVG Boat & Fishing Man Canvas -->
            <svg class="boat-man" viewBox="0 0 200 150">
                <!-- Boat Body -->
                <path d="M 30,120 L 170,120 L 155,140 L 45,140 Z" fill="#b45309" />
                <rect x="50" y="115" width="100" height="5" fill="#78350f" />

                <!-- Fisher Body (Stylized) -->
                <circle cx="80" cy="85" r="12" fill="#fda4af" /> <!-- Head -->
                <path d="M 80,97 Q 75,120 70,120 Q 90,120 90,97 Z" fill="#0f172a" /> <!-- Torso -->

                <!-- Straw Hat -->
                <path d="M 65,80 Q 80,65 95,80 Z" fill="#eab308" />
                <ellipse cx="80" cy="80" rx="25" ry="3" fill="#ca8a04" />

                <!-- Fishing Rod -->
                <path d="M 85,95 L 150,45" class="fishing-rod" />
                <!-- Fishing Line dangling to water -->
                <path d="M 150,45 L 150,115" class="fishing-line" />

                <!-- Hook & Hooked Fish -->
                <g class="fish" transform="translate(142, 110)">
                    <!-- Hook -->
                    <path d="M 8,5 Q 8,12 4,12 Q 1,12 1,8" fill="none" stroke="#94a3b8" stroke-width="1.5" />
                    <!-- Fish Body -->
                    <ellipse cx="14" cy="18" rx="10" ry="6" fill="#3b82f6" />
                    <!-- Fish Tail -->
                    <polygon points="24,14 24,22 19,18" fill="#2563eb" />
                    <!-- Eye -->
                    <circle cx="10" cy="16" r="1" fill="white" />
                </g>
            </svg>

            <!-- Sea Waves -->
            <div class="sea">
                <div class="wave"></div>
            </div>
        </div>

        <!-- 2. Main Error Content (Foreground Overlapping) -->
        <div class="content-card">
            <div class="error-code">{{ $status ?? 500 }}</div>
            <h1 class="error-title">{{ $title ?? 'Internal Server Error' }}</h1>
            <p class="error-text">
                {{ $message ?? 'Sorry, we encountered an error while processing your request. Please try again or head back to home.' }}
            </p>
            <a href="/" class="btn-home">Back to Dashboard</a>
        </div>

    </div>

</body>

</html>
