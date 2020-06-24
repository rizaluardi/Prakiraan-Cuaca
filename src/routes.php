<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    //bapak Rizal
//fungsi select
    $app->get("/stasiun_cuaca/", function (Request $request, Response $response){
        $sql = "SELECT * FROM stasiun_cuaca";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi select dengan id
    $app->get("/stasiun_cuaca/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "SELECT * FROM stasiun_cuaca WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi search
    $app->get("/stasiun_cuaca/search/", function (Request $request, Response $response, $args){
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM stasiun_cuaca WHERE nama_stasiun LIKE '%$keyword%' OR id_daerah LIKE '%$keyword%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi insert
    $app->post("/stasiun_cuaca/", function (Request $request, Response $response){

        $new_stasiun_cuaca = $request->getParsedBody();
    
        $sql = "INSERT INTO stasiun_cuaca (nama_stasiun, id_daerah) VALUE (:nama_stasiun, :id_daerah)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nama_stasiun" => $new_stasiun_cuaca["nama_stasiun"],
            ":id_daerah" => $new_stasiun_cuaca["id_daerah"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi update berdasarkan id
    $app->put("/stasiun_cuaca/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $new_stasiun_cuaca = $request->getParsedBody();
        $sql = "UPDATE stasiun_cuaca SET nama_stasiun=:nama_stasiun, id_daerah=:id_daerah WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id,
            ":nama_stasiun" => $new_stasiun_cuaca["nama_stasiun"],
            ":id_daerah" => $new_stasiun_cuaca["id_daerah"]];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi delete
    $app->delete("/stasiun_cuaca/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM stasiun_cuaca WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });



    //fungsi select
 $app->get("/informasi/", function (Request $request, Response $response){
        $sql = "SELECT * FROM informasi";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi select dengan id
    $app->get("/informasi/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "SELECT * FROM informasi WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi search
    $app->get("/informasi/search/", function (Request $request, Response $response, $args){
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM informasi WHERE kode_daerah LIKE '%$keyword%' OR kode_cuaca LIKE '%$keyword%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi insert
    $app->post("/informasi/", function (Request $request, Response $response){

        $new_informasi = $request->getParsedBody();
    
        $sql = "INSERT INTO informasi (kode_daerah, kode_cuaca, tanggal) VALUE (:kode_daerah, :kode_cuaca, :tanggal)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":kode_daerah" => $new_informasi["kode_daerah"],
            ":kode_cuaca" => $new_informasi["kode_cuaca"],
            ":tanggal" => $new_informasi["tanggal"]
              
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi update berdasarkan id
    $app->put("/informasi/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $new_informasi = $request->getParsedBody();
        $sql = "UPDATE informasi SET kode_daerah=:kode_daerah, kode_cuaca=:kode_cuaca WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id,
            ":kode_daerah" => $new_informasi["kode_daerah"],
            ":kode_cuaca" => $new_informasi["kode_cuaca"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi delete
    $app->delete("/informasi/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM informasi WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//bapaa ferdi
    //fungsi select
$app->get("/cuaca/", function (Request $request, Response $response){
        $sql = "SELECT * FROM cuaca";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi select dengan id
    $app->get("/cuaca/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "SELECT * FROM cuaca WHERE kode_cuaca=:kode_cuaca";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":kode_cuaca" => $id]);
        $result = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi search
    $app->get("/cuaca/search/", function (Request $request, Response $response, $args){
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM cuaca WHERE parameter LIKE '%$keyword%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi insert
    $app->post("/cuaca/", function (Request $request, Response $response){

        $new_cuaca = $request->getParsedBody();
    
        $sql = "INSERT INTO cuaca (parameter) VALUE (:parameter)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":parameter" => $new_cuaca["parameter"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi update berdasarkan id
    $app->put("/cuaca/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $new_cuaca = $request->getParsedBody();
        $sql = "UPDATE cuaca SET parameter=:parameter created=:created WHERE kode_cuaca=:kode_cuaca";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":kode_cuaca" => $id,
            ":parameter" => $new_cuaca["parameter"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi delete
    $app->delete("/cuaca/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM cuaca WHERE kode_cuaca=:kode_cuaca";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":kode_cuaca" => $id
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//daerah
//fungsi select
 $app->get("/daerah/", function (Request $request, Response $response){
        $sql = "SELECT * FROM daerah";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi select dengan id
    $app->get("/daerah/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "SELECT * FROM daerah WHERE kode_daerah=:kode_daerah";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":kode_daerah" => $id]);
        $result = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi search
    $app->get("/daerah/search/", function (Request $request, Response $response, $args){
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM daerah WHERE provinsi LIKE '%$keyword%' OR kota LIKE '%$keyword%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
//fungsi insert
    $app->post("/daerah/", function (Request $request, Response $response){

        $new_daerah = $request->getParsedBody();
    
        $sql = "INSERT INTO daerah (provinsi, kota) VALUE (:provinsi, :kota)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":provinsi" => $new_daerah["provinsi"],
            ":kota" => $new_daerah["kota"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi update berdasarkan id
    $app->put("/daerah/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $new_daerah = $request->getParsedBody();
        $sql = "UPDATE daerah SET provinsi=:provinsi, kota=:kota  WHERE kode_daerah=:kode_daerah";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":kode_daerah" => $id,
            ":provinsi" => $new_daerah["provinsi"],
            ":kota" => $new_daerah["kota"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
//fungsi delete
    $app->delete("/daerah/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM daerah WHERE kode_daerah=:kode_daerah";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":kode_daerah" => $id
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
};






