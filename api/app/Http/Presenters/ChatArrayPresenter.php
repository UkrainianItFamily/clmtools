<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Actions\Lecture\LectureResponse;
use App\Models\Chat;
use Illuminate\Support\Collection;

final class ChatArrayPresenter
{
    private UserArrayPresenter $userArrayPresenter;
    private LectureArrayPresenter $lectureArrayPresenter;

    public function __construct()
    {
        $this->userArrayPresenter = new UserArrayPresenter();
        $this->lectureArrayPresenter = new LectureArrayPresenter();
    }

    public function present(Chat $chat): array
    {
        return [
            'id' => $chat->getId(),
            'user' => $this->userArrayPresenter->present($chat->user()->first()),
            'lecture' => $this->lectureArrayPresenter->present(new LectureResponse($chat->lecture()->first())),
            'created_at' => $chat->getCreatedAt()->toDateTimeString()
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Chat $chat) {
                    return $this->present($chat);
                }
            )
            ->all();
    }
}
