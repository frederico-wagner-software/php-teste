<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <style>
    @media (min-width: 768px) {

      .seven-cols .col-md-1,
      .seven-cols .col-sm-1,
      .seven-cols .col-lg-1 {
        width: 100%;
        *width: 100%;
      }
    }

    @media (min-width: 992px) {

      .seven-cols .col-md-1,
      .seven-cols .col-sm-1,
      .seven-cols .col-lg-1 {
        width: 14.285714285714285714285714285714%;
        *width: 14.285714285714285714285714285714%;
      }
    }

    /**
 *  The following is not really needed in this case
 *  Only to demonstrate the usage of @media for large screens
 */
    @media (min-width: 1200px) {

      .seven-cols .col-md-1,
      .seven-cols .col-sm-1,
      .seven-cols .col-lg-1 {
        width: 14.285714285714285714285714285714%;
        *width: 14.285714285714285714285714285714%;
      }
    }

    .padding-style {
      padding-top: 10px;
      padding-bottom: 10px;
    }
  </style>

  <title>Clima Tempo - Simples</title>
  <script>
    window.onload = () => {
      var hot = [];
      var cold = [];
      $.get('/hot', (hotData) => {
        hot = hotData;
        document.getElementById('nome1-hot').innerHTML = hot[0].nome;
        document.getElementById('nome2-hot').innerHTML = hot[1].nome;
        document.getElementById('nome3-hot').innerHTML = hot[2].nome;
        document.getElementById('temp1-hot').innerHTML = hot[0].temperatura_maxima;
        document.getElementById('temp2-hot').innerHTML = hot[1].temperatura_maxima;
        document.getElementById('temp3-hot').innerHTML = hot[2].temperatura_maxima;
      });
      $.get('/cold', (coldData) => {
        cold = coldData;
        document.getElementById('nome1-cold').innerHTML = cold[0].nome;
        document.getElementById('nome2-cold').innerHTML = cold[1].nome;
        document.getElementById('nome3-cold').innerHTML = cold[2].nome;
        document.getElementById('temp1-cold').innerHTML = cold[0].temperatura_minima;
        document.getElementById('temp2-cold').innerHTML = cold[1].temperatura_minima;
        document.getElementById('temp3-cold').innerHTML = cold[2].temperatura_minima;
      });
    }

    function getSevenTemps() {
      var cidade = document.getElementById('cidade').value;
      $.get('/nextSevenTemps?cityName=' + cidade, (cityData) => {
        document.getElementById('table-seven-temps').innerHTML = '';
        if(cityData.status === 'NOT_FOUND') {
          document.getElementById('table-seven-temps').innerHTML = '<p>Cidade não encontrada.</p>';
          return;
        }
        var html = '';
        for (var i = 0; i < cityData.length; i++) {
          html += '<div class="col-md-1">';
          html += '<div class="card" style="width: 120%">';
          html += '<div class="card-body">';
          html += '<h5 class="card-title">' + cidade + '</h5>';
          html += '<p class="card-text">' + cityData[i].data_previsao + '</p>';
          html += '<p> Temperatura mínima: ' + cityData[i].temperatura_minima + '°C</p>';
          html += '<p> Temperatura máxima: ' + cityData[i].temperatura_maxima + '°C</p>';
          html += '</div></div></div>';

        }
        html = '<h2>Clima para os próximos 7 dias para a cidade '+ cidade +'</h2>' + html;
        document.getElementById('table-seven-temps').innerHTML += html;
      });
    }

  </script>
</head>

<body>
  <div id="app" class="container">
    <h1>Clima Tempo - Simples</h1>
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Cidades mais quentes hoje</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Temperatura</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" id="nome1-hot">Cidade / UF</th>
                    <td></td>
                    <td></td>
                    <td id="temp1-hot"></td>
                  </tr>
                  <tr>
                    <th scope="row" id="nome2-hot">Cidade 2 / UF</th>
                    <td></td>
                    <td></td>
                    <td id="temp2-hot"></td>
                  </tr>
                  <tr>
                    <th scope="row" id="nome3-hot">Cidade 3 / UF</th>
                    <td colspan="2"></td>
                    <td id="temp3-hot"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Cidades mais frias hoje</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Temperatura</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" id="nome1-cold">Cidade / UF</th>
                    <td></td>
                    <td></td>
                    <td id="temp1-cold"></td>
                  </tr>
                  <tr>
                    <th scope="row" id="nome2-cold">Cidade 2 / UF</th>
                    <td></td>
                    <td></td>
                    <td id="temp2-cold"></td>
                  </tr>
                  <tr>
                    <th scope="row" id="nome3-cold">Cidade 3 / UF</th>
                    <td colspan="2"></td>
                    <td id="temp3-cold"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <BR>
        <div class="container">
          <div class="row padding-style">
            <div class="col">
              <input type="text" class="form-control" id="cidade" placeholder="Digite o nome da cidade para pesquisar">
            </div>
            <div class="col-auto">
              <button type="button" class="btn btn-primary" onclick="getSevenTemps()">Buscar</button>
            </div>
          </div>
          <div>
            <div id="table-seven-temps" class="row seven-cols">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>