<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PostLiked extends Notification
{
    protected $liker;
    protected $post;

    /**
     * Create a new notification instance.
     */
    public function __construct($liker, $post)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Add 'mail' if you also want email notifications
    }

    /**
     * Get the mail representation of the notification (optional).
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line("{$this->liker->name} liked your post: {$this->post->title}")
            ->action('View Post', url("/posts/{$this->post->id}"))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification (for database).
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
        ];
    }
}
