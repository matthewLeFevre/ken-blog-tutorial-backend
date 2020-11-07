<?php

namespace Blog\Models;

use KenFramework\Model;

class PostModel extends Model
{
  // insert
  public static function insert()
  {
    return self::dispatch(
      "INSERT INTO post () VALUES ()",
      null,
      ['returnId' => true]
    );
  }
  // delete
  public static function delete($data)
  {
    return self::dispatch(
      "DELETE FROM post WHERE postId = :postId",
      $data,
    );
  }
  // update
  public static function update($data)
  {
    $updateFields = self::optionalUpdateValues(['postTitle', 'postSlug', 'postStatus', 'postContent', 'postBrowserTitle', 'topic_topicId'], $data);
    return self::dispatch(
      "UPDATE post SET $updateFields WHERE postId = :postId",
      $data
    );
  }
  // get all
  public static function select()
  {
    return self::dispatch(
      "SELECT post.*, topic.topicTitle, topic.topicColor FROM post
      INNER JOIN topic
      ON post.topic_topicId = topic.topicId ",
      null,
      ['action' => 'fetchAll']
    );
  }
  // get all public
  public static function selectPublic()
  {
    return self::dispatch(
      "SELECT post.*, topic.topicTitle, topic.topicColor FROM post
      INNER JOIN topic
      ON post.topic_topicId = topic.topicId 
      WHERE post.postStatus === 'public'",
      null,
      ['action' => 'fetchAll']
    );
  }
  // get by id
  public static function selectById($data)
  {
    return self::dispatch(
      "SELECT post.*, topic.topicTitle, topic.topicColor FROM post
      INNER JOIN topic
      ON post.topic_topicId = topic.topicId 
      WHERE post.postId = :postId",
      $data,
      ['action' => 'fetch']
    );
  }
  // get by slug
  public static function selectBySlug($data)
  {
    return self::dispatch(
      "SELECT post.*, topic.topicTitle, topic.topicColor FROM post
      INNER JOIN topic
      ON post.topic_topicId = topic.topicId 
      WHERE post.postSlug = :postSlug AND post.postStatus = 'public'",
      $data,
      ['action' => 'fetch']
    );
  }
}
