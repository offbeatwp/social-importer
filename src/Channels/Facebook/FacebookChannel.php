<?php
namespace OffbeatWP\SocialImporter\Channels\Facebook;

use OffbeatWP\SocialImporter\Channels\AbstractSocialChannel;
use OffbeatWP\SocialImporter\Channels\SocialChannelInterface;

class FacebookChannel extends AbstractSocialChannel implements SocialChannelInterface
{
    const API_URL      = 'https://graph.facebook.com/v3.2/';
    const ENTITY_CLASS = FacebookPostEntity::class;
    const MODEL_CLASS  = FacebookPostModel::class;

    public function getLoginUrl()
    {
        return 'https://www.facebook.com/v3.2/dialog/oauth/?client_id=' . $this->config['api_key'] . '&redirect_uri=' . urlencode($this->getRedirectUrl('request_access_token')) . '&state=' . $this->config('id') . '&response_type=code&scope=manage_pages';
    }

    public function requestAccessToken()
    {
        $data = [
            'client_id'     => $this->config['api_key'],
            'client_secret' => $this->config['api_secret'],
            'redirect_uri'  => $this->getRedirectUrl('request_access_token'),
            'code'          => $_GET['code'],
        ];

        $result = $this->request('oauth/access_token', 'POST', $data, false);

        if (isset($result->access_token)) {
            $this->setStatus('ready');
            return $result->access_token;
        }

        $this->setStatus('failed');
        return false;
    }

    public function requestPosts()
    {
        $results = $this->request($this->config('page_id') . '/posts', 'GET', ['fields' => 'id,message,full_picture,created_time,type,link']);

        return $this->convertToCollection($results->data);
    }
}
