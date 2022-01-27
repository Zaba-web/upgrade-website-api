<?php

namespace App\Services\Routing;

class RequestMethod {
    static public function GET() {
        return "GET";
    }

    static public function POST() {
        return "POST";
    }

    static public function PUT() {
        return "PUT";
    }

    static public function DELETE() {
        return "DELETE";
    }
}