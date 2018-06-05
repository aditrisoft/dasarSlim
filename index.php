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



/* UNTUK CEK REQUEST DAN RESPONSE YANG DIMILIKI SLIM */
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

/* END */



#Container untuk membuat semacam fungsi / function
$container = $app->getContainer();

#buat container untuk database PDO
$container['db'] = function(){
    return new PDO('mysql:host=localhost;dbname=dinkop', 'root', '');
};

#menampilkan data dari database dinkop table koperasi
$app->get('/koperasi', function($request, $response, $datae){
    $hasil = $this->db->query("select * from koperasi")->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($hasil);
		print_r($json);
});

$app->get('/koperasi/{cif}', function($request, $response, $datae){
  $cif=$datae['cif'];
  $hasil = $this->db->query("select * from koperasi where cif=$cif")->fetchAll(PDO::FETCH_ASSOC);
  $json=json_encode($hasil);
	print_r($json);
});


#input data dengan POST
$app->post('/koperasi', function($request, $response){
  $nama = $_POST['namae'];
  echo 'Input '.$nama;
});

#update data dengan PUT
$app->put('/koperasi', function($request, $response){
  $data = $request->getParsedBody();
  $nama=$data['namae'];
  echo 'Update '.$nama;
});

#hapus data dengan DELETE
$app->delete('/koperasi', function($request, $response){
  $data = $request->getParsedBody();
  $nama=$data['namae'];
  echo 'Hapus '.$nama;
});




//jalankan aplikasi Slim
$app->run();



?>
