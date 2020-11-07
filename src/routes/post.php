<?php

use Blog\Models\PostModel;
use KenFramework\Controller;
use KenFramework\Response;

$Post = new Controller(["path" => "/posts"]);

// insert
$Post->post("/", function () {
  $postCreated = PostModel::insert();
  if (!isset($postCreated['id'])) {
    return Response::err("Post was not created");
  }
  return Response::json($postCreated, "Post created successfully");
});

// delete
$Post->delete("/:postId", function ($req) {
  $filtParams = Controller::filterData($req->getParams());
  Controller::required(["postId"], $filtParams);
  $rows = PostModel::delete($filtParams)['rows'];
  if ($rows > 0) {
    return Response::success("Post deleted successfully");
  }

  return Response::err("Post did not delete successfully");
});

// update
$Post->put("/:postId", function ($req) {
  $filtData = Controller::filterData(array_merge($req->getParams(), $req->getBody()));
  Controller::required(['postId'], $filtData);
  Controller::requireOne(['postTitle', 'postContent', 'postBrowserTitle', 'postSlug', 'topic_topicId', 'postStatus'], $filtData);
  if (PostModel::update($filtData)['rows'] > 0) {
    return Response::success("Post updated");
  }
  return Response::err("Post did not update successfully");
});

// get all
$Post->get("/", function () {
  return Response::json(PostModel::select(), "All posts retrieved");
});

// get public
$Post->get("/public", function () {
  return Response::json(PostModel::selectPublic(), "All posts retrieved");
});

// get by id
$Post->get("/:postId", function ($req) {
  $filtParams = Controller::filterData($req->getParams());
  Controller::required(['postId'], $filtParams);
  return Response::json(PostModel::selectById($filtParams), "Post retrieved");
});

// get by slug
$Post->get("/slug/:slug", function ($req) {
  $filtParams = Controller::filterData($req->getParams());
  Controller::required(['slug'], $filtParams);
  return Response::json(PostModel::selectById($filtParams), "Post retrieved");
});
