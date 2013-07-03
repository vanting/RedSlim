<?php

//GET route
$app->get('/', function () use ($app) {

            $guests = R::findAll('guest', 'ORDER BY modify_date DESC');
            $options = array();
            $options['guests'] = $guests;
            $app->view()->appendData($options);
            $app->render('demo.html.twig');
        });
        
$app->get('/api/comment/json', function () use ($app) {

            $result = R::getAll('SELECT * FROM guest ORDER BY modify_date DESC');
            header("Content-Type: application/json");
            echo json_encode($result);
        })->name('api_comment_json');

//POST route
$app->post('/guest/comment', function () use($app) {

            $guest = R::dispense('guest');
            
            $name = $app->request()->post('name');
            if(empty($name)) 
                $name = 'anonymous';

            $guest->name = $name;
            $guest->message = $app->request()->post('message');
            R::store($guest);
            $app->redirect($app->request()->getReferrer());
        })->name('guest_comment');

//PUT route
$app->put('/put', function () use($app) {
            echo 'This is a PUT route';
        });

//DELETE route
$app->delete('/delete', function () use($app) {
            echo 'This is a DELETE route';
        });
?>