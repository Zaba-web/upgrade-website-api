<?php

use App\Services\Routing\Route;

use App\Controllers\NewsController;
use App\Controllers\RegisterController;
use App\Controllers\RoadmapController;
use App\Controllers\TeamController;
use App\Controllers\EventController;
use App\Controllers\ActivityController;

$routes = [

    /* News routes */

    Route::Declare('/news', function(){
        $newsController = new NewsController();
        $newsController->getAllRecords();
    }, "GET"),

    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->getById($id);
    }, "GET"),

    Route::Declare('/news', function(){
        $newsController = new NewsController();
        $newsController->create();
    }, "POST"),

    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->delete($id);
    }, "DELETE"),
    
    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->update($id);
    }, "PUT"),

    Route::Declare('/register', function(){
        $registerController = new RegisterController();
        $registerController->create();
    }, "POST"),

    /* Team routes */

    Route::Declare('/team/member', function(){
        $teamController = new TeamController();
        $teamController->create();
    }, "POST"),

    Route::Declare('/team', function(){
        $teamController = new TeamController();
        $teamController->getAllRecords();
    }, "GET"),

    Route::Declare('/team/member/*', function($id){
        $teamController = new TeamController();
        $teamController->getById($id);
    }, "GET"),

    Route::Declare('/team/member/*', function($id){
        $teamController = new TeamController();
        $teamController->delete($id);
    }, "DELETE"),

    Route::Declare('/team/member/*', function($id){
        $teamController = new TeamController();
        $teamController->update($id);
    }, "PUT"),

    /* Roadmap routes */

    Route::Declare('/roadmap', function(){
        $roadmapController = new RoadmapController();
        $roadmapController->create();
    }, "POST"),

    Route::Declare('/roadmap', function(){
        $roadmapController = new RoadmapController();
        $roadmapController->getAllRecords();
    }, "GET"),

    Route::Declare('/roadmap/*', function($id){
        $roadmapController = new RoadmapController();
        $roadmapController->update($id);
    }, "PUT"),

    Route::Declare('/roadmap/*', function($id){
        $roadmapController = new RoadmapController();
        $roadmapController->delete($id);
    }, "PUT"),

    /* Events routes */

    Route::Declare('/events', function(){
        $eventsController = new EventController();
        $eventsController->create();
    }, "POST"),

    Route::Declare('/events', function(){
        $eventsController = new EventController();
        $eventsController->getAllRecords();
    }, "GET"),

    Route::Declare('/events/*', function($id){
        $eventsController = new EventController();
        $eventsController->update($id);
    }, "PUT"),

    Route::Declare('/events/*', function($id){
        $eventsController = new EventController();
        $eventsController->delete($id);
    }, "DELETE"),

    /*Activities routes*/

    Route::Declare('/activity', function(){
        $activityController = new ActivityController();
        $activityController->create();
    }, "POST"),

    Route::Declare('/activity', function(){
        $activityController = new ActivityController();
        $activityController->getAllRecords();
    }, "GET"),

    Route::Declare('/activity/*', function($id){
        $activityController = new ActivityController();
        $activityController->getById($id);
    }, "GET"),

    Route::Declare('/activity/*', function($id){
        $activityController = new ActivityController();
        $activityController->update($id);
    }, "PUT"),
];