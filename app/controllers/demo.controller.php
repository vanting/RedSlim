<?php

//GET route
$app->get('/', function () use ($app) {

            $guest = R::dispense( 'guest' );
            $guests = $guest->$get_guests();

            $options = array();
            $options['guests'] = $guests;
            $options['pmenu'] = array(
                array('desc' => 'Slim', 'url' => 'http://www.slimframework.com/'),
                array('desc' => 'Redbean', 'url' => 'http://redbeanphp.com/'),
                array('desc' => 'Twig', 'url' => 'http://twig.sensiolabs.org/'),
                array('desc' => 'Twitter Bootstrap', 'url' => 'http://twitter.github.io/bootstrap/'),
            );
            $options['smenu'] = array(
                array('desc' => 'GitHub Repository', 'url' => 'https://github.com/vanting/RedSlim'),
                array('desc' => 'Composer/Packagist', 'url' => 'https://packagist.org/packages/redslim/redslim'),
                array('desc' => 'Pagoda Box App Cafe', 'url' => 'https://pagodabox.com/cafe/vanting/redslim'),
            );
            $app->view()->appendData($options);
            $app->render('demo.html.twig');
        });

$app->get('/api/comment/json', function () use ($app) {

          $guest = R::dispense( 'guest' );
            $result = $guest->$get_guests_json();
            header("Content-Type: application/json");
            echo json_encode($result);
        })->name('api_comment_json');

//POST route
$app->post('/guest/comment', function () use($app) {

            $guest = R::dispense('guest');

            $name = $app->request->post('name');
            if (empty($name))
                $name = 'anonymous';

            $guest->name = $name;
            $guest->message = $app->request->post('message');
            $guest->ip = $app->request->getIp();

            // prepare to delete old comments
            $yesterday = date('Y-m-d' , strtotime('-1 day'));

            // start transaction
            R::begin();
            try {
                R::exec('DELETE FROM guest WHERE modify_date < ?', array($yesterday));
                R::store($guest);
                R::commit();
                $app->flash('success', 'Nice to hear from you!');
            } catch (Exception $e) {
                R::rollback();
                $app->flash('error', 'Oops... seems something goes wrong.');
            }
            $app->redirect($app->request->getReferrer());
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