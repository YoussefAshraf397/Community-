<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;




// Get All posts
$app->get('/api/posts', function(Request $request, Response $response){
    $sql = "SELECT * FROM social_posts";

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
// Get Single post
$app->get('/api/post/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM social_posts WHERE id = $id";

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
// Add post
$app->post('/api/post/add', function(Request $request, Response $response){
    $user_id = $request->getParam('user_id');
    $body = $request->getParam('body');

   

    $sql = "INSERT INTO social_posts (user_id,body) VALUES
    (:user_id,:body)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':body', $body);
       

        $stmt->execute();

        echo '{"notice": {"text": "post Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
});
// Update post
$app->put('/api/post/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $user_id = $request->getParam('user_id');
    $body = $request->getParam('body');
   


    $sql = "UPDATE social_posts SET
				user_id 	= :user_id,
				body 	= :body,
              
                
			WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':body', $body);
        
       

        $stmt->execute();

        echo '{"notice": {"text": "post Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Delete post
$app->delete('/api/post/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM social_posts WHERE id = $id";

    try{
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "post Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});