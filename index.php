<?php
require 'vendor/autoload.php';

$app = new Slim\App;

$app->get('/', function($request, $response){
  echo 'jianc';
});

$app->get('/halo', function($request, $response){
  echo 'opo bro!';
});

$app->get('/sopo/{jeneng}', function($request, $response, $args){
  //die(var_dump($args));
  echo 'opo bro! '.$args['jeneng'];
});

$app->get('/sopo/{jeneng}/{kelase}', function($request, $response, $datae){
  //die(var_dump($args));
  echo 'opo bro! '.$datae['jeneng']."<br>Kelas : ".$datae['kelase'];
});

#di bawah ini untuk menampilkan opsi sama dengan sopo/{jeneng} tapi dibuat lebih ringkas
$app->get('/opo[/{judule}]',function($request, $response, $datae){
  #kalo kosong tanpa argumens
  if(empty($datae)){
    echo "metune kosong!";
  }else{
    echo $datae['judule'];
  }
});


#untuk ngecek method pake request
$app->get('/method', function($request, $response){
  echo $request->getMethod();
});

  #=>liat lebih lengkap selain getMethod();
$app->get('/fungsi', function($request, $response){
  die(var_dump($request));
});

#pake salah satu fungsi di atas untuk liat header
$app->get('/header', function($request, $response){
  die(var_dump($request->getHeaders())); #-> menggunakan var_dump karena array
});

//jalankan aplikasi Slim
$app->run();



?>
