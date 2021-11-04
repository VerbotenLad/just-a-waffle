<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

use phpDocumentor\Reflection\DocBlock\Tags\Method;

class Post
{

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;



    public function __construct($title, $excerpt, $date, $body, $slug)
    {
//        $this->title = $title;
//        $this->excerpt =$excerpt;
//        $this->date = $date;
//        $this->body = $body;
        $this->setTitle($title);
        $this->setExcerpt($excerpt);
        $this->setDate($date);
        $this->setBody($body);
        $this->setSlug($slug);
    }



    public static function find($slug)
    {
        //create path using slug to find resource
        //if resource doesnt exist redirect to /, otherwise it goes to the return func
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }


        //caches and returns $path content
        return cache()->remember("posts.{$slug}", 5, fn () => file_get_contents($path));
    }

    public static function all()
    {
        /**
         * if you find yourself looping over something
         * and then building up a different array you can
         * use array_map
         */
        /**this is functionally identical to array_map
        Laravel's collect() function collects an array and wraps it
        in a collect object. Then you can map over every item in the array
        or add, or pull, or loop through them, that can be done.*/
        return collect(File::files(resource_path("posts")))
            ->map(function($file) {
                return YamlFrontMAtter::parseFile($file);
            })
            ->map(function($document){
                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug,
                );
            });

        /**
         * HERE'S THE SAME THING BUT USING ARRAYMAP
         *     $posts = array_map(function (File::files(resource_path("posts"))) {
        $document = YamlFrontMatter::parseFile($file);

        return new Post(
        $document->title,
        $document->excerpt,
        $document->date,
        $document->body(),
        $document->slug,
        );
        }, $files);


         */
    }


    /**********SETTERS & GETTERS**************/

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $excerpt
     */
    public function setExcerpt($excerpt): void
    {
        $this->excerpt = $excerpt;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
