<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Grand Vista API Documentation",
 *      description="Grand Vista Hotel Management API Documentation",
 *      @OA\Contact(
 *          email="admin@example.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Grand Vista API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class SwaggerBaseController
{
}
