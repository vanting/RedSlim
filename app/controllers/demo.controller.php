<?php

//GET route
$app->get('/', 'route_default');

function route_default() {
    $app = Slim::getInstance();
    $guests = R::findAll('guest', 'ORDER BY modify_date DESC');
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
}

$app->get('/api/comment/json', 'api_comment_json')->name('api_comment_json');

function api_comment_json() {
    $app = Slim::getInstance();
    $result = R::getAll('SELECT * FROM guest ORDER BY modify_date DESC');
    header("Content-Type: application/json");
    echo json_encode($result);
}

//POST route
$app->post('/guest/comment', 'guest_comment')->name('guest_comment');

function guest_comment() {
    $app = Slim::getInstance();
    $guest = R::dispense('guest');

    $name = $app->request()->post('name');
    if (empty($name))
        $name = 'anonymous';

    $guest->name = $name;
    $guest->message = $app->request()->post('message');
    $guest->ip = $app->request()->getIp();

    // prepare to delete old comments
    $yesterday = date('Y-m-d', strtotime('-1 day'));

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
    $app->redirect($app->request()->getReferrer());
}

?>