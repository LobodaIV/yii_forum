<?php


class ForumStatisticsWidget extends CWidget {

	private function getStatistics() 
	{
		$statistics = array();
		$users = User::model()->count();
		$topics = Topic::model()->count();
		$categories = Category::model()->count();
		$statistics['users'] = $users;
		$statistics['topics'] = $topics;
		$statistics['categories'] = $categories;
		return $statistics;
	}

	public function run() 
	{
		$statistics = $this->getStatistics();
		$this->render('forumstatistics',array('stat' => $statistics));
	}

}

?>