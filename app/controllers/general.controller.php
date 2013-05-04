<?php

//GET route
$app->get('/', function () use ($app) {

            $app->render('slim.html.twig');
        });

$app->get('/user/list', function() use($app) {

            $users = R::find('user');
            foreach ($users as $user)
                echo $user->name . ' is a ' . $user->role . ', modified at ' . $user->modify_date . "<br/>";
        })->name('list');

$app->get('/user/add/:name', function ($name) use($app) {

            $user = R::dispense('user');
            $user->name = $name;
            R::store($user);
            
            echo "$name is added to database. </br>";
            echo "<a href=".$app->urlFor('list').">List Users</a>";
        })->name('add');

//POST route
$app->post('/post', function () use($app) {
            echo 'This is a POST route';
        });

//PUT route
$app->put('/put', function () use($app) {
            echo 'This is a PUT route';
        });

//DELETE route
$app->delete('/delete', function () use($app) {
            echo 'This is a DELETE route';
        });
?>