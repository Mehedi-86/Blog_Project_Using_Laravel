<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CommentedOnPost extends Notification 
{
    protected $comment;
    protected $post;

    /**
     * Create a new notification instance.
     */
    public function __construct($comment, $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Use ['database', 'mail'] if you want email too
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line("{$this->comment->user->name} commented on your post: \"{$this->post->title}\"")
            ->action('View Post', url("/posts/{$this->post->id}"))
            ->line('Thank you for staying engaged!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'commenter_id' => $this->comment->user_id,
            'commenter_name' => $this->comment->user->name,
            'comment_body' => $this->comment->body,
        ];
    }
}
