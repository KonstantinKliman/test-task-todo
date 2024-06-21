<?php

namespace App\Services;

use App\Http\Requests\Todo\CreateRequest;
use App\Http\Requests\Todo\EditImageRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Repositories\Interfaces\IImageRepository;
use App\Repositories\Interfaces\ITagRepository;
use App\Repositories\Interfaces\ITodoRepository;
use App\Services\Interfaces\ITodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TodoService implements ITodoService
{
    private ITodoRepository $repository;

    private IImageRepository $imageRepository;

    private ITagRepository $tagsRepository;

    private const STORAGE_PATH = "/storage/";

    private const TODOS_IMG_PATH = 'todos/';

    public function __construct(ITodoRepository $repository, IImageRepository $imageRepository, ITagRepository $tagsRepository)
    {
        $this->repository = $repository;
        $this->imageRepository = $imageRepository;
        $this->tagsRepository = $tagsRepository;
    }

    public function create(CreateRequest $request)
    {
        $data = [
            'todo_list_id' => $request->validated('todoListId'),
            'title' => $request->validated('title'),
            'content' => $request->validated('content')
        ];

        $todo = $this->repository->create($data);

        $tags = $this->getTagsFromRequest($request->validated('tags'));
        foreach ($tags as $tag) {
            $tagModel = $this->tagsRepository->create($tag);
            $this->tagsRepository->attach($tagModel, $todo);
        }

        if ($request->hasFile('image')) {
            $path = config('app.url') . self::STORAGE_PATH . $request->file('image')->store(self::TODOS_IMG_PATH . $todo->id);
            $this->imageRepository->create($todo->id, $path);
        }

        return new TodoResource($todo);
    }

    private function getTagsFromRequest(string $tagsFromRequest)
    {
        $tagsArray = explode(',', $tagsFromRequest);
        return array_values(array_filter(array_map(function ($item) {
            $trimmed = trim($item);
            return $trimmed === '' ? null : str_replace(' ', '_', $trimmed);
        }, $tagsArray)));
    }

    public function filterByTags(Request $request)
    {
        $tagsArray = $this->getTagsFromRequest($request->query('tags'));

        $todos = $this->repository->filterByTags($tagsArray);

        return TodoResource::collection($todos);
    }

    public function editImage(EditImageRequest $request, int $todoId)
    {
        $todo = $this->repository->getById($todoId);

        if (!$todo->image) {
            $path = config('app.url') . self::STORAGE_PATH . $request->file('image')->store(self::TODOS_IMG_PATH . $todo->id);
            $this->imageRepository->create($todo->id, $path);
            return ['image' => $path];
        }

        Storage::delete(str_replace(config('app.url') . self::STORAGE_PATH, '', $todo->image->path));
        $path = config('app.url') . self::STORAGE_PATH . $request->file('image')->store(self::TODOS_IMG_PATH . $todo->id);
        $this->imageRepository->update($todoId, $path);
        return ['image' => $path];
    }

    public function deleteImage(int $todoId)
    {
        $todo = $this->repository->getById($todoId);

        Storage::delete(str_replace(config('app.url') . self::STORAGE_PATH, '', $todo->image->path));
        Storage::deleteDirectory(self::TODOS_IMG_PATH . $todo->id);
        $this->imageRepository->delete($todo);

        return null;
    }

    public function search(Request $request)
    {
       $query = $request->query('query');

       $todos = $this->repository->getByQuery($query);

       return TodoResource::collection($todos);
    }
}
