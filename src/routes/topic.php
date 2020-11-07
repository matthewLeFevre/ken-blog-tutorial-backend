<?php

use Blog\Models\TopicModel;
use KenFramework\Controller;
use KenFramework\Response;

$Topic = new Controller(["path" => "/topics"]);

$Topic->post("/", function ($req) {
  $filtBody = Controller::filterData(($req->getBody()));
  Controller::required(["topicTitle"], $filtBody);
  $filtBody['topicId'] = TopicModel::insert($filtBody)['id'];
  if (!isset($filtBody['topicId'])) {
    return Response::err("Topic was not created");
  }
  $topicTitle = $filtBody['topicTitle'];
  return Response::success("The $topicTitle topic was created successfully");
});

$Topic->get("/", function () {
  return Response::json(TopicModel::select());
});
