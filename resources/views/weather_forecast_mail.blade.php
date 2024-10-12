<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự báo thời tiết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            font-size: 24px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .weather-icon {
            text-align: center;
        }
        .weather-icon img {
            width: 100px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daily Report: {{ $date }}</h1>
        <div class="weather-icon">
            <img src="https:{{ $icon }}" alt="Weather Icon">
        </div>
        <p><strong>Thời tiết:</strong> {{ $condition }}</p>
        <p><strong>Nhiệt độ trung bình:</strong> {{ $temperature }}</p>
        <p><strong>Độ ẩm trung bình:</strong> {{ $humidity }}</p>
        <p><strong>Tốc độ gió:</strong> {{ $wind }}</p>

        <div class="footer">
            <p>Đây là email tự động, vui lòng không trả lời.</p>
            <p>&copy; {{ date('Y') }} Weather App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
