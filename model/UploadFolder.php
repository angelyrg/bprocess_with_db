<?php

Class UploadFolder 
{
    protected $folder = "upload";
    protected $errors = [];
    protected $path;
    protected $curdir;
    protected $extensions = "*";
    
    public function __construct() 
    {
        error_reporting( 0 );
        $this->curdir = getcwd();
    }

    public function set_extensions($extensions) 
    {
        $this->extensions = $extensions;
    }

    public function set_folder($folder_name) 
    {
        $this->folder = $folder_name;
    }

    public function process($path, $files) 
    {
        // Original path from user's device
        $original_path  = dirname($path); 

        // Extract file's data
        $file_name      = $files['name'];
        //$file_size      = $files['size'];
        $file_tmp       = $files['tmp_name'];
        //$file_type      = $files['type'];
        $file_ext       = strtolower(end(explode('.',$file_name)));

        // Check for allowed extensions
        if ($this->extensions != "*") {
            if (!in_array($file_ext, $this->extensions)) {
                $this->errors[] = "This file extension ($file_ext) is not allowed.";
            }
        }


        // If not error
        if (empty($this->errors)) {
            $base = $this->curdir . DIRECTORY_SEPARATOR . $this->folder;
            $upload_dir  = $base . DIRECTORY_SEPARATOR . $original_path ;
            $upload_path = $upload_dir . DIRECTORY_SEPARATOR. basename($file_name) ;

            // Create target dir if not exist
            if (!is_dir($upload_dir)){
                mkdir($upload_dir, 0700, true);
            }

            $success = move_uploaded_file($file_tmp, $upload_path);
        }
        
        echo $original_path . DIRECTORY_SEPARATOR . basename($file_name); 
    }
}
