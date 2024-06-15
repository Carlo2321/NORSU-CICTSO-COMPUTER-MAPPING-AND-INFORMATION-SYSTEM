<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Document</title>
  <style>
    .container {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    .background-logo {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60%;
      opacity: 0.1;
      z-index: -1;
    }

    .logo {
      height: 3vh;
      width: 15%;
      margin-bottom: 2vh;
    }

    .table-container {
      width: 100%;
    }

    h1 {
      margin-bottom: 2vh;
      z-index: 1;
      position: relative;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      z-index: 1;
      position: relative;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <div class="container">
    <img class="background-logo" src="{{ public_path('images/seal.png') }}" alt="background logo">
    <h1>Rooms with Most Working Computers</h1>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Room Name</th>
            <th>Working Computers</th>
            <th>Faulty Computers</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($rooms as $room)
            <tr>
              <td>{{ $room->roomName }}</td>
              <td style="color: green;">{{ $room->working_computers_count }}</td>
              <td style="color: red;">{{ $room->computers->where('working', false)->count() }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
