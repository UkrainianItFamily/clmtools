<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Models\User;
use App\Repository\LectureRepository;
use App\Actions\Auth\AuthRequest;

final class LectureCreateAction
{
    public function __construct(private LectureRepository $lectureRepository)
    {
    }

    public function execute(LectureCreateRequest $request): LectureResponse
    {
        $link_parts = stristr($request->getLink(), '=');
        $preview_image = $link_parts ?
            'https://img.youtube.com/vi/'.mb_substr($link_parts, 1).'/maxresdefault.jpg' :
            'https://via.placeholder.com/600/5F113B/FFFFFF/?text='.$request->getTitle();

        $lecture = $this->lectureRepository->create([
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
            'link' => $request->getLink(),
            'preview_image' => $preview_image,
            'course_id' => $request->getCourseId(),
            'author_id' => AuthRequest::getAuthUserId(),
        ], $request->getUserId());

        $this->lectureRepository->attach($lecture, $request->getUserId());

        return new LectureResponse(
            $lecture
        );
    }
}
