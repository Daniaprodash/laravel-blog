<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Activity;
class LogArticleActivity
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
    public function handle(ArticleCreated $event): void
    {
        Activity::create([
            'user_id' => $event->article->user_id,
            'action' => 'create',
            'target_type' => 'Article',
            'target_id' => $event->article->id,
            'description' => 'تم إنشاء مقالة بعنوان: ' . $event->article->title,
        ]);

    }
}
