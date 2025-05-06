<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RepliedToComment extends Notification
{
    protected $replier;
    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct($replier, $comment)
    {
        $this->replier = $replier;
        $this->comment = $comment->loadMissing('post');
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail']; // Remove 'mail' if only using database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Hello {$notifiable->name},")
            ->line("{$this->replier->name} replied to your comment.")
            ->action('View Reply', url("/posts/{$this->comment->post_id}#comment-{$this->comment->id}"))
            ->line('Thanks for being part of the discussion!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->comment->post_id,
            'post_title' => optional($this->comment->post)->title ?? 'Untitled Post',
            'comment_id' => $this->comment->id,
            'replier_id' => $this->replier->id,
            'replier_name' => $this->replier->name,
        ];
    }
}
