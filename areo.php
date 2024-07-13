<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
  <!-- <h1>Flight Finder</h1> -->
  <label for="startStation">Start Station:</label>
  <input type="text" id="startStation" name="startStation"><br><br>
  <label for="endStation">End Station:</label>
  <input type="text" id="endStation" name="endStation"><br><br>
  <label for="departureDate">Departure Date:</label>
  <input type="date" id="departureDate" name="departureDate"><br><br>
  <label for="adults">Number of Adults:</label>
  <input type="number" id="adults" name="adults" value="1" min="1"><br><br>
  <button onclick="findFlights()">Find Flights</button>
  <br>
  <h2>Available Flights</h2>
  <br>
  <div style="height:250px; overflow-y:scroll">
  <ul id="flightList"></ul>
  </div>

  <script src="aeroplane.js"></script>
</body>
</html>