<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/read', function ($request, $response, $args) {
    return $this->get('renderer')->render($response, 'read.php', [
        'pageTitle' => 'Read / Stream the Quran',
		'metaDescription' => 'AlQuran Cloud',
		'view' => 'read'
    ]);
});

$app->get('/quran', function ($request, $response, $args) {

    return $this->get('renderer')->render($response, 'quran.php', [
        'pageTitle' => 'The Holy Quran',
		'metaDescription' => 'A Complete Rendering and Recitation of the Quran',
		'quran' => $this->get('client')->AlQuranCloudApi->quran('quran-uthmani-quran-academy'),
		'suwar' => $this->get('client')->AlQuranCloudApi->surahs(),
		'dualAudio' => isset($request->getQueryParams()['dualAudio']) ? $request->getQueryParams()['dualAudio'] : false,
		'editions' => [
			'editions' => $this->get('client')->AlQuranCloudApi->editions(null, null, 'text'),
		],
		'view' => 'read'
    ]);
});

$app->get('/quran/{edition}', function ($request, $response, $args) {

	$edition = $request->getAttribute('edition');

    return $this->get('renderer')->render($response, 'quran.php', [
        'pageTitle' => 'Al Quran Cloud',
		'metaDescription' => 'AlQuran Cloud',
		'quran' => $this->get('client')->AlQuranCloudApi->quran('quran-uthmani-quran-academy'),
		'suwar' => $this->get('client')->AlQuranCloudApi->surahs(),
		'quranEdition' => $this->get('client')->AlQuranCloudApi->quran($edition),
		'editions' => [
			'editions' => $this->get('client')->AlQuranCloudApi->editions(null, null, 'text'),
		],
		'view' => 'read'
    ]);
});
