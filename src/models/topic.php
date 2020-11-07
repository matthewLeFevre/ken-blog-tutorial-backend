<?php

namespace Blog\Models;

use KenFramework\Model;

class TopicModel extends Model
{
  // Post - Create a new topic
  public static function insert($data)
  {
    $optionalFields = self::optionalColumns(['topicColor'], $data);
    $optionalColumns = $optionalFields['columns'];
    $optionalValues = $optionalFields['values'];
    return self::dispatch(
      "INSERT INTO topic
      (topicTitle $optionalColumns)
      VALUES
      (:topicTitle $optionalValues)",
      $data,
      ['returnId' => true]
    );
  }
  // Delete - Delete a topic
  public static function delete($data)
  {
    return self::dispatch(
      "DELETE FROM topic WHERE topicId = :topicId",
      $data
    );
  }
  // Select - Get all topics
  public static function select()
  {
    return self::dispatch(
      "SELECT * FROM topic",
      null,
      ['action' => 'fetchAll']
    );
  }
  // Select by id -  get one topic
  public static function selectById($data)
  {
    return self::dispatch(
      "SELECT * FROM topic WHERE topicId = :topicId",
      $data,
      ['action' => 'fetch']
    );
  }
}
