<?php

//GET route
$app->get('/', function () use ($app) {

    $guests = R::dispense('guest')->getAll(true);

    $num1 = rand(1, 9);
    $num2 = rand(1, 9);
    $_SESSION['captcha'] = $num1 + $num2;

    $options = array();
    $options['guests'] = $guests;
    $options['captcha'] = $num1 . ' + ' . $num2 . ' =';
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
})->name('home');

// JSON api
$app->get('/api/comment/json', function () use ($app) {

    $result = R::dispense('guest')->getAll();
    header("Content-Type: application/json");
    echo json_encode($result);
})->name('api_comment_json');

// nukes the entire database
$app->get('/nuke', function () use($app) {
    R::nuke();
    $app->redirect($app->urlFor('home'));
});

//POST route
$app->post('/guest/comment', function () use($app) {

    // start transaction
    R::begin();
    try {
        if ($app->request->post('captcha') != $_SESSION['captcha'])
            throw new Exception();

        $name = $app->request->post('name');
        if (empty($name))
            $name = 'anonymous';
        
        $guest = R::dispense('guest');
        $guest->name = $name;
        $guest->message = $app->request->post('message');
        $guest->ip = $app->request->getIp();
        
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