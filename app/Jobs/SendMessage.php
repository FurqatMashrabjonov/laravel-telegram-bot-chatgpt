<?php

namespace App\Jobs;

use App\Enums\MessageStatus;
use App\Models\Message;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $message_id;

    /**
     * Create a new job instance.
     */
    public function __construct(int $message_id)
    {
        $this->message_id = $message_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $chats = TelegraphChat::query()->get();
        $message = Message::query()->where('id', $this->message_id)->first();
        $admin = TelegraphChat::query()->where('chat_id', $message->from_chat_id)->first();
        $admin?->html('<strong>Xabar yuborish boshlandi</strong>')->send();
        if ($message) {
            foreach ($chats as $chat) {
                if ($chat->chat_id !== $message->from_chat_id) {
                    $chat->copyMessage($message->from_chat_id, $message->message_id)->send();
                }
            }
            $message->update(['status' => MessageStatus::SENT]);
            $admin->html('<strong>Xabar yuborish yakunlandi</strong>

<strong>Qabul qiluvchilar soni: ' . count($chats) . '</strong>')->reply($message->message_id)->send();
        }

    }
}
