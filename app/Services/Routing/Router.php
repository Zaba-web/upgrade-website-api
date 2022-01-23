<?php

namespace App\Services\Routing;

use App\Services\Response\JSONResponse;

class Router {
    private $routes = [];
    private $incorrectRoutes = [];

    public function __construct($routes) {
        $this->routes = $routes;
        
        if(count($this->routes) > 0 ) { 
            $this->handleCurrentRoute();
        }
    }

    /**
     * Check if current route that user requests exists.
     * 
     * @return void
     */
    private function handleCurrentRoute() {
        $urlQuery = $_GET['url'];

        $staticRoute = $this->findStaticRoute($urlQuery);
        if($staticRoute) {
            call_user_func($staticRoute['handler']);
            return ;
        }

        $dynamicRouteResult = $this->findDynamicRoute($urlQuery);
        if($dynamicRouteResult) {
            $route = $dynamicRouteResult[0];
            $params = $dynamicRouteResult[1];

            call_user_func_array($route['handler'], $params);

            return ;
        }

        JSONResponse::message(404, "Error occured: Route " . $urlQuery . " not found.");
    }

    /** 
    *   Check if current route that user requests
    *   is a static route (has no parameters).
    *
    *   @param string $_urlQuery route that user requests
    *
    *   @return array route if found or false if not
    */
    private function findStaticRoute($_urlQuery) {
        $urlQuery = $this->trimURLString($_urlQuery);
        
        if($urlQuery == NULL) $urlQuery = "/";

        foreach($this->routes as $route)  {
            $routeUrl = $this->trimURLString($route['url']);
            
            if($routeUrl == NULL) $routeUrl = "/";

            if($routeUrl === $urlQuery) {
                if($this->isRequestMethodCorrect($route)) {
                    return $route;
                } else {
                    $this->handleIncorrectRoutes($route);
                }
            }
        }

        return false;
    }

    /**
     * Find requested route as route with dynamic parameters
     * 
     * @param string $_urlQuery with requested route url
     * 
     * @return array if route found or false if wasn't
     */
    private function findDynamicRoute($_urlQuery) {
        $urlQuery = explode('/', $this->trimURLString($_urlQuery));

        foreach($this->routes as $route) {
            $routeUrl = explode('/', $this->trimURLString($route['url']));

            if($this->routeDepth($urlQuery) !== $this->routeDepth($routeUrl)) {
               continue;
            }

            $params = $this->getDynamicRoutesParams($urlQuery, $routeUrl);

            if($params) {
                if( $this->isRequestMethodCorrect($route)){
                    return [$route, $params];
                } else {
                    $this->handleIncorrectRoutes($route);
                }
            }
        }

        return false;
    }

    /**
     * Check if requested url corresponds to the found route template
     * 
     * @param array<string> $urlQuery requested url exploded by '/' char
     * @param array<string> $routeUrl found by routeDepth route exploded by '/' char
     * 
     * @return array parameters if requested url corresponds to the route template
     * @return false if it isn't
     */
    private function getDynamicRoutesParams($urlQuery, $routeUrl) {
        $params = [];

        for($i = 0; $i < count($routeUrl); $i++) {
            if($routeUrl[$i] === "*") {
                $params[] = $urlQuery[$i];
                continue;
            }

            if($routeUrl[$i] !== $urlQuery[$i]) {
                return false;
            }
        }

        return $params;
    }

    /**
     * Get count of parameters (word separated by '/') in url.
     * 
     * @param array<string> $routeUrl url string exploded by '/' char
     * 
     * @return int count of parameters
     */
    private function routeDepth($routeUrl) {
        return count($routeUrl);
    }

    /**
     * Remove '/' at the beginning (if it is a first char of string)
     * or at the end of string (if it is last char)
     * 
     * @param string url to trim
     * 
     * @return string trimmed url
     */
    private function trimURLString($urlString) {
        if($urlString[0] == '/') {
            $urlString = ltrim($urlString, '/');
        }

        if($urlString[strlen($urlString) - 1] == '/') {
            $urlString = rtrim($urlString, '/');
        }

        return $urlString;
    }

    /**
     * Check if route requested with supported method
     * 
     * @return boolean value
     */
    private function isRequestMethodCorrect($route) {
        return $route['method'] === $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Display if route requested with wrong method
     * 
     * @return void
     */
    private function handleIncorrectRoutes($route) {
        if(!in_array($route['url'], $this->incorrectRoutes)) {
            JSONResponse::message(400, "Error occured: `" . $route['url'] . "` route not configured for " . $_SERVER['REQUEST_METHOD']. " request method.");
            $this->incorrectRoutes[] = $route['url'];
        }
    }
}