<?php
class GC_TOC_Manager {
    public $headings = [];

    public function __construct() {
        add_filter('the_content', array($this, 'add_ids_to_headings'));
    }

    public function add_ids_to_headings($content) {
        preg_match_all('/<h([2-6])([^>]*)>(.*?)<\/h[2-6]>/si', $content, $matches);

        $headings = [];

        foreach ($matches[0] as $key => $heading) {
            $level = $matches[1][$key];
            $attributes = $matches[2][$key];
            $title = $matches[3][$key];

            $count = array_count_values(array_column($headings, 'title'))[$title] ?? 0;

            if ($count > 0) {
                $id = sanitize_title($title) . '-' . ($count + 1);
            } else {
                $id = sanitize_title($title);
            }

            $headings[] = array('id' => $id, 'title' => $title, 'level' => $level);
            $this->headings[] = compact('id', 'title', 'level');

            // Preserve existing class and attributes
            if (preg_match('/class=["\']([^"\']+)["\']/i', $attributes, $class_match)) {
                $new_attributes = preg_replace('/class=["\']([^"\']+)["\']/i', 'class="' . $class_match[1] . '" id="' . $id . '"', $attributes);
            } else {
                $new_attributes = trim($attributes) . ' id="' . $id . '"';
            }

            $heading_with_id = sprintf('<h%d %s>%s</h%d>', $level, $new_attributes, $title, $level);
            $content = preg_replace('/'.preg_quote($heading, '/').'/', $heading_with_id, $content, 1);
        }

        return $content;
    }

    public function create_toc_array() {
        return array_map(function($heading) {
            return ['id' => $heading['id'], 'title' => $heading['title'], 'level' => $heading['level']];
        }, $this->headings);
    }
}

$toc_manager = new GC_TOC_Manager();