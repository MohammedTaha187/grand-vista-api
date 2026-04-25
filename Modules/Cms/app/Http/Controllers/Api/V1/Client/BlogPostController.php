<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\BlogPost\Contracts\BlogPostServiceInterface;
use Modules\Cms\Models\BlogPost;
use Modules\Cms\Http\Resources\Api\V1\BlogPost\BlogPostResource;
use Modules\Cms\Http\Resources\Api\V1\BlogPost\BlogPostCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group BlogPost Client API
 *
 * APIs for viewing BlogPosts
 */
class BlogPostController extends Controller
{
    public function __construct(
        private readonly BlogPostServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/v1/cms/client/blog-posts",
     *     tags={"Client CMS"},
     *     summary="List all blog posts",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            BlogPostCollection::make($items),
            'BlogPost list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/v1/cms/client/blog-posts/{id}",
     *     tags={"Client CMS"},
     *     summary="Get blog post details",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show(BlogPost $blogPost): JsonResponse
    {
        return $this->successResponse(
            new BlogPostResource($blogPost),
            'BlogPost retrieved.'
        );
    }
}
