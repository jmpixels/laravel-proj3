<?php

class Slug{
    
    function generate_slug($text) {
        // Remove any diacritics (accents) from the text and convert to lowercase
        $normalized_text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $normalized_text = strtolower($normalized_text);
        
        // Replace any non-word characters (except hyphen and underscore) with a space
        $text_with_spaces = preg_replace('/[^\w\s-]/u', ' ', $normalized_text);
        
        // Replace any whitespace with a hyphen
        $slug = preg_replace('/\s+/', '-', $text_with_spaces);
        
        // Remove leading and trailing hyphens (if any)
        $slug = trim($slug, '-');
        
        return $slug;
    }
    
}

?>