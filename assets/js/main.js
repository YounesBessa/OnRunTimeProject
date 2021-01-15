$(document).ready(function () {
  $('#logs').click(function (e) {
    e.preventDefault()
    $.ajax({
      type: 'GET',
      url: 'https://floriandoyen.fr/resources/frames.php',
      data: {
      },
      // dataType: 'json',
      beforeSend: function () {
        // out btn submit
        console.log('requete')
        $('#logs').css('display', 'none')

      },
      success: function (response) {
        console.log(response)
        console.log('ok')
        $.ajax({
          type: 'POST',
          url: 'ajax/logs.php',
          data: { 'trames': response },
          beforeSend: function () {
            // out btn submit
            console.log('requete2')
          },
          success: function (response) {
            console.log(response)


            let counters = { TCP: 0, UDP: 0, TLS: 0, ICMP: 0 }
            response.forEach(trame => {
              if (trame.protocol_name == 'ICMP') counters.ICMP++;
              else if (trame.protocol_name == 'UDP') counters.UDP++;
              else if (trame.protocol_name == 'TLSv1.2') counters.TLS++;
              else if (trame.protocol_name == 'TCP') counters.TCP++;
            });

            console.log(counters)
            // pour les charts

            var ctx = document.getElementById('myChart1').getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
              type: 'doughnut',

              // The data for our dataset
              data: {
                labels: ['ICMP', 'UDP', 'TLSv1.2', 'TCP'],
                datasets: [{
                  label: 'Nombre de trames par type de requête',
                  backgroundColor: [
                    'grey',
                    'darkblue',
                    'skyblue',
                    'rgb(0,0,25)',
                  ],
                  borderColor: '#fff',

                  data: [counters.ICMP, counters.UDP, counters.TLS, counters.TCP]
                }]
              },

              // Configuration options go here
              options: {}
            });

            var arrDuration1 = 0;
            var arrDuration2 = 0;
            response.forEach(element => {
              if (element.protocol_checksum_status == "disabled") {
                arrDuration1 += parseInt(element.ttl);
              }
              else if (element.protocol_checksum_status == "good") {
                arrDuration2 += parseInt(element.ttl);
              }
            });

            var ctx = document.getElementById('myChart3').getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
              type: 'bar',
              // The data for our dataset
              data: {
                labels: ['disabled', 'good'],
                datasets: [{
                  labels: 'Amount',
                  backgroundColor: ['rgb(254, 99, 132)',
                    'green'],
                  borderColor: '#fff',
                  data: [arrDuration1, arrDuration2]
                },
                ]
              },

              // Configuration options go here
              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                },
                legend: {
                  display: false
                },
                tooltips: {
                  callbacks: {
                    label: function (tooltipItem) {
                      return tooltipItem.yLabel;
                    }
                  }
                }
              }
            });

            let counters2 = { disabled: 0, good: 0 }
            response.forEach(trame => {
              if (trame.protocol_checksum_status == 'disabled') counters2.disabled++;
              else if (trame.protocol_checksum_status == 'good') counters2.good++;
            });

            var ctx = document.getElementById('myChart2').getContext('2d');
            var myPieChart = new Chart(ctx, {
              // The type of chart we want to create
              type: 'doughnut',

              // The data for our dataset
              data: {
                labels: ['disabled', 'good'],
                datasets: [{
                  label: 'Nombre de requêtes par status',
                  backgroundColor: [
                    'rgb(128,128,128)',
                    '#3498db',
                  ],
                  borderColor: '#fff',
                  data: [counters2.disabled, counters2.good]
                }]
              },

              // Configuration options go here
              options: {}
            });
            // unix timestamp

            const hexToIpv4 = (ip) => {
              ip.replace(/\r\n/g, '\n');
              var lines = ip.split('\n');

              var output = '';
              for (var i = 0; i < lines.length; i++) {
                var line = lines[i];
                var line = line.replace(/0x/gi, '');

                var match = /([0-f]+)/i.exec(line);
                if (match) {
                  var matchText = parseInt(match[1], 16);
                  var converted = ((matchText >> 24) & 0xff) + '.' +
                    ((matchText >> 16) & 0xff) + '.' +
                    ((matchText >> 8) & 0xff) + '.' +
                    (matchText & 0xff);
                  output += converted;
                }
                else {
                  output += line;
                }
                output += '\n';
              }
              return output;
            }


            // console.log(total)

            for (let index = 0; index < response.length; index++) {
              var ts = response[index].date;

              // convert unix timestamp to milliseconds
              var ts_ms = ts * 1000;

              // initialize new Date object
              var date_ob = new Date(ts_ms);

              // year as 4 digits (YYYY)
              var year = date_ob.getFullYear();

              // month as 2 digits (MM)
              var month = ("0" + (date_ob.getMonth() + 1)).slice(-2);

              // date as 2 digits (DD)
              var date = ("0" + date_ob.getDate()).slice(-2);

              // hours as 2 digits (hh)
              var hours = ("0" + date_ob.getHours()).slice(-2);

              // minutes as 2 digits (mm)
              var minutes = ("0" + date_ob.getMinutes()).slice(-2);

              // seconds as 2 digits (ss)
              var seconds = ("0" + date_ob.getSeconds()).slice(-2);
              var ip_from = hexToIpv4(response[index].ip_from)
              var ip_dest = hexToIpv4(response[index].ip_dest)
              var date = year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds;

              let log = '<tr><td>' + date + '</td><td>' + response[index].protocol_name + '</td><td>' + response[index].protocol_checksum_status + '</td><td>' + ip_from + '</td><td>' + ip_dest + '</td></tr>';
              $('#log').append(log + '<br>');

            }
          },
        })
      },
      error: function (response) {
        console.log(response)
        console.log('ko')
      },
    })
  })
})

var myCarousel = document.querySelector('#myCarousel')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 3500,
})

$(document).ready(function () {
  $('#switch3').click(function (e) {
    e.preventDefault();
    $('#motdp').trigger('click');
  });
  $('#formulaireco').on('submit', function (e) {
    e.preventDefault();
    let form = $('#formulaireco')

    $.ajax({
      type: 'POST',
      url: form.attr('action'),

      data: form.serialize(),
      // dataType: 'json',
      beforeSend: function () {
        // out btn submit
        console.log('requete')
        $('#subconnect').css('display', 'none')

      },
      success: function (response) {
        console.log(response)
        console.log('reussi')
        $('#subconnect').fadeIn(1000)
        if (response.success == true) {
          // form out
          $('#myModal').modal('hide');
          location.reload();
        } else {
          if (response.errors.login != null) {
            $('#error_login').html(response.errors.login)
          }
          if (response.errors.password != null) {
            $('#error_password').html(response.errors.password)
          }
        }
      }
    });
  });
  $('#forminscription').on('submit', function (e) {
    e.preventDefault();
    let form = $('#forminscription')

    $.ajax({
      type: 'POST',
      url: form.attr('action'),

      data: form.serialize(),
      // dataType: 'json',
      beforeSend: function () {
        // out btn submit
        console.log('requete')
        $('#subinscription').css('display', 'none')

      },
      success: function (response) {
        console.log(response)
        console.log('reussi')
        $('#subinscription').fadeIn(1000)
        if (response.success == true) {
          // form out
          $('#myModal').modal('hide');
          location.reload();
        } else {
          if (response.errors.pseudo != null) {
            $('.error_pseudo').html(response.errors.pseudo)
          }
          if (response.errors.email != null) {
            $('.error_email').html(response.errors.email)
          }
          if (response.errors.password != null) {
            $('.error_password').html(response.errors.password)
          }
          if (response.errors.password2 != null) {
            $('.error_password2').html(response.errors.password2)
          }
        }
      }
    });
  });
  $('#formmdp').on('submit', function (e) {
    e.preventDefault();
    let form = $('#formmdp')

    $.ajax({
      type: 'POST',
      url: form.attr('action'),

      data: form.serialize(),
      // dataType: 'json',
      beforeSend: function () {
        // out btn submit
        console.log('requete')
        $('#submdp').css('display', 'none')

      },
      success: function (response) {
        console.log(response)
        console.log('reussi')
        $('#submdp').fadeIn(1000)
        if (response.success == true) {
          // form out
          $('#myModal').modal('hide');
          location.reload();
        } else {
          if (response.errors.email != null) {
            $('.error_emailverif').html(response.errors.email)
          }
        }
      }
    });
  });

})