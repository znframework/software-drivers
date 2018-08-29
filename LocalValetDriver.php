<?php

class LocalValetDriver extends BasicValetDriver
{
    /**
     * Directory index
     * 
     * @var string
     */
    protected $directoryIndex = 'zeroneed.php';

    /**
     * Determine if the driver serves the request.
     *
     * @param string $sitePath
     *
     * @return bool
     */
    public function serves($sitePath)
    {
        return file_exists($this->sitePath($sitePath));
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param string $sitePath
     * @param string $uri
     *
     * @return string|false
     */
    public function isStaticFile($sitePath, $uri)
    {
        if( $this->isActualFile($staticFilePath = $sitePath . $uri) ) 
        {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param string $sitePath
     *
     * @return string
     */
    public function frontControllerPath($sitePath)
    {
        $_SERVER['SCRIPT_FILENAME'] = $this->sitePath($sitePath);
        $_SERVER['SCRIPT_NAME']     = $this->directoryIndex();

        return $_SERVER['SCRIPT_FILENAME'];
    }

    /**
     * Protected directory index
     */
    protected function directoryIndex()
    {
        return '/' . $this->directoryIndex;
    }

    /**
     * Protected site path
     */
    protected function sitePath($sitePath)
    {
        return $sitePath . $this->directoryIndex();
    }
}
