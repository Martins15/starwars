function loadData(url) {
  for (const dd of document.querySelectorAll('dd')) {
    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({query: dd.dataset.query})
    })
      .then(r => r.json())
      .then(data => renderData(dd, data));
  }
  document.getElementById('button').classList.add('active');
  document.getElementById('content').style.display = 'block';
}

function renderData(dd, data) {
  let key = Object.keys(data.data)[0];
  let output = '';
  data = data.data[key];
  switch (key) {
    case 'popularCharacter':
      output = data.join(', ');
      break;
    case 'speciesCount':
      for (let i in data) {
        output += "<p>" + data[i][0] + " (" + data[i][1] + ")</p>";
      }
      break;
    case 'pilots':
      for (let j in data) {
        output += "<p>Planet: " + data[j].name + " - Pilots: (" + data[j].count + ") ";
        for (let k in data[j].pilots) {
          output += data[j].pilots[k][0];
          // Some people don't have species.
          if (data[j].pilots[k][1]) {
            output += " - " + data[j].pilots[k][1];
          }
          if (k < data[j].pilots.length - 1) {
            output += ', ';
          }
        }
        output += '</p>';
      }
      break;
    default:
      output = data;
      break;
  }
  dd.innerHTML = output;
}
