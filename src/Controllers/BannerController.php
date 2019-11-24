<?php
namespace App\Controllers;

use App\Controllers\Controller;

class BannerController extends Controller {

    public function index() {
        $current_post = get_queried_object();
        if( $current_post ) {
            $tags_arr = get_the_tags($current_post->ID);
            $tags = [];
            if( $tags_arr ) {
                foreach( $tags_arr as $tag ) {
                    $tags[] = $tag->name;
                }
            }
            $posts = get_posts([
                'post_type' => 'banner',
                'tag' => $tags
            ]);
            $banners = [];
            foreach( $posts as $p ) {
                $banners[] = [
                    'imagem' => get_field('imagem', $p->ID)['url'],
                    'link' => get_field('link', $p->ID)
                ];
            }
            return $this->generateView("carousel", ['banners' => $banners]);
        }
        return $this->generateView("carousel", ['banners' => []]);
    }

}