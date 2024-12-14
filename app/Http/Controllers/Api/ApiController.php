<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpResponse;
use App\Helpers\HttpStatus;
use App\Helpers\ModuleTrait;
use App\Helpers\PdfMerge;
use App\Helpers\SettingTrait;
use App\Helpers\Status;
use App\Helpers\StatusTrait;
use App\Helpers\UploaderFactory;
use App\Helpers\UserRoleTrait;
use App\Helpers\UserTrait;
use App\Helpers\ClassTrait;
use App\Http\Controllers\Controller;

class ApiController extends Controller implements HttpStatus {
    use UserTrait, StatusTrait, UserRoleTrait;

    protected $model;
    protected $repository;
    protected $request;
    protected $httpResponse;

    public function __construct() {
        $this->httpResponse = new HttpResponse();
    }
}
