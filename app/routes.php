<?php

use App\Services\Routing\Route;
use App\Services\Routing\RequestMethod;

use App\Controllers\NewsController;
use App\Controllers\RegisterController;
use App\Controllers\RoadmapController;
use App\Controllers\TeamController;
use App\Controllers\EventController;
use App\Controllers\ActivityController;
use App\Controllers\PublicationController;
use App\Controllers\AuthController;

$routes = [

    /* News routes */

    Route::Declare('/news', function(){
        $newsController = new NewsController();
        $newsController->getAllRecords();
    }, RequestMethod::GET()),

    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->getById($id);
    }, RequestMethod::GET()),

    Route::Declare('/news', function(){
        $newsController = new NewsController();
        $newsController->create();
    }, RequestMethod::POST()),

    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->delete($id);
    }, RequestMethod::DELETE()),
    
    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->update($id);
    }, RequestMethod::PUT()),

    Route::Declare('/register', function(){
        $registerController = new RegisterController();
        $registerController->create();
    }, RequestMethod::POST()),

    /* Team routes */

    Route::Declare('/team/member', function(){
        $teamController = new TeamController();
        $teamController->create();
    }, RequestMethod::POST()),

    Route::Declare('/team', function(){
        $teamController = new TeamController();
        $teamController->getAllRecords();
    }, RequestMethod::GET()),

    Route::Declare('/team/member/*', function($id){
        $teamController = new TeamController();
        $teamController->getById($id);
    }, RequestMethod::GET()),

    Route::Declare('/team/member/*', function($id){
        $teamController = new TeamController();
        $teamController->delete($id);
    }, RequestMethod::DELETE()),

    Route::Declare('/team/member/*', function($id){
        $teamController = new TeamController();
        $teamController->update($id);
    }, RequestMethod::PUT()),

    /* Roadmap routes */

    Route::Declare('/roadmap', function(){
        $roadmapController = new RoadmapController();
        $roadmapController->create();
    }, RequestMethod::POST()),

    Route::Declare('/roadmap', function(){
        $roadmapController = new RoadmapController();
        $roadmapController->getAllRecords();
    }, RequestMethod::GET()),

    Route::Declare('/roadmap/*', function($id){
        $roadmapController = new RoadmapController();
        $roadmapController->update($id);
    }, RequestMethod::PUT()),

    Route::Declare('/roadmap/*', function($id){
        $roadmapController = new RoadmapController();
        $roadmapController->delete($id);
    }, RequestMethod::DELETE()),

    /* Events routes */

    Route::Declare('/events', function(){
        $eventsController = new EventController();
        $eventsController->create();
    }, RequestMethod::POST()),

    Route::Declare('/events', function(){
        $eventsController = new EventController();
        $eventsController->getAllRecords();
    }, RequestMethod::GET()),

    Route::Declare('/events/*', function($id){
        $eventsController = new EventController();
        $eventsController->update($id);
    }, RequestMethod::PUT()),

    Route::Declare('/events/*', function($id){
        $eventsController = new EventController();
        $eventsController->delete($id);
    }, RequestMethod::DELETE()),

    /*Activities routes*/

    Route::Declare('/activity', function(){
        $activityController = new ActivityController();
        $activityController->create();
    }, RequestMethod::POST()),

    Route::Declare('/activity', function(){
        $activityController = new ActivityController();
        $activityController->getAllRecords();
    }, RequestMethod::GET()),

    Route::Declare('/activity/*', function($id){
        $activityController = new ActivityController();
        $activityController->getById($id);
    }, RequestMethod::GET()),

    Route::Declare('/activity/*', function($id){
        $activityController = new ActivityController();
        $activityController->update($id);
    }, RequestMethod::PUT()),

    Route::Declare('/activity/*', function($id){
        $activityController = new ActivityController();
        $activityController->delete($id);
    }, RequestMethod::DELETE()),

    /* Publications routes */

    Route::Declare('/publication', function(){
        $publicationController = new PublicationController();
        $publicationController->create();
    }, RequestMethod::POST()),

    Route::Declare('/activity/*/publications', function($id){
        $publicationController = new PublicationController();
        $publicationController->getByActivityId($id);
    }, RequestMethod::GET()),

    Route::Declare('/publication/*', function($id){
        $publicationController = new PublicationController();
        $publicationController->getById($id);
    }, RequestMethod::GET()),

    Route::Declare('/publication/*', function($id){
        $publicationController = new PublicationController();
        $publicationController->update($id);
    }, RequestMethod::PUT()),

    Route::Declare('/publication/*', function($id){
        $publicationController = new PublicationController();
        $publicationController->delete($id);
    }, RequestMethod::DELETE()),

    /* Login routes */

    Route::Declare('/login', function(){
        $authController = new AuthController();
        $authController->authenticate();
    }, RequestMethod::POST()),
];