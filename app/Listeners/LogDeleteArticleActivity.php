<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Activity;

class LogDeleteArticleActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleDeleted $event): void
    {
        Activity::create([
            'user_id' => $event->article->user_id,
            'action' => 'delete',
            'target_type' => 'Article',
            'target_id' => $event->article->id,
            'description' => 'تم حذف مقالة بعنوان: ' . $event->article->title,
        ]);
    }
}
