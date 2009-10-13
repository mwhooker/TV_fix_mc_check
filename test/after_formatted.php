<?php

class Test extends Data
{
    
    function test1()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$this->last_memcache_lookup_succeeded()) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test2()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$cache_id) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test3()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if ($this->last_memcache_lookup_succeeded() == false) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test4()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if ($this->last_memcache_lookup_succeeded() != true) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test5()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$this->last_memcache_lookup_succeeded() == true) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test6()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$this->last_memcache_lookup_succeeded() != false) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test7()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$this->last_memcache_lookup_succeeded() && $this->blah()) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test8()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if ($this->blah() && !$this->last_memcache_lookup_succeeded()) {
            $results = $this->db_get_all_assoc("select * from content_feed where content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
    
    function test9()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        $found = !$this->last_memcache_lookup_succeeded();
        if (!$found) {
            $results = $this->db_get_all_assoc("select * from content_feed where content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
}

class Test2 extends GNE
{
    
    function test1()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$result) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
}
class Test3 extends TV
{
    
    function test1()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$result) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
}
class Test4 extends Nulls
{
    
    function test1()
    {
        $cache_id = __CLASS__ . "->" . __FUNCTION__ . "(" . $content_feed_id . ")";
        $result = $this->get_cache($cache_id);
        
        if (!$result) {
            $results = $this->db_get_all_assoc("SELECT * FROM content_feed WHERE content_feed_id = '" . $content_feed_id . "'");
            $result = $results[0];
            $this->set_cache($cache_id, $result);
        }
    }
}
?>
