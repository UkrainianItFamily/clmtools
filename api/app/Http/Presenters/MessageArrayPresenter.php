<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Message;
use Illuminate\Support\Collection;

final class MessageArrayPresenter
{
    private UserArrayPresenter $userArrayPresenter;
    private ChatArrayPresenter $chatArrayPresenter;

    public function __construct()
    {
        $this->userArrayPresenter = new UserArrayPresenter();
        $this->chatArrayPresenter = new ChatArrayPresenter();
    }

    public function present(Message $message): array
    {
        return [
            'id' => $message->getId(),
            'user' => $this->userArrayPresenter->present($message->getUser()),
            'chat' => $this->chatArrayPresenter->present($message->getChat()),
            'body' => $message->getBody(),
            'created_at' => $message->getCreatedAt()->toDateTimeString()
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Message $message) {
                    return $this->present($message);
                }
            )
            ->all();
    }
}
