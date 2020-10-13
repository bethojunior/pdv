<?php


namespace App\Helpers;


use Telegram\Bot\Laravel\Facades\Telegram;

class NotificationHelper
{
    /**
     * @param $title
     * @param $description
     * @param string $typeNotification
     * @return string
     */
    public static function Slack($title , $description , $typeNotification = 'danger', $webhook = 'general')
    {
        try{
            app('slack')->attach([
                'text' => (string) $description,
                'color' => $typeNotification,
            ])->send($title);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function updatedActivityTelegram()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }

    /**
     * @param $title
     * @param $description
     * @param $level
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function Telegram($title , $description , $level)
    {
        $text = "<b>Informações do $level</b>\n"
            . "$title\n"
            . $description;

        Telegram::sendMessage([
            'chat_id' => '-1001294489009',
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return redirect()->back();
    }
}
