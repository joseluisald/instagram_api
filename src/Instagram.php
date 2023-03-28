<?php
/**
 * Created by PhpStorm.
 * User: José Luis
 * Date: 27/03/2023
 * Time: 20:53
 */

namespace joseluisald\instagram_api;

/**
 * Class Instagram
 */
class Instagram
{
    /**
     * @var
     */
    private $data;
        /**
     * @var
     */
    private $error;

    /**
     * @return mixed
     */
    private function connect()
    {
        $file_token = dirname(__FILE__).'/insta_token.txt';
        $current_token = file_get_contents($file_token);

        $url = "https://graph.instagram.com/me/media?access_token={$current_token}&fields=media_url,media_type,caption,permalink,like_count";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result);

        if(isset($result->error))
        {
            $this->error = $result->error;
        }
        else
        {
            return $this->loop($result);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    private function loop($data)
    {
        $page = 1;
        $next = (isset($data->paging->next) && !empty($data->paging->next)) ? $data->paging->next : '';

        $this->data[$page] = $data->data;

        while(1)
        {
            if(!empty($next))
            {
                $paginate = $this->paginate($next);
                $next = (isset($paginate->paging->next) && !empty($paginate->paging->next)) ? $paginate->paging->next : '';
                $page++;
                $this->data[$page] = $paginate->data;
                continue;
            }
            else
            {
                break;
            }
        }
        return $this->data;
    }

    /**
     * @param $url
     * @return mixed
     */
    private function paginate($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result);
    }

    /**
     * @return mixed
     */
    public function getMedias()
    {
        return $this->connect();
    }

    /**
     *
     */
    private function refreshToken()
    {
        $ch = curl_init();

        $file_token = dirname(__FILE__).'/insta_token.txt';
        $current_token = file_get_contents($file_token);

        $url = "https://graph.instagram.com/refresh_access_token";

        $dataArray = ['grant_type' => 'ig_refresh_token', 'access_token' => $current_token];
        $querystring = http_build_query($dataArray);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url."?".$querystring);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);

        $content = json_decode(curl_exec($ch));

        if(isset($content->access_token))
        {
            file_put_contents($file_token, $content->access_token);
        }
        else
        {
            $this->error = 'falta access_token';
        }

        curl_close($ch);
    }

    /**
     *
     */
    public function getError()
    {
        return $this->error;
    }
}
