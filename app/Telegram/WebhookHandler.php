<?php

namespace App\Telegram;

use App\Enums\MessageStatus;
use App\Jobs\SendMessage;
use App\Models\Message;
use App\OpenAi\TextCompletion;
use App\Telegram\Actions\ActionService;
use App\Telegram\Actions\ChatTextService;
use App\Telegram\Actions\MenuAction;
use App\Telegram\Actions\OpenAiTokenService;
use App\Telegram\Enum\ConstantKeyboards;
use App\Telegram\Enum\ConstantTexts;
use DefStudio\Telegraph\Handlers\EmptyWebhookHandler;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Stringable;

class WebhookHandler extends EmptyWebhookHandler
{

    protected function handleChatMessage(Stringable $text): void
    {
        if (in_array($text, array_keys(ConstantKeyboards::MAIN_MENU_ARRAY))) {
            if (in_array($this->chat->chat_id, config('telegraph.admin_chat_ids'))) {
                $action = ConstantKeyboards::MAIN_MENU_ARRAY[(string)$text];
                (new MenuAction($this->chat))->{$action}();
            } else {
                $this->chat->html("Noto'g'ri ma'lumot kiritildi iltimos /help buyrug'i orqali batafsil ma'lumot oling")->send();
            }
        } else {
            if (in_array($this->chat->chat_id, config('telegraph.admin_chat_ids'))) {
                $action = ActionService::get();
                if ($action) {
                    if ($action === 'sendMessage') {
                        $message = Message::query()->create(['message_id' => $this->messageId, 'description' => $this->message->text(), 'status' => MessageStatus::READY_TO_SENT, 'from_chat_id' => $this->chat->chat_id]);
                        dispatch(new SendMessage($message->id));
                        ActionService::delete();
                    }
                    if ($action === 'resetToken') {
                        OpenAiTokenService::update($this->message->text());
                        $this->chat->html(ConstantTexts::TOKEN_SAVED)->send();
                        ActionService::delete();
                    }
                    return;
                }
            }

            if (is_null(ActionService::get())){
                ChatTextService::create($this->chat->chat_id, $this->message->text());
                $this->chat->action('typing')->send();
                $response = $this->chat->html('⏳ Javobni tayyorlayapman …')->send();
                $message_id = $response->telegraphMessageId();
                $result = (new TextCompletion($this->chat))->text($this->message->text());
                $this->chat->edit($message_id)->html(is_null($result) ? ConstantTexts::RETRY_LATER : $result)->send();

            }
        }
    }

    //Commands
    public function start()
    {
        try {
            if (in_array($this->chat->chat_id, config('telegraph.admin_chat_ids'))) {
                $this->chat->html(ConstantTexts::INTRO)->replyKeyboard(
                    ReplyKeyboard::make()
                        ->row([
                            ReplyButton::make('Xabar yuborish📨'),
                            ReplyButton::make('Statistika📊'),
                        ])
                        ->row([
                            ReplyButton::make('Apini yangilash🔁'),
                            ReplyButton::make('Kanal qo\'shish➕'),
                        ]) ->row([
                            ReplyButton::make('Admin Panel')->webApp('https://furqat.me/admin'),
                        ])->resize())->send();
            } else {
                $this->chat->html(ConstantTexts::INTRO)->send();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function help(): void
    {
        $this->chat->html(ConstantTexts::HELP)->send();
    }

}
