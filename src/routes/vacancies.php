<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;




// Get All vacancies
$app->get('/api/vacancies', function(Request $request, Response $response){
    $sql = "SELECT * FROM vacancy";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Get Single vacancy
$app->get('/api/vacancy/{vacancy_id}', function(Request $request, Response $response){
    $id = $request->getAttribute('vacancy_id');

    $sql = "SELECT * FROM vacancy WHERE vacancy_id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Add vacancy
$app->post('/api/vacancy/add', function(Request $request, Response $response){
    $company_id = $request->getParam('company_id');
    $title = $request->getParam('title');
    $description = $request->getParam('description');
    $salary = $request->getParam('salary');
    $benefits = $request->getParam('benefits');
   

    $sql = "INSERT into vacancy (company_id,title,description,salary,benefits) values
    (:company_id,:title,:description,:salary,:benefits)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':benefits', $benefits);
       

        $stmt->execute();

        echo '{"notice": {"text": "vacancy Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
});

// Update vacancy
$app->put('/api/vacancy/update/{vacancy_id}', function(Request $request, Response $response){
    $vacancy_id = $request->getAttribute('vacancy_id');
    $company_id = $request->getParam('company_id');
    $title = $request->getParam('title');
    $description = $request->getParam('description');
    $salary = $request->getParam('salary');
    $benefits = $request->getParam('benefits');
   


    $sql = "UPDATE vacancy SET
				company_id 	= :company_id,
				title 	    = :title,
                description	= :description,
                salary		= :salary,
                benefits	= :benefits

                
			WHERE vacancy_id = $vacancy_id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':benefits', $benefits);
       
       

        $stmt->execute();

        echo '{"notice": {"text": "vacancy Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete post
$app->delete('/api/vacancy/delete/{vacancy_id}', function(Request $request, Response $response){
    $vacancy_id = $request->getAttribute('vacancy_id');

    $sql = "DELETE FROM vacancy WHERE vacancy_id = $vacancy_id";

    try{
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "vacancy Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
   