<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timer Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .card-header h6 {
            font-size: 24px;
            color: #4a4a4a;
            text-align: center;
            margin-bottom: 20px;
        }

        .stopwatch {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .timer {
            text-align: center;
            padding: 10px;
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin: 0 10px;
        }

        .timer label {
            font-size: 16px;
            color: #666;
        }

        .timer h1 {
            font-size: 36px;
            margin-top: 10px;
            color: #333;
        }

        .button-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .button-container button,
        .button-container a {
            padding: 12px 20px;
            margin: 5px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-primary {
            background: linear-gradient(45deg, #6c63ff, #483d8b);
            color: #ffffff;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #5a54d4, #372b7c);
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #f0ad4e;
            color: #ffffff;
        }

        .btn-warning:hover {
            background-color: #d8933d;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #d9534f;
            color: #ffffff;
        }

        .btn-danger:hover {
            background-color: #c2443d;
            transform: scale(1.05);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #6c757d, #4a4e55);
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #5a6268, #3b3e43);
            transform: scale(1.05);
        }

        .timer-history {
            margin-top: 30px;
        }

        .timer-history .history-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f8f9fc;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .history-item i {
            font-size: 28px;
            margin-right: 15px;
            color: #6c63ff;
        }

        .history-item div {
            color: #333;
        }

        .history-item div span {
            display: block;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card-header">
            <h6>Pomodoro Timer</h6>
        </div>

        <div class="stopwatch">
            <div class="timer">
                <label>Tempo Completo</label>
                <h1 id="watch-completo">00:00</h1>
            </div>
            <div class="timer">
                <label>Tempo de Foco</label>
                <h1 id="watch-foco">00:00</h1>
            </div>
            <div class="timer">
                <label>Tempo de Descanso</label>
                <h1 id="watch-descanso">00:00</h1>
            </div>
        </div>

        <div class="button-container">
            <button id="startButton" onclick="start()" class="btn btn-primary">Start</button>
            <button id="stop-btn" onclick="stop()" class="btn btn-warning">Stop</button>
            <button id="reset-btn" onclick="reset()" class="btn btn-danger">Reset</button>
            @foreach($timer as $time)
                <a href="/apagar_time/{{$time->id_pomo}}" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </a>
                @break
            @endforeach
            <a href="{{ route('index') }}" class="btn btn-secondary">Voltar para Index</a>
        </div>

        <div class="timer-history">
            @foreach($timer as $time)
                @php
                    $temp_completo_sec = $time->temp_completo_sec == 0 ? '00' : str_pad($time->temp_completo_sec, 2, '0', STR_PAD_LEFT);
                    $temp_completo_min = str_pad($time->temp_completo_min, 2, '0', STR_PAD_LEFT);
                    $foco_min = str_pad($time->foco_min, 2, '0', STR_PAD_LEFT);
                    $foco_sec = str_pad($time->foco_sec, 2, '0', STR_PAD_LEFT);
                    $descanso_min = str_pad($time->descanso_min, 2, '0', STR_PAD_LEFT);
                    $descanso_sec = str_pad($time->descanso_sec, 2, '0', STR_PAD_LEFT);
                @endphp

                @if($time->start == 1)
                    <div class="history-item">
                        <i class="fas fa-play"></i>
                        <div>
                            <strong>Start</strong>
                            <span>Tempo Completo: {{ $temp_completo_min }}:{{ $temp_completo_sec }}</span>
                        </div>
                    </div>
                @endif

                @if($time->stop == 1)
                    <div class="history-item">
                        <i class="fas fa-stop"></i>
                        <div>
                            <strong>Stop</strong>
                            <span>Tempo Completo: {{ $temp_completo_min }}:{{ $temp_completo_sec }} | Tempo de Foco: {{ $foco_min }}:{{ $foco_sec }} | Tempo de Descanso: {{ $descanso_min }}:{{ $descanso_sec }}</span>
                        </div>
                    </div>
                @endif

                @if($time->reset == 1)
                    <div class="history-item">
                        <i class="fas fa-undo-alt"></i>
                        <div>
                            <strong>Reset</strong>
                            <span>O cronômetro foi resetado</span>
                        </div>
                    </div>
                @endif
            @endforeach
            <div id="timerContainer"></div>
        </div>
    </div>

    <div id="timerContainer"></div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        var pomoData = @json($pomo);
    </script>
    <script src="{{ asset('js/script_timer.js') }}"></script>

</body>
</html>
