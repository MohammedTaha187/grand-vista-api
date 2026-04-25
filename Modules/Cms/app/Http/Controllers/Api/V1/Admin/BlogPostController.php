<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\BlogPost\Contracts\BlogPostServiceInterface;
use Modules\Cms\Models\BlogPost;
use Modules\Cms\Http\Requests\Api\V1\BlogPost\StoreBlogPostRequest;
use Modules\Cms\Http\Requests\Api\V1\BlogPost\UpdateBlogPostRequest;
use Modules\Cms\Http\Resources\Api\V1\BlogPost\BlogPostResource;
use Modules\Cms\Http\Resources\Api\V1\BlogPost\BlogPostCollection;
use Modules\Cms\DTOs\BlogPost\BlogPostData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @group BlogPost Management
 *
 * APIs for managing BlogPosts
 */
class BlogPostController extends Controller
{
    public function __construct(
        private readonly BlogPostServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request): JsonResponse
    {
        $blogPost = $this->service->create(BlogPostData::from($request->validated()));

        return $this->successResponse(
            new BlogPostResource($blogPost),
            'BlogPost created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost): JsonResponse
    {
        return $this->successResponse(
            new BlogPostResource($blogPost),
            'BlogPost retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost): JsonResponse
    {
        $this->service->update($blogPost->id, BlogPostData::from($request->validated()));

        return $this->successResponse(
            new BlogPostResource($blogPost->fresh()),
            'BlogPost updated successfully.'
        );
    }

    public function destroy(BlogPost $blogPost): Response
    {
        $this->service->delete($blogPost->id);

        return $this->noContentResponse();
    }
}
