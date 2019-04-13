<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Get All posts
$app->get('/api/posts', function(Request $request, Response $response){
    $sql = "SELECT * FROM posts";

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
$app->get('/api/post/{post_id}', function(Request $request, Response $response){
    $id = $request->getAttribute('post_id');

    $sql = "SELECT * FROM posts WHERE post_id = $id";

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
    $content = $request->getParam('content');
    $privacy = $request->getParam('privacy');
   

    $sql = "INSERT INTO posts (user_id,content,privacy) VALUES
    (:user_id,:content,:privacy)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':privacy', $privacy);
       

        $stmt->execute();

        echo '{"notice": {"text": "post Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
});
// Update post
$app->put('/api/post/update/{post_id}', function(Request $request, Response $response){
    $post_id = $request->getAttribute('post_id');
    $user_id = $request->getParam('user_id');
    $content = $request->getParam('content');
    $privacy = $request->getParam('privacy');


    $sql = "UPDATE posts SET
				user_id 	= :user_id,
				content 	= :content,
                privacy		= :privacy
                
			WHERE post_id = $post_id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':privacy', $privacy);
       

        $stmt->execute();

        echo '{"notice": {"text": "post Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Delete post
$app->delete('/api/post/delete/{post_id}', function(Request $request, Response $response){
    $post_id = $request->getAttribute('post_id');

    $sql = "DELETE FROM posts WHERE post_id = $post_id";

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