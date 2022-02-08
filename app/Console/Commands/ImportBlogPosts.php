<?php

namespace App\Console\Commands;

use Exception;
use App\Services\BlogPost;
use Illuminate\Console\Command;

class ImportBlogPosts extends Command
{
    protected $blog_post_service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'square1:import:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import created posts from REST API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->blog_post_service = new BlogPost();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->blog_post_service->process();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
