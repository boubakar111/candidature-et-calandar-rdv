
<?php
header('Content-type :text/csv');
header('Content-Disposition :attachement;filename ="Export candidature.csv"');
$conn =mysqli_connect("localhost", "root","","candidaturepoleemploi");
if($conn===false){
    die("ERROR : probleme de connection a la base de donnees". mysqli_connect_error());
}

$sql ="SELECT * FROM  Candidatures";
$result = mysqli_query($conn ,$sql);
$result = mysqli_fetch_all( $result);
?>
"id";"titre annaonce"; "entreprise";"date candiature";
<?php
foreach($result as $res){

}
?>