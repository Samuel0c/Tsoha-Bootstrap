<?php

class TopicController extends BaseController {

    public static function topic_list() {
        self::check_logged_in();
        $topics = Topic::all();
        View::make('topic/topic_list.html', array('topics' => $topics));
    }

    public static function edit_topic($id) {
        self::check_logged_in();
        $topic = Topic::find($id);
        View::make('topic/edit_topic.html', array('topic' => $topic));
    }

    public static function store() {
        self::check_logged_in();
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
            View::make('topic/topic_list.html', array('topics' => $topics, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'name' => isset($params['name']) ? $params['name'] : null,
        );
        
        $topic = new Topic($attributes);
        $errors = $topic->errors();
        
        if (count($errors) > 0) {
            $topics = Topic::all();
            View::make('topic/edit_topic.html', array('topics' => $topics, 'errors' => $errors, 'attributes' => $attributes));
        } else {
            $topic->update();
            Redirect::to('/topic_list', array('message' => 'Topic updated successfully'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $topic = new Topic(array('id' => $id));
        $topic->delete($id);

        Redirect::to('/topic_list', array('message' => 'Topic deleted successfully'));
    }

}
