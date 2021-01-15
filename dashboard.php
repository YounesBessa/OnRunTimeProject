<!-- afficher les informations contenues dans les trames sous forme de logs
notamment les ip,time to live,heure,ports,protocole etc
afficher les données suivantes sous forme de graphiques:
-le nombre de trames par type de requete (TCP/IP, UDP, ICMP etc)
-le nombre de TTL perdu total
-le nombre de requetes en échec
(Toute donnée supplémentaire récupérée, loguée et affichée en graphique que 
je jugerai pertinente permettra d’obtenir des points bonus.) -->

<?php
session_start();


require('inc/pdo.php');
require('inc/function.php');

if (!isLogged()) {
        header('Location: index.php');
}


include('inc/header.php'); ?>

<div class="dashboard">

        <a href="#" id="logs" class="login">Afficher les logs</a>
        
        <div class="chartwrap">
                <div class="chart1">
                        <!-- graph1 -->
                        <canvas id="myChart1"></canvas>

                </div>
                <div class="chart2">
                        <!-- graph2 -->
                        <canvas id="myChart2"></canvas>
                </div>
        </div>
        <div class="chart3">
                <!-- graph3 -->
                <canvas id="myChart3"></canvas>
        </div>
        <div class="table-wrapper">
                <table class="fl-table">

                        <thead>
                                <tr>
                                        <th>Date</th>
                                        <th>Protocol_Name</th>
                                        <th>Status</th>
                                        <th>IP_from</th>
                                        <th>IP_dest</th>
                                </tr>
                        </thead>
                        <tbody id="log"></tbody>

                </table>
        </div>
</div>

<?php include('inc/footer.php');
