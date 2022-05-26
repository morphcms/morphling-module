<?php

namespace Modules\Morphling\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Morphling\Services\BootstrapService;

class BootstrapController extends Controller
{
  public function __invoke(BootstrapService $bootstrapService)
  {
      return new JsonResponse($bootstrapService->boot());
  }
}
