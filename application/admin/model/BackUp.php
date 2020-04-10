<?php

namespace app\admin\model;

use think\Model;

class BackUp extends Model{
	public function getBackUpList($page, $limit)
    {
        return $this->alias('b')->field('b.*,username')->join("admin a", "a.id=b.user_id", "left")->order('id', 'desc')->page($page, $limit)->select();
    }
    public function getBackUpListCount($id = 0)
    {
        if ($id) {
            $this->whereIn("id", $id);
        }
        return $this->count();
    }

    public function insertBackUp($post)
    {
    	return $this->insert($post);
    }

    public function getBackUpById($id)
    {
    	return $this->where("id", $id)->find()->toArray();
    }

    public function deleteBackUp($id)
    {
    	return $this->whereIn("id", $id)->delete();
    }
}