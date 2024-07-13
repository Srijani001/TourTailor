const AMADEUS_API_KEY = 'API_KEY';
const AMADEUS_API_SECRET = 'SECRET_KEY';

let accessToken = '';

async function getAccessToken() {
  const response = await fetch('https://test.api.amadeus.com/v1/security/oauth2/token', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({
      'grant_type': 'client_credentials',
      'client_id': AMADEUS_API_KEY,
      'client_secret': AMADEUS_API_SECRET
    })
  });

  const data = await response.json();
  accessToken = data.access_token;
  console.log('Access Token:', accessToken); // Debug: Print Access Token
}

$(function() {
  $("#startStation, #endStation").autocomplete({
    source: async function(request, response) {
      if (!accessToken) {
        await getAccessToken();
      }

      const term = request.term;
      const airportData = await fetch(`https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT,CITY&keyword=${term}&page[limit]=5`, {
        headers: {
          'Authorization': `Bearer ${accessToken}`
        }
      }).then(res => res.json());

      const airportNames = airportData.data.map(airport => airport.iataCode + ' - ' + airport.name);
      response(airportNames);
    },
    minLength: 2
  });
});

async function findFlights() {
  if (!accessToken) {
    await getAccessToken();
  }

  const startStation = document.getElementById('startStation').value.split(' - ')[0];
  const endStation = document.getElementById('endStation').value.split(' - ')[0];
  const departureDate = document.getElementById('departureDate').value;
  const adults = document.getElementById('adults').value;

  // Check for empty inputs
  if (!startStation || !endStation || !departureDate || !adults) {
    alert('Please enter all fields.');
    return;
  }

  const flightUrl = `https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=${startStation}&destinationLocationCode=${endStation}&departureDate=${departureDate}&adults=${adults}`;

  console.log('Flight Request URL:', flightUrl); // Debug: Print Flight Request URL

  const response = await fetch(flightUrl, {
    headers: {
      'Authorization': `Bearer ${accessToken}`
    }
  });

  if (response.ok) {
    const data = await response.json();
    console.log('Flight Data:', data); // Debug: Print Flight Data
    displayFlights(data);
  } else {
    const errorData = await response.json();
    console.error('API Error:', errorData); // Debug: Print API Error
    alert('Failed to fetch flight information: ' + (errorData.errors ? errorData.errors[0].detail : 'Unknown error'));
  }
}

function displayFlights(data) {
  const flightList = document.getElementById('flightList');
  flightList.innerHTML = '';

  if (!data.data || data.data.length === 0) {
    flightList.innerHTML = '<li>No flights found</li>';
    return;
  }

  data.data.forEach(offer => {
    offer.itineraries.forEach(itinerary => {
      itinerary.segments.forEach(segment => {
        const listItem = document.createElement('li');
        listItem.textContent = `Flight: ${segment.carrierCode} - Departure: ${segment.departure.at}`;
        flightList.appendChild(listItem);
      });
    });
  });
}
