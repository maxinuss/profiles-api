<?php
declare(strict_types=1);

use ProfilesApi\Application\Action\Profile\ProfileAdd;
/*use ProfilesApi\Application\Action\Profile\ProfileUpdate;
use ProfilesApi\Application\Action\Profile\ProfileDelete;
use ProfilesApi\Application\Action\Profile\ProfileView;
use ProfilesApi\Application\Action\Profile\ProfileList;*/

$app->post('/api/v1/profile', ProfileAdd::class);
/*$app->put('/api/v1/profile/{id}', ProfileUpdate::class);
$app->delete('/api/v1/profile/{id}', ProfileDelete::class);
$app->get('/api/v1/profile/{id}', ProfileView::class);
$app->get('/api/v1/profile', ProfileList::class);*/