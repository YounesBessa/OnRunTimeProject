<?php

require('../inc/pdo.php');
require('../inc/function.php');

$trams=$_POST['trames'];



for($i=0; $i<count($trams); $i++){
    $protocol_flags_code=null;
    $protocol_type=null;
    $protocol_code=null;
    $protocol_version=null;
    $protocol_contentType=null;
    $protocol_checksum_status=null;
    $protocol_checksum_code=null;
    $protocol_ports_from=null;
    $protocol_ports_dest=null;
    $protocol_name=null;
    $id=$trams[$i];
    $date=$id['date'];
    $version=$id['version'];
    $headerLength=$id['headerLength'];
    $service=$id['service'];
    $identification=$id['identification'];
    $flags_code=$id['flags']['code'];
    $ttl=$id['ttl'];
    if(isset($id['protocol']['name'])){
        $protocol_name=$id['protocol']['name'];
    }
    if(isset($id['protocol']['flags']['code'])){
        $protocol_flags_code=$id['protocol']['flags']['code'];
    }
    if(isset($id['protocol']['checksum']['status'])){
        $protocol_checksum_status=$id['protocol']['checksum']['status'];
    }
    if(isset($id['protocol']['checksum']['code'])){
        $protocol_checksum_code=$id['protocol']['checksum']['code'];
    }
    if(isset($id['protocol']['ports']['from'])){
        $protocol_ports_from=$id['protocol']['ports']['from'];
    }
    if(isset($id['protocol']['ports']['dest'])){
        $protocole_ports_dest=$id['protocol']['ports']['dest'];
    }
    if(isset($id['protocol']['type'])){
        $protocol_type=$id['protocol']['type'];
    }
    if(isset($id['protocol']['code'])){
        $protocol_code=$id['protocol']['code'];
    }
    if(isset($id['protocol']['version'])){
        $protocol_version=$id['protocol']['version'];
    }
    if(isset($id['protocol']['contentType'])){
        $protocol_contentType=$id['protocol']['contentType'];
    }
    $headerChecksum=$id['headerChecksum'];
    $ip_from=$id['ip']['from'];
    $ip_dest=$id['ip']['dest'];


    $columns=['date','version','headerLength','service','identification','flags_code','ttl','protocol_name','protocol_flags_code','protocol_checksum_status','protocol_checksum_code','protocol_ports_from','protocol_ports_dest','protocol_type','protocol_code','protocol_version','protocol_contentType','headerChecksum','ip_from','ip_dest'];
    $values=[$date,$version,$headerLength,$service,$identification,$flags_code,$ttl,$protocol_name,$protocol_flags_code,$protocol_checksum_status,$protocol_checksum_code,$protocol_ports_from,$protocol_ports_dest,$protocol_type,$protocol_code,$protocol_version,$protocol_contentType,$headerChecksum,$ip_from,$ip_dest];
    
    insert($pdo,'ort_trams', $columns, $values);
    

}

$sql = 'SELECT * FROM ort_trams';
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);