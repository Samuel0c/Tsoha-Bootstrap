<?php

class TopicController extends BaseController {

    public static function topic_list() {
        $topics = Topic::all();
        View::make('topic_list.html', array('topics' => $topics));
    }

    public static function edit_topic($id) {
        $topic = Topic::find($id);
        View::make('edit_topic.html', array('topic' => $topic));
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'name' => $params['name'],
        );
        $topic = new Topic($attributes);
        $errors = $topic->errors();

        if (count($errors) == 0) {
            $topic->save();
            Redirect::to('/topic_list', array('message' => 'New topic added successfully'));
        } else {
            $topics = Topic::all();
            View::make('topic_list.html', array('topics' => $topics, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

}
