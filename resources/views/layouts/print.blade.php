<!DOCTYPE html>
<html>
<head>
    <title>Print Layout</title>
    <style>
        @media print {
            body {
                background: #fff;
            }

            .uiverse-container {
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                margin-top: 0;
            }

            .uiverse {
                margin: 10px;
                box-shadow: none;
            }

            .tooltip {
                display: none;
            }

            .legend,
            .back-button,
            .exit-button,
            .savePositionsBtn,
            .print-button,
            .computer-counts {
                display: none;
            }

            .current-room {
                display: block;
                margin: 10px auto;
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }
        }

        body {
            background: #f0f0f0;
        }

        .uiverse-container {
            display: flex;
            flex-wrap: nowrap;
            justify-content: flex-start;
            align-items: flex-start;
            margin-top: 20px;
        }

        .uiverse {
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .current-room {
            display: none;
        }

        .tooltip,
        .legend,
        .back-button,
        .exit-button,
        .savePositionsBtn,
        .print-button,
        .computer-counts {
            display: block;
        }
    </style>
</head>
<body>
    <div class="current-room">
        Room: {{ $room->roomName }}
    </div>
    <div class="uiverse-container">
        <!-- Your room layout HTML here -->
        <!-- Example of room layout content -->
        <div class="uiverse">Computer 1</div>
        <div class="uiverse">Computer 2</div>
        <div class="uiverse">Computer 3</div>
        <!-- Add more computer elements as needed -->
    </div>
</body>
</html>
