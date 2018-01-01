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
        $topic = new Topic(array(
            'name' => $params['name'],
        ));
        $topic->save();
        Redirect::to('/topic_list', array('message' => 'New topic added successfully'));
    }

}
