<?php
error_reporting(E_ALL);
require( dirname( __FILE__ ) . '/wp-blog-header.php' );

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
//echo exec("git pull",$out);
//git rev-parse HEAD
//echo exec("git diff --name-only c74d055b34c932faf9a726e70c6bf958554890e9 6c45e9a113f6d6437168d3b43a3199016a980c9c",$out);
//echo exec("cd ~/lamp/jekyll && git diff --name-only HEAD HEAD~5",$out);
$headCommit=exec("git rev-parse HEAD");


$lastCommit = get_option( '_last_commit_id', '');

if(!$lastCommit){
    echo "git rev-list HEAD | tail -n 1\n ";
    $lastCommit=exec("git rev-list HEAD | tail -n 1");
}
echo "headCommit:$headCommit\n";
echo "lastCommit:$lastCommit\n";
echo "git diff --name-only $lastCommit $headCommit\n";
exec("git diff --name-only $lastCommit $headCommit",$result);
//print_r($result);
$posts=[];
foreach($result as $r){
    if(strpos($r,'_posts')>-1 && file_exists($r)){
        $posts[] = $r;
        if(endsWith($r,".md")){
            $content = file_get_contents($r);
            if( '---' === substr($content, 0, 3 ))
            {
                preg_match( '/---(.*?)---(.*)/ms', $content, $matches );
                array_pop( $matches );
                if (!class_exists('Spyc')) {
                    require_once __DIR__ . '/vendor/mustangostang/spyc/spyc.php';
                }
                $meta = spyc_load( $matches[1] );                

                if ( isset( $meta['permalink'] ) ) {
                    $meta['permalink'] = str_replace( home_url(), '', $meta['permalink'] );
                }
                preg_match( '/(^---(.*?)---)(.*)/ms', $content, $matches );
                $content = array_pop( $matches );
                if ( function_exists( 'wpmarkdown_markdown_to_html' ) ) {
                    // Inline Style Images
                    $content    =   preg_replace_callback('/(!\[(.*)\]\s?\()(.*)(.png|.gif|.jpg|.jpeg)((.*)\))/',function($match){
                        global $r;
                        $year='';
                        if (preg_match('/\d{4}/', $match[3], $year_matches)) {
                            $year = $year_matches[0].'/';
                        }
                        $imagesFolder= dirname( __FILE__ ).'/wp-content/uploads/'.$year;
                        $imageFile= dirname( __FILE__ ).'/wp-content/uploads/'.$year.$match[3].$match[4];
                        $repoImageFile = dirname($r).'/'.$match[3].$match[4] ;
                        if (file_exists($repoImageFile) && !file_exists($imageFile)) {
                            if(!file_exists($imagesFolder)){
                                mkdir($imagesFolder, 0777, true);
                            }
                            echo "copy image file from $repoImageFile  to $imageFile\n";
                            copy($repoImageFile,$imageFile);
                        }

                        return $match[1].home_url().'/wp-content/uploads/'.$year.$match[3].$match[4].$match[5];
                    },$content);
                    // Reference Style Images
                   /* $content    =   preg_replace_callback('/\[(.*)\]:\s?(.*)(.png|.gif|.jpg|.jpeg)/',function($match){
                        return str_replace('your_search_term','your_replacement',$match[0]);
                    },$content);*/
                    $content = wpmarkdown_markdown_to_html( $content );
                }

                $args = array( 'post_content' => $content,'permalink'=>$meta['permalink']);
                if ( $meta ) {
                    if ( array_key_exists( 'layout', $meta ) ) {
                        $args['post_type'] = $meta['layout'];
                        unset( $meta['layout'] );
                    }
        
                    if ( array_key_exists( 'published', $meta ) ) {
                        $args['post_status'] = true === $meta['published'] ? 'publish' : 'draft';
                        unset( $meta['published'] );
                    }
        
                    if ( array_key_exists( 'post_title', $meta ) ) {
                        $args['post_title'] = $meta['post_title'];
                        unset( $meta['post_title'] );
                    }else if ( array_key_exists( 'title', $meta ) ) {
                        $args['post_title'] = $meta['title'];
                        unset( $meta['title'] );
                    }
        
                    if ( array_key_exists( 'ID', $meta ) ) {
                        $args['ID'] = $meta['ID'];
                        unset( $meta['ID'] );
                    }
        
                    if ( array_key_exists( 'post_date', $meta ) ) {
        
                        if ( empty( $meta['post_date'] ) ) {
                            $meta['post_date'] = current_time( 'mysql' );
                        }
        
                        $args['post_date'] = $meta['post_date'];
        
                        $args['post_date_gmt'] = get_gmt_from_date( $meta['post_date'] );
                        unset( $meta['post_date'] );
                    }
                }
                $args['comment_status'] = 'closed';
                global $wpdb;
                $post_id = $wpdb->get_var( "select post_id from $wpdb->postmeta where meta_value = '$r' and meta_key='postPath' limit 1" );
                if($post_id){
                    echo "update post id $post_id\n";
                    $args['ID']=$post_id;
                    $post_id = wp_update_post( $args, true );
                }else{
                    echo "insert new post id $post_id\n";
                    $post_id = wp_insert_post( $args, true ) ;
                    update_post_meta( $post_id, 'postPath', $r );
                }
                
                $meta['postPath'] = $r;
                echo get_permalink( $post_id ).' => '.get_the_title( $post_id );
            }

        }
    }
}
update_option( '_last_commit_id', $headCommit );
print_r($posts);

