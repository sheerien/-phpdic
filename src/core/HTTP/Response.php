<?php
namespace Phpdic\Dic\HTTP;

class Response
{
    /**
     * Response Constructor
     */
    public function __construct() {}

    /**
     * Get the Response object, so it can be used as a dependency of getResponse
     * 
     * @return Response
     */
    public static function getResponse()
    {
        return new self;
    }

    /**
     * Json Encode Data
     * 
     * @param mixed $data
     * @return mixed
     */
    public static function json($data)
    {
        return json_encode($data, true);
    }

    /**
     * Json Decode Data
     * 
     * @param mixed $data
     * @return mixed
     */
    public static function deJson($data)
    {
        return json_decode($data, true);
    }
    

    /**
     * OutPut Data
     * 
     * @param mixed $data
     * @return void
     */
    public static function outPut($data)
    {
        // $data is empty
        if(!$data){return;}

        // $data is not string
        if(!is_string($data)){
            $data = static::json($data);
        }

        echo $data;
    }

}