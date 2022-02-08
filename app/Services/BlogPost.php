<?php

namespace App\Services;

use App\Exceptions\ImportPostException;
use App\Exceptions\NoAdminPostCreatorException;
use App\Exceptions\NoAdminUserPostCreatorException;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BlogPost
{
    protected $url;
    protected $client;
    protected $posts = [];
    protected $adminUserPostCreator = null;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = config('square1.blog-post.url');
    }

    public function process()
    {
        try {
            $this->getPosts()->getAdminPostCreator()->importPosts();
        } catch (Exception $e) {
            throw new ImportPostException("Error Getting Posts Request: " . $e->getMessage());
        }
    }

    protected function getPosts()
    {
        if (!$this->url) {
            throw new Exception("No URL Provided For Blog Posts");
        }

        $response = $this->client->get($this->url);

        $response = $response->getBody()->getContents();

        $response_body = json_decode($response, true);

        if (!isset($response_body['data'])) throw new ImportPostException("No Posts In The Request");

        $this->posts = $response_body['data'];

        return $this;
    }

    protected function getAdminPostCreator()
    {

        $this->adminUserPostCreator = User::adminAuthor()->first();
        if (!$this->adminUserPostCreator) throw new NoAdminUserPostCreatorException("No Admin Post Creator");
        return $this;
    }

    protected function importPosts()
    {
        $this->adminUserPostCreator->posts()->createMany($this->posts);
    }
}
