<?php

namespace App\Telegram\Enum;

class ConstantTexts
{

    const INTRO = "<strong>Salom!</strong>

<strong>Bot sizga savollaringizga javob topishda yordam beradi. Foydalanish uchun shunchaki savolingizni botga yozish kifoya.</strong>

<strong>Bot nimalar qiloladi?</strong>
1. Savolga javob berish;
2. Kod yozish va uni tahrirlash;
3. Har xil turdagi matnlar yozish va ularni tahrirlash;
4. Matnni barcha tillarda tarjima qilish;
5. Insho, she’r yozish va hokazolar.

<strong>Buyruqlar:</strong>
/start - Botni qayta ishga tushirish
/help - Foydalanish qo’llanmasi

<strong>Bot savollarga qancha tez javob beradi?</strong>
Bir necha soniyadan bir necha daqiqagacha.";

    const HELP = "<strong>Bot OpenAI kompaniyasining ChatGPT sun’iy intellektiga ulangan. Foydalanish uchun shunchaki savolingizni botga yozish kifoya.</strong>

<strong>Buyruqlar:</strong>
/start - Botni qayta ishga tushirish
/help - Foydalanish qo’llanmasi

<strong>Foydalanish qo’llanmasi:</strong>
Bot bilan haqiqiy suhbatdoshdek, har xil tillarda so’zlashishingiz mumkin. E’tibor bering, ba’zida bot savolga xato javob berishi mumkin, bot faqat 2021 yilgacha ma’lumotlarga ega. Maksimal to’g’ri javob olish uchun savolingizni iloji boricha batafsilroq yozing.

<strong>Botga qo’shiladigan yangi funksiyalarni birinchilardan sinash uchun bot rasmiy kanaliga obuna bo’ling: @AIChatGPTInfoz</strong>

<strong>Taklif va murojaatlar uchun: @DigiTechGPT_support</strong>";

    const SEND_MESSAGE = "<strong>Xabarni yuboring.</strong>
Bu xabar hamma foydalanuvchilarga yuboriladi";

    const SEND_TOKEN = "<strong>Yangi tokenni yuboring.</strong>";

    const TOKEN_SAVED = "<strong>Token saqlandi.</strong>";

    const RETRY_LATER = "<strong>Bir ozdan keyin qayta urinib ko'ring.</strong>";
    const ERROR_OPENAI = "<i>Error:</i>
 <code>:error</code>

 <i>Chat id:</i> <code>:chat_id</code>";

    const STATS = "<strong>Statistika:</strong>

👥 Telegram foydalanuvchilari: <code>:chats_count</code>
👥 Telegram foydalanuvchilari (joriy oyda): <code>:chats-count-current-month</code>

📨 OpenAI so'rovlar soni: <code>:openai_requests_count</code>
📨 OpenAI so'rovlar soni (joriy oyda): <code>:openai-requests-count-current-month</code>";

}
